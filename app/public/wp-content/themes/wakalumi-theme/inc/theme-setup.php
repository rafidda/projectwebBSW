<?php
/**
 * Theme Setup — supports, menus, image sizes
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Setup theme defaults and register support for various WordPress features.
 */
function wakalumi_theme_setup() {
    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable featured images (post thumbnails)
    add_theme_support( 'post-thumbnails' );

    // Custom logo support
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    // HTML5 markup for search form, comment form, galleries, etc.
    add_theme_support( 'html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ] );

    // Disable default block patterns
    remove_theme_support( 'core-block-patterns' );

    // Custom image sizes
    add_image_size( 'card-thumbnail', 600, 400, true );    // Card images
    add_image_size( 'hero-large', 1920, 1080, true );      // Hero backgrounds
    add_image_size( 'team-portrait', 400, 500, true );     // Team member photos

    // Register navigation menus
    register_nav_menus( [
        'primary' => __( 'Menu Utama (Navbar)', 'wakalumi' ),
        'footer'  => __( 'Menu Footer', 'wakalumi' ),
    ] );
}
add_action( 'after_setup_theme', 'wakalumi_theme_setup' );

/**
 * Custom excerpt length.
 */
function wakalumi_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'wakalumi_excerpt_length' );

/**
 * Custom excerpt more text.
 */
function wakalumi_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter( 'excerpt_more', 'wakalumi_excerpt_more' );

/**
 * Remove default WordPress emoji scripts (performance).
 */
function wakalumi_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'wakalumi_disable_emojis' );

/**
 * Remove unnecessary WordPress head clutter (performance & security).
 */
function wakalumi_cleanup_head() {
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
}
add_action( 'init', 'wakalumi_cleanup_head' );

