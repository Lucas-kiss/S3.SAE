<?php
/**
 * @file Offre.php
 * @author fconstans
 * @brief Création de la classe Offre
 * @version 1
 * @date 2023-12-19
 * 
 */
include_once 'Critere.php';

class Offre
{
    /* ATTRIBUTS */
    private $num;
    private $intitule;
    private $desJours;
    private $candidats;
    private $mesCriteres;
    private $planning = array(); // ensemble des créneaux où l'étudiant est disponible : array de boolean (1 = dispo, 0 = pas dispo)

    /* CONSTRUCTEUR */

    /**
     * @brief Constructeur d'Offre avec passage des variables en paramètres
     */
    public function Offre($num,$intitule,$desJours,$candidats,$mesCriteres) {
        $this->num = $num;
        $this->intitule = $intitule;
        $this->desJours = $desJours;
        $this->candidats = $candidats;
        $this->mesCriteres = $mesCriteres;
    }

    /**
     * @brief Constructeur par recopie de l'Offre
     */
    public function Offre_copie(Offre $uneOffre)
    {
        $this->num = $uneOffre->num;
        $this->intitule = $uneOffre->intitule;
        $this->desJours = $uneOffre->desJours;
        $this->candidats = $uneOffre->candidats;
        $this->mesCriteres = $uneOffre->mesCriteres;
    }

    /* METHODES */
    
    /**
     * @brief Modifie le num de l'Offre par celui passé en paramètre
     */
    public function set_num(int $num)
    {
        $this->num = $num;
    }

    /**
     * @brief Renvoie le num de l'Offre
     */
    public function get_num()
    {
        return $this->num;
    }

    /**
     * @brief Modifie l'intitulé de l'Offre par celui passé en paramètre
     */
    public function set_intitule(string $intitule)
    {
        $this->intitule = $intitule;
    }

    /**
     * @brief Renvoie l'intitulé de l'Offre
     */
    public function get_intitule()
    {
        return $this->intitule;
    }

    /**
     * @brief Modifie les jours de l'Offre par celui passé en paramètre
     */
    public function set_desJours(&$desJours)
    {
        $this->desJours = &$desJours;
    }

    /**
     * @brief Renvoie les jours de l'Offre
     */
    public function get_desJours()
    {
        return $this->desJours;
    }

    /**
     * @brief Modifie les étudiants candidats à l'Offre par ceux passés en paramètre
     */
    public function set_candidats(&$candidats)
    {
        $this->candidats = &$candidats;
    }

    /**
     * @brief Renvoie les étudiants candidats à l'Offre
     */
    public function get_candidats()
    {
        return $this->candidats;
    }

    /**
     * @brief Modifie les critères de l'Offre par ceux passés en paramètre
     */
    public function set_mesCriteres(&$desCriteres)
    {
        $this->mesCriteres = $desCriteres;
    }

    /**
     * @brief Renvoie les critères de l'Offre
     */
    public function get_mesCriteres()
    {
        return $this->mesCriteres;
    }

    /**
     * @brief Délie les critères de l'Offre
     */
    public function delierCriteres(Critere &$desCriteres)
    {
        if ($this->mesCriteres != null) {
            $this->mesCriteres = null;
            $desCriteres->set_monOffre(null);
        }
    }

    /**
     * @brief Lie les critères à l'Offre
     */
    public function lierCriteres(Critere &$desCriteres)
    {
        if ($this->get_mesCriteres() == null && $desCriteres->get_monOffre() == null) {
            $this->set_mesCriteres($desCriteres);
            $desCriteres->set_monOffre($this);
        } else {
            $this->delierCriteres($desCriteres);
        }
    }


    /**
     * @brief Ajoute un jour dans le planning de l'Etudiant
     */
    public function ajouter_jour(Jour &$unJour)
    {
        $this->planning[] = $unJour;
    }

    /**
     * @brief Supprime un jour dans le planning de l'Etudiant
     */
    public function supprimer_jour(Jour &$unJour)
    {
        if (isset($this->planning[$unJour->get_jour()])) {
            unset($this->planning[$unJour->get_jour()]);
        }

    }
}

?>