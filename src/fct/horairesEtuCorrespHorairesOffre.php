<?php

require_once 'classes_sae/Jour.php';
require_once 'classes_sae/CombJour.php';


function horairesEtuCorrespHorairesOffre($itJourEtu, $trouveEtu,
    $uneCombDUnJour,
    $cptEtudDispo, $uneOffre,
    $combsUnJour, $heureDeb,
    $heureFin, $itJourOffre,
    $etu, $etuNull)
{

    foreach ($itJourEtu->get_creneaux() as $itCreneauEtu) {
        if (($heureDeb >= $itCreneauEtu->get_heureDeb()) && ($heureDeb < $itCreneauEtu->get_heureFin())) {
            if ($cptEtudDispo == 1) {
                $uneCombDUnJour->ajouterEtudiant($etu);
                calculerCombJour($uneOffre,
                    $uneCombDUnJour,
                    $heureDeb + 1, $heureFin,
                    $itJourOffre,
                    $combsUnJour, $etuNull);
            } else {
                $copieUneCombDUnJour = new CombJour($uneCombDUnJour->get_nbEtudiants(), $uneCombDUnJour->get_lstEtudiant());
                calculerCombJour($uneOffre,
                    $copieUneCombDUnJour,
                    $heureDeb + 1, $heureFin,
                    $itJourOffre,
                    $combsUnJour, $etuNull);
            }

            break;
        }
    }

}

?>