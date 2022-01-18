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

}


