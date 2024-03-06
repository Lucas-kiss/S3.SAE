<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>1PtitJob - Dépôt d'offre</title>
    <link rel="stylesheet" href="../Internaute/style.css">
    <script src="../Internaute/complements.js"></script>
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
        echo "<a href='../Etudiant/InformationsEtudiant.php' class='connexion'>Mon compte</a>";
      } elseif (!isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
        echo "<a href='../Internaute/Connexion.html' class='connexion'>Connexion</a>";
      } elseif (!isset($_SESSION['ine']) && isset($_SESSION['siren'])) {
        echo "<a href='../Entreprise/InformationsEntreprise.php' class='connexion'>Mon compte</a>";
      }
      ?>
    </div>
  </nav>

<body>

    <form action="HoraireDepot.php" method="POST">

        <div class="fondForm">
            <H1 class="titres">Dépôt d'offre</H1>
            <div class="separation"></div>
            <table class="tabOffre">
                <tr>
                    <td><label for="intitOffre">Intitulé de l'offre</label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><input class="champs" type="text" name="intitOffre"
                            placeholder="Ex : Serveur dans un restaurant" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dateDeb">Date de début</label><label class="etoile"> *</label>
                    </td>
                </tr>
                <tr>
                    <td><input class="boiteTexte" type="date" name="dateDeb" id="idDeb" min=<?php echo date("Y-m-d") ?> required />
                    </td>
                </tr>
                <tr>
                    <td><label for="dateFin">Date de fin </label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><input class="date" type="date" name="dateFin" id="idFin" min=<?php echo date("Y-m-d") ?> required /></td>
                </tr>
                <tr>
                    <td><label for="tauxHoraire">Taux horaire (valeur nette en €)</label><label class="etoile">
                            *</label></td>
                </tr>
                <tr>
                    <td><input class="champs" type="text" name="tauxHoraire" pattern="[0-9]{2},[0-9]{2}"
                            placeholder="Ex : 11,50" title="Format monétaire (00,00)" required />
                    </td>
                </tr>
                <tr>
                    <td><label for="descrOffre">Description de l'offre</label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><textarea name="descrOffre" required cols="20" rows="12"
                            placeholder="Ex : Nous recherchons un serveur les soirs de semaine..."></textarea></td>
                </tr>
                <td>
                    <label class="etoile">* </label><label class="champsObl">Champs obligatoires<label>
                </td>
                <tr>
                    <td>
                        <input type="button" class="btnSuivant" name="annuler" value="Annuler" onclick="history.back()">
                    </td>
                    <td>
                        <input type="submit" class="btnSuivant" onclick="alerte_dates()" name="suivant" value="Suivant">
                    </td>
                </tr>
            </table>
        </div>
    </form>


</body>

</html>