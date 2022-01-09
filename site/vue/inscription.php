<?php require_once("../inc/haut_site.php"); ?>

<main>

    <div class="formConnexionInscription"> 
        <h1 class="titrePage">Inscription</h1>
        <form method="post" action="">
            <label for="pseudo">Pseudo</label><br>
            <input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="votre pseudo" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required"><br><br>
                
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="exemple@gmail.com"><br><br>
            
            <label for="mdp">Mot de passe</label><br>
            <input type="password" id="mdp" name="mdp" required="required"><br><br>

            <label for="mdp">Confirmation mot de passe</label><br>
            <input type="password" id="confmdp" name="confmdp" required="required"><br><br>
                
            <label for="VendeurAcheteur">Vendeur ou Acheteur ?</label><br>
            <input type="radio" name="VendeurAcheteur" value="vendeur" checked="" >Je souhaite vendre<br>
            <input type="radio" name="VendeurAcheteur" value="acheteur" >Je souhaite acheter<br><br>
                        
            <input type="submit" name="inscription" value="S'inscrire">
        </form>
    </div>

</main>
 
<?php require_once("../inc/bas_site.php"); ?>