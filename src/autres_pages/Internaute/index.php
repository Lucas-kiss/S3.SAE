<?php
require_once("../../ressources/donnees/BDD/bdd.php");
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
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
      <img class="logo" src="../../ressources/img/1ptitjob_logo.PNG" width="60" height="60" />
      <h1 class="titre">1P'titJob</h1>
      <?php
      if (isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
        echo "<a href='../Etudiant/InformationsEtudiant.php' class='connexion'>Mon compte</a>";
      } elseif (!isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
        echo "<a href='Connexion.html' class='connexion'>Connexion</a>";
      }
      ?>
    </div>
  </nav>

  <form action="index.php" method="POST">
    <div class="grilleBoutons">

      <div class=infoRechercheOffre>

        <div class=recherche>
          <div class="barreDeRechercheOffre">
            <input class="boiteTexte" type="text" placeholder="Rechercher..." style="width:90%">
          </div>

          <div class="boutonRechercher">
            <input type="submit" class="btnRechercheOffre" name="Rechercher" value="Rechercher">
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
            <select class="boiteTexte" id="ville">
              <?php
              $queryVille = "SELECT DISTINCT(V.nomVille) AS ville FROM Ville V 
                JOIN Entreprise E ON V.idVille=E.idVIlle
                JOIN Offre O ON O.siren = E.siren
                WHERE O.estFinie=0";

              $resultVille = mysqli_query($link, $queryVille);
              if ($link) {
                while ($donnees = mysqli_fetch_assoc($resultVille)) {
                  $resVille = $donnees['ville'];
                  echo "<option value='$resVille'>$resVille</option>";
                }
              }
              ?>
            </select>
          </div>

          <div class="critDomaineAct">
            <label for="domaineAct">Domaine d'activité:<br></label>
            <select class="boiteTexte" id="domaineAct">
              <?php
              $queryDomaineAct = "SELECT DISTINCT(E.domaineActivite) AS domaineAct FROM Entreprise E
                  JOIN Offre O ON O.siren = E.siren
                  WHERE O.estFinie=0";

              $resultDomaineAct = mysqli_query($link, $queryDomaineAct);
              if ($link) {
                while ($donnees = mysqli_fetch_assoc($resultDomaineAct)) {
                  $resDomaineAct = $donnees['domaineAct'];
                  echo "<option value='$resDomaineAct'>$resDomaineAct</option>";
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
                <button style='width:100%'>Mes messages</button>
              </div>
              <div class= candidaturesEtudiant>
                <button style='width:100%'>Mes candidatures</button>
              </div>
            </div>";
      }
      ?>
    </div>
  </form>

  <div class="annonces">
<<<<<<< HEAD
    <h4>Annonces :</h4>
    <div class="uneannonce">
      <h3>Annonce</h3>
      <p style="text-align:left">Détails de l'annonce</p>
    </div>
    <div class="uneannonce">
      <h3>Annonce</h3>
      <p style="text-align:left">Détails de l'annonce</p>
    </div>
    <div class="uneannonce">
      <h3>Annonce</h3>
      <p style="text-align:left">Détails de l'annonce</p>
    </div>
    <div class="uneannonce">
      <h3>Annonce</h3>
      <p style="text-align:left">Détails de l'annonce</p>
    </div>
    <div class="uneannonce">
      <h3>Annonce</h3>
      <p style="text-align:left">Détails de l'annonce</p>
=======
    <h2>Annonces :</h2>
    <div class="grilleAnnonces">
      <script>
        function passId(id) {
          window.location.href = 'pageOffre.php?value=' + encodeURIComponent(id);
        }
      </script>
      <?php
      $queryOffre = "SELECT O.idOffre id, O.nomOffre nomOffre, E.nomEntreprise nomEntr, E.domaineActivite domaineAct, O.dateDeb dateDeb, O.dateFin dateFin, V.nomVille ville, V.codePostal cp
        FROM Offre O
        JOIN Entreprise E ON E.siren = O.siren
        JOIN Ville V ON V.idVille = E.idVille
        WHERE O.estFinie=0
        ORDER BY O.dateDepot DESC";
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

                <h3>Intitulé de l'offre : $resNomOffre</h3>
                <p>Entreprise : $resNomEntr</p>
                <p>Domaine d'activité :$resDomaineAct</p>
                <p>Date de l'offre : $resDateDeb à $resDateFin</p>
                <p>Localisation de l'offre : $resVilleOFfre $resCPOFfre</p>

                <button onclick='passId($resIdOffre)'>Continuer</button>
          </div>";
        }
      }
      ?>
>>>>>>> pageAccueil
    </div>
  </div>

</body>

</html>