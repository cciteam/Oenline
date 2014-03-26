<?php
?>
<aside> <!-- sous forme de plusieurs formulaires -->
	<ul>
		<li> <a href = "home.php?section = 'vinsReferences'& recherche = 'nomVin'"> </a> </li>
		<li> <a href = "home.php?section = 'vinsReferences'& recherche = 'typeVin'"> </a> </li>
		<li> <a href = "home.php?section = 'vinsReferences'& recherche = 'cepageVin'"> </a> </li>
		<li> <a href = "home.php?section = 'vinsReferences'& recherche = 'appellationVin'"> </a> </li>
		<li> <a href = "home.php?section = 'vinsReferences'& recherche = 'domaineVin'"> </a> </li>
	</ul>
</aside>

<section> <!-- affichage du résultat du controleur -->
	$resultatRecherche <!-- cette variable va afficher le résultat fourni par le controleur -->

	<?php
		require $resultatRecherche;
		}
		else{
			echo "Veuillez choisir un moyen de recherche de vin";
		}
	?>
</section>	