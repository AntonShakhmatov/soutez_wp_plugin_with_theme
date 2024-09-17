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

function selectDrawIdFromAktivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $draw_id = $wpdb->get_var("SELECT draw_id FROM {$table_name} WHERE competition_type = '{$competition_type}'");
    return $draw_id;
}

function selectAllFromAktivnySoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $existing_record = $wpdb->get_results("SELECT * FROM $table_name WHERE competition_type = '{$competition_type}'");
    return $existing_record;
}

function selectMailIdFromTypSoutezeMails($draw_id)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'typ_souteze_mails';
    $select = $wpdb->get_row("SELECT mail_id FROM $table_name_2 WHERE draw_id = '{$draw_id}'");
    return $select;
}

function updateMailIdInTypSoutezeMails($ecomail_template_id, $template, $mail_id)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'typ_souteze_mails';
    $update = $wpdb->update(
        $table_name_2,
        array(
            'ecomail_template_id' => $ecomail_template_id,
            'template' => $template,
        ),
        array('mail_id' => $mail_id)
    );
    return $update;
}

function insertEcomailTemplateIdTemplateDrawIdIntoTypSoutezeMails($ecomail_template_id, $template, $draw_id)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'typ_souteze_mails';
    $insert = $wpdb->insert(
        $table_name_2,
        array(
            'ecomail_template_id' => $ecomail_template_id,
            'template' => $template,
            'draw_id' => $draw_id,
        )
    );
    return $insert;
}

function selectAllFromDenniSoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $existing_records = $wpdb->get_results("SELECT * FROM $table_name WHERE competition_type = '{$competition_type}'");
    return $existing_records;
}

function selectAllFromTypSoutezeDaysMails($denni_competition_id)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'typ_souteze_days_mails';
    $existing_mail = $wpdb->get_row("SELECT * FROM $table_name_2 WHERE denni_competition_id = '{$denni_competition_id}'");
    return $existing_mail;
}

function updateDenniCompetitionIdInTypSoutezeDaysMails($ecomail_template_id, $template, $invisible)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'typ_souteze_days_mails';
    $update = $wpdb->update(
        $table_name_2,
        array(
            'ecomail_template_id' => $ecomail_template_id,
            'template' => $template,
        ),
        array('denni_competition_id' => $invisible)
    );
    return $update;
}

function insertEcomailTemplateIdTemplateDenniCompetitionIdIntoTypSoutezeDaysMails($ecomail_template_id, $template, $invisible)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'typ_souteze_days_mails';
    $insert = $wpdb->insert(
        $table_name_2,
        array(
            'ecomail_template_id' => $ecomail_template_id,
            'template' => $template,
            'denni_competition_id' => $invisible,
        )
    );
    return $insert;
}

function selectDenniCompetitionIdFromDenniSoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'denni_soutezi';
    $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM {$table_name} WHERE competition_type = '{$competition_type}'");
    return $denni_competition_id;
}

function selectMainCompetitionIdFromHlavniSoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hlavni_soutezi';
    $main_competition_id = $wpdb->get_var("SELECT main_competition_id FROM {$table_name} WHERE competition_type = '{$competition_type}'");
    return $main_competition_id;
}

function selectAllFromHlavniSoutezi($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'hlavni_soutezi';
    $existing_record = $wpdb->get_results("SELECT * FROM $table_name WHERE competition_type = '{$competition_type}'");
    return $existing_record;
}

function selectMainMailsIdFromTypSoutezeMainMails($main_competition_id)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'typ_souteze_main_mails';
    $existing_mail = $wpdb->get_row("SELECT main_mails_id FROM $table_name_2 WHERE main_competition_id = '{$main_competition_id}'");
    return $existing_mail;
}

function updateMainMailsIdIntoTypSoutezeMainMails($ecomail_template_id, $template, $main_mails_id)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'typ_souteze_main_mails';
    $update = $wpdb->update(
        $table_name_2,
        array(
            'ecomail_template_id' => $ecomail_template_id,
            'template' => $template,
        ),
        array('main_mails_id' => $main_mails_id)
    );
    return $update;
}

function insertEcomailTemplateIdTemplateMainCompetitionId($ecomail_template_id, $template, $main_competition_id)
{
    global $wpdb;
    $table_name_2 = $wpdb->prefix . 'typ_souteze_main_mails';
    $insert = $wpdb->insert(
        $table_name_2,
        array(
            'ecomail_template_id' => $ecomail_template_id,
            'template' => $template,
            'main_competition_id' => $main_competition_id,
        )
    );
    return $insert;
}
