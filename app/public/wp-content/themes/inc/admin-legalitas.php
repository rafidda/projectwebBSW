<?php
/**
 * Admin Panel: Profil & Legalitas Perusahaan
 *
 * Mengelola seluruh konten halaman Profil: Legalitas Perusahaan secara modular per-section:
 * 1. Hero Banner & Kartu Verifikasi
 * 2. Identitas & Registrasi Fiskal (NIB, NPWP, NPWZ, dll) - Repeater Card dengan Tombol Naik / Turun
 * 3. Izin Operasional Perbankan (SK Menkeu, SK BI) & Pengawasan (OJK, LPS, DPS)
 * 4. Linimasa Rekam Jejak Akta Notaris & Anggaran Dasar - Repeater dengan Tombol Naik / Turun
 * 5. Call To Action (CTA Bawah)
 * 100% Free tanpa ketergantungan plugin berbayar.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Registrasi Submenu di bawah "Pengaturan Website"
 */
function wakalumi_register_legalitas_admin_menu() {
    add_submenu_page(
        'wakalumi-settings',
        'Profil: Legalitas Perusahaan',
        'Profil: Legalitas',
        'manage_options',
        'wakalumi-legalitas',
        'wakalumi_render_legalitas_admin_page'
    );
}
add_action( 'admin_menu', 'wakalumi_register_legalitas_admin_menu', 21 );

/**
 * Render Halaman Admin Profil: Legalitas Perusahaan
 */
function wakalumi_render_legalitas_admin_page() {
    // ── PROSES SIMPAN DATA ──────────────────────────────────────────
    if ( isset( $_POST['wakalumi_save_legalitas'] ) && check_admin_referer( 'wakalumi_legalitas_nonce' ) ) {
        // 1. Hero Banner & Right Card
        update_option( 'options_legal_page_badge', sanitize_text_field( $_POST['options_legal_page_badge'] ?? '' ) );
        update_option( 'options_legal_page_title', sanitize_text_field( $_POST['options_legal_page_title'] ?? '' ) );
        update_option( 'options_legal_page_subtitle', sanitize_textarea_field( $_POST['options_legal_page_subtitle'] ?? '' ) );
        update_option( 'options_legal_hero_pill_1', sanitize_text_field( $_POST['options_legal_hero_pill_1'] ?? '' ) );
        update_option( 'options_legal_hero_pill_2', sanitize_text_field( $_POST['options_legal_hero_pill_2'] ?? '' ) );
        update_option( 'options_legal_hero_pill_3', sanitize_text_field( $_POST['options_legal_hero_pill_3'] ?? '' ) );

        update_option( 'options_legal_hero_card_badge', sanitize_text_field( $_POST['options_legal_hero_card_badge'] ?? '' ) );
        update_option( 'options_legal_hero_card_title', sanitize_text_field( $_POST['options_legal_hero_card_title'] ?? '' ) );
        update_option( 'options_legal_hero_card_desc', sanitize_textarea_field( $_POST['options_legal_hero_card_desc'] ?? '' ) );
        update_option( 'options_legal_hero_card_tag1', sanitize_text_field( $_POST['options_legal_hero_card_tag1'] ?? '' ) );
        update_option( 'options_legal_hero_card_tag2', sanitize_text_field( $_POST['options_legal_hero_card_tag2'] ?? '' ) );

        // 2. Seksi 1: Header & Repeater Kartu Registrasi Fiskal
        update_option( 'options_legal_sec1_badge', sanitize_text_field( $_POST['options_legal_sec1_badge'] ?? '' ) );
        update_option( 'options_legal_sec1_title', sanitize_text_field( $_POST['options_legal_sec1_title'] ?? '' ) );
        update_option( 'options_legal_sec1_subtitle', sanitize_textarea_field( $_POST['options_legal_sec1_subtitle'] ?? '' ) );

        $reg_cats    = $_POST['reg_card_category'] ?? [];
        $reg_subcats = $_POST['reg_card_subcategory'] ?? [];
        $reg_badges  = $_POST['reg_card_badge'] ?? [];
        $reg_titles  = $_POST['reg_card_title'] ?? [];
        $reg_numbers = $_POST['reg_card_number'] ?? [];
        $reg_descs   = $_POST['reg_card_desc'] ?? [];
        $reg_footers = $_POST['reg_card_footer'] ?? [];
        $clean_reg_cards = [];

        for ( $i = 0; $i < count( $reg_titles ); $i++ ) {
            $t = sanitize_text_field( $reg_titles[$i] ?? '' );
            if ( ! empty( $t ) ) {
                $clean_reg_cards[] = [
                    'category'    => sanitize_text_field( $reg_cats[$i] ?? '' ),
                    'subcategory' => sanitize_text_field( $reg_subcats[$i] ?? '' ),
                    'badge'       => sanitize_text_field( $reg_badges[$i] ?? '' ),
                    'title'       => $t,
                    'number'      => sanitize_text_field( $reg_numbers[$i] ?? '' ),
                    'desc'        => sanitize_textarea_field( $reg_descs[$i] ?? '' ),
                    'footer'      => sanitize_text_field( $reg_footers[$i] ?? '' ),
                ];
            }
        }
        update_option( 'options_legal_reg_cards', $clean_reg_cards );

        // Also keep legacy options updated if first 3 exist
        if ( isset( $clean_reg_cards[0]['number'] ) ) update_option( 'options_legal_nib', $clean_reg_cards[0]['number'] );
        if ( isset( $clean_reg_cards[1]['number'] ) ) update_option( 'options_legal_npwp', $clean_reg_cards[1]['number'] );
        if ( isset( $clean_reg_cards[2]['number'] ) ) update_option( 'options_legal_npwz', $clean_reg_cards[2]['number'] );

        // 3. Seksi 2: Landasan Izin Usaha (SK) & Lembaga Pengawas (OJK/LPS/DPS)
        update_option( 'options_legal_sec2_badge', sanitize_text_field( $_POST['options_legal_sec2_badge'] ?? '' ) );
        update_option( 'options_legal_sec2_title', sanitize_text_field( $_POST['options_legal_sec2_title'] ?? '' ) );
        update_option( 'options_legal_sec2_subtitle', sanitize_textarea_field( $_POST['options_legal_sec2_subtitle'] ?? '' ) );

        $sk_abbrs   = $_POST['sk_card_abbr'] ?? [];
        $sk_tags    = $_POST['sk_card_tag'] ?? [];
        $sk_numbers = $_POST['sk_card_number'] ?? [];
        $sk_descs   = $_POST['sk_card_desc'] ?? [];
        $clean_sk_cards = [];

        for ( $i = 0; $i < count( $sk_numbers ); $i++ ) {
            $num = sanitize_text_field( $sk_numbers[$i] ?? '' );
            if ( ! empty( $num ) ) {
                $clean_sk_cards[] = [
                    'abbr'   => sanitize_text_field( $sk_abbrs[$i] ?? 'SK' ),
                    'tag'    => sanitize_text_field( $sk_tags[$i] ?? '' ),
                    'number' => $num,
                    'desc'   => sanitize_textarea_field( $sk_descs[$i] ?? '' ),
                ];
            }
        }
        update_option( 'options_legal_sk_cards', $clean_sk_cards );

        // Right Card (Regulator & Pengawasan)
        update_option( 'options_legal_sec2_card_badge', sanitize_text_field( $_POST['options_legal_sec2_card_badge'] ?? '' ) );
        update_option( 'options_legal_sec2_card_title', sanitize_text_field( $_POST['options_legal_sec2_card_title'] ?? '' ) );

        $regulator_nums   = $_POST['regulator_number'] ?? [];
        $regulator_titles = $_POST['regulator_title'] ?? [];
        $regulator_descs  = $_POST['regulator_desc'] ?? [];
        $clean_regulators = [];

        for ( $i = 0; $i < count( $regulator_titles ); $i++ ) {
            $title = sanitize_text_field( $regulator_titles[$i] ?? '' );
            if ( ! empty( $title ) ) {
                $clean_regulators[] = [
                    'number' => sanitize_text_field( $regulator_nums[$i] ?? sprintf( '%02d', $i + 1 ) ),
                    'title'  => $title,
                    'desc'   => sanitize_textarea_field( $regulator_descs[$i] ?? '' ),
                ];
            }
        }
        update_option( 'options_legal_regulators', $clean_regulators );

        // 4. Seksi 3: Linimasa Akta Notaris & Info Kantor
        update_option( 'options_legal_sec3_badge', sanitize_text_field( $_POST['options_legal_sec3_badge'] ?? '' ) );
        update_option( 'options_legal_sec3_title', sanitize_text_field( $_POST['options_legal_sec3_title'] ?? '' ) );
        update_option( 'options_legal_sec3_subtitle', sanitize_textarea_field( $_POST['options_legal_sec3_subtitle'] ?? '' ) );

        $raw_years    = $_POST['legal_akta_year'] ?? [];
        $raw_numbers  = $_POST['legal_akta_number'] ?? [];
        $raw_notaris  = $_POST['legal_akta_notaris'] ?? [];
        $raw_sks      = $_POST['legal_akta_sk'] ?? [];
        $raw_descs    = $_POST['legal_akta_desc'] ?? [];
        $clean_aktas  = [];

        for ( $i = 0; $i < count( $raw_numbers ); $i++ ) {
            $num = sanitize_text_field( $raw_numbers[$i] ?? '' );
            if ( ! empty( $num ) ) {
                $clean_aktas[] = [
                    'year'    => sanitize_text_field( $raw_years[$i] ?? '' ),
                    'number'  => $num,
                    'notaris' => sanitize_text_field( $raw_notaris[$i] ?? '' ),
                    'sk'      => sanitize_text_field( $raw_sks[$i] ?? '' ),
                    'desc'    => sanitize_textarea_field( $raw_descs[$i] ?? '' ),
                ];
            }
        }
        update_option( 'options_legal_akta_list', $clean_aktas );

        // Info Card: Entitas & Kantor
        update_option( 'options_legal_office_card_badge', sanitize_text_field( $_POST['options_legal_office_card_badge'] ?? '' ) );
        update_option( 'options_legal_company_name', sanitize_text_field( $_POST['options_legal_company_name'] ?? '' ) );
        update_option( 'options_legal_founder', sanitize_text_field( $_POST['options_legal_founder'] ?? '' ) );
        update_option( 'options_legal_head_office', sanitize_textarea_field( $_POST['options_legal_head_office'] ?? '' ) );
        update_option( 'options_legal_office_btn_text', sanitize_text_field( $_POST['options_legal_office_btn_text'] ?? '' ) );
        update_option( 'options_legal_office_btn_url', esc_url_raw( $_POST['options_legal_office_btn_url'] ?? '' ) );

        // 5. Seksi 4: CTA
        update_option( 'options_legal_cta_badge', sanitize_text_field( $_POST['options_legal_cta_badge'] ?? '' ) );
        update_option( 'options_legal_cta_title', sanitize_text_field( $_POST['options_legal_cta_title'] ?? '' ) );
        update_option( 'options_legal_cta_desc', sanitize_textarea_field( $_POST['options_legal_cta_desc'] ?? '' ) );
        update_option( 'options_legal_cta_btn1_text', sanitize_text_field( $_POST['options_legal_cta_btn1_text'] ?? '' ) );
        update_option( 'options_legal_cta_btn1_url', esc_url_raw( $_POST['options_legal_cta_btn1_url'] ?? '' ) );
        update_option( 'options_legal_cta_btn2_text', sanitize_text_field( $_POST['options_legal_cta_btn2_text'] ?? '' ) );
        update_option( 'options_legal_cta_btn2_url', esc_url_raw( $_POST['options_legal_cta_btn2_url'] ?? '' ) );

        echo '<div class="notice notice-success is-dismissible"><p><strong>Pengaturan Halaman Legalitas Perusahaan berhasil disimpan!</strong></p></div>';
    }

    // ── AMBIL DATA DENGAN DEFAULT VALUE ──────────────────────────────
    // Seksi 1: Hero
    $page_badge    = get_option( 'options_legal_page_badge', 'Transparansi & Kepatuhan Regulasi' );
    $page_title    = get_option( 'options_legal_page_title', 'Legalitas & Landasan Hukum Resmi' );
    $page_subtitle = get_option( 'options_legal_page_subtitle', 'Bukti legalitas pendirian, perizinan operasional perbankan syariah, registrasi perpajakan, dan kepatuhan regulasi PT Bank Perekonomian Rakyat Syariah Wakalumi.' );
    $hero_pill_1   = get_option( 'options_legal_hero_pill_1', 'SK Kemenkumham RI' );
    $hero_pill_2   = get_option( 'options_legal_hero_pill_2', 'Berizin & Diawasi OJK' );
    $hero_pill_3   = get_option( 'options_legal_hero_pill_3', 'Peserta Penjaminan LPS' );

    $hero_card_badge = get_option( 'options_legal_hero_card_badge', 'Verifikasi Hukum & Regulasi' );
    $hero_card_title = get_option( 'options_legal_hero_card_title', 'Kepatuhan Korporasi Terjamin' );
    $hero_card_desc  = get_option( 'options_legal_hero_card_desc', 'Seluruh kegiatan operasional dan produk Bank Syariah Wakalumi memiliki landasan izin usaha resmi serta diawasi otoritas negara.' );
    $hero_card_tag1  = get_option( 'options_legal_hero_card_tag1', 'Izin Resmi OJK' );
    $hero_card_tag2  = get_option( 'options_legal_hero_card_tag2', 'Fatwa DSN-MUI' );

    // Seksi 2: Registrasi Fiskal
    $sec1_badge    = get_option( 'options_legal_sec1_badge', 'Nomor Registrasi Resmi' );
    $sec1_title    = get_option( 'options_legal_sec1_title', 'Identitas Registrasi & Fiskal Perusahaan' );
    $sec1_subtitle = get_option( 'options_legal_sec1_subtitle', 'Legalitas kepatuhan terhadap perizinan berusaha nasional, perpajakan negara, dan pengelolaan zakat syariah.' );

    $reg_cards = get_option( 'options_legal_reg_cards', [] );
    if ( empty( $reg_cards ) ) {
        $legacy_nib  = get_option( 'options_legal_nib', '129.200.032.0036' );
        $legacy_npwp = get_option( 'options_legal_npwp', '1.484.259.5-411.000' );
        $legacy_npwz = get_option( 'options_legal_npwz', 'B1 000 005 8 411 000' );
        $reg_cards = [
            [
                'category'    => 'Registrasi',
                'subcategory' => 'Perizinan Berusaha',
                'badge'       => 'Berizin Resmi',
                'title'       => 'Nomor Induk Berusaha (NIB)',
                'number'      => $legacy_nib,
                'desc'        => 'Diterbitkan oleh Lembaga Pengelola dan Penyelenggara OSS berbasis risiko (Kementerian Investasi / BKPM RI).',
                'footer'      => 'Terverifikasi Valid & Terdaftar',
            ],
            [
                'category'    => 'Fiskal',
                'subcategory' => 'Perpajakan Negara',
                'badge'       => 'Wajib Pajak Badan',
                'title'       => 'Nomor Pokok Wajib Pajak (NPWP)',
                'number'      => $legacy_npwp,
                'desc'        => 'Terdaftar resmi pada Direktorat Jenderal Pajak Republik Indonesia sebagai entitas badan perbankan yang patuh fiskal.',
                'footer'      => 'Kepatuhan Pajak Nasional',
            ],
            [
                'category'    => 'Sosial Syariah',
                'subcategory' => 'Pengelolaan Zakat',
                'badge'       => 'Kepatuhan Syariah',
                'title'       => 'Nomor Pokok Wajib Zakat (NPWZ)',
                'number'      => $legacy_npwz,
                'desc'        => 'Terdaftar dalam kelembagaan kepatuhan zakat perusahaan perbankan syariah guna kemaslahatan sosial umat.',
                'footer'      => 'Zakat Terintegrasi & Amanah',
            ],
        ];
    }

    // Seksi 3: Landasan Izin Usaha & Regulator
    $sec2_badge    = get_option( 'options_legal_sec2_badge', 'Landasan Operasional' );
    $sec2_title    = get_option( 'options_legal_sec2_title', 'Izin Usaha Perbankan Syariah Republik Indonesia' );
    $sec2_subtitle = get_option( 'options_legal_sec2_subtitle', 'Operasional PT BPRS Wakalumi diselenggarakan berlandaskan izin resmi dari Otoritas Keuangan Pemerintah Republik Indonesia serta kepatuhan fatwa Dewan Syariah Nasional:' );

    $sk_cards = get_option( 'options_legal_sk_cards', [] );
    if ( empty( $sk_cards ) ) {
        $legacy_menkeu = get_option( 'options_legal_sk_menkeu', 'Nomor Kep-016/KM.17/1995 Tanggal 16 Januari 1995' );
        $legacy_bi     = get_option( 'options_legal_sk_bi', 'Nomor 13/5/KEP.Dir/Pbs/2011 Tanggal 13 Juli 2011' );
        $sk_cards = [
            [
                'abbr'   => 'SK',
                'tag'    => 'Kementerian Keuangan RI',
                'number' => $legacy_menkeu,
                'desc'   => 'Izin Usaha Pendirian Bank Pembiayaan Rakyat Syariah (BPRS) berlandaskan Undang-Undang Perbankan Syariah.',
            ],
            [
                'abbr'   => 'BI',
                'tag'    => 'Bank Indonesia',
                'number' => $legacy_bi,
                'desc'   => 'Surat Keputusan Bank Indonesia terkait penyesuaian anggaran dasar dan kelembagaan BPR Syariah.',
            ],
        ];
    }

    $sec2_card_badge = get_option( 'options_legal_sec2_card_badge', 'Perlindungan & Keamanan Nasabah' );
    $sec2_card_title = get_option( 'options_legal_sec2_card_title', 'Diawasi OJK & Dijamin LPS' );

    $regulators = get_option( 'options_legal_regulators', [] );
    if ( empty( $regulators ) ) {
        $regulators = [
            [
                'number' => '01',
                'title'  => 'Otoritas Jasa Keuangan (OJK)',
                'desc'   => 'PT BPRS Wakalumi terdaftar resmi dan diawasi ketat oleh OJK sesuai kaidah kehati-hatian perbankan (prudential banking).',
            ],
            [
                'number' => '02',
                'title'  => 'Lembaga Penjamin Simpanan (LPS)',
                'desc'   => 'Simpanan dana nasabah (tabungan & deposito syariah) dijamin oleh LPS sampai dengan Rp 2 Miliar per nasabah per bank.',
            ],
            [
                'number' => '03',
                'title'  => 'Dewan Pengawas Syariah (DPS)',
                'desc'   => 'Seluruh akad pembiayaan, produk penghimpunan dana, dan operasional perbankan diawasi kepatuhannya berpedoman pada fatwa DSN-MUI.',
            ],
        ];
    }

    // Seksi 4: Akta Notaris & Kantor
    $sec3_badge    = get_option( 'options_legal_sec3_badge', 'Kronologi Yuridis' );
    $sec3_title    = get_option( 'options_legal_sec3_title', 'Rekam Jejak Akta Notaris & Perubahan Anggaran Dasar' );
    $sec3_subtitle = get_option( 'options_legal_sec3_subtitle', 'Dokumentasi yuridis perjalanan kelembagaan PT BPRS Wakalumi dari pendirian tahun 1989 hingga pembaruan anggaran dasar terkini.' );

    $aktas = get_option( 'options_legal_akta_list', [] );
    if ( empty( $aktas ) ) {
        $aktas = [
            [
                'year'    => '1989',
                'number'  => 'Akta Notaris No. 59 Tanggal 7 Oktober 1989',
                'notaris' => 'Ny. Siti Pertiwi Henny Shidki, SH',
                'sk'      => 'SK Menteri Kehakiman RI No. C2-155.HT.01.01.TH.90 (13 Januari 1990)',
                'desc'    => 'Akta Pendirian PT BPRS Wakalumi oleh Yayasan Wakalumi.',
            ],
            [
                'year'    => '1994',
                'number'  => 'Akta Notaris No. 78 Tanggal 9 Juni 1994',
                'notaris' => 'B.R.A.Y Mahyastoeti Notonagoro, SH',
                'sk'      => 'SK Terkait Penataan Manajemen & Kepemilikan Saham',
                'desc'    => 'Perubahan Anggaran Dasar dan bantuan teknis manajemen Bank Muamalat Indonesia.',
            ],
            [
                'year'    => '2011',
                'number'  => 'Akta Notaris No. 13 Tanggal 16 Maret 2011',
                'notaris' => 'Notaris Rekanan Resmi',
                'sk'      => 'SK Menkumham No. AHU-25293.A.H.01.02 Tahun 2011 (20 Mei 2011)',
                'desc'    => 'Persetujuan Perubahan Anggaran Dasar BPRS Wakalumi Terbatas jo SK BI No. 13/5/KEP.Dir/Pbs/2011.',
            ],
            [
                'year'    => '2024',
                'number'  => 'Akta Notaris PKR No. 03 Tanggal 21 Juni 2024',
                'notaris' => 'Notaris Pembuat Akta Resmi',
                'sk'      => 'SK Kementerian Hukum No. AHU-0041765.AH.01.02.Tahun 2024',
                'desc'    => 'Pernyataan Keputusan Rapat (PKR) tentang Anggaran Dasar BPRS Wakalumi.',
            ],
            [
                'year'    => '2024',
                'number'  => 'Akta Notaris PKR No. 02 Tanggal 20 November 2024',
                'notaris' => 'Notaris Pembuat Akta Resmi',
                'sk'      => 'SK Kementerian Hukum No. AHU-01.03-0214138 & AHU.AHA.01.09-0279901',
                'desc'    => 'Penyesuaian Anggaran Dasar BPRS Wakalumi.',
            ],
            [
                'year'    => '2025',
                'number'  => 'Akta Notaris PKR No. 02 Tanggal 05 Mei 2025',
                'notaris' => 'Notaris Pembuat Akta Resmi',
                'sk'      => 'Penerimaan Pemberitahuan Perubahan Anggaran Dasar Kemenkumham RI',
                'desc'    => 'Pembaruan terkini Anggaran Dasar PT BPRS Wakalumi.',
            ],
        ];
    }

    $office_card_badge = get_option( 'options_legal_office_card_badge', 'Entitas Korporasi' );
    $company_name      = get_option( 'options_legal_company_name', 'PT. Bank Perekonomian Rakyat Syariah Wakalumi' );
    $founder           = get_option( 'options_legal_founder', 'Yayasan Wakalumi (Wakaf Karyawan dan Alumni Muslim Citibank)' );
    $head_office       = get_option( 'options_legal_head_office', 'Komp. Ciputat Mutiara Center Blok B1, Jl. Dewi Sartika Ciputat - Tangerang Selatan' );
    $office_btn_text   = get_option( 'options_legal_office_btn_text', 'Peta & Kontak Kantor' );
    $office_btn_url    = get_option( 'options_legal_office_btn_url', home_url( '/kontak' ) );

    // Seksi 5: CTA Bawah
    $cta_badge     = get_option( 'options_legal_cta_badge', 'Transparansi & Kemitraan' );
    $cta_title     = get_option( 'options_legal_cta_title', 'Perlu Verifikasi Legalitas atau Salinan Dokumen Resmi?' );
    $cta_desc      = get_option( 'options_legal_cta_desc', 'Tim kepatuhan dan sekretariat korporasi BPRS Wakalumi siap melayani kebutuhan verifikasi hukum, kemitraan institusi, dan kepatuhan syariah Anda.' );
    $cta_btn1_text = get_option( 'options_legal_cta_btn1_text', 'Hubungi Sekretariat via WhatsApp' );
    $cta_btn1_url  = get_option( 'options_legal_cta_btn1_url', '' );
    $cta_btn2_text = get_option( 'options_legal_cta_btn2_text', 'Lihat Susunan Pengurus' );
    $cta_btn2_url  = get_option( 'options_legal_cta_btn2_url', home_url( '/profil/susunan-pengurus' ) );

    $wa_number     = get_option( 'options_contact_wa', '6281517380388' );
    if ( empty( $cta_btn1_url ) ) {
        $cta_btn1_url = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );
    }
    ?>
    <div class="wrap" style="max-width: 1040px; margin-top: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0;">
                    📜 Pengaturan Halaman: Legalitas Perusahaan
                </h1>
                <p style="color: #64748b; margin: 6px 0 0 0; font-size: 13px;">
                    Kelola seluruh konten, judul, kicker badge, susunan kartu, rekam jejak akta, dan CTA legalitas per-section secara modular.
                </p>
            </div>
            <a href="<?php echo esc_url( home_url( '/profil/legalitas' ) ); ?>" target="_blank" class="button button-secondary" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; padding: 5px 14px;">
                <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px;"></span> Lihat Halaman Live
            </a>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field( 'wakalumi_legalitas_nonce' ); ?>

            <!-- ── SEKSI 1: HERO BANNER & KARTU VERIFIKASI ────────────── -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px;">
                <h2 style="font-size: 17px; margin: 0 0 18px 0; padding-bottom: 12px; border-bottom: 2px solid #f1f5f9; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-cover-image"></span> Seksi 1: Hero Banner & Kartu Verifikasi Hukum
                </h2>

                <h3 style="font-size: 14px; font-weight: 700; color: #334155; margin: 15px 0 10px 0;">A. Banner Judul & Poin Sorotan (Kiri)</h3>
                <table class="form-table" role="presentation" style="margin-bottom: 20px;">
                    <tr>
                        <th scope="row"><label for="options_legal_page_badge">Kicker / Badge Atas</label></th>
                        <td>
                            <input type="text" id="options_legal_page_badge" name="options_legal_page_badge" value="<?php echo esc_attr( $page_badge ); ?>" class="regular-text">
                            <p class="description">Badge kecil di atas judul utama (misal: "Transparansi & Kepatuhan Regulasi").</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_page_title">Judul Utama Halaman</label></th>
                        <td>
                            <input type="text" id="options_legal_page_title" name="options_legal_page_title" value="<?php echo esc_attr( $page_title ); ?>" class="large-text" style="font-size: 16px; font-weight: bold;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_page_subtitle">Deskripsi Sub-Judul</label></th>
                        <td>
                            <textarea id="options_legal_page_subtitle" name="options_legal_page_subtitle" rows="2" class="large-text"><?php echo esc_textarea( $page_subtitle ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Poin Sorotan (Pills)</th>
                        <td>
                            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                <input type="text" name="options_legal_hero_pill_1" value="<?php echo esc_attr( $hero_pill_1 ); ?>" placeholder="Poin 1 (mis: SK Kemenkumham)" style="flex: 1; min-width: 180px;">
                                <input type="text" name="options_legal_hero_pill_2" value="<?php echo esc_attr( $hero_pill_2 ); ?>" placeholder="Poin 2 (mis: Berizin OJK)" style="flex: 1; min-width: 180px;">
                                <input type="text" name="options_legal_hero_pill_3" value="<?php echo esc_attr( $hero_pill_3 ); ?>" placeholder="Poin 3 (mis: Dijamin LPS)" style="flex: 1; min-width: 180px;">
                            </div>
                        </td>
                    </tr>
                </table>

                <h3 style="font-size: 14px; font-weight: 700; color: #334155; margin: 20px 0 10px 0; padding-top: 15px; border-top: 1px dashed #e2e8f0;">B. Kartu Verifikasi Kepatuhan (Kanan)</h3>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_legal_hero_card_badge">Badge Kartu</label></th>
                        <td>
                            <input type="text" id="options_legal_hero_card_badge" name="options_legal_hero_card_badge" value="<?php echo esc_attr( $hero_card_badge ); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_hero_card_title">Judul Kartu</label></th>
                        <td>
                            <input type="text" id="options_legal_hero_card_title" name="options_legal_hero_card_title" value="<?php echo esc_attr( $hero_card_title ); ?>" class="large-text" style="font-weight: 600;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_hero_card_desc">Deskripsi Kartu</label></th>
                        <td>
                            <textarea id="options_legal_hero_card_desc" name="options_legal_hero_card_desc" rows="2" class="large-text"><?php echo esc_textarea( $hero_card_desc ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Label Tag Kepatuhan</th>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" name="options_legal_hero_card_tag1" value="<?php echo esc_attr( $hero_card_tag1 ); ?>" placeholder="Tag Kiri (mis: Izin Resmi OJK)" class="regular-text">
                                <input type="text" name="options_legal_hero_card_tag2" value="<?php echo esc_attr( $hero_card_tag2 ); ?>" placeholder="Tag Kanan (mis: Fatwa DSN-MUI)" class="regular-text">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── SEKSI 2: IDENTITAS & REGISTRASI FISKAL ──────────── -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px;">
                <h2 style="font-size: 17px; margin: 0 0 18px 0; padding-bottom: 12px; border-bottom: 2px solid #f1f5f9; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-id"></span> Seksi 2: Identitas Registrasi & Fiskal (Kartu NIB, NPWP, NPWZ, dll)
                </h2>

                <h3 style="font-size: 14px; font-weight: 700; color: #334155; margin: 15px 0 10px 0;">A. Judul & Header Seksi</h3>
                <table class="form-table" role="presentation" style="margin-bottom: 20px;">
                    <tr>
                        <th scope="row"><label for="options_legal_sec1_badge">Badge Seksi</label></th>
                        <td><input type="text" id="options_legal_sec1_badge" name="options_legal_sec1_badge" value="<?php echo esc_attr( $sec1_badge ); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_sec1_title">Judul Seksi</label></th>
                        <td><input type="text" id="options_legal_sec1_title" name="options_legal_sec1_title" value="<?php echo esc_attr( $sec1_title ); ?>" class="large-text" style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_sec1_subtitle">Sub-Judul Seksi</label></th>
                        <td><textarea id="options_legal_sec1_subtitle" name="options_legal_sec1_subtitle" rows="2" class="large-text"><?php echo esc_textarea( $sec1_subtitle ); ?></textarea></td>
                    </tr>
                </table>

                <h3 style="font-size: 14px; font-weight: 700; color: #334155; margin: 20px 0 10px 0; padding-top: 15px; border-top: 1px dashed #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                    <span>B. Daftar Kartu Registrasi (Dapat Ditambah, Dihapus & Diubah Urutannya)</span>
                </h3>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 15px;">
                    Gunakan tombol <strong>🔼 Naik</strong> atau <strong>🔽 Turun</strong> untuk mengatur posisi/urutan kartu pada tampilan frontend. Setiap kartu dilengkapi fitur salin (copy) otomatis.
                </p>

                <div id="reg-cards-container" style="display: flex; flex-direction: column; gap: 15px;">
                    <?php foreach ( $reg_cards as $r_idx => $rcard ) : ?>
                        <div class="wkl-sortable-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px; position: relative;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span class="wkl-card-order-badge" style="background: #088395; color: #fff; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 6px;">#<?php echo $r_idx + 1; ?></span>
                                    <strong style="font-size: 14px; color: #0f172a;" class="wkl-card-title-preview"><?php echo esc_html( $rcard['title'] ?? 'Kartu Registrasi' ); ?></strong>
                                </div>
                                <div style="display: flex; gap: 5px;">
                                    <button type="button" class="button button-small wkl-btn-up" title="Geser ke Atas">🔼 Naik</button>
                                    <button type="button" class="button button-small wkl-btn-down" title="Geser ke Bawah">🔽 Turun</button>
                                    <button type="button" class="button button-small button-link-delete wkl-btn-delete" style="color: #ef4444;" title="Hapus Kartu">✕ Hapus</button>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 12px; margin-bottom: 12px;">
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Kategori / Header Kiri</label>
                                    <input type="text" name="reg_card_category[]" value="<?php echo esc_attr( $rcard['category'] ?? '' ); ?>" class="large-text" placeholder="misal: Registrasi / Fiskal">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Sub-Kategori</label>
                                    <input type="text" name="reg_card_subcategory[]" value="<?php echo esc_attr( $rcard['subcategory'] ?? '' ); ?>" class="large-text" placeholder="misal: Perizinan Berusaha">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Pill Status Kanan</label>
                                    <input type="text" name="reg_card_badge[]" value="<?php echo esc_attr( $rcard['badge'] ?? '' ); ?>" class="large-text" placeholder="misal: Berizin Resmi">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Judul Kartu</label>
                                    <input type="text" name="reg_card_title[]" value="<?php echo esc_attr( $rcard['title'] ?? '' ); ?>" class="large-text wkl-input-title" placeholder="misal: Nomor Induk Berusaha (NIB)" style="font-weight: 600;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Nomor Resmi (Bisa Di-Salin)</label>
                                    <input type="text" name="reg_card_number[]" value="<?php echo esc_attr( $rcard['number'] ?? '' ); ?>" class="large-text" placeholder="misal: 129.200.032.0036" style="font-family: monospace; font-weight: bold; color: #088395;">
                                </div>
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Uraian Keterangan</label>
                                <textarea name="reg_card_desc[]" rows="2" class="large-text" placeholder="Uraian lembaga penerbit atau kepatuhan..."><?php echo esc_textarea( $rcard['desc'] ?? '' ); ?></textarea>
                            </div>

                            <div>
                                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Label Status Bawah (Footer Tag)</label>
                                <input type="text" name="reg_card_footer[]" value="<?php echo esc_attr( $rcard['footer'] ?? '' ); ?>" class="large-text" placeholder="misal: Terverifikasi Valid & Terdaftar">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top: 15px;">
                    <button type="button" id="btn-add-reg-card" class="button button-secondary" style="display: inline-flex; align-items: center; gap: 5px;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> + Tambah Kartu Registrasi Baru
                    </button>
                </div>
            </div>

            <!-- ── SEKSI 3: IZIN USAHA (SK) & REGULATOR ─────────────── -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px;">
                <h2 style="font-size: 17px; margin: 0 0 18px 0; padding-bottom: 12px; border-bottom: 2px solid #f1f5f9; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-shield"></span> Seksi 3: Landasan Izin Usaha & Lembaga Pengawas (OJK, LPS, DPS)
                </h2>

                <h3 style="font-size: 14px; font-weight: 700; color: #334155; margin: 15px 0 10px 0;">A. Kolom Kiri: Izin Usaha Operasional & SK Perbankan</h3>
                <table class="form-table" role="presentation" style="margin-bottom: 20px;">
                    <tr>
                        <th scope="row"><label for="options_legal_sec2_badge">Badge Kiri</label></th>
                        <td><input type="text" id="options_legal_sec2_badge" name="options_legal_sec2_badge" value="<?php echo esc_attr( $sec2_badge ); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_sec2_title">Judul Kiri</label></th>
                        <td><input type="text" id="options_legal_sec2_title" name="options_legal_sec2_title" value="<?php echo esc_attr( $sec2_title ); ?>" class="large-text" style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_sec2_subtitle">Sub-Judul Kiri</label></th>
                        <td><textarea id="options_legal_sec2_subtitle" name="options_legal_sec2_subtitle" rows="2" class="large-text"><?php echo esc_textarea( $sec2_subtitle ); ?></textarea></td>
                    </tr>
                </table>

                <p style="font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 10px;">Daftar Surat Keputusan (SK) Operasional:</p>
                <div id="sk-cards-container" style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 15px;">
                    <?php foreach ( $sk_cards as $sk_idx => $sk_item ) : ?>
                        <div class="wkl-sortable-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; position: relative;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <strong style="font-size: 13px; color: #088395;">SK #<?php echo $sk_idx + 1; ?>: <?php echo esc_html( $sk_item['tag'] ?? 'SK' ); ?></strong>
                                <div style="display: flex; gap: 4px;">
                                    <button type="button" class="button button-small wkl-btn-up">🔼 Naik</button>
                                    <button type="button" class="button button-small wkl-btn-down">🔽 Turun</button>
                                    <button type="button" class="button button-small button-link-delete wkl-btn-delete" style="color: #ef4444;">✕ Hapus</button>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 80px 1fr 2fr; gap: 10px; margin-bottom: 8px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">Inisial</label>
                                    <input type="text" name="sk_card_abbr[]" value="<?php echo esc_attr( $sk_item['abbr'] ?? 'SK' ); ?>" style="width: 100%; text-align: center; font-weight: bold;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">Lembaga Penerbit</label>
                                    <input type="text" name="sk_card_tag[]" value="<?php echo esc_attr( $sk_item['tag'] ?? '' ); ?>" style="width: 100%;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">Nomor SK & Tanggal</label>
                                    <input type="text" name="sk_card_number[]" value="<?php echo esc_attr( $sk_item['number'] ?? '' ); ?>" style="width: 100%; font-weight: 600;">
                                </div>
                            </div>
                            <div>
                                <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">Keterangan Izin</label>
                                <textarea name="sk_card_desc[]" rows="2" style="width: 100%;"><?php echo esc_textarea( $sk_item['desc'] ?? '' ); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" id="btn-add-sk-card" class="button button-secondary" style="margin-bottom: 25px;">
                    <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> + Tambah SK Perizinan
                </button>

                <h3 style="font-size: 14px; font-weight: 700; color: #334155; margin: 25px 0 10px 0; padding-top: 15px; border-top: 1px dashed #e2e8f0;">B. Kolom Kanan: 3 Pilar Pengawasan & Perlindungan Nasabah (OJK, LPS, DPS)</h3>
                <table class="form-table" role="presentation" style="margin-bottom: 15px;">
                    <tr>
                        <th scope="row"><label for="options_legal_sec2_card_badge">Badge Kartu Kanan</label></th>
                        <td><input type="text" id="options_legal_sec2_card_badge" name="options_legal_sec2_card_badge" value="<?php echo esc_attr( $sec2_card_badge ); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_sec2_card_title">Judul Kartu Kanan</label></th>
                        <td><input type="text" id="options_legal_sec2_card_title" name="options_legal_sec2_card_title" value="<?php echo esc_attr( $sec2_card_title ); ?>" class="large-text" style="font-weight: bold;"></td>
                    </tr>
                </table>

                <p style="font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 10px;">Daftar Lembaga Pengawas & Penjamin:</p>
                <div id="regulators-container" style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 15px;">
                    <?php foreach ( $regulators as $rg_idx => $reg_item ) : ?>
                        <div class="wkl-sortable-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; position: relative;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <strong style="font-size: 13px; color: #088395;">Lembaga #<?php echo $rg_idx + 1; ?>: <?php echo esc_html( $reg_item['title'] ?? '' ); ?></strong>
                                <div style="display: flex; gap: 4px;">
                                    <button type="button" class="button button-small wkl-btn-up">🔼 Naik</button>
                                    <button type="button" class="button button-small wkl-btn-down">🔽 Turun</button>
                                    <button type="button" class="button button-small button-link-delete wkl-btn-delete" style="color: #ef4444;">✕ Hapus</button>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 80px 1fr; gap: 10px; margin-bottom: 8px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">No. / Indeks</label>
                                    <input type="text" name="regulator_number[]" value="<?php echo esc_attr( $reg_item['number'] ?? sprintf( '%02d', $rg_idx + 1 ) ); ?>" style="width: 100%; text-align: center; font-weight: bold;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">Nama Lembaga</label>
                                    <input type="text" name="regulator_title[]" value="<?php echo esc_attr( $reg_item['title'] ?? '' ); ?>" style="width: 100%; font-weight: 600;">
                                </div>
                            </div>
                            <div>
                                <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">Deskripsi Perlindungan & Regulasi</label>
                                <textarea name="regulator_desc[]" rows="2" style="width: 100%;"><?php echo esc_textarea( $reg_item['desc'] ?? '' ); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" id="btn-add-regulator" class="button button-secondary">
                    <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> + Tambah Lembaga Pengawas
                </button>
            </div>

            <!-- ── SEKSI 4: REKAM JEJAK AKTA NOTARIS ───────────── -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px;">
                <h2 style="font-size: 17px; margin: 0 0 18px 0; padding-bottom: 12px; border-bottom: 2px solid #f1f5f9; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-book"></span> Seksi 4: Rekam Jejak Akta Notaris & Perubahan Anggaran Dasar
                </h2>

                <h3 style="font-size: 14px; font-weight: 700; color: #334155; margin: 15px 0 10px 0;">A. Judul & Header Linimasa</h3>
                <table class="form-table" role="presentation" style="margin-bottom: 20px;">
                    <tr>
                        <th scope="row"><label for="options_legal_sec3_badge">Badge Seksi</label></th>
                        <td><input type="text" id="options_legal_sec3_badge" name="options_legal_sec3_badge" value="<?php echo esc_attr( $sec3_badge ); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_sec3_title">Judul Seksi</label></th>
                        <td><input type="text" id="options_legal_sec3_title" name="options_legal_sec3_title" value="<?php echo esc_attr( $sec3_title ); ?>" class="large-text" style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_sec3_subtitle">Sub-Judul Seksi</label></th>
                        <td><textarea id="options_legal_sec3_subtitle" name="options_legal_sec3_subtitle" rows="2" class="large-text"><?php echo esc_textarea( $sec3_subtitle ); ?></textarea></td>
                    </tr>
                </table>

                <h3 style="font-size: 14px; font-weight: 700; color: #334155; margin: 20px 0 10px 0; padding-top: 15px; border-top: 1px dashed #e2e8f0;">B. Tabel Akta Notaris (Dapat Diubah Urutannya 🔼 / 🔽)</h3>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 15px;">
                    Kartu akta terakhir secara otomatis mendapatkan penanda khusus "Mutakhir" pada frontend. Anda dapat mengubah urutan secara kronologis sesuai kebutuhan.
                </p>

                <table class="widefat fixed striped" style="border-radius: 8px; overflow: hidden; margin-bottom: 15px;">
                    <thead>
                        <tr>
                            <th style="width: 70px; text-align: center;">Tahun</th>
                            <th style="width: 250px;">Nomor & Tanggal Akta</th>
                            <th style="width: 180px;">Notaris</th>
                            <th>Pengesahan SK Kemenkumham / Uraian</th>
                            <th style="width: 140px; text-align: center;">Urutan & Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="legal-aktas-tbody">
                        <?php foreach ( $aktas as $a_idx => $akta ) : ?>
                            <tr class="wkl-sortable-row">
                                <td style="vertical-align: top; padding-top: 10px; text-align: center;">
                                    <input type="text" name="legal_akta_year[]" value="<?php echo esc_attr( $akta['year'] ?? '' ); ?>" style="width: 60px; text-align: center; font-weight: bold; color: #088395;">
                                </td>
                                <td style="vertical-align: top; padding-top: 10px;">
                                    <input type="text" name="legal_akta_number[]" value="<?php echo esc_attr( $akta['number'] ?? '' ); ?>" class="large-text" style="font-weight: 600;" placeholder="Nama & No. Akta">
                                    <input type="text" name="legal_akta_desc[]" value="<?php echo esc_attr( $akta['desc'] ?? '' ); ?>" class="large-text" style="margin-top: 4px; font-size: 12px;" placeholder="Uraian ringkas perubahan">
                                </td>
                                <td style="vertical-align: top; padding-top: 10px;">
                                    <input type="text" name="legal_akta_notaris[]" value="<?php echo esc_attr( $akta['notaris'] ?? '' ); ?>" class="large-text" placeholder="Nama Notaris">
                                </td>
                                <td style="vertical-align: top; padding-top: 10px;">
                                    <textarea name="legal_akta_sk[]" rows="2" class="large-text" placeholder="Nomor SK Pengesahan Kemenkumham"><?php echo esc_textarea( $akta['sk'] ?? '' ); ?></textarea>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <div style="display: flex; gap: 4px; justify-content: center;">
                                        <button type="button" class="button button-small wkl-btn-up" title="Geser ke Atas">🔼</button>
                                        <button type="button" class="button button-small wkl-btn-down" title="Geser ke Bawah">🔽</button>
                                        <button type="button" class="button button-small button-link-delete wkl-btn-delete" style="color: #ef4444;" title="Hapus">✕</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" id="btn-add-akta" class="button button-secondary" style="margin-bottom: 25px;">
                    <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> + Tambah Akta Notaris
                </button>

                <h3 style="font-size: 14px; font-weight: 700; color: #334155; margin: 25px 0 10px 0; padding-top: 15px; border-top: 1px dashed #e2e8f0;">C. Kartu Entitas Korporasi & Kantor Pusat (Bawah Linimasa)</h3>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_legal_office_card_badge">Badge Kartu</label></th>
                        <td><input type="text" id="options_legal_office_card_badge" name="options_legal_office_card_badge" value="<?php echo esc_attr( $office_card_badge ); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_company_name">Nama Resmi Perusahaan</label></th>
                        <td><input type="text" id="options_legal_company_name" name="options_legal_company_name" value="<?php echo esc_attr( $company_name ); ?>" class="large-text" style="font-weight: 600;"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_founder">Yayasan / Badan Pendiri</label></th>
                        <td><input type="text" id="options_legal_founder" name="options_legal_founder" value="<?php echo esc_attr( $founder ); ?>" class="large-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_head_office">Alamat Kantor Pusat</label></th>
                        <td><textarea id="options_legal_head_office" name="options_legal_head_office" rows="2" class="large-text"><?php echo esc_textarea( $head_office ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row">Tombol Aksi Kontak</th>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" name="options_legal_office_btn_text" value="<?php echo esc_attr( $office_btn_text ); ?>" placeholder="Teks Tombol (mis: Peta & Kontak Kantor)" class="regular-text">
                                <input type="text" name="options_legal_office_btn_url" value="<?php echo esc_attr( $office_btn_url ); ?>" placeholder="URL Tombol (mis: /kontak)" class="regular-text">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── SEKSI 5: CTA BANNER ────────────────────────── -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px;">
                <h2 style="font-size: 17px; margin: 0 0 18px 0; padding-bottom: 12px; border-bottom: 2px solid #f1f5f9; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-megaphone"></span> Seksi 5: Banner Hubungi & Verifikasi (CTA Bawah)
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_legal_cta_badge">Badge Ajakan</label></th>
                        <td><input type="text" id="options_legal_cta_badge" name="options_legal_cta_badge" value="<?php echo esc_attr( $cta_badge ); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_cta_title">Judul Ajakan</label></th>
                        <td><input type="text" id="options_legal_cta_title" name="options_legal_cta_title" value="<?php echo esc_attr( $cta_title ); ?>" class="large-text" style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_cta_desc">Uraian Keterangan</label></th>
                        <td><textarea id="options_legal_cta_desc" name="options_legal_cta_desc" rows="2" class="large-text"><?php echo esc_textarea( $cta_desc ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row">Tombol Utama (WhatsApp)</th>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" name="options_legal_cta_btn1_text" value="<?php echo esc_attr( $cta_btn1_text ); ?>" class="regular-text" placeholder="Teks Tombol">
                                <input type="text" name="options_legal_cta_btn1_url" value="<?php echo esc_attr( $cta_btn1_url ); ?>" class="regular-text" placeholder="URL WhatsApp (kosongkan untuk default)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tombol Sekunder</th>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" name="options_legal_cta_btn2_text" value="<?php echo esc_attr( $cta_btn2_text ); ?>" class="regular-text" placeholder="Teks Tombol">
                                <input type="text" name="options_legal_cta_btn2_url" value="<?php echo esc_attr( $cta_btn2_url ); ?>" class="regular-text" placeholder="URL Tombol (contoh: /profil/susunan-pengurus)">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Sticky Save Bar -->
            <div style="position: sticky; bottom: 20px; background: #0f172a; padding: 16px 25px; border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: space-between; z-index: 50;">
                <span style="color: #94a3b8; font-size: 13px;">Pastikan data legalitas telah disesuaikan sebelum menekan simpan.</span>
                <button type="submit" name="wakalumi_save_legalitas" class="button button-primary button-large" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 25px;">
                    💾 Simpan Semua Perubahan Legalitas
                </button>
            </div>
        </form>
    </div>

    <!-- Script Dynamic Reorder (Up/Down) & Add/Delete Item -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // ── Helper Re-indexing Card Badges ──
        function updateCardIndices(containerId, badgeClass) {
            var container = document.getElementById(containerId);
            if (!container) return;
            var badges = container.querySelectorAll('.' + badgeClass);
            badges.forEach(function(badge, i) {
                badge.textContent = '#' + (i + 1);
            });
        }

        // ── Up / Down Reordering Handler ──
        document.addEventListener('click', function(e) {
            var btnUp = e.target.closest('.wkl-btn-up');
            if (btnUp) {
                var item = btnUp.closest('.wkl-sortable-card, .wkl-sortable-row');
                if (item && item.previousElementSibling) {
                    item.parentNode.insertBefore(item, item.previousElementSibling);
                    var container = item.closest('#reg-cards-container');
                    if (container) updateCardIndices('reg-cards-container', 'wkl-card-order-badge');
                }
                return;
            }

            var btnDown = e.target.closest('.wkl-btn-down');
            if (btnDown) {
                var item = btnDown.closest('.wkl-sortable-card, .wkl-sortable-row');
                if (item && item.nextElementSibling) {
                    item.parentNode.insertBefore(item.nextElementSibling, item);
                    var container = item.closest('#reg-cards-container');
                    if (container) updateCardIndices('reg-cards-container', 'wkl-card-order-badge');
                }
                return;
            }

            var btnDel = e.target.closest('.wkl-btn-delete');
            if (btnDel) {
                var item = btnDel.closest('.wkl-sortable-card, .wkl-sortable-row');
                if (item) {
                    if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                        var container = item.closest('#reg-cards-container');
                        item.remove();
                        if (container) updateCardIndices('reg-cards-container', 'wkl-card-order-badge');
                    }
                }
                return;
            }
        });

        // ── Update card title preview dynamically ──
        document.addEventListener('input', function(e) {
            if (e.target && e.target.classList.contains('wkl-input-title')) {
                var card = e.target.closest('.wkl-sortable-card');
                if (card) {
                    var preview = card.querySelector('.wkl-card-title-preview');
                    if (preview) {
                        preview.textContent = e.target.value.trim() || 'Kartu Registrasi';
                    }
                }
            }
        });

        // ── 1. Add Registrasi Card ──
        var btnAddReg = document.getElementById('btn-add-reg-card');
        var regContainer = document.getElementById('reg-cards-container');
        if (btnAddReg && regContainer) {
            btnAddReg.addEventListener('click', function() {
                var count = regContainer.querySelectorAll('.wkl-sortable-card').length + 1;
                var div = document.createElement('div');
                div.className = 'wkl-sortable-card';
                div.style.cssText = 'background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px; position: relative;';
                div.innerHTML = `
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span class="wkl-card-order-badge" style="background: #088395; color: #fff; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 6px;">#${count}</span>
                            <strong style="font-size: 14px; color: #0f172a;" class="wkl-card-title-preview">Kartu Registrasi Baru</strong>
                        </div>
                        <div style="display: flex; gap: 5px;">
                            <button type="button" class="button button-small wkl-btn-up">🔼 Naik</button>
                            <button type="button" class="button button-small wkl-btn-down">🔽 Turun</button>
                            <button type="button" class="button button-small button-link-delete wkl-btn-delete" style="color: #ef4444;">✕ Hapus</button>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 12px; margin-bottom: 12px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Kategori / Header Kiri</label>
                            <input type="text" name="reg_card_category[]" value="Registrasi" class="large-text">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Sub-Kategori</label>
                            <input type="text" name="reg_card_subcategory[]" value="Perizinan Resmi" class="large-text">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Pill Status Kanan</label>
                            <input type="text" name="reg_card_badge[]" value="Terdaftar Resmi" class="large-text">
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Judul Kartu</label>
                            <input type="text" name="reg_card_title[]" value="" class="large-text wkl-input-title" placeholder="misal: Nomor Kepesertaan Lembaga" style="font-weight: 600;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Nomor Resmi (Bisa Di-Salin)</label>
                            <input type="text" name="reg_card_number[]" value="" class="large-text" placeholder="misal: 001.234.567" style="font-family: monospace; font-weight: bold; color: #088395;">
                        </div>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Uraian Keterangan</label>
                        <textarea name="reg_card_desc[]" rows="2" class="large-text" placeholder="Uraian lembaga penerbit atau kepatuhan..."></textarea>
                    </div>
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Label Status Bawah (Footer Tag)</label>
                        <input type="text" name="reg_card_footer[]" value="Terverifikasi Valid" class="large-text">
                    </div>
                `;
                regContainer.appendChild(div);
            });
        }

        // ── 2. Add SK Card ──
        var btnAddSk = document.getElementById('btn-add-sk-card');
        var skContainer = document.getElementById('sk-cards-container');
        if (btnAddSk && skContainer) {
            btnAddSk.addEventListener('click', function() {
                var count = skContainer.querySelectorAll('.wkl-sortable-card').length + 1;
                var div = document.createElement('div');
                div.className = 'wkl-sortable-card';
                div.style.cssText = 'background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; position: relative;';
                div.innerHTML = `
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <strong style="font-size: 13px; color: #088395;">SK #${count}: Baru</strong>
                        <div style="display: flex; gap: 4px;">
                            <button type="button" class="button button-small wkl-btn-up">🔼 Naik</button>
                            <button type="button" class="button button-small wkl-btn-down">🔽 Turun</button>
                            <button type="button" class="button button-small button-link-delete wkl-btn-delete" style="color: #ef4444;">✕ Hapus</button>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 80px 1fr 2fr; gap: 10px; margin-bottom: 8px;">
                        <div>
                            <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">Inisial</label>
                            <input type="text" name="sk_card_abbr[]" value="SK" style="width: 100%; text-align: center; font-weight: bold;">
                        </div>
                        <div>
                            <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">Lembaga Penerbit</label>
                            <input type="text" name="sk_card_tag[]" value="" placeholder="misal: Kementerian Hukum RI" style="width: 100%;">
                        </div>
                        <div>
                            <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">Nomor SK & Tanggal</label>
                            <input type="text" name="sk_card_number[]" value="" placeholder="Nomor Keputusan..." style="width: 100%; font-weight: 600;">
                        </div>
                    </div>
                    <div>
                        <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">Keterangan Izin</label>
                        <textarea name="sk_card_desc[]" rows="2" style="width: 100%;" placeholder="Keterangan perizinan..."></textarea>
                    </div>
                `;
                skContainer.appendChild(div);
            });
        }

        // ── 3. Add Regulator ──
        var btnAddRegulator = document.getElementById('btn-add-regulator');
        var regContainerRight = document.getElementById('regulators-container');
        if (btnAddRegulator && regContainerRight) {
            btnAddRegulator.addEventListener('click', function() {
                var count = regContainerRight.querySelectorAll('.wkl-sortable-card').length + 1;
                var padNum = count < 10 ? '0' + count : count;
                var div = document.createElement('div');
                div.className = 'wkl-sortable-card';
                div.style.cssText = 'background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; position: relative;';
                div.innerHTML = `
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <strong style="font-size: 13px; color: #088395;">Lembaga #${count}: Baru</strong>
                        <div style="display: flex; gap: 4px;">
                            <button type="button" class="button button-small wkl-btn-up">🔼 Naik</button>
                            <button type="button" class="button button-small wkl-btn-down">🔽 Turun</button>
                            <button type="button" class="button button-small button-link-delete wkl-btn-delete" style="color: #ef4444;">✕ Hapus</button>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 80px 1fr; gap: 10px; margin-bottom: 8px;">
                        <div>
                            <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">No. / Indeks</label>
                            <input type="text" name="regulator_number[]" value="${padNum}" style="width: 100%; text-align: center; font-weight: bold;">
                        </div>
                        <div>
                            <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">Nama Lembaga</label>
                            <input type="text" name="regulator_title[]" value="" placeholder="Nama Lembaga..." style="width: 100%; font-weight: 600;">
                        </div>
                    </div>
                    <div>
                        <label style="font-size: 11px; font-weight: bold; color: #475569; display: block;">Deskripsi Perlindungan & Regulasi</label>
                        <textarea name="regulator_desc[]" rows="2" style="width: 100%;" placeholder="Keterangan pengawasan..."></textarea>
                    </div>
                `;
                regContainerRight.appendChild(div);
            });
        }

        // ── 4. Add Akta Row ──
        var btnAddAkta = document.getElementById('btn-add-akta');
        var tbodyAkta  = document.getElementById('legal-aktas-tbody');
        if (btnAddAkta && tbodyAkta) {
            btnAddAkta.addEventListener('click', function() {
                var tr = document.createElement('tr');
                tr.className = 'wkl-sortable-row';
                tr.innerHTML = `
                    <td style="vertical-align: top; padding-top: 10px; text-align: center;">
                        <input type="text" name="legal_akta_year[]" value="<?php echo date('Y'); ?>" style="width: 60px; text-align: center; font-weight: bold; color: #088395;">
                    </td>
                    <td style="vertical-align: top; padding-top: 10px;">
                        <input type="text" name="legal_akta_number[]" value="" class="large-text" style="font-weight: 600;" placeholder="Nama & No. Akta">
                        <input type="text" name="legal_akta_desc[]" value="" class="large-text" style="margin-top: 4px; font-size: 12px;" placeholder="Uraian ringkas perubahan">
                    </td>
                    <td style="vertical-align: top; padding-top: 10px;">
                        <input type="text" name="legal_akta_notaris[]" value="" class="large-text" placeholder="Nama Notaris">
                    </td>
                    <td style="vertical-align: top; padding-top: 10px;">
                        <textarea name="legal_akta_sk[]" rows="2" class="large-text" placeholder="Nomor SK Pengesahan Kemenkumham"></textarea>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <div style="display: flex; gap: 4px; justify-content: center;">
                            <button type="button" class="button button-small wkl-btn-up" title="Geser ke Atas">🔼</button>
                            <button type="button" class="button button-small wkl-btn-down" title="Geser ke Bawah">🔽</button>
                            <button type="button" class="button button-small button-link-delete wkl-btn-delete" style="color: #ef4444;" title="Hapus">✕</button>
                        </div>
                    </td>
                `;
                tbodyAkta.appendChild(tr);
            });
        }
    });
    </script>
    <?php
}
