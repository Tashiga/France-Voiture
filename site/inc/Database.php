<?php
abstract class Database{
    // infos BD
    private $dns = "mysql:host=localhost;dbname=FranceVoiture;";
    private $user = "root";
    private $password = "";

    // connexion à la BD
    protected $_connexion;

    public $table;
    public $id;

    function connexion_bd(){
        $this->_connexion = null;

        try{
            $this->_connexion = new PDO($this->dns, $this->user, $this->password);
            // sécuriser les transactions entre le client et le server
            $this->_connexion->exec('set names utf8');
        }
        catch(PDOException $e){
            echo 'Un problème est survenu lors de la tentative de connexion à la BDD :'.$e->getMessage();
        }
    }

    function executeRequete(){
        
    }
}