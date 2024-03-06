<?php
	$bdd= "lkiss_bd"; // Base de données
    $host= "localhost";
    $user= "root"; // Utilisateur
    $pass= "root"; // mp

    $link=mysqli_connect($host, $user, $pass, $bdd) or die( "Impossible de se connecter à la base de données");
    mysqli_set_charset($link, 'utf8');

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
?>