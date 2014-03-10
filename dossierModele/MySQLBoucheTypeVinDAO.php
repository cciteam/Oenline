<?php
require_once("BoucheTypeVinDAO.php");
require_once("BoucheTypeVin.php");
require_once("ConnexionBDD.php");

class MySQLBoucheTypeVinDAO implements BoucheTypeVinDAO
{
	private $connexion=NULL;
	private $nomTable="boucheTypeVin";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($boucheTypeVin)
	{
		$requete="INSERT INTO $this->nomTable (idTypeVin, idBouche) VALUES ('$boucheTypeVin->idTypeVin', '$boucheTypeVin->idBouche')";
		$this->connexion->executer($requete);
		return $boucheTypeVin;
	}

	public function supprimer($boucheTypeVin)
	{
		$requete="DELETE FROM $this->nomTable WHERE idTypeVin='$boucheTypeVin->idTypeVin' AND idBouche='$boucheTypeVin->idBouche'";
		$this->connexion->executer($requete);
	}

	public function modifier($boucheTypeVin)
	{
		$requete="UPDATE $this->nomTable SET idTypeVin='$boucheTypeVin->idTypeVin' , idBouche='$boucheTypeVin->idBouche' WHERE idTypeVin='$boucheTypeVin->idTypeVin' AND idBouche='$boucheTypeVin->idBouche'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerBouchesTypesVins($resultat);	
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
		return $this->creerBouchesTypesVins($resultat);
	}

	public function trouverParIdBouche($idBouche)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idBouche)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idBouche IN ($idBouche[0]";
		for($i=1; $i<count($idBouche); $i++)
		{
			$requete.=", $idBouche[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerBouchesTypesVins($resultat);
	}

	private function creerBouchesTypesVins($resultatRequete)
	{
		$bouchesTypesVins=array();
		while($ligne=mysql_fetch_array($resultatRequete))
			$bouchesTypesVins[]=new BoucheTypeVin($ligne['idTypeVin'], $ligne['idBouche']);
		return $bouchesTypesVins;
	}
	
}

?>