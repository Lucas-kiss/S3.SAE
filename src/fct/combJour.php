<?php
    function combJour($uneOffre, $uneCombDUnJour, $heureDeb, $heureFin, $jourATraiter, $combsUnJour)
    {
        if($heureDeb != $heureFin)
        {
            $horaireEstRecherche = false;
            $itCreneauOffre = $itJourOffre.getCreneau().first();
            while(!$horaireEstRecherche && $itCreneauOffre != $itJourOffre.getCreneau().first())
            {
                if($heureDeb >= $itCreneauOffre.getHeureDeb() && $heureDeb < $itCreneauOffre.getHeureFin())
                {
                    $horaireEstRecherche = true;
                }
            }

            
        }
    }
?>