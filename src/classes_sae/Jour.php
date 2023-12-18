<?php
include './CreneauRecherche.php';
/**
 * @file Jour.php
 * @author fconstans
 * @brief Création de la classe Jour
 * @version 0.1
 * @date 2023-11-13
 * 
 */

/**
 * @brief Cette classe définit un Jour à partir de son jour et le tableau de ses disponibilités associé.
 * 
 * @details Au-delà de définir un Jour, cette classe permet aussi de désigner l'Etudiant associé au Jour.
 * 
 * L'Etudiant correspondant au Jour est défini par un pointeur.
 * 
 * @warning Un Jour a 1 seul Etudiant associé.
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
     * @brief Renvoie le tableau de disponibilités du Jour
     */
    public function get_creneaux()
    {
        return $this->creneaux;
    }

    /**
     * @brief Modifie le tableau de disponibilités par celui passé en paramètre
     */
    public function set_creneaux($desCreneaux)
    {
        return $this->creneaux = $desCreneaux;
    }

    public function ajouterCreneau(CreneauRecherche &$unCreneau)
    {
        $this->creneaux[] = $unCreneau;


    }

    public function supprimerCreneau(CreneauRecherche &$unCreneau)
    {
        foreach ($this->creneaux as $cren) {
            if ($cren == $unCreneau) {
                unset($this->creneaux[$cren]);
            }
        }
    }

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