
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>FRANCE VOITURE</title>
		<link href="../inc/css/style.css" rel="stylesheet" type="text/css">
		
	</head>

	<body>
		<header>
			<!--LOGO-->
            <div id="logo">
				<a href="accueil.php"> 
					<img src="../inc/img/logo.png" alt="logo" width="300">
				</a>
			</div>
			
			<div class="utilisateur">
				<?php 

				//si une session existe
				if($fonction_sql->utilisateurEstConnecte()){
					echo '<!--AIDE-->
					<a href="../vue/aide.php"> 
						<img src="../inc/img/aide.png" class="icone" alt=""> Aide
					</a>

					<!--COMPTE-->
					<a href="../vue/profil.php"> 
						<img src="../inc/img/compte.png" class="icone" alt=""> Mon profil
					</a>';
					
					//si cette session appartient a un client
					if($fonction_sql->utilisateurEstConnecteEtEstVendeur()==false){
						echo '<!--PANIER-->
						<a href="../vue/panier.php"> 
							<img src="../inc/img/panier.png" class="icone" alt=""> Mon panier
						</a>';
	
					}
					echo '<a href="../vue/connexion.php?action=deconnexion">
							<img src="../inc/img/deconnexion.png" class="icone" alt="">Se déconnecter
						</a>';
				}
				
				//si pas de session en cours
				else {
					echo '<!--AIDE-->
					<a href="../vue/aide.php"> 
						<img src="../inc/img/aide.png" class="icone" alt=""> Aide
					</a>
	
					<!--COMPTE-->
					<a href="../vue/connexion.php"> 
						<img src="../inc/img/compte.png" class="icone" alt=""> Se connecter
					</a>
	
					<!--PANIER-->
					<a href="../vue/panier.php"> 
						<img src="../inc/img/panier.png" class="icone" alt=""> Mon panier
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
					<li><a href="../vue/boutique.php?marque=Citroen">Citroen</a></li>
					<li><a href="../vue/boutique.php?marque=Renault">Renault</a></li>
					<li><a href="../vue/boutique.php?marque=Peugeot">Peugeot</a></li>
				</ul>
			</nav>	
  		</header>