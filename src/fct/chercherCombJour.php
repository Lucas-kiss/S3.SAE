<?php

/**
 * @file    chercherCombJour.php
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
require_once 'calculerCombJour.php';
require_once 'classes_sae/Offre.php';
function chercherCombJour(
    Offre $uneOffre,
    $etuNull,
    $itJourOffre,
    &$combsChaqueJour
) {
    // Initialiser les variables
    $combsUnJour = array();
    $heureDeb = 0;
    $heureFin = 24;
    $uneCombDUnJour = new CombJour(null, null, null);

    $lstCombJourSupp = array();

    // Créer toutes les combinaisons du jour
    calculerCombJour(
        $uneOffre,
        $uneCombDUnJour,
        $heureDeb,
        $heureFin,
        $itJourOffre,
        $combsUnJour,
        $etuNull,
        $lstCombJourSupp
    );

    // Ajouter combsUnJour dans combsChaqueJour
    $combsChaqueJour[] = $combsUnJour;


    // afficher les combinaisons retenues
    if (count($combsUnJour) > 0) {
        print '<b class=combValide> Combinaisons retenues du ' . $combsUnJour[0]->get_jour() . '</b>';
        // afficher les heures de la journée
        ?>
        <table>
            <tr>
                <td>Jour</td>
                <?php
                for ($i = 0; $i < 24; $i++) {
                    print '<td>' . $i . 'h</td>';
                }
                ?>
            </tr>
            <?php
            $cptComb = 0;
            // afficher les combinaisons de la journée
            foreach ($combsUnJour as $uneCombJour) {
                // afficher une comb de la journée
                $cptComb++;
                print '<tr> <td>Comb' . $cptComb . '</td>';
                foreach ($uneCombJour->get_lstEtudiant() as $unEtu) {
                    if ($unEtu == null) {
                        print '<td class=pasEtu></td>';
                    } else if ($unEtu == $etuNull) {
                        print '<td class=etuNull></td>';
                    } else {
                        print '<td class=unEtu>' . $unEtu->get_prenom() . ' ' . $unEtu->get_nom() . '</td>';
                    }
                }
            }
        print '</table> <br>';
    }


    // afficher les combinaisons non retenues
    if (count($lstCombJourSupp) > 0) {
        print '<b class=combInvalide> Combinaisons non retenues du ' . $lstCombJourSupp[0]->get_jour() . '</b>';
        ?>
            <table>
                <tr>
                    <td>Jour</td>
                    <?php
                    for ($i = 0; $i < 24; $i++) {
                        print '<td>' . $i . 'h</td>';
                    }
                    ?>
                </tr>
                <?php
                $cptComb = 0;
                // afficher les combinaisons de la journée
                foreach ($lstCombJourSupp as $uneCombJour) {
                    // afficher une comb de la journée
                    $cptComb++;
                    print '<tr> <td>Comb' . $cptComb . '</td>';
                    foreach ($uneCombJour->get_lstEtudiant() as $unEtu) {
                        if ($unEtu == null) {
                            print '<td class=pasEtu></td>';
                        } else if ($unEtu == $etuNull) {
                            print '<td class=etuNull></td>';
                        } else {
                            print '<td class=unEtu>' . $unEtu->get_prenom() . ' ' . $unEtu->get_nom() . '</td>';
                        }
                    }
                }
            print '</table> <br>';
    }


}

?>