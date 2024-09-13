<?php

use PHPMailer\PHPMailer\PHPMailer;

/**
 *SMTP Nastaveni
 *
 * @param PHPMailer $phpmailer объект мэилера
 */
function mihdan_send_smtp_email(PHPMailer $phpmailer)
{
    $phpmailer->isSMTP();
    $phpmailer->Host       = SMTP_HOST;
    $phpmailer->SMTPAuth   = SMTP_AUTH;
    $phpmailer->Port       = SMTP_PORT;
    $phpmailer->Username   = SMTP_USER;
    $phpmailer->Password   = SMTP_PASS;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->From       = SMTP_FROM;
    $phpmailer->FromName   = SMTP_NAME;
}
add_action("phpmailer_init", "mihdan_send_smtp_email");
