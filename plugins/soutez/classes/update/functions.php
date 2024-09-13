<?php
function addCompetitionType($competition_type, $competition_id)
{
    $competition_type = str_replace(" ", "_", $competition_type);
    $existing_record = getExistingRecords($competition_type);

    getUpdateOrInsertForCompetitionType($existing_record, $competition_type, $competition_id);
}

//Moje soutěží menu function for timer
function addCompetitionTypeWithTimer($competition_type, $competition_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $table_name_2 = $wpdb->prefix . 'prize_draw';
    $vyhra = $_POST["vyhra"];
    $quantity = $_POST["numberof"];
    $zahajeni = $_POST["zahajeni"];
    $konec = $_POST["konec"];

    $existing_prize = getExistingPrize($competition_type);

    $existing_competition = getExistingCompetitions($competition_type);

    $existing_vyhra = getExistingWins($competition_type);

    getUpdateOrInsertForCompetitionTypeWithTimer($existing_prize, $vyhra, $quantity, $competition_type, $competition_id, $existing_competition, $zahajeni, $konec);
}

function divideByDayTime($competition_type)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $table_name_denni = $wpdb->prefix . 'denni_soutezi';
    $existing_denni_record = getExistingDayRecords($competition_type);
    $zahajeni = getStartTime($competition_type);
    $konec = getEndTime($competition_type);
    $active_competition_id = getActiveCompetitionId($competition_type);

    $start = new DateTime($zahajeni);
    $end = new DateTime($konec);

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($start, $interval, $end);

    $i = 1;
    foreach ($daterange as $date) {
        $startOfDay = $date->format('Y-m-d 00:00:00');
        $endOfDay = $date->format('Y-m-d 23:59:59');
        getUpdateOrInsertForDividing($existing_denni_record, $startOfDay, $endOfDay, $active_competition_id, $competition_type, $i);
        $i++;
    }
}

function divideByAllTime($competition_type)
{
    global $wpdb;
    $table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
    $existing_hlavni_record = getExistingHlavniRecord($competition_type);

    // Составление SQL-запроса для выбора самого первого значения из поля 'zacatek' и самого последнего значения из поля 'konec'
    $query = getQuery();
    //$active_competition_id = $wpdb->get_var("SELECT active_competition_id FROM `$table_name` WHERE competition_type = '$competition_type'");
    $active_competition_id = getActiveCompetitionId($competition_type);
    // Выполнение запроса и получение результата
    $result = $wpdb->get_row($query);

    $firstZacatek = $result->first_zacatek;
    $lastKonec = $result->last_konec;

    getConditionForDivideByAllTime($existing_hlavni_record, $active_competition_id, $firstZacatek, $lastKonec, $competition_type);
}

function removeCompetitionTypeWithTimer($competition_type)
{
    removeCompetitionTypeFirst($competition_type);
    removeCompetitionTypeSecond($competition_type);
}

function removeByDayTime()
{
    $active_competition_id_denni = getActiveCompetitionIdDenni();
    $active_competition_id = getDenniActiveCompetitionId($active_competition_id_denni);
    if (empty($active_competition_id)) {
        getDeleteFromDenni($active_competition_id_denni);
    }
}

function removeByAllTime($competition_type)
{
    global $wpdb;
    // Составление SQL-запроса для выбора самого первого значения из поля 'zacatek' и самого последнего значения из поля 'konec'
    $query = getQuery();
    $active_competition_id = getActiveCompetitionId($competition_type);

    // Выполнение запроса и получение результата
    $result = $wpdb->get_row($query);

    $firstZacatek = $result->first_zacatek;
    $lastKonec = $result->last_konec;
    getUpdateForRemoveByAllTime($active_competition_id, $competition_type, $firstZacatek, $lastKonec);
}

//Losování menu function tydenni
function insertDatabase($random_winner, $vyhra, $competition_type)
{
    global $wpdb;
    $table_name = getKontaktniUdajeVitezeTable();
    $wpdb->insert(
        $table_name,
        array(
            'kontakt_id' => $random_winner[0]->kontakt_id,
            'vyhra' => $vyhra,
            'competition_type' => $competition_type,
            'jmeno' => $random_winner[0]->jmeno,
            'prijmeni' => $random_winner[0]->prijmeni,
            'telefon' => $random_winner[0]->telefon,
            'email' => $random_winner[0]->email,
            'psc' => $random_winner[0]->psc,
            'datum_nakupu' => $random_winner[0]->datum_nakupu,
            'cas_nakupu' => $random_winner[0]->cas_nakupu,
            'cena_nakupu' => $random_winner[0]->cena_nakupu,
            'cas_plneni' => $random_winner[0]->cas_plneni
        )
    );
}

//Losování menu function tydenni
function updateDatabase($random_winner, $vyhra, $competition_type)
{
    global $wpdb;
    $table_name = getKontaktniUdajeVitezeTable();
    $wpdb->update(
        $table_name,
        array(
            'kontakt_id' => $random_winner[0]->kontakt_id,
            'vyhra' => $vyhra,
            'competition_type' => $competition_type,
            'jmeno' => $random_winner[0]->jmeno,
            'prijmeni' => $random_winner[0]->prijmeni,
            'telefon' => $random_winner[0]->telefon,
            'email' => $random_winner[0]->email,
            'psc' => $random_winner[0]->psc,
            'datum_nakupu' => $random_winner[0]->datum_nakupu,
            'cas_nakupu' => $random_winner[0]->cas_nakupu,
            'cena_nakupu' => $random_winner[0]->cena_nakupu,
            'cas_plneni' => $random_winner[0]->cas_plneni
        ),
        array('competition_type' => $competition_type)
    );
}

//Losování menu function denni
function insertDatabaseDenni($random_winner, $vyhra_denni, $competition_type)
{
    global $wpdb;
    $table_name = getKontaktniUdajeVitezeTable();
    foreach ($random_winner as $winner) {
        $wpdb->insert($table_name, array(
            'kontakt_id' => $winner->kontakt_id,
            'vyhra' => $vyhra_denni,
            'competition_type' => $competition_type,
            'jmeno' => $winner->jmeno,
            'prijmeni' => $winner->prijmeni,
            'telefon' => $winner->telefon,
            'email' => $winner->email,
            'psc' => $winner->psc,
            'datum_nakupu' => $winner->datum_nakupu,
            'cas_nakupu' => $winner->cas_nakupu,
            'cena_nakupu' => $winner->cena_nakupu,
            'cas_plneni' => $winner->cas_plneni
        ));
    }
}

//Losování menu function denni
function updateDatabaseDenni($random_winner, $vyhra_denni, $competition_type)
{
    global $wpdb;
    $table_name = getKontaktniUdajeVitezeTable();
    foreach ($random_winner as $winner) {
        $wpdb->update(
            $table_name,
            array(
                'kontakt_id' => $winner->kontakt_id,
                'vyhra' => $vyhra_denni,
                'competition_type' => $competition_type,
                'jmeno' => $winner->jmeno,
                'prijmeni' => $winner->prijmeni,
                'telefon' => $winner->telefon,
                'email' => $winner->email,
                'psc' => $winner->psc,
                'datum_nakupu' => $winner->datum_nakupu,
                'cas_nakupu' => $winner->cas_nakupu,
                'cena_nakupu' => $winner->cena_nakupu,
                'cas_plneni' => $winner->cas_plneni
            ),
            array(
                'competition_type' => $competition_type,
            )
        );
    }
}

function copyAndSortData()
{
    global $wpdb;
    $table_name = getKontaktniUdajeVitezeCopieTable();
    // Очистить таблицу перед копированием данных
    $wpdb->query("TRUNCATE TABLE $table_name");
    $results = getResults();
    foreach ($results as $result) {
        $wpdb->insert($table_name, array(
            'kontakt_id' => $result->kontakt_id,
            'vyhra' => $result->vyhra,
            'competition_type' => $result->competition_type,
            'competition_type_asc_ordering' => $result->competition_type,
            'jmeno' => $result->jmeno,
            'prijmeni' => $result->prijmeni,
            'telefon' => $result->telefon,
            'email' => $result->email,
            'psc' => $result->psc,
            'datum_nakupu' => $result->datum_nakupu,
            'cas_nakupu' => $result->cas_nakupu,
            'cena_nakupu' => $result->cena_nakupu,
            'cas_plneni' => $result->cas_plneni
        ));
    }
}

//Losování menu function hlavni
function insertDatabaseHlavni($random_winner, $vyhra_hlavni, $competition_type)
{
    global $wpdb;
    $table_name = getKontaktniUdajeVitezeTable();
    $wpdb->insert(
        $table_name,
        array(
            // 'competition_id' => $this->competition_id,
            'kontakt_id' => $random_winner[0]->kontakt_id,
            'vyhra' => $vyhra_hlavni,
            'competition_type' => $competition_type,
            'jmeno' => $random_winner[0]->jmeno,
            'prijmeni' => $random_winner[0]->prijmeni,
            'telefon' => $random_winner[0]->telefon,
            'email' => $random_winner[0]->email,
            'psc' => $random_winner[0]->psc,
            'datum_nakupu' => $random_winner[0]->datum_nakupu,
            'cas_nakupu' => $random_winner[0]->cas_nakupu,
            'cena_nakupu' => $random_winner[0]->cena_nakupu,
            'cas_plneni' => $random_winner[0]->cas_plneni
        )
    );
}

//Losování menu function hlavni
function updateDatabaseHlavni($random_winner, $vyhra_hlavni, $competition_type)
{
    global $wpdb;
    $table_name = getKontaktniUdajeVitezeTable();
    $wpdb->update(
        $table_name,
        array(
            'kontakt_id' => $random_winner[0]->kontakt_id,
            'vyhra' => $vyhra_hlavni,
            'competition_type' => $competition_type,
            'jmeno' => $random_winner[0]->jmeno,
            'prijmeni' => $random_winner[0]->prijmeni,
            'telefon' => $random_winner[0]->telefon,
            'email' => $random_winner[0]->email,
            'psc' => $random_winner[0]->psc,
            'datum_nakupu' => $random_winner[0]->datum_nakupu,
            'cas_nakupu' => $random_winner[0]->cas_nakupu,
            'cena_nakupu' => $random_winner[0]->cena_nakupu,
            'cas_plneni' => $random_winner[0]->cas_plneni
        ),
        array('competition_type' => $competition_type)
    );
}

//Losování menu function
function sendTransactionMails($api, $template_id, $vyhra, $email, $name, $surname, $vyhra_mail, $kontakt_id, $vitez,)
{
    //Здесь будут отправляться транзакционные имэйлы
    $api->sendTransactionalEmail(
        array(
            'template_id' => $template_id,
            'subject' => 'Vyhral\a jste ' . $vyhra,
            'from_name' => get_option('blogname'),
            'from_email' => '',
            'reply_to' => '',
            'email' => $email,
            'name' => $name . ' ' . $surname,
            'name' => 'text',
            'content' => $vyhra_mail . "<br>Váš odkaz:" . get_option('siteurl') . "/index.php" . "/my-page-" . $name . '-' . $surname . '-' . $kontakt_id
        ),
        TRUE,
        TRUE
    );

    if (!empty($template_id)) {
        $vitez->sendTransactionEmail(array(
            'kontakt_id' => $kontakt_id,
            'jmeno' => $name,
            'prijmeni' => $surname,
            'vyhra' => $vyhra,
            'link' => get_option('siteurl') . "/index.php" . "/my-page-" . $name . '-' . $surname . '-' . $kontakt_id, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
            'checkbox_column' => '',
        ));
    } else {
        echo "template_id chybí. Přidat mužete v položce menu Maily";
    }
}

//Losování menu function
function sendDaysTransactionMails($api, $template_id, $vyhra, $jmeno, $prijmeni, $email, $kontakt_id, $vitez)
{
    //Здесь будут отправляться транзакционные имэйлы
    $api->sendTransactionalEmail(
        array(
            'template_id' => $template_id,
            'subject' => 'Vyhral\a jste ' . $vyhra, //добавить новую базу данных по типу
            'from_name' => get_option('blogname'),
            'from_email' => '',
            'reply_to' => '',
            'email' => $email,
            'name' => $jmeno . ' ' . $prijmeni,
            'name' => 'text',
            'content' => $email . "<br>Váš odkaz:" . get_option('siteurl') . "/index.php" . "/my-page-" . $jmeno . '-' . $prijmeni . '-' . $kontakt_id
        ),
        TRUE,
        TRUE
    );

    if (!empty($template_id)) {
        $vitez->sendTransactionEmail(array(
            'kontakt_id' => $kontakt_id,
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'vyhra' => $vyhra,
            'link' => get_option('siteurl') . "/index.php" . "/my-page-" . $jmeno . '-' . $prijmeni . '-' . $kontakt_id, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
            'checkbox_column' => '',
        ));
    } else {
        echo "template_id chybí. Přidat mužete v položce menu Maily";
    }
} // Разобраться с $competition_type для denni...


//Losování menu function
function sendMainTransactionMails($api, $template_id, $vyhra_hlavni, $email, $name, $surname, $vyhra_mail, $kontakt_id, $vitez)
{
    //Здесь будут отправляться транзакционные имэйлы
    $api->sendTransactionalEmail(
        array(
            'template_id' => $template_id,
            'subject' => 'Vyhral\a jste ' . $vyhra_hlavni,
            'from_name' => get_option('blogname'),
            'from_email' => '',
            'reply_to' => '',
            'email' => $email,
            'name' => $name . ' ' . $surname,
            'name' => 'text',
            'content' => $vyhra_mail . "<br>Váš odkaz:" . get_option('siteurl') . "/index.php" . "/my-page-" . $name . '-' . $surname . '-' . $kontakt_id
        ),
        TRUE,
        TRUE
    );

    if (!empty($template_id)) {
        $vitez->sendTransactionEmail(array(
            'kontakt_id' => $kontakt_id,
            'jmeno' => $name,
            'prijmeni' => $surname,
            'vyhra' => $vyhra_hlavni,
            'link' => get_option('siteurl') . "/index.php" . "/my-page-" . $name . '-' . $surname . '-' . $kontakt_id, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
            'checkbox_column' => '',
        ));
    } else {
        echo "template_id chybí. Přidat mužete v položce menu Maily";
    }
}

//Change Quantity
function changeQuantityOfCompetition($competition_type)
{
    global $wpdb;
    $field_name = 'quantity';
    $current_value = getCurrentValue($competition_type);
    $new_value = $current_value - 1;
    $table_name = getAktivnySouteziTable();
    $wpdb->update($table_name, array($field_name => $new_value), array($field_name => $current_value, 'competition_type' => $competition_type));
}

function changeQuantityOfDaysCompetition($competition_type)
{
    global $wpdb;
    $table_name = getTableNameDenni();
    $field_name = 'quantity';
    $denni_competition_id = getDenniCompetitionIdU($competition_type);
    $current_value = getCurrentValueU($denni_competition_id);
    $new_value = $current_value - 1;

    $wpdb->update($table_name, array($field_name => $new_value), array($field_name => $current_value, 'denni_competition_id' => $denni_competition_id));
}

function changeQuantityOfMainCompetition($competition_type)
{
    global $wpdb;
    $table_name = getTableNameHlavni();
    $field_name = 'quantity';
    $current_value = getMainCurrentValue($competition_type);
    $new_value = $current_value - 1;

    $wpdb->update($table_name, array($field_name => $new_value), array($field_name => $current_value, 'competition_type' => $competition_type));
}


//Losování menu function
function deleteTypeOfCompetition($template_id, $competition_type)
{
    global $wpdb;
    $table_name = getTypSoutezeTable();
    if (!empty($template_id)) {
        $wpdb->delete($table_name, array('competition_type' => $competition_type));
    }
}

//Losování menu function
function deleteDaysTypeOfCompetition($template_id, $competition_type)
{
    global $wpdb;
    $table_name = getTableNameDenni();
    if (!empty($template_id)) {
        $wpdb->delete($table_name, array('competition_type' => $competition_type));
    } //продолжить
}

//Losování menu function
function deleteMainTypeOfCompetition($template_id, $competition_type)
{
    global $wpdb;
    $table_name = getTableNameHlavni();
    if (!empty($template_id)) {
        $wpdb->delete($table_name, array('competition_type' => $competition_type));
    } //продолжить
}
