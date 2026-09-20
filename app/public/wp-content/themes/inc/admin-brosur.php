<?php
/**
 * Admin Page: Pengelolaan Brosur & Dokumen Produk
 * Submenu of wakalumi-settings
 * 
 * Mengelola file brosur PDF resmi, katalog dokumen produk, dan materi literasi BPRS Wakalumi.
 * 
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// ── 1. HELPER FUNCTIONS UNTUK RETRIEVAL FRONTEND ────────────────────

if ( ! function_exists( 'wakalumi_get_brosur_primary' ) ) {
    /**
     * Mengambil data brosur utama resmi BPRS Wakalumi.
     *
     * @return array
     */
    function wakalumi_get_brosur_primary() {
        return [
            'file_url'       => get_option( 'options_brosur_file_url', '' ),
            'file_name'      => get_option( 'options_brosur_file_name', 'Brosur Resmi Produk BPRS Wakalumi (Edisi 2026).pdf' ),
            'file_size'      => get_option( 'options_brosur_file_size', 'PDF Resmi • 2.4 MB' ),
            'cover'          => get_option( 'options_brosur_cover', '' ),
            'desc'           => get_option( 'options_brosur_desc', 'Katalog panduan komprehensif seluruh produk simpanan syariah, deposito mudharabah, dan pembiayaan syariah BPRS Wakalumi.' ),
            'version'        => get_option( 'options_brosur_version', 'Edisi 2026' ),
            'featured_badge' => get_option( 'options_brosur_featured_badge', 'Katalog Resmi Komprehensif' ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_brosur_list' ) ) {
    /**
     * Mengambil daftar seluruh brosur spesifik yang telah diinput admin.
     *
     * @return array
     */
    function wakalumi_get_brosur_list() {
        $list = get_option( 'options_brosur_list', [] );
        if ( ! empty( $list ) && is_array( $list ) ) {
            usort( $list, function( $a, $b ) {
                return (int)( $a['urutan'] ?? 0 ) <=> (int)( $b['urutan'] ?? 0 );
            });
            return $list;
        }

        // Default Starter Data jika belum ada input admin
        return [
            [
                'title'     => 'Brosur Tabungan & Simpanan Syariah',
                'kategori'  => 'Penghimpunan Dana',
                'badge'     => 'Tabungan Syariah',
                'file_url'  => '',
                'file_size' => 'PDF • 1.8 MB',
                'cover'     => '',
                'desc'      => 'Panduan lengkap Tabungan Tawakal, Tabungan Pendidikan, Tabungan Haji & Umroh, serta Tabungan Ukhuwah berhadiah berkah.',
                'version'   => '2026',
                'urutan'    => 1,
                'color'     => 'teal',
            ],
            [
                'title'     => 'Brosur Deposito Mudharabah Muthlaqah',
                'kategori'  => 'Penghimpunan Dana',
                'badge'     => 'Investasi Deposito',
                'file_url'  => '',
                'file_size' => 'PDF • 1.5 MB',
                'cover'     => '',
                'desc'      => 'Penjelasan skema bagi hasil nisbah kompetitif, pilihan tenor 1-12 bulan, fasilitas ARO, dan penjaminan LPS hingga Rp2 Miliar.',
                'version'   => '2026',
                'urutan'    => 2,
                'color'     => 'amber',
            ],
            [
                'title'     => 'Brosur Pembiayaan 1000 Pedagang Pasar',
                'kategori'  => 'Penyaluran Dana',
                'badge'     => 'UMKM & Pedagang',
                'file_url'  => '',
                'file_size' => 'PDF • 2.1 MB',
                'cover'     => '',
                'desc'      => 'Solusi permodalan usaha mikro pedagang pasar tradisional tanpa agunan rumit dengan angsuran harian atau mingguan yang ringan.',
                'version'   => '2026',
                'urutan'    => 3,
                'color'     => 'emerald',
            ],
            [
                'title'     => 'Brosur Pembiayaan 1000 Guru & Tenaga Pendidik',
                'kategori'  => 'Penyaluran Dana',
                'badge'     => 'Profesi Guru',
                'file_url'  => '',
                'file_size' => 'PDF • 1.9 MB',
                'cover'     => '',
                'desc'      => 'Fasilitas pembiayaan multiguna syariah khusus guru dan tenaga kependidikan untuk renovasi rumah, pendidikan keluarga, dan kebutuhan halal.',
                'version'   => '2026',
                'urutan'    => 4,
                'color'     => 'blue',
            ],
            [
                'title'     => 'Ringkasan Akad Syariah (Murabahah, Mudharabah, Ijarah)',
                'kategori'  => 'Program Khusus',
                'badge'     => 'Edukasi Syariah',
                'file_url'  => '',
                'file_size' => 'PDF • 1.2 MB',
                'cover'     => '',
                'desc'      => 'Materi literasi fikih muamalah perbankan syariah menjelaskan perbedaan mendasar prinsip syariah dengan bunga konvensional.',
                'version'   => '2026',
                'urutan'    => 5,
                'color'     => 'purple',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_brosur_governance' ) ) {
    /**
     * Mengambil konfigurasi dan daftar kartu tata kelola & regulasi.
     *
     * @return array
     */
    function wakalumi_get_brosur_governance() {
        $show   = get_option( 'options_brosur_gov_show', 'yes' );
        $kicker = get_option( 'options_brosur_gov_kicker', 'Tata Kelola & Transparansi' );
        $title  = get_option( 'options_brosur_gov_title', 'Keamanan, Legalitas & Kepatuhan Terjamin' );
        $desc   = get_option( 'options_brosur_gov_desc', 'Seluruh produk perbankan syariah dan penerbitan materi informasi BPRS Wakalumi dijalankan berlandaskan regulasi otoritas keuangan nasional dan fatwa syariah.' );

        $cards = get_option( 'options_brosur_gov_cards', [] );
        if ( empty( $cards ) || ! is_array( $cards ) ) {
            $cards = [
                [
                    'badge'     => 'Pengawasan OJK',
                    'title'     => 'Terdaftar & Diawasi OJK',
                    'desc'      => 'BPRS Wakalumi beroperasi di bawah pengawasan ketat Otoritas Jasa Keuangan (OJK) dengan mematuhi standar kehati-hatian perbankan.',
                    'legal_ref' => 'Keputusan Otoritas Jasa Keuangan',
                    'urutan'    => 1,
                    'color'     => 'rose',
                ],
                [
                    'badge'     => 'Jaminan Simpanan',
                    'title'     => 'Penjaminan Simpanan LPS',
                    'desc'      => 'Simpanan tabungan dan deposito nasabah dijamin keamanannya oleh Lembaga Penjamin Simpanan (LPS) hingga Rp 2 Miliar per nasabah per bank.',
                    'legal_ref' => 'UU Penjaminan Simpanan Perbankan',
                    'urutan'    => 2,
                    'color'     => 'blue',
                ],
                [
                    'badge'     => 'Kepatuhan Syariah',
                    'title'     => 'Kepatuhan Dewan Syariah',
                    'desc'      => 'Seluruh produk dan akad disupervisi langsung oleh Dewan Pengawas Syariah (DPS) tersertifikasi DSN-MUI untuk menjamin kemurnian dari riba.',
                    'legal_ref' => 'Fatwa Dewan Syariah Nasional MUI',
                    'urutan'    => 3,
                    'color'     => 'emerald',
                ],
            ];
        } else {
            usort( $cards, function( $a, $b ) {
                return (int)( $a['urutan'] ?? 0 ) <=> (int)( $b['urutan'] ?? 0 );
            });
        }

        return [
            'show'   => ( $show === 'yes' ),
            'kicker' => $kicker,
            'title'  => $title,
            'desc'   => $desc,
            'cards'  => $cards,
        ];
    }
}

// ── 2. REGISTER SUBMENU DI PENGATURAN WEBSITE ────────────────────────
add_action( 'admin_menu', 'wakalumi_register_brosur_page', 24 );
function wakalumi_register_brosur_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Katalog Brosur & Dokumen',
        'Katalog Brosur',
        'manage_options',
        'wakalumi-brosur',
        'wakalumi_render_brosur_page',
        24
    );
}

// ── 3. RENDER ADMIN PAGE & HANDLE SAVE ───────────────────────────────
function wakalumi_render_brosur_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $is_saved = false;

    // Handle POST Save
    if ( isset( $_POST['wakalumi_brosur_submit'] ) && check_admin_referer( 'wakalumi_brosur_save', 'wakalumi_brosur_nonce' ) ) {

        // 1. Pengaturan Header Banner Halaman
        update_option( 'options_brosur_page_badge', sanitize_text_field( wp_unslash( $_POST['options_brosur_page_badge'] ?? 'Dokumen Resmi & Literasi Syariah' ) ) );
        update_option( 'options_brosur_page_title', sanitize_text_field( wp_unslash( $_POST['options_brosur_page_title'] ?? 'Pusat Unduhan Brosur & Panduan Produk' ) ) );
        update_option( 'options_brosur_page_sub', sanitize_textarea_field( wp_unslash( $_POST['options_brosur_page_sub'] ?? 'Akses materi resmi, ringkasan akad syariah, tarif nisbah, dan panduan persyaratan pembukaan rekening serta pengajuan pembiayaan BPRS Wakalumi dalam format digital.' ) ) );

        // 2. Brosur Utama Resmi (Navbar & Spotlight Featured)
        update_option( 'options_brosur_file_url', esc_url_raw( wp_unslash( $_POST['options_brosur_file_url'] ?? '' ) ) );
        update_option( 'options_brosur_file_name', sanitize_text_field( wp_unslash( $_POST['options_brosur_file_name'] ?? '' ) ) );
        update_option( 'options_brosur_file_size', sanitize_text_field( wp_unslash( $_POST['options_brosur_file_size'] ?? '' ) ) );
        update_option( 'options_brosur_cover', esc_url_raw( wp_unslash( $_POST['options_brosur_cover'] ?? '' ) ) );
        update_option( 'options_brosur_desc', sanitize_textarea_field( wp_unslash( $_POST['options_brosur_desc'] ?? '' ) ) );
        update_option( 'options_brosur_version', sanitize_text_field( wp_unslash( $_POST['options_brosur_version'] ?? 'Edisi 2026' ) ) );
        update_option( 'options_brosur_featured_badge', sanitize_text_field( wp_unslash( $_POST['options_brosur_featured_badge'] ?? 'Brosur Resmi Komprehensif' ) ) );

        // 3. Koleksi Brosur Spesifik (Repeater)
        $titles     = wp_unslash( $_POST['brosur_list_title'] ?? [] );
        $kategoris  = wp_unslash( $_POST['brosur_list_kategori'] ?? [] );
        $badges     = wp_unslash( $_POST['brosur_list_badge'] ?? [] );
        $file_urls  = wp_unslash( $_POST['brosur_list_file_url'] ?? [] );
        $file_sizes = wp_unslash( $_POST['brosur_list_file_size'] ?? [] );
        $covers     = wp_unslash( $_POST['brosur_list_cover'] ?? [] );
        $descs      = wp_unslash( $_POST['brosur_list_desc'] ?? [] );
        $versions   = wp_unslash( $_POST['brosur_list_version'] ?? [] );
        $urutans    = wp_unslash( $_POST['brosur_list_urutan'] ?? [] );
        $colors     = wp_unslash( $_POST['brosur_list_color'] ?? [] );

        $brosur_list = [];
        for ( $i = 0; $i < count( $titles ); $i++ ) {
            $title = sanitize_text_field( $titles[$i] ?? '' );
            if ( empty( $title ) ) {
                continue;
            }
            $brosur_list[] = [
                'title'     => $title,
                'kategori'  => sanitize_text_field( $kategoris[$i] ?? 'Penghimpunan Dana' ),
                'badge'     => sanitize_text_field( $badges[$i] ?? 'Brosur Produk' ),
                'file_url'  => esc_url_raw( $file_urls[$i] ?? '' ),
                'file_size' => sanitize_text_field( $file_sizes[$i] ?? 'PDF' ),
                'cover'     => esc_url_raw( $covers[$i] ?? '' ),
                'desc'      => sanitize_textarea_field( $descs[$i] ?? '' ),
                'version'   => sanitize_text_field( $versions[$i] ?? '2026' ),
                'urutan'    => intval( $urutans[$i] ?? ( $i + 1 ) ),
                'color'     => sanitize_text_field( $colors[$i] ?? 'teal' ),
            ];
        }

        // Sort by urutan
        usort( $brosur_list, function( $a, $b ) {
            return $a['urutan'] <=> $b['urutan'];
        });

        update_option( 'options_brosur_list', $brosur_list );

        // 4. Pengaturan Tata Kelola & Transparansi
        $gov_show = isset( $_POST['options_brosur_gov_show'] ) ? 'yes' : 'no';
        update_option( 'options_brosur_gov_show', $gov_show );
        update_option( 'options_brosur_gov_kicker', sanitize_text_field( wp_unslash( $_POST['options_brosur_gov_kicker'] ?? 'Tata Kelola & Transparansi' ) ) );
        update_option( 'options_brosur_gov_title', sanitize_text_field( wp_unslash( $_POST['options_brosur_gov_title'] ?? 'Keamanan, Legalitas & Kepatuhan Terjamin' ) ) );
        update_option( 'options_brosur_gov_desc', sanitize_textarea_field( wp_unslash( $_POST['options_brosur_gov_desc'] ?? '' ) ) );

        $gov_badges = wp_unslash( $_POST['gov_badge'] ?? [] );
        $gov_titles = wp_unslash( $_POST['gov_title'] ?? [] );
        $gov_descs  = wp_unslash( $_POST['gov_desc'] ?? [] );
        $gov_refs   = wp_unslash( $_POST['gov_legal_ref'] ?? [] );
        $gov_orders = wp_unslash( $_POST['gov_urutan'] ?? [] );
        $gov_colors = wp_unslash( $_POST['gov_color'] ?? [] );

        $gov_cards = [];
        for ( $j = 0; $j < count( $gov_titles ); $j++ ) {
            $g_title = sanitize_text_field( $gov_titles[$j] ?? '' );
            if ( empty( $g_title ) ) {
                continue;
            }
            $gov_cards[] = [
                'badge'     => sanitize_text_field( $gov_badges[$j] ?? 'Regulasi' ),
                'title'     => $g_title,
                'desc'      => sanitize_textarea_field( $gov_descs[$j] ?? '' ),
                'legal_ref' => sanitize_text_field( $gov_refs[$j] ?? '' ),
                'urutan'    => intval( $gov_orders[$j] ?? ( $j + 1 ) ),
                'color'     => sanitize_text_field( $gov_colors[$j] ?? 'rose' ),
            ];
        }

        usort( $gov_cards, function( $a, $b ) {
            return $a['urutan'] <=> $b['urutan'];
        });

        update_option( 'options_brosur_gov_cards', $gov_cards );

        $is_saved = true;
    }

    // Ambil Data Opsi
    $page_badge     = get_option( 'options_brosur_page_badge', 'Dokumen Resmi & Literasi Syariah' );
    $page_title     = get_option( 'options_brosur_page_title', 'Pusat Unduhan Brosur & Panduan Produk' );
    $page_sub       = get_option( 'options_brosur_page_sub', 'Akses materi resmi, ringkasan akad syariah, tarif nisbah, dan panduan persyaratan pembukaan rekening serta pengajuan pembiayaan BPRS Wakalumi dalam format digital.' );

    $brosur_primary = wakalumi_get_brosur_primary();
    $brosur_list    = wakalumi_get_brosur_list();
    $brosur_gov     = wakalumi_get_brosur_governance();
    ?>
    <div class="wrap" style="max-width: 1020px; margin-top: 20px;">
        <!-- Header Judul Halaman Admin -->
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px;">
            <div>
                <h1 style="display: flex; align-items: center; gap: 10px; font-weight: 800; color: #0f172a; margin: 0; font-size: 24px;">
                    <span class="dashicons dashicons-media-document" style="font-size: 30px; width: 30px; height: 30px; color: #088395;"></span>
                    Katalog Brosur & Dokumen Digital
                </h1>
                <p style="color: #64748b; font-size: 13.5px; margin: 6px 0 0 0;">
                    Kelola file brosur PDF resmi, kartu pratinjau produk di navbar, serta pilar transparansi & regulasi BPRS Wakalumi.
                </p>
            </div>
            <a href="<?php echo esc_url( home_url( '/brosur/' ) ); ?>" target="_blank" class="button" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 700; border-color: #088395; color: #088395; padding: 4px 14px; border-radius: 8px;">
                <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px;"></span>
                Lihat Halaman Frontend (/brosur/) &rarr;
            </a>
        </div>

        <!-- Panduan Visual & Rekomendasi Upload -->
        <div style="background: #f0fdfa; border: 1px solid #99f6e4; border-left: 4px solid #088395; border-radius: 10px; padding: 14px 18px; margin-bottom: 24px;">
            <div style="font-weight: 700; color: #0f766e; font-size: 13px; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                <span class="dashicons dashicons-info" style="font-size: 18px; width: 18px; height: 18px;"></span>
                Panduan Praktis Pengelolaan Brosur:
            </div>
            <ul style="margin: 4px 0 0 20px; color: #115e59; font-size: 12.5px; line-height: 1.6; list-style-type: disc;">
                <li><strong>Ukuran File PDF:</strong> Disarankan di bawah <strong>5 MB</strong> agar cepat dimuat dan ramah kuota nasabah pada perangkat smartphone.</li>
                <li><strong>Gambar Cover Dokumen:</strong> Rekomendasi rasio <strong>16:10</strong> atau <strong>4:3</strong> (format JPG/PNG/WebP, orientasi landscape/cover) agar tampil serasi dan rapi tanpa terpotong.</li>
                <li><strong>Fitur Aksi Ganda:</strong> File PDF yang Anda unggah otomatis dapat di-<strong>Pratinjau Langsung</strong> melalui PDF Lightbox Popup dan di-<strong>Unduh</strong> oleh pengunjung website.</li>
            </ul>
        </div>

        <?php if ( $is_saved ) : ?>
            <div class="notice notice-success is-dismissible" style="border-left-color: #088395; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px;">
                <p style="margin: 0; font-size: 14px;"><strong>✅ Pengaturan Berhasil Disimpan!</strong> Seluruh perubahan pada halaman <code>/brosur/</code> dan preview navbar telah diperbarui secara langsung.</p>
            </div>
        <?php endif; ?>

        <form method="post" action="" style="margin-top: 10px;">
            <?php wp_nonce_field( 'wakalumi_brosur_save', 'wakalumi_brosur_nonce' ); ?>

            <!-- ========================================
                 SEKSI 1: PENGATURAN HEADER BANNER HALAMAN
                 ======================================== -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; margin: 0 0 16px 0; color: #088395; display: flex; align-items: center; gap: 8px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
                    <span class="dashicons dashicons-art" style="color: #088395;"></span>
                    1. Header Banner Halaman (/brosur/)
                </h2>
                <p style="color: #64748b; font-size: 13px; margin: -8px 0 16px 0;">
                    Teks judul dan pengantar yang tampil di bagian paling atas halaman katalog brosur.
                </p>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">Lencana / Badge Kicker</label>
                        <input type="text" name="options_brosur_page_badge" value="<?php echo esc_attr( $page_badge ); ?>" class="large-text" placeholder="Dokumen Resmi & Literasi Syariah" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">Judul Besar Halaman *</label>
                        <input type="text" name="options_brosur_page_title" value="<?php echo esc_attr( $page_title ); ?>" class="large-text" placeholder="Pusat Unduhan Brosur & Panduan Produk" style="border-radius: 6px;">
                    </div>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">Subjudul / Deskripsi Pembuka</label>
                    <textarea name="options_brosur_page_sub" rows="2" class="large-text" placeholder="Penjelasan singkat mengenai materi resmi dan panduan produk..." style="border-radius: 6px;"><?php echo esc_textarea( $page_sub ); ?></textarea>
                </div>
            </div>

            <!-- ========================================
                 SEKSI 2: BROSUR UTAMA RESMI (FEATURED BROCHURE)
                 ======================================== -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 16px;">
                    <h2 style="font-size: 16px; font-weight: 700; margin: 0; color: #088395; display: flex; align-items: center; gap: 8px;">
                        <span class="dashicons dashicons-star-filled" style="color: #f59e0b;"></span>
                        2. Brosur Utama Resmi (Featured Spotlight & Preview Navbar)
                    </h2>
                    <span style="font-size: 11px; font-weight: 700; color: #088395; background: #ccfbf1; padding: 3px 8px; border-radius: 999px;">
                        Sorotan Unggulan
                    </span>
                </div>
                <p style="color: #64748b; font-size: 13px; margin: -8px 0 16px 0;">
                    Brosur komprehensif ini ditampilkan dalam kartu 3D berukuran besar di bagian atas halaman <code>/brosur/</code> dan sebagai informasi preview di navbar Produk.
                </p>

                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">Nama / Judul Brosur Utama *</label>
                        <input type="text" name="options_brosur_file_name" value="<?php echo esc_attr( $brosur_primary['file_name'] ); ?>" class="large-text" placeholder="Brosur Resmi Produk BPRS Wakalumi" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">Lencana Unggulan</label>
                        <input type="text" name="options_brosur_featured_badge" value="<?php echo esc_attr( $brosur_primary['featured_badge'] ); ?>" class="large-text" placeholder="Katalog Resmi Komprehensif" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">Versi / Tahun Rilis</label>
                        <input type="text" name="options_brosur_version" value="<?php echo esc_attr( $brosur_primary['version'] ); ?>" class="large-text" placeholder="Edisi 2026" style="border-radius: 6px;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <!-- Upload File PDF Utama -->
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">File Dokumen PDF Utama *</label>
                        <div class="wkl-upload-wrap" style="display: flex; gap: 8px;">
                            <input type="text" id="primary_file_url" name="options_brosur_file_url" value="<?php echo esc_attr( $brosur_primary['file_url'] ); ?>" class="large-text" placeholder="https://.../brosur-wakalumi.pdf" style="border-radius: 6px;">
                            <button type="button" class="button wkl-upload-doc-btn" data-target="primary_file_url" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                                <span class="dashicons dashicons-upload"></span> Pilih PDF
                            </button>
                        </div>
                        <span style="font-size: 11px; color: #64748b; margin-top: 4px; display: block;">Unggah file PDF melalui Media Library WordPress atau tempelkan URL langsung.</span>
                    </div>

                    <!-- Label Ukuran File -->
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">Label Format & Ukuran File</label>
                        <input type="text" name="options_brosur_file_size" value="<?php echo esc_attr( $brosur_primary['file_size'] ); ?>" class="large-text" placeholder="PDF Resmi • 2.4 MB" style="border-radius: 6px;">
                        <span style="font-size: 11px; color: #64748b; margin-top: 4px; display: block;">Ditampilkan pada badge dokumen (contoh: <code>PDF Resmi • 2.4 MB</code>).</span>
                    </div>
                </div>

                <!-- Cover Sampul Mockup Brosur Utama -->
                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">Gambar Cover / Mockup Sampul (Opsional)</label>
                    <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <img id="primary_cover_preview" src="<?php echo esc_url( $brosur_primary['cover'] ); ?>" style="max-width: 90px; max-height: 90px; object-fit: cover; border-radius: 8px; border: 1px solid #cbd5e1; <?php echo empty( $brosur_primary['cover'] ) ? 'display:none;' : ''; ?>" />
                        <div style="flex: 1; display: flex; gap: 8px; align-items: center;">
                            <input type="text" id="primary_cover" name="options_brosur_cover" value="<?php echo esc_attr( $brosur_primary['cover'] ); ?>" class="large-text" placeholder="https://.../cover-brosur.jpg" style="border-radius: 6px;">
                            <button type="button" class="button wkl-upload-img-btn" data-target="primary_cover" data-preview="primary_cover_preview" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                                <span class="dashicons dashicons-format-image"></span> Pilih Gambar
                            </button>
                            <button type="button" class="button-link wkl-remove-btn" data-target="primary_cover" data-preview="primary_cover_preview" style="color: #ef4444; font-size: 12px; <?php echo empty( $brosur_primary['cover'] ) ? 'display:none;' : ''; ?>">
                                ✕ Hapus
                            </button>
                        </div>
                    </div>
                    <span style="font-size: 11px; color: #64748b; margin-top: 4px; display: block;">Jika dikosongkan, sistem otomatis menampilkan ilustrasi sampul vektor grafis resmi BPRS Wakalumi.</span>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">Deskripsi Singkat Brosur Utama</label>
                    <textarea name="options_brosur_desc" rows="2" class="large-text" placeholder="Ringkasan isi materi brosur..." style="border-radius: 6px;"><?php echo esc_textarea( $brosur_primary['desc'] ); ?></textarea>
                </div>
            </div>

            <!-- ========================================
                 SEKSI 3: KOLEKSI BROSUR SPESIFIK PRODUK (REPEATER)
                 ======================================== -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 16px;">
                    <div>
                        <h2 style="font-size: 16px; font-weight: 700; margin: 0; color: #088395; display: flex; align-items: center; gap: 8px;">
                            <span class="dashicons dashicons-category" style="color: #088395;"></span>
                            3. Koleksi Brosur Spesifik Produk & Program (Filter Dinamis)
                        </h2>
                        <p style="color: #64748b; font-size: 13px; margin: 4px 0 0 0;">
                            Setiap kartu dokumen di bawah ini dapat difilter secara langsung oleh pengunjung website berdasarkan kategori tab maupun search bar teks.
                        </p>
                    </div>
                    <button type="button" id="wkl-add-brosur" class="button button-primary" style="background: #088395; border-color: #066e7d; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; padding: 2px 14px; border-radius: 8px;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span>
                        + Tambah Dokumen Brosur Baru
                    </button>
                </div>

                <div id="wkl-brosur-container" style="display: flex; flex-direction: column; gap: 16px;">
                    <?php foreach ( $brosur_list as $index => $item ) : 
                        $b_title   = $item['title'] ?? '';
                        $b_kat     = $item['kategori'] ?? 'Penghimpunan Dana';
                        $b_badge   = $item['badge'] ?? '';
                        $b_file    = $item['file_url'] ?? '';
                        $b_size    = $item['file_size'] ?? 'PDF • 1.5 MB';
                        $b_cover   = $item['cover'] ?? '';
                        $b_desc    = $item['desc'] ?? '';
                        $b_version = $item['version'] ?? '2026';
                        $b_urutan  = $item['urutan'] ?? ( $index + 1 );
                        $b_color   = $item['color'] ?? 'teal';
                        $row_id    = 'row_' . $index;

                        $color_borders = [
                            'teal'    => '#088395',
                            'emerald' => '#059669',
                            'blue'    => '#2563eb',
                            'amber'   => '#d97706',
                            'purple'  => '#7c3aed',
                            'rose'    => '#e11d48',
                        ];
                        $border_color = $color_borders[$b_color] ?? '#088395';
                    ?>
                        <div class="brosur-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid <?php echo esc_attr( $border_color ); ?>; border-radius: 10px; padding: 20px; position: relative;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
                                <span style="font-weight: 700; color: #1e293b; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                                    <span class="dashicons dashicons-media-document" style="color: <?php echo esc_attr( $border_color ); ?>;"></span>
                                    Dokumen #<span class="row-num"><?php echo ( $index + 1 ); ?></span>: <strong><?php echo esc_html( $b_title ?: 'Tanpa Judul' ); ?></strong>
                                </span>
                                <button type="button" class="wkl-delete-brosur button-link" style="color: #ef4444; font-size: 12px; font-weight: 600; text-decoration: none;">
                                    ✕ Hapus Dokumen
                                </button>
                            </div>

                            <div style="display: grid; grid-template-columns: 2fr 1.3fr 1.15fr 1fr 1fr 65px 55px; gap: 10px; margin-bottom: 12px;">
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Judul Brosur / Dokumen *</label>
                                    <input type="text" name="brosur_list_title[]" value="<?php echo esc_attr( $b_title ); ?>" class="large-text" placeholder="Contoh: Brosur Tabungan Syariah..." style="border-radius: 6px;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Kategori Filter Tab</label>
                                    <select name="brosur_list_kategori[]" class="large-text" style="border-radius: 6px;">
                                        <option value="Penghimpunan Dana" <?php selected( $b_kat, 'Penghimpunan Dana' ); ?>>Penghimpunan Dana</option>
                                        <option value="Penyaluran Dana" <?php selected( $b_kat, 'Penyaluran Dana' ); ?>>Penyaluran Dana</option>
                                        <option value="Program Khusus" <?php selected( $b_kat, 'Program Khusus' ); ?>>Program Khusus</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Tema Warna Card</label>
                                    <select name="brosur_list_color[]" class="large-text" style="border-radius: 6px; font-weight: 600;">
                                        <option value="teal" <?php selected( $b_color, 'teal' ); ?>>🟢 Toska (Wakalumi)</option>
                                        <option value="emerald" <?php selected( $b_color, 'emerald' ); ?>>🌱 Hijau Syariah</option>
                                        <option value="blue" <?php selected( $b_color, 'blue' ); ?>>🔷 Biru Finansial</option>
                                        <option value="amber" <?php selected( $b_color, 'amber' ); ?>>👑 Emas / Prioritas</option>
                                        <option value="purple" <?php selected( $b_color, 'purple' ); ?>>🟣 Ungu Eksklusif</option>
                                        <option value="rose" <?php selected( $b_color, 'rose' ); ?>>🔴 Merah Marun</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Lencana / Badge</label>
                                    <input type="text" name="brosur_list_badge[]" value="<?php echo esc_attr( $b_badge ); ?>" class="large-text" placeholder="misal: Tabungan" style="border-radius: 6px;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Ukuran File</label>
                                    <input type="text" name="brosur_list_file_size[]" value="<?php echo esc_attr( $b_size ); ?>" class="large-text" placeholder="PDF • 1.5 MB" style="border-radius: 6px;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Versi</label>
                                    <input type="text" name="brosur_list_version[]" value="<?php echo esc_attr( $b_version ); ?>" class="large-text" placeholder="2026" style="border-radius: 6px; text-align: center;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Urutan</label>
                                    <input type="number" name="brosur_list_urutan[]" value="<?php echo esc_attr( $b_urutan ); ?>" class="large-text" style="text-align: center; border-radius: 6px;">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 14px; margin-bottom: 12px;">
                                <!-- Upload File Dokumen PDF -->
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">File Dokumen PDF *</label>
                                    <div class="wkl-upload-wrap" style="display: flex; gap: 8px;">
                                        <input type="text" id="file_<?php echo esc_attr( $row_id ); ?>" name="brosur_list_file_url[]" value="<?php echo esc_attr( $b_file ); ?>" class="large-text" placeholder="https://.../file.pdf" style="border-radius: 6px;">
                                        <button type="button" class="button wkl-upload-doc-btn" data-target="file_<?php echo esc_attr( $row_id ); ?>" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                                            <span class="dashicons dashicons-upload"></span> Pilih PDF
                                        </button>
                                    </div>
                                </div>

                                <!-- Upload Cover Sampul (16:10 / 4:3) -->
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Gambar Cover Sampul (Rasio 16:10)</label>
                                    <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 8px;">
                                        <img id="cover_prev_<?php echo esc_attr( $row_id ); ?>" src="<?php echo esc_url( $b_cover ); ?>" style="width: 32px; height: 32px; object-fit: cover; border-radius: 4px; border: 1px solid #cbd5e1; <?php echo empty( $b_cover ) ? 'display:none;' : ''; ?>" />
                                        <input type="text" id="cover_<?php echo esc_attr( $row_id ); ?>" name="brosur_list_cover[]" value="<?php echo esc_attr( $b_cover ); ?>" class="large-text" placeholder="https://.../cover.jpg" style="border-radius: 6px;">
                                        <button type="button" class="button wkl-upload-img-btn" data-target="cover_<?php echo esc_attr( $row_id ); ?>" data-preview="cover_prev_<?php echo esc_attr( $row_id ); ?>" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                                            <span class="dashicons dashicons-format-image"></span> Sampul
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Keterangan Ringkas Isi Brosur</label>
                                <textarea name="brosur_list_desc[]" rows="2" class="large-text" placeholder="Penjelasan singkat isi brosur..." style="border-radius: 6px;"><?php echo esc_textarea( $b_desc ); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ========================================
                 SEKSI 4: PILAR TATA KELOLA & REGULASI (OJK, LPS, DSN-MUI)
                 ======================================== -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 16px;">
                    <div>
                        <h2 style="font-size: 16px; font-weight: 700; margin: 0; color: #088395; display: flex; align-items: center; gap: 8px;">
                            <span class="dashicons dashicons-shield" style="color: #088395;"></span>
                            4. Pilar Tata Kelola, Regulasi & Transparansi
                        </h2>
                        <p style="color: #64748b; font-size: 13px; margin: 4px 0 0 0;">
                            Informasi legalitas dan kepatuhan perbankan syariah (OJK, LPS, DSN-MUI) yang tampil di bagian bawah halaman katalog brosur.
                        </p>
                    </div>
                    <label style="display: inline-flex; align-items: center; gap: 8px; font-weight: 700; font-size: 13px; color: #1e293b; cursor: pointer;">
                        <input type="checkbox" name="options_brosur_gov_show" value="yes" <?php checked( $brosur_gov['show'] ); ?>>
                        Tampilkan Seksi Ini di Halaman
                    </label>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">Kicker / Lencana Seksi</label>
                        <input type="text" name="options_brosur_gov_kicker" value="<?php echo esc_attr( $brosur_gov['kicker'] ); ?>" class="large-text" placeholder="Tata Kelola & Transparansi" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">Judul Seksi Kepatuhan</label>
                        <input type="text" name="options_brosur_gov_title" value="<?php echo esc_attr( $brosur_gov['title'] ); ?>" class="large-text" placeholder="Keamanan, Legalitas & Kepatuhan Terjamin" style="border-radius: 6px;">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #334155;">Deskripsi Pengantar Seksi</label>
                    <textarea name="options_brosur_gov_desc" rows="2" class="large-text" placeholder="Penjelasan kepatuhan terhadap regulasi perbankan..." style="border-radius: 6px;"><?php echo esc_textarea( $brosur_gov['desc'] ); ?></textarea>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                    <strong style="font-size: 13px; color: #0f172a;">Daftar Kartu Otoritas & Regulasi:</strong>
                    <button type="button" id="wkl-add-gov" class="button" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600; font-size: 12px;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 14px; width: 14px; height: 14px;"></span>
                        + Tambah Kartu Regulasi
                    </button>
                </div>

                <div id="wkl-gov-container" style="display: flex; flex-direction: column; gap: 12px;">
                    <?php foreach ( $brosur_gov['cards'] as $g_idx => $g_card ) : 
                        $g_badge  = $g_card['badge'] ?? 'Regulasi';
                        $g_name   = $g_card['title'] ?? '';
                        $g_detail = $g_card['desc'] ?? '';
                        $g_ref    = $g_card['legal_ref'] ?? '';
                        $g_order  = $g_card['urutan'] ?? ( $g_idx + 1 );
                        $g_color  = $g_card['color'] ?? ( $g_idx === 0 ? 'rose' : ( $g_idx === 1 ? 'blue' : 'emerald' ) );

                        $gov_border_colors = [
                            'rose'    => '#e11d48',
                            'blue'    => '#2563eb',
                            'emerald' => '#059669',
                            'teal'    => '#088395',
                            'amber'   => '#d97706',
                            'purple'  => '#7c3aed',
                        ];
                        $g_border = $gov_border_colors[$g_color] ?? '#088395';
                    ?>
                        <div class="gov-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid <?php echo esc_attr( $g_border ); ?>; border-radius: 8px; padding: 14px 16px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <span style="font-weight: 700; color: #334155; font-size: 12.5px;">Kartu Regulasi #<?php echo ( $g_idx + 1 ); ?></span>
                                <button type="button" class="wkl-delete-gov button-link" style="color: #ef4444; font-size: 11px; text-decoration: none;">✕ Hapus</button>
                            </div>
                            <div style="display: grid; grid-template-columns: 1.4fr 1fr 1.1fr 1fr 60px; gap: 10px; margin-bottom: 10px;">
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; margin-bottom: 3px; color: #475569;">Nama / Judul Regulasi *</label>
                                    <input type="text" name="gov_title[]" value="<?php echo esc_attr( $g_name ); ?>" class="large-text" placeholder="Terdaftar & Diawasi OJK" style="border-radius: 6px;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; margin-bottom: 3px; color: #475569;">Lencana Singkat</label>
                                    <input type="text" name="gov_badge[]" value="<?php echo esc_attr( $g_badge ); ?>" class="large-text" placeholder="Pengawasan OJK" style="border-radius: 6px;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; margin-bottom: 3px; color: #475569;">Tema Dual-Tone</label>
                                    <select name="gov_color[]" class="large-text" style="border-radius: 6px; font-weight: 600;">
                                        <option value="rose" <?php selected( $g_color, 'rose' ); ?>>🔴 Merah Marun (OJK)</option>
                                        <option value="blue" <?php selected( $g_color, 'blue' ); ?>>🔷 Biru Finansial (LPS)</option>
                                        <option value="emerald" <?php selected( $g_color, 'emerald' ); ?>>🌱 Hijau Syariah (DSN)</option>
                                        <option value="teal" <?php selected( $g_color, 'teal' ); ?>>🟢 Toska (Wakalumi)</option>
                                        <option value="amber" <?php selected( $g_color, 'amber' ); ?>>👑 Emas / Prioritas</option>
                                        <option value="purple" <?php selected( $g_color, 'purple' ); ?>>🟣 Ungu Eksklusif</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; margin-bottom: 3px; color: #475569;">Dasar Hukum / Izin</label>
                                    <input type="text" name="gov_legal_ref[]" value="<?php echo esc_attr( $g_ref ); ?>" class="large-text" placeholder="Keputusan OJK" style="border-radius: 6px;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; margin-bottom: 3px; color: #475569;">Urutan</label>
                                    <input type="number" name="gov_urutan[]" value="<?php echo esc_attr( $g_order ); ?>" class="large-text" style="text-align: center; border-radius: 6px;">
                                </div>
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: bold; margin-bottom: 3px; color: #475569;">Keterangan / Penjelasan</label>
                                <textarea name="gov_desc[]" rows="2" class="large-text" placeholder="Penjelasan singkat kepatuhan hukum..." style="border-radius: 6px;"><?php echo esc_textarea( $g_detail ); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Submit Button Bar -->
            <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
                <input type="submit" name="wakalumi_brosur_submit" value="Simpan Semua Pengaturan Katalog Brosur" class="button button-primary button-hero" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 32px; border-radius: 8px;">
                <span style="font-size: 12px; color: #64748b;">Seluruh perubahan langsung aktif di frontend dan menu navigasi.</span>
            </div>
        </form>
    </div>

    <!-- Template JS untuk Tambah Brosur Baru -->
    <script type="text/template" id="tmpl-brosur-card">
        <div class="brosur-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #088395; border-radius: 10px; padding: 20px; position: relative;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
                <span style="font-weight: 700; color: #1e293b; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                    <span class="dashicons dashicons-media-document" style="color: #088395;"></span>
                    Dokumen Baru (Belum Disimpan)
                </span>
                <button type="button" class="wkl-delete-brosur button-link" style="color: #ef4444; font-size: 12px; font-weight: 600; text-decoration: none;">
                    ✕ Hapus Dokumen
                </button>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1.3fr 1.15fr 1fr 1fr 65px 55px; gap: 10px; margin-bottom: 12px;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Judul Brosur / Dokumen *</label>
                    <input type="text" name="brosur_list_title[]" value="" class="large-text" placeholder="Contoh: Brosur Pembiayaan..." style="border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Kategori Filter Tab</label>
                    <select name="brosur_list_kategori[]" class="large-text" style="border-radius: 6px;">
                        <option value="Penghimpunan Dana">Penghimpunan Dana</option>
                        <option value="Penyaluran Dana">Penyaluran Dana</option>
                        <option value="Program Khusus">Program Khusus</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Tema Warna Card</label>
                    <select name="brosur_list_color[]" class="large-text" style="border-radius: 6px; font-weight: 600;">
                        <option value="teal" selected>🟢 Toska (Wakalumi)</option>
                        <option value="emerald">🌱 Hijau Syariah</option>
                        <option value="blue">🔷 Biru Finansial</option>
                        <option value="amber">👑 Emas / Prioritas</option>
                        <option value="purple">🟣 Ungu Eksklusif</option>
                        <option value="rose">🔴 Merah Marun</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Lencana / Badge</label>
                    <input type="text" name="brosur_list_badge[]" value="Brosur Produk" class="large-text" placeholder="misal: Pembiayaan" style="border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Ukuran File</label>
                    <input type="text" name="brosur_list_file_size[]" value="PDF • 1.5 MB" class="large-text" placeholder="PDF • 1.5 MB" style="border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Versi</label>
                    <input type="text" name="brosur_list_version[]" value="2026" class="large-text" placeholder="2026" style="border-radius: 6px; text-align: center;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Urutan</label>
                    <input type="number" name="brosur_list_urutan[]" value="{{order}}" class="large-text" style="text-align: center; border-radius: 6px;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">File Dokumen PDF *</label>
                    <div class="wkl-upload-wrap" style="display: flex; gap: 8px;">
                        <input type="text" id="file_{{id}}" name="brosur_list_file_url[]" value="" class="large-text" placeholder="https://.../file.pdf" style="border-radius: 6px;">
                        <button type="button" class="button wkl-upload-doc-btn" data-target="file_{{id}}" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                            <span class="dashicons dashicons-upload"></span> Pilih PDF
                        </button>
                    </div>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Gambar Cover Sampul (Rasio 16:10)</label>
                    <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 8px;">
                        <img id="cover_prev_{{id}}" src="" style="width: 32px; height: 32px; object-fit: cover; border-radius: 4px; border: 1px solid #cbd5e1; display:none;" />
                        <input type="text" id="cover_{{id}}" name="brosur_list_cover[]" value="" class="large-text" placeholder="https://.../cover.jpg" style="border-radius: 6px;">
                        <button type="button" class="button wkl-upload-img-btn" data-target="cover_{{id}}" data-preview="cover_prev_{{id}}" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                            <span class="dashicons dashicons-format-image"></span> Sampul
                        </button>
                    </div>
                </div>
            </div>

            <div>
                <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Keterangan Ringkas Isi Brosur</label>
                <textarea name="brosur_list_desc[]" rows="2" class="large-text" placeholder="Penjelasan singkat isi dokumen brosur..." style="border-radius: 6px;"></textarea>
            </div>
        </div>
    </script>

    <!-- Template JS untuk Tambah Regulasi Baru -->
    <script type="text/template" id="tmpl-gov-card">
        <div class="gov-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #e11d48; border-radius: 8px; padding: 14px 16px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <span style="font-weight: 700; color: #334155; font-size: 12.5px;">Kartu Regulasi Baru (Belum Disimpan)</span>
                <button type="button" class="wkl-delete-gov button-link" style="color: #ef4444; font-size: 11px; text-decoration: none;">✕ Hapus</button>
            </div>
            <div style="display: grid; grid-template-columns: 1.4fr 1fr 1.1fr 1fr 60px; gap: 10px; margin-bottom: 10px;">
                <div>
                    <label style="display: block; font-size: 11px; font-weight: bold; margin-bottom: 3px; color: #475569;">Nama / Judul Regulasi *</label>
                    <input type="text" name="gov_title[]" value="" class="large-text" placeholder="Nama Lembaga / Regulasi" style="border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; font-size: 11px; font-weight: bold; margin-bottom: 3px; color: #475569;">Lencana Singkat</label>
                    <input type="text" name="gov_badge[]" value="Regulasi" class="large-text" placeholder="Lencana" style="border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; font-size: 11px; font-weight: bold; margin-bottom: 3px; color: #475569;">Tema Dual-Tone</label>
                    <select name="gov_color[]" class="large-text" style="border-radius: 6px; font-weight: 600;">
                        <option value="rose" selected>🔴 Merah Marun (OJK)</option>
                        <option value="blue">🔷 Biru Finansial (LPS)</option>
                        <option value="emerald">🌱 Hijau Syariah (DSN)</option>
                        <option value="teal">🟢 Toska (Wakalumi)</option>
                        <option value="amber">👑 Emas / Prioritas</option>
                        <option value="purple">🟣 Ungu Eksklusif</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 11px; font-weight: bold; margin-bottom: 3px; color: #475569;">Dasar Hukum / Izin</label>
                    <input type="text" name="gov_legal_ref[]" value="" class="large-text" placeholder="Nomor Izin / UU" style="border-radius: 6px;">
                </div>
                <div>
                    <label style="display: block; font-size: 11px; font-weight: bold; margin-bottom: 3px; color: #475569;">Urutan</label>
                    <input type="number" name="gov_urutan[]" value="{{order}}" class="large-text" style="text-align: center; border-radius: 6px;">
                </div>
            </div>
            <div>
                <label style="display: block; font-size: 11px; font-weight: bold; margin-bottom: 3px; color: #475569;">Keterangan / Penjelasan</label>
                <textarea name="gov_desc[]" rows="2" class="large-text" placeholder="Penjelasan singkat kepatuhan hukum..." style="border-radius: 6px;"></textarea>
            </div>
        </div>
    </script>

    <!-- Admin JS for WP Media Uploader & Repeater Interactions -->
    <script>
    jQuery(document).ready(function($) {
        var brosurContainer = $('#wkl-brosur-container');
        var brosurTemplate  = $('#tmpl-brosur-card').html();

        var govContainer = $('#wkl-gov-container');
        var govTemplate  = $('#tmpl-gov-card').html();

        // 1. Tambah Brosur Baru
        $('#wkl-add-brosur').on('click', function(e) {
            e.preventDefault();
            var uniqueId = 'new_' + new Date().getTime();
            var count = brosurContainer.find('.brosur-card').length + 1;
            var html = brosurTemplate.replace(/{{id}}/g, uniqueId).replace(/{{order}}/g, count);
            brosurContainer.append(html);
        });

        // 2. Hapus Brosur
        brosurContainer.on('click', '.wkl-delete-brosur', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus dokumen brosur ini?')) {
                $(this).closest('.brosur-card').fadeOut(250, function() {
                    $(this).remove();
                });
            }
        });

        // 3. Tambah Regulasi Baru
        $('#wkl-add-gov').on('click', function(e) {
            e.preventDefault();
            var count = govContainer.find('.gov-card').length + 1;
            var html = govTemplate.replace(/{{order}}/g, count);
            govContainer.append(html);
        });

        // 4. Hapus Regulasi
        govContainer.on('click', '.wkl-delete-gov', function(e) {
            e.preventDefault();
            $(this).closest('.gov-card').fadeOut(200, function() {
                $(this).remove();
            });
        });

        // 5. WordPress Media Uploader untuk File Dokumen (PDF)
        $(document).on('click', '.wkl-upload-doc-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            var targetInput = $('#' + button.data('target'));

            var customUploader = wp.media({
                title: 'Pilih atau Unggah Dokumen Brosur (PDF)',
                button: { text: 'Gunakan File PDF Ini' },
                multiple: false,
                library: { type: 'application/pdf' }
            });

            customUploader.on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);

                // Auto-fill nama file jika field nama file di card masih kosong
                var card = button.closest('.brosur-card');
                if (card.length) {
                    var titleInput = card.find('input[name="brosur_list_title[]"]');
                    if (!titleInput.val()) {
                        titleInput.val(attachment.title || attachment.filename);
                    }
                }
            });

            customUploader.open();
        });

        // 6. WordPress Media Uploader untuk Gambar Sampul / Cover
        $(document).on('click', '.wkl-upload-img-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            var targetInput = $('#' + button.data('target'));
            var previewImg  = $('#' + button.data('preview'));

            var customUploader = wp.media({
                title: 'Pilih atau Unggah Gambar Sampul Brosur (Rasio 16:10 / 4:3)',
                button: { text: 'Gunakan Gambar Ini' },
                multiple: false,
                library: { type: 'image' }
            });

            customUploader.on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                if (previewImg.length) {
                    previewImg.attr('src', attachment.url).show();
                }
                button.siblings('.wkl-remove-btn').show();
            });

            customUploader.open();
        });

        // 7. Tombol Hapus Gambar Preview
        $(document).on('click', '.wkl-remove-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            var targetInput = $('#' + button.data('target'));
            var previewImg  = $('#' + button.data('preview'));

            targetInput.val('');
            if (previewImg.length) {
                previewImg.attr('src', '').hide();
            }
            button.hide();
        });
    });
    </script>
    <?php
}
