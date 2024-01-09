<?php
/**
 * @file CombJour.php
 * @author fconstans
 * @brief Création de la classe CombJour
 * @version 1
 * @date 2023-12-19
 * 
 */

/**
 * @brief Cette classe définit les CombJour pour une Offre 
 * 
 * @details CombJour est une classe qui est composée d'une liste d'étudiants lstEtudiant pour un jour (1 étudiant pour 1 heure de la journée) et du nbEtudiants de la combinaison
 */
require_once 'classes_sae/Critere.php';
require_once 'classes_sae/Offre.php';
class CombJour
{

    // ATTRIBUTS
    private $nbEtudiants;
    private $lstEtudiant = array();

    // CONSTRUCTEURS

    /**
     * @brief Constructeur de CombJour avec passage des variables en paramètres
     */
    public function CombJour($nbEtudiants, $lstEtudiant)
    {
        $this->set_nbEtudiants($nbEtudiants);
        $this->set_lstEtudiant($lstEtudiant);
    }

    /**
     * @brief Constructeur par recopie de CombJour
     */
    public function CombJour_copie(CombJour $uneCombJour)
    {
        $this->set_nbEtudiants($uneCombJour->get_nbEtudiants());
        $this->set_lstEtudiant($uneCombJour->get_lstEtudiant());
    }

    // METHODES

    /**
     * @brief Renvoie le nbEtudiants de la CombJour
     */
    public function get_nbEtudiants()
    {
        return $this->nbEtudiants;
    }

    /**
     * @brief Modifie le nbEtudiants de la CombJour par celui passé en paramètre
     */
    public function set_nbEtudiants($nbEtudiants)
    {
        $this->nbEtudiants = $nbEtudiants;
    }

    /**
     * @brief Renvoie la lstEtudiant de la CombJour
     */
    public function get_lstEtudiant()
    {
        return $this->lstEtudiant;
    }

    /**
     * @brief Modifie la lstEtudiant de la CombJour par celui passé en paramètre
     */
    public function set_lstEtudiant($lstEtudiant)
    {
        $this->lstEtudiant = $lstEtudiant;
    }

    /**
     * @brief Ajoute un étudiant à la lstEtudiant de la combJour
     */
    public function ajouterEtudiant($unEtudiant)
    {
        $this->lstEtudiant[] = $unEtudiant;
    }

    /**
     * @brief Retirer l'étudiant passé de la lstEtudiant de la lstEtudiant
     */
    public function retirerEtudiant($unEtudiant)
    {
        if ($this->existeEtudiant($unEtudiant)) {
            unset($this->lstEtudiant[$unEtudiant]);
        }
    }

    /**
     * @brief Vérifie si l'étudiant passé en paramètre existe dans la lstEtudiant
     */
    public function existeEtudiant($unEtudiant)
    {
        return isset($this->lstEtudiant[$unEtudiant]);
    }

    /**
     * @brief Vérifie si le nb minimum d'heures par Etudiant est supérieur à celui donné en Critere de l'Offre passée en paramètre
     */
    public function verifNbMinHeureEtud(Offre $uneOffre, $etuNull)
    {
        $heureMinJour = $uneOffre->get_mesCriteres()->get_nbMinHeureEtudJour();

        foreach ($this->get_lstEtudiant() as $etuCherche) {
            if ($etuCherche != null && $etuCherche != $etuNull) {
                $cptEtu = 0;
                foreach ($this->get_lstEtudiant() as $etuTrouve) {
                    if ($etuCherche == $etuTrouve) {
                        $cptEtu++;
                    }
                }
                if ($cptEtu < $heureMinJour) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @brief Vérifie si le nb minimum d'Etudiant par jour est supérieur à celui donné en Critere de l'Offre passée en paramètres
     */
    public function verifNbMinEtud(Offre $uneOffre)
    {
        $critOffre = $uneOffre->get_mesCriteres();
        if ($this->get_nbEtudiants() < $critOffre->get_nbMinEtudJour()) {
            return false;
        } else {
            return true;
        }
    }

}


?>