<?php
/**
 * @file    cpt_nb_etu_dispo_à_jourATraiter_et_heureDeb.php
 * @author  Kévin BÉGUINEL
 * @brief   Fonction appelée dans la fonction calculerCombJour()
 * Calcule et retourne le nombre d'étudiants dispo durant le jourATraiter (ex: lundi, mardi, etc) à l'heure nommé heureDeb (ex:14)
 * @version 1.0
 * @date    19/12/2023
 * 
 * 
 * @param $uneOffre objet de classe Offre 
 * @param $jourATraiter objet de type Jour correspondant à un jour de la semaine où on chercher à calculer toutes les combinaisons du jour
 * @param $heureDeb entier correspondant à une heure de la journée
 * @return int 
 */

function cptNbEtuDispoAJourATraiterHeureDeb($uneOffre, $jourATraiter, $heureDeb)
{
    $cptEtuDispo = 0;
    // pour tous les candidats
    foreach ($uneOffre->getCandidats() as $etu) {
        // faire pointer un itérateur sur le jour à traiter
        foreach ($etu->getPlanning() as $itJourEtu) {
            // etu est dispo à jourATraiter
            if ($itJourEtu->getJour() == $jourATraiter->getJour()) {
                // pour tous les creneaux du jour de l'etu
                foreach ($itJourEtu->getCreneau() as $itCreneauEtu) {
                    if ($heureDeb >= $itCreneauEtu->getHeureDeb() && $heureDeb < $itCreneauEtu->getheureFin()) {
                        // l'étu peut travailler à jourATraiter et heureDeb
                        $cptEtuDispo++;
                    }
                }
            }
        }
    }
    return $cptEtuDispo;
}
?>