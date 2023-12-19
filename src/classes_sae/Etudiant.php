<?php
/**
 * @file Etudiant.php
 * @author fconstans
 * @brief Création de la classe Etudiant
 * @version 1
 * @date 2023-12-19
 * 
 */

 /**
 * @brief Cette classe définit un Etudiant à partir de son ine, nom, prénom, et son planning.
 * 
 * @details
 * 
 */

class Etudiant {

    // ATTRIBUTS 

    private $ine;
    private $nom;
    private $prenom;
    private $planning = array();

    // CONSTRUCTEURS

    /**
     * @brief Constructeur d'Etudiant avec passage des variables en paramètres
     */
    public function Etudiant($unIne, $unNom, $unPrenom, $unPlanning) {
        $this->set_ine($unIne);
        $this->set_nom($unNom);
        $this->set_prenom($unPrenom);
        $this->set_planning($unPlanning);
    }

    /**
     * @brief Constructeur par recopie d'Etudiant
     */
    public function Etudiant_copie(Etudiant $unEtudiant) {
        $this->set_ine($unEtudiant->get_ine());
        $this->set_nom($unEtudiant->get_nom());
        $this->set_prenom($unEtudiant->get_prenom());
        $this->set_planning($unEtudiant->get_planning());
    }

    // METHODES

    /**
     * @brief Renvoie l'INE de l'Etudiant
     */
    public function get_ine() {
        return $this->ine;
    }

    /**
     * @brief Modifie l'INE de l'Etudiant par celui passé en paramètre
     */
    public function set_ine($unIne) {
        $this->ine = $unIne;
    }

    /**
     * @brief Renvoie le nom de l'Etudiant
     */
    public function get_nom() {
        return $this->nom;
    }

    /**
     * @brief Modifie le nom de l'Etudiant par celui passé en paramètre
     */
    public function set_nom($unNom) {
        $this->nom = $unNom;
    }

    /**
     * @brief Renvoie le prénom de l'Etudiant
     */
    public function get_prenom() {
        return $this->prenom;
    }

    /**
     * @brief Modifie le prénom de l'Etudiant par celui passé en paramètre
     */
    public function set_prenom($unPrenom) {
        $this->prenom = $unPrenom;
    }

    
    /**
     * @brief Renvoie le planning de l'Etudiant
     */
    public function get_planning() {
        return $this->planning;
    }

    /**
     * @brief Cree le planning de l'Etudiant
     */
    public function set_planning($unPlanning) {
        $this->planning = $unPlanning;
    }

    /**
     * @brief Ajoute un Creneau dans le planning de l'Etudiant
     */
    public function ajouter_creneau(&$unCreneau) {
        $this->planning[]=$unCreneau;
    }

    /**
     * @brief Supprime un Creneau dans le planning de l'Etudiant
     */
    public function supprimer_creneau(&$unCreneau) {
        if (isset($this->planning[$unCreneau])) {
            unset($this->planning[$unCreneau]);
        }
        
    }

    /**
     * @brief Modifie un Creneau dans le planning de l'Etudiant
     */
    public function modifier_creneau($jourCreneau, &$nveauCreneau) {
        for ($i=0; $i < count($this->planning); $i++)
        {
            if ($this->planning[$i]->jour == $jourCreneau) {
                $this->planning[$i] = $nveauCreneau;
            }
        }
    }
}

?>