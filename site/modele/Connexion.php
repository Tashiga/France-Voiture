<?php 
require_once("../inc/initialisation.php");

class Connexion{
    private $fonction_sql;
    function __construct(){
        $this->fonction_sql = new fonction_sql();
    }


    function email_existe($table){

        $resultat = $this->fonction_sql->executeRequete("SELECT * FROM $table WHERE email='$_POST[email]'");
        return $resultat;
    }

    function verif_mdp($table){
        
        $resultat = $this->fonction_sql->executeRequete("SELECT mdp FROM $table WHERE email ='$_POST[email]'");
        $mdpHash = $resultat->fetch_assoc();

        $mdp_correcte = password_verify($_POST['password'], $mdpHash['mdp']);
        return $mdp_correcte;
    }
        

}
?>