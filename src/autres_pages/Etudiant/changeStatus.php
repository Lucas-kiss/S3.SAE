<?php
    require_once("../../ressources/donnees/BDD/bdd.php");
    session_start();

    $monOffre = $_SESSION['monOffre'];
    $ine = $_GET['id'];
    $etat = $_GET['etat'];

    //var_dump($etat);

    $query = "UPDATE Candidater SET statut = '$etat' WHERE ine = '$ine'";
    $link->query($query);

    if ($etat == 'Accepter')
    {
        $query = "UPDATE Offre SET nbEtudRetenus = nbEtudRetenus + 1 WHERE idOffre = $monOffre";
        $link->query($query);
    }

    mysqli_close($link);

    header('location: ../Entreprise/candidatureOffre.php');
?>