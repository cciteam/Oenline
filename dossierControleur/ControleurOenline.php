<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/dossierModele/ModeleOenline.php');

class ControleurOenline
{
	private $modele=NULL;

	public function __construct($hote, $id, $mdp, $bdd)
	{
		$this->modele=new ModeleOenline($hote, $id, $mdp, $bdd);
	}

	//ajouter un vin, avec son domaine, son appellation... ses cépages, ses vues, ses nez, ses bouches
	public function ajouterVin($vin, $domaine, $appellation, $typeVin, $cepages, $vues, $nezz, $bouches)
	{
		return $this->modele->ajouterVin($vin, $domaine, $appellation, $typeVin, $cepages, $vues, $nezz, $bouches);
	}

	//ajoute une partie avec ses dépendances 
	//la fonction retourne un objet 'partie' avec le score qui lui correspond
	//en effet, ajouterPartie comporte une fonction qui calcule directement le score
	public function ajouterPartie($partie, $vin, $membre, $robess, $nezz, $bouches)
	{
		return $this->modele->ajouterPartie($partie, $vin, $membre, $robess, $nezz, $bouches);
	}

	//ajoute un membre 
	public function ajouterMembre($membre, $groupe)
	{
		$nbMail = count($this->modele->trouverMembreParMail($membre->mailMembre));
		$nbPseudo = count($this->modele->trouverMembreParPseudo($membre->pseudoMembre));

		$nomMembre = trim($membre->nomMembre);
		$pseudoMembre = trim($membre->pseudoMembre);
		$mdp = $membre->motDePasse;
		$mailMembre = trim($membre->mailMembre);

		if($nomMembre=="" OR $pseudoMembre=="" OR $mailMembre=="" OR $mdp=="")
		{
			throw new Exception("Il faut remplir le nomMembre, pseudoMembre, mailMembre et le motDePasse");
		}
		if($nbMail > 0)
		{
			throw new Exception("Un membre avec le mail ".$membre->mailMembre." a déjà été inscrit");
		}
		if($nbPseudo > 0)
		{
			throw new Exception("Un membre avec le pseudo ".$membre->pseudoMembre." a déjà été inscrit");
		}

		return $this->modele->ajouterMembre($membre, $groupe);
	}

	//ajoute un domaine
	public function ajouterDomaine($domaine)
	{
		$this->modele->ajouterDomaine($domaine);
	}

	//ajoute un cépage
	public function ajouterCepage($cepage)
	{
		$this->modele->ajouterCepage($cepage);
	}

	//ajouter des cepages à un vin, attention, si le cépage a déjà été associé à un vin, message d'erreur MySQL: duplicate primary key!!
	public function ajouterCepagesVin($vin, $cepages)
	{
		$this->modele->ajouterCepagesVin($vin, $cepages);
	}

	//supprime un vin, ainsi que les constitue, aAspect, aOdeur, aGout qui le concernent
	public function supprimerVin($vin)
	{
		$this->modele->supprimerVin($vin);
	}

	//supprime une partie avec toutes ses dépendances (voit, sent, goute)
	public function supprimerPartie($partie)
	{
		$this->modele->supprimerPartie($partie);
	}

	//retourne un tableau de tous les cepages
	public function trouverCepages()
	{
		return $this->modele->trouverCepages();
	}

	//retourne tous les vins
	public function trouverVins()
	{
		return $this->modele->trouverVins();
	}

	//retourne tous les types de vins
	public function trouverTypesVins()
	{
		return $this->modele->trouverTypesVins();
	}

	//retourne toutes les appellations
	public function trouverAppellations()
	{
		return $this->modele->trouverAppellations();
	}

	//retourne tous les domaines
	public function trouverDomaines()
	{
		return $this->modele->trouverDomaines();
	}

	//retourne toutes les robes
	public function trouverRobes()
	{
		return $this->modele->trouverRobes();
	}

	//retourne tous les nez
	public function trouverNez()
	{
		return $this->modele->trouverNez();
	}

	//retourne toutes les bouches
	public function trouverBouches()
	{
		return $this->modele->trouverBouches();
	}

	//retourne tous les membres
	public function trouverMembres()
	{
		return $this->modele->trouverMembres();
	}

	//retourne un tableau de toutes les parties
	public function trouverParties()
	{
		return $this->modele->trouverParties();
	}

	//retourne un tableau de tous les cours
	public function trouverCours()
	{
		return $this->modele->trouverCours();
	}

	//retourne un tableau de tous les cours
	public function trouverGroupes()
	{
		return $this->modele->trouverGroupes();
	}


	//retourne les vins contenant $nomDomaine dans le nom de domaine
	public function trouverVinsParNomDeDomaine($nomDomaine)
	{
		return $this->modele->trouverVinsParNomDeDomaine($nomDomaine);
	}

	//retourne les vins contenant le cepage $cepage
	public function trouverVinsParCepage($cepage)
	{
		return $this->modele->trouverVinsParCepage($cepage);
	}

	//retourne les vins contenant l'appellation $appellation
	public function trouverVinsParAppellation($appellation)
	{
		return $this->modele->trouverVinsParAppellation($appellation);
	}

	//retourne les vins contenant le type de vin $typeVin
	public function trouverVinsParTypeVin($typeVin)
	{
		return $this->modele->trouverVinsParTypeVin($typeVin);
	}

	//retourne les vins contenant $nomVin dans le nom
	public function trouverVinsParNom($nomVin)
	{
		return $this->modele->trouverVinsParNom($nomVin);
	}
	//retourne le vin suivant son ID.
	public function trouverVinParIdVin($IDVIn)
	{
		return $this->modele->trouverVinParIdVin($IDVIn);
	}

	//retourne les cepages du vin donné en paramètre
	public function trouverCepagesParVin($vin)
	{
		return $this->modele->trouverCepagesParVin($vin);
	}

	//retourne les domaines du vin passé en parmètre (plutôt un tableau avec LE domaine du vin)
	public function trouverDomainesParVin($vin)
	{
		return $this->modele->trouverDomainesParVin($vin);
	}

	//retourne un tableau avec l'appellation du vin
	public function trouverAppellationsParVin($vin)
	{
		return $this->modele->trouverAppellationsParVin($vin);
	}

	//retourne un tableau avec le type du vin
	public function trouverTypesVinsParVin($vin)
	{
		return $this->modele->trouverTypesVinsParVin($vin);
	}

	//retourne un tableau avec un membre s'il y en a avec le mail, sinon le tableau est vide
	public function trouverMembreParMail($mail)
	{
		return $this->modele->trouverMembreParMail($mail);
	}

	public function trouverMembreParPseudo($pseudo)
	{
		return $this->modele->trouverMembreParPseudo($pseudo);
	}


	//retourne les gouts du vin passé en paramètre
	public function trouverGoutsVin($vin)
	{
		return $this->modele->trouverGoutsVin($vin);
	}

	//retourne les robes du vin passé en paramètre
	public function trouverRobesVin($vin)
	{
		return $this->modele->trouverRobesVin($vin);
	}

	//retourne les nez du vin passé en paramètre
	public function trouverNezVin($vin)
	{
		return $this->modele->trouverNezVin($vin);
	}

	//retourne les gouts sélectionnés dans la partie passée en paramètre
	public function trouverGoutsPartie($partie)
	{
		return $this->modele->trouverGoutsPartie($partie);
	}

	//retourne les nez sélectionnés dans la partie
	public function trouverNezPartie($partie)
	{
		return $this->modele->trouverNezPartie($partie);
	}

	//retourne les robes sélectionnées dans la partie
	public function trouverRobesPartie($partie)
	{
		return $this->modele->trouverRobesPartie($partie);
	}

	//retourne les bouches correspondant au type de vin passé en paramètre
	public function trouverBouchesParTypeVin($typeVin)
	{
		return $this->modele->trouverBouchesParTypeVin($typeVin);
	}

	//retourne les nez correspondant au type de vin passé en paramètre
	public function trouverNezParTypeVin($typeVin)
	{
		return $this->modele->trouverNezParTypeVin($typeVin);
	}

	//retourne les robes correspondant au type de vin passé en paramètre
	public function trouverRobesParTypeVin($typeVin)
	{
		return $this->modele->trouverRobesParTypeVin($typeVin);
	}


	//retourne les parties du membre entré en paramètre
	public function trouverPartiesParMembre($membre)
	{
		return $this->modele->trouverPartiesParMembre($membre);
	}

}

?>