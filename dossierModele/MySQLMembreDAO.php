<?php
require_once("MembreDAO.php");
require_once("Membre.php");
require_once("ConnexionBDD.php");

class MySQLMembreDAO implements MembreDAO
{
	private $connexion=NULL;
	private $nomTable="Membre";

	public function __construct($connexion)
	{
		$this->connexion=$connexion;
	}

	public function ajouter($membre)
	{
		$requete="INSERT INTO $this->nomTable (aliasMembre, nomMembre, motDePasse, mailMembre, questionSecrete, reponseQuestion, idGroupe) VALUES ('$membre->aliasMembre', '$membre->nomMembre', '$membre->motDePasse','$membre->mailMembre', '$membre->questionSecrete', '$membre->reponseQuestion', '$membre->idGroupe')";
		$this->connexion->executer($requete);
		$membre->idMembre = $this->connexion->dernierID();
		return $membre;
	}

	public function supprimer($membre)
	{
		$requete="DELETE FROM $this->nomTable WHERE idMembre='$membre->idMembre'";
		$this->connexion->executer($requete);
	}

	public function modifier($membre)
	{
		$requete="UPDATE $this->nomTable SET aliasMembre='$membre->aliasMembre' , nomMembre='$membre->nomMembre' , motDePasse='$membre->motDePasse', mailMembre='$membre->mailMembre' , questionSecrete='$membre->questionSecrete' , reponseQuestion='$membre->reponseQuestion'  WHERE idMembre='$membre->idMembre'";
		$this->connexion->executer($requete);
	}

	public function trouverTout()
	{
		$requete="SELECT * FROM $this->nomTable";
		$resultat=$this->connexion->executer($requete);
		return $this->creerMembres($resultat);	
	}

	public function trouverParIdMembre($idMembre)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idMembre)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idMembre IN ($idMembre[0]";
		for($i=1; $i<count($idMembre); $i++)
		{
			$requete.=", $idMembre[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerMembres($resultat);
	}

	public function trouverParAlias($aliasMembre)
	{
		$requete="SELECT * FROM $this->nomTable WHERE aliasMembre='$aliasMembre'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerMembres($resultat);
	}

	public function trouverParNom($nomMembre)
	{
		$requete="SELECT * FROM $this->nomTable WHERE nomMembre='$nomMembre'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerMembres($resultat);
	}

	public function trouverParMail($mailMembre)
	{
		$requete="SELECT * FROM $this->nomTable WHERE mailMembre='$mailMembre'";
		$resultat=$this->connexion->executer($requete);
		return $this->creerMembres($resultat);
	}

	public function trouverParIdGroupe($idGroupe)
	{
		//vérifie qu'il y a au moins un id en paramètre, sinon le programme s'interrompt
		assert(count($idGroupe)>=1);
		$requete="SELECT * FROM $this->nomTable WHERE idGroupe IN ($idGroupe[0]";
		for($i=1; $i<count($idGroupe); $i++)
		{
			$requete.=", $idGroupe[$i]";
		}
		$requete.=")";
		$resultat=$this->connexion->executer($requete);
		return $this->creerMembres($resultat);
	}

	public function creerMembres($resultatRequete)
	{
		$membres=array();
		while($ligne=mysql_fetch_array($resultatRequete))
			$membres[]=new Membre($ligne['idMembre'], $ligne['aliasMembre'], $ligne['nomMembre'], $ligne['motDePasse'], $ligne['mailMembre'], $ligne['questionSecrete'], $ligne['reponseQuestion'], $ligne['idGroupe']);
		return $membres;
	}
	
}

?>