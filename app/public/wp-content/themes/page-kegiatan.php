<?php
/**
 * Template Name: Halaman Kegiatan & Agenda Bank
 * Description: Portal Publikasi Jadwal Agenda Mendatang & Dokumentasi Kegiatan Bank Syariah Wakalumi (BSW)
 * 
 * @package Wakalumi
 */

get_header();

// ── DATA RETRIEVAL ──────────────────────────────────────────────────
$header      = wakalumi_get_kegiatan_header();
$empty_state = wakalumi_get_kegiatan_empty_state();
$categories  = wakalumi_get_kegiatan_categories();
$all_list    = wakalumi_get_kegiatan_list();

// Filter active items only
$kegiatan_list = array_values( array_filter( $all_list, function( $item ) {
    return ( $item['status'] ?? 'aktif' ) === 'aktif';
}) );

// Count stats
$count_all       = count( $kegiatan_list );
$count_upcoming  = count( array_filter( $kegiatan_list, fn($x) => ( $x['tipe_waktu'] ?? '' ) === 'mendatang' ) );
$count_completed = count( array_filter( $kegiatan_list, fn($x) => ( $x['tipe_waktu'] ?? '' ) === 'terlaksana' ) );

// Extract unique years
$years = [];
foreach ( $kegiatan_list as $item ) {
    $y = date( 'Y', strtotime( $item['tanggal_mulai'] ?? date( 'Y-m-d' ) ) );
    if ( $y && ! in_array( $y, $years, true ) ) {
        $years[] = $y;
    }
}
rsort( $years );

$wa_number = get_option( 'options_contact_wa', '6281517380388' );
$wa_url    = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );
?>

<div class="min-h-screen bg-transparent text-slate-800 dark:text-slate-200 pb-20">

    <!-- ========================================================================
         SECTION 1: HERO HEADER BANNER & GOVERNANCE BADGE CARD
         ======================================================================== -->
    <section class="wkl-page-hero">
        <!-- Ambient Background Glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-80 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

        <div class="container-wide relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-300 transition-colors flex items-center gap-1.5 font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <span class="text-slate-500 dark:text-slate-400 font-medium">Informasi</span>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <span class="text-teal-600 dark:text-teal-400 font-semibold">Kegiatan &amp; Agenda</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Left Column: Title & Intro -->
                <div class="lg:col-span-8" data-aos="fade-up">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        <?php echo esc_html( $header['badge'] ); ?>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                        <?php echo esc_html( $header['title'] ); ?>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                        <?php echo esc_html( $header['desc'] ); ?>
                    </p>

                    <!-- Key Trust Highlights Pills -->
                    <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                            <span>Edukasi &amp; Literasi Terbuka</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                            <span>Program CSR &amp; Filantropi Umat</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                            <span>Keterbukaan Tata Kelola (GCG)</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Dual-Tone Executive Trust Card with Slide Watermark -->
                <div class="lg:col-span-4" data-aos="fade-left" data-aos-delay="100">
                    <div class="spotlight-card relative overflow-hidden rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] text-center group cursor-default">
                        <div class="wkl-glass-shine"></div>

                        <!-- Top Dual-Tone Zone: Header, Icon & Title -->
                        <div class="relative px-6 pt-7 pb-5 bg-gradient-to-b from-teal-50/85 via-emerald-50/40 to-white dark:from-teal-950/45 dark:via-slate-900/80 dark:to-slate-900 border-b border-slate-100 dark:border-slate-800/80 overflow-hidden">
                            <!-- Subtle Top Accent Line -->
                            <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 via-emerald-400 to-teal-600 opacity-90"></div>

                            <!-- Interactive Slide Watermark Emblem -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-32 h-32 opacity-[0.04] dark:opacity-[0.03] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-110 group-hover:opacity-[0.07] dark:group-hover:opacity-[0.05] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                            </div>

                            <!-- Soft Dual-Tone Ring Calendar Icon -->
                            <div class="relative w-14 h-14 rounded-2xl bg-white dark:bg-slate-800 border border-teal-200/80 dark:border-teal-800/70 text-teal-600 dark:text-teal-300 flex items-center justify-center mx-auto mb-3.5 shadow-sm group-hover:bg-teal-600 group-hover:text-white group-hover:border-teal-600 group-hover:scale-105 transition-all duration-500 z-10">
                                <svg class="w-7 h-7 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                            </div>

                            <div class="relative z-10">
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/90 dark:bg-slate-800 text-teal-700 dark:text-teal-300 border border-teal-200/70 dark:border-teal-800/60 text-[10px] font-bold uppercase tracking-wider mb-1.5 shadow-2xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                    <?php echo esc_html( $header['card_badge'] ); ?>
                                </div>
                                <h4 class="text-lg font-extrabold text-slate-900 dark:text-white"><?php echo esc_html( $header['card_title'] ); ?></h4>
                            </div>
                        </div>

                        <!-- Bottom Dual-Tone Zone: Description, Reg Tags & Button -->
                        <div class="p-5 sm:px-6 bg-white dark:bg-slate-900/95 space-y-4 relative z-10">
                            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed text-center sm:text-left">
                                <?php echo esc_html( $header['card_desc'] ); ?>
                            </p>

                            <div class="pt-1 flex items-center justify-center gap-2">
                                <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    Diawasi OJK
                                </span>
                                <span class="text-slate-300 dark:text-slate-600">•</span>
                                <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    Prinsip Syariah
                                </span>
                            </div>

                            <div class="pt-1">
                                <a href="#kegiatan-time-filters" class="w-full py-2.5 px-4 rounded-xl bg-slate-50 hover:bg-teal-50/80 dark:bg-slate-800/80 dark:hover:bg-teal-950/50 border border-slate-200/80 hover:border-teal-300 dark:border-slate-700/80 dark:hover:border-teal-700 inline-flex items-center justify-center gap-2 text-xs font-bold text-teal-700 dark:text-teal-300 transition-all duration-300 group/kegbtn">
                                    <span>Lihat Agenda &amp; Kegiatan</span>
                                    <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/kegbtn:translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========================================================================
         SECTION 2: PRIMARY FILTER SWITCHER & SEARCH CONTROLS
         ======================================================================== -->
    <section class="py-6 sm:py-8 bg-transparent relative z-10 border-b border-slate-200/50 dark:border-dark-border/50">
        <div class="container-wide">
            
            <!-- Top Controls Row: Status Switcher Tabs + Search Box -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5 mb-5">
                
                <!-- Main Status Filter Switcher -->
                <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-1 lg:pb-0" id="kegiatan-time-filters">
                    <button type="button" data-status-filter="all" class="keg-status-btn active-tab px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-300 whitespace-nowrap bg-gradient-to-r from-teal-600 to-cyan-600 text-white shadow-md shadow-teal-600/20 border border-teal-500 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                        <span>Semua (<?php echo $count_all; ?>)</span>
                    </button>

                    <button type="button" data-status-filter="mendatang" class="keg-status-btn px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-300 whitespace-nowrap bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface-alt flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Agenda Mendatang (<?php echo $count_upcoming; ?>)</span>
                    </button>

                    <button type="button" data-status-filter="terlaksana" class="keg-status-btn px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-300 whitespace-nowrap bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface-alt flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        <span>Kegiatan Terlaksana (<?php echo $count_completed; ?>)</span>
                    </button>
                </div>

                <!-- Right Side: Live Search & Year Select -->
                <div class="flex items-center gap-3 w-full lg:w-auto flex-shrink-0">
                    <div class="relative flex-1 sm:w-72">
                        <input type="text" id="kegiatan-search-input" placeholder="Cari kegiatan, topik, lokasi..." class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/90 dark:bg-dark-card/90 border border-slate-200 dark:border-dark-border text-xs sm:text-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500/50 shadow-sm transition-all">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    <?php if ( ! empty( $years ) ) : ?>
                        <div class="relative flex-shrink-0">
                            <select id="kegiatan-year-filter" class="appearance-none pl-3.5 pr-8 py-2.5 rounded-xl bg-white/90 dark:bg-dark-card/90 border border-slate-200 dark:border-dark-border text-xs sm:text-sm font-bold text-slate-700 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-teal-500/50 shadow-sm cursor-pointer">
                                <option value="all">Semua Tahun</option>
                                <?php foreach ( $years as $yr ) : ?>
                                    <option value="<?php echo esc_attr( $yr ); ?>">Tahun <?php echo esc_html( $yr ); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <svg class="w-3.5 h-3.5 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- Bottom Sub-Row: Category Filter Pills -->
            <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pt-1" id="kegiatan-category-filters">
                <span class="text-xs font-bold text-slate-400 dark:text-slate-500 shrink-0 mr-1 hidden sm:inline">Kategori:</span>
                <button type="button" data-cat-filter="all" class="keg-cat-pill active-cat-pill px-3 py-1.5 rounded-lg text-xs font-bold transition-all duration-200 whitespace-nowrap bg-teal-500/20 text-teal-700 dark:text-teal-300 border border-teal-500/40">
                    Semua Kategori
                </button>
                <?php foreach ( $categories as $ckey => $cval ) : 
                    $cat_count = count( array_filter( $kegiatan_list, fn($x) => ( $x['kategori'] ?? '' ) === $ckey ) );
                    if ( $cat_count === 0 ) continue;
                ?>
                    <button type="button" data-cat-filter="<?php echo esc_attr( $ckey ); ?>" class="keg-cat-pill px-3 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200 whitespace-nowrap bg-white/80 dark:bg-dark-card/80 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface-alt">
                        <?php echo esc_html( $cval['pill_label'] ?? $cval['label'] ); ?>
                        <span class="opacity-60 text-[10px] ml-1">(<?php echo $cat_count; ?>)</span>
                    </button>
                <?php endforeach; ?>
            </div>

        </div>
    </section>


    <!-- ========================================================================
         SECTION 3: CARDS GRID, EMPTY STATES & RESULTS
         ======================================================================== -->
    <section class="py-10 md:py-14 bg-transparent relative z-10">
        <div class="container-wide">

            <!-- Active Filter Status Indicator (Shown when filtering/searching) -->
            <div id="kegiatan-filter-indicator" class="hidden mb-6 flex items-center justify-between text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                <span>Hasil pencarian &amp; filter: <strong id="kegiatan-result-count" class="text-teal-600 dark:text-teal-400 font-extrabold">0</strong> kegiatan ditemukan</span>
                <button type="button" id="kegiatan-reset-filter" class="text-teal-600 dark:text-teal-400 hover:underline font-bold">Reset Filter</button>
            </div>

            <!-- GRACEFUL EMPTY STATE: KHUSUS JIKA TAB AGENDA MENDATANG KOSONG -->
            <div id="kegiatan-upcoming-empty" class="<?php echo ( $count_upcoming === 0 ) ? '' : 'hidden'; ?> text-center py-12 px-6 sm:px-8 max-w-2xl mx-auto bg-white/90 dark:bg-dark-card/90 backdrop-blur-xl rounded-3xl border border-teal-200/80 dark:border-dark-border shadow-xl">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-300 flex items-center justify-center mx-auto mb-4 shadow-sm border border-teal-200/50 dark:border-teal-800/50">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">
                    <?php echo esc_html( $empty_state['title'] ); ?>
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                    <?php echo esc_html( $empty_state['desc'] ); ?>
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <button type="button" id="btn-switch-to-completed" class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-teal-600/20 transition-all hover:scale-[1.02] active:scale-[0.98] inline-flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                        <span>Lihat Dokumentasi Kegiatan Terlaksana (<?php echo $count_completed; ?>)</span>
                    </button>
                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-dark-surface dark:hover:bg-dark-surface-alt text-slate-700 dark:text-slate-300 font-semibold text-xs sm:text-sm border border-slate-200 dark:border-dark-border transition-colors inline-flex items-center justify-center gap-2">
                        <span><?php echo esc_html( $empty_state['cta'] ); ?></span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    </a>
                </div>
            </div>

            <!-- SEARCH EMPTY STATE (Shown when filter has 0 match) -->
            <div id="kegiatan-search-empty" class="hidden text-center py-16 px-4 bg-white/80 dark:bg-dark-card/80 backdrop-blur-md rounded-3xl border border-dashed border-slate-300 dark:border-dark-border">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-dark-surface text-slate-400 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Tidak Ada Kegiatan Ditemukan</h3>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 max-w-md mx-auto mb-4">
                    Tidak ada agenda atau dokumentasi kegiatan yang sesuai dengan kriteria filter yang Anda pilih.
                </p>
                <button type="button" class="btn-trigger-reset text-xs font-bold text-teal-600 dark:text-teal-400 hover:underline">
                    Kembalikan ke Semua Kegiatan
                </button>
            </div>

            <!-- Cards Grid (2-column layout on desktop) -->
            <div id="kegiatan-cards-grid" class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <?php foreach ( $kegiatan_list as $index => $item ) : 
                    $row_id      = esc_attr( $item['id'] ?? ( 'act_' . $index ) );
                    $judul       = $item['judul'] ?? '';
                    $kategori    = $item['kategori'] ?? 'edukasi';
                    $cat_info    = $categories[$kategori] ?? $categories['edukasi'];
                    $tipe_waktu  = $item['tipe_waktu'] ?? 'mendatang';
                    $is_upcoming = ( $tipe_waktu === 'mendatang' );
                    $raw_date    = $item['tanggal_mulai'] ?? date( 'Y-m-d' );
                    $date_year   = date( 'Y', strtotime( $raw_date ) );
                    $date_day    = date( 'd', strtotime( $raw_date ) );
                    $date_month  = strtoupper( date_i18n( 'M', strtotime( $raw_date ) ) );
                    $date_full   = date_i18n( 'd F Y', strtotime( $raw_date ) );
                    $waktu       = $item['waktu'] ?? '';
                    $lokasi      = $item['lokasi'] ?? '';
                    $maps_url    = $item['lokasi_maps_url'] ?? '';
                    $st_daftar   = $item['status_pendaftaran'] ?? 'buka';
                    $link_daftar = $item['link_pendaftaran'] ?? '';
                    $link_text   = ! empty( $item['link_text'] ) ? $item['link_text'] : 'Daftar Sekarang';
                    $gambar      = $item['gambar'] ?? '';
                    $ringkasan   = $item['ringkasan'] ?? '';
                    $isi_lengkap = $item['isi_lengkap'] ?? '';
                    $dok_url     = $item['dokumentasi_url'] ?? '';
                ?>
                    <article id="<?php echo $row_id; ?>"
                             class="kegiatan-card card group relative flex flex-col h-full bg-white dark:bg-dark-surface border <?php echo $is_upcoming ? 'border-emerald-200/90 dark:border-emerald-800/60 shadow-emerald-500/5 hover:border-emerald-400 dark:hover:border-emerald-500' : 'border-slate-200/80 dark:border-dark-border hover:border-teal-400 dark:hover:border-teal-600 shadow-teal-500/5'; ?> rounded-2xl md:rounded-3xl overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 before:absolute before:inset-x-0 before:top-0 before:h-1 before:bg-gradient-to-r before:from-transparent <?php echo $is_upcoming ? 'before:via-emerald-400' : 'before:via-teal-500'; ?> before:to-transparent before:opacity-0 group-hover:before:opacity-100 before:transition-opacity before:duration-500 z-10"
                             data-id="<?php echo $row_id; ?>"
                             data-status="<?php echo esc_attr( $tipe_waktu ); ?>"
                             data-category="<?php echo esc_attr( $kategori ); ?>"
                             data-year="<?php echo esc_attr( $date_year ); ?>"
                             data-title="<?php echo esc_attr( strtolower( $judul ) ); ?>"
                             data-content="<?php echo esc_attr( strtolower( $ringkasan . ' ' . $lokasi ) ); ?>"
                             data-aos="fade-up"
                             data-aos-delay="<?php echo min( 300, ( $index % 4 ) * 80 ); ?>">

                        <!-- Decorative Watermark Logo (Interactive Hover Effect) -->
                        <div class="absolute -right-6 -bottom-6 w-36 h-36 opacity-[0.055] dark:opacity-[0.04] pointer-events-none select-none overflow-hidden transition-all duration-700 ease-out group-hover:scale-125 group-hover:-translate-x-2 group-hover:-translate-y-2 group-hover:opacity-[0.11] dark:group-hover:opacity-[0.08] mix-blend-multiply dark:mix-blend-screen z-0">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" 
                                 alt="" 
                                 class="w-full h-full object-contain brightness-0 dark:brightness-100" 
                                 loading="lazy"
                                 aria-hidden="true">
                        </div>

                        <!-- Top Graphic Slot: Poster Image -->
                        <?php if ( ! empty( $gambar ) ) : ?>
                            <div class="relative w-full aspect-[16/10] overflow-hidden bg-slate-100 dark:bg-slate-800 shrink-0 group/img">
                                <img src="<?php echo esc_url( $gambar ); ?>"
                                     alt="<?php echo esc_attr( $judul ); ?>"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                     loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/15 to-transparent opacity-40 group-hover:opacity-60 transition-opacity duration-300"></div>
                                
                                <!-- Glass Glare Sweep Effect -->
                                <div class="wkl-glass-shine"></div>

                                <!-- Floating Big Calendar Date Badge -->
                                <div class="absolute top-3.5 left-3.5 flex flex-col items-center justify-center w-12 h-14 rounded-2xl bg-white/95 dark:bg-slate-900/95 text-slate-900 dark:text-white backdrop-blur-md shadow-lg border border-white/20 z-10 leading-none">
                                    <span class="text-base font-black tracking-tight text-teal-600 dark:text-teal-400"><?php echo esc_html( $date_day ); ?></span>
                                    <span class="text-[9px] font-extrabold uppercase text-slate-500 dark:text-slate-400 mt-0.5"><?php echo esc_html( $date_month ); ?></span>
                                </div>

                                <!-- Floating Status Pill (Akan Datang vs Terlaksana) -->
                                <div class="absolute top-3.5 right-3.5 z-10 flex items-center gap-1.5">
                                    <?php if ( $is_upcoming ) : ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-600/95 text-white backdrop-blur-md text-[10px] font-black uppercase tracking-wider shadow-md border border-white/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                            AKAN DATANG
                                        </span>
                                    <?php else : ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-900/85 dark:bg-slate-950/85 text-slate-300 backdrop-blur-md text-[10px] font-extrabold uppercase tracking-wider shadow-md border border-white/10">
                                            <svg class="w-3 h-3 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            TERLAKSANA
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Card Body with Internal Padding -->
                        <div class="p-6 sm:p-7 flex flex-col flex-1 relative z-10 justify-between">
                            <div>
                                <?php if ( empty( $gambar ) ) : ?>
                                    <!-- Fallback Top Row when No Image (Big Date + Category Pill + Status) -->
                                    <div class="flex items-center justify-between gap-3 mb-4">
                                        <div class="flex items-center gap-2.5">
                                            <div class="flex flex-col items-center justify-center w-11 h-12 rounded-xl bg-teal-50 dark:bg-teal-950/70 border border-teal-200 dark:border-teal-800 text-teal-700 dark:text-teal-300 leading-none">
                                                <span class="text-sm font-black"><?php echo esc_html( $date_day ); ?></span>
                                                <span class="text-[9px] font-extrabold uppercase mt-0.5"><?php echo esc_html( $date_month ); ?></span>
                                            </div>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border <?php echo esc_attr( $cat_info['badge_class'] ?? 'bg-teal-50 text-teal-700 border-teal-200' ); ?>">
                                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $cat_info['tag_dot'] ?? 'bg-teal-500' ); ?>"></span>
                                                <?php echo esc_html( $cat_info['label'] ?? 'Kegiatan Bank' ); ?>
                                            </span>
                                        </div>

                                        <div>
                                            <?php if ( $is_upcoming ) : ?>
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950/70 text-emerald-700 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800 text-[10px] font-black uppercase tracking-wider">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                    AKAN DATANG
                                                </span>
                                            <?php else : ?>
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-slate-100 dark:bg-dark-surface text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-dark-border text-[10px] font-bold uppercase">
                                                    TERLAKSANA
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <!-- Category Pill when Image Exists -->
                                    <div class="mb-3">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border <?php echo esc_attr( $cat_info['badge_class'] ?? 'bg-teal-50 text-teal-700 border-teal-200' ); ?>">
                                            <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $cat_info['tag_dot'] ?? 'bg-teal-500' ); ?>"></span>
                                            <?php echo esc_html( $cat_info['label'] ?? 'Kegiatan Bank' ); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <!-- Judul Kegiatan -->
                                <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white tracking-tight leading-snug group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors mb-3 cursor-pointer btn-open-keg-modal" data-id="<?php echo $row_id; ?>">
                                    <?php echo esc_html( $judul ); ?>
                                </h3>

                                <!-- Meta Row: Waktu & Lokasi -->
                                <div class="space-y-1.5 text-xs text-slate-500 dark:text-slate-400 mb-3.5 font-medium">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-3.5 h-3.5 text-teal-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span><?php echo esc_html( $date_full ); ?><?php echo ! empty( $waktu ) ? ' • ' . esc_html( $waktu ) : ''; ?></span>
                                    </div>
                                    <?php if ( ! empty( $lokasi ) ) : ?>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-3.5 h-3.5 text-teal-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                            <span class="truncate"><?php echo esc_html( $lokasi ); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Ringkasan Teks -->
                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-4 line-clamp-3">
                                    <?php echo esc_html( $ringkasan ); ?>
                                </p>
                            </div>

                            <!-- Footer Action Bar -->
                            <div class="pt-5 mt-4 border-t border-slate-100 dark:border-dark-border/80 flex items-center justify-between gap-2.5 flex-wrap">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <?php if ( $is_upcoming && ! empty( $link_daftar ) ) : ?>
                                        <a href="<?php echo esc_url( $link_daftar ); ?>"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 hover:bg-emerald-100 dark:hover:bg-emerald-900/60 border border-emerald-200/80 dark:border-emerald-700/60 transition-all">
                                            <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                            <span><?php echo esc_html( $link_text ); ?></span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if ( ! $is_upcoming && ! empty( $dok_url ) ) : ?>
                                        <a href="<?php echo esc_url( $dok_url ); ?>"
                                           class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold bg-purple-50 dark:bg-purple-950/40 text-purple-800 dark:text-purple-300 hover:bg-purple-100 dark:hover:bg-purple-900/60 border border-purple-200/80 dark:border-purple-700/60 transition-all">
                                            <svg class="w-3.5 h-3.5 text-purple-600 dark:text-purple-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                                            <span>Dokumentasi Foto</span>
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <!-- Open Lightbox Modal Button -->
                                <button type="button"
                                        class="btn-open-keg-modal inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-extrabold bg-teal-600 hover:bg-teal-700 text-white shadow-md shadow-teal-600/20 hover:shadow-teal-600/30 transition-all hover:scale-[1.02] active:scale-[0.98] shrink-0"
                                        data-id="<?php echo $row_id; ?>">
                                    <span>Lihat Rincian</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>

                        </div>

                        <!-- Hidden Data Store for Quick Reader Modal -->
                        <div class="kegiatan-modal-data hidden">
                            <span class="data-title"><?php echo esc_html( $judul ); ?></span>
                            <span class="data-category"><?php echo esc_html( $cat_info['label'] ?? 'Kegiatan Bank' ); ?></span>
                            <span class="data-category-badge"><?php echo esc_attr( $cat_info['badge_class'] ?? '' ); ?></span>
                            <span class="data-status"><?php echo esc_attr( $tipe_waktu ); ?></span>
                            <span class="data-date"><?php echo esc_html( $date_full ); ?></span>
                            <span class="data-time"><?php echo esc_html( $waktu ); ?></span>
                            <span class="data-location"><?php echo esc_html( $lokasi ); ?></span>
                            <span class="data-maps-url"><?php echo esc_url( $maps_url ); ?></span>
                            <span class="data-reg-status"><?php echo esc_attr( $st_daftar ); ?></span>
                            <span class="data-reg-url"><?php echo esc_url( $link_daftar ); ?></span>
                            <span class="data-reg-text"><?php echo esc_html( $link_text ); ?></span>
                            <span class="data-image"><?php echo esc_url( $gambar ); ?></span>
                            <div class="data-content"><?php echo nl2br( esc_html( $isi_lengkap ? $isi_lengkap : $ringkasan ) ); ?></div>
                        </div>

                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Client-Side Smart Pagination Container -->
            <div id="kegiatan-pagination-wrap" class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-slate-200/80 dark:border-dark-border hidden">
                <div id="kegiatan-pagination-info" class="text-xs sm:text-sm font-medium text-slate-500 dark:text-slate-400 text-center sm:text-left">
                    <!-- Populated by JS -->
                </div>
                <nav id="kegiatan-pagination-nav" class="flex items-center gap-1.5 flex-wrap justify-center" aria-label="Navigasi Halaman Kegiatan & Agenda">
                    <!-- Populated by JS -->
                </nav>
            </div>

        </div>
    </section>


    <!-- ========================================================================
         SECTION 4: QUICK READER MODAL (LIGHTBOX RINCIAN KEGIATAN & AGENDA)
         ======================================================================== -->
    <div id="kegiatan-detail-modal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4 sm:p-6 overflow-y-auto" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div id="kegiatan-modal-backdrop" class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-opacity duration-300 opacity-0"></div>

        <!-- Modal Card Container -->
        <div id="kegiatan-modal-card" class="relative z-10 w-full max-w-3xl my-auto bg-white dark:bg-dark-card rounded-3xl shadow-2xl border border-slate-200 dark:border-dark-border overflow-hidden transition-all duration-300 transform scale-95 opacity-0 flex flex-col max-h-[88vh]">
            
            <!-- Top Gradient Bar -->
            <div id="modal-keg-top-accent" class="h-2 w-full bg-gradient-to-r from-teal-500 via-emerald-400 to-teal-600 flex-shrink-0"></div>

            <!-- Modal Header -->
            <div class="p-6 sm:p-8 border-b border-slate-100 dark:border-dark-border/80 flex-shrink-0">
                <div class="flex items-center justify-between gap-4 mb-3">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span id="modal-keg-category" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border"></span>
                        <span id="modal-keg-status-badge" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase"></span>
                        <span id="modal-keg-date" class="text-xs font-semibold text-slate-500 dark:text-slate-400"></span>
                    </div>

                    <!-- Close Button -->
                    <button type="button" id="btn-close-keg-modal" class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-dark-surface text-slate-400 hover:text-slate-700 dark:hover:text-white flex items-center justify-center transition-colors" aria-label="Tutup Detail Kegiatan">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <h2 id="modal-keg-title" class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight leading-snug"></h2>

                <!-- Event Details Row (Time & Venue) -->
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div id="modal-keg-time-wrap" class="flex items-center gap-2.5 px-3 py-2 rounded-xl bg-slate-50 dark:bg-dark-surface border border-slate-200/60 dark:border-dark-border text-xs text-slate-600 dark:text-slate-300 font-medium">
                        <svg class="w-4 h-4 text-teal-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span id="modal-keg-time"></span>
                    </div>

                    <div id="modal-keg-loc-wrap" class="flex items-center justify-between gap-2 px-3 py-2 rounded-xl bg-slate-50 dark:bg-dark-surface border border-slate-200/60 dark:border-dark-border text-xs text-slate-600 dark:text-slate-300 font-medium">
                        <div class="flex items-center gap-2 truncate">
                            <svg class="w-4 h-4 text-teal-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                            <span id="modal-keg-loc" class="truncate"></span>
                        </div>
                        <a id="modal-keg-maps-btn" href="#" target="_blank" rel="noopener noreferrer" class="hidden text-teal-600 dark:text-teal-400 font-bold hover:underline shrink-0 text-[11px]">
                            Maps ↗
                        </a>
                    </div>
                </div>
            </div>

            <!-- Modal Content (Scrollable) -->
            <div id="modal-keg-scroll-area" class="p-6 sm:p-8 overflow-y-auto flex-1 space-y-6">
                <!-- Poster Banner Image (Genuine Aspect Ratio) -->
                <div id="modal-keg-image-wrap" class="hidden rounded-2xl overflow-hidden bg-slate-100 dark:bg-dark-surface border border-slate-200/80 dark:border-dark-border shadow-md flex flex-col items-center justify-center p-2.5 sm:p-3">
                    <img id="modal-keg-image" src="" alt="" class="max-w-full h-auto max-h-[60vh] sm:max-h-[500px] object-contain rounded-xl mx-auto shadow-xs">
                    <div class="mt-2.5 flex items-center justify-between w-full px-2 text-[11px] text-slate-400">
                        <span class="inline-flex items-center gap-1 font-medium">
                            <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                            Poster Resmi Kegiatan
                        </span>
                        <a id="modal-keg-image-full-link" href="#" target="_blank" class="text-teal-600 dark:text-teal-400 font-bold hover:underline inline-flex items-center gap-1">
                            <span>Buka Gambar Penuh</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Main Body Content / Rundown -->
                <div id="modal-keg-body" class="text-slate-700 dark:text-slate-300 text-sm sm:text-base leading-relaxed space-y-4"></div>

                <!-- Registration / Action Link Box -->
                <div id="modal-keg-action-box" class="hidden rounded-2xl p-4 sm:p-5 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-950/40 dark:to-teal-950/40 border border-emerald-200/80 dark:border-emerald-800/60 flex items-center justify-between gap-4 flex-wrap">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        </div>
                        <div>
                            <div class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white">Pendaftaran &amp; Informasi Kegiatan</div>
                            <div id="modal-keg-reg-status-text" class="text-xs text-slate-500 dark:text-slate-400">Pendaftaran dibuka untuk umum</div>
                        </div>
                    </div>
                    <a id="modal-keg-action-btn" href="" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-md shadow-emerald-600/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                        <span id="modal-keg-action-label">Daftar Sekarang</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 sm:p-5 bg-slate-50 dark:bg-dark-surface border-t border-slate-100 dark:border-dark-border/80 flex items-center justify-end gap-3 flex-shrink-0">
                <button type="button" class="btn-dismiss-keg-modal px-5 py-2.5 rounded-xl bg-white dark:bg-dark-card text-slate-700 dark:text-slate-300 font-bold text-xs sm:text-sm border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface transition-colors">
                    Tutup
                </button>
            </div>

        </div>
    </div>


    <!-- ========================================================================
         SECTION 5: BOTTOM CTA BANNER (KOLABORASI & INFORMASI)
         ======================================================================== -->
    <section class="py-12 bg-transparent relative z-10">
        <div class="container-wide">
            <div class="rounded-3xl p-8 sm:p-12 bg-gradient-to-br from-slate-900 via-primary-950 to-slate-900 text-white text-center relative overflow-hidden shadow-2xl border border-teal-500/30">
                <!-- Ambient Glow -->
                <div class="absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-teal-500/20 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-teal-500/20 text-teal-300 border border-teal-500/40 text-xs font-bold uppercase tracking-wider">
                        Sinergi &amp; Kolaborasi
                    </span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight">
                        Ingin Berkolaborasi Mengadakan Kegiatan Bersama Bank Syariah Wakalumi?
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                        Kami senantiasa membuka pintu kemitraan untuk program literasi ekonomi syariah, pemberdayaan UMKM, serta aksi kepedulian sosial CSR bagi kemaslahatan umat.
                    </p>
                    <div class="pt-4 flex flex-wrap items-center justify-center gap-3">
                        <a href="<?php echo esc_url( $wa_url ); ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn-primary inline-flex items-center gap-2.5 px-7 py-3.5 rounded-xl text-xs sm:text-sm font-bold shadow-lg shadow-teal-500/25 hover:scale-105 active:scale-95 transition-all">
                            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <span>Hubungi Humas via WhatsApp</span>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/kontak/' ) ); ?>"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl text-xs sm:text-sm font-bold bg-white/10 hover:bg-white/20 text-white border border-white/20 transition-all">
                            <span>Lihat Informasi Kontak Lengkap</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- ========================================================================
     CLIENT-SIDE FILTER, SEARCH & LIGHTBOX CONTROLLER
     ======================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var cards = Array.from(document.querySelectorAll('.kegiatan-card'));
    var searchInput = document.getElementById('kegiatan-search-input');
    var yearFilter = document.getElementById('kegiatan-year-filter');
    var timeFilterBtns = document.querySelectorAll('.keg-status-btn');
    var catFilterPills = document.querySelectorAll('.keg-cat-pill');
    var indicator = document.getElementById('kegiatan-filter-indicator');
    var resultCount = document.getElementById('kegiatan-result-count');
    var searchEmpty = document.getElementById('kegiatan-search-empty');
    var upcomingEmpty = document.getElementById('kegiatan-upcoming-empty');
    var grid = document.getElementById('kegiatan-cards-grid');

    var currentStatus = 'all';
    var currentCat = 'all';
    var currentYear = 'all';
    var currentKeyword = '';

    var itemsPerPage = 6;
    var currentPage = 1;
    var filteredCards = [];

    var paginationWrap = document.getElementById('kegiatan-pagination-wrap');
    var paginationInfo = document.getElementById('kegiatan-pagination-info');
    var paginationNav = document.getElementById('kegiatan-pagination-nav');

    function scrollToCards() {
        var target = document.getElementById('kegiatan-category-filters') || document.getElementById('kegiatan-cards-grid');
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    function renderPagination() {
        var total = filteredCards.length;
        var totalPages = Math.ceil(total / itemsPerPage);
        if (currentPage > totalPages && totalPages > 0) {
            currentPage = totalPages;
        }

        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = Math.min(startIndex + itemsPerPage, total);

        cards.forEach(function(c) { c.classList.add('hidden'); });

        for (var i = startIndex; i < endIndex; i++) {
            if (filteredCards[i]) {
                filteredCards[i].classList.remove('hidden');
            }
        }

        if (totalPages > 1) {
            if (paginationWrap) paginationWrap.classList.remove('hidden');
            if (paginationInfo) {
                paginationInfo.textContent = 'Menampilkan ' + (startIndex + 1) + ' – ' + endIndex + ' dari ' + total + ' kegiatan';
            }
            if (paginationNav) {
                paginationNav.innerHTML = '';

                // Tombol Sebelumnya
                var prevBtn = document.createElement('button');
                prevBtn.type = 'button';
                prevBtn.className = 'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-1 ' +
                    (currentPage === 1 
                        ? 'text-slate-300 dark:text-slate-600 cursor-not-allowed bg-slate-100/50 dark:bg-dark-surface/50 border border-slate-200/50 dark:border-dark-border/50' 
                        : 'text-slate-700 dark:text-slate-200 bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border hover:bg-teal-50 dark:hover:bg-dark-surface hover:text-teal-600 shadow-xs cursor-pointer');
                prevBtn.innerHTML = '<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg><span>Sebelumnya</span>';
                if (currentPage > 1) {
                    prevBtn.addEventListener('click', function() {
                        currentPage--;
                        renderPagination();
                        scrollToCards();
                    });
                }
                paginationNav.appendChild(prevBtn);

                // Tombol Nomor Halaman
                for (var p = 1; p <= totalPages; p++) {
                    (function(pageNum) {
                        var pBtn = document.createElement('button');
                        pBtn.type = 'button';
                        if (pageNum === currentPage) {
                            pBtn.className = 'w-8 h-8 rounded-xl text-xs font-black bg-gradient-to-r from-teal-600 to-cyan-600 text-white shadow-md shadow-teal-600/25 border border-teal-500 cursor-default flex items-center justify-center';
                        } else {
                            pBtn.className = 'w-8 h-8 rounded-xl text-xs font-bold bg-white dark:bg-dark-card text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface transition-colors cursor-pointer flex items-center justify-center';
                            pBtn.addEventListener('click', function() {
                                currentPage = pageNum;
                                renderPagination();
                                scrollToCards();
                            });
                        }
                        pBtn.textContent = pageNum;
                        paginationNav.appendChild(pBtn);
                    })(p);
                }

                // Tombol Berikutnya
                var nextBtn = document.createElement('button');
                nextBtn.type = 'button';
                nextBtn.className = 'px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-1 ' +
                    (currentPage === totalPages 
                        ? 'text-slate-300 dark:text-slate-600 cursor-not-allowed bg-slate-100/50 dark:bg-dark-surface/50 border border-slate-200/50 dark:border-dark-border/50' 
                        : 'text-slate-700 dark:text-slate-200 bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border hover:bg-teal-50 dark:hover:bg-dark-surface hover:text-teal-600 shadow-xs cursor-pointer');
                nextBtn.innerHTML = '<span>Berikutnya</span><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>';
                if (currentPage < totalPages) {
                    nextBtn.addEventListener('click', function() {
                        currentPage++;
                        renderPagination();
                        scrollToCards();
                    });
                }
                paginationNav.appendChild(nextBtn);
            }
        } else {
            if (paginationWrap) paginationWrap.classList.add('hidden');
        }
    }

    function applyFilters(resetPage) {
        if (resetPage !== false) {
            currentPage = 1;
        }

        filteredCards = [];
        var upcomingTotalInDb = 0;

        cards.forEach(function(card) {
            var cStatus = card.getAttribute('data-status') || '';
            var cCat = card.getAttribute('data-category') || '';
            var cYear = card.getAttribute('data-year') || '';
            var cTitle = card.getAttribute('data-title') || '';
            var cContent = card.getAttribute('data-content') || '';

            if (cStatus === 'mendatang') upcomingTotalInDb++;

            var matchStatus = (currentStatus === 'all') || (cStatus === currentStatus);
            var matchCat = (currentCat === 'all') || (cCat === currentCat);
            var matchYear = (currentYear === 'all') || (cYear === currentYear);
            var matchSearch = true;

            if (currentKeyword) {
                matchSearch = (cTitle.indexOf(currentKeyword) !== -1) || (cContent.indexOf(currentKeyword) !== -1);
            }

            if (matchStatus && matchCat && matchYear && matchSearch) {
                filteredCards.push(card);
            }
        });

        var visibleCount = filteredCards.length;

        // Special check: If user selected 'Agenda Mendatang' and there are no upcoming cards
        if (currentStatus === 'mendatang' && upcomingTotalInDb === 0 && !currentKeyword) {
            if (upcomingEmpty) upcomingEmpty.classList.remove('hidden');
            if (searchEmpty) searchEmpty.classList.add('hidden');
            if (grid) grid.classList.add('hidden');
            if (paginationWrap) paginationWrap.classList.add('hidden');
            cards.forEach(function(c) { c.classList.add('hidden'); });
        } else {
            if (upcomingEmpty) upcomingEmpty.classList.add('hidden');
            if (grid) grid.classList.remove('hidden');

            if (visibleCount === 0) {
                if (searchEmpty) searchEmpty.classList.remove('hidden');
                if (paginationWrap) paginationWrap.classList.add('hidden');
                cards.forEach(function(c) { c.classList.add('hidden'); });
            } else {
                if (searchEmpty) searchEmpty.classList.add('hidden');
                renderPagination();
            }
        }

        // Filter indicator bar
        var isFiltered = (currentStatus !== 'all') || (currentCat !== 'all') || (currentYear !== 'all') || (currentKeyword !== '');
        if (indicator && resultCount) {
            if (isFiltered) {
                indicator.classList.remove('hidden');
                resultCount.textContent = visibleCount;
            } else {
                indicator.classList.add('hidden');
            }
        }
    }

    // Time Status Switcher (Semua, Mendatang, Terlaksana)
    timeFilterBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            timeFilterBtns.forEach(function(b) {
                b.className = 'keg-status-btn px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-300 whitespace-nowrap bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface-alt flex items-center gap-1.5';
            });
            btn.className = 'keg-status-btn active-tab px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-300 whitespace-nowrap bg-gradient-to-r from-teal-600 to-cyan-600 text-white shadow-md shadow-teal-600/20 border border-teal-500 flex items-center gap-1.5';

            currentStatus = btn.getAttribute('data-status-filter') || 'all';
            applyFilters();
        });
    });

    // Category Pill Switcher
    catFilterPills.forEach(function(pill) {
        pill.addEventListener('click', function() {
            catFilterPills.forEach(function(p) {
                p.className = 'keg-cat-pill px-3 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200 whitespace-nowrap bg-white/80 dark:bg-dark-card/80 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface-alt';
            });
            pill.className = 'keg-cat-pill active-cat-pill px-3 py-1.5 rounded-lg text-xs font-bold transition-all duration-200 whitespace-nowrap bg-teal-500/20 text-teal-700 dark:text-teal-300 border border-teal-500/40';

            currentCat = pill.getAttribute('data-cat-filter') || 'all';
            applyFilters();
        });
    });

    // Search Input
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentKeyword = this.value.trim().toLowerCase();
            applyFilters();
        });
    }

    // Year Dropdown
    if (yearFilter) {
        yearFilter.addEventListener('change', function() {
            currentYear = this.value;
            applyFilters();
        });
    }

    // Reset Filter Button
    function resetAllFilters() {
        currentStatus = 'all';
        currentCat = 'all';
        currentYear = 'all';
        currentKeyword = '';
        if (searchInput) searchInput.value = '';
        if (yearFilter) yearFilter.value = 'all';

        timeFilterBtns.forEach(function(b, idx) {
            if (idx === 0) {
                b.className = 'keg-status-btn active-tab px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-300 whitespace-nowrap bg-gradient-to-r from-teal-600 to-cyan-600 text-white shadow-md shadow-teal-600/20 border border-teal-500 flex items-center gap-1.5';
            } else {
                b.className = 'keg-status-btn px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-300 whitespace-nowrap bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface-alt flex items-center gap-1.5';
            }
        });

        catFilterPills.forEach(function(p, idx) {
            if (idx === 0) {
                p.className = 'keg-cat-pill active-cat-pill px-3 py-1.5 rounded-lg text-xs font-bold transition-all duration-200 whitespace-nowrap bg-teal-500/20 text-teal-700 dark:text-teal-300 border border-teal-500/40';
            } else {
                p.className = 'keg-cat-pill px-3 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200 whitespace-nowrap bg-white/80 dark:bg-dark-card/80 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface-alt';
            }
        });

        applyFilters();
    }

    var resetBtn = document.getElementById('kegiatan-reset-filter');
    if (resetBtn) resetBtn.addEventListener('click', resetAllFilters);

    document.querySelectorAll('.btn-trigger-reset').forEach(function(btn) {
        btn.addEventListener('click', resetAllFilters);
    });

    // Switch to Completed tab from Empty state
    var btnSwitchCompleted = document.getElementById('btn-switch-to-completed');
    if (btnSwitchCompleted) {
        btnSwitchCompleted.addEventListener('click', function() {
            var completedBtn = document.querySelector('[data-status-filter="terlaksana"]');
            if (completedBtn) completedBtn.click();
        });
    }


    // ── LIGHTBOX QUICK READER MODAL CONTROLLER ───────────────────────
    var modal         = document.getElementById('kegiatan-detail-modal');
    var modalBackdrop = document.getElementById('kegiatan-modal-backdrop');
    var modalCard     = document.getElementById('kegiatan-modal-card');
    var btnClose      = document.getElementById('btn-close-keg-modal');
    var dismissBtns   = document.querySelectorAll('.btn-dismiss-keg-modal');

    // Teleport modal to document.body to avoid Swup CSS transform containing block
    if (modal && modal.parentElement !== document.body) {
        document.body.appendChild(modal);
    }

    if (window.swup && window.swup.hooks) {
        window.swup.hooks.on('visit:start', function() {
            var m = document.getElementById('kegiatan-detail-modal');
            if (m) m.remove();
            document.body.style.overflow = '';
        });
    }

    function openModal(cardId) {
        var card = document.getElementById(cardId);
        if (!card) return;
        var dataEl = card.querySelector('.kegiatan-modal-data');
        if (!dataEl) return;

        // Populate Fields
        document.getElementById('modal-keg-title').textContent = dataEl.querySelector('.data-title').textContent;
        document.getElementById('modal-keg-date').textContent  = dataEl.querySelector('.data-date').textContent;
        document.getElementById('modal-keg-body').innerHTML   = dataEl.querySelector('.data-content').innerHTML;

        var catBadge = document.getElementById('modal-keg-category');
        catBadge.textContent = dataEl.querySelector('.data-category').textContent;
        catBadge.className   = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border ' + (dataEl.querySelector('.data-category-badge').textContent || 'bg-teal-50 text-teal-700 border-teal-200');

        var status = dataEl.querySelector('.data-status').textContent;
        var statusBadge = document.getElementById('modal-keg-status-badge');
        var topAccent   = document.getElementById('modal-keg-top-accent');
        if (status === 'mendatang') {
            statusBadge.className = 'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border border-emerald-300 text-[10px] font-black uppercase';
            statusBadge.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> AKAN DATANG';
            topAccent.className   = 'h-2 w-full bg-gradient-to-r from-teal-500 via-emerald-400 to-teal-600 flex-shrink-0';
        } else {
            statusBadge.className = 'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-slate-100 dark:bg-dark-surface text-slate-600 dark:text-slate-300 border border-slate-300 text-[10px] font-bold uppercase';
            statusBadge.innerHTML = 'TERLAKSANA';
            topAccent.className   = 'h-2 w-full bg-gradient-to-r from-slate-400 via-teal-500 to-primary-600 flex-shrink-0';
        }

        // Time
        var time = dataEl.querySelector('.data-time').textContent.trim();
        var timeWrap = document.getElementById('modal-keg-time-wrap');
        if (time) {
            document.getElementById('modal-keg-time').textContent = time;
            timeWrap.classList.remove('hidden');
        } else {
            timeWrap.classList.add('hidden');
        }

        // Location & Maps
        var loc = dataEl.querySelector('.data-location').textContent.trim();
        var mapsUrl = dataEl.querySelector('.data-maps-url').textContent.trim();
        var locWrap = document.getElementById('modal-keg-loc-wrap');
        var mapsBtn = document.getElementById('modal-keg-maps-btn');
        if (loc) {
            document.getElementById('modal-keg-loc').textContent = loc;
            locWrap.classList.remove('hidden');
            if (mapsUrl) {
                mapsBtn.setAttribute('href', mapsUrl);
                mapsBtn.classList.remove('hidden');
            } else {
                mapsBtn.classList.add('hidden');
            }
        } else {
            locWrap.classList.add('hidden');
        }

        // Poster Image
        var imgUrl = dataEl.querySelector('.data-image').textContent.trim();
        var imgWrap = document.getElementById('modal-keg-image-wrap');
        if (imgUrl) {
            imgWrap.classList.remove('hidden');
            document.getElementById('modal-keg-image').setAttribute('src', imgUrl);
            document.getElementById('modal-keg-image-full-link').setAttribute('href', imgUrl);
        } else {
            imgWrap.classList.add('hidden');
        }

        // Registration Button
        var regUrl = dataEl.querySelector('.data-reg-url').textContent.trim();
        var regText = dataEl.querySelector('.data-reg-text').textContent.trim() || 'Daftar Sekarang';
        var actionBox = document.getElementById('modal-keg-action-box');
        if (regUrl) {
            actionBox.classList.remove('hidden');
            document.getElementById('modal-keg-action-btn').setAttribute('href', regUrl);
            document.getElementById('modal-keg-action-label').textContent = regText;
        } else {
            actionBox.classList.add('hidden');
        }

        // Show Modal with Animation
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(function() {
            modalBackdrop.classList.remove('opacity-0');
            modalBackdrop.classList.add('opacity-100');
            modalCard.classList.remove('scale-95', 'opacity-0');
            modalCard.classList.add('scale-100', 'opacity-100');
        });
    }

    function closeModal() {
        modalBackdrop.classList.remove('opacity-100');
        modalBackdrop.classList.add('opacity-0');
        modalCard.classList.remove('scale-100', 'opacity-100');
        modalCard.classList.add('scale-95', 'opacity-0');
        setTimeout(function() {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 250);
    }

    // Bind triggers
    document.querySelectorAll('.btn-open-keg-modal').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var cardId = this.getAttribute('data-id') || this.closest('.kegiatan-card').getAttribute('id');
            openModal(cardId);
        });
    });

    if (btnClose) btnClose.addEventListener('click', closeModal);
    if (modalBackdrop) modalBackdrop.addEventListener('click', closeModal);
    dismissBtns.forEach(function(btn) {
        btn.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // Check URL Hash on load e.g. /kegiatan/#act_1
    if (window.location.hash) {
        var targetId = window.location.hash.substring(1);
        var targetCard = document.getElementById(targetId);
        if (targetCard) {
            var targetIndex = filteredCards.indexOf(targetCard);
            if (targetIndex !== -1) {
                currentPage = Math.floor(targetIndex / itemsPerPage) + 1;
                renderPagination();
            }
            setTimeout(function() {
                openModal(targetId);
            }, 300);
        }
    }
});
</script>

<?php get_footer(); ?>

