<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once(ROOT."./vues/menu_profil.php"); 
require_once(ROOT."inc/haut_site.php");
?>


	<article id="afficher_article">
		<div class="article_profil">
			<?php

            $contenu = '<h2 class="a_center"> Affichage des Produits </h2>';
            $contenu .= 'Nombre de produit(s) dans la boutique : ' . $articles->num_rows;
            $contenu .= '<table border="1"><tr>';

            $contenu .= '<th>Photo</th>';
            while($colonne = $articles->fetch_field())
            {    
                if($colonne->name != 'idvendeur') {
                    $contenu .= '<th>' . $colonne->name .'</th>';
                }
            }
            $contenu .= '<th>Modification</th>';
            $contenu .= '<th>Suppression</th>';
            $contenu .= '</tr>';

            foreach ($articles as $article):
                $contenu .= '<tr>';
                $contenu .= '<td></td>';
                    
                foreach ($article as $indice => $information)
                {
                    echo " $indice ";
                    if($indice != "idvendeur")
                    {
                        $contenu .= '<td>' . $information . '</td>';
                    }
                    if($indice == "cheminPhoto"){
                        echo $indice;
                        echo "natacha";
                        $indice .= '<td><img  class="icone" src="'.$indice.'"></td>';

                    }
                }
                
                $contenu .= '<td><a class="a_changer" href="./index.php?ctrl=produits&amp;action=modification&amp;id_article=' . $article['idArticle'] .'">Modifier</a></td>';
                $contenu .= '<td><a class="a_changer" href="./index.php?ctrl=produits&amp;action=suppression&amp;id_article=' . $article['idArticle'] .'" OnClick="return(confirm(\'En êtes vous certain de vouloir supprimer cet article ?\'));">Supprimer</a></td>';
                $contenu .= '</tr>';
            endforeach;
            echo $contenu;

			?>
		</div>
	</article>
    <a class="btn_bas" href="produits/new_article">Ajouter un article</a>
	<?php
