<?php 

class BoucheTypeVin
{
	public $idTypeVin=NULL;
	public $idBouche=NULL;
		
	public function __construct($idTypeVin, $idBouche)
	{
		$this->idTypeVin=$idTypeVin;
		$this->idBouche=$idBouche;
	}

	public function description()
	{
		return '<br/>Réf Vin: '.$this->idTypeVin.'<br/>Réf bouche: '.$this->idBouche;
	}
}

?>