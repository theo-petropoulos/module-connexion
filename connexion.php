<?php
	session_start();
	$connect=mysqli_connect('localhost', 'root', '', 'moduleconnexion');
?>

<!DOCTYPE html>

<html lang="fr">
	<head>
		<title>Connexion</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Geo&display=swap" rel="stylesheet"> 
		<link rel="stylesheet" href="module.css?v=<?php echo time(); ?>">
		<script src="https://kit.fontawesome.com/9ddb75d515.js" crossorigin="anonymous"></script>
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
						?>
						<section class="mess_connexion"><p><?php
						echo "Identifiant ou mot de passe incorrect.<br>";?> <a href="connexion.php">Réessayez</a><br><a href="">Mot de passe oublié ?</a>
						</p></section>
						<?php
						exit();
					}

					else{
						if($login==$user['login']){
							if($password==$user['password']){
								?><section class="mess_connexion"><p><?php
								echo "Vous êtes maintenant connecté. <br>";?> <a href="index.php">Accueil</a>
								</p></section><?php
								$_SESSION['user']=['login'=>$user['login'], 'password'=>$user['password'], 'nom'=>$user['nom'], 'prenom'=>$user['prenom']];
								exit();
							}
							else{
								?>
								<section class="mess_connexion"><p><?php
								echo "Mot de passe incorrect.<br>";?> <a href="connexion.php">Réessayez</a><br><a href="">Mot de passe oublié ?</a>
								</p></section>
								<?php
								exit();
							}
						}
					}

				}

				else{
			?>
			<section id="form">
				<form method="post" action="connexion.php">
					<label for="login">Login :</label>
					<input type="text" id="login" name="login" placeholder="Ex: John-Doe68" required>
					<label for="password">Mot de passe :</label>
					<input type="password" id="password" name="password" required>
					<input type="submit" id="submitbutton" value="Envoyer">
				</form>
			</section>

			<div id="back2index"><p>Retour à l' <a href="index.php">Accueil</a></p></div>
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