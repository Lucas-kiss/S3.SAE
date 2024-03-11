<?php
require_once("../../ressources/donnees/BDD/bdd_MAMP.php");
session_start();

if (!isset($_SESSION['siren'])) {
  header('location: ../Internaute/index.php');
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
    $siren = intval($_SESSION['siren']);

    $query_entr = "SELECT * FROM Entreprise JOIN Ville ON Entreprise.idVille = Ville.idVille WHERE siren = '$siren';";
    $result_entr = mysqli_query($link, $query_entr);

    while ($donnees = mysqli_fetch_assoc($result_entr)) {
      $nomEntr = $donnees["nomEntreprise"];
      $domAct = $donnees["domaineActivite"];
      $telEntr = $donnees["telephoneEntreprise"];
      $nomResp = $donnees["nomResponsable"];
      $telResp = $donnees["telephoneResponsable"];
      $mailResp = $donnees["mailResponsable"];
      $nomVille = $donnees["nomVille"];
      $cp = $donnees["codePostal"];

    }

    ?>
    <div class="fondForm">
      <?php
      if ($_POST) {
        ?>
        <H1 class="titres">Modifier mes informations</H1>
        <div class="separation"></div>
        <div class="infoCompteEntr">
          <form action="modifInfosEntr.php" method="POST">
            <table>
              <tbody>
                <tr>
                  <th><label for="nom">Nom de l'entreprise :</label></th>
                  <td><textarea class="boiteTexte" name="nomEntr" cols="10" rows="1" placeholder="E.Leclerc"
                      required><?php echo $nomEntr ?></textarea></td>

                </tr>
                <tr>
                  <th><label for="domaine">Domaine d'activité :</label></th>
                  <td><textarea class="boiteTexte" name="domAct" cols="10" rows="1" placeholder="Grande distribution"
                      required><?php echo $domAct ?></textarea></td>
                </tr>
                <tr>
                  <th><label for="ville">Ville :</label></th>
                  <td><textarea class="boiteTexte" name="ville" cols="10" rows="1" pattern="[a-zA-ZÀ-ÿ]+"
                      title="Lettres uniquements" placeholder="Anglet" required><?php echo $nomVille ?></textarea></td>
                </tr>
                <tr>
                  <th><label for="CP">Code postal :</label></th>
                  <td><textarea class="boiteTexte" name="CP" cols="10" rows="1" pattern="[0-9]{5}"
                      title="Série de 5 Chiffre" placeholder="64600" required><?php echo $cp ?></textarea></td>
                </tr>
                <tr>
                  <th><label for="telephone">Téléphone de l'entreprise :</label></th>
                  <td><textarea class="boiteTexte" name="telEntr" cols="10" rows="1" pattern="[0]{1}[0-9]{9}"
                      title="Numéro à 10 Chiffres qui commance par 0" placeholder="0612345789"
                      required><?php echo $telEntr ?></textarea></td>
                </tr>
                <tr>
                  <th><label for="nomResp">Nom du responsable :</label></th>
                  <td><textarea class="boiteTexte" name="nomResp" cols="10" rows="1" pattern="[a-zA-ZÀ-ÿ]+"
                      title="Lettres uniquements" placeholder="Xavier" required><?php echo $nomResp ?></textarea></td>
                </tr>
                <tr>
                  <th><label for="telResp">Téléphone du responsable :</label></th>
                  <td><textarea class="boiteTexte" name="telResp" cols="10" rows="1" pattern="[0]{1}[0-9]{9}"
                      title="Numéro à 10 Chiffres qui commance par 0" placeholder="0612345789"
                      required><?php echo $telResp ?></textarea></td>
                </tr>
                <tr>
                  <td>
                    <input type="button" class="connexion" name="annuler" value="Annuler" onclick="history.back()">
                  </td>
                  <td>
                    <input type="reset" class="connexion" value="Réinitialiser" />
                  </td>
                  <td> <input type="submit" class="connexion" value="Valider">
                  </td>
                </tr>
              </tbody>
            </table>
          </form>

          <?php

      } else {
        ?>
          <H1 class="titres">Mes informations</H1>
          <div class="separation"></div>
          <div class="infoCompteEntr">
            <form action="InformationsEntreprise.php" method="POST">
              <table>
                <tbody>
                  <tr>
                    <th><label for="siren">Numéro SIREN :</label></th>
                    <td><input readonly type="text" class="champsRecap" id="siren" name="siren" value=<?php echo $siren ?> /> </td>
                  </tr>
                  <tr>
                    <th><label for="nom">Nom de l'entreprise :</label></th>
                    <td><input readonly type="text" class="champsRecap" id="nom" name="nom" value=<?php echo "$nomEntr" ?> /> </td>
                  </tr>
                  <tr>
                    <th><label for="domaine">Domaine d'activité :</label></th>
                    <td><textarea readonly class="champsRecap" name="domaine" cols="20"
                        rows="1"><?php echo $domAct ?></textarea></td>
                  </tr>
                  <tr>
                    <th><label for="ville">Ville :</label></th>
                    <td><input readonly type="text" class="champsRecap" id="ville" name="ville" value=<?php echo $nomVille ?> /> </td>
                  </tr>
                  <tr>
                    <th><label for="CP">Code postal :</label></th>
                    <td><input readonly type="text" class="champsRecap" id="CP" name="CP" value=<?php echo $cp ?> />
                    </td>
                  </tr>
                  <tr>
                    <th><label for="telephone">Téléphone de l'entreprise :</label></th>
                    <td><input readonly type="tel" class="champsRecap" id="telephone" name="telephone" value=<?php echo $telEntr ?> /> </td>
                  </tr>
                  <tr>
                    <th><label for="nomResp">Nom du responsable :</label></th>
                    <td><input readonly type="text" class="champsRecap" id="nomResp" name="nomResp" value=<?php echo $nomResp ?> /> </td>
                  </tr>
                  <tr>
                    <th><label for="telResp">Téléphone du responsable :</label></th>
                    <td><input readonly type="tel" class="champsRecap" id="telResp" name="telResp" value=<?php echo $telResp ?> /> </td>
                  </tr>
                  <tr>
                    <th><label for="mailResp">Mail du responsable :</label></th>
                    <td><input readonly type="text" class="champsRecap" id="mailResp" name="mailResp" value=<?php echo $mailResp ?> /> </td>
                  </tr>
                  <tr>
                    <td>
                      <input type="button" class="connexion" name="annuler" value="Annuler" onclick="history.back()">
                    </td>
                    <td>
                      <input type="submit" class="connexion" value="Modifier les informations">
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
          <?php
      }
      ?>
        <a href=../logout.php>Se déconnecter</a>
      </div>



  </body>

</html>