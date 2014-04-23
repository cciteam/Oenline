<?php ob_start();
if (!ISSET($membre)){
	if ($Section != "EspaceMembre"){
		if ($Section != "Home"){?>
			<form action = 'home.php?Section=<?php echo $Section;?>' method = 'POST'>
		<?php
		} else {?>
			<form action = 'home.php' method = 'POST'>
		<?php } ?>
		<input type = 'email' name = 'email' value = 'email'><br>
		<input type = 'password' name = 'password' value = 'password'><br>
		<input type = 'checkbox' name = 'SeSouvenirDeMoi' >Se souvenir de moi<br>
		<input type = 'submit' name = 'SeConnecter' value = 'Connexion'>
		</form>
		<p class = "error"><?php echo $err_connexion;?></p>
<?php
	}
	else echo "<p></p>";
}
else {?>
	<p>A vous de jouer <?php echo $membre->pseudoMembre;?></p>
	<?php
		if (ISSET($_GET['Section'])){
			echo "<form action = 'home.php?Section=".$_GET['Section']."' method = 'POST'>";
		}
		else {?>
			<form action = 'home.php?' method = 'POST'>
		<?php } ?>
	<input type = 'submit' name = 'SeDeconnecter' value = 'Se déconnecter'>
	</form>
<?php 
} 
$contenu_connexion = ob_get_clean(); ?>