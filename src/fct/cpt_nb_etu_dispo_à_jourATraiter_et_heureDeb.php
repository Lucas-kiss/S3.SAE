<?php
    function cpt_nb_etu_dispo_à_jourATraiter_et_heureDeb ($uneOffre, $jourATraiter, $heureDeb)
    {
        $cptEtuDispo = 0;
        // pour tous les candidats
        foreach ($uneOffre->getCandidats() as $etu)
        {
            // faire pointer un itérateur sur le jour à traiter
            foreach($etu->getPlanning() as $itJourEtu)
            {
                // etu est dispo à jourATraiter
                if ($itJourEtu->getJour() == $jourATraiter->getJour())
                {
                    // pour tous les creneaux du jour de l'etu
                    foreach($itJourEtu->getCreneau() as $itCreneauEtu)
                    {
                        if ($heureDeb >= $itCreneauEtu->getHeureDeb() && $heureDeb < $itCreneauEtu->getheureFin())
                        {
                            // l'étu peut travailler à jourATraiter et heureDeb
                            $cptEtuDispo++;
                        }
                    }
                }   
            }
        }
        return $cptEtuDispo;
    }
?>