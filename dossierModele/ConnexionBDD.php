<?php 

interface ConnexionBDD
{
	public function connecter();
	public function deconnecter();
	public function executer($requete);
	public function commencerTransaction();
	public function validerTransaction();
	public function annulerTransaction();
	public function dernierID();
}

?>