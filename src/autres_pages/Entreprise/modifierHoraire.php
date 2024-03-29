<?php
session_start();
if (isset($_POST['intitOffre'])) {
    $_SESSION['intitOffre'] = $_POST['intitOffre'];
    $_SESSION['dateDeb'] = $_POST['dateDeb'];
    $_SESSION['dateFin'] = $_POST['dateFin'];
    $_SESSION['tauxHoraire'] = $_POST['tauxHoraire'];
    $_SESSION['descrOffre'] = $_POST['descrOffre'];
    echo $_SESSION['intitOffre'];
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
            <?php
            if (isset($_SESSION['siren'])) {
                echo "<a href='../Entreprise/AccueilEntreprise.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
                echo "<h1 class='titre'><a href='../Entreprise/AccueilEntreprise.php'>1P'titJob</a></h1>";
            } else {
                echo "<a href='../Internaute/index.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
                echo "<h1 class='titre'><a href='../Internaute/index.php'>1P'titJob</a></h1>";
            }

            if (isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
                echo "<a href='../Etudiant/InformationsEtudiant.php' class='connexion'>Mon compte</a>";
            } elseif (!isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
                echo "<a href='../Internaute/Connexion.html' class='connexion'>Connexion</a>";
            } elseif (!isset($_SESSION['ine']) && isset($_SESSION['siren'])) {
                echo "<a href='../Entreprise/InformationsEntreprise.php' class='connexion'>Mon compte</a>";
            }
            ?>
        </div>
    </nav>

    <H2>Créneaux de l'offre</H2></br>
    <h4>Veuillez renseigner les créneaux recherchés pour l'offre</h4></br>

    <form action="depotOffre.php" method="POST">
        <table class="blackBorder tableHoraire">
            <tbody>
                <?php
                $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
                echo "  <tr>
                                <th>
                                    <label>Jour</label>
                                </th>";

                for ($i = 0; $i < 24; $i++) {
                    echo "  <th class='blackBorder'>
                                    <label>$i h</label>
                                </th>";
                }

                echo "  </tr>";

                foreach ($jourSem as &$jour) {
                    echo "<tr class='noPadding'>";
                    echo "<th class='blackBorder noPadding thJour'>";
                    echo "<label>$jour</label>";
                    echo "</th>";

                    for ($i = 0; $i < 24; $i++) {
                        echo "<td class='blackBorder noPadding celluleHoraire'>";
                        echo "<input class='checkHoraire' type='checkbox' name='$jour$i' id='$jour$i'>";
                        echo "</td>";
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