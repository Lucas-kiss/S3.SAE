<?php
/**
 * @file Offre.php
 * @author Fanny CONSTANS
 * @brief Création de la classe Offre
 * @version 1
 * @date 2023-12-18
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
    public function Offre($num,$intitule,$desJours,$candidats,$mesCriteres) {
        $this->num = $num;
        $this->intitule = $intitule;
        $this->desJours = $desJours;
        $this->candidats = $candidats;
        $this->mesCriteres = $mesCriteres;
    }
    public function Offre_copie(Offre $uneOffre)
    {
        $this->num = $uneOffre->num;
        $this->intitule = $uneOffre->intitule;
        $this->desJours = $uneOffre->desJours;
        $this->candidats = $uneOffre->candidats;
        $this->mesCriteres = $uneOffre->mesCriteres;
    }

    /* METHODES */
    // set&get num
    public function set_num(int $num)
    {
        $this->num = $num;
    }
    public function get_num()
    {
        return $this->num;
    }

    // set&get intitule
    public function set_intitule(string $intitule)
    {
        $this->intitule = $intitule;
    }
    public function get_intitule()
    {
        return $this->intitule;
    }

    // Associer des jours à l'offre
    public function set_desJours(&$desJours)
    {
        $this->desJours = &$desJours;
    }

    public function get_desJours()
    {
        return $this->desJours;
    }

    // Associer des étudiants à l'offre
    public function set_candidats(&$candidats)
    {
        $this->candidats = &$candidats;
    }

    public function get_candidats()
    {
        return $this->candidats;
    }

    public function set_mesCriteres(&$desCriteres)
    {
        $this->mesCriteres = $desCriteres;
    }

    public function get_mesCriteres()
    {
        return $this->mesCriteres;
    }

    public function delierCriteres(Critere &$desCriteres)
    {
        if ($this->mesCriteres != null) {
            $this->mesCriteres = null;
            $desCriteres->set_monOffre(null);
        }
    }

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