<?php
session_start();

require_once("../../ressources/donnees/BDD/bdd.php"); // connexion à la base de données, bdd.php pour lakartxela, bdd_MAMP.php pour MAMP

if (isset($_GET['value'])) {
    $monOffre = $_GET['value'];
    $_SESSION['monOffre'] = $monOffre;

    $query_offre = "SELECT * FROM Offre JOIN Entreprise ON Offre.siren = Entreprise.siren JOIN Ville ON Entreprise.idVille = Ville.idVille WHERE idOffre = $monOffre;";
    $result_offre = mysqli_query($link, $query_offre);

    while ($donnees = mysqli_fetch_assoc($result_offre)) {
        $nomOffre = $donnees["nomOffre"];
        $dateDepot = $donnees["dateDepot"];
        $dateDeb = $donnees["dateDeb"];
        $dateFin = $donnees["dateFin"];
        $tauxHoraire = $donnees["tauxHoraire"];
        $description = str_replace("\n", "<br/>", $donnees["description"]);
        $nomEntr = $donnees["nomEntreprise"];
        $ville = $donnees["nomVille"];
        $resCPOFfre = $donnees['codePostal'];
    }
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>1P'titJob</title>
        <link href="style.css" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <nav>
            <div class=wrapper>
                <?php
                if (isset($_SESSION['siren'])) {
                    echo "<a href='../Entreprise/AccueilEntreprise.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
                    echo "<h1 class='titre'><a href='../Entreprise/AccueilEntreprise.php'>1P'titJob</a></h1>";
                } else {
                    echo "<a href='../Internaute/index.php'><img class='logo' src='../../ressources/img/1ptitjob_logo.PNG' width='60' height='60' /></a>";
                    echo "<h1 class='titre'><a href='../Internaute/index.php'>1P'titJob</a></h1>";
                }

                if (isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
                    $ine = $_SESSION['ine'];
                    $queryNomCompte = "SELECT prenom, nom FROM Etudiant WHERE ine LIKE '$ine'";
                    $resultNom = mysqli_query($link, $queryNomCompte);
                    while ($donnees = mysqli_fetch_assoc($resultNom)) {
                        $prenom = $donnees["prenom"];
                        $nom = $donnees["nom"];
                    }
                    echo "<a href='../Etudiant/InformationsEtudiant.php' class='connexion'>$prenom $nom</a>";
                } elseif (!isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
                    echo "<a href='../Internaute/Connexion.html' class='connexion'>Connexion</a>";
                } elseif (!isset($_SESSION['ine']) && isset($_SESSION['siren'])) {
                    $siren = $_SESSION['siren'];
                    $queryNomCompte = "SELECT nomEntreprise FROM Entreprise WHERE siren LIKE '$siren'";
                    $resultNom = mysqli_query($link, $queryNomCompte);
                    while ($donnees = mysqli_fetch_assoc($resultNom)) {
                        $nomEntr = $donnees["nomEntreprise"];
                    }
                    echo "<a href='../Entreprise/InformationsEntreprise.php' class='connexion'>$nomEntr</a>";
                }
                ?>
            </div>
        </nav>

        <div class="fondForm">
            <H1 class="titres">
                <?php echo "Intitulé de l'offre : $nomOffre" ?>
            </H1>
            <hr><br>

            <div class="InfosOffre">
                <?php
                echo "<p class='uneInfoOffre'><b>Nom de l'entreprise :</b> $nomEntr</p>";
                echo "<p class='uneInfoOffre'><b>Localisation de l'offre : </b> $ville $resCPOFfre</p>";
                echo "<p class='uneInfoOffre'><b>Date de l'offre :</b> du $dateDeb au $dateFin</p>";
                echo "<p class='uneInfoOffre'><b>Rémunération :</b> $tauxHoraire euros net par heure</p>";
                ?>
                <div class="descriptionOffre">
                    <?php
                    echo "<p class='uneInfoOffre'><b>Description de l'offre :</b></p>";
                    echo "<p class='uneInfoOffre'> $description</p>";
                    ?>

                </div>
                <div>
                    <?php
                        if (isset($_SESSION['ine']))
                        {
                            $ine = $_SESSION['ine'];
                            $monOffre = intval($monOffre);
                            $query = "SELECT * from Candidater where ine = '$ine' AND idOffre = $monOffre";
                            $result = mysqli_query($link, $query);
                            if ($result && mysqli_num_rows($result) > 0) 
                            {
                                while ($donnees = mysqli_fetch_assoc($result))
                                {
                                    $statut = $donnees['statut'];
                                }
                                echo "<p class='uneInfoOffre'><b>Statut de votre candidature : </b>$statut</p>";
                            }
                        }
                    ?>
                </div>

                <div class="horaireOffre">
                    <p class='uneInfoOffre'><b>Horaires de l'offre :</b></p>
                    <?php
                    $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
                    echo " <table class='blackBorder'>
                    <tr>
                        <th>
                            <label>Jour</label>
                        </th>";

                    for ($i = 0; $i < 24; $i++) {
                        echo "  <th class='blackBorder'>
                                        <label>$i h</label>
                                    </th>";
                    }
                    echo "  </tr>";
                    foreach ($jourSem as &$jour) {
                        echo "<tr class='noPadding'>";
                        echo "<th class='blackBorder noPadding thJour'>";
                        echo "<label>$jour</label>";
                        echo "</th>";
                        $j = 0;
                        for ($i = 0; $i < 24; $i++) {
                            $query = "SELECT * FROM Creneau cr join Concerner co on co.idCreneau=cr.IdCreneau WHERE cr.jour = '$jour' AND co.idOffre = $monOffre AND cr.heureDeb <= $i AND cr.heureFin > $i"
                            ;
                            $result = mysqli_query($link, $query);
                            if ($result && mysqli_num_rows($result) > 0) {
                                //echo $result[$j]['heureDeb'];
                                //echo $i.$j.$jour;
                                echo "<td class='blackBorder noPadding caseverte'>";
                            } else {
                                echo "
                            <td class='blackBorder noPadding caserouge'>";
                            }
                            echo "</td>";
                        }

                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                </div>
                <script>
                    function pageAccueil() {
                        window.location.href = '../Internaute/index.php';
                    }
                    function pageEntreprise() {
                        window.location.href = '../Entreprise/AccueilEntreprise.php';
                    }
                </script>
                <?php

                echo "<div class='btnOffre'>";


                if (isset($_SESSION['ine']) && !isset($_SESSION['siren'])) {
                    echo "<input type='button' class='connexion' name='annuler' value='Retour' id='btnRetour' onclick='history.back()'>";
                    $urlCand = "../Etudiant/candidatureEtudiant.php";
                    $ine = $_SESSION['ine'];
                    $monOffre = intval($monOffre);
                    $query = "SELECT * from Candidater where ine = '$ine' AND idOffre = $monOffre";
                    $result = mysqli_query($link, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        echo "<button onclick='passId($monOffre, `../Etudiant/suppCandidatureEtudiant.php`)' id='btnPostuler' class='connexion'>Supprimer ma candidature</button>";
                    } else {
                        echo "</br><button onclick='passId($monOffre, `../Etudiant/candidatureEtudiant.php`)' id='btnPostuler' class='connexion'>Postuler</button>";
                    }
                } elseif (!isset($_SESSION['ine']) && isset($_SESSION['siren'])) {

                    echo
                        "<script>
                    function choixSuppressionOffre(uneOffre) {
                        if (confirm('Souhaitez-vous vraiment supprimer cette offre ? Les candidatures formulées sur l'offre seront également supprimées. Votre action ne pourra pas être annulée.')) {
                            passId(uneOffre, `../Entreprise/SupprimerOffre.php`);
                        }
                    }
                </script>
                <input type='button' class='connexion' name='annuler' value='Retour' id='btnRetour' onclick='pageEntreprise()'>
                </br><button onclick='passId($monOffre, `../Entreprise/candidatureOffre.php`)' id='btnCandidater'
                    class='connexion'>Voir les candidatures</button>
                <button onclick='passId($monOffre, `../Entreprise/modifierOffre.php`)' id='btnModifier'
                    class='connexion'>Modifier l'offre</button>
                <button onclick='choixSuppressionOffre($monOffre)' id='btnSupprimer' class='connexion'>Supprimer
                    l'offre</button>";
                } else {
                    echo "<input type='button' class='connexion' name='annuler' value='Retour' id='btnRetour' onclick='pageAccueil()'>";
                }

                echo "</div>
        <p class='sous-titre'>Offre déposée le $dateDepot</p>";
                ?>
            </div>
            <script>
                function passId(id, urlPage) {
                    window.location.href = urlPage + '?value=' + encodeURIComponent(id);
                }
            </script>

    </body>

    </html>
    <?php

}
mysqli_close($link);
?>