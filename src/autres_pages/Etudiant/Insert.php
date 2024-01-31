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


    $query = "SELECT idVille From Ville where upper(nomVille) like upper(?) and upper(codePostal) like upper(?)";

    $result = $link->prepare($query);

    $result->bind_param("ss", $ville, $CP);

    $result->execute();

    $result->bind_result($idVille);

    $result->fetch();
    echo "$idVille";

    if (!$idVille)
    {
        $query_id = "SELECT MAX(idVille) FROM Ville";
        $result_id = mysqli_query($link, $query_id);
    
        $idVille = 1;

        while ($donnees=mysqli_fetch_assoc($result_id))
        {
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

    var_dump($naissance);
    
    $query = "INSERT INTO Etudiant (ine, prenom, nom, dateNaiss, numTel, mailEtud, mdpEtud, idVille) Values ('$ine', '$prenom', '$nom', '$naissance', '$telephone', '$mail', '$MdP', $idVille)";

    $result = mysqli_query($link, $query);
    
    $query_id = "SELECT MAX(IdCreneau) FROM Creneau";
    $result_id = mysqli_query($link, $query_id);
 
    $IdCreneau = 1;

    while ($donnees=mysqli_fetch_assoc($result_id))
    {
        $IdCreneau = $donnees["MAX(IdCreneau)"] + 1;
    }
    
    $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');

    $query2 = "INSERT INTO Posseder (ine, idCreneau) Values ($ine, $IdCreneau)";

    $i = 0;

    $last = 0;
    
    foreach ($jourSem as &$jour)
    {
        $query1 = "INSERT INTO Creneau (IdCreneau, jour, heureDeb, heureFin) Values ($IdCreneau, '$jour', $last, $i)";

        $trouve = false;
        for ($i = 0; $i < 24; $i++)
        {
            $cle = $jour.$i;

            

            if ($trouve)
            {
                if (!isset($_POST[$cle]) || !$_POST[$cle] == 'on')
                {
                    echo 'fin '.$cle.'</br>';

                    $result = mysqli_query($link, $query1);

                    $result = mysqli_query($link, $query2);

                    $IdCreneau++;

                    $trouve = false;
                }
            }
            else
            {
                if (isset($_POST[$cle]) && $_POST[$cle] == 'on')
                {
                    echo 'deb '.$cle.'</br>';
                    $last = $i;
                    $trouve = true;
                }
            }
        }

        if ($trouve)
        {           
            $query1 = "INSERT INTO Creneau (IdCreneau, jour, heureDeb, heureFin) Values ($IdCreneau, '$jour', $last, 24)";

            echo 'fin '.$jour.'24</br>';

            $result = mysqli_query($link, $query1);

            $result = mysqli_query($link, $query2);

            $IdCreneau++;
        }
    }
?>