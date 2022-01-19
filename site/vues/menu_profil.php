<?php 
require_once(ROOT."inc/initialisation.php");
require_once(ROOT."inc/haut_site.php");


$fonction_sql = new Fonction_sql();

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
			//si client
			if ($_SESSION['client']['statut']==0) {
				?>
				<table id="table_vendeur">
					<tbody>
						<tr id="table">
							<td><a href= "./profil/informations">Mes informations</button></td>
							<td><a href= "./profil/commandes">Mes commandes</button></td>
							<td><a href= "./messagerie/C">Mes discussions</button></td>
							<td><a href= "./profil/notes">Mes notes attribuées</button></td>
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
							<td><a href= "./profil/informations">Mes informations</button></td>
							<td><a href= "./profil/commandes">Mes commandes</button></td>
							<td><a href= "./messagerie/discussions">Mes discussions</button></td>
							<td><a href= "./profil/articles">Mes articles</button></td>
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
require_once(ROOT."inc/bas_site.php");

