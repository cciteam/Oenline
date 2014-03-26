<?php
require_once("ConnexionBDD.php");

class PDOConnexion implements ConnexionBDD
{
	private $hote=NULL;
	private $utilistateur=NULL;
	private $mdp=NULL;
	private $bdd=NULL;
	private $connexion=NULL; 
	
	public function __construct($hote, $utilisateur, $mdp, $bdd)
	{
		$this->hote=$hote;
		$this->utilisateur=$utilisateur;
		$this->mdp=$mdp;
		$this->bdd=$bdd;
	}
	
	public function connecter()
	{
		try
		{
			$this->connexion=new PDO('mysql:host='.$this->hote.';port=3306;dbname='.$this->bdd, $this->utilisateur, $this->mdp);
			$this->connexion->exec("set names utf8");
		}
		catch(Exception $e)
		{
			die("Impossible de se connecter à la base de données: ".$e->getMessage());
		}
	}
	
	public function deconnecter()
	{
		if($this->connexion)
			$this->connexion=NULL;
	}
	
	public function executer($requete)
	{
		try
		{
			$resultat = $this->connexion->query($requete);
			return $resultat;
		}
		catch(Exception $e)
		{
			throw new Exception("Erreur lors de l'exécution de la requête: ".$e->getMessage());
		}
	}

	public function commencerTransaction()
	{
		$this->connexion->beginTransaction();
	}

	public function validerTransaction()
	{
		$this->connexion->commit();
	}

	public function annulerTransaction()
	{		
		$this->connexion->rollback();
	}

	public function dernierID()
	{
		return $this->connexion->lastInsertId();		
	}
}
?>