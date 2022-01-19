<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once(ROOT."inc/initialisation.php");
require_once("menu_profil.php"); ?>

    <article id="afficher_message">
        <!-- afficher tous les users possedant un compte a gauche -->
        <div id="menu_personnes">
            <h3 class="titre_personnes">Acheteurs</h3>   
            <?php 
            //while($nomClient=$acheteurs->fetch_assoc()){
            foreach($acheteurs as $nomClient):
                echo '<a class="bouton_perosnne" href="index.php?ctrl=messagerie&amp;action=contacter&amp;id='.$nomClient['idClient'].'&statut=0">'.$nomClient['nom'].'</a>';
                echo '</br>';
            endforeach;
            //}
            ?>
            <h3 class="titre_personnes">Vendeurs</h3>
            <?php
            //while($nomVendeur=$vendeurs->fetch_assoc()){
            foreach($vendeurs as $nomVendeur):
                echo '<a class="bouton_perosnne" href="index.php?ctrl=messagerie&amp;action=contacter&amp;id='.$nomVendeur['idVendeur'].'&statut=1">'.$nomVendeur['nom'].'</a>';
                echo '</br>';
            endforeach;
            //}
            ?>
        </div>

        

    <?php

    //creer Probleme : car $_GET['statut] donne toujours 0 
    // if(!isset($_GET['id'])) {
    //     $_GET['id'] = '1';
    // }
    // if(!isset($_GET['satut'])) {
    //     $_GET['statut'] = '0';
    // }


    ?>

