
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
				<!--AIDE-->
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
				</a>
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