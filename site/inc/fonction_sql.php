<?php
// require_once("haut_site.php");
// require_once("bas_site.php");

class Fonction_sql {
	
	public function  __construct() {}


	//fonction qui permet d'executer les requete sql
	function executeRequete($req){
	    global $mysqli;
	    $resultat = $mysqli->query($req);
	    if(!$resultat) {
			die("Erreur sur la requete sql.<br>Message : " . $mysqli->error . "<br>Code: " . $req);
	    }
	    return $resultat; // 
	}
	 
	//fonction qui permet de faciliter le debug en l'affichant
	function debug($var, $mode = 1){
	    echo '<div style="position:absolute; top:10px; right:15px; background: orange; padding: 5px; float: right; clear: both; ">';
	    $trace = debug_backtrace();
	    $trace = array_shift($trace);
	    echo 'Debug demandé dans le fichier : $trace[file] à la ligne $trace[line].';
	    if($mode === 1) {
		echo '<pre>'; print_r($var); echo '</pre>';
	    }
	    else {
		echo '<pre>'; var_dump($var); echo '</pre>';
	    }
	    echo '</div>';
	}

	function internauteEstConnecte() { 
		if(!isset($_SESSION['client'])) 
			return false;
		else 
			return true;
	}
}
?>