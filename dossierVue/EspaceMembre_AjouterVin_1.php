<?php ob_start();?>
<h3> Ajouter un vin </h3>
<form action = "" method = "POST">
	<fieldset>
		<legend>Le vin</legend>
		<label> Son nom : </label><input type = "text" name = "new_nomVin" value = "<?php echo $new_nomVin;?>">
		<label> Son millésime : </label><input type = "range" name ="new_millesime" min = "1900" max = "<?php echo date('Y');?>" value = "<?php echo $new_millesime;?>"> 
		<label> Son type : </label>
			<?php foreach ($typesVins as $tv){?>
				<input type = "radio" name = "new_typeVin" value = "<?php base64_encode(serialize($tv));?>"><?php echo $tv->nomTypeVin;?>
			<?php } ?>
	</fieldset>
	<fieldset>
		<legend>Le domaine : </legend>
		<div class = "liste_deroulante">
			<select name = "new_domaine">
				<option></option>
				<?php
			


			foreach ($domaines as $dom) {
						echo '<option value = "'.base64_encode(serialize($dom).'">'.$dom->nomDomaine().'</option>';
						}
				?>
				</div>
			</select>
		<p class = "error" >* <?php echo $err_choixDomaine;?></p>
		<div class = "ou"><b> Ou </b></div>
		<div class = "ajout">
			<?php if (!isset($add_domaine)){?>
				<form action = "home.php?Section=EspaceMembre&Affichage=AjouterUnVin" method = "POST">
					<input type = "submit" name = "add_Dom" value = "Ajouter un domaine">
				</form>
			<?php } else { ?>
				<form action = "home.php?Section=EspaceMembre&Affichage=AjouterUnVin" method = "POST">
					<label>Nom du domaine: </label><input type = "text" name = "nom_dom"><br/>
					<label>url du domaine : <label><input type = "text" name = "url_dom"><br/>
					<input type = "submit" name = "enregistrer_dom" value = "Enregistrer">
				</form>
			<?php } ?>
		</div>
	</fieldset>
	<fieldset>
		<legend>L'appellation</legend>
		<div class = "liste_deroulante">
			<select name = "new_appellation">
				<option></option>
				<?php
					foreach ($appellations as $app) {
						echo '<option value = "'.base64_encode(serialize($app).'">'.$app->nomAppellation().'</option>';
						}
				?>
				</div>
			</select>
		<p class = "error" >* <?php echo $err_choixAppellation;?></p>
		<div class = "ou"><b> Ou </b></div>
		<div class = "ajout">
			<?php if (!isset($add_appellation)){?>
				<form action = "home.php?Section=EspaceMembre&Affichage=AjouterUnVin" method = "POST">
					<input type = "submit" name = "add_App" value = "Ajouter une appellation">
				</form>
			<?php } else { ?>
				<form action = "home.php?Section=EspaceMembre&Affichage=AjouterUnVin" method = "POST">
					<label>Nom de l'appellation : </label><input type = "text" name = "nom_app"><br/>
					<input type = "submit" name = "enregistrer_app" value = "Enregistrer">
				</form>
			<?php } ?>
		</div>
	</fieldset>
	<fieldset>
		<legend>Le ou les cépages :</legend>
		<div class = "checkboxes">
			<?php
				foreach ($cepages as $cep) {
					echo '<input type = "checkbox" name = "Cepages[]" value = "'.base64_encode(serialize($cep).'">'.$cep->nomCepage();
					}
			?>
			<p class = "error" >* <?php echo $err_choixCepages;?></p>
		</div>
		<div class = "ou"><b> Ou </b></div>
		<div class = "ajout">
			<?php if (!isset($add_cepage)){?>
				<form action = "home.php?Section=EspaceMembre&Affichage=AjouterUnVin" method = "POST">
					<input type = "submit" name = "add_Cep" value = "Ajouter un cépage">
				</form>
			<?php } else { ?>
				<form action = "home.php?Section=EspaceMembre&Affichage=AjouterUnVin" method = "POST">
					<label>Nom du cépage : </label><input type = "text" name = "nom_app"><br/>
					<input type = "submit" name = "enregistrer_app" value = "Enregistrer">
				</form>
			<?php } ?>
		</div>
	</fieldset>
<input type = "submit" name = "Val_page1" value = "Suivant">


			
		
<?php $contenu = ob_get_clean(); ?>
