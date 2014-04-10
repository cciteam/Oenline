<?php
require_once("NezDAO.php");
require_once("Nez.php");
require_once("ConnexionBDD.php");
class MySQLNezDAO implements NezDAO
{
	private $connexion=NULL;
	private $nomTable="Nez";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($nez)
	{
		$requete="INSERT INTO $this->nomTable (nomNez, typeNez, scoreNez) VALUES ('$nez->nomNez', '$nez->typeNez', '$nez->scoreNez')";
		$this->connexion->executer($requete);
		$nez->idNez = $this->connexion->dernierID();
		return $nez;
	}

	public function supprimer($nez)
	{
		$requete="DELETE FROM $this->nomTable WHERE idNez='$nez->idNez'";
		$this->connexion->executer($requete);
	}

	public function modifier($nez)
	{
		$requete="UPDATE $this->nomTable SET nomNez='$nez->nomNez' , typeNez='$nez->typeNez' , scoreNez='$nez->scoreNez'  WHERE idRobe='$nez->idNez'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerNez($resultat);	
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
		return $this->creerNez($resultat);
	}

	public function trouverParNom($nomNez)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomNez='$nomNez'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerNez($resultat);
	}

	public function trouverParTypeNez($typeNez)
	{
		$requete="SELECT * FROM $this->nomTable WHERE typeNez='$typeNez'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerNez($resultat);
	}


	public function creerNez($resultatRequete)
	{
		$nez=array();
		foreach($resultatRequete as $ligne)
			$nez[]=new Nez($ligne['idNez'], $ligne['nomNez'], $ligne['typeNez'], $ligne['scoreNez']);
		return $nez;
	}	
}
?>