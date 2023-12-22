<?php
/**
 * @file CombSemaine.php
 * @author fconstans
 * @brief Création de la classe CombSemaine
 * @version 1
 * @date 2023-12-19
 * 
 */

/**
 * @brief Cette classe définit les CombSemaine pour une Offre 
 * 
 * @details CombSemaine est une classe qui est composée d'un tableau de combJour mesComposants (une combinaison possible de la semaine), du nbEtudiants de la combinaison et du tauxRemplissage (100 % si répond à tous les hoaires recherchés dans l'offre)
 */

require_once 'classes_sae/CombJour.php';
require_once 'classes_sae/Offre.php';

class CombSemaine
{

    // ATTRIBUTS 
    private $tauxRemplissage;
    private $nbEtudiants;
    private $mesComposants = array();

    // CONSTRUCTEURS

    /**
     * @brief Constructeur de CombSemaine avec passage des variables en paramètres
     */
    public function CombSemaine($tauxRemplissage, $nbEtudiants, $comp)
    {
        $this->set_tauxRemplissage($tauxRemplissage);
        $this->set_nbEtudiants($nbEtudiants);
        $this->set_mesComposants($comp);
    }

    // METHODES

    /**
     * @brief Renvoie le tauxRemplissage de la CombSemaine
     */
    public function get_tauxRemplissage()
    {
        return $this->tauxRemplissage;
    }

    /**
     * @brief Modifie le tauxRemplissage de la CombSemaine par celui passé en paramètre
     */
    public function set_tauxRemplissage($tauxRemplissage)
    {
        $this->tauxRemplissage = $tauxRemplissage;
    }

    /**
     * @brief Renvoie le nbEtudiants de le CombSemaine
     */
    public function get_nbEtudiants()
    {
        return $this->nbEtudiants;
    }

    /**
     * @brief Modifie le nbEtudiants de la CombSemaine par celui passé en paramètre
     */
    public function set_nbEtudiants($nbEtudiants)
    {
        $this->nbEtudiants = $nbEtudiants;
    }

    /**
     * @brief Renvoie mesComposants de la CombSemaine
     */
    public function get_mesComposants()
    {
        return $this->mesComposants;
    }

    /**
     * @brief Modifie mesComposants de la CombSemaine par celui passé en paramètre
     */
    public function set_mesComposants($desComposants)
    {
        $this->mesComposants = $desComposants;
    }

    /**
     * @brief Ajoute le composant passé en paramètre à une CombSemaine
     */
    public function ajouterComposant(CombJour $unComposant)
    {
        $this->mesComposants[] = $unComposant;
    }

    /**
     * @brief Retire le composant passé en paramètre à une CombSemaine
     */
    public function retirerComposant(CombJour $unComposant)
    {
        if ($this->existeComposant($unComposant)) {
            foreach ($this->mesComposants as $comp) {
                if ($comp == $unComposant)
                    unset($this->mesComposants[$comp]);
            }
        }
    }

    /**
     * @brief Vérifie si le composant passé en paramètre existe dans une CombSemaine
     */
    public function existeComposant(CombJour $unComposant)
    {
        foreach ($this->mesComposants as $comp) {
            if ($comp . isset($unComposant)) {
                return true;
            } else {
                return false;
            }
        }

    }

    /**
     * @brief Vérifie si le nb minimum d'Etudiant est supérieur à celui donné en Critere de l'Offre passée en paramètre
     */
    public function verifNbMinEtud(Offre $uneOffre)
    {
        return ($this->get_nbEtudiants() >= $uneOffre->get_mesCriteres()->get_nbMinEtudTotal());
    }

}

?>