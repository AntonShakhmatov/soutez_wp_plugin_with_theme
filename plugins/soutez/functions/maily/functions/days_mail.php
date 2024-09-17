<?php

require_once SOUTEZ_DIR . 'classes/update/update.php';
require_once SOUTEZ_DIR . 'api/ecomail-api.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

class DaysMails
{
    private $competition_type;

    public function __construct($competition_type)
    {
        $this->competition_type = $competition_type;
        $this->denni_competition_id = selectDenniCompetitionIdFromDenniSoutezi($competition_type);
    }

    public function mailsTemplateMaker()
    {
        $template = $_POST["template"];
        $template_invisible = $_POST["invisible"];
        // $template = $_POST[$this->competition_type->denni_competition_id];
        $ecomail_template_id = $_POST["ecomail_template_id"];
        //Получаем запись из первой таблицы
        foreach ($template_invisible as $invisible) {
            $existing_records = selectAllFromDenniSoutezi($this->competition_type);
            if ($existing_records) {
                // foreach($existing_records as $existing_record) {
                $existing_mail = selectAllFromTypSoutezeDaysMails($existing_records[0]->denni_competition_id);
                if ($existing_mail) {
                    //Обновляем запись
                    updateDenniCompetitionIdInTypSoutezeDaysMails(
                        $ecomail_template_id,
                        $template,
                        $invisible
                    );
                } else {
                    // Вставляем новую запись
                    insertEcomailTemplateIdTemplateDenniCompetitionIdIntoTypSoutezeDaysMails(
                        $ecomail_template_id,
                        $template,
                        $invisible
                    );
                }
            }
        }
    }

    public function mailSender() {}
}
