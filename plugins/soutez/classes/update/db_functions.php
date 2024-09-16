<?php

function getCompetitionIdFromTypSouteze($competition_type)
{
    global $wpdb;
    $table_name_5 = $wpdb->prefix . 'typ_souteze';
    $competition_id = $wpdb->get_var("SELECT competition_id FROM {$table_name_5} WHERE competition_type = '{$competition_type}'");
    return $competition_id;
}

function getDrawIdFromPrizeDraw($competition_type)
{
    global $wpdb;
    $table_name_6 = $wpdb->prefix . 'prize_draw';
    $draw_id = $wpdb->get_var("SELECT draw_id FROM {$table_name_6} WHERE competition_type = '{$competition_type}'");
    return $draw_id;
}

function getAllFromKontaktniUdajeTydenni()
{
    global $wpdb;
    $table_name_11 = $wpdb->prefix . 'kontaktni_udaje_tydenni';
    $random_winner = $wpdb->get_results("SELECT * FROM {$table_name_11} ORDER BY RAND() LIMIT 1");
    return $random_winner;
}

function getAllFromKontaktniUdajeDenni()
{
    global $wpdb;
    $table_name_8 = $wpdb->prefix . 'kontaktni_udaje_denni';
    $random_winner_denni = $wpdb->get_results("SELECT * FROM {$table_name_8} ORDER BY RAND() LIMIT 1");
    return $random_winner_denni;
}

function getAllFromKontaktniUdajeHlavni()
{
    global $wpdb;
    $table_name_9 = $wpdb->prefix . 'kontaktni_udaje_hlavni';
    $random_winner_hlavni = $wpdb->get_results("SELECT * FROM {$table_name_9} ORDER BY RAND() LIMIT 1");
    return $random_winner_hlavni;
}

function getAllFromKontaktniUdajeViteze($competition_type)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $viteze = $wpdb->get_results("SELECT * FROM {$table_name_2} WHERE competition_type = '{$competition_type}'");
    return $viteze;
}

function getVyhraFromAktivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $vyhra = $wpdb->get_var("SELECT vyhra FROM {$table_name} WHERE competition_type = '{$competition_type}'");
    return $vyhra;
}

function getVyhraFromDenniSoutezi($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $vyhra_denni = $wpdb->get_var("SELECT vyhra FROM {$table_name_denni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_denni;
}

function getVyhraFromDenniSoutezi2($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $vyhra_denni = $wpdb->get_var("SELECT vyhra2 FROM {$table_name_denni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_denni;
}

function getVyhraFromDenniSoutezi3($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $vyhra_denni = $wpdb->get_var("SELECT vyhra3 FROM {$table_name_denni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_denni;
}

function getVyhraFromDenniSoutezi4($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $vyhra_denni = $wpdb->get_var("SELECT vyhra4 FROM {$table_name_denni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_denni;
}

function getVyhraFromDenniSoutezi5($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $vyhra_denni = $wpdb->get_var("SELECT vyhra5 FROM {$table_name_denni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_denni;
}

function getVyhraFromDenniSoutezi6($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $vyhra_denni = $wpdb->get_var("SELECT vyhra6 FROM {$table_name_denni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_denni;
}

function getVyhraFromDenniSoutezi7($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $vyhra_denni = $wpdb->get_var("SELECT vyhra7 FROM {$table_name_denni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_denni;
}

function getVyhraFromDenniSoutezi8($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $vyhra_denni = $wpdb->get_var("SELECT vyhra8 FROM {$table_name_denni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_denni;
}

function getVyhraFromDenniSoutezi9($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $vyhra_denni = $wpdb->get_var("SELECT vyhra9 FROM {$table_name_denni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_denni;
}

function getVyhraFromDenniSoutezi10($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $vyhra_denni = $wpdb->get_var("SELECT vyhra10 FROM {$table_name_denni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_denni;
}

function getVyhraFromHlavniSoutezi($competition_type)
{
    global $wpdb;
    $table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    $vyhra_hlavni = $wpdb->get_var("SELECT vyhra FROM {$table_name_hlavni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_hlavni;
}

function getTemplateFromTypSoutezeMails($draw_id)
{
    global $wpdb;
    $table_name_4 = $wpdb->prefix . 'typ_souteze_mails';
    $template = $wpdb->get_var("SELECT template FROM {$table_name_4} WHERE draw_id = '{$draw_id}'");
    return $template;
}

function getEcomailTemplateIdFromTypSoutezeMails($draw_id)
{
    global $wpdb;
    $table_name_4 = $wpdb->prefix . 'typ_souteze_mails';
    $ecomail_template_id = $wpdb->get_var("SELECT ecomail_template_id FROM {$table_name_4} WHERE draw_id = '{$draw_id}'");
    return $ecomail_template_id;
}

function getEmailFromKontaktniUdajeViteze($competition_type)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $email = $wpdb->get_var("SELECT email FROM {$table_name_2} WHERE competition_type = '{$competition_type}'");
    return $email;
}

function getEmailFromKontaktniUdajeVitezeCopie($competition_type)
{
    global $wpdb;
    $table_name_winner_copie = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $email = $wpdb->get_var("SELECT email FROM {$table_name_winner_copie} WHERE competition_type = '{$competition_type}'");
    return $email;
}

function getNameFromKontaktniUdajeViteze($competition_type)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $name = $wpdb->get_var("SELECT jmeno FROM {$table_name_2} WHERE competition_type = '{$competition_type}'");
    return $name;
}

function getSurnameFromKontaktniUdajeViteze($competition_type)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $surname = $wpdb->get_var("SELECT prijmeni FROM {$table_name_2} WHERE competition_type = '{$competition_type}'");
    return $surname;
}

function getKontaktIdFromKontaktniUdajeViteze($competition_type)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM {$table_name_2} WHERE competition_type = '{$competition_type}'");
    return $kontakt_id;
}

function getCopieNameFromKontaktniUdajeVitezeCopie($competition_type)
{
    global $wpdb;
    $table_name_winner_copie = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $copie_name = $wpdb->get_var("SELECT jmeno FROM {$table_name_winner_copie} WHERE competition_type = '{$competition_type}'");
    return $copie_name;
}

function getCopieSurnameFromKontaktniUdajeVitezeCopie($competition_type)
{
    global $wpdb;
    $table_name_winner_copie = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $copie_surname = $wpdb->get_var("SELECT prijmeni FROM {$table_name_winner_copie} WHERE competition_type = '{$competition_type}'");
    return $copie_surname;
}

function getCopieKontaktIdFromKontaktniUdajeVitezeCopie($competition_type)
{
    global $wpdb;
    $table_name_winner_copie = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM {$table_name_winner_copie} WHERE competition_type = '{$competition_type}'");
    return $kontakt_id;
}

function getKontaktIdFromKontaktniUdajeVitezeMain($competition_type)
{
    global $wpdb;
    $table_name_winner_main = $wpdb->prefix . 'kontaktni_udaje_viteze_main';
    $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM {$table_name_winner_main} WHERE competition_type = '{$competition_type}'");
    return $kontakt_id;
}

function getNameFromKontaktniUdajeVitezeMain($competition_type)
{
    global $wpdb;
    $table_name_winner_main = $wpdb->prefix . 'kontaktni_udaje_viteze_main';
    $name = $wpdb->get_var("SELECT jmeno FROM {$table_name_winner_main} WHERE competition_type = '{$competition_type}'");
    return $name;
}

function getSurnameFromKontaktniUdajeVitezeMain($competition_type)
{
    global $wpdb;
    $table_name_winner_main = $wpdb->prefix . 'kontaktni_udaje_viteze_main';
    $surname = $wpdb->get_var("SELECT prijmeni FROM {$table_name_winner_main} WHERE competition_type = '{$competition_type}'");
    return $surname;
}

function getEmailFromKontaktniUdajeVitezeMain($competition_type)
{
    global $wpdb;
    $table_name_winner_main = $wpdb->prefix . 'kontaktni_udaje_viteze_main';
    $email = $wpdb->get_var("SELECT kontakt_id FROM {$table_name_winner_main} WHERE competition_type = '{$competition_type}'");
    return $email;
}

function selectAllFromTypSouteze($competition_type)
{
    global $wpdb;
    $table_name_5 = $wpdb->prefix . 'typ_souteze';
    $existing_record = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$table_name_5` WHERE competition_type = %s", $competition_type));
    return $existing_record;
}

function updateCompetitionIdForTypSouteze($competition_type, $competition_id)
{
    global $wpdb;
    $table_name_5 = $wpdb->prefix . 'typ_souteze';
    //Update new entry
    $wpdb->update(
        $table_name_5,
        array(
            'competition_type' => $competition_type,
        ),
        array('competition_id' => $competition_id)
    );
}

function insertCompetitionTypeForTypSouteze($competition_type)
{
    global $wpdb;
    $table_name_5 = $wpdb->prefix . 'typ_souteze';
    //Insert new entryaddCompetitionTypeWithoutTimer
    $wpdb->insert(
        $table_name_5,
        array(
            'competition_type' => $competition_type,
        )
    );
}

function getAllFromKontaktniUdaje()
{
    global $wpdb;
    $table_name_3 = $wpdb->prefix . 'kontaktni_udaje';
    $results = $wpdb->get_results("SELECT * FROM $table_name_3");
    return $results;
}

function selectAllFromPrizeDraw($competition_type)
{
    global $wpdb;
    $table_name_6 = $wpdb->prefix . 'prize_draw';
    $existing_prize = $wpdb->get_var($wpdb->prepare("SELECT * FROM `$table_name_6` WHERE competition_type = %s", $competition_type));
    return $existing_prize;
}

function selectAllFromAktivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $existing_competition = $wpdb->get_var($wpdb->prepare("SELECT * FROM `$table_name` WHERE competition_type = %s", $competition_type));
    return $existing_competition;
}

function selectVyhraFromAltivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $existing_vyhra = $wpdb->get_var($wpdb->prepare("SELECT `vyhra` FROM `$table_name` WHERE competition_type = %s", $competition_type));
    return $existing_vyhra;
}

function updateCompetitionIdInPrizeDraw($vyhra, $quantity, $competition_type, $competition_id)
{
    global $wpdb;
    $table_name_6 = $wpdb->prefix . 'prize_draw';
    $update = $wpdb->update(
        $table_name_6,
        array(
            'vyhra' => $vyhra,
            'quantity' => $quantity,
            'competition_type' => $competition_type
        ),
        array(
            'competition_id' => $competition_id,
        )
    );
    return $update;
}

function insertCompetitionIdCompetitionTypeVyhraQuantityInPrizeDraw($competition_id, $competition_type, $vyhra, $quantity)
{
    global $wpdb;
    $table_name_6 = $wpdb->prefix . 'prize_draw';
    $insert = $wpdb->insert(
        $table_name_6,
        array(
            'competition_id' => $competition_id,
            'competition_type' => $competition_type,
            'vyhra' => $vyhra,
            'quantity' => $quantity
        )
    );
    return $insert;
}

function insertDrawIdCompetitionTypeVyhraQuantityZacatekKonecInAktivnySoutezi($draw_id, $competition_type, $vyhra, $quantity, $zahajeni, $konec)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $insert = $wpdb->insert(
        $table_name,
        array(
            'draw_id' => $draw_id,
            'competition_type' => $competition_type,
            'vyhra' => $vyhra,
            'quantity' => $quantity,
            'zacatek' => $zahajeni,
            'konec' => $konec
        )
    );
    return $insert;
}

function updateCompetitionTypeInAktivnySoutezi($quantity, $vyhra, $competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $update = $wpdb->update(
        $table_name,
        array(
            'quantity' => $quantity,
            'vyhra' => $vyhra,
        ),
        array(
            'competition_type' => $competition_type,
        )
    );
    return $update;
}

function selectAllFromDenniSoutezi($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $existing_denni_record = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$table_name_denni` WHERE competition_type = %s", $competition_type));
    return $existing_denni_record;
}

function selectZacatekFromAktivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $zahajeni = $wpdb->get_var("SELECT zacatek FROM `$table_name` WHERE competition_type = '$competition_type'");
    return $zahajeni;
}

function selectKonecFromAktivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $konec = $wpdb->get_var("SELECT konec FROM `$table_name` WHERE competition_type = '$competition_type'");
    return $konec;
}

function selectActiveCompetitionIdFromAktivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $active_competition_id = $wpdb->get_var("SELECT active_competition_id FROM `$table_name` WHERE competition_type = '$competition_type'");
    return $active_competition_id;
}

function updateActiveCompetitionIdFromDenniSoutezi($startOfDay, $endOfDay, $active_competition_id)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $update = $wpdb->update(
        $table_name_denni,
        array(
            'zacatek' => $startOfDay,
            'konec' => $endOfDay,
        ),
        array(
            'active_competition_id' => $active_competition_id,
        )
    );
    return $update;
}

function insertActiveCompetitionIdCompetitionTypeCompetitionNameZacatekKonecInDenniSoutezi($active_competition_id, $competition_type, $i, $startOfDay, $endOfDay)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $insert = $wpdb->insert(
        $table_name_denni,
        array(
            'active_competition_id' => $active_competition_id,
            'competition_type' => $competition_type . '_' . $i . '_den',
            'competition_name' => $i . '_den_' . $competition_type . '_' . $i . '_den',
            'zacatek' => $startOfDay,
            'konec' => $endOfDay
        )
    );
    return $insert;
}

function selectAllFromHlavniSoutezi($competition_type)
{
    global $wpdb;
    $table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    $existing_hlavni_record = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$table_name_hlavni` WHERE competition_type = %s", 'hlavni_losovani_' . $competition_type));
    return $existing_hlavni_record;
}

function selectActiveCompetitionId($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $active_competition_id = $wpdb->get_var("SELECT active_competition_id FROM `$table_name` WHERE competition_type = '$competition_type'");
    return $active_competition_id;
}

function selectMinZacatekFromAktivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $query = "SELECT MIN(zacatek) as first_zacatek, MAX(konec) as last_konec FROM $table_name";
    $result = $wpdb->get_row($query);
    return $result;
}

function updateZacatekKonecInHlavniSoutezi($active_competition_id, $competition_type, $firstZacatek, $lastKonec,)
{
    global $wpdb;
    $table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    $update = $wpdb->update(
        $table_name_hlavni,
        array(
            'active_competition_id' => $active_competition_id,
            'competition_type' => $competition_type,
            'competition_name' => 'Hlavní losování',
            'zacatek' => $firstZacatek,
            'konec' => $lastKonec,
        ),
        array(
            'zacatek' => $firstZacatek,
            'konec' => $lastKonec,
        )
    );
    return $update;
}

function insertActiveCompetitionIdCompetitionTypeCompetitionNameZacatekKonec($active_competition_id, $competition_type, $firstZacatek, $lastKonec)
{
    global $wpdb;
    $table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    $insert = $wpdb->insert(
        $table_name_hlavni,
        array(
            'active_competition_id' => $active_competition_id,
            'competition_type' => 'hlavni_losovani_' . $competition_type,
            'competition_name' => 'Hlavní losování',
            'zacatek' => $firstZacatek,
            'konec' => $lastKonec
        )
    );
    return $insert;
}

function deleteFromDenniSoutezi($competition_type)
{
    global $wpdb;
    $delete = $wpdb->query("DELETE FROM {$wpdb->prefix}denni_soutezi WHERE active_competition_id IN (SELECT active_competition_id FROM {$wpdb->prefix}aktivny_soutezi WHERE competition_type = '{$competition_type}')");
    return $delete;
}

function deleteFromHlavniSouteziSelectActiveCompetitionId($competition_type)
{
    global $wpdb;
    $delete = $wpdb->query("DELETE FROM {$wpdb->prefix}hlavni_soutezi WHERE active_competition_id IN (SELECT active_competition_id FROM {$wpdb->prefix}aktivny_soutezi WHERE competition_type = '{$competition_type}')");
    return $delete;
}

function deleteFromHlavniSouteziSelectDrawId($competition_type)
{
    global $wpdb;
    $delete = $wpdb->query("DELETE FROM {$wpdb->prefix}hlavni_soutezi WHERE active_competition_id IN (SELECT draw_id FROM {$wpdb->prefix}prize_draw WHERE competition_type = '{$competition_type}')");
    return $delete;
}

function deleteCompetitionTypeFromAktivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $delete = $wpdb->delete($table_name, array('competition_type' => $competition_type));
    return $delete;
}

function deleteCompetitionTypeFromPrizeDraw($competition_type)
{
    global $wpdb;
    $table_name_6 = $wpdb->prefix . 'prize_draw';
    $delete = $wpdb->delete($table_name_6, array('competition_type' => $competition_type));
    return $delete;
}

function deleteFromDenniSouteziSelectActiveCompetitionId()
{
    global $wpdb;
    $delete = $wpdb->query("DELETE FROM {$wpdb->prefix}denni_soutezi WHERE active_competition_id NOT IN (SELECT active_competition_id FROM {$wpdb->prefix}aktivny_soutezi)");
    return $delete;
}

function insertIntoKontaktniUdajeViteze($kontakt_id, $vyhra, $competition_type, $jmeno, $prijmeni, $telefon, $email, $psc, $datum_nakupu, $cas_nakupu, $cena_nakupu, $cas_plneni)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $insert = $wpdb->insert(
        $table_name_2,
        array(
            // 'competition_id' => $this->competition_id,
            'kontakt_id' => $kontakt_id,
            'vyhra' => $vyhra,
            'competition_type' => $competition_type,
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'telefon' => $telefon,
            'email' => $email,
            'psc' => $psc,
            'datum_nakupu' => $datum_nakupu,
            'cas_nakupu' => $cas_nakupu,
            'cena_nakupu' => $cena_nakupu,
            'cas_plneni' => $cas_plneni
        )
    );
    return $insert;
}

function selectKontaktIdFromUctenkaViteze($competition_type)
{
    global $wpdb;
    $table_name_7 = $wpdb->prefix . 'uctenka_viteze';
    $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM $table_name_7 WHERE competition_type = '$competition_type'");
    return $kontakt_id;
}

function deleteFromKontaktniUdajeTydenni($kontakt_id)
{
    global $wpdb;
    $table_name_11 = $wpdb->prefix . 'kontaktni_udaje_tydenni';
    $delete = $wpdb->query("DELETE FROM `$table_name_11` WHERE `kontakt_id` = $kontakt_id");
    return $delete;
}

function updateKontaktniUdajeViteze($kontakt_id, $vyhra, $competition_type, $jmeno, $prijmeni, $telefon, $email, $psc, $datum_nakupu, $cas_nakupu, $cena_nakupu, $cas_plneni)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $update = $wpdb->update(
        $table_name_2,
        array(
            'kontakt_id' => $kontakt_id,
            'vyhra' => $vyhra,
            'competition_type' => $competition_type,
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'telefon' => $telefon,
            'email' => $email,
            'psc' => $psc,
            'datum_nakupu' => $datum_nakupu,
            'cas_nakupu' => $cas_nakupu,
            'cena_nakupu' => $cena_nakupu,
            'cas_plneni' => $cas_plneni
        ),
        array('competition_type' => $competition_type),
    );
    return $update;
}

function insertIntoKontaktniUdajeVitezeDenni($kontakt_id, $random_vyhra_denni, $competition_type, $jmeno, $prijmeni, $telefon, $email, $psc, $datum_nakupu, $cas_nakupu, $cena_nakupu, $cas_plneni)
{
    global $wpdb;
    $table_name_winner_denni = $wpdb->prefix . 'kontaktni_udaje_viteze_denni';
    // Проверка вставки
    $insert = $wpdb->insert($table_name_winner_denni, array(
        'kontakt_id' => $kontakt_id,
        'vyhra' => $random_vyhra_denni,
        'competition_type' => $competition_type,
        'jmeno' => $jmeno,
        'prijmeni' => $prijmeni,
        'telefon' => $telefon,
        'email' => $email,
        'psc' => $psc,
        'datum_nakupu' => $datum_nakupu,
        'cas_nakupu' => $cas_nakupu,
        'cena_nakupu' => $cena_nakupu,
        'cas_plneni' => $cas_plneni
    ));
    return $insert;
}

function deleteFromKontaktniUdajeDenni($kontakt_id)
{
    global $wpdb;
    $table_name_8 = $wpdb->prefix . 'kontaktni_udaje_denni';
    $delete = $wpdb->query("DELETE FROM `$table_name_8` WHERE `kontakt_id` = $kontakt_id");
    return $delete;
}

function updateCompetitionTypeInKontaktniUdajeVitezeDenni($kontakt_id, $random_vyhra_denni, $competition_type, $jmeno, $prijmeni, $telefon, $email, $psc, $datum_nakupu, $cas_nakupu, $cena_nakupu, $cas_plneni)
{
    global $wpdb;
    $table_name_winner_denni = $wpdb->prefix . 'kontaktni_udaje_viteze_denni';
    $wpdb->update(
        $table_name_winner_denni,
        array(
            'kontakt_id' => $kontakt_id,
            'vyhra' => $random_vyhra_denni,
            'competition_type' => $competition_type,
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'telefon' => $telefon,
            'email' => $email,
            'psc' => $psc,
            'datum_nakupu' => $datum_nakupu,
            'cas_nakupu' => $cas_nakupu,
            'cena_nakupu' => $cena_nakupu,
            'cas_plneni' => $cas_plneni
        ),
        array(
            'competition_type' => $competition_type,
        )
    );
}

function truncateTableKontaktniUdajeVitezeCopie()
{
    global $wpdb;
    $table_name_winner_copie = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $truncate = $wpdb->query("TRUNCATE TABLE $table_name_winner_copie");
    return $truncate;
}

function selectAllFromKontaktniUdajeVitezeDenni()
{
    global $wpdb;
    $table_name_winner_denni = $wpdb->prefix . 'kontaktni_udaje_viteze_denni';
    $results = $wpdb->get_results("SELECT * FROM $table_name_winner_denni ORDER BY cas_plneni ASC, RAND()");
    return $results;
}

function insertKontaktIdVyhraCompetitionTypeJmenoPrijmeniTelefonEmailPscDatumNakupuCasNakupuCenaNakupuCasPlneniIntoKontaktniUdajeVitezeCopie($kontakt_id, $random_vyhra_denni, $competition_type, $jmeno, $prijmeni, $telefon, $email, $psc, $datum_nakupu, $cas_nakupu, $cena_nakupu, $cas_plneni)
{
    global $wpdb;
    $table_name_winner_copie = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $insert = $wpdb->insert($table_name_winner_copie, array(
        'kontakt_id' => $kontakt_id,
        'vyhra' => $random_vyhra_denni,
        'competition_type' => $competition_type,
        'jmeno' => $jmeno,
        'prijmeni' => $prijmeni,
        'telefon' => $telefon,
        'email' => $email,
        'psc' => $psc,
        'datum_nakupu' => $datum_nakupu,
        'cas_nakupu' => $cas_nakupu,
        'cena_nakupu' => $cena_nakupu,
        'cas_plneni' => $cas_plneni
    ));
    return $insert;
}

function insertKontaktIdVyhraCompetitionTypeJmenoPrijmeniTelefonEmailPscDatumNakupuCasNakupuCenaNakupuCasPlneniIntoKontaktniUdajeVitezeMain($kontakt_id, $random_vyhra_denni, $competition_type, $jmeno, $prijmeni, $telefon, $email, $psc, $datum_nakupu, $cas_nakupu, $cena_nakupu, $cas_plneni)
{
    global $wpdb;
    $table_name_winner_main = $wpdb->prefix . 'kontaktni_udaje_viteze_main';
    $insert = $wpdb->insert(
        $table_name_winner_main,
        array(
            'kontakt_id' => $kontakt_id,
            'vyhra' => $random_vyhra_denni,
            'competition_type' => $competition_type,
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'telefon' => $telefon,
            'email' => $email,
            'psc' => $psc,
            'datum_nakupu' => $datum_nakupu,
            'cas_nakupu' => $cas_nakupu,
            'cena_nakupu' => $cena_nakupu,
            'cas_plneni' => $cas_plneni
        )
    );
    return $insert;
}

function updateCompetitionTypeInKontaktniUdajeVitezeMain($kontakt_id, $vyhra_hlavni, $competition_type, $jmeno, $prijmeni, $telefon, $email, $psc, $datum_nakupu, $cas_nakupu, $cena_nakupu, $cas_plneni)
{
    global $wpdb;
    $table_name_winner_main = $wpdb->prefix . 'kontaktni_udaje_viteze_main';
    $update = $wpdb->update(
        $table_name_winner_main,
        array(
            'kontakt_id' => $kontakt_id,
            'vyhra' => $vyhra_hlavni,
            'competition_type' => $competition_type,
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'telefon' => $telefon,
            'email' => $email,
            'psc' => $psc,
            'datum_nakupu' => $datum_nakupu,
            'cas_nakupu' => $cas_nakupu,
            'cena_nakupu' => $cena_nakupu,
            'cas_plneni' => $cas_plneni
        ),
        array('competition_type' => $competition_type)
    );
    return $update;
}

function getNewValue($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $field_name = 'quantity';
    $current_value = $wpdb->get_var("SELECT $field_name FROM $table_name WHERE competition_type = '$competition_type'");
    $new_value = $current_value - 1;
    return $new_value;
}

function updateQuantityInAktivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $field_name = 'quantity';
    $current_value = $wpdb->get_var("SELECT $field_name FROM $table_name WHERE competition_type = '$competition_type'");
    $new_value = $current_value - 1;
    $update = $wpdb->update($table_name, array($field_name => $new_value), array($field_name => $current_value, 'competition_type' => $competition_type));
    return $update;
}

function selectDenniCompetitionIdFromDenniSoutezi($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM {$table_name_denni} WHERE competition_type = '{$competition_type}'");
    return $denni_competition_id;
}

function selectTemplateFromTypSoutezeDaysMails($denni_competition_id)
{
    global $wpdb;
    $table_name_days_mails = $wpdb->prefix . 'typ_souteze_days_mails';
    $vyhra_mail = $wpdb->get_var("SELECT template FROM {$table_name_days_mails} WHERE denni_competition_id = '{$denni_competition_id}'");
    return $vyhra_mail;
}

function selectKontaktIdFromKontaktniUdajeDenni($jmeno, $prijmeni, $email)
{
    global $wpdb;
    $table_name_8 = $wpdb->prefix . 'kontaktni_udaje_denni';
    $query = $wpdb->prepare("SELECT kontakt_id FROM {$table_name_8} WHERE jmeno = %s AND prijmeni = %s AND email = %s", $jmeno, $prijmeni, $email);
    $kontakt_id = $wpdb->get_var($query);
    return $kontakt_id;
}

function selectQuantityFromDenniSoutezi($denni_competition_id)
{
    global $wpdb;
    $field_name = 'quantity';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $current_value = $wpdb->get_var("SELECT $field_name FROM $table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
    return $current_value;
}

function selectTotalQuantityFromDenniSoutezi($denni_competition_id)
{
    global $wpdb;
    $field_name_total = 'total_quantity';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $current_value_total = $wpdb->get_var("SELECT $field_name_total FROM $table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
    return $current_value_total;
}

function updateQuantityAndTotalQuantityIntoDenniSoutezi($denni_competition_id, $new_value, $another_value, $current_value, $current_value_total)
{
    global $wpdb;
    $field_name = 'quantity';
    $field_name_total = 'total_quantity';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $update = $wpdb->update($table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    return $update;
}

function updateQuantityAndTotalQuantityIntoDenniSoutezi2($denni_competition_id, $new_value, $another_value, $current_value, $current_value_total)
{
    global $wpdb;
    $field_name = 'quantity2';
    $field_name_total = 'total_quantity';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $update = $wpdb->update($table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    return $update;
}

function updateQuantityAndTotalQuantityIntoDenniSoutezi3($denni_competition_id, $new_value, $another_value, $current_value, $current_value_total)
{
    global $wpdb;
    $field_name = 'quantity3';
    $field_name_total = 'total_quantity';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $update = $wpdb->update($table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    return $update;
}

function updateQuantityAndTotalQuantityIntoDenniSoutezi4($denni_competition_id, $new_value, $another_value, $current_value, $current_value_total)
{
    global $wpdb;
    $field_name = 'quantity4';
    $field_name_total = 'total_quantity';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $update = $wpdb->update($table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    return $update;
}

function updateQuantityAndTotalQuantityIntoDenniSoutezi5($denni_competition_id, $new_value, $another_value, $current_value, $current_value_total)
{
    global $wpdb;
    $field_name = 'quantity5';
    $field_name_total = 'total_quantity';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $update = $wpdb->update($table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    return $update;
}

function updateQuantityAndTotalQuantityIntoDenniSoutezi6($denni_competition_id, $new_value, $another_value, $current_value, $current_value_total)
{
    global $wpdb;
    $field_name = 'quantity6';
    $field_name_total = 'total_quantity';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $update = $wpdb->update($table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    return $update;
}

function updateQuantityAndTotalQuantityIntoDenniSoutezi7($denni_competition_id, $new_value, $another_value, $current_value, $current_value_total)
{
    global $wpdb;
    $field_name = 'quantity7';
    $field_name_total = 'total_quantity';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $update = $wpdb->update($table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    return $update;
}

function updateQuantityAndTotalQuantityIntoDenniSoutezi8($denni_competition_id, $new_value, $another_value, $current_value, $current_value_total)
{
    global $wpdb;
    $field_name = 'quantity8';
    $field_name_total = 'total_quantity';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $update = $wpdb->update($table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    return $update;
}

function updateQuantityAndTotalQuantityIntoDenniSoutezi9($denni_competition_id, $new_value, $another_value, $current_value, $current_value_total)
{
    global $wpdb;
    $field_name = 'quantity9';
    $field_name_total = 'total_quantity';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $update = $wpdb->update($table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    return $update;
}

function updateQuantityAndTotalQuantityIntoDenniSoutezi10($denni_competition_id, $new_value, $another_value, $current_value, $current_value_total)
{
    global $wpdb;
    $field_name = 'quantity10';
    $field_name_total = 'total_quantity';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $update = $wpdb->update($table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    return $update;
}

function selectQuantityFromHlavniSoutezi($competition_type)
{
    global $wpdb;
    $table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    $field_name = 'quantity';
    $current_value = $wpdb->get_var("SELECT $field_name FROM $table_name_hlavni WHERE competition_type = '$competition_type'");
    $new_value = $current_value - 1;
    $update = $wpdb->update($table_name_hlavni, array($field_name => $new_value), array($field_name => $current_value, 'competition_type' => $competition_type));
    return $update;
}

function deleteCompetitionTypeFromTypSouteze($competition_type)
{
    global $wpdb;
    $table_name_5 = $wpdb->prefix . 'typ_souteze';
    $delete = $wpdb->delete($table_name_5, array('competition_type' => $competition_type));
    return $delete;
}

function deleteCompetitionTypeFromDenniSouteze($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $delete = $wpdb->delete($table_name_denni, array('competition_type' => $competition_type));
    return $delete;
}

function deleteHlavniFromHlavniSouteze()
{
    global $wpdb;
    $table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    $delete = $wpdb->delete($table_name_hlavni, array('nameof' => 'hlavni'));
    return $delete;
}

function selectKontaktIdFromKontaktniUdajeVitezeCopie($jmeno, $prijmeni, $email)
{
    global $wpdb;
    $table_name_winner_copie = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $query = $wpdb->prepare("SELECT kontakt_id FROM {$table_name_winner_copie} WHERE jmeno = %s AND prijmeni = %s AND email = %s", $jmeno, $prijmeni, $email);
    $kontakt_id = $wpdb->get_var($query);
    return $kontakt_id;
}

function selectTemplateFromTypSoutezeMainMails($main_competition_id)
{
    global $wpdb;
    $table_name_main_mails = $wpdb->prefix . 'typ_souteze_main_mails';
    $vyhra_hlavni_mail = $wpdb->get_var("SELECT template FROM {$table_name_main_mails} WHERE main_competition_id = {$main_competition_id}");
    return $vyhra_hlavni_mail;
}
