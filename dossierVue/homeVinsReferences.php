<?php
$controleur = new ControleurOenline('127.0.0.1','root','','oenline');
$appellations = $controleur->trouverAppellations();
$cepages = $controleur->trouverCepages();
$couleurs = $controleur->trouverTypesVins();
?>
<?php ob_start(); ?>
	<div class="bg1">
		<div class="bg2">
			<aside> 
			<div class = "aside">
				<fieldset>
					<legend>Rechercher par appellation : </legend>
					<form action = <?php echo htmlspecialchars("home.php");?> method = "GET">
						<p>
							<select name= "parametre">
								<?php
									foreach ($appellations as $app){
										echo '<option>'.$app->nomAppellation.'</option>';
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
					<form action = <?php echo htmlspecialchars("home.php");?> method = "GET">
						<p>
							<select name= "parametre">
								<?php
									foreach ($cepages as $cep){
										echo '<option>'.$cep->nomCepage.'</option>';
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
					<form action = <?php echo htmlspecialchars("home.php");?> method = "GET">
						<p>
							<select name= "parametre">
								<?php
									foreach ($couleurs as $col){
										echo '<option>'.$col->nomTypeVin.'</option>';
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
					<form action = <?php echo htmlspecialchars("home.php");?> method = "GET">
						<p>
							<input type= "text" name = "parametre"><br/>
							<input type = "hidden" name = "Section" value = "VinsReferences">
							<label><input type= "submit" name = "Rechercher_par_nomDomaine" value = "Rechercher"></label>
						</p>
					</form>
				</fieldset>
				<fieldset>
					<legend>Rechercher par nom de vin : </legend>
					<form action = <?php echo htmlspecialchars("home.php");?> method = "GET">
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
				<?php
					if ($parametre != ""){
						if ($recherche == "appellation"){
							foreach ($appellations as $app){
								if ($app->nomAppellation == $parametre){
									$appellation = $app;
									break;
								}
							}						
							$vins = $controleur->trouverVinsParAppellation($appellation);
						}
						else if ($recherche == "cépage"){
							foreach ($cepages as $cep){
								if ($cep->nomCepage== $parametre){
									$cepage = $cep;
									break;
								}
							}				
							$vins = $controleur->trouverVinsParCepage($cepage);
						}
						
						else if ($recherche == "couleur") {
							foreach ($couleurs as $col){
								if ($col->nomTypeVin == $parametre){
									$couleur = $col;
									break;
								}
							}	
							$vins = $controleur->trouverVinsParTypeVin($couleur);
						}
						else if ($recherche == "domaine"){
							$vins = $controleur->trouverVinsParNomDeDomaine($parametre);}
						else if ($recherche == "nom"){
							$vins = $controleur->trouverVinsParNom($parametre);}
						else $vins = "Une erreur c'est produite, recommencez votre recherche.";
						echo "<h2> Nos résultats pour votre recherche de vins ".(($recherche=="appellation")?"d'":"de ").$recherche." ".$parametre."</h2>";
						$nomDomainePrecedant="";
						echo "<div>";
						foreach ($vins as $vin){
							$domaine = $controleur->trouverDomainesParVin($vin);
							$domaine = $domaine[0];
							if ($nomDomainePrecedant!=$domaine->nomDomaine){
								echo "</div>";
								echo "<div classe = 'Domaine'>";
								echo "<h3><a href = 'home.php?Section=VinsReferences&Rechercher_par_nomDomaine=Rechercher&parametre=".utf8_encode($domaine->nomDomaine)."'>";
								echo $domaine->nomDomaine."</a></h3>";
								$nomDomainePrecedant = $domaine->nomDomaine;}
							$cepages = $controleur->trouverCepagesParVin($vin);
							$typeVin = $controleur->trouverTypesVinsParVin($vin);
							echo '<article>';
							echo '<header>'.$vin->nomVin.', millésime '.$vin->millesime.'</header>';
							echo '<hr/>';
							echo '<p>'.$domaine->nomDomaine. '<br>';
							echo 'Type de vin : '.$typeVin[0]->nomTypeVin.'<br>';
							echo 'Cépages : ';
							echo $cepages[0]->nomCepage;
							for ($i = 1; $i<count($cepages); $i++){
								echo ', '.utf8_encode($cepages[$i]->nomCepage);
								}
							echo '<br>'.$vin->descCourte;
							echo '</p></article>';
						}
					}
				?>
			</section>	
			<div class = "clear"></div>
		</div>
	</div>
<?php $contenu = ob_get_clean(); ?>