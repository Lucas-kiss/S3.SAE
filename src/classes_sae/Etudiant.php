<?php
/**
 * @file Etudiant.php
 * @author fconstans
 * @brief Création de la classe Etudiant
 * @version 0.1
 * @date 2023-11-13
 * 
 */

 /**
 * @brief Cette classe définit un Etudiant à partir de son ine, nom, prénom, date de naissance, code postal, ville, pays et numéro de téléphone.
 * 
 * @details Au-delà de définir un Etudiant, cette classe permet aussi de désigner les Creneaux associés à l'Etudiant.
 * 
 * Les Creneaux de l'Etudiants sont définis par des pointeurs planning vers des objets Creneau.
 * 
 * @warning Un Etudiant a au plus 7 Creneaux.
 */

class Etudiant {

    // ATTRIBUTS 

    private $ine; // ine de l'étudiant, type : string
    private $nom; // nom de l'étudiant, type : string
    private $prenom;    // prénom de l'étudiant, type : string
    private $dateNaiss; // date de naissance de l'étudiant, type : date
    private $cp;    // code postal de l'étudiant, type : int
    private $ville;   // ville de l'étudiant, type : string
    private $pays;  // pays de l'étudiant, type : string
    private $numTel;    // numéro de téléphone de l'étudiant, type : int
    private $planning = array(); // ensemble des créneaux où l'étudiant est disponible : array de boolean (1 = dispo, 0 = pas dispo)

    // CONSTRUCTEURS

    /**
     * @brief Constructeur d'Etudiant avec passage des variables en paramètres
     */
    public function Etudiant($unIne, $unNom, $unPrenom, $uneDateNaiss, $unCp, $uneVille, $unPays, $unNumTel) {
        $this->set_ine($unIne);
        $this->set_nom($unNom);
        $this->set_prenom($unPrenom);
        $this->set_dateNaiss($uneDateNaiss);
        $this->set_cp($unCp);
        $this->set_ville($uneVille);
        $this->set_pays($unPays);
        $this->set_numTel($unNumTel);
    }

    /**
     * @brief Constructeur par recopie d'Etudiant
     */
    public function Etudiant_copie(Etudiant $unEtudiant) {
        $this->set_ine($unEtudiant->get_ine());
        $this->set_nom($unEtudiant->get_nom());
        $this->set_prenom($unEtudiant->get_prenom());
        $this->set_dateNaiss($unEtudiant->get_dateNaiss());
        $this->set_cp($unEtudiant->get_cp());
        $this->set_ville($unEtudiant->get_ville());
        $this->set_pays($unEtudiant->get_pays());
        $this->set_numTel($unEtudiant->get_numTel());
        $this->set_planning($uneEtudiant->get_planning());
    }

    // METHODES

    /**
     * @brief Renvoie l'INE de l'Etudiant
     */
    public function get_ine() {
        return $this->ine;
    }

    /**
     * @brief Modifie l'INE de l'Etudiant par celui passé en paramètre
     */
    public function set_ine($unIne) {
        $this->ine = $unIne;
    }

    /**
     * @brief Renvoie le nom de l'Etudiant
     */
    public function get_nom() {
        return $this->nom;
    }

    /**
     * @brief Modifie le nom de l'Etudiant par celui passé en paramètre
     */
    public function set_nom($unNom) {
        $this->nom = $unNom;
    }

    /**
     * @brief Renvoie le prénom de l'Etudiant
     */
    public function get_prenom() {
        return $this->prenom;
    }

    /**
     * @brief Modifie le prénom de l'Etudiant par celui passé en paramètre
     */
    public function set_prenom($unPrenom) {
        $this->prenom = $unPrenom;
    }

    /**
     * @brief Renvoie la date de naissance de l'Etudiant
     */
    public function get_dateNaiss() {
        return $this->dateNaiss;
    }

    /**
     * @brief Modifie la date de naissance de l'Etudiant par celle passée en paramètre
     */
    public function set_dateNaiss($uneDateNaiss) {
        $this->dateNaiss = $uneDateNaiss;
    }

    /**
     * @brief Renvoie le code postal de l'Etudiant
     */
    public function get_cp() {
        return $this->cp;
    }

    /**
     * @brief Modifie le code postal de l'Etudiant par celui passé en paramètre
     */
    public function set_cp($unCp) {
        $this->cp = $unCp;
    }

    /**
     * @brief Renvoie la ville de l'Etudiant
     */
    public function get_ville() {
        return $this->ville;
    }

    /**
     * @brief Modifie la ville de l'Etudiant par celle passée en paramètre
     */
    public function set_ville($uneVille) {
        $this->ville = $uneVille;
    }

    /**
     * @brief Renvoie le pays de l'Etudiant
     */
    public function get_pays() {
        return $this->pays;
    }

    /**
     * @brief Modifie le pays de l'Etudiant par celui passé en paramètre
     */
    public function set_pays($unPays) {
        $this->pays = $unPays;
    }

    /**
     * @brief Renvoie le numéro de téléphone de l'Etudiant
     */
    public function get_numTel() {
        return $this->numTel;
    }

    /**
     * @brief Modifie le numéro de téléphone de l'Etudiant par celui passé en paramètre
     */
    public function set_numTel($unNumTel) {
        $this->numTel = $unNumTel;
    }

    /**
     * @brief Renvoie le planning de l'Etudiant
     */
    public function get_planning() {
        return $this->planning;
    }

    /**
     * @brief Renvoie le planning de l'Etudiant
     */
    public function set_planning($unPlanning) {
        $this->planning = $unPlanning;
    }

    /**
     * @brief Ajoute un Creneau dans le planning de l'Etudiant
     */
    public function ajouter_creneau(&$unCreneau) {
        $this->planning.add($unCreneau);
    }

    /**
     * @brief Supprime un Creneau dans le planning de l'Etudiant
     */
    public function supprimer_creneau(&$unCreneau) {
        if (isset($this->planning[$unCreneau])) {
            unset($this->planning[$unCreneau]);
        }
        
    }

    /**
     * @brief Modifie un Creneau dans le planning de l'Etudiant
     */
    public function modifier_creneau($jourCreneau, &$nveauCreneau) {
        for ($i=0; $i < count($this->planning); $i++)
        {
            if ($this->planning[$i].jour == $jourCreneau) {
                $this->planning[$i] = $nveauCreneau;
            }
        }
    }
}

?>