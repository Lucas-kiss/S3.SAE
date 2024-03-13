<?php

require_once ("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();

if (isset($_POST['connexion'])) {

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $mail = $_POST['mail'];
    $mdp = hash('sha1', $_POST['MdP']);

    $trouve = false; // Retourne vrai si un compte lié au mail et au mot de passe saisis a été trouvé, faux sinon

    // Table Entreprise
    $queryEntr = 'SELECT * FROM Entreprise WHERE mailResponsable = "'.$mail.'" AND mdpResponsable = "'.$mdp.'";';
    $resultEntr = mysqli_query($link, $queryEntr);    

    if ($link) {    // si la requête a fonctionné
        if ($link->affected_rows> 0) {    // si la requête a retourné au moins un enregistrement d'entreprise
            $trouve = true;
            while ($donnees=mysqli_fetch_assoc($resultEntr)) {
                $_SESSION['siren'] = $donnees["siren"];
                header ('location: ../Entreprise/AccueilEntreprise.php');
            }
        }
    }

    // Table Etudiant
    $queryEtud = 'SELECT * FROM Etudiant WHERE mailEtud = "'.$mail.'" AND mdpEtud = "'.$mdp.'";';
    $resultEtud = mysqli_query($link, $queryEtud); 

    if ($link) {    // si la requête a fonctionné
        if ($link->affected_rows> 0) {    // si la requête a retourné au moins un enregistrement d'étudiant
            $trouve = true;
            while ($donnees=mysqli_fetch_assoc($resultEtud)) {
                $_SESSION['ine'] = $donnees["ine"];
                echo "<script>alert('Connexion réussi');
                window.location.href = '../Internaute/index.php';
                </script>";
            }
        } 
    }
    mysqli_close($link);

    if (!($trouve)) { 
        echo "<script>alert('Informations de connexion incorrect');
        window.location.href = '../Internaute/Connexion.html';
        </script>";
    }
}
    

?>
