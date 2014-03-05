<?php 

class Vue
{
	public $idRobe=NULL;
	public $nomRobe=NULL;
	public $typeDescRobe=NULL;
	public $typeRobe=NULL;
	public $idTypeVin=NULL;
	
	public function __construct($idRobe, $nomRobe, $typeDescRobe, $typeRobe, $idTypeVin)
	{
		$this->idRobe=$idRobe;
		$this->nomRobe=$nomRobe;
		$this->typeDescRobe=$typeDescRobe;
		$this->typeRobe=$typeRobe;	
		$this->idTypeVin=$idTypeVin;
	}

	public function description()
	{
		return '<br>Réf:'.$this->idRobe.'<br/>Nom: '.$this->nomRobe.'<br/>Type desc robe: '.$this->typeDescRobe.'<br/>type robe: '.$this->typeRobe;
	}
}

?>