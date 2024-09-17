<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once SOUTEZ_DIR . 'functions/maily/functions/mail.php';
require_once SOUTEZ_DIR . 'classes/vitez/vitez.php';
require_once SOUTEZ_DIR . 'forms/post-form.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';
require_once 'db_functions.php';
require_once 'email_functions.php';

class Update
{
    private $competition_type;
    private $competition_id;
    private $draw_id;
    private $random_winner;
    private $random_winner_denni;
    private $vyhra;
    private $vyhra_denni;
    private $vyhra_denni2;
    private $vyhra_denni3;
    private $vyhra_denni4;
    private $vyhra_denni5;
    private $vyhra_denni6;
    private $vyhra_denni7;
    private $vyhra_denni8;
    private $vyhra_denni9;
    private $vyhra_denni10;
    private $vyhra_hlavni;
    private $vyhra_mail;
    private $template_id;
    private $email;
    private $api_key;
    private $api;
    private $vitez;
    private $name;
    private $surname;
    private $kontakt_id;
    private $main_kontakt_id;
    private $main_name;
    private $main_surname;
    private $main_email;
    private $token;
    private $shortToken;
    private $copie_email;
    private $random_winner_hlavni;
    private $viteze;
    private $copie_name;
    private $copie_surname;
    private $copie_kontakt_id;

    public function __construct($competition_type)
    {
        $this->competition_type = $competition_type;
        $this->competition_id = getCompetitionIdFromTypSouteze($this->competition_type);

        $this->draw_id = getDrawIdFromPrizeDraw($this->competition_type);

        $this->random_winner = getAllFromKontaktniUdajeTydenni();
        $this->random_winner_denni = getAllFromKontaktniUdajeDenni();
        $this->random_winner_hlavni = getAllFromKontaktniUdajeHlavni();

        $this->viteze = getAllFromKontaktniUdajeViteze($competition_type);

        $this->vyhra = getVyhraFromAktivnySoutezi($competition_type);
        $this->vyhra_denni = getVyhraFromDenniSoutezi($competition_type);
        $this->vyhra_denni2 = getVyhraFromDenniSoutezi2($competition_type);
        $this->vyhra_denni3 = getVyhraFromDenniSoutezi3($competition_type);
        $this->vyhra_denni4 = getVyhraFromDenniSoutezi4($competition_type);
        $this->vyhra_denni5 = getVyhraFromDenniSoutezi5($competition_type);
        $this->vyhra_denni6 = getVyhraFromDenniSoutezi6($competition_type);
        $this->vyhra_denni7 = getVyhraFromDenniSoutezi7($competition_type);
        $this->vyhra_denni8 = getVyhraFromDenniSoutezi8($competition_type);
        $this->vyhra_denni9 = getVyhraFromDenniSoutezi9($competition_type);
        $this->vyhra_denni10 = getVyhraFromDenniSoutezi10($competition_type);
        $this->vyhra_hlavni = getVyhraFromHlavniSoutezi($competition_type);
        $this->vyhra_mail = getTemplateFromTypSoutezeMails($this->draw_id);

        $this->template_id = getEcomailTemplateIdFromTypSoutezeMails($this->draw_id);

        $this->email = getEmailFromKontaktniUdajeViteze($competition_type);

        $this->copie_email = getEmailFromKontaktniUdajeVitezeCopie($competition_type);

        $this->api_key = get_option('ecomail_api_key');
        $this->api = new EcomailApi($this->api_key);

        $this->vitez = new Vitez();
        $this->name = getNameFromKontaktniUdajeViteze($competition_type);
        $this->surname = getSurnameFromKontaktniUdajeViteze($competition_type);
        $this->kontakt_id = getKontaktIdFromKontaktniUdajeViteze($competition_type);

        $this->copie_name = getCopieNameFromKontaktniUdajeVitezeCopie($competition_type);
        $this->copie_surname = getCopieSurnameFromKontaktniUdajeVitezeCopie($competition_type);
        $this->copie_kontakt_id = getCopieKontaktIdFromKontaktniUdajeVitezeCopie($competition_type);

        $this->main_kontakt_id = getKontaktIdFromKontaktniUdajeVitezeMain($competition_type);
        $this->main_name = getNameFromKontaktniUdajeVitezeMain($competition_type);
        $this->main_surname = getSurnameFromKontaktniUdajeVitezeMain($competition_type);
        $this->main_email = getEmailFromKontaktniUdajeVitezeMain($competition_type);

        $this->token = wp_generate_password(20, false, false); // Генерация случайного токена
        $this->shortToken = substr($this->token, 0, 15);
    }
    //Doplnit typ souteze(Potrebni refaktoring)
    public function addCompetitionType()
    {
        global $wpdb;
        $competition_type = str_replace(" ", "_", $this->competition_type);
        $existing_record = selectAllFromTypSouteze($competition_type);

        if ($existing_record) {
            //Update new entry
            updateCompetitionIdForTypSouteze($competition_type, $this->competition_id);
        } else {
            //Insert new entryaddCompetitionTypeWithoutTimer
            insertCompetitionTypeForTypSouteze($competition_type);
        }
    }

    //Moje soutěží menu function for timer
    public function addCompetitionTypeWithTimer()
    {
        global $wpdb;
        $vyhra = $_POST["vyhra"];
        $quantity = $_POST["numberof"];
        $zahajeni = $_POST["zahajeni"];
        $konec = $_POST["konec"];

        $results = getAllFromKontaktniUdaje();

        $existing_prize = selectAllFromPrizeDraw($this->competition_type);

        $existing_competition = selectAllFromAktivnySouteziUpdate($this->competition_type);

        $existing_vyhra = selectVyhraFromAltivnySoutezi($this->competition_type);

        if ($existing_prize) {
            //Update an existing entry
            updateCompetitionIdInPrizeDraw(
                $vyhra,
                $quantity,
                $this->competition_type,
                $this->competition_id
            );
        } else {
            //Insert new entry
            insertCompetitionIdCompetitionTypeVyhraQuantityInPrizeDraw(
                $this->competition_id,
                $this->competition_type,
                $vyhra,
                $quantity
            );
        }

        $draw_id = $wpdb->insert_id;

        if (!$existing_competition) {
            insertDrawIdCompetitionTypeVyhraQuantityZacatekKonecInAktivnySoutezi(
                $draw_id,
                $this->competition_type,
                $vyhra,
                $quantity,
                $zahajeni,
                $konec
            );
        } // Нужно добавить функцицю обновления по примеру нижней..

        if ($existing_vyhra) {
            // Обновляем существующую запись
            $this->updateWeekPrize($quantity, $vyhra);
        } else {
            // Выполняем другие действия, если $existing_vyhra пустое
            $this->divideByDayTime();
        }
    }

    public function updateWeekPrize($quantity, $vyhra)
    {
        updateCompetitionTypeInAktivnySoutezi(
            $quantity,
            $vyhra,
            $this->competition_type
        );
    }

    public function divideByDayTime()
    {
        $existing_denni_record = selectAllFromDenniSouteziUpdate($this->competition_type);

        $zahajeni = selectZacatekFromAktivnySoutezi($this->competition_type);

        $konec = selectKonecFromAktivnySoutezi($this->competition_type);

        $active_competition_id = selectActiveCompetitionIdFromAktivnySoutezi($this->competition_type);

        $start = new DateTime($zahajeni);
        $end = new DateTime($konec);

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($start, $interval, $end);

        $i = 1;
        foreach ($daterange as $date) {
            $startOfDay = $date->format('Y-m-d 00:00:00');
            $endOfDay = $date->format('Y-m-d 23:59:59');
            if ($existing_denni_record) {
                //Update an existing entry
                updateActiveCompetitionIdFromDenniSoutezi(
                    $startOfDay,
                    $endOfDay,
                    $active_competition_id
                );
            } else {
                insertActiveCompetitionIdCompetitionTypeCompetitionNameZacatekKonecInDenniSoutezi(
                    $active_competition_id,
                    $this->competition_type,
                    $i,
                    $startOfDay,
                    $endOfDay
                );
            }
            $i++;
        }
    }

    public function divideByAllTime()
    {
        $existing_hlavni_record = selectAllFromHlavniSouteziUpdate($this->competition_type);

        // Составление SQL-запроса для выбора самого первого значения из поля 'zacatek' и самого последнего значения из поля 'konec'
        $result = selectMinZacatekFromAktivnySoutezi($this->competition_type);

        $active_competition_id = selectActiveCompetitionId($this->competition_type);

        // Выполнение запроса и получение результата

        $firstZacatek = $result->first_zacatek;
        $lastKonec = $result->last_konec;

        if ($existing_hlavni_record) {
            //Update an existing entry
            updateZacatekKonecInHlavniSoutezi(
                $active_competition_id,
                $this->competition_type,
                $firstZacatek,
                $lastKonec
            );
        } else {
            //Insert new entry
            insertActiveCompetitionIdCompetitionTypeCompetitionNameZacatekKonec(
                $active_competition_id,
                $this->competition_type,
                $firstZacatek,
                $lastKonec
            );
        }
    }

    //Tydenni soutezi
    public function removeCompetitionTypeWithTimer()
    {
        global $wpdb;
        // Удаляем записи из таблицы wp_denni_soutezi, связанные с записями в wp_aktivny_soutezi
        deleteFromDenniSoutezi($this->competition_type);

        // Удаляем записи из таблицы wp_hlavni_soutezi, связанные с записями в wp_aktivny_soutezi и wp_prize_draw
        deleteFromHlavniSouteziSelectActiveCompetitionId($this->competition_type);

        deleteFromHlavniSouteziSelectDrawId($this->competition_type);

        // Удаляем записи из таблицы wp_aktivny_soutezi
        deleteCompetitionTypeFromAktivnySoutezi($this->competition_type);

        // Удаляем записи из таблицы wp_prize_draw
        deleteCompetitionTypeFromPrizeDraw($this->competition_type);
    }

    //Denni soutezi
    public function removeByDayTime()
    {
        //Удаляем записи из таблицы wp_denni_soutezi, где active_competition_id не существует в таблице wp_aktivny_soutezi
        deleteFromDenniSouteziSelectActiveCompetitionId();
    }

    //hlavni soutezi
    public function removeByAllTime()
    {
        // Составление SQL-запроса для выбора самого первого значения из поля 'zacatek' и самого последнего значения из поля 'konec'
        $result = selectMinZacatekFromAktivnySoutezi($this->competition_type);
        $active_competition_id = selectActiveCompetitionId($this->competition_type);

        $firstZacatek = $result->first_zacatek;
        $lastKonec = $result->last_konec;

        updateZacatekKonecInHlavniSoutezi(
            $active_competition_id,
            $this->competition_type,
            $firstZacatek,
            $lastKonec
        );
    }

    //Losování menu function tydenni
    public function insertDatabase()
    {
        insertIntoKontaktniUdajeViteze(
            $this->random_winner[0]->kontakt_id,
            $this->vyhra,
            $this->competition_type,
            $this->random_winner[0]->jmeno,
            $this->random_winner[0]->prijmeni,
            $this->random_winner[0]->telefon,
            $this->random_winner[0]->email,
            $this->random_winner[0]->psc,
            $this->random_winner[0]->datum_nakupu,
            $this->random_winner[0]->cas_nakupu,
            $this->random_winner[0]->cena_nakupu,
            $this->random_winner[0]->cas_plneni
        );
    }

    //Losování menu function tydenni
    public function updateDatabase()
    {
        $kontakt_id = selectKontaktIdFromUctenkaViteze($this->competition_type);

        if ($kontakt_id == $this->random_winner[0]->kontakt_id) {
            $kontakt_id = selectKontaktIdFromUctenkaViteze($this->competition_type);
            deleteFromKontaktniUdajeTydenni($kontakt_id);
        }

        updateKontaktniUdajeViteze(
            $this->random_winner[0]->kontakt_id,
            $this->vyhra,
            $this->competition_type,
            $this->random_winner[0]->jmeno,
            $this->random_winner[0]->prijmeni,
            $this->random_winner[0]->telefon,
            $this->random_winner[0]->email,
            $this->random_winner[0]->psc,
            $this->random_winner[0]->datum_nakupu,
            $this->random_winner[0]->cas_nakupu,
            $this->random_winner[0]->cena_nakupu,
            $this->random_winner[0]->cas_plneni
        );
    }

    //Losování menu function denni
    public function insertDatabaseDenni()
    {
        foreach ($this->random_winner_denni as $winner) {
            // Создаем массив с непустыми переменными vyhra_denni
            $vyhra_denni_array = array_filter(array(
                $this->vyhra_denni,
                $this->vyhra_denni2,
                $this->vyhra_denni3,
                $this->vyhra_denni4,
                $this->vyhra_denni5,
                $this->vyhra_denni6,
                $this->vyhra_denni7,
                $this->vyhra_denni8,
                $this->vyhra_denni9,
                $this->vyhra_denni10
            ));

            // Если массив пустой, используем значение по умолчанию
            if (empty($vyhra_denni_array)) {
                $random_vyhra_denni = $this->vyhra_denni;
            } else {
                // Выбираем случайную непустую vyhra_denni из массива
                $random_vyhra_denni = $vyhra_denni_array[array_rand($vyhra_denni_array)];
            }
            insertIntoKontaktniUdajeVitezeDenni(
                $winner->kontakt_id,
                $random_vyhra_denni,
                $this->competition_type,
                $winner->jmeno,
                $winner->prijmeni,
                $winner->telefon,
                $winner->email,
                $winner->psc,
                $winner->datum_nakupu,
                $winner->cas_nakupu,
                $winner->cena_nakupu,
                $winner->cas_plneni
            );
        }
    }

    //Losování menu function denni
    public function updateDatabaseDenni()
    {
        foreach ($this->random_winner_denni as $winner) {
            $kontakt_id = selectKontaktIdFromUctenkaViteze($this->competition_type);

            if ($kontakt_id == $winner->kontakt_id) {
                $kontakt_id = selectKontaktIdFromUctenkaViteze($this->competition_type);
                deleteFromKontaktniUdajeDenni($kontakt_id);
            }
            // Создаем массив с непустыми переменными vyhra_denni
            $vyhra_denni_array = array_filter(array(
                $this->vyhra_denni,
                $this->vyhra_denni2,
                $this->vyhra_denni3,
                $this->vyhra_denni4,
                $this->vyhra_denni5,
                $this->vyhra_denni6,
                $this->vyhra_denni7,
                $this->vyhra_denni8,
                $this->vyhra_denni9,
                $this->vyhra_denni10
            ));

            // Если массив пустой, используем значение по умолчанию
            if (empty($vyhra_denni_array)) {
                $random_vyhra_denni = $this->vyhra_denni;
            } else {
                // Выбираем случайную непустую vyhra_denni из массива
                $random_vyhra_denni = $vyhra_denni_array[array_rand($vyhra_denni_array)];
            }
            updateCompetitionTypeInKontaktniUdajeVitezeDenni(
                $winner->kontakt_id,
                $random_vyhra_denni,
                $this->competition_type,
                $winner->jmeno,
                $winner->prijmeni,
                $winner->telefon,
                $winner->email,
                $winner->psc,
                $winner->datum_nakupu,
                $winner->cas_nakupu,
                $winner->cena_nakupu,
                $winner->cas_plneni
            );
        }
    }

    public function copyAndSortData()
    {
        // Очистить таблицу перед копированием данных
        truncateTableKontaktniUdajeVitezeCopie();

        $results = selectAllFromKontaktniUdajeVitezeDenni();

        foreach ($results as $result) {
            $vyhra_denni_array = array_filter(array(
                $this->vyhra_denni,
                $this->vyhra_denni2,
                $this->vyhra_denni3,
                $this->vyhra_denni4,
                $this->vyhra_denni5,
                $this->vyhra_denni6,
                $this->vyhra_denni7,
                $this->vyhra_denni8,
                $this->vyhra_denni9,
                $this->vyhra_denni10
            ));

            // Если массив пустой, используем значение по умолчанию
            if (empty($vyhra_denni_array)) {
                $random_vyhra_denni = $this->vyhra_denni;
            } else {
                // Выбираем случайную непустую vyhra_denni из массива
                $random_vyhra_denni = $vyhra_denni_array[array_rand($vyhra_denni_array)];
            }
            insertKontaktIdVyhraCompetitionTypeJmenoPrijmeniTelefonEmailPscDatumNakupuCasNakupuCenaNakupuCasPlneniIntoKontaktniUdajeVitezeCopie(
                $result->kontakt_id,
                $random_vyhra_denni,
                $result->competition_type,
                $result->jmeno,
                $result->prijmeni,
                $result->telefon,
                $result->email,
                $result->psc,
                $result->datum_nakupu,
                $result->cas_nakupu,
                $result->cena_nakupu,
                $result->cas_plneni
            );
        }
    }

    //Losování menu function hlavni
    public function insertDatabaseHlavni()
    {
        insertKontaktIdVyhraCompetitionTypeJmenoPrijmeniTelefonEmailPscDatumNakupuCasNakupuCenaNakupuCasPlneniIntoKontaktniUdajeVitezeMain(
            $this->random_winner[0]->kontakt_id,
            $this->vyhra_hlavni,
            $this->competition_type,
            $this->random_winner[0]->jmeno,
            $this->random_winner[0]->prijmeni,
            $this->random_winner[0]->telefon,
            $this->random_winner[0]->email,
            $this->random_winner[0]->psc,
            $this->random_winner[0]->datum_nakupu,
            $this->random_winner[0]->cas_nakupu,
            $this->random_winner[0]->cena_nakupu,
            $this->random_winner[0]->cas_plneni
        );
    }

    //Losování menu function hlavni
    public function updateDatabaseHlavni()
    {
        updateCompetitionTypeInKontaktniUdajeVitezeMain(
            $this->random_winner[0]->kontakt_id,
            $this->vyhra_hlavni,
            $this->competition_type,
            $this->random_winner[0]->jmeno,
            $this->random_winner[0]->prijmeni,
            $this->random_winner[0]->telefon,
            $this->random_winner[0]->email,
            $this->random_winner[0]->psc,
            $this->random_winner[0]->datum_nakupu,
            $this->random_winner[0]->cas_nakupu,
            $this->random_winner[0]->cena_nakupu,
            $this->random_winner[0]->cas_plneni
        );
    }

    //Losování menu function
    public function sendTransactionMails()
    {
        //Здесь будут отправляться транзакционные имэйлы
        apisendTransactionEmail(
            $this->api,
            $this->template_id,
            $this->vyhra,
            $this->email,
            $this->name,
            $this->surname,
            $this->vyhra_mail,
            $this->shortToken
        );

        if (!empty($this->template_id)) {
            vitezSendTransactionEmail(
                $this->vitez,
                $this->competition_type,
                $this->kontakt_id,
                $this->name,
                $this->surname,
                $this->vyhra,
                $this->shortToken
            );
        } else {
            echo "template_id chybí. Přidat mužete v položce menu Maily";
        }
    }

    public function changeQuantityOfCompetition()
    {
        $new_value = getNewValue($this->competition_type);

        updateQuantityInAktivnySoutezi($this->competition_type);
        // Если $new_value равен 0, выводим сообщение
        if ($new_value < 1) {
            echo "No more mails.";
        }
    }

    //Losování menu function
    public function sendDaysTransactionMails($competition_type, $template_id, $vyhra, $jmeno, $prijmeni, $email)
    {
        $denni_competition_id = selectDenniCompetitionIdFromDenniSouteziUpdate($competition_type);

        $vyhra_mail = selectTemplateFromTypSoutezeDaysMails($denni_competition_id);

        $kontakt_id = selectKontaktIdFromKontaktniUdajeDenni($jmeno, $prijmeni, $email);

        //Здесь будут отправляться транзакционные имэйлы
        apisendTransactionEmail(
            $this->api,
            $template_id,
            $vyhra,
            $email,
            $jmeno,
            $prijmeni,
            $vyhra_mail,
            $this->shortToken
        );

        if (!empty($template_id)) {
            vitezSendTransactionEmail(
                $this->vitez,
                $competition_type,
                $kontakt_id,
                $jmeno,
                $prijmeni,
                $vyhra,
                $this->shortToken
            );
        } else {
            echo "template_id chybí. Přidat mužete v položce menu Maily";
        }
    } // Разобраться с $competition_type для denni...

    public function changeQuantityOfDaysCompetition()
    {
        $denni_competition_id = selectDenniCompetitionIdFromDenniSouteziUpdate($this->competition_type);

        $current_value = selectQuantityFromDenniSoutezi($denni_competition_id);

        $current_value_total = selectTotalQuantityFromDenniSoutezi($denni_competition_id);

        $new_value = $current_value - 1;

        $another_value = $current_value_total - 1;

        updateQuantityAndTotalQuantityIntoDenniSoutezi(
            $denni_competition_id,
            $new_value,
            $another_value,
            $current_value,
            $current_value_total
        );
    }

    public function changeQuantityOfDaysCompetition2()
    {
        $denni_competition_id = selectDenniCompetitionIdFromDenniSouteziUpdate($this->competition_type);

        $current_value = selectQuantityFromDenniSoutezi($denni_competition_id);

        $current_value_total = selectTotalQuantityFromDenniSoutezi($denni_competition_id);

        $new_value = $current_value - 1;

        $another_value = $current_value_total - 1;

        updateQuantityAndTotalQuantityIntoDenniSoutezi2(
            $denni_competition_id,
            $new_value,
            $another_value,
            $current_value,
            $current_value_total
        );
    }

    public function changeQuantityOfDaysCompetition3()
    {
        $denni_competition_id = selectDenniCompetitionIdFromDenniSouteziUpdate($this->competition_type);

        $current_value = selectQuantityFromDenniSoutezi($denni_competition_id);

        $current_value_total = selectTotalQuantityFromDenniSoutezi($denni_competition_id);

        $new_value = $current_value - 1;

        $another_value = $current_value_total - 1;

        updateQuantityAndTotalQuantityIntoDenniSoutezi3(
            $denni_competition_id,
            $new_value,
            $another_value,
            $current_value,
            $current_value_total
        );
    }

    public function changeQuantityOfDaysCompetition4()
    {
        $denni_competition_id = selectDenniCompetitionIdFromDenniSouteziUpdate($this->competition_type);

        $current_value = selectQuantityFromDenniSoutezi($denni_competition_id);

        $current_value_total = selectTotalQuantityFromDenniSoutezi($denni_competition_id);

        $new_value = $current_value - 1;

        $another_value = $current_value_total - 1;

        updateQuantityAndTotalQuantityIntoDenniSoutezi4(
            $denni_competition_id,
            $new_value,
            $another_value,
            $current_value,
            $current_value_total
        );
    }

    public function changeQuantityOfDaysCompetition5()
    {
        $denni_competition_id = selectDenniCompetitionIdFromDenniSouteziUpdate($this->competition_type);

        $current_value = selectQuantityFromDenniSoutezi($denni_competition_id);

        $current_value_total = selectTotalQuantityFromDenniSoutezi($denni_competition_id);

        $new_value = $current_value - 1;

        $another_value = $current_value_total - 1;

        updateQuantityAndTotalQuantityIntoDenniSoutezi5(
            $denni_competition_id,
            $new_value,
            $another_value,
            $current_value,
            $current_value_total
        );
    }

    public function changeQuantityOfDaysCompetition6()
    {
        $denni_competition_id = selectDenniCompetitionIdFromDenniSouteziUpdate($this->competition_type);

        $current_value = selectQuantityFromDenniSoutezi($denni_competition_id);

        $current_value_total = selectTotalQuantityFromDenniSoutezi($denni_competition_id);

        $new_value = $current_value - 1;

        $another_value = $current_value_total - 1;

        updateQuantityAndTotalQuantityIntoDenniSoutezi6(
            $denni_competition_id,
            $new_value,
            $another_value,
            $current_value,
            $current_value_total
        );
    }

    public function changeQuantityOfDaysCompetition7()
    {
        $denni_competition_id = selectDenniCompetitionIdFromDenniSouteziUpdate($this->competition_type);

        $current_value = selectQuantityFromDenniSoutezi($denni_competition_id);

        $current_value_total = selectTotalQuantityFromDenniSoutezi($denni_competition_id);

        $new_value = $current_value - 1;

        $another_value = $current_value_total - 1;

        updateQuantityAndTotalQuantityIntoDenniSoutezi7(
            $denni_competition_id,
            $new_value,
            $another_value,
            $current_value,
            $current_value_total
        );
    }

    public function changeQuantityOfDaysCompetition8()
    {
        $denni_competition_id = selectDenniCompetitionIdFromDenniSouteziUpdate($this->competition_type);

        $current_value = selectQuantityFromDenniSoutezi($denni_competition_id);

        $current_value_total = selectTotalQuantityFromDenniSoutezi($denni_competition_id);

        $new_value = $current_value - 1;

        $another_value = $current_value_total - 1;

        updateQuantityAndTotalQuantityIntoDenniSoutezi8(
            $denni_competition_id,
            $new_value,
            $another_value,
            $current_value,
            $current_value_total
        );
    }

    public function changeQuantityOfDaysCompetition9()
    {
        $denni_competition_id = selectDenniCompetitionIdFromDenniSouteziUpdate($this->competition_type);

        $current_value = selectQuantityFromDenniSoutezi($denni_competition_id);

        $current_value_total = selectTotalQuantityFromDenniSoutezi($denni_competition_id);

        $new_value = $current_value - 1;

        $another_value = $current_value_total - 1;

        updateQuantityAndTotalQuantityIntoDenniSoutezi9(
            $denni_competition_id,
            $new_value,
            $another_value,
            $current_value,
            $current_value_total
        );
    }

    public function changeQuantityOfDaysCompetition10()
    {
        $denni_competition_id = selectDenniCompetitionIdFromDenniSouteziUpdate($this->competition_type);

        $current_value = selectQuantityFromDenniSoutezi($denni_competition_id);

        $current_value_total = selectTotalQuantityFromDenniSoutezi($denni_competition_id);

        $new_value = $current_value - 1;

        $another_value = $current_value_total - 1;

        updateQuantityAndTotalQuantityIntoDenniSoutezi10(
            $denni_competition_id,
            $new_value,
            $another_value,
            $current_value,
            $current_value_total
        );
    }

    //Losování menu function
    public function sendMainTransactionMails($template_id, $main_competition_id)
    {
        $vyhra_hlavni_mail = selectTemplateFromTypSoutezeMainMails($main_competition_id);

        //Здесь будут отправляться транзакционные имэйлы
        apisendTransactionEmailMain(
            $this->api,
            $template_id,
            $this->vyhra_hlavni,
            $this->main_email,
            $this->main_name,
            $this->main_surname,
            $vyhra_hlavni_mail,
            $this->shortToken
        );

        if (!empty($template_id)) {
            vitezSendTransactionEmailMain(
                $this->vitez,
                $this->competition_type,
                $this->main_kontakt_id,
                $this->main_name,
                $this->main_surname,
                $this->vyhra_hlavni,
                $this->shortToken
            );
        } else {
            echo "template_id chybí. Přidat mužete v položce menu Maily";
        }
    }

    public function changeQuantityOfMainCompetition()
    {
        selectQuantityFromHlavniSoutezi($this->competition_type);
    }

    //Losování menu function
    public function deleteTypeOfCompetition()
    {
        if (!empty($this->template_id)) {
            deleteCompetitionTypeFromTypSouteze($this->competition_type);
        }
    }

    //Losování menu function
    public function deleteDaysTypeOfCompetition($template_id)
    {
        if (!empty($template_id)) {
            deleteCompetitionTypeFromDenniSouteze($this->competition_type);
        }
    }

    //Losování menu function
    public function deleteMainTypeOfCompetition($template_id)
    {
        if (!empty($template_id)) {
            deleteHlavniFromHlavniSouteze();
        }
    }

    public function createPageWithEndpoint()
    {
        $PageGuid = get_option('siteurl') . "/index.php/" . $this->shortToken;

        // Буферизация вывода для получения HTML-шаблона как строки
        ob_start();
        include 'create_page.php'; // Путь к файлу шаблона
        $post_content = ob_get_clean();

        $my_post = array(
            'post_title'     => 'Form for ' . $this->name . ' ' . $this->surname,
            'post_type'      => 'page',
            'post_name'      => $this->shortToken,
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

        update_post_meta($PageID, 'page_token', $this->token);
    }

    public function createDaysPageWithEndpoint($competition_type, $jmeno, $prijmeni, $email, $vyhra)
    {
        $PageGuid = get_option('siteurl') . "/index.php/" . $this->shortToken;

        // Буферизация вывода для получения HTML-шаблона как строки
        ob_start();
        include 'create_day_page.php'; // Путь к файлу шаблона
        $post_content = ob_get_clean();

        $my_post = array(
            'post_title'     => 'Form for ' . $jmeno . ' ' . $prijmeni,
            'post_type'      => 'page',
            'post_name'      => $this->shortToken,
            //            'post_name'      => 'my-page-' . $jmeno . $prijmeni . $kontakt_id . $this->shortToken,
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

        update_post_meta($PageID, 'page_token', $this->shortToken);
    }


    public function createMainPageWithEndpoint()
    {
        $PageGuid = get_option('siteurl') . "/index.php/" . $this->shortToken;
        // Буферизация вывода для получения HTML-шаблона как строки

        ob_start();
        include 'create_main_page.php'; // Путь к файлу шаблона
        $post_content = ob_get_clean();

        $my_post = array(
            'post_title'     => 'Form for ' . $this->main_name . ' ' . $this->main_surname,
            'post_type'      => 'page',
            'post_name'      => $this->shortToken,
            //            'post_name'      => 'my-page-' . $this->main_name . '-' . $this->main_surname . '-' . $this->main_kontakt_id,
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
        update_post_meta($PageID, 'page_token', $this->shortToken);
    }
}
