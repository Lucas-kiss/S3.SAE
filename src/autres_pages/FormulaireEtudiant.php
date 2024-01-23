<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob</title>
    </head>
    <body>
        <H1>Mes Inscriptions</H1>
        <form action="Inscription.php" method="POST">
            <table>
                <tbody>
                    <tr>
                        <th><label for="ine">Numéro INE : *</label></th>
                        <td><input type="text" id="ine" required/></td>
                    </tr>
                    <tr>
                        <th><label for="prenom">Prénom : *</label></th>
                        <td><input type="text" id="prenom" required/></td>
                    </tr>
                    <tr>
                        <th><label for="nom">Nom : *</label></th>
                        <td><input type="text" id="nom" required/></td>
                    </tr>
                    <tr>
                        <th><label for="naissance">Date de naissance : *</label></th>
                        <td><input type="date" id="naissance" required/></td>
                    </tr>
                    <tr>
                        <th><label for="adresse">Adresse postale : *</label></th>
                        <td><input type="text" id="adresse" required/></td>
                    </tr>
                    <tr>
                        <th><label for="ville">Ville : *</label></th>
                        <td><input type="text" id="ville" required/></td>
                    </tr>
                    <tr>
                        <th><label for="pays">Pays : *</label></th>
                        <td><input type="text" id="pays" required/></td>
                    </tr>
                    <tr>
                        <th><label for="telephone">Téléphone : *</label></th>
                        <td><input type="tel" id="telephone" pattern="[0]{1}[0-9]{9}" required/></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="notrobot" required/>
                            <label for="notrobot">Je ne suis pas un robot *</label>
                        </td>
                        <td>
                            <input type="reset" value="Réinitialiser" />
                            <input type="submit" value="S'inscrire">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <h6>* Champs obligatoire</h6>
    </body>
</html>