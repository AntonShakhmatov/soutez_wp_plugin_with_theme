<?php

require_once SOUTEZ_DIR . 'classes/update/update.php';
require_once SOUTEZ_DIR . 'api/ecomail-api.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

class Mail
{
    private $competition_type;
    private $table_name;
    private $table_name_2;
    private $draw_id;

    public function __construct($competition_type)
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'aktivny_soutezi';
        $this->table_name_2 = $wpdb->prefix . 'typ_souteze_mails';
        $this->competition_type = $competition_type;
        $this->draw_id = $wpdb->get_var("SELECT draw_id FROM {$this->table_name} WHERE competition_type = '{$this->competition_type}'");
    }

    public function mailsTemplateMaker()
    {
        global $wpdb;
        $template = $_POST["template"];
        $ecomail_template_id = $_POST["ecomail_template_id"];

        //Получаем запись из первой таблицы
        $existing_record = $wpdb->get_results("SELECT * FROM $this->table_name WHERE competition_type = '{$this->competition_type}'");
        if ($existing_record) {
            $existing_mail = $wpdb->get_row("SELECT mail_id FROM $this->table_name_2 WHERE draw_id = '{$this->draw_id}'");
            if ($existing_mail) {
                //Обновляем запись
                $wpdb->update(
                    $this->table_name_2,
                    array(
                        'ecomail_template_id' => $ecomail_template_id,
                        'template' => $template,
                    ),
                    array('mail_id' => $existing_mail->mail_id)
                );
            } else {
                // Вставляем новую запись
                $wpdb->insert(
                    $this->table_name_2,
                    array(
                        'ecomail_template_id' => $ecomail_template_id,
                        'template' => $template,
                        'draw_id' => $this->draw_id,
                    )
                );
            }
        }
    }

    public function mailSender() {}
}
