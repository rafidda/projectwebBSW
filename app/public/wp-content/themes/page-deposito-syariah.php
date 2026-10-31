<?php
/**
 * Template Name: Deposito Syariah
 * Description: Halaman Produk Deposito Mudharabah BPRS Wakalumi dengan tabel nisbah terhubung, kalkulator live estimasi rate, dan palet Ocean Teal resmi.
 *
 * @package Wakalumi
 */

get_header();

// ── AMBIL DATA DARI WP_OPTIONS DENGAN FALLBACK LENGKAP ────────────
$dep_page_badge    = get_option( 'options_deposito_page_badge', 'Investasi Syariah Berkah' );
$dep_page_title    = get_option( 'options_deposito_page_title', 'Deposito Mudharabah BPRS Wakalumi' );
$dep_page_sub      = get_option( 'options_deposito_page_subtitle', 'Pilihan tepat bagi Anda berinvestasi sekaligus beribadah. Investasi aman, menguntungkan, dan berkah dengan prinsip Mudharabah Muthlaqah.' );
$dep_quote         = get_option( 'options_deposito_quote', 'Merupakan investasi anda baik secara individu maupun perusahaan dalam bentuk deposito yang sesuai dengan prinsip syariah yakni Mudharabah Muthlaqah, pilihan tepat bagi anda berinvestasi sekaligus juga ibadah.' );

// LPS Badge Box
$dep_lps_tag       = get_option( 'options_deposito_lps_tag', 'Penjaminan Resmi LPS & OJK' );
$dep_lps_title     = get_option( 'options_deposito_lps_title', 'Dijamin LPS s.d. Rp 2 Miliar' );
$dep_lps_desc      = get_option( 'options_deposito_lps_desc', 'Dana simpanan deposito Anda aman dan dijamin oleh Lembaga Penjamin Simpanan (LPS) sesuai ketentuan batas maksimal penjaminan.' );
$dep_lps_btn       = get_option( 'options_deposito_lps_btn_text', 'Hitung Simulasi Bagi Hasil' );

// Tenor Section & Repeater Kartu Tenor Dinamis
$dep_tenor_kicker  = get_option( 'options_deposito_tenor_kicker', 'Fleksibilitas Investasi' );
$dep_tenor_title   = get_option( 'options_deposito_tenor_title', 'Pilihan Tenor Fleksibel Sesuai Kebutuhan' );
$dep_tenor_desc    = get_option( 'options_deposito_tenor_desc', 'Pilih jangka waktu penempatan yang paling cocok untuk rencana likuiditas pribadi maupun perusahaan.' );
$dep_tenor_cards   = function_exists( 'wakalumi_get_deposito_tenor_cards' ) ? wakalumi_get_deposito_tenor_cards() : [];
$dep_main_image    = get_option( 'options_deposito_main_image', '' );
if ( empty( $dep_main_image ) && ! empty( $dep_tenor_cards ) && is_array( $dep_tenor_cards ) ) {
    foreach ( $dep_tenor_cards as $dc_item ) {
        if ( ! empty( $dc_item['image'] ) ) {
            $dep_main_image = $dc_item['image'];
            break;
        }
    }
}
$dep_akad_label    = get_option( 'options_deposito_akad', 'Mudharabah Muthlaqah' );
$dep_min_label     = get_option( 'options_deposito_min_penempatan', 'Rp 5.000.000' );

$dep_t1_badge      = get_option( 'options_deposito_t1_badge', 'Tenor Singkat' );
$dep_t1_desc       = get_option( 'options_deposito_t1_desc', 'Likuiditas cepat dan fleksibel untuk perputaran dana jangka sangat pendek.' );
$dep_t1_aro        = get_option( 'options_deposito_t1_aro', 'ARO Tersedia' );

$dep_t3_badge      = get_option( 'options_deposito_t3_badge', 'Tenor Menengah' );
$dep_t3_desc       = get_option( 'options_deposito_t3_desc', 'Kombinasi seimbang antara imbal hasil menarik dan durasi penempatan dana.' );
$dep_t3_aro        = get_option( 'options_deposito_t3_aro', 'ARO Tersedia' );

$dep_t6_badge      = get_option( 'options_deposito_t6_badge', 'Tenor Optimal' );
$dep_t6_desc       = get_option( 'options_deposito_t6_desc', 'Pilihan populer untuk alokasi dana semesteran dengan nisbah lebih menguntungkan.' );
$dep_t6_aro        = get_option( 'options_deposito_t6_aro', 'ARO Tersedia' );

$dep_t12_badge     = get_option( 'options_deposito_t12_badge', 'Tenor Panjang' );
$dep_t12_high      = get_option( 'options_deposito_t12_highlight', 'Hasil Tertinggi' );
$dep_t12_desc      = get_option( 'options_deposito_t12_desc', 'Pertumbuhan investasi maksimal dengan porsi nisbah bagi hasil paling optimal.' );
$dep_t12_aro       = get_option( 'options_deposito_t12_aro', 'ARO Tersedia' );

// Keunggulan Section
$dep_keung_kicker  = get_option( 'options_deposito_keunggulan_kicker', 'Nilai Tambah Investasi' );
$dep_keung_title   = get_option( 'options_deposito_keunggulan_title', 'Keunggulan Deposito Mudharabah BPRS Wakalumi' );
$dep_keung_badge   = get_option( 'options_deposito_keunggulan_badge', '6 Keistimewaan Produk' );
$dep_keunggulan    = get_option( 'options_deposito_keunggulan', "Prinsip murni Mudharabah Muthlaqah (bebas riba & gharar)\nNisbah bagi hasil kompetitif dan adil\nPilihan jangka waktu fleksibel (1, 3, 6, dan 12 bulan)\nFasilitas ARO (Automatic Roll Over) pokok atau pokok + bagi hasil\nDapat dijadikan agunan/jaminan pembiayaan syariah\nDijamin Lembaga Penjamin Simpanan (LPS) hingga Rp 2 Miliar" );

// Nisbah Section & Sharia Note
$dep_nisbah_kicker = get_option( 'options_deposito_nisbah_kicker', 'Transparansi Realisasi Bagi Hasil' );
$dep_nisbah_title  = get_option( 'options_deposito_nisbah_title', 'Tabel Nisbah & Indikasi Equivalent Rate' );
$dep_nisbah_desc   = get_option( 'options_deposito_nisbah_desc', 'Porsi pembagian keuntungan periode {bulan}, terkelola profesional dan diawasi Dewan Pengawas Syariah.' );
$dep_nisbah_row_desc = get_option( 'options_deposito_nisbah_row_desc', 'Bagi hasil dibagikan bulanan • ARO' );
$dep_sharia_title  = get_option( 'options_deposito_sharia_note_title', '*Catatan Penting Syariah (Karakteristik Estimasi Bagi Hasil):' );
$dep_sharia_desc   = get_option( 'options_deposito_sharia_note_desc', 'Porsi nisbah dan indikasi Equivalent Rate (Eqv. Rate) adalah estimasi indikatif berdasarkan realisasi kinerja penyaluran pembiayaan riil bisnis bank periode berjalan. Sesuai prinsip fatwa DSN-MUI (Mudharabah Muthlaqah), imbal hasil tidak dijanjikan secara pasti/tetap di muka (bebas riba), melainkan fluktuatif mengikuti pendapatan riil bank.' );

// Kalkulator Section
$dep_calc_badge       = get_option( 'options_deposito_calc_badge', 'Simulasi Finansial Syariah' );
$dep_calc_title       = get_option( 'options_deposito_calc_title', 'Kalkulator Simulasi Imbal Hasil Deposito' );
$dep_calc_desc        = get_option( 'options_deposito_calc_desc', 'Hitung estimasi bagi hasil bulanan dan total imbal hasil penempatan dana deposito syariah Anda secara instan, transparan, dan sesuai porsi nisbah terkini.' );
$dep_calc_input_label = get_option( 'options_deposito_calc_input_label', 'Nominal Penempatan Deposito' );
$dep_calc_min         = intval( get_option( 'options_deposito_calc_min', 500000 ) );
if ( $dep_calc_min <= 0 ) $dep_calc_min = 500000;
$dep_calc_max         = intval( get_option( 'options_deposito_calc_max', 2000000000 ) );
if ( $dep_calc_max <= 0 || $dep_calc_max == 500000000 ) $dep_calc_max = 2000000000;
$dep_calc_max_note    = get_option( 'options_deposito_calc_max_note', 'Ketik untuk nominal penempatan lebih dari 2 Miliar' );
$dep_calc_default     = intval( get_option( 'options_deposito_calc_default', 50000000 ) );
if ( $dep_calc_default < $dep_calc_min ) $dep_calc_default = $dep_calc_min;
$dep_calc_note        = get_option( 'options_deposito_calc_note', '*Simulasi indikatif sebelum pajak. Bagi hasil riil fluktuatif mengikuti pendapatan bulanan bank.' );

// Persyaratan & Dokumen
$dep_syarat_kicker = get_option( 'options_deposito_syarat_kicker', 'Persyaratan Pembukaan' );
$dep_syarat_title  = get_option( 'options_deposito_syarat_title', 'Dokumen & Ketentuan Pembukaan Deposito' );
$dep_syarat_desc   = get_option( 'options_deposito_syarat_desc', 'Pilih kategori kepemilikan rekening untuk melihat daftar persyaratan dokumen resmi.' );
$dep_tab1_label    = get_option( 'options_deposito_tab1_label', 'Nasabah Perorangan (Individu)' );
$dep_tab1_badge    = get_option( 'options_deposito_tab1_badge', 'WNI & WNA' );
$dep_syarat_ind    = get_option( 'options_deposito_syarat_individu', "Mengisi formulir permohonan pembukaan bilyet Deposito Mudharabah\nFotokopi e-KTP / Paspor pemohon yang masih berlaku\nFotokopi NPWP pemohon\nMemiliki rekening tabungan di BPRS Wakalumi sebagai rekening penampung bagi hasil\nNominal penempatan minimal Rp 5.000.000" );
$dep_syarat_ind_note = get_option( 'options_deposito_syarat_ind_note', 'Formulir resmi pembukaan bilyet deposito dapat dibantu pengisiannya langsung oleh Customer Service kami.' );
$dep_tab2_label    = get_option( 'options_deposito_tab2_label', 'Perusahaan / Badan Usaha / Yayasan' );
$dep_tab2_badge    = get_option( 'options_deposito_tab2_badge', 'PT / CV / Yayasan / Koperasi' );
$dep_syarat_lem    = get_option( 'options_deposito_syarat_lembaga', "Mengisi formulir pembukaan rekening Deposito Lembaga / Perusahaan\nFotokopi Akta Pendirian Perusahaan & Perubahan Anggaran Dasar Terakhir\nFotokopi NIB (Nomor Induk Berusaha) / SIUP & TDP\nFotokopi NPWP Perusahaan / Yayasan\nFotokopi e-KTP Pengurus / Direksi yang berwenang menandatangani bilyet\nSurat Kuasa Direksi (jika dikuasakan)\nNominal penempatan minimal Rp 10.000.000" );
$dep_syarat_lem_note = get_option( 'options_deposito_syarat_lem_note', 'Persyaratan khusus institusi syariah & penempatan nominal besar dapat dikonsultasikan langsung via tim Treasury.' );

// CTA & Brosur
$dep_cta_kicker    = get_option( 'options_deposito_cta_kicker', 'Konsultasi Penempatan Deposito' );
$dep_cta_title     = get_option( 'options_deposito_cta_title', 'Siap Mengoptimalkan Pertumbuhan Investasi Berkah Anda?' );
$dep_cta_desc      = get_option( 'options_deposito_cta_desc', 'Hubungi staf treasury dan customer service kami untuk mendapatkan penawaran porsi nisbah terbaik bagi dana simpanan perorangan maupun korporasi.' );
$dep_cta_btn       = get_option( 'options_deposito_cta_btn_text', 'Hubungi via WhatsApp' );
$dep_cta_wa_msg    = get_option( 'options_deposito_cta_wa_msg', 'Halo BPRS Wakalumi, saya ingin berkonsultasi mengenai penempatan dana Deposito Mudharabah.' );
$brosur_url        = get_option( 'options_brosur_file_url', '' );
$dep_brosur_url    = get_option( 'options_deposito_brosur_url', '' );
if ( empty( $dep_brosur_url ) ) {
    $dep_brosur_url = ! empty( $brosur_url ) ? $brosur_url : home_url( '/brosur/' );
}

// WhatsApp Hotline
$default_wa        = get_option( 'options_contact_wa', '6281517380388' );
$wa_number         = get_option( 'options_produk_wa_number', $default_wa );
$clean_wa          = preg_replace( '/[^0-9]/', '', $wa_number );

// Helper to convert lines to array
if ( ! function_exists( 'wakalumi_dep_lines' ) ) {
    function wakalumi_dep_lines( $text ) {
        $lines = explode( "\n", str_replace( "\r", "", $text ) );
        return array_filter( array_map( 'trim', $lines ) );
    }
}

$dep_keunggulan_arr = wakalumi_dep_lines( $dep_keunggulan );
$dep_syarat_ind_arr = wakalumi_dep_lines( $dep_syarat_ind );
$dep_syarat_lem_arr = wakalumi_dep_lines( $dep_syarat_lem );

// ── AMBIL DATA NISBAH BAGI HASIL TERPUSAT (SINGLE SOURCE OF TRUTH) ─
$nisbah_data      = function_exists( 'wakalumi_get_nisbah_data' ) ? wakalumi_get_nisbah_data() : get_option( 'options_nisbah_data', [] );
$dep_nisbah_bulan = function_exists( 'wakalumi_get_nisbah_bulan' ) ? wakalumi_get_nisbah_bulan() : get_option( 'options_nisbah_bulan', 'Agustus 2026' );
$dep_rates        = function_exists( 'wakalumi_get_deposito_rates' ) ? wakalumi_get_deposito_rates() : [
    1  => [ 'nama' => 'Deposito 1 Bulan',  'nasabah' => '30', 'bank' => '70', 'equiv' => '2.99%', 'rate_val' => 2.99 ],
    3  => [ 'nama' => 'Deposito 3 Bulan',  'nasabah' => '35', 'bank' => '65', 'equiv' => '3.48%', 'rate_val' => 3.48 ],
    6  => [ 'nama' => 'Deposito 6 Bulan',  'nasabah' => '40', 'bank' => '60', 'equiv' => '3.98%', 'rate_val' => 3.98 ],
    12 => [ 'nama' => 'Deposito 12 Bulan', 'nasabah' => '42.5', 'bank' => '57.5', 'equiv' => '4.23%', 'rate_val' => 4.23 ],
];

$dep_nisbah_desc_rendered = str_replace( 
    '{bulan}', 
    '<strong class="text-teal-700 dark:text-teal-300 font-bold">' . esc_html( $dep_nisbah_bulan ) . '</strong>', 
    esc_html( $dep_nisbah_desc ) 
);

$deposito_nisbah = [];
if ( ! empty( $nisbah_data ) && is_array( $nisbah_data ) ) {
    foreach ( $nisbah_data as $row ) {
        if ( isset( $row['nisbah_jenis'] ) && $row['nisbah_jenis'] === 'deposito' ) {
            $deposito_nisbah[] = $row;
        }
    }
}
if ( empty( $deposito_nisbah ) ) {
    $deposito_nisbah = [
        [ 'nisbah_produk' => 'Deposito 1 Bulan',  'nisbah_nasabah' => $dep_rates[1]['nasabah'],  'nisbah_bank' => $dep_rates[1]['bank'],  'nisbah_equiv' => $dep_rates[1]['equiv'] ],
        [ 'nisbah_produk' => 'Deposito 3 Bulan',  'nisbah_nasabah' => $dep_rates[3]['nasabah'],  'nisbah_bank' => $dep_rates[3]['bank'],  'nisbah_equiv' => $dep_rates[3]['equiv'] ],
        [ 'nisbah_produk' => 'Deposito 6 Bulan',  'nisbah_nasabah' => $dep_rates[6]['nasabah'],  'nisbah_bank' => $dep_rates[6]['bank'],  'nisbah_equiv' => $dep_rates[6]['equiv'] ],
        [ 'nisbah_produk' => 'Deposito 12 Bulan', 'nisbah_nasabah' => $dep_rates[12]['nasabah'], 'nisbah_bank' => $dep_rates[12]['bank'], 'nisbah_equiv' => $dep_rates[12]['equiv'] ],
    ];
}
?>

<!-- ========================================
     HEADER BANNER & BREADCRUMBS
     ======================================== -->
<section class="wkl-page-hero">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-72 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

    <div class="container-wide relative z-10">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-300 transition-colors flex items-center gap-1.5 font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-slate-500 dark:text-slate-400 font-medium">Produk</span>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-teal-700 dark:text-teal-300 font-semibold">Deposito Syariah</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-50 dark:bg-teal-950/70 border border-teal-200/80 dark:border-teal-800/80 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                    <?php echo esc_html( $dep_page_badge ); ?>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                    <?php echo esc_html( $dep_page_title ); ?>
                </h1>
                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                    <?php echo esc_html( $dep_page_sub ); ?>
                </p>

                <!-- Quote Box Resmi (Dual-Tone Minimalist Card) -->
                <div class="group/quote relative overflow-hidden rounded-2xl bg-white/90 dark:bg-slate-900/90 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md hover:border-teal-300/80 dark:hover:border-teal-700/70 transition-all duration-500">
                    <div class="px-4 sm:px-5 py-2.5 bg-gradient-to-r from-teal-50/80 via-slate-50/70 to-transparent dark:from-teal-950/40 dark:via-slate-800/50 dark:to-transparent border-b border-slate-100 dark:border-slate-800/80 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-teal-800 dark:text-teal-300">Prinsip Akad Mudharabah Muthlaqah</span>
                    </div>
                    <div class="p-4 sm:p-5 text-xs sm:text-sm text-slate-600 dark:text-slate-300 italic leading-relaxed">
                        <?php echo esc_html( $dep_quote ); ?>
                    </div>
                </div>
            </div>

            <!-- LPS & Security Badge (4 Kolom) - Dual-Tone Executive Card -->
            <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="100">
                <div class="spotlight-card relative overflow-hidden rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-lg hover:shadow-xl hover:-translate-y-1.5 transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] text-center group cursor-default">
                    <div class="wkl-glass-shine"></div>

                    <!-- Top Dual-Tone Zone -->
                    <div class="relative px-6 pt-7 pb-5 bg-gradient-to-b from-teal-50/85 via-sky-50/40 to-white dark:from-teal-950/45 dark:via-slate-900/80 dark:to-slate-900 border-b border-slate-100 dark:border-slate-800/80 overflow-hidden">
                        <!-- Subtle Top Accent Line -->
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 via-sky-400 to-emerald-500 opacity-85"></div>

                        <!-- Interactive Slide Watermark Emblem -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-32 h-32 opacity-[0.04] dark:opacity-[0.03] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-110 group-hover:opacity-[0.07] dark:group-hover:opacity-[0.05] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>

                        <!-- Shield Icon with Soft Dual-Tone Ring -->
                        <div class="relative w-14 h-14 rounded-2xl bg-white dark:bg-slate-800 border border-teal-200/80 dark:border-teal-800/70 text-teal-600 dark:text-teal-300 flex items-center justify-center mx-auto mb-3.5 shadow-sm group-hover:bg-teal-600 group-hover:text-white group-hover:border-teal-600 group-hover:scale-105 transition-all duration-500 z-10">
                            <svg class="w-7 h-7 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/90 dark:bg-slate-800 text-teal-700 dark:text-teal-300 border border-teal-200/70 dark:border-teal-800/60 text-[10px] font-bold uppercase tracking-wider mb-1.5 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                <?php echo esc_html( $dep_lps_tag ); ?>
                            </div>
                            <h4 class="text-lg font-extrabold text-slate-900 dark:text-white"><?php echo esc_html( $dep_lps_title ); ?></h4>
                        </div>
                    </div>

                    <!-- Bottom Dual-Tone Zone -->
                    <div class="p-5 sm:px-6 bg-white dark:bg-slate-900/95 space-y-4 relative z-10">
                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                            <?php echo esc_html( $dep_lps_desc ); ?>
                        </p>

                        <div class="pt-1">
                            <a href="#simulasi" class="w-full py-2.5 px-4 rounded-xl bg-slate-50 hover:bg-teal-50/80 dark:bg-slate-800/80 dark:hover:bg-teal-950/50 border border-slate-200/80 hover:border-teal-300 dark:border-slate-700/80 dark:hover:border-teal-700 inline-flex items-center justify-center gap-2 text-xs font-bold text-teal-700 dark:text-teal-300 transition-all duration-300 group/lpsbtn">
                                <span><?php echo esc_html( $dep_lps_btn ); ?></span>
                                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/lpsbtn:translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 1: PILIHAN TENOR & FITUR UTAMA
     ======================================== -->
<section id="tenor" class="scroll-mt-28 py-14 lg:py-20 bg-transparent relative overflow-hidden">
    <div class="container-wide relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-wider text-teal-800 dark:text-teal-300 bg-teal-50 dark:bg-teal-950/60 px-3.5 py-1.5 rounded-full border border-teal-200/80 dark:border-teal-800/80 shadow-sm">
                <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <?php echo esc_html( $dep_tenor_kicker ); ?>
            </span>
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white mt-3 mb-2 tracking-tight">
                <?php echo esc_html( $dep_tenor_title ); ?>
            </h3>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                <?php echo esc_html( $dep_tenor_desc ); ?>
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16" data-aos="fade-up">
            <?php 
            // Palet Dual-Tone Lembut & Profesional (Tidak Gonjreng) untuk tiap kartu tenor
            $tenor_palettes = [
                0 => [
                    'card_border' => 'border-slate-200/85 dark:border-slate-800 hover:border-sky-300 dark:hover:border-sky-700/80',
                    'card_shadow' => 'shadow-sm hover:shadow-xl hover:shadow-sky-500/8',
                    'top_bg'      => 'bg-gradient-to-br from-sky-50/85 via-slate-50/50 to-white dark:from-sky-950/35 dark:via-slate-900 dark:to-slate-900 border-b border-sky-100/80 dark:border-sky-900/40',
                    'top_bar'     => 'from-sky-400 to-teal-400',
                    'icon_box'    => 'bg-white dark:bg-slate-800 border-sky-200/80 dark:border-sky-800/60 text-sky-600 dark:text-sky-300 group-hover:bg-sky-600 group-hover:text-white group-hover:border-sky-600',
                    'badge_text'  => 'text-sky-700 dark:text-sky-300',
                    'title_hover' => 'group-hover:text-sky-700 dark:group-hover:text-sky-300',
                    'rate_box'    => 'bg-gradient-to-br from-sky-50/75 to-slate-50/80 dark:from-sky-950/35 dark:to-slate-800/70 border-sky-200/60 dark:border-sky-800/50 group-hover:border-sky-300 dark:group-hover:border-sky-700',
                    'rate_label'  => 'text-sky-700 dark:text-sky-300',
                    'rate_val'    => 'text-slate-900 dark:text-white group-hover:text-sky-800 dark:group-hover:text-sky-200',
                    'cta_text'    => 'text-sky-700 dark:text-sky-300',
                    'cta_Arrow'   => 'bg-sky-50 dark:bg-sky-950/60 text-sky-600 dark:text-sky-300 group-hover:bg-sky-600 group-hover:text-white',
                ],
                1 => [
                    'card_border' => 'border-slate-200/85 dark:border-slate-800 hover:border-teal-300 dark:hover:border-teal-700/80',
                    'card_shadow' => 'shadow-sm hover:shadow-xl hover:shadow-teal-500/8',
                    'top_bg'      => 'bg-gradient-to-br from-teal-50/85 via-slate-50/50 to-white dark:from-teal-950/35 dark:via-slate-900 dark:to-slate-900 border-b border-teal-100/80 dark:border-teal-900/40',
                    'top_bar'     => 'from-teal-500 to-cyan-400',
                    'icon_box'    => 'bg-white dark:bg-slate-800 border-teal-200/80 dark:border-teal-800/60 text-teal-600 dark:text-teal-300 group-hover:bg-teal-600 group-hover:text-white group-hover:border-teal-600',
                    'badge_text'  => 'text-teal-700 dark:text-teal-300',
                    'title_hover' => 'group-hover:text-teal-700 dark:group-hover:text-teal-300',
                    'rate_box'    => 'bg-gradient-to-br from-teal-50/75 to-slate-50/80 dark:from-teal-950/35 dark:to-slate-800/70 border-teal-200/60 dark:border-teal-800/50 group-hover:border-teal-300 dark:group-hover:border-teal-700',
                    'rate_label'  => 'text-teal-700 dark:text-teal-300',
                    'rate_val'    => 'text-slate-900 dark:text-white group-hover:text-teal-800 dark:group-hover:text-teal-200',
                    'cta_text'    => 'text-teal-700 dark:text-teal-300',
                    'cta_Arrow'   => 'bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-300 group-hover:bg-teal-600 group-hover:text-white',
                ],
                2 => [
                    'card_border' => 'border-slate-200/85 dark:border-slate-800 hover:border-emerald-300 dark:hover:border-emerald-700/80',
                    'card_shadow' => 'shadow-sm hover:shadow-xl hover:shadow-emerald-500/8',
                    'top_bg'      => 'bg-gradient-to-br from-emerald-50/85 via-slate-50/50 to-white dark:from-emerald-950/35 dark:via-slate-900 dark:to-slate-900 border-b border-emerald-100/80 dark:border-emerald-900/40',
                    'top_bar'     => 'from-emerald-500 to-teal-400',
                    'icon_box'    => 'bg-white dark:bg-slate-800 border-emerald-200/80 dark:border-emerald-800/60 text-emerald-600 dark:text-emerald-300 group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-600',
                    'badge_text'  => 'text-emerald-700 dark:text-emerald-300',
                    'title_hover' => 'group-hover:text-emerald-700 dark:group-hover:text-emerald-300',
                    'rate_box'    => 'bg-gradient-to-br from-emerald-50/75 to-slate-50/80 dark:from-emerald-950/35 dark:to-slate-800/70 border-emerald-200/60 dark:border-emerald-800/50 group-hover:border-emerald-300 dark:group-hover:border-emerald-700',
                    'rate_label'  => 'text-emerald-700 dark:text-emerald-300',
                    'rate_val'    => 'text-slate-900 dark:text-white group-hover:text-emerald-800 dark:group-hover:text-emerald-200',
                    'cta_text'    => 'text-emerald-700 dark:text-emerald-300',
                    'cta_Arrow'   => 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-300 group-hover:bg-emerald-600 group-hover:text-white',
                ],
                3 => [
                    'card_border' => 'border-teal-300/90 dark:border-teal-700/80 hover:border-teal-500 dark:hover:border-teal-500',
                    'card_shadow' => 'shadow-md hover:shadow-xl hover:shadow-teal-500/12',
                    'top_bg'      => 'bg-gradient-to-br from-teal-50/95 via-amber-50/45 to-white dark:from-teal-950/50 dark:via-amber-950/20 dark:to-slate-900 border-b border-teal-200/70 dark:border-teal-800/50',
                    'top_bar'     => 'from-teal-600 via-teal-500 to-amber-400',
                    'icon_box'    => 'bg-white dark:bg-slate-800 border-amber-200/90 dark:border-amber-700/60 text-amber-600 dark:text-amber-300 group-hover:bg-teal-600 group-hover:text-white group-hover:border-teal-600',
                    'badge_text'  => 'text-teal-800 dark:text-teal-300',
                    'title_hover' => 'group-hover:text-teal-700 dark:group-hover:text-teal-300',
                    'rate_box'    => 'bg-gradient-to-br from-teal-50/90 via-amber-50/35 to-white dark:from-teal-950/45 dark:via-slate-800/80 dark:to-slate-800 border-teal-200/80 dark:border-teal-700/60 group-hover:border-teal-400',
                    'rate_label'  => 'text-teal-800 dark:text-teal-300',
                    'rate_val'    => 'text-teal-900 dark:text-teal-100',
                    'cta_text'    => 'text-teal-700 dark:text-teal-300',
                    'cta_Arrow'   => 'bg-teal-100/80 dark:bg-teal-900/70 text-teal-700 dark:text-teal-200 group-hover:bg-teal-600 group-hover:text-white',
                ],
            ];

            foreach ( $dep_tenor_cards as $c_idx => $card ) : 
                $t_num      = intval( $card['tenor_num'] ?? ( $c_idx + 1 ) );
                $is_pop     = ! empty( $card['is_popular'] );
                $c_badge    = ! empty( $card['badge'] ) ? $card['badge'] : 'Deposito Syariah';
                $c_high     = ! empty( $card['highlight'] ) ? $card['highlight'] : '';
                $c_aro      = ! empty( $card['aro'] ) ? $card['aro'] : 'ARO Tersedia';
                $c_equiv    = ! empty( $card['equiv'] ) ? $card['equiv'] : ( $dep_rates[ $t_num ]['equiv'] ?? ( $dep_rates[12]['equiv'] ?? '4.23%' ) );
                $pal        = $is_pop ? $tenor_palettes[3] : ( $tenor_palettes[ $c_idx % 4 ] ?? $tenor_palettes[1] );
            ?>
            <div id="tenor-<?php echo esc_attr( $t_num ); ?>" class="hub-product-card scroll-mt-28 relative rounded-3xl bg-white dark:bg-slate-900 border <?php echo esc_attr( $pal['card_border'] . ' ' . $pal['card_shadow'] ); ?> hover:-translate-y-1.5 transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] overflow-hidden group cursor-pointer flex flex-col justify-between" onclick="window.wklSelectTenor && window.wklSelectTenor(<?php echo esc_attr( $t_num ); ?>)">
                
                <!-- Subtle Glass Glare Sweep -->
                <div class="wkl-glass-shine"></div>

                <!-- Top Gradient Accent Line -->
                <div class="h-1 w-full bg-gradient-to-r <?php echo esc_attr( $pal['top_bar'] ); ?> opacity-75 group-hover:opacity-100 transition-opacity duration-500"></div>

                <!-- Sliding Watermark -->
                <div class="absolute right-0 bottom-4 translate-x-[22%] w-28 h-28 opacity-[0.035] dark:opacity-[0.025] pointer-events-none transition-all duration-700 ease-out group-hover:scale-110 group-hover:-translate-x-2 group-hover:opacity-[0.07] dark:group-hover:opacity-[0.05] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                </div>

                <!-- ZONE 1: Dual-Tone Header Band -->
                <div class="relative px-6 pt-5 pb-4 <?php echo esc_attr( $pal['top_bg'] ); ?> transition-colors duration-500">
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <span class="text-[11px] font-bold uppercase tracking-wider <?php echo esc_attr( $pal['badge_text'] ); ?> block">
                            <?php echo esc_html( $c_badge ); ?>
                        </span>
                        <?php if ( ! empty( $c_high ) ) : ?>
                            <span class="px-2.5 py-0.5 rounded-full bg-amber-50/90 dark:bg-amber-950/70 text-amber-800 dark:text-amber-300 border border-amber-200/80 dark:border-amber-800/70 text-[10px] font-extrabold uppercase tracking-wider shadow-2xs">
                                <?php echo esc_html( $c_high ); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <h4 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white <?php echo esc_attr( $pal['title_hover'] ); ?> transition-colors duration-300">
                            <?php echo esc_html( $card['tenor'] ); ?>
                        </h4>
                        <div class="w-10 h-10 rounded-2xl border <?php echo esc_attr( $pal['icon_box'] ); ?> flex items-center justify-center flex-shrink-0 shadow-2xs group-hover:scale-105 group-hover:-rotate-3 transition-all duration-500">
                            <?php if ( $is_pop ) : ?>
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>
                            <?php else : ?>
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- ZONE 2: Clean Body & Soft Dual-Tone Rate Box -->
                <div class="p-6 pt-4 flex flex-col justify-between flex-1 relative z-10 bg-white dark:bg-slate-900">
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-5">
                        <?php echo esc_html( $card['desc'] ); ?>
                    </p>

                    <div class="space-y-3 mt-auto">
                        <div class="py-2.5 px-3.5 rounded-2xl border <?php echo esc_attr( $pal['rate_box'] ); ?> flex items-center justify-between transition-all duration-300">
                            <div class="text-left">
                                <span class="text-[10px] font-bold uppercase tracking-wider <?php echo esc_attr( $pal['rate_label'] ); ?> block">Indikasi Eqv. Rate</span>
                                <span class="text-[10px] text-slate-400 dark:text-slate-500 block">*Estimasi bagi hasil</span>
                            </div>
                            <div class="text-right">
                                <span class="text-lg sm:text-xl font-black <?php echo esc_attr( $pal['rate_val'] ); ?> transition-colors"><?php echo esc_html( $c_equiv ); ?></span>
                                <span class="text-[10px] font-bold text-slate-400 block">p.a.</span>
                            </div>
                        </div>

                        <div class="pt-2 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-xs">
                            <span class="inline-flex items-center gap-1.5 font-semibold text-slate-500 dark:text-slate-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <?php echo esc_html( $c_aro ); ?>
                            </span>
                            <span class="<?php echo esc_attr( $pal['cta_text'] ); ?> font-bold inline-flex items-center gap-1.5">
                                <span>Simulasi</span>
                                <span class="w-6 h-6 rounded-full <?php echo esc_attr( $pal['cta_Arrow'] ); ?> inline-flex items-center justify-center transition-all duration-300 group-hover:translate-x-0.5">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- 6 Keunggulan List Card (Dual-Tone Architecture) + 1 Foto Perwakilan Produk Deposito -->
        <div class="spotlight-card relative overflow-hidden rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-[0_12px_36px_-12px_rgba(15,23,42,0.08)] hover:shadow-[0_20px_48px_-12px_rgba(13,148,136,0.14)] transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] group" data-aos="fade-up">
            <!-- Sliding Watermark -->
            <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-48 h-48 opacity-[0.03] dark:opacity-[0.025] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.06] dark:group-hover:opacity-[0.05] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
            </div>

            <!-- Dual-Tone Top Header Bar -->
            <div class="relative z-10 bg-gradient-to-r from-teal-50/90 via-cyan-50/50 to-slate-50/90 dark:from-teal-950/45 dark:via-slate-800/80 dark:to-slate-900/90 border-b border-teal-100/80 dark:border-slate-800 px-6 sm:px-8 py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 border border-teal-200/80 dark:border-teal-800/70 text-teal-600 dark:text-teal-300 flex items-center justify-center flex-shrink-0 shadow-sm group-hover:bg-teal-600 group-hover:text-white group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </div>
                    <div>
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-extrabold uppercase tracking-wider text-teal-700 dark:text-teal-400 mb-0.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500 animate-pulse"></span>
                            <?php echo esc_html( $dep_keung_kicker ); ?>
                        </span>
                        <h4 class="text-base sm:text-lg lg:text-xl font-extrabold text-slate-900 dark:text-white transition-colors duration-300 group-hover:text-teal-700 dark:group-hover:text-teal-300">
                            <?php echo esc_html( $dep_keung_title ); ?>
                        </h4>
                    </div>
                </div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/95 dark:bg-slate-900/90 border border-teal-200/80 dark:border-teal-800/70 text-teal-700 dark:text-teal-300 text-xs font-extrabold shadow-sm w-fit">
                    <span class="w-4 h-4 rounded-full bg-teal-50 dark:bg-teal-900/70 flex items-center justify-center text-teal-600 dark:text-teal-300">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    </span>
                    <span><?php echo esc_html( $dep_keung_badge ); ?></span>
                </div>
            </div>

            <!-- Dual-Tone Bottom Body Grid -->
            <div class="relative z-10 p-6 sm:p-8 bg-white dark:bg-slate-900">
                <?php 
                // Palet aksen lembut bergantian untuk item keunggulan (tidak gonjreng)
                $keung_tones = array(
                    array(
                        'card_bg'    => 'bg-gradient-to-br from-slate-50/90 via-white to-teal-50/35 dark:from-slate-800/70 dark:via-slate-900 dark:to-teal-950/20',
                        'border'     => 'border-slate-200/80 dark:border-slate-700/70 hover:border-teal-300 dark:hover:border-teal-700',
                        'badge_idle' => 'bg-teal-50 dark:bg-teal-900/60 text-teal-700 dark:text-teal-300 border border-teal-200/70 dark:border-teal-800/60',
                        'badge_hov'  => 'group-hover/item:bg-teal-600 group-hover/item:text-white group-hover/item:border-teal-600',
                    ),
                    array(
                        'card_bg'    => 'bg-gradient-to-br from-slate-50/90 via-white to-sky-50/35 dark:from-slate-800/70 dark:via-slate-900 dark:to-sky-950/20',
                        'border'     => 'border-slate-200/80 dark:border-slate-700/70 hover:border-sky-300 dark:hover:border-sky-700',
                        'badge_idle' => 'bg-sky-50 dark:bg-sky-900/60 text-sky-700 dark:text-sky-300 border border-sky-200/70 dark:border-sky-800/60',
                        'badge_hov'  => 'group-hover/item:bg-sky-600 group-hover/item:text-white group-hover/item:border-sky-600',
                    ),
                    array(
                        'card_bg'    => 'bg-gradient-to-br from-slate-50/90 via-white to-emerald-50/35 dark:from-slate-800/70 dark:via-slate-900 dark:to-emerald-950/20',
                        'border'     => 'border-slate-200/80 dark:border-slate-700/70 hover:border-emerald-300 dark:hover:border-emerald-700',
                        'badge_idle' => 'bg-emerald-50 dark:bg-emerald-900/60 text-emerald-700 dark:text-emerald-300 border border-emerald-200/70 dark:border-emerald-800/60',
                        'badge_hov'  => 'group-hover/item:bg-emerald-600 group-hover/item:text-white group-hover/item:border-emerald-600',
                    ),
                );
                ?>
                <?php if ( ! empty( $dep_main_image ) ) : ?>
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center">
                        <!-- Kolom Kiri (5 Cols): 1 Foto Perwakilan Produk Deposito -->
                        <div class="lg:col-span-5">
                            <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden bg-slate-100 dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 shadow-md group/depimg">
                                <img src="<?php echo esc_url( $dep_main_image ); ?>" alt="<?php echo esc_attr( $dep_page_title ); ?>" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover/depimg:scale-105" loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/65 via-slate-950/15 to-transparent opacity-70 group-hover/depimg:opacity-80 transition-opacity duration-500"></div>
                                <div class="wkl-glass-shine"></div>
                                <div class="absolute top-3 left-3 right-3 flex items-center justify-between gap-2 z-10">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-white/95 dark:bg-slate-900/90 text-slate-800 dark:text-slate-100 border border-slate-200/90 dark:border-slate-700 text-[10px] font-bold shadow-sm backdrop-blur-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                        Akad: <?php echo esc_html( $dep_akad_label ); ?>
                                    </span>
                                    <span class="inline-block px-2.5 py-1 rounded-full bg-teal-600/95 text-white text-[10px] font-bold shadow-sm backdrop-blur-md">
                                        Min. <?php echo esc_html( $dep_min_label ); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Kolom Kanan (7 Cols): Poin Keunggulan -->
                        <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            <?php 
                            $k_num = 1;
                            foreach ( $dep_keunggulan_arr as $k_idx => $item ) : 
                                $kt = $keung_tones[ $k_idx % count( $keung_tones ) ];
                            ?>
                                <div class="group/item flex items-start gap-3.5 p-3.5 rounded-2xl <?php echo esc_attr( $kt['card_bg'] . ' ' . $kt['border'] ); ?> border hover:-translate-y-1 hover:shadow-md transition-all duration-400 ease-[cubic-bezier(0.22,1,0.36,1)] cursor-default">
                                    <div class="w-8 h-8 rounded-xl <?php echo esc_attr( $kt['badge_idle'] . ' ' . $kt['badge_hov'] ); ?> flex items-center justify-center flex-shrink-0 mt-0.5 group-hover/item:scale-110 group-hover/item:rotate-3 transition-all duration-400 shadow-sm">
                                        <span class="text-[11px] font-black"><?php echo sprintf( '%02d', $k_num++ ); ?></span>
                                    </div>
                                    <span class="text-xs sm:text-sm text-slate-700 dark:text-slate-200 font-medium leading-relaxed group-hover/item:text-slate-900 dark:group-hover/item:text-white transition-colors">
                                        <?php echo esc_html( $item ); ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php 
                        $k_num = 1;
                        foreach ( $dep_keunggulan_arr as $k_idx => $item ) : 
                            $kt = $keung_tones[ $k_idx % count( $keung_tones ) ];
                        ?>
                            <div class="group/item flex items-start gap-3.5 p-4 rounded-2xl <?php echo esc_attr( $kt['card_bg'] . ' ' . $kt['border'] ); ?> border hover:-translate-y-1 hover:shadow-md transition-all duration-400 ease-[cubic-bezier(0.22,1,0.36,1)] cursor-default">
                                <div class="w-8 h-8 rounded-xl <?php echo esc_attr( $kt['badge_idle'] . ' ' . $kt['badge_hov'] ); ?> flex items-center justify-center flex-shrink-0 mt-0.5 group-hover/item:scale-110 group-hover/item:rotate-3 transition-all duration-400 shadow-sm">
                                    <span class="text-[11px] font-black"><?php echo sprintf( '%02d', $k_num++ ); ?></span>
                                </div>
                                <span class="text-xs sm:text-sm text-slate-700 dark:text-slate-200 font-medium leading-relaxed group-hover/item:text-slate-900 dark:group-hover/item:text-white transition-colors">
                                    <?php echo esc_html( $item ); ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 2: TABEL NISBAH DINAMIS
     ======================================== -->
<section class="py-14 lg:py-20 bg-slate-50/80 dark:bg-dark-surface/60 border-y border-slate-200/80 dark:border-slate-800/80 relative">
    <div class="container-wide relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-50 dark:bg-teal-950/70 border border-teal-200/80 dark:border-teal-800/80 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-3 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                <?php echo esc_html( $dep_nisbah_kicker ); ?>
            </div>
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white mt-2 mb-2 tracking-tight">
                <?php echo esc_html( $dep_nisbah_title ); ?>
            </h3>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400">
                <?php echo $dep_nisbah_desc_rendered; ?>
            </p>
        </div>

        <div class="wkl-nisbah-table-wrap max-w-5xl mx-auto overflow-hidden rounded-3xl border border-slate-200/90 dark:border-slate-700/80 shadow-[0_14px_40px_-12px_rgba(15,23,42,0.1)] bg-white dark:bg-slate-900 relative" data-aos="fade-up">
            <!-- Background Subtle Watermark -->
            <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-12 w-64 h-64 opacity-[0.03] dark:opacity-[0.025] pointer-events-none">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain">
            </div>

            <div class="overflow-x-auto relative z-10">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-900 via-teal-950 to-slate-900 text-white border-b border-slate-800">
                            <th class="p-4 sm:p-5 font-bold text-xs uppercase tracking-wider text-slate-200">Jangka Waktu</th>
                            <th class="p-4 sm:p-5 font-bold text-xs uppercase tracking-wider text-slate-200 hidden md:table-cell">Akad &amp; Pengelolaan</th>
                            <th class="p-4 sm:p-5 font-bold text-xs uppercase tracking-wider text-teal-300">Porsi Nisbah (Nasabah : Bank)</th>
                            <th class="p-4 sm:p-5 font-bold text-xs uppercase tracking-wider text-amber-300">Indikasi Eqv. Rate (*Estimasi)</th>
                            <th class="p-4 sm:p-5 font-bold text-xs uppercase tracking-wider text-center text-slate-200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">
                        <?php foreach ( $deposito_nisbah as $r_idx => $row ) : 
                            $p_name      = $row['nisbah_produk'] ?? 'Deposito';
                            $nasabah_p   = floatval( $row['nisbah_nasabah'] ?? '40' );
                            $bank_p      = floatval( $row['nisbah_bank'] ?? '60' );
                            $nasabah_dec = ( floor( $nasabah_p ) != $nasabah_p ) ? 1 : 0;
                            $bank_dec    = ( floor( $bank_p ) != $bank_p ) ? 1 : 0;
                            $equiv_raw   = $row['nisbah_equiv'] ?? '-';
                            // Ekstrak float value untuk animasi counter
                            $equiv_clean = preg_replace( '/[^0-9.]/', '', $equiv_raw );
                            $equiv_val   = floatval( $equiv_clean );

                            $tenor_num = 12;
                            if ( preg_match( '/(\d+)\s*(?:bln|bulan|thn|tahun)/i', $p_name, $m_tenor ) ) {
                                $tenor_num = intval( $m_tenor[1] );
                                if ( strpos( strtolower( $p_name ), 'thn' ) !== false || strpos( strtolower( $p_name ), 'tahun' ) !== false ) {
                                    $tenor_num = $tenor_num * 12;
                                }
                            } elseif ( strpos( strtolower( $p_name ), '1 bulan' ) !== false ) $tenor_num = 1;
                            elseif ( strpos( strtolower( $p_name ), '3 bulan' ) !== false ) $tenor_num = 3;
                            elseif ( strpos( strtolower( $p_name ), '6 bulan' ) !== false ) $tenor_num = 6;
                        ?>
                            <tr class="hover:bg-gradient-to-r hover:from-teal-50/50 hover:via-cyan-50/25 hover:to-transparent dark:hover:from-teal-950/30 dark:hover:to-slate-800/40 transition-all duration-300 group">
                                <td class="p-4 sm:p-5 font-bold text-slate-900 dark:text-white">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-teal-50/90 dark:bg-teal-900/60 border border-teal-200/80 dark:border-teal-800/60 text-teal-600 dark:text-teal-300 flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:bg-teal-100 dark:group-hover:bg-teal-900/90 group-hover:text-teal-700 dark:group-hover:text-teal-200 group-hover:border-teal-300 dark:group-hover:border-teal-700 transition-all duration-300 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                                        </div>
                                        <div>
                                            <span class="text-sm sm:text-base font-extrabold block group-hover:text-teal-700 dark:group-hover:text-teal-300 transition-colors"><?php echo esc_html( $p_name ); ?></span>
                                            <span class="text-[11px] text-slate-400 font-medium md:hidden block">Mudharabah Muthlaqah</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 sm:p-5 hidden md:table-cell">
                                    <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block">Mudharabah Muthlaqah</span>
                                    <span class="text-[11px] text-slate-500 dark:text-slate-400 block"><?php echo esc_html( $dep_nisbah_row_desc ); ?></span>
                                </td>
                                <td class="p-4 sm:p-5">
                                    <div class="space-y-1.5 max-w-[210px]">
                                        <div class="flex justify-between items-center text-xs font-bold">
                                            <span class="text-teal-700 dark:text-teal-300">Nasabah: <span class="wkl-counter" data-target="<?php echo esc_attr( $nasabah_p ); ?>" data-decimals="<?php echo esc_attr( $nasabah_dec ); ?>" data-suffix="%"><?php echo esc_html( $nasabah_p ); ?>%</span></span>
                                            <span class="text-blue-600 dark:text-blue-400">Bank: <span class="wkl-counter" data-target="<?php echo esc_attr( $bank_p ); ?>" data-decimals="<?php echo esc_attr( $bank_dec ); ?>" data-suffix="%"><?php echo esc_html( $bank_p ); ?>%</span></span>
                                        </div>
                                        <!-- Visual Segmented Bar (Animated Width on Scroll) -->
                                        <div class="h-2 w-full rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden flex p-0.5 gap-0.5">
                                            <div class="wkl-ratio-bar h-full bg-gradient-to-r from-teal-500 to-emerald-400 rounded-l-full transition-all duration-1000 ease-out" style="width: 0%;" data-width="<?php echo esc_attr( $nasabah_p ); ?>%"></div>
                                            <div class="wkl-ratio-bar-bank h-full bg-gradient-to-r from-blue-600 to-sky-500 dark:from-blue-500 dark:to-sky-400 rounded-r-full transition-all duration-1000 ease-out" style="width: 0%;" data-width="<?php echo esc_attr( $bank_p ); ?>%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 sm:p-5">
                                    <div class="inline-flex items-baseline gap-1 px-2.5 py-1 rounded-xl bg-teal-50/80 dark:bg-teal-950/50 border border-teal-200/60 dark:border-teal-800/60 text-teal-700 dark:text-teal-300 font-black text-base sm:text-lg">
                                        <?php if ( $equiv_val > 0 ) : ?>
                                             <span class="wkl-counter" data-target="<?php echo esc_attr( $equiv_val ); ?>" data-decimals="2" data-suffix="%">0.00%</span>
                                        <?php else : ?>
                                            <?php echo esc_html( $equiv_raw ); ?>
                                        <?php endif; ?>
                                        <span class="text-[10px] font-bold text-slate-400 dark:text-slate-400">p.a.</span>
                                    </div>
                                </td>
                                <td class="p-4 sm:p-5 text-center">
                                    <button type="button" class="group/simbtn px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-teal-600 text-slate-700 hover:text-white dark:bg-slate-800 dark:hover:bg-teal-600 dark:text-slate-200 dark:hover:text-white border border-slate-200/80 dark:border-slate-700 hover:border-teal-600 text-xs font-bold transition-all duration-300 inline-flex items-center gap-1.5 shadow-sm hover:shadow-md" onclick="window.wklSelectTenor && window.wklSelectTenor(<?php echo esc_attr( $tenor_num ); ?>)">
                                        <span>Simulasi</span>
                                        <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/simbtn:translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sharia Disclaimer Callout (Dual-Tone Banner) -->
        <div class="max-w-5xl mx-auto mt-5 rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-teal-200/70 dark:border-teal-800/60 shadow-sm flex flex-col sm:flex-row items-stretch text-xs text-slate-600 dark:text-slate-300 leading-relaxed" data-aos="fade-up">
            <div class="bg-gradient-to-br from-teal-50 via-cyan-50/70 to-teal-100/50 dark:from-teal-950/70 dark:to-slate-800 px-4 py-3 sm:py-4 border-b sm:border-b-0 sm:border-r border-teal-200/60 dark:border-teal-800/60 flex items-center gap-2.5 sm:w-56 flex-shrink-0">
                <div class="w-7 h-7 rounded-xl bg-teal-600 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                </div>
                <strong class="text-teal-950 dark:text-teal-200 font-extrabold text-xs leading-snug"><?php echo esc_html( $dep_sharia_title ); ?></strong>
            </div>
            <div class="p-4 flex items-center">
                <span><?php echo esc_html( $dep_sharia_desc ); ?></span>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 3: KALKULATOR SIMULASI DEPOSITO
     ======================================== -->
<section id="simulasi" class="scroll-mt-24 py-14 lg:py-20 bg-transparent relative">
    <span id="nisbah" class="relative -top-24"></span>
    <div class="container-wide">
        <div class="max-w-4xl mx-auto p-6 sm:p-10 lg:p-12 rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-teal-950 text-white shadow-2xl relative overflow-hidden group" data-aos="fade-up">
            <!-- Ambient Glow & Subtle Watermark with Hover Animation -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl pointer-events-none"></div>
            
            <!-- Delicate Watermark Emblem with Hover Glow -->
            <div class="absolute -right-6 top-1/2 -translate-y-1/2 w-56 h-56 opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:scale-125 group-hover:opacity-[0.07] mix-blend-screen select-none overflow-hidden">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 invert">
            </div>

            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-500/20 text-teal-300 text-xs font-bold uppercase tracking-wider mb-3 border border-teal-500/30 shadow-sm">
                    <svg class="w-3.5 h-3.5 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 3h.008v.008H8.25v-.008zm0 3h.008v.008H8.25v-.008zm3-6h.008v.008H11.25v-.008zm0 3h.008v.008H11.25v-.008zm0 3h.008v.008H11.25v-.008zm3-6h.008v.008H14.25v-.008zm0 3h.008v.008H14.25v-.008zm3-3h.008v.008H17.25v-.008zm0 3h.008v.008H17.25v-.008zM4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                    <span><?php echo esc_html( $dep_calc_badge ); ?></span>
                </div>
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight mb-2 text-white">
                    <?php echo esc_html( $dep_calc_title ); ?>
                </h3>
                <p class="text-sm sm:text-base text-slate-300 mb-8 max-w-2xl leading-relaxed">
                    <?php echo esc_html( $dep_calc_desc ); ?>
                </p>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <!-- Form Input (7 Kolom) -->
                    <div class="lg:col-span-7 space-y-6">
                        <!-- Nominal Penempatan: Dual Input (Bisa Diketik Manual & Digeser) -->
                        <div>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                <label for="wkl-dep-nominal-input" class="text-xs font-bold uppercase tracking-wider text-slate-300">
                                    1. <?php echo esc_html( $dep_calc_input_label ); ?>
                                </label>
                                <div class="relative w-full sm:w-auto">
                                    <input 
                                        type="text" 
                                        id="wkl-dep-nominal-input" 
                                        value="Rp <?php echo number_format( $dep_calc_default, 0, ',', '.' ); ?>" 
                                        class="w-full sm:w-48 py-1.5 px-3 rounded-xl bg-slate-800/90 border border-teal-500/50 text-right font-black text-base sm:text-lg text-teal-300 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition-all shadow-inner"
                                        placeholder="Rp 5.000.000"
                                    >
                                </div>
                            </div>

                            <input 
                                type="range" 
                                id="wkl-dep-nominal-range" 
                                min="<?php echo esc_attr( $dep_calc_min ); ?>" 
                                max="<?php echo esc_attr( $dep_calc_max ); ?>" 
                                step="500000" 
                                value="<?php echo esc_attr( $dep_calc_default ); ?>" 
                                class="w-full h-2.5 bg-slate-700/80 rounded-lg appearance-none cursor-pointer accent-teal-400"
                            >

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between text-[11px] text-slate-400 mt-1.5 gap-1">
                                <span>Min simulasi: Rp <?php echo number_format( $dep_calc_min, 0, ',', '.' ); ?></span>
                                <span class="text-teal-300 font-medium"><?php echo esc_html( $dep_calc_max_note ); ?></span>
                            </div>

                            <!-- Preset Pills -->
                            <div class="flex flex-wrap gap-2 mt-3">
                                <button type="button" class="wkl-dep-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-teal-400 transition-colors" data-val="10000000">Rp 10 Jt</button>
                                <button type="button" class="wkl-dep-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-teal-500/60 text-xs font-bold text-teal-300 hover:border-teal-400 transition-colors" data-val="50000000">Rp 50 Jt</button>
                                <button type="button" class="wkl-dep-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-teal-400 transition-colors" data-val="100000000">Rp 100 Jt</button>
                                <button type="button" class="wkl-dep-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-teal-400 transition-colors" data-val="500000000">Rp 500 Jt</button>
                                <button type="button" class="wkl-dep-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-teal-400 transition-colors" data-val="1000000000">Rp 1 M</button>
                                <button type="button" class="wkl-dep-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-teal-400 transition-colors" data-val="2000000000">Rp 2 M</button>
                            </div>
                        </div>

                        <!-- Tenor Pilihan (Dynamic Rate dari Database) -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300">
                                    2. Jangka Waktu (Tenor)
                                </label>
                                <span id="wkl-dep-active-tenor-label" class="text-xs font-bold text-teal-300">
                                    12 Bulan (Eqv. <?php echo esc_html( $dep_rates[12]['equiv'] ); ?>)
                                </span>
                            </div>
                            <div class="grid grid-cols-4 gap-2">
                                <button type="button" class="wkl-dep-tenor-btn py-2.5 px-2 rounded-xl bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-teal-400 transition-all text-center" data-months="1" data-rate="<?php echo esc_attr( $dep_rates[1]['rate_val'] ); ?>" data-equiv="<?php echo esc_attr( $dep_rates[1]['equiv'] ); ?>">
                                    <span class="block font-black">1 Bln</span>
                                    <span class="text-[10px] text-slate-400 font-normal"><?php echo esc_html( $dep_rates[1]['equiv'] ); ?></span>
                                </button>
                                <button type="button" class="wkl-dep-tenor-btn py-2.5 px-2 rounded-xl bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-teal-400 transition-all text-center" data-months="3" data-rate="<?php echo esc_attr( $dep_rates[3]['rate_val'] ); ?>" data-equiv="<?php echo esc_attr( $dep_rates[3]['equiv'] ); ?>">
                                    <span class="block font-black">3 Bln</span>
                                    <span class="text-[10px] text-slate-400 font-normal"><?php echo esc_html( $dep_rates[3]['equiv'] ); ?></span>
                                </button>
                                <button type="button" class="wkl-dep-tenor-btn py-2.5 px-2 rounded-xl bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-teal-400 transition-all text-center" data-months="6" data-rate="<?php echo esc_attr( $dep_rates[6]['rate_val'] ); ?>" data-equiv="<?php echo esc_attr( $dep_rates[6]['equiv'] ); ?>">
                                    <span class="block font-black">6 Bln</span>
                                    <span class="text-[10px] text-slate-400 font-normal"><?php echo esc_html( $dep_rates[6]['equiv'] ); ?></span>
                                </button>
                                <button type="button" class="wkl-dep-tenor-btn active py-2.5 px-2 rounded-xl bg-teal-600 border border-teal-500 text-xs font-bold text-white shadow-md transition-all text-center" data-months="12" data-rate="<?php echo esc_attr( $dep_rates[12]['rate_val'] ); ?>" data-equiv="<?php echo esc_attr( $dep_rates[12]['equiv'] ); ?>">
                                    <span class="block font-black">12 Bln</span>
                                    <span class="text-[10px] text-teal-100 font-normal"><?php echo esc_html( $dep_rates[12]['equiv'] ); ?></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Output Box (5 Kolom) -->
                    <div class="lg:col-span-5 bg-slate-800/95 p-6 sm:p-7 rounded-2xl border border-teal-500/40 text-center relative shadow-inner">
                        <span class="text-xs text-slate-400 uppercase tracking-wider font-bold block mb-1">
                            Estimasi Bagi Hasil / Bulan
                        </span>
                        <div id="wkl-dep-result-monthly" class="text-3xl sm:text-4xl font-black text-teal-300 tracking-tight mb-2">
                            Rp 176.250
                        </div>
                        <div class="py-2.5 px-3 rounded-xl bg-slate-900/80 mb-5 flex justify-between items-center text-xs">
                            <span class="text-slate-400">Total Akumulasi Hasil:</span>
                            <span id="wkl-dep-result-total" class="font-black text-teal-200">Rp 2.115.000</span>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-700">
                            <a 
                                id="wkl-dep-wa-btn" 
                                data-phone="<?php echo esc_attr( $clean_wa ); ?>"
                                href="https://wa.me/<?php echo esc_attr( $clean_wa ); ?>?text=<?php echo urlencode( 'Halo BPRS Wakalumi, saya berminat menempatkan Deposito Mudharabah sebesar Rp ' . number_format( $dep_calc_default, 0, ',', '.' ) . ' dengan tenor 12 bulan. Mohon informasi syarat dan formulir pembukaannya.' ); ?>" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="relative overflow-hidden group/btn w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-400 hover:from-teal-400 hover:to-cyan-300 text-slate-950 font-black text-sm inline-flex items-center justify-center gap-2 shadow-lg transition-transform hover:scale-[1.02]"
                            >
                                <!-- Shimmer Light Sweep -->
                                <span class="absolute inset-0 w-1/2 h-full bg-white/30 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-[300%] transition-transform duration-1000 ease-out pointer-events-none"></span>

                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                </svg>
                                <span>Buka Deposito via WhatsApp</span>
                            </a>
                            <span class="text-[11px] text-slate-400 block">
                                <?php echo esc_html( $dep_calc_note ); ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 4: PERSYARATAN & ALUR PEMBUKAAN
     ======================================== -->
<section class="py-14 lg:py-20 bg-slate-50/80 dark:bg-dark-surface/60 border-t border-slate-200/60 dark:border-slate-800/60 relative">
    <div class="container-wide relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-wider text-teal-800 dark:text-teal-300 bg-teal-50 dark:bg-teal-950/60 px-3.5 py-1.5 rounded-full border border-teal-200/80 dark:border-teal-800/80 shadow-sm">
                <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                <?php echo esc_html( $dep_syarat_kicker ); ?>
            </span>
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white mt-3 mb-2 tracking-tight">
                <?php echo esc_html( $dep_syarat_title ); ?>
            </h3>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400">
                <?php echo esc_html( $dep_syarat_desc ); ?>
            </p>
        </div>

        <div class="max-w-3xl mx-auto" data-aos="fade-up">
            <!-- Tabs Switcher -->
            <div class="flex justify-center gap-3 mb-8">
                <button type="button" id="tab-btn-ind" class="px-6 py-2.5 rounded-full bg-teal-600 text-white font-bold text-xs sm:text-sm shadow-md transition-all inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                    <span><?php echo esc_html( $dep_tab1_label ); ?></span>
                </button>
                <button type="button" id="tab-btn-lem" class="px-6 py-2.5 rounded-full bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold text-xs sm:text-sm border border-slate-200 dark:border-slate-700 shadow-sm transition-all inline-flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-500 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg>
                    <span><?php echo esc_html( $dep_tab2_label ); ?></span>
                </button>
            </div>

            <!-- Content Individu (Dual-Tone Card with Top Header Band, Interactive List & Footer Band) -->
            <div id="content-ind" class="hub-product-card relative overflow-hidden rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-[0_14px_38px_-12px_rgba(15,23,42,0.08)] group transition-all duration-500">
                <!-- Sliding Watermark -->
                <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-40 h-40 opacity-[0.035] dark:opacity-[0.03] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.07] dark:group-hover:opacity-[0.05] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                </div>

                <!-- Dual-Tone Top Header Band -->
                <div class="relative z-10 px-6 sm:px-8 py-5 bg-gradient-to-r from-teal-50/90 via-cyan-50/50 to-slate-50/80 dark:from-teal-950/45 dark:via-slate-800/80 dark:to-slate-900 border-b border-teal-100/80 dark:border-slate-800 flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-800 border border-teal-200/80 dark:border-teal-800/70 text-teal-600 dark:text-teal-300 flex items-center justify-center shadow-sm group-hover:bg-teal-600 group-hover:text-white transition-all duration-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-teal-700 dark:text-teal-400 block">Dokumen Administrasi</span>
                            <h4 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white">
                                Persyaratan Deposito <?php echo esc_html( $dep_tab1_label ); ?>
                            </h4>
                        </div>
                    </div>
                    <span class="text-[11px] font-bold text-teal-700 dark:text-teal-300 bg-white/95 dark:bg-slate-800 px-3 py-1 rounded-full border border-teal-200/80 dark:border-teal-800/60 shadow-sm">
                        <?php echo esc_html( $dep_tab1_badge ); ?>
                    </span>
                </div>

                <!-- Dual-Tone Middle Body -->
                <div class="relative z-10 p-6 sm:p-8">
                    <ul class="space-y-3">
                        <?php foreach ( $dep_syarat_ind_arr as $syarat ) : ?>
                            <li class="group/item flex items-start gap-3.5 p-3.5 rounded-2xl bg-gradient-to-r from-slate-50/90 via-white to-teal-50/25 dark:from-slate-800/60 dark:via-slate-900 dark:to-teal-950/20 border border-slate-200/70 dark:border-slate-700/70 hover:border-teal-300 dark:hover:border-teal-700 hover:translate-x-1 hover:shadow-md transition-all duration-300 ease-out">
                                <div class="w-6 h-6 rounded-xl bg-teal-50 dark:bg-teal-900/60 border border-teal-200/70 dark:border-teal-800/60 text-teal-600 dark:text-teal-300 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover/item:scale-110 group-hover/item:bg-teal-600 group-hover/item:text-white group-hover/item:border-teal-600 transition-all duration-300 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                </div>
                                <span class="text-xs sm:text-sm text-slate-700 dark:text-slate-200 font-medium leading-relaxed group-hover/item:text-slate-900 dark:group-hover/item:text-white transition-colors">
                                    <?php echo esc_html( $syarat ); ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Dual-Tone Bottom Footer Band -->
                <div class="relative z-10 px-6 sm:px-8 py-4 bg-slate-50/90 dark:bg-slate-800/60 border-t border-slate-100 dark:border-slate-800 flex items-center gap-2.5 text-xs text-slate-600 dark:text-slate-400">
                    <span class="w-6 h-6 rounded-lg bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                    </span>
                    <span><?php echo esc_html( $dep_syarat_ind_note ); ?></span>
                </div>
            </div>

            <!-- Content Lembaga (Dual-Tone Card with Top Header Band, Interactive List & Footer Band) -->
            <div id="content-lem" class="hub-product-card relative overflow-hidden rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-[0_14px_38px_-12px_rgba(15,23,42,0.08)] group transition-all duration-500 hidden">
                <!-- Sliding Watermark -->
                <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-40 h-40 opacity-[0.035] dark:opacity-[0.03] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.07] dark:group-hover:opacity-[0.05] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                </div>

                <!-- Dual-Tone Top Header Band -->
                <div class="relative z-10 px-6 sm:px-8 py-5 bg-gradient-to-r from-sky-50/90 via-teal-50/50 to-slate-50/80 dark:from-sky-950/45 dark:via-slate-800/80 dark:to-slate-900 border-b border-sky-100/80 dark:border-slate-800 flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white dark:bg-slate-800 border border-sky-200/80 dark:border-sky-800/70 text-sky-600 dark:text-sky-300 flex items-center justify-center shadow-sm group-hover:bg-sky-600 group-hover:text-white transition-all duration-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-sky-700 dark:text-sky-400 block">Dokumen Korporasi &amp; Institusi</span>
                            <h4 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white">
                                Persyaratan Deposito <?php echo esc_html( $dep_tab2_label ); ?>
                            </h4>
                        </div>
                    </div>
                    <span class="text-[11px] font-bold text-sky-700 dark:text-sky-300 bg-white/95 dark:bg-slate-800 px-3 py-1 rounded-full border border-sky-200/80 dark:border-sky-800/60 shadow-sm">
                        <?php echo esc_html( $dep_tab2_badge ); ?>
                    </span>
                </div>

                <!-- Dual-Tone Middle Body -->
                <div class="relative z-10 p-6 sm:p-8">
                    <ul class="space-y-3">
                        <?php foreach ( $dep_syarat_lem_arr as $syarat ) : ?>
                            <li class="group/item flex items-start gap-3.5 p-3.5 rounded-2xl bg-gradient-to-r from-slate-50/90 via-white to-sky-50/25 dark:from-slate-800/60 dark:via-slate-900 dark:to-sky-950/20 border border-slate-200/70 dark:border-slate-700/70 hover:border-sky-300 dark:hover:border-sky-700 hover:translate-x-1 hover:shadow-md transition-all duration-300 ease-out">
                                <div class="w-6 h-6 rounded-xl bg-sky-50 dark:bg-sky-900/60 border border-sky-200/70 dark:border-sky-800/60 text-sky-600 dark:text-sky-300 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover/item:scale-110 group-hover/item:bg-sky-600 group-hover/item:text-white group-hover/item:border-sky-600 transition-all duration-300 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                </div>
                                <span class="text-xs sm:text-sm text-slate-700 dark:text-slate-200 font-medium leading-relaxed group-hover/item:text-slate-900 dark:group-hover/item:text-white transition-colors">
                                    <?php echo esc_html( $syarat ); ?>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Dual-Tone Bottom Footer Band -->
                <div class="relative z-10 px-6 sm:px-8 py-4 bg-slate-50/90 dark:bg-slate-800/60 border-t border-slate-100 dark:border-slate-800 flex items-center gap-2.5 text-xs text-slate-600 dark:text-slate-400">
                    <span class="w-6 h-6 rounded-lg bg-sky-50 dark:bg-sky-900/50 text-sky-600 dark:text-sky-400 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                    </span>
                    <span><?php echo esc_html( $dep_syarat_lem_note ); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 5: CTA BANNER & BROSUR
     ======================================== -->
<section class="py-14 lg:py-20 bg-transparent relative">
    <div class="container-wide">
        <div class="max-w-4xl mx-auto p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-slate-900 via-slate-900 to-teal-950 text-white text-center relative overflow-hidden shadow-2xl group" data-aos="fade-up">
            <!-- Background Watermark Emblem -->
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:scale-110 group-hover:opacity-[0.06] select-none">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-full h-full object-contain" loading="lazy">
            </div>

            <div class="relative z-10 max-w-2xl mx-auto">
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-wider text-teal-300 bg-teal-950/80 px-3.5 py-1.5 rounded-full border border-teal-800 mb-3">
                    <svg class="w-3.5 h-3.5 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
                    <?php echo esc_html( $dep_cta_kicker ); ?>
                </span>
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black mb-4 tracking-tight text-white">
                    <?php echo esc_html( $dep_cta_title ); ?>
                </h3>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed mb-8">
                    <?php echo esc_html( $dep_cta_desc ); ?>
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a 
                        href="https://wa.me/<?php echo esc_attr( $clean_wa ); ?>?text=<?php echo urlencode( $dep_cta_wa_msg ); ?>" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="relative overflow-hidden group/btn py-3.5 px-6 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-400 hover:from-teal-400 hover:to-cyan-300 text-slate-950 font-black text-sm inline-flex items-center gap-2 shadow-lg transition-transform hover:scale-105"
                    >
                        <!-- Shimmer Sweep -->
                        <span class="absolute inset-0 w-1/2 h-full bg-white/30 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-[300%] transition-transform duration-1000 ease-out pointer-events-none"></span>

                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span><?php echo esc_html( $dep_cta_btn ); ?></span>
                    </a>
                    <?php 
                    $is_dep_pdf = (bool) preg_match( '/\.pdf($|\?)/i', $dep_brosur_url );
                    ?>
                    <a 
                        href="<?php echo esc_url( $dep_brosur_url ); ?>" 
                        <?php if ( $is_dep_pdf ) : ?>download target="_blank" rel="noopener noreferrer"<?php endif; ?>
                        class="py-3.5 px-6 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-sm border border-slate-700 inline-flex items-center gap-2 transition-colors"
                    >
                        <svg class="w-4 h-4 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <span><?php echo $is_dep_pdf ? 'Unduh Brosur Produk (PDF)' : 'Lihat Brosur Produk'; ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     INTERACTIVE SIMULATOR & NISBAH JAVASCRIPT (SWUP COMPATIBLE)
     ======================================== -->
<script>
// Lightweight fallback caller (primary execution handled automatically by app.js on initial load and Swup navigation)
(function() {
    if (window.DepositoPage && typeof window.DepositoPage.init === 'function') {
        window.DepositoPage.init();
    } else if (typeof window.initDepositoPage === 'function') {
        window.initDepositoPage();
    }
})();
</script>

<?php
get_footer();
