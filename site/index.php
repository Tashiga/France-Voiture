<?php
//--------- CONNEXION BDD
// chez nous
$mysqli = new mysqli("localhost", "root", "", "francevoiture");
//a l'iut 
//$mysqli = new PDO("mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201659", "dutinfopw201659", "vupuqyja");
//si erreur a la connexion
if ($mysqli->connect_error) die('Un problème est survenu lors de la tentative de connexion à la BDD : ' . $mysqli->connect_error);

//encodage de la base de donnée
//$mysqli->set_charset("utf8");

//--------- SESSION
session_start();

//--------- RACINE
// génère une constante qui contient le chemin vers index.php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT.'inc/Fonction_sql.php');
require_once(ROOT.'inc/Controleur.php');
require_once(ROOT.'inc/Initialisation.php');
$init = new Initialisation();



//--------- GESTION PAGES

if(isset($_GET['ctrl'])){
    $controleur = ucfirst($_GET['ctrl']);
    // récupère le fichier controleur correspondant de l'URL
    require_once(ROOT."controleurs/".$controleur.'.php');
    // instance le controleur correspondant
    $controleur = new $controleur();
}
else{
    // sépare les paramètres de l'URL 
    $param = explode('/', $_GET['p']);

    // regarde si un paramètre est passé par l'URL
    if($param[0] != ""){
        $controleur = ucfirst($param[0]);

        require_once(ROOT."controleurs/".$controleur.'.php');
        $controleur = new $controleur();

        // regarde s'il y a un deuxième paramètre
        if(isset($param[1])){
            $action = $param[1];
        }
        // vérifie que la méthode existe dans le controleur
        if(method_exists($controleur, $action)){
            $controleur->$action();
        }
        else{
            http_response_code(404);
            echo "cette action n'existe pas $action";
        }
    }
    else {
        require_once(ROOT."controleurs/Accueil.php");
        $controleur = new Accueil();
        $controleur->accueil();
    }
}