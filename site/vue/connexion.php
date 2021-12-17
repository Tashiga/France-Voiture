<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("../inc/haut_site.php"); 
?>

		  <main>
			<section id="sectionConnexion">
				<form action="">
					<!-- partie permet de se connecter a son compte-->
					<div id="connexion"> 
						<h3 class="aCentrer">Connexion</h3>
						<!-- mail -->
						<input type="email" name="mail" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="E-mail"/>
						<!-- mot de passe -->
						<input type="password" name="password" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="Mot de passe"/>
						<div id="isVendeur">
							<input type="checkbox" name="vendeur" />
							<p>Je suis un vendeur</p>
						</div>
						<button name="Connexion" type="submit">connexion</button>
					</div> 
					<div id="inscription">
						<p>PAS DE COMPTE ?</p>
						<a href="inscription.php">s'inscrire gratuitement</a>
					</div>
				</form >
			</section>


		</main>

<?php require_once("../inc/bas_site.php"); ?>
