<?php

// Chercher les étudiants qui correspondent à heureDeb
function chercherEtudiants($uneOffre, $combsUnJour,
                           $uneCombDUnJour, $heureDeb,
                           $heureFin, $itJourOffre,
                           $cptEtudDispo) 
{
    $trouveEtu = false;
    foreach ($combsUnJour.getLstEtudiant() as $etu) 
    {
        // Faire pointer un itérateur sur le jour à traiter
        $itJourEtu = &$jourATraiter; 
        while ($itJourEtu.getJour() != $jourATraiter.getJour())
        {
            $itJourEtu++;
        }
        // vérifier si les horaires de etu correspondent aux horaires de l'offre
    }
    // Si aucun étudiant ne peut travailler à heureDeb
    if (!$trouveEtu) 
    {
        // Ajouter EtuNull dans uneCombDUnJour.lstEtudiant
        $EtuNull = new Etudiant;
        ($uneCombDUnJour.lstEtudiant())[] = $EtuNull;
        combJour($uneOffre, $combsUnJour,
                 $uneCombDUnJour, $heureDeb+1,
                 $heureFin, $itJourOffre);
    }
}


?>