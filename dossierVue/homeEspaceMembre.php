<?php
?>
<aside> 
	<ul>
		<li> <a href = "home.php?section = 'EspaceMembre' & recherche = '...'"> </a> </li>
		<li> <a href = "home.php?section = 'EspaceMembre' & recherche = 'mesCoordonnees'"> </a> </li>
		<li> <a href = "home.php?section = 'EspaceMembre' & recherche = 'maSelection'"> </a> </li>
		<li> <a href = "home.php?section = 'EspaceMembre' & recherche = 'accederJeu'"> </a> </li>
	</ul>
</aside>

<section>
	<?php
		if isset($_GET['recherche']){
			$EspaceMembre = require (afficherVin ($_GET['recherche'])); /*resultat = contenu de l'adresse url obtenu via la fonction trouverCours*/
			require $EspaceMembre->urlEspaceMembre; /*urlJeu = page html sur lequel figure le texte à afficher*/
		}
		else{
			echo "Veuillez choisir une option dans le menu à gauche";
		}
	?>
</section>	