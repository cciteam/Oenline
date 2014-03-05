<?php

interface AAspectDAO
{
	public function ajouter($aAspect);
	public function supprimer($aAspect);
	public function modifier($aAspect);
	public function trouverTout();
	public function trouverParIdVin($idVin);
	public function trouverParIdRobe($idRobe);
}

?>