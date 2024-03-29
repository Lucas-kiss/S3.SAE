<?php
if (isset($_POST)) {
    require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
    session_start();

    $siren = $_SESSION['siren'];

    $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

    foreach ($jourSem as &$jour) {

        $trouve = false;
        for ($i = 0; $i < 24; $i++) {
            $cle = $jour.$i;
            if (isset($_POST[$cle]) && $_POST[$cle] == 'on')
            {
                $_SESSION[$cle] = 'on';
            }
            else
            {
                $_SESSION[$cle] = 'off';
            }
        }
    }
?>

        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <title>1PtitJob - Dépôt d'offre</title>
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

            <form action="depotOffre.php" method="POST">

                <?php
                $intitOffre = $_SESSION["intitOffre"];
                $dateDeb = $_SESSION["dateDeb"];
                $dateFin = $_SESSION["dateFin"];
                $tauxHoraire = $_SESSION["tauxHoraire"];
                $descrOffre = $_SESSION["descrOffre"];
                ?>
                <div class="fondForm">
                    <H1 class="titres">Récapitulatif de l'offre</H1>
                    <div class="separation"></div>
                    <table class="tabOffre">
                        <tr>
                            <td><label for="intitOffre">Intitulé de l'offre</label><label class="etoile"> *</label></td>
                        </tr>
                        <tr>
                            <td><input readonly class="champsRecap" type="text" name="intitOffre" value=<?php echo $intitOffre ?> />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="dateDeb">Date de début</label><label class="etoile"> *</label>
                            </td>
                        </tr>
                        <tr>
                            <td><input readonly class="dateRecap" type="date" name="dateDeb" value=<?php echo $dateDeb ?> />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="dateFin">Date de fin </label><label class="etoile"> *</label></td>
                        </tr>
                        <tr>
                            <td><input readonly class="dateRecap" type="date" name="dateFin" value=<?php echo $dateFin ?> />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="tauxHoraire">Taux horaire (valeur nette en €)</label><label class="etoile">
                                    *</label></td>
                        </tr>
                        <tr>
                            <td><input readonly class="champsRecap" type="text" name="tauxHoraire" pattern="[0-9]{2},[0-9]{2}"
                                    value=<?php echo $tauxHoraire ?> title="Format monétaire (00,00)" />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="descrOffre">Description de l'offre</label><label class="etoile"> *</label></td>
                        </tr>
                        <tr>
                            <td><textarea readonly class="textAreaRecap" name="descrOffre" cols="20" rows="12"><?php echo $descrOffre ?></textarea></td>
                        </tr>
                        <td>
                            <label class="etoile">*</label><label class="champsObl">Champs obligatoires<label>
                        </td>
                    </table>
                    <?php
                        $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
                        echo " <table class='blackBorder'>
                        <tr class='noPadding'>
                            <th class='blackBorder noPadding thJour'>
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
                            for ($i = 0; $i < 24; $i++) {
                                $cle = $jour . $i;
                                if ($_SESSION[$cle] == 'on')
                                {
                                    echo "<td class='blackBorder noPadding caseverte'>";
                                }
                                else
                                {
                                    echo "<td class='blackBorder noPadding caserouge'>";
                                }
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    ?>
                    <table class="tabOffre">
                        <td>
                            <input type="button" class="btnSuivant" name="modifier" value="Modifier" onclick="history.go(-2)">
                        </td>
                        <td>
                            <input type="submit" class="btnSuivant" name="suivant" value="Valider">
                        </td>
                    </table>
                </div>
            </form>
            
            

        </body>

        </html>

<?php

}

?>