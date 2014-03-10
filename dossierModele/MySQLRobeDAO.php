<?php
require_once("RobeDAO.php");
require_once("Robe.php");
require_once("ConnexionBDD.php");

class MySQLRobeDAO implements RobeDAO
{
	private $connexion=NULL;
	private $nomTable="Robe";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($robe)
	{
		$requete="INSERT INTO $this->nomTable (nomRobe, typeDescRobe, typeRobe, scoreRobe) VALUES ('$robe->nomRobe', '$robe->typeDescRobe', '$robe->typeRobe', '$robe->scoreRobe')";
		$this->connexion->executer($requete);
		$robe->idRobe = $this->connexion->dernierID();
		return $robe;
	}

	public function supprimer($robe)
	{
		$requete="DELETE FROM $this->nomTable WHERE idRobe='$robe->idRobe'";
		$this->connexion->executer($requete);
	}

	public function modifier($robe)
	{
		$requete="UPDATE $this->nomTable SET nomRobe='$robe->nomRobe' , typeDescRobe='$robe->typeDescRobe' , typeRobe='$robe->typeRobe' , scoreRobe='$robe->scoreRobe'  WHERE idRobe='$robe->idRobe'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerRobes($resultat);	
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
		return $this->creerRobes($resultat);
	}

	public function trouverParNom($nomRobe)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomRobe='$nomRobe'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerRobes($resultat);
	}

	public function trouverParTypeDescRobe($typeDescRobe)
	{
		$requete="SELECT * FROM $this->nomTable WHERE typeDescRobe='$typeDescRobe'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerRobes($resultat);
	}

	public function trouverParTypeRobe($typeRobe)
	{
		$requete="SELECT * FROM $this->nomTable WHERE typeRobe='$typeRobe'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerRobes($resultat);
	}


	public function creerRobes($resultatRequete)
	{
		$robes=array();
		while($ligne=mysql_fetch_array($resultatRequete))
			$robes[]=new Robe($ligne['idRobe'], $ligne['nomRobe'], $ligne['typeDescRobe'], $ligne['typeRobe'], $ligne['scoreRobe']);
		return $robes;
	}
	
}

?>