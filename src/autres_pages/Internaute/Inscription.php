<?php
session_start();

if (isset($_POST['MdP'])) {
    if (!preg_match('/[A-Z]/', $_POST['MdP']) || !preg_match('/[a-z]/', $_POST['MdP']) || !preg_match('/[0-9]/', $_POST['MdP']) || !preg_match('/[^a-zA-Z0-9]/', $_POST['MdP'])) {
        echo "Mot de passe erroné, pensez à respecter la contrainte !";
    } else if ($_POST['MdP'] != $_POST['ConfirmMdP']) {
        echo "Veuillez reseigné le même mot de passe !";
    } else {
        $maildécoupé = explode('@', $_POST['mail']);

        if (substr($maildécoupé[0], 0) === '.' || substr($maildécoupé[0], -1) === '.' || count(explode('.', end($maildécoupé))) <= 1) {
            echo "Mail erroné, il faut un '.' après le '@' mais pas de '.' ni juste avant le '@' ni au tout début du mail !";
        } else {

            $_SESSION['mail'] = $_POST['mail'];
            $_SESSION['MdP'] = $_POST['MdP'];

            if ($_POST['Type'] == "etudiant") {
                header('location: ../Etudiant/FormulaireEtudiant.php');
            } else {
                header('location: ../Entreprise/FormulaireEntreprise.php');
            }

        }

    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>1PtitJob - Inscription</title>
    <link rel="stylesheet" href="style.css">
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
    <div class="fondForm">
        <H1 class="titres">Inscription</H1>
        <hr><br>
        <form action="Inscription.php" method="POST">
            <table>
                <tbody>
                    <tr>
                        <th><label for="Type">Je suis :</label></th>
                        <td>
                            <input type="radio" id="etudiant" name="Type" value="etudiant" checked /><label
                                for="etudiant">un étudiant</label>
                            <input type="radio" id="entreprise" name="Type" value="entreprise" /><label
                                for="entreprise">une
                                entreprise</label>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="mail">Adresse e-mail :</label></th>
                        <td><input type="email" id="mail" name="mail" placeholder="exemple@domaine.fr" required /></td>
                    </tr>
                    <tr>
                        <th>
                            <label for="MdP">Mot de passe :</label>
                        </th>
                        <td>
                            <input type="password" id="MdP" name="MdP" minlength="8" required />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label>8 caractères minimum, dont 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère
                                spécial</label></td>
                    </tr>
                    <tr>
                        <th><label for="ConfirmMdP">Confirmer le mot de passe :</label></th>
                        <td><input type="password" id="ConfirmMdP" name="ConfirmMdP" required /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Suivant" class="connexion"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

</body>

</html>