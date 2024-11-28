
drop table if exists artistas_contenidos;

drop table if exists artistas;

drop table if exists contenidos;


create table if not exists contenidos

(

    ide_con int not null auto_increment primary key, -- identificador contenido

    tit_con varchar(100) -- titulo contenito

);

create table if not exists artistas

(

    ide_art int not null auto_increment primary key, -- identificador artista

    non_art varchar(100) -- nombre artista

);

create table if not exists artistas_contenidos

(

    ide_arc int not null auto_increment primary key, -- identificador artista contenido

    ide_art int not null, -- identificador artista

    ide_con int not null, -- identificador contenido 

    foreign key (ide_art) references artistas(ide_art),

    foreign key (ide_con) references contenidos(ide_con)

);