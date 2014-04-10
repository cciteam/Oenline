<?php 
class Goute
{
	public $idPartie=NULL;
	public $idBouche=NULL;
		
	public function __construct($idPartie, $idBouche)
	{
		$this->idPartie=$idPartie;
		$this->idBouche=$idBouche;
	}

	public function description()
	{
		return '<br/>Réf Vin: '.$this->idPartie.'<br/>Réf bouche: '.$this->idBouche;
	}
}
?>