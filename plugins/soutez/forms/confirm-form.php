<?php

require_once SOUTEZ_DIR . 'classes/confirmation/confirm.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

require_once 'db_functions.php';

if (isset($_POST['confirm_action']) && $_POST['confirm_action'] === 'Poslat potvrzeni') {
    $checkbox = isset($_POST['checkbox_confirm']) ?  $_POST['checkbox_confirm'] : 0;
    $kontakt_id = $_POST['kontakt_id'];
    $confirmation = new Confirmation($kontakt_id);
    $name = $confirmation->getName();
    $surname = $confirmation->getSurname();

    var_dump("Submit action triggered"); // Display a message

    processConfirmCheckbox($checkbox, $kontakt_id, $name, $surname);
}

function processConfirmCheckbox($checkbox, $kontakt_id, $name, $surname)
{
    if ($checkbox) {
        updateKontaktIdInViteze($kontakt_id);
        updateKontaktIdInUctenkaViteze($kontakt_id);
    }
    $page_url = get_option('siteurl') . "/index.php" . "/confirm-" . $name . '-' . $surname . '-' . $kontakt_id;
    deletePage($page_url);
}

function deletePage($page_url)
{
    $page = selectAllFromPosts($page_url);

    if ($page) { // Проверяем, найдена ли страница
        deleteAllFromPosts($page_url);
        echo 'Страница успешно удалена'; // Выводим сообщение об успешном удалении
        header('Location: ../index.php/podekovani/');
        exit;
    } else {
        echo 'Страница не найдена';
        echo $page_url; // Выводим сообщение, если страница не найдена
    }
}
