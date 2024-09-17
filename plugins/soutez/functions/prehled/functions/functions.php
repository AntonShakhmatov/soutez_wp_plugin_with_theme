<?php

require_once 'db_functions.php';

//Přehled menu
function my_contest_page_vsichni()
{
    $subscribers = selectAllFromKontaktniUdaje();
    echo "<table style = 'padding-top:3vh; padding-left:10vh;'>";
    echo "<tr>
    <th style = 'padding:1vh;'>Jmeno</th>
    <th style = 'padding:1vh;'>Prijmeni</th>
    <th style = 'padding:1vh;'>Telefon</th>
    <th style = 'padding:1vh;'>Email</th>
    <th style = 'padding:1vh;'>PSC</th>
    <th style = 'padding:1vh;'>Datum nakupu</th>
    <th style = 'padding:1vh;'>Cas nakupu</th>
    <th style = 'padding:1vh;'>Cena nakupu</th>
    <th style = 'padding:1vh;'>Čas plnění</th>

    </tr>";

    foreach ($subscribers as $subscriber) {
        echo "<tr>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->jmeno . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->prijmeni . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->telefon . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->email . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->psc . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->datum_nakupu . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->cas_nakupu . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->cena_nakupu . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->cas_plneni . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}
