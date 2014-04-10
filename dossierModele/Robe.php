<?php 
class Robe
{
	public $idRobe=NULL;
	public $nomRobe=NULL;
	public $typeDescRobe=NULL;
	public $typeRobe=NULL;
	public $scoreRobe=NULL;
	public function __construct($idRobe, $nomRobe, $typeDescRobe, $typeRobe, $scoreRobe)
	{
		$this->idRobe=$idRobe;
		$this->nomRobe=$nomRobe;
		$this->typeDescRobe=$typeDescRobe;
		$this->typeRobe=$typeRobe;
		$this->scoreRobe=$scoreRobe;
	}
	public function description()
	{
		return '<br>Réf:'.$this->idRobe.'<br/>Nom: '.$this->nomRobe.'<br/>Type desc robe: '.$this->typeDescRobe.'<br/>type robe: '.$this->typeRobe.'<br/>score robe: '.$this->scoreRobe;
	}
}
?>