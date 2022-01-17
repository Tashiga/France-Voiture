<?php
require_once(ROOT."inc/initialisation.php");

class Utilisateur{
    protected $fonction_sql;

    function __construct() {
        $this->fonction_sql = new Fonction_sql();
    }


    function email_existe($data){
        $table = $data['table'];
        $resultat = $this->fonction_sql->executeRequete("SELECT * FROM $table WHERE email='$data[email]'");
        return $resultat;
    }

    public function creer_compte($data){
        $table = $data['table'];
        $mdpHash = password_hash($data['mdp'], PASSWORD_DEFAULT);
        $this->fonction_sql->executeRequete("INSERT INTO $table(nom, email, mdp) VALUES ('$data[nom]', '$data[email]', '$mdpHash')");
    }

    function verif_mdp($data){
        $table = $data['table'];
        $resultat = $this->fonction_sql->executeRequete("SELECT mdp FROM $table WHERE email ='$data[email]'");
        $mdpHash = $resultat->fetch_assoc();

        $mdp_correcte = password_verify($data['mdp'], $mdpHash['mdp']);
        return $mdp_correcte;
    }

}
?>