<?php
require_once(ROOT."modeles/Produit.php");

class Produits extends Controleur{
    private $modele;

    function __construct(){
        $this->modele = new Produit();
    }

    function new_article(){
        $this->render('upload');

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
        $this->render("prod_affichage", ['articles' => $articles]);
    }


    function suppression(){
        $this->modele->supprimer_produit();
    }

    
    function modification(){
        $this->modele->modifier_produit();
    }

}  