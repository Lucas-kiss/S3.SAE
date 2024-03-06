<!DOCTYPE html>
<html lang="fr">

<head></head>

<body>
    <dialog open>
    <h3>Souhaitez-vous vraiment supprimer cette offre ?</h3>
    <p>Votre action ne pourra pas être annulée</p>
    <form method="dialog">
        <button onclick="">Oui</button>
        <button>Non</button>
    </form>
    </dialog>
</body>

<?php
require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();

if(isset($_GET['value'])) {
    $numOffre = $_GET['value'];

    $link=mysqli_connect($host, $user, $pass, $bdd) or die( "Impossible de se connecter à la base de données");
    mysqli_set_charset($link, 'utf8');

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    if ($link) {
        $query = "DELETE FROM Offre WHERE idOffre = $numOffre";
    }

    $res = mysqli_query($link, $queryInsertEntr);
    if ($res) {
        echo 'Suppression fonctionnelle</br>';
    } else {
        echo "Suppression n'a pas fonctionné</br>";
    }
}

?>