<?php ob_start(); ?>
	<aside id= "RechVin"> 
		<div id = "RechVin2">
			<fieldset>
				<legend>Rechercher par appellation : </legend>
				<form action = "home.php" method = "GET">
					<p>
						<select name= "parametre">
							<?php
								foreach ($appellations as $app){
									echo '<option value ="'.base64_encode(serialize($app)).'" >'.$app->nomAppellation.'</option>';
								}
							?>
						</select><br/>
						<input type = "hidden" name = "Section" value = "VinsReferences">
						<label><input type= "submit" name = "Rechercher_par_appellation" value = "Rechercher"></label>
					</p>
				</form>
			</fieldset>
			<fieldset>
				<legend>Rechercher par cépage : </legend>
				<form action = "home.php" method = "GET">
					<p>
						<select name= "parametre">
							<?php
								foreach ($cepages_tout as $cep){
									echo '<option value = "'.base64_encode(serialize($cep)).'">'.$cep->nomCepage.'</option>';
								}
							?>
						</select><br/>
						<input type = "hidden" name = "Section" value = "VinsReferences">
						<label><input type= "submit" name = "Rechercher_par_cepage" value = "Rechercher"></label>
					</p>
				</form>
			</fieldset>
			<fieldset>
				<legend>Rechercher par couleur de vin : </legend>
				<form action = "home.php" method = "GET">
					<p>
						<select name= "parametre">
							<?php
								foreach ($couleurs as $col){
									echo '<option value = "'.base64_encode(serialize($col)).'">'.$col->nomTypeVin.'</option>';
								}
							?>
						</select><br/>
						<input type = "hidden" name = "Section" value = "VinsReferences">
						<label><input type= "submit" name = "Rechercher_par_couleur" value = "Rechercher"></label>
					</p>
				</form>
			</fieldset>
			<fieldset>
				<legend>Rechercher par nom de domaine : </legend>
				<form action = "home.php" method = "GET">
					<p>
						<input type= "text" name = "parametre"><br/>
						<input type = "hidden" name = "Section" value = "VinsReferences">
						<label><input type= "submit" name = "Rechercher_par_nomDomaine" value = "Rechercher"></label>
					</p>
				</form>
			</fieldset>
			<fieldset>
				<legend>Rechercher par nom de vin : </legend>
				<form action = "home.php" method = "GET">
					<p>
						<input type= "text" name = "parametre"><br/>
						<input type = "hidden" name = "Section" value = "VinsReferences">
						<label><input type= "submit" name = "Rechercher_par_nomVin" value = "Rechercher"></label>
					</p>
				</form>
			</fieldset>
		</div>
	</aside>
	<section>
		<div id = "ContenuVinsRef">
			<?php  
			if (!isset($parametre)){
					echo "<p> Veuillez renseigner un paramètre pour votre recherche </p>";
				}
				else {	?>
				<h2> Nos résultats pour votre recherche de vins <?php echo (($recherche=="appellation")?"d'":"de ").$recherche." ".$rech_param;?></h2>							
				<?php 
					if (isset($error_rech_vin)){
						echo "<p class = 'error'>".$error_rech_vin."</p>";
					}
					else {
						for($i = 0; $i<count($affichage_vins); $i++){?>
							<div class = 'Domaine'>
								<h3><a href = 'home.php?Section=VinsReferences&Rechercher_par_nomDomaine=Rechercher&parametre=<?php echo $affichage_vins[$i]['domaine']->nomDomaine;?>'>
									<?php echo $affichage_vins[$i]['domaine']->nomDomaine;?></a></h3>
								<?php
									for ($j = 0; $j<count($affichage_vins[$i]['vins']); $j++){?>
										<article>
											<div class = "titre_ref">
												<label><?php echo $affichage_vins[$i]['vins'][$j]['vin']->nomVin;?>, millésime <?php echo $affichage_vins[$i]['vins'][$j]['vin']->millesime;?></label>
											</div>
											<hr/>
											<div class = "donneesVin">
												<p class = "jouer">
													<a href = "home.php?Section=Jeu&idVinJeu=<?php echo $affichage_vins[$i]['vins'][$j]['vin']->idVin;?>">Jouer avec ce vin</a>
												</p>
												<p><?php echo $affichage_vins[$i]['domaine']->nomDomaine;?><br>
													<a href = "<?php echo $affichage_vins[$i]['domaine']->urlDomaine;?>">url du domaine.</a><br/>
													Numero du vin : <?php echo  $affichage_vins[$i]['vins'][$j]['vin']->idVin;?><br>
													Appellation : <?php echo $affichage_vins[$i]['vins'][$j]['appellation']->nomAppellation;?><br>
													Type de vin : <?php echo  $affichage_vins[$i]['vins'][$j]['typeVin']->nomTypeVin;?><br>
													Cépages : <?php echo  $affichage_vins[$i]['vins'][$j]['cepage'][0]->nomCepage;
													for ($k = 1; $k<count( $affichage_vins[$i]['vins'][$j]['cepage']); $k++){
														echo ', '.utf8_encode( $affichage_vins[$i]['vins'][$j]['cepage'][$k]->nomCepage);
														}?>
													<br>
													Description : <?php echo $affichage_vins[$i]['vins'][$j]['vin']->descCourte;?>
												</p>
											</div>
										</article>
									<?php } ?>
							</div>
						<?php 
						} 
					} 
				}?>
		</div>
	</section>			
<?php $contenu = ob_get_clean(); ?>