<?php

require_once 'objetPhp.php';
require_once 'fct/faireComb.php';




foreach($lstObjEtudiant as $etu) {
    $lstObjOffre[0]->ajouter_etudiant($etu);
}



$combsOffre = new CombOffre(null,null);
echo'<pre>';
print_r($lstObjOffre[0]);
echo '</pre>';
faireComb($lstObjOffre[0], $etudiantNull,$combsOffre);
echo'<pre>';
print_r($combsOffre);
echo '</pre>';

?>