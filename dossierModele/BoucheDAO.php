<?php
interface BoucheDAO
{
	public function ajouter($bouche);
	public function supprimer($bouche);
	public function modifier($bouche);
	public function trouverTout();
	public function trouverParIdBouche($idBouche);
	public function trouverParNom($nomBouche);
	public function trouverParTypeDescBouche($typeDescBouche);
	public function trouverParTypeBouche($descBouche);
}
?>