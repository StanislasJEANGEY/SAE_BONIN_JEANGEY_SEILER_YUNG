create table favorite (
   iduser integer(11) not null,
   idserie integer(11) not null,
   

   CONSTRAINT favorite_PK primary key(idSerie, iduser),
   CONSTRAINT favorite_iduser_FK foreign key (iduser) REFERENCES Utilisateur(id),
   CONSTRAINT favorite_idserie_FK foreign key (idSerie) REFERENCES serie(idSerie)
);

create table current (
    iduser integer(11) not null,
    idserie integer(11) not null,
    id integer(11) not null,

   CONSTRAINT current_PK primary key(idSerie, idUser,id),
   CONSTRAINT current_iduser_FK foreign key (iduser) REFERENCES Utilisateur(id),
   CONSTRAINT current_idserie_FK foreign key (idSerie) REFERENCES serie(idSerie)
);

create table commentaire (
   iduser integer(11) not null,
   idserie integer(11) not null,
   note integer(1),
   commentaire varchar(400),
   CONSTRAINT commentaire_PK primary key(idSerie, iduser),
   CONSTRAINT commentaire_iduser_FK foreign key (iduser) REFERENCES Utilisateur(id),
   CONSTRAINT commentaire_idserie_FK foreign key (idSerie) REFERENCES serie(idSerie)
);

ALTER TABLE utilisateur ADD nom VARCHAR(20);
ALTER TABLE utilisateur ADD prenom VARCHAR(20);
ALTER TABLE utilisateur ADD genrePref VARCHAR(20);