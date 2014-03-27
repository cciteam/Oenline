<?php
require_once("CoursDAO.php");
require_once("Cours.php");
require_once("ConnexionBDD.php");

class MySQLCoursDAO implements CoursDAO
{
	private $connexion=NULL;
	private $nomTable="Cours";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($cours)
	{
		$requete="INSERT INTO $this->nomTable (titreCours, motCleCours, urlCours) VALUES ('$cours->titreCours', '$cours->motCleCours', '$cours->urlCours')";
		$this->connexion->executer($requete);
		$cours->idCours = $this->connexion->dernierID();
		return $cours;
	}

	public function supprimer($cours)
	{
		$requete="DELETE FROM $this->nomTable WHERE idCours='$cours->idCours'";
		$this->connexion->executer($requete);
	}

	public function modifier($cours)
	{
		$requete="UPDATE $this->nomTable SET titreCours='$cours->titreCours' , motCleCours='$cours->motCleCours' , urlCours='$cours->urlCours' WHERE idCours='$cours->idCours'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerCours($resultat);	
	}

	public function trouverParIdcours($idCours)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idCours)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idCours IN ($idCours[0]";
		for($i=1; $i<count($idcours); $i++)
		{
			$requete.=", $idCours[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerCours($resultat);
	}

	public function trouverParTitre($titreCours)
	{
		$requete="SELECT * FROM $this->nomTable WHERE titreCours LIKE '$titreCours'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerCours($resultat);
	}

	public function rechercherParMotCle($motCle)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomcours LIKE '%$motCle%'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerCours($resultat);
	}


	public function creerCours($resultatRequete)
	{
		$cours=array();
		foreach($resultatRequete as $ligne)
			$cours[]=new cours($ligne['idCours'], $ligne['titreCours'], $ligne['motCleCours'], $ligne['urlCours']);
		return $cours;
	}
	
}

?>