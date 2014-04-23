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
				<label>Adresse email</label><span class = "ALaLigne"><br/></span><input type = "email" name = "email" required><br>
				<label>Mot de Passe</label><span class = "ALaLigne"><br/></span><input type = "password" name = "password" required><br>
				<input type = "checkbox" name = "SeSouvrnirDeMoi">Se souvenir de moi<br/>
				<input type = "Submit" name = "SeConnecter" value = "Connexion">
			</form>
			<p class = "error"><?php echo $err_connexion;?></p>
		</div>
		<div id = "inscription">
			<h3> S'inscrire </h3>
			<p class = "error">
				<?php echo $error ?>
			</p>
			<form action = "home.php?Section=EspaceMembre" method = "POST">
				<label>Adresse email</label><span class = "ALaLigne"><br/></span><input type = "email" name = "email" value = "<?php echo $email;?>" required><br>
				<label>Nom </label><span class = "ALaLigne"><br/></span><input type = "text" name = "nomMembre" value = "<?php echo $nom;?>"required><br>
				<label>Pseudo </label><span class = "ALaLigne"><br/></span><input type = "text" name = "pseudo" value = "<?php echo $pseudo;?>"required><br>
				<label>Mot de passe </label><span class = "ALaLigne"><br/></span><input type = "password" name= "password" required><br>
				<label>Validez votre mot de passe </label><span class = "ALaLigne"><br/></span><input type = "password" name= "validationPassword" required><br>
				<input type = "checkbox" name = "AgeOK">Je certifie avoir plus de 18 ans.<br/>
				<input type = "Submit" name = "SInscrire" value = "Inscription">
			</form>
		</div>
	</div>
</section>
<?php $contenu = ob_get_clean(); ?>