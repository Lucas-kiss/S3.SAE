<?php
    if (isset($_POST['MdP']))
    {
        if ($_POST['MdP']!=$_POST['ConfirmMdP'])
        {
            echo "Veuillez reseigné le même mot de passe";
        }
        else
        {
            /*$bdd = "ldbrito_bd";
            $host = "lakartxela.iutbayonne.univ-pau.fr";
            $user = "ldbrito_bd";
            $pass = "ldbrito_bd";
            $nomTable = "CD";

            $conn = mysqli_connect($host, $user, $pass, $bdd) or die ("Error de BDD");

            $select = mysqli_query($conn, "SELECT * FROM users WHERE email = '".$_POST['email']."'");
            
            if(mysqli_num_rows($select)) 
            {
                exit('Cette adresse email est déjà utilisé');
            }
            else*/ if ($_POST['Type']="etudiant")
            {
                header ('location: FormulaireEtudiant.php');
            }
            else
            {
                header ('location: FormulaireEtreprise.php');
            }
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
                        <th class="noborder">
                            <label for="MdP">Mot de passe :</label>
                        </th>
                        <td class="noborder">
                            <input type="password" id="MdP" name="MdP" minlength="8" required/>
                        </td>
                    </tr>
                    <tr>
                        <td class="noborder"></td>
                        <td class="noborder"><h6>8 caractères minimum, dont 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial</h6></td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="ConfirmMdP">Confirmer le mot de passe :</label></th>
                        <td class="noborder"><input type="password" id="ConfirmMdP" name="ConfirmMdP" required/></td>
                    </tr>
                    <tr>
                        <td class="noborder"></td>
                        <td class="noborder"><input type="submit" value="Se connecter"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </body>
</html>