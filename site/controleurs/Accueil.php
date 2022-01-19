<?php

class Accueil extends Controleur{
    private $modele;

    function __construct(){
        
    }

    function accueil(){
        $this->render('accueil');
    }

    function aide(){
        $this->render('aide');
    }

    function contact(){
        $this->render('contact');
    }

    function apropos(){
        $this->render('apropos');
    }
}