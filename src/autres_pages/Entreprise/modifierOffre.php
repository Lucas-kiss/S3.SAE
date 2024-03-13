<?php
require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();

if (isset($_GET['value'])) {
    $monOffre = $_GET['value'];

    $query_offre = "SELECT * FROM Offre  WHERE idOffre = $monOffre;";
    $result_offre = mysqli_query($link, $query_offre);

    while ($donnees = mysqli_fetch_assoc($result_offre)) {
        $nomOffre = $donnees["nomOffre"];
        $dateDeb = $donnees["dateDeb"];
        $dateFin = $donnees["dateFin"];
        $tauxHoraire = str_replace(".", ",", $donnees["tauxHoraire"]);
        $description = str_replace("\n", "<br/>", $donnees["description"]);
    }
}

if (isset($_POST["ModifIntitOffre"]))
{
    $tauxHoraire = str_replace(",", ".", $_POST["tauxHoraire"]);
    $tauxHoraire = floatval($tauxHoraire);
    $intitOffre = $_POST["ModifIntitOffre"];
    $dateDeb = $_POST["dateDeb"];
    $dateFin = $_POST["dateFin"];
    $description = $_POST["descrOffre"];
    $monOffre = $_POST["idOffre"];

    $nbHeureTotal = 0;
    $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

    foreach ($jourSem as &$jour) {
        for ($i = 0; $i < 24; $i++) {
            $cle = $jour . $i;
            if (isset($_POST[$cle]) && $_POST[$cle] == 'on') {
                $nbHeureTotal++;
            }
        }
    }

    $queryModifOffre = "UPDATE Offre O SET nomOffre='$intitOffre', dateDeb='$dateDeb', dateFin='$dateFin', nbHeureTotal=$nbHeureTotal, tauxHoraire=$tauxHoraire, O.description='$description'
    WHERE idOffre=$monOffre";

    $resModifOffre = mysqli_query($link, $queryModifOffre);


    // Créneaux

    // suppression des liaisons entre les creneaux existants et l'offre
    $querySuppConcerner = "DELETE FROM Concerner WHERE idOffre=$monOffre";
    $resSuppConcerner = mysqli_query($link, $querySuppConcerner);


    $query_id = "SELECT MAX(IdCreneau) FROM Creneau";
    $result_id = mysqli_query($link, $query_id);

    $idCreneauMax = 1;

    while ($donnees = mysqli_fetch_assoc($result_id)) {
        $idCreneauMax = $donnees["MAX(IdCreneau)"] + 1;
    }

    $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

    $i = 0;

    $last = 0;


    foreach ($jourSem as &$jour) {

        $trouve = false;
        for ($i = 0; $i < 24; $i++) {
            $cle = $jour . $i;

            if ($trouve) {
                if (!isset($_POST[$cle]) || !$_POST[$cle] == 'on') {

                    $queryVerifCreneau = "SELECT * FROM Creneau WHERE jour='$jour' AND heureDeb=$heureDeb AND heureFin=$i";
                    $resVerifCreneau = mysqli_query($link, $queryVerifCreneau);
                    if ($link->affected_rows > 0) {
                        while ($donnees = mysqli_fetch_assoc($resVerifCreneau)) {
                            $idCreneau = $donnees["IdCreneau"];
                        }
                        // faire le lien dans concerner entre creneau et offre
                        $queryInsertConcerner = "INSERT INTO Concerner (idCreneau, idOffre) Values ($idCreneau, $monOffre)";
                        $resInsertConcerner = mysqli_query($link, $queryInsertConcerner);
                    } else {
                        // creation du creneau
                        $idCreneau = $idCreneauMax;
                        $queryInsertCreneau = "INSERT INTO Creneau (IdCreneau, jour, heureDeb, heureFin) Values ($idCreneau, '$jour', $heureDeb, $i)";
                        $resInsertCreneau = mysqli_query($link, $queryInsertCreneau);
                        // faire le lien dans concerner entre creneau et offre
                        $queryInsertConcerner = "INSERT INTO Concerner (idCreneau, idOffre) Values ($idCreneau, $monOffre)";
                        $resInsertConcerner = mysqli_query($link, $queryInsertConcerner);

                        $idCreneauMax++;
                    }
                    $trouve = false;
                }
            } else {
                if (isset($_POST[$cle]) && $_POST[$cle] == 'on') {
                    $heureDeb = $i;
                    $trouve = true;
                }
            }
        }

        if ($trouve) {

            $queryVerifCreneau = "SELECT * FROM Creneau WHERE jour='$jour' AND heureDeb=$heureDeb AND heureFin=$i";
            $resVerifCreneau = mysqli_query($link, $queryVerifCreneau);
            if ($link->affected_rows > 0) {
                while ($donnees = mysqli_fetch_assoc($resVerifCreneau)) {
                    $idCreneau = $donnees["idCreneau"];
                }
                // faire le lien dans concerner entre creneau et etudiant
                $queryInsertConcerner = "INSERT INTO Concerner (idCreneau, idOffre) Values ($idCreneau, $monOffre)";
                $resInsertConcerner = mysqli_query($link, $queryInsertConcerner);
            } else {
                // creation du creneau
                $idCreneau = $idCreneauMax;
                $queryInsertCreneau = "INSERT INTO Creneau (IdCreneau, jour, heureDeb, heureFin) Values ($idCreneau, '$jour', $heureDeb, $i)";
                $resInsertCreneau = mysqli_query($link, $queryInsertCreneau);
                // faire le lien dans posseder entre creneau et offre
                $queryInsertPosseder = "INSERT INTO Posseder (ine, idCreneau) Values ('$ine', $idCreneau)";
                $resInsertPosseder = mysqli_query($link, $queryInsertPosseder);

                $idCreneauMax++;
            }
        }
    }
    // supprimer les creneaux inutilisés
    $querySuppCreneau = "DELETE FROM Creneau WHERE IdCreneau NOT IN (SELECT idCreneau FROM Posseder) AND IdCreneau NOT IN (SELECT IdCreneau FROM Concerner)";
    $resSuppCreneau = mysqli_query($link, $querySuppCreneau);
    mysqli_close($link);
    header('location: ../Entreprise/AccueilEntreprise.php');
}
else {

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

    <form action="../Entreprise/modifierOffre.php" method="POST">

        <div class="fondForm">
            <H1 class="titres">Modification de l'offre</H1>
            <div class="separation"></div>
            <table class="tabOffre">
                <tr>
                    <input type=hidden name=idOffre value=<?php echo $monOffre?>>
                    <td><label for="intitOffre">Intitulé de l'offre</label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><textarea class="champs" cols="10" rows="1" name="ModifIntitOffre"
                            placeholder="Ex : Serveur dans un restaurant" required><?php echo $nomOffre ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dateDeb">Date de début</label><label class="etoile"> *</label>
                    </td>
                </tr>
                <tr>
                    <td><input class="boiteTexte" type="date" name="dateDeb" id="idDeb" value=<?php echo date($dateDeb) ?>
                           required />
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
                    value=<?php echo $tauxHoraire ?>
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
            </table>
            <?php
            $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
            echo "  <table class='blackBorder tabInfoHoraireEt'><tr>
                            <th>
                                <label>Jour</label>
                            </th>";

            for ($i = 0; $i < 24; $i++) {
                echo "  <th class='blackBorder'>
                                <label>$i h</label>
                            </th>";
            }

            echo "  </tr>";

            foreach ($jourSem as &$jour) {
                echo "<tr class='noPadding'>";
                echo "<th class='blackBorder noPadding thJour'>";
                echo "<label>$jour</label>";
                echo "</th>";

                $j = 0;

                for ($i = 0; $i < 24; $i++) {
                    $query = "SELECT * FROM Creneau cr join Concerner co on co.idCreneau=cr.IdCreneau WHERE cr.jour = '$jour' AND co.idOffre = $monOffre AND cr.heureDeb <= $i AND cr.heureFin > $i";
                    $result = mysqli_query($link, $query);
                    echo "<td class='blackBorder noPadding'>";
                    if ($result && mysqli_num_rows($result) > 0) {
                        echo "<input class='checkHoraire' type='checkbox' name='$jour$i' id='$jour$i' checked>";
                    } else {
                        echo "<input class='checkHoraire' type='checkbox' name='$jour$i' id='$jour$i'>";
                    }
                    echo "</td>";
                }

                echo "</tr>";
            }
            echo "</table>";
            mysqli_close($link);
            ?>
            <div class="btnModifInfosEntr">
                <input type="button" class="connexion" name="annuler" value="Retour" id="btnRetourModif" onclick="history.back()">
                <input type="reset" class="connexion" value="Réinitialiser" id="btnReset"/>
                <input type="submit" class="connexion" value="Valider" id="btnVal">
            </div>
        </div>
    </form>
    <?php
    }
    ?>


</body>

</html>