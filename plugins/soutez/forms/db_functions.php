<?php

function updateKontaktIdInViteze($kontakt_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'viteze';
    $update = $wpdb->update($table_name, array(
        'checkbox' => 1
    ), array(
        'kontakt_id' => $kontakt_id
    ));
    return $update;
}

function updateKontaktIdInUctenkaViteze($kontakt_id)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'uctenka_viteze';
    $update = $wpdb->update($table_name_2, array(
        'checkbox' => 'obdržel'
    ), array(
        'kontakt_id' => $kontakt_id
    ));
    return $update;
}

function selectAllFromPosts($page_url)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'posts';
    $page = $wpdb->get_results("SELECT * FROM {$table_name} WHERE guid = '{$page_url}'");
    return $page;
}

function deleteAllFromPosts($page_url)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'posts';
    $delete = $wpdb->query("DELETE * FROM {$table_name} WHERE guid = '{$page_url}'"); // Удаляем страницу
    return $delete;
}

function insertCompetitionTypeKontaktIdJmenoPrijmeniVyhraAdresaFileLinkIntoUctenkaViteze($competition_type, $kontakt_id, $name, $surname, $vyhra, $address, $file_path)
{
    global $wpdb;
    $insert = $wpdb->insert($wpdb->prefix . 'uctenka_viteze', array(
        'competition_type' => $competition_type,
        'kontakt_id' => $kontakt_id,
        'jmeno' => $name,
        'prijmeni' => $surname,
        'vyhra' => $vyhra,
        'adresa' => $address,
        'file_link' => $file_path
    ));
    return $insert;
}

function insertKontaktIdNameSurnameAddressIntoViteze($kontakt_id, $name, $surname, $address)
{
    global $wpdb;
    $insert = $wpdb->insert($wpdb->prefix . 'viteze', array(
        'kontakt_id' => $kontakt_id,
        'jmeno' => $name,
        'prijmeni' => $surname,
        'adresa' => $address,
    ));
    return $insert;
}

function insertFirstnameSurnameEmailPhonePscPurchasedateBillPriceIntoKontaktniUdaje($firstname, $surname, $email, $phone, $psc, $purchasedate, $bill, $price)
{
    global $wpdb;
    $table_name    = $wpdb->prefix . 'kontaktni_udaje';
    $insert = $wpdb->insert(
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
        ),
    );
    return $insert;
}

function insertFirstnameSurnameEmailPhonePscPurchasedateBillPriceIntoKontaktniUdajeDenni($firstname, $surname, $email, $phone, $psc, $purchasedate, $bill, $price)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'kontaktni_udaje_denni';
    $insert = $wpdb->insert(
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
        ),
    );
    return $insert;
}

function insertFirstnameSurnameEmailPhonePscPurchasedateBillPriceIntoKontaktniUdajeHlavni($firstname, $surname, $email, $phone, $psc, $purchasedate, $bill, $price)
{
    global $wpdb;
    $table_name_3 = $wpdb->prefix . 'kontaktni_udaje_hlavni';
    $insert = $wpdb->insert(
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
        ),
    );
    return $insert;
}

function insertFirstnameSurnameEmailPhonePscPurchasedateBillPriceIntoKontaktniUdajeTydenni($firstname, $surname, $email, $phone, $psc, $purchasedate, $bill, $price)
{
    global $wpdb;
    $table_name_4 = $wpdb->prefix . 'kontaktni_udaje_tydenni';
    $insert = $wpdb->insert(
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
        ),
    );
    return $insert;
}

function insertCompetitionTypeKontaktIdNameSurnameVyhraAddressFilePathIntoUctenkaViteze($competition_type, $kontakt_id, $name, $surname, $vyhra, $address, $file_path)
{
    global $wpdb;
    $insert = $wpdb->insert($wpdb->prefix . 'uctenka_viteze', array(
        'competition_type' => $competition_type,
        'kontakt_id' => $kontakt_id,
        'jmeno' => $name,
        'prijmeni' => $surname,
        'vyhra' => $vyhra,
        'adresa' => $address,
        'file_link' => $file_path
    ));
    return $insert;
}

function insertKontakIdNameSurnameAddressIntoViteze($kontakt_id, $name, $surname, $address)
{
    global $wpdb;
    $insert = $wpdb->insert($wpdb->prefix . 'viteze', array(
        'kontakt_id' => $kontakt_id,
        'jmeno' => $name,
        'prijmeni' => $surname,
        'adresa' => $address,
    ));
    return $insert;
}
