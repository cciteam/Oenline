<?php ob_start(); ?>
		<aside id = "Jeu"> 
		<!--
		aside affiche un récapitulatif du vin sur lequel la partie porte 
		-->		
				<?php if (ISSET($error_trouver_vin_par_id)){?>
					<p></p>
				<?php } else { ?>
					<h3><?php echo $vin->nomVin;?></h3><br><hr>
					<span>Millésime : <?php echo $vin->millesime;?></span><br><br>
					<span>Domaine : <?php echo $domaine[0]->nomDomaine;?></span><br><br>
					<span>Appellation : <?php echo $appellation[0]->nomAppellation;?></span><br><br>
					<span>Type de vin : <?php echo $couleur[0]->nomTypeVin;?></span><br><br>
					Cépage : <ul>
						<?php
						foreach ($cepages as $cep){
							echo "<li>".$cep->nomCepage."</li>";}?>
					</ul>
				<?php } ?>
		</aside>
		<section>
			<?php if (ISSET($error_trouver_vin_par_id)){
				echo $error_trouver_vin_par_id;
			}
			else {
				if (!empty($error_jeu)) {echo "<p class = 'error'>".$error_jeu."</p>";}?>
				<h3> Votre dégustation de <?php echo $vin->nomVin;?> proposé par <?php echo $domaine[0]->nomDomaine;?></h3>
				<form action = 'home.php?Section=Jeu&amp;idVinJeu=<?php echo $idVinJeu;?>' method = 'POST'>
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
										echo "<div class = 'affichage_formulaire'>";
										echo "<br>";
										echo "<h4>".$typeRobe."</h4>";
									}
									echo "<input type='checkbox' name='Robe[]' value ='".base64_encode(serialize($r))."'>".$r->nomRobe."<br>";
								}
								?>
						</div>
					</fieldset>
					<fieldset><legend> Le nez : </legend>
						<?php $typeNez = $nez[1]->typeNez;?>
						<div class = 'affichage_formulaire'>
							<br>
							<h4><input type='checkbox' name='Nez[]' value ='<?php echo base64_encode(serialize($nez[0]));?>'><?php echo $nez[0]->nomNez; ?></h4>
							<?php
							for ($i = 1; $i< count($nez); $i++){
								if ($nez[$i]->typeNez != $typeNez){
									$typeNez = $nez[$i]->typeNez;
									echo "</div>";
									echo "<div class = 'affichage_formulaire'>";
									echo "<br>";
									echo "<h4><input type='checkbox' name='Nez[]' value ='".base64_encode(serialize($nez[$i]))."'>".$nez[$i]->nomNez."</h4>";
								}
								else {
									echo "<input type='checkbox' name='Nez[]' value ='".base64_encode(serialize($nez[$i]))."'>".$nez[$i]->nomNez."<br>";
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
									echo "<h4><input type='checkbox' name='Bouche[]' value ='".base64_encode(serialize($bouches[0]))."'>".$bouches[0]->nomBouche."</h4><br>";
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
											<div class = 'affichage_formulaire'>
											<br>
											<h4><input type='checkbox' name='Bouche[]' value ='<?php echo base64_encode(serialize($bouches[$i]))?>'><?php echo $bouches[$i]->nomBouche;?></h4><br>
								<?php
										}
										else {
											echo "<input type='checkbox' name='Bouche[]' value ='".base64_encode(serialize($bouches[$i]))."'>".$bouches[$i]->nomBouche."<br>";
										}
									}
									else if ($bouches[$i]->typeDescBouche!= $typeDescBouche){
										$typeDescBouche = $bouches[$i]->typeDescBouche;?>
										</div>
										<div class = 'affichage_formulaire'>
										<br>
										<h4><?php echo $typeDescBouche;?></h4>
										<input type='checkbox' name='Bouche[]' value ='<?php echo base64_encode(serialize($bouches[$i]));?>'><?php echo $bouches[$i]->nomBouche;?><br>
								<?php
									}
									else {
										echo "<input type='checkbox' name='Bouche[]' value ='".base64_encode(serialize($bouches[$i]))."'>".$bouches[$i]->nomBouche."<br>";
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
			<?php } ?>
		</section>
<?php $contenu = ob_get_clean(); ?>