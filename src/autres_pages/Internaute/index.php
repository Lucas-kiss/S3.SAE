<?php
require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();

$dateActuelle = date('Y-m-d');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>1P'titJob</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php
$link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la base de données");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>

<body>
  <nav>
    <div class=wrapper>
      <?php
      if (isset($_SESSION['siren'])) {
        echo "<a href='../Entreprise/AccueilEntreprise.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
        echo "<h1 class='titre'><a href='../Entreprise/AccueilEntreprise.php'>1P'titJob</a></h1>";
      } else {
        echo "<a href='./index.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
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

  <form action="index.php" method="POST">
    <div class="grilleBoutons">
      
      <div class=infoRechercheOffre>

        <div class=recherche>
          <div class="barreDeRechercheOffre">
            <input class="boiteTexte" type="text" name="barreRecherche" placeholder="Rechercher un intitulé d'offre"
              style="width:90%">
          </div>

          <div class="boutonRechercher">
            <input type="submit" class='connexion' name="Rechercher" value="Rechercher">
          </div>
        </div>

        <div class=criteresRecherche>
          <div class="critDateDeDebut">
            <label for="DateDeb">Date de début:<br></label>
            <input class="boiteTexte" type="date" id="dateDeb" name="dateDeb">
          </div>

          <div class="critDateDeFin">
            <label for="dateFin">Date de fin:<br></label>
            <input class="boiteTexte" type="date" id="dateFin" name="dateFin">
          </div>

          <div class="critVille">
            <label for="ville">Ville:<br></label>
            <select class="boiteTexte" id="ville" name="ville">
              <option value='%'>Non renseignée</option>
              <?php
              $queryVille = "SELECT DISTINCT(V.nomVille) AS ville, COUNT(V.nomVille) AS cpt FROM Ville V 
                JOIN Entreprise E ON V.idVille=E.idVIlle
                JOIN Offre O ON O.siren = E.siren
                WHERE O.estFinie=0
                AND dateFin > '$dateActuelle'
                GROUP BY V.nomVille
                ORDER BY cpt DESC";

              $resultVille = mysqli_query($link, $queryVille);
              if ($link) {
                while ($donnees = mysqli_fetch_assoc($resultVille)) {
                  $resVille = $donnees['ville'];
                  $resCpt = $donnees['cpt'];
                  echo "<option value='$resVille'>[$resCpt] $resVille</option>";
                }
              }
              ?>
            </select>
          </div>

          <div class="critDomaineAct">
            <label for="domaineAct">Domaine d'activité:<br></label>
            <select class="boiteTexte" name="domaineAct" id="domaineAct">
              <option value='%'>Non renseigné</option>
              <?php
              $queryDomaineAct = "SELECT DISTINCT(E.domaineActivite) AS domaineAct, COUNT(E.domaineActivite) AS cpt FROM Entreprise E
                  JOIN Offre O ON O.siren = E.siren
                  WHERE O.estFinie=0
                  AND dateFin > '$dateActuelle'
                  GROUP BY E.domaineActivite
                  ORDER BY cpt DESC";


              $resultDomaineAct = mysqli_query($link, $queryDomaineAct);
              if ($link) {
                while ($donnees = mysqli_fetch_assoc($resultDomaineAct)) {
                  $resDomaineAct = $donnees['domaineAct'];
                  $resCpt = $donnees['cpt'];
                  echo "<option value='$resDomaineAct'>[$resCpt] $resDomaineAct</option>";
                }
              }
              ?>
            </select>
          </div>

        </div>

      </div>

      <?php
      if (isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
    print "<div class= 'InfoEtudiant'>
          <div class= 'messagesEtudiant'>
            <a href='../Etudiant/messagesEtudiant.php' class='connexion'>Messages</a>
          </div>
          <div class= candidaturesEtudiant>
          <a href='../Etudiant/lstCandidaturesEtudiant.php' class='connexion'>Candidatures</a>
          </div>
        </div>";
      }
      ?>
    </div>
  </form>

  <div class="annonces">
    <h2>Annonces :</h2>
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
          AND dateFin > '$dateActuelle'
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
          AND dateFin > '$dateActuelle'
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
        AND dateFin > '$dateActuelle'
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
          echo "<div class='recapOffre' style='grid-columns: 1' id='offre$resIdOffre'>

                <h3>Intitulé de l'offre : ".utf8_encode($resNomOffre)."</h3>
                <p>Entreprise : $resNomEntr</p>
                <p>Domaine d'activité : $resDomaineAct</p>
                <p>Date de l'offre : $resDateDeb à $resDateFin</p>
                <p>Localisation de l'offre : $resVilleOFfre $resCPOFfre</p>

                <button onclick='passId($resIdOffre)' class='btnDetails'>Détails</button>
          </div>";
        }
      }
      mysqli_close($link);
      ?>
    </div>
  </div>

</body>

</html>