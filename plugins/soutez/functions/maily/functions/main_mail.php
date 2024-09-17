<?php

require_once SOUTEZ_DIR . 'classes/update/update.php';
require_once SOUTEZ_DIR . 'api/ecomail-api.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

class MainMails
{
    private $competition_type;
    private $main_competition_id;

    public function __construct($competition_type)
    {
        $this->competition_type = $competition_type;
        $this->main_competition_id = selectMainCompetitionIdFromHlavniSoutezi($competition_type);
    }

    public function mailsTemplateMaker()
    {
        $template = $_POST["template"];
        $ecomail_template_id = $_POST["ecomail_template_id"];

        //Получаем запись из первой таблицы
        $existing_record = selectAllFromHlavniSoutezi($this->competition_type);
        if ($existing_record) {
            $existing_mail = selectMainMailsIdFromTypSoutezeMainMails($this->main_competition_id);
            if ($existing_mail) {
                //Обновляем запись
                updateMainMailsIdIntoTypSoutezeMainMails(
                    $ecomail_template_id,
                    $template,
                    $existing_mail->main_mails_id
                );
            } else {
                // Вставляем новую запись
                insertEcomailTemplateIdTemplateMainCompetitionId(
                    $ecomail_template_id,
                    $template,
                    $this->main_competition_id
                );
            }
        }
    }

    public function mailSender() {}
}
