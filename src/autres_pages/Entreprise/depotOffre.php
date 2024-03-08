<?php

session_start();
require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP


$siren = $_SESSION['siren'];

// $nbHeureTotal = $_POST['nbHeureTotal'];
$nbHeureTotal = 0;
$jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

foreach ($jourSem as &$jour) {
    for ($i = 0; $i < 24; $i++) {
        $cle = $jour . $i;
        if (isset($_POST[$cle]) && $_POST[$cle] == 'on') {
            $nbHeureTotal++;
        }
    }
}

$query_id = "SELECT MAX(idOffre) FROM Offre";
$result_id = mysqli_query($link, $query_id);

$max = 0;

while ($donnees = mysqli_fetch_assoc($result_id)) {
    $max = $donnees["MAX(idOffre)"] + 1;
}

//var_dump($max);

//echo $max.'</br>';

$dateActuelle = date('Y-m-d H:i:s');
$tauxHoraire = str_replace(",", ".", $_SESSION["tauxHoraire"]);
$tauxHoraire = floatval($tauxHoraire);
$intitOffre = $_SESSION["intitOffre"];
$dateDeb = $_SESSION["dateDeb"];
$dateFin = $_SESSION["dateFin"];
$description = $_SESSION["descrOffre"];

/*var_dump($dateActuelle);
var_dump($tauxHoraire);
var_dump($intitOffre);
var_dump($dateDeb);
var_dump($dateFin);
var_dump($description);
var_dump($nbHeureTotal);
var_dump($siren);*/

//(idOffre, nomOffre, dateDepot, dateDeb, dateFin, nbHeureTotal, tauxHoraire, description, nbEtudRetenus, estFinie, siren)

$query = "INSERT INTO Offre VALUES ($max, '$intitOffre', '$dateActuelle', '$dateDeb', '$dateFin', $nbHeureTotal, $tauxHoraire, '$description', 0, 0, $siren)";
$res = mysqli_query($link, $query);

$query_id = "SELECT MAX(IdCreneau) FROM Creneau";
$result_id = mysqli_query($link, $query_id);

$IdCreneau = 1;

while ($donnees = mysqli_fetch_assoc($result_id)) {
    $IdCreneau = $donnees["MAX(IdCreneau)"] + 1;
}

$last = 0;

//echo $IdCreneau.'</br>';

foreach ($jourSem as &$jour) {

    $trouve = false;
    for ($i = 0; $i < 24; $i++) {
        $cle = $jour . $i;

        if ($trouve) {
            if (!isset($_POST[$cle]) || !$_POST[$cle] == 'on') {

                $query1 = "INSERT INTO Creneau (IdCreneau, jour, heureDeb, heureFin) Values ($IdCreneau, '$jour', $heureDeb, $i)";

                $query2 = "INSERT INTO Concerner (idOffre, idCreneau) Values ($max, $IdCreneau)";

                //echo 'fin ' . $cle . '</br>';

                $result = mysqli_query($link, $query1);

                $result = mysqli_query($link, $query2);

                $IdCreneau++;

                //echo $IdCreneau.'</br>';

                $trouve = false;
            }
        } else {
            if (isset($_POST[$cle]) && $_POST[$cle] == 'on') {
                //echo 'deb ' . $cle . '</br>';
                $heureDeb = $i;
                $trouve = true;
            }
        }
    }

    if ($trouve) {
        $query1 = "INSERT INTO Creneau (IdCreneau, jour, heureDeb, heureFin) Values ($IdCreneau, '$jour', $heureDeb, 0)";

        $query2 = "INSERT INTO Concerner (idOffre, idCreneau) Values ($max, $IdCreneau)";

        //echo 'fin ' . $jour . '24</br>';

        $result = mysqli_query($link, $query1);

        $result = mysqli_query($link, $query2);

        $IdCreneau++;
    }
}

if ($res) {
    header('location: ../Entreprise.AccueilEntreprise.php');
} else {
    echo "Insertion n'a pas fonctionné";
}
mysqli_close($link);
?>