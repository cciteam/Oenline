<?php 

class AOdeur
{
	public $idVin=NULL;
	public $idNez=NULL;
	public $scoreNez=NULL;
		
	public function __construct($idVin, $idNez, $scoreNez)
	{
		$this->idVin=$idVin;
		$this->idNez=$idNez;
		$this->scoreVue=$scoreNez;
	}

	public function description()
	{
		return '<br/>Réf Vin: '.$this->idVin.'<br/>Réf robe: '.$this->idNez.'</br>Score: '.$this->scoreNez;
	}
}

?>