<?php
/**
 * Admin Page: Pengelolaan Berita & Artikel Mandiri (Custom CMS BPRS Wakalumi)
 * Submenu of wakalumi-settings
 *
 * Mengelola seluruh siklus publikasi berita secara mandiri tanpa menggunakan tampilan bawaan WordPress:
 * 1. CRUD Berita: Tulis Baru, Edit dengan Visual Editor (wp_editor), Upload Foto Sampul, Hapus
 * 2. Banner Hero & Kartu Spotlight Media Center (archive-berita.php)
 * 3. Banner CTA Bawah Terpusat (Centered CTA sesuai standar seragam Wakalumi)
 * 4. Pengaturan Fitur & Tampilan (Headline, Reading Time, Share Buttons, Posts per Page)
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ── 1. HELPER CONFIG & DATA RETRIEVAL ────────────────────────────────

if ( ! function_exists( 'wakalumi_get_berita_header' ) ) {
    /**
     * Mengambil konfigurasi header & hero banner untuk portal berita.
     *
     * @return array
     */
    function wakalumi_get_berita_header() {
        return [
            'badge'            => get_option( 'options_berita_badge', 'Warta & Publikasi Syariah' ),
            'title'            => get_option( 'options_berita_title', 'Berita, Artikel & Kabar Terkini' ),
            'desc'             => get_option( 'options_berita_desc', 'Informasi terkini seputar perkembangan BPRS Wakalumi, literasi keuangan syariah, kegiatan sosial kemasyarakatan, serta warta perbankan amanah untuk umat.' ),
            'card_badge'       => get_option( 'options_berita_card_badge', 'Media Center' ),
            'card_title'       => get_option( 'options_berita_card_title', 'Pusat Siaran Pers & Edukasi' ),
            'card_desc'        => get_option( 'options_berita_card_desc', 'Kanal resmi komunikasi publik dan publikasi artikel edukatif muamalah yang kredibel, akuntabel, dan berizin resmi OJK.' ),
            'card_highlight_1' => get_option( 'options_berita_card_hl_1', 'Liputan Resmi Bank' ),
            'card_highlight_2' => get_option( 'options_berita_card_hl_2', 'Edukasi Syariah & Muamalah' ),
            'card_highlight_3' => get_option( 'options_berita_card_hl_3', 'Siaran Pers Terverifikasi' ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_berita_cta' ) ) {
    /**
     * Mengambil konfigurasi Banner CTA Bawah Terpusat (Centered CTA seragam standar Wakalumi).
     *
     * @return array
     */
    function wakalumi_get_berita_cta() {
        $default_wa = get_option( 'options_contact_wa', '6281517380388' );
        $wa_clean   = preg_replace( '/[^0-9]/', '', (string) $default_wa );
        $wa_url     = 'https://wa.me/' . ( $wa_clean ?: '6281517380388' );

        return [
            'badge'     => get_option( 'options_berita_cta_badge', 'Solusi Finansial Berkah' ),
            'title'     => get_option( 'options_berita_cta_title', 'Wujudkan Rencana Keuangan Syariah Bersama BPRS Wakalumi' ),
            'desc'      => get_option( 'options_berita_cta_desc', 'Konsultasikan kebutuhan simpanan berkah bebas riba atau ajukan pembiayaan usaha syariah Anda dengan proses amanah, transparan, dan berizin resmi OJK.' ),
            'btn1_text' => get_option( 'options_berita_cta_btn1_text', 'Konsultasi via WhatsApp' ),
            'btn1_url'  => get_option( 'options_berita_cta_btn1_url', $wa_url ),
            'btn2_text' => get_option( 'options_berita_cta_btn2_text', 'Jelajahi Produk Simpanan' ),
            'btn2_url'  => get_option( 'options_berita_cta_btn2_url', home_url( '/produk/tabungan-syariah/' ) ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_berita_settings' ) ) {
    /**
     * Mengambil pengaturan fitur dan tampilan artikel berita.
     *
     * @return array
     */
    function wakalumi_get_berita_settings() {
        return [
            'posts_per_page'      => (int) get_option( 'options_berita_posts_per_page', 9 ),
            'show_reading_time'   => get_option( 'options_berita_show_reading_time', '1' ) === '1',
            'show_share_buttons'  => get_option( 'options_berita_show_share_buttons', '1' ) === '1',
            'show_headline'       => get_option( 'options_berita_show_headline', '1' ) === '1',
        ];
    }
}

if ( ! function_exists( 'wakalumi_calculate_reading_time' ) ) {
    /**
     * Menghitung perkiraan waktu baca artikel dalam menit.
     *
     * @param string $content Isi konten artikel.
     * @param int    $wpm     Kecepatan baca rata-rata kata per menit (standar: 200).
     * @return string
     */
    function wakalumi_calculate_reading_time( $content = '', $wpm = 200 ) {
        $clean_content = strip_tags( (string) $content );
        $word_count    = str_word_count( $clean_content );
        $minutes       = max( 1, (int) ceil( $word_count / $wpm ) );
        return $minutes . ' mnt baca';
    }
}


// ── 2. MENU REGISTRATION & ASSETS ───────────────────────────────────

add_action( 'admin_menu', 'wakalumi_register_berita_admin_page', 26 );
function wakalumi_register_berita_admin_page() {
    // 1. Top-Level Sidebar Menu: Berita & Artikel (Menggantikan antarmuka default WordPress)
    add_menu_page(
        'Kelola Berita & Artikel',
        'Berita & Artikel',
        'manage_options',
        'wakalumi-berita',
        'wakalumi_render_berita_admin_page',
        'dashicons-megaphone',
        5
    );

    // Submenu: Semua Berita (Tab 1: List)
    add_submenu_page(
        'wakalumi-berita',
        'Daftar Berita & Artikel',
        'Semua Berita',
        'manage_options',
        'wakalumi-berita',
        'wakalumi_render_berita_admin_page'
    );

    // Submenu: Tambah Berita Baru (Tab 2: Form Tulis Baru)
    add_submenu_page(
        'wakalumi-berita',
        'Tulis Berita Baru',
        'Tambah Berita',
        'manage_options',
        'wakalumi-berita-new',
        'wakalumi_admin_redirect_to_new_berita'
    );

    // Submenu: Pengaturan Portal (Tab 3: Hero & Centered CTA)
    add_submenu_page(
        'wakalumi-berita',
        'Pengaturan Banner & CTA',
        'Pengaturan Portal',
        'manage_options',
        'wakalumi-berita-settings',
        'wakalumi_admin_redirect_to_settings_berita'
    );

    // 2. Juga didaftarkan di dalam Pengaturan Website (wakalumi-settings) demi konsistensi arsitektur
    add_submenu_page(
        'wakalumi-settings',
        'Warta: Berita & Artikel',
        'Warta: Berita & Artikel',
        'manage_options',
        'wakalumi-berita-portal',
        'wakalumi_admin_redirect_to_berita_main'
    );
}

function wakalumi_admin_redirect_to_new_berita() {
    echo '<script>window.location.replace("' . esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=new' ) ) . '");</script>';
    exit;
}

function wakalumi_admin_redirect_to_settings_berita() {
    echo '<script>window.location.replace("' . esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=settings' ) ) . '");</script>';
    exit;
}

function wakalumi_admin_redirect_to_berita_main() {
    echo '<script>window.location.replace("' . esc_url( admin_url( 'admin.php?page=wakalumi-berita' ) ) . '");</script>';
    exit;
}

// Cegah akses ke antarmuka bawaan WordPress (post-new.php, edit.php, post.php) & alihkan ke custom admin
add_action( 'current_screen', 'wakalumi_berita_prevent_default_wp_screens' );
function wakalumi_berita_prevent_default_wp_screens( $screen ) {
    if ( ! is_admin() || ! $screen ) {
        return;
    }

    if ( isset( $screen->post_type ) && $screen->post_type === 'berita' ) {
        if ( $screen->base === 'post' && isset( $_GET['action'] ) && $_GET['action'] === 'edit' && ! empty( $_GET['post'] ) ) {
            $post_id = (int) $_GET['post'];
            wp_safe_redirect( admin_url( 'admin.php?page=wakalumi-berita&action=edit&post_id=' . $post_id ) );
            exit;
        } elseif ( $screen->base === 'post' ) {
            wp_safe_redirect( admin_url( 'admin.php?page=wakalumi-berita&tab=new' ) );
            exit;
        } elseif ( $screen->base === 'edit' ) {
            wp_safe_redirect( admin_url( 'admin.php?page=wakalumi-berita&tab=list' ) );
            exit;
        }
    }
}

// Arahkan tombol edit di frontend toolbar / admin bar ke custom editor Wakalumi
add_filter( 'get_edit_post_link', 'wakalumi_berita_custom_edit_link', 10, 3 );
function wakalumi_berita_custom_edit_link( $link, $post_id, $context ) {
    $post = get_post( $post_id );
    if ( $post && $post->post_type === 'berita' ) {
        return admin_url( 'admin.php?page=wakalumi-berita&action=edit&post_id=' . $post_id );
    }
    return $link;
}

add_action( 'admin_enqueue_scripts', 'wakalumi_berita_admin_assets' );
function wakalumi_berita_admin_assets( $hook ) {
    if ( strpos( $hook, 'wakalumi-berita' ) !== false ) {
        wp_enqueue_media();
    }
}


// ── 3. RENDER ADMIN INTERFACE & CRUD CONTROLLER ─────────────────────

function wakalumi_render_berita_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Akses ditolak.' );
    }

    $notice = '';

    // ACTION: Hapus Berita
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'delete' && isset( $_GET['post_id'] ) ) {
        $delete_id = (int) $_GET['post_id'];
        if ( check_admin_referer( 'wakalumi_delete_berita_' . $delete_id ) ) {
            wp_delete_post( $delete_id, true );
            $notice = '<div class="notice notice-success is-dismissible" style="border-left-color: #088395;"><p><strong>🗑️ Berita berhasil dihapus secara permanen!</strong></p></div>';
        }
    }

    // ACTION: Simpan Berita Tunggal (Tulis Baru / Update)
    if ( isset( $_POST['wakalumi_save_single_berita'] ) && check_admin_referer( 'wakalumi_single_berita_action', 'wakalumi_single_berita_nonce' ) ) {
        $post_id       = (int) ( $_POST['berita_post_id'] ?? 0 );
        $judul         = sanitize_text_field( $_POST['berita_judul'] ?? '' );
        $kategori      = sanitize_text_field( $_POST['berita_kategori'] ?? '' );
        $kategori_baru = sanitize_text_field( $_POST['berita_kategori_baru'] ?? '' );
        $tanggal       = sanitize_text_field( $_POST['berita_tanggal'] ?? date( 'Y-m-d' ) );
        $penulis       = sanitize_text_field( $_POST['berita_penulis'] ?? 'Redaksi BPRS Wakalumi' );
        $ringkasan     = sanitize_textarea_field( $_POST['berita_ringkasan'] ?? '' );
        $isi_lengkap   = wp_kses_post( $_POST['berita_isi_lengkap'] ?? '' );
        $status        = in_array( $_POST['berita_status'] ?? 'publish', [ 'publish', 'draft' ], true ) ? $_POST['berita_status'] : 'publish';
        $is_headline   = isset( $_POST['berita_is_headline'] ) ? '1' : '0';
        $thumbnail_id  = (int) ( $_POST['berita_thumbnail_id'] ?? 0 );
        $thumbnail_url = esc_url_raw( $_POST['berita_thumbnail_url'] ?? '' );
        $foto_caption  = sanitize_text_field( $_POST['berita_foto_caption'] ?? '' );

        // Sumber Berita Eksternal / Embed Luar
        $is_external     = isset( $_POST['berita_is_external'] ) ? '1' : '0';
        $external_source = sanitize_text_field( $_POST['berita_external_source'] ?? '' );
        $external_url    = esc_url_raw( $_POST['berita_external_url'] ?? '' );
        $external_mode   = in_array( $_POST['berita_external_mode'] ?? 'direct', [ 'direct', 'curated' ], true ) ? $_POST['berita_external_mode'] : 'direct';

        // Jika ada input kategori baru, prioritaskan
        $final_cat = ! empty( $kategori_baru ) ? $kategori_baru : $kategori;

        if ( ! empty( $judul ) ) {
            $post_data = [
                'post_title'   => $judul,
                'post_content' => $isi_lengkap,
                'post_excerpt' => $ringkasan,
                'post_status'  => $status,
                'post_type'    => 'berita',
                'post_date'    => $tanggal . ' ' . current_time( 'H:i:s' ),
            ];

            if ( $post_id > 0 ) {
                $post_data['ID'] = $post_id;
                wp_update_post( $post_data );
                $saved_id = $post_id;
            } else {
                $saved_id = wp_insert_post( $post_data );
            }

            if ( $saved_id && ! is_wp_error( $saved_id ) ) {
                // Update Thumbnail
                if ( $thumbnail_id > 0 ) {
                    set_post_thumbnail( $saved_id, $thumbnail_id );
                    if ( ! empty( $foto_caption ) ) {
                        wp_update_post( [
                            'ID'           => $thumbnail_id,
                            'post_excerpt' => $foto_caption,
                        ] );
                    }
                } elseif ( empty( $thumbnail_url ) ) {
                    delete_post_thumbnail( $saved_id );
                }

                if ( ! empty( $thumbnail_url ) ) {
                    update_post_meta( $saved_id, '_custom_thumbnail_url', $thumbnail_url );
                } else {
                    delete_post_meta( $saved_id, '_custom_thumbnail_url' );
                }

                // Update Category
                if ( ! empty( $final_cat ) ) {
                    wp_set_object_terms( $saved_id, [ $final_cat ], 'kategori_berita' );
                }

                // Update Meta & ACF fields
                update_post_meta( $saved_id, 'berita_ringkasan', $ringkasan );
                update_post_meta( $saved_id, 'berita_penulis', $penulis );

                if ( $is_headline === '1' ) {
                    // Reset post berita lain agar hanya 1 berita yang aktif sebagai sorotan utama
                    $prev_headlines = get_posts( [
                        'post_type'      => 'berita',
                        'post_status'    => 'any',
                        'numberposts'    => -1,
                        'exclude'        => [ $saved_id ],
                        'meta_key'       => 'berita_is_headline',
                        'meta_value'     => '1',
                        'fields'         => 'ids',
                    ] );
                    foreach ( $prev_headlines as $ph_id ) {
                        update_post_meta( $ph_id, 'berita_is_headline', '0' );
                    }
                }
                update_post_meta( $saved_id, 'berita_is_headline', $is_headline );
                update_post_meta( $saved_id, 'berita_foto_caption', $foto_caption );

                // Simpan Meta Sumber Eksternal
                update_post_meta( $saved_id, 'berita_is_external', $is_external );
                update_post_meta( $saved_id, 'berita_external_source', $external_source );
                update_post_meta( $saved_id, 'berita_external_url', $external_url );
                update_post_meta( $saved_id, 'berita_external_mode', $external_mode );

                $notice = '<div class="notice notice-success is-dismissible" style="border-left-color: #088395;"><p><strong>✅ Berita "' . esc_html( $judul ) . '" berhasil disimpan!</strong></p></div>';
            }
        }
    }

    // ACTION: Simpan Pengaturan Header & Centered CTA
    if ( isset( $_POST['wakalumi_save_berita_settings'] ) && check_admin_referer( 'wakalumi_berita_action', 'wakalumi_berita_nonce' ) ) {
        // 1. Header & Hero Options
        update_option( 'options_berita_badge', sanitize_text_field( $_POST['options_berita_badge'] ?? '' ) );
        update_option( 'options_berita_title', sanitize_text_field( $_POST['options_berita_title'] ?? '' ) );
        update_option( 'options_berita_desc', sanitize_textarea_field( $_POST['options_berita_desc'] ?? '' ) );
        update_option( 'options_berita_card_badge', sanitize_text_field( $_POST['options_berita_card_badge'] ?? '' ) );
        update_option( 'options_berita_card_title', sanitize_text_field( $_POST['options_berita_card_title'] ?? '' ) );
        update_option( 'options_berita_card_desc', sanitize_textarea_field( $_POST['options_berita_card_desc'] ?? '' ) );
        update_option( 'options_berita_card_hl_1', sanitize_text_field( $_POST['options_berita_card_hl_1'] ?? '' ) );
        update_option( 'options_berita_card_hl_2', sanitize_text_field( $_POST['options_berita_card_hl_2'] ?? '' ) );
        update_option( 'options_berita_card_hl_3', sanitize_text_field( $_POST['options_berita_card_hl_3'] ?? '' ) );

        // 2. Centered Standard Wakalumi CTA Options
        update_option( 'options_berita_cta_badge', sanitize_text_field( $_POST['options_berita_cta_badge'] ?? '' ) );
        update_option( 'options_berita_cta_title', sanitize_text_field( $_POST['options_berita_cta_title'] ?? '' ) );
        update_option( 'options_berita_cta_desc', sanitize_textarea_field( $_POST['options_berita_cta_desc'] ?? '' ) );
        update_option( 'options_berita_cta_btn1_text', sanitize_text_field( $_POST['options_berita_cta_btn1_text'] ?? '' ) );
        update_option( 'options_berita_cta_btn1_url', esc_url_raw( $_POST['options_berita_cta_btn1_url'] ?? '' ) );
        update_option( 'options_berita_cta_btn2_text', sanitize_text_field( $_POST['options_berita_cta_btn2_text'] ?? '' ) );
        update_option( 'options_berita_cta_btn2_url', esc_url_raw( $_POST['options_berita_cta_btn2_url'] ?? '' ) );

        // 3. Fitur & Tampilan
        update_option( 'options_berita_posts_per_page', max( 3, min( 30, (int) ( $_POST['options_berita_posts_per_page'] ?? 9 ) ) ) );
        update_option( 'options_berita_show_reading_time', isset( $_POST['options_berita_show_reading_time'] ) ? '1' : '0' );
        update_option( 'options_berita_show_share_buttons', isset( $_POST['options_berita_show_share_buttons'] ) ? '1' : '0' );
        update_option( 'options_berita_show_headline', isset( $_POST['options_berita_show_headline'] ) ? '1' : '0' );

        $notice = '<div class="notice notice-success is-dismissible" style="border-left-color: #088395;"><p><strong>✅ Pengaturan Banner Hero &amp; CTA Bawah Berhasil Disimpan!</strong></p></div>';
    }

    // Determine Active Tab
    $tab = sanitize_key( $_GET['tab'] ?? 'list' );
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'edit' ) {
        $tab = 'edit';
    }

    // Load Data
    $header   = wakalumi_get_berita_header();
    $cta      = wakalumi_get_berita_cta();
    $settings = wakalumi_get_berita_settings();

    // Query All Existing Berita for the List view
    $all_berita_query = new WP_Query( [
        'post_type'      => 'berita',
        'posts_per_page' => -1,
        'post_status'    => [ 'publish', 'draft' ],
        'orderby'        => 'date',
        'order'          => 'DESC',
    ] );

    // If Editing an Article, load its data
    $edit_post = null;
    $edit_id   = 0;
    if ( ( $tab === 'edit' || ( isset( $_GET['action'] ) && $_GET['action'] === 'edit' ) ) && isset( $_GET['post_id'] ) ) {
        $edit_id   = (int) $_GET['post_id'];
        $edit_post = get_post( $edit_id );
    }

    // Terms for Category Dropdown
    $existing_terms = get_terms( [
        'taxonomy'   => 'kategori_berita',
        'hide_empty' => false,
    ] );
    ?>

    <div class="wrap" style="max-width: 1080px; margin-top: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
        
        <!-- Header Banner -->
        <div style="background: linear-gradient(135deg, #088395 0%, #0A4D68 100%); color: #fff; padding: 22px 28px; border-radius: 14px; margin-bottom: 22px; box-shadow: 0 4px 16px rgba(8, 131, 149, 0.25); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
            <div>
                <h1 style="color: #fff; margin: 0; font-size: 23px; font-weight: 800; display: flex; align-items: center; gap: 10px;">
                    📰 Pengelolaan Berita &amp; Artikel
                </h1>
                <p style="margin: 6px 0 0; color: #EBF4F6; font-size: 13px;">
                    Pusat pembuatan warta, publikasi artikel edukasi syariah, serta konfigurasi hero dan CTA seragam BPRS Wakalumi.
                </p>
            </div>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=new' ) ); ?>" class="button" style="background: #fff; color: #088395; font-weight: 700; border: none; padding: 4px 15px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    ✍️ + Tulis Berita Baru
                </a>
                <a href="<?php echo esc_url( home_url( '/berita/' ) ); ?>" target="_blank" class="button" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.4); font-weight: 600; padding: 4px 12px; border-radius: 6px;">
                    🌐 Lihat di Web ↗
                </a>
            </div>
        </div>

        <?php echo $notice; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

        <!-- Navigation Tabs -->
        <h2 class="nav-tab-wrapper" style="margin-bottom: 20px; border-bottom: 2px solid #cbd5e1;">
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=list' ) ); ?>" class="nav-tab <?php echo ( $tab === 'list' ) ? 'nav-tab-active' : ''; ?>" style="font-weight: 700;">
                📋 Daftar Semua Berita (<?php echo esc_html( $all_berita_query->found_posts ); ?>)
            </a>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=new' ) ); ?>" class="nav-tab <?php echo ( $tab === 'new' || $tab === 'edit' ) ? 'nav-tab-active' : ''; ?>" style="font-weight: 700;">
                <?php echo ( $tab === 'edit' ) ? '✏️ Edit Berita: #' . esc_html( $edit_id ) : '✍️ Tulis Berita Baru'; ?>
            </a>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=settings' ) ); ?>" class="nav-tab <?php echo ( $tab === 'settings' ) ? 'nav-tab-active' : ''; ?>" style="font-weight: 700;">
                ⚙️ Pengaturan Hero &amp; CTA Seragam
            </a>
        </h2>


        <!-- ==============================================================
             TAB 1: DAFTAR SEMUA BERITA
             ============================================================== -->
        <?php if ( $tab === 'list' ) : ?>
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #1e293b;">
                        Arsip Berita &amp; Artikel Terpublikasi
                    </h3>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=new' ) ); ?>" class="button button-primary" style="background: #088395; border-color: #066e7d; font-weight: 700;">
                        + Buat Berita Baru
                    </a>
                </div>

                <?php if ( $all_berita_query->have_posts() ) : ?>
                    <table class="wp-list-table widefat fixed striped table-view-list" style="border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="width: 70px; text-align: center; font-weight: 700;">Foto</th>
                                <th style="font-weight: 700;">Judul Berita &amp; Ringkasan</th>
                                <th style="width: 140px; font-weight: 700;">Kategori</th>
                                <th style="width: 130px; font-weight: 700;">Penulis</th>
                                <th style="width: 110px; font-weight: 700;">Tanggal</th>
                                <th style="width: 90px; text-align: center; font-weight: 700;">Status</th>
                                <th style="width: 130px; text-align: center; font-weight: 700;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            while ( $all_berita_query->have_posts() ) : $all_berita_query->the_post();
                                $item_id       = get_the_ID();
                                $item_cats     = get_the_terms( $item_id, 'kategori_berita' );
                                $cat_name      = ( $item_cats && ! is_wp_error( $item_cats ) ) ? $item_cats[0]->name : 'Umum';
                                $item_penulis  = get_post_meta( $item_id, 'berita_penulis', true ) ?: ( function_exists( 'get_field' ) ? get_field( 'berita_penulis', $item_id ) : '' ) ?: 'Redaksi Wakalumi';
                                $item_headline = get_post_meta( $item_id, 'berita_is_headline', true );
                                $item_status   = get_post_status( $item_id );
                                $thumb_url     = get_the_post_thumbnail_url( $item_id, 'thumbnail' ) ?: get_post_meta( $item_id, '_custom_thumbnail_url', true );
                                $delete_nonce  = wp_create_nonce( 'wakalumi_delete_berita_' . $item_id );

                                // External metadata
                                $item_is_ext   = get_post_meta( $item_id, 'berita_is_external', true ) === '1' || ! empty( get_post_meta( $item_id, 'berita_external_url', true ) );
                                $item_ext_src  = get_post_meta( $item_id, 'berita_external_source', true );
                                $item_ext_url  = get_post_meta( $item_id, 'berita_external_url', true );
                                $item_ext_mode = get_post_meta( $item_id, 'berita_external_mode', true ) ?: 'direct';
                                $item_view_url = ( $item_is_ext && $item_ext_mode === 'direct' && ! empty( $item_ext_url ) ) ? $item_ext_url : get_permalink( $item_id );
                                ?>
                                <tr>
                                    <!-- Foto Thumbnail -->
                                    <td style="text-align: center; vertical-align: middle;">
                                        <?php if ( ! empty( $thumb_url ) ) : ?>
                                            <img src="<?php echo esc_url( $thumb_url ); ?>" alt="" style="width: 52px; height: 38px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                                        <?php else : ?>
                                            <div style="width: 52px; height: 38px; background: #e2e8f0; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; font-size: 18px; color: #94a3b8;">
                                                📷
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Judul & Ringkasan -->
                                    <td style="vertical-align: middle;">
                                        <div style="font-weight: 700; font-size: 14px; color: #0f172a; margin-bottom: 3px; display: flex; align-items: center; flex-wrap: wrap; gap: 6px;">
                                            <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=edit&post_id=' . $item_id ) ); ?>" style="color: #088395; text-decoration: none;">
                                                <?php the_title(); ?>
                                            </a>
                                            <?php if ( $item_headline === '1' ) : ?>
                                                <span style="background: #fef3c7; color: #92400e; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 9999px; border: 1px solid #fde68a;">
                                                    ⭐ HEADLINE
                                                </span>
                                            <?php endif; ?>
                                            <?php if ( $item_is_ext ) : ?>
                                                <span style="background: #e0f2fe; color: #0284c7; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 9999px; border: 1px solid #bae6fd;">
                                                    🌐 <?php echo esc_html( $item_ext_src ?: 'Eksternal' ); ?> (<?php echo $item_ext_mode === 'direct' ? 'Link Luar ↗' : 'Cuplikan'; ?>)
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div style="font-size: 12px; color: #64748b; line-height: 1.4; max-width: 450px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?>
                                        </div>
                                    </td>

                                    <!-- Kategori -->
                                    <td style="vertical-align: middle;">
                                        <span style="background: #f0fdfa; color: #0d9488; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 6px; border: 1px solid #ccfbf1;">
                                            <?php echo esc_html( $cat_name ); ?>
                                        </span>
                                    </td>

                                    <!-- Penulis -->
                                    <td style="vertical-align: middle; font-size: 12px; color: #475569;">
                                        <?php echo esc_html( $item_penulis ); ?>
                                    </td>

                                    <!-- Tanggal -->
                                    <td style="vertical-align: middle; font-size: 12px; color: #64748b;">
                                        <?php echo get_the_date( 'd M Y' ); ?>
                                    </td>

                                    <!-- Status -->
                                    <td style="text-align: center; vertical-align: middle;">
                                        <?php if ( $item_status === 'publish' ) : ?>
                                            <span style="background: #ecfdf5; color: #059669; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 9999px;">Terbit</span>
                                        <?php else : ?>
                                            <span style="background: #f1f5f9; color: #64748b; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 9999px;">Draf</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Aksi -->
                                    <td style="text-align: center; vertical-align: middle;">
                                        <div style="display: flex; gap: 4px; justify-content: center;">
                                            <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=edit&post_id=' . $item_id ) ); ?>" class="button button-small" title="Edit Berita">
                                                ✏️ Edit
                                            </a>
                                            <a href="<?php echo esc_url( $item_view_url ); ?>" target="_blank" class="button button-small" title="<?php echo $item_is_ext && $item_ext_mode === 'direct' ? 'Buka Link Eksternal' : 'Lihat di Web'; ?>">
                                                🌐
                                            </a>
                                            <a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=wakalumi-berita&action=delete&post_id=' . $item_id ), 'wakalumi_delete_berita_' . $item_id ) ); ?>" 
                                               class="button button-small" 
                                               style="color: #ef4444; border-color: #fca5a5;" 
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini secara permanen?');"
                                               title="Hapus Berita">
                                                🗑️
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div style="text-align: center; padding: 50px 20px; background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 10px;">
                        <span style="font-size: 40px; display: block; margin-bottom: 12px;">📰</span>
                        <h4 style="margin: 0 0 6px; font-size: 16px; color: #1e293b; font-weight: 700;">Belum Ada Berita yang Dibuat</h4>
                        <p style="margin: 0 0 16px; color: #64748b; font-size: 13px;">Mulai publikasikan warta kegiatan, edukasi syariah, atau rilis pers resmi BPRS Wakalumi.</p>
                        <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=new' ) ); ?>" class="button button-primary" style="background: #088395; border-color: #066e7d; font-weight: 700; padding: 4px 18px;">
                            + Buat Berita Pertama Sekarang
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>


        <!-- ==============================================================
             TAB 2: FORM TULIS / EDIT BERITA MANDIRI
             ============================================================== -->
        <?php if ( $tab === 'new' || $tab === 'edit' ) : 
            $form_id        = $edit_post ? $edit_post->ID : 0;
            $form_title     = $edit_post ? $edit_post->post_title : '';
            $form_content   = $edit_post ? $edit_post->post_content : '';
            $form_excerpt   = $edit_post ? ( get_post_meta( $edit_post->ID, 'berita_ringkasan', true ) ?: ( function_exists( 'get_field' ) ? get_field( 'berita_ringkasan', $edit_post->ID ) : '' ) ?: $edit_post->post_excerpt ) : '';
            $form_penulis   = $edit_post ? ( get_post_meta( $edit_post->ID, 'berita_penulis', true ) ?: ( function_exists( 'get_field' ) ? get_field( 'berita_penulis', $edit_post->ID ) : '' ) ?: 'Redaksi BPRS Wakalumi' ) : 'Redaksi BPRS Wakalumi';
            $form_headline  = $edit_post ? ( get_post_meta( $edit_post->ID, 'berita_is_headline', true ) === '1' ) : false;
            $form_status    = $edit_post ? $edit_post->post_status : 'publish';
            $form_date      = $edit_post ? get_the_date( 'Y-m-d', $edit_post->ID ) : date( 'Y-m-d' );
            $form_thumb_id  = $edit_post ? get_post_thumbnail_id( $edit_post->ID ) : 0;
            $form_thumb_url = $edit_post ? ( get_the_post_thumbnail_url( $edit_post->ID, 'large' ) ?: get_post_meta( $edit_post->ID, '_custom_thumbnail_url', true ) ) : '';
            $form_caption   = $edit_post ? get_the_post_thumbnail_caption( $edit_post->ID ) : '';

            $form_cur_terms = $edit_post ? get_the_terms( $edit_post->ID, 'kategori_berita' ) : [];
            $form_cur_cat   = ( $form_cur_terms && ! is_wp_error( $form_cur_terms ) ) ? $form_cur_terms[0]->name : '';

            // External Source Form Data
            $form_is_ext   = $edit_post ? ( get_post_meta( $edit_post->ID, 'berita_is_external', true ) === '1' || ! empty( get_post_meta( $edit_post->ID, 'berita_external_url', true ) ) ) : false;
            $form_ext_src  = $edit_post ? get_post_meta( $edit_post->ID, 'berita_external_source', true ) : '';
            $form_ext_url  = $edit_post ? get_post_meta( $edit_post->ID, 'berita_external_url', true ) : '';
            $form_ext_mode = $edit_post ? ( get_post_meta( $edit_post->ID, 'berita_external_mode', true ) ?: 'direct' ) : 'direct';
            ?>

            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 26px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; padding-bottom: 14px; border-bottom: 2px solid #f1f5f9;">
                    <div>
                        <h3 style="margin: 0; font-size: 17px; font-weight: 800; color: #088395;">
                            <?php echo $edit_post ? '✏️ Edit Berita: ' . esc_html( $form_title ) : '✍️ Tulis Berita &amp; Artikel Baru'; ?>
                        </h3>
                        <p style="margin: 4px 0 0; color: #64748b; font-size: 12px;">
                            Form mandiri terpadu. Berita yang disimpan otomatis muncul di halaman arsip <code>/berita/</code> dan beranda.
                        </p>
                    </div>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=list' ) ); ?>" class="button">
                        &larr; Kembali ke Daftar
                    </a>
                </div>

                <form method="post" action="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=list' ) ); ?>">
                    <?php wp_nonce_field( 'wakalumi_single_berita_action', 'wakalumi_single_berita_nonce' ); ?>
                    <input type="hidden" name="berita_post_id" value="<?php echo esc_attr( $form_id ); ?>">

                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
                        
                        <!-- Kolom Utama (Kiri) -->
                        <div>
                            <!-- Judul Berita -->
                            <div style="margin-bottom: 18px;">
                                <label style="display: block; font-weight: 700; font-size: 13px; margin-bottom: 6px; color: #1e293b;">
                                    Judul Berita / Artikel <span style="color: #ef4444;">*</span>
                                </label>
                                <input type="text" name="berita_judul" value="<?php echo esc_attr( $form_title ); ?>" required placeholder="Contoh: BPRS Wakalumi Selenggarakan Literasi Keuangan Syariah untuk Pelaku UMKM" class="large-text" style="font-size: 16px; font-weight: 700; padding: 10px 14px; border-radius: 8px;">
                            </div>

                            <!-- Ringkasan / Lead Excerpt -->
                            <div style="margin-bottom: 18px;">
                                <label style="display: block; font-weight: 700; font-size: 13px; margin-bottom: 6px; color: #1e293b;">
                                    Ringkasan Singkat (Lead Paragraph)
                                </label>
                                <textarea name="berita_ringkasan" rows="3" class="large-text" placeholder="Tuliskan 1-3 kalimat pengantar artikel untuk kartu cuplikan dan lead paragraf..." style="border-radius: 8px;"><?php echo esc_textarea( $form_excerpt ); ?></textarea>
                            </div>

                            <!-- Isi Lengkap (WP Editor) -->
                            <div style="margin-bottom: 18px;">
                                <label style="display: block; font-weight: 700; font-size: 13px; margin-bottom: 6px; color: #1e293b;">
                                    Isi Lengkap Berita (Visual Editor) <span style="color: #ef4444;">*</span>
                                </label>
                                <?php
                                wp_editor( $form_content, 'berita_isi_lengkap', [
                                    'textarea_name' => 'berita_isi_lengkap',
                                    'textarea_rows' => 14,
                                    'media_buttons' => true,
                                    'teeny'         => false,
                                    'quicktags'     => true,
                                ] );
                                ?>
                            </div>
                        </div>

                        <!-- Kolom Samping (Kanan) -->
                        <div style="display: flex; flex-direction: column; gap: 18px;">
                            
                            <!-- Box 1: Status & Publikasi -->
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px;">
                                <h4 style="margin: 0 0 12px; font-size: 13px; font-weight: 700; color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">
                                    📌 Status &amp; Tanggal
                                </h4>

                                <div style="margin-bottom: 12px;">
                                    <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">Status Publikasi:</label>
                                    <select name="berita_status" style="width: 100%; border-radius: 6px;">
                                        <option value="publish" <?php selected( $form_status, 'publish' ); ?>>Terbit (Publish Langsung)</option>
                                        <option value="draft" <?php selected( $form_status, 'draft' ); ?>>Draf (Simpan Sementara)</option>
                                    </select>
                                </div>

                                <div style="margin-bottom: 12px;">
                                    <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">Tanggal Rilis Berita:</label>
                                    <input type="date" name="berita_tanggal" value="<?php echo esc_attr( $form_date ); ?>" style="width: 100%; border-radius: 6px;">
                                </div>

                                <div style="margin-bottom: 12px;">
                                    <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">Penulis / Redaksi:</label>
                                    <input type="text" name="berita_penulis" value="<?php echo esc_attr( $form_penulis ); ?>" placeholder="Redaksi BPRS Wakalumi" style="width: 100%; border-radius: 6px;">
                                </div>

                                <div style="padding-top: 8px; border-top: 1px solid #e2e8f0;">
                                    <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 700; color: #92400e; cursor: pointer;">
                                        <input type="checkbox" name="berita_is_headline" value="1" <?php checked( $form_headline ); ?>>
                                        <span>⭐ Jadikan Sorotan Utama (Headline)</span>
                                    </label>
                                    <p style="font-size: 11px; color: #64748b; margin: 4px 0 0 24px;">Tampil di kartu besar paling atas halaman berita.</p>
                                </div>
                            </div>

                            <!-- Box 2: Kategori Berita -->
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px;">
                                <h4 style="margin: 0 0 12px; font-size: 13px; font-weight: 700; color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">
                                    🏷️ Kategori Berita
                                </h4>

                                <div style="margin-bottom: 10px;">
                                    <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">Pilih Kategori:</label>
                                    <select name="berita_kategori" style="width: 100%; border-radius: 6px;">
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php if ( ! empty( $existing_terms ) && ! is_wp_error( $existing_terms ) ) : ?>
                                            <?php foreach ( $existing_terms as $term ) : ?>
                                                <option value="<?php echo esc_attr( $term->name ); ?>" <?php selected( $form_cur_cat, $term->name ); ?>>
                                                    <?php echo esc_html( $term->name ); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <option value="Berita Bank" <?php selected( $form_cur_cat, 'Berita Bank' ); ?>>Berita Bank</option>
                                        <option value="Edukasi Syariah" <?php selected( $form_cur_cat, 'Edukasi Syariah' ); ?>>Edukasi Syariah</option>
                                        <option value="Kegiatan &amp; CSR" <?php selected( $form_cur_cat, 'Kegiatan & CSR' ); ?>>Kegiatan &amp; CSR</option>
                                        <option value="Literasi Keuangan" <?php selected( $form_cur_cat, 'Literasi Keuangan' ); ?>>Literasi Keuangan</option>
                                        <option value="Siaran Pers" <?php selected( $form_cur_cat, 'Siaran Pers' ); ?>>Siaran Pers</option>
                                    </select>
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">...atau Tulis Kategori Baru:</label>
                                    <input type="text" name="berita_kategori_baru" placeholder="Contoh: Penghargaan" style="width: 100%; border-radius: 6px;">
                                </div>
                            </div>

                            <!-- Box 3: Foto Sampul (Featured Image) -->
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px;">
                                <h4 style="margin: 0 0 12px; font-size: 13px; font-weight: 700; color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">
                                    📷 Foto Sampul (Thumbnail)
                                </h4>

                                <div style="text-align: center; margin-bottom: 10px;">
                                    <img id="berita_thumb_preview" src="<?php echo esc_url( $form_thumb_url ); ?>" style="max-width: 100%; height: 130px; object-fit: cover; border-radius: 8px; border: 1px solid #cbd5e1; <?php echo empty( $form_thumb_url ) ? 'display:none;' : ''; ?>">
                                    <div id="berita_thumb_placeholder" style="width: 100%; height: 110px; background: #e2e8f0; border-radius: 8px; display: <?php echo empty( $form_thumb_url ) ? 'flex' : 'none'; ?>; align-items: center; justify-content: center; color: #94a3b8; font-size: 12px; border: 2px dashed #cbd5e1;">
                                        Belum ada foto sampul
                                    </div>
                                </div>

                                <div style="display: flex; gap: 6px; margin-bottom: 8px;">
                                    <button type="button" id="btn_upload_berita_thumb" class="button" style="flex: 1; font-weight: 600;">
                                        📷 Pilih / Unggah Foto
                                    </button>
                                    <button type="button" id="btn_remove_berita_thumb" class="button button-link-delete" style="color: #ef4444; <?php echo empty( $form_thumb_url ) ? 'display:none;' : ''; ?>">
                                        Hapus
                                    </button>
                                </div>

                                <input type="hidden" id="berita_thumbnail_id" name="berita_thumbnail_id" value="<?php echo esc_attr( $form_thumb_id ); ?>">
                                <input type="hidden" id="berita_thumbnail_url" name="berita_thumbnail_url" value="<?php echo esc_attr( $form_thumb_url ); ?>">

                                <div style="margin-top: 10px;">
                                    <label style="display: block; font-size: 11px; font-weight: 600; color: #64748b; margin-bottom: 2px;">Keterangan Foto (Caption):</label>
                                    <input type="text" name="berita_foto_caption" value="<?php echo esc_attr( $form_caption ); ?>" placeholder="Contoh: Dok. Humas BPRS Wakalumi" style="width: 100%; font-size: 11px; border-radius: 6px;">
                                </div>
                            </div>

                            <!-- Box 4: Sumber Berita Luar (Eksternal / Liputan Media) -->
                            <div style="background: #f0fdfa; border: 1px solid #99f6e4; border-radius: 10px; padding: 18px;">
                                <h4 style="margin: 0 0 8px; font-size: 13px; font-weight: 700; color: #0f766e; border-bottom: 1px solid #ccfbf1; padding-bottom: 8px; display: flex; align-items: center; gap: 6px;">
                                    <span>🌐</span> Berita Sumber Luar / Liputan Media
                                </h4>
                                <p style="font-size: 11px; color: #115e59; line-height: 1.5; margin: 0 0 12px;">
                                    Gunakan jika artikel ini merupakan rilis atau liputan dari media eksternal (Detik, Kompas, Infobank, OJK, dsb).
                                </p>

                                <div style="margin-bottom: 12px;">
                                    <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 700; color: #134e4a; cursor: pointer;">
                                        <input type="checkbox" id="chk_berita_is_external" name="berita_is_external" value="1" <?php checked( $form_is_ext ); ?>>
                                        <span>Aktifkan Sumber Berita Luar</span>
                                    </label>
                                </div>

                                <div id="box_external_fields" style="display: <?php echo $form_is_ext ? 'block' : 'none'; ?>; padding-top: 12px; border-top: 1px dashed #99f6e4;">
                                    <!-- Nama Media -->
                                    <div style="margin-bottom: 10px;">
                                        <label style="display: block; font-size: 11px; font-weight: 600; color: #334155; margin-bottom: 3px;">
                                            Nama Media / Sumber Penerbit:
                                        </label>
                                        <input type="text" name="berita_external_source" value="<?php echo esc_attr( $form_ext_src ); ?>" placeholder="Contoh: Infobank News, Kompas.com, Bisnis.com" style="width: 100%; border-radius: 6px; font-size: 12px;">
                                    </div>

                                    <!-- URL Berita Asli -->
                                    <div style="margin-bottom: 12px;">
                                        <label style="display: block; font-size: 11px; font-weight: 600; color: #334155; margin-bottom: 3px;">
                                            Tautan / URL Berita Lengkap:
                                        </label>
                                        <input type="url" name="berita_external_url" value="<?php echo esc_attr( $form_ext_url ); ?>" placeholder="https://..." style="width: 100%; border-radius: 6px; font-size: 12px;">
                                    </div>

                                    <!-- Mode Navigasi -->
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 600; color: #334155; margin-bottom: 6px;">
                                            Mode Navigasi Pengunjung:
                                        </label>
                                        <div style="display: flex; flex-direction: column; gap: 8px; font-size: 11px; color: #334155;">
                                            <label style="display: flex; align-items: flex-start; gap: 6px; cursor: pointer; background: #ffffff; padding: 8px 10px; border-radius: 6px; border: 1px solid #ccfbf1;">
                                                <input type="radio" name="berita_external_mode" value="direct" <?php checked( $form_ext_mode, 'direct' ); ?> style="margin-top: 2px;">
                                                <div>
                                                    <strong style="color: #0f766e; display: block;">Alihkan Langsung (Direct Link ↗)</strong>
                                                    <span style="color: #64748b; font-size: 10.5px;">Klik kartu langsung membuka web media luar di tab baru.</span>
                                                </div>
                                            </label>
                                            <label style="display: flex; align-items: flex-start; gap: 6px; cursor: pointer; background: #ffffff; padding: 8px 10px; border-radius: 6px; border: 1px solid #ccfbf1;">
                                                <input type="radio" name="berita_external_mode" value="curated" <?php checked( $form_ext_mode, 'curated' ); ?> style="margin-top: 2px;">
                                                <div>
                                                    <strong style="color: #0f766e; display: block;">Halaman Cuplikan (Curated)</strong>
                                                    <span style="color: #64748b; font-size: 10.5px;">Buka ringkasan di web Wakalumi, ada tombol rujukan ke artikel asli.</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Bottom Submit Bar -->
                    <div style="margin-top: 25px; padding-top: 18px; border-top: 2px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                        <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-berita&tab=list' ) ); ?>" class="button">
                            Batal
                        </a>
                        <input type="submit" name="wakalumi_save_single_berita" class="button button-primary button-large" value="<?php echo $edit_post ? '💾 Perbarui Berita' : '🚀 Publikasikan Berita'; ?>" style="background: #088395; border-color: #066e7d; font-weight: 700; padding: 0 28px; height: 42px; font-size: 14px; box-shadow: 0 2px 4px rgba(8,131,149,0.2);">
                    </div>
                </form>
            </div>
        <?php endif; ?>


        <!-- ==============================================================
             TAB 3: PENGATURAN HERO & CENTERED CTA (SERAGAM STANDAR PROYEK)
             ============================================================== -->
        <?php if ( $tab === 'settings' ) : ?>
            <form method="post" action="">
                <?php wp_nonce_field( 'wakalumi_berita_action', 'wakalumi_berita_nonce' ); ?>

                <!-- SECTION A: HERO HEADER & SPOTLIGHT MEDIA CENTER -->
                <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 22px 24px; margin-bottom: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; padding-bottom: 10px; border-bottom: 2px solid #EBF4F6; display: flex; align-items: center; gap: 8px;">
                        <span>✨</span> Hero Banner &amp; Kartu Media Center (Halaman Depan Berita)
                    </h2>
                    <p style="font-size: 12px; color: #64748b; margin-bottom: 18px;">
                        Konfigurasi teks pada bagian hero header portal berita (<code>/berita/</code>) dan arsip kategori.
                    </p>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <!-- Kiri -->
                        <div style="background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            <h4 style="margin: 0 0 12px; font-size: 13px; font-weight: 700; color: #1e293b;">📌 Bagian Kiri: Judul Utama</h4>
                            
                            <div style="margin-bottom: 12px;">
                                <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Badge Tag (Pill Atas):</label>
                                <input type="text" name="options_berita_badge" value="<?php echo esc_attr( $header['badge'] ); ?>" class="regular-text" style="width: 100%;">
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Judul Utama (H1):</label>
                                <input type="text" name="options_berita_title" value="<?php echo esc_attr( $header['title'] ); ?>" class="regular-text" style="width: 100%;">
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Deskripsi Singkat:</label>
                                <textarea name="options_berita_desc" rows="3" style="width: 100%;"><?php echo esc_textarea( $header['desc'] ); ?></textarea>
                            </div>
                        </div>

                        <!-- Kanan -->
                        <div style="background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                            <h4 style="margin: 0 0 12px; font-size: 13px; font-weight: 700; color: #1e293b;">🛡️ Bagian Kanan: Kartu Spotlight Media Center</h4>
                            
                            <div style="margin-bottom: 12px;">
                                <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Badge Kartu:</label>
                                <input type="text" name="options_berita_card_badge" value="<?php echo esc_attr( $header['card_badge'] ); ?>" class="regular-text" style="width: 100%;">
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Judul Kartu:</label>
                                <input type="text" name="options_berita_card_title" value="<?php echo esc_attr( $header['card_title'] ); ?>" class="regular-text" style="width: 100%;">
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Deskripsi Kartu:</label>
                                <textarea name="options_berita_card_desc" rows="3" style="width: 100%;"><?php echo esc_textarea( $header['card_desc'] ); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Highlight Pills -->
                    <div style="margin-top: 18px; padding-top: 14px; border-top: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: 700; font-size: 12px; margin-bottom: 8px; color: #334155;">🏷️ 3 Poin Kepercayaan / Highlight Pill di Bawah Hero:</label>
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
                            <input type="text" name="options_berita_card_hl_1" value="<?php echo esc_attr( $header['card_highlight_1'] ); ?>" placeholder="Poin 1" style="width: 100%;">
                            <input type="text" name="options_berita_card_hl_2" value="<?php echo esc_attr( $header['card_highlight_2'] ); ?>" placeholder="Poin 2" style="width: 100%;">
                            <input type="text" name="options_berita_card_hl_3" value="<?php echo esc_attr( $header['card_highlight_3'] ); ?>" placeholder="Poin 3" style="width: 100%;">
                        </div>
                    </div>
                </div>

                <!-- SECTION B: BANNER CTA BAWAH TERPUSAT (SERAGAM STANDAR PROYEK WAKALUMI) -->
                <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 22px 24px; margin-bottom: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; padding-bottom: 10px; border-bottom: 2px solid #EBF4F6; display: flex; align-items: center; gap: 8px;">
                        <span>🎯</span> Banner CTA Bawah Terpusat (Standar Seragam Wakalumi)
                    </h2>
                    <p style="font-size: 12px; color: #64748b; margin-bottom: 18px;">
                        Banner ajakan aksi di bawah halaman berita dengan tata letak tengah (centered), emblem watermark meluncur, dan tombol navigasi ke halaman produk/kontak.
                    </p>

                    <div style="background: #f8fafc; padding: 18px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px; margin-bottom: 14px;">
                            <div>
                                <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Badge CTA (Pill):</label>
                                <input type="text" name="options_berita_cta_badge" value="<?php echo esc_attr( $cta['badge'] ); ?>" class="large-text" style="width: 100%;">
                            </div>
                            <div>
                                <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Judul CTA Utama:</label>
                                <input type="text" name="options_berita_cta_title" value="<?php echo esc_attr( $cta['title'] ); ?>" class="large-text" style="width: 100%; font-weight: 700;">
                            </div>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Deskripsi Ajakan CTA:</label>
                            <textarea name="options_berita_cta_desc" rows="3" style="width: 100%;"><?php echo esc_textarea( $cta['desc'] ); ?></textarea>
                        </div>

                        <!-- 2 Action Buttons -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; padding-top: 14px; border-top: 1px solid #e2e8f0;">
                            <!-- Tombol 1 (Kiri): WhatsApp / Konsultasi -->
                            <div style="background: #fff; padding: 14px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                <h5 style="margin: 0 0 10px; font-size: 12px; font-weight: 700; color: #088395;">💬 Tombol 1 (Kiri - WhatsApp):</h5>
                                <div style="margin-bottom: 8px;">
                                    <label style="display: block; font-size: 11px; font-weight: 600; color: #64748b; margin-bottom: 2px;">Teks Tombol 1:</label>
                                    <input type="text" name="options_berita_cta_btn1_text" value="<?php echo esc_attr( $cta['btn1_text'] ); ?>" placeholder="Contoh: Konsultasi via WhatsApp" style="width: 100%;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: 600; color: #64748b; margin-bottom: 2px;">Link / URL Tombol 1:</label>
                                    <input type="text" name="options_berita_cta_btn1_url" value="<?php echo esc_attr( $cta['btn1_url'] ); ?>" placeholder="Contoh: https://wa.me/..." style="width: 100%;">
                                </div>
                            </div>

                            <!-- Tombol 2 (Kanan): Produk / Halaman Internal -->
                            <div style="background: #fff; padding: 14px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                <h5 style="margin: 0 0 10px; font-size: 12px; font-weight: 700; color: #088395;">🔘 Tombol 2 (Kanan - Produk / Link):</h5>
                                <div style="margin-bottom: 8px;">
                                    <label style="display: block; font-size: 11px; font-weight: 600; color: #64748b; margin-bottom: 2px;">Teks Tombol 2:</label>
                                    <input type="text" name="options_berita_cta_btn2_text" value="<?php echo esc_attr( $cta['btn2_text'] ); ?>" placeholder="Contoh: Jelajahi Produk Simpanan" style="width: 100%;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: 600; color: #64748b; margin-bottom: 2px;">Link / URL Tombol 2:</label>
                                    <input type="text" name="options_berita_cta_btn2_url" value="<?php echo esc_attr( $cta['btn2_url'] ); ?>" placeholder="Contoh: /produk/tabungan-syariah/" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION C: FITUR TAMPILAN -->
                <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 22px 24px; margin-bottom: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; padding-bottom: 10px; border-bottom: 2px solid #EBF4F6; display: flex; align-items: center; gap: 8px;">
                        <span>⚙️</span> Opsi Tampilan &amp; Pagination
                    </h2>

                    <table class="form-table" style="margin-top: 0;">
                        <tr>
                            <th scope="row" style="width: 260px; font-size: 13px;">Sorotan Utama (Headline)</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="options_berita_show_headline" value="1" <?php checked( $settings['show_headline'] ); ?>>
                                    Tampilkan kartu horisontal besar untuk berita sorotan utama (headline) di halaman depan berita
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="font-size: 13px;">Estimasi Waktu Baca</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="options_berita_show_reading_time" value="1" <?php checked( $settings['show_reading_time'] ); ?>>
                                    Tampilkan estimasi waktu membaca (misal: <code>⏱️ 3 mnt baca</code>)
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="font-size: 13px;">Tombol Bagikan (Share)</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="options_berita_show_share_buttons" value="1" <?php checked( $settings['show_share_buttons'] ); ?>>
                                    Tampilkan tombol bagikan ke media sosial &amp; salin tautan
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="font-size: 13px;">Jumlah Berita per Halaman</th>
                            <td>
                                <input type="number" name="options_berita_posts_per_page" value="<?php echo esc_attr( $settings['posts_per_page'] ); ?>" min="3" max="30" step="3" style="width: 80px;">
                                <span class="description">Jumlah artikel per halaman sebelum pagination muncul.</span>
                            </td>
                        </tr>
                    </table>
                </div>

                <div style="margin-top: 25px;">
                    <input type="submit" name="wakalumi_save_berita_settings" class="button button-primary button-large" value="💾 Simpan Pengaturan Hero &amp; CTA" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 28px; height: 42px; font-size: 14px; box-shadow: 0 2px 4px rgba(8,131,149,0.2);">
                </div>
            </form>
        <?php endif; ?>

    </div>

    <!-- Script Media Uploader untuk Thumbnail Berita -->
    <script>
    jQuery(document).ready(function($) {
        var mediaFrame;
        $('#btn_upload_berita_thumb').on('click', function(e) {
            e.preventDefault();
            if (mediaFrame) {
                mediaFrame.open();
                return;
            }
            mediaFrame = wp.media({
                title: 'Pilih atau Unggah Foto Sampul Berita',
                button: { text: 'Gunakan Foto Ini' },
                multiple: false,
                library: { type: 'image' }
            });

            mediaFrame.on('select', function() {
                var attachment = mediaFrame.state().get('selection').first().toJSON();
                var url = (attachment.sizes && attachment.sizes.large) ? attachment.sizes.large.url : attachment.url;
                $('#berita_thumbnail_id').val(attachment.id);
                $('#berita_thumbnail_url').val(attachment.url);
                $('#berita_thumb_preview').attr('src', url).show();
                $('#berita_thumb_placeholder').hide();
                $('#btn_remove_berita_thumb').show();
            });

            mediaFrame.open();
        });

        $('#btn_remove_berita_thumb').on('click', function(e) {
            e.preventDefault();
            $('#berita_thumbnail_id').val('');
            $('#berita_thumbnail_url').val('');
            $('#berita_thumb_preview').attr('src', '').hide();
            $('#berita_thumb_placeholder').show();
            $(this).hide();
        });

        // Toggle Sumber Berita Luar
        $('#chk_berita_is_external').on('change', function() {
            if ($(this).is(':checked')) {
                $('#box_external_fields').slideDown(200);
            } else {
                $('#box_external_fields').slideUp(200);
            }
        });
    });
    </script>
    <?php
}
