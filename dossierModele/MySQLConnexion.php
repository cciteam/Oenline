<?php
require_once("ConnexionBDD.php");

class MySQLConnexion implements ConnexionBDD
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
		$this->connexion=mysql_connect($this->hote, $this->utilisateur, $this->mdp) or die("Impossible de se connecter à la base de données: ".mysql_error());
		mysql_select_db($this->bdd, $this->connexion) or die("La base de données est introuvable: ".mysql_error());
	}
	
	public function deconnecter()
	{
		if($this->connexion != 0)
			mysql_close($this->connexion);
	}
	
	public function executer($requete)
	{
		$resultat = mysql_query($requete);
		if (!$resultat)
			throw new Exception("Erreur lors de l'exécution de la requête: ".mysql_error());
		return $resultat;
	}

	public function commencerTransaction()
	{
		mysql_query("START TRANSACTION");
	}

	public function validerTransaction()
	{
		mysql_query("COMMIT");
	}

	public function annulerTransaction()
	{		
		mysql_query("ROLLBACK");
	}

	public function dernierID()
	{
		return mysql_insert_id();		
	}
}
?>