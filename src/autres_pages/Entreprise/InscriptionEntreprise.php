<?php
    session_start();
    require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP

    $siren = intval($_POST['siren']);
    $nom = $_POST['nom'];
    $domaine = $_POST['domaine'];
    $ville = $_POST['ville'];
    $CP = $_POST['CP'];
    $pays = $_POST['pays'];
    $telephone = $_POST['telephone'];
    $nomResp = $_POST['nomResp'];
    $telResp = $_POST['telResp'];
    $mail = $_SESSION['mail'];
    $MdP = hash('sha1', $_SESSION['MdP']);

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

    $link=mysqli_connect($host, $user, $pass, $bdd) or die( "Impossible de se connecter à la base de données");
    mysqli_set_charset($link, 'utf8');

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    if ($link) {
        // $queryInsertEntr = "INSERT INTO Entreprise (siren, nomEntreprise, domaineActivite, telephoneEntreprise, nomResponsable, telephoneResponsable, mailResponsable, mdpResponsable, idVille)
        // Values ($siren, '$nom', '$domaine', '$telephone', '$nomResp', '$telResp', '$mail', '$MdP', $idVille)";

        $queryInsertEntr = "INSERT INTO Entreprise
        Values ($siren, '$nom', '$domaine', '$telephone', '$nomResp', '$telResp', '$mail', '$MdP', $idVille)";

        $res = mysqli_query($link, $queryInsertEntr);
        if ($res) {
            echo 'Insertion fonctionnelle</br>';
        } else {
            echo "Insertion n'a pas fonctionnée</br>";
        }
    }
    mysqli_close($link);
?>