<?php

echo "<tr>";
foreach ($copie_viteze_po_obnoveni as $vitez) {
    if ($vitez->cas_plneni >= $competition_type->zacatek && $vitez->cas_plneni <= $competition_type->konec) {
        $row = "<td class='td-container' style='padding:2vh;'>{$vitez->vyhra}</td>";
        $row .= "<td class='td-container' style='padding:2vh;'>{$vitez->jmeno}</td>";
        $row .= "<td class='td-container' style='padding:2vh;'>{$vitez->prijmeni}</td>";
        $row .= "<td class='td-container' style='padding:2vh;'>{$vitez->telefon}</td>";
        $row .= "<td class='td-container' style='padding:2vh;'>{$vitez->email}</td>";
        $row .= "<td class='td-container' style='padding:2vh;'>{$vitez->psc}</td>";
        $row .= "<td class='td-container' style='padding:2vh;'>{$vitez->datum_nakupu}</td>";
        $row .= "<td class='td-container' style='padding:2vh;'>{$vitez->cas_nakupu}</td>";
        $row .= "<td class='td-container' style='padding:2vh;'>{$vitez->cena_nakupu}</td>";
        $row .= "<td class='td-container' style='padding:2vh;'>{$vitez->cas_plneni}</td>";

        echo $row;
    }
}
echo "</tr>";
