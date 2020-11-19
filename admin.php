<?php
	session_start();
	$connect=mysqli_connect('localhost', 'root', '', 'moduleconnexion');
?>

<!DOCTYPE html>

<html lang="fr">
	<head>
		<title>Profil</title>
		<meta http-equiv="Content-Type" charset="UTF-8" lang="fr">
	</head>

	<body>
		<?php
		if($_SESSION['user']['login']=='admin'){
			$db=$connect->query("SELECT * FROM utilisateurs");
			for($i=0; $i<mysqli_num_rows($db); $i++){
				$result=mysqli_fetch_assoc($db);
				var_dump($result);
			}
			echo "Retour à l'";?><a href="index.php">Accueil</a><?php echo ".";
		}

		else{
			die("Vous n'avez pas l'autorisation d'accéder à cette page.");
		}

		$connect->close();
		?>
		
	</body>
</html>