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

/**
 * Otomatis set halaman 'Home' atau 'Beranda' sebagai Front Page jika belum disetel
 */
function wakalumi_ensure_front_page() {
    if ( get_option( 'show_on_front' ) !== 'page' ) {
        $home_page = get_page_by_path( 'home' ) ?: get_page_by_path( 'beranda' );
        if ( ! $home_page ) {
            $pages = get_posts( [
                'post_type'   => 'page',
                'title'       => 'Home',
                'post_status' => 'publish',
                'numberposts' => 1,
            ] );
            if ( ! empty( $pages ) ) {
                $home_page = $pages[0];
            } else {
                $pages = get_posts( [
                    'post_type'   => 'page',
                    'title'       => 'Beranda',
                    'post_status' => 'publish',
                    'numberposts' => 1,
                ] );
                if ( ! empty( $pages ) ) {
                    $home_page = $pages[0];
                }
            }
        }
        if ( $home_page ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $home_page->ID );
        }
    }
}
add_action( 'init', 'wakalumi_ensure_front_page' );

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
                Dikelola melalui menu <a href="edit.php?post_type=hero_slide" style="font-weight: bold; text-decoration: underline;">Slider Hero</a> di bilah navigasi kiri.
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
                    <td><a href="edit.php?post_type=hero_slide"><strong>🖼️ Slider Hero</strong></a></td>
                    <td>Kelola banner slide di beranda atas (foto latar HD, judul headline besar, sub-judul, dan 2 tombol aksi).</td>
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
        'href'   => admin_url( 'edit.php?post_type=hero_slide' ),
    ] );

    $wp_admin_bar->add_node( [
        'id'     => 'wakalumi_quick_footer',
        'parent' => 'wakalumi_quick_edit',
        'title'  => '🏢 Footer & Jam Kerja',
        'href'   => admin_url( 'admin.php?page=wakalumi-footer' ),
    ] );
}
add_action( 'admin_bar_menu', 'wakalumi_admin_bar_quick_links', 100 );
