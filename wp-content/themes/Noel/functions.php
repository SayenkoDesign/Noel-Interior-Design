<?php
require_once __DIR__.'/App/bootstrap.php';
global $container;


add_action('init', function() {
    if( !session_id() )
    {
        session_start();
    }
});

add_action('plugins_loaded', function() {
    load_plugin_textdomain('supertheme', false, get_template_directory() . '/languages');
});

// styles and scripts
add_action('wp_enqueue_scripts', function (){
    wp_register_style('slick-css', get_template_directory_uri() . '/src/slick/slick/slick.css');
    wp_register_style('slick-theme-css', get_template_directory_uri() . '/src/slick/slick/slick-theme.css');
    wp_register_style('font-awesome', get_template_directory_uri() . '/web/libs/font-awesome/css/font-awesome.css');
    wp_register_style('app', get_template_directory_uri() . '/web/stylesheets/app.css', ['slick-css', 'slick-theme-css', 'font-awesome']);
    wp_register_script('slick', get_template_directory_uri() . '/src/slick/slick/slick.js', array('jquery'));
    wp_register_script('slick-app-js', get_template_directory_uri() . '/web/scripts-min/app.min.js', array('jquery'));
    wp_enqueue_script('slick-app-js');
    wp_enqueue_script('slick');
    wp_enqueue_style( 'app' );
});

// logo for ACF options page
add_action('admin_head', function () {
    $rootURI = get_template_directory_uri();
    echo <<<HTML
    <style type="text/css">
        .dashicons-sayenko {
            background-image: url('$rootURI/options-icon.png');
            background-size: 18px;
            background-position: 10px center;
            background-repeat: no-repeat;
        }
    </style>
HTML;
});

// login logo
add_action('login_head', function () {
    $rootURI = get_template_directory_uri();
    echo <<<HTML
    <style type="text/css">
        h1 a {
            background-image: url('$rootURI/logo.png') !important;
            background-size: contain !important;
            width: 320px !important;
            height: 120px !important;
       }
    </style>
HTML;
});


// referral widget
add_action('wp_dashboard_setup', function () {
    wp_add_dashboard_widget(
        'referral_dashboard_widget',
        'RECEIVE $500 in CASH FOR A WEBSITE REFERRAL!!',
        function () {
            echo <<<HTML
                <a href='http://www.sayenkodesign.com'>
                    <img alt='Seattle Web Design' src='http://www.sayenkodesign.com/wp-content/uploads/2014/08/Sayenko-Design-WP-Referral-Bonus-460.jpg' width='100%'>
                </a>
                </br>
                </br>
                Simply introduce us via email along with the prospects phone number.
                Email introductions can be sent to
                <a href='mailto:mike@sayenkodesign.com'>mike@sayenkodesign.com</a>
HTML;
        }
    );
});
