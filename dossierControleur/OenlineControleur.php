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
				$affichagePartie = getAffichagePartie($parties);
			}
			
			if ($access_Admin){
				if ($affichage == "AjouterUnVin"){
					$page = $_GET['Page'];
					$erreur_enregistrement = "";
					$nomVin="";
					$millesime = "";
					if ($page == 1){
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
						$add_domaine = true;
						$add_appellation = true;
						$add_cepage = true;
						if (ISSET($_POST['enregistrer_dom'])){
							$nomDomaine = $_POST['nom_dom'];
							$urlDomaine = $_POST['url_dom'];
							$error_enregistrement_domaine = "";
							if (empty($nomDomaine)){
								$error_enregistrement_domaine .= "le nom de domaine doit être renseigné";
							}
							else {
								try{
									$controleur->enregistrer_domaine($nomDomaine,$urlDomaine);
								}
								catch Exception $e{
									$error_enregistrement_domaine .= "Une erreur est survenue pendant l'enregistrement du domaine. Il est possible que celui-ci existe déjà. Vérifiez qu'il n'est pas dans la liste avant de réessayer";
								}
							}
						}
						else if (ISSET($_POST['enregistrer_app'])){
							$nomAppellation = $_POST['nom_app'];
							$error_enregistrement_appellation = "";
							if (empty($nomAppellation)){
								$error_enregistrement_appellation .= "Le nom de l'appellation doit être renseigné";
							}
							else {
								try{
									$controleur->enregistrer_appellation($nomAppellation);
								}
								catch Excpetion $e{
									$error_enregistrement_appellation .= "Une erreur est survenue lors de l'enregistrement de l'appellation. Il est probable que celle-ci existe déjà. Veuillez vérifier qu'elle n'est pas dans la liste avant de réessayer.";
								}
							}
						}
						else if (ISSET($_POST['enregistrer_cep'])){
							$nomCepage = $_POST['nom_cep'];
							$error_enregistrement_cepage = "";
							if (empty($nomCepage)){
								$error_enregistrement_cepage .= "Le nom du cépage doit être renseigné.";
							}
							else {
								try{
									$controleur->enregistrer_cepage($nomCepage);
								}
								catch Exception $e{
									$error_enregistrement_cepage .= "Une erreur est survenue lors de l'enregistrement du cépage. Veuillez vérifier que ce cépage n'est pas dans la liste avant de réessayer. ";
								}
							}
						}
						else if (ISSET($_POST['Val_page1']){
							$error_enregistrement = "";
							$nomVin = $_POST['new_nomVin'];
							if (empty($nomVin)){
								$error_enregistrement .= "Veuillez saisir un nom de vin";
							}
							$millesime = $_POST['new_millesime'];
							if (($millesime > date('Y')) or $millesime < 1950)){
								$error_enregistrement .= "Veuillez saisir un millésime comprit entre 1950 et cette année!";
							}
							$newTypeVin = test_param(unserialize(base64_decode($_POT['new_typeVin'])), "couleur");
							if ($newTypeVin == ""){
								$error_enregistrement .= "Erreur dans l'enregistrement du type de vin, veuillez recommencer. <br/>";
							}
							$newAppellation = test_param(unserialize(base64_decode($_POST['new_appellation'])),"appellation");
							if ($newAppellation == ""){
								$error_enregistrement .= "Erreur dans l'enregistrement de l'appellation, veuillez recommencer.<br/>";
							}
							$newDomaine = test-param(unserialize(base64_decode($_POST['new_domaine'])),"new_domaine");
							if ($newDomaine == ""){
								$error_enregistrement .= "Erreur dans l'enregistrement du domaine, veuillez recommencer");
							}
							foreach($_POST['Cepage'] as $cep){
								if ($cep){
									if (test_param(unserialize(base64_decode($cep)),"cepage") !=""){
										$newCepages[] = test_param(unserialize(base64_decode($cep)), "cepage");
									} else { $error_enregistrement .= " Erreur dans le coix des cépage. ";}
								}
							}
							if ($error_enregistrement == ""){
								/* Si tous les paramètres sont validés les enregistrer dans la session et 
								lancer la deuxième page du formulaire d'enregistrement du vin.*/
								$_SESSION['nomVin'] = $nomVin;
								$_SESSION['millesime'] = $millesime;
								$_SESSION['domaine'] = base64_encode(serialize($newDomaine));
								$_SESSION['cepages'] = baes64_encode(serialize($newCepages));
								$_SESSION['appellation'] = base64_encode(serialize($newAppellation));
								$_SESSION['typeVin'] = base64_encode(serialize($newTypeVin));
								require ('dossierVue/EspaceMembre_AjouterVin_2.php');
							}
							else {
								/*Sinon relancer la première page du formulaire en affichant les erreurs*/
								require ('dossierVue/EspaceMembre_AjouterVin_1.php'))
							}
						}
						else {
							require('dossierVue/EspaceMembre_AjouterVin_1.php');
						}
					}
					else if ($page == 2){
						if (ISSET($_POST['Enregistrer_degust_Ajout'])){
							$error_enregistrement = "";
							foreach($_POST['new_robes'] as $r){
								if ($r){
									$rb = test_param(unserialize(base64_decode($r)),"robes");
									if ($rb != ""){
										$newRobes[] = $rb;
									} else { $error_enregistrement .= " Erreur dans le choix des robes du vin. <br/> ";}
								}
							}
							foreach($_POST['new_nez'] as $n){
								if ($n){
									$nz = test_param(unserialize(base64_decode($n)),"nez");
									if ($nz != ""){
										$newNez[] = $nz;
									} else { $error_enregistrement .= "Erreur dans le choix des nez du vin. <br/>";}
								}
							}
							foreach ($_POST['new_bouches'] as $b){
								if ($b){
									$bc = test_param(unserialize(base64_decode($b)),"bouches");
									if ($bc != ""){
										$newBouches[] = $bc;
									} else {$error_enregistrement .= "Erreur dans le choix des bouches du vin. <br/>";}
								}
							}
							if ($error_enregistrement == ""){
								/* Si il n'y a pas eu d'erreurs lors de la vérifictaion des paramètres
								enregistrer les paramètres de la dégustation dans les variables de session 
								puis afficher la suite du formulaire*/
								$_SESSION['robes'] = base64_encode(serialize($newRobes));
								$_SESSION['nez'] = base64_encode(serialize($newNez));
								$_SESSION['bouches'] = base64_encode(serialize($newBouches));
								require('dossierVue/EspaceMembre_AjouterVin_3.php');
							}
							else {
								/*Re-afficher la deuxième page du formulaire avec les erreurs*/
								require('dossierVue/EspaceMembre_AjouterVin_2.php');
							}
						}
						else {
							require('dossierVue/EspaceMembre_AjouterVin_2.php');
						}
					}
					else {
						if (ISSET($_POST['Enregister_Comm_Ajout'])){
							$error_enregistrement = "";
							$descCourte = $_POST['descCourte'];
							if (empty(descCourte)){
								$error_enregistrement .= "Vous devez renseigner un courte description du vin. <br/>";
							}
							$descLongue = $_POST['descLongue'];
							if (empty($descLongue)){
								$error_enregistrement .= "Vous devez renseigner un description détaillée de votre dégustation. <br/>";
							}
							if ($error_enregistrement == ""){
								/* Ajouter le vin */
								$domaine = unserialize(base64_decode($_SESSION['domaine']));
								$appellation = unserialize(base64_decode($_SESSION['appellation']));
								$typeVin = unserialize(base64_decode($_SESSION['typeVin']));
								$cepages = unserialize(base64_decode($_SESSION['cepages']));
								$robes = unserialize(base64_decode($_SESSION['robes']));
								$nez = unserialize(base64_decode($_SESSION['nez']));
								$bouches = unserialize(base64_decode($SESSION['bouches']));
								$vin = new Vin (null, $_SESSION['nomVin'],$domaine->idDomaine, $appellation->idAppellation, $typeVin->idTypeVin, $descCourte, $descLongue, $_SESSION['millesime']);
								try{
									$controleur->ajouterVin($vin, $domaine, $appellation, $typeVin, $cepage, $robes, $nez, $bouches);
									$contenu_ajout = "<h3>Votre vin a bien été ajouté. Merci de votre participation !</h3>";
								}
								catch Exception $e{	
									$contenu_ajout = "<h3>Une erreur c'est produite lors de l'enregistrement du vin, veuillez réessayer</h3>";
								}
							}
							else { 
								/* Réafficher la page 3 du formulaire avec les erreurs */
								require ('dossierVue/EspaceMembre_AjouterVin_3.php');
							}
						}
						else {
							require('dossierVue/EspaceMembre_AjouterVin_3.php');
						}
					}
				}
			}
			require ('dossierVue/EspaceMembre_user.php');
		} 
		
		
		require('dossierVue/connexion.php');
		require('dossierVue/nav_Accueil.php');
		require('dossierVue/gabarit.php');
	}
	else if ($Section=="Home"){
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
	
		
		