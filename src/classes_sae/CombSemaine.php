<?php
/**
 * @file CombSemaine.php
 * @author fconstans
 * @brief Création de la classe CombSemaine
 * @version 0.1
 * @date 2023-11-15
 * 
 */

 /**
 * @brief Cette classe définit les CombSemaine pour une Offre 
 * 
 * @details
 */

include './CombJour.php';
include './ClasseOffre.php';

class CombSemaine {

    // ATTRIBUTS 
    private $tauxRemplissage;
    private $nbEtudiants;
    private $mesComposants = array();

    // CONSTRUCTEURS

    /**
     * @brief Constructeur de CombSemaine avec passage des variables en paramètres
     */
    public function CombSemaine($tauxRemplissage, $nbEtudiants) {
        $this->set_tauxRemplissage($tauxRemplissage);
        $this->set_nbEtudiants($nbEtudiants);
    }

    /**
     * @brief Constructeur par recopie de CombSemaine
     */
    public function CombSemaine_copie(CombSemaine $uneCombSemaine) {
        $this->set_tauxRemplissage($uneCombSemaine->get_tauxRemplissage());
        $this->set_nbEtudiants($uneCombSemaine->get_nbEtudiants());
    }

    // METHODES

    /**
     * @brief Renvoie le tauxRemplissage de la CombSemaine
     */
    public function get_tauxRemplissage() {
        return $this->tauxRemplissage;
    }

    /**
     * @brief Modifie le tauxRemplissage de la CombSemaine par celui passé en paramètre
     */
    public function set_tauxRemplissage($tauxRemplissage) {
        $this->tauxRemplissage = $tauxRemplissage;
    }

    /**
     * @brief Renvoie le nbEtudiants de le CombSemaine
     */
    public function get_nbEtudiants() {
        return $this->nbEtudiants;
    }

    /**
     * @brief Modifie le nbEtudiants de la CombSemaine par celui passé en paramètre
     */
    public function set_nbEtudiants($nbEtudiants) {
        $this->nbEtudiants = $nbEtudiants;
    }

    /**
     * @brief Renvoie mesComposants de la CombSemaine
     */
    public function get_mesComposants() {
        return $this->mesComposants;
    }

    /**
     * @brief Modifie mesComposants de la CombSemaine par celui passé en paramètre
     */
    public function set_mesComposants($desComposants) {
        $this->mesComposants = $desComposants;
    }

    /**
     * @brief Ajoute le composant passé en paramètre à une CombSemaine
     */
    public function ajouterComposant(CombJour $unComposant) {
        $this->mesComposants[]=$unComposant;
    }

    /**
     * @brief Retire le composant passé en paramètre à une CombSemaine
     */
    public function retirerComposant(CombJour $unComposant) {
        if ($this->existeComposant($unComposant)) {
            unset($this->mesComposants[$unComposant]);
        }
    }

    /**
     * @brief Vérifie si le composant passé en paramètre existe dans une CombSemaine
     */
    public function existeComposant(CombJour $unComposant) {
        return isset($this->mesComposants[$unComposant]);
    }

    /**
     * @brief Vérifie si le composant passé en paramètre existe dans une offre
     */
    public function verifNbMinHeureEtud(Offre $uneOffre) {
        return isset($uneOffre->mesComposants[$this]);
    }

    /**
     * @brief Vérifie si le nb minimum d'Etudiant est supérieur à celui donné en Critere de l'Offre passée en paramètre
     */
    public function verifNbMinEtud(Offre $uneOffre) {
        return ($this->get_nbEtudiants() > $uneOffre->mesCriteres->get_nbMinEtudJour());
    }

    /**
     * @brief Vérifie si le nb minimum d'heures par Etudiant est supérieur à celui donné en Critere de l'Offre passée en paramètre
     */
    public function verifNbMinHeureParEtud(Offre $uneOffre) {
        foreach ($this->get_lstEtudiant() as &$etudiant) {
            $nbHeur = array_count_values($this->get_lstEtudiant());

            if ($nbHeur < $uneOffre->mesCriteres->get_nbMinEtudJour()) {
                return false;
            }
        }
        return true;
    }
}

?>