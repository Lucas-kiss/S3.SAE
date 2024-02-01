<?php
    session_start();
    if (isset($_POST['ine']))
    {
        $_SESSION['intitOffre']=$_POST['intitOffre'];
        $_SESSION['dateDeb']=$_POST['dateDeb'];
        $_SESSION['dateFin']=$_POST['dateFin'];
        $_SESSION['tauxHoraire']=$_POST['tauxHoraire'];
        $_SESSION['descrOffre']=$_POST['descrOffre'];
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob - Dépôt d'offre</title>
        <link rel="stylesheet" href="../Internaute/style.css">
    </head>
    <body>
        <nav>
            <div class=wrapper>
                <img class="logo" src="../../ressources/img/1ptitjob_logo.PNG" width="60" height="60" alt="Logo 1P'titJob"/>
                <h1 class="titre">1P'titJob</h1>
                <a href="../Internaute/Connexion.html" class="connexion">Connexion</a>
            </div>
        </nav>

        <H2></H2></br>
        <h4></h4></br>

        <form action="depotOffre.php" method="POST">
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