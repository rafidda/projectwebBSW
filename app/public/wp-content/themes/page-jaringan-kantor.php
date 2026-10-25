<?php
/**
 * Template Name: Jaringan Kantor
 * Description: Halaman Jaringan Kantor & Layanan BPRS Wakalumi
 *              Menampilkan Kantor Pusat Operasional, Kantor Kas, dan Kantor Layanan
 *              dilengkapi filter kategori, kartu kontak interaktif, standar kenyamanan nasabah,
 *              dan modal pratinjau peta mutlak di tengah layar.
 *
 * @package Wakalumi
 */

get_header();

// ── AMBIL DATA PENGATURAN HALAMAN DARI WP_OPTIONS ─────────────────
$page_badge     = get_option( 'options_kantor_page_badge', 'Jaringan Kantor' );
$page_title     = get_option( 'options_kantor_page_title', 'Jaringan Kantor & Layanan BPRS Wakalumi' );
$page_subtitle  = get_option( 'options_kantor_page_subtitle', 'Kami hadir lebih dekat di lokasi-lokasi strategis untuk memberikan kemudahan, keamanan, dan kenyamanan prima bagi seluruh nasabah perbankan syariah.' );

$stat1_num      = get_option( 'options_kantor_stat1_num', '3 Kantor' );
$stat1_label    = get_option( 'options_kantor_stat1_label', 'Kantor Operasional & Kas' );
$stat2_num      = get_option( 'options_kantor_stat2_num', '3 Wilayah' );
$stat2_label    = get_option( 'options_kantor_stat2_label', 'Tangsel, Kab. Tangerang, & Kota Tangerang' );
$stat3_num      = get_option( 'options_kantor_stat3_num', 'Senin - Jumat' );
$stat3_label    = get_option( 'options_kantor_stat3_label', 'Pukul 08.00 - 15.00 WIB' );

// Hero Right Card (Dinamis dari WP-Admin)
$hero_card_badge = get_option( 'options_kantor_hero_card_badge', 'Jaringan Pelayanan Nasabah' );
$hero_card_title = get_option( 'options_kantor_hero_card_title', 'Hadir Lebih Dekat & Bersahabat' );
$hero_card_desc  = get_option( 'options_kantor_hero_card_desc', 'Melayani transaksi kas, pembukaan rekening simpanan, serta konsultasi pembiayaan syariah di wilayah Tangerang Selatan & Tangerang.' );
$hero_card_tag1  = get_option( 'options_kantor_hero_card_tag1', 'Lokasi Kantor' );
$hero_card_tag2  = get_option( 'options_kantor_hero_card_tag2', 'Layanan Prima SAPA' );

// ── DAFTAR KANTOR DEFAULT ───
$default_kantor_list = [
    [
        'nama'            => 'Kantor Pusat Operasional',
        'tipe'            => 'Kantor Pusat Operasional',
        'foto'            => get_template_directory_uri() . '/assets/img/kantor/kantor-pusat.jpg',
        'alamat'          => "Jl. Dewi Sartika, Komp. Ciputat Mutiara Center Blok B1 - Ciputat 15411",
        'kota_kab'        => 'Tangerang Selatan',
        'telepon'         => '(021) 7401667 - 7490874',
        'whatsapp'        => '081517380388',
        'jam_operasional' => 'Senin - Jumat: 08.00 - 15.00 WIB',
        'layanan'         => 'Semua Layanan Perbankan Syariah, Pembiayaan Modal Kerja & Konsumtif, Pembukaan Tabungan, Deposito Syariah, Customer Service',
        'gmaps_url'       => 'https://maps.google.com/?q=BPRS+Wakalumi+Ciputat',
        'status'          => 'Beroperasi Normal',
        'urutan'          => 1,
    ],
    [
        'nama'            => 'Kantor Kas Cikupa',
        'tipe'            => 'Kantor Kas',
        'foto'            => get_template_directory_uri() . '/assets/img/kantor/kantor-cikupa.jpg',
        'alamat'          => "Jl. Raya Serang Km 15, Ruko Cikupa Niaga Mas Blok C No. 22 Talagasari, Kec. Cikupa, Kabupaten Tangerang, Banten 15710",
        'kota_kab'        => 'Kabupaten Tangerang',
        'telepon'         => '(021) 7401667',
        'whatsapp'        => '081517380388',
        'jam_operasional' => 'Senin - Jumat: 08.00 - 15.00 WIB',
        'layanan'         => 'Setoran & Penarikan Tunai, Pembukaan Tabungan Syariah, Pengajuan Pembiayaan UMKM, Informasi Produk',
        'gmaps_url'       => 'https://maps.google.com/?q=Ruko+Cikupa+Niaga+Mas+Blok+C+No+22',
        'status'          => 'Beroperasi Normal',
        'urutan'          => 2,
    ],
    [
        'nama'            => 'Kantor Layanan Ciledug',
        'tipe'            => 'Kantor Layanan',
        'foto'            => get_template_directory_uri() . '/assets/img/kantor/kantor-ciledug.jpg',
        'alamat'          => "Plaza Ciledug, Lt. Basement Blok B.4, Kota Tangerang",
        'kota_kab'        => 'Kota Tangerang',
        'telepon'         => '(021) 7401667',
        'whatsapp'        => '081517380388',
        'jam_operasional' => 'Senin - Jumat: 08.00 - 15.00 WIB',
        'layanan'         => 'Pembukaan Tabungan, Informasi Produk Simpanan & Pembiayaan, Pelayanan Nasabah',
        'gmaps_url'       => 'https://maps.google.com/?q=Plaza+Ciledug',
        'status'          => 'Beroperasi Normal',
        'urutan'          => 3,
    ],
];

$kantor_list = get_option( 'options_kantor_list', false );
if ( empty( $kantor_list ) || ! is_array( $kantor_list ) ) {
    $kantor_list = $default_kantor_list;
}

// Urutkan kantor berdasarkan urutan
usort( $kantor_list, function( $a, $b ) {
    $ua = isset( $a['urutan'] ) ? intval( $a['urutan'] ) : 99;
    $ub = isset( $b['urutan'] ) ? intval( $b['urutan'] ) : 99;
    return $ua <=> $ub;
});

$total_kantor = count( $kantor_list );

// Responsive Grid Columns: Jika 2 kantor maka tampil 2 kolom penuh (*full page balance*), jika 3 atau lebih maka 3 kolom
$grid_cols_class = 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3';
if ( $total_kantor === 2 ) {
    $grid_cols_class = 'grid-cols-1 lg:grid-cols-2 max-w-6xl mx-auto';
} elseif ( $total_kantor === 1 ) {
    $grid_cols_class = 'grid-cols-1 max-w-2xl mx-auto';
}

// Hitung jumlah per kategori untuk badge filter
$categories_count = [
    'all'     => $total_kantor,
    'pusat'   => 0,
    'kas'     => 0,
    'layanan' => 0,
];

foreach ( $kantor_list as $k ) {
    $t = strtolower( $k['tipe'] ?? '' );
    if ( strpos( $t, 'pusat' ) !== false ) {
        $categories_count['pusat']++;
    } elseif ( strpos( $t, 'kas' ) !== false ) {
        $categories_count['kas']++;
    } elseif ( strpos( $t, 'layanan' ) !== false ) {
        $categories_count['layanan']++;
    }
}

// Standar Kenyamanan Nasabah (Amenities)
$amenities_badge = get_option( 'options_kantor_amenities_badge', 'Standar Kenyamanan Nasabah' );
$amenities_title = get_option( 'options_kantor_amenities_title', 'Komitmen Pelayanan di Seluruh Jaringan Kantor' );
$amenities_desc  = get_option( 'options_kantor_amenities_desc', 'Setiap kantor kami dirancang memberikan lingkungan yang ramah, nyaman, dan mengedepankan keamanan serta keberkahan syariah.' );

$amenities_list  = get_option( 'options_kantor_amenities_list', [] );
if ( empty( $amenities_list ) ) {
    $amenities_list = [
        [
            'title' => 'Lokasi Strategis',
            'desc'  => 'Terletak di kawasan niaga utama yang mudah diakses dengan kendaraan pribadi maupun sarana transportasi umum.',
            'tag'   => 'Akses Mudah & Parkir Luas',
            'icon'  => 'pin',
            'color' => 'teal',
        ],
        [
            'title' => 'Layanan Ramah & Beretika',
            'desc'  => 'Customer Service dan teller berpengalaman menyambut Anda dengan prinsip keramahan syariah dan profesionalisme tinggi.',
            'tag'   => 'Budaya SAPA Syariah',
            'icon'  => 'users',
            'color' => 'sky',
        ],
        [
            'title' => 'Diawasi OJK & DPS',
            'desc'  => 'Seluruh operasional kantor berada dalam pengawasan Otoritas Jasa Keuangan (OJK) serta kepatuhan fatwa DSN-MUI.',
            'tag'   => 'Kepatuhan Regulasi Penuh',
            'icon'  => 'shield',
            'color' => 'amber',
        ],
        [
            'title' => 'Simpanan Dijamin LPS',
            'desc'  => 'Setiap simpanan nasabah dijamin Lembaga Penjamin Simpanan (LPS) hingga Rp 2 Miliar per nasabah per bank.',
            'tag'   => 'Dana Terjamin Amanah',
            'icon'  => 'lock',
            'color' => 'indigo',
        ],
    ];
}

// CTA Settings
$cta_show      = get_option( 'options_kantor_cta_show', '1' );
$cta_badge     = get_option( 'options_kantor_cta_badge', 'Layanan Nasabah' );
$cta_title     = get_option( 'options_kantor_cta_title', 'Perlu Bantuan atau Ingin Berkonsultasi Langsung?' );
$cta_desc      = get_option( 'options_kantor_cta_desc', 'Kunjungi kantor kami terdekat atau hubungi layanan nasabah kami via WhatsApp untuk kemudahan informasi produk simpanan dan pengajuan pembiayaan syariah.' );
$cta_btn1_text = get_option( 'options_kantor_cta_btn1_text', 'Chat WhatsApp CS' );
$cta_btn1_url  = get_option( 'options_kantor_cta_btn1_url', '' );
$cta_btn2_text = get_option( 'options_kantor_cta_btn2_text', 'Jelajahi Produk Simpanan' );
$cta_btn2_url  = get_option( 'options_kantor_cta_btn2_url', home_url( '/produk/tabungan-syariah' ) );

$wa_global     = get_option( 'options_contact_wa', '6281517380388' );
if ( empty( $cta_btn1_url ) ) {
    $clean_wa = preg_replace( '/[^0-9]/', '', $wa_global );
    if ( substr( $clean_wa, 0, 1 ) === '0' ) {
        $clean_wa = '62' . substr( $clean_wa, 1 );
    }
    $cta_btn1_url = 'https://wa.me/' . $clean_wa . '?text=' . urlencode( 'Halo BPRS Wakalumi, saya ingin menanyakan informasi jaringan kantor dan layanan syariah.' );
}
?>

<!-- ========================================
     HEADER BANNER & BREADCRUMBS (HERO + KARTU LAYANAN KANTOR)
     ======================================== -->
<section class="wkl-page-hero">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-80 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

    <div class="container-wide relative z-10">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-400 transition-colors flex items-center gap-1.5 font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-slate-600 dark:text-slate-300 font-medium">Profil</span>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-teal-600 dark:text-teal-400 font-bold">Jaringan Kantor</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            <!-- Left Column: Title, Subtitle & 3 Quick Stats -->
            <div class="lg:col-span-7 xl:col-span-8" data-aos="fade-up">
                <!-- Kicker Badge -->
                <?php if ( ! empty( $page_badge ) ) : ?>
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full mb-4 bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        <span><?php echo esc_html( $page_badge ); ?></span>
                    </div>
                <?php endif; ?>

                <!-- Page Title -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-[1.15] mb-4">
                    <?php echo esc_html( $page_title ); ?>
                </h1>

                <!-- Subtitle -->
                <?php if ( ! empty( $page_subtitle ) ) : ?>
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl mb-6">
                        <?php echo esc_html( $page_subtitle ); ?>
                    </p>
                <?php endif; ?>

                <!-- 3 Quick Stats Counter Bar -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 max-w-3xl pt-2">
                    <!-- Stat 1 -->
                    <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-white/90 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/80 shadow-xs backdrop-blur-sm">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 dark:bg-teal-950/40 border border-teal-200 dark:border-teal-800/50 flex items-center justify-center text-teal-600 dark:text-teal-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <div class="text-base font-black text-slate-900 dark:text-white leading-tight">
                                <?php echo esc_html( $stat1_num ); ?>
                            </div>
                            <div class="text-xs text-slate-500 dark:text-slate-400 leading-tight mt-0.5">
                                <?php echo esc_html( $stat1_label ); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Stat 2 -->
                    <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-white/90 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/80 shadow-xs backdrop-blur-sm">
                        <div class="w-10 h-10 rounded-xl bg-primary-50 dark:bg-primary-950/40 border border-primary-200 dark:border-primary-800/50 flex items-center justify-center text-primary-600 dark:text-teal-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <div class="text-base font-black text-slate-900 dark:text-white leading-tight">
                                <?php echo esc_html( $stat2_num ); ?>
                            </div>
                            <div class="text-xs text-slate-500 dark:text-slate-400 leading-tight mt-0.5">
                                <?php echo esc_html( $stat2_label ); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Stat 3 -->
                    <div class="flex items-center gap-3 p-3.5 rounded-2xl bg-white/90 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/80 shadow-xs backdrop-blur-sm">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800/50 flex items-center justify-center text-amber-600 dark:text-amber-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="text-base font-black text-slate-900 dark:text-white leading-tight">
                                <?php echo esc_html( $stat3_num ); ?>
                            </div>
                            <div class="text-xs text-slate-500 dark:text-slate-400 leading-tight mt-0.5">
                                <?php echo esc_html( $stat3_label ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Office Network Service Hub Card (100% Dinamis dari WP-Admin) -->
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
                                    <?php echo esc_html( $total_kantor . ' ' . $hero_card_tag1 ); ?>
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
     MAIN SECTION: FILTER & OFFICE CARDS
     ======================================== -->
<section id="daftar-kantor" class="relative z-10 py-12 md:py-20 bg-slate-50/70 dark:bg-dark-surface/60 backdrop-blur-sm border-b border-slate-200/70 dark:border-slate-800/70">
    <div class="container-wide">

        <!-- Filter Controls Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10 md:mb-12" data-aos="fade-up">
            <div>
                <span class="text-xs uppercase tracking-widest font-extrabold text-primary-600 dark:text-teal-400 block mb-1">Pencarian Lokasi</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    Kantor &amp; Titik Layanan
                </h2>
            </div>

            <!-- Filter Buttons Group -->
            <div class="inline-flex items-center p-1.5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 shadow-sm flex-wrap gap-1" id="kantor-filter-group">
                <button type="button" data-filter="all" class="kantor-filter-btn active px-3.5 py-1.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 bg-primary-600 text-white shadow-sm">
                    Semua (<?php echo intval( $categories_count['all'] ); ?>)
                </button>
                <button type="button" data-filter="pusat" class="kantor-filter-btn px-3.5 py-1.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-teal-400">
                    Kantor Pusat (<?php echo intval( $categories_count['pusat'] ); ?>)
                </button>
                <button type="button" data-filter="kas" class="kantor-filter-btn px-3.5 py-1.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-teal-400">
                    Kantor Kas (<?php echo intval( $categories_count['kas'] ); ?>)
                </button>
                <button type="button" data-filter="layanan" class="kantor-filter-btn px-3.5 py-1.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-teal-400">
                    Kantor Layanan (<?php echo intval( $categories_count['layanan'] ); ?>)
                </button>
            </div>
        </div>

        <!-- Office Cards Grid (2 Kantor Full Width / 3+ Kantor 3-Kolom) -->
        <div class="grid <?php echo esc_attr( $grid_cols_class ); ?> gap-6 lg:gap-8 items-stretch" id="kantor-grid">
            <?php foreach ( $kantor_list as $index => $kantor ) : 
                $nama      = $kantor['nama'] ?? 'Kantor BPRS Wakalumi';
                $tipe      = $kantor['tipe'] ?? 'Kantor Operasional';
                $foto      = $kantor['foto'] ?? '';
                $alamat    = $kantor['alamat'] ?? '';
                $kota      = $kantor['kota_kab'] ?? '';
                $telepon   = $kantor['telepon'] ?? '';
                $whatsapp  = $kantor['whatsapp'] ?? '';
                $jam       = $kantor['jam_operasional'] ?? 'Senin - Jumat: 08.00 - 15.00 WIB';
                $layanan   = $kantor['layanan'] ?? '';
                $gmaps     = $kantor['gmaps_url'] ?? '';
                $status    = $kantor['status'] ?? 'Beroperasi Normal';

                // Determine category tag for filter
                $tipe_lower = strtolower( $tipe );
                $cat_filter = 'layanan';
                if ( strpos( $tipe_lower, 'pusat' ) !== false ) {
                    $cat_filter = 'pusat';
                } elseif ( strpos( $tipe_lower, 'kas' ) !== false ) {
                    $cat_filter = 'kas';
                }

                // Parse layanan into array
                $layanan_items = array_filter( array_map( 'trim', explode( ',', $layanan ) ) );

                // Clean WA number
                $wa_clean = preg_replace( '/[^0-9]/', '', $whatsapp );
                if ( ! empty( $wa_clean ) && substr( $wa_clean, 0, 1 ) === '0' ) {
                    $wa_clean = '62' . substr( $wa_clean, 1 );
                }
                $wa_link = ! empty( $wa_clean ) ? 'https://wa.me/' . $wa_clean . '?text=' . urlencode( 'Halo BPRS Wakalumi ' . $nama . ', saya ingin bertanya seputar layanan perbankan syariah.' ) : '';

                // Clean phone number for tel:
                $tel_first = '';
                if ( ! empty( $telepon ) ) {
                    $phone_parts = explode( '-', $telepon );
                    $tel_first = trim( $phone_parts[0] );
                    $tel_clean = preg_replace( '/[^0-9]/', '', $tel_first );
                    if ( substr( $tel_clean, 0, 1 ) === '0' ) {
                        $tel_clean = '+62' . substr( $tel_clean, 1 );
                    }
                }

                // Google Maps fallback if not set
                if ( empty( $gmaps ) ) {
                    $gmaps = 'https://maps.google.com/?q=' . urlencode( 'BPRS Wakalumi ' . $nama . ' ' . $alamat );
                }

                // Iframe embed query for map modal
                $embed_query = urlencode( $nama . ', ' . $alamat );
            ?>
                <!-- Office Card -->
                <article 
                    class="kantor-card group relative flex flex-col rounded-3xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-lg shadow-slate-100/70 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] hover:shadow-2xl hover:border-teal-400/50 dark:hover:border-teal-500/50 transition-all duration-300 hover:-translate-y-1.5"
                    data-category="<?php echo esc_attr( $cat_filter ); ?>"
                    data-aos="fade-up"
                    data-aos-delay="<?php echo esc_attr( ( $index % 3 ) * 100 ); ?>"
                >
                    <!-- Card Media / Photo Area (Klik untuk Buka Detail Kantor & Foto Utuh Proporsional) -->
                    <div 
                        class="open-kantor-detail-btn group/photo relative h-56 sm:h-64 w-full overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-950 flex-shrink-0 cursor-pointer"
                        role="button"
                        tabindex="0"
                        aria-label="Lihat Foto Utuh & Informasi Kantor <?php echo esc_attr( $nama ); ?>"
                        data-nama="<?php echo esc_attr( $nama ); ?>"
                        data-tipe="<?php echo esc_attr( $tipe ); ?>"
                        data-foto="<?php echo esc_url( $foto ); ?>"
                        data-alamat="<?php echo esc_attr( $alamat ); ?>"
                        data-kota="<?php echo esc_attr( $kota ); ?>"
                        data-telepon="<?php echo esc_attr( $telepon ); ?>"
                        data-telclean="<?php echo esc_attr( $tel_clean ); ?>"
                        data-whatsapp="<?php echo esc_attr( $whatsapp ); ?>"
                        data-walink="<?php echo esc_url( $wa_link ); ?>"
                        data-jam="<?php echo esc_attr( $jam ); ?>"
                        data-layanan="<?php echo esc_attr( $layanan ); ?>"
                        data-gmaps="<?php echo esc_url( $gmaps ); ?>"
                        data-status="<?php echo esc_attr( $status ); ?>"
                        data-query="<?php echo esc_attr( $embed_query ); ?>"
                    >
                        <?php if ( ! empty( $foto ) ) : ?>
                            <img 
                                src="<?php echo esc_url( $foto ); ?>" 
                                alt="<?php echo esc_attr( $nama ); ?>"
                                class="w-full h-full object-cover group-hover/photo:scale-105 transition-transform duration-700 ease-out"
                                loading="lazy"
                                onerror="this.onerror=null; this.parentElement.classList.add('is-fallback'); this.style.display='none';"
                            >
                        <?php endif; ?>

                        <!-- Fallback Graphic if no photo or photo fails to load -->
                        <div class="card-photo-fallback absolute inset-0 <?php echo ! empty( $foto ) ? 'hidden' : 'flex'; ?> flex-col items-center justify-center p-6 text-center bg-gradient-to-br from-teal-900/90 via-primary-950/95 to-slate-900 text-white">
                            <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-md flex items-center justify-center mb-3 shadow-inner group-hover/photo:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-widest text-teal-200/80">BPRS Wakalumi</span>
                            <span class="text-sm font-extrabold text-white mt-0.5 line-clamp-1"><?php echo esc_html( $nama ); ?></span>
                        </div>

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent pointer-events-none"></div>

                        <!-- Hover Overlay Badge: Klik untuk Lihat Foto Utuh & Info -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/photo:opacity-100 transition-all duration-300 bg-black/45 backdrop-blur-[2px] z-20 pointer-events-none">
                            <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white/95 dark:bg-slate-900/95 text-slate-900 dark:text-teal-300 text-xs font-extrabold shadow-xl border border-white/20 transform translate-y-2 group-hover/photo:translate-y-0 transition-transform duration-300">
                                <svg class="w-4 h-4 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                <span>Lihat Foto Utuh &amp; Info</span>
                            </span>
                        </div>

                        <!-- Top Badges Floating (Clean Separated Layout - Anti Tabrakan) -->
                        <div class="absolute top-3.5 left-3.5 right-3.5 flex items-center justify-between gap-2 pointer-events-none z-10">
                            <!-- Type Badge (Kiri Atas) -->
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] sm:text-xs font-extrabold uppercase tracking-wider backdrop-blur-md shadow-md max-w-[62%] truncate <?php 
                                if ( $cat_filter === 'pusat' ) {
                                    echo 'bg-teal-600/90 text-white border border-teal-400/40';
                                } elseif ( $cat_filter === 'kas' ) {
                                    echo 'bg-blue-600/90 text-white border border-blue-400/40';
                                } else {
                                    echo 'bg-indigo-600/90 text-white border border-indigo-400/40';
                                }
                            ?>">
                                <?php echo esc_html( $tipe ); ?>
                            </span>

                            <!-- Status Dot Badge (Kanan Atas) -->
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] sm:text-[11px] font-bold bg-slate-900/85 text-teal-300 border border-teal-500/40 backdrop-blur-md shadow-sm shrink-0">
                                <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                                <span><?php echo esc_html( $status ); ?></span>
                            </span>
                        </div>

                        <!-- Bottom Location Tag on Photo -->
                        <?php if ( ! empty( $kota ) ) : ?>
                            <div class="absolute bottom-3 left-3.5 z-10 flex items-center gap-1.5 text-xs font-semibold text-white/95 bg-black/40 px-2.5 py-1 rounded-lg backdrop-blur-sm shadow-sm">
                                <svg class="w-3.5 h-3.5 text-teal-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span><?php echo esc_html( $kota ); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 md:p-7 flex flex-col flex-grow justify-between relative bg-white dark:bg-slate-900">
                        <!-- Upper Info -->
                        <div>
                            <!-- Office Name (Clickable to open Detail Modal) -->
                            <h3 
                                class="open-kantor-detail-btn cursor-pointer text-xl font-extrabold text-slate-900 dark:text-white leading-tight mb-3 hover:text-primary-600 dark:hover:text-teal-300 transition-colors inline-block"
                                data-nama="<?php echo esc_attr( $nama ); ?>"
                                data-tipe="<?php echo esc_attr( $tipe ); ?>"
                                data-foto="<?php echo esc_url( $foto ); ?>"
                                data-alamat="<?php echo esc_attr( $alamat ); ?>"
                                data-kota="<?php echo esc_attr( $kota ); ?>"
                                data-telepon="<?php echo esc_attr( $telepon ); ?>"
                                data-telclean="<?php echo esc_attr( $tel_clean ); ?>"
                                data-whatsapp="<?php echo esc_attr( $whatsapp ); ?>"
                                data-walink="<?php echo esc_url( $wa_link ); ?>"
                                data-jam="<?php echo esc_attr( $jam ); ?>"
                                data-layanan="<?php echo esc_attr( $layanan ); ?>"
                                data-gmaps="<?php echo esc_url( $gmaps ); ?>"
                                data-status="<?php echo esc_attr( $status ); ?>"
                                data-query="<?php echo esc_attr( $embed_query ); ?>"
                                title="Klik untuk melihat foto utuh &amp; info lengkap kantor"
                            >
                                <?php echo esc_html( $nama ); ?>
                            </h3>

                            <!-- Address with One-Click Copy -->
                            <div class="mb-5 p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-100 dark:border-slate-700/60 relative group/addr">
                                <div class="flex items-start gap-2.5">
                                    <svg class="w-4 h-4 text-primary-600 dark:text-teal-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <div class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed flex-grow">
                                        <span class="kantor-alamat-text"><?php echo nl2br( esc_html( $alamat ) ); ?></span>
                                    </div>
                                </div>
                                <div class="mt-2.5 pt-2 border-t border-slate-200/60 dark:border-slate-700/50 flex items-center justify-between">
                                    <span class="text-[11px] text-slate-400 dark:text-slate-500">Alamat Resmi Operasional</span>
                                    <button 
                                        type="button" 
                                        class="copy-kantor-alamat-btn text-[11px] font-bold text-primary-600 hover:text-primary-700 dark:text-teal-400 dark:hover:text-teal-300 inline-flex items-center gap-1 transition-colors"
                                        data-copy="<?php echo esc_attr( $alamat ); ?>"
                                        title="Salin Alamat ke Clipboard"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                        <span class="btn-copy-label">Salin Alamat</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Operating Hours & Contact Details List -->
                            <div class="space-y-3 mb-5 text-xs sm:text-sm">
                                <!-- Jam Operasional -->
                                <div class="flex items-center gap-3 text-slate-600 dark:text-slate-300">
                                    <div class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 dark:text-slate-400 flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <div>
                                        <span class="block text-[11px] uppercase tracking-wider font-extrabold text-slate-400 dark:text-slate-500">Jam Layanan</span>
                                        <span class="font-semibold text-slate-800 dark:text-slate-200"><?php echo esc_html( $jam ); ?></span>
                                    </div>
                                </div>

                                <!-- Telepon -->
                                <?php if ( ! empty( $telepon ) ) : ?>
                                    <div class="flex items-center gap-3 text-slate-600 dark:text-slate-300">
                                        <div class="w-8 h-8 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 dark:text-slate-400 flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        </div>
                                        <div>
                                            <span class="block text-[11px] uppercase tracking-wider font-extrabold text-slate-400 dark:text-slate-500">Telepon Kantor</span>
                                            <a href="tel:<?php echo esc_attr( $tel_clean ); ?>" class="font-semibold text-slate-800 dark:text-slate-200 hover:text-primary-600 dark:hover:text-teal-400 transition-colors">
                                                <?php echo esc_html( $telepon ); ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- WhatsApp -->
                                <?php if ( ! empty( $whatsapp ) ) : ?>
                                    <div class="flex items-center gap-3 text-slate-600 dark:text-slate-300">
                                        <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                        </div>
                                        <div>
                                            <span class="block text-[11px] uppercase tracking-wider font-extrabold text-slate-400 dark:text-slate-500">WhatsApp Pelayanan</span>
                                            <a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener noreferrer" class="font-semibold text-emerald-600 dark:text-emerald-400 hover:underline transition-all inline-flex items-center gap-1">
                                                <?php echo esc_html( $whatsapp ); ?>
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Layanan Tersedia Pills -->
                            <?php if ( ! empty( $layanan_items ) ) : ?>
                                <div class="mb-6 pt-3 border-t border-slate-100 dark:border-slate-800">
                                    <span class="text-[11px] uppercase tracking-wider font-extrabold text-slate-400 dark:text-slate-500 block mb-2">
                                        Fasilitas &amp; Layanan
                                    </span>
                                    <div class="flex flex-wrap gap-1.5">
                                        <?php foreach ( $layanan_items as $item ) : ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-medium bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                                                <svg class="w-3 h-3 text-teal-600 dark:text-teal-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                <?php echo esc_html( $item ); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Action Buttons Bar -->
                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800/80 flex flex-col sm:flex-row items-center gap-2.5">
                            <!-- Button 1: Google Maps Navigation (External App) -->
                            <a 
                                href="<?php echo esc_url( $gmaps ); ?>" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="w-full sm:flex-1 py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold inline-flex items-center justify-center gap-2 bg-primary-600 hover:bg-primary-700 text-white shadow-md shadow-primary-500/20 hover:shadow-primary-500/30 transition-all duration-200"
                            >
                                <svg class="w-4 h-4 text-teal-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>Buka Rute Maps</span>
                            </a>

                            <!-- Button 2: Interactive Map Modal Trigger -->
                            <button 
                                type="button" 
                                class="open-map-modal-btn w-full sm:w-auto py-2.5 px-3.5 rounded-xl text-xs sm:text-sm font-semibold inline-flex items-center justify-center gap-1.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 transition-colors"
                                data-title="<?php echo esc_attr( $nama ); ?>"
                                data-tipe="<?php echo esc_attr( $tipe ); ?>"
                                data-alamat="<?php echo esc_attr( $alamat ); ?>"
                                data-gmaps="<?php echo esc_url( $gmaps ); ?>"
                                data-query="<?php echo esc_attr( $embed_query ); ?>"
                                title="Lihat pratinjau peta tanpa meninggalkan halaman"
                            >
                                <svg class="w-4 h-4 text-slate-500 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                                <span>Intip Peta</span>
                            </button>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>


<!-- ========================================
     SECTION: STANDAR KENYAMANAN NASABAH (KOMITMEN PELAYANAN)
     Dual-Tone Header, Centered Icon, Hover Thin Outline & Logo Watermark
     ======================================== -->
<?php if ( ! empty( $amenities_list ) ) : ?>
<section class="relative z-10 py-14 md:py-20 bg-white dark:bg-dark border-b border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16" data-aos="fade-up">
            <?php if ( ! empty( $amenities_badge ) ) : ?>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300 border border-teal-100 dark:border-teal-800/30 mb-3">
                    <?php echo esc_html( $amenities_badge ); ?>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $amenities_title ) ) : ?>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    <?php echo esc_html( $amenities_title ); ?>
                </h2>
            <?php endif; ?>

            <?php if ( ! empty( $amenities_desc ) ) : ?>
                <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                    <?php echo esc_html( $amenities_desc ); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php 
            // Palet Warna Tematik Dinamis (Dapat ditentukan di WP-Admin per kartu atau Otomatis)
            $palette_themes = [
                'teal' => [
                    'border'     => 'border-teal-200/90 dark:border-teal-900/60 hover:border-teal-500/80 dark:hover:border-teal-400',
                    'shadow'     => 'hover:shadow-xl hover:shadow-teal-500/15',
                    'header_bg'  => 'bg-gradient-to-r from-teal-50/90 via-emerald-50/50 to-teal-100/30 dark:from-teal-950/80 dark:via-teal-900/40 dark:to-slate-900/90 border-b border-teal-100 dark:border-teal-900/50',
                    'icon_solid' => 'bg-teal-600 dark:bg-teal-500 text-white shadow-md shadow-teal-600/30 ring-4 ring-teal-100/80 dark:ring-teal-950/80',
                    'title'      => 'group-hover:text-teal-600 dark:group-hover:text-teal-300',
                    'footer_bg'  => 'bg-teal-50/70 dark:bg-teal-950/50 border-t border-teal-100/80 dark:border-teal-900/40 text-teal-800 dark:text-teal-200',
                    'badge_icon' => 'bg-teal-600/15 text-teal-600 dark:text-teal-300',
                ],
                'sky' => [
                    'border'     => 'border-sky-200/90 dark:border-sky-900/60 hover:border-sky-500/80 dark:hover:border-sky-400',
                    'shadow'     => 'hover:shadow-xl hover:shadow-sky-500/15',
                    'header_bg'  => 'bg-gradient-to-r from-sky-50/90 via-blue-50/50 to-sky-100/30 dark:from-sky-950/80 dark:via-sky-900/40 dark:to-slate-900/90 border-b border-sky-100 dark:border-sky-900/50',
                    'icon_solid' => 'bg-sky-600 dark:bg-sky-500 text-white shadow-md shadow-sky-600/30 ring-4 ring-sky-100/80 dark:ring-sky-950/80',
                    'title'      => 'group-hover:text-sky-600 dark:group-hover:text-sky-300',
                    'footer_bg'  => 'bg-sky-50/70 dark:bg-sky-950/50 border-t border-sky-100/80 dark:border-sky-900/40 text-sky-800 dark:text-sky-200',
                    'badge_icon' => 'bg-sky-600/15 text-sky-600 dark:text-sky-300',
                ],
                'amber' => [
                    'border'     => 'border-amber-200/90 dark:border-amber-900/60 hover:border-amber-500/80 dark:hover:border-amber-400',
                    'shadow'     => 'hover:shadow-xl hover:shadow-amber-500/15',
                    'header_bg'  => 'bg-gradient-to-r from-amber-50/90 via-yellow-50/50 to-amber-100/30 dark:from-amber-950/80 dark:via-amber-900/40 dark:to-slate-900/90 border-b border-amber-100 dark:border-amber-900/50',
                    'icon_solid' => 'bg-amber-600 dark:bg-amber-500 text-white shadow-md shadow-amber-600/30 ring-4 ring-amber-100/80 dark:ring-amber-950/80',
                    'title'      => 'group-hover:text-amber-600 dark:group-hover:text-amber-300',
                    'footer_bg'  => 'bg-amber-50/70 dark:bg-amber-950/50 border-t border-amber-100/80 dark:border-amber-900/40 text-amber-800 dark:text-amber-200',
                    'badge_icon' => 'bg-amber-600/15 text-amber-600 dark:text-amber-300',
                ],
                'indigo' => [
                    'border'     => 'border-indigo-200/90 dark:border-indigo-900/60 hover:border-indigo-500/80 dark:hover:border-indigo-400',
                    'shadow'     => 'hover:shadow-xl hover:shadow-indigo-500/15',
                    'header_bg'  => 'bg-gradient-to-r from-indigo-50/90 via-purple-50/50 to-indigo-100/30 dark:from-indigo-950/80 dark:via-indigo-900/40 dark:to-slate-900/90 border-b border-indigo-100 dark:border-indigo-900/50',
                    'icon_solid' => 'bg-indigo-600 dark:bg-indigo-500 text-white shadow-md shadow-indigo-600/30 ring-4 ring-indigo-100/80 dark:ring-indigo-950/80',
                    'title'      => 'group-hover:text-indigo-600 dark:group-hover:text-indigo-300',
                    'footer_bg'  => 'bg-indigo-50/70 dark:bg-indigo-950/50 border-t border-indigo-100/80 dark:border-indigo-900/40 text-indigo-800 dark:text-indigo-200',
                    'badge_icon' => 'bg-indigo-600/15 text-indigo-600 dark:text-indigo-300',
                ],
                'rose' => [
                    'border'     => 'border-rose-200/90 dark:border-rose-900/60 hover:border-rose-500/80 dark:hover:border-rose-400',
                    'shadow'     => 'hover:shadow-xl hover:shadow-rose-500/15',
                    'header_bg'  => 'bg-gradient-to-r from-rose-50/90 via-pink-50/50 to-rose-100/30 dark:from-rose-950/80 dark:via-rose-900/40 dark:to-slate-900/90 border-b border-rose-100 dark:border-rose-900/50',
                    'icon_solid' => 'bg-rose-600 dark:bg-rose-500 text-white shadow-md shadow-rose-600/30 ring-4 ring-rose-100/80 dark:ring-rose-950/80',
                    'title'      => 'group-hover:text-rose-600 dark:group-hover:text-rose-300',
                    'footer_bg'  => 'bg-rose-50/70 dark:bg-rose-950/50 border-t border-rose-100/80 dark:border-rose-900/40 text-rose-800 dark:text-rose-200',
                    'badge_icon' => 'bg-rose-600/15 text-rose-600 dark:text-rose-300',
                ],
                'emerald' => [
                    'border'     => 'border-emerald-200/90 dark:border-emerald-900/60 hover:border-emerald-500/80 dark:hover:border-emerald-400',
                    'shadow'     => 'hover:shadow-xl hover:shadow-emerald-500/15',
                    'header_bg'  => 'bg-gradient-to-r from-emerald-50/90 via-teal-50/50 to-emerald-100/30 dark:from-emerald-950/80 dark:via-emerald-900/40 dark:to-slate-900/90 border-b border-emerald-100 dark:border-emerald-900/50',
                    'icon_solid' => 'bg-emerald-600 dark:bg-emerald-500 text-white shadow-md shadow-emerald-600/30 ring-4 ring-emerald-100/80 dark:ring-emerald-950/80',
                    'title'      => 'group-hover:text-emerald-600 dark:group-hover:text-emerald-300',
                    'footer_bg'  => 'bg-emerald-50/70 dark:bg-emerald-950/50 border-t border-emerald-100/80 dark:border-emerald-900/40 text-emerald-800 dark:text-emerald-200',
                    'badge_icon' => 'bg-emerald-600/15 text-emerald-600 dark:text-emerald-300',
                ],
            ];
            $palette_order = [ 'teal', 'sky', 'amber', 'indigo', 'rose', 'emerald' ];

            foreach ( $amenities_list as $am_idx => $am_item ) : 
                $a_title = $am_item['title'] ?? '';
                $a_desc  = $am_item['desc'] ?? '';
                $a_tag   = $am_item['tag'] ?? '';
                $a_icon  = $am_item['icon'] ?? 'pin';
                $a_color = $am_item['color'] ?? 'auto';

                if ( ! empty( $a_color ) && $a_color !== 'auto' && isset( $palette_themes[ $a_color ] ) ) {
                    $theme = $palette_themes[ $a_color ];
                } else {
                    $theme_key = $palette_order[ $am_idx % count( $palette_order ) ];
                    $theme = $palette_themes[ $theme_key ];
                }
            ?>
                <!-- 3-Tone Card (Tone 1: Header Solid Icon & Title | Tone 2: Body Description & Watermark | Tone 3: Footer Pill Tag) -->
                <div class="spotlight-card tilt-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border <?php echo esc_attr( $theme['border'] ); ?> shadow-md shadow-slate-100 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] <?php echo esc_attr( $theme['shadow'] ); ?> hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between cursor-default" data-aos="fade-up" data-aos-delay="<?php echo ( $am_idx % 4 ) * 80; ?>">
                    
                    <!-- TONE 1: HEADER BAR (Icon Solid di Kiri + Judul & Kicker di Sampingnya) -->
                    <div class="px-5 py-4 sm:px-6 sm:py-5 <?php echo esc_attr( $theme['header_bg'] ); ?> flex items-center gap-3.5">
                        <!-- Solid App Icon Box -->
                        <div class="w-12 h-12 rounded-2xl <?php echo esc_attr( $theme['icon_solid'] ); ?> flex items-center justify-center shrink-0 group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300">
                            <?php if ( $a_icon === 'users' ) : ?>
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <?php elseif ( $a_icon === 'shield' ) : ?>
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <?php elseif ( $a_icon === 'lock' ) : ?>
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <?php elseif ( $a_icon === 'star' ) : ?>
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            <?php elseif ( $a_icon === 'award' ) : ?>
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                            <?php else : ?>
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <?php endif; ?>
                        </div>

                        <!-- Judul di Samping Icon -->
                        <div class="min-w-0 flex-1">
                            <h3 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white leading-snug <?php echo esc_attr( $theme['title'] ); ?> transition-colors">
                                <?php echo esc_html( $a_title ); ?>
                            </h3>
                        </div>
                    </div>

                    <!-- TONE 2: CARD BODY (Keterangan Rapi & Watermark Logo Interaktif) -->
                    <div class="p-5 sm:p-6 relative flex-grow flex flex-col justify-between overflow-hidden bg-white dark:bg-slate-900/95">
                        <!-- Sliding Watermark Logo on Hover -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-36 h-36 opacity-[0.045] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.08] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>

                        <div class="relative z-10">
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                                <?php echo esc_html( $a_desc ); ?>
                            </p>
                        </div>
                    </div>

                    <!-- TONE 3: FOOTER BAR (Tag Komitmen Pelayanan dengan Checkmark) -->
                    <?php if ( ! empty( $a_tag ) ) : ?>
                        <div class="px-5 sm:px-6 py-3.5 <?php echo esc_attr( $theme['footer_bg'] ); ?> flex items-center justify-between gap-2 text-xs font-semibold relative z-10">
                            <span class="truncate"><?php echo esc_html( $a_tag ); ?></span>
                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full <?php echo esc_attr( $theme['badge_icon'] ); ?> shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </span>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     MODAL LIGHTBOX 1: PRATINJAU PETA INTERAKTIF
     Position Fixed Mutlak ke Viewport (Centering Layar Penuh Tanpa Scroll)
     ======================================== -->
<div id="kantor-map-modal" class="fixed inset-0 z-[99999] hidden items-center justify-center p-3 sm:p-5 md:p-6" role="dialog" aria-modal="true" aria-labelledby="map-modal-title" style="position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important;">
    <!-- Backdrop Blur with Animation -->
    <div id="kantor-map-backdrop" class="absolute inset-0 bg-slate-950/80 backdrop-blur-md transition-opacity duration-300 opacity-0 cursor-pointer"></div>

    <!-- Modal Box Container (Center Viewport & Responsive Max Height) -->
    <div id="kantor-map-container" class="relative z-10 w-full max-w-4xl max-h-[92vh] flex flex-col bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden transform scale-95 opacity-0 transition-all duration-300">
        <!-- Modal Header -->
        <div class="px-5 sm:px-6 py-4 bg-slate-50 dark:bg-slate-800/90 border-b border-slate-100 dark:border-slate-700/80 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary-50 dark:bg-primary-950/40 border border-primary-200 dark:border-primary-800/40 flex items-center justify-center text-primary-600 dark:text-teal-300 shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <span id="map-modal-tipe" class="text-[10px] uppercase tracking-widest font-extrabold text-primary-600 dark:text-teal-400 block">Kantor Operasional</span>
                    <h4 id="map-modal-title" class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white leading-tight">Pratinjau Peta Lokasi</h4>
                </div>
            </div>

            <!-- Close Button -->
            <button type="button" id="kantor-map-close-btn" class="w-9 h-9 rounded-full bg-slate-200/80 hover:bg-slate-300 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 flex items-center justify-center transition-colors shrink-0" aria-label="Tutup Peta">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Address Bar in Modal -->
        <div class="px-5 sm:px-6 py-2.5 bg-slate-100/70 dark:bg-slate-800/40 border-b border-slate-200/50 dark:border-slate-800 flex items-center justify-between text-xs text-slate-600 dark:text-slate-300 shrink-0">
            <div class="flex items-center gap-2 truncate pr-4">
                <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span id="map-modal-alamat" class="truncate font-medium">Memuat lokasi kantor...</span>
            </div>
            <a id="map-modal-external-link" href="#" target="_blank" rel="noopener noreferrer" class="font-bold text-primary-600 dark:text-teal-400 hover:underline flex-shrink-0 inline-flex items-center gap-1">
                Buka Tab Penuh
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>

        <!-- Google Maps Iframe Embed Area (Explicit Solid Height & Absolute Full Inset) -->
        <div class="relative w-full h-[380px] sm:h-[440px] md:h-[480px] bg-slate-100 dark:bg-slate-950 overflow-hidden">
            <!-- Loading Spinner Indicator -->
            <div id="map-modal-loading" class="absolute inset-0 flex flex-col items-center justify-center gap-3 bg-slate-100 dark:bg-slate-950 text-slate-400 z-10 transition-opacity duration-300">
                <svg class="w-8 h-8 text-primary-500 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-xs font-semibold">Memuat peta satelit &amp; rute...</span>
            </div>

            <iframe 
                id="kantor-map-iframe" 
                class="absolute inset-0 w-full h-full border-0 z-20" 
                src="about:blank" 
                allowfullscreen="" 
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>

        <!-- Modal Footer Actions -->
        <div class="px-5 sm:px-6 py-4 bg-slate-50 dark:bg-slate-800/90 border-t border-slate-100 dark:border-slate-700/80 flex flex-col sm:flex-row items-center justify-between gap-3 shrink-0">
            <span class="text-xs text-slate-500 dark:text-slate-400 text-center sm:text-left">
                Gunakan fitur zoom dan geser pada peta, atau buka di aplikasi Maps untuk navigasi langsung.
            </span>
            <div class="flex items-center gap-2.5 w-full sm:w-auto">
                <button type="button" id="kantor-map-footer-close" class="btn-secondary text-xs sm:text-sm px-4 py-2 rounded-xl flex-1 sm:flex-initial">
                    Tutup
                </button>
                <a id="map-modal-gmaps-btn" href="#" target="_blank" rel="noopener noreferrer" class="btn-primary text-xs sm:text-sm px-5 py-2 rounded-xl inline-flex items-center justify-center gap-1.5 flex-1 sm:flex-initial shadow-md">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Mulai Navigasi</span>
                </a>
            </div>
        </div>
    </div>
</div>


<!-- ========================================
     MODAL LIGHTBOX 2: DETAIL KANTOR & FOTO UTUH PROPORSIONAL
     Position Fixed Mutlak ke Viewport (Centering Layar Penuh Tanpa Scroll)
     ======================================== -->
<div id="kantor-detail-modal" class="fixed inset-0 z-[99999] hidden items-center justify-center p-3 sm:p-5 md:p-6" role="dialog" aria-modal="true" aria-labelledby="kantor-detail-title" style="position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important;">
    <!-- Backdrop Blur with Animation -->
    <div id="kantor-detail-backdrop" class="absolute inset-0 bg-slate-950/85 backdrop-blur-md transition-opacity duration-300 opacity-0 cursor-pointer"></div>

    <!-- Modal Box Container (Centered Viewport, Responsive Max Height) -->
    <div id="kantor-detail-container" class="relative z-10 w-full max-w-4xl max-h-[92vh] flex flex-col bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200/90 dark:border-slate-800 overflow-hidden transform scale-95 opacity-0 transition-all duration-300">
        
        <!-- Header -->
        <div class="px-5 sm:px-6 py-4 bg-gradient-to-r from-teal-50/90 via-cyan-50/40 to-white dark:from-teal-950/70 dark:via-slate-800/80 dark:to-slate-900 border-b border-teal-100/80 dark:border-slate-800 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-teal-500/10 dark:bg-teal-400/10 border border-teal-500/20 flex items-center justify-center text-teal-600 dark:text-teal-400 shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span id="kantor-detail-tipe" class="text-[10px] sm:text-[11px] uppercase tracking-widest font-extrabold text-teal-700 dark:text-teal-400">Kantor Cabang</span>
                        <span class="text-slate-300 dark:text-slate-600">•</span>
                        <span id="kantor-detail-status" class="inline-flex items-center gap-1 text-[10px] sm:text-[11px] font-bold text-emerald-600 dark:text-emerald-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span id="kantor-detail-status-text">Beroperasi Normal</span>
                        </span>
                    </div>
                    <h3 id="kantor-detail-title" class="text-base sm:text-lg md:text-xl font-extrabold text-slate-900 dark:text-white leading-tight">
                        Nama Kantor BPRS Wakalumi
                    </h3>
                </div>
            </div>

            <!-- Close Button -->
            <button type="button" id="kantor-detail-close-btn" class="w-9 h-9 rounded-full bg-slate-200/80 hover:bg-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 flex items-center justify-center transition-colors shrink-0" aria-label="Tutup Detail">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Scrollable Modal Body -->
        <div class="flex-1 overflow-y-auto p-5 sm:p-6 space-y-6">
            
            <!-- Foto Proporsional (Sesuai Ukuran Asli Upload Tanpa Terpotong) -->
            <div class="relative rounded-2xl bg-slate-950/90 dark:bg-black/95 p-2 sm:p-3 border border-slate-800/80 shadow-inner flex flex-col items-center justify-center overflow-hidden">
                <div class="w-full flex items-center justify-center max-h-[380px] sm:max-h-[440px] overflow-hidden rounded-xl">
                    <img 
                        id="kantor-detail-img" 
                        src="" 
                        alt="Foto Gedung Kantor" 
                        class="w-auto h-auto max-h-[380px] sm:max-h-[440px] max-w-full object-contain mx-auto shadow-2xl transition-all duration-300"
                    >
                </div>
                <!-- Subtitle Pill on Photo -->
                <div class="mt-2.5 flex items-center justify-between w-full px-2 text-[11px] text-slate-400">
                    <span class="inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Foto Kantor</span>
                    </span>
                    <span id="kantor-detail-kota-pill" class="text-teal-300 font-semibold">Tangerang Selatan</span>
                </div>
            </div>

            <!-- Detail Grid Info (2 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <!-- Alamat Lengkap Box -->
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/60 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[11px] uppercase tracking-wider font-extrabold text-slate-400 dark:text-slate-500">Alamat Resmi Operasional</span>
                            <button 
                                type="button" 
                                id="kantor-detail-copy-btn" 
                                class="text-[11px] font-bold text-teal-600 dark:text-teal-400 hover:underline inline-flex items-center gap-1 transition-colors"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                <span id="kantor-detail-copy-label">Salin Alamat</span>
                            </button>
                        </div>
                        <p id="kantor-detail-alamat" class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed font-medium">
                            -
                        </p>
                    </div>
                    <div class="mt-3 pt-2.5 border-t border-slate-200/60 dark:border-slate-700/50 flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                        <svg class="w-4 h-4 text-teal-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span id="kantor-detail-kota-full">Tangerang Selatan, Banten</span>
                    </div>
                </div>

                <!-- Jam & Kontak Box -->
                <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/60 space-y-3">
                    <!-- Jam Operasional -->
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-teal-50 dark:bg-teal-950/40 text-teal-600 dark:text-teal-400 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <span class="block text-[10px] uppercase tracking-wider font-extrabold text-slate-400 dark:text-slate-500">Jam Layanan</span>
                            <span id="kantor-detail-jam" class="text-xs sm:text-sm font-semibold text-slate-800 dark:text-slate-200">Senin - Jumat: 08.00 - 15.00 WIB</span>
                        </div>
                    </div>

                    <!-- Telepon -->
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <span class="block text-[10px] uppercase tracking-wider font-extrabold text-slate-400 dark:text-slate-500">Telepon Kantor</span>
                            <a id="kantor-detail-tel-link" href="#" class="text-xs sm:text-sm font-semibold text-slate-800 dark:text-slate-200 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">
                                <span id="kantor-detail-tel">-</span>
                            </a>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.03-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </div>
                        <div>
                            <span class="block text-[11px] uppercase tracking-wider font-extrabold text-slate-400 dark:text-slate-500">WhatsApp Pelayanan</span>
                            <a id="kantor-detail-wa-link" href="#" target="_blank" rel="noopener noreferrer" class="text-xs sm:text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:underline transition-all inline-flex items-center gap-1">
                                <span id="kantor-detail-wa">-</span>
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Fasilitas & Layanan Box -->
            <div id="kantor-detail-layanan-wrapper" class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/60">
                <span class="text-[11px] uppercase tracking-wider font-extrabold text-slate-400 dark:text-slate-500 block mb-2.5">
                    Fasilitas &amp; Layanan di Kantor Ini
                </span>
                <div id="kantor-detail-layanan-container" class="flex flex-wrap gap-1.5">
                    <!-- Dynamic badges rendered here via JS -->
                </div>
            </div>

        </div>

        <!-- Modal Footer Actions -->
        <div class="px-5 sm:px-6 py-4 bg-slate-50 dark:bg-slate-800/90 border-t border-slate-100 dark:border-slate-700/80 flex flex-col sm:flex-row items-center justify-between gap-3 shrink-0">
            <button type="button" id="kantor-detail-footer-close" class="btn-secondary text-xs sm:text-sm px-4 py-2.5 rounded-xl w-full sm:w-auto">
                Tutup
            </button>
            <div class="flex items-center gap-2.5 w-full sm:w-auto">
                <!-- Switch to Map Modal -->
                <button type="button" id="kantor-detail-open-map-btn" class="py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold inline-flex items-center justify-center gap-1.5 bg-slate-200 hover:bg-slate-300 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-100 transition-colors flex-1 sm:flex-initial">
                    <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" /></svg>
                    <span>Intip Peta</span>
                </button>
                <!-- Buka Maps Eksternal -->
                <a id="kantor-detail-gmaps-link" href="#" target="_blank" rel="noopener noreferrer" class="btn-primary text-xs sm:text-sm px-5 py-2.5 rounded-xl inline-flex items-center justify-center gap-1.5 flex-1 sm:flex-initial shadow-md">
                    <svg class="w-4 h-4 text-teal-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <span>Rute Google Maps</span>
                </a>
            </div>
        </div>

    </div>
</div>

<!-- Auto-Teleport Modals ke <body> (Mencegah transform trap dari #swup) -->
<script>
(function(){
    var m1 = document.getElementById('kantor-map-modal');
    var m2 = document.getElementById('kantor-detail-modal');
    if (m1 && m1.parentElement !== document.body) document.body.appendChild(m1);
    if (m2 && m2.parentElement !== document.body) document.body.appendChild(m2);
})();
</script>


<!-- ========================================
     SECTION: CALL TO ACTION (CTA)
     ======================================== -->
<?php if ( $cta_show === '1' ) : ?>
<section class="relative z-10 py-16 md:py-24 bg-white dark:bg-dark border-t border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="relative rounded-3xl p-8 sm:p-12 md:p-16 overflow-hidden bg-gradient-to-br from-primary-900 via-primary-950 to-slate-950 text-white shadow-2xl shadow-primary-900/20 border border-primary-500/30 text-center" data-aos="zoom-in">
            <!-- Background Decorative Watermark Emblem -->
            <div class="absolute right-0 bottom-0 translate-x-1/4 translate-y-1/4 w-80 h-80 opacity-[0.06] pointer-events-none">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-full h-full object-contain">
            </div>

            <!-- Glowing Orbs -->
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
                    <?php if ( ! empty( $cta_btn1_text ) ) : ?>
                        <a href="<?php echo esc_url( $cta_btn1_url ); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="btn-primary text-sm sm:text-base px-8 py-4 rounded-xl shadow-lg shadow-primary-500/25 inline-flex items-center gap-2.5 font-bold hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <span><?php echo esc_html( $cta_btn1_text ); ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if ( ! empty( $cta_btn2_text ) ) : ?>
                        <a href="<?php echo esc_url( $cta_btn2_url ); ?>"
                           class="btn-secondary text-sm sm:text-base px-8 py-4 rounded-xl border border-white/20 bg-white/10 hover:bg-white/20 text-white inline-flex items-center gap-2 font-bold backdrop-blur-sm transition-all hover:scale-105">
                            <span><?php echo esc_html( $cta_btn2_text ); ?></span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
get_footer();
