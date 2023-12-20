<?php


function horairesEtuCorrespHorairesOffre($itJourEtu,$trouveEtu,
                                         $uneCombDUnJour,
                                         $cpEtudDispo, $uneOffre,
                                         $combsUnJour, $heureDeb, 
                                         $heureFin, $itJourOffre,
                                         $cptEtudDispo, $etu, $etuNull)

{
    $itCreneauEtu = $itJourEtu->getCreneau()[0];
    $horaireEtuCorrespond = false;
    while (($horaireEtuCorrespond == false) or ($itCreneauEtu != $itJourEtu->getCreneau()[-1])) 
    {
        if (($heureDeb >= $itCreneauEtu->getHeureDeb()) && ($heureDeb < $itCreneauEtu->getHeureFin()))
        {
            $trouveEtu = true;
            if ($cptEtudDispo == 1) 
            {
                $itCreneauEtu->lstEtudiant()[] = $etu;
                calculerCombJour($uneOffre,
                         $uneCombDUnJour,
                         $heureDeb+1,$heureFin,
                         $itJourOffre,
                         $combsUnJour, $etuNull);
            }
            else 
            {
                $copieUneCombDUnJour = $uneCombDUnJour;
                calculerCombJour($uneOffre,
                         $copieUneCombDUnJour,
                         $heureDeb+1,$heureFin,
                         $itJourOffre,
                         $combsUnJour, $etuNull);
            }
        }
    }
}

?>