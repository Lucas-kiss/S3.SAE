<?php
require_once("../../ressources/donnees/BDD/bdd.php");
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
                    $ine = $_SESSION['ine'];
                    $queryNomCompte = "SELECT prenom, nom FROM Etudiant WHERE ine LIKE '$ine'";
                    $resultNom = mysqli_query($link, $queryNomCompte);
                    while ($donnees = mysqli_fetch_assoc($resultNom)) {
                      $prenom = $donnees["prenom"];
                      $nom = $donnees["nom"];
                    }
                    echo "<a href='../Etudiant/InformationsEtudiant.php' class='connexion'>$prenom $nom</a>";
                  } elseif (!isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
                    echo "<a href='../Internaute/Connexion.html' class='connexion'>Connexion</a>";
                  } elseif (!isset($_SESSION['ine']) && isset($_SESSION['siren'])) {
                    $siren = $_SESSION['siren'];
                    $queryNomCompte = "SELECT nomEntreprise FROM Entreprise WHERE siren LIKE '$siren'";
                    $resultNom = mysqli_query($link, $queryNomCompte);
                    while ($donnees = mysqli_fetch_assoc($resultNom)) {
                      $nomEntr = $donnees["nomEntreprise"];
                    }
                    echo "<a href='../Entreprise/InformationsEntreprise.php' class='connexion'>$nomEntr</a>";
                  }
            ?>
        </div>
    </nav>

    <body>
        <?php
        if (!isset($_SESSION['siren'])) 
        {
            header('location: index.php');
        } 
        else 
        {
            ?>
            <a href=../logout.php>Se déconnecter</a>
            <?php
        }
        ?>


</body>

</html>