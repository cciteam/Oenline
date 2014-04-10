<?php
interface PartieDAO
{
	public function ajouter($partie);
	public function supprimer($partie);
	public function modifier($partie);
	public function trouverTout();
	public function trouverParIdPartie($idPartie);
	public function trouverParIdVin($idVin);
	public function trouverParIdMembre($idMembre);
	public function trouverParDate($datePartie);
	public function trouverParScore($scorePartieBas, $scorePartieHaut);
}
?>