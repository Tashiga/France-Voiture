<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once(ROOT."inc/haut_site.php"); 
?>
<main style="height:auto; padding:30px;background:#f2f2f2;">
	<section id="sectionBoutique">
		<?php
			if(isset($_GET['marque'])) {
				echo'<div id="menu_modele"><ul>';
				$voiture = $fonction_sql->executeRequete("SELECT * from voiture where marque = '$_GET[marque]'");
				while($voitures = $voiture->fetch_assoc()) {
					echo '<li><a class="a_changer" href="boutique.php?marque='.$_GET['marque'].'&modele='.$voitures['modele'].'">'.$voitures['modele'].'</a></li>';
				}
				echo '</ul></div>';

				if(!isset($_GET['modele'])) {
					if($_GET['marque'] == "Renault") {
						$src_img = $_GET['marque'].'.jpg';
					}
					else {
						$src_img = $_GET['marque'].'.png';
					}
					echo '<div id="menu_modele_droite">';
					echo '<img id="img_boutique" src="../inc/img/logo'.$src_img.'" alt="">';//a changer ims src
					echo '<p style="font-style: italic;" class="to_center">Veuillez choisir un modele pour afficher les articles</p>';
					echo '</div>';
				}

				//afficher les articles en fonction du modele choisit
				if(isset($_GET['modele'])) {
					
					echo '<div id="menu_modele_droite">';
					$idArticle = $fonction_sql->executeRequete("SELECT distinct idArticle from peut_convenir_avec natural join voiture where voiture.marque = '$_GET[marque]' and voiture.modele='$_GET[modele]'");
					while($idArticles = $idArticle->fetch_assoc()) {
						$article = $fonction_sql->executeRequete("SELECT * from article where idArticle = '$idArticles[idArticle]'");
						while($articles = $article->fetch_assoc()) {
							$photo = $fonction_sql->executeRequete("SELECT * from photo where idPhoto = (SELECT idPhoto from affiche where idArticle = $articles[idArticle]) ");
							$photos = $photo->fetch_assoc();
							echo '<div class="article_boutique">';
							echo '<h4>'.$articles['nom'].'</h4>';
							echo '<a href="fiche_produit.php?id_article='.$articles['idArticle'].'"><img style="margin-left:80px" class="icone" src="' . $photos['cheminPhoto'] . '"  width="90" height="90"></a>';
							echo '<p>'.$articles['prix'].' €</p>';
							echo '<a class="ombre" href="fiche_produit.php?id_article='.$articles['idArticle'].'">voir l\'article</a>';
							echo '</div>';
						}
					}
					echo '</div>';
				}
			}


		?>
	</section>
</main>
		
<?php require_once(ROOT."inc/bas_site.php"); ?>