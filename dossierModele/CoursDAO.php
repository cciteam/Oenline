<?php

interface CoursDAO
{
	public function ajouter($cours);
	public function supprimer($cours);
	public function modifier($cours);
	public function trouverTout();
	public function trouverParIdCours($idCours);
	public function trouverParTitre($titreCours);
	public function rechercherParMotCle($motCle);
}

?>