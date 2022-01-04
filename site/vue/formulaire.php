<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("../inc/haut_site.php"); 
?>
		  <main style="height:auto;">
            <section id="sectionFormulaire" >
                <form action="">
                    <table style="border-radius:5px; width:100%; background-color:#d6d6d6;">
                        <thead style="background-color:#1E2754; color:white;">
                            <tr>
                                <th colspan="2" style="padding:10px;">Formulaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding:5px; padding-top:20px; padding-left:20px; text-align:start; width:50%">
                                    <label for="sujet">Sujet du formulaire :  </label></br>
                                </td>
                                <td style="padding:5px; padding-top:20px; padding-right:20px;">
                                    <select id="sujet" placeholder="autre sujet" required="required">
                                        <option value="" disabled selected>-------------- choisir un option --------------</option>
                                        <option value="non-recu">Je n'ai pas encore reçu mon article </option>
                                        <option value="endommange">Mon article est endommagé </option>
                                        <option value="remboursement">Je souhaite demander un remboursement </option>
                                        <option value="probleme-vendeur">J'ai un problème avec le vendeur </option>
                                        <option value="autre">Autre </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:5px; padding-left:20px;">
                                    <label for="autre-sujet">Si vous avez choisi "autres", merci de nous indiquer ici :</label></br>
                                </td>
                                <td style="padding:5px; padding-right:20px;">
                                    <input type="text" name="autre-sujet" size="60" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="autre sujet" style="text-align:center" />
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:5px; padding-left:20px;">
                                    <label for="verif-adresse">S'il s'agit d'une commande, votre adresse de livraison est-elle correcte ?</label></br> 
                                </td>
                                <td style="padding:5px; padding-right:20px;">
                                    <input type="radio" name="verif-adresse" value="true"  checked>Oui
                                    <input type="radio" name="verif-adresse" value="false">Non
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:5px; padding-left:20px;">
                                    <label for="nouvelle-adresse">Si adresse de livraison est incorrecte, veuillez nous donner votre adresse correcte : </label></br>
                                </td>
                                <td style="padding:5px; padding-right:20px;">
                                    <input type="text" name="nouvelle-adresse" size="100" maxlength="90" pattern=“[A-Za-Z0-9]{5}” placeholder="adresse si incorrecte" style="text-align:center" />
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:5px; padding-left:20px;">
                                    <label for="probleme">Veuillez nous décrire le problème que vous rencontrez ici : </label></br>
                                </td>
                                <td style="padding:5px; padding-right:20px;">
                                    <textarea name="probleme" rows="5" cols="87" placeholder="votre message" required="required"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:5px; padding-left:20px;">
                                    <label for="telephone">Veuillez nous laisser un numéro de téléphone sur lequelle nous pouvons vous joindre : </label></br>
                                </td>
                                <td style="padding:5px; padding-right:20px;">
                                    <input type="tel" name="telephone" size="33" maxlength="10" pattern="[0]{1}[0-9]{9}" placeholder="télèphone" style="text-align:center" required="required"/>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:5px; padding-left:20px;">
                                    <label for="mail">Veuillez saisir votre mail : </label></br>
                                </td>
                                <td style="padding:5px; padding-right:20px;">
                                    <input type="email" name="mail" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="e-mail" style="text-align:center" required="required"/>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:5px; padding-left:20px;">
                                    <label for="condition">J'accepte les conditions et souhaite être contacté par mail ou par Telephone</label>
                                </td>
                                <td style="padding:5px; padding-right:20px;"> 
                                    <input type="checkbox" name="condition" required="required" />
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:5px; padding-left:20px;">
                                    <label for="fichier">Inserez un fichier, si vous le souhaitez : </label>
                                </td>
                                <td style="padding:5px; padding-right:20px;"> 
                                    <input type="file" name="fichier"/>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="padding:5px; padding-right:20px; padding-bottom:20px;"> 
                                    <button name="retour" type="submit" style="float:right;margin:5px;padding:5px;box-shadow: 10px 5px 5px #8f8b8b;background-color:#1E2754"><a href="accueil.php" style="text-decoration:none; color:white">Retour à l'accueil</a></button>
                                    <button name="valider-formulaire" type="submit" style="float:right;color:white;margin:5px;padding:5px;box-shadow: 10px 5px 5px #8f8b8b; background-color:#1E2754">Envoyer le formulaire</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                                 
					
						
					</div> 
					
				</form >

            </section>
		</main>
		
<?php require_once("../inc/bas_site.php"); ?>