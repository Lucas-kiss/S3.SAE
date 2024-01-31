<?php

    if(isset($_POST["suivant"])) {
        require_once ("../../ressources/donnees/BDD/bdd.php");
        session_start();

        $siren = $_SESSION['siren'];
        
        // $nbHeureTotal = $_POST['nbHeureTotal'];
        $nbHeureTotal = 5;

        $query_id = "SELECT MAX(idOffre) FROM Offre";
        $result_id = mysqli_query($link, $query_id);

        while ($donnees=mysqli_fetch_assoc($result_id)) {
            $max = $donnees["MAX(idOffre)"] + 1;
        }

        $dateActuelle = date('Y-m-d H:i:s');
        $tauxHoraire = str_replace(",", ".",$_POST["tauxHoraire"]);
        $tauxHoraire = floatval($tauxHoraire);
        $intitOffre = $_POST["intitOffre"];
        $dateDeb = $_POST["dateDeb"];
        $dateFin = $_POST["dateFin"];
        $description = $_POST["descrOffre"];
        
        $query = "INSERT INTO Offre VALUES ($max,'$intitOffre' , '$dateActuelle', '$dateDeb', '$dateFin', $nbHeureTotal, $tauxHoraire, '$description', 0, 0, $siren)";
        $res = mysqli_query($link, $query);
        
        if ($res) {
            echo 'Insertion fonctionnelle';
        }
        else {
            echo "Insertion n'a pas fonctionné";
        }
    }
        
?>