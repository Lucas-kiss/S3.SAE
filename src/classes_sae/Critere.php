<?php
include_once 'Offre.php';
class Critere
{
    /* ATTRIBUTS */
    private int $nbMinHeureEtudJour;
    private bool $HeureRepartieJour;
    private int $nbMinEtudJour;
    private int $nbMinEtudTotal;
    private Offre $monOffre;

    /* CONSTRUCTEUR */
    function Critere(int $nbMinHeureEtudJour, bool $HeureRepartieJour, int $nbMinEtudJour = 1, int $nbMinEtudTotal = 1)
    {
        $this->nbMinHeureEtudJour = $nbMinHeureEtudJour;
        $this->HeureRepartieJour = $HeureRepartieJour;
        $this->nbMinEtudJour = $nbMinEtudJour;
        $this->nbMinEtudTotal = $nbMinEtudTotal;
    }
    /* METHODES */
    // set&get nbMinHeureEtudJour
    public function set_nbMinHeureEtudJour(int $nbMinHeureEtudJour)
    {
        $this->nbMinHeureEtudJour = $nbMinHeureEtudJour;
    }
    public function get_nbMinHeureEtudJour()
    {
        return $this->nbMinHeureEtudJour;
    }

    // set&get HeureRepartieJour
    public function set_HeureRepartieJour(bool $HeureRepartieJour)
    {
        $this->HeureRepartieJour = $HeureRepartieJour;
    }
    public function get_HeureRepartieJour()
    {
        return $this->HeureRepartieJour;
    }

    // set&get nbMinEtudJour
    public function set_nbMinEtudJour(int $nbMinEtudJour)
    {
        $this->nbMinEtudJour = $nbMinEtudJour;
    }
    public function get_nbMinEtudJour()
    {
        return $this->nbMinEtudJour;
    }

    // set&get nbMinEtudTotal
    public function set_nbMinEtudTotal(int $nbMinEtudTotal)
    {
        $this->nbMinEtudTotal = $nbMinEtudTotal;
    }
    public function get_nbMinEtudTotal()
    {
        return $this->nbMinEtudTotal;
    }

    // set&get monOffre
    public function set_monOffre(Offre &$uneOffre)
    {
        $this->monOffre = $uneOffre;
    }
    public function get_monOffre()
    {
        return $this->monOffre;
    }

    public function delierOffre(Offre &$uneOffre)
    {
        if ($this->monOffre != null) {
            $this->monOffre = null;
            $uneOffre->set_mesCriteres(null);
        }
    }

    public function lierOffre(Offre &$uneOffre)
{
    if ($this->get_monOffre() == null && $uneOffre->get_mesCriteres() == null) {
        $this->set_monOffre($uneOffre);
        $uneOffre->set_mesCriteres($this);
    } else {
        $this->delierOffre($uneOffre);
    }
}




}


?>