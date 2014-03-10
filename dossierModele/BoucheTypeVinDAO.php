<?php

interface BoucheTypeVinDAO
{
	public function ajouter($boucheTypeVin);
	public function supprimer($boucheTypeVin);
	public function modifier($boucheTypeVin);
	public function trouverTout();
	public function trouverParIdTypeVin($idTypeVin);
	public function trouverParIdBouche($idBouche);
}

?>