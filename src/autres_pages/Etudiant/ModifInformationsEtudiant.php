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
        <?php
        $ine = $_SESSION['ine'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $naissance = $_POST['naissance'];
        $ville = $_POST['ville'];
        $CP = intval($_POST['CP']);
        $telephone = $_POST['telephone'];

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
        
        if ($link) {
            $queryUpdate = "UPDATE Etudiant SET prenom='$prenom', nom='$nom', dateNaiss='$naissance', numTel='$telephone', idVille=$idVille WHERE ine='$ine'";


            $res = mysqli_query($link, $queryUpdate);
            if ($res) {
                header('location: ../Etudiant/informationsEtudiant.php');
            } else {
                echo "insertion n'a pas fonctionné";
            }  
            mysqli_close($link);      
        }
        
        ?>

    </body>

</html>