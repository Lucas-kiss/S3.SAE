<?php  
    require_once 'classes_sae/CombOffre.php';
    require_once 'classes_sae/Offre.php';

/**
 * @file    triComb.php
 * @author  Kévin BÉGUINEL
 * @brief   Procédure qui permet de modifier combsOffre en triant les combinaisons de la semaine.
 * On trie d'abord les combinaisons de la semaine par taux de remplissage décroissant.
 * Si 2 combinaisons ont le même taux de remplissage, alors on trie ces 2 combinaisons par le nb d'étudiants total croissants.
 * 
 * @version 1.0
 * @date    20/12/2023
 * 
 * @param $combsOffre objet de la classe CombOffre composée de toutes les combinaisons de la semaine possible de l'offre
 * @param $uneOffre objet de classe Offre 
 */

    function triComb (CombOffre &$combsOffre, Offre $uneOffre)
    {
        for ($i=0; $i < count($combsOffre->get_mesComposants()); $i++)
        {   
            for ($j=0; $j < count($combsOffre->get_mesComposants())-1; $j++)
            {   
                $tauxCombActuelle = $combsOffre->get_mesComposants()[$j]->get_tauxRemplissage();
                $tauxCombProchain = $combsOffre->get_mesComposants()[$j+1]->get_tauxRemplissage();
                
                if ($tauxCombActuelle < $tauxCombProchain)
                {
                    //tri par tauxRemp décroissant
                    $temp = $combsOffre->get_mesComposants()[$j+1];
                    $combsOffre->get_mesComposants()[$j+1] = $combsOffre->get_mesComposants()[$j];
                    $combsOffre->get_mesComposants()[$j] = $temp;
                }
                if ($tauxCombActuelle == $tauxCombProchain)
                {
                    // tri par nb étu différents croissant
                    $nbEtuCombActuelle = $combsOffre->get_mesComposants()[$j]->get_nbEtudiants();
                    $nbEtuCombProchain =  $combsOffre->get_mesComposants()[$j+1]->get_nbEtudiants();

                    if ($nbEtuCombActuelle > $nbEtuCombProchain)
                    {
                        //tri par tauxRemp décroissant
                        $comp1 = $combsOffre->get_mesComposants()[$j];
                        $comp2 = $combsOffre->get_mesComposants()[$j+1];
                        $combsOffre->echangerComposant($comp1, $comp2);
                    }
                }
            }
        }
    }

?>