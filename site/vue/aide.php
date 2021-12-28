<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("../inc/haut_site.php"); 
?>
		<main style="height:auto; padding:50px; padding-top:10px; padding-bottom:50px">
			<section id="sectionAide">
				<H1 style="color:#DC3030">Vous avez besoin d'aide ?</H1>
				<div id="tableauAide">
					<table style="border: 1px solid #333">
						<thead style="background-color: #333;color: #fff">
							<tr>
								<th colspan="2">Vos questions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="border: 1px solid #333; text-align:center">Comment s'inscrire ?</td>
								<td style="border: 1px solid #333; text-align:justify">Vous devez vous rendre sur la page dedie (<a href="inscription.php">m'inscrire</a>).
									Remplissez le formulaire. 
									Faites attention, en choisissant vien votre categorie : s'il s'agit d'un compte client ou vendeur.
									Une fois votre formulaire envoye et validé, vous pouvez vous connecter à ce compte (<a href="connexion.php">se connecter</a>).
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #333; text-align:center">Vous avez perdu votre mot de passe ?</td>
								<td style="border: 1px solid #333; text-align:justify">Sur la page de connexion (<a href="connexion.php">ici</a>), en cliquant sur "Mot de passe oublié ?", 
									vous avez la possibilite de reinitialiser votre mot de passe.
									Renseignez votre mail. Vous aller recevoir un mail, qui contiendra votre nouveau mot de passe.
									Une fois que vous vous êtes connecter, pour des raison de sécurité veuillez penser à changer le mot de passe depuis votre 
									espace personnelle.
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #333; text-align:center">Vous avez perdu votre adresse mail ?</td>
								<td style="border: 1px solid #333; text-align:justify">Dommage, mais nous ne pouvons récupérer votre compte. 
									Essayez tout de même de contacter le service client (<a href="contact.php">contacter</a>).
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #333; text-align:center">Comment modifier vos informations personnnelles ?</td>
								<td style="border: 1px solid #333; text-align:justify">En se connectant (<a href="connexion.php">se connecter</a>), dans l'onglet "Mes informations"
									vous pouvez consulter vos informations.
									Si celles-ci sont incorrectes ou que vous voulez les changer, modifiez-les en appuyant sur le bouton "Modifier" a cote de l'information concerné.
									</br>Ainsi, vous devrez saisir les nouvelles informations et le valider.
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #333; text-align:center">Comment ajouter des articles au panier ?</td>
								<td style="border: 1px solid #333; text-align:justify">Premièrement, se connecter à son compte (<a href="connexion.php">se connecter</a>).
									Ensuite, cliquer sur "ajouter dans mon panier" a cote de l'article.
									Vous aurez maintenant l'article choisit dans votre panier.
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #333; text-align:center">Comment suivre une commande ?</td>
								<td style="border: 1px solid #333; text-align:justify">En se connectant (<a href="connexion.php">se connecter</a>), dans l'onglet "Les Commandes"
									vous pouvez consulter toutes vos commandes.
									Vous pouvez aussi voir l'etat de vos commandes affiché juste à cote de celle-ci.
									Si vous souhaitez voir les details de vos commandes, appuyez sur "voir detail".
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #333; text-align:center">Comment modifier ma commande ?</td>
								<td style="border: 1px solid #333; text-align:justify">En se connectant (<a href="connexion.php">se connecter</a>), dans l'onglet "Les Commandes"
									vous pouvez consulter toutes vos commandes.
									Pour modifier votre commande, vous devrez voir les details de votre commande.
									</br>Tant que les articles de votre commande n'est pas en cours d'expédition ou livré, vous pouvez modifier vos informations.
									Sinon, il est impossible de changer les informations par vous-même.
									Le seul moyen de le changer, il est d'envoyer directement un message au vendeur depuis votre espace client ou de contacter le service client (<a href="contact.php">contacter</a>).
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #333; text-align:center">Puis-je annuler ma commande ?</td>
								<td style="border: 1px solid #333; text-align:justify">L'annulation de la commande n'est pas possible tout le temps.
									Comme pour la modification des informations de la commande, vous pouvez annuler la commande tant qu'elle n'est
									pas en cours d'expédition ou livré.
									</br>Sinon, il est impossible d'annuler votre commande par vous-même.
									Le seul moyen de l'annuler, il est d'envoyer directement un message au vendeur depuis votre espace client ou de contacter le service client (<a href="contact.php">contacter</a>).
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #333; text-align:center">Probleme avec ma commande ?</td>
								<td style="border: 1px solid #333; text-align:justify">Vous rencontrez des problèmes avec votre commande : délais de livraison non respecter, article dommagé, ...
									</br>Remplissez le <a href="formulaire.php">formulaire</a> en indiquant en detail votre problème.
									Envoyez ce formulaire et le service client se chargera de vous répondre dans les plus bref délais.
									Ainsi, le service client se chargera de contacter le vendeur concerné ou de procéder à un remboursement (si possible).
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #333; text-align:center">Comment contacter un vendeur ?</td>
								<td style="border: 1px solid #333; text-align:justify">Lors que vous consultez un article, vous avez la possibilité d'envoyer un message au vendeur.
									Attention, cela nécessite que vous soyez connecté à votre compte (si cela n'est pas fait : <a href="connexion.php">se connecter</a>).
									</br>Si vous voulez envoyer un message à un vendeur sans consulter d'article, allez dans votre espace personnelle.
									Dans "Mes Discussions", vous avez la possibilité d'envoyer un message en entrant son IdVendeur si vous la connaisssez.
									</br>Attention, toutes discussions déplacé peuvent être sanctionné.
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<table style="border: 1px solid #333">
					<thead style="background-color: #333;color: #fff">
						<tr>
							<th colspan="2">Autres Questions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style=" text-align:justify">Vos questions ne figurent pas, remplissez et envoyer nous le formulaire (<a href="formulaire.php">ici</a>) et nous vous repondrons le plus rapidement possible.</td>
						</tr>
					</tbody>
				</table>
			</section>
		</main>
		
<?php require_once("../inc/bas_site.php"); ?>
