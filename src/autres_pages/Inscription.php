<?php
    if (isset($_POST['MdP']))
    {
        if ($_POST['MdP']!=$_POST['ConfirmMdP'])
        {
            echo "Veuillez reseigné le même mot de passe";
        }
        else
        {
            
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob</title>
        <link rel="stylesheet" href="../style_demo.css">
    </head>
    <body>
        <H1>Inscription</H1>
        <form action="Inscription.php" method="POST">
            <table class="noborder">
                <tbody>
                    <tr>
                        <th class="noborder"><legend>Je suis :</legend></th>
                        <td class="noborder">
                            <input type="radio" id="etudiant" name="Type" value="etudiant" checked/><label for="etudiant">un étudiant</label>
                            <input type="radio" id="entreprise" name="Type" value="entreprise"/><label for="entreprise">une entreprise</label>
                        </td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="mail">Adresse e-mail :</label></th>
                        <td class="noborder"><input type="email" id="mail" name="mail" required/></td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="MdP">Mot de passe :</label></th>
                        <td class="noborder"><input type="password" id="MdP" name="MdP" required/></td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="ConfirmMdP">Confirmer le mot de passe :</label></th>
                        <td class="noborder"><input type="password" id="ConfirmMdP" name="ConfirmMdP" required/></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="Se connecter">
        </form>
    </body>
</html>