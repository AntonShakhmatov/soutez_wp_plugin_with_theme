<?php

function emailMainFunctions($competition_type, $update)
{
    if (isset($_POST['action']) && $_POST['action'] == 'update_db' && $_POST['competition_type'] == $competition_type->competition_type) {
        $main_competition_id = getMainCompetitionId($competition_type);
        $template_id = getMainTemplateId($main_competition_id);
        $quantity = getQuantityMain($competition_type);

        $maxCompetitionDate = getMaxDate();
        $currentDateTime = date('Y-m-d H:i:s');

        if ($currentDateTime > $maxCompetitionDate) {
            $update->sendMainTransactionMails($template_id, $main_competition_id);


            if ($quantity <= 1) {
                $update->deleteMainTypeOfCompetition($template_id);
            } else {
                if ($template_id !== NULL && $template_id !== '') {
                    $update->changeQuantityOfMainCompetition();
                } else {
                    echo "template_id chybí. Přidat mužete v položce menu Maily";
                }
            }
            $update->createMainPageWithEndpoint();
            //    break;
        } else {
            echo "The time has not come yet";
        }
    }
}
