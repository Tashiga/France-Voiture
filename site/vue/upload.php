<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("menu_profil.php");

    
    ?>
        <article class="articles" id="ajouter" style="">
            <div id="ajouter_article">
                <h3 class="a_center">Votre article</h3>
                <p class="a_center" style="font-size:small;">Veuillez remplir les informations ci-dessous, afin d'ajouter votre article.</p>
                <form method="POST" action="upload.php" enctype="multipart/form-data">
                    <label for="nom_article">Nom de l'article : </label>
                    <input id="" type="text" size="30" name="nom_article" required="required" placeholder="nom de l'article"></input>
                    </br>
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000000000000">
                    <label for="avatar">Fichier : </label>
                    <input type="file" name="avatar" required="required">
                    </br>
                    <label for="nom_article">Prix : </label>
                    <input id="" type="number" step="0.01" style="width:150px;" name="prix_article" required="required" min="1" max="10000" placeholder="entrez le prix unitaire"></input> €
                    </br>
                    <label for="nom_article">Description : </label></br>
                    <textarea id="" type="text" rows="5" cols="33" name="description_article" placeholder="description de votre article" style="margin-left:120px;"></textarea>
                    </br>
                    <label for="nom_article">Quantite en stock : </label>
                    <input id="" type="number" name="stock_article" style="width:150px;" required="required" min="1" max="100" placeholder="votre stock"></input>
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
                    <input class="a_changer" style="margin-left:130px;" type="submit" value="ajouter un article">
                </form>
                <a class="a_changer" style="margin-left:470px" href="profil.php?action=articles">Retour à vos articles</a>
            </div>
        </article>
    <?php

    //si vendeur veut ajouter article
    if($_POST) {
        $dossier = '../inc/img/photos_articles/';
        $taille_maxi = 1000000000;
        $taille = filesize($_FILES['avatar']['tmp_name']);
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($_FILES['avatar']['name'], '.'); 
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
            // $fonction_sql->debug($_FILES);
            //on donne tous es acces au dossiers d'images
            chmod($dossier, 777);
            $fichier =  $_POST['nom_article'].$extension;
            //On essaye de deplacer le fichier dans notre repertoire
            //si cela nous donne FALSE, cela n'a pas fonctionne.
            if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) {
                echo '<p class="erreur">Echec de l\'upload !</p>';
                echo "Not uploaded because of error #".$_FILES["avatar"]["error"];
            }
            //Sinon (fichier deplace correctement).
            else {
                //verifier si nom_article n'existe pas dans la base.
                $resultat = $fonction_sql->executeRequete("SELECT * FROM article WHERE nom='$_POST[nom_article]'");
                if($resultat->num_rows == 0) {
                    if($fonction_sql->executeRequete("INSERT INTO article (nom, prix, description, nbStock, dateCreation, categorie) values ('$_POST[nom_article]', '$_POST[prix_article]', '$_POST[description_article]', '$_POST[stock_article]', curdate() ,  '$_POST[categorie_article]')")
                    ) {
                        $idVendeur =  $_SESSION['client']['idVendeur'];
                        $fonction_sql->executeRequete("INSERT INTO ajouter (idArticle, idvendeur) values((SELECT idArticle FROM article WHERE nom = '$_POST[nom_article]'), $idVendeur)");
                        $fonction_sql->executeRequete("INSERT INTO photo (cheminPhoto,description) values('$dossier$fichier', '' )");
                        $fonction_sql->executeRequete("INSERT INTO affiche(idPhoto, idArticle) values((select idPhoto from photo where cheminPhoto = '$dossier$fichier'), (SELECT idArticle FROM article WHERE nom = '$_POST[nom_article]'))");
                        // header("location:profil.php?action=articles");
                        echo '<p class="validation">Votre article a été ajouté avec succés !</p>';
                    }
                    else {
                        echo '<p class="erreur">Une erreur est survenu lors de votre insertion !</p>';
                    }
                }
                else {
                    echo '<p class="erreur">Erreur lors de votre insertion ! : le nom donnee a votre article est déjà utilisé</p>';
                }
            }
        }
        else {
            echo $erreur;
        }
    }


?>