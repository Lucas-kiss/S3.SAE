<?php

require_once 'classes_sae/Offre.php';
require_once 'classes_sae/CombSemaine.php';

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
function calculerCombSemaine(Offre $uneOffre, $combsChaqueJour, CombSemaine &$uneCombOffre, CombOffre &$combsOffre, Etudiant $etuNull, $i)
{

    if ($i < count($combsChaqueJour)) {
        $jourATraiter = $combsChaqueJour[$i];
        // Compter le nb de possiblités de combinaisons pour le jour courant
        $cptPossibilite = 0;
        foreach ($jourATraiter as $element) {
            //var_dump($element);
            $cptPossibilite++;
        }

        foreach ($jourATraiter as $element) {
            if ($cptPossibilite > 1) {
                $copieUneCombOffre = new CombSemaine($uneCombOffre->get_tauxRemplissage(), $uneCombOffre->get_nbEtudiants(), $uneCombOffre->get_mesComposants());
                $copieUneCombOffre->ajouterComposant($element);
                calculerCombSemaine($uneOffre, $combsChaqueJour, $copieUneCombOffre, $combsOffre, $etuNull, $i + 1);
            } else {
                $uneCombOffre->ajouterComposant($element);
                calculerCombSemaine($uneOffre, $combsChaqueJour, $uneCombOffre, $combsOffre, $etuNull, $i + 1);
            }
        }
    } else {
        //Calculer nbEtudiants et tauxRemplissage de uneCombOffre

        // Calculer taux de remplissage
        $cptHeuresTrouvee = 0;
        $totHeuresCherchees = 0;
        $indice = 0;
        while ($indice < count($uneCombOffre->get_mesComposants())) {
            foreach ($uneCombOffre->get_mesComposants()[$indice]->get_lstEtudiant() as $etu) {
                if ($etu != null) {
                    $totHeuresCherchees++;
                    if ($etu != $etuNull) {
                        $cptHeuresTrouvee++;
                    }
                }
            }
            $indice++;
        }
        $tauxRemp = round(($cptHeuresTrouvee / $totHeuresCherchees), 2);
        $uneCombOffre->set_tauxRemplissage($tauxRemp);

        // calculer nbEtudiants de la combinaison de la semaine
        $cptEtu = 0;
        $lstEtu = array();
        foreach ($uneCombOffre->get_mesComposants() as $uneCombJour) {
            foreach ($uneCombJour->get_lstEtudiant() as $etu) {
                if ($etu != null && $etu != $etuNull) {
                    if (!in_array($etu, $lstEtu)) {
                        // étudiant pas encore comptée donc on incrémente le compteur et on l'ajoute dans la liste
                        $cptEtu++;
                        $lstEtu[] = $etu;
                    }
                }
            }
        }
        $uneCombOffre->set_nbEtudiants($cptEtu);
       

        // Vérifier que la combinaison de la semaine est valide - PROBLEME
        if ($uneCombOffre->verifNbMinEtud($uneOffre)) 
        {
            $combsOffre->ajouterComposant($uneCombOffre);
        } 
        else 
        {
            //$uneCombOffre.__destruct();
        }

    }
}

?>