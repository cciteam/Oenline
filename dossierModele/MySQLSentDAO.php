<?php
require_once("SentDAO.php");
require_once("Sent.php");
require_once("ConnexionBDD.php");

class MySQLSentDAO implements SentDAO
{
	private $connexion=NULL;
	private $nomTable="Sent";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($sent)
	{
		$requete="INSERT INTO $this->nomTable (idPartie, idNez) VALUES ('$sent->idPartie', '$sent->idNez')";
		$this->connexion->executer($requete);
		return $sent;
	}

	public function supprimer($sent)
	{
		$requete="DELETE FROM $this->nomTable WHERE idPartie='$sent->idPartie' AND idNez='$sent->idNez'";
		$this->connexion->executer($requete);
	}

	public function modifier($sent)
	{
		$requete="UPDATE $this->nomTable SET idPartie='$sent->idPartie' , idNez='$sent->idNez' WHERE idPartie='$sent->idPartie' AND idNez='$sent->idNez'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerSentent($resultat);	
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
		return $this->creerSentent($resultat);
	}

	public function trouverParIdNez($idNez)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idNez)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idNez IN ($idNez[0]";
		for($i=1; $i<count($idCepage); $i++)
		{
			$requete.=", $idNez[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerSentent($resultat);
	}

	private function creerSentent($resultatRequete)
	{
		$sentent=array();
		foreach($resultatRequete as $ligne)
			$sentent[]=new Sent($ligne['idPartie'], $ligne['idNez']);
		return $sentent;
	}
	
}

?>