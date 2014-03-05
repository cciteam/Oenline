<?php
require_once("BoucheDAO.php");
require_once("Bouche.php");
require_once("ConnexionBDD.php");

class MySQLBoucheDAO implements BoucheDAO
{
	private $connexion=NULL;
	private $nomTable="Bouche";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($bouche)
	{
		$requete="INSERT INTO $this->nomTable (nomBouche, typeDescBouche, typeBouche, idTypeVin) VALUES ('$bouche->nomBouche', '$bouche->typeDescBouche', '$bouche->typeBouche', '$bouche->idTypeVin')";
		$this->connexion->executer($requete);
		$bouche->idBouche = $this->connexion->dernierID();
		return $bouche;
	}

	public function supprimer($bouche)
	{
		$requete="DELETE FROM $this->nomTable WHERE idBouche='$vin->idBouche'";
		$this->connexion->executer($requete);
	}

	public function modifier($bouche)
	{
		$requete="UPDATE $this->nomTable SET nomBouche='$bouche->nomBouche' , typeDescBouche='$bouche->typeDescBouche' , typeBouche='$bouche->typeBouche' , idTypeVin='$bouche->idTypeVin'  WHERE idBouche='$bouche->idBouche'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerBouches($resultat);	
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
		return $this->creerBouches($resultat);
	}

	public function trouverParNom($nomBouche)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomBouche='$nomBouche'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerBouches($resultat);
	}

	public function trouverParTypeDescBouche($typeDescBouche)
	{
		$requete="SELECT * FROM $this->nomTable WHERE typeDescBouche='$typeDescBouche'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerBouches($resultat);
	}

	public function trouverParTypeBouche($typeBouche)
	{
		$requete="SELECT * FROM $this->nomTable WHERE typeBouche='$typeBouche'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerBouches($resultat);
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
		return $this->creerBouches($resultat);
	}

	public function creerBouches($resultatRequete)
	{
		$bouches=array();
		while($ligne=mysql_fetch_array($resultatRequete))
			$bouches[]=new Bouche($ligne['idBouche'], $ligne['nomBouche'], $ligne['typeDescBouche'], $ligne['typeBouche'], $ligne['idTypeVin']);
		return $bouches;
	}
	
}

?>