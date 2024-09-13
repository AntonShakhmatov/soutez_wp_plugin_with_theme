<?php

/**
 * Plugin Name: Soutez
 * Description: Plugin pro soutěže
 * Plugin URI:  Ссылка на страницу плагина
 * Author URI:  https://www.facebook.com/profile.php?id=100005206990497
 * Author:      Anton Shakhmatov
 * Version:     1.0
 *
 * Text Domain: ID перевода, указывается в load_plugin_textdomain()
 * Domain Path: Путь до файла перевода.
 * Requires at least: 2.5
 * Requires PHP: >=7.4
 *
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Network:     Укажите "true" для возможности активировать плагин для сети Multisite.
 * Update URI: https://example.com/link_to_update
 */

define('SOUTEZ_DIR', plugin_dir_path(__FILE__));

require_once SOUTEZ_DIR . 'functions.php';
require_once SOUTEZ_DIR . 'forms/edit-contact-form.php';
require_once SOUTEZ_DIR . 'forms/form.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

function update_plugin_tables()
{
    $options_values = array(
        'easy_wp_smtp_initial_version' => '2.2.0',
        'easy_wp_smtp_version' => '2.2.0',
        'easy_wp_smtp' => 'a:3:{s:4:\"mail\";a:5:{s:10:\"from_email\";s:21:\"xshakhmatov@gmail.com\";s:9:\"from_name\";s:4:\"test\";s:6:\"mailer\";s:9:\"sendlayer\";s:16:\"from_email_force\";b:1;s:15:\"from_name_force\";b:0;}s:4:\"smtp\";a:2:{s:7:\"autotls\";b:1;s:4:\"auth\";b:1;}s:7:\"general\";a:2:{s:28:\"domain_check_allowed_domains\";s:9:\"localhost\";s:29:\"summary_report_email_disabled\";b:0;}}',
        'easy_wp_smtp_activated_time' => '1700781384',
        'easy_wp_smtp_activated' => 'a:1:{s:4:\"lite\";i:1700781384;}',
        'action_scheduler_lock_async-request-runner' => '1700781507',
        'easy_wp_smtp_deprecated_options_migration_version' => '1',
        'easy_wp_smtp_migration_version' => '1',
        'easy_wp_smtp_debug_events_db_version' => '1',
        'easy_wp_smtp_activation_prevent_redirect' => '1',
        'easy_wp_smtp_setup_wizard_stats' => 'a:3:{s:13:\"launched_time\";i:1700781407;s:14:\"completed_time\";i:0;s:14:\"was_successful\";b:0;}',
        'easy_wp_smtp_user_feedback_notice' => 'a:2:{s:4:\"time\";i:1700781479;s:9:\"dismissed\";b:0;}',
    );

    foreach ($options_values as $option_name => $option_value) {
        add_option($option_name, $option_value);
    }
}

register_activation_hook(__FILE__, 'update_plugin_tables');

function types_of_competition()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_1 = $wpdb->prefix . 'typ_souteze';
    $sql_1 = "CREATE TABLE $table_name_1 (
        competition_id INT(11) NOT NULL AUTO_INCREMENT,
        competition_type VARCHAR(255) NOT NULL,
        PRIMARY KEY  (competition_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_1);
}

register_activation_hook(__FILE__, 'types_of_competition');

function competition_prize_draw()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_2 = $wpdb->prefix . 'prize_draw';
    $sql_2 = "CREATE TABLE $table_name_2 (
        draw_id INT(11) NOT NULL AUTO_INCREMENT,
        competition_id INT(11) NOT NULL,
        competition_type VARCHAR(255) NOT NULL,
        nameof VARCHAR(255) NOT NULL,
        vyhra VARCHAR(255) NOT NULL,
        quantity INT(11) NOT NULL,
        PRIMARY KEY (draw_id)
    )$charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_2);

    //    $wpdb->query("ALTER TABLE $table_name_2 ADD COLUMN competition_id INT(11) NOT NULL");
    $wpdb->query("ALTER TABLE $table_name_2 ADD FOREIGN KEY (competition_id) REFERENCES {$wpdb->prefix}typ_souteze(competition_id) ON DELETE CASCADE");
}

register_activation_hook(__FILE__, 'competition_prize_draw');

function active_competitions()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_3 = $wpdb->prefix . 'aktivny_soutezi';
    $sql_3 = "CREATE TABLE $table_name_3 (
        active_competition_id INT(11) NOT NULL AUTO_INCREMENT,
        draw_id INT(11) NOT NULL,
        nameof VARCHAR(255) NOT NULL DEFAULT 'tydenni',
        competition_type VARCHAR(255) NOT NULL,
        vyhra VARCHAR(255) NOT NULL,
        quantity INT(11) NOT NULL,
        zacatek DATETIME NOT NULL,
        konec DATETIME NOT NULL,
        PRIMARY KEY  (active_competition_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_3);

    //    $wpdb->query("ALTER TABLE $table_name_3 ADD COLUMN draw_id INT(11) NOT NULL");
    $wpdb->query("ALTER TABLE $table_name_3 ADD FOREIGN KEY (draw_id) REFERENCES {$wpdb->prefix}prize_draw(draw_id) ON DELETE CASCADE");
}

register_activation_hook(__FILE__, 'active_competitions');

function denni_competitions()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_4 = $wpdb->prefix . 'denni_soutezi';
    $sql_4 = "CREATE TABLE $table_name_4 (
        denni_competition_id INT(11) NOT NULL AUTO_INCREMENT,
        active_competition_id INT(11) NOT NULL,
        nameof VARCHAR(255) NOT NULL DEFAULT 'denni',
        competition_type VARCHAR(255) NOT NULL,
        competition_name VARCHAR(255) NOT NULL,
        vyhra VARCHAR(255) NOT NULL,
        vyhra2 VARCHAR(255) NOT NULL,
        vyhra3 VARCHAR(255) NOT NULL,
        vyhra4 VARCHAR(255) NOT NULL,
        vyhra5 VARCHAR(255) NOT NULL,
        vyhra6 VARCHAR(255) NOT NULL,
        vyhra7 VARCHAR(255) NOT NULL,
        vyhra8 VARCHAR(255) NOT NULL,
        vyhra9 VARCHAR(255) NOT NULL,
        vyhra10 VARCHAR(255) NOT NULL,
        quantity INT(11) NOT NULL,
        quantity2 INT(11) NOT NULL,
        quantity3 INT(11) NOT NULL,
        quantity4 INT(11) NOT NULL,
        quantity5 INT(11) NOT NULL,
        quantity6 INT(11) NOT NULL,
        quantity7 INT(11) NOT NULL,
        quantity8 INT(11) NOT NULL,
        quantity9 INT(11) NOT NULL,
        quantity10 INT(11) NOT NULL,
        total_quantity INT(11) NOT NULL,
        zacatek DATETIME NOT NULL,
        konec DATETIME NOT NULL,
        PRIMARY KEY  (denni_competition_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_4);

    //    $wpdb->query("ALTER TABLE $table_name_4 ADD COLUMN active_competition_id INT(11) NOT NULL");
    $wpdb->query("ALTER TABLE $table_name_4 ADD FOREIGN KEY (active_competition_id) REFERENCES {$wpdb->prefix}aktivny_soutezi(active_competition_id)");
}

register_activation_hook(__FILE__, 'denni_competitions');

function main_competitions()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_5 = $wpdb->prefix . 'hlavni_soutezi';
    $sql_5 = "CREATE TABLE $table_name_5 (
        main_competition_id INT(11) NOT NULL AUTO_INCREMENT,
        active_competition_id INT(11) NOT NULL,
        nameof VARCHAR(255) NOT NULL DEFAULT 'hlavni',
        competition_type VARCHAR(255) NOT NULL,
        competition_name VARCHAR(255) NOT NULL,
        vyhra VARCHAR(255) NOT NULL,
        quantity INT(11) NOT NULL,
        zacatek DATETIME NOT NULL,
        konec DATETIME NOT NULL,
        PRIMARY KEY  (main_competition_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_5);

    //    $wpdb->query("ALTER TABLE $table_name_5 ADD COLUMN active_competition_id INT(11) NOT NULL");
    $wpdb->query("ALTER TABLE $table_name_5 ADD FOREIGN KEY (active_competition_id) REFERENCES {$wpdb->prefix}aktivny_soutezi(active_competition_id)");
}

register_activation_hook(__FILE__, 'main_competitions');

function all_contacts_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_6 = $wpdb->prefix . 'kontaktni_udaje';
    $sql_6 = "CREATE TABLE $table_name_6 (
        kontakt_id INT(11) NOT NULL AUTO_INCREMENT,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        telefon VARCHAR(33) NOT NULL,
        psc INT(24) NOT NULL,
        datum_nakupu DATE NOT NULL,
        cas_nakupu TIME NOT NULL,
        cena_nakupu decimal(10,2) NOT NULL,
        cas_plneni DATETIME,
        PRIMARY KEY  (kontakt_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_6);
}

register_activation_hook(__FILE__, 'all_contacts_table');

function all_days_contacts_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_7 = $wpdb->prefix . 'kontaktni_udaje_denni';
    $sql_7 = "CREATE TABLE $table_name_7 (
        kontakt_id INT(11) NOT NULL AUTO_INCREMENT,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        telefon VARCHAR(33) NOT NULL,
        psc INT(24) NOT NULL,
        datum_nakupu DATE NOT NULL,
        cas_nakupu TIME NOT NULL,
        cena_nakupu decimal(10,2) NOT NULL,
        cas_plneni DATETIME,
        PRIMARY KEY  (kontakt_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_7);
}

register_activation_hook(__FILE__, 'all_days_contacts_table');

function all_main_contacts_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_8 = $wpdb->prefix . 'kontaktni_udaje_hlavni';
    $sql_8 = "CREATE TABLE $table_name_8 (
        kontakt_id INT(11) NOT NULL AUTO_INCREMENT,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        telefon VARCHAR(33) NOT NULL,
        psc INT(24) NOT NULL,
        datum_nakupu DATE NOT NULL,
        cas_nakupu TIME NOT NULL,
        cena_nakupu decimal(10,2) NOT NULL,
        cas_plneni DATETIME,
        PRIMARY KEY  (kontakt_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_8);
}

register_activation_hook(__FILE__, 'all_main_contacts_table');

function competitors_check_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_9 = $wpdb->prefix . 'uctenka_viteze';
    $sql_9 = "CREATE TABLE $table_name_9 (
        uctenka_id INT(11) NOT NULL AUTO_INCREMENT,
        kontakt_id INT(11) NOT NULL,
        competition_type VARCHAR(255) NOT NULL,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        vyhra VARCHAR(255) NOT NULL,
        adresa VARCHAR(255) NOT NULL,
        file_link VARCHAR(255) NOT NULL,
        checkbox VARCHAR(255) NOT NULL DEFAULT 'neobdržel',
        FOREIGN KEY (kontakt_id) REFERENCES {$wpdb->prefix}kontaktni_udaje(kontakt_id) ON DELETE CASCADE,
        PRIMARY KEY (uctenka_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_9);
}

register_activation_hook(__FILE__, 'competitors_check_table');

function competition_winners_data_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_10 = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $sql_10 = "CREATE TABLE $table_name_10 (
        vitez_id INT(11) NOT NULL AUTO_INCREMENT,
        -- competition_id INT(11) NOT NULL,
        kontakt_id INT(11) NOT NULL,
        vyhra VARCHAR(255) NOT NULL,
        competition_type VARCHAR(255) NOT NULL,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        telefon VARCHAR(33) NOT NULL,
        email VARCHAR(255) NOT NULL,
        psc INT(24) NOT NULL,
        datum_nakupu DATE NOT NULL,
        cas_nakupu TIME NOT NULL,
        cena_nakupu decimal(10,2) NOT NULL,
        cas_plneni DATETIME,
        PRIMARY KEY  (vitez_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_10);

    //    $wpdb->query("ALTER TABLE $table_name_8 ADD COLUMN kontakt_id INT(11) NOT NULL");
    // $wpdb->query("ALTER TABLE $table_name_8 ADD FOREIGN KEY (competition_id) REFERENCES {$wpdb->prefix}typ_souteze(competition_id) ON DELETE CASCADE");
    $wpdb->query("ALTER TABLE $table_name_10 ADD FOREIGN KEY (kontakt_id) REFERENCES {$wpdb->prefix}kontaktni_udaje(kontakt_id) ON DELETE CASCADE");
    //    $wpdb->query("ALTER TABLE $table_name_8 ADD INDEX cas_plneni_index (cas_plneni ASC)");
}

register_activation_hook(__FILE__, 'competition_winners_data_table');

function competition_prize_sending()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_11 = $wpdb->prefix . 'prize';
    $sql_11 = "CREATE TABLE $table_name_11 (
        prize_id INT(11) NOT NULL AUTO_INCREMENT,
        competition_type VARCHAR(255) NOT NULL,
        kontakt_id INT(11) NOT NULL,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        vyhra VARCHAR(255) NOT NULL,
        link VARCHAR(255) NOT NULL,
        checkbox_column BOOLEAN NOT NULL,
        FOREIGN KEY (kontakt_id) REFERENCES {$wpdb->prefix}kontaktni_udaje(kontakt_id),
        PRIMARY KEY  (prize_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_11);
}

register_activation_hook(__FILE__, 'competition_prize_sending');

function competition_others_data_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_12 = $wpdb->prefix . 'kontaktni_udaje_ostatnich_ucastniku';
    $sql_12 = "CREATE TABLE $table_name_12 (
        ostatni_id INT(11) NOT NULL AUTO_INCREMENT,
        competition_id INT(11) NOT NULL,
        kontakt_id INT(11) NOT NULL,
        competition_type VARCHAR(255) NOT NULL,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        telefon VARCHAR(33) NOT NULL,
        email VARCHAR(255) NOT NULL,
        psc INT(24) NOT NULL,
        datum_nakupu DATE NOT NULL,
        cas_nakupu TIME NOT NULL,
        cena_nakupu decimal(10,2) NOT NULL,
        PRIMARY KEY  (ostatni_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_12);

    //    $wpdb->query("ALTER TABLE $table_name_10 ADD COLUMN competition_id INT(11) NOT NULL");
    $wpdb->query("ALTER TABLE $table_name_12 ADD FOREIGN KEY (competition_id) REFERENCES {$wpdb->prefix}typ_souteze(competition_id) ON DELETE CASCADE");
    $wpdb->query("ALTER TABLE $table_name_12 ADD FOREIGN KEY (kontakt_id) REFERENCES {$wpdb->prefix}kontaktni_udaje(kontakt_id) ON DELETE CASCADE");
}

register_activation_hook(__FILE__, 'competition_others_data_table');

function mail_templates_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_13 = $wpdb->prefix . 'typ_souteze_mails';
    $sql_13 = "CREATE TABLE $table_name_13 (
        mail_id INT(11) NOT NULL AUTO_INCREMENT,
        draw_id INT(11) NOT NULL,
        ecomail_template_id INT(11) NOT NULL,
        template TEXT NOT NULL,
        PRIMARY KEY (mail_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_13);

    //    $wpdb->query("ALTER TABLE $table_name_11 ADD COLUMN draw_id INT(11) NOT NULL");
    $wpdb->query("ALTER TABLE $table_name_13 ADD FOREIGN KEY (draw_id) REFERENCES {$wpdb->prefix}prize_draw(draw_id) ON DELETE CASCADE");
}

register_activation_hook(__FILE__, 'mail_templates_table');

function days_mails_templates_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_14 = $wpdb->prefix . 'typ_souteze_days_mails';
    $sql_14 = "CREATE TABLE $table_name_14 (
        days_mails_id INT(11) NOT NULL AUTO_INCREMENT,
        denni_competition_id INT(11) NOT NULL,
        ecomail_template_id INT(11) NOT NULL,
        template TEXT NOT NULL,
        PRIMARY KEY (days_mails_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_14);

    //    $wpdb->query("ALTER TABLE $table_name_12 ADD COLUMN denni_competition_id INT(11) NOT NULL");
    $wpdb->query("ALTER TABLE $table_name_14 ADD FOREIGN KEY (denni_competition_id) REFERENCES {$wpdb->prefix}denni_soutezi(denni_competition_id) ON DELETE CASCADE");
}

register_activation_hook(__FILE__, 'days_mails_templates_table');


function main_mails_templates_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_15 = $wpdb->prefix . 'typ_souteze_main_mails';
    $sql_15 = "CREATE TABLE $table_name_15 (
        main_mails_id INT(11) NOT NULL AUTO_INCREMENT,
        main_competition_id INT(11) NOT NULL,
        ecomail_template_id INT(11) NOT NULL,
        template TEXT NOT NULL,
        PRIMARY KEY (main_mails_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_15);

    //    $wpdb->query("ALTER TABLE $table_name_13 ADD COLUMN main_competition_id INT(11) NOT NULL");
    $wpdb->query("ALTER TABLE $table_name_15 ADD FOREIGN KEY (main_competition_id) REFERENCES {$wpdb->prefix}hlavni_soutezi(main_competition_id) ON DELETE CASCADE");
}

register_activation_hook(__FILE__, 'main_mails_templates_table');


function competition_winners_data_table_copie()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_16 = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
    $sql_16 = "CREATE TABLE $table_name_16 (
        vitez_copie_id INT(11) NOT NULL AUTO_INCREMENT,
        -- competition_id INT(11) NOT NULL,
        kontakt_id INT(11) NOT NULL,
        vyhra VARCHAR(255) NOT NULL,
        competition_type VARCHAR(255) NOT NULL,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        telefon VARCHAR(33) NOT NULL,
        email VARCHAR(255) NOT NULL,
        psc INT(24) NOT NULL,
        datum_nakupu DATE NOT NULL,
        cas_nakupu TIME NOT NULL,
        cena_nakupu decimal(10,2) NOT NULL,
        cas_plneni DATETIME,
        PRIMARY KEY  (vitez_copie_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_16);

    //    $wpdb->query("ALTER TABLE $table_name_14 ADD COLUMN kontakt_id INT(11) NOT NULL");
    // $wpdb->query("ALTER TABLE $table_name_8 ADD FOREIGN KEY (competition_id) REFERENCES {$wpdb->prefix}typ_souteze(competition_id) ON DELETE CASCADE");
    $wpdb->query("ALTER TABLE $table_name_16 ADD FOREIGN KEY (kontakt_id) REFERENCES {$wpdb->prefix}kontaktni_udaje(kontakt_id) ON DELETE CASCADE");
    //    $wpdb->query("ALTER TABLE $table_name_8 ADD INDEX cas_plneni_index (cas_plneni ASC)");
}

register_activation_hook(__FILE__, 'competition_winners_data_table_copie');


function competition_winners_data_table_denni()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_17 = $wpdb->prefix . 'kontaktni_udaje_viteze_denni';
    $sql_17 = "CREATE TABLE $table_name_17 (
        vitez_denni_id INT(11) NOT NULL AUTO_INCREMENT,
        kontakt_id INT(11) NOT NULL,
        vyhra VARCHAR(255) NOT NULL,
        competition_type VARCHAR(255) NOT NULL,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        telefon VARCHAR(33) NOT NULL,
        email VARCHAR(255) NOT NULL,
        psc INT(24) NOT NULL,
        datum_nakupu DATE NOT NULL,
        cas_nakupu TIME NOT NULL,
        cena_nakupu decimal(10,2) NOT NULL,
        cas_plneni DATETIME,
        PRIMARY KEY  (vitez_denni_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_17);

    //    $wpdb->query("ALTER TABLE $table_name_15 ADD COLUMN kontakt_id INT(11) NOT NULL");
    // $wpdb->query("ALTER TABLE $table_name_8 ADD FOREIGN KEY (competition_id) REFERENCES {$wpdb->prefix}typ_souteze(competition_id) ON DELETE CASCADE");
    $wpdb->query("ALTER TABLE $table_name_17 ADD FOREIGN KEY (kontakt_id) REFERENCES {$wpdb->prefix}kontaktni_udaje(kontakt_id) ON DELETE CASCADE");
    //    $wpdb->query("ALTER TABLE $table_name_8 ADD INDEX cas_plneni_index (cas_plneni ASC)");
}

register_activation_hook(__FILE__, 'competition_winners_data_table_denni');


function competition_winners_data_table_main()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_18 = $wpdb->prefix . 'kontaktni_udaje_viteze_main';
    $sql_18 = "CREATE TABLE $table_name_18 (
        vitez_main_id INT(11) NOT NULL AUTO_INCREMENT,
        kontakt_id INT(11) NOT NULL,
        vyhra VARCHAR(255) NOT NULL,
        competition_type VARCHAR(255) NOT NULL,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        telefon VARCHAR(33) NOT NULL,
        email VARCHAR(255) NOT NULL,
        psc INT(24) NOT NULL,
        datum_nakupu DATE NOT NULL,
        cas_nakupu TIME NOT NULL,
        cena_nakupu decimal(10,2) NOT NULL,
        cas_plneni DATETIME,
        PRIMARY KEY  (vitez_main_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_18);

    //    $wpdb->query("ALTER TABLE $table_name_16 ADD COLUMN kontakt_id INT(11) NOT NULL");
    // $wpdb->query("ALTER TABLE $table_name_8 ADD FOREIGN KEY (competition_id) REFERENCES {$wpdb->prefix}typ_souteze(competition_id) ON DELETE CASCADE");
    $wpdb->query("ALTER TABLE $table_name_18 ADD FOREIGN KEY (kontakt_id) REFERENCES {$wpdb->prefix}kontaktni_udaje(kontakt_id) ON DELETE CASCADE");
    //    $wpdb->query("ALTER TABLE $table_name_8 ADD INDEX cas_plneni_index (cas_plneni ASC)");
}

register_activation_hook(__FILE__, 'competition_winners_data_table_main');


function competitors_winners_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_19 = $wpdb->prefix . 'viteze';
    $sql_19 = "CREATE TABLE $table_name_19 (
        winner_uctenka_id INT(11) NOT NULL AUTO_INCREMENT,
        kontakt_id INT(11) NOT NULL,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        adresa VARCHAR(255) NOT NULL,
        checkbox INT(1) NOT NULL,
        FOREIGN KEY (kontakt_id) REFERENCES {$wpdb->prefix}kontaktni_udaje(kontakt_id) ON DELETE CASCADE,
        PRIMARY KEY (winner_uctenka_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_19);
}

register_activation_hook(__FILE__, 'competitors_winners_table');


function weeks_contacts_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_20 = $wpdb->prefix . 'kontaktni_udaje_tydenni';
    $sql_20 = "CREATE TABLE $table_name_20 (
        kontakt_id INT(11) NOT NULL AUTO_INCREMENT,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        telefon VARCHAR(33) NOT NULL,
        psc INT(24) NOT NULL,
        datum_nakupu DATE NOT NULL,
        cas_nakupu TIME NOT NULL,
        cena_nakupu decimal(10,2) NOT NULL,
        cas_plneni DATETIME,
        PRIMARY KEY  (kontakt_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_20);
}

register_activation_hook(__FILE__, 'weeks_contacts_table');


function competition_days_prize_sending()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_21 = $wpdb->prefix . 'prize_for_day';
    $sql_21 = "CREATE TABLE $table_name_21 (
        prize_id INT(11) NOT NULL AUTO_INCREMENT,
        competition_type VARCHAR(255) NOT NULL,
        kontakt_id INT(11) NOT NULL,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        vyhra VARCHAR(255) NOT NULL,
        link VARCHAR(255) NOT NULL,
        checkbox_column BOOLEAN NOT NULL,
        FOREIGN KEY (kontakt_id) REFERENCES {$wpdb->prefix}kontaktni_udaje(kontakt_id),
        PRIMARY KEY  (prize_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_21);
}

register_activation_hook(__FILE__, 'competition_days_prize_sending');


function competition_main_prize_sending()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name_22 = $wpdb->prefix . 'prize_for_main';
    $sql_22 = "CREATE TABLE $table_name_22 (
        prize_id INT(11) NOT NULL AUTO_INCREMENT,
        competition_type VARCHAR(255) NOT NULL,
        kontakt_id INT(11) NOT NULL,
        jmeno VARCHAR(255) NOT NULL,
        prijmeni VARCHAR(255) NOT NULL,
        vyhra VARCHAR(255) NOT NULL,
        link VARCHAR(255) NOT NULL,
        checkbox_column BOOLEAN NOT NULL,
        FOREIGN KEY (kontakt_id) REFERENCES {$wpdb->prefix}kontaktni_udaje(kontakt_id),
        PRIMARY KEY  (prize_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_22);
}

register_activation_hook(__FILE__, 'competition_main_prize_sending');

//Funkce přesměruje každého uživatele, který není administratorem, na přihlašovací stránku WordPress.
function restrict_plugin_access()
{
    if (is_admin() && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX)) {
        $redirect_to = wp_login_url();
        wp_safe_redirect($redirect_to);
        exit;
    }
}
add_action('admin_init', 'restrict_plugin_access');


add_action('wp_ajax_sendMail', 'sendMail');
//add_action('wp_ajax_nopriv_hello', 'say_hello');

function sendMail()
{
    global $wpdb;

    if (empty($_POST['email'])) {
        echo 'Empty';
        wp_die();
    } else {
        $competition_type = sanitize_text_field($_POST['competition_type']);
        $vyhra = sanitize_text_field($_POST['vyhra']);
        $name = sanitize_text_field($_POST['name']);
        $surname = sanitize_text_field($_POST['surname']);
        $email = sanitize_email($_POST['email']);

        $table_name = $wpdb->prefix . 'denni_soutezi';
        $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $table_name WHERE competition_type = '{$competition_type}'");
        $table_name_2 = $wpdb->prefix . 'typ_souteze_days_mails';
        $template_id = $wpdb->get_var("SELECT ecomail_template_id FROM $table_name_2 WHERE denni_competition_id = $denni_competition_id");

        $vyhra1 = $wpdb->get_var("SELECT vyhra FROM $table_name WHERE competition_type = '$competition_type'");
        $vyhra2 = $wpdb->get_var("SELECT vyhra2 FROM $table_name WHERE competition_type = '$competition_type'");
        $vyhra3 = $wpdb->get_var("SELECT vyhra3 FROM $table_name WHERE competition_type = '$competition_type'");
        $vyhra4 = $wpdb->get_var("SELECT vyhra4 FROM $table_name WHERE competition_type = '$competition_type'");
        $vyhra5 = $wpdb->get_var("SELECT vyhra5 FROM $table_name WHERE competition_type = '$competition_type'");
        $vyhra6 = $wpdb->get_var("SELECT vyhra6 FROM $table_name WHERE competition_type = '$competition_type'");
        $vyhra7 = $wpdb->get_var("SELECT vyhra7 FROM $table_name WHERE competition_type = '$competition_type'");
        $vyhra8 = $wpdb->get_var("SELECT vyhra8 FROM $table_name WHERE competition_type = '$competition_type'");
        $vyhra9 = $wpdb->get_var("SELECT vyhra9 FROM $table_name WHERE competition_type = '$competition_type'");
        $vyhra10 = $wpdb->get_var("SELECT vyhra10 FROM $table_name WHERE competition_type = '$competition_type'");

        $quantity = $wpdb->get_var("SELECT total_quantity FROM $table_name WHERE competition_type = '$competition_type'");
        $quantity1 = $wpdb->get_var("SELECT quantity FROM $table_name WHERE competition_type = '$competition_type'");
        $quantity2 = $wpdb->get_var("SELECT quantity2 FROM $table_name WHERE competition_type = '$competition_type'");
        $quantity3 = $wpdb->get_var("SELECT quantity3 FROM $table_name WHERE competition_type = '$competition_type'");
        $quantity4 = $wpdb->get_var("SELECT quantity4 FROM $table_name WHERE competition_type = '$competition_type'");
        $quantity5 = $wpdb->get_var("SELECT quantity5 FROM $table_name WHERE competition_type = '$competition_type'");
        $quantity6 = $wpdb->get_var("SELECT quantity6 FROM $table_name WHERE competition_type = '$competition_type'");
        $quantity7 = $wpdb->get_var("SELECT quantity7 FROM $table_name WHERE competition_type = '$competition_type'");
        $quantity8 = $wpdb->get_var("SELECT quantity8 FROM $table_name WHERE competition_type = '$competition_type'");
        $quantity9 = $wpdb->get_var("SELECT quantity9 FROM $table_name WHERE competition_type = '$competition_type'");
        $quantity10 = $wpdb->get_var("SELECT quantity10 FROM $table_name WHERE competition_type = '$competition_type'");

        $update = new Update($competition_type);
        $result = $update->sendDaysTransactionMails($competition_type, $template_id, $vyhra, $name, $surname, $email);

        if ($vyhra == $vyhra1) {
            if ($quantity <= 1) {
                $update->deleteDaysTypeOfCompetition($template_id);
            } else {
                if ($template_id !== NULL && $template_id !== '') {
                    $update->changeQuantityOfDaysCompetition();
                    if ($quantity1 <= 1) {
                        $wpdb->update(
                            $table_name,
                            array(
                                'vyhra' => ''
                            ),
                            array(
                                'competition_type' => $competition_type
                            )
                        );
                    }
                } else {
                    echo "template_id chybí. Přidat mužete v položce menu Maily Denni";
                }
            }
        }

        if ($vyhra == $vyhra2) {
            if ($quantity <= 1) {
                $update->deleteDaysTypeOfCompetition($template_id);
            } else {
                if ($template_id !== NULL && $template_id !== '') {
                    $update->changeQuantityOfDaysCompetition2();
                    if ($quantity2 <= 1) {
                        $wpdb->update(
                            $table_name,
                            array(
                                'vyhra2' => ''
                            ),
                            array(
                                'competition_type' => $competition_type
                            )
                        );
                    }
                } else {
                    echo "template_id chybí. Přidat mužete v položce menu Maily Denni";
                }
            }
        }

        if ($vyhra == $vyhra3) {
            if ($quantity <= 1) {
                $update->deleteDaysTypeOfCompetition($template_id);
            } else {
                if ($template_id !== NULL && $template_id !== '') {
                    $update->changeQuantityOfDaysCompetition3();
                    if ($quantity3 <= 1) {
                        $wpdb->update(
                            $table_name,
                            array(
                                'vyhra3' => ''
                            ),
                            array(
                                'competition_type' => $competition_type
                            )
                        );
                    }
                } else {
                    echo "template_id chybí. Přidat mužete v položce menu Maily Denni";
                }
            }
        }

        if ($vyhra == $vyhra4) {
            if ($quantity <= 1) {
                $update->deleteDaysTypeOfCompetition($template_id);
            } else {
                if ($template_id !== NULL && $template_id !== '') {
                    $update->changeQuantityOfDaysCompetition4();
                    if ($quantity4 <= 1) {
                        $wpdb->update(
                            $table_name,
                            array(
                                'vyhra4' => ''
                            ),
                            array(
                                'competition_type' => $competition_type
                            )
                        );
                    }
                } else {
                    echo "template_id chybí. Přidat mužete v položce menu Maily Denni";
                }
            }
        }

        if ($vyhra == $vyhra5) {
            if ($quantity <= 1) {
                $update->deleteDaysTypeOfCompetition($template_id);
            } else {
                if ($template_id !== NULL && $template_id !== '') {
                    $update->changeQuantityOfDaysCompetition5();
                    if ($quantity5 <= 1) {
                        $wpdb->update(
                            $table_name,
                            array(
                                'vyhra5' => ''
                            ),
                            array(
                                'competition_type' => $competition_type
                            )
                        );
                    }
                } else {
                    echo "template_id chybí. Přidat mužete v položce menu Maily Denni";
                }
            }
        }

        if ($vyhra == $vyhra6) {
            if ($quantity <= 1) {
                $update->deleteDaysTypeOfCompetition($template_id);
            } else {
                if ($template_id !== NULL && $template_id !== '') {
                    $update->changeQuantityOfDaysCompetition6();
                    if ($quantity6 <= 1) {
                        $wpdb->update(
                            $table_name,
                            array(
                                'vyhra6' => ''
                            ),
                            array(
                                'competition_type' => $competition_type
                            )
                        );
                    }
                } else {
                    echo "template_id chybí. Přidat mužete v položce menu Maily Denni";
                }
            }
        }

        if ($vyhra == $vyhra7) {
            if ($quantity <= 1) {
                $update->deleteDaysTypeOfCompetition($template_id);
            } else {
                if ($template_id !== NULL && $template_id !== '') {
                    $update->changeQuantityOfDaysCompetition7();
                    if ($quantity7 <= 1) {
                        $wpdb->update(
                            $table_name,
                            array(
                                'vyhra7' => ''
                            ),
                            array(
                                'competition_type' => $competition_type
                            )
                        );
                    }
                } else {
                    echo "template_id chybí. Přidat mužete v položce menu Maily Denni";
                }
            }
        }

        if ($vyhra == $vyhra8) {
            if ($quantity <= 1) {
                $update->deleteDaysTypeOfCompetition($template_id);
            } else {
                if ($template_id !== NULL && $template_id !== '') {
                    $update->changeQuantityOfDaysCompetition8();
                    if ($quantity8 <= 1) {
                        $wpdb->update(
                            $table_name,
                            array(
                                'vyhra8' => ''
                            ),
                            array(
                                'competition_type' => $competition_type
                            )
                        );
                    }
                } else {
                    echo "template_id chybí. Přidat mužete v položce menu Maily Denni";
                }
            }
        }

        if ($vyhra == $vyhra9) {
            if ($quantity <= 1) {
                $update->deleteDaysTypeOfCompetition($template_id);
            } else {
                if ($template_id !== NULL && $template_id !== '') {
                    $update->changeQuantityOfDaysCompetition9();
                    if ($quantity9 <= 1) {
                        $wpdb->update(
                            $table_name,
                            array(
                                'vyhra9' => ''
                            ),
                            array(
                                'competition_type' => $competition_type
                            )
                        );
                    }
                } else {
                    echo "template_id chybí. Přidat mužete v položce menu Maily Denni";
                }
            }
        }

        if ($vyhra == $vyhra10) {
            if ($quantity <= 1) {
                $update->deleteDaysTypeOfCompetition($template_id);
            } else {
                if ($template_id !== NULL && $template_id !== '') {
                    $update->changeQuantityOfDaysCompetition10();
                    if ($quantity10 <= 1) {
                        $wpdb->update(
                            $table_name,
                            array(
                                'vyhra10' => ''
                            ),
                            array(
                                'competition_type' => $competition_type
                            )
                        );
                    }
                } else {
                    echo "template_id chybí. Přidat mužete v položce menu Maily Denni";
                }
            }
        }

        $update->createDaysPageWithEndpoint($competition_type, $name, $surname, $email, $vyhra);

        if ($result) {
            echo 'Success';
        } else {
            echo 'Error';
        }
    }

    wp_die(); // Завершаем выполнение
}
