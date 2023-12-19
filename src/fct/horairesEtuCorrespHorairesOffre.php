<?php


function horairesEtuCorrespHorairesOffre($itJourEtu,$trouveEtu,
                                         $uneCombDUnJour,
                                         $cpEtudDispo, $uneOffre,
                                         $combsUnJour, $heureDeb, 
                                         $heureFin, $itJourOffre,
                                         $cptEtudDispo)
{
    $itCreneauEtu = $itJourEtu.creneau.first();
    while (($horaireEtuCorrespond == false) or ($itCreneauEtu != $itJourEtu.getCreneau().end())) 
    {
        if (($heureDeb >= $itCreneauEtu.getHeureDeb()) && ($heureDeb < $itCreneauEtu.getHeureFin()))
        {
            $trouveEtu = true;
            if ($cptEtudDispo == 1) 
            {
                ($uneCombDUnJour.lstEtudiant())[] = $etu;
                combJour($uneOffre,
                         $uneCombDUnJour,
                         $heureDeb+1,$heureFin,
                         $itJourOffre,
                         $combsUnJour);
            }
            else 
            {
                $copieUneCombDUnJour = $uneCombDUnJour;
                combJour($uneOffre,
                         $copieUneCombDUnJour,
                         $heureDeb+1,$heureFin,
                         $itJourOffre,
                         $combsUnJour);
            }
        }
    }
}

?>