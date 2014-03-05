<?php

interface SentDAO
{
	public function ajouter($sent);
	public function supprimer($sent);
	public function modifier($sent);
	public function trouverTout();
	public function trouverParIdPartie($idPartie);
	public function trouverParIdNez($idNez);
}

?>