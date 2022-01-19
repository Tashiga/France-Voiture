<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once(ROOT."./vues/menu_profil.php"); 
require_once(ROOT."inc/haut_site.php");

    
    $article_actuel = $resultat->fetch_assoc();
    
   
        ?>
        <article class="article_profil" style="">
            
            <h3 class="a_center">Votre article</h3> 
            <p class="a_center" style="font-size:small;">Veuillez remplir les informations ci-dessous, afin d'ajouter votre article.</p>
            <div id="votre_article">
                <?php
                if(isset($article_actuel)){
                    echo 'chemin photo';
                }?>
                Nom de l'article : <?php
                if(isset($article_actuel['nom'])) 
                echo $article_actuel['nom']; 
                echo '';
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
            <div id="infos_modif" >
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
            <div class = 'bas'>
                <a class="btn_bas" href="produit-afficher.php?action=afficher">Voir vos articles</a>
                <a class="btn_bas" style="margin-left:470px" href="profil.php?action=articles">Retour à vos articles</a>
            </div>
        </article>
    <?php


    