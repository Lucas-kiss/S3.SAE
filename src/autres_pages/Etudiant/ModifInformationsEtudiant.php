<?php
require_once("../../ressources/donnees/BDD/bdd.php");
session_start();

if (!isset($_SESSION['ine'])) {
    header('location: ../Internaute/index.php');
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
        $ine = $_POST['ine'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $naissance = $_POST['naissance'];
        $ville = $_POST['ville'];
        $CP = intval($_POST['CP']);
        $telephone = $_POST['telephone'];
        $mail = $_POST['mail'];

        $query = "SELECT idVille From Ville where upper(nomVille) like upper(?) and upper(codePostal) like upper(?)";
        $result = $link->prepare($query);
        $result->bind_param("ss", $ville, $CP);
        $result->execute();
        $result->bind_result($idVille);
        $result->fetch();

        if (!$idVille) {
            $query_id = "SELECT MAX(idVille) FROM Ville";
            $result_id = mysqli_query($link, $query_id);
    
            $idVille = 1;
    
            while ($donnees = mysqli_fetch_assoc($result_id)) {
                $idVille = $donnees["MAX(idVille)"] + 1;
            }
    
            $query = "INSERT INTO Ville (idVille, nomVille, codePostal) Values ($idVille, '$ville', $CP)";
    
            $result = mysqli_query($link, $query);
    
            $query = "SELECT idVille From Ville where upper(nomVille) like upper(?)";
    
            $result = $link->prepare($query);
    
            $result->bind_param("s", $ville);
    
            $result->execute();
    
            $result->bind_result($idVille);
    
            $result->fetch();
        }
        $link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la base de données");
    
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        

        ?>




    </body>

</html>