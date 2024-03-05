<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob - Inscription Etudiant</title>
        <link rel="stylesheet" href="../Internaute/style.css">
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

        
        <form action="Horaire.php" method="POST">
            <div class="fondForm">
            <H1 class="titreDepot">Mes Inscriptions</H1>
                <table class="tabOffre">
                    <tbody>
                        <tr>
                            <th><label for="ine">Numéro INE :</label></th>
                            <td><input type="text" class="boiteTexte" id="ine" name="ine" pattern="[0-9]{9}[0-9A-Z]{1}[A-Z]{1}" title="9 Chiffres + 2 Lettres ou 10 Chiffres + 1 Lettre" placeholder="123456789AB" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="prenom">Prénom :</label></th>
                            <td><input type="text" class="boiteTexte" id="prenom" name="prenom" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="Xavier" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="nom">Nom :</label></th>
                            <td><input type="text" class="boiteTexte" id="nom" name="nom" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="Dupont" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="naissance">Date de naissance :</label></th>
                            <td><input type="date" id="naissance" name="naissance" required title="Vous devez avoir 16ans" max="<?php echo (new DateTime())->sub(new DateInterval('P16Y'))->format('Y-m-d'); ?>"/> *</td>
                        </tr>
                        <tr>
                            <th><label for="ville">Ville :</label></th>
                            <td><input type="text" id="ville" name="ville" pattern="[^0-9]+" title="Lettres uniquements (espace et - autorisé)" placeholder="Anglet" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="CP">Code postale :</label></th>
                            <td><input type="text" id="CP" name="CP" pattern="[0-9]{5}" title="Série de 5 Chiffre" placeholder="64600" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="telephone">Téléphone :</label></th>
                            <td><input type="tel" class="boiteTexte" id="telephone" name="telephone" pattern="[0]{1}[0-9]{9}" title="Numéro à 10 Chiffres qui commance par 0" placeholder="0612345789" required/> *</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" id="notrobot" required/>
                                <label for="notrobot">Je ne suis pas un robot *</label>
                            </td>
                            <td>
                                <input type="reset" value="Réinitialiser" />
                                <input type="submit" value="Suivant">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h6>* Champs obligatoires</h6>
            </div>
        </form>
    </body>
</html>