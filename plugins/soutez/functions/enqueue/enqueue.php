<?php

function load_custom_wp_admin_style()
{
    wp_register_style('custom_wp_admin_css', plugins_url('../../assets/css/admin-style.css', __FILE__));
    wp_enqueue_style('custom_wp_admin_css');
}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');

function integrate_jquery()
{
    wp_enqueue_script('jquery_integration', plugin_dir_url(__FILE__) . '../../assets/js/jquery_integration.js', array(), '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'integrate_jquery');

function add_admin_script()
{
    wp_enqueue_script('admin_script', plugin_dir_url(__FILE__) . '../../assets/js/admin_script.js', array('jquery_integration', 'jquery'));
}
add_action('admin_enqueue_scripts', 'add_admin_script');

function add_competition_mailing_script()
{
    wp_enqueue_script('competition_mailing_script', plugin_dir_url(__FILE__) . '../../assets/js/competition_mailing_script.js', array('jquery_integration', 'jquery'));
}
add_action('admin_enqueue_scripts', 'add_competition_mailing_script');

function add_days_competition_random_script()
{
    wp_enqueue_script('days_competition_random', plugin_dir_url(__FILE__) . '../../assets/js/days_competition.js', array('jquery_integration', 'jquery'));
    wp_localize_script('days_competition_random', 'days_competition_random', array('myajaxurl' => admin_url('admin-ajax.php')));
}
add_action('admin_enqueue_scripts', 'add_days_competition_random_script');
