<?php
/**
 * @file CombComposee.php
 * @author fconstans
 * @brief Création de la classe CombComposee
 * @version 0.1
 * @date 2023-11-14
 * 
 */

 /**
 * @brief Cette classe définit les CombComposee pour une Offre 
 * 
 * @details Elle spécialise la classe Combinaison
 */

class CombComposee extends Combinaison {

    // ATTRIBUTS 
    private $tauxRemplissage;
    private $nbEtudiants;
    private $mesComposants = array();

    // CONSTRUCTEURS

    /**
     * @brief Constructeur de CombComposee avec passage des variables en paramètres
     */
    public function CombComposee($tauxRemplissage, $nbEtudiants) {
        $this->set_tauxRemplissage($tauxRemplissage);
        $this->set_nbEtudiants($nbEtudiants);
    }

    /**
     * @brief Constructeur par recopie de CombComposee
     */
    public function CombComposee_copie(CombComposee $uneCombComposee) {
        $this->set_tauxRemplissage($uneCombComposee->get_tauxRemplissage());
        $this->set_nbEtudiants($uneCombComposee->get_nbEtudiants());
    }

    // METHODES

    /**
     * @brief Renvoie le tauxRemplissage de la CombComposee
     */
    public function get_tauxRemplissage() {
        return $this->tauxRemplissage;
    }

    /**
     * @brief Modifie le tauxRemplissage de la CombComposee par celui passé en paramètre
     */
    public function set_tauxRemplissage($tauxRemplissage) {
        $this->tauxRemplissage = $tauxRemplissage;
    }

    /**
     * @brief Renvoie le nbEtudiants de le CombComposee
     */
    public function get_nbEtudiants() {
        return $this->nbEtudiants;
    }

    /**
     * @brief Modifie le nbEtudiants de la CombComposee par celui passé en paramètre
     */
    public function set_nbEtudiants($nbEtudiants) {
        $this->nbEtudiants = $nbEtudiants;
    }

    /**
     * @brief Renvoie mesComposants de la CombComposee
     */
    public function get_mesComposants() {
        return $this->mesComposants;
    }

    /**
     * @brief Modifie mesComposants de la CombComposee par celui passé en paramètre
     */
    public function set_mesComposants($desComposants) {
        $this->mesComposants = $desComposants;
    }

    /**
     * @brief Ajoute le composant passé en paramètre à une CombComposee
     */
    public function ajouterComposant(Combinaison $unComposant) {
        $this->mesComposants.add($unComposant);
    }

    /**
     * @brief Retire le composant passé en paramètre à une CombComposee
     */
    public function retirerComposant(Combinaison $unComposant) {
        if ($this->existeComposant($unComposant)) {
            unset($this->mesComposants[$unComposant]);
        }
    }

    /**
     * @brief Vérifie si le composant passé en paramètre existe dans une CombComposee
     */
    public function existeComposant(Combinaison $unComposant) {
        return isset(this->mesComposants[$unComposant]);
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