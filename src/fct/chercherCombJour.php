<?php
/**
 * @file    horairesEtuCorrespHorairesOffre.php
 * 
 * @author  AUDOUARD Raphaël / 1P'titJob
 * 
 * @brief   Définition de la fonction chercherCombJour.
 *          Cette fonction permet de chercher toutes les combinaisons d'un jour
 * 
 * @version 1
 * 
 * @date    19/12/2023
 * 
 * @details 
 * 
 * @param   $heureDeb de type Entier
 * @param   $heureFin de type Entier
 * @param   $uneCombDUnJour objet de classe CombJour
 * @param   $combsChaqueJour Liste d'arrays d'objets de classe CombJour
 * @param   $uneOffre objet de classe Offre
 * @param   $combsUnJour Array objets de classe CombJour
 * @param   $itJourOffre itérateur pointant sur un objet de classe Jour
 * @param   $etuNull objet de classe Etudiant
 */

function chercherCombJour($uneOffre,$etuNull,
                          $itJourOffre,$combsChaqueJour) {
    // Initialiser les variables
    $combsUnJour = [];
    $heureDeb = 0;
    $heureFin = 23;
    $uneCombDUnJour = new CombJour;

    // Créer toutes les combinaisons du jour
    combJour($uneOffre, $uneCombDUnJour,
             $heureDeb, $heureFin,
             $itJourOffre, $combsUnJour);

    // Ajouter combsUnJour dans combsTsJours
    $combsChaqueJour[]($combsUnJour);

    $itJourOffre++;
    
    return $combsChaqueJour;
}

?>