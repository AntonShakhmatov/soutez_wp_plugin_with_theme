<?php

require_once SOUTEZ_DIR . 'classes/update/update.php';
require_once SOUTEZ_DIR . 'api/ecomail-api.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

class MainMails
{
    private $competition_type;
    private $competition_id;
    private $table_name;
    private $table_name_2;
    private $main_competition_id;

    public function __construct($competition_type)
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'hlavni_soutezi';
        $this->table_name_2 = $wpdb->prefix . 'typ_souteze_main_mails';
        $this->competition_type = $competition_type;
        $this->main_competition_id = $wpdb->get_var("SELECT main_competition_id FROM {$this->table_name} WHERE competition_type = '{$this->competition_type}'");
    }

    public function mailsTemplateMaker()
    {
        $template = $_POST["template"];
        $ecomail_template_id = $_POST["ecomail_template_id"];
        global $wpdb;

        //Получаем запись из первой таблицы
        $existing_record = $wpdb->get_results("SELECT * FROM $this->table_name WHERE competition_type = '{$this->competition_type}'");
        if ($existing_record) {
            $existing_mail = $wpdb->get_row("SELECT main_mails_id FROM $this->table_name_2 WHERE main_competition_id = '{$this->main_competition_id}'");
            if ($existing_mail) {
                //Обновляем запись
                $wpdb->update(
                    $this->table_name_2,
                    array(
                        'ecomail_template_id' => $ecomail_template_id,
                        'template' => $template,
                    ),
                    array('main_mails_id' => $existing_mail->main_mails_id)
                );
            } else {
                // Вставляем новую запись
                $wpdb->insert(
                    $this->table_name_2,
                    array(
                        'ecomail_template_id' => $ecomail_template_id,
                        'template' => $template,
                        'main_competition_id' => $this->main_competition_id,
                    )
                );
            }
        }
    }

    public function mailSender() {}
}
