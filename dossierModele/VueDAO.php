<?php

interface VueDAO
{
	public function ajouter($vue);
	public function supprimer($vue);
	public function modifier($vue);
	public function trouverTout();
	public function trouverParIdRobe($idRobe);
	public function trouverParNom($nomRobe);
	public function trouverParTypeDescRobe($typeDescRobe);
	public function trouverParTypeRobe($typeRobe);
	public function trouverParIdTypeVin($idTypeVin);
}

?>