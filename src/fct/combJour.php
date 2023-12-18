<?php
    function calculerCombJour($uneOffre, $uneCombDUnJour, $heureDeb, $heureFin, $jourATraiter, $combsUnJour)
    {
        if($heureDeb != $heureFin)
        {
            //Verifier si l'entreprise recherche un étudiant pour heureDeb
            $horaireEstRecherche = false;
            $itCreneauOffre = $jourATraiter->getCreneau()->first();
            
            while(!$horaireEstRecherche && $itCreneauOffre != $jourATraiter->getCreneau()->first())
            {
                if($heureDeb >= $itCreneauOffre->getHeureDeb() && $heureDeb < $itCreneauOffre->getHeureFin())
                {
                    $horaireEstRecherche = true;
                }
            }

            if($horaireEstRecherche)
            {
                //Compter le nb d'étudiants disponibles pour le jourATraiter et l'heureDeb
                //A ajouter

                //Chercher les étudiants qui correspondent àc l'heureDeb
                //A ajouter
            }
            else
            {
                //Ajouter null à uneCombDUnJour.lstEtudaint
                $uneCombDUnJour[] = null;

                calculerCombJour($uneOffre, $uneCombDUnJour, $heureDeb+1, $heureFin, $jourATraiter, $combsUnJour);
            }
        }
        else
        {
            //Calculer nbEtudiants de uneCombDUnJour
            //A ajouter

            if($uneCombDUnJour->verifNbMinEtud($uneOffre) && $uneCombDUnJour->verifNbMinHeureEtud($uneOffre))
            {
                //Ajouter uneCombDUnJour à CombsUnJour
                $combsUnJour[] = $uneCombDUnJour;
            }
            else
            {
                //Détruire uneCombDUnJour
                $uneCombDUnJour->__destruct;
            }
        }
    }
?>