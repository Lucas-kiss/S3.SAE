<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob - Inscription Etudiant</title>
        <link rel="stylesheet" href="../style_demo.css">
    </head>
    <body>
        <H1>Inscription</H1>
        <form action="Inscription.php" method="POST">
            <table class="noborder">
                <tbody>
                    <tr>
                        <th class="noborder"><label for="ine">Numéro INE :</label></th>
                        <td class="noborder"><input type="text" id="ine" pattern="[0-9]{9}[0-9A-Z]{1}[A-Z]{1}" title="9 Chiffres + 2 Lettres ou 10 Chiffres + 1 Lettre" placeholder="123456789AB" required/> *</td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="prenom">Prénom :</label></th>
                        <td class="noborder"><input type="text" id="prenom" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="Xavier" required/> *</td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="nom">Nom :</label></th>
                        <td class="noborder"><input type="text" id="nom" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="Dupont" required/> *</td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="naissance">Date de naissance :</label></th>
                        <td class="noborder"><input type="date" id="naissance" required/> *</td>
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