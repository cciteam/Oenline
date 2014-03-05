<?php
require_once("GroupeDAO.php");
require_once("Groupe.php");
require_once("ConnexionBDD.php");

class MySQLGroupeDAO implements GroupeDAO
{
	private $connexion=NULL;
	private $nomTable="groupe";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($groupe)
	{
		$requete="INSERT INTO $this->nomTable (nomGroupe) VALUES ('$groupe->nomGroupe')";
		$this->connexion->executer($requete);
		$groupe->idGroupe = $this->connexion->dernierID();
		return $groupe;
	}

	public function supprimer($groupe)
	{
		$requete="DELETE FROM $this->nomTable WHERE idGroupe='$groupe->idGroupe'";
		$this->connexion->executer($requete);
	}

	public function modifier($groupe)
	{
		$requete="UPDATE $this->nomTable SET nomGroupe='$groupe->nomGroupe'  WHERE idGroupe='$groupe->idGroupe'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerGroupes($resultat);	
	}

	public function trouverParIdgroupe($idgroupe)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idgroupe)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idgroupe IN ($idgroupe[0]";
		for($i=1; $i<count($idgroupe); $i++)
		{
			$requete.=", $idgroupe[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerGroupes($resultat);
	}


	public function trouverParNom($nomGroupe)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomGroupe='$nomGroupe'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerGroupes($resultat);
	}


	public function creerGroupes($resultatRequete)
	{
		$groupes=array();
		while($ligne=mysql_fetch_array($resultatRequete))
			$groupes[]=new Groupe($ligne['idgroupe'], $ligne['nomgroupe']);
		return $groupes;
	}
	
}

?>