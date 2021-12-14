drop database if exists bdweb;

create database bdweb;

use bdweb;

create table facultad(
    id_facultad int(3) unsigned not null,
    nombre_facultad varchar(50) not null,
    primary key(id_facultad)
) character set utf8;

create table carrera(
    id_carrera int(3) unsigned not null,
    nombre_carrera varchar(50) not null,
    id_facultad int(3) unsigned not null,
    id_plan int(5) unsigned not null,
    primary key(id_carrera, id_plan),
    foreign key(id_facultad) references facultad(id_facultad)
) character set utf8;

create table materia(
    id_materia int(5) unsigned not null,
    nombre_materia varchar(50) not null,
    id_carrera int(3) unsigned not null,
    id_plan int(5) unsigned not null,
    primary key(id_materia),
    foreign key(id_carrera, id_plan) references carrera(id_carrera, id_plan)
) character set utf8;

create table hora_materia(
    id_horario int(5) unsigned auto_increment,
    id_materia int(5) unsigned not null,
    hora_inicio_1 time not null,
    hora_fin_1 time not null,
    hora_inicio_2 time not null,
    hora_fin_2 time not null,
    hora_inicio_3 time not null,
    hora_fin_3 time not null,
    hora_inicio_4 time not null,
    hora_fin_4 time not null,
    hora_inicio_5 time not null,
    hora_fin_5 time not null,
    hora_inicio_6 time not null,
    hora_fin_6 time not null,
    primary key(id_horario),
    foreign key(id_materia) references materia(id_materia)
) character set utf8;

create table estudiante(
    matricula int(10) unsigned not null,
    nombre varchar(30) not null,
    apellido_p varchar(20) not null,
    apellido_m varchar(20) not null,
    semestre int(2) unsigned not null,
    edad int(2) unsigned not null,
    sexo varchar(1) not null,
    id_facultad int(3) unsigned not null,
    id_carrera int(3) unsigned not null,
    primary key(matricula),
    foreign key (id_facultad) references facultad(id_facultad),
    foreign key (id_carrera) references carrera(id_carrera)
) character set utf8;
-- M para mujer, H para hombre

create table horario(
    id int(5) auto_increment,
    id_horario int(5) unsigned,
    matricula int(5) unsigned not null,
    primary key(id),
    foreign key(matricula) references estudiante(matricula),
    foreign key(id_horario) references hora_materia(id_horario)
) character set utf8;

create table usuario(
    matricula int(10) unsigned not null,
    nombre_usuario varchar(50) not null,
    password varchar(12) not null,
    tipo_usuario int(1) unsigned,
    primary key(matricula),
    foreign key(matricula) references estudiante(matricula)
) character set utf8;
-- tipo 1 solo asesor, tipo 2 asesorado y asesor

create table solicitud(
    id_solic int(5) unsigned auto_increment,
    mat_asdo int(10) unsigned not null,
    mat_asr int(10) unsigned not null,
    id_materia int(5) unsigned not null,
    estado int(1) not null,
    fecha date not null,
    hora_inicio time not null,
    hora_fin time not null,
    duracion time not null,
    lugar varchar(50) not null,
    msg varchar(100),
    primary key(id_solic),
    foreign key(mat_asdo) references usuario(matricula),
    foreign key(mat_asr) references usuario(matricula),
    foreign key(id_materia) references materia(id_materia)
) character set utf8;
-- estado 0 en proceso, 1 aprovada, 2 rechazada, 3 completada, 4 cancelada

create table mensaje(
    id_msg int(10) unsigned auto_increment,
    mat_origen int(10) unsigned not null,
    mat_dest int(10) unsigned not null,
    msg varchar(300),
    estado boolean default false,
    tipo boolean default true,
    primary key(id_msg),
    foreign key(mat_origen) references usuario(matricula),
    foreign key(mat_dest) references usuario(matricula)   
) character set utf8;
-- estado false no leido, true leido; tipo false publico, true privado

create table notificaion(
    mat_dest int(10) unsigned not null,
    msg varchar(100),
    estado int(1) unsigned,
    primary key(mat_dest),
    foreign key(mat_dest) references usuario(matricula)
) character set utf8;

create table user_profile(
    matricula int(10) unsigned not null,
    ruta varchar(100) not null,
    primary key(matricula),
    foreign key(matricula) references usuario(matricula)
);

create table asesoria(
    matricula int(10) unsigned not null,
    nombre varchar(30) not null,
    id_materia int(5) unsigned not null,
    materia varchar(50) not null,
    estado boolean default true,
    primary key(matricula, id_materia),
    foreign key(matricula) references estudiante(matricula),
    foreign key(id_materia) references materia(id_materia)
);
-- estado false inactivo, true activo

create table hora_reservada(
    id int unsigned auto_increment,
    matricula int(10) unsigned not null,
    hora int(2) unsigned not null,
    dia int(1) unsigned not null,
    primary key(id),
    foreign key(matricula) references estudiante(matricula)
);

insert into facultad(id_facultad, nombre_facultad) values
(101, 'facultad de artes'),
(102, 'facultad de medicina'),
(103, 'facultad de ingenieria');

insert into carrera(id_carrera, nombre_carrera, id_facultad, id_plan) values
(121, 'licenciatura en artes plasticas', 101, 20122),
(122, 'licenciatura en artes visuales', 101, 20151),
(123, 'licenciatura en diseño grafico', 101, 20131),
(221, 'licenciatura en medicina', 102, 20112),
(222, 'licenciatura en farmacia', 102, 20112),
(223, 'licenciatura en enfermeria', 102, 20132),
(321, 'ingenieria en electronica', 103, 20192),
(322, 'ingenieria en computacion', 103, 20092),
(323, 'ingenieria mecanica', 103, 20092);

insert into materia(id_materia, nombre_materia, id_carrera, id_plan) values
(12158, 'historia del arte', 121, 20122),
(12343, 'construccion audiovisual', 122, 20151),
(12425, 'dibujo tecnico', 123, 20131),
(13531, 'anatomia I', 221, 20112),
(13721, 'bioquimica', 222, 20112),
(13814, 'enfermeria farmacologica aplicada', 223, 20132),
(14521, 'circuitos digitales', 321, 20192),
(14632, 'arquitectura de computadoras', 322, 20092),
(14701, 'mecanica aplicada 2', 323, 20092);

insert into hora_materia(id_materia, hora_inicio_1, hora_fin_1, hora_inicio_2, hora_fin_2, hora_inicio_3, hora_fin_3,  hora_inicio_4, hora_fin_4, hora_inicio_5, hora_fin_5, hora_inicio_6, hora_fin_6) values
(13721, 100000, 110000, 100000, 110000, 100000, 110000, 0, 0, 0, 0, 0, 0),
(14701, 0, 0, 130000, 150000, 130000, 140000, 0, 0, 130000, 150000, 0, 0),
(14632, 0, 0, 130000, 150000, 130000, 140000, 0, 0, 130000, 150000, 0, 0),
(14521, 110000, 130000, 0, 0, 100000, 120000, 0, 0, 110000, 120000, 0, 0);

insert into estudiante(matricula, nombre, apellido_p, apellido_m, semestre, edad, sexo, id_facultad, id_carrera) values
(1244809, 'ISAAC', 'HERNANDEZ', 'CANO', 8, 23, 'H', 103, 322),
(1249508, 'GILBERTO', 'MALDONADO', 'MIGUEL', 5, 23, 'H', 103, 322),
(1244219, 'FRANCISCO JAVIER', 'APODACA', 'MONTOYA', 7, 23, 'H', 102, 221),
(8350175, 'ARIANA', 'FLORES', 'GASTELUM', 6, 22, 'M', 103, 323);

insert into horario(id_horario, matricula) values
(3, 1244809),
(2, 8350175),
(4, 1249508),
(3, 1249508),
(1, 1244219);

insert into usuario(matricula, nombre_usuario, password, tipo_usuario) values
(1244809, 'isaac.cano', '12345', 2),
(1249508, 'maldo', 'asd', 1),
(8350175, 'arianita', '12345', 2),
(1244219, 'happy', 12345, 1);

insert into user_profile(matricula, ruta) values
(1244809, '../img/user_profile/male.png'),
(8350175, '../img/user_profile/female.png'),
(1244219, '../img/user_profile/male.png'),
(1249508, '../img/user_profile/male.png');

insert into asesoria(matricula, nombre, id_materia, materia, estado) values
(1244809, (select concat(estudiante.nombre, " ", estudiante.apellido_p, " ", estudiante.apellido_m) as nombre 
from estudiante where matricula = 1244809) , 14521, (select nombre_materia from materia where id_materia = 14521), true),
(1244809, (select concat(estudiante.nombre, " ", estudiante.apellido_p, " ", estudiante.apellido_m) as nombre 
from estudiante where matricula = 1244809) , 14701, (select nombre_materia from materia where id_materia = 14701), true),
(8350175, (select concat(estudiante.nombre, " ", estudiante.apellido_p, " ", estudiante.apellido_m) as nombre 
from estudiante where matricula = 8350175) , 14701, (select nombre_materia from materia where id_materia = 14701), true);
