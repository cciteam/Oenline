<?php

/*Vérifier que le membre est bien connecté et donc a accès à cette section 
if (ISSET ($_SESSION['Membre'])){ 
	$access = true;
	//Récupérer le membre
	$membre = unserialize($_SESSION['Membre']);
}

else $access = false;

$controleur = new ControleurOenline('127.0.0.1','root','','oenline');
*/
?>
<?php 
	ob_start(); 
?>
		<aside id = "EspaceMembre"> 		
				<div id = "asideEspaceMembre_home">
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
				<div id = "contenuEspaceMembre">
					<div id = "connexionEspMem">
						<h3> Se connecter </h3>
						<form action="home.php?Section=EspaceMembre" method = "POST">
							<label>Adresse email</label><input type = "email" name = "email" required><br>
							<label>Mot de Passe</label><input type = "password" name = "password" required><br>
							<input type = "Submit" name = "SeConnecter" value = "Connexion">
						</form>
						<p class = "error"><?php echo $err_connexion;?>
					</div>
					<div id = "inscription">
						<h3> S'inscrire </h3>
						<p class = "error">
							<?php echo $error ?>
						</p>
						<form action = "home.php?Section=EspaceMembre" method = "POST">
							<label>Adresse email</label><input type = "email" name = "email" value = "<?php echo $email;?>" required><br>
							<label>Nom </label><input type = "text" name = "nomMembre" value = "<?php echo $nom;?>"required><br>
							<label>Pseudo </label><input type = "text" name = "pseudo" value = "<?php echo $pseudo;?>"required><br>
							<label>Mot de passe </label><input type = "password" name= "password" required><br>
							<label>Validez votre mot de passe </label><input type = "password" name= "validationPassword" required><br>
							<input type = "Submit" name = "SInscrire" value = "Inscription">
						</form>
					</div>
				</div>
			</section>

<?php $contenu = ob_get_clean(); ?>

