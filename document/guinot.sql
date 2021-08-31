--
-- Base de données: 'guinot'
--
create database if not exists dbguinot default character set utf8 collate utf8_general_ci;
use dbguinot;
-- --------------------------------------------------------
-- Création des tables

-- Table stagiaire
drop table if exists stagiaire;
create table stagiaire (
    sta_id int not null auto_increment primary key,
    sta_nom varchar(2000),
    sta_prenom varchar(2000),
    sta_adresse varchar(2000),
    sta_ville varchar(2000),
    sta_code int,
    sta_promotion varchar(2000)	
)engine=innodb;

