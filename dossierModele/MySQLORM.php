<?php
require_once("DAOs.php");
require_once("ORM.php");
require_once("ConnexionBDD.php");
class MySQLORM implements ORM
{
	private $connexion=NULL;
	private $vinDAO=NULL;
	private $constitueDAO=NULL;
	private $domaineDAO=NULL;
	private $cepageDAO=NULL;
	private $boucheDAO=NULL;
	private $aGoutDAO=NULL;
	private $robeDAO=NULL;
	private $aAspectDAO=NULL;
	private $nezDAO=NULL;
	private $aOdeurDAO=NULL;
	private $gouteDAO=NULL;
	private $sentDAO=NULL;
	private $voitDAO=NULL;
	private $membreDAO=NULL;
	private $partieDAO=NULL;
	private $boucheTypeVinDAO=NULL;
	private $nezTypeVinDAO=NULL;
	private $robeTypeVinDAO=NULL;

	public function __construct($connexion, $vinDAO, $constitueDAO, $domaineDAO, $cepageDAO, $boucheDAO, $aGoutDAO, $robeDAO, $aAspectDAO, $nezDAO, $aOdeurDAO, $gouteDAO, $sentDAO, $voitDAO, $membreDAO, $partieDAO, $boucheTypeVinDAO, $nezTypeVinDAO, $robeTypeVinDAO, $appellationDAO)
	{
		$this->connexion=$connexion;
		$this->vinDAO=$vinDAO;
		$this->constitueDAO=$constitueDAO;
		$this->domaineDAO=$domaineDAO;
		$this->cepageDAO=$cepageDAO;
		$this->boucheDAO=$boucheDAO;
		$this->aGoutDAO=$aGoutDAO;
		$this->robeDAO=$robeDAO;
		$this->aAspectDAO=$aAspectDAO;
		$this->nezDAO=$nezDAO;
		$this->aOdeurDAO=$aOdeurDAO;
		$this->gouteDAO=$gouteDAO;
		$this->sentDAO=$sentDAO;
		$this->voitDAO=$voitDAO;
		$this->membreDAO=$membreDAO;
		$this->partieDAO=$partieDAO;
		$this->boucheTypeVinDAO=$boucheTypeVinDAO;
		$this->nezTypeVinDAO=$nezTypeVinDAO;
		$this->robeTypeVinDAO=$robeTypeVinDAO;
		$this->appellationDAO=$appellationDAO;
	}

	public function ajouterVin($vin, $domaine, $appellation, $typeVin, $cepages, $robes, $nezz, $bouches)
	{
		try
		{
			$vin->idDomaine=$domaine->idDomaine;
			$vin->idAppellation=$appellation->idAppellation;
			$vin->idTypeVin=$typeVin->idTypeVin;

			$this->connexion->commencerTransaction();
			$vin=$this->vinDAO->ajouter($vin);

			foreach($cepages as $cepage)
			{
				$constitue=new Constitue($vin->idVin, $cepage->idCepage);
				$this->constitueDAO->ajouter($constitue);
			}

			foreach($robes as $robe)
			{
				$aAspect=new AAspect($vin->idVin, $robe->idRobe, '2');
				$this->aAspectDAO->ajouter($aAspect);
			}

			foreach($nezz as $nez)
			{
				$aOdeur=new AOdeur($vin->idVin, $nez->idNez, '2');
				$this->aOdeurDAO->ajouter($aOdeur);
			}

			foreach($bouches as $bouche)
			{
				$aGout=new AGout($vin->idVin, $bouche->idBouche, '2');
				$this->aGoutDAO->ajouter($aGout);
			}

			$this->connexion->validerTransaction();
		}
		catch(Exception $e)
		{
			$this->connexion->annulerTransaction();
			throw new Exception($e);
		}
		return $vin;
	}

	public function ajouterPartie($partie, $vin, $membre, $robes, $nezz, $bouches)
	{
		try
		{
			$partie->idVin=$vin->idVin;
			$partie->idMembre=$membre->idMembre;

			$this->connexion->commencerTransaction();
			$partie=$this->partieDAO->ajouter($partie);

			foreach($robes as $robe)
			{
				$voit=new Voit($partie->idPartie, $robe->idRobe);
				$this->voitDAO->ajouter($voit);
			}

			foreach($nezz as $nez)
			{
				$sent=new Sent($partie->idPartie, $nez->idNez);
				$this->sentDAO->ajouter($sent);
			}

			foreach($bouches as $bouche)
			{
				$goute=new Goute($partie->idPartie, $bouche->idBouche);
				$this->gouteDAO->ajouter($goute);
			}

			$partie->scorePartie = $this->calculerScore($partie->idPartie);
			$this->partieDAO->modifier($partie);
			$this->connexion->validerTransaction();
		}
		catch(Exception $e)
		{
			$this->connexion->annulerTransaction();
			throw new Exception($e);
		}
	
		return $partie;
	}

	public function ajouterMembre($membre, $groupe)
	{
		try
		{
			$membre->idGroupe=$groupe->idGroupe;

			$this->connexion->commencerTransaction();
			$membre=$this->membreDAO->ajouter($membre);

			$this->connexion->validerTransaction();
		}
		catch(Exception $e)
		{
			$this->connexion->annulerTransaction();
			throw new Exception($e);
		}
		return $membre;
	}

	//ajoute un domaine
	public function ajouterDomaine($domaine)
	{
		try{
			$this->connexion->commencerTransaction();
			$domaine = $this->domaineDAO->ajouter($domaine);
			$this->connexion->validerTransaction();
		}
		catch(Exception $e){
			$this->connexion->annulerTransaction();
			throw new Exception($e);
		}
		return $domaine;
	}

	public function ajouterCepage($cepage)
	{
		try{
			$this->connexion->commencerTransaction();
			$cepage = $this->cepageDAO->ajouter($cepage);
			$this->connexion->validerTransaction();
		}
		catch(Exception $e){
			$this->connexion->annulerTransaction();
			throw new Exception($e);
		}
		return $cepage;
	}

	public function ajouterAppellation($appellation)
	{
		try{
			$this->connexion->commencerTransaction();
			$domaine = $this->appellationDAO->ajouter($appellation);
			$this->connexion->validerTransaction();
		}
		catch(Exception $e){
			$this->connexion->annulerTransaction();
			throw new Exception($e);
		}
		return $appellation;
	}

	public function supprimerVin($vin)
	{
		try
		{
			$this->connexion->commencerTransaction();

			$vinIds=array();
			array_push($vinIds, $vin->idVin);

			$constituent=$this->constitueDAO->trouverParIdVin($vinIds);
			foreach($constituent as $constitue)
			{
				$this->constitueDAO->supprimer($constitue);
			}

			$aAspects=$this->aAspectDAO->trouverParIdVin($vinIds);
			foreach($aAspects as $aAspect)
			{
				$this->aAspectDAO->supprimer($aAspect);
			}

			$aOdeurs=$this->aOdeurDAO->trouverParIdVin($vinIds);
			foreach($aOdeurs as $aOdeur)
			{
				$this->aOdeurDAO->supprimer($aOdeur);
			}

			$aGouts=$this->aGoutDAO->trouverParIdVin($vinIds);
			foreach($aGouts as $aGout)
			{
				$this->aGoutDAO->supprimer($aGout);
			}

			$this->vinDAO->supprimer($vin);

			$this->connexion->validerTransaction();
		}
		catch(Exception $e)
		{
			$this->connexion->annulerTransaction();
			throw new Exception($e);
		}
	}

	public function supprimerPartie($partie)
	{
		try
		{
			$this->connexion->commencerTransaction();

			$partieIds=array();
			array_push($partieIds, $partie->idPartie);

			$voient=$this->voitDAO->trouverParIdPartie($partieIds);
			foreach($voient as $voit)
			{
				$this->voitDAO->supprimer($voit);
			}

			$sentent=$this->sentDAO->trouverParIdPartie($partieIds);
			foreach($sentent as $sent)
			{
				$this->sentDAO->supprimer($sent);
			}

			$goutent=$this->gouteDAO->trouverParIdPartie($partieIds);
			foreach($goutent as $goute)
			{
				$this->gouteDAO->supprimer($goute);
			}

			$this->partieDAO->supprimer($partie);

			$this->connexion->validerTransaction();
		}
		catch(Exception $e)
		{
			$this->connexion->annulerTransaction();
			throw new Exception($e);
		}
	}


	public function trouverVinsParNomDeDomaine($nomDomaine)
	{
		$domaines=$this->domaineDAO->rechercherParNom($nomDomaine);
		$domaineIds=array();
		foreach($domaines as $domaine)
		{
			array_push($domaineIds, $domaine->idDomaine);
		}

		if(count($domaineIds)==0)
			return array();
		else 
			return $this->vinDAO->trouverParIdDomaine($domaineIds);
	}

	public function trouverVinsParCepage($cepage)
	{
		$constituent=$this->constitueDAO->trouverParIdCepage(array($cepage->idCepage));
		$vinIds=array();
		foreach($constituent as $constitue)
			array_push($vinIds, $constitue->idVin);
		if(count($vinIds)==0)
			return array();
		else 
			return $this->vinDAO->trouverParIdVin($vinIds);		
	}

	public function trouverCepagesParVin($vin)
	{
		$constituent=$this->constitueDAO->trouverParIdVin(array($vin->idVin));
		$cepageIds=array();
		foreach($constituent as $constitue)
			array_push($cepageIds, $constitue->idCepage);
		if(count($cepageIds)==0)
			return array();
		else 
			return $this->cepageDAO->trouverParId($cepageIds);		
	}

	public function trouverBouchesParTypeVin($typeVin)
	{
		$bouchesTypesVins=$this->boucheTypeVinDAO->trouverParIdTypeVin(array($typeVin->idTypeVin));
		$boucheIds=array();
		foreach($bouchesTypesVins as $boucheTypeVin)
			array_push($boucheIds, $boucheTypeVin->idBouche);
		if(count($boucheIds)==0)
			return array();
		else
		{ 
			return $this->boucheDAO->trouverParIdBouche($boucheIds);
		}		
	}

	public function trouverBouchesParVin($vin)
	{
		$aGouts=$this->aGoutDAO->trouverParIdVin(array($vin->idVin));
		$boucheIds=array();
		foreach($aGouts as $aGout)
			array_push($boucheIds, $aGout->idBouche);
		if(count($boucheIds)==0)
			return array();
		else
		{ 
			return $this->boucheDAO->trouverParIdBouche($boucheIds);
		}		
	}

	public function trouverNezParTypeVin($typeVin)
	{
		$nezzTypesVins=$this->nezTypeVinDAO->trouverParIdTypeVin(array($typeVin->idTypeVin));
		$nezIds=array();
		foreach($nezzTypesVins as $nezTypeVin)
			array_push($nezIds, $nezTypeVin->idNez);
		if(count($nezIds)==0)
			return array();
		else
		{ 
			return $this->nezDAO->trouverParIdNez($nezIds);
		}		
	}

	public function trouverNezParVin($vin)
	{
		$aOdeurs=$this->aOdeurDAO->trouverParIdVin(array($vin->idVin));
		$nezIds=array();
		foreach($aOdeurs as $aOdeur)
			array_push($nezIds, $aOdeur->idNez);
		if(count($nezIds)==0)
			return array();
		else
		{ 
			return $this->nezDAO->trouverParIdNez($nezIds);
		}		
	}

	public function trouverRobesParTypeVin($typeVin)
	{
		$robesTypesVins=$this->robeTypeVinDAO->trouverParIdTypeVin(array($typeVin->idTypeVin));
		$robeIds=array();
		foreach($robesTypesVins as $robeTypeVin)
			array_push($robeIds, $robeTypeVin->idRobe);
		if(count($robeIds)==0)
			return array();
		else
		{ 
			return $this->robeDAO->trouverParIdRobe($robeIds);
		}		
	}

	public function trouverRobesParVin($vin)
	{
		$aAspects=$this->aAspectDAO->trouverParIdVin(array($vin->idVin));
		$robeIds=array();
		foreach($aAspects as $aAspect)
			array_push($robeIds, $aAspect->idRobe);
		if(count($robeIds)==0)
			return array();
		else
		{ 
			return $this->robeDAO->trouverParIdRobe($robeIds);
		}		
	}

	public function ajouterCepagesVin($vin, $cepages)
	{
		try
		{
			$this->connexion->commencerTransaction();

			foreach($cepages as $cepage)
			{
				$constitue=new Constitue($vin->idVin, $cepage->idCepage);
				$this->constitueDAO->ajouter($constitue);
			}

			$this->connexion->validerTransaction();
		}
		catch(Exception $e)
		{
			$this->connexion->annulerTransaction();
			throw new Exception($e);
		}
	}
	
	public function trouverGoutsPartie($partie)
	{
		$ontGouts=$this->gouteDAO->trouverParIdPartie(array($partie->idPartie));
		$boucheIds=array();
		foreach($ontGouts as $aGout)
			array_push($boucheIds, $aGout->idBouche);
		if(count($boucheIds)==0)
			return array();
		else 
			return $this->boucheDAO->trouverParIdBouche(array($boucheIds));
	}

	public function trouverNezPartie($partie)
	{
		$ontNez=$this->sentDAO->trouverParIdPartie(array($partie->idPartie));
		$nezIds=array();
		foreach($ontNez as $aNez)
			array_push($nezIds, $aNez->idNez);
		if(count($nezIds)==0)
			return array();
		else 
			return $this->nezDAO->trouverParIdNez($nezIds);
	}

	public function trouverRobesPartie($partie)
	{
		$ontRobes=$this->voitDAO->trouverParIdPartie(array($partie->idPartie));
		$robeIds=array();
		foreach($ontRobes as $aRobe)
			array_push($robeIds, $aRobe->idRobe);
		if(count($robeIds)==0)
			return array();
		else 
			return $this->robeDAO->trouverParIdRobe($robeIds);
	}

	public function calculerScore($idPartie)
	{
		$resultat = 0;
		$RScoreRb = $this->connexion->executer("select scoreRb from scoreR where idPartie=$idPartie");
		$RScoreNz = $this->connexion->executer("select scoreNz from scoreN where idPartie=$idPartie");
		$RScoreBc = $this->connexion->executer("select scoreBc from scoreB where idPartie=$idPartie");

		$RScoreRbt = $this->connexion->executer("select scoreRbt from scoreRt where idPartie=$idPartie");
		$RScoreNzt = $this->connexion->executer("select scoreNzt from scoreNt where idPartie=$idPartie");
		$RScoreBct = $this->connexion->executer("select scoreBct from scoreBt where idPartie=$idPartie");
		
		//directement avec la requête MySQL, si un le joueur n'a rien trouvé de correct sur une des caractéristique du vin , la requête ne renvoie rien
		//pour éviter ce problème, si la requête ne renvoie rien, le score est égal à 0
		/*if(count($RScoreRb) == 0)
			$scoreRb = 0;
		else*/
		$scoreRb = $RScoreRb->fetchColumn();
		$scoreNz = $RScoreNz->fetchColumn();
		$scoreBc = $RScoreBc->fetchColumn();

		$scoreRbt = $RScoreRbt->fetchColumn();
		$scoreNzt = $RScoreNzt->fetchColumn();
		$scoreBct = $RScoreBct->fetchColumn();

		//si le vin n'a aucun nez, robe, bouche, il peut y avoir une erreur de type 20/0, pour éviter cette erreur, si le vin n'a aucune caractéristique, le joueur a un score de 20 par défaut
		if($scoreRbt==FALSE and $scoreNzt==FALSE and $scoreBct==FALSE)
		{
			$resultat = 20;
		}
		else
		{
			$resultat = 20/($scoreRbt+$scoreNzt+$scoreBct)*($scoreRb+$scoreNz+$scoreBc);
		}

		return $resultat;
	}
}
?>