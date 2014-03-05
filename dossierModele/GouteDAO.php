<?php

interface GouteDAO
{
	public function ajouter($goute);
	public function supprimer($goute);
	public function modifier($goute);
	public function trouverTout();
	public function trouverParIdPartie($idPartie);
	public function trouverParIdBouche($idBouche);
}

?>