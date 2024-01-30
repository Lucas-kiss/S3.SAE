<?php
    session_start();

    require_once("../../ressources/donnees/BDD/bdd.php");

    $link = mysqli_connect($host, $user, $pass, $bdd) or die ("Error de BDD");

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

    /*$query = "Select idVille From Ville where upper(nomVille) like upper(?)";

    $result = $link->prepare($query);

    $result->bind_param("s", $ville);

    $result->execute();

    $result->bind_result($idVille);

    $result->fetch();

    if (!$idVille)
    {
        $query = "INSERT INTO $tableEtu (nomVille, codePostal) Values ('$ville', $CP)";

        $result = mysqli_query($link, $query);

        $query = "Select idVille From Ville where upper(nomVille) like upper(?)";

        $result = $link->prepare($query);

        $result->bind_param("s", $ville);

        $result->execute();

        $result->bind_result($idVille);

        $result->fetch();
    }
    
    $query = "INSERT INTO Etudiant Values ('$ine', '$prenom', '$nom', $naissance, '$telephone', '$mail', '$MdP', $idVille)";

    $result = mysqli_query($link, $query);
    
    $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    
    foreach ($jourSem as &$jour)
    {
        $trouve = false;
        for ($i = 0; $i < 24; $i++)
        {
            if ($trouve)
            {
                if (!$_POST[$jourSem.$i])
                {
                    $query = "INSERT INTO Creneau (jour, heureDeb, heureFin) Values ('$jourSem', $last, $i)";

                    $result = mysqli_query($link, $query);

                    $trouve = false;
                }
            }
            else
            {
                if ($_POST[$jourSem.$i])
                {
                    $last = $i;
                    $trouve = true;
                }
            }
        }
        if ($trouve)
        {
            $query = "INSERT INTO Creneau (jour, heureDeb, heureFin) Values ('$jourSem', $last, 24)";

            $result = mysqli_query($link, $query);
        }
    }
    */
?>