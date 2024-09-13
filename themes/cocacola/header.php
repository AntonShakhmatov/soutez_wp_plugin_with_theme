<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	</body>
	</html>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php  wp_head() ?>

	<title>Název stránky</title>

</head>
<body>

<header>
		<div class="navWrapper">
            <nav>
                <div class="logo">
                    <a class="logoWhite" href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_url');?>/assets/images/header/logoWhite.svg" alt="logo"></a>
					<a class="logoRed" href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_url');?>/assets/images/header/logo-invert.svg" alt="logo"></a>
                </div>

                <ul class="menu">
                    <li><a class="underlineWhite" href="#how-to-win">JAK VYHRÁT</a></li>
					<li><a class="underlineWhite" href="#form">SOUTĚŽIT</a></li>
                    <li><a class="underlineWhite" href="#rules">PRAVIDLA SOUTĚŽE</a></li>
                    <li><a class="underlineWhite" href="#about">VÝHRY</a></li>
                    <li><a class="underlineWhite" href="#contact">KONTAKT</a></li>
                </ul>

                <div class="burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
	</header>
        <?php
			global $wpdb;
			$table_name = $wpdb->prefix . 'hlavni_soutezi';
            $competitions = $wpdb->get_results("SELECT * FROM `$table_name` ORDER BY main_competition_id DESC LIMIT 1");
			foreach($competitions as $competition){
            echo "Termín soutěže: " . $competition->zacatek . ' - ' . $competition->konec;
            }
		?>