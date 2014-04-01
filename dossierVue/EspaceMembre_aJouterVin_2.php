<?php ob_start(); ?>
<form action = 'home.php?Section=EspaceMembre&Affichage=AjouterUnVin&Page=2' method = "POST">
	<fieldset>
		<legend> La robe : </legend>
		<?php $typeRobe = $robes[1]->typeRobe;?>
		<div class = 'affichage_formulaire'>
			<br>
			<h4><?php echo $typeRobe;?></h4>
				<?php 
				foreach ($robes as $r){
					if ($r->typeRobe != $typeRobe){
						$typeRobe = $r->typeRobe;
						echo "</div>";
						echo "<div class = 'Affichage_formulaire'>";
						echo "<br>";
						echo "<h4>".$typeRobe."</h4>";
					}
					echo "<input type='checkbox' name='new_robes[]' value ='".base64_encode(serialize($r))."'>".$r->nomRobe."<br>";
				}
				?>
		</div>
	</fieldset>
	<fieldset><legend> Le nez : </legend>
		<?php $typeNez = $nez[1]->typeNez;?>
		<div class = 'affichage_formulaire'>
			<br>
			<h4><input type='checkbox' name='new_nez[]' value ='<?php echo base64_encode(serialize($nez[0]));?>'><?php echo $nez[0]->nomNez; ?></h4>
			<?php
			for ($i = 1; $i< count($nez); $i++){
				if ($nez[$i]->typeNez != $typeNez){
					$typeNez = $nez[$i]->typeNez;
					echo "</div>";
					echo "<div class = 'Affichage_formulaire'>";
					echo "<br>";
					echo "<h4><input type='checkbox' name='new_nez[]' value ='".base64_encode(serialize($nez[$i]))."'>".$nez[$i]->nomNez."</h4>";
				}
				else {
					echo "<input type='checkbox' name='new_nez[]' value ='".base64_encode(serialize($nez[$i]))."'>".$nez[$i]->nomNez."<br>";
				}
			}
			?>
		</div>
	</fieldset>
	<fieldset><legend> La bouche : </legend>
		<?php
		$typeDescBouche = $bouches[0]->typeDescBouche;
		$typeBouche = $bouches[0]->typeBouche;
		?>
		<div class = 'typeBouche'>
			<h3><?php echo $typeBouche;?></h3>
			<div class = 'affichage_formulaire'>
				<?php
				if ($typeBouche == "Arômes"){
					echo "<br>";
					echo "<h4><input type='checkbox' name='new_bouches[]' value ='".base64_encode(serialize($bouches[0]))."'>".$bouches[0]->nomBouche."</h4><br>";
				}
				for ($i = 1; $i< count($bouches); $i++){
					if ($bouches[$i]->typeBouche != $typeBouche){
						$typeBouche = $bouches[$i]->typeBouche;?>
						</div>
						<div class = 'clear'></div>
						</div>
						<div class = 'typeBouche'>
						<h3><?php echo $typeBouche;?></h3>
						<div>
				<?php 
					}
					if ($typeBouche == "Arômes"){
						if ($bouches[$i]->typeDescBouche!= $typeDescBouche){
							$typeDescBouche = $bouches[$i]->typeDescBouche;?>
							</div>
							<div class = 'Affichage_formulaire'>
							<br>
							<h4><input type='checkbox' name='new_bouches[]' value ='<?php echo base64_encode(serialize($bouches[$i]))?>'><?php echo $bouches[$i]->nomBouche;?></h4><br>
				<?php
						}
						else {
							echo "<input type='checkbox' name='new_bouches[]' value ='".base64_encode(serialize($bouches[$i]))."'>".$bouches[$i]->nomBouche."<br>";
						}
					}
					else if ($bouches[$i]->typeDescBouche!= $typeDescBouche){
						$typeDescBouche = $bouches[$i]->typeDescBouche;?>
						</div>
						<div class = 'Affichage_formulaire'>
						<br>
						<h4><?php echo $typeDescBouche;?></h4>
						<input type='checkbox' name='new_bouches[]' value ='<?php echo base64_encode(serialize($bouches[$i]));?>'><?php echo $bouches[$i]->nomBouche;?><br>
				<?php
					}
					else {
						echo "<input type='checkbox' name='new_bouches[]' value ='".base64_encode(serialize($bouches[$i]))."'>".$bouches[$i]->nomBouche."<br>";
					}
				}?>
			</div>
		</div>
	</fieldset>
	<p class = "error"><?php echo $error_enregistrement;?></p>
	<input type = "submit" name = "Val_page2" value = "Suivant">
</form>
<?php $contenu_ajouterVin = ob_get_clean();?>