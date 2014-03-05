/*create database oenline;*/

drop table if exists membre cascade;
drop table if exists groupe cascade;
drop table if exists partie cascade;
drop table if exists vue cascade;
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


create table if not exists membre (
    idMembre integer not null AUTO_INCREMENT,
    aliasMembre varchar(32),
    nomMembre varchar(32),
	motDePasse varchar(32),
    mailMembre varchar(50),
    questionSecrete varchar(100),
    reponseQuestion varchar(32),
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

create table if not exists vue (
	idRobe integer not null AUTO_INCREMENT,
    nomRobe varchar(50),
    typeRobe varchar(32),
    typeDescRobe varchar(50),
	idTypeVin integer not null,
    primary key (idRobe)
);

create table if not exists bouche (
	idBouche integer not null AUTO_INCREMENT,
    nomBouche varchar(50),
    typeBouche varchar(32),
    typeDescBouche varchar(50),
	idTypeVin integer not null,
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
	caracteristiqueCepage varchar (100),
	primary key (idCepage)
);

create table if not exists nez (
	idNez integer not null AUTO_INCREMENT,
	nomNez varchar (32),
	typeNez varchar (32),
	idTypeVin integer not null,
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
	scoreNez integer,
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
	scoreGout integer,
	primary key (idVin,idBouche)
);

create table if not exists aAspect (
	idVin integer not null,
	idRobe integer not null,
	scoreVue integer,
	primary key (idVin,idRobe)
);

create table if not exists constitue (
	idVin  integer not null,
	idCepage integer not null,
	primary key (idVin,idCepage)
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

alter table Vue
add foreign key (IdTypeVin) references TypeVin(IdTypeVin);

alter table Bouche
add foreign key (IdTypeVin) references TypeVin(IdTypeVin);

alter table Nez
add foreign key (IdTypeVin) references TypeVin(IdTypeVin);

alter table Membre
add foreign key (IdGroupe) references Groupe(IdGroupe);

alter table aGout
add foreign key (idVin) references vin(idVin);

alter table aGout
add foreign key (idBouche) references bouche(idBouche);
	
alter table aAspect
add foreign key (idVin) references vin(idVin);

alter table aAspect
add foreign key (idRobe) references vue(idRobe);
	
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
add foreign key (idRobe) references vue(idRobe);
	
alter table sent
add foreign key (idPartie) references vin(idPartie);

alter table sent
add foreign key (idNez) references nez(idNez);