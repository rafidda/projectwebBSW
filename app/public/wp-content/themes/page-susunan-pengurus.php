<?php
/**
 * Template Name: Susunan Pengurus
 * Description: Halaman Susunan Pengurus / Jajaran Kepemimpinan BPRS Wakalumi
 *              "Sticky Scroll-Driven Executive Spotlight" (Stage & Floating Dock Parallax)
 *
 * @package Wakalumi
 */

get_header();

// ── AMBIL DATA PENGATURAN HALAMAN DARI WP_OPTIONS ─────────────────
$page_badge    = get_option( 'options_pengurus_page_badge', 'Susunan Pengurus' );
$page_title    = get_option( 'options_pengurus_page_title', 'Jajaran Kepemimpinan BPRS Wakalumi' );
$page_subtitle = get_option( 'options_pengurus_page_subtitle', 'Dipimpin oleh para profesional berpengalaman yang berkomitmen pada prinsip perbankan syariah, tata kelola yang baik (GCG), dan pelayanan terbaik bagi nasabah.' );
$page_intro    = get_option( 'options_pengurus_page_intro', 'Sesuai dengan prinsip Good Corporate Governance (GCG), BPRS Wakalumi menghadirkan transparansi penuh atas jajaran kepemimpinan yang menjaga amanah nasabah dan integritas operasional perbankan syariah.' );

// ── DAFTAR PENGURUS DEFAULT (4 TOKOH DENGAN FOTO CROPPED) ─────────
$default_pengurus = [
    [
        'nama'          => 'H. Rudi Dogar Harahap',
        'kategori'      => 'Dewan Komisaris',
        'jabatan'       => 'Komisaris Utama',
        'foto'          => get_template_directory_uri() . '/assets/img/pengurus/komisaris-utama.png',
        'riwayat_karir' => 'Profesional perbankan senior dengan pengalaman lebih dari 25 tahun di industri perbankan nasional dan keuangan syariah. Memiliki rekam jejak kepemimpinan strategis dalam pengawasan tata kelola perusahaan perbankan syariah yang sehat, prudent, dan berkelanjutan.',
        'pendidikan'    => 'S1 Ekonomi & Manajemen Perbankan',
        'sertifikasi'   => 'Sertifikasi Komisaris BPR/BPRS (OJK), Manajemen Risiko Perbankan Tingkat II',
        'kutipan'       => 'Tata kelola yang baik dan prinsip kehati-hatian adalah kunci pertumbuhan berkelanjutan bank syariah.',
        'status'        => 'Aktif',
        'urutan'        => 1,
    ],
    [
        'nama'          => 'Arief Rachmat Dian Boediono',
        'kategori'      => 'Dewan Komisaris',
        'jabatan'       => 'Komisaris',
        'foto'          => get_template_directory_uri() . '/assets/img/pengurus/komisaris.png',
        'riwayat_karir' => 'Berpengalaman luas di bidang keuangan korporasi, audit internal, dan pengawasan kepatuhan regulasi perbankan. Berperan aktif memastikan seluruh kebijakan dan operasional BPRS Wakalumi senantiasa mematuhi standar OJK dan prinsip perlindungan nasabah.',
        'pendidikan'    => 'S1 Manajemen Keuangan & Perbankan',
        'sertifikasi'   => 'Sertifikasi Komisaris BPR/BPRS (OJK), Sertifikasi Kepatuhan Perbankan',
        'kutipan'       => 'Kepatuhan regulasi dan integritas pengawasan adalah fondasi utama kepercayaan nasabah.',
        'status'        => 'Aktif',
        'urutan'        => 2,
    ],
    [
        'nama'          => 'H. Abdul Rokhim',
        'kategori'      => 'Dewan Pengawas Syariah',
        'jabatan'       => 'Ketua Dewan Pengawas Syariah',
        'foto'          => get_template_directory_uri() . '/assets/img/pengurus/dps-ketua.png',
        'riwayat_karir' => 'Ulama dan pakar fikih muamalah dengan pengalaman lebih dari 20 tahun di bidang fatwa keuangan Islam. Aktif sebagai narasumber forum perbankan syariah nasional serta pengajar dalam program sertifikasi DPS yang diselenggarakan Dewan Syariah Nasional (DSN-MUI).',
        'pendidikan'    => 'S1 Syariah, Universitas Islam Negeri (UIN)',
        'sertifikasi'   => 'Sertifikasi Dewan Pengawas Syariah (DSN-MUI), Ahli Perbankan Syariah',
        'kutipan'       => 'Menjaga kemurnian prinsip syariah bukan sekadar kewajiban hukum, melainkan amanah ukhrawi.',
        'status'        => 'Aktif',
        'urutan'        => 3,
    ],
    [
        'nama'          => 'Fathan Budiman',
        'kategori'      => 'Dewan Pengawas Syariah',
        'jabatan'       => 'Anggota Dewan Pengawas Syariah',
        'foto'          => get_template_directory_uri() . '/assets/img/pengurus/dps-anggota.png',
        'riwayat_karir' => 'Memiliki keahlian mendalam dalam fikih muamalah kontemporer dan harmonisasi hukum positif dengan fatwa DSN-MUI. Berkontribusi aktif memastikan setiap akad produk pembiayaan dan pendanaan BPRS Wakalumi bebas dari unsur riba, gharar, dan maisir.',
        'pendidikan'    => 'S1 Hukum Ekonomi Syariah (Muamalah)',
        'sertifikasi'   => 'Sertifikasi Dewan Pengawas Syariah (DSN-MUI)',
        'kutipan'       => 'Inovasi produk keuangan harus senantiasa berpijak kokoh pada kaidah-kaidah syariah.',
        'status'        => 'Aktif',
        'urutan'        => 4,
    ],
];

$pengurus_list = get_option( 'options_pengurus_list', false );
if ( empty( $pengurus_list ) || ! is_array( $pengurus_list ) ) {
    $pengurus_list = $default_pengurus;
}

// Sort by urutan
usort( $pengurus_list, function( $a, $b ) {
    return ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 );
});

// Group counts for stats
$count_dps = 0;
$count_kom = 0;
$count_dir = 0;
foreach ( $pengurus_list as $p ) {
    $kat = $p['kategori'] ?? '';
    if ( $kat === 'Dewan Pengawas Syariah' ) $count_dps++;
    elseif ( $kat === 'Dewan Komisaris' ) $count_kom++;
    elseif ( $kat === 'Direksi' ) $count_dir++;
}

// Category styling config
$cat_config = [
    'Dewan Pengawas Syariah' => [
        'color'      => 'emerald',
        'badge_bg'   => 'bg-emerald-500/10 dark:bg-emerald-400/10 text-emerald-700 dark:text-emerald-300 border-emerald-500/20',
        'glow'       => 'shadow-emerald-500/20',
        'ring'       => 'ring-emerald-400',
        'accent_bar' => 'from-emerald-400 to-teal-500',
        'abbr'       => 'DPS',
    ],
    'Dewan Komisaris' => [
        'color'      => 'teal',
        'badge_bg'   => 'bg-primary-500/10 dark:bg-primary-400/10 text-primary-700 dark:text-teal-300 border-primary-500/20',
        'glow'       => 'shadow-primary-500/20',
        'ring'       => 'ring-primary-400',
        'accent_bar' => 'from-teal-400 to-primary-600',
        'abbr'       => 'KOM',
    ],
    'Direksi' => [
        'color'      => 'amber',
        'badge_bg'   => 'bg-amber-500/10 dark:bg-amber-400/10 text-amber-700 dark:text-amber-300 border-amber-500/20',
        'glow'       => 'shadow-amber-500/20',
        'ring'       => 'ring-amber-400',
        'accent_bar' => 'from-amber-400 to-orange-500',
        'abbr'       => 'DIR',
    ],
];

// Org Chart
$show_orgchart  = get_option( 'options_pengurus_orgchart_show', '1' );
$orgchart_image = get_option( 'options_pengurus_orgchart_image', '' );
$orgchart_desc  = get_option( 'options_pengurus_orgchart_desc', 'Struktur hierarki dan tata kelola BPRS Wakalumi yang menghubungkan Rapat Umum Pemegang Saham (RUPS), Dewan Komisaris, Dewan Pengawas Syariah, dan Direksi.' );

// CTA
$show_cta      = get_option( 'options_pengurus_cta_show', '1' );
$cta_badge     = get_option( 'options_pengurus_cta_badge', 'Bergabung Bersama Kami' );
$cta_title     = get_option( 'options_pengurus_cta_title', 'Siap Mempercayakan Dana Anda pada Kepemimpinan Profesional Syariah?' );
$cta_desc      = get_option( 'options_pengurus_cta_desc', 'Konsultasikan kebutuhan perbankan syariah Anda bersama tim profesional BPRS Wakalumi, atau temukan solusi simpanan dan pembiayaan yang tepat untuk masa depan finansial Anda.' );
$cta_btn1_text = get_option( 'options_pengurus_cta_btn1_text', 'Hubungi via WhatsApp' );
$cta_btn1_url  = get_option( 'options_pengurus_cta_btn1_url', '' );
$cta_btn2_text = get_option( 'options_pengurus_cta_btn2_text', 'Jelajahi Produk Kami' );
$cta_btn2_url  = get_option( 'options_pengurus_cta_btn2_url', home_url( '/produk' ) );

$wa_number = get_option( 'options_contact_wa', '6281517380388' );
$wa_url    = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );
if ( empty( $cta_btn1_url ) ) {
    $cta_btn1_url = $wa_url;
}

$total_members = count( $pengurus_list );
?>

<!-- ========================================
     HEADER BANNER & BREADCRUMBS
     ======================================== -->
<section class="relative pt-8 pb-14 md:pb-20 overflow-hidden bg-slate-50 dark:bg-dark-surface border-b border-slate-200/60 dark:border-slate-800/60">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-72 bg-gradient-to-b from-primary-500/10 via-teal-500/5 to-transparent blur-3xl pointer-events-none"></div>

    <div class="container-wide relative z-10">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-accent transition-colors flex items-center gap-1.5 font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-slate-600 dark:text-slate-300 font-medium">Profil</span>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-primary-600 dark:text-teal-400 font-bold">Susunan Pengurus</span>
        </nav>

        <div class="max-w-4xl" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full mb-5 bg-primary-500/10 dark:bg-primary-400/10 border border-primary-500/20 dark:border-primary-400/20">
                <span class="w-2 h-2 rounded-full bg-primary-500 dark:bg-teal-400 animate-pulse"></span>
                <span class="text-xs font-bold uppercase tracking-wider text-primary-700 dark:text-teal-300">
                    <?php echo esc_html( $page_badge ); ?>
                </span>
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-[1.15] mb-5">
                <?php echo esc_html( $page_title ); ?>
            </h1>

            <?php if ( ! empty( $page_subtitle ) ) : ?>
                <p class="text-base sm:text-lg md:text-xl text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                    <?php echo esc_html( $page_subtitle ); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- ========================================
     GCG STATS BAR
     ======================================== -->
<section class="relative -mt-8 mb-8 md:mb-12">
    <div class="container-wide">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4" data-aos="fade-up" data-aos-delay="100">
            <!-- Total Pengurus -->
            <div class="relative rounded-2xl bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 p-4 md:p-5 text-center shadow-sm hover:shadow-md transition-shadow group">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-primary-500/10 dark:bg-primary-400/10 text-primary-600 dark:text-teal-400 mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                </div>
                <div class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    <?php echo esc_html( $total_members ); ?>
                </div>
                <div class="text-xs md:text-sm text-slate-600 dark:text-slate-200 font-medium mt-1">Total Pengurus Aktif</div>
            </div>

            <!-- DPS -->
            <div class="relative rounded-2xl bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 p-4 md:p-5 text-center shadow-sm hover:shadow-md transition-shadow group">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                </div>
                <div class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    <?php echo esc_html( $count_dps ); ?>
                </div>
                <div class="text-xs md:text-sm text-slate-600 dark:text-slate-200 font-medium mt-1">Pengawas Syariah</div>
            </div>

            <!-- Komisaris -->
            <div class="relative rounded-2xl bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 p-4 md:p-5 text-center shadow-sm hover:shadow-md transition-shadow group">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-teal-500/10 text-primary-600 dark:text-teal-400 mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                </div>
                <div class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    <?php echo esc_html( $count_kom ); ?>
                </div>
                <div class="text-xs md:text-sm text-slate-600 dark:text-slate-200 font-medium mt-1">Dewan Komisaris</div>
            </div>

            <!-- Direksi (Proses OJK) -->
            <div class="relative rounded-2xl bg-white dark:bg-slate-900/95 border border-amber-200/60 dark:border-amber-700/60 p-4 md:p-5 text-center shadow-sm hover:shadow-md transition-shadow group">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="text-lg md:text-xl font-bold text-amber-600 dark:text-amber-400 tracking-tight leading-tight mt-1">
                    Izin OJK
                </div>
                <div class="text-xs text-amber-600/90 dark:text-amber-300 font-medium mt-1.5">Fit & Proper Test</div>
            </div>
        </div>
    </div>
</section>


<!-- ========================================
     GCG INTRO NARRATIVE
     ======================================== -->
<?php if ( ! empty( $page_intro ) ) : ?>
<section class="mb-10 md:mb-14">
    <div class="container-wide">
        <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
            <p class="text-sm md:text-base text-slate-600 dark:text-slate-400 leading-relaxed font-normal">
                <?php echo esc_html( $page_intro ); ?>
            </p>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================================================
     DESKTOP: STICKY SCROLL-DRIVEN EXECUTIVE SPOTLIGHT (Stage & Floating Dock)
     Visible on lg+ screens (>= 1024px)
     ======================================================================== -->
<?php if ( $total_members > 0 ) : 
    // Calculate total scroll height based on number of members (100vh base + 75vh per additional member)
    $scroll_height_vh = 100 + ( ( $total_members - 1 ) * 75 );
?>
<section id="executive-spotlight-section" 
         class="hidden lg:block relative" 
         style="height: <?php echo $scroll_height_vh; ?>vh;"
         data-total-members="<?php echo $total_members; ?>">

    <!-- STICKY VIEWPORT CONTAINER -->
    <div id="executive-sticky-stage" 
         class="sticky top-20 h-[calc(100vh-5rem)] flex items-center overflow-hidden py-4 z-10">

        <div class="container-wide w-full h-full flex flex-col justify-center relative z-10">

            <!-- Top Stage Bar: Category Filter / Jump + Progress -->
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-200/60 dark:border-slate-800/60">
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Sorotan Kepemimpinan:</span>
                    <div id="exec-category-pills" class="flex items-center gap-2">
                        <button type="button" class="exec-filter-btn active px-3 py-1 rounded-full text-xs font-semibold transition-all bg-primary-600 text-white shadow-sm" data-filter="all">Semua (<?php echo $total_members; ?>)</button>
                        <button type="button" class="exec-filter-btn px-3 py-1 rounded-full text-xs font-semibold transition-all bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700" data-filter="Dewan Komisaris">Komisaris</button>
                        <button type="button" class="exec-filter-btn px-3 py-1 rounded-full text-xs font-semibold transition-all bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700" data-filter="Dewan Pengawas Syariah">DPS</button>
                    </div>
                </div>

                <!-- Progress Counter & Controls -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <span id="exec-current-counter" class="text-base font-extrabold text-primary-600 dark:text-teal-400">01</span>
                        <span class="text-xs text-slate-400">/</span>
                        <span class="text-xs font-semibold text-slate-500 dark:text-slate-400"><?php echo sprintf( '%02d', $total_members ); ?></span>
                    </div>
                    <!-- Stepper Buttons -->
                    <div class="flex items-center gap-1.5">
                        <button type="button" id="exec-btn-prev" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-primary-50 dark:hover:bg-primary-900/30 text-slate-700 dark:text-slate-300 flex items-center justify-center transition-all disabled:opacity-30 disabled:pointer-events-none" aria-label="Sebelumnya">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button type="button" id="exec-btn-next" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-primary-50 dark:hover:bg-primary-900/30 text-slate-700 dark:text-slate-300 flex items-center justify-center transition-all disabled:opacity-30 disabled:pointer-events-none" aria-label="Selanjutnya">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- MAIN STAGE GRID: LEFT SPOTLIGHT + RIGHT FLOATING DOCK -->
            <div class="grid grid-cols-12 gap-8 items-center flex-1 max-h-[calc(100vh-12rem)]">

                <!-- ══════════════════════════════════════════════════════
                     LEFT COLUMN: ACTIVE EXECUTIVE SPOTLIGHT STAGE (Col 8)
                     ══════════════════════════════════════════════════════ -->
                <div class="col-span-8 h-full flex flex-col justify-center">
                    <div id="exec-spotlight-card" 
                         class="relative rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-2xl p-6 lg:p-8 flex flex-col justify-between transition-all duration-500">

                        <!-- Top Gradient Accent Bar -->
                        <div id="exec-spotlight-bar" class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-teal-400 to-primary-600 transition-all duration-500"></div>

                        <!-- Main Spotlight Content -->
                        <div class="grid grid-cols-12 gap-6 items-start">
                            
                            <!-- Left: Big Portrait Showcase -->
                            <div class="col-span-4 flex flex-col items-center text-center">
                                <div class="relative w-44 h-44 xl:w-48 xl:h-48 rounded-3xl p-1 bg-gradient-to-br from-teal-400/40 via-primary-500/20 to-transparent shadow-xl">
                                    <div class="w-full h-full rounded-[22px] overflow-hidden bg-slate-100 dark:bg-slate-800 border-2 border-white/80 dark:border-slate-700">
                                        <img id="exec-spotlight-img" 
                                             src="<?php echo esc_url( $pengurus_list[0]['foto'] ?? '' ); ?>" 
                                             alt="<?php echo esc_attr( $pengurus_list[0]['nama'] ?? '' ); ?>" 
                                             class="w-full h-full object-cover transition-opacity duration-300">
                                    </div>
                                    <!-- Status Dot Badge -->
                                    <div id="exec-spotlight-status-dot" class="absolute -bottom-2 -right-2 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-500 text-white shadow-md flex items-center gap-1.5 border-2 border-white dark:border-slate-900">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                        <span id="exec-spotlight-status-text">Aktif</span>
                                    </div>
                                </div>

                                <!-- Category Badge -->
                                <div class="mt-4">
                                    <span id="exec-spotlight-category" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-primary-500/10 text-primary-700 dark:bg-primary-400/10 dark:text-teal-300 border border-primary-500/20">
                                        <?php echo esc_html( $pengurus_list[0]['kategori'] ?? '' ); ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Right: Name, Titles, and Rich Dossier -->
                            <div class="col-span-8 flex flex-col">
                                <!-- Role & Full Name -->
                                <div class="mb-4">
                                    <div id="exec-spotlight-role" class="text-sm font-bold text-primary-600 dark:text-teal-400 tracking-wide uppercase mb-1">
                                        <?php echo esc_html( $pengurus_list[0]['jabatan'] ?? '' ); ?>
                                    </div>
                                    <h2 id="exec-spotlight-name" class="text-2xl xl:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-snug">
                                        <?php echo esc_html( $pengurus_list[0]['nama'] ?? '' ); ?>
                                    </h2>
                                </div>

                                <!-- Dossier Tabs / Content: Karir, Pendidikan, Sertifikasi -->
                                <div class="space-y-3 pr-2 overflow-y-auto max-h-[calc(100vh-25rem)] custom-scroll">
                                    <!-- Career Narrative -->
                                    <div>
                                        <div class="flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-teal-400 mb-1">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                            Riwayat & Rekam Jejak
                                        </div>
                                        <p id="exec-spotlight-karir" class="text-sm text-slate-700 dark:text-slate-100 leading-relaxed font-normal">
                                            <?php echo esc_html( $pengurus_list[0]['riwayat_karir'] ?? '' ); ?>
                                        </p>
                                    </div>

                                    <!-- Education & Certification (2 cols) -->
                                    <div class="grid grid-cols-2 gap-3 pt-2">
                                        <div class="rounded-xl bg-slate-50 dark:bg-slate-800/90 p-3 border border-slate-100 dark:border-slate-700">
                                            <div class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-teal-300 mb-1">
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342"/></svg>
                                                Pendidikan
                                            </div>
                                            <p id="exec-spotlight-pendidikan" class="text-xs font-semibold text-slate-800 dark:text-white">
                                                <?php echo esc_html( $pengurus_list[0]['pendidikan'] ?? '' ); ?>
                                            </p>
                                        </div>

                                        <div class="rounded-xl bg-slate-50 dark:bg-slate-800/90 p-3 border border-slate-100 dark:border-slate-700">
                                            <div class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-teal-300 mb-1">
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                                                Sertifikasi
                                            </div>
                                            <p id="exec-spotlight-sertifikasi" class="text-xs font-semibold text-slate-800 dark:text-white">
                                                <?php echo esc_html( $pengurus_list[0]['sertifikasi'] ?? '' ); ?>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Integrity Quote -->
                                    <div id="exec-spotlight-quote-wrap" class="pt-2 border-t border-slate-100 dark:border-slate-800">
                                        <blockquote class="relative pl-3 border-l-2 border-primary-400 dark:border-teal-500">
                                            <p id="exec-spotlight-quote" class="text-xs italic text-slate-600 dark:text-slate-200 leading-relaxed">
                                                "<?php echo esc_html( $pengurus_list[0]['kutipan'] ?? '' ); ?>"
                                            </p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bottom Progress Bar -->
                        <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                            <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden mr-4">
                                <div id="exec-stage-progress-bar" class="bg-gradient-to-r from-teal-400 to-primary-600 h-full rounded-full transition-all duration-300" style="width: <?php echo ( 1 / $total_members ) * 100; ?>%;"></div>
                            </div>
                            <span class="text-[11px] text-slate-400 dark:text-slate-300 whitespace-nowrap">Scroll untuk berpindah tokoh</span>
                        </div>
                    </div>
                </div>


                <!-- ══════════════════════════════════════════════════════
                     RIGHT COLUMN: THE FLOATING EXECUTIVE DOCK (Col 4)
                     All other members in a sleek interactive mini-card stack
                     ══════════════════════════════════════════════════════ -->
                <div class="col-span-4 h-full flex flex-col justify-center">
                    <div id="exec-floating-dock" 
                         class="rounded-3xl bg-slate-50 dark:bg-slate-900/90 border border-slate-200/80 dark:border-slate-700/80 p-4 shadow-xl flex flex-col gap-2.5 overflow-y-auto max-h-[calc(100vh-14rem)]">
                        
                        <div class="flex items-center justify-between px-2 pb-2 border-b border-slate-200/60 dark:border-slate-700/80">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-300">Jajaran Dewan</span>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-primary-500/10 text-primary-600 dark:text-teal-400">Klik untuk sorot</span>
                        </div>

                        <!-- Mini Cards List -->
                        <div id="exec-dock-items" class="space-y-2">
                            <?php foreach ( $pengurus_list as $index => $item ) : 
                                $is_first = ( $index === 0 );
                                $kategori = $item['kategori'] ?? 'Dewan Komisaris';
                                $cfg      = $cat_config[ $kategori ] ?? $cat_config['Dewan Komisaris'];
                            ?>
                            <div class="exec-dock-card group relative p-3 rounded-2xl transition-all duration-300 cursor-pointer flex items-center gap-3.5 
                                 <?php echo $is_first ? 'active bg-white dark:bg-slate-800 shadow-lg ring-2 ring-primary-500/80 dark:ring-teal-400/80 border-transparent' : 'bg-white/90 dark:bg-slate-800/70 border border-slate-200/60 dark:border-slate-700/70 hover:bg-white dark:hover:bg-slate-800 hover:shadow-md opacity-90 hover:opacity-100'; ?>"
                                 data-index="<?php echo $index; ?>"
                                 data-kategori="<?php echo esc_attr( $kategori ); ?>">
                                 
                                <!-- Mini Thumbnail -->
                                <div class="relative shrink-0 w-12 h-12 rounded-xl overflow-hidden bg-slate-200 dark:bg-slate-700 border border-slate-200 dark:border-slate-600">
                                    <?php if ( ! empty( $item['foto'] ) ) : ?>
                                        <img src="<?php echo esc_url( $item['foto'] ); ?>" 
                                             alt="<?php echo esc_attr( $item['nama'] ); ?>" 
                                             class="w-full h-full object-cover">
                                    <?php else : ?>
                                        <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs font-bold">
                                            <?php echo esc_html( $cfg['abbr'] ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Text Info -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-1.5 mb-0.5">
                                        <span class="text-[10px] font-extrabold uppercase px-1.5 py-0.2 rounded <?php echo $cfg['badge_bg']; ?>">
                                            <?php echo esc_html( $cfg['abbr'] ); ?>
                                        </span>
                                        <span class="text-[11px] font-semibold text-slate-500 dark:text-teal-300 truncate">
                                            <?php echo esc_html( $item['jabatan'] ); ?>
                                        </span>
                                    </div>
                                    <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate">
                                        <?php echo esc_html( $item['nama'] ); ?>
                                    </h4>
                                </div>

                                <!-- Active Indicator Badge -->
                                <div class="dock-active-dot shrink-0 <?php echo $is_first ? 'flex' : 'hidden'; ?> items-center">
                                    <span class="w-2 h-2 rounded-full bg-primary-500 dark:bg-teal-400 animate-ping"></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================================================
     MOBILE & TABLET VIEW: EXECUTIVE SPOTLIGHT & SWIPE CAROUSEL (< 1024px)
     Smooth touch-driven showcase with bottom sheet/expanded card
     ======================================================================== -->
<section id="exec-mobile-showcase" class="block lg:hidden py-8 px-4 bg-white dark:bg-dark border-b border-slate-100 dark:border-slate-800">
    <div class="max-w-xl mx-auto">
        
        <!-- Mobile Header & Stepper -->
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-bold uppercase tracking-wider text-primary-600 dark:text-teal-400">Jajaran Pengurus</span>
            <div class="flex items-center gap-2">
                <span id="mob-exec-counter" class="text-xs font-bold text-slate-700 dark:text-slate-200">1 dari <?php echo $total_members; ?></span>
            </div>
        </div>

        <!-- Mobile Horizontal Selector Pills -->
        <div class="flex items-center gap-2 overflow-x-auto pb-3 mb-4 scrollbar-none">
            <?php foreach ( $pengurus_list as $mi => $item ) : ?>
            <button type="button" 
                    class="mob-exec-pill shrink-0 px-3 py-1.5 rounded-full text-xs font-semibold transition-all <?php echo $mi === 0 ? 'bg-primary-600 text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-200'; ?>"
                    data-mob-index="<?php echo $mi; ?>">
                <?php echo esc_html( $item['nama'] ); ?>
            </button>
            <?php endforeach; ?>
        </div>

        <!-- Mobile Active Spotlight Card -->
        <div id="mob-exec-card" class="rounded-3xl bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 p-6 shadow-lg relative overflow-hidden">
            <div id="mob-exec-bar" class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-teal-400 to-primary-600"></div>

            <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 rounded-2xl overflow-hidden bg-slate-200 dark:bg-slate-700 shrink-0 border-2 border-primary-500/30 dark:border-teal-500/40">
                    <img id="mob-exec-img" src="<?php echo esc_url( $pengurus_list[0]['foto'] ?? '' ); ?>" alt="" class="w-full h-full object-cover">
                </div>
                <div>
                    <span id="mob-exec-role" class="text-xs font-bold text-primary-600 dark:text-teal-400 uppercase">
                        <?php echo esc_html( $pengurus_list[0]['jabatan'] ?? '' ); ?>
                    </span>
                    <h3 id="mob-exec-name" class="text-lg font-bold text-slate-900 dark:text-white leading-tight">
                        <?php echo esc_html( $pengurus_list[0]['nama'] ?? '' ); ?>
                    </h3>
                    <span id="mob-exec-kategori" class="text-[10px] font-semibold text-slate-500 dark:text-teal-300">
                        <?php echo esc_html( $pengurus_list[0]['kategori'] ?? '' ); ?>
                    </span>
                </div>
            </div>

            <!-- Mobile Dossier Details -->
            <div class="space-y-3 pt-3 border-t border-slate-200/60 dark:border-slate-700/80">
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-teal-400 mb-1">Riwayat & Pengalaman</div>
                    <p id="mob-exec-karir" class="text-xs text-slate-700 dark:text-slate-100 leading-relaxed">
                        <?php echo esc_html( $pengurus_list[0]['riwayat_karir'] ?? '' ); ?>
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-2 pt-1">
                    <div class="rounded-lg bg-slate-50 dark:bg-slate-800/90 p-2.5 border border-slate-100 dark:border-slate-700">
                        <div class="text-[9px] font-bold uppercase text-slate-400 dark:text-teal-300">Pendidikan</div>
                        <p id="mob-exec-pendidikan" class="text-[11px] font-semibold text-slate-800 dark:text-white mt-0.5">
                            <?php echo esc_html( $pengurus_list[0]['pendidikan'] ?? '' ); ?>
                        </p>
                    </div>
                    <div class="rounded-lg bg-slate-50 dark:bg-slate-800/90 p-2.5 border border-slate-100 dark:border-slate-700">
                        <div class="text-[9px] font-bold uppercase text-slate-400 dark:text-teal-300">Sertifikasi</div>
                        <p id="mob-exec-sertifikasi" class="text-[11px] font-semibold text-slate-800 dark:text-white mt-0.5">
                            <?php echo esc_html( $pengurus_list[0]['sertifikasi'] ?? '' ); ?>
                        </p>
                    </div>
                </div>

                <blockquote id="mob-exec-quote-wrap" class="pl-3 border-l-2 border-teal-500 pt-1">
                    <p id="mob-exec-quote" class="text-xs italic text-slate-600 dark:text-slate-200">
                        "<?php echo esc_html( $pengurus_list[0]['kutipan'] ?? '' ); ?>"
                    </p>
                </blockquote>
            </div>

            <!-- Mobile Controls -->
            <div class="flex items-center justify-between mt-5 pt-3 border-t border-slate-200/60 dark:border-slate-700/80">
                <button type="button" id="mob-btn-prev" class="px-4 py-2 rounded-xl bg-white dark:bg-slate-800 text-xs font-bold text-slate-700 dark:text-slate-200 shadow-sm border border-slate-200 dark:border-slate-700 flex items-center gap-1">
                    ← Sebelumnya
                </button>
                <button type="button" id="mob-btn-next" class="px-4 py-2 rounded-xl bg-primary-600 text-xs font-bold text-white shadow-sm flex items-center gap-1">
                    Selanjutnya →
                </button>
            </div>
        </div>
    </div>
</section>


<!-- ========================================
     DIREKSI TRANSPARENCY CARD (OJK STATUS)
     Mandatory governance note on director vacancy
     ======================================== -->
<section class="py-12 md:py-16 bg-slate-50 dark:bg-dark-surface border-y border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="max-w-4xl mx-auto rounded-3xl overflow-hidden border border-amber-200/80 dark:border-amber-800/40 bg-gradient-to-br from-amber-50/90 via-white to-amber-50/40 dark:from-amber-950/20 dark:via-dark-surface dark:to-amber-950/10 shadow-sm p-6 sm:p-8 md:p-10" data-aos="fade-up">
            
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 mb-5">
                <div class="w-14 h-14 rounded-2xl bg-amber-100 dark:bg-amber-400/10 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                </div>
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-100 dark:bg-amber-400/10 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-700/40 mb-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                        Keterbukaan Informasi Regulasi
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                        Posisi Direktur dalam Proses Penilaian Kemampuan & Kepatutan (Fit & Proper Test) OJK
                    </h3>
                </div>
            </div>

            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed mb-6 font-normal">
                Sesuai dengan POJK tentang Penilaian Kemampuan dan Kepatutan bagi Pihak Utama Lembaga Jasa Keuangan, posisi Direktur BPRS Wakalumi saat ini tengah menjalani tahapan proses perizinan resmi di <strong>Otoritas Jasa Keuangan (OJK)</strong>. 
                Seluruh aktivitas operasional dan pelayanan perbankan kepada nasabah tetap berjalan dengan pengawasan penuh dari <strong>Dewan Komisaris</strong> dan <strong>Dewan Pengawas Syariah (DPS)</strong>.
            </p>

            <div class="flex flex-wrap items-center gap-3">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-white dark:bg-slate-800 border border-amber-200 dark:border-amber-700/40 text-xs font-semibold text-amber-800 dark:text-amber-300 shadow-sm">
                    <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                    Kepatuhan Tata Kelola OJK
                </span>
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-300 shadow-sm">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    Operasional Bank Berjalan Normal & Aman
                </span>
            </div>
        </div>
    </div>
</section>


<!-- ========================================
     BAGAN STRUKTUR ORGANISASI (OPTIONAL)
     ======================================== -->
<?php if ( $show_orgchart && ! empty( $orgchart_image ) ) : ?>
<section class="py-14 md:py-20 bg-white dark:bg-dark border-b border-slate-100 dark:border-slate-800">
    <div class="container-wide">
        <div class="text-center mb-8" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-primary-500/10 text-primary-700 dark:bg-primary-400/10 dark:text-teal-300 border border-primary-500/20 dark:border-primary-400/20 mb-3">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                Bagan Struktur Organisasi
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Struktur Organisasi Perusahaan
            </h2>
            <?php if ( ! empty( $orgchart_desc ) ) : ?>
                <p class="text-sm md:text-base text-slate-600 dark:text-slate-300 mt-3 max-w-2xl mx-auto font-normal">
                    <?php echo esc_html( $orgchart_desc ); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="max-w-4xl mx-auto" data-aos="zoom-in" data-aos-delay="100">
            <div class="rounded-3xl overflow-hidden border border-slate-200/80 dark:border-slate-700/80 shadow-xl bg-slate-50 dark:bg-slate-900/95 cursor-pointer group relative" id="orgchart-container">
                <img src="<?php echo esc_url( $orgchart_image ); ?>" 
                     alt="Bagan Struktur Organisasi BPRS Wakalumi" 
                     class="w-full h-auto group-hover:scale-[1.02] transition-transform duration-500"
                     loading="lazy">
                <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/10 transition-colors flex items-center justify-center pointer-events-none">
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity px-4 py-2 rounded-full bg-white/90 dark:bg-slate-800/95 text-xs font-bold text-slate-900 dark:text-white shadow-lg backdrop-blur-sm">
                        🔍 Klik untuk memperbesar
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     CTA SECTION
     ======================================== -->
<?php if ( $show_cta ) : ?>
<section class="py-16 md:py-24 bg-white dark:bg-dark border-t border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="relative rounded-3xl p-8 sm:p-12 md:p-16 overflow-hidden bg-gradient-to-br from-primary-900 via-primary-950 to-slate-950 text-white shadow-2xl shadow-primary-900/20 border border-primary-500/30 text-center" data-aos="zoom-in">
            <div class="absolute right-0 bottom-0 translate-x-1/4 translate-y-1/4 w-80 h-80 opacity-[0.06] pointer-events-none">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-full h-full object-contain">
            </div>
            
            <div class="absolute -top-24 -left-24 w-72 h-72 bg-primary-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-teal-400/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-widest bg-white/10 backdrop-blur-md border border-white/20 text-teal-300 mb-6">
                    <span class="w-2 h-2 rounded-full bg-teal-400 animate-ping"></span>
                    <?php echo esc_html( $cta_badge ); ?>
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
<?php endif; ?>

<!-- Pass data to JS via JSON script -->
<script type="application/json" id="wkl-pengurus-data">
<?php echo json_encode( array_values( $pengurus_list ), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?>
</script>

<?php get_footer(); ?>
