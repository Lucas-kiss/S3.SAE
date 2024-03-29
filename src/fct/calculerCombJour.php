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
 * @param   $combsUnJour Aray d'objet de classe CombJour
 */
require_once 'classes_sae/Jour.php';
require_once 'classes_sae/CombJour.php';
require_once 'fct/cpt_nb_etu_dispo_a_jourATraiter_et_heureDeb.php';
require_once 'fct/chercherEtudiants.php';

function calculerCombJour(Offre $uneOffre, CombJour &$uneCombDUnJour, int $heureDeb, int $heureFin, Jour $jourATraiter, &$combsUnJour, Etudiant $etuNull, &$lstCombJourSupp)
{

    if ($heureDeb < $heureFin) {
        //Verifier si l'entreprise recherche un étudiant pour heureDeb
        $horaireEstRecherche = false;
        foreach ($jourATraiter->get_creneaux() as $itCreneauOffre) {
            //var_dump($heureDeb,$jourATraiter->get_jour(),$heureFin,$itCreneauOffre->get_heureDeb(),$itCreneauOffre->get_heureFin());
            if (($heureDeb >= $itCreneauOffre->get_heureDeb()) && ($heureDeb < $itCreneauOffre->get_heureFin())) {
                $horaireEstRecherche = true;    
                break;
            }
        }

        if ($horaireEstRecherche) {
            //Compter le nb d'étudiants disponibles pour le jourATraiter et l'heureDeb
            $cptEtuDispo = cptNbEtuDispoAJourATraiterHeureDeb($uneOffre, $jourATraiter, $heureDeb);

            //Chercher les étudiants qui correspondent à l'heureDeb
            chercherEtudiants($uneOffre, $combsUnJour, $uneCombDUnJour, $heureDeb, $heureFin, $jourATraiter, $cptEtuDispo, $etuNull, $lstCombJourSupp);
        } else {
            //Ajouter null à uneCombDUnJour.lstEtudaint
            $uneCombDUnJour->ajouterEtudiant(null);
            if ($heureDeb != $heureFin) { 
                calculerCombJour($uneOffre, $uneCombDUnJour, $heureDeb +1, $heureFin, $jourATraiter, $combsUnJour, $etuNull, $lstCombJourSupp);    
            }
      
        }
    } 
    else {
        //Calculer nbEtudiants de uneCombDUnJour
        $nbEtudiants = 0;
        //liste temporaire comprenant les étudiants déjà comptés.
        $etuDejaVu = array();
        // var_dump($uneCombDUnJour->get_lstEtudiant());
        foreach ($uneCombDUnJour->get_lstEtudiant() as $etu) {
            //si pas d'étudiant (null ou etuNull) et nouvel étudiant, alors nbEtudiants++
            if ($etu != null && $etu != $etuNull) {
                if (!in_array($etu, $etuDejaVu)) {
                    $etuDejaVu[] = $etu;
                    $nbEtudiants++;
                }
            }
        }

        $uneCombDUnJour->set_nbEtudiants($nbEtudiants);
        $uneCombDUnJour->set_jour($jourATraiter->get_jour());

        if ($uneCombDUnJour->verifNbMinEtud($uneOffre) && $uneCombDUnJour->verifNbMinHeureEtud($uneOffre, $etuNull)) {
            //Ajouter uneCombDUnJour à CombsUnJour
            $combsUnJour[] = $uneCombDUnJour;
        }
        else {
            // Combinaisons supprimées
            $lstCombJourSupp[] = $uneCombDUnJour;

        }

    }
    
}
?>