<?php ob_start();
?>
<aside id="Cours"> 
	<ul>
		<li> <a href = "home.php?Section=Cours&amp;typeCours=degustation"> Dégustation </a> </li><br/><br/>
		<li> <a href = "home.php?Section=Cours&amp;typeCours=cepage"> Cépage </a> </li><br/><br/>
		<li> <a href = "home.php?Section=Cours&amp;typeCours=appellation"> Appellation </a> </li><br/><br/>
	</ul>
</aside>
<section>
	<?= $contenu_section_cours; ?>
	
</section>	
<?php $contenu = ob_get_clean();
?>