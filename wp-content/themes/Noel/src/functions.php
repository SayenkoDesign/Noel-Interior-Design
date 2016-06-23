<?php
require_once __DIR__.'/../App/bootstrap.php';

/** @var $container \Symfony\Component\DependencyInjection\Container */
/** @var $twig \Twig_Environment */
$twig = $container->get('twig.environment');

// regiser the home page
// $themeSettingsPage = new \Supertheme\WordPress\ThemeSettingsPage(
//     $container->get('form'),
//     $container->get('twig.environment')
// );
//$themeSettingsPage->register();

add_theme_support('post-thumbnails');
add_theme_support('menus');
add_theme_support('html5');

// always start a session
add_action('init', function () {
    if (!session_id()) {
        session_start();
    }
});

// load languages directory
add_action('plugins_loaded', function () {
    load_plugin_textdomain('supertheme', false, get_template_directory().'/languages');
});

// logo for ACF options page
add_action('admin_head', function () use ($twig){
    echo $twig->render('admin/dashicons.html.twig');
});

// login logo
add_action('login_head', function () use($twig) {
    echo $twig->render('admin/login.html.twig');
});

// referral widget
add_action('wp_dashboard_setup', function () use($twig) {
    wp_add_dashboard_widget(
        'referral_dashboard_widget',
        'RECEIVE $500 in CASH FOR A WEBSITE REFERRAL!!',
        function () use($twig) {
            echo $twig->render('admin/referral.html.twig');
        }
    );
});
