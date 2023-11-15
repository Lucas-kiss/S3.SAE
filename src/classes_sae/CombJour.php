<?php
/**
 * @file CombJour.php
 * @author fconstans
 * @brief Création de la classe CombJour
 * @version 0.1
 * @date 2023-11-15
 * 
 */

 /**
 * @brief Cette classe définit les CombJour pour une Offre 
 * 
 * @details
 */

class CombJour {

    // ATTRIBUTS 
    private $tauxRemplissage;
    private $nbEtudiants;
    private $lstEtudiant = array();

    // CONSTRUCTEURS

    /**
     * @brief Constructeur de CombJour avec passage des variables en paramètres
     */
    public function CombJour($tauxRemplissage, $nbEtudiants, $lstEtudiant) {
        $this->set_tauxRemplissage($tauxRemplissage);
        $this->set_nbEtudiants($nbEtudiants);
        $this->set_lstEtudiant($lstEtudiant);
    }

    /**
     * @brief Constructeur par recopie de CombJour
     */
    public function CombJour_copie(CombJour $uneCombJour) {
        $this->set_tauxRemplissage($uneCombJour->get_tauxRemplissage());
        $this->set_nbEtudiants($uneCombJour->get_nbEtudiants());
        $this->set_lstEtudiant($uneCombJour->get_lstEtudiant());
    }

    // METHODES

    /**
     * @brief Renvoie le tauxRemplissage de la CombJour
     */
    public function get_tauxRemplissage() {
        return $this->tauxRemplissage;
    }

    /**
     * @brief Modifie le tauxRemplissage de la CombJour par celui passé en paramètre
     */
    public function set_tauxRemplissage($tauxRemplissage) {
        $this->tauxRemplissage = $tauxRemplissage;
    }

    /**
     * @brief Renvoie le nbEtudiants de la CombJour
     */
    public function get_nbEtudiants() {
        return $this->nbEtudiants;
    }

    /**
     * @brief Modifie le nbEtudiants de la CombJour par celui passé en paramètre
     */
    public function set_nbEtudiants($nbEtudiants) {
        $this->nbEtudiants = $nbEtudiants;
    }

    /**
     * @brief Renvoie la lstEtudiant de la CombJour
     */
    public function get_lstEtudiant() {
        return $this->lstEtudiant;
    }

    /**
     * @brief Modifie la lstEtudiant de la CombJour par celui passé en paramètre
     */
    public function set_lstEtudiant($lstEtudiant) {
        $this->lstEtudiant = $lstEtudiant;
    }

    /**
     * @brief Vérifie si le nb minimum d'Etudiant est supérieur à celui donné en Critere de l'Offre passée en paramètre
     */
    public function verifNbMinEtud(Offre $uneOffre) {
        if ($this->get_nbEtudiants() < $uneOffre->mesCriteres->get_nbMinEtudJour()) {
            return false;
        }
        return true;
    }

    /**
     * @brief Vérifie si le nb minimum d'heures par Etudiant est supérieur à celui donné en Critere de l'Offre passée en paramètre
     */
    public function verifNbMinHeureEtud(Offre $uneOffre) {
        foreach ($this->get_lstEtudiant() as &$etudiant) {
            $cpt = 0;
            foreach ($this->get_lstEtudiant() as &$heure) {
                if ($heure == $etudiant) {
                    $cpt++;
                }
            }
            if ($cpt < $uneOffre->mesCriteres->get_nbMinEtudJour()) {
                return false;
            }
        }
        return true;
    }
}

?>