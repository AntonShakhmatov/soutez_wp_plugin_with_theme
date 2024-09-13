<?php

require_once SOUTEZ_DIR . 'index.php';
require_once SOUTEZ_DIR . 'forms/edit-contact-form.php';
require_once SOUTEZ_DIR . 'forms/form.php';
require_once SOUTEZ_DIR . 'classes/vitez/vitez.php';
require_once SOUTEZ_DIR . 'classes/update/update.php';
require_once SOUTEZ_DIR . 'classes/prizeDraw/prizeDraw.php';
require_once SOUTEZ_DIR . 'functions/maily/functions/mail.php';
require_once SOUTEZ_DIR . 'functions/maily/functions/days_mail.php';
require_once SOUTEZ_DIR . 'functions/maily/functions/main_mail.php';
require_once SOUTEZ_DIR . 'classes/geo/geo.php';
require_once SOUTEZ_DIR . 'functions/enqueue/enqueue.php';
require_once SOUTEZ_DIR . 'smtp/custom-smtp-config.php';
require_once SOUTEZ_DIR . 'smtp/smtp-settings.php';

use WordPress\ORM\BaseModel;

//Admin menu
require_once('functions/admin-menu/functions/functions.php');

//Moje soutěží menu
require_once('functions/moje_soutezi/functions/functions.php');

//Přehled menu
require_once('functions/prehled/functions/functions.php');

//All mails in one place
require_once('functions/maily/functions/functions.php');

//Tydenní losování
require_once('functions/losovani/tydenni_losovani/functions/functions.php');

//Denní losování
require_once('functions/losovani/denni_losovani/functions/functions.php');

//Hlavní losování
require_once('functions/losovani/hlavni_losovani/functions/functions.php');

//Účtenky menu
require_once('functions/uctenky/functions/functions.php');

//Vyhry menu
require_once('functions/vyhry/functions/functions.php');

//Nastavení menu
require_once('functions/nastaveni/functions/functions.php');
