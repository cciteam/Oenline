<?php ob_start();?>
<h3> Ajouter un vin </h3>
<p class = "error"><?php echo $error_enregistrement;?></p>
<form action = 'home.php?Section=EspaceMembre&Affichage=AjouterUnVin&Page=1' method = 'POST' name = 'AjouterVinPage1'>
	<fieldset>
		<legend>Le domaine : </legend>
		<div class = "liste_deroulante">
			<span><b>Choisissez un domaine dans la liste : </b></span><br/>
			<select name = "new_domaine">
				<option></option>
				<?php
					foreach ($domaines as $dom) {
						echo '<option value = "'.base64_encode(serialize($dom)).'">'.$dom->nomDomaine.'</option>';
					}
				?>
			</select>
		</div>
		<div class = "ou"><b> ou </b></div>
		<div class = "ajout">
			<span>Ajouter un domaine :</span><br/>
			<label>Nom du domaine: </label><br/><input type = 'text' name = 'nom_dom'><br/>
			<label>url du domaine : </label><br/><input type = 'text' name = 'url_dom'><br/>
			<input type = 'submit' name = 'enregistrer_dom' value = 'Enregistrer'>
			<p class = "error"><?php echo $error_enregistrement_domaine;?></p>
		</div>
	</fieldset>
	<fieldset>
		<legend>L'appellation</legend>
		<div class = "liste_deroulante">
			<span>Choisissez une appellation <br/> la liste :</span><br/>
			<select name = "new_appellation">
				<option></option>
				<?php
					foreach ($appellations as $app) {
						echo '<option value = "'.base64_encode(serialize($app)).'">'.$app->nomAppellation.'</option>';
						}
				?>
			</select>
		</div>
		<div class = "ou"><b> ou </b></div>
		<div class = "ajout">
			<span>Ajouter une appellation :</span><br/>
			<label>Nom de l'appellation : </label><br/><input type = "text" name = "nom_app"><br/>
			<input type = "submit" name = "enregistrer_app" value = "Enregistrer">
			<p class = "error"><?php echo $error_enregistrement_appellation; ?></p>
		</div>
	</fieldset>
	<fieldset>
		<legend>Le ou les cépages :</legend>
		<span>Choisissez un ou des cépage(s) dans la liste :</span><br/><br/>
		<div class = "checkboxes">
			<?php
				foreach ($cepages as $cep) {
					echo '<input type = "checkbox" name = "Cepages[]" value = "'.base64_encode(serialize($cep)).'">'.$cep->nomCepage.'<br/>';
				}
			?>
		</div>
		<div class = "ajout">
			<br/><br/>
			<span>Ou jouter un cépage :</span><br/>
			<label>Nom du cépage : </label><br/><input type = "text" name = "nom_cep"><br/>
			<input type = "submit" name = "enregistrer_cep" value = "Enregistrer">
			<p class = "error"><?php echo $error_enregistrement_cepage; ?></p>
		</div>
	</fieldset>
	<fieldset>
		<legend>Le vin</legend>
		<label> Son nom : </label><input type = "text" name = "new_nomVin" value = "<?php echo $nomVin;?>"><br/>
		<label> Son millésime : </label><input type = "number" name ="new_millesime" min = "1900" max = "<?php echo date('Y');?>" value = "<?php echo $millesime;?>"> <br/>
		<label> Son type : </label>
			<?php foreach ($typesVins as $tv){ ?>
				<input type = "radio" name = "new_typeVin" value = "<?php echo base64_encode(serialize($tv));?>" > <?php echo $tv->nomTypeVin;?>
			<?php } ?>
	</fieldset>
	<input type = 'submit' name = 'Val_page1' value = 'Suivant'>
</form>
<?php $contenu_ajouterVin = ob_get_clean(); ?>