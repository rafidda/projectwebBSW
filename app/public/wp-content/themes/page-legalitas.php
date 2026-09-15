<?php
/**
 * Template Name: Legalitas Perusahaan
 * Description: Halaman Kepatuhan Hukum, Perizinan Operasional, dan Akta Notaris Resmi BPRS Wakalumi
 *
 * @package Wakalumi
 */

get_header();

// ── AMBIL DATA PENGATURAN HALAMAN DARI WP_OPTIONS ─────────────────
$page_badge    = get_option( 'options_legal_page_badge', 'Transparansi & Kepatuhan Regulasi' );
$page_title    = get_option( 'options_legal_page_title', 'Legalitas & Landasan Hukum Resmi' );
$page_subtitle = get_option( 'options_legal_page_subtitle', 'Bukti legalitas pendirian, perizinan operasional perbankan syariah, registrasi perpajakan, dan kepatuhan regulasi PT Bank Perekonomian Rakyat Syariah Wakalumi.' );

$company_name  = get_option( 'options_legal_company_name', 'PT. Bank Perekonomian Rakyat Syariah Wakalumi' );
$founder       = get_option( 'options_legal_founder', 'Yayasan Wakalumi (Wakaf Karyawan dan Alumni Muslim Citibank)' );
$nib           = get_option( 'options_legal_nib', '129.200.032.0036' );
$npwp          = get_option( 'options_legal_npwp', '1.484.259.5-411.000' );
$npwz          = get_option( 'options_legal_npwz', 'B1 000 005 8 411 000' );

$sk_menkeu     = get_option( 'options_legal_sk_menkeu', 'Nomor Kep-016/KM.17/1995 Tanggal 16 Januari 1995' );
$sk_bi         = get_option( 'options_legal_sk_bi', 'Nomor 13/5/KEP.Dir/Pbs/2011 Tanggal 13 Juli 2011' );
$head_office   = get_option( 'options_legal_head_office', 'Komp. Ciputat Mutiara Center Blok B1, Jl. Dewi Sartika Ciputat - Tangerang Selatan' );
$phone         = get_option( 'options_legal_phone', '021-7401667 / 021-749084, 021-7442788' );

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
     HEADER BANNER & BREADCRUMBS
     ======================================== -->
<section class="relative z-10 pt-8 pb-14 md:pb-20 overflow-hidden bg-slate-50 dark:bg-dark-surface border-b border-slate-200/60 dark:border-slate-800/60">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-72 bg-gradient-to-b from-primary-500/10 via-teal-500/5 to-transparent blur-3xl pointer-events-none"></div>

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
            <span class="text-primary-600 dark:text-teal-400 font-bold">Legalitas Perusahaan</span>
        </nav>

        <div class="max-w-4xl" data-aos="fade-up">
            <!-- Kicker Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full mb-5 bg-primary-500/10 dark:bg-primary-400/10 border border-primary-500/20 dark:border-primary-400/20">
                <span class="w-2 h-2 rounded-full bg-primary-500 dark:bg-teal-400 animate-pulse"></span>
                <span class="text-xs font-bold uppercase tracking-wider text-primary-700 dark:text-teal-300">
                    <?php echo esc_html( $page_badge ); ?>
                </span>
            </div>

            <!-- Main Page Title -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-[1.15] mb-5">
                <?php echo esc_html( $page_title ); ?>
            </h1>

            <!-- Subtitle -->
            <?php if ( ! empty( $page_subtitle ) ) : ?>
                <p class="text-base sm:text-lg md:text-xl text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                    <?php echo esc_html( $page_subtitle ); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- ========================================
     SECTION 1: TIGA KARTU REGISTRASI FISKAL & BERUSAHA (NIB, NPWP, NPWZ)
     ======================================== -->
<section class="relative z-10 py-12 md:py-16 bg-white dark:bg-dark border-b border-slate-100 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-14" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300 border border-teal-100 dark:border-teal-800/30 mb-3">
                Nomor Registrasi Resmi
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Identitas Registrasi & Fiskal Perusahaan
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-2">
                Legalitas kepatuhan terhadap perizinan berusaha nasional, perpajakan negara, dan pengelolaan zakat syariah.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            <!-- Card 1: NIB -->
            <div class="spotlight-card tilt-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-md shadow-slate-100 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] hover:shadow-xl hover:shadow-teal-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between cursor-default" data-aos="fade-up" data-aos-delay="0">
                <!-- Dual-Tone Header Bar -->
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/90 border-b border-slate-100 dark:border-slate-700/80 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-primary-50 dark:bg-primary-950/40 border border-primary-200 dark:border-primary-800/40 flex items-center justify-center text-primary-600 dark:text-teal-300 shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase tracking-widest font-extrabold text-slate-400 dark:text-teal-300 block">Registrasi</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-white">Perizinan Berusaha</span>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-900/30 dark:text-teal-300 border border-teal-200 dark:border-teal-700/50">
                        Berizin Resmi
                    </span>
                </div>

                <!-- Card Body -->
                <div class="p-6 md:p-7 relative flex-grow flex flex-col justify-between overflow-hidden">
                    <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-36 h-36 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                    </div>

                    <div class="relative z-10">
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-3">Nomor Induk Berusaha (NIB)</h3>
                        
                        <!-- Copy Box NIB -->
                        <div class="flex items-center justify-between gap-2 p-3 sm:p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 mb-4 group/copy">
                            <span class="font-mono font-black text-sm sm:text-base md:text-lg text-primary-700 dark:text-teal-300 tracking-wider select-all truncate">
                                <?php echo esc_html( $nib ); ?>
                            </span>
                            <button type="button" 
                                    class="btn-copy-code shrink-0 px-2.5 py-1 rounded-lg bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-xs font-sans font-semibold text-slate-600 dark:text-white hover:text-teal-600 dark:hover:text-teal-300 hover:border-teal-400/50 shadow-sm flex items-center gap-1.5 transition-all duration-200 active:scale-95" 
                                    data-copy="<?php echo esc_attr( $nib ); ?>" 
                                    title="Salin NIB">
                                <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                </svg>
                                <span class="copy-label text-[11px]">Salin</span>
                            </button>
                        </div>

                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-100 leading-relaxed">
                            Diterbitkan oleh Lembaga Pengelola dan Penyelenggara OSS berbasis risiko (Kementerian Investasi / BKPM RI).
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/80 flex items-center gap-1.5 text-xs font-bold text-teal-600 dark:text-teal-400 relative z-10">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>Terverifikasi Valid & Terdaftar</span>
                    </div>
                </div>
            </div>

            <!-- Card 2: NPWP -->
            <div class="spotlight-card tilt-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-md shadow-slate-100 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] hover:shadow-xl hover:shadow-teal-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between cursor-default" data-aos="fade-up" data-aos-delay="100">
                <!-- Dual-Tone Header Bar -->
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/90 border-b border-slate-100 dark:border-slate-700/80 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 dark:bg-teal-950/40 border border-teal-200 dark:border-teal-800/40 flex items-center justify-center text-teal-600 dark:text-teal-300 shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase tracking-widest font-extrabold text-slate-400 dark:text-teal-300 block">Fiskal</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-white">Perpajakan Negara</span>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-primary-50 text-primary-700 dark:bg-primary-900/30 dark:text-teal-300 border border-primary-200 dark:border-primary-700/50">
                        Wajib Pajak Badan
                    </span>
                </div>

                <!-- Card Body -->
                <div class="p-6 md:p-7 relative flex-grow flex flex-col justify-between overflow-hidden">
                    <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-36 h-36 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                    </div>

                    <div class="relative z-10">
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-3">Nomor Pokok Wajib Pajak (NPWP)</h3>
                        
                        <!-- Copy Box NPWP -->
                        <div class="flex items-center justify-between gap-2 p-3 sm:p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 mb-4 group/copy">
                            <span class="font-mono font-black text-sm sm:text-base md:text-lg text-teal-700 dark:text-teal-300 tracking-wider select-all truncate">
                                <?php echo esc_html( $npwp ); ?>
                            </span>
                            <button type="button" 
                                    class="btn-copy-code shrink-0 px-2.5 py-1 rounded-lg bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-xs font-sans font-semibold text-slate-600 dark:text-white hover:text-teal-600 dark:hover:text-teal-400 hover:border-teal-400/50 shadow-sm flex items-center gap-1.5 transition-all duration-200 active:scale-95" 
                                    data-copy="<?php echo esc_attr( $npwp ); ?>" 
                                    title="Salin NPWP">
                                <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                </svg>
                                <span class="copy-label text-[11px]">Salin</span>
                            </button>
                        </div>

                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-100 leading-relaxed">
                            Terdaftar resmi pada Direktorat Jenderal Pajak Republik Indonesia sebagai entitas badan perbankan yang patuh fiskal.
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/80 flex items-center gap-1.5 text-xs font-bold text-teal-600 dark:text-teal-400 relative z-10">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>Kepatuhan Pajak Nasional</span>
                    </div>
                </div>
            </div>

            <!-- Card 3: NPWZ -->
            <div class="spotlight-card tilt-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-md shadow-slate-100 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] hover:shadow-xl hover:shadow-teal-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between cursor-default" data-aos="fade-up" data-aos-delay="200">
                <!-- Dual-Tone Header Bar -->
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/90 border-b border-slate-100 dark:border-slate-700/80 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 dark:bg-teal-950/40 border border-teal-200 dark:border-teal-800/40 flex items-center justify-center text-teal-600 dark:text-teal-300 shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase tracking-widest font-extrabold text-slate-400 dark:text-teal-300 block">Sosial Syariah</span>
                            <span class="text-xs font-bold text-slate-700 dark:text-white">Pengelolaan Zakat</span>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-teal-500/15 text-teal-700 dark:text-teal-300 border border-teal-500/30">
                        Kepatuhan Syariah
                    </span>
                </div>

                <!-- Card Body -->
                <div class="p-6 md:p-7 relative flex-grow flex flex-col justify-between overflow-hidden">
                    <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-36 h-36 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                    </div>

                    <div class="relative z-10">
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-3">Nomor Pokok Wajib Zakat (NPWZ)</h3>
                        
                        <!-- Copy Box NPWZ -->
                        <div class="flex items-center justify-between gap-2 p-3 sm:p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 mb-4 group/copy">
                            <span class="font-mono font-black text-sm sm:text-base md:text-lg text-teal-700 dark:text-teal-300 tracking-wider select-all truncate">
                                <?php echo esc_html( $npwz ); ?>
                            </span>
                            <button type="button" 
                                    class="btn-copy-code shrink-0 px-2.5 py-1 rounded-lg bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 text-xs font-sans font-semibold text-slate-600 dark:text-white hover:text-teal-600 dark:hover:text-teal-400 hover:border-teal-400/50 shadow-sm flex items-center gap-1.5 transition-all duration-200 active:scale-95" 
                                    data-copy="<?php echo esc_attr( $npwz ); ?>" 
                                    title="Salin NPWZ">
                                <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                </svg>
                                <span class="copy-label text-[11px]">Salin</span>
                            </button>
                        </div>

                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-100 leading-relaxed">
                            Terdaftar dalam kelembagaan kepatuhan zakat perusahaan perbankan syariah guna kemaslahatan sosial umat.
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/80 flex items-center gap-1.5 text-xs font-bold text-teal-600 dark:text-teal-400 relative z-10">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        <span>Zakat Terintegrasi & Amanah</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ========================================
     SECTION 2: LANDASAN IZIN USAHA PERBANKAN & REGULATOR
     ======================================== -->
<section class="relative z-10 py-16 md:py-24 bg-transparent border-b border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- Left: SK Menteri Keuangan & SK BI -->
            <div class="lg:col-span-6" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-primary-50 text-primary-700 dark:bg-primary-400/10 dark:text-teal-300 border border-primary-100 dark:border-primary-800/30 mb-4">
                    Landasan Operasional
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-snug mb-6">
                    Izin Usaha Perbankan Syariah Republik Indonesia
                </h2>
                <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed mb-8">
                    Operasional PT BPRS Wakalumi diselenggarakan berlandaskan izin resmi dari Otoritas Keuangan Pemerintah Republik Indonesia serta kepatuhan fatwa Dewan Syariah Nasional:
                </p>

                <div class="space-y-5">
                    <!-- SK Menkeu RI -->
                    <div class="spotlight-card tilt-card group relative overflow-hidden rounded-2xl p-5 bg-white/95 dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-md dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] flex items-start gap-4 hover:border-primary-500/40 hover:shadow-md transition-all cursor-default">
                        <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-32 h-32 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-950 text-primary-700 dark:text-teal-300 flex items-center justify-center shrink-0 mt-0.5 font-bold relative z-10 group-hover:scale-105 transition-transform">
                            SK
                        </div>
                        <div class="relative z-10">
                            <span class="text-[11px] uppercase tracking-widest font-extrabold text-slate-400 dark:text-teal-300 block">Kementerian Keuangan RI</span>
                            <h4 class="text-base font-bold text-slate-900 dark:text-white mt-0.5 mb-1">
                                <?php echo esc_html( $sk_menkeu ); ?>
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-100">
                                Izin Usaha Pendirian Bank Pembiayaan Rakyat Syariah (BPRS) berlandaskan Undang-Undang Perbankan Syariah.
                            </p>
                        </div>
                    </div>

                    <!-- SK Bank Indonesia -->
                    <div class="spotlight-card tilt-card group relative overflow-hidden rounded-2xl p-5 bg-white/95 dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-md dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] flex items-start gap-4 hover:border-teal-500/40 hover:shadow-md transition-all cursor-default">
                        <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-32 h-32 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-teal-100 dark:bg-teal-950 text-teal-700 dark:text-teal-300 flex items-center justify-center shrink-0 mt-0.5 font-bold relative z-10 group-hover:scale-105 transition-transform">
                            BI
                        </div>
                        <div class="relative z-10">
                            <span class="text-[11px] uppercase tracking-widest font-extrabold text-slate-400 dark:text-teal-300 block">Bank Indonesia</span>
                            <h4 class="text-base font-bold text-slate-900 dark:text-white mt-0.5 mb-1">
                                <?php echo esc_html( $sk_bi ); ?>
                            </h4>
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-100">
                                Surat Keputusan Bank Indonesia terkait penyesuaian anggaran dasar dan kelembagaan BPR Syariah.
                            </p>
                        </div>
                    </div>
                </div>
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
                        <span class="text-xs uppercase tracking-widest font-bold text-teal-300 block mb-2">Perlindungan & Keamanan Nasabah</span>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-white mb-6">
                            Diawasi OJK & Dijamin LPS
                        </h3>

                        <div class="space-y-6">
                            <!-- OJK -->
                            <div class="flex items-start gap-4 group/item">
                                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-teal-300 shrink-0 font-bold group-hover/item:scale-110 transition-transform">
                                    01
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-white mb-1">Otoritas Jasa Keuangan (OJK)</h4>
                                    <p class="text-sm text-slate-300 leading-relaxed">
                                        PT BPRS Wakalumi terdaftar resmi dan diawasi ketat oleh OJK sesuai kaidah kehati-hatian perbankan (prudential banking).
                                    </p>
                                </div>
                            </div>

                            <!-- LPS -->
                            <div class="flex items-start gap-4 group/item">
                                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-teal-300 shrink-0 font-bold group-hover/item:scale-110 transition-transform">
                                    02
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-white mb-1">Lembaga Penjamin Simpanan (LPS)</h4>
                                    <p class="text-sm text-slate-300 leading-relaxed">
                                        Simpanan dana nasabah (tabungan & deposito syariah) dijamin oleh LPS sampai dengan <strong>Rp 2 Miliar per nasabah per bank</strong>.
                                    </p>
                                </div>
                            </div>

                            <!-- DPS & DSN-MUI -->
                            <div class="flex items-start gap-4 group/item">
                                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-emerald-300 shrink-0 font-bold group-hover/item:scale-110 transition-transform">
                                    03
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-white mb-1">Dewan Pengawas Syariah (DPS)</h4>
                                    <p class="text-sm text-slate-300 leading-relaxed">
                                        Seluruh akad pembiayaan, produk penghimpunan dana, dan operasional perbankan diawasi kepatuhannya berpedoman pada fatwa DSN-MUI.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ========================================
     SECTION 3: LINIMASA REKAM JEJAK AKTA NOTARIS
     ======================================== -->
<section class="relative z-10 py-16 md:py-24 bg-white dark:bg-dark">
    <div class="container-wide">
        <div class="text-center max-w-3xl mx-auto mb-14 md:mb-18" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300 border border-teal-100 dark:border-teal-800/30 mb-3">
                Kronologi Yuridis
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Rekam Jejak Akta Notaris & Perubahan Anggaran Dasar
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                Dokumentasi yuridis perjalanan kelembagaan PT BPRS Wakalumi dari pendirian tahun 1989 hingga pembaruan anggaran dasar terkini.
            </p>
        </div>

        <!-- Timeline Grid / Cards -->
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

        <!-- Info Card: Kantor Pusat & Entitas Pendiri -->
        <div class="spotlight-card tilt-card group relative overflow-hidden mt-14 p-8 rounded-3xl bg-slate-50 dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-md dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] flex flex-col md:flex-row items-start md:items-center justify-between gap-6 cursor-default" data-aos="fade-up">
            <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
            <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-44 h-44 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
            </div>
            <div class="relative z-10">
                <span class="text-xs uppercase tracking-widest font-extrabold text-primary-600 dark:text-teal-300 block mb-1">Entitas Korporasi</span>
                <h4 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2">
                    <?php echo esc_html( $company_name ); ?>
                </h4>
                <p class="text-sm text-slate-600 dark:text-slate-100 leading-relaxed max-w-2xl">
                    Didirikan oleh: <strong class="text-slate-800 dark:text-white"><?php echo esc_html( $founder ); ?></strong>.<br/>
                    Alamat Kantor Pusat: <?php echo esc_html( $head_office ); ?>.
                </p>
            </div>
            <div class="shrink-0 flex items-center gap-3 relative z-10">
                <a href="<?php echo esc_url( home_url( '/kontak' ) ); ?>" class="btn-primary text-xs sm:text-sm px-6 py-3 rounded-xl inline-flex items-center gap-2">
                    <span>Peta & Kontak Kantor</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

    </div>
</section>


<!-- ========================================
     SECTION 4: AJAKAN BERTINDAK (CALL TO ACTION)
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
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-widest bg-white/10 backdrop-blur-md border border-white/20 text-teal-300 mb-6">
                    <span class="w-2 h-2 rounded-full bg-teal-400 animate-ping"></span>
                    Transparansi & Kemitraan
                </div>

                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight mb-5">
                    <?php echo esc_html( $cta_title ); ?>
                </h2>

                <p class="text-slate-300 text-sm sm:text-base md:text-lg leading-relaxed mb-8 max-w-2xl mx-auto font-normal">
                    <?php echo esc_html( $cta_desc ); ?>
                </p>

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

