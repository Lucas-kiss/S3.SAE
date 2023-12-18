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
 * @brief Cette classe définit un Creneau à partir de son heureDeb et le tableau de ses disponibilités associé.
 * 
 * @details Au-delà de définir un Creneau, cette classe permet aussi de désigner l'Etudiant associé au Creneau.
 * 
 * L'Etudiant correspondant au Creneau est défini par un pointeur.
 * 
 * @warning Un Creneau a 1 seul Etudiant associé.
 */

class CreneauRecherche
{

    // ATTRIBUTS

    private int $heureDeb;
    private int $heureFin;

    // CONSTRUCTEURS

    /**
     * @brief Constructeur de Creneau avec passage des variables en paramètres
     */
    public function CreneauRecherche($uneHeureDeb, $uneheureFin)
    {
        $this->heureDeb = $uneHeureDeb;
        $this->heureFin = $uneheureFin;
    }

    /**
     * @brief Constructeur par recopie de Creneau
     */
    public function CreneauRecherche_copie(CreneauRecherche $unCreneau)
    {
        $this->heureDeb = $unCreneau->heureDeb;
        $this->heureFin = $unCreneau->heureFin;
    }

    // METHODES

    /**
     * @brief Renvoie le heureDeb du Creneau
     */
    public function get_heureDeb()
    {
        return $this->heureDeb;
    }

    /**
     * @brief Modifie le heureDeb du Creneau par celui passé en paramètre
     */
    public function set_heureDeb($uneHeureDeb)
    {
        return $this->heureDeb = $uneHeureDeb;
    }

    /**
     * @brief Renvoie le tableau de disponibilités du Creneau
     */
    public function get_heureFin()
    {
        return $this->heureFin;
    }

    /**
     * @brief Modifie le tableau de disponibilités par celui passé en paramètre
     */
    public function set_heureFin($unheureFin)
    {
        return $this->heureFin = $unheureFin;
    }

}

?>