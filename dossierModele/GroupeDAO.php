<?php
interface GroupeDAO
{
	public function ajouter($groupe);
	public function supprimer($groupe);
	public function modifier($groupe);
	public function trouverTout();
	public function trouverParIdGroupe($idGroupe);
	public function trouverParNom($nomGroupe);
}
?>