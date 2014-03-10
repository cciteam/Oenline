<?php

require_once('../dossierControleur/ControleurOenline.php');
$controleur=new ControleurOenline("localhost", "root", "", "oenline");

?>

<!DOCTYPE hmtl>
<html>
	<head>
		<meta charset="utf-8">
	</head>

	<body>
		<?php


			$vins=$controleur->trouverVins();
			$partie=new Partie('', date("Y-m-d"), '', '', '', '');
			$membres=$controleur->trouverMembres();
			$robess=$controleur->trouverRobes();
			$nezz=$controleur->trouverNez();
			$bouchess=$controleur->trouverBouches();

			$vin=new Vin('', 'Le vin', '2066', 'Jeune', 'Peut-être même un peu trop jeune', '', '', '');
			$domaines=$controleur->trouverDomaines();
			$appellations=$controleur->trouverAppellations();
			$typesVins=$controleur->trouverTypesVins();
			$cepagess=$controleur->trouverCepages();
			$scoresRobes=array();

			for($i=0; $i<count($robess); $i++)
			{
				$scoresRobes[$i]=3;
			}

			$courss=$controleur->trouverCours();

			foreach($membres as $membre)
				echo $membre->description();

			foreach($courss as $cours)
				echo $cours->description();

			$robes=array($robess[0], $robess[1]);
			$nez=array($nezz[0], $nezz[1]);
			$bouches=array($bouchess[0], $bouchess[1]);
			$cepages=array($cepagess[0], $cepagess[1]);

			$nvPartie=$controleur->ajouterPartie($partie, $vins[0], $membres[0], $robes, $nez, $bouches);
			$nvVin=$controleur->ajouterVin($vin, $domaines[0], $appellations[0], $typesVins[0], $cepages, $robes, $nez, $bouches, $scoresRobes);
			
			echo '<br>LA partie: '.$nvPartie->description();
			echo $nvVin->description();


			$controleur->supprimerPartie($nvPartie);
			$controleur->supprimerVin($nvVin);

			
		?>
	</body>

<html>