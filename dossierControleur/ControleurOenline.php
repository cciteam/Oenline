<?php

require_once('dossierModele/ModeleOenline.php');

class ControleurOenline
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
			if(!$this->modele->existeCepage($cepage))
				throw new Exception("<br>Le cépage ".$cepage->idCepage." n'est pas dans la base de données");
		}

		//teste si les robes existent bien dans la bdd
		foreach ($robes as $robe) 
		{
			if(!$this->modele->existeRobe($robe))
				throw new Exception("<br>La robe ".$robe->idRobe." n'est pas dans la base de données");
		}

		//teste si les nez existent bien dans la bdd
		foreach ($nezz as $nez) 
		{
			if(!$this->modele->existeNez($nez))
				throw new Exception("<br>Le nez ".$nez->idNez." n'est pas dans la base de données");
		}

		//teste si les bouches existent bien dans la bdd
		foreach ($bouches as $bouche) 
		{
			if(!$this->modele->existeBouche($bouche))
				throw new Exception("<br>La bouche ".$bouche->idBouche." n'est pas dans la base de données");
		}

		//teste si le domaine, l'appellation et le type de vin sont dans la bdd
		if(!$this->modele->existeDomaine($domaine))
		{
			throw new Exception("<br>Le domaine ".$domaine->idDomaine." n'est pas dans la base de données ");
		}
		if(!$this->modele->existeAppellation($appellation))
		{
			throw new Exception("<br>L'appellation ".$appellation->idAppellation." n'est pas dans la base de données ");
		}
		if(!$this->modele->existeTypeVin($typeVin))
		{
			throw new Exception("<br>Le typeVin ".$typeVin->idTypeVin." n'est pas dans la base de données ");
		}

		//la fonction trim(...) supprime les espaces en début de chaîne
		$nomVin = trim($vin->nomVin);
		$millesime = trim($vin->millesime);
		$descCourte = trim($vin->descCourte);
		$descCourte = trim($vin->descCourte);

		//teste si le vin a bien tous les bons paramètres
		if($nomVin == "" or $millesime == "" or $descCourte == "" or $descCourte=="")
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
			if(!$this->modele->existeRobe($robe))
				throw new Exception("<br>La robe ".$robe->idRobe." n'est pas dans la base de données");
		}

		//teste si les nez existent bien dans la bdd
		foreach ($nezz as $nez) 
		{
			if(!$this->modele->existeNez($nez))
				throw new Exception("<br>Le nez ".$nez->idNez." n'est pas dans la base de données");
		}

		//teste si les bouches existent bien dans la bdd
		foreach ($bouches as $bouche) {
			if(!$this->modele->existeBouche($bouche))
				throw new Exception("<br>La bouche ".$bouche->idBouche." n'est pas dans la base de données");
		}

		//teste si le vin et le membre exitent dans la bdd
		if(!$this->modele->existeVin($vin))
		{
			throw new Exception("<br>Le vin ".$vin->idVin." n'est pas dans la base de données ");
		}
		if(!$this->modele->existeMembre($membre))
		{
			throw new Exception("<br>Le membre ".$membre->idMembre." n'est pas dans la base de données ");
		}

		//teste que la date de partie est bien entrée
		if(trim($partie->datePartie==''))
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
			throw new Exception("<br>Le parametre il faut entrer un objet de la classe Membre et un objet de la classe Groupe en paramètre");
		}

		$nbMail = count($this->modele->trouverMembreParMail($membre->mailMembre));
		$nbPseudo = count($this->modele->trouverMembreParPseudo($membre->pseudoMembre));

		$nomMembre = trim($membre->nomMembre);
		$pseudoMembre = trim($membre->pseudoMembre);
		$mdp = $membre->motDePasse;
		$mailMembre = trim($membre->mailMembre);

		//teste si les champs sont bien renseigné
		if($nomMembre=="" OR $pseudoMembre=="" OR $mailMembre=="" OR $mdp=="")
		{
			throw new Exception("<br>Il faut remplir le nomMembre, pseudoMembre, mailMembre et le motDePasse");
		}

		//vériefie que le groupe existe bien dans la bdd
		if(!$this->modele->existeGroupe($groupe))
			throw new Exception("<br>Le groupe ".$groupe->idGroupe." n'est pas dans la base de données");
		
		//vérifie si aucun autre membre a le même mail
		if($nbMail > 0)
		{
			throw new Exception("<br>Un membre avec le mail ".$membre->mailMembre." a déjà été inscrit");
		}

		//vérifie si aucun autre membre a le même pseudo
		if($nbPseudo > 0)
		{
			throw new Exception("<br>Un membre avec le pseudo ".$membre->pseudoMembre." a déjà été inscrit");
		}

		//ajoute le membre, et retourne le membre avec l'id auto-incrémenté
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
	
	
	//retourne un tableau de String décrivant les vins correspondant au cépage entré en paramètre
	public function afficherVinsParCepage($cepage)
	{

		$vins = $this->modele->trouverVinsParCepage($cepage);
		$str = $this->descriptionVins($vins);
		return $str;
	}

	//retourne un tableau de String décrivant les vins correspondant au nom de domaine
	public function afficherVinsParNomDeDomaine($nomDomaine)
	{

		$vins = $this->modele->trouverVinsParNomDeDomaine($nomDomaine);
		$str = $this->descriptionVins($vins);
		return $str;
	}

	//retourne un tableau de String décrivant les vins correspondant a l'appellation entrée en paramètre
	public function afficherVinsParAppellation($appellation)
	{

		$vins = $this->modele->trouverVinsParAppellation($appellation);
		$str = $this->descriptionVins($vins);
		return $str;
	}

	//retourne un tableau de String décrivant les vins correspondant au cépage entré en paramètre
	public function afficherVinsParTypeVin($typeVin)
	{

		$vins = $this->modele->trouverVinsParTypeVin($typeVin);
		$str = $this->descriptionVins($vins);
		return $str;
	}

	//retourne un tableau de String décrivant les vins contenant $nomVin dans le nom
	public function afficherVinsParNom($nomVin)
	{
		$vins = $this->modele->trouverVinsParNom($nomVin);
		$str = $this->descriptionVins($vins);
		return $str;
	}

	//retourne un tableau de String et prends un tableau de vin en paramètre
	public function descriptionVins($vins)
	{
		if (!empty($vins)){			
			ob_start();
			$nomDomainePrecedant="";
			echo "<div>";
			foreach ($vins as $vin){
				$domaine = $this->trouverDomainesParVin($vin);
				$domaine = $domaine[0];
				if ($nomDomainePrecedant!=$domaine->nomDomaine){
					echo "</div>";
					echo "<div classe = 'Domaine'>";
					echo "<h3><a href = 'home.php?Section=VinsReferences&Rechercher_par_nomDomaine=Rechercher&parametre=".utf8_encode($domaine->nomDomaine)."'>";
					echo $domaine->nomDomaine."</a></h3>";
					$nomDomainePrecedant = $domaine->nomDomaine;}
				$cepages = $this->trouverCepagesParVin($vin);
				$typeVin = $this->trouverTypesVinsParVin($vin);
				$appellation = $this->trouverAppellationsParVin($vin);
				echo '<article>';
				echo '<header><a href = "">'.$vin->nomVin.'</a>, millésime '.$vin->millesime.'</header>';
				echo '<hr/>';
				echo '<p>'.$domaine->nomDomaine. '<br>';
				echo 'Numero du vin : '.$vin->idVin. '<br>';
				echo 'Appellation : '.$appellation[0]->nomAppellation.'<br>';
				echo 'Type de vin : '.$typeVin[0]->nomTypeVin.'<br>';
				echo 'Cépages : ';
				echo $cepages[0]->nomCepage;
				for ($i = 1; $i<count($cepages); $i++){
					echo ', '.utf8_encode($cepages[$i]->nomCepage);
					}
				echo '<br>'.$vin->descCourte;
				echo '</p></article>';
			}
			$str = ob_get_clean();
		}
		else {$str = '<div><p>Aucun vin ne correspond à votre recherche</p></div>';}
		return $str;
	}

	//retourne un tableau de String avec la description complète des vins donné en paramètre(avec leurs bouches, leurs nez, leurs robes...)
	public function descriptionVinsComplete($vins)
	{
		$str = array();
		for ($i = 0; $i < count($vins); $i++) 
		{
			$domaines = $this->modele->trouverDomainesParVin($vins[$i]);
			$cepages = $this->modele->trouverCepagesParVin($vins[$i]);
			$appellations = $this->modele->trouverAppellationsParVin($vins[$i]);
			$typesVins = $this->modele->trouverTypesVinsParVin($vins[$i]);
			$bouches = $this->modele->trouverBouchesParVin($vins[$i]);
			$robes = $this->modele->trouverRobesParVin($vins[$i]);
			$nezz = $this->modele->trouverNezParVin($vins[$i]);

			$strDom = "<br>Domaine: ";
			$strCep = "<br>Cépages: ";
			$strApp = "<br>Appellation: ";
			$strTyp = "<br>Type: ";
			$strRob = "<br><br>Notre oenologue a observé les robes suivantes: ";
			$strNez = "<br><br>Notre oenologue a senti les nez suivants: ";
			$strBou = "<br><br>Notre oenologue a relevé les bouches suivantes: ";

			$strVin = "<br>Référence: ".$vins[$i]->idVin."<br>Nom: ".$vins[$i]->nomVin."<br>Brève description: ".$vins[$i]->descCourte."<br>Description approfondie: ".$vins[$i]->descLongue;

			foreach ($domaines as $domaine) {
				$strDom .= $domaine->nomDomaine;
			}

			foreach ($cepages as $cepage) {
				$strCep .= " ".$cepage->nomCepage;
			}

			foreach ($appellations as $appellation) {
				$strApp .= " ".$appellation->nomAppellation;
			}

			foreach ($typesVins as $typeVin) {
				$strTyp .= " ".$typeVin->nomTypeVin;
			}

			foreach ($robes as $robe) {
				$strRob .= "<br> -".$robe->nomRobe." |  Score: ".$robe->scoreRobe;
			}

			foreach ($nezz as $nez) {
				$strNez .= "<br> -".$nez->nomNez." | Score: ".$nez->scoreNez;
			}

			foreach ($bouches as $bouche) {
				$strBou .= "<br> -".$bouche->nomBouche." | Score: ".$bouche->scoreBouche;
			}

			$str[$i] = $strVin.$strTyp.$strApp.$strDom.$strCep.$strRob.$strNez.$strBou."<br>";

		}

		return $str;
	}

}

?>