<?php
require_once(ROOT."modeles/Utilisateur.php");
require_once(ROOT."vues/Vue_profil.php");


class Profil extends Controleur {
    private $modele;
    private $vue;
    private $fonction_sql;

    function __construct(){
        $this->modele = new Utilisateur();
        $this->vue = new Vue_profil();
        $this->fonction_sql = new Fonction_sql();
    }

    function informations(){
        $infos = [
            'nom' => $_SESSION['client']['nom'],
            'email' => $_SESSION['client']['email']
        ];
        $this->vue->afficherInformations($infos);
    }

    function discussions(){
        $infos = [
        ];
        $this->vue->afficherDiscussions($infos);  
    }

    function notes(){
        $infos = [
        ];
        $this->vue->afficherNotesClient($infos);  
    }

    function articles(){
        $this->vue->afficherActionArticle();  
    }


    function commandes(){

        if($_SESSION['client']['statut']==0)
        {
            $infos = [
            ];
            $this->vue->afficherCommandesClient($infos);  
        }
        else {
            $infos = [
            ];
            $this->vue->afficherCommandesVendeur($infos);  
        }
        
    }


}