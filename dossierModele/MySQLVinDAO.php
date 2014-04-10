<?php
require_once("VinDAO.php");
require_once("Vin.php");
require_once("ConnexionBDD.php");
class MySQLVinDAO implements VinDAO
{
	private $connexion=NULL;
	private $nomTable="Vin";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($vin)
	{
		$requete="INSERT INTO $this->nomTable (nomVin, descLongue, descCourte, millesime, idDomaine, idAppellation, idTypeVin) VALUES ('$vin->nomVin', '$vin->descLongue', '$vin->descCourte', '$vin->millesime', '$vin->idDomaine', '$vin->idAppellation', '$vin->idTypeVin')";
		$this->connexion->executer($requete);
		$vin->idVin = $this->connexion->dernierID();
		return $vin;
	}

	public function supprimer($vin)
	{
		$requete="DELETE FROM $this->nomTable WHERE idVin='$vin->idVin'";
		$this->connexion->executer($requete);
	}

	public function modifier($vin)
	{
		$requete="UPDATE $this->nomTable SET nomVin='$vin->nomVin' , idDomaine='$vin->idDomaine' , idAppellation='$vin->idAppellation' , idTypeVin='$vin->idTypeVin' , descCourte='$vin->descCourte' , descLongue='$vin->descLongue'  WHERE idVin='$vin->idVin'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable ORDER BY idDomaine";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVins($resultat);	
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
		$requete.=") ORDER BY idDomaine";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVins($resultat);
	}

	public function trouverParNom($nomVin)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomVin='$nomVin' ORDER BY idDomaine";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVins($resultat);
	}

	public function rechercherParNom($nomVin)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomVin LIKE '%$nomVin%' ORDER BY idDomaine";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVins($resultat);
	}

	public function trouverParIdDomaine($idDomaine)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idDomaine)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idDomaine IN ($idDomaine[0]";
		for($i=1; $i<count($idDomaine); $i++)
		{
			$requete.=", $idDomaine[$i]";
		}
		$requete.=") ORDER BY idDomaine";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVins($resultat);
	}

	public function trouverParIdAppellation($idAppellation)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idAppellation)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idAppellation IN ($idAppellation[0]";
		for($i=1; $i<count($idAppellation); $i++)
		{
			$requete.=", $idAppellation[$i]";
		}
		$requete.=") ORDER BY idDomaine";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVins($resultat);
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
		$requete.=") ORDER BY idDomaine";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVins($resultat);
	}

	public function creerVins($resultatRequete)
	{
		$vins=array();
		foreach($resultatRequete as $ligne)
			$vins[]=new Vin($ligne['idVin'], $ligne['nomVin'], $ligne['millesime'], $ligne['descCourte'], $ligne['descLongue'], $ligne['idDomaine'], $ligne['idAppellation'], $ligne['idTypeVin']);
		return $vins;
	}
}
?>