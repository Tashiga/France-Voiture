<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("../inc/haut_site.php"); 
?>
<main>
			<section id="voiture">
                <a href="citroen.php"> 
					<img src="img/logoCitroen.png" class="img_accueil" alt=""> Citroen
				</a>

                <a href="renault.php"> 
					<img src="img/logoRenault.jpg" class="img_accueil" alt=""> Renault
				</a>

                <a href="peugeot.php"> 
					<img src="img/logoPeugeot.png" class="img_accueil" alt=""> Peugeot
				</a>
			</section>
            
            <section id="comptes">
                <div id="particulier">
                    <h3>Vous êtes particulier</h3>
                    <p>Vous souhaitez acheter une pièce 
                        en particulière pour votre véhicule ? inscrivez-vous ci-dessous,
                        pour accéder aux différents articles, vendues justes pour vous.
                    </p>
                    <a href="inscription.php">M'inscrire gratuitement</a>
                </div>

                <div id="vendeur">
                    <h3>Vous êtes vendeur</h3>
                    <p>Vous souhaitez vendre des piéces de voiture plus rapidement ?
                        Inscrivez-vous ci-dessous, pour les vendres.
                    </p>
                    <a href="inscription.php">M'inscrire gratuitement</a>
                </div>
				
			</section>

            <section id="intro">
				<p>Achetez des produits à des vendeurs à travers le pays.
                </br>Vous avez la possibilité de communiquer entre clients 
                et vendeurs.</p>
                <p>Vous rencontrez un problème avec votre colis ? </br>
                    Vous avez maintenant la possibilite de le declarer afin
                     qu'il soit traité au plus rapide par nos vendeurs avec également
                     un moyen de vous faire rembourser.
                </p>
			</section>


		</main>

<?php require_once("../inc/bas_site.php"); ?>
