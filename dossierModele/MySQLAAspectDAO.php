<?php
require_once("AAspectDAO.php");
require_once("AAspect.php");
require_once("ConnexionBDD.php");
class MySQLAAspectDAO implements AAspectDAO
{
	private $connexion=NULL;
	private $nomTable="AAspect";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($aAspect)
	{
		$requete="INSERT INTO $this->nomTable (idVin, idRobe) VALUES ('$aAspect->idVin', '$aAspect->idRobe')";
		$this->connexion->executer($requete);
		return $aAspect;
	}

	public function supprimer($aAspect)
	{
		$requete="DELETE FROM $this->nomTable WHERE idVin='$aAspect->idVin' AND idRobe='$aAspect->idRobe'";
		$this->connexion->executer($requete);
	}

	public function modifier($aAspect)
	{
		$requete="UPDATE $this->nomTable SET idVin='$aAspect->idVin' , idRobe='$aAspect->idRobe' WHERE idVin='$aAspect->idVin' AND idRobe='$aAspect->idRobe'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerOntAspect($resultat);	
	}

	public function trouverParIdVin($idVin)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idVin)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idVin IN ($idVin[0]";
		for($i=1; $i<count($idVin); $i++)
		{
			$requete.=", $idVin[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerOntAspect($resultat);
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
		return $this->creerOntAspect($resultat);
	}

	private function creerOntAspect($resultatRequete)
	{
		$ontAspect=array();
		foreach($resultatRequete as $ligne)
			$ontAspect[]=new AAspect($ligne['idVin'], $ligne['idRobe']);
		return $ontAspect;
	}
}
?>