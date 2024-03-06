<?php
session_start();
require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP


if (isset($_POST['postuler'])) {

    $ine = $_SESSION['ine'];



    $queryInsertEntr = "INSERT INTO Candidater
        Values ('$ine', $monOffre, )";

    $res = mysqli_query($link, $queryInsertEntr);
    if ($res) {
        echo 'Insertion fonctionnelle</br>';
    } else {
        echo "Insertion n'a pas fonctionnée</br>";
    }

}



mysqli_close($link);
?>