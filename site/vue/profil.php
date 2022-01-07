<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("../inc/haut_site.php");

?>
<main>
	<section id="sectionCitroen">
		<H1>profil</H1>
		<?php 
		if(!$fonction_sql->internauteEstConnecte())
    		header("location:connexion.php");
		$fonction_sql->debug($_SESSION);
		$contenu .= '<p class="">Bonjour <strong>' . $_SESSION['client']['civilite'] . '. ' . $_SESSION['client']['nom'] . ' ' . $_SESSION['client']['prenom'] . '</strong></p>';
		$contenu .= '<div class=""><h2> Voici vos informations </h2>';
		$contenu .= '<p class=""> votre mail est: ' . $_SESSION['client']['email'] . '<br>';

		echo $contenu;
		?>
	</section>
</main>
		
<?php 
require_once("../inc/bas_site.php");
//--------------------------------------traitement php--------------------------------------------//



