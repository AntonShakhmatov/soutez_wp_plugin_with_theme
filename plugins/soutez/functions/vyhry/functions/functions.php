<?php

//Vyhry menu
function my_contest_subpage_vyhry()
{
    global $wpdb;
    //    $table_name = $wpdb->prefix . 'prize';
    $table_name = $wpdb->prefix . 'viteze';
    $subscribers = $wpdb->get_results(
        "
        SELECT *
        FROM $table_name
        "
    );
    echo "<table style = 'padding-top:3vh; padding-left:10vh;'>";
    echo "<tr>
    <th style = 'padding:1vh;'>Jmeno</th>
    <th style = 'padding:1vh;'>Prijmeni</th>
    <th style = 'padding:1vh;'>Adresa</th>
    <th style = 'padding:1vh;'>Potvrzeni o přijeti</th>
    </tr>";
    //    <th style = 'padding:1vh;'>Vyhral</th>
    //    <th style = 'padding:1vh;'>Link</th>
    foreach ($subscribers as $subscriber) {
        echo "<tr>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->jmeno . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->prijmeni . "</td>";
        //        echo "<td style = 'padding:2vh;'>" . $subscriber->vyhra . "</td>";
        //        echo "<td style = 'padding:2vh;'><a href=$subscriber->link>" . $subscriber->link . "</a></td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->adresa . "</td>";
        //        echo "<td style = 'padding:2vh;'>" . $subscriber->checkbox_column . "</td>";
        echo "<td style = 'padding:2vh;'>" . $subscriber->checkbox . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}
