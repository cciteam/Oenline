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
			$vuess=$controleur->trouverVues();
			$nezz=$controleur->trouverNez();
			$bouchess=$controleur->trouverBouches();

			$vin=new Vin('', 'Le vin', '2066', 'Jeune', 'Peut-être même un peu trop jeune', '', '', '');
			$domaines=$controleur->trouverDomaines();
			$appellations=$controleur->trouverAppellations();
			$typesVins=$controleur->trouverTypesVins();
			$cepagess=$controleur->trouverCepages();
			$scoresVues=array();

			for($i=0; $i<count($vuess); $i++)
			{
				$scoresVues[$i]=3;
			}

			$courss=$controleur->trouverCours();

			foreach($membres as $membre)
				echo $membre->description();

			foreach($courss as $cours)
				echo $cours->description();

			$vues=array($vuess[0], $vuess[1]);
			$nez=array($nezz[0], $nezz[1]);
			$bouches=array($bouchess[0], $bouchess[1]);
			$cepages=array($cepagess[0], $cepagess[1]);

			$nvPartie=$controleur->ajouterPartie($partie, $vins[0], $membres[0], $vues, $nez, $bouches);
			$nvVin=$controleur->ajouterVin($vin, $domaines[0], $appellations[0], $typesVins[0], $cepages, $vues, $nez, $bouches, $scoresVues);
			
			echo $nvPartie->description();
			echo $nvVin->description();


			$controleur->supprimerPartie($nvPartie);
			$controleur->supprimerVin($nvVin);

			
		?>
	</body>

<html>