<?php
/**
 * @file CombOffre.php
 * @author fconstans
 * @brief Création de la classe CombOffre
 * @version 0.1
 * @date 2023-11-15
 * 
 */

 /**
 * @brief Cette classe définit les CombOffre pour une Offre
 * 
 * @details
 */

class CombOffre {

    // ATTRIBUTS 

    private $nbCombinaisons;
    private $mesComposants = array();

    // CONSTRUCTEURS

    private function CombOffre($nbComb) {
        $this->set_nbCombinaisons = $nbComb;
    }

    private function CombOffre_copie(CombOffre $uneCombOffre) {
        $this->set_nbCombinaisons = $uneCombOffre->nbCombinaisons;
    }

    // METHODES

    /**
     * @brief Renvoie le nbCombinaisons de la CombOffre
     */
    public function get_nbCombinaisons() {
        return $this->nbCombinaisons;
    }

    /**
     * @brief Modifie le nbCombinaisons de la CombOffre par celui passé en paramètre
     */
    public function set_nbCombinaisons($nbCombs) {
        $this->nbCombinaisons = $nbCombs;
    }

    /**
     * @brief Renvoie mesComposants de la CombOffre
     */
    public function get_mesComposants() {
        return $this->mesComposants;
    }

    /**
     * @brief Modifie mesComposants de la CombOffre par celui passé en paramètre
     */
    public function set_mesComposants($desComposants) {
        $this->mesComposants = $desComposants;
    }

    /**
     * @brief Ajoute le composant passé en paramètre à une CombOffre
     */
    public function ajouterComposant(CombSemaine $unComposant) {
        $this->mesComposants.add($unComposant);
    }

    /**
     * @brief Retire le composant passé en paramètre à une CombOffre
     */
    public function retirerComposant(CombSemaine $unComposant) {
        if ($this->existeComposant($unComposant)) {
            unset($this->mesComposants[$unComposant]);
        }
    }

    /**
     * @brief Vérifie si le composant passé en paramètre existe dans une CombOffre
     */
    public function existeComposant(CombSemaine $unComposant) {
        return isset(this->mesComposants[$unComposant]);
    }
}

?>