<?php
//Sandra
//Ingrid
session_start();
require('dossierControleur/OenlineControleur.php');

if (ISSET ($_GET['Section']))
	{$Section = $_GET['Section'];}
else {$Section = "Home";}// action par défaut
AfficherSection($Section);  
 