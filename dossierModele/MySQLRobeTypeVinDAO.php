<?php
require_once("RobeTypeVinDAO.php");
require_once("RobeTypeVin.php");
require_once("ConnexionBDD.php");

class MySQLRobeTypeVinDAO implements RobeTypeVinDAO
{
	private $connexion=NULL;
	private $nomTable="robeTypeVin";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($robeTypeVin)
	{
		$requete="INSERT INTO $this->nomTable (idTypeVin, idRobe) VALUES ('$robeTypeVin->idTypeVin', '$robeTypeVin->idRobe')";
		$this->connexion->executer($requete);
		return $RobeTypeVin;
	}

	public function supprimer($robeTypeVin)
	{
		$requete="DELETE FROM $this->nomTable WHERE idTypeVin='$robeTypeVin->idTypeVin' AND idRobe='$robeTypeVin->idRobe'";
		$this->connexion->executer($requete);
	}

	public function modifier($robeTypeVin)
	{
		$requete="UPDATE $this->nomTable SET idTypeVin='$robeTypeVin->idTypeVin' , idRobe='$robeTypeVin->idRobe' WHERE idTypeVin='$robeTypeVin->idTypeVin' AND idRobe='$robeTypeVin->idRobe'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerRobesTypesVins($resultat);	
	}

	public function trouverParIdTypeVin($idTypeVin)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idTypeVin)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idTypeVin IN ($idTypeVin[0]";
		for($i=1; $i<count($idTypeVin); $i++)
		{
			$requete.=", $idTypeVin[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerRobesTypesVins($resultat);
	}

	public function trouverParIdRobe($idRobe)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idRobe)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idRobe IN ($idRobe[0]";
		for($i=1; $i<count($idRobe); $i++)
		{
			$requete.=", $idRobe[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerRobesTypesVins($resultat);
	}

	private function creerRobesTypesVins($resultatRequete)
	{
		$robesTypesVins=array();
		foreach($resultatRequete as $ligne)
			$robesTypesVins[]=new RobeTypeVin($ligne['idTypeVin'], $ligne['idRobe']);
		return $robesTypesVins;
	}
	
}

?>