<?php
//Sandra
//Ingrid
session_start();
require('dossierControleur/OenlineControleur.php');
if (ISSET($_POST['SeConnecter'])){
	Seconnecter();
	}
else if (ISSET($_POST['SeDeconnecter'])){
	SeDeconnecter();
	}
if (ISSET ($_GET['Section']))
	{$Section = $_GET['Section'];
	AfficherSection($Section);}
else {AfficherAccueil(); } // action par défaut
 