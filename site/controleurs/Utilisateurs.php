<?php
require_once(ROOT."modeles/Utilisateur.php");


class Utilisateurs extends Controleur {
    private $modele;
    private $fonction_sql;

    function __construct(){
        $this->modele = new Utilisateur();
        $this->fonction_sql = new Fonction_sql();
    }

    function connexion(){
        $this->render("connexion");

        if($_POST) {
            $this->fonction_sql->debug($_POST);

            if(ISSET($_POST['vendeur'])) {
                $table = 'vendeur';
            }
            else {
                $table = 'acheteur';
            }

            $data = [
                'email' => $_POST['email'],
                'mdp' => $_POST['password'],
                'table' => $table
            ];
            
            if($this->modele->email_existe($data)->num_rows != 0){
                if($this->modele->verif_mdp($data) == true) {

                    $this->nouvelle_session($data);

                    //diriger vers la page profil
                    header("location:../profil/informations");
                }
                else {
                    $message = "<div class='erreur'>Erreur : Le mot de passe n'est pas ". $_POST['password'] ."</div>";
                }
            }
            else {
                $message = "<div class='erreur'> Erreur : Pas de compte $table à cette adresse email</div>";
            }
            echo $message;
        }
    }


    function nouvelle_session($data){
        $resultat = $this->modele->email_existe($data);
        $client = $resultat->fetch_assoc();
        foreach($client as $indice => $element) {
            if($indice != 'mdp') {
                $_SESSION['client'][$indice] = $element;
            }
        }
        //ajouter dans session un attribut statut
        if($data['table'] =='vendeur') {
            $_SESSION['client']['statut'] = 1;
        }
        else {
            $_SESSION['client']['statut'] = 0;
        }
    }


    function inscription(){
        $this->render("inscription");

        if($_POST) {
            $this->fonction_sql->debug($_POST);

            $data = [
                'nom' => $_POST['nom'],
                'email' => $_POST['email'],
                'mdp' => $_POST['mdp'],
                'table' => $_POST['VendeurAcheteur']
            ];

            //Vérifie si le formulaire est correct
            if(empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['mdp']) || 
            empty($_POST['confmdp'])){
                $message = "<div class='erreur'>Veuillez remplir tous les champs.</div>";
            }
            else if(strlen($_POST['mdp']) < 6){
                $message = "<div class='erreur'>Veuillez choisir un mot de passe plus long.</div>";
            } 
            else if($_POST['mdp'] != $_POST['confmdp']){
                $message = "<div class='erreur'>Vos deux mots de passe ne sont pas identiques.</div>";
            }
            else if($this->modele->email_existe($data)->num_rows > 0){
                $message = "<div class='erreur'>Vous avez déjà créé un compte avec cette adresse email.</div>";
            }
            else {

                $this->modele->creer_compte($data);

                $message = "<div class='validation'>Inscription réussie pour ".$_POST['VendeurAcheteur']."</div>";
            }
            echo $message;
        }
    }


    function deconnexion(){
        session_destroy();
        $redirect = '<a href="../">Cliquer ici pour retourner à l\'accueil</a>'; 
        echo "vous êtes déconnecté $redirect";
    }

}