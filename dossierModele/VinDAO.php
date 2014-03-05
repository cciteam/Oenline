<?php

interface VinDAO
{
	public function ajouter($vin);
	public function supprimer($vin);
	public function modifier($vin);
	public function trouverTout();
	public function trouverParIdVin($idVin);
	public function trouverParNom($nomVin);
	public function trouverParIdDomaine($idDomaine);
	public function trouverParIdAppellation($idAppellation);
	public function trouverParIdTypeVin($idTypeVin);
}

?>