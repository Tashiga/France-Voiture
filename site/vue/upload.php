<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("../inc/haut_site.php");

    
    ?>

            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <!-- On limite le fichier à 100Ko -->
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000000000000">
                Fichier : <input type="file" name="avatar" required="required">
                <!-- autres infos-->
                <label for="nom_article">Nom de l'article : </label>
                <input id="" type="text" name="nom_article" required="required"></input>
                </br>
                <label for="nom_article">Prix : </label>
                <input id="" type="text" name="prix_article" required="required"></input>
                </br>
                <label for="nom_article">Description : </label>
                <input id="" type="text" name="description_article"></input>
                </br>
                <label for="nom_article">Quantite en stock : </label>
                <input id="" type="text" name="stock_article" required="required"></input>
                </br>
                <label for="categorie_article">Categorie : </label>
                <select name="categorie_article" required="required">
                    <option value="pneus">Pneus</option>
                    <option value="moteur">Moteur</option>
                    <option value="freinage">Freinage</option>
                    <option value="systeme electrique">Systeme electrique</option>
                    <option value="amortisseur">Amortisseur</option>
                    <option value="echappement">Echappement</option>
                    <option value="suspension">Suspension</option>
                    <option value="piece allumage">Piece allumage</option>
                    <option value="climatisation">Climatisation</option>
                    <option value="carrosserie">Carrosserie</option>
                    <option value="alternateur">Alternateur</option>
                    <option value="filtre">Filtre</option>
                    <option value="direction">Direction</option>
                </select>
                <br><br>
                <input type="submit" value="ajouter un article">
            </form>

    <?php
    require_once("../inc/bas_site.php");

    if($_POST) {
        $dossier = '../inc/img/photos_articles/';
       // $fichier = basename($_FILES['avatar']['name']);
        $taille_maxi = 1000000000000000;
        $taille = filesize($_FILES['avatar']['tmp_name']);
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($_FILES['avatar']['name'], '.'); 
        //Début des vérifications de sécurité...
        if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
        }
        if($taille>$taille_maxi)
        {
            $erreur = 'Le fichier est trop gros...';
        }
        if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
            // $fonction_sql->debug($_FILES);
            //On formate le nom du fichier ici...
            // $fichier = strtr($fichier, 
            //     'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
            //     'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            //$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
            chmod($dossier, 777);
            $fichier =  $_POST['nom_article'].$extension;
            if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                echo '<p class="erreur">Upload effectué avec succès !</p>';
            }
            else //Sinon (la fonction renvoie FALSE).
            {
                echo '<p class="erreur">Echec de l\'upload !</p>';
                echo "Not uploaded because of error #".$_FILES["avatar"]["error"];
            }
        }
        else
        {
            echo $erreur;
        }

        foreach($_POST as $indice => $valeur){
            $_POST[$indice] = htmlEntities(addSlashes($valeur));
        }
        
        $fonction_sql->executeRequete("INSERT INTO article (nom, prix, description, nbStock, dateCreation, categorie) values ('$_POST[nom_article]', '$_POST[prix_article]', '$_POST[description_article]', '$_POST[stock_article]', curdate() ,  '$_POST[categorie_article]')");
        $idVendeur =  $_SESSION['client']['idVendeur'];
        $fonction_sql->executeRequete("INSERT INTO ajouter (idArticle, idvendeur) values((SELECT idArticle FROM article WHERE nom = '$_POST[nom_article]'), $idVendeur)");
        $fonction_sql->executeRequete("INSERT INTO photo (cheminPhoto,description) values('$dossier$fichier', '' )");
        $fonction_sql->executeRequete("INSERT INTO affiche(idPhoto, idArticle) values((select idPhoto from photo where cheminPhoto = '$dossier$fichier'), (SELECT idArticle FROM article WHERE nom = '$_POST[nom_article]'))");
        header("location:profil.php?action=articles");
    

    }







?>