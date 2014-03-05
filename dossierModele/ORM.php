<?php

interface ORM
{
	public function ajouterVin($vin, $domaine, $appellation, $typeVin, $cepages, $vues, $nezz, $bouches);
	public function supprimerVin($vin);
	public function trouverVinsParNomDeDomaine($nomDomaine);
	public function trouverVinsParCepage($cepage);
	public function trouverCepagesParVin($idDomaine);
	public function ajouterCepagesVin($vin, $cepage);
}

?>