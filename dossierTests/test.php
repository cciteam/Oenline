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
			//les fonctions suivantes permettent de récupérer toutes les lignes des tables correspondantes sous forme d'objets
			//par exemple, $controleur->cepage retourne un tableau d'objets de la classe "Cepage" de tous les cépages stockés dans la base de données
			$cepages=$controleur->trouverCepages();
			$vins=$controleur->trouverVins();
			$typesVins=$controleur->trouverTypesVins();
			$appellations=$controleur->trouverAppellations();
			$bouches=$controleur->trouverBouchesParTypeVin($typesVins[0]);

			echo "les bouches <br>";
			foreach($bouches as $bouche)
			{
				echo $bouche->description();
			}

			//comme $cepage est un tableau, il faut une boucle pour le parcourir
			echo "Les cépages: ";
			foreach ($cepages as $cepage) {
				//on peut accéder aux valeurs des variables des objets directement, elles ont été déclaré public dans la classe
				echo "</br><br/>En y accédant par les variables: <br/> $cepage->idCepage $cepage->nomCepage";
				//description() est une fonction qui retourne une chaîne de caractères qui décrit l'objet
				echo '<br/>Avec la fonction description:<br/>'.$cepage->description();
			}

			echo "<br/>Les vins: <br/>";
			foreach ($vins as $vin) {
				echo "<br/><br/>En y accédant par les variables: <br/>$vin->idVin $vin->nomVin $vin->descCourte $vin->descLongue $vin->millesime </br>";
				echo '<br/>Avec la fonction description:<br/>'.$vin->description();
			}

			echo "<br/><br/>Les types de vins: ";
			foreach ($typesVins as $typeVin) {
				echo "<br/><br>En y accédant par les variables: <br/>$typeVin->idTypeVin $typeVin->nomTypeVin ";
				echo '<br/>Avec la fonction description:<br/>'.$typeVin->description();
			}

			echo "<br/><br/>Les appellations: ";
			foreach ($appellations as $appellation) {
				echo "<br/><br/>En y accédant par les variables: <br/>$appellation->idAppellation $appellation->nomAppellation ";
				echo '<br/>Avec la fonction description:<br/>'.$appellation->description();
			}

			//les fonctions suivantes permettent de trouver des vins selon leurs différentes propriétés
			//par exemple, $controleur->trouverVinsParNomDeDomaine trouve les vins qui contiennent les lettres données en paramètre (il fonctionne avec un LIKE, comme ça il ne faut pas entre le nom exact)
			$vinsDom=$controleur->trouverVinsParNomDeDomaine("ch");
			$vinsCep=$controleur->trouverVinsParCepage($cepages[0]);
			$vinsApp=$controleur->trouverVinsParAppellation($appellations[0]);
			$vinsTyp=$controleur->trouverVinsParTypeVin($typesVins[0]);
			$vinsNom=$controleur->trouverVinsParNom("vin1");

			echo "<br/><br/>Les vins correspondant au domaines contenant 'ch' dans le nom: <br/>";
			foreach ($vinsDom as $vin) {
				echo $vin->nomVin.'<br/>';
			}

			echo "<br/>Les vins correspondant au premier cepage de la liste cepages: <br/>";
			foreach ($vinsCep as $vin) {
				echo $vin->nomVin.'<br/>';
			}

			echo "<br/>Les vins correspondant à la première appellation de la liste appellations: <br/>";
			foreach ($vinsApp as $vin) {
				echo $vin->nomVin.'<br/>';
			}

			echo "<br/>Les vins correspondant au premier type de vin de la liste typesVins: <br/>";
			foreach ($vinsTyp as $vin) {
				echo $vin->nomVin.'<br/>';
			}

			echo "<br/>Les vins contenant 'vin1' dans le nom: <br/>";
			foreach ($vinsNom as $vin) {
				echo $vin->nomVin.'<br/>';
			}

			//les fonctions suivantes permettent de retrouver les propriétés d'un vin donné en paramètre
			$cepsVin=$controleur->trouverCepagesParVin($vinsDom[0]);

			//peut-être à améliorer, les fonctions suivantes retournent des tableaux, même si ces tableaux contiennent TOUJOURS qu'une seule ligne...
			$domsVin=$controleur->trouverDomainesParVin($vinsDom[0]);
			$appsVin=$controleur->trouverAppellationsParVin($vinsDom[0]);
			$typsVin=$controleur->trouverTypesVinsParVin($vinsDom[0]);

			//ce qui force à parcourir un tableau... d'une seule ligne
			echo '<br/>Le vin'.$vinsDom[0]->description().'<br/>Il est composé des cépages: ';
			foreach ($cepsVin as $cep) {
				echo "<br/>-$cep->nomCepage ";
			}

			foreach ($domsVin as $dom) {
				echo "<br/>Il a été produit au $dom->nomDomaine ";
			}

			foreach ($appsVin as $app) {
				echo "<br/>C'est un $app->nomAppellation ";
			}
			
			foreach ($typsVin as $typ) {
				echo "<br/>C'est un vin $typ->nomTypeVin ";
			}
			
			
		?>

	</body>
</html>