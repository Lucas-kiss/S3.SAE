<?php

    session_start();
    require_once ("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
    

    $siren = $_SESSION['siren'];
    
    // $nbHeureTotal = $_POST['nbHeureTotal'];
    $nbHeureTotal = 5;

    $query_id = "SELECT MAX(idOffre) FROM Offre";
    $result_id = mysqli_query($link, $query_id);

    while ($donnees=mysqli_fetch_assoc($result_id)) {
        $max = $donnees["MAX(idOffre)"] + 1;
    }

    echo $max.'</br>';
    
    $dateActuelle = date('Y-m-d H:i:s');
    $tauxHoraire = str_replace(",", ".", $_SESSION["tauxHoraire"]);
    $tauxHoraire = floatval($tauxHoraire);
    $intitOffre = $_SESSION["intitOffre"];
    $dateDeb = $_SESSION["dateDeb"];
    $dateFin = $_SESSION["dateFin"];
    $description = $_SESSION["descrOffre"];
    
    $query = "INSERT INTO Offre (idOffre, nomOffre, dateDepot, dateDeb, dateFin, nbHeureTotal, tauxHoraire, 'description', nbEtudRetenus`, estFinie, siren) VALUES ($max, '$intitOffre', '$dateActuelle', '$dateDeb', '$dateFin', $nbHeureTotal, $tauxHoraire, '$description', 0, 0, $siren)";
    $res = mysqli_query($link, $query);

    $query_id = "SELECT MAX(IdCreneau) FROM Creneau";
    $result_id = mysqli_query($link, $query_id);

    $IdCreneau = 1;

    while ($donnees = mysqli_fetch_assoc($result_id)) {
        $IdCreneau = $donnees["MAX(IdCreneau)"] + 1;
    }

    $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

    $last = 0;

    echo $IdCreneau.'</br>';

    foreach ($jourSem as &$jour) {

        $trouve = false;
        for ($i = 0; $i < 24; $i++) {
            $cle = $jour . $i;

            if ($trouve) {
                if (!isset($_POST[$cle]) || !$_POST[$cle] == 'on') {

                    $query1 = "INSERT INTO Creneau (IdCreneau, jour, heureDeb, heureFin) Values ($IdCreneau, '$jour', $heureDeb, $i)";

                    $query2 = "INSERT INTO Concerner (idOffre, idCreneau) Values ($max, $IdCreneau)";

                    echo 'fin ' . $cle . '</br>';

                    $result = mysqli_query($link, $query1);

                    $result = mysqli_query($link, $query2);

                    $IdCreneau++;

                    echo $IdCreneau.'</br>';

                    $trouve = false;
                }
            } else {
                if (isset($_POST[$cle]) && $_POST[$cle] == 'on') {
                    echo 'deb ' . $cle . '</br>';
                    $heureDeb = $i;
                    $trouve = true;
                }
            }
        }

        if ($trouve) {
            $query1 = "INSERT INTO Creneau (IdCreneau, jour, heureDeb, heureFin) Values ($IdCreneau, '$jour', $heureDeb, 24)";

            $query2 = "INSERT INTO Concerner (idOffre, idCreneau) Values ($max, $IdCreneau)";

            echo 'fin ' . $jour . '24</br>';

            $result = mysqli_query($link, $query1);

            $result = mysqli_query($link, $query2);

            $IdCreneau++;
        }
    }
    
    /*if ($res) {
        //header ('location: RecapFormDepotOffre.php');
    }
    else {
        echo "Insertion n'a pas fonctionné";
    }*/


        
?>