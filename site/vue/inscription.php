<?php require_once("../inc/haut_site.php");
require_once("../inc/initialisation.php");

if($fonction_sql->utilisateurEstConnecte()){
    header("location:profil.php");
}
else {

//--------------------------------- AFFICHAGE HTML ---------------------------------//
 require_once("../inc/haut_site.php"); 

 ?>


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
 
<?php

}

 require_once("../inc/bas_site.php"); 
 
//--------------------------------------traitement php--------------------------------------------//


//detecte lorsque l'internaute clique sur le bouton pour s'inscrire
if($_POST)
{
    $fonction_sql->debug($_POST);

	if (empty($_POST["email"])) {
		$message = "<div class='erreur'>Entrez une adresse email valide.</div>";
	}
    else {

        //empecher que plusieurs utilisateur ont la meme adresse mail
        $membreClient = $fonction_sql->executeRequete("SELECT * FROM client WHERE email='$_POST[email]'");
        $membreVendeur = $fonction_sql->executeRequete("SELECT * FROM vendeur WHERE email='$_POST[email]'");
        if($membreClient->num_rows > 0 || $membreVendeur->num_rows > 0) {
            $message= "<div class='erreur'>Votre adresse email est déjà associé à un compte.</div>";
        }
        else {
            if($_POST["confmdp"]!=$_POST["mdp"]){
                $message= "<div class='erreur'>Veuillez bien confirmer votre mot de passe.</div>";
            }
            else {
                //pour les vendeurs
                if($_POST["estVendeur"]=='Yes') {
                    if(empty($_POST["raison_social"])) {
                        $message = "<div class='erreur'>Veuillez entrer votre raison social.</div>";
                    }
                    else {
                        foreach($_POST as $indice => $valeur)
                        {
                            $_POST[$indice] = htmlEntities(addSlashes($valeur));
                        }
                        $fonction_sql->executeRequete("INSERT INTO vendeur(nom, prenom, email, mdp, raison_social, civilite) VALUES ('$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[mdp]', '$_POST[raison_social]', '$_POST[civilite]')");
                        $message= "<div class='validation'>Inscription réussie pour vendeur.</div>";
                    }
                }
                //pour les clients
                else {
                        // $_POST['mdp'] = md5($_POST['mdp']);
                        foreach($_POST as $indice => $valeur)
                        {
                            $_POST[$indice] = htmlEntities(addSlashes($valeur));
                        }
                        $fonction_sql->executeRequete("INSERT INTO client(nom, prenom, email, mdp, civilite) VALUES ('$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[mdp]', '$_POST[civilite]')");
                        $message= "<div class='validation'>Inscription réussie.</div>";
                }
            }
            
        }
        
    }
    echo $message;
}

?>