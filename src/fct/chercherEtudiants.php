<?php

require_once 'fct/horairesEtuCorrespHorairesOffre.php';
require_once 'classes_sae/CombJour.php';
require_once 'classes_sae/Offre.php';
require_once 'classes_sae/Jour.php';

/**
 * @file    chercherEtudiants.php
 * 
 * @author  AUDOUARD Raphaël / 1P'titJob
 * 
 * @brief   Définition de la procédure horairesEtuCorrespHorairesOffre.
 *          Cette procédure permet de chercher les étudiants qui correspondent 
 *          à heureDeb
 * 
 * @version 1
 * 
 * @date    19/12/2023
 * 
 * @details 
 * 
 * @param   $uneCombDUnJour objet de classe CombJour
 * @param   $uneOffre objet de classe Offre
 * @param   $combsUnJour Array objet de classe CombJour
 * @param   $heureDeb de type Entier
 * @param   $heureFin de type Entier
 * @param   $itJourOffre itérateur pointant sur un objet de classe Jour
 * @param   $cptEtudDispo de type Entier
 */

function chercherEtudiants($uneOffre, $combsUnJour,
    CombJour $uneCombDUnJour, int $heureDeb,
    int $heureFin, Jour $jourATraiter,
    $cptEtudDispo, $etuNull)
{
    $trouveEtu = false;

    foreach ($uneOffre->get_candidats() as $etu) {
        // Faire pointer un itérateur sur le jour à traiter
        foreach ($etu->get_planning() as $itJourEtu) {
            // etu est dispo à jourATraiter
            if ($itJourEtu->get_jour() == $jourATraiter->get_jour()) {
                break;
            }

        }

        // Vérifier si les horaires de etu correspondent aux horaires de l'Offre
        horairesEtuCorrespHorairesOffre($itJourEtu, $trouveEtu,
            $uneCombDUnJour, $cptEtudDispo, $uneOffre,
            $combsUnJour, $heureDeb,
            $heureFin, $jourATraiter, $etu, $etuNull);
    }

    // Si aucun étudiant ne peut travailler à heureDeb
    if (!$trouveEtu) {
        // Ajouter EtuNull dans uneCombDUnJour.lstEtudiant
        $uneCombDUnJour->ajouterEtudiant($etuNull);
        calculerCombJour($uneOffre, $uneCombDUnJour,
            $heureDeb + 1, $heureFin, $jourATraiter, $combsUnJour, $etuNull);
    }
}


?>