<?php

interface NezTypeVinDAO
{
	public function ajouter($nezTypeVin);
	public function supprimer($nezTypeVin);
	public function modifier($nezTypeVin);
	public function trouverTout();
	public function trouverParIdTypeVin($idTypeVin);
	public function trouverParIdNez($idNez);
}

?>