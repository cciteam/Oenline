<?php 

class Vin 
{
	public $idVin=NULL;
	public $nomVin=NULL;
	public $idDomaine=NULL;
	public $idAppellation=NULL;
	public $idTypeVin=NULL;
	public $descCourte=NULL;
	public $descLongue=NULL;
	public $millesime=NULL;
	
	public function __construct($idVin, $nomVin, $millesime, $descCourte, $descLongue, $idDomaine, $idAppellation, $idTypeVin)
	{
		$this->idVin=$idVin;
		$this->nomVin=$nomVin;
		$this->millesime=$millesime;
		$this->descCourte=$descCourte;	
		$this->descLongue=$descLongue;
		$this->idDomaine=$idDomaine;
		$this->idAppellation=$idAppellation;
		$this->idTypeVin=$idTypeVin;
	}

	public function description()
	{
		return '<br>Réf:'.$this->idVin.'<br/>Nom: '.$this->nomVin.'<br/>Millésime: '.$this->millesime.'<br/>Description courte: '.$this->descCourte.'<br/>Description longue: '.$this->descLongue;
	}
	
	public function __sleep()
	{
		return array('idVin', 'nomVin', 'idDomaine', 'idAppellation', 'idTypeVin', 'descCourte', 'descLongue', 'millesime');
	}
	
	
}

?>