<?php

if (ISSET ($_SESSION['Membre'])){ $access = true;}
else $access = false;
$controleur = new ControleurOenline('127.0.0.1','root','','oenline');




/*S'assurer que le joueur est connecté avant de lui donner accès à une nouvelle partie. 
S'il ne l'est pas le renvoyer vers l'accueil de la section jeu*/
if (!$access && (ISSET($_GET['idVinJeu']))) {
	header('Location:home.php?Section=Jeu');
} 


else if (ISSET($_GET['idVinJeu'])){
	$idVinJeu = $_GET['idVinJeu'];
	$vin = ($controleur->trouverVinParIdVin($idVinJeu));
	$vin = $vin[0];
	$domaine = $controleur->trouverDomainesParVin($vin);
	$appellation = $controleur->trouverAppellationsParVin($vin);
	$cepages = $controleur->trouverCepagesParVin($vin);
	$couleur = $controleur->trouverTypesVinsParVin($vin);
}


$res = false;
if (ISSET($_POST["ValiderDegust"])){
print "LOLolOL";
	$vin = $_POST['vin'];
	
	print " vin : ".$vin;
	$vin = unserialize(base64_decode($vin));
	$membre = unserialize($_SESSION['Membre']);
	$partie = new Partie(null, date('Y-m-d'),null, $_POST['AvisMembre'],$vin->idVin, $membre->idMembre);
	$robess;
	$nezz;
	$bouchess;
	foreach($_POST['Robe'] as $robe){
		if ($robe){$robess[]=unserialize($robe);}
	}
	foreach($_POST['Nez'] as $nez){
		if ($nez){$nezz[] = unserialize($nez);}
	}
	foreach($_POST['Bouche'] as $bouche){
		if ($bouche){$bouchess[] = unserialize($bouche);}
	}
	$partie = $controleur->ajouterPartie($partie, $vin, $membre,$robess, $nezz, $bouchess);
	$gouts = $controleur->trouverGoutsVin($vin);
	$odeurs = $controleur->trouverNezVin($vin);
	$aspects = $controleur->trouverRobesVin($vin);
	$res = true;
}

?>

<?php ob_start(); ?>
	<!--<div class="bg1Jeu">
		<p>
		</p>
	</div>-->
	<?php
		if (!ISSET($idVinJeu)){
	?>
		<!-- 
		Le vin n'est pas choisit, on est donc sur l'accueil de la section jeu
		-->
			<aside id = "Jeu"> 
			
<!-- 
aside n'affiche rien ici
-->
			
				<div id = "asideJeu">
					<p>
					</p>
				</div>
			</aside>
			<section>
<!--
La visualisation de l'accueil dépend de la connexion du visiteur. Si il n'est pas connecté, on lui propose de se connecté pour commencer le jeu, 
sinon on lui propose de rentrer un numéro de vin ou de choisir ce vin dans la section Vins Référencés.
-->
				<div id = "ContenuVinsRef">
					<h3>Règles du jeu</h3>
					<p>
					Ce jeu permet  à un membre de commenter en ligne un ou plusieurs vins. 
					Une note est donnée à la suite de leur commentaire de dégustation, ainsi que la correction.</p> 
					<p>
					Il comporte quatre grandes parties:<br>
					<ul>
						<li><b>l’examen  visuel : </b>il s’agit d'apprécier la limpidité, l'intensité, 
						la couleur et les reflets l'éventuelle effervescence d'un vin.</li>
						<li><b>l’examen olfactif: </b> il s’agit d'analyser les parfums exprimés par un vin. </li>
						<li><b>l’examen gustatif: </b>il s’agit  d’analyser un vin en bouche, 
						c’est à dire déterminer son attaque, son équilibre, son évolution et sa longueur.</li>
						<li><b>l’examen global : </b>il s’agit de donner d’un commentaire sur un vin à 
						la suite des précédents examens. Ce commentaire sera sauvegardé et visible dans votre 
						espace membre.</li>
					</ul></p>
					<p>
					La principale règle du jeu consiste à cocher des cases des caractéristiques plus générales aux plus spécifiques. 
					Plusieurs cases peuvent être cocher.
					</p>
					<h3>Conditions générales</h3>
					<p>
					Seul un membre connecté peut jouer.<br>
					Un membre peut jouer autant de fois qu’il le souhaite.<br>
					La fiche complète de dégustation établie par nos œnologues est fournie à l’issue du jeu 
					c’est-à-dire une fois  que toutes les étapes du jeu ont été validées).<br></p>
				<?php
					if (!$access){
						/*Visiteur non connecté, se connecter pour jouer*/
						echo "<h4> Pour commencer une partie, connectez vous!</h4>";
						}
					else {
						/*Visiteur connecté, identifier un vin pour jouer*/
				?>
						<p>Veuillez saisir le numéro d'un vin pour commencer une partie : 
							<form action = "home.php" method =  "GET">
								<input type = "number" name="idVinJeu" min="1" max="5000">
								<input type = "hidden" name ="Section" value = "Jeu">
								<input type = "submit" name ="CommencerJeu" value = "Commencer">
							</form>
							<br>
							Ou choisissez le vin dans notre sélection grace à 
							<a href = "home.php?Section=VinsReferences">notre outils de recherche</a>
						</p>
				<?php
					}
				?>
			</div>
		</section>
	<?php
		}
		else {
	?>	
			<aside id = "Jeu"> 
<!--
aside affiche un récapitulatif du vin sur lequel la partie porte 
-->
				<div id = "Jeu">
				<?php
					$str = "<h3>".$vin->nomVin."</h3><br><hr>";
					$str .= "<p>Millésime : ".$vin->millesime."<br><br>";
					$str .= "Domaine : ".$domaine[0]->nomDomaine."<br><br>";
					$str .= "Appellation : ".$appellation[0]->nomAppellation."<br><br>";
					$str .= "Type de vin : ".$couleur[0]->nomTypeVin."<br><br>";
					$str .= "Cépage : <ul>";
					foreach ($cepages as $cep){
						$str  .= "<li>".$cep->nomCepage."</li>";}
					$str  .=  "</ul>";
					echo $str;
				?>	
				</div>
			</aside>
			<section>
<!-- 
	Si le formulaire n'est pas validé () affichage du jeu sous forme de formulaire suivant $idTypeVin, 
le numéro du vin, renseigné par le joueur. 
	Si le formulaire est validé, affichage du résultat et de la correction
-->
				<div id = "ContenuJeu">
						
						
					<?php
					if (!$res){
						$bouches = $controleur->trouverBouchesParTypeVin($couleur[0]);
						$nez = $controleur->trouverNezParTypeVin($couleur[0]);
						$robes = $controleur->trouverRobesParTypeVin($couleur[0]);
						$str = "<h3> Votre dégustation de ".$vin->nomVin." proposé par ".$domaine[0]->nomDomaine."</h3>";
						$str .= "<form action = 'home.php?Section=Jeu&idVinJeu=".$idVinJeu."' method = 'POST'>";
						$str .= "<fieldset><legend> La robe : </legend>";
						$typeRobe = $robes[1]->typeRobe;
						$str .="<div class = 'affichage_formulaire'>";
						$str .= "<br>";
						$str .= "<h4>".$typeRobe."</h4>";
						foreach ($robes as $r){
							if ($r->typeRobe != $typeRobe){
								$typeRobe = $r->typeRobe;
								$str .= "</div>";
								$str .="<div class = 'Affichage_formulaire'>";
								$str .= "<br>";
								$str .= "<h4>".$typeRobe."</h4>";
							}
							$str .= "<input type='checkbox' name='Robe[]' value ='".serialize($r)."'>".$r->nomRobe."<br>";
						}
						$str .= "</div>";
						$str .= "</fieldset>";
						$str .= "<fieldset><legend> Le nez : </legend>";
						$typeNez = $nez[1]->typeNez;
						$str .="<div class = 'affichage_formulaire'>";
						$str .= "<br>";
						$str .= "<h4><input type='checkbox' name='Nez[]' value ='".serialize($nez[0])."'>".$nez[0]->nomNez."</h4>";
						for ($i = 1; $i< count($nez); $i++){
							if ($nez[$i]->typeNez != $typeNez){
								$typeNez = $nez[$i]->typeNez;
								$str .= "</div>";
								$str .="<div class = 'Affichage_formulaire'>";
								$str .= "<br>";
								$str .= "<h4><input type='checkbox' name='Nez[]' value ='".serialize($nez[$i])."'>".$nez[$i]->nomNez."</h4>";
							}
							else {
								$str .= "<input type='checkbox' name='Nez[]' value ='".serialize($nez[$i])."'>".$nez[$i]->nomNez."<br>";
							}
						}
						$str .= "</div>";
						$str .= "</fieldset>";
						$str .= "<fieldset><legend> La bouche : </legend>";
						$typeDescBouche = $bouches[0]->typeDescBouche;
						$typeBouche = $bouches[0]->typeBouche;
						$str .= "<div class = 'typeBouche'>";
						$str .= "<h3>".$typeBouche."</h3>";
						$str .= "<div class = 'affichage_formulaire'>";
						if ($typeBouche == "Arômes"){
							$str .= "<br>";
							$str .= "<h4><input type='checkbox' name='Bouche[]' value ='".serialize($bouches[0])."'>".$bouches[0]->nomBouche."</h4><br>";
						}
						for ($i = 1; $i< count($bouches); $i++){
							if ($bouches[$i]->typeBouche != $typeBouche){
								$typeBouche = $bouches[$i]->typeBouche;
								$str .= "</div>";
								$str .= "<div class = 'clear'></div>";
								$str .= "</div>";
								$str .= "<div class = 'typeBouche'>";
								$str .= "<h3>".$typeBouche."</h3>";
								$str .= "<div>";
								}
							if ($typeBouche == "Arômes"){
								if ($bouches[$i]->typeDescBouche!= $typeDescBouche){
									$typeDescBouche = $bouches[$i]->typeDescBouche;
									$str .= "</div>";
									$str .="<div class = 'Affichage_formulaire'>";
									$str .= "<br>";
									$str .= "<h4><input type='checkbox' name='Bouche[]' value ='".serialize($bouches[$i])."'>".$bouches[$i]->nomBouche."</h4><br>";
								}
								else {
									$str .= "<input type='checkbox' name='Bouche[]' value ='".serialize($bouches[$i])."'>".$bouches[$i]->nomBouche."<br>";
								}
							}
							else if ($bouches[$i]->typeDescBouche!= $typeDescBouche){
								$typeDescBouche = $bouches[$i]->typeDescBouche;
								$str .= "</div>";
								$str .="<div class = 'Affichage_formulaire'>";
								$str .= "<br>";
								$str .= "<h4>".$typeDescBouche."</h4>";
								$str .= "<input type='checkbox' name='Bouche[]' value ='".serialize($bouches[$i])."'>".$bouches[$i]->nomBouche."<br>";
							}
							else {
								$str .= "<input type='checkbox' name='Bouche[]' value ='".serialize($bouches[$i])."'>".$bouches[$i]->nomBouche."<br>";
							}
						}
						$str .= "</div></div>";
						$str .= "</fieldset>";
						$str .= "<fieldset><legend> Votre avis : </legend>";
						$str .= "<textarea name='AvisMembre' rows = '20' cols = '28'></textarea>";
						$str .= "</fieldset>";
						$str .= "<input type = 'hidden' name = 'vin' value = ".base64_encode(serialize($vin)).">";
						$str .= "<input type='submit' name='ValiderDegust' value='Valider la dégustation'>";
						$str .= "</form>";
						echo $str;
					}
					else {
						$str = "<h3> Les résultats de votre de dégustation du vin ".$vin->nomVin." proposé par ".$domaine[0]->nomDomaine."</h3>";
						$str .= "<br><p> Vous avez obtenu pour cette dégustation un score de ".$partie->scorePartie."/100. <p><br>";
						$str .= "<div id = 'results'>";
						$str .= "<div id = 'ResJeu'>"; 
						$str .= "<h4>Vos réponses : </h4>";
						$str .= "<b> La robe :</b>"; 
						$str .= "<ul>";
						foreach ($robess as $r){
							$str .= "<li>".$r->nomRobe."</li><br/>";
							}
						$str .= "</ul><br/>";
						
						$str .= "<b> Le nez :</b>"; 
						$str .= "<ul>";
						foreach ($nezz as $n){
							$str .= "<li>".$n->nomNez."</li><br/>";
							}
						$str .= "</ul><br/>";
						
						$str .= "<b> La bouche :</b>"; 
						$str .= "<ul>";
						foreach ($bouchess as $b){
							$str .= "<li>".$b->nomBouche."</li><br/>";
							}
						$str .= "</ul><br/>";
						$str .= "</div>";
						
						
						$str .= "<div id = 'ResJeu'>"; 
						$str .= "<h4>Les réponses de l'oenologue : </h4>";
						$str .= "<b> La robe :</b>"; 
						$str .= "<ul>";
						foreach ($aspects as $r){
							$str .= "<li>".$r->nomRobe."</li><br/>";
							}
						$str .= "</ul><br/>";
						
						$str .= "<b> Le nez :</b>"; 
						$str .= "<ul>";
						foreach ($odeurs as $n){
							$str .= "<li>".$n->nomNez."</li><br/>";
							}
						$str .= "</ul><br/>";
						
						$str .= "<b> La bouche :</b>"; 
						$str .= "<ul>";
						foreach ($gouts as $b){
							$str .= "<li>".$b->nomBouche."</li><br/>";
							}
						$str .= "</ul><br/>";
						$str .= "<p> Sa description du vin : <br>";
						$str .= $vin->descLongue;
						$str .= "</div>";
						$str .= "</div>";
						$str .= "<div class = 'clear'></div>";
						
						$str .= "<div id = 'score'>";
						$str .= "<p> Vous avez obtenu pour cette dégustation un score de ".$partie->scorePartie."/100. <p>";
						$str .= "<p> Bien évidement cette correction est donnée à titre indicatif puisque chaque nouvelle bouteille du vin dégusté peut évoluer différement. 
						L'important est de prendre du plaisir en le dégustant. Nous espérons que cela a été votre cas. </p>";
						$str .= "</div>";
						echo $str;
					}
						
					?>
				</div>
			</section>
	<?php
		}
	?>

	</div>
<?php $contenu = ob_get_clean(); ?>

