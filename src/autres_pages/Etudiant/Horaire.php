<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob - Inscription Etudiant</title>
        <link rel="stylesheet" href="../Internaute/style.css">
    </head>
    <body>
        <form action="">
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
                        echo "  <th class='blackBorder'>
                                    $i h
                                </th>";
                    }
                    
                    echo "  </tr>";

                    foreach ($jourSem as &$jour)
                    {
                        echo "  <tr>
                                    <th class='blackBorder'>
                                        $jour
                                    </th>";

                        for ($i = 0; $i < 24; $i++)
                        {
                            echo "  <td class='blackBorder noPadding'>
                                        <input class='checkHoraire' type='checkbox' name='$jour$i' id='$jour$i'>
                                    </td>";
                        }

                        echo "  <tr>";
                    }
                ?>
                </tbody>
            </table>
        </form>
    </body>
</html>