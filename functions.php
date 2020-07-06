<?php
if ( ! function_exists( 'mediaspintheme_setup' ) ) :

function mediaspintheme_setup() {

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    /* Pinegrow generated Load Text Domain Begin */
    load_theme_textdomain( 'mediaspintheme', get_template_directory() . '/languages' );
    /* Pinegrow generated Load Text Domain End */

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     */
    add_theme_support( 'title-tag' );
    
    /*
     * Enable support for Post Thumbnails on posts and pages.
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 825, 510, true );

    // Add menus.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'mediaspintheme' ),
        'social'  => __( 'Social Links Menu', 'mediaspintheme' ),
    ) );

/*
     * Register custom menu locations
     */
    /* Pinegrow generated Register Menus Begin */

    /* Pinegrow generated Register Menus End */
    
/*
    * Set image sizes
     */
    /* Pinegrow generated Image sizes Begin */

    /* Pinegrow generated Image sizes End */
    
    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

    /*
     * Enable support for Post Formats.
     */
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
    ) );

    /*
     * Enable support for Page excerpts.
     */
     add_post_type_support( 'page', 'excerpt' );
}
endif; // mediaspintheme_setup

add_action( 'after_setup_theme', 'mediaspintheme_setup' );


if ( ! function_exists( 'mediaspintheme_init' ) ) :

function mediaspintheme_init() {

    
    // Use categories and tags with attachments
    register_taxonomy_for_object_type( 'category', 'attachment' );
    register_taxonomy_for_object_type( 'post_tag', 'attachment' );

    /*
     * Register custom post types. You can also move this code to a plugin.
     */
    /* Pinegrow generated Custom Post Types Begin */

    /* Pinegrow generated Custom Post Types End */
    
    /*
     * Register custom taxonomies. You can also move this code to a plugin.
     */
    /* Pinegrow generated Taxonomies Begin */

    /* Pinegrow generated Taxonomies End */

}
endif; // mediaspintheme_setup

add_action( 'init', 'mediaspintheme_init' );


if ( ! function_exists( 'mediaspintheme_custom_image_sizes_names' ) ) :

function mediaspintheme_custom_image_sizes_names( $sizes ) {

    /*
     * Add names of custom image sizes.
     */
    /* Pinegrow generated Image Sizes Names Begin*/
    /* This code will be replaced by returning names of custom image sizes. */
    /* Pinegrow generated Image Sizes Names End */
    return $sizes;
}
add_action( 'image_size_names_choose', 'mediaspintheme_custom_image_sizes_names' );
endif;// mediaspintheme_custom_image_sizes_names



if ( ! function_exists( 'mediaspintheme_widgets_init' ) ) :

function mediaspintheme_widgets_init() {

    /*
     * Register widget areas.
     */
    /* Pinegrow generated Register Sidebars Begin */

    /* Pinegrow generated Register Sidebars End */
}
add_action( 'widgets_init', 'mediaspintheme_widgets_init' );
endif;// mediaspintheme_widgets_init



if ( ! function_exists( 'mediaspintheme_customize_register' ) ) :

function mediaspintheme_customize_register( $wp_customize ) {
    // Do stuff with $wp_customize, the WP_Customize_Manager object.

    /* Pinegrow generated Customizer Controls Begin */

    $wp_customize->add_section( 'captcha_settings', array(
        'title' => __( 'Captcha settings', 'mediaspintheme' )
    ));

    $wp_customize->add_section( 'captcha_settings', array(
        'title' => __( 'Captcha settings', 'mediaspintheme' )
    ));

    $wp_customize->add_section( 'header', array(
        'title' => __( 'Header', 'mediaspintheme' )
    ));

    $wp_customize->add_section( 'captcha_settings', array(
        'title' => __( 'Captcha settings', 'mediaspintheme' )
    ));

    $wp_customize->add_section( 'captcha_settings', array(
        'title' => __( 'Captcha settings', 'mediaspintheme' )
    ));

    $wp_customize->add_section( 'header', array(
        'title' => __( 'Header', 'mediaspintheme' )
    ));

    $wp_customize->add_section( 'header', array(
        'title' => __( 'Header', 'mediaspintheme' )
    ));

    $wp_customize->add_section( 'header', array(
        'title' => __( 'Header', 'mediaspintheme' )
    ));

    $wp_customize->add_section( 'header', array(
        'title' => __( 'Header', 'mediaspintheme' )
    ));
    $pgwp_sanitize = function_exists('pgwp_sanitize_placeholder') ? 'pgwp_sanitize_placeholder' : null;

    $wp_customize->add_setting( 'captcha_key', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'captcha_key', array(
        'label' => __( 'ReCaptcha API Key', 'mediaspintheme' ),
        'type' => 'text',
        'section' => 'captcha_settings'
    ));

    $wp_customize->add_setting( 'captcha_secret', array(
        'type' => 'theme_mod',
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'captcha_secret', array(
        'label' => __( 'ReCaptcha API Secret', 'mediaspintheme' ),
        'type' => 'text',
        'section' => 'captcha_settings'
    ));

    $wp_customize->add_setting( 'page_title', array(
        'type' => 'theme_mod',
        'default' => __( 'SG Media Spin', 'mediaspintheme' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'page_title', array(
        'label' => __( 'page_title', 'mediaspintheme' ),
        'type' => 'text',
        'section' => 'header'
    ));

    $wp_customize->add_setting( 'page_desc', array(
        'type' => 'theme_mod',
        'default' => __( 'How different websites report the same thing.', 'mediaspintheme' ),
        'sanitize_callback' => $pgwp_sanitize
    ));

    $wp_customize->add_control( 'page_desc', array(
        'label' => __( 'page description', 'mediaspintheme' ),
        'type' => 'textarea',
        'section' => 'header'
    ));

    /* Pinegrow generated Customizer Controls End */

}
add_action( 'customize_register', 'mediaspintheme_customize_register' );
endif;// mediaspintheme_customize_register


if ( ! function_exists( 'mediaspintheme_enqueue_scripts' ) ) :
    function mediaspintheme_enqueue_scripts() {

        /* Pinegrow generated Enqueue Scripts Begin */

    wp_enqueue_script( 'g-recaptcha', 'https://www.google.com/recaptcha/api.js' );
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', false, null, true);

    wp_deregister_script( 'popper' );
    wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.js', false, null, true);

    wp_deregister_script( 'bootstrap' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', false, null, true);

    wp_register_script( 'inline-script-1', '', [], '', true );
    wp_enqueue_script( 'inline-script-1' );
    wp_add_inline_script( 'inline-script-1', '$(function() {
    $(\'[data-toggle="tooltip"]\').tooltip();
})');

    /* Pinegrow generated Enqueue Scripts End */

        /* Pinegrow generated Enqueue Styles Begin */

    wp_deregister_style( 'bootstrap' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.css', false, null, 'all');

    wp_deregister_style( 'jumbotron' );
    wp_enqueue_style( 'jumbotron', get_template_directory_uri() . '/jumbotron.css', array(), rand(111,9999), 'all' );

    wp_deregister_style( 'all' );
    wp_enqueue_style( 'all', 'https://use.fontawesome.com/releases/v5.12.1/css/all.css', false, null, 'all');

    wp_deregister_style( 'style' );
    wp_enqueue_style( 'style', get_bloginfo('stylesheet_url'), false, null, 'all');

    /* Pinegrow generated Enqueue Styles End */

    }
    add_action( 'wp_enqueue_scripts', 'mediaspintheme_enqueue_scripts' );
endif;

function pgwp_sanitize_placeholder($input) { return $input; }
/*
 * Resource files included by Pinegrow.
 */
/* Pinegrow generated Include Resources Begin */
require_once "inc/wp_pg_helpers.php";
require_once "inc/wp_simple_form_mailer.php";
require_once "inc/wp_pg_pagination.php";

    /* Pinegrow generated Include Resources End */

require_once "inc/OpenGraph.php";



?>