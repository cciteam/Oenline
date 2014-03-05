<?php
require_once("TypeVinDAO.php");
require_once("TypeVin.php");
require_once("ConnexionBDD.php");

class MySQLTypeVinDAO implements TypeVinDAO
{
	private $connexion=NULL;
	private $nomTable="TypeVin";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($typeVin)
	{
		$requete="INSERT INTO $this->nomTable (nomTypeVin) VALUES ('$typeVin->nomTypeVin')";
		$this->connexion->executer($requete);
		$typeVin->idTypeVin = $this->connexion->dernierID();
		return $typeVin;
	}

	public function supprimer($typeVin)
	{
		$requete="DELETE FROM $this->nomTable WHERE idTypeVin='$typeVin->idTypeVin'";
		$this->connexion->executer($requete);
	}

	public function modifier($typeVin)
	{
		$requete="UPDATE $this->nomTable SET nomTypeVin='$typeVin->nomTypeVin' WHERE idTypeVin='$typeVin->idTypeVin'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerTypesVins($resultat);	
	}

	public function trouverParId($ids)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($ids)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idTypeVin IN ($ids[0]";
		for($i=1; $i<count($ids); $i++)
		{
			$requete.=", $ids[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerTypesVins($resultat);
	}

	public function trouverParNom($nomTypeVin)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomTypeVin='$nomTypeVin'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerTypesVins($resultat);
	}

	private function creerTypesVins($resultatRequete)
	{
		$typesVins=array();
		while($ligne=mysql_fetch_array($resultatRequete))
			$typesVins[]=new TypeVin($ligne['idTypeVin'], $ligne['nomTypeVin']);
		return $typesVins;
	}
	
}

?>