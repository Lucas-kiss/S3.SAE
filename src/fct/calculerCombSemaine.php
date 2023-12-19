<?php
include '../classes_sae/CombOffre.php';
include '../classes_sae/Offre.php';

function calculerCombSemaine(Offre $uneOffre, $combsChaqueJour, $jourATraiter, CombSemaine &$uneCombOffre, CombOffre &$combsOffre)
{
    if ($jourATraiter != end($combsChaqueJour)) {

        // Compter le nb de possiblités de combinaisons pour le jour courant
        $cptPossibilite = 0;
        foreach ($jourATraiter as $element) {
            $cptPossibilite++;
        }

        foreach ($jourATraiter as $element) {
            if ($cptPossibilite > 1) {
                $copieUneCombOffre = CombOffre_copie($uneCombOffre);
                $copieUneCombOffre.ajouterComposant($element);
                calculerCombSemaine($uneOffre, $combsChaqueJour, $jourATraiter+1, $copieUneCombOffre, $combsOffre);
            }
            else {
                $copieUneCombOffre.ajouterComposant($element);
                calculerCombSemaine($uneOffre, $combsChaqueJour, $jourATraiter+1, $copieUneCombOffre, $combsOffre);
            }
        }

        // Calculer nbEtudiants et tauxRemplissage de uneCombOffre


        if ($uneCombOffre.verifNbMinEtud($uneOffre) && $uneCombOffre.verifNbMinHeureEtud($uneOffre)) {
            $combsOffre.ajouterComposant($uneCombOffre);
        }
        else {
            $uneCombOffre.__destruct();
        }
    }

}

?>