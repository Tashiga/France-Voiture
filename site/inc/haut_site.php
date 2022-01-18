<?php require_once("./inc/initialisation.php"); 
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
				if($fonction_sql->utilisateurEstConnecte()){
					echo '<!--AIDE-->
					<a href="../vue/aide.php"> 
						<img src="inc/img/aide.png" class="icone" alt=""> Aide
					</a>

					<!--COMPTE-->
					<a href="profil/informations"> 
						<img src="inc/img/compte.png" class="icone" alt=""> Mon profil
					</a>';
					
					//si cette session appartient a un client
					if($fonction_sql->utilisateurEstConnecteEtEstVendeur()==false){
						echo '<!--PANIER-->
						<a href="../vue/panier.php"> 
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
					<a href="../vue/aide.php"> 
						<img src="inc/img/aide.png" class="icone" alt=""> Aide
					</a>
	
					<!--COMPTE-->
					<a href="utilisateurs/connexion"> 
						<img src="inc/img/compte.png" class="icone" alt=""> Se connecter
					</a>
	
					<!--PANIER-->
					<a href="../vue/panier.php"> 
						<img src="inc/img/panier.png" class="icone" alt=""> Mon panier
					</a>';
				}
				?>

				
			</div>
			
			<!--BARRE DE RECHERCHE-->
			<div id="barre-recherche">
				<input id="barre" type="text" placeholder="Rechercher">
				<button id="recherche-btn" type="submit">
				</button>
			</div>
			

            		<!--BARRE DE NAVIGATION-->
			<nav>
				<ul>
					<li><a href="../vue/citroen.php">Citroen</a></li>
					<li><a href="../vue/renault.php">Renault</a></li>
					<li><a href="../vue/peugeot.php">Peugeot</a></li>
				</ul>
			</nav>	
  		</header>