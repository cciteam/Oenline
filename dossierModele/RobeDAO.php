<?php
interface RobeDAO
{
	public function ajouter($robe);
	public function supprimer($robe);
	public function modifier($robe);
	public function trouverTout();
	public function trouverParIdRobe($idRobe);
	public function trouverParNom($nomRobe);
	public function trouverParTypeDescRobe($typeDescRobe);
	public function trouverParTypeRobe($typeRobe);
}
?>