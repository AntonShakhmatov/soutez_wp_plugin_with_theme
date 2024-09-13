<?php

require_once SOUTEZ_DIR . 'forms/edit-contact-form.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

//add_action( 'admin_post_submit_form_data', 'submit_form_data' );
//add_action( 'admin_post_nopriv_submit_form_data', 'submit_form_data' );

add_action('admin_init', 'submit_form_data');
function submit_form_data()
{
    if (isset($_POST['wp-submit'])) {
        global $wpdb;
        $table_name    = $wpdb->prefix . 'kontaktni_udaje';
        $table_name_2 = $wpdb->prefix . 'kontaktni_udaje_denni';
        $table_name_3 = $wpdb->prefix . 'kontaktni_udaje_hlavni';
        $table_name_4 = $wpdb->prefix . 'kontaktni_udaje_tydenni';
        $time_now = time();

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
        $wpdb->insert(
            $table_name, // Замените 'your_table_name' на название вашей таблицы в базе данных
            array(
                'jmeno' => $firstname,
                'prijmeni' => $surname,
                'email' => $email,
                'telefon' => $phone,
                'psc' => $psc,
                'datum_nakupu' => $purchasedate,
                'cas_nakupu' => $bill,
                'cena_nakupu' => $price,
                'cas_plneni' => date('Y-m-d H:i:s')
                // 'consent' => $consent,
                // 'interested' => $interested
            ),
            // array(
            //     '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d'
            // )
        );

        $wpdb->insert(
            $table_name_2, // Замените 'your_table_name' на название вашей таблицы в базе данных
            array(
                'jmeno' => $firstname,
                'prijmeni' => $surname,
                'email' => $email,
                'telefon' => $phone,
                'psc' => $psc,
                'datum_nakupu' => $purchasedate,
                'cas_nakupu' => $bill,
                'cena_nakupu' => $price,
                'cas_plneni' => date('Y-m-d H:i:s')
                // 'consent' => $consent,
                // 'interested' => $interested
            ),
            // array(
            //     '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d'
            // )
        );

        $wpdb->insert(
            $table_name_3, // Замените 'your_table_name' на название вашей таблицы в базе данных
            array(
                'jmeno' => $firstname,
                'prijmeni' => $surname,
                'email' => $email,
                'telefon' => $phone,
                'psc' => $psc,
                'datum_nakupu' => $purchasedate,
                'cas_nakupu' => $bill,
                'cena_nakupu' => $price,
                'cas_plneni' => date('Y-m-d H:i:s')
                // 'consent' => $consent,
                // 'interested' => $interested
            ),
            // array(
            //     '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d'
            // )
        );

        $wpdb->insert(
            $table_name_4, // Замените 'your_table_name' на название вашей таблицы в базе данных
            array(
                'jmeno' => $firstname,
                'prijmeni' => $surname,
                'email' => $email,
                'telefon' => $phone,
                'psc' => $psc,
                'datum_nakupu' => $purchasedate,
                'cas_nakupu' => $bill,
                'cena_nakupu' => $price,
                'cas_plneni' => date('Y-m-d H:i:s')
                // 'consent' => $consent,
                // 'interested' => $interested
            ),
            // array(
            //     '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d'
            // )
        );

        // Перенаправляем пользователя на другую страницу
        header('Location: ../index.php/podekovani/');
        exit;
    }
}
