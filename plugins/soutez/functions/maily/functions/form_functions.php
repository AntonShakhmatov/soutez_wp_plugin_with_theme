<?php

function processMailMaker($competition_type)
{
    $mail = new Mail($competition_type->competition_type);
    if (isset($_POST['submit']) && $_POST['submit'] == "Uložit {$competition_type->competition_type} mail") {
        $mail->mailsTemplateMaker();
        echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
    }
}

function processDaysMailMaker($competition_type)
{
    $mail = new DaysMails($competition_type->competition_type);
    if (isset($_POST['submit']) && $_POST['submit'] == "Uložit denni mail") {
        $mail->mailsTemplateMaker();
        echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
    }
}

function processMainMailMaker($competition_type)
{
    $mail = new MainMails($competition_type->competition_type);
    if (isset($_POST['submit']) && $_POST['submit'] == "Uložit hlavni mail") {
        $mail->mailsTemplateMaker();
        echo "<script>setTimeout(function(){location.reload()}, 0.0000001);</script>";
    }
}
