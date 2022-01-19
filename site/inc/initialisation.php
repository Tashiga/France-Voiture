<?php

class Initialisation{
	
	public function  __construct() {}

	//fonction qui permet de savoir si une session est en cours
	function utilisateurEstConnecte() { 
		if(!isset($_SESSION['client'])) 
			return false;
		else 
			return true;
	}

	//fonction qui permet de savoir si une session est en cours et qu'il s'agit d'un vendeur
	function utilisateurEstConnecteEtEstVendeur() {
		if($this->utilisateurEstConnecte() && $_SESSION['client']['statut'] == 1) 
			return true;
    	else 
			return false;
	}

	//fonction qui creer un panier et l'ajoute dans la session
	function creationDuPanier() {
		if(!isset($_SESSION['panier'])) {
			$_SESSION['panier'] = array();
			$_SESSION['panier']['nomArticle'] = array();
			$_SESSION['panier']['idArticle'] = array();
			$_SESSION['panier']['nbArticle'] = array();
			$_SESSION['panier']['montant'] = array();
		}
	}

	function recupererPanier ($nomArticle, $idArticle, $nbArticle, $montant) {
		$this->creationDuPanier();
		$position_produit = array_search($idArticle, $_SESSION['panier']['idArticle']);
		if($position_produit == false) {
			$_SESSION['panier']['nomArticle'][] = $nomArticle;
			$_SESSION['panier']['idArticle'][] = $idArticle;
			$_SESSION['panier']['nbArticle'][] = $nbArticle;
			$_SESSION['panier']['montant'][] = $montant;
		}
	}

	//fonction qui ajoute le produit dans panier
	function ajouterProduitDansPanier($nomArticle, $idArticle, $nbArticle, $montant) {
		$this->creationDuPanier();
		$position_produit = array_search($idArticle, $_SESSION['panier']['idArticle']);
		if($position_produit !== false) {
			$_SESSION['panier']['nbArticle'][$position_produit] += $nbArticle ;
			$quantite = $_SESSION['panier']['nbArticle'][$position_produit];
			$this->executeRequete("UPDATE avoir_panier set nbArticle = $quantite where idArticle = $idArticle");
		}
		else {
			$_SESSION['panier']['nomArticle'][] = $nomArticle;
			$_SESSION['panier']['idArticle'][] = $idArticle;
			$_SESSION['panier']['nbArticle'][] = $nbArticle;
			$_SESSION['panier']['montant'][] = $montant;

			//obligatoirement position contiendra la position de l'article dans le panier
			$position = array_search($idArticle, $_SESSION['panier']['idArticle']);
			$new_id = $_SESSION['panier']['idArticle'][$position];
			$new_cl = $_SESSION['client']['idClient'];
			$new_nb = $_SESSION['panier']['nbArticle'][$position];
			$new_mon = $_SESSION['panier']['montant'][$position];
			$this->executeRequete("INSERT into avoir_panier(idArticle, idClient, nbArticle, montant) values('$new_id', '$new_cl', '$new_nb', '$new_mon')");

		}
	}

	// fonction qui calcule le montant total du panier pour chaque article arrondi aux centiemes
	function montantTotal() {
		$total=0;
		for($i = 0; $i < count($_SESSION['panier']['idArticle']); $i++) {
			$total += $_SESSION['panier']['nbArticle'][$i] * $_SESSION['panier']['montant'][$i];
		}
		return round($total,2); 
	}

	// fonction qui supprime un article du panier
	function retirerProduitDuPanier($id_article_a_supprimer) {
		$position_article = array_search($id_article_a_supprimer,  $_SESSION['panier']['idArticle']);
		if ($position_article !== false) {
			//on remplace fait "redescendre" les autres articles dans le panier pour gerer les indices vides
			array_splice($_SESSION['panier']['nomArticle'], $position_article, 1);
			array_splice($_SESSION['panier']['idArticle'], $position_article, 1);
			array_splice($_SESSION['panier']['nbArticle'], $position_article, 1);
			array_splice($_SESSION['panier']['montant'], $position_article, 1);
			$monId = $_SESSION['client']['idClient'];
			$this->executeRequete("DELETE from avoir_panier where idClient = $monId and idArticle = $id_article_a_supprimer");

		}
	}

}
?>