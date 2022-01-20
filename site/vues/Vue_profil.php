<?php 
require_once("menu_profil.php");

class Vue_profil{


	function afficherInformations($infos) {
		?>
		<article class="articles">
			<div class="article_profil">
			<h2>Informations</h2>
				<?php 
					$variable = "";
					$variable .= '<p class="">Votre nom : <strong>' . $infos['nom'] . '</strong></p>';
					$variable .= '<p class="">Votre mail : <strong>' . $infos['email'] . '</strong></p>';
					echo $variable;
				?>
			</div>
		</article>
		<?php
	}

	function afficherCommandesVendeur() {
		?>
		<article class="articles">
			<div class="article_profil">
			<h2>Commandes</h2>
				<?php 
					
				?>
			</div>
		</article>
		<?php
	}

	function afficherDiscussions() {
		?>
		<article class="articles">
			<div class="article_profil">
			<h2>Discussions</h2>
				<?php 
					
				?>
			</div>
		</article>
		<?php
	}

	function afficherActionArticle() {
		?>
		<article class="articles">
			<div class="article_profil">
				<a class="a_changer" href="produits/new_article">ajouter</a>
				<a class="a_changer" href="produits/affichage">voir mes articles</a>
			</div>
		</article>
		<?php
	}

	function afficherCommandesClient() {
		?>
		<article class="articles">
			<div class="article_profil">
			<h2>Commandes</h2>
				<?php 
					
				?>
			</div>
		</article>
		<?php
	}

	function afficherNotesClient() {
		?>
		<article class="articles">
			<div class="article_profil">
			<h2>Notes</h2>
				<?php 
					
				?>
			</div>
		</article>
		<?php
	}

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
}


