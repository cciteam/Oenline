<!doctype html>
  <html>
    <head>
      <meta charset="utf-8">
      <title>Oenline</title>
      <link rel="stylesheet" type="text/css" href="dossierVue/Oenline.css">
      <link href='http://fonts.googleapis.com/css?family=Over+the+Rainbow' rel='stylesheet' type='text/css'>
    </head>
    <body>
      <header>
		<div class = "connexion">
			non connecté
			<?/*= $contenu_connexion */?>
		</div>
	    <div class = "titre">
			<a href = "Oenline.php" ><img src = "Images/LogoOenline.png" alt = "logo Oenline"></a>
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
        <a href = "#"> Nous contacter </a>
        <p> Merci pour votre visite, nous espérons que vous vous êtes bien amusés en apprenant la dégustation!</p>
      </footer>

    </div> <!-- #global -->
  </body>
</html>
