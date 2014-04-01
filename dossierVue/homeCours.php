<?php ob_start();
?>
<aside> 
	<ul>
		<li> <a href = "home.php?Section=Cours&typeCours=degustaion"> Dégustation </a> </li>
		<li> <a href = "home.php?Section=Cours&typeCours=cepage"> Cépage </a> </li>
		<li> <a href = "home.php?Section=Cours&typeCours=appelation"> Appellation </a> </li>
	</ul>
</aside>

<section>
	<?= $contenu_section_cours; ?>
	
</section>	
<?php $contenu = ob_get_clean();
?>
