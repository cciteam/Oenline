<?php
require_once("AOdeurDAO.php");
require_once("AOdeur.php");
require_once("ConnexionBDD.php");

class MySQLAOdeurDAO implements AOdeurDAO
{
	private $connexion=NULL;
	private $nomTable="AOdeur";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($aOdeur)
	{
		$requete="INSERT INTO $this->nomTable (idVin, idNez) VALUES ('$aOdeur->idVin', '$aOdeur->idNez')";
		$this->connexion->executer($requete);
		return $aOdeur;
	}

	public function supprimer($aOdeur)
	{
		$requete="DELETE FROM $this->nomTable WHERE idVin='$aOdeur->idVin' AND idNez='$aOdeur->idNez'";
		$this->connexion->executer($requete);
	}

	public function modifier($aOdeur)
	{
		$requete="UPDATE $this->nomTable SET idVin='$aOdeur->idVin' , idNez='$aOdeur->idNez' WHERE idVin='$aOdeur->idVin' AND idNez='$aOdeur->idNez'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerOntOdeur($resultat);	
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
		return $this->creerOntOdeur($resultat);
	}

	public function trouverParIdNez($idNez)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idNez)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idNez IN ($idNez[0]";
		for($i=1; $i<count($idNez); $i++)
		{
			$requete.=", $idNez[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerOntOdeur($resultat);
	}

	private function creerOntOdeur($resultatRequete)
	{
		$ontOdeur=array();
		while($ligne=mysql_fetch_array($resultatRequete))
			$ontOdeur[]=new AOdeur($ligne['idVin'], $ligne['idNez']);
		return $ontOdeur;
	}
	
}

?>