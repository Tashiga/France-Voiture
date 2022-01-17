<?php

class Accueil extends Controleur{
    private $modele;

    function __construct(){
        
    }

    function accueil(){
        $this->render('accueil');
    }
}