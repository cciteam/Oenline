<?php
require_once("Controleur/ControleurOneline.php")
function AfficherSection($Section){
	if ($Section=="Cours"){
		require('dossierVue/nav_Accueil.php');
		require('dossierVue/homeCours.php');
		require('dossierVue/gabarit.php');}
		}
	if ($Section=="VinsReferences" ){
		require('dossierVue/nav_Accueil.php');
		require('dossierVue/homeVinsReferences.php');
		require('dossierVue/gabarit.php');}
		}
	if ($Section=="Jeu" ){
		require('dossierVue/nav_Accueil.php');
		require('dossierVue/homeJeu.php');
		require('dossierVue/gabarit.php');}
		}
	if ($Section=="EspaceMembre"){
		require('dossierVue/nav_Accueil.php');
		require('dossierVue/homeEspaceMembre.php');
		require('dossierVue/gabarit.php');}
		}
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