<?php
    include '../classes_sae/CombOffre.php';

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
    function faireComb($uneOffre, $etuNull) {
        $combsOffre = new CombOffre();
        $combsChaqueJour = array(array()); // liste  de liste combsUnJour

        // Chercher toutes les combinaisons
        foreach ($uneOffre.get_planning() as $itJourOffre) {
            // Chercher toutes les combinaisons d'un jour
        }

        // Chercher toutes les combinaisons à partir des combinaisons de chaque jour
        $uneCombOffre = new CombSemaine();

        $jourATraiter = $combsChaqueJour[0];
        combSemaine($uneOffre, $combsChaqueJour, $jourATraiter, $uneCombOffre, $combsOffre);
        

    }
    
?>