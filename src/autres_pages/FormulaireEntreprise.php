<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob - Inscription Entreprise</title>
        <link rel="stylesheet" href="../style_demo.css">
    </head>
    <body>
        <H1>Inscription</H1>
        <form action="Inscription.php" method="POST">
            <table class="noborder">
                <tbody>
                    <tr>
                        <th class="noborder"><label for="siren">Numéro SIREN :</label></th>
                        <td class="noborder"><input type="text" id="siren" pattern="[12]{1}[0-9]{8}" title="9 Chiffres qui commence par 1 ou 2" placeholder="123456789" required/> *</td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="nom">Nom de l'entreprise :</label></th>
                        <td class="noborder"><input type="text" id="nom" placeholder="E.Leclerc" required/> *</td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="domaine">Domaine d'activité :</label></th>
                        <td class="noborder"><input type="text" id="domaine" placeholder="Grande distribution" required/> *</td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="adresse">Adresse postale :</label></th>
                        <td class="noborder"><input type="text" id="adresse" placeholder="123, Rue des chênes" required/> *</td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="ville">Ville :</label></th>
                        <td class="noborder"><input type="text" id="ville" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="Anglet" required/> *</td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="pays">Pays :</label></th>
                        <td class="noborder"><input type="text" id="pays" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="France" required/> *</td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="telephone">Téléphone :</label></th>
                        <td class="noborder"><input type="tel" id="telephone" pattern="[0]{1}[0-9]{9}" title="Numéro à 10 Chiffres qui commance par 0" placeholder="0612345789" required/> *</td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="nomResp">Nom du responsable :</label></th>
                        <td class="noborder"><input type="text" id="nomResp" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="Xavier" required/> *</td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="telResp">Téléphone du responsable :</label></th>
                        <td class="noborder"><input type="tel" id="telResp" pattern="[0]{1}[0-9]{9}" title="Numéro à 10 Chiffres qui commance par 0" placeholder="0612345789" required/> *</td>
                    </tr>
                    <tr>
                        <td class="noborder">
                            <input type="checkbox" id="notrobot" required/>
                            <label for="notrobot">Je ne suis pas un robot *</label>
                        </td>
                        <td class="noborder">
                            <input type="reset" value="Réinitialiser" />
                            <input type="submit" value="S'inscrire">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <h6>* Champs obligatoires</h6>
    </body>
</html>