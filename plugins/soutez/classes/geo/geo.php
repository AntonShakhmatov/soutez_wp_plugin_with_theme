<?php

require_once SOUTEZ_DIR . 'api/ecomail-api.php';
require_once SOUTEZ_DIR . 'classes/confirmation/confirm.php';
require_once 'db_functions.php';
require_once 'email_functions.php';

class Geo
{
    private $geo_link;
    private $email;
    private $name;
    private $surname;
    private $api;
    private $confirmation;
    public function __construct($kontakt_id, $geo_link)
    {
        global $wpdb;
        $this->kontakt_id = $kontakt_id;
        $this->geo_link = $geo_link;
        $this->table_name = $wpdb->prefix . 'kontaktni_udaje';
        $this->email = selectEmailFromKontaktniUdaje($kontakt_id);
        $this->name = selectNameFromKontaktniUdaje($kontakt_id);
        $this->surname = selectSurnameFromKontaktniUdaje($kontakt_id);
        $api_key = $this->api_key = get_option('ecomail_api_key');
        $this->api = new EcomailApi($api_key);
        $this->confirmation = new Confirmation($kontakt_id);
    }

    public function sendGeoTracking()
    {
        send($this->api, $this->email, $this->name, $this->surname, $this->geo_link);

        $this->confirmation->sendConfirmationOfReceipt();
    }
}
