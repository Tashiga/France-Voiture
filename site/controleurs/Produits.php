<?php
require_once(ROOT."modeles/Produit.php");

class Produit{
    private $modele;

    function __construct(){
        $this->modele = new Produit();
    }

    function suppression(){
        $this->modele->supprimer_article();
    }

}  