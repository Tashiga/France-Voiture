<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once(ROOT."inc/haut_site.php"); 
?>
	<main style="height:auto; padding:50px; padding-top:10px; padding-bottom:10px">
		<section id="sectionApropos">		
			<H1>A Propos de nous : </H1>
			<p>Nous sommes 3 étudiants (Sasirajah Sashtiga, Xue Natacha et Youssef Nessim Abanoub),
				 en deuxieme année de DUT en Informatique, à l'IUT de Montreuil.
				</br>Nous avons décidé pour un projet scolaire, de créer un site web pour une entreprise
				 : <a href="accueil.php">France Voiture</a>.
				</br>Vous trouverez également le cahier des charges que nous avions creer ainsi que tous documents réalisés pour ce projet ci-dessous :
			</p>
			<table style="border: 1px solid #333; margin-left:500px">
				<thead style="background-color: #333;color: #fff">
					<tr>
						<th colspan="2">Les documents</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="border: 1px solid #333; text-align:center"><a href="../inc/pdf/cdc_{FranceVoiture}.pdf"> Cahier de charges </a></td>
					</tr>
					<tr>
						<td style="border: 1px solid #333; text-align:center"><a href="../inc/img/mcd.svg"> Modèle Conceptuel de Données </a></td>
					</tr>
				</tbody>
			</table>

			<H1>A Propos de France Voiture : </H1>
			<p> Il s'agit d'une entreprise totalement en ligne. Une entreprise chargée pour vendre des pièces détachées
				de voiture. En plus, de cela, France Voiture a pour principe de gérer seulement les voitures de marque 
				Française. Une entreprise totalement à votre service. Vous trouverez tous ce dont vous auriez 
				besoins pour votre vehicule. 
				</br>France Voiture permet à ses clients de vendre des articles de maniere securisee 
				et le plus rapide possible. Elle permet egalement à ses clients non vendeur de prendre connaissance des 
				articles mise en vente par d'autres et de pouvoir les consommer.
			</p>
			<p>Elle offre de nombreux services comme : suivre vos commandes, échanger avec les vendeurs, consulter les dernières actualités de France Voiture, ... </p>
			
			<p>Notre objectif est de permettre à nos clients de vendre et d'acheter des pièces détachées de voiture de manière rapide et sécurisé.</p>
			<H4><a href="aide.php">Besoin d'aide ?</a></H4>
			<p>En cas d'urgence, veuillez nous contacter <a href = "contact.php">ici</a> ou a remplir un formulaire <a href="formulaire.php?type=signaler">ici</a>.</p>
		</section>
	</main>

<?php require_once(ROOT."inc/bas_site.php"); ?>
