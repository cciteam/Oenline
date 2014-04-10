<?php 
class Nez
{
	public $idNez=NULL;
	public $nomNez=NULL;
	public $typeNez=NULL;
	public $scoreNez=NULL;
	
	public function __construct($idNez, $nomNez, $typeNez, $scoreNez)
	{
		$this->idNez=$idNez;
		$this->nomNez=$nomNez;
		$this->typeNez=$typeNez;	
		$this->scoreNez=$scoreNez;
	}

	public function description()
	{
		return '<br>Réf:'.$this->idNez.'<br/>Nom: '.$this->nomNez.'<br/>type nez: '.$this->typeNez.'<br/>score nez: '.$this->scoreNez;
	}
}
?>