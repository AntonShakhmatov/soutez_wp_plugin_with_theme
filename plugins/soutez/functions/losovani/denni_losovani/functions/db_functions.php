<?php

function getDaysCompetitionTypes()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $competition_types = $wpdb->get_results("SELECT * FROM $table_name");
    return $competition_types;
}

function getViteze($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje_viteze_denni';
    $viteze = $wpdb->get_results("SELECT * FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $viteze;
}

function getCopieViteze()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $copie_viteze_po_obnoveni = $wpdb->get_results("SELECT * FROM $table_name ORDER BY cas_plneni");
    return $copie_viteze_po_obnoveni;
}

function getDenniCompetitionId($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $table_name WHERE competition_type = '{$competition_type->competition_type}'");
    return $denni_competition_id;
}

function getDaysTemplateId($denni_competition_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'typ_souteze_days_mails';
    $template_id = $wpdb->get_var("SELECT ecomail_template_id FROM $table_name WHERE denni_competition_id = $denni_competition_id");
    return $template_id;
}

function getQuantity($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $quantity = $wpdb->get_var("SELECT quantity FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $quantity;
}

function getQuantity2($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $quantity = $wpdb->get_var("SELECT quantity2 FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $quantity;
}

function getQuantity3($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $quantity = $wpdb->get_var("SELECT quantity3 FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $quantity;
}

function getQuantity4($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $quantity = $wpdb->get_var("SELECT quantity4 FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $quantity;
}

function getQuantity5($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $quantity = $wpdb->get_var("SELECT quantity5 FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $quantity;
}

function getQuantity6($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $quantity = $wpdb->get_var("SELECT quantity6 FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $quantity;
}

function getQuantity7($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $quantity = $wpdb->get_var("SELECT quantity7 FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $quantity;
}

function getQuantity8($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $quantity = $wpdb->get_var("SELECT quantity8 FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $quantity;
}

function getQuantity9($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $quantity = $wpdb->get_var("SELECT quantity9 FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $quantity;
}

function getQuantity10($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $quantity = $wpdb->get_var("SELECT quantity10 FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
    return $quantity;
}

function getKontaktId($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM $table_name WHERE competition_type = '$competition_type'");
    return $kontakt_id;
}

function getNameAndSurname($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'uctenka_viteze';
    $kontakt_id = getKontaktId($competition_type);
    $winner = $wpdb->get_var("SELECT jmeno, prijmeni FROM $table_name WHERE kontakt_id = $kontakt_id");
    return $winner;
}
