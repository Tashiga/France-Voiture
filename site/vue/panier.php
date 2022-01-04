<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("../inc/haut_site.php"); 
?>
	<main style="height:auto; padding:50px; padding-top:10px; padding-bottom:10px">
		<section id="sectionAPanier">		
			<H1>Panier : </H1>
			<p>Nous sommes navré de vous informer que vous nous ne pouvez consulter
				votre panier.
			</p>
			<p> Si vous voulez vraiment consulter votre panier, vous devrez
				vous <a href="connexion.php">connecter</a> a votre espace personnel. Si
				 vous n'avez pas encore de compte, <a href="inscription.php">inscrivez-vous</a>.
			</p>
			
		</section>
	</main>

<?php require_once("../inc/bas_site.php"); ?>
