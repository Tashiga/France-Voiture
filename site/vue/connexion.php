<?php 
require_once("../inc/initialisation.php");




//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut_site.php"); 
?>

		  <main style=" background-color: #e4e4e4;">
			<section id="sectionConnexion">
				<form action="">
					<!-- partie permet de se connecter a son compte-->
					<div id="connexion"> 
						<h1 id="titreConnex" class="capitalConnex">Connexion</h1>
						<!-- mail -->
						<input class="inputConnex" type="email" name="mail" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="E-mail" required="required"/>
						<!-- mot de passe -->
						<input class="inputConnex" type="password" name="password" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="Mot de passe" required="required"/>
						<div id="isVendeur">
							<input type="checkbox" name="vendeur" required="required"/>
							<p>Je suis un vendeur</p>
						</div>
						<button name="Connexion" type="submit" class="capitalConnex" id="boutonConnex">connexion</button>
					</div> 
				</form >
				<div id="inscription">
					<p class="capitalConnex">pas de compte ?</p>
					<a href="inscription.php" class="capitalConnex">s'inscrire gratuitement</a>
				</div>
				
			</section>


		</main>

<?php require_once("../inc/bas_site.php"); ?>
