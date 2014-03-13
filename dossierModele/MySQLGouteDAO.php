<?php
require_once("GouteDAO.php");
require_once("Goute.php");
require_once("ConnexionBDD.php");

class MySQLGouteDAO implements GouteDAO
{
	private $connexion=NULL;
	private $nomTable="Goute";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($goute)
	{
		$requete="INSERT INTO $this->nomTable (idPartie, idBouche) VALUES ('$goute->idPartie', '$goute->idBouche')";
		$this->connexion->executer($requete);
		return $goute;
	}

	public function supprimer($goute)
	{
		$requete="DELETE FROM $this->nomTable WHERE idPartie='$goute->idPartie' AND idBouche='$goute->idBouche'";
		$this->connexion->executer($requete);
	}

	public function modifier($goute)
	{
		$requete="UPDATE $this->nomTable SET idPartie='$goute->idPartie' , idBouche='$goute->idBouche' WHERE idPartie='$goute->idPartie' AND idBouche='$goute->idBouche'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerGoutent($resultat);	
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
		return $this->creerGoutent($resultat);
	}

	public function trouverParIdBouche($idBouche)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idBouche)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idBouche IN ($idBouche[0]";
		for($i=1; $i<count($idCepage); $i++)
		{
			$requete.=", $idBouche[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerGoutent($resultat);
	}

	private function creerGoutent($resultatRequete)
	{
		$goutent=array();
		foreach($resultatRequete as $ligne)
			$goutent[]=new Goute($ligne['idPartie'], $ligne['idBouche']);
		return $goutent;
	}
	
}

?>