<?php
/**
 * Template Name: Tabungan Syariah
 * Description: Halaman Katalog Produk Penghimpunan Dana (Tabungan Tawakal, Pendidikan, Haji & Umroh, Ukhuwah Berhadiah)
 *              100% Terintegrasi Dinamis dengan Admin Panel Wakalumi.
 *
 * @package Wakalumi
 */

get_header();

// ── AMBIL DATA HEADER DARI WP_OPTIONS ─────────────────────────────
$tab_page_badge = get_option( 'options_tabungan_page_badge', 'Penghimpunan Dana Syariah' );
$tab_page_title = get_option( 'options_tabungan_page_title', 'Simpanan Berkah Sesuai Syariah' );
$tab_page_sub   = get_option( 'options_tabungan_page_subtitle', 'Solusi simpanan syariah amanah, bebas biaya administrasi bulanan, bagi hasil bersaing, dan dijamin LPS hingga Rp 2 Miliar.' );

// ── AMBIL DAFTAR PRODUK DINAMIS DARI HELPER ADMIN PRODUK ──────────
$tabungan_list = function_exists( 'wakalumi_get_tabungan_list' ) ? wakalumi_get_tabungan_list() : [];

// ── PENGATURAN KALKULATOR DARI ADMIN ─────────────────────────────
$calc_badge = get_option( 'options_tabungan_calc_badge', 'Simulasi Finansial Syariah' );
$calc_title = get_option( 'options_tabungan_calc_title', 'Kalkulator Rencana Menabung Berkah' );
$calc_sub   = get_option( 'options_tabungan_calc_subtitle', 'Tentukan target impian Anda—mulai dari porsi haji, dana sekolah anak, program tabungan ukhuwah, hingga simpanan masa depan keluarga. Kami hitungkan estimasi sisihan per bulan.' );

// ── PENGATURAN TANYA JAWAB (FAQ) DARI ADMIN ───────────────────────
$faq_badge  = get_option( 'options_tabungan_faq_badge', 'Tanya Jawab (FAQ)' );
$faq_title  = get_option( 'options_tabungan_faq_title', 'Pertanyaan Seputar Tabungan' );
$faq_sub    = get_option( 'options_tabungan_faq_subtitle', 'Pertanyaan umum nasabah seputar produk simpanan syariah, keamanan simpanan di LPS, dan prosedur pembukaan rekening.' );
$faq_list   = function_exists( 'wakalumi_get_tabungan_faq_list' ) ? wakalumi_get_tabungan_faq_list() : [];

// WhatsApp Hotline
$default_wa = get_option( 'options_contact_wa', '6281517380388' );
$wa_number  = get_option( 'options_produk_wa_number', $default_wa );
$clean_wa   = preg_replace( '/[^0-9]/', '', $wa_number );

// Brosur File
$brosur_url  = get_option( 'options_brosur_file_url', '' );
$brosur_name = get_option( 'options_brosur_file_name', 'Brosur Resmi BPRS Wakalumi (PDF)' );

// Helper to convert lines to array
if ( ! function_exists( 'wakalumi_lines_to_list' ) ) {
    function wakalumi_lines_to_list( $text ) {
        $lines = explode( "\n", str_replace( "\r", "", $text ) );
        return array_filter( array_map( 'trim', $lines ) );
    }
}

// 10 Color Themes Palette (Full Support for Admin Repeater)
$color_themes = [
    'teal' => [
        'pill_dot'     => 'bg-teal-500',
        'pill_hover'   => 'hover:border-teal-500 hover:text-teal-600 dark:hover:text-teal-400',
        'card_border'  => 'border-teal-200/80 dark:border-teal-900/60',
        'glow_bg'      => 'bg-teal-500/10',
        'badge_bg'     => 'bg-teal-100 dark:bg-teal-950 text-teal-800 dark:text-teal-300 border-teal-200 dark:border-teal-800',
        'tagline_text' => 'text-teal-700 dark:text-teal-400',
        'icon_color'   => 'text-teal-600 dark:text-teal-400',
        'icon_bg'      => 'bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-300',
        'min_text'     => 'text-teal-700 dark:text-teal-400',
        'dot_color'    => 'text-teal-600',
        'btn_bg'       => 'bg-teal-600 hover:bg-teal-700 text-white shadow-teal-600/20',
        'th_text'      => 'text-teal-700 dark:text-teal-300',
        'table_min'    => 'text-teal-600 dark:text-teal-400',
    ],
    'blue' => [
        'pill_dot'     => 'bg-blue-500',
        'pill_hover'   => 'hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400',
        'card_border'  => 'border-blue-200/80 dark:border-blue-900/60',
        'glow_bg'      => 'bg-blue-500/10',
        'badge_bg'     => 'bg-blue-100 dark:bg-blue-950 text-blue-800 dark:text-blue-300 border-blue-200 dark:border-blue-800',
        'tagline_text' => 'text-blue-700 dark:text-blue-400',
        'icon_color'   => 'text-blue-600 dark:text-blue-400',
        'icon_bg'      => 'bg-blue-50 dark:bg-blue-900/50 text-blue-600 dark:text-blue-300',
        'min_text'     => 'text-blue-700 dark:text-blue-400',
        'dot_color'    => 'text-blue-600',
        'btn_bg'       => 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-600/20',
        'th_text'      => 'text-blue-700 dark:text-blue-300',
        'table_min'    => 'text-blue-600 dark:text-blue-400',
    ],
    'amber' => [
        'pill_dot'     => 'bg-amber-500',
        'pill_hover'   => 'hover:border-amber-500 hover:text-amber-600 dark:hover:text-amber-400',
        'card_border'  => 'border-amber-200/80 dark:border-amber-900/60',
        'glow_bg'      => 'bg-amber-500/10',
        'badge_bg'     => 'bg-amber-100 dark:bg-amber-950 text-amber-900 dark:text-amber-300 border-amber-200 dark:border-amber-800',
        'tagline_text' => 'text-amber-700 dark:text-amber-400',
        'icon_color'   => 'text-amber-600 dark:text-amber-400',
        'icon_bg'      => 'bg-amber-50 dark:bg-amber-900/50 text-amber-600 dark:text-amber-300',
        'min_text'     => 'text-amber-700 dark:text-amber-400',
        'dot_color'    => 'text-amber-600',
        'btn_bg'       => 'bg-amber-600 hover:bg-amber-700 text-white shadow-amber-600/20',
        'th_text'      => 'text-amber-700 dark:text-amber-300',
        'table_min'    => 'text-amber-600 dark:text-amber-400',
    ],
    'purple' => [
        'pill_dot'     => 'bg-purple-500',
        'pill_hover'   => 'hover:border-purple-500 hover:text-purple-600 dark:hover:text-purple-400',
        'card_border'  => 'border-purple-200/80 dark:border-purple-900/60',
        'glow_bg'      => 'bg-purple-500/10',
        'badge_bg'     => 'bg-purple-100 dark:bg-purple-950 text-purple-900 dark:text-purple-300 border-purple-200 dark:border-purple-800',
        'tagline_text' => 'text-purple-700 dark:text-purple-400',
        'icon_color'   => 'text-purple-600 dark:text-purple-400',
        'icon_bg'      => 'bg-purple-50 dark:bg-purple-900/50 text-purple-600 dark:text-purple-300',
        'min_text'     => 'text-purple-700 dark:text-purple-400',
        'dot_color'    => 'text-purple-600',
        'btn_bg'       => 'bg-purple-600 hover:bg-purple-700 text-white shadow-purple-600/20',
        'th_text'      => 'text-purple-700 dark:text-purple-300',
        'table_min'    => 'text-purple-600 dark:text-purple-400',
    ],
    'emerald' => [
        'pill_dot'     => 'bg-emerald-500',
        'pill_hover'   => 'hover:border-emerald-500 hover:text-emerald-600 dark:hover:text-emerald-400',
        'card_border'  => 'border-emerald-200/80 dark:border-emerald-900/60',
        'glow_bg'      => 'bg-emerald-500/10',
        'badge_bg'     => 'bg-emerald-100 dark:bg-emerald-950 text-emerald-900 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800',
        'tagline_text' => 'text-emerald-700 dark:text-emerald-400',
        'icon_color'   => 'text-emerald-600 dark:text-emerald-400',
        'icon_bg'      => 'bg-emerald-50 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-300',
        'min_text'     => 'text-emerald-700 dark:text-emerald-400',
        'dot_color'    => 'text-emerald-600',
        'btn_bg'       => 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/20',
        'th_text'      => 'text-emerald-700 dark:text-emerald-300',
        'table_min'    => 'text-emerald-600 dark:text-emerald-400',
    ],
    'indigo' => [
        'pill_dot'     => 'bg-indigo-500',
        'pill_hover'   => 'hover:border-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400',
        'card_border'  => 'border-indigo-200/80 dark:border-indigo-900/60',
        'glow_bg'      => 'bg-indigo-500/10',
        'badge_bg'     => 'bg-indigo-100 dark:bg-indigo-950 text-indigo-900 dark:text-indigo-300 border-indigo-200 dark:border-indigo-800',
        'tagline_text' => 'text-indigo-700 dark:text-indigo-400',
        'icon_color'   => 'text-indigo-600 dark:text-indigo-400',
        'icon_bg'      => 'bg-indigo-50 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-300',
        'min_text'     => 'text-indigo-700 dark:text-indigo-400',
        'dot_color'    => 'text-indigo-600',
        'btn_bg'       => 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-indigo-600/20',
        'th_text'      => 'text-indigo-700 dark:text-indigo-300',
        'table_min'    => 'text-indigo-600 dark:text-indigo-400',
    ],
    'cyan' => [
        'pill_dot'     => 'bg-cyan-500',
        'pill_hover'   => 'hover:border-cyan-500 hover:text-cyan-600 dark:hover:text-cyan-400',
        'card_border'  => 'border-cyan-200/80 dark:border-cyan-900/60',
        'glow_bg'      => 'bg-cyan-500/10',
        'badge_bg'     => 'bg-cyan-100 dark:bg-cyan-950 text-cyan-900 dark:text-cyan-300 border-cyan-200 dark:border-cyan-800',
        'tagline_text' => 'text-cyan-700 dark:text-cyan-400',
        'icon_color'   => 'text-cyan-600 dark:text-cyan-400',
        'icon_bg'      => 'bg-cyan-50 dark:bg-cyan-900/50 text-cyan-600 dark:text-cyan-300',
        'min_text'     => 'text-cyan-700 dark:text-cyan-400',
        'dot_color'    => 'text-cyan-600',
        'btn_bg'       => 'bg-cyan-600 hover:bg-cyan-700 text-white shadow-cyan-600/20',
        'th_text'      => 'text-cyan-700 dark:text-cyan-300',
        'table_min'    => 'text-cyan-600 dark:text-cyan-400',
    ],
    'rose' => [
        'pill_dot'     => 'bg-rose-500',
        'pill_hover'   => 'hover:border-rose-500 hover:text-rose-600 dark:hover:text-rose-400',
        'card_border'  => 'border-rose-200/80 dark:border-rose-900/60',
        'glow_bg'      => 'bg-rose-500/10',
        'badge_bg'     => 'bg-rose-100 dark:bg-rose-950 text-rose-900 dark:text-rose-300 border-rose-200 dark:border-rose-800',
        'tagline_text' => 'text-rose-700 dark:text-rose-400',
        'icon_color'   => 'text-rose-600 dark:text-rose-400',
        'icon_bg'      => 'bg-rose-50 dark:bg-rose-900/50 text-rose-600 dark:text-rose-300',
        'min_text'     => 'text-rose-700 dark:text-rose-400',
        'dot_color'    => 'text-rose-600',
        'btn_bg'       => 'bg-rose-600 hover:bg-rose-700 text-white shadow-rose-600/20',
        'th_text'      => 'text-rose-700 dark:text-rose-300',
        'table_min'    => 'text-rose-600 dark:text-rose-400',
    ],
    'orange' => [
        'pill_dot'     => 'bg-orange-500',
        'pill_hover'   => 'hover:border-orange-500 hover:text-orange-600 dark:hover:text-orange-400',
        'card_border'  => 'border-orange-200/80 dark:border-orange-900/60',
        'glow_bg'      => 'bg-orange-500/10',
        'badge_bg'     => 'bg-orange-100 dark:bg-orange-950 text-orange-900 dark:text-orange-300 border-orange-200 dark:border-orange-800',
        'tagline_text' => 'text-orange-700 dark:text-orange-400',
        'icon_color'   => 'text-orange-600 dark:text-orange-400',
        'icon_bg'      => 'bg-orange-50 dark:bg-orange-900/50 text-orange-600 dark:text-orange-300',
        'min_text'     => 'text-orange-700 dark:text-orange-400',
        'dot_color'    => 'text-orange-600',
        'btn_bg'       => 'bg-orange-600 hover:bg-orange-700 text-white shadow-orange-600/20',
        'th_text'      => 'text-orange-700 dark:text-orange-300',
        'table_min'    => 'text-orange-600 dark:text-orange-400',
    ],
    'slate' => [
        'pill_dot'     => 'bg-slate-500',
        'pill_hover'   => 'hover:border-slate-500 hover:text-slate-700 dark:hover:text-slate-300',
        'card_border'  => 'border-slate-300 dark:border-slate-700',
        'glow_bg'      => 'bg-slate-500/10',
        'badge_bg'     => 'bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-slate-200 border-slate-300 dark:border-slate-700',
        'tagline_text' => 'text-slate-700 dark:text-slate-300',
        'icon_color'   => 'text-slate-700 dark:text-slate-300',
        'icon_bg'      => 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300',
        'min_text'     => 'text-slate-800 dark:text-slate-200',
        'dot_color'    => 'text-slate-600',
        'btn_bg'       => 'bg-slate-800 hover:bg-slate-900 dark:bg-slate-700 dark:hover:bg-slate-600 text-white',
        'th_text'      => 'text-slate-800 dark:text-slate-200',
        'table_min'    => 'text-slate-700 dark:text-slate-300',
    ],
];

// Helper: SVG Icon per Produk
if ( ! function_exists( 'wakalumi_render_tabungan_card_icon' ) ) {
    function wakalumi_render_tabungan_card_icon( $slug ) {
        switch ( $slug ) {
            case 'pendidikan':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>';
            case 'haji-umroh':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>';
            case 'ukhuwah':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v3a2 2 0 01-2 2M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>';
            case 'tawakal':
            default:
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>';
        }
    }
}
?>

<!-- ========================================
     HEADER BANNER & BREADCRUMBS (WITH PAGE WATERMARK)
     ======================================== -->
<section class="relative z-10 pt-8 pb-12 md:pb-16 overflow-hidden bg-slate-50 dark:bg-dark-surface border-b border-slate-200/60 dark:border-slate-800/60">
    <!-- Ambient Blur Background -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-72 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

    <!-- Page Emblem Watermark in Header Banner -->
    <div class="absolute right-4 sm:right-12 top-1/2 -translate-y-1/2 w-72 h-72 sm:w-96 sm:h-96 opacity-[0.045] dark:opacity-[0.03] pointer-events-none select-none overflow-hidden">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-full h-full object-contain filter grayscale contrast-125">
    </div>

    <div class="container-wide relative z-10">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-accent transition-colors flex items-center gap-1.5 font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-slate-500 dark:text-slate-400 font-medium">Produk</span>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-teal-600 dark:text-teal-400 font-semibold">Tabungan Syariah</span>
        </nav>

        <div class="max-w-3xl" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                <?php echo esc_html( $tab_page_badge ); ?>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                <?php echo esc_html( $tab_page_title ); ?>
            </h1>
            <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                <?php echo esc_html( $tab_page_sub ); ?>
            </p>
        </div>

        <!-- Quick Jump Navigation Pills (Dinamis dari Semua Produk Tabungan) -->
        <div class="flex flex-wrap items-center gap-2.5 mt-8 pt-6 border-t border-slate-200/80 dark:border-slate-800/80 text-xs font-bold" data-aos="fade-up" data-aos-delay="100">
            <span class="text-slate-400 uppercase tracking-wider text-[11px] mr-1">Lompat Ke:</span>
            <?php foreach ( $tabungan_list as $prod ) : 
                $c_theme = $color_themes[ $prod['color'] ?? 'teal' ] ?? $color_themes['teal'];
            ?>
                <a href="#<?php echo esc_attr( $prod['slug'] ); ?>" class="px-4 py-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 <?php echo esc_attr( $c_theme['pill_hover'] ); ?> shadow-sm transition-all inline-flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full <?php echo esc_attr( $c_theme['pill_dot'] ); ?>"></span>
                    <?php echo esc_html( $prod['nama'] ); ?>
                </a>
            <?php endforeach; ?>
            <a href="#komparasi" class="px-4 py-2 rounded-xl bg-teal-50 dark:bg-teal-950/50 border border-teal-200 dark:border-teal-800 text-teal-700 dark:text-teal-300 hover:bg-teal-100 dark:hover:bg-teal-900/50 shadow-sm transition-all inline-flex items-center gap-1.5">
                ⚖️ Tabel Perbandingan
            </a>
            <a href="#kalkulator" class="px-4 py-2 rounded-xl bg-primary-50 dark:bg-primary-950/50 border border-primary-200 dark:border-primary-800 text-primary-700 dark:text-teal-300 hover:bg-primary-100 dark:hover:bg-primary-900/50 shadow-sm transition-all inline-flex items-center gap-1.5">
                🧮 Kalkulator Simulasi
            </a>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 1: SHOWCASE PRODUK TABUNGAN (TRANSPARENT VIEWPORT DENGAN GLOBAL STICKY WATERMARK)
     ======================================== -->
<section class="py-14 lg:py-20 bg-transparent relative overflow-hidden">
    <div class="container-wide space-y-16 relative z-10">

        <?php 
        foreach ( $tabungan_list as $prod ) : 
            $c_theme = $color_themes[ $prod['color'] ?? 'teal' ] ?? $color_themes['teal'];
            $keunggulan_arr = wakalumi_lines_to_list( $prod['keunggulan'] ?? '' );
            $syarat_arr     = wakalumi_lines_to_list( $prod['syarat'] ?? '' );
            $wa_cta_text    = ! empty( $prod['wa_text'] ) 
                              ? $prod['wa_text'] 
                              : 'Halo BPRS Wakalumi, saya tertarik membuka rekening ' . $prod['nama'] . '. Mohon informasi prosedur dan persyaratannya.';
        ?>
        <div id="<?php echo esc_attr( $prod['slug'] ); ?>" class="scroll-mt-28 p-6 sm:p-8 lg:p-10 rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border <?php echo esc_attr( $c_theme['card_border'] ); ?> shadow-xl relative overflow-hidden group/card hover:-translate-y-2 hover:shadow-2xl transition-all duration-500 before:absolute before:inset-x-0 before:top-0 before:h-1.5 before:bg-gradient-to-r before:from-transparent before:via-teal-500 before:to-transparent before:opacity-0 group-hover/card:before:opacity-100 before:transition-opacity before:duration-500" data-aos="fade-up">
            
            <!-- 1. Ambient Glow Blob -->
            <div class="absolute -right-20 -top-20 w-80 h-80 <?php echo esc_attr( $c_theme['glow_bg'] ); ?> rounded-full blur-3xl pointer-events-none group-hover/card:scale-125 group-hover/card:opacity-75 transition-all duration-700"></div>

            <!-- 2. Card Logo Emblem Watermark (Subtle Opacity Background) -->
            <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/6 w-64 h-64 sm:w-80 sm:h-80 md:w-96 md:h-96 opacity-[0.05] dark:opacity-[0.04] pointer-events-none select-none overflow-hidden transition-all duration-700 group-hover/card:scale-115 group-hover/card:opacity-[0.08]">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-full h-full object-contain filter grayscale contrast-125">
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start relative z-10">
                <!-- Kolom Kiri: Detail & Keunggulan (7 Kolom) -->
                <div class="lg:col-span-7">
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <span class="px-3 py-1 rounded-lg <?php echo esc_attr( $c_theme['badge_bg'] ); ?> text-xs font-extrabold uppercase tracking-wider border">
                            Akad: <?php echo esc_html( $prod['akad'] ); ?>
                        </span>
                        <?php if ( ! empty( $prod['badge'] ) ) : ?>
                            <span class="px-3 py-1 rounded-lg bg-slate-200/80 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-semibold">
                                <?php echo esc_html( $prod['badge'] ); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mb-2 group-hover/card:text-teal-600 dark:group-hover/card:text-teal-400 transition-colors">
                        <?php echo esc_html( $prod['nama'] ); ?>
                    </h2>
                    <?php if ( ! empty( $prod['tagline'] ) ) : ?>
                        <p class="text-sm font-semibold <?php echo esc_attr( $c_theme['tagline_text'] ); ?> mb-4">
                            <?php echo esc_html( $prod['tagline'] ); ?>
                        </p>
                    <?php endif; ?>
                    
                    <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                        <?php echo nl2br( esc_html( $prod['desc'] ) ); ?>
                    </p>

                    <!-- Poin Keunggulan -->
                    <?php if ( ! empty( $keunggulan_arr ) ) : ?>
                    <div class="mb-6">
                        <h4 class="text-xs font-black uppercase tracking-wider text-slate-400 mb-3">Keunggulan <?php echo esc_html( $prod['nama'] ); ?>:</h4>
                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                            <?php foreach ( $keunggulan_arr as $item ) : ?>
                                <li class="flex items-start gap-2 text-xs sm:text-sm text-slate-700 dark:text-slate-200 font-medium">
                                    <svg class="w-4 h-4 <?php echo esc_attr( $c_theme['icon_color'] ); ?> flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    <span><?php echo esc_html( $item ); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Kolom Kanan: Info Setoran, Syarat & Aksi (5 Kolom) -->
                <div class="lg:col-span-5 bg-white/95 dark:bg-slate-800/95 backdrop-blur-md p-6 sm:p-7 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-md relative overflow-hidden group-hover/card:border-teal-300 dark:group-hover/card:border-teal-700 transition-colors">
                    
                    <!-- Metrics: Setoran & Biaya Admin Bulanan -->
                    <div class="grid grid-cols-2 gap-3 pb-4 mb-4 border-b border-slate-100 dark:border-slate-700/60 items-center">
                        <div>
                            <span class="text-[11px] text-slate-500 dark:text-slate-400 block font-medium">Setoran Awal Minimal</span>
                            <span class="text-xl sm:text-2xl font-black <?php echo esc_attr( $c_theme['min_text'] ); ?>"><?php echo esc_html( $prod['min_setor'] ); ?></span>
                        </div>
                        <div class="text-right">
                            <span class="text-[11px] text-slate-500 dark:text-slate-400 block font-medium">Biaya Bulanan</span>
                            <span class="text-sm sm:text-base font-bold text-emerald-600 dark:text-emerald-400 inline-flex items-center gap-1 justify-end">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                <?php echo esc_html( ! empty( $prod['biaya_admin'] ) ? $prod['biaya_admin'] : 'Gratis / Rp 0' ); ?>
                            </span>
                        </div>
                    </div>

                    <!-- Persyaratan -->
                    <?php if ( ! empty( $syarat_arr ) ) : ?>
                    <div class="mb-6">
                        <h5 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Dokumen Persyaratan:</h5>
                        <ul class="space-y-1.5 text-xs text-slate-600 dark:text-slate-300">
                            <?php foreach ( $syarat_arr as $syarat ) : ?>
                                <li class="flex items-start gap-2">
                                    <span class="<?php echo esc_attr( $c_theme['dot_color'] ); ?> font-bold">•</span>
                                    <span><?php echo esc_html( $syarat ); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- Tombol Aksi -->
                    <div class="space-y-2.5">
                        <a 
                            href="https://wa.me/<?php echo esc_attr( $clean_wa ); ?>?text=<?php echo urlencode( $wa_cta_text ); ?>" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="w-full py-3.5 px-4 rounded-xl <?php echo esc_attr( $c_theme['btn_bg'] ); ?> font-bold text-sm text-center inline-flex items-center justify-center gap-2 shadow-md hover:shadow-xl transition-all duration-300 relative overflow-hidden group/btn"
                        >
                            <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/25 to-transparent -translate-x-full group-hover/btn:translate-x-full transition-transform duration-1000"></span>
                            <svg class="w-4 h-4 group-hover/btn:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            <span>Buka <?php echo esc_html( $prod['nama'] ); ?></span>
                        </a>
                        <a href="#kalkulator" class="w-full py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 font-semibold text-xs text-center inline-flex items-center justify-center gap-1.5 transition-colors group/calc">
                            <span>Hitung Target Tabungan di Kalkulator</span>
                            <span class="group-hover/calc:translate-y-0.5 transition-transform">&darr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</section>

<!-- ========================================
     SECTION 2: TABEL KOMPARASI FITUR TABUNGAN (DINAMIS DARI ADMIN)
     ======================================== -->
<section id="komparasi" class="scroll-mt-24 py-14 lg:py-20 bg-slate-50 dark:bg-dark-surface border-y border-slate-200/80 dark:border-slate-800">
    <div class="container-wide">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="text-xs font-extrabold uppercase tracking-wider text-teal-600 dark:text-teal-400 bg-teal-50 dark:bg-teal-950/60 px-3 py-1 rounded-full border border-teal-200 dark:border-teal-800">
                Perbandingan Produk
            </span>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-3 mb-2">
                Pilih Tabungan yang Tepat untuk Kebutuhan Anda
            </h3>
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Bandingkan fitur utama produk simpanan syariah BPRS Wakalumi secara transparan dan amanah.
            </p>
        </div>

        <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm bg-white dark:bg-slate-900" data-aos="fade-up">
            <table class="w-full text-left text-sm whitespace-normal">
                <thead>
                    <tr class="bg-slate-100/80 dark:bg-slate-800 text-slate-700 dark:text-slate-200 border-b border-slate-200 dark:border-slate-700">
                        <th class="p-4 font-bold text-xs uppercase tracking-wider w-1/5 min-w-[160px]">Fitur & Ketentuan</th>
                        <?php foreach ( $tabungan_list as $prod ) : 
                            $c_theme = $color_themes[ $prod['color'] ?? 'teal' ] ?? $color_themes['teal'];
                        ?>
                            <th class="p-4 font-bold text-xs uppercase tracking-wider <?php echo esc_attr( $c_theme['th_text'] ); ?> min-w-[170px]">
                                <?php echo esc_html( $prod['nama'] ); ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    <!-- Akad Syariah -->
                    <tr>
                        <td class="p-4 font-bold text-slate-800 dark:text-slate-200">Akad Syariah</td>
                        <?php foreach ( $tabungan_list as $prod ) : ?>
                            <td class="p-4 text-slate-600 dark:text-slate-300 font-medium">
                                <?php echo esc_html( $prod['akad'] ); ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>

                    <!-- Setoran Awal Minimal -->
                    <tr class="bg-slate-50/50 dark:bg-slate-800/30">
                        <td class="p-4 font-bold text-slate-800 dark:text-slate-200">Setoran Awal Minimal</td>
                        <?php foreach ( $tabungan_list as $prod ) : 
                            $c_theme = $color_themes[ $prod['color'] ?? 'teal' ] ?? $color_themes['teal'];
                        ?>
                            <td class="p-4 <?php echo esc_attr( $c_theme['table_min'] ); ?> font-bold">
                                <?php echo esc_html( $prod['min_setor'] ); ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>

                    <!-- Biaya Administrasi -->
                    <tr>
                        <td class="p-4 font-bold text-slate-800 dark:text-slate-200">Biaya Administrasi Bulanan</td>
                        <?php foreach ( $tabungan_list as $prod ) : ?>
                            <td class="p-4 text-emerald-600 dark:text-emerald-400 font-bold">
                                <?php echo esc_html( ! empty( $prod['biaya_admin'] ) ? $prod['biaya_admin'] : 'Gratis (Rp 0)' ); ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>

                    <!-- Sasaran Nasabah -->
                    <tr class="bg-slate-50/50 dark:bg-slate-800/30">
                        <td class="p-4 font-bold text-slate-800 dark:text-slate-200">Sasaran Nasabah</td>
                        <?php foreach ( $tabungan_list as $prod ) : ?>
                            <td class="p-4 text-slate-600 dark:text-slate-300">
                                <?php echo esc_html( ! empty( $prod['badge'] ) ? $prod['badge'] : $prod['tagline'] ); ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>

                    <!-- Buku Tabungan Fisik -->
                    <tr>
                        <td class="p-4 font-bold text-slate-800 dark:text-slate-200">Buku Tabungan Fisik</td>
                        <?php foreach ( $tabungan_list as $prod ) : ?>
                            <td class="p-4 text-slate-600 dark:text-slate-300">
                                Disediakan atas nama Nasabah
                            </td>
                        <?php endforeach; ?>
                    </tr>

                    <!-- Penarikan Dana -->
                    <tr class="bg-slate-50/50 dark:bg-slate-800/30">
                        <td class="p-4 font-bold text-slate-800 dark:text-slate-200">Penarikan Dana</td>
                        <?php foreach ( $tabungan_list as $prod ) : ?>
                            <td class="p-4 text-slate-600 dark:text-slate-300">
                                <?php 
                                if ( $prod['slug'] === 'haji-umroh' ) {
                                    echo 'Terfokus saat pelunasan / keberangkatan';
                                } elseif ( $prod['slug'] === 'ukhuwah' ) {
                                    echo 'Sesuai komitmen periode program berhadiah';
                                } else {
                                    echo 'Fleksibel sewaktu-waktu pada jam operasional';
                                }
                                ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>

                    <!-- Perlindungan Simpanan -->
                    <tr>
                        <td class="p-4 font-bold text-slate-800 dark:text-slate-200">Perlindungan Simpanan</td>
                        <td class="p-4 text-teal-600 dark:text-teal-400 font-semibold" colspan="<?php echo esc_attr( max( 1, count( $tabungan_list ) ) ); ?>">
                            🛡️ Dijamin Lembaga Penjamin Simpanan (LPS) s.d. Rp 2 Miliar per nasabah & Diawasi OJK
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 3: KALKULATOR SIMULASI TABUNGAN (REAL-TIME INTERAKTIF)
     ======================================== -->
<section id="kalkulator" class="scroll-mt-24 py-14 lg:py-20 bg-white dark:bg-dark-surface-alt">
    <div class="container-wide">
        <div class="max-w-4xl mx-auto p-6 sm:p-10 rounded-3xl bg-gradient-to-br from-slate-900 via-slate-800 to-teal-950 text-white shadow-2xl relative overflow-hidden" data-aos="fade-up">
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-500/20 text-teal-300 text-xs font-bold uppercase tracking-wider mb-3 border border-teal-500/30">
                    <span>✨ <?php echo esc_html( $calc_badge ); ?></span>
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight mb-2">
                    <?php echo esc_html( $calc_title ); ?>
                </h3>
                <p class="text-sm text-slate-300 mb-8 max-w-2xl leading-relaxed">
                    <?php echo esc_html( $calc_sub ); ?>
                </p>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <!-- Form Input (7 Kolom) -->
                    <div class="lg:col-span-7 space-y-6">
                        <!-- Pilihan Produk Tabungan (Dinamis dari Repeater) -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                1. Pilih Jenis Tabungan
                            </label>
                            <select id="wkl-calc-product" class="w-full py-3 px-4 rounded-xl bg-slate-800/90 border border-slate-700 text-white font-semibold text-sm focus:outline-none focus:border-teal-400">
                                <?php foreach ( $tabungan_list as $idx => $prod ) : ?>
                                    <option value="<?php echo esc_attr( $prod['nama'] ); ?>" <?php echo $idx === 0 ? 'selected' : ''; ?>>
                                        <?php echo esc_html( $prod['nama'] ); ?> (<?php echo esc_html( $prod['tagline'] ); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Target Dana -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-300">
                                    2. Target Dana yang Ingin Dicapai
                                </label>
                                <span id="wkl-calc-target-display" class="text-sm font-black text-teal-300">
                                    Rp 25.000.000
                                </span>
                            </div>
                            <input 
                                type="range" 
                                id="wkl-calc-target-range" 
                                min="2000000" 
                                max="100000000" 
                                step="1000000" 
                                value="25000000" 
                                class="w-full h-2 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-teal-400"
                            >
                            <!-- Preset Pills -->
                            <div class="flex flex-wrap gap-2 mt-3">
                                <button type="button" class="wkl-calc-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700 hover:border-teal-400 text-xs font-bold text-slate-200 transition-colors" data-val="10000000">Rp 10 Juta</button>
                                <button type="button" class="wkl-calc-preset-btn px-2.5 py-1 rounded-lg bg-teal-950/60 border border-teal-500/50 text-xs font-bold text-teal-300 transition-colors" data-val="25000000">Rp 25 Jt (Porsi Haji)</button>
                                <button type="button" class="wkl-calc-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700 hover:border-teal-400 text-xs font-bold text-slate-200 transition-colors" data-val="35000000">Rp 35 Jt (Umroh)</button>
                                <button type="button" class="wkl-calc-preset-btn px-2.5 py-1 rounded-lg bg-slate-800 border border-slate-700 hover:border-teal-400 text-xs font-bold text-slate-200 transition-colors" data-val="50000000">Rp 50 Juta</button>
                            </div>
                        </div>

                        <!-- Jangka Waktu (Bulan) -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-300">
                                    3. Jangka Waktu Menabung
                                </label>
                                <span id="wkl-calc-months-display" class="text-sm font-black text-teal-300">
                                    24 Bulan (2 Tahun)
                                </span>
                            </div>
                            <input 
                                type="range" 
                                id="wkl-calc-months-range" 
                                min="6" 
                                max="60" 
                                step="6" 
                                value="24" 
                                class="w-full h-2 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-teal-400"
                            >
                            <div class="flex justify-between text-[11px] text-slate-400 mt-1">
                                <span>6 Bulan</span>
                                <span>12 Bulan (1 Thn)</span>
                                <span>24 Bulan (2 Thn)</span>
                                <span>36 Bulan (3 Thn)</span>
                                <span>60 Bulan (5 Thn)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Output Box (5 Kolom) -->
                    <div class="lg:col-span-5 bg-slate-800/80 p-6 sm:p-7 rounded-2xl border border-teal-500/30 text-center relative shadow-inner">
                        <span class="text-xs text-slate-400 uppercase tracking-wider font-bold block mb-1">
                            Estimasi Sisihan per Bulan
                        </span>
                        <div id="wkl-calc-result-monthly" class="text-3xl sm:text-4xl font-black text-teal-400 tracking-tight mb-2">
                            Rp 1.042.000
                        </div>
                        <span class="text-xs text-slate-400 block mb-6 leading-relaxed">
                            Bebas biaya administrasi bulanan, tabungan Anda utuh bertumbuh dengan bagi hasil berkah.
                        </span>

                        <div class="space-y-3 pt-4 border-t border-slate-700">
                            <a 
                                id="wkl-calc-wa-btn" 
                                data-phone="<?php echo esc_attr( $clean_wa ); ?>"
                                href="https://wa.me/<?php echo esc_attr( $clean_wa ); ?>?text=<?php echo urlencode( 'Halo BPRS Wakalumi, saya tertarik membuka simpanan syariah dengan target Rp 25.000.000 selama 24 bulan (estimasi sisihan Rp 1.042.000/bln). Mohon panduannya.' ); ?>" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="w-full py-3 px-4 rounded-xl bg-teal-500 hover:bg-teal-400 text-slate-950 font-black text-sm inline-flex items-center justify-center gap-2 shadow-lg transition-transform hover:scale-[1.02]"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <span>Mulai Menabung via WhatsApp</span>
                            </a>
                            <span class="text-[11px] text-slate-400 block">
                                *Simulasi indikatif pembulatan matematis tanpa potongan admin.
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 4: 4 KEUNGGULAN PRINSIP SYARIAH
     ======================================== -->
<section class="py-14 lg:py-20 bg-slate-50 dark:bg-dark-surface">
    <div class="container-wide">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mb-3">
                Mengapa Memilih Menabung di BPRS Wakalumi?
            </h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                Kami memastikan setiap rupiah yang Anda simpan dikelola secara profesional, amanah, dan mendatangkan kemaslahatan bagi umat.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up">
            <!-- 1 -->
            <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-300 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h4 class="text-base font-extrabold text-slate-900 dark:text-white mb-2">Murni Bebas Riba</h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Pengelolaan berlandaskan akad syariah yang diawasi langsung oleh Dewan Pengawas Syariah (DPS) dan DSN-MUI.
                </p>
            </div>

            <!-- 2 -->
            <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/50 text-blue-600 dark:text-blue-300 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                </div>
                <h4 class="text-base font-extrabold text-slate-900 dark:text-white mb-2">Bebas Biaya Bulanan</h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Saldo tabungan Anda tidak akan tergerus oleh biaya administrasi bulanan, sehingga dana Anda aman dan optimal.
                </p>
            </div>

            <!-- 3 -->
            <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-900/50 text-amber-600 dark:text-amber-300 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <h4 class="text-base font-extrabold text-slate-900 dark:text-white mb-2">Bagi Hasil Kompetitif</h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Keuntungan hasil pembiayaan produktif sektor riil dibagikan secara adil dan transparan kepada para penabung setiap bulan.
                </p>
            </div>

            <!-- 4 -->
            <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-300 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h4 class="text-base font-extrabold text-slate-900 dark:text-white mb-2">Dijamin LPS Rp 2 Miliar</h4>
                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                    Dana simpanan masyarakat dijamin secara sah oleh Lembaga Penjamin Simpanan (LPS) sesuai ketentuan regulasi yang berlaku.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 5: FAQ & UNDUH BROSUR
     ======================================== -->
<section class="py-14 lg:py-20 bg-white dark:bg-dark-surface-alt border-t border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            <!-- FAQ (7 Kolom) -->
            <div class="lg:col-span-7">
                <span class="text-xs font-extrabold uppercase tracking-wider text-teal-600 dark:text-teal-400 bg-teal-50 dark:bg-teal-950/60 px-3 py-1 rounded-full border border-teal-200 dark:border-teal-800">
                    <?php echo esc_html( $faq_badge ); ?>
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-3 mb-2">
                    <?php echo esc_html( $faq_title ); ?>
                </h3>
                <?php if ( ! empty( $faq_sub ) ) : ?>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mb-6 leading-relaxed">
                        <?php echo esc_html( $faq_sub ); ?>
                    </p>
                <?php else : ?>
                    <div class="mb-6"></div>
                <?php endif; ?>

                <div class="space-y-4">
                    <?php if ( ! empty( $faq_list ) ) : ?>
                        <?php foreach ( $faq_list as $f_item ) : ?>
                            <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700 hover:border-teal-300 dark:hover:border-teal-700 hover:shadow-md transition-all">
                                <h5 class="text-sm font-bold text-slate-900 dark:text-white mb-2 flex items-start gap-2">
                                    <span class="text-teal-600 dark:text-teal-400 font-black">Q:</span>
                                    <span><?php echo esc_html( $f_item['q'] ?? '' ); ?></span>
                                </h5>
                                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed pl-5">
                                    <?php echo nl2br( esc_html( $f_item['a'] ?? '' ) ); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card Unduh Brosur & Hotline (5 Kolom) -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Box Brosur -->
                <div class="p-6 rounded-3xl bg-teal-50 dark:bg-slate-800 border border-teal-200 dark:border-teal-700 shadow-sm text-slate-900 dark:text-white">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-teal-600 text-white flex items-center justify-center flex-shrink-0 shadow-md">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <span class="text-[11px] font-extrabold uppercase tracking-wider text-teal-700 dark:text-teal-300 block">Katalog Brosur Resmi</span>
                            <h4 class="text-base font-extrabold leading-tight">Unduh Brosur Produk Lengkap</h4>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-5">
                        Dapatkan informasi lengkap seluruh produk simpanan, deposito, dan pembiayaan BPRS Wakalumi dalam format dokumen PDF resmi.
                    </p>
                    <a 
                        href="<?php echo ! empty( $brosur_url ) ? esc_url( $brosur_url ) : 'https://wa.me/' . esc_attr( $clean_wa ) . '?text=' . urlencode( 'Halo BPRS Wakalumi, saya ingin meminta brosur lengkap produk tabungan syariah.' ); ?>" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        <?php echo ! empty( $brosur_url ) ? 'download' : ''; ?>
                        class="w-full py-3 px-4 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs inline-flex items-center justify-center gap-2 shadow-sm transition-colors"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>Unduh File Brosur (PDF)</span>
                    </a>
                </div>

                <!-- Box Buka Deposito -->
                <div class="p-6 rounded-3xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800">
                    <span class="text-xs font-bold text-teal-600 dark:text-teal-400 block mb-1">Investasi Berjangka</span>
                    <h4 class="text-base font-extrabold text-slate-900 dark:text-white mb-2">Ingin Imbal Hasil Lebih Optimal?</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-4">
                        Jelajahi produk <strong>Deposito Mudharabah</strong> BPRS Wakalumi dengan tenor 1, 3, 6, dan 12 bulan serta porsi nisbah bagi hasil yang kompetitif.
                    </p>
                    <a href="<?php echo esc_url( home_url( '/produk/deposito-syariah' ) ); ?>" class="text-xs font-bold text-teal-700 dark:text-teal-300 hover:underline inline-flex items-center gap-1">
                        Lihat Halaman Deposito Mudharabah &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Inline fallback runner for calculator -->
<script>
(function() {
    function runCalc() {
        if (typeof SavingsCalculator !== 'undefined' && SavingsCalculator.init) {
            SavingsCalculator.init();
        }
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', runCalc);
    } else {
        runCalc();
    }
})();
</script>

<?php
get_footer();
