<?php
session_start();

require_once("../../ressources/donnees/BDD/bdd.php");

$siren = $_SESSION['siren'];
$nom = $_SESSION['nom'];
$domaine = $_SESSION['domaine'];
$ville = $_SESSION['ville'];
$telephone = $_SESSION['telephone'];
$nomResp = $_SESSION['nomResp'];
$telResp = $_SESSION['telResp'];
$mail = $_SESSION['mail'];
$MdP = $_SESSION['MdP'];
$CP = $_SESSION['CP'];


$query = "SELECT idVille From Ville where upper(nomVille) like upper(?) and upper(codePostal) like upper(?)";

$result = $link->prepare($query);

$result->bind_param("ss", $ville, $CP);

$result->execute();

$result->bind_result($idVille);

$result->fetch();
//echo "$idVille";

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
    //echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if ($link) {
    $queryInsertEnt = "INSERT INTO Entreprise (siren, nomEntreprise, domaineActivite, telephoneEntreprise, nomResponsable, telephoneResponsable, mailResponsable, mdpResponsable, idVille) Values ($siren, '$nom', '$domaine', '$telephone', '$nomResp', '$telResp', '$mail', '$MdP', $idVille)";

    $res = mysqli_query($link, $queryInsertEnt);
}
mysqli_close($link);
header('location: AccueilEntreprise.php');
?>