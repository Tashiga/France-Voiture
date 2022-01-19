<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once(ROOT."./vues/menu_profil.php");
?>


    <article id="ajouter_article" style="">
        <div class="article_profil">
            <h2 class="a_center">Ajouter un article</h2>
            <p class="a_center" style="font-size:small;">Veuillez remplir les informations ci-dessous, afin d'ajouter votre article.</p>
            <form method="POST" action="" enctype="multipart/form-data"> 
                <label for="nom_article">Nom de l'article : </label>
                <input id="" type="text" size="30" name="nom_article" required="required" placeholder="nom de l'article"></input>
                </br></br>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000000000000">
                <label for="avatar">Fichier : </label>
                <input type="file" name="avatar" required="required">
                </br></br>
                <label for="nom_article">Prix : </label>
                <input id="" type="number" step="0.01" style="width:150px;" name="prix_article" required="required" min="1" max="10000" placeholder="entrez le prix unitaire"></input> €
                </br></br>
                <label for="nom_article">Description : </label></br>
                <textarea id="" type="text" rows="5" cols="33" name="description_article" placeholder="description de votre article" ></textarea>
                </br></br>
                <label for="nom_article">Quantite en stock : </label>
                <input id="" type="number" name="stock_article" style="width:150px;" required="required" min="1" max="100" placeholder="votre stock"></input>
                </br></br>
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
                <input class="a_changer" type="submit" value="Ajouter">
            </form>
        </div>
        <a class="btn_bas" href="profil/articles">Retour à vos articles</a>
    </article>
    


    
