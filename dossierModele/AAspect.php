<?php 
class AAspect
{
	public $idVin=NULL;
	public $idRobe=NULL;
		
	public function __construct($idVin, $idRobe)
	{
		$this->idVin=$idVin;
		$this->idRobe=$idRobe;
	}

	public function description()
	{
		return '<br/>Réf Vin: '.$this->idVin.'<br/>Réf robe: '.$this->idRobe;
	}
}
?>