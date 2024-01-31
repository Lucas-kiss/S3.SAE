<?php
	$bdd= "lkiss_bd"; // Base de données
    $host= "lakartxela.iutbayonne.univ-pau.fr";
    $user= "lkiss_bd"; // Utilisateur
    $pass= "lkiss_bd"; // mp

    $link=mysqli_connect($host, $user, $pass, $bdd) or die( "Impossible de se connecter à la base de données");
    mysqli_set_charset($link, 'utf8');

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
?>