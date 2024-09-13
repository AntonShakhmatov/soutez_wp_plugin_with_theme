<?php

add_action('admin_menu', 'my_contest_menu');

//Menu items in the plugin administration
function my_contest_menu()
{

    add_menu_page(
        'Moje soutěží', // название вкладки
        'Moje soutěží', // название в меню
        'manage_options', // уровень доступа
        'my-contest', // идентификатор страницы - совпадает с родительской страницей
        'my_contest_page', // функция вывода содержимого страницы
        'dashicons-awards', // иконка меню
        20, // позиция в меню
    );

    //Additional menu item
    add_submenu_page(
        'my-contest', // родительский идентификатор страницы
        'Přehled', // название страницы в меню
        'Přehled', // название пункта меню
        'manage_options', // уровень доступа
        'my-contest-subpage-vsichni', // идентификатор страницы
        'my_contest_page_vsichni', // функция вывода содержимого страницы
    );

    //Additional menu item
    add_submenu_page(
        'my-contest', // Родительский пункт меню (slug)
        'Maily', // Название вкладки
        'Maily', // Заголовок страницы
        'manage_options', // Роль пользователя, которая имеет доступ к этой вкладке
        'my_custom_submenu_slug', // Уникальный идентификатор вкладки
        'my_custom_submenu_callback' // Функция, которая будет отображать содержимое вкладки
    );

    // //Additional menu item
    // add_submenu_page(
    //     'my-contest', // родительский идентификатор страницы
    //     'Týdenní maily', // название страницы в меню
    //     'Týdenní maily', // название пункта меню
    //     'manage_options', // уровень доступа
    //     'my-contest-subpage-maily', // идентификатор страницы
    //     'my_contest_subpage_maily', // функция вывода содержимого страницы
    // );

    //Additional menu item
    add_submenu_page(
        'my-contest', // родительский идентификатор страницы
        'Týdenní losování', // название страницы в меню
        'Týdenní losování', // название пункта меню
        'manage_options', // уровень доступа
        'my-contest-subpage-losovani', // идентификатор страницы
        'my_contest_subpage_losovani', // функция вывода содержимого страницы
    );

    // //Additional menu item
    // add_submenu_page(
    //     'my-contest', // родительский идентификатор страницы
    //     'Denní maily', // название страницы в меню
    //     'Denní maily', // название пункта меню
    //     'manage_options', // уровень доступа
    //     'my-contest-subpage_denni-maily', // идентификатор страницы
    //     'my_contest_subpage_denni_maily', // функция вывода содержимого страницы
    // );

    //Additional menu item
    add_submenu_page(
        'my-contest', // родительский идентификатор страницы
        'Denní losování', // название страницы в меню
        'Denní losování', // название пункта меню
        'manage_options', // уровень доступа
        'my-contest-subpage-denni-losovani', // идентификатор страницы
        'my_contest_subpage_denni_losovani', // функция вывода содержимого страницы
    );

    // //Additional menu item
    // add_submenu_page(
    //     'my-contest', // родительский идентификатор страницы
    //     'Hlavní maily', // название страницы в меню
    //     'Hlavní maily', // название пункта меню
    //     'manage_options', // уровень доступа
    //     'my-contest-subpage_hlavni-maily', // идентификатор страницы
    //     'my_contest_subpage_hlavni_maily', // функция вывода содержимого страницы
    // );

    //Additional menu item
    add_submenu_page(
        'my-contest', // родительский идентификатор страницы
        'Hlavní losování', // название страницы в меню
        'Hlavní losování', // название пункта меню
        'manage_options', // уровень доступа
        'my-contest-subpage-hlavni-losovani', // идентификатор страницы
        'my_contest_subpage_hlavni_losovani', // функция вывода содержимого страницы
    );

    //Additional menu item
    add_submenu_page(
        'my-contest',
        'Účtenky',
        'Účtenky',
        'manage_options',
        'my-contest-subpage-uctenky', // идентификатор страницы
        'my_contest_subpage_uctenky', // функция вывода содержимого страницы
    );

    //Additional menu item
    add_submenu_page(
        'my-contest',
        'Vyhry',
        'Vyhry',
        'manage_options',
        'my-contest-subpage-vyhry', // идентификатор страницы
        'my_contest_subpage_vyhry', // функция вывода содержимого страницы
    );

    //Additional menu item
    add_submenu_page(
        'my-contest',
        'Nastaveni',
        'Nastavení',
        'manage_options',
        'my-contest-subpage-nastaveni',
        'my_contest_subpage_nastaveni'
    );
}
