<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
 require_once("../inc/haut_site.php"); 
 require_once("../inc/initialisation.php");
 ?>

<form method="post" action="">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="votre pseudo" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required"><br><br>
          
    <label for="mdp">Mot de passe</label><br>
    <input type="password" id="mdp" name="mdp" required="required"><br><br>

    <label for="mdp">Confirmation mot de passe</label><br>
    <input type="password" id="confmdp" name="mdp" required="required"><br><br>
          
    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" placeholder="exemple@gmail.com"><br><br>
          
    <label for="civilite">Civilité</label><br>
    <input name="civilite" value="m" checked="" type="radio">Homme
    <input name="civilite" value="f" type="radio">Femme<br><br>
                  
    <input type="submit" name="inscription" value="S'inscrire">
</form>
 
<?php require_once("../inc/bas_site.php"); ?>