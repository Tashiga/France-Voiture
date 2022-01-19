<?php

class Message extends Fonction_sql{

    function __construct() {}

    function get_acheteurs(){
        // c'est un acheteur
        if($_SESSION['client']['statut']==0){
            $identifiant =  $_SESSION['client']['idClient'];
            $resultat = $this->executeRequete("select * from client where idClient != $identifiant");
        }
        else {
            $resultat = $this->executeRequete("select * from client");
        }       
        return $resultat;
    }


    function get_vendeurs(){
        // c'est un vendeur
        if($_SESSION['client']['statut']==1){
            $identifiant =  $_SESSION['client']['idVendeur'];
            $resultat = $this->executeRequete("select * from vendeur where idVendeur != $identifiant");
        }
        else {
            $resultat = $this->executeRequete("select * from vendeur");
        }       
        return $resultat;
    }


    function get_conversation($destinataire, $identifiant){
        $resultat = $this->executeRequete("SELECT * from envoyer_un_message where (idDestinateur = $destinataire and idExpediteur = $identifiant) or (idDestinateur = $identifiant and idExpediteur = $destinataire)");
        return $resultat;
    }


    function envoyer_message($data){
        $this->executeRequete("INSERT into envoyer_un_message (idExpediteur, idDestinateur, statutExp, statutDest, message, dateEnvoye, tpsEnvoye)
        values('$data[id]', '$data[id_dest]', '$data[mon_statut]', '$data[statut_dest]', '$data[msg]', '$data[date]', '$data[temps]')");
    }


}