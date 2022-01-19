<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
#require_once("../inc/initialisation.php");
require_once("./inc/haut_site.php"); 
?>
<main style="height:auto; background-color:#1E2754">
			<section id="sectionAccueil">
                <section id="haut-accueil">
                    <section id="voiture" >
                        <div id="citroen">
                            <a href="boutique.php?marque=Citroen"> 
                                <img id="img-citroen-accueil" src="inc/img/logoCitroen.png" class="img_accueil" alt="">
                            </a>
                        </div>
                        <div id="droite">
                            <div id="renault-accueil">
                                <a href="boutique.php?marque=Renault"> 
                                    <img id="img-renault-accueil" src="inc/img/logoRenault.jpg" class="img_accueil" alt="">
                                </a>
                            </div>
                            <div id="peugeot-accueil">
                                <a href="boutique.php?marque=Peugeot"> 
                                    <img id="img-peugeot-accueil" src="inc/img/logoPeugeot.png" class="img_accueil" alt="">
                                </a>
                            </div>
                        </div>
                    </section>
                    
                    <section id="comptes">
                        <div id="particulier">
                            <h3 class="titre-accueil">Vous êtes particulier</h3>
                            <p>Vous souhaitez acheter une pièce 
                                en particulière pour votre véhicule ? inscrivez-vous ci-dessous,
                                pour accéder aux différents articles, vendues justes pour vous.
                            </p>
                            <a class="inscription-accueil" href="inscription.php">M'inscrire gratuitement</a>
                        </div>

                        <div id="vendeur">
                            <h3 class="titre-accueil">Vous êtes vendeur</h3>
                            <p>Vous souhaitez vendre des piéces de voiture plus rapidement ?
                                Inscrivez-vous ci-dessous, pour les vendres.
                            </p>
                            <a class="inscription-accueil" href="inscription.php">M'inscrire gratuitement</a>
                        </div>
                        
                    </section>

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
                    <p>
                        remplissez le formulaire <a href="formulaire.php?type=signaler" id="formulaire">ici</a>
                    </p>
                </section>
            </section>
		</main>

<?php require_once("./inc/bas_site.php"); ?>
