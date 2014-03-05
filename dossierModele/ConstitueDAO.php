<?php

interface ConstitueDAO
{
	public function ajouter($constitue);
	public function supprimer($constitue);
	public function modifier($constitue);
	public function trouverTout();
	public function trouverParIdVin($idVin);
	public function trouverParIdCepage($idCepage);
}

?>