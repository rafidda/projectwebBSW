<?php
/**
 * Template Name: Legalitas Perusahaan
 * Description: Halaman Kepatuhan Hukum, Perizinan Operasional, dan Akta Notaris Resmi BPRS Wakalumi
 *
 * @package Wakalumi
 */

get_header();

// ── AMBIL DATA PENGATURAN HALAMAN DARI WP_OPTIONS ─────────────────
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
            'desc'    => 'Akta Pendirian PT BPRS Wakalumi oleh Yayasan Wakalumi (Wakaf Karyawan dan Alumni Muslim Citibank).',
        ],
        [
            'year'    => '1994',
            'number'  => 'Akta Notaris No. 78 Tanggal 9 Juni 1994',
            'notaris' => 'B.R.A.Y Mahyastoeti Notonagoro, SH',
            'sk'      => 'SK Terkait Penataan Manajemen & Kepemilikan Saham',
            'desc'    => 'Perubahan Anggaran Dasar terkait kerjasama bantuan teknis dan manajemen Bank Muamalat Indonesia.',
        ],
        [
            'year'    => '2011',
            'number'  => 'Akta Notaris No. 13 Tanggal 16 Maret 2011',
            'notaris' => 'Notaris Rekanan Resmi',
            'sk'      => 'SK Menkumham No. AHU-25293.A.H.01.02 Tahun 2011 (20 Mei 2011)',
            'desc'    => 'Persetujuan Perubahan Anggaran Dasar BPRS Wakalumi Terbatas jo Surat Keputusan Bank Indonesia No. 13/5/KEP.Dir/Pbs/2011 Tanggal 13 Juli 2011.',
        ],
        [
            'year'    => '2024',
            'number'  => 'Akta Notaris PKR No. 03 Tanggal 21 Juni 2024',
            'notaris' => 'Notaris Pembuat Akta Resmi',
            'sk'      => 'SK Kementerian Hukum RI No. AHU-0041765.AH.01.02.Tahun 2024',
            'desc'    => 'Pernyataan Keputusan Rapat (PKR) tentang Anggaran Dasar BPRS Wakalumi.',
        ],
        [
            'year'    => '2024',
            'number'  => 'Akta Notaris PKR No. 02 Tanggal 20 November 2024',
            'notaris' => 'Notaris Pembuat Akta Resmi',
            'sk'      => 'SK Kementerian Hukum RI No. AHU-01.03-0214138 & AHU.AHA.01.09-0279901',
            'desc'    => 'Penyesuaian Anggaran Dasar dan susunan kepengurusan BPRS Wakalumi.',
        ],
        [
            'year'    => '2025',
            'number'  => 'Akta Notaris PKR No. 02 Tanggal 05 Mei 2025',
            'notaris' => 'Notaris Pembuat Akta Resmi',
            'sk'      => 'Pemberitahuan Perubahan Anggaran Dasar Kemenkumham RI',
            'desc'    => 'Pembaruan terkini Anggaran Dasar PT Bank Perekonomian Rakyat Syariah Wakalumi.',
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

<!-- ========================================
     HEADER BANNER & BREADCRUMBS (HERO + KARTU VERIFIKASI HUKUM)
     ======================================== -->
<section class="wkl-page-hero">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-80 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

    <div class="container-wide relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-400 transition-colors flex items-center gap-1.5 font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-slate-600 dark:text-slate-300 font-medium">Profil</span>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-teal-600 dark:text-teal-400 font-bold">Legalitas Perusahaan</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            <!-- Left Column: Title, Subtitle & Highlights -->
            <div class="lg:col-span-7 xl:col-span-8" data-aos="fade-up">
                <!-- Kicker Badge -->
                <?php if ( ! empty( $page_badge ) ) : ?>
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full mb-4 bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        <span><?php echo esc_html( $page_badge ); ?></span>
                    </div>
                <?php endif; ?>

                <!-- Main Page Title -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-[1.15] mb-4">
                    <?php echo esc_html( $page_title ); ?>
                </h1>

                <!-- Subtitle -->
                <?php if ( ! empty( $page_subtitle ) ) : ?>
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                        <?php echo esc_html( $page_subtitle ); ?>
                    </p>
                <?php endif; ?>

                <!-- Key Highlights Pills -->
                <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                    <?php if ( ! empty( $hero_pill_1 ) ) : ?>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                            <span><?php echo esc_html( $hero_pill_1 ); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $hero_pill_2 ) ) : ?>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span><?php echo esc_html( $hero_pill_2 ); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $hero_pill_3 ) ) : ?>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span><?php echo esc_html( $hero_pill_3 ); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Column: Legal Authority & Emblem Badge Card -->
            <div class="lg:col-span-5 xl:col-span-4" data-aos="fade-up" data-aos-delay="100">
                <div class="spotlight-card relative overflow-hidden rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-teal-200/80 dark:border-teal-800/60 shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 group cursor-default">
                    <div class="h-1.5 w-full bg-gradient-to-r from-teal-500 via-cyan-400 to-emerald-500"></div>

                    <div class="p-6 bg-gradient-to-br from-teal-50/90 via-cyan-50/40 to-white dark:from-teal-950/70 dark:via-slate-900/60 dark:to-slate-900 border-b border-teal-100/80 dark:border-slate-800 relative overflow-hidden text-center">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.055] dark:opacity-[0.04] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] select-none">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>

                        <div class="relative w-16 h-16 rounded-2xl bg-white dark:bg-slate-800 flex items-center justify-center p-2.5 mx-auto shadow-md shadow-teal-500/10 border border-teal-200/80 dark:border-teal-700/60 group-hover:scale-105 transition-transform duration-300 z-10 mb-3">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled3.png' ); ?>" alt="Logo Bank Syariah Wakalumi" class="w-full h-full object-contain">
                        </div>

                        <?php if ( ! empty( $hero_card_badge ) ) : ?>
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-teal-100/90 dark:bg-teal-950 text-teal-800 dark:text-teal-300 text-[10px] font-extrabold uppercase tracking-wider mb-1 relative z-10">
                                <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                <?php echo esc_html( $hero_card_badge ); ?>
                            </div>
                        <?php endif; ?>
                        <h3 class="text-lg font-black text-slate-900 dark:text-white relative z-10">
                            <?php echo esc_html( $hero_card_title ); ?>
                        </h3>
                    </div>

                    <div class="p-6 space-y-4 bg-white dark:bg-slate-900/95 relative z-10 text-center">
                        <?php if ( ! empty( $hero_card_desc ) ) : ?>
                            <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                                <?php echo esc_html( $hero_card_desc ); ?>
                            </p>
                        <?php endif; ?>
                        <div class="pt-2 border-t border-slate-100 dark:border-slate-800 flex items-center justify-center gap-3 text-[11px] font-bold text-slate-600 dark:text-slate-300">
                            <?php if ( ! empty( $hero_card_tag1 ) ) : ?>
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    <?php echo esc_html( $hero_card_tag1 ); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ( ! empty( $hero_card_tag1 ) && ! empty( $hero_card_tag2 ) ) : ?>
                                <span class="text-slate-300 dark:text-slate-600">•</span>
                            <?php endif; ?>
                            <?php if ( ! empty( $hero_card_tag2 ) ) : ?>
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    <?php echo esc_html( $hero_card_tag2 ); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ========================================
     SEKSI 1: KARTU IDENTITAS & REGISTRASI FISKAL (REPEATER CARDS)
     ======================================== -->
<?php if ( ! empty( $reg_cards ) ) : ?>
<section class="relative z-10 py-12 md:py-16 bg-white dark:bg-dark border-b border-slate-100 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-14" data-aos="fade-up">
            <?php if ( ! empty( $sec1_badge ) ) : ?>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300 border border-teal-100 dark:border-teal-800/30 mb-3">
                    <?php echo esc_html( $sec1_badge ); ?>
                </div>
            <?php endif; ?>
            <?php if ( ! empty( $sec1_title ) ) : ?>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    <?php echo esc_html( $sec1_title ); ?>
                </h2>
            <?php endif; ?>
            <?php if ( ! empty( $sec1_subtitle ) ) : ?>
                <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-2">
                    <?php echo esc_html( $sec1_subtitle ); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <?php foreach ( $reg_cards as $c_idx => $card ) : 
                $cat      = $card['category'] ?? 'Registrasi';
                $subcat   = $card['subcategory'] ?? '';
                $badge    = $card['badge'] ?? 'Berizin Resmi';
                $c_title  = $card['title'] ?? '';
                $c_number = $card['number'] ?? '';
                $c_desc   = $card['desc'] ?? '';
                $c_footer = $card['footer'] ?? 'Terverifikasi Valid & Terdaftar';
            ?>
                <div class="spotlight-card tilt-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-md shadow-slate-100 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] hover:shadow-xl hover:shadow-teal-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between cursor-default" data-aos="fade-up" data-aos-delay="<?php echo ( $c_idx % 3 ) * 90; ?>">
                    <!-- Dual-Tone Header Bar -->
                    <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/90 border-b border-slate-100 dark:border-slate-700/80 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-teal-50 dark:bg-teal-950/40 border border-teal-200 dark:border-teal-800/40 flex items-center justify-center text-teal-600 dark:text-teal-300 shadow-sm group-hover:scale-105 transition-transform">
                                <?php if ( $c_idx === 0 || stripos( $cat, 'registrasi' ) !== false ) : ?>
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <?php elseif ( $c_idx === 1 || stripos( $cat, 'fiskal' ) !== false || stripos( $cat, 'pajak' ) !== false ) : ?>
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                <?php else : ?>
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                                <?php endif; ?>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase tracking-widest font-extrabold text-slate-400 dark:text-teal-300 block"><?php echo esc_html( $cat ); ?></span>
                                <span class="text-xs font-bold text-slate-700 dark:text-white"><?php echo esc_html( $subcat ); ?></span>
                            </div>
                        </div>
                        <?php if ( ! empty( $badge ) ) : ?>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-900/30 dark:text-teal-300 border border-teal-200 dark:border-teal-700/50">
                                <?php echo esc_html( $badge ); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 md:p-7 relative flex-grow flex flex-col justify-between overflow-hidden">
                        <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-36 h-36 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>

                        <div class="relative z-10">
                            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-3"><?php echo esc_html( $c_title ); ?></h3>
                            
                            <!-- Copy Box Number -->
                            <?php if ( ! empty( $c_number ) ) : ?>
                                <div class="flex items-center justify-between gap-2 p-3 sm:p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 mb-4 group/copy">
                                    <span class="font-mono font-black text-sm sm:text-base md:text-lg text-teal-700 dark:text-teal-300 tracking-wider select-all truncate">
                                        <?php echo esc_html( $c_number ); ?>
                                    </span>
                                    <button type="button" 
                                            class="btn-copy-code shrink-0 px-2.5 py-1 rounded-lg bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-xs font-sans font-semibold text-slate-600 dark:text-white hover:text-teal-600 dark:hover:text-teal-300 hover:border-teal-400/50 shadow-sm flex items-center gap-1.5 transition-all duration-200 active:scale-95" 
                                            data-copy="<?php echo esc_attr( $c_number ); ?>" 
                                            title="Salin Nomor">
                                        <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                        </svg>
                                        <span class="copy-label text-[11px]">Salin</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( $c_desc ) ) : ?>
                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-100 leading-relaxed">
                                    <?php echo esc_html( $c_desc ); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <?php if ( ! empty( $c_footer ) ) : ?>
                            <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/80 flex items-center gap-1.5 text-xs font-bold text-teal-600 dark:text-teal-400 relative z-10">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                <span><?php echo esc_html( $c_footer ); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     SEKSI 2: LANDASAN IZIN USAHA PERBANKAN & REGULATOR
     ======================================== -->
<section class="relative z-10 py-16 md:py-24 bg-transparent border-b border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- Left: SK Menteri Keuangan & SK BI -->
            <div class="lg:col-span-6" data-aos="fade-right">
                <?php if ( ! empty( $sec2_badge ) ) : ?>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-primary-50 text-primary-700 dark:bg-primary-400/10 dark:text-teal-300 border border-primary-100 dark:border-primary-800/30 mb-4">
                        <?php echo esc_html( $sec2_badge ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $sec2_title ) ) : ?>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-snug mb-6">
                        <?php echo esc_html( $sec2_title ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( ! empty( $sec2_subtitle ) ) : ?>
                    <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed mb-8">
                        <?php echo esc_html( $sec2_subtitle ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( ! empty( $sk_cards ) ) : ?>
                    <div class="space-y-5">
                        <?php foreach ( $sk_cards as $sk_idx => $sk_item ) : ?>
                            <div class="spotlight-card tilt-card group relative overflow-hidden rounded-2xl p-5 bg-white/95 dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-md dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] flex items-start gap-4 hover:border-teal-500/40 hover:shadow-md transition-all cursor-default">
                                <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-32 h-32 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-teal-100 dark:bg-teal-950 text-teal-700 dark:text-teal-300 flex items-center justify-center shrink-0 mt-0.5 font-bold relative z-10 group-hover:scale-105 transition-transform">
                                    <?php echo esc_html( $sk_item['abbr'] ?? 'SK' ); ?>
                                </div>
                                <div class="relative z-10">
                                    <?php if ( ! empty( $sk_item['tag'] ) ) : ?>
                                        <span class="text-[11px] uppercase tracking-widest font-extrabold text-slate-400 dark:text-teal-300 block">
                                            <?php echo esc_html( $sk_item['tag'] ); ?>
                                        </span>
                                    <?php endif; ?>
                                    <h4 class="text-base font-bold text-slate-900 dark:text-white mt-0.5 mb-1">
                                        <?php echo esc_html( $sk_item['number'] ?? '' ); ?>
                                    </h4>
                                    <?php if ( ! empty( $sk_item['desc'] ) ) : ?>
                                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-100">
                                            <?php echo esc_html( $sk_item['desc'] ); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right: 3 Pilar Pengawasan Regulasi (OJK, LPS, DPS) -->
            <div class="lg:col-span-6" data-aos="fade-left">
                <div class="spotlight-card tilt-card group rounded-3xl p-8 sm:p-10 bg-slate-900 text-white shadow-2xl border border-slate-800 relative overflow-hidden cursor-default">
                    <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-48 h-48 opacity-[0.04] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.08] mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain">
                    </div>
                    <div class="absolute -top-20 -right-20 w-64 h-64 bg-teal-500/20 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="relative z-10">
                        <?php if ( ! empty( $sec2_card_badge ) ) : ?>
                            <span class="text-xs uppercase tracking-widest font-bold text-teal-300 block mb-2">
                                <?php echo esc_html( $sec2_card_badge ); ?>
                            </span>
                        <?php endif; ?>

                        <?php if ( ! empty( $sec2_card_title ) ) : ?>
                            <h3 class="text-2xl sm:text-3xl font-extrabold text-white mb-6">
                                <?php echo esc_html( $sec2_card_title ); ?>
                            </h3>
                        <?php endif; ?>

                        <?php if ( ! empty( $regulators ) ) : ?>
                            <div class="space-y-6">
                                <?php foreach ( $regulators as $rg_idx => $reg_item ) : ?>
                                    <div class="flex items-start gap-4 group/item">
                                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-teal-300 shrink-0 font-bold group-hover/item:scale-110 transition-transform">
                                            <?php echo esc_html( $reg_item['number'] ?? sprintf( '%02d', $rg_idx + 1 ) ); ?>
                                        </div>
                                        <div>
                                            <h4 class="text-base font-bold text-white mb-1">
                                                <?php echo esc_html( $reg_item['title'] ?? '' ); ?>
                                            </h4>
                                            <?php if ( ! empty( $reg_item['desc'] ) ) : ?>
                                                <p class="text-sm text-slate-300 leading-relaxed">
                                                    <?php echo esc_html( $reg_item['desc'] ); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ========================================
     SEKSI 3: LINIMASA REKAM JEJAK AKTA NOTARIS
     ======================================== -->
<section class="relative z-10 py-16 md:py-24 bg-white dark:bg-dark">
    <div class="container-wide">
        <div class="text-center max-w-3xl mx-auto mb-14 md:mb-18" data-aos="fade-up">
            <?php if ( ! empty( $sec3_badge ) ) : ?>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300 border border-teal-100 dark:border-teal-800/30 mb-3">
                    <?php echo esc_html( $sec3_badge ); ?>
                </div>
            <?php endif; ?>
            <?php if ( ! empty( $sec3_title ) ) : ?>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    <?php echo esc_html( $sec3_title ); ?>
                </h2>
            <?php endif; ?>
            <?php if ( ! empty( $sec3_subtitle ) ) : ?>
                <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                    <?php echo esc_html( $sec3_subtitle ); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Timeline Grid / Cards -->
        <?php if ( ! empty( $aktas ) ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php 
                $total_aktas = count( $aktas );
                foreach ( $aktas as $idx => $item ) : 
                    $is_latest = ( $idx === $total_aktas - 1 );
                ?>
                    <div class="spotlight-card tilt-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border <?php echo $is_latest ? 'border-teal-500/50 dark:border-teal-400/60 shadow-lg shadow-teal-500/10 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.6)]' : 'border-slate-200/80 dark:border-slate-700/80 shadow-md shadow-slate-100 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)]'; ?> hover:border-teal-500/60 hover:shadow-xl hover:shadow-teal-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between cursor-default" data-aos="fade-up" data-aos-delay="<?php echo ( $idx % 3 ) * 90; ?>">
                        <!-- Dual-Tone Header Bar -->
                        <div class="px-6 py-3.5 bg-slate-50 dark:bg-slate-800/90 border-b border-slate-100 dark:border-slate-700/80 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="inline-block px-3 py-1 rounded-xl text-xs font-black bg-gradient-to-r from-primary-600 to-teal-500 text-white shadow-sm">
                                    <?php echo esc_html( $item['year'] ?? '' ); ?>
                                </span>
                                <?php if ( $is_latest ) : ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-teal-500/15 text-teal-700 dark:text-teal-300 border border-teal-500/30 pulse-teal-glow">
                                        <span class="w-1.5 h-1.5 rounded-full bg-teal-400 animate-ping"></span>
                                        Mutakhir
                                    </span>
                                <?php endif; ?>
                            </div>
                            <span class="text-[11px] font-bold text-slate-400 dark:text-slate-400 font-mono">
                                #<?php echo sprintf( '%02d', $idx + 1 ); ?>
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 relative flex-grow flex flex-col justify-between overflow-hidden">
                            <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-32 h-32 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                            </div>

                            <div class="relative z-10">
                                <!-- Akta Title -->
                                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white mb-2 leading-snug">
                                    <?php echo esc_html( $item['number'] ?? '' ); ?>
                                </h3>

                                <!-- Notaris -->
                                <?php if ( ! empty( $item['notaris'] ) ) : ?>
                                    <div class="flex items-center gap-2 text-xs font-semibold text-teal-700 dark:text-teal-300 mb-3">
                                        <svg class="w-4 h-4 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        <span><?php echo esc_html( $item['notaris'] ); ?></span>
                                    </div>
                                <?php endif; ?>

                                <!-- Description -->
                                <?php if ( ! empty( $item['desc'] ) ) : ?>
                                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-100 leading-relaxed mb-4">
                                        <?php echo esc_html( $item['desc'] ); ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <!-- SK Pengesahan Footer -->
                            <?php if ( ! empty( $item['sk'] ) ) : ?>
                                <div class="mt-4 pt-3.5 border-t border-slate-100 dark:border-slate-700/80 relative z-10">
                                    <span class="text-[10px] uppercase font-bold text-slate-400 dark:text-teal-300 block">Pengesahan Kemenkumham:</span>
                                    <span class="text-xs font-medium text-slate-700 dark:text-slate-100 font-mono break-words block mt-0.5">
                                        <?php echo esc_html( $item['sk'] ); ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Info Card: Kantor Pusat & Entitas Pendiri -->
        <div class="spotlight-card tilt-card group relative overflow-hidden mt-14 p-8 rounded-3xl bg-slate-50 dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-md dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] flex flex-col md:flex-row items-start md:items-center justify-between gap-6 cursor-default" data-aos="fade-up">
            <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
            <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-44 h-44 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
            </div>
            <div class="relative z-10">
                <?php if ( ! empty( $office_card_badge ) ) : ?>
                    <span class="text-xs uppercase tracking-widest font-extrabold text-primary-600 dark:text-teal-300 block mb-1">
                        <?php echo esc_html( $office_card_badge ); ?>
                    </span>
                <?php endif; ?>
                <h4 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2">
                    <?php echo esc_html( $company_name ); ?>
                </h4>
                <p class="text-sm text-slate-600 dark:text-slate-100 leading-relaxed max-w-2xl">
                    Didirikan oleh: <strong class="text-slate-800 dark:text-white"><?php echo esc_html( $founder ); ?></strong>.<br/>
                    Alamat Kantor Pusat: <?php echo esc_html( $head_office ); ?>.
                </p>
            </div>
            <div class="shrink-0 flex items-center gap-3 relative z-10">
                <a href="<?php echo esc_url( $office_btn_url ); ?>" class="btn-primary text-xs sm:text-sm px-6 py-3 rounded-xl inline-flex items-center gap-2">
                    <span><?php echo esc_html( $office_btn_text ); ?></span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

    </div>
</section>


<!-- ========================================
     SEKSI 4: AJAKAN BERTINDAK (CALL TO ACTION)
     ======================================== -->
<section class="relative z-10 py-16 md:py-24 bg-white dark:bg-dark border-t border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="relative rounded-3xl p-8 sm:p-12 md:p-16 overflow-hidden bg-gradient-to-br from-primary-900 via-primary-950 to-slate-950 text-white shadow-2xl shadow-primary-900/20 border border-primary-500/30 text-center" data-aos="zoom-in">
            <!-- Decorative Emblem Background -->
            <div class="absolute right-0 bottom-0 translate-x-1/4 translate-y-1/4 w-80 h-80 opacity-[0.06] pointer-events-none">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-full h-full object-contain">
            </div>
            
            <div class="absolute -top-24 -left-24 w-72 h-72 bg-primary-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-teal-400/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl mx-auto">
                <?php if ( ! empty( $cta_badge ) ) : ?>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-widest bg-white/10 backdrop-blur-md border border-white/20 text-teal-300 mb-6">
                        <span class="w-2 h-2 rounded-full bg-teal-400 animate-ping"></span>
                        <?php echo esc_html( $cta_badge ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( ! empty( $cta_title ) ) : ?>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight mb-5">
                        <?php echo esc_html( $cta_title ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( ! empty( $cta_desc ) ) : ?>
                    <p class="text-slate-300 text-sm sm:text-base md:text-lg leading-relaxed mb-8 max-w-2xl mx-auto font-normal">
                        <?php echo esc_html( $cta_desc ); ?>
                    </p>
                <?php endif; ?>

                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="<?php echo esc_url( $cta_btn1_url ); ?>" 
                       target="_blank" rel="noopener noreferrer"
                       class="btn-primary text-sm sm:text-base px-8 py-4 rounded-xl shadow-lg shadow-primary-500/25 inline-flex items-center gap-2.5 font-bold hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <span><?php echo esc_html( $cta_btn1_text ); ?></span>
                    </a>
                    <a href="<?php echo esc_url( $cta_btn2_url ); ?>" 
                       class="btn-secondary text-sm sm:text-base px-8 py-4 rounded-xl border border-white/20 bg-white/10 hover:bg-white/20 text-white inline-flex items-center gap-2 font-bold backdrop-blur-sm transition-all hover:scale-105">
                        <span><?php echo esc_html( $cta_btn2_text ); ?></span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
