<?php

function apiSendTransactionEmailConfirmation($api, $email, $name, $surname, $kontakt_id)
{
    $api->sendTransactionalEmail(
        $array = array(
            'template_id' => 75,
            'subject' => 'Confirm that you have received the prize',
            'from_name' => get_option('blogname'),
            'from_email' => get_option('admin_email'),
            'reply_to' => get_option('admin_email'),
            'email' => $email,
            'name' => $name . ' ' . $surname,
            'name' => 'text',
            'content' => "<br>Váš odkaz:" . get_option('siteurl') . "/index.php" . "/confirm-" . $name . '-' . $surname . '-' . $kontakt_id
        ),
        TRUE,
        TRUE
    );
    return $array;
}
