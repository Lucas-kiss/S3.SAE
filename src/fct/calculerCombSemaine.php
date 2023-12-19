<?php
include '../classes_sae/CombOffre.php';
include_once('../classes_sae/Offre.php');

/**
 * @file    calculerCombSemaine.php
 * @author  fconstans
 * @brief   Fonction appelée dans la fonction calculerCombSemaine()
 * Calcule les CombSemaine de l'offre, càd une combinaison de la semaine.
 * @version 1.0
 * @date    19/12/2023
 * 
 * 
 * @param $uneOffre objet de classe Offre 
 * @param $combsChaqueJour tableau composé de toutes les combinaisons pour chaque jour chaque jour
 * @param $jourATraiter objet de type Jour correspondant à un jour de la semaine où on chercher à calculer toutes les combinaisons du jour
 * @param $uneCombOffre un pointeur vers un objet de la classe CombSemaine, qui est une combinaison possible de l'Offre
 * @param $combsOffre un pointeur vers un objet de la classe CombOffre, qui est toutes les combinaisons possibles de l'Offre
 * 
 */
function calculerCombSemaine(Offre $uneOffre, $combsChaqueJour, $jourATraiter, CombSemaine &$uneCombOffre, CombOffre &$combsOffre)
{
    if ($jourATraiter != end($combsChaqueJour)) {

        // Compter le nb de possiblités de combinaisons pour le jour courant
        $cptPossibilite = 0;
        foreach ($jourATraiter as $element) {
            $cptPossibilite++;
        }

        foreach ($jourATraiter as $element) {
            if ($cptPossibilite > 1) {
                $copieUneCombOffre = CombOffre_copie($uneCombOffre);
                $copieUneCombOffre.ajouterComposant($element);
                calculerCombSemaine($uneOffre, $combsChaqueJour, $jourATraiter+1, $copieUneCombOffre, $combsOffre);
            }
            else {
                $copieUneCombOffre.ajouterComposant($element);
                calculerCombSemaine($uneOffre, $combsChaqueJour, $jourATraiter+1, $copieUneCombOffre, $combsOffre);
            }
        }

        // Calculer nbEtudiants et tauxRemplissage de uneCombOffre


        if ($uneCombOffre.verifNbMinEtud($uneOffre) && $uneCombOffre.verifNbMinHeureEtud($uneOffre)) {
            $combsOffre.ajouterComposant($uneCombOffre);
        }
        else {
            $uneCombOffre.__destruct();
        }
    }

}

?>