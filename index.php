<?php
	session_start();
	$connect=mysqli_connect('localhost', 'root', '', 'moduleconnexion');

	if(isset($_POST['disconnect']) && $_POST['disconnect']){
		session_destroy();
		header("Refresh:0");
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
			if(isset($_SESSION['user'])){
				echo "ça marche";
			}


			else{
			echo "pas de session";
			}
	
		if(isset($_SESSION['user'])){
			?>
			<a href="profil.php">Profil</a><br>
			<form method="post" action="index.php">
				<input type="checkbox" hidden checked name="disconnect" id="disconnect">
				<input type="submit" value="Déconnecter">
			</form>
			<?php
		}

		if(!isset($_SESSION['user'])){
			?>
			<a href="inscription.php">Inscription</a>
			<a href="connexion.php">Connexion</a><br>
			<?php
		}
		$connect->close();
	?>
	</body>
</html>