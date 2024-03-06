<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <title>1P'titJob</title>
  <link href="../Internaute/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<nav>
    <div class=wrapper>
      <?php
      if (isset($_SESSION['siren'])) {
        echo "<a href='../Entreprise/AccueilEntreprise.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
        echo "<h1 class='titre'><a href='../Entreprise/AccueilEntreprise.php'>1P'titJob</a></h1>";
      } else {
        echo "<a href='./index.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
        echo "<h1 class='titre'><a href='./index.php'>1P'titJob</a></h1>";
      }

      if (isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
        echo "<a href='../Etudiant/InformationsEtudiant.php' class='connexion'>Mon compte</a>";
      } elseif (!isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
        echo "<a href='../Internaute/Connexion.html' class='connexion'>Connexion</a>";
      } elseif (!isset($_SESSION['ine']) && isset($_SESSION['siren'])) {
        echo "<a href='../Entreprise/InformationsEntreprise.php' class='connexion'>Mon compte</a>";
      }
      ?>
    </div>
  </nav>

  <div class="grilleBoutons">

    <div class="boutonDeposerOffre">
      <button style="width:100%">Déposer une offre d'emploi</button>
    </div>

    <div class="boutonMesMessages">
      <button style="width:100%">Mes messages</button>
    </div>

    <div class="heureDeDebut">
      <label for="DateDeb">Date de début:<br></label>
      <input class="boiteTexte" type="date" id="dateDeb" name="dateDeb">
    </div>

    <div class="heureDeFin">
      <label for="dateFin">Date de fin:<br></label>
      <input class="boiteTexte" type="date" id="dateFin" name="dateFin">
    </div>

    <div class="villeOffre">
      <label for="ville">Ville:<br></label>
      <select class="boiteTexte" value="ville" id="ville">
        <option value="Bayonne">Bayonne</option>
        <option value="Anglet">Anglet</option>
        <option value="Biarritz">Biarritz</option>
      </select>
    </div>

  </div>

  <div class="annonces">
    <h4>Annonces :</h4>
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
        WHERE E.siren = $siren AND O.estFinie=0 
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
  </div>

</body>

</html>