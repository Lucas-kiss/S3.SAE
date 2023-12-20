<?php
require_once 'classes_sae/Etudiant.php';
require_once 'classes_sae/CreneauRecherche.php';
require_once 'classes_sae/Jour.php';
require_once 'classes_sae/Offre.php';
require_once 'classes_sae/Etudiant.php';


// Chemin du répertoire contenant les fichiers etudiants.JSON
$dossierEtudiants = 'ressources/donnees/etudiants/';

// Charger les fichiers JSON des etudiants
foreach (glob($dossierEtudiants . '*.json') as $cheminEtudiants) {
    $etudiantJson = file_get_contents($cheminEtudiants);
    $etudiantDonnes = json_decode($etudiantJson, true);

    // Ajouter les données de l'étudiant au tableau
    $etudiants[] = $etudiantDonnes;
}

//Ine de l'etudiant null pour pouvoir l'identifier
$ineEtudiantNull = '000000000N';

// Chemin du répertoire contenant les fichiers offres.JSON
$dossierOffres = 'ressources/donnees/offres/';

// Charger les fichiers JSON des offres
foreach (glob($dossierOffres . '*.json') as $cheminOffres) {
    $offreJson = file_get_contents($cheminOffres);
    $offreDonnes = json_decode($offreJson, true);

    // Ajouter les données de l'étudiant au tableau
    $offres[] = $offreDonnes;
}

// Tableau pour stocker les objets Etudiant
$lstObjEtudiant = array();

foreach ($etudiants as $etudiant) {
    if ($etudiant['Etudiant']['ine'] !== $ineEtudiantNull) {

        // Créer un objet Etudiant avec les données
        $etudiantInstance = new Etudiant($etudiant['Etudiant']['ine'], $etudiant['Etudiant']['nom'], $etudiant['Etudiant']['prenom'], null);

        // Parcourir les jours pour l'étudiant actuel
        foreach ($etudiant['Jour'] as $jourKey => $jourData) {

            // Initialisez un tableau pour stocker les créneaux du jour actuel
            $creneauxDuJour = array();

            // Parcourez les créneaux dans le jour actuel
            foreach ($jourData as $creneauKey => $creneauData) {
                // Vérifiez si la clé commence par "CreneauRecherche" pour éviter d'autres clés
                if (strpos($creneauKey, 'CreneauRecherche') === 0) {
                    // Construisez un objet CreneauRecherche avec les données du créneau
                    $creneauInstance = new CreneauRecherche($creneauData['heureDeb'], $creneauData['heureFin']);

                    // Ajoutez le créneau à la liste des créneaux du jour actuel
                    $creneauxDuJour[] = $creneauInstance;
                }
            }
            //Creer un jour
            $Jour = new Jour($jourData['jour'], $creneauxDuJour);

            // Ajouter le jour à l'étudiant
            $etudiantInstance->ajouter_jour($Jour);
        }

        // Ajout objet Etudiant au tableau
        $lstObjEtudiant[] = $etudiantInstance;
    } else {
        // Créer un objet Etudiant avec les données
        $etudiantNull = new Etudiant($etudiant['Etudiant']['ine'], $etudiant['Etudiant']['nom'], $etudiant['Etudiant']['prenom'], null);

        // Parcourir les jours pour l'étudiant actuel
        foreach ($etudiant['Jour'] as $jourKey => $jourData) {

            // Initialisez un tableau pour stocker les créneaux du jour actuel
            $creneauxDuJour = array();

            // Parcourez les créneaux dans le jour actuel
            foreach ($jourData as $creneauKey => $creneauData) {
                // Vérifiez si la clé commence par "CreneauRecherche" pour éviter d'autres clés
                if (strpos($creneauKey, 'CreneauRecherche') === 0) {
                    // Construisez un objet CreneauRecherche avec les données du créneau
                    $creneauInstance = new CreneauRecherche($creneauData['heureDeb'], $creneauData['heureFin']);

                    // Ajoutez le créneau à la liste des créneaux du jour actuel
                    $creneauxDuJour[] = $creneauInstance;
                }
            }
            //Creer un jour
            $Jour = new Jour($jourData['jour'], $creneauxDuJour);

            // Ajouter le jour à l'étudiant
            $etudiantNull->ajouter_jour($Jour);
        }
    }
}

// Tableau pour stocker les objets Offre
$lstObjOffre = array();

foreach ($offres as $offre) {
    // Créer un objet Offre
    $offreInstance = new Offre($offre['Offre']['num'], $offre['Offre']['intitule'], null,,null);

   
    // Associer le critère à l'offre
    $offreInstance->lierCriteres($critere);

    // Créer des objets Jour et CreneauRecherche
    foreach ($offre['Jour'] as $jourKey => $jourData) {
        $jour = new Jour($jourData['jour'], []);

        foreach ($jourData as $creneauKey => $creneauData) {
            if (strpos($creneauKey, 'CreneauRecherche') === 0) {
                $creneau = new CreneauRecherche($creneauData['heureDeb'], $creneauData['heureFin']);
                $jour->ajouterCreneau($creneau);
            }
        }

        // Associer le jour à l'offre
        $offreInstance->ajouter_jour($jour);
    }

    // Ajout objet Offre au tableau
    $lstObjOffre[] = $offreInstance;
}


// print "<h1>Etudiants</h1><hr>";
// //Test affichage des etudiants
// foreach ($etudiants as $etudiant) {
//     print "<B> Etudiant :</B><br>";
//     print "<B> INE :</B> " . $etudiant['Etudiant']['ine'] . "<br>";
//     print "<B>Nom :</B> " . $etudiant['Etudiant']['nom'] . "<br>";
//     print "<B>Prenom :</B> " . $etudiant['Etudiant']['prenom'] . "<br>";

//     foreach ($etudiant['Jour'] as $jourKey => $jourData) {
//         print "<B>Jour :</B> " . $jourData['jour'] . "<br>";

//         foreach ($jourData as $creneauKey => $creneauData) {
//             if (strpos($creneauKey, 'CreneauRecherche') === 0) {
//                 print "<B>Creneau Recherche :<br> </B> ";
//                 print "Heure de début : " . $creneauData['heureDeb'] . "<br>";
//                 print "Heure de fin : " . $creneauData['heureFin'] . "<br>";
//             }
//         }
//     }

//     print "<hr>";
// }

// print "<h1>Offres</h1><hr>";

// //Tester l'affichage des offres
// foreach ($offres as $offre) {
//     print "Numéro de l'offre: " . $offre['Offre']['num'] . "<br>";
//     print "Intitulé de l'offre: " . $offre['Offre']['intitule'] . "<br>";

//     foreach ($offre['Jour'] as $jourKey => $jourData) {
//         print "<B>Jour :</B> " . $jourData['jour'] . "<br>";

//         foreach ($jourData as $creneauKey => $creneauData) {
//             if (strpos($creneauKey, 'CreneauRecherche') === 0) {
//                 print "<B>Creneau Recherche :<br> </B> ";
//                 print "Heure de début : " . $creneauData['heureDeb'] . "<br>";
//                 print "Heure de fin : " . $creneauData['heureFin'] . "<br>";
//             }
//         }
//     }

//     // Afficher les critères associés à l'offre
//     print "<B>Critères:<br></B>";
//     foreach ($offre['Critere'] as $critereKey => $critereValue) {
//         print "$critereKey: $critereValue<br>";
//     }

    
//     print "<hr>"; // Séparateur entre les offres
// }




?>