<?php

function displayForm() {}

function processCompetitionTypeEnter()
{
    if (isset($_POST['submit']) && $_POST['submit'] == "Doplnit") {
        $update = new Update($_POST['type']);
        $update->addCompetitionType();
    }
}

function processForm()
{
    if (isset($_POST['submit']) && $_POST['submit'] == "Ulozit") {
        $update = new Update($_POST['selected_type']);
        $update->addCompetitionTypeWithTimer();
        $update->divideByAllTime();
    }
    if (isset($_POST['submit']) && $_POST['submit'] == "Vymazat") {
        $update = new Update($_POST['selected_type']);
        $update->removeCompetitionTypeWithTimer();
        $update->removeByDayTime();
        $update->removeByAllTime();
    }
}

function processForms()
{
    if (isset($_POST['submit']) && $_POST['submit'] == "Uložit") {
        if ($_POST['selected_type'] == 'denni') {
            switch ($_POST['selected_type_2']) {
                case '1':
                    $prizeDraw = new PrizeDraw($_POST['selected_type']);
                    $prizeDraw->addPrizeForDayCompetition();
                    $prizeDraw->addTotalQuantity();
                    break;

                case '2':
                    $prizeDraw = new PrizeDraw($_POST['selected_type']);
                    $prizeDraw->addPrizeForDayCompetition2();
                    $prizeDraw->addTotalQuantity();
                    break;

                case '3':
                    $prizeDraw = new PrizeDraw($_POST['selected_type']);
                    $prizeDraw->addPrizeForDayCompetition3();
                    $prizeDraw->addTotalQuantity();
                    break;

                case '4':
                    $prizeDraw = new PrizeDraw($_POST['selected_type']);
                    $prizeDraw->addPrizeForDayCompetition4();
                    $prizeDraw->addTotalQuantity();
                    break;

                case '5':
                    $prizeDraw = new PrizeDraw($_POST['selected_type']);
                    $prizeDraw->addPrizeForDayCompetition5();
                    $prizeDraw->addTotalQuantity();
                    break;

                case '6':
                    $prizeDraw = new PrizeDraw($_POST['selected_type']);
                    $prizeDraw->addPrizeForDayCompetition6();
                    $prizeDraw->addTotalQuantity();
                    break;

                case '7':
                    $prizeDraw = new PrizeDraw($_POST['selected_type']);
                    $prizeDraw->addPrizeForDayCompetition7();
                    $prizeDraw->addTotalQuantity();
                    break;

                case '8':
                    $prizeDraw = new PrizeDraw($_POST['selected_type']);
                    $prizeDraw->addPrizeForDayCompetition8();
                    $prizeDraw->addTotalQuantity();
                    break;

                case '9':
                    $prizeDraw = new PrizeDraw($_POST['selected_type']);
                    $prizeDraw->addPrizeForDayCompetition9();
                    $prizeDraw->addTotalQuantity();
                    break;

                case '10':
                    $prizeDraw = new PrizeDraw($_POST['selected_type']);
                    $prizeDraw->addPrizeForDayCompetition10();
                    $prizeDraw->addTotalQuantity();
                    break;
            }
        } elseif ($_POST['selected_type'] == 'hlavni') {
            $prizeDraw = new PrizeDraw($_POST['selected_type']);
            $prizeDraw->addPrizeForMainCompetition();
        }
    }
}
