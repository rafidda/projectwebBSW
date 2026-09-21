<?php
/**
 * Wakalumi Theme — functions.php
 *
 * Central hub: loads all includes, enqueues assets.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ────────────────────────────────────────────────
// CONSTANTS
// ────────────────────────────────────────────────
define( 'WAKALUMI_VERSION', '1.0.0' );
define( 'WAKALUMI_DIR', get_template_directory() );
define( 'WAKALUMI_URI', get_template_directory_uri() );

// ────────────────────────────────────────────────
// INCLUDES
// ────────────────────────────────────────────────
require_once WAKALUMI_DIR . '/inc/theme-setup.php';
require_once WAKALUMI_DIR . '/inc/cpt.php';
require_once WAKALUMI_DIR . '/inc/acf-fields.php';
require_once WAKALUMI_DIR . '/inc/admin-options.php';
require_once WAKALUMI_DIR . '/inc/admin-hero.php';
require_once WAKALUMI_DIR . '/inc/admin-about.php';
require_once WAKALUMI_DIR . '/inc/admin-legalitas.php';
require_once WAKALUMI_DIR . '/inc/admin-pengurus.php';
require_once WAKALUMI_DIR . '/inc/admin-kantor.php';
require_once WAKALUMI_DIR . '/inc/admin-brosur.php';
require_once WAKALUMI_DIR . '/inc/admin-produk.php';
require_once WAKALUMI_DIR . '/inc/admin-pembiayaan.php';
require_once WAKALUMI_DIR . '/inc/admin-laporan.php';
require_once WAKALUMI_DIR . '/inc/admin-pengaduan.php';
require_once WAKALUMI_DIR . '/inc/prayer-times.php';

// ────────────────────────────────────────────────
// ENQUEUE SCRIPTS & STYLES
// ────────────────────────────────────────────────
function wakalumi_enqueue_assets() {
    // Google Fonts — Plus Jakarta Sans
    wp_enqueue_style(
        'wakalumi-google-fonts',
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap',
        [],
        null
    );

    // Main CSS (Tailwind build output)
    $css_path = WAKALUMI_DIR . '/assets/build/css/app.css';
    wp_enqueue_style(
        'wakalumi-style',
        WAKALUMI_URI . '/assets/build/css/app.css',
        [ 'wakalumi-google-fonts' ],
        file_exists( $css_path ) ? filemtime( $css_path ) : WAKALUMI_VERSION
    );

    // Main JS (Swup + AOS + custom — bundled by Vite)
    $js_path = WAKALUMI_DIR . '/assets/build/js/app.js';
    wp_enqueue_script(
        'wakalumi-script',
        WAKALUMI_URI . '/assets/build/js/app.js',
        [],
        file_exists( $js_path ) ? filemtime( $js_path ) : WAKALUMI_VERSION,
        true // Load in footer
    );

    // Pass WP data to JS
    wp_localize_script( 'wakalumi-script', 'wakalumiData', [
        'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
        'homeUrl'  => home_url( '/' ),
        'themeUrl' => WAKALUMI_URI,
    ] );
}
add_action( 'wp_enqueue_scripts', 'wakalumi_enqueue_assets' );

// ────────────────────────────────────────────────
// DEQUEUE BLOCK LIBRARY CSS (performance — not using Gutenberg on frontend)
// ────────────────────────────────────────────────
function wakalumi_dequeue_block_styles() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' );
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'wakalumi_dequeue_block_styles', 100 );

// ────────────────────────────────────────────────
// ADD PRECONNECT HINTS for Google Fonts (performance)
// ────────────────────────────────────────────────
/**
 * Add preconnect hints for Google Fonts.
 *
 * @param array  $urls
 * @param string $relation_type
 * @return array
 */
function wakalumi_resource_hints( array $urls, string $relation_type ): array {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = [
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => '',
        ];
        $urls[] = [
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        ];
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'wakalumi_resource_hints', 10, 2 );

// ────────────────────────────────────────────────
// ADD 'type="module"' attribute to Vite-bundled script
// ────────────────────────────────────────────────
/**
 * Add 'type="module"' attribute to Vite-bundled script.
 *
 * @param string $tag
 * @param string $handle
 * @return string
 */
function wakalumi_script_type_module( string $tag, string $handle ): string {
    if ( 'wakalumi-script' === $handle ) {
        $tag = str_replace( ' src', ' type="module" src', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'wakalumi_script_type_module', 10, 2 );

// ────────────────────────────────────────────────
// ADMIN: Show notice if ACF is not active
// ────────────────────────────────────────────────
function wakalumi_acf_notice() {
    if ( ! class_exists( 'ACF' ) ) {
        echo '<div class="notice notice-error"><p><strong>Wakalumi Theme:</strong> Plugin <a href="https://wordpress.org/plugins/advanced-custom-fields/" target="_blank">Advanced Custom Fields (ACF)</a> harus diinstall dan diaktifkan agar konten website bisa dikelola dari admin.</p></div>';
    }
}
add_action( 'admin_notices', 'wakalumi_acf_notice' );

// ────────────────────────────────────────────────
// ADMIN: Load Media Library + Upload Script di halaman Pengaturan Wakalumi
// ────────────────────────────────────────────────
function wakalumi_admin_media_scripts( $hook ) {
    // Hanya load di halaman admin milik tema Wakalumi
    $screen = get_current_screen();
    if ( ! $screen ) return;

    $is_wakalumi_page = (
        strpos( $screen->id, 'wakalumi' ) !== false ||
        in_array( $screen->post_type, [ 'hero_slide', 'produk', 'berita', 'anggota_tim' ], true )
    );

    if ( ! $is_wakalumi_page ) return;

    wp_enqueue_media(); // Memuat popup Media Library WordPress (gratis, built-in)

    wp_enqueue_script(
        'wakalumi-admin-media',
        WAKALUMI_URI . '/assets/js/admin-media.js',
        [ 'jquery' ],
        file_exists( WAKALUMI_DIR . '/assets/js/admin-media.js' )
            ? filemtime( WAKALUMI_DIR . '/assets/js/admin-media.js' )
            : WAKALUMI_VERSION,
        true
    );
}
add_action( 'admin_enqueue_scripts', 'wakalumi_admin_media_scripts' );

// ────────────────────────────────────────────────
// PDF PREVIEW STREAMER (Anti IDM Auto-Download Interception)
// Melayani stream PDF via AJAX binary octet-stream agar IDM tidak membajak pratinjau modal
// ────────────────────────────────────────────────
function wakalumi_ajax_stream_pdf() {
    $raw_url = isset( $_GET['doc'] ) ? wp_unslash( $_GET['doc'] ) : '';
    if ( empty( $raw_url ) ) {
        wp_die( 'URL Dokumen tidak ditemukan', 'Bad Request', [ 'response' => 400 ] );
    }

    $doc_url   = esc_url_raw( $raw_url );
    $uploads   = wp_get_upload_dir();
    $file_path = '';

    // 1. Cek apakah file berada di direktori upload WordPress lokal
    if ( preg_match( '#/wp-content/uploads/(.+)$#i', $doc_url, $matches ) ) {
        $potential_path = $uploads['basedir'] . '/' . ltrim( $matches[1], '/' );
        if ( file_exists( $potential_path ) && is_readable( $potential_path ) ) {
            $file_path = $potential_path;
        }
    }

    // 2. Cek apakah file berada di direktori theme
    if ( ! $file_path && preg_match( '#/wp-content/themes/(.+)$#i', $doc_url, $matches ) ) {
        $potential_path = get_theme_root() . '/' . ltrim( $matches[1], '/' );
        if ( file_exists( $potential_path ) && is_readable( $potential_path ) ) {
            $file_path = $potential_path;
        }
    }

    // 3. Jika file lokal ditemukan di disk
    if ( $file_path ) {
        if ( strtolower( pathinfo( $file_path, PATHINFO_EXTENSION ) ) !== 'pdf' ) {
            wp_die( 'Akses berkas ditolak', 'Forbidden', [ 'response' => 403 ] );
        }

        while ( ob_get_level() ) {
            ob_end_clean();
        }

        header( 'Content-Type: application/pdf' );
        header( 'Content-Disposition: inline; filename="' . basename( $file_path ) . '"' );
        header( 'Content-Length: ' . filesize( $file_path ) );
        header( 'Cache-Control: public, max-age=86400' );
        header( 'X-Content-Type-Options: nosniff' );
        header( 'Access-Control-Allow-Origin: *' );

        readfile( $file_path );
        exit;
    }

    // 4. Fallback jika file remote
    $response = wp_remote_get( $doc_url, [
        'timeout'   => 30,
        'sslverify' => false,
    ] );

    if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
        wp_die( 'Gagal memuat dokumen PDF', 'File Not Found', [ 'response' => 404 ] );
    }

    $body = wp_remote_retrieve_body( $response );

    while ( ob_get_level() ) {
        ob_end_clean();
    }

    header( 'Content-Type: application/pdf' );
    header( 'Content-Disposition: inline; filename="document.pdf"' );
    header( 'Content-Length: ' . strlen( $body ) );
    header( 'Cache-Control: public, max-age=86400' );
    header( 'X-Content-Type-Options: nosniff' );
    header( 'Access-Control-Allow-Origin: *' );

    echo $body;
    exit;
}
add_action( 'wp_ajax_wakalumi_pdf_stream', 'wakalumi_ajax_stream_pdf' );
add_action( 'wp_ajax_nopriv_wakalumi_pdf_stream', 'wakalumi_ajax_stream_pdf' );



