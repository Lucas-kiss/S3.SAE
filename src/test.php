<?php

require_once 'objetPhp.php';
require_once 'fct/faireComb.php';




foreach($lstObjEtudiant as $etu) {
    $lstObjOffre[0]->ajouter_etudiant($etu);
}



$combsOffre = new CombOffre(null,null);
faireComb($lstObjOffre[0], $etudiantNull,$combsOffre);
var_dump($combsOffre);

?>