<?php

function selectAllFromKontaktniUdaje()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'kontaktni_udaje';
    $subscribers = $wpdb->get_results(
        "
        SELECT *
        FROM $table_name
        "
    );
    return $subscribers;
}
