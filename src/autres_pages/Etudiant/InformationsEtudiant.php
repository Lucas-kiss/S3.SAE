<?php
require_once("../../ressources/donnees/BDD/bdd.php");
session_start();

if (!isset($_SESSION['ine'])) 
{
    if (!isset($_GET['id']) || !isset($_SESSION['siren']))
    {
        header('location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>1PtitJob - Informations de mon profil</title>
    <link rel="stylesheet" href="../Internaute/style.css">
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

    <body>
        <?php 
            if (isset($_SESSION['ine']))
            {
                $ine = $_SESSION['ine'];
            }
            else
            {
                $ine = $_GET['id'];
            }

            $query_etud = "SELECT * FROM Etudiant JOIN Ville ON Etudiant.idVille = Ville.idVille WHERE ine = '$ine';";
            $result_etud = mysqli_query($link, $query_etud);

            while ($donnees = mysqli_fetch_assoc($result_etud)) {
                $prenom = $donnees["prenom"];
                $nom = $donnees["nom"];
                $dateNaiss = $donnees["dateNaiss"];
                $numTel = $donnees["numTel"];
                $mailEtud = $donnees["mailEtud"];
                $nomVille = $donnees["nomVille"];
                $cp = $donnees["codePostal"];

            }
            ?>

            <div class="fondForm">
                <?php
                if ($_POST && isset($_SESSION['ine']))
                {
                    ?>
                    <H1 class="titres">Modifier mes informations</H1>
                    <div class="separation"><hr><br></div>
                    <form action="ModifInformationsEtudiant.php" method="POST">
                        <div class="infoCompteEt">
                            <table id="tabInfoEntrGauche">
                                <tbody>
                                <tr>
                                    <th><label for="prenom">Prénom :</label></th>
                                    <td><input type="text" class="boiteTexte" id="prenom" name="prenom" pattern="[a-zA-ZÀ-ÿ]+"
                                        maxlength="50" title="Lettres uniquements" placeholder="Xavier" value=<?php echo $prenom ?> /> </td>
                                </tr>
                                <tr>
                                    <th><label for="nom">Nom :</label></th>
                                    <td><input type="text" class="boiteTexte" id="nom" name="nom" pattern="[a-zA-ZÀ-ÿ]+"
                                        maxlength="50" title="Lettres uniquements" placeholder="Dupont" value=<?php echo $nom ?> /></td>
                                </tr>
                                <tr>
                                    <th><label for="naissance">Date de naissance :</label></th>
                                    <td><input type="date" id="naissance" name="naissance" class="boiteTexte" required title="Vous devez avoir 16ans"
                                            max="<?php echo (new DateTime())->sub(new DateInterval('P16Y'))->format('Y-m-d'); ?>"
                                            value=<?php echo $dateNaiss ?> />
                                        </td>
                                </tr>
                                </tbody>
                            </table>
                            <table id="tabInfoEntrDroite">
                                <tr>
                                    <th><label for="ville">Ville :</label></th>
                                    <td><input type="text" id="ville" name="ville" pattern="[^0-9]+" class="boiteTexte"
                                        maxlength="50" title="Lettres uniquements (espace et - autorisé)" placeholder="Anglet" value=<?php echo $nomVille ?> />
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="CP">Code postal :</label></th>
                                    <td><input type="text" id="CP" name="CP" pattern="[0-9]{5}" title="Série de 5 Chiffre" class="boiteTexte"
                                            placeholder="64600" value=<?php echo $cp ?> /></td>
                                </tr>
                                <tr>
                                    <th><label for="telephone">Téléphone :</label></th>
                                    <td><input type="tel" class="boiteTexte" id="telephone" name="telephone"
                                            pattern="[0]{1}[0-9]{9}" title="Numéro à 10 Chiffres qui commance par 0"
                                            placeholder="0612345789" value=<?php echo $numTel ?> /> </td>
                                </tr>
                            </table>
                            <?php
                            $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
                            echo "  <table class='blackBorder tabInfoHoraireEt'><tr>
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
                                    $query = "SELECT * FROM Creneau cr join Posseder p on p.idCreneau=cr.IdCreneau WHERE cr.jour = '$jour' AND p.ine = '$ine' AND cr.heureDeb <= $i AND cr.heureFin > $i";
                                    $result = mysqli_query($link, $query);
                                    echo "<td class='blackBorder noPadding'>";
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        //echo $result[$j]['heureDeb'];
                                        //echo $i.$j.$jour; 
                                        echo "<input class='checkHoraire' type='checkbox' name='$jour$i' id='$jour$i' checked>";
                                        // echo "<td class='blackBorder noPadding caseverte'>";
                                    } else {
                                        echo "<input class='checkHoraire' type='checkbox' name='$jour$i' id='$jour$i'>";
                                        // echo "<td class='blackBorder noPadding caserouge'>";
                                    }
                                    echo "</td>";
                                }
                
                                echo "</tr>";
                            }
                            echo "</table>";
                            mysqli_close($link);
                            ?>
                            <div class="btnModifInfosEntr">
                                <input type="button" class="connexion" name="annuler" value="Retour" id="btnRetourModif" onclick="history.back()">
                                <input type="reset" class="connexion" value="Réinitialiser" id="btnReset"/>
                                <input type="submit" class="connexion" value="Valider" id="btnVal">
                            </div>
                        </div>
                    </form>
                    <?php
                }
                else
                {
                        if(!isset($_SESSION['siren']))
                        {
                    ?>
                    <H1 class="titres">Mes informations</H1>
                    <div class="separation"><hr><br></div>
                    <form action="InformationsEtudiant.php" method="POST">
                    <?php
                        }
                        else
                        {
                    ?>
                    <H1 class="titres">Informations de <?php echo "$nom $prenom";?></H1>
                    <div class="separation"><hr><br></div>
                    <?php
                        }
                    ?>
                            <div class="infoCompteEt">
                                <table id="tabInfoEntrGauche">
                                    <tr>
                                        <th><label for="ine">INE :</label></th>
                                        <td>
                                            <input readonly class="champsRecap" type="text" name="ine" value=<?php echo $ine ?> /></td>
                                        </tr>
                                    <tr>
                                        <th><label for="nom">Nom :</label></th>
                                        <td>
                                            <input readonly class="champsRecap" type="text" name="nom" value=<?php echo $nom ?> />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="prenom">Prénom :</label></th>
                                        <td>
                                            <input readonly class="champsRecap" type="text" name="prenom" value=<?php echo $prenom ?> /></td>
                                    </tr>
                                    <tr>
                                        <th><label for="dateNaiss">Date de naissance :</label></th>
                                        <td>
                                            <input readonly class="champsRecap" type="text" name="dateNaiss" value=<?php echo $dateNaiss ?> />
                                        </td>
                                    </tr>
                                </table>
                                <table id="tabInfoEntrDroite">
                                    <tr>
                                        <th><label for="ville">Ville :</label></th>
                                        <td>
                                            <input readonly class="champsRecap" type="text" name="ville" value=<?php echo $nomVille ?> />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="cp">Code postal :</label></th>
                                        <td>
                                            <input readonly class="champsRecap" type="text" name="cp" value=<?php echo $cp ?> />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="mail">Adresse e-mail :</label></th>
                                        <td>
                                            <input readonly class="champsRecap" type="text" name="mail" value=<?php echo $mailEtud ?> />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="tel">Numéro de téléphone :</label></th>
                                        <td>
                                            <input readonly class="champsRecap" type="text" name="tel" value=<?php echo $numTel ?> />
                                        </td>
                                    </tr>
                                </table>
                                <!-- horaire -->
                                
                                <?php
                                $jourSem = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
                                echo "  <table class='blackBorder tabInfoHoraireEt'><tr>
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
                                        $query = "SELECT * FROM Creneau cr join Posseder p on p.idCreneau=cr.IdCreneau WHERE cr.jour = '$jour' AND p.ine = '$ine' AND cr.heureDeb <= $i AND cr.heureFin > $i";
                                        $result = mysqli_query($link, $query);
                    
                                        if ($result && mysqli_num_rows($result) > 0) {
                                            echo "<td class='blackBorder noPadding caseverte'>";
                                        } else {
                                            echo "<td class='blackBorder noPadding caserouge'>";
                                        }
                                        echo "</td>";
                                    }
                    
                                    echo "</tr>";
                                }
                                echo "</table>";
                                mysqli_close($link);
                                ?>
                                <!-- bouton -->
                                <div class="btnInfosEt">
                                <br>
                                <?php
                                    if(isset($_SESSION['siren']))
                                    {
                                ?>
                                        <td>
                                            <button onclick="update('<?php echo $ine; ?>', 'Refusé')" class="connexion" id="btnRefCand">Refuser</button>
                                        </td>
                                        <td> 
                                            <button onclick="update('<?php echo $ine; ?>', 'Accepté')" class="connexion" id="btnAccCand">Accepter</button>
                                        </td>
                                        <script>
                                            function update(id, etat)
                                            {
                                                console.log(id, etat);
                                                window.location.href = 'changeStatus.php?id=' + encodeURIComponent(id) + '&etat=' + encodeURIComponent(etat);
                                            }
                                        </script>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <input type="button" class="connexion" name="annuler" value="Retour" id="btnRetour" onclick="history.back()">
                                        <input type="submit" class="connexion" name="ModifInfosEtu" id="btnModif" value="Modifier les informations"> 
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        if(!isset($_SESSION['siren']))
                        {
                    ?>
                    </form>
                    <?php
                    }?>
                <?php
                }
                ?>
                <br>
      <hr><br>
      <?php
      if(!isset($_SESSION['siren']))
      {
        ?>
      
      <div id="divBtnConnexion"><a href=../logout.php class="connexion">Se déconnecter</a></div>
            </div>
            <?php
      }
        ?>


</body>

</html>