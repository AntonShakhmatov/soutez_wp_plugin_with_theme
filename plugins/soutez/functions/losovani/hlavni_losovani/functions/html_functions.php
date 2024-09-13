<?php

function getLinkForMain($competition_type)
{
    echo "<table style='padding-top:3vh;'>";
    echo "<tr>
              <th style='padding:1vh;'><a href='#' id='welcome-link-$competition_type->competition_type' class='welcome-link'>{$competition_type->zacatek} - {$competition_type->konec} ($competition_type->quantity)</a></th>
          </tr>";
    echo "</table>";
}

function getHtmlTableForMain($viteze_po_obnoveni, $competition_type)
{
    // echo "<table class='table-container' id='table-container-$competition_type->competition_type' class='table-container'>"; //Вариатор для admin_script.js
    echo "<table id='table-container' class='table-container'>";
    echo "<tr>
                        <th style='padding:1vh;'>Vyhra</th>
                        <th style='padding:1vh;'>Jmeno</th>
                        <th style='padding:1vh;'>Prijmeni</th>
                        <th style='padding:1vh;'>Telefon</th>
                        <th style='padding:1vh;'>Email</th>
                        <th style='padding:1vh;'>PSČ</th>
                        <th style='padding:1vh;'>Datum nakupu</th>
                        <th style='padding:1vh;'>Čas nakupu</th>
                        <th style='padding:1vh;'>Cas vyplneni</th>
                      </tr>";
    foreach ($viteze_po_obnoveni as $vitez) {

        echo "<td class='td-container' style='padding:2vh;'>{$vitez->vyhra}</td>";
        echo "<td class='td-container' style='padding:2vh;'>{$vitez->jmeno}</td>";
        echo "<td class='td-container' style='padding:2vh;'>{$vitez->prijmeni}</td>";
        echo "<td class='td-container' style='padding:2vh;'>{$vitez->telefon}</td>";
        echo "<td class='td-container' style='padding:2vh;'>{$vitez->email}</td>";
        echo "<td class='td-container' style='padding:2vh;'>{$vitez->psc}</td>";
        echo "<td class='td-container' style='padding:2vh;'>{$vitez->datum_nakupu}</td>";
        echo "<td class='td-container' style='padding:2vh;'>{$vitez->cas_nakupu}</td>";
        echo "<td class='td-container' style='padding:2vh;'>{$vitez->cas_plneni}</td><br>";
        echo '<tr>
                        <td>
                            <form method="post" action="' . esc_url(add_query_arg('action', 'update_db', get_permalink())) . '">
                                <input type="hidden" name="competition_type" value="' . $competition_type->competition_type . '">
                                <button type="submit" name="action" value="update_db">Potvrdit</button>
                            </form>
                        </td>
                      </tr>';
        echo "</table>";
    }
}
