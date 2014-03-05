<?php 

class AAspect
{
	public $idVin=NULL;
	public $idRobe=NULL;
	public $scoreVue=NULL;
		
	public function __construct($idVin, $idRobe, $scoreVue)
	{
		$this->idVin=$idVin;
		$this->idRobe=$idRobe;
		$this->scoreVue=$scoreVue;
	}

	public function description()
	{
		return '<br/>Réf Vin: '.$this->idVin.'<br/>Réf robe: '.$this->idRobe.'</br>Score: '.$this->scoreVue;
	}
}

?>