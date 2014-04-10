<?php
require_once("CepageDAO.php");
require_once("Cepage.php");
require_once("ConnexionBDD.php");
class MySQLCepageDAO implements CepageDAO
{
	private $connexion=NULL;
	private $nomTable="Cepage";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($cepage)
	{
		$requete="INSERT INTO $this->nomTable (nomCepage) VALUES ('$cepage->nomCepage')";
		$this->connexion->executer($requete);
		$cepage->idCepage = $this->connexion->dernierID();
		return $cepage;
	}

	public function supprimer($cepage)
	{
		$requete="DELETE FROM $this->nomTable WHERE idCepage='$cepage->idCepage'";
		$this->connexion->executer($requete);
	}

	public function modifier($cepage)
	{
		$requete="UPDATE $this->nomTable SET nomCepage='$cepage->nomCepage' WHERE idCepage='$cepage->idCepage'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable ORDER BY nomCepage";
		$resultat=$this->connexion->executer($requete);
		return $this->creerCepages($resultat);	
	}

	public function trouverParId($ids)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($ids)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idCepage IN ($ids[0]";
		for($i=1; $i<count($ids); $i++)
		{
			$requete.=", $ids[$i]";
		}
		$requete.=") ORDER BY nomCepage";
		$resultat=$this->connexion->executer($requete);
		return $this->creerCepages($resultat);
	}

	public function trouverParNom($nomCepage)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomCepage='$nomCepage'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerCepages($resultat);
	}

	private function creerCepages($resultatRequete)
	{
		$cepages=array();
		foreach($resultatRequete as $ligne)
			$cepages[]=new Cepage($ligne['idCepage'], $ligne['nomCepage']);
		return $cepages;
	}	
}
?>