<?php

require_once SOUTEZ_DIR . 'classes/confirmation/confirm.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

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
        global $wpdb;
        $table_name = $wpdb->prefix . 'viteze';
        $table_name_2 = $wpdb->prefix . 'uctenka_viteze';
        $wpdb->update($table_name, array(
            'checkbox' => 1
        ), array(
            'kontakt_id' => $kontakt_id
        ));
        $wpdb->update($table_name_2, array(
            'checkbox' => 'obdržel'
        ), array(
            'kontakt_id' => $kontakt_id
        ));
    }
    $page_url = get_option('siteurl') . "/index.php" . "/confirm-" . $name . '-' . $surname . '-' . $kontakt_id;
    deletePage($page_url);
}

function deletePage($page_url)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'posts';
    // $page = get_page_by_path($page_url); // Получаем страницу по URL

    $page = $wpdb->get_results("SELECT * FROM {$table_name} WHERE guid = '{$page_url}'");

    if ($page) { // Проверяем, найдена ли страница
        $page_id = $page->ID; // Получаем ID страницы
        // wp_delete_post($page_id, true);
        $wpdb->query("DELETE FROM {$table_name} WHERE guid = '{$page_url}'"); // Удаляем страницу
        echo 'Страница успешно удалена'; // Выводим сообщение об успешном удалении
        header('Location: ../index.php/podekovani/');
        exit;
    } else {
        echo 'Страница не найдена';
        echo $page_url; // Выводим сообщение, если страница не найдена
    }
}
