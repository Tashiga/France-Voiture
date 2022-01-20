<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once(ROOT."inc/haut_site.php"); 
require_once(ROOT."inc/Initialisation.php"); 
$init = new Initialisation();
?>
	<main style="height:auto; padding:50px; padding-top:10px; padding-bottom:10px">
		<section id="sectionAPanier">		
			<H1>Panier : </H1>
			<hr>
			<div id="">
			<?php
			// si un client est connecté
			if($init->utilisateurEstConnecte()){
				echo "<table border='1' style='border-collapse: collapse; text-align:center' cellpadding='7'>";
				echo "<tr><td colspan='5'>Votre panier</td></tr>";
				echo "<tr><th>Nom du produit</th><th>N° de produit</th><th>Quantité</th><th>Prix Unitaire</th><th>Action</th></tr>";
				// panier vide
				if(empty($_SESSION['panier']['idArticle'])) {
					echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
				}
				// contient articles
				else {
					for($i = 0; $i < count($_SESSION['panier']['idArticle']); $i++)  {
						echo "<tr>";
						echo "<td>" . $_SESSION['panier']['nomArticle'][$i] . "</td>";
						echo "<td>" . $_SESSION['panier']['idArticle'][$i] . "</td>";
						echo "<td>" . $_SESSION['panier']['nbArticle'][$i] . "</td>";
						echo "<td>" . $_SESSION['panier']['montant'][$i] . "</td>";
						echo '<td><a href="?action=retirer&id_article='.$_SESSION['panier']['idArticle'][$i].'">retirer</a></td>';
						echo "</tr>";
					}
					echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . $fonction_sql->montantTotal() . " euros</td></tr>";
					echo '<form method="post" action="formulaire.php?type=valider_commande">';
					echo '<tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement"></td></tr>';
					echo '</form>'; 
					echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>";
				}
				echo "</table><br>";
				echo "<i>Réglement par CHÈQUE uniquement à l'adresse suivante : XXX rue de france voiture 75XXX PARIS</i><br>";
				
				//----------------------------------------------TRAITEMENT--------------------------------------------------------//
			}
			
			// si aucun client est connecté
			else {
				echo "
				<p>Nous sommes navré de vous informer que vous nous ne pouvez consulter
					votre panier.
				</p>";
				echo '
				<p> Si vous voulez vraiment consulter votre panier, vous devrez
					vous <a href="connexion.php">"connecter"</a> a votre espace personnel. Si
					vous n\'avez pas encore de compte, <a href"inscription.php">"inscrivez-vous"</a>.
				</p>';
			}
			
			?>
			</div>
		</section>
	</main>

<?php require_once(ROOT."inc/bas_site.php"); ?>
