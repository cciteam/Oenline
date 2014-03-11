<?php
//Sandra
//Ingrid
require('dossierControleur/OenlineControleur.php');
if (ISSET ($_GET['Section']))
	{$Section = $_GET['Section'];
	AfficherSection($Section);}
else {AfficherAccueil(); } // action par défaut
 