create database conta;
use conta;

create table tipo_cuenta(
id_tipo_cuenta int primary key auto_increment,
nombre_tipo_cuenta varchar(20)not null
);

insert into tipo_cuenta(nombre_tipo_cuenta) values ('Activo');
insert into tipo_cuenta(nombre_tipo_cuenta) values ('Pasivo');
insert into tipo_cuenta(nombre_tipo_cuenta) values ('Capital');

create table cuenta(
codigo_mayor int primary key unique,
nombre_cuenta varchar(60) not null,
descripcion varchar(75),
tipo_cuenta int,
foreign key(tipo_cuenta) references tipo_cuenta(id_tipo_cuenta) on delete set null,
er int
);

create table libro_diario(
id_movimiento int primary key auto_increment unique,
dia int not null,
mes int not null,
ano int not null,
partida int not null,
descripcion varchar(100)
);

create table detalle_libro_diario(
id_movimiento int not null,
cuenta int not null,
deber decimal(12,2),
haber decimal(12,2),
foreign key(id_movimiento) references libro_diario(id_movimiento) on delete cascade,
foreign key(cuenta) references cuenta(codigo_mayor) on delete cascade
);
