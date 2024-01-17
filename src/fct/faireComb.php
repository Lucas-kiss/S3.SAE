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
    ?>
    <!-- AFFICHER LE PLANNING DE L'OFFRE -->
    <h1>Planning de l'offre</h1>
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

        <!-- Afficher les combinaisons retenues-->
        <?php
        // liste des jours de la semaine
        $lstJours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        // on parcourt tous les jours de la semaine
        foreach ($lstJours as $leJour) {
            $jourDansOffre = false;
            // on parcourt tous les jours de l'offre
            foreach ($uneOffre->get_planning() as $jourATraiter) {
                // si le jour est compris dans l'offre alors on affiche la ligne du tableau avec les horaires
                if ($leJour == $jourATraiter->get_jour()) {
                    print '<tr> <td>' . $leJour . '</td>';
                    $jourDansOffre = true;
                    // parcourir toutes les heures de la journée
                    for ($heureCourante = 0; $heureCourante < 24; $heureCourante++)
                    {
                        $horaireEstRecherche = false;
                        // parcourir les creneaux pour vérifier si l'offre recherche quelqu'un à l'heureCourante
                        foreach ($jourATraiter->get_creneaux() as $itCreneauOffre) {
                            if (($heureCourante >= $itCreneauOffre->get_heureDeb()) && ($heureCourante < $itCreneauOffre->get_heureFin())) {
                                print '<td class=unEtu></td>';
                                $horaireEstRecherche = true;
                                break;
                            }
                        }
                        if (!$horaireEstRecherche)
                        {
                            print '<td class=pasEtu></td>';
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
    print '</table> <hr>';

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