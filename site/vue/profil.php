<?php 
require_once("../inc/initialisation.php");
require_once("menu_profil.php");


//--------------------------------- AFFICHAGE HTML AVEC TRAITEMENT PHP---------------------------------//

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

function afficherArticlesVendeur_ajouter() {
	require_once("upload.php");
}

function afficherArticlesVendeur_afficher() {
	?>
	<article class="articles">
		<div id="">
			<p>voici vos articles</p>
			
		</div>
	</article>
	<?php
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

?>
<div class="article_profil">
	<?php
	//si utilisateur n'est pas connecte
	if(!$fonction_sql->utilisateurEstConnecte()) {
		header("location:connexion.php");
	}
	else {
		if (!ISSET($_GET['action'])) {
			$_GET['action']='informations';
		}
		//si client
		if ($_SESSION['client']['statut']==0) {
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
		//si vendeur
		else {
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
						else {?>
							<article class="articles">
								<div id="">
									<a class="a_changer" href="upload.php">ajouter</a>
									<a class="a_changer" href="profil.php?action=articles&type=afficher">voir mes articles</a>
								</div>
							</article>
							
							<?php
							//tant que l'utilisateur ne choisit pas son 'type' on affiche rien
							if(!isset($_GET['type'])) {
								$_GET['type']="";
							}
							else{
								if($_GET['type']=="ajouter") {
									afficherArticlesVendeur_ajouter();
								}
								if($_GET['type']=="afficher") {
									afficherArticlesVendeur_afficher();
								}
							}
							
						}
					}
				}
			}
		}
	}
	?>
</div>

<?php
require_once("../inc/bas_site.php");
