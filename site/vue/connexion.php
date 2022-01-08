<?php 
require_once("../inc/initialisation.php");




//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/haut_site.php"); 
?>

<main style=" background-color: #e4e4e4;">
			<section id="sectionConnexion">
				<form method="post" action="">
					<!-- partie permet de se connecter a son compte-->
					<div id="connexion"> 
						<h1 id="titreConnex" class="capitalConnex">Connexion</h1>
						<!-- mail -->
						<input class="inputConnex" type="email" name="email" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="E-mail" required="required"/>
						<!-- mot de passe -->
						<input class="inputConnex" type="password" name="password" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="Mot de passe" required="required"/>
						<div id="isVendeur">
							<input type="checkbox" name="vendeur" value="Yes"/>
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

<?php
//--------------------------------------traitement php--------------------------------------------//

//si l'user veut se deconnecter
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion')
{
    session_destroy();
}

//si l'user est deja connecte
if($fonction_sql->utilisateurEstConnecte())
{
    header("location:profil.php");
}

//lorsque user clique sur connexion pour se connecter
if($_POST) {
	$fonction_sql->debug($_POST);
	//s'il s'agit d'un vendeur
	if($_POST['vendeur']=='Yes') {
		$table = 'vendeur';
	}
	else {
		$table = 'client';
	}
	//$contenu .=  "email : " . $_POST['email'] . "<br>mdp : " .  $_POST['password'] . "";
	$resultat = $fonction_sql->executeRequete("SELECT * FROM $table WHERE email='$_POST[email]'");
	if($resultat->num_rows != 0) {
		//$contenu .=  '<div style="background:green; position:absolute;">mail connu!</div>';
		$client = $resultat->fetch_assoc();
		if($client['mdp'] == $_POST['password']) {
			//$contenu .= '<div class="validation">mdp connu!</div>';
			foreach($client as $indice => $element) {
				if($indice != 'mdp') {
					$_SESSION['client'][$indice] = $element;
				}
				//ajouter dans session un attribut statut
				if($table=='vendeur') {
					$_SESSION['client']['statut'] = 1;
				}
				else {
					$_SESSION['client']['statut'] = 0;
				}
			}
			//diriger vers la page profil
			header("location:profil.php");
		}
		else {
			$contenu .= '<div class="erreur">Erreur de MDP ' . $_POST['password'] .'</div>';
		}       
	}
	else {
		$contenu .= '<div class="erreur">Erreur de pseudo</div>';
	}
	echo $contenu;
}


?>