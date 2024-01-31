<?php
if (isset($_POST["suivant"])) {
    require_once("../../ressources/donnees/BDD/bdd.php");
    session_start();
    $siren = $_SESSION['siren'];

    if ($_POST["dateDeb"] <= $_POST["dateFin"]) {
        ?>

        <!DOCTYPE html>
        <html lang="fr">

        <head>
            <meta charset="UTF-8">
            <title>1PtitJob - Dépôt d'offre</title>
            <link rel="stylesheet" href="../Internaute/style.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        </head>

        <nav>
            <div class=wrapper>
                <img class="logo" src="../../ressources/img/1ptitjob_logo.PNG" width="60" height="60" />
                <h1 class="titre">1P'titJob</h1>
                <a href="monCompteEntreprise.php" class="connexion">Mon Compte</a>
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
                            <label class="etoile">* </label><label class="champsObl">Champs obligatoires<label>
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
    } else {
        echo "<div class='alert alert-danger' role='alert'>
        Erreur : la date de début de l'offre doit être inférieure à celle de fin ! </div>";
    }
}
?>