<?php

//--------- BDD
//$mysqli = new mysqli("localhost", "nomUtilisateur", "motDePasse", "site");
//a l'iut 
//$mysqli = new PDO("mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201659", "dutinfopw201659", "vupuqyja");
//si erreur a la connexion
//if ($mysqli->connect_error) die('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $mysqli->connect_error);

//encodage de la base de donnée
//$mysqli->set_charset("utf8");
 

//--------- SESSION
session_start();
 

//--------- CHEMIN ABSOLU
define("RACINE_SITE","/../mmsssiiieeeuuu");
 

//--------- VARIABLES
$contenu = '';
 

//--------- AUTRES INCLUSIONS
// require_once("function.php");