<?php
require_once("../../ressources/donnees/BDD/bdd.php");
session_start();

if (!isset($_SESSION['siren'])) {
    header('location: ../Internaute/index.php');
} else {

    $siren = intval($_SESSION['siren']);
    $nomEntr = $_POST['nomEntr'];
    $domAct = $_POST['domAct'];
    $ville = $_POST['ville'];
    $CP = intval($_POST['CP']);
    $telEntr = $_POST['telEntr'];
    $nomResp = $_POST['nomResp'];
    $telResp = $_POST['telResp'];


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
        $queryUpdate = "UPDATE Entreprise SET nomEntreprise='$nomEntr', domaineActivite='$domAct', telephoneEntreprise='$telEntr',
        nomResponsable='$nomResp', telephoneResponsable='$telResp', idVille=$idVille WHERE siren=$siren";
        $res = mysqli_query($link, $queryUpdate);
    }

    mysqli_close($link);

    header('location: ../Entreprise/InformationsEntreprise.php');
}
?>