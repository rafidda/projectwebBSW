<?php
/**
 * Admin: Karir & Rekrutmen Insan Bank Syariah Wakalumi (BSW)
 * 
 * Pengelolaan terpadu informasi karir, lowongan pekerjaan aktif,
 * alur seleksi rekrutmen profesional, tautan pendaftaran (Google Form),
 * serta himbauan resmi anti-fraud bebas biaya perbankan syariah.
 * 
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ── 1. DATA HELPERS ─────────────────────────────────────────────────

if ( ! function_exists( 'wakalumi_get_karir_header' ) ) {
    /**
     * Mengambil teks pengantar dan judul header halaman karir.
     *
     * @return array
     */
    function wakalumi_get_karir_header() {
        $badge = get_option( 'options_karir_badge', 'Peluang Karir & Rekrutmen Resmi' );
        $title = get_option( 'options_karir_title', 'Tumbuh & Berkarya Bersama Bank Syariah Wakalumi' );
        $title = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $title );
        $desc  = get_option( 'options_karir_desc', 'Bergabunglah bersama insan perbankan syariah yang amanah, berintegritas tinggi, dan berorientasi pada kemajuan ekonomi umat. Temukan peluang karir terbaik yang selaras dengan potensi dan nilai-nilai kebaikan Anda.' );

        return [
            'badge' => $badge,
            'title' => $title,
            'desc'  => $desc,
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_values' ) ) {
    /**
     * Mengambil 4 pilar budaya dan nilai kerja profesional Insan BSW (Tanpa emotikon, bahasa formal perbankan).
     *
     * @return array
     */
    function wakalumi_get_karir_values() {
        return [
            [
                'title' => 'Prinsip Muamalah Syariah',
                'desc'  => 'Bekerja dalam ekosistem perbankan yang berlandaskan syariat Islam, bebas riba, serta mengedepankan kehalalan dan keadilan transaksi muamalah.',
                'icon'  => 'shield',
            ],
            [
                'title' => 'Pengembangan Potensi Insan BSW',
                'desc'  => 'Dukungan berkelanjutan untuk mengasah keahlian dan wawasan perbankan syariah melalui bimbingan kerja profesional dan penugasan terarah.',
                'icon'  => 'trending-up',
            ],
            [
                'title' => 'Budaya Kolaboratif & ISHLAH',
                'desc'  => 'Lingkungan kerja yang rukun, saling menghormati, transparan, dan menjunjung tinggi amanah serta etika perbankan yang sehat.',
                'icon'  => 'users',
            ],
            [
                'title' => 'Kesejahteraan & Keseimbangan',
                'desc'  => 'Paket remunerasi yang kompetitif, perlindungan kesejahteraan, serta perhatian penuh pada keseimbangan antara produktivitas kerja dan ibadah.',
                'icon'  => 'heart',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_stages' ) ) {
    /**
     * Mengambil 4 tahapan alur rekrutmen resmi BSW:
     * 1. Submit Data
     * 2. Panggilan Interview (Screening Administrasi)
     * 3. Sesi Wawancara (Interview)
     * 4. Offering & Onboarding
     *
     * @return array
     */
    function wakalumi_get_karir_stages() {
        return [
            [
                'step'  => '01',
                'title' => 'Pengiriman Berkas & Data Pelamar',
                'desc'  => 'Pelamar mengisi formulir pendaftaran daring resmi dan melampirkan berkas Curriculum Vitae (CV) terbaru sesuai kualifikasi posisi yang diminati.',
            ],
            [
                'step'  => '02',
                'title' => 'Seleksi Berkas & Panggilan Interview',
                'desc'  => 'Tim Personalia BSW melakukan verifikasi dan seleksi administratif. Pelamar yang memenuhi syarat akan dihubungi untuk jadwal wawancara resmi.',
            ],
            [
                'step'  => '03',
                'title' => 'Sesi Wawancara (Interview)',
                'desc'  => 'Wawancara mendalam mencakup kompetensi teknis, kecocokan profil kerja, dan keselarasan integritas syariah bersama tim Personalia dan Pimpinan Unit kerja terkait.',
            ],
            [
                'step'  => '04',
                'title' => 'Penawaran Kerja & Onboarding',
                'desc'  => 'Kandidat terpilih menerima surat penawaran kerja resmi (Offering Letter) dan arahan persiapan sebelum memulai orientasi kerja resmi sebagai insan BSW.',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_antifraud' ) ) {
    /**
     * Mengambil teks peringatan anti-fraud resmi perbankan syariah.
     *
     * @return array
     */
    function wakalumi_get_karir_antifraud() {
        return [
            'badge' => get_option( 'options_karir_fraud_badge', 'Himbauan Resmi Bebas Biaya' ),
            'title' => get_option( 'options_karir_fraud_title', 'Waspada Penipuan Mengatasnamakan Rekrutmen BSW' ),
            'desc'  => get_option( 'options_karir_fraud_desc', 'PT BPRS Wakalumi (Bank Syariah Wakalumi) TIDAK PERNAH memungut biaya apapun (termasuk biaya transportasi, akomodasi, maupun biaya administrasi berkas) dalam seluruh tahapan seleksi penerimaan karyawan. Undangan resmi selalu disampaikan melalui saluran email resmi bank atau nomor kontak resmi Divisi Personalia. Waspadai segala bentuk penipuan yang mengatasnamakan Bank Syariah Wakalumi.' ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_default_karir_jobs' ) ) {
    /**
     * Daftar contoh lowongan kerja resmi BSW (Default Seeder).
     *
     * @return array
     */
    function wakalumi_get_default_karir_jobs() {
        return [
            [
                'id'          => 'job_1',
                'posisi'      => 'Account Officer (AO) Pembiayaan Syariah',
                'divisi'      => 'bisnis',
                'divisi_lbl'  => 'Bisnis & Pemasaran',
                'tipe'        => 'Penuh Waktu (Full Time)',
                'lokasi'      => 'Kantor Pusat & Wilayah Operasional BSW',
                'deadline'    => '30 November 2026',
                'form_url'    => 'https://forms.gle/wakalumi_ao_sample',
                'status'      => 'dibuka',
                'ringkasan'   => 'Bertanggung jawab dalam pemasaran produk pembiayaan syariah (Murabahah, Mudharabah, Musyarakah), analisa kelayakan usaha nasabah, dan pembinaan portofolio pembiayaan UMKM yang sehat.',
                'kualifikasi' => "Pria/Wanita, Usia maksimal 32 tahun\nPendidikan minimal D3/S1 semua jurusan (diutamakan Ekonomi/Perbankan/Manajemen)\nMemiliki integritas tinggi, komunikatif, dan berorientasi pada target\nDiutamakan memiliki pengalaman minimal 1 tahun di bidang marketing perbankan atau lembaga keuangan\nMemiliki kendaraan pribadi dan SIM C aktif",
                'urutan'      => 1,
            ],
            [
                'id'          => 'job_2',
                'posisi'      => 'Customer Service Officer',
                'divisi'      => 'operasional',
                'divisi_lbl'  => 'Operasional & Layanan',
                'tipe'        => 'Penuh Waktu (Full Time)',
                'lokasi'      => 'Kantor Pusat - Jakarta',
                'deadline'    => '30 November 2026',
                'form_url'    => 'https://forms.gle/wakalumi_cs_sample',
                'status'      => 'dibuka',
                'ringkasan'   => 'Memberikan pelayanan informasi produk simpanan syariah, pembukaan rekening tabungan/deposito, penanganan administrasi berkas nasabah, serta mengedepankan Service Excellence beretika syariah.',
                'kualifikasi' => "Pria/Wanita, Usia maksimal 27 tahun\nPendidikan minimal D3/S1 semua jurusan dengan IPK minimal 3.00\nBerpenampilan rapi, ramah, dan memiliki kemampuan komunikasi yang baik\nMampu mengoperasikan komputer dan aplikasi perkantoran (MS Office)\nMemiliki ketelitian tinggi dan orientasi melayani nasabah dengan tulus",
                'urutan'      => 2,
            ],
            [
                'id'          => 'job_3',
                'posisi'      => 'Staff Teknologi Informasi (IT Support & Sistem)',
                'divisi'      => 'it',
                'divisi_lbl'  => 'Teknologi Informasi',
                'tipe'        => 'Penuh Waktu (Full Time)',
                'lokasi'      => 'Kantor Pusat - Jakarta',
                'deadline'    => '15 Desember 2026',
                'form_url'    => 'https://forms.gle/wakalumi_it_sample',
                'status'      => 'dibuka',
                'ringkasan'   => 'Mendukung pemeliharaan infrastruktur jaringan, kelancaran core banking system, keamanan data digital, troubleshooting perangkat keras/lunak kantor, dan operasional TI perbankan.',
                'kualifikasi' => "Pria/Wanita, Usia maksimal 28 tahun\nPendidikan minimal S1 Teknik Informatika, Sistem Informasi, atau bidang terkait\nMemahami konsep jaringan komputer (LAN/WAN, Router, Firewall) dan database SQL\nMemiliki pemahaman dasar mengenai infrastruktur sistem perbankan syariah\nDisiplin, cepat beradaptasi, dan mampu bekerja mandiri maupun dalam tim",
                'urutan'      => 3,
            ],
            [
                'id'          => 'job_4',
                'posisi'      => 'Program Magang Mahasiswa (Internship Syariah)',
                'divisi'      => 'magang',
                'divisi_lbl'  => 'Program Magang Kampus',
                'tipe'        => 'Magang (Internship)',
                'lokasi'      => 'Kantor Pusat - Jakarta',
                'deadline'    => '31 Desember 2026',
                'form_url'    => 'https://forms.gle/wakalumi_intern_sample',
                'status'      => 'dibuka',
                'ringkasan'   => 'Kesempatan belajar langsung di lingkungan industri perbankan syariah pada divisi Operasional, Pemasaran, maupun Administrasi Umum bagi mahasiswa tingkat akhir.',
                'kualifikasi' => "Mahasiswa aktif semester 5 ke atas dari Perguruan Tinggi terakreditasi\nJurusan Perbankan Syariah, Ekonomi Syariah, Akuntansi, Manajemen, atau Ilmu Komputer\nMemiliki surat pengantar magang resmi dari universitas / fakultas\nBersedia mengikuti program magang minimal selama 2-3 bulan penuh\nMemiliki motivasi belajar tinggi, disiplin, dan amanah",
                'urutan'      => 4,
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_jobs' ) ) {
    /**
     * Mengambil daftar lowongan kerja dari database wp_options.
     * Secara default kosong sesuai ketersediaan rekrutmen saat ini.
     *
     * @return array
     */
    function wakalumi_get_karir_jobs() {
        // Otomatis sinkronisasi kosong jika baru pertama kali dimuat
        $initialized = get_option( 'options_karir_empty_seeded', false );
        if ( ! $initialized ) {
            update_option( 'options_karir_jobs_list', [] );
            update_option( 'options_karir_empty_seeded', '1' );
            return [];
        }

        $saved = get_option( 'options_karir_jobs_list', [] );
        if ( is_array( $saved ) ) {
            usort( $saved, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );
            return $saved;
        }

        return [];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_cta' ) ) {
    /**
     * Mengambil konfigurasi Banner CTA Bawah Halaman Karir.
     *
     * @return array
     */
    function wakalumi_get_karir_cta() {
        $default_wa = get_option( 'options_contact_wa', '6281517380388' );
        $wa_clean   = preg_replace( '/[^0-9]/', '', (string) $default_wa );
        $wa_url     = 'https://wa.me/' . ( $wa_clean ?: '6281517380388' );

        $title = get_option( 'options_karir_cta_title', 'Memiliki Pertanyaan Seputar Rekrutmen Bank Syariah Wakalumi?' );
        $title = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $title );

        return [
            'show'      => get_option( 'options_karir_cta_show', '1' ) === '1',
            'badge'     => get_option( 'options_karir_cta_badge', 'Informasi & Layanan SDM' ),
            'title'     => $title,
            'desc'      => get_option( 'options_karir_cta_desc', 'Tim Personalia / Human Capital kami siap membantu memberikan informasi terkait jadwal seleksi, kualifikasi posisi, serta peluang kemitraan magang mahasiswa.' ),
            'btn1_text' => get_option( 'options_karir_cta_btn1_text', 'Hubungi Personalia via WhatsApp' ),
            'btn1_url'  => get_option( 'options_karir_cta_btn1_url', $wa_url ),
            'btn2_text' => get_option( 'options_karir_cta_btn2_text', 'Lihat Tim & Manajemen BSW' ),
            'btn2_url'  => get_option( 'options_karir_cta_btn2_url', home_url( '/informasi/tim-kami/' ) ),
        ];
    }
}


// ── 2. MENU REGISTRATION & ASSETS ───────────────────────────────────

add_action( 'admin_menu', 'wakalumi_register_karir_page', 33 );
function wakalumi_register_karir_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Karir & Rekrutmen',
        'Karir & Rekrutmen',
        'manage_options',
        'wakalumi-karir',
        'wakalumi_render_karir_admin_page'
    );
}


// ── 3. RENDER ADMIN INTERFACE ───────────────────────────────────────

function wakalumi_render_karir_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Akses ditolak.' );
    }

    $notice = '';

    // Handle Form Save
    if ( isset( $_POST['wkl_karir_save_nonce'] ) ) {
        if ( ! wp_verify_nonce( $_POST['wkl_karir_save_nonce'], 'wkl_karir_save_action' ) ) {
            $notice = '<div class="notice notice-error is-dismissible"><p>Validasi keamanan gagal. Silakan coba kembali.</p></div>';
        } else {
            // 1. Simpan Header
            update_option( 'options_karir_badge', sanitize_text_field( $_POST['options_karir_badge'] ?? '' ) );
            update_option( 'options_karir_title', sanitize_text_field( $_POST['options_karir_title'] ?? '' ) );
            update_option( 'options_karir_desc', sanitize_textarea_field( $_POST['options_karir_desc'] ?? '' ) );

            // 2. Simpan Anti-Fraud
            update_option( 'options_karir_fraud_badge', sanitize_text_field( $_POST['options_karir_fraud_badge'] ?? '' ) );
            update_option( 'options_karir_fraud_title', sanitize_text_field( $_POST['options_karir_fraud_title'] ?? '' ) );
            update_option( 'options_karir_fraud_desc', sanitize_textarea_field( $_POST['options_karir_fraud_desc'] ?? '' ) );

            // 3. Simpan Repeater Lowongan Kerja
            $job_ids       = $_POST['job_id'] ?? [];
            $job_posisis   = $_POST['job_posisi'] ?? [];
            $job_divisis   = $_POST['job_divisi'] ?? [];
            $job_div_lbls  = $_POST['job_divisi_lbl'] ?? [];
            $job_tipes     = $_POST['job_tipe'] ?? [];
            $job_lokasis   = $_POST['job_lokasi'] ?? [];
            $job_deadlines = $_POST['job_deadline'] ?? [];
            $job_form_urls = $_POST['job_form_url'] ?? [];
            $job_statuses  = $_POST['job_status'] ?? [];
            $job_ringkasan = $_POST['job_ringkasan'] ?? [];
            $job_kualifs   = $_POST['job_kualifikasi'] ?? [];
            $job_urutans   = $_POST['job_urutan'] ?? [];

            $new_jobs = [];
            for ( $i = 0; $i < count( $job_ids ); $i++ ) {
                $posisi = sanitize_text_field( $job_posisis[$i] ?? '' );
                if ( empty( $posisi ) ) continue;

                $new_jobs[] = [
                    'id'          => sanitize_text_field( $job_ids[$i] ?? ( 'job_' . ( $i + 1 ) ) ),
                    'posisi'      => $posisi,
                    'divisi'      => sanitize_text_field( $job_divisis[$i] ?? 'bisnis' ),
                    'divisi_lbl'  => sanitize_text_field( $job_div_lbls[$i] ?? '' ),
                    'tipe'        => sanitize_text_field( $job_tipes[$i] ?? 'Penuh Waktu' ),
                    'lokasi'      => sanitize_text_field( $job_lokasis[$i] ?? 'Kantor Pusat' ),
                    'deadline'    => sanitize_text_field( $job_deadlines[$i] ?? '' ),
                    'form_url'    => esc_url_raw( $job_form_urls[$i] ?? '' ),
                    'status'      => sanitize_text_field( $job_statuses[$i] ?? 'dibuka' ),
                    'ringkasan'   => sanitize_textarea_field( $job_ringkasan[$i] ?? '' ),
                    'kualifikasi' => sanitize_textarea_field( $job_kualifs[$i] ?? '' ),
                    'urutan'      => intval( $job_urutans[$i] ?? ( $i + 1 ) ),
                ];
            }

            usort( $new_jobs, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );
            update_option( 'options_karir_jobs_list', $new_jobs );

            // 4. Simpan CTA Bawah
            update_option( 'options_karir_cta_show', isset( $_POST['options_karir_cta_show'] ) ? '1' : '0' );
            update_option( 'options_karir_cta_badge', sanitize_text_field( $_POST['options_karir_cta_badge'] ?? '' ) );
            update_option( 'options_karir_cta_title', sanitize_text_field( $_POST['options_karir_cta_title'] ?? '' ) );
            update_option( 'options_karir_cta_desc', sanitize_textarea_field( $_POST['options_karir_cta_desc'] ?? '' ) );
            update_option( 'options_karir_cta_btn1_text', sanitize_text_field( $_POST['options_karir_cta_btn1_text'] ?? '' ) );
            update_option( 'options_karir_cta_btn1_url', esc_url_raw( $_POST['options_karir_cta_btn1_url'] ?? '' ) );
            update_option( 'options_karir_cta_btn2_text', sanitize_text_field( $_POST['options_karir_cta_btn2_text'] ?? '' ) );
            update_option( 'options_karir_cta_btn2_url', esc_url_raw( $_POST['options_karir_cta_btn2_url'] ?? '' ) );

            $notice = '<div class="notice notice-success is-dismissible"><p><strong>Berhasil!</strong> Pengaturan Karir, Lowongan Kerja, dan Tautan Rekrutmen telah disimpan.</p></div>';
        }
    }

    // Reset Action Handler
    if ( isset( $_GET['wkl_action'] ) && $_GET['wkl_action'] === 'reset_karir_jobs' && check_admin_referer( 'wkl_reset_karir_nonce' ) ) {
        update_option( 'options_karir_jobs_list', wakalumi_get_default_karir_jobs() );
        $notice = '<div class="notice notice-success is-dismissible"><p>Daftar lowongan kerja berhasil dimuat ulang ke data standar.</p></div>';
    }

    // Load Data
    $header    = wakalumi_get_karir_header();
    $antifraud = wakalumi_get_karir_antifraud();
    $jobs      = wakalumi_get_karir_jobs();
    $cta       = wakalumi_get_karir_cta();

    $total_jobs  = count( $jobs );
    $open_jobs   = count( array_filter( $jobs, fn($x) => ( $x['status'] ?? 'dibuka' ) === 'dibuka' ) );
    $soon_jobs   = count( array_filter( $jobs, fn($x) => ( $x['status'] ?? '' ) === 'segera' ) );
    $closed_jobs = count( array_filter( $jobs, fn($x) => ( $x['status'] ?? '' ) === 'ditutup' ) );

    $reset_url = wp_nonce_url( admin_url( 'admin.php?page=wakalumi-karir&wkl_action=reset_karir_jobs' ), 'wkl_reset_karir_nonce' );
    ?>

    <div class="wrap" style="max-width: 1140px; margin-top: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;">

        <!-- TOP BAR HEADER -->
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #e2e8f0;">
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span class="dashicons dashicons-businessman" style="font-size: 28px; width: 28px; height: 28px; color: #0f766e;"></span>
                    Pengaturan Karir &amp; Rekrutmen Insan BSW
                </h1>
                <p style="margin: 4px 0 0 0; color: #64748b; font-size: 13px;">
                    Kelola posisi lowongan pekerjaan aktif, tautan pendaftaran Google Form resmi, kualifikasi persyaratan, serta informasi tahapan seleksi.
                </p>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="<?php echo esc_url( home_url( '/informasi/karir/' ) ); ?>" target="_blank" class="button button-secondary" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; padding: 4px 14px; border-radius: 6px;">
                    <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px;"></span> Lihat Halaman Karir
                </a>
                <a href="<?php echo esc_url( $reset_url ); ?>" onclick="return confirm('Muat ulang data contoh lowongan baku? Lowongan yang Anda edit saat ini akan direset.');" class="button" style="color: #0f766e; border-color: #0f766e; font-weight: 600; padding: 4px 12px; border-radius: 6px;">
                    Muat Ulang Contoh Lowongan
                </a>
            </div>
        </div>

        <?php if ( ! empty( $notice ) ) echo $notice; ?>

        <!-- METRIC STATUS BAR -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; margin-bottom: 25px;">
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 14px 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Total Posisi</div>
                <div style="font-size: 24px; font-weight: 800; color: #0f172a; margin-top: 4px;"><?php echo $total_jobs; ?></div>
            </div>
            <div style="background: #ffffff; border: 1px solid #bbf7d0; border-radius: 10px; padding: 14px 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <div style="font-size: 11px; font-weight: 700; color: #166534; text-transform: uppercase; letter-spacing: 0.5px;">Sedang Dibuka</div>
                <div style="font-size: 24px; font-weight: 800; color: #15803d; margin-top: 4px;"><?php echo $open_jobs; ?></div>
            </div>
            <div style="background: #ffffff; border: 1px solid #fde68a; border-radius: 10px; padding: 14px 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <div style="font-size: 11px; font-weight: 700; color: #854d0e; text-transform: uppercase; letter-spacing: 0.5px;">Segera Hadir</div>
                <div style="font-size: 24px; font-weight: 800; color: #b45309; margin-top: 4px;"><?php echo $soon_jobs; ?></div>
            </div>
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <div style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Ditutup</div>
                <div style="font-size: 24px; font-weight: 800; color: #64748b; margin-top: 4px;"><?php echo $closed_jobs; ?></div>
            </div>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field( 'wkl_karir_save_action', 'wkl_karir_save_nonce' ); ?>

            <!-- ================================================================
                 SECTION 1: MANAJEMEN LOWONGAN KERJA (REPEATER)
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px; margin-bottom: 20px;">
                    <div>
                        <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <span class="dashicons dashicons-id-alt" style="font-size: 18px; width: 18px; height: 18px;"></span>
                            Daftar Lowongan Pekerjaan &amp; Tautan Pendaftaran Google Form
                        </h2>
                        <p style="margin: 4px 0 0 0; color: #64748b; font-size: 12px;">
                            Pelamar yang mengklik tombol <strong>Lamar Posisi Ini</strong> di halaman web akan langsung diarahkan ke tautan Google Form yang Anda tempel di bawah.
                        </p>
                    </div>
                    <button type="button" id="btn-add-job" class="button button-primary" style="background: #0f766e; border-color: #0d9488; font-weight: 700;">
                        + Tambah Lowongan Baru
                    </button>
                </div>

                <!-- Job Openings Container -->
                <div id="job-list-container" style="display: flex; flex-direction: column; gap: 18px;">
                    <?php 
                    foreach ( $jobs as $idx => $job ) : 
                        $job_id       = esc_attr( $job['id'] ?? ( 'job_' . ( $idx + 1 ) ) );
                        $posisi       = esc_attr( $job['posisi'] ?? '' );
                        $divisi       = esc_attr( $job['divisi'] ?? 'bisnis' );
                        $divisi_lbl   = esc_attr( $job['divisi_lbl'] ?? '' );
                        $tipe         = esc_attr( $job['tipe'] ?? 'Penuh Waktu (Full Time)' );
                        $lokasi       = esc_attr( $job['lokasi'] ?? 'Kantor Pusat' );
                        $deadline     = esc_attr( $job['deadline'] ?? '' );
                        $form_url     = esc_url( $job['form_url'] ?? '' );
                        $status       = esc_attr( $job['status'] ?? 'dibuka' );
                        $ringkasan    = esc_textarea( $job['ringkasan'] ?? '' );
                        $kualifikasi  = esc_textarea( $job['kualifikasi'] ?? '' );
                        $urutan       = intval( $job['urutan'] ?? ( $idx + 1 ) );

                        $status_bg = '#dcfce7';
                        $status_color = '#166534';
                        if ( $status === 'segera' ) {
                            $status_bg = '#fef3c7';
                            $status_color = '#92400e';
                        } elseif ( $status === 'ditutup' ) {
                            $status_bg = '#fee2e2';
                            $status_color = '#991b1b';
                        }
                    ?>
                        <div class="job-card-item" data-id="<?php echo $job_id; ?>" style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 5px solid #0f766e; border-radius: 10px; padding: 20px; transition: all 0.2s;">
                            <input type="hidden" name="job_id[]" value="<?php echo $job_id; ?>">

                            <!-- Header Bar of Card -->
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span style="font-weight: 800; font-size: 15px; color: #0f172a;" class="job-title-display">
                                        #<?php echo $urutan; ?> — <?php echo ! empty( $posisi ) ? $posisi : 'Lowongan Baru'; ?>
                                    </span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 999px; background: <?php echo $status_bg; ?>; color: <?php echo $status_color; ?>;" class="job-status-badge">
                                        ● <?php echo ucfirst( $status ); ?>
                                    </span>
                                    <button type="button" class="button button-link-delete btn-delete-job" style="color: #ef4444; font-size: 12px; padding: 2px 6px;">
                                        Hapus
                                    </button>
                                </div>
                            </div>

                            <!-- Row 1: Posisi & Divisi & Tipe -->
                            <div style="display: grid; grid-template-columns: 2fr 1.2fr 1.2fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Nama Posisi Jabatan</label>
                                    <input type="text" name="job_posisi[]" value="<?php echo $posisi; ?>" class="job-posisi-input" placeholder="Contoh: Account Officer Pembiayaan Syariah" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; font-weight: 600; background: #fff;" required>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Kategori Divisi</label>
                                    <select name="job_divisi[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                        <option value="bisnis" <?php selected( $divisi, 'bisnis' ); ?>>Bisnis &amp; Pemasaran</option>
                                        <option value="operasional" <?php selected( $divisi, 'operasional' ); ?>>Operasional &amp; Layanan</option>
                                        <option value="it" <?php selected( $divisi, 'it' ); ?>>Teknologi Informasi (IT)</option>
                                        <option value="legal" <?php selected( $divisi, 'legal' ); ?>>Legal &amp; Kepatuhan</option>
                                        <option value="skai" <?php selected( $divisi, 'skai' ); ?>>Audit Internal (SKAI)</option>
                                        <option value="umum" <?php selected( $divisi, 'umum' ); ?>>Umum &amp; Personalia</option>
                                        <option value="magang" <?php selected( $divisi, 'magang' ); ?>>Program Magang Mahasiswa</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Tipe Pekerjaan</label>
                                    <select name="job_tipe[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                        <option value="Penuh Waktu (Full Time)" <?php selected( $tipe, 'Penuh Waktu (Full Time)' ); ?>>Penuh Waktu (Full Time)</option>
                                        <option value="Kontrak (Contract)" <?php selected( $tipe, 'Kontrak (Contract)' ); ?>>Kontrak (Contract)</option>
                                        <option value="Magang (Internship)" <?php selected( $tipe, 'Magang (Internship)' ); ?>>Magang (Internship)</option>
                                        <option value="Paruh Waktu (Part Time)" <?php selected( $tipe, 'Paruh Waktu (Part Time)' ); ?>>Paruh Waktu (Part Time)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Row 2: Lokasi, Deadline, Status, Urutan -->
                            <div style="display: grid; grid-template-columns: 1.5fr 1.2fr 1fr 0.6fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Lokasi Penempatan</label>
                                    <input type="text" name="job_lokasi[]" value="<?php echo $lokasi; ?>" placeholder="Contoh: Kantor Pusat - Jakarta" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Batas Waktu Lamaran</label>
                                    <input type="text" name="job_deadline[]" value="<?php echo $deadline; ?>" placeholder="Contoh: 30 November 2026" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Status Perekrutan</label>
                                    <select name="job_status[]" class="job-status-select" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff; font-weight: 700;">
                                        <option value="dibuka" <?php selected( $status, 'dibuka' ); ?>>Dibuka</option>
                                        <option value="segera" <?php selected( $status, 'segera' ); ?>>Segera Hadir</option>
                                        <option value="ditutup" <?php selected( $status, 'ditutup' ); ?>>Ditutup</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Urutan</label>
                                    <input type="number" name="job_urutan[]" value="<?php echo $urutan; ?>" min="1" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 4px; font-size: 13px; text-align: center; background: #fff;">
                                </div>
                            </div>

                            <!-- Row 3: Tautan Formulir Rekrutmen (Google Form) -->
                            <div style="margin-bottom: 12px; padding: 12px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px;">
                                <label style="display: block; font-weight: 700; font-size: 12px; margin-bottom: 4px; color: #166534;">
                                    Tautan Pendaftaran Online (Link Google Form / Form Rekrutmen)
                                </label>
                                <input type="url" name="job_form_url[]" value="<?php echo $form_url; ?>" placeholder="Tempelkan URL Google Form di sini, contoh: https://forms.gle/..." style="width: 100%; border: 1px solid #86efac; border-radius: 6px; padding: 7px 10px; font-size: 13px; font-family: monospace; background: #fff;">
                                <span style="display: block; margin-top: 4px; font-size: 11px; color: #15803d;">
                                    Tautan ini akan terbuka di tab baru saat calon pelamar menekan tombol "Lamar Posisi Ini".
                                </span>
                            </div>

                            <!-- Row 4: Ringkasan Tanggung Jawab & Kualifikasi Persyaratan -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                        Deskripsi Singkat &amp; Tanggung Jawab
                                    </label>
                                    <textarea name="job_ringkasan[]" rows="4" placeholder="Uraikan ringkasan tugas dan tanggung jawab posisi ini..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"><?php echo $ringkasan; ?></textarea>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                        Kualifikasi &amp; Persyaratan (Pisahkan per baris)
                                    </label>
                                    <textarea name="job_kualifikasi[]" rows="4" placeholder="Pria/Wanita, Usia maks 28 tahun&#10;Pendidikan min. D3/S1&#10;Komunikatif dan berintegritas tinggi" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"><?php echo $kualifikasi; ?></textarea>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top: 20px; text-align: center;">
                    <button type="button" id="btn-add-job-bottom" class="button" style="padding: 8px 24px; font-weight: 700; border-radius: 6px; border: 2px dashed #94a3b8; width: 100%; max-width: 320px; background: #f8fafc;">
                        + Tambah Lowongan Baru
                    </button>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 2: PENGATURAN HEADER & PERINGATAN BEBAS BIAYA
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-welcome-widgets-menus" style="font-size: 18px; width: 18px; height: 18px;"></span>
                    Pengaturan Header Halaman &amp; Himbauan Waspada Penipuan
                </h2>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 15px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Badge Header Atas</label>
                        <input type="text" name="options_karir_badge" value="<?php echo esc_attr( $header['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Judul Utama Halaman</label>
                        <input type="text" name="options_karir_title" value="<?php echo esc_attr( $header['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Deskripsi Narasi Pengantar Karir</label>
                    <textarea name="options_karir_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 13px;"><?php echo esc_textarea( $header['desc'] ); ?></textarea>
                </div>

                <!-- Himbauan Bebas Biaya (Anti-Fraud) -->
                <div style="margin-top: 20px; padding: 18px; background: #fffbeb; border: 1px solid #fde68a; border-radius: 10px;">
                    <div style="font-weight: 700; color: #92400e; font-size: 13px; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                        <span class="dashicons dashicons-shield" style="font-size: 16px; width: 16px; height: 16px;"></span>
                        Peringatan Resmi: Seleksi Rekrutmen 100% Bebas Biaya (Anti-Fraud)
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 15px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Badge Peringatan</label>
                            <input type="text" name="options_karir_fraud_badge" value="<?php echo esc_attr( $antifraud['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Judul Kotak Peringatan</label>
                            <input type="text" name="options_karir_fraud_title" value="<?php echo esc_attr( $antifraud['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                    </div>
                    <div style="margin-top: 10px;">
                        <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Teks Penjelasan Waspada Penipuan</label>
                        <textarea name="options_karir_fraud_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"><?php echo esc_textarea( $antifraud['desc'] ); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 3: PENGATURAN CALL TO ACTION (CTA) BAWAH HALAMAN
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 15px;">
                    <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <span class="dashicons dashicons-megaphone" style="font-size: 18px; width: 18px; height: 18px;"></span>
                        Pengaturan Banner Call to Action (CTA) Bawah Halaman
                    </h2>
                    <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: #1e293b; cursor: pointer;">
                        <input type="checkbox" name="options_karir_cta_show" value="1" <?php checked( $cta['show'] ); ?>>
                        Tampilkan Banner CTA
                    </label>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 15px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Badge Atas CTA</label>
                        <input type="text" name="options_karir_cta_badge" value="<?php echo esc_attr( $cta['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Judul Utama Banner CTA</label>
                        <input type="text" name="options_karir_cta_title" value="<?php echo esc_attr( $cta['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Deskripsi / Paragraf Ajakan</label>
                    <textarea name="options_karir_cta_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 13px;"><?php echo esc_textarea( $cta['desc'] ); ?></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px; padding: 18px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;">
                    <!-- Tombol Utama (Button 1) -->
                    <div>
                        <div style="font-weight: 700; color: #0f766e; font-size: 13px; margin-bottom: 10px;">
                            Tombol Utama (WhatsApp Personalia / Kontak)
                        </div>
                        <div style="margin-bottom: 10px;">
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Teks Tombol</label>
                            <input type="text" name="options_karir_cta_btn1_text" value="<?php echo esc_attr( $cta['btn1_text'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">URL / Link WhatsApp</label>
                            <input type="text" name="options_karir_cta_btn1_url" value="<?php echo esc_attr( $cta['btn1_url'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                    </div>

                    <!-- Tombol Sekunder (Button 2) -->
                    <div>
                        <div style="font-weight: 700; color: #166534; font-size: 13px; margin-bottom: 10px;">
                            Tombol Sekunder (Informasi Tim &amp; Manajemen)
                        </div>
                        <div style="margin-bottom: 10px;">
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Teks Tombol</label>
                            <input type="text" name="options_karir_cta_btn2_text" value="<?php echo esc_attr( $cta['btn2_text'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">URL / Link Halaman</label>
                            <input type="text" name="options_karir_cta_btn2_url" value="<?php echo esc_attr( $cta['btn2_url'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SAVE BUTTON STICKY FOOTER -->
            <div style="position: sticky; bottom: 15px; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 15px 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between; z-index: 50;">
                <div style="color: #64748b; font-size: 13px;">
                    Pastikan tautan Google Form dan batas waktu lowongan telah terisi dengan benar.
                </div>
                <button type="submit" class="button button-primary" style="background: #0f766e; border-color: #0d9488; font-weight: 800; font-size: 14px; padding: 6px 30px; border-radius: 6px;">
                    Simpan Seluruh Data Karir
                </button>
            </div>

        </form>

    </div>

    <!-- INLINE JAVASCRIPT FOR DYNAMIC JOB CARDS -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('job-list-container');
        const btnAddTop = document.getElementById('btn-add-job');
        const btnAddBottom = document.getElementById('btn-add-job-bottom');

        function bindJobCard(card) {
            const inputPosisi = card.querySelector('.job-posisi-input');
            const titleDisp   = card.querySelector('.job-title-display');
            const selectStat  = card.querySelector('.job-status-select');
            const statBadge   = card.querySelector('.job-status-badge');
            const btnDelete   = card.querySelector('.btn-delete-job');

            if (inputPosisi && titleDisp) {
                inputPosisi.addEventListener('input', function() {
                    const val = this.value.trim() || 'Lowongan Baru';
                    titleDisp.textContent = val;
                });
            }

            if (selectStat && statBadge) {
                selectStat.addEventListener('change', function() {
                    const v = this.value;
                    if (v === 'dibuka') {
                        statBadge.textContent = '● Dibuka';
                        statBadge.style.background = '#dcfce7';
                        statBadge.style.color = '#166534';
                    } else if (v === 'segera') {
                        statBadge.textContent = '● Segera Hadir';
                        statBadge.style.background = '#fef3c7';
                        statBadge.style.color = '#92400e';
                    } else {
                        statBadge.textContent = '● Ditutup';
                        statBadge.style.background = '#fee2e2';
                        statBadge.style.color = '#991b1b';
                    }
                });
            }

            if (btnDelete) {
                btnDelete.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin menghapus lowongan pekerjaan ini?')) {
                        card.remove();
                    }
                });
            }
        }

        // Bind existing cards
        container.querySelectorAll('.job-card-item').forEach(bindJobCard);

        function addNewJobCard() {
            const count = container.querySelectorAll('.job-card-item').length;
            const newIndex = count + 1;
            const newId = 'job_' + Date.now();

            const cardHtml = `
                <div class="job-card-item" data-id="${newId}" style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 5px solid #0f766e; border-radius: 10px; padding: 20px; transition: all 0.2s;">
                    <input type="hidden" name="job_id[]" value="${newId}">

                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-weight: 800; font-size: 15px; color: #0f172a;" class="job-title-display">
                                #${newIndex} — Posisi Baru
                            </span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 999px; background: #dcfce7; color: #166534;" class="job-status-badge">
                                ● Dibuka
                            </span>
                            <button type="button" class="button button-link-delete btn-delete-job" style="color: #ef4444; font-size: 12px; padding: 2px 6px;">
                                Hapus
                            </button>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 2fr 1.2fr 1.2fr; gap: 14px; margin-bottom: 12px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Nama Posisi Jabatan</label>
                            <input type="text" name="job_posisi[]" value="" class="job-posisi-input" placeholder="Contoh: Staff Operasional" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; font-weight: 600; background: #fff;" required>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Kategori Divisi</label>
                            <select name="job_divisi[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                <option value="bisnis">Bisnis &amp; Pemasaran</option>
                                <option value="operasional">Operasional &amp; Layanan</option>
                                <option value="it">Teknologi Informasi (IT)</option>
                                <option value="legal">Legal &amp; Kepatuhan</option>
                                <option value="skai">Audit Internal (SKAI)</option>
                                <option value="umum">Umum &amp; Personalia</option>
                                <option value="magang">Program Magang Mahasiswa</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Tipe Pekerjaan</label>
                            <select name="job_tipe[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                <option value="Penuh Waktu (Full Time)">Penuh Waktu (Full Time)</option>
                                <option value="Kontrak (Contract)">Kontrak (Contract)</option>
                                <option value="Magang (Internship)">Magang (Internship)</option>
                                <option value="Paruh Waktu (Part Time)">Paruh Waktu (Part Time)</option>
                            </select>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1.5fr 1.2fr 1fr 0.6fr; gap: 14px; margin-bottom: 12px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Lokasi Penempatan</label>
                            <input type="text" name="job_lokasi[]" value="Kantor Pusat - Jakarta" placeholder="Contoh: Kantor Pusat - Jakarta" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Batas Waktu Lamaran</label>
                            <input type="text" name="job_deadline[]" value="" placeholder="Contoh: 31 Desember 2026" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Status Perekrutan</label>
                            <select name="job_status[]" class="job-status-select" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff; font-weight: 700;">
                                <option value="dibuka">Dibuka</option>
                                <option value="segera">Segera Hadir</option>
                                <option value="ditutup">Ditutup</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Urutan</label>
                            <input type="number" name="job_urutan[]" value="${newIndex}" min="1" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 4px; font-size: 13px; text-align: center; background: #fff;">
                        </div>
                    </div>

                    <div style="margin-bottom: 12px; padding: 12px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px;">
                        <label style="display: block; font-weight: 700; font-size: 12px; margin-bottom: 4px; color: #166534;">
                            Tautan Pendaftaran Online (Link Google Form / Form Rekrutmen)
                        </label>
                        <input type="url" name="job_form_url[]" value="" placeholder="Tempelkan URL Google Form di sini, contoh: https://forms.gle/..." style="width: 100%; border: 1px solid #86efac; border-radius: 6px; padding: 7px 10px; font-size: 13px; font-family: monospace; background: #fff;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                Deskripsi Singkat &amp; Tanggung Jawab
                            </label>
                            <textarea name="job_ringkasan[]" rows="4" placeholder="Uraikan ringkasan tugas dan tanggung jawab..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"></textarea>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                Kualifikasi &amp; Persyaratan (Pisahkan per baris)
                            </label>
                            <textarea name="job_kualifikasi[]" rows="4" placeholder="Pria/Wanita&#10;Pendidikan min. S1" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"></textarea>
                        </div>
                    </div>
                </div>
            `;

            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = cardHtml.trim();
            const newEl = tempDiv.firstElementChild;
            container.appendChild(newEl);
            bindJobCard(newEl);
            newEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        if (btnAddTop) btnAddTop.addEventListener('click', addNewJobCard);
        if (btnAddBottom) btnAddBottom.addEventListener('click', addNewJobCard);
    });
    </script>
    <?php
}

