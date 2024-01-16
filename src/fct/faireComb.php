<?php
require_once 'classes_sae/CombOffre.php';
require_once 'fct/calculerCombSemaine.php';
require_once 'fct/chercherCombJour.php';
require_once 'fct/triComb.php';

/**
 * @file    faireComb.php
 * @author  fconstans
 * @brief   Fonction appelée dans la fonction faireComb()
 * Fait les combinaisons d'Etudiant pour l'Offre
 * @version 1.0
 * @date    19/12/2023
 * 
 * 
 * @param $uneOffre objet de classe Offre 
 * @param $etuNull un étudiant vide permettant de montrer quand aucun étudiant n'est dispo pour l'heure
 * 
 */
function faireComb(Offre $uneOffre, $etuNull, &$combsOffre, &$lstCombSemaineSupp)
{
    $combsChaqueJour = array(array()); // liste  de liste combsUnJour

    print '<h1> Combinaisons par jour </h1>';
    // Chercher toutes les combinaisons
    foreach ($uneOffre->get_planning() as $itJourOffre) {
        // Chercher toutes les combinaisons d'un jour
        chercherCombJour($uneOffre, $etuNull, $itJourOffre, $combsChaqueJour);
    }
    print '<hr>';

    // Chercher toutes les combinaisons à partir des combinaisons de chaque jour
    print '<h1> Combinaisons de la semaine </h1>';
    $uneCombOffre = new CombSemaine(null, null, null);
    $i = 1;
    calculerCombSemaine($uneOffre, $combsChaqueJour, $uneCombOffre, $combsOffre, $etuNull, $i, $lstCombSemaineSupp);
    $combsOffre->set_nbCombinaisons(count($combsOffre->get_mesComposants()));

    
    // Trier les combinaisons
    triComb($combsOffre, $uneOffre);

}

?>