<?php
require_once("DomaineDAO.php");
require_once("Domaine.php");
require_once("ConnexionBDD.php");

class MySQLDomaineDAO implements DomaineDAO
{
	private $connexion=NULL;
	private $nomTable="Domaine";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($domaine)
	{
		$requete="INSERT INTO $this->nomTable (nomDomaine, urlDomaine) VALUES ('$domaine->nomDomaine', '$domaine->urlDomaine')";
		$this->connexion->executer($requete);
		$domaine->idDomaine = $this->connexion->dernierID();
		return $domaine;
	}

	public function supprimer($domaine)
	{
		$requete="DELETE FROM $this->nomTable WHERE idDomaine='$domaine->idDomaine'";
		$this->connexion->executer($requete);
	}

	public function modifier($domaine)
	{
		$requete="UPDATE $this->nomTable SET nomDomaine='$domaine->nomDomaine' , urlDomaine='$domaine->UrlDomaine' WHERE idDomaine='$domaine->idDomaine'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerDomaines($resultat);	
	}

	public function trouverParId($ids)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($ids)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idDomaine IN ($ids[0]";
		for($i=1; $i<count($ids); $i++)
		{
			$requete.=", $ids[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerDomaines($resultat);
	}

	public function trouverParNom($nomDomaine)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomDomaine='$nomDomaine'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerDomaines($resultat);
	}

	public function rechercherParNom($nomDomaine)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomDomaine LIKE '%$nomDomaine%'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerDomaines($resultat);
	}

	private function creerDomaines($resultatRequete)
	{
		$domaines=array();
		while($ligne=mysql_fetch_array($resultatRequete))
			$domaines[]=new Domaine($ligne['idDomaine'], $ligne['nomDomaine'], $ligne['urlDomaine']);
		return $domaines;
	}
	
}

?>