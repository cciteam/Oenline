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
