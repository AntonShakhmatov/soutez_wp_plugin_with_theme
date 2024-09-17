<?php

require_once('db_functions.php');
require_once('html_functions.php');
require_once('email_and_page_creation.php');

$competition_types = selectAllFromAktivnySoutez();

foreach ($competition_types as $competition_type) {

    $update = new Update($competition_type->competition_type);

    if ($competition_type && $competition_type->quantity != 0) {
        getLinkForMain($competition_type);
        $viteze = selectAllFromKontaktniUdajeViteze($competition_type);

        if (empty($viteze)) {
            // Zde budou vkládána pole do databáze
            $update->insertDatabase();
        } else {
            // Zde bude aktualizace databáze
            $update->updateDatabase();

            // Máme obnovit seznam ještě jednou pro synchronizaci
            $zacatek = $competition_type->zacatek;
            $konec = $competition_type->konec;

            $viteze_po_obnoveni = selectAllFromKontaktniUdajeVitezeWhereCasPlneni($competition_type, $zacatek, $konec);

            $kontakt_id = selectKontaktIdFromPrizeWhereKontaktId($viteze_po_obnoveni[0]->kontakt_id);

            if ($kontakt_id == $viteze_po_obnoveni[0]->kontakt_id) {
                getScript();
            } else {
                getTable($competition_type);

                if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->vyhra)) {
                    echo $viteze_po_obnoveni[0]->vyhra;
                } else {
                    getScript();
                }

                getTdContainer();
                if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->jmeno)) {
                    echo $viteze_po_obnoveni[0]->jmeno;
                } else {
                    // getScript();
                }

                getTdContainer();
                if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->prijmeni)) {
                    echo $viteze_po_obnoveni[0]->prijmeni;
                } else {
                    // getScript();
                }

                getTdContainer();
                if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->telefon)) {
                    echo $viteze_po_obnoveni[0]->telefon;
                } else {
                    // getScript();
                }

                getTdContainer();
                if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->email)) {
                    echo $viteze_po_obnoveni[0]->email;
                } else {
                    // getScript();
                }

                getTdContainer();
                if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->psc)) {
                    echo $viteze_po_obnoveni[0]->psc;
                } else {
                    // getScript();
                }

                getTdContainer();
                if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->datum_nakupu)) {
                    echo $viteze_po_obnoveni[0]->datum_nakupu;
                } else {
                    // getScript();
                }

                getTdContainer();
                if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->cas_nakupu)) {
                    echo $viteze_po_obnoveni[0]->cas_nakupu;
                } else {
                    // getScript();
                }

                getTdContainer();
                if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->cena_nakupu)) {
                    echo $viteze_po_obnoveni[0]->cena_nakupu;
                } else {
                    // getScript();
                }

                getTdContainer();
                if (!empty($viteze_po_obnoveni) && isset($viteze_po_obnoveni[0]) && is_object($viteze_po_obnoveni[0]) && isset($viteze_po_obnoveni[0]->cas_plneni)) {
                    echo $viteze_po_obnoveni[0]->cas_plneni;
                } else {
                    // getScript();
                }
                getTr($competition_type, $viteze_po_obnoveni[0]);
            }
            if (isset($_POST['action']) && $_POST['action'] == 'update_db' && $_POST['competition_type'] == $competition_type->competition_type) {
                $draw_id = selectDrawIdFromAktivnySoutezi($competition_type);
                $template_id = selectEcomailTemplateIdFromTypSoutezeMails($draw_id);
                $quantity = selectQuantityFromAktivnySoutezi($competition_type);
                $kontakt_id = selectKontaktIdFromPrize($viteze_po_obnoveni[0]->kontakt_id);

                if ($template_id) {
                    if ($quantity >= 1) {
                        $update->sendTransactionMails();
                        $update->changeQuantityOfCompetition();
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
