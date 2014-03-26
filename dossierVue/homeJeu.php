<?php
?>
<aside> 
	<ul>
		<li> <a href = "home.php?section = 'jeu'& recherche = 'jeu'"> </a> </li>
		<li> <a href = "home.php?section = 'jeu'& recherche = 'regleJeu'"> </a> </li>
		<li> <a href = "home.php?section = 'jeu'& recherche = 'seConnecter'"> </a> </li>
	</ul>
</aside>

<section>
	<?php
		if isset($_GET['recherche']){
			$jeu = require (afficherVin ($_GET['recherche'])); /*resultat = contenu de l'adresse url obtenu via la fonction trouverCours*/
			require $jeu->urlJeu; /*urlJeu = page html sur lequel figure le texte à afficher*/
		}
		else{
			echo "Veuillez choisir une option dans le menu à gauche";
		}
	?>
</section>	