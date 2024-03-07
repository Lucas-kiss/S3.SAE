<?php

require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();

if (isset($_GET['value'])) {
    $monOffre = $_GET['value'];

    if ($link) {
        $query = "DELETE FROM Offre WHERE idOffre = $monOffre";
        $res = mysqli_query($link, $query);
        if ($res) {
            header('location: AccueilEntreprise.php');
        } else {
            echo "Suppresion n'a pas fonctionné";
        }
    }
}
?>