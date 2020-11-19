<?php
	session_start();
	$connect=mysqli_connect('localhost', 'root', '', 'moduleconnexion');
?>

<!DOCTYPE html>

<html lang="fr">
	<head>
		<title>Connexion</title>
		<meta http-equiv="Content-Type" charset="UTF-8" lang="fr">
	</head>

	<body>
		<?php

			if(!isset($_SESSION['user'])) {
				if($_POST){
					$login=$_POST['login'];
					$password=$_POST['password'];
					$stmt=$connect->prepare('SELECT * FROM utilisateurs WHERE login=? ');
					$stmt->bind_param("s", $login);
					$stmt->execute();
					$result = $stmt->get_result();
					$user = $result->fetch_assoc();

					if(empty($user)){
						echo "Identifiant ou mot de passe incorrect.<br>";?> <a href="connexion.php">Réessayez</a><br><a href="">Mot de passe oublié ?</a><?php
						exit();
					}

					else{
						if($login==$user['login']){
							if($password==$user['password']){
								echo "Vous êtes maintenant connecté. <br>";?> <a href="index.php">Accueil</a><?php
								$_SESSION['user']=['login'=>$user['login'], 'password'=>$user['password'], 'nom'=>$user['nom'], 'prenom'=>$user['prenom']];
								exit();
							}
							else{
								echo "Mot de passe incorrect.<br>";?> <a href="connexion.php">Réessayez</a><br><a href="">Mot de passe oublié ?</a><?php
								exit();
							}
						}
					}

				}

				/*if($_POST){
					$login=$_POST['login'];
					$password=$_POST['password'];

					for($i=0; $i<mysqli_num_rows($db); $i++){
						$row=mysqli_fetch_assoc($db);

						if($login==$row['login']){
							if($password==$row['password']){
								echo "Vous êtes maintenant connecté. <br>";?> <a href="index.php">Accueil</a><?php
								exit();
							}
							else{
								echo "Mot de passe incorrect.<br>";?> <a href="connexion.php">Réessayez</a><br><a href="">Mot de passe oublié ?</a><?php
								exit();
							}
						}

						else if($i+1 == mysqli_num_rows($db)){
							echo "Identifiant ou mot de passe incorrect.<br>";?> <a href="connexion.php">Réessayez</a><br><a href="">Mot de passe oublié ?</a><?php
							exit();
						}
					}
				}*/


				else{
			?>

			<form method="post" action="connexion.php">
				<label for="login">Login :</label>
				<input type="text" id="login" name="login" placeholder="Ex: John-Doe68" required>
				<label for="password">Mot de passe :</label>
				<input type="password" id="password" name="password" required>
				<input type="submit" value="Envoyer">
			</form>
			<?php
		}

	}

		else{
			echo "Vous êtes déjà connecté.<br> Retour à l'";?> <a href="index.php">Accueil</a><?php echo ".";
		}
		

	$connect->close();
	?>
		
	</body>
</html>