<?php

require_once ("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();

if (true) {
    $monOffre = 10; // en attente !!!!!!!!

    $ine = $_SESSION['ine'];

    $query_etud = "SELECT * FROM Etudiant JOIN Ville ON Etudiant.idVille = Ville.idVille WHERE ine = '$ine';";
    $result_etud = mysqli_query($link, $query_etud);

    while ($donnees = mysqli_fetch_assoc($result_etud)) {
        $prenom = $donnees["prenom"];
        $nom = $donnees["nom"];
        $dateNaiss = $donnees["dateNaiss"];
        $numTel = $donnees["numTel"];
        $mailEtud = $donnees["mailEtud"];
        $nomVille = $donnees["nomVille"];
        $cp = $donnees["codePostal"];
    }
    mysqli_close($link);
?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>1PtitJob - Candidature</title>
    <link rel="stylesheet" href="../Internaute/style.css">
</head>

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
    

    <form action="ActionCandid.php" method="POST">

        <div class="fondForm">
            <H1 class="titres">Candidature</H1>
            <div class="separation"></div>
            <table class="tabOffre">
                <tr>
                    <td><label for="ine">INE</label></td>
                </tr>
                <tr>
                    <td>
                        <input readonly class="champsRecap" type="text" name="ine" value=<?php echo $ine ?> />
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">Nom</label></td>
                </tr>
                <tr>
                    <td>
                        <input readonly class="champsRecap" type="text" name="nom" value=<?php echo $nom ?> />
                    </td>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom</label></td>
                </tr>
                <tr>
                    <td>
                        <input readonly class="champsRecap" type="text" name="prenom" value=<?php echo $prenom ?> />
                    </td>
                </tr>
                <tr>
                    <td><label for="dateNaiss">Date de naissance</label></td>
                </tr>
                <tr>
                    <td>
                        <input readonly class="champsRecap" type="text" name="dateNaiss" value=<?php echo $dateNaiss ?> />
                    </td>
                </tr>
                <tr>
                    <td><label for="ville">Ville</label></td>
                </tr>
                <tr>
                    <td>
                        <input readonly class="champsRecap" type="text" name="ville" value=<?php echo $nomVille ?> />
                    </td>
                </tr>
                <tr>
                    <td><label for="cp">Code postal</label></td>
                </tr>
                <tr>
                    <td>
                        <input readonly class="champsRecap" type="text" name="cp" value=<?php echo $cp ?> />
                    </td>
                </tr>
                <tr>
                    <td><label for="mail">Adresse e-mail</label></td>
                </tr>
                <tr>
                    <td>
                        <input readonly class="champsRecap" type="text" name="mail" value=<?php echo $mailEtud ?> />
                    </td>
                </tr>
                <tr>
                    <td><label for="tel">Numéro de téléphone</label></td>
                </tr>
                <tr>
                    <td>
                        <input readonly class="champsRecap" type="text" name="tel" value=<?php echo $numTel ?> />
                    </td>
                </tr>
                <tr>
                    <td><label for="cv">CV (.pdf)</label></td>
                </tr>
                <tr>
                    <td>
                        <input class="inputFile" type="file" name="cv" accept=".pdf"/>
                    </td>
                </tr>
                <tr>
                    <td><label for="lettreMotiv">Lettre de motivation (.pdf)</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="file" class="inputFile" name="lettreMotiv" accept=".pdf"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btnSuivant" name="postuler" value="Postuler">
                    </td>
                </tr>
            </table>
        </div>
    </form>


</body>

</html>

<?php 
}
?>