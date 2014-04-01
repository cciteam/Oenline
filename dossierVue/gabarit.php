<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Oenline</title>
		<link rel="stylesheet" type="text/css" href="dossierVue/Oenline.css">
		<link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Oregano' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Over+the+Rainbow' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id=<?php echo "'bg".$Section."'";?>>
			<div id = "content">
				<header>
					<div class = "connexion">
						<?= $contenu_connexion ?>
					</div>
					<div class = "titre">
						<a href = "home.php" ><img src = "Images/LogoOenline.png" alt = "logo Oenline"></a>
						<h2> Aurez- vous 20 sur vin? </h2>
					</div>
					<div class="clear"></div>
				</header>
				<nav>
					<?= $navigation ?> <!--insère ici la barre de navigation suivant la section active-->
				</nav>
				<div id="contenu">
					<?= $contenu ?>   <!-- Élément spécifique -->
				</div>
				<footer>
					<p></p>
					<h3> L'ABUS D'ALCOOL EST DANGEREUX POUR LA SANTE </h3>
					<p><a href = ""> Lien vers la partie génie logiciel </a></p>
					<p> Merci pour votre visite, nous espérons que vous vous êtes bien amusés en apprenant la dégustation!</p>
				</footer>
			</div>
		</div> 
	</body>
</html>
