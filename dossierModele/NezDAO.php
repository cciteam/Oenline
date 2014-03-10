<?php

interface NezDAO
{
	public function ajouter($nez);
	public function supprimer($nez);
	public function modifier($nez);
	public function trouverTout();
	public function trouverParIdNez($idNez);
	public function trouverParNom($nomNez);
	public function trouverParTypeNez($typeNez);
}

?>