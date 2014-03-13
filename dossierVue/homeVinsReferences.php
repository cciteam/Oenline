<?php
?>
<aside> 
	<ul>
		<li> <a href = "home.php?section='vinsReferences'&"...""> </a> </li>
		<li> <a href = "home.php?section='vinsReferences'&typeCours = 'Cépages'"> </a> </li>
		<li> <a href = "home.php?section='vinsReferences'&typeCours = 'Appelation'"> </a> </li>
	</ul>
</aside>

<section>
	<?php
		if isset($_GET['typeCours']){
			$cours = require (afficherCours ($_GET['typeCours'])); /*resultat = contenu de l'adresse url obtenu via la fonction trouverCours*/
			require $cours->urlCours;
		}
		else{
			echo "Veuillez choisir un type de cours";
		}
	?>
</section>	