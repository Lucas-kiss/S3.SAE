<?php
    session_start();
    $_SESSION['ine']=$_POST['ine'];
    $_SESSION['prenom']=$_POST['prenom'];
    $_SESSION['nom']=$_POST['nom'];
    $_SESSION['naissance']=$_POST['naissance'];
    $_SESSION['adresse']=$_POST['adresse'];
    $_SESSION['ville']=$_POST['ville'];
    $_SESSION['pays']=$_POST['pays'];
    $_SESSION['telephone']=$_POST['telephone'];
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob - Inscription Etudiant</title>
        <link rel="stylesheet" href="../Internaute/style.css">
    </head>
    <body>
        <form action="Insert.php">
            <table class="blackBorder">
                <tbody>
                <?php
                    $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
                    echo "  <tr>
                                <th>
                                    Jour
                                </th>";

                    for ($i = 0; $i < 24; $i++)
                    {
                        echo "  <th class='blackBorder noPadding'>
                                    $i h
                                </th>";
                    }
                    
                    echo "  </tr>";

                    foreach ($jourSem as &$jour)
                    {
                        echo "  <tr class='noPadding blackBorder'>
                                    <th class='blackBorder noPadding'>
                                        $jour
                                    </th>";

                        for ($i = 0; $i < 24; $i++)
                        {
                            echo "  <td class='blackBorder noPadding'>
                                        <input class='checkHoraire' type='checkbox' name='$jour$i' id='$jour$i'>
                                    </td>";
                        }

                        echo "  </tr>";
                    }
                ?>
                </tbody>
            </table>
        </form>
    </body>
</html>