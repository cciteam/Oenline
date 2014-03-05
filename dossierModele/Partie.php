<?php 

class Partie
{
	public $idPartie=NULL;
	public $datePartie=NULL;
	public $scorePartie=NULL;
	public $commentairePartie=NULL;
	public $idVin=NULL;
	public $idMembre=NULL;
	
	public function __construct($idPartie, $datePartie, $scorePartie, $commentairePartie, $idVin, $idMembre)
	{
		$this->idPartie=$idPartie;
		$this->datePartie=$datePartie;
		$this->scorePartie=$scorePartie;
		$this->commentairePartie=$commentairePartie;	
		$this->idVin=$idVin;
		$this->idMembre=$idMembre;
	}

	public function description()
	{
		return '<br>Réf:'.$this->idPartie.'<br/>Date: '.$this->datePartie.'<br/>Score: '.$this->scorePartie.'<br/>Commentaire: '.$this->commentairePartie;
	}
}

?>