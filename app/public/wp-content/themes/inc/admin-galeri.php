<?php
/**
 * Admin: Galeri Dokumentasi Foto & Video Bank
 * 
 * Pengelolaan terpadu album foto kegiatan, program CSR, seminar syariah,
 * momen korporat RUPS, dan dinamika pelayanan Bank Syariah Wakalumi (BSW).
 * 
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ── 1. DATA HELPERS ─────────────────────────────────────────────────

if ( ! function_exists( 'wakalumi_get_galeri_categories' ) ) {
    /**
     * Kategori album galeri dokumentasi bank.
     *
     * @return array
     */
    function wakalumi_get_galeri_categories() {
        return [
            'csr' => [
                'name'        => 'csr',
                'label'       => 'CSR, Sosial & Filantropi',
                'pill_label'  => 'CSR & Sosial',
                'badge_class' => 'bg-white/95 dark:bg-slate-900/95 text-emerald-800 dark:text-emerald-300 border-slate-200/80 dark:border-emerald-700/60 shadow-md',
                'tag_dot'     => 'bg-emerald-500',
                'icon'        => 'heart',
            ],
            'edukasi' => [
                'name'        => 'edukasi',
                'label'       => 'Edukasi & Literasi Syariah',
                'pill_label'  => 'Edukasi & Literasi',
                'badge_class' => 'bg-white/95 dark:bg-slate-900/95 text-teal-800 dark:text-teal-300 border-slate-200/80 dark:border-teal-700/60 shadow-md',
                'tag_dot'     => 'bg-teal-500',
                'icon'        => 'academic',
            ],
            'corporate' => [
                'name'        => 'corporate',
                'label'       => 'Korporat, RUPS & Kemitraan',
                'pill_label'  => 'Korporat & RUPS',
                'badge_class' => 'bg-white/95 dark:bg-slate-900/95 text-purple-800 dark:text-purple-300 border-slate-200/80 dark:border-purple-700/60 shadow-md',
                'tag_dot'     => 'bg-purple-500',
                'icon'        => 'briefcase',
            ],
            'layanan' => [
                'name'        => 'layanan',
                'label'       => 'Aktivitas Kantor & Pelayanan',
                'pill_label'  => 'Layanan & Kantor',
                'badge_class' => 'bg-white/95 dark:bg-slate-900/95 text-sky-800 dark:text-sky-300 border-slate-200/80 dark:border-sky-700/60 shadow-md',
                'tag_dot'     => 'bg-sky-500',
                'icon'        => 'building',
            ],
            'penghargaan' => [
                'name'        => 'penghargaan',
                'label'       => 'Prestasi & Penghargaan',
                'pill_label'  => 'Penghargaan',
                'badge_class' => 'bg-white/95 dark:bg-slate-900/95 text-amber-800 dark:text-amber-300 border-slate-200/80 dark:border-amber-700/60 shadow-md',
                'tag_dot'     => 'bg-amber-500',
                'icon'        => 'trophy',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_galeri_header' ) ) {
    /**
     * Mengambil teks pengantar & badge hero halaman galeri dokumentasi.
     *
     * @return array
     */
    function wakalumi_get_galeri_header() {
        $badge = get_option( 'options_galeri_badge', 'Dokumentasi & Galeri Visual' );
        $title = get_option( 'options_galeri_title', 'Galeri Dokumentasi Bank Syariah Wakalumi' );
        $title = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $title );
        $desc  = get_option( 'options_galeri_desc', 'Koleksi rekam jejak, dinamika aktivitas perbankan syariah, program sosial CSR, serta momen bersejarah Bank Syariah Wakalumi bersama nasabah, mitra usaha, dan masyarakat.' );

        $card_badge = get_option( 'options_galeri_card_badge', 'Transparansi & Rekam Jejak' );
        $card_title = get_option( 'options_galeri_card_title', 'Dokumentasi Visual Terpercaya' );
        $card_desc  = get_option( 'options_galeri_card_desc', 'Setiap visual mencerminkan dedikasi Bank Syariah Wakalumi dalam melayani umat, memberdayakan perekonomian syariah, dan menjaga integritas tata kelola yang amanah.' );

        return [
            'badge'      => $badge,
            'title'      => $title,
            'desc'       => $desc,
            'card_badge' => $card_badge,
            'card_title' => $card_title,
            'card_desc'  => $card_desc,
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_galeri_albums' ) ) {
    /**
     * Mengambil seluruh daftar album dokumentasi (disimpan di wp_options).
     *
     * @return array
     */
    function wakalumi_get_galeri_albums() {
        $saved = get_option( 'options_galeri_albums', null );
        if ( is_array( $saved ) && ! empty( $saved ) ) {
            foreach ( $saved as &$item ) {
                if ( isset( $item['judul'] ) ) {
                    $item['judul'] = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $item['judul'] );
                }
                if ( isset( $item['ringkasan'] ) ) {
                    $item['ringkasan'] = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $item['ringkasan'] );
                }
                if ( ! isset( $item['foto_list'] ) || ! is_array( $item['foto_list'] ) ) {
                    $item['foto_list'] = [];
                }
            }
            unset( $item );
            return $saved;
        }

        // Default Sample Realistic Albums
        $theme_uri = get_template_directory_uri();
        $sample_img_1 = $theme_uri . '/assets/img/about-photo.jpg';
        $sample_img_2 = $theme_uri . '/assets/img/video-thumb.jpg';

        return [
            [
                'id'          => 'alb_1',
                'judul'       => 'Program CSR: Penyaluran Paket Sembako & Santunan Anak Yatim',
                'kategori'    => 'csr',
                'tanggal'     => date( 'Y-m-d', strtotime( '-20 days' ) ),
                'lokasi'      => 'Kantor Pusat BSW & Yayasan Yatim Dhuafa Mandiri',
                'ringkasan'   => 'Penyaluran bingkisan sembako berkah, santunan pendidikan, serta buka puasa bersama anak yatim dalam momentum keberkahan syiar sosial perbankan syariah.',
                'cover_image' => $sample_img_1,
                'foto_list'   => [
                    $sample_img_1,
                    $sample_img_2,
                ],
                'video_url'   => '',
                'status'      => 'aktif',
                'urutan'      => 1,
            ],
            [
                'id'          => 'alb_2',
                'judul'       => 'Workshop Literasi Perbankan Syariah & Akselerasi Pembiayaan UMKM',
                'kategori'    => 'edukasi',
                'tanggal'     => date( 'Y-m-d', strtotime( '-45 days' ) ),
                'lokasi'      => 'Auditorium Pusat UMKM Kreatif & Kemitraan',
                'ringkasan'   => 'Pelatihan manajemen keuangan halal, pembukuan digital kas mikro, dan pembiayaan modal kerja syariah dengan akad Murabahah & Mudharabah bagi 100 pelaku UMKM.',
                'cover_image' => $sample_img_2,
                'foto_list'   => [
                    $sample_img_2,
                    $sample_img_1,
                ],
                'video_url'   => '',
                'status'      => 'aktif',
                'urutan'      => 2,
            ],
            [
                'id'          => 'alb_3',
                'judul'       => 'Rapat Umum Pemegang Saham (RUPS) Tahunan & Paparan Kinerja Positif',
                'kategori'    => 'corporate',
                'tanggal'     => date( 'Y-m-d', strtotime( '-80 days' ) ),
                'lokasi'      => 'Ballroom Utama & Kantor Pusat Bank Syariah Wakalumi',
                'ringkasan'   => 'Pemaparan laporan pertanggungjawaban direksi, pengesahan laporan keuangan audited dengan predikat Sehat, serta penguatan arah digitalisasi operasional bank.',
                'cover_image' => $sample_img_1,
                'foto_list'   => [
                    $sample_img_1,
                    $sample_img_2,
                ],
                'video_url'   => '',
                'status'      => 'aktif',
                'urutan'      => 3,
            ],
            [
                'id'          => 'alb_4',
                'judul'       => 'Supervisi Lapangan & Kunjungan Dewan Pengawas Syariah (DPS)',
                'kategori'    => 'corporate',
                'tanggal'     => date( 'Y-m-d', strtotime( '-110 days' ) ),
                'lokasi'      => 'Jaringan Kantor Operasional & Lokasi Usaha Nasabah',
                'ringkasan'   => 'Kunjungan rutin dan audit kepatuhan syariah lapangan oleh DPS guna memastikan seluruh akad transaksi pembiayaan berjalan konsisten dengan fatwa DSN-MUI.',
                'cover_image' => $sample_img_2,
                'foto_list'   => [
                    $sample_img_2,
                    $sample_img_1,
                ],
                'video_url'   => '',
                'status'      => 'aktif',
                'urutan'      => 4,
            ],
            [
                'id'          => 'alb_5',
                'judul'       => 'Pelatihan Anti-Fraud, Perlindungan Nasabah & Service Excellence',
                'kategori'    => 'layanan',
                'tanggal'     => date( 'Y-m-d', strtotime( '-150 days' ) ),
                'lokasi'      => 'Pusat Pengembangan Kompetensi SDM BSW',
                'ringkasan'   => 'Penguatan integritas insan perbankan, teknik pencegahan kejahatan rekayasa sosial (phishing/skimming), serta peningkatan keramahan layanan frontliner.',
                'cover_image' => $sample_img_1,
                'foto_list'   => [
                    $sample_img_1,
                    $sample_img_2,
                ],
                'video_url'   => '',
                'status'      => 'aktif',
                'urutan'      => 5,
            ],
            [
                'id'          => 'alb_6',
                'judul'       => 'Penganugerahan Penghargaan Perbankan Syariah Berkinerja Unggul',
                'kategori'    => 'penghargaan',
                'tanggal'     => date( 'Y-m-d', strtotime( '-190 days' ) ),
                'lokasi'      => 'Grand Ballroom Financial Hall Jakarta',
                'ringkasan'   => 'Apresiasi industri atas konsistensi Bank Syariah Wakalumi dalam menjaga kualitas pembiayaan, rasio NPF rendah, serta pertumbuhan laba yang berkesinambungan.',
                'cover_image' => $sample_img_2,
                'foto_list'   => [
                    $sample_img_2,
                    $sample_img_1,
                ],
                'video_url'   => '',
                'status'      => 'aktif',
                'urutan'      => 6,
            ],
        ];
    }
}


// ── 2. MENU REGISTRATION & ASSETS ───────────────────────────────────

add_action( 'admin_menu', 'wakalumi_register_galeri_page', 30 );
function wakalumi_register_galeri_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Galeri Dokumentasi',
        'Galeri Dokumentasi',
        'manage_options',
        'wakalumi-galeri',
        'wakalumi_render_galeri_page'
    );
}

add_action( 'admin_enqueue_scripts', 'wakalumi_galeri_admin_assets' );
function wakalumi_galeri_admin_assets( $hook ) {
    if ( strpos( $hook, 'wakalumi-galeri' ) !== false ) {
        wp_enqueue_media();
    }
}


// ── 3. RENDER ADMIN INTERFACE & SAVE CONTROLLER ─────────────────────

function wakalumi_render_galeri_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Anda tidak memiliki hak akses untuk mengelola halaman ini.' );
    }

    $notice = '';

    // Handle Form Save
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['wakalumi_galeri_nonce'] ) ) {
        if ( ! wp_verify_nonce( $_POST['wakalumi_galeri_nonce'], 'wakalumi_galeri_action' ) ) {
            $notice = '<div class="notice notice-error is-dismissible"><p>Validasi keamanan gagal. Silakan coba kembali.</p></div>';
        } else {
            // 1. Header Banner Settings
            update_option( 'options_galeri_badge', sanitize_text_field( $_POST['options_galeri_badge'] ?? '' ) );
            update_option( 'options_galeri_title', sanitize_text_field( $_POST['options_galeri_title'] ?? '' ) );
            update_option( 'options_galeri_desc', sanitize_textarea_field( $_POST['options_galeri_desc'] ?? '' ) );

            // 2. Governance Card
            update_option( 'options_galeri_card_badge', sanitize_text_field( $_POST['options_galeri_card_badge'] ?? '' ) );
            update_option( 'options_galeri_card_title', sanitize_text_field( $_POST['options_galeri_card_title'] ?? '' ) );
            update_option( 'options_galeri_card_desc', sanitize_textarea_field( $_POST['options_galeri_card_desc'] ?? '' ) );

            // 3. Repeater Album Galeri
            $ids          = $_POST['galeri_id'] ?? [];
            $juduls       = $_POST['galeri_judul'] ?? [];
            $kategoris    = $_POST['galeri_kategori'] ?? [];
            $tanggals     = $_POST['galeri_tanggal'] ?? [];
            $lokasis      = $_POST['galeri_lokasi'] ?? [];
            $ringkasans   = $_POST['galeri_ringkasan'] ?? [];
            $covers       = $_POST['galeri_cover_image'] ?? [];
            $foto_raws    = $_POST['galeri_foto_list'] ?? [];
            $video_urls   = $_POST['galeri_video_url'] ?? [];
            $statuses     = $_POST['galeri_status'] ?? [];
            $urutans      = $_POST['galeri_urutan'] ?? [];

            $new_albums = [];
            for ( $i = 0; $i < count( $ids ); $i++ ) {
                $judul = sanitize_text_field( $juduls[$i] ?? '' );
                if ( empty( $judul ) ) {
                    continue; // Abaikan jika judul kosong
                }

                // Parse foto list dari textarea (satu URL per baris)
                $raw_photos = $foto_raws[$i] ?? '';
                $lines = explode( "\n", str_replace( "\r", '', $raw_photos ) );
                $clean_photos = [];
                foreach ( $lines as $line ) {
                    $u = trim( $line );
                    if ( ! empty( $u ) ) {
                        $clean_photos[] = esc_url_raw( $u );
                    }
                }

                $cover = esc_url_raw( $covers[$i] ?? '' );
                if ( empty( $cover ) && ! empty( $clean_photos ) ) {
                    $cover = $clean_photos[0]; // Jadikan foto pertama sebagai default cover jika cover kosong
                }

                $new_albums[] = [
                    'id'          => sanitize_text_field( $ids[$i] ?? ( 'alb_' . $i ) ),
                    'judul'       => $judul,
                    'kategori'    => sanitize_text_field( $kategoris[$i] ?? 'csr' ),
                    'tanggal'     => sanitize_text_field( $tanggals[$i] ?? date( 'Y-m-d' ) ),
                    'lokasi'      => sanitize_text_field( $lokasis[$i] ?? '' ),
                    'ringkasan'   => sanitize_textarea_field( $ringkasans[$i] ?? '' ),
                    'cover_image' => $cover,
                    'foto_list'   => $clean_photos,
                    'video_url'   => esc_url_raw( $video_urls[$i] ?? '' ),
                    'status'      => sanitize_text_field( $statuses[$i] ?? 'aktif' ),
                    'urutan'      => intval( $urutans[$i] ?? ( $i + 1 ) ),
                ];
            }

            // Urutkan berdasarkan nomor urut
            usort( $new_albums, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );

            update_option( 'options_galeri_albums', $new_albums );

            $notice = '<div class="notice notice-success is-dismissible"><p><strong>Berhasil!</strong> Seluruh album Galeri Dokumentasi Bank Syariah Wakalumi telah disimpan.</p></div>';
        }
    }

    // Load Data
    $header     = wakalumi_get_galeri_header();
    $categories = wakalumi_get_galeri_categories();
    $albums     = wakalumi_get_galeri_albums();

    $total_albums = count( $albums );
    $active_albums = count( array_filter( $albums, fn($x) => ( $x['status'] ?? 'aktif' ) === 'aktif' ) );
    $total_photos = 0;
    foreach ( $albums as $alb ) {
        $total_photos += count( $alb['foto_list'] ?? [] );
    }
    ?>

    <div class="wrap" style="max-width: 1100px; margin-top: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;">

        <!-- TOP BAR HEADER -->
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #e2e8f0;">
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span class="dashicons dashicons-format-gallery" style="font-size: 28px; width: 28px; height: 28px; color: #088395;"></span>
                    Galeri Dokumentasi Foto &amp; Video BSW
                </h1>
                <p style="margin: 6px 0 0 38px; color: #64748b; font-size: 13px;">
                    Kelola arsip foto kegiatan, program CSR, momen RUPS, seminar edukasi, dan dokumentasi visual Bank Syariah Wakalumi dengan lightbox carousel interaktif.
                </p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="<?php echo esc_url( home_url( '/informasi/galeri/' ) ); ?>" target="_blank" class="button" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600;">
                    <span class="dashicons dashicons-external"></span> Lihat Halaman Galeri
                </a>
            </div>
        </div>

        <?php echo $notice; ?>

        <form method="post" action="" id="wakalumi-galeri-form">
            <?php wp_nonce_field( 'wakalumi_galeri_action', 'wakalumi_galeri_nonce' ); ?>

            <!-- STATS QUICK COUNTER -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 25px;">
                <div style="background: #ffffff; padding: 18px; border-radius: 12px; border: 1px solid #cbd5e1; border-left: 5px solid #088395; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">Total Album Dokumentasi</div>
                    <div style="font-size: 26px; font-weight: 800; color: #0f172a; margin-top: 4px;"><?php echo $total_albums; ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">album</span></div>
                </div>
                <div style="background: #ffffff; padding: 18px; border-radius: 12px; border: 1px solid #cbd5e1; border-left: 5px solid #10b981; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">Album Tayang (Aktif)</div>
                    <div style="font-size: 26px; font-weight: 800; color: #047857; margin-top: 4px;"><?php echo $active_albums; ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">album aktif</span></div>
                </div>
                <div style="background: #ffffff; padding: 18px; border-radius: 12px; border: 1px solid #cbd5e1; border-left: 5px solid #8b5cf6; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">Total Koleksi Foto</div>
                    <div style="font-size: 26px; font-weight: 800; color: #6d28d9; margin-top: 4px;"><?php echo $total_photos; ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">foto resolusi tinggi</span></div>
                </div>
            </div>

            <!-- SECTION 1: HEADER BANNER & INTRO SETTINGS -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
                <h2 style="font-size: 17px; font-weight: 700; color: #088395; margin: 0 0 16px 0; padding-bottom: 10px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-welcome-widgets-menus" style="color: #088395;"></span>
                    Header &amp; Pengantar Halaman Galeri
                </h2>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 16px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Badge Teks Atas Hero</label>
                        <input type="text" name="options_galeri_badge" value="<?php echo esc_attr( $header['badge'] ); ?>" class="large-text" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Judul Utama Halaman</label>
                        <input type="text" name="options_galeri_title" value="<?php echo esc_attr( $header['title'] ); ?>" class="large-text" style="border-radius: 6px; font-weight: 700;">
                    </div>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Deskripsi / Ringkasan Pengantar</label>
                    <textarea name="options_galeri_desc" rows="3" class="large-text" style="border-radius: 6px;"><?php echo esc_textarea( $header['desc'] ); ?></textarea>
                </div>

                <!-- Governance Card Preview Settings -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; margin-top: 15px;">
                    <h3 style="font-size: 13px; font-weight: 700; color: #1e293b; margin: 0 0 10px 0;">Kartu Governance &amp; Transparansi Visual (Kanan Hero)</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 10px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 600; color: #475569; margin-bottom: 4px;">Badge Kartu:</label>
                            <input type="text" name="options_galeri_card_badge" value="<?php echo esc_attr( $header['card_badge'] ); ?>" class="large-text" style="border-radius: 6px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 600; color: #475569; margin-bottom: 4px;">Judul Kartu:</label>
                            <input type="text" name="options_galeri_card_title" value="<?php echo esc_attr( $header['card_title'] ); ?>" class="large-text" style="border-radius: 6px;">
                        </div>
                    </div>
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 600; color: #475569; margin-bottom: 4px;">Penjelasan Nilai Kartu:</label>
                        <textarea name="options_galeri_card_desc" rows="2" class="large-text" style="border-radius: 6px;"><?php echo esc_textarea( $header['card_desc'] ); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: DAFTAR ALBUM DOKUMENTASI (REPEATER) -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <h2 style="font-size: 18px; font-weight: 700; color: #088395; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <span class="dashicons dashicons-images-alt2" style="color: #088395;"></span>
                            Daftar Album Dokumentasi Kegiatan
                        </h2>
                        <p style="margin: 4px 0 0 0; color: #64748b; font-size: 13px;">
                            Setiap album dapat berisi beberapa foto resolusi tinggi, cover utama, lokasi, tanggal, serta tautan video streaming.
                        </p>
                    </div>
                    <button type="button" id="btn-add-album" class="button button-primary" style="background: #088395; border-color: #066e7d; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> Tambah Album Baru
                    </button>
                </div>

                <!-- Repeater Container -->
                <div id="galeri-repeater-container" style="display: flex; flex-direction: column; gap: 20px;">
                    <?php
                    if ( empty( $albums ) ) {
                        echo '<p id="no-album-notice" style="color: #94a3b8; font-style: italic; text-align: center; padding: 20px;">Belum ada album dokumentasi yang ditambahkan. Klik tombol "+ Tambah Album Baru" di atas.</p>';
                    } else {
                        foreach ( $albums as $index => $item ) {
                            $row_id      = esc_attr( $item['id'] ?? ( 'alb_' . $index ) );
                            $judul       = esc_attr( $item['judul'] ?? '' );
                            $kategori    = esc_attr( $item['kategori'] ?? 'csr' );
                            $tanggal     = esc_attr( $item['tanggal'] ?? date( 'Y-m-d' ) );
                            $lokasi      = esc_attr( $item['lokasi'] ?? '' );
                            $ringkasan   = esc_textarea( $item['ringkasan'] ?? '' );
                            $cover_image = esc_attr( $item['cover_image'] ?? '' );
                            $foto_list   = $item['foto_list'] ?? [];
                            $foto_text   = esc_textarea( implode( "\n", $foto_list ) );
                            $video_url   = esc_attr( $item['video_url'] ?? '' );
                            $status      = esc_attr( $item['status'] ?? 'aktif' );
                            $urutan      = intval( $item['urutan'] ?? ( $index + 1 ) );
                            $foto_count  = count( $foto_list );
                            ?>
                            <div class="galeri-card" data-index="<?php echo $index; ?>" style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 10px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                                
                                <!-- Card Header (Collapsible) -->
                                <div class="galeri-card-header" style="padding: 14px 18px; background: #f1f5f9; display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none;">
                                    <div style="display: flex; align-items: center; gap: 10px; flex: 1; overflow: hidden;">
                                        <span class="dashicons dashicons-sort" style="color: #94a3b8; cursor: grab;" title="Geser urutan"></span>
                                        <span class="galeri-card-number" style="font-size: 12px; font-weight: 700; color: #475569; background: #e2e8f0; padding: 2px 8px; border-radius: 6px;">#<?php echo ( $index + 1 ); ?></span>
                                        <span class="galeri-preview-title" style="font-weight: 700; color: #0f172a; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 500px;">
                                            <?php echo $judul ?: '(Album Belum Ada Judul)'; ?>
                                        </span>
                                        <span class="galeri-preview-count" style="font-size: 11px; font-weight: 600; background: #e0f2fe; color: #0369a1; padding: 2px 8px; border-radius: 20px;">
                                            📷 <?php echo $foto_count; ?> Foto
                                        </span>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <button type="button" class="button-link btn-delete-card" style="color: #dc2626; padding: 4px 8px; text-decoration: none; font-size: 13px;" title="Hapus Album">
                                            <span class="dashicons dashicons-trash" style="font-size: 17px; width: 17px; height: 17px;"></span>
                                        </button>
                                        <button type="button" class="button-link btn-toggle-card" style="color: #475569; text-decoration: none;">
                                            <span class="dashicons dashicons-arrow-up-alt2"></span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="galeri-card-body" style="padding: 20px; background: #ffffff;">
                                    <input type="hidden" name="galeri_id[]" value="<?php echo $row_id; ?>">

                                    <!-- Row 1: Judul & Kategori -->
                                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px; margin-bottom: 14px;">
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Judul Album Dokumentasi <span style="color: #dc2626;">*</span></label>
                                            <input type="text" name="galeri_judul[]" value="<?php echo $judul; ?>" class="large-text galeri-judul-input" style="border-radius: 6px; font-weight: 600;" placeholder="Contoh: CSR Ramadhan Berkah &amp; Santunan Yatim" required>
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Kategori Album</label>
                                            <select name="galeri_kategori[]" class="large-text" style="border-radius: 6px;">
                                                <?php foreach ( $categories as $cat_key => $cat_data ) : ?>
                                                    <option value="<?php echo esc_attr( $cat_key ); ?>" <?php selected( $kategori, $cat_key ); ?>>
                                                        <?php echo esc_html( $cat_data['label'] ); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Row 2: Tanggal & Lokasi -->
                                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 15px; margin-bottom: 14px;">
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tanggal Kegiatan</label>
                                            <input type="date" name="galeri_tanggal[]" value="<?php echo $tanggal; ?>" class="large-text" style="border-radius: 6px;">
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Lokasi / Tempat Pelaksanaan</label>
                                            <input type="text" name="galeri_lokasi[]" value="<?php echo $lokasi; ?>" class="large-text" style="border-radius: 6px;" placeholder="Contoh: Kantor Pusat BSW &amp; Grand Ballroom Jakarta">
                                        </div>
                                    </div>

                                    <!-- Row 3: Ringkasan Cerita Dokumentasi -->
                                    <div style="margin-bottom: 16px;">
                                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Ringkasan / Narasi Dokumentasi</label>
                                        <textarea name="galeri_ringkasan[]" rows="2" class="large-text" style="border-radius: 6px;" placeholder="Uraian singkat mengenai cerita di balik kegiatan dan tujuan diselenggarakannya..."><?php echo $ringkasan; ?></textarea>
                                    </div>

                                    <!-- Row 4: Cover Image & Video URL -->
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 16px; background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 6px;">
                                                <span class="dashicons dashicons-format-image" style="font-size: 16px; width: 16px; height: 16px;"></span> Foto Sampul Utama (Cover Card)
                                            </label>
                                            <div style="display: flex; gap: 12px; align-items: flex-start;">
                                                <div style="width: 100px; height: 65px; border-radius: 6px; overflow: hidden; background: #e2e8f0; flex-shrink: 0; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                                    <img id="galeri_cover_preview_<?php echo $index; ?>" src="<?php echo $cover_image ?: ''; ?>" style="width: 100%; height: 100%; object-fit: cover; <?php echo empty( $cover_image ) ? 'display:none;' : ''; ?>">
                                                    <span class="dashicons dashicons-format-image" style="color: #94a3b8; <?php echo ! empty( $cover_image ) ? 'display:none;' : ''; ?>"></span>
                                                </div>
                                                <div style="flex: 1;">
                                                    <input type="text" id="galeri_cover_input_<?php echo $index; ?>" name="galeri_cover_image[]" value="<?php echo $cover_image; ?>" class="large-text" style="border-radius: 6px; margin-bottom: 6px; font-size: 12px;" placeholder="URL Gambar Cover...">
                                                    <div style="display: flex; gap: 6px;">
                                                        <button type="button" class="button button-secondary btn-upload-cover" data-target="galeri_cover_input_<?php echo $index; ?>" data-preview="galeri_cover_preview_<?php echo $index; ?>" style="font-size: 11px;">
                                                            Pilih Gambar
                                                        </button>
                                                        <button type="button" class="button-link btn-remove-cover" data-target="galeri_cover_input_<?php echo $index; ?>" data-preview="galeri_cover_preview_<?php echo $index; ?>" style="color: #dc2626; font-size: 11px; <?php echo empty( $cover_image ) ? 'display:none;' : ''; ?>">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 6px;">
                                                <span class="dashicons dashicons-video-alt3" style="font-size: 16px; width: 16px; height: 16px;"></span> Tautan Video (YouTube / Vimeo - Opsional)
                                            </label>
                                            <input type="url" name="galeri_video_url[]" value="<?php echo $video_url; ?>" class="large-text" style="border-radius: 6px; font-size: 12px;" placeholder="Contoh: https://www.youtube.com/watch?v=XXXXXX">
                                            <p style="margin: 4px 0 0 0; font-size: 11px; color: #64748b;">Jika diisi, pengunjung dapat menonton video liputan kegiatan langsung di dalam lightbox viewer.</p>
                                        </div>
                                    </div>

                                    <!-- Row 5: Multi-Photo Collection (Gallery List) -->
                                    <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 15px; margin-bottom: 16px;">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; flex-wrap: wrap; gap: 8px;">
                                            <label style="font-size: 12px; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 6px;">
                                                <span class="dashicons dashicons-images-alt" style="color: #088395;"></span>
                                                Daftar Foto dalam Album (Resolusi Tinggi)
                                            </label>
                                            <button type="button" class="button btn-upload-multiple-photos" data-target="galeri_photos_textarea_<?php echo $index; ?>" data-preview="galeri_photos_preview_box_<?php echo $index; ?>" style="background: #f1f5f9; border-color: #cbd5e1; font-weight: 600; font-size: 12px; display: inline-flex; align-items: center; gap: 5px;">
                                                <span class="dashicons dashicons-format-gallery" style="font-size: 15px; width: 15px; height: 15px;"></span> Pilih Banyak Foto Sekaligus
                                            </button>
                                        </div>

                                        <p style="margin: 0 0 8px 0; font-size: 11px; color: #64748b;">
                                            Gunakan tombol <strong>"Pilih Banyak Foto Sekaligus"</strong> untuk memilih beberapa gambar langsung dari Media Library WordPress (tekan tombol Ctrl / Shift untuk memilih lebih dari satu). Atau Anda dapat menempel URL foto satu per baris pada kotak teks di bawah:
                                        </p>

                                        <textarea id="galeri_photos_textarea_<?php echo $index; ?>" name="galeri_foto_list[]" rows="3" class="large-text galeri-photos-textarea" style="border-radius: 6px; font-family: monospace; font-size: 11px;" placeholder="https://domain.com/wp-content/uploads/foto1.jpg&#10;https://domain.com/wp-content/uploads/foto2.jpg"><?php echo $foto_text; ?></textarea>

                                        <!-- Mini Thumbnails Preview Grid -->
                                        <div id="galeri_photos_preview_box_<?php echo $index; ?>" class="galeri-photos-preview-box" style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px;">
                                            <?php foreach ( $foto_list as $f_idx => $p_url ) : ?>
                                                <div style="width: 55px; height: 45px; border-radius: 4px; overflow: hidden; border: 1px solid #cbd5e1; position: relative;">
                                                    <img src="<?php echo esc_url( $p_url ); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <!-- Row 6: Status & Urutan -->
                                    <div style="display: flex; gap: 20px; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 14px;">
                                        <div>
                                            <label style="font-size: 12px; font-weight: 700; color: #334155; margin-right: 8px;">Status Tayang:</label>
                                            <select name="galeri_status[]" style="border-radius: 6px;">
                                                <option value="aktif" <?php selected( $status, 'aktif' ); ?>>Aktif (Tampil di Website)</option>
                                                <option value="arsip" <?php selected( $status, 'arsip' ); ?>>Arsip (Disembunyikan)</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label style="font-size: 12px; font-weight: 700; color: #334155; margin-right: 8px;">Urutan Tampil:</label>
                                            <input type="number" name="galeri_urutan[]" value="<?php echo $urutan; ?>" class="card-urutan-input" style="width: 70px; border-radius: 6px; text-align: center;" min="1">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <!-- Add Button Bottom -->
                <div style="margin-top: 20px; text-align: center;">
                    <button type="button" id="btn-add-album-bottom" class="button" style="border-style: dashed; padding: 10px 24px; font-weight: 600; color: #088395; border-color: #088395;">
                        <span class="dashicons dashicons-plus-alt2"></span> Tambah Album Dokumentasi Lainnya
                    </button>
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <div style="position: sticky; bottom: 20px; background: rgba(255,255,255,0.95); backdrop-filter: blur(8px); padding: 16px 24px; border-radius: 12px; border: 1px solid #cbd5e1; box-shadow: 0 4px 14px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; z-index: 50;">
                <div style="font-size: 13px; color: #475569;">
                    Pastikan seluruh data album dan URL foto telah diperiksa sebelum menekan tombol simpan.
                </div>
                <button type="submit" class="button button-primary button-large" style="background: #088395; border-color: #066e7d; font-weight: 700; padding: 0 28px; height: 42px; font-size: 14px;">
                    Simpan Seluruh Perubahan Galeri
                </button>
            </div>
        </form>

    </div>

    <!-- UNDERSCORE / HTML TEMPLATE UNTUK ALBUM BARU -->
    <script type="text/html" id="tmpl-galeri-card">
        <div class="galeri-card" data-index="{{index}}" style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 10px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
            <div class="galeri-card-header" style="padding: 14px 18px; background: #f1f5f9; display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none;">
                <div style="display: flex; align-items: center; gap: 10px; flex: 1; overflow: hidden;">
                    <span class="dashicons dashicons-sort" style="color: #94a3b8; cursor: grab;" title="Geser urutan"></span>
                    <span class="galeri-card-number" style="font-size: 12px; font-weight: 700; color: #475569; background: #e2e8f0; padding: 2px 8px; border-radius: 6px;">#{{num}}</span>
                    <span class="galeri-preview-title" style="font-weight: 700; color: #0f172a; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 500px;">
                        (Album Dokumentasi Baru)
                    </span>
                    <span class="galeri-preview-count" style="font-size: 11px; font-weight: 600; background: #e0f2fe; color: #0369a1; padding: 2px 8px; border-radius: 20px;">
                        📷 0 Foto
                    </span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <button type="button" class="button-link btn-delete-card" style="color: #dc2626; padding: 4px 8px; text-decoration: none; font-size: 13px;" title="Hapus Album">
                        <span class="dashicons dashicons-trash" style="font-size: 17px; width: 17px; height: 17px;"></span>
                    </button>
                    <button type="button" class="button-link btn-toggle-card" style="color: #475569; text-decoration: none;">
                        <span class="dashicons dashicons-arrow-up-alt2"></span>
                    </button>
                </div>
            </div>

            <div class="galeri-card-body" style="padding: 20px; background: #ffffff;">
                <input type="hidden" name="galeri_id[]" value="{{row_id}}">

                <!-- Row 1: Judul & Kategori -->
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Judul Album Dokumentasi <span style="color: #dc2626;">*</span></label>
                        <input type="text" name="galeri_judul[]" value="" class="large-text galeri-judul-input" style="border-radius: 6px; font-weight: 600;" placeholder="Contoh: Seminar Literasi Syariah &amp; Temu Nasabah" required>
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Kategori Album</label>
                        <select name="galeri_kategori[]" class="large-text" style="border-radius: 6px;">
                            <?php foreach ( $categories as $cat_key => $cat_data ) : ?>
                                <option value="<?php echo esc_attr( $cat_key ); ?>"><?php echo esc_html( $cat_data['label'] ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Row 2: Tanggal & Lokasi -->
                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 15px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tanggal Kegiatan</label>
                        <input type="date" name="galeri_tanggal[]" value="<?php echo date( 'Y-m-d' ); ?>" class="large-text" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Lokasi / Tempat Pelaksanaan</label>
                        <input type="text" name="galeri_lokasi[]" value="" class="large-text" style="border-radius: 6px;" placeholder="Contoh: Kantor Cabang Bank Syariah Wakalumi">
                    </div>
                </div>

                <!-- Row 3: Ringkasan -->
                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Ringkasan / Narasi Dokumentasi</label>
                    <textarea name="galeri_ringkasan[]" rows="2" class="large-text" style="border-radius: 6px;" placeholder="Uraian singkat mengenai cerita di balik kegiatan ini..."></textarea>
                </div>

                <!-- Row 4: Cover Image & Video URL -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 16px; background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 6px;">
                            <span class="dashicons dashicons-format-image" style="font-size: 16px; width: 16px; height: 16px;"></span> Foto Sampul Utama (Cover Card)
                        </label>
                        <div style="display: flex; gap: 12px; align-items: flex-start;">
                            <div style="width: 100px; height: 65px; border-radius: 6px; overflow: hidden; background: #e2e8f0; flex-shrink: 0; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                <img id="galeri_cover_preview_{{index}}" src="" style="width: 100%; height: 100%; object-fit: cover; display:none;">
                                <span class="dashicons dashicons-format-image" style="color: #94a3b8;"></span>
                            </div>
                            <div style="flex: 1;">
                                <input type="text" id="galeri_cover_input_{{index}}" name="galeri_cover_image[]" value="" class="large-text" style="border-radius: 6px; margin-bottom: 6px; font-size: 12px;" placeholder="URL Gambar Cover...">
                                <div style="display: flex; gap: 6px;">
                                    <button type="button" class="button button-secondary btn-upload-cover" data-target="galeri_cover_input_{{index}}" data-preview="galeri_cover_preview_{{index}}" style="font-size: 11px;">
                                        Pilih Gambar
                                    </button>
                                    <button type="button" class="button-link btn-remove-cover" data-target="galeri_cover_input_{{index}}" data-preview="galeri_cover_preview_{{index}}" style="color: #dc2626; font-size: 11px; display:none;">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 6px;">
                            <span class="dashicons dashicons-video-alt3" style="font-size: 16px; width: 16px; height: 16px;"></span> Tautan Video (YouTube / Vimeo - Opsional)
                        </label>
                        <input type="url" name="galeri_video_url[]" value="" class="large-text" style="border-radius: 6px; font-size: 12px;" placeholder="Contoh: https://www.youtube.com/watch?v=XXXXXX">
                    </div>
                </div>

                <!-- Row 5: Multi-Photo Collection -->
                <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 15px; margin-bottom: 16px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; flex-wrap: wrap; gap: 8px;">
                        <label style="font-size: 12px; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 6px;">
                            <span class="dashicons dashicons-images-alt" style="color: #088395;"></span>
                            Daftar Foto dalam Album (Resolusi Tinggi)
                        </label>
                        <button type="button" class="button btn-upload-multiple-photos" data-target="galeri_photos_textarea_{{index}}" data-preview="galeri_photos_preview_box_{{index}}" style="background: #f1f5f9; border-color: #cbd5e1; font-weight: 600; font-size: 12px; display: inline-flex; align-items: center; gap: 5px;">
                            <span class="dashicons dashicons-format-gallery" style="font-size: 15px; width: 15px; height: 15px;"></span> Pilih Banyak Foto Sekaligus
                        </button>
                    </div>

                    <textarea id="galeri_photos_textarea_{{index}}" name="galeri_foto_list[]" rows="3" class="large-text galeri-photos-textarea" style="border-radius: 6px; font-family: monospace; font-size: 11px;" placeholder="Tempel URL foto di sini satu per baris..."></textarea>
                    
                    <div id="galeri_photos_preview_box_{{index}}" class="galeri-photos-preview-box" style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px;"></div>
                </div>

                <!-- Row 6: Status & Urutan -->
                <div style="display: flex; gap: 20px; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 14px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; margin-right: 8px;">Status Tayang:</label>
                        <select name="galeri_status[]" style="border-radius: 6px;">
                            <option value="aktif">Aktif (Tampil di Website)</option>
                            <option value="arsip">Arsip (Disembunyikan)</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; margin-right: 8px;">Urutan Tampil:</label>
                        <input type="number" name="galeri_urutan[]" value="{{num}}" class="card-urutan-input" style="width: 70px; border-radius: 6px; text-align: center;" min="1">
                    </div>
                </div>
            </div>
        </div>
    </script>

    <!-- INLINE JAVASCRIPT FOR DYNAMIC CARDS & MEDIA UPLOADERS -->
    <script>
    jQuery(document).ready(function($) {

        // Toggle Collapse Card
        $(document).on('click', '.galeri-card-header', function(e) {
            if ($(e.target).closest('.btn-delete-card').length) return;
            var body = $(this).closest('.galeri-card').find('.galeri-card-body');
            var icon = $(this).find('.btn-toggle-card .dashicons');
            body.slideToggle(200);
            if (icon.hasClass('dashicons-arrow-down-alt2')) {
                icon.removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
            } else {
                icon.removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');
            }
        });

        // Live Preview Title
        $(document).on('input', '.galeri-judul-input', function() {
            var val = $(this).val().trim();
            var preview = $(this).closest('.galeri-card').find('.galeri-preview-title');
            preview.text(val || '(Album Belum Ada Judul)');
        });

        // Live Photo Counter & Preview Update
        $(document).on('input change', '.galeri-photos-textarea', function() {
            updatePhotoPreviewBox($(this));
        });

        function updatePhotoPreviewBox(textarea) {
            var text = textarea.val();
            var lines = text.split('\n');
            var validUrls = [];
            for (var i = 0; i < lines.length; i++) {
                var u = lines[i].trim();
                if (u && (u.indexOf('http://') === 0 || u.indexOf('https://') === 0 || u.indexOf('/') === 0)) {
                    validUrls.push(u);
                }
            }

            var card = textarea.closest('.galeri-card');
            card.find('.galeri-preview-count').text('📷 ' + validUrls.length + ' Foto');

            var previewBox = card.find('.galeri-photos-preview-box');
            previewBox.empty();
            validUrls.slice(0, 12).forEach(function(url) {
                var item = $('<div style="width: 55px; height: 45px; border-radius: 4px; overflow: hidden; border: 1px solid #cbd5e1;"><img src="' + url + '" style="width: 100%; height: 100%; object-fit: cover;"></div>');
                previewBox.append(item);
            });
            if (validUrls.length > 12) {
                previewBox.append('<div style="width: 55px; height: 45px; border-radius: 4px; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; color: #475569;">+' + (validUrls.length - 12) + '</div>');
            }
        }

        // Add Card Logic
        $('#btn-add-album, #btn-add-album-bottom').on('click', function(e) {
            e.preventDefault();
            $('#no-album-notice').hide();
            var container = $('#galeri-repeater-container');
            var count = container.find('.galeri-card').length;
            var num = count + 1;
            var rowId = 'alb_' + Date.now();
            var templateHtml = $('#tmpl-galeri-card').html();

            templateHtml = templateHtml.replace(/\{\{index\}\}/g, count);
            templateHtml = templateHtml.replace(/\{\{num\}\}/g, num);
            templateHtml = templateHtml.replace(/\{\{row_id\}\}/g, rowId);

            var newCard = $(templateHtml);
            container.append(newCard);
            newCard.hide().slideDown(250);
            $('html, body').animate({
                scrollTop: newCard.offset().top - 80
            }, 300);
        });

        // Delete Card Logic
        $(document).on('click', '.btn-delete-card', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (confirm('Yakin ingin menghapus album dokumentasi ini?')) {
                var card = $(this).closest('.galeri-card');
                card.slideUp(200, function() {
                    card.remove();
                    reindexCards();
                });
            }
        });

        function reindexCards() {
            var cards = $('#galeri-repeater-container .galeri-card');
            if (cards.length === 0) {
                $('#no-album-notice').show();
            }
            cards.each(function(i) {
                $(this).find('.galeri-card-number').text('#' + (i + 1));
                $(this).find('.card-urutan-input').val(i + 1);
            });
        }

        // Single Image Uploader for Cover
        $(document).on('click', '.btn-upload-cover', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $('#' + btn.data('target'));
            var previewImg  = $('#' + btn.data('preview'));
            var removeBtn   = btn.siblings('.btn-remove-cover');
            var placeholderIcon = previewImg.siblings('.dashicons');

            var customUploader = wp.media({
                title: 'Pilih atau Unggah Foto Sampul Album',
                button: { text: 'Gunakan Sebagai Sampul' },
                multiple: false,
                library: { type: 'image' }
            });

            customUploader.on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                previewImg.attr('src', attachment.url).show();
                if (placeholderIcon.length) placeholderIcon.hide();
                removeBtn.show();
            });

            customUploader.open();
        });

        // Remove Single Image Cover
        $(document).on('click', '.btn-remove-cover', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $('#' + btn.data('target'));
            var previewImg  = $('#' + btn.data('preview'));
            var placeholderIcon = previewImg.siblings('.dashicons');
            targetInput.val('');
            previewImg.attr('src', '').hide();
            if (placeholderIcon.length) placeholderIcon.show();
            btn.hide();
        });

        // Multi-Image Uploader for Gallery Photos
        $(document).on('click', '.btn-upload-multiple-photos', function(e) {
            e.preventDefault();
            var btn = $(this);
            var textarea = $('#' + btn.data('target'));

            var multiUploader = wp.media({
                title: 'Pilih Koleksi Foto Dokumentasi (Tahan Ctrl/Shift untuk Multi-Select)',
                button: { text: 'Tambahkan Foto ke Album' },
                multiple: true,
                library: { type: 'image' }
            });

            multiUploader.on('select', function() {
                var selection = multiUploader.state().get('selection');
                var currentVal = textarea.val().trim();
                var newUrls = [];

                selection.each(function(attachment) {
                    var attJson = attachment.toJSON();
                    if (attJson.url) {
                        newUrls.push(attJson.url);
                    }
                });

                if (newUrls.length > 0) {
                    if (currentVal.length > 0) {
                        currentVal += '\n' + newUrls.join('\n');
                    } else {
                        currentVal = newUrls.join('\n');
                    }
                    textarea.val(currentVal);
                    updatePhotoPreviewBox(textarea);
                }
            });

            multiUploader.open();
        });

    });
    </script>
    <?php
}

