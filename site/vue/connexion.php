<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>FRANCE VOITURE</title>
		<link href="../css/style.css" rel="stylesheet" type="text/css">
		
	</head>

	<body>
		<header>
			<!--LOGO-->
            		<div id="logo">
				<a href="../initialisation.php"> 
					<img src="../img/logo.png" alt="logo" width="300">
				</a>
			</div>
			
			<div class="utilisateur">
				<!--AIDE-->
				<a href="aide.html"> 
					<img src="../img/aide.png" class="icone" alt=""> Aide
				</a>

				<!--COMPTE-->
				<a href="connexion.html"> 
					<img src="../img/compte.png" class="icone" alt=""> Se connecter
				</a>

				<!--PANIER-->
				<a href="panier.html"> 
					<img src="../img/panier.png" class="icone" alt=""> Mon panier
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
					<li><a href="citroen.html">Citroen</a></li>
					<li><a href="renault.html">Renault</a></li>
					<li><a href="peugeot.html">Peugeot</a></li>
				</ul>
			</nav>	
  		</header>
		


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

		
		<footer>
			<!--A PROPOS-->
			<a href="aPropos.html">A Propos</a>
			<a href="contact.html">Contact</a>
			<a href="aide.html">Aide</a>
		</footer>

	</body>


</html>