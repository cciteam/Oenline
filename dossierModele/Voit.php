<?php 
class Voit
{
	public $idPartie=NULL;
	public $idRobe=NULL;
		
	public function __construct($idPartie, $idRobe)
	{
		$this->idPartie=$idPartie;
		$this->idRobe=$idRobe;
	}

	public function description()
	{
		return '<br/>Réf partie: '.$this->idPartie.'<br/>Réf robe: '.$this->idRobe;
	}
}
?>