<?php
/**
 * @file    calculerCombJour.php
 * 
 * @author  DE BRITO Luca / 1P'titJob
 * 
 * @brief   Définition de la procédure calculerCombJour.
 *          Cette procédure permet de générer toutes les combinaisons d'un seul jour
 * 
 * @version 1
 * 
 * @date    19/12/2023
 * 
 * @param   $uneOffre objet de classe Offre
 * @param   $uneCombDUnJour objet de classe CombJour
 * @param   $heureDeb de type Entier
 * @param   $heureFin de type Entier
 * @param   $jourATraiter objet de classe Jour
 * @param   $combsUnJour Aray objet de classe CombJour
 */
require_once 'classes_sae/Jour.php';
require_once 'classes_sae/CombJour.php';
function calculerCombJour(Offre $uneOffre, $uneCombDUnJour, $heureDeb, $heureFin,$jourATraiter, $combsUnJour, $etuNull)
{
    if ($heureDeb != $heureFin) {
        //Verifier si l'entreprise recherche un étudiant pour heureDeb
        $horaireEstRecherche = false;
        $itCreneauOffre = array_values($jourATraiter->get_creneaux())[0];

        while (!$horaireEstRecherche && $itCreneauOffre != array_values($jourATraiter->get_creneaux())[0]) {
            if ($heureDeb >= $itCreneauOffre->getHeureDeb() && $heureDeb < $itCreneauOffre->getHeureFin()) {
                $horaireEstRecherche = true;
            }
        }

        if ($horaireEstRecherche) {
            //Compter le nb d'étudiants disponibles pour le jourATraiter et l'heureDeb
            $cptEtuDispo = cptNbEtuDispoAJourATraiterHeureDeb($uneOffre, $jourATraiter, $heureDeb);

            //Chercher les étudiants qui correspondent à l'heureDeb
            chercherEtudiants($uneOffre, $combsUnJour, $uneCombDUnJour, $heureDeb, $heureFin, $jourATraiter, $cptEtuDispo, $etuNull); //A vérifier
        } else {
            //Ajouter null à uneCombDUnJour.lstEtudaint
            $uneCombDUnJour->ajouterEtudiant(null);

            calculerCombJour($uneOffre, $uneCombDUnJour, $heureDeb + 1, $heureFin, $jourATraiter, $combsUnJour, $etuNull); //A vérifier
        }
    } else {
        //Calculer nbEtudiants de uneCombDUnJour
        $nbEtudiants = 0; 
        //liste temporaire comprenant les étudiants déjà comptés.
        $etuDejaVu = array();
        foreach ($uneCombDUnJour->get_lstEtudiant() as $etu) {
            //si pas d'étudiant (null ou etuNull) et nouvel étudiant, alors nbEtudiants++
            if ($etu != null && $etu != "etuNull") {
                if (!in_array($etu, $etuDejaVu)) {
                    $etuDejaVu[] = $etu;
                    $nbEtudiants++;
                }
            }
        }

        $uneCombDUnJour->set_nbEtudiants($nbEtudiants);

        //$etuDejaVu->__destruct;//A verifier

        if ($uneCombDUnJour->verifNbMinEtud($uneOffre) && $uneCombDUnJour->verifNbMinHeureEtud($uneOffre)) {
            //Ajouter uneCombDUnJour à CombsUnJour
            $combsUnJour[] = $uneCombDUnJour;
        } 
    }
}
?>