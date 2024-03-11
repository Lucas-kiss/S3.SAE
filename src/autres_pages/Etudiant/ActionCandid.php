<?php
    session_start();
    require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP


    if (isset($_POST['postuler']))
    {

        $ine = $_SESSION['ine'];

        $dateActuelle = date('Y-m-d');

        $monOffre = intval($_SESSION['monOffre']);

        

        $cvFile = $_FILES["cv"]["tmp_name"];
        $cvPath = '../../ressources/donnees/etudiants/cv/'.basename($_FILES["cv"]["name"]);

        $query = "SELECT * FROM Candidater Where cv = '$cvPath'";
        $result = mysqli_query($link, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $cvPath = substr($cvPath, 0, -4);
            $i=1;
            for (;;)
            {
                $query = "SELECT * FROM Candidater Where cv = '$cvPath$i.pdf'";
                $result = mysqli_query($link, $query);
                if($result && mysqli_num_rows($result) == 0)
                {
                    $cvPath.=$i.'.pdf';
                    break;
                }
                $i++;
            }
        }
        move_uploaded_file($cvFile, $cvPath);


        $lettreMotivFile = $_FILES["lettreMotiv"]["tmp_name"];
        $lettreMotivPath = '../../ressources/donnees/etudiants/lettreMotiv/'.basename($_FILES["lettreMotiv"]["name"]);

        $query = "SELECT * FROM Candidater Where lettreMotiv = '$lettreMotivPath'";
        $result = mysqli_query($link, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $lettreMotivPath = substr($lettreMotivPath, 0, -4);
            $i=1;
            for (;;)
            {
                $query = "SELECT * FROM Candidater Where lettreMotiv = '$lettreMotivPath$i.pdf'";
                $result = mysqli_query($link, $query);
                if($result && mysqli_num_rows($result) == 0)
                {
                    $lettreMotivPath.=$i.'.pdf';
                    break;
                }
                $i++;
            }
        }
        move_uploaded_file($lettreMotivFile, $lettreMotivPath);

        /*var_dump($ine);
        var_dump($monOffre);
        var_dump($cvPath);
        var_dump($lettreMotivPath);
        var_dump($dateActuelle);*/

        $queryInsertEntr = "INSERT INTO Candidater Values ('$ine', $monOffre, '$cvPath', '$lettreMotivPath', 'En attente', '$dateActuelle')";

        $res = mysqli_query($link, $queryInsertEntr);
        /*if ($res) {
            echo 'Insertion fonctionnelle</br>';
        } else {
            echo "Insertion n'a pas fonctionnée</br>";
        }*/
    }

    mysqli_close($link);
    header ('location: ../Internaute/index.php');
?>