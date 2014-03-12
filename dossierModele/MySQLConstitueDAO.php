<?php
require_once("ConstitueDAO.php");
require_once("Constitue.php");
require_once("ConnexionBDD.php");

class MySQLConstitueDAO implements ConstitueDAO
{
	private $connexion=NULL;
	private $nomTable="Constitue";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($constitue)
	{
		$requete="INSERT INTO $this->nomTable (idVin, idCepage) VALUES ('$constitue->idVin', '$constitue->idCepage')";
		$this->connexion->executer($requete);
		return $constitue;
	}

	public function supprimer($constitue)
	{
		$requete="DELETE FROM $this->nomTable WHERE idVin='$constitue->idVin' AND idCepage='$constitue->idCepage'";
		$this->connexion->executer($requete);
	}

	public function modifier($constitue)
	{
		$requete="UPDATE $this->nomTable SET idVin='$constitue->idVin' , idCepage='$constitue->idCepage' WHERE idVin='$constitue->idVin' AND idCepage='$constitue->idCepage'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerConstituent($resultat);	
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
		return $this->creerConstituent($resultat);
	}

	public function trouverParIdCepage($idCepage)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idCepage)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idCepage IN ($idCepage[0]";
		for($i=1; $i<count($idCepage); $i++)
		{
			$requete.=", $idCepage[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerConstituent($resultat);
	}

	private function creerConstituent($resultatRequete)
	{
		$constituent=array();
		foreach($resultatRequete as $ligne)
			$constituent[]=new Constitue($ligne['idVin'], $ligne['idCepage']);
		return $constituent;
	}
	
}

?>