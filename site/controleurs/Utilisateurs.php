<?php
require_once(ROOT."modeles/Utilisateur.php");
require_once(ROOT."inc/Initialisation.php");


class Utilisateurs extends Controleur {
    private $modele;
    private $init; 
    function __construct(){
        $this->modele = new Utilisateur();
        $this->init = new Initialisation();
    }

    function connexion(){
        $this->render("connexion");

        if($_POST) {

            if(ISSET($_POST['vendeur'])) {
                $table = 'vendeur';
            }
            else {
                $table = 'client';
            }

            $data = [
                'email' => $_POST['email'],
                'mdp' => $_POST['password'],
                'table' => $table
            ];
            
            if($this->modele->email_existe($data)->num_rows != 0){
                if($this->modele->verif_mdp($data) == true) {

                    $this->nouvelle_session($data);

                    //diriger vers la page profil
                    header("location:../profil/informations");
                }
                else {
                    $message = "<div class='erreur'>Erreur : Le mot de passe n'est pas ". $_POST['password'] ."</div>";
                }
            }
            else {
                $message = "<div class='erreur'> Erreur : Pas de compte $table à cette adresse email</div>";
            }
            echo $message;
        }
    }


    function nouvelle_session($data){
        $resultat = $this->modele->email_existe($data);
        $client = $resultat->fetch_assoc();
        foreach($client as $indice => $element) {
            if($indice != 'mdp') {
                $_SESSION['client'][$indice] = $element;
            }
        }
        //ajouter dans session un attribut statut
        if($data['table'] =='vendeur') {
            $_SESSION['client']['statut'] = 1;
        }
        else {
            $_SESSION['client']['statut'] = 0;
        }
    }


    function inscription(){
        $this->render("inscription");

        if($_POST) {
            //$this->fonction_sql->debug($_POST);

            $data = [
                'nom' => $_POST['nom'],
                'email' => $_POST['email'],
                'mdp' => $_POST['mdp'],
                'table' => $_POST['VendeurAcheteur']
            ];

            //Vérifie si le formulaire est correct
            if(empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['mdp']) || 
            empty($_POST['confmdp'])){
                $message = "<div class='erreur'>Veuillez remplir tous les champs.</div>";
            }
            else if(strlen($_POST['mdp']) < 6){
                $message = "<div class='erreur'>Veuillez choisir un mot de passe plus long.</div>";
            } 
            else if($_POST['mdp'] != $_POST['confmdp']){
                $message = "<div class='erreur'>Vos deux mots de passe ne sont pas identiques.</div>";
            }
            else if($this->modele->email_existe($data)->num_rows > 0){
                $message = "<div class='erreur'>Vous avez déjà créé un compte avec cette adresse email.</div>";
            }
            else {

                $this->modele->creer_compte($data);

                $message = "<div class='validation'>Inscription réussie pour ".$_POST['VendeurAcheteur']."</div>";
            }
            echo $message;
        }
    }

    function panier(){

        $this->render("panier");

        if($this->init->utilisateurEstConnecte()) {
            if($_SESSION['client']['statut'] ==0) {
                //completer son panier si pas vide



                // attention client acheteur
                $monIdentifiant = $_SESSION['client']['idClient'];


                echo $monIdentifiant;
                $req_panier = $this->modele->get_panier($monIdentifiant);
                //si panier contient articles
                if($req_panier->num_rows > 0) {
                    //pour chaque article du panier
                    $panier = $req_panier->fetch_assoc();
                    for($i = 1; $i <= $req_panier->num_rows; $i++) {
                        $this->init->recupererPanier($panier['nom'], $panier['idArticle'], $panier['nbArticle'], $panier['montant']);
                    }
                }
            }
        }
        
    }


    function signaler(){
        $this->render("formulaire_aide");
    }

    function deconnexion(){
        session_destroy();
        $redirect = '<a href="../">Cliquer ici pour retourner à l\'accueil</a>'; 
        echo "vous êtes déconnecté $redirect";
    }

    function ajout_panier(){

        //ajouter article dans panier
        if(isset($_POST['ajouter_panier'])) {
            $resultat = $this->modele->ajouter_panier($_POST['idArticle']);
            $article = $resultat->fetch_assoc();
            $this->init->ajouterProduitDansPanier($article['nom'],$_POST['idArticle'],$_POST['nbArticle'],$article['prix']);
            echo("<meta http-equiv='refresh' content='1'>");
        }	

    }

    function vide_panier(){
        //si client veut vider son panier
        if(isset($_GET['action']) && $_GET['action'] == "vider") {
            unset($_SESSION['panier']);
            $monId = $_SESSION['client']['idClient'];
            $this->modele->vider_panier($monId);
            //header("location:panier.php?");
            // echo("<meta http-equiv='refresh' content='0'>");
        }
    }
        
        
    function valider_panier(){

        //si client a remplit les infos pour valider son panier et valide
        if(isset($_POST['valider_commande'])) {
            $fonction_sql->debug($_POST);
            $montant = $this->init->montantTotal();
            $monId = $_SESSION['client']['idClient'];
            if($_POST['livraison'] == "standard") {
                $jour = 7;
            }
            else {
                $jour = 3;
                $montant+=2;
            }


        $data = [
            '$montant' => $montant, 
            'num_ad' => $_POST['num_ad'], 
            'nom_rue' => $_POST['nom_rue'], 
            'cp_ad' => $_POST['cp_ad'], 
            'ville' => $_POST['ville'],
            'jour' => $jour,
            'id' => $monId
        ];

        $this->modele->inserer_infos_commande($data);
        header("location:panier.php?action=vider");

    }
    
    function panier_supprimer(){
        //si client desire supprimer un article
        if(isset($_GET['action']) && isset($_GET['id_article']) && $_GET['action']=="retirer") {
            $this->init->retirerProduitDuPanier($_GET['id_article']);
            echo("<meta http-equiv='refresh' content='1'>");
        }
    }

}
    
}