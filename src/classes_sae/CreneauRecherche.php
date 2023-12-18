<?php
/**
 * @file CreneauRecherche.php
 * @author fconstans
 * @brief Création de la classe CreneauRecherche
 * @version 0.1
 * @date 2023-11-13
 * 
 */

 /**
 * @brief Cette classe définit un Creneau à partir de son jour et le tableau de ses disponibilités associé.
 * 
 * @details Au-delà de définir un Creneau, cette classe permet aussi de désigner l'Etudiant associé au Creneau.
 * 
 * L'Etudiant correspondant au Creneau est défini par un pointeur.
 * 
 * @warning Un Creneau a 1 seul Etudiant associé.
 */

class CreneauRecherche {

    // ATTRIBUTS

    private $jour;
    private $tabDispo;

    // CONSTRUCTEURS

    /**
     * @brief Constructeur de Creneau avec passage des variables en paramètres
     */
    public function CreneauRecherche($unJour, $uneTabDispo) {
        $this->jour = $unJour;
        $this->tabDispo = $uneTabDispo;
    }

    /**
     * @brief Constructeur par recopie de Creneau
     */
    public function CreneauRecherche_copie(CreneauRecherche $unCreneau) {
        $this->jour = $unCreneau->jour;
        $this->tabDispo = $unCreneau->tabDispo;
    }

    /**
     * @brief Constructeur par défaut de Creneau
     */
    public function CreneauRecherche_default($unJour) {
        $this->jour = $unJour;
        $this->tabDispo = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    }

    // METHODES

    /**
     * @brief Renvoie le jour du Creneau
     */
    public function get_jour() {
        return $this->jour;
    }

    /**
     * @brief Modifie le jour du Creneau par celui passé en paramètre
     */
    public function set_jour($unJour) {
        return $this->jour = $unJour;
    }

    /**
     * @brief Renvoie le tableau de disponibilités du Creneau
     */
    public function get_tabDispo() {
        return $this->tabDispo;
    }

    /**
     * @brief Modifie le tableau de disponibilités par celui passé en paramètre
     */
    public function set_tabDispo($unTabDispo) {
        return $this->jour = $unTabDispo;
    }

}

?>