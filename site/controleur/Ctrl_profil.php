<?php
require_once("../vue/profil.php");


	//si utilisateur n'est pas connecte
	if(!$fonction_sql->utilisateurEstConnecte()) {
		header("location:Ctrl_connexion.php");
	}
	else {
		if (!ISSET($_GET['action'])) {
			$_GET['action']='informations';
		}
        
		//si acheteur
		if ($_SESSION['client']['statut']==0) {
			if(isset($_GET['action'])){
				if($_GET['action'] == "informations") {
					afficherInformationsClient();
				}
				else {
					if($_GET['action'] == "commandes") {
						afficherCommandesClient();
					}
					else {
						if($_GET['action'] == "discussions") {
							afficherDiscussionsClient();
						}
						else {
							afficherNotesClient();
						}
					}
				}
			}
		}
		//si vendeur
		else {
			if(isset($_GET['action'])){
				if($_GET['action'] == "informations") {
					afficherInformationsVendeur();
				}
				else {
					if($_GET['action'] == "commandes") {
						afficherCommandesVendeur();
					}
					else {
						if($_GET['action'] == "discussions") {
							afficherDiscussionsVendeur();
						}
						else {?>
							<article class="articles">
								<div id="">
									<a class="a_changer" href="upload.php">ajouter</a>
									<a class="a_changer" href="produit-afficher.php?action=afficher">voir mes articles</a>
								</div>
							</article>
							
							<?php
						}
					}
				}
			}
		}
	}
	?>