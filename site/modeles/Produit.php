<?php
require_once(ROOT."inc/initialisation.php");

class Produit{
    private $fonction_sql;

    function __construct() {
        $this->fonction_sql = new Fonction_sql();
    }


    function ajouter_produit($data){
        
        $this->fonction_sql->executeRequete("INSERT INTO article (nom, prix, description, nbStock, dateCreation, categorie) 
            values ('$data[nom_article]', '$data[prix_article]', '$data[description_article]', '$data[stock_article]', curdate() ,  '$data[categorie_article]')");
                
    }


    function ajouter_photo($dossier, $fichier, $data){
        $this->fonction_sql->executeRequete("INSERT INTO ajouter (idArticle, idvendeur) values((SELECT idArticle FROM article WHERE nom = '$data[nom_article]'), $data[idVendeur])");
        $this->fonction_sql->executeRequete("INSERT INTO photo (cheminPhoto,description) values('$dossier$fichier', '' )");
        $this->fonction_sql->executeRequete("INSERT INTO affiche(idPhoto, idArticle) values((select idPhoto from photo where cheminPhoto = '$dossier$fichier'), (SELECT idArticle FROM article WHERE nom = '$data[nom_article]'))");
    }

    function get_produits(){
        $id = $_SESSION['client']['idVendeur'];
        $mesArticles= $this->fonction_sql->executeRequete("SELECT idArticle FROM ajouter WHERE idvendeur = '$id'");
        $resultat = $this->fonction_sql->executeRequete("SELECT * FROM article natural join ajouter where idvendeur = '$id'");
        return $resultat;
    }


    function get_photo($id_article){
        $resultat = $this->fonction_sql->executeRequete("SELECT cheminPhoto FROM photo NATURAL JOIN affiche WHERE idArticle = '$id_article'");
        return $resultat;
    }


    function supprimer_produit($id_article){
        
        
        $resultat = $this->fonction_sql->executeRequete("SELECT * FROM article WHERE idArticle=$id_article");
        //Recupere l'id du photo
        $produit_a_supprimer = $this->fonction_sql->executeRequete("SELECT * FROM affiche WHERE idArticle =$id_article");
        if ($produit_a_supprimer -> num_rows == 0){
            $this->fonction_sql->executeRequete("DELETE FROM ajouter WHERE idArticle=$id_article");
            $this->fonction_sql->executeRequete("DELETE FROM article WHERE idArticle=$id_article"); 
        }
        else {
            while($autres = $produit_a_supprimer->fetch_assoc()) {
                //supprime l'affichage
                $this->fonction_sql->executeRequete("DELETE FROM affiche WHERE idArticle =$id_article");
                $chemin_photo_a_supprimer = $this->fonction_sql->executeRequete("SELECT * FROM photo WHERE idPhoto='".$autres['idPhoto']."'");
                $autres = $chemin_photo_a_supprimer->fetch_assoc();
                if(!empty($autre['idArticle']) && file_exists($autres['cheminPhoto'])) {
                    unlink($autres['cheminPhoto']);
                }

                $this->fonction_sql->executeRequete("DELETE FROM photo WHERE idPhoto='".$autres['idPhoto']."'");
                $this->fonction_sql->executeRequete("DELETE FROM ajouter WHERE idArticle=$id_article");
                $this->fonction_sql->executeRequete("DELETE FROM article WHERE idArticle=$id_article"); 
            }
        }
    }


    function modifier_produit_nom($id_article, $data){
        $this->fonction_sql->executeRequete("update article set nom = '$data[nom_article]' where idArticle = $id_article");
        $cheminPhoto = $this->fonction_sql->executeRequete("SELECT cheminPhoto from photo where idPhoto = (SELECT idPhoto from affiche where idArticle = $id_article) ");
        $cheminPhoto = $cheminPhoto->fetch_assoc();
        $extension_photo =  substr($cheminPhoto['cheminPhoto'], -4);
        $newChemin = ROOT."photos_articles/$data[nom_article]$extension_photo";
        if(rename($cheminPhoto['cheminPhoto'], $newChemin)) {
            // foonctionne pas a cause du fetch assoc
            $fonction_sql->executeRequete("update photo set cheminPhoto = '$newChemin' where idPhoto =(SELECT idPhoto from affiche where idArticle = $id_article )");
        }
    }


    function modifier_produit_prix($id_article, $data){
        $this->fonction_sql->executeRequete("update article set prix = '$data[prix_article]' where idArticle = $id_article");   
    }

    function modifier_produit_description($id_article, $data){
        $this->fonction_sql->executeRequete("update article set description = '$data[description_article]' where idArticle = $id_article");
    }

    function modifier_produit_stock($id_article, $data){
        $this->fonction_sql->executeRequete("update article set nom = '$data[stock_article]' where idArticle = $id_article");
    }

    function modifier_produit_categorie($id_article, $data){
        $this->fonction_sql->executeRequete("update article set categorie = '$data[categorie_article]' where idArticle = $id_article");
    }

    function modifier_produit_image($id_article, $dossier, $fichier){
        $this->fonction_sql->executeRequete("update photo set cheminPhoto = '$dossier$fichier' where idPhoto =(SELECT idPhoto from affiche where idArticle = $id_article )");
        
    }

    function get_nom_produit($id_article){
        $resultat = $this->fonction_sql->executeRequete("SELECT nom from article where idArticle = $id_article");
        return $resultat;
    }

    function select_where_idArticle($table, $cond){
        $resultat = $this->fonction_sql->executeRequete("SELECT * FROM $table WHERE idArticle=$cond");
        return $resultat;
    }

    function select_photo($id){
        $resultat = $this->fonction_sql->executeRequete("SELECT * FROM photo WHERE idPhoto=$id");
        return $resultat;
    }



}

