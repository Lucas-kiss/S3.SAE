<?php

    if(isset($_POST["suivant"])) {
        require ("../../ressources/donnees/BDD/bdd.php");
        session_start();
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

        // mettre date en format date
        $dateDebSec = strtotime($_POST["dateDeb"]);
        $dateDeb = getdate($dateDebSec);
        var_dump($dateDeb);
        var_dump($_POST["dateFin"]);
        
        $query = "INSERT INTO Offre VALUES ($max, '" . $_POST["intitOffre"] ."',  $dateActuelle, '". $_POST["dateDeb"] ."', '". $_POST["dateFin"] ."', $nbHeureTotal, $tauxHoraire, '" . $_POST["descrOffre"] ."', 0, 0, $siren);";
        
        $result= mysqli_query($link, $query);

        if ($result) {
            echo 'e';
        }

    }

        
?>