<?php

function getAktivnySouteziTable()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    return $table_name;
}

function getTableNameDenni()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    return $table_name;
}

function getTableNameHlavni()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hlavni_soutezi';
    return $table_name;
}

function getKontaktniUdajeVitezeTable()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje_viteze';
    return $table_name;
}

function getKontaktniUdajeVitezeCopieTable()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    return $table_name;
}

function getTypSoutezeTable()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'typ_souteze';
    return $table_name;
}

function getCompetitionId($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'typ_souteze';
    $competition_id = $wpdb->get_var("SELECT competition_id FROM {$table_name} WHERE competition_type = '{$competition_type}'");
    return $competition_id;
}

function getDrawId($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'prize_draw';
    $draw_id = $wpdb->get_var("SELECT draw_id FROM {$table_name} WHERE competition_type = '{$competition_type}'");
    return $draw_id;
}

function getRandomWinner()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje';
    $random_winner = $wpdb->get_results("SELECT * FROM {$table_name} ORDER BY RAND() LIMIT 1");
    return $random_winner;
}

function getWinners($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $viteze = $wpdb->get_results("SELECT * FROM {$table_name} WHERE competition_type = '{$competition_type}'");
    return $viteze;
}

function getWin($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $vyhra = $wpdb->get_var("SELECT vyhra FROM {$table_name} WHERE competition_type = '{$competition_type}'");
    return $vyhra;
}

function getDayWins($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $vyhra_denni = $wpdb->get_var("SELECT vyhra FROM {$table_name_denni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_denni;
}

function getMainWins($competition_type)
{
    global $wpdb;
    $table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    $vyhra_hlavni = $wpdb->get_var("SELECT vyhra FROM {$table_name_hlavni} WHERE competition_type = '{$competition_type}'");
    return $vyhra_hlavni;
}

function getMailWins($draw_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'typ_souteze_mails';
    $vyhra_mail = $wpdb->get_var("SELECT template FROM {$table_name} WHERE draw_id = '{$draw_id}'");
    return $vyhra_mail;
}

function getTemplateId($draw_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'typ_souteze_mails';
    $template_id = $wpdb->get_var("SELECT ecomail_template_id FROM {$table_name} WHERE draw_id = '{$draw_id}'");
    return $template_id;
}

function getEmail($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $email = $wpdb->get_var("SELECT email FROM {$table_name} WHERE competition_type = '{$competition_type}'");
    return $email;
}

function getCopyEmail($competition_type)
{
    global $wpdb;
    $table_name_winner_copie = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $copie_email = $wpdb->get_var("SELECT email FROM {$table_name_winner_copie} WHERE competition_type = '{$competition_type}'");
    return $copie_email;
}

function getName($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $name = $wpdb->get_var("SELECT jmeno FROM {$table_name} WHERE competition_type = '{$competition_type}'");
    return $name;
}

function getSurname($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $surname = $wpdb->get_var("SELECT prijmeni FROM {$table_name} WHERE competition_type = '{$competition_type}'");
    return $surname;
}

function getKontaktId($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM {$table_name} WHERE competition_type = '{$competition_type}'");
    return $kontakt_id;
}

function getCopyName($competition_type)
{
    global $wpdb;
    $table_name_winner_copie = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $copie_name = $wpdb->get_var("SELECT jmeno FROM {$table_name_winner_copie} WHERE competition_type = '{$competition_type}'");
    return $copie_name;
}

function getCopySurname($competition_type)
{
    global $wpdb;
    $table_name_winner_copie = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $copie_surname = $wpdb->get_var("SELECT prijmeni FROM {$table_name_winner_copie} WHERE competition_type = '{$competition_type}'");
    return $copie_surname;
}

function getCopyKontaktId($competition_type)
{
    global $wpdb;
    $table_name_winner_copie = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $copie_kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM {$table_name_winner_copie} WHERE competition_type = '{$competition_type}'");
    return $copie_kontakt_id;
}

function getExistingRecords($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'typ_souteze';
    $existing_record = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$table_name` WHERE competition_type = %s", $competition_type));
    return $existing_record;
}

function getUpdateOrInsertForCompetitionType($existing_record, $competition_type, $competition_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'typ_souteze';
    if ($existing_record) {
        //Update new entry
        $wpdb->update(
            $table_name,
            array(
                'competition_type' => $competition_type,
            ),
            array('competition_id' => $competition_id)
        );
    } else {
        //Insert new entryaddCompetitionTypeWithoutTimer
        $wpdb->insert(
            $table_name,
            array(
                'competition_type' => $competition_type,
            )
        );
    }
}

function getUpdateOrInsertForCompetitionTypeWithTimer($existing_prize, $vyhra, $quantity, $competition_type, $competition_id, $existing_competition, $zahajeni, $konec)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $table_name_2 = $wpdb->prefix . 'prize_draw';
    if ($existing_prize) {
        //Update an existing entry
        $wpdb->update(
            $table_name_2,
            array(
                'vyhra' => $vyhra,
                'quantity' => $quantity,
                'competition_type' => $competition_type
            ),
            array(
                'competition_id' => $competition_id,
            )
        );
    } else {
        //Insert new entry
        $wpdb->insert(
            $table_name_2,
            array(
                'competition_id' => $competition_id,
                'competition_type' => $competition_type,
                'vyhra' => $vyhra,
                'quantity' => $quantity
            )
        );
    }

    $draw_id = $wpdb->insert_id;

    if (!$existing_competition) {
        $wpdb->insert(
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
    }
}

function getExistingPrize($competition_type)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'prize_draw';
    $existing_prize = $wpdb->get_var($wpdb->prepare("SELECT * FROM `$table_name_2` WHERE competition_type = %s", $competition_type));
    return $existing_prize;
}

function getExistingCompetitions($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $existing_competition = $wpdb->get_var($wpdb->prepare("SELECT * FROM `$table_name` WHERE competition_type = %s", $competition_type));
    return $existing_competition;
}

function getExistingWins($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $existing_vyhra = $wpdb->get_var($wpdb->prepare("SELECT `vyhra` FROM `$table_name` WHERE competition_type = %s", $competition_type));
    return $existing_vyhra;
}

function getExistingDayRecords($competition_type)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $existing_denni_record = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$table_name_denni` WHERE competition_type = %s", $competition_type));
    return $existing_denni_record;
}

function getStartTime($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $zahajeni = $wpdb->get_var("SELECT zacatek FROM `$table_name` WHERE competition_type = '$competition_type'");
    return $zahajeni;
}

function getEndTime($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $konec = $wpdb->get_var("SELECT konec FROM `$table_name` WHERE competition_type = '$competition_type'");
    return $konec;
}

function getActiveCompetitionId($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $active_competition_id = $wpdb->get_var("SELECT active_competition_id FROM `$table_name` WHERE competition_type = '$competition_type'");
    return $active_competition_id;
}

function getUpdateOrInsertForDividing($existing_denni_record, $startOfDay, $endOfDay, $active_competition_id, $competition_type, $i)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    if ($existing_denni_record) {
        //Update an existing entry
        $wpdb->update(
            $table_name_denni,
            array(
                'zacatek' => $startOfDay,
                'konec' => $endOfDay,
            ),
            array(
                'active_competition_id' => $active_competition_id,
            )
        );
    } else {
        $wpdb->insert(
            $table_name_denni,
            array(
                'active_competition_id' => $active_competition_id,
                'competition_type' => $competition_type . '_' . $i . '_den',
                'competition_name' =>  $i . '_den_' . $competition_type . '_' . $i . '_den',
                'zacatek' => $startOfDay,
                'konec' => $endOfDay
            )
        );
    }
}

function getExistingHlavniRecord($competition_type)
{
    global $wpdb;
    $table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    $existing_hlavni_record = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$table_name_hlavni` WHERE competition_type = %s", $competition_type));
    return $existing_hlavni_record;
}

function getQuery()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $query = "SELECT MIN(zacatek) as first_zacatek, MAX(konec) as last_konec FROM $table_name";
    return $query;
}

function getConditionForDivideByAllTime($existing_hlavni_record, $active_competition_id, $firstZacatek, $lastKonec, $competition_type)
{
    global $wpdb;
    $table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    if ($existing_hlavni_record) {
        //Update an existing entry
        $wpdb->update(
            $table_name_hlavni,
            array(
                'active_competition_id' => $active_competition_id,
                'competition_name' => 'Hlavní losování',
            ),
            array(
                'zacatek' => $firstZacatek,
                'konec' => $lastKonec,
            )
        );
    } else {
        //Insert new entry
        $wpdb->insert(
            $table_name_hlavni,
            array(
                'active_competition_id' => $active_competition_id,
                'competition_type' => 'hlavni_losovani_' . $competition_type,
                'competition_name' => 'Hlavní losování',
                'zacatek' => $firstZacatek,
                'konec' => $lastKonec
            )
        );
    }
}

function removeCompetitionTypeFirst($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    return $wpdb->delete($table_name, array('competition_type' => $competition_type));
}

function removeCompetitionTypeSecond($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'prize_draw';
    return $wpdb->delete($table_name, array('competition_type' => $competition_type));
}

function getActiveCompetitionIdDenni()
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $active_competition_id_denni = $wpdb->get_var("SELECT active_competition_id FROM `$table_name_denni`");
    return $active_competition_id_denni;
}

function getDenniActiveCompetitionId($active_competition_id_denni)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $active_competition_id = $wpdb->get_results("SELECT * FROM `$table_name` WHERE active_competition_id = $active_competition_id_denni");
    return $active_competition_id;
}

function getDeleteFromDenni($active_competition_id_denni)
{
    global $wpdb;
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $wpdb->delete($table_name_denni, array('active_competition_id' => $active_competition_id_denni));
}

function getUpdateForRemoveByAllTime($active_competition_id, $competition_type, $firstZacatek, $lastKonec)
{
    global $wpdb;
    $table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    $wpdb->update(
        $table_name_hlavni,
        array(
            'active_competition_id' => $active_competition_id,
            'competition_type' => $competition_type,
            'competition_name' => 'Hlavní losování',
        ),
        array(
            'zacatek' => $firstZacatek,
            'konec' => $lastKonec,
        )
    );
}

function getResults()
{
    global $wpdb;
    $table_name = getKontaktniUdajeVitezeTable();
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY cas_plneni ASC, RAND()");
    return $results;
}

function getCurrentValue($competition_type)
{
    global $wpdb;
    $field_name = 'quantity';
    $table_name = getAktivnySouteziTable();
    $current_value = $wpdb->get_var("SELECT $field_name FROM $table_name WHERE competition_type = '$competition_type'");
    return $current_value;
}

function getDenniCompetitionIdU($competition_type)
{
    global $wpdb;
    $table_name = getTableNameDenni();
    $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $table_name WHERE competition_type = '{$competition_type}'");
    return $denni_competition_id;
}

function getCurrentValueU($denni_competition_id)
{
    global $wpdb;
    $field_name = 'quantity';
    $table_name = getTableNameDenni();
    $current_value = $wpdb->get_var("SELECT $field_name FROM $table_name WHERE denni_competition_id = '$denni_competition_id'");
    return $current_value;
}

function getMainCurrentValue($competition_type)
{
    global $wpdb;
    $table_name = getTableNameHlavni();
    $field_name = 'quantity';
    $current_value = $wpdb->get_var("SELECT $field_name FROM $table_name WHERE competition_type = '$competition_type'");
}
