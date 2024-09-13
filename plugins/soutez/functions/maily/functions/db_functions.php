<?php

//tydenni mailing

function getCompetitionTypes()
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'aktivny_soutezi';
    $competition_types = $wpdb->get_results("SELECT * FROM $table_name_2", OBJECT);
    return $competition_types;
}

function getWeekDrawId($competition_type)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'aktivny_soutezi';
    $draw_id = $wpdb->get_var("SELECT draw_id FROM $table_name_2 WHERE competition_type = '$competition_type'");
    return $draw_id;
}

function getWeekTemplate($draw_id)
{
    global $wpdb;
    $table_name_3 = $wpdb->prefix . 'typ_souteze_mails';
    $template = $wpdb->get_var("SELECT template FROM $table_name_3 WHERE draw_id = $draw_id");
    return $template;
}

function getWeekTemplateId($draw_id)
{
    global $wpdb;
    $table_name_3 = $wpdb->prefix . 'typ_souteze_mails';
    $ecomail_template_id = $wpdb->get_var("SELECT ecomail_template_id FROM $table_name_3 WHERE draw_id = $draw_id");
    return $ecomail_template_id;
}

function getDayCompetitionTypes()
{
    global $wpdb;
    $table_name_4 = $wpdb->prefix . 'denni_soutezi';
    $competition_denni_types = $wpdb->get_results("SELECT * FROM $table_name_4", OBJECT);
    return $competition_denni_types;
}

function getDaysCompetitionId($competition_denni_type)
{
    global $wpdb;
    $table_name_4 = $wpdb->prefix . 'denni_soutezi';
    $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $table_name_4 WHERE competition_type = $competition_denni_type");
    return $denni_competition_id;
}

function getDayTemplate($denni_competition_id)
{
    global $wpdb;
    $table_name_5 = $wpdb->prefix . 'typ_souteze_days_mails';
    $template = $wpdb->get_var("SELECT template FROM $table_name_5 WHERE denni_competition_id = $denni_competition_id");
    return $template;
}

function getDayTemplateId($denni_competition_id)
{
    global $wpdb;
    $table_name_5 = $wpdb->prefix . 'typ_souteze_days_mails';
    $ecomail_template_id = $wpdb->get_var("SELECT ecomail_template_id FROM $table_name_5 WHERE denni_competition_id = $denni_competition_id");
    return $ecomail_template_id;
}

function getMainCompetitionTypes()
{
    global $wpdb;
    $table_name_6 = $wpdb->prefix . 'hlavni_soutezi';
    $competition_main_types = $wpdb->get_results("SELECT *
        FROM $table_name_6
        WHERE main_competition_id = (SELECT MAX(main_competition_id) FROM $table_name_6)");
    return $competition_main_types;
}

function getHlavniCompetitionId($competition_main_type)
{
    global $wpdb;
    $table_name_7 = $wpdb->prefix . 'typ_souteze_main_mails';
    $main_competition_id = $wpdb->get_var("SELECT main_competition_id FROM $table_name_7 WHERE competition_type = $competition_main_type");
    return $main_competition_id;
}

function getHlavniTemplate($main_competition_id)
{
    global $wpdb;
    $table_name_7 = $wpdb->prefix . 'typ_souteze_main_mails';
    $template = $wpdb->get_var("SELECT template FROM $table_name_7 WHERE main_competition_id = $main_competition_id");
    return $template;
}

function getHlavniTemplateId($main_competition_id)
{
    global $wpdb;
    $table_name_7 = $wpdb->prefix . 'typ_souteze_main_mails';
    $ecomail_template_id = $wpdb->get_var("SELECT ecomail_template_id FROM $table_name_7 WHERE main_competition_id = $main_competition_id");
    return $ecomail_template_id;
}
