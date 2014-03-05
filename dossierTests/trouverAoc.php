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
			
			$appellations=$controleur->trouverAppellations();

			foreach ($appellations as $appellation) {
				$vinsApp=$controleur->trouverVinsParAppellation($appellation);
				echo '<br/>'.$appellation->nomAppellation.': <br/>';
				foreach ($vinsApp as $vin) {
					echo $vin->nomVin.'<br/>';
				}

			}
			
			
		?>

	</body>
</html>