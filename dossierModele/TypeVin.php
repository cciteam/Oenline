<?php 
class TypeVin
{
	public $idTypeVin=NULL;
	public $nomTypeVin=NULL;
		
	public function __construct($idTypeVin, $nomTypeVin)
	{
		$this->idTypeVin=$idTypeVin;
		$this->nomTypeVin=$nomTypeVin;
	}

	public function description()
	{
		return '<br/>Réf: '.$this->idTypeVin.'<br/>Nom: '.$this->nomTypeVin;
	}
}
?>