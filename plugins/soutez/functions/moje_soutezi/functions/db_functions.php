<?php

function getCompetitionsType()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'typ_souteze';
    $competition_types = $wpdb->get_results("SELECT * FROM $table_name");
    return $competition_types;
}

function getSelectedTypes()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'typ_souteze';
    $selected_types = $wpdb->get_results("SELECT competition_type FROM $table_name");
    return $selected_types;
}

function getCompetitions()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $competitions = $wpdb->get_results("SELECT * FROM $table_name");
    return $competitions;
}

function getDenniCompetitions()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $denni_competitions = $wpdb->get_results("SELECT * FROM $table_name");
    return $denni_competitions;
}

function getHlavniCompetitions()
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'hlavni_soutezi';
    $hlavni_competitions = $wpdb->get_results("SELECT * FROM `$table_name_2` ORDER BY main_competition_id DESC LIMIT 1");
    return $hlavni_competitions;
}
