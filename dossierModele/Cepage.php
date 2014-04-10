<?php 
class Cepage
{
	public $idCepage=NULL;
	public $nomCepage=NULL;
		
	public function __construct($idCepage, $nomCepage)
	{
		$this->idCepage=$idCepage;
		$this->nomCepage=$nomCepage;
	}

	public function description()
	{
		return '<br/>Réf: '.$this->idCepage.'<br/>Nom: '.$this->nomCepage;
	}
}
?>