<?php ob_start(); ?>
			<aside id = "Jeu"> 
			<!--
			aside affiche un récapitulatif du vin sur lequel la partie porte 
			-->
					<h3><?php echo $vin->nomVin;?></h3><br><hr>
					<p><span>Millésime : <?php echo $vin->millesime;?></span><br><br>
					<span>Domaine : <?php echo $domaine[0]->nomDomaine;?></span><br><br>
					<span>Appellation : <?php echo $appellation[0]->nomAppellation;?></span><br><br>
					<span>Type de vin : <?php echo $couleur[0]->nomTypeVin;?></span><br><br>
					<span>Cépage : <ul>
					<?php
					foreach ($cepages as $cep){
						echo "<li>".$cep->nomCepage."</li>";}?>
					</span></ul>	
			</aside>
			<section>
				<h3> Les résultats de votre de dégustation du vin <?php echo $vin->nomVin;?> proposé par <?php echo $domaine[0]->nomDomaine;?></h3>
				<br><p> Vous avez obtenu pour cette dégustation un score de <?php echo round($partie->scorePartie,2);?>/20. <p><br>
				<div id = 'results'>
					<div id = 'ResJeu'>
						<h4>Vos réponses : </h4>
						<b> La robe :</b>
						<ul>
						<?php
							foreach ($robess as $r){
								echo "<li>".$r->nomRobe."</li>";
								}?>
						</ul><br/>
						<b> Le nez :</b>
						<ul>
						<?php
							foreach ($nezz as $n){
								echo "<li>".$n->nomNez."</li>";
								}?>
						</ul><br/>
						<b> La bouche :</b>
						<ul>
						<?php 
							foreach ($bouchess as $b){
								echo "<li>".$b->nomBouche."</li>";
								}?>
						</ul><br/>
					</div>
					<div id = 'ResJeu'>
						<h4>Les réponses de l'oenologue : </h4>
						<b> La robe :</b>
						<ul>
							<?php
							foreach ($aspects as $r){
								echo "<li>".$r->nomRobe."</li>";
								}?>
						</ul><br/>
						<b> Le nez :</b>
						<ul>
							<?php
							foreach ($odeurs as $n){
								echo "<li>".$n->nomNez."</li>";
								}?>
						</ul><br/>
						<b> La bouche :</b> 
						<ul>
							<?php
							foreach ($gouts as $b){
								echo "<li>".$b->nomBouche."</li>";
								}?>
						</ul><br/>
						<p><b> Sa description du vin : </b><br>
						<?php echo $vin->descLongue;?></p>
					</div>
				</div>
				<div id = 'score'>
					<p> Bien évidement cette correction est donnée à titre indicatif puisque chaque nouvelle bouteille du vin dégusté peut évoluer différement. 
					L'important est de prendre du plaisir en le dégustant. Nous espérons que cela a été votre cas. </p>
				</div>
			</section>
<?php $contenu = ob_get_clean(); ?>