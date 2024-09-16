<?php

function send($api, $email, $name, $surname, $geo_link)
{
    $send = $api->sendTransactionalEmail(
        array(
            'template_id' => 106,
            'subject' => 'Vaš track kod',
            'from_name' => get_option('blogname'),
            'from_email' => get_option('admin_email'),
            'reply_to' => get_option('admin_email'),
            'email' => $email,
            'name' => $name . ' ' . $surname,
            'name' => 'text',
            'content' => $geo_link
        ),
        TRUE,
        TRUE
    );
    return $send;
}
