<?php
require_once("VueDAO.php");
require_once("Vue.php");
require_once("ConnexionBDD.php");

class MySQLVueDAO implements VueDAO
{
	private $connexion=NULL;
	private $nomTable="Vue";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($vue)
	{
		$requete="INSERT INTO $this->nomTable (nomRobe, typeDescRobe, typeRobe, idTypeVin) VALUES ('$vue->nomRobe', '$vue->typeDescRobe', '$vue->typeRobe', '$vue->idTypeVin')";
		$this->connexion->executer($requete);
		$vue->idRobe = $this->connexion->dernierID();
		return $vue;
	}

	public function supprimer($vue)
	{
		$requete="DELETE FROM $this->nomTable WHERE idRobe='$vue->idRobe'";
		$this->connexion->executer($requete);
	}

	public function modifier($vue)
	{
		$requete="UPDATE $this->nomTable SET nomRobe='$vue->nomRobe' , typeDescRobe='$vue->typeDescRobe' , typeRobe='$vue->typeRobe' , idTypeVin='$vue->idTypeVin'  WHERE idRobe='$vue->idRobe'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVues($resultat);	
	}

	public function trouverParIdRobe($idRobe)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idRobe)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idRobe IN ($idRobe[0]";
		for($i=1; $i<count($idRobe); $i++)
		{
			$requete.=", $idRobe[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVues($resultat);
	}

	public function trouverParNom($nomRobe)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomRobe='$nomRobe'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVues($resultat);
	}

	public function trouverParTypeDescRobe($typeDescRobe)
	{
		$requete="SELECT * FROM $this->nomTable WHERE typeDescRobe='$typeDescRobe'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVues($resultat);
	}

	public function trouverParTypeRobe($typeRobe)
	{
		$requete="SELECT * FROM $this->nomTable WHERE typeRobe='$typeRobe'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVues($resultat);
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
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerVues($resultat);
	}

	public function creerVues($resultatRequete)
	{
		$vues=array();
		foreach($resultatRequete as $ligne)
			$vues[]=new Vue($ligne['idRobe'], $ligne['nomRobe'], $ligne['typeDescRobe'], $ligne['typeRobe'], $ligne['idTypeVin']);
		return $vues;
	}
	
}

?>