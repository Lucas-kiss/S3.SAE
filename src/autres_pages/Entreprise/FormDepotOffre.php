<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>1PtitJob - Dépôt d'offre</title>
    <link rel="stylesheet" href="../Internaute/style.css">
</head>

  <nav>
    <div class=wrapper>
        <img class="logo" src="../../ressources/img/1ptitjob_logo.PNG" width="60" height="60"/>
        <h1 class="titre">1P'titJob</h1>
        <a href="monCompteEntreprise.php" class="connexion">Mon Compte</a>
      </div>
  </nav>

<body>

    <form action="depotOffre.php" method="POST">

        <div class="fondForm">
            <H1 class="titreDepot">Dépôt d'offre</H1>
            <div class="separation"></div>
            <table class="tabOffre">
                <tr>
                    <td><label for="intitOffre">Intitulé de l'offre</label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><input class="champs" type="text" name="intitOffre" placeholder="Ex : Serveur dans un restaurant"
                            required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="villeOffre">Ville</label><label class="etoile"> *</label>
                    </td>
                </tr>
                <tr>
                    <td><input class="champs" type="text" name="villeOffre" pattern="[a-zA-ZÀ-ÿ]+"
                            title="Lettres uniquements" placeholder="Ex : Anglet" required /></td>
                </tr>
                <tr>
                    <td>
                        <label for="dateDeb">Date de début</label><label class="etoile"> *</label>
                    </td>
                </tr>
                <tr>
                    <td><input class="boiteTexte" type="date" name="dateDeb" min=<?php echo date("Y-m-d") ?> required /></td>
                </tr>
                <tr>
                    <td><label for="dateFin">Date de fin </label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><input class="date" type="date" name="dateFin" min=<?php echo date("Y-m-d") ?> required /></td>
                </tr>
                <tr>
                    <td><label for="tauxHoraire">Taux horaire (valeur nette en €)</label><label class="etoile">
                            *</label></td>
                </tr>
                <tr>
                    <td><input class="champs" type="text" name="tauxHoraire" pattern="[0-9]{2},[0-9]{2}"
                            placeholder="Ex : 11,50" title="Format monétaire (00,00)" required />
                    </td>
                </tr>
                <tr>
                    <td><label for="descrOffre">Description de l'offre</label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><textarea name="descrOffre" required cols="20" rows="12"
                            placeholder="Ex : Nous recherchons un serveur les soirs de semaine..."></textarea></td>
                </tr>
                <td>
                    <label class="etoile">* </label><label class="champsObl">Champs obligatoires<label>
                </td>
                <tr>
                    <td>
                        <input type="submit" class="btnSuivant" name="suivant" value="Suivant">
                    </td>
                </tr>
            </table>
    </form>
    </div>

</body>

</html>