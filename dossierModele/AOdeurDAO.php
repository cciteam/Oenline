<?php

interface AOdeurDAO
{
	public function ajouter($aOdeur);
	public function supprimer($aOdeur);
	public function modifier($aOdeur);
	public function trouverTout();
	public function trouverParIdVin($idVin);
	public function trouverParIdNez($idNez);
}

?>