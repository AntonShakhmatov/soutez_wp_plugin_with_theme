<?php

require_once SOUTEZ_DIR . 'classes/update/update.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

require_once 'db_functions.php';

if (isset($_POST['submit_action']) && $_POST['submit_action'] === 'Upload') {
    $competition_type = $_POST['competition_type'];
    $kontakt_id = $_POST['kontakt_id'];
    $shortToken = $_POST['shortToken'];
    $name = $_POST['your-name'];
    $surname = $_POST['your-surname'];
    $vyhra = $_POST['your-vyhra'];
    $address = $_POST['your-address'];
    $uploaded_files = $_FILES['your-file'];
    var_dump("Submit action triggered"); // Display a message

    // Or, display the values of the variables
    var_dump($address);
    var_dump($uploaded_files);
    processSubmitForm(
        $competition_type,
        $kontakt_id,
        $name,
        $surname,
        $vyhra,
        $address,
        $uploaded_files,
        $shortToken
    );
}

function processSubmitForm(
    $competition_type,
    $kontakt_id,
    $name,
    $surname,
    $vyhra,
    $address,
    $uploaded_files,
    $shortToken
) {
    if ($uploaded_files) {
        $dir = wp_upload_dir()['basedir'];
        $uploads_dir = $dir . '/' . $name . '/' . $surname;
        $file_name = $uploaded_files['name'];
        $file_path = $uploads_dir . '/' . $file_name;

        if (!file_exists($uploads_dir)) {
            wp_mkdir_p($uploads_dir);
        }

        move_uploaded_file($uploaded_files['tmp_name'], $file_path);

        insertCompetitionTypeKontaktIdNameSurnameVyhraAddressFilePathIntoUctenkaViteze(
            $competition_type,
            $kontakt_id,
            $name,
            $surname,
            $vyhra,
            $address,
            $file_path
        );

        insertKontakIdNameSurnameAddressIntoViteze(
            $kontakt_id,
            $name,
            $surname,
            $address
        );

        $page_url = get_option('siteurl') . "/index.php/" . $shortToken;
        deletePageByURL($page_url);
    }
}

function deletePageByURL($page_url)
{
    $page = selectAllFromPosts($page_url);

    if ($page) { // Проверяем, найдена ли страница
        deleteAllFromPosts($page_url);
        echo 'Страница успешно удалена'; // Выводим сообщение об успешном удалении
        header('Location: ../index.php/podekovani/');
        exit;
    } else {
        header('Location: ../index.php/podekovani/');
        echo 'Страница не найдена';
        echo $page_url; // Выводим сообщение, если страница не найдена
    }
}
