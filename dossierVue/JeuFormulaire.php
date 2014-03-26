<?php ob_start(); ?>
		<aside id = "Jeu"> 
		<!--
		aside affiche un récapitulatif du vin sur lequel la partie porte 
		-->
			<div id = "Jeu">
				<h3><?php echo $vin->nomVin;?></h3><br><hr>
				<p>Millésime : <?php echo $vin->millesime;?><br><br>
				Domaine : <?php echo $domaine[0]->nomDomaine;?><br><br>
				Appellation : <?php echo $appellation[0]->nomAppellation;?><br><br>
				Type de vin : <?php echo $couleur[0]->nomTypeVin;?><br><br>
				Cépage : <ul>
				<?php
				foreach ($cepages as $cep){
					echo "<li>".$cep->nomCepage."</li>";}?>
				</ul>	
			</div>
		</aside>
		<section>
			<h3> Votre dégustation de <?php echo $vin->nomVin;?> proposé par <?php echo $domaine[0]->nomDomaine;?></h3>
			<form action = 'home.php?Section=Jeu&idVinJeu=<?php echo $idVinJeu;?>' method = 'POST'>
				<fieldset><legend> La robe : </legend>
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
								echo "<input type='checkbox' name='Robe[]' value ='".serialize($r)."'>".$r->nomRobe."<br>";
							}
							?>
					</div>
				</fieldset>
				<fieldset><legend> Le nez : </legend>
					<?php $typeNez = $nez[1]->typeNez;?>
					<div class = 'affichage_formulaire'>
						<br>
						<h4><input type='checkbox' name='Nez[]' value ='<?php echo serialize($nez[0]);?>'><?php echo $nez[0]->nomNez; ?></h4>
						<?php
						for ($i = 1; $i< count($nez); $i++){
							if ($nez[$i]->typeNez != $typeNez){
								$typeNez = $nez[$i]->typeNez;
								echo "</div>";
								echo "<div class = 'Affichage_formulaire'>";
								echo "<br>";
								echo "<h4><input type='checkbox' name='Nez[]' value ='".serialize($nez[$i])."'>".$nez[$i]->nomNez."</h4>";
							}
							else {
								echo "<input type='checkbox' name='Nez[]' value ='".serialize($nez[$i])."'>".$nez[$i]->nomNez."<br>";
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
								echo "<h4><input type='checkbox' name='Bouche[]' value ='".serialize($bouches[0])."'>".$bouches[0]->nomBouche."</h4><br>";
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
										<h4><input type='checkbox' name='Bouche[]' value ='<?php echo serialize($bouches[$i])?>'><?php echo $bouches[$i]->nomBouche;?></h4><br>
							<?php
									}
									else {
										echo "<input type='checkbox' name='Bouche[]' value ='".serialize($bouches[$i])."'>".$bouches[$i]->nomBouche."<br>";
									}
								}
								else if ($bouches[$i]->typeDescBouche!= $typeDescBouche){
									$typeDescBouche = $bouches[$i]->typeDescBouche;?>
									</div>
									<div class = 'Affichage_formulaire'>
									<br>
									<h4><?php echo $typeDescBouche;?></h4>
									<input type='checkbox' name='Bouche[]' value ='<?php echo serialize($bouches[$i]);?>'><?php echo $bouches[$i]->nomBouche;?><br>
							<?php
								}
								else {
									echo "<input type='checkbox' name='Bouche[]' value ='".serialize($bouches[$i])."'>".$bouches[$i]->nomBouche."<br>";
								}
							}?>
						</div>
					</div>
				</fieldset>
				<fieldset><legend> Votre avis : </legend>
					<textarea name='AvisMembre' rows = '20' cols = '28'></textarea>
				</fieldset>
				<input type = 'hidden' name = 'vin' value = '<?php echo base64_encode(serialize($vin));?>'>
				<input type='submit' name='ValiderDegust' value='Valider la dégustation'>
			</form>
		</section>
<?php $contenu = ob_get_clean(); ?>