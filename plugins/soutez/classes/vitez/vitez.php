<?php

require_once SOUTEZ_DIR . 'classes/update/update.php';
require_once SOUTEZ_DIR . 'functions/maily/functions/mail.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

class Vitez
{
    public function __construct() {}

    public function sendTransactionEmail($data = array(), $click_tracking = TRUE, $open_tracking = TRUE)
    {
        global $wpdb;
        // Název tabulky v databázi
        $table_name = $wpdb->prefix . 'prize';

        // Data pro vložení
        $insert_data = array(
            'competition_type' => $data['competition_type'],
            'kontakt_id' => $data['kontakt_id'],
            'jmeno' => $data['jmeno'],
            'prijmeni' => $data['prijmeni'],
            'vyhra' => $data['vyhra'],
            'link' => $data['link'],
            'checkbox_column' => $data['checkbox_column']
        );

        // Vložení dat do databáze
        $wpdb->insert($table_name, $insert_data);

        // Pokud vložení proběhlo úspěšně, pokračujeme s odesláním emailu
        if ($wpdb->insert_id) {
            // Pokračujeme s odesláním emailu pomocí existujícího kódu
            echo "Odesláno.";
        } else {
            // Chyba při ukládání dat do databáze
            echo "Chyba při ukládání dat do databáze";
        }
    }

    public function sendDaysTransactionEmail($data = array(), $click_tracking = TRUE, $open_tracking = TRUE)
    {
        global $wpdb;
        // Název tabulky v databázi
        $table_name = $wpdb->prefix . 'prize_for_day';

        // Data pro vložení
        $insert_data = array(
            'competition_type' => $data['competition_type'],
            'kontakt_id' => $data['kontakt_id'],
            'jmeno' => $data['jmeno'],
            'prijmeni' => $data['prijmeni'],
            'vyhra' => $data['vyhra'],
            'link' => $data['link'],
            'checkbox_column' => $data['checkbox_column']
        );

        // Vložení dat do databáze
        $wpdb->insert($table_name, $insert_data);

        // Pokud vložení proběhlo úspěšně, pokračujeme s odesláním emailu
        if ($wpdb->insert_id) {
            // Pokračujeme s odesláním emailu pomocí existujícího kódu
            echo "Odesláno.";
        } else {
            // Chyba při ukládání dat do databáze
            echo "Chyba při ukládání dat do databáze";
        }
    }


    public function sendMainTransactionEmail($data = array(), $click_tracking = TRUE, $open_tracking = TRUE)
    {
        global $wpdb;
        // Název tabulky v databázi
        $table_name = $wpdb->prefix . 'prize_for_main';

        // Data pro vložení
        $insert_data = array(
            'competition_type' => $data['competition_type'],
            'kontakt_id' => $data['kontakt_id'],
            'jmeno' => $data['jmeno'],
            'prijmeni' => $data['prijmeni'],
            'vyhra' => $data['vyhra'],
            'link' => $data['link'],
            'checkbox_column' => $data['checkbox_column']
        );

        // Vložení dat do databáze
        $wpdb->insert($table_name, $insert_data);

        // Pokud vložení proběhlo úspěšně, pokračujeme s odesláním emailu
        if ($wpdb->insert_id) {
            // Pokračujeme s odesláním emailu pomocí existujícího kódu
            echo "Odesláno.";
        } else {
            // Chyba při ukládání dat do databáze
            echo "Chyba při ukládání dat do databáze";
        }
    }
}
