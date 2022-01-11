<?php require_once("../inc/haut_site.php"); ?>

<main style="height:120%; background-color:#e4e4e4">
    <section id="sectionInscription">
        <h1>Inscription</h1>
        <form method="post" action="">
            <label class="contenu" for="nom">Nom</label><br>
            <input type="text" class="aRemplir" id="nom" name="nom" maxlength="24" placeholder="votre nom" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required" /></br>
            </br>

            <label class="contenu" for="email">E-mail</label><br>
            <input type="email" class="aRemplir" id="email" name="email" placeholder="exemple@gmail.com" required="required"/></br>
            </br>

            <label class="contenu" for="mdp">Mot de passe</label><br>
            <input type="password" class="aRemplir" id="mdp" name="mdp" placeholder="votre mot de passe" required="required"/></br>
            </br>
            

            <label class="contenu" for="mdp">Confirmation mot de passe</label><br>
            <input type="password" class="aRemplir" id="confmdp" name="confmdp" placeholder="ressaisir votre mot de passe" required="required" /></br>
            </br>

            <!-- <label class="contenu" for="civilite">Civilité :</label></br>
            <input name="civilite" value="M" checked="" type="radio"/>Homme
            <input name="civilite" value="Mme" type="radio"/>Femme</br></br>

            <label class="contenu" for="estVendeur">Êtes-vous un vendeur ?</label></br>
            <input name="estVendeur" value="Yes" checked="" type="radio"/>Oui
            <input name="estVendeur" value="No" type="radio" />Non</br>
            
            </br>
            <label class="contenu" for="raison_social">Si vous êtes un vendeur, merci de nous indiquer votre raison social :</label><br>
            <input type="text" class="aRemplir" id="raison_social" name="raison_social" maxlength="20" placeholder="votre raison social" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required"/></br> 
            
            
            <label for="mdp">Mot de passe</label><br>
            <input type="password" id="mdp" name="mdp" required="required"><br><br>

            <label for="mdp">Confirmation mot de passe</label><br>
            <input type="password" id="confmdp" name="confmdp" required="required"><br><br> -->
                
            <label for="VendeurAcheteur">Vendeur ou Acheteur ?</label><br>
            <input type="radio" name="VendeurAcheteur" value="vendeur" checked="" >Je souhaite vendre<br>
            <input type="radio" name="VendeurAcheteur" value="acheteur" >Je souhaite acheter<br><br>

                        
            <input type="submit" id="boutonInscription" name="inscription" value="S'inscrire"/>
        </form>
    </section>
</main>
 
<?php require_once("../inc/bas_site.php"); ?>