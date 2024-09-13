<?php

function getLinks($competition_type)
{
    echo "<table style='padding-top:3vh;'>";
    echo "<tr>
                  <th style='padding:1vh;'><a href='#' id='welcome-link-{$competition_type->competition_name}' class='welcome-link'>{$competition_type->zacatek} - {$competition_type->konec} (" . get_option('totalQuantity') . "/{$competition_type->total_quantity})</a></th>
              </tr>";
    echo "</table>";
}

function getHtmlTable($competition_type, $copie_viteze_po_obnoveni, $nameAndSurname)
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'prize_for_day';
    echo "<table id='table-container-$competition_type->competition_name' class='table-container'>"; // вариатор для admin_script.js

    echo "<tr>
                        <th style='padding:1vh;'>Vyhra</th>
                        <th style='padding:1vh;'>Jmeno</th>
                        <th style='padding:1vh;'>Prijmeni</th>
                        <th style='padding:1vh;'>Telefon</th>
                        <th style='padding:1vh;'>Email</th>
                        <th style='padding:1vh;'>PSČ</th>
                        <th style='padding:1vh;'>Datum nakupu</th>
                        <th style='padding:1vh;'>Čas nakupu</th>
                        <th style='padding:1vh;'>Cena nakupu</th>
                        <th style='padding:1vh;'>Cas vyplneni</th>
                      </tr>";
    echo "<tr>";
    $randomRows = array(); // Создаем пустой массив для случайного выбора строки

    foreach ($copie_viteze_po_obnoveni as $vitez) {
        if ($vitez->cas_plneni >= $competition_type->zacatek && $vitez->cas_plneni <= $competition_type->konec) {
            $randomRows[] = $vitez; // Добавляем строку в массив случайных строк
        }
    }

    if (!empty($randomRows)) {
        $randomIndex = array_rand($randomRows); // Выбираем случайный индекс из массива случайных строк
        $selectedVitez = $randomRows[$randomIndex]; // Получаем случайно выбранную строку


        $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM $table_name WHERE kontakt_id = '{$selectedVitez->kontakt_id}'");
        //                <button type="submit" name="action" value="update_db">Potvrdit</button>

        if ($kontakt_id == $selectedVitez->kontakt_id) {
            echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
        } else {
            echo "<td class='td-container' style='padding:2vh;'>{$selectedVitez->vyhra}</td>";
            echo "<td class='td-container' style='padding:2vh;'>{$selectedVitez->jmeno}</td>";
            echo "<td class='td-container' style='padding:2vh;'>{$selectedVitez->prijmeni}</td>";
            echo "<td class='td-container' style='padding:2vh;'>{$selectedVitez->telefon}</td>";
            echo "<td class='td-container' style='padding:2vh;'>{$selectedVitez->email}</td>";
            echo "<td class='td-container' style='padding:2vh;'>{$selectedVitez->psc}</td>";
            echo "<td class='td-container' style='padding:2vh;'>{$selectedVitez->datum_nakupu}</td>";
            echo "<td class='td-container' style='padding:2vh;'>{$selectedVitez->cas_nakupu}</td>";
            echo "<td class='td-container' style='padding:2vh;'>{$selectedVitez->cena_nakupu}</td>";
            echo "<td class='td-container' style='padding:2vh;'>{$selectedVitez->cas_plneni}</td>";

            echo "</tr>";
            echo '<tr>
                  <td>
                      <form method="post" id="ajax_form" action="">
                           <input type="hidden" name="competition_type" id="competition_type" value="' . $competition_type->competition_type . '">
                           <input name="competition_typ" value="' . var_dump($selectedVitez) . '">
                           <input name="competition_typ" value="' . var_dump($selectedVitez->vyhra) . '">
                           <input type="hidden" name="vyhra" id="vyhra" value="' . $selectedVitez->vyhra . '">
                           <input type="hidden" name="name" id="name" value="' . $selectedVitez->jmeno . '">
                           <input type="hidden" name="surname" id="surname" value="' . $selectedVitez->prijmeni . '">
                           <input type="hidden" name="email" id="email" value="' . $selectedVitez->email . '">
                           <button type="submit" id="btn" name="submit" value="update_db">Potvrdit</button>
                      </form>
                  </td>
              </tr>';
            echo "</table>";
        }
        if (isset($_POST['submit']) && $_POST['submit'] == 'update_db' && $_POST['competition_type'] == $competition_type->competition_type) {
            //            getDaysFunctions($competition_type, $update, $selectedVitez);
            sendMail();
        }
    }
}
