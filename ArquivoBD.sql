create database if not exists clinicaVeterinaria; -- Criação do banco

use clinicaVeterinaria; -- Utilizar o banco clinica veterinaria

create table if not exists veterinario(
	codigo int not null auto_increment primary key, 
    nome varchar(250) not null,
    especialidade varchar(100) not null,
    salario decimal(10,2) not null,
    endereco varchar(300) not null,
    telefone varchar(20) not null
)engine = InnoDB; -- Construção do banco em tabelas

create table if not exists tutor(
    codigo int not null auto_increment primary key,
    nome varchar(250) not null,
    cpf varchar(14) not null,
    telefone varchar(20) not null,
    email varchar(150) not null,
    endereco varchar(300) not null
)engine = InnoDB;

create table if not exists animal(
    codigo int not null auto_increment primary key,
    nome varchar(150) not null,
    especie varchar(50) not null,
    raca varchar(50) not null,
    idade int not null,
    codigoTutor int not null,
    foreign key (codigoTutor) references tutor(codigo)
)engine = InnoDB;


select * from veterinario;-- Visualizar os dados do banco