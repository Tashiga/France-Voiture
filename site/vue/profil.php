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
				<input id="" type="text" name="nom_article"></input>
				<label for="nom_article">Prix : </label>
				<input id="" type="text" name="prix_article"></input>
				<label for="nom_article">Description : </label>
				<input id="" type="text" name="description_article"></input>
				<label for="nom_article">Quantite en stock : </label>
				<input id="" type="text" name="stock_article"></input>
				<label for="nom_article">Categorie : </label>
				<input id="" type="text" name="categorie_article"></input>
				<button>ajouter un article</button>
			</form>
		</div>
	</article>
	<?php

	if($_POST) {
		echo "Desole, nous devons coder la partie permmettant d'inserer vos donnees dans la base. Veuillez ressayer plus tard.";

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
