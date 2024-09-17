<?php

function getLinkForMain($competition_type)
{
    echo "<table style='padding-top:3vh;'>";
    echo "<tr>
        <th style='padding:1vh;'><a href='#' id='welcome-link-$competition_type->competition_type' class='welcome-link'>{$competition_type->zacatek} - {$competition_type->konec} ($competition_type->quantity)</a></th>
      </tr>";
    echo "</table>";
}

function getScript()
{
    // Возможно, время обновления стоит сделать более разумным
    echo "<script>setTimeout(function(){location.reload()}, 5000);</script>";
}

function getTable($competition_type)
{
    // Начало таблицы
    $html = "<table class='table-container' id='table-container-" . esc_attr($competition_type->competition_type) . "'>"; // идентификатор для admin_script.js
    $html .= "<tr>
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
    // Закрываем таблицу
    $html .= "</table>"; // Закрываем тег <table>
    return $html;
}

function getTdContainer()
{
    $html = "<td class='td-container' style='padding:2vh;'>";
    return $html;
}

function getTr($competition_type, $viteze_po_obnoveni = null)
{
    // Проверяем, что $viteze_po_obnoveni содержит данные
    if (!empty($viteze_po_obnoveni)) {
        $html = '<tr>
        <td>
            <form method="post" action="' . esc_url(add_query_arg('action', 'update_db', get_permalink())) . '">
                <input type="hidden" name="competition_type" value="' . $competition_type->competition_type . '">
                <input type="hidden" name="kontakt_id" id="kontakt_id" value="' . $viteze_po_obnoveni[0]->kontakt_id . '">
                <input type="hidden" name="vyhra" id="vyhra" value="' . $viteze_po_obnoveni[0]->vyhra . '">
                <input type="hidden" name="name" id="name" value="' . $viteze_po_obnoveni[0]->jmeno . '">
                <input type="hidden" name="surname" id="surname" value="' . $viteze_po_obnoveni[0]->prijmeni . '">
                <input type="hidden" name="email" id="email" value="' . $viteze_po_obnoveni[0]->email . '">
                <input type="submit" name="action" value="update_db">
            </form>
        </td>
      </tr>';
    } else {
        // Если данных нет, выводим сообщение об отсутствии данных
        $html = '<tr><td colspan="5">Нет данных для отображения</td></tr>';
    }

    return $html;
}
