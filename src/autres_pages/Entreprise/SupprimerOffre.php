
<?php

require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();

if(isset($_GET['value'])) {
    $monOffre = $_GET['value'];

    $link=mysqli_connect($host, $user, $pass, $bdd) or die( "Impossible de se connecter à la base de données");
    mysqli_set_charset($link, 'utf8');

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    if ($link) {
        $query = "DELETE FROM Offre WHERE idOffre = $monOffre";
    }

    $res = mysqli_query($link, $query);
    if ($res) {
        header ('location: AccueilEntreprise.php');
    } else {
        echo "Suppression n'a pas fonctionné</br>";
    }
}

?>

