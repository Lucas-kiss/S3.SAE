<?php
require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();

if (isset($_POST['siren'])) {

    $siren = $_POST['siren'];
    $queryVerifSiren = "SELECT * From Entreprise WHERE siren LIKE $siren";
    $resVerifSiren = mysqli_query($link, $queryVerifSiren);

    if ($link && $link->affected_rows == 0) {
        $_SESSION['siren'] = $_POST['siren'];
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['domaine'] = $_POST['domaine'];
        $_SESSION['ville'] = $_POST['ville'];
        $_SESSION['telephone'] = $_POST['telephone'];
        $_SESSION['nomResp'] = $_POST['nomResp'];
        $_SESSION['telResp'] = $_POST['telResp'];
        $_SESSION['MdP'] = hash('sha1', $_SESSION['MdP']);
        $_SESSION['CP'] = intval($_POST['CP']);


        header('location: ../Entreprise/Insert.php');
    } else {
        echo "<script>alert('Siren déjà utilisé');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>1PtitJob - Inscription Entreprise</title>
    <link rel="stylesheet" href="../Internaute/style.css">
</head>

<body>
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


    <form action="FormulaireEntreprise.php" method="POST">
        <div class="fondForm">
            <H1 class="titres">Inscription</H1>
            <table>
                <tbody>
                    <tr>
                        <th><label for="siren">Numéro SIREN :</label></th>
                        <td><input type="text" class="boiteTexte" id="siren" name="siren" pattern="[0-9]{9}"
                                title="9 Chiffres" placeholder="123456789" required /> *</td>
                    </tr>
                    <tr>
                        <th><label for="nom">Nom de l'entreprise :</label></th>
                        <td><input type="text" class="boiteTexte" id="nom" name="nom" maxlength="50" placeholder="E.Leclerc"
                                required /> *</td>
                    </tr>
                    <tr>
                        <th><label for="domaine">Domaine d'activité :</label></th>
                        <td><input type="text" class="boiteTexte" id="domaine" name="domaine" maxlength="50"
                                placeholder="Grande distribution" required /> *</td>
                    </tr>
                    <tr>
                        <th><label for="ville">Ville :</label></th>
                        <td><input type="text" class="boiteTexte" id="ville" name="ville" pattern="[a-zA-ZÀ-ÿ]+"
                                title="Lettres uniquements" placeholder="Anglet" required /> *</td>
                    </tr>
                    <tr>
                        <th><label for="CP">Code postal :</label></th>
                        <td><input type="text" class="boiteTexte" id="CP" name="CP" pattern="[0-9]{5}" title="Série de 5 Chiffre"
                                placeholder="64600" required /> *</td>
                    </tr>
                    <tr>
                        <th><label for="telephone">Téléphone de l'entreprise:</label></th>
                        <td><input type="tel" class="boiteTexte" id="telephone" name="telephone"
                                pattern="[0]{1}[0-9]{9}" title="Numéro à 10 Chiffres qui commance par 0"
                                placeholder="0612345789" required /> *</td>
                    </tr>
                    <tr>
                        <th><label for="nomResp">Nom du responsable :</label></th>
                        <td><input type="text" class="boiteTexte" id="nomResp" name="nomResp" pattern="[a-zA-ZÀ-ÿ]+"
                                title="Lettres uniquements" placeholder="DUPONT" maxlength="50" required /> *</td>
                    </tr>
                    <tr>
                        <th><label for="telResp">Téléphone du responsable :</label></th>
                        <td><input type="tel" class="boiteTexte" id="telResp" name="telResp" pattern="[0]{1}[0-9]{9}"
                                title="Numéro à 10 Chiffres qui commance par 0" placeholder="0612345789" required /> *
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="notrobot" required />
                            <label for="notrobot">Je ne suis pas un robot *</label>
                        </td>
                        <td>
                            <input type="reset" value="Réinitialiser" class="connexion" />
                            <input type="submit" value="S'inscrire" class="connexion">
                        </td>
                    </tr>
                </tbody>
            </table>
            <h6>* Champs obligatoires</h6>
        </div>
    </form>
</body>

</html>