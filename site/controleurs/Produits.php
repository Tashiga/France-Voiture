<?php
require_once(ROOT."modeles/Produit.php");

class Produits extends Controleur{
    private $modele;

    function __construct(){
        $this->modele = new Produit();


        if (isset($_GET['action'])){
            $action = $_GET['action'];
        
            $_GET['id_article'] = isset($_GET['id_article']) ?: NULL;
        
            switch($action){
                case "modification":
                    $this->modification($_GET['id_article']);
                    break;
                case "suppression":
                    $this->suppression($_GET['id_article']);
                    break;
                default:
                    echo "cette action n'existe pas -Produit";
                    header("location:".ROOT."");
            }
        }
    }

    function new_article(){
        $this->render('prod/upload');

        if($_POST) {
            $dossier = ROOT.'photos_articles/';
            $taille_maxi = 1000000000;
            $taille = filesize($_FILES['avatar']['tmp_name']);
            $extensions = array('.png', '.gif', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['avatar']['name'], '.'); 
            //Si l'extension n'est pas dans le tableau
            if(!in_array($extension, $extensions)) {
                $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
            }
            //si taille du fichier grande
            if($taille>$taille_maxi) {
                $erreur = 'Le fichier est trop gros...';
            }
            //S'il n'y a pas d'erreur
            if(!isset($erreur)) {
                // $fonction_sql->debug($_FILES);
                //on donne tous es acces au dossiers d'images
                chmod($dossier, 777);
                $fichier =  $_POST['nom_article'].$extension;
                //On essaye de deplacer le fichier dans notre repertoire
                //si cela nous donne FALSE, cela n'a pas fonctionne.
                if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) {
                    echo '<p class="erreur">Echec de l\'upload !</p>';
                    echo "Not uploaded because of error #".$_FILES["avatar"]["error"];
                }
                //Sinon (fichier deplace correctement).
                else {
                    //permet d'inserer les apostrophes etc... correctement
                    foreach($_POST as $indice => $valeur) {
                        $_POST[$indice] = htmlEntities(addSlashes($valeur));
                    }
                    $data = [
                        'nom_article' => $_POST['nom_article'],
                        'prix_article' => $_POST['prix_article'],
                        'description_article' => $_POST['description_article'],
                        'stock_article' => $_POST['stock_article'],
                        'categorie_article' => $_POST['categorie_article'],
                        'idVendeur' => $_SESSION['client']['idVendeur']
                    ];
                    $this->modele->ajouter_produit($data);
                    $this->modele->ajouter_photo($dossier, $fichier, $data);
                    echo '<p class="validation">Votre article a été ajouté avec succés !</p>';
                }
            }
            else {
                 echo '<p class="erreur">Une erreur est survenu lors de votre insertion !</p>';
            }
        }
    }

    function affichage(){
        $articles = $this->modele->get_produits();
        #$chemin = $this->modele->get_photo();
        $this->render("prod/affichage_liste", ['articles' => $articles]);
    }


    function suppression($id){
        $this->modele->supprimer_produit($id);
        $redirect = '<a href="./produits/affichage">Cliquer ici</a>'; 
        echo "Suppression ok $redirect";
    }

    
    function modification($id){
        $resultat = $this->modele->select_where_idArticle('article', $id);

        $affichage = $this->modele->select_where_idArticle('affiche', $id);
        $chemin_photo_a_supprimer = NULL;
        while($autre = $affichage->fetch_assoc()) {
            //$chemin_photo_a_supprimer = $this->modele->select_photo($autre['idPhoto']);
        }
        $this->render("prod/update", ['resultat' => $resultat, 'affichage' => $affichage, 'chemin_photo_a_supprimer' => $chemin_photo_a_supprimer]);
        //si vendeur veut modifier article
        if($_POST) {
            // $fonction_sql->debug($_FILES);
            $data = [
                'nom_article' => $_POST['nom_article'],
                'prix_article' => $_POST['prix_article'],
                'description_article' => $_POST['description_article'],
                'stock_article' => $_POST['stock_article'],
                'categorie_article' => $_POST['categorie_article'],
                'image_article' => $_FILES['image_article'],
            ];

            if(!empty($_POST['nom_article'])) {
                $this->modele->modifier_produit_nom($id, $data);
                echo '<p class = validation>validation ok pour '.$data['nom_article'].'</p>';
            }
            if(!empty($_POST['prix_article'])) {
                $this->modele->modifier_produit_prix($id, $data);
                echo '<p class = validation>validation ok pour '.$_POST['prix_article'].'</p>';
            }
            if(!empty($_POST['description_article'])) {
                $this->modele->modifier_produit_description($id, $data);
                echo '<p class = validation>validation ok pour '.$_POST['description_article'].'</p>';
            }
            if(!empty($_POST['stock_article'])) {
                $this->modele->modifier_produit_stock($id, $data);
                echo '<p class = validation>validation ok pour '.$_POST['stock_article'].'</p>';
            }
            if(!empty($_POST['categorie_article'])) {
                $this->modele->modifier_produit_categorie($id, $data);
                echo '<p class = validation>validation ok pour '.$_POST['categorie_article'].'</p>';
            }
            if(!empty($_FILES['image_article'])) {
                $nom_article = $this->modele->get_nom_produit($id);
                $nom_article = $nom_article->fetch_assoc();
                // $fonction_sql->debug($nom_article['nom']);
                echo '<p class="validation">' .$nom_article['nom'].'</p>';
                $dossier = ROOT.'img/photos_articles/';
                $taille_maxi = 1000000000;
                $taille = filesize($_FILES['image_article']['tmp_name']);
                $extensions = array('.png', '.gif', '.jpg', '.jpeg');
                $extension = strrchr($_FILES['image_article']['name'], '.'); 
                //Si l'extension n'est pas dans le tableau
                if(!in_array($extension, $extensions)) {
                    $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
                }
                //si taille du fichier grande
                if($taille>$taille_maxi) {
                    $erreur = 'Le fichier est trop gros...';
                }
                //S'il n'y a pas d'erreur
                if(!isset($erreur)) {
                    $fichier =  $nom_article['nom'].$extension;
                    //On essaye de deplacer le fichier dans notre repertoire
                    //si cela nous donne FALSE, cela n'a pas fonctionne.
                    if(!move_uploaded_file($_FILES['image_article']['tmp_name'], $dossier . $fichier)) {
                        echo '<p class="erreur">Echec de l\'upload !</p>';
                        echo "Not uploaded because of error #".$_FILES["image_article"]["error"];
                    }
                    else {
                        $this->modele->modifier_produit_image($id, $dossier, $fichier);
                        echo '<p class = validation>validation ok pour files.</p>';
                    }
                }
            }
            echo("<meta http-equiv='refresh' content='1'>");
        }
    }


  



}