<?php

require_once 'db_functions.php';

//Vyhry menu
function my_contest_subpage_vyhry()
{

    $subscribers = selectAllFromViteze();

    echo "<table style = 'padding-top:3vh; padding-left:10vh;'>";
    echo "<tr>
    <th style = 'padding:1vh;'>Jmeno</th>
    <th style = 'padding:1vh;'>Prijmeni</th>
    <th style = 'padding:1vh;'>Adresa</th>
    <th style = 'padding:1vh;'>Potvrzeni o přijeti</th>
    </tr>";
    foreach ($subscribers as $subscriber) {
        echo "<tr>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->jmeno . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->prijmeni . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->adresa . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->checkbox . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}
