<?php
require_once("MySQLDAOs.php");
require_once("PDOConnexion.php");
require_once("MySQLORM.php");
require_once("ORM.php");
require_once("ConnexionBDD.php");
class ModeleOenline
{
	private $bdd=NULL;

	private $aAspectDAO=NULL;
	private $aGoutDAO=NULL;
	private $aOdeurDAO=NULL;
	private $appellationDAO=NULL;
	private $boucheDAO=NULL;
	private $boucheTypeVinDAO=NULL;
	private $cepageDAO=NULL;
	private $constitueDAO=NULL;
	private $coursDAO=NULL;
	private $domaineDAO=NULL;
	private $gouteDAO=NULL;
	private $groupeDAO=NULL;
	private $membreDAO=NULL;
	private $nezDAO=NULL;
	private $nezTypeVinDAO=NULL;
	private $partieDAO=NULL;
	private $robeDAO=NULL;
	private $robeTypeVinDAO=NULL;
	private $sentDAO=NULL;
	private $typeVinDAO=NULL;
	private $vinDAO=NULL;
	private $voitDAO=NULL;

	private $orm=NULL;

	public function __construct($hote, $id, $mdp, $bdd)
	{
		$this->bdd=new PDOConnexion($hote, $id, $mdp, $bdd);
		$this->bdd->connecter();

		$this->aAspectDAO=new MySQLAAspectDAO($this->bdd);
		$this->aGoutDAO=new MySQLAGoutDAO($this->bdd);
		$this->aOdeurDAO=new MySQLAOdeurDAO($this->bdd);
		$this->appellationDAO=new MySQLAppellationDAO($this->bdd);
		$this->boucheDAO=new MySQLBoucheDAO($this->bdd);
		$this->boucheTypeVinDAO=new MySQLboucheTypeVinDAO($this->bdd);
		$this->cepageDAO=new MySQLCepageDAO($this->bdd);
		$this->constitueDAO=new MySQLConstitueDAO($this->bdd);
		$this->coursDAO=new MySQLCoursDAO($this->bdd);
		$this->domaineDAO=new MySQLDomaineDAO($this->bdd);
		$this->gouteDAO=new MySQLGouteDAO($this->bdd);
		$this->groupeDAO=new MySQLGroupeDAO($this->bdd);
		$this->membreDAO=new MySQLMembreDAO($this->bdd);
		$this->nezDAO=new MySQLNezDAO($this->bdd);
		$this->nezTypeVinDAO=new MySQLnezTypeVinDAO($this->bdd);
		$this->partieDAO=new MySQLPartieDAO($this->bdd);
		$this->robeDAO=new MySQLrobeDAO($this->bdd);
		$this->robeTypeVinDAO=new MySQLrobeTypeVinDAO($this->bdd);
		$this->sentDAO=new MySQLSentDAO($this->bdd);
		$this->typeVinDAO=new MySQLTypeVinDAO($this->bdd);
		$this->vinDAO=new MySQLVinDAO($this->bdd);
		$this->voitDAO=new MySQLVoitDAO($this->bdd);
		

		$this->orm=new MySQLORM($this->bdd, $this->vinDAO, $this->constitueDAO, $this->domaineDAO, $this->cepageDAO, $this->boucheDAO, $this->aGoutDAO, $this->robeDAO, $this->aAspectDAO, $this->nezDAO, $this->aOdeurDAO, $this->gouteDAO, $this->sentDAO, $this->voitDAO, $this->membreDAO, $this->partieDAO, $this->boucheTypeVinDAO, $this->nezTypeVinDAO, $this->robeTypeVinDAO, $this->appellationDAO);
	}

	public function __destruct()
	{
		$this->bdd->deconnecter();
	}

	//ajouter un vin, avec son domaine, son appellation... ses cépages, ses robes, ses nez, ses bouches
	public function ajouterVin($vin, $domaine, $appellation, $typeVin, $cepages, $robes, $nezz, $bouches)
	{
		return $this->orm->ajouterVin($vin, $domaine, $appellation, $typeVin, $cepages, $robes, $nezz, $bouches);
	}

	//ajoute une partie avec ses voit, sent, goute
	public function ajouterPartie($partie, $vin, $membre, $robes, $nezz, $bouches)
	{
		return $this->orm->ajouterPartie($partie, $vin, $membre, $robes, $nezz, $bouches);
	}

	//ajoute un membre 
	public function ajouterMembre($membre, $groupe)
	{
		return $this->orm->ajouterMembre($membre, $groupe);
	}

	//ajoute un domaine
	public function ajouterDomaine($domaine)
	{
		$this->orm->ajouterDomaine($domaine);
	}

	//ajoute un cépage
	public function ajouterCepage($cepage)
	{
		$this->orm->ajouterCepage($cepage);
	}

	//ajoute une appellation
	public function ajouterAppellation($appellation)
	{
		$this->orm->ajouterAppellation($appellation);
	}

	//ajouter des cepages à un vin
	public function ajouterCepagesVin($vin, $cepages)
	{
		$this->orm->ajouterCepagesVin($vin, $cepages);
	}

	//supprime un vin, ainsi que les nostitue, aAspect, aOdeur, aGout qui le concernent
	public function supprimerVin($vin)
	{
		$this->orm->supprimerVin($vin);
	}

	//supprime une partie avec toutes ses dépendances (voit, sent, goute)
	public function supprimerPartie($partie)
	{
		$this->orm->supprimerPartie($partie);
	}

	//retourne un tableau de tous les cepages
	public function trouverCepages()
	{
		return $this->cepageDAO->trouverTout();
	}

	//retourne tous les vins
	public function trouverVins()
	{
		return $this->vinDAO->trouverTout();
	}

	//retourne tous les types de vins
	public function trouverTypesVins()
	{
		return $this->typeVinDAO->trouverTout();
	}

	//retourne toutes les appellations
	public function trouverAppellations()
	{
		return $this->appellationDAO->trouverTout();
	}

	//retourne tous les domaines
	public function trouverDomaines()
	{
		return $this->domaineDAO->trouverTout();
	}

	//retourne toutes les robes
	public function trouverRobes()
	{
		return $this->robeDAO->trouverTout();
	}

	//retourne tous les nez
	public function trouverNez()
	{
		return $this->nezDAO->trouverTout();
	}

	//retourne toutes les bouches
	public function trouverBouches()
	{
		return $this->boucheDAO->trouverTout();
	}

	//retourne tous les membres
	public function trouverMembres()
	{
		return $this->membreDAO->trouverTout();
	}

	//retourne un tableau de toutes les parties
	public function trouverParties()
	{
		return $this->partieDAO->trouverTout();
	}
	
	//retourne un tableau de toutes les parties pour un membre donné
	public function trouverPartiesParIdMembre($idMembre)
	{
		return $this->partieDAO->trouverParIdMembre($idMembre);
	}

	//retourne un tableau de tous les cours
	public function trouverCours()
	{
		return $this->coursDAO->trouverTout();
	}

	//retourne un tableau de tous les cours
	public function trouverGroupes()
	{
		return $this->groupeDAO->trouverTout();
	}


	//retourne les vins contenant $nomDomaine dans le nom de domaine
	public function trouverVinsParNomDeDomaine($nomDomaine)
	{
		return $this->orm->trouverVinsParNomDeDomaine($nomDomaine);
	}

	//retourne les vins contenant le cepage $cepage
	public function trouverVinsParCepage($cepage)
	{
		return $this->orm->trouverVinsParCepage($cepage);
	}

	//retourne les vins contenant l'appellation $appellation
	public function trouverVinsParAppellation($appellation)
	{
		return $this->vinDAO->trouverParIdAppellation(array($appellation->idAppellation));
	}

	//retourne les vins contenant le type de vin $typeVin
	public function trouverVinsParTypeVin($typeVin)
	{
		return $this->vinDAO->trouverParIdTypeVin(array($typeVin->idTypeVin));
	}

	//retourne les vins contenant $nomVin dans le nom
	public function trouverVinsParNom($nomVin)
	{
		return $this->vinDAO->rechercherParNom($nomVin);
	}
	//retourne les vins contenant $IDVin dans le nom
	public function trouverVinParIdVin($IDVin)
	{
		return $this->vinDAO->trouverParIdVin(array($IDVin));
	}

	public function trouverCepagesParVin($vin)
	{
		return $this->orm->trouverCepagesParVin($vin);
	}

	public function trouverDomainesParVin($vin)
	{
		return $this->domaineDAO->trouverParId($vin->idDomaine);
	}

	public function trouverAppellationsParVin($vin)
	{
		return $this->appellationDAO->trouverParId($vin->idAppellation);
	}

	public function trouverTypesVinsParVin($vin)
	{
		return $this->typeVinDAO->trouverParId(array($vin->idTypeVin));
	}

	public function trouverBouchesParTypeVin($typeVin)
	{
		return $this->orm->trouverBouchesParTypeVin($typeVin);
	}

	public function trouverNezParTypeVin($typeVin)
	{
		return $this->orm->trouverNezParTypeVin($typeVin);
	}

	public function trouverRobesParTypeVin($typeVin)
	{
		return $this->orm->trouverRobesParTypeVin($typeVin);
	}


	public function trouverGoutsPartie($partie)
	{
		return $this->orm->trouverGoutsPartie($partie);
	}

	public function trouverNezPartie($partie)
	{
		return $this->orm->trouverNezPartie($partie);
	}

	public function trouverRobesPartie($partie)
	{
		return $this->orm->trouverRobesPartie($partie);
	}

	public function trouverBouchesParVin($vin)
	{
		return $this->orm->trouverBouchesParVin($vin);
	}

	public function trouverNezParVin($vin)
	{
		return $this->orm->trouverNezParVin($vin);
	}

	public function trouverRobesParVin($vin)
	{
		return $this->orm->trouverRobesParVin($vin);
	}

	public function trouverMembreParMail($mail)
	{
		return $this->membreDAO->trouverParMail($mail);
	}

	public function trouverMembreParPseudo($pseudo)
	{
		return $this->membreDAO->trouverParPseudo($pseudo);
	}

	//retourne les parties du membre entré en paramètre
	public function trouverPartiesParMembre($membre)
	{
		return $this->partieDAO->trouverParIdMembre(array($membre->idMembre));
	}

	//retourne les parties du membre entré en paramètre
	public function trouverCoursParTitreCours($titreCours)
	{
		return $this->coursDAO->trouverParTitre($titreCours);
	}

	//teste si un cépage de même nom existe déjà dans la base
	public function existeCepage($cepage)
	{
		$test = count($this->cepageDAO->trouverParNom($cepage->nomCepage));
		if($test<1)
			return FALSE;
		else
			return TRUE;
	}

	//teste si un domaine de même nom existe déjà dans la base
	public function existeDomaine($domaine)
	{
		$test = count($this->domaineDAO->trouverParNom($domaine->nomDomaine));
		if($test<1)
			return FALSE;
		else
			return TRUE;
	}

	//teste si un cépage de même nom existe déjà dans la base
	public function existeAppellation($appellation)
	{
		$test = count($this->appellationDAO->trouverParNom($appellation->nomAppellation));
		if($test<1)
			return FALSE;
		else
			return TRUE;
	}

	//teste si le cépage existe, retourne FALSE s'il n'existe pas
	public function existeIdCepage($cepage)
	{
		$test = count($this->cepageDAO->trouverParId(array($cepage->idCepage)));
		if($test<1)
			return FALSE;
		else
			return TRUE;
	}

	//teste si le vin existe, retourne TRUE s'il existe
	public function existeIdVin($vin)
	{
		$test = count($this->vinDAO->trouverParIdVin(array($vin->idVin)));
		if($test<1)
			return FALSE;
		else
			return TRUE;
	}

	//teste si le typeVin existe, retourne TRUE s'il existe
	public function existeIdTypeVin($typeVin)
	{
		$test = count($this->typeVinDAO->trouverParId(array($typeVin->idTypeVin)));
		if($test<1)
			return FALSE;
		else
			return TRUE;
	}

	//teste si l'appellation existe, retourne TRUE si elle existe
	public function existeIdAppellation($appellation)
	{
		$test = count($this->appellationDAO->trouverParId(array($appellation->idAppellation)));
		if($test<1)
			return FALSE;
		else
			return TRUE;
	}

	//teste si le domaine existe, retourne TRUE s'il existe
	public function existeIdDomaine($domaine)
	{
		$test = count($this->domaineDAO->trouverParId(array($domaine->idDomaine)));
		if($test<1)
			return FALSE;
		else
			return TRUE;
	}

	//teste si la robe existe, retourne un booléen
	public function existeIdRobe($robe)
	{
		$test = count($this->robeDAO->trouverParIdRobe(array($robe->idRobe)));
		if($test<1)
			return FALSE;
		else
			return TRUE;
	}

	//teste si le nez existe, retourne un booléen
	public function existeIdNez($nez)
	{
		$test = count($this->nezDAO->trouverParIdNez(array($nez->idNez)));
		if($test<1)
			return FALSE;
		else
			return TRUE;	
	}

	//retourne TRUE si la bouche existe
	public function existeIdBouche($bouche)
	{
		$test = count($this->boucheDAO->trouverParIdBouche(array($bouche->idBouche)));
		if($test<1)
			return FALSE;
		else
			return TRUE;
	}

	//retourne TRUE si le membre existe
	public function existeIdMembre($membre)
	{
		$test = count($this->membreDAO->trouverParIdMembre(array($membre->idMembre)));
		if($test<1)
			return FALSE;
		else
			return TRUE;
	}

	//retourne TRUE si le groupe existe
	public function existeIdGroupe($groupe)
	{
		$test = count($this->groupeDAO->trouverParIdGroupe(array($groupe->idGroupe)));
		if($test<1)
			return FALSE;
		else
			return TRUE;
	}
}

?>