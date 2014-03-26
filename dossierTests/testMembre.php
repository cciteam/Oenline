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
			$groupe = new Groupe(2,'user');
			$membre = new Membre('', 'BeauGosseDu45', 'Raoul', '123456mM', 'raoul@cool.com','');

			try
			{
				$nvMembre = $controleur->ajouterMembre($membre, $groupe);
				echo $nvMembre->description();
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
			}

			

		?>

	</body>
</html>