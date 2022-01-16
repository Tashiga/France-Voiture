<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("menu_profil.php");

if(!isset($_GET['action'])) {
    $_GET['action'] = "afficher";
}

if(isset($_GET['action']) && $_GET['action'] == "afficher") {  
?>
	<article id="afficher_article">
		<div id="">
			<?php
            $id = $_SESSION['client']['idVendeur'];
            $mesArticles= $fonction_sql->executeRequete("SELECT idArticle FROM ajouter WHERE idvendeur = '$id'");
			$resultat = $fonction_sql->executeRequete("SELECT * FROM article natural join ajouter where idvendeur = '$id'");
            
            $contenu .= '<h2 class="a_center"> Affichage des Produits </h2>';
            $contenu .= 'Nombre de produit(s) dans la boutique : ' . $mesArticles->num_rows;
            $contenu .= '<table border="1"><tr>';

            $contenu .= '<th>Photo</th>';
            while($colonne = $resultat->fetch_field())
            {    
                
                if($colonne->name != 'idvendeur') {
                    $contenu .= '<th>' . $colonne->name . '</th>';
                }
            }
            $contenu .= '<th>Modification</th>';
            $contenu .= '<th>Supression</th>';
            $contenu .= '</tr>';
         
            while ($ligne = $resultat->fetch_assoc())
            {
                $contenu .= '<tr>';
                $id_article = $ligne['idArticle'];
                $chemin = $fonction_sql->executeRequete("SELECT * FROM photo NATURAL JOIN affiche WHERE idArticle = '$id_article'");
                // $fonction_sql->debug($chemin);
                while($autre = $chemin->fetch_assoc()) {
                    $contenu .= '<td><img  class="icone" src="'.$autre['cheminPhoto'].'"></td>';
                    foreach ($ligne as $indice => $information)
                    {
                        if($indice != "idvendeur")
                        {
                            $contenu .= '<td>' . $information . '</td>';
                        }
                    }
                    $contenu .= '<td><a href="?action=modification&id_article=' . $ligne['idArticle'] .'"><img class="icone" src="../inc/img/modifier.png"></a></td>';
                    $contenu .= '<td><a href="?action=suppression&id_article=' . $ligne['idArticle'] .'" OnClick="return(confirm(\'En êtes vous certain de vouloir supprimer cet article ?\'));"><img class="icone" src="../inc/img/poubelle.png"></a></td>';
                    $contenu .= '</tr>';
                }
                
            }
            $contenu .= '</table><br><hr><br>';
            echo $contenu;
			?>
			 <a class="a_changer" style="margin-left:470px" href="profil.php?action=articles">Retour à vos articles</a>
		</div>
	</article>
	<?php
}

//supprimer un article
if(isset($_GET['action']) && $_GET['action'] == "suppression") {   
    // $contenu .= $_GET['id_produit']
    $resultat = $fonction_sql->executeRequete("SELECT * FROM article WHERE idArticle=$_GET[id_article]");
    //Recupere l'id du photo
    $produit_a_supprimer = $fonction_sql->executeRequete("SELECT * FROM affiche WHERE idArticle =$_GET[id_article]");
    while($autre = $produit_a_supprimer->fetch_assoc()) {
        //supprime l'affichage
        $fonction_sql->executeRequete("DELETE FROM affiche WHERE idArticle =$_GET[id_article]");
        $chemin_photo_a_supprimer = $fonction_sql->executeRequete("SELECT * FROM photo WHERE idPhoto='".$autre['idPhoto']."'");
        $autres = $chemin_photo_a_supprimer->fetch_assoc();
        if(!empty($autre['idArticle']) && file_exists($autres['cheminPhoto'])) {
            unlink($autres['cheminPhoto']);
        }
        $fonction_sql->executeRequete("DELETE FROM photo WHERE idPhoto='".$autre['idPhoto']."'");
        $fonction_sql->executeRequete("DELETE FROM ajouter WHERE idArticle=$_GET[id_article]");
        $fonction_sql->executeRequete("DELETE FROM article WHERE idArticle=$_GET[id_article]");
        header("location:produit-afficher.php?action=afficher");
    }
}


//modifier un article
if(isset($_GET['action']) && $_GET['action'] == "modification") {   
    $resultat = $fonction_sql->executeRequete("SELECT * FROM article WHERE idArticle=$_GET[id_article]");
    $article_actuel = $resultat->fetch_assoc(); 
    $affichage = $fonction_sql->executeRequete("SELECT * FROM affiche WHERE idArticle =$_GET[id_article]");
    while($autre = $affichage->fetch_assoc()) {
        $chemin_photo_a_supprimer = $fonction_sql->executeRequete("SELECT * FROM photo WHERE idPhoto='".$autre['idPhoto']."'");
        $result_photo = $chemin_photo_a_supprimer->fetch_assoc();
        ?>
            <article class="articles" id="ajouter" style="">
                <div id="ajouter_article">
                    <h3 class="a_center">Votre article</h3> 
                    <p class="a_center" style="font-size:small;">Veuillez remplir les informations ci-dessous, afin d'ajouter votre article.</p>
                    <div id="votre_article">
                        <?php
                        if(isset($article_actuel)){
                            echo '<img class="icone" src="' . $result_photo['cheminPhoto'] . '"  ="90" height="90"><br>';
                        }?>
                        Nom de l'article : <?php
                        if(isset($article_actuel['nom'])) 
                        echo $article_actuel['nom']; 
                        echo ''
                        ?>
                        </br>
                        Prix : <?php
                        if(isset($article_actuel['prix'])) echo $article_actuel['prix']; echo ''?>€
                        </br>
                        Description : <?php
                        if(isset($article_actuel['description'])) echo $article_actuel['description']; ?> 
                         </br>
                        Quantite en stock : <?php
                        if(isset($article_actuel['nbStock'])) echo $article_actuel['nbStock']; echo ''?>
                        </br>
                        Categorie :  <?php
                        if(isset($article_actuel['categorie'])) echo $article_actuel['categorie']; echo ''?>
                    </div>
                    <div id="infos_modif">
                        <p>vos modifs : </p>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <label for="nom_article">Nom de l'article : </label>
                            <input id="" type="text" size="30" name="nom_article" 
                            placeholder="<?php  if(isset($article_actuel['nom'])) echo $article_actuel['nom']; echo ''?>"></input>
                            </br>
                            <label for="prix_article">Prix : </label>
                            <input id="" type="number" step="0.01" style="width:150px;" name="prix_article" min="1" max="10000" 
                            placeholder="<?php  if(isset($article_actuel['prix'])) echo $article_actuel['prix']; echo ''?>"></input> €
                            </br>
                            <label for="description_article">Description : </label></br>
                            <textarea id="" type="text" rows="5" cols="33" name="description_article" 
                            placeholder="<?php  if(isset($article_actuel['description'])) echo $article_actuel['description']; echo ''?>" style="margin-left:120px;"></textarea>
                            </br>
                            <label for="stock_article">Quantite en stock : </label>
                            <input id="" type="number" name="stock_article" style="width:150px;" min="1" max="100" 
                            placeholder="<?php  if(isset($article_actuel['nbStock'])) echo $article_actuel['nbStock']; echo ''?>"></input>
                            </br>
                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000000000000">
                            <label for="image_article">Fichier : </label>
                            <input type="file" name="image_article">
                            </br>
                            <label for="categorie_article">Categorie : </label>
                            <select name="categorie_article" required="required">
                                <option value="pneus" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'pneus') echo 'selected'; ?> >Pneus</option>
                                <option value="moteur" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'moteur') echo 'selected'; ?> >Moteur</option>
                                <option value="freinage" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'freinage') echo 'selected'; ?> >Freinage</option>
                                <option value="systeme electrique" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'systeme electrique') echo 'selected';?> >Systeme electrique</option>
                                <option value="amortisseur" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'amortisseur') echo 'selected';?> >Amortisseur</option>
                                <option value="echappement" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'echappement') echo 'selected';?> >Echappement</option>
                                <option value="suspension" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'suspension') echo 'selected';?> >Suspension</option>
                                <option value="piece allumage" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'piece allumage') echo 'selected';?> >Piece allumage</option>
                                <option value="climatisation" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'climatisation') echo 'selected';?> >Climatisation</option>
                                <option value="carrosserie" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'carrosserie') {echo 'selected';} ?> >Carrosserie</option>
                                <option value="alternateur" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'alternateur') echo 'selected';?> >Alternateur</option>
                                <option value="filtre" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'filtre') echo 'selected';?> >Filtre</option>
                                <option value="direction" <?php if(isset($article_actuel) && $article_actuel['categorie'] == 'direction') echo 'selected';?> >Direction</option>
                            </select>
                            <input class="a_changer" style="margin-left:130px;" type="submit" value="modifier">
                        </form>
                    </div>
                    <br><br>
                    <a class="a_changer" style="margin-left:470px" href="produit-afficher.php?action=afficher">Voir vos articles</a>
                    <a class="a_changer" style="margin-left:470px" href="profil.php?action=articles">Retour à vos articles</a>
                </div>
            </article>
        <?php
    }

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