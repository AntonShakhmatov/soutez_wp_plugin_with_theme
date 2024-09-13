<?php

global $wpdb;
$table_name = $wpdb->prefix . 'hlavni_soutezi';
//$table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze';
$table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze_main';
$table_name_3 = $wpdb->prefix . 'typ_souteze_main_mails';
// $firstDayOfCompetition = $wpdb->get_var("SELECT MIN(zacatek) FROM $table_name");

function getLastDayOfCompetition()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hlavni_soutezi';
    $lastDayOfCompetition = $wpdb->get_var("SELECT MAX(konec) FROM $table_name");
    return $lastDayOfCompetition;
}

function getCompetitionMainTypes($lastDayOfCompetition)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hlavni_soutezi';
    $competition_types = $wpdb->get_results("SELECT * FROM $table_name WHERE `konec` = '$lastDayOfCompetition'");
    return $competition_types;
}

function getHlavniVitez($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje_viteze_main';
    $viteze = $wpdb->get_results("SELECT * FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $viteze;
}

function getMainWinnerAfterRefresh($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje_viteze_main';
    $viteze_po_obnoveni = $wpdb->get_results("SELECT * FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $viteze_po_obnoveni;
}

function getMainCompetitionId($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hlavni_soutezi';
    $main_competition_id = $wpdb->get_var("SELECT main_competition_id FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $main_competition_id;
}

function getMaxDate()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hlavni_soutezi';
    $query = "SELECT MAX(konec) as last_konec FROM $table_name";
    $result = $wpdb->get_row($query);
    $lastKonec = $result->last_konec;
    return $lastKonec;
}

function getMainTemplateId($main_competition_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'typ_souteze_main_mails';
    $template_id = $wpdb->get_var("SELECT ecomail_template_id FROM $table_name WHERE main_competition_id = $main_competition_id");
    return $template_id;
}

function getQuantityMain($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hlavni_soutezi';
    $quantity = $wpdb->get_var("SELECT quantity FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $quantity;
}
