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

    


    function supprimer_produit(){
        //supprimer un article
        //if(isset($_GET['action']) && $_GET['action'] == "suppression") {   
        // $contenu .= $_GET['id_produit']
        $resultat = $this->fonction_sql->executeRequete("SELECT * FROM article WHERE idArticle=$_GET[id_article]");
        //Recupere l'id du photo
        $produit_a_supprimer = $this->fonction_sql->executeRequete("SELECT * FROM affiche WHERE idArticle =$_GET[id_article]");
        while($autre = $produit_a_supprimer->fetch_assoc()) {
            //supprime l'affichage
            $this->fonction_sql->executeRequete("DELETE FROM affiche WHERE idArticle =$_GET[id_article]");
            $chemin_photo_a_supprimer = $this->fonction_sql->executeRequete("SELECT * FROM photo WHERE idPhoto='".$autre['idPhoto']."'");
            $autres = $chemin_photo_a_supprimer->fetch_assoc();
            if(!empty($autre['idArticle']) && file_exists($autres['cheminPhoto'])) {
                unlink($autres['cheminPhoto']);
            }
            $this->fonction_sql->executeRequete("DELETE FROM photo WHERE idPhoto='".$autre['idPhoto']."'");
            $this->fonction_sql->executeRequete("DELETE FROM ajouter WHERE idArticle=$_GET[id_article]");
            $this->fonction_sql->executeRequete("DELETE FROM article WHERE idArticle=$_GET[id_article]");
            header("location:produit-afficher.php?action=afficher");
        }
    }


    function modifier_produit(){
        //si vendeur veut modifier article
        if($_POST) {
            // $fonction_sql->debug($_FILES);
            if(!empty($_POST['nom_article'])) {
                $fonction_sql->executeRequete("update article set nom = '$_POST[nom_article]' where idArticle = $_GET[id_article]");
                $cheminPhoto = $fonction_sql->executeRequete("SELECT cheminPhoto from photo where idPhoto = (SELECT idPhoto from affiche where idArticle = $_GET[id_article]) ");
                $cheminPhoto = $cheminPhoto->fetch_assoc();
                $extension_photo =  substr($cheminPhoto['cheminPhoto'], -4);
                $newChemin = "../inc/img/photos_articles/$_POST[nom_article]$extension_photo";
                if(rename($cheminPhoto['cheminPhoto'], $newChemin)) {
                    $fonction_sql->executeRequete("update photo set cheminPhoto = '$newChemin' where idPhoto =(SELECT idPhoto from affiche where idArticle = $_GET[id_article] )");
                    echo '<p class = validation>validation ok pour '.$_POST['nom_article'].'</p>';
                }
                
            }
            if(!empty($_POST['prix_article'])) {
                $fonction_sql->executeRequete("update article set prix = '$_POST[prix_article]' where idArticle = $_GET[id_article]");
                echo '<p class = validation>validation ok pour '.$_POST['prix_article'].'</p>';
            }
            if(!empty($_POST['description_article'])) {
                $fonction_sql->executeRequete("update article set description = '$_POST[description_article]' where idArticle = $_GET[id_article]");
                echo '<p class = validation>validation ok pour '.$_POST['description_article'].'</p>';
            }
            if(!empty($_POST['stock_article'])) {
                $fonction_sql->executeRequete("update article set nom = '$_POST[stock_article]' where idArticle = $_GET[id_article]");
                echo '<p class = validation>validation ok pour '.$_POST['stock_article'].'</p>';
            }
            if(!empty($_POST['categorie_article'])) {
                $fonction_sql->executeRequete("update article set categorie = '$_POST[categorie_article]' where idArticle = $_GET[id_article]");
                echo '<p class = validation>validation ok pour '.$_POST['categorie_article'].'</p>';
            }
            if(!empty($_FILES['image_article'])) {
                $nom_article = $fonction_sql->executeRequete("SELECT nom from article where idArticle = $_GET[id_article]");
                $nom_article = $nom_article->fetch_assoc();
                // $fonction_sql->debug($nom_article['nom']);
                echo '<p class="validation">' .$nom_article['nom'].'</p>';
                $dossier = '../inc/img/photos_articles/';
                $taille_maxi = 1000000000;
                $taille = filesize($_FILES['image_article']['tmp_name']);
                $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                $extension = strrchr($_FILES['image_article']['name'], '.'); 
                //Si l'extension n'est pas dans le tableau
                if(!in_array($extension, $extensions)) {
                    $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
                }
                //si taille du fichier grande
                if($taille>$taille_maxi) {
                    $erreur = 'Le fichier est trop gros...';
                }
                //S'il n'y a pas d'erreur
                if(!isset($erreur)) {
                    $fichier =  $nom_article['nom'].$extension;
                    //On essaye de deplacer le fichier dans notre repertoire
                    //si cela nous donne FALSE, cela n'a pas fonctionne.
                    if(!move_uploaded_file($_FILES['image_article']['tmp_name'], $dossier . $fichier)) {
                        echo '<p class="erreur">Echec de l\'upload !</p>';
                        echo "Not uploaded because of error #".$_FILES["image_article"]["error"];
                    }
                    else {
                        $fonction_sql->executeRequete("update photo set cheminPhoto = '$dossier$fichier' where idPhoto =(SELECT idPhoto from affiche where idArticle = $_GET[id_article] )");
                        echo '<p class = validation>validation ok pour files.</p>';
                    }
                }
            }
            echo("<meta http-equiv='refresh' content='1'>");
        }
    }



    






}

