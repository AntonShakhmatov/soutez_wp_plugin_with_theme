<?php

require_once 'db_functions.php';

//Účtenky menu
function my_contest_subpage_uctenky()
{

    $winners = selectAllFromUctenkaViteze();

    echo "<form method='post' action=''>";
    echo "<table style='padding-top:3vh; padding-left:10vh;'>";
    echo "<tr>
    <th style='padding:1vh;'>Jmeno</th>
    <th style='padding:1vh;'>Prijmeni</th>
    <th style='padding:1vh;'>Vyhral</th>
    <th style='padding:1vh;'>Adresa</th>
    <th style='padding:1vh;'>Účtenka</th>
    <th style='padding:1vh;'>Misto pro odkaz</th>
    <th style='padding:1vh;'>Button</th>
    <th style='padding:1vh;'>Stav</th>
    </tr>";

    foreach ($winners as $winner) {
        echo "<tr>";
        echo "<td style='padding:2vh;'>" . $winner->jmeno . "</td>";
        echo "<td style='padding:2vh;'>" . $winner->prijmeni . "</td>";
        echo "<td style='padding:2vh;'>" . $winner->vyhra . "</td>";
        echo "<td style='padding:2vh;'>" . $winner->adresa . "</td>";
        $mime_type = mime_content_type($winner->file_link);
        $image_data = file_get_contents($winner->file_link);
        $base64_image = base64_encode($image_data);
        echo "<td style='padding:2vh;'><img src='data:" . $mime_type . ";base64," . $base64_image . "' alt='Изображение'></td>";
        echo "<td style='padding:2vh;'><input id='geo-link-" . $winner->kontakt_id . "' name='geo-link-" . $winner->kontakt_id . "'></input></td>";
        echo "<td style='padding:2vh;'><input type='submit' name='submit-" . $winner->kontakt_id . "' value='Poslat track kod k " . $winner->jmeno . " " . $winner->prijmeni . "' ></td>";
        echo "<td style='padding:2vh;'>" . $winner->checkbox . "</td>";
        echo "</tr>";

        if (!empty($_POST['geo-link-' . $winner->kontakt_id]) && isset($_POST['submit-' . $winner->kontakt_id]) && $_POST['submit-' . $winner->kontakt_id] == "Poslat track kod k " . $winner->jmeno . " " . $winner->prijmeni) {
            $geo = new Geo($winner->kontakt_id, $_POST['geo-link-' . $winner->kontakt_id]);
            $geo->sendGeoTracking();
        }
    }
    echo "</table>";
    echo "</form>";
}
