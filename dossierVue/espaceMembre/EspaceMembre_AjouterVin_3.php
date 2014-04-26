<?php ob_start() ?>
<form action = "home.php?Section=EspaceMembre&Affichage=AjouterUnVin&Page=3" method = "POST">
	<p id = "descCourte"><b>Votre commentaire de dégustation : </b><br/>
	<textarea name = "descLongue" rows = '20' cols = '28'></textarea>
	</p>
	<p id = "descCourte"><b>Donnez une description courte du vin : </b><br/>
	<textarea name = "descCourte" rows = '20' cols = '28'></textarea>
	</p>
	<p class = "clear"></p>
	<p class = "error"><?php echo $error_enregistrement;?></p>
	<input type = "submit" name = "Val_page3" value = "Valider l'enregistrement du vin">
</form>
<?php $contenu_ajouterVin = ob_get_clean();?>