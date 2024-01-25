<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>1PtitJob - Dépôt d'offre</title>
    <link rel="stylesheet" href="../../HTML_CSS/style.css">
</head>

<body>

    <form action="Inscription.php" method="POST">

        <div class="fondForm">
            <H1 class="titreDepot">Dépôt d'offre</H1>
            <div class="separation"></div>
            <table class="tabOffre">
                <tr>
                    <td><label for="intitOffre">Intitulé de l'offre</label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><input class="champs" type="text" id="intitOffre" placeholder="Ex : Serveur dans un restaurant"
                            required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="villeOffre">Ville</label><label class="etoile"> *</label>
                    </td>
                </tr>
                <tr>
                    <td><input class="champs" type="text" id="villeOffre" pattern="[a-zA-ZÀ-ÿ]+"
                            title="Lettres uniquements" placeholder="Ex : Anglet" required /></td>
                </tr>
                <tr>
                    <td>
                        <label for="dateDeb">Date de début</label><label class="etoile"> *</label>
                    </td>
                </tr>
                <tr>
                    <td><input class="date" type="date" id="dateDeb" min=<?php echo date("Y-m-d") ?> required /></td>
                </tr>
                <tr>
                    <td><label for="dateFin">Date de fin </label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><input class="date" type="date" id="dateFin" min=<?php echo date("Y-m-d") ?> required /></td>
                </tr>
                <tr>
                    <td><label for="nbEmployes">Nombre d'employés recherché</label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><input class="champs" type="number" id="nbEmployes" min="1" max="10" title=""
                            placeholder="Ex : 2" required />
                    </td>
                </tr>
                <tr>
                    <td><label for="tauxHoraire">Taux horaire (valeur nette en €)</label><label class="etoile">
                            *</label></td>
                </tr>
                <tr>
                    <td><input class="champs" type="text" id="tauxHoraire" pattern="[0-9]{2},[0-9]{2}"
                            placeholder="Ex : 11,50" title="Format monétaire (00,00)" required />
                    </td>
                </tr>
                <tr>
                    <td><label for="descrOffre">Description de l'offre</label><label class="etoile"> *</label></td>
                </tr>
                <tr>
                    <td><textarea id="descrOffre" required cols="20" rows="12"
                            placeholder="Ex : Nous recherchons un serveur les soirs de semaine..."></textarea></td>
                </tr>
                <td>
                    <label class="etoile">* </label><label class="champsObl">Champs obligatoires<label>
                </td>
                <tr>
                    <td>
                        <input type="submit" class="btnDepot" value="Déposer">
                    </td>
                </tr>
            </table>
    </form>
    </div>

</body>

</html>