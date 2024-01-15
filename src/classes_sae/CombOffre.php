<?php
/**
 * @file CombOffre.php
 * @author fconstans
 * @brief Création de la classe CombOffre
 * @version 1
 * @date 2023-12-19
 * 
 */

 /**
 * @brief Cette classe définit les CombOffre pour une Offre
 * 
 * @details CombOffre est une classe qui est composée d'un tableau de combSemaine mesComposants (toutes les combinaisons possibles pour la semaine) et du nbCombinaisons de la combinaison
 */
require_once 'classes_sae/CombSemaine.php';
class CombOffre {

    // ATTRIBUTS 

    private $nbCombinaisons;
    private $mesComposants = array();

    // CONSTRUCTEURS

    /**
     * @brief Constructeur de CombOffre avec passage des variables en paramètres
     */
    public function CombOffre($nbComb, $comp) {
        $this->set_nbCombinaisons = $nbComb;
        $this->set_mesComposants = $comp;
    }

    public function CombOffre_copie(CombOffre $uneCombOffre) {
        $this->set_nbCombinaisons = $uneCombOffre->nbCombinaisons;
        $this->set_mesComposants = $uneCombOffre->mesComposants;
    }

    // DESTRUCTEUR
    public function __destruct() {}

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
        $this->mesComposants[]=$unComposant;
    }

    /**
     * @brief Retire le composant passé en paramètre à une CombOffre
     */
    public function retirerComposant(CombSemaine $unComposant) {
        if ($this->existeComposant($unComposant)) {
            foreach ($this->mesComposants as $comp) {
                if ($comp == $unComposant)
                unset($this->mesComposants[$comp]);
            }
        }
    }

    /**
     * @brief Vérifie si le composant passé en paramètre existe dans une CombOffre
     */
    public function existeComposant(CombSemaine $unComposant) {
        foreach ($this->mesComposants as $comp) {
            if ($comp.isset($unComposant)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function echangerComposant(CombSemaine $comp1, CombSemaine $comp2)
    {
        $temp = $comp1;
        $comp1 = $comp2;
        $comp2 = $temp;
    }
}

?>