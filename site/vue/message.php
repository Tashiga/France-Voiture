<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");

require_once("menu_profil.php");


?>
<script>

</script>
<article id="afficher_message">
    <div id="menu_personnes">
            <h3 class="titre_personnes">Clients</h3>
            <?php
            $result1 = $fonction_sql->executeRequete("select * from client");
            while($nomClient = $result1->fetch_assoc()) {
                echo '<a class="bouton_perosnne" href="message.php?id='.$nomClient['idClient'].'&statut=0">'.$nomClient['nom'].'</a>';
            }
            ?>
        </br>
            <h3 class="titre_personnes">Vendeurs</h3>
            <?php
            $identifiant =  $_SESSION['client']['idVendeur'];
            $result2 = $fonction_sql->executeRequete("select * from vendeur where idVendeur!= $identifiant");
            while($nomVendeur = $result2->fetch_assoc()) {
                echo '<a class="bouton_perosnne" href="message.php?id='.$nomVendeur['idVendeur'].'&statut=1">'.$nomVendeur['nom'].'</a>';
            }
            ?>
    </div>

    <?php
    if(!isset($_GET['id'])) {
        $_GET['id'] = '1';
    }
    if(!isset($_GET['satut'])) {
        $_GET['statut'] = 0;
    }

    if(isset($_GET['id']) && isset($_GET['statut'])) {
    ?> 
    <div id="envoyer_message">

        <!-- afficher la discussion -->
        <div id="" style="">
            <?php
                $id_destinateur = $_GET['id'];
                $statut = $_GET['statut'];
                $tousMessageEnvoye = $fonction_sql->executeRequete("SELECT * from envoyer_un_message where (idDestinateur = $id_destinateur and idExpediteur = $identifiant) or (idDestinateur = $identifiant and idExpediteur = $id_destinateur)");
                while($messagesEnvoye = $tousMessageEnvoye->fetch_assoc()){
                    //si ce message lui a ete destine
                    
                    if($messagesEnvoye['idDestinateur'] == $identifiant) {
                        echo '<div class="div_recu">';
                        echo '<p class = "recu" >'.$messagesEnvoye['message'].'</p>';
                        echo '<p class = "ind_recu">le '.$messagesEnvoye['dateEnvoye'].' à '.$messagesEnvoye['tpsEnvoye'].'</p>';
                        echo '</div>';
                    }
                    //si c'est lui qui a envoye le message
                    else {
                        echo '<div class="div_envoye">';
                        echo '<p class = "envoye" >'. $messagesEnvoye['message'].'</p>';
                        echo '<p class = "ind_envoye">le '.$messagesEnvoye['dateEnvoye'].' à '.$messagesEnvoye['tpsEnvoye'].'</p>';
                        echo '</div>';
                    }

                }
            ?>
        </div>

        <!-- afficher formulaire pour envoyer message -->
        <div id="">
            <form id="form_message" method="POST" action="">
                <textarea id="textarea_message" placeholder="votre message"  cols=105 rows=3 name="message"></textarea> <!-- message de l'utilisateur -->
                <input id="bouton_message" type="submit" name="envoyer"> <!-- créer la table message pour pouvoir en envoyer -->
            </form>
        </div>

    </div>
    <?php

    }
    ?>

</article>

<?php

if($_POST){
    // echo '<div id="" style="position:absolute">';
    // $fonction_sql->debug($_POST);
    $identifiant = $_SESSION['client']['idVendeur'];
    // echo '<p class="validation">'.$identifiant.'</p>';
    $date = date('d-m-y');
    $temps = date("H:i:s");
    $messageFormulaire = $_POST[message];
    $fonction_sql->executeRequete("INSERT into envoyer_un_message (idExpediteur, idDestinateur, statut, message, dateEnvoye, tpsEnvoye)
     values($identifiant, $id_destinateur, '$statut', '$messageFormulaire', '$date', '$temps' )");
    echo '<p class="validation">votre message a ete envoye avec succes !</p>';
    echo("<meta http-equiv='refresh' content='1'>");
    // echo '</div>';
}

?>