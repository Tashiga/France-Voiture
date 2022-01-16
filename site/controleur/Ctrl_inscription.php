<?php
require_once("../modele/Inscription.php");
require_once("../vue/inscription.php");

if($fonction_sql->utilisateurEstConnecte()){
    header("location:Ctrl_profil.php");
}
else {
    $action = new Inscription();

    //detecte lorsque l'internaute clique sur le bouton pour s'inscrire
    if($_POST) {
        $fonction_sql->debug($_POST);

        $message_erreur = $action->formulaire_valide();
        if($message_erreur != NULL){
            echo $message_erreur;
        }
        else{
            $action->s_inscrire();
        }
    }
}

?>