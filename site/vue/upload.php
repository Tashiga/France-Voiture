<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("menu_profil.php");

if(!isset($_GET['action'])) {
    $_GET['action'] = "new_article";
}

if($_GET['action']=="new_article") {
    ?>
        <article class="articles" id="ajouter" style="">
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                     <div id="ajouter_article">
                    <h3 class="a_center">Votre article</h3>
                    <p class="a_center" style="font-size:small;">Veuillez remplir les informations ci-dessous, afin d'ajouter votre article.</p>
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
                       
                </div>
                <div id="ajouter_article2">
                    <H3 class="a_center">votre article et voitures : </H3>
                    <label for="nb_voiture">Pour combien de voiture concerne-t-il ? (max 5): </label>
                    <input id="" type="number" name="nb_voiture" style="width:130px;" required="required" min="1" max="5" placeholder="votre stock"></input>
                    </br>
                    <label for ="modele_voiture" >Marque de la voiture : </label>
                    </br>

                    <script>

                    function cacher2() {
                        if(document.getElementById('buton2').innerText=="ajouter") {
                            document.getElementById('modele_voiture2').style.display = "inline-block"; 
                            document.getElementById('buton2').innerText="supprimer"; 
                        }
                        else {
                            document.getElementById('modele_voiture2').style.display = "none";  
                            document.getElementById('modele_voiture3').style.display = "none";
                            document.getElementById('modele_voiture4').style.display = "none";
                            document.getElementById('modele_voiture5').style.display = "none";
                            document.getElementById('buton2').innerText="ajouter";
                            document.getElementById('buton3').innerText="ajouter";
                            document.getElementById('buton4').innerText="ajouter";
                            document.getElementById('buton5').innerText="ajouter";
                        }
                        
                    }
                    function cacher3() {
                        if(document.getElementById('buton3').innerText=="ajouter") {
                            document.getElementById('modele_voiture2').style.display = "inline-block"; 
                            document.getElementById('buton2').innerText="supprimer"; 
                            document.getElementById('modele_voiture3').style.display = "inline-block"; 
                            document.getElementById('buton3').innerText="supprimer"; 
                        }
                        else {
                            document.getElementById('modele_voiture3').style.display = "none"; 
                            document.getElementById('modele_voiture4').style.display = "none";
                            document.getElementById('modele_voiture5').style.display = "none"; 
                            document.getElementById('buton3').innerText="ajouter";
                            document.getElementById('buton4').innerText="ajouter";
                            document.getElementById('buton5').innerText="ajouter";
                        }
                    }
                    function cacher4() {
                        if(document.getElementById('buton4').innerText=="ajouter") {
                            document.getElementById('modele_voiture2').style.display = "inline-block"; 
                            document.getElementById('buton2').innerText="supprimer"; 
                            document.getElementById('modele_voiture3').style.display = "inline-block"; 
                            document.getElementById('buton3').innerText="supprimer"; 
                            document.getElementById('modele_voiture4').style.display = "inline-block"; 
                            document.getElementById('buton4').innerText="supprimer"; 
                        }
                        else {
                        document.getElementById('modele_voiture4').style.display = "none";  
                        document.getElementById('modele_voiture5').style.display = "none";
                        document.getElementById('buton4').innerText="ajouter";
                        document.getElementById('buton5').innerText="ajouter";
                        }
                    }
                    function cacher5() {
                        if(document.getElementById('buton5').innerText=="ajouter") {
                            document.getElementById('modele_voiture2').style.display = "inline-block"; 
                            document.getElementById('buton2').innerText="supprimer"; 
                            document.getElementById('modele_voiture3').style.display = "inline-block"; 
                            document.getElementById('buton3').innerText="supprimer"; 
                            document.getElementById('modele_voiture4').style.display = "inline-block"; 
                            document.getElementById('buton4').innerText="supprimer"; 
                            document.getElementById('modele_voiture5').style.display = "inline-block"; 
                            document.getElementById('buton5').innerText="supprimer"; 
                        }
                        else {
                        document.getElementById('modele_voiture5').style.display = "none";  
                        document.getElementById('buton5').innerText="ajouter";
                        }
                    }

                    </script>

                    <?php
                    for($i = 1; $i <= 5; $i++) {
                        $require = '' ;
                        $fonction = 'cacher'.$i.'()';
                        if($i==1) {
                            $require = 'required'; 
                            $fonction = '';
                        }
                        echo'<label for="modele">modele n°'.$i.'</label>';
                        echo ' <select name="modele_voiture'.$i.'" required="'.$require.'" id="modele_voiture'.$i.'" > ';
                        $voiture = $fonction_sql->executeRequete("select distinct marque from voiture");
                        while($marques = $voiture->fetch_assoc()) {
                            echo '<optgroup label="'.$marques['marque'].'">';
                            $voiture2 = $fonction_sql->executeRequete("select * from voiture where marque = '$marques[marque]'");
                            while($modeles = $voiture2->fetch_assoc()){
                                echo '<option value="'.$modeles['modele'].'_'.$marques['marque'].'">'.$modeles['modele'].'</option> ';
                            }
                            echo '</optgroup>';
                        }
                            
                        ?>
                        </select> 
                        <?php
                            if($i != 1){
                                echo '<a id="buton'.$i.'" OnClick="'.$fonction.'" >suprimer</a>';
                            }
                        ?>
                        </br>
                        <?php
                    }
                    ?>
                    </br>
                    <input class="a_changer" style="margin-left:200px;" type="submit" value="ajouter un article">
                    <a  class="a_changer" style="margin-left:160px;" href="upload.php?action=new_voiture">Ajouter un nouveau modele</a>
                    <a class="a_changer" style="margin-left:190px;" href="profil.php?action=articles">Retour à vos articles</a>
                </div>
                    
            </form>
                
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
                //permet d'inserer les apostrophes etc... correctement
                foreach($_POST as $indice => $valeur) {
                    $_POST[$indice] = htmlEntities(addSlashes($valeur));
                }
                //verifier si nom_article n'existe pas dans la base.
                $resultat = $fonction_sql->executeRequete("SELECT * FROM article WHERE nom='$_POST[nom_article]'");
                if($resultat->num_rows == 0) {
                    if($fonction_sql->executeRequete("INSERT INTO article (nom, prix, description, nbStock, dateCreation, categorie) values ('$_POST[nom_article]', '$_POST[prix_article]', '$_POST[description_article]', '$_POST[stock_article]', curdate() ,  '$_POST[categorie_article]')")) {
                        
                        /////////////////////////////////
                        $nombre_voiture_post = $_POST['nb_voiture'];
                        //inserer les donnees dans peut_convenir_avec
                        for($j = 1;  $j <= $nombre_voiture_post; $j++) {
                            $marque_post = substr($_POST['modele_voiture'.$j], -7);
                            $modele_post = substr($_POST['modele_voiture'.$j], 0, strlen($_POST['modele_voiture'.$j])-8);
                            $fonction_sql->executeRequete("INSERT into peut_convenir_avec (idVoiture, idArticle) values(
                                (SELECT idVoiture from voiture where marque = '$marque_post' and modele = '$modele_post'), 
                                (SELECT idArticle FROM article WHERE nom = '$_POST[nom_article]')
                            )");
                        }
                        ////////////////////////////////

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


}

//


if($_GET['action'] == "new_voiture") {
    ?>
    <article id="ajouter_voiture" style="">
        <div id="menu_marque">
            <?php
                $req = $fonction_sql->executeRequete("select distinct marque from voiture");
                while($requete = $req->fetch_assoc()) {
                    echo '<p class="marque">'.$requete['marque'].'</p>';
                    $req2 = $fonction_sql->executeRequete("select * from voiture where marque = '$requete[marque]'");
                    while($requete2 = $req2->fetch_assoc()){
                        echo '<p class="modele">'.$requete2['modele'].'</p>';
                    }
                }
            ?>
        </div>
        <div id="ajouter_modele">
            <form action="">
                <H3 class="a_center">Nouveau modele de voiture : </H3>
                <i>Attention un modele creer ne peut etre supprimer et peut être percu par tout le monde.<i>
                </br>
                </br>
                <label for="marque_voiture">Marque de la voiture : </label>
                <select name="marque_voiture" required="required">
                    <option value="" disabled selected>------ choisir un option ------</option>
                    <option value="Renault">Renault</option>
                    <option value="Peugeot">Peugeot</option>
                    <option value="Citroen">Citroen</option>
                </select>
                </br>
                <label for="modele_voiture">Modele de la voiture : </label>
                <input type="text" name="modele_voiture" size="20" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="modele de la voiture" required="required"/>
                </br>
                </br>
                <input class="a_changer" type="submit" value="envoyer"></input>
            </form>
            <a class="a_changer" href="upload.php?action=new_article">Retour</a>
        </div>
    </article>
    <?php

    if($_POST) {
        $fonction_sql-debug($_POST);
    }
}
?>