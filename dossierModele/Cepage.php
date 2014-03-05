<?php 

class Cepage
{
	public $idCepage=NULL;
	public $nomCepage=NULL;
	public $caracteristiqueCepage=NULL;
		
	public function __construct($idCepage, $nomCepage, $caracteristiqueCepage)
	{
		$this->idCepage=$idCepage;
		$this->nomCepage=$nomCepage;
		$this->caracteristiqueCepage=$caracteristiqueCepage;
	}

	public function description()
	{
		return '<br/>Réf: '.$this->idCepage.'<br/>Nom: '.$this->nomCepage.'<br/>Caractéristique: '.$this->caracteristiqueCepage;
	}
}

?>