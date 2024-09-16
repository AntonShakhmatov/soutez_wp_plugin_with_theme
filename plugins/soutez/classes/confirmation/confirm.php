<?php

require_once SOUTEZ_DIR . 'api/ecomail-api.php';
require_once SOUTEZ_DIR . 'forms/confirm-form.php';

require_once 'db_functions.php';
require_once 'email_functions.php';

class Confirmation
{
    private $kontakt_id;
    private $email;
    private $name;
    private $surname;
    private $api_key;
    private $api;
    public function __construct($kontakt_id)
    {
        global $wpdb;
        $this->kontakt_id = $kontakt_id;
        $this->email = selectEmailFromKonraktniUdaje($kontakt_id);
        $this->name = selectNameFromKonraktniUdaje($kontakt_id);
        $this->surname = selectSurnameFromKonraktniUdaje($kontakt_id);
        $this->api_key = get_option('ecomail_api_key');
        $this->api = new EcomailApi($this->api_key);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function renderForm()
    {
        $PageGuid = get_option('siteurl') . "/index.php" . "/confirm-" . $this->name . '-' . $this->surname . '-' . $this->kontakt_id;

        ob_start();
        include 'form_template.php'; // Путь к файлу шаблона
        $post_content = ob_get_clean();

        $my_post = array(
            'post_title'     => 'Form for ' . $this->name . ' ' . $this->surname,
            'post_type'      => 'page',
            'post_name'      => 'confirm-' . $this->name . '-' . $this->surname . '-' . $this->kontakt_id,
            'post_content'   => $post_content,
            'post_status'    => 'publish',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
            'post_author'    => 1,
            'menu_order'     => 0,
            'guid'           => $PageGuid,
            'meta_input' => [
                '_generate-disable-top-bar' => true,
                '_generate-disable-header' => true,
                '_generate-disable-nav' => true,
                '_generate-disable-secondary-nav' => true,
                '_generate-disable-post-image' => true,
                '_generate-disable-headline' => true,
                '_generate-disable-footer' => true,
            ]
        );
        $PageID = wp_insert_post($my_post, false);
    }

    public function sendConfirmationOfReceipt()
    {
        apiSendTransactionEmailConfirmation($this->api, $this->email, $this->name, $this->surname, $this->kontakt_id);
    }
}
