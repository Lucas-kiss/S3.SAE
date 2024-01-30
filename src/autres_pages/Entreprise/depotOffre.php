<?php

    if(isset($_POST["suivant"])) {
        require ("../../ressources/donnees/BDD/bdd.php");
        session_start();

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $siren = $_SESSION['siren'];
        
        // $nbHeureTotal = $_POST['nbHeureTotal'];
        $nbHeureTotal = 5;

        $query_id = "SELECT MAX(idOffre) FROM Offre";
        $result_id = mysqli_query($link, $query_id);

        while ($donnees=mysqli_fetch_assoc($result_id)) {
            $max = $donnees["MAX(idOffre)"] + 1;
        }

        $dateActuelle = date('yyyy-mm-dd hh:mm:ss');
        $tauxHoraire = str_replace(",", ".",$_POST["tauxHoraire"]);
        $tauxHoraire = floatval($tauxHoraire);

        $dateTest = "2022-04-07 08:00:00";
        $dateTestDeb = "2023-01-01";
        $dateTestFin = "2023-01-10";

        // mettre date en format date
        $intitOffre = $_POST["intitOffre"];
        $dateDeb = $_POST["dateDeb"];
        $dateFin = $_POST["dateFin"];
        $description = $_POST["descrOffre"];
 
        var_dump($max);
        var_dump($intitOffre);
        var_dump($dateTest);
        var_dump($dateTestDeb);
        var_dump($dateTestFin);
        var_dump($nbHeureTotal);
        var_dump($tauxHoraire);
        var_dump($description);
        var_dump($siren);
        
        // $query = "INSERT INTO Offre VALUES ($max, '" . $_POST["intitOffre"] ."',  $dateActuelle, '". $_POST["dateDeb"] ."', '". $_POST["dateFin"] ."', $nbHeureTotal, $tauxHoraire, '" . $_POST["descrOffre"] ."', 0, 0, $siren);";
        $query = "INSERT INTO Offre (
        VALUES ($max, $intitOffre,  $dateTest, $dateTestDeb , $dateTestFin, $nbHeureTotal, $tauxHoraire, $description, 0, 0, $siren)";


        $result= mysqli_query($link, $query);
        

        // $result= mysqli_query($link, $query);

        if ($result) {
            echo 'e';
        }

    }

        
?>