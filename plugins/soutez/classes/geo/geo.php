<?php

require_once SOUTEZ_DIR . 'api/ecomail-api.php';
require_once SOUTEZ_DIR . 'classes/confirmation/confirm.php';

class Geo
{
    private $kontakt_id;
    private $geo_link;
    private $table_name;
    private $table_test_name;
    private $email;
    private $name;
    private $surname;
    private $api_key;
    private $api;
    private $confirmation;
    public function __construct($kontakt_id, $geo_link)
    {
        global $wpdb;
        $this->kontakt_id = $kontakt_id;
        $this->geo_link = $geo_link;
        $this->table_name = $wpdb->prefix . 'kontaktni_udaje';
        $this->table_test_name = $wpdb->prefix . 'test';
        $this->email = $wpdb->get_var("SELECT email FROM $this->table_name WHERE kontakt_id = $this->kontakt_id");
        $this->name = $wpdb->get_var("SELECT jmeno FROM $this->table_name WHERE kontakt_id = $this->kontakt_id");
        $this->surname = $wpdb->get_var("SELECT prijmeni FROM $this->table_name WHERE kontakt_id = $this->kontakt_id");
        $this->api_key = get_option('ecomail_api_key');
        $this->api = new EcomailApi($this->api_key);
        $this->confirmation = new Confirmation($this->kontakt_id);
    }

    public function sendGeoTracking()
    {
        $this->api->sendTransactionalEmail(
            array(
                'template_id' => 106,
                'subject' => 'Vaš track kod',
                'from_name' => get_option('blogname'),
                'from_email' => get_option('admin_email'),
                'reply_to' => get_option('admin_email'),
                'email' => $this->email,
                'name' => $this->name . ' ' . $this->surname,
                'name' => 'text',
                'content' => $this->geo_link
            ),
            TRUE,
            TRUE
        );

        $this->confirmation->sendConfirmationOfReceipt();
    }
}
