<?php
    session_start();
    require_once("../../ressources/donnees/BDD/bdd.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>1P'titJob</title>
        <link href="../Internaute/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <nav>
            <div class=wrapper>
            <?php
                if (isset($_SESSION['siren']))
                {
                    echo "<a href='../Entreprise/AccueilEntreprise.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
                    echo "<h1 class='titre'><a href='../Entreprise/AccueilEntreprise.php'>1P'titJob</a></h1>";
                }
                else
                {
                    echo "<a href='./index.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
                    echo "<h1 class='titre'><a href='../Internaute/index.php'>1P'titJob</a></h1>";
                }

                if (isset($_SESSION['ine']) && !isset($_SESSION['siren']))
                {
                    echo "<a href='../Etudiant/InformationsEtudiant.php' class='connexion'>Mon compte</a>";
                }
                elseif (!isset($_SESSION['ine']) && !isset($_SESSION['siren']))
                {
                    echo "<a href='Connexion.html' class='connexion'>Connexion</a>";
                }
                elseif (!isset($_SESSION['ine']) && isset($_SESSION['siren']))
                {
                    echo "<a href='../Entreprise/InformationsEntreprise.php' class='connexion'>Mon compte</a>";
                }
            ?>
            </div>
        </nav>
            <?php
                $monOffre = $_SESSION['monOffre'];
                $query = "SELECT * FROM Offre Where idOffre = $monOffre";
                $result = mysqli_query($link, $query);

                while ($donnees = mysqli_fetch_assoc($result))
                {
                    $nom = $donnees['nomOffre'];
                    echo "<h1 class='titre'>".$nom."</h1>";
                }
            ?>
        <div class="annonces">
            <h2>Liste des Candidats :</h2>
            <div class="grilleAnnonces">
                
                <?php
                    $query = "SELECT e.* from Etudiant e join Candidater c on c.ine = e.ine where c.idOffre = $monOffre";
                    $res = mysqli_query($link, $query);
                    
                    if ($link) {
                        while ($donnees = mysqli_fetch_assoc($res)) {
                            $nom = $donnees['nom'];
                            $prenom = $donnees['prenom'];
                            //var_dump($donnees['dateNaiss']);
                            $date_naissance = $donnees['dateNaiss'];
                            $date_actuelle = date('Y-m-d');
                            $age = date_diff(date_create($date_naissance), date_create($date_actuelle));
                            $age = $age->format('%y');
                            $ine = $donnees['ine'];
                            
                            echo"<div class='recapOffre' id='offre$monOffre'>
                
                                <h3>$nom $prenom</h3>
                                <p>$age ans $ine</p>
                                
                                <button onclick='passId($ine)'>Profil</button>
                                </div>";
                        }
                    }
                    mysqli_close($link);
                ?>
                <script>
                    function passId(id)
                    {
                        console.log(id);
                        window.location.href = '../Etudiant/InformationsEtudiant.php?id=' + encodeURIComponent(id);
                    }
                </script>
            </div>
        </div>
    <body>
</Html>