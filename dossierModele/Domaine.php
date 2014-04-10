<?php 
class Domaine
{
	public $idDomaine=NULL;
	public $nomDomaine=NULL;
	public $urlDomaine=NULL;
		
	public function __construct($idDomaine, $nomDomaine, $urlDomaine)
	{
		$this->idDomaine=$idDomaine;
		$this->nomDomaine=$nomDomaine;
		$this->urlDomaine=$urlDomaine;
	}

	public function description()
	{
		return '<br/>Réf: '.$this->idDomaine.'<br/>Nom: '.$this->nomDomaine.'<br/>Url: '.$this->urlDomaine;
	}
}
?>