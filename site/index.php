<?php
// génère une constante qui contient le chemin vers index.php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));


require_once(ROOT.'inc/Database.php');
require_once(ROOT.'inc/Controleur.php');

// sépare les paramètres de l'URL 
$param = explode('/', $_GET['p']);

// regarde si un paramètre est passé par l'URL
if($param[0] != ""){
    $controleur = ucfirst($param[0]);

    // regarde s'il y a un deuxième paramètre si non, indique 'accueil'
    $action = isset($param[1]) ? $param[1]: 'accueil';

    // récupère le fichier controleur correspondant de l'URL
    require_once(ROOT."controleurs/".$controleur.'.php');

    // instance le controleur correspondant
    $controleur = new $controleur();

    // vérifie que la méthode existe dans le controleur
    if(method_exists($controleur, $action)){
        $controleur->$action();
    }
    else{
        http_response_code(404);
        echo "cette action n'existe pas";
    }
}
else {
    require_once(ROOT."controleurs/Accueil.php");
    $controleur = new Accueil();
    $controleur->accueil();
}