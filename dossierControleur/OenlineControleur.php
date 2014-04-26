<?php
require_once("dossierMetier/MetierOenline.php");
function AfficherSection($Section){
	include("dossierControleur/appelControleur.php");
	/*Vérifications préliminaires : */
	/*Connexion*/
	$err_connexion = "";
	if (!(ISSET($_POST['SeConnecter'])) and !(ISSET($_POST['SInscrire'])) and !(ISSET($_SESSION['Membre']))){
		if (ISSET($_COOKIE["connexionOenline"])){
			$membre=$controleur->trouverMembreParPseudo($_COOKIE["connexionOenline"]);
			$_SESSION['Membre']=serialize($membre[0]);
		}
	}
	if (ISSET($_POST['SeConnecter'])){
		$email = test_input($_POST['email']);
		$password = test_input($_POST['password']);
		$connexion = SeConnecter($email, $password);
		if (!$connexion){$err_connexion = "Email ou mot de passe incorrect";}
		else {
			if (ISSET($_POST['SeSouvenirDeMoi'])){
				setcookie("connexionOenline", $connexion->pseudoMembre, time()+60*60*24*356);
			}
		}
	}
	else if (ISSET($_POST['SeDeconnecter'])){
		SeDeconnecter();
	}
	/*Droits d'accès*/
	$access_Admin = false;
	$access_User = false;
	$membre = null;
	if (ISSET($_SESSION['Membre'])){
		$membre = unserialize($_SESSION['Membre']);
		if ($membre->idGroupe == 1) {$access_Admin = true; $access_User = true;}
		else if ($membre->idGroupe == 2) {$access_User = true;}
	}
	/*récupération du controleur vers la base de données*/
	include('dossierControleur/appelControleur.php');
	if ($Section == "Cours"){
		afficherCours($Section, $err_connexion,$membre);
	}
	else if ($Section == 'VinsReferences' ){
		afficherVinsReferences($Section, $err_connexion,$membre);
	}
	else if ($Section=="Jeu" ){
		afficherJeu($Section, $err_connexion, $access_User, $membre);
	}
	else if ($Section=="EspaceMembre"){
		afficherEspaceMembre($Section, $err_connexion,$access_User, $access_Admin, $membre);
	}	
	else if ($Section=="Home"){
		afficherHome($Section, $err_connexion, $membre);
	}
	else afficherErreur("Home", $err_connexion,$membre);
}	
/*
function AfficherCours($typeCours){
	$cours = trouverCours(); /* obtention d'un tableau d'objets *//*
	for ($i = 0; $i < count($cours); $i ++){ 
		if ($cours->titreCours == $typeCours)
			return $cours[$i];
	}
	return null;

}
*/
function hash_password($password){
	// 256 bits random string
	$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));

	// prepend salt then hash
	$hash = hash("sha256", $password . $salt);

	// return salt and hash in the same string
	return $salt . $hash;
}
function check_password($password, $dbhash){
	// get salt from dbhash
	$salt = substr($dbhash, 0, 64);

	// get the SHA256 hash
	$valid_hash = substr($dbhash, 64, 64);

	// hash the password
	$test_hash = hash("sha256", $password . $salt);

	// test
	return $test_hash === $valid_hash;
}

function SeConnecter($email, $mdp){
	include ('dossierControleur/appelControleur.php');
	$m = $controleur->trouverMembreParMail($email);
	$m = $m[0];
	if (!empty($m)){
		if (check_password($mdp,$m->motDePasse)){
			$_SESSION['Membre']=serialize($m);
			return $m;
		}
	}
	return false;
}
function SeDeconnecter(){
	session_unset();
	session_destroy();
	session_start();
}
function test_input($data)
{
/*
fonction d'échappement des données html, évite des ajouts impromptus dans les scripts
*/
     $data = trim($data); /* supprime les espaces en début et fin de chaine de caractères*/
     $data = stripslashes($data);	/*supprime les antislash d'une chaîne*/
     $data = htmlspecialchars($data);	/*Convertit les caractères spéciaux en entités HTML*/
     return $data;
}
function test_param($parametre, $recherche)
{
/* Vérifie que les paramètres issus des listes déroulantes n'ont pas été modifiés dans l'url 
Si le paramètre est bien dans la base de données on renvoie le parametre, sinon on renvoie la chaine vide
*/
	include ('dossierControleur/appelControleur.php');
	$trouve = true;
	if ($recherche == "appellation"){
		$appellations = $controleur->trouverAppellations();
		$trouve = false; 
		foreach ($appellations as $app){
			if ($app->nomAppellation==$parametre->nomAppellation){$trouve = true; break;}
		}
	}
	if ($recherche == "cepage"){
		$cepages = $controleur->trouverCepages();
		$trouve = false; 
		foreach ($cepages as $cep){
			if ($cep->nomCepage==$parametre->nomCepage){$trouve = true; break;}
		}
	}
	if ($recherche == "couleur"){
		$couleurs = $controleur->trouverTypesVins();
		$trouve = false; 
		foreach ($couleurs as $col){
			if ($col->nomTypeVin==$parametre->nomTypeVin){$trouve = true; break;}
		}
	}
	if ($recherche == "new_domaine"){
		$domaines = $controleur->trouverDomaines();
		$trouve = false; 
		foreach ($domaines as $dom){
			if ($dom->nomDomaine==$parametre->nomDomaine){$trouve = true; break;}
		}
	}
	if ($trouve) {$param = $parametre;}
	else $param = "";
	return $param;
}
function checkName($nom) {
	/* Vérifie que le format de nom rentré par le visiteur est correct, sinon renvoie un message d'erreur
	Le nom ne doit pas être vide et ne contenir que des caractères alphabetiques et espaces et tiret.*/
	$error="";
	if (empty($nom)){
		$error.="Vous devez nous indiquer vorte nom<br>";}
	if (!preg_match("/^[A-Za-z]*[- ]?[A-Za-z]*$/",$nom)){
		$error.="Votre nom n'est pas au bon format<br>";}
	return $error;
}
function checkUsername($pseudo){
	/* Vérifie que le format du pseudo rentré par le visiteur est correct, sinon renvoie un message d'erreur
	Le pseudo doit contenir au moins 6 caractères alphanumériques et peut contenir - ou _.
	De plus ce pseudo ne doit pas avoir déjà été enregistré dans la base de données*/
	$error = "";
	if (empty($pseudo)){
		$error .="Vous devez choisir un pseudo. <br>";}
	else if (strlen($pseudo)<6){
		$error .="Votre pseudo doit contenir au moins 6 caractères. <br>";}
	else if (!preg_match("/^[A-Za-z0-9]*[-_]?[A-Za-z0-9]*$/",$pseudo)){ 
		$error .="Votre pseudo ne peut contenir que des caractères alphanumériques et les symboles - et _. <br>";}
	else {
		include ('dossierControleur/appelControleur.php');
		$membre = $controleur->trouverMembreParPseudo($pseudo);
		if (!empty($membre[0])){
			$error .= "Ce pseudo est déjà enregistré <br>";}
	}
	return $error;
}
function checkPassword($mdp, $valMdp){
	/* Vérifie que le format du mot de passe rentré par le visiteur est correct, sinon renvoie un message d'erreur
	Le pseudo doit contenir au moins 6 caractères et correspondre au mot de passe de validation.*/
	$error = "";
	if (empty($mdp)){
		$error .="Votre mot de passe est requis. <br>";}
	else if (strlen($mdp)<6){
		$error .= "Votre mot de passe doit contenir au moins 6 caractères. <br>";}
	else if ($mdp!=$valMdp){
		$error .= "Vous avez commis une erreur dans la saisie ou la validation de votre mot de passe.<br/>";}
	return $error;
}
function checkEmail($mail){
	$error = "";
	if (empty($mail)){
		$error .= "Votre adresse mail est requise <br>";}
	else if (!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA_Z0-9-]+)+$/",$mail)){
		$error .= "L'adresse mail renseignée n'est pas une adresse mail valide. <br>";}
	return $error;
}
function getAffichagePartie($parties){
	include ('dossierControleur/appelControleur.php');
	$affichagePartie = null;
	foreach($parties as $p){
		$vin = $controleur->trouverVinParIdVin($p->idVin);
		$domaine = $controleur->trouverDomainesParVin($vin[0]);
		$appellation = $controleur->trouverAppellationsParVin($vin[0]);
		$cepages = $controleur->trouverCepagesParVin($vin[0]);
		$typeVin = $controleur->trouverTypesVinsParVin($vin[0]);
		$robes = $controleur ->trouverRobesParVin($vin[0]);
		$nez = $controleur ->trouverNezParVin($vin[0]);
		$bouches = $controleur ->trouverBouchesParVin($vin[0]);
		$affichagePartie[] = array(
			'partie' => $p,
			'vin' => $vin[0],
			'domaine' => $domaine[0],
			'appellation' => $appellation[0],
			'typeVin' => $typeVin[0],
			'cepages' => $cepages,
			'nez' => $nez,
			'bouches' => $bouches,
			'robes' => $robes);
	}
	return $affichagePartie;
}
function existe($param){
	include ('dossierControleur/appelControleur.php');
	if (get_class($param)== "Domaine"){
		$domaines = $controleur->trouverDomaines();
		foreach ($domaines as $d){
			if (strcasecmp($d->nomDomaine ,$param->nomDomaine)==0){
				return true;
			}
		}
		return false;
	}
	else if (get_class($param)== "Appellation"){
		$appellations = $controleur->trouverAppellations();
		foreach ($appellations as $a){
			if (strcasecmp($a->nomAppellation ,$param->nomAppellation)==0){
				return true;
			}
		}
		return false;
	}
	else if (get_class($param) == "Cepage"){
		$cepages = $controleur->trouverCepages();
		foreach ($cepages as $c){
			if (strcasecmp($c->nomCepage,$param->nomCepage)==0){
				return true;
			}
		}
		return false;
	}
	else return false;
}
function afficherErreur($Section, $err_connexion, $membre){
	include('dossierControleur/appelControleur.php');
	$nav_cours = $nav_vinsRef = $nav_jeu = $nav_espMembre = "inactif";
	$contenu = "<section><p class = 'error'><br/><br/> Une erreur est survenue, veuillez nous en excuser. <br/>Choisissez un section pour continuer votre navigation<br/><br/></p></section>";
	require('dossierVue/connexion.php');
	require('dossierVue/navigation.php');
	require('dossierVue/gabarit.php');
}
function afficherHome($Section, $err_connexion, $membre){
	include ('dossierControleur/appelControleur.php');
	$nav_cours = $nav_vinsRef = $nav_jeu = $nav_espMembre = "inactif";
	require('dossierVue/connexion.php');
	require('dossierVue/navigation.php');
	require('dossierVue/texteAccueil.php');
	require('dossierVue/gabarit.php');
}
function afficherCours($Section, $err_connexion,$membre){
	include ('dossierControleur/appelControleur.php');
	$nav_vinsRef = $nav_jeu = $nav_espMembre = "inactif";
	$nav_cours = "actif";
	$contenu_section_cours = "";
	if (ISSET($_GET['typeCours'])){
		$type_typeCours = test_input($_GET['typeCours']);
		if (($type_typeCours == 'degustation') or ($type_typeCours == 'cepage') or ($type_typeCours == 'appellation')){
			$Cours = $controleur -> trouverCoursParTitreCours($type_typeCours); // récupération d'un tableau d'objets de type Cours
			ob_start();
			require_once($Cours[0]->urlCours);
			$contenu_section_cours=ob_get_clean();
		}		
	}
	require('dossierVue/connexion.php');
	require('dossierVue/navigation.php');
	require('dossierVue/cours/homeCours.php');
	require('dossierVue/gabarit.php');
}
function afficherVinsReferences($Section, $err_connexion, $membre){
	include ('dossierControleur/appelControleur.php');
	$nav_cours = $nav_jeu = $nav_espMembre = "inactif";
	$nav_vinsRef = "actif";
	$appellations = $controleur->trouverAppellations();
	$cepages_tout = $controleur->trouverCepages();
	$couleurs = $controleur->trouverTypesVins();	
	if (ISSET($_GET['parametre'])){
		if (!empty($_GET['parametre'])){
			$parametre = test_input($_GET['parametre']);
			if (ISSET($_GET['Rechercher_par_appellation'])){
				$recherche = "appellation";
				$rech_param = "";
				$parametre = unserialize(base64_decode($parametre));
				if ($parametre){
					$parametre = test_param($parametre,$recherche);
				}
				if ($parametre != ""){
					$rech_param = $parametre->nomAppellation;
					$vins = $controleur->trouverVinsParAppellation($parametre);
				}
				else {header('location:home.php?Section=VinsReferences');}
			}
			else if (ISSET($_GET['Rechercher_par_cepage'])){
				$recherche = "cépage";
				$rech_param = "";
				$parametre = unserialize(base64_decode($parametre));
				if ($parametre){
					$parametre = test_param($parametre,$recherche);
				}
				if ($parametre !=""){
					$rech_param = $parametre->nomCepage;
					$vins = $controleur->trouverVinsParCepage($parametre);
				}
				else {header('location:home.php?Section=VinsReferences');}
			}
			else if (ISSET($_GET['Rechercher_par_couleur'])){
				$recherche = "couleur";
				$rech_param = "";
				$parametre = unserialize(base64_decode($parametre));
				if ($parametre){
					$parametre = test_param($parametre,$recherche);
				}
				if ($parametre !=""){
					$rech_param = $parametre->nomTypeVin;
					$vins = $controleur->trouverVinsParTypeVin($parametre);
				}
				else {
					header('location:home.php?Section=VinsReferences');
					exit;
				}
			}
			else if (ISSET($_GET['Rechercher_par_nomDomaine'])){
				$recherche = "domaine";
				$rech_param = $parametre;
				$vins= $controleur->trouverVinsParNomDeDomaine($parametre);
			}
			else if (ISSET($_GET['Rechercher_par_nomVin'])){
				$recherche = "nom";
				$rech_param = $parametre;
				$vins= $controleur->trouverVinsParNom($parametre);
			}
			else {
				header('location:home.php?Section=Erreur');
				exit;
			}
		}
		if (!empty($vins)){
			$domaines = $controleur->trouverDomainesParVin($vins[0]);
			$affichage_vins[0]['domaine'] = $domaines[0];
			$pos_domaine = 0;
			for($i = 0; $i<count($vins); $i++){
				$domaines = $controleur->trouverDomainesParVin($vins[$i]);
				$cepages = $controleur->trouverCepagesParVin($vins[$i]);
				$typeVin = $controleur->trouverTypesVinsParVin($vins[$i]);
				$appellation = $controleur->trouverAppellationsParVin($vins[$i]);
				if ($domaines[0]->nomDomaine != $affichage_vins[$pos_domaine]['domaine']->nomDomaine){
					$pos_domaine++;
					$affichage_vins[$pos_domaine]['domaine'] = $domaines[0];
				}
				$affichage_vins[$pos_domaine]['vins'][] = array( 
							"vin"=>$vins[$i],
							"cepage"=>$cepages,
							"appellation"=>$appellation[0],
							"typeVin"=>$typeVin[0]);
			}
		}
		else {$error_rech_vin = "Nous n'avons pas de vin référencé pour les paramètres de votre recherche.";}
	}
	else {
		$error_rech_vin = "Aucun paramètre renseigné pour la recherche, vueillez sélectionner un paramètre.";		
	}
	require('dossierVue/connexion.php');
	require('dossierVue/navigation.php');
	require('dossierVue/vinsReferences/homeVinsReferences.php');
	require('dossierVue/gabarit.php');
}		
function afficherJeu($Section, $err_connexion, $access_User, $membre){
	include ('dossierControleur/appelControleur.php');
	$nav_cours = $nav_vinsRef = $nav_espMembre = "inactif";
	$nav_jeu = "actif";
	if ((!ISSET($_GET['idVinJeu'])) or (empty($_GET['idVinJeu'])) or (!is_numeric($_GET['idVinJeu']))){
		/*Si pas d'idVin rentré ou 
		  si le joueur a validé avant de rentrer un entier ou
		  si le joueur a rentré autre chose q'un entier, 
		  renvoyer la page d'accueil du jeu*/
		require ('dossierVue/jeu/homeJeu.php');
		}
	else {
		if (!$access_User && (ISSET($_GET['idVinJeu']))) {
			header('Location:home.php?Section=Jeu');
			exit;
		} 
		else if (ISSET($_GET['idVinJeu'])){
			$idVinJeu = intval($_GET['idVinJeu']);
			$vin = ($controleur->trouverVinParIdVin($idVinJeu));
			if (!empty($vin)){
				/* Si au moins un vin est retourné*/
				$vin = $vin[0];
				$domaine = $controleur->trouverDomainesParVin($vin);
				$appellation = $controleur->trouverAppellationsParVin($vin);
				$cepages = $controleur->trouverCepagesParVin($vin);
				$couleur = $controleur->trouverTypesVinsParVin($vin);
				$bouches = $controleur->trouverBouchesParTypeVin($couleur[0]);
				$nez = $controleur->trouverNezParTypeVin($couleur[0]);
				$robes = $controleur->trouverRobesParTypeVin($couleur[0]);
			}
			/* Sinon, si aucun vin trouvé par la requète afficher une erreur.*/
			else $error_trouver_vin_par_id = "<p>Aucun vin trouvé avec cet identifiant. <br/>Nous vous invitons à consulter la 
			section \"<a href = 'home.php?Section=VinsReferences'>Vins Référencés</a>\" pour trouver votre vin.</p>";
		}
		if (ISSET($_POST["ValiderDegust"])){
			$vin = $_POST['vin'];
			$vin = unserialize(base64_decode($vin));
			$partie = new Partie(null, date('Y-m-d'),null, $_POST['AvisMembre'],$vin->idVin, $membre->idMembre);
			$robess;
			$nezz;
			$bouchess;
			$error_jeu = "";
			if (ISSET($_POST['Robe'])){
				foreach($_POST['Robe'] as $robe){
					if ($robe){$robess[]=unserialize(base64_decode($robe));}
				}
			}
			else $error_jeu .= "Vous n'avez pas donné vos impressions sur la robe de ce vin!<BR/>";
			if (ISSET($_POST['Nez'])){
				foreach($_POST['Nez'] as $nez){
					if ($nez){$nezz[] = unserialize(base64_decode($nez));}
				}
			}
			else $error_jeu .= "Vous n'avez pas donné vos impressions sur le nez de ce vin!<BR/>";
			if (ISSET($_POST['Bouche'])){
				foreach($_POST['Bouche'] as $bouche){
					if ($bouche){$bouchess[] = unserialize(base64_decode($bouche));}
				}
			}
			else $error_jeu .= "Vous n'avez pas donné vos impressions sur la bouche de ce vin!<BR/>";
			if ($error_jeu == ""){
				$partie = $controleur->ajouterPartie($partie, $vin, $membre,$robess, $nezz, $bouchess);
				$gouts = $controleur->trouverBouchesParVin($vin);
				$odeurs = $controleur->trouverNezParVin($vin);
				$aspects = $controleur->trouverRobesParVin($vin);
				require ('dossierVue/jeu/JeuResultat.php');
			}
			else {require('dossierVue/jeu/JeuFormulaire.php');}
		}
		else {require ('dossierVue/jeu/JeuFormulaire.php');}
	}
	require('dossierVue/connexion.php');
	require('dossierVue/navigation.php');
	require('dossierVue/gabarit.php');
}
function afficherEspaceMembre($Section, $err_connexion, $access_User, $access_Admin, $membre){
	include ('dossierControleur/appelControleur.php');
	$nav_cours = $nav_vinsRef = $nav_jeu = "inactif";
	$nav_espMembre = "actif";
	$msg_enregistrement = "";
	$error = "";
	if ((!$access_User) && (!$access_Admin)) {
		/* Si le membre n'est pas connecté, afficher deux formulaire, l'un proposant 
		la connexion, l'autre l'inscription*/
		$nom = $email = $pseudo = $password = "";
		if (ISSET($_POST['SInscrire'])){
			/* Si le membre valide le formulaire d'inscription, 
			vérifier que les champs sont correctement remplis : 
				Aucun ne doit être nul,
				Le mot de passe doit faire plus de 6 caractères
				L'adresse mail doit être valide*/
			$temp = checkName(test_input($_POST["nomMembre"]));
			if ($temp == ""){
				$nom = test_input($_POST["nomMembre"]);}
			$error .=$temp;
			$temp = checkUsername(test_input($_POST["pseudo"]));
			if ($temp == ""){
				$pseudo = test_input($_POST["pseudo"]);}
			$error .=$temp;
			$temp = checkPassword(test_input($_POST["password"]),test_input($_POST["validationPassword"]));
			if ($temp == ""){
				$password = test_input($_POST["password"]);}
			$error .=$temp;
			$temp = checkEmail(test_input($_POST["email"]));
			if ($temp == ""){
				$email = test_input($_POST["email"]);}
			$error .=$temp;
			if (!ISSET($_POST["AgeOK"])){
				$error .= "Vous ne pouvez pas vous inscrire si vous n'avez pas plus de 18 ans";
			}			
			if ($error == ""){
				$password = hash_password($password);
				$membre = new Membre(null, $pseudo, $nom, $password, $email, 2);
				$groupe = new Groupe(2, "user");
				$membre = $controleur->AjouterMembre($membre, $groupe);
				$_SESSION['Membre']=serialize($membre);
				require ('dossierVue/espaceMembre/EspaceMembre_user.php');
				$affichage = "";
			}
			/*Si des erreurs sont reconnues dans l'inscription, réafficher le formulaire avec les erreurs*/
			else require ('dossierVue/espaceMembre/homeEspaceMembre.php');
		}
		/*Si pas d'acces membre, afficher les formulaire de connexion et d'inscription.
		La connexion est gérée au début de cette page dans la fonction afficherSection.*/
		else require ('dossierVue/espaceMembre/homeEspaceMembre.php');
	}
	else if ($access_User){
		/*Si le membre bénéficie d'un accès user, on affiche les sous-section Mes coordonnées et Mes parties*/
		$affichage = "";
		$parties = null;
		if (!ISSET($groupe)){
			$groupes = $controleur->trouverGroupes();
			foreach ($groupes as $g){
				if ($g->idGroupe == $membre->idGroupe){
					$groupe = $g;
				}
			}
		}
		if (ISSET($_GET['Affichage'])){
			$affichage = test_input($_GET['Affichage']);
			/*Varifier que l'affichage n'est autre que MesCoordonnees, MesParties ou AjouterUnVin*/
			if (!(($affichage=="MesParties") or ($affichage=="AjouterUnVin") or ($affichage=="MesCoordonnees"))){
				header('location:home.php?Section=Erreur');
				exit;
			}
		}
		if ($affichage == 'MesParties'){
			$parties = $controleur->trouverPartiesParMembre($membre);
			/*Le tableau affichage partie comporte: 
				- la partie
				- le vin joué
				- le domaine
				- le tableau de cépages pour ce domaine
				- le type de vin
				- l'appellation
				- les nez
				- les bouches
				- les robes
			pour chaque partie jouée par le membre*/
			$affichagePartie = getAffichagePartie($parties);
		}
		if ($access_Admin){
			if ($affichage == "AjouterUnVin"){
				$page = test_input($_GET['Page']);
				if (($page <1 ) or ($page>3)){
					/*Si les pages ont été modifiées, renvoyer vers la page d'erreur*/
					header('location:home.php?Section=Erreur');
					exit;
				}
				$error_enregistrement = "";
				if ($page == 1){
					/*préparation de l'affichage de la première page du formulaire*/
					$nomVin = "";
					$millesime = "";
					$domaines = $controleur->trouverDomaines();
					$appellations = $controleur->trouverAppellations();
					$cepages = $controleur->trouverCepages();
					$typesVins = $controleur->trouverTypesVins();
					$error_enregistrement_appellation = "";
					$error_enregistrement_cepage = "";
					$error_enregistrement_domaine = "";
					/*(Re)Initialiser les variables de session permettant 
					d'enregistrer un nouveau vin*/
					$_SESSION['domaine'] = "";
					$_SESSION['cepages'] = "";
					$_SESSION['appellation'] = "";
					$_SESSION['typeVin'] = "";
					$_SESSION['robes'] = "";
					$_SESSION['nez'] = "";
					$_SESSION['bouches'] = "";
					$_SESSION['millesime'] = "";
					$_SESSION['nomVin'] = "";
					$_SESSION['descCourte'] = "";
					$_SESSION['descLongue'] = "";
					/* Si le domaine, l'appellation ou le cépage ne sont pas renseignés 
					dans la base de données, donner la possibilité de les ajouter*/
						if (ISSET($_POST['enregistrer_dom'])){
							$nomDomaine = $_POST['nom_dom'];
							$urlDomaine = $_POST['url_dom'];
							$error_enregistrement_domaine = "";
							if (empty($nomDomaine)){
								$error_enregistrement_domaine .= "le nom de domaine doit être renseigné";
							}
							else {
								$domaine = new Domaine(null, $nomDomaine, $urlDomaine);
								if (!existe($domaine)){
									$controleur->ajouterDomaine($domaine);
									$domaines = $controleur->trouverDomaines();
								}
								else{
									$error_enregistrement_domaine .= "Une erreur est survenue pendant l'enregistrement du domaine. Il est possible que celui-ci existe déjà. Vérifiez qu'il n'est pas dans la liste avant de réessayer";
								}
							}
							require('dossierVue/espaceMembre/EspaceMembre_AjouterVin_1.php');
						}
						else if (ISSET($_POST['enregistrer_app'])){
							$nomAppellation = $_POST['nom_app'];
							$error_enregistrement_appellation = "";
							if (empty($nomAppellation)){
								$error_enregistrement_appellation .= "Le nom de l'appellation doit être renseigné";
							}
							else {
								$appellation = new Appellation(null, $nomAppellation);
								if (!existe($appellation)){
									$controleur->ajouterAppellation($appellation);
									$appellations = $controleur->touverDomaines();
								}
								else{
									$error_enregistrement_appellation .= "Une erreur est survenue lors de l'enregistrement de l'appellation. Il est probable que celle-ci existe déjà. Veuillez vérifier qu'elle n'est pas dans la liste avant de réessayer.";
								}
							}
							require('dossierVue/espaceMembre/EspaceMembre_AjouterVin_1.php');
						}
						else if (ISSET($_POST['enregistrer_cep'])){
							$nomCepage = $_POST['nom_cep'];
							$error_enregistrement_cepage = "";
							if (empty($nomCepage)){
								$error_enregistrement_cepage .= "Le nom du cépage doit être renseigné.";
							}
							else {
								$cepage = new Cepage (null, $nomCepage);
								if (!existe($cepage)){
									$controleur->ajouterCepage($cepage);
									$cepages = $controleur->trouverCepages();
								}
								else{
									$error_enregistrement_cepage .= "Une erreur est survenue lors de l'enregistrement du cépage. Veuillez vérifier que ce cépage n'est pas dans la liste avant de réessayer. ";
								}
							}
							require('dossierVue/espaceMembre/EspaceMembre_AjouterVin_1.php');
						}
					/*Sinon vérifier les paramètres d'enregistrement données.*/
					else if (ISSET($_POST['Val_page1'])){
						/* Cette page de formulaire ne doit être validée que si le nom de vin et le millésime ne sont pas vides, 
						si le type de vin est coché, si l'appellation et le domaine sont sélectionnés dans la liste déroulante
						et si au moins un cépage est coché*/
						$nomVin = $_POST['new_nomVin'];
						if (empty($nomVin)){
							$error_enregistrement .= "Veuillez saisir un nom de vin<br/>";
						}
						$millesime = $_POST['new_millesime'];
						if (($millesime > date('Y')) or ($millesime < 1950)){
							$error_enregistrement .= "Veuillez saisir un millésime comprit entre 1950 et cette année!<br/>";
						}
						if (ISSET($_POST['new_typeVin'])){
							$newTypeVin = test_param(unserialize(base64_decode($_POST['new_typeVin'])), "couleur");
							if ($newTypeVin == ""){
								$error_enregistrement .= "Erreur dans l'enregistrement du type de vin, veuillez recommencer. <br/>";
							}
						}
						else $error_enregistrement .= "Veuillez choisir un type de vin avant de passer à la suite. <br/>";
						if (ISSET($_POST['new_appellation'])){
							if (!empty($_POST['new_appellation'])){
								$newAppellation = test_param(unserialize(base64_decode($_POST['new_appellation'])),"appellation");
								if ($newAppellation == ""){
									$error_enregistrement .= "Erreur dans l'enregistrement de l'appellation, veuillez recommencer.<br/>";
								}
							}
							else $error_enregistrement .= "Veuillez choisir une appellation avant de passer à la suite. <br/>";
						}
						else $error_enregistrement .= "Veuillez choisir une appellation avant de passer à la suite. <br/>";
						if (ISSET($_POST['new_domaine'])){
							if (!empty($_POST['new_domaine'])){
								$newDomaine = test_param(unserialize(base64_decode($_POST['new_domaine'])),"new_domaine");
								if ($newDomaine == ""){
									$error_enregistrement .= "Erreur dans l'enregistrement du domaine, veuillez recommencer<br/>";
								}
							}
							else $error_enregistrement .= "Veuillez choisir un domaine avant de passer à la suite. <br/>";
						}
						else $error_enregistrement .= "Veuillez choisir un domaine avant de passer à la suite. <br/>";
						if (ISSET($_POST['Cepages'])){
							foreach($_POST['Cepages'] as $cep){
								if ($cep){
									if (test_param(unserialize(base64_decode($cep)),"cepage") !=""){
										$newCepages[] = test_param(unserialize(base64_decode($cep)), "cepage");
									} else { $error_enregistrement .= " Erreur dans le choix des cépage. ";}
								}
							}
						}
						else $error_enregistrement .= " Vous devez choisir un cépage. ";
						if ($error_enregistrement == ""){
							/* Si tous les paramètres sont validés les enregistrer dans la session et 
							lancer la deuxième page du formulaire d'enregistrement du vin.*/
							$_SESSION['nomVin'] = $nomVin;
							$_SESSION['millesime'] = $millesime;
							$_SESSION['domaine'] = base64_encode(serialize($newDomaine));
							$_SESSION['cepages'] = base64_encode(serialize($newCepages));
							$_SESSION['appellation'] = base64_encode(serialize($newAppellation));
							$_SESSION['typeVin'] = base64_encode(serialize($newTypeVin));
							header("location:home.php?Section=EspaceMembre&Affichage=AjouterUnVin&Page=2");
							exit;
						}
						else {
							/*Sinon relancer la première page du formulaire en affichant les erreurs*/
							require ('dossierVue/espaceMembre/EspaceMembre_AjouterVin_1.php');
						}
					}
					else {
						require('dossierVue/espaceMembre/EspaceMembre_AjouterVin_1.php');
					}
				}
				else if ($page == 2){
					$tv = unserialize(base64_decode($_SESSION['typeVin']));
					if ($tv){
						$robes = $controleur->trouverRobesParTypeVin($tv);
						$nez = $controleur->trouverNezParTypeVin($tv);
						$bouches = $controleur->trouverBouchesParTypeVin($tv);
						if (ISSET($_POST['Val_page2'])){
							/*Cette page ne doit être validée que si des bouches, nez et robes ont été cochées*/
							$error_enregistrement = "";
							if (ISSET($_POST['new_robes'])){
								foreach($_POST['new_robes'] as $r){
									if ($r){
										$rb = test_param(unserialize(base64_decode($r)),"robes");
										if ($rb != ""){
											$newRobes[] = $rb;
										} else { $error_enregistrement .= " Erreur dans le choix des robes du vin. <br/> ";}
									}
								}
							}
							else $error_enregistrement .= "Veuillez indiquer des paramètres pour la robe du vin<br/>";
							if (ISSET($_POST['new_nez'])){
								foreach($_POST['new_nez'] as $n){
									if ($n){
										$nz = test_param(unserialize(base64_decode($n)),"nez");
										if ($nz != ""){
											$newNez[] = $nz;
										} else { $error_enregistrement .= "Erreur dans le choix des nez du vin. <br/>";}
									}
								}
							}
							else $error_enregistrement .= "Veuillez indiquer des paramètres pour le nez du vin<br/>";
							if (ISSET($_POST['new_bouches'])){
								foreach ($_POST['new_bouches'] as $b){
									if ($b){
										$bc = test_param(unserialize(base64_decode($b)),"bouches");
										if ($bc != ""){
											$newBouches[] = $bc;
										} else {$error_enregistrement .= "Erreur dans le choix des bouches du vin. <br/>";}
									}
								}
							}
							else $error_enregistrement .= "Veuillez indiquer des paramètres pour la robe du vin<br/>";
							if ($error_enregistrement == ""){
								/* Si il n'y a pas eu d'erreurs lors de la vérifictaion des paramètres
								enregistrer les paramètres de la dégustation dans les variables de session 
								puis afficher la suite du formulaire*/
								$_SESSION['robes'] = base64_encode(serialize($newRobes));
								$_SESSION['nez'] = base64_encode(serialize($newNez));
								$_SESSION['bouches'] = base64_encode(serialize($newBouches));
								header('location:home.php?Section=EspaceMembre&Affichage=AjouterUnVin&Page=3');
								exit;
							}
							else {
								/*Si aucun nez, aucune bouche ou aucune robe n'a été sélectionnée, 
								re-afficher la deuxième page du formulaire avec les erreurs*/
								require('dossierVue/espaceMembre/EspaceMembre_AjouterVin_2.php');
							}
						}
						else {
							/*Si le joueur n'a pas encore valider de formulaire pour la page 2, 
							afficher cette page*/
							require('dossierVue/espaceMembre/EspaceMembre_AjouterVin_2.php');
						}
					}
					else {
						header('location:home.php?Section=Erreur');
						exit;
					}
				}
				else {
					if (ISSET($_POST['Val_page3'])){
						/* Si le formulaire de la page 3 est validé, vérifier que des textes ont été 
						rentrés pour les descriptions courte et longue du vin*/
						$error_enregistrement = "";
						$descCourte = $_POST['descCourte'];
						if (empty($descCourte)){
							$error_enregistrement .= "Vous devez renseigner un courte description du vin. <br/>";
						}
						$descLongue = $_POST['descLongue'];
						if (empty($descLongue)){
							$error_enregistrement .= "Vous devez renseigner un description détaillée de votre dégustation. <br/>";
						}
						if ($error_enregistrement == ""){
							/* Si les deux descriptions sont remplies, essayer d'ajouter le vin et renvoyer un message de validation 
							Si une erreur c'est produite, renvoyer un message d'erreur. */
							$domaine = unserialize(base64_decode($_SESSION['domaine']));
							$appellation = unserialize(base64_decode($_SESSION['appellation']));
							$typeVin = unserialize(base64_decode($_SESSION['typeVin']));
							$cepages = unserialize(base64_decode($_SESSION['cepages']));
							$robes = unserialize(base64_decode($_SESSION['robes']));
							$nez = unserialize(base64_decode($_SESSION['nez']));
							$bouches = unserialize(base64_decode($_SESSION['bouches']));
							if ((!empty($domaine)) and (!empty($appellation)) and (!empty($typeVin)) and (!empty($cepages)) and (!empty($robes)) and (!empty($nez)) and (!empty($bouches)) and (!empty($_SESSION['nomVin'])) and (!empty($_SESSION['millesime']))){
								/* Ce "if" permet de vérifier que l'administrateur n'a pas passé de page avant d'enregistrer le vin, on vérifie ici que tous les paramètres 
								nécessaires à l'enregistrement du vin sont bien remplis.*/
								$vin = new Vin (null, $_SESSION['nomVin'], $_SESSION['millesime'], $descCourte, $descLongue,$domaine->idDomaine, $appellation->idAppellation, $typeVin->idTypeVin);
								try{
									$controleur->ajouterVin($vin, $domaine, $appellation, $typeVin, $cepages, $robes, $nez, $bouches);
									$contenu_ajouterVin = "<h3>Votre vin a bien été ajouté. Merci de votre participation !</h3>";
									$_SESSION['domaine'] = "";
									$_SESSION['cepages'] = "";
									$_SESSION['appellation'] = "";
									$_SESSION['typeVin'] = "";
									$_SESSION['robes'] = "";
									$_SESSION['nez'] = "";
									$_SESSION['bouches'] = "";
									$_SESSION['millesime'] = "";
									$_SESSION['nomVin'] = "";
									$_SESSION['descCourte'] = "";
									$_SESSION['descLongue'] = "";
								}
								catch (Exception $e){	
									$contenu_ajouterVin = "<p class = 'error'><b>Une erreur c'est produite lors de l'enregistrement du vin, veuillez réessayer</b></p>";
								}
							}
							else $contenu_ajouterVin = "<p class = 'error'><b>Une erreur est survenue au cours de l'enregistrement des données de dégustation. Veuillez nous en excuser.</b></p>";
						}
						else { 
							/* Réafficher la page 3 du formulaire avec les erreurs */
							require ('dossierVue/espaceMembre/EspaceMembre_AjouterVin_3.php');
						}
					}
					else {
						require('dossierVue/espaceMembre/EspaceMembre_AjouterVin_3.php');
					}
				}
			}
		}
		require ('dossierVue/espaceMembre/EspaceMembre_user.php');
	} 
	require('dossierVue/connexion.php');
	require('dossierVue/navigation.php');
	require('dossierVue/gabarit.php');
}
?>