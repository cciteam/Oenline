<?php

if (!ISSET($_SESSION['Membre'])){
	if (ISSET($_GET['Section'])){
		$contenu_connexion = "<form action = 'home.php?Section=".$_GET['Section']."' method = 'POST'>";
	}
	else {$contenu_connexion = "<form action = 'home.php?' method = 'POST'>";}
	$contenu_connexion .= "<input type = 'email' name = 'email' value = 'email'><br>";
	$contenu_connexion .= "<input type = 'password' name = 'password' value = 'password'><br>";
	$contenu_connexion .= "<input type = 'submit' name = 'SeConnecter' value = 'Connexion'>";
	$contenu_connexion .= "</form>";
	}
else {
	$m=unserialize($_SESSION['Membre']);
	$contenu_connexion = "<p>A vous de jouer ".$m->pseudoMembre."</p>";
	if (ISSET($_GET['Section'])){
		$contenu_connexion .= "<form action = 'home.php?Section=".$_GET['Section']."' method = 'POST'>";
	}
	else {$contenu_connexion .= "<form action = 'home.php?' method = 'POST'>";}
	$contenu_connexion .= "<input type = 'submit' name = 'SeDeconnecter' value = 'Se déconnecter'>";
	$contenu_connexion .= "</form>";
	}

