<?php
/**
 * @file Offre.php
 * @author Raphaël Audouard
 * @brief Création de la classe Offre
 * @version 0.1
 * @date 2023-11-14
 * 
 */
class Offre
{
    /* ATTRIBUTS */
    private int $num;
    private string $intitule;
    public $desJours;
    public $desEtudiants;

    /* CONSTRUCTEUR */
    function Offre(int $num,
        string $intitule)
    {
        $this->num = $num;
        $this->intitule = $intitule;
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
    public function set_desEtudiants(&$desEtudiants)
    {
        $this->desEtudiants = &$desEtudiants;
    }

    public function get_desEtudiants()
    {
        return $this->desEtudiants;
    }
}

?>