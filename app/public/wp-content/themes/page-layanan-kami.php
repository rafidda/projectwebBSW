<?php
/**
 * Template Name: Layanan Kami
 * Description: Halaman Resmi Layanan Perbankan Syariah & Panduan Virtual Account (VA).
 *              Menampilkan Hero Section seragam dengan Hero Badge Card, tab navigasi interaktif,
 *              panduan Virtual Account Bank Permata Syariah (Input Nominal Manual),
 *              kartu parameter dinamis (tanpa warna merah, bebas tambah/ubah/hapus),
 *              kotak simulasi perhitungan transfer, multi-image galeri infografis, dan kontak bantuan.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// SEO Custom Meta Title
add_filter( 'document_title_parts', function( $title_parts ) {
    $title_parts['title'] = 'Layanan — Bank Syariah Wakalumi';
    return $title_parts;
} );

get_header();

$cfg   = function_exists( 'wakalumi_get_layanan_settings' ) ? wakalumi_get_layanan_settings() : [];
$items = ! empty( $cfg['items'] ) && is_array( $cfg['items'] ) ? $cfg['items'] : [];

$clean_wa = preg_replace( '/[^0-9]/', '', $cfg['cs_wa'] ?? '6281517380388' );
$wa_url   = 'https://wa.me/' . $clean_wa . '?text=' . rawurlencode( 'Halo Tim Layanan Nasabah Bank Syariah Wakalumi, saya ingin menanyakan panduan fasilitas layanan perbankan.' );
?>

<main id="primary" class="site-main overflow-hidden bg-slate-50/50 dark:bg-dark-surface/20 min-h-screen">

    <!-- ========================================================================
         HERO SECTION: RESMI, SERAGAM & ELEGAN DENGAN 1 CARD FASILITAS TRANSAKSI
         (STANDAR DENGAN HALAMAN PENGADUAN KONSUMEN & KARIR)
         ======================================================================== -->
    <section class="wkl-page-hero">
        
        <!-- Ambient Background Glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-80 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

        <!-- Background Watermark Emblem (Hero Header) -->
        <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/4 w-80 sm:w-96 h-80 sm:h-96 opacity-[0.045] dark:opacity-[0.07] pointer-events-none select-none z-0 mix-blend-multiply dark:mix-blend-screen">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain grayscale">
        </div>

        <div class="container-wide relative z-10">
            <!-- Breadcrumbs (Simpel & Seragam: Beranda / Layanan) -->
            <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-300 transition-colors flex items-center gap-1.5 font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <span class="text-teal-600 dark:text-teal-400 font-semibold"><?php echo esc_html( $cfg['breadcrumb_label'] ?? 'Layanan' ); ?></span>
            </nav>

            <!-- 2-COLUMN HERO GRID: LEFT (INFO) & RIGHT (1 CARD FASILITAS TRANSAKSI) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                
                <!-- Left Column: Kicker, Title, Subtitle, Highlights -->
                <div class="<?php echo ! empty( $cfg['hero_card_show'] ) ? 'lg:col-span-7' : 'max-w-4xl'; ?> space-y-4" data-aos="fade-up">
                    <!-- Kicker Badge: Bersih tanpa icon petir -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/90 dark:bg-teal-950/70 border border-teal-300/80 dark:border-teal-700/60 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-2 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        <span><?php echo esc_html( $cfg['kicker'] ?? 'Fasilitas & Layanan Perbankan Syariah' ); ?></span>
                    </div>

                    <!-- Title H1 -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                        <?php echo esc_html( $cfg['title'] ?? 'Layanan Kami' ); ?>
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl font-medium">
                        <?php echo esc_html( $cfg['subtitle'] ?? 'Solusi fasilitas transaksi perbankan syariah yang aman, modern, dan memudahkan setiap kebutuhan transaksi maupun pembayaran angsuran nasabah Bank Syariah Wakalumi.' ); ?>
                    </p>

                    <!-- Key Highlights Pills -->
                    <?php if ( ! empty( $cfg['hero_pill_1'] ) || ! empty( $cfg['hero_pill_2'] ) || ! empty( $cfg['hero_pill_3'] ) ) : ?>
                        <div class="flex flex-wrap items-center gap-2.5 pt-3 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                            <?php if ( ! empty( $cfg['hero_pill_1'] ) ) : ?>
                                <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-semibold">
                                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span><?php echo esc_html( $cfg['hero_pill_1'] ); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $cfg['hero_pill_2'] ) ) : ?>
                                <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-semibold">
                                    <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                    <span><?php echo esc_html( $cfg['hero_pill_2'] ); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $cfg['hero_pill_3'] ) ) : ?>
                                <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-semibold">
                                    <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg>
                                    <span><?php echo esc_html( $cfg['hero_pill_3'] ); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right Column: 1 Spotlight Card Fasilitas & Keamanan Transaksi (Rata Tengah, Soft Icon & Tanpa Emoticon) -->
                <?php if ( ! empty( $cfg['hero_card_show'] ) ) : ?>
                <div class="lg:col-span-5" data-aos="fade-left" data-aos-delay="100">
                    <div class="spotlight-card group relative rounded-3xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-emerald-300/80 dark:border-emerald-700/60 shadow-xl shadow-emerald-500/10 hover:shadow-2xl hover:shadow-emerald-500/20 transition-all duration-500 overflow-hidden p-6 sm:p-7 text-center">
                        
                        <!-- Top Accent Line -->
                        <div class="h-1.5 w-full bg-gradient-to-r from-emerald-500 via-teal-400 to-cyan-500 absolute top-0 left-0 right-0"></div>

                        <!-- Decorative Watermark Logo inside Card -->
                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 
                                    w-52 h-52 sm:w-60 sm:h-60
                                    opacity-[0.04] dark:opacity-[0.06] 
                                    pointer-events-none select-none 
                                    transition-all duration-700 ease-out 
                                    group-hover:scale-110 
                                    group-hover:opacity-[0.10] dark:group-hover:opacity-[0.14] 
                                    grayscale mix-blend-multiply dark:mix-blend-screen z-0">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain">
                        </div>

                        <!-- Card Header: Center-aligned Icon, Badge & Title -->
                        <div class="relative z-10 flex flex-col items-center mb-4">
                            <!-- Main Icon: Soft Translucent Theme, No Solid Background (Seragam Tema BSW) -->
                            <div class="w-14 h-14 rounded-2xl bg-teal-50/90 dark:bg-teal-950/60 border border-teal-200/80 dark:border-teal-800/60 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-3 shadow-2xs group-hover:scale-105 group-hover:border-teal-300 transition-all duration-300">
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                </svg>
                            </div>

                            <!-- Badge -->
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-100/90 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 text-[10px] font-black uppercase tracking-wider border border-emerald-300/60 dark:border-emerald-700/60 mb-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <?php echo esc_html( $cfg['hero_card_badge'] ?? 'Fasilitas Nasabah BSW' ); ?>
                            </div>

                            <!-- Title -->
                            <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white tracking-tight text-center leading-snug">
                                <?php echo esc_html( $cfg['hero_card_title'] ?? 'Kanal Transaksi Digital & Lapangan' ); ?>
                            </h3>

                            <!-- Description -->
                            <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed text-center max-w-sm mt-2">
                                <?php echo esc_html( $cfg['hero_card_desc'] ?? 'Pembayaran angsuran pembiayaan via Virtual Account 24/7 dan layanan jemput setoran langsung ke lokasi Anda.' ); ?>
                            </p>
                        </div>

                        <!-- 4 Micro Points Grid (Clean Professional SVG Icons, Tanpa Emoticon) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 mb-4 relative z-10 text-left">
                            <!-- Point 1 -->
                            <div class="p-2.5 rounded-xl bg-slate-50/80 dark:bg-dark-surface/60 border border-slate-200/70 dark:border-dark-border flex items-center gap-2.5 text-[11px] text-slate-700 dark:text-slate-200 font-semibold">
                                <div class="w-6 h-6 rounded-lg bg-teal-50 dark:bg-teal-950/60 border border-teal-200/60 dark:border-teal-800/60 flex items-center justify-center shrink-0 text-teal-600 dark:text-teal-400">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="leading-snug"><?php echo esc_html( $cfg['hero_card_p1'] ?? 'Pembayaran Real-Time 24/7 Seluruh Bank' ); ?></span>
                            </div>
                            <!-- Point 2 -->
                            <div class="p-2.5 rounded-xl bg-slate-50/80 dark:bg-dark-surface/60 border border-slate-200/70 dark:border-dark-border flex items-center gap-2.5 text-[11px] text-slate-700 dark:text-slate-200 font-semibold">
                                <div class="w-6 h-6 rounded-lg bg-teal-50 dark:bg-teal-950/60 border border-teal-200/60 dark:border-teal-800/60 flex items-center justify-center shrink-0 text-teal-600 dark:text-teal-400">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </div>
                                <span class="leading-snug"><?php echo esc_html( $cfg['hero_card_p2'] ?? 'Input Nominal Mandiri Bebas & Fleksibel' ); ?></span>
                            </div>
                            <!-- Point 3 -->
                            <div class="p-2.5 rounded-xl bg-slate-50/80 dark:bg-dark-surface/60 border border-slate-200/70 dark:border-dark-border flex items-center gap-2.5 text-[11px] text-slate-700 dark:text-slate-200 font-semibold">
                                <div class="w-6 h-6 rounded-lg bg-teal-50 dark:bg-teal-950/60 border border-teal-200/60 dark:border-teal-800/60 flex items-center justify-center shrink-0 text-teal-600 dark:text-teal-400">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <span class="leading-snug"><?php echo esc_html( $cfg['hero_card_p3'] ?? 'Layanan Jemput Setoran Resmi Lapangan' ); ?></span>
                            </div>
                            <!-- Point 4 -->
                            <div class="p-2.5 rounded-xl bg-slate-50/80 dark:bg-dark-surface/60 border border-slate-200/70 dark:border-dark-border flex items-center gap-2.5 text-[11px] text-slate-700 dark:text-slate-200 font-semibold">
                                <div class="w-6 h-6 rounded-lg bg-teal-50 dark:bg-teal-950/60 border border-teal-200/60 dark:border-teal-800/60 flex items-center justify-center shrink-0 text-teal-600 dark:text-teal-400">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                    </svg>
                                </div>
                                <span class="leading-snug"><?php echo esc_html( $cfg['hero_card_p4'] ?? 'Otomatis Verifikasi Nama Nasabah' ); ?></span>
                            </div>
                        </div>

                        <!-- Regulatory Seal Strip (Rata Tengah) -->
                        <div class="pt-3 border-t border-slate-200/70 dark:border-dark-border flex items-center justify-center gap-3 text-[11px] text-slate-500 dark:text-slate-400 relative z-10">
                            <span class="inline-flex items-center gap-1.5 font-bold text-emerald-700 dark:text-emerald-400">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                                <?php echo esc_html( ltrim( $cfg['hero_card_seal_left'] ?? 'Transaksi Aman & Terverifikasi', '✓ ' ) ); ?>
                            </span>
                            <span class="w-1 h-1 rounded-full bg-slate-300 dark:bg-slate-600"></span>
                            <span class="px-2 py-0.5 rounded-md bg-emerald-100/90 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300 font-black uppercase tracking-wider text-[10px]">
                                <?php echo esc_html( $cfg['hero_card_seal_right'] ?? 'Prinsip Syariah' ); ?>
                            </span>
                        </div>

                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- ========================================================================
         MAIN SECTION: INTERACTIVE TABS SERVICE HUB (2-COLUMN)
         ======================================================================== -->
    <section class="py-8 md:py-14 relative z-10">
        <div class="container-wide">

            <!-- MOBILE HORIZONTAL CHIP TABS (Thumb-Friendly) -->
            <div class="lg:hidden mb-6 -mx-4 px-4 overflow-x-auto no-scrollbar py-1">
                <div class="inline-flex items-center gap-2 min-w-full" id="wkl-mobile-tabs-bar">
                    <?php foreach ( $items as $idx => $m_item ) : 
                        $m_is_active = ( 0 === $idx );
                    ?>
                        <button type="button" 
                                onclick="wklSwitchLayananTab('<?php echo esc_js( $m_item['id'] ); ?>')"
                                class="wkl-mobile-tab-btn flex items-center gap-2 px-4 py-2.5 rounded-2xl text-xs font-extrabold whitespace-nowrap transition-all duration-300 border shadow-2xs <?php echo $m_is_active ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white border-teal-500 shadow-md shadow-teal-600/20' : 'bg-white dark:bg-dark-card text-slate-700 dark:text-slate-200 border-slate-200/80 dark:border-dark-border hover:bg-slate-50'; ?>"
                                data-tab-target="<?php echo esc_attr( $m_item['id'] ); ?>">
                            <span><?php echo esc_html( $m_item['short_title'] ?? $m_item['title'] ); ?></span>
                            <?php if ( ! empty( $m_item['badge'] ) ) : ?>
                                <span class="text-[9px] px-1.5 py-0.5 rounded-full <?php echo $m_is_active ? 'bg-white/20 text-white' : 'bg-teal-50 dark:bg-teal-950 text-teal-700 dark:text-teal-300 border border-teal-200/50 dark:border-teal-800/50'; ?>">
                                    <?php echo esc_html( $m_item['badge'] ); ?>
                                </span>
                            <?php endif; ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- 2-COLUMN GRID LAYOUT -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 xl:gap-8 items-start">

                <!-- ============================================================
                     LEFT COLUMN: STICKY SIDEBAR NAVIGATION (Desktop)
                     ============================================================ -->
                <aside class="hidden lg:block lg:col-span-4 xl:col-span-4 lg:sticky lg:top-24 space-y-5" data-aos="fade-right">
                    
                    <!-- Tab List Card -->
                    <div class="p-4 sm:p-5 rounded-3xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-slate-200/90 dark:border-dark-border shadow-md">
                        <div class="flex items-center justify-between pb-3.5 mb-3 border-b border-slate-100 dark:border-dark-border px-1">
                            <span class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-wider flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                                Fasilitas Layanan
                            </span>
                            <span class="text-[11px] font-bold text-teal-700 dark:text-teal-300 bg-teal-50 dark:bg-teal-950/70 px-2 py-0.5 rounded-full border border-teal-200/60 dark:border-teal-800/60">
                                <?php echo count( $items ); ?> Fasilitas
                            </span>
                        </div>

                        <div class="space-y-2" id="wkl-desktop-tab-list">
                            <?php foreach ( $items as $idx => $d_item ) : 
                                $is_active = ( 0 === $idx );
                                $icon_type = $d_item['icon'] ?? 'credit-card';
                            ?>
                                <button type="button" 
                                        onclick="wklSwitchLayananTab('<?php echo esc_js( $d_item['id'] ); ?>')"
                                        id="wkl-tab-btn-<?php echo esc_attr( $d_item['id'] ); ?>"
                                        class="wkl-tab-btn w-full text-left p-3.5 rounded-2xl transition-all duration-300 flex items-start gap-3.5 border group relative <?php echo $is_active ? 'active bg-gradient-to-br from-emerald-600 via-teal-600 to-teal-700 text-white border-teal-500 shadow-lg shadow-teal-600/25' : 'bg-slate-50/80 dark:bg-dark-surface/60 text-slate-700 dark:text-slate-200 border-slate-200/70 dark:border-dark-border/80 hover:bg-slate-100/90 dark:hover:bg-dark-surface hover:border-teal-300 dark:hover:border-teal-700/60'; ?>"
                                        data-tab-target="<?php echo esc_attr( $d_item['id'] ); ?>">
                                    
                                    <!-- Icon Box -->
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-105 <?php echo $is_active ? 'bg-white/20 text-white shadow-xs' : 'bg-white dark:bg-dark-card text-teal-600 dark:text-teal-400 border border-slate-200/80 dark:border-dark-border shadow-2xs'; ?>">
                                        <?php if ( 'truck' === $icon_type ) : ?>
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v9.375c0 .621.504 1.125 1.125 1.125h1.5"/></svg>
                                        <?php elseif ( 'smartphone' === $icon_type ) : ?>
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/></svg>
                                        <?php elseif ( 'building' === $icon_type ) : ?>
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg>
                                        <?php elseif ( 'shield-check' === $icon_type ) : ?>
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                                        <?php elseif ( 'none' === $icon_type ) : ?>
                                            <span class="font-black text-xs"><?php echo sprintf( '%02d', $idx + 1 ); ?></span>
                                        <?php else : ?>
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
                                        <?php endif; ?>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center justify-between gap-1 mb-0.5">
                                            <h4 class="text-xs sm:text-sm font-bold tracking-tight truncate <?php echo $is_active ? 'text-white' : 'text-slate-900 dark:text-white'; ?>">
                                                <?php echo esc_html( $d_item['short_title'] ?? $d_item['title'] ); ?>
                                            </h4>
                                        </div>
                                        <p class="text-[11px] leading-snug line-clamp-2 <?php echo $is_active ? 'text-teal-100 font-medium' : 'text-slate-500 dark:text-slate-400'; ?>">
                                            <?php echo esc_html( $d_item['summary'] ?? '' ); ?>
                                        </p>
                                    </div>

                                    <div class="self-center flex-shrink-0">
                                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1 <?php echo $is_active ? 'text-white' : 'text-slate-400 dark:text-slate-500'; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                    </div>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Card Bantuan Cepat Customer Service (Seragam dengan Card Standar Halaman Lain) -->
                    <div class="p-5 rounded-3xl bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border shadow-sm relative overflow-hidden group">
                        <!-- Subtle Top Accent Line -->
                        <div class="h-1 w-full bg-gradient-to-r from-emerald-500 to-teal-500 absolute top-0 left-0 right-0"></div>

                        <div class="flex items-center gap-3 mb-3 pt-1">
                            <div class="w-10 h-10 rounded-2xl bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 border border-teal-200/60 dark:border-teal-800/60 flex items-center justify-center flex-shrink-0 shadow-2xs group-hover:scale-105 transition-transform">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v5.998z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-extrabold text-slate-900 dark:text-white leading-tight">
                                    <?php echo esc_html( $cfg['help_card_title'] ?? 'Butuh Bantuan Transaksi?' ); ?>
                                </h4>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium flex items-center gap-1.5 mt-0.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <?php echo esc_html( $cfg['cs_hours'] ?? 'Senin – Jumat: 08.00 – 15.00 WIB' ); ?>
                                </span>
                            </div>
                        </div>

                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-4">
                            <?php echo esc_html( $cfg['help_card_desc'] ?? 'Tim Customer Service kami siap mendampingi panduan pembayaran VA dan konfirmasi transaksi Anda.' ); ?>
                        </p>

                        <div class="space-y-2">
                            <a href="<?php echo esc_url( $wa_url ); ?>" 
                               target="_blank" rel="noopener noreferrer"
                               class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs hover:shadow-sm transition-all duration-300 group/wa">
                                <svg class="w-4 h-4 fill-current group-hover/wa:scale-110 transition-transform" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                <span>Chat CS via WhatsApp</span>
                            </a>
                            <?php if ( ! empty( $cfg['cs_phone'] ) ) : ?>
                                <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $cfg['cs_phone'] ) ); ?>" 
                                   class="w-full inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-slate-50 hover:bg-slate-100 dark:bg-dark-surface dark:hover:bg-dark-surface-alt border border-slate-200/80 dark:border-dark-border text-slate-700 dark:text-slate-300 font-bold text-xs transition-colors">
                                    <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                                    <span>Telp: <?php echo esc_html( $cfg['cs_phone'] ); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                </aside>

                <!-- ============================================================
                     RIGHT COLUMN: DYNAMIC CONTENT PANE (Active Service Details)
                     ============================================================ -->
                <div class="lg:col-span-8 xl:col-span-8 min-w-0" data-aos="fade-left">
                    <?php foreach ( $items as $idx => $item ) : 
                        $is_active   = ( 0 === $idx );
                        $gallery     = ! empty( $item['media_gallery'] ) && is_array( $item['media_gallery'] ) ? $item['media_gallery'] : [];
                        $has_gallery = ! empty( $gallery );
                        $channels    = ! empty( $item['channels'] ) && is_array( $item['channels'] ) ? $item['channels'] : [];
                        $faqs        = ! empty( $item['faqs'] ) && is_array( $item['faqs'] ) ? $item['faqs'] : [];
                        $param_cards = ! empty( $item['param_cards'] ) && is_array( $item['param_cards'] ) ? $item['param_cards'] : [];
                        $show_sim    = ! empty( $item['show_simulation'] );
                    ?>
                        <article id="pane-<?php echo esc_attr( $item['id'] ); ?>" 
                                 class="wkl-layanan-pane <?php echo $is_active ? 'block' : 'hidden'; ?> transition-all duration-300">
                            
                            <!-- Main Service Card -->
                            <div class="spotlight-card group/card relative rounded-3xl bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border shadow-md overflow-hidden p-6 sm:p-8 space-y-7">
                                
                                <!-- Decorative Accent Line Top -->
                                <div class="h-1.5 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 absolute top-0 left-0 right-0"></div>

                                <!-- Watermark Emblem Background in Card -->
                                <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/4 w-72 h-72 opacity-[0.03] dark:opacity-[0.05] pointer-events-none select-none z-0 mix-blend-multiply dark:mix-blend-screen">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain grayscale">
                                </div>

                                <!-- 1. HEADER LAYANAN -->
                                <div class="relative z-10 border-b border-slate-100 dark:border-dark-border pb-6">
                                    <div class="flex flex-wrap items-center gap-2 mb-3">
                                        <?php if ( ! empty( $item['badge'] ) ) : ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 text-xs font-black uppercase tracking-wider border border-emerald-300/60 dark:border-emerald-800/60 shadow-2xs">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                                <?php echo esc_html( $item['badge'] ); ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php if ( ! empty( $item['partner_bank'] ) ) : ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 dark:bg-dark-surface text-slate-700 dark:text-slate-300 text-xs font-bold border border-slate-200/80 dark:border-dark-border">
                                                <svg class="w-3.5 h-3.5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                                <?php echo esc_html( $item['partner_bank'] ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight leading-snug">
                                        <?php echo esc_html( $item['title'] ); ?>
                                    </h2>

                                    <?php if ( ! empty( $item['intro'] ) ) : ?>
                                        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed mt-2.5">
                                            <?php echo esc_html( $item['intro'] ); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <!-- 2. RUANG MEDIA VISUAL MULTI-GAMBAR / INFOGRAFIS (Bisa Beberapa Gambar) -->
                                <?php if ( $has_gallery ) : ?>
                                    <div class="relative z-10 space-y-3">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                                                <svg class="w-4 h-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                                                <span>Infografis &amp; Panduan Visual (<?php echo count( $gallery ); ?> Gambar)</span>
                                            </h3>
                                            <span class="text-[11px] text-teal-600 dark:text-teal-400 font-bold">Klik untuk perbesar</span>
                                        </div>

                                        <div class="grid grid-cols-1 <?php echo count( $gallery ) > 1 ? 'sm:grid-cols-2 lg:grid-cols-2' : ''; ?> gap-3 sm:gap-4">
                                            <?php foreach ( $gallery as $g_i => $g_img ) : ?>
                                                <div class="group/gimg relative rounded-2xl overflow-hidden border border-slate-200/90 dark:border-dark-border bg-slate-50 dark:bg-dark-surface shadow-2xs hover:shadow-md transition-all cursor-pointer"
                                                     onclick="openZoomModal('<?php echo esc_url( $g_img['url'] ); ?>', '<?php echo esc_js( $item['title'] ); ?>', '<?php echo esc_js( $g_img['caption'] ?? '' ); ?>')">
                                                    
                                                    <div class="aspect-[16/10] overflow-hidden bg-slate-900/5 relative">
                                                        <img src="<?php echo esc_url( $g_img['url'] ); ?>" 
                                                             alt="<?php echo esc_attr( $g_img['caption'] ?? $item['title'] ); ?>" 
                                                             class="w-full h-full object-cover group-hover/gimg:scale-105 transition-transform duration-500" 
                                                             loading="lazy" />
                                                        
                                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover/gimg:opacity-100 transition-opacity flex items-end p-3">
                                                            <span class="text-xs text-white font-bold flex items-center gap-1.5">
                                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/></svg>
                                                                Perbesar Gambar
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <?php if ( ! empty( $g_img['caption'] ) ) : ?>
                                                        <div class="p-2.5 bg-white dark:bg-dark-card border-t border-slate-100 dark:border-dark-border text-xs text-slate-600 dark:text-slate-300 font-medium truncate">
                                                            <?php echo esc_html( $g_img['caption'] ); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- 3. KOTAK FORMAT KODE VIRTUAL ACCOUNT & ALERT CATATAN PENTING BIAYA -->
                                <?php if ( ! empty( $item['va_code_prefix'] ) || ! empty( $item['fee_info'] ) ) : ?>
                                    <div class="relative z-10 space-y-3.5">
                                        <?php if ( ! empty( $item['va_code_prefix'] ) ) : ?>
                                            <!-- VA Code Format Box with Click-to-Copy -->
                                            <div class="p-4 sm:p-5 rounded-2xl bg-gradient-to-br from-emerald-50/90 via-teal-50/50 to-white dark:from-emerald-950/30 dark:via-dark-surface dark:to-dark-card border border-emerald-200/80 dark:border-dark-border shadow-xs">
                                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                                    <div>
                                                        <span class="text-[11px] font-extrabold text-teal-800 dark:text-teal-400 uppercase tracking-wider block mb-1">
                                                            Format Kode Nomor Virtual Account (VA)
                                                        </span>
                                                        <div class="flex items-center gap-2 flex-wrap">
                                                            <span class="font-mono text-lg sm:text-xl font-black text-emerald-800 dark:text-emerald-300 bg-white dark:bg-dark-card px-3 py-1 rounded-xl border border-emerald-300/80 dark:border-emerald-700/60 shadow-2xs">
                                                                <?php echo esc_html( $item['va_code_prefix'] ); ?>
                                                            </span>
                                                            <span class="text-sm font-bold text-slate-500 dark:text-slate-400">+</span>
                                                            <span class="text-xs sm:text-sm font-bold text-slate-700 dark:text-slate-300">
                                                                Nomor Rekening Debitur Wakalumi
                                                            </span>
                                                        </div>
                                                        <?php if ( ! empty( $item['va_example'] ) ) : ?>
                                                            <span class="text-xs text-slate-500 dark:text-slate-400 block mt-2">
                                                                Contoh VA Lengkap: <code class="font-mono font-bold text-emerald-700 dark:text-teal-300"><?php echo esc_html( $item['va_example'] ); ?></code>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <button type="button" 
                                                            onclick="wklCopyToClipboard('<?php echo esc_js( $item['va_code_prefix'] ); ?>', this)"
                                                            class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm hover:shadow-md transition-all flex-shrink-0">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"/></svg>
                                                        <span>Salin Kode Prefix (<?php echo esc_html( $item['va_code_prefix'] ); ?>)</span>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ( ! empty( $item['fee_info'] ) ) : 
                                            $catatan_title = ( 'jemput-setoran' === ( $item['id'] ?? '' ) ) 
                                                ? 'Catatan Prosedur & Keamanan Setoran:' 
                                                : 'Catatan Saldo & Biaya Transaksi:';
                                        ?>
                                            <!-- Catatan Alert Box: Compact, Non-intimidating, Highly Readable & Refined -->
                                            <div class="p-3 sm:p-3.5 rounded-xl bg-amber-50/50 dark:bg-amber-950/20 border border-amber-200/60 dark:border-amber-800/30 flex items-start gap-2.5 shadow-2xs">
                                                <div class="w-5 h-5 rounded-md bg-amber-100/80 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300 border border-amber-200/60 dark:border-amber-700/40 flex items-center justify-center shrink-0 mt-0.5">
                                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                                    </svg>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div class="flex items-center gap-1.5 mb-1">
                                                        <span class="inline-flex items-center gap-1.5 text-[10.5px] font-bold uppercase tracking-wider text-amber-900/90 dark:text-amber-300">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                            <?php echo esc_html( $catatan_title ); ?>
                                                        </span>
                                                    </div>
                                                    <p class="text-[11px] sm:text-xs text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                                                        <?php echo nl2br( esc_html( $item['fee_info'] ) ); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- 4. KARTU PARAMETER KUNCI (DYNAMIC & FULL MODIFIABLE, NO RED!) -->
                                <?php if ( ! empty( $param_cards ) ) : ?>
                                    <div class="relative z-10 space-y-3">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <?php foreach ( $param_cards as $pc ) : 
                                                $color = $pc['color'] ?? 'teal';
                                                
                                                // Definisi palet tema non-merah
                                                $theme_classes = [
                                                    'emerald' => [
                                                        'card'  => 'bg-emerald-50/70 dark:bg-emerald-950/30 border-emerald-200/80 dark:border-emerald-800/50',
                                                        'badge' => 'bg-emerald-100 dark:bg-emerald-900/60 text-emerald-800 dark:text-emerald-300 border-emerald-300/60 dark:border-emerald-700/60',
                                                        'title' => 'text-emerald-800 dark:text-emerald-400',
                                                        'copy'  => 'text-emerald-700 dark:text-emerald-300 border-emerald-300/80 dark:border-emerald-700 hover:bg-emerald-50 dark:hover:bg-emerald-950/60',
                                                    ],
                                                    'amber' => [
                                                        'card'  => 'bg-amber-50/80 dark:bg-amber-950/30 border-amber-300/80 dark:border-amber-700/50',
                                                        'badge' => 'bg-amber-100 dark:bg-amber-900/60 text-amber-900 dark:text-amber-300 border-amber-300/60 dark:border-amber-700/60',
                                                        'title' => 'text-amber-800 dark:text-amber-400',
                                                        'copy'  => 'text-amber-700 dark:text-amber-300 border-amber-300/80 dark:border-amber-700 hover:bg-amber-50 dark:hover:bg-amber-950/60',
                                                    ],
                                                    'sky' => [
                                                        'card'  => 'bg-sky-50/80 dark:bg-sky-950/30 border-sky-200/80 dark:border-sky-800/50',
                                                        'badge' => 'bg-sky-100 dark:bg-sky-900/60 text-sky-800 dark:text-sky-300 border-sky-300/60 dark:border-sky-700/60',
                                                        'title' => 'text-sky-800 dark:text-sky-400',
                                                        'copy'  => 'text-sky-700 dark:text-sky-300 border-sky-300/80 dark:border-sky-700 hover:bg-sky-50 dark:hover:bg-sky-950/60',
                                                    ],
                                                    'purple' => [
                                                        'card'  => 'bg-purple-50/70 dark:bg-purple-950/30 border-purple-200/80 dark:border-purple-800/50',
                                                        'badge' => 'bg-purple-100 dark:bg-purple-900/60 text-purple-800 dark:text-purple-300 border-purple-300/60 dark:border-purple-700/60',
                                                        'title' => 'text-purple-800 dark:text-purple-400',
                                                        'copy'  => 'text-purple-700 dark:text-purple-300 border-purple-300/80 dark:border-purple-700 hover:bg-purple-50 dark:hover:bg-purple-950/60',
                                                    ],
                                                    'slate' => [
                                                        'card'  => 'bg-slate-50/80 dark:bg-dark-surface/60 border-slate-200/80 dark:border-dark-border',
                                                        'badge' => 'bg-slate-100 dark:bg-dark-card text-slate-700 dark:text-slate-300 border-slate-300/60 dark:border-dark-border',
                                                        'title' => 'text-slate-500 dark:text-slate-400',
                                                        'copy'  => 'text-slate-700 dark:text-slate-300 border-slate-300/80 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface',
                                                    ],
                                                    'teal' => [
                                                        'card'  => 'bg-teal-50/70 dark:bg-teal-950/30 border-teal-200/80 dark:border-teal-800/50',
                                                        'badge' => 'bg-teal-100 dark:bg-teal-900/60 text-teal-800 dark:text-teal-300 border-teal-300/60 dark:border-teal-700/60',
                                                        'title' => 'text-teal-800 dark:text-teal-400',
                                                        'copy'  => 'text-teal-700 dark:text-teal-300 border-teal-300/80 dark:border-teal-700 hover:bg-teal-50 dark:hover:bg-teal-950/60',
                                                    ],
                                                ];

                                                $t = $theme_classes[ $color ] ?? $theme_classes['teal'];
                                            ?>
                                                <div class="p-4 rounded-2xl border flex items-start justify-between gap-3 shadow-2xs <?php echo esc_attr( $t['card'] ); ?>">
                                                    <div class="min-w-0 flex-1">
                                                        <div class="flex items-center gap-2 mb-1">
                                                            <?php if ( ! empty( $pc['badge'] ) ) : ?>
                                                                <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md border <?php echo esc_attr( $t['badge'] ); ?>">
                                                                    <?php echo esc_html( $pc['badge'] ); ?>
                                                                </span>
                                                            <?php endif; ?>
                                                            <span class="text-[11px] font-bold uppercase tracking-wider <?php echo esc_attr( $t['title'] ); ?>">
                                                                <?php echo esc_html( $pc['title'] ); ?>
                                                            </span>
                                                        </div>
                                                        <strong class="text-xs sm:text-sm text-slate-900 dark:text-white block mt-0.5 font-extrabold leading-snug">
                                                            <?php echo esc_html( $pc['value'] ); ?>
                                                        </strong>
                                                        <?php if ( ! empty( $pc['desc'] ) ) : ?>
                                                            <p class="text-[11px] text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">
                                                                <?php echo esc_html( $pc['desc'] ); ?>
                                                            </p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if ( ! empty( $pc['can_copy'] ) && ! empty( $pc['copy_text'] ) ) : ?>
                                                        <button type="button"
                                                                onclick="wklCopyToClipboard('<?php echo esc_js( $pc['copy_text'] ); ?>', this)"
                                                                class="p-2 rounded-xl bg-white dark:bg-dark-card border font-bold text-xs shadow-2xs flex-shrink-0 transition-colors <?php echo esc_attr( $t['copy'] ); ?>"
                                                                title="Salin Teks">
                                                            Salin
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- 4. KOTAK SIMULASI PERHITUNGAN ANGSURAN NYATA (OPSIONAL / DINAMIS) -->
                                <?php if ( $show_sim ) : ?>
                                    <div class="p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-teal-50/90 via-emerald-50/50 to-white dark:from-dark-surface dark:via-dark-surface/80 dark:to-dark-card border border-teal-200/90 dark:border-dark-border relative z-10">
                                        <div class="flex items-center gap-2 mb-2 text-teal-800 dark:text-teal-300 font-extrabold text-xs uppercase tracking-wider">
                                            <svg class="w-4 h-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <span>Contoh Simulasi Perhitungan Transfer:</span>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 text-xs">
                                            <div class="p-2.5 rounded-xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border">
                                                <span class="text-slate-400 block text-[10px]">Angsuran Bulanan:</span>
                                                <span class="font-bold text-slate-800 dark:text-slate-200"><?php echo esc_html( $item['sim_installment'] ?? 'Rp 1.000.000' ); ?></span>
                                            </div>
                                            <div class="p-2.5 rounded-xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border">
                                                <span class="text-slate-400 block text-[10px]">Biaya Admin Transfer:</span>
                                                <span class="font-bold text-amber-600 dark:text-amber-400">+ <?php echo esc_html( $item['sim_fee'] ?? 'Rp 3.500' ); ?></span>
                                            </div>
                                            <div class="p-2.5 rounded-xl bg-emerald-100/70 dark:bg-emerald-950/60 border border-emerald-300/80 dark:border-emerald-700/60">
                                                <span class="text-emerald-800 dark:text-emerald-300 block text-[10px] font-extrabold">Total Diketik di M-Banking/ATM:</span>
                                                <span class="font-black text-emerald-800 dark:text-emerald-200 text-sm">= <?php echo esc_html( $item['sim_total'] ?? 'Rp 1.003.500' ); ?></span>
                                            </div>
                                        </div>
                                        <?php if ( ! empty( $item['sim_note'] ) ) : ?>
                                            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-2.5 leading-relaxed">
                                                <?php echo esc_html( $item['sim_note'] ); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- 5. SUB-KANAL PANDUAN STEP-BY-STEP (TERSTRUKTUR & JELAS) -->
                                <?php if ( ! empty( $channels ) ) : ?>
                                    <div class="relative z-10 pt-2">
                                        <div class="flex items-center justify-between mb-3">
                                            <h3 class="text-base sm:text-lg font-black text-slate-900 dark:text-white tracking-tight flex items-center gap-2">
                                                <span class="w-2.5 h-2.5 rounded-full bg-teal-500"></span>
                                                Pilih Kanal Pembayaran / Panduan:
                                            </h3>
                                        </div>

                                        <!-- Sub-Channel Pill Tabs -->
                                        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-2 mb-6" id="subtabs-bar-<?php echo esc_attr( $item['id'] ); ?>">
                                            <?php foreach ( $channels as $c_idx => $ch ) : 
                                                $ch_active = ( 0 === $c_idx );
                                            ?>
                                                <button type="button"
                                                        onclick="wklSwitchChannel('<?php echo esc_js( $item['id'] ); ?>', <?php echo $c_idx; ?>)"
                                                        id="subtab-btn-<?php echo esc_attr( $item['id'] . '-' . $c_idx ); ?>"
                                                        class="wkl-subtab-btn px-4 py-2.5 rounded-2xl text-xs font-bold transition-all duration-200 border whitespace-nowrap shadow-2xs flex items-center gap-2 <?php echo $ch_active ? 'active bg-slate-900 dark:bg-white text-white dark:text-slate-900 border-slate-900 dark:border-white shadow-sm' : 'bg-slate-100 dark:bg-dark-surface text-slate-700 dark:text-slate-300 border-slate-200/80 dark:border-dark-border hover:bg-slate-200/80'; ?>">
                                                    <span><?php echo esc_html( $ch['name'] ); ?></span>
                                                    <?php if ( ! empty( $ch['badge'] ) ) : ?>
                                                        <span class="text-[9px] px-1.5 py-0.2 rounded-full font-extrabold uppercase <?php echo $ch_active ? 'bg-white/20 text-white dark:bg-slate-900/20 dark:text-slate-900' : 'bg-white dark:bg-dark-card text-teal-700 dark:text-teal-300'; ?>">
                                                            <?php echo esc_html( $ch['badge'] ); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </button>
                                            <?php endforeach; ?>
                                        </div>

                                        <!-- Channel Step Panels -->
                                        <div class="space-y-4" id="channel-panels-<?php echo esc_attr( $item['id'] ); ?>">
                                            <?php foreach ( $channels as $c_idx => $ch ) : 
                                                $ch_active = ( 0 === $c_idx );
                                                $steps     = ! empty( $ch['steps'] ) ? $ch['steps'] : [];
                                            ?>
                                                <div id="channel-pane-<?php echo esc_attr( $item['id'] . '-' . $c_idx ); ?>" 
                                                     class="wkl-channel-pane <?php echo $ch_active ? 'block' : 'hidden'; ?> space-y-4">
                                                    
                                                    <div class="p-5 sm:p-6 rounded-2xl bg-slate-50/80 dark:bg-dark-surface/40 border border-slate-200/80 dark:border-dark-border">
                                                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-200/70 dark:border-dark-border">
                                                            <h4 class="text-xs sm:text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider flex items-center gap-2">
                                                                <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                                <span>Panduan Transaksi: <?php echo esc_html( $ch['name'] ); ?></span>
                                                            </h4>
                                                            <span class="text-[11px] font-bold text-slate-400 dark:text-slate-500">
                                                                <?php echo count( $steps ); ?> Langkah
                                                            </span>
                                                        </div>

                                                        <div class="space-y-4 relative before:absolute before:left-[19px] before:top-4 before:bottom-4 before:w-0.5 before:bg-slate-200 dark:before:bg-dark-border">
                                                            <?php foreach ( $steps as $s_idx => $st ) : ?>
                                                                <div class="flex items-start gap-4 relative z-10">
                                                                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white font-black text-xs flex items-center justify-center flex-shrink-0 shadow-sm mt-0.5">
                                                                        <?php echo $s_idx + 1; ?>
                                                                    </div>
                                                                    <div class="flex-1 pt-1 text-xs sm:text-sm text-slate-700 dark:text-slate-200 leading-relaxed font-medium">
                                                                        <?php echo esc_html( $st ); ?>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                    </div>
                                <?php endif; ?>

                                <!-- 6. FAQ (TANYA JAWAB CEPAT) -->
                                <?php if ( ! empty( $faqs ) ) : ?>
                                    <div class="relative z-10 pt-4 border-t border-slate-100 dark:border-dark-border">
                                        <h3 class="text-base sm:text-lg font-black text-slate-900 dark:text-white tracking-tight mb-4 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/></svg>
                                            Pertanyaan Umum (FAQ) Layanan
                                        </h3>

                                        <div class="space-y-2.5">
                                            <?php foreach ( $faqs as $f_idx => $faq ) : ?>
                                                <div class="wkl-faq-item rounded-2xl border border-slate-200/80 dark:border-dark-border bg-slate-50/50 dark:bg-dark-surface/30 overflow-hidden transition-colors">
                                                    <button type="button" 
                                                            onclick="wklToggleFaq(this)"
                                                            class="w-full text-left p-4 flex items-center justify-between gap-3 text-xs sm:text-sm font-extrabold text-slate-800 dark:text-slate-100 hover:text-teal-600 dark:hover:text-teal-300 transition-colors">
                                                        <span><?php echo esc_html( $faq['q'] ); ?></span>
                                                        <svg class="w-4 h-4 text-slate-400 transform transition-transform duration-200 flex-shrink-0 faq-chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                                                    </button>
                                                    <div class="faq-content hidden px-4 pb-4 pt-0 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-200/40 dark:border-dark-border/40">
                                                        <?php echo esc_html( $faq['a'] ); ?>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- 7. FOOTER CTA BAR -->
                                <div class="relative z-10 pt-4 border-t border-slate-100 dark:border-dark-border flex flex-col sm:flex-row items-center justify-between gap-3 bg-slate-50/70 dark:bg-dark-surface/40 -mx-6 sm:-mx-8 -mb-6 sm:-mb-8 p-4 sm:px-8">
                                    <span class="text-xs text-slate-500 dark:text-slate-400 font-medium text-center sm:text-left">
                                        Sudah melakukan pembayaran? Simpan struk fisik/digital &amp; konfirmasi ke CS kami.
                                    </span>
                                    <a href="<?php echo esc_url( $wa_url ); ?>" 
                                       target="_blank" rel="noopener noreferrer"
                                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-black shadow-xs transition-colors flex-shrink-0">
                                        <span>Konfirmasi via WhatsApp</span> &rarr;
                                    </a>
                                </div>

                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

            </div>

        </div>
    </section>

    <!-- ========================================================================
         LIGHTBOX MODAL FOR INFOGRAPHIC IMAGES
         ======================================================================== -->
    <div id="wkl-lightbox-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/85 backdrop-blur-md p-4 transition-all duration-300" onclick="closeZoomModal(event)">
        <div class="relative max-w-5xl max-h-[92vh] w-full bg-white dark:bg-dark-card rounded-3xl overflow-hidden shadow-2xl flex flex-col border border-white/20" onclick="event.stopPropagation()">
            <!-- Modal Header -->
            <div class="px-5 py-3.5 bg-slate-50 dark:bg-dark-surface border-b border-slate-200 dark:border-dark-border flex items-center justify-between">
                <div>
                    <h5 id="wkl-lightbox-title" class="text-sm sm:text-base font-bold text-slate-900 dark:text-white"></h5>
                    <p id="wkl-lightbox-caption" class="text-xs text-slate-500 dark:text-slate-400 truncate max-w-xl"></p>
                </div>
                <button type="button" class="w-8 h-8 rounded-full bg-slate-200 dark:bg-dark-border hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 flex items-center justify-center font-bold text-sm transition-colors" onclick="closeZoomModal(event)">
                    ✕
                </button>
            </div>
            <!-- Modal Image Body -->
            <div class="flex-1 overflow-auto p-3 sm:p-5 flex items-center justify-center bg-slate-950/10 dark:bg-black/40">
                <img id="wkl-lightbox-img" src="" alt="" class="max-w-full max-h-[75vh] object-contain rounded-xl shadow-md">
            </div>
        </div>
    </div>

</main>

<!-- ========================================================================
     CLIENT-SIDE INTERACTIVE JS LOGIC (Tabs, Sub-tabs, Copy, FAQ, Lightbox)
     ======================================================================== -->
<script>
function wklSwitchLayananTab(tabId) {
    // 1. Sembunyikan semua pane layanan & tampilkan target
    var panes = document.querySelectorAll('.wkl-layanan-pane');
    panes.forEach(function(p) { p.classList.add('hidden'); p.classList.remove('block'); });

    var targetPane = document.getElementById('pane-' + tabId);
    if (targetPane) {
        targetPane.classList.remove('hidden');
        targetPane.classList.add('block');
    }

    // 2. Update status tombol sidebar desktop
    var dBtns = document.querySelectorAll('.wkl-tab-btn');
    dBtns.forEach(function(btn) {
        var isThis = (btn.getAttribute('data-tab-target') === tabId);
        var iconBox = btn.querySelector('div:first-child');
        var h4 = btn.querySelector('h4');
        var p = btn.querySelector('p');
        var chevron = btn.querySelector('div:last-child svg');

        if (isThis) {
            btn.className = 'wkl-tab-btn active w-full text-left p-3.5 rounded-2xl transition-all duration-300 flex items-start gap-3.5 border group relative bg-gradient-to-br from-emerald-600 via-teal-600 to-teal-700 text-white border-teal-500 shadow-lg shadow-teal-600/25';
            if (iconBox) iconBox.className = 'w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-105 bg-white/20 text-white shadow-xs';
            if (h4) h4.className = 'text-xs sm:text-sm font-bold tracking-tight truncate text-white';
            if (p) p.className = 'text-[11px] leading-snug line-clamp-2 text-teal-100 font-medium';
            if (chevron) chevron.className = 'w-4 h-4 transition-transform duration-300 group-hover:translate-x-1 text-white';
        } else {
            btn.className = 'wkl-tab-btn w-full text-left p-3.5 rounded-2xl transition-all duration-300 flex items-start gap-3.5 border group relative bg-slate-50/80 dark:bg-dark-surface/60 text-slate-700 dark:text-slate-200 border-slate-200/70 dark:border-dark-border/80 hover:bg-slate-100/90 dark:hover:bg-dark-surface hover:border-teal-300 dark:hover:border-teal-700/60';
            if (iconBox) iconBox.className = 'w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-105 bg-white dark:bg-dark-card text-teal-600 dark:text-teal-400 border border-slate-200/80 dark:border-dark-border shadow-2xs';
            if (h4) h4.className = 'text-xs sm:text-sm font-bold tracking-tight truncate text-slate-900 dark:text-white';
            if (p) p.className = 'text-[11px] leading-snug line-clamp-2 text-slate-500 dark:text-slate-400';
            if (chevron) chevron.className = 'w-4 h-4 transition-transform duration-300 group-hover:translate-x-1 text-slate-400 dark:text-slate-500';
        }
    });

    // 3. Update status tombol chip horizontal mobile
    var mBtns = document.querySelectorAll('.wkl-mobile-tab-btn');
    mBtns.forEach(function(mBtn) {
        var isThis = (mBtn.getAttribute('data-tab-target') === tabId);
        if (isThis) {
            mBtn.className = 'wkl-mobile-tab-btn flex items-center gap-2 px-4 py-2.5 rounded-2xl text-xs font-extrabold whitespace-nowrap transition-all duration-300 border shadow-md shadow-teal-600/20 bg-gradient-to-r from-emerald-600 to-teal-600 text-white border-teal-500';
        } else {
            mBtn.className = 'wkl-mobile-tab-btn flex items-center gap-2 px-4 py-2.5 rounded-2xl text-xs font-extrabold whitespace-nowrap transition-all duration-300 border shadow-2xs bg-white dark:bg-dark-card text-slate-700 dark:text-slate-200 border-slate-200/80 dark:border-dark-border hover:bg-slate-50';
        }
    });
}

function wklSwitchChannel(itemId, channelIndex) {
    var paneParent = document.getElementById('pane-' + itemId);
    if (!paneParent) return;

    // Sembunyikan seluruh channel panel di item ini
    var cPanes = paneParent.querySelectorAll('.wkl-channel-pane');
    cPanes.forEach(function(cp) { cp.classList.add('hidden'); cp.classList.remove('block'); });

    // Tampilkan panel target
    var targetCPane = document.getElementById('channel-pane-' + itemId + '-' + channelIndex);
    if (targetCPane) {
        targetCPane.classList.remove('hidden');
        targetCPane.classList.add('block');
    }

    // Update active button state
    var subBtns = paneParent.querySelectorAll('.wkl-subtab-btn');
    subBtns.forEach(function(sb, idx) {
        if (idx === channelIndex) {
            sb.className = 'wkl-subtab-btn active px-4 py-2.5 rounded-2xl text-xs font-bold transition-all duration-200 border whitespace-nowrap shadow-sm bg-slate-900 dark:bg-white text-white dark:text-slate-900 border-slate-900 dark:border-white flex items-center gap-2';
        } else {
            sb.className = 'wkl-subtab-btn px-4 py-2.5 rounded-2xl text-xs font-bold transition-all duration-200 border whitespace-nowrap shadow-2xs bg-slate-100 dark:bg-dark-surface text-slate-700 dark:text-slate-300 border-slate-200/80 dark:border-dark-border hover:bg-slate-200/80 flex items-center gap-2';
        }
    });
}

function wklCopyToClipboard(text, btnElement) {
    if (!navigator.clipboard) {
        var tempInput = document.createElement('input');
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
    } else {
        navigator.clipboard.writeText(text);
    }

    var originalHtml = btnElement.innerHTML;
    btnElement.innerHTML = '✓ Disalin!';
    btnElement.classList.add('bg-emerald-600', 'text-white');

    setTimeout(function() {
        btnElement.innerHTML = originalHtml;
        btnElement.classList.remove('bg-emerald-600', 'text-white');
    }, 2000);
}

function wklToggleFaq(btn) {
    var item = btn.closest('.wkl-faq-item');
    if (!item) return;
    var content = item.querySelector('.faq-content');
    var chevron = item.querySelector('.faq-chevron');

    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        chevron.classList.add('rotate-180');
    } else {
        content.classList.add('hidden');
        chevron.classList.remove('rotate-180');
    }
}

function openZoomModal(imgUrl, title, caption) {
    var modal = document.getElementById('wkl-lightbox-modal');
    var mImg  = document.getElementById('wkl-lightbox-img');
    var mTit  = document.getElementById('wkl-lightbox-title');
    var mCap  = document.getElementById('wkl-lightbox-caption');

    if (!modal || !mImg) return;

    mImg.src = imgUrl;
    mTit.innerText = title || 'Panduan Layanan Perbankan';
    mCap.innerText = caption || '';

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeZoomModal(event) {
    var modal = document.getElementById('wkl-lightbox-modal');
    if (!modal) return;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeZoomModal();
    }
});
</script>

<?php
get_footer();
