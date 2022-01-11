<?php
require_once("../modele/Inscription.php");
//require_once("../vue/inscription.php");

if($fonction_sql->utilisateurEstConnecte()){
    header("location:profil.php");
}
else {
    $modele_inscription = new Inscription();

    //detecte lorsque l'internaute clique sur le bouton pour s'inscrire
    if($_POST) {
        $fonction_sql->debug($_POST);

        $message_erreur = $modele_inscription->formulaire_valide();
        if($message_erreur != NULL){
            echo $message_erreur;
        }
        else{
            $modele_inscription->s_inscrire();
            echo "Inscrption réussie";
        }
    }

?>
