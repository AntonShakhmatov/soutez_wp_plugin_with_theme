<?php

require_once SOUTEZ_DIR . 'classes/update/update.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

if (isset($_POST['submit_action']) && $_POST['submit_action'] === 'Upload') {
    $competition_type = $_POST['competition_type'];
    $kontakt_id = $_POST['kontakt_id'];
    $name = $_POST['your-name'];
    $surname = $_POST['your-surname'];
    $vyhra = $_POST['your-vyhra'];
    $address = $_POST['your-address'];
    $uploaded_files = $_FILES['your-file'];
    var_dump("Submit action triggered"); // Display a message

    // Or, display the values of the variables
    var_dump($address);
    var_dump($uploaded_files);
    // if (current_user_can('edit_posts')) {
    processSubmitForm($competition_type, $kontakt_id, $name, $surname, $vyhra, $address, $uploaded_files);
    // }
}

function processSubmitForm($competition_type, $kontakt_id, $name, $surname, $vyhra, $address, $uploaded_files)
{
    global $wpdb;
    if ($uploaded_files) {
        $dir = wp_upload_dir()['basedir'];
        $uploads_dir = $dir . '/' . $name . '/' . $surname;
        $file_name = $uploaded_files['name'];
        $file_path = $uploads_dir . '/' . $file_name;

        if (!file_exists($uploads_dir)) {
            wp_mkdir_p($uploads_dir);
        }

        move_uploaded_file($uploaded_files['tmp_name'], $file_path);

        $wpdb->insert($wpdb->prefix . 'uctenka_viteze', array(
            'competition_type' => $competition_type,
            'kontakt_id' => $kontakt_id,
            'jmeno' => $name,
            'prijmeni' => $surname,
            'vyhra' => $vyhra,
            'adresa' => $address,
            'file_link' => $file_path
        ));

        $wpdb->insert($wpdb->prefix . 'viteze', array(
            'kontakt_id' => $kontakt_id,
            'jmeno' => $name,
            'prijmeni' => $surname,
            'adresa' => $address,
        ));

        $page_url = get_option('siteurl') . "/index.php" . "/my-page-" . $name . '-' . $surname . '-' . $kontakt_id;
        deletePageByURL($page_url);
    }
}

function deletePageByURL($page_url)
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
