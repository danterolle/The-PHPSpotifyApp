drop database Homework1;
create database Homework1;
use Homework1;

create table Utente(
Nome varchar (20),
Cognome varchar (20),
Email varchar (30),
Username varchar (30),
Password varchar(50),
primary key(Username)
);

create table Playlist(
ID int NOT NULL AUTO_INCREMENT,
Titolo varchar(30),
User varchar(30),
Url_immagine varchar(200),
index new_user(User),
foreign key (User) references Utente(Username),
primary key(ID,User)
);

create table Contenuto(
IDBrano varchar(100),
IDPlaylist int,
Brano varchar(20),
Artista varchar(30),
Albulm varchar(50),
Url_immagine varchar(200),
index new_IDPlaylist(IDPlaylist),
foreign key (IDplaylist) references Playlist(ID) on update cascade,
primary key(IDBrano,IDPlaylist)
);
