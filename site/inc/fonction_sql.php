<?php
class Fonction_sql{
	/*
    // infos BD
    private $dns = "mysql:host=localhost;dbname=FranceVoiture;";
    private $user = "root";
    private $password = "";

    // connexion à la BD
    protected $_connexion;

    function connexion_bd(){
        $this->_connexion = null;

        try{
            $this->_connexion = new PDO($this->dns, $this->user, $this->password);
            // sécuriser les transactions entre le client et le server
            $this->_connexion->exec('set names utf8');
        }
        catch(PDOException $e){
            echo 'Un problème est survenu lors de la tentative de connexion à la BDD :'.$e->getMessage();
        }
    }
	*/


    //fonction qui permet d'executer les requete sql
	function executeRequete($req) {
	    global $mysqli;
	    $resultat = $mysqli->query($req);
	    if(!$resultat) {
			die("Erreur sur la requete sql.<br>Message : " . $mysqli->error . "<br>Code: " . $req);
	    }
	    return $resultat; 
	}
	 
	//fonction qui permet de faciliter le debug en l'affichant
	function debug($var, $mode = 1) {
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

}