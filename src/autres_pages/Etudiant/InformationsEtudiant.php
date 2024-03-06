<?php
require_once("../../ressources/donnees/BDD/bdd.php");
session_start();

if (!isset($_SESSION['ine'])) 
{
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>1PtitJob - Informations de mon profil</title>
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
        <?php 
            $ine = $_SESSION['ine'];

            $query_etud = "SELECT * FROM Etudiant JOIN Ville ON Etudiant.idVille = Ville.idVille WHERE ine = '$ine';";
            $result_etud = mysqli_query($link, $query_etud);

            while ($donnees = mysqli_fetch_assoc($result_etud)) {
                $prenom = $donnees["prenom"];
                $nom = $donnees["nom"];
                $dateNaiss = $donnees["dateNaiss"];
                $numTel = $donnees["numTel"];
                $mailEtud = $donnees["mailEtud"];
                $nomVille = $donnees["nomVille"];
                $cp = $donnees["codePostal"];
            }
            mysqli_close($link);
            ?>

            <div class="fondForm">
                <?php
                if ($_POST)
                {
                    ?>
                    <H1 class="titres">Modifier mes informations</H1>
                    <div class="separation"></div>
                    <form action="ModifInformationsEtudiant.php" method="POST">
                        <table class="tabOffre">
                            <tbody>
                            <tr>
                                <?php
                                echo "<input type='hidden' name='ine' value=$ine>";
                                ?>
                                <th><label for="prenom">Prénom :</label></th>
                                <td><input type="text" class="boiteTexte" id="prenom" name="prenom" pattern="[a-zA-ZÀ-ÿ]+"
                                        title="Lettres uniquements" placeholder="Xavier" value=<?php echo $prenom ?> /> </td>
                            </tr>
                            <tr>
                                <th><label for="nom">Nom :</label></th>
                                <td><input type="text" class="boiteTexte" id="nom" name="nom" pattern="[a-zA-ZÀ-ÿ]+"
                                        title="Lettres uniquements" placeholder="Dupont" value=<?php echo $nom ?> /></td>
                            </tr>
                            <tr>
                                <th><label for="naissance">Date de naissance :</label></th>
                                <td><input type="date" id="naissance" name="naissance" required title="Vous devez avoir 16ans"
                                        max="<?php echo (new DateTime())->sub(new DateInterval('P16Y'))->format('Y-m-d'); ?>"
                                        value=<?php echo $dateNaiss ?> />
                                    </td>
                            </tr>
                            <tr>
                                <th><label for="ville">Ville :</label></th>
                                <td><input type="text" id="ville" name="ville" pattern="[^0-9]+"
                                        title="Lettres uniquements (espace et - autorisé)" placeholder="Anglet" value=<?php echo $nomVille ?> />
                                </td>
                            </tr>
                            <tr>
                                <th><label for="CP">Code postal :</label></th>
                                <td><input type="text" id="CP" name="CP" pattern="[0-9]{5}" title="Série de 5 Chiffre"
                                        placeholder="64600" value=<?php echo $cp ?> /></td>
                            </tr>
                            <tr>
                                <th><label for="telephone">Téléphone :</label></th>
                                <td><input type="tel" class="boiteTexte" id="telephone" name="telephone"
                                        pattern="[0]{1}[0-9]{9}" title="Numéro à 10 Chiffres qui commance par 0"
                                        placeholder="0612345789" value=<?php echo $numTel ?> /> </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="reset" class="connexion" value="Réinitialiser" />
                                    <input type="submit" class="connexion" value="Valider">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                    <?php
                }
                else
                {
                    ?>
                    <H1 class="titres">Mes informations</H1>
                    <div class="separation"></div>
                    <form action="InformationsEtudiant.php" method="POST">
                    <table class="tabOffre">
                        <tr>
                            <td><label for="ine">INE</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input readonly class="champsRecap" type="text" name="ine" value=<?php echo $ine ?> />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="nom">Nom</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input readonly class="champsRecap" type="text" name="nom" value=<?php echo $nom ?> />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="prenom">Prénom</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input readonly class="champsRecap" type="text" name="prenom" value=<?php echo $prenom ?> />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="dateNaiss">Date de naissance</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input readonly class="champsRecap" type="text" name="dateNaiss" value=<?php echo $dateNaiss ?> />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="ville">Ville</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input readonly class="champsRecap" type="text" name="ville" value=<?php echo $nomVille ?> />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="cp">Code postal</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input readonly class="champsRecap" type="text" name="cp" value=<?php echo $cp ?> />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="mail">Adresse e-mail</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input readonly class="champsRecap" type="text" name="mail" value=<?php echo $mailEtud ?> />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="tel">Numéro de téléphone</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input readonly class="champsRecap" type="text" name="tel" value=<?php echo $numTel ?> />
                            </td>
                        </tr>
                        <tr>
                            <td> 
                                <input type="submit" class="connexion" name="ModifInfosEtu" value="Modifier les informations"> 
                        </tr>

                    </table>
                </form>
                    <?php
                }
                ?>

                    
                
                <a href=../logout.php>Se déconnecter</a>
            </div>
            <?php
        ?>


</body>

</html>