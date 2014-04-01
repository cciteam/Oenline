<?php ob_start() ?>
<form action = "home.php?Section=EspaceMembre&Affichage=AjouterUnVin&Page=3" method = "POST">
	<p><b>Votre commentaire de dégustation : </b>
	<textarea name = "descLongue"></textarea>
	</p>
	<p><b>Donnez une description courte du vin : </b>
	<textarea name = "descCourte"></textarea>
	</p>
	<p class = "error"><?php echo $error_enregistrement;?></p>
	<input type = "submit" name = "Val_page3" value = "Valider l'enregistrement du vin">
</form>
<?php $contenu_ajouterVin = ob_get_clean();?>