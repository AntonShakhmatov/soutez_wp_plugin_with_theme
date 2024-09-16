<?php

function apisendTransactionEmail($api, $template_id, $vyhra, $email, $name, $surname, $vyhra_mail, $shortToken)
{
    //Здесь будут отправляться транзакционные имэйлы
    $api->sendTransactionalEmail(
        array(
            'template_id' => $template_id,
            'subject' => 'Vyhral\a jste ' . $vyhra,
            'from_name' => get_option('blogname'),
            'from_email' => get_option('admin_email'),
            'reply_to' => get_option('admin_email'),
            'email' => $email,
            'name' => $name . ' ' . $surname,
            'name' => 'text',
            'content' => $vyhra_mail . "<br>Váš odkaz:" . get_option('siteurl') . "/index.php/" . $shortToken
        ),
        TRUE,
        TRUE
    );
}

function vitezSendTransactionEmail($vitez, $competition_type, $kontakt_id, $name, $surname, $vyhra, $shortToken)
{
    $vitez->sendTransactionEmail(array(
        'competition_type' => $competition_type,
        'kontakt_id' => $kontakt_id,
        'jmeno' => $name,
        'prijmeni' => $surname,
        'vyhra' => $vyhra,
        //                'link' => get_option('siteurl') . "/index.php/" . $this->shortToken . $this->name . $this->shortToken . $this->surname . $this->shortToken . $this->kontakt_id . $this->shortToken, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
        'link' => get_option('siteurl') . "/index.php/" . $shortToken, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
        'checkbox_column' => '',
    ));
}

function apisendTransactionEmailMain($api, $template_id, $vyhra_hlavni, $main_email, $main_name, $main_surname, $vyhra_hlavni_mail, $shortToken)
{
    $api->sendTransactionalEmail(
        array(
            'template_id' => $template_id,
            'subject' => 'Vyhral\a jste ' . $vyhra_hlavni,
            'from_name' => get_option('blogname'),
            'from_email' => get_option('admin_email'),
            'reply_to' => get_option('admin_email'),
            'email' => $main_email,
            'name' => $main_name . ' ' . $main_surname,
            'name' => 'text',
            //            'content' => $vyhra_hlavni_mail . "<br>Váš odkaz:" . get_option('siteurl') . "/index.php" . "/my-page-" . $this->main_name . '-' . $this->main_surname . '-' . $this->main_kontakt_id
            'content' => $vyhra_hlavni_mail . "<br>Váš odkaz:" . get_option('siteurl') . "/index.php/" . $shortToken
        ),
        TRUE,
        TRUE
    );
}

function vitezSendTransactionEmailMain($vitez, $competition_type, $main_kontakt_id, $main_name, $main_surname, $vyhra_hlavni, $shortToken)
{
    $vitez->sendMainTransactionEmail(array(
        'competition_type' => $competition_type,
        'kontakt_id' => $main_kontakt_id,
        'jmeno' => $main_name,
        'prijmeni' => $main_surname,
        'vyhra' => $vyhra_hlavni,
        'link' => get_option('siteurl') . "/index.php/" . $shortToken, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
        //                'link' => get_option('siteurl') . "/index.php" . "/my-page-" . $this->main_name . '-' . $this->main_surname . '-' . $this->main_kontakt_id, //Менять в  зависимости от прописанного порядка в "post_name". get_option('siteurl') и "/index.php" не удалять!!!
        'checkbox_column' => '',
    ));
}
