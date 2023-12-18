<?php

class Offre
{
    /* ATTRIBUTS */
    private $num;
    private $intitule;
    private $desJours;
    private $desEtudiants;
    private $mesCriteres;
    /* CONSTRUCTEUR */
    public function Offre1($num, $intitule)
    {
        $this->num = $num;
        $this->intitule = $intitule;
    }
    public function Offre1_copie(Offre1 $uneOffre1)
    {
        $this->num = $uneOffre1->num;
        $this->intitule = $uneOffre1->intitule;
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
    //Associer des criteres a l'offre
    public function set_mesCriteres(&$desCriteres)
    {
        $this->mesCriteres = $desCriteres;
    }
    public function get_mesCriteres()
    {
        return $this->mesCriteres;
    }

    // public function delierCriteres(Critere &$desCriteres)
    // {
    //     if ($this->mesCriteres != null) {
    //         unset($this->mesCriteres);
    //         unset($desCriteres->get_monOffre());
    //     }

    // }

    // public function lierCriteres(Critere &$desCriteres)
    // {
    //     if ($this->get_mesCriteres() == null && $desCriteres->get_monOffre() == null) {
    //         $this->set_mesCriteres($desCriteres);
    //         $desCriteres->get_monOffre() = &$this;
    //     } else {
    //         Offre::delierCriteres($desCriteres);
    //     }
    // }



}

?>