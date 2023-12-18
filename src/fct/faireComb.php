<?php
    include '../../classes_sae/CombOffre';

    function faireComb($uneOffre, $etuNull) {
        $combsOffre = new CombOffre();
        $combsChaqueJour = array(); // liste  de liste combsUnJour

        // Chercher toutes les combinaisons

        foreach ($uneOffre.get_planning() as $itJourOffre) {
            // Chercher toutes les combinaisons d'un jour
        }

        // Chercher toutes les combinaisons à partir des combinaisons de chaque jour
        $uneCombOffre = new CombSemaine();

        $jourATraiter = $combsChqueJour[0];
        combSemaine($uneOffre, $combsChaqueJour, $jourATraiter, $uneCombOffre, $combsOffre);
        

    }
    
    


?>