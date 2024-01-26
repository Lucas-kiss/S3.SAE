<?php
    session_start();

    if (isset($_POST['MdP']))
    {
        if (!preg_match('/[A-Z]/', $_POST['MdP']) || !preg_match('/[a-z]/', $_POST['MdP']) || !preg_match('/[0-9]/', $_POST['MdP']) || !preg_match('/[^a-zA-Z0-9]/', $_POST['MdP']))
        {
            echo "Mot de passe erroné, pensez à respecter la contrainte !";
        }
        else if ($_POST['MdP']!=$_POST['ConfirmMdP'])
        {
            echo "Veuillez reseigné le même mot de passe !";
        }
        else
        {
            $maildécoupé = explode('@', $_POST['mail']);

            if (substr($maildécoupé[0], 0) === '.' || substr($maildécoupé[0], -1) === '.' || count(explode('.', end($maildécoupé))) <= 1)
            {
                echo "Mail erroné, il faut un '.' après le '@' mais pas de '.' ni juste avant le '@' ni au tout début du mail !";
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
                else
                {*/ 
                    $_SESSION['mail']=$_POST['mail'];
                    $_SESSION['MdP']=$_POST['MdP'];

                    if ($_POST['Type']=="etudiant")
                    {
                        header ('location: FormulaireEtudiant.php');
                    }
                    else
                    {
                        header ('location: FormulaireEntreprise.php');
                    }
                //}
            }
            //$maildécoupé2 = explode('.', end($maildécoupé1));
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob</title>
    </head>
    <body>
        <H1>Inscription</H1>
        <form action="Inscription.php" method="POST">
            <table class="noborder">
                <tbody>
                    <tr>
                        <th class="noborder"><label for="Type">Je suis :</label></th>
                        <td class="noborder">
                            <input type="radio" id="etudiant" name="Type" value="etudiant" checked/><label for="etudiant">un étudiant</label>
                            <input type="radio" id="entreprise" name="Type" value="entreprise"/><label for="entreprise">une entreprise</label>
                        </td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="mail">Adresse e-mail :</label></th>
                        <td class="noborder"><input type="email" id="mail" name="mail" placeholder="exemple@domaine.fr" required/></td>
                    </tr>
                    <tr>
                        <th class="noborder">
                            <label for="MdP">Mot de passe :</label>
                        </th>
                        <td class="noborder">
                            <input type="password" id="MdP" name="MdP" minlength="8"  required/>
                        </td>
                    </tr>
                    <tr>
                        <td class="noborder"></td>
                        <td class="noborder"><label>8 caractères minimum, dont 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial</label></td>
                    </tr>
                    <tr>
                        <th class="noborder"><label for="ConfirmMdP">Confirmer le mot de passe :</label></th>
                        <td class="noborder"><input type="password" id="ConfirmMdP" name="ConfirmMdP" required/></td>
                    </tr>
                    <tr>
                        <td class="noborder"></td>
                        <td class="noborder"><input type="submit" value="Suivant"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </body>
</html>