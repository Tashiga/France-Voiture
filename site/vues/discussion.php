<?php require_once("messagerie.php"); ?>


<!-- afficher la discussion -->
    <div id="envoyer_message">
        <?php
        if(isset($_GET['action']) && isset($_GET['id']) && isset($_GET['statut'])) {
            //while($messagesEnvoye=$tousMessageEnvoye->fetch_assoc()){
            foreach($tousMessageEnvoye as $messagesEnvoye):
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
            endforeach;
        ?>

        <!-- afficher formulaire pour envoyer message -->
        <div id="">
            <form id="form_message" method="POST" action="">
                <textarea id="textarea_message" placeholder="votre message"  cols=105 rows=3 name="message"></textarea> <!-- message de l'utilisateur -->
                <input id="bouton_message" type="submit" name="envoyer"> <!-- créer la table message pour pouvoir en envoyer -->
            </form>
        </div>

    </article>
    <?php 
    } 
?>