<?php
/**
 * Template Name: Halaman Literasi & Inklusi Keuangan Syariah
 * Description: Portal Edukasi Fikih Muamalah, Pilar Inklusi Keuangan Syariah, Komparasi Perbankan, dan Pengajuan Kemitraan Sosialisasi Komunitas Insan Bank Syariah Wakalumi (BSW).
 * 
 * @package Wakalumi
 */

get_header();

// ── DATA RETRIEVAL ──────────────────────────────────────────────────
$header   = wakalumi_get_literasi_header();
$pil_sec  = wakalumi_get_literasi_pillars_section();
$pillars  = wakalumi_get_literasi_pillars();
$modules  = wakalumi_get_literasi_modules();
$form_set = wakalumi_get_literasi_form_settings();
$cta      = wakalumi_get_literasi_cta();

$total_modules = count( $modules );

// Extract unique categories for filter tabs
$categories = [
    'all'        => 'Semua Topik',
    'dasar'      => 'Prinsip Dasar Syariah',
    'simpanan'   => 'Simpanan & Tabungan',
    'pembiayaan' => 'Pembiayaan Syariah',
    'keuangan'   => 'Manajemen Finansial',
    'keamanan'   => 'Keamanan Finansial',
];
?>

<div class="min-h-screen bg-transparent text-slate-800 dark:text-dark-text pb-24">

    <!-- ========================================================================
         SECTION 1: HERO HEADER BANNER & POJK LITERASI IDENTITY
         ======================================================================== -->
    <section class="relative z-10 pt-8 sm:pt-10 pb-12 sm:pb-16 overflow-hidden bg-slate-50/70 dark:bg-dark-surface/50 border-b border-slate-200/80 dark:border-dark-border/80 shadow-xs">
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
                <span class="text-teal-600 dark:text-teal-400 font-semibold">Literasi &amp; Inklusi Keuangan</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <!-- Left Column: Title & Narrative -->
                <div class="lg:col-span-7 xl:col-span-7" data-aos="fade-up">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/90 dark:bg-teal-950/70 border border-teal-300/80 dark:border-teal-700/60 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        <?php echo esc_html( $header['badge'] ); ?>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                        <?php echo esc_html( $header['title'] ); ?>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl">
                        <?php echo esc_html( $header['desc'] ); ?>
                    </p>

                    <!-- Trust Highlights Pills -->
                    <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                            <span>100% Edukasi Bebas Biaya</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                            <span>Fatwa Dewan Syariah Nasional (DSN-MUI)</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span>Berizin &amp; Diawasi OJK</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Elevated Overview Card -->
                <div class="lg:col-span-5 xl:col-span-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-[1.5px] rounded-3xl bg-gradient-to-br from-teal-400 via-emerald-400 to-cyan-500 shadow-xl shadow-teal-500/10 group">
                        <div class="relative rounded-[22px] p-6 sm:p-7 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl overflow-hidden">
                            <!-- Glass Shine Glint -->
                            <div class="wkl-glass-shine"></div>

                            <div class="relative z-10 space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-teal-100/90 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border border-teal-300/70 dark:border-teal-700/60 shadow-2xs">
                                        POJK Literasi &amp; Inklusi
                                    </span>
                                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 tracking-wide">
                                        Bank Syariah Wakalumi
                                    </span>
                                </div>

                                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white leading-snug">
                                    Mewujudkan Ekosistem Muamalah yang Adil &amp; Berdaya
                                </h3>

                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                                    Kami hadir tidak sekadar sebagai lembaga intermediasi perbankan, melainkan mitra belajar masyarakat dalam mengelola rezeki secara berkah, mempermudah permodalan usaha halal, dan mewujudkan kemandirian finansial yang amanah.
                                </p>

                                <!-- Mini Metrics Inside Card -->
                                <div class="grid grid-cols-2 gap-3 pt-2">
                                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-dark-surface/70 border border-slate-200/80 dark:border-dark-border">
                                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Pilar Inklusi</span>
                                        <span class="block text-xs sm:text-sm font-extrabold text-teal-700 dark:text-teal-300 mt-0.5">
                                            3 Program Nyata
                                        </span>
                                    </div>
                                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-dark-surface/70 border border-slate-200/80 dark:border-dark-border">
                                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Modul Edukasi</span>
                                        <span class="block text-xs sm:text-sm font-extrabold text-emerald-600 dark:text-emerald-400 mt-0.5">
                                            <?php echo $total_modules; ?> Panduan Resmi
                                        </span>
                                    </div>
                                </div>

                                <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-3 text-xs">
                                    <span class="text-slate-500 dark:text-slate-400 font-medium">
                                        Ingin sosialisasi di komunitas Anda?
                                    </span>
                                    <a href="#form-kemitraan" class="inline-flex items-center gap-1.5 text-teal-700 dark:text-teal-300 font-extrabold hover:underline">
                                        <span>Ajukan Gratis</span>
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 2: 3 PILAR UTAMA PROGRAM INKLUSI KEUANGAN BSW
         ======================================================================== -->
    <section class="section py-16 sm:py-20 relative z-10 bg-white dark:bg-dark-card border-b border-slate-200/80 dark:border-dark-border/80">
        <div class="container-wide">
            <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-200 dark:border-teal-800 mb-3 shadow-2xs">
                    <?php echo esc_html( $pil_sec['badge'] ); ?>
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    <?php echo esc_html( $pil_sec['title'] ); ?>
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed sm:leading-loose">
                    <?php echo esc_html( $pil_sec['desc'] ); ?>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                <?php foreach ( $pillars as $idx => $pil ) : ?>
                    <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-b from-teal-500/25 via-slate-200/60 to-emerald-400/20 dark:from-teal-500/30 dark:via-dark-border dark:to-teal-950/30 hover:from-teal-500 hover:to-emerald-400 hover:shadow-xl hover:shadow-teal-500/15 transition-all duration-500 group"
                         data-aos="fade-up" 
                         data-aos-delay="<?php echo $idx * 100; ?>">
                        
                        <div class="relative rounded-[22px] p-6 sm:p-8 bg-white/95 dark:bg-dark-surface/90 backdrop-blur-xl h-full flex flex-col justify-between overflow-hidden">
                            <!-- Glass Shine Glint -->
                            <div class="wkl-glass-shine"></div>

                            <div>
                                <!-- Top Row: Icon Badge + Tag Pill -->
                                <div class="flex items-center justify-between gap-3 mb-5">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-50 to-teal-100/90 dark:from-teal-950/80 dark:to-teal-900/40 text-teal-700 dark:text-teal-300 flex items-center justify-center border border-teal-200/80 dark:border-teal-700/60 shadow-xs group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                        <?php if ( $pil['icon'] === 'truck' ) : ?>
                                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25V5.25A2.25 2.25 0 0012 3H6a2.25 2.25 0 00-2.25 2.25v9m9.75-6.75h3.75"/></svg>
                                        <?php elseif ( $pil['icon'] === 'academic-cap' ) : ?>
                                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/></svg>
                                        <?php else : ?>
                                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"/></svg>
                                        <?php endif; ?>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider bg-teal-50 dark:bg-teal-950/70 text-teal-700 dark:text-teal-300 border border-teal-200/80 dark:border-teal-800/80">
                                        <?php echo esc_html( $pil['tag'] ); ?>
                                    </span>
                                </div>

                                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white mb-1.5 leading-snug group-hover:text-teal-700 dark:group-hover:text-teal-300 transition-colors">
                                    <?php echo esc_html( $pil['title'] ); ?>
                                </h3>

                                <p class="text-xs font-bold text-teal-600 dark:text-teal-400 mb-3">
                                    <?php echo esc_html( $pil['sub'] ); ?>
                                </p>

                                <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed sm:leading-loose">
                                    <?php echo esc_html( $pil['desc'] ); ?>
                                </p>
                            </div>

                            <div class="pt-4 mt-6 border-t border-slate-100 dark:border-slate-800/80 flex items-center gap-1.5 text-[11px] font-bold text-teal-700 dark:text-teal-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                <span>Program Inklusi Aktif BSW</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 3: DIREKTORI MODUL EDUKASI LITERASI SYARIAH (INTERACTIVE CARDS)
         ======================================================================== -->
    <section id="modul-edukasi" class="section py-16 sm:py-20 relative z-10 bg-slate-50/70 dark:bg-dark-surface/50 border-b border-slate-200/80 dark:border-dark-border/80">
        <div class="container-wide">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10" data-aos="fade-up">
                <div>
                    <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-100/90 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-300 dark:border-teal-700 mb-3 shadow-2xs">
                        Pusat Edukasi Fikih &amp; Keuangan
                    </span>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                        Modul &amp; Panduan Literasi Keuangan Syariah
                    </h2>
                    <p class="mt-2 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                        Pelajari kaidah muamalah perbankan syariah, cara kerja bagi hasil, dan kiat menjaga keamanan finansial keluarga Anda.
                    </p>
                </div>

                <!-- Instant Search Bar -->
                <div class="relative w-full md:w-80 flex-shrink-0">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    </span>
                    <input type="text" 
                           id="literasi-search-input" 
                           placeholder="Cari topik, riba, mudharabah..." 
                           class="w-full pl-10 pr-9 py-2.5 rounded-xl text-xs sm:text-sm bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all">
                    <button type="button" 
                            id="literasi-search-clear" 
                            class="hidden absolute inset-y-0 right-0 items-center pr-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                        ✕
                    </button>
                </div>
            </div>

            <!-- Category Filter Tabs -->
            <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 scrollbar-none" id="literasi-category-tabs">
                <?php foreach ( $categories as $cat_key => $cat_name ) : ?>
                    <button type="button" 
                            data-filter="<?php echo esc_attr( $cat_key ); ?>" 
                            class="literasi-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap transition-all duration-300 <?php echo $cat_key === 'all' ? 'active bg-teal-600 text-white shadow-sm ring-2 ring-teal-500/50' : 'bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-teal-50 hover:text-teal-700 dark:hover:bg-slate-700 border border-slate-200/80 dark:border-dark-border'; ?>">
                        <?php echo esc_html( $cat_name ); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- MODULE CARDS GRID -->
            <div id="literasi-module-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <?php 
                foreach ( $modules as $idx => $mod ) : 
                    $judul       = esc_attr( $mod['judul'] ?? '' );
                    $kategori    = esc_attr( $mod['kategori'] ?? 'dasar' );
                    $kat_label   = esc_attr( $categories[ $kategori ] ?? ucfirst( $kategori ) );
                    $sasaran     = esc_attr( $mod['sasaran'] ?? 'Masyarakat Umum' );
                    $ringkasan   = esc_html( $mod['ringkasan'] ?? '' );
                    $isi_lengkap = esc_attr( $mod['isi_lengkap'] ?? '' );

                    $search_keywords = strtolower( $judul . ' ' . $kategori . ' ' . $kat_label . ' ' . $sasaran . ' ' . $ringkasan );
                ?>
                    <div class="literasi-module-card relative p-[1.5px] rounded-3xl bg-gradient-to-br from-teal-400/25 via-slate-200/70 to-emerald-400/20 dark:from-teal-500/30 dark:via-dark-border dark:to-teal-900/30 hover:from-teal-500 hover:to-emerald-400 hover:shadow-xl hover:shadow-teal-500/15 transition-all duration-300 group flex flex-col justify-between"
                         data-category="<?php echo $kategori; ?>"
                         data-keywords="<?php echo esc_attr( $search_keywords ); ?>"
                         data-aos="fade-up" 
                         data-aos-delay="<?php echo min( ( $idx % 3 ) * 100, 200 ); ?>">
                        
                        <div class="relative rounded-[22px] p-6 sm:p-7 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl h-full flex flex-col justify-between overflow-hidden">
                            <!-- Glass Shine Glint -->
                            <div class="wkl-glass-shine"></div>

                            <div>
                                <!-- Header: Category & Sasaran -->
                                <div class="flex items-center justify-between gap-2 mb-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-teal-100/90 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border border-teal-300/70 dark:border-teal-700/60 shadow-2xs">
                                        <?php echo esc_html( $kat_label ); ?>
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-500 dark:text-slate-400">
                                        <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                        <span><?php echo esc_html( $sasaran ); ?></span>
                                    </span>
                                </div>

                                <!-- Title -->
                                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white leading-snug mb-3 group-hover:text-teal-700 dark:group-hover:text-teal-300 transition-colors">
                                    <?php echo esc_html( $judul ); ?>
                                </h3>

                                <!-- Summary -->
                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed line-clamp-3 mb-6">
                                    <?php echo $ringkasan; ?>
                                </p>
                            </div>

                            <!-- Footer Action -->
                            <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-3">
                                <button type="button" 
                                        class="btn-open-literasi-modal inline-flex items-center gap-1.5 text-xs sm:text-sm font-extrabold text-teal-700 dark:text-teal-300 hover:text-teal-800 dark:hover:text-teal-200 transition-colors"
                                        data-judul="<?php echo $judul; ?>"
                                        data-kategori="<?php echo $kat_label; ?>"
                                        data-sasaran="<?php echo $sasaran; ?>"
                                        data-ringkasan="<?php echo esc_attr( $ringkasan ); ?>"
                                        data-isi="<?php echo $isi_lengkap; ?>">
                                    <span>Baca Panduan Lengkap</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                </button>
                                <span class="text-[11px] font-mono text-slate-400">#0<?php echo ( $idx + 1 ); ?></span>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Empty Search State -->
            <div id="literasi-empty-state" class="hidden text-center py-16 px-4">
                <div class="w-16 h-16 rounded-2xl bg-white dark:bg-dark-card text-slate-400 flex items-center justify-center mx-auto mb-4 border border-slate-200 dark:border-dark-border">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Topik Edukasi Belum Ditemukan</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 max-w-md mx-auto mb-6">
                    Kata kunci yang Anda cari belum cocok dengan modul yang tersedia. Silakan gunakan kata kunci lain atau reset filter.
                </p>
                <button type="button" id="literasi-reset-btn" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold transition-all shadow-sm">
                    Reset Pencarian &amp; Filter
                </button>
            </div>

        </div>
    </section>

    <!-- ========================================================================
         SECTION 4: KOMPARASI EDUKATIF — BANK SYARIAH VS BANK KONVENSIONAL
         ======================================================================== -->
    <section class="section py-16 sm:py-20 relative z-10 bg-white dark:bg-dark-card border-b border-slate-200/80 dark:border-dark-border/80">
        <div class="container-wide">
            <div class="max-w-3xl mx-auto text-center mb-12" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-200 dark:border-teal-800 mb-3 shadow-2xs">
                    Edukasi Perbandingan
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    Perbedaan Mendasar Bank Syariah vs Konvensional
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                    Pahami keunggulan sistem perbankan syariah yang menempatkan kemaslahatan, keadilan bagi hasil, dan kepatuhan syariat di atas segalanya.
                </p>
            </div>

            <!-- Comparison Table Container -->
            <div class="max-w-4xl mx-auto" data-aos="fade-up">
                <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-br from-teal-400/40 via-emerald-400/30 to-teal-600/40 shadow-xl overflow-hidden group">
                    <div class="rounded-[22px] bg-white/95 dark:bg-dark-surface/95 backdrop-blur-xl overflow-hidden">
                        <!-- Glass Shine -->
                        <div class="wkl-glass-shine"></div>

                        <!-- Table Header -->
                        <div class="grid grid-cols-1 md:grid-cols-12 bg-slate-100/90 dark:bg-dark-surface border-b border-slate-200 dark:border-dark-border text-xs sm:text-sm font-extrabold">
                            <div class="md:col-span-4 p-4 sm:p-5 text-slate-700 dark:text-slate-300 uppercase tracking-wider">Parameter Prinsip</div>
                            <div class="md:col-span-4 p-4 sm:p-5 bg-teal-500/10 text-teal-800 dark:text-teal-300 uppercase tracking-wider flex items-center gap-1.5 border-l border-r border-teal-200/50 dark:border-teal-800/50">
                                <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                                Bank Syariah (BSW)
                            </div>
                            <div class="md:col-span-4 p-4 sm:p-5 text-slate-500 dark:text-slate-400 uppercase tracking-wider">Bank Konvensional</div>
                        </div>

                        <!-- Row 1: Fikih Transaksi -->
                        <div class="grid grid-cols-1 md:grid-cols-12 border-b border-slate-100 dark:border-slate-800 text-sm sm:text-base leading-relaxed sm:leading-loose">
                            <div class="md:col-span-4 p-4 sm:p-5 font-bold text-slate-900 dark:text-white bg-slate-50/50 dark:bg-dark-card/50">Dasar Keuntungan</div>
                            <div class="md:col-span-4 p-4 sm:p-5 font-semibold text-teal-900 dark:text-teal-200 bg-teal-50/40 dark:bg-teal-950/20 border-l border-r border-teal-100 dark:border-teal-900/30">
                                Bagi Hasil (Nisbah), Margin Jual-Beli (Murabahah), dan Ujrah Sewa Manfaat. Bebas bunga riba.
                            </div>
                            <div class="md:col-span-4 p-4 sm:p-5 text-slate-600 dark:text-slate-400">
                                Bunga (Interest) yang ditetapkan sepihak dan dapat berubah sesuai suku bunga pasar.
                            </div>
                        </div>

                        <!-- Row 2: Hubungan Nasabah -->
                        <div class="grid grid-cols-1 md:grid-cols-12 border-b border-slate-100 dark:border-slate-800 text-sm sm:text-base leading-relaxed sm:leading-loose">
                            <div class="md:col-span-4 p-4 sm:p-5 font-bold text-slate-900 dark:text-white bg-slate-50/50 dark:bg-dark-card/50">Hubungan Nasabah &amp; Bank</div>
                            <div class="md:col-span-4 p-4 sm:p-5 font-semibold text-teal-900 dark:text-teal-200 bg-teal-50/40 dark:bg-teal-950/20 border-l border-r border-teal-100 dark:border-teal-900/30">
                                Kemitraan (Syirkah/Musyarakah), Penjual-Pembeli (Murabahah), dan Penitip-Pengelola (Wadiah/Mudharabah).
                            </div>
                            <div class="md:col-span-4 p-4 sm:p-5 text-slate-600 dark:text-slate-400">
                                Hubungan Kreditur (Pemberi Pinjaman) dan Debitur (Peminjam Uang).
                            </div>
                        </div>

                        <!-- Row 3: Penyaluran Dana -->
                        <div class="grid grid-cols-1 md:grid-cols-12 border-b border-slate-100 dark:border-slate-800 text-sm sm:text-base leading-relaxed sm:leading-loose">
                            <div class="md:col-span-4 p-4 sm:p-5 font-bold text-slate-900 dark:text-white bg-slate-50/50 dark:bg-dark-card/50">Arah Penyaluran Dana</div>
                            <div class="md:col-span-4 p-4 sm:p-5 font-semibold text-teal-900 dark:text-teal-200 bg-teal-50/40 dark:bg-teal-950/20 border-l border-r border-teal-100 dark:border-teal-900/30">
                                100% Sektor Halal, produktif, tidak merusak lingkungan, dan membawa kemaslahatan umat.
                            </div>
                            <div class="md:col-span-4 p-4 sm:p-5 text-slate-600 dark:text-slate-400">
                                Bebas pada semua sektor usaha selama dinilai menguntungkan secara finansial.
                            </div>
                        </div>

                        <!-- Row 4: Pengawasan -->
                        <div class="grid grid-cols-1 md:grid-cols-12 border-b border-slate-100 dark:border-slate-800 text-sm sm:text-base leading-relaxed sm:leading-loose">
                            <div class="md:col-span-4 p-4 sm:p-5 font-bold text-slate-900 dark:text-white bg-slate-50/50 dark:bg-dark-card/50">Badan Pengawas</div>
                            <div class="md:col-span-4 p-4 sm:p-5 font-semibold text-teal-900 dark:text-teal-200 bg-teal-50/40 dark:bg-teal-950/20 border-l border-r border-teal-100 dark:border-teal-900/30">
                                Otoritas Jasa Keuangan (OJK) + <strong>Dewan Pengawas Syariah (DPS)</strong> berizin DSN-MUI.
                            </div>
                            <div class="md:col-span-4 p-4 sm:p-5 text-slate-600 dark:text-slate-400">
                                Otoritas Jasa Keuangan (OJK) dan Bank Indonesia.
                            </div>
                        </div>

                        <!-- Row 5: Jaminan Simpanan -->
                        <div class="grid grid-cols-1 md:grid-cols-12 text-sm sm:text-base leading-relaxed sm:leading-loose">
                            <div class="md:col-span-4 p-4 sm:p-5 font-bold text-slate-900 dark:text-white bg-slate-50/50 dark:bg-dark-card/50">Jaminan Keamanan Simpanan</div>
                            <div class="md:col-span-4 p-4 sm:p-5 font-semibold text-teal-900 dark:text-teal-200 bg-teal-50/40 dark:bg-teal-950/20 border-l border-r border-teal-100 dark:border-teal-900/30">
                                Dijamin Lembaga Penjamin Simpanan (LPS) hingga Rp2 Miliar per nasabah sesuai syarat 3T LPS.
                            </div>
                            <div class="md:col-span-4 p-4 sm:p-5 text-slate-600 dark:text-slate-400">
                                Dijamin Lembaga Penjamin Simpanan (LPS) hingga Rp2 Miliar per nasabah.
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 5: FORMULIR PENGAJUAN SOSIALISASI & KEMITRAAN KOMUNITAS
         ======================================================================== -->
    <section id="form-kemitraan" class="section py-16 sm:py-20 relative z-10 bg-slate-50/70 dark:bg-dark-surface/50 border-b border-slate-200/80 dark:border-dark-border/80">
        <div class="container-narrow mx-auto" data-aos="fade-up">
            <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-br from-teal-400 via-emerald-400 to-cyan-500 shadow-xl shadow-teal-500/10 group">
                <div class="relative rounded-[22px] p-6 sm:p-10 md:p-12 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl overflow-hidden">
                    <!-- Glass Shine -->
                    <div class="wkl-glass-shine"></div>

                    <div class="relative z-10 space-y-6">
                        <div class="text-center max-w-2xl mx-auto space-y-3">
                            <span class="inline-block px-3.5 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-teal-100/90 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border border-teal-300/70 shadow-2xs">
                                <?php echo esc_html( $form_set['badge'] ); ?>
                            </span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                                <?php echo esc_html( $form_set['title'] ); ?>
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                                <?php echo esc_html( $form_set['desc'] ); ?>
                            </p>
                        </div>

                        <!-- Interactive Form -->
                        <form id="literasi-partner-form" class="space-y-4 max-w-xl mx-auto pt-2">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                                    Nama Lembaga / Sekolah / Komunitas / Majelis Taklim *
                                </label>
                                <input type="text" id="partner-instansi" required placeholder="Contoh: SMA Negeri 1 / Paguyuban Pedagang Pasar" class="w-full px-4 py-2.5 rounded-xl text-xs sm:text-sm bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                                        Nama Narahubung / PIC *
                                    </label>
                                    <input type="text" id="partner-nama" required placeholder="Nama Anda" class="w-full px-4 py-2.5 rounded-xl text-xs sm:text-sm bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                                        Nomor WhatsApp PIC *
                                    </label>
                                    <input type="tel" id="partner-wa" required placeholder="08xxxxxxxxxx" class="w-full px-4 py-2.5 rounded-xl text-xs sm:text-sm bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                                        Fokus Topik yang Diminati
                                    </label>
                                    <select id="partner-topik" class="w-full px-3.5 py-2.5 rounded-xl text-xs sm:text-sm bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-teal-500">
                                        <option value="Dasar Fikih Muamalah &amp; Bank Syariah">Dasar Fikih Muamalah &amp; Perbankan Syariah</option>
                                        <option value="Edukasi &amp; Pembiayaan Syariah Tenaga Pendidik / Guru Sekolah">Edukasi &amp; Pembiayaan Syariah Guru &amp; Tenaga Pendidik</option>
                                        <option value="Pelatihan Manajemen Arus Kas &amp; Modal UMKM">Pelatihan Arus Kas &amp; Modal Usaha UMKM</option>
                                        <option value="Waspada Investasi Bodong &amp; Pinjol Ilegal">Waspada Investasi Bodong &amp; Pinjol Ilegal</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                                        Perkiraan Jumlah Peserta
                                    </label>
                                    <select id="partner-peserta" class="w-full px-3.5 py-2.5 rounded-xl text-xs sm:text-sm bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-teal-500">
                                        <option value="20 - 50 Peserta">20 - 50 Orang</option>
                                        <option value="50 - 100 Peserta">50 - 100 Orang</option>
                                        <option value="Lebih dari 100 Peserta">> 100 Orang</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                                    Catatan / Perkiraan Waktu Acara (Opsional)
                                </label>
                                <textarea id="partner-catatan" rows="2" placeholder="Contoh: Rencana diadakan awal bulan depan di aula sekolah..." class="w-full px-4 py-2.5 rounded-xl text-xs sm:text-sm bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-teal-600 hover:bg-teal-700 text-white font-extrabold text-sm shadow-lg shadow-teal-600/25 hover:scale-[1.02] transition-all">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    <span>Kirim Pengajuan Kemitraan via WhatsApp</span>
                                </button>
                            </div>

                            <p class="text-center text-[11px] text-slate-500 dark:text-slate-400 pt-1">
                                ⚖️ Seluruh kegiatan sosialisasi dan edukasi literasi syariah diselenggarakan <strong>100% BEBAS BIAYA</strong> sebagai bentuk komitmen kepatuhan dan tanggung jawab sosial BSW.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 6: AKSES DOKUMEN & BUKTI KEGIATAN REGULATOR
         ======================================================================== -->
    <section class="section py-16 relative z-10 bg-white dark:bg-dark-card border-b border-slate-200/80 dark:border-dark-border/80">
        <div class="container-wide">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                <!-- Box 1: Laporan Publikasi & Kepatuhan GCG -->
                <div class="p-[1.5px] rounded-3xl bg-gradient-to-br from-teal-400/30 via-slate-200/70 to-emerald-400/20 dark:from-teal-500/20 dark:via-dark-border dark:to-teal-900/20 group">
                    <div class="p-6 sm:p-8 rounded-[22px] bg-slate-50/90 dark:bg-dark-surface/90 backdrop-blur-xl h-full flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-teal-100 dark:bg-teal-950/80 text-teal-700 dark:text-teal-300 flex items-center justify-center mb-4 border border-teal-200 dark:border-teal-800">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                            </div>
                            <h3 class="text-lg font-extrabold text-slate-900 dark:text-white mb-2">Laporan Publikasi &amp; Kepatuhan GCG</h3>
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                                Akses laporan keuangan triwulanan resmi, laporan tata kelola syariah GCG, dan laporan keberlanjutan yang telah diaudit.
                            </p>
                        </div>
                        <a href="<?php echo esc_url( home_url( '/informasi/laporan-publikasi/' ) ); ?>" class="inline-flex items-center gap-2 text-xs sm:text-sm font-extrabold text-teal-700 dark:text-teal-300 hover:text-teal-800 dark:hover:text-teal-200">
                            <span>Buka Laporan Publikasi</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Box 2: Galeri & Berita Edukasi Lapangan -->
                <div class="p-[1.5px] rounded-3xl bg-gradient-to-br from-teal-400/30 via-slate-200/70 to-emerald-400/20 dark:from-teal-500/20 dark:via-dark-border dark:to-teal-900/20 group">
                    <div class="p-6 sm:p-8 rounded-[22px] bg-slate-50/90 dark:bg-dark-surface/90 backdrop-blur-xl h-full flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-teal-100 dark:bg-teal-950/80 text-teal-700 dark:text-teal-300 flex items-center justify-center mb-4 border border-teal-200 dark:border-teal-800">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"/></svg>
                            </div>
                            <h3 class="text-lg font-extrabold text-slate-900 dark:text-white mb-2">Dokumentasi Kegiatan &amp; Galeri Lapangan</h3>
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                                Dokumentasi foto dan rangkuman kegiatan seminar literasi, pelatihan UMKM binaan, serta penyerahan CSR perbankan syariah BSW.
                            </p>
                        </div>
                        <a href="<?php echo esc_url( home_url( '/informasi/galeri/' ) ); ?>" class="inline-flex items-center gap-2 text-xs sm:text-sm font-extrabold text-teal-700 dark:text-teal-300 hover:text-teal-800 dark:hover:text-teal-200">
                            <span>Lihat Galeri Kegiatan</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 7: CENTERED CTA BANNER
         ======================================================================== -->
    <?php if ( ! empty( $cta['show'] ) ) : ?>
    <section class="section py-16 sm:py-20 relative z-10">
        <div class="container-narrow mx-auto text-center" data-aos="fade-up">
            <div class="relative p-[2px] rounded-3xl bg-gradient-to-br from-teal-500/40 via-emerald-500/20 to-teal-700/40 shadow-2xl group overflow-hidden">
                <div class="relative rounded-[22px] p-8 sm:p-12 md:p-14 bg-gradient-to-br from-slate-900 via-slate-900 to-teal-950 text-center space-y-6 overflow-hidden">
                    <!-- Glass Shine -->
                    <div class="wkl-glass-shine"></div>

                    <!-- Ambient Glow & Watermark Emblem Center -->
                    <div class="absolute -top-24 -left-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
                    
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 opacity-[0.035] pointer-events-none select-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 invert">
                    </div>

                    <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                        <?php if ( ! empty( $cta['badge'] ) ) : ?>
                            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-500/15 border border-teal-400/25 text-teal-300 text-xs font-bold uppercase tracking-wider shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-teal-400 animate-ping"></span>
                                <?php echo esc_html( $cta['badge'] ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $cta['title'] ) ) : ?>
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight">
                                <?php echo esc_html( $cta['title'] ); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if ( ! empty( $cta['desc'] ) ) : ?>
                            <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                                <?php echo esc_html( $cta['desc'] ); ?>
                            </p>
                        <?php endif; ?>

                        <!-- Dual Centered Buttons -->
                        <div class="pt-4 flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                            <?php if ( ! empty( $cta['btn1_text'] ) && ! empty( $cta['btn1_url'] ) ) : 
                                $is_wa = ( strpos( $cta['btn1_url'], 'wa.me' ) !== false || strpos( $cta['btn1_url'], 'whatsapp' ) !== false );
                            ?>
                                <a href="<?php echo esc_url( $cta['btn1_url'] ); ?>" 
                                   <?php echo $is_wa ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
                                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold text-sm shadow-xl shadow-teal-500/20 hover:scale-105 transition-all duration-300">
                                    <?php if ( $is_wa ) : ?>
                                        <svg class="w-4 h-4 text-slate-950" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    <?php else : ?>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                    <?php endif; ?>
                                    <span><?php echo esc_html( $cta['btn1_text'] ); ?></span>
                                </a>
                            <?php endif; ?>

                            <?php if ( ! empty( $cta['btn2_text'] ) && ! empty( $cta['btn2_url'] ) ) : ?>
                                <a href="<?php echo esc_url( $cta['btn2_url'] ); ?>" 
                                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/15 text-white font-bold text-sm border border-white/20 backdrop-blur-md hover:scale-105 transition-all duration-300">
                                    <span><?php echo esc_html( $cta['btn2_text'] ); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

</div>

<!-- ========================================================================
     MODAL LIGHTBOX: DETAIL BACA MODUL EDUKASI LITERASI SYARIAH
     (Teleported to document.body for Swup SPA safety)
     ======================================================================== -->
<div id="literasi-detail-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4 sm:p-6 bg-slate-950/80 backdrop-blur-md transition-all duration-300">
    <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border shadow-2xl p-6 sm:p-8 space-y-6">
        
        <!-- Close Button -->
        <button type="button" id="btn-close-literasi-modal" class="absolute top-5 right-5 w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition-colors">
            ✕
        </button>

        <!-- Modal Header -->
        <div class="space-y-3 pr-8">
            <div class="flex items-center gap-2">
                <span id="modal-lit-kategori" class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-100 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border border-teal-300"></span>
                <span id="modal-lit-sasaran" class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700"></span>
            </div>

            <h2 id="modal-lit-judul" class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white leading-tight"></h2>
        </div>

        <!-- Summary Banner -->
        <div class="p-4 sm:p-5 rounded-2xl bg-teal-50/80 dark:bg-teal-950/40 border border-teal-200/80 dark:border-teal-800/60">
            <h4 class="text-[11px] font-black uppercase tracking-wider text-teal-800 dark:text-teal-300 mb-1.5">Ringkasan Konsep</h4>
            <p id="modal-lit-ringkasan" class="text-sm sm:text-base text-teal-950 dark:text-teal-100 leading-relaxed sm:leading-loose font-medium"></p>
        </div>

        <!-- Educational Full Body -->
        <div class="space-y-4">
            <h4 class="text-xs font-black uppercase tracking-wider text-slate-400 dark:text-slate-500">Penjelasan &amp; Panduan Fikih Lengkap</h4>
            <div id="modal-lit-isi" class="text-sm sm:text-base text-slate-700 dark:text-slate-200 leading-relaxed sm:leading-loose space-y-4 font-normal"></div>
        </div>

        <!-- Modal Actions Footer -->
        <div class="pt-5 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
            <span class="text-xs text-slate-500 dark:text-slate-400">
                Punya pertanyaan fikih atau produk?
            </span>
            <a href="<?php echo esc_url( $cta['btn1_url'] ); ?>" 
               target="_blank" rel="noopener noreferrer" 
               class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs sm:text-sm shadow-sm transition-all hover:scale-105">
                <span>Tanya Petugas Syariah via WhatsApp</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
            </a>
        </div>

    </div>
</div>

<!-- ========================================================================
     CLIENT-SIDE SCRIPT: FILTERING, SEARCH, PARTNER FORM & MODAL HANDLER
     ======================================================================== -->
<script>
(function() {
    function initLiterasiPage() {
        const grid        = document.getElementById('literasi-module-grid');
        const tabBtns     = document.querySelectorAll('.literasi-tab-btn');
        const searchInput = document.getElementById('literasi-search-input');
        const searchClear = document.getElementById('literasi-search-clear');
        const emptyState  = document.getElementById('literasi-empty-state');
        const resetBtn    = document.getElementById('literasi-reset-btn');

        if (grid) {
            const cards       = Array.from(grid.querySelectorAll('.literasi-module-card'));
            let currentCat    = 'all';
            let searchQuery   = '';

            function filterModules() {
                let visible = 0;
                const q = searchQuery.toLowerCase().trim();

                cards.forEach(card => {
                    const cardCat = card.getAttribute('data-category') || '';
                    const cardKw  = card.getAttribute('data-keywords') || '';

                    const matchesCat = (currentCat === 'all') || (cardCat === currentCat);
                    const matchesKw  = !q || cardKw.includes(q);

                    if (matchesCat && matchesKw) {
                        card.style.display = '';
                        visible++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (emptyState) {
                    if (visible === 0) {
                        emptyState.classList.remove('hidden');
                        grid.classList.add('hidden');
                    } else {
                        emptyState.classList.add('hidden');
                        grid.classList.remove('hidden');
                    }
                }
            }

            // Tab click
            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    tabBtns.forEach(b => {
                        b.classList.remove('active', 'bg-teal-600', 'text-white', 'ring-2', 'ring-teal-500/50');
                        b.classList.add('bg-white', 'dark:bg-slate-800', 'text-slate-700', 'dark:text-slate-300');
                    });

                    this.classList.add('active', 'bg-teal-600', 'text-white', 'ring-2', 'ring-teal-500/50');
                    this.classList.remove('bg-white', 'dark:bg-slate-800', 'text-slate-700', 'dark:text-slate-300');

                    currentCat = this.getAttribute('data-filter') || 'all';
                    filterModules();
                });
            });

            // Search Input
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    searchQuery = this.value;
                    if (searchClear) {
                        if (this.value.length > 0) {
                            searchClear.classList.remove('hidden');
                            searchClear.classList.add('flex');
                        } else {
                            searchClear.classList.add('hidden');
                            searchClear.classList.remove('flex');
                        }
                    }
                    filterModules();
                });
            }

            // Search Clear
            if (searchClear) {
                searchClear.addEventListener('click', function() {
                    if (searchInput) {
                        searchInput.value = '';
                        searchQuery = '';
                        this.classList.add('hidden');
                        this.classList.remove('flex');
                        filterModules();
                        searchInput.focus();
                    }
                });
            }

            // Reset Button
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    if (searchInput) searchInput.value = '';
                    searchQuery = '';
                    if (searchClear) searchClear.classList.add('hidden');

                    const firstTab = document.querySelector('.literasi-tab-btn[data-filter="all"]');
                    if (firstTab) firstTab.click();
                });
            }
        }

        // ── PARTNER WHATSAPP FORM HANDLER ───────────────────────────
        const partnerForm = document.getElementById('literasi-partner-form');
        if (partnerForm) {
            partnerForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const instansi = (document.getElementById('partner-instansi')?.value || '').trim();
                const nama     = (document.getElementById('partner-nama')?.value || '').trim();
                const wa       = (document.getElementById('partner-wa')?.value || '').trim();
                const topik    = document.getElementById('partner-topik')?.value || '';
                const peserta  = document.getElementById('partner-peserta')?.value || '';
                const catatan  = (document.getElementById('partner-catatan')?.value || '').trim();

                const waTarget = '<?php echo esc_js( $form_set['wa_number'] ); ?>';

                let msg = `*PENGAJUAN KEMITRAAN EDUKASI & LITERASI SYARIAH BSW*\n\n`;
                msg += `Assalamu'alaikum Wr. Wb. Tim Literasi Bank Syariah Wakalumi,\n\n`;
                msg += `Kami bermaksud mengajukan permohonan kegiatan edukasi/sosialisasi literasi keuangan syariah:\n\n`;
                msg += `- Lembaga / Komunitas: ${instansi}\n`;
                msg += `- Nama Narahubung: ${nama}\n`;
                msg += `- Nomor WhatsApp: ${wa}\n`;
                msg += `- Topik Edukasi: ${topik}\n`;
                msg += `- Estimasi Peserta: ${peserta}\n`;
                if (catatan) {
                    msg += `- Catatan / Rencana: ${catatan}\n`;
                }
                msg += `\nMohon informasi ketersediaan jadwal tim edukasi BSW. Terima kasih.\nWassalamu'alaikum Wr. Wb.`;

                const waUrl = `https://wa.me/${waTarget}?text=${encodeURIComponent(msg)}`;
                window.open(waUrl, '_blank');
            });
        }

        // ── MODAL LIGHTBOX TELEPORT & EVENT HANDLERS ────────────────
        const modal = document.getElementById('literasi-detail-modal');
        if (modal && modal.parentNode !== document.body) {
            document.body.appendChild(modal);
        }

        const modalKategori = document.getElementById('modal-lit-kategori');
        const modalSasaran  = document.getElementById('modal-lit-sasaran');
        const modalJudul    = document.getElementById('modal-lit-judul');
        const modalRingkasan= document.getElementById('modal-lit-ringkasan');
        const modalIsi      = document.getElementById('modal-lit-isi');
        const btnClose      = document.getElementById('btn-close-literasi-modal');

        function renderAiryModalContent(rawText) {
            if (!rawText) return '';
            const blocks = rawText.split(/\n\s*\n/);
            return blocks.map(block => {
                const trimmed = block.trim();
                if (!trimmed) return '';
                
                const lines = trimmed.split('\n');
                const isList = lines.some(l => /^(?:\d+\.|\-|\•)\s+/.test(l.trim()));
                
                if (isList) {
                    const listItemsHtml = lines.map(line => {
                        const lTrim = line.trim();
                        if (!lTrim) return '';
                        if (/^(?:\d+\.|\-|\•)\s+/.test(lTrim)) {
                            const itemText = lTrim.replace(/^(?:\d+\.|\-|\•)\s+/, '');
                            const bulletMatch = lTrim.match(/^(\d+\.|\-|\•)/);
                            const bullet = bulletMatch ? bulletMatch[0] : '•';
                            return `<li class="flex items-start gap-3 py-2 leading-relaxed sm:leading-loose">
                                <span class="inline-flex items-center justify-center font-bold text-teal-600 dark:text-teal-400 shrink-0 text-sm mt-0.5">${bullet}</span>
                                <span class="text-slate-700 dark:text-slate-200 text-sm sm:text-base">${itemText}</span>
                            </li>`;
                        } else {
                            return `<p class="font-bold text-slate-900 dark:text-white pt-3 pb-1 text-sm sm:text-base">${lTrim}</p>`;
                        }
                    }).join('');
                    
                    return `<div class="p-4 sm:p-5 rounded-2xl bg-slate-50/80 dark:bg-dark-surface/60 border border-slate-100 dark:border-slate-800/80 my-3">
                        <ul class="space-y-1 divide-y divide-slate-100 dark:divide-slate-800/40">${listItemsHtml}</ul>
                    </div>`;
                }
                
                return `<p class="text-sm sm:text-base leading-relaxed sm:leading-loose text-slate-700 dark:text-slate-200">${trimmed}</p>`;
            }).join('');
        }

        function openLiterasiModal(btn) {
            if (!modal) return;
            const judul     = btn.getAttribute('data-judul') || '';
            const kategori  = btn.getAttribute('data-kategori') || '';
            const sasaran   = btn.getAttribute('data-sasaran') || '';
            const ringkasan = btn.getAttribute('data-ringkasan') || '';
            const isi       = btn.getAttribute('data-isi') || '';

            if (modalJudul) modalJudul.textContent = judul;
            if (modalKategori) modalKategori.textContent = kategori;
            if (modalSasaran) modalSasaran.textContent = sasaran;
            if (modalRingkasan) modalRingkasan.textContent = ringkasan;
            if (modalIsi) modalIsi.innerHTML = renderAiryModalContent(isi);

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLiterasiModal() {
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        document.querySelectorAll('.btn-open-literasi-modal').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                openLiterasiModal(this);
            });
        });

        if (btnClose) btnClose.addEventListener('click', closeLiterasiModal);
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeLiterasiModal();
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                closeLiterasiModal();
            }
        });

        if (window.swup && window.swup.hooks) {
            window.swup.hooks.once('visit:start', function() {
                closeLiterasiModal();
                if (modal && modal.parentNode === document.body) {
                    modal.remove();
                }
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLiterasiPage);
    } else {
        initLiterasiPage();
    }

    if (window.swup && window.swup.hooks) {
        window.swup.hooks.on('page:view', initLiterasiPage);
    }
})();
</script>

<?php get_footer(); ?>

