<?php
/**
 * Template Name: Laporan Publikasi & Regulasi OJK
 * Description: Halaman Pusat Publikasi Resmi Laporan Keuangan Triwulanan (5 Tahun Historis),
 *              Tata Kelola (GCG), Laporan Tahunan (Annual Report), dan Keuangan Berkelanjutan (LKB).
 *              Dilengkapi Filter Kategori & Tahun Real-time, Lightbox PDF Viewer, dan Terintegrasi CMS.
 *
 * @package Wakalumi
 */

// Filter dynamic document title tag agar otomatis mengikuti pengaturan CMS
add_filter( 'document_title_parts', function( $title_parts ) {
    if ( function_exists( 'wakalumi_get_laporan_header' ) ) {
        $cfg = wakalumi_get_laporan_header();
        if ( ! empty( $cfg['title'] ) ) {
            $title_parts['title'] = $cfg['title'];
        }
    }
    return $title_parts;
}, 99 );

get_header();

// ── 1. AMBIL KONFIGURASI HEADER & DATA DARI CMS ADMIN ───────────────
$header_cfg  = function_exists( 'wakalumi_get_laporan_header' ) ? wakalumi_get_laporan_header() : [
    'badge'      => 'Transparansi & Kepatuhan Regulasi',
    'title'      => 'Laporan Publikasi Keuangan & Tata Kelola',
    'subtitle'   => 'Akses seluruh publikasi resmi transparansi keuangan triwulanan, laporan tata kelola perusahaan, dan laporan tahunan BPRS Wakalumi sesuai ketentuan regulasi Otoritas Jasa Keuangan (OJK).',
    'disclaimer' => 'Seluruh laporan keuangan dan tata kelola dipublikasikan secara resmi sebagai wujud kepatuhan terhadap POJK No. 37/POJK.03/2019 tentang Transparansi dan Publikasi Laporan Bank serta regulasi tata kelola BPR Syariah.',
];
$all_laporan = function_exists( 'wakalumi_get_laporan_list' ) ? wakalumi_get_laporan_list() : [];

// ── 2. EKSTRAK TAHUN UNIK & HITUNG JUMLAH DOKUMEN PER KATEGORI ───────
$counts = [
    'triwulan'      => 0,
    'gcg'           => 0,
    'tahunan'       => 0,
    'berkelanjutan' => 0,
    'lainnya'       => 0,
];
$years_set = [];
$cat_years_set = [
    'triwulan'      => [],
    'gcg'           => [],
    'tahunan'       => [],
    'berkelanjutan' => [],
    'lainnya'       => [],
];

foreach ( $all_laporan as $lap ) {
    $cat = $lap['kategori'] ?? 'triwulan';
    if ( $cat === 'lkb' ) {
        $cat = 'berkelanjutan';
    }
    if ( isset( $counts[ $cat ] ) ) {
        $counts[ $cat ]++;
    }
    if ( ! empty( $lap['tahun'] ) ) {
        $yr = (string) $lap['tahun'];
        $years_set[ $yr ] = true;
        if ( isset( $cat_years_set[ $cat ] ) ) {
            $cat_years_set[ $cat ][ $yr ] = true;
        }
    }
}

// Urutkan tahun dari yang terbaru ke terlama
$available_years = array_keys( $years_set );
rsort( $available_years, SORT_NUMERIC );
if ( empty( $available_years ) ) {
    $available_years = [ '2026', '2025', '2024', '2023', '2022' ];
}

// ── 3. WHATSAPP & KONTAK RESMI ───────────────────────────────────────
$default_wa      = get_option( 'options_contact_wa', '6281517380388' );
$wa_number       = get_option( 'options_produk_wa_number', $default_wa );
$clean_wa        = preg_replace( '/[^0-9]/', '', $wa_number );
$default_wa_link = 'https://wa.me/' . $clean_wa . '?text=' . rawurlencode( 'Halo Sekretariat BPRS Wakalumi, saya ingin menanyakan informasi publikasi laporan resmi bank.' );

if ( ! function_exists( 'wakalumi_get_laporan_theme' ) ) {
    /**
     * Fallback helper tema styling kartu laporan jika admin-laporan belum termuat
     */
    function wakalumi_get_laporan_theme( $cat ) {
        return [
            'name'         => 'emerald',
            'top_border'   => 'from-emerald-500 via-teal-400 to-emerald-600',
            'hover_border' => 'hover:border-emerald-400/90 dark:hover:border-emerald-500/80',
            'hover_shadow' => 'hover:shadow-emerald-500/20',
            'badge_style'  => 'bg-emerald-50 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 border-emerald-200/80 dark:border-emerald-800/80',
            'icon_box'     => 'bg-emerald-50 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 border-emerald-200/70 dark:border-emerald-800/70',
            'title_hover'  => 'group-hover:text-emerald-600 dark:group-hover:text-emerald-400',
            'btn_action'   => 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/25',
            'btn_preview'  => 'hover:border-emerald-400 hover:text-emerald-600 dark:hover:text-emerald-300',
            'tab_active'   => 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white border-emerald-500 shadow-md shadow-emerald-600/25',
            'tab_inactive' => 'bg-emerald-50/70 dark:bg-emerald-950/30 text-emerald-900 dark:text-emerald-200 border-emerald-200/70 dark:border-emerald-900/50 hover:bg-emerald-100/80',
        ];
    }
}
?>

<!-- ========================================================================
     SECTION 1: HERO HEADER BANNER (ELEGANT BANKING WITH WATERMARK EMBLEM)
     ======================================================================== -->
<section class="relative z-10 pt-8 pb-12 md:pb-16 overflow-hidden bg-gradient-to-b from-teal-50/60 via-slate-50/40 to-transparent dark:from-dark-surface dark:via-dark-surface/50 dark:to-transparent border-b border-slate-200/80 dark:border-dark-border/80">
    <!-- Ambient Glow & Straight Watermark Emblem -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-teal-400/10 dark:bg-teal-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-cyan-400/10 dark:bg-cyan-500/5 rounded-full blur-3xl pointer-events-none"></div>
    
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
            <span class="text-teal-600 dark:text-teal-400 font-semibold">Laporan Publikasi &amp; Tata Kelola</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Left Column: Title, Kicker & Highlights -->
            <div class="lg:col-span-8" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100/80 dark:bg-emerald-950/60 border border-emerald-300/60 dark:border-emerald-700/50 text-emerald-800 dark:text-emerald-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <?php echo esc_html( $header_cfg['badge'] ); ?>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                    <?php echo esc_html( $header_cfg['title'] ); ?>
                </h1>

                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                    <?php echo esc_html( $header_cfg['subtitle'] ); ?>
                </p>

                <!-- Key Highlights Pills -->
                <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>Historis <?php echo count( $available_years ); ?> Tahun Terakhir</span>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                        <span>Kepatuhan POJK No. 37/2019</span>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <span>Pratinjau PDF Lightbox Langsung</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Governance Badge Card with Watermark -->
            <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="100">
                <div class="spotlight-card relative overflow-hidden rounded-3xl p-6 sm:p-7 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-emerald-200/80 dark:border-dark-border shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 text-center space-y-4 group cursor-default before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-emerald-500 via-teal-400 to-cyan-500">
                    <!-- Interactive Slide Watermark Emblem (untitled3.png) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.06] dark:opacity-[0.04] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.1] dark:group-hover:opacity-[0.08] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled3.png' ); ?>" alt="" class="w-full h-full object-contain">
                    </div>

                    <!-- Official Emblem / Bank Logo Badge in Full Color (No black silhouette) -->
                    <div class="relative w-16 h-16 rounded-2xl bg-white dark:bg-dark-surface-alt text-emerald-600 dark:text-emerald-400 flex items-center justify-center p-2.5 mx-auto shadow-md shadow-emerald-500/10 group-hover:scale-105 transition-all duration-300 z-10 border border-emerald-200/80 dark:border-dark-border">
                        <div class="absolute inset-0 rounded-2xl bg-emerald-400/10 blur-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled3.png' ); ?>" alt="Logo BPRS Wakalumi" class="w-full h-full object-contain relative z-10">
                    </div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 text-[10px] font-extrabold uppercase tracking-wider mb-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            Keterbukaan Informasi Publik
                        </div>
                        <h4 class="text-lg font-black text-slate-900 dark:text-white">Transparansi, Akuntabilitas &amp; Kepatuhan</h4>
                    </div>

                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed relative z-10">
                        BPRS Wakalumi berkomitmen menerapkan prinsip keterbukaan informasi perbankan syariah sesuai standar OJK dan tata kelola yang amanah.
                    </p>

                    <div class="pt-1 relative z-10 flex items-center justify-center gap-2">
                        <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Diawasi OJK
                        </span>
                        <span class="text-slate-300 dark:text-slate-600">•</span>
                        <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Penjaminan LPS
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================================
     SECTION 2: 5 TOP-LEVEL CATEGORY TABS (5 KATEGORI LAPORAN REGULASI)
     ======================================================================== -->
<?php
$theme_triwulan      = wakalumi_get_laporan_theme( 'triwulan' );
$theme_gcg           = wakalumi_get_laporan_theme( 'gcg' );
$theme_tahunan       = wakalumi_get_laporan_theme( 'tahunan' );
$theme_berkelanjutan = wakalumi_get_laporan_theme( 'berkelanjutan' );
$theme_lainnya       = wakalumi_get_laporan_theme( 'lainnya' );
?>
<section class="py-6 bg-white dark:bg-dark-surface border-b border-slate-200/80 dark:border-dark-border/80">
    <div class="container-wide">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4" id="laporan-main-tabs">
            
            <!-- Tab 0: Semua Laporan (Master Filter) -->
            <button 
                type="button" 
                data-tab="all"
                data-active-classes="bg-gradient-to-r from-teal-700 via-teal-800 to-slate-900 text-white border-teal-500 shadow-md shadow-teal-900/30"
                data-inactive-classes="bg-slate-50/90 dark:bg-dark-surface-alt/80 text-slate-800 dark:text-slate-200 border-slate-200/90 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-card"
                data-icon-active="bg-white/20 text-white"
                data-icon-inactive="bg-slate-200/80 dark:bg-dark-card text-slate-700 dark:text-slate-300"
                class="laporan-tab-btn active-tab flex items-center gap-3 p-3.5 sm:p-4 rounded-2xl border transition-all duration-300 text-left col-span-2 sm:col-span-1 bg-gradient-to-r from-teal-700 via-teal-800 to-slate-900 text-white border-teal-500 shadow-md shadow-teal-900/30 group cursor-pointer"
            >
                <div class="tab-icon-box w-10 h-10 rounded-xl bg-white/20 text-white flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25A2.25 2.25 0 018.25 10.5H6A2.25 2.25 0 013.75 8.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25A2.25 2.25 0 0113.5 8.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <span class="text-xs sm:text-sm font-extrabold block leading-tight truncate">Semua Laporan</span>
                    <span class="text-[11px] opacity-80 block mt-0.5"><?php echo count( $all_laporan ); ?> Dokumen Resmi</span>
                </div>
            </button>

            <!-- Tab 1: Laporan Publikasi Triwulanan -->
            <button 
                type="button" 
                data-tab="triwulan"
                data-active-classes="<?php echo esc_attr( $theme_triwulan['tab_active'] ); ?>"
                data-inactive-classes="<?php echo esc_attr( $theme_triwulan['tab_inactive'] ); ?>"
                data-icon-active="bg-white/20 text-white"
                data-icon-inactive="<?php echo esc_attr( $theme_triwulan['icon_box'] ); ?>"
                class="laporan-tab-btn flex items-center gap-3 p-3.5 sm:p-4 rounded-2xl border transition-all duration-300 text-left <?php echo esc_attr( $theme_triwulan['tab_inactive'] ); ?> group cursor-pointer"
            >
                <div class="tab-icon-box w-10 h-10 rounded-xl <?php echo esc_attr( $theme_triwulan['icon_box'] ); ?> flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>
                </div>
                <div class="min-w-0">
                    <span class="text-xs sm:text-sm font-extrabold block leading-tight truncate">Publikasi Triwulanan</span>
                    <span class="text-[11px] opacity-80 block mt-0.5">
                        <?php 
                        $tw_years_cnt = count( $cat_years_set['triwulan'] );
                        echo (int) $counts['triwulan'] . ' Dokumen' . ( $tw_years_cnt > 0 ? ' (' . $tw_years_cnt . ' Thn)' : '' ); 
                        ?>
                    </span>
                </div>
            </button>

            <!-- Tab 2: Tata Kelola (GCG) -->
            <button 
                type="button" 
                data-tab="gcg"
                data-active-classes="<?php echo esc_attr( $theme_gcg['tab_active'] ); ?>"
                data-inactive-classes="<?php echo esc_attr( $theme_gcg['tab_inactive'] ); ?>"
                data-icon-active="bg-white/20 text-white"
                data-icon-inactive="<?php echo esc_attr( $theme_gcg['icon_box'] ); ?>"
                class="laporan-tab-btn flex items-center gap-3 p-3.5 sm:p-4 rounded-2xl border transition-all duration-300 text-left <?php echo esc_attr( $theme_gcg['tab_inactive'] ); ?> group cursor-pointer"
            >
                <div class="tab-icon-box w-10 h-10 rounded-xl <?php echo esc_attr( $theme_gcg['icon_box'] ); ?> flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.333A48.272 48.272 0 0012 9.75c-2.551 0-5.056.2-7.5.583V21" /></svg>
                </div>
                <div class="min-w-0">
                    <span class="text-xs sm:text-sm font-extrabold block leading-tight truncate">Tata Kelola Perusahaan</span>
                    <span class="text-[11px] opacity-80 block mt-0.5"><?php echo (int) $counts['gcg']; ?> Dokumen GCG</span>
                </div>
            </button>

            <!-- Tab 3: Laporan Tahunan (Annual Report) -->
            <button 
                type="button" 
                data-tab="tahunan"
                data-active-classes="<?php echo esc_attr( $theme_tahunan['tab_active'] ); ?>"
                data-inactive-classes="<?php echo esc_attr( $theme_tahunan['tab_inactive'] ); ?>"
                data-icon-active="bg-white/20 text-white"
                data-icon-inactive="<?php echo esc_attr( $theme_tahunan['icon_box'] ); ?>"
                class="laporan-tab-btn flex items-center gap-3 p-3.5 sm:p-4 rounded-2xl border transition-all duration-300 text-left <?php echo esc_attr( $theme_tahunan['tab_inactive'] ); ?> group cursor-pointer"
            >
                <div class="tab-icon-box w-10 h-10 rounded-xl <?php echo esc_attr( $theme_tahunan['icon_box'] ); ?> flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                </div>
                <div class="min-w-0">
                    <span class="text-xs sm:text-sm font-extrabold block leading-tight truncate">Laporan Tahunan</span>
                    <span class="text-[11px] opacity-80 block mt-0.5"><?php echo (int) $counts['tahunan']; ?> Annual Report</span>
                </div>
            </button>

            <!-- Tab 4: Keuangan Berkelanjutan (LKB) -->
            <button 
                type="button" 
                data-tab="berkelanjutan"
                data-active-classes="<?php echo esc_attr( $theme_berkelanjutan['tab_active'] ); ?>"
                data-inactive-classes="<?php echo esc_attr( $theme_berkelanjutan['tab_inactive'] ); ?>"
                data-icon-active="bg-white/20 text-white"
                data-icon-inactive="<?php echo esc_attr( $theme_berkelanjutan['icon_box'] ); ?>"
                class="laporan-tab-btn flex items-center gap-3 p-3.5 sm:p-4 rounded-2xl border transition-all duration-300 text-left <?php echo esc_attr( $theme_berkelanjutan['tab_inactive'] ); ?> group cursor-pointer"
            >
                <div class="tab-icon-box w-10 h-10 rounded-xl <?php echo esc_attr( $theme_berkelanjutan['icon_box'] ); ?> flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-.778.099-1.533.284-2.253" /></svg>
                </div>
                <div class="min-w-0">
                    <span class="text-xs sm:text-sm font-extrabold block leading-tight truncate">Keuangan Berkelanjutan</span>
                    <span class="text-[11px] opacity-80 block mt-0.5"><?php echo (int) $counts['berkelanjutan']; ?> RAKB / LKB</span>
                </div>
            </button>

            <!-- Tab 5: Laporan Lainnya -->
            <button 
                type="button" 
                data-tab="lainnya"
                data-active-classes="<?php echo esc_attr( $theme_lainnya['tab_active'] ); ?>"
                data-inactive-classes="<?php echo esc_attr( $theme_lainnya['tab_inactive'] ); ?>"
                data-icon-active="bg-white/20 text-white"
                data-icon-inactive="<?php echo esc_attr( $theme_lainnya['icon_box'] ); ?>"
                class="laporan-tab-btn flex items-center gap-3 p-3.5 sm:p-4 rounded-2xl border transition-all duration-300 text-left <?php echo esc_attr( $theme_lainnya['tab_inactive'] ); ?> group cursor-pointer"
            >
                <div class="tab-icon-box w-10 h-10 rounded-xl <?php echo esc_attr( $theme_lainnya['icon_box'] ); ?> flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <span class="text-xs sm:text-sm font-extrabold block leading-tight truncate">Laporan Lainnya</span>
                    <span class="text-[11px] opacity-80 block mt-0.5"><?php echo (int) $counts['lainnya']; ?> Dokumen Khusus</span>
                </div>
            </button>
        </div>
    </div>
</section>

<!-- ========================================================================
     SECTION 3: STICKY SUB-FILTERS & INSTANT SEARCH TOOLBAR
     ======================================================================== -->
<section class="py-4 sticky top-16 md:top-20 z-30 bg-white/90 dark:bg-dark-surface/90 backdrop-blur-xl border-b border-slate-200/80 dark:border-dark-border/80 shadow-xs transition-colors duration-300">
    <div class="container-wide">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            
            <!-- Left: Search Box -->
            <div class="relative w-full lg:w-80">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input 
                    type="text" 
                    id="laporan-search-input" 
                    placeholder="Cari judul laporan, status audit, atau periode..." 
                    class="w-full pl-10 pr-10 py-2.5 rounded-2xl bg-slate-50 dark:bg-dark-surface-alt border border-slate-200 dark:border-dark-border text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-xs transition-all"
                >
                <button 
                    type="button" 
                    id="laporan-search-clear" 
                    class="hidden absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors"
                    aria-label="Bersihkan pencarian"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Center/Right: Year & Period Filters -->
            <div class="flex flex-wrap items-center gap-2 overflow-x-auto pb-1 lg:pb-0 scrollbar-none">
                
                <!-- Year Pills -->
                <div class="flex items-center gap-1.5 p-1 rounded-2xl bg-slate-100 dark:bg-dark-surface-alt border border-slate-200/80 dark:border-dark-border" id="laporan-year-group">
                    <button 
                        type="button" 
                        data-year="all" 
                        class="laporan-year-btn active-year px-3 py-1.5 rounded-xl text-xs font-bold transition-all duration-200 bg-white dark:bg-dark-card text-teal-700 dark:text-teal-300 shadow-xs cursor-pointer"
                    >
                        Semua Tahun
                    </button>
                    <?php foreach ( $available_years as $yr ) : ?>
                        <button 
                            type="button" 
                            data-year="<?php echo esc_attr( $yr ); ?>" 
                            class="laporan-year-btn px-3 py-1.5 rounded-xl text-xs font-bold transition-all duration-200 text-slate-600 dark:text-slate-300 hover:text-teal-600 dark:hover:text-teal-400 cursor-pointer"
                        >
                            <?php echo esc_html( $yr ); ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <!-- Triwulan Pills (Shown dynamically only when 'triwulan' tab is active) -->
                <div class="hidden items-center gap-1.5 p-1 rounded-2xl bg-emerald-50/90 dark:bg-emerald-950/60 border border-emerald-200/90 dark:border-emerald-800/80 shadow-xs transition-all" id="laporan-tw-group">
                    <span class="hidden sm:inline-flex items-center pl-2 pr-1 text-[11px] font-extrabold text-emerald-800 dark:text-emerald-300 uppercase tracking-wider select-none">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>
                        TW:
                    </span>
                    <button 
                        type="button" 
                        data-tw="all" 
                        class="laporan-tw-btn active-tw px-3 py-1.5 rounded-xl text-xs font-black transition-all duration-200 bg-emerald-600 text-white shadow-sm shadow-emerald-600/30 cursor-pointer"
                    >
                        Semua TW
                    </button>
                    <button type="button" data-tw="triwulan i" class="laporan-tw-btn px-2.5 py-1.5 rounded-xl text-xs font-bold transition-all duration-200 text-emerald-800 dark:text-emerald-300 hover:bg-emerald-100/80 dark:hover:bg-emerald-900/50 hover:text-emerald-950 dark:hover:text-emerald-100 cursor-pointer">TW I</button>
                    <button type="button" data-tw="triwulan ii" class="laporan-tw-btn px-2.5 py-1.5 rounded-xl text-xs font-bold transition-all duration-200 text-emerald-800 dark:text-emerald-300 hover:bg-emerald-100/80 dark:hover:bg-emerald-900/50 hover:text-emerald-950 dark:hover:text-emerald-100 cursor-pointer">TW II</button>
                    <button type="button" data-tw="triwulan iii" class="laporan-tw-btn px-2.5 py-1.5 rounded-xl text-xs font-bold transition-all duration-200 text-emerald-800 dark:text-emerald-300 hover:bg-emerald-100/80 dark:hover:bg-emerald-900/50 hover:text-emerald-950 dark:hover:text-emerald-100 cursor-pointer">TW III</button>
                    <button type="button" data-tw="triwulan iv" class="laporan-tw-btn px-2.5 py-1.5 rounded-xl text-xs font-bold transition-all duration-200 text-emerald-800 dark:text-emerald-300 hover:bg-emerald-100/80 dark:hover:bg-emerald-900/50 hover:text-emerald-950 dark:hover:text-emerald-100 cursor-pointer">TW IV</button>
                </div>

            </div>
        </div>

        <!-- Real-time Count & Status -->
        <div class="pt-3 flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
            <div>
                Menampilkan <span id="laporan-count" class="font-extrabold text-teal-600 dark:text-teal-400"><?php echo count( $all_laporan ); ?></span> dokumen laporan resmi
            </div>
            <div class="hidden sm:block text-[11px] text-slate-400 dark:text-slate-500">
                Klik tombol Pratinjau untuk membaca langsung di peramban atau Unduh untuk berkas PDF
            </div>
        </div>
    </div>
</section>

<!-- ========================================================================
     SECTION 4: LAPORAN GRID CARDS COLLECTION
     ======================================================================== -->
<section class="py-12 md:py-16 bg-transparent min-h-[550px] relative">
    <div class="container-wide relative z-10">
        
        <!-- Grid Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8" id="laporan-grid-container">
            <?php foreach ( $all_laporan as $index => $item ) : 
                $lap_id     = $item['id'] ?? 'rep-' . $index;
                $kategori   = $item['kategori'] ?? 'triwulan';
                if ( $kategori === 'lkb' ) {
                    $kategori = 'berkelanjutan';
                }
                $tahun      = $item['tahun'] ?? '2024';
                $periode    = $item['periode'] ?? '';
                $judul      = $item['judul'] ?? 'Laporan Keuangan Publikasi';
                $file_url   = $item['file_url'] ?? '';
                $file_size  = ! empty( $item['file_size'] ) ? $item['file_size'] : 'PDF • 2.0 MB';
                $tgl_pub    = ! empty( $item['tgl_publikasi'] ) ? $item['tgl_publikasi'] : 'Dipublikasikan';
                $audit      = ! empty( $item['status_audit'] ) ? $item['status_audit'] : 'Resmi OJK';
                $keterangan = ! empty( $item['keterangan'] ) ? $item['keterangan'] : 'Publikasi resmi transparansi keuangan dan kinerja BPRS Wakalumi.';
                $theme      = wakalumi_get_laporan_theme( $kategori );

                // Keywords untuk live search
                $search_meta = strtolower( $judul . ' ' . $kategori . ' ' . $tahun . ' ' . $periode . ' ' . $audit . ' ' . $keterangan );
            ?>
                <!-- Individual Report Card -->
                <div 
                    class="laporan-card group flex flex-col justify-between rounded-3xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200/90 dark:border-dark-border <?php echo esc_attr( $theme['hover_border'] ); ?> shadow-sm hover:shadow-xl <?php echo esc_attr( $theme['hover_shadow'] ); ?> hover:-translate-y-1.5 transition-all duration-300 overflow-hidden relative"
                    data-kategori="<?php echo esc_attr( $kategori ); ?>"
                    data-tahun="<?php echo esc_attr( $tahun ); ?>"
                    data-periode="<?php echo esc_attr( strtolower( $periode ) ); ?>"
                    data-title="<?php echo esc_attr( strtolower( $judul ) ); ?>"
                    data-keywords="<?php echo esc_attr( $search_meta ); ?>"
                >
                    <!-- Top Accent Gradient -->
                    <div class="h-2 w-full bg-gradient-to-r <?php echo esc_attr( $theme['top_border'] ); ?> relative z-20 flex-shrink-0"></div>

                    <!-- Upper Zone: Header Badges & Document Identity -->
                    <div class="p-6 pb-4">
                        
                        <!-- Top Badges Row -->
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="px-2.5 py-1 rounded-lg text-[10px] font-extrabold uppercase tracking-wider border <?php echo esc_attr( $theme['badge_style'] ); ?>">
                                <?php echo esc_html( ! empty( $periode ) ? $periode : ucfirst( $kategori ) ); ?>
                            </span>
                            <span class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-dark-surface-alt text-slate-700 dark:text-slate-300 text-[10px] font-bold border border-slate-200/80 dark:border-dark-border">
                                Tahun <?php echo esc_html( $tahun ); ?>
                            </span>
                        </div>

                        <!-- Document Icon Sheet & Title -->
                        <div class="flex items-start gap-3.5 mb-3">
                            <div class="w-12 h-14 rounded-xl border border-slate-200 dark:border-dark-border shadow-xs flex flex-col items-center justify-center p-1.5 group-hover:scale-105 transition-transform flex-shrink-0 <?php echo esc_attr( $theme['icon_box'] ); ?>">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                                <span class="text-[8px] font-black uppercase mt-0.5">PDF</span>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-base font-bold text-slate-900 dark:text-white leading-snug <?php echo esc_attr( $theme['title_hover'] ); ?> transition-colors line-clamp-2">
                                    <?php echo esc_html( $judul ); ?>
                                </h3>
                                <div class="flex items-center gap-1.5 mt-1 text-[11px] text-slate-500 dark:text-slate-400">
                                    <svg class="w-3.5 h-3.5 text-teal-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    <span class="truncate"><?php echo esc_html( $audit ); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Description Summary -->
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed line-clamp-2 mb-4">
                            <?php echo esc_html( $keterangan ); ?>
                        </p>

                        <!-- Meta Info Strip -->
                        <div class="pt-3 border-t border-slate-100 dark:border-dark-border/80 flex items-center justify-between text-[11px] text-slate-500 dark:text-slate-400">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <?php echo esc_html( $tgl_pub ); ?>
                            </span>
                            <span class="font-medium text-slate-400 dark:text-slate-500"><?php echo esc_html( $file_size ); ?></span>
                        </div>

                    </div>

                    <!-- Lower Zone: Action Buttons (Preview & Download) -->
                    <div class="p-4 bg-slate-50/80 dark:bg-dark-surface-alt/70 border-t border-slate-100 dark:border-dark-border/80 flex items-center gap-2.5">
                        <!-- Preview Lightbox Button -->
                        <button 
                            type="button" 
                            class="laporan-preview-btn flex-1 inline-flex items-center justify-center gap-1.5 py-2.5 px-3.5 rounded-xl border border-slate-200 dark:border-dark-border bg-white dark:bg-dark-card <?php echo esc_attr( $theme['btn_preview'] ); ?> text-slate-700 dark:text-slate-200 text-xs font-bold transition-all duration-200 shadow-xs cursor-pointer"
                            data-pdf="<?php echo esc_url( $file_url ); ?>"
                            data-title="<?php echo esc_attr( $judul ); ?>"
                            data-size="<?php echo esc_attr( $file_size ); ?>"
                        >
                            <svg class="w-4 h-4 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span>Pratinjau</span>
                        </button>

                        <!-- Direct Download Button -->
                        <?php if ( ! empty( $file_url ) ) : ?>
                            <a 
                                href="<?php echo esc_url( $file_url ); ?>" 
                                download 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="inline-flex items-center justify-center gap-1.5 py-2.5 px-4 rounded-xl <?php echo esc_attr( $theme['btn_action'] ); ?> text-xs font-extrabold transition-all duration-200 shadow-xs hover:scale-[1.02]"
                                title="Unduh Berkas PDF Resmi"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                <span>Unduh</span>
                            </a>
                        <?php else : ?>
                            <button 
                                type="button" 
                                class="laporan-preview-btn inline-flex items-center justify-center gap-1.5 py-2.5 px-4 rounded-xl <?php echo esc_attr( $theme['btn_action'] ); ?> text-xs font-extrabold transition-all duration-200 shadow-xs hover:scale-[1.02] cursor-pointer"
                                data-pdf=""
                                data-title="<?php echo esc_attr( $judul ); ?>"
                                data-size="<?php echo esc_attr( $file_size ); ?>"
                                title="Unduh Berkas PDF Resmi"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                <span>Unduh</span>
                            </button>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

        <!-- Empty State Container (When Filters/Search have no results) -->
        <div id="laporan-empty-state" class="hidden flex-col items-center justify-center py-16 px-6 text-center bg-white/60 dark:bg-dark-card/60 backdrop-blur-md rounded-3xl border border-dashed border-slate-300 dark:border-dark-border my-8 max-w-xl mx-auto" style="display: none;">
            <div class="w-16 h-16 rounded-2xl bg-teal-50 dark:bg-teal-950/80 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375H8.25m5.25 11.25h-5.25A2.25 2.25 0 016 19.5V4.5A2.25 2.25 0 018.25 2.25h7.5A2.25 2.25 0 0118 4.5v6.75m-6 3.75l2.25 2.25 4.5-4.5" /></svg>
            </div>
            <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-1.5" id="laporan-empty-title">Tidak Ada Dokumen yang Sesuai</h4>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 max-w-md mb-5 leading-relaxed" id="laporan-empty-desc">
                Tidak ditemukan dokumen laporan untuk kriteria pencarian atau filter yang dipilih. Silakan coba kata kunci lain atau reset filter.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-3">
                <button 
                    type="button" 
                    id="laporan-reset-year-btn" 
                    class="px-4 py-2.5 rounded-xl bg-teal-50 dark:bg-teal-950/80 text-teal-700 dark:text-teal-300 hover:bg-teal-100 dark:hover:bg-teal-900/60 border border-teal-200/80 dark:border-teal-800 text-xs font-bold transition-all duration-200 cursor-pointer"
                >
                    Lihat Semua Tahun Kategori Ini
                </button>
                <button 
                    type="button" 
                    id="laporan-reset-btn" 
                    class="px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold shadow-sm transition-all duration-200 cursor-pointer"
                >
                    Reset Semua Filter
                </button>
            </div>
        </div>

    </div>
</section>

<!-- ========================================================================
     SECTION 5: REGULATORY COMPLIANCE & INVESTOR CONTACT BANNER
     ======================================================================== -->
<section class="py-14 lg:py-20 bg-transparent relative">
    <div class="container-wide">
        <div class="max-w-4xl mx-auto p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-slate-900 via-slate-900 to-teal-950 text-white text-center relative overflow-hidden shadow-2xl group" data-aos="fade-up">
            <!-- Background Watermark Emblem -->
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:scale-110 group-hover:opacity-[0.06] select-none">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-full h-full object-contain" loading="lazy">
            </div>

            <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-wider text-teal-300 bg-teal-950/80 px-3.5 py-1.5 rounded-full border border-teal-800 mb-1">
                    <svg class="w-3.5 h-3.5 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.333A48.272 48.272 0 0012 9.75c-2.551 0-5.056.2-7.5.583V21" /></svg>
                    Kepatuhan &amp; Akuntabilitas Publik
                </span>
                
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight text-white">
                    Komitmen Tata Kelola BPRS Wakalumi
                </h3>
                
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                    <?php echo esc_html( $header_cfg['disclaimer'] ); ?>
                </p>

                <p class="text-xs text-slate-400 leading-relaxed pt-2">
                    Untuk pertanyaan mengenai laporan publikasi, permintaan dokumen cetak, atau konfirmasi audit, silakan hubungi Bagian Kepatuhan / Sekretariat Perusahaan BPRS Wakalumi.
                </p>

                <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                    <a 
                        href="<?php echo esc_url( $default_wa_link ); ?>" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="relative overflow-hidden group/btn py-3.5 px-6 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-400 hover:from-teal-400 hover:to-cyan-300 text-slate-950 font-black text-sm inline-flex items-center gap-2 shadow-lg transition-transform hover:scale-105"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>Hubungi Sekretariat Bank</span>
                    </a>
                    <a 
                        href="<?php echo esc_url( home_url( '/profil/legalitas/' ) ); ?>" 
                        class="py-3.5 px-6 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-sm border border-slate-700 inline-flex items-center gap-2 transition-colors"
                    >
                        <svg class="w-4 h-4 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                        <span>Lihat Legalitas Perusahaan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================================
     SECTION 6: INTERACTIVE PDF LIGHTBOX MODAL
     ======================================================================== -->
<div 
    id="laporan-preview-modal" 
    class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-4 md:p-6" 
    role="dialog" 
    aria-modal="true" 
    aria-labelledby="laporan-modal-title"
>
    <!-- Modal Backdrop Blur -->
    <div 
        id="laporan-modal-backdrop" 
        class="absolute inset-0 bg-slate-950/80 backdrop-blur-md opacity-0 transition-opacity duration-300"
    ></div>

    <!-- Modal Container -->
    <div 
        id="laporan-modal-container" 
        class="relative w-full max-w-5xl h-[92vh] md:h-[88vh] bg-white dark:bg-dark-card rounded-3xl shadow-2xl border border-slate-200 dark:border-dark-border flex flex-col overflow-hidden scale-95 opacity-0 transition-all duration-300 z-10"
    >
        <!-- Modal Top Header Bar -->
        <div class="px-4 py-3 sm:px-6 sm:py-3.5 bg-slate-50 dark:bg-dark-surface-alt border-b border-slate-200 dark:border-dark-border flex items-center justify-between gap-3 flex-shrink-0">
            <!-- Left: Document Title & Meta -->
            <div class="flex items-center gap-3 overflow-hidden min-w-0 flex-1">
                <div class="w-9 h-9 rounded-xl bg-teal-500/10 dark:bg-teal-400/10 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <div class="overflow-hidden min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300">
                            Pratinjau Dokumen
                        </span>
                        <span id="laporan-modal-size" class="text-[11px] text-slate-400 font-medium truncate"></span>
                    </div>
                    <h3 id="laporan-modal-title" class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white truncate">
                        Laporan Publikasi Bank
                    </h3>
                </div>
            </div>

            <!-- Center: Reader Toolbar (Page Jump & Zoom) -->
            <div id="laporan-pdf-toolbar" class="hidden sm:flex items-center gap-2 px-3 py-1 rounded-xl bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border shadow-xs">
                <!-- Page Navigator -->
                <div class="flex items-center gap-1.5 text-xs text-slate-600 dark:text-slate-300">
                    <span class="font-medium">Hal:</span>
                    <select id="laporan-pdf-page-select" class="px-2 py-0.5 rounded-lg bg-slate-100 dark:bg-dark-surface border border-slate-300 dark:border-dark-border text-xs font-bold text-slate-800 dark:text-slate-100 cursor-pointer focus:outline-none focus:ring-1 focus:ring-teal-500">
                        <option value="1">1</option>
                    </select>
                    <span>/ <strong id="laporan-pdf-total-pages" class="text-teal-600 dark:text-teal-400">1</strong></span>
                </div>

                <span class="w-px h-4 bg-slate-200 dark:bg-dark-border mx-1"></span>

                <!-- Zoom Controls -->
                <button type="button" id="laporan-pdf-zoom-out" class="p-1 rounded-lg text-slate-600 hover:text-teal-600 dark:text-slate-300 dark:hover:text-teal-400 hover:bg-slate-100 dark:hover:bg-dark-surface-alt transition-colors cursor-pointer" title="Perkecil (-)">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15"/></svg>
                </button>
                <span id="laporan-pdf-zoom-level" class="text-[11px] font-bold text-slate-700 dark:text-slate-200 min-w-[38px] text-center select-none">100%</span>
                <button type="button" id="laporan-pdf-zoom-in" class="p-1 rounded-lg text-slate-600 hover:text-teal-600 dark:text-slate-300 dark:hover:text-teal-400 hover:bg-slate-100 dark:hover:bg-dark-surface-alt transition-colors cursor-pointer" title="Perbesar (+)">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                </button>
                <button type="button" id="laporan-pdf-fit" class="px-2 py-0.5 rounded-lg text-[11px] font-bold text-slate-600 hover:text-teal-600 dark:text-slate-300 dark:hover:text-teal-400 hover:bg-slate-100 dark:hover:bg-dark-surface-alt transition-colors cursor-pointer" title="Sesuaikan Lebar Layar">
                    Fit
                </button>
            </div>

            <!-- Right: Actions (Download, Close) -->
            <div class="flex items-center gap-2 flex-shrink-0">
                <!-- Download Directly -->
                <a 
                    id="laporan-modal-download" 
                    href="#" 
                    download 
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs shadow transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                    <span class="hidden sm:inline">Unduh PDF</span>
                </a>

                <!-- Close Modal Button -->
                <button 
                    type="button" 
                    id="laporan-modal-close" 
                    class="p-2 rounded-xl text-slate-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/40 transition-colors cursor-pointer"
                    aria-label="Tutup pratinjau"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Modal Body (PDF Viewer Canvas Container with Loading Spinner & Empty State) -->
        <div class="relative flex-1 w-full h-full bg-slate-900 overflow-hidden flex flex-col">
            <!-- Loading Indicator -->
            <div id="laporan-modal-loading" class="absolute inset-0 flex flex-col items-center justify-center bg-white/95 dark:bg-dark-card/95 z-20 transition-opacity duration-300">
                <div class="w-10 h-10 border-3 border-teal-500 border-t-transparent rounded-full animate-spin mb-3"></div>
                <p class="text-xs text-slate-600 dark:text-slate-300 font-medium">Memuat pratinjau dokumen laporan...</p>
                <span id="laporan-pdf-loading-detail" class="text-[11px] text-slate-400 mt-1">Mengambil berkas dari peladen</span>
            </div>

            <!-- In-Theme Empty State Notice (When PDF is not yet uploaded) -->
            <div id="laporan-modal-empty" class="hidden absolute inset-0 z-30 flex flex-col items-center justify-center p-6 text-center bg-white/95 dark:bg-dark-card/95 backdrop-blur-md">
                <div class="relative w-20 h-20 rounded-3xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-5 shadow-lg shadow-emerald-500/10">
                    <div class="absolute inset-0 rounded-3xl bg-emerald-400/20 blur-md animate-pulse"></div>
                    <svg class="w-10 h-10 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-50 dark:bg-amber-950/60 border border-amber-200 dark:border-amber-800 text-amber-700 dark:text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                    Dokumen Sedang Dalam Proses Finalisasi
                </div>
                <h4 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white max-w-lg mb-2 leading-snug">
                    Berkas PDF Sedang Dipersiapkan
                </h4>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 max-w-md mb-6 leading-relaxed">
                    Dokumen resmi <span id="laporan-empty-doc-title" class="font-bold text-slate-800 dark:text-slate-200"></span> saat ini sedang dalam proses sinkronisasi dan pengesahan otoritas.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a 
                        id="laporan-modal-wa-fallback" 
                        href="<?php echo esc_url( $default_wa_link ); ?>" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-400 hover:from-teal-400 hover:to-cyan-300 text-slate-950 font-extrabold text-xs shadow-md transition-all duration-200 hover:scale-105"
                    >
                        <svg class="w-4 h-4 text-slate-950" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span>Minta Informasi via WhatsApp</span>
                    </a>
                    <button 
                        type="button" 
                        onclick="document.getElementById('laporan-modal-close').click()" 
                        class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-dark-surface hover:bg-slate-200 dark:hover:bg-dark-surface-alt text-slate-700 dark:text-slate-300 font-bold text-xs border border-slate-200 dark:border-dark-border transition-colors cursor-pointer"
                    >
                        Tutup Pratinjau
                    </button>
                </div>
            </div>

            <!-- Native HTML5 Canvas Multi-Page Viewer Container (Rendered via PDF.js Canvas, 100% immune to IDM auto-download & Edge OOPIF block) -->
            <div 
                id="laporan-pdf-canvas-container" 
                class="flex-1 w-full h-full overflow-y-auto overflow-x-auto p-4 sm:p-8 flex flex-col items-center gap-6 scroll-smooth bg-slate-900"
            >
                <!-- Pages will be rendered progressively here -->
            </div>
        </div>
    </div>
</div>

<!-- Inline Fallback Runner -->
<script>
(function() {
    function runLaporan() {
        if (typeof LaporanModule !== 'undefined' && LaporanModule.init) {
            LaporanModule.init();
        }
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', runLaporan);
    } else {
        runLaporan();
    }
})();
</script>

<?php
get_footer();
