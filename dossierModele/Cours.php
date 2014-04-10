<?php 
class Cours
{
	public $idCours=NULL;
	public $titreCours=NULL;
	public $motCleCours=NULL;
	public $urlCours=NULL;
	
	public function __construct($idCours, $titreCours, $motCleCours, $urlCours)
	{
		$this->idCours=$idCours;
		$this->titreCours=$titreCours;
		$this->motCleCours=$motCleCours;
		$this->urlCours=$urlCours;
	}

	public function description()
	{
		return '<br>Réf:'.$this->idCours.'<br/>Titre : '.$this->titreCours.'<br>Mot cle: '.$this->motCleCours.'<br>Lien: '.$this->urlCours;
	}
}
?>