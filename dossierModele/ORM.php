<?php

interface ORM
{
	public function ajouterVin($vin, $domaine, $appellation, $typeVin, $cepages, $robes, $nezz, $bouches);
	public function ajouterPartie($partie, $vin, $membre, $robes, $nezz, $bouches);
	public function ajouterMembre($membre, $groupe);
	public function ajouterCepagesVin($vin, $cepages);

	public function supprimerVin($vin);
	public function supprimerPartie($partie);

	public function trouverVinsParNomDeDomaine($nomDomaine);
	public function trouverVinsParCepage($cepage);

	public function trouverCepagesParVin($vin);

	public function trouverBouchesParTypeVin($typeVin);
	public function trouverNezParTypeVin($typeVin);
	public function trouverRobesParTypeVin($typeVin);

	public function trouverBouchesParVin($vin);
	public function trouverRobesParVin($vin);
	public function trouverNezParVin($vin);

	public function trouverGoutsPartie($partie);
	public function trouverNezPartie($partie);
	public function trouverRobesPartie($partie);
	public function calculerScore($idPartie);
	
}

?>