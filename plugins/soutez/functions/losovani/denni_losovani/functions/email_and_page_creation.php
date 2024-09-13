<?php

//add_action('wp_ajax_sendMail', 'getDaysFunctions');
function getDaysFunctions($competition_type, $update, $selectedVitez)
{
    $denni_competition_id = getDenniCompetitionId($competition_type);
    $template_id = getDaysTemplateId($denni_competition_id); //ошибка
    $quantity = getQuantity($competition_type);

    $update->sendDaysTransactionMails($template_id, $selectedVitez->vyhra, $selectedVitez->jmeno, $selectedVitez->prijmeni, $selectedVitez->email);

    if ($quantity <= 1) {
        $update->deleteDaysTypeOfCompetition($template_id);
    } else {
        if ($template_id !== NULL && $template_id !== '') {
            $update->changeQuantityOfDaysCompetition();
        } else {
            echo "template_id chybí. Přidat mužete v položce menu Maily Denni";
        }
    }
    $update->createDaysPageWithEndpoint($selectedVitez->jmeno, $selectedVitez->prijmeni);
    // Важно завершить выполнение скрипта после отправки ответа
}

function update_db_callback() {}
