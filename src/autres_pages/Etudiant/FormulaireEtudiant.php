<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob - Inscription Etudiant</title>
        <link rel="stylesheet" href="../Internaute/style.css">
    </head>
    <body>
        <nav>
            <div class=wrapper>
                <a href="./AccueilEtudiant.php"><img class="logo" src="../../ressources/img/1ptitjob_logo.PNG" width="60" height="60" /></a>
                <h1 class="titre">1P'titJob</h1>
                <a href="Connexion.php" class="connexion">Connexion</a>
            </div>
        </nav>

        
        <form action="HoraireEtudiant.php" method="POST">
            <div class="fondForm">
            <H1 class="titreDepot">Mes Inscriptions</H1>
                <table class="tabOffre">
                    <tbody>
                        <tr>
                            <th><label for="ine">Numéro INE :</label></th>
                            <td><input type="text" class="boiteTexte" id="ine" name="ine" pattern="[0-9]{9}[0-9A-Z]{1}[A-Z]{1}" title="9 Chiffres + 2 Lettres ou 10 Chiffres + 1 Lettre" placeholder="123456789AB" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="prenom">Prénom :</label></th>
                            <td><input type="text" class="boiteTexte" id="prenom" name="prenom" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="Xavier" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="nom">Nom :</label></th>
                            <td><input type="text" class="boiteTexte" id="nom" name="nom" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="Dupont" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="naissance">Date de naissance :</label></th>
                            <td><input type="date" class="boiteTexte" id="naissance" name="naissance" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="adresse">Adresse postale :</label></th>
                            <td><input type="text" class="boiteTexte" id="adresse" name="adresse" placeholder="123, Rue des chênes" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="ville">Ville :</label></th>
                            <td><input type="text" class="boiteTexte" id="ville" name="ville" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="Anglet" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="pays">Pays :</label></th>
                            <td><input type="text" class="boiteTexte" id="pays" name="pays" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="France" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="telephone">Téléphone :</label></th>
                            <td><input type="tel" class="boiteTexte" id="telephone" name="telephone" pattern="[0]{1}[0-9]{9}" title="Numéro à 10 Chiffres qui commance par 0" placeholder="0612345789" required/> *</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" id="notrobot" required/>
                                <label for="notrobot">Je ne suis pas un robot *</label>
                            </td>
                            <td>
                                <input type="reset" value="Réinitialiser" />
                                <input type="submit" value="Suivant">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h6>* Champs obligatoires</h6>
            </div>
        </form>
    </body>
</html>