<?php 

class AGout
{
	public $idVin=NULL;
	public $idBouche=NULL;
	public $scoreGout=NULL;
		
	public function __construct($idVin, $idBouche, $scoreGout)
	{
		$this->idVin=$idVin;
		$this->idBouche=$idBouche;
		$this->scoreGout=$scoreGout;
	}

	public function description()
	{
		return '<br/>Réf Vin: '.$this->idVin.'<br/>Réf robe: '.$this->idBouche.'</br>Score: '.$this->scoreGout;
	}
}

?>