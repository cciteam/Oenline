<?php 
	ob_start(); 
?>
		<aside id = "EspaceMembre"> 		
				<div id = "asideEspaceMembre">
					<p>
						<!-- 
						aside n'affiche rien ici
						-->
					</p>
				</div>
			</aside>
			<section>
				<!--
				La visualisation de l'accueil dépend de la connexion du visiteur. Si il n'est pas connecté, on lui propose de se connecter ou de s'inscrire
				-->
				<div id = "ContenuEspaceMembre">
					<p>
					Acces Admin
					</p>
				</div>
			</section>

<?php $contenu = ob_get_clean(); ?>
