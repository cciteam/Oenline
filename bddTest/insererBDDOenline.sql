// fichier d'insertion de données
INSERT INTO `cepage`(`idCepage`, `nomCepage`) VALUES (1,'Merlot');
INSERT INTO `cepage`(`idCepage`, `nomCepage`) VALUES (2,'Grenache Noir');
INSERT INTO `cepage`(`idCepage`, `nomCepage`) VALUES (3,'Syrah');
INSERT INTO `cepage`(`idCepage`, `nomCepage`) VALUES (4,'Ugni Blanc');
INSERT INTO `cepage`(`idCepage`, `nomCepage`) VALUES (5,'Chardonnay');
INSERT INTO `cepage`(`idCepage`, `nomCepage`) VALUES (6,'Sauvignon Blanc');

INSERT INTO `typevin`(`idTypeVin`, `nomTypeVin`) VALUES (1,'Rouge');
INSERT INTO `typevin`(`idTypeVin`, `nomTypeVin`) VALUES (2,'Blanc');
INSERT INTO `typevin`(`idTypeVin`, `nomTypeVin`) VALUES (3,'Rosé');
INSERT INTO `typevin`(`idTypeVin`, `nomTypeVin`) VALUES (4,'Effervescent');

INSERT INTO `appellation`(`idAppellation`, `nomAppellation`) VALUES (1,'AOC');
INSERT INTO `appellation`(`idAppellation`, `nomAppellation`) VALUES (2,'AOP');
INSERT INTO `appellation`(`idAppellation`, `nomAppellation`) VALUES (3,'VDQS');
INSERT INTO `appellation`(`idAppellation`, `nomAppellation`) VALUES (4,'IGP');
INSERT INTO `appellation`(`idAppellation`, `nomAppellation`) VALUES (5,'Vin de Pays');
INSERT INTO `appellation`(`idAppellation`, `nomAppellation`) VALUES (6,'Vin de Table');
INSERT INTO `appellation`(`idAppellation`, `nomAppellation`) VALUES (7,'Vin de France');

INSERT INTO `domaine`(`idDomaine`, `nomDomaine`, `urlDomaine`) VALUES (1,'Domaine Daniel Chotard','http://www.chotard-sancerre.com/');
INSERT INTO `domaine`(`idDomaine`, `nomDomaine`, `urlDomaine`) VALUES (2,'Domaine2','url2');
INSERT INTO `domaine`(`idDomaine`, `nomDomaine`, `urlDomaine`) VALUES (3,'Domaine3','url3');
INSERT INTO `domaine`(`idDomaine`, `nomDomaine`, `urlDomaine`) VALUES (4,'Domaine4','url4');

INSERT INTO `vin`(`idvin`, `nomVin`, `descCourte`, `descLongue`, `millesime`, `idDomaine`, `idAppellation`, `idTypeVin`) VALUES (1,'Vin1','Un vin rouge','Un très bon vin rouge','2008',2,1,1);
INSERT INTO `vin`(`idvin`, `nomVin`, `descCourte`, `descLongue`, `millesime`, `idDomaine`, `idAppellation`, `idTypeVin`) VALUES (2,'Vin2','Un vin blanc','Un très bon vin blanc','2000',1,1,2);
INSERT INTO `vin`(`idvin`, `nomVin`, `descCourte`, `descLongue`, `millesime`, `idDomaine`, `idAppellation`, `idTypeVin`) VALUES (3,'Vin3','Un vin rosé','Un très bon vin rosé','2008',3,1,3);

INSERT INTO `constitue`(`idVin`, `idCepage`) VALUES (1,1);
INSERT INTO `constitue`(`idVin`, `idCepage`) VALUES (1,2);
INSERT INTO `constitue`(`idVin`, `idCepage`) VALUES (2,3);
INSERT INTO `constitue`(`idVin`, `idCepage`) VALUES (2,4);
INSERT INTO `constitue`(`idVin`, `idCepage`) VALUES (3,5);
INSERT INTO `constitue`(`idVin`, `idCepage`) VALUES (3,6);

INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (1,'Marquée','??','Attaque',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (2,'Bonne','??','Attaque',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (3,'Pas minéral','??','Minéralité',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (4,'Crayeux','??','Minéralité',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (5,'Peu Présents','??','Tanins',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (6,'Fondus','??','Tanins',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (7,'Court','??','Longueur',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (8,'Long','??','Longueur',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (9,'Plat','??','Rondeur',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (10,'Rond','??','Rondeur',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (11,'Faible','??','Alcool',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (12,'Alcooleux','??','Alcool',2);

INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (13,'Caramel','Notes grillées','Aromes',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (14,'Notes grillées','Notes grillées','Aromes',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (15,'Mure','Fruits Rouges','Aromes',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (16,'Fruits Rouges','Fruits Rouges','Aromes',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (17,'Coing','Fruits jaunes','Aromes',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (18,'Pèche','Fruits jaunes','Aromes',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (19,'Fruits jaunes','Fruits jaune','Aromes',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (20,'Ananas','Fruits exotiques','Aromes',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (21,'Fruits exotiques','Fruits exotiques','Aromes',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (22,'Rose','Fleurs','Aromes',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (23,'Fleurs','Fleurs','Aromes',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (24,'Citron','Agrumes','Aromes',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (25,'Agrumes','Agrumes','Aromes',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (26,'Réglisse','Végétaux','Aromes',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `scoreBouche`) VALUES (27,'Végétaux','Végétaux','Aromes',2);

INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (1,'Caramel','Notes grillées', 4);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (2,'Notes grillées','Notes grillées',2);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (3,'Mure','Fruits rouges', 4);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (4,'Fruits rouges','Fruits rouges',2);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (5,'Coing','Fruits jaunes', 4);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (6,'Fruits jaunes','Fruits jaunes', 2);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (7,'Pèche','Fruits jaunes', 4);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (8,'Fruits jaunes','Fruits jaunes', 2);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (9,'Ananas','Fruits exotiques', 4);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (10,'Fruits exotiques','Fruits exotiques', 2);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (11,'Rose','Fleurs', 4);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (12,'Fleurs','Fleurs',2);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (13,'Citron','Agrumes', 4);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (14,'Agrumes','Agrumes', 2);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (15,'Réglisse','Végétaux', 4);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `scoreNez`) VALUES (16,'Végétaux','Végétaux', 2);

INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (1,'Brique','??','Couleur',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (2,'Brun','??','Couleur',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (3,'Reflets violets','??','Couleur',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (4,'Jaune','??','Couleur',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (5,'Orange','??','Couleur',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (6,'Vert','??','Couleur',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (7,'Rose','??','Couleur',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (8,'Abricot','??','Couleur',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (9,'Doré','??','Couleur',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (10,'Vin fluide','??','Viscosité',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (11,'Vin visqueux','??','Viscosité',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (12,'Jambes le long du verre','??','Viscosité',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (13,'Robe Intense','??','Intensité et limpidité',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (14,'Très coloré','??','Intensité et limpidité',2);
INSERT INTO `robe`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `scoreRobe`) VALUES (15,'Limpide','??','Intensité et limpidité',2);

INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,1);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,2);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,3);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,4);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,5);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,6);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,7);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,8);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,9);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,10);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,11);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,12);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,14);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,15);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,16);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,26);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (1,27);

INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,1);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,2);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,3);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,4);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,5);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,6);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,7);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,8);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,9);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,10);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,11);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,12);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,17);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,18);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,19);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,20);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (2,21);

INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,1);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,2);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,3);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,4);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,5);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,6);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,7);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,8);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,9);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,10);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,11);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,12);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,22);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,23);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,24);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,25);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,26);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (3,27);

INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,1);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,2);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,3);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,4);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,5);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,6);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,7);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,8);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,9);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,10);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,11);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,12);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,17);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,18);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,19);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,20);
INSERT INTO `bouchetypevin`(`idTypeVin`, `idBouche`) VALUES (4,21);


INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (1,1);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (1,2);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (1,3);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (1,4);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (1,15);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (1,16);

INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (2,5);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (2,6);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (2,7);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (2,8);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (2,9);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (2,10);

INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (3,3);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (3,4);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (3,11);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (3,12);

INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (4,5);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (4,6);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (4,7);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (4,8);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (4,9);
INSERT INTO `neztypevin`(`idTypeVin`, `idNez`) VALUES (4,10);

INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (1,1);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (1,2);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (1,3);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (1,10);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (1,11);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (1,12);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (1,13);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (1,14);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (1,15);

INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (2,4);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (2,5);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (2,6);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (2,10);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (2,11);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (2,12);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (2,13);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (2,14);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (2,15);

INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (3,7);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (3,8);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (3,9);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (3,10);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (3,11);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (3,12);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (3,13);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (3,14);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (3,15);

INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (4,4);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (4,5);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (4,6);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (4,10);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (4,11);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (4,12);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (4,13);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (4,14);
INSERT INTO `robetypevin`(`idTypeVin`, `idRobe`) VALUES (4,15);

INSERT INTO `aaspect`(`idVin`, `idRobe`) VALUES (1, 1);
INSERT INTO `aaspect`(`idVin`, `idRobe`) VALUES (1, 4);
INSERT INTO `aaspect`(`idVin`, `idRobe`) VALUES (1, 7);

INSERT INTO `aaspect`(`idVin`, `idRobe`) VALUES (2, 10);
INSERT INTO `aaspect`(`idVin`, `idRobe`) VALUES (2, 13);
INSERT INTO `aaspect`(`idVin`, `idRobe`) VALUES (2, 16);

INSERT INTO `aaspect`(`idVin`, `idRobe`) VALUES (3, 19);
INSERT INTO `aaspect`(`idVin`, `idRobe`) VALUES (3, 22);
INSERT INTO `aaspect`(`idVin`, `idRobe`) VALUES (3, 25);


INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (1, 2);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (1, 3);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (1, 6);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (1, 8);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (1, 10);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (1, 12);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (1, 13);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (1, 14);

INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (2, 18);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (2, 19);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (2, 22);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (2, 24);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (2, 26);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (2, 27);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (2, 29);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (2, 30);

INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (3, 33);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (3, 36);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (3, 38);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (3, 40);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (3, 42);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (3, 43);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (3, 47);
INSERT INTO `agout`(`idVin`, `idBouche`) VALUES (3, 48);

INSERT INTO `aodeur`(`idVin`, `idNez`) VALUES (1, 1);
INSERT INTO `aodeur`(`idVin`, `idNez`) VALUES (1, 2);
INSERT INTO `aodeur`(`idVin`, `idNez`) VALUES (2, 5);
INSERT INTO `aodeur`(`idVin`, `idNez`) VALUES (2, 6);
INSERT INTO `aodeur`(`idVin`, `idNez`) VALUES (3, 9);
INSERT INTO `aodeur`(`idVin`, `idNez`) VALUES (3, 10);

INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (1,2);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (1,8);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (1,12);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (1,13);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (1,14);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (2,18);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (2,20);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (2,24);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (2,27);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (2,30);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (3,34);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (3,36);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (3,40);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (3,47);
INSERT INTO `goute`(`idPartie`, `idBouche`) VALUES (3,48);

INSERT INTO `sent`(`idPartie`, `idNez`) VALUES (1,1);
INSERT INTO `sent`(`idPartie`, `idNez`) VALUES (1,4);
INSERT INTO `sent`(`idPartie`, `idNez`) VALUES (1,7);
INSERT INTO `sent`(`idPartie`, `idNez`) VALUES (2,10);
INSERT INTO `sent`(`idPartie`, `idNez`) VALUES (2,13);
INSERT INTO `sent`(`idPartie`, `idNez`) VALUES (2,16);
INSERT INTO `sent`(`idPartie`, `idNez`) VALUES (3,19);
INSERT INTO `sent`(`idPartie`, `idNez`) VALUES (3,22);
INSERT INTO `sent`(`idPartie`, `idNez`) VALUES (3,25);

INSERT INTO `voit`(`idPartie`, `idRobe`) VALUES (1,1);
INSERT INTO `voit`(`idPartie`, `idRobe`) VALUES (1,2);
INSERT INTO `voit`(`idPartie`, `idRobe`) VALUES (2,5);
INSERT INTO `voit`(`idPartie`, `idRobe`) VALUES (2,6);
INSERT INTO `voit`(`idPartie`, `idRobe`) VALUES (3,9);
INSERT INTO `voit`(`idPartie`, `idRobe`) VALUES (3,10);

INSERT INTO `partie`(`idPartie`, `datePartie`, `scorePartie`, `commentairePartie`,`idMembre`, `idVin`) VALUES (1,'2014-02-20','','',1,1);
INSERT INTO `partie`(`idPartie`, `datePartie`, `scorePartie`, `idMembre`, `idVin`) VALUES (2,'2014-02-20','',1,2);
INSERT INTO `partie`(`idPartie`, `datePartie`, `scorePartie`, `idMembre`, `idVin`) VALUES (3,'2014-02-20','',2,3);

INSERT INTO `membre`(`idMembre`, `pseudoMembre`, `nomMembre`, `motDePasse`, `mailMembre`, `idGroupe`) VALUES (1,'bob','truc', 'Robert','bob@cold.net',1);
INSERT INTO `membre`(`idMembre`, `pseudoMembre`, `nomMembre`, `motDePasse`, `mailMembre`, `idGroupe`) VALUES (2,'lia','Ella', 'truc', 'lia@cold.net',1);

INSERT INTO `groupe`(`idGroupe`, `nomGroupe`) VALUES (1,'membre');
INSERT INTO `groupe`(`idGroupe`, `nomGroupe`) VALUES (2,'oenologue');
INSERT INTO `groupe`(`idGroupe`, `nomGroupe`) VALUES (3,'administrateur');

INSERT INTO `cours`(`idCours`, `titreCours`, `motCleCours`, `urlCours`) VALUES (1,'Le vin','Vin oenologie cepage','url1');
