<?php
require_once("PartieDAO.php");
require_once("Partie.php");
require_once("ConnexionBDD.php");
class MySQLPartieDAO implements PartieDAO
{
	private $connexion=NULL;
	private $nomTable="Partie";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($partie)
	{
		$requete="INSERT INTO $this->nomTable (datePartie, scorePartie, commentairePartie, idVin, idMembre) VALUES ('$partie->datePartie', '$partie->scorePartie', '$partie->commentairePartie', '$partie->idVin', '$partie->idMembre')";
		$this->connexion->executer($requete);
		$partie->idPartie = $this->connexion->dernierID();
		return $partie;
	}

	public function supprimer($partie)
	{
		$requete="DELETE FROM $this->nomTable WHERE idPartie='$partie->idPartie'";
		$this->connexion->executer($requete);
	}

	public function modifier($partie)
	{
		$requete="UPDATE $this->nomTable SET datePartie='$partie->datePartie' , scorePartie='$partie->scorePartie' , commentairePartie='$partie->commentairePartie' , idVin='$partie->idVin' , idMembre='$partie->idMembre'  WHERE idPartie='$partie->idPartie'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerParties($resultat);	
	}

	public function trouverParIdPartie($idPartie)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idPartie)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idPartie IN ($idPartie[0]";
		for($i=1; $i<count($idPartie); $i++)
		{
			$requete.=", $idPartie[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerParties($resultat);
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
		return $this->creerParties($resultat);
	}

	

	public function trouverParIdMembre($idMembre)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idMembre)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idMembre IN ($idMembre[0]";
		for($i=1; $i<count($idMembre); $i++)
		{
			$requete.=", $idMembre[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerParties($resultat);
	}

	public function trouverParDate($datePartie)
	{
		$requete="SELECT * FROM $this->nomTable WHERE datePartie='$datePartie'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerParties($resultat);
	}

	public function trouverParScore($scorePartieBas, $scorePartieHaut)
	{
		$requete="SELECT * FROM $this->nomTable WHERE scorePartie>='$scorePartieBas' AND  scorePartie<='$scorePartieHaut'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerParties($resultat);
	}

	public function creerParties($resultatRequete)
	{
		$parties=array();
		foreach($resultatRequete as $ligne)
			$parties[]=new Partie($ligne['idPartie'], $ligne['datePartie'], $ligne['scorePartie'], $ligne['commentairePartie'], $ligne['idVin'], $ligne['idMembre']);
		return $parties;
	}
}
?>