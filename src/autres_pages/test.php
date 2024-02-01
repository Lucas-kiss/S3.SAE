<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <title>1P'titJob</title>
    <link href="Internaute/style.css" rel="stylesheet" type="text/css"/>
  </head>

  <body>
  <nav>
    <div class=wrapper>
      <?php
      if (isset($_SESSION['siren'])) {
        echo "<a href='../Entreprise/accueilEntreprise.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
        echo "<h1 class='titre'><a href='../Entreprise/accueilEntreprise.php'>1P'titJob</a></h1>";
      } else {
        echo "<a href='./index.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
        echo "<h1 class='titre'><a href='./index.php'>1P'titJob</a></h1>";
      }

      if (isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
        echo "<a href='../Etudiant/InformationsEtudiant.php' class='connexion'>Mon compte</a>";
      } elseif (!isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
        echo "<a href='Connexion.html' class='connexion'>Connexion</a>";
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
    </div>

    <div class="nbMinEtudJour">
      <p>Nombre min. d'étudiants par jour:</p>
      <input type="number" id="minEtudJour" name="minEtudJour" value="1" min="1" max="24" />
    </div>

    <div class="nbMinHeuresEtud">
      <p>Nombre min. d'heures par étudiant:</p>
      <input type="number" id="minHeuresEtud" name="minHeuresEtud" value="1" min="1" max="24" />
    </div>

    <div class="nbMinEtudOffre">
      <p>Nombre min. d'étudiants sur l'offre:</p>
      <input type="number" id="minEtudOffre" name="minEtudOffre" value="1" min="1" max="24" />
    </div>

  </div>