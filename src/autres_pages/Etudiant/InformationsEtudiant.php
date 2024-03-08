<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>1PtitJob - Informations de mon profil</title>
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

    <body>
        <a href=../logout.php>Se déconnecter</a>
    </body>

</html>