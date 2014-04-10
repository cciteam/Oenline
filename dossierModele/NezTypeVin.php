<?php 
class NezTypeVin
{
	public $idTypeVin=NULL;
	public $idNez=NULL;
		
	public function __construct($idTypeVin, $idNez)
	{
		$this->idTypeVin=$idTypeVin;
		$this->idNez=$idNez;
	}

	public function description()
	{
		return '<br/>Réf Vin: '.$this->idTypeVin.'<br/>Réf nez: '.$this->idNez;
	}
}
?>