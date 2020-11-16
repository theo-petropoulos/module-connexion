<!DOCTYPE html>

<html lang="fr">
	<head>
		<title>Bonjour</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" lang="fr">
	</head>

	<body>
		<?php
			$connect=mysqli_connect('localhost', 'root', '');
			$db_create='CREATE DATABASE `module-connexion`';

			if($connect->query($db_create)){
				echo "Base de donnée crée<br>";
			}
			
			else{
				echo "Il y a eut une erreur<br>" . $connect->error;
			}



			$connect=mysqli_connect('localhost', 'root', '', 'module-connexion');
			

		?>
	</body>
</html>