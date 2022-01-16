<?php

//--------- BDD

// chez nous
$mysqli = new mysqli("localhost", "root", "", "francevoiture");
// sur mon wamp c'est le nom que j'ai donné à ma base mettez celui que vous avez donné vous
$mysqli->select_db("francevoiture");

//a l'iut 
//$mysqli = new PDO("mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201659", "dutinfopw201659", "vupuqyja");
//si erreur a la connexion
if ($mysqli->connect_error) die('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $mysqli->connect_error);

//encodage de la base de donnée
//$mysqli->set_charset("utf8");
 

//--------- SESSION
session_start();
 

//--------- CHEMIN ABSOLU
//define("RACINE_SITE","/../mmsssiiieeeuuu");
 

//--------- VARIABLES
$contenu = '';
 

//--------- AUTRES INCLUSIONS
include_once("fonction_sql.php");
$fonction_sql = new Fonction_sql();
?>