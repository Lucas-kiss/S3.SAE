alerte_dates = () => {
    if (document.getElementById("idDeb").value > document.getElementById("idFin").value) {
        alert("Erreur : veuillez saisir une date de fin d'offre supérieure à la date de début d'offre.");
    }
}

alerte_depotOk = () => {
    alert("L'offre d'emploi a bien été publiée.")
}

alerte_depotMauvais = () => {
    alert("Erreur : l'offre d'emploi n'a pas pu être publiée.")
}