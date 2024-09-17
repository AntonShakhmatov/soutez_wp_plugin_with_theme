<?php

// function my_contest_subpage_losovani()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'aktivny_soutezi';
    $table_name_2 = $wpdb->prefix . 'kontaktni_udaje_viteze';
    $table_name_3 = $wpdb->prefix . 'typ_souteze_mails';
    $table_name_4 = $wpdb->prefix . 'prize';
    $competition_types = $wpdb->get_results("SELECT * FROM $table_name"); //aktivny_soutezi

    foreach ($competition_types as $competition_type) {
        $update = new Update($competition_type->competition_type);

        if ($competition_type && $competition_type->quantity != 0) {
            echo "<table style='padding-top:3vh;'>";
            echo "<tr>
                    <th style='padding:1vh;'><a href='#' id='welcome-link-$competition_type->competition_type' class='welcome-link'>{$competition_type->zacatek} - {$competition_type->konec} ($competition_type->quantity)</a></th>
                  </tr>";
            $viteze = $wpdb->get_results("SELECT * FROM $table_name_2 WHERE competition_type = '$competition_type->competition_type'");

            if (empty($viteze)) {
                // Zde budou vkládána pole do databáze
                $update->insertDatabase();
            } else {
                // Zde bude aktualizace databáze
                $update->updateDatabase();
                // Máme obnovit seznam ještě jednou pro synchronizaci
                $zacatek = $competition_type->zacatek;
                $konec = $competition_type->konec;
                $viteze_po_obnoveni = $wpdb->get_results("SELECT * FROM $table_name_2 WHERE competition_type = '$competition_type->competition_type' && cas_plneni >= DATE_SUB('$zacatek', INTERVAL 0 DAY) && cas_plneni <= DATE_SUB('$konec', INTERVAL 0 DAY)");


                $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM $table_name_4 WHERE kontakt_id = '{$viteze_po_obnoveni[0]->kontakt_id}'");
                //                <button type="submit" name="action" value="update_db">Potvrdit</button>

                if ($kontakt_id == $viteze_po_obnoveni[0]->kontakt_id) {
                    echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
                } else {
                    echo "</td>";
                    echo "<table class='table-container' id='table-container-$competition_type->competition_type' class='table-container'>"; //вариатор для admin_script.js
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
                    echo "<td class='td-container' style='padding:2vh;'>";
                    if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->vyhra)) {
                        echo $viteze_po_obnoveni[0]->vyhra;
                    } else {
                        echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
                    }
                    echo "</td>";

                    echo "<td class='td-container' style='padding:2vh;'>";
                    if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->jmeno)) {
                        echo $viteze_po_obnoveni[0]->jmeno;
                    } else {
                        //                    echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
                    }
                    echo "</td>";

                    echo "<td class='td-container' style='padding:2vh;'>";
                    if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->prijmeni)) {
                        echo $viteze_po_obnoveni[0]->prijmeni;
                    } else {
                        //                    echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
                    }
                    echo "</td>";

                    echo "<td class='td-container' style='padding:2vh;'>";
                    if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->telefon)) {
                        echo $viteze_po_obnoveni[0]->telefon;
                    } else {
                        //                    echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
                    }
                    echo "</td>";

                    echo "<td class='td-container' style='padding:2vh;'>";
                    if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->email)) {
                        echo $viteze_po_obnoveni[0]->email;
                    } else {
                        //                    echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
                    }
                    echo "</td>";

                    echo "<td class='td-container' style='padding:2vh;'>";
                    if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->psc)) {
                        echo $viteze_po_obnoveni[0]->psc;
                    } else {
                        //                    echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
                    }
                    echo "</td>";

                    echo "<td class='td-container' style='padding:2vh;'>";
                    if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->datum_nakupu)) {
                        echo $viteze_po_obnoveni[0]->datum_nakupu;
                    } else {
                        //                    echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
                    }
                    echo "</td>";

                    echo "<td class='td-container' style='padding:2vh;'>";
                    if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->cas_nakupu)) {
                        echo $viteze_po_obnoveni[0]->cas_nakupu;
                    } else {
                        //                    echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
                    }
                    echo "</td>";

                    echo "<td class='td-container' style='padding:2vh;'>";
                    if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->cena_nakupu)) {
                        echo $viteze_po_obnoveni[0]->cena_nakupu;
                    } else {
                        //                    echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
                    }
                    echo "</td>";

                    echo "<td class='td-container' style='padding:2vh;'>";
                    if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->cas_plneni)) {
                        echo $viteze_po_obnoveni[0]->cas_plneni;
                    } else {
                        //                    echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
                    }
                    //                <button type="submit" name="action" value="update_db">Potvrdit</button>

                    echo '<tr>
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
                    echo "</table>";
                }
                if (isset($_POST['action']) && $_POST['action'] == 'update_db' && $_POST['competition_type'] == $competition_type->competition_type) {
                    $draw_id = $wpdb->get_var("SELECT draw_id FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
                    $template_id = $wpdb->get_var("SELECT ecomail_template_id FROM $table_name_3 WHERE draw_id = $draw_id");
                    $quantity = $wpdb->get_var("SELECT quantity FROM $table_name WHERE competition_type = '$competition_type->competition_type'");
                    $kontakt_id = $wpdb->get_var("SELECT kontakt_id FROM $table_name_4 WHERE kontakt_id = '{$viteze_po_obnoveni[0]->kontakt_id}'");

                    if ($template_id) {
                        if ($quantity >= 1) {
                            $update->sendTransactionMails();
                            $update->changeQuantityOfCompetition();

                            //                            echo $competition_type->competition_type;
                            //                            echo $prize;
                            //                            echo $viteze_po_obnoveni[0]->kontakt_id;
                        } elseif ($quantity == 1) {
                            if ($template_id !== NULL && $template_id !== '') {
                                $update->changeQuantityOfCompetition();
                            } else {
                                echo "template_id chybí. Přidat mužete v položce menu Maily";
                            }
                        } else {
                            if ($template_id !== NULL && $template_id !== '') {
                                echo "No more mails.";
                            } else {
                                echo "template_id chybí. Přidat mužete v položce menu Maily";
                            }
                        }

                        $update->createPageWithEndpoint();
                        break;
                    } else {
                        echo "template_id chybí. Přidat mužete v položce menu Maily";
                    }
                }
            }
        }
    }
}
