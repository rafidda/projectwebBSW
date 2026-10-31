<?php
/**
 * Template Name: Halaman Tim Kami & Direktori Karyawan
 * Description: Direktori Resmi Insan Bank Syariah Wakalumi (BSW) dengan Tampilan PNG ID Card (Rasio 1 : 1.56) & Verifikasi Karyawan Aktif
 * 
 * @package Wakalumi
 */

get_header();

// ── DATA RETRIEVAL ──────────────────────────────────────────────────
$header        = wakalumi_get_tim_header();
$divisions     = wakalumi_get_tim_divisions();
$all_employees = wakalumi_get_tim_list();
$cta           = wakalumi_get_tim_cta();

// Pastikan divisi terurut rapi
uasort( $divisions, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );

// Filter hanya karyawan berstatus aktif untuk tampilan utama publik
$tim_list = array_values( array_filter( $all_employees, function( $item ) {
    return ( $item['status'] ?? 'aktif' ) === 'aktif';
}) );

$total_active_emp = count( $tim_list );

// Hitung jumlah karyawan aktif per divisi & kelompokkan personel per divisi
$division_counts  = [];
$employees_by_div = [];
foreach ( $tim_list as $emp ) {
    $d = $emp['divisi'] ?? 'operasional';
    $division_counts[ $d ] = ( $division_counts[ $d ] ?? 0 ) + 1;
    if ( ! isset( $employees_by_div[ $d ] ) ) {
        $employees_by_div[ $d ] = [];
    }
    $employees_by_div[ $d ][] = $emp;
}

$wa_number  = get_option( 'options_contact_wa', '6281517380388' );
$wa_url     = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );
$notice_wa  = ! empty( $header['notice_wa'] ) ? 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $header['notice_wa'] ) : $wa_url;
?>

<style>
/* Anti-ghosting guarantee for ID cards under dynamic filters */
.tim-employee-card {
    opacity: 1 !important;
    transform: none !important;
}
</style>
<div class="min-h-screen bg-transparent text-slate-800 dark:text-slate-200 pb-24">

    <!-- ========================================================================
         SECTION 1: HERO HEADER BANNER & ANTI-FRAUD VERIFICATION NOTICE
         ======================================================================== -->
    <section class="wkl-page-hero relative z-10 overflow-hidden shadow-xs">
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
                <span class="text-teal-600 dark:text-teal-400 font-semibold">Tim Kami</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Left Column: Title & Intro -->
                <div class="lg:col-span-7 xl:col-span-7" data-aos="fade-up">
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

                    <!-- Trust Highlights Pills -->
                    <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span><?php echo $total_active_emp; ?> Personel Aktif Bertugas</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                            <span>Terverifikasi Anti-Fraud</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                            <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                            <span>Budaya Amanah &amp; ISHLAH</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Dual-Tone Executive Trust Card with Slide Watermark -->
                <div class="lg:col-span-5 xl:col-span-5" data-aos="fade-left" data-aos-delay="100">
                    <div class="spotlight-card relative overflow-hidden rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] text-center group cursor-default">
                        <div class="wkl-glass-shine"></div>

                        <!-- Top Dual-Tone Zone: Header, Icon & Title -->
                        <div class="relative px-6 pt-7 pb-5 bg-gradient-to-b from-emerald-50/85 via-teal-50/40 to-white dark:from-emerald-950/45 dark:via-slate-900/80 dark:to-slate-900 border-b border-slate-100 dark:border-slate-800/80 overflow-hidden">
                            <!-- Subtle Top Accent Line -->
                            <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-emerald-500 via-teal-400 to-cyan-500 opacity-90"></div>

                            <!-- Interactive Slide Watermark Emblem -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-32 h-32 opacity-[0.04] dark:opacity-[0.03] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-110 group-hover:opacity-[0.07] dark:group-hover:opacity-[0.05] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                            </div>

                            <!-- Soft Dual-Tone Ring Verification Shield Icon -->
                            <div class="relative w-14 h-14 rounded-2xl bg-white dark:bg-slate-800 border border-emerald-200/80 dark:border-emerald-800/70 text-emerald-600 dark:text-emerald-300 flex items-center justify-center mx-auto mb-3.5 shadow-sm group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-600 group-hover:scale-105 transition-all duration-500 z-10">
                                <svg class="w-7 h-7 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                            </div>

                            <div class="relative z-10">
                                <?php 
                                $clean_notice_badge = trim( preg_replace( '/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F900}-\x{1F9FF}\x{1F1E0}-\x{1F1FF}]/u', '', $header['notice_badge'] ?? '' ) );
                                if ( empty( $clean_notice_badge ) ) {
                                    $clean_notice_badge = 'Verifikasi Resmi Personel';
                                }
                                ?>
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/90 dark:bg-slate-800 text-emerald-700 dark:text-emerald-300 border border-emerald-200/70 dark:border-emerald-800/60 text-[10px] font-bold uppercase tracking-wider mb-1.5 shadow-2xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <?php echo esc_html( $clean_notice_badge ); ?>
                                </div>
                                <h4 class="text-lg font-extrabold text-slate-900 dark:text-white"><?php echo esc_html( $header['notice_title'] ); ?></h4>
                            </div>
                        </div>

                        <!-- Bottom Dual-Tone Zone: Description, Reg Tags & Button -->
                        <div class="p-5 sm:px-6 bg-white dark:bg-slate-900/95 space-y-4 relative z-10">
                            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed text-center sm:text-left">
                                <?php echo esc_html( $header['notice_desc'] ); ?>
                            </p>

                            <div class="pt-1 flex items-center justify-center gap-2">
                                <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    Terdaftar &amp; Diawasi OJK
                                </span>
                                <span class="text-slate-300 dark:text-slate-600">•</span>
                                <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    Sistem Anti-Fraud
                                </span>
                            </div>

                            <div class="pt-1">
                                <a href="<?php echo esc_url( $notice_wa . '?text=' . rawurlencode( 'Assalamu\'alaikum CS Bank Syariah Wakalumi, saya ingin konfirmasi verifikasi keabsahan identitas personel...' ) ); ?>" target="_blank" rel="noopener noreferrer" class="w-full py-2.5 px-4 rounded-xl bg-slate-50 hover:bg-emerald-50/80 dark:bg-slate-800/80 dark:hover:bg-emerald-950/50 border border-slate-200/80 hover:border-emerald-300 dark:border-slate-700/80 dark:hover:border-emerald-700 inline-flex items-center justify-center gap-2 text-xs font-bold text-emerald-700 dark:text-emerald-300 transition-all duration-300 group/timbtn">
                                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    <span>Konfirmasi Validasi via WhatsApp</span>
                                    <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/timbtn:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 2: LIVE FILTERING & INSTANT SEARCH TOOLBAR
         ======================================================================== -->
    <section class="relative z-20 -mt-6 sm:-mt-7 mb-10">
        <div class="container-wide">
            <div class="bg-white/95 dark:bg-dark-card/95 backdrop-blur-2xl rounded-2xl sm:rounded-3xl p-4 sm:p-5 border border-slate-200/90 dark:border-dark-border shadow-xl">
                
                <!-- Sub-Bar Atas: Label Filter + Kolom Pencarian + Counter -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 pb-3 mb-3 border-b border-slate-100 dark:border-slate-800/80">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        </span>
                        <span class="text-xs sm:text-sm font-bold text-slate-800 dark:text-slate-200">
                            Filter Berdasarkan Divisi
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <!-- Instant Search Bar -->
                        <div class="relative flex-1 sm:w-72">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                            </span>
                            <input type="text" 
                                   id="tim-search-input" 
                                   placeholder="Cari nama, NIP, jabatan..." 
                                   class="w-full pl-10 pr-9 py-2 rounded-xl text-xs sm:text-sm bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all">
                            <button type="button" 
                                    id="tim-search-clear" 
                                    class="hidden absolute inset-y-0 right-0 items-center pr-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                                ✕
                            </button>
                        </div>

                        <!-- Live Counter Badge -->
                        <div class="hidden sm:inline-flex items-center text-xs font-medium text-slate-500 dark:text-slate-400 whitespace-nowrap bg-slate-100 dark:bg-slate-800/80 px-3 py-2 rounded-xl border border-slate-200/60 dark:border-slate-700/60">
                            Menampilkan: <strong class="ml-1 text-teal-600 dark:text-teal-400 font-extrabold" id="tim-visible-count"><?php echo $total_active_emp; ?></strong>&nbsp;<span id="tim-visible-unit">personel</span>
                        </div>
                    </div>
                </div>

                <!-- Division Tabs Slider Container with Left & Right Navigation Arrows (Desktop Only) -->
                <div class="relative hidden lg:flex items-center gap-2">
                    
                    <!-- Left Arrow Button -->
                    <button type="button" 
                            id="tim-tabs-prev" 
                            aria-label="Geser ke kiri"
                            title="Geser opsi divisi ke kiri"
                            class="flex-shrink-0 w-8 sm:w-9 h-8 sm:h-9 rounded-xl flex items-center justify-center bg-slate-100 hover:bg-teal-600 text-slate-600 hover:text-white dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-teal-600 dark:hover:text-white border border-slate-200 dark:border-slate-700 transition-all duration-200 shadow-xs disabled:opacity-30 disabled:cursor-not-allowed hover:scale-105 active:scale-95 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </button>

                    <!-- Scrollable Tabs Container -->
                    <div class="flex-1 overflow-x-auto scroll-smooth py-1 px-0.5 scrollbar-none flex items-center gap-2 select-none" 
                         id="tim-division-tabs"
                         style="scroll-behavior: smooth; -webkit-overflow-scrolling: touch;">
                        
                        <button type="button" 
                                data-division="all" 
                                class="tim-tab-btn active px-4 py-2 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap transition-all duration-300 bg-teal-600 text-white shadow-sm ring-2 ring-teal-500/50 flex-shrink-0">
                            Semua Divisi
                            <span class="ml-1.5 px-2 py-0.5 rounded-full text-[10px] bg-white/20 text-white font-extrabold">
                                <?php echo $total_active_emp; ?>
                            </span>
                        </button>

                        <?php foreach ( $divisions as $div_key => $div_info ) : 
                            $div_count = $division_counts[ $div_key ] ?? 0;
                            if ( $div_count === 0 ) continue; // Hanya tampilkan divisi yang memiliki karyawan aktif
                            $div_tab_badge_cls = function_exists( 'wakalumi_get_division_badge_class' ) 
                                ? wakalumi_get_division_badge_class( $div_key, $div_info ) 
                                : '';
                        ?>
                            <button type="button" 
                                    data-division="<?php echo esc_attr( $div_key ); ?>" 
                                    data-badge-class="<?php echo esc_attr( $div_tab_badge_cls ); ?>"
                                    class="tim-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap transition-all duration-300 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-teal-50 hover:text-teal-700 dark:hover:bg-slate-700 flex-shrink-0">
                                <?php echo esc_html( $div_info['name'] ); ?>
                                <span class="ml-1.5 px-2 py-0.5 rounded-full text-[10px] bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 font-extrabold">
                                    <?php echo $div_count; ?>
                                </span>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <!-- Right Arrow Button -->
                    <button type="button" 
                            id="tim-tabs-next" 
                            aria-label="Geser ke kanan"
                            title="Geser opsi divisi ke kanan"
                            class="flex-shrink-0 w-8 sm:w-9 h-8 sm:h-9 rounded-xl flex items-center justify-center bg-slate-100 hover:bg-teal-600 text-slate-600 hover:text-white dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-teal-600 dark:hover:text-white border border-slate-200 dark:border-slate-700 transition-all duration-200 shadow-xs disabled:opacity-30 disabled:cursor-not-allowed hover:scale-105 active:scale-95 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>

                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 3: DIRECTORY GRID — PNG ID CARD DISPLAY (ASPECT RATIO 1 : 1.56)
         ======================================================================== -->
    <section class="relative z-10 py-6">
        <div class="container-wide">

            <!-- ============================================================
                 MOBILE STICKY TRIGGER BAR (Opens Bottom Sheet Drawer)
                 (Matches Baitul Maal & Layanan Kami Mobile Architecture)
                 ============================================================ -->
            <div class="lg:hidden sticky top-16 z-30 mb-6 -mx-4 px-4 transition-all" id="wkl-tim-sticky-wrapper">
                <div class="bg-white/95 dark:bg-dark-card/95 backdrop-blur-md rounded-2xl border border-teal-500/35 dark:border-teal-500/25 shadow-lg shadow-teal-500/10 overflow-hidden transition-all">
                    
                    <!-- Trigger Button -->
                    <button type="button" 
                            id="wkl-tim-drawer-trigger" 
                            onclick="wklOpenTimDrawer()" 
                            class="w-full flex items-center justify-between p-2.5 sm:p-3 text-left active:scale-[0.99] transition-all group cursor-pointer">
                        <div class="flex items-center gap-3 min-w-0">
                            <!-- Active Icon Box -->
                            <div id="wkl-tim-active-icon-box" class="w-10 h-10 rounded-xl bg-teal-600 text-white flex items-center justify-center shrink-0 shadow-xs">
                                <span id="wkl-tim-active-icon">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                                </span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-1.5 mb-0.5">
                                    <span class="text-[10px] font-black uppercase tracking-wider text-teal-600 dark:text-teal-400">Divisi Terpilih</span>
                                    <span id="wkl-tim-active-badge" class="text-[9px] px-1.5 py-0.2 rounded-full font-bold bg-teal-100 text-teal-800 dark:bg-teal-950/80 dark:text-teal-300 border border-teal-300">
                                        <?php echo $total_active_emp; ?> Personel
                                    </span>
                                </div>
                                <h4 id="wkl-tim-active-title" class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white truncate">
                                    Semua Divisi
                                </h4>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2 shrink-0 pl-2">
                            <span class="text-[11px] font-bold text-slate-400 dark:text-slate-500" id="wkl-tim-active-counter">
                                1 / <?php echo count( $divisions ) + 1; ?>
                            </span>
                            <div class="px-2.5 py-1.5 rounded-xl bg-teal-50 dark:bg-teal-950/70 border border-teal-200/60 dark:border-teal-800/60 text-teal-700 dark:text-teal-300 text-xs font-bold flex items-center gap-1.5 group-hover:bg-teal-100 dark:group-hover:bg-teal-900/50 transition-all">
                                <span>Pilih</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                                </svg>
                            </div>
                        </div>
                    </button>
                </div>
            </div>

            <!-- EMPLOYEE ID CARD DIRECTORY CONTAINER (SEGMENTED BY DIVISION) -->
            <div id="tim-card-container" class="space-y-12 sm:space-y-16">
                <?php 
                $rendered_emp_ids = [];
                $global_card_idx  = 0;

                // Loop setiap divisi dari wp_options (hierarki urutan dinamis dari admin)
                foreach ( $divisions as $div_key => $div_info ) : 
                    $div_employees = $employees_by_div[ $div_key ] ?? [];
                    if ( empty( $div_employees ) ) continue; // Hanya tampilkan divisi yang memiliki personel aktif

                    $div_name     = $div_info['name'] ?? ucfirst( $div_key );
                    $div_icon     = function_exists( 'wakalumi_get_division_icon_svg' ) 
                        ? wakalumi_get_division_icon_svg( $div_key, $div_info['icon'] ?? '' ) 
                        : '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>';
                    $is_executive = in_array( $div_key, [ 'dps', 'komisaris', 'manajemen' ], true );
                    $is_exec      = $is_executive;
                    $badge_class  = function_exists( 'wakalumi_get_division_badge_class' ) 
                        ? wakalumi_get_division_badge_class( $div_key, $div_info ) 
                        : ( $div_info['badge_class'] ?? 'bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 border-teal-200 dark:border-teal-800/70' );
                ?>
                    <!-- DIVISI SEGMENT: <?php echo esc_html( $div_name ); ?> -->
                    <div class="tim-division-segment scroll-mt-32 lg:scroll-mt-24" 
                         data-division-slug="<?php echo esc_attr( $div_key ); ?>" 
                         id="divisi-<?php echo esc_attr( $div_key ); ?>">

                        <!-- Division Header Separator Bar (Centered Count on Mobile, Left-Right on Desktop) -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 mb-6 sm:mb-8 pb-3.5 border-b border-slate-200/90 dark:border-dark-border/90">
                            <div class="flex items-center gap-3 sm:gap-3.5 min-w-0">
                                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl flex items-center justify-center font-black text-sm shadow-xs border shrink-0 <?php echo esc_attr( $badge_class ); ?>">
                                    <?php echo $div_icon; ?>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2 sm:gap-2.5 flex-wrap">
                                        <h3 class="text-base sm:text-xl lg:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                                            <?php echo esc_html( $div_name ); ?>
                                        </h3>
                                        <?php if ( $is_executive ) : ?>
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-2xs shrink-0">
                                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                                Jajaran Eksekutif
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 truncate sm:overflow-visible sm:whitespace-normal">
                                        <?php echo $is_exec ? 'Bank Syariah Wakalumi &bull; Jajaran Pengurus &amp; Manajemen' : 'Bank Syariah Wakalumi &bull; Direktori Insan Bank'; ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Member Count Badge (Centered on Mobile, Right-Aligned on Desktop) -->
                            <div class="flex items-center justify-center sm:justify-end w-full sm:w-auto pt-1 sm:pt-0">
                                <span class="inline-flex items-center justify-center gap-1.5 px-3.5 py-1.5 rounded-full sm:rounded-xl text-xs font-bold bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border text-teal-700 dark:text-teal-300 shadow-2xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500 shrink-0 sm:hidden"></span>
                                    <strong class="font-black text-teal-600 dark:text-teal-400"><?php echo count( $div_employees ); ?></strong>
                                    <span>Personel</span>
                                </span>
                            </div>
                        </div>

                        <!-- ID Cards Sub-Grid: 2 kolom (mobile) / 3 kolom (tablet) / 4 kolom (desktop) -->
                        <div class="tim-subgrid grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                            <?php 
                            foreach ( $div_employees as $emp ) : 
                                $global_card_idx++;
                                $emp_id       = esc_attr( $emp['id'] ?? ( 'emp_' . $global_card_idx ) );
                                $rendered_emp_ids[] = $emp_id;
                    $emp_nama     = esc_attr( $emp['nama'] ?? '' );
                    $emp_divisi   = esc_attr( $emp['divisi'] ?? 'operasional' );
                    $emp_div_lbl  = esc_attr( $emp['divisi_label'] ?? '' );
                    if ( empty( $emp_div_lbl ) && isset( $divisions[ $emp_divisi ] ) ) {
                        $emp_div_lbl = $divisions[ $emp_divisi ]['name'];
                    }
                    $emp_jabatan  = esc_attr( $emp['jabatan'] ?? '' );
                    $emp_nip      = esc_attr( $emp['nip'] ?? '' );
                    $emp_img      = esc_url( $emp['idcard_image'] ?? '' );
                    $emp_tingkat  = esc_attr( $emp['tingkat'] ?? ( ! empty( $emp['is_kadiv'] ) ? ( in_array( $emp_divisi, ['dps','komisaris','manajemen'] ) ? 'eksekutif' : 'pe' ) : 'staff' ) );
                    $emp_short_tag = esc_attr( $emp['short_tag'] ?? '' );
                    if ( empty( $emp_short_tag ) ) {
                        if ( $emp_tingkat === 'eksekutif' ) {
                            if ( $emp_divisi === 'dps' ) $emp_short_tag = 'DPS';
                            elseif ( $emp_divisi === 'komisaris' ) $emp_short_tag = 'KOM';
                            elseif ( $emp_divisi === 'manajemen' ) $emp_short_tag = 'DIR';
                            else $emp_short_tag = 'EKS';
                        } elseif ( $emp_tingkat === 'pe' ) {
                            $emp_short_tag = 'PE';
                        }
                    }
                    $emp_quote    = esc_attr( $emp['quote'] ?? '' );
                    $emp_status   = esc_attr( $emp['status'] ?? 'aktif' );
                    $placeholder  = wakalumi_generate_idcard_placeholder( $emp_nama, $emp_jabatan, $emp_div_lbl, $emp_nip, $emp_tingkat, $emp_short_tag );
                    $card_image   = ! empty( $emp_img ) ? $emp_img : $placeholder;

                    // Search keywords for live filtering
                    $search_keywords = strtolower( $emp_nama . ' ' . $emp_nip . ' ' . $emp_jabatan . ' ' . $emp_div_lbl . ' ' . $emp_divisi );

                    // Styling based on 3 tiers (Refined slim 1.5px outlines with distinct gradients):
                    // 1. Eksekutif: 3-color gradient (emerald, teal, cyan) - slim 1.5px with elegant glow
                    // 2. Kepala Divisi / PE: 2-color gradient (teal, emerald) - matching slim 1.5px
                    // 3. Staff: soft subtle teal tint by default, rich tosca glow on hover (not dull grey)
                    if ( $emp_tingkat === 'eksekutif' ) {
                        $card_wrapper_class = 'p-[1.5px] bg-gradient-to-br from-emerald-400 via-teal-400 to-cyan-400 shadow-md shadow-teal-500/15 hover:shadow-xl hover:shadow-cyan-400/25';
                        $subtitle_color     = 'text-teal-700 dark:text-teal-300 font-bold';
                    } elseif ( $emp_tingkat === 'pe' ) {
                        $card_wrapper_class = 'p-[1.5px] bg-gradient-to-br from-teal-600 to-emerald-400 shadow-sm shadow-teal-700/15 hover:shadow-lg hover:shadow-teal-500/25';
                        $subtitle_color     = 'text-teal-600 dark:text-teal-400 font-semibold';
                    } else {
                        $card_wrapper_class = 'p-[1.5px] bg-gradient-to-br from-teal-200/60 via-slate-200/70 to-emerald-100/50 dark:from-teal-900/40 dark:via-dark-border dark:to-teal-950/40 group-hover:from-teal-500 group-hover:to-emerald-500 shadow-xs hover:shadow-xl hover:shadow-teal-500/20';
                        $subtitle_color     = 'text-slate-500 dark:text-slate-400 font-medium';
                    }
                ?>
                    <div class="tim-employee-card group flex flex-col"
                         data-division="<?php echo $emp_divisi; ?>"
                         data-keywords="<?php echo esc_attr( $search_keywords ); ?>">

                        <!-- ID Card Container with 1 : 1.56 Aspect Ratio & Glass Shine -->
                        <div class="relative w-full rounded-2xl sm:rounded-3xl transition-all duration-500 cursor-pointer transform group-hover:-translate-y-2 select-none <?php echo $card_wrapper_class; ?>"
                             style="aspect-ratio: 1 / 1.56;"
                             data-modal-open="idcard-zoom-modal"
                             data-emp-name="<?php echo $emp_nama; ?>"
                             data-emp-nip="<?php echo $emp_nip; ?>"
                             data-emp-divisi="<?php echo $emp_div_lbl; ?>"
                             data-emp-jabatan="<?php echo $emp_jabatan; ?>"
                             data-emp-tingkat="<?php echo $emp_tingkat; ?>"
                             data-emp-tag="<?php echo $emp_short_tag; ?>"
                             data-emp-quote="<?php echo $emp_quote; ?>"
                             data-emp-img="<?php echo esc_url( $card_image ); ?>">

                            <!-- Inner Frame -->
                            <div class="relative w-full h-full rounded-[14px] sm:rounded-[22px] overflow-hidden bg-white dark:bg-dark-card flex flex-col">

                                <!-- Top Gradient Shimmer -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 pointer-events-none"></div>

                                <!-- Glass Glare Sweep -->
                                <div class="wkl-glass-shine"></div>

                                <!-- The ID Card Image (User's PNG or Generated SVG) -->
                                <img src="<?php echo esc_url( $card_image ); ?>" 
                                     alt="<?php echo esc_attr( 'ID Card ' . $emp_nama ); ?>" 
                                     class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-[1.02]"
                                     loading="lazy">

                                <?php if ( empty( $emp_img ) ) : ?>
                                    <!-- Minimalist Centered Logo with Subtle Opacity & Gentle Hover -->
                                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-[5]">
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled3.png' ); ?>" 
                                             alt="" 
                                             class="w-14 h-14 sm:w-16 sm:h-16 object-contain opacity-[0.22] group-hover:opacity-[0.38] group-hover:scale-110 transition-all duration-500 ease-out">
                                    </div>
                                <?php endif; ?>

                                <!-- Floating Badges Top Right: Tingkat Jabatan & Status -->
                                <div class="absolute top-2.5 sm:top-3 right-2.5 sm:right-3 z-10 pointer-events-none flex items-center gap-1.5">
                                    <?php if ( $emp_tingkat === 'eksekutif' ) : ?>
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-black tracking-widest bg-slate-950/85 text-cyan-300 border border-cyan-400/40 shadow-md backdrop-blur-md">
                                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                                            <?php echo esc_html( $emp_short_tag ); ?>
                                        </span>
                                    <?php elseif ( $emp_tingkat === 'pe' ) : ?>
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-black tracking-wider bg-slate-900/85 text-teal-300 border border-teal-500/40 shadow-sm backdrop-blur-md">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-400 animate-pulse"></span>
                                            PE
                                        </span>
                                    <?php else : ?>
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-md text-[9px] font-bold bg-slate-900/75 text-emerald-300 border border-white/20 shadow-xs backdrop-blur-md">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                            Aktif
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Floating Badge: Divisi (Top Left) -->
                                <div class="absolute top-2.5 sm:top-3 left-2.5 sm:left-3 z-10 pointer-events-none max-w-[65%]">
                                    <span class="inline-block truncate px-2 py-0.5 rounded-md text-[9px] sm:text-[10px] font-bold bg-slate-900/75 text-white/90 backdrop-blur-md border border-white/20">
                                        <?php echo esc_html( $emp_div_lbl ); ?>
                                    </span>
                                </div>

                                <!-- Hover Overlay Action Hint (Bottom) -->
                                <div class="absolute bottom-3 left-3 right-3 z-20 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 flex items-center justify-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-teal-600/95 text-white text-[11px] sm:text-xs font-bold shadow-lg backdrop-blur-md">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/></svg>
                                        Perbesar ID Card
                                    </span>
                                </div>

                            </div>
                        </div>

                        <!-- Minimalist Typography Under ID Card -->
                        <div class="mt-2.5 text-center px-1">
                            <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white leading-tight truncate group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                                <?php echo esc_html( $emp_nama ); ?>
                            </h4>
                            <?php if ( ! empty( $emp_jabatan ) ) : ?>
                                <p class="text-[11px] <?php echo $subtitle_color; ?> truncate mt-0.5">
                                    <?php echo esc_html( $emp_jabatan ); ?>
                                </p>
                            <?php endif; ?>
                            <?php if ( ! empty( $emp_nip ) ) : ?>
                                <p class="text-[10px] text-slate-400 dark:text-slate-500 font-mono tracking-wider truncate mt-0.5">
                                    <?php echo esc_html( $emp_nip ); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                    </div>
                            <?php endforeach; ?>
                        </div><!-- /.tim-subgrid -->

                    </div><!-- /.tim-division-segment -->
                <?php endforeach; ?>

                <?php 
                // Fallback: Jika ada personel aktif yang divisinya belum terdaftar dalam $divisions
                $orphan_employees = array_filter( $tim_list, function( $item ) use ( $rendered_emp_ids ) {
                    $id = $item['id'] ?? '';
                    return ! in_array( $id, $rendered_emp_ids, true );
                });

                if ( ! empty( $orphan_employees ) ) : 
                ?>
                    <!-- DIVISI SEGMENT: LAINNYA -->
                    <div class="tim-division-segment" 
                         data-division-slug="lainnya" 
                         id="divisi-lainnya">

                        <!-- Division Header Separator Bar (Centered Count on Mobile, Left-Right on Desktop) -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 mb-6 sm:mb-8 pb-3.5 border-b border-slate-200/90 dark:border-dark-border/90">
                            <div class="flex items-center gap-3 sm:gap-3.5 min-w-0">
                                <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl flex items-center justify-center font-black text-sm shadow-xs border shrink-0 bg-teal-100 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border-teal-300/60 dark:border-teal-800/60">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-base sm:text-xl lg:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                                        Divisi / Bagian Lainnya
                                    </h3>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 truncate sm:overflow-visible sm:whitespace-normal">
                                        <?php echo $is_exec ? 'Bank Syariah Wakalumi &bull; Jajaran Pengurus &amp; Manajemen' : 'Bank Syariah Wakalumi &bull; Direktori Insan Bank'; ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Member Count Badge (Centered on Mobile, Right-Aligned on Desktop) -->
                            <div class="flex items-center justify-center sm:justify-end w-full sm:w-auto pt-1 sm:pt-0">
                                <span class="inline-flex items-center justify-center gap-1.5 px-3.5 py-1.5 rounded-full sm:rounded-xl text-xs font-bold bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border text-teal-700 dark:text-teal-300 shadow-2xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500 shrink-0 sm:hidden"></span>
                                    <strong class="font-black text-teal-600 dark:text-teal-400"><?php echo count( $orphan_employees ); ?></strong>
                                    <span>Personel</span>
                                </span>
                            </div>
                        </div>

                        <!-- ID Cards Sub-Grid -->
                        <div class="tim-subgrid grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                            <?php 
                            foreach ( $orphan_employees as $emp ) : 
                                $global_card_idx++;
                                $emp_id       = esc_attr( $emp['id'] ?? ( 'emp_' . $global_card_idx ) );
                                $emp_nama     = esc_attr( $emp['nama'] ?? '' );
                                $emp_divisi   = esc_attr( $emp['divisi'] ?? 'operasional' );
                                $emp_div_lbl  = esc_attr( $emp['divisi_label'] ?? 'Umum' );
                                $emp_jabatan  = esc_attr( $emp['jabatan'] ?? '' );
                                $emp_nip      = esc_attr( $emp['nip'] ?? '' );
                                $emp_img      = esc_url( $emp['idcard_image'] ?? '' );
                                $emp_tingkat  = esc_attr( $emp['tingkat'] ?? 'staff' );
                                $emp_short_tag = esc_attr( $emp['short_tag'] ?? 'STF' );
                                $emp_quote    = esc_attr( $emp['quote'] ?? '' );
                                $emp_status   = esc_attr( $emp['status'] ?? 'aktif' );
                                $placeholder  = wakalumi_generate_idcard_placeholder( $emp_nama, $emp_jabatan, $emp_div_lbl, $emp_nip, $emp_tingkat, $emp_short_tag );
                                $card_image   = ! empty( $emp_img ) ? $emp_img : $placeholder;
                                $search_keywords = strtolower( $emp_nama . ' ' . $emp_nip . ' ' . $emp_jabatan . ' ' . $emp_div_lbl . ' ' . $emp_divisi );
                                $card_wrapper_class = 'p-[1.5px] bg-gradient-to-br from-teal-200/60 via-slate-200/70 to-emerald-100/50 dark:from-teal-900/40 dark:via-dark-border dark:to-teal-950/40 group-hover:from-teal-500 group-hover:to-emerald-500 shadow-xs hover:shadow-xl hover:shadow-teal-500/20';
                                $subtitle_color     = 'text-slate-500 dark:text-slate-400 font-medium';
                            ?>
                                <div class="tim-employee-card group flex flex-col"
                                     data-division="<?php echo $emp_divisi; ?>"
                                     data-keywords="<?php echo esc_attr( $search_keywords ); ?>">

                                    <div class="relative w-full rounded-2xl sm:rounded-3xl transition-all duration-500 cursor-pointer transform group-hover:-translate-y-1.5 select-none <?php echo $card_wrapper_class; ?>"
                                         style="aspect-ratio: 1 / 1.56;"
                                         data-modal-open="idcard-zoom-modal"
                                         data-emp-name="<?php echo $emp_nama; ?>"
                                         data-emp-nip="<?php echo $emp_nip; ?>"
                                         data-emp-divisi="<?php echo $emp_div_lbl; ?>"
                                         data-emp-jabatan="<?php echo $emp_jabatan; ?>"
                                         data-emp-tingkat="<?php echo $emp_tingkat; ?>"
                                         data-emp-tag="<?php echo $emp_short_tag; ?>"
                                         data-emp-quote="<?php echo $emp_quote; ?>"
                                         data-emp-img="<?php echo esc_url( $card_image ); ?>">

                                        <div class="relative w-full h-full rounded-[14px] sm:rounded-[22px] overflow-hidden bg-white dark:bg-dark-card flex flex-col">
                                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 pointer-events-none"></div>
                                            <div class="wkl-glass-shine"></div>
                                            <img src="<?php echo esc_url( $card_image ); ?>" 
                                                 alt="<?php echo esc_attr( 'ID Card ' . $emp_nama ); ?>" 
                                                 class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-[1.02]"
                                                 loading="lazy">
                                            <?php if ( empty( $emp_img ) ) : ?>
                                                <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-[5]">
                                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled3.png' ); ?>" 
                                                         alt="" 
                                                         class="w-14 h-14 sm:w-16 sm:h-16 object-contain opacity-[0.22] group-hover:opacity-[0.38] group-hover:scale-110 transition-all duration-500 ease-out">
                                                </div>
                                            <?php endif; ?>
                                            <div class="absolute top-2.5 sm:top-3 right-2.5 sm:right-3 z-10 pointer-events-none flex items-center gap-1.5">
                                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-md text-[9px] font-bold bg-slate-900/75 text-emerald-300 border border-white/20 shadow-xs backdrop-blur-md">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                                    Aktif
                                                </span>
                                            </div>
                                            <div class="absolute top-2.5 sm:top-3 left-2.5 sm:left-3 z-10 pointer-events-none max-w-[65%]">
                                                <span class="inline-block truncate px-2 py-0.5 rounded-md text-[9px] sm:text-[10px] font-bold bg-slate-900/75 text-white/90 backdrop-blur-md border border-white/20">
                                                    <?php echo esc_html( $emp_div_lbl ); ?>
                                                </span>
                                            </div>
                                            <div class="absolute bottom-3 left-3 right-3 z-20 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 flex items-center justify-center">
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-teal-600/95 text-white text-[11px] sm:text-xs font-bold shadow-lg backdrop-blur-md">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/></svg>
                                                    Perbesar ID Card
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-2.5 text-center px-1">
                                        <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white leading-tight truncate group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                                            <?php echo esc_html( $emp_nama ); ?>
                                        </h4>
                                        <?php if ( ! empty( $emp_jabatan ) ) : ?>
                                            <p class="text-[11px] <?php echo $subtitle_color; ?> truncate mt-0.5">
                                                <?php echo esc_html( $emp_jabatan ); ?>
                                            </p>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $emp_nip ) ) : ?>
                                            <p class="text-[10px] text-slate-400 dark:text-slate-500 font-mono tracking-wider truncate mt-0.5">
                                                <?php echo esc_html( $emp_nip ); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div><!-- /.tim-subgrid -->

                    </div><!-- /.tim-division-segment -->
                <?php endif; ?>
            </div>

            <!-- EMPTY STATE IF SEARCH YIELDS 0 -->
            <div id="tim-empty-state" class="hidden text-center py-16 px-4">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-dark-surface text-slate-400 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Data Tidak Ditemukan</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 max-w-md mx-auto mb-5">
                    Tidak ada personel atau staf yang cocok dengan kata kunci pencarian atau divisi yang Anda pilih.
                </p>
                <button type="button" id="tim-reset-btn" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold transition-all shadow-sm">
                    Reset Pencarian &amp; Filter
                </button>
            </div>

        </div>
    </section>

    <?php if ( ! empty( $cta['show'] ) ) : ?>
    <!-- ========================================================================
         SECTION 4: CENTERED CTA — DINAMIS DARI PENGATURAN WP-ADMIN
         ======================================================================== -->
    <section class="section py-16 sm:py-20 relative z-10">
        <div class="container-narrow mx-auto text-center" data-aos="fade-up">
            <div class="spotlight-card relative overflow-hidden rounded-3xl p-8 sm:p-12 bg-gradient-to-br from-slate-900 via-slate-900 to-teal-950 border border-teal-500/20 shadow-2xl text-center space-y-6">
                <!-- Ambient Glow & Watermark Emblem Center -->
                <div class="absolute -top-24 -left-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 opacity-[0.035] pointer-events-none select-none">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 invert">
                </div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                    <?php if ( ! empty( $cta['badge'] ) ) : ?>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-500/10 border border-teal-400/20 text-teal-300 text-xs font-bold uppercase tracking-wider">
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
                        <?php if ( ! empty( $cta['btn1_text'] ) && ! empty( $cta['btn1_url'] ) ) : ?>
                            <a href="<?php echo esc_url( $cta['btn1_url'] ); ?>" 
                               class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold text-sm shadow-xl shadow-teal-500/20 hover:scale-105 transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/></svg>
                                <span><?php echo esc_html( $cta['btn1_text'] ); ?></span>
                            </a>
                        <?php endif; ?>

                        <?php if ( ! empty( $cta['btn2_text'] ) && ! empty( $cta['btn2_url'] ) ) : 
                            $is_wa = ( strpos( $cta['btn2_url'], 'wa.me' ) !== false || strpos( $cta['btn2_url'], 'whatsapp' ) !== false );
                        ?>
                            <a href="<?php echo esc_url( $cta['btn2_url'] ); ?>" 
                               <?php echo $is_wa ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
                               class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/15 text-white font-bold text-sm border border-white/20 backdrop-blur-md hover:scale-105 transition-all duration-300">
                                <?php if ( $is_wa ) : ?>
                                    <!-- Official WhatsApp SVG Crisp -->
                                    <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                <?php else : ?>
                                    <svg class="w-4 h-4 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                <?php endif; ?>
                                <span><?php echo esc_html( $cta['btn2_text'] ); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

</div>

<!-- ========================================================================
     MODAL LIGHTBOX: HIGH-RES ID CARD ZOOM & OFFICIAL VERIFICATION
     (Teleported to document.body for Swup SPA safety)
     ======================================================================== -->
<div id="idcard-zoom-modal" class="hidden fixed inset-0 z-[99999] items-center justify-center p-4 sm:p-6 overflow-y-auto bg-slate-950/85 backdrop-blur-2xl transition-all duration-300">
    <div class="relative w-full max-w-lg my-auto rounded-3xl bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border shadow-2xl overflow-hidden animate-fade-in flex flex-col">
        
        <!-- Modal Top Bar -->
        <div class="px-5 py-4 border-b border-slate-100 dark:border-dark-border flex items-center justify-between bg-slate-50/80 dark:bg-dark-surface/80">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs font-black uppercase tracking-wider text-emerald-700 dark:text-emerald-400" id="modal-verified-label">
                    Terverifikasi • Karyawan Aktif BSW
                </span>
            </div>
            <button type="button" id="btn-close-idcard-modal" class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-white flex items-center justify-center transition-colors">
                ✕
            </button>
        </div>

        <!-- Modal Body: High-Res ID Card View -->
        <div class="p-6 flex flex-col items-center">
            
            <!-- ID Card Large Display Container (Aspect Ratio 1 : 1.56) -->
            <div class="relative w-full max-w-[280px] sm:max-w-[320px] rounded-2xl overflow-hidden shadow-2xl border-2 border-teal-500/30" style="aspect-ratio: 1 / 1.56;">
                <img id="modal-idcard-img" src="" alt="ID Card High Res" class="w-full h-full object-cover">
                <!-- Verified Hologram Stamp Watermark -->
                <div class="absolute bottom-3 right-3 px-2 py-0.5 rounded-md bg-emerald-950/80 border border-emerald-400/40 text-[9px] font-mono text-emerald-300 font-bold backdrop-blur-md">
                    ✓ BSW VERIFIED
                </div>
            </div>

            <!-- Professional Motivation Quote / Pelayanan Amanah Callout -->
            <div id="modal-quote-wrap" class="hidden w-full mt-4 p-4 rounded-2xl bg-teal-500/5 dark:bg-teal-950/40 border border-teal-500/25 relative text-center">
                <span class="text-3xl text-teal-500/40 font-serif leading-none absolute top-1 left-3 select-none">“</span>
                <p id="modal-emp-quote" class="text-xs sm:text-sm italic text-slate-700 dark:text-slate-200 px-5 leading-relaxed font-serif"></p>
                <span class="text-3xl text-teal-500/40 font-serif leading-none absolute bottom-0 right-3 select-none">”</span>
            </div>

            <!-- Employee Info Detail Card -->
            <div class="w-full mt-4 p-4 rounded-2xl bg-slate-50 dark:bg-dark-surface border border-slate-200/80 dark:border-dark-border space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-slate-400">Nama Lengkap</span>
                    <span id="modal-emp-name" class="text-sm font-extrabold text-slate-900 dark:text-white text-right"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-slate-400">Jabatan / Posisi</span>
                    <span id="modal-emp-jabatan" class="text-xs font-bold text-teal-600 dark:text-teal-400 text-right"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-slate-400">Divisi Kerja</span>
                    <span id="modal-emp-divisi" class="text-xs font-semibold text-slate-700 dark:text-slate-300 text-right"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-slate-400">Nomor Induk Pegawai</span>
                    <span id="modal-emp-nip" class="text-xs font-mono font-bold text-slate-900 dark:text-white text-right"></span>
                </div>
                <div id="modal-tingkat-row" class="hidden items-center justify-between pt-1">
                    <span class="text-xs text-slate-400">Tingkat Jabatan</span>
                    <span id="modal-tingkat-badge" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-black uppercase"></span>
                </div>
                <div class="flex items-center justify-between pt-2 border-t border-slate-200/60 dark:border-dark-border/60">
                    <span class="text-xs text-slate-400" id="modal-status-label-title">Status Penugasan</span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/80 dark:text-emerald-300">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span id="modal-emp-status-badge">Personel Aktif</span>
                    </span>
                </div>
            </div>

            <!-- WhatsApp Verification Action Button -->
            <div class="w-full mt-4 flex items-center justify-between gap-3">
                <a id="modal-wa-verify-btn" href="#" target="_blank" rel="noopener noreferrer" 
                   class="flex-1 py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs inline-flex items-center justify-center gap-2 shadow-md transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <span>Verifikasi via WhatsApp CS</span>
                </a>
            </div>

        </div>

    </div>
</div>

<!-- ========================================================================
     MOBILE BOTTOM SHEET DRAWER: PILIH DIVISI
     (Teleported to document.body for clean stacking & high performance)
     ======================================================================== -->
<div id="wkl-tim-drawer-backdrop" 
     onclick="wklCloseTimDrawer()" 
     class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-[9999] opacity-0 pointer-events-none invisible transition-opacity duration-300 lg:hidden"
     aria-hidden="true"></div>

<div id="wkl-tim-drawer" 
     class="fixed inset-x-0 bottom-0 z-[10000] w-full max-w-lg mx-auto bg-white dark:bg-dark-card rounded-t-3xl shadow-2xl border-t border-slate-200/80 dark:border-dark-border transform translate-y-full pointer-events-none invisible transition-all duration-300 ease-out flex flex-col max-h-[82vh] lg:hidden"
     role="dialog"
     aria-modal="true"
     aria-labelledby="wkl-tim-drawer-title">
    
    <!-- Drag Handle / Grab Bar -->
    <div class="pt-3 pb-1 flex justify-center cursor-pointer shrink-0" onclick="wklCloseTimDrawer()">
        <div class="w-12 h-1.5 bg-slate-300 dark:bg-slate-600 rounded-full"></div>
    </div>

    <!-- Drawer Header -->
    <div class="px-5 py-3 border-b border-slate-100 dark:border-dark-border flex items-center justify-between shrink-0">
        <div>
            <div class="flex items-center gap-2 mb-0.5">
                <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                <span class="text-[10px] font-black uppercase tracking-wider text-teal-600 dark:text-teal-400">Pilihan Menu Mobile</span>
            </div>
            <h3 id="wkl-tim-drawer-title" class="text-base font-extrabold text-slate-900 dark:text-white">
                Direktori Tim Kerja BSW
            </h3>
        </div>
        <button type="button" 
                onclick="wklCloseTimDrawer()" 
                class="w-8 h-8 rounded-full bg-slate-100 dark:bg-dark-surface hover:bg-slate-200 dark:hover:bg-dark-border text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white flex items-center justify-center transition-colors cursor-pointer"
                aria-label="Tutup Menu">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Drawer Items List (Scrollable) -->
    <div class="overflow-y-auto p-4 space-y-2.5 flex-1 overscroll-contain">
        <!-- Option: Semua Divisi -->
        <button type="button" 
                onclick="wklSelectTimFromDrawer('all')"
                data-drawer-target="all"
                data-item-index="1"
                data-item-title="Semua Divisi"
                data-item-badge="<?php echo esc_attr( $total_active_emp . ' Personel' ); ?>"
                data-item-active-color="bg-teal-600 text-white"
                data-item-idle-icon="border bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 border-teal-200 dark:border-teal-800/70"
                data-item-badge-class="bg-teal-100 text-teal-800 dark:bg-teal-950/80 dark:text-teal-300 border-teal-300"
                class="wkl-tim-drawer-item active w-full text-left p-3.5 rounded-2xl transition-all duration-200 flex items-center gap-3.5 border bg-teal-50/70 dark:bg-teal-950/40 border-teal-500 shadow-sm cursor-pointer">
            
            <div class="wkl-tim-drawer-icon-box w-10 h-10 rounded-xl flex items-center justify-center shrink-0 bg-teal-600 text-white shadow-xs">
                <span class="wkl-tim-drawer-icon-svg">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                </span>
            </div>

            <div class="min-w-0 flex-1">
                <div class="flex items-center gap-2">
                    <h4 class="text-xs sm:text-sm font-extrabold truncate text-teal-900 dark:text-teal-100">
                        Semua Divisi
                    </h4>
                    <span class="text-[9px] px-1.5 py-0.2 rounded-full font-bold border border-teal-300 bg-teal-100 text-teal-800 dark:bg-teal-950/80 dark:text-teal-300 shrink-0">
                        <?php echo $total_active_emp; ?> Personel
                    </span>
                </div>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 line-clamp-1 mt-0.5">
                    Seluruh jajaran pengurus &amp; staf operasional Bank Syariah Wakalumi
                </p>
            </div>

            <div class="wkl-tim-drawer-check shrink-0 block">
                <div class="w-6 h-6 rounded-full bg-teal-500 text-white flex items-center justify-center shadow-xs">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                </div>
            </div>
        </button>

        <!-- Divisions List -->
        <?php 
        $d_num = 1;
        foreach ( $divisions as $div_key => $div_info ) : 
            $div_count = $division_counts[ $div_key ] ?? 0;
            if ( $div_count === 0 ) continue;
            $d_num++;
            $badge_class = function_exists( 'wakalumi_get_division_badge_class' ) 
                ? wakalumi_get_division_badge_class( $div_key, $div_info ) 
                : 'bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 border-teal-200 dark:border-teal-800/70';
            $div_icon = function_exists( 'wakalumi_get_division_icon_svg' ) 
                ? wakalumi_get_division_icon_svg( $div_key, $div_info['icon'] ?? '' ) 
                : '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>';
            $is_exec = in_array( $div_key, [ 'dps', 'komisaris', 'manajemen' ], true );
            $div_unit_label = $is_exec ? 'Personel' : 'Karyawan';
        ?>
            <button type="button" 
                    onclick="wklSelectTimFromDrawer('<?php echo esc_js( $div_key ); ?>')"
                    data-drawer-target="<?php echo esc_attr( $div_key ); ?>"
                    data-item-index="<?php echo $d_num; ?>"
                    data-item-title="<?php echo esc_attr( $div_info['name'] ); ?>"
                    data-item-badge="<?php echo esc_attr( $div_count . ' ' . $div_unit_label ); ?>"
                    data-item-active-color="bg-teal-600 text-white"
                    data-item-idle-icon="border shadow-2xs <?php echo esc_attr( $badge_class ); ?>"
                    data-item-badge-class="<?php echo esc_attr( $badge_class ); ?>"
                    class="wkl-tim-drawer-item w-full text-left p-3.5 rounded-2xl transition-all duration-200 flex items-center gap-3.5 border bg-slate-50/70 dark:bg-dark-surface/50 border-slate-200/70 dark:border-dark-border/80 hover:bg-slate-100 dark:hover:bg-dark-surface cursor-pointer">
                
                <div class="wkl-tim-drawer-icon-box w-10 h-10 rounded-xl flex items-center justify-center shrink-0 border shadow-2xs <?php echo esc_attr( $badge_class ); ?>">
                    <span class="wkl-tim-drawer-icon-svg">
                        <?php echo $div_icon; ?>
                    </span>
                </div>

                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-2">
                        <h4 class="text-xs sm:text-sm font-bold truncate text-slate-900 dark:text-white">
                            <?php echo esc_html( $div_info['name'] ); ?>
                        </h4>
                        <span class="text-[9px] px-1.5 py-0.2 rounded-full font-bold border <?php echo esc_attr( $badge_class ); ?> shrink-0">
                            <?php echo $div_count . ' ' . $div_unit_label; ?>
                        </span>
                        <?php if ( $is_exec ) : ?>
                            <span class="text-[8px] px-1.5 py-0.2 rounded-full font-black uppercase tracking-wider bg-teal-500 text-white shrink-0">
                                Eksekutif
                            </span>
                        <?php endif; ?>
                    </div>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 line-clamp-1 mt-0.5">
                        <?php echo $is_exec ? 'Bank Syariah Wakalumi &bull; Jajaran Pengurus &amp; Manajemen' : 'Bank Syariah Wakalumi &bull; Direktori Insan Bank'; ?>
                    </p>
                </div>

                <div class="wkl-tim-drawer-check shrink-0 hidden">
                    <div class="w-6 h-6 rounded-full bg-teal-500 text-white flex items-center justify-center shadow-xs">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                        </svg>
                    </div>
                </div>
            </button>
        <?php endforeach; ?>
    </div>

    <!-- Drawer Footer / Dismiss Button -->
    <div class="p-3.5 border-t border-slate-100 dark:border-dark-border bg-slate-50/60 dark:bg-dark-surface/40 shrink-0">
        <button type="button" 
                onclick="wklCloseTimDrawer()" 
                class="w-full py-2.5 rounded-xl bg-slate-200/80 dark:bg-dark-surface hover:bg-slate-300 dark:hover:bg-dark-border text-slate-700 dark:text-slate-300 font-bold text-xs transition-colors cursor-pointer">
            Tutup
        </button>
    </div>
</div>

<!-- ========================================================================
     CLIENT-SIDE INTERACTIVITY SCRIPT (SELF-CONTAINED & SWUP COMPATIBLE)
     ======================================================================== -->
<script>
// ── GLOBAL MOBILE DRAWER HANDLERS (EXPOSED TO WINDOW FOR SPA RELIABILITY) ──
function wklInitTimDrawer() {
    var drawer = document.getElementById('wkl-tim-drawer');
    var backdrop = document.getElementById('wkl-tim-drawer-backdrop');
    if (drawer && drawer.parentNode !== document.body) {
        document.body.appendChild(drawer);
    }
    if (backdrop && backdrop.parentNode !== document.body) {
        document.body.appendChild(backdrop);
    }
}

function wklOpenTimDrawer() {
    wklInitTimDrawer();
    var drawer = document.getElementById('wkl-tim-drawer');
    var backdrop = document.getElementById('wkl-tim-drawer-backdrop');
    if (!drawer || !backdrop) return;

    backdrop.classList.remove('opacity-0', 'pointer-events-none', 'invisible');
    backdrop.classList.add('opacity-100', 'pointer-events-auto');

    drawer.classList.remove('translate-y-full', 'pointer-events-none', 'invisible');
    drawer.classList.add('translate-y-0');

    document.body.style.overflow = 'hidden';
}

function wklCloseTimDrawer() {
    var drawer = document.getElementById('wkl-tim-drawer');
    var backdrop = document.getElementById('wkl-tim-drawer-backdrop');
    if (!drawer || !backdrop) return;

    drawer.classList.remove('translate-y-0');
    drawer.classList.add('translate-y-full', 'pointer-events-none');

    backdrop.classList.remove('opacity-100', 'pointer-events-auto');
    backdrop.classList.add('opacity-0', 'pointer-events-none');

    setTimeout(function() {
        if (drawer && drawer.classList.contains('translate-y-full')) {
            drawer.classList.add('invisible');
            if (backdrop) backdrop.classList.add('invisible');
        }
    }, 300);

    document.body.style.overflow = '';
}

function wklSyncTimStickyBar(slug) {
    var drawerItems = document.querySelectorAll('.wkl-tim-drawer-item');
    var stickyTitle = document.getElementById('wkl-tim-active-title');
    var stickyCounter = document.getElementById('wkl-tim-active-counter');
    var stickyBadge = document.getElementById('wkl-tim-active-badge');
    var stickyIcon = document.getElementById('wkl-tim-active-icon');
    var stickyIconBox = document.getElementById('wkl-tim-active-icon-box');

    drawerItems.forEach(function(item) {
        var isThis = (item.getAttribute('data-drawer-target') === slug);
        var checkEl = item.querySelector('.wkl-tim-drawer-check');
        var iconBox = item.querySelector('.wkl-tim-drawer-icon-box');
        var iconSvg = item.querySelector('.wkl-tim-drawer-icon-svg');
        var titleEl = item.querySelector('h4');
        var activeColorClass = item.getAttribute('data-item-active-color') || 'bg-teal-600 text-white';
        var idleIconClass = item.getAttribute('data-item-idle-icon') || '';
        var badgeText = item.getAttribute('data-item-badge') || '';
        var badgeClass = item.getAttribute('data-item-badge-class') || '';

        if (isThis) {
            item.className = 'wkl-tim-drawer-item active w-full text-left p-3.5 rounded-2xl transition-all duration-200 flex items-center gap-3.5 border bg-teal-50/70 dark:bg-teal-950/40 border-teal-500 shadow-sm cursor-pointer';
            if (iconBox) iconBox.className = 'wkl-tim-drawer-icon-box w-10 h-10 rounded-xl flex items-center justify-center shrink-0 text-white shadow-xs ' + activeColorClass;
            if (titleEl) titleEl.className = 'text-xs sm:text-sm font-extrabold truncate text-teal-900 dark:text-teal-100';
            if (checkEl) checkEl.className = 'wkl-tim-drawer-check shrink-0 block';

            // Sync to Mobile Sticky Bar
            if (stickyTitle) stickyTitle.textContent = item.getAttribute('data-item-title') || '';
            if (stickyCounter) {
                var idx = item.getAttribute('data-item-index') || '1';
                var total = drawerItems.length;
                stickyCounter.textContent = idx + ' / ' + total;
            }
            if (stickyBadge && badgeText) {
                stickyBadge.textContent = badgeText;
                stickyBadge.className = 'text-[9px] px-1.5 py-0.2 rounded-full font-bold border ' + badgeClass;
                stickyBadge.classList.remove('hidden');
            }
            if (stickyIconBox) {
                stickyIconBox.className = 'w-10 h-10 rounded-xl flex items-center justify-center shrink-0 shadow-xs ' + activeColorClass;
            }
            if (stickyIcon && iconSvg) {
                stickyIcon.innerHTML = iconSvg.innerHTML;
            }
        } else {
            item.className = 'wkl-tim-drawer-item w-full text-left p-3.5 rounded-2xl transition-all duration-200 flex items-center gap-3.5 border bg-slate-50/70 dark:bg-dark-surface/50 border-slate-200/70 dark:border-dark-border/80 hover:bg-slate-100 dark:hover:bg-dark-surface cursor-pointer';
            if (iconBox) iconBox.className = 'wkl-tim-drawer-icon-box w-10 h-10 rounded-xl flex items-center justify-center shrink-0 ' + idleIconClass;
            if (titleEl) titleEl.className = 'text-xs sm:text-sm font-bold truncate text-slate-900 dark:text-white';
            if (checkEl) checkEl.className = 'wkl-tim-drawer-check shrink-0 hidden';
        }
    });
}

function wklSelectTimFromDrawer(slug) {
    wklCloseTimDrawer();
    if (typeof window.wklFilterTimCards === 'function') {
        window.wklFilterTimCards(slug, true);
    } else {
        wklSyncTimStickyBar(slug);
    }
}

// Expose all functions to window for global access across Swup page views
window.wklInitTimDrawer = wklInitTimDrawer;
window.wklOpenTimDrawer = wklOpenTimDrawer;
window.wklCloseTimDrawer = wklCloseTimDrawer;
window.wklSelectTimFromDrawer = wklSelectTimFromDrawer;
window.wklSyncTimStickyBar = wklSyncTimStickyBar;

// ── PAGE INTERACTION & FILTER LOGIC ─────────────────────────────
(function() {
    function initTimKamiPage() {
        wklInitTimDrawer();

        const container     = document.getElementById('tim-card-container');
        if (!container) return;

        const segments      = Array.from(container.querySelectorAll('.tim-division-segment'));
        const cards         = Array.from(container.querySelectorAll('.tim-employee-card'));
        const tabBtns       = document.querySelectorAll('.tim-tab-btn');
        const searchInput   = document.getElementById('tim-search-input');
        const searchClear   = document.getElementById('tim-search-clear');
        const visibleCount  = document.getElementById('tim-visible-count');
        const emptyState    = document.getElementById('tim-empty-state');
        const resetBtn      = document.getElementById('tim-reset-btn');
        const tabsContainer = document.getElementById('tim-division-tabs');
        const btnTabsPrev   = document.getElementById('tim-tabs-prev');
        const btnTabsNext   = document.getElementById('tim-tabs-next');

        let currentDivision = 'all';
        let searchQuery     = '';

        function filterCards() {
            let totalVisible = 0;
            const q = searchQuery.toLowerCase().trim();

            segments.forEach(segment => {
                const segSlug = segment.getAttribute('data-division-slug') || '';
                const segCards = Array.from(segment.querySelectorAll('.tim-employee-card'));
                const matchesDivision = (currentDivision === 'all') || (segSlug === currentDivision);

                if (!matchesDivision) {
                    segment.style.display = 'none';
                    segCards.forEach(card => {
                        card.style.display = 'none';
                    });
                    return;
                }

                let segVisibleCount = 0;
                segCards.forEach(card => {
                    const cardKw = card.getAttribute('data-keywords') || '';
                    const matchesKw = !q || cardKw.includes(q);

                    if (matchesKw) {
                        card.style.display = '';
                        card.style.opacity = '1';
                        card.style.transform = 'none';
                        card.classList.remove('aos-init');
                        card.classList.add('aos-animate');
                        segVisibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (segVisibleCount > 0) {
                    segment.style.display = '';
                    segment.style.opacity = '1';
                    segment.style.transform = 'none';
                    segment.classList.remove('aos-init');
                    segment.classList.add('aos-animate');
                    totalVisible += segVisibleCount;
                } else {
                    segment.style.display = 'none';
                }
            });

            if (visibleCount) {
                visibleCount.textContent = totalVisible;
                const visibleUnit = document.getElementById('tim-visible-unit');
                if (visibleUnit) {
                    if (['dps', 'komisaris', 'manajemen'].includes(currentDivision) || currentDivision === 'all') {
                        visibleUnit.textContent = 'personel';
                    } else {
                        visibleUnit.textContent = 'karyawan';
                    }
                }
            }

            if (emptyState) {
                if (totalVisible === 0) {
                    emptyState.classList.remove('hidden');
                    container.classList.add('hidden');
                } else {
                    emptyState.classList.add('hidden');
                    container.classList.remove('hidden');
                }
            }
        }

        // UNIFIED CENTRAL DIVISION FILTER FUNCTION
        window.wklFilterTimCards = function(slug, fromDrawer) {
            currentDivision = slug;
            filterCards();

            // 1. Sync Desktop Tabs UI
            tabBtns.forEach(b => {
                const bDiv = b.getAttribute('data-division') || 'all';
                const badge = b.querySelector('span');
                if (bDiv === slug) {
                    b.classList.add('active', 'bg-teal-600', 'text-white', 'ring-2', 'ring-teal-500/50');
                    b.classList.remove('bg-slate-100', 'dark:bg-slate-800', 'text-slate-700', 'dark:text-slate-300');
                    if (badge) {
                        badge.classList.add('bg-white/20', 'text-white');
                        badge.classList.remove('bg-slate-200', 'dark:bg-slate-700', 'text-slate-600', 'dark:text-slate-300');
                    }
                    if (!fromDrawer && b.offsetParent !== null) {
                        b.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    }
                } else {
                    b.classList.remove('active', 'bg-teal-600', 'text-white', 'ring-2', 'ring-teal-500/50');
                    b.classList.add('bg-slate-100', 'dark:bg-slate-800', 'text-slate-700', 'dark:text-slate-300');
                    if (badge) {
                        badge.classList.remove('bg-white/20', 'text-white');
                        badge.classList.add('bg-slate-200', 'dark:bg-slate-700', 'text-slate-600', 'dark:text-slate-300');
                    }
                }
            });

            // 2. Sync Mobile Sticky Bar & Drawer Items
            wklSyncTimStickyBar(slug);

            // 3. Smooth scroll with exact sticky offset
            const stickyBar = document.getElementById('wkl-tim-sticky-wrapper');
            const offset = (stickyBar && window.innerWidth < 1024 ? stickyBar.offsetHeight : 0) + 75;

            if (slug === 'all') {
                const firstSeg = document.querySelector('.tim-division-segment');
                if (firstSeg && fromDrawer) {
                    const elementPosition = firstSeg.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - offset;
                    window.scrollTo({
                        top: Math.max(0, offsetPosition),
                        behavior: 'smooth'
                    });
                }
            } else {
                const targetSeg = document.getElementById('divisi-' + slug);
                if (targetSeg) {
                    const elementPosition = targetSeg.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - offset;
                    window.scrollTo({
                        top: Math.max(0, offsetPosition),
                        behavior: 'smooth'
                    });
                }
            }
        };

        // Division Tabs Click (Desktop)
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const slug = this.getAttribute('data-division') || 'all';
                window.wklFilterTimCards(slug, false);
            });
        });

        // Horizontal Carousel Navigation for Division Tabs
        if (tabsContainer && btnTabsPrev && btnTabsNext) {
            function updateTabArrows() {
                const sl = tabsContainer.scrollLeft;
                const maxScroll = tabsContainer.scrollWidth - tabsContainer.clientWidth;
                btnTabsPrev.disabled = sl <= 2;
                btnTabsNext.disabled = sl >= maxScroll - 4;
            }

            btnTabsPrev.addEventListener('click', function(e) {
                e.preventDefault();
                tabsContainer.scrollBy({ left: -260, behavior: 'smooth' });
                setTimeout(updateTabArrows, 320);
            });

            btnTabsNext.addEventListener('click', function(e) {
                e.preventDefault();
                tabsContainer.scrollBy({ left: 260, behavior: 'smooth' });
                setTimeout(updateTabArrows, 320);
            });

            tabsContainer.addEventListener('scroll', updateTabArrows, { passive: true });
            window.addEventListener('resize', updateTabArrows);
            setTimeout(updateTabArrows, 150);

            // Drag-to-scroll support for desktop mouse
            let isDown = false;
            let startX, scrollLeftVal;

            tabsContainer.addEventListener('mousedown', function(e) {
                isDown = true;
                startX = e.pageX - tabsContainer.offsetLeft;
                scrollLeftVal = tabsContainer.scrollLeft;
            });
            tabsContainer.addEventListener('mouseleave', function() {
                isDown = false;
            });
            tabsContainer.addEventListener('mouseup', function() {
                isDown = false;
            });
            tabsContainer.addEventListener('mousemove', function(e) {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - tabsContainer.offsetLeft;
                const walk = (x - startX) * 1.5;
                tabsContainer.scrollLeft = scrollLeftVal - walk;
                updateTabArrows();
            });
        }

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
                filterCards();
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
                    filterCards();
                    searchInput.focus();
                }
            });
        }

        // Reset Filter Button
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                if (searchInput) searchInput.value = '';
                searchQuery = '';
                if (searchClear) searchClear.classList.add('hidden');
                
                // Reset to all tab
                window.wklFilterTimCards('all', false);
            });
        }

        // Mobile ScrollSpy when in "all" mode
        function handleTimScrollSpy() {
            if (window.innerWidth >= 1024) return;
            if (currentDivision !== 'all') return;

            const headerOffset = 140;
            let activeSeg = null;

            for (let i = 0; i < segments.length; i++) {
                const seg = segments[i];
                if (seg.style.display === 'none') continue;
                const rect = seg.getBoundingClientRect();
                if (rect.top <= headerOffset + 60 && rect.bottom > headerOffset) {
                    activeSeg = seg;
                    break;
                }
            }

            if (activeSeg) {
                const segSlug = activeSeg.getAttribute('data-division-slug');
                wklSyncTimStickyBar(segSlug);
            }
        }

        window.addEventListener('scroll', handleTimScrollSpy, { passive: true });

        // ── MODAL LIGHTBOX TELEPORT & EVENT HANDLERS ────────────────
        const modal = document.getElementById('idcard-zoom-modal');
        if (modal && modal.parentNode !== document.body) {
            document.body.appendChild(modal);
        }

        const modalImg       = document.getElementById('modal-idcard-img');
        const modalName      = document.getElementById('modal-emp-name');
        const modalJabatan   = document.getElementById('modal-emp-jabatan');
        const modalDivisi    = document.getElementById('modal-emp-divisi');
        const modalNip       = document.getElementById('modal-emp-nip');
        const modalQuoteWrap = document.getElementById('modal-quote-wrap');
        const modalQuote     = document.getElementById('modal-emp-quote');
        const modalTingkatRow = document.getElementById('modal-tingkat-row');
        const modalTingkatBadge = document.getElementById('modal-tingkat-badge');
        const modalWaBtn     = document.getElementById('modal-wa-verify-btn');
        const btnCloseModal  = document.getElementById('btn-close-idcard-modal');

        function openModal(cardTrigger) {
            if (!modal) return;
            const name    = cardTrigger.getAttribute('data-emp-name') || '';
            const nip     = cardTrigger.getAttribute('data-emp-nip') || '-';
            const divisi  = cardTrigger.getAttribute('data-emp-divisi') || '';
            const jabatan = cardTrigger.getAttribute('data-emp-jabatan') || '';
            const tingkat = cardTrigger.getAttribute('data-emp-tingkat') || 'staff';
            const tag     = cardTrigger.getAttribute('data-emp-tag') || '';
            const quote   = cardTrigger.getAttribute('data-emp-quote') || '';
            const imgSrc  = cardTrigger.getAttribute('data-emp-img') || '';

            if (modalImg) modalImg.src = imgSrc;
            if (modalName) modalName.textContent = name;
            if (modalJabatan) modalJabatan.textContent = jabatan;
            if (modalDivisi) modalDivisi.textContent = divisi;
            if (modalNip) modalNip.textContent = nip;

            // Quote Motivasi
            if (modalQuoteWrap && modalQuote) {
                if (quote && quote.trim().length > 0) {
                    modalQuote.textContent = quote;
                    modalQuoteWrap.classList.remove('hidden');
                } else {
                    modalQuoteWrap.classList.add('hidden');
                }
            }

            // Narasi Khusus Tingkat Jabatan & Status (Pengurus / Manajemen vs Karyawan)
            const modalVerifiedLabel = document.getElementById('modal-verified-label');
            const modalStatusTitle   = document.getElementById('modal-status-label-title');
            const modalStatusBadge   = document.getElementById('modal-emp-status-badge');

            let kategoriPersonel = 'karyawan';
            if (tingkat === 'eksekutif') {
                kategoriPersonel = 'jajaran pengurus / personel manajemen';
                if (modalVerifiedLabel) modalVerifiedLabel.textContent = 'Terverifikasi • Jajaran Pengurus / Manajemen BSW';
                if (modalStatusTitle) modalStatusTitle.textContent = 'Status Jabatan';
                if (modalStatusBadge) modalStatusBadge.textContent = 'Personel Manajemen Aktif';
            } else if (tingkat === 'pe') {
                kategoriPersonel = 'pejabat eksekutif (PE)';
                if (modalVerifiedLabel) modalVerifiedLabel.textContent = 'Terverifikasi • Pejabat Eksekutif BSW';
                if (modalStatusTitle) modalStatusTitle.textContent = 'Status Penugasan';
                if (modalStatusBadge) modalStatusBadge.textContent = 'Pejabat Eksekutif Aktif';
            } else {
                kategoriPersonel = 'karyawan';
                if (modalVerifiedLabel) modalVerifiedLabel.textContent = 'Terverifikasi • Karyawan Aktif BSW';
                if (modalStatusTitle) modalStatusTitle.textContent = 'Status Kepegawaian';
                if (modalStatusBadge) modalStatusBadge.textContent = 'Karyawan Aktif';
            }

            // Tingkat Jabatan Badge (No Emojis - Professional Clean Badge)
            if (modalTingkatRow && modalTingkatBadge) {
                if (tingkat === 'eksekutif') {
                    modalTingkatBadge.textContent = 'Jajaran Pengurus / Eksekutif (' + (tag || 'EKS') + ')';
                    modalTingkatBadge.className = 'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-black uppercase bg-teal-100 text-teal-800 dark:bg-teal-950/80 dark:text-teal-300 border border-teal-300';
                    modalTingkatRow.classList.remove('hidden');
                    modalTingkatRow.classList.add('flex');
                } else if (tingkat === 'pe') {
                    modalTingkatBadge.textContent = 'Pejabat Eksekutif (PE)';
                    modalTingkatBadge.className = 'inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-black uppercase bg-emerald-100 text-emerald-800 dark:bg-emerald-950/80 dark:text-emerald-300 border border-emerald-300';
                    modalTingkatRow.classList.remove('hidden');
                    modalTingkatRow.classList.add('flex');
                } else {
                    modalTingkatRow.classList.add('hidden');
                    modalTingkatRow.classList.remove('flex');
                }
            }

            if (modalWaBtn) {
                const waBase = '<?php echo esc_js( $notice_wa ); ?>';
                const msg = `Assalamu'alaikum CS Bank Syariah Wakalumi, saya ingin konfirmasi verifikasi keabsahan identitas ${kategoriPersonel}:

Nama: ${name}
NIP: ${nip}
Jabatan: ${jabatan}
Divisi: ${divisi}

Mohon konfirmasi keaktifan beliau. Terima kasih.`;
                modalWaBtn.href = waBase + '?text=' + encodeURIComponent(msg);
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        // Delegated clicks for ID Card triggers (Immune to DOM filtering/updates)
        container.addEventListener('click', function(e) {
            const trigger = e.target.closest('[data-modal-open="idcard-zoom-modal"]');
            if (trigger) {
                e.preventDefault();
                openModal(trigger);
            }
        });

        if (btnCloseModal) {
            btnCloseModal.addEventListener('click', closeModal);
        }

        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
        }

        // Keyboard Escape for both modal and drawer
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (modal && !modal.classList.contains('hidden')) {
                    closeModal();
                }
                wklCloseTimDrawer();
            }
        });

        // Cleanup on Swup navigation
        if (window.swup && window.swup.hooks) {
            window.swup.hooks.once('visit:start', function() {
                closeModal();
                wklCloseTimDrawer();
                window.removeEventListener('scroll', handleTimScrollSpy);
                var drawer = document.getElementById('wkl-tim-drawer');
                var backdrop = document.getElementById('wkl-tim-drawer-backdrop');
                if (drawer && drawer.parentNode === document.body) {
                    drawer.remove();
                }
                if (backdrop && backdrop.parentNode === document.body) {
                    backdrop.remove();
                }
                if (modal && modal.parentNode === document.body) {
                    modal.remove();
                }
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTimKamiPage);
    } else {
        initTimKamiPage();
    }

    // Re-init on Swup navigation
    if (window.swup && window.swup.hooks) {
        window.swup.hooks.on('page:view', initTimKamiPage);
    }
})();
</script>

<?php get_footer(); ?>
