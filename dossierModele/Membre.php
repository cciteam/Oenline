<?php 

class Membre
{
	public $idMembre=NULL;
	public $pseudoMembre=NULL;
	public $nomMembre=NULL;
	public $motDePasse=NULL;
	public $mailMembre=NULL;
	public $idGroupe=NULL;
	
	public function __construct($idMembre, $pseudoMembre, $nomMembre, $motDePasse, $mailMembre, $idGroupe)
	{
		$this->idMembre=$idMembre;
		$this->pseudoMembre=$pseudoMembre;
		$this->nomMembre=$nomMembre;
		$this->motDePasse=$motDePasse;
		$this->mailMembre=$mailMembre;
		$this->idGroupe=$idGroupe;
	}

	public function description()
	{
		return '<br>Réf:'.$this->idMembre.'<br/>pseudo: '.$this->pseudoMembre.'<br/>Nom: '.$this->nomMembre.'<br/>Mail: '.$this->mailMembre;
	}
}

?>