<?php 
require_once("../inc/initialisation.php");




//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut_site.php"); 
?>

<main>

	<div class="formConnexionInscription"> 
		<h1 class="titrePage">Connexion</h1>
		<!-- formulaire connexion-->
		<form method="post" action="">
			<!-- mail -->
			<label for="email">Email</label><br>
            <input type="email" id=email name="email" placeholder="email"><br><br>
			<!-- mot de passe -->
			<label for="mdp">Mot de passe</label><br>
			<input type="password" id=mdp name="password" placeholder="Mot de passe"/><br><br>
			<!--checkbox si vendeur-->
			<input type="checkbox" id=siVendeur name="vendeur"/> 
			<label for="siVendeur">Je suis un vendeur</label><br><br>
			<button name="Connexion" type="submit">connexion</button>
		</form >
	</div>
	
	<div class="inscription">
		<p>PAS DE COMPTE ?</p>
		<a href="inscription.php">s'inscrire gratuitement</a>
	</div>

</main>

<?php require_once("../inc/bas_site.php"); ?>
