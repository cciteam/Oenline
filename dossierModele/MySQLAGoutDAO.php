<?php
require_once("AGoutDAO.php");
require_once("AGout.php");
require_once("ConnexionBDD.php");

class MySQLAGoutDAO implements AGoutDAO
{
	private $connexion=NULL;
	private $nomTable="AGout";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($aGout)
	{
		$requete="INSERT INTO $this->nomTable (idVin, idBouche, scoreGout) VALUES ('$aGout->idVin', '$aGout->idBouche', '$aGout->scoreGout')";
		$this->connexion->executer($requete);
		return $aGout;
	}

	public function supprimer($aGout)
	{
		$requete="DELETE FROM $this->nomTable WHERE idVin='$aGout->idVin' AND idBouche='$aGout->idBouche'";
		$this->connexion->executer($requete);
	}

	public function modifier($aGout)
	{
		$requete="UPDATE $this->nomTable SET idVin='$aGout->idVin' , idBouche='$aGout->idBouche', scoreGout='$aGout->scoreGout' WHERE idVin='$aGout->idVin' AND idBouche='$aGout->idBouche'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerOntGout($resultat);	
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
		return $this->creerOntGout($resultat);
	}

	public function trouverParIdBouche($idBouche)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idNez)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idBouche IN ($idBouche[0]";
		for($i=1; $i<count($idBouche); $i++)
		{
			$requete.=", $idBouche[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerOntGout($resultat);
	}

	private function creerOntGout($resultatRequete)
	{
		$ontGout=array();
		while($ligne=mysql_fetch_array($resultatRequete))
			$ontGout[]=new AGout($ligne['idVin'], $ligne['idBouche'], $ligne['scoreGout']);
		return $ontGout;
	}
	
}

?>