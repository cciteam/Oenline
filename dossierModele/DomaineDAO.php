<?php
interface DomaineDAO 
{
	public function ajouter($domaine);
	public function supprimer($domaine);
	public function modifier($domaine);
	public function trouverTout();
	public function trouverParId($ids);
	public function trouverParNom($nomDomaine);
	public function rechercherParNom($nomDomaine);
}
?>