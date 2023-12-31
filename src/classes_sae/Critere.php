<?php
/**
 * @file Critere.php
 * @author fconstans
 * @brief Création de la classe Critere
 * @version 1
 * @date 2023-12-19
 * 
 */

/**
 * @brief Cette classe définit les Critere associés à l'Offre.
 * 
 * @details Cette classe comprend le nbMinHeureEtudJour (nb min d'heures recherché par étudiant par jour), si heureRepartieJour ou non, le nbLinEtudJour (nb min d'étudiant recherché par jour), le nbMinEtudTotal (nb min d'étudiant recherché sur toute la semaine) et l'Offre associée.
 * 
 */

require_once 'classes_sae/Offre.php';

class Critere
{
    /* ATTRIBUTS */
    private int $nbMinHeureEtudJour;
    private int $nbMinEtudJour;
    private int $nbMinEtudTotal;
    private Offre $monOffre;

    /* CONSTRUCTEUR */

    /**
     * @brief Constructeur de Critere avec passage des variables en paramètres
     */
    function Critere(int $nbMinHeureEtudJour, int $nbMinEtudJour = 1, int $nbMinEtudTotal = 1, Offre $offre)
    {
        $this->nbMinHeureEtudJour = $nbMinHeureEtudJour;
        $this->nbMinEtudJour = $nbMinEtudJour;
        $this->nbMinEtudTotal = $nbMinEtudTotal;
        $this->monOffre = $offre;
    }

    /* METHODES */

    /**
     * @brief Modifie le nbMinHeureEtudJour du Critere par celui passé en paramètre
     */
    public function set_nbMinHeureEtudJour(int $nbMinHeureEtudJour)
    {
        $this->nbMinHeureEtudJour = $nbMinHeureEtudJour;
    }

    /**
     * @brief Renvoie le nbMinHeureEtudJour du Critere
     */
    public function get_nbMinHeureEtudJour()
    {
        return $this->nbMinHeureEtudJour;
    }


    /**
     * @brief Modifie le nbMinEtudJour du Critere par celui passé en paramètre
     */
    public function set_nbMinEtudJour(int $nbMinEtudJour)
    {
        $this->nbMinEtudJour = $nbMinEtudJour;
    }

    /**
     * @brief Renvoie le nbMinEtudJour du Critere
     */
    public function get_nbMinEtudJour()
    {
        return $this->nbMinEtudJour;
    }

    /**
     * @brief Modifie le nbMinEtudTotal du Critere par celui passé en paramètre
     */
    public function set_nbMinEtudTotal(int $nbMinEtudTotal)
    {
        $this->nbMinEtudTotal = $nbMinEtudTotal;
    }

    /**
     * @brief Renvoie le nbMinEtudTotal du Critere
     */
    public function get_nbMinEtudTotal()
    {
        return $this->nbMinEtudTotal;
    }

    /**
     * @brief Modifie le monOffre du Critere par celui passé en paramètre
     */
    public function set_monOffre(Offre &$uneOffre)
    {
        $this->monOffre = $uneOffre;
    }

    /**
     * @brief Renvoie le monOffre du Critere
     */
    public function get_monOffre()
    {
        return $this->monOffre;
    }

    /**
     * @brief Délie l'Offre des Critere
     */
    public function delierOffre(Offre &$uneOffre)
    {
        if ($this->monOffre != null) {
            $this->monOffre = null;
            $uneOffre->set_mesCriteres(null);
        }
    }

    /**
     * @brief Lie l'Offre aux Critere
     */
    public function lierOffre(Offre &$uneOffre)
    {
        if ($this->get_monOffre() == null ) {
            $this->set_monOffre($uneOffre);
            $uneOffre->set_mesCriteres($this);
        } 
    }




}


?>