<?php
/**	config.php est inclus sur toutes les pages du site **/
session_start();
//Pour afficher les jours et mois en français
setlocale(LC_TIME, 'fr-FR.UTF8', 'fra');
//Pour l'heure locale
date_default_timezone_set('Europe/Paris');

/** Les constantes **/
define("SITE_NOM", "GestionStagiaire");
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PWD", "");
define("DB_BDD", "dbguinot");
//Les champs des tables sont préfixés par les X premiers caracteres du nom de la table. Généralement X=3
define("DB_PREFIXE_LENGTH", 3);
//chargement des classes de base du framework
require "../framework/fonction.php";
require "../framework/Table.class.php";
require "../framework/Ctr_controleur.class.php";

//auto chargement des classes (monAutoload est définie dans _lib/fonction.php)
spl_autoload_register('monAutoLoad');

//connexion à la base de données
try {
    $link = new PDO("mysql:host=" . DB_SERVER . ";port=3306;dbname=" . DB_BDD, DB_USER, DB_PWD);
    $link->exec("SET CHARACTER SET UTF8");
    //Définit le mode de la méthode fetch par défaut
    $link->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //déclenche une exception en cas d'erreur : stop l'éxécution
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    Table::setLink($link);
} catch (Exception $e) {
    var_dump($e);
}
