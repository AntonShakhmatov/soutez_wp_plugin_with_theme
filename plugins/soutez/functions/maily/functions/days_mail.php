<?php

require_once SOUTEZ_DIR . 'classes/update/update.php';
require_once SOUTEZ_DIR . 'api/ecomail-api.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

class DaysMails
{
    private $competition_type;
    private $competition_id;
    private $table_name;
    private $table_name_2;
    private $denni_competition_id;

    public function __construct($competition_type)
    {
        global $wpdb;
        //        $this->wpdb = $wpdb;
        $this->table_name = $wpdb->prefix . 'denni_soutezi';
        $this->table_name_2 = $wpdb->prefix . 'typ_souteze_days_mails';
        $this->competition_type = $competition_type;
        $this->denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM {$this->table_name} WHERE competition_type = '{$this->competition_type}'");
    }

    public function mailsTemplateMaker()
    {
        global $wpdb;
        $template = $_POST["template"];
        $template_invisible = $_POST["invisible"];
        // $template = $_POST[$this->competition_type->denni_competition_id];
        $ecomail_template_id = $_POST["ecomail_template_id"];
        //Получаем запись из первой таблицы
        foreach ($template_invisible as $invisible) {
            $existing_records = $wpdb->get_results("SELECT * FROM $this->table_name WHERE competition_type = '{$this->competition_type}'");
            if ($existing_records) {
                // foreach($existing_records as $existing_record) {
                $existing_mail = $wpdb->get_row("SELECT * FROM $this->table_name_2 WHERE denni_competition_id = '{$existing_records[0]->denni_competition_id}'");
                if ($existing_mail) {
                    //Обновляем запись
                    $wpdb->update(
                        $this->table_name_2,
                        array(
                            'ecomail_template_id' => $ecomail_template_id,
                            'template' => $template,
                        ),
                        array('denni_competition_id' => $invisible)
                    );
                } else {
                    // Вставляем новую запись
                    $wpdb->insert(
                        $this->table_name_2,
                        array(
                            'ecomail_template_id' => $ecomail_template_id,
                            'template' => $template,
                            'denni_competition_id' => $invisible,
                        )
                    );
                }
                // }
            }
        }
    }

    public function mailSender() {}
}
