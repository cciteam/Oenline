<?php
require_once("VoitDAO.php");
require_once("Voit.php");
require_once("ConnexionBDD.php");

class MySQLVoitDAO implements VoitDAO
{
	private $connexion=NULL;
	private $nomTable="Voit";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($voit)
	{
		$requete="INSERT INTO $this->nomTable (idPartie, idRobe) VALUES ('$voit->idPartie', '$voit->idRobe')";
		$this->connexion->executer($requete);
		return $voit;
	}

	public function supprimer($voit)
	{
		$requete="DELETE FROM $this->nomTable WHERE idPartie='$voit->idPartie' AND idRobe='$voit->idRobe'";
		$this->connexion->executer($requete);
	}

	public function modifier($voit)
	{
		$requete="UPDATE $this->nomTable SET idPartie='$voit->idPartie' , idRobe='$voit->idRobe' WHERE idPartie='$voit->idPartie' AND idRobe='$voit->idRobe'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVoient($resultat);	
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
		return $this->creerVoient($resultat);
	}

	public function trouverParIdRobe($idRobe)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idRobe)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idRobe IN ($idRobe[0]";
		for($i=1; $i<count($idCepage); $i++)
		{
			$requete.=", $idRobe[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVoient($resultat);
	}

	private function creerVoient($resultatRequete)
	{
		$voient=array();
		foreach($resultatRequete as $ligne)
			$voient[]=new Voit($ligne['idPartie'], $ligne['idRobe']);
		return $voient;
	}
	
}

?>