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
    header("location:produit-afficher.php?action=afficher");
}