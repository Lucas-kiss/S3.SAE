<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob</title>
    </head>
    <body>
        <H1>Connexion</H1>
        <form action="idk.php" method="POST">
            <table class="noborder">
                <tbody>
                    <tr>
                        <th class="noborder"><label for="mail">Adresse e-mail :</label></th>
                        <td class="noborder"><input type="email" id="mail" placeholder="exemple@domaine" required/></td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="MdP">Mot de passe :</label></th>
                        <td class="noborder"><input type="password" id="MdP" required/></td>
                    </tr>
                    <tr>
                        <td class="noborder"></td>
                        <td class="noborder">
                            <a>Mot de passe oublié ?</a></br>
                            Pas de compte ? <a href="Inscription.php">S'inscrire</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="noborder">
                            <input type="checkbox" id="notrobot" required/>
                            <label for="notrobot">Je ne suis pas un robot</label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="Se connecter">
        </form>
    </body>
</html>