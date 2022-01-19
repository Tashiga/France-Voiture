<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("../inc/haut_site.php"); 
?>
<main style="height:auto; padding:30px;background:#f2f2f2;">
	<section id="sectionFicheProduit">
		<?php
        if(isset($_GET['id_article'])) {
            echo'<div id="fiche_produit">';
            $req_article = $fonction_sql->executeRequete("SELECT * from article where idArticle = $_GET[id_article]");
            $article = $req_article->fetch_assoc();
            $photo = $fonction_sql->executeRequete("SELECT * from photo where idPhoto = (SELECT idPhoto from affiche where idArticle = $article[idArticle]) ");
            $photos = $photo->fetch_assoc();
            $req_convenir = $fonction_sql->executeRequete("SELECT * from peut_convenir_avec natural join voiture where idArticle = $_GET[id_article]");
            $nb_convenance = $req_convenir->num_rows;
            $ajouter = $fonction_sql->executeRequete("SELECT * from ajouter natural join vendeur where idArticle = $_GET[id_article]");
            $vendeur = $ajouter->fetch_assoc();
            $pluriel = "";
            $stock = "";
            if($nb_convenance>1) {
                $pluriel = "s";
            }
            if($article['nbStock']<=5) {
                $stock = 'id="mettre_gras"';
            }
           
            
            echo '<h2>Article : '.$article['nom'].'</h2><hr><br>';
            echo '<p id="date_article">mise en vente depuis le '.$article['dateCreation'].'</p>';

            echo '<div id="fiche_produit_corps">';
            echo '<img id="img_fiche_produit" style="margin-left:80px" class="icone" src="' . $photos['cheminPhoto'] . '"  width="90" height="90"></br>';
            echo '<p class="infos_article" id="mettre_gras">Categorie : </p>';
            echo '<p class="infos_article"> '.$article['categorie'].'</p></br>';
            echo '<p class="infos_article" id="mettre_gras" >Prix : </p>';
            echo '<p class="infos_article">'.$article['prix'].'€</p></br>';
            echo '<p class="infos_article" id="mettre_gras" >Convenance avec véhicules : </p>';
            echo '<p class="infos_article">l\'article peut convenir avec '.$nb_convenance.' modele'.$pluriel.'.</p>';
            echo '<ul>';
            while($peut_convenir = $req_convenir->fetch_assoc()) {
                echo '<li>'.$peut_convenir['modele'].' ('.$peut_convenir['marque'].')</li></br>';
            }
            echo '</ul>';
            if(!empty($article['description'])) {
                echo '<p class="infos_article" id="mettre_gras" >Description de l\'article : </p>';
                echo '<pclass="infos_article" >'.$article['description'].'</p>';
            }
            echo '<p class="infos_article" id="mettre_gras" >Stock : </p>';
            if($article['nbStock']>0) {
                echo '<p class="infos_article" '.$stock.'>Il reste encore '.$article['nbStock'].' en stock du vendeur.</p></br>';
            }
            else {
                echo '<p class="infos_article" id="mettre_gras" >Cet article n\'est plus disponnible. </p>';
            }
            

            echo '<p class="infos_article" id="mettre_gras" >Vendeur : </p>';
            if($_SESSION['client']['statut']=='0') {
                echo '<p class="infos_article"> <a href="message.php?id='.$vendeur['idvendeur'].'&statut=1"> '.$vendeur['nom'].' </a> </p>';
            }
            else {
                echo '<p class="infos_article">'.$vendeur['nom'].'</p></br>';
            }

            echo '<fieldset> <legend id="mettre_gras">Ajouter l\'article dans votre panier</legend>';

            if($article['nbStock']>=1 && $_SESSION['client']['statut']=='0') {
                echo '<form method="post" action="panier.php">';
                // envoyer l'id de l'article dans panier
                echo '<input type="hidden" name="idArticle" value="'.$article['idArticle'].'">';
                echo '<label class="infos_article" id="mettre_gras" for="nbArticle">Quantité : </label>';
                echo '<select id="quantite" name="nbArticle">';
                // limite a ce que le client peut ajouter max que 5 articles
                    for($indice = 1; $indice <= $article['nbStock'] && $indice <= 5; $indice++) {
                       echo '<option>'.$indice.'</option>';
                    }
                echo '</select>';
                echo '<input class="bouton_fiche_produit" id="bouton_ajouter_panier" type="submit" name="ajouter_panier" value="Ajouter au panier">';
            echo '</form>';
            }
            else {
                if($_SESSION['client']['statut']=='1') {
                    echo '<p class="infos_article" >Vous êtes vendeur ! vous ne pouvez pas ajouter l\'article.</p>';
                }
                else {
                    echo '<p class="infos_article" >Cet article n\'est plus disponnible. Le stock est épuisé. Veuillez contacter le vendeur pour plus d\'informations.</p>';
                }
            }
           
            echo '</fieldset>';

            echo '<p class="infos_article">Vous avez un probleme à signaler ? <a href="formulaire.php?type=signaler" class="bouton_fiche_produit">"Remplir le formulaire"</a></p>';
            


            echo '</div>';
            echo '<hr>';
            echo '<a href="boutique.php?marque=Citroen" id="bouton_gauche" class="bouton_fiche_produit">Retour a la boutique (citroen)</a>';
            echo '<a href="boutique.php?marque=Renault" id="bouton_centre" class="bouton_fiche_produit">Retour a la boutique (Renault)</a>';
            echo '<a href="boutique.php?marque=Peugeot" id="bouton_droite" class="bouton_fiche_produit">Retour a la boutique (Peugeot)</a>';

            echo '</div>';
				
        }
			

		?>
	</section>
</main>
		
<?php require_once("../inc/bas_site.php"); ?>