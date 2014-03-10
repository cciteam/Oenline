/*create database oenline;*/

drop table if exists membre cascade;
drop table if exists groupe cascade;
drop table if exists partie cascade;
drop table if exists robe cascade;
drop table if exists bouche cascade;
drop table if exists vin cascade;
drop table if exists domaine cascade;
drop table if exists appellation cascade;
drop table if exists cepage cascade;
drop table if exists typeVin cascade;
drop table if exists cours cascade;
drop table if exists nez cascade;
drop table if exists sent cascade;
drop table if exists aOdeur cascade;
drop table if exists voit cascade;
drop table if exists goute cascade;
drop table if exists aGout cascade;
drop table if exists aAspect cascade;
drop table if exists constitue cascade;
drop table if exists boucheTypeVin cascade;
drop table if exists robeTypeVin cascade;
drop table if exists nezTypeVin cascade;

drop view if exists scoreRT;
drop view if exists scoreR;
drop view if exists scoreB;
drop view if exists scoreN;
drop view if exists scoreBT;
drop view if exists scoreNT;


create table if not exists membre (
    idMembre integer not null AUTO_INCREMENT,
    pseudoMembre varchar(32),
    nomMembre varchar(32),
	motDePasse varchar(32),
    mailMembre varchar(50),
	idGroupe integer not null,
    primary key (idMembre)
);

create table if not exists groupe (
	idGroupe integer not null AUTO_INCREMENT,
	nomGroupe varchar (32),
	primary key (idGroupe)
);

create table if not exists partie (
    idPartie integer not null AUTO_INCREMENT,
    datePartie datetime,
    scorePartie integer,
	commentairePartie varchar (500),
	idMembre integer not null,
	idVin integer not null,
    primary key (idPartie)
);

create table if not exists robe (
	idRobe integer not null AUTO_INCREMENT,
    nomRobe varchar(50),
    typeRobe varchar(32),
    typeDescRobe varchar(50),
	scoreRobe integer,
    primary key (idRobe)
);

create table if not exists bouche (
	idBouche integer not null AUTO_INCREMENT,
    nomBouche varchar(50),
    typeBouche varchar(32),
    typeDescBouche varchar(50),
	scoreBouche integer,
    primary key (idBouche)
);

create table if not exists vin (
	idVin integer not null AUTO_INCREMENT,
	nomVin varchar(32),
	descCourte varchar(200),
	descLongue varchar(500),
	millesime integer,
	idDomaine integer not null,
	idAppellation integer not null,
	idTypeVin integer not null,
	primary key (idVin)
);

create table if not exists domaine (
	idDomaine integer not null AUTO_INCREMENT,
	nomDomaine varchar (50),
	urlDomaine varchar(50),
	primary key (idDomaine)
);

create table if not exists appellation (
	idAppellation integer not null AUTO_INCREMENT,
	nomAppellation varchar (32),
	primary key (idAppellation)
);

create table if not exists cepage (
	idCepage integer not null AUTO_INCREMENT,
	nomCepage varchar (32),
	primary key (idCepage)
);

create table if not exists nez (
	idNez integer not null AUTO_INCREMENT,
	nomNez varchar (32),
	typeNez varchar (32),
	scoreNez integer,
	primary key (idNez)
);

create table if not exists typeVin (
	idTypeVin integer not null AUTO_INCREMENT,
	nomTypeVin varchar (32),
	primary key (idTypeVin)
);

create table if not exists cours (
	idCours integer not null AUTO_INCREMENT,
	titreCours varchar (50),
	motCleCours varchar (32),
	urlCours varchar (100),
	primary key (idCours)
);


create table if not exists sent (
	idPartie integer not null,
	idNez integer not null,
	primary key (idPartie,idNez)
);

create table if not exists aOdeur (
	idVin integer not null,
	idNez integer not null,
	primary key (idVin,idNez)
);


create table if not exists voit (
	idPartie integer not null,
	idRobe integer not null,
	primary key (idPartie,idRobe)
);

create table if not exists goute (
	idPartie integer not null,
	idBouche integer not null,
	primary key (idPartie,idBouche)
);

create table if not exists aGout (
	idVin integer not null,
	idBouche integer not null,
	primary key (idVin,idBouche)
);

create table if not exists aAspect (
	idVin integer not null,
	idRobe integer not null,
	primary key (idVin,idRobe)
);

create table if not exists constitue (
	idVin  integer not null,
	idCepage integer not null,
	primary key (idVin,idCepage)
);

create table if not exists boucheTypeVin (
    idTypeVin integer not null,
    idBouche integer not null,
    primary key (idTypeVin, idBouche)
);

create table if not exists robeTypeVin (
    idTypeVin integer not null,
    idRobe integer not null,
    primary key (idTypeVin, idRobe)
);

create table if not exists nezTypeVin (
    idTypeVin integer not null,
    idNez integer not null,
    primary key (idTypeVin, idNez)
);

alter table Vin
add foreign key (idDomaine) references domaine(idDomaine);

alter table Vin
add foreign key (idAppellation) references appellation(idAppellation);

alter table Vin
add foreign key (idTypeVin) references typeVin(idTypeVin);

alter table Partie
add foreign key (IdVin) references Vin(IdVin);

alter table Partie
add foreign key (IdMembre) references Membre(IdMembre);

alter table Membre
add foreign key (IdGroupe) references groupe(IdGroupe);

alter table aGout
add foreign key (idVin) references vin(idVin);

alter table aGout
add foreign key (idBouche) references bouche(idBouche);
	
alter table aAspect
add foreign key (idVin) references vin(idVin);

alter table aAspect
add foreign key (idRobe) references robe(idRobe);
	
alter table aOdeur
add foreign key (idVin) references vin(idVin);

alter table aOdeur
add foreign key (idNez) references nez(idNez);
	
alter table goute
add foreign key (idPartie) references partie(idPartie);

alter table goute
add foreign key (idBouche) references bouche(idBouche);
	
alter table voit
add foreign key (idPartie) references partie(idPartie);

alter table voit
add foreign key (idRobe) references robe(idRobe);
	
alter table sent
add foreign key (idPartie) references vin(idPartie);

alter table sent
add foreign key (idNez) references nez(idNez);

alter table boucheTypeVin
add foreign key (idTypeVin) references typeVin(idTypeVin);

alter table boucheTypeVin
add foreign key (idBouche) references bouche(idBouche);

alter table nezTypeVin
add foreign key (idTypeVin) references typeVin(idTypeVin);

alter table nezTypeVin
add foreign key (idNez) references nez(idNez);

alter table robeTypeVin
add foreign key (idTypeVin) references typeVin(idTypeVin);

alter table robeTypeVin
add foreign key (idRobe) references robe(idRobe);

create view scoreNT as (select idPartie, sum(scoreNez) scoreNzT
                       from partie natural join vin natural join aodeur natural join nez
					   group by idPartie);
					   

create view scoreBT as (select idPartie, sum(scoreBouche) scoreBcT
                       from partie natural join vin natural join aGout natural join bouche
					   group by idPartie);
					   

create view scoreRT as (select idPartie, sum(scoreRobe) scoreRbT
                       from partie natural join vin natural join aaspect natural join robe
					   group by idPartie);
					   

create view scoreN as (select idPartie, sum(scoreNez) scoreNz
                       from partie natural join vin natural join aodeur natural join nez natural join sent
					   group by idPartie);
					   
					   

create view scoreB as (select idPartie, sum(scoreBouche) scoreBc
                       from partie natural join vin natural join agout natural join bouche natural join goute
					   group by idPartie);
					   

create view scoreR as (select idPartie, sum(scoreRobe) scoreRb
                       from partie natural join vin natural join aaspect natural join robe natural join voit
					   group by idPartie);