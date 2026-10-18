<?php
/**
 * Archive Berita (News & Editorial Portal) Template
 * High-End Banking Editorial Archive & Category Hub
 *
 * @package Wakalumi
 */

get_header();

// ── CONFIG & CONTEXT RETRIEVAL ───────────────────────────────────────
$header   = function_exists( 'wakalumi_get_berita_header' ) ? wakalumi_get_berita_header() : [];
$cta      = function_exists( 'wakalumi_get_berita_cta' ) ? wakalumi_get_berita_cta() : [];
$settings = function_exists( 'wakalumi_get_berita_settings' ) ? wakalumi_get_berita_settings() : [
    'show_headline'     => true,
    'show_reading_time' => true,
];

// Check Category Context
$is_category   = is_tax( 'kategori_berita' );
$current_term  = $is_category ? get_queried_object() : null;
$paged         = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );

// Get all categories for filter pills
$all_terms = get_terms( [
    'taxonomy'   => 'kategori_berita',
    'hide_empty' => true,
] );

// Count total published berita
$total_berita_count = wp_count_posts( 'berita' )->publish ?? 0;

// WhatsApp URL
$wa_url = $cta['btn2_url'] ?? 'https://wa.me/6281517380388';

// Headline post ID (to exclude from main grid if already featured on page 1)
$featured_headline_id = 0;
?>

<div class="min-h-screen bg-transparent text-slate-800 dark:text-dark-text pb-24">

    <!-- ========================================================================
         SECTION 1: HERO HEADER BANNER & MEDIA SPOTLIGHT CARD
         ======================================================================== -->
    <section class="relative z-10 pt-8 sm:pt-10 pb-14 md:pb-18 overflow-hidden bg-slate-50 dark:bg-dark-surface border-b border-slate-200/80 dark:border-dark-border/80 shadow-xs">
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
                <span class="text-slate-500 dark:text-slate-400 font-medium">Warta &amp; Media</span>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <?php if ( $is_category && $current_term ) : ?>
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'berita' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-300 transition-colors">
                        Berita &amp; Artikel
                    </a>
                    <span class="text-slate-300 dark:text-slate-600">/</span>
                    <span class="text-teal-600 dark:text-teal-400 font-semibold"><?php echo esc_html( $current_term->name ); ?></span>
                <?php else : ?>
                    <span class="text-teal-600 dark:text-teal-400 font-semibold">Berita &amp; Artikel</span>
                <?php endif; ?>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Left Column: Title & Intro -->
                <div class="lg:col-span-8" data-aos="fade-up">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        <?php echo esc_html( $is_category && $current_term ? 'Kategori: ' . $current_term->name : ( $header['badge'] ?? 'Warta & Publikasi Syariah' ) ); ?>
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                        <?php 
                        if ( $is_category && $current_term ) {
                            echo esc_html( $current_term->name );
                        } else {
                            echo esc_html( $header['title'] ?? 'Berita, Artikel & Kabar Terkini' );
                        }
                        ?>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                        <?php 
                        if ( $is_category && $current_term && ! empty( $current_term->description ) ) {
                            echo esc_html( $current_term->description );
                        } else {
                            echo esc_html( $header['desc'] ?? 'Informasi komprehensif seputar inovasi layanan perbankan syariah, agenda kemaslahatan umat, literasi muamalah, serta siaran pers resmi BPRS Wakalumi.' );
                        }
                        ?>
                    </p>

                    <!-- Key Editorial Highlights Pills -->
                    <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            <span><?php echo esc_html( $header['card_highlight_1'] ?? 'Liputan Resmi Bank' ); ?></span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.516 0c.85.493 1.508 1.333 1.508 2.316V18"/></svg>
                            <span><?php echo esc_html( $header['card_highlight_2'] ?? 'Edukasi Syariah & Muamalah' ); ?></span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span><?php echo esc_html( $header['card_highlight_3'] ?? 'Siaran Pers Terverifikasi' ); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Media Center Spotlight Card -->
                <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="spotlight-card relative overflow-hidden rounded-3xl p-6 sm:p-7 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-teal-200/80 dark:border-dark-border shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 text-center space-y-4 group cursor-default before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-teal-500 via-cyan-400 to-teal-600">
                        
                        <!-- Interactive Slide Watermark Emblem -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.045] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.08] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>

                        <!-- Holographic Newspaper / Megaphone Icon Box -->
                        <div class="relative w-16 h-16 rounded-2xl bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-300 flex items-center justify-center mx-auto shadow-lg shadow-teal-500/10 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 z-10">
                            <div class="absolute inset-0 rounded-2xl bg-teal-400/20 blur-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <svg class="w-8 h-8 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-teal-50 dark:bg-teal-950 text-teal-700 dark:text-teal-300 text-[10px] font-extrabold uppercase tracking-wider mb-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                <?php echo esc_html( $header['card_badge'] ?? 'Media Center' ); ?>
                            </div>
                            <h4 class="text-lg font-black text-slate-900 dark:text-white">
                                <?php echo esc_html( $header['card_title'] ?? 'Pusat Siaran Pers & Edukasi' ); ?>
                            </h4>
                        </div>

                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed relative z-10">
                            <?php echo esc_html( $header['card_desc'] ?? 'Kanal resmi komunikasi publik dan publikasi artikel edukatif muamalah yang kredibel, akuntabel, dan berizin resmi OJK.' ); ?>
                        </p>

                        <div class="pt-1 relative z-10 flex items-center justify-center gap-2">
                            <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Berizin &amp; Diawasi OJK
                            </span>
                            <span class="text-slate-300 dark:text-slate-600">•</span>
                            <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Dijamin LPS
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========================================================================
         SECTION 2: FEATURED / HEADLINE HERO STORY (Hanya di Halaman Utama / Hal 1)
         ======================================================================== -->
    <?php
    if ( $settings['show_headline'] && $paged <= 1 && ! $is_category ) :
        $headline_query = new WP_Query( [
            'post_type'      => 'berita',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ] );

        if ( $headline_query->have_posts() ) :
            while ( $headline_query->have_posts() ) : $headline_query->the_post();
                $featured_headline_id = get_the_ID();
                $headline_ringkasan   = get_field( 'berita_ringkasan' ) ?: get_the_excerpt();
                $headline_categories  = get_the_terms( get_the_ID(), 'kategori_berita' );
                $headline_cat_name    = ( $headline_categories && ! is_wp_error( $headline_categories ) ) ? $headline_categories[0]->name : 'Berita Utama';
                $headline_read_time   = function_exists( 'wakalumi_calculate_reading_time' ) 
                    ? wakalumi_calculate_reading_time( get_the_content() ) 
                    : '4 mnt baca';
                $headline_penulis     = get_field( 'berita_penulis' ) ?: 'Redaksi BPRS Wakalumi';

                // External Source Metadata
                $headline_is_ext     = get_post_meta( get_the_ID(), 'berita_is_external', true ) === '1' || ! empty( get_post_meta( get_the_ID(), 'berita_external_url', true ) );
                $headline_ext_src    = get_post_meta( get_the_ID(), 'berita_external_source', true );
                $headline_ext_url    = get_post_meta( get_the_ID(), 'berita_external_url', true );
                $headline_ext_mode   = get_post_meta( get_the_ID(), 'berita_external_mode', true ) ?: 'direct';

                $headline_is_direct  = ( $headline_is_ext && $headline_ext_mode === 'direct' && ! empty( $headline_ext_url ) );
                $headline_url        = $headline_is_direct ? $headline_ext_url : get_permalink();
                $headline_target     = $headline_is_direct ? '_blank' : '_self';
                $headline_penulis_disp = ( $headline_is_ext && ! empty( $headline_ext_src ) ) ? $headline_ext_src : $headline_penulis;
                ?>
                <section class="pt-10 pb-4 bg-transparent relative z-10">
                    <div class="container-wide">
                        <div class="spotlight-card relative overflow-hidden rounded-3xl bg-white dark:bg-dark-card border border-teal-200/90 dark:border-dark-border shadow-xl hover:shadow-2xl transition-all duration-300 group">
                            <div class="grid grid-cols-1 lg:grid-cols-12 items-stretch">
                                <!-- Image Side (7 cols) -->
                                <a href="<?php echo esc_url( $headline_url ); ?>" 
                                   <?php if ( $headline_is_direct ) : ?>target="_blank" rel="noopener noreferrer"<?php endif; ?>
                                   class="lg:col-span-7 relative overflow-hidden aspect-[16/10] lg:aspect-auto lg:min-h-[380px] bg-slate-100 dark:bg-slate-800 block">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'hero-large', [
                                            'class' => 'w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105',
                                        ] ); ?>
                                    <?php else : ?>
                                        <div class="w-full h-full bg-gradient-to-tr from-teal-700 via-primary-800 to-slate-900 flex flex-col items-center justify-center p-8 text-center">
                                            <div class="w-16 h-16 rounded-3xl bg-white/10 backdrop-blur-md flex items-center justify-center text-teal-200 mb-3">
                                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                                            </div>
                                            <span class="text-sm font-extrabold text-white tracking-wider">Sorotan Berita Wakalumi</span>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Top Badges Overlay -->
                                    <div class="absolute top-4 left-4 z-10 flex flex-wrap items-center gap-2">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-black bg-amber-500 text-white shadow-md">
                                            ⭐ Sorotan Utama
                                        </span>
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-extrabold bg-white/95 dark:bg-dark-card/95 text-teal-800 dark:text-teal-300 backdrop-blur-md shadow-sm">
                                            <?php echo esc_html( $headline_cat_name ); ?>
                                        </span>
                                        <?php if ( $headline_is_ext ) : ?>
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-black bg-cyan-600 text-white shadow-md">
                                                🌐 <?php echo esc_html( ! empty( $headline_ext_src ) ? $headline_ext_src : 'Liputan Media' ); ?><?php if ( $headline_is_direct ) : ?> ↗<?php endif; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Reading Time / Tautan Luar (Top Right) -->
                                    <div class="absolute top-4 right-4 z-10">
                                        <?php if ( $headline_is_direct ) : ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-900/85 text-cyan-300 backdrop-blur-md shadow-sm">
                                                <svg class="w-3.5 h-3.5 text-cyan-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                                Tautan Luar
                                            </span>
                                        <?php else : ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-900/80 text-white backdrop-blur-md shadow-sm">
                                                <svg class="w-3.5 h-3.5 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <?php echo esc_html( $headline_read_time ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </a>

                                <!-- Content Side (5 cols) -->
                                <div class="lg:col-span-5 p-7 sm:p-9 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 mb-4">
                                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                            <time datetime="<?php echo get_the_date( 'c' ); ?>" class="font-semibold">
                                                <?php echo get_the_date( 'j F Y' ); ?>
                                            </time>
                                            <span class="text-slate-300 dark:text-slate-600">•</span>
                                            <span class="font-medium text-slate-600 dark:text-slate-300 flex items-center gap-1">
                                                <?php if ( $headline_is_ext ) : ?>
                                                    <svg class="w-3.5 h-3.5 text-cyan-600 dark:text-cyan-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                                                <?php endif; ?>
                                                <?php echo esc_html( $headline_penulis_disp ); ?>
                                            </span>
                                        </div>

                                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white leading-tight mb-4 group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                                            <a href="<?php echo esc_url( $headline_url ); ?>" <?php if ( $headline_is_direct ) : ?>target="_blank" rel="noopener noreferrer"<?php endif; ?>>
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>

                                        <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed line-clamp-4 mb-6">
                                            <?php echo esc_html( wp_strip_all_tags( $headline_ringkasan ) ); ?>
                                        </p>
                                    </div>

                                    <div class="pt-6 border-t border-slate-100 dark:border-dark-border flex items-center justify-between flex-wrap gap-4">
                                        <a href="<?php echo esc_url( $headline_url ); ?>" 
                                           <?php if ( $headline_is_direct ) : ?>target="_blank" rel="noopener noreferrer"<?php endif; ?>
                                           class="btn-primary text-sm font-bold inline-flex items-center gap-2 px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition-all">
                                            <?php if ( $headline_is_direct ) : ?>
                                                <span>Buka di <?php echo esc_html( ! empty( $headline_ext_src ) ? $headline_ext_src : 'Situs Sumber' ); ?></span>
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                            <?php elseif ( $headline_is_ext ) : ?>
                                                <span>Baca Cuplikan</span>
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                            <?php else : ?>
                                                <span>Baca Ulasan Lengkap</span>
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                            <?php endif; ?>
                                        </a>

                                        <?php if ( $headline_is_ext ) : ?>
                                            <span class="text-xs font-bold text-cyan-600 dark:text-cyan-400 inline-flex items-center gap-1.5">
                                                <span class="w-2 h-2 rounded-full bg-cyan-500 animate-pulse"></span>
                                                Liputan Media
                                            </span>
                                        <?php else : ?>
                                            <span class="text-xs font-bold text-slate-400 dark:text-slate-500 inline-flex items-center gap-1.5">
                                                <svg class="w-4 h-4 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                                Rilis Terverifikasi
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
    endif;
    ?>


    <!-- ========================================================================
         SECTION 3: FILTER PILLS & RESULT COUNTER
         ======================================================================== -->
    <section class="py-8 bg-transparent relative z-10 border-b border-slate-200/50 dark:border-dark-border/50">
        <div class="container-wide">
            <div class="flex flex-wrap items-center justify-between gap-4">
                
                <!-- Category Filter Pills -->
                <div class="flex flex-wrap items-center gap-2 overflow-x-auto pb-1 scrollbar-none">
                    <!-- Semua Kategori Pill -->
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'berita' ) ); ?>"
                       class="px-4 py-2 rounded-xl text-xs sm:text-sm font-extrabold transition-all duration-200 flex items-center gap-2 shadow-xs
                              <?php echo ! $is_category
                                  ? 'bg-teal-600 text-white shadow-teal-500/20' 
                                  : 'bg-white dark:bg-dark-card text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-dark-card/80 border border-slate-200/80 dark:border-dark-border'; ?>">
                        <span>Semua Berita</span>
                        <span class="px-2 py-0.5 rounded-full text-[10px] <?php echo ! $is_category ? 'bg-white/20 text-white' : 'bg-slate-100 dark:bg-dark-border text-slate-500 dark:text-slate-400'; ?>">
                            <?php echo esc_html( $total_berita_count ); ?>
                        </span>
                    </a>

                    <!-- Specific Category Terms -->
                    <?php if ( ! empty( $all_terms ) && ! is_wp_error( $all_terms ) ) : ?>
                        <?php foreach ( $all_terms as $term ) : 
                            $is_active_term = ( $is_category && $current_term && $current_term->term_id === $term->term_id );
                        ?>
                            <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"
                               class="px-4 py-2 rounded-xl text-xs sm:text-sm font-extrabold transition-all duration-200 flex items-center gap-2 shadow-xs
                                      <?php echo $is_active_term 
                                          ? 'bg-teal-600 text-white shadow-teal-500/20' 
                                          : 'bg-white dark:bg-dark-card text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-dark-card/80 border border-slate-200/80 dark:border-dark-border'; ?>">
                                <span><?php echo esc_html( $term->name ); ?></span>
                                <span class="px-2 py-0.5 rounded-full text-[10px] <?php echo $is_active_term ? 'bg-white/20 text-white' : 'bg-slate-100 dark:bg-dark-border text-slate-500 dark:text-slate-400'; ?>">
                                    <?php echo esc_html( $term->count ); ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Total Count Indicator -->
                <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                    <span>Warta Resmi BSW (Bank Syariah Wakalumi)</span>
                </div>
            </div>
        </div>
    </section>


    <!-- ========================================================================
         SECTION 4: NEWS ARTICLE GRID OR EMPTY STATE
         ======================================================================== -->
    <section class="py-12 bg-transparent relative z-10">
        <div class="container-wide">

            <?php
            global $wp_query;

            if ( have_posts() ) :
            ?>
                <!-- Grid of News Articles -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <?php
                    $delay = 100;
                    while ( have_posts() ) : the_post();
                        // Skip headline if already rendered at top of page 1
                        if ( $featured_headline_id && get_the_ID() === $featured_headline_id && $paged <= 1 ) {
                            continue;
                        }

                        get_template_part( 'template-parts/card-berita', null, [ 'delay' => $delay ] );
                        $delay = ( $delay >= 400 ) ? 100 : $delay + 100;
                    endwhile;
                    ?>
                </div>

                <!-- Custom High-End Pagination -->
                <?php
                $pagination_links = paginate_links( [
                    'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'format'    => '?paged=%#%',
                    'current'   => max( 1, $paged ),
                    'total'     => $wp_query->max_num_pages,
                    'type'      => 'array',
                    'prev_text' => '<svg class="w-4 h-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg> Sebelumnya',
                    'next_text' => 'Selanjutnya <svg class="w-4 h-4 inline ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>',
                ] );

                if ( ! empty( $pagination_links ) ) :
                ?>
                    <div class="mt-16 flex justify-center" data-aos="fade-up">
                        <nav class="flex flex-wrap items-center justify-center gap-2" aria-label="Navigasi Halaman Berita">
                            <?php
                            foreach ( $pagination_links as $link ) {
                                if ( strpos( $link, 'current' ) !== false ) {
                                    echo str_replace( 'page-numbers current', 'page-numbers current inline-flex items-center justify-center min-w-[2.75rem] h-11 px-4 rounded-xl bg-teal-600 text-white border border-teal-600 font-black shadow-md shadow-teal-500/25', $link );
                                } elseif ( strpos( $link, 'dots' ) !== false ) {
                                    echo str_replace( 'page-numbers dots', 'page-numbers dots inline-flex items-center justify-center min-w-[2rem] h-11 px-2 text-slate-400 dark:text-slate-500 font-bold', $link );
                                } elseif ( strpos( $link, 'prev' ) !== false || strpos( $link, 'next' ) !== false ) {
                                    echo str_replace( 'page-numbers', 'page-numbers inline-flex items-center gap-1.5 px-4 h-11 rounded-xl bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border text-xs sm:text-sm font-bold text-slate-700 dark:text-slate-300 hover:bg-teal-50 dark:hover:bg-teal-950/60 hover:text-teal-600 dark:hover:text-teal-400 hover:border-teal-300 transition-all shadow-xs', $link );
                                } else {
                                    echo str_replace( 'page-numbers', 'page-numbers inline-flex items-center justify-center min-w-[2.75rem] h-11 px-4 rounded-xl bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border text-xs sm:text-sm font-bold text-slate-700 dark:text-slate-300 hover:bg-teal-50 dark:hover:bg-teal-950/60 hover:text-teal-600 dark:hover:text-teal-400 hover:border-teal-300 transition-all shadow-xs', $link );
                                }
                            }
                            ?>
                        </nav>
                    </div>
                <?php endif; ?>

            <?php else : ?>
                <!-- Empty State Component -->
                <div class="spotlight-card max-w-2xl mx-auto text-center py-16 px-6 sm:px-10 rounded-3xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-xl border border-slate-200/90 dark:border-dark-border shadow-lg" data-aos="fade-up">
                    <div class="w-20 h-20 rounded-3xl bg-teal-50 dark:bg-teal-950/60 border border-teal-200/50 dark:border-teal-800/50 text-teal-600 dark:text-teal-400 flex items-center justify-center mx-auto mb-6 shadow-md">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>

                    <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-3">
                        Belum Ada Artikel Ditemukan
                    </h3>
                    
                    <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed max-w-md mx-auto mb-8">
                        Artikel pada kategori ini akan segera dipublikasikan. Pantau terus kanal resmi Bank Syariah Wakalumi (BSW) untuk informasi dan edukasi syariah terkini.
                    </p>

                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <a href="<?php echo esc_url( get_post_type_archive_link( 'berita' ) ); ?>" class="btn-primary text-xs font-bold px-5 py-2.5 rounded-xl shadow-sm">
                            Lihat Semua Berita
                        </a>
                        <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn-whatsapp text-xs font-bold px-5 py-2.5 rounded-xl shadow-sm">
                            Hubungi Tim Kami
                        </a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>


    <!-- ========================================================================
         SECTION 5: BOTTOM CTA (CENTERED STYLING SESUAI STANDAR WAKALUMI)
         ======================================================================== -->
    <section class="relative z-10 py-16 md:py-24 overflow-hidden bg-transparent border-t border-slate-200/80 dark:border-dark-border">
        <div class="container-narrow relative z-10">
            <div class="spotlight-card group relative overflow-hidden rounded-3xl p-8 sm:p-12 md:p-16 bg-gradient-to-b from-slate-900 via-slate-900 to-teal-950 text-white text-center shadow-2xl border border-teal-500/30" data-aos="fade-up">
                
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
                        <span><?php echo esc_html( $cta['badge'] ?? 'Solusi Finansial Berkah' ); ?></span>
                    </div>

                    <!-- Title -->
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight">
                        <?php echo esc_html( $cta['title'] ?? 'Wujudkan Rencana Keuangan Syariah Bersama BPRS Wakalumi' ); ?>
                    </h2>

                    <!-- Subtitle -->
                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                        <?php echo esc_html( $cta['desc'] ?? 'Konsultasikan kebutuhan simpanan berkah bebas riba atau ajukan pembiayaan usaha syariah Anda dengan proses amanah, transparan, dan berizin resmi OJK.' ); ?>
                    </p>

                    <!-- Action Buttons Centered: WhatsApp di kiri, Link di kanan, gradient shimmer seragam Wakalumi -->
                    <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                        <?php if ( ! empty( $cta['btn1_text'] ) ) : ?>
                            <a href="<?php echo esc_url( $cta['btn1_url'] ?? $wa_url ); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="relative overflow-hidden group/btn py-3.5 px-7 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-400 hover:from-teal-400 hover:to-cyan-300 text-slate-950 font-black text-sm inline-flex items-center gap-2.5 shadow-lg shadow-teal-500/25 hover:shadow-teal-500/40 transition-all hover:scale-105 active:scale-95">
                                <!-- Shimmer Sweep -->
                                <span class="absolute inset-0 w-1/2 h-full bg-white/30 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-[300%] transition-transform duration-1000 ease-out pointer-events-none"></span>
                                <svg class="w-5 h-5 flex-shrink-0 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                <span><?php echo esc_html( $cta['btn1_text'] ); ?></span>
                            </a>
                        <?php endif; ?>

                        <?php if ( ! empty( $cta['btn2_text'] ) ) : ?>
                            <a href="<?php echo esc_url( $cta['btn2_url'] ?? home_url( '/produk/tabungan-syariah/' ) ); ?>" 
                               class="py-3.5 px-7 rounded-xl bg-white/10 hover:bg-white/15 text-white font-bold text-sm border border-white/20 hover:border-white/40 shadow-md inline-flex items-center gap-2 transition-all hover:-translate-y-0.5">
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

<?php get_footer(); ?>
