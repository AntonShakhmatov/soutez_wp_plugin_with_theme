<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once SOUTEZ_DIR . 'functions/maily/functions/mail.php';
require_once SOUTEZ_DIR . 'classes/vitez/vitez.php';
require_once SOUTEZ_DIR . 'forms/post-form.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

class Update
{
    private $table_name;
    private $table_name_denni;
    private $table_name_hlavni;
    private $table_name_2;
    private $table_name_3;
    private $table_name_4;
    private $table_name_winner_copie;
    private $table_name_winner_denni;
    private $table_name_winner_main;
    private $table_name_days_mails;
    private $table_name_main_mails;
    private $table_name_5;
    private $table_name_6;
    private $table_name_7;
    private $table_name_8;
    private $table_name_9;
    private $table_name_10;
    private $table_name_11;
    private $competition_type;
    private $competition_id;
    private $draw_id;
    private $random_winner;
    private $random_winner_denni;
    private $random_winner_hlavni;
    private $viteze;
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
    private $copie_email;
    private $api_key;
    private $api;
    private $vitez;
    private $name;
    private $copie_name;
    private $surname;
    private $copie_surname;
    private $kontakt_id;
    private $copie_kontakt_id;
    private $main_kontakt_id;
    private $main_name;
    private $main_surname;
    private $main_email;
    private $token;
    private $shortToken;

    public function __construct($competition_type)
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'aktivny_soutezi';
        $this->table_name_denni = $wpdb->prefix . 'denni_soutezi';
        $this->table_name_hlavni = $wpdb->prefix . 'hlavni_soutezi';
        $this->table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze';
        $this->table_name_3 = $wpdb->prefix . 'kontaktni_udaje';
        $this->table_name_4 = $wpdb->prefix . 'typ_souteze_mails';
        $this->table_name_winner_copie = $wpdb->prefix . 'kontaktni_udaje_viteze_copie';
        $this->table_name_winner_denni = $wpdb->prefix . 'kontaktni_udaje_viteze_denni';
        $this->table_name_winner_main = $wpdb->prefix . 'kontaktni_udaje_viteze_main';
        $this->table_name_days_mails = $wpdb->prefix . 'typ_souteze_days_mails';
        $this->table_name_main_mails = $wpdb->prefix . 'typ_souteze_main_mails';
        $this->table_name_5 = $wpdb->prefix . 'typ_souteze';
        $this->table_name_6 = $wpdb->prefix . 'prize_draw';
        $this->table_name_7 = $wpdb->prefix . 'uctenka_viteze';
        $this->table_name_8 = $wpdb->prefix . 'kontaktni_udaje_denni';
        $this->table_name_9 = $wpdb->prefix . 'kontaktni_udaje_hlavni';
        $this->table_name_10 = $wpdb->prefix . 'viteze';
        $this->table_name_11 = $wpdb->prefix . 'kontaktni_udaje_tydenni';
        $this->competition_type = $competition_type;
        $this->competition_id = $wpdb->get_var("SELECT competition_id FROM {$this->table_name_5} WHERE competition_type = '{$this->competition_type}'");
        $this->draw_id = $wpdb->get_var("SELECT draw_id FROM {$this->table_name_6} WHERE competition_type = '{$this->competition_type}'");
        $this->random_winner = $wpdb->get_results("SELECT * FROM {$this->table_name_11} ORDER BY RAND() LIMIT 1");
        $this->random_winner_denni = $wpdb->get_results("SELECT * FROM {$this->table_name_8} ORDER BY RAND() LIMIT 1");
        $this->random_winner_hlavni = $wpdb->get_results("SELECT * FROM {$this->table_name_9} ORDER BY RAND() LIMIT 1");
        $this->viteze = $wpdb->get_results("SELECT * FROM {$this->table_name_2} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra = $wpdb->get_var("SELECT vyhra FROM {$this->table_name} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra_denni = $wpdb->get_var("SELECT vyhra FROM {$this->table_name_denni} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra_denni2 = $wpdb->get_var("SELECT vyhra2 FROM {$this->table_name_denni} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra_denni3 = $wpdb->get_var("SELECT vyhra3 FROM {$this->table_name_denni} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra_denni4 = $wpdb->get_var("SELECT vyhra4 FROM {$this->table_name_denni} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra_denni5 = $wpdb->get_var("SELECT vyhra5 FROM {$this->table_name_denni} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra_denni6 = $wpdb->get_var("SELECT vyhra6 FROM {$this->table_name_denni} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra_denni7 = $wpdb->get_var("SELECT vyhra7 FROM {$this->table_name_denni} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra_denni8 = $wpdb->get_var("SELECT vyhra8 FROM {$this->table_name_denni} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra_denni9 = $wpdb->get_var("SELECT vyhra9 FROM {$this->table_name_denni} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra_denni10 = $wpdb->get_var("SELECT vyhra10 FROM {$this->table_name_denni} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra_hlavni = $wpdb->get_var("SELECT vyhra FROM {$this->table_name_hlavni} WHERE competition_type = '{$this->competition_type}'");
        $this->vyhra_mail = $wpdb->get_var("SELECT template FROM {$this->table_name_4} WHERE draw_id = '{$this->draw_id}'");
        $this->template_id = $wpdb->get_var("SELECT ecomail_template_id FROM {$this->table_name_4} WHERE draw_id = '{$this->draw_id}'");
        $this->email = $wpdb->get_var("SELECT email FROM {$this->table_name_2} WHERE competition_type = '{$this->competition_type}'");
        $this->copie_email = $wpdb->get_var("SELECT email FROM {$this->table_name_winner_copie} WHERE competition_type = '{$this->competition_type}'");

        $this->api_key = get_option('ecomail_api_key');
        $this->api = new EcomailApi($this->api_key);

        $this->vitez = new Vitez();
        $this->name = $wpdb->get_var("SELECT jmeno FROM {$this->table_name_2} WHERE competition_type = '{$this->competition_type}'");
        $this->surname = $wpdb->get_var("SELECT prijmeni FROM {$this->table_name_2} WHERE competition_type = '{$this->competition_type}'");
        $this->kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM {$this->table_name_2} WHERE competition_type = '{$this->competition_type}'");
        $this->copie_name = $wpdb->get_var("SELECT jmeno FROM {$this->table_name_winner_copie} WHERE competition_type = '{$this->competition_type}'");
        $this->copie_surname = $wpdb->get_var("SELECT prijmeni FROM {$this->table_name_winner_copie} WHERE competition_type = '{$this->competition_type}'");
        $this->copie_kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM {$this->table_name_winner_copie} WHERE competition_type = '{$this->competition_type}'");
        $this->main_kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM {$this->table_name_winner_main} WHERE competition_type = '{$this->competition_type}'");
        $this->main_name = $wpdb->get_var("SELECT jmeno FROM {$this->table_name_winner_main} WHERE competition_type = '{$this->competition_type}'");
        $this->main_surname = $wpdb->get_var("SELECT prijmeni FROM {$this->table_name_winner_main} WHERE competition_type = '{$this->competition_type}'");
        $this->main_email = $wpdb->get_var("SELECT email FROM {$this->table_name_winner_main} WHERE competition_type = '{$this->competition_type}'");

        $this->token = wp_generate_password(20, false, false); // Генерация случайного токена
        $this->shortToken = substr($this->token, 0, 15);
    }
    //Doplnit typ souteze(Potrebni refaktoring)
    public function addCompetitionType()
    {
        global $wpdb;
        $competition_type = str_replace(" ", "_", $this->competition_type);
        $existing_record = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$this->table_name_5` WHERE competition_type = %s", $competition_type));

        if ($existing_record) {
            //Update new entry
            $wpdb->update(
                $this->table_name_5,
                array(
                    'competition_type' => $competition_type,
                ),
                array('competition_id' => $this->competition_id)
            );
        } else {
            //Insert new entryaddCompetitionTypeWithoutTimer
            $wpdb->insert(
                $this->table_name_5,
                array(
                    'competition_type' => $competition_type,
                )
            );
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

        $results = $wpdb->get_results("SELECT * FROM $this->table_name_3");

        $existing_prize = $wpdb->get_var($wpdb->prepare("SELECT * FROM `$this->table_name_6` WHERE competition_type = %s", $this->competition_type));

        $existing_competition = $wpdb->get_var($wpdb->prepare("SELECT * FROM `$this->table_name` WHERE competition_type = %s", $this->competition_type));

        $existing_vyhra = $wpdb->get_var($wpdb->prepare("SELECT `vyhra` FROM `$this->table_name` WHERE competition_type = %s", $this->competition_type));

        if ($existing_prize) {
            //Update an existing entry
            $wpdb->update(
                $this->table_name_6,
                array(
                    'vyhra' => $vyhra,
                    'quantity' => $quantity,
                    'competition_type' => $this->competition_type
                ),
                array(
                    'competition_id' => $this->competition_id,
                )
            );
        } else {
            //Insert new entry
            $wpdb->insert(
                $this->table_name_6,
                array(
                    'competition_id' => $this->competition_id,
                    'competition_type' => $this->competition_type,
                    'vyhra' => $vyhra,
                    'quantity' => $quantity
                )
            );
        }

        $draw_id = $wpdb->insert_id;

        if (!$existing_competition) {
            $wpdb->insert(
                $this->table_name,
                array(
                    'draw_id' => $draw_id,
                    'competition_type' => $this->competition_type,
                    'vyhra' => $vyhra,
                    'quantity' => $quantity,
                    'zacatek' => $zahajeni,
                    'konec' => $konec
                )
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
        global $wpdb;
        $wpdb->update(
            $this->table_name,
            array(
                'quantity' => $quantity,
                'vyhra' => $vyhra,
            ),
            array(
                'competition_type' => $this->competition_type,
            )
        );
    }

    public function divideByDayTime()
    {
        global $wpdb;
        $existing_denni_record = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$this->table_name_denni` WHERE competition_type = %s", $this->competition_type));
        $zahajeni = $wpdb->get_var("SELECT zacatek FROM `$this->table_name` WHERE competition_type = '$this->competition_type'");
        $konec = $wpdb->get_var("SELECT konec FROM `$this->table_name` WHERE competition_type = '$this->competition_type'");
        $active_competition_id = $wpdb->get_var("SELECT active_competition_id FROM `$this->table_name` WHERE competition_type = '$this->competition_type'");

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
                $wpdb->update(
                    $this->table_name_denni,
                    array(
                        'zacatek' => $startOfDay,
                        'konec' => $endOfDay,
                    ),
                    array(
                        'active_competition_id' => $active_competition_id,
                    )
                );
            } else {
                $wpdb->insert(
                    $this->table_name_denni,
                    array(
                        'active_competition_id' => $active_competition_id,
                        'competition_type' => $this->competition_type . '_' . $i . '_den',
                        'competition_name' => $i . '_den_' . $this->competition_type . '_' . $i . '_den',
                        'zacatek' => $startOfDay,
                        'konec' => $endOfDay
                    )
                );
            }
            $i++;
        }
    }

    public function divideByAllTime()
    {
        global $wpdb;
        $existing_hlavni_record = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$this->table_name_hlavni` WHERE competition_type = %s", 'hlavni_losovani_' . $this->competition_type));

        // Составление SQL-запроса для выбора самого первого значения из поля 'zacatek' и самого последнего значения из поля 'konec'
        $query = "SELECT MIN(zacatek) as first_zacatek, MAX(konec) as last_konec FROM $this->table_name";
        $active_competition_id = $wpdb->get_var("SELECT active_competition_id FROM `$this->table_name` WHERE competition_type = '$this->competition_type'");

        // Выполнение запроса и получение результата
        $result = $wpdb->get_row($query);

        $firstZacatek = $result->first_zacatek;
        $lastKonec = $result->last_konec;

        if ($existing_hlavni_record) {
            //Update an existing entry
            $wpdb->update(
                $this->table_name_hlavni,
                array(
                    'active_competition_id' => $active_competition_id,
                    // 'competition_type' => $this->competition_type,
                    'competition_name' => 'Hlavní losování',
                    'zacatek' => $firstZacatek,
                    'konec' => $lastKonec,
                ),
                array(
                    'zacatek' => $firstZacatek,
                    'konec' => $lastKonec,
                )
            );
        } else {
            //Insert new entry
            $wpdb->insert(
                $this->table_name_hlavni,
                array(
                    'active_competition_id' => $active_competition_id,
                    'competition_type' => 'hlavni_losovani_' . $this->competition_type,
                    'competition_name' => 'Hlavní losování',
                    'zacatek' => $firstZacatek,
                    'konec' => $lastKonec
                )
            );
        }
    }

    //Tydenni soutezi
    public function removeCompetitionTypeWithTimer()
    {
        global $wpdb;
        // Удаляем записи из таблицы wp_denni_soutezi, связанные с записями в wp_aktivny_soutezi
        $wpdb->query("DELETE FROM {$wpdb->prefix}denni_soutezi WHERE active_competition_id IN (SELECT active_competition_id FROM {$wpdb->prefix}aktivny_soutezi WHERE competition_type = '{$this->competition_type}')");

        // Удаляем записи из таблицы wp_hlavni_soutezi, связанные с записями в wp_aktivny_soutezi и wp_prize_draw
        $wpdb->query("DELETE FROM {$wpdb->prefix}hlavni_soutezi WHERE active_competition_id IN (SELECT active_competition_id FROM {$wpdb->prefix}aktivny_soutezi WHERE competition_type = '{$this->competition_type}')");
        $wpdb->query("DELETE FROM {$wpdb->prefix}hlavni_soutezi WHERE active_competition_id IN (SELECT draw_id FROM {$wpdb->prefix}prize_draw WHERE competition_type = '{$this->competition_type}')");

        // Удаляем записи из таблицы wp_aktivny_soutezi
        $wpdb->delete($this->table_name, array('competition_type' => $this->competition_type));

        // Удаляем записи из таблицы wp_prize_draw
        $wpdb->delete($this->table_name_6, array('competition_type' => $this->competition_type));
    }

    //Denni soutezi
    public function removeByDayTime()
    {
        global $wpdb;
        //Удаляем записи из таблицы wp_denni_soutezi, где active_competition_id не существует в таблице wp_aktivny_soutezi
        $wpdb->query("DELETE FROM {$wpdb->prefix}denni_soutezi WHERE active_competition_id NOT IN (SELECT active_competition_id FROM {$wpdb->prefix}aktivny_soutezi)");
    }

    //hlavni soutezi
    public function removeByAllTime()
    {
        global $wpdb;
        // Составление SQL-запроса для выбора самого первого значения из поля 'zacatek' и самого последнего значения из поля 'konec'
        $query = "SELECT MIN(zacatek) as first_zacatek, MAX(konec) as last_konec FROM $this->table_name";
        $active_competition_id = $wpdb->get_var("SELECT active_competition_id FROM `$this->table_name` WHERE competition_type = '$this->competition_type'");

        // Выполнение запроса и получение результата
        $result = $wpdb->get_row($query);

        $firstZacatek = $result->first_zacatek;
        $lastKonec = $result->last_konec;
        $wpdb->update(
            $this->table_name_hlavni,
            array(
                'active_competition_id' => $active_competition_id,
                'competition_type' => $this->competition_type,
                'competition_name' => 'Hlavní losování',
                'zacatek' => $firstZacatek,
                'konec' => $lastKonec,
            ),
            array(
                'zacatek' => $firstZacatek,
                'konec' => $lastKonec,
            )
        );
    }

    //Losování menu function tydenni
    public function insertDatabase()
    {
        global $wpdb;
        $wpdb->insert(
            $this->table_name_2,
            array(
                // 'competition_id' => $this->competition_id,
                'kontakt_id' => $this->random_winner[0]->kontakt_id,
                'vyhra' => $this->vyhra,
                'competition_type' => $this->competition_type,
                'jmeno' => $this->random_winner[0]->jmeno,
                'prijmeni' => $this->random_winner[0]->prijmeni,
                'telefon' => $this->random_winner[0]->telefon,
                'email' => $this->random_winner[0]->email,
                'psc' => $this->random_winner[0]->psc,
                'datum_nakupu' => $this->random_winner[0]->datum_nakupu,
                'cas_nakupu' => $this->random_winner[0]->cas_nakupu,
                'cena_nakupu' => $this->random_winner[0]->cena_nakupu,
                'cas_plneni' => $this->random_winner[0]->cas_plneni
            )
        );
    }

    //Losování menu function tydenni
    public function updateDatabase()
    {
        global $wpdb;
        $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM $this->table_name_7 WHERE competition_type = '$this->competition_type'");
        if ($kontakt_id == $this->random_winner[0]->kontakt_id) {
            $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM $this->table_name_7 WHERE competition_type = '$this->competition_type'");
            $wpdb->query("DELETE FROM `$this->table_name_11` WHERE `kontakt_id` = $kontakt_id");
        }
        $wpdb->update(
            $this->table_name_2,
            array(
                'kontakt_id' => $this->random_winner[0]->kontakt_id,
                'vyhra' => $this->vyhra,
                'competition_type' => $this->competition_type,
                'jmeno' => $this->random_winner[0]->jmeno,
                'prijmeni' => $this->random_winner[0]->prijmeni,
                'telefon' => $this->random_winner[0]->telefon,
                'email' => $this->random_winner[0]->email,
                'psc' => $this->random_winner[0]->psc,
                'datum_nakupu' => $this->random_winner[0]->datum_nakupu,
                'cas_nakupu' => $this->random_winner[0]->cas_nakupu,
                'cena_nakupu' => $this->random_winner[0]->cena_nakupu,
                'cas_plneni' => $this->random_winner[0]->cas_plneni
            ),
            array('competition_type' => $this->competition_type)
        );
    }

    //Losování menu function denni
    public function insertDatabaseDenni()
    {
        global $wpdb;
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

            $wpdb->insert($this->table_name_winner_denni, array(
                'kontakt_id' => $winner->kontakt_id,
                'vyhra' => $random_vyhra_denni,
                'competition_type' => $this->competition_type,
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
    public function updateDatabaseDenni()
    {
        global $wpdb;
        foreach ($this->random_winner_denni as $winner) {
            $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM $this->table_name_7 WHERE competition_type = '$this->competition_type'");
            if ($kontakt_id == $winner->kontakt_id) {
                $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM $this->table_name_7 WHERE competition_type = '$this->competition_type'");
                $wpdb->query("DELETE FROM `$this->table_name_8` WHERE `kontakt_id` = $kontakt_id");
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

            $vitez_exist = $wpdb->get_results("SELECT * FROM $this->table_name_10");

            $wpdb->update(
                $this->table_name_winner_denni,
                array(
                    'kontakt_id' => $winner->kontakt_id,
                    'vyhra' => $random_vyhra_denni,
                    'competition_type' => $this->competition_type,
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
                    'competition_type' => $this->competition_type,
                )
            );
        }
    }

    public function copyAndSortData()
    {
        global $wpdb;
        // Очистить таблицу перед копированием данных
        $wpdb->query("TRUNCATE TABLE $this->table_name_winner_copie");

        //        $results = $wpdb->get_results("SELECT * FROM $this->table_name_2 ORDER BY cas_plneni ASC, RAND()");
        $results = $wpdb->get_results("SELECT * FROM $this->table_name_winner_denni ORDER BY cas_plneni ASC, RAND()");
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

            $wpdb->insert($this->table_name_winner_copie, array(
                'kontakt_id' => $result->kontakt_id,
                'vyhra' => $random_vyhra_denni,
                //                'competition_type' => $this->competition_type,
                'competition_type' => $result->competition_type,
                //                'competition_type_asc_ordering' => $result->competition_type,
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
    public function insertDatabaseHlavni()
    {
        global $wpdb;
        $wpdb->insert(
            $this->table_name_winner_main,
            array(
                // 'competition_id' => $this->competition_id,
                'kontakt_id' => $this->random_winner[0]->kontakt_id,
                'vyhra' => $this->vyhra_hlavni,
                'competition_type' => $this->competition_type,
                'jmeno' => $this->random_winner[0]->jmeno,
                'prijmeni' => $this->random_winner[0]->prijmeni,
                'telefon' => $this->random_winner[0]->telefon,
                'email' => $this->random_winner[0]->email,
                'psc' => $this->random_winner[0]->psc,
                'datum_nakupu' => $this->random_winner[0]->datum_nakupu,
                'cas_nakupu' => $this->random_winner[0]->cas_nakupu,
                'cena_nakupu' => $this->random_winner[0]->cena_nakupu,
                'cas_plneni' => $this->random_winner[0]->cas_plneni
            )
        );
    }

    //Losování menu function hlavni
    public function updateDatabaseHlavni()
    {
        global $wpdb;
        $wpdb->update(
            $this->table_name_winner_main,
            array(
                // 'competition_id' => $this->competition_id,
                'kontakt_id' => $this->random_winner[0]->kontakt_id,
                'vyhra' => $this->vyhra_hlavni,
                'competition_type' => $this->competition_type,
                'jmeno' => $this->random_winner[0]->jmeno,
                'prijmeni' => $this->random_winner[0]->prijmeni,
                'telefon' => $this->random_winner[0]->telefon,
                'email' => $this->random_winner[0]->email,
                'psc' => $this->random_winner[0]->psc,
                'datum_nakupu' => $this->random_winner[0]->datum_nakupu,
                'cas_nakupu' => $this->random_winner[0]->cas_nakupu,
                'cena_nakupu' => $this->random_winner[0]->cena_nakupu,
                'cas_plneni' => $this->random_winner[0]->cas_plneni
            ),
            array('competition_type' => $this->competition_type)
        );
    }

    //Losování menu function
    public function sendTransactionMails()
    {
        //Здесь будут отправляться транзакционные имэйлы
        $this->api->sendTransactionalEmail(
            array(
                'template_id' => $this->template_id,
                'subject' => 'Vyhral\a jste ' . $this->vyhra,
                'from_name' => get_option('blogname'),
                'from_email' => get_option('admin_email'),
                'reply_to' => get_option('admin_email'),
                'email' => $this->email,
                'name' => $this->name . ' ' . $this->surname,
                'name' => 'text',
                'content' => $this->vyhra_mail . "<br>Váš odkaz:" . get_option('siteurl') . "/index.php/" . $this->shortToken
                //            'content' => $this->vyhra_mail . "<br>Váš odkaz:" . get_option('siteurl') . "/index.php/" . $this->shortToken . $this->name . $this->shortToken . $this->surname . $this->shortToken . $this->kontakt_id . $this->shortToken
            ),
            TRUE,
            TRUE
        );

        if (!empty($this->template_id)) {
            $this->vitez->sendTransactionEmail(array(
                'competition_type' => $this->competition_type,
                'kontakt_id' => $this->kontakt_id,
                'jmeno' => $this->name,
                'prijmeni' => $this->surname,
                'vyhra' => $this->vyhra,
                //                'link' => get_option('siteurl') . "/index.php/" . $this->shortToken . $this->name . $this->shortToken . $this->surname . $this->shortToken . $this->kontakt_id . $this->shortToken, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
                'link' => get_option('siteurl') . "/index.php/" . $this->shortToken, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
                'checkbox_column' => '',
            ));
        } else {
            echo "template_id chybí. Přidat mužete v položce menu Maily";
        }
    }

    public function changeQuantityOfCompetition()
    {
        global $wpdb;
        $field_name = 'quantity';
        $current_value = $wpdb->get_var("SELECT $field_name FROM $this->table_name WHERE competition_type = '$this->competition_type'");
        $new_value = $current_value - 1;

        // Обновляем базу данных с новым значением $new_value
        $wpdb->update($this->table_name, array($field_name => $new_value), array($field_name => $current_value, 'competition_type' => $this->competition_type));

        // Если $new_value равен 0, выводим сообщение
        if ($new_value < 1) {
            echo "No more mails.";
        }
    }

    //Losování menu function
    public function sendDaysTransactionMails($competition_type, $template_id, $vyhra, $jmeno, $prijmeni, $email)
    {
        global $wpdb;
        $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM {$this->table_name_denni} WHERE competition_type = '{$this->competition_type}'");
        $vyhra_mail = $wpdb->get_var("SELECT template FROM {$this->table_name_days_mails} WHERE denni_competition_id = '{$denni_competition_id}'");
        $query = $wpdb->prepare("SELECT kontakt_id FROM {$this->table_name_8} WHERE jmeno = %s AND prijmeni = %s AND email = %s", $jmeno, $prijmeni, $email);
        $kontakt_id = $wpdb->get_var($query);
        //Здесь будут отправляться транзакционные имэйлы
        $this->api->sendTransactionalEmail(
            array(
                'template_id' => $template_id,
                'subject' => 'Vyhral\a jste ' . $vyhra, //добавить новую базу данных по типу
                'from_name' => get_option('blogname'),
                'from_email' => get_option('admin_email'),
                'reply_to' => get_option('admin_email'),
                'email' => $email,
                'name' => $jmeno . ' ' . $prijmeni,
                'name' => 'text',
                //            'content' => $vyhra_mail . "<br>Váš odkaz:" . get_option('siteurl') . "/index.php" . "/my-page-" . $jmeno . $prijmeni . $kontakt_id . $this->shortToken
                'content' => $vyhra_mail . "<br>Váš odkaz:" . get_option('siteurl') . "/index.php/" . $this->shortToken
            ),
            TRUE,
            TRUE
        );

        if (!empty($template_id)) {
            $this->vitez->sendDaysTransactionEmail(array(
                'competition_type' => $competition_type,
                'kontakt_id' => $kontakt_id,
                'jmeno' => $jmeno,
                'prijmeni' => $prijmeni,
                'vyhra' => $vyhra,
                'link' => get_option('siteurl') . "/index.php/" . $this->shortToken, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
                //                'link' => get_option('siteurl') . "/index.php" . "/my-page-" . $jmeno . $prijmeni . $kontakt_id . $this->shortToken, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
                'checkbox_column' => '',
            ));
        } else {
            echo "template_id chybí. Přidat mužete v položce menu Maily";
        }
    } // Разобраться с $competition_type для denni...

    public function changeQuantityOfDaysCompetition()
    {
        global $wpdb;
        $field_name = 'quantity';
        $field_name_total = 'total_quantity';
        $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $this->table_name_denni WHERE competition_type = '{$this->competition_type}'");
        //        $current_value = $wpdb->get_var( "SELECT $field_name FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value = $wpdb->get_var("SELECT $field_name FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        //        $current_value_total = $wpdb->get_var( "SELECT $field_name_total FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value_total = $wpdb->get_var("SELECT $field_name_total FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        $new_value = $current_value - 1;
        $another_value = $current_value_total - 1;

        //        $wpdb->update( $this->table_name_denni, array( $field_name => $new_value, $field_name_total => $another_value ), array( $field_name => $current_value, $field_name_total => $current_value_total, 'nameof' => 'denni' ) );
        $wpdb->update($this->table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    }

    public function changeQuantityOfDaysCompetition2()
    {
        global $wpdb;
        $field_name = 'quantity2';
        $field_name_total = 'total_quantity';
        $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $this->table_name_denni WHERE competition_type = '{$this->competition_type}'");
        //        $current_value = $wpdb->get_var( "SELECT $field_name FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value = $wpdb->get_var("SELECT $field_name FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        //        $current_value_total = $wpdb->get_var( "SELECT $field_name_total FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value_total = $wpdb->get_var("SELECT $field_name_total FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        $new_value = $current_value - 1;
        $another_value = $current_value_total - 1;

        //        $wpdb->update( $this->table_name_denni, array( $field_name => $new_value, $field_name_total => $another_value ), array( $field_name => $current_value, $field_name_total => $current_value_total, 'nameof' => 'denni' ) );
        $wpdb->update($this->table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    }

    public function changeQuantityOfDaysCompetition3()
    {
        global $wpdb;
        $field_name = 'quantity3';
        $field_name_total = 'total_quantity';
        $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $this->table_name_denni WHERE competition_type = '{$this->competition_type}'");
        //        $current_value = $wpdb->get_var( "SELECT $field_name FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value = $wpdb->get_var("SELECT $field_name FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        //        $current_value_total = $wpdb->get_var( "SELECT $field_name_total FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value_total = $wpdb->get_var("SELECT $field_name_total FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        $new_value = $current_value - 1;
        $another_value = $current_value_total - 1;

        //        $wpdb->update( $this->table_name_denni, array( $field_name => $new_value, $field_name_total => $another_value ), array( $field_name => $current_value, $field_name_total => $current_value_total, 'nameof' => 'denni' ) );
        $wpdb->update($this->table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    }

    public function changeQuantityOfDaysCompetition4()
    {
        global $wpdb;
        $field_name = 'quantity4';
        $field_name_total = 'total_quantity';
        $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $this->table_name_denni WHERE competition_type = '{$this->competition_type}'");
        //        $current_value = $wpdb->get_var( "SELECT $field_name FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value = $wpdb->get_var("SELECT $field_name FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        //        $current_value_total = $wpdb->get_var( "SELECT $field_name_total FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value_total = $wpdb->get_var("SELECT $field_name_total FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        $new_value = $current_value - 1;
        $another_value = $current_value_total - 1;

        //        $wpdb->update( $this->table_name_denni, array( $field_name => $new_value, $field_name_total => $another_value ), array( $field_name => $current_value, $field_name_total => $current_value_total, 'nameof' => 'denni' ) );
        $wpdb->update($this->table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    }

    public function changeQuantityOfDaysCompetition5()
    {
        global $wpdb;
        $field_name = 'quantity5';
        $field_name_total = 'total_quantity';
        $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $this->table_name_denni WHERE competition_type = '{$this->competition_type}'");
        //        $current_value = $wpdb->get_var( "SELECT $field_name FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value = $wpdb->get_var("SELECT $field_name FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        //        $current_value_total = $wpdb->get_var( "SELECT $field_name_total FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value_total = $wpdb->get_var("SELECT $field_name_total FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        $new_value = $current_value - 1;
        $another_value = $current_value_total - 1;

        //        $wpdb->update( $this->table_name_denni, array( $field_name => $new_value, $field_name_total => $another_value ), array( $field_name => $current_value, $field_name_total => $current_value_total, 'nameof' => 'denni' ) );
        $wpdb->update($this->table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    }

    public function changeQuantityOfDaysCompetition6()
    {
        global $wpdb;
        $field_name = 'quantity6';
        $field_name_total = 'total_quantity';
        $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $this->table_name_denni WHERE competition_type = '{$this->competition_type}'");
        //        $current_value = $wpdb->get_var( "SELECT $field_name FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value = $wpdb->get_var("SELECT $field_name FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        //        $current_value_total = $wpdb->get_var( "SELECT $field_name_total FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value_total = $wpdb->get_var("SELECT $field_name_total FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        $new_value = $current_value - 1;
        $another_value = $current_value_total - 1;

        //        $wpdb->update( $this->table_name_denni, array( $field_name => $new_value, $field_name_total => $another_value ), array( $field_name => $current_value, $field_name_total => $current_value_total, 'nameof' => 'denni' ) );
        $wpdb->update($this->table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    }

    public function changeQuantityOfDaysCompetition7()
    {
        global $wpdb;
        $field_name = 'quantity7';
        $field_name_total = 'total_quantity';
        $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $this->table_name_denni WHERE competition_type = '{$this->competition_type}'");
        //        $current_value = $wpdb->get_var( "SELECT $field_name FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value = $wpdb->get_var("SELECT $field_name FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        //        $current_value_total = $wpdb->get_var( "SELECT $field_name_total FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value_total = $wpdb->get_var("SELECT $field_name_total FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        $new_value = $current_value - 1;
        $another_value = $current_value_total - 1;

        //        $wpdb->update( $this->table_name_denni, array( $field_name => $new_value, $field_name_total => $another_value ), array( $field_name => $current_value, $field_name_total => $current_value_total, 'nameof' => 'denni' ) );
        $wpdb->update($this->table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    }

    public function changeQuantityOfDaysCompetition8()
    {
        global $wpdb;
        $field_name = 'quantity8';
        $field_name_total = 'total_quantity';
        $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $this->table_name_denni WHERE competition_type = '{$this->competition_type}'");
        //        $current_value = $wpdb->get_var( "SELECT $field_name FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value = $wpdb->get_var("SELECT $field_name FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        //        $current_value_total = $wpdb->get_var( "SELECT $field_name_total FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value_total = $wpdb->get_var("SELECT $field_name_total FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        $new_value = $current_value - 1;
        $another_value = $current_value_total - 1;

        $wpdb->update($this->table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'nameof' => 'denni'));
        $wpdb->update($this->table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    }

    public function changeQuantityOfDaysCompetition9()
    {
        global $wpdb;
        $field_name = 'quantity9';
        $field_name_total = 'total_quantity';
        $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $this->table_name_denni WHERE competition_type = '{$this->competition_type}'");
        //        $current_value = $wpdb->get_var( "SELECT $field_name FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value = $wpdb->get_var("SELECT $field_name FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        //        $current_value_total = $wpdb->get_var( "SELECT $field_name_total FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value_total = $wpdb->get_var("SELECT $field_name_total FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        $new_value = $current_value - 1;
        $another_value = $current_value_total - 1;

        //        $wpdb->update( $this->table_name_denni, array( $field_name => $new_value, $field_name_total => $another_value ), array( $field_name => $current_value, $field_name_total => $current_value_total, 'nameof' => 'denni' ) );
        $wpdb->update($this->table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    }

    public function changeQuantityOfDaysCompetition10()
    {
        global $wpdb;
        $field_name = 'quantity10';
        $field_name_total = 'total_quantity';
        $denni_competition_id = $wpdb->get_var("SELECT denni_competition_id FROM $this->table_name_denni WHERE competition_type = '{$this->competition_type}'");
        //        $current_value = $wpdb->get_var( "SELECT $field_name FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value = $wpdb->get_var("SELECT $field_name FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        //        $current_value_total = $wpdb->get_var( "SELECT $field_name_total FROM $this->table_name_denni WHERE nameof = 'denni'" );
        $current_value_total = $wpdb->get_var("SELECT $field_name_total FROM $this->table_name_denni WHERE denni_competition_id = '$denni_competition_id'");
        $new_value = $current_value - 1;
        $another_value = $current_value_total - 1;

        //        $wpdb->update( $this->table_name_denni, array( $field_name => $new_value, $field_name_total => $another_value ), array( $field_name => $current_value, $field_name_total => $current_value_total, 'nameof' => 'denni' ) );
        $wpdb->update($this->table_name_denni, array($field_name => $new_value, $field_name_total => $another_value), array($field_name => $current_value, $field_name_total => $current_value_total, 'denni_competition_id' => $denni_competition_id));
    }

    //Losování menu function
    public function sendMainTransactionMails($template_id, $main_competition_id)
    {
        global $wpdb;
        $vyhra_hlavni_mail = $wpdb->get_var("SELECT template FROM {$this->table_name_main_mails} WHERE main_competition_id = {$main_competition_id}");
        //Здесь будут отправляться транзакционные имэйлы
        $this->api->sendTransactionalEmail(
            array(
                'template_id' => $template_id,
                'subject' => 'Vyhral\a jste ' . $this->vyhra_hlavni,
                'from_name' => get_option('blogname'),
                'from_email' => get_option('admin_email'),
                'reply_to' => get_option('admin_email'),
                'email' => $this->main_email,
                'name' => $this->main_name . ' ' . $this->main_surname,
                'name' => 'text',
                //            'content' => $vyhra_hlavni_mail . "<br>Váš odkaz:" . get_option('siteurl') . "/index.php" . "/my-page-" . $this->main_name . '-' . $this->main_surname . '-' . $this->main_kontakt_id
                'content' => $vyhra_hlavni_mail . "<br>Váš odkaz:" . get_option('siteurl') . "/index.php/" . $this->shortToken
            ),
            TRUE,
            TRUE
        );

        if (!empty($template_id)) {
            $this->vitez->sendMainTransactionEmail(array(
                'competition_type' => $this->competition_type,
                'kontakt_id' => $this->main_kontakt_id,
                'jmeno' => $this->main_name,
                'prijmeni' => $this->main_surname,
                'vyhra' => $this->vyhra_hlavni,
                'link' => get_option('siteurl') . "/index.php/" . $this->shortToken, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
                //                'link' => get_option('siteurl') . "/index.php" . "/my-page-" . $this->main_name . '-' . $this->main_surname . '-' . $this->main_kontakt_id, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
                'checkbox_column' => '',
            ));
        } else {
            echo "template_id chybí. Přidat mužete v položce menu Maily";
        }
    }

    public function changeQuantityOfMainCompetition()
    {
        global $wpdb;
        $field_name = 'quantity';
        $current_value = $wpdb->get_var("SELECT $field_name FROM $this->table_name_hlavni WHERE competition_type = '$this->competition_type'");
        $new_value = $current_value - 1;

        $wpdb->update($this->table_name_hlavni, array($field_name => $new_value), array($field_name => $current_value, 'competition_type' => $this->competition_type));
    }

    //Losování menu function
    public function deleteTypeOfCompetition()
    {
        global $wpdb;
        if (!empty($this->template_id)) {
            $wpdb->delete($this->table_name_5, array('competition_type' => $this->competition_type));
        }
    }

    //Losování menu function
    public function deleteDaysTypeOfCompetition($template_id)
    {
        global $wpdb;
        if (!empty($template_id)) {
            $wpdb->delete($this->table_name_denni, array('competition_type' => $this->competition_type));
        } //продолжить
    }

    //Losování menu function
    public function deleteMainTypeOfCompetition($template_id)
    {
        global $wpdb;
        if (!empty($template_id)) {
            $wpdb->delete($this->table_name_hlavni, array('nameof' => 'hlavni'));
        } //продолжить
    }

    public function createPageWithEndpoint()
    {

        //        $PageGuid = get_option('siteurl') . "/index.php/" . $this->name . $this->surname . $this->kontakt_id . $this->shortToken;
        $PageGuid = get_option('siteurl') . "/index.php/" . $this->shortToken;

        $post_content = '
        <style>
            header.wp-block-template-part {
                display: none;
            }
            footer.wp-block-template-part {
                display: none;
            }
        </style>
        <form id="featured_upload" method="post" action="post-form.php" enctype="multipart/form-data">
            <input type="hidden" name="competition_type" value="' . $this->competition_type . '">
            
            <input type="hidden" name="kontakt_id" value="' . $this->kontakt_id . '">
            
            <input type="hidden" name="shortToken" value="' . $this->shortToken . '">
            
            <label>Your name</label>
            <input type="text" name="your-name" autocomplete="name" value="' . $this->name . '" required>
        
            <label>Your surname</label>
            <input type="text" name="your-surname" autocomplete="name" value="' . $this->surname . '" required>
            
            <label>Vyhral jste</label>
            <input type="text" name="your-vyhra" autocomplete="prize" value="' . $this->vyhra . '" required>
        
            <label>Your address</label>
            <input type="text" name="your-address" autocomplete="address" required>
        
            <input type="file" name="your-file" id="your-file" multiple="false" />
            <input type="hidden" name="submit_action" value="upload" />
            <input id="submit_action" name="submit_action" type="submit" value="Upload" />
        </form>
        ';

        $my_post = array(
            'post_title'     => 'Form for ' . $this->name . ' ' . $this->surname,
            'post_type'      => 'page',
            'post_name'      => $this->shortToken,
            //            'post_name'      => $this->name . $this->surname . $this->kontakt_id . $this->shortToken,
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
        global $wpdb;
        $query = $wpdb->prepare("SELECT kontakt_id FROM {$this->table_name_winner_copie} WHERE jmeno = %s AND prijmeni = %s AND email = %s", $jmeno, $prijmeni, $email);
        $kontakt_id = $wpdb->get_var($query);

        //        $PageGuid = get_option('siteurl') . "/index.php" . "/my-page-" . $jmeno . $prijmeni . $kontakt_id . $this->shortToken;
        $PageGuid = get_option('siteurl') . "/index.php/" . $this->shortToken;

        $post_content = '
        <style>
            header.wp-block-template-part {
                display: none;
            }
            footer.wp-block-template-part {
                display: none;
            }
        </style>
        <form id="featured_upload" method="post" action="post-form.php" enctype="multipart/form-data">
            <input type="hidden" name="competition_type" value="' . $competition_type . '">
            
            <input type="hidden" name="kontakt_id" value="' . $kontakt_id . '">
            
            <label>Your name</label>
            <input type="text" name="your-name" autocomplete="name" value="' . $jmeno . '" required>
        
            <label>Your surname</label>
            <input type="text" name="your-surname" autocomplete="name" value="' . $prijmeni . '" required>
            
            <label>Vyhral jste</label>
            <input type="text" name="your-vyhra" autocomplete="prize" value="' . $vyhra . '" required>
        
            <label>Your address</label>
            <input type="text" name="your-address" autocomplete="address" required>
        
            <input type="file" name="your-file" id="your-file" multiple="false" />
            <input type="hidden" name="submit_action" value="upload" />
            <input id="submit_action" name="submit_action" type="submit" value="Upload" />
        </form>
        ';

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
        //        $PageGuid = get_option('siteurl') . "/index.php" . "/my-page-" . $this->main_name . '-' . $this->main_surname . '-' . $this->main_kontakt_id;
        $post_content = '
        <style>
            header.wp-block-template-part {
                display: none;
            }
            footer.wp-block-template-part {
                display: none;
            }
        </style>
        <form id="featured_upload" method="post" action="post-form.php" enctype="multipart/form-data">
        
            <input type="hidden" name="competition_type" value="' . $this->competition_type . '">
            
            <input type="hidden" name="kontakt_id" value="' . $this->main_kontakt_id . '">
            <label>Your name</label>
            <input type="text" name="your-name" autocomplete="name" value="' . $this->main_name . '" required>
        
            <label>Your surname</label>
            <input type="text" name="your-surname" autocomplete="name" value="' . $this->main_surname . '" required>
            
            <label>Your prize</label>
            <input type="text" name="your-vyhra" autocomplete="vyhra" value="' . $this->vyhra_hlavni . '" required>
        
            <label>Your address</label>
            <input type="text" name="your-address" autocomplete="address" required>
        
            <input type="file" name="your-file" id="your-file" multiple="false" />
            <input type="hidden" name="submit_action" value="upload" />
            <input id="submit_action" name="submit_action" type="submit" value="Upload" />
        </form>
        ';

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
