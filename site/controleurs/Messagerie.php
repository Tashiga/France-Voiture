<?php
require_once(ROOT."modeles/Message.php");

class Messagerie extends Controleur{
    private $modele;
    private $vue;

    function __construct(){
        $this->modele = new Message();
        //$this->vue = new Vue_messagerie();

        $this->discussions();
        if(isset($_GET['action'])){
            $action = $_GET['action'];

            switch($action){
                case"contacter":
                    if(isset($_GET['id']) && isset($_GET['statut'])) {
                        $this->afficher_conversation();
                    }
                    break;
                default:
                    echo"cette action n'existe pas messagerie";
            }
        }
        
    }

    function discussions(){
        $vendeurs = $this->modele->get_vendeurs();
        $acheteurs = $this->modele->get_acheteurs();
        $this->render('messagerie', ['vendeurs'=>$vendeurs, 'acheteurs'=>$acheteurs]);
        //$this->vue->afficher_contacts($vendeurs, $acheteurs);
        
    }


    function afficher_conversation(){
    
        $id_destinataire = $_GET['id'];
        $identifiant = $this->get_id();

        $tousMessageEnvoye = $this->modele->get_conversation($id_destinataire, $identifiant);
        $this->render('discussion', ["tousMessageEnvoye" => $tousMessageEnvoye, "identifiant" => $identifiant]);
        if($_POST){
            $this->envoi_message($identifiant, $id_destinataire);
        }
    } 
    

    function envoi_message($id_exp, $id_dest){

        if(!empty($_POST['message'])){
            $data = [
                "id" => $id_exp,
                "id_dest" => $id_dest,
                "statut_dest" => $_GET['statut'],
                "mon_statut" => $_SESSION['client']['statut'],
                "date" => date('d-m-y'),
                "temps" => date("H:i:s"),
                "msg" => $_POST['message']
            ];
            
            $this->modele->envoyer_message($data);
            echo '<p class="validation">votre message a ete envoye avec succes ! </p>';
            echo("<meta http-equiv='refresh' content='1'>");
        }
        else {
            echo '<p class="erreur"> pas de message </p>';
        }
        
    }



    private function get_id(){
        if($_SESSION['client']['statut']==1){
            $identifiant = $_SESSION['client']['idVendeur'];
        }
        else {
            $identifiant = $_SESSION['client']['idClient'];
        }
        return $identifiant;
    }
       

}
?>