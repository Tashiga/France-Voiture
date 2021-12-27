<?php 
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("../inc/initialisation.php");
require_once("../inc/haut_site.php"); 
?>
		  <main style="height:auto; padding:50px; padding-top:10px; padding-bottom:10px">
            <section id="sectionFormulaire">
                <form action="">
                    <table style="border: 1px solid #333;">
                        <thead style="background-color: #333;color: #fff">
                            <tr>
                                <th colspan="2">Formulaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style=" text-align:center">
                                <label for="sujet">sujet</label><br>
                                </td>
                                <td style=" text-align:center">
                                    <select name="sujet">
                                        <option>Je n'ai pas encore reçu mon article</option>
                                        <option>Mon article est endommagé</option>
                                        <option>Je souhaite demander un remboursement</option>
                                        <option>J'ai un problème avec le vendeur</option>
                                        <option>Autres</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center">si vous avez choisi Autres, merci de nous indiquer ici : </td>
                                <td style="text-align:center"><input type="text" name="autreSujet" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="autre sujet"/></td>
                            </tr>
                            <tr>
                                <td style="text-align:center">S'il s'agit d'une commande, votre adresse de livraison est-elle correcte ? </td>
                                <td style="text-align:center">
                                    <input type="radio" name="identifieur" value="true" checked>Oui
                                    <input type="radio" name="identifieur" value="false">Non
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center">Votre adresse de livraison est incorrecte ? Veuillez nous donner votre adresse correcte : </td>
                                <td style="text-align:center"><input type="text" name="autreSujet" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="adresse si incorrecte"/></td>
                            </tr>
                            <tr>
                                <td style="text-align:center">Veuillez nous décrire le problème que vous rencontrez ici : </td>
                                <td style="text-align:center"><textarea name="textarea" widht="1000" placeholder="problème"></textarea></td>
                            </tr>
                            <tr>
                                <td style="text-align:center">Veuillez nous laisser un numéro de téléphone sur lequelle nous pouvons vous joindre : </td>
                                <td style="text-align:center"><input type="tel" name="phone" size="10" maxlength="10" pattern=“” placeholder="n`Telephone"/></td>
                            </tr>
                        </tbody>
                    </table>
                    
						<!-- mail -->
						<input type="email" name="mail" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="E-mail"/>
						<!-- mot de passe -->
						<input type="password" name="password" size="33" maxlength="50" pattern=“[A-Za-Z0-9]{5}” placeholder="Mot de passe"/>
						<div id="">
							<input type="checkbox" name="vendeur" />
							<p>Je suis un vendeur</p>
						</div>
						<button name="Connexion" type="submit">Envoyer le formulaire</button>
					</div> 
					
				</form >
            </section>
		</main>
		
<?php require_once("../inc/bas_site.php"); ?>