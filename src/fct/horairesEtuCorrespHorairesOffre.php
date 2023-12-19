<?php
/**
 * @file    horairesEtuCorrespHorairesOffre.php
 * 
 * @author  AUDOUARD Raphaël / 1P'titJob
 * 
 * @brief   Définition de la procédure horairesEtuCorrespHorairesOffre.
 *          Cette procédure permet de vérifier si les horaires des étudiants 
 *          correspondent aux horaires de l'offre
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

function horairesEtuCorrespHorairesOffre($itJourEtu, $trouveEtu,
                                         $uneCombDUnJour, $uneOffre,
                                         $combsUnJour, $heureDeb, 
                                         $heureFin, $itJourOffre,
                                         $cptEtudDispo, $etu)

{
    $itCreneauEtu = $itJourEtu.getCreneau()[0];
    $horaireEtuCorrespond = false;
    while (($horaireEtuCorrespond == false) or ($itCreneauEtu != $itJourEtu.getCreneau()[-1])) 
    {
        if (($heureDeb >= $itCreneauEtu.getHeureDeb()) && ($heureDeb < $itCreneauEtu.getHeureFin()))
        {
            $trouveEtu = true;
            if ($cptEtudDispo == 1) 
            {
                $itCreneauEtu.lstEtudiant()[] = $etu;
                combJour($uneOffre,
                         $uneCombDUnJour,
                         $heureDeb+1,$heureFin,
                         $itJourOffre,
                         $combsUnJour);
            }
            else 
            {
                $copieUneCombDUnJour = $uneCombDUnJour;
                combJour($uneOffre,
                         $copieUneCombDUnJour,
                         $heureDeb+1,$heureFin,
                         $itJourOffre,
                         $combsUnJour);
            }
        }
    }
}

?>