<?php 

class Groupe
{
	public $idGroupe=NULL;
	public $nomGroupe=NULL;
	
	public function __construct($idGroupe, $nomGroupe)
	{
		$this->idGroupe=$idGroupe;
		$this->nomGroupe=$nomGroupe;
	}

	public function description()
	{
		return '<br>Réf:'.$this->idGroupe.'<br/>Nom : '.$this->nomGroupe;
	}
}

?>