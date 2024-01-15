<head>
    <meta charset="utf-8">
    <title>La démo</title>
    <link href="style_demo.css" rel="stylesheet">
</head>


<?php

require_once 'objetPhp.php';
require_once 'fct/faireComb.php';

foreach ($lstObjEtudiant as $etu) {
    $lstObjOffre[0]->ajouter_etudiant($etu);
}
$combsOffre = new CombOffre(null, null);
faireComb($lstObjOffre[0], $etudiantNull, $combsOffre);

print '<h2> Combinaisons retenues de la semaine</h2> <br>';
print 'Nombre de combinaisons : ' . $combsOffre->get_nbCombinaisons() . '<br><hr>';
$cptComb = 0;
foreach ($combsOffre->get_mesComposants() as $unComp) {
    $cptComb++;
    print '<b>Combinaison ' . $cptComb . '<br></b>';
    print 'Taux de remplissage : ' . ($unComp->get_tauxRemplissage() * 100) . '% -  ';
    print 'Nombre d\'étudiants : ' . $unComp->get_nbEtudiants() . '<br><br>';

    ?>

    <table>
        <!-- Afficher les heures de la journée -->
        <tr>
            <td>Jour</td>
            <?php
            for ($i = 0; $i < 24; $i++) {
                print '<td>' . $i . 'h</td>';
            }
            ?>
        </tr>

        <!-- Afficher les combinaisons -->
        <?php
        // liste des jours de la semaine
        $lstJours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        // on parcourt tous les jours de la semaine
        foreach ($lstJours as $leJour) {
            $jourDansOffre = false;
            // on parcourt tous les jours de l'offre
            foreach ($unComp->get_mesComposants() as $unJour) {
                // si le jour est compris dans l'offre alors on affiche la ligne du tableau avec les étudiants
                if ($leJour == $unJour->get_jour()) {
                    $jourDansOffre = true;
                    print '<tr> <td>' . $unJour->get_jour() . '</td>';
                    foreach ($unJour->get_lstEtudiant() as $unEtu) {
                        if ($unEtu == null) {
                            print '<td class=pasEtu></td>';
                        } else if ($unEtu == $etudiantNull) {
                            print '<td class=etuNull></td>';
                        } else {
                            print '<td class=unEtu>' . $unEtu->get_prenom() . ' ' . $unEtu->get_nom() . '</td>';
                        }
                    }
                }
            }
            // si le jour n'est pas compris dans l'offre alors on affiche une ligne vide
            if ($jourDansOffre == false) {
                print '<tr> <td>' . $leJour . '</td>';
                for ($i = 0; $i < 24; $i++) {
                    print '<td class=pasEtu></td>';
                }
            }
        }

        ?>
    </table>

    <?php

    print '<hr>';

}

?>