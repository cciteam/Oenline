<?php 

class Bouche
{
	public $idBouche=NULL;
	public $nomBouche=NULL;
	public $typeDescBouche=NULL;
	public $typeBouche=NULL;
	public $scoreBouche=NULL;
	
	public function __construct($idBouche, $nomBouche, $typeDescBouche, $typeBouche, $scoreBouche)
	{
		$this->idBouche=$idBouche;
		$this->nomBouche=$nomBouche;
		$this->typeDescBouche=$typeDescBouche;
		$this->typeBouche=$typeBouche;	
		$this->scoreBouche=$scoreBouche;
	}

	public function description()
	{
		return '<br>Réf:'.$this->idBouche.'<br/>Nom: '.$this->nomBouche.'<br/>Type desc bouche: '.$this->typeDescBouche.'<br/>typeBouche: '.$this->typeBouche.'<br/>score bouche: '.$this->scoreBouche;
	}
}

?>