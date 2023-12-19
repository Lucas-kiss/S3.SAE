<?php
include '../../../classes_sae/Etudiant.php';
include '../../../classes_sae/CreneauRecherche.php';
include '../../../classes_sae/Jour.php';
include '../../../classes_sae/Offre.php';
include '../../../classes_sae/Etudiant.php';

//Recuperer offre
$Offre ='./resultatTest.json';
//Recuperer etudiant
$etudiant ='./etudiant1.json';

// Lire le contenu du fichier JSON
$jsonString = file_get_contents($etudiant);

// Décoder le fichier JSON
$data = json_decode($jsonString, true);

// Afficher les données
echo '<pre>';
// print_r($data);
echo '</pre>';

//Recuperation du planning
for ($i=1; $i <= 7; $i++) { 
    $creneauxEtudiant1[]=$data['Jour']['Jour'.$i];
}

// Creation du nouveaux etudiant
$etudiant1=new Etudiant($data['Etudiant']['ine'],$data['Etudiant']['nom'],$data['Etudiant']['prenom'],$creneauxEtudiant1);

echo '<pre>';
print_r ($etudiant1);
echo '</pre>';


?> 