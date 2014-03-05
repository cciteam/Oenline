<?php 

class Sent
{
	public $idPartie=NULL;
	public $idNez=NULL;
		
	public function __construct($idPartie, $idNez)
	{
		$this->idPartie=$idPartie;
		$this->idNez=$idNez;
	}

	public function description()
	{
		return '<br/>Réf Vin: '.$this->idPartie.'<br/>Réf nez: '.$this->idNez;
	}
}

?>