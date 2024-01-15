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
function faireComb(Offre $uneOffre, $etuNull, &$combsOffre)
{
    $combsChaqueJour = array(array()); // liste  de liste combsUnJour

    $lstCombSemaineSupp = array();

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

    // afficher les combinaisons de la semaine non retenues
    if (count($lstCombSemaineSupp) > 0) {
        print '<h2> Combinaisons non retenues de la semaine</h2> ';
        print 'Nombre de combinaisons : ' . count($lstCombSemaineSupp) .'<br> <hr>';
        //afficher les combs
        $cptComb = 0;
        foreach ($lstCombSemaineSupp as $unComp) {
            $cptComb++;
            print '<b>Combinaison non retenue ' . $cptComb . '<br></b>';
            print 'Taux de remplissage : ' . ($unComp->get_tauxRemplissage() * 100) . '% -  ';
            print 'Nombre d\'étudiants : ' . $unComp->get_nbEtudiants() . '<br><br>';

            ?>

            <table>
                <!-- Afficher les heures de la journée -->
                <tr>
                    <td>Jour</td>
                    <?php
                    for ($i = 0; $i < 24; $i++) {
                        print '<td>' . $i . 'h</td>';
                    }
                    ?>
                </tr>

                <!-- Afficher les combinaisons -->
                <?php
                // liste des jours de la semaine
                $lstJours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                // on parcourt tous les jours de la semaine
                foreach ($lstJours as $leJour) {
                    $jourDansOffre = false;
                    // on parcourt tous les jours de l'offre
                    foreach ($unComp->get_mesComposants() as $unJour) {
                        // si le jour est compris dans l'offre alors on affiche la ligne du tableau avec les étudiants
                        if ($leJour == $unJour->get_jour()) {
                            $jourDansOffre = true;
                            print '<tr> <td>' . $unJour->get_jour() . '</td>';
                            foreach ($unJour->get_lstEtudiant() as $unEtu) {
                                if ($unEtu == null) {
                                    print '<td class=pasEtu></td>';
                                } else if ($unEtu == $etuNull) {
                                    print '<td class=etuNull></td>';
                                } else {
                                    print '<td class=unEtu>' . $unEtu->get_prenom() . ' ' . $unEtu->get_nom() . '</td>';
                                }
                            }
                        }
                    }
                    // si le jour n'est pas compris dans l'offre alors on affiche une ligne vide
                    if ($jourDansOffre == false) {
                        print '<tr> <td>' . $leJour . '</td>';
                        for ($i = 0; $i < 24; $i++) {
                            print '<td class=pasEtu></td>';
                        }
                    }
                }
                print '</table> <br><hr>';
        }
    }



    // Trier les combinaisons
    triComb($combsOffre, $uneOffre);

}

?>