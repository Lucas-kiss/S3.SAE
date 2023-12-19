<?php

/**
 * @file    horairesEtuCorrespHorairesOffre.php
 * 
 * @author  AUDOUARD Raphaël / 1P'titJob
 * 
 * @brief   Définition de la procédure horairesEtuCorrespHorairesOffre.
 *          Cette procédure permet deChercher les étudiants qui correspondent 
 *          à heureDeb
 * 
 * @version 1
 * 
 * @date    19/12/2023
 * 
 * @details 
 * 
 * @param   $itJourEtu itérateur pointant sur un objet de classe Jour
 * @param   $trouveEtu de type Booléen
 * @param   $uneCombDUnJour objet de classe CombJour
 * @param   $uneOffre objet de classe Offre
 * @param   $combsUnJour Array objet de classe CombJour
 * @param   $heureDeb de type Entier
 * @param   $heureFin de type Entier
 * @param   $itJourOffre itérateur pointant sur un objet de classe Jour
 * @param   $cptEtudDispo de type Entier
 * @param   $etu objet de classe Etudiant
 */

function chercherEtudiants($uneOffre, $combsUnJour,
                           $uneCombDUnJour, $heureDeb,
                           $heureFin, $itJourOffre,
                           $cptEtudDispo) 
{
    $trouveEtu = false;
    foreach ($combsUnJour.getLstEtudiant() as $etu) 
    {
        // Faire pointer un itérateur sur le jour à traiter
        $itJourEtu = &$jourATraiter; 
        while ($itJourEtu.getJour() != $jourATraiter.getJour())
        {
            $itJourEtu++;
        }
        // vérifier si les horaires de etu correspondent aux horaires de l'offre
    }
    // Si aucun étudiant ne peut travailler à heureDeb
    if (!$trouveEtu) 
    {
        // Ajouter EtuNull dans uneCombDUnJour.lstEtudiant
        $EtuNull = new Etudiant;
        ($uneCombDUnJour.lstEtudiant())[] = $EtuNull;
        combJour($uneOffre, $combsUnJour,
                 $uneCombDUnJour, $heureDeb+1,
                 $heureFin, $itJourOffre);
    }
}


?>