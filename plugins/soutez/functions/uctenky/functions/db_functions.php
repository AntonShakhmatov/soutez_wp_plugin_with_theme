<?php

function selectAllFromUctenkaViteze()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'uctenka_viteze';
    $winners = $wpdb->get_results(
        "
    SELECT *
    FROM $table_name
    "
    );
    return $winners;
}
