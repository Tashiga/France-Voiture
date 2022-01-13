<?php 
require_once("../inc/initialisation.php");
require_once("../inc/haut_site.php");

//--------------------------------- AFFICHAGE HTML ---------------------------------//

?>
<main style="">
	<section id="sectionProfil">
		<?php 
		//si utilisateur n'est pas connecte
		if(!$fonction_sql->utilisateurEstConnecte()) {
    		header("location:connexion.php");
		}
		else {
			if (!ISSET($_GET['action'])) {
				$_GET['action']='informations';
			}
			//si client
			if ($_SESSION['client']['statut']==0) {
				?>
				<table id="table_vendeur">
					<tbody>
						<tr id="table">
							<td><a href= "profil.php?action=informations">Mes informations</button></td>
							<td><a href= "profil.php?action=commandes">Mes commandes</button></td>
							<td><a href= "profil.php?action=discussions">Mes discussions</button></td>
							<td><a href= "profil.php?action=notes">Mes notes attribuées</button></td>
						</tr>
					</tbody>
				</table>
				<?php
			}
			//si vendeur
			else {
				?>
				<table id="table_vendeur">
					<tbody>
						<tr id="table">
							<td><a href= "profil.php?action=informations">Mes informations</button></td>
							<td><a href= "profil.php?action=commandes">Mes commandes</button></td>
							<td><a href= "profil.php?action=discussions">Mes discussions</button></td>
							<td><a href= "profil.php?action=articles">Mes articles</button></td>
						</tr>
					</tbody>
				</table>
				<?php
            }
		}
		?>
	</section>
</main>
		
<?php 
require_once("../inc/bas_site.php");

