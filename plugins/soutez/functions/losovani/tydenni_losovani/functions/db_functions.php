<?php

function selectAllFromAktivnySoutez()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    return $wpdb->get_results("SELECT * FROM $table_name");
}

function selectAllFromKontaktniUdajeViteze($competition_type)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze';
    return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name_2 WHERE competition_type = %s", $competition_type));
}

function selectAllFromKontaktniUdajeVitezeWhereCasPlneni($competition_type, $zacatek, $konec)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze';
    return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name_2 WHERE competition_type = %s AND cas_plneni >= %s AND cas_plneni <= %s", $competition_type, $zacatek, $konec));
}

function selectKontaktIdFromPrizeWhereKontaktId($kontakt_id)
{
    global $wpdb;
    $table_name_4 = $wpdb->prefix . 'prize';
    return $wpdb->get_var($wpdb->prepare("SELECT kontakt_id FROM $table_name_4 WHERE kontakt_id = %d", $kontakt_id));
}

function selectDrawIdFromAktivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    return $wpdb->get_var($wpdb->prepare("SELECT draw_id FROM $table_name WHERE competition_type = %s", $competition_type->competition_type));
}

function selectEcomailTemplateIdFromTypSoutezeMails($draw_id)
{
    global $wpdb;
    $table_name_3 = $wpdb->prefix . 'typ_souteze_mails';
    return $wpdb->get_var($wpdb->prepare("SELECT ecomail_template_id FROM $table_name_3 WHERE draw_id = %d", $draw_id));
}

function selectQuantityFromAktivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    return $wpdb->get_var($wpdb->prepare("SELECT quantity FROM $table_name WHERE competition_type = %s", $competition_type->competition_type));
}

function selectKontaktIdFromPrize($kontakt_id)
{
    global $wpdb;
    $table_name_4 = $wpdb->prefix . 'prize';
    return $wpdb->get_var($wpdb->prepare("SELECT kontakt_id FROM $table_name_4 WHERE kontakt_id = %d", $kontakt_id));
}
