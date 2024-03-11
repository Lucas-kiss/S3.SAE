<?php
require_once("../../ressources/donnees/BDD/bdd_MAMP.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();

if (isset($_GET['value'])) {
    $monOffre = $_GET['value'];

    $query_offre = "SELECT * FROM Offre  WHERE idOffre = $monOffre;";
    $result_offre = mysqli_query($link, $query_offre);

    while ($donnees = mysqli_fetch_assoc($result_offre)) {
        $nomOffre = $donnees["nomOffre"];
        $dateDeb = $donnees["dateDeb"];
        $dateFin = $donnees["dateFin"];
        $tauxHoraire = $donnees["tauxHoraire"];
        $description = str_replace("\n", "<br/>", $donnees["description"]);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>1PtitJob - Modification d'offre</title>
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

    <form action="../Internaute/pageOffre.php" method="POST">

        <div class="fondForm">
            <H1 class="titres">Modification de l'offre</H1>
            <div class="separation"></div>
            <table class="tabOffre">
                <tr>
                    <td><label for="intitOffre">Intitulé de l'offre</label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><input class="champs" type="text" name="intitOffre" value=<?php echo $nomOffre ?>
                            placeholder="Ex : Serveur dans un restaurant" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dateDeb">Date de début</label><label class="etoile"> *</label>
                    </td>
                </tr>
                <tr>
                    <td><input class="boiteTexte" type="date" name="dateDeb" id="idDeb" value=<?php echo date($dateDeb) ?>
                            min=<?php echo date("Y-m-d") ?> required />
                    </td>
                </tr>
                <tr>
                    <td><label for="dateFin">Date de fin </label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><input class="date" type="date" name="dateFin" id="idFin" value=<?php echo date($dateFin) ?>
                            min=<?php echo date("Y-m-d") ?> required />
                    </td>
                </tr>
                <tr>
                    <td><label for="tauxHoraire">Taux horaire (valeur nette en €)</label><label class="etoile">
                            *</label></td>
                </tr>
                <tr>
                    <td><input class="champs" type="text" name="tauxHoraire" pattern="[0-9]{2},[0-9]{2}" 
                    value=<?php echo $tauxHoraire[0] . $tauxHoraire[1] . ',' . $tauxHoraire[3] . $tauxHoraire[4] ?>
                            placeholder="Ex : 11,50" title="Format monétaire (00,00)" required />
                    </td>
                </tr>
                <tr>
                    <td><label for="descrOffre">Description de l'offre</label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><textarea name="descrOffre" required cols="20" rows="12"
                            placeholder="Ex : Nous recherchons un serveur les soirs de semaine..."><?php echo $description ?></textarea></td>
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