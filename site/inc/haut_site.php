<?php require_once("./inc/Initialisation.php");
require_once("./inc/Fonction_sql.php"); 

$init = new Initialisation();
$fonction_sql = new Fonction_sql();

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>FRANCE VOITURE</title>
		<base href="http://localhost/France-Voiture-1/site/">
		<link href="inc/css/style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<header>
			<!--LOGO-->
            <div id="logo">
				<a href="./"> 
					<img src="inc/img/logo.png" alt="logo" width="300">
				</a>
			</div>
			
			<div class="utilisateur">
				<?php 

				//si une session existe
				if($init->utilisateurEstConnecte()){
					echo '<!--AIDE-->
					<a href="accueil/aide"> 
						<img src="inc/img/aide.png" class="icone" alt=""> Aide
					</a>

					<!--COMPTE-->
					<a href="profil/informations"> 
						<img src="inc/img/compte.png" class="icone" alt=""> Mon profil
					</a>';
					
					//si cette session appartient a un client
					if($init->utilisateurEstConnecteEtEstVendeur()==false){
						echo '<!--PANIER-->
						<a href="utilisateurs/panier"> 
							<img src="inc/img/panier.png" class="icone" alt=""> Mon panier
						</a>';
	
					}
					echo '<a href="utilisateurs/deconnexion">
							<img src="inc/img/deconnexion.png" class="icone" alt="">Se déconnecter
						</a>';
				}
				
				//si pas de session en cours
				else {
					echo '<!--AIDE-->
					<a href="accueil/aide"> 
						<img src="inc/img/aide.png" class="icone" alt=""> Aide
					</a>
	
					<!--COMPTE-->
					<a href="utilisateurs/connexion"> 
						<img src="inc/img/compte.png" class="icone" alt=""> Se connecter
					</a>
	
					<!--PANIER-->
					<a href="utilisateurs/panier"> 
						<img src="inc/img/panier.png" class="icone" alt=""> Mon panier
					</a>';
				}
				?>

				
			</div>
			
			<!--BARRE DE RECHERCHE-->
			<div id="barre-recherche">
				<form action="" method="GET">
					<input id="barre" name="barre" type="text" placeholder="Rechercher">
					<button id="recherche-btn" type="submit" name="recherche"> </button>
				</form>
			</div>
			

            		<!--BARRE DE NAVIGATION-->
			<nav>
				<ul>
					<li><a href="index.php?ctrl=accueil&amp;marque=Citroen">Citroen</a></li>
					<li><a href="index.php?ctrl=accueil&amp;marque=Renault">Renault</a></li>
					<li><a href="index.php?ctrl=accueil&amp;marque=Peugeot">Peugeot</a></li>
				</ul>
			</nav>	
  		</header>


<?php

if (isset($_POST['recherche'])) {
    $cherche = $_POST['barre'];
    $req = "SELECT * FROM article where nom OR categorie LIKE '%$cherche%";

	$resultat = $fonction_sql()->executeRequete($req);
	while($ligne = $resultat->fetch_assoc()){
		echo $ligne['nom'] . "<br>";
		echo $ligne['categorie'] . "<br>";
	}
		
}

?>
