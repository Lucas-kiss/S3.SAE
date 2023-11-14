<?php
/**
 * @file Combinaison.php
 * @author fconstans
 * @brief Création de la classe Combinaison
 * @version 0.1
 * @date 2023-11-14
 * 
 */

 /**
 * @brief Cette classe abstraite généralise les Combinaisons pour une Offre
 * 
 * @details Les Combinaison sont soit CombSimple, soit CombComposee
 */

abstract class Combinaison {

    // ATTRIBUTS 

    private $tauxRemplissage;
    private $nbEtudiants;

    // METHODES

    abstract function Combinaison();
    abstract function ajouterComposant($composant);
    abstract function retirerComposant($composant);
    abstract function existeComposant($composant);
    abstract function verifNbMinEtud($uneOffre);
    abstract function verifNbMinHeureEtud($uneOffre);
}

?>