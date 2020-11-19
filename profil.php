<?php
	session_start();
	$connect=mysqli_connect('localhost', 'root', '', 'moduleconnexion');

	if(isset($_POST) && $_POST){
		$pre_login=$_SESSION['user']['login'];
		$nom=$_POST['nom'];$prenom=$_POST['prenom'];$login=$_POST['login'];$password=$_POST['password'];
		$connect->query("UPDATE utilisateurs SET login='$login', nom='$nom', prenom='$prenom', password='$password' WHERE login='$pre_login' ");
		$_SESSION['user']=['login'=>$login, 'password'=>$password, 'nom'=>$nom, 'prenom'=>$prenom];
	}
?>

<!DOCTYPE html>

<html lang="fr">
	<head>
		<title>Profil</title>
		<meta http-equiv="Content-Type" charset="UTF-8" lang="fr">
	</head>

	<body>
		<?php

		if(isset($_SESSION['user']) && $_SESSION['user']['login']=='admin'){

			?>
			<p>Accéder à la page d'<a href="admin.php">Administration</a>.</p>

			<?php
		}


		else if(isset($_SESSION['user']) && !empty($_SESSION['user']['login'])){
			foreach($_SESSION['user'] as $value){
				$pre[]=$value;
			}
			var_dump($pre);
		?>
			<form method="post" action="profil.php">
				<label for="login">Login : </label>
				<input type="text" id="login" name="login" value= <?php echo $pre[0]?> required>
				<label for="password">Mot de passe :</label>
				<input type="password" id="password" name="password" value= <?php for($i=0;$i<strlen($pre[1]);$i++){echo "*";}?> required>
				<label for="nom">Nom : </label>
				<input type="text" id="nom" name="nom" value=<?php echo $pre[3]?> required>
				<label for="prenom">Prénom : </label>
				<input type="text" id="prenom" name="prenom" value=<?php echo $pre[2]?> required>
				<input type="submit" value="Envoyer">
			</form>
		<?php
		}

		else{
			echo "Vous devez d'abord vous connecter pour accéder à cette page.<br>";?><a href="connexion.php">Connexion</a><?php echo ".";
		}
	$connect->close();
	?>
		
	</body>
</html>