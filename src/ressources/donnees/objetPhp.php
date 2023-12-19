<?php
include '../../classes_sae/Etudiant.php';
include '../../classes_sae/CreneauRecherche.php';
include '../../classes_sae/Jour.php';
include '../../classes_sae/Offre.php';
include '../../classes_sae/Etudiant.php';

// Recuperer offre
$OffrePath = './resultatTest.json';
$offreJson = file_get_contents($OffrePath);
$offre = json_decode($offreJson, true); 

// Recuperer etudiant1
$etudiant1Path = './etudiant1.json';
$etudiant1Json = file_get_contents($etudiant1Path);
$etudiant1 = json_decode($etudiant1Json, true);

// Recuperer etudiant2
$etudiant2Path = './etudiant2.json';
$etudiant2Json = file_get_contents($etudiant2Path);
$etudiant2 = json_decode($etudiant2Json, true);

// Recuperer etudiant3
$etudiant3Path = './etudiant3.json';
$etudiant3Json = file_get_contents($etudiant3Path);
$etudiant3 = json_decode($etudiant3Json, true);

// Recuperer etudiantNULL
$etudiantNULLPath = './etudiantNULL.json';
$etudiantNULLJson = file_get_contents($etudiantNULLPath);
$etudiantNULL = json_decode($etudiantNULLJson, true);

// Creation des crenaux
$creneauxEtudiant1=new CreneauRecherche($etudiant1['Jour']['CreauRecherche1']->heureDeb,$etudiant1['Jour']['CreauRecherche1']->heureFin);
var_dump($creneauxEtudiant1);


// Creation des nouveaux etudiants
$etudiant1=new Etudiant($data['Etudiant']['ine'],$data['Etudiant']['nom'],$data['Etudiant']['prenom'],$creneauxEtudiant1);

echo '<pre>';
print_r ($etudiant1);
echo '</pre>';


?> 