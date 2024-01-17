<?php

require_once 'objetPhp.php';
require_once 'fct/cpt_nb_etu_dispo_a_jourATraiter_et_heureDeb.php';



foreach($lstObjEtudiant as $etu) {
    $lstObjOffre[0]->ajouter_etudiant($etu);
}

var_dump($itJourEtu);

horairesEtuCorrespHorairesOffre($itJourEtu, $trouveEtu,
    $uneCombDUnJour,
    $cptEtudDispo, $uneOffre,
    $combsUnJour, $heureDeb,
    $heureFin, $itJourOffre,
    $etu, $etuNull);

    var_dump($itJourEtu);

// echo'<pre>';
// echo '</pre>';



?>