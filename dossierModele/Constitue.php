<?php 
class Constitue
{
	public $idVin=NULL;
	public $idCepage=NULL;
		
	public function __construct($idVin, $idCepage)
	{
		$this->idVin=$idVin;
		$this->idCepage=$idCepage;
	}

	public function description()
	{
		return '<br/>Réf Vin: '.$this->idVin.'<br/>Réf cépage: '.$this->idCepage;
	}
}
?>