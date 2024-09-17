<?php

require_once('db_functions.php');
require_once('html_functions.php');
require_once('email_and_page_creation.php');

$lastDayOfCompetition = getLastDayOfCompetition();

$competition_types = getCompetitionMainTypes($lastDayOfCompetition);

foreach ($competition_types as $competition_type) {

    $update = new Update($competition_type->competition_type);

    if ($competition_type) {
        getLinkForMain($competition_type);
        $viteze = getHlavniVitez($competition_type);

        if (empty($viteze)) {
            // Zde budou vkládána pole do databáze
            $update->insertDatabaseHlavni();
        } else {
            // Zde bude aktualizace databáze
            $update->updateDatabaseHlavni();

            // Máme obnovit seznam ještě jednou pro synchronizaci
            $viteze_po_obnoveni = getMainWinnerAfterRefresh($competition_type);

            getHtmlTableForMain($viteze_po_obnoveni, $competition_type);

            emailMainFunctions($competition_type, $update);
        }
    }
}
