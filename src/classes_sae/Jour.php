<?php
include './CreneauRecherche.php';
/**
 * @file Jour.php
 * @author fconstans
 * @brief Création de la classe Jour
 * @version 1
 * @date 2023-12-19
 * 
 */

/**
 * @brief Cette classe définit un Jour à partir de son jour et le tableau de ses créneaux associés.
 * 
 * @details
 *  
 * @warning
 */


class Jour
{

    // ATTRIBUTS

    private $jour;
    private $creneaux = array();

    // CONSTRUCTEURS

    /**
     * @brief Constructeur de Jour avec passage des variables en paramètres
     */
    public function Jour($unJour, $desCreneaux)
    {
        $this->jour = $unJour;
        $this->creneaux = $desCreneaux;
    }

    /**
     * @brief Constructeur par recopie de Jour
     */
    public function Jour_copie(Jour $unJour)
    {
        $this->jour = $unJour->jour;
        $this->creneaux = $unJour->creneaux;
    }

    // METHODES

    /**
     * @brief Renvoie le jour du Jour
     */
    public function get_jour()
    {
        return $this->jour;
    }

    /**
     * @brief Modifie le jour du Jour par celui passé en paramètre
     */
    public function set_jour($unJour)
    {
        return $this->jour = $unJour;
    }

    /**
     * @brief Renvoie les creneaux du Jour
     */
    public function get_creneaux()
    {
        return $this->creneaux;
    }

    /**
     * @brief Modifie les creneaux par celui passé en paramètre
     */
    public function set_creneaux($desCreneaux)
    {
        return $this->creneaux = $desCreneaux;
    }

    /**
     * @brief Ajoute le creneau passé en paramètre dans le tableau des créneaux
     */
    public function ajouterCreneau(CreneauRecherche &$unCreneau)
    {
        $this->creneaux[] = $unCreneau;
    }

    /**
     * @brief Supprime le creneau passé en paramètre dans le tableau des créneaux
     */
    public function supprimerCreneau(CreneauRecherche &$unCreneau)
    {
        foreach ($this->creneaux as $cren) {
            if ($cren == $unCreneau) {
                unset($this->creneaux[$cren]);
            }
        }
    }


    /**
     * @brief Vérifie so le creneau passé en paramètre existe dans le tableau des créneaux
     */
    public function existeCreneau(CreneauRecherche &$unCreneau)
    {
        foreach ($this->creneaux as $cren) {
            if ($cren = $unCreneau) {
                return true;
            }
        }
    }
}

?>