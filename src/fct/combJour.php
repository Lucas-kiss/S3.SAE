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
                $cptEtuDispo = cptNbEtuDispoAJourATraiterHeureDeb($uneOffre, $jourATraiter, $heureDeb);

                //Chercher les étudiants qui correspondent àc l'heureDeb
                chercherEtuHeureDeb($uneOffre, $combsUnJour, $uneCombDUnJour, $heureDeb, $heureFin, $jourATraiter, $cptEtuDispo);//A vérifier
            }
            else
            {
                //Ajouter null à uneCombDUnJour.lstEtudaint
                $uneCombDUnJour[] = null;

                calculerCombJour($uneOffre, $uneCombDUnJour, $heureDeb+1, $heureFin, $jourATraiter, $combsUnJour);//A vérifier
            }
        }
        else
        {
            //Calculer nbEtudiants de uneCombDUnJour
            $nbEtudiants = 0;
            //liste temporaire comprenant les étudiants déjà comptés.
            $etuDejaVu = array();
            foreach($uneCombDUnJour->get_lstEtudiant() as $etu)
            {
                //si pas d'étudiant (null ou etuNull) et nouvel étudiant, alors nbEtudiants++
                if ($etu != null && $etu != "etuNull")
                {
                    if (!in_array($etu, $etuDejaVu))
                    {
                        $etuDejaVu[] = $etu;
                        $nbEtudiants++;
                    }
                }
            }

            $uneCombDUnJour->set_nbEtudiants($nbEtudiants);

            $etuDejaVu->__destruct;//A verifier

            if($uneCombDUnJour->verifNbMinEtud($uneOffre) && $uneCombDUnJour->verifNbMinHeureEtud($uneOffre))
            {
                //Ajouter uneCombDUnJour à CombsUnJour
                $combsUnJour[] = $uneCombDUnJour;
            }
            else
            {
                //Détruire uneCombDUnJour
                $uneCombDUnJour->__destruct;//A verifier
            }
        }
    }
?>