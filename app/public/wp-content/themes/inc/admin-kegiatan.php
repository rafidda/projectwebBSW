<?php
/**
 * Admin: Kegiatan & Agenda Bank
 * 
 * Pengelolaan terpadu agenda mendatang (jadwal seminar, RUPS, workshop UMKM)
 * dan arsip kegiatan terlaksana (CSR, bakti sosial, edukasi) BPRS Wakalumi.
 * 
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ── 1. DATA HELPERS ─────────────────────────────────────────────────

if ( ! function_exists( 'wakalumi_get_kegiatan_categories' ) ) {
    /**
     * Kategori kegiatan & agenda bank.
     *
     * @return array
     */
    function wakalumi_get_kegiatan_categories() {
        return [
            'edukasi' => [
                'name'        => 'edukasi',
                'label'       => 'Edukasi & Literasi Syariah',
                'pill_label'  => 'Literasi & Edukasi',
                'badge_class' => 'bg-teal-500/10 dark:bg-teal-950/60 text-teal-700 dark:text-teal-300 border-teal-300/60 dark:border-teal-700/60',
                'tag_dot'     => 'bg-teal-500',
                'icon'        => 'academic',
            ],
            'csr' => [
                'name'        => 'csr',
                'label'       => 'CSR, Sosial & Filantropi',
                'pill_label'  => 'CSR & Sosial',
                'badge_class' => 'bg-emerald-500/10 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border-emerald-300/60 dark:border-emerald-700/60',
                'tag_dot'     => 'bg-emerald-500',
                'icon'        => 'heart',
            ],
            'corporate' => [
                'name'        => 'corporate',
                'label'       => 'Corporate, RUPS & Kemitraan',
                'pill_label'  => 'Corporate & RUPS',
                'badge_class' => 'bg-purple-500/10 dark:bg-purple-950/60 text-purple-700 dark:text-purple-300 border-purple-300/60 dark:border-purple-700/60',
                'tag_dot'     => 'bg-purple-500',
                'icon'        => 'briefcase',
            ],
            'komunitas' => [
                'name'        => 'komunitas',
                'label'       => 'Komunitas & UMKM Binaan',
                'pill_label'  => 'Komunitas UMKM',
                'badge_class' => 'bg-amber-500/10 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border-amber-300/60 dark:border-amber-700/60',
                'tag_dot'     => 'bg-amber-500',
                'icon'        => 'users',
            ],
            'internal' => [
                'name'        => 'internal',
                'label'       => 'Internal & Rekrutmen',
                'pill_label'  => 'Internal & Karir',
                'badge_class' => 'bg-sky-500/10 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border-sky-300/60 dark:border-sky-700/60',
                'tag_dot'     => 'bg-sky-500',
                'icon'        => 'calendar',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_kegiatan_header' ) ) {
    /**
     * Mengambil teks pengantar & badge hero halaman kegiatan & agenda.
     *
     * @return array
     */
    function wakalumi_get_kegiatan_header() {
        $badge = get_option( 'options_kegiatan_badge', 'Agenda & Dokumentasi Kegiatan' );
        $title = get_option( 'options_kegiatan_title', 'Kegiatan & Agenda Bank Syariah Wakalumi' );
        $title = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $title );
        $desc  = get_option( 'options_kegiatan_desc', 'Informasi jadwal agenda kegiatan mendatang, pelatihan UMKM binaan, seminar literasi keuangan syariah, serta galeri dokumentasi CSR dan dinamika sosial perusahaan.' );

        $card_badge = get_option( 'options_kegiatan_card_badge', 'Keterbukaan & Kolaborasi' );
        $card_title = get_option( 'options_kegiatan_card_title', 'Partisipasi & Sinergi Umat' );
        $card_desc  = get_option( 'options_kegiatan_card_desc', 'Setiap kegiatan Bank Syariah Wakalumi diselenggarakan dengan mematuhi prinsip tata kelola yang baik (GCG), kepatuhan regulasi OJK, serta kemaslahatan ekonomi syariah bagi masyarakat.' );
        $card_desc  = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $card_desc );

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

if ( ! function_exists( 'wakalumi_get_kegiatan_empty_state' ) ) {
    /**
     * Konfigurasi pesan empty-state bila agenda mendatang kosong.
     *
     * @return array
     */
    function wakalumi_get_kegiatan_empty_state() {
        $title = get_option( 'options_kegiatan_empty_title', 'Belum Ada Agenda Mendatang yang Dijadwalkan' );
        $desc  = get_option( 'options_kegiatan_empty_desc', 'Saat ini belum ada agenda kegiatan publik baru yang dijadwalkan dalam waktu dekat. Anda dapat meninjau arsip dokumentasi kegiatan yang telah terlaksana melalui tab Kegiatan Terlaksana, atau menghubungi kami untuk informasi kemitraan.' );
        $cta   = get_option( 'options_kegiatan_empty_cta', 'Hubungi Sekretariat Perusahaan' );

        return [
            'title' => $title,
            'desc'  => $desc,
            'cta'   => $cta,
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_kegiatan_list' ) ) {
    /**
     * Mengambil seluruh daftar kegiatan & agenda (disimpan di wp_options).
     *
     * @return array
     */
    function wakalumi_get_kegiatan_list() {
        $saved = get_option( 'options_kegiatan_list', null );
        if ( is_array( $saved ) ) {
            foreach ( $saved as &$item ) {
                $item['judul']       = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $item['judul'] ?? '' );
                $item['lokasi']      = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $item['lokasi'] ?? '' );
                $item['ringkasan']   = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $item['ringkasan'] ?? '' );
                $item['isi_lengkap'] = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $item['isi_lengkap'] ?? '' );
            }
            unset( $item );
            return $saved;
        }

        // Default Sample Data (2 Mendatang, 2 Terlaksana)
        return [
            [
                'id'                 => 'act_1',
                'judul'              => 'Workshop Literasi & Edukasi Perbankan Syariah bagi Pelaku UMKM',
                'kategori'           => 'edukasi',
                'tipe_waktu'         => 'mendatang',
                'tanggal_mulai'      => date( 'Y-m-d', strtotime( '+14 days' ) ),
                'tanggal_selesai'    => '',
                'waktu'              => '09:00 - 12:30 WIB',
                'lokasi'             => 'Ballroom Kantor Pusat Bank Syariah Wakalumi, Cibubur / Live Zoom',
                'lokasi_maps_url'    => '',
                'status_pendaftaran' => 'buka',
                'link_pendaftaran'   => '',
                'link_text'          => 'Daftar Sekarang (Gratis)',
                'gambar'             => '',
                'ringkasan'          => 'Pelatihan interaktif pemahaman akad syariah (Murabahah & Mudharabah), pembukuan kas usaha mikro, serta akses pembiayaan modal kerja syariah.',
                'isi_lengkap'        => "Bank Syariah Wakalumi kembali menghadirkan program edukasi literasi keuangan syariah khusus bagi pelaku UMKM dan wirausaha muda binaan.\n\nDalam workshop ini, para peserta akan memperoleh panduan praktis:\n1. Pengenalan prinsip bebas riba, gharar, dan maysir dalam transaksi perbankan syariah.\n2. Tips pengelolaan arus kas (cash flow) usaha mikro di era digital.\n3. Skema pembiayaan produktif syariah dengan nisbah bagi hasil yang adil dan transparan.\n\nFasilitas: E-Sertifikat, materi pelatihan PDF, konsumsi, dan sesi konsultasi permodalan one-on-one bersama tim account officer Bank Syariah Wakalumi.",
                'dokumentasi_url'    => '',
                'status'             => 'aktif',
                'urutan'             => 1,
            ],
            [
                'id'                 => 'act_2',
                'judul'              => 'Rapat Umum Pemegang Saham (RUPS) Tahunan & Paparan Publik',
                'kategori'           => 'corporate',
                'tipe_waktu'         => 'mendatang',
                'tanggal_mulai'      => date( 'Y-m-d', strtotime( '+35 days' ) ),
                'tanggal_selesai'    => '',
                'waktu'              => '10:00 - 14:00 WIB',
                'lokasi'             => 'Ruang Rapat Utama Bank Syariah Wakalumi',
                'lokasi_maps_url'    => '',
                'status_pendaftaran' => 'terbatas',
                'link_pendaftaran'   => '',
                'link_text'          => 'Konfirmasi Kehadiran',
                'gambar'             => '',
                'ringkasan'          => 'Penyampaian laporan pertanggungjawaban direksi, laporan pengawasan dewan komisaris dan DPS, serta penetapan dividen tahun buku.',
                'isi_lengkap'        => "Agenda resmi Rapat Umum Pemegang Saham (RUPS) Tahunan Bank Syariah Wakalumi.\n\nAgenda RUPS mencakup:\n1. Persetujuan Laporan Tahunan dan Pengesahan Laporan Keuangan Audited.\n2. Laporan Pengawasan Dewan Pengawas Syariah atas kesesuaian operasional produk syariah.\n3. Penetapan penggunaan laba bersih dan pembagian dividen.\n4. Rencana kerja strategis dan arah ekspansi digitalisasi layanan perbankan tahun berikutnya.\n\n*Hadirin terbatas untuk Pemegang Saham, Dewan Komisaris, Direksi, Notaris, serta undangan resmi regulator.",
                'dokumentasi_url'    => '',
                'status'             => 'aktif',
                'urutan'             => 2,
            ],
            [
                'id'                 => 'act_3',
                'judul'              => 'Program CSR: Penyaluran Paket Sembako & Santunan Yatim Ramadhan Berkah',
                'kategori'           => 'csr',
                'tipe_waktu'         => 'terlaksana',
                'tanggal_mulai'      => date( 'Y-m-d', strtotime( '-90 days' ) ),
                'tanggal_selesai'    => '',
                'waktu'              => '08:30 - 12:00 WIB',
                'lokasi'             => 'Kecamatan Ciracas & Sekitarnya, Jakarta Timur',
                'lokasi_maps_url'    => '',
                'status_pendaftaran' => 'selesai',
                'link_pendaftaran'   => '',
                'link_text'          => 'Lihat Galeri Foto',
                'gambar'             => '',
                'ringkasan'          => 'Penyaluran ratusan paket kebutuhan pokok keluarga dan santunan dana pendidikan bagi anak yatim dhuafa di wilayah sekitar kantor bank.',
                'isi_lengkap'        => "Sebagai perwujudan pilar kepedulian sosial perbankan syariah, Bank Syariah Wakalumi telah sukses menyalurkan ratusan paket sembako berkah Ramadhan dan beasiswa santunan anak yatim.\n\nKegiatan ini dihadiri langsung oleh jajaran direksi dan karyawan Bank Syariah Wakalumi bersama tokoh masyarakat setempat. Dana CSR bersumber dari dana kebajikan (qardhul hasan) perusahaan yang dikelola secara amanah dan tepat sasaran.",
                'dokumentasi_url'    => '',
                'status'             => 'aktif',
                'urutan'             => 3,
            ],
            [
                'id'                 => 'act_4',
                'judul'              => 'Edukasi Keuangan Inklusif: Waspada Investasi Bodong & Anti-Fraud Digital',
                'kategori'           => 'edukasi',
                'tipe_waktu'         => 'terlaksana',
                'tanggal_mulai'      => date( 'Y-m-d', strtotime( '-120 days' ) ),
                'tanggal_selesai'    => '',
                'waktu'              => '13:30 - 16:00 WIB',
                'lokasi'             => 'Webinar Publik via Zoom & YouTube Live Bank Syariah Wakalumi',
                'lokasi_maps_url'    => '',
                'status_pendaftaran' => 'selesai',
                'link_pendaftaran'   => '',
                'link_text'          => 'Rekaman Materi',
                'gambar'             => '',
                'ringkasan'          => 'Sosialisasi kepatuhan POJK tentang perlindungan nasabah dan tips aman bertransaksi keuangan syariah di era digital.',
                'isi_lengkap'        => "Merespons maraknya penipuan berkedok investasi dan perbankan digital, Bank Syariah Wakalumi menyelenggarakan webinar nasional yang mengulas modus-modus social engineering, phishing, serta tips menjaga keamanan OTP dan data pribadi perbankan.\n\nKegiatan ini disambut antusias oleh ratusan nasabah dan masyarakat umum dengan sesi tanya jawab interaktif bersama narasumber kepatuhan perbankan.",
                'dokumentasi_url'    => '',
                'status'             => 'aktif',
                'urutan'             => 4,
            ],
        ];
    }
}


// ── 2. MENU REGISTRATION & ASSETS ───────────────────────────────────

add_action( 'admin_menu', 'wakalumi_register_kegiatan_page', 28 );
function wakalumi_register_kegiatan_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Kegiatan & Agenda Bank',
        'Kegiatan & Agenda',
        'manage_options',
        'wakalumi-kegiatan',
        'wakalumi_render_kegiatan_page'
    );
}

add_action( 'admin_enqueue_scripts', 'wakalumi_kegiatan_admin_assets' );
function wakalumi_kegiatan_admin_assets( $hook ) {
    if ( strpos( $hook, 'wakalumi-kegiatan' ) !== false ) {
        wp_enqueue_media();
    }
}


// ── 3. RENDER ADMIN INTERFACE & SAVE CONTROLLER ─────────────────────

function wakalumi_render_kegiatan_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Anda tidak memiliki hak akses untuk mengelola halaman ini.' );
    }

    $notice = '';

    // Handle Form Save
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['wakalumi_kegiatan_nonce'] ) ) {
        if ( ! wp_verify_nonce( $_POST['wakalumi_kegiatan_nonce'], 'wakalumi_kegiatan_action' ) ) {
            $notice = '<div class="notice notice-error is-dismissible"><p>Validasi keamanan gagal. Silakan coba kembali.</p></div>';
        } else {
            // 1. Header Banner Settings
            update_option( 'options_kegiatan_badge', sanitize_text_field( $_POST['options_kegiatan_badge'] ?? '' ) );
            update_option( 'options_kegiatan_title', sanitize_text_field( $_POST['options_kegiatan_title'] ?? '' ) );
            update_option( 'options_kegiatan_desc', sanitize_textarea_field( $_POST['options_kegiatan_desc'] ?? '' ) );

            // 2. Governance Card
            update_option( 'options_kegiatan_card_badge', sanitize_text_field( $_POST['options_kegiatan_card_badge'] ?? '' ) );
            update_option( 'options_kegiatan_card_title', sanitize_text_field( $_POST['options_kegiatan_card_title'] ?? '' ) );
            update_option( 'options_kegiatan_card_desc', sanitize_textarea_field( $_POST['options_kegiatan_card_desc'] ?? '' ) );

            // 3. Empty State Settings
            update_option( 'options_kegiatan_empty_title', sanitize_text_field( $_POST['options_kegiatan_empty_title'] ?? '' ) );
            update_option( 'options_kegiatan_empty_desc', sanitize_textarea_field( $_POST['options_kegiatan_empty_desc'] ?? '' ) );
            update_option( 'options_kegiatan_empty_cta', sanitize_text_field( $_POST['options_kegiatan_empty_cta'] ?? '' ) );

            // 4. Repeater Kegiatan & Agenda
            $ids          = $_POST['kegiatan_id'] ?? [];
            $juduls       = $_POST['kegiatan_judul'] ?? [];
            $kategoris    = $_POST['kegiatan_kategori'] ?? [];
            $tipe_waktus  = $_POST['kegiatan_tipe_waktu'] ?? [];
            $tgl_mulais   = $_POST['kegiatan_tanggal_mulai'] ?? [];
            $tgl_selesais = $_POST['kegiatan_tanggal_selesai'] ?? [];
            $waktus       = $_POST['kegiatan_waktu'] ?? [];
            $lokasis      = $_POST['kegiatan_lokasi'] ?? [];
            $maps_urls    = $_POST['kegiatan_lokasi_maps_url'] ?? [];
            $st_daftars   = $_POST['kegiatan_status_pendaftaran'] ?? [];
            $link_daftars = $_POST['kegiatan_link_pendaftaran'] ?? [];
            $link_texts   = $_POST['kegiatan_link_text'] ?? [];
            $gambars      = $_POST['kegiatan_gambar'] ?? [];
            $ringkasans   = $_POST['kegiatan_ringkasan'] ?? [];
            $isi_lengkaps = $_POST['kegiatan_isi_lengkap'] ?? [];
            $dok_urls     = $_POST['kegiatan_dokumentasi_url'] ?? [];
            $statuses     = $_POST['kegiatan_status'] ?? [];
            $urutans      = $_POST['kegiatan_urutan'] ?? [];

            $new_list = [];
            for ( $i = 0; $i < count( $ids ); $i++ ) {
                $judul = sanitize_text_field( $juduls[$i] ?? '' );
                if ( empty( $judul ) ) {
                    continue; // Lewati jika judul kosong
                }

                $new_list[] = [
                    'id'                 => sanitize_text_field( $ids[$i] ?? ( 'act_' . $i ) ),
                    'judul'              => $judul,
                    'kategori'           => sanitize_text_field( $kategoris[$i] ?? 'edukasi' ),
                    'tipe_waktu'         => sanitize_text_field( $tipe_waktus[$i] ?? 'mendatang' ),
                    'tanggal_mulai'      => sanitize_text_field( $tgl_mulais[$i] ?? date( 'Y-m-d' ) ),
                    'tanggal_selesai'    => sanitize_text_field( $tgl_selesais[$i] ?? '' ),
                    'waktu'              => sanitize_text_field( $waktus[$i] ?? '' ),
                    'lokasi'             => sanitize_text_field( $lokasis[$i] ?? '' ),
                    'lokasi_maps_url'    => esc_url_raw( $maps_urls[$i] ?? '' ),
                    'status_pendaftaran' => sanitize_text_field( $st_daftars[$i] ?? 'buka' ),
                    'link_pendaftaran'   => esc_url_raw( $link_daftars[$i] ?? '' ),
                    'link_text'          => sanitize_text_field( $link_texts[$i] ?? 'Daftar Sekarang' ),
                    'gambar'             => esc_url_raw( $gambars[$i] ?? '' ),
                    'ringkasan'          => sanitize_textarea_field( $ringkasans[$i] ?? '' ),
                    'isi_lengkap'        => sanitize_textarea_field( $isi_lengkaps[$i] ?? '' ),
                    'dokumentasi_url'    => esc_url_raw( $dok_urls[$i] ?? '' ),
                    'status'             => sanitize_text_field( $statuses[$i] ?? 'aktif' ),
                    'urutan'             => intval( $urutans[$i] ?? ( $i + 1 ) ),
                ];
            }

            // Urutkan berdasarkan nilai urutan
            usort( $new_list, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );

            update_option( 'options_kegiatan_list', $new_list );

            $notice = '<div class="notice notice-success is-dismissible"><p><strong>Berhasil!</strong> Seluruh pengaturan Kegiatan & Agenda Bank telah disimpan.</p></div>';
        }
    }

    // Load Data
    $header      = wakalumi_get_kegiatan_header();
    $empty_state = wakalumi_get_kegiatan_empty_state();
    $categories  = wakalumi_get_kegiatan_categories();
    $list        = wakalumi_get_kegiatan_list();

    $total_count     = count( $list );
    $upcoming_count  = count( array_filter( $list, fn($x) => ( $x['tipe_waktu'] ?? '' ) === 'mendatang' && ( $x['status'] ?? '' ) === 'aktif' ) );
    $completed_count = count( array_filter( $list, fn($x) => ( $x['tipe_waktu'] ?? '' ) === 'terlaksana' && ( $x['status'] ?? '' ) === 'aktif' ) );
    ?>
    <div class="wrap" style="max-width: 1060px; margin-top: 20px;">

        <!-- Header Title Bar -->
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #e2e8f0;">
            <div>
                <h1 style="display: flex; align-items: center; gap: 10px; font-size: 24px; font-weight: 800; color: #0f172a; margin: 0;">
                    <span class="dashicons dashicons-calendar-alt" style="font-size: 32px; width: 32px; height: 32px; color: #088395;"></span>
                    Kegiatan & Agenda Bank Syariah Wakalumi
                </h1>
                <p style="margin: 6px 0 0 42px; color: #64748b; font-size: 13px;">
                    Kelola publikasi agenda mendatang (jadwal seminar, RUPS, workshop UMKM) serta galeri dokumentasi kegiatan sosial/CSR perusahaan.
                </p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="<?php echo esc_url( home_url( '/informasi/kegiatan/' ) ); ?>" target="_blank" class="button" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600;">
                    <span class="dashicons dashicons-external"></span> Lihat Halaman Kegiatan
                </a>
            </div>
        </div>

        <?php echo $notice; ?>

        <form method="post" action="" id="wakalumi-kegiatan-form">
            <?php wp_nonce_field( 'wakalumi_kegiatan_action', 'wakalumi_kegiatan_nonce' ); ?>

            <!-- STATS QUICK COUNTER -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 25px;">
                <div style="background: #ffffff; padding: 18px; border-radius: 12px; border: 1px solid #cbd5e1; border-left: 5px solid #088395; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">Total Kegiatan Terdaftar</div>
                    <div style="font-size: 26px; font-weight: 800; color: #0f172a; margin-top: 4px;"><?php echo $total_count; ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">agenda</span></div>
                </div>
                <div style="background: #ffffff; padding: 18px; border-radius: 12px; border: 1px solid #cbd5e1; border-left: 5px solid #10b981; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">Agenda Mendatang (Aktif)</div>
                    <div style="font-size: 26px; font-weight: 800; color: #047857; margin-top: 4px;"><?php echo $upcoming_count; ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">jadwal</span></div>
                </div>
                <div style="background: #ffffff; padding: 18px; border-radius: 12px; border: 1px solid #cbd5e1; border-left: 5px solid #6366f1; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">Kegiatan Terlaksana</div>
                    <div style="font-size: 26px; font-weight: 800; color: #4338ca; margin-top: 4px;"><?php echo $completed_count; ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">dokumentasi</span></div>
                </div>
            </div>

            <!-- SECTION 1: HEADER BANNER & BADGE WATERMARK CARD -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
                <h2 style="font-size: 17px; font-weight: 700; color: #088395; margin: 0 0 16px 0; padding-bottom: 10px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-welcome-widgets-menus" style="color: #088395;"></span>
                    Header &amp; Pengantar Halaman Kegiatan
                </h2>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 16px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Badge Teks Atas Hero</label>
                        <input type="text" name="options_kegiatan_badge" value="<?php echo esc_attr( $header['badge'] ); ?>" class="large-text" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Judul Utama Halaman</label>
                        <input type="text" name="options_kegiatan_title" value="<?php echo esc_attr( $header['title'] ); ?>" class="large-text" style="border-radius: 6px; font-weight: 700;">
                    </div>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Deskripsi / Ringkasan Pengantar</label>
                    <textarea name="options_kegiatan_desc" rows="3" class="large-text" style="border-radius: 6px;"><?php echo esc_textarea( $header['desc'] ); ?></textarea>
                </div>

                <!-- Governance Card Preview Settings -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; margin-top: 15px;">
                    <h3 style="font-size: 13px; font-weight: 700; color: #1e293b; margin: 0 0 10px 0;">Kartu Governance &amp; Nilai Bank (Kanan Hero)</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 10px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 600; color: #475569; margin-bottom: 4px;">Badge Kartu:</label>
                            <input type="text" name="options_kegiatan_card_badge" value="<?php echo esc_attr( $header['card_badge'] ); ?>" class="large-text" style="border-radius: 6px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 600; color: #475569; margin-bottom: 4px;">Judul Kartu:</label>
                            <input type="text" name="options_kegiatan_card_title" value="<?php echo esc_attr( $header['card_title'] ); ?>" class="large-text" style="border-radius: 6px;">
                        </div>
                    </div>
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 600; color: #475569; margin-bottom: 4px;">Penjelasan Nilai Kartu:</label>
                        <textarea name="options_kegiatan_card_desc" rows="2" class="large-text" style="border-radius: 6px;"><?php echo esc_textarea( $header['card_desc'] ); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: EMPTY STATE FRIENDLY MESSAGE SETTING -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
                <h2 style="font-size: 17px; font-weight: 700; color: #088395; margin: 0 0 10px 0; padding-bottom: 10px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-info" style="color: #088395;"></span>
                    Pesan Khusus Saat Agenda Mendatang Kosong (Empty-State)
                </h2>
                <p style="color: #64748b; font-size: 13px; margin: 0 0 16px 0;">
                    Karena agenda publik tidak selalu aktif setiap saat, teks di bawah ini akan otomatis tampil dengan desain kartu yang ramah &amp; elegan bila belum ada jadwal mendatang.
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Judul Saat Agenda Kosong</label>
                        <input type="text" name="options_kegiatan_empty_title" value="<?php echo esc_attr( $empty_state['title'] ); ?>" class="large-text" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Label Tombol Kontak / Narahubung</label>
                        <input type="text" name="options_kegiatan_empty_cta" value="<?php echo esc_attr( $empty_state['cta'] ); ?>" class="large-text" style="border-radius: 6px;">
                    </div>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Penjelasan Pesan Saat Agenda Kosong</label>
                    <textarea name="options_kegiatan_empty_desc" rows="2" class="large-text" style="border-radius: 6px;"><?php echo esc_textarea( $empty_state['desc'] ); ?></textarea>
                </div>
            </div>

            <!-- SECTION 3: REPEATER DAFTAR KEGIATAN & AGENDA -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                    <div>
                        <h2 style="font-size: 17px; font-weight: 700; color: #088395; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <span class="dashicons dashicons-list-view" style="color: #088395;"></span>
                            Daftar Agenda &amp; Dokumentasi Kegiatan (Repeater)
                        </h2>
                        <p style="color: #64748b; font-size: 12px; margin: 4px 0 0 0;">
                            Atur urutan dengan menggeser kartu, atau ubah status menjadi <strong>Akan Datang</strong> untuk agenda baru atau <strong>Terlaksana</strong> untuk dokumentasi.
                        </p>
                    </div>
                    <button type="button" id="btn-add-kegiatan" class="button button-primary" style="background: #088395; border-color: #066e7d; font-weight: 700; padding: 4px 16px; border-radius: 6px; display: inline-flex; align-items: center; gap: 6px;">
                        <span class="dashicons dashicons-plus-alt2" style="margin-top: 1px;"></span> Tambah Kegiatan / Agenda Baru
                    </button>
                </div>

                <div id="kegiatan-repeater-container" style="display: flex; flex-direction: column; gap: 16px;">
                    <?php if ( empty( $list ) ) : ?>
                        <div id="no-kegiatan-notice" style="text-align: center; padding: 40px; background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 10px; color: #64748b;">
                            <span class="dashicons dashicons-calendar" style="font-size: 40px; width: 40px; height: 40px; color: #94a3b8; margin-bottom: 10px;"></span>
                            <p style="font-size: 14px; margin: 0;">Belum ada kegiatan yang ditambahkan. Klik tombol <strong>+ Tambah Kegiatan / Agenda Baru</strong> untuk memulai.</p>
                        </div>
                    <?php else : ?>
                        <?php foreach ( $list as $index => $item ) : 
                            $row_id      = esc_attr( $item['id'] ?? ( 'act_' . $index ) );
                            $judul       = $item['judul'] ?? '';
                            $kategori    = $item['kategori'] ?? 'edukasi';
                            $tipe_waktu  = $item['tipe_waktu'] ?? 'mendatang';
                            $tgl_mulai   = $item['tanggal_mulai'] ?? date( 'Y-m-d' );
                            $tgl_selesai = $item['tanggal_selesai'] ?? '';
                            $waktu       = $item['waktu'] ?? '';
                            $lokasi      = $item['lokasi'] ?? '';
                            $maps_url    = $item['lokasi_maps_url'] ?? '';
                            $st_daftar   = $item['status_pendaftaran'] ?? 'buka';
                            $link_daftar = $item['link_pendaftaran'] ?? '';
                            $link_text   = $item['link_text'] ?? 'Daftar Sekarang';
                            $gambar      = $item['gambar'] ?? '';
                            $ringkasan   = $item['ringkasan'] ?? '';
                            $isi_lengkap = $item['isi_lengkap'] ?? '';
                            $dok_url     = $item['dokumentasi_url'] ?? '';
                            $status      = $item['status'] ?? 'aktif';
                            $urutan      = $item['urutan'] ?? ( $index + 1 );
                        ?>
                            <div class="kegiatan-card" data-index="<?php echo $index; ?>" style="background: #ffffff; border: 1px solid #cbd5e1; border-left: 5px solid <?php echo $tipe_waktu === 'mendatang' ? '#10b981' : '#6366f1'; ?>; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.04); overflow: hidden; transition: all 0.2s ease;">
                                <!-- Card Header (Clickable to collapse/expand) -->
                                <div class="kegiatan-card-header" style="padding: 14px 18px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none;">
                                    <div style="display: flex; align-items: center; gap: 12px; flex: 1; min-width: 0;">
                                        <span class="dashicons dashicons-move" style="color: #94a3b8; cursor: grab;" title="Geser untuk urutan"></span>
                                        <span class="kegiatan-card-number" style="font-weight: 800; font-size: 13px; color: #475569; background: #e2e8f0; padding: 2px 8px; border-radius: 4px;">#<?php echo ( $index + 1 ); ?></span>
                                        <div style="min-width: 0; flex: 1;">
                                            <div class="kegiatan-preview-title" style="font-weight: 700; font-size: 14px; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                <?php echo esc_html( $judul ? $judul : '(Belum ada judul kegiatan)' ); ?>
                                            </div>
                                            <div style="display: flex; align-items: center; gap: 8px; font-size: 11px; color: #64748b; margin-top: 3px; flex-wrap: wrap;">
                                                <span>📅 <?php echo esc_html( $tgl_mulai ); ?></span>
                                                <span>•</span>
                                                <span style="text-transform: capitalize;">🏷️ <?php echo esc_html( $categories[$kategori]['label'] ?? $kategori ); ?></span>
                                                <?php if ( $tipe_waktu === 'mendatang' ) : ?>
                                                    <span style="background: #d1fae5; color: #065f46; font-weight: 700; padding: 1px 6px; border-radius: 4px; font-size: 10px;">🟢 AKAN DATANG</span>
                                                <?php else : ?>
                                                    <span style="background: #e0e7ff; color: #3730a3; font-weight: 700; padding: 1px 6px; border-radius: 4px; font-size: 10px;">🟣 TERLAKSANA</span>
                                                <?php endif; ?>
                                                <?php if ( ! empty( $lokasi ) ) : ?>
                                                    <span>📍 <?php echo esc_html( wp_trim_words( $lokasi, 4 ) ); ?></span>
                                                <?php endif; ?>
                                                <?php if ( ! empty( $gambar ) ) : ?>
                                                    <span style="background: #e0f2fe; color: #0369a1; font-weight: 700; padding: 1px 6px; border-radius: 4px; font-size: 10px;">🖼️ FOTO</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <button type="button" class="btn-toggle-card button-link" style="color: #64748b; text-decoration: none;" title="Buka / Tutup Form">
                                            <span class="dashicons dashicons-arrow-down-alt2"></span>
                                        </button>
                                        <button type="button" class="btn-delete-card button-link" style="color: #ef4444; text-decoration: none; padding: 4px 6px;" title="Hapus Kegiatan Ini">
                                            <span class="dashicons dashicons-trash"></span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Card Body (Form Fields) -->
                                <div class="kegiatan-card-body" style="padding: 20px;">
                                    <input type="hidden" name="kegiatan_id[]" value="<?php echo esc_attr( $row_id ); ?>">
                                    <input type="hidden" name="kegiatan_urutan[]" value="<?php echo esc_attr( $urutan ); ?>" class="card-urutan-input">

                                    <!-- Row 1: Judul & Kategori & Tipe Waktu -->
                                    <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Nama / Judul Kegiatan *</label>
                                            <input type="text" name="kegiatan_judul[]" value="<?php echo esc_attr( $judul ); ?>" class="large-text kegiatan-judul-input" placeholder="Contoh: Workshop Literasi Keuangan Syariah bagi Pelaku UMKM" required style="border-radius: 6px; font-weight: 600;">
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Kategori Kegiatan</label>
                                            <select name="kegiatan_kategori[]" class="large-text" style="border-radius: 6px;">
                                                <?php foreach ( $categories as $ckey => $cval ) : ?>
                                                    <option value="<?php echo esc_attr( $ckey ); ?>" <?php selected( $kategori, $ckey ); ?>>
                                                        <?php echo esc_html( $cval['label'] ); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Status Waktu</label>
                                            <select name="kegiatan_tipe_waktu[]" class="large-text kegiatan-tipe-select" style="border-radius: 6px; font-weight: 700;">
                                                <option value="mendatang" <?php selected( $tipe_waktu, 'mendatang' ); ?>>🟢 Agenda Mendatang</option>
                                                <option value="terlaksana" <?php selected( $tipe_waktu, 'terlaksana' ); ?>>🟣 Kegiatan Terlaksana</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Row 2: Poster Visual / Foto Dokumentasi -->
                                    <div style="margin-bottom: 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                                            🖼️ Foto Poster / Dokumentasi Visual Kegiatan
                                        </label>
                                        <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                                            <img id="img_prev_<?php echo $row_id; ?>" src="<?php echo esc_url( $gambar ); ?>" style="width: 70px; height: 46px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; <?php echo empty( $gambar ) ? 'display:none;' : ''; ?>" />
                                            <input type="text" id="img_<?php echo $row_id; ?>" name="kegiatan_gambar[]" value="<?php echo esc_attr( $gambar ); ?>" class="large-text" placeholder="https://.../poster-agenda.jpg" style="flex: 1; min-width: 200px; border-radius: 6px;">
                                            <button type="button" class="button wkl-upload-img-btn" data-target="img_<?php echo $row_id; ?>" data-preview="img_prev_<?php echo $row_id; ?>" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600; white-space: nowrap;">
                                                <span class="dashicons dashicons-format-image"></span> Pilih Gambar
                                            </button>
                                            <button type="button" class="button-link wkl-remove-img-btn" data-target="img_<?php echo $row_id; ?>" data-preview="img_prev_<?php echo $row_id; ?>" style="color: #ef4444; font-size: 12px; <?php echo empty( $gambar ) ? 'display:none;' : ''; ?>">
                                                ✕ Hapus
                                            </button>
                                        </div>
                                        <p style="font-size: 11px; color: #64748b; margin: 4px 0 0 0;">
                                            Format gambar disarankan JPG, PNG, atau WebP (Rasio 16:9 atau 4:3).
                                        </p>
                                    </div>

                                    <!-- Row 3: Tanggal Mulai, Tanggal Selesai, Waktu / Jam, Status Publikasi -->
                                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tanggal Acara / Mulai *</label>
                                            <input type="date" name="kegiatan_tanggal_mulai[]" value="<?php echo esc_attr( $tgl_mulai ); ?>" class="large-text" required style="border-radius: 6px;">
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tanggal Selesai (Opsional)</label>
                                            <input type="date" name="kegiatan_tanggal_selesai[]" value="<?php echo esc_attr( $tgl_selesai ); ?>" class="large-text" style="border-radius: 6px;">
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Waktu / Jam Pelaksanaan</label>
                                            <input type="text" name="kegiatan_waktu[]" value="<?php echo esc_attr( $waktu ); ?>" class="large-text" placeholder="Contoh: 09:00 - 12:00 WIB" style="border-radius: 6px;">
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Status Publikasi</label>
                                            <select name="kegiatan_status[]" class="large-text" style="border-radius: 6px;">
                                                <option value="aktif" <?php selected( $status, 'aktif' ); ?>>Aktif (Tampil Publik)</option>
                                                <option value="arsip" <?php selected( $status, 'arsip' ); ?>>Arsip (Disembunyikan)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Row 4: Tempat / Lokasi & Link Maps/Webinar -->
                                    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 14px; margin-bottom: 14px;">
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tempat / Lokasi Penyelenggaraan</label>
                                            <input type="text" name="kegiatan_lokasi[]" value="<?php echo esc_attr( $lokasi ); ?>" class="large-text" placeholder="Contoh: Aula Gedung Pusat Bank Syariah Wakalumi, Cibubur / Live Zoom" style="border-radius: 6px;">
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Link Google Maps / Tautan Webinar (Opsional)</label>
                                            <input type="text" name="kegiatan_lokasi_maps_url[]" value="<?php echo esc_attr( $maps_url ); ?>" class="large-text" placeholder="https://maps.google.com/... atau https://zoom.us/..." style="border-radius: 6px;">
                                        </div>
                                    </div>

                                    <!-- Row 5: Pendaftaran & Tombol Aksi -->
                                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 12px 14px; margin-bottom: 14px;">
                                        <div style="display: grid; grid-template-columns: 1fr 1.5fr 1fr; gap: 12px;">
                                            <div>
                                                <label style="display: block; font-size: 11px; font-weight: 700; color: #166534; margin-bottom: 3px;">Status Pendaftaran</label>
                                                <select name="kegiatan_status_pendaftaran[]" class="large-text" style="border-radius: 6px; font-size: 12px;">
                                                    <option value="buka" <?php selected( $st_daftar, 'buka' ); ?>>🟢 Pendaftaran Terbuka</option>
                                                    <option value="terbatas" <?php selected( $st_daftar, 'terbatas' ); ?>>🟡 Kuota Terbatas</option>
                                                    <option value="tutup" <?php selected( $st_daftar, 'tutup' ); ?>>🔴 Pendaftaran Ditutup</option>
                                                    <option value="tanpa_daftar" <?php selected( $st_daftar, 'tanpa_daftar' ); ?>>⚪ Terbuka Tanpa Daftar</option>
                                                    <option value="selesai" <?php selected( $st_daftar, 'selesai' ); ?>>⚫ Kegiatan Telah Selesai</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label style="display: block; font-size: 11px; font-weight: 700; color: #166534; margin-bottom: 3px;">URL Formulir Pendaftaran / Kontak WA (Opsional)</label>
                                                <input type="text" name="kegiatan_link_pendaftaran[]" value="<?php echo esc_attr( $link_daftar ); ?>" class="large-text" placeholder="https://forms.gle/... atau https://wa.me/..." style="border-radius: 6px; font-size: 12px;">
                                            </div>
                                            <div>
                                                <label style="display: block; font-size: 11px; font-weight: 700; color: #166534; margin-bottom: 3px;">Label Teks Tombol</label>
                                                <input type="text" name="kegiatan_link_text[]" value="<?php echo esc_attr( $link_text ); ?>" class="large-text" placeholder="Daftar Sekarang" style="border-radius: 6px; font-size: 12px;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row 6: Ringkasan Singkat -->
                                    <div style="margin-bottom: 14px;">
                                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                                            Ringkasan Singkat (Ditampilkan pada Kartu Depan) *
                                        </label>
                                        <textarea name="kegiatan_ringkasan[]" rows="2" class="large-text" placeholder="Tuliskan 1-2 kalimat ringkasan inti acara yang menarik perhatian pengunjung..." required style="border-radius: 6px;"><?php echo esc_textarea( $ringkasan ); ?></textarea>
                                    </div>

                                    <!-- Row 7: Penjelasan Lengkap / Rundown Acara -->
                                    <div style="margin-bottom: 14px;">
                                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                                            Rincian Lengkap / Rundown / Persyaratan (Ditampilkan saat Modal Dibuka) *
                                        </label>
                                        <textarea name="kegiatan_isi_lengkap[]" rows="5" class="large-text" placeholder="Tuliskan jadwal susunan acara, narasumber, tata tertib, benefit peserta, dll..." required style="border-radius: 6px; font-family: monospace; font-size: 13px;"><?php echo esc_textarea( $isi_lengkap ); ?></textarea>
                                    </div>

                                    <!-- Row 8: Tautan Dokumentasi Galeri Foto (Jika ada) -->
                                    <div style="margin-bottom: 0;">
                                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                                            Tautan Dokumentasi Foto / Liputan Lengkap (Opsional)
                                        </label>
                                        <input type="text" name="kegiatan_dokumentasi_url[]" value="<?php echo esc_attr( $dok_url ); ?>" class="large-text" placeholder="https://... atau /berita/... /informasi/galeri/" style="border-radius: 6px;">
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div style="margin-top: 18px; text-align: center;">
                    <button type="button" id="btn-add-kegiatan-bottom" class="button" style="padding: 6px 20px; font-weight: 600; border-radius: 6px;">
                        + Tambah Kegiatan Baru Lainnya
                    </button>
                </div>
            </div>

            <!-- SUBMIT BUTTON FIXED BAR -->
            <div style="position: sticky; bottom: 20px; background: rgba(255,255,255,0.95); backdrop-filter: blur(8px); padding: 15px 25px; border-radius: 12px; border: 1px solid #cbd5e1; box-shadow: 0 4px 14px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between; z-index: 100;">
                <div style="font-size: 13px; color: #64748b;">
                    💡 Pastikan semua perubahan sudah sesuai sebelum menekan tombol simpan.
                </div>
                <button type="submit" class="button button-primary button-large" style="background: #088395; border-color: #066e7d; font-weight: 800; padding: 0 30px; height: 42px; font-size: 14px; border-radius: 8px;">
                    Simpan Seluruh Kegiatan &amp; Agenda
                </button>
            </div>

        </form>

    </div>

    <!-- TEMPLATE CLONE ROW UNTUK ITEM BARU -->
    <template id="tmpl-kegiatan-card">
        <div class="kegiatan-card" data-index="{{index}}" style="background: #ffffff; border: 1px solid #cbd5e1; border-left: 5px solid #10b981; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.04); overflow: hidden; transition: all 0.2s ease;">
            <div class="kegiatan-card-header" style="padding: 14px 18px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none;">
                <div style="display: flex; align-items: center; gap: 12px; flex: 1; min-width: 0;">
                    <span class="dashicons dashicons-move" style="color: #94a3b8; cursor: grab;" title="Geser untuk urutan"></span>
                    <span class="kegiatan-card-number" style="font-weight: 800; font-size: 13px; color: #475569; background: #e2e8f0; padding: 2px 8px; border-radius: 4px;">#{{num}}</span>
                    <div style="min-width: 0; flex: 1;">
                        <div class="kegiatan-preview-title" style="font-weight: 700; font-size: 14px; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            (Kegiatan Baru — Belum Disimpan)
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; font-size: 11px; color: #64748b; margin-top: 3px;">
                            <span>📅 <?php echo date( 'Y-m-d' ); ?></span>
                            <span>•</span>
                            <span>🏷️ Edukasi &amp; Literasi</span>
                            <span style="background: #d1fae5; color: #065f46; font-weight: 700; padding: 1px 6px; border-radius: 4px; font-size: 10px;">🟢 BARU</span>
                        </div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <button type="button" class="btn-toggle-card button-link" style="color: #64748b; text-decoration: none;" title="Buka / Tutup Form">
                        <span class="dashicons dashicons-arrow-down-alt2"></span>
                    </button>
                    <button type="button" class="btn-delete-card button-link" style="color: #ef4444; text-decoration: none; padding: 4px 6px;" title="Hapus Kegiatan Ini">
                        <span class="dashicons dashicons-trash"></span>
                    </button>
                </div>
            </div>

            <div class="kegiatan-card-body" style="padding: 20px;">
                <input type="hidden" name="kegiatan_id[]" value="{{row_id}}">
                <input type="hidden" name="kegiatan_urutan[]" value="{{num}}" class="card-urutan-input">

                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Nama / Judul Kegiatan *</label>
                        <input type="text" name="kegiatan_judul[]" value="" class="large-text kegiatan-judul-input" placeholder="Tuliskan nama kegiatan..." required style="border-radius: 6px; font-weight: 600;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Kategori Kegiatan</label>
                        <select name="kegiatan_kategori[]" class="large-text" style="border-radius: 6px;">
                            <?php foreach ( $categories as $ckey => $cval ) : ?>
                                <option value="<?php echo esc_attr( $ckey ); ?>">
                                    <?php echo esc_html( $cval['label'] ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Status Waktu</label>
                        <select name="kegiatan_tipe_waktu[]" class="large-text kegiatan-tipe-select" style="border-radius: 6px; font-weight: 700;">
                            <option value="mendatang">🟢 Agenda Mendatang</option>
                            <option value="terlaksana">🟣 Kegiatan Terlaksana</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom: 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                        🖼️ Foto Poster / Dokumentasi Visual Kegiatan
                    </label>
                    <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <img id="img_prev_{{row_id}}" src="" style="width: 70px; height: 46px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; display:none;" />
                        <input type="text" id="img_{{row_id}}" name="kegiatan_gambar[]" value="" class="large-text" placeholder="https://.../poster-agenda.jpg" style="flex: 1; min-width: 200px; border-radius: 6px;">
                        <button type="button" class="button wkl-upload-img-btn" data-target="img_{{row_id}}" data-preview="img_prev_{{row_id}}" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600; white-space: nowrap;">
                            <span class="dashicons dashicons-format-image"></span> Pilih Gambar
                        </button>
                        <button type="button" class="button-link wkl-remove-img-btn" data-target="img_{{row_id}}" data-preview="img_prev_{{row_id}}" style="color: #ef4444; font-size: 12px; display:none;">
                            ✕ Hapus
                        </button>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tanggal Acara / Mulai *</label>
                        <input type="date" name="kegiatan_tanggal_mulai[]" value="<?php echo date( 'Y-m-d' ); ?>" class="large-text" required style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tanggal Selesai (Opsional)</label>
                        <input type="date" name="kegiatan_tanggal_selesai[]" value="" class="large-text" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Waktu / Jam Pelaksanaan</label>
                        <input type="text" name="kegiatan_waktu[]" value="" class="large-text" placeholder="Contoh: 09:00 - 12:00 WIB" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Status Publikasi</label>
                        <select name="kegiatan_status[]" class="large-text" style="border-radius: 6px;">
                            <option value="aktif">Aktif (Tampil Publik)</option>
                            <option value="arsip">Arsip (Disembunyikan)</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 14px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tempat / Lokasi Penyelenggaraan</label>
                        <input type="text" name="kegiatan_lokasi[]" value="" class="large-text" placeholder="Contoh: Gedung Pusat Bank Syariah Wakalumi, Cibubur" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Link Maps / Webinar (Opsional)</label>
                        <input type="text" name="kegiatan_lokasi_maps_url[]" value="" class="large-text" placeholder="https://..." style="border-radius: 6px;">
                    </div>
                </div>

                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 12px 14px; margin-bottom: 14px;">
                    <div style="display: grid; grid-template-columns: 1fr 1.5fr 1fr; gap: 12px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #166534; margin-bottom: 3px;">Status Pendaftaran</label>
                            <select name="kegiatan_status_pendaftaran[]" class="large-text" style="border-radius: 6px; font-size: 12px;">
                                <option value="buka">🟢 Pendaftaran Terbuka</option>
                                <option value="terbatas">🟡 Kuota Terbatas</option>
                                <option value="tutup">🔴 Pendaftaran Ditutup</option>
                                <option value="tanpa_daftar">⚪ Terbuka Tanpa Daftar</option>
                                <option value="selesai">⚫ Kegiatan Telah Selesai</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #166534; margin-bottom: 3px;">URL Formulir Pendaftaran / WA</label>
                            <input type="text" name="kegiatan_link_pendaftaran[]" value="" class="large-text" placeholder="https://forms.gle/..." style="border-radius: 6px; font-size: 12px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #166534; margin-bottom: 3px;">Label Teks Tombol</label>
                            <input type="text" name="kegiatan_link_text[]" value="Daftar Sekarang" class="large-text" style="border-radius: 6px; font-size: 12px;">
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                        Ringkasan Singkat (Ditampilkan pada Kartu Depan) *
                    </label>
                    <textarea name="kegiatan_ringkasan[]" rows="2" class="large-text" placeholder="Tuliskan 1-2 kalimat ringkasan inti acara..." required style="border-radius: 6px;"></textarea>
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                        Rincian Lengkap / Rundown / Persyaratan (Ditampilkan saat Modal Dibuka) *
                    </label>
                    <textarea name="kegiatan_isi_lengkap[]" rows="5" class="large-text" placeholder="Tuliskan jadwal susunan acara, narasumber, tata tertib, benefit peserta, dll..." required style="border-radius: 6px; font-family: monospace; font-size: 13px;"></textarea>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                        Tautan Dokumentasi Foto / Liputan Lengkap (Opsional)
                    </label>
                    <input type="text" name="kegiatan_dokumentasi_url[]" value="" class="large-text" placeholder="https://... atau /berita/... /informasi/galeri/" style="border-radius: 6px;">
                </div>
            </div>
        </div>
    </template>

    <!-- ADMIN JS JQUERY SCRIPT -->
    <script>
    jQuery(document).ready(function($) {
        // Toggle Collapse Card
        $(document).on('click', '.kegiatan-card-header', function(e) {
            if ($(e.target).closest('.btn-delete-card').length) return;
            var body = $(this).closest('.kegiatan-card').find('.kegiatan-card-body');
            var icon = $(this).find('.btn-toggle-card .dashicons');
            body.slideToggle(200);
            if (icon.hasClass('dashicons-arrow-down-alt2')) {
                icon.removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
            } else {
                icon.removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');
            }
        });

        // Live preview title update
        $(document).on('input', '.kegiatan-judul-input', function() {
            var val = $(this).val().trim();
            var preview = $(this).closest('.kegiatan-card').find('.kegiatan-preview-title');
            preview.text(val || '(Belum ada judul kegiatan)');
        });

        // Tipe Waktu border color update
        $(document).on('change', '.kegiatan-tipe-select', function() {
            var card = $(this).closest('.kegiatan-card');
            if ($(this).val() === 'mendatang') {
                card.css('border-left-color', '#10b981');
            } else {
                card.css('border-left-color', '#6366f1');
            }
        });

        // Add Card Logic
        $('#btn-add-kegiatan, #btn-add-kegiatan-bottom').on('click', function(e) {
            e.preventDefault();
            $('#no-kegiatan-notice').hide();
            var container = $('#kegiatan-repeater-container');
            var count = container.find('.kegiatan-card').length;
            var num = count + 1;
            var rowId = 'act_' + Date.now();
            var templateHtml = $('#tmpl-kegiatan-card').html();

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
            if (confirm('Yakin ingin menghapus kegiatan ini?')) {
                var card = $(this).closest('.kegiatan-card');
                card.slideUp(200, function() {
                    card.remove();
                    reindexCards();
                });
            }
        });

        function reindexCards() {
            var cards = $('#kegiatan-repeater-container .kegiatan-card');
            if (cards.length === 0) {
                $('#no-kegiatan-notice').show();
            }
            cards.each(function(i) {
                $(this).find('.kegiatan-card-number').text('#' + (i + 1));
                $(this).find('.card-urutan-input').val(i + 1);
            });
        }

        // Media Uploader for Gambar Visual Kegiatan
        $(document).on('click', '.wkl-upload-img-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $('#' + btn.data('target'));
            var previewImg  = $('#' + btn.data('preview'));
            var removeBtn   = btn.siblings('.wkl-remove-img-btn');

            var customUploader = wp.media({
                title: 'Pilih atau Unggah Poster Visual Kegiatan',
                button: { text: 'Gunakan Gambar Ini' },
                multiple: false,
                library: { type: 'image' }
            });

            customUploader.on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                previewImg.attr('src', attachment.url).show();
                removeBtn.show();
            });

            customUploader.open();
        });

        // Remove Media
        $(document).on('click', '.wkl-remove-img-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $('#' + btn.data('target'));
            var previewImg  = $('#' + btn.data('preview'));
            targetInput.val('');
            previewImg.attr('src', '').hide();
            btn.hide();
        });
    });
    </script>
    <?php
}

