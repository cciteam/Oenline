<?php
require_once("dossierControleur/ControleurOenline.php");
$controleur = new ControleurOenline('127.0.0.1','root','','oenline');

function AfficherSection($Section){
	if ($Section == "Cours"){
		require('dossierVue/nav_Accueil.php');
		require('dossierVue/homeCours.php');
		require('dossierVue/gabarit.php');
		}
	if ($Section == 'VinsReferences' ){
		$parametre = "";
		$recherche = "";
		if (!empty(ISSET($_GET['parametre']))){
			$parametre = test_input_SQL($_GET['parametre']);
			if (ISSET($_GET['Rechercher_par_appellation'])){
				$recherche = "appellation";}
			else if (ISSET($_GET['Rechercher_par_cepage'])){
				$recherche = "cépage";}
			else if (ISSET($_GET['Rechercher_par_couleur'])){
				$recherche = "couleur";}
			else if (ISSET($_GET['Rechercher_par_nomDomaine'])){
				$recherche = "domaine";}
			else if (ISSET($_GET['Rechercher_par_nomVin'])){
				$recherche = "nom";
			$parametre = test_param($parametre,$recherche);}
		}
		require('dossierVue/nav_VinsReferences.php');
		require('dossierVue/homeVinsReferences.php');
		require('dossierVue/gabarit.php');
		}
	if ($Section=="Jeu" ){
		require('dossierVue/nav_Accueil.php');
		require('dossierVue/homeJeu.php');
		require('dossierVue/gabarit.php');
		}
	if ($Section=="EspaceMembre"){
		require('dossierVue/nav_Accueil.php');
		require('dossierVue/homeEspaceMembre.php');
		require('dossierVue/gabarit.php');
		}
	}

function AfficherAccueil(){
	require('dossierVue/nav_Accueil.php');
	require('texteAccueil.php');
	require('dossierVue/gabarit.php');}

function AfficherCours($typeCours){
	$cours = trouverCours(); /* obtention d'un tableau d'objets */
	for ($i = 0; $i < count($cours); $i ++){ 
		if ($cours->titreCours == $typeCours)
			return $cours[$i];
	}
	return null;

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
	if ($recherche == "appellation"){
		$appellations = $controleur->trouverAppellations();
		$trouve = false; 
		foreach ($appellations as $app){
			if ($app->nomAppellation==$parametre){$trouve = true; break;}
		}
		if ($trouve) {$param = $parametre;}
		else $param = "";
	}
	if ($recherche == "cepage"){
		$appellations = $controleur->trouverCepages();
		$trouve = false; 
		foreach ($cepages as $cep){
			if ($cep->nomCepage==$parametre){$trouve = true; break;}
		}
		if ($trouve) {$param = $parametre;}
		else $param = "";
	}
	if ($recherche == "couleur"){
		$couleur = $controleur->trouverTypeVin();
		$trouve = false; 
		foreach ($couleurs as $col){
			if ($col->nomTypeVin==$parametre){$trouve = true; break;}
		}
		if ($trouve) {$param = $parametre;}
		else $param = "";
	}
}
