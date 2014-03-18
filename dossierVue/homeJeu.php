<?php
$controleur = new ControleurOenline('127.0.0.1','root','','oenline');
if (ISSET ($_SECTION['PseudoMembre'])){ $access = true;}
else $access = false;
if (ISSET ($_GET['idVinJeu'])) {$idVinJeu = $_GET['idVinJeu'];}
$access = true;
if (!$access && (ISSET($_GET['idVinJeu']))) {header('Location:home.php?Section=Jeu');} 

?>

<?php ob_start(); ?>
	<div class="bg1Jeu">
		<div class="bg2">
		<?php
			if (!ISSET($idVinJeu)){
		?>
				<aside> 
					<div id = "asideJeu">
						<p>
						</p>
					</div>
				</aside>
				<section>
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
						</ul>
						<p>
						La principale règle du jeu consiste à cocher des cases des caractéristiques plus générales aux plus spécifiques. 
						Plusieurs cases peuvent être cocher.</p>
						<h3>Conditions générales</h3>
						<p>
						Seul un membre connecté peut jouer.<br>
						Un membre peut jouer autant de fois qu’il le souhaite.<br>
						La fiche complète de dégustation établie par nos œnologues est fournie à l’issue du jeu 
						c’est-à-dire une fois  que toutes les étapes du jeu ont été validées).<br>
					<?php
						if (!$access){
							echo "<p> Pour commencer une partie, connectez vous!</p>";
							}
						else {
					?>
							<p>Veuillez saisir le numéro d'un vin pour commencer une partie : 
							<form action = <?php echo htmlspecialchars("home.php");?> method =  "GET">
								<input type = "number" name="idVinJeu" min="1" max="5000">
								<input type = "hidden" name ="Section" value = "Jeu">
								<input type = "submit" name ="Submit" value = "Commencer">
							</form>
							<br>
							Ou choisissez le vin dans notre sélection grace à 
							<a href = "home.php?Section=VinsReferences">notre outils de recherche</a>

						
					<?php
							}
					?>

				</div>
			</section>
		<?php
			}
			else {
		?>	
				<aside> 
					<div id = "asideJeu">
					<?php
						$idVinJeu = $_GET['idVinJeu'];
						$str = $controleur->descriptionVinJeu($idVinJeu);
						echo $str;
					?>	
					</div>
				</aside>
				<section>
					<div id = "ContenuJeu">
					<?php
						$str = $controleur->formulaireVin($idVinJeu);
						print " allez allez allez allez allez : ";
						print $str;
						echo $str;
					?>
					</div>
				</section>
		<?php
		}
		?>
		</div>
	</div>
<?php $contenu = ob_get_clean(); ?>