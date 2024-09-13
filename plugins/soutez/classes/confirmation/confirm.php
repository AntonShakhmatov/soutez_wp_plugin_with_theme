<?php

require_once SOUTEZ_DIR . 'api/ecomail-api.php';
require_once SOUTEZ_DIR . 'forms/confirm-form.php';

class Confirmation
{
    private $kontakt_id;
    private $table_name;
    private $email;
    private $name;
    private $surname;
    private $api_key;
    private $api;
    public function __construct($kontakt_id)
    {
        global $wpdb;
        $this->kontakt_id = $kontakt_id;
        $this->table_name = $wpdb->prefix . 'kontaktni_udaje';
        $this->email = $wpdb->get_var("SELECT email FROM $this->table_name WHERE kontakt_id = $this->kontakt_id");
        $this->name = $wpdb->get_var("SELECT jmeno FROM $this->table_name WHERE kontakt_id = $this->kontakt_id");
        $this->surname = $wpdb->get_var("SELECT prijmeni FROM $this->table_name WHERE kontakt_id = $this->kontakt_id");
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
        $post_content = '
        <style>
            header.wp-block-template-part {
                display: none;
            }
            footer.wp-block-template-part {
                display: none;
            }
        </style>
        <form action="process_form.php" method="post">
        <input type="hidden" name="kontakt_id" value="' . $this->kontakt_id . '">
        <input type="checkbox" name="checkbox_confirm" value="1"> Klikněte a potvrďte pokud jste dostali dárek <br>
        <input id="confirm_action" name="confirm_action" type="submit" value="Poslat potvrzeni">
        </form>
        ';

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
        $formContent = $this->renderForm();

        $this->api->sendTransactionalEmail(
            array(
                'template_id' => 75,
                'subject' => 'Confirm that you have received the prize',
                'from_name' => get_option('blogname'),
                'from_email' => get_option('admin_email'),
                'reply_to' => get_option('admin_email'),
                'email' => $this->email,
                'name' => $this->name . ' ' . $this->surname,
                'name' => 'text',
                'content' => "<br>Váš odkaz:" . get_option('siteurl') . "/index.php" . "/confirm-" . $this->name . '-' . $this->surname . '-' . $this->kontakt_id
            ),
            TRUE,
            TRUE
        );
    }
}
