<?php
/**
 * @file CombSimple.php
 * @author fconstans
 * @brief Création de la classe CombSimple
 * @version 0.1
 * @date 2023-11-14
 * 
 */

 /**
 * @brief Cette classe définit les CombSimple pour une Offre 
 * 
 * @details Elle spécialise la classe Combinaison
 */

class CombSimple extends Combinaison {

    // ATTRIBUTS 
    private $tauxRemplissage;
    private $nbEtudiants;
    private $lstEtudiant = array();

    // CONSTRUCTEURS

    /**
     * @brief Constructeur de CombSimple avec passage des variables en paramètres
     */
    public function CombSimple($tauxRemplissage, $nbEtudiants, $lstEtudiant) {
        $this->set_tauxRemplissage($tauxRemplissage);
        $this->set_nbEtudiants($nbEtudiants);
        $this->set_lstEtudiant($lstEtudiant);
    }

    /**
     * @brief Constructeur par recopie de CombSimple
     */
    public function CombSimple_copie(CombSimple $uneCombSimple) {
        $this->set_tauxRemplissage($unEtudiant->get_tauxRemplissage());
        $this->set_nbEtudiants($unEtudiant->get_nbEtudiants());
        $this->set_lstEtudiant($unEtudiant->get_lstEtudiant());
    }

    // METHODES

    /**
     * @brief Renvoie le tauxRemplissage de la CombSimple
     */
    public function get_tauxRemplissage() {
        return $this->tauxRemplissage;
    }

    /**
     * @brief Modifie le tauxRemplissage de la CombSimple par celui passé en paramètre
     */
    public function set_tauxRemplissage($tauxRemplissage) {
        $this->tauxRemplissage = $tauxRemplissage;
    }

    /**
     * @brief Renvoie le nbEtudiants de la CombSimple
     */
    public function get_nbEtudiants() {
        return $this->nbEtudiants;
    }

    /**
     * @brief Modifie le nbEtudiants de la CombSimple par celui passé en paramètre
     */
    public function set_nbEtudiants($nbEtudiants) {
        $this->nbEtudiants = $nbEtudiants;
    }

    /**
     * @brief Renvoie la lstEtudiant de la CombSimple
     */
    public function get_lstEtudiant() {
        return $this->lstEtudiant;
    }

    /**
     * @brief Modifie la lstEtudiant de la CombSimple par celui passé en paramètre
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