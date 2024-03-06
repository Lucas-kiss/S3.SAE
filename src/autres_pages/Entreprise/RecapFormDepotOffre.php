<?php
if (isset($_POST["suivant"])) {
    require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
    session_start();

    $siren = $_SESSION['siren'];

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

            <form action="depotOffre.php" method="POST">

                <?php
                $intitOffre = $_POST["intitOffre"];
                $dateDeb = $_POST["dateDeb"];
                $dateFin = $_POST["dateFin"];
                $tauxHoraire = $_POST["tauxHoraire"];
                $descrOffre = $_POST["descrOffre"];
                ?>
                <div class="fondForm">
                    <H1 class="titres">Dépôt d'offre</H1>
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
                        <tr>
                            <td>
                                <input type="button" class="btnSuivant" name="modifier" value="Modifier" onclick="history.back()">
                            </td>
                            <td>
                                <input type="submit" class="btnSuivant" name="suivant" value="Valider">
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