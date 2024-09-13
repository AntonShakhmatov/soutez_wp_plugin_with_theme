<?php

require_once('db_functions.php');
require_once('email_and_page_creation.php');
require_once('html_functions.php');

$competition_types = getDaysCompetitionTypes();

foreach ($competition_types as $competition_type) {
    $update = new Update($competition_type->competition_type);

    if ($competition_type) {

        getLinks($competition_type);

        $viteze = getViteze($competition_type);

        if (empty($viteze)) {
            // Zde budou vkládána pole do databáze
            $update->insertDatabaseDenni();
        } else {
            // Zde bude aktualizace databáze
            $update->updateDatabaseDenni();
            $update->copyAndSortData();
            // Máme obnovit seznam ještě jednou pro synchronizaci
            $copie_viteze_po_obnoveni = getCopieViteze();
            //            $copie_viteze_po_obnoveni = getViteze($competition_type);
            $nameAndSurname = getKontaktId($competition_type->competition_type);

            getHtmlTable($competition_type, $copie_viteze_po_obnoveni, $nameAndSurname);
        }
    }
    //    break;
}
