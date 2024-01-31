<?php
    session_start();

    require_once("../../ressources/donnees/BDD/bdd.php");

    $ine = $_SESSION['ine'];
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    $naissance = $_SESSION['naissance'];
    $adresse = $_SESSION['adresse'];
    $ville = $_SESSION['ville'];
    $pays = $_SESSION['pays'];
    $telephone = $_SESSION['telephone'];
    $mail = $_SESSION['mail'];
    $MdP = hash('sha1', $_SESSION['MdP']);
    $CP = intval($_SESSION['CP']);

    var_dump($ine);
    var_dump($prenom);
    var_dump($nom);
    var_dump($naissance);
    var_dump($adresse);
    var_dump($ville);
    var_dump($pays);
    var_dump($telephone);
    var_dump($mail);
    var_dump($MdP);
    var_dump($CP);

    $query = "SELECT idVille From Ville where upper(nomVille) like upper(?) and upper(codePostal) like upper(?)";

    $result = $link->prepare($query);

    $result->bind_param("ss", $ville, $CP);

    $result->execute();

    $result->bind_result($idVille);

    $result->fetch();
    echo "$idVille";

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
        $queryInsertEtu = "INSERT INTO Etudiant (ine, prenom, nom, dateNaiss, numTel, mailEtud, mdpEtud, idVille) Values ('$ine', '$prenom', '$nom', '$naissance', '$telephone', '$mail', '$MdP', $idVille)";

        $res = mysqli_query($link, $queryInsertEtu);
        if ($res) {
            echo 'Insertion fonctionnelle</br>';
        } else {
            echo "Insertion n'a pas fonctionné</br>";
        }

        $query_id = "SELECT MAX(IdCreneau) FROM Creneau";
        $result_id = mysqli_query($link, $query_id);

        $IdCreneau = 1;

        while ($donnees = mysqli_fetch_assoc($result_id)) {
            $IdCreneau = $donnees["MAX(IdCreneau)"] + 1;
        }

        $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

        $i = 0;

        $last = 0;

        echo $IdCreneau;

        foreach ($jourSem as &$jour) {

            $trouve = false;
            for ($i = 0; $i < 24; $i++) {
                $cle = $jour . $i;

                if ($trouve) {
                    if (!isset($_POST[$cle]) || !$_POST[$cle] == 'on') {

                        $query1 = "INSERT INTO Creneau (IdCreneau, jour, heureDeb, heureFin) Values ($IdCreneau, '$jour', $heureDeb, $i)";

                        $query2 = "INSERT INTO Posseder (ine, idCreneau) Values ('$ine', $IdCreneau)";

                        echo 'fin ' . $cle . '</br>';

                        $result = mysqli_query($link, $query1);

                        $result = mysqli_query($link, $query2);

                        $IdCreneau++;

                        echo $IdCreneau;

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

                echo 'fin ' . $jour . '24</br>';

                $result = mysqli_query($link, $query1);

                $result = mysqli_query($link, $query2);

                $IdCreneau++;
            }
        }
    }
    else {
        echo "problème de connexion à la bd";
    }

?>