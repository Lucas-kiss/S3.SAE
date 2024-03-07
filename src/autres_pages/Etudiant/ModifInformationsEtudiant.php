<?php
require_once("../../ressources/donnees/BDD/bdd.php");
session_start();

if (!isset($_SESSION['ine'])) {
    header('location: ../Internaute/index.php');
} else {

    $ine = $_SESSION['ine'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $naissance = $_POST['naissance'];
    $ville = $_POST['ville'];
    $CP = intval($_POST['CP']);
    $telephone = $_POST['telephone'];

    $query = "SELECT idVille From Ville where upper(nomVille) like upper(?) and upper(codePostal) like upper(?)";
    $result = $link->prepare($query);
    $result->bind_param("ss", $ville, $CP);
    $result->execute();
    $result->bind_result($idVille);
    $result->fetch();

    if (!$idVille) {
        $query_id = "SELECT MAX(idVille) FROM Ville";
        $result_id = mysqli_query($link, $query_id);

        $idVille = 1;

        while ($donnees = mysqli_fetch_assoc($result_id)) {
            $idVille = $donnees["MAX(idVille)"] + 1;
        }

        $query = "INSERT INTO Ville (idVille, nomVille, codePostal) Values ($idVille, '$ville', $CP)";

        $result = mysqli_query($link, $query);

        $query = "SELECT idVille From Ville where upper(nomVille) like upper(?)";

        $result = $link->prepare($query);

        $result->bind_param("s", $ville);

        $result->execute();

        $result->bind_result($idVille);

        $result->fetch();
    }
    $link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la base de données");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    if ($link) {
        $queryUpdate = "UPDATE Etudiant SET prenom='$prenom', nom='$nom', dateNaiss='$naissance', numTel='$telephone', idVille=$idVille WHERE ine='$ine'";


        $res = mysqli_query($link, $queryUpdate);
    }

    // Créneaux

    // suppression des liaisons entre les creneaux existants et l'etudiant
    $querySuppPosseder = "DELETE FROM Posseder WHERE ine='$ine'";
    $resSuppPosseder = mysqli_query($link, $querySuppPosseder);


    $query_id = "SELECT MAX(IdCreneau) FROM Creneau";
    $result_id = mysqli_query($link, $query_id);

    $idCreneauMax = 1;

    while ($donnees = mysqli_fetch_assoc($result_id)) {
        $idCreneauMax = $donnees["MAX(IdCreneau)"] + 1;
    }

    $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

    $i = 0;

    $last = 0;


    foreach ($jourSem as &$jour) {

        $trouve = false;
        for ($i = 0; $i < 24; $i++) {
            $cle = $jour . $i;

            if ($trouve) {
                if (!isset($_POST[$cle]) || !$_POST[$cle] == 'on') {

                    $queryVerifCreneau = "SELECT * FROM Creneau WHERE jour='$jour' AND heureDeb=$heureDeb AND heureFin=$i";
                    $resVerifCreneau = mysqli_query($link, $queryVerifCreneau);
                    if ($link->affected_rows > 0) {
                        while ($donnees = mysqli_fetch_assoc($resVerifCreneau)) {
                            $idCreneau = $donnees["IdCreneau"];
                        }
                        // faire le lien dans posseder entre creneau et etudiant
                        $queryInsertPosseder = "INSERT INTO Posseder (ine, idCreneau) Values ('$ine', $idCreneau)";
                        $resInsertPosseder = mysqli_query($link, $queryInsertPosseder);
                    } else {
                        // creation du creneau
                        $idCreneau = $idCreneauMax;
                        $queryInsertCreneau = "INSERT INTO Creneau (IdCreneau, jour, heureDeb, heureFin) Values ($idCreneau, '$jour', $heureDeb, $i)";
                        $resInsertCreneau = mysqli_query($link, $queryInsertCreneau);
                        // faire le lien dans posseder entre creneau et etudiant
                        $queryInsertPosseder = "INSERT INTO Posseder (ine, idCreneau) Values ('$ine', $idCreneau)";
                        $resInsertPosseder = mysqli_query($link, $queryInsertPosseder);

                        $idCreneauMax++;
                    }
                    $trouve = false;
                }
            } else {
                if (isset($_POST[$cle]) && $_POST[$cle] == 'on') {
                    $heureDeb = $i;
                    $trouve = true;
                }
            }
        }

        if ($trouve) {

            $queryVerifCreneau = "SELECT * FROM Creneau WHERE jour='$jour' AND heureDeb=$heureDeb AND heureFin=$i";
            $resVerifCreneau = mysqli_query($link, $queryVerifCreneau);
            if ($link->affected_rows > 0) {
                while ($donnees = mysqli_fetch_assoc($resVerifCreneau)) {
                    $idCreneau = $donnees["idCreneau"];
                }
                // faire le lien dans posseder entre creneau et etudiant
                $queryInsertPosseder = "INSERT INTO Posseder (ine, idCreneau) Values ('$ine', $idCreneau)";
                $resInsertPosseder = mysqli_query($link, $queryInsertPosseder);
            } else {
                // creation du creneau
                $idCreneau = $idCreneauMax;
                $queryInsertCreneau = "INSERT INTO Creneau (IdCreneau, jour, heureDeb, heureFin) Values ($idCreneau, '$jour', $heureDeb, $i)";
                $resInsertCreneau = mysqli_query($link, $queryInsertCreneau);
                // faire le lien dans posseder entre creneau et etudiant
                $queryInsertPosseder = "INSERT INTO Posseder (ine, idCreneau) Values ('$ine', $idCreneau)";
                $resInsertPosseder = mysqli_query($link, $queryInsertPosseder);

                $idCreneauMax++;
            }
        }
    }
    // supprimer les creneaux inutilisés
    $querySuppCreneau = "DELETE FROM Creneau WHERE IdCreneau NOT IN (SELECT idCreneau FROM Posseder) AND IdCreneau NOT IN (SELECT IdCreneau FROM Concerner)";
    $resSuppCreneau = mysqli_query($link, $querySuppCreneau);
    mysqli_close($link);

    header('location: ../Etudiant/InformationsEtudiant.php');
}
