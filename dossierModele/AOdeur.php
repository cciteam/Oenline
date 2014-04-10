<?php 
class AOdeur
{
	public $idVin=NULL;
	public $idNez=NULL;
		
	public function __construct($idVin, $idNez)
	{
		$this->idVin=$idVin;
		$this->idNez=$idNez;
	}

	public function description()
	{
		return '<br/>Réf Vin: '.$this->idVin.'<br/>Réf robe: '.$this->idNez;
	}
}
?>