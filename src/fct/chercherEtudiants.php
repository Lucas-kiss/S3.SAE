<?php

require_once 'fct/horairesEtuCorrespHorairesOffre.php';

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
                           $uneCombDUnJour, $heureDeb,
                           $heureFin, $itJourOffre,
                           $cptEtudDispo, $etuNull) 
{
    $trouveEtu = false;
    foreach ($combsUnJour->getLstEtudiant() as $etu) 
    {
        // Faire pointer un itérateur sur le jour à traiter
        $itJourEtu = &$jourATraiter; 
        while ($itJourEtu->getJour() != $jourATraiter->getJour())
        {
            $itJourEtu++;
        }
        horairesEtuCorrespHorairesOffre($itJourEtu, $trouveEtu,
                                        $uneCombDUnJour, $cptEtudDispo , $uneOffre,
                                        $combsUnJour, $heureDeb, 
                                        $heureFin, $itJourOffre,
                                        $cptEtudDispo, $etu, $etuNull);
    }
    // Si aucun étudiant ne peut travailler à heureDeb
    if (!$trouveEtu) 
    {
        // Ajouter EtuNull dans uneCombDUnJour.lstEtudiant
        $uneCombDUnJour->lstEtudiant()[] = $etuNull;
        calculerCombJour($uneOffre, $combsUnJour,
                 $uneCombDUnJour, $heureDeb+1,
                 $heureFin, $itJourOffre, $etuNull);
    }
}


?>