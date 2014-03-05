INSERT INTO `cepage`(`idCepage`, `nomCepage`, `caracteristiqueCepage`) VALUES (1,'Merlot','Très commun');
INSERT INTO `cepage`(`idCepage`, `nomCepage`, `caracteristiqueCepage`) VALUES (2,'Grenache Noir','Intense');
INSERT INTO `cepage`(`idCepage`, `nomCepage`, `caracteristiqueCepage`) VALUES (3,'Syrah','100% français');
INSERT INTO `cepage`(`idCepage`, `nomCepage`, `caracteristiqueCepage`) VALUES (4,'Ugni Blanc','Léger');
INSERT INTO `cepage`(`idCepage`, `nomCepage`, `caracteristiqueCepage`) VALUES (5,'Chardonnay','Très commun');
INSERT INTO `cepage`(`idCepage`, `nomCepage`, `caracteristiqueCepage`) VALUES (6,'Sauvignon Blanc','Blanc');

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

INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (1,'Marquée','??','Attaque',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (2,'Bonne','??','Attaque',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (3,'Pas minéral','??','Minéralité',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (4,'Crayeux','??','Minéralité',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (5,'Peu Présents','??','Tanins',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (6,'Fondus','??','Tanins',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (7,'Court','??','Longueur',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (8,'Long','??','Longueur',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (9,'Plat','??','Rondeur',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (10,'Rond','??','Rondeur',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (11,'Faible','??','Alcool',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (12,'Alcooleux','??','Alcool',1);

INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (13,'Caramel','Notes grillées','Aromes',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (14,'Notes grillées','Notes grillées','Aromes',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (15,'Mure','Fruits Rouges','Aromes',1);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (16,'Fruits Rouges','Fruits Rouges','Aromes',1);

INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (17,'Marquée','??','Attaque',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (18,'Bonne','??','Attaque',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (19,'Pas minéral','??','Minéralité',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (20,'Crayeux','??','Minéralité',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (21,'Court','??','Longueur',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (22,'Long','??','Longueur',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (23,'Plat','??','Rondeur',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (24,'Rond','??','Rondeur',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (25,'Faible','??','Alcool',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (26,'Alcooleux','??','Alcool',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (27,'Sec','??','Sucrosité',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (28,'Liquoreux','??','Sucrosité',2);

INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (29,'Coing','Fruits jaunes','Aromes',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (30,'Fruits jaunes','Fruits jaune','Aromes',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (31,'Ananas','Fruits exotiques','Aromes',2);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (32,'Fruits exotiques','Fruits exotiques','Aromes',2);

INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (33,'Marquée','??','Attaque',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (34,'Bonne','??','Attaque',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (35,'Pas minéral','??','Minéralité',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (36,'Crayeux','??','Minéralité',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (37,'Court','??','Longueur',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (38,'Long','??','Longueur',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (39,'Plat','??','Rondeur',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (40,'Rond','??','Rondeur',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (41,'Faible','??','Alcool',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (42,'Alcooleux','??','Alcool',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (43,'Sec','??','Sucrosité',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (44,'Liquoreux','??','Sucrosité',3);

INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (45,'Pèche','Fruits jaunes','Aromes',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (46,'Fruits jaunes','Fruits jaunes','Aromes',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (47,'Rose','Fleurs','Aromes',3);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (48,'Fleurs','Fleurs','Aromes',3);

INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (49,'Marquée','??','Attaque',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (50,'Bonne','??','Attaque',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (51,'Pas minéral','??','Minéralité',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (52,'Crayeux','??','Minéralité',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (53,'Court','??','Longueur',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (54,'Long','??','Longueur',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (55,'Plat','??','Rondeur',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (56,'Rond','??','Rondeur',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (57,'Faible','??','Alcool',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (58,'Alcooleux','??','Alcool',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (59,'Sec','??','Sucrosité',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (60,'Liquoreux','??','Sucrosité',4);

INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (61,'Citron','Agrumes','Aromes',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (62,'Agrumes','Agrumes','Aromes',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (63,'Réglisse','Végétaux','Aromes',4);
INSERT INTO `bouche`(`idBouche`, `nomBouche`, `typeBouche`, `typeDescBouche`, `idTypeVin`) VALUES (64,'Végétaux','Végétaux','Aromes',4);

INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (1,'Caramel','Notes grillées', 1);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (2,'Notes grillées','Notes grillées', 1);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (3,'Mure','Fruits rouges', 1);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (4,'Fruits rouges','Fruits rouges', 1);

INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (5,'Coing','Fruits jaunes', 2);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (6,'Fruits jaunes','Fruits jaunes', 2);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (7,'Ananas','Fruits exotiques', 2);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (8,'Fruits exotiques','Fruits exotiques', 2);

INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (9,'Pèche','Fruits jaunes', 3);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (10,'Fruits jaunes','Fruits jaunes', 3);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (11,'Rose','Fleurs', 3);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (12,'Fleurs','Fleurs', 3);

INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (13,'Citron','Agrumes', 4);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (14,'Agrumes','Agrumes', 4);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (15,'Réglisse','Végétaux', 4);
INSERT INTO `nez`(`idNez`, `nomNez`, `typeNez`, `idTypeVin`) VALUES (16,'Végétaux','Végétaux', 4);

INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (1,'Brique','??','Couleur',1);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (2,'Brun','??','Couleur',1);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (3,'Reflets violets','??','Couleur',1);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (4,'Vin fluide','??','Viscosité',1);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (5,'Vin visqueux','??','Viscosité',1);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (6,'Jambes le long du verre','??','Viscosité',1);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (7,'Robe Intense','??','Intensité et limpidité',1);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (8,'Très coloré','??','Intensité et limpidité',1);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (9,'Limpide','??','Intensité et limpidité',1);

INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (10,'Jaune','??','Couleur',2);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (11,'Orange','??','Couleur',2);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (12,'Vert','??','Couleur',2);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (13,'Vin fluide','??','Viscosité',2);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (14,'Vin visqueux','??','Viscosité',2);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (15,'Jambes le long du verre','??','Viscosité',2);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (16,'Robe Intense','??','Intensité et limpidité',2);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (17,'Très coloré','??','Intensité et limpidité',2);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (18,'Limpide','??','Intensité et limpidité',2);

INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (19,'Rose','??','Couleur',3);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (20,'Abricot','??','Couleur',3);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (21,'Violet','??','Couleur',3);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (22,'Vin fluide','??','Viscosité',3);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (23,'Vin visqueux','??','Viscosité',3);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (24,'Jambes le long du verre','??','Viscosité',3);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (25,'Robe Intense','??','Intensité et limpidité',3);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (26,'Très coloré','??','Intensité et limpidité',3);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (27,'Limpide','??','Intensité et limpidité',3);

INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (28,'Doré','??','Couleur',4);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (29,'Vert','??','Couleur',4);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (30,'Jaune','??','Couleur',4);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (31,'Vin fluide','??','Viscosité',4);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (32,'Vin visqueux','??','Viscosité',4);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (33,'Jambes le long du verre','??','Viscosité',4);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (34,'Robe Intense','??','Intensité et limpidité',4);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (35,'Très coloré','??','Intensité et limpidité',4);
INSERT INTO `vue`(`idRobe`, `nomRobe`, `typeRobe`, `typeDescRobe`, `idTypeVin`) VALUES (36,'Limpide','??','Intensité et limpidité',4);

INSERT INTO `aaspect`(`idVin`, `idRobe`, `scoreVue`) VALUES (1, 1, 2);
INSERT INTO `aaspect`(`idVin`, `idRobe`, `scoreVue`) VALUES (1, 4, 2);
INSERT INTO `aaspect`(`idVin`, `idRobe`, `scoreVue`) VALUES (1, 7, 2);

INSERT INTO `aaspect`(`idVin`, `idRobe`, `scoreVue`) VALUES (2, 10, 2);
INSERT INTO `aaspect`(`idVin`, `idRobe`, `scoreVue`) VALUES (2, 13, 2);
INSERT INTO `aaspect`(`idVin`, `idRobe`, `scoreVue`) VALUES (2, 16, 2);

INSERT INTO `aaspect`(`idVin`, `idRobe`, `scoreVue`) VALUES (3, 19, 2);
INSERT INTO `aaspect`(`idVin`, `idRobe`, `scoreVue`) VALUES (3, 22, 2);
INSERT INTO `aaspect`(`idVin`, `idRobe`, `scoreVue`) VALUES (3, 25, 2);


INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (1, 2, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (1, 3, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (1, 6, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (1, 8, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (1, 10, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (1, 12, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (1, 13, 3);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (1, 14, 2);

INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (2, 18, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (2, 19, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (2, 22, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (2, 24, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (2, 26, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (2, 27, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (2, 29, 3);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (2, 30, 2);

INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (3, 33, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (3, 36, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (3, 38, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (3, 40, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (3, 42, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (3, 43, 2);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (3, 47, 3);
INSERT INTO `agout`(`idVin`, `idBouche`, `scoreGout`) VALUES (3, 48, 2);

INSERT INTO `aodeur`(`idVin`, `idNez`, `scoreNez`) VALUES (1, 1, 3);
INSERT INTO `aodeur`(`idVin`, `idNez`, `scoreNez`) VALUES (1, 2, 2);
INSERT INTO `aodeur`(`idVin`, `idNez`, `scoreNez`) VALUES (2, 5, 3);
INSERT INTO `aodeur`(`idVin`, `idNez`, `scoreNez`) VALUES (2, 6, 2);
INSERT INTO `aodeur`(`idVin`, `idNez`, `scoreNez`) VALUES (3, 9, 3);
INSERT INTO `aodeur`(`idVin`, `idNez`, `scoreNez`) VALUES (3, 10, 2);

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

INSERT INTO `membre`(`idMembre`, `aliasMembre`, `nomMembre`, `motDePasse`, `mailMembre`, `questionSecrete`, `reponseQuestion`, `idGroupe`) VALUES (1,'bob','truc', 'Robert','bob@cold.net',"Quelle est la réponse à la question sur l'univers?",'42',1);
INSERT INTO `membre`(`idMembre`, `aliasMembre`, `nomMembre`, `motDePasse`, `mailMembre`, `questionSecrete`, `reponseQuestion`, `idGroupe`) VALUES (2,'lia','Ella', 'truc', 'lia@cold.net','Quelle est la réponse à la question sur l\'univers?','42',1);

INSERT INTO `groupe`(`idGroupe`, `nomGroupe`) VALUES (1,'membre');
INSERT INTO `groupe`(`idGroupe`, `nomGroupe`) VALUES (2,'oenologue');
INSERT INTO `groupe`(`idGroupe`, `nomGroupe`) VALUES (3,'administrateur');

INSERT INTO `cours`(`idCours`, `titreCours`, `motCleCours`, `urlCours`) VALUES (1,'Le vin','Vin oenologie cepage','url1');
