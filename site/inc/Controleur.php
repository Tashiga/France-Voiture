<?php
require_once(ROOT."inc/initialisation.php");

abstract class Controleur{
    function charge_modele(string $modele){
        require_once(ROOT.'modeles/'.$modele.'.php');
        $this->$modele = new $modele();
    }

    function render(string $fichier){
        require_once(ROOT.'vues/'.$fichier.'.php');
    }
}