<?php
require_once("AppellationDAO.php");
require_once("Appellation.php");
require_once("ConnexionBDD.php");

class MySQLAppellationDAO implements AppellationDAO
{
	private $connexion=NULL;
	private $nomTable="Appellation";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($appellation)
	{
		$requete="INSERT INTO $this->nomTable (nomAppellation) VALUES ('$appellation->nomAppellation')";
		$this->connexion->executer($requete);
		$appellation->idAppellation = $this->connexion->dernierID();
		return $appellation;
	}

	public function supprimer($appellation)
	{
		$requete="DELETE FROM $this->nomTable WHERE idAppellation='$appellation->idAppellation'";
		$this->connexion->executer($requete);
	}

	public function modifier($appellation)
	{
		$requete="UPDATE $this->nomTable SET nomApellation='$appellation->nomAppellation' WHERE idAppellation='$appellation->idAppellation'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable ORDER BY nomAppellation";
		$resultat=$this->connexion->executer($requete);
		return $this->creerAppellations($resultat);	
	}

	public function trouverParId($ids)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($ids)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idAppellation IN ($ids[0]";
		for($i=1; $i<count($ids); $i++)
		{
			$requete.=", $ids[$i]";
		}
		$requete.=") ORDER BY nomAppellation";
		$resultat=$this->connexion->executer($requete);
		return $this->creerAppellations($resultat);
	}

	public function trouverParNom($nomAppellation)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomAppellation='$nomAppellation'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerAppellations($resultat);
	}

	private function creerAppellations($resultatRequete)
	{
		$appellations=array();
		foreach($resultatRequete as $ligne)
			$appellations[]=new Appellation($ligne['idAppellation'], $ligne['nomAppellation']);
		return $appellations;
	}
	
}

?>