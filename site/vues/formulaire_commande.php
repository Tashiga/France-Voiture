<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once(ROOT."inc/haut_site.php");  
?>

    <main>
        <section id="sectionCommande" >
            <form action = "panier.php" method="POST">
                <h2>Validation de votre commande</h2>
                <hr>
                <label class="to_bold" for="num_ad">Votre adresse : </label>
                <input type="number" name="num_ad" min="1" max="999" placeholder="n° rue" required="required" ></input>
                <input type="text" name="nom_rue" placeholder="nom de rue" required="required" ></input>
                <input id="" type="number" name="cp_ad" style="width:150px;" required="required" min="10000" max="99999" placeholder="code postal"></input>
                <input type="text" name="ville" placeholder="votre ville" required="required" ></input>
                <fieldset> 
                    <legend id="mettre_gras" for="livraison">Type de livraison : </legend>
                    <input type="radio" name="livraison" value="standard" checked>Livraison standard : dans 7 jours
                    </br>
                    <input type="radio" name="livraison" value="express">Livraison Express : dans 3 jours (+2 euros)
                </fieldset>
                <fieldset> 
                    <legend id="mettre_gras" for="livraison">Paiement : </legend>
                    <label class="to_bold" for="num_carte">Votre n° carte bancaire : </label>
                    <input type="number" name="num_carte" min="1" max="99999999999" placeholder="n° carte" required="required" ></input>
                    </br>
                    <label class="to_bold" for="date_carte_jour">Date d'expiration : </label>
                    <input type="number" name="date_carte_jour" min="1" max="12" placeholder="mois" required="required" ></input>
                    <input type="number" name="num_carte_mois" min="2022" max="2030" placeholder="annee" required="required" ></input>
                    </br>
                    <label class="to_bold" for="cp_carte">Code de verification : </label>
                    <input type="number" name="cp_carte" min="1" max="999" placeholder="code" required="required" ></input>
                </fieldset>


                <input type="submit" name="valider_commande" value="Valider la commande">
                <hr>
            </form>
            </section>
    </main>
<?php require_once(ROOT."inc/bas_site.php"); ?> 