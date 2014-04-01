-- a propos de la création de la base de données, de la table et de l'insertion des éléments dans la table

-- 1- il faut aller dans PhpMyAdmin et créer une base de données

-- 2- pour créer cette table, on peut la faire manuellement dans PhpMyAdmin ou bien copier puis coller ce qui suit dans la section SQL 

DROP TABLE IF EXISTS COURS CASCADE;
CREATE TABLE COURS ( 
	idCours INT (11) NOT NULL AUTO_INCREMENT,
	titreCours VARCHAR(50),
    motCleCours VARCHAR(32),
    urlCours VARCHAR(100),
	PRIMARY KEY (idCours)
    );

INSERT INTO COURS VALUES ('','degustation','degustation','Cours/cours01.html');
INSERT INTO COURS VALUES ('','cepage','cepage','Cours/cours02.html');
INSERT INTO COURS VALUES ('','appellation','appellation','Cours/cours03.html');

COMMIT;
