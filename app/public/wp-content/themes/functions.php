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
require_once WAKALUMI_DIR . '/inc/admin-pengumuman.php';
require_once WAKALUMI_DIR . '/inc/admin-lelang.php';
require_once WAKALUMI_DIR . '/inc/admin-berita.php';
require_once WAKALUMI_DIR . '/inc/admin-kegiatan.php';
require_once WAKALUMI_DIR . '/inc/admin-galeri.php';
require_once WAKALUMI_DIR . '/inc/admin-tim-kami.php';
require_once WAKALUMI_DIR . '/inc/admin-karir.php';
require_once WAKALUMI_DIR . '/inc/admin-literasi.php';
require_once WAKALUMI_DIR . '/inc/admin-layanan.php';
require_once WAKALUMI_DIR . '/inc/prayer-times.php';

// ────────────────────────────────────────────────
// ENQUEUE SCRIPTS & STYLES
// ────────────────────────────────────────────────
function wakalumi_enqueue_assets() {
    // Google Fonts — Rubik (Headings/Display), Comfortaa (Paragraphs/Details), Nunito, Quicksand & Varela Round (UI/Badges)
    wp_enqueue_style(
        'wakalumi-google-fonts',
        'https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;500;600;700&family=Nunito:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Quicksand:wght@500;600;700&family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&family=Varela+Round&display=swap',
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

/**
 * Custom Query Adjustments for Berita Archive
 * Standardize 9 posts per page for the 3-column layout.
 */
function wakalumi_berita_archive_query( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( is_post_type_archive( 'berita' ) || is_tax( 'kategori_berita' ) ) {
            $query->set( 'posts_per_page', 9 );
        }
    }
}
add_action( 'pre_get_posts', 'wakalumi_berita_archive_query' );

// ────────────────────────────────────────────────
// AUTO-REDIRECT PARENT / EMPTY HUB PAGES TO FIRST ACTIVE CHILD
// ────────────────────────────────────────────────
/**
 * Mengarahkan pengunjung secara otomatis dari halaman induk (parent hub kosong)
 * ke sub-halaman pertama yang aktif.
 * Contoh:
 * - /profil/    -> /profil/tentang-kami/
 * - /produk/    -> /produk/tabungan-syariah/
 * - /informasi/ -> /informasi/laporan-publikasi/
 */
function wakalumi_redirect_parent_pages() {
    if ( is_admin() || wp_doing_ajax() || wp_doing_cron() ) {
        return;
    }

    if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
        return;
    }

    if ( is_page() ) {
        global $post;
        if ( ! $post || ! isset( $post->ID ) ) {
            return;
        }

        $slug = strtolower( $post->post_name );

        // 1. Pemetaan eksplisit halaman induk utama website
        $core_redirects = [
            'profil'    => home_url( '/profil/tentang-kami/' ),
            'produk'    => home_url( '/produk/tabungan-syariah/' ),
            'informasi' => home_url( '/informasi/laporan-publikasi/' ),
        ];

        if ( isset( $core_redirects[ $slug ] ) ) {
            $target = $core_redirects[ $slug ];
            $current_permalink = get_permalink( $post->ID );
            if ( trailingslashit( $target ) !== trailingslashit( $current_permalink ) ) {
                wp_safe_redirect( $target, 301 );
                exit;
            }
        }

        // 2. Fallback dinamis untuk halaman induk lain yang tidak memiliki template khusus dan kontennya kosong
        $template = get_page_template_slug( $post->ID );
        $has_content = ! empty( trim( strip_tags( $post->post_content ) ) );

        if ( empty( $template ) && ! $has_content ) {
            $children = get_pages( [
                'child_of'    => $post->ID,
                'parent'      => $post->ID,
                'sort_column' => 'menu_order, post_title',
                'sort_order'  => 'ASC',
                'number'      => 1,
                'post_status' => 'publish',
            ] );

            if ( ! empty( $children ) && isset( $children[0]->ID ) ) {
                $child_url = get_permalink( $children[0]->ID );
                $current_permalink = get_permalink( $post->ID );
                if ( $child_url && trailingslashit( $child_url ) !== trailingslashit( $current_permalink ) ) {
                    wp_safe_redirect( $child_url, 301 );
                    exit;
                }
            }
        }
    }
}
add_action( 'template_redirect', 'wakalumi_redirect_parent_pages' );

// ────────────────────────────────────────────────
// PRODUCTION MIGRATION GUARD: AUTO-NORMALIZE LOCAL DOMAIN URLS
// Secara otomatis mengubah sisa URL 'wakalumibprscoid.local' di wp_options / konten
// menjadi domain produksi aktif (home_url) saat website di-online-kan ke hosting.
// ────────────────────────────────────────────────
function wakalumi_normalize_domain_deep( $value ) {
    static $live_origin = null;
    static $needs_replace = null;

    if ( null === $live_origin ) {
        $live_origin   = untrailingslashit( home_url() );
        $needs_replace = ( stripos( $live_origin, 'wakalumibprscoid.local' ) === false );
    }

    if ( ! $needs_replace ) {
        return $value;
    }

    if ( is_string( $value ) ) {
        if ( stripos( $value, 'wakalumibprscoid.local' ) !== false ) {
            $value = str_ireplace(
                [ 'https://wakalumibprscoid.local', 'http://wakalumibprscoid.local' ],
                $live_origin,
                $value
            );
        }
        return $value;
    }

    if ( is_array( $value ) ) {
        foreach ( $value as $k => $v ) {
            $value[ $k ] = wakalumi_normalize_domain_deep( $v );
        }
        return $value;
    }

    return $value;
}

function wakalumi_register_domain_normalizer_filters() {
    $live_origin = untrailingslashit( home_url() );
    if ( stripos( $live_origin, 'wakalumibprscoid.local' ) !== false ) {
        return; // Masih di environment local, tidak perlu filter
    }

    $all_options = wp_load_alloptions();
    if ( is_array( $all_options ) ) {
        foreach ( array_keys( $all_options ) as $opt_name ) {
            if ( strpos( $opt_name, 'options_' ) === 0 || strpos( $opt_name, 'wakalumi_' ) === 0 ) {
                add_filter( "option_{$opt_name}", 'wakalumi_normalize_domain_deep', 20 );
            }
        }
    }

    add_filter( 'the_content', 'wakalumi_normalize_domain_deep', 20 );
    add_filter( 'wp_get_attachment_url', 'wakalumi_normalize_domain_deep', 20 );
}
add_action( 'init', 'wakalumi_register_domain_normalizer_filters', 1 );

// ────────────────────────────────────────────────
// BUILT-IN SMART SEO ENGINE (Meta Description, Open Graph WhatsApp & Schema.org JSON-LD)
// Otomatis aktif dan menghormati plugin SEO pihak ketiga (Yoast / Rank Math) jika terpasang.
// ────────────────────────────────────────────────
function wakalumi_render_seo_meta_tags() {
    // Jika Yoast SEO atau Rank Math aktif, biarkan plugin menangani meta tag agar tidak duplikat
    if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) {
        return;
    }

    $site_name   = get_option( 'options_site_brand_name', 'Bank Syariah Wakalumi' );
    $default_desc = get_option(
        'options_seo_meta_desc',
        'PT BPRS Wakalumi (Bank Syariah Wakalumi / BSW) — Bank Perekonomian Rakyat Syariah terpercaya di Ciputat, Tangerang Selatan & Depok. Solusi Tabungan Syariah, Deposito Mudharabah bagi hasil kompetitif, dan Pembiayaan Syariah mudah, amanah, berizin & diawasi OJK serta dijamin LPS.'
    );
    $keywords    = get_option(
        'options_seo_keywords',
        'Bank Syariah Wakalumi, BPRS Wakalumi, BSW, Bank Syariah Ciputat, Bank Syariah Tangerang Selatan, Bank Syariah Depok, Tabungan Syariah, Deposito Syariah, Pembiayaan Syariah, BPRS OJK LPS'
    );
    $google_ver  = trim( (string) get_option( 'options_seo_google_verify', '' ) );

    $meta_title = wp_get_document_title();
    $meta_desc  = $default_desc;
    $og_type    = 'website';
    $og_url     = home_url( add_query_arg( [], $GLOBALS['wp']->request ?? '' ) );

    if ( is_front_page() || is_home() ) {
        $og_url = home_url( '/' );
    } elseif ( is_singular() ) {
        global $post;
        if ( $post ) {
            $og_url  = get_permalink( $post );
            $og_type = ( $post->post_type === 'berita' || $post->post_type === 'post' ) ? 'article' : 'website';
            $excerpt = wp_strip_all_tags( get_the_excerpt( $post ) );
            if ( ! empty( $excerpt ) && strlen( $excerpt ) > 30 ) {
                $meta_desc = wp_trim_words( $excerpt, 28, '...' );
            }
        }
    }

    // OG Image: Prioritaskan Featured Image artikel -> OG Image Admin -> Logo Bank -> Default Emblem
    $og_image = get_option( 'options_seo_og_image', '' );
    if ( is_singular() && has_post_thumbnail() ) {
        $thumb_url = get_the_post_thumbnail_url( null, 'large' );
        if ( $thumb_url ) {
            $og_image = $thumb_url;
        }
    }
    if ( empty( $og_image ) ) {
        $og_image = get_option( 'options_site_logo', '' );
    }
    if ( empty( $og_image ) ) {
        $og_image = WAKALUMI_URI . '/assets/img/untitled3.png';
    }

    echo "\n<!-- Wakalumi Built-in SEO & Open Graph Engine -->\n";
    echo '<meta name="description" content="' . esc_attr( $meta_desc ) . '">' . "\n";
    if ( ! empty( $keywords ) ) {
        echo '<meta name="keywords" content="' . esc_attr( $keywords ) . '">' . "\n";
    }
    echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">' . "\n";
    echo '<link rel="canonical" href="' . esc_url( trailingslashit( $og_url ) ) . '">' . "\n";

    if ( ! empty( $google_ver ) ) {
        echo '<meta name="google-site-verification" content="' . esc_attr( $google_ver ) . '">' . "\n";
    }

    // Open Graph (WhatsApp, Facebook, LinkedIn)
    echo '<meta property="og:locale" content="id_ID">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $meta_title ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $meta_desc ) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url( trailingslashit( $og_url ) ) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";

    // Twitter / X Card
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( $meta_title ) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr( $meta_desc ) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";

    // Schema.org JSON-LD FinancialService / BankOrCreditUnion
    $phone   = get_option( 'options_contact_phone', '(021) 7490801' );
    $address = get_option( 'options_contact_address', 'Jl. K.H. Dewantara No. 11A, Ciputat, Kota Tangerang Selatan, Banten' );
    $schema  = [
        '@context'    => 'https://schema.org',
        '@type'       => 'BankOrCreditUnion',
        'name'        => 'PT BPRS Wakalumi (' . $site_name . ')',
        'alternateName' => 'Bank Syariah Wakalumi (BSW)',
        'url'         => home_url( '/' ),
        'logo'        => $og_image,
        'description' => $default_desc,
        'telephone'   => $phone,
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => $address,
            'addressLocality' => 'Tangerang Selatan',
            'addressRegion'   => 'Banten',
            'addressCountry'  => 'ID',
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
    echo "<!-- /Wakalumi Built-in SEO Engine -->\n\n";
}
add_action( 'wp_head', 'wakalumi_render_seo_meta_tags', 2 );
