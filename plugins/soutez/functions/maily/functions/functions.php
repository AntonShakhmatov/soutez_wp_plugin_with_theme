<?php

//All mails in one place
function my_custom_submenu_callback()
{

?>
    <div class="wrap">
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab nav-tab-active" data-tab="tab1">Tydenní losování</a>
            <a class="nav-tab" data-tab="tab2">Denní losování</a>
            <a class="nav-tab" data-tab="tab3">Hlavní losování</a>
        </h2>

    <?php

    require_once('script_template_mail_maker.php');

    require_once('script_days_template_mail_maker.php');

    require_once('script_main_template_mail_maker.php');
}
