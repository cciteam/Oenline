<?php 
	ob_start(); 
?>
<aside id = "EspaceMembre"> 		
	<div id = "asideEspaceMembre">
		<h4><a href = "home.php?Section=EspaceMembre&Affichage=MesCoordonnees" >Mes coordonnées </a></h4>
		<br/>
		<h4><a href = "home.php?Section=EspaceMembre&Affichage=MesParties">Mes parties jouées</a></h4>
		<?php if ($access_Admin){ ?>
			<br/>
			<h4><a href = "home.php?Section=EspaceMembre&Affichage=AjouterUnVin">Ajouter un vin</a></h4>
		<?php } ?>
	</div>
</aside>
<section>
	<!--
	
	-->
	<div id = "contenuEspaceMembre">
	<?php
		if ($affichage == "MesCoordonnees"){
	?>
			<h3> Mes Coordonnées </h3>
			<br>
			<p>
				<b>Mon nom : </b><?php echo $membre->nomMembre;?><br/>
				<b>Mon pseudo : </b><?php echo $membre->pseudoMembre;?><br/>
				<b>Mon adresse email : </b><?php echo $membre->mailMembre;?><br/>
				<b>Mon numéro de membre : </b><?php echo $membre->idMembre;?><br/>
				<b>Mon statut : </b><?php echo $groupe->nomGroupe ?><br/>
			</p>	
	<?php
		}
		else if ($affichage == "MesParties"){
			echo "<h3>Mes Parties</h3>";
			
			if (empty($parties[0])){
				echo "<p>";
				echo "Vous n'avez pas encore joué depuis votre inscription";
				echo "</p>";
			}
			else{
				foreach ($affichagePartie as $p){
	?>
					<article>
						<header><h5><?php echo $p['vin']->nomVin;?> millésime <?php echo $p['vin']->millesime;?><h5></header>
						<hr/>
						<section class = "affichagePartie">
							<div class = "descVin">	
								<p><?php echo $p['domaine']->nomDomaine;?><br>
									Numero du vin : <?php echo $p['vin']->idVin;?><br>
									Appellation : <?php echo $p['appellation']->nomAppellation;?><br>
									Type de vin : <?php echo $p['typeVin']->nomTypeVin;?><br>
									Cépages : <?php echo $p['cepages'][0]->nomCepage;
										for ($i = 1; $i<count($p['cepages']); $i++){
											echo ', '.utf8_encode($p['cepages'][$i]->nomCepage);
											}?>
								</p>
							</div>
							<div class = "descPartie">
								<p>Date de la partie : <?php echo $p['partie']->datePartie;?><br/>
								Score : <?php echo $p['partie']->scorePartie;?><br/>
								</p>
							</div>
						</section>
						<section class = "AffichageCommentairesEtCorrection">
							<p><b> Votre commentaire de dégustation : </b>
								<?php echo $p['partie']->commentairePartie; ?><br/>
							</p>
							<p><b> La description par notre oenlogue : </b>
								<br/> La robe : 
									<?php for($i = 0; $i<count($p['robes'])-1; $i++) {
										echo $p['robes'][$i]->nomRobe.", ";}
										echo $p['robes'][count($p['robes'])-1]->nomRobe.".";
									?>
								<br/>
								<br/> Le nez : 
									<?php for($i = 0; $i<count($p['nez'])-1; $i++) {
										echo $p['nez'][$i]->nomNez.", ";}
										echo $p['nez'][count($p['nez'])-1]->nomNez.".";
									?>
								<br/>
								<br/> La bouche : 
									<?php for($i = 0; $i<count($p['bouches'])-1; $i++) {
										echo $p['bouches'][$i]->nomBouche.", ";}
										echo $p['bouches'][count($p['bouches'])-1]->nomBouche.".";
									?>
							</p>
							<p><b> Le commentaire de dégustation de notre oenlogue : </b>
								<?php echo $p['vin']->descLongue;?><br/>
							</p>
							<br/>
							<br/>
							<br/>
						</section>
					</article>
		<?php
				}
			}
		}
		else if ($access_Admin and ($affichage == "AjouterUnVin")){
			/*include ('dossierVue/EscpaceMembre_AjouterVin_1.php');*/
			echo "<p>Ajouter un vin : en construction </p>";
		}
		?>				
	</div>
</section>

<?php $contenu = ob_get_clean(); ?>
