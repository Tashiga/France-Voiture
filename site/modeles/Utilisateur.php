<?php

class Utilisateur extends Fonction_sql{

    function __construct() {
    }


    function email_existe($data){
        $table = $data['table'];
        $resultat = $this->executeRequete("SELECT * FROM $table WHERE email='$data[email]'");
        return $resultat;
    }

    public function creer_compte($data){
        $table = $data['table'];
        $mdpHash = password_hash($data['mdp'], PASSWORD_DEFAULT);
        $this->executeRequete("INSERT INTO $table(nom, email, mdp) VALUES ('$data[nom]', '$data[email]', '$mdpHash')");
    }

    function verif_mdp($data){
        $table = $data['table'];
        $resultat = $this->executeRequete("SELECT mdp FROM $table WHERE email ='$data[email]'");
        $mdpHash = $resultat->fetch_assoc();

        $mdp_correcte = password_verify($data['mdp'], $mdpHash['mdp']);
        return $mdp_correcte;
    }

    function get_panier($id){
        $resultat = $this->executeRequete("SELECT * FROM avoir_panier natural join article where idClient = $id");
        return $resultat;
    }

    function ajouter_panier($data){
        $resultat = $this->executeRequete("SELECT * FROM article WHERE idArticle='$data'");
    }


    function vider_panier($data){
        $resultat = $this->executeRequete("DELETE from avoir_panier where idClient = $data");
    }

    function inserer_infos_commande($data){

        if($this->executeRequete("INSERT INTO commande (montant, numeroRue, nomRue, cp, ville, dateLivraisonPrevu) 
        values('$data[montant]', '$data[num_ad]', '$data[nom_rue]', '$data[cp_ad]', '$data[ville]', 'DATE_ADD( CURDATE(), INTERVAL $data[jour] DAY)')")) {
            $req_commande = $this->executeRequete("SELECT distinct idCommande from commande where cp = '$data[cp_ad]' and dateLivraisonPrevu = DATE_ADD(CURDATE(), INTERVAL '$data[jour] DAY')");
            if($req_commande->num_rows == 1) {
                $this->executeRequete("INSERT INTO valider (idCommande, idClient, dateCommande) values( 
                    (SELECT distinct idCommande from commande where cp = '$data[cp_ad]' and dateLivraisonPrevu = DATE_ADD(CURDATE(), INTERVAL '$data[jour]' DAY)), '$data[id]', curdate())");
            }
        }

    }

}
?>