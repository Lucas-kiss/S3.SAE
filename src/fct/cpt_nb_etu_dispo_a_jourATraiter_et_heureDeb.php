<?php
    require_once 'classes_sae/Jour.php';
    require_once 'classes_sae/Offre.php';
    require_once 'classes_sae/CreneauRecherche.php';
/**
 * @file    cpt_nb_etu_dispo_a_jourATraiter_et_heureDeb.php
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

function cptNbEtuDispoAJourATraiterHeureDeb($uneOffre, Jour $jourATraiter, $heureDeb)
{
    $cptEtuDispo = 0;
    // pour tous les candidats
    foreach ($uneOffre->get_candidats() as $etu) {
        // faire pointer un itérateur sur le jour à traiter
        foreach ($etu->get_planning() as $itJourEtu) {
            // etu est dispo à jourATraiter
            if ($itJourEtu->get_jour() == $jourATraiter->get_jour()) {
                // pour tous les creneaux du jour de l'etu
                foreach ($itJourEtu->get_creneaux() as $itCreneauEtu) {
                    if ($heureDeb >= $itCreneauEtu->get_heureDeb() && $heureDeb <= $itCreneauEtu->get_heureFin()) {
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