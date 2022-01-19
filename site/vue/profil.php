<?php 
require_once("../inc/initialisation.php");
require_once("menu_profil.php");


//--------------------------------- AFFICHAGE HTML AVEC TRAITEMENT PHP---------------------------------//

function modifierInformations() {
	?>
	<form action="profil.php?action=informations&modif=infos" method="post">
		<label for="nom">Nom :</label>
		<input type="text" id="nom" name="nom" maxlength="20" placeholder="votre nom" pattern="[a-zA-Z0-9-_.]{1,20}" />
		<br>
		<label for="prenom">prénom :</label>
		<input type="text" name="prenom" maxlength="20" placeholder="votre prenom" pattern="[a-zA-Z0-9-_.]{1,20}"/>
		</br>
		<label for="civilite">Civilité :</label>
		<input name="civilite" value="M" type="radio"/>Homme
		<input name="civilite" value="Mme" type="radio"/>Femme</br></br>
		<label for="email">E-mail :</label>
		<input type="email" name="email" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="E-mail"></input><br>
		<label for="password">Mot de passe :</label>
		<input type="password" name="password" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="Mot de passe"/><br><br><br><br>
		<input class="a_changer" type="submit" name="modifier" value="Modifier"/>
	</form>
	<?php
}

function afficherInformationsVendeur($vendeur) {
	?>
	<article class="articles">
		<div id="">
		<p>Informations</p>
			<?php 
				
				echo '<p class="">Votre nom : <strong>' . $_SESSION['client']['nom'] . '</strong></p>';
				echo '<p class="">Votre prénom : <strong>' . $_SESSION['client']['prenom'] . '</strong></p>';
				echo '<p class="">Civilité : <strong>' . $_SESSION['client']['civilite'] . '</p>';
				echo '<p class="">Votre mail : <strong>' . $_SESSION['client']['email'] . '</strong></p>';
				echo '<p class="">Votre mot de passe : <strong>';
				for($i = 1; $i<=strlen($vendeur['mdp']); $i++) {
					echo '#';
				}
				echo '</strong></p>';
				echo '<p class="">Votre raison social : <strong>' . $_SESSION['client']['raison_social'] . '</strong></p>';
				echo '<a href="?action=informations&modif=infos" class="a_changer">Modifier mes infos</a>';
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

function afficherInformationsClient($client) {
	?>
	<article class="articles">
		<div id="">
		<p>Informations</p>
			<?php 
				echo '<p class="">Votre nom : <strong>' . $_SESSION['client']['nom'] . '</strong></p>';
				echo '<p class="">Votre prénom : <strong>' . $_SESSION['client']['prenom'] . '</strong></p>';
				echo '<p class="">Civilité : <strong>' . $_SESSION['client']['civilite'] . '</p>';
				echo '<p class="">Votre mail : <strong>' . $_SESSION['client']['email'] . '</strong></p>';
				echo '<p class="">Votre mot de passe : <strong>';
				for($i = 1; $i<=strlen($client['mdp']); $i++) {
					echo '#';
				}
				echo '</strong></p>';
				echo '<a href="?action=informations&modif=infos" class="a_changer">Modifier mes infos</a>';

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
				if($_GET['action'] == "informations" && !isset($_GET['modif'])) {
					$id = $_SESSION['client']['idClient'];
					$req = $fonction_sql->executeRequete("SELECT mdp from client where idClient = $id");
					$client = $req->fetch_assoc();
					afficherInformationsClient($client);
				}
				else {
					if($_GET['modif']=="infos"){
						modifierInformations();
						if($_POST){
							$id = $_SESSION['client']['idClient'];
							// $fonction_sql->debug($_POST);
							if(!empty($_POST['nom'])) {
								$fonction_sql->executeRequete("UPDATE client set nom = '$_POST[nom]' where idClient = $id");
								$_SESSION['client']['nom'] = $_POST['nom'];
							}
							if(!empty($_POST['prenom'])) {
								$fonction_sql->executeRequete("UPDATE client set prenom = '$_POST[prenom]' where idClient = $id");
								$_SESSION['client']['prenom'] = $_POST['prenom'];
							}
							if(!empty($_POST['civilite'])) {
								$fonction_sql->executeRequete("UPDATE client set civilite = '$_POST[civilite]' where idClient = $id");
								$_SESSION['client']['civilite'] = $_POST['civilite'];
							}
							if(!empty($_POST['email'])) {
								$fonction_sql->executeRequete("UPDATE client set email = '$_POST[email]' where idClient = $id");
								$_SESSION['client']['email'] = $_POST['email'];
							}
							if(!empty($_POST['password'])) {
								$fonction_sql->executeRequete("UPDATE client set mdp = '$_POST[password]' where idClient = $id");
							}
							header("location:profil.php?action=informations");
						}
					}
					else {
						if($_GET['action'] == "commandes") {
							afficherCommandesClient();
						}
						else {
							if($_GET['action'] == "discussions") {
								echo '<a class="lien_vers_messagerie" href="message.php?">entrez dans votre messagerie</a>';
	
							}
							else {
								afficherNotesClient();
							}
						}
					}
				}
			}
		}
		//si vendeur
		else {
			if(isset($_GET['action'])){
				if($_GET['action'] == "informations" && !isset($_GET['modif'])) {
					$id = $_SESSION['client']['idVendeur'];
					$req = $fonction_sql->executeRequete("SELECT mdp from vendeur where idVendeur = $id");
					$vendeur = $req->fetch_assoc();
					afficherInformationsVendeur($vendeur);
					
				}
				else {
					if($_GET['action']=="informations" && isset($_GET['modif'])) {
						if($_GET['modif']=="infos"){
							modifierInformations();

							if($_POST){
								$id = $_SESSION['client']['idVendeur'];
								// $fonction_sql->debug($_POST);
								if(!empty($_POST['nom'])) {
									$fonction_sql->executeRequete("UPDATE vendeur set nom = '$_POST[nom]' where idVendeur = $id");
									$_SESSION['client']['nom'] = $_POST['nom'];
								}
								if(!empty($_POST['prenom'])) {
									$fonction_sql->executeRequete("UPDATE vendeur set prenom = '$_POST[prenom]' where idVendeur = $id");
									$_SESSION['client']['prenom'] = $_POST['prenom'];
								}
								if(!empty($_POST['civilite'])) {
									$fonction_sql->executeRequete("UPDATE vendeur set civilite = '$_POST[civilite]' where idVendeur = $id");
									$_SESSION['client']['civilite'] = $_POST['civilite'];
								}
								if(!empty($_POST['email'])) {
									$fonction_sql->executeRequete("UPDATE vendeur set email = '$_POST[email]' where idVendeur = $id");
									$_SESSION['client']['email'] = $_POST['email'];
								}
								if(!empty($_POST['password'])) {
									$fonction_sql->executeRequete("UPDATE vendeur set mdp = '$_POST[password]' where idVendeur = $id");
								}
								header("location:profil.php?action=informations");
							}
						}
					}
					else {
						if($_GET['action'] == "commandes") {
							afficherCommandesVendeur();
						}
						else {
							if($_GET['action'] == "discussions") {
								echo '<a class="lien_vers_messagerie" href="message.php?">entrez dans votre messagerie</a>';
	
							}
							else {?>
								<article class="articles">
									<div id="">
										<a class="a_changer" href="upload.php?action=new_article">ajouter</a>
										<a class="a_changer" href="produit-afficher.php?action=afficher">voir mes articles</a>
									</div>
								</article>
								
								<?php
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
