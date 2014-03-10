<?php
require_once("NezTypeVinDAO.php");
require_once("NezTypeVin.php");
require_once("ConnexionBDD.php");

class MySQLNezTypeVinDAO implements NezTypeVinDAO
{
	private $connexion=NULL;
	private $nomTable="nezTypeVin";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($nezTypeVin)
	{
		$requete="INSERT INTO $this->nomTable (idTypeVin, idNez) VALUES ('$nezTypeVin->idTypeVin', '$nezTypeVin->idNez')";
		$this->connexion->executer($requete);
		return $nezTypeVin;
	}

	public function supprimer($nezTypeVin)
	{
		$requete="DELETE FROM $this->nomTable WHERE idTypeVin='$nezTypeVin->idTypeVin' AND idNez='$nezTypeVin->idNez'";
		$this->connexion->executer($requete);
	}

	public function modifier($nezTypeVin)
	{
		$requete="UPDATE $this->nomTable SET idTypeVin='$nezTypeVin->idTypeVin' , idNez='$nezTypeVin->idNez' WHERE idTypeVin='$nezTypeVin->idTypeVin' AND idNez='$nezTypeVin->idNez'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerNezTypesVins($resultat);	
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
		return $this->creerNezTypesVins($resultat);
	}

	public function trouverParidNez($idNez)
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
		return $this->creerNezTypesVins($resultat);
	}

	private function creerNezTypesVins($resultatRequete)
	{
		$nezTypesVins=array();
		while($ligne=mysql_fetch_array($resultatRequete))
			$nezTypesVins[]=new NezTypeVin($ligne['idTypeVin'], $ligne['idNez']);
		return $nezTypesVins;
	}
	
}

?>