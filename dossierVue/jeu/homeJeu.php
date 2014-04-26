<?php ob_start(); ?>
	<aside id = "Jeu"> 
<!-- 
aside n'affiche rien ici
-->
				<p>
				</p>
	</aside>
	<section>
<!--
La visualisation de l'accueil dépend de la connexion du visiteur. Si il n'est pas connecté, on lui propose de se connecté pour commencer le jeu, 
sinon on lui propose de rentrer un numéro de vin ou de choisir ce vin dans la section Vins Référencés.
-->
		<div id = "homeJeu">
			<h3>Règles du jeu</h3>
			<p>
				Ce jeu vous permet, une fois connecté, de commenter en ligne un ou plusieurs vins. 
				Une fois le formulaire de dégustation validé, une note informative vous est donnée, ainsi que la description de la dégustation du vin par notre oenologue.</p> 
			<p>
				Le formulaire comporte quatre grandes parties:<br>
				<ul>
					<li><b>l’examen  visuel : </b>il vous permettra d'apprécier la limpidité, l'intensité, 
					la couleur et les reflets d'un vin.</li>
					<li><b>l’examen olfactif: </b>vous y décrirez les parfums exprimés par un vin. </li>
					<li><b>l’examen gustatif: </b>vous pouurez ici définir la bouche du vin, 
					c’est à dire déterminer son attaque, son équilibre, son évolution et sa longueur.</li>
					<li><b>l’examen global : </b>vous  laisserez ici un commentaire sur la dégustation de ce vin. 
					Ce commentaire pourra être retrouvé dans votre espace membre et consulté à votre guise, vous permettant ainsi de vous rappeller vos préférences pour un vin, 
					ou les raisons de votre attirance pour un autre.</li>
				</ul></p>
			<p>
				La principale règle du jeu consiste à cocher des cases des caractéristiques plus générales aux plus spécifiques. 
				Plusieurs cases peuvent être cocher. 
				Lors de la description des arômes du nez et de la bouche, des grandes catégories d'arômes vous sont données, ainsi que des parfuns plus spécifiques. 
				Nous vous conseillons de toujours cocher en plus la catégorie générale lorsque vous sélectionner un parfum spécifique. Par exemple, si vous percevez une odeur de fraise, cochez fraise ET fruits rouges.
				Ces grandes catégories sont la pour vous aidez au début à affuter votre nez, vos papilles. 
			</p>
			<h3>Conditions générales</h3>
			<p>
				Vous ne pouvez jouer qu'une fois connecté<br>
				Vous pouvez jouer avec un vin autant de fois que vous le souhaitez.<br>
				La fiche complète de dégustation établie par nos œnologues est fournie à l’issu du jeu, 
				c’est-à-dire une fois que vous avez valider votre dégustation.<br></p>
			<?php
				if (!$access_User){
					/*Visiteur non connecté, se connecter pour jouer*/
					echo "<h4> Pour commencer une partie, <a href = 'home.php?Section=EspaceMembre'>connectez vous!</a></h4>";
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
<?php $contenu = ob_get_clean(); ?>