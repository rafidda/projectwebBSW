<?php
/**
 * Admin Panel: Beranda - Hero Section & Slider Terpadu
 *
 * Mengelola seluruh aspek Hero Section halaman utama:
 * 1. Slide Banner Carousel (CPT: hero_slide) — Headline, Subheadline, CTA Buttons, Foto Desktop & Mobile, Opacity.
 * 2. Lencana Regulasi & Mitra (Repeater Logo OJK, LPS, BI, dll.)
 * 3. Lencana Penjaminan Simpanan LPS (Rp2 Miliar)
 *
 * 100% Native WordPress Options & CPT tanpa ketergantungan plugin berbayar.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Registrasi Submenu di bawah "Pengaturan Website" (wakalumi-settings)
 */
function wakalumi_register_hero_admin_menu() {
    add_submenu_page(
        'wakalumi-settings',
        'Hero Section & Slider Banner Beranda',
        'Beranda: Hero & Slider',
        'manage_options',
        'wakalumi-hero',
        'wakalumi_render_hero_admin_page',
        1 // Prioritas tinggi agar tampil di posisi teratas submenu Beranda
    );
}
add_action( 'admin_menu', 'wakalumi_register_hero_admin_menu', 11 );

/**
 * Render Halaman Admin Hero & Slider Terpadu
 */
function wakalumi_render_hero_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( esc_html__( 'Anda tidak memiliki izin untuk mengakses halaman ini.', 'wakalumi' ) );
    }

    $current_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'slides';
    $message     = '';

    // ─────────────────────────────────────────────────────────────
    // 1. PROSES SIMPAN DATA (POST HANDLER)
    // ─────────────────────────────────────────────────────────────
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['wakalumi_hero_nonce'] ) ) {
        if ( ! wp_verify_nonce( $_POST['wakalumi_hero_nonce'], 'wakalumi_hero_save_action' ) ) {
            wp_die( esc_html__( 'Sesi keamanan berakhir. Silakan muat ulang halaman.', 'wakalumi' ) );
        }

        $active_tab = isset( $_POST['current_tab'] ) ? sanitize_key( $_POST['current_tab'] ) : 'slides';

        // -------------------------------------------------------------
        // A. SIMPAN TAB 1: SLIDE BANNER
        // -------------------------------------------------------------
        if ( $active_tab === 'slides' ) {
            // Hapus slide yang ditandai untuk dihapus
            if ( ! empty( $_POST['delete_slide_ids'] ) ) {
                $del_ids = array_map( 'intval', explode( ',', $_POST['delete_slide_ids'] ) );
                foreach ( $del_ids as $del_id ) {
                    if ( $del_id > 0 && get_post_type( $del_id ) === 'hero_slide' ) {
                        wp_delete_post( $del_id, true );
                    }
                }
            }

            // Simpan / Perbarui Slide
            $slide_keys = $_POST['slide_key'] ?? [];
            if ( is_array( $slide_keys ) ) {
                $order_index = 0;
                foreach ( $slide_keys as $key ) {
                    $post_id     = isset( $_POST["slide_{$key}_id"] ) ? intval( $_POST["slide_{$key}_id"] ) : 0;
                    $title       = sanitize_text_field( $_POST["slide_{$key}_title"] ?? '' );
                    $subheadline = sanitize_textarea_field( $_POST["slide_{$key}_subheadline"] ?? '' );
                    $cta1_text   = sanitize_text_field( $_POST["slide_{$key}_cta_text"] ?? 'Hubungi Kami' );
                    $cta1_url    = esc_url_raw( trim( $_POST["slide_{$key}_cta_url"] ?? '' ) );
                    $cta2_text   = sanitize_text_field( $_POST["slide_{$key}_cta_text_2"] ?? 'Lihat Produk' );
                    $cta2_url    = esc_url_raw( trim( $_POST["slide_{$key}_cta_url_2"] ?? '' ) );
                    $opacity     = isset( $_POST["slide_{$key}_opacity"] ) ? intval( $_POST["slide_{$key}_opacity"] ) : 60;
                    $status      = sanitize_key( $_POST["slide_{$key}_status"] ?? 'publish' );
                    $img_desk    = esc_url_raw( trim( $_POST["slide_{$key}_img_desk"] ?? '' ) );
                    $id_desk     = isset( $_POST["slide_{$key}_img_desk_id"] ) ? intval( $_POST["slide_{$key}_img_desk_id"] ) : 0;
                    $img_mob     = esc_url_raw( trim( $_POST["slide_{$key}_img_mob"] ?? '' ) );
                    $id_mob      = isset( $_POST["slide_{$key}_img_mob_id"] ) ? intval( $_POST["slide_{$key}_img_mob_id"] ) : 0;

                    // Fallback attachment ID jika ada URL tapi ID kosong
                    if ( ! $id_desk && ! empty( $img_desk ) ) {
                        $id_desk = attachment_url_to_postid( $img_desk );
                    }
                    if ( ! $id_mob && ! empty( $img_mob ) ) {
                        $id_mob = attachment_url_to_postid( $img_mob );
                    }

                    if ( empty( $title ) ) {
                        $title = 'Bank Syariah Wakalumi';
                    }

                    $post_data = [
                        'post_title'  => $title,
                        'post_type'   => 'hero_slide',
                        'post_status' => in_array( $status, [ 'publish', 'draft' ], true ) ? $status : 'publish',
                        'menu_order'  => $order_index,
                    ];

                    if ( $post_id > 0 && get_post_type( $post_id ) === 'hero_slide' ) {
                        $post_data['ID'] = $post_id;
                        wp_update_post( $post_data );
                    } else {
                        $post_id = wp_insert_post( $post_data );
                    }

                    if ( $post_id && ! is_wp_error( $post_id ) ) {
                        update_post_meta( $post_id, 'slide_subheadline', $subheadline );
                        update_post_meta( $post_id, 'slide_cta_text', $cta1_text );
                        update_post_meta( $post_id, 'slide_cta_url', $cta1_url );
                        update_post_meta( $post_id, 'slide_cta_text_2', $cta2_text );
                        update_post_meta( $post_id, 'slide_cta_url_2', $cta2_url );
                        update_post_meta( $post_id, 'slide_overlay_opacity', $opacity );

                        // Simpan Gambar Desktop
                        update_post_meta( $post_id, 'slide_image_desktop', $img_desk );
                        if ( $id_desk > 0 ) {
                            update_post_meta( $post_id, 'slide_image_desktop_id', $id_desk );
                            set_post_thumbnail( $post_id, $id_desk );
                        } else {
                            delete_post_meta( $post_id, 'slide_image_desktop_id' );
                            delete_post_thumbnail( $post_id );
                        }

                        // Simpan Gambar Mobile
                        update_post_meta( $post_id, 'slide_image_mobile', $img_mob );
                        if ( $id_mob > 0 ) {
                            update_post_meta( $post_id, 'slide_image_mobile_id', $id_mob );
                        } else {
                            delete_post_meta( $post_id, 'slide_image_mobile_id' );
                        }
                    }

                    $order_index++;
                }
            }
            $message = '✅ Pengaturan Slide Banner berhasil diperbarui!';
        }

        // -------------------------------------------------------------
        // B. SIMPAN TAB 2: LOGO REGULASI & MITRA
        // -------------------------------------------------------------
        if ( $active_tab === 'logos' ) {
            $hero_reg_desktop    = isset( $_POST['options_hero_reg_desktop'] ) ? '1' : '0';
            $hero_reg_mobile     = isset( $_POST['options_hero_reg_mobile'] ) ? '1' : '0';
            $hero_reg_label      = sanitize_text_field( $_POST['options_hero_reg_label'] ?? '' );
            $hero_reg_label_mob  = isset( $_POST['options_hero_reg_label_mobile'] ) ? '1' : '0';

            update_option( 'options_hero_reg_desktop', $hero_reg_desktop );
            update_option( 'options_hero_reg_mobile', $hero_reg_mobile );
            update_option( 'options_hero_reg_label', $hero_reg_label );
            update_option( 'options_hero_reg_label_mobile', $hero_reg_label_mob );

            // Repeater Logo
            $hero_labels = $_POST['hero_reg_logos_label'] ?? [];
            $hero_urls   = $_POST['hero_reg_logos_url'] ?? [];
            $hero_logos  = [];
            for ( $i = 0; $i < count( $hero_labels ); $i++ ) {
                $label = sanitize_text_field( $hero_labels[$i] ?? '' );
                $url   = esc_url_raw( trim( $hero_urls[$i] ?? '' ) );
                if ( $label || $url ) {
                    $hero_logos[] = [
                        'label' => $label,
                        'url'   => $url,
                    ];
                }
            }
            update_option( 'options_hero_reg_logos', $hero_logos );

            $message = '✅ Pengaturan Logo Regulasi & Mitra berhasil disimpan!';
        }

        // -------------------------------------------------------------
        // C. SIMPAN TAB 3: BADGE JAMINAN LPS
        // -------------------------------------------------------------
        if ( $active_tab === 'lps' ) {
            $lps_badge_active  = isset( $_POST['options_lps_badge_active'] ) ? '1' : '0';
            $lps_badge_logo    = esc_url_raw( trim( $_POST['options_lps_badge_logo'] ?? '' ) );
            $lps_badge_text    = sanitize_text_field( $_POST['options_lps_badge_text'] ?? '' );
            $lps_badge_desktop = isset( $_POST['options_lps_badge_desktop'] ) ? '1' : '0';
            $lps_badge_mobile  = isset( $_POST['options_lps_badge_mobile'] ) ? '1' : '0';

            update_option( 'options_lps_badge_active', $lps_badge_active );
            update_option( 'options_lps_badge_logo', $lps_badge_logo );
            update_option( 'options_lps_badge_text', $lps_badge_text );
            update_option( 'options_lps_badge_desktop', $lps_badge_desktop );
            update_option( 'options_lps_badge_mobile', $lps_badge_mobile );

            $message = '✅ Pengaturan Lencana Jaminan LPS berhasil disimpan!';
        }

        $current_tab = $active_tab;
    }

    // ─────────────────────────────────────────────────────────────
    // 2. QUERY DATA EKSIS
    // ─────────────────────────────────────────────────────────────
    // A. Slides
    $raw_slides = get_posts( [
        'post_type'      => 'hero_slide',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => [ 'publish', 'draft' ],
    ] );

    $slides = [];
    foreach ( $raw_slides as $s ) {
        $sid       = $s->ID;
        $id_desk   = (int) get_post_meta( $sid, 'slide_image_desktop_id', true );
        $img_desk  = get_post_meta( $sid, 'slide_image_desktop', true );
        if ( empty( $img_desk ) && $id_desk > 0 ) {
            $img_desk = wp_get_attachment_image_url( $id_desk, 'full' ) ?: wp_get_attachment_url( $id_desk );
        }
        if ( empty( $img_desk ) && has_post_thumbnail( $sid ) ) {
            $id_desk  = get_post_thumbnail_id( $sid );
            $img_desk = get_the_post_thumbnail_url( $sid, 'full' );
        }

        $id_mob    = (int) get_post_meta( $sid, 'slide_image_mobile_id', true );
        $img_mob   = get_post_meta( $sid, 'slide_image_mobile', true );
        if ( empty( $img_mob ) && $id_mob > 0 ) {
            $img_mob = wp_get_attachment_image_url( $id_mob, 'full' ) ?: wp_get_attachment_url( $id_mob );
        }

        $slides[] = [
            'id'          => $sid,
            'title'       => $s->post_title,
            'status'      => $s->post_status,
            'subheadline' => get_post_meta( $sid, 'slide_subheadline', true ),
            'cta_text'    => get_post_meta( $sid, 'slide_cta_text', true ) ?: 'Hubungi Kami',
            'cta_url'     => get_post_meta( $sid, 'slide_cta_url', true ),
            'cta_text_2'  => get_post_meta( $sid, 'slide_cta_text_2', true ) ?: 'Lihat Produk',
            'cta_url_2'   => get_post_meta( $sid, 'slide_cta_url_2', true ),
            'opacity'     => get_post_meta( $sid, 'slide_overlay_opacity', true ) !== '' ? (int) get_post_meta( $sid, 'slide_overlay_opacity', true ) : 60,
            'id_desk'     => $id_desk,
            'img_desk'    => $img_desk,
            'id_mob'      => $id_mob,
            'img_mob'     => $img_mob,
        ];
    }

    // B. Logos & Badges
    $hero_reg_desk    = get_option( 'options_hero_reg_desktop', '1' );
    $hero_reg_mob     = get_option( 'options_hero_reg_mobile', '1' );
    $hero_reg_lbl     = get_option( 'options_hero_reg_label', 'Terdaftar & Diawasi:' );
    $hero_reg_lbl_mob = get_option( 'options_hero_reg_label_mobile', '0' );

    $hero_logos = get_option( 'options_hero_reg_logos', [] );
    if ( empty( $hero_logos ) ) {
        $old_ojk    = get_option( 'options_logo_ojk_url', get_template_directory_uri() . '/assets/img/ojk-logo.png' );
        $old_lps    = get_option( 'options_logo_lps_url', get_template_directory_uri() . '/assets/img/lps-logo.png' );
        $hero_logos = [
            [ 'label' => 'OJK', 'url' => $old_ojk ],
            [ 'label' => 'LPS', 'url' => $old_lps ],
        ];
    }

    // C. LPS Guarantee Badge
    $lps_badge_active  = get_option( 'options_lps_badge_active', '1' );
    $lps_badge_logo    = get_option( 'options_lps_badge_logo', get_template_directory_uri() . '/assets/img/lps-logo.png' );
    $lps_badge_text    = get_option( 'options_lps_badge_text', 'Simpanan Dijamin LPS sampai dengan Rp2 Miliar per Nasabah per Bank' );
    $lps_badge_desktop = get_option( 'options_lps_badge_desktop', '1' );
    $lps_badge_mobile  = get_option( 'options_lps_badge_mobile', '1' );
    ?>

    <div class="wrap" style="max-width: 1080px; margin-top: 20px;">
        <!-- Header Panel -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span>🖼️</span> Hero Section &amp; Slider Beranda
                </h1>
                <p style="color: #64748b; margin: 5px 0 0 0; font-size: 13px;">
                    Kelola rotasi banner slide utama, lencana jaminan LPS, serta logo regulasi resmi di beranda Bank Syariah Wakalumi.
                </p>
            </div>
            <div>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" class="button" style="display: inline-flex; align-items: center; gap: 6px;">
                    <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px; margin-top: 2px;"></span> Lihat Beranda Live
                </a>
            </div>
        </div>

        <?php if ( $message ) : ?>
            <div class="notice notice-success is-dismissible" style="border-left-color: #088395; padding: 12px 16px; margin: 0 0 20px 0;">
                <p style="font-size: 13px; font-weight: 600; margin: 0;"><?php echo esc_html( $message ); ?></p>
            </div>
        <?php endif; ?>

        <!-- Segmented Navigation Tabs -->
        <nav class="nav-tab-wrapper" style="margin-bottom: 20px; border-bottom: 2px solid #088395;">
            <a href="?page=wakalumi-hero&tab=slides" class="nav-tab <?php echo $current_tab === 'slides' ? 'nav-tab-active' : ''; ?>" style="<?php echo $current_tab === 'slides' ? 'background: #088395; color: #fff; border-color: #088395; font-weight: bold;' : ''; ?>">
                🖼️ 1. Slide Banner (Carousel)
            </a>
            <a href="?page=wakalumi-hero&tab=logos" class="nav-tab <?php echo $current_tab === 'logos' ? 'nav-tab-active' : ''; ?>" style="<?php echo $current_tab === 'logos' ? 'background: #088395; color: #fff; border-color: #088395; font-weight: bold;' : ''; ?>">
                🛡️ 2. Logo Regulasi &amp; Mitra
            </a>
            <a href="?page=wakalumi-hero&tab=lps" class="nav-tab <?php echo $current_tab === 'lps' ? 'nav-tab-active' : ''; ?>" style="<?php echo $current_tab === 'lps' ? 'background: #088395; color: #fff; border-color: #088395; font-weight: bold;' : ''; ?>">
                🔒 3. Lencana Jaminan LPS
            </a>
        </nav>

        <!-- ===================================================================
             TAB 1: MANAJEMEN SLIDE BANNER (CAROUSEL)
             =================================================================== -->
        <?php if ( $current_tab === 'slides' ) : ?>
            <form method="post" action="?page=wakalumi-hero&tab=slides" id="wkl-slides-form">
                <?php wp_nonce_field( 'wakalumi_hero_save_action', 'wakalumi_hero_nonce' ); ?>
                <input type="hidden" name="current_tab" value="slides">
                <input type="hidden" id="delete_slide_ids" name="delete_slide_ids" value="">

                <!-- Quick Help Banner -->
                <div style="background: #f0fdfa; border: 1px solid #ccfbf1; border-radius: 10px; padding: 14px 18px; margin-bottom: 20px; display: flex; align-items: flex-start; gap: 12px;">
                    <span style="font-size: 20px; line-height: 1;">💡</span>
                    <div style="font-size: 12px; color: #0f766e; line-height: 1.6;">
                        <strong>Tips Efisiensi Banner:</strong>
                        Banner akan berputar otomatis secara halus di beranda. Anda dapat menambahkan foto khusus <strong>Desktop (1920×800 px)</strong> dan <strong>Mobile (750×1000 px)</strong> pada setiap slide agar foto tampil sangat pas dan tajam di HP tanpa terpotong!
                    </div>
                </div>

                <div id="wkl-slides-container">
                    <?php if ( empty( $slides ) ) : ?>
                        <div id="wkl-no-slides" style="background: #fff; border: 2px dashed #cbd5e1; border-radius: 12px; padding: 40px 20px; text-align: center; color: #64748b; margin-bottom: 20px;">
                            <p style="font-size: 15px; font-weight: 600; margin: 0 0 10px 0;">Belum ada slide banner yang aktif.</p>
                            <p style="font-size: 13px; margin: 0 0 16px 0;">Klik tombol di bawah untuk menambahkan slide banner pertama Anda.</p>
                            <button type="button" class="button button-primary wkl-add-slide-btn" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 4px 18px;">
                                + Tambah Slide Pertama
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php foreach ( $slides as $idx => $slide ) : 
                        $key = 's_' . $slide['id'];
                    ?>
                        <div class="wkl-slide-card" data-key="<?php echo esc_attr( $key ); ?>" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; margin-bottom: 20px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05); transition: box-shadow 0.2s;">
                            <!-- Card Header -->
                            <div class="wkl-slide-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 12px 18px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; cursor: pointer;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <span class="wkl-slide-order-badge" style="background: #088395; color: #fff; font-size: 11px; font-weight: bold; width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <?php echo $idx + 1; ?>
                                    </span>
                                    <div style="width: 50px; height: 32px; border-radius: 4px; overflow: hidden; background: #e2e8f0; border: 1px solid #cbd5e1; flex-shrink: 0;">
                                        <img class="wkl-header-thumb" src="<?php echo esc_url( $slide['img_desk'] ?: $slide['img_mob'] ); ?>" style="width: 100%; height: 100%; object-fit: cover; <?php echo empty( $slide['img_desk'] ) && empty( $slide['img_mob'] ) ? 'display:none;' : ''; ?>">
                                    </div>
                                    <strong class="wkl-header-title" style="font-size: 14px; color: #0f172a;">
                                        <?php echo esc_html( $slide['title'] ?: 'Slide Banner #' . ( $idx + 1 ) ); ?>
                                    </strong>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span class="wkl-status-badge" style="font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 20px; <?php echo $slide['status'] === 'publish' ? 'background: #dcfce7; color: #166534;' : 'background: #f1f5f9; color: #475569;'; ?>">
                                        <?php echo $slide['status'] === 'publish' ? '● Aktif (Publikasi)' : '○ Draf'; ?>
                                    </span>
                                    <button type="button" class="button-link wkl-delete-slide-btn" data-id="<?php echo esc_attr( $slide['id'] ); ?>" style="color: #ef4444; font-size: 12px; font-weight: 600; padding: 4px 8px; text-decoration: none;">
                                        ✕ Hapus
                                    </button>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="wkl-slide-body" style="padding: 20px 22px;">
                                <input type="hidden" name="slide_key[]" value="<?php echo esc_attr( $key ); ?>">
                                <input type="hidden" name="slide_<?php echo esc_attr( $key ); ?>_id" value="<?php echo esc_attr( $slide['id'] ); ?>">

                                <!-- Row 1: Title & Status -->
                                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 16px;">
                                    <div>
                                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                                            Judul Utama (Headline) <span style="color:#ef4444;">*</span>
                                        </label>
                                        <input type="text" name="slide_<?php echo esc_attr( $key ); ?>_title" value="<?php echo esc_attr( $slide['title'] ); ?>" class="large-text wkl-input-title" placeholder="Contoh: Bank Syariah Terpercaya untuk Masa Depan Anda" style="width: 100%; border-radius: 6px; padding: 6px 10px; font-weight: 600;">
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                                            Status Tampil
                                        </label>
                                        <select name="slide_<?php echo esc_attr( $key ); ?>_status" style="width: 100%; border-radius: 6px; padding: 6px 10px;">
                                            <option value="publish" <?php selected( $slide['status'], 'publish' ); ?>>Publikasikan (Aktif)</option>
                                            <option value="draft" <?php selected( $slide['status'], 'draft' ); ?>>Draf (Disembunyikan)</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Row 2: Subheadline -->
                                <div style="margin-bottom: 18px;">
                                    <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">
                                        Sub-Headline / Keterangan Penjelas
                                    </label>
                                    <textarea name="slide_<?php echo esc_attr( $key ); ?>_subheadline" rows="2" class="large-text" placeholder="Tulis deskripsi singkat yang menarik di bawah judul..." style="width: 100%; border-radius: 6px; padding: 8px 10px;"><?php echo esc_textarea( $slide['subheadline'] ); ?></textarea>
                                </div>

                                <!-- Row 3: Gambar Desktop & Mobile (2 Kolom) -->
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; margin-bottom: 20px;">
                                    <!-- A. Desktop Image -->
                                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
                                        <label style="display: block; font-size: 12px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">
                                            🖥️ Gambar Latar Desktop (Komputer / Laptop)
                                        </label>
                                        <p style="font-size: 11px; color: #64748b; margin: 0 0 10px 0; line-height: 1.4;">
                                            📐 Ideal: <strong>1920 × 800 px</strong> (Landscape ~16:7) atau 1920 × 1080 px.<br>
                                            Format: <code>WebP</code> atau <code>JPG</code> (&lt; 300 KB).
                                        </p>
                                        <div class="wkl-upload-wrap">
                                            <div style="width: 100%; height: 110px; border-radius: 6px; background: #edeef1; border: 1px solid #cbd5e1; overflow: hidden; margin-bottom: 8px; display: flex; align-items: center; justify-content: center;">
                                                <img id="prev_desk_<?php echo esc_attr( $key ); ?>" src="<?php echo esc_url( $slide['img_desk'] ); ?>" style="width: 100%; height: 100%; object-fit: cover; <?php echo empty( $slide['img_desk'] ) ? 'display:none;' : ''; ?>">
                                                <span class="wkl-placeholder" style="font-size: 11px; color: #94a3b8; <?php echo ! empty( $slide['img_desk'] ) ? 'display:none;' : ''; ?>">Belum ada gambar</span>
                                            </div>
                                            <div style="display: flex; gap: 8px; align-items: center;">
                                                <button type="button" class="button wkl-upload-btn" data-target="inp_desk_<?php echo esc_attr( $key ); ?>" data-target-id="inp_desk_id_<?php echo esc_attr( $key ); ?>" data-preview="prev_desk_<?php echo esc_attr( $key ); ?>" style="font-size: 11px; display: inline-flex; align-items: center; gap: 4px;">
                                                    <span class="dashicons dashicons-upload" style="font-size: 15px; width: 15px; height: 15px; margin-top: 1px;"></span> Pilih / Unggah
                                                </button>
                                                <button type="button" class="button-link wkl-remove-btn" data-target="inp_desk_<?php echo esc_attr( $key ); ?>" data-target-id="inp_desk_id_<?php echo esc_attr( $key ); ?>" data-preview="prev_desk_<?php echo esc_attr( $key ); ?>" style="color: #ef4444; font-size: 11px; <?php echo empty( $slide['img_desk'] ) ? 'display:none;' : ''; ?>">
                                                    ✕ Hapus
                                                </button>
                                            </div>
                                            <input type="hidden" id="inp_desk_id_<?php echo esc_attr( $key ); ?>" name="slide_<?php echo esc_attr( $key ); ?>_img_desk_id" value="<?php echo esc_attr( $slide['id_desk'] ); ?>">
                                            <input type="text" id="inp_desk_<?php echo esc_attr( $key ); ?>" name="slide_<?php echo esc_attr( $key ); ?>_img_desk" value="<?php echo esc_attr( $slide['img_desk'] ); ?>" class="large-text" placeholder="...atau tempel URL gambar langsung" style="margin-top: 6px; font-size: 11px;">
                                        </div>
                                    </div>

                                    <!-- B. Mobile Image -->
                                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
                                        <label style="display: block; font-size: 12px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">
                                            📱 Gambar Latar Mobile (Ponsel Smartphone)
                                        </label>
                                        <p style="font-size: 11px; color: #64748b; margin: 0 0 10px 0; line-height: 1.4;">
                                            📐 Ideal: <strong>750 × 1000 px</strong> (Potret 3:4) atau 800 × 800 px.<br>
                                            <em>💡 Opsional: jika kosong, otomatis memakai gambar desktop.</em>
                                        </p>
                                        <div class="wkl-upload-wrap">
                                            <div style="width: 100%; height: 110px; border-radius: 6px; background: #edeef1; border: 1px solid #cbd5e1; overflow: hidden; margin-bottom: 8px; display: flex; align-items: center; justify-content: center;">
                                                <img id="prev_mob_<?php echo esc_attr( $key ); ?>" src="<?php echo esc_url( $slide['img_mob'] ); ?>" style="width: 100%; height: 100%; object-fit: cover; <?php echo empty( $slide['img_mob'] ) ? 'display:none;' : ''; ?>">
                                                <span class="wkl-placeholder" style="font-size: 11px; color: #94a3b8; <?php echo ! empty( $slide['img_mob'] ) ? 'display:none;' : ''; ?>">Belum ada gambar</span>
                                            </div>
                                            <div style="display: flex; gap: 8px; align-items: center;">
                                                <button type="button" class="button wkl-upload-btn" data-target="inp_mob_<?php echo esc_attr( $key ); ?>" data-target-id="inp_mob_id_<?php echo esc_attr( $key ); ?>" data-preview="prev_mob_<?php echo esc_attr( $key ); ?>" style="font-size: 11px; display: inline-flex; align-items: center; gap: 4px;">
                                                    <span class="dashicons dashicons-upload" style="font-size: 15px; width: 15px; height: 15px; margin-top: 1px;"></span> Pilih / Unggah
                                                </button>
                                                <button type="button" class="button-link wkl-remove-btn" data-target="inp_mob_<?php echo esc_attr( $key ); ?>" data-target-id="inp_mob_id_<?php echo esc_attr( $key ); ?>" data-preview="prev_mob_<?php echo esc_attr( $key ); ?>" style="color: #ef4444; font-size: 11px; <?php echo empty( $slide['img_mob'] ) ? 'display:none;' : ''; ?>">
                                                    ✕ Hapus
                                                </button>
                                            </div>
                                            <input type="hidden" id="inp_mob_id_<?php echo esc_attr( $key ); ?>" name="slide_<?php echo esc_attr( $key ); ?>_img_mob_id" value="<?php echo esc_attr( $slide['id_mob'] ); ?>">
                                            <input type="text" id="inp_mob_<?php echo esc_attr( $key ); ?>" name="slide_<?php echo esc_attr( $key ); ?>_img_mob" value="<?php echo esc_attr( $slide['img_mob'] ); ?>" class="large-text" placeholder="...atau tempel URL gambar langsung" style="margin-top: 6px; font-size: 11px;">
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 4: Tombol CTA 1 & Tombol CTA 2 -->
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; margin-bottom: 18px;">
                                    <!-- CTA 1 -->
                                    <div style="border-left: 3px solid #088395; padding-left: 12px;">
                                        <strong style="font-size: 12px; color: #0f172a; display: block; margin-bottom: 6px;">🔘 Tombol Aksi 1 (Utama)</strong>
                                        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 8px;">
                                            <div>
                                                <label style="font-size: 11px; color: #64748b;">Teks Tombol:</label>
                                                <input type="text" name="slide_<?php echo esc_attr( $key ); ?>_cta_text" value="<?php echo esc_attr( $slide['cta_text'] ); ?>" class="regular-text" style="width: 100%; font-size: 12px;">
                                            </div>
                                            <div>
                                                <label style="font-size: 11px; color: #64748b;">Link Tujuan:</label>
                                                <input type="text" name="slide_<?php echo esc_attr( $key ); ?>_cta_url" value="<?php echo esc_attr( $slide['cta_url'] ); ?>" class="regular-text" placeholder="Kosongkan untuk otomatis link WhatsApp CS" style="width: 100%; font-size: 12px;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CTA 2 -->
                                    <div style="border-left: 3px solid #64748b; padding-left: 12px;">
                                        <strong style="font-size: 12px; color: #0f172a; display: block; margin-bottom: 6px;">🔘 Tombol Aksi 2 (Sekunder)</strong>
                                        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 8px;">
                                            <div>
                                                <label style="font-size: 11px; color: #64748b;">Teks Tombol:</label>
                                                <input type="text" name="slide_<?php echo esc_attr( $key ); ?>_cta_text_2" value="<?php echo esc_attr( $slide['cta_text_2'] ); ?>" class="regular-text" style="width: 100%; font-size: 12px;">
                                            </div>
                                            <div>
                                                <label style="font-size: 11px; color: #64748b;">Link Tujuan:</label>
                                                <input type="text" name="slide_<?php echo esc_attr( $key ); ?>_cta_url_2" value="<?php echo esc_attr( $slide['cta_url_2'] ); ?>" class="regular-text" placeholder="Contoh: /produk" style="width: 100%; font-size: 12px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 5: Overlay Opacity -->
                                <div style="display: flex; align-items: center; gap: 15px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 14px;">
                                    <label style="font-size: 12px; font-weight: 700; color: #334155; white-space: nowrap;">
                                        🌑 Kegelapan Latar (Overlay Opacity):
                                    </label>
                                    <input type="range" name="slide_<?php echo esc_attr( $key ); ?>_opacity" min="0" max="100" value="<?php echo esc_attr( $slide['opacity'] ); ?>" oninput="this.nextElementSibling.value = this.value + '%'" style="flex: 1; accent-color: #088395;">
                                    <output style="font-size: 12px; font-weight: bold; color: #088395; width: 45px; text-align: right;"><?php echo esc_html( $slide['opacity'] ); ?>%</output>
                                    <span style="font-size: 11px; color: #64748b;">(Semakin tinggi, semakin gelap agar teks kontras)</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Add Button & Submit Bar -->
                <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 20px; flex-wrap: wrap; gap: 15px; background: #fff; padding: 16px 20px; border-radius: 10px; border: 1px solid #cbd5e1; box-shadow: 0 2px 4px rgba(0,0,0,0.03);">
                    <button type="button" class="button wkl-add-slide-btn" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; color: #088395; border-color: #088395; padding: 4px 14px;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px; margin-top: 2px;"></span> + Tambah Slide Baru
                    </button>

                    <button type="submit" class="button button-primary button-hero" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 4px 28px; box-shadow: 0 2px 6px rgba(8,131,149,0.3);">
                        💾 Simpan Seluruh Slide Banner
                    </button>
                </div>
            </form>

        <!-- ===================================================================
             TAB 2: LOGO REGULASI & MITRA
             =================================================================== -->
        <?php elseif ( $current_tab === 'logos' ) : ?>
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; margin: 0 0 10px 0; color: #088395; font-weight: bold; display: flex; align-items: center; gap: 8px;">
                    🛡️ Pengaturan Lencana Regulasi &amp; Mitra di Hero Section
                </h2>
                <p style="color: #64748b; font-size: 13px; margin: 0 0 20px 0;">
                    Atur deretan logo resmi (OJK, LPS, Bank Indonesia, dsb.) yang melayang di pojok kanan bawah slider (Desktop) dan dok tengah (Mobile).
                </p>

                <form method="post" action="?page=wakalumi-hero&tab=logos">
                    <?php wp_nonce_field( 'wakalumi_hero_save_action', 'wakalumi_hero_nonce' ); ?>
                    <input type="hidden" name="current_tab" value="logos">

                    <table class="form-table" style="margin-top: 0;">
                        <tr>
                            <th scope="row" style="width: 240px;">Tampilan di Layar Desktop:</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="options_hero_reg_desktop" value="1" <?php checked( $hero_reg_desk, '1' ); ?>>
                                    <strong>Tampilkan Logo Regulasi/Mitra di Desktop</strong>
                                </label>
                                <p class="description">Menampilkan lencana kaca di pojok kanan bawah slider pada monitor &amp; laptop.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tampilan di Layar Ponsel:</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="options_hero_reg_mobile" value="1" <?php checked( $hero_reg_mob, '1' ); ?>>
                                    <strong>Tampilkan Logo Regulasi/Mitra di Ponsel (Mobile)</strong>
                                </label>
                                <p class="description">Menampilkan logo dalam kapsul ramping di tengah bawah slider pada layar HP.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_hero_reg_label">Label Teks Pengantar:</label></th>
                            <td>
                                <input type="text" id="options_hero_reg_label" name="options_hero_reg_label" value="<?php echo esc_attr( $hero_reg_lbl ); ?>" class="regular-text" placeholder="Contoh: Terdaftar & Diawasi:">
                                <p class="description">Teks yang mendampingi deretan logo. <em>Kosongkan jika hanya ingin menampilkan gambar logo tanpa teks pengantar.</em></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Label Teks di Ponsel (Mobile):</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="options_hero_reg_label_mobile" value="1" <?php checked( $hero_reg_lbl_mob, '1' ); ?>>
                                    <strong>Tampilkan label teks ini juga di layar ponsel</strong>
                                </label>
                                <p class="description"><em>Rekomendasi:</em> Biarkan nonaktif agar kapsul mobile tetap ramping dan tidak memadati layar HP.</p>
                            </td>
                        </tr>
                    </table>

                    <h3 style="font-size: 14px; font-weight: 700; color: #0f172a; margin: 25px 0 10px 0;">
                        Daftar Logo Mitra &amp; Regulator:
                    </h3>
                    <table class="widefat striped" style="border-radius: 8px; overflow: hidden; border: 1px solid #cbd5e1; margin-bottom: 15px;">
                        <thead>
                            <tr style="background: #f1f5f9;">
                                <th style="width: 45px; text-align: center;">#</th>
                                <th style="width: 140px; text-align: center;">Logo Gambar</th>
                                <th>Label Alt Text</th>
                                <th style="width: 70px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="hero-logos-tbody" data-name="hero_reg_logos">
                            <?php foreach ( $hero_logos as $idx => $logo ) : 
                                $uid = 'hero_logo_' . $idx . '_' . time();
                            ?>
                            <tr style="background: #fff; border-bottom: 1px solid #e2e8f0;">
                                <td style="text-align:center; font-weight:bold; color:#64748b;" class="wkl-logo-num"><?php echo $idx + 1; ?></td>
                                <td style="text-align:center;">
                                    <div class="wkl-upload-wrap">
                                        <img id="prev_<?php echo $uid; ?>" src="<?php echo esc_url( $logo['url'] ); ?>" style="max-width:80px; max-height:40px; border-radius:4px; margin:0 auto 4px auto; display:<?php echo ! empty( $logo['url'] ) ? 'block' : 'none'; ?>;" />
                                        <span class="wkl-placeholder" style="display:<?php echo empty( $logo['url'] ) ? 'block' : 'none'; ?>; font-size:11px; color:#94a3b8; margin-bottom: 4px;">Belum ada</span>
                                        <button type="button" class="button button-small wkl-upload-btn" data-target="inp_<?php echo $uid; ?>" data-preview="prev_<?php echo $uid; ?>" style="font-size:11px;">Pilih</button>
                                        <button type="button" class="button-link wkl-remove-btn" data-target="inp_<?php echo $uid; ?>" data-preview="prev_<?php echo $uid; ?>" style="display:<?php echo empty( $logo['url'] ) ? 'none' : 'inline-block'; ?>; color:#ef4444; font-size:11px; margin-left:4px;">Hapus</button>
                                        <input type="hidden" name="hero_reg_logos_url[]" id="inp_<?php echo $uid; ?>" value="<?php echo esc_attr( $logo['url'] ); ?>" />
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="hero_reg_logos_label[]" value="<?php echo esc_attr( $logo['label'] ); ?>" placeholder="Contoh: OJK, LPS, Bank Indonesia..." class="regular-text" style="width:100%; border-radius: 6px;" />
                                </td>
                                <td style="text-align:center;">
                                    <button type="button" class="button-link wkl-remove-logo-row" style="color: #ef4444; font-weight: bold; text-decoration: none; font-size: 13px;">✕</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <button type="button" class="button wkl-add-logo-row" data-table="hero-logos-tbody" style="margin-bottom: 25px; display: inline-flex; align-items: center; gap: 4px;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 15px; width: 15px; height: 15px; margin-top: 2px;"></span> + Tambah Logo Baru
                    </button>

                    <div style="border-top: 1px solid #e2e8f0; padding-top: 20px;">
                        <button type="submit" class="button button-primary button-hero" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 4px 28px;">
                            💾 Simpan Pengaturan Logo
                        </button>
                    </div>
                </form>
            </div>

        <!-- ===================================================================
             TAB 3: BADGE JAMINAN LPS
             =================================================================== -->
        <?php elseif ( $current_tab === 'lps' ) : ?>
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; margin: 0 0 10px 0; color: #088395; font-weight: bold; display: flex; align-items: center; gap: 8px;">
                    🔒 Pengaturan Lencana Jaminan LPS (Hero Banner)
                </h2>
                <p style="color: #64748b; font-size: 13px; margin: 0 0 20px 0;">
                    Atur lencana penjaminan simpanan resmi LPS yang melayang di pojok kiri bawah slider (Desktop) dan disatukan dalam dok kepercayaan (Mobile).
                </p>

                <form method="post" action="?page=wakalumi-hero&tab=lps">
                    <?php wp_nonce_field( 'wakalumi_hero_save_action', 'wakalumi_hero_nonce' ); ?>
                    <input type="hidden" name="current_tab" value="lps">

                    <table class="form-table" style="margin-top: 0;">
                        <tr>
                            <th scope="row" style="width: 240px;">Status Lencana Jaminan:</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="options_lps_badge_active" value="1" <?php checked( $lps_badge_active, '1' ); ?>>
                                    <strong>Aktifkan Badge Jaminan LPS di Hero Banner</strong>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tampilan di Desktop:</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="options_lps_badge_desktop" value="1" <?php checked( $lps_badge_desktop, '1' ); ?>>
                                    <strong>Tampilkan di Layar Desktop (Pojok Kiri Bawah)</strong>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tampilan di Ponsel (Mobile):</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="options_lps_badge_mobile" value="1" <?php checked( $lps_badge_mobile, '1' ); ?>>
                                    <strong>Tampilkan di Layar Ponsel (Dok Ramping Tengah Bawah)</strong>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Logo Lembaga Penjamin Simpanan:</label></th>
                            <td>
                                <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                    <img id="lps_badge_preview" src="<?php echo esc_url( $lps_badge_logo ); ?>" style="max-width: 120px; max-height: 50px; border-radius: 6px; border: 1px solid #e2e8f0; padding: 4px; background: #fff; <?php echo empty( $lps_badge_logo ) ? 'display:none;' : ''; ?>" />
                                    <div style="display: flex; flex-direction: column; gap: 5px;">
                                        <button type="button" class="button wkl-upload-btn" data-target="options_lps_badge_logo" data-preview="lps_badge_preview" style="display: inline-flex; align-items: center; gap: 4px;">
                                            <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Logo LPS
                                        </button>
                                        <button type="button" class="button-link wkl-remove-btn" data-target="options_lps_badge_logo" data-preview="lps_badge_preview" style="color: #ef4444; font-size: 11px; <?php echo empty( $lps_badge_logo ) ? 'display:none;' : ''; ?>">
                                            ✕ Hapus
                                        </button>
                                    </div>
                                    <input type="text" id="options_lps_badge_logo" name="options_lps_badge_logo" value="<?php echo esc_attr( $lps_badge_logo ); ?>" class="regular-text" placeholder="URL logo LPS..." style="flex: 1; min-width: 220px; border-radius: 6px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_lps_badge_text">Teks Pernyataan Jaminan:</label></th>
                            <td>
                                <input type="text" id="options_lps_badge_text" name="options_lps_badge_text" value="<?php echo esc_attr( $lps_badge_text ); ?>" class="large-text" placeholder="Contoh: Simpanan Dijamin LPS sampai dengan Rp2 Miliar per Nasabah per Bank" style="border-radius: 6px;">
                                <p class="description">Teks edukasi perlindungan nasabah sesuai ketetapan Lembaga Penjamin Simpanan RI.</p>
                            </td>
                        </tr>
                    </table>

                    <div style="border-top: 1px solid #e2e8f0; padding-top: 20px; margin-top: 15px;">
                        <button type="submit" class="button button-primary button-hero" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 4px 28px;">
                            💾 Simpan Pengaturan Badge LPS
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

    </div>

    <!-- Script Pembantu Slide Card Interaktif -->
    <script>
    jQuery(document).ready(function($) {
        // Toggle Accordion Body on Header Click
        $(document).on('click', '.wkl-slide-header', function(e) {
            if ($(e.target).closest('.wkl-delete-slide-btn').length) return;
            var body = $(this).siblings('.wkl-slide-body');
            body.slideToggle(200);
        });

        // Update Title Preview in Header dynamically
        $(document).on('input', '.wkl-input-title', function() {
            var val = $(this).val();
            var headerTitle = $(this).closest('.wkl-slide-card').find('.wkl-header-title');
            headerTitle.text(val.trim() !== '' ? val : 'Slide Banner');
        });

        // Hapus Slide Card
        var deletedIds = [];
        $(document).on('click', '.wkl-delete-slide-btn', function(e) {
            e.stopPropagation();
            if (!confirm('Apakah Anda yakin ingin menghapus slide banner ini?')) return;
            var card = $(this).closest('.wkl-slide-card');
            var postId = $(this).data('id');
            if (postId) {
                deletedIds.push(postId);
                $('#delete_slide_ids').val(deletedIds.join(','));
            }
            card.slideUp(250, function() {
                $(this).remove();
                renumberSlides();
            });
        });

        // Tambah Slide Card Baru Secara Dinamis
        var newSlideCount = 0;
        $('.wkl-add-slide-btn').on('click', function(e) {
            e.preventDefault();
            $('#wkl-no-slides').hide();
            newSlideCount++;
            var key = 'new_' + Date.now();
            var slideNum = $('.wkl-slide-card').length + 1;

            var html = '<div class="wkl-slide-card" data-key="' + key + '" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; margin-bottom: 20px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">' +
                '<div class="wkl-slide-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 12px 18px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; cursor: pointer;">' +
                    '<div style="display: flex; align-items: center; gap: 12px;">' +
                        '<span class="wkl-slide-order-badge" style="background: #088395; color: #fff; font-size: 11px; font-weight: bold; width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">' + slideNum + '</span>' +
                        '<div style="width: 50px; height: 32px; border-radius: 4px; overflow: hidden; background: #e2e8f0; border: 1px solid #cbd5e1; flex-shrink: 0;">' +
                            '<img class="wkl-header-thumb" src="" style="width: 100%; height: 100%; object-fit: cover; display: none;">' +
                        '</div>' +
                        '<strong class="wkl-header-title" style="font-size: 14px; color: #0f172a;">Slide Banner Baru #' + slideNum + '</strong>' +
                    '</div>' +
                    '<div style="display: flex; align-items: center; gap: 10px;">' +
                        '<span class="wkl-status-badge" style="font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 20px; background: #dcfce7; color: #166534;">● Baru</span>' +
                        '<button type="button" class="button-link wkl-delete-slide-btn" data-id="" style="color: #ef4444; font-size: 12px; font-weight: 600; padding: 4px 8px; text-decoration: none;">✕ Hapus</button>' +
                    '</div>' +
                '</div>' +
                '<div class="wkl-slide-body" style="padding: 20px 22px;">' +
                    '<input type="hidden" name="slide_key[]" value="' + key + '">' +
                    '<input type="hidden" name="slide_' + key + '_id" value="0">' +
                    '<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 16px;">' +
                        '<div>' +
                            '<label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">Judul Utama (Headline) <span style="color:#ef4444;">*</span></label>' +
                            '<input type="text" name="slide_' + key + '_title" value="" class="large-text wkl-input-title" placeholder="Contoh: Pembiayaan Usaha Berkah Syariah" style="width: 100%; border-radius: 6px; padding: 6px 10px; font-weight: 600;">' +
                        '</div>' +
                        '<div>' +
                            '<label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">Status Tampil</label>' +
                            '<select name="slide_' + key + '_status" style="width: 100%; border-radius: 6px; padding: 6px 10px;">' +
                                '<option value="publish" selected>Publikasikan (Aktif)</option>' +
                                '<option value="draft">Draf (Disembunyikan)</option>' +
                            '</select>' +
                        '</div>' +
                    '</div>' +
                    '<div style="margin-bottom: 18px;">' +
                        '<label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 5px;">Sub-Headline / Keterangan Penjelas</label>' +
                        '<textarea name="slide_' + key + '_subheadline" rows="2" class="large-text" placeholder="Tulis deskripsi pendukung singkat..." style="width: 100%; border-radius: 6px; padding: 8px 10px;"></textarea>' +
                    '</div>' +
                    '<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; margin-bottom: 20px;">' +
                        '<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">' +
                            '<label style="display: block; font-size: 12px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">🖥️ Gambar Latar Desktop (1920 × 800 px)</label>' +
                            '<p style="font-size: 11px; color: #64748b; margin: 0 0 10px 0;">Format WebP/JPG (&lt; 300 KB)</p>' +
                            '<div class="wkl-upload-wrap">' +
                                '<div style="width: 100%; height: 110px; border-radius: 6px; background: #edeef1; border: 1px solid #cbd5e1; overflow: hidden; margin-bottom: 8px; display: flex; align-items: center; justify-content: center;">' +
                                    '<img id="prev_desk_' + key + '" src="" style="width: 100%; height: 100%; object-fit: cover; display: none;">' +
                                    '<span class="wkl-placeholder" style="font-size: 11px; color: #94a3b8;">Belum ada gambar</span>' +
                                '</div>' +
                                '<div style="display: flex; gap: 8px; align-items: center;">' +
                                    '<button type="button" class="button wkl-upload-btn" data-target="inp_desk_' + key + '" data-target-id="inp_desk_id_' + key + '" data-preview="prev_desk_' + key + '" style="font-size: 11px;">Pilih / Unggah</button>' +
                                    '<button type="button" class="button-link wkl-remove-btn" data-target="inp_desk_' + key + '" data-target-id="inp_desk_id_' + key + '" data-preview="prev_desk_' + key + '" style="color: #ef4444; font-size: 11px; display: none;">✕ Hapus</button>' +
                                '</div>' +
                                '<input type="hidden" id="inp_desk_id_' + key + '" name="slide_' + key + '_img_desk_id" value="">' +
                                '<input type="text" id="inp_desk_' + key + '" name="slide_' + key + '_img_desk" value="" class="large-text" placeholder="...atau tempel URL gambar langsung" style="margin-top: 6px; font-size: 11px;">' +
                            '</div>' +
                        '</div>' +
                        '<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">' +
                            '<label style="display: block; font-size: 12px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">📱 Gambar Latar Mobile (750 × 1000 px)</label>' +
                            '<p style="font-size: 11px; color: #64748b; margin: 0 0 10px 0;">Opsional: jika kosong, otomatis memakai gambar desktop</p>' +
                            '<div class="wkl-upload-wrap">' +
                                '<div style="width: 100%; height: 110px; border-radius: 6px; background: #edeef1; border: 1px solid #cbd5e1; overflow: hidden; margin-bottom: 8px; display: flex; align-items: center; justify-content: center;">' +
                                    '<img id="prev_mob_' + key + '" src="" style="width: 100%; height: 100%; object-fit: cover; display: none;">' +
                                    '<span class="wkl-placeholder" style="font-size: 11px; color: #94a3b8;">Belum ada gambar</span>' +
                                '</div>' +
                                '<div style="display: flex; gap: 8px; align-items: center;">' +
                                    '<button type="button" class="button wkl-upload-btn" data-target="inp_mob_' + key + '" data-target-id="inp_mob_id_' + key + '" data-preview="prev_mob_' + key + '" style="font-size: 11px;">Pilih / Unggah</button>' +
                                    '<button type="button" class="button-link wkl-remove-btn" data-target="inp_mob_' + key + '" data-target-id="inp_mob_id_' + key + '" data-preview="prev_mob_' + key + '" style="color: #ef4444; font-size: 11px; display: none;">✕ Hapus</button>' +
                                '</div>' +
                                '<input type="hidden" id="inp_mob_id_' + key + '" name="slide_' + key + '_img_mob_id" value="">' +
                                '<input type="text" id="inp_mob_' + key + '" name="slide_' + key + '_img_mob" value="" class="large-text" placeholder="...atau tempel URL gambar langsung" style="margin-top: 6px; font-size: 11px;">' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; margin-bottom: 18px;">' +
                        '<div style="border-left: 3px solid #088395; padding-left: 12px;">' +
                            '<strong style="font-size: 12px; color: #0f172a; display: block; margin-bottom: 6px;">🔘 Tombol Aksi 1 (Utama)</strong>' +
                            '<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 8px;">' +
                                '<div><label style="font-size: 11px; color: #64748b;">Teks:</label><input type="text" name="slide_' + key + '_cta_text" value="Hubungi Kami" class="regular-text" style="width: 100%; font-size: 12px;"></div>' +
                                '<div><label style="font-size: 11px; color: #64748b;">Link:</label><input type="text" name="slide_' + key + '_cta_url" value="" class="regular-text" placeholder="Kosongkan untuk otomatis link WA" style="width: 100%; font-size: 12px;"></div>' +
                            '</div>' +
                        '</div>' +
                        '<div style="border-left: 3px solid #64748b; padding-left: 12px;">' +
                            '<strong style="font-size: 12px; color: #0f172a; display: block; margin-bottom: 6px;">🔘 Tombol Aksi 2 (Sekunder)</strong>' +
                            '<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 8px;">' +
                                '<div><label style="font-size: 11px; color: #64748b;">Teks:</label><input type="text" name="slide_' + key + '_cta_text_2" value="Lihat Produk" class="regular-text" style="width: 100%; font-size: 12px;"></div>' +
                                '<div><label style="font-size: 11px; color: #64748b;">Link:</label><input type="text" name="slide_' + key + '_cta_url_2" value="" class="regular-text" placeholder="Contoh: /produk" style="width: 100%; font-size: 12px;"></div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div style="display: flex; align-items: center; gap: 15px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 14px;">' +
                        '<label style="font-size: 12px; font-weight: 700; color: #334155; white-space: nowrap;">🌑 Kegelapan Latar (Opacity):</label>' +
                        '<input type="range" name="slide_' + key + '_opacity" min="0" max="100" value="60" oninput="this.nextElementSibling.value = this.value + \'%\'" style="flex: 1; accent-color: #088395;">' +
                        '<output style="font-size: 12px; font-weight: bold; color: #088395; width: 45px; text-align: right;">60%</output>' +
                    '</div>' +
                '</div>' +
            '</div>';

            $('#wkl-slides-container').append(html);
            $('html, body').animate({
                scrollTop: $('.wkl-slide-card:last').offset().top - 80
            }, 300);
        });

        function renumberSlides() {
            $('.wkl-slide-card').each(function(index) {
                $(this).find('.wkl-slide-order-badge').text(index + 1);
            });
            if ($('.wkl-slide-card').length === 0) {
                $('#wkl-no-slides').show();
            }
        }
    });
    </script>
    <?php
}

