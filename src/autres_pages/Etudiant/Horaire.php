<?php
    session_start();
    if (isset($_POST['ine']))
    {
        $_SESSION['ine']=$_POST['ine'];
        $_SESSION['prenom']=$_POST['prenom'];
        $_SESSION['nom']=$_POST['nom'];
        $_SESSION['naissance']=$_POST['naissance'];
        $_SESSION['adresse']=$_POST['adresse'];
        $_SESSION['ville']=$_POST['ville'];
        $_SESSION['pays']=$_POST['pays'];
        $_SESSION['telephone']=$_POST['telephone'];
        $_SESSION['CP']=$_POST['CP'];
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob - Inscription Etudiant</title>
        <link rel="stylesheet" href="../Internaute/style.css">
    </head>
    <body>
        <form action="Insert.php" method="POST">
            <table class="blackBorder tableHoraire">
                <tbody>
                <?php
                    $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
                    echo "  <tr>
                                <th>
                                    <label>Jour</label>
                                </th>";

                    for ($i = 0; $i < 24; $i++)
                    {
                        echo "  <th class='blackBorder'>
                                    <label>$i h</label>
                                </th>";
                    }
                    
                    echo "  </tr>";

                    foreach ($jourSem as &$jour)
                    {
                        echo    "<tr class='noPadding'>";
                        echo        "<th class='blackBorder noPadding thJour'>";
                        echo            "<label>$jour</label>";
                        echo        "</th>";

                        for ($i = 0; $i < 24; $i++)
                        {
                            echo    "<td class='blackBorder noPadding celluleHoraire'>";
                            echo            "<input class='checkHoraire' type='checkbox' name='$jour$i' id='$jour$i'>";
                            echo    "</td>";
                        }

                        echo "  </tr>";
                    }
                ?>
                </tbody>
            </table>
            <input type="submit" value="Suivant">
        </form>
    </body>
</html>