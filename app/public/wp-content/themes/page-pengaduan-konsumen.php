<?php
/**
 * Template Name: Layanan Pengaduan Konsumen
 * Description: Halaman Resmi Layanan Pengaduan Konsumen & Kepatuhan Regulasi POJK No. 22 Tahun 2023.
 *              Menampilkan Saluran Aduan Dinamis (Internal & Eskalasi OJK), Panduan Visual & Infografis Alur Media, SLA Dinamis, dan Dokumen Persyaratan.
 *
 * @package Wakalumi
 */

// Filter dynamic document title tag agar otomatis mengikuti pengaturan CMS
add_filter( 'document_title_parts', function( $title_parts ) {
    if ( function_exists( 'wakalumi_get_pengaduan_settings' ) ) {
        $cfg = wakalumi_get_pengaduan_settings();
        if ( ! empty( $cfg['title'] ) ) {
            $title_parts['title'] = $cfg['title'];
        }
    }
    return $title_parts;
}, 99 );

get_header();

$cfg = function_exists( 'wakalumi_get_pengaduan_settings' ) ? wakalumi_get_pengaduan_settings() : [];

$clean_wa      = preg_replace( '/[^0-9]/', '', $cfg['wa'] ?? '6281517380388' );
$wa_url        = 'https://wa.me/' . $clean_wa . '?text=' . rawurlencode( 'Halo Tim Layanan Nasabah Bank Syariah Wakalumi, saya ingin menyampaikan pengaduan terkait layanan perbankan.' );

$clean_ojk_wa  = preg_replace( '/[^0-9]/', '', $cfg['ojk_wa'] ?? '081157157157' );
$ojk_wa_url    = 'https://wa.me/' . $clean_ojk_wa;

$has_pdf_file  = ! empty( $cfg['form_pdf_url'] );
$pdf_link      = $has_pdf_file ? $cfg['form_pdf_url'] : $wa_url . '&text=' . rawurlencode( 'Halo Tim Bank Syariah Wakalumi, mohon kirimkan Berkas PDF Formulir Pengaduan Nasabah resmi.' );

// Nilai SLA Dinamis
$sla_primary_time   = ! empty( $cfg['sla_card1_time'] ) ? $cfg['sla_card1_time'] : '20 Hari Kerja';
$sla_secondary_time = ! empty( $cfg['sla_card2_time'] ) ? $cfg['sla_card2_time'] : '+20 Hari Kerja';
$channels           = ! empty( $cfg['channels'] ) && is_array( $cfg['channels'] ) ? $cfg['channels'] : [];
$steps              = ! empty( $cfg['steps'] ) && is_array( $cfg['steps'] ) ? $cfg['steps'] : [];
?>

<main class="min-h-screen bg-transparent text-slate-800 dark:text-slate-100 transition-colors duration-300">

    <!-- ========================================================================
         SECTION 1: HERO HEADER BANNER (STANDAR SERAGAM DENGAN BRANDING RESMI)
         DENGAN CARD BADGE KEAMANAN, KERAHASIAAN & TRANSPARANSI NASABAH
         ======================================================================== -->
    <section class="relative z-10 pt-8 pb-12 md:pb-16 overflow-hidden bg-gradient-to-b from-teal-50/60 via-slate-50/40 to-transparent dark:from-dark-surface dark:via-dark-surface/50 dark:to-transparent border-b border-slate-200/80 dark:border-dark-border/80">
        <!-- Ambient Blur Glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-72 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

        <!-- Background Watermark Emblem (Hero Header) -->
        <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/4 w-80 sm:w-96 h-80 sm:h-96 opacity-[0.045] dark:opacity-[0.07] pointer-events-none select-none z-0 mix-blend-multiply dark:mix-blend-screen">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain grayscale">
        </div>

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
                <span class="text-teal-600 dark:text-teal-400 font-semibold">Pengaduan Konsumen</span>
            </nav>

            <!-- 2-COLUMN HERO GRID: LEFT (INFO) & RIGHT (CARD BADGE KEAMANAN & TRANSPARANSI) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                
                <!-- Left Column: Kicker, Title, Subtitle, Highlights -->
                <div class="<?php echo ! empty( $cfg['hero_trust_show'] ) ? 'lg:col-span-7' : 'max-w-4xl'; ?> space-y-4" data-aos="fade-up">
                    <!-- Kicker Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100/80 dark:bg-emerald-950/60 border border-emerald-300/60 dark:border-emerald-700/50 text-emerald-800 dark:text-emerald-300 text-xs font-bold uppercase tracking-wider mb-2 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <?php echo esc_html( $cfg['badge'] ?? 'Perlindungan Konsumen & Regulasi OJK' ); ?>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                        <?php echo esc_html( $cfg['title'] ?? 'Layanan Pengaduan Konsumen' ); ?>
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl">
                        <?php echo esc_html( $cfg['subtitle'] ?? 'Komitmen Bank Syariah Wakalumi dalam mendengarkan, melayani, dan menindaklanjuti setiap aspirasi serta pengaduan nasabah secara adil, transparan, dan profesional berpedoman pada POJK No. 22 Tahun 2023.' ); ?>
                    </p>

                    <!-- Quick Highlights -->
                    <div class="flex flex-wrap items-center gap-2.5 pt-4 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                            <span>POJK No. 22/2023</span>
                        </div>
                        <?php if ( ! empty( $cfg['sla_show'] ) ) : ?>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>SLA: <?php echo esc_html( $sla_primary_time ); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                            <span>100% Bebas Biaya</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Glassmorphic Trust & Security Badge Card -->
                <?php if ( ! empty( $cfg['hero_trust_show'] ) ) : ?>
                <div class="lg:col-span-5" data-aos="fade-left" data-aos-delay="100">
                    <div class="spotlight-card group relative rounded-3xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-emerald-300/80 dark:border-emerald-700/60 shadow-xl shadow-emerald-500/10 hover:shadow-2xl hover:shadow-emerald-500/20 transition-all duration-500 overflow-hidden p-6 sm:p-7">
                        
                        <!-- Top Accent Line -->
                        <div class="h-1.5 w-full bg-gradient-to-r from-emerald-500 via-teal-400 to-cyan-500 absolute top-0 left-0 right-0"></div>

                        <!-- Decorative Watermark Logo inside Card -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] 
                                    w-56 h-56
                                    opacity-[0.04] dark:opacity-[0.06] 
                                    pointer-events-none select-none 
                                    transition-all duration-700 ease-out 
                                    group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 
                                    group-hover:opacity-[0.09] dark:group-hover:opacity-[0.14] 
                                    grayscale mix-blend-multiply dark:mix-blend-screen overflow-hidden z-0">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain">
                        </div>

                        <!-- Card Header: Shield Icon & Title -->
                        <div class="flex items-center gap-3.5 mb-4 relative z-10">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center shadow-lg shadow-emerald-500/30 flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                            </div>
                            <div>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 text-[10px] font-black uppercase tracking-wider border border-emerald-300/60 dark:border-emerald-700/60 mb-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <?php echo esc_html( $cfg['hero_trust_badge'] ?? 'Jaminan Perlindungan Nasabah' ); ?>
                                </span>
                                <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white tracking-tight flex items-center gap-1.5">
                                    <?php echo esc_html( $cfg['hero_trust_title'] ?? 'Aman, Rahasia & Terbuka' ); ?>
                                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                                </h3>
                            </div>
                        </div>

                        <!-- Card Description -->
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-4 relative z-10">
                            <?php echo esc_html( $cfg['hero_trust_desc'] ?? 'Setiap aspirasi dan laporan keluhan nasabah ditangani dengan prinsip keterbukaan, perlakuan adil, serta jaminan kerahasiaan identitas penuh tanpa dipungut biaya apapun.' ); ?>
                        </p>

                        <!-- 4 Micro Trust Badges Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 mb-4 relative z-10">
                            <!-- Trust Point 1 -->
                            <div class="p-2.5 rounded-xl bg-slate-50/90 dark:bg-dark-surface/60 border border-slate-200/70 dark:border-dark-border flex items-start gap-2 text-[11px] text-slate-700 dark:text-slate-200 font-semibold">
                                <span class="text-emerald-500 font-black text-xs mt-0.5">🛡️</span>
                                <span class="leading-snug"><?php echo esc_html( $cfg['hero_trust_p1'] ?? 'Kerahasiaan Identitas 100% Terlindungi UU & POJK' ); ?></span>
                            </div>
                            <!-- Trust Point 2 -->
                            <div class="p-2.5 rounded-xl bg-slate-50/90 dark:bg-dark-surface/60 border border-slate-200/70 dark:border-dark-border flex items-start gap-2 text-[11px] text-slate-700 dark:text-slate-200 font-semibold">
                                <span class="text-teal-500 font-black text-xs mt-0.5">📋</span>
                                <span class="leading-snug"><?php echo esc_html( $cfg['hero_trust_p2'] ?? 'Transparan dengan No. Tanda Terima Resmi' ); ?></span>
                            </div>
                            <!-- Trust Point 3 -->
                            <div class="p-2.5 rounded-xl bg-slate-50/90 dark:bg-dark-surface/60 border border-slate-200/70 dark:border-dark-border flex items-start gap-2 text-[11px] text-slate-700 dark:text-slate-200 font-semibold">
                                <span class="text-amber-500 font-black text-xs mt-0.5">💰</span>
                                <span class="leading-snug"><?php echo esc_html( $cfg['hero_trust_p3'] ?? '100% Bebas Biaya Layanan & Aduan (Gratis)' ); ?></span>
                            </div>
                            <!-- Trust Point 4 -->
                            <div class="p-2.5 rounded-xl bg-slate-50/90 dark:bg-dark-surface/60 border border-slate-200/70 dark:border-dark-border flex items-start gap-2 text-[11px] text-slate-700 dark:text-slate-200 font-semibold">
                                <span class="text-blue-500 font-black text-xs mt-0.5">🏛️</span>
                                <span class="leading-snug"><?php echo esc_html( $cfg['hero_trust_p4'] ?? 'Eskalasi Resmi ke Regulator OJK & LAPS SJK' ); ?></span>
                            </div>
                        </div>

                        <!-- Regulatory Seal Strip -->
                        <div class="pt-3 border-t border-slate-200/70 dark:border-dark-border flex items-center justify-between text-[11px] text-slate-500 dark:text-slate-400 relative z-10">
                            <span class="inline-flex items-center gap-1.5 font-bold text-emerald-700 dark:text-emerald-400">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                                <?php echo esc_html( $cfg['hero_trust_seal'] ?? 'Bank Berizin & Diawasi Regulator OJK • Penjaminan LPS' ); ?>
                            </span>
                            <span class="px-2 py-0.5 rounded-md bg-emerald-100 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300 font-black uppercase tracking-wider text-[10px]">
                                Terlindungi
                            </span>
                        </div>

                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 2: SALURAN LAYANAN PENGADUAN (KARTU DINAMIS & MODULAR)
         DENGAN GAYA DUAL-TONE, ANIMASI KACA (GLASS SHINE) & WATERMARK
         ======================================================================== -->
    <?php if ( ! empty( $cfg['channels_show'] ) && ! empty( $channels ) ) : ?>
    <section class="py-12 md:py-16 bg-transparent relative z-20 -mt-4">
        <div class="container-wide">
            
            <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
                <span class="text-xs font-extrabold text-teal-600 dark:text-teal-400 uppercase tracking-widest block mb-2">
                    Pilihan Saluran Layanan
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">
                    Sampaikan Pengaduan dengan Mudah &amp; Cepat
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2">
                    Sampaikan aduan langsung kepada Bank Syariah Wakalumi, atau eskalasikan ke portal resmi regulator Otoritas Jasa Keuangan (OJK) jika diperlukan.
                </p>
            </div>

            <?php
            $num_channels = count( $channels );
            $grid_class = 'grid grid-cols-1 ' . ( $num_channels === 3 ? 'md:grid-cols-2 lg:grid-cols-3' : ( $num_channels > 1 ? 'lg:grid-cols-2' : 'max-w-2xl mx-auto' ) ) . ' gap-8';
            ?>
            <div class="<?php echo esc_attr( $grid_class ); ?>">
                
                <?php foreach ( $channels as $c_idx => $ch ) : 
                    $theme = function_exists( 'wakalumi_get_pengaduan_color_theme' ) 
                        ? wakalumi_get_pengaduan_color_theme( $ch['color'] ?? 'emerald' ) 
                        : [];

                    // Resolve Primary Button Link
                    $btn_prim_url = ! empty( $ch['btn_primary_url'] ) ? $ch['btn_primary_url'] : '';
                    if ( empty( $btn_prim_url ) && ! empty( $ch['contact_wa'] ) ) {
                        $c_wa_clean   = preg_replace( '/[^0-9]/', '', $ch['contact_wa'] );
                        $btn_prim_url = 'https://wa.me/' . $c_wa_clean . '?text=' . rawurlencode( 'Halo Tim Layanan Nasabah Bank Syariah Wakalumi, saya ingin menyampaikan pengaduan terkait layanan perbankan.' );
                    }

                    // Resolve Secondary Button Link
                    $btn_sec_url = ! empty( $ch['btn_secondary_url'] ) ? $ch['btn_secondary_url'] : '';
                    if ( empty( $btn_sec_url ) && ! empty( $ch['contact_email'] ) ) {
                        $btn_sec_url = 'mailto:' . esc_attr( $ch['contact_email'] ) . '?subject=' . rawurlencode( 'Pengaduan Nasabah - Bank Syariah Wakalumi' );
                    }
                ?>
                    <!-- CARD SALURAN PENGADUAN -->
                    <div class="spotlight-card group relative rounded-3xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border <?php echo esc_attr( $theme['border'] ?? 'border-slate-200/90 dark:border-dark-border' ); ?> shadow-md hover:shadow-2xl <?php echo esc_attr( $theme['hover_shadow'] ?? '' ); ?> hover:-translate-y-1.5 transition-all duration-500 overflow-hidden flex flex-col justify-between" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( ($c_idx + 1) * 70 ); ?>">
                        
                        <!-- Decorative Watermark Logo (Interactive Hover: Left 3/4 -> Right 1/2 Full Card) -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] 
                                    w-64 h-64 sm:w-72 sm:h-72 md:w-80 md:h-80
                                    opacity-[0.035] dark:opacity-[0.055] 
                                    pointer-events-none select-none 
                                    transition-all duration-700 ease-out 
                                    group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 
                                    group-hover:opacity-[0.08] dark:group-hover:opacity-[0.14] 
                                    grayscale mix-blend-multiply dark:mix-blend-screen overflow-hidden z-0">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain">
                        </div>

                        <!-- Top Accent Line -->
                        <div class="h-1.5 w-full bg-gradient-to-r <?php echo esc_attr( $theme['top_line'] ?? 'from-emerald-500 to-teal-400' ); ?> relative z-10"></div>

                        <!-- TONE 1: TINTED HEADER BAR -->
                        <div class="p-6 sm:p-7 bg-gradient-to-br <?php echo esc_attr( $theme['header_bg'] ?? 'from-slate-50 to-white/10 dark:from-dark-surface dark:to-dark-card' ); ?> relative overflow-hidden z-10 flex flex-col justify-between min-h-[230px]">

                            <!-- Badge Row -->
                            <div class="flex items-center justify-between gap-2 mb-3 min-h-[28px] relative z-10">
                                <?php if ( ! empty( $ch['badge'] ) ) : ?>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider <?php echo esc_attr( $theme['badge'] ?? 'bg-slate-100 text-slate-800' ); ?> shadow-xs">
                                        <span class="w-2 h-2 rounded-full <?php echo esc_attr( $theme['ping_dot'] ?? 'bg-emerald-500' ); ?> animate-ping"></span>
                                        <?php echo esc_html( $ch['badge'] ); ?>
                                    </span>
                                <?php endif; ?>

                                <?php if ( ! empty( $ch['tag'] ) ) : ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-white/80 dark:bg-dark-surface <?php echo esc_attr( $theme['tag'] ?? 'text-slate-700 dark:text-slate-300' ); ?> text-[11px] font-bold border shadow-xs">
                                        <svg class="w-3 h-3 text-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                        <?php echo esc_html( $ch['tag'] ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Title & Description -->
                            <div class="relative z-10">
                                <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white mb-2 <?php echo esc_attr( $theme['title_hover'] ?? '' ); ?> transition-colors min-h-[58px] flex items-center">
                                    <?php echo esc_html( $ch['title'] ); ?>
                                </h3>
                                <?php if ( ! empty( $ch['desc'] ) ) : ?>
                                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed min-h-[66px] flex items-center">
                                        <?php echo esc_html( $ch['desc'] ); ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <!-- Informative Pill Badges -->
                            <div class="flex flex-wrap items-center gap-2 mt-4 pt-3 border-t border-slate-200/60 dark:border-dark-border/60 relative z-10">
                                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200/80 dark:border-dark-border flex items-center gap-1.5 shadow-2xs">
                                    <svg class="w-3.5 h-3.5 <?php echo esc_attr( $theme['pill_icon'] ?? 'text-teal-600' ); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                                    <span>Kerahasiaan Terjamin</span>
                                </span>
                                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200/80 dark:border-dark-border flex items-center gap-1.5 shadow-2xs">
                                    <svg class="w-3.5 h-3.5 <?php echo esc_attr( $theme['pill_icon'] ?? 'text-teal-600' ); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                                    <span>Respon Cepat</span>
                                </span>
                                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200/80 dark:border-dark-border flex items-center gap-1.5 shadow-2xs">
                                    <svg class="w-3.5 h-3.5 <?php echo esc_attr( $theme['pill_icon'] ?? 'text-teal-600' ); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>Berkeadilan Syariah</span>
                                </span>
                            </div>
                        </div>

                        <!-- TONE 2: CARD BODY & CHANNELS -->
                        <div class="p-6 sm:p-7 flex-1 flex flex-col justify-between bg-white dark:bg-dark-card space-y-6">
                            
                            <!-- Channel Items List -->
                            <div class="space-y-3">
                                
                                <!-- WhatsApp Channel (If Available) -->
                                <?php if ( ! empty( $ch['contact_wa'] ) ) : 
                                    $item_clean_wa = preg_replace( '/[^0-9]/', '', $ch['contact_wa'] );
                                    $item_wa_link  = 'https://wa.me/' . $item_clean_wa . '?text=' . rawurlencode( 'Halo Tim Layanan Nasabah Bank Syariah Wakalumi, saya ingin menyampaikan pengaduan terkait layanan perbankan.' );
                                ?>
                                    <div class="group/item flex items-start gap-3.5 p-3.5 rounded-2xl <?php echo esc_attr( $theme['channel_bg'] ?? 'bg-slate-50 dark:bg-dark-surface' ); ?> transition-all hover:translate-x-1">
                                        <div class="w-10 h-10 rounded-xl <?php echo esc_attr( $theme['channel_icon'] ?? 'bg-emerald-500 text-white' ); ?> flex items-center justify-center flex-shrink-0 shadow-md group-hover/item:scale-105 transition-transform">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.966-.941 1.164-.173.199-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs font-bold text-slate-500 dark:text-slate-400">WhatsApp Pengaduan</span>
                                                <?php if ( ! empty( $ch['status_tag'] ) ) : ?>
                                                    <span class="inline-flex items-center gap-1 text-[10px] font-extrabold <?php echo esc_attr( $theme['status_tag'] ?? 'text-emerald-600' ); ?> uppercase tracking-wider">
                                                        <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $theme['ping_dot'] ?? 'bg-emerald-500' ); ?> animate-pulse"></span> <?php echo esc_html( $ch['status_tag'] ); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <a href="<?php echo esc_url( $item_wa_link ); ?>" target="_blank" rel="noopener noreferrer" class="text-sm font-extrabold <?php echo esc_attr( $theme['channel_link'] ?? 'text-emerald-700' ); ?> hover:underline block mt-0.5">
                                                +<?php echo esc_html( $ch['contact_wa'] ); ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Phone / Hotline (If Available) -->
                                <?php if ( ! empty( $ch['contact_phone'] ) ) : ?>
                                    <div class="group/item flex items-start gap-3.5 p-3.5 rounded-2xl bg-slate-50 dark:bg-dark-surface-alt border border-slate-200/80 dark:border-dark-border hover:border-teal-400 dark:hover:border-teal-700 transition-all hover:translate-x-1">
                                        <div class="w-10 h-10 rounded-xl bg-teal-600 text-white flex items-center justify-center flex-shrink-0 shadow-md shadow-teal-600/30 group-hover/item:scale-105 transition-transform">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <span class="text-xs font-bold text-slate-500 dark:text-slate-400 block">Hotline Telepon Resmi</span>
                                            <span class="text-sm font-extrabold text-slate-900 dark:text-white block mt-0.5">
                                                <?php echo esc_html( $ch['contact_phone'] ); ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Email (If Available) -->
                                <?php if ( ! empty( $ch['contact_email'] ) ) : ?>
                                    <div class="group/item flex items-start gap-3.5 p-3.5 rounded-2xl bg-slate-50 dark:bg-dark-surface-alt border border-slate-200/80 dark:border-dark-border hover:border-slate-400 dark:hover:border-slate-600 transition-all hover:translate-x-1">
                                        <div class="w-10 h-10 rounded-xl bg-slate-700 text-white flex items-center justify-center flex-shrink-0 shadow-md group-hover/item:scale-105 transition-transform">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <span class="text-xs font-bold text-slate-500 dark:text-slate-400 block">Email Pengaduan / Portal</span>
                                            <a href="mailto:<?php echo esc_attr( $ch['contact_email'] ); ?>" class="text-sm font-extrabold text-slate-900 dark:text-white hover:text-teal-600 dark:hover:text-teal-400 truncate block mt-0.5">
                                                <?php echo esc_html( $ch['contact_email'] ); ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Lokasi / Keterangan Operasional (If Available) -->
                                <?php if ( ! empty( $ch['contact_desc'] ) ) : ?>
                                    <div class="p-3.5 rounded-2xl bg-slate-50/90 dark:bg-dark-surface-alt border border-slate-200/80 dark:border-dark-border text-xs text-slate-600 dark:text-slate-300">
                                        <div class="flex items-center gap-2 font-bold text-slate-900 dark:text-white mb-1">
                                            <svg class="w-4 h-4 <?php echo esc_attr( $theme['pill_icon'] ?? 'text-emerald-600' ); ?> flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.75a1.5 1.5 0 011.5-1.5h1.5a1.5 1.5 0 011.5 1.5V21"/></svg>
                                            <span>Informasi Lokasi &amp; Jam Layanan</span>
                                        </div>
                                        <div class="text-[11px] text-slate-500 dark:text-slate-400 pl-6 leading-relaxed min-h-[34px] flex items-center">
                                            <?php echo esc_html( $ch['contact_desc'] ); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>

                            <!-- CTA Action Buttons -->
                            <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
                                <?php if ( ! empty( $ch['btn_primary_text'] ) && ! empty( $btn_prim_url ) ) : ?>
                                    <a 
                                        href="<?php echo esc_url( $btn_prim_url ); ?>" 
                                        target="_blank" 
                                        rel="noopener noreferrer" 
                                        class="w-full sm:flex-1 py-3.5 px-6 rounded-2xl <?php echo esc_attr( $theme['btn_action'] ?? 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/30' ); ?> text-white text-sm font-extrabold shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 text-center"
                                    >
                                        <span><?php echo esc_html( $ch['btn_primary_text'] ); ?></span>
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                    </a>
                                <?php endif; ?>

                                <?php if ( ! empty( $ch['btn_secondary_text'] ) && ! empty( $btn_sec_url ) ) : ?>
                                    <a 
                                        href="<?php echo esc_url( $btn_sec_url ); ?>" 
                                        <?php echo ( strpos( $btn_sec_url, 'http' ) === 0 ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
                                        class="w-full sm:w-auto py-3.5 px-5 rounded-2xl border border-slate-200 dark:border-dark-border bg-white dark:bg-dark-card hover:border-slate-400 text-slate-700 dark:text-slate-200 text-sm font-bold shadow-xs hover:-translate-y-0.5 transition-all text-center flex items-center justify-center gap-2"
                                    >
                                        <span><?php echo esc_html( $ch['btn_secondary_text'] ); ?></span>
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ========================================================================
         SECTION 3: RUANG PANDUAN VISUAL TIM MEDIA & INFOGRAFIS ALUR LENGKAP
         (TAMPIL JIKA DIISI / DIAKTIFKAN OLEH ADMIN DENGAN FITUR MODAL PERBESAR)
         ======================================================================== -->
    <?php if ( ! empty( $cfg['infografis_show'] ) && ! empty( $cfg['infografis_image'] ) ) : ?>
    <section class="py-12 md:py-16 bg-gradient-to-b from-sky-50/50 via-slate-50/40 to-transparent dark:from-dark-surface/50 dark:via-dark-surface/30 dark:to-transparent border-t border-slate-200/80 dark:border-dark-border/80 relative" data-aos="fade-up">
        <div class="container-wide">
            
            <div class="text-center max-w-3xl mx-auto mb-10">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-100/90 dark:bg-sky-950/70 border border-sky-300/70 dark:border-sky-700/60 text-sky-800 dark:text-sky-300 text-xs font-black uppercase tracking-wider mb-3 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse"></span>
                    <span>Panduan Visual • Tim Media Bank</span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">
                    <?php echo esc_html( $cfg['infografis_title'] ?? 'Bagan & Panduan Alur Pengaduan Nasabah' ); ?>
                </h2>
                <?php if ( ! empty( $cfg['infografis_desc'] ) ) : ?>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">
                        <?php echo esc_html( $cfg['infografis_desc'] ); ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Master Showcase Frame -->
            <div class="spotlight-card group relative max-w-5xl mx-auto rounded-3xl bg-white dark:bg-dark-card border border-sky-200/90 dark:border-dark-border shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
                <div class="h-1.5 w-full bg-gradient-to-r from-sky-500 via-teal-400 to-indigo-500"></div>

                <!-- Showcase Image Container with Overlay Zoom Button -->
                <div class="relative bg-slate-900/5 dark:bg-dark-surface/60 overflow-hidden group/zoom">
                    <img 
                        src="<?php echo esc_url( $cfg['infografis_image'] ); ?>" 
                        alt="<?php echo esc_attr( $cfg['infografis_title'] ?? 'Infografis Alur Pengaduan' ); ?>" 
                        class="w-full h-auto max-h-[620px] object-contain mx-auto cursor-pointer transition-transform duration-700 group-hover/zoom:scale-[1.01]"
                        onclick="openZoomModal('<?php echo esc_js( $cfg['infografis_image'] ); ?>', '<?php echo esc_js( $cfg['infografis_title'] ?? 'Infografis Alur Pengaduan' ); ?>', '<?php echo esc_js( $cfg['infografis_desc'] ?? '' ); ?>')"
                    >
                    
                    <!-- Floating Overlay Pill Button -->
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover/zoom:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
                        <button 
                            type="button" 
                            class="pointer-events-auto px-5 py-2.5 rounded-full bg-slate-900/90 hover:bg-black text-white text-xs sm:text-sm font-bold backdrop-blur-md shadow-xl flex items-center gap-2 transform translate-y-2 group-hover/zoom:translate-y-0 transition-all duration-300"
                            onclick="openZoomModal('<?php echo esc_js( $cfg['infografis_image'] ); ?>', '<?php echo esc_js( $cfg['infografis_title'] ?? 'Infografis Alur Pengaduan' ); ?>', '<?php echo esc_js( $cfg['infografis_desc'] ?? '' ); ?>')"
                        >
                            <svg class="w-4 h-4 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            <span>Klik untuk Perbesar Gambar (Resolusi Penuh)</span>
                        </button>
                    </div>
                </div>

                <!-- Footer Caption Strip -->
                <div class="p-4 sm:p-5 bg-slate-50/90 dark:bg-dark-surface-alt border-t border-slate-200/80 dark:border-dark-border flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500 dark:text-slate-400">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-sky-600 dark:text-sky-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                        <span>Gambar panduan resmi tim media Bank Syariah Wakalumi • Berpedoman pada regulasi OJK</span>
                    </span>
                    <button 
                        type="button" 
                        class="text-sky-600 dark:text-sky-400 hover:text-sky-700 font-bold flex items-center gap-1.5 transition-colors"
                        onclick="openZoomModal('<?php echo esc_js( $cfg['infografis_image'] ); ?>', '<?php echo esc_js( $cfg['infografis_title'] ?? 'Infografis Alur Pengaduan' ); ?>', '<?php echo esc_js( $cfg['infografis_desc'] ?? '' ); ?>')"
                    >
                        <span>Buka Lightbox</span> ↗
                    </button>
                </div>
            </div>

        </div>
    </section>
    <?php endif; ?>

    <!-- ========================================================================
         SECTION 4: TAHAPAN ALUR PROSEDUR PENANGANAN PENGADUAN NASABAH
         (MENDUKUNG GAMBAR ILUSTRASI PER TAHAP DARI TIM MEDIA & CAPTION)
         ======================================================================== -->
    <?php if ( ! empty( $cfg['alur_show'] ) && ! empty( $steps ) ) : ?>
    <section class="py-14 md:py-20 bg-white/80 dark:bg-dark-surface/60 border-y border-slate-200/80 dark:border-dark-border/80 relative">
        <div class="container-wide">
            
            <div class="text-center max-w-3xl mx-auto mb-14" data-aos="fade-up">
                <span class="text-xs font-extrabold text-emerald-600 dark:text-teal-400 uppercase tracking-widest block mb-2">
                    Prosedur &amp; Regulasi OJK
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white">
                    Alur Penanganan Pengaduan Nasabah
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2">
                    Bank Syariah Wakalumi menerapkan standar operasional penanganan pengaduan yang transparan, terukur, dan akuntabel berpedoman pada POJK No. 22 Tahun 2023.
                </p>
            </div>

            <?php
            $num_steps = count( $steps );
            $step_cols = 'grid grid-cols-1 sm:grid-cols-2 ' . ( $num_steps >= 4 ? 'lg:grid-cols-4' : ( $num_steps === 3 ? 'lg:grid-cols-3' : 'lg:grid-cols-2 max-w-4xl mx-auto' ) ) . ' gap-6 mb-14';
            
            // Variasi palet aksen per langkah
            $step_palettes = [
                0 => [ 'grad' => 'from-teal-500 to-cyan-400', 'bg' => 'from-teal-50/90 via-cyan-50/40 to-white/10 dark:from-teal-950/50', 'border' => 'hover:border-teal-400', 'icon_bg' => 'bg-teal-600', 'text' => 'text-teal-700 dark:text-teal-300', 'badge_bg' => 'bg-teal-50/70 dark:bg-teal-950/40 text-teal-800 dark:text-teal-300' ],
                1 => [ 'grad' => 'from-blue-600 to-indigo-500', 'bg' => 'from-blue-50/90 via-indigo-50/40 to-white/10 dark:from-blue-950/50', 'border' => 'hover:border-blue-400', 'icon_bg' => 'bg-blue-600', 'text' => 'text-blue-700 dark:text-blue-300', 'badge_bg' => 'bg-blue-50/70 dark:bg-blue-950/40 text-blue-800 dark:text-blue-300' ],
                2 => [ 'grad' => 'from-amber-500 to-orange-400', 'bg' => 'from-amber-50/90 via-orange-50/40 to-white/10 dark:from-amber-950/50', 'border' => 'hover:border-amber-400', 'icon_bg' => 'bg-amber-600', 'text' => 'text-amber-700 dark:text-amber-300', 'badge_bg' => 'bg-amber-50/70 dark:bg-amber-950/40 text-amber-800 dark:text-amber-300' ],
                3 => [ 'grad' => 'from-emerald-600 to-teal-500', 'bg' => 'from-emerald-50/90 via-teal-50/40 to-white/10 dark:from-emerald-950/50', 'border' => 'hover:border-emerald-400', 'icon_bg' => 'bg-emerald-600', 'text' => 'text-emerald-700 dark:text-emerald-300', 'badge_bg' => 'bg-emerald-50/70 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300' ],
            ];
            ?>
            <div class="<?php echo esc_attr( $step_cols ); ?>">
                
                <?php foreach ( $steps as $s_idx => $step ) : 
                    $pal = $step_palettes[ $s_idx % 4 ];
                    $has_step_img = ! empty( $step['image'] );
                ?>
                    <!-- Step Card -->
                    <div class="spotlight-card group relative rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border <?php echo esc_attr( $pal['border'] ); ?> shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between overflow-hidden" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( ($s_idx + 1) * 60 ); ?>">
                        
                        <!-- Top Accent Border -->
                        <div class="h-1.5 w-full bg-gradient-to-r <?php echo esc_attr( $pal['grad'] ); ?>"></div>

                        <div>
                            <!-- TONE 1: TINTED HEADER BAR -->
                            <div class="p-5 bg-gradient-to-br <?php echo esc_attr( $pal['bg'] ); ?> border-b border-slate-100 dark:border-dark-border flex items-center justify-between min-h-[76px] relative overflow-hidden">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-2xl <?php echo esc_attr( $pal['icon_bg'] ); ?> text-white flex items-center justify-center font-black text-base shadow-md group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 flex-shrink-0">
                                        <?php echo esc_html( $step['number'] ?? sprintf('%02d', $s_idx + 1) ); ?>
                                    </div>
                                    <div>
                                        <?php if ( ! empty( $step['badge'] ) ) : ?>
                                            <span class="text-[10px] font-extrabold uppercase tracking-widest <?php echo esc_attr( $pal['text'] ); ?> block">
                                                <?php echo esc_html( $step['badge'] ); ?>
                                            </span>
                                        <?php endif; ?>
                                        <span class="text-xs font-black text-slate-800 dark:text-slate-200">
                                            Tahap <?php echo esc_html( $step['number'] ?? ($s_idx + 1) ); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="w-8 h-8 rounded-xl bg-white/70 dark:bg-dark-surface <?php echo esc_attr( $pal['text'] ); ?> flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                            </div>

                            <!-- TONE 2: BODY DESCRIPTION & OPTIONAL STEP IMAGE -->
                            <div class="p-5 sm:p-6 space-y-3">
                                
                                <!-- Gambar Tahapan dari Tim Media (Jika Diunggah) -->
                                <?php if ( $has_step_img ) : ?>
                                    <div class="relative overflow-hidden rounded-2xl mb-3 bg-slate-100 dark:bg-dark-surface border border-slate-200/80 dark:border-dark-border group/stepimg">
                                        <img 
                                            src="<?php echo esc_url( $step['image'] ); ?>" 
                                            alt="<?php echo esc_attr( $step['title'] ); ?>" 
                                            class="w-full h-40 object-cover group-hover/stepimg:scale-105 transition-transform duration-500 cursor-pointer" 
                                            onclick="openZoomModal('<?php echo esc_js( $step['image'] ); ?>', '<?php echo esc_js( $step['title'] ); ?>', '<?php echo esc_js( $step['caption'] ?? '' ); ?>')"
                                        >
                                        <button 
                                            type="button" 
                                            class="absolute bottom-2 right-2 px-2.5 py-1 rounded-lg bg-black/60 hover:bg-black/80 text-white text-[10px] font-bold backdrop-blur-md flex items-center gap-1 transition-all"
                                            onclick="openZoomModal('<?php echo esc_js( $step['image'] ); ?>', '<?php echo esc_js( $step['title'] ); ?>', '<?php echo esc_js( $step['caption'] ?? '' ); ?>')"
                                        >
                                            <svg class="w-3 h-3 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                            <span>Perbesar</span>
                                        </button>
                                    </div>
                                    <?php if ( ! empty( $step['caption'] ) ) : ?>
                                        <div class="text-[11px] text-slate-500 dark:text-slate-400 italic mb-2">
                                            <?php echo esc_html( $step['caption'] ); ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <h4 class="text-base font-extrabold text-slate-900 dark:text-white transition-colors min-h-[48px] flex items-center">
                                    <?php echo esc_html( $step['title'] ); ?>
                                </h4>
                                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed min-h-[64px] flex items-center">
                                    <?php echo esc_html( $step['desc'] ); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Card Output Footer -->
                        <?php if ( ! empty( $step['output'] ) ) : ?>
                            <div class="px-5 pb-5 pt-0">
                                <div class="p-2.5 rounded-xl <?php echo esc_attr( $pal['badge_bg'] ); ?> border border-slate-200/60 dark:border-dark-border text-[11px] font-bold flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                    <span><?php echo esc_html( $step['output'] ); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ========================================================================
         SECTION 5: STANDAR WAKTU LAYANAN PENGADUAN (SLA RESMI POJK NO. 22/2023)
         DIBUAT SIMETRIS, RAPI, BERSIH, DAN 100% DINAMIS DARI CMS ADMIN
         ======================================================================== -->
    <?php if ( ! empty( $cfg['sla_show'] ) ) : ?>
    <section class="py-12 md:py-16 bg-slate-100/70 dark:bg-dark-surface/40 border-b border-slate-200/80 dark:border-dark-border/80 relative">
        <div class="container-wide">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-black uppercase tracking-wider mb-3 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                    <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Komitmen Kepastian Waktu</span>
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    <?php echo esc_html( $cfg['sla_title'] ?? 'Standar Waktu Layanan Pengaduan (SLA)' ); ?>
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">
                    <?php echo esc_html( $cfg['sla_subtitle'] ?? 'Bank Syariah Wakalumi menjamin setiap pengaduan nasabah diselesaikan secara tepat waktu, profesional, dan transparan berpedoman pada POJK No. 22 Tahun 2023.' ); ?>
                </p>
            </div>

            <!-- 2 Symmetrical Sized Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto mb-6 items-stretch">
                
                <!-- CARD SLA 1: PENYELESAIAN OLEH BANK -->
                <div class="spotlight-card group relative rounded-3xl bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border hover:border-emerald-400 dark:hover:border-emerald-500/80 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between" data-aos="fade-up" data-aos-delay="50">
                    
                    <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] 
                                w-48 h-48 sm:w-56 sm:h-56
                                opacity-[0.035] dark:opacity-[0.055] 
                                pointer-events-none select-none 
                                transition-all duration-700 ease-out 
                                group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 
                                group-hover:opacity-[0.08] dark:group-hover:opacity-[0.14] 
                                grayscale mix-blend-multiply dark:mix-blend-screen overflow-hidden z-0">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain">
                    </div>

                    <div class="h-1.5 w-full bg-emerald-500 relative z-10"></div>

                    <!-- Top Bar (Tone 1) -->
                    <div class="p-5 bg-emerald-50/80 dark:bg-emerald-950/40 border-b border-emerald-100 dark:border-emerald-900/40 flex items-center justify-between min-h-[82px] relative z-10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center shadow-md shadow-emerald-500/25 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <span class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-wider block">
                                    <?php echo esc_html( $cfg['sla_card1_title'] ?? 'Penyelesaian Standar oleh Bank' ); ?>
                                </span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400">Saluran Resmi Bank Syariah Wakalumi</span>
                            </div>
                        </div>
                        <?php if ( ! empty( $cfg['sla_card1_badge'] ) ) : ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/60 text-emerald-800 dark:text-emerald-300 text-[11px] font-extrabold flex-shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                                <?php echo esc_html( $cfg['sla_card1_badge'] ); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Body (Tone 2) -->
                    <div class="p-6 flex-1 flex flex-col justify-between relative z-10">
                        <div>
                            <!-- Metric Podium Box -->
                            <div class="p-4 rounded-2xl bg-slate-50/90 dark:bg-dark-surface/60 border border-slate-200/70 dark:border-dark-border mb-4 flex items-center justify-between">
                                <div>
                                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-0.5">
                                        <?php echo esc_html( $cfg['sla_card1_label'] ?? 'Maksimal Standar' ); ?>
                                    </span>
                                    <span class="text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400 tracking-tight">
                                        <?php echo esc_html( $sla_primary_time ); ?>
                                    </span>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 flex items-center justify-center font-black text-xs uppercase tracking-wider border border-emerald-200/60 dark:border-emerald-800/60">
                                    SLA
                                </div>
                            </div>

                            <p class="min-h-[48px] text-xs text-slate-600 dark:text-slate-400 leading-relaxed mb-4">
                                <?php echo esc_html( $cfg['sla_card1_desc'] ?? 'Bank Syariah Wakalumi wajib menyelesaikan penanganan pengaduan nasabah paling lambat 20 hari kerja sejak dokumen pendukung lengkap diterima.' ); ?>
                            </p>
                            
                            <?php 
                            $points1 = ! empty( $cfg['sla_card1_points'] ) ? explode( "\n", str_replace( "\r", "", $cfg['sla_card1_points'] ) ) : [];
                            if ( ! empty( $points1 ) ) : 
                            ?>
                                <div class="pt-3.5 border-t border-slate-100 dark:border-dark-border space-y-2.5 text-xs text-slate-600 dark:text-slate-400">
                                    <?php foreach ( $points1 as $p1 ) : 
                                        $p1 = trim( $p1 );
                                        if ( empty( $p1 ) ) continue;
                                    ?>
                                        <div class="flex items-start gap-2.5">
                                            <span class="w-4 h-4 rounded-full bg-emerald-100 dark:bg-emerald-950/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-[10px] font-bold flex-shrink-0 mt-0.5">✓</span>
                                            <span class="leading-relaxed"><?php echo esc_html( $p1 ); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Card Footer Tag -->
                        <div class="mt-5 pt-3.5 border-t border-slate-100 dark:border-dark-border flex items-center justify-between text-[11px] text-slate-400">
                            <span>Tahap 1: Unit Layanan Aduan</span>
                            <span class="font-bold text-emerald-600 dark:text-emerald-400">POJK No. 22/2023</span>
                        </div>
                    </div>
                </div>

                <!-- CARD SLA 2: KONDISI TERTENTU & PERPANJANGAN -->
                <div class="spotlight-card group relative rounded-3xl bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border hover:border-teal-400 dark:hover:border-teal-500/80 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                    
                    <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] 
                                w-48 h-48 sm:w-56 sm:h-56
                                opacity-[0.035] dark:opacity-[0.055] 
                                pointer-events-none select-none 
                                transition-all duration-700 ease-out 
                                group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 
                                group-hover:opacity-[0.08] dark:group-hover:opacity-[0.14] 
                                grayscale mix-blend-multiply dark:mix-blend-screen overflow-hidden z-0">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain">
                    </div>

                    <div class="h-1.5 w-full bg-teal-600 relative z-10"></div>

                    <!-- Top Bar (Tone 1) -->
                    <div class="p-5 bg-teal-50/80 dark:bg-teal-950/40 border-b border-teal-100 dark:border-teal-900/40 flex items-center justify-between min-h-[82px] relative z-10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-teal-600 text-white flex items-center justify-center shadow-md shadow-teal-600/25 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </div>
                            <div>
                                <span class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-wider block">
                                    <?php echo esc_html( $cfg['sla_card2_title'] ?? 'Perpanjangan Waktu Resmi Bank' ); ?>
                                </span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400">Pemberitahuan Tertulis Resmi</span>
                            </div>
                        </div>
                        <?php if ( ! empty( $cfg['sla_card2_badge'] ) ) : ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-teal-100 dark:bg-teal-900/60 text-teal-800 dark:text-teal-300 text-[11px] font-extrabold flex-shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-teal-500 animate-ping"></span>
                                <?php echo esc_html( $cfg['sla_card2_badge'] ); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Body (Tone 2) -->
                    <div class="p-6 flex-1 flex flex-col justify-between relative z-10">
                        <div>
                            <!-- Metric Podium Box -->
                            <div class="p-4 rounded-2xl bg-slate-50/90 dark:bg-dark-surface/60 border border-slate-200/70 dark:border-dark-border mb-4 flex items-center justify-between">
                                <div>
                                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-0.5">
                                        <?php echo esc_html( $cfg['sla_card2_label'] ?? 'Kondisi Tertentu' ); ?>
                                    </span>
                                    <span class="text-2xl sm:text-3xl font-black text-teal-600 dark:text-teal-400 tracking-tight">
                                        <?php echo esc_html( $sla_secondary_time ); ?>
                                    </span>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-teal-100 dark:bg-teal-950/60 text-teal-700 dark:text-teal-300 flex items-center justify-center font-black text-xs uppercase tracking-wider border border-teal-200/60 dark:border-teal-800/60">
                                    +SLA
                                </div>
                            </div>

                            <p class="min-h-[48px] text-xs text-slate-600 dark:text-slate-400 leading-relaxed mb-4">
                                <?php echo esc_html( $cfg['sla_card2_desc'] ?? 'Dapat diperpanjang paling lama 20 hari kerja jika membutuhkan konfirmasi pihak ketiga dengan pemberitahuan tertulis kepada nasabah sebelum hari ke-20.' ); ?>
                            </p>
                            
                            <?php 
                            $points2 = ! empty( $cfg['sla_card2_points'] ) ? explode( "\n", str_replace( "\r", "", $cfg['sla_card2_points'] ) ) : [];
                            if ( ! empty( $points2 ) ) : 
                            ?>
                                <div class="pt-3.5 border-t border-slate-100 dark:border-dark-border space-y-2.5 text-xs text-slate-600 dark:text-slate-400">
                                    <?php foreach ( $points2 as $p2 ) : 
                                        $p2 = trim( $p2 );
                                        if ( empty( $p2 ) ) continue;
                                    ?>
                                        <div class="flex items-start gap-2.5">
                                            <span class="w-4 h-4 rounded-full bg-teal-100 dark:bg-teal-950/80 text-teal-600 dark:text-teal-400 flex items-center justify-center text-[10px] font-bold flex-shrink-0 mt-0.5">✓</span>
                                            <span class="leading-relaxed"><?php echo esc_html( $p2 ); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Card Footer Tag -->
                        <div class="mt-5 pt-3.5 border-t border-slate-100 dark:border-dark-border flex items-center justify-between text-[11px] text-slate-400">
                            <span>Tahap 2: Notifikasi Tertulis</span>
                            <span class="font-bold text-teal-600 dark:text-teal-400">Sebelum Hari Ke-20</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sleek Legal Notice Strip (POJK No. 22 Tahun 2023) -->
            <?php if ( ! empty( $cfg['sla_note'] ) ) : ?>
            <div class="max-w-4xl mx-auto p-4 rounded-2xl bg-white/95 dark:bg-dark-card/95 border border-slate-200/80 dark:border-dark-border flex items-start gap-3 shadow-xs">
                <div class="w-6 h-6 rounded-lg bg-teal-100 dark:bg-teal-950 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0 text-xs mt-0.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.97zM6.75 4.97L4.13 15.696c-.121.499.107 1.028.59 1.202a5.988 5.988 0 002.031.352 5.988 5.988 0 002.031-.352c.483-.174.711-.703.589-1.202L6.75 4.97z"/></svg>
                </div>
                <div class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                    <strong class="text-slate-900 dark:text-white">Ketentuan Perpanjangan &amp; Penyelesaian Sengketa (POJK No. 22/2023 Pasal 55 &amp; 57):</strong>
                    <?php echo esc_html( $cfg['sla_note'] ); ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </section>
    <?php endif; ?>

    <!-- ========================================================================
         SECTION 6: PANDUAN KONSUMEN & PERSYARATAN DOKUMEN PENGADUAN
         (KONTROL AKTIF/NONAKTIF DARI ADMIN)
         ======================================================================== -->
    <?php if ( ! empty( $cfg['panduan_show'] ) ) : ?>
    <section class="py-14 md:py-20 bg-transparent relative">
        <div class="container-wide">
            
            <?php if ( ! empty( $cfg['show_form_pdf'] ) ) : ?>
                <!-- TAMPILAN JIKA FORMULIR CETAK FISIK DIAKTIFKAN OLEH ADMIN -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Left: Checklist Persyaratan Berkas -->
                    <div class="lg:col-span-7" data-aos="fade-up">
                        <span class="text-xs font-extrabold text-teal-600 dark:text-teal-400 uppercase tracking-widest block mb-2">
                            Panduan Konsumen
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mb-4">
                            Persyaratan Dokumen Pengaduan
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                            Agar pengaduan dapat segera diverifikasi dan diproses tanpa hambatan, mohon menyiapkan dokumen pendukung berikut saat menyampaikan aduan:
                        </p>

                        <div class="space-y-3.5">
                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-white/90 dark:bg-dark-card/90 border border-slate-200/80 dark:border-dark-border shadow-xs">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold text-xs">✓</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-900 dark:text-white block">Identitas Diri yang Sah</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Fotokopi/Scan KTP untuk WNI, atau Paspor/KITAS bagi Warga Negara Asing.</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-white/90 dark:bg-dark-card/90 border border-slate-200/80 dark:border-dark-border shadow-xs">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold text-xs">✓</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-900 dark:text-white block">Bukti Kepemilikan Rekening / Akad</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Buku tabungan, bilyet deposito, atau salinan akad perjanjian pembiayaan syariah.</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-white/90 dark:bg-dark-card/90 border border-slate-200/80 dark:border-dark-border shadow-xs">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold text-xs">✓</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-900 dark:text-white block">Bukti Transaksi Keuangan Terkait</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Struk transfer, mutasi rekening, bukti setoran, atau nota konfirmasi transaksi.</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-white/90 dark:bg-dark-card/90 border border-slate-200/80 dark:border-dark-border shadow-xs">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold text-xs">✓</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-900 dark:text-white block">Surat Kuasa Khusus (Jika Diwakilkan)</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Bermaterai cukup dan dilampiri identitas pemberi kuasa dan penerima kuasa.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Unduh Formulir PDF Card -->
                    <div class="lg:col-span-5" data-aos="fade-up" data-aos-delay="100">
                        <div class="spotlight-card group relative p-7 sm:p-8 rounded-3xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-teal-200/80 dark:border-teal-800/80 shadow-xl overflow-hidden text-center">
                            
                            <div class="absolute -right-12 -top-12 w-36 h-36 bg-teal-400/10 rounded-full blur-2xl pointer-events-none"></div>

                            <!-- PDF Icon -->
                            <div class="w-16 h-16 rounded-2xl bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 flex items-center justify-center mx-auto mb-4 border border-teal-200/60 dark:border-teal-800/60 shadow-sm group-hover:scale-105 transition-transform">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                            </div>

                            <span class="text-xs font-extrabold text-teal-700 dark:text-teal-300 uppercase tracking-wider block mb-1">
                                Formulir Cetak Fisik
                            </span>
                            <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white mb-2">
                                Formulir Pengaduan Nasabah
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed mb-6">
                                Unduh formulir resmi format PDF untuk dicetak dan diisi secara manual, lalu diserahkan ke kantor cabang terdekat atau dikirim via email.
                            </p>

                            <a 
                                href="<?php echo esc_url( $pdf_link ); ?>" 
                                <?php echo $has_pdf_file ? 'download target="_blank" rel="noopener noreferrer"' : 'target="_blank" rel="noopener noreferrer"'; ?>
                                class="inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-2xl bg-teal-600 hover:bg-teal-700 text-white text-xs sm:text-sm font-extrabold shadow-md shadow-teal-600/30 hover:-translate-y-0.5 transition-all w-full"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                <span><?php echo $has_pdf_file ? 'Unduh Berkas Formulir (PDF)' : 'Minta Formulir via WhatsApp'; ?></span>
                            </a>

                            <div class="mt-4 pt-4 border-t border-slate-100 dark:border-dark-border text-[11px] text-slate-400">
                                Format Berkas: PDF Resmi • Standar Perlindungan Konsumen
                            </div>
                        </div>
                    </div>

                </div>
            <?php else : ?>
                <!-- TAMPILAN PENUH LEBAR & INFORMATIF (KETIKA FORMULIR PDF DINONAKTIFKAN / BELUM TERSEDIA) -->
                <div data-aos="fade-up">
                    <div class="text-center max-w-3xl mx-auto mb-12">
                        <span class="text-xs font-extrabold text-teal-600 dark:text-teal-400 uppercase tracking-widest block mb-2">
                            Panduan Konsumen
                        </span>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white">
                            Persyaratan Dokumen &amp; Tips Pengaduan
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2">
                            Agar proses penanganan berjalan cepat, tepat, dan akurat, mohon melengkapi berkas pendukung berikut saat mengajukan pengaduan:
                        </p>
                    </div>

                    <!-- 4-Card Document Checklist Grid (Dual-Tone) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                        
                        <!-- Doc 1: Identitas -->
                        <div class="spotlight-card group rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border hover:border-emerald-400/90 dark:hover:border-emerald-500/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                            <div class="h-1.5 w-full bg-emerald-500"></div>
                            
                            <!-- Tone 1 Header -->
                            <div class="p-4 bg-emerald-50/70 dark:bg-emerald-950/40 border-b border-emerald-100/80 dark:border-emerald-900/40 flex items-center justify-between">
                                <span class="text-xs font-extrabold text-emerald-800 dark:text-emerald-300 uppercase tracking-wider">Dokumen 1</span>
                                <span class="text-[10px] font-black px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-900/70 dark:text-emerald-300">Wajib</span>
                            </div>

                            <!-- Tone 2 Body -->
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-2.5">
                                <div>
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100/80 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold mb-3">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.364a4.125 4.125 0 00-6.338 0"/></svg>
                                    </div>
                                    <h4 class="text-sm font-black text-slate-900 dark:text-white min-h-[40px] flex items-center">Identitas Diri yang Sah</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed min-h-[48px] flex items-center mt-1">
                                        Fotokopi / Scan KTP asli bagi WNI yang masih berlaku, atau Paspor &amp; KITAS sah bagi Warga Negara Asing (WNA).
                                    </p>
                                </div>
                                <div class="text-[11px] text-slate-400 pt-2 border-t border-slate-100 dark:border-dark-border">
                                    Verifikasi Kependudukan
                                </div>
                            </div>
                        </div>

                        <!-- Doc 2: Rekening / Bilyet -->
                        <div class="spotlight-card group rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border hover:border-teal-400/90 dark:hover:border-teal-500/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                            <div class="h-1.5 w-full bg-teal-500"></div>
                            
                            <!-- Tone 1 Header -->
                            <div class="p-4 bg-teal-50/70 dark:bg-teal-950/40 border-b border-teal-100/80 dark:border-teal-900/40 flex items-center justify-between">
                                <span class="text-xs font-extrabold text-teal-800 dark:text-teal-300 uppercase tracking-wider">Dokumen 2</span>
                                <span class="text-[10px] font-black px-2 py-0.5 rounded-full bg-teal-100 text-teal-800 dark:bg-teal-900/70 dark:text-teal-300">Wajib</span>
                            </div>

                            <!-- Tone 2 Body -->
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-2.5">
                                <div>
                                    <div class="w-10 h-10 rounded-xl bg-teal-100/80 dark:bg-teal-950 text-teal-600 dark:text-teal-400 flex items-center justify-center font-bold mb-3">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                                    </div>
                                    <h4 class="text-sm font-black text-slate-900 dark:text-white min-h-[40px] flex items-center">Buku Rekening / Akad</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed min-h-[48px] flex items-center mt-1">
                                        Buku tabungan, sertifikat bilyet deposito syariah, atau salinan akad perjanjian pembiayaan yang bersangkutan.
                                    </p>
                                </div>
                                <div class="text-[11px] text-slate-400 pt-2 border-t border-slate-100 dark:border-dark-border">
                                    Bukti Legalitas Kepemilikan
                                </div>
                            </div>
                        </div>

                        <!-- Doc 3: Bukti Transaksi -->
                        <div class="spotlight-card group rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border hover:border-blue-400/90 dark:hover:border-blue-500/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                            <div class="h-1.5 w-full bg-blue-500"></div>
                            
                            <!-- Tone 1 Header -->
                            <div class="p-4 bg-blue-50/70 dark:bg-blue-950/40 border-b border-blue-100/80 dark:border-blue-900/40 flex items-center justify-between">
                                <span class="text-xs font-extrabold text-blue-800 dark:text-blue-300 uppercase tracking-wider">Dokumen 3</span>
                                <span class="text-[10px] font-black px-2 py-0.5 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/70 dark:text-blue-300">Wajib</span>
                            </div>

                            <!-- Tone 2 Body -->
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-2.5">
                                <div>
                                    <div class="w-10 h-10 rounded-xl bg-blue-100/80 dark:bg-blue-950 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold mb-3">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5l-.9-1.2a1.5 1.5 0 00-2.4 0L12 21l-1.7-2.2a1.5 1.5 0 00-2.4 0L6 21l-.9-1.2A1.5 1.5 0 003.5 19H3V5a2 2 0 012-2h14a2 2 0 012 2v14h-.5a1.5 1.5 0 00-1.6.8L19 21z"/></svg>
                                    </div>
                                    <h4 class="text-sm font-black text-slate-900 dark:text-white min-h-[40px] flex items-center">Bukti Transaksi Terkait</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed min-h-[48px] flex items-center mt-1">
                                        Struk transfer ATM/kantor, bukti mutasi rekening, slip setoran, atau nota konfirmasi mutasi dana yang dipermasalahkan.
                                    </p>
                                </div>
                                <div class="text-[11px] text-slate-400 pt-2 border-t border-slate-100 dark:border-dark-border">
                                    Pemeriksaan Finansial
                                </div>
                            </div>
                        </div>

                        <!-- Doc 4: Surat Kuasa -->
                        <div class="spotlight-card group rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border hover:border-amber-400/90 dark:hover:border-amber-500/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                            <div class="h-1.5 w-full bg-amber-500"></div>
                            
                            <!-- Tone 1 Header -->
                            <div class="p-4 bg-amber-50/70 dark:bg-amber-950/40 border-b border-amber-100/80 dark:border-amber-900/40 flex items-center justify-between">
                                <span class="text-xs font-extrabold text-amber-800 dark:text-amber-300 uppercase tracking-wider">Dokumen 4</span>
                                <span class="text-[10px] font-black px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 dark:bg-amber-900/70 dark:text-amber-300">Kondisional</span>
                            </div>

                            <!-- Tone 2 Body -->
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-2.5">
                                <div>
                                    <div class="w-10 h-10 rounded-xl bg-amber-100/80 dark:bg-amber-950 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold mb-3">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                    </div>
                                    <h4 class="text-sm font-black text-slate-900 dark:text-white min-h-[40px] flex items-center">Surat Kuasa Khusus</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed min-h-[48px] flex items-center mt-1">
                                        Surat kuasa bermaterai cukup dan identitas pihak penerima kuasa, wajib disertakan jika pengaduan diwakilkan.
                                    </p>
                                </div>
                                <div class="text-[11px] text-slate-400 pt-2 border-t border-slate-100 dark:border-dark-border">
                                    Bila Diwakilkan Pihak Lain
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Informative Guidelines Strip: Tips Kelancaran Pengaduan -->
                    <div class="p-6 sm:p-7 rounded-3xl bg-slate-100/80 dark:bg-dark-surface-alt border border-slate-200/80 dark:border-dark-border">
                        <div class="flex items-center gap-2.5 mb-4">
                            <div class="w-8 h-8 rounded-xl bg-teal-100 dark:bg-teal-950 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.385a16.5 16.5 0 01-3 0M9.75 2.25a6.75 6.75 0 0111.25 5.25c0 2.5-1.5 4.5-3 5.5v1.5h-4.5v-1.5c-1.5-1-3-3-3-5.5a6.75 6.75 0 01-0.75-2.25z"/></svg>
                            </div>
                            <h4 class="text-sm sm:text-base font-black text-slate-900 dark:text-white">
                                Tips Menyampaikan Pengaduan Agar Cepat Tertangani
                            </h4>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs text-slate-600 dark:text-slate-300">
                            <div class="flex items-start gap-2.5">
                                <span class="text-teal-600 dark:text-teal-400 font-bold">1.</span>
                                <span><strong>Rincikan Kronologis:</strong> Sertakan tanggal transaksi, jam perkiraan, nominal angka, dan pihak yang terlibat secara jelas.</span>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <span class="text-teal-600 dark:text-teal-400 font-bold">2.</span>
                                <span><strong>Simpan Bukti Asli:</strong> Simpan struk cetak ATM, tangkapan layar (screenshot), atau nota resmi sampai proses pengaduan tuntas.</span>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <span class="text-teal-600 dark:text-teal-400 font-bold">3.</span>
                                <span><strong>Gunakan Saluran Resmi:</strong> Pastikan hanya berkomunikasi melalui nomor WhatsApp dan saluran terdaftar di website resmi Bank Syariah Wakalumi.</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
    <?php endif; ?>

    <!-- ========================================================================
         LIGHTBOX MODAL FOR IMAGES (PURE JS / ACCESSIBLE / RESPONSIVE)
         ======================================================================== -->
    <div id="wkl-lightbox-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-md p-4 transition-all duration-300" onclick="closeZoomModal(event)">
        <div class="relative max-w-5xl max-h-[90vh] w-full bg-white dark:bg-dark-card rounded-3xl overflow-hidden shadow-2xl flex flex-col border border-white/20" onclick="event.stopPropagation()">
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
            <div class="flex-1 overflow-auto p-3 sm:p-5 flex items-center justify-center bg-slate-950/5 dark:bg-black/30">
                <img id="wkl-lightbox-img" src="" alt="" class="max-w-full max-h-[75vh] object-contain rounded-xl shadow-md">
            </div>
        </div>
    </div>

</main>

<script>
function openZoomModal(imgUrl, title, caption) {
    var modal = document.getElementById('wkl-lightbox-modal');
    var modalImg = document.getElementById('wkl-lightbox-img');
    var modalTitle = document.getElementById('wkl-lightbox-title');
    var modalCaption = document.getElementById('wkl-lightbox-caption');

    if (!modal || !modalImg) return;

    modalImg.src = imgUrl;
    modalTitle.textContent = title || 'Panduan Pengaduan Konsumen';
    modalCaption.textContent = caption || '';
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeZoomModal(event) {
    if (event) event.stopPropagation();
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

<?php get_footer(); ?>
