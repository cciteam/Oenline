<?php
interface RobeTypeVinDAO
{
	public function ajouter($robeTypeVin);
	public function supprimer($robeTypeVin);
	public function modifier($robeTypeVin);
	public function trouverTout();
	public function trouverParIdTypeVin($idTypeVin);
	public function trouverParIdRobe($idRobe);
}
?>