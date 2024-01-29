<?php

    if(isset($_POST["suivant"])) {
        require ("../../ressources/donnees/BDD/bdd.php");
        session_start();

        if(!isset($_SESSION["username"])){
           exit();
        }
        



    // if(isset($_POST["suivant"])) {
    //     require ("../../ressources/donnees/BDD/bdd.php");

    //     $nbHeureTotal = ??;

    //     $link=mysqli_connect($host, $user, $pass, $bdd) or die( "Impossible de se connecter à la base de données");

    //     if (mysqli_connect_errno()) {
    //         echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //         exit();
    //     }

    //     $query = "INSERT INTO Offre VALUES (id, $_POST[intitOffre],  date('d-m-y h:i:s'), $_POST["dateDeb"], $_POST["dateFin"], $nbHeureTotal, $_POST["descrOffre"], 0, 0, siren";
    //     $result= mysqli_query($link, $query);
    //     print_r($result);
    }
?>