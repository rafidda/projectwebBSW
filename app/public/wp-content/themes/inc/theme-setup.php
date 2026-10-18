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
 * Enable WebP and SVG uploads in WordPress Media Library
 */
function wakalumi_allow_webp_upload( $mimes ) {
    $mimes['webp'] = 'image/webp';
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'wakalumi_allow_webp_upload' );

/**
 * Fix WebP filetype and extension check in WordPress
 */
function wakalumi_check_webp_filetype( $data, $file, $filename, $mimes ) {
    $ext = pathinfo( $filename, PATHINFO_EXTENSION );
    if ( strtolower( $ext ) === 'webp' ) {
        $data['type'] = 'image/webp';
        $data['ext']  = 'webp';
    }
    return $data;
}
add_filter( 'wp_check_filetype_and_ext', 'wakalumi_check_webp_filetype', 10, 4 );

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

/**
 * Otomatis set halaman 'Home' atau 'Beranda' sebagai Front Page dan pasang template front-page.php
 */
function wakalumi_ensure_front_page() {
    $home_page = get_page_by_path( 'home' ) ?: get_page_by_path( 'beranda' );
    if ( ! $home_page ) {
        $pages = get_posts( [
            'post_type'   => 'page',
            'title'       => 'Beranda',
            'post_status' => 'publish',
            'numberposts' => 1,
        ] );
        if ( empty( $pages ) ) {
            $pages = get_posts( [
                'post_type'   => 'page',
                'title'       => 'Home',
                'post_status' => 'publish',
                'numberposts' => 1,
            ] );
        }
        if ( ! empty( $pages ) ) {
            $home_page = $pages[0];
        } else {
            $home_id = wp_insert_post( [
                'post_title'   => 'Beranda',
                'post_name'    => 'beranda',
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => '',
            ] );
            if ( $home_id && ! is_wp_error( $home_id ) ) {
                $home_page = get_post( $home_id );
            }
        }
    }

    if ( $home_page ) {
        if ( get_option( 'show_on_front' ) !== 'page' || (int) get_option( 'page_on_front' ) !== (int) $home_page->ID ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $home_page->ID );
        }
        $curr_tmpl = get_post_meta( $home_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'front-page.php' ) {
            update_post_meta( $home_page->ID, '_wp_page_template', 'front-page.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_front_page' );

/**
 * Filter template_include: Mengunci setiap halaman agar 100% memuat template peruntukannya
 */
function wakalumi_enforce_template_routing( $template ) {
    // 1. Beranda / Front Page
    if ( is_front_page() ) {
        $front = locate_template( [ 'front-page.php' ] );
        if ( $front ) return $front;
    }

    global $post, $wp_query;
    $slug = isset( $post->post_name ) ? strtolower( $post->post_name ) : '';
    
    // Parse cleaned request URI path
    $raw_uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
    $path    = parse_url( $raw_uri, PHP_URL_PATH );
    $req_uri = rtrim( strtolower( (string) $path ), '/' );

    if ( in_array( $slug, [ 'home', 'beranda' ], true ) ) {
        $front = locate_template( [ 'front-page.php' ] );
        if ( $front ) return $front;
    }

    // Helper closure to mark query clean and return template
    $serve_clean_template = function( $file ) use ( &$wp_query ) {
        $located = locate_template( [ $file ] );
        if ( $located ) {
            if ( is_404() || ( isset( $wp_query ) && $wp_query->is_404 ) ) {
                $wp_query->is_404  = false;
                $wp_query->is_page = true;
                status_header( 200 );
            }
            return $located;
        }
        return false;
    };

    // 2. Profil: Tentang Kami
    if ( in_array( $slug, [ 'tentang-kami', 'tentang' ], true ) || strpos( $req_uri, '/tentang-kami' ) !== false ) {
        $res = $serve_clean_template( 'page-tentang-kami.php' );
        if ( $res ) return $res;
    }

    // 3. Profil: Legalitas Perusahaan
    if ( in_array( $slug, [ 'legalitas', 'legalitas-perusahaan' ], true ) || strpos( $req_uri, '/legalitas' ) !== false ) {
        $res = $serve_clean_template( 'page-legalitas.php' );
        if ( $res ) return $res;
    }

    // 4. Profil: Susunan Pengurus
    if ( in_array( $slug, [ 'susunan-pengurus', 'pengurus' ], true ) || strpos( $req_uri, '/susunan-pengurus' ) !== false ) {
        $res = $serve_clean_template( 'page-susunan-pengurus.php' );
        if ( $res ) return $res;
    }

    // 5. Profil: Jaringan Kantor
    if ( in_array( $slug, [ 'jaringan-kantor', 'kantor', 'cabang' ], true ) || strpos( $req_uri, '/jaringan-kantor' ) !== false ) {
        $res = $serve_clean_template( 'page-jaringan-kantor.php' );
        if ( $res ) return $res;
    }

    // 6. Produk: Tabungan Syariah
    if ( in_array( $slug, [ 'tabungan-syariah', 'tabungan' ], true ) || strpos( $req_uri, '/tabungan-syariah' ) !== false ) {
        $res = $serve_clean_template( 'page-tabungan-syariah.php' );
        if ( $res ) return $res;
    }

    // 7. Produk: Deposito Syariah
    if ( in_array( $slug, [ 'deposito-syariah', 'deposito', 'deposito-mudharabah' ], true ) || strpos( $req_uri, '/deposito-syariah' ) !== false ) {
        $res = $serve_clean_template( 'page-deposito-syariah.php' );
        if ( $res ) return $res;
    }

    // 8. Produk: Pembiayaan
    if ( in_array( $slug, [ 'pembiayaan', 'pembiayaan-syariah', 'lending' ], true ) || strpos( $req_uri, '/pembiayaan' ) !== false ) {
        $res = $serve_clean_template( 'page-pembiayaan.php' );
        if ( $res ) return $res;
    }

    // 9. Informasi: Brosur & Dokumen Digital
    if ( in_array( $slug, [ 'brosur', 'unduh-brosur', 'katalog-brosur' ], true ) || strpos( $req_uri, '/brosur' ) !== false || strpos( $req_uri, '/unduh-brosur' ) !== false ) {
        $res = $serve_clean_template( 'page-brosur.php' );
        if ( $res ) return $res;
    }

    // 10. Informasi: Laporan Publikasi & GCG
    if ( in_array( $slug, [ 'laporan-publikasi', 'laporan', 'laporan-keuangan', 'laporan-gcg' ], true ) || strpos( $req_uri, '/informasi/laporan' ) !== false || strpos( $req_uri, '/laporan-publikasi' ) !== false ) {
        $res = $serve_clean_template( 'page-laporan.php' );
        if ( $res ) return $res;
    }

    // 11. Informasi: Pengumuman Resmi & Surat Edaran
    if ( in_array( $slug, [ 'pengumuman', 'pengumuman-resmi', 'surat-edaran' ], true ) || strpos( $req_uri, '/informasi/pengumuman' ) !== false || strpos( $req_uri, '/pengumuman' ) !== false ) {
        $res = $serve_clean_template( 'page-pengumuman.php' );
        if ( $res ) return $res;
    }

    // 12. Informasi: Info Lelang Agunan
    if ( in_array( $slug, [ 'lelang', 'info-lelang', 'lelang-agunan' ], true ) || strpos( $req_uri, '/informasi/lelang' ) !== false || strpos( $req_uri, '/lelang' ) !== false ) {
        $res = $serve_clean_template( 'page-lelang.php' );
        if ( $res ) return $res;
    }

    // 13. Informasi: Tim Kami & Verifikasi Staf
    if ( in_array( $slug, [ 'tim-kami', 'tim', 'karyawan', 'staf' ], true ) || strpos( $req_uri, '/informasi/tim-kami' ) !== false || strpos( $req_uri, '/tim-kami' ) !== false ) {
        $res = $serve_clean_template( 'page-tim-kami.php' );
        if ( $res ) return $res;
    }

    // 14. Informasi: Kegiatan & Agenda Bank
    if ( in_array( $slug, [ 'kegiatan', 'agenda', 'kegiatan-dan-agenda', 'agenda-kegiatan' ], true ) || strpos( $req_uri, '/informasi/kegiatan' ) !== false || strpos( $req_uri, '/kegiatan' ) !== false || strpos( $req_uri, '/agenda' ) !== false ) {
        $res = $serve_clean_template( 'page-kegiatan.php' );
        if ( $res ) return $res;
    }

    // 15. Informasi: Galeri Dokumentasi Foto & Video
    if ( in_array( $slug, [ 'galeri', 'gallery', 'galeri-foto', 'dokumentasi', 'galeri-dokumentasi' ], true ) || strpos( $req_uri, '/informasi/galeri' ) !== false || strpos( $req_uri, '/galeri' ) !== false ) {
        $res = $serve_clean_template( 'page-galeri.php' );
        if ( $res ) return $res;
    }

    // 16. Informasi: Karir & Rekrutmen
    if ( in_array( $slug, [ 'karir', 'rekrutmen', 'lowongan', 'karir-rekrutmen' ], true ) || strpos( $req_uri, '/informasi/karir' ) !== false || strpos( $req_uri, '/karir' ) !== false ) {
        $res = $serve_clean_template( 'page-karir.php' );
        if ( $res ) return $res;
    }

    // 17. Informasi: Literasi & Inklusi Keuangan Syariah
    if ( in_array( $slug, [ 'literasi-keuangan', 'literasi-dan-inklusi', 'literasi-inklusi', 'literasi', 'inklusi' ], true ) || strpos( $req_uri, '/informasi/literasi' ) !== false || strpos( $req_uri, '/literasi-keuangan' ) !== false ) {
        $res = $serve_clean_template( 'page-literasi.php' );
        if ( $res ) return $res;
    }

    // 18. Kontak & Saluran Komunikasi
    if ( in_array( $slug, [ 'kontak', 'contact', 'hubungi-kami', 'kontak-kami' ], true ) || strpos( $req_uri, '/kontak' ) !== false || strpos( $req_uri, '/contact' ) !== false ) {
        $res = $serve_clean_template( 'page-kontak.php' );
        if ( $res ) return $res;
    }

    return $template;
}
add_filter( 'template_include', 'wakalumi_enforce_template_routing', 99 );

/**
 * Otomatis pastikan halaman Parent 'Profil' dan Child 'Tentang Kami' terdaftar di database
 * dengan template page-tentang-kami.php agar tautan /profil/tentang-kami langsung aktif
 */
function wakalumi_ensure_profile_pages() {
    // 1. Pastikan Parent Page 'Profil' ada
    $parent_profil = get_page_by_path( 'profil' );
    $parent_id     = 0;
    if ( ! $parent_profil ) {
        $parent_id = wp_insert_post( [
            'post_title'   => 'Profil',
            'post_name'    => 'profil',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
    } else {
        $parent_id = $parent_profil->ID;
    }

    // 2. Pastikan Child Page 'Tentang Kami' ada
    $about_page = get_page_by_path( 'profil/tentang-kami' ) ?: get_page_by_path( 'tentang-kami' );
    if ( ! $about_page ) {
        $about_id = wp_insert_post( [
            'post_title'   => 'Tentang Kami',
            'post_name'    => 'tentang-kami',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $about_id && ! is_wp_error( $about_id ) ) {
            update_post_meta( $about_id, '_wp_page_template', 'page-tentang-kami.php' );
        }
    } else {
        if ( (int) $about_page->post_parent !== (int) $parent_id ) {
            wp_update_post( [
                'ID'          => $about_page->ID,
                'post_parent' => $parent_id,
            ] );
        }
        $curr_tmpl = get_post_meta( $about_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-tentang-kami.php' ) {
            update_post_meta( $about_page->ID, '_wp_page_template', 'page-tentang-kami.php' );
        }
    }

    // 3. Pastikan Child Page 'Legalitas' ada
    $legal_page = get_page_by_path( 'profil/legalitas' ) ?: get_page_by_path( 'legalitas' );
    if ( ! $legal_page ) {
        $legal_id = wp_insert_post( [
            'post_title'   => 'Legalitas Perusahaan',
            'post_name'    => 'legalitas',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $legal_id && ! is_wp_error( $legal_id ) ) {
            update_post_meta( $legal_id, '_wp_page_template', 'page-legalitas.php' );
        }
    } else {
        if ( (int) $legal_page->post_parent !== (int) $parent_id ) {
            wp_update_post( [
                'ID'          => $legal_page->ID,
                'post_parent' => $parent_id,
            ] );
        }
        $curr_tmpl = get_post_meta( $legal_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-legalitas.php' ) {
            update_post_meta( $legal_page->ID, '_wp_page_template', 'page-legalitas.php' );
        }
    }

    // 4. Pastikan Child Page 'Susunan Pengurus' ada
    $pengurus_page = get_page_by_path( 'profil/susunan-pengurus' ) ?: get_page_by_path( 'susunan-pengurus' );
    if ( ! $pengurus_page ) {
        $pengurus_id = wp_insert_post( [
            'post_title'   => 'Susunan Pengurus',
            'post_name'    => 'susunan-pengurus',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $pengurus_id && ! is_wp_error( $pengurus_id ) ) {
            update_post_meta( $pengurus_id, '_wp_page_template', 'page-susunan-pengurus.php' );
        }
    } else {
        if ( (int) $pengurus_page->post_parent !== (int) $parent_id ) {
            wp_update_post( [
                'ID'          => $pengurus_page->ID,
                'post_parent' => $parent_id,
            ] );
        }
        $curr_tmpl = get_post_meta( $pengurus_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-susunan-pengurus.php' ) {
            update_post_meta( $pengurus_page->ID, '_wp_page_template', 'page-susunan-pengurus.php' );
        }
    }

    // 5. Pastikan Child Page 'Jaringan Kantor' ada
    $kantor_page = get_page_by_path( 'profil/jaringan-kantor' ) ?: get_page_by_path( 'jaringan-kantor' );
    if ( ! $kantor_page ) {
        $kantor_id = wp_insert_post( [
            'post_title'   => 'Jaringan Kantor',
            'post_name'    => 'jaringan-kantor',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $kantor_id && ! is_wp_error( $kantor_id ) ) {
            update_post_meta( $kantor_id, '_wp_page_template', 'page-jaringan-kantor.php' );
        }
    } else {
        if ( (int) $kantor_page->post_parent !== (int) $parent_id ) {
            wp_update_post( [
                'ID'          => $kantor_page->ID,
                'post_parent' => $parent_id,
            ] );
        }
        $curr_tmpl = get_post_meta( $kantor_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-jaringan-kantor.php' ) {
            update_post_meta( $kantor_page->ID, '_wp_page_template', 'page-jaringan-kantor.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_profile_pages' );

/**
 * Otomatis pastikan halaman Parent 'Produk' dan Child Pages terdaftar di database
 * agar URL /produk/tabungan-syariah, /produk/deposito-syariah, /produk/pembiayaan langsung aktif
 */
function wakalumi_ensure_product_pages() {
    // 1. Pastikan Parent Page 'Produk' ada
    $parent_produk = get_page_by_path( 'produk' );
    $parent_id     = 0;
    if ( ! $parent_produk ) {
        $parent_id = wp_insert_post( [
            'post_title'   => 'Produk',
            'post_name'    => 'produk',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
    } else {
        $parent_id = $parent_produk->ID;
    }

    // 2. Child Page: Tabungan Syariah
    $tabungan_page = get_page_by_path( 'produk/tabungan-syariah' ) ?: get_page_by_path( 'tabungan-syariah' );
    if ( ! $tabungan_page ) {
        $tab_id = wp_insert_post( [
            'post_title'   => 'Tabungan Syariah',
            'post_name'    => 'tabungan-syariah',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $tab_id && ! is_wp_error( $tab_id ) ) {
            update_post_meta( $tab_id, '_wp_page_template', 'page-tabungan-syariah.php' );
        }
    } else {
        if ( (int) $tabungan_page->post_parent !== (int) $parent_id ) {
            wp_update_post( [
                'ID'          => $tabungan_page->ID,
                'post_parent' => $parent_id,
            ] );
        }
        $curr_tmpl = get_post_meta( $tabungan_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-tabungan-syariah.php' ) {
            update_post_meta( $tabungan_page->ID, '_wp_page_template', 'page-tabungan-syariah.php' );
        }
    }

    // 3. Child Page: Deposito Syariah
    $deposito_page = get_page_by_path( 'produk/deposito-syariah' ) ?: get_page_by_path( 'deposito-syariah' );
    if ( ! $deposito_page ) {
        $dep_id = wp_insert_post( [
            'post_title'   => 'Deposito Syariah',
            'post_name'    => 'deposito-syariah',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $dep_id && ! is_wp_error( $dep_id ) ) {
            update_post_meta( $dep_id, '_wp_page_template', 'page-deposito-syariah.php' );
        }
    } else {
        if ( (int) $deposito_page->post_parent !== (int) $parent_id ) {
            wp_update_post( [
                'ID'          => $deposito_page->ID,
                'post_parent' => $parent_id,
            ] );
        }
        $curr_tmpl = get_post_meta( $deposito_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-deposito-syariah.php' ) {
            update_post_meta( $deposito_page->ID, '_wp_page_template', 'page-deposito-syariah.php' );
        }
    }

    // 4. Child Page: Pembiayaan
    $pembiayaan_page = get_page_by_path( 'produk/pembiayaan' ) ?: get_page_by_path( 'pembiayaan' );
    if ( ! $pembiayaan_page ) {
        $pem_id = wp_insert_post( [
            'post_title'   => 'Pembiayaan Syariah',
            'post_name'    => 'pembiayaan',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $pem_id && ! is_wp_error( $pem_id ) ) {
            update_post_meta( $pem_id, '_wp_page_template', 'page-pembiayaan.php' );
        }
    } else {
        if ( (int) $pembiayaan_page->post_parent !== (int) $parent_id ) {
            wp_update_post( [
                'ID'          => $pembiayaan_page->ID,
                'post_parent' => $parent_id,
            ] );
        }
        $curr_tmpl = get_post_meta( $pembiayaan_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-pembiayaan.php' ) {
            update_post_meta( $pembiayaan_page->ID, '_wp_page_template', 'page-pembiayaan.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_product_pages' );

/**
 * Otomatis pastikan halaman 'Brosur' terdaftar di database
 * agar URL /brosur/ langsung aktif dengan page-brosur.php
 */
function wakalumi_ensure_brosur_page() {
    $page = get_page_by_path( 'brosur' );
    if ( ! $page ) {
        $page_id = wp_insert_post( [
            'post_title'   => 'Katalog Brosur',
            'post_name'    => 'brosur',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $page_id && ! is_wp_error( $page_id ) ) {
            update_post_meta( $page_id, '_wp_page_template', 'page-brosur.php' );
        }
    } else {
        $curr_tmpl = get_post_meta( $page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-brosur.php' ) {
            update_post_meta( $page->ID, '_wp_page_template', 'page-brosur.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_brosur_page' );

/**
 * Otomatis pastikan Parent 'Informasi' dan Child 'Laporan Publikasi & GCG' terdaftar di database
 * agar URL /informasi/laporan-publikasi/ langsung aktif dengan page-laporan.php
 */
function wakalumi_ensure_laporan_page() {
    // 1. Pastikan Parent Page 'Informasi' ada
    $parent_info = get_page_by_path( 'informasi' );
    $parent_id   = 0;
    if ( ! $parent_info ) {
        $parent_id = wp_insert_post( [
            'post_title'   => 'Informasi',
            'post_name'    => 'informasi',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
    } else {
        $parent_id = $parent_info->ID;
    }

    // 2. Pastikan Child Page 'laporan-publikasi' ada
    $laporan_page = get_page_by_path( 'informasi/laporan-publikasi' ) ?: get_page_by_path( 'laporan-publikasi' );
    if ( ! $laporan_page ) {
        $lap_id = wp_insert_post( [
            'post_title'   => 'Laporan Publikasi & GCG',
            'post_name'    => 'laporan-publikasi',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $lap_id && ! is_wp_error( $lap_id ) ) {
            update_post_meta( $lap_id, '_wp_page_template', 'page-laporan.php' );
        }
    } else {
        if ( (int) $laporan_page->post_parent !== (int) $parent_id ) {
            wp_update_post( [
                'ID'          => $laporan_page->ID,
                'post_parent' => $parent_id,
            ] );
        }
        $curr_tmpl = get_post_meta( $laporan_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-laporan.php' ) {
            update_post_meta( $laporan_page->ID, '_wp_page_template', 'page-laporan.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_laporan_page' );

/**
 * Otomatis pastikan halaman 'Pengumuman' terdaftar di database dengan template page-pengumuman.php
 */
function wakalumi_ensure_pengumuman_page() {
    $parent_info = get_page_by_path( 'informasi' );
    $parent_id   = $parent_info ? $parent_info->ID : 0;

    $pengumuman_page = get_page_by_path( 'informasi/pengumuman' ) ?: get_page_by_path( 'pengumuman' );
    if ( ! $pengumuman_page ) {
        $p_id = wp_insert_post( [
            'post_title'   => 'Pengumuman Resmi',
            'post_name'    => 'pengumuman',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $p_id && ! is_wp_error( $p_id ) ) {
            update_post_meta( $p_id, '_wp_page_template', 'page-pengumuman.php' );
        }
    } else {
        $curr_tmpl = get_post_meta( $pengumuman_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-pengumuman.php' ) {
            update_post_meta( $pengumuman_page->ID, '_wp_page_template', 'page-pengumuman.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_pengumuman_page' );

/**
 * Otomatis pastikan halaman 'Lelang' terdaftar di database dengan template page-lelang.php
 */
function wakalumi_ensure_lelang_page() {
    $parent_info = get_page_by_path( 'informasi' );
    $parent_id   = $parent_info ? $parent_info->ID : 0;

    $lelang_page = get_page_by_path( 'informasi/lelang' ) ?: get_page_by_path( 'lelang' );
    if ( ! $lelang_page ) {
        $l_id = wp_insert_post( [
            'post_title'   => 'Info Lelang Agunan',
            'post_name'    => 'lelang',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $l_id && ! is_wp_error( $l_id ) ) {
            update_post_meta( $l_id, '_wp_page_template', 'page-lelang.php' );
        }
    } else {
        $curr_tmpl = get_post_meta( $lelang_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-lelang.php' ) {
            update_post_meta( $lelang_page->ID, '_wp_page_template', 'page-lelang.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_lelang_page' );

/**
 * Otomatis pastikan halaman 'Tim Kami' terdaftar di database dengan template page-tim-kami.php
 */
function wakalumi_ensure_tim_kami_page() {
    $parent_info = get_page_by_path( 'informasi' );
    $parent_id   = $parent_info ? $parent_info->ID : 0;

    $tim_page = get_page_by_path( 'informasi/tim-kami' ) ?: get_page_by_path( 'tim-kami' );
    if ( ! $tim_page ) {
        $t_id = wp_insert_post( [
            'post_title'   => 'Tim Kami & Verifikasi Staf',
            'post_name'    => 'tim-kami',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $t_id && ! is_wp_error( $t_id ) ) {
            update_post_meta( $t_id, '_wp_page_template', 'page-tim-kami.php' );
        }
    } else {
        $curr_tmpl = get_post_meta( $tim_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-tim-kami.php' ) {
            update_post_meta( $tim_page->ID, '_wp_page_template', 'page-tim-kami.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_tim_kami_page' );

/**
 * Otomatis pastikan halaman 'Kegiatan' terdaftar di database dengan template page-kegiatan.php
 * agar URL /informasi/kegiatan/ atau /kegiatan/ langsung aktif tanpa konfigurasi manual
 */
function wakalumi_ensure_kegiatan_page() {
    $parent_info = get_page_by_path( 'informasi' );
    $parent_id   = $parent_info ? $parent_info->ID : 0;

    $kegiatan_page = get_page_by_path( 'informasi/kegiatan' ) ?: get_page_by_path( 'kegiatan' );
    if ( ! $kegiatan_page ) {
        $k_id = wp_insert_post( [
            'post_title'   => 'Kegiatan & Agenda Bank',
            'post_name'    => 'kegiatan',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $k_id && ! is_wp_error( $k_id ) ) {
            update_post_meta( $k_id, '_wp_page_template', 'page-kegiatan.php' );
        }
    } else {
        $curr_tmpl = get_post_meta( $kegiatan_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-kegiatan.php' ) {
            update_post_meta( $kegiatan_page->ID, '_wp_page_template', 'page-kegiatan.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_kegiatan_page' );

/**
 * Otomatis pastikan halaman 'Galeri' terdaftar di database dengan template page-galeri.php
 * agar URL /informasi/galeri/ atau /galeri/ langsung aktif tanpa konfigurasi manual
 */
function wakalumi_ensure_galeri_page() {
    $parent_info = get_page_by_path( 'informasi' );
    $parent_id   = $parent_info ? $parent_info->ID : 0;

    $galeri_page = get_page_by_path( 'informasi/galeri' ) ?: get_page_by_path( 'galeri' );
    if ( ! $galeri_page ) {
        $g_id = wp_insert_post( [
            'post_title'   => 'Galeri Dokumentasi',
            'post_name'    => 'galeri',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $g_id && ! is_wp_error( $g_id ) ) {
            update_post_meta( $g_id, '_wp_page_template', 'page-galeri.php' );
        }
    } else {
        $curr_tmpl = get_post_meta( $galeri_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-galeri.php' ) {
            update_post_meta( $galeri_page->ID, '_wp_page_template', 'page-galeri.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_galeri_page' );

/**
 * Otomatis pastikan halaman 'Karir & Rekrutmen' terdaftar di database dengan template page-karir.php
 * agar URL /informasi/karir/ atau /karir/ langsung aktif tanpa konfigurasi manual
 */
function wakalumi_ensure_karir_page() {
    $parent_info = get_page_by_path( 'informasi' );
    $parent_id   = $parent_info ? $parent_info->ID : 0;

    $karir_page = get_page_by_path( 'informasi/karir' ) ?: get_page_by_path( 'karir' );
    if ( ! $karir_page ) {
        $kr_id = wp_insert_post( [
            'post_title'   => 'Karir & Rekrutmen',
            'post_name'    => 'karir',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $kr_id && ! is_wp_error( $kr_id ) ) {
            update_post_meta( $kr_id, '_wp_page_template', 'page-karir.php' );
        }
    } else {
        $curr_tmpl = get_post_meta( $karir_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-karir.php' ) {
            update_post_meta( $karir_page->ID, '_wp_page_template', 'page-karir.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_karir_page' );

/**
 * Otomatis pastikan halaman 'Literasi & Inklusi Keuangan Syariah' terdaftar di database dengan template page-literasi.php
 * agar URL /informasi/literasi-keuangan/ atau /literasi-keuangan/ langsung aktif
 */
function wakalumi_ensure_literasi_page() {
    $parent_info = get_page_by_path( 'informasi' );
    $parent_id   = $parent_info ? $parent_info->ID : 0;

    $lit_page = get_page_by_path( 'informasi/literasi-keuangan' ) ?: ( get_page_by_path( 'literasi-keuangan' ) ?: get_page_by_path( 'literasi' ) );
    if ( ! $lit_page ) {
        $lit_id = wp_insert_post( [
            'post_title'   => 'Literasi & Inklusi Keuangan Syariah',
            'post_name'    => 'literasi-keuangan',
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $lit_id && ! is_wp_error( $lit_id ) ) {
            update_post_meta( $lit_id, '_wp_page_template', 'page-literasi.php' );
        }
    } else {
        $curr_tmpl = get_post_meta( $lit_page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-literasi.php' ) {
            update_post_meta( $lit_page->ID, '_wp_page_template', 'page-literasi.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_literasi_page' );

/**
 * Otomatis pastikan halaman 'Kontak' terdaftar di database
 * agar URL /kontak/ langsung aktif dengan page-kontak.php
 */
function wakalumi_ensure_kontak_page() {
    $page = get_page_by_path( 'kontak' ) ?: get_page_by_path( 'contact' );
    if ( ! $page ) {
        $page_id = wp_insert_post( [
            'post_title'   => 'Kontak',
            'post_name'    => 'kontak',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ] );
        if ( $page_id && ! is_wp_error( $page_id ) ) {
            update_post_meta( $page_id, '_wp_page_template', 'page-kontak.php' );
        }
    } else {
        $curr_tmpl = get_post_meta( $page->ID, '_wp_page_template', true );
        if ( $curr_tmpl !== 'page-kontak.php' ) {
            update_post_meta( $page->ID, '_wp_page_template', 'page-kontak.php' );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_kontak_page' );

/**
 * Sembunyikan editor Gutenberg kosong 'Type / to choose a block' pada Halaman Beranda
 * dan tampilkan Panduan Visual Pengelolaan Beranda yang ramah pengguna.
 */
function wakalumi_hide_editor_for_front_page() {
    $post_id = $_GET['post'] ?? $_POST['post_ID'] ?? null;
    if ( ! $post_id ) return;

    $front_page_id = (int) get_option( 'page_on_front' );
    $page = get_post( $post_id );
    if ( (int) $post_id === $front_page_id || ( $page && in_array( strtolower( $page->post_name ), [ 'home', 'beranda' ] ) ) ) {
        remove_post_type_support( 'page', 'editor' );
    }
}
add_action( 'admin_init', 'wakalumi_hide_editor_for_front_page' );

/**
 * Tambahkan Kotak Panduan Pengelolaan Beranda di halaman edit Laman Beranda
 */
function wakalumi_add_front_page_guide_metabox() {
    $post_id = $_GET['post'] ?? $_POST['post_ID'] ?? null;
    if ( ! $post_id ) return;

    $front_page_id = (int) get_option( 'page_on_front' );
    $page = get_post( $post_id );
    if ( (int) $post_id === $front_page_id || ( $page && in_array( strtolower( $page->post_name ), [ 'home', 'beranda' ] ) ) ) {
        add_meta_box(
            'wakalumi_front_guide_box',
            '🧭 Panduan Cepat Kelola Konten Beranda BPRS Wakalumi',
            'wakalumi_render_front_guide_box',
            'page',
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'wakalumi_add_front_page_guide_metabox' );

function wakalumi_render_front_guide_box() {
    ?>
    <div style="padding: 10px 5px; font-size: 13px; line-height: 1.8; color: #334155;">
        <p style="margin-top: 0; font-size: 14px;">
            Halaman <strong>Beranda (Homepage)</strong> BPRS Wakalumi dirancang otomatis menyambungkan berbagai modul agar rapi dan mudah dirawat:
        </p>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 12px; margin-top: 10px;">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                <strong style="color: #088395;">🖼️ Banner Berjalan (Hero Slider):</strong><br>
                Dikelola melalui menu <a href="admin.php?page=wakalumi-hero" style="font-weight: bold; text-decoration: underline;">Beranda: Hero & Slider</a> di bilah navigasi kiri.
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                <strong style="color: #088395;">⚡ Layanan Cepat, Video & IG Feed:</strong><br>
                Dikelola di menu <a href="admin.php?page=wakalumi-media" style="font-weight: bold; text-decoration: underline;">Pengaturan Website &rarr; Layanan & Media</a>.
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                <strong style="color: #088395;">📊 Realisasi Nisbah Bagi Hasil:</strong><br>
                Dikelola di menu <a href="admin.php?page=wakalumi-nisbah" style="font-weight: bold; text-decoration: underline;">Pengaturan Website &rarr; Informasi Nisbah</a>.
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                <strong style="color: #088395;">🗺️ Lokasi Google Maps & Kontak:</strong><br>
                Dikelola di menu <a href="admin.php?page=wakalumi-contact" style="font-weight: bold; text-decoration: underline;">Pengaturan Website &rarr; Kontak & Maps</a>.
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                <strong style="color: #088395;">📦 Kartu Pilihan Produk:</strong><br>
                Dikelola di menu <a href="edit.php?post_type=produk" style="font-weight: bold; text-decoration: underline;">Produk</a> (centang "Tampilkan di Beranda").
            </div>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                <strong style="color: #088395;">🏢 Tentang Kami & Ajakan (CTA):</strong><br>
                Dikelola langsung pada formulir di bawah kotak panduan ini.
            </div>
        </div>
    </div>
    <?php
}

/**
 * Bersihkan menu bawaan WordPress yang tidak digunakan (Posts bawaan 'Hello World' & Komentar)
 * serta sembunyikan sementara 'Tim Kami' agar sidebar admin rapi, fokus, dan tidak menimbulkan ambiguitas.
 */
function wakalumi_cleanup_admin_sidebar() {
    // Sembunyikan default "Pos" (Posts) karena berita dikelola via CPT "Berita"
    remove_menu_page( 'edit.php' );
    // Sembunyikan default "Komentar" (Comments) karena website bank syariah tidak menggunakan komentar blog publik
    remove_menu_page( 'edit-comments.php' );
    // Sembunyikan sementara "Tim Kami" agar fokus ke beranda; diaktifkan kembali saat pembuatan halaman Susunan Pengurus
    remove_menu_page( 'edit.php?post_type=anggota_tim' );
}
add_action( 'admin_menu', 'wakalumi_cleanup_admin_sidebar', 999 );

/**
 * Tambahkan Widget Panduan Peta Situs Utama di Dashboard Beranda WP-Admin
 */
function wakalumi_register_dashboard_widget() {
    wp_add_dashboard_widget(
        'wakalumi_dashboard_roadmap',
        '🏛️ Panduan Struktur Konten Website BPRS Wakalumi',
        'wakalumi_render_dashboard_roadmap_widget'
    );
}
add_action( 'wp_dashboard_setup', 'wakalumi_register_dashboard_widget' );

function wakalumi_render_dashboard_roadmap_widget() {
    ?>
    <div style="font-size: 13px; line-height: 1.8; color: #334155;">
        <p style="margin-top: 0;">
            Selamat datang di panel kendali <strong>Bank Syariah Wakalumi</strong>. Berikut adalah peta navigasi untuk mengelola seluruh bagian website secara mandiri:
        </p>
        <table class="widefat striped" style="margin-top: 10px; border-radius: 6px; overflow: hidden;">
            <thead>
                <tr style="background: #f8fafc;">
                    <th style="width: 170px; font-weight: 600;">Menu di Bilah Kiri</th>
                    <th style="font-weight: 600;">Fungsi & Konten yang Dikendalikan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="admin.php?page=wakalumi-settings"><strong>⚙️ Pengaturan Website</strong></a></td>
                    <td>
                        Pusat kontrol konten terpadu (5 Submenu):
                        <ul style="margin: 4px 0 0 15px; list-style: disc;">
                            <li><strong>📢 Umum & WhatsApp:</strong> Bar pengumuman atas & nomor WhatsApp CS interaktif.</li>
                            <li><strong>🗺️ Kontak & Maps:</strong> Alamat pusat, email, telepon, & embed Google Maps interaktif.</li>
                            <li><strong>⚡ Beranda: Media & Kartu:</strong> 4 Kartu Layanan Cepat (upload ikon/gambar), Video Profil YouTube + upload thumbnail, Badge Jaminan LPS Rp2 Miliar, Logo Regulasi Hero (repeater OJK, LPS, BI), Bagian Tentang Kami, & Feed Instagram.</li>
                            <li><strong>📊 Beranda: Kinerja Nisbah:</strong> Tabel dinamis Realisasi Nisbah Bagi Hasil bulanan.</li>
                            <li><strong>🏢 Footer & Jam Kerja:</strong> Jam kerja kantor, repeater logo regulasi footer, dan teks legalitas & hak cipta.</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td><a href="admin.php?page=wakalumi-hero"><strong>🖼️ Beranda: Hero &amp; Slider</strong></a></td>
                    <td>Kelola banner slide di beranda atas (foto latar HD, judul headline besar, sub-judul, dan 2 tombol aksi) beserta lencana LPS &amp; logo regulasi.</td>
                </tr>
                <tr>
                    <td><a href="edit.php?post_type=produk"><strong>📦 Katalog Produk</strong></a></td>
                    <td>Kelola katalog produk simpanan (Tabungan, Deposito) dan Pembiayaan Syariah. Centang "Tampilkan di Beranda" untuk menjadikannya produk unggulan di homepage.</td>
                </tr>
                <tr>
                    <td><a href="edit.php?post_type=berita"><strong>📰 Berita & Artikel</strong></a></td>
                    <td>Publikasi artikel, kabar perusahaan, edukasi literasi syariah, dan siaran pers resmi (otomatis tampil 3 teratas di beranda).</td>
                </tr>
                <tr>
                    <td><span style="color: #64748b;"><strong>👥 Susunan Pengurus (Disiapkan)</strong></span></td>
                    <td>Modul susunan pengurus (Dewan Komisaris, Direksi, DPS). <em>Akan dimunculkan di sidebar saat pengerjaan halaman Profil Pengurus.</em></td>
                </tr>
                <tr>
                    <td><a href="edit.php?post_type=page"><strong>📄 Laman (Pages)</strong></a></td>
                    <td>Halaman-halaman statis: Beranda (Home), Tentang Kami, Kontak, Simulasi, dll.</td>
                </tr>
                <tr>
                    <td><a href="nav-menus.php"><strong>🎨 Tampilan &rarr; Menu</strong></a></td>
                    <td>Mengatur susunan navigasi navbar atas dan struktur dropdown.</td>
                </tr>
                <tr>
                    <td><a href="upload.php"><strong>📁 Media</strong></a></td>
                    <td>Perpustakaan berkas: gambar banner, logo regulator, brosur, dan laporan PDF (terintegrasi langsung dengan tombol "Unggah Gambar" di seluruh panel).</td>
                </tr>
            </tbody>
        </table>
        <p style="margin-bottom: 0; font-size: 12px; color: #64748b; margin-top: 10px;">
            💡 <em>Catatan: Menu bawaan blog standar ("Pos" & "Komentar") sengaja disembunyikan agar Anda tidak bingung dengan menu publikasi perbankan.</em>
        </p>
    </div>
    <?php
}

/**
 * Tambahkan Menu Cepat (Quick Edit) di Admin Bar bagian atas saat melihat Frontend
 */
function wakalumi_admin_bar_quick_links( $wp_admin_bar ) {
    if ( ! current_user_can( 'manage_options' ) ) return;

    $wp_admin_bar->add_node( [
        'id'    => 'wakalumi_quick_edit',
        'title' => '⚡ Edit Konten Web',
        'href'  => admin_url( 'admin.php?page=wakalumi-settings' ),
    ] );

    $wp_admin_bar->add_node( [
        'id'     => 'wakalumi_quick_general',
        'parent' => 'wakalumi_quick_edit',
        'title'  => '📢 Umum & Pengumuman Bar',
        'href'   => admin_url( 'admin.php?page=wakalumi-settings' ),
    ] );

    $wp_admin_bar->add_node( [
        'id'     => 'wakalumi_quick_contact',
        'parent' => 'wakalumi_quick_edit',
        'title'  => '🗺️ Kontak & Peta Maps',
        'href'   => admin_url( 'admin.php?page=wakalumi-contact' ),
    ] );

    $wp_admin_bar->add_node( [
        'id'     => 'wakalumi_quick_media',
        'parent' => 'wakalumi_quick_edit',
        'title'  => '⚡ Layanan Cepat, Video & IG',
        'href'   => admin_url( 'admin.php?page=wakalumi-media' ),
    ] );

    $wp_admin_bar->add_node( [
        'id'     => 'wakalumi_quick_nisbah',
        'parent' => 'wakalumi_quick_edit',
        'title'  => '📊 Informasi Nisbah Bagi Hasil',
        'href'   => admin_url( 'admin.php?page=wakalumi-nisbah' ),
    ] );

    $wp_admin_bar->add_node( [
        'id'     => 'wakalumi_quick_slider',
        'parent' => 'wakalumi_quick_edit',
        'title'  => '🖼️ Slider Hero Banner',
        'href'   => admin_url( 'admin.php?page=wakalumi-hero' ),
    ] );

    $wp_admin_bar->add_node( [
        'id'     => 'wakalumi_quick_about',
        'parent' => 'wakalumi_quick_edit',
        'title'  => '🏛️ Profil: Tentang Kami & Visi Misi',
        'href'   => admin_url( 'admin.php?page=wakalumi-about' ),
    ] );

    $wp_admin_bar->add_node( [
        'id'     => 'wakalumi_quick_footer',
        'parent' => 'wakalumi_quick_edit',
        'title'  => '🏢 Footer & Jam Kerja',
        'href'   => admin_url( 'admin.php?page=wakalumi-footer' ),
    ] );
}
add_action( 'admin_bar_menu', 'wakalumi_admin_bar_quick_links', 100 );

/**
 * Otomatis pastikan rewrite rules ter-flush satu kali untuk rute produk
 */
function wakalumi_check_rewrite_flush() {
    if ( get_option( 'wakalumi_flush_rewrite_v2' ) !== 'yes' ) {
        flush_rewrite_rules( false );
        update_option( 'wakalumi_flush_rewrite_v2', 'yes' );
    }
}
add_action( 'init', 'wakalumi_check_rewrite_flush', 99 );

/**
 * Helper: Ambil Data Identitas Brand & Logo Website (Universal Helper)
 * Digunakan secara konsisten di Navbar (header.php) dan Footer (footer.php).
 *
 * Mendukung fleksibilitas rasio aspek (tidak terpotong), mode tampilan (logo+teks, logo saja, teks saja),
 * penyesuaian tinggi logo, dan versi dark mode.
 *
 * @return array
 */
function wakalumi_get_brand_identity(): array {
    $logo_url      = get_option( 'options_site_logo', '' );
    $logo_id       = (int) get_option( 'options_site_logo_id', 0 );
    $logo_dark_url = get_option( 'options_site_logo_dark', '' );
    $logo_dark_id  = (int) get_option( 'options_site_logo_dark_id', 0 );
    $favicon_url   = get_option( 'options_site_favicon', '' );
    $favicon_id    = (int) get_option( 'options_site_favicon_id', 0 );
    $name          = get_option( 'options_site_brand_name', 'Bank Syariah Wakalumi' );
    $tagline       = get_option( 'options_site_brand_tagline', 'BSW' );
    $display_mode  = get_option( 'options_site_logo_display', 'both' );
    $logo_height   = (int) get_option( 'options_site_logo_height', 42 );

    $name = str_ireplace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $name );
    if ( strcasecmp( $tagline, 'BPRS' ) === 0 ) {
        $tagline = 'BSW';
    }

    // Fallback jika options_site_logo belum diisi tapi custom_logo theme_mod pernah diatur
    if ( empty( $logo_url ) && has_custom_logo() ) {
        $logo_id  = (int) get_theme_mod( 'custom_logo' );
        $logo_src = wp_get_attachment_image_src( $logo_id, 'full' );
        if ( $logo_src ) {
            $logo_url = $logo_src[0];
        }
    }

    // Fallback default jika masih kosong: gunakan logo-new-1.png dari tema
    if ( empty( $logo_url ) && file_exists( WAKALUMI_DIR . '/assets/img/logo-new-1.png' ) ) {
        $logo_url = WAKALUMI_URI . '/assets/img/logo-new-1.png';
    }

    // Fallback Favicon jika belum diisi: cek core WordPress site_icon
    if ( empty( $favicon_url ) && function_exists( 'has_site_icon' ) && has_site_icon() ) {
        $favicon_url = get_site_icon_url();
        $favicon_id  = (int) get_option( 'site_icon', 0 );
    }

    // Fallback default favicon jika masih kosong: gunakan logo-new-1.png dari tema
    if ( empty( $favicon_url ) && file_exists( WAKALUMI_DIR . '/assets/img/logo-new-1.png' ) ) {
        $favicon_url = WAKALUMI_URI . '/assets/img/logo-new-1.png';
    }

    if ( empty( $name ) ) {
        $name = get_bloginfo( 'name' ) ?: 'Bank Syariah Wakalumi';
    }

    return [
        'logo_url'      => $logo_url,
        'logo_id'       => $logo_id,
        'logo_dark_url' => $logo_dark_url,
        'logo_dark_id'  => $logo_dark_id,
        'favicon_url'   => $favicon_url,
        'favicon_id'    => $favicon_id,
        'name'          => $name,
        'tagline'       => $tagline,
        'display_mode'  => in_array( $display_mode, [ 'both', 'logo_only', 'text_only' ], true ) ? $display_mode : 'both',
        'logo_height'   => max( 24, min( 70, $logo_height ) ),
    ];
}

/**
 * Output Fallback Favicon di <head> jika WordPress core site_icon belum terkonfigurasi
 */
function wakalumi_render_custom_favicon() {
    // Jika core WordPress site_icon sudah aktif, wp_site_icon() otomatis mengurusnya
    if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
        return;
    }

    $brand = wakalumi_get_brand_identity();
    if ( ! empty( $brand['favicon_url'] ) ) {
        echo '<link rel="icon" href="' . esc_url( $brand['favicon_url'] ) . '" sizes="any" />' . "\n";
        echo '<link rel="apple-touch-icon" href="' . esc_url( $brand['favicon_url'] ) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'wakalumi_render_custom_favicon', 98 );


