<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Vin, dégustation, jeu, cours"/>
		<meta name="description" content="Dans ce site web vous pourrez apprendre à déguster du vin en lisant nos cours ou en jouant à notre jeu de dégustation."/>
		<title>Oenline</title>
		<link rel="stylesheet" type="text/css" href="dossierVue/Oenline.css"/>
		<link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'/>
		<link href='http://fonts.googleapis.com/css?family=Oregano' rel='stylesheet' type='text/css'/>
		<link href='http://fonts.googleapis.com/css?family=Over+the+Rainbow' rel='stylesheet' type='text/css'/>
		<link rel="icon" href="Images/favicon.ico" />
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
					<p><a href = "http://oenline.host56.com/fiches/acceuil.htm"> Lien vers la partie génie logiciel </a></p>
					<p> Merci pour votre visite, nous espérons que vous vous êtes bien amusés en apprenant la dégustation!</p>
				</footer>
			</div>
		</div> 
	</body>
</html>