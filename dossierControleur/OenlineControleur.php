<?php
require_once("dossierControleur/ControleurOenline.php");
/*$controleur = new ControleurOenline('127.0.0.1','root','','oenline');*/


function AfficherSection($Section){

/*Vérifications préliminaires : */

	/*Connexion*/
	$err_connexion = "";
	if (ISSET($_POST['SeConnecter'])){
		$email = test_input($_POST['email']);
		$password = test_input($_POST['password']);
		$connexion = SeConnecter($email, $password);
		if (!$connexion){$err_connexion = "Email ou mot de passe incorrect";}
	}
	else if (ISSET($_POST['SeDeconnecter'])){
		SeDeconnecter();
	}
	
	/*Droits d'accès*/
	$access_Admin = false;
	$access_User = false;
	if (ISSET($_SESSION['Membre'])){
		$membre = unserialize($_SESSION['Membre']);
		if ($membre->idGroupe == 1) {$access_Admin = true; $access_User = true;}
		else if ($membre->idGroupe == 2) {$access_User = true;}
	}

	
	/*récupération du controleur vers la base de données*/
	$controleur = new ControleurOenline('127.0.0.1','root','','oenline');
	
	
	
	if ($Section == "Cours"){
		require('dossierVue/connexion.php');
		require('dossierVue/nav_Accueil.php');
		require('dossierVue/homeCours.php');
		require('dossierVue/gabarit.php');
		}
		
		
		
	if ($Section == 'VinsReferences' ){
	
		$controleur = new ControleurOenline('127.0.0.1','root','','oenline');
		$appellations = $controleur->trouverAppellations();
		$cepages_tout = $controleur->trouverCepages();
		$couleurs = $controleur->trouverTypesVins();
		
		if (ISSET($_GET['parametre'])){
			if (!empty($_GET['parametre'])){
				$parametre = test_input_SQL($_GET['parametre']);
				if (ISSET($_GET['Rechercher_par_appellation'])){
					$recherche = "appellation";
					$rech_param = "";
					$parametre = unserialize(base64_decode($parametre));
					$parametre = test_param($parametre,$recherche);
					if ($parametre != ""){
						$rech_param = $parametre->nomAppellation;
						$vins = $controleur->trouverVinsParAppellation($parametre);
					}
				}
				else if (ISSET($_GET['Rechercher_par_cepage'])){
					$recherche = "cépage";
					$rech_param = "";
					$parametre = unserialize(base64_decode($parametre));
					$parametre = test_param($parametre, $recherche);
					if ($parametre !=""){
						$rech_param = $parametre->nomCepage;
						$vins = $controleur->trouverVinsParCepage($parametre);
					}
				}
				else if (ISSET($_GET['Rechercher_par_couleur'])){
					$recherche = "couleur";
					$rech_param = "";
					$parametre = unserialize(base64_decode($parametre));
					$parametre = test_param($parametre, $recherche);
					if ($parametre !=""){
						$rech_param = $parametre->nomTypeVin;
						$vins = $controleur->trouverVinsParTypeVin($parametre);
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
		}
		else {
			$error_rech_vin = "Aucun paramètre renseigné pour la recherche, vueillez sélectionner un paramètre.";		
		}
		
		require('dossierVue/connexion.php');
		require('dossierVue/nav_VinsReferences.php');
		require('dossierVue/homeVinsReferences.php');
		require('dossierVue/gabarit.php');
	}
		
		
		
		
	if ($Section=="Jeu" ){
		if (!ISSET($_GET['idVinJeu'])){
			require ('dossierVue/homeJeu.php');
			}
		else {
			if (!$access_User && (ISSET($_GET['idVinJeu']))) {
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
				$bouches = $controleur->trouverBouchesParTypeVin($couleur[0]);
				$nez = $controleur->trouverNezParTypeVin($couleur[0]);
				$robes = $controleur->trouverRobesParTypeVin($couleur[0]);
			}
			
			if (ISSET($_POST["ValiderDegust"])){
				$vin = $_POST['vin'];
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
				require ('dossierVue/JeuResultat.php');
			}
			else {require ('dossierVue/JeuFormulaire.php');}
		}
		require('dossierVue/connexion.php');
		require('dossierVue/nav_Jeu.php');
		require('dossierVue/gabarit.php');
	}
		
		
		
		
	if ($Section=="EspaceMembre"){
	
		$msg_enregistrement = "";
		$error = "";

		if ((!$access_User) && (!$access_Admin)) {
			$nom = $email = $pseudo = $password = "";
			if (ISSET($_POST['SInscrire'])){
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
				if ($error == ""){
					$membre = new Membre(null, $pseudo, $nom, $password, $email, 2);
					$groupe = new Groupe(2, "user");
					$membre = $controleur->AjouterMembre($membre, $groupe);
					$msg_enregistrement="Bienvenue ".$membre->pseudoMembre.", vous avez bien été enregistré.";
					SeConnecter($membre->mailMembre, $membre->motDePasse);
					$access_User = true;
				}
				else require ('dossierVue/homeEspaceMembre.php');
			}
			else require ('dossierVue/homeEspaceMembre.php');
		}
		
		if ($access_Admin){
			require ('dossierVue/EspaceMembre_Admin.php');
		}
		
		else if ($access_User){
			$affichage = "";
			$parties = null;
			
			if (!ISSET($groupe)){
				$groupes = $controleur->trouverGroupes();
				foreach ($groupes as $g){
					if ($g->idGroupe == $membre->idGroupe){
						$groupe = $g;}
				}
			}
			
			if (ISSET($_GET['Affichage'])){
				$affichage = test_input($_GET['Affichage']);}
				
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
				$affichagePartie = getAffichagePartie($parties);}
				
			require ('dossierVue/EspaceMembre_user.php');
		}
		
		require('dossierVue/connexion.php');
		require('dossierVue/nav_Accueil.php');
		require('dossierVue/gabarit.php');
	}
	if ($Section=="Home"){
		require('dossierVue/connexion.php');
		require('dossierVue/nav_Accueil.php');
		require('texteAccueil.php');
		require('dossierVue/gabarit.php');
	}
}


	

function AfficherCours($typeCours){
	$cours = trouverCours(); /* obtention d'un tableau d'objets */
	for ($i = 0; $i < count($cours); $i ++){ 
		if ($cours->titreCours == $typeCours)
			return $cours[$i];
	}
	return null;

}

function SeConnecter($email, $mdp){
	$controleur = new ControleurOenline('127.0.0.1','root','','oenline');
	$m = $controleur->trouverMembreParMail($email);
	$m = $m[0];
	if (!empty($m)){
		if ($m->motDePasse == $mdp){
			$_SESSION['Membre']=serialize($m);
			return true;
		}
	}
	return false;
}

function SeDeconnecter(){
	session_unset();
	session_destroy();
}

function test_input($data)
{
/*
fonction d'échappement des données html, évite des ajouts impromptus dans les scripts
*/
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}

function test_input_SQL($data)
{
/* fonction d'échappement pour les requètes SQL, évite d'avoir des requêtes 
impromptues dans la base de données
*/
     $data = test_input($data);
     $data = mysql_real_escape_string($data);
     return $data;
}

function test_param($parametre, $recherche)
{
/* Vérifie que les paramètres issus des listes déroulantes n'ont pas été modifiés dans l'url 
Si le paramètre est bien dans la base de données on renvoie le parametre, sinon on renvoie la chaine vide
*/
	$controleur = new ControleurOenline('127.0.0.1','root','','oenline');
	$trouve = true;
	if ($recherche == "appellation"){
		$appellations = $controleur->trouverAppellations();
		$trouve = false; 
		foreach ($appellations as $app){
			if ($app->nomAppellation==$parametre->nomAppellation){$trouve = true; break;}
		}
	}
	if ($recherche == "cepage"){
		$appellations = $controleur->trouverCepages();
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
		$controleur = new ControleurOenline("127.0.0.1","root","","oenline");
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
		$error .= "Vous avez commis une erreur dans la saisie ou la validation de votre mot de passe";}
	return $error;
}


function checkEmail($mail){
	$error = "";
	if (empty($mail)){
		$error .= "Votre adresse mail est requise <br>";}
	else if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/",$mail)){
		$error .= "L'adresse mail renseignée n'est pas une adresse mail valide. <br>";}
	return $error;
}

function getAffichagePartie($parties){
	$controleur= new ControleurOenline("127.0.0.1", "root", "", "oenline");
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
	
		
		