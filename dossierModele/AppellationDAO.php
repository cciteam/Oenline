<?php
interface AppellationDAO 
{
	public function ajouter($appellation);
	public function supprimer($appellation);
	public function modifier($appellation);
	public function trouverTout();
	public function trouverParId($ids);
	public function trouverParNom($nomAppellation);
}
?>