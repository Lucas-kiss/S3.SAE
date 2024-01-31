<?php

require ("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP
session_start();

if (isset($_POST['connexion'])) {

    $link=mysqli_connect($host, $user, $pass, $bdd) or die( "Impossible de se connecter à la base de données");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $mail = $_POST['mail'];
    $mdp = hash('sha1', $_POST['MdP']);

    $queryEntr = 'SELECT * FROM Entreprise WHERE mailResponsable = "'.$mail.'" AND mdpResponsable = "'.$mdp.'";';
    $resultEntr = mysqli_query($link, $queryEntr);    

    if ($link) {    // si la requête a fonctionné
        if ($link->affected_rows> 0) {    // si la requête a retourné au moins un enregistrement
            while ($donnees=mysqli_fetch_assoc($resultEntr)) {
                $_SESSION['siren'] = intval($donnees["siren"]);
                header ('location: ../Entreprise/FormDepotOffre.php');
            }
        }
        $queryEtud = 'SELECT * FROM Etudiant WHERE mailEtud = "'.$mail.'" AND mdpEtud = "'.$mdp.'";';
        $resultEtud = mysqli_query($link, $queryEtud);  

        if ($link->affected_rows> 0) {    // si la requête a retourné au moins un enregistrement
            while ($donnees=mysqli_fetch_assoc($resultEtud)) {
                $_SESSION['ine'] = $donnees["ine"];
                header ('location: ../Etudiant/FormulaireEtudiant.php');
            }
        } 
    }
    else {
        echo "<p>Aucun compte lié au mail et mdp saisis</p>";
    }
}
    

?>
