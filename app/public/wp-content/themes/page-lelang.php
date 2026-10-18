<?php
/**
 * Template Name: Halaman Info Lelang Agunan (AYDA)
 * Description: Portal Publikasi Lelang Agunan & Penjualan Aset BPRS Wakalumi
 * 
 * @package Wakalumi
 */

get_header();

// ── DATA RETRIEVAL ──────────────────────────────────────────────────
$header       = wakalumi_get_lelang_header();
$pilar        = wakalumi_get_lelang_pilar();
$panduan      = wakalumi_get_lelang_panduan();
$cta          = wakalumi_get_lelang_cta();
$categories   = wakalumi_get_lelang_categories();
$statuses     = wakalumi_get_lelang_statuses();
$all_list     = wakalumi_get_lelang_list();

// Extract unique cities/locations for filter
$cities = [];
foreach ( $all_list as $item ) {
    $c = trim( $item['kota'] ?? '' );
    if ( ! empty( $c ) && ! in_array( $c, $cities, true ) ) {
        $cities[] = $c;
    }
}
sort( $cities );

// WhatsApp Hotline
$pic_wa_raw = ! empty( $header['pic_wa'] ) ? $header['pic_wa'] : get_option( 'options_contact_wa', '6281517380388' );
$pic_wa     = preg_replace( '/[^0-9]/', '', $pic_wa_raw );
if ( strpos( $pic_wa, '0' ) === 0 ) {
    $pic_wa = '62' . substr( $pic_wa, 1 );
}
$wa_url = 'https://wa.me/' . $pic_wa;
?>

<div class="min-h-screen bg-transparent text-slate-800 dark:text-dark-text pb-20">

    <!-- ========================================================================
         SECTION 1: HERO HEADER BANNER & SHARIA GOVERNANCE BADGE CARD
         ======================================================================== -->
    <section class="relative z-10 pt-8 sm:pt-10 pb-14 md:pb-18 overflow-hidden bg-slate-50 dark:bg-dark-surface border-b border-slate-200/80 dark:border-dark-border/80 shadow-xs">
        <!-- Ambient Background Glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-80 bg-gradient-to-b from-amber-500/10 via-teal-500/5 to-transparent blur-3xl pointer-events-none"></div>

        <div class="container-wide relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-300 transition-colors flex items-center gap-1.5 font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <span class="text-slate-500 dark:text-slate-400 font-medium">Informasi</span>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <span class="text-teal-600 dark:text-teal-400 font-semibold">Info Lelang Agunan</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Left Column: Title, Intro & Sharia Pillars -->
                <div class="<?php echo ( ! empty( $header['card_show'] ) && $header['card_show'] !== '0' ) ? 'lg:col-span-8' : 'lg:col-span-12 max-w-4xl mx-auto text-center'; ?>">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-100/80 dark:bg-amber-950/60 border border-amber-300/60 dark:border-amber-700/50 text-amber-800 dark:text-amber-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        <?php echo esc_html( $header['badge'] ); ?>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                        <?php echo esc_html( $header['title'] ); ?>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl <?php echo ( empty( $header['card_show'] ) || $header['card_show'] === '0' ) ? 'mx-auto' : ''; ?>">
                        <?php echo esc_html( $header['desc'] ); ?>
                    </p>

                    <!-- Key Trust Highlights Pills -->
                    <?php if ( ! empty( $header['pill_1'] ) || ! empty( $header['pill_2'] ) || ! empty( $header['pill_3'] ) ) : ?>
                        <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300 <?php echo ( empty( $header['card_show'] ) || $header['card_show'] === '0' ) ? 'justify-center' : ''; ?>">
                            <?php if ( ! empty( $header['pill_1'] ) ) : ?>
                                <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span><?php echo esc_html( $header['pill_1'] ); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $header['pill_2'] ) ) : ?>
                                <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                                    <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                    <span><?php echo esc_html( $header['pill_2'] ); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $header['pill_3'] ) ) : ?>
                                <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                                    <svg class="w-4 h-4 text-amber-600 dark:text-amber-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span><?php echo esc_html( $header['pill_3'] ); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ( ! empty( $header['card_show'] ) && $header['card_show'] !== '0' ) : ?>
                    <!-- Right Column: Governance Badge Card with Watermark Pass-Through -->
                    <div class="lg:col-span-4">
                        <div class="spotlight-card relative overflow-hidden rounded-3xl p-6 sm:p-7 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-amber-200/80 dark:border-dark-border shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 text-center space-y-4 group cursor-default before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-amber-500 via-teal-400 to-amber-600">
                            <!-- Interactive Slide Watermark Emblem -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.045] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.08] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                            </div>

                            <!-- Gavel / Auction Icon -->
                            <div class="relative w-16 h-16 rounded-2xl bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 flex items-center justify-center mx-auto shadow-lg shadow-amber-500/10 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 z-10">
                                <div class="absolute inset-0 rounded-2xl bg-amber-400/20 blur-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                <svg class="w-8 h-8 relative z-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m14 13-7.5 7.5a2.12 2.12 0 1 1-3-3L11 10"/>
                                    <path d="m16 16 6-6"/>
                                    <path d="m8 8 6-6"/>
                                    <path d="m9 7 8 8"/>
                                    <path d="m21 11-8-8"/>
                                </svg>
                            </div>

                            <div class="relative z-10">
                                <?php if ( ! empty( $header['card_badge'] ) ) : ?>
                                    <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-50 dark:bg-amber-950 text-amber-800 dark:text-amber-300 text-[10px] font-extrabold uppercase tracking-wider mb-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        <?php echo esc_html( $header['card_badge'] ); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ( ! empty( $header['card_title'] ) ) : ?>
                                    <h4 class="text-lg font-black text-slate-900 dark:text-white">
                                        <?php echo esc_html( $header['card_title'] ); ?>
                                    </h4>
                                <?php endif; ?>
                            </div>

                            <?php if ( ! empty( $header['card_desc'] ) ) : ?>
                                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed relative z-10">
                                    <?php echo esc_html( $header['card_desc'] ); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ( ! empty( $header['card_tag1'] ) || ! empty( $header['card_tag2'] ) ) : ?>
                                <div class="pt-1 relative z-10 flex items-center justify-center gap-2 flex-wrap">
                                    <?php if ( ! empty( $header['card_tag1'] ) ) : ?>
                                        <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <?php echo esc_html( $header['card_tag1'] ); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $header['card_tag1'] ) && ! empty( $header['card_tag2'] ) ) : ?>
                                        <span class="text-slate-300 dark:text-slate-600">•</span>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $header['card_tag2'] ) ) : ?>
                                        <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            <?php echo esc_html( $header['card_tag2'] ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    // Filter active/valid pillars
    $active_pilars = [];
    if ( ! empty( $pilar['items'] ) && is_array( $pilar['items'] ) ) {
        foreach ( $pilar['items'] as $p_item ) {
            $pt = trim( $p_item['title'] ?? '' );
            $pd = trim( $p_item['desc'] ?? '' );
            if ( ! empty( $pt ) || ! empty( $pd ) ) {
                $active_pilars[] = [ 'title' => $pt, 'desc' => $pd ];
            }
        }
    }
    $pilar_count = count( $active_pilars );
    ?>

    <?php if ( ! empty( $pilar['show'] ) && $pilar['show'] !== '0' && $pilar_count > 0 ) : ?>
        <!-- ========================================================================
             SECTION 1.5: PILAR KEPATUHAN SYARIAH & REGULASI
             ======================================================================== -->
        <section class="py-6 sm:py-8 bg-slate-50/60 dark:bg-dark-surface/40 border-b border-slate-200/60 dark:border-dark-border/60 relative z-10">
            <div class="container-wide">
                <div class="relative overflow-hidden rounded-3xl p-6 sm:p-8 bg-gradient-to-br from-emerald-950 via-teal-950 to-slate-950 text-white shadow-xl border border-emerald-500/30 group">
                    <!-- Ambient Glow -->
                    <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

                    <!-- Watermark emblem -->
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 w-48 h-48 opacity-[0.035] pointer-events-none select-none overflow-hidden transition-transform duration-700 ease-out group-hover:scale-110 grayscale mix-blend-screen hidden md:block">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 invert">
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 flex items-center justify-center text-xl shrink-0">⚖️</span>
                            <div>
                                <h3 class="text-base sm:text-lg md:text-xl font-extrabold text-white tracking-tight leading-tight">
                                    <?php echo esc_html( $pilar['title'] ); ?>
                                </h3>
                                <?php if ( ! empty( $pilar['subtitle'] ) ) : ?>
                                    <p class="text-xs sm:text-sm text-emerald-200/80 mt-0.5">
                                        <?php echo esc_html( $pilar['subtitle'] ); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php
                        // Tata letak grid adaptif agar tidak kosong / timpang
                        if ( $pilar_count === 1 ) {
                            $grid_classes = 'grid-cols-1 max-w-xl mx-auto';
                        } elseif ( $pilar_count === 2 ) {
                            $grid_classes = 'grid-cols-1 sm:grid-cols-2 max-w-3xl mx-auto';
                        } elseif ( $pilar_count === 3 ) {
                            $grid_classes = 'grid-cols-1 md:grid-cols-3';
                        } elseif ( $pilar_count === 4 ) {
                            $grid_classes = 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4';
                        } else {
                            $grid_classes = 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3';
                        }
                        ?>
                        <div class="mt-5 grid <?php echo esc_attr( $grid_classes ); ?> gap-4 text-xs sm:text-sm">
                            <?php foreach ( $active_pilars as $p_item ) : ?>
                                <div class="p-4 rounded-2xl bg-white/5 backdrop-blur-sm border border-emerald-400/20 hover:border-emerald-400/40 transition-colors space-y-1.5 flex flex-col justify-start">
                                    <?php if ( ! empty( $p_item['title'] ) ) : ?>
                                        <div class="font-bold text-emerald-300 text-sm flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                            <span><?php echo esc_html( $p_item['title'] ); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $p_item['desc'] ) ) : ?>
                                        <p class="text-slate-300 leading-relaxed text-xs">
                                            <?php echo esc_html( $p_item['desc'] ); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( ! empty( $panduan['show'] ) && $panduan['show'] !== '0' ) : ?>
        <!-- ========================================================================
             SECTION 2: EDUKASI PRINSIP LELANG SYARIAH (DROPDOWN COLLAPSIBLE)
             ======================================================================== -->
        <section class="py-6 bg-white/70 dark:bg-dark-surface/60 backdrop-blur-md border-b border-slate-200/60 dark:border-dark-border/60 relative z-10">
            <div class="container-wide">
                <details class="group bg-gradient-to-r from-teal-50/60 via-slate-50/80 to-amber-50/50 dark:from-teal-950/20 dark:via-dark-card/50 dark:to-amber-950/20 rounded-2xl border border-teal-200/60 dark:border-dark-border p-4 sm:p-5 transition-all">
                    <summary class="flex items-center justify-between cursor-pointer list-none font-bold text-xs sm:text-sm text-slate-800 dark:text-slate-200 select-none">
                        <span class="inline-flex items-center gap-2">
                            <span class="w-7 h-7 rounded-lg bg-teal-500/15 text-teal-600 dark:text-teal-400 flex items-center justify-center text-xs">📖</span>
                            <span><?php echo esc_html( $panduan['title'] ); ?></span>
                        </span>
                        <span class="text-xs font-semibold text-teal-600 dark:text-teal-400 inline-flex items-center gap-1">
                            <span>Pelajari</span>
                            <svg class="w-4 h-4 transition-transform duration-300 group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </span>
                    </summary>
                    
                    <div class="mt-4 pt-4 border-t border-slate-200/60 dark:border-dark-border grid grid-cols-1 md:grid-cols-3 gap-4 text-xs text-slate-600 dark:text-slate-300">
                        <?php if ( ! empty( $panduan['point_1_title'] ) || ! empty( $panduan['point_1_desc'] ) ) : ?>
                            <div class="p-3.5 rounded-xl bg-white/90 dark:bg-dark-card/90 border border-slate-200/80 dark:border-dark-border/80 space-y-1">
                                <strong class="text-slate-900 dark:text-white block font-bold text-sm"><?php echo esc_html( $panduan['point_1_title'] ); ?></strong>
                                <p class="leading-relaxed"><?php echo nl2br( esc_html( $panduan['point_1_desc'] ) ); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $panduan['point_2_title'] ) || ! empty( $panduan['point_2_desc'] ) ) : ?>
                            <div class="p-3.5 rounded-xl bg-white/90 dark:bg-dark-card/90 border border-slate-200/80 dark:border-dark-border/80 space-y-1">
                                <strong class="text-slate-900 dark:text-white block font-bold text-sm"><?php echo esc_html( $panduan['point_2_title'] ); ?></strong>
                                <p class="leading-relaxed"><?php echo nl2br( esc_html( $panduan['point_2_desc'] ) ); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $panduan['point_3_title'] ) || ! empty( $panduan['point_3_desc'] ) ) : ?>
                            <div class="p-3.5 rounded-xl bg-white/90 dark:bg-dark-card/90 border border-slate-200/80 dark:border-dark-border/80 space-y-1">
                                <strong class="text-slate-900 dark:text-white block font-bold text-sm"><?php echo esc_html( $panduan['point_3_title'] ); ?></strong>
                                <p class="leading-relaxed"><?php echo nl2br( esc_html( $panduan['point_3_desc'] ) ); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </details>
            </div>
        </section>
    <?php endif; ?>


    <!-- ========================================================================
         SECTION 3: FILTER PILLS, SEARCH, STATUS & SORT CONTROLS
         ======================================================================== -->
    <section class="py-8 bg-transparent relative z-10 border-b border-slate-200/50 dark:border-dark-border/50">
        <div class="container-wide space-y-5">
            
            <!-- Category Tabs (Horizontal Scroll on Mobile) -->
            <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-1" id="lelang-category-filters" role="tablist">
                <button type="button" data-filter="all" class="lelang-filter-btn active-tab px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-300 whitespace-nowrap bg-gradient-to-r from-teal-600 to-cyan-600 text-white shadow-md shadow-teal-600/20 border border-teal-500">
                    Semua Aset (<?php echo count( $all_list ); ?>)
                </button>
                <?php foreach ( $categories as $ckey => $cval ) : 
                    $count_cat = count( array_filter( $all_list, fn($x) => ( $x['kategori'] ?? '' ) === $ckey ) );
                    if ( $count_cat === 0 ) continue;
                ?>
                    <button type="button" data-filter="<?php echo esc_attr( $ckey ); ?>" class="lelang-filter-btn px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-300 whitespace-nowrap bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 hover:text-teal-600 dark:hover:text-teal-300 border border-slate-200 dark:border-dark-border shadow-xs">
                        <?php echo esc_html( $cval['pill_label'] ?? $cval['label'] ); ?> (<?php echo $count_cat; ?>)
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Search, Status, City & Sort Bar -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 sm:gap-4 items-center">
                <!-- Search Box -->
                <div class="lg:col-span-5 relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text"
                           id="lelang-search-input"
                           placeholder="Cari aset (nama, jalan, kota, kode AYDA)..."
                           class="w-full pl-10 pr-9 py-2.5 text-xs sm:text-sm rounded-xl bg-white/90 dark:bg-dark-card/90 border border-slate-200 dark:border-dark-border text-slate-800 dark:text-white placeholder-slate-400 focus:outline-hidden focus:ring-2 focus:ring-teal-500/50 shadow-xs transition-all">
                    <button type="button" id="lelang-search-clear" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 hidden">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Status Filter Dropdown -->
                <div class="lg:col-span-3">
                    <select id="lelang-status-filter" class="w-full py-2.5 px-3 text-xs sm:text-sm rounded-xl bg-white/90 dark:bg-dark-card/90 border border-slate-200 dark:border-dark-border text-slate-700 dark:text-slate-200 focus:outline-hidden focus:ring-2 focus:ring-teal-500/50 shadow-xs cursor-pointer font-medium">
                        <option value="all">Semua Status Lelang</option>
                        <option value="tersedia">🟢 Tersedia (Siap Beli / Sukarela)</option>
                        <option value="akan_dilelang">🟡 Akan Dilelang (KPKNL)</option>
                        <option value="terjual">⚪ Terjual / Selesai</option>
                    </select>
                </div>

                <!-- City / Wilayah Filter Dropdown -->
                <div class="lg:col-span-2">
                    <select id="lelang-city-filter" class="w-full py-2.5 px-3 text-xs sm:text-sm rounded-xl bg-white/90 dark:bg-dark-card/90 border border-slate-200 dark:border-dark-border text-slate-700 dark:text-slate-200 focus:outline-hidden focus:ring-2 focus:ring-teal-500/50 shadow-xs cursor-pointer font-medium">
                        <option value="all">Semua Kota</option>
                        <?php foreach ( $cities as $ct ) : ?>
                            <option value="<?php echo esc_attr( strtolower( $ct ) ); ?>"><?php echo esc_html( $ct ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Sort Dropdown -->
                <div class="lg:col-span-2">
                    <select id="lelang-sort-filter" class="w-full py-2.5 px-3 text-xs sm:text-sm rounded-xl bg-white/90 dark:bg-dark-card/90 border border-slate-200 dark:border-dark-border text-slate-700 dark:text-slate-200 focus:outline-hidden focus:ring-2 focus:ring-teal-500/50 shadow-xs cursor-pointer font-medium">
                        <option value="default">Urutan Standar</option>
                        <option value="price_asc">Harga: Rendah &rarr; Tinggi</option>
                        <option value="price_desc">Harga: Tinggi &rarr; Rendah</option>
                    </select>
                </div>
            </div>

        </div>
    </section>


    <!-- ========================================================================
         SECTION 4: ASSET CARDS GRID (PRODUK-STANDARD CARDS)
         ======================================================================== -->
    <section class="py-10 bg-transparent relative z-10">
        <div class="container-wide">
            
            <!-- Result Counter Bar -->
            <div class="flex items-center justify-between mb-6 text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                <span id="lelang-result-count">Menampilkan seluruh aset lelang agunan (<?php echo count( $all_list ); ?> aset)</span>
                <span class="inline-flex items-center gap-1.5 font-semibold text-teal-600 dark:text-teal-400">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Update Real-Time
                </span>
            </div>

            <!-- Empty State Notice -->
            <div id="lelang-no-results" class="hidden text-center py-16 px-4 bg-white/80 dark:bg-dark-card/80 backdrop-blur-md rounded-3xl border border-slate-200 dark:border-dark-border max-w-xl mx-auto my-8">
                <div class="w-16 h-16 rounded-full bg-amber-50 dark:bg-amber-950 text-amber-500 flex items-center justify-center mx-auto mb-4 text-2xl">
                    🔍
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Aset Lelang Tidak Ditemukan</h3>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mb-6 leading-relaxed">
                    Tidak ditemukan aset yang cocok dengan filter atau kata kunci Anda. Silakan reset filter pencarian atau hubungi tim remedial kami.
                </p>
                <button type="button" id="btn-reset-filters" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-teal-600 text-white hover:bg-teal-700 shadow-md transition-all">
                    Reset Seluruh Filter
                </button>
            </div>

            <!-- Cards Grid (3 Columns) -->
            <div id="lelang-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <?php 
                $card_idx = 0;
                foreach ( $all_list as $asset ) :
                    $card_idx++;
                    $row_id        = esc_attr( $asset['id'] ?? ( 'lelang_' . $card_idx ) );
                    $kode          = esc_attr( $asset['kode'] ?? ( 'AYDA-' . $card_idx ) );
                    $judul         = esc_attr( $asset['judul'] ?? '' );
                    $kategori      = esc_attr( $asset['kategori'] ?? 'rumah' );
                    $status        = esc_attr( $asset['status'] ?? 'tersedia' );
                    $harga_limit   = esc_attr( $asset['harga_limit'] ?? '' );
                    $nilai_pasar   = esc_attr( $asset['nilai_pasar'] ?? '' );
                    $uang_jaminan  = esc_attr( $asset['uang_jaminan'] ?? '' );
                    $legalitas     = esc_attr( $asset['legalitas'] ?? '' );
                    $luas_tanah    = esc_attr( $asset['luas_tanah'] ?? '' );
                    $luas_bangunan = esc_attr( $asset['luas_bangunan'] ?? '' );
                    $lokasi        = esc_attr( $asset['lokasi'] ?? '' );
                    $kota          = esc_attr( $asset['kota'] ?? 'Tangerang Selatan' );
                    $tgl_lelang    = esc_attr( $asset['tanggal_lelang'] ?? '' );
                    $tempat_lelang = esc_attr( $asset['tempat_lelang'] ?? '' );
                    $foto_utama    = esc_url( $asset['foto_utama'] ?? '' );
                    $galeri_raw    = trim( $asset['galeri_foto'] ?? '' );
                    $deskripsi     = esc_textarea( $asset['deskripsi'] ?? '' );
                    $tata_cara     = esc_textarea( $asset['tata_cara'] ?? '' );
                    $wa_pic        = ! empty( $asset['wa_contact'] ) ? preg_replace( '/[^0-9]/', '', $asset['wa_contact'] ) : $pic_wa;
                    
                    // Parse gallery lines into array
                    $galeri_list = [];
                    if ( ! empty( $foto_utama ) ) {
                        $galeri_list[] = $foto_utama;
                    }
                    if ( ! empty( $galeri_raw ) ) {
                        $lines = explode( "\n", $galeri_raw );
                        foreach ( $lines as $line ) {
                            $u = esc_url_raw( trim( $line ) );
                            if ( ! empty( $u ) && ! in_array( $u, $galeri_list, true ) ) {
                                $galeri_list[] = $u;
                            }
                        }
                    }

                    // Numeric price for sorting
                    $numeric_price = (float) preg_replace( '/[^0-9]/', '', $harga_limit );

                    $cat_info    = $categories[ $kategori ] ?? $categories['rumah'];
                    $status_info = $statuses[ $status ] ?? $statuses['tersedia'];

                    // Determine Prosedur Title and Desc (Custom override or Status Default)
                    $item_prosedur_title = ! empty( $status_info['prosedur_title'] ) ? $status_info['prosedur_title'] : 'Prosedur Keikutsertaan Lelang & Survei Fisik';
                    $item_prosedur_desc  = ! empty( $tata_cara ) ? $tata_cara : ( $status_info['prosedur_desc'] ?? '' );

                    // Determine Kepatuhan Title and Desc (Custom override or Status Default)
                    $item_kepatuhan_title = ! empty( $status_info['kepatuhan_title'] ) ? $status_info['kepatuhan_title'] : 'Kepatuhan Hukum & Fatwa DSN-MUI:';
                    $custom_kepatuhan     = esc_textarea( $asset['kepatuhan_custom'] ?? '' );
                    $item_kepatuhan_desc  = ! empty( $custom_kepatuhan ) ? $custom_kepatuhan : ( $status_info['kepatuhan_desc'] ?? '' );

                    // Pre-filled WhatsApp Inquiry
                    $wa_inquiry_text = rawurlencode( "Assalamu'alaikum BPRS Wakalumi, saya tertarik ingin menanyakan informasi lebih lanjut mengenai Aset Lelang:\n\n• Nama: {$judul}\n• Kode: {$kode}\n• Harga Limit: {$harga_limit}\n• Lokasi: {$kota}\n\nMohon informasi survei fisik & tata cara lelangnya. Terima kasih." );
                    $wa_card_url     = 'https://wa.me/' . $wa_pic . '?text=' . $wa_inquiry_text;
                ?>
                    <article class="lelang-card-item spotlight-card group relative flex flex-col justify-between rounded-3xl bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 overflow-hidden"
                             data-id="<?php echo $row_id; ?>"
                             data-kode="<?php echo esc_attr( strtolower( $kode ) ); ?>"
                             data-category="<?php echo esc_attr( $kategori ); ?>"
                             data-status="<?php echo esc_attr( $status ); ?>"
                             data-city="<?php echo esc_attr( strtolower( $kota ) ); ?>"
                             data-price="<?php echo $numeric_price; ?>"
                             data-title="<?php echo esc_attr( strtolower( $judul ) ); ?>"
                             data-location="<?php echo esc_attr( strtolower( $lokasi . ' ' . $kota ) ); ?>"
                             data-index="<?php echo $card_idx; ?>"
                             data-aos="fade-up"
                             data-aos-delay="<?php echo ( $card_idx % 3 ) * 80; ?>">

                        <!-- Top Glow Gradient Line -->
                        <div class="h-1.5 w-full bg-gradient-to-r from-amber-500 via-teal-500 to-amber-600 transition-opacity opacity-75 group-hover:opacity-100"></div>

                        <!-- Interactive Slide Watermark Emblem on Card -->
                        <div class="absolute -right-6 -bottom-6 w-36 h-36 opacity-[0.055] dark:opacity-[0.04] pointer-events-none select-none overflow-hidden transition-all duration-700 ease-out group-hover:scale-125 group-hover:-translate-x-2 group-hover:-translate-y-2 group-hover:opacity-[0.11] dark:group-hover:opacity-[0.08] mix-blend-multiply dark:mix-blend-screen z-0">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" 
                                 alt="" 
                                 class="w-full h-full object-contain brightness-0 dark:brightness-100" 
                                 loading="lazy"
                                 aria-hidden="true">
                        </div>

                        <!-- Top Graphic Slot: Flush Edge-to-Edge Image -->
                        <div class="relative w-full aspect-[16/10] overflow-hidden bg-slate-100 dark:bg-slate-800 shrink-0 group/img cursor-pointer btn-open-lelang-modal" data-id="<?php echo $row_id; ?>">
                            <?php if ( ! empty( $foto_utama ) ) : ?>
                                <img src="<?php echo esc_url( $foto_utama ); ?>"
                                     alt="<?php echo esc_attr( $judul ); ?>"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                     loading="lazy">
                            <?php else : ?>
                                <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 text-slate-400">
                                    <span class="text-3xl mb-1">🏢</span>
                                    <span class="text-xs font-semibold">Foto Dalam Verifikasi</span>
                                </div>
                            <?php endif; ?>

                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-60 group-hover:opacity-75 transition-opacity duration-300"></div>
                            
                            <!-- Glass Glare Sweep Effect -->
                            <div class="wkl-glass-shine"></div>

                            <!-- Floating Badges on Photo -->
                            <!-- Top Right: Category -->
                            <span class="absolute top-3.5 right-3.5 inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-extrabold px-3 py-1 rounded-full border backdrop-blur-md bg-white/95 dark:bg-slate-900/95 shadow-md z-10 <?php echo esc_attr( $cat_info['badge_class'] ); ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $cat_info['tag_dot'] ); ?>"></span>
                                <?php echo esc_html( $cat_info['pill_label'] ?? $cat_info['label'] ); ?>
                            </span>

                            <!-- Top Left: Status -->
                            <span class="absolute top-3.5 left-3.5 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] sm:text-[11px] font-black uppercase tracking-wider shadow-md z-10 border backdrop-blur-md bg-white/95 dark:bg-slate-900/95 <?php echo esc_attr( $status_info['badge_class'] ); ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $status_info['dot'] ); ?> animate-pulse"></span>
                                <?php echo esc_html( $status_info['badge_label'] ); ?>
                            </span>

                            <!-- Bottom Left: Asset Code -->
                            <div class="absolute bottom-3 left-3.5 z-10">
                                <span class="font-mono text-[10px] sm:text-[11px] font-bold px-2.5 py-0.5 rounded-md bg-black/60 text-white backdrop-blur-md border border-white/20">
                                    <?php echo esc_html( $kode ); ?>
                                </span>
                            </div>

                            <!-- Bottom Right: Photo Counter -->
                            <div class="absolute bottom-3 right-3.5 z-10">
                                <span class="inline-flex items-center gap-1 text-[10px] sm:text-[11px] font-bold px-2 py-0.5 rounded-md bg-black/60 text-white backdrop-blur-md border border-white/20">
                                    <span>📷</span>
                                    <span><?php echo count( $galeri_list ); ?> Foto</span>
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex flex-col flex-1 relative z-10 justify-between">
                            <div>
                                <!-- Location Pin Row -->
                                <div class="flex items-center gap-1.5 text-xs font-semibold text-slate-500 dark:text-slate-400 mb-2">
                                    <svg class="w-3.5 h-3.5 text-teal-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                    <span class="truncate"><?php echo esc_html( $kota ); ?><?php echo ! empty( $lokasi ) ? ' • ' . esc_html( wp_trim_words( $lokasi, 5, '...' ) ) : ''; ?></span>
                                </div>

                                <!-- Judul Aset -->
                                <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white tracking-tight leading-snug group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors mb-3 line-clamp-2 cursor-pointer btn-open-lelang-modal" data-id="<?php echo $row_id; ?>">
                                    <?php echo esc_html( $judul ); ?>
                                </h3>

                                <!-- Specs Chips Row (LT, LB, Legalitas) -->
                                <div class="flex flex-wrap items-center gap-2 mb-4 text-xs">
                                    <?php if ( ! empty( $luas_tanah ) && $luas_tanah !== '-' ) : ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-dark-surface text-slate-700 dark:text-slate-300 border border-slate-200/80 dark:border-dark-border">
                                            <span>📐 LT:</span>
                                            <strong><?php echo esc_html( $luas_tanah ); ?></strong>
                                        </span>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $luas_bangunan ) && $luas_bangunan !== '-' ) : ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-dark-surface text-slate-700 dark:text-slate-300 border border-slate-200/80 dark:border-dark-border">
                                            <span>🏠 LB:</span>
                                            <strong><?php echo esc_html( $luas_bangunan ); ?></strong>
                                        </span>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $legalitas ) ) : ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-teal-50 dark:bg-teal-950/60 text-teal-800 dark:text-teal-300 border border-teal-200/70 dark:border-teal-800/70 font-semibold truncate max-w-[170px]" title="<?php echo esc_attr( $legalitas ); ?>">
                                            <span>📜</span>
                                            <span class="truncate"><?php echo esc_html( $legalitas ); ?></span>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Price Tag Box -->
                                <div class="p-3.5 rounded-2xl bg-gradient-to-br from-slate-50 to-teal-50/40 dark:from-dark-surface dark:to-teal-950/30 border border-slate-200/90 dark:border-dark-border mb-3">
                                    <div class="flex items-baseline justify-between gap-2">
                                        <span class="text-[10px] sm:text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                            Harga Limit Lelang
                                        </span>
                                        <?php if ( ! empty( $nilai_pasar ) ) : ?>
                                            <span class="text-[10px] text-slate-400 dark:text-slate-500 line-through truncate">
                                                Taksiran: <?php echo esc_html( $nilai_pasar ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-xl sm:text-2xl font-black text-emerald-600 dark:text-emerald-400 tracking-tight mt-0.5">
                                        <?php echo esc_html( $harga_limit ); ?>
                                    </div>
                                    <?php if ( ! empty( $uang_jaminan ) ) : ?>
                                        <div class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 mt-1 flex items-center justify-between">
                                            <span>Uang Jaminan:</span>
                                            <span class="font-bold text-slate-700 dark:text-slate-300"><?php echo esc_html( $uang_jaminan ); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Jadwal / Batas Lelang -->
                                <?php if ( ! empty( $tgl_lelang ) ) : ?>
                                    <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 flex items-center gap-1.5 mb-2">
                                        <svg class="w-3.5 h-3.5 text-amber-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span class="truncate"><?php echo esc_html( $tgl_lelang ); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Footer Action Bar -->
                            <div class="pt-4 mt-2 border-t border-slate-100 dark:border-dark-border/80 flex items-center justify-between gap-2 flex-wrap">
                                <!-- WhatsApp Fast Inquiry -->
                                <a href="<?php echo esc_url( $wa_card_url ); ?>"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center gap-1.5 px-3.5 py-2.5 rounded-xl text-xs font-extrabold bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 hover:bg-emerald-100 dark:hover:bg-emerald-900/80 border border-emerald-300/80 dark:border-emerald-700/60 transition-all hover:scale-[1.02] active:scale-[0.98]">
                                    <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    <span>Tanya PIC</span>
                                </a>

                                <!-- Open Detail Modal Button -->
                                <button type="button"
                                        class="btn-open-lelang-modal inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-extrabold bg-teal-600 hover:bg-teal-700 text-white shadow-md shadow-teal-600/20 hover:shadow-teal-600/30 transition-all hover:scale-[1.02] active:scale-[0.98] shrink-0"
                                        data-id="<?php echo $row_id; ?>">
                                    <span>Lihat Detail</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>

                        </div>

                        <!-- Hidden Data Store for Lightbox Modal -->
                        <div class="lelang-modal-data hidden">
                            <span class="data-id"><?php echo $row_id; ?></span>
                            <span class="data-kode"><?php echo esc_html( $kode ); ?></span>
                            <span class="data-title"><?php echo esc_html( $judul ); ?></span>
                            <span class="data-category"><?php echo esc_html( $cat_info['label'] ); ?></span>
                            <span class="data-category-badge"><?php echo esc_attr( $cat_info['badge_class'] ); ?></span>
                            <span class="data-status-key"><?php echo esc_attr( $status ); ?></span>
                            <span class="data-status-label"><?php echo esc_html( $status_info['badge_label'] ); ?></span>
                            <span class="data-status-badge"><?php echo esc_attr( $status_info['badge_class'] ); ?></span>
                            <span class="data-status-dot"><?php echo esc_attr( $status_info['dot'] ); ?></span>
                            <span class="data-harga"><?php echo esc_html( $harga_limit ); ?></span>
                            <span class="data-nilai-pasar"><?php echo esc_html( $nilai_pasar ); ?></span>
                            <span class="data-uang-jaminan"><?php echo esc_html( $uang_jaminan ); ?></span>
                            <span class="data-legalitas"><?php echo esc_html( $legalitas ); ?></span>
                            <span class="data-luas-tanah"><?php echo esc_html( $luas_tanah ); ?></span>
                            <span class="data-luas-bangunan"><?php echo esc_html( $luas_bangunan ); ?></span>
                            <span class="data-lokasi"><?php echo esc_html( $lokasi ); ?></span>
                            <span class="data-kota"><?php echo esc_html( $kota ); ?></span>
                            <span class="data-tanggal"><?php echo esc_html( $tgl_lelang ); ?></span>
                            <span class="data-tempat"><?php echo esc_html( $tempat_lelang ); ?></span>
                            <span class="data-wa-url"><?php echo esc_url( $wa_card_url ); ?></span>
                            <div class="data-gallery-json"><?php echo esc_html( wp_json_encode( $galeri_list ) ); ?></div>
                            <div class="data-deskripsi"><?php echo nl2br( esc_html( $deskripsi ) ); ?></div>
                            <span class="data-prosedur-title"><?php echo esc_html( $item_prosedur_title ); ?></span>
                            <div class="data-tata-cara"><?php echo nl2br( esc_html( $item_prosedur_desc ) ); ?></div>
                            <span class="data-kepatuhan-title"><?php echo esc_html( $item_kepatuhan_title ); ?></span>
                            <div class="data-kepatuhan-desc"><?php echo nl2br( esc_html( $item_kepatuhan_desc ) ); ?></div>
                        </div>

                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Client-Side Smart Pagination Container -->
            <div id="lelang-pagination-wrap" class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-slate-200/80 dark:border-dark-border hidden">
                <div id="lelang-pagination-info" class="text-xs sm:text-sm font-medium text-slate-500 dark:text-slate-400 text-center sm:text-left">
                    <!-- Populated by JS -->
                </div>
                <nav id="lelang-pagination-nav" class="flex items-center gap-1.5 flex-wrap justify-center" aria-label="Navigasi Halaman Aset Lelang">
                    <!-- Populated by JS -->
                </nav>
            </div>

        </div>
    </section>


    <!-- ========================================================================
         SECTION 5: QUICK DETAIL MODAL WITH MULTI-PHOTO SWIPE / LIGHTBOX
         ======================================================================== -->
    <div id="lelang-detail-modal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4 sm:p-6 overflow-y-auto" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div id="lelang-modal-backdrop" class="fixed inset-0 bg-slate-950/75 backdrop-blur-md transition-opacity duration-300 opacity-0"></div>

        <!-- Modal Card Container -->
        <div id="lelang-modal-card" class="relative z-10 w-full max-w-4xl my-auto bg-white dark:bg-dark-card rounded-3xl shadow-2xl border border-slate-200 dark:border-dark-border overflow-hidden transition-all duration-300 transform scale-95 opacity-0 flex flex-col max-h-[90vh]">
            
            <!-- Top Gradient Bar -->
            <div class="h-2 w-full bg-gradient-to-r from-amber-500 via-teal-400 to-amber-600 flex-shrink-0"></div>

            <!-- Modal Header Bar -->
            <div class="px-6 py-4 border-b border-slate-100 dark:border-dark-border/80 flex items-center justify-between gap-4 flex-shrink-0 bg-slate-50/70 dark:bg-dark-surface/50">
                <div class="flex items-center gap-2 flex-wrap">
                    <span id="modal-lelang-kode" class="font-mono text-xs font-bold px-2.5 py-0.5 rounded-md bg-slate-200 dark:bg-dark-surface text-slate-800 dark:text-slate-200 border border-slate-300 dark:border-dark-border"></span>
                    <span id="modal-lelang-category" class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold border"></span>
                    <span id="modal-lelang-status" class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold border"></span>
                </div>

                <!-- Close Button -->
                <button type="button" id="btn-close-lelang-modal" class="w-9 h-9 rounded-xl bg-slate-200/70 dark:bg-dark-surface text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Scrollable Content Body -->
            <div id="lelang-modal-scroll-area" class="overflow-y-auto p-6 sm:p-8 space-y-6 flex-1">
                
                <!-- Asset Title & Location -->
                <div>
                    <h2 id="modal-lelang-title" class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight leading-snug mb-2"></h2>
                    <div class="flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-500 dark:text-slate-400">
                        <svg class="w-4 h-4 text-teal-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        <span id="modal-lelang-location"></span>
                    </div>
                </div>

                <!-- MULTI-PHOTO GALLERY WITH SWIPE & THUMBNAILS -->
                <div id="modal-gallery-wrap" class="relative rounded-2xl overflow-hidden bg-slate-900 border border-slate-200 dark:border-dark-border">
                    <!-- Main Image Display Container -->
                    <div id="modal-slider-viewport" class="relative w-full aspect-[16/10] sm:aspect-[2/1] overflow-hidden select-none">
                        <img id="modal-main-img" src="" alt="" class="w-full h-full object-contain transition-opacity duration-300">
                        
                        <!-- Nav Prev Button -->
                        <button type="button" id="slider-btn-prev" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center transition-all z-20 backdrop-blur-xs">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                        </button>

                        <!-- Nav Next Button -->
                        <button type="button" id="slider-btn-next" class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center transition-all z-20 backdrop-blur-xs">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </button>

                        <!-- Counter Pill -->
                        <div class="absolute bottom-3 right-3.5 z-20">
                            <span id="slider-counter" class="text-xs font-mono font-bold px-3 py-1 rounded-full bg-black/70 text-white backdrop-blur-md border border-white/20">
                                1 / 1
                            </span>
                        </div>
                    </div>

                    <!-- Thumbnails Strip -->
                    <div id="modal-thumbs-row" class="p-3 bg-slate-950/90 flex items-center gap-2 overflow-x-auto no-scrollbar border-t border-white/10">
                        <!-- Populated by JS -->
                    </div>
                </div>

                <!-- Price & Key Numbers Banner -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-5 rounded-2xl bg-gradient-to-br from-teal-50/70 via-slate-50 to-amber-50/50 dark:from-teal-950/40 dark:via-dark-surface dark:to-amber-950/20 border border-teal-200/80 dark:border-dark-border">
                    <div>
                        <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Harga Limit Lelang</span>
                        <span id="modal-price" class="text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400 block mt-0.5"></span>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Nilai Taksiran Pasar</span>
                        <span id="modal-market-price" class="text-lg font-bold text-slate-700 dark:text-slate-300 block mt-1.5"></span>
                    </div>
                    <div>
                        <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider block">Uang Jaminan Penawaran</span>
                        <span id="modal-deposit" class="text-lg font-bold text-amber-600 dark:text-amber-400 block mt-1.5"></span>
                    </div>
                </div>

                <!-- Specifications Grid -->
                <div>
                    <h4 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider mb-3 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                        Spesifikasi Teknis &amp; Legalitas Dokumen
                    </h4>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                        <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border">
                            <span class="text-slate-400 block mb-1">Bukti Kepemilikan</span>
                            <strong id="modal-spec-legalitas" class="text-slate-800 dark:text-slate-200 block text-sm"></strong>
                        </div>
                        <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border">
                            <span class="text-slate-400 block mb-1">Luas Tanah (LT)</span>
                            <strong id="modal-spec-lt" class="text-slate-800 dark:text-slate-200 block text-sm"></strong>
                        </div>
                        <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border">
                            <span class="text-slate-400 block mb-1">Luas Bangunan (LB)</span>
                            <strong id="modal-spec-lb" class="text-slate-800 dark:text-slate-200 block text-sm"></strong>
                        </div>
                        <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border">
                            <span class="text-slate-400 block mb-1">Penyelenggara Lelang</span>
                            <strong id="modal-spec-tempat" class="text-slate-800 dark:text-slate-200 block text-sm truncate"></strong>
                        </div>
                    </div>
                </div>

                <!-- Full Description -->
                <div>
                    <h4 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider mb-3 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                        Deskripsi &amp; Keunggulan Aset
                    </h4>
                    <div id="modal-lelang-desc" class="prose dark:prose-invert max-w-none text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed space-y-3"></div>
                </div>

                <!-- Tata Cara Lelang / Prosedur Pembelian (Dinamis Sesuai Status) -->
                <div id="modal-lelang-prosedur-wrap" class="p-4 sm:p-5 rounded-2xl bg-amber-50/70 dark:bg-amber-950/30 border border-amber-200/80 dark:border-amber-800/60 transition-colors">
                    <h4 class="text-xs sm:text-sm font-bold text-amber-900 dark:text-amber-200 mb-2 flex items-center gap-1.5">
                        <span id="modal-lelang-prosedur-icon">📝</span>
                        <span id="modal-lelang-prosedur-title">Prosedur Keikutsertaan Lelang &amp; Survei Fisik</span>
                    </h4>
                    <div id="modal-lelang-prosedur" class="text-xs text-amber-950/80 dark:text-amber-200/80 leading-relaxed space-y-2"></div>
                </div>

                <!-- Sharia & Legal Notice Box (Dinamis Sesuai Status) -->
                <div id="modal-lelang-kepatuhan-wrap" class="p-4 rounded-xl bg-slate-100 dark:bg-dark-surface border border-slate-200 dark:border-dark-border flex items-start gap-3 text-xs text-slate-600 dark:text-slate-400 leading-relaxed transition-colors">
                    <span id="modal-lelang-kepatuhan-icon" class="text-xl shrink-0">⚖️</span>
                    <div>
                        <strong id="modal-lelang-kepatuhan-title" class="text-slate-800 dark:text-slate-200 block mb-0.5 font-bold">Kepatuhan Hukum &amp; Fatwa DSN-MUI:</strong>
                        <div id="modal-lelang-kepatuhan-desc" class="text-slate-600 dark:text-slate-400 leading-relaxed space-y-1"></div>
                    </div>
                </div>

            </div>

            <!-- Modal Action Footer -->
            <div class="p-4 sm:p-6 border-t border-slate-100 dark:border-dark-border/80 flex items-center justify-between gap-3 flex-wrap bg-slate-50 dark:bg-dark-surface flex-shrink-0">
                <button type="button" id="btn-share-asset" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-white dark:bg-dark-card text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface-alt transition-colors">
                    <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                    <span id="btn-share-text">Bagikan Tautan</span>
                </button>

                <a id="btn-modal-wa" href="" target="_blank" rel="noopener noreferrer" class="btn-whatsapp text-xs sm:text-sm px-6 py-2.5">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <span>Hubungi PIC via WhatsApp</span>
                </a>
            </div>

        </div>
    </div>


    <!-- ========================================================================
         SECTION 6: BOTTOM CTA (CENTERED STYLING SESUAI STANDAR WAKALUMI)
         ======================================================================== -->
    <section class="relative z-10 py-16 md:py-24 overflow-hidden bg-transparent border-t border-slate-200/80 dark:border-dark-border">
        <div class="container-narrow relative z-10">
            <div class="spotlight-card group relative overflow-hidden rounded-3xl p-8 sm:p-12 md:p-16 bg-gradient-to-b from-slate-900 via-slate-900 to-teal-950 text-white text-center shadow-2xl border border-teal-500/30">
                
                <!-- Ambient Glow Orbs -->
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-96 h-96 bg-teal-500/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <!-- Watermark Emblem (Centered Ambient Background) -->
                <div class="absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2 w-80 sm:w-96 h-80 sm:h-96 opacity-[0.04] dark:opacity-[0.05] pointer-events-none select-none overflow-hidden transition-transform duration-700 ease-out group-hover:scale-110 grayscale mix-blend-screen z-0">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 invert">
                </div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-5">
                    <!-- Kicker Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-500/20 text-teal-300 border border-teal-500/40 text-xs font-bold uppercase tracking-wider shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                        <span><?php echo esc_html( $cta['badge'] ); ?></span>
                    </div>
                    <!-- Title -->
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight">
                        <?php echo esc_html( $cta['title'] ); ?>
                    </h2>

                    <!-- Subtitle -->
                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                        <?php echo esc_html( $cta['desc'] ); ?>
                    </p>
                    <!-- Action Buttons Centered -->
                    <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn-whatsapp text-sm px-7 py-3">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <span><?php echo esc_html( $cta['btn1_text'] ); ?></span>
                </a>
                        <?php if ( ! empty( $cta['btn2_text'] ) ) : ?>
                            <a href="<?php echo esc_url( $cta['btn2_url'] ); ?>"
                               class="inline-flex items-center gap-2 px-7 py-4 rounded-xl bg-white/10 hover:bg-white/15 text-white font-bold text-sm border border-white/20 hover:border-white/40 transition-all hover:-translate-y-0.5">
                                <span><?php echo esc_html( $cta['btn2_text'] ); ?></span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Trust Footer Text -->
                    <div class="pt-4 flex items-center justify-center gap-3 text-xs text-slate-400">
                        <span>PT BPRS Wakalumi terdaftar &amp; diawasi oleh OJK</span>
                        <span>•</span>
                        <span>Peserta Penjaminan LPS</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


<!-- ========================================================================
     CLIENT-SIDE INTERACTIVE SCRIPT (PAGINATION, FILTER, SORT & MODAL SWIPER)
     ======================================================================== -->
<script>
(function() {
    function initLelangPage() {
        var grid = document.getElementById('lelang-grid');
        if (!grid) return;

        var cards = Array.from(grid.querySelectorAll('.lelang-card-item'));
        var filterBtns = document.querySelectorAll('#lelang-category-filters .lelang-filter-btn');
        var searchInput = document.getElementById('lelang-search-input');
        var searchClear = document.getElementById('lelang-search-clear');
        var statusFilter = document.getElementById('lelang-status-filter');
        var cityFilter = document.getElementById('lelang-city-filter');
        var sortFilter = document.getElementById('lelang-sort-filter');
        var noResults = document.getElementById('lelang-no-results');
        var resultCount = document.getElementById('lelang-result-count');
        var resetBtn = document.getElementById('btn-reset-filters');

        var paginationWrap = document.getElementById('lelang-pagination-wrap');
        var paginationInfo = document.getElementById('lelang-pagination-info');
        var paginationNav = document.getElementById('lelang-pagination-nav');

        // State Variables
        var currentCategory = 'all';
        var currentSearch = '';
        var currentStatus = 'all';
        var currentCity = 'all';
        var currentSort = 'default';
        var currentPage = 1;
        var itemsPerPage = 9; // 3 rows of 3 columns
        var filteredCards = cards.slice();

        // 1. FILTER & SORT RUNNER
        function applyFiltersAndSort() {
            var searchClean = currentSearch.toLowerCase().trim();

            filteredCards = cards.filter(function(card) {
                // Category filter
                var cat = card.getAttribute('data-category') || '';
                if (currentCategory !== 'all' && cat !== currentCategory) {
                    return false;
                }

                // Status filter
                var st = card.getAttribute('data-status') || '';
                if (currentStatus !== 'all' && st !== currentStatus) {
                    return false;
                }

                // City filter
                var ct = card.getAttribute('data-city') || '';
                if (currentCity !== 'all' && ct !== currentCity) {
                    return false;
                }

                // Search query
                if (searchClean.length > 0) {
                    var title = card.getAttribute('data-title') || '';
                    var loc = card.getAttribute('data-location') || '';
                    var kode = card.getAttribute('data-kode') || '';
                    var fullText = title + ' ' + loc + ' ' + kode;
                    if (fullText.indexOf(searchClean) === -1) {
                        return false;
                    }
                }

                return true;
            });

            // Sorting
            if (currentSort === 'price_asc') {
                filteredCards.sort(function(a, b) {
                    return (parseFloat(a.getAttribute('data-price')) || 0) - (parseFloat(b.getAttribute('data-price')) || 0);
                });
            } else if (currentSort === 'price_desc') {
                filteredCards.sort(function(a, b) {
                    return (parseFloat(b.getAttribute('data-price')) || 0) - (parseFloat(a.getAttribute('data-price')) || 0);
                });
            } else {
                // default sort by original index
                filteredCards.sort(function(a, b) {
                    return (parseInt(a.getAttribute('data-index')) || 0) - (parseInt(b.getAttribute('data-index')) || 0);
                });
            }

            currentPage = 1;
            renderPaginationAndCards();
        }

        // 2. PAGINATION & CARD RENDERING
        function renderPaginationAndCards() {
            var total = filteredCards.length;

            if (total === 0) {
                cards.forEach(function(c) { c.style.display = 'none'; });
                if (noResults) noResults.classList.remove('hidden');
                if (resultCount) resultCount.textContent = 'Tidak ada aset lelang yang cocok.';
                if (paginationWrap) paginationWrap.classList.add('hidden');
                return;
            }

            if (noResults) noResults.classList.add('hidden');
            if (resultCount) resultCount.textContent = 'Menampilkan ' + total + ' aset lelang agunan';

            var totalPages = Math.ceil(total / itemsPerPage);
            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            var startIndex = (currentPage - 1) * itemsPerPage;
            var endIndex = Math.min(startIndex + itemsPerPage, total);

            // Re-order in DOM according to sort and hide non-page cards
            cards.forEach(function(c) { c.style.display = 'none'; });

            for (var i = startIndex; i < endIndex; i++) {
                var card = filteredCards[i];
                card.style.display = '';
                grid.appendChild(card);
            }

            // Render Pagination Nav
            if (totalPages > 1) {
                if (paginationWrap) paginationWrap.classList.remove('hidden');
                if (paginationInfo) {
                    paginationInfo.textContent = 'Menampilkan ' + (startIndex + 1) + ' – ' + endIndex + ' dari ' + total + ' aset';
                }

                if (paginationNav) {
                    paginationNav.innerHTML = '';

                    // Previous Button
                    var prevBtn = document.createElement('button');
                    prevBtn.type = 'button';
                    prevBtn.className = 'px-3 py-1.5 rounded-lg text-xs font-bold transition-colors ' + (currentPage === 1 ? 'text-slate-300 dark:text-slate-600 cursor-not-allowed' : 'text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-dark-surface');
                    prevBtn.innerHTML = '&larr; Sebelumnya';
                    prevBtn.disabled = (currentPage === 1);
                    prevBtn.addEventListener('click', function() {
                        if (currentPage > 1) {
                            currentPage--;
                            renderPaginationAndCards();
                            scrollToGrid();
                        }
                    });
                    paginationNav.appendChild(prevBtn);

                    // Page Number Buttons
                    for (var p = 1; p <= totalPages; p++) {
                        (function(pageNumber) {
                            var pBtn = document.createElement('button');
                            pBtn.type = 'button';
                            var isActive = (pageNumber === currentPage);
                            pBtn.className = 'w-8 h-8 rounded-lg text-xs font-bold transition-all ' + (isActive ? 'bg-teal-600 text-white shadow-sm' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-dark-surface');
                            pBtn.textContent = pageNumber;
                            pBtn.addEventListener('click', function() {
                                currentPage = pageNumber;
                                renderPaginationAndCards();
                                scrollToGrid();
                            });
                            paginationNav.appendChild(pBtn);
                        })(p);
                    }

                    // Next Button
                    var nextBtn = document.createElement('button');
                    nextBtn.type = 'button';
                    nextBtn.className = 'px-3 py-1.5 rounded-lg text-xs font-bold transition-colors ' + (currentPage === totalPages ? 'text-slate-300 dark:text-slate-600 cursor-not-allowed' : 'text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-dark-surface');
                    nextBtn.innerHTML = 'Berikutnya &rarr;';
                    nextBtn.disabled = (currentPage === totalPages);
                    nextBtn.addEventListener('click', function() {
                        if (currentPage < totalPages) {
                            currentPage++;
                            renderPaginationAndCards();
                            scrollToGrid();
                        }
                    });
                    paginationNav.appendChild(nextBtn);
                }
            } else {
                if (paginationWrap) paginationWrap.classList.add('hidden');
            }
        }

        function scrollToGrid() {
            var el = document.getElementById('lelang-category-filters');
            if (el) {
                var top = el.getBoundingClientRect().top + window.pageYOffset - 90;
                window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' });
            }
        }

        // 3. EVENT LISTENERS
        filterBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                filterBtns.forEach(function(b) {
                    b.className = 'lelang-filter-btn px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-300 whitespace-nowrap bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 hover:text-teal-600 dark:hover:text-teal-300 border border-slate-200 dark:border-dark-border shadow-xs';
                });
                btn.className = 'lelang-filter-btn active-tab px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-300 whitespace-nowrap bg-gradient-to-r from-teal-600 to-cyan-600 text-white shadow-md shadow-teal-600/20 border border-teal-500';

                currentCategory = btn.getAttribute('data-filter') || 'all';
                applyFiltersAndSort();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                currentSearch = this.value;
                if (searchClear) {
                    if (currentSearch.length > 0) searchClear.classList.remove('hidden');
                    else searchClear.classList.add('hidden');
                }
                applyFiltersAndSort();
            });
        }

        if (searchClear) {
            searchClear.addEventListener('click', function() {
                if (searchInput) searchInput.value = '';
                currentSearch = '';
                searchClear.classList.add('hidden');
                applyFiltersAndSort();
            });
        }

        if (statusFilter) {
            statusFilter.addEventListener('change', function() {
                currentStatus = this.value;
                applyFiltersAndSort();
            });
        }

        if (cityFilter) {
            cityFilter.addEventListener('change', function() {
                currentCity = this.value;
                applyFiltersAndSort();
            });
        }

        if (sortFilter) {
            sortFilter.addEventListener('change', function() {
                currentSort = this.value;
                applyFiltersAndSort();
            });
        }

        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                currentCategory = 'all';
                currentSearch = '';
                currentStatus = 'all';
                currentCity = 'all';
                currentSort = 'default';

                if (searchInput) searchInput.value = '';
                if (searchClear) searchClear.classList.add('hidden');
                if (statusFilter) statusFilter.value = 'all';
                if (cityFilter) cityFilter.value = 'all';
                if (sortFilter) sortFilter.value = 'default';

                filterBtns.forEach(function(b, idx) {
                    if (idx === 0) {
                        b.className = 'lelang-filter-btn active-tab px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-300 whitespace-nowrap bg-gradient-to-r from-teal-600 to-cyan-600 text-white shadow-md shadow-teal-600/20 border border-teal-500';
                    } else {
                        b.className = 'lelang-filter-btn px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-300 whitespace-nowrap bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 hover:text-teal-600 dark:hover:text-teal-300 border border-slate-200 dark:border-dark-border shadow-xs';
                    }
                });

                applyFiltersAndSort();
            });
        }

        // 4. DETAIL LIGHTBOX MODAL WITH MULTI-PHOTO GALLERY SWIPER
        var modal = document.getElementById('lelang-detail-modal');
        var modalBackdrop = document.getElementById('lelang-modal-backdrop');
        var modalCard = document.getElementById('lelang-modal-card');
        var modalClose = document.getElementById('btn-close-lelang-modal');
        var modalScrollArea = document.getElementById('lelang-modal-scroll-area');

        // Gallery Slider Elements
        var mainImg = document.getElementById('modal-main-img');
        var btnPrev = document.getElementById('slider-btn-prev');
        var btnNext = document.getElementById('slider-btn-next');
        var sliderCounter = document.getElementById('slider-counter');
        var thumbsRow = document.getElementById('modal-thumbs-row');
        var sliderViewport = document.getElementById('modal-slider-viewport');

        var currentGallery = [];
        var currentImgIdx = 0;
        var activeAssetId = '';

        // DOM Teleportation: move modal directly to document.body to avoid Swup transform traps!
        if (modal && modal.parentElement !== document.body) {
            document.body.appendChild(modal);
        }

        function openModal(cardId) {
            var card = document.querySelector('.lelang-card-item[data-id="' + cardId + '"]');
            if (!card) return;

            var dataStore = card.querySelector('.lelang-modal-data');
            if (!dataStore) return;

            activeAssetId = cardId;

            // Extract values
            var kode        = dataStore.querySelector('.data-kode') ? dataStore.querySelector('.data-kode').textContent : '';
            var title       = dataStore.querySelector('.data-title') ? dataStore.querySelector('.data-title').textContent : '';
            var cat         = dataStore.querySelector('.data-category') ? dataStore.querySelector('.data-category').textContent : '';
            var catBadge    = dataStore.querySelector('.data-category-badge') ? dataStore.querySelector('.data-category-badge').textContent : '';
            var stLabel     = dataStore.querySelector('.data-status-label') ? dataStore.querySelector('.data-status-label').textContent : '';
            var stBadge     = dataStore.querySelector('.data-status-badge') ? dataStore.querySelector('.data-status-badge').textContent : '';
            var harga       = dataStore.querySelector('.data-harga') ? dataStore.querySelector('.data-harga').textContent : '';
            var nilaiPasar  = dataStore.querySelector('.data-nilai-pasar') ? dataStore.querySelector('.data-nilai-pasar').textContent : '';
            var deposit     = dataStore.querySelector('.data-uang-jaminan') ? dataStore.querySelector('.data-uang-jaminan').textContent : '';
            var legalitas   = dataStore.querySelector('.data-legalitas') ? dataStore.querySelector('.data-legalitas').textContent : '';
            var lt          = dataStore.querySelector('.data-luas-tanah') ? dataStore.querySelector('.data-luas-tanah').textContent : '';
            var lb          = dataStore.querySelector('.data-luas-bangunan') ? dataStore.querySelector('.data-luas-bangunan').textContent : '';
            var lokasi      = dataStore.querySelector('.data-lokasi') ? dataStore.querySelector('.data-lokasi').textContent : '';
            var kota        = dataStore.querySelector('.data-kota') ? dataStore.querySelector('.data-kota').textContent : '';
            var tempat      = dataStore.querySelector('.data-tempat') ? dataStore.querySelector('.data-tempat').textContent : '';
            var waUrl       = dataStore.querySelector('.data-wa-url') ? dataStore.querySelector('.data-wa-url').textContent : '';
            var deskripsi   = dataStore.querySelector('.data-deskripsi') ? dataStore.querySelector('.data-deskripsi').innerHTML : '';
            var tataCara    = dataStore.querySelector('.data-tata-cara') ? dataStore.querySelector('.data-tata-cara').innerHTML : '';
            var galleryJson = dataStore.querySelector('.data-gallery-json') ? dataStore.querySelector('.data-gallery-json').textContent : '[]';

            try {
                currentGallery = JSON.parse(galleryJson);
            } catch(e) {
                currentGallery = [];
            }
            currentImgIdx = 0;

            // Populate Modal Fields
            var elKode = document.getElementById('modal-lelang-kode');
            if (elKode) elKode.textContent = kode;

            var elTitle = document.getElementById('modal-lelang-title');
            if (elTitle) elTitle.textContent = title;

            var elCat = document.getElementById('modal-lelang-category');
            if (elCat) {
                elCat.textContent = cat;
                elCat.className = 'inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold border ' + catBadge;
            }

            var elSt = document.getElementById('modal-lelang-status');
            if (elSt) {
                elSt.textContent = stLabel;
                elSt.className = 'inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold border ' + stBadge;
            }

            var elLoc = document.getElementById('modal-lelang-location');
            if (elLoc) elLoc.textContent = (lokasi ? lokasi + ', ' : '') + kota;

            var elPrice = document.getElementById('modal-price');
            if (elPrice) elPrice.textContent = harga;

            var elMarket = document.getElementById('modal-market-price');
            if (elMarket) elMarket.textContent = nilaiPasar ? nilaiPasar : '-';

            var elDep = document.getElementById('modal-deposit');
            if (elDep) elDep.textContent = deposit ? deposit : '-';

            var elSpecLeg = document.getElementById('modal-spec-legalitas');
            if (elSpecLeg) elSpecLeg.textContent = legalitas || '-';

            var elSpecLt = document.getElementById('modal-spec-lt');
            if (elSpecLt) elSpecLt.textContent = lt || '-';

            var elSpecLb = document.getElementById('modal-spec-lb');
            if (elSpecLb) elSpecLb.textContent = lb || '-';

            var elSpecTempat = document.getElementById('modal-spec-tempat');
            if (elSpecTempat) elSpecTempat.textContent = tempat || '-';

            var elDesc = document.getElementById('modal-lelang-desc');
            if (elDesc) elDesc.innerHTML = deskripsi;

            // Prosedur Keikutsertaan / Pembelian Dinamis
            var elProsedurWrap    = document.getElementById('modal-lelang-prosedur-wrap');
            var elProsedurTitle   = document.getElementById('modal-lelang-prosedur-title');
            var elProsedurIcon    = document.getElementById('modal-lelang-prosedur-icon');
            var elProsedur        = document.getElementById('modal-lelang-prosedur');
            var prosedurTitleVal  = dataStore.querySelector('.data-prosedur-title') ? dataStore.querySelector('.data-prosedur-title').textContent : '';
            var stKey             = dataStore.querySelector('.data-status-key') ? dataStore.querySelector('.data-status-key').textContent : '';

            if (elProsedurTitle && prosedurTitleVal) {
                elProsedurTitle.textContent = prosedurTitleVal;
            }

            // Adapt Prosedur box styling according to status
            if (elProsedurWrap) {
                if (stKey === 'tersedia') {
                    elProsedurWrap.className = 'p-4 sm:p-5 rounded-2xl bg-emerald-50/70 dark:bg-emerald-950/30 border border-emerald-200/80 dark:border-emerald-800/60 transition-colors';
                    if (elProsedurTitle) elProsedurTitle.className = 'text-xs sm:text-sm font-bold text-emerald-900 dark:text-emerald-200 mb-2 flex items-center gap-1.5';
                    if (elProsedur) elProsedur.className = 'text-xs text-emerald-950/80 dark:text-emerald-200/80 leading-relaxed space-y-2';
                    if (elProsedurIcon) elProsedurIcon.textContent = '🤝';
                } else if (stKey === 'terjual') {
                    elProsedurWrap.className = 'p-4 sm:p-5 rounded-2xl bg-slate-100/80 dark:bg-slate-800/40 border border-slate-300 dark:border-slate-700 transition-colors';
                    if (elProsedurTitle) elProsedurTitle.className = 'text-xs sm:text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 flex items-center gap-1.5';
                    if (elProsedur) elProsedur.className = 'text-xs text-slate-600 dark:text-slate-400 leading-relaxed space-y-2';
                    if (elProsedurIcon) elProsedurIcon.textContent = '🔒';
                } else {
                    // akan_dilelang / default
                    elProsedurWrap.className = 'p-4 sm:p-5 rounded-2xl bg-amber-50/70 dark:bg-amber-950/30 border border-amber-200/80 dark:border-amber-800/60 transition-colors';
                    if (elProsedurTitle) elProsedurTitle.className = 'text-xs sm:text-sm font-bold text-amber-900 dark:text-amber-200 mb-2 flex items-center gap-1.5';
                    if (elProsedur) elProsedur.className = 'text-xs text-amber-950/80 dark:text-amber-200/80 leading-relaxed space-y-2';
                    if (elProsedurIcon) elProsedurIcon.textContent = '📝';
                }
            }

            if (elProsedur) {
                if (tataCara.trim().length > 0) {
                    elProsedur.innerHTML = tataCara;
                    if (elProsedurWrap) elProsedurWrap.classList.remove('hidden');
                } else {
                    if (elProsedurWrap) elProsedurWrap.classList.add('hidden');
                }
            }

            // Kepatuhan Hukum & Fatwa DSN-MUI Dinamis Sesuai Status
            var elKepatuhanWrap   = document.getElementById('modal-lelang-kepatuhan-wrap');
            var elKepatuhanTitle  = document.getElementById('modal-lelang-kepatuhan-title');
            var elKepatuhanDesc   = document.getElementById('modal-lelang-kepatuhan-desc');
            var elKepatuhanIcon   = document.getElementById('modal-lelang-kepatuhan-icon');
            var kepatuhanTitleVal = dataStore.querySelector('.data-kepatuhan-title') ? dataStore.querySelector('.data-kepatuhan-title').textContent : '';
            var kepatuhanDescVal  = dataStore.querySelector('.data-kepatuhan-desc') ? dataStore.querySelector('.data-kepatuhan-desc').innerHTML : '';

            if (elKepatuhanTitle && kepatuhanTitleVal) {
                elKepatuhanTitle.textContent = kepatuhanTitleVal;
            }
            if (elKepatuhanDesc) {
                elKepatuhanDesc.innerHTML = kepatuhanDescVal;
            }

            if (elKepatuhanWrap) {
                if (stKey === 'tersedia') {
                    elKepatuhanWrap.className = 'p-4 rounded-xl bg-teal-50/70 dark:bg-teal-950/30 border border-teal-200/80 dark:border-teal-800/60 flex items-start gap-3 text-xs text-teal-900 dark:text-teal-200 leading-relaxed transition-colors';
                    if (elKepatuhanTitle) elKepatuhanTitle.className = 'text-teal-950 dark:text-teal-100 block mb-0.5 font-bold';
                    if (elKepatuhanDesc) elKepatuhanDesc.className = 'text-teal-900/90 dark:text-teal-300 leading-relaxed space-y-1';
                    if (elKepatuhanIcon) elKepatuhanIcon.textContent = '⚖️';
                } else if (stKey === 'terjual') {
                    elKepatuhanWrap.className = 'p-4 rounded-xl bg-slate-100 dark:bg-dark-surface border border-slate-200 dark:border-dark-border flex items-start gap-3 text-xs text-slate-600 dark:text-slate-400 leading-relaxed transition-colors';
                    if (elKepatuhanTitle) elKepatuhanTitle.className = 'text-slate-800 dark:text-slate-200 block mb-0.5 font-bold';
                    if (elKepatuhanDesc) elKepatuhanDesc.className = 'text-slate-600 dark:text-slate-400 leading-relaxed space-y-1';
                    if (elKepatuhanIcon) elKepatuhanIcon.textContent = '📜';
                } else {
                    elKepatuhanWrap.className = 'p-4 rounded-xl bg-slate-100 dark:bg-dark-surface border border-slate-200 dark:border-dark-border flex items-start gap-3 text-xs text-slate-600 dark:text-slate-400 leading-relaxed transition-colors';
                    if (elKepatuhanTitle) elKepatuhanTitle.className = 'text-slate-800 dark:text-slate-200 block mb-0.5 font-bold';
                    if (elKepatuhanDesc) elKepatuhanDesc.className = 'text-slate-600 dark:text-slate-400 leading-relaxed space-y-1';
                    if (elKepatuhanIcon) elKepatuhanIcon.textContent = '⚖️';
                }

                if (kepatuhanDescVal.trim().length > 0) {
                    elKepatuhanWrap.classList.remove('hidden');
                } else {
                    elKepatuhanWrap.classList.add('hidden');
                }
            }

            var btnWa = document.getElementById('btn-modal-wa');
            if (btnWa) btnWa.href = waUrl;

            // Render Gallery Photos
            renderGallery();

            // Show Modal with Animation
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            if (modalScrollArea) modalScrollArea.scrollTop = 0;

            setTimeout(function() {
                if (modalBackdrop) modalBackdrop.classList.remove('opacity-0');
                if (modalCard) {
                    modalCard.classList.remove('scale-95', 'opacity-0');
                    modalCard.classList.add('scale-100', 'opacity-100');
                }
            }, 20);

            // Update URL hash safely without jumping
            if (window.history && window.history.replaceState) {
                window.history.replaceState(null, '', '#' + cardId);
            }
        }

        function closeModal() {
            if (!modal || modal.classList.contains('hidden')) return;

            if (modalBackdrop) modalBackdrop.classList.add('opacity-0');
            if (modalCard) {
                modalCard.classList.remove('scale-100', 'opacity-100');
                modalCard.classList.add('scale-95', 'opacity-0');
            }

            setTimeout(function() {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
                if (window.history && window.history.replaceState) {
                    window.history.replaceState(null, '', window.location.pathname);
                }
            }, 300);
        }

        function renderGallery() {
            if (!thumbsRow || !mainImg) return;

            thumbsRow.innerHTML = '';

            if (currentGallery.length === 0) {
                mainImg.src = '';
                if (btnPrev) btnPrev.style.display = 'none';
                if (btnNext) btnNext.style.display = 'none';
                if (sliderCounter) sliderCounter.textContent = '0 / 0';
                return;
            }

            if (currentImgIdx >= currentGallery.length) currentImgIdx = 0;
            if (currentImgIdx < 0) currentImgIdx = currentGallery.length - 1;

            mainImg.src = currentGallery[currentImgIdx];

            if (sliderCounter) {
                sliderCounter.textContent = (currentImgIdx + 1) + ' / ' + currentGallery.length;
            }

            if (currentGallery.length <= 1) {
                if (btnPrev) btnPrev.style.display = 'none';
                if (btnNext) btnNext.style.display = 'none';
            } else {
                if (btnPrev) btnPrev.style.display = 'flex';
                if (btnNext) btnNext.style.display = 'flex';
            }

            // Populate Thumbnail buttons
            currentGallery.forEach(function(url, idx) {
                var thumb = document.createElement('button');
                thumb.type = 'button';
                var isSelected = (idx === currentImgIdx);
                thumb.className = 'w-14 h-10 rounded-lg overflow-hidden border-2 shrink-0 transition-all ' + (isSelected ? 'border-teal-500 scale-105 opacity-100 shadow-sm' : 'border-transparent opacity-50 hover:opacity-100');
                thumb.innerHTML = '<img src="' + url + '" class="w-full h-full object-cover" alt="Thumbnail ' + (idx + 1) + '">';
                thumb.addEventListener('click', function() {
                    currentImgIdx = idx;
                    renderGallery();
                });
                thumbsRow.appendChild(thumb);
            });
        }

        if (btnPrev) {
            btnPrev.addEventListener('click', function(e) {
                e.stopPropagation();
                if (currentGallery.length > 1) {
                    currentImgIdx--;
                    renderGallery();
                }
            });
        }

        if (btnNext) {
            btnNext.addEventListener('click', function(e) {
                e.stopPropagation();
                if (currentGallery.length > 1) {
                    currentImgIdx++;
                    renderGallery();
                }
            });
        }

        // Touch Swipe Gestures for Mobile
        var touchStartX = 0;
        var touchEndX = 0;

        if (sliderViewport) {
            sliderViewport.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            sliderViewport.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipeGesture();
            }, { passive: true });
        }

        function handleSwipeGesture() {
            var threshold = 40; // minimum distance
            if (touchEndX < touchStartX - threshold) {
                // Swiped Left -> Next Image
                if (currentGallery.length > 1) {
                    currentImgIdx++;
                    renderGallery();
                }
            } else if (touchEndX > touchStartX + threshold) {
                // Swiped Right -> Previous Image
                if (currentGallery.length > 1) {
                    currentImgIdx--;
                    renderGallery();
                }
            }
        }

        // Open Modal Event Delegation
        document.addEventListener('click', function(e) {
            var target = e.target.closest ? e.target.closest('.btn-open-lelang-modal') : null;
            if (target) {
                e.preventDefault();
                var assetId = target.getAttribute('data-id');
                if (assetId) openModal(assetId);
            }
        });

        if (modalClose) {
            modalClose.addEventListener('click', closeModal);
        }

        if (modalBackdrop) {
            modalBackdrop.addEventListener('click', closeModal);
        }

        // Close on Escape Key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
            if (e.key === 'ArrowLeft' && modal && !modal.classList.contains('hidden') && currentGallery.length > 1) {
                currentImgIdx--;
                renderGallery();
            }
            if (e.key === 'ArrowRight' && modal && !modal.classList.contains('hidden') && currentGallery.length > 1) {
                currentImgIdx++;
                renderGallery();
            }
        });

        // Share Link Button
        var shareBtn = document.getElementById('btn-share-asset');
        var shareText = document.getElementById('btn-share-text');
        if (shareBtn) {
            shareBtn.addEventListener('click', function() {
                var shareUrl = window.location.origin + window.location.pathname + '#' + activeAssetId;
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(shareUrl).then(function() {
                        if (shareText) shareText.textContent = 'Tautan Disalin! ✓';
                        setTimeout(function() {
                            if (shareText) shareText.textContent = 'Bagikan Tautan';
                        }, 2500);
                    });
                } else {
                    prompt('Salin tautan aset lelang ini:', shareUrl);
                }
            });
        }

        // 5. DEEP LINKING HASH CHECK ON LOAD
        if (window.location.hash) {
            var rawHash = window.location.hash.replace('#', '').trim();
            if (rawHash) {
                // Look up by id or kode
                var targetCard = cards.find(function(c) {
                    return c.getAttribute('data-id') === rawHash || c.getAttribute('data-kode') === rawHash.toLowerCase();
                });
                if (targetCard) {
                    var targetId = targetCard.getAttribute('data-id');
                    setTimeout(function() {
                        openModal(targetId);
                    }, 350);
                }
            }
        }

        // Initial Render
        applyFiltersAndSort();

        // Swup SPA Cleanup
        if (window.swup) {
            window.swup.hooks.on('visit:start', function() {
                closeModal();
                if (modal && modal.parentNode) {
                    modal.parentNode.removeChild(modal);
                }
            }, { once: true });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLelangPage);
    } else {
        initLelangPage();
    }

    // Support Swup Navigation
    document.addEventListener('swup:contentReplaced', initLelangPage);
})();
</script>

<?php
get_footer();

