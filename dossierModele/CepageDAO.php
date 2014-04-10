<?php
interface CepageDAO
{
	public function ajouter($cepage);
	public function supprimer($cepage);
	public function modifier($cepage);
	public function trouverTout();
	public function trouverParId($ids);
	public function trouverParNom($nomCepage);
}
?>