<?php
	session_start();
	$connect=mysqli_connect('localhost', 'root', '', 'moduleconnexion');

	if(isset($_POST) && $_POST){
		$userid=$_POST['userid'];
		$nom=$_POST['nom'];$prenom=$_POST['prenom'];$login=$_POST['login'];$password=$_POST['password'];
		$connect->query("UPDATE utilisateurs SET login='$login', nom='$nom', prenom='$prenom', password='$password' WHERE id='$userid' ");
	}

?>

<!DOCTYPE html>

<html lang="fr">
	<head>
		<title>Profil</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Geo&display=swap" rel="stylesheet"> 
		<link rel="stylesheet" href="module.css?v=<?php echo time(); ?>">
		<script src="https://kit.fontawesome.com/9ddb75d515.js" crossorigin="anonymous"></script>
	</head>

	<body>
		<?php
		if($_SESSION['user']['login']=='admin'){
			$db=$connect->query("SELECT * FROM utilisateurs");
			for($i=0; $i<mysqli_num_rows($db); $i++){
				$result=mysqli_fetch_assoc($db);
				?>
				<main id="admin_forms">
					<form method="post" action="admin.php" >
						<label for="login">Login : </label>
						<input type="text" id="login" name="login" value= <?php echo $result['login']?> required>
						<label for="password">Mot de passe :</label>
						<input type="password" id="password" name="password" value= <?php for($k=0;$k<strlen($result['password']);$k++){echo "*";}?> required>
						<label for="nom">Nom : </label>
						<input type="text" id="nom" name="nom" value=<?php echo $result['nom']?> required>
						<label for="prenom">Prénom : </label>
						<input type="text" id="prenom" name="prenom" value=<?php echo $result['prenom']?> required>
						<input type="checkbox" name="userid" id="userid" hidden checked value=<?php echo $result['id'] ?> >
						<input type="submit" class="submit_admin" value="Envoyer">
					</form>
				</main>
				<?php
			}
			?><div id="back2index"><p>Retour à l' <a href="index.php">Accueil</a></p></div><?php
		}

		else{
			die("Vous n'avez pas l'autorisation d'accéder à cette page.");
		}

		$connect->close();
		?>
		
	</body>
</html>