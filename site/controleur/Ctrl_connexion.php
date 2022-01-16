<?php
require_once("../modele/Connexion.php");
require_once("../vue/connexion.php");


$modele = new Connexion();
if(ISSET($_POST['vendeur'])) {
    $table = 'vendeur';
}
else {
    $table = 'acheteur';
}

//si l'user est deja connecte
if($fonction_sql->utilisateurEstConnecte()) {
    header("location:Ctrl_profil.php");

    //si l'user veut se deconnecter
    if(isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
        session_start();

        session_destroy();
        header("location:Ctrl_connexion.php");
    }
}

else {
    
    //lorsque user clique sur connexion pour se connecter
    if($_POST) {
        $fonction_sql->debug($_POST);
        
        if($modele->email_existe($table)->num_rows != 0){
            if($modele->verif_mdp($table) == true) {

                $resultat = $modele->email_existe($table);
                $client = $resultat->fetch_assoc();
                foreach($client as $indice => $element) {
                    if($indice != 'mdp') {
                        $_SESSION['client'][$indice] = $element;
                    }
                }
                //ajouter dans session un attribut statut
                if($table=='vendeur') {
                    $_SESSION['client']['statut'] = 1;
                }
                else {
                    $_SESSION['client']['statut'] = 0;
                }
                //diriger vers la page profil
                header("location:Contr_profil.php");
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


