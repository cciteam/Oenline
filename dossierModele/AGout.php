<?php 

class AGout
{
	public $idVin=NULL;
	public $idBouche=NULL;
		
	public function __construct($idVin, $idBouche)
	{
		$this->idVin=$idVin;
		$this->idBouche=$idBouche;
	}

	public function description()
	{
		return '<br/>Réf Vin: '.$this->idVin.'<br/>Réf robe: '.$this->idBouche;
	}
}

?>