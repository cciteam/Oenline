<?php ob_start();
?>
<aside id="Cours"> 
	<ul>
		<li> <a href = "home.php?Section=Cours&typeCours=degustation"> Dégustation </a> </li>
		<li> <a href = "home.php?Section=Cours&typeCours=cepage"> Cépage </a> </li>
		<li> <a href = "home.php?Section=Cours&typeCours=appellation"> Appellation </a> </li>
	</ul>
</aside>

<section>
	<?= $contenu_section_cours; ?>
	
</section>	
<?php $contenu = ob_get_clean();
?>
