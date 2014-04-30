<?php
require_once('dossierModele/ModeleOenline.php');
class MetierOenline
{
	private $modele=NULL;

	public function __construct($hote, $id, $mdp, $bdd)
	{
		$this->modele=new ModeleOenline($hote, $id, $mdp, $bdd);
	}

	//ajouter un vin, avec son domaine, son appellation... ses cépages, ses vues, ses nez, ses bouches
	public function ajouterVin($vin, $domaine, $appellation, $typeVin, $cepages, $robes, $nezz, $bouches)
	{
		//teste si des parametres sont vide
		if($vin==NULL or $domaine==NULL or $appellation==NULL or $typeVin==NULL or $cepages==NULL or $robes==NULL or $nezz==NULL or $bouches==NULL)
		{
			throw new exception("<br>Il faut entrer un vin, un domaine, une appellation, un typeVin, des cepages, des robes, des nez et des bouches en parametre");
		}

		//teste si les bons objets sont entrés
		if(!is_a($vin, "Vin") or !is_a($domaine, "Domaine") or !is_a($appellation, "Appellation") or !is_a($typeVin, "TypeVin") or !is_a($cepages[0], "Cepage") or !is_a($robes[0], "Robe") or !is_a($nezz[0], "Nez") or !is_a($bouches[0], "Bouche"))
		{
			throw new Exception("<br>Les objets entré en paramètre ne sont pas bon, la signature de la fonction est:<br> ajouterVin(Vin v, Domaine d,Appellation a, TypeVin t, Cepage c[], Robe r[], Nez n[], Bouche b[]<br>");
		}

		//teste si les cépages existent bien dans la bdd
		foreach ($cepages as $cepage) {
			if(!$this->modele->existeIdCepage($cepage))
				throw new Exception("<br>Le cépage ".$cepage->idCepage." n'est pas dans la base de données");
		}

		//teste si les robes existent bien dans la bdd
		foreach ($robes as $robe) 
		{
			if(!$this->modele->existeIdRobe($robe))
				throw new Exception("<br>La robe ".$robe->idRobe." n'est pas dans la base de données");
		}

		//teste si les nez existeIdnt bien dans la bdd
		foreach ($nezz as $nez) 
		{
			if(!$this->modele->existeIdNez($nez))
				throw new Exception("<br>Le nez ".$nez->idNez." n'est pas dans la base de données");
		}

		//teste si les bouches existent bien dans la bdd
		foreach ($bouches as $bouche) 
		{
			if(!$this->modele->existeIdBouche($bouche))
				throw new Exception("<br>La bouche ".$bouche->idBouche." n'est pas dans la base de données");
		}

		//teste si le domaine, l'appellation et le type de vin sont dans la bdd
		if(!$this->modele->existeIdDomaine($domaine))
		{
			throw new Exception("<br>Le domaine ".$domaine->idDomaine." n'est pas dans la base de données ");
		}
		if(!$this->modele->existeIdAppellation($appellation))
		{
			throw new Exception("<br>L'appellation ".$appellation->idAppellation." n'est pas dans la base de données ");
		}
		if(!$this->modele->existeIdTypeVin($typeVin))
		{
			throw new Exception("<br>Le typeVin ".$typeVin->idTypeVin." n'est pas dans la base de données ");
		}

		$nomVin = $vin->nomVin;
		$millesime = $vin->millesime;
		$descCourte = $vin->descCourte;
		$descLongue = $vin->descLongue;

		//teste si le vin a bien tous les bons paramètres
		if($nomVin == "" or $millesime == "" or $descCourte == "" or $descLongue=="")
			throw new Exception("<br>Il faut remplir le nomVin, millesime, descCourte, descLongue dans l'objet vin");
		//ajoute le vin à la bdd, et retourne le vin avec un idVin alloué grace au auto-incrément
		return $this->modele->ajouterVin($vin, $domaine, $appellation, $typeVin, $cepages, $robes, $nezz, $bouches);
	}

	//ajoute une partie avec ses dépendances 
	//la fonction retourne un objet 'partie' avec le score qui lui correspond
	//en effet, ajouterPartie comporte une fonction qui calcule directement le score
	public function ajouterPartie($partie, $vin, $membre, $robess, $nezz, $bouches)
	{
		//teste si aucun paramètre n'est vide
		if($partie==NULL or $vin==NULL or $membre==NULL or $robess==NULL or $nezz==NULL or $bouches==NULL)
		{
			throw new Exception("<br>Il faut renseigner une partie, un vin, un membre, des robes, des nez et des bouches, la signature de la fonction est:<br> ajouterPartie(Partie p, Vin v, Membre m, Robe r[], Nez n[], Bouche b[]<br>");
		}
		//teste si les objets sont les bons
		if(!is_a($vin, "Vin") or !is_a($partie, "Partie") or !is_a($membre, "Membre") or !is_a($robess[0], "Robe") or !is_a($nezz[0], "Nez") or !is_a($bouches[0], "Bouche"))
		{
			throw new Exception("<br>Les objets entré en paramètre ne sont pas bon, la signature de la fonction est:<br> ajouterPartie(Partie p, Vin v, Membre m, Robe r[], Nez n[], Bouche b[]<br>");
		}

		//teste si les robes existent bien dans la bdd
		foreach ($robess as $robe) 
		{
			if(!$this->modele->existeIdRobe($robe))
				throw new Exception("<br>La robe ".$robe->idRobe." n'est pas dans la base de données");
		}

		//teste si les nez existent bien dans la bdd
		foreach ($nezz as $nez) 
		{
			if(!$this->modele->existeIdNez($nez))
				throw new Exception("<br>Le nez ".$nez->idNez." n'est pas dans la base de données");
		}

		//teste si les bouches existent bien dans la bdd
		foreach ($bouches as $bouche) {
			if(!$this->modele->existeIdBouche($bouche))
				throw new Exception("<br>La bouche ".$bouche->idBouche." n'est pas dans la base de données");
		}

		//teste si le vin et le membre exitent dans la bdd
		if(!$this->modele->existeIdVin($vin))
		{
			throw new Exception("<br>Le vin ".$vin->idVin." n'est pas dans la base de données ");
		}
		if(!$this->modele->existeIdMembre($membre))
		{
			throw new Exception("<br>Le membre ".$membre->idMembre." n'est pas dans la base de données ");
		}

		//teste que la date de partie est bien entrée
		if($partie->datePartie=='')
		{
			throw new Exception("<br>La date de la partie n'est pas renseignée");
		}

		//teste si trop de robes, nez ou vin sont entrés en paramètre pour éviter que le joueur coche toutes les cases pour obtenir 100%
		if(count($robess)>25 or count($nezz)>60 or count($bouches)>100)
			throw new Exception("<br>Peut-être le joueur a-t-il tenté de tricher: il y a plus de 25 robes, 60 nez ou 100 bouches!!! Réessayer en mettant moins de robes, nez et bouches<br>");
		
		//ajoute la partie, retourne une partie avec un id alloué dynamiquement, et le score calculé
		return $this->modele->ajouterPartie($partie, $vin, $membre, $robess, $nezz, $bouches);
	}

	//ajoute un membre 
	public function ajouterMembre($membre, $groupe)
	{
		//teste si les paramètres ne sont pas nulls
		if($membre==NULL or $groupe==NULL)
		{
			throw new Exception("<br>Il faut entrer un membre et un groupe non null à la fonction ajouterMembre");
		}

		//teste si les bons objets sont entré en paramètre
		if(!is_a($membre, "Membre") or !is_a($groupe, "Groupe"))
		{
			throw new Exception("<br>Il faut entrer un objet de la classe Membre et un objet de la classe Groupe en paramètre");
		}

		$nbMail = $this->modele->trouverMembreParMail($membre->mailMembre);
		$nbPseudo = $this->modele->trouverMembreParPseudo($membre->pseudoMembre);

		$nomMembre = $membre->nomMembre;
		$pseudoMembre = $membre->pseudoMembre;
		$mdp = $membre->motDePasse;
		$mailMembre = $membre->mailMembre;

		//teste si les champs sont bien renseigné
		if($nomMembre=="" OR $pseudoMembre=="" OR $mailMembre=="" OR $mdp=="")
		{
			throw new Exception("<br>Il faut remplir le nomMembre, pseudoMembre, mailMembre et le motDePasse");
		}

		//vériefie que le groupe existe bien dans la bdd
		if(!$this->modele->existeIdGroupe($groupe))
			throw new Exception("<br>Le groupe ".$groupe->idGroupe." n'est pas dans la base de données");
		
		//vérifie si aucun autre membre a le même mail
		if($nbMail<1)
		{
			throw new Exception("<br>Un membre avec le mail ".$membre->mailMembre." a déjà été inscrit");
		}

		//vérifie si aucun autre membre a le même pseudo
		if($nbPseudo<1)
		{
			throw new Exception("<br>Un membre avec le pseudo ".$membre->pseudoMembre." a déjà été inscrit");
		}

		//ajoute le membre, et retourne le membre avec l'id auto-incrémenté
		return $this->modele->ajouterMembre($membre, $groupe);
	}

	//ajoute un domaine
	public function ajouterDomaine($domaine)
	{
		$nom = $domaine->nomDomaine;
		if($nom==NULL or $nom=='')
		{
			throw new Exception("<br>Il faut renseigner le nom du domaine");
		}
		
		if($this->existeDomaine($domaine))
		{
			throw new Exception("<br>Le domaine existe déjà dans la base");
		}
		$this->modele->ajouterDomaine($domaine);
	}

	//ajoute un cépage
	public function ajouterCepage($cepage)
	{
		$nom = $cepage->nomCepage;
		if($nom==NULL or $nom=='')
		{
			throw new Exception("<br>Il faut renseigner le nom du cépage");
		}
		if($this->existeCepage($cepage))
		{
			throw new Exception("<br>Le cépage existe déjà dans la base");
		}
		$this->modele->ajouterCepage($cepage);
	}

	//ajoute une appellation
	public function ajouterAppellation($appellation)
	{
		$nom = $appellation->nomAppellation;
		if($nom==NULL or $nom=='')
		{
			throw new Exception("<br>Il faut renseigner le nom de l'appellation");
		}
		if($this->existeAppellation($appellation))
		{
			throw new Exception("<br>L'appellation existe déjà dans la base");
		}
		$this->modele->ajouterAppellation($appellation);
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
	
	//retourne les parties du membre entré en paramètre
	public function trouverPartiesParMembre($membre)
	{
		return $this->modele->trouverPartiesParMembre($membre);
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
	
	//retourne les bouches correspondant au vin passé en paramètre
	public function trouverBouchesParVin($vins)
	{
		return $this->modele->trouverBouchesParVin($vins);
	}
	
	//retourne les robes correspondant au type de vin passé en paramètre
	public function trouverRobesParTypeVin($typeVin)
	{
		return $this->modele->trouverRobesParTypeVin($typeVin);
	}

	//retourne les robes correspondant au vin passé en paramètre
	public function trouverRobesParVin($vins)
	{
		return $this->modele->trouverRobesParVin($vins);
	}
	
	//retourne les nez correspondant au type de vin passé en paramètre
	public function trouverNezParTypeVin($typeVin)
	{
		return $this->modele->trouverNezParTypeVin($typeVin);
	}

	//retourne les nez correspondant au vin passé en paramètre
	public function trouverNezParVin($vins)
	{
		return $this->modele->trouverNezParVin($vins);
	}

	//retourne les nez correspondant au vin passé en paramètre
	public function trouverCoursParTitreCours($titreCours)
	{
		return $this->modele->trouverCoursParTitreCours($titreCours);
	}

	//vérifie si le un cépage de ce nom existe déjà, retourne un booléen
	public function existeCepage($cepage)
	{
		return $this->modele->existeCepage($cepage);
	} 

	//vérifie si le un domaine de ce nom existe déjà, retourne un booléen
	public function existeDomaine($domaine)
	{
		return $this->modele->existedomaine($domaine);
	} 

	//vérifie si une appellation de ce nom existe déjà, retourne un booléen
	public function existeAppellation($appellation)
	{
		return $this->modele->existeAppellation($appellation);
	} 


}

?>