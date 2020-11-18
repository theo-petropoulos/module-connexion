<!DOCTYPE html>

<html lang="fr">
	<head>
		<title>Inscription</title>
		<meta http-equiv="Content-Type" charset="UTF-8" lang="fr">
	</head>

	<body>
		<?php
			$connect=mysqli_connect('localhost', 'root', '', 'moduleconnexion');
			$db=$connect->query('SELECT * FROM utilisateurs');

			if($_POST){
				$err=0;
				$login=$_POST['login'];
				$password=$_POST['password'];
				$cpassword=$_POST['cpassword'];
				$nom=$_POST['nom'];
				$prenom=$_POST['prenom'];

				if($password!=$cpassword){
					echo "Les mots de passe ne correspondent pas. Veuillez ";?><a href="inscription.php">Réessayer</a><?php echo ".";
					$ok++;
				}

				for($i=0; $i<mysqli_num_rows($db); $i++){
					$row=mysqli_fetch_assoc($db);

					if($login==$row['login']){
						$err++;
						die("Ce nom d'utilisateur existe déjà.");
					}

					if($prenom==$row['prenom'] && $password==$row['password'] && $nom==$row['nom']){
						$err++;
						die("Ces informations sont déjà présentes dans notre base de données.<br>");
					}
				}

				if($err==0){
					$stmt=$connect->prepare("INSERT INTO `utilisateurs` (nom, prenom, login, password) 
									VALUES (?,?,?,? ) ");

					$stmt->bind_param("ssss", $nom, $prenom, $login, $password);
					$stmt->execute();
					echo "Votre inscription a bien été enregistrée. Retour à ";?><a href="index.php">l'Accueil</a><?php echo ".";
				}

			}

			else{
		?>

		<form method="post" action="inscription.php">
			<label for="login">Entrez votre identifiant : </label>
			<input type="text" id="login" name="login" placeholder="Ex: John-Doe68" required>
			<label for="password">Entrez votre mot de passe : </label>
			<input type="password" id="password" name="password" required>
			<label for="cpassword">Confirmez le mot de passe : </label>
			<input type="password" id="cpassword" name="cpassword" required>
			<label for="nom">Entrez votre nom : </label>
			<input type="text" id="nom" name="nom" placeholder="Ex: John" required>
			<label for="prenom">Entrez votre prénom : </label>
			<input type="text" id="prenom" name="prenom" placeholder="Ex: Doe" required>
			<input type="submit" value="Envoyer">
		</form>
		<?php
	}
	$connect->close();
	?>
		
	</body>
</html>