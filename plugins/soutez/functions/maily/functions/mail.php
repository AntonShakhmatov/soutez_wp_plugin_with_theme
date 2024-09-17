<?php

require_once SOUTEZ_DIR . 'classes/update/update.php';
require_once SOUTEZ_DIR . 'api/ecomail-api.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

require_once 'db_functions.php';

class Mail
{
    private $competition_type;
    private $draw_id;

    public function __construct($competition_type)
    {
        $this->draw_id = selectDrawIdFromAktivnySoutezi($competition_type);
    }

    public function mailsTemplateMaker()
    {
        $template = $_POST["template"];
        $ecomail_template_id = $_POST["ecomail_template_id"];

        //Получаем запись из первой таблицы
        $existing_record = selectAllFromAktivnySoutezi($this->competition_type);
        if ($existing_record) {
            $existing_mail = selectMailIdFromTypSoutezeMails($this->draw_id);
            if ($existing_mail) {
                //Обновляем запись
                updateMailIdInTypSoutezeMails(
                    $ecomail_template_id,
                    $template,
                    $existing_mail->mail_id
                );
            } else {
                // Вставляем новую запись
                insertEcomailTemplateIdTemplateDrawIdIntoTypSoutezeMails(
                    $ecomail_template_id,
                    $template,
                    $this->draw_id
                );
            }
        }
    }

    public function mailSender() {}
}
