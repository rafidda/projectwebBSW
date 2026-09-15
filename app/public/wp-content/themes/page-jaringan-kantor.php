<?php
/**
 * Template Name: Jaringan Kantor
 * Description: Halaman Jaringan Kantor & Layanan BPRS Wakalumi
 *              Menampilkan Kantor Pusat Operasional, Kantor Kas, dan Kantor Layanan
 *              dilengkapi filter kategori, kartu kontak interaktif, dan modal pratinjau peta.
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

// ── DAFTAR KANTOR DEFAULT (FALLBACK JIKA BELUM ADA DI DATABASE) ───
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

// Hitung jumlah per kategori untuk badge filter
$categories_count = [
    'all'     => count( $kantor_list ),
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
     HEADER BANNER & BREADCRUMBS
     ======================================== -->
<section class="relative z-10 pt-8 pb-12 md:pb-16 overflow-hidden bg-slate-50 dark:bg-dark-surface border-b border-slate-200/60 dark:border-slate-800/60">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-72 bg-gradient-to-b from-primary-500/10 via-teal-500/5 to-transparent blur-3xl pointer-events-none"></div>

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
            <span class="text-primary-600 dark:text-teal-400 font-bold">Jaringan Kantor</span>
        </nav>

        <div class="max-w-4xl" data-aos="fade-up">
            <!-- Kicker Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full mb-5 bg-primary-500/10 dark:bg-primary-400/10 border border-primary-500/20 dark:border-primary-400/20">
                <span class="w-2 h-2 rounded-full bg-primary-500 dark:bg-teal-400 animate-pulse"></span>
                <span class="text-xs font-bold uppercase tracking-wider text-primary-700 dark:text-teal-300">
                    <?php echo esc_html( $page_badge ); ?>
                </span>
            </div>

            <!-- Page Title -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-[1.15] mb-5">
                <?php echo esc_html( $page_title ); ?>
            </h1>

            <!-- Subtitle -->
            <?php if ( ! empty( $page_subtitle ) ) : ?>
                <p class="text-base sm:text-lg md:text-xl text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl mb-8">
                    <?php echo esc_html( $page_subtitle ); ?>
                </p>
            <?php endif; ?>

            <!-- 3 Quick Stats Counter Bar -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 max-w-3xl pt-2">
                <!-- Stat 1 -->
                <div class="flex items-center gap-3 p-3.5 sm:p-4 rounded-2xl bg-white/90 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/80 shadow-sm backdrop-blur-sm">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 dark:bg-teal-950/40 border border-teal-200 dark:border-teal-800/50 flex items-center justify-center text-teal-600 dark:text-teal-400 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div>
                        <div class="text-base sm:text-lg font-black text-slate-900 dark:text-white leading-tight">
                            <?php echo esc_html( $stat1_num ); ?>
                        </div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 leading-tight mt-0.5">
                            <?php echo esc_html( $stat1_label ); ?>
                        </div>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="flex items-center gap-3 p-3.5 sm:p-4 rounded-2xl bg-white/90 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/80 shadow-sm backdrop-blur-sm">
                    <div class="w-10 h-10 rounded-xl bg-primary-50 dark:bg-primary-950/40 border border-primary-200 dark:border-primary-800/50 flex items-center justify-center text-primary-600 dark:text-teal-400 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base sm:text-lg font-black text-slate-900 dark:text-white leading-tight">
                            <?php echo esc_html( $stat2_num ); ?>
                        </div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 leading-tight mt-0.5">
                            <?php echo esc_html( $stat2_label ); ?>
                        </div>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="flex items-center gap-3 p-3.5 sm:p-4 rounded-2xl bg-white/90 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/80 shadow-sm backdrop-blur-sm">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800/50 flex items-center justify-center text-amber-600 dark:text-amber-400 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-base sm:text-lg font-black text-slate-900 dark:text-white leading-tight">
                            <?php echo esc_html( $stat3_num ); ?>
                        </div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 leading-tight mt-0.5">
                            <?php echo esc_html( $stat3_label ); ?>
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
                    Kantor & Titik Layanan
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

        <!-- Office Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 items-stretch" id="kantor-grid">
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
                    data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>"
                >
                    <!-- Card Media / Photo Area -->
                    <div class="relative h-56 sm:h-60 w-full overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-950 flex-shrink-0">
                        <?php if ( ! empty( $foto ) ) : ?>
                            <img 
                                src="<?php echo esc_url( $foto ); ?>" 
                                alt="<?php echo esc_attr( $nama ); ?>"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                loading="lazy"
                                onerror="this.onerror=null; this.parentElement.classList.add('is-fallback'); this.style.display='none';"
                            >
                        <?php endif; ?>

                        <!-- Fallback Graphic if no photo or photo fails to load -->
                        <div class="card-photo-fallback absolute inset-0 <?php echo ! empty( $foto ) ? 'hidden' : 'flex'; ?> flex-col items-center justify-center p-6 text-center bg-gradient-to-br from-teal-900/90 via-primary-950/95 to-slate-900 text-white">
                            <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 backdrop-blur-md flex items-center justify-center mb-3 shadow-inner group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-widest text-teal-200/80">BPRS Wakalumi</span>
                            <span class="text-sm font-extrabold text-white mt-0.5 line-clamp-1"><?php echo esc_html( $nama ); ?></span>
                        </div>

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent pointer-events-none"></div>

                        <!-- Top Badges Floating -->
                        <div class="absolute top-4 left-4 right-4 flex items-center justify-between pointer-events-none z-10">
                            <!-- Type Badge -->
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md shadow-sm <?php 
                                if ( $cat_filter === 'pusat' ) {
                                    echo 'bg-teal-600/90 text-white border border-teal-400/30';
                                } elseif ( $cat_filter === 'kas' ) {
                                    echo 'bg-blue-600/90 text-white border border-blue-400/30';
                                } else {
                                    echo 'bg-indigo-600/90 text-white border border-indigo-400/30';
                                }
                            ?>">
                                <?php echo esc_html( $tipe ); ?>
                            </span>

                            <!-- Status Dot Badge -->
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-900/80 text-teal-300 border border-teal-500/30 backdrop-blur-md">
                                <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                                <?php echo esc_html( $status ); ?>
                            </span>
                        </div>

                        <!-- Bottom Location Tag on Photo -->
                        <?php if ( ! empty( $kota ) ) : ?>
                            <div class="absolute bottom-3.5 left-4 z-10 flex items-center gap-1.5 text-xs font-semibold text-white/95">
                                <svg class="w-3.5 h-3.5 text-teal-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span><?php echo esc_html( $kota ); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 md:p-7 flex flex-col flex-grow justify-between relative bg-white dark:bg-slate-900">
                        <!-- Upper Info -->
                        <div>
                            <!-- Office Name -->
                            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white leading-tight mb-3 group-hover:text-primary-600 dark:group-hover:text-teal-300 transition-colors">
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
                                        Fasilitas & Layanan
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
     SECTION: 4-PILLAR TRUST & AMENITIES
     ======================================== -->
<section class="relative z-10 py-12 md:py-16 bg-white dark:bg-dark border-b border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="text-center max-w-3xl mx-auto mb-10 md:mb-12" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300 border border-teal-100 dark:border-teal-800/30 mb-3">
                Standar Kenyamanan Nasabah
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Komitmen Pelayanan di Seluruh Jaringan Kantor
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-2">
                Setiap kantor kami dirancang memberikan lingkungan yang ramah, nyaman, dan mengedepankan keamanan serta keberkahan syariah.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
            <!-- Pillar 1 -->
            <div class="p-6 rounded-2xl bg-slate-50/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="50">
                <div class="w-12 h-12 rounded-2xl bg-teal-100 dark:bg-teal-950/60 text-teal-700 dark:text-teal-300 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">Lokasi Strategis</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                    Terletak di kawasan niaga utama yang mudah diakses dengan kendaraan pribadi maupun sarana transportasi umum.
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="p-6 rounded-2xl bg-slate-50/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 rounded-2xl bg-primary-100 dark:bg-primary-950/60 text-primary-700 dark:text-teal-300 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">Layanan Ramah & Beretika</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                    Customer Service dan teller berpengalaman menyambut Anda dengan prinsip keramahan syariah dan profesionalisme tinggi.
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="p-6 rounded-2xl bg-slate-50/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="150">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">Diawasi OJK & DPS</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                    Seluruh operasional kantor berada dalam pengawasan Otoritas Jasa Keuangan (OJK) serta kepatuhan fatwa DSN-MUI.
                </p>
            </div>

            <!-- Pillar 4 -->
            <div class="p-6 rounded-2xl bg-slate-50/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">Simpanan Dijamin LPS</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                    Setiap simpanan nasabah dijamin Lembaga Penjamin Simpanan (LPS) hingga Rp 2 Miliar per nasabah per bank.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- ========================================
     MODAL LIGHTBOX: PRATINJAU PETA INTERAKTIF (ON DEMAND)
     ======================================== -->
<div id="kantor-map-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4 sm:p-6 md:p-8" role="dialog" aria-modal="true" aria-labelledby="map-modal-title">
    <!-- Backdrop Blur with Animation -->
    <div id="kantor-map-backdrop" class="absolute inset-0 bg-slate-950/80 backdrop-blur-md transition-opacity duration-300 opacity-0"></div>

    <!-- Modal Box Container -->
    <div id="kantor-map-container" class="relative z-10 w-full max-w-4xl bg-white dark:bg-slate-900 rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden transform scale-95 opacity-0 transition-all duration-300">
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/90 border-b border-slate-100 dark:border-slate-700/80 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-primary-50 dark:bg-primary-950/40 border border-primary-200 dark:border-primary-800/40 flex items-center justify-center text-primary-600 dark:text-teal-300">
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
            <button type="button" id="kantor-map-close-btn" class="w-9 h-9 rounded-full bg-slate-200/80 hover:bg-slate-300 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 flex items-center justify-center transition-colors" aria-label="Tutup Peta">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Address Bar in Modal -->
        <div class="px-6 py-2.5 bg-slate-100/70 dark:bg-slate-800/40 border-b border-slate-200/50 dark:border-slate-800 flex items-center justify-between text-xs text-slate-600 dark:text-slate-300">
            <div class="flex items-center gap-2 truncate pr-4">
                <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span id="map-modal-alamat" class="truncate font-medium">Memuat lokasi kantor...</span>
            </div>
            <a id="map-modal-external-link" href="#" target="_blank" rel="noopener noreferrer" class="font-bold text-primary-600 dark:text-teal-400 hover:underline flex-shrink-0 inline-flex items-center gap-1">
                Buka Tab Penuh
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>

        <!-- Google Maps Iframe Embed Area -->
        <div class="relative w-full h-80 sm:h-96 md:h-[420px] bg-slate-100 dark:bg-slate-950">
            <!-- Loading Spinner Indicator -->
            <div id="map-modal-loading" class="absolute inset-0 flex flex-col items-center justify-center gap-3 bg-slate-100 dark:bg-slate-950 text-slate-400 z-10 transition-opacity duration-300">
                <svg class="w-8 h-8 text-primary-500 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-xs font-semibold">Memuat peta satelit & rute...</span>
            </div>

            <iframe 
                id="kantor-map-iframe" 
                class="w-full h-full border-0 relative z-20" 
                src="about:blank" 
                loading="lazy" 
                allowfullscreen="" 
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>

        <!-- Modal Footer Actions -->
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/90 border-t border-slate-100 dark:border-slate-700/80 flex flex-col sm:flex-row items-center justify-between gap-3">
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
     SECTION: CALL TO ACTION (CTA)
     ======================================== -->
<?php if ( $cta_show === '1' ) : ?>
<section class="relative z-10 py-16 md:py-24 bg-gradient-to-br from-primary-900 via-primary-950 to-slate-950 text-white overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(45,212,191,0.15),transparent_50%)] pointer-events-none"></div>

    <div class="container-wide relative z-10">
        <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full mb-5 bg-teal-400/15 border border-teal-400/30 text-teal-300 text-xs font-bold uppercase tracking-wider">
                <span class="w-2 h-2 rounded-full bg-teal-400 animate-ping"></span>
                <?php echo esc_html( $cta_badge ); ?>
            </div>

            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight mb-5 leading-tight">
                <?php echo esc_html( $cta_title ); ?>
            </h2>

            <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto mb-8">
                <?php echo esc_html( $cta_desc ); ?>
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <?php if ( ! empty( $cta_btn1_text ) ) : ?>
                    <a href="<?php echo esc_url( $cta_btn1_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn-primary text-xs sm:text-sm px-7 py-3.5 rounded-2xl shadow-xl shadow-primary-500/25 inline-flex items-center gap-2 w-full sm:w-auto justify-center font-bold">
                        <svg class="w-5 h-5 text-teal-200" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <?php echo esc_html( $cta_btn1_text ); ?>
                    </a>
                <?php endif; ?>

                <?php if ( ! empty( $cta_btn2_text ) ) : ?>
                    <a href="<?php echo esc_url( $cta_btn2_url ); ?>" class="btn-secondary text-xs sm:text-sm px-7 py-3.5 rounded-2xl inline-flex items-center gap-2 w-full sm:w-auto justify-center bg-white/10 hover:bg-white/20 text-white border border-white/20 font-bold">
                        <?php echo esc_html( $cta_btn2_text ); ?>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
get_footer();

