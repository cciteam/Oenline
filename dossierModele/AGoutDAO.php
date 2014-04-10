<?php
interface AGoutDAO
{
	public function ajouter($aGout);
	public function supprimer($aGout);
	public function modifier($aOdeur);
	public function trouverTout();
	public function trouverParIdVin($idVin);
	public function trouverParIdBouche($idBouche);
}
?>