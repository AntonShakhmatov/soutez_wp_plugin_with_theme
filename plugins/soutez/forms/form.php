<?php

require_once SOUTEZ_DIR . 'forms/edit-contact-form.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

require_once 'db_functions.php';

add_action('admin_init', 'submit_form_data');
function submit_form_data()
{
    if (isset($_POST['wp-submit'])) {
        // Получаем данные из массива $_POST
        $args = $_POST;

        // Извлекаем данные из массива
        $firstname = sanitize_text_field($args['firstname']);
        $surname = sanitize_text_field($args['surname']);
        $email = sanitize_email($args['email']);
        $phone = sanitize_text_field($args['phone']);
        $psc = sanitize_text_field($args['psc']);
        $purchasedate = sanitize_text_field($args['purchasedate']);
        $bill = sanitize_text_field($args['bill']);
        $price = sanitize_text_field($args['price']);
        // $consent = isset($args['consent']) ? 1 : 0;
        // $interested = isset($args['interested']) ? 1 : 0;

        // Вставляем данные в базу данных
        insertFirstnameSurnameEmailPhonePscPurchasedateBillPriceIntoKontaktniUdaje(
            $firstname,
            $surname,
            $email,
            $phone,
            $psc,
            $purchasedate,
            $bill,
            $price
        );

        insertFirstnameSurnameEmailPhonePscPurchasedateBillPriceIntoKontaktniUdajeDenni(
            $firstname,
            $surname,
            $email,
            $phone,
            $psc,
            $purchasedate,
            $bill,
            $price
        );

        insertFirstnameSurnameEmailPhonePscPurchasedateBillPriceIntoKontaktniUdajeHlavni(
            $firstname,
            $surname,
            $email,
            $phone,
            $psc,
            $purchasedate,
            $bill,
            $price
        );

        insertFirstnameSurnameEmailPhonePscPurchasedateBillPriceIntoKontaktniUdajeTydenni(
            $firstname,
            $surname,
            $email,
            $phone,
            $psc,
            $purchasedate,
            $bill,
            $price
        );

        // Перенаправляем пользователя на другую страницу
        header('Location: ../index.php/podekovani/');
        exit;
    }
}
