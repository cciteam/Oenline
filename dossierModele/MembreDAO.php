<?php

interface MembreDAO
{
	public function ajouter($membre);
	public function supprimer($membre);
	public function modifier($membre);
	public function trouverTout();
	public function trouverParIdMembre($idMembre);
	public function trouverParPseudo($pseudo);
	public function trouverParNom($nomMembre);
	public function trouverParMail($mail);
	public function trouverParIdGroupe($idGroupe);
}

?>