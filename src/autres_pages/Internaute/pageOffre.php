<?php

require("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();

if (isset($_GET['value'])) {
    $monOffre = $_GET['value'];

    $query_offre = "SELECT * FROM Offre JOIN Entreprise ON Offre.siren = Entreprise.siren JOIN Ville ON Entreprise.idVille = Ville.idVille WHERE idOffre = $monOffre;";
    $result_offre = mysqli_query($link, $query_offre);

    while ($donnees = mysqli_fetch_assoc($result_offre)) {
        $nomOffre = $donnees["nomOffre"];
        $dateDepot = $donnees["dateDepot"];
        $dateDeb = $donnees["dateDeb"];
        $dateFin = $donnees["dateFin"];
        $tauxHoraire = $donnees["tauxHoraire"];
        $description = str_replace("\n", "<br/>", $donnees["description"]);
        $nomEntr = $donnees["nomEntreprise"];
        $ville = $donnees["nomVille"];
    }

    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>1P'titJob</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
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

        <div class="fondForm">
            <H1 class="titres">
                <?php echo "$nomOffre" ?>
            </H1>

            <?php

            echo "<p class='infoOffre'>Entreprise : $nomEntr</p>";
            echo "<p class='infoOffre'>Ville : $ville</p>";
            echo "<p class='infoOffre'>Date de l'offre : du $dateDeb au $dateFin</p>";
            echo "<p class='infoOffre'>Rémunération : $tauxHoraire euros net par heure</p>";
            echo "<p class='infoOffre'>Détails :</br></br> $description</p>";
            echo "<p class='sous-titre'>Offre déposée le $dateDepot</p>";
            ?>

        </div>


    </body>

    </html>

    <?php
}
?>