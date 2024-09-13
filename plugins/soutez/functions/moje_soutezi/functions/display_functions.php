<?php

function displayWeeksCompetitionsTable($competitions)
{
    echo "<table style = 'padding-top:3vh; padding-left:50vh;'>";
    echo "<tr>
    <th style = 'padding:1vh;'>Competition type</th>
    <th style = 'padding:1vh;'>Vyhra</th>
    <th style = 'padding:1vh;'>Quantity</th>
    <th style = 'padding:1vh;'>Zacatek</th>
    <th style = 'padding:1vh;'>Konec</th>
    </tr>";
    foreach ($competitions as $competition) {
        echo "<tr>";
        echo "<td style = 'padding:2vh;'>" . $competition->competition_type . "</td>";
        echo "<td style = 'padding:2vh;'>" . $competition->vyhra . "</td>";
        echo "<td style = 'padding:2vh;'>" . $competition->quantity . "</td>";
        echo "<td style = 'padding:2vh;'>" . $competition->zacatek . "</td>";
        echo "<td style = 'padding:2vh;'>" . $competition->konec . "</td>";
        echo "<tr>";
    }
    echo "</table>";
}

function displayCompetitionsTable($denni_competitions, $hlavni_competitions)
{
    echo "<table style = 'padding-top:3vh; padding-left:50vh;'>";
    echo "<tr>
    <th style = 'padding:1vh;'>Competition type</th>
    <th style = 'padding:1vh;'>Vyhra</th>
    <th style = 'padding:1vh;'>Vyhra2</th>
    <th style = 'padding:1vh;'>Vyhra3</th>
    <th style = 'padding:1vh;'>Vyhra4</th>
    <th style = 'padding:1vh;'>Vyhra5</th>
    <th style = 'padding:1vh;'>Vyhra6</th>
    <th style = 'padding:1vh;'>Vyhra7</th>
    <th style = 'padding:1vh;'>Vyhra8</th>
    <th style = 'padding:1vh;'>Vyhra9</th>
    <th style = 'padding:1vh;'>Vyhra10</th>
    <th style = 'padding:1vh;'>Quantity</th>
    <th style = 'padding:1vh;'>Zacatek</th>
    <th style = 'padding:1vh;'>Konec</th>
    </tr>";
    foreach ($denni_competitions as $denni_competition) {
        echo "<tr>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->competition_type . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->vyhra . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->vyhra2 . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->vyhra3 . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->vyhra4 . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->vyhra5 . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->vyhra6 . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->vyhra7 . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->vyhra8 . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->vyhra9 . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->vyhra10 . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->total_quantity . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->zacatek . "</td>";
        echo "<td style = 'padding:2vh;'>" . $denni_competition->konec . "</td>";
        echo "<tr>";
    }
    foreach ($hlavni_competitions as $hlavni_competition) {
        echo "<tr>";
        echo "<td style = 'padding:2vh;'>" . $hlavni_competition->nameof . "</td>";
        echo "<td style = 'padding:2vh;'>" . $hlavni_competition->vyhra . "</td>";
        echo "<td style = 'padding:2vh;'>" . $hlavni_competition->quantity . "</td>";
        echo "<td style = 'padding:2vh;'>" . $hlavni_competition->zacatek . "</td>";
        echo "<td style = 'padding:2vh;'>" . $hlavni_competition->konec . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
