<?php

function selectEmailFromKontaktniUdaje($kontakt_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje';
    $email = $wpdb->get_var("SELECT email FROM $table_name WHERE kontakt_id = $kontakt_id");
    return $email;
}

function selectNameFromKontaktniUdaje($kontakt_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje';
    $name = $wpdb->get_var("SELECT jmeno FROM $table_name WHERE kontakt_id = $kontakt_id");
    return $name;
}

function selectSurnameFromKontaktniUdaje($kontakt_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje';
    $surname = $wpdb->get_var("SELECT prijmeni FROM $table_name WHERE kontakt_id = $kontakt_id");
    return $surname;
}
