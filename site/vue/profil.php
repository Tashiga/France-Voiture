<?php 
require_once("../inc/initialisation.php");


//--------------------------------------traitement php--------------------------------------------//

function afficherInformationsVendeur() {
	?>
	<article class="articles">
		<div id="">
		<p>Informations</p>
			<?php 
				$variable = "";
				$variable .= '<p class="">Votre nom : <strong>' . $_SESSION['client']['nom'] . '</strong></p>';
				$variable .= '<p class="">Votre prenom : <strong>' . $_SESSION['client']['prenom'] . '</strong></p>';
				$variable .= '<p class="">Votre mail : <strong>' . $_SESSION['client']['email'] . '</strong></p>';
				$variable .= '<p class="">Votre raison social : <strong>' . $_SESSION['client']['raison_social'] . '</strong></p>';
				echo $variable;
			?>
		</div>
	</article>
	<?php
}

function afficherCommandesVendeur() {
	?>
	<article class="articles">
		<div id="">
		<p>Commandes</p>
			<?php 
				
			?>
		</div>
	</article>
	<?php
}

function afficherDiscussionsVendeur() {
	?>
	<article class="articles">
		<div id="">
			<p>Discussions</p>
			<?php 
				
			?>
		</div>
	</article>
	<?php
}

function afficherArticlesVendeur() {
		?>
        <article class="articles">
            <div id="">
                <p>Articles</p>
                <form method="post" action="">
                    <label for="nom_article">Nom de l'article : </label>
                    <input id="" type="text" name="nom_article" required="required""></input>
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
                    </br></br>
                    <label for="photo">photo de l'article</label>
    				<input type="file" id="photo" name="photo">
					<br><br>
                    <button type="submit">ajouter un article</button>
                </form>
            </div>
        </article>
        <?php

		if(!empty($_POST)) {
			require_once("../inc/fonction_sql.php");
			$fonction_sql = new Fonction_sql();
		// echo "<p class='erreur'>Désolé, nous devons coder la partie permettant d'insérer vos données dans la base. Veuillez ressayer plus tard.</p>";
			$fonction_sql->debug($_POST);

			//pour l'ajour d'une photo
			$photo_bdd = ""; 
			if(!empty($_POST['photo'])) {   
				//$fonction_sql->debug($_FILES);
				echo "<p class='erreur'>files non empty</p>";
				// $nom_photo = $_POST['nom_article'] . '_' .$_POST['photo'];
				// $photo_bdd = "../inc/img/" . "photos_articles/$nom_photo";
				// $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . "../inc/img/" . "/photos_articles/$nom_photo"; 
				// $fonction_sql->debug($_SERVER);
				//copy($_FILES['photo'][$nom_photo],$photo_dossier);
			}
			else {
				echo "<p class='erreur'>files empty</p>";
			}


			foreach($_POST as $indice => $valeur){
				$_POST[$indice] = htmlEntities(addSlashes($valeur));
			}

			$contenu='';
			$fonction_sql->executeRequete("INSERT INTO article (nom, prix, description, nbStock, dateCreation, categorie) values ('$_POST[nom_article]', '$_POST[prix_article]', '$_POST[description_article]', '$_POST[stock_article]', curdate() ,  '$_POST[categorie_article]')");
			$contenu .= '<div class="validation">Le produit a été ajouté</div>';
			echo $contenu;

		}
	
}


function afficherInformationsClient() {
	?>
	<article class="articles">
		<div id="">
		<p>Informations</p>
			<?php 
				$variable = "";
				$variable .= '<p class="">Votre nom : <strong>' . $_SESSION['client']['nom'] . '</strong></p>';
				$variable .= '<p class="">Votre prenom : <strong>' . $_SESSION['client']['prenom'] . '</strong></p>';
				$variable .= '<p class="">Votre mail : <strong>' . $_SESSION['client']['email'] . '</strong></p>';
				echo $variable;
			?>
		</div>
	</article>
	<?php
}

function afficherCommandesClient() {
	?>
	<article class="articles">
		<div id="">
		<p>Commandes</p>
			<?php 
				
			?>
		</div>
	</article>
	<?php
}

function afficherDiscussionsClient() {
	?>
	<article class="articles">
		<div id="">
		<p>Discussions</p>
			<?php 
				
			?>
		</div>
	</article>
	<?php
}

function afficherNotesClient() {
	?>
	<article class="articles">
		<div id="">
		<p>Notes</p>
			<?php 
				
			?>
		</div>
	</article>
	<?php
}

//--------------------------------- AFFICHAGE HTML ---------------------------------//

require_once("../inc/haut_site.php");

?>
<main>
	<section id="sectionProfil">
		<?php 
		if(!$fonction_sql->utilisateurEstConnecte()) {
    		header("location:connexion.php");
		}
		else {
			if (!ISSET($_GET['action'])) {
				$_GET['action']='informations';
			}

			if ($_SESSION['client']['statut']==0) {
				?>
				<table id="table_vendeur">
					<tbody>
						<tr id="table">
							<td><a href= "profil.php?action=informations">Mes informations</button></td>
							<td><a href= "profil.php?action=commandes">Mes commandes</button></td>
							<td><a href= "profil.php?action=discussions">Mes discussions</button></td>
							<td><a href= "profil.php?action=notes">Mes notes attribuées</button></td>
						</tr>
					</tbody>
				</table>
				<?php
				if(isset($_GET['action'])){
					if($_GET['action'] == "informations") {
						afficherInformationsClient();
					}
					else {
						if($_GET['action'] == "commandes") {
							afficherCommandesClient();
						}
						else {
							if($_GET['action'] == "discussions") {
								afficherDiscussionsClient();
							}
							else {
								afficherNotesClient();
							}
						}
					}
				}
			
			}
			else {
				?>
				<table id="table_vendeur">
					<tbody>
						<tr id="table">
							<td><a href= "profil.php?action=informations">Mes informations</button></td>
							<td><a href= "profil.php?action=commandes">Mes commandes</button></td>
							<td><a href= "profil.php?action=discussions">Mes discussions</button></td>
							<td><a href= "profil.php?action=articles">Mes articles</button></td>
						</tr>
					</tbody>
				</table>
				<?php
				if(isset($_GET['action'])){
					if($_GET['action'] == "informations") {
						afficherInformationsVendeur();
					}
					else {
						if($_GET['action'] == "commandes") {
							afficherCommandesVendeur();
						}
						else {
							if($_GET['action'] == "discussions") {
								afficherDiscussionsVendeur();
							}
							else {
								afficherArticlesVendeur();
							}
						}
					}
				}
			
		}
		?>
	</section>
</main>
		
<?php 
require_once("../inc/bas_site.php");


	

	

}
