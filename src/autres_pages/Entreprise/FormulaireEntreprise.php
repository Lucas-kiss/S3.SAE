<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>1PtitJob - Inscription Entreprise</title>
        <link rel="stylesheet" href="../Internaute/style.css">
    </head>
    <body>
        <nav>
            <div class=wrapper>
                <img class="logo" src="../../ressources/img/1ptitjob_logo.PNG" width="60" height="60" alt="Logo 1P'titJob"/>
                <h1 class="titre">1P'titJob</h1>
                <a href="Connexion.php" class="connexion">Connexion</a>
            </div>
        </nav>

        
        <form action="Inscription.php" method="POST">
            <div class="fondForm">
            <H1 class="titreDepot">Inscription</H1>
                <table>
                    <tbody>
                        <tr>
                            <th><label for="siren">Numéro SIREN :</label></th>
                            <td><input type="text" id="siren" name="siren" pattern="[12]{1}[0-9]{8}" title="9 Chiffres qui commence par 1 ou 2" placeholder="123456789" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="nom">Nom de l'entreprise :</label></th>
                            <td><input type="text" id="nom" name="nom" placeholder="E.Leclerc" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="domaine">Domaine d'activité :</label></th>
                            <td><input type="text" id="domaine" name="domaine" placeholder="Grande distribution" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="adresse">Adresse postale :</label></th>
                            <td><input type="text" id="adresse" name="adresse" placeholder="123, Rue des chênes" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="ville">Ville :</label></th>
                            <td><input type="text" id="ville" name="ville" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="Anglet" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="pays">Pays :</label></th>
                            <td><input type="text" id="pays" name="pays" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="France" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="telephone">Téléphone :</label></th>
                            <td><input type="tel" id="telephone" name="telephone" pattern="[0]{1}[0-9]{9}" title="Numéro à 10 Chiffres qui commance par 0" placeholder="0612345789" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="nomResp">Nom du responsable :</label></th>
                            <td><input type="text" id="nomResp" name="nomResp" pattern="[a-zA-ZÀ-ÿ]+" title="Lettres uniquements" placeholder="Xavier" required/> *</td>
                        </tr>
                        <tr>
                            <th><label for="telResp">Téléphone du responsable :</label></th>
                            <td><input type="tel" id="telResp" name="telResp" pattern="[0]{1}[0-9]{9}" title="Numéro à 10 Chiffres qui commance par 0" placeholder="0612345789" required/> *</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" id="notrobot" required/>
                                <label for="notrobot">Je ne suis pas un robot *</label>
                            </td>
                            <td>
                                <input type="reset" value="Réinitialiser" />
                                <input type="submit" value="S'inscrire">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h6>* Champs obligatoires</h6>
            </div>
        </form>
    </body>
</html>