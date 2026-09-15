<?php
/**
 * Custom Post Types Registration
 *
 * Phase 1: berita, produk, anggota_tim
 * Phase 2 (nanti): laporan_publikasi, brosur, galeri, karir, kuis_soal
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register all Custom Post Types.
 */
function wakalumi_register_cpts() {

    // ──────────────────────────────────────
    // CPT: Slider Hero (Beranda)
    // ──────────────────────────────────────
    register_post_type( 'hero_slide', [
        'labels' => [
            'name'               => 'Slider Hero (Beranda)',
            'singular_name'      => 'Slide',
            'menu_name'          => 'Slider Hero',
            'add_new'            => 'Tambah Slide',
            'add_new_item'       => 'Tambah Slide Banner Baru',
            'edit_item'          => 'Edit Slide Banner',
            'view_item'          => 'Lihat Slide',
            'all_items'          => 'Semua Slide Banner',
        ],
        'public'            => true,
        'has_archive'       => false,
        'rewrite'           => [ 'slug' => 'slide', 'with_front' => false ],
        'menu_icon'         => 'dashicons-slides',
        'menu_position'     => 3,
        'supports'          => [ 'title', 'thumbnail', 'page-attributes' ],
        'show_in_rest'      => false,
    ] );

    // ──────────────────────────────────────
    // CPT: Produk (Katalog Produk Simpanan & Pembiayaan)
    // ──────────────────────────────────────
    register_post_type( 'produk', [
        'labels' => [
            'name'               => 'Katalog Produk',
            'singular_name'      => 'Produk',
            'menu_name'          => 'Katalog Produk',
            'add_new'            => 'Tambah Produk',
            'add_new_item'       => 'Tambah Produk Baru',
            'edit_item'          => 'Edit Produk',
            'view_item'          => 'Lihat Produk',
            'all_items'          => 'Semua Produk',
            'search_items'       => 'Cari Produk',
            'not_found'          => 'Tidak ada produk ditemukan',
        ],
        'public'            => true,
        'has_archive'       => true,
        'rewrite'           => [ 'slug' => 'produk', 'with_front' => false ],
        'menu_icon'         => 'dashicons-bank',
        'menu_position'     => 4,
        'supports'          => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ],
        'show_in_rest'      => true,
        'taxonomies'        => [ 'kategori_produk' ],
    ] );

    // Taxonomy: Kategori Produk
    register_taxonomy( 'kategori_produk', 'produk', [
        'labels' => [
            'name'          => 'Kategori Produk',
            'singular_name' => 'Kategori',
            'add_new_item'  => 'Tambah Kategori Baru',
        ],
        'public'            => true,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'rewrite'           => [ 'slug' => 'kategori-produk' ],
    ] );

    // ──────────────────────────────────────
    // CPT: Berita (Artikel & Kabar Perusahaan)
    // ──────────────────────────────────────
    register_post_type( 'berita', [
        'labels' => [
            'name'               => 'Berita & Artikel',
            'singular_name'      => 'Berita',
            'menu_name'          => 'Berita & Artikel',
            'add_new'            => 'Tambah Berita',
            'add_new_item'       => 'Tambah Berita / Artikel Baru',
            'edit_item'          => 'Edit Berita',
            'view_item'          => 'Lihat Berita',
            'all_items'          => 'Semua Berita',
            'search_items'       => 'Cari Berita',
            'not_found'          => 'Tidak ada berita ditemukan',
            'not_found_in_trash' => 'Tidak ada berita di sampah',
        ],
        'public'            => true,
        'has_archive'       => true,
        'rewrite'           => [ 'slug' => 'berita', 'with_front' => false ],
        'menu_icon'         => 'dashicons-megaphone',
        'menu_position'     => 5,
        'supports'          => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ],
        'show_in_rest'      => true, // Gutenberg support
        'taxonomies'        => [ 'kategori_berita' ],
    ] );

    // Taxonomy: Kategori Berita
    register_taxonomy( 'kategori_berita', 'berita', [
        'labels' => [
            'name'          => 'Kategori Berita',
            'singular_name' => 'Kategori',
            'add_new_item'  => 'Tambah Kategori Baru',
            'search_items'  => 'Cari Kategori',
        ],
        'public'            => true,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'rewrite'           => [ 'slug' => 'kategori-berita' ],
    ] );

    // ──────────────────────────────────────
    // CPT: Anggota Tim (Team Members - Disiapkan)
    // ──────────────────────────────────────
    register_post_type( 'anggota_tim', [
        'labels' => [
            'name'               => 'Susunan Pengurus (Tim)',
            'singular_name'      => 'Anggota Tim',
            'menu_name'          => 'Susunan Pengurus',
            'add_new'            => 'Tambah Pengurus',
            'add_new_item'       => 'Tambah Anggota Pengurus Baru',
            'edit_item'          => 'Edit Pengurus',
            'view_item'          => 'Lihat Profil',
            'all_items'          => 'Semua Pengurus',
        ],
        'public'            => true,
        'has_archive'       => false,
        'rewrite'           => [ 'slug' => 'tim', 'with_front' => false ],
        'menu_icon'         => 'dashicons-groups',
        'menu_position'     => 6,
        'supports'          => [ 'title', 'thumbnail' ],
        'show_in_rest'      => true,
    ] );
}
add_action( 'init', 'wakalumi_register_cpts' );

/**
 * Flush rewrite rules on theme activation (so CPT URLs work immediately).
 */
function wakalumi_rewrite_flush() {
    wakalumi_register_cpts();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'wakalumi_rewrite_flush' );

/**
 * Metabox Unggah Gambar Slide Hero (Desktop & Mobile)
 * Menampilkan kontrol upload langsung dengan tombol WordPress Media Library & rekomendasi ukuran.
 */
function wakalumi_register_hero_slide_metabox() {
    add_meta_box(
        'wakalumi_hero_slide_images_box',
        'Unggah Gambar Banner (Desktop & Mobile)',
        'wakalumi_render_hero_slide_images_box',
        'hero_slide',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'wakalumi_register_hero_slide_metabox' );

function wakalumi_render_hero_slide_images_box( $post ) {
    wp_nonce_field( 'wakalumi_hero_slide_nonce', 'hero_slide_nonce' );

    // 1. Gambar Desktop
    $id_desk  = (int) get_post_meta( $post->ID, 'slide_image_desktop_id', true );
    $img_desk = '';
    if ( $id_desk > 0 ) {
        $img_desk = wp_get_attachment_image_url( $id_desk, 'full' ) ?: wp_get_attachment_url( $id_desk );
    }
    if ( empty( $img_desk ) ) {
        $pm_desk = get_post_meta( $post->ID, 'slide_image_desktop', true );
        if ( ! empty( $pm_desk ) && strpos( $pm_desk, 'field_' ) !== 0 ) {
            if ( is_numeric( $pm_desk ) && $pm_desk > 0 ) {
                $id_desk  = (int) $pm_desk;
                $img_desk = wp_get_attachment_image_url( $id_desk, 'full' ) ?: wp_get_attachment_url( $id_desk );
            } elseif ( is_string( $pm_desk ) && ( strpos( $pm_desk, 'http' ) === 0 || strpos( $pm_desk, '/' ) === 0 ) ) {
                $img_desk = $pm_desk;
            }
        }
    }
    if ( empty( $img_desk ) && has_post_thumbnail( $post->ID ) ) {
        $id_desk  = get_post_thumbnail_id( $post->ID );
        $img_desk = get_the_post_thumbnail_url( $post->ID, 'full' );
    }

    // 2. Gambar Mobile
    $id_mob  = (int) get_post_meta( $post->ID, 'slide_image_mobile_id', true );
    $img_mob = '';
    if ( $id_mob > 0 ) {
        $img_mob = wp_get_attachment_image_url( $id_mob, 'full' ) ?: wp_get_attachment_url( $id_mob );
    }
    if ( empty( $img_mob ) ) {
        $pm_mob = get_post_meta( $post->ID, 'slide_image_mobile', true );
        if ( ! empty( $pm_mob ) && strpos( $pm_mob, 'field_' ) !== 0 ) {
            if ( is_numeric( $pm_mob ) && $pm_mob > 0 ) {
                $id_mob  = (int) $pm_mob;
                $img_mob = wp_get_attachment_image_url( $id_mob, 'full' ) ?: wp_get_attachment_url( $id_mob );
            } elseif ( is_string( $pm_mob ) && ( strpos( $pm_mob, 'http' ) === 0 || strpos( $pm_mob, '/' ) === 0 ) ) {
                $img_mob = $pm_mob;
            }
        }
    }
    ?>
    <div style="padding: 10px 0;">
        <!-- 1. Versi Desktop -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; margin-bottom: 20px;">
            <h4 style="margin: 0 0 8px 0; font-size: 14px; color: #0f172a;">
                🖥️ Gambar Latar Versi Desktop (Komputer / Laptop)
            </h4>
            <p style="margin: 0 0 12px 0; font-size: 12px; color: #475569; line-height: 1.6;">
                <strong>📐 Rekomendasi Resolusi:</strong> <code>1920 × 800 piksel</code> (Landscape rasio ~16:7) atau <code>1920 × 1080 piksel</code> (16:9).<br>
                <strong>⚡ Format Disarankan:</strong> <code>WebP</code> atau <code>JPG</code> dengan kompresi optimal.<br>
                <strong>💾 Batas Ukuran File:</strong> Disarankan <strong>&lt; 300 KB</strong> agar website memuat instan bagi nasabah.
            </p>
            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                <img id="prev_slide_desk" src="<?php echo esc_url( $img_desk ); ?>" style="max-width: 200px; max-height: 100px; border-radius: 6px; border: 1px solid #cbd5e1; object-fit: cover; <?php echo empty( $img_desk ) ? 'display:none;' : ''; ?>">
                <div style="display: flex; flex-direction: column; gap: 6px;">
                    <button type="button" class="button button-secondary wkl-upload-btn" data-target="inp_slide_desk" data-target-id="inp_slide_desk_id" data-preview="prev_slide_desk">
                        <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px; margin-top:2px;"></span> Unggah Gambar Desktop
                    </button>
                    <button type="button" class="button-link wkl-remove-btn" data-target="inp_slide_desk" data-target-id="inp_slide_desk_id" data-preview="prev_slide_desk" style="color: #ef4444; font-size: 12px; text-align: left; <?php echo empty( $img_desk ) ? 'display:none;' : ''; ?>">
                        ✕ Hapus Gambar
                    </button>
                </div>
                <input type="hidden" id="inp_slide_desk_id" name="slide_image_desktop_id" value="<?php echo esc_attr( $id_desk ?: '' ); ?>">
                <input type="text" id="inp_slide_desk" name="slide_image_desktop" value="<?php echo esc_attr( $img_desk ); ?>" class="large-text" placeholder="...atau tempel URL gambar langsung" style="flex: 1; min-width: 260px;">
            </div>
        </div>

        <!-- 2. Versi Mobile -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px;">
            <h4 style="margin: 0 0 8px 0; font-size: 14px; color: #0f172a;">
                📱 Gambar Latar Versi Mobile (Ponsel / Smartphone)
            </h4>
            <p style="margin: 0 0 12px 0; font-size: 12px; color: #475569; line-height: 1.6;">
                <strong>📐 Rekomendasi Resolusi:</strong> <code>750 × 1000 piksel</code> (Potret vertikal 3:4) atau <code>800 × 800 piksel</code> (Persegi 1:1).<br>
                <strong>⚡ Format Disarankan:</strong> <code>WebP</code> atau <code>JPG</code>.<br>
                <strong>💾 Batas Ukuran File:</strong> Disarankan <strong>&lt; 150 KB</strong> agar hemat kuota ponsel.<br>
                <em>💡 Opsional: Jika dikosongkan, slider ponsel akan otomatis menggunakan gambar versi Desktop.</em>
            </p>
            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                <img id="prev_slide_mob" src="<?php echo esc_url( $img_mob ); ?>" style="max-width: 120px; max-height: 120px; border-radius: 6px; border: 1px solid #cbd5e1; object-fit: cover; <?php echo empty( $img_mob ) ? 'display:none;' : ''; ?>">
                <div style="display: flex; flex-direction: column; gap: 6px;">
                    <button type="button" class="button button-secondary wkl-upload-btn" data-target="inp_slide_mob" data-target-id="inp_slide_mob_id" data-preview="prev_slide_mob">
                        <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px; margin-top:2px;"></span> Unggah Gambar Mobile
                    </button>
                    <button type="button" class="button-link wkl-remove-btn" data-target="inp_slide_mob" data-target-id="inp_slide_mob_id" data-preview="prev_slide_mob" style="color: #ef4444; font-size: 12px; text-align: left; <?php echo empty( $img_mob ) ? 'display:none;' : ''; ?>">
                        ✕ Hapus Gambar
                    </button>
                </div>
                <input type="hidden" id="inp_slide_mob_id" name="slide_image_mobile_id" value="<?php echo esc_attr( $id_mob ?: '' ); ?>">
                <input type="text" id="inp_slide_mob" name="slide_image_mobile" value="<?php echo esc_attr( $img_mob ); ?>" class="large-text" placeholder="...atau tempel URL gambar langsung" style="flex: 1; min-width: 260px;">
            </div>
        </div>
    </div>
    <?php
}

function wakalumi_save_hero_slide_metabox( $post_id ) {
    if ( ! isset( $_POST['hero_slide_nonce'] ) || ! wp_verify_nonce( $_POST['hero_slide_nonce'], 'wakalumi_hero_slide_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Simpan Gambar Desktop
    if ( isset( $_POST['slide_image_desktop'] ) ) {
        $url_desk = esc_url_raw( trim( $_POST['slide_image_desktop'] ) );
        update_post_meta( $post_id, 'slide_image_desktop', $url_desk );
        
        $id_desk = ! empty( $_POST['slide_image_desktop_id'] ) ? (int) $_POST['slide_image_desktop_id'] : 0;
        if ( ! $id_desk && ! empty( $url_desk ) ) {
            $id_desk = attachment_url_to_postid( $url_desk );
        }
        if ( $id_desk > 0 ) {
            update_post_meta( $post_id, 'slide_image_desktop_id', $id_desk );
            set_post_thumbnail( $post_id, $id_desk );
        } elseif ( empty( $url_desk ) ) {
            delete_post_meta( $post_id, 'slide_image_desktop_id' );
            delete_post_thumbnail( $post_id );
        }
    }

    // Simpan Gambar Mobile
    if ( isset( $_POST['slide_image_mobile'] ) ) {
        $url_mob = esc_url_raw( trim( $_POST['slide_image_mobile'] ) );
        update_post_meta( $post_id, 'slide_image_mobile', $url_mob );

        $id_mob = ! empty( $_POST['slide_image_mobile_id'] ) ? (int) $_POST['slide_image_mobile_id'] : 0;
        if ( ! $id_mob && ! empty( $url_mob ) ) {
            $id_mob = attachment_url_to_postid( $url_mob );
        }
        if ( $id_mob > 0 ) {
            update_post_meta( $post_id, 'slide_image_mobile_id', $id_mob );
        } elseif ( empty( $url_mob ) ) {
            delete_post_meta( $post_id, 'slide_image_mobile_id' );
        }
    }
}
add_action( 'save_post_hero_slide', 'wakalumi_save_hero_slide_metabox' );


