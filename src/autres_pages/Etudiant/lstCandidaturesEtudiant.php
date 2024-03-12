<?php
require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <title>1P'titJob - Mes candidatures</title>
  <link href="../Internaute/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <nav>
    <div class=wrapper>
      <?php
      if (isset($_SESSION['ine'])) {
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

  <div class="annonces">
    <h2>Candidatures :</h2>
    <div class="grilleAnnonces">
      <script>
        function passId(id) {
          window.location.href = 'pageOffre.php?value=' + encodeURIComponent(id);
        }
      </script>
      <?php
      if ($_POST) {
        $critBarreRecherche = trim($_POST["barreRecherche"]);
        $critVille = $_POST["ville"];
        $critDomaineAct = $_POST["domaineAct"];
        $critDateDeb = $_POST["dateDeb"];
        $critDateFin = $_POST["dateFin"];
        if ($critDateFin == '') {
          $queryOffre = "SELECT O.idOffre id, O.nomOffre nomOffre, E.nomEntreprise nomEntr, E.domaineActivite domaineAct, O.dateDeb dateDeb, O.dateFin dateFin, V.nomVille ville, V.codePostal cp
          FROM Offre O
          JOIN Entreprise E ON E.siren = O.siren
          JOIN Ville V ON V.idVille = E.idVille
          WHERE O.estFinie=0
          AND O.nomOffre LIKE '%$critBarreRecherche%'
          AND V.nomVille LIKE '$critVille'
          AND E.domaineActivite LIKE '$critDomaineAct'
          AND O.dateDeb >= '$critDateDeb'
          ORDER BY O.dateDepot DESC";
        } else {
          $queryOffre = "SELECT O.idOffre id, O.nomOffre nomOffre, E.nomEntreprise nomEntr, E.domaineActivite domaineAct, O.dateDeb dateDeb, O.dateFin dateFin, V.nomVille ville, V.codePostal cp
          FROM Offre O
          JOIN Entreprise E ON E.siren = O.siren
          JOIN Ville V ON V.idVille = E.idVille
          WHERE O.estFinie=0
          AND O.nomOffre LIKE '%$critBarreRecherche%'
          AND V.nomVille LIKE '$critVille'
          AND E.domaineActivite LIKE '$critDomaineAct'
          AND O.dateDeb >= '$critDateDeb'
          AND O.dateFin <= '$critDateFin'
          ORDER BY O.dateDepot DESC";
        }

      } else {
        $queryOffre = "SELECT O.idOffre id, O.nomOffre nomOffre, E.nomEntreprise nomEntr, E.domaineActivite domaineAct, O.dateDeb dateDeb, O.dateFin dateFin, V.nomVille ville, V.codePostal cp
        FROM Offre O
        JOIN Entreprise E ON E.siren = O.siren
        JOIN Ville V ON V.idVille = E.idVille
        WHERE O.estFinie=0
        ORDER BY O.dateDepot DESC";
      }

      $resOffre = mysqli_query($link, $queryOffre);

      if ($link) {
        while ($donnees = mysqli_fetch_assoc($resOffre)) {
          $resIdOffre = $donnees['id'];
          $resNomOffre = $donnees['nomOffre'];
          $resNomEntr = $donnees['nomEntr'];
          $resDomaineAct = $donnees['domaineAct'];
          $resDateDeb = $donnees['dateDeb'];
          $resDateFin = $donnees['dateFin'];
          $resVilleOFfre = $donnees['ville'];
          $resCPOFfre = $donnees['cp'];
          echo "<div class='recapOffre' id='offre$resIdOffre'>

                <h3>Intitulé de l'offre :".utf8_encode($resNomOffre)."</h3>
                <p>Entreprise : $resNomEntr</p>
                <p>Domaine d'activité : $resDomaineAct</p>
                <p>Date de l'offre : $resDateDeb à $resDateFin</p>
                <p>Localisation de l'offre : $resVilleOFfre $resCPOFfre</p>

                <button onclick='passId($resIdOffre)'>Détails</button>
          </div>";
        }
      }
      mysqli_close($link);
      ?>
    </div>
  </div>


</body>

</html>