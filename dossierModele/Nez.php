<?php 

class Nez
{
	public $idNez=NULL;
	public $nomNez=NULL;
	public $typeNez=NULL;
	public $idTypeVin=NULL;
	
	public function __construct($idNez, $nomNez, $typeNez, $idTypeVin)
	{
		$this->idNez=$idNez;
		$this->nomNez=$nomNez;
		$this->typeNez=$typeNez;	
		$this->idTypeVin=$idTypeVin;
	}

	public function description()
	{
		return '<br>Réf:'.$this->idNez.'<br/>Nom: '.$this->nomNez.'<br/>type nez: '.$this->typeNez;
	}
}

?>