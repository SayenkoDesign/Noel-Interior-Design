<?php
require_once __DIR__.'/App/bootstrap.php';
require_once __DIR__.'/src/functions.php';
global $container;

add_action('admin_menu', function () {
    remove_menu_page('edit.php');
});

// styles and scripts
add_action('wp_enqueue_scripts', function (){
    wp_register_style('slick-css', get_template_directory_uri() . '/src/slick/slick/slick.css');
    wp_register_style('slick-theme-css', get_template_directory_uri() . '/src/slick/slick/slick-theme.css');
    wp_register_style('fancybox-css', get_template_directory_uri() . '/src/fancybox/source/jquery.fancybox.css');
    wp_register_style('app', get_template_directory_uri() . '/web/stylesheets/app.css', ['slick-css', 'slick-theme-css', 'fancybox-css']);

    wp_register_script('sharethis', 'http://w.sharethis.com/button/buttons.js', array());
    wp_register_script('slick', get_template_directory_uri() . '/src/slick/slick/slick.js', array('jquery'));
    wp_register_script('fancybox', get_template_directory_uri() . '/src/fancybox/source/jquery.fancybox.pack.js', array('jquery'));
    wp_register_script('app', get_template_directory_uri() . '/web/scripts-min/app.min.js', array('jquery', 'fancybox', 'slick', 'sharethis'));

    wp_enqueue_script('app');
    wp_enqueue_script('app');
    wp_enqueue_style( 'app' );
});

add_action('init', function() {
    register_post_type('portfolio', [
        'labels' => [
            'name' => 'Portfolios',
            'singular_name' => 'Portfolio',
        ],
        'public' => true,
        'menu_icon' => 'dashicons-portfolio',
        'menu_position' => 5,
        'supports' => [
            'title',
            'author',
            'thumbnail',
            'page-attributes',
        ],
        'has_archive' => true,
    ]);

    register_nav_menus([
        'primary_menu' => 'Primary Menu',
        'mobile_menu' => 'Mobile Menu',
    ]);

    add_image_size('slider', 1200, 700, true);
    add_image_size('landscape_top', 1000, 600, true);
    add_image_size('landscape_bottom', 650, 400, true);
    add_image_size('mixed_top', 980, 450, true);
    add_image_size('mixed_left', 660, 844, true);
    add_image_size('mixed_right', 650, 400, true);
    add_image_size('mixed_bottom', 650, 550, true);
    add_image_size('right_large', 1000, 9999, false);

    if(function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Theme Options',
            'capability' => 'edit_theme_options',
            'icon_url' => 'dashicons-sayenko',
        ]);

        if ($googleID = get_field('google_analytics_id', 'option')) {
            add_action('wp_head', function () use ($googleID) {
                echo <<<HTML
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
                
                ga('create', '$googleID', 'auto');
                ga('send', 'pageview');
            </script>
HTML;
            });
        }
    }
});
