<?php

function selectAllFromViteze()
{
    global $wpdb;
    //    $table_name = $wpdb->prefix . 'prize';
    $table_name = $wpdb->prefix . 'viteze';
    $subscribers = $wpdb->get_results(
        "
        SELECT *
        FROM $table_name
        "
    );
    return $subscribers;
}
