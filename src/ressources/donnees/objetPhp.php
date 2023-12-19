<?php
include_once '../../classes_sae/Etudiant.php';
include_once '../../classes_sae/CreneauRecherche.php';
include_once '../../classes_sae/Jour.php';
include_once '../../classes_sae/Offre.php';
include_once '../../classes_sae/Etudiant.php';

// Recuperer offre
$OffrePath = './offres/offre1.json';
$offreJson = file_get_contents($OffrePath);
$offre = json_decode($offreJson, true);

// Chemin du répertoire contenant les fichiers JSON
$directoryPath = './etudiants/';

// Tableau pour stocker les données des étudiants
$etudiants = array();

// Charger les fichiers JSON du répertoire
foreach (glob($directoryPath . '*.json') as $etudiantPath) {
    $etudiantJson = file_get_contents($etudiantPath);
    $etudiantData = json_decode($etudiantJson, true);

    // Ajouter les données de l'étudiant au tableau
    $etudiants[] = $etudiantData;
}

// Recuperer etudiantNULL
$etudiantNULLPath = './etudiants/etudiantNULL.json';
$etudiantNULLJson = file_get_contents($etudiantNULLPath);
$etudiantNULL = json_decode($etudiantNULLJson, true);

// Tableau pour stocker les objets Etudiant
$etudiantsArray = array();

$nbetudiant = 0;

foreach ($etudiants as $etudiant) {
    $nbetudiant++;

    // Accédez à chaque jour
    for ($i = 1; $i <= count($etudiant1['Jour']); $i++) {
        // Accédez au jour actuel
        $jourActuelData = $etudiant1['Jour']['Jour' . $i];

        // Initialisez un tableau pour stocker les créneaux du jour actuel
        $creneauxDuJour = array();

        // Parcourez les créneaux dans le jour actuel
        foreach ($jourActuelData as $creneauKey => $creneauData) {
            // Vérifiez si la clé commence par "CreneauRecherche" pour éviter d'autres clés
            if (strpos($creneauKey, 'CreneauRecherche') === 0) {
                // Construisez un objet CreneauRecherche avec les données du créneau
                $creneauInstance = new CreneauRecherche($creneauData['heureDeb'], $creneauData['heureFin']);

                // Ajoutez le créneau à la liste des créneaux du jour actuel
                $creneauxDuJour[] = $creneauInstance;
            }
        }

        // Ajoutez les créneaux du jour actuel avec le nom du jour au tableau de la semaine
        $creneauSemaine[$jourActuelData['jour']] = $creneauxDuJour;
    }

    // Créez un nouvel objet Etudiant et ajoutez-le au tableau
    $etudiantInstance = new Etudiant($etudiant['Etudiant']['ine'], $etudiant['Etudiant']['nom'], $etudiant1['Etudiant']['prenom'], $creneauSemaine);
    $etudiantsArray[] = $etudiantInstance;
}

echo '<pre>';
print_r($etudiantsArray);
echo '</pre>';


?>