<?php

require("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();

$monOffre = $_POST["idOffre"];

$query_offre = "SELECT * FROM Offre WHERE idOffre = $monOffre;";
$result_offre = mysqli_query($link, $query_offre);

while ($donnees = mysqli_fetch_assoc($result_offre)) {
    $nomOffre = $donnees["nomOffre"];
    $dateDepot = $donnees["dateDepot"];
    $dateDeb = $donnees["dateDeb"];
    $dateFin = $donnees["dateFin"];
    $tauxHoraire = $donnees["tauxHoraire"];
    $description = $donnees["description"];

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>1P'titJob</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <nav>
        <div class=wrapper>
            <img class="logo" src="../../ressources/img/1ptitjob_logo.PNG" width="60" height="60" />
            <h1 class="titre">1P'titJob</h1>
            <a href="Connexion.html" class="connexion">Connexion</a>
        </div>
    </nav>

    <div class="fondForm">
        <H1 class="titres"> Titre de l'Offre</H1>


    </div>


</body>

</html>