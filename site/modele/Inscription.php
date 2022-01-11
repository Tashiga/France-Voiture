<?php
require_once("../inc/initialisation.php");


class Inscription{
    private $fonction_sql;

    public function __construct() {
        $this->fonction_sql = new Fonction_sql();
    }
    

    public function formulaire_valide(){

        if (empty($_POST['email']) ) {
            $message = "<div class='erreur'>Entrez une adresse email valide.</div>";
            return $message;
        }
        else {
            $table = $_POST['VendeurAcheteur'];
            $membre = $this->fonction_sql->executeRequete("SELECT * FROM $table WHERE email='$_POST[email]'");
            if($membre->num_rows > 0) {
                $message= "<div class='erreur'>Vous avez déjà créé un compte avec cette adresse email.</div>";
                return $message;
            }
        }

        if($_POST['mdp']!=$_POST['confmdp']){
            $message = "<div class='erreur'>Votre mot de passe n'est pas identique à celui que vous avez confirmé.</div>";
            return $message;
        }

        return NULL;
    }


    public function s_inscrire(){
        $table = $_POST['VendeurAcheteur'];
        $mdpHash = md5($_POST['mdp']);
        $this->fonction_sql->executeRequete("INSERT INTO $table(pseudo, email, mdp) VALUES ('$_POST[pseudo]', '$_POST[email]', '$mdpHash')");
    }


}


?>