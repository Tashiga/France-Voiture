<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("../inc/haut_site.php"); 
?>
	<main style="height:auto; padding:50px; padding-top:10px; padding-bottom:10px">
		<section id="sectionAPanier">		
			<H1>Panier : </H1>
			<hr>
			<div id="">
			<?php
			// si un client est connecté
			if($fonction_sql->utilisateurEstConnecte()){
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
				
				//ajouter article dans panier
				if(isset($_POST['ajouter_panier'])) {
					$resultat = $fonction_sql->executeRequete("SELECT * FROM article WHERE idArticle='$_POST[idArticle]'");
					$article = $resultat->fetch_assoc();
					$fonction_sql->ajouterProduitDansPanier($article['nom'],$_POST['idArticle'],$_POST['nbArticle'],$article['prix']);
					echo("<meta http-equiv='refresh' content='1'>");
				}	
				//si client veut vider son panier
				if(isset($_GET['action']) && $_GET['action'] == "vider") {
					unset($_SESSION['panier']);
					$monId = $_SESSION['client']['idClient'];
					$fonction_sql->executeRequete("DELETE from avoir_panier where idClient = $monId");
					header("location:panier.php?");
					// echo("<meta http-equiv='refresh' content='0'>");
				}
				//si client a remplit les infos pour valider son panier et valide
				if(isset($_POST['valider_commande'])) {
					$fonction_sql->debug($_POST);
					$montant = $fonction_sql->montantTotal();
					$monId = $_SESSION['client']['idClient'];
					if($_POST['livraison'] == "standard") {
						$jour = 7;
					}
					else {
						$jour = 3;
						$montant+=2;
					}
					
					if($fonction_sql->executeRequete("INSERT INTO commande (montant, numeroRue, nomRue, cp, ville, dateLivraisonPrevu) 
					values('$montant', '$_POST[num_ad]', '$_POST[nom_rue]', '$_POST[cp_ad]', '$_POST[ville]', DATE_ADD( CURDATE(), INTERVAL $jour DAY))")) {
						$req_commande = $fonction_sql->executeRequete("SELECT distinct idCommande from commande where cp = $_POST[cp_ad] and dateLivraisonPrevu = DATE_ADD(CURDATE(), INTERVAL $jour DAY)");
						if($req_commande->num_rows == 1) {
							$fonction_sql->executeRequete("INSERT INTO valider (idCommande, idClient, dateCommande) values( 
								(SELECT distinct idCommande from commande where cp = $_POST[cp_ad] and dateLivraisonPrevu = DATE_ADD(CURDATE(), INTERVAL $jour DAY)),
								 $monId, curdate() )");
							header("location:panier.php?action=vider");
						}
					}
				}
				//si client desire supprimer un article
				if(isset($_GET['action']) && isset($_GET['id_article']) && $_GET['action']=="retirer") {
					$fonction_sql->retirerProduitDuPanier($_GET['id_article']);
					echo("<meta http-equiv='refresh' content='1'>");
				}

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

<?php require_once("../inc/bas_site.php"); ?>
