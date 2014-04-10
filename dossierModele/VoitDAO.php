<?php
interface VoitDAO
{
	public function ajouter($voit);
	public function supprimer($voit);
	public function modifier($voit);
	public function trouverTout();
	public function trouverParIdPartie($idPartie);
	public function trouverParIdRobe($idRobe);
}
?>