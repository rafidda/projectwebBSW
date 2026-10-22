<?php
/**
 * Native WordPress Admin Options Pages
 *
 * Provides a dedicated "Pengaturan Website" menu in WP-Admin
 * for managing Announcement Bar, Maps, Quick Services, Media, Nisbah, Contact, and Footer
 * 100% FREE without requiring ACF PRO.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register Admin Menu & Submenus
 */
function wakalumi_register_admin_options_menu() {
    // Top-Level Menu
    add_menu_page(
        'Pengaturan Website',
        'Pengaturan Website',
        'manage_options',
        'wakalumi-settings',
        'wakalumi_render_general_page',
        'dashicons-admin-settings',
        2
    );

    // Submenu 1: Umum, Logo & Identitas Website
    add_submenu_page(
        'wakalumi-settings',
        'Umum, Logo & Identitas Website',
        'Umum & Logo Brand',
        'manage_options',
        'wakalumi-settings',
        'wakalumi_render_general_page'
    );

    // Submenu 2: Kontak & Peta Maps
    add_submenu_page(
        'wakalumi-settings',
        'Kontak & Lokasi Maps',
        'Kontak & Maps',
        'manage_options',
        'wakalumi-contact',
        'wakalumi_render_contact_page'
    );

    // Submenu 3: Layanan Cepat & Media Beranda
    add_submenu_page(
        'wakalumi-settings',
        'Layanan Cepat & Media Beranda',
        'Beranda: Media & Kartu',
        'manage_options',
        'wakalumi-media',
        'wakalumi_render_media_page'
    );

    // Submenu 4: Informasi Nisbah Bagi Hasil
    add_submenu_page(
        'wakalumi-settings',
        'Informasi Nisbah Bagi Hasil',
        'Beranda: Kinerja Nisbah',
        'manage_options',
        'wakalumi-nisbah',
        'wakalumi_render_nisbah_page'
    );

    // Submenu 5: Footer & Jam Operasional
    add_submenu_page(
        'wakalumi-settings',
        'Footer, Jam Kerja & Legalitas',
        'Footer & Jam Kerja',
        'manage_options',
        'wakalumi-footer',
        'wakalumi_render_footer_page'
    );
}
add_action( 'admin_menu', 'wakalumi_register_admin_options_menu' );


/**
 * ─────────────────────────────────────────────────────────────
 * 1. RENDER: UMUM, LOGO BRAND & WHATSAPP CS
 * ─────────────────────────────────────────────────────────────
 */
function wakalumi_render_general_page() {
    if ( isset( $_POST['wakalumi_save_general'] ) && check_admin_referer( 'wakalumi_general_nonce' ) ) {
        // WhatsApp CS
        update_option( 'options_contact_wa', sanitize_text_field( $_POST['options_contact_wa'] ?? '' ) );
        update_option( 'options_contact_wa_message', sanitize_text_field( $_POST['options_contact_wa_message'] ?? '' ) );

        // Brand & Logo
        $site_logo    = esc_url_raw( $_POST['options_site_logo'] ?? '' );
        $site_logo_id = intval( $_POST['options_site_logo_id'] ?? 0 );
        update_option( 'options_site_logo', $site_logo );
        update_option( 'options_site_logo_id', $site_logo_id );

        $site_logo_dark    = esc_url_raw( $_POST['options_site_logo_dark'] ?? '' );
        $site_logo_dark_id = intval( $_POST['options_site_logo_dark_id'] ?? 0 );
        update_option( 'options_site_logo_dark', $site_logo_dark );
        update_option( 'options_site_logo_dark_id', $site_logo_dark_id );

        $brand_name = sanitize_text_field( $_POST['options_site_brand_name'] ?? '' );
        update_option( 'options_site_brand_name', $brand_name );

        $brand_tagline = sanitize_text_field( $_POST['options_site_brand_tagline'] ?? '' );
        update_option( 'options_site_brand_tagline', $brand_tagline );

        $logo_display = sanitize_text_field( $_POST['options_site_logo_display'] ?? 'both' );
        update_option( 'options_site_logo_display', in_array( $logo_display, [ 'both', 'logo_only', 'text_only' ], true ) ? $logo_display : 'both' );

        $logo_height = intval( $_POST['options_site_logo_height'] ?? 42 );
        if ( $logo_height < 24 ) $logo_height = 24;
        if ( $logo_height > 70 ) $logo_height = 70;
        update_option( 'options_site_logo_height', $logo_height );

        // Favicon (Site Icon)
        $site_favicon    = esc_url_raw( $_POST['options_site_favicon'] ?? '' );
        $site_favicon_id = intval( $_POST['options_site_favicon_id'] ?? 0 );
        update_option( 'options_site_favicon', $site_favicon );
        update_option( 'options_site_favicon_id', $site_favicon_id );

        // Sinkronisasi dengan WordPress core site_icon (otomatis melayani seluruh ukuran tab & mobile)
        if ( $site_favicon_id > 0 ) {
            update_option( 'site_icon', $site_favicon_id );
        } elseif ( empty( $site_favicon ) ) {
            delete_option( 'site_icon' );
        }

        // Sinkronisasi dengan WordPress Customizer (custom_logo theme_mod)
        if ( $site_logo_id > 0 ) {
            set_theme_mod( 'custom_logo', $site_logo_id );
        } elseif ( empty( $site_logo ) ) {
            remove_theme_mod( 'custom_logo' );
        }

        // Pengaturan SEO & Pratinjau Mesin Pencari
        update_option( 'options_seo_meta_desc', sanitize_textarea_field( $_POST['options_seo_meta_desc'] ?? '' ) );
        update_option( 'options_seo_keywords', sanitize_text_field( $_POST['options_seo_keywords'] ?? '' ) );
        update_option( 'options_seo_og_image', esc_url_raw( $_POST['options_seo_og_image'] ?? '' ) );
        update_option( 'options_seo_og_image_id', intval( $_POST['options_seo_og_image_id'] ?? 0 ) );
        update_option( 'options_seo_google_verify', sanitize_text_field( $_POST['options_seo_google_verify'] ?? '' ) );

        echo '<div class="notice notice-success is-dismissible"><p><strong>✅ Pengaturan Identitas Brand, Logo, Favicon, WhatsApp & SEO berhasil disimpan!</strong></p></div>';
    }

    $wa     = get_option( 'options_contact_wa', '6281517380388' );
    $wa_msg = get_option( 'options_contact_wa_message', 'Halo CS Bank Syariah Wakalumi, saya ingin berkonsultasi mengenai produk perbankan.' );
    $seo_desc   = get_option( 'options_seo_meta_desc', 'PT BPRS Wakalumi (Bank Syariah Wakalumi / BSW) — Bank Perekonomian Rakyat Syariah terpercaya di Ciputat, Tangerang Selatan & Depok. Solusi Tabungan Syariah, Deposito Mudharabah bagi hasil kompetitif, dan Pembiayaan Syariah mudah, amanah, berizin & diawasi OJK serta dijamin LPS.' );
    $seo_kw     = get_option( 'options_seo_keywords', 'Bank Syariah Wakalumi, BPRS Wakalumi, BSW, Bank Syariah Ciputat, Bank Syariah Tangerang Selatan, Bank Syariah Depok, Tabungan Syariah, Deposito Syariah, Pembiayaan Syariah, BPRS OJK LPS' );
    $seo_og_img = get_option( 'options_seo_og_image', '' );
    $seo_og_id  = get_option( 'options_seo_og_image_id', 0 );
    $seo_gver   = get_option( 'options_seo_google_verify', '' );
    $brand  = function_exists( 'wakalumi_get_brand_identity' ) ? wakalumi_get_brand_identity() : [
        'logo_url'      => get_option( 'options_site_logo', '' ),
        'logo_id'       => get_option( 'options_site_logo_id', 0 ),
        'logo_dark_url' => get_option( 'options_site_logo_dark', '' ),
        'logo_dark_id'  => get_option( 'options_site_logo_dark_id', 0 ),
        'favicon_url'   => get_option( 'options_site_favicon', '' ),
        'favicon_id'    => get_option( 'options_site_favicon_id', 0 ),
        'name'          => get_option( 'options_site_brand_name', 'Bank Syariah Wakalumi' ),
        'tagline'       => get_option( 'options_site_brand_tagline', 'BPRS' ),
        'display_mode'  => get_option( 'options_site_logo_display', 'both' ),
        'logo_height'   => get_option( 'options_site_logo_height', 42 ),
    ];
    ?>
    <div class="wrap" style="max-width: 900px; margin-top: 20px;">
        <h1 style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
            <span class="dashicons dashicons-admin-generic" style="font-size: 32px; width: 32px; height: 32px; color: #088395;"></span>
            Pengaturan Umum, Logo & Identitas Website
        </h1>

        <!-- Notice Pengalihan Pengumuman -->
        <div style="background: #f0fdfa; border-left: 4px solid #088395; padding: 14px 18px; margin-bottom: 20px; border-radius: 6px; display: flex; align-items: center; justify-content: space-between; gap: 12px;">
            <div>
                <strong style="color: #0f766e; font-size: 14px;">📢 Pengumuman Website Kini Terpusat</strong>
                <p style="margin: 4px 0 0 0; color: #334155; font-size: 13px;">
                    Sistem pengumuman resmi, notifikasi mengambang (Toast Notification), dan pop-up darurat kini dikelola lengkap melalui menu 
                    <strong>Pengaturan Website &rarr; Pengumuman Resmi</strong>.
                </p>
            </div>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-pengumuman' ) ); ?>" class="button button-primary" style="background: #088395; border-color: #066e7d; white-space: nowrap;">
                Buka Pengumuman Resmi &rarr;
            </a>
        </div>

        <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <form method="post" action="">
                <?php wp_nonce_field( 'wakalumi_general_nonce' ); ?>

                <!-- SEKSI 1: LOGO & IDENTITAS BRAND -->
                <h2 style="font-size: 16px; margin-top: 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🏛️ Identitas Brand & Logo Website (Main Navbar & Footer)
                </h2>
                <p style="color: #64748b; font-size: 13px; margin-bottom: 20px;">
                    Kelola logo resmi dan nama perusahaan untuk navigasi utama (Navbar) dan Footer. Logo menggunakan rasio aspek fleksibel tanpa terpotong (*responsive auto-width*).
                </p>

                <table class="form-table" style="margin-top: 0;">
                    <!-- Logo Utama -->
                    <tr>
                        <th scope="row">
                            <label for="options_site_logo">Logo Utama:</label>
                        </th>
                        <td>
                            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                                <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px; padding: 10px; display: inline-flex; align-items: center; justify-content: center; min-width: 120px; min-height: 64px;">
                                    <img id="site_logo_preview" src="<?php echo esc_url( $brand['logo_url'] ); ?>" style="max-height: 52px; max-width: 220px; width: auto; height: auto; object-fit: contain; <?php echo empty( $brand['logo_url'] ) ? 'display:none;' : ''; ?>" alt="Preview Logo" />
                                    <span class="wkl-placeholder" style="<?php echo ! empty( $brand['logo_url'] ) ? 'display:none;' : ''; ?> color: #94a3b8; font-size: 11px;">Belum ada logo</span>
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <button type="button" class="button button-secondary wkl-upload-btn" data-target="options_site_logo" data-preview="site_logo_preview" data-target-id="options_site_logo_id" style="display: inline-flex; align-items: center; gap: 5px;">
                                        <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah / Pilih Logo
                                    </button>
                                    <button type="button" class="button-link wkl-remove-btn" data-target="options_site_logo" data-preview="site_logo_preview" data-target-id="options_site_logo_id" style="color: #ef4444; font-size: 12px; <?php echo empty( $brand['logo_url'] ) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus Logo
                                    </button>
                                </div>
                                <input type="hidden" id="options_site_logo" name="options_site_logo" value="<?php echo esc_attr( $brand['logo_url'] ); ?>">
                                <input type="hidden" id="options_site_logo_id" name="options_site_logo_id" value="<?php echo esc_attr( $brand['logo_id'] ); ?>">
                            </div>
                            <p class="description" style="margin-top: 8px;">
                                Rekomendasi: Gunakan format PNG transparan, WebP, SVG, atau JPG. Rasio aspek bebas (persegi, memanjang/horizontal, maupun bulat) dan <strong>tidak akan terpotong</strong>.
                            </p>
                        </td>
                    </tr>

                    <!-- Logo Dark Mode (Opsional) -->
                    <tr>
                        <th scope="row">
                            <label for="options_site_logo_dark">Logo Khusus Dark Mode <span style="font-weight: normal; color: #94a3b8;">(Opsional)</span>:</label>
                        </th>
                        <td>
                            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                                <div style="background: #0f172a; border: 1px dashed #334155; border-radius: 8px; padding: 10px; display: inline-flex; align-items: center; justify-content: center; min-width: 120px; min-height: 64px;">
                                    <img id="site_logo_dark_preview" src="<?php echo esc_url( $brand['logo_dark_url'] ); ?>" style="max-height: 52px; max-width: 220px; width: auto; height: auto; object-fit: contain; <?php echo empty( $brand['logo_dark_url'] ) ? 'display:none;' : ''; ?>" alt="Preview Dark Logo" />
                                    <span class="wkl-placeholder" style="<?php echo ! empty( $brand['logo_dark_url'] ) ? 'display:none;' : ''; ?> color: #64748b; font-size: 11px;">Gunakan Logo Utama</span>
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <button type="button" class="button button-secondary wkl-upload-btn" data-target="options_site_logo_dark" data-preview="site_logo_dark_preview" data-target-id="options_site_logo_dark_id" style="display: inline-flex; align-items: center; gap: 5px;">
                                        <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Logo Terang/Putih
                                    </button>
                                    <button type="button" class="button-link wkl-remove-btn" data-target="options_site_logo_dark" data-preview="site_logo_dark_preview" data-target-id="options_site_logo_dark_id" style="color: #ef4444; font-size: 12px; <?php echo empty( $brand['logo_dark_url'] ) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus
                                    </button>
                                </div>
                                <input type="hidden" id="options_site_logo_dark" name="options_site_logo_dark" value="<?php echo esc_attr( $brand['logo_dark_url'] ); ?>">
                                <input type="hidden" id="options_site_logo_dark_id" name="options_site_logo_dark_id" value="<?php echo esc_attr( $brand['logo_dark_id'] ); ?>">
                            </div>
                            <p class="description" style="margin-top: 8px;">
                                Jika logo Anda memiliki versi berwarna putih/terang untuk latar belakang gelap. Jika dikosongkan, website otomatis menggunakan Logo Utama di semua mode.
                            </p>
                        </td>
                    </tr>

                    <!-- Favicon / Icon Tab Browser (Site Icon) -->
                    <tr style="background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
                        <th scope="row" style="padding: 20px 10px 20px 0;">
                            <label for="options_site_favicon">Icon Tab Browser (Favicon):</label>
                        </th>
                        <td style="padding: 20px 0;">
                            <!-- Simulasi Visual Tab Browser Modern -->
                            <div style="margin-bottom: 14px;">
                                <span style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 5px;">
                                    Simulasi Tampilan Tab Browser:
                                </span>
                                <div style="display: flex; align-items: flex-end; background: #e2e8f0; padding: 6px 12px 0 12px; border-radius: 8px 8px 0 0; width: fit-content;">
                                    <div style="display: flex; align-items: center; gap: 8px; background: #ffffff; padding: 7px 16px; border-radius: 6px 6px 0 0; box-shadow: 0 -1px 3px rgba(0,0,0,0.06); font-size: 12px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; color: #1e293b; font-weight: 600; max-width: 280px;">
                                        <img id="site_favicon_tab_preview" src="<?php echo esc_url( $brand['favicon_url'] ); ?>" style="width: 16px; height: 16px; object-fit: contain; border-radius: 2px; <?php echo empty( $brand['favicon_url'] ) ? 'display:none;' : ''; ?>" alt="Favicon" />
                                        <span id="site_favicon_tab_placeholder" style="<?php echo ! empty( $brand['favicon_url'] ) ? 'display:none;' : ''; ?> display: inline-block; width: 14px; height: 14px; background: #cbd5e1; border-radius: 2px;"></span>
                                        <span id="tab_preview_title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 180px;"><?php echo esc_html( $brand['name'] ); ?></span>
                                        <span style="color: #94a3b8; font-size: 14px; margin-left: 6px; line-height: 1; cursor: default;">&times;</span>
                                    </div>
                                </div>
                            </div>

                            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                                <div style="background: #ffffff; border: 2px dashed #088395; border-radius: 10px; padding: 6px; display: inline-flex; align-items: center; justify-content: center; width: 56px; height: 56px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                                    <img id="site_favicon_preview" src="<?php echo esc_url( $brand['favicon_url'] ); ?>" style="width: 40px; height: 40px; object-fit: contain; <?php echo empty( $brand['favicon_url'] ) ? 'display:none;' : ''; ?>" alt="Preview Favicon" />
                                    <span class="wkl-placeholder" style="<?php echo ! empty( $brand['favicon_url'] ) ? 'display:none;' : ''; ?> color: #94a3b8; font-size: 10px; text-align: center; line-height: 1.2;">Belum ada</span>
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <button type="button" class="button button-primary wkl-upload-btn" data-target="options_site_favicon" data-preview="site_favicon_preview" data-target-id="options_site_favicon_id" style="background: #088395; border-color: #066e7d; display: inline-flex; align-items: center; gap: 5px;">
                                        <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah / Pilih Favicon
                                    </button>
                                    <button type="button" class="button-link wkl-remove-btn" data-target="options_site_favicon" data-preview="site_favicon_preview" data-target-id="options_site_favicon_id" style="color: #ef4444; font-size: 12px; <?php echo empty( $brand['favicon_url'] ) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus Favicon
                                    </button>
                                </div>
                                <input type="hidden" id="options_site_favicon" name="options_site_favicon" value="<?php echo esc_attr( $brand['favicon_url'] ); ?>">
                                <input type="hidden" id="options_site_favicon_id" name="options_site_favicon_id" value="<?php echo esc_attr( $brand['favicon_id'] ); ?>">
                            </div>
                            <p class="description" style="margin-top: 8px;">
                                Icon kecil yang tampil di tab browser pengunjung, bookmark, dan pintasan mobile. Rekomendasi gambar: format <strong>PNG transparan, ICO, atau WebP</strong> berbentuk bujur sangkar (1:1), resolusi minimal <strong>512 &times; 512 piksel</strong>.
                            </p>
                        </td>
                    </tr>

                    <!-- Tinggi Logo di Navbar -->
                    <tr>
                        <th scope="row">
                            <label for="options_site_logo_height">Tinggi Logo di Navbar:</label>
                        </th>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <input type="number" id="options_site_logo_height" name="options_site_logo_height" value="<?php echo esc_attr( $brand['logo_height'] ); ?>" min="24" max="70" step="2" class="small-text" style="width: 75px; text-align: center; font-weight: bold;">
                                <span style="font-weight: 600; color: #475569;">pixel (px)</span>
                            </div>
                            <p class="description">
                                Default: <strong>42px</strong> (Rekomendasi antara 36px s/d 50px). Lebar akan otomatis menyesuaikan secara proporsional sesuai rasio asli logo tanpa terpotong.
                            </p>
                        </td>
                    </tr>

                    <!-- Mode Tampilan Navbar -->
                    <tr>
                        <th scope="row">
                            <label for="options_site_logo_display">Format Tampilan Navbar:</label>
                        </th>
                        <td>
                            <select id="options_site_logo_display" name="options_site_logo_display" style="min-width: 280px;">
                                <option value="both" <?php selected( $brand['display_mode'], 'both' ); ?>>Logo + Nama Bank &amp; Sub-label (Standar)</option>
                                <option value="logo_only" <?php selected( $brand['display_mode'], 'logo_only' ); ?>>Hanya Logo (Rekomendasi jika logo sudah memuat teks)</option>
                                <option value="text_only" <?php selected( $brand['display_mode'], 'text_only' ); ?>>Hanya Teks Nama &amp; Sub-label (Tanpa gambar)</option>
                            </select>
                            <p class="description">
                                Pilih <strong>"Hanya Logo"</strong> jika berkas logo yang Anda unggah sudah merupakan logo horizontal lengkap dengan tulisan nama bank, sehingga teks tidak muncul dua kali.
                            </p>
                        </td>
                    </tr>

                    <!-- Nama Bank / Perusahaan -->
                    <tr>
                        <th scope="row">
                            <label for="options_site_brand_name">Nama Perusahaan / Bank:</label>
                        </th>
                        <td>
                            <input type="text" id="options_site_brand_name" name="options_site_brand_name" value="<?php echo esc_attr( $brand['name'] ); ?>" class="regular-text" style="width: 100%; max-width: 450px;" required>
                            <p class="description">Nama brand utama yang tampil di sebelah logo pada Navbar dan Footer (Contoh: <code>Bank Syariah Wakalumi</code>).</p>
                        </td>
                    </tr>

                    <!-- Sub-label / Tagline -->
                    <tr>
                        <th scope="row">
                            <label for="options_site_brand_tagline">Sub-label / Kategori / Tagline:</label>
                        </th>
                        <td>
                            <input type="text" id="options_site_brand_tagline" name="options_site_brand_tagline" value="<?php echo esc_attr( $brand['tagline'] ); ?>" class="regular-text" style="width: 100%; max-width: 450px;">
                            <p class="description">Teks kecil aksen di bawah nama bank (Contoh: <code>BPRS</code> atau <code>Bank Perekonomian Rakyat Syariah</code>). Kosongkan jika tidak diperlukan.</p>
                        </td>
                    </tr>
                </table>

                <div style="margin: 35px 0 25px 0; border-top: 1px solid #e2e8f0;"></div>

                <!-- SEKSI 2: WHATSAPP CS -->
                <h2 style="font-size: 16px; margin-top: 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    💬 WhatsApp Customer Service Global
                </h2>
                <p style="color: #64748b; font-size: 13px;">
                    Nomor WhatsApp ini digunakan secara otomatis di seluruh website: Tombol WhatsApp mengambang (floating button), tombol di navbar atas, dan tombol aksi lainnya.
                </p>

                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="options_contact_wa">Nomor WhatsApp CS:</label></th>
                        <td>
                            <input type="text" id="options_contact_wa" name="options_contact_wa" value="<?php echo esc_attr( $wa ); ?>" class="regular-text" required>
                            <p class="description">Gunakan format internasional tanpa tanda plus (+), contoh: <code>6281517380388</code></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_contact_wa_message">Pesan Otomatis Awal:</label></th>
                        <td>
                            <textarea id="options_contact_wa_message" name="options_contact_wa_message" rows="2" class="large-text"><?php echo esc_textarea( $wa_msg ); ?></textarea>
                            <p class="description">Teks yang langsung terketik saat nasabah mengklik tautan chat WhatsApp.</p>
                        </td>
                    </tr>
                </table>

                <div style="margin: 35px 0 25px 0; border-top: 1px solid #e2e8f0;"></div>

                <!-- SEKSI 3: PENGATURAN SEO & PRATINJAU WHATSAPP / GOOGLE -->
                <h2 style="font-size: 16px; margin-top: 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🔍 Pengaturan SEO &amp; Pratinjau Mesin Pencari (Google &amp; Share WhatsApp)
                </h2>
                <p style="color: #64748b; font-size: 13px;">
                    Pengaturan ini mengoptimalkan tampilan website di hasil pencarian Google (Meta Description, Keywords, Schema.org Perbankan Syariah) serta kartu pratinjau otomatis ketika link website dibagikan di WhatsApp/Sosial Media.
                </p>

                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="options_seo_meta_desc">Deskripsi Meta Google (Meta Description):</label></th>
                        <td>
                            <textarea id="options_seo_meta_desc" name="options_seo_meta_desc" rows="3" class="large-text"><?php echo esc_textarea( $seo_desc ); ?></textarea>
                            <p class="description">Ringkasan resmi bank (ideal 140–165 karakter) yang muncul di bawah judul website pada hasil pencarian Google dan pratinjau chat WhatsApp.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_seo_keywords">Kata Kunci Pencarian (Meta Keywords):</label></th>
                        <td>
                            <input type="text" id="options_seo_keywords" name="options_seo_keywords" value="<?php echo esc_attr( $seo_kw ); ?>" class="large-text">
                            <p class="description">Pisahkan dengan tanda koma (contoh: <code>Bank Syariah Wakalumi, BPRS Wakalumi, BSW, Tabungan Syariah, Deposito Syariah, Pembiayaan Syariah</code>).</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_seo_og_image">Gambar Thumbnail Share WhatsApp (OG Image):</label></th>
                        <td>
                            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                                <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px; padding: 8px; display: inline-flex; align-items: center; justify-content: center; min-width: 140px; min-height: 74px;">
                                    <img id="seo_og_preview" src="<?php echo esc_url( $seo_og_img ); ?>" style="max-height: 70px; max-width: 180px; object-fit: cover; border-radius: 4px; <?php echo empty( $seo_og_img ) ? 'display:none;' : ''; ?>" alt="Preview OG" />
                                    <span class="wkl-placeholder" style="<?php echo ! empty( $seo_og_img ) ? 'display:none;' : ''; ?> color: #94a3b8; font-size: 11px;">Otomatis Gunakan Logo</span>
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <button type="button" class="button button-secondary wkl-upload-btn" data-target="options_seo_og_image" data-preview="seo_og_preview" data-target-id="options_seo_og_image_id" style="display: inline-flex; align-items: center; gap: 5px;">
                                        <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Pilih Gambar Banner Share
                                    </button>
                                    <button type="button" class="button-link wkl-remove-btn" data-target="options_seo_og_image" data-preview="seo_og_preview" data-target-id="options_seo_og_image_id" style="color: #ef4444; font-size: 12px; <?php echo empty( $seo_og_img ) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus Gambar
                                    </button>
                                </div>
                                <input type="hidden" id="options_seo_og_image" name="options_seo_og_image" value="<?php echo esc_attr( $seo_og_img ); ?>">
                                <input type="hidden" id="options_seo_og_image_id" name="options_seo_og_image_id" value="<?php echo esc_attr( $seo_og_id ); ?>">
                            </div>
                            <p class="description" style="margin-top: 8px;">Gambar yang muncul saat link website dibagikan di WhatsApp/Facebook/LinkedIn (Rekomendasi: 1200 &times; 630 piksel). Jika dikosongkan, otomatis menggunakan Logo Utama Bank.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_seo_google_verify">Kode Verifikasi Google Search Console <span style="font-weight: normal; color: #94a3b8;">(Opsional)</span>:</label></th>
                        <td>
                            <input type="text" id="options_seo_google_verify" name="options_seo_google_verify" value="<?php echo esc_attr( $seo_gver ); ?>" class="regular-text" placeholder="Contoh: aBcDeFgHiJkLmNoPqRsTuVwXyZ123456">
                            <p class="description">Jika Anda mendaftarkan domain di Google Search Console dengan metode <em>HTML Tag</em>, cukup tempelkan kode kontennya di sini.</p>
                        </td>
                    </tr>
                </table>

                <p class="submit" style="margin-top: 25px; border-top: 1px solid #f1f5f9; padding-top: 15px;">
                    <button type="submit" name="wakalumi_save_general" class="button button-primary button-large" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 25px;">
                        Simpan Identitas, WhatsApp &amp; SEO
                    </button>
                </p>
            </form>
        </div>

        <script>
        jQuery(document).ready(function($) {
            // Live sync favicon preview on realistic browser tab simulation
            $('#options_site_favicon').on('change', function() {
                var v = $(this).val();
                if (v) {
                    $('#site_favicon_tab_preview').attr('src', v).show();
                    $('#site_favicon_tab_placeholder').hide();
                } else {
                    $('#site_favicon_tab_preview').attr('src', '').hide();
                    $('#site_favicon_tab_placeholder').show();
                }
            });

            // Live sync tab title when company name is modified
            $('#options_site_brand_name').on('input', function() {
                var name = $(this).val().trim();
                $('#tab_preview_title').text(name || 'Bank Syariah Wakalumi');
            });
        });
        </script>
    </div>
    <?php
}


/**
 * Helper: Clean & extract Google Maps embed URL
 * Handles raw URL (https://www.google.com/maps/embed?...) or full <iframe ...> embed code
 */
function wakalumi_clean_maps_embed_url( $raw ) {
    if ( empty( $raw ) ) return '';
    $raw = wp_unslash( trim( $raw ) );
    $decoded = htmlspecialchars_decode( $raw );
    if ( preg_match( '/src=["\']([^"\']+)["\']/', $decoded, $m ) ) {
        return esc_url_raw( $m[1] );
    }
    return esc_url_raw( $raw );
}

/**
 * ─────────────────────────────────────────────────────────────
 * 2. DATA HELPERS: MEDIA SOSIAL PERSEROAN
 * ─────────────────────────────────────────────────────────────
 */

if ( ! function_exists( 'wakalumi_get_default_social_media_list' ) ) {
    /**
     * Default resmi media sosial Bank Syariah Wakalumi (Instagram, Facebook, LinkedIn - tanpa YouTube default).
     *
     * @return array
     */
    function wakalumi_get_default_social_media_list() {
        return [
            [
                'id'        => 'soc_ig',
                'platform'  => 'instagram',
                'title'     => 'Instagram',
                'nama_akun' => '@bprswakalumi',
                'subtitle'  => 'Warta Visual & Edukasi',
                'desc'      => 'Rangkuman infografis produk, tips perencanaan finansial berkah, dan sorotan kegiatan insan BSW.',
                'url'       => get_option( 'options_social_instagram', 'https://www.instagram.com/bprswakalumi' ),
                'btn_text'  => 'Ikuti @bprswakalumi',
                'urutan'    => 1,
                'status'    => 'aktif',
            ],
            [
                'id'        => 'soc_fb',
                'platform'  => 'facebook',
                'title'     => 'Facebook',
                'nama_akun' => 'BPR Syariah Wakalumi',
                'subtitle'  => 'Komunitas & CSR',
                'desc'      => 'Informasi kegiatan sosial kemasyarakatan, publikasi penyaluran dana CSR, dan artikel keluarga syariah.',
                'url'       => get_option( 'options_social_facebook', 'https://facebook.com/bprswakalumi' ),
                'btn_text'  => 'Kunjungi Facebook',
                'urutan'    => 2,
                'status'    => 'aktif',
            ],
            [
                'id'        => 'soc_li',
                'platform'  => 'linkedin',
                'title'     => 'LinkedIn',
                'nama_akun' => 'PT BPRS Wakalumi',
                'subtitle'  => 'Korporasi & Karir',
                'desc'      => 'Jejaring profesional perbankan syariah, publikasi tata kelola GCG, dan profil kepemimpinan bank.',
                'url'       => get_option( 'options_social_linkedin', 'https://linkedin.com/company/bprswakalumi' ),
                'btn_text'  => 'Ikuti di LinkedIn',
                'urutan'    => 3,
                'status'    => 'aktif',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_social_media_list' ) ) {
    /**
     * Mengambil daftar media sosial resmi dari wp_options (Full CRUD dinamis).
     *
     * @return array
     */
    function wakalumi_get_social_media_list() {
        $saved = get_option( 'options_social_media_list', null );
        if ( is_array( $saved ) && ! empty( $saved ) ) {
            uasort( $saved, fn( $a, $b ) => ( (int)( $a['urutan'] ?? 0 ) ) <=> ( (int)( $b['urutan'] ?? 0 ) ) );
            return array_values( $saved );
        }
        $defaults = wakalumi_get_default_social_media_list();
        update_option( 'options_social_media_list', $defaults );
        return $defaults;
    }
}

if ( ! function_exists( 'wakalumi_get_social_platform_config' ) ) {
    /**
     * Konfigurasi styling visual, warna border, ikon SVG, dan badge per platform media sosial.
     *
     * @param string $platform
     * @return array
     */
    function wakalumi_get_social_platform_config( $platform = 'custom' ) {
        $configs = [
            'instagram' => [
                'name'         => 'Instagram',
                'icon_bg'      => 'bg-gradient-to-tr from-[#f09433] via-[#dc2743] to-[#bc1888] text-white',
                'border_grad'  => 'from-pink-500/30 via-rose-500/20 to-amber-500/30 hover:from-pink-500 hover:to-amber-500 hover:shadow-pink-500/15',
                'badge_class'  => 'bg-pink-50 dark:bg-pink-950/70 text-pink-700 dark:text-pink-300 border-pink-200/80',
                'link_class'   => 'text-pink-700 dark:text-pink-400 hover:text-pink-800 dark:hover:text-pink-300',
                'svg'          => '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
            ],
            'facebook' => [
                'name'         => 'Facebook',
                'icon_bg'      => 'bg-[#1877F2] text-white',
                'border_grad'  => 'from-blue-500/30 via-blue-600/20 to-sky-500/30 hover:from-blue-600 hover:to-sky-500 hover:shadow-blue-500/15',
                'badge_class'  => 'bg-blue-50 dark:bg-blue-950/70 text-blue-700 dark:text-blue-300 border-blue-200/80',
                'link_class'   => 'text-blue-700 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300',
                'svg'          => '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
            ],
            'linkedin' => [
                'name'         => 'LinkedIn',
                'icon_bg'      => 'bg-[#0A66C2] text-white',
                'border_grad'  => 'from-sky-600/30 via-blue-700/20 to-teal-500/30 hover:from-sky-600 hover:to-teal-500 hover:shadow-sky-600/15',
                'badge_class'  => 'bg-sky-50 dark:bg-sky-950/70 text-sky-700 dark:text-sky-300 border-sky-200/80',
                'link_class'   => 'text-sky-700 dark:text-sky-400 hover:text-sky-800 dark:hover:text-sky-300',
                'svg'          => '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>',
            ],
            'youtube' => [
                'name'         => 'YouTube',
                'icon_bg'      => 'bg-[#FF0000] text-white',
                'border_grad'  => 'from-red-500/30 via-rose-600/20 to-amber-500/30 hover:from-red-600 hover:to-amber-500 hover:shadow-red-500/15',
                'badge_class'  => 'bg-red-50 dark:bg-red-950/70 text-red-700 dark:text-red-300 border-red-200/80',
                'link_class'   => 'text-red-700 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300',
                'svg'          => '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
            ],
            'tiktok' => [
                'name'         => 'TikTok',
                'icon_bg'      => 'bg-slate-950 text-white',
                'border_grad'  => 'from-slate-800/40 via-rose-500/20 to-cyan-400/30 hover:from-cyan-500 hover:to-rose-500 hover:shadow-cyan-500/15',
                'badge_class'  => 'bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200 border-slate-300 dark:border-slate-700',
                'link_class'   => 'text-slate-800 dark:text-cyan-400 hover:text-black dark:hover:text-cyan-300',
                'svg'          => '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-1.01-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>',
            ],
            'x' => [
                'name'         => 'X (Twitter)',
                'icon_bg'      => 'bg-black text-white',
                'border_grad'  => 'from-slate-700/40 via-slate-600/30 to-slate-800/40 hover:from-slate-700 hover:to-slate-900 hover:shadow-slate-500/15',
                'badge_class'  => 'bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-white border-slate-300 dark:border-slate-700',
                'link_class'   => 'text-slate-800 dark:text-slate-200 hover:text-black dark:hover:text-white',
                'svg'          => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
            ],
            'threads' => [
                'name'         => 'Threads',
                'icon_bg'      => 'bg-slate-900 text-white',
                'border_grad'  => 'from-slate-800/40 via-zinc-600/30 to-slate-900/40 hover:from-zinc-700 hover:to-slate-900 hover:shadow-zinc-500/15',
                'badge_class'  => 'bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-white border-slate-300 dark:border-slate-700',
                'link_class'   => 'text-slate-800 dark:text-slate-200 hover:text-black dark:hover:text-white',
                'svg'          => '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.186 24h-.007c-3.581-.024-6.334-1.212-8.184-3.534C2.277 18.252 1.5 15.347 1.5 11.968 1.5 8.59 2.277 5.684 3.995 3.39 5.845 1.069 8.598-.119 12.179-.095c3.604.024 6.376 1.229 8.24 3.582 1.704 2.152 2.471 5.039 2.471 8.58 0 .414-.336.75-.75.75s-.75-.336-.75-.75c0-3.238-.688-5.834-2.17-7.705-1.637-2.067-4.103-3.136-7.332-3.157-3.197-.021-5.632.997-7.237 3.027-1.526 1.93-2.227 4.542-2.227 7.766 0 3.224.701 5.836 2.227 7.766 1.605 2.03 4.04 3.048 7.237 3.027 2.378-.016 4.318-.621 5.766-1.799 1.488-1.211 2.327-2.935 2.427-4.985H12.19c-2.482 0-4.636-1.554-5.361-3.866-.827-2.639.299-5.409 2.678-6.589 1.309-.649 2.8-.829 4.2-.507 1.334.307 2.471 1.085 3.203 2.19.467.705.787 1.521.954 2.417.378-.073.743-.167 1.092-.284.453-.153.882-.338 1.282-.553-.393-2.05-1.341-3.791-2.748-5.042-1.921-1.708-4.524-2.585-7.739-2.607-4.047-.027-7.147 1.353-9.215 4.101C-1.02 13.911-1.02 17.519.539 20.301c1.947 3.475 5.373 5.309 9.907 5.309.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"/></svg>',
            ],
            'telegram' => [
                'name'         => 'Telegram',
                'icon_bg'      => 'bg-[#229ED9] text-white',
                'border_grad'  => 'from-sky-500/30 via-cyan-500/20 to-blue-500/30 hover:from-sky-500 hover:to-cyan-500 hover:shadow-sky-500/15',
                'badge_class'  => 'bg-sky-50 dark:bg-sky-950/70 text-sky-700 dark:text-sky-300 border-sky-200/80',
                'link_class'   => 'text-sky-700 dark:text-sky-400 hover:text-sky-800 dark:hover:text-sky-300',
                'svg'          => '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.18-.357.295-.6.295-.002 0-.003 0-.005 0l.213-3.054 5.56-5.022c.24-.213-.054-.334-.373-.121l-6.869 4.326-2.96-.924c-.643-.204-.657-.643.136-.953l11.57-4.458c.538-.196 1.006.128.832.943z"/></svg>',
            ],
            'custom' => [
                'name'         => 'Lainnya / Website',
                'icon_bg'      => 'bg-teal-600 text-white',
                'border_grad'  => 'from-teal-500/30 via-emerald-500/20 to-cyan-500/30 hover:from-teal-500 hover:to-cyan-500 hover:shadow-teal-500/15',
                'badge_class'  => 'bg-teal-50 dark:bg-teal-950/70 text-teal-700 dark:text-teal-300 border-teal-200/80',
                'link_class'   => 'text-teal-700 dark:text-teal-400 hover:text-teal-800 dark:hover:text-teal-300',
                'svg'          => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>',
            ],
        ];

        return $configs[ $platform ] ?? $configs['custom'];
    }
}

/**
 * ─────────────────────────────────────────────────────────────
 * 2. RENDER: KONTAK & PETA MAPS
 * ─────────────────────────────────────────────────────────────
 */
function wakalumi_render_contact_page() {
    if ( isset( $_POST['wakalumi_save_contact'] ) && check_admin_referer( 'wakalumi_contact_nonce' ) ) {
        // 1. Header Banner
        update_option( 'options_contact_page_badge', sanitize_text_field( $_POST['options_contact_page_badge'] ?? '' ) );
        update_option( 'options_contact_page_title', sanitize_text_field( $_POST['options_contact_page_title'] ?? '' ) );
        update_option( 'options_contact_page_desc', sanitize_textarea_field( $_POST['options_contact_page_desc'] ?? '' ) );

        // 2. Kontak Langsung
        update_option( 'options_contact_wa', sanitize_text_field( $_POST['options_contact_wa'] ?? '' ) );
        update_option( 'options_contact_phone', sanitize_text_field( $_POST['options_contact_phone'] ?? '' ) );
        update_option( 'options_contact_email', sanitize_email( $_POST['options_contact_email'] ?? '' ) );
        update_option( 'options_contact_address', sanitize_textarea_field( $_POST['options_contact_address'] ?? '' ) );

        // 3. Media Sosial Repeater (Full CRUD)
        $soc_ids       = $_POST['soc_id'] ?? [];
        $soc_platforms = $_POST['soc_platform'] ?? [];
        $soc_titles    = $_POST['soc_title'] ?? [];
        $soc_namas     = $_POST['soc_nama_akun'] ?? [];
        $soc_subtitles = $_POST['soc_subtitle'] ?? [];
        $soc_descs     = $_POST['soc_desc'] ?? [];
        $soc_urls      = $_POST['soc_url'] ?? [];
        $soc_btn_texts = $_POST['soc_btn_text'] ?? [];
        $soc_urutans   = $_POST['soc_urutan'] ?? [];
        $soc_statuses  = $_POST['soc_status'] ?? [];

        $new_social_list = [];
        for ( $s = 0; $s < count( $soc_platforms ); $s++ ) {
            $platform = sanitize_key( $soc_platforms[$s] ?? 'instagram' );
            $url      = esc_url_raw( $soc_urls[$s] ?? '' );
            $title    = sanitize_text_field( $soc_titles[$s] ?? '' );
            if ( empty( $title ) ) {
                $p_config = wakalumi_get_social_platform_config( $platform );
                $title    = $p_config['name'];
            }

            $new_social_list[] = [
                'id'        => sanitize_key( $soc_ids[$s] ?? ( 'soc_' . uniqid() ) ),
                'platform'  => $platform,
                'title'     => $title,
                'nama_akun' => sanitize_text_field( $soc_namas[$s] ?? '' ),
                'subtitle'  => sanitize_text_field( $soc_subtitles[$s] ?? '' ),
                'desc'      => sanitize_textarea_field( $soc_descs[$s] ?? '' ),
                'url'       => $url,
                'btn_text'  => sanitize_text_field( $soc_btn_texts[$s] ?? '' ),
                'urutan'    => intval( $soc_urutans[$s] ?? ( $s + 1 ) ),
                'status'    => ( isset( $soc_statuses[$s] ) && $soc_statuses[$s] === 'nonaktif' ) ? 'nonaktif' : 'aktif',
            ];
        }

        uasort( $new_social_list, fn( $a, $b ) => ( (int)( $a['urutan'] ?? 0 ) ) <=> ( (int)( $b['urutan'] ?? 0 ) ) );
        update_option( 'options_social_media_list', array_values( $new_social_list ) );

        // Sinkronisasi kompatibilitas dengan opsi legacy (footer & header)
        $legacy_map = [ 'instagram' => '', 'facebook' => '', 'linkedin' => '', 'youtube' => '' ];
        foreach ( $new_social_list as $item ) {
            if ( ( $item['status'] ?? 'aktif' ) === 'aktif' && ! empty( $item['url'] ) ) {
                $p = $item['platform'];
                if ( array_key_exists( $p, $legacy_map ) && empty( $legacy_map[$p] ) ) {
                    $legacy_map[$p] = $item['url'];
                }
            }
        }
        update_option( 'options_social_instagram', $legacy_map['instagram'] );
        update_option( 'options_social_facebook', $legacy_map['facebook'] );
        update_option( 'options_social_linkedin', $legacy_map['linkedin'] );
        update_option( 'options_social_youtube', $legacy_map['youtube'] );
        
        // 4. Google Maps Embed
        if ( isset( $_POST['options_maps_embed'] ) ) {
            update_option( 'options_maps_embed', wakalumi_clean_maps_embed_url( $_POST['options_maps_embed'] ) );
        }
        if ( isset( $_POST['options_footer_maps_title'] ) ) {
            update_option( 'options_footer_maps_title', sanitize_text_field( $_POST['options_footer_maps_title'] ) );
        }

        echo '<div class="notice notice-success is-dismissible"><p><strong>Data Pengaturan Kontak, Media Sosial (Full CRUD) & Lokasi Peta berhasil disimpan!</strong></p></div>';
    }

    $page_badge  = get_option( 'options_contact_page_badge', 'Hubungi Kami' );
    $page_title  = get_option( 'options_contact_page_title', 'Kanal Komunikasi & Layanan Resmi' );
    $page_desc   = get_option( 'options_contact_page_desc', 'Kami siap mendengarkan, melayani, dan memberikan solusi perbankan syariah terbaik untuk Anda. Silakan hubungi kami melalui berbagai saluran resmi yang aman, terpercaya, dan profesional.' );

    $wa          = get_option( 'options_contact_wa', '6281517380388' );
    $phone       = get_option( 'options_contact_phone', '(021) 7401667 - 7490874' );
    $email       = get_option( 'options_contact_email', 'info@bprswakalumi.co.id' );
    $address     = get_option( 'options_contact_address', "Ruko Ciputat Center Blok B-3\nJl. Ir. H. Juanda No. 21, Rempoa\nCiputat Timur, Tangerang Selatan 15412" );

    $social_list = wakalumi_get_social_media_list();

    $maps        = get_option( 'options_maps_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.778980156602!2d106.76267921184164!3d-6.292752361567173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3aa7230643f%3A0xe76da8f0b25c55b0!2sBPR%20Syariah%20Wakalumi.%20PT!5e0!3m2!1sen!2sid!4v1792290594792!5m2!1sen!2sid' );
    $maps_title  = get_option( 'options_footer_maps_title', 'Lokasi Kantor' );

    $platform_options = [
        'instagram' => 'Instagram',
        'facebook'  => 'Facebook',
        'linkedin'  => 'LinkedIn',
        'youtube'   => 'YouTube',
        'tiktok'    => 'TikTok',
        'x'         => 'X (Twitter)',
        'threads'   => 'Threads',
        'telegram'  => 'Telegram',
        'custom'    => 'Lainnya / Website',
    ];
    ?>
    <div class="wrap" style="max-width: 960px; margin-top: 20px;">
        <h1 style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
            <span class="dashicons dashicons-location-alt" style="font-size: 32px; width: 32px; height: 32px; color: #088395;"></span>
            Pengaturan Kontak, Media Sosial (Full CRUD) &amp; Lokasi Peta
        </h1>

        <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <form method="post" action="" id="wakalumi-contact-form">
                <?php wp_nonce_field( 'wakalumi_contact_nonce' ); ?>

                <!-- BAGIAN 1: HEADER BANNER HALAMAN KONTAK -->
                <h2 style="font-size: 16px; margin-top: 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🏷️ Banner Header Halaman Kontak (/kontak/)
                </h2>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="options_contact_page_badge">Lencana (Badge):</label></th>
                        <td>
                            <input type="text" id="options_contact_page_badge" name="options_contact_page_badge" value="<?php echo esc_attr( $page_badge ); ?>" class="regular-text" placeholder="Hubungi Kami">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_contact_page_title">Judul Utama Halaman:</label></th>
                        <td>
                            <input type="text" id="options_contact_page_title" name="options_contact_page_title" value="<?php echo esc_attr( $page_title ); ?>" class="large-text" placeholder="Kanal Komunikasi & Layanan Resmi">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_contact_page_desc">Deskripsi Pengantar:</label></th>
                        <td>
                            <textarea id="options_contact_page_desc" name="options_contact_page_desc" rows="3" class="large-text"><?php echo esc_textarea( $page_desc ); ?></textarea>
                        </td>
                    </tr>
                </table>

                <!-- BAGIAN 2: SALURAN KONTAK UTAMA -->
                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    📞 Saluran Kontak Langsung (WhatsApp, Telepon, Email)
                </h2>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="options_contact_wa">Nomor WhatsApp CS:</label></th>
                        <td>
                            <input type="text" id="options_contact_wa" name="options_contact_wa" value="<?php echo esc_attr( $wa ); ?>" class="regular-text" placeholder="6281517380388">
                            <p class="description">Format internasional tanpa spasi/tanda hubung, contoh: <code>6281517380388</code>.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_contact_phone">Nomor Telepon Kantor:</label></th>
                        <td>
                            <input type="text" id="options_contact_phone" name="options_contact_phone" value="<?php echo esc_attr( $phone ); ?>" class="regular-text">
                            <p class="description">Contoh: <code>(021) 7401667 - 7490874</code></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_contact_email">Alamat Email Resmi:</label></th>
                        <td>
                            <input type="email" id="options_contact_email" name="options_contact_email" value="<?php echo esc_attr( $email ); ?>" class="regular-text">
                            <p class="description">Contoh: <code>info@bprswakalumi.co.id</code></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_contact_address">Alamat Lengkap Kantor Pusat:</label></th>
                        <td>
                            <textarea id="options_contact_address" name="options_contact_address" rows="3" class="large-text"><?php echo esc_textarea( $address ); ?></textarea>
                            <p class="description">Ditampilkan di footer dan halaman kontak.</p>
                        </td>
                    </tr>
                </table>

                <!-- BAGIAN 3: MEDIA SOSIAL RESMI (FULL CRUD REPEATER) -->
                <div style="margin-top: 35px; padding-top: 15px; border-top: 1px solid #eee;">
                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 15px;">
                        <div>
                            <h2 style="font-size: 16px; margin: 0; color: #088395; display: flex; align-items: center; gap: 8px;">
                                <span>🌐</span> Akun Media Sosial Resmi Perseroan (Full CRUD)
                            </h2>
                            <p style="margin: 4px 0 0 0; color: #64748b; font-size: 13px;">
                                Kelola kartu media sosial secara dinamis (tambah akun baru, ganti platform, atur urutan, atau hapus). Saluran yang belum memiliki akun (seperti YouTube) dapat dihapus atau dinonaktifkan, dan akan otomatis hilang dari website.
                            </p>
                        </div>
                        <button type="button" id="btn-add-social" class="button button-secondary" style="font-weight: 700; color: #088395; border-color: #088395; border-radius: 6px; padding: 4px 14px;">
                            + Tambah Media Sosial
                        </button>
                    </div>

                    <div id="social-repeater-container" style="display: flex; flex-direction: column; gap: 14px;">
                        <?php 
                        foreach ( $social_list as $s_idx => $s_item ) : 
                            $s_id       = esc_attr( $s_item['id'] ?? ( 'soc_' . $s_idx ) );
                            $s_platform = esc_attr( $s_item['platform'] ?? 'instagram' );
                            $s_title    = esc_attr( $s_item['title'] ?? ucfirst( $s_platform ) );
                            $s_nama     = esc_attr( $s_item['nama_akun'] ?? '' );
                            $s_subtitle = esc_attr( $s_item['subtitle'] ?? '' );
                            $s_desc     = esc_textarea( $s_item['desc'] ?? '' );
                            $s_url      = esc_url( $s_item['url'] ?? '' );
                            $s_btn      = esc_attr( $s_item['btn_text'] ?? '' );
                            $s_urutan   = intval( $s_item['urutan'] ?? ( $s_idx + 1 ) );
                            $s_status   = esc_attr( $s_item['status'] ?? 'aktif' );
                            $is_active  = ( $s_status === 'aktif' );
                        ?>
                            <div class="social-card-item" data-index="<?php echo $s_idx; ?>" style="background: <?php echo $is_active ? '#f8fafc' : '#f1f5f9'; ?>; border: 1px solid #cbd5e1; border-left: 4px solid <?php echo $is_active ? '#088395' : '#94a3b8'; ?>; border-radius: 8px; padding: 16px;">
                                <input type="hidden" name="soc_id[]" value="<?php echo $s_id; ?>">

                                <!-- Header Kartu -->
                                <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0; flex-wrap: wrap;">
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span style="font-weight: 800; font-size: 13px; color: #0f172a;">
                                            #<span class="soc-order-num"><?php echo $s_urutan; ?></span> — <span class="soc-title-preview"><?php echo $s_title; ?></span>
                                        </span>
                                        <span class="soc-platform-badge" style="font-size: 10px; font-weight: 800; text-transform: uppercase; padding: 2px 8px; border-radius: 999px; background: #e0f2fe; color: #0369a1;">
                                            <?php echo strtoupper( $s_platform ); ?>
                                        </span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <label style="font-size: 12px; font-weight: 600; color: #475569; display: flex; align-items: center; gap: 4px; cursor: pointer;">
                                            <input type="checkbox" name="soc_status[<?php echo $s_idx; ?>]" value="aktif" <?php checked( $is_active ); ?> class="soc-status-toggle">
                                            <span>Tampilkan di Website</span>
                                        </label>
                                        <button type="button" class="button-link btn-del-social" style="color: #ef4444; font-size: 12px; text-decoration: none; font-weight: 600;">
                                            ✕ Hapus
                                        </button>
                                    </div>
                                </div>

                                <!-- Grid Input Fields -->
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; margin-bottom: 10px;">
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Platform:</label>
                                        <select name="soc_platform[]" class="soc-platform-select" style="width: 100%; font-size: 12px;">
                                            <?php foreach ( $platform_options as $p_val => $p_lbl ) : ?>
                                                <option value="<?php echo esc_attr( $p_val ); ?>" <?php selected( $s_platform, $p_val ); ?>><?php echo esc_html( $p_lbl ); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Judul Platform:</label>
                                        <input type="text" name="soc_title[]" value="<?php echo $s_title; ?>" class="soc-title-input" placeholder="Contoh: Instagram" style="width: 100%; font-size: 12px;" required>
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Nama Akun / Handle:</label>
                                        <input type="text" name="soc_nama_akun[]" value="<?php echo $s_nama; ?>" placeholder="Contoh: @bprswakalumi" style="width: 100%; font-size: 12px;">
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Kategori / Subtitle:</label>
                                        <input type="text" name="soc_subtitle[]" value="<?php echo $s_subtitle; ?>" placeholder="Contoh: Warta Visual & Edukasi" style="width: 100%; font-size: 12px;">
                                    </div>
                                </div>

                                <div style="display: grid; grid-template-columns: 2fr 1fr 70px; gap: 12px; margin-bottom: 10px;">
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">URL Akun / Kanal:</label>
                                        <input type="url" name="soc_url[]" value="<?php echo $s_url; ?>" placeholder="https://..." style="width: 100%; font-size: 12px;" required>
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Teks Tombol Tautan:</label>
                                        <input type="text" name="soc_btn_text[]" value="<?php echo $s_btn; ?>" placeholder="Contoh: Ikuti Akun" style="width: 100%; font-size: 12px;">
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Urutan:</label>
                                        <input type="number" name="soc_urutan[]" value="<?php echo $s_urutan; ?>" class="soc-urutan-input" style="width: 100%; font-size: 12px; text-align: center;">
                                    </div>
                                </div>

                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Deskripsi Singkat Kartu:</label>
                                    <textarea name="soc_desc[]" rows="2" style="width: 100%; font-size: 12px;" placeholder="Deskripsi materi/konten yang dibagikan pada kanal ini..."><?php echo $s_desc; ?></textarea>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- BAGIAN 4: SEMATAN GOOGLE MAPS -->
                <h2 style="font-size: 16px; margin-top: 35px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🗺️ Sematan Google Maps (Halaman Kontak & Footer)
                </h2>
                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; padding: 12px 15px; margin-bottom: 15px;">
                    <p style="margin: 0; font-size: 13px; color: #166534; line-height: 1.5;">
                        <strong>💡 Fleksibel & Praktis:</strong> Anda dapat menempelkan <strong>URL embed langsung</strong> (<code>https://www.google.com/maps/embed?...</code>) ATAU langsung menyalin seluruh <strong>kode HTML iframe</strong> dari Google Maps (<code>&lt;iframe src="..." ...&gt;&lt;/iframe&gt;</code>). Sistem otomatis membersihkan dan mengekstrak tautan peta secara sempurna.
                    </p>
                </div>

                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="options_footer_maps_title">Judul Kolom Peta:</label></th>
                        <td>
                            <input type="text" id="options_footer_maps_title" name="options_footer_maps_title" value="<?php echo esc_attr( $maps_title ); ?>" class="regular-text" placeholder="Lokasi Kantor">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_maps_embed">Kode / URL Embed Google Maps:</label></th>
                        <td>
                            <textarea id="options_maps_embed" name="options_maps_embed" rows="4" class="large-text" placeholder="Tempel URL embed atau kode <iframe src='...'> dari Google Maps di sini..."><?php echo esc_textarea( $maps ); ?></textarea>
                            <p class="description">
                                <strong>Langkah dari Google Maps:</strong> Cari lokasi kantor &rarr; Klik tombol <strong>Bagikan (Share)</strong> &rarr; Pilih tab <strong>Sematkan Peta (Embed a map)</strong> &rarr; Klik <strong>Salin HTML</strong> &rarr; Tempelkan langsung ke kotak di atas.
                            </p>
                        </td>
                    </tr>
                </table>

                <?php if ( ! empty( $maps ) ) : ?>
                    <div style="margin-top: 15px;">
                        <strong style="display: block; margin-bottom: 6px;">Pratinjau Peta Saat Ini:</strong>
                        <div style="max-width: 500px; height: 200px; border-radius: 8px; overflow: hidden; border: 1px solid #cbd5e1; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                            <iframe src="<?php echo esc_url( $maps ); ?>" width="100%" height="100%" style="border:0;" loading="lazy"></iframe>
                        </div>
                    </div>
                <?php endif; ?>

                <p class="submit" style="margin-top: 25px; border-top: 1px solid #f1f5f9; padding-top: 15px;">
                    <button type="submit" name="wakalumi_save_contact" class="button button-primary button-large" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 25px;">
                        Simpan Kontak, Media Sosial & Peta
                    </button>
                </p>
            </form>
        </div>
    </div>

    <!-- JavaScript Dinamis untuk Repeater Media Sosial -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('social-repeater-container');
        const btnAdd    = document.getElementById('btn-add-social');
        if (!container || !btnAdd) return;

        function bindSocialCard(card) {
            const titleInput = card.querySelector('.soc-title-input');
            const titlePrev  = card.querySelector('.soc-title-preview');
            const platSelect = card.querySelector('.soc-platform-select');
            const platBadge  = card.querySelector('.soc-platform-badge');
            const btnDel     = card.querySelector('.btn-del-social');
            const urutInput  = card.querySelector('.soc-urutan-input');
            const orderNum   = card.querySelector('.soc-order-num');
            const statToggle = card.querySelector('.soc-status-toggle');

            if (titleInput && titlePrev) {
                titleInput.addEventListener('input', function() {
                    titlePrev.textContent = this.value.trim() || 'Media Sosial Baru';
                });
            }

            if (platSelect && platBadge) {
                platSelect.addEventListener('change', function() {
                    platBadge.textContent = this.value.toUpperCase();
                    if (titleInput && !titleInput.value) {
                        titleInput.value = this.options[this.selectedIndex].text;
                        if (titlePrev) titlePrev.textContent = titleInput.value;
                    }
                });
            }

            if (urutInput && orderNum) {
                urutInput.addEventListener('input', function() {
                    orderNum.textContent = this.value || '1';
                });
            }

            if (statToggle) {
                statToggle.addEventListener('change', function() {
                    if (this.checked) {
                        card.style.background = '#f8fafc';
                        card.style.borderLeftColor = '#088395';
                    } else {
                        card.style.background = '#f1f5f9';
                        card.style.borderLeftColor = '#94a3b8';
                    }
                });
            }

            if (btnDel) {
                btnDel.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin menghapus kartu media sosial ini?')) {
                        card.remove();
                    }
                });
            }
        }

        container.querySelectorAll('.social-card-item').forEach(bindSocialCard);

        btnAdd.addEventListener('click', function() {
            const count = container.querySelectorAll('.social-card-item').length;
            const newIndex = count;
            const newOrder = count + 1;
            const newId = 'soc_' + Date.now();

            const cardHtml = `
                <div class="social-card-item" data-index="${newIndex}" style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 4px solid #088395; border-radius: 8px; padding: 16px;">
                    <input type="hidden" name="soc_id[]" value="${newId}">
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0; flex-wrap: wrap;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-weight: 800; font-size: 13px; color: #0f172a;">
                                #<span class="soc-order-num">${newOrder}</span> — <span class="soc-title-preview">Media Sosial Baru</span>
                            </span>
                            <span class="soc-platform-badge" style="font-size: 10px; font-weight: 800; text-transform: uppercase; padding: 2px 8px; border-radius: 999px; background: #e0f2fe; color: #0369a1;">
                                INSTAGRAM
                            </span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <label style="font-size: 12px; font-weight: 600; color: #475569; display: flex; align-items: center; gap: 4px; cursor: pointer;">
                                <input type="checkbox" name="soc_status[${newIndex}]" value="aktif" checked class="soc-status-toggle">
                                <span>Tampilkan di Website</span>
                            </label>
                            <button type="button" class="button-link btn-del-social" style="color: #ef4444; font-size: 12px; text-decoration: none; font-weight: 600;">
                                ✕ Hapus
                            </button>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; margin-bottom: 10px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Platform:</label>
                            <select name="soc_platform[]" class="soc-platform-select" style="width: 100%; font-size: 12px;">
                                <option value="instagram" selected>Instagram</option>
                                <option value="facebook">Facebook</option>
                                <option value="linkedin">LinkedIn</option>
                                <option value="youtube">YouTube</option>
                                <option value="tiktok">TikTok</option>
                                <option value="x">X (Twitter)</option>
                                <option value="threads">Threads</option>
                                <option value="telegram">Telegram</option>
                                <option value="custom">Lainnya / Website</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Judul Platform:</label>
                            <input type="text" name="soc_title[]" value="Instagram" class="soc-title-input" placeholder="Contoh: Instagram" style="width: 100%; font-size: 12px;" required>
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Nama Akun / Handle:</label>
                            <input type="text" name="soc_nama_akun[]" value="" placeholder="Contoh: @bprswakalumi" style="width: 100%; font-size: 12px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Kategori / Subtitle:</label>
                            <input type="text" name="soc_subtitle[]" value="" placeholder="Contoh: Warta Visual & Edukasi" style="width: 100%; font-size: 12px;">
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 2fr 1fr 70px; gap: 12px; margin-bottom: 10px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">URL Akun / Kanal:</label>
                            <input type="url" name="soc_url[]" value="" placeholder="https://..." style="width: 100%; font-size: 12px;" required>
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Teks Tombol Tautan:</label>
                            <input type="text" name="soc_btn_text[]" value="" placeholder="Contoh: Ikuti Akun" style="width: 100%; font-size: 12px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Urutan:</label>
                            <input type="number" name="soc_urutan[]" value="${newOrder}" class="soc-urutan-input" style="width: 100%; font-size: 12px; text-align: center;">
                        </div>
                    </div>
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Deskripsi Singkat Kartu:</label>
                        <textarea name="soc_desc[]" rows="2" style="width: 100%; font-size: 12px;" placeholder="Deskripsi materi/konten yang dibagikan pada kanal ini..."></textarea>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', cardHtml);
            const newCard = container.querySelector(`[data-index="${newIndex}"]`);
            if (newCard) bindSocialCard(newCard);
        });
    });
    </script>
    <?php
}


/**
 * ─────────────────────────────────────────────────────────────
 * 3. RENDER: LAYANAN CEPAT & MEDIA BERANDA (Cards, Video, IG)
 * ─────────────────────────────────────────────────────────────
 */
function wakalumi_render_media_page() {
    wp_enqueue_media();
    
    if ( isset( $_POST['wakalumi_save_media'] ) && check_admin_referer( 'wakalumi_media_nonce' ) ) {
        // Layanan Cepat (4 cards)
        for ( $i = 1; $i <= 4; $i++ ) {
            update_option( "options_quick_card_{$i}_title", sanitize_text_field( $_POST["options_quick_card_{$i}_title"] ?? '' ) );
            update_option( "options_quick_card_{$i}_badge", sanitize_text_field( $_POST["options_quick_card_{$i}_badge"] ?? '' ) );
            update_option( "options_quick_card_{$i}_desc", sanitize_text_field( $_POST["options_quick_card_{$i}_desc"] ?? '' ) );
            update_option( "options_quick_card_{$i}_url", esc_url_raw( $_POST["options_quick_card_{$i}_url"] ?? '' ) );
            update_option( "options_quick_card_{$i}_icon", sanitize_text_field( $_POST["options_quick_card_{$i}_icon"] ?? '' ) );
            update_option( "options_quick_card_{$i}_image", esc_url_raw( $_POST["options_quick_card_{$i}_image"] ?? '' ) );
        }

        // Video Profil
        update_option( 'options_video_badge', sanitize_text_field( $_POST['options_video_badge'] ?? 'Company Profile' ) );
        update_option( 'options_video_title', sanitize_text_field( $_POST['options_video_title'] ?? '' ) );
        update_option( 'options_video_desc', sanitize_textarea_field( $_POST['options_video_desc'] ?? '' ) );
        update_option( 'options_video_url', esc_url_raw( $_POST['options_video_url'] ?? '' ) );
        update_option( 'options_video_thumb', esc_url_raw( $_POST['options_video_thumb'] ?? '' ) );

        // Badge Regulasi Hero Atas
        update_option( 'options_hero_reg_desktop', isset( $_POST['options_hero_reg_desktop'] ) ? '1' : '0' );
        update_option( 'options_hero_reg_mobile', isset( $_POST['options_hero_reg_mobile'] ) ? '1' : '0' );
        update_option( 'options_hero_reg_label', sanitize_text_field( $_POST['options_hero_reg_label'] ?? '' ) );
        update_option( 'options_hero_reg_label_mobile', isset( $_POST['options_hero_reg_label_mobile'] ) ? '1' : '0' );

        $hero_labels = $_POST['hero_reg_logos_label'] ?? [];
        $hero_urls   = $_POST['hero_reg_logos_url'] ?? [];
        $hero_logos  = [];
        for ( $i = 0; $i < count($hero_labels); $i++ ) {
            $label = sanitize_text_field( $hero_labels[$i] ?? '' );
            $url   = esc_url_raw( $hero_urls[$i] ?? '' );
            if ( $label || $url ) {
                $hero_logos[] = [ 'label' => $label, 'url' => $url ];
            }
        }
        update_option( 'options_hero_reg_logos', $hero_logos );

        // Badge Jaminan LPS
        update_option( 'options_lps_badge_active', isset( $_POST['options_lps_badge_active'] ) ? '1' : '0' );
        update_option( 'options_lps_badge_logo', esc_url_raw( $_POST['options_lps_badge_logo'] ?? '' ) );
        update_option( 'options_lps_badge_text', sanitize_text_field( $_POST['options_lps_badge_text'] ?? '' ) );
        update_option( 'options_lps_badge_desktop', isset( $_POST['options_lps_badge_desktop'] ) ? '1' : '0' );
        update_option( 'options_lps_badge_mobile', isset( $_POST['options_lps_badge_mobile'] ) ? '1' : '0' );

        // Tentang Kami (Beranda)
        update_option( 'options_about_label', sanitize_text_field( $_POST['options_about_label'] ?? 'Tentang Kami' ) );
        update_option( 'options_about_title', sanitize_text_field( $_POST['options_about_title'] ?? '' ) );
        update_option( 'options_about_content', wp_kses_post( $_POST['options_about_content'] ?? '' ) );
        update_option( 'options_about_image_url', esc_url_raw( $_POST['options_about_image_url'] ?? '' ) );
        update_option( 'options_about_cta_text', sanitize_text_field( $_POST['options_about_cta_text'] ?? 'Selengkapnya' ) );
        update_option( 'options_about_cta_url', esc_url_raw( $_POST['options_about_cta_url'] ?? '' ) );
        update_option( 'options_about_img_mobile_mode', sanitize_text_field( $_POST['options_about_img_mobile_mode'] ?? 'show_top' ) );

        // Tabungan Preview (Section 4 Beranda)
        update_option( 'options_tabungan_sec_badge', sanitize_text_field( $_POST['options_tabungan_sec_badge'] ?? 'Produk Simpanan' ) );
        update_option( 'options_tabungan_sec_title', sanitize_text_field( $_POST['options_tabungan_sec_title'] ?? 'Solusi Tabungan *Syariah Amanah*' ) );
        update_option( 'options_tabungan_sec_desc', sanitize_textarea_field( $_POST['options_tabungan_sec_desc'] ?? '' ) );

        // Instagram Feed (Section 8 Beranda)
        update_option( 'options_ig_badge', sanitize_text_field( $_POST['options_ig_badge'] ?? 'Sosial Media' ) );
        update_option( 'options_ig_title', sanitize_text_field( $_POST['options_ig_title'] ?? 'Aktivitas & *Sosial Media BSW*' ) );
        update_option( 'options_ig_subtitle', sanitize_text_field( $_POST['options_ig_subtitle'] ?? 'Ikuti perjalanan dan literasi keuangan syariah kami di Instagram.' ) );
        
        $submitted_posts = $_POST['options_ig_posts'] ?? [];
        $clean_posts = [];
        if ( is_array( $submitted_posts ) ) {
            foreach ( $submitted_posts as $p_url ) {
                $p_url = esc_url_raw( trim( $p_url ) );
                if ( ! empty( $p_url ) ) {
                    $clean_posts[] = $p_url;
                }
            }
        }
        update_option( 'options_ig_posts', $clean_posts );

        // Berita Terbaru (Section 9 Beranda)
        update_option( 'options_berita_sec_badge', sanitize_text_field( $_POST['options_berita_sec_badge'] ?? 'Berita Terbaru' ) );
        update_option( 'options_berita_sec_title', sanitize_text_field( $_POST['options_berita_sec_title'] ?? 'Berita dari *BSW*' ) );

        echo '<div class="notice notice-success is-dismissible"><p><strong>Layanan Cepat & Media Beranda berhasil disimpan!</strong></p></div>';
    }

    // Default Quick Cards
    $cards = [];
    $default_cards = [
        1 => [ 'title' => 'Pembiayaan Syariah', 'badge' => 'Solusi Usaha', 'desc' => 'Solusi permodalan usaha UMKM, investasi & multiguna tanpa riba.', 'url' => home_url( '/produk/pembiayaan/' ), 'icon' => 'financing', 'image' => '' ],
        2 => [ 'title' => 'Tabungan Syariah', 'badge' => 'Bebas Biaya Adm', 'desc' => 'Simpanan amanah berbasis Wadiah & Mudharabah bebas riba.', 'url' => home_url( '/produk/tabungan-syariah/' ), 'icon' => 'savings', 'image' => '' ],
        3 => [ 'title' => 'Deposito Syariah', 'badge' => 'Bagi Hasil & LPS', 'desc' => 'Investasi berjangka bagi hasil optimal, aman & dijamin LPS.', 'url' => home_url( '/produk/deposito-syariah/' ), 'icon' => 'deposit', 'image' => '' ],
        4 => [ 'title' => 'Simulasi Angsuran', 'badge' => 'Kalkulator Cepat', 'desc' => 'Hitung estimasi plafon, tenor & angsuran bulanan transparan.', 'url' => home_url( '/produk/pembiayaan/#kalkulator' ), 'icon' => 'calculator', 'image' => '' ],
    ];
    for ( $i = 1; $i <= 4; $i++ ) {
        $cards[$i] = [
            'title' => get_option( "options_quick_card_{$i}_title", $default_cards[$i]['title'] ),
            'badge' => get_option( "options_quick_card_{$i}_badge", $default_cards[$i]['badge'] ),
            'desc'  => get_option( "options_quick_card_{$i}_desc", $default_cards[$i]['desc'] ),
            'url'   => get_option( "options_quick_card_{$i}_url", $default_cards[$i]['url'] ),
            'icon'  => get_option( "options_quick_card_{$i}_icon", $default_cards[$i]['icon'] ),
            'image' => get_option( "options_quick_card_{$i}_image", $default_cards[$i]['image'] ),
        ];
    }

    // Hero Regulatory Badge defaults
    $hero_reg_desk    = get_option( 'options_hero_reg_desktop', '1' );
    $hero_reg_mob     = get_option( 'options_hero_reg_mobile', '1' );
    $hero_reg_lbl     = get_option( 'options_hero_reg_label', 'Terdaftar & Diawasi:' );
    $hero_reg_lbl_mob = get_option( 'options_hero_reg_label_mobile', '0' );
    $hero_logos = get_option( 'options_hero_reg_logos', [] );
    if ( empty( $hero_logos ) ) {
        $hero_logos = [
            [ 'label' => 'OJK', 'url' => get_template_directory_uri() . '/assets/img/ojk-logo.png' ],
            [ 'label' => 'LPS', 'url' => get_template_directory_uri() . '/assets/img/lps-logo.png' ],
        ];
    }

    // LPS Badge defaults
    $lps_active = get_option( 'options_lps_badge_active', '1' );
    $lps_logo   = get_option( 'options_lps_badge_logo', get_template_directory_uri() . '/assets/img/lps-logo.png' );
    $lps_text   = get_option( 'options_lps_badge_text', 'Simpanan Dijamin LPS sampai dengan Rp2 Miliar per Nasabah per Bank' );
    $lps_desk   = get_option( 'options_lps_badge_desktop', '1' );
    $lps_mob    = get_option( 'options_lps_badge_mobile', '1' );

    // Tentang Kami defaults
    $abt_label      = get_option( 'options_about_label', 'Motto: Membangun Kualitas Hidup Berkah Sesuai Syariah' );
    $abt_title      = get_option( 'options_about_title', 'Tumbuh Bersama Umat, Melayani Sepenuh Hati' );
    $abt_content    = get_option( 'options_about_content', '<p class="mb-3">PT Bank Perekonomian Rakyat Syariah (BPRS) Wakalumi didirikan oleh Yayasan Wakalumi (Wakaf Karyawan dan Alumni Muslim Citibank) sejak tahun 1989. Kami berkomitmen menyediakan layanan perbankan yang berlandaskan prinsip murni syariah Islam, berkeadilan, dan amanah.</p><p>Dengan fokus pemberdayaan ekonomi umat dan pelaku usaha mikro, kecil, dan menengah (UMKM), BPRS Wakalumi senantiasa berpegang teguh pada nilai <strong>ISHLAH</strong>—terus melakukan perbaikan berkelanjutan demi kemaslahatan bersama.</p>' );
    $abt_image_url  = get_option( 'options_about_image_url', '' );
    $abt_cta_text   = get_option( 'options_about_cta_text', 'Selengkapnya Tentang Kami' );
    $abt_cta_url    = get_option( 'options_about_cta_url', home_url( '/profil/tentang-kami' ) );
    $abt_mob_mode   = get_option( 'options_about_img_mobile_mode', 'show_top' );

    // Video defaults
    $v_badge = get_option( 'options_video_badge', 'Company Profile' );
    $v_title = get_option( 'options_video_title', 'Mengenal Lebih Dekat Bank Syariah Wakalumi' );
    $v_desc  = get_option( 'options_video_desc', 'Berkomitmen menjadi lembaga keuangan syariah terdepan yang berkontribusi nyata dalam memberdayakan ekonomi umat.' );
    $v_url   = get_option( 'options_video_url', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ' );
    $v_thumb = get_option( 'options_video_thumb', '' );

    // Tabungan Preview defaults
    $tab_sec_badge = get_option( 'options_tabungan_sec_badge', 'Produk Simpanan' );
    $tab_sec_title = get_option( 'options_tabungan_sec_title', 'Solusi Tabungan *Syariah Amanah*' );
    $tab_sec_desc  = get_option( 'options_tabungan_sec_desc', 'Ragam pilihan produk simpanan murni syariah tanpa riba, aman dijamin LPS, dan dikelola profesional untuk kemaslahatan Anda.' );

    // Berita defaults
    $berita_sec_badge = get_option( 'options_berita_sec_badge', 'Berita Terbaru' );
    $berita_sec_title = get_option( 'options_berita_sec_title', 'Berita dari *BSW*' );

    // Instagram defaults
    $ig_badge    = get_option( 'options_ig_badge', 'Sosial Media' );
    $ig_title    = get_option( 'options_ig_title', 'Aktivitas & *Sosial Media BSW*' );
    $ig_subtitle = get_option( 'options_ig_subtitle', 'Ikuti perjalanan dan literasi keuangan syariah kami di Instagram.' );
    $ig_posts    = get_option( 'options_ig_posts', [] );
    if ( empty( $ig_posts ) ) {
        $post1 = get_option( 'options_ig_post_1', 'https://www.instagram.com/p/DSW6wx4gWl5/' );
        $post2 = get_option( 'options_ig_post_2', 'https://www.instagram.com/p/DcLJupqTRoo/' );
        $post3 = get_option( 'options_ig_post_3', 'https://www.instagram.com/p/DSW6_3WgUo-/' );
        $ig_posts = array_values( array_filter( [ $post1, $post2, $post3 ] ) );
    }
    if ( empty( $ig_posts ) ) {
        $ig_posts = [
            'https://www.instagram.com/p/DSW6wx4gWl5/',
            'https://www.instagram.com/p/DcLJupqTRoo/',
            'https://www.instagram.com/p/DSW6_3WgUo-/',
        ];
    }
    ?>
    <div class="wrap" style="max-width: 900px; margin-top: 20px;">
        <h1 style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
            <span class="dashicons dashicons-format-gallery" style="font-size: 32px; width: 32px; height: 32px; color: #088395;"></span>
            Pengaturan Layanan Cepat & Media Beranda
        </h1>

        <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <form method="post" action="">
                <?php wp_nonce_field( 'wakalumi_media_nonce' ); ?>

                <h2 style="font-size: 16px; margin-top: 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    ⚡ 4 Kartu Layanan Cepat (Section 2 Beranda)
                </h2>
                <p style="color: #64748b; font-size: 13px;">
                    Kartu kaca melayang di bawah hero slider. Anda dapat menentukan judul, ringkasan, icon/gambar, dan link tujuan untuk masing-masing kartu.
                </p>

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 30px;">
                    <?php for ( $i = 1; $i <= 4; $i++ ) : ?>
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px;">
                            <strong style="display: block; font-size: 14px; margin-bottom: 10px; color: #1e293b;">
                                Kartu <?php echo $i; ?>
                            </strong>
                            <div style="margin-bottom: 8px;">
                                <label style="font-size: 12px; font-weight: 600; color: #475569;">Judul Kartu:</label>
                                <input type="text" name="options_quick_card_<?php echo $i; ?>_title" value="<?php echo esc_attr( $cards[$i]['title'] ); ?>" class="regular-text" style="width: 100%; margin-top: 2px;" required>
                            </div>
                            <div style="margin-bottom: 8px;">
                                <label style="font-size: 12px; font-weight: 600; color: #475569;">Teks Badge / Label Pojok:</label>
                                <input type="text" name="options_quick_card_<?php echo $i; ?>_badge" value="<?php echo esc_attr( $cards[$i]['badge'] ); ?>" class="regular-text" placeholder="Contoh: Solusi Usaha" style="width: 100%; margin-top: 2px;">
                            </div>
                            <div style="margin-bottom: 8px;">
                                <label style="font-size: 12px; font-weight: 600; color: #475569;">Deskripsi Singkat:</label>
                                <input type="text" name="options_quick_card_<?php echo $i; ?>_desc" value="<?php echo esc_attr( $cards[$i]['desc'] ); ?>" class="regular-text" style="width: 100%; margin-top: 2px;">
                            </div>
                            <div style="margin-bottom: 8px;">
                                <label style="font-size: 12px; font-weight: 600; color: #475569;">Pilih Ikon Bawaan:</label>
                                <select name="options_quick_card_<?php echo $i; ?>_icon" style="width: 100%; margin-top: 2px;">
                                    <option value="chart" <?php selected( $cards[$i]['icon'], 'chart' ); ?>>Grafik Naik (Chart)</option>
                                    <option value="card" <?php selected( $cards[$i]['icon'], 'card' ); ?>>Kartu ATM (Card)</option>
                                    <option value="calculator" <?php selected( $cards[$i]['icon'], 'calculator' ); ?>>Kalkulator (Calculator)</option>
                                    <option value="report" <?php selected( $cards[$i]['icon'], 'report' ); ?>>Laporan (Report)</option>
                                    <option value="savings" <?php selected( $cards[$i]['icon'], 'savings' ); ?>>Koin (Savings)</option>
                                    <option value="deposit" <?php selected( $cards[$i]['icon'], 'deposit' ); ?>>Gedung Bank (Deposit)</option>
                                    <option value="financing" <?php selected( $cards[$i]['icon'], 'financing' ); ?>>Berkas (Financing)</option>
                                    <option value="transfer" <?php selected( $cards[$i]['icon'], 'transfer' ); ?>>Panah Transfer (Transfer)</option>
                                    <option value="shield" <?php selected( $cards[$i]['icon'], 'shield' ); ?>>Perisai (Shield)</option>
                                    <option value="investment" <?php selected( $cards[$i]['icon'], 'investment' ); ?>>Pertumbuhan (Investment)</option>
                                </select>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <label style="font-size: 12px; font-weight: 600; color: #475569;">...atau Unggah Gambar Ikon Sendiri:</label>
                                <p style="font-size: 11px; color: #64748b; margin-top: 2px; margin-bottom: 6px;">Jika gambar diisi, gambar ini akan menggantikan ikon bawaan di atas.</p>
                                <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                    <img id="quick_card_<?php echo $i; ?>_preview" src="<?php echo esc_url( $cards[$i]['image'] ); ?>" style="max-width: 60px; max-height: 60px; border-radius: 4px; border: 1px solid #e2e8f0; <?php echo empty($cards[$i]['image']) ? 'display:none;' : ''; ?>" />
                                    <div style="display: flex; flex-direction: column; gap: 6px;">
                                        <button type="button" class="button wkl-upload-btn" data-target="quick_card_<?php echo $i; ?>_image" data-preview="quick_card_<?php echo $i; ?>_preview" style="display: inline-flex; align-items: center; gap: 5px;">
                                            <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Gambar
                                        </button>
                                        <button type="button" class="button-link wkl-remove-btn" data-target="quick_card_<?php echo $i; ?>_image" data-preview="quick_card_<?php echo $i; ?>_preview" style="color: #ef4444; font-size: 12px; <?php echo empty($cards[$i]['image']) ? 'display:none;' : ''; ?>">
                                            ✕ Hapus
                                        </button>
                                    </div>
                                    <input type="text" id="quick_card_<?php echo $i; ?>_image" name="options_quick_card_<?php echo $i; ?>_image" value="<?php echo esc_attr( $cards[$i]['image'] ); ?>" class="regular-text" style="flex: 1; min-width: 150px; display: none;">
                                </div>
                            </div>
                            <div>
                                <label style="font-size: 12px; font-weight: 600; color: #475569;">Tautan / Link Tujuan:</label>
                                <input type="text" name="options_quick_card_<?php echo $i; ?>_url" value="<?php echo esc_attr( $cards[$i]['url'] ); ?>" class="regular-text" style="width: 100%; margin-top: 2px;">
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🎬 Bagian Video Profil (Company Profile)
                </h2>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="options_video_badge">Label / Badge Atas:</label></th>
                        <td>
                            <input type="text" id="options_video_badge" name="options_video_badge" value="<?php echo esc_attr( $v_badge ); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_video_title">Judul Video:</label></th>
                        <td>
                            <input type="text" id="options_video_title" name="options_video_title" value="<?php echo esc_attr( $v_title ); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_video_desc">Keterangan / Sub-teks:</label></th>
                        <td>
                            <textarea id="options_video_desc" name="options_video_desc" rows="2" class="large-text"><?php echo esc_textarea( $v_desc ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_video_url">URL Video YouTube:</label></th>
                        <td>
                            <input type="url" id="options_video_url" name="options_video_url" value="<?php echo esc_attr( $v_url ); ?>" class="large-text" placeholder="https://www.youtube.com/watch?v=...">
                            <p class="description">Saat pengunjung mengklik tombol Play segitiga di beranda, video YouTube ini akan langsung berputar dalam tampilan pop-up (modal).</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>URL Gambar Thumbnail (Opsional):</label></th>
                        <td>
                            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                <img id="video_thumb_preview" src="<?php echo esc_url( $v_thumb ); ?>" style="max-width: 120px; max-height: 80px; border-radius: 8px; border: 1px solid #e2e8f0; <?php echo empty($v_thumb) ? 'display:none;' : ''; ?>" />
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <button type="button" class="button wkl-upload-btn" data-target="options_video_thumb" data-preview="video_thumb_preview" style="display: inline-flex; align-items: center; gap: 5px;">
                                        <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Gambar
                                    </button>
                                    <button type="button" class="button-link wkl-remove-btn" data-target="options_video_thumb" data-preview="video_thumb_preview" style="color: #ef4444; font-size: 12px; <?php echo empty($v_thumb) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus Gambar
                                    </button>
                                </div>
                                <input type="text" id="options_video_thumb" name="options_video_thumb" value="<?php echo esc_attr( $v_thumb ); ?>" class="regular-text" placeholder="...atau tempel URL gambar" style="flex: 1; min-width: 200px;">
                            </div>
                            <p class="description">Jika dikosongkan, akan menggunakan latar belakang default bertema islami yang elegan.</p>
                        </td>
                    </tr>
                </table>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🛡️ Badge Regulasi di Banner Atas (Hero)
                </h2>
                <p style="color: #64748b; font-size: 13px;">
                    Atur visibilitas dan logo lencana resmi yang melayang di slider utama.
                </p>
                <div style="background: #f0fdfa; border: 1px solid #ccfbf1; border-left: 4px solid #088395; border-radius: 6px; padding: 10px 14px; margin-bottom: 15px; font-size: 12px; color: #0f766e;">
                    💡 <strong>Tips Terpadu:</strong> Pengaturan lencana regulasi &amp; jaminan LPS ini kini juga dapat dikelola secara terpusat bersama Slide Banner di menu <a href="admin.php?page=wakalumi-hero&tab=logos" style="font-weight: bold; text-decoration: underline; color: #088395;">Beranda: Hero &amp; Slider</a>.
                </div>
                <table class="form-table">
                    <tr>
                        <th scope="row">Tampilan di Layar Desktop:</th>
                        <td>
                            <label>
                                <input type="checkbox" name="options_hero_reg_desktop" value="1" <?php checked( $hero_reg_desk, '1' ); ?>>
                                <strong>Tampilkan Logo Regulasi/Mitra di Desktop</strong>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tampilan di Layar Ponsel:</th>
                        <td>
                            <label>
                                <input type="checkbox" name="options_hero_reg_mobile" value="1" <?php checked( $hero_reg_mob, '1' ); ?>>
                                <strong>Tampilkan Logo Regulasi/Mitra di Ponsel (Mobile)</strong>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_hero_reg_label">Label Teks Pengantar:</label></th>
                        <td>
                            <input type="text" id="options_hero_reg_label" name="options_hero_reg_label" value="<?php echo esc_attr( $hero_reg_lbl ); ?>" class="regular-text" placeholder="Contoh: Terdaftar & Diawasi:">
                            <p class="description">Teks yang tampil mendampingi deretan logo. <em>Kosongkan jika ingin menyembunyikan/menghapus label teks ini (hanya menampilkan logo saja).</em></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Label Teks di Ponsel (Mobile):</th>
                        <td>
                            <label>
                                <input type="checkbox" name="options_hero_reg_label_mobile" value="1" <?php checked( $hero_reg_lbl_mob, '1' ); ?>>
                                <strong>Tampilkan label teks ini di layar ponsel</strong>
                            </label>
                            <p class="description"><em>Tips:</em> Nonaktifkan opsi ini agar tampilan mobile tetap rapi, bersih, dan ringkas tanpa teks yang memadati layar.</p>
                        </td>
                    </tr>
                </table>

                <div style="margin-top: 15px;">
                    <table class="widefat striped" style="border-radius: 6px; overflow: hidden;">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="width: 40px; text-align: center;">#</th>
                                <th style="width: 140px; text-align: center;">Logo</th>
                                <th>Label Alt text</th>
                                <th style="width: 50px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="hero-logos-tbody" data-name="hero_reg_logos">
                            <?php foreach ( $hero_logos as $idx => $logo ) : 
                                $uid = 'hero_logo_' . $idx . '_' . time();
                            ?>
                            <tr style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
                                <td style="text-align:center; font-weight:bold; color:#64748b;" class="wkl-logo-num"><?php echo $idx + 1; ?></td>
                                <td style="text-align:center;">
                                    <div class="wkl-upload-wrap">
                                        <img id="prev_<?php echo $uid; ?>" src="<?php echo esc_url( $logo['url'] ); ?>" style="max-width:80px; max-height:40px; border-radius:4px; margin:0 auto; <?php echo empty($logo['url']) ? 'display:none;' : ''; ?>" />
                                        <span class="wkl-placeholder" style="display:block; font-size:11px; color:#94a3b8; <?php echo !empty($logo['url']) ? 'display:none;' : ''; ?>">Belum ada</span>
                                        <button type="button" class="button button-small wkl-upload-btn" data-target="inp_<?php echo $uid; ?>" data-preview="prev_<?php echo $uid; ?>" style="margin-top:4px; font-size:11px;">Pilih</button>
                                        <button type="button" class="button-link wkl-remove-btn" data-target="inp_<?php echo $uid; ?>" data-preview="prev_<?php echo $uid; ?>" style="display:<?php echo empty($logo['url']) ? 'none' : 'inline-block'; ?>; color:#ef4444; font-size:11px; margin-top:2px;">Hapus</button>
                                        <input type="hidden" name="hero_reg_logos_url[]" id="inp_<?php echo $uid; ?>" value="<?php echo esc_attr( $logo['url'] ); ?>" />
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="hero_reg_logos_label[]" value="<?php echo esc_attr( $logo['label'] ); ?>" placeholder="Contoh: OJK, LPS..." class="regular-text" style="width:100%;" />
                                </td>
                                <td style="text-align:center;">
                                    <button type="button" class="button-link-delete wkl-remove-logo-row" style="color:#ef4444;" title="Hapus logo ini">&times;</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div style="margin-top: 10px;">
                        <button type="button" class="button wkl-add-logo-row" data-table="hero-logos-tbody" style="display: inline-flex; align-items: center; gap: 5px;">
                            <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> Tambah Logo
                        </button>
                    </div>
                </div>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🛡️ Badge Jaminan LPS
                </h2>
                <p style="color: #64748b; font-size: 13px;">
                    Badge khusus untuk menampilkan informasi penjaminan simpanan oleh LPS.
                </p>
                <table class="form-table">
                    <tr>
                        <th scope="row">Status Badge:</th>
                        <td>
                            <label>
                                <input type="checkbox" name="options_lps_badge_active" value="1" <?php checked( $lps_active, '1' ); ?>>
                                <strong>Aktifkan Badge Jaminan LPS</strong>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tampilan di Layar Desktop:</th>
                        <td>
                            <label>
                                <input type="checkbox" name="options_lps_badge_desktop" value="1" <?php checked( $lps_desk, '1' ); ?>>
                                <strong>Tampilkan di Komputer / Laptop (Desktop)</strong>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tampilan di Layar Ponsel:</th>
                        <td>
                            <label>
                                <input type="checkbox" name="options_lps_badge_mobile" value="1" <?php checked( $lps_mob, '1' ); ?>>
                                <strong>Tampilkan di Layar Ponsel (Mobile / Tablet)</strong>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Logo LPS (Badge):</label></th>
                        <td>
                            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                <img id="lps_badge_preview" src="<?php echo esc_url( $lps_logo ); ?>" style="max-width: 120px; max-height: 80px; border-radius: 8px; border: 1px solid #e2e8f0; <?php echo empty($lps_logo) ? 'display:none;' : ''; ?>" />
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <button type="button" class="button wkl-upload-btn" data-target="options_lps_badge_logo" data-preview="lps_badge_preview" style="display: inline-flex; align-items: center; gap: 5px;">
                                        <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Gambar
                                    </button>
                                    <button type="button" class="button-link wkl-remove-btn" data-target="options_lps_badge_logo" data-preview="lps_badge_preview" style="color: #ef4444; font-size: 12px; <?php echo empty($lps_logo) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus Gambar
                                    </button>
                                </div>
                                <input type="text" id="options_lps_badge_logo" name="options_lps_badge_logo" value="<?php echo esc_attr( $lps_logo ); ?>" class="regular-text" placeholder="...atau tempel URL gambar" style="flex: 1; min-width: 200px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_lps_badge_text">Teks Jaminan LPS:</label></th>
                        <td>
                            <input type="text" id="options_lps_badge_text" name="options_lps_badge_text" value="<?php echo esc_attr( $lps_text ); ?>" class="large-text">
                        </td>
                    </tr>
                </table>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    📖 Bagian "Tentang Kami" (Section 3 Beranda)
                </h2>
                <p style="color: #64748b; font-size: 13px;">
                    Kelola foto, narasi pengantar, dan penataan tampilan khusus mobile untuk bagian profil di beranda.
                </p>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="options_about_label">Label Kecil Atas:</label></th>
                        <td>
                            <input type="text" id="options_about_label" name="options_about_label" value="<?php echo esc_attr( $abt_label ); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_title">Judul Utama:</label></th>
                        <td>
                            <input type="text" id="options_about_title" name="options_about_title" value="<?php echo esc_attr( $abt_title ); ?>" class="large-text">
                            <p class="description">💡 <strong>Dual-Tone:</strong> Gunakan tanda bintang <code>*kata*</code> untuk memberi warna aksen berbeda (Contoh: <code>Tumbuh Bersama *Kebaikan Syariah*</code>). Jika tanpa tanda bintang, kata terakhir otomatis diberi aksen.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_content">Isi Paragraf / Konten:</label></th>
                        <td>
                            <textarea id="options_about_content" name="options_about_content" rows="4" class="large-text"><?php echo esc_textarea( $abt_content ); ?></textarea>
                            <p class="description">Mendukung tag HTML sederhana seperti <code>&lt;p&gt;</code>, <code>&lt;strong&gt;</code>, <code>&lt;br&gt;</code>.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>URL Foto / Gambar:</label></th>
                        <td>
                            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                <img id="about_image_preview" src="<?php echo esc_url( $abt_image_url ); ?>" style="max-width: 120px; max-height: 80px; border-radius: 8px; border: 1px solid #e2e8f0; <?php echo empty($abt_image_url) ? 'display:none;' : ''; ?>" />
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <button type="button" class="button wkl-upload-btn" data-target="options_about_image_url" data-preview="about_image_preview" style="display: inline-flex; align-items: center; gap: 5px;">
                                        <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Gambar
                                    </button>
                                    <button type="button" class="button-link wkl-remove-btn" data-target="options_about_image_url" data-preview="about_image_preview" style="color: #ef4444; font-size: 12px; <?php echo empty($abt_image_url) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus Gambar
                                    </button>
                                </div>
                                <input type="text" id="options_about_image_url" name="options_about_image_url" value="<?php echo esc_attr( $abt_image_url ); ?>" class="regular-text" placeholder="...atau tempel URL gambar (kosongkan untuk default)" style="flex: 1; min-width: 200px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_img_mobile_mode">Tata Letak Gambar di Layar Ponsel (Mobile):</label></th>
                        <td>
                            <fieldset>
                                <label style="display: block; margin-bottom: 6px;">
                                    <input type="radio" name="options_about_img_mobile_mode" value="show_top" <?php checked( $abt_mob_mode, 'show_top' ); ?>>
                                    <strong>Foto di Atas Teks</strong> (Standar tampilan mobile yang menarik secara visual)
                                </label>
                                <label style="display: block; margin-bottom: 6px;">
                                    <input type="radio" name="options_about_img_mobile_mode" value="show_bottom" <?php checked( $abt_mob_mode, 'show_bottom' ); ?>>
                                    <strong>Foto di Bawah Teks</strong> (Memprioritaskan pengunjung membaca teks terlebih dahulu)
                                </label>
                                <label style="display: block;">
                                    <input type="radio" name="options_about_img_mobile_mode" value="hide" <?php checked( $abt_mob_mode, 'hide' ); ?>>
                                    <strong>Sembunyikan Foto di Ponsel</strong> (Hanya tampil di Desktop; menghemat kuota internet dan loading secepat kilat)
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_cta_text">Teks Tombol Aksi:</label></th>
                        <td>
                            <input type="text" id="options_about_cta_text" name="options_about_cta_text" value="<?php echo esc_attr( $abt_cta_text ); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_cta_url">Link Tujuan Tombol:</label></th>
                        <td>
                            <input type="text" id="options_about_cta_url" name="options_about_cta_url" value="<?php echo esc_attr( $abt_cta_url ); ?>" class="large-text">
                        </td>
                    </tr>
                </table>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🏦 Bagian "Produk Tabungan &amp; Simpanan" (Section 4 Beranda)
                </h2>
                <p style="color: #64748b; font-size: 13px;">
                    Kelola label, judul promosi beraksen warna, dan narasi pengantar untuk 4 kartu simpanan unggulan di beranda.
                </p>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="options_tabungan_sec_badge">Label Kecil Atas:</label></th>
                        <td>
                            <input type="text" id="options_tabungan_sec_badge" name="options_tabungan_sec_badge" value="<?php echo esc_attr( $tab_sec_badge ); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_tabungan_sec_title">Judul Utama:</label></th>
                        <td>
                            <input type="text" id="options_tabungan_sec_title" name="options_tabungan_sec_title" value="<?php echo esc_attr( $tab_sec_title ); ?>" class="large-text">
                            <p class="description">💡 <strong>Dual-Tone:</strong> Gunakan <code>*kata*</code> untuk aksen warna (Contoh: <code>Solusi Tabungan *Syariah Amanah*</code>).</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_tabungan_sec_desc">Deskripsi Subjudul:</label></th>
                        <td>
                            <textarea id="options_tabungan_sec_desc" name="options_tabungan_sec_desc" rows="3" class="large-text"><?php echo esc_textarea( $tab_sec_desc ); ?></textarea>
                        </td>
                    </tr>
                </table>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    📸 Bagian Feed Instagram &amp; Media Sosial (Section 8 Beranda)
                </h2>
                <p style="color: #64748b; font-size: 13px;">
                    Anda bebas menambahkan 3, 5, atau lebih postingan Instagram. Tampilan di beranda otomatis mendukung geser/scroll horizontal yang halus.
                </p>
                <table class="form-table" style="margin-bottom: 15px;">
                    <tr>
                        <th scope="row"><label for="options_ig_badge">Label Kecil Atas:</label></th>
                        <td><input type="text" id="options_ig_badge" name="options_ig_badge" value="<?php echo esc_attr( $ig_badge ); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_ig_title">Judul Bagian:</label></th>
                        <td>
                            <input type="text" id="options_ig_title" name="options_ig_title" value="<?php echo esc_attr( $ig_title ); ?>" class="regular-text">
                            <p class="description">💡 <strong>Dual-Tone:</strong> Gunakan tanda bintang <code>*kata*</code> untuk warna aksen (Contoh: <code>Aktivitas &amp; *Sosial Media BSW*</code>).</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_ig_subtitle">Subjudul:</label></th>
                        <td><input type="text" id="options_ig_subtitle" name="options_ig_subtitle" value="<?php echo esc_attr( $ig_subtitle ); ?>" class="large-text"></td>
                    </tr>
                </table>

                <table id="ig-posts-table" class="widefat striped" style="border-radius: 6px; overflow: hidden; margin-bottom: 15px;">
                    <thead>
                        <tr style="background: #f8fafc;">
                            <th style="width: 45px; text-align: center; font-weight: 600;">#</th>
                            <th style="font-weight: 600;">URL Postingan Instagram (Contoh: <code>https://www.instagram.com/p/CODE/</code>)</th>
                            <th style="width: 60px; text-align: center; font-weight: 600;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $ig_posts as $idx => $post_url ) : ?>
                            <tr>
                                <td style="text-align: center; font-weight: bold; color: #64748b;" class="ig-row-num"><?php echo $idx + 1; ?></td>
                                <td>
                                    <input type="url" name="options_ig_posts[]" value="<?php echo esc_attr( $post_url ); ?>" class="large-text" placeholder="https://www.instagram.com/p/..." required>
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" class="button button-link-delete remove-ig-row" style="color: #ef4444;" title="Hapus baris ini">&times;</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div style="margin-bottom: 25px;">
                    <button type="button" id="add-ig-row" class="button" style="display: inline-flex; align-items: center; gap: 5px;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> Tambah Postingan Instagram
                    </button>
                </div>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    📰 Bagian "Berita Terbaru" (Section 9 Beranda)
                </h2>
                <p style="color: #64748b; font-size: 13px;">
                    Kelola label kecil dan judul bagian artikel / berita terbaru di beranda.
                </p>
                <table class="form-table" style="margin-bottom: 15px;">
                    <tr>
                        <th scope="row"><label for="options_berita_sec_badge">Label Kecil Atas:</label></th>
                        <td><input type="text" id="options_berita_sec_badge" name="options_berita_sec_badge" value="<?php echo esc_attr( $berita_sec_badge ); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_berita_sec_title">Judul Bagian:</label></th>
                        <td>
                            <input type="text" id="options_berita_sec_title" name="options_berita_sec_title" value="<?php echo esc_attr( $berita_sec_title ); ?>" class="regular-text">
                            <p class="description">💡 <strong>Dual-Tone:</strong> Gunakan tanda bintang <code>*kata*</code> untuk memberi warna aksen (Contoh: <code>Berita dari *BSW*</code>).</p>
                        </td>
                    </tr>
                </table>

                <p class="submit" style="margin-top: 25px; border-top: 1px solid #f1f5f9; padding-top: 15px;">
                    <button type="submit" name="wakalumi_save_media" class="button button-primary button-large" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 25px;">
                        Simpan Layanan & Media
                    </button>
                </p>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.querySelector('#ig-posts-table tbody');
        const addBtn = document.getElementById('add-ig-row');

        function renumber() {
            const rows = tableBody.querySelectorAll('tr');
            rows.forEach((row, i) => {
                const numCell = row.querySelector('.ig-row-num');
                if (numCell) numCell.textContent = i + 1;
            });
        }

        if (addBtn && tableBody) {
            addBtn.addEventListener('click', function() {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td style="text-align: center; font-weight: bold; color: #64748b;" class="ig-row-num"></td>
                    <td><input type="url" name="options_ig_posts[]" value="" class="large-text" placeholder="https://www.instagram.com/p/..." required></td>
                    <td style="text-align: center;"><button type="button" class="button button-link-delete remove-ig-row" style="color: #ef4444;" title="Hapus baris ini">&times;</button></td>
                `;
                tableBody.appendChild(tr);
                renumber();
            });

            tableBody.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-ig-row')) {
                    if (tableBody.querySelectorAll('tr').length > 1) {
                        e.target.closest('tr').remove();
                        renumber();
                    } else {
                        alert('Minimal harus ada 1 postingan Instagram.');
                    }
                }
            });
        }
    });
    </script>
    <?php
}


/**
 * ─────────────────────────────────────────────────────────────
 * 4. RENDER: INFORMASI NISBAH BAGI HASIL
 * ─────────────────────────────────────────────────────────────
 */
function wakalumi_render_nisbah_page() {
    if ( isset( $_POST['wakalumi_save_nisbah_header'] ) && check_admin_referer( 'wakalumi_nisbah_header_nonce' ) ) {
        update_option( 'options_nisbah_sec_badge', sanitize_text_field( $_POST['options_nisbah_sec_badge'] ?? 'Kinerja Bank' ) );
        update_option( 'options_nisbah_sec_title', sanitize_text_field( $_POST['options_nisbah_sec_title'] ?? 'Realisasi Nisbah *Bagi Hasil*' ) );
        echo '<div class="notice notice-success is-dismissible"><p><strong>Pengaturan judul bagian Nisbah Beranda berhasil disimpan!</strong></p></div>';
    }

    $nisbah_sec_badge = get_option( 'options_nisbah_sec_badge', 'Kinerja Bank' );
    $nisbah_sec_title = get_option( 'options_nisbah_sec_title', 'Realisasi Nisbah *Bagi Hasil*' );
    $current_bulan    = get_option( 'options_nisbah_bulan', 'Agustus 2026' );
    $current_data     = get_option( 'options_nisbah_data', [] );

    if ( empty( $current_data ) ) {
        $current_data = [
            ['nisbah_produk' => 'Tabungan Reguler', 'nisbah_jenis' => 'tabungan', 'nisbah_nasabah' => '15', 'nisbah_bank' => '85', 'nisbah_equiv' => '1.49%'],
            ['nisbah_produk' => 'Tabungan Ukhuwah', 'nisbah_jenis' => 'tabungan', 'nisbah_nasabah' => '10', 'nisbah_bank' => '90', 'nisbah_equiv' => '1.00%'],
            ['nisbah_produk' => 'Deposito 1 Bulan', 'nisbah_jenis' => 'deposito', 'nisbah_nasabah' => '30', 'nisbah_bank' => '70', 'nisbah_equiv' => '2.99%'],
            ['nisbah_produk' => 'Deposito 3 Bulan', 'nisbah_jenis' => 'deposito', 'nisbah_nasabah' => '35', 'nisbah_bank' => '65', 'nisbah_equiv' => '3.48%'],
            ['nisbah_produk' => 'Deposito 6 Bulan', 'nisbah_jenis' => 'deposito', 'nisbah_nasabah' => '40', 'nisbah_bank' => '60', 'nisbah_equiv' => '3.98%'],
            ['nisbah_produk' => 'Deposito 12 Bulan', 'nisbah_jenis' => 'deposito', 'nisbah_nasabah' => '42.5', 'nisbah_bank' => '57.5', 'nisbah_equiv' => '4.23%'],
        ];
    }

    $tab_rows = [];
    $dep_rows = [];
    foreach ( $current_data as $row ) {
        if ( ( $row['nisbah_jenis'] ?? '' ) === 'tabungan' ) {
            $tab_rows[] = $row;
        } else {
            $dep_rows[] = $row;
        }
    }
    ?>
    <div class="wrap" style="max-width: 960px; margin-top: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="display: flex; align-items: center; gap: 10px; font-size: 24px; font-weight: 800; color: #0f172a; margin: 0 0 4px 0;">
                    <span class="dashicons dashicons-chart-area" style="font-size: 30px; width: 30px; height: 30px; color: #088395;"></span>
                    Informasi Nisbah Bagi Hasil Terpusat
                </h1>
                <p style="color: #64748b; font-size: 13px; margin: 0;">
                    Pusat pemantauan data porsi bagi hasil dan equivalent rate yang aktif di <strong>Beranda</strong> dan <strong>Halaman Produk</strong>.
                </p>
            </div>
            <div style="display: inline-flex; align-items: center; gap: 8px; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 6px 14px; border-radius: 20px;">
                <span style="font-size: 12px; font-weight: 700; color: #166534;">Periode Aktif:</span>
                <strong style="color: #047857; font-size: 13px;"><?php echo esc_html( $current_bulan ); ?></strong>
            </div>
        </div>

        <!-- Customization Card for Beranda Header -->
        <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 20px 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
            <form method="post" action="">
                <?php wp_nonce_field( 'wakalumi_nisbah_header_nonce' ); ?>
                <h3 style="margin: 0 0 6px 0; font-size: 15px; font-weight: 800; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-heading" style="color: #088395;"></span>
                    Kustomisasi Judul &amp; Label Bagian Nisbah (Section 5 Beranda)
                </h3>
                <p style="color: #64748b; font-size: 13px; margin: 0 0 16px 0;">
                    Atur teks label kecil dan judul utama bagian nisbah bagi hasil di halaman depan.
                </p>
                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Label Atas / Badge:</label>
                        <input type="text" name="options_nisbah_sec_badge" value="<?php echo esc_attr( $nisbah_sec_badge ); ?>" class="regular-text" style="width: 100%;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Judul Utama:</label>
                        <input type="text" name="options_nisbah_sec_title" value="<?php echo esc_attr( $nisbah_sec_title ); ?>" class="large-text" style="width: 100%;">
                        <p class="description" style="font-size: 12px; color: #64748b; margin-top: 4px;">
                            💡 <strong>Dual-Tone Gradient:</strong> Gunakan tanda bintang <code>*kata*</code> untuk efek gradient warna (Contoh: <code>Realisasi Nisbah *Bagi Hasil*</code>).
                        </p>
                    </div>
                </div>
                <button type="submit" name="wakalumi_save_nisbah_header" class="button button-primary" style="background: #088395; border-color: #066e7d; font-weight: 700; padding: 2px 18px;">
                    Simpan Judul Bagian
                </button>
            </form>
        </div>

        <!-- Single Source of Truth Notice Box -->
        <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-left: 5px solid #3b82f6; border-radius: 10px; padding: 18px 22px; margin-bottom: 25px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
            <h3 style="margin: 0 0 6px 0; font-size: 15px; font-weight: 800; color: #1e40af; display: flex; align-items: center; gap: 8px;">
                <span class="dashicons dashicons-info" style="color: #3b82f6;"></span>
                Pengelolaan Nisbah Kini Terintegrasi di Modul Produk (Single Source of Truth)
            </h3>
            <p style="margin: 0; font-size: 13px; color: #334155; line-height: 1.6;">
                Untuk menghindari tumpang-tindih dan ketidaksinkronan data, seluruh pengaturan produk dan nisbah bagi hasil kini disatukan langsung pada menu <strong>Pengaturan Produk: Simpanan &amp; Deposito</strong>. Data yang diubah pada masing-masing produk otomatis terdistribusi ke kartu Beranda, tabel komparasi, dan kalkulator simulasi.
            </p>
        </div>

        <!-- 2 Quick Action Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <!-- Card 1: Tabungan -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #10b981; border-radius: 12px; padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                        <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; color: #047857; letter-spacing: 0.5px;">Simpanan Syariah</span>
                        <span style="background: #ecfdf5; color: #065f46; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 12px;"><?php echo count( $tab_rows ); ?> Produk Aktif</span>
                    </div>
                    <h3 style="margin: 0 0 8px 0; font-size: 17px; font-weight: 800; color: #0f172a;">
                        Nisbah Tabungan Syariah
                    </h3>
                    <p style="margin: 0 0 16px 0; font-size: 13px; color: #64748b; line-height: 1.5;">
                        Kelola produk simpanan, porsi bagi hasil nasabah, dan equivalent rate yang tampil pada kartu Kinerja Bank di Beranda.
                    </p>
                </div>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-produk-dana&tab=tabungan' ) ); ?>" class="button button-primary" style="background: #10b981; border-color: #059669; font-weight: 700; padding: 6px 18px; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 2px 4px rgba(16,185,129,0.2);">
                    <span class="dashicons dashicons-edit" style="font-size: 16px; width: 16px; height: 16px;"></span> Kelola Nisbah Tabungan
                </a>
            </div>

            <!-- Card 2: Deposito -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #088395; border-radius: 12px; padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                        <span style="font-size: 12px; font-weight: 800; text-transform: uppercase; color: #088395; letter-spacing: 0.5px;">Investasi Berjangka</span>
                        <span style="background: #f0fdfa; color: #115e59; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 12px;"><?php echo count( $dep_rows ); ?> Tenor Aktif</span>
                    </div>
                    <h3 style="margin: 0 0 8px 0; font-size: 17px; font-weight: 800; color: #0f172a;">
                        Nisbah Deposito Mudharabah
                    </h3>
                    <p style="margin: 0 0 16px 0; font-size: 13px; color: #64748b; line-height: 1.5;">
                        Kelola tenor penempatan (1, 3, 6, 12, 24 bulan), porsi nisbah, indikasi eqv. rate, serta catatan fatwa DSN-MUI.
                    </p>
                </div>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-produk-dana&tab=deposito' ) ); ?>" class="button button-primary" style="background: #088395; border-color: #066e7d; font-weight: 700; padding: 6px 18px; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 6px; box-shadow: 0 2px 4px rgba(8,131,149,0.2);">
                    <span class="dashicons dashicons-edit" style="font-size: 16px; width: 16px; height: 16px;"></span> Kelola Nisbah Deposito
                </a>
            </div>
        </div>

        <!-- Live Preview Table -->
        <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                <h3 style="margin: 0; font-size: 16px; font-weight: 800; color: #0f172a;">
                    Status Data Realisasi Nisbah Live Saat Ini
                </h3>
                <span style="font-size: 12px; color: #64748b;">Sumber: <code>options_nisbah_data</code></span>
            </div>

            <table class="widefat striped" style="border-radius: 8px; overflow: hidden;">
                <thead>
                    <tr style="background: #f8fafc;">
                        <th style="font-weight: 700; padding: 10px 14px;">Nama Produk / Tenor</th>
                        <th style="font-weight: 700; width: 130px; padding: 10px 14px;">Kategori</th>
                        <th style="font-weight: 700; width: 120px; padding: 10px 14px;">Nasabah (%)</th>
                        <th style="font-weight: 700; width: 120px; padding: 10px 14px;">Bank (%)</th>
                        <th style="font-weight: 700; width: 140px; padding: 10px 14px;">Indikasi Eqv. Rate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $current_data as $row ) : 
                        $is_tab = ( $row['nisbah_jenis'] ?? '' ) === 'tabungan';
                    ?>
                        <tr>
                            <td style="padding: 10px 14px; font-weight: 600; color: #0f172a;">
                                <?php echo esc_html( $row['nisbah_produk'] ?? '' ); ?>
                            </td>
                            <td style="padding: 10px 14px;">
                                <span style="display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 11px; font-weight: 700; <?php echo $is_tab ? 'background:#ecfdf5; color:#047857;' : 'background:#f0fdfa; color:#0f766e;'; ?>">
                                    <?php echo $is_tab ? 'Tabungan' : 'Deposito'; ?>
                                </span>
                            </td>
                            <td style="padding: 10px 14px; font-weight: 700; color: #0f766e;">
                                <?php echo esc_html( $row['nisbah_nasabah'] ?? '-' ); ?>%
                            </td>
                            <td style="padding: 10px 14px; font-weight: 700; color: #475569;">
                                <?php echo esc_html( $row['nisbah_bank'] ?? '-' ); ?>%
                            </td>
                            <td style="padding: 10px 14px; font-weight: 800; color: #059669;">
                                <?php echo esc_html( $row['nisbah_equiv'] ?? '-' ); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}


/**
 * ─────────────────────────────────────────────────────────────
 * 5. RENDER: FOOTER, JAM KERJA & LEGALITAS
 * ─────────────────────────────────────────────────────────────
 */
function wakalumi_render_footer_page() {
    wp_enqueue_media();
    
    if ( isset( $_POST['wakalumi_save_footer'] ) && check_admin_referer( 'wakalumi_footer_nonce' ) ) {
        update_option( 'options_footer_about', sanitize_textarea_field( $_POST['options_footer_about'] ?? '' ) );
        update_option( 'options_jam_operasional_weekday', sanitize_text_field( $_POST['options_jam_operasional_weekday'] ?? '' ) );
        update_option( 'options_jam_operasional_weekend', sanitize_text_field( $_POST['options_jam_operasional_weekend'] ?? '' ) );
        update_option( 'options_footer_copyright', sanitize_text_field( $_POST['options_footer_copyright'] ?? '' ) );
        update_option( 'options_footer_disclaimer', sanitize_textarea_field( $_POST['options_footer_disclaimer'] ?? '' ) );

        // Logo Regulasi Footer
        update_option( 'options_footer_show_logos', isset( $_POST['options_footer_show_logos'] ) ? '1' : '0' );
        update_option( 'options_footer_logos_desktop', isset( $_POST['options_footer_logos_desktop'] ) ? '1' : '0' );
        update_option( 'options_footer_logos_mobile', isset( $_POST['options_footer_logos_mobile'] ) ? '1' : '0' );
        update_option( 'options_footer_reg_label', sanitize_text_field( $_POST['options_footer_reg_label'] ?? '' ) );
        
        $footer_labels = $_POST['footer_reg_logos_label'] ?? [];
        $footer_urls   = $_POST['footer_reg_logos_url'] ?? [];
        $footer_logos  = [];
        for ( $i = 0; $i < count($footer_labels); $i++ ) {
            $label = sanitize_text_field( $footer_labels[$i] ?? '' );
            $url   = esc_url_raw( $footer_urls[$i] ?? '' );
            if ( $label || $url ) {
                $footer_logos[] = [ 'label' => $label, 'url' => $url ];
            }
        }
        update_option( 'options_footer_reg_logos', $footer_logos );

        // Jadwal Sholat Footer
        update_option( 'options_footer_show_prayer_times', isset( $_POST['options_footer_show_prayer_times'] ) ? '1' : '0' );
        update_option( 'options_footer_prayer_city', sanitize_text_field( $_POST['options_footer_prayer_city'] ?? 'Tangerang Selatan' ) );

        // Corporate Culture (WAQF) Footer
        update_option( 'options_footer_show_culture', isset( $_POST['options_footer_show_culture'] ) ? '1' : '0' );
        update_option( 'options_footer_culture_label', sanitize_text_field( $_POST['options_footer_culture_label'] ?? 'Corporate Culture' ) );
        update_option( 'options_footer_culture_logo', esc_url_raw( $_POST['options_footer_culture_logo'] ?? '' ) );
        update_option( 'options_footer_culture_height', absint( $_POST['options_footer_culture_height'] ?? 99 ) );
        update_option( 'options_footer_culture_url', esc_url_raw( $_POST['options_footer_culture_url'] ?? '' ) );
        update_option( 'options_footer_culture_position', sanitize_key( $_POST['options_footer_culture_position'] ?? 'bottom_left' ) );

        // Google Maps Footer
        if ( isset( $_POST['options_maps_embed'] ) ) {
            update_option( 'options_maps_embed', wakalumi_clean_maps_embed_url( $_POST['options_maps_embed'] ) );
        }
        if ( isset( $_POST['options_footer_maps_title'] ) ) {
            update_option( 'options_footer_maps_title', sanitize_text_field( $_POST['options_footer_maps_title'] ) );
        }

        update_option( 'options_social_instagram', esc_url_raw( $_POST['options_social_instagram'] ?? '' ) );
        update_option( 'options_social_facebook', esc_url_raw( $_POST['options_social_facebook'] ?? '' ) );
        update_option( 'options_social_linkedin', esc_url_raw( $_POST['options_social_linkedin'] ?? '' ) );
        update_option( 'options_social_youtube', esc_url_raw( $_POST['options_social_youtube'] ?? '' ) );

        echo '<div class="notice notice-success is-dismissible"><p><strong>Pengaturan Footer, Jam Kerja & Legalitas berhasil disimpan!</strong></p></div>';
    }

    $f_about    = get_option( 'options_footer_about', 'Bank Syariah modern yang mengutamakan pelayanan prima dan prinsip keadilan untuk kesejahteraan bersama.' );
    $jam_week   = get_option( 'options_jam_operasional_weekday', '08:00 - 15:00 WIB' );
    $jam_end    = get_option( 'options_jam_operasional_weekend', 'Tutup' );
    $copyright  = get_option( 'options_footer_copyright', 'Bank Syariah Wakalumi. All Rights Reserved.' );
    $disclaimer = get_option( 'options_footer_disclaimer', 'BPRS Wakalumi Berizin dan Diawasi Oleh Otoritas Jasa Keuangan (OJK) serta merupakan peserta program penjaminan Lembaga Penjamin Simpanan (LPS).' );

    $show_prayer= get_option( 'options_footer_show_prayer_times', '1' );
    $prayer_city= get_option( 'options_footer_prayer_city', 'Tangerang Selatan' );

    $maps       = get_option( 'options_maps_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.5!2d106.74!3d-6.34!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMjAnMjQuMCJTIDEwNsKwNDQnMjQuMCJF!5e0!3m2!1sen!2sid!4v1' );
    $maps_title = get_option( 'options_footer_maps_title', 'Lokasi Kantor' );

    // Logo Regulasi Footer Defaults
    $show_logos = get_option( 'options_footer_show_logos', '1' );
    $logos_desk     = get_option( 'options_footer_logos_desktop', '1' );
    $logos_mob      = get_option( 'options_footer_logos_mobile', '1' );
    $footer_reg_lbl = get_option( 'options_footer_reg_label', 'Terdaftar & Diawasi:' );
    
    $footer_logos = get_option( 'options_footer_reg_logos', [] );
    if ( empty( $footer_logos ) ) {
        $footer_logos = [
            [ 'label' => 'OJK', 'url' => get_template_directory_uri() . '/assets/img/ojk-logo.png' ],
            [ 'label' => 'LPS', 'url' => get_template_directory_uri() . '/assets/img/lps-logo.png' ],
        ];
    }

    // Corporate Culture (WAQF)
    $show_culture   = get_option( 'options_footer_show_culture', '1' );
    $culture_label  = get_option( 'options_footer_culture_label', 'Corporate Culture' );
    $default_culture_logo = get_template_directory_uri() . '/assets/img/logo-waqf-light.png';
    $culture_logo   = get_option( 'options_footer_culture_logo', $default_culture_logo );
    if ( empty( $culture_logo ) ) {
        $culture_logo = $default_culture_logo;
    }
    $culture_height = get_option( 'options_footer_culture_height', 99 );
    $culture_url    = get_option( 'options_footer_culture_url', '' );
    $culture_pos    = get_option( 'options_footer_culture_position', 'bottom_left' );

    $ig         = get_option( 'options_social_instagram', 'https://www.instagram.com/bprswakalumi' );
    $fb         = get_option( 'options_social_facebook', 'https://facebook.com/bprswakalumi' );
    $li         = get_option( 'options_social_linkedin', 'https://linkedin.com/company/bprswakalumi' );
    $yt         = get_option( 'options_social_youtube', '' );
    ?>
    <div class="wrap" style="max-width: 900px; margin-top: 20px;">
        <h1 style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
            <span class="dashicons dashicons-calendar-alt" style="font-size: 32px; width: 32px; height: 32px; color: #088395;"></span>
            Pengaturan Footer, Jam Operasional & Legalitas
        </h1>

        <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <form method="post" action="">
                <?php wp_nonce_field( 'wakalumi_footer_nonce' ); ?>

                <h2 style="font-size: 16px; margin-top: 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🏢 Jam Operasional Kantor
                </h2>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="options_jam_operasional_weekday">Senin - Jum'at:</label></th>
                        <td>
                            <input type="text" id="options_jam_operasional_weekday" name="options_jam_operasional_weekday" value="<?php echo esc_attr( $jam_week ); ?>" class="regular-text" placeholder="08:00 - 15:00 WIB">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_jam_operasional_weekend">Sabtu, Minggu & Libur:</label></th>
                        <td>
                            <input type="text" id="options_jam_operasional_weekend" name="options_jam_operasional_weekend" value="<?php echo esc_attr( $jam_end ); ?>" class="regular-text" placeholder="Tutup">
                        </td>
                    </tr>
                </table>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🕌 Jadwal Waktu Sholat & Penanggalan Hijriyah
                </h2>
                <table class="form-table">
                    <tr>
                        <th scope="row">Tampilkan di Footer:</th>
                        <td>
                            <label>
                                <input type="checkbox" name="options_footer_show_prayer_times" value="1" <?php checked( $show_prayer, '1' ); ?>>
                                <strong>Aktifkan Widget Jadwal Sholat & Penanggalan Hijriyah di Footer</strong>
                            </label>
                            <p class="description">100% Gratis via API Kemenag / Aladhan. Menampilkan Subuh, Dzuhur, Ashar, Maghrib, Isya dengan indikator waktu sholat berikutnya.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_footer_prayer_city">Kota / Wilayah Acuan:</label></th>
                        <td>
                            <input type="text" id="options_footer_prayer_city" name="options_footer_prayer_city" value="<?php echo esc_attr( $prayer_city ); ?>" class="regular-text" placeholder="Tangerang Selatan">
                            <p class="description">Contoh: <code>Tangerang Selatan</code>, <code>Jakarta</code>, <code>Tangerang</code>.</p>
                        </td>
                    </tr>
                </table>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🗺️ Sematan Google Maps (Kolom Footer)
                </h2>
                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; padding: 12px 15px; margin-bottom: 15px;">
                    <p style="margin: 0; font-size: 13px; color: #166534; line-height: 1.5;">
                        <strong>💡 Fleksibel & Praktis:</strong> Anda dapat menempelkan <strong>URL embed langsung</strong> (<code>https://www.google.com/maps/embed?...</code>) ATAU langsung menyalin seluruh <strong>kode HTML iframe</strong> dari Google Maps. Pengaturan ini otomatis tersinkronisasi juga dengan menu <em>Kontak & Maps</em>.
                    </p>
                </div>

                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="footer_maps_title">Judul Kolom Peta:</label></th>
                        <td>
                            <input type="text" id="footer_maps_title" name="options_footer_maps_title" value="<?php echo esc_attr( $maps_title ); ?>" class="regular-text" placeholder="Lokasi Kantor">
                            <p class="description">Judul heading kolom peta di footer (default: <em>Lokasi Kantor</em>).</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="footer_maps_embed">Kode / URL Embed Google Maps:</label></th>
                        <td>
                            <textarea id="footer_maps_embed" name="options_maps_embed" rows="4" class="large-text" placeholder="Tempel URL embed atau kode <iframe src='...'> dari Google Maps di sini..."><?php echo esc_textarea( $maps ); ?></textarea>
                            <p class="description">
                                <strong>Langkah dari Google Maps:</strong> Cari lokasi kantor &rarr; Klik tombol <strong>Bagikan (Share)</strong> &rarr; Pilih tab <strong>Sematkan Peta (Embed a map)</strong> &rarr; Klik <strong>Salin HTML</strong> &rarr; Tempelkan langsung ke kotak di atas.
                            </p>
                        </td>
                    </tr>
                </table>

                <?php if ( ! empty( $maps ) ) : ?>
                    <div style="margin-top: 15px; margin-bottom: 25px;">
                        <strong style="display: block; margin-bottom: 6px;">Pratinjau Peta Footer Saat Ini:</strong>
                        <div style="max-width: 500px; height: 200px; border-radius: 8px; overflow: hidden; border: 1px solid #cbd5e1; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                            <iframe src="<?php echo esc_url( $maps ); ?>" width="100%" height="100%" style="border:0;" loading="lazy"></iframe>
                        </div>
                    </div>
                <?php endif; ?>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🏛️ Logo Regulasi di Footer
                </h2>
                <p style="color: #64748b; font-size: 13px;">
                    Kelola logo resmi pengawasan perbankan yang tampil tepat di atas pernyataan regulasi di baris bawah website.
                </p>
                <table class="form-table">
                    <tr>
                        <th scope="row">Tampilkan Logo Regulasi:</th>
                        <td>
                            <label>
                                <input type="checkbox" name="options_footer_show_logos" value="1" <?php checked( $show_logos, '1' ); ?>>
                                <strong>Aktifkan Tampilan Logo di Footer</strong>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Opsi Layar Tampilan:</th>
                        <td>
                            <label style="margin-right: 20px;">
                                <input type="checkbox" name="options_footer_logos_desktop" value="1" <?php checked( $logos_desk, '1' ); ?>>
                                Tampilkan di Komputer / Laptop (Desktop)
                            </label>
                            <label>
                                <input type="checkbox" name="options_footer_logos_mobile" value="1" <?php checked( $logos_mob, '1' ); ?>>
                                Tampilkan di Ponsel (Mobile)
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_footer_reg_label">Label Teks Pengantar Footer:</label></th>
                        <td>
                            <input type="text" id="options_footer_reg_label" name="options_footer_reg_label" value="<?php echo esc_attr( $footer_reg_lbl ); ?>" class="regular-text" placeholder="Contoh: Terdaftar & Diawasi:">
                            <p class="description">Teks yang mendampingi logo regulasi di footer. <em>Kosongkan jika ingin menyembunyikan/menghapus label teks ini di footer.</em></p>
                        </td>
                    </tr>
                </table>

                <div style="margin-top: 15px;">
                    <table class="widefat striped" style="border-radius: 6px; overflow: hidden;">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="width: 40px; text-align: center;">#</th>
                                <th style="width: 140px; text-align: center;">Logo</th>
                                <th>Label Alt text</th>
                                <th style="width: 50px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="footer-logos-tbody" data-name="footer_reg_logos">
                            <?php foreach ( $footer_logos as $idx => $logo ) : 
                                $uid = 'footer_logo_' . $idx . '_' . time();
                            ?>
                            <tr style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
                                <td style="text-align:center; font-weight:bold; color:#64748b;" class="wkl-logo-num"><?php echo $idx + 1; ?></td>
                                <td style="text-align:center;">
                                    <div class="wkl-upload-wrap">
                                        <img id="prev_<?php echo $uid; ?>" src="<?php echo esc_url( $logo['url'] ); ?>" style="max-width:80px; max-height:40px; border-radius:4px; margin:0 auto; <?php echo empty($logo['url']) ? 'display:none;' : ''; ?>" />
                                        <span class="wkl-placeholder" style="display:block; font-size:11px; color:#94a3b8; <?php echo !empty($logo['url']) ? 'display:none;' : ''; ?>">Belum ada</span>
                                        <button type="button" class="button button-small wkl-upload-btn" data-target="inp_<?php echo $uid; ?>" data-preview="prev_<?php echo $uid; ?>" style="margin-top:4px; font-size:11px;">Pilih</button>
                                        <button type="button" class="button-link wkl-remove-btn" data-target="inp_<?php echo $uid; ?>" data-preview="prev_<?php echo $uid; ?>" style="display:<?php echo empty($logo['url']) ? 'none' : 'inline-block'; ?>; color:#ef4444; font-size:11px; margin-top:2px;">Hapus</button>
                                        <input type="hidden" name="footer_reg_logos_url[]" id="inp_<?php echo $uid; ?>" value="<?php echo esc_attr( $logo['url'] ); ?>" />
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="footer_reg_logos_label[]" value="<?php echo esc_attr( $logo['label'] ); ?>" placeholder="Contoh: OJK, LPS..." class="regular-text" style="width:100%;" />
                                </td>
                                <td style="text-align:center;">
                                    <button type="button" class="button-link-delete wkl-remove-logo-row" style="color:#ef4444;" title="Hapus logo ini">&times;</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div style="margin-top: 10px;">
                        <button type="button" class="button wkl-add-logo-row" data-table="footer-logos-tbody" style="display: inline-flex; align-items: center; gap: 5px;">
                            <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> Tambah Logo
                        </button>
                    </div>
                </div>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🏛️ Corporate Culture (Budaya Kerja &amp; Tagline WAQF)
                </h2>
                <table class="form-table">
                    <tr>
                        <th scope="row">Status Tampilan:</th>
                        <td>
                            <label style="font-weight: 600;">
                                <input type="checkbox" name="options_footer_show_culture" value="1" <?php checked( $show_culture, '1' ); ?>>
                                Aktifkan / Tampilkan Logo Corporate Culture di Footer
                            </label>
                            <p class="description">Centang opsi ini untuk menampilkan identitas corporate culture (WAQF) di area footer.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_footer_culture_label">Label Teks Pengantar:</label></th>
                        <td>
                            <input type="text" id="options_footer_culture_label" name="options_footer_culture_label" value="<?php echo esc_attr( $culture_label ); ?>" class="regular-text" placeholder="Corporate Culture">
                            <p class="description">Teks kecil di atas logo (Contoh: <code>Corporate Culture</code> atau <code>Budaya Kerja</code>). Kosongkan jika hanya ingin menampilkan gambar logo saja.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_footer_culture_logo">Logo Corporate Culture:</label></th>
                        <td>
                            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                <div style="background: #0f172a; padding: 10px; border-radius: 8px; border: 1px solid #334155; display: inline-flex; align-items: center; justify-content: center; min-width: 120px;">
                                    <img id="culture_logo_preview" src="<?php echo esc_url( $culture_logo ); ?>" style="max-width: 140px; max-height: 48px; object-fit: contain; <?php echo empty( $culture_logo ) ? 'display:none;' : ''; ?>" />
                                    <span class="wkl-placeholder" style="font-size: 11px; color: #94a3b8; <?php echo ! empty( $culture_logo ) ? 'display:none;' : ''; ?>">Belum ada logo</span>
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <button type="button" class="button wkl-upload-btn" data-target="options_footer_culture_logo" data-preview="culture_logo_preview" style="display: inline-flex; align-items: center; gap: 5px;">
                                        <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah / Ganti Logo
                                    </button>
                                    <button type="button" class="button-link wkl-remove-btn" data-target="options_footer_culture_logo" data-preview="culture_logo_preview" style="color: #ef4444; font-size: 12px; <?php echo empty( $culture_logo ) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus
                                    </button>
                                </div>
                                <input type="text" id="options_footer_culture_logo" name="options_footer_culture_logo" value="<?php echo esc_attr( $culture_logo ); ?>" class="regular-text" placeholder="URL Logo Culture" style="flex: 1; min-width: 220px;">
                            </div>
                            <p class="description" style="margin-top: 6px;">Gunakan file berformat PNG transparan (tipe <em>Light/Putih/Kuning</em>) agar serasi dengan latar belakang footer gelap.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_footer_culture_height">Ukuran Tinggi Logo (Pixel):</label></th>
                        <td>
                            <input type="number" id="options_footer_culture_height" name="options_footer_culture_height" value="<?php echo esc_attr( $culture_height ); ?>" min="40" max="150" step="2" class="small-text"> px
                            <p class="description">Tinggi standar saat ini adalah <strong>99px</strong> (30% lebih besar dari ukuran sebelumnya). Rentang dapat disesuaikan hingga 150px.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_footer_culture_position">Posisi di Footer:</label></th>
                        <td>
                            <select id="options_footer_culture_position" name="options_footer_culture_position" style="min-width: 280px;">
                                <option value="bottom_left" <?php selected( $culture_pos, 'bottom_left' ); ?>>Pojok Kiri Bawah (Di Sebelah Kiri Legalitas Rata Tengah) — Standar</option>
                                <option value="column_left" <?php selected( $culture_pos, 'column_left' ); ?>>Kolom Kiri Atas (Di Bawah Sosial Media)</option>
                                <option value="bottom_center" <?php selected( $culture_pos, 'bottom_center' ); ?>>Baris Bawah (Tengah)</option>
                                <option value="both" <?php selected( $culture_pos, 'both' ); ?>>Tampilkan di Keduanya</option>
                            </select>
                            <p class="description">Pilih posisi penempatan logo corporate culture di footer web.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_footer_culture_url">Tautan / Link URL (Opsional):</label></th>
                        <td>
                            <input type="url" id="options_footer_culture_url" name="options_footer_culture_url" value="<?php echo esc_attr( $culture_url ); ?>" class="large-text" placeholder="<?php echo esc_url( home_url( '/tentang-kami' ) ); ?>">
                            <p class="description">Bisa diarahkan ke halaman Tentang Kami atau profil budaya kerja bank (kosongkan jika tidak perlu bisa diklik).</p>
                        </td>
                    </tr>
                </table>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    ⚖️ Teks Footer, Hak Cipta & Pernyataan Regulasi
                </h2>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="options_footer_about">Deskripsi Singkat Footer:</label></th>
                        <td>
                            <textarea id="options_footer_about" name="options_footer_about" rows="2" class="large-text"><?php echo esc_textarea( $f_about ); ?></textarea>
                            <p class="description">Ditampilkan di kolom pertama footer di bawah logo bank.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_footer_disclaimer">Pernyataan Regulasi (OJK & LPS):</label></th>
                        <td>
                            <textarea id="options_footer_disclaimer" name="options_footer_disclaimer" rows="2" class="large-text"><?php echo esc_textarea( $disclaimer ); ?></textarea>
                            <p class="description">Ditampilkan tepat di bawah logo regulasi.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_footer_copyright">Teks Hak Cipta (Paling Bawah):</label></th>
                        <td>
                            <input type="text" id="options_footer_copyright" name="options_footer_copyright" value="<?php echo esc_attr( $copyright ); ?>" class="large-text">
                            <p class="description">Diposisikan di baris paling bawah. Tahun berjalan otomatis ditambahkan (&copy; <?php echo date('Y'); ?> ...).</p>
                        </td>
                    </tr>
                </table>

                <h2 style="font-size: 16px; margin-top: 30px; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395;">
                    🌐 Tautan Media Sosial
                </h2>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="options_social_instagram">Instagram:</label></th>
                        <td><input type="url" id="options_social_instagram" name="options_social_instagram" value="<?php echo esc_attr( $ig ); ?>" class="large-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_social_facebook">Facebook:</label></th>
                        <td><input type="url" id="options_social_facebook" name="options_social_facebook" value="<?php echo esc_attr( $fb ); ?>" class="large-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_social_linkedin">LinkedIn:</label></th>
                        <td><input type="url" id="options_social_linkedin" name="options_social_linkedin" value="<?php echo esc_attr( $li ); ?>" class="large-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_social_youtube">YouTube:</label></th>
                        <td><input type="url" id="options_social_youtube" name="options_social_youtube" value="<?php echo esc_attr( $yt ); ?>" class="large-text" placeholder="https://youtube.com/@..."></td>
                    </tr>
                </table>

                <p class="submit" style="margin-top: 25px; border-top: 1px solid #f1f5f9; padding-top: 15px;">
                    <button type="submit" name="wakalumi_save_footer" class="button button-primary button-large" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 25px;">
                        Simpan Pengaturan Footer
                    </button>
                </p>
            </form>
        </div>
    </div>
    <?php
}
