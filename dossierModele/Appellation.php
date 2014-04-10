<?php 
class Appellation
{
	public $idAppellation=NULL;
	public $nomAppellation=NULL;
		
	public function __construct($idAppellation, $nomAppellation)
	{
		$this->idAppellation=$idAppellation;
		$this->nomAppellation=$nomAppellation;
	}

	public function description()
	{
		return '<br/>Réf: '.$this->idAppellation.'<br/>Nom: '.$this->nomAppellation;
	}
}
?>