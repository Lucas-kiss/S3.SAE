<?php
    session_start();
    if (isset($_POST['ine']))
    {
        $_SESSION['ine']=$_POST['ine'];
        $_SESSION['prenom']=$_POST['prenom'];
        $_SESSION['nom']=$_POST['nom'];
        $_SESSION['naissance']=$_POST['naissance'];
        $_SESSION['ville']=$_POST['ville'];
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
    <nav>
        <div class=wrapper>
            <?php
            if (isset($_SESSION['siren'])) {
                echo "<a href='../Entreprise/accueilEntreprise.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
                echo "<h1 class='titre'><a href='../Entreprise/accueilEntreprise.php'>1P'titJob</a></h1>";
            } else {
                echo "<a href='./index.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
                echo "<h1 class='titre'><a href='./index.php'>1P'titJob</a></h1>";
            }

            if (isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
                echo "<a href='../Etudiant/InformationsEtudiant.php' class='connexion'>Mon compte</a>";
            } elseif (!isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
                echo "<a href='Connexion.html' class='connexion'>Connexion</a>";
            } elseif (!isset($_SESSION['ine']) && isset($_SESSION['siren'])) {
                echo "<a href='../Entreprise/InformationsEntreprise.php' class='connexion'>Mon compte</a>";
            }
            ?>
        </div>
    </nav>

    <H2>Vos Disponibilités</H2></br>
    <h4>Veuillez renseigner vos disponibilités.</h4></br>

    <form action="Insert.php" method="POST">
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