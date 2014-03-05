<?php 

class Membre
{
	public $idMembre=NULL;
	public $aliasMembre=NULL;
	public $nomMembre=NULL;
	public $motDePasse=NULL;
	public $mailMembre=NULL;
	public $questionSecrete=NULL;
	public $reponseQuestion=NULL;
	public $idGroupe=NULL;
	
	public function __construct($idMembre, $aliasMembre, $nomMembre, $motDePasse, $mailMembre, $questionSecrete, $reponseQuestion, $idGroupe)
	{
		$this->idMembre=$idMembre;
		$this->aliasMembre=$aliasMembre;
		$this->nomMembre=$nomMembre;
		$this->motDePasse=$motDePasse;
		$this->mailMembre=$mailMembre;
		$this->questionSecrete=$questionSecrete;	
		$this->reponseQuestion=$reponseQuestion;
		$this->idGroupe=$idGroupe;
	}

	public function description()
	{
		return '<br>Réf:'.$this->idMembre.'<br/>Alias: '.$this->aliasMembre.'<br/>Nom: '.$this->nomMembre.'<br/>Mail: '.$this->mailMembre;
	}
}

?>