<?php
/**
 * @file CreneauRecherche.php
 * @author fconstans
 * @brief Création de la classe CreneauRecherche
 * @version 1
 * @date 2023-12-19
 * 
 */

/**
 * @brief Cette classe définit un CreneauRecherche à partir de son heureDeb et de son heureFin.
 * 
 * @details
 * 
 */

class CreneauRecherche
{

    // ATTRIBUTS

    private int $heureDeb;
    private int $heureFin;

    // CONSTRUCTEURS

    /**
     * @brief Constructeur de CreneauRecherche avec passage des variables en paramètres
     */
    public function CreneauRecherche($uneHeureDeb, $uneheureFin)
    {
        $this->heureDeb = $uneHeureDeb;
        $this->heureFin = $uneheureFin;
    }

    /**
     * @brief Constructeur par recopie de CreneauRecherche
     */
    public function CreneauRecherche_copie(CreneauRecherche $unCreneau)
    {
        $this->heureDeb = $unCreneau->heureDeb;
        $this->heureFin = $unCreneau->heureFin;
    }

    // METHODES

    /**
     * @brief Renvoie le heureDeb du CreneauRecherche
     */
    public function get_heureDeb()
    {
        return $this->heureDeb;
    }

    /**
     * @brief Modifie le heureDeb du CreneauRecherche par celui passé en paramètre
     */
    public function set_heureDeb($uneHeureDeb)
    {
        return $this->heureDeb = $uneHeureDeb;
    }

    /**
     * @brief Renvoie le heureFin du CreneauRecherche
     */
    public function get_heureFin()
    {
        return $this->heureFin;
    }

    /**
     * @brief Modifie le heureFin du CreneauRecherche par celui passé en paramètre
     */
    public function set_heureFin($unheureFin)
    {
        return $this->heureFin = $unheureFin;
    }

}

?>