<?php
/**
 * Template Name: Deposito Syariah
 * Description: Halaman Produk Deposito Mudharabah BPRS Wakalumi dengan tabel nisbah dinamis & simulasi imbal hasil.
 *
 * @package Wakalumi
 */

get_header();

// ── AMBIL DATA DARI WP_OPTIONS DENGAN FALLBACK LENGKAP ────────────
$dep_page_badge    = get_option( 'options_deposito_page_badge', 'Investasi Syariah Berkah' );
$dep_page_title    = get_option( 'options_deposito_page_title', 'Deposito Mudharabah BPRS Wakalumi' );
$dep_page_sub      = get_option( 'options_deposito_page_subtitle', 'Pilihan tepat bagi Anda berinvestasi sekaligus beribadah. Investasi aman, menguntungkan, dan berkah dengan prinsip Mudharabah Muthlaqah.' );
$dep_quote         = get_option( 'options_deposito_quote', 'Merupakan investasi anda baik secara individu maupun perusahaan dalam bentuk deposito yang sesuai dengan prinsip syariah yakni Mudharabah Muthlaqah, pilihan tepat bagi anda berinvestasi sekaligus juga ibadah.' );

$dep_akad          = get_option( 'options_deposito_akad', 'Mudharabah Muthlaqah' );
$dep_min           = get_option( 'options_deposito_min_penempatan', 'Rp 5.000.000' );
$dep_tenor         = get_option( 'options_deposito_tenor_list', '1 Bulan, 3 Bulan, 6 Bulan, 12 Bulan' );
$dep_keunggulan    = get_option( 'options_deposito_keunggulan', "Prinsip murni Mudharabah Muthlaqah (bebas riba & gharar)\nNisbah bagi hasil kompetitif dan adil\nPilihan jangka waktu fleksibel (1, 3, 6, dan 12 bulan)\nFasilitas ARO (Automatic Roll Over) pokok atau pokok + bagi hasil\nDapat dijadikan agunan/jaminan pembiayaan syariah\nDijamin Lembaga Penjamin Simpanan (LPS) hingga Rp 2 Miliar" );
$dep_syarat_ind    = get_option( 'options_deposito_syarat_individu', "Mengisi formulir permohonan pembukaan bilyet Deposito Mudharabah\nFotokopi e-KTP / Paspor pemohon yang masih berlaku\nFotokopi NPWP pemohon\nMemiliki rekening tabungan di BPRS Wakalumi sebagai rekening penampung bagi hasil\nNominal penempatan minimal Rp 5.000.000" );
$dep_syarat_lem    = get_option( 'options_deposito_syarat_lembaga', "Mengisi formulir pembukaan rekening Deposito Lembaga / Perusahaan\nFotokopi Akta Pendirian Perusahaan & Perubahan Anggaran Dasar Terakhir\nFotokopi NIB (Nomor Induk Berusaha) / SIUP & TDP\nFotokopi NPWP Perusahaan / Yayasan\nFotokopi e-KTP Pengurus / Direksi yang berwenang menandatangani bilyet\nSurat Kuasa Direksi (jika dikuasakan)\nNominal penempatan minimal Rp 10.000.000" );

// WhatsApp Hotline
$default_wa        = get_option( 'options_contact_wa', '6281517380388' );
$wa_number         = get_option( 'options_produk_wa_number', $default_wa );
$clean_wa          = preg_replace( '/[^0-9]/', '', $wa_number );

// Brosur File
$brosur_url        = get_option( 'options_brosur_file_url', '' );

// Helper to convert lines to array
function wakalumi_dep_lines( $text ) {
    $lines = explode( "\n", str_replace( "\r", "", $text ) );
    return array_filter( array_map( 'trim', $lines ) );
}

$dep_keunggulan_arr = wakalumi_dep_lines( $dep_keunggulan );
$dep_syarat_ind_arr = wakalumi_dep_lines( $dep_syarat_ind );
$dep_syarat_lem_arr = wakalumi_dep_lines( $dep_syarat_lem );

// ── AMBIL TABEL NISBAH DARI DATABASE ──────────────────────────────
$nisbah_list = get_option( 'options_nisbah_list', [] );
$deposito_nisbah = [];

if ( ! empty( $nisbah_list ) && is_array( $nisbah_list ) ) {
    foreach ( $nisbah_list as $row ) {
        if ( isset( $row['nisbah_jenis'] ) && $row['nisbah_jenis'] === 'deposito' ) {
            $deposito_nisbah[] = $row;
        }
    }
}

// Fallback jika belum ada data deposito di options_nisbah_list
if ( empty( $deposito_nisbah ) ) {
    $deposito_nisbah = [
        [ 'nisbah_produk' => 'Deposito 1 Bulan',  'nisbah_nasabah' => '35', 'nisbah_bank' => '65', 'nisbah_equiv' => '3.50%' ],
        [ 'nisbah_produk' => 'Deposito 3 Bulan',  'nisbah_nasabah' => '40', 'nisbah_bank' => '60', 'nisbah_equiv' => '4.25%' ],
        [ 'nisbah_produk' => 'Deposito 6 Bulan',  'nisbah_nasabah' => '45', 'nisbah_bank' => '55', 'nisbah_equiv' => '5.00%' ],
        [ 'nisbah_produk' => 'Deposito 12 Bulan', 'nisbah_nasabah' => '50', 'nisbah_bank' => '50', 'nisbah_equiv' => '5.75%' ],
    ];
}
?>

<!-- ========================================
     HEADER BANNER & BREADCRUMBS
     ======================================== -->
<section class="relative z-10 pt-8 pb-12 md:pb-16 overflow-hidden bg-slate-50 dark:bg-dark-surface border-b border-slate-200/60 dark:border-slate-800/60">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-72 bg-gradient-to-b from-emerald-500/10 via-teal-500/5 to-transparent blur-3xl pointer-events-none"></div>

    <div class="container-wide relative z-10">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-accent transition-colors flex items-center gap-1.5 font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-slate-500 dark:text-slate-400 font-medium">Produk</span>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-emerald-600 dark:text-emerald-400 font-semibold">Deposito Syariah</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100/80 dark:bg-emerald-950/60 border border-emerald-300/60 dark:border-emerald-700/50 text-emerald-800 dark:text-emerald-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <?php echo esc_html( $dep_page_badge ); ?>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                    <?php echo esc_html( $dep_page_title ); ?>
                </h1>
                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                    <?php echo esc_html( $dep_page_sub ); ?>
                </p>

                <!-- Quote Box Resmi -->
                <div class="p-4 sm:p-5 rounded-2xl bg-white/80 dark:bg-slate-800/80 border-l-4 border-emerald-500 border border-slate-200/80 dark:border-slate-700 shadow-sm text-xs sm:text-sm text-slate-700 dark:text-slate-300 italic leading-relaxed">
                    <?php echo esc_html( $dep_quote ); ?>
                </div>
            </div>

            <!-- LPS & Security Badge (4 Kolom) -->
            <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="100">
                <div class="p-6 rounded-3xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-lg text-center space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-50 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mx-auto shadow-sm">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block">Jaminan Perlindungan</span>
                        <h4 class="text-lg font-black text-slate-900 dark:text-white">Dijamin LPS s.d. Rp 2 Miliar</h4>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                        Dana deposito Anda dijamin oleh Lembaga Penjamin Simpanan (LPS) per nasabah per bank, serta beroperasi dengan izin resmi OJK.
                    </p>
                    <a href="#simulasi" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                        Hitung Simulasi Bagi Hasil &darr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 1: PILIHAN TENOR & FITUR UTAMA
     ======================================== -->
<section class="py-14 lg:py-20 bg-white dark:bg-dark-surface-alt">
    <div class="container-wide">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 px-3 py-1 rounded-full border border-emerald-200 dark:border-emerald-800">
                Fleksibilitas Investasi
            </span>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-3 mb-2">
                Pilihan Tenor Fleksibel Sesuai Kebutuhan
            </h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Pilih jangka waktu penempatan yang paling cocok untuk rencana likuiditas pribadi maupun perusahaan.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16" data-aos="fade-up">
            <!-- Tenor 1 Bulan -->
            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-emerald-500 transition-all text-center group">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Tenor Singkat</span>
                <h4 class="text-3xl font-black text-slate-900 dark:text-white mb-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">1 Bulan</h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-4">
                    Likuiditas cepat dan fleksibel untuk perputaran dana jangka sangat pendek.
                </p>
                <span class="inline-block px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-xs font-bold">
                    ARO Tersedia
                </span>
            </div>

            <!-- Tenor 3 Bulan -->
            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-emerald-500 transition-all text-center group">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Tenor Menengah</span>
                <h4 class="text-3xl font-black text-slate-900 dark:text-white mb-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">3 Bulan</h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-4">
                    Kombinasi seimbang antara imbal hasil menarik dan durasi penempatan dana.
                </p>
                <span class="inline-block px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-xs font-bold">
                    ARO Tersedia
                </span>
            </div>

            <!-- Tenor 6 Bulan -->
            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:border-emerald-500 transition-all text-center group">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block mb-1">Tenor Optimal</span>
                <h4 class="text-3xl font-black text-slate-900 dark:text-white mb-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">6 Bulan</h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-4">
                    Pilihan populer untuk alokasi dana semesteran dengan nisbah lebih menguntungkan.
                </p>
                <span class="inline-block px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 text-xs font-bold">
                    ARO Tersedia
                </span>
            </div>

            <!-- Tenor 12 Bulan -->
            <div class="p-6 rounded-2xl bg-emerald-50/50 dark:bg-emerald-950/30 border-2 border-emerald-500/60 transition-all text-center group relative shadow-md">
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-0.5 rounded-full bg-emerald-600 text-white text-[10px] font-black uppercase tracking-wider shadow-sm">
                    Imbal Hasil Tertinggi
                </span>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-300 block mb-1 mt-1">Tenor Panjang</span>
                <h4 class="text-3xl font-black text-slate-900 dark:text-white mb-2 text-emerald-700 dark:text-emerald-400">12 Bulan</h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-4">
                    Pertumbuhan investasi maksimal dengan porsi nisbah bagi hasil paling optimal.
                </p>
                <span class="inline-block px-3 py-1 rounded-full bg-emerald-600 text-white text-xs font-bold">
                    ARO Tersedia
                </span>
            </div>
        </div>

        <!-- 6 Keunggulan List Card -->
        <div class="p-6 sm:p-8 rounded-3xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm" data-aos="fade-up">
            <h4 class="text-lg font-extrabold text-slate-900 dark:text-white mb-6">
                Keunggulan Deposito Mudharabah BPRS Wakalumi:
            </h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ( $dep_keunggulan_arr as $item ) : ?>
                    <div class="flex items-start gap-3 p-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-200/60 dark:border-slate-700/60">
                        <div class="w-6 h-6 rounded-lg bg-emerald-100 dark:bg-emerald-900/60 text-emerald-600 dark:text-emerald-300 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-xs sm:text-sm text-slate-700 dark:text-slate-200 font-medium leading-snug">
                            <?php echo esc_html( $item ); ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 2: TABEL NISBAH DINAMIS
     ======================================== -->
<section class="py-14 lg:py-20 bg-slate-50 dark:bg-dark-surface border-y border-slate-200/80 dark:border-slate-800">
    <div class="container-wide">
        <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
            <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 px-3 py-1 rounded-full border border-emerald-200 dark:border-emerald-800">
                Transparansi Bagi Hasil
            </span>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-3 mb-2">
                Tabel Nisbah & Equivalent Rate Terkini
            </h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Porsi pembagian keuntungan yang transparan, terkelola secara profesional, dan selalu diperbarui secara berkala.
            </p>
        </div>

        <div class="max-w-4xl mx-auto overflow-x-auto rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm bg-white dark:bg-slate-900" data-aos="fade-up">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-100/80 dark:bg-slate-800 text-slate-700 dark:text-slate-200 border-b border-slate-200 dark:border-slate-700">
                        <th class="p-4 font-bold text-xs uppercase tracking-wider">Jangka Waktu (Tenor)</th>
                        <th class="p-4 font-bold text-xs uppercase tracking-wider text-emerald-700 dark:text-emerald-300">Nisbah Nasabah</th>
                        <th class="p-4 font-bold text-xs uppercase tracking-wider text-slate-500">Nisbah Bank</th>
                        <th class="p-4 font-bold text-xs uppercase tracking-wider text-teal-700 dark:text-teal-300">Indikasi Eqv. Rate (p.a.)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    <?php foreach ( $deposito_nisbah as $row ) : ?>
                        <tr class="hover:bg-emerald-50/30 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="p-4 font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <?php echo esc_html( $row['nisbah_produk'] ?? 'Deposito' ); ?>
                            </td>
                            <td class="p-4 text-emerald-600 dark:text-emerald-400 font-extrabold text-base">
                                <?php echo esc_html( $row['nisbah_nasabah'] ?? '0' ); ?>%
                            </td>
                            <td class="p-4 text-slate-500 dark:text-slate-400 font-medium">
                                <?php echo esc_html( $row['nisbah_bank'] ?? '0' ); ?>%
                            </td>
                            <td class="p-4 text-slate-900 dark:text-slate-100 font-black">
                                <?php echo esc_html( $row['nisbah_equiv'] ?? '-' ); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="max-w-4xl mx-auto mt-4 text-center">
            <span class="text-[11px] text-slate-500 dark:text-slate-400">
                *Indikasi Equivalent Rate dihitung berdasarkan kinerja penyaluran pembiayaan periode berjalan dan dapat berubah sesuai realisasi pendapatan bank.
            </span>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 3: KALKULATOR SIMULASI DEPOSITO
     ======================================== -->
<section id="simulasi" class="scroll-mt-24 py-14 lg:py-20 bg-white dark:bg-dark-surface-alt">
    <div class="container-wide">
        <div class="max-w-4xl mx-auto p-6 sm:p-10 rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-emerald-950 text-white shadow-2xl relative overflow-hidden" data-aos="fade-up">
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold uppercase tracking-wider mb-3 border border-emerald-500/30">
                    <span>💎 Simulasi Finansial</span>
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight mb-2">
                    Kalkulator Simulasi Imbal Hasil Deposito
                </h3>
                <p class="text-sm text-slate-300 mb-8 max-w-2xl leading-relaxed">
                    Hitung estimasi bagi hasil bulanan dan total imbal hasil penempatan dana deposito syariah Anda secara instan dan transparan.
                </p>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <!-- Form Input (7 Kolom) -->
                    <div class="lg:col-span-7 space-y-6">
                        <!-- Nominal Penempatan -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-300">
                                    1. Nominal Penempatan Pokok
                                </label>
                                <span id="wkl-dep-nominal-display" class="text-base font-black text-emerald-300">
                                    Rp 50.000.000
                                </span>
                            </div>
                            <input 
                                type="range" 
                                id="wkl-dep-nominal-range" 
                                min="5000000" 
                                max="500000000" 
                                step="5000000" 
                                value="50000000" 
                                class="w-full h-2 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-emerald-400"
                            >
                            <!-- Preset Pills -->
                            <div class="flex flex-wrap gap-2 mt-3">
                                <button type="button" class="wkl-dep-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200" data-val="10000000">Rp 10 Jt</button>
                                <button type="button" class="wkl-dep-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-emerald-500/50 text-xs font-bold text-emerald-300" data-val="50000000">Rp 50 Jt</button>
                                <button type="button" class="wkl-dep-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200" data-val="100000000">Rp 100 Jt</button>
                                <button type="button" class="wkl-dep-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200" data-val="250000000">Rp 250 Jt</button>
                            </div>
                        </div>

                        <!-- Tenor Pilihan -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                2. Jangka Waktu (Tenor)
                            </label>
                            <div class="grid grid-cols-4 gap-2">
                                <button type="button" class="wkl-dep-tenor-btn py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-emerald-400" data-months="1" data-rate="3.50">1 Bln</button>
                                <button type="button" class="wkl-dep-tenor-btn py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-emerald-400" data-months="3" data-rate="4.25">3 Bln</button>
                                <button type="button" class="wkl-dep-tenor-btn py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-emerald-400" data-months="6" data-rate="5.00">6 Bln</button>
                                <button type="button" class="wkl-dep-tenor-btn active py-2.5 rounded-xl bg-emerald-600 border border-emerald-500 text-xs font-bold text-white shadow-md" data-months="12" data-rate="5.75">12 Bln</button>
                            </div>
                        </div>
                    </div>

                    <!-- Output Box (5 Kolom) -->
                    <div class="lg:col-span-5 bg-slate-800/90 p-6 sm:p-7 rounded-2xl border border-emerald-500/30 text-center relative shadow-inner">
                        <span class="text-xs text-slate-400 uppercase tracking-wider font-bold block mb-1">
                            Estimasi Bagi Hasil / Bulan
                        </span>
                        <div id="wkl-dep-result-monthly" class="text-3xl sm:text-4xl font-black text-emerald-400 tracking-tight mb-2">
                            Rp 239.583
                        </div>
                        <div class="py-2.5 px-3 rounded-xl bg-slate-900/80 mb-6 flex justify-between items-center text-xs">
                            <span class="text-slate-400">Total Akumulasi Hasil:</span>
                            <span id="wkl-dep-result-total" class="font-black text-emerald-300">Rp 2.875.000</span>
                        </div>

                        <div class="space-y-3 pt-3 border-t border-slate-700">
                            <a 
                                id="wkl-dep-wa-btn" 
                                href="https://wa.me/<?php echo esc_attr( $clean_wa ); ?>?text=<?php echo urlencode( 'Halo BPRS Wakalumi, saya berminat menempatkan Deposito Mudharabah sebesar Rp 50.000.000 dengan tenor 12 bulan. Mohon informasi syarat dan formulir pembukaannya.' ); ?>" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="w-full py-3 px-4 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-sm inline-flex items-center justify-center gap-2 shadow-lg transition-transform hover:scale-[1.02]"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <span>Buka Deposito via WhatsApp</span>
                            </a>
                            <span class="text-[11px] text-slate-400 block">
                                *Simulasi indikatif berdasarkan equivalent rate perkiraan sebelum pajak sesuai ketentuan berlaku.
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
<section class="py-14 lg:py-20 bg-slate-50 dark:bg-dark-surface border-t border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/60 px-3 py-1 rounded-full border border-emerald-200 dark:border-emerald-800">
                Persyaratan Pembukaan
            </span>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-3 mb-2">
                Dokumen & Ketentuan Pembukaan Deposito
            </h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Pilih kategori kepemilikan rekening untuk melihat daftar persyaratan dokumen.
            </p>
        </div>

        <div class="max-w-3xl mx-auto" data-aos="fade-up">
            <!-- Tabs -->
            <div class="flex justify-center gap-3 mb-8">
                <button type="button" id="tab-btn-ind" class="px-6 py-2.5 rounded-full bg-emerald-600 text-white font-bold text-xs sm:text-sm shadow-md transition-all">
                    👤 Nasabah Perorangan (Individu)
                </button>
                <button type="button" id="tab-btn-lem" class="px-6 py-2.5 rounded-full bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold text-xs sm:text-sm border border-slate-200 dark:border-slate-700 shadow-sm transition-all">
                    🏢 Perusahaan / Badan Usaha / Yayasan
                </button>
            </div>

            <!-- Content Individu -->
            <div id="content-ind" class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm">
                <h4 class="text-base font-extrabold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Persyaratan Deposito Perorangan:
                </h4>
                <ul class="space-y-2.5">
                    <?php foreach ( $dep_syarat_ind_arr as $syarat ) : ?>
                        <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700 dark:text-slate-200">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span><?php echo esc_html( $syarat ); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Content Lembaga -->
            <div id="content-lem" class="p-6 sm:p-8 rounded-3xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm hidden">
                <h4 class="text-base font-extrabold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Persyaratan Deposito Korporasi & Lembaga:
                </h4>
                <ul class="space-y-2.5">
                    <?php foreach ( $dep_syarat_lem_arr as $syarat ) : ?>
                        <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700 dark:text-slate-200">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span><?php echo esc_html( $syarat ); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 5: CTA BANNER & BROSUR
     ======================================== -->
<section class="py-14 lg:py-20 bg-white dark:bg-dark-surface-alt">
    <div class="container-wide">
        <div class="max-w-4xl mx-auto p-8 sm:p-12 rounded-3xl bg-slate-900 text-white text-center relative overflow-hidden shadow-xl" data-aos="fade-up">
            <div class="relative z-10 max-w-2xl mx-auto">
                <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-400 block mb-2">Konsultasi Penempatan Deposito</span>
                <h3 class="text-2xl sm:text-3xl font-black mb-4">Siap Mengoptimalkan Pertumbuhan Investasi Berkah Anda?</h3>
                <p class="text-sm text-slate-300 leading-relaxed mb-8">
                    Hubungi staf treasury dan customer service kami untuk mendapatkan penawaran porsi nisbah terbaik bagi dana simpanan perorangan maupun korporasi.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a 
                        href="https://wa.me/<?php echo esc_attr( $clean_wa ); ?>?text=<?php echo urlencode( 'Halo BPRS Wakalumi, saya ingin berkonsultasi mengenai penempatan dana Deposito Mudharabah.' ); ?>" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="py-3 px-6 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-sm inline-flex items-center gap-2 shadow-lg transition-transform hover:scale-105"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <span>Hubungi via WhatsApp</span>
                    </a>
                    <?php if ( ! empty( $brosur_url ) ) : ?>
                        <a 
                            href="<?php echo esc_url( $brosur_url ); ?>" 
                            download 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="py-3 px-6 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-sm border border-slate-700 inline-flex items-center gap-2 transition-colors"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            <span>Unduh Brosur Produk (PDF)</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     INTERACTIVE SIMULATOR JAVASCRIPT
     ======================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Tab Switcher
    var btnInd = document.getElementById('tab-btn-ind');
    var btnLem = document.getElementById('tab-btn-lem');
    var cntInd = document.getElementById('content-ind');
    var cntLem = document.getElementById('content-lem');

    if (btnInd && btnLem) {
        btnInd.addEventListener('click', function() {
            btnInd.className = 'px-6 py-2.5 rounded-full bg-emerald-600 text-white font-bold text-xs sm:text-sm shadow-md transition-all';
            btnLem.className = 'px-6 py-2.5 rounded-full bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold text-xs sm:text-sm border border-slate-200 dark:border-slate-700 shadow-sm transition-all';
            cntInd.classList.remove('hidden');
            cntLem.classList.add('hidden');
        });

        btnLem.addEventListener('click', function() {
            btnLem.className = 'px-6 py-2.5 rounded-full bg-emerald-600 text-white font-bold text-xs sm:text-sm shadow-md transition-all';
            btnInd.className = 'px-6 py-2.5 rounded-full bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold text-xs sm:text-sm border border-slate-200 dark:border-slate-700 shadow-sm transition-all';
            cntLem.classList.remove('hidden');
            cntInd.classList.add('hidden');
        });
    }

    // 2. Deposito Calculator
    var nominalRange   = document.getElementById('wkl-dep-nominal-range');
    var nominalDisplay = document.getElementById('wkl-dep-nominal-display');
    var resultMonthly  = document.getElementById('wkl-dep-result-monthly');
    var resultTotal    = document.getElementById('wkl-dep-result-total');
    var depWaBtn       = document.getElementById('wkl-dep-wa-btn');
    var presetBtns     = document.querySelectorAll('.wkl-dep-preset-btn');
    var tenorBtns      = document.querySelectorAll('.wkl-dep-tenor-btn');
    var waNumber       = "<?php echo esc_js( $clean_wa ); ?>";

    var currentMonths  = 12;
    var currentRate    = 5.75; // Annual rate percent

    function formatRupiah(num) {
        return 'Rp ' + Math.round(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function calculateDeposit() {
        if (!nominalRange || !resultMonthly || !resultTotal) return;

        var nominal = parseInt(nominalRange.value, 10) || 50000000;
        nominalDisplay.textContent = formatRupiah(nominal);

        // Annual return calculation (indikatif)
        var annualReturn = nominal * (currentRate / 100);
        var monthlyReturn = Math.round(annualReturn / 12);
        var totalReturn   = Math.round(monthlyReturn * currentMonths);

        resultMonthly.textContent = formatRupiah(monthlyReturn);
        resultTotal.textContent   = formatRupiah(totalReturn);

        if (depWaBtn) {
            var msg = "Halo BPRS Wakalumi, saya berminat membuka Deposito Mudharabah sebesar " + formatRupiah(nominal) + 
                      " dengan tenor " + currentMonths + " bulan (estimasi bagi hasil " + formatRupiah(monthlyReturn) + "/bln). Mohon panduan pembukaannya.";
            depWaBtn.href = "https://wa.me/" + waNumber + "?text=" + encodeURIComponent(msg);
        }
    }

    if (nominalRange) {
        nominalRange.addEventListener('input', calculateDeposit);
    }

    presetBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var val = parseInt(this.getAttribute('data-val'), 10);
            if (nominalRange && val) {
                nominalRange.value = val;
                presetBtns.forEach(function(b) {
                    b.classList.remove('border-emerald-500/50', 'text-emerald-300');
                    b.classList.add('border-slate-700', 'text-slate-200');
                });
                this.classList.remove('border-slate-700', 'text-slate-200');
                this.classList.add('border-emerald-500/50', 'text-emerald-300');
                calculateDeposit();
            }
        });
    });

    tenorBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            tenorBtns.forEach(function(b) {
                b.className = 'wkl-dep-tenor-btn py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-xs font-bold text-slate-200 hover:border-emerald-400';
            });
            this.className = 'wkl-dep-tenor-btn active py-2.5 rounded-xl bg-emerald-600 border border-emerald-500 text-xs font-bold text-white shadow-md';
            currentMonths = parseInt(this.getAttribute('data-months'), 10) || 12;
            currentRate   = parseFloat(this.getAttribute('data-rate')) || 5.0;
            calculateDeposit();
        });
    });

    calculateDeposit();
});
</script>

<?php
get_footer();

