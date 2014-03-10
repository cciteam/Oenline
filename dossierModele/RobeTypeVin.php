<?php 

class RobeTypeVin
{
	public $idTypeVin=NULL;
	public $idRobe=NULL;
		
	public function __construct($idTypeVin, $idRobe)
	{
		$this->idTypeVin=$idTypeVin;
		$this->idRobe=$idRobe;
	}

	public function description()
	{
		return '<br/>Réf Vin: '.$this->idTypeVin.'<br/>Réf robe: '.$this->idRobe;
	}
}

?>