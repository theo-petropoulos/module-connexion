<!DOCTYPE html>

<html lang="fr">
	<head>
		<title>Profil</title>
		<meta http-equiv="Content-Type" charset="UTF-8" lang="fr">
	</head>

	<body>
		<?php
		$connect=mysqli_connect('localhost', 'root', '', 'moduleconnexion');

		if($_COOKIE['user']['login']=='admin'){

			?>
			<p>Accéder à la page d'<a href="admin.php">Administration</a>.</p>

			<?php
		}


		else{
		?>
			<form method="post" action="inscription.php">
				<label for="login">Login : </label>
				<input type="text" id="login" name="login" placeholder="$pre_login" required>
				<label for="password">Mot de passe :</label>
				<input type="password" id="password" name="password" placeholder="$pre_password" required>
				<label for="nom">Nom : </label>
				<input type="text" id="nom" name="nom" placeholder="$pre_nom" required>
				<label for="prenom">Prénom : </label>
				<input type="text" id="prenom" name="prenom" placeholder="$pre_prenom" required>
				<input type="submit" value="Envoyer">
			</form>
		<?php
		}
	$connect->close();
	?>
		
	</body>
</html>