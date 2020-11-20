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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" charset="UTF-8" lang="fr">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Geo&display=swap" rel="stylesheet"> 
		<link href="module.css" rel="stylesheet">
		<script src="https://kit.fontawesome.com/9ddb75d515.js" crossorigin="anonymous"></script>
	</head>

	<body id="body_index">
		<?php
			if(isset($_SESSION['user'])){
				?>
				<main id="main_index">
					<section id="profile_box">
						<div id="profile_avatar">
							<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtaP7gKVpGnTINLck7ck3ytui9eypzjfzhqg&usqp=CAU">
						</div>
						<a href="profil.php">Profil</a><br>
						<form method="post" action="index.php">
							<input type="checkbox" hidden checked name="disconnect" id="disconnect">
							<input type="submit" value="Déconnecter">
						</form>
					</section>
					<section id="block_index">
						<div id="banner_index">
							<img src="https://file1.elleadore.com/var/elleadore/storage/images/article/pourquoi-je-deteste-les-teletubbies-40438/413102-1-fre-FR/Pourquoi-je-deteste-les-Teletubbies.jpg">
						</div>
						<article id="article_index">
							<h2>Bienvenue sur le repaire secret des adorateurs des Teletubbies</h2>
							<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
						</article>
					</section>
				</main>
				<?php
			}


			else{
				?>
				<section id="index_nologin">
					<p>Vous n'êtes <strong>pas</strong> le bienvenu.<br>
					Identification <strong>immédiate</strong> requise.<br><br>
					<a href="inscription.php">Inscription</a><br>
					<a href="connexion.php">Connexion</a><br>
					<span id="fakelink">On me donne pas d'ordre à moi</span><br></p>
				</section>
				<?php
			}
	
		$connect->close();
	?>
	</body>
</html>