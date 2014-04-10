<?php
interface TypeVinDAO 
{
	public function ajouter($typeVin);
	public function supprimer($typeVin);
	public function modifier($typeVin);
	public function trouverTout();
	public function trouverParId($ids);
	public function trouverParNom($nomTypeVin);
}
?>