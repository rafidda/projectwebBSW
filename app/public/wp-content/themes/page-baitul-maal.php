<?php
/**
 * Template Name: Halaman Baitul Maal BSW
 * Description: Halaman Resmi Baitul Maal BSW (Kepedulian Sosial, Program Kemaslahatan & Edukasi ZISWAF).
 *              Menggunakan struktur Hero Section & 2-Column Interactive Layout yang seragam dengan Layanan Kami,
 *              dilengkapi 8 variasi tema warna profesional, 16 variasi ikon SVG, Kartu Informasi Utama,
 *              serta Blok Seksi Kustom yang fleksibel untuk program sosial maupun ZISWAF.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Proteksi Regulasi Perbankan Syariah:
// Jika fitur Baitul Maal disembunyikan dan pengunjung bukan administrator, arahkan ke /layanan-kami/
$show_baitul_maal = ( '1' === (string) get_option( 'options_show_baitul_maal', '0' ) );
if ( ! $show_baitul_maal && ! current_user_can( 'manage_options' ) ) {
    wp_safe_redirect( home_url( '/layanan-kami/' ), 302 );
    exit;
}

// SEO Custom Meta Title
add_filter( 'document_title_parts', function( $title_parts ) {
    $title_parts['title'] = 'Baitul Maal BSW — Bank Syariah Wakalumi';
    return $title_parts;
} );

get_header();

$cfg   = function_exists( 'wakalumi_get_baitul_maal_settings' ) ? wakalumi_get_baitul_maal_settings() : [];
$items = ! empty( $cfg['items'] ) && is_array( $cfg['items'] ) ? $cfg['items'] : [];

$clean_wa = preg_replace( '/[^0-9]/', '', $cfg['cs_wa'] ?? '6281517380388' );
$wa_text  = ! empty( $cfg['cs_wa_text'] ) ? $cfg['cs_wa_text'] : 'Halo Tim Layanan Informasi Bank Syariah Wakalumi, saya ingin menanyakan informasi seputar Baitul Maal BSW.';
$wa_url   = 'https://wa.me/' . $clean_wa . '?text=' . rawurlencode( $wa_text );

/**
 * Helper memisahkan format "Judul | Penjelasan" pada baris list
 */
if ( ! function_exists( 'wakalumi_parse_bm_list_item' ) ) {
    function wakalumi_parse_bm_list_item( $line ) {
        $parts = explode( '|', (string) $line, 2 );
        if ( count( $parts ) === 2 ) {
            return [
                'title' => trim( $parts[0] ),
                'desc'  => trim( $parts[1] ),
            ];
        }
        return [
            'title' => '',
            'desc'  => trim( (string) $line ),
        ];
    }
}

/**
 * Helper 8 Skema Tema Warna Profesional untuk Kartu & Seksi Baitul Maal
 */
if ( ! function_exists( 'wakalumi_get_bm_color_palette' ) ) {
    function wakalumi_get_bm_color_palette( $color = 'teal' ) {
        $palettes = [
            'teal' => [
                'top_bar'            => 'from-teal-500 via-emerald-500 to-cyan-500',
                'card_border'        => 'border-teal-200/90 dark:border-teal-800/60',
                'card_bg'            => 'bg-gradient-to-b from-teal-50/55 via-white to-white dark:from-teal-950/30 dark:via-dark-card dark:to-dark-card',
                'icon_box'           => 'bg-teal-100/90 dark:bg-teal-950/80 text-teal-700 dark:text-teal-300 border-teal-200 dark:border-teal-800',
                'icon_solid'         => 'bg-gradient-to-br from-teal-500 to-teal-700 text-white shadow-sm shadow-teal-500/25',
                'badge'              => 'bg-teal-100/90 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border-teal-300/70 dark:border-teal-700/60',
                'dot'                => 'bg-teal-500',
                'quote_box'          => 'bg-gradient-to-br from-teal-50/90 via-emerald-50/50 to-white dark:from-teal-950/45 dark:via-dark-surface dark:to-dark-surface border-teal-200/90 dark:border-teal-800/60 text-teal-950 dark:text-teal-100',
                'sub_badge'          => 'bg-teal-50 dark:bg-teal-950 text-teal-700 dark:text-teal-300 border-teal-200/70 dark:border-teal-800/60',
                'accent_bar'         => 'bg-gradient-to-b from-teal-500 to-emerald-600',
                'text_accent'        => 'text-teal-600 dark:text-teal-400',
                'tab_active_desktop' => 'bg-gradient-to-br from-teal-600 via-teal-600 to-emerald-700 text-white border-teal-500 shadow-lg shadow-teal-600/25',
                'tab_active_mobile'  => 'bg-gradient-to-r from-teal-600 to-emerald-700 text-white border-teal-500 shadow-md shadow-teal-600/20',
                'tab_hover_border'   => 'hover:border-teal-300 dark:hover:border-teal-700/60',
            ],
            'emerald' => [
                'top_bar'            => 'from-emerald-500 via-teal-500 to-green-500',
                'card_border'        => 'border-emerald-200/90 dark:border-emerald-800/60',
                'card_bg'            => 'bg-gradient-to-b from-emerald-50/55 via-white to-white dark:from-emerald-950/30 dark:via-dark-card dark:to-dark-card',
                'icon_box'           => 'bg-emerald-100/90 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800',
                'icon_solid'         => 'bg-gradient-to-br from-emerald-500 to-emerald-700 text-white shadow-sm shadow-emerald-500/25',
                'badge'              => 'bg-emerald-100/90 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300 border-emerald-300/70 dark:border-emerald-700/60',
                'dot'                => 'bg-emerald-500',
                'quote_box'          => 'bg-gradient-to-br from-emerald-50/90 via-teal-50/50 to-white dark:from-emerald-950/45 dark:via-dark-surface dark:to-dark-surface border-emerald-200/90 dark:border-emerald-800/60 text-emerald-950 dark:text-emerald-100',
                'sub_badge'          => 'bg-emerald-50 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 border-emerald-200/70 dark:border-emerald-800/60',
                'accent_bar'         => 'bg-gradient-to-b from-emerald-500 to-teal-600',
                'text_accent'        => 'text-emerald-600 dark:text-emerald-400',
                'tab_active_desktop' => 'bg-gradient-to-br from-emerald-600 via-emerald-600 to-teal-700 text-white border-emerald-500 shadow-lg shadow-emerald-600/25',
                'tab_active_mobile'  => 'bg-gradient-to-r from-emerald-600 to-teal-700 text-white border-emerald-500 shadow-md shadow-emerald-600/20',
                'tab_hover_border'   => 'hover:border-emerald-300 dark:hover:border-emerald-700/60',
            ],
            'blue' => [
                'top_bar'            => 'from-blue-500 via-sky-500 to-indigo-500',
                'card_border'        => 'border-blue-200/90 dark:border-blue-800/60',
                'card_bg'            => 'bg-gradient-to-b from-blue-50/55 via-white to-white dark:from-blue-950/30 dark:via-dark-card dark:to-dark-card',
                'icon_box'           => 'bg-blue-100/90 dark:bg-blue-950/80 text-blue-700 dark:text-blue-300 border-blue-200 dark:border-blue-800',
                'icon_solid'         => 'bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-sm shadow-blue-500/25',
                'badge'              => 'bg-blue-100/90 dark:bg-blue-950/80 text-blue-800 dark:text-blue-300 border-blue-300/70 dark:border-blue-700/60',
                'dot'                => 'bg-blue-500',
                'quote_box'          => 'bg-gradient-to-br from-blue-50/90 via-sky-50/50 to-white dark:from-blue-950/45 dark:via-dark-surface dark:to-dark-surface border-blue-200/90 dark:border-blue-800/60 text-blue-950 dark:text-blue-100',
                'sub_badge'          => 'bg-blue-50 dark:bg-blue-950 text-blue-700 dark:text-blue-300 border-blue-200/70 dark:border-blue-800/60',
                'accent_bar'         => 'bg-gradient-to-b from-blue-500 to-indigo-600',
                'text_accent'        => 'text-blue-600 dark:text-blue-400',
                'tab_active_desktop' => 'bg-gradient-to-br from-blue-600 via-blue-600 to-indigo-700 text-white border-blue-500 shadow-lg shadow-blue-600/25',
                'tab_active_mobile'  => 'bg-gradient-to-r from-blue-600 to-indigo-700 text-white border-blue-500 shadow-md shadow-blue-600/20',
                'tab_hover_border'   => 'hover:border-blue-300 dark:hover:border-blue-700/60',
            ],
            'indigo' => [
                'top_bar'            => 'from-indigo-500 via-blue-500 to-purple-500',
                'card_border'        => 'border-indigo-200/90 dark:border-indigo-800/60',
                'card_bg'            => 'bg-gradient-to-b from-indigo-50/55 via-white to-white dark:from-indigo-950/30 dark:via-dark-card dark:to-dark-card',
                'icon_box'           => 'bg-indigo-100/90 dark:bg-indigo-950/80 text-indigo-700 dark:text-indigo-300 border-indigo-200 dark:border-indigo-800',
                'icon_solid'         => 'bg-gradient-to-br from-indigo-500 to-indigo-700 text-white shadow-sm shadow-indigo-500/25',
                'badge'              => 'bg-indigo-100/90 dark:bg-indigo-950/80 text-indigo-800 dark:text-indigo-300 border-indigo-300/70 dark:border-indigo-700/60',
                'dot'                => 'bg-indigo-500',
                'quote_box'          => 'bg-gradient-to-br from-indigo-50/90 via-blue-50/50 to-white dark:from-indigo-950/45 dark:via-dark-surface dark:to-dark-surface border-indigo-200/90 dark:border-indigo-800/60 text-indigo-950 dark:text-indigo-100',
                'sub_badge'          => 'bg-indigo-50 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 border-indigo-200/70 dark:border-indigo-800/60',
                'accent_bar'         => 'bg-gradient-to-b from-indigo-500 to-purple-600',
                'text_accent'        => 'text-indigo-600 dark:text-indigo-400',
                'tab_active_desktop' => 'bg-gradient-to-br from-indigo-600 via-indigo-600 to-purple-700 text-white border-indigo-500 shadow-lg shadow-indigo-600/25',
                'tab_active_mobile'  => 'bg-gradient-to-r from-indigo-600 to-purple-700 text-white border-indigo-500 shadow-md shadow-indigo-600/20',
                'tab_hover_border'   => 'hover:border-indigo-300 dark:hover:border-indigo-700/60',
            ],
            'amber' => [
                'top_bar'            => 'from-amber-500 via-orange-400 to-yellow-500',
                'card_border'        => 'border-amber-200/90 dark:border-amber-800/60',
                'card_bg'            => 'bg-gradient-to-b from-amber-50/60 via-white to-white dark:from-amber-950/30 dark:via-dark-card dark:to-dark-card',
                'icon_box'           => 'bg-amber-100/90 dark:bg-amber-950/80 text-amber-700 dark:text-amber-300 border-amber-200 dark:border-amber-800',
                'icon_solid'         => 'bg-gradient-to-br from-amber-500 to-amber-600 text-white shadow-sm shadow-amber-500/25',
                'badge'              => 'bg-amber-100/90 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300 border-amber-300/70 dark:border-amber-700/60',
                'dot'                => 'bg-amber-500',
                'quote_box'          => 'bg-gradient-to-br from-amber-50/90 via-yellow-50/50 to-white dark:from-amber-950/45 dark:via-dark-surface dark:to-dark-surface border-amber-200/90 dark:border-amber-800/60 text-amber-950 dark:text-amber-100',
                'sub_badge'          => 'bg-amber-50 dark:bg-amber-950 text-amber-700 dark:text-amber-300 border-amber-200/70 dark:border-amber-800/60',
                'accent_bar'         => 'bg-gradient-to-b from-amber-500 to-orange-500',
                'text_accent'        => 'text-amber-600 dark:text-amber-400',
                'tab_active_desktop' => 'bg-gradient-to-br from-amber-600 via-amber-600 to-orange-600 text-white border-amber-500 shadow-lg shadow-amber-600/25',
                'tab_active_mobile'  => 'bg-gradient-to-r from-amber-600 to-orange-600 text-white border-amber-500 shadow-md shadow-amber-600/20',
                'tab_hover_border'   => 'hover:border-amber-300 dark:hover:border-amber-700/60',
            ],
            'purple' => [
                'top_bar'            => 'from-purple-500 via-violet-500 to-indigo-500',
                'card_border'        => 'border-purple-200/90 dark:border-purple-800/60',
                'card_bg'            => 'bg-gradient-to-b from-purple-50/55 via-white to-white dark:from-purple-950/30 dark:via-dark-card dark:to-dark-card',
                'icon_box'           => 'bg-purple-100/90 dark:bg-purple-950/80 text-purple-700 dark:text-purple-300 border-purple-200 dark:border-purple-800',
                'icon_solid'         => 'bg-gradient-to-br from-purple-500 to-purple-700 text-white shadow-sm shadow-purple-500/25',
                'badge'              => 'bg-purple-100/90 dark:bg-purple-950/80 text-purple-800 dark:text-purple-300 border-purple-300/70 dark:border-purple-700/60',
                'dot'                => 'bg-purple-500',
                'quote_box'          => 'bg-gradient-to-br from-purple-50/90 via-violet-50/50 to-white dark:from-purple-950/45 dark:via-dark-surface dark:to-dark-surface border-purple-200/90 dark:border-purple-800/60 text-purple-950 dark:text-purple-100',
                'sub_badge'          => 'bg-purple-50 dark:bg-purple-950 text-purple-700 dark:text-purple-300 border-purple-200/70 dark:border-purple-800/60',
                'accent_bar'         => 'bg-gradient-to-b from-purple-500 to-indigo-600',
                'text_accent'        => 'text-purple-600 dark:text-purple-400',
                'tab_active_desktop' => 'bg-gradient-to-br from-purple-600 via-purple-600 to-indigo-700 text-white border-purple-500 shadow-lg shadow-purple-600/25',
                'tab_active_mobile'  => 'bg-gradient-to-r from-purple-600 to-indigo-700 text-white border-purple-500 shadow-md shadow-purple-600/20',
                'tab_hover_border'   => 'hover:border-purple-300 dark:hover:border-purple-700/60',
            ],
            'sky' => [
                'top_bar'            => 'from-sky-500 via-cyan-500 to-blue-500',
                'card_border'        => 'border-sky-200/90 dark:border-sky-800/60',
                'card_bg'            => 'bg-gradient-to-b from-sky-50/55 via-white to-white dark:from-sky-950/30 dark:via-dark-card dark:to-dark-card',
                'icon_box'           => 'bg-sky-100/90 dark:bg-sky-950/80 text-sky-700 dark:text-sky-300 border-sky-200 dark:border-sky-800',
                'icon_solid'         => 'bg-gradient-to-br from-sky-500 to-sky-700 text-white shadow-sm shadow-sky-500/25',
                'badge'              => 'bg-sky-100/90 dark:bg-sky-950/80 text-sky-800 dark:text-sky-300 border-sky-300/70 dark:border-sky-700/60',
                'dot'                => 'bg-sky-500',
                'quote_box'          => 'bg-gradient-to-br from-sky-50/90 via-cyan-50/50 to-white dark:from-sky-950/45 dark:via-dark-surface dark:to-dark-surface border-sky-200/90 dark:border-sky-800/60 text-sky-950 dark:text-sky-100',
                'sub_badge'          => 'bg-sky-50 dark:bg-sky-950 text-sky-700 dark:text-sky-300 border-sky-200/70 dark:border-sky-800/60',
                'accent_bar'         => 'bg-gradient-to-b from-sky-500 to-blue-600',
                'text_accent'        => 'text-sky-600 dark:text-sky-400',
                'tab_active_desktop' => 'bg-gradient-to-br from-sky-600 via-sky-600 to-blue-700 text-white border-sky-500 shadow-lg shadow-sky-600/25',
                'tab_active_mobile'  => 'bg-gradient-to-r from-sky-600 to-blue-700 text-white border-sky-500 shadow-md shadow-sky-600/20',
                'tab_hover_border'   => 'hover:border-sky-300 dark:hover:border-sky-700/60',
            ],
            'cyan' => [
                'top_bar'            => 'from-cyan-500 via-teal-500 to-sky-500',
                'card_border'        => 'border-cyan-200/90 dark:border-cyan-800/60',
                'card_bg'            => 'bg-gradient-to-b from-cyan-50/55 via-white to-white dark:from-cyan-950/30 dark:via-dark-card dark:to-dark-card',
                'icon_box'           => 'bg-cyan-100/90 dark:bg-cyan-950/80 text-cyan-700 dark:text-cyan-300 border-cyan-200 dark:border-cyan-800',
                'icon_solid'         => 'bg-gradient-to-br from-cyan-500 to-cyan-700 text-white shadow-sm shadow-cyan-500/25',
                'badge'              => 'bg-cyan-100/90 dark:bg-cyan-950/80 text-cyan-800 dark:text-cyan-300 border-cyan-300/70 dark:border-cyan-700/60',
                'dot'                => 'bg-cyan-500',
                'quote_box'          => 'bg-gradient-to-br from-cyan-50/90 via-teal-50/50 to-white dark:from-cyan-950/45 dark:via-dark-surface dark:to-dark-surface border-cyan-200/90 dark:border-cyan-800/60 text-cyan-950 dark:text-cyan-100',
                'sub_badge'          => 'bg-cyan-50 dark:bg-cyan-950 text-cyan-700 dark:text-cyan-300 border-cyan-200/70 dark:border-cyan-800/60',
                'accent_bar'         => 'bg-gradient-to-b from-cyan-500 to-teal-600',
                'text_accent'        => 'text-cyan-600 dark:text-cyan-400',
                'tab_active_desktop' => 'bg-gradient-to-br from-cyan-600 via-teal-600 to-blue-700 text-white border-cyan-500 shadow-lg shadow-cyan-600/25',
                'tab_active_mobile'  => 'bg-gradient-to-r from-cyan-600 to-teal-700 text-white border-cyan-500 shadow-md shadow-cyan-600/20',
                'tab_hover_border'   => 'hover:border-cyan-300 dark:hover:border-cyan-700/60',
            ],
        ];
        return $palettes[ $color ] ?? $palettes['teal'];
    }
}

/**
 * Helper Render Ikon SVG (Memanggil helper pusat dari inc/admin-baitul-maal.php)
 */
if ( ! function_exists( 'wakalumi_render_bm_icon' ) ) {
    function wakalumi_render_bm_icon( $icon = 'heart', $class = 'w-5 h-5' ) {
        if ( function_exists( 'wakalumi_get_bm_svg_icon' ) ) {
            return wakalumi_get_bm_svg_icon( $icon, $class );
        }
        return '<svg class="' . esc_attr( $class ) . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>';
    }
}
?>

<main id="primary" class="site-main overflow-hidden bg-slate-50/50 dark:bg-dark-surface/20 min-h-screen">

    <?php if ( ! $show_baitul_maal && current_user_can( 'manage_options' ) ) : ?>
        <!-- Banner Mode Pratinjau Admin Saat Baitul Maal Dinonaktifkan Sesuai Regulasi -->
        <div class="bg-amber-500/10 dark:bg-amber-500/15 border-b border-amber-500/30 text-amber-900 dark:text-amber-200 py-3 px-4 text-xs font-medium relative z-50">
            <div class="container-wide flex items-center justify-between gap-3 flex-wrap">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-amber-500 text-slate-950 font-black text-[11px] shrink-0">!</span>
                    <span>
                        <strong class="font-bold text-amber-800 dark:text-amber-300">Mode Pratinjau Administrator:</strong> Halaman Baitul Maal saat ini sedang <strong>disembunyikan dari publik</strong> sesuai arahan regulasi perbankan syariah. Pengunjung umum otomatis dialihkan ke <a href="<?php echo esc_url( home_url( '/layanan-kami/' ) ); ?>" class="underline font-bold">Layanan Kami</a>.
                    </span>
                </div>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-baitul-maal' ) ); ?>" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500 text-slate-950 font-bold hover:bg-amber-400 transition-colors shadow-2xs">
                    <span>Pengaturan Visibilitas</span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <!-- ========================================================================
         HERO SECTION: RESMI, SERAGAM & ELEGAN DENGAN 1 CARD RINGKASAN KANAN
         ======================================================================== -->
    <section class="wkl-page-hero">
        
        <!-- Ambient Background Glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-80 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

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
                <span class="text-teal-600 dark:text-teal-400 font-semibold"><?php echo esc_html( $cfg['breadcrumb_label'] ?? 'Baitul Maal BSW' ); ?></span>
            </nav>

            <!-- 2-COLUMN HERO GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">
                
                <!-- Left Column: Kicker, Title, Subtitle, Highlights -->
                <div class="<?php echo ! empty( $cfg['hero_card_show'] ) ? 'lg:col-span-7' : 'max-w-4xl'; ?> space-y-4" data-aos="fade-up">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/90 dark:bg-teal-950/70 border border-teal-300/80 dark:border-teal-700/60 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-2 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        <span><?php echo esc_html( $cfg['kicker'] ?? 'Kepedulian Sosial & Literasi ZISWAF' ); ?></span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                        <?php echo esc_html( $cfg['title'] ?? 'Baitul Maal BSW' ); ?>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl font-medium">
                        <?php echo esc_html( $cfg['subtitle'] ?? 'Wujud komitmen sosial Bank Syariah Wakalumi dalam mendukung kegiatan kemaslahatan umat serta literasi pengelolaan dana kebajikan berlandaskan prinsip amanah, transparan, dan sesuai syariah.' ); ?>
                    </p>

                    <?php if ( ! empty( $cfg['hero_pill_1'] ) || ! empty( $cfg['hero_pill_2'] ) || ! empty( $cfg['hero_pill_3'] ) ) : ?>
                        <div class="flex flex-wrap items-center gap-2.5 pt-3 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                            <?php if ( ! empty( $cfg['hero_pill_1'] ) ) : ?>
                                <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-emerald-200/80 dark:border-emerald-800/50 shadow-xs font-semibold">
                                    <span class="w-5 h-5 rounded-lg bg-emerald-50 dark:bg-emerald-950/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                                        <?php echo wakalumi_render_bm_icon( 'shield-check', 'w-3.5 h-3.5' ); ?>
                                    </span>
                                    <span><?php echo esc_html( $cfg['hero_pill_1'] ); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $cfg['hero_pill_2'] ) ) : ?>
                                <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-blue-200/80 dark:border-blue-800/50 shadow-xs font-semibold">
                                    <span class="w-5 h-5 rounded-lg bg-blue-50 dark:bg-blue-950/80 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                                        <?php echo wakalumi_render_bm_icon( 'hand-heart', 'w-3.5 h-3.5' ); ?>
                                    </span>
                                    <span><?php echo esc_html( $cfg['hero_pill_2'] ); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ( ! empty( $cfg['hero_pill_3'] ) ) : ?>
                                <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-amber-200/80 dark:border-amber-800/50 shadow-xs font-semibold">
                                    <span class="w-5 h-5 rounded-lg bg-amber-50 dark:bg-amber-950/80 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                                        <?php echo wakalumi_render_bm_icon( 'sparkles', 'w-3.5 h-3.5' ); ?>
                                    </span>
                                    <span><?php echo esc_html( $cfg['hero_pill_3'] ); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right Column: 1 Spotlight Card Hero -->
                <?php if ( ! empty( $cfg['hero_card_show'] ) ) : ?>
                <div class="lg:col-span-5" data-aos="fade-left" data-aos-delay="100">
                    <div class="spotlight-card group relative rounded-3xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-emerald-300/80 dark:border-emerald-700/60 shadow-xl shadow-emerald-500/10 hover:shadow-2xl hover:shadow-emerald-500/20 transition-all duration-500 overflow-hidden p-6 sm:p-7 text-center">
                        
                        <div class="h-1.5 w-full bg-gradient-to-r from-emerald-500 via-teal-400 to-blue-500 absolute top-0 left-0 right-0"></div>

                        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-52 h-52 sm:w-60 sm:h-60 opacity-[0.04] dark:opacity-[0.06] pointer-events-none select-none transition-all duration-700 ease-out group-hover:scale-110 group-hover:opacity-[0.10] dark:group-hover:opacity-[0.14] grayscale mix-blend-multiply dark:mix-blend-screen z-0">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain">
                        </div>

                        <div class="relative z-10 flex flex-col items-center mb-4">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center mb-3 shadow-md shadow-teal-500/25 group-hover:scale-105 transition-all duration-300">
                                <?php echo wakalumi_render_bm_icon( 'hand-heart', 'w-7 h-7' ); ?>
                            </div>

                            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-100/90 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 text-[10px] font-black uppercase tracking-wider border border-emerald-300/60 dark:border-emerald-700/60 mb-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <?php echo esc_html( $cfg['hero_card_badge'] ?? 'Fungsi Sosial BSW' ); ?>
                            </div>

                            <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white tracking-tight text-center leading-snug">
                                <?php echo esc_html( $cfg['hero_card_title'] ?? 'Kepedulian & Kemaslahatan Umat' ); ?>
                            </h3>

                            <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed text-center max-w-sm mt-2">
                                <?php echo esc_html( $cfg['hero_card_desc'] ?? 'Mengenal peran sosial Baitul Maal BSW, ragam program kemaslahatan, serta panduan literasi ZISWAF.' ); ?>
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 mb-4 relative z-10 text-left">
                            <?php
                            $hero_points = [
                                [ 'text' => $cfg['hero_card_p1'] ?? 'Pengelolaan Berlandaskan Prinsip Syariah', 'color' => 'emerald', 'icon' => 'shield-check' ],
                                [ 'text' => $cfg['hero_card_p2'] ?? 'Program Sosial, Pendidikan & Ekonomi Umat', 'color' => 'blue', 'icon' => 'users' ],
                                [ 'text' => $cfg['hero_card_p3'] ?? 'Literasi Zakat, Infak, Sedekah & Wakaf', 'color' => 'amber', 'icon' => 'book-open' ],
                                [ 'text' => $cfg['hero_card_p4'] ?? 'Transparan, Akuntabel & Tepat Sasaran', 'color' => 'purple', 'icon' => 'check-badge' ],
                            ];
                            foreach ( $hero_points as $hp ) :
                                if ( empty( $hp['text'] ) ) continue;
                                $hp_pal = wakalumi_get_bm_color_palette( $hp['color'] );
                            ?>
                            <div class="p-2.5 rounded-xl bg-slate-50/90 dark:bg-dark-surface/70 border border-slate-200/80 dark:border-dark-border flex items-center gap-2.5 text-[11px] text-slate-700 dark:text-slate-200 font-semibold">
                                <div class="w-6 h-6 rounded-lg border flex items-center justify-center shrink-0 <?php echo esc_attr( $hp_pal['icon_box'] ); ?>">
                                    <?php echo wakalumi_render_bm_icon( $hp['icon'], 'w-3.5 h-3.5' ); ?>
                                </div>
                                <span class="leading-snug"><?php echo esc_html( $hp['text'] ); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="pt-3 border-t border-slate-200/70 dark:border-dark-border flex items-center justify-center gap-3 text-[11px] text-slate-500 dark:text-slate-400 relative z-10">
                            <span class="inline-flex items-center gap-1.5 font-bold text-emerald-700 dark:text-emerald-400">
                                <?php echo wakalumi_render_bm_icon( 'shield-check', 'w-3.5 h-3.5 shrink-0' ); ?>
                                <?php echo esc_html( ltrim( $cfg['hero_card_seal_left'] ?? 'Amanah & Berkah', '✓ ' ) ); ?>
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
         MAIN SECTION: INTERACTIVE 2-COLUMN HUB (SIDEBAR KIRI + KONTEN KANAN)
         ======================================================================== -->
    <section class="py-8 md:py-14 relative z-10">
        <div class="container-wide">

            <!-- ============================================================
                 MOBILE STICKY TRIGGER BAR (Opens Bottom Sheet Drawer)
                 ============================================================ -->
            <div class="lg:hidden sticky top-16 z-30 mb-6 -mx-4 px-4 transition-all" id="wkl-bm-sticky-wrapper">
                <?php
                $first_item  = $items[0] ?? [];
                $first_color = ! empty( $first_item['color'] ) ? $first_item['color'] : 'teal';
                $first_pal   = wakalumi_get_bm_color_palette( $first_color );
                $first_icon  = $first_item['icon'] ?? 'heart';
                ?>
                <div class="bg-white/95 dark:bg-dark-card/95 backdrop-blur-md rounded-2xl border border-teal-500/35 dark:border-teal-500/25 shadow-lg shadow-teal-500/10 overflow-hidden transition-all">
                    
                    <!-- Trigger Button -->
                    <button type="button" 
                            id="wkl-bm-drawer-trigger" 
                            onclick="wklOpenBmDrawer()" 
                            class="w-full flex items-center justify-between p-2.5 sm:p-3 text-left active:scale-[0.99] transition-all group">
                        <div class="flex items-center gap-3 min-w-0">
                            <!-- Active Icon Box -->
                            <div id="wkl-bm-active-icon-box" class="w-10 h-10 rounded-xl <?php echo esc_attr( $first_pal['tab_active_mobile'] ); ?> flex items-center justify-center shrink-0 shadow-xs">
                                <span id="wkl-bm-active-icon">
                                    <?php echo wakalumi_render_bm_icon( $first_icon, 'w-5 h-5 text-white' ); ?>
                                </span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-1.5 mb-0.5">
                                    <span class="text-[10px] font-black uppercase tracking-wider text-teal-600 dark:text-teal-400">Program Aktif</span>
                                    <span id="wkl-bm-active-badge" class="text-[9px] px-1.5 py-0.2 rounded-full font-bold <?php echo ! empty( $first_item['badge'] ) ? esc_attr( $first_pal['sub_badge'] ) : 'hidden'; ?>">
                                        <?php echo esc_html( $first_item['badge'] ?? '' ); ?>
                                    </span>
                                </div>
                                <h4 id="wkl-bm-active-title" class="text-xs sm:text-sm font-extrabold text-slate-900 dark:text-white truncate">
                                    <?php echo esc_html( $first_item['short_title'] ?? $first_item['title'] ?? 'Pilih Program' ); ?>
                                </h4>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-2 shrink-0 pl-2">
                            <span class="text-[11px] font-bold text-slate-400 dark:text-slate-500" id="wkl-bm-active-counter">
                                1 / <?php echo count( $items ); ?>
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

            <!-- 2-COLUMN GRID LAYOUT -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 xl:gap-8 items-start">

                <!-- ============================================================
                     LEFT COLUMN: STICKY SIDEBAR NAVIGATION (Desktop)
                     ============================================================ -->
                <aside class="hidden lg:block lg:col-span-4 xl:col-span-4 lg:sticky lg:top-24 space-y-5" data-aos="fade-right">
                    
                    <!-- Menu Sidebar Card -->
                    <div class="p-4 sm:p-5 rounded-3xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-slate-200/90 dark:border-dark-border shadow-md">
                        <div class="flex items-center justify-between pb-3.5 mb-3 border-b border-slate-100 dark:border-dark-border px-1">
                            <span class="text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/></svg>
                                <?php echo esc_html( $cfg['sidebar_nav_title'] ?? 'Navigasi Baitul Maal' ); ?>
                            </span>
                            <span class="text-[11px] font-bold text-teal-700 dark:text-teal-300 bg-teal-50 dark:bg-teal-950/70 px-2.5 py-0.5 rounded-full border border-teal-200/60 dark:border-teal-800/60">
                                <?php echo count( $items ) . ' ' . esc_html( $cfg['sidebar_count_suffix'] ?? 'Menu' ); ?>
                            </span>
                        </div>

                        <div class="space-y-2.5" id="wkl-bm-desktop-tab-list">
                            <?php
                            foreach ( $items as $idx => $d_item ) : 
                                $is_active  = ( 0 === $idx );
                                $icon_type  = $d_item['icon'] ?? 'heart';
                                $s_color    = ! empty( $d_item['color'] ) ? $d_item['color'] : $sidebar_accents[ $idx % count( $sidebar_accents ) ];
                                $s_pal      = wakalumi_get_bm_color_palette( $s_color );
                                $idle_btn_class = 'bg-slate-50/80 dark:bg-dark-surface/60 text-slate-700 dark:text-slate-200 border-slate-200/70 dark:border-dark-border/80 hover:bg-slate-100/90 dark:hover:bg-dark-surface ' . $s_pal['tab_hover_border'];
                            ?>
                                <button type="button" 
                                        onclick="wklSwitchBmTab('<?php echo esc_js( $d_item['id'] ); ?>')"
                                        id="wkl-bm-tab-btn-<?php echo esc_attr( $d_item['id'] ); ?>"
                                        data-bm-active-class="<?php echo esc_attr( $s_pal['tab_active_desktop'] ); ?>"
                                        data-bm-idle-class="<?php echo esc_attr( $idle_btn_class ); ?>"
                                        data-bm-icon-idle-class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-105 border shadow-2xs <?php echo esc_attr( $s_pal['icon_box'] ); ?>"
                                        class="wkl-bm-tab-btn w-full text-left p-3.5 rounded-2xl transition-all duration-300 flex items-start gap-3.5 border group relative <?php echo $is_active ? 'active ' . esc_attr( $s_pal['tab_active_desktop'] ) : esc_attr( $idle_btn_class ); ?>"
                                        data-bm-tab-target="<?php echo esc_attr( $d_item['id'] ); ?>">
                                    
                                    <!-- Icon Box -->
                                    <div class="wkl-bm-tab-icon w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-105 <?php echo $is_active ? 'bg-white/20 text-white shadow-xs' : 'border shadow-2xs ' . esc_attr( $s_pal['icon_box'] ); ?>">
                                        <?php echo wakalumi_render_bm_icon( $icon_type, 'w-5 h-5' ); ?>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center justify-between gap-1 mb-0.5">
                                            <h4 class="text-xs sm:text-sm font-bold tracking-tight truncate <?php echo $is_active ? 'text-white' : 'text-slate-900 dark:text-white'; ?>">
                                                <?php echo esc_html( $d_item['short_title'] ?? $d_item['title'] ); ?>
                                            </h4>
                                        </div>
                                        <p class="text-[11px] leading-snug line-clamp-2 <?php echo $is_active ? 'text-white/90 font-medium' : 'text-slate-500 dark:text-slate-400'; ?>">
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

                    <!-- Opsional: Card Rekening Dana Sosial & ZISWAF (Jika Diaktifkan dari WP-Admin) -->
                    <?php if ( ! empty( $cfg['rekening_show'] ) && ! empty( $cfg['rekening_list'] ) && is_array( $cfg['rekening_list'] ) ) : ?>
                    <div class="p-5 rounded-3xl bg-white dark:bg-dark-card border border-amber-200/90 dark:border-amber-800/50 shadow-sm relative overflow-hidden">
                        <div class="h-1.5 w-full bg-gradient-to-r from-amber-500 via-emerald-500 to-teal-500 absolute top-0 left-0 right-0"></div>
                        <div class="flex items-center gap-2.5 mb-3.5 pt-1">
                            <div class="w-9 h-9 rounded-xl bg-amber-50 dark:bg-amber-950/70 text-amber-600 dark:text-amber-400 border border-amber-200/60 dark:border-amber-800/60 flex items-center justify-center shrink-0">
                                <?php echo wakalumi_render_bm_icon( 'building', 'w-4 h-4' ); ?>
                            </div>
                            <h4 class="text-sm font-extrabold text-slate-900 dark:text-white leading-tight">
                                <?php echo esc_html( $cfg['rekening_title'] ?? 'Rekening Dana Sosial & ZISWAF' ); ?>
                            </h4>
                        </div>
                        <div class="space-y-2.5">
                            <?php foreach ( $cfg['rekening_list'] as $rk ) : ?>
                                <div class="p-3 rounded-2xl bg-slate-50 dark:bg-dark-surface/70 border border-slate-200/80 dark:border-dark-border">
                                    <div class="text-[11px] font-bold text-teal-700 dark:text-teal-300 uppercase tracking-wider">
                                        <?php echo esc_html( $rk['bank'] ?? '' ); ?>
                                    </div>
                                    <div class="text-sm font-black text-slate-900 dark:text-white tracking-wide my-0.5 font-mono">
                                        <?php echo esc_html( $rk['norek'] ?? '' ); ?>
                                    </div>
                                    <?php if ( ! empty( $rk['an'] ) ) : ?>
                                        <div class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">
                                            a.n. <?php echo esc_html( $rk['an'] ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Card Bantuan Cepat Customer Service -->
                    <div class="p-5 rounded-3xl bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border shadow-sm relative overflow-hidden group">
                        <div class="h-1.5 w-full bg-gradient-to-r from-emerald-500 via-teal-500 to-blue-500 absolute top-0 left-0 right-0"></div>

                        <div class="flex items-center gap-3 mb-3 pt-1">
                            <div class="w-10 h-10 rounded-2xl bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 border border-teal-200/60 dark:border-teal-800/60 flex items-center justify-center flex-shrink-0 shadow-2xs group-hover:scale-105 transition-transform">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v5.998z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-extrabold text-slate-900 dark:text-white leading-tight">
                                    <?php echo esc_html( $cfg['help_card_title'] ?? 'Informasi Lebih Lanjut' ); ?>
                                </h4>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium flex items-center gap-1.5 mt-0.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <?php echo esc_html( $cfg['cs_hours'] ?? 'Senin – Jumat: 08.00 – 15.00 WIB' ); ?>
                                </span>
                            </div>
                        </div>

                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-4">
                            <?php echo esc_html( $cfg['help_card_desc'] ?? 'Hubungi layanan informasi Bank Syariah Wakalumi untuk pertanyaan seputar kegiatan sosial dan Baitul Maal.' ); ?>
                        </p>

                        <div class="space-y-2">
                            <a href="<?php echo esc_url( $wa_url ); ?>" 
                               target="_blank" rel="noopener noreferrer"
                               class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-xs hover:shadow-sm transition-all duration-300 group/wa">
                                <svg class="w-4 h-4 fill-current group-hover/wa:scale-110 transition-transform" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                <span><?php echo esc_html( $cfg['help_btn_text'] ?? 'Hubungi via WhatsApp' ); ?></span>
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
                     RIGHT COLUMN: DYNAMIC CONTENT PANE (Berwarna, Hidup & Fleksibel)
                     ============================================================ -->
                <div class="lg:col-span-8 xl:col-span-8 min-w-0" data-aos="fade-left">
                    <?php foreach ( $items as $idx => $item ) : 
                        $is_active       = ( 0 === $idx );
                        $pillar_cards    = ! empty( $item['pillar_cards'] ) && is_array( $item['pillar_cards'] ) ? $item['pillar_cards'] : [];
                        $custom_sections = ! empty( $item['custom_sections'] ) && is_array( $item['custom_sections'] ) ? $item['custom_sections'] : [];
                        $gallery         = ! empty( $item['media_gallery'] ) && is_array( $item['media_gallery'] ) ? $item['media_gallery'] : [];
                        $faqs            = ! empty( $item['faqs'] ) && is_array( $item['faqs'] ) ? $item['faqs'] : [];
                        $main_icon       = $item['icon'] ?? 'heart';
                        $main_color      = ! empty( $item['color'] ) ? $item['color'] : $sidebar_accents[ $idx % count( $sidebar_accents ) ];
                        $main_pal        = wakalumi_get_bm_color_palette( $main_color );
                    ?>
                        <article id="bm-pane-<?php echo esc_attr( $item['id'] ); ?>" 
                                 class="wkl-bm-pane <?php echo $is_active ? 'block' : 'hidden'; ?> space-y-6 transition-all duration-300">

                            <!-- ====================================================
                                 BLOK UTAMA: CARD PENGANTAR (JUDUL, FOTO, QUOTE, ISI)
                                 ==================================================== -->
                            <div class="spotlight-card relative rounded-3xl bg-white dark:bg-dark-card border <?php echo esc_attr( $main_pal['card_border'] ); ?> shadow-md overflow-hidden p-6 sm:p-8 space-y-6">
                                <div class="h-1.5 w-full bg-gradient-to-r <?php echo esc_attr( $main_pal['top_bar'] ); ?> absolute top-0 left-0 right-0"></div>

                                <!-- Watermark Emblem -->
                                <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/4 w-72 h-72 opacity-[0.03] dark:opacity-[0.05] pointer-events-none select-none z-0 mix-blend-multiply dark:mix-blend-screen">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain grayscale">
                                </div>

                                <!-- Header Judul & Intro -->
                                <div class="relative z-10 border-b border-slate-100 dark:border-dark-border pb-5">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="space-y-2.5">
                                            <?php if ( ! empty( $item['badge'] ) ) : ?>
                                                <div>
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider border shadow-2xs <?php echo esc_attr( $main_pal['badge'] ); ?>">
                                                        <span class="w-2 h-2 rounded-full animate-pulse <?php echo esc_attr( $main_pal['dot'] ); ?>"></span>
                                                        <?php echo esc_html( $item['badge'] ); ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>

                                            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-snug">
                                                <?php echo esc_html( $item['title'] ); ?>
                                            </h2>
                                        </div>

                                        <div class="hidden sm:flex w-12 h-12 rounded-2xl items-center justify-center shrink-0 <?php echo esc_attr( $main_pal['icon_solid'] ); ?>">
                                            <?php echo wakalumi_render_bm_icon( $main_icon, 'w-6 h-6' ); ?>
                                        </div>
                                    </div>

                                    <?php if ( ! empty( $item['intro'] ) ) : ?>
                                        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed font-medium mt-3">
                                            <?php echo esc_html( $item['intro'] ); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <!-- Banner / Foto Utama (Opsional) -->
                                <?php if ( ! empty( $item['main_image'] ) ) : ?>
                                    <div class="relative z-10 rounded-2xl overflow-hidden border border-slate-200/80 dark:border-dark-border bg-slate-100 dark:bg-dark-surface group/img cursor-pointer"
                                         onclick="wklOpenBmLightbox('<?php echo esc_js( $item['main_image'] ); ?>', '<?php echo esc_js( $item['main_image_caption'] ?? $item['title'] ); ?>')">
                                        <img src="<?php echo esc_url( $item['main_image'] ); ?>" 
                                             alt="<?php echo esc_attr( $item['title'] ); ?>" 
                                             class="w-full max-h-[420px] object-cover group-hover/img:scale-[1.02] transition-transform duration-500">
                                        <?php if ( ! empty( $item['main_image_caption'] ) ) : ?>
                                            <div class="px-4 py-2.5 bg-slate-900/80 backdrop-blur-md text-white text-xs font-medium">
                                                <?php echo esc_html( $item['main_image_caption'] ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Quote / Dalil Utama (Opsional) -->
                                <?php if ( ! empty( $item['main_quote'] ) ) : ?>
                                    <blockquote class="relative z-10 p-5 rounded-2xl border shadow-2xs <?php echo esc_attr( $main_pal['quote_box'] ); ?>">
                                        <div class="flex items-start gap-3.5">
                                            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 mt-0.5 <?php echo esc_attr( $main_pal['icon_solid'] ); ?>">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                                            </div>
                                            <p class="text-xs sm:text-sm italic leading-relaxed font-semibold">
                                                <?php echo nl2br( esc_html( $item['main_quote'] ) ); ?>
                                            </p>
                                        </div>
                                    </blockquote>
                                <?php endif; ?>

                                <!-- Isi Keterangan Utama -->
                                <?php if ( ! empty( $item['main_content'] ) ) : ?>
                                    <div class="relative z-10 space-y-3.5 text-sm sm:text-[15px] text-slate-600 dark:text-slate-300 leading-relaxed">
                                        <?php
                                        $paragraphs = preg_split( '/\r\n|\r|\n/', trim( $item['main_content'] ) );
                                        foreach ( $paragraphs as $para ) :
                                            $para = trim( $para );
                                            if ( '' === $para ) continue;
                                        ?>
                                            <p><?php echo esc_html( $para ); ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- ====================================================
                                 MODUL 1: DERETAN KARTU INFORMASI BERIKON & BERWARNA
                                 (Tujuan, Sasaran, Manfaat / Bidang Fokus Program)
                                 ==================================================== -->
                            <?php if ( ! empty( $item['show_pillars'] ) && ! empty( $pillar_cards ) ) : 
                                $card_count = count( $pillar_cards );
                                $grid_cols  = 'md:grid-cols-3';
                                if ( 2 === $card_count || 4 === $card_count ) {
                                    $grid_cols = 'sm:grid-cols-2';
                                }
                            ?>
                            <div class="rounded-3xl bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border shadow-md p-6 sm:p-8 space-y-5">
                                <?php if ( ! empty( $item['pillars_section_title'] ) ) :
                                    $pillars_badge = isset( $item['pillars_section_badge'] ) ? trim( (string) $item['pillars_section_badge'] ) : ( intval( $card_count ) . ' Pokok Bahasan' );
                                ?>
                                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-dark-border pb-4">
                                        <div class="flex items-center gap-2.5">
                                            <span class="w-2.5 h-6 rounded-full <?php echo esc_attr( $main_pal['accent_bar'] ); ?>"></span>
                                            <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                                                <?php echo esc_html( $item['pillars_section_title'] ); ?>
                                            </h3>
                                        </div>
                                        <?php if ( '' !== $pillars_badge ) : ?>
                                            <span class="text-[11px] font-bold px-2.5 py-1 rounded-full border <?php echo esc_attr( $main_pal['sub_badge'] ); ?>">
                                                <?php echo esc_html( $pillars_badge ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="grid grid-cols-1 <?php echo esc_attr( $grid_cols ); ?> gap-4 sm:gap-5">
                                    <?php foreach ( $pillar_cards as $p_idx => $pc ) :
                                        $p_color    = $pc['color'] ?? 'teal';
                                        $p_icon     = $pc['icon'] ?? 'target';
                                        $pal        = wakalumi_get_bm_color_palette( $p_color );
                                        $desc_lines = array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) ( $pc['desc'] ?? '' ) ) ) ) );
                                        // Clean legacy "Pilar" word if stored in old database option
                                        $badge_text = $pc['badge'] ?? '';
                                        if ( stripos( $badge_text, 'Pilar' ) !== false ) {
                                            $fallback_badges = [ 'Arah & Orientasi', 'Penerima Manfaat', 'Dampak Kebaikan', 'Fokus Utama' ];
                                            $badge_text      = $fallback_badges[ $p_idx % count( $fallback_badges ) ];
                                        }
                                    ?>
                                        <div class="group relative rounded-2xl border p-5 sm:p-6 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:shadow-lg overflow-hidden <?php echo esc_attr( $pal['card_border'] . ' ' . $pal['card_bg'] ); ?>">
                                            <!-- Top Color Accent Bar -->
                                            <div class="h-1 w-full bg-gradient-to-r <?php echo esc_attr( $pal['top_bar'] ); ?> absolute top-0 left-0 right-0"></div>

                                            <div>
                                                <div class="flex items-center justify-between gap-2 mb-4 pt-1">
                                                    <div class="w-11 h-11 rounded-2xl flex items-center justify-center transition-transform duration-300 group-hover:scale-105 <?php echo esc_attr( $pal['icon_solid'] ); ?>">
                                                        <?php echo wakalumi_render_bm_icon( $p_icon, 'w-5 h-5' ); ?>
                                                    </div>

                                                    <?php if ( ! empty( $badge_text ) ) : ?>
                                                        <span class="text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full border <?php echo esc_attr( $pal['badge'] ); ?>">
                                                            <?php echo esc_html( $badge_text ); ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>

                                                <h4 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white mb-3 tracking-tight">
                                                    <?php echo esc_html( $pc['title'] ?? '' ); ?>
                                                </h4>

                                                <?php if ( count( $desc_lines ) > 1 ) : ?>
                                                    <ul class="space-y-2.5 text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed">
                                                        <?php foreach ( $desc_lines as $dl ) : ?>
                                                            <li class="flex items-start gap-2.5">
                                                                <span class="w-1.5 h-1.5 rounded-full mt-1.5 shrink-0 <?php echo esc_attr( $pal['dot'] ); ?>"></span>
                                                                <span><?php echo esc_html( $dl ); ?></span>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php elseif ( ! empty( $desc_lines[0] ) ) : ?>
                                                    <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed">
                                                        <?php echo esc_html( $desc_lines[0] ); ?>
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- ====================================================
                                 MODUL 2: SEKSI RINCIAN 2-KOLOM (ZAKAT / TATA KELOLA / PROGRAM)
                                 ==================================================== -->
                            <?php if ( ! empty( $item['show_zakat'] ) ) :
                                $z_color = $item['zakat_color'] ?? 'teal';
                                $z_icon  = $item['zakat_icon'] ?? 'scale';
                                $z_pal   = wakalumi_get_bm_color_palette( $z_color );
                            ?>
                            <div class="rounded-3xl bg-white dark:bg-dark-card border <?php echo esc_attr( $z_pal['card_border'] ); ?> shadow-md p-6 sm:p-8 space-y-6 relative overflow-hidden">
                                <div class="h-1.5 w-full bg-gradient-to-r <?php echo esc_attr( $z_pal['top_bar'] ); ?> absolute top-0 left-0 right-0"></div>

                                <div class="flex items-start justify-between gap-4">
                                    <div class="space-y-2.5">
                                        <?php if ( ! empty( $item['zakat_badge'] ) ) : ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider border <?php echo esc_attr( $z_pal['badge'] ); ?>">
                                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $z_pal['dot'] ); ?>"></span>
                                                <?php echo esc_html( $item['zakat_badge'] ); ?>
                                            </span>
                                        <?php endif; ?>

                                        <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                                            <?php echo esc_html( $item['zakat_title'] ?? 'Ketentuan & Informasi Utama' ); ?>
                                        </h3>
                                    </div>

                                    <div class="w-11 h-11 rounded-2xl flex items-center justify-center shrink-0 <?php echo esc_attr( $z_pal['icon_solid'] ); ?>">
                                        <?php echo wakalumi_render_bm_icon( $z_icon, 'w-5 h-5' ); ?>
                                    </div>
                                </div>

                                <?php if ( ! empty( $item['zakat_desc'] ) ) : ?>
                                    <p class="text-sm sm:text-[15px] text-slate-600 dark:text-slate-300 leading-relaxed">
                                        <?php echo nl2br( esc_html( $item['zakat_desc'] ) ); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['zakat_quote'] ) ) : ?>
                                    <blockquote class="p-4 sm:p-5 rounded-2xl border text-xs sm:text-sm italic font-semibold leading-relaxed <?php echo esc_attr( $z_pal['quote_box'] ); ?>">
                                        <?php echo nl2br( esc_html( $item['zakat_quote'] ) ); ?>
                                    </blockquote>
                                <?php endif; ?>

                                <!-- 2 Card Bersampingan -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
                                    
                                    <!-- Card Kiri -->
                                    <?php if ( ! empty( $item['zakat_asnaf_list'] ) && is_array( $item['zakat_asnaf_list'] ) ) : ?>
                                    <div class="rounded-2xl bg-slate-50/90 dark:bg-dark-surface/70 border border-slate-200/90 dark:border-dark-border p-5 space-y-4">
                                        <div>
                                            <div class="flex items-center gap-2.5 mb-1">
                                                <div class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0 font-black text-xs <?php echo esc_attr( $z_pal['icon_solid'] ); ?>">
                                                    <?php echo count( $item['zakat_asnaf_list'] ); ?>
                                                </div>
                                                <h4 class="text-base font-extrabold text-slate-900 dark:text-white">
                                                    <?php echo esc_html( $item['zakat_asnaf_title'] ?? 'Daftar Kategori / Sasaran' ); ?>
                                                </h4>
                                            </div>
                                            <?php if ( ! empty( $item['zakat_asnaf_subtitle'] ) ) : ?>
                                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                                    <?php echo esc_html( $item['zakat_asnaf_subtitle'] ); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="space-y-2.5">
                                            <?php foreach ( $item['zakat_asnaf_list'] as $a_idx => $asnaf_raw ) :
                                                $parsed = wakalumi_parse_bm_list_item( $asnaf_raw );
                                            ?>
                                                <div class="p-3 rounded-xl bg-white dark:bg-dark-card border border-slate-200/70 dark:border-dark-border flex items-start gap-3">
                                                    <span class="w-6 h-6 rounded-lg border text-[11px] font-black flex items-center justify-center shrink-0 mt-0.5 <?php echo esc_attr( $z_pal['sub_badge'] ); ?>">
                                                        <?php echo intval( $a_idx + 1 ); ?>
                                                    </span>
                                                    <div class="text-xs leading-relaxed">
                                                        <?php if ( ! empty( $parsed['title'] ) ) : ?>
                                                            <strong class="text-slate-900 dark:text-white font-extrabold block"><?php echo esc_html( $parsed['title'] ); ?></strong>
                                                        <?php endif; ?>
                                                        <span class="text-slate-600 dark:text-slate-300"><?php echo esc_html( $parsed['desc'] ); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <!-- Card Kanan -->
                                    <?php if ( ! empty( $item['zakat_syarat_list'] ) && is_array( $item['zakat_syarat_list'] ) ) : ?>
                                    <div class="rounded-2xl bg-slate-50/90 dark:bg-dark-surface/70 border border-slate-200/90 dark:border-dark-border p-5 space-y-4">
                                        <div>
                                            <div class="flex items-center gap-2.5 mb-1">
                                                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white flex items-center justify-center shrink-0">
                                                    <?php echo wakalumi_render_bm_icon( 'check-badge', 'w-4 h-4' ); ?>
                                                </div>
                                                <h4 class="text-base font-extrabold text-slate-900 dark:text-white">
                                                    <?php echo esc_html( $item['zakat_syarat_title'] ?? 'Ketentuan & Kriteria' ); ?>
                                                </h4>
                                            </div>
                                            <?php if ( ! empty( $item['zakat_syarat_subtitle'] ) ) : ?>
                                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                                    <?php echo esc_html( $item['zakat_syarat_subtitle'] ); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="space-y-2.5">
                                            <?php foreach ( $item['zakat_syarat_list'] as $syarat_raw ) :
                                                $parsed = wakalumi_parse_bm_list_item( $syarat_raw );
                                            ?>
                                                <div class="p-3 rounded-xl bg-white dark:bg-dark-card border border-slate-200/70 dark:border-dark-border flex items-start gap-3">
                                                    <div class="w-6 h-6 rounded-lg bg-emerald-50 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 border border-emerald-200/60 dark:border-emerald-800/60 flex items-center justify-center shrink-0 mt-0.5">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                                    </div>
                                                    <div class="text-xs leading-relaxed">
                                                        <?php if ( ! empty( $parsed['title'] ) ) : ?>
                                                            <strong class="text-slate-900 dark:text-white font-extrabold block"><?php echo esc_html( $parsed['title'] ); ?></strong>
                                                        <?php endif; ?>
                                                        <span class="text-slate-600 dark:text-slate-300"><?php echo esc_html( $parsed['desc'] ); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- ====================================================
                                 MODUL 3: SEKSI INFORMASI & GRID POIN (INFAK, SEDEKAH & SOSIAL)
                                 ==================================================== -->
                            <?php if ( ! empty( $item['show_sedekah'] ) ) :
                                $s_color = $item['sedekah_color'] ?? 'amber';
                                $s_icon  = $item['sedekah_icon'] ?? 'hand-heart';
                                $s_pal   = wakalumi_get_bm_color_palette( $s_color );
                            ?>
                            <div class="rounded-3xl bg-white dark:bg-dark-card border <?php echo esc_attr( $s_pal['card_border'] ); ?> shadow-md p-6 sm:p-8 space-y-5 relative overflow-hidden">
                                <div class="h-1.5 w-full bg-gradient-to-r <?php echo esc_attr( $s_pal['top_bar'] ); ?> absolute top-0 left-0 right-0"></div>

                                <div class="flex items-start justify-between gap-4">
                                    <div class="space-y-2.5">
                                        <?php if ( ! empty( $item['sedekah_badge'] ) ) : ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider border <?php echo esc_attr( $s_pal['badge'] ); ?>">
                                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $s_pal['dot'] ); ?>"></span>
                                                <?php echo esc_html( $item['sedekah_badge'] ); ?>
                                            </span>
                                        <?php endif; ?>

                                        <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                                            <?php echo esc_html( $item['sedekah_title'] ?? 'Keutamaan Infak & Sedekah' ); ?>
                                        </h3>
                                    </div>

                                    <div class="w-11 h-11 rounded-2xl flex items-center justify-center shrink-0 <?php echo esc_attr( $s_pal['icon_solid'] ); ?>">
                                        <?php echo wakalumi_render_bm_icon( $s_icon, 'w-5 h-5' ); ?>
                                    </div>
                                </div>

                                <?php if ( ! empty( $item['sedekah_desc'] ) ) : ?>
                                    <p class="text-sm sm:text-[15px] text-slate-600 dark:text-slate-300 leading-relaxed">
                                        <?php echo nl2br( esc_html( $item['sedekah_desc'] ) ); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['sedekah_image'] ) ) : ?>
                                    <div class="rounded-2xl overflow-hidden border border-slate-200/80 dark:border-dark-border">
                                        <img src="<?php echo esc_url( $item['sedekah_image'] ); ?>" alt="<?php echo esc_attr( $item['sedekah_title'] ?? '' ); ?>" class="w-full max-h-80 object-cover">
                                    </div>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['sedekah_quote'] ) ) : ?>
                                    <blockquote class="p-4 sm:p-5 rounded-2xl border text-xs sm:text-sm italic font-semibold leading-relaxed <?php echo esc_attr( $s_pal['quote_box'] ); ?>">
                                        <?php echo nl2br( esc_html( $item['sedekah_quote'] ) ); ?>
                                    </blockquote>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['sedekah_points'] ) && is_array( $item['sedekah_points'] ) ) : ?>
                                    <div class="pt-2">
                                        <?php if ( ! empty( $item['sedekah_points_title'] ) ) : ?>
                                            <h4 class="text-sm sm:text-base font-extrabold text-slate-900 dark:text-white mb-3.5 flex items-center gap-2">
                                                <span class="w-2 h-5 rounded-full <?php echo esc_attr( $s_pal['accent_bar'] ); ?>"></span>
                                                <?php echo esc_html( $item['sedekah_points_title'] ); ?>
                                            </h4>
                                        <?php endif; ?>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                            <?php foreach ( $item['sedekah_points'] as $sp_raw ) :
                                                $parsed = wakalumi_parse_bm_list_item( $sp_raw );
                                            ?>
                                                <div class="p-4 rounded-2xl bg-slate-50/90 dark:bg-dark-surface/70 border border-slate-200/80 dark:border-dark-border flex items-start gap-3 transition-all hover:shadow-xs">
                                                    <div class="w-8 h-8 rounded-xl border flex items-center justify-center shrink-0 mt-0.5 <?php echo esc_attr( $s_pal['icon_box'] ); ?>">
                                                        <?php echo wakalumi_render_bm_icon( $s_icon, 'w-4 h-4' ); ?>
                                                    </div>
                                                    <div class="text-xs leading-relaxed">
                                                        <?php if ( ! empty( $parsed['title'] ) ) : ?>
                                                            <strong class="text-slate-900 dark:text-white font-extrabold block mb-0.5"><?php echo esc_html( $parsed['title'] ); ?></strong>
                                                        <?php endif; ?>
                                                        <span class="text-slate-600 dark:text-slate-300"><?php echo esc_html( $parsed['desc'] ); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <!-- ====================================================
                                 MODUL 4: SEKSI KEUNGGULAN & RUANG LINGKUP (WAKAF / PROGRAM)
                                 ==================================================== -->
                            <?php if ( ! empty( $item['show_wakaf'] ) ) :
                                $w_color = $item['wakaf_color'] ?? 'indigo';
                                $w_icon  = $item['wakaf_icon'] ?? 'building';
                                $w_pal   = wakalumi_get_bm_color_palette( $w_color );
                            ?>
                            <div class="rounded-3xl bg-white dark:bg-dark-card border <?php echo esc_attr( $w_pal['card_border'] ); ?> shadow-md p-6 sm:p-8 space-y-6 relative overflow-hidden">
                                <div class="h-1.5 w-full bg-gradient-to-r <?php echo esc_attr( $w_pal['top_bar'] ); ?> absolute top-0 left-0 right-0"></div>

                                <div class="flex items-start justify-between gap-4">
                                    <div class="space-y-2.5">
                                        <?php if ( ! empty( $item['wakaf_badge'] ) ) : ?>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider border <?php echo esc_attr( $w_pal['badge'] ); ?>">
                                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $w_pal['dot'] ); ?>"></span>
                                                <?php echo esc_html( $item['wakaf_badge'] ); ?>
                                            </span>
                                        <?php endif; ?>

                                        <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                                            <?php echo esc_html( $item['wakaf_title'] ?? 'Mengenal Wakaf & Wakaf Produktif' ); ?>
                                        </h3>
                                    </div>

                                    <div class="w-11 h-11 rounded-2xl flex items-center justify-center shrink-0 <?php echo esc_attr( $w_pal['icon_solid'] ); ?>">
                                        <?php echo wakalumi_render_bm_icon( $w_icon, 'w-5 h-5' ); ?>
                                    </div>
                                </div>

                                <?php if ( ! empty( $item['wakaf_desc'] ) ) : ?>
                                    <p class="text-sm sm:text-[15px] text-slate-600 dark:text-slate-300 leading-relaxed">
                                        <?php echo nl2br( esc_html( $item['wakaf_desc'] ) ); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ( ! empty( $item['wakaf_quote'] ) ) : ?>
                                    <blockquote class="p-4 sm:p-5 rounded-2xl border text-xs sm:text-sm italic font-semibold leading-relaxed <?php echo esc_attr( $w_pal['quote_box'] ); ?>">
                                        <?php echo nl2br( esc_html( $item['wakaf_quote'] ) ); ?>
                                    </blockquote>
                                <?php endif; ?>

                                <!-- 2 Kolom Bersampingan: Keunggulan & Ruang Lingkup -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
                                    
                                    <?php if ( ! empty( $item['wakaf_keunggulan_list'] ) && is_array( $item['wakaf_keunggulan_list'] ) ) : ?>
                                    <div class="rounded-2xl bg-slate-50/90 dark:bg-dark-surface/70 border border-slate-200/90 dark:border-dark-border p-5 space-y-3.5">
                                        <h4 class="text-base font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                                            <span class="w-2 h-5 rounded-full <?php echo esc_attr( $w_pal['accent_bar'] ); ?>"></span>
                                            <?php echo esc_html( $item['wakaf_keunggulan_title'] ?? 'Keunggulan Utama' ); ?>
                                        </h4>
                                        <div class="space-y-2.5">
                                            <?php foreach ( $item['wakaf_keunggulan_list'] as $wk_raw ) :
                                                $parsed = wakalumi_parse_bm_list_item( $wk_raw );
                                            ?>
                                                <div class="p-3 rounded-xl bg-white dark:bg-dark-card border border-slate-200/70 dark:border-dark-border flex items-start gap-2.5">
                                                    <span class="<?php echo esc_attr( $w_pal['text_accent'] ); ?> shrink-0 mt-0.5">
                                                        <?php echo wakalumi_render_bm_icon( 'check-badge', 'w-4 h-4' ); ?>
                                                    </span>
                                                    <div class="text-xs leading-relaxed">
                                                        <?php if ( ! empty( $parsed['title'] ) ) : ?>
                                                            <strong class="text-slate-900 dark:text-white font-extrabold block"><?php echo esc_html( $parsed['title'] ); ?></strong>
                                                        <?php endif; ?>
                                                        <span class="text-slate-600 dark:text-slate-300"><?php echo esc_html( $parsed['desc'] ); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $item['wakaf_program_list'] ) && is_array( $item['wakaf_program_list'] ) ) : ?>
                                    <div class="rounded-2xl bg-slate-50/90 dark:bg-dark-surface/70 border border-slate-200/90 dark:border-dark-border p-5 space-y-3.5">
                                        <h4 class="text-base font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                                            <span class="w-2 h-5 rounded-full bg-teal-500"></span>
                                            <?php echo esc_html( $item['wakaf_program_title'] ?? 'Ruang Lingkup Pemanfaatan' ); ?>
                                        </h4>
                                        <div class="space-y-2.5">
                                            <?php foreach ( $item['wakaf_program_list'] as $wp_raw ) :
                                                $parsed = wakalumi_parse_bm_list_item( $wp_raw );
                                            ?>
                                                <div class="p-3 rounded-xl bg-white dark:bg-dark-card border border-slate-200/70 dark:border-dark-border flex items-start gap-2.5">
                                                    <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                                    <div class="text-xs leading-relaxed">
                                                        <?php if ( ! empty( $parsed['title'] ) ) : ?>
                                                            <strong class="text-slate-900 dark:text-white font-extrabold block"><?php echo esc_html( $parsed['title'] ); ?></strong>
                                                        <?php endif; ?>
                                                        <span class="text-slate-600 dark:text-slate-300"><?php echo esc_html( $parsed['desc'] ); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- ====================================================
                                 MODUL 5: BLOK SEKSI KONTEN KUSTOM (FLEKSIBEL / BEBAS)
                                 Dapat ditambahkan sebanyak apa pun untuk topik bebas
                                 ==================================================== -->
                            <?php if ( ! empty( $custom_sections ) ) : ?>
                                <?php foreach ( $custom_sections as $cs_idx => $cs ) :
                                    if ( empty( $cs['title'] ) && empty( $cs['desc'] ) ) continue;
                                    $cs_color = $cs['color'] ?? 'blue';
                                    $cs_icon  = $cs['icon'] ?? 'sparkles';
                                    $cs_pal   = wakalumi_get_bm_color_palette( $cs_color );
                                    $col1     = ! empty( $cs['col1_list'] ) && is_array( $cs['col1_list'] ) ? $cs['col1_list'] : [];
                                    $col2     = ! empty( $cs['col2_list'] ) && is_array( $cs['col2_list'] ) ? $cs['col2_list'] : [];
                                    $has_both = ! empty( $col1 ) && ! empty( $col2 );
                                ?>
                                <div class="rounded-3xl bg-white dark:bg-dark-card border <?php echo esc_attr( $cs_pal['card_border'] ); ?> shadow-md p-6 sm:p-8 space-y-5 relative overflow-hidden">
                                    <div class="h-1.5 w-full bg-gradient-to-r <?php echo esc_attr( $cs_pal['top_bar'] ); ?> absolute top-0 left-0 right-0"></div>

                                    <div class="flex items-start justify-between gap-4">
                                        <div class="space-y-2.5">
                                            <?php if ( ! empty( $cs['badge'] ) ) : ?>
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider border <?php echo esc_attr( $cs_pal['badge'] ); ?>">
                                                    <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $cs_pal['dot'] ); ?>"></span>
                                                    <?php echo esc_html( $cs['badge'] ); ?>
                                                </span>
                                            <?php endif; ?>

                                            <?php if ( ! empty( $cs['title'] ) ) : ?>
                                                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                                                    <?php echo esc_html( $cs['title'] ); ?>
                                                </h3>
                                            <?php endif; ?>
                                        </div>

                                        <div class="w-11 h-11 rounded-2xl flex items-center justify-center shrink-0 <?php echo esc_attr( $cs_pal['icon_solid'] ); ?>">
                                            <?php echo wakalumi_render_bm_icon( $cs_icon, 'w-5 h-5' ); ?>
                                        </div>
                                    </div>

                                    <?php if ( ! empty( $cs['desc'] ) ) : ?>
                                        <p class="text-sm sm:text-[15px] text-slate-600 dark:text-slate-300 leading-relaxed">
                                            <?php echo nl2br( esc_html( $cs['desc'] ) ); ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $cs['image'] ) ) : ?>
                                        <div class="rounded-2xl overflow-hidden border border-slate-200/80 dark:border-dark-border cursor-pointer"
                                             onclick="wklOpenBmLightbox('<?php echo esc_js( $cs['image'] ); ?>', '<?php echo esc_js( $cs['title'] ?? '' ); ?>')">
                                            <img src="<?php echo esc_url( $cs['image'] ); ?>" alt="<?php echo esc_attr( $cs['title'] ?? '' ); ?>" class="w-full max-h-80 object-cover">
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $cs['quote'] ) ) : ?>
                                        <blockquote class="p-4 sm:p-5 rounded-2xl border text-xs sm:text-sm italic font-semibold leading-relaxed <?php echo esc_attr( $cs_pal['quote_box'] ); ?>">
                                            <?php echo nl2br( esc_html( $cs['quote'] ) ); ?>
                                        </blockquote>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $col1 ) || ! empty( $col2 ) ) : ?>
                                        <div class="grid grid-cols-1 <?php echo $has_both ? 'md:grid-cols-2' : ''; ?> gap-5 pt-2">
                                            <?php if ( ! empty( $col1 ) ) : ?>
                                                <div class="rounded-2xl bg-slate-50/90 dark:bg-dark-surface/70 border border-slate-200/90 dark:border-dark-border p-5 space-y-3.5">
                                                    <?php if ( ! empty( $cs['col1_title'] ) ) : ?>
                                                        <h4 class="text-base font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                                                            <span class="w-2 h-5 rounded-full <?php echo esc_attr( $cs_pal['accent_bar'] ); ?>"></span>
                                                            <?php echo esc_html( $cs['col1_title'] ); ?>
                                                        </h4>
                                                    <?php endif; ?>
                                                    <div class="space-y-2.5 <?php echo ! $has_both && count( $col1 ) > 2 ? 'grid grid-cols-1 sm:grid-cols-2 gap-3 space-y-0' : ''; ?>">
                                                        <?php foreach ( $col1 as $c1_raw ) :
                                                            $parsed = wakalumi_parse_bm_list_item( $c1_raw );
                                                        ?>
                                                            <div class="p-3 rounded-xl bg-white dark:bg-dark-card border border-slate-200/70 dark:border-dark-border flex items-start gap-2.5">
                                                                <span class="<?php echo esc_attr( $cs_pal['text_accent'] ); ?> shrink-0 mt-0.5">
                                                                    <?php echo wakalumi_render_bm_icon( 'check-badge', 'w-4 h-4' ); ?>
                                                                </span>
                                                                <div class="text-xs leading-relaxed">
                                                                    <?php if ( ! empty( $parsed['title'] ) ) : ?>
                                                                        <strong class="text-slate-900 dark:text-white font-extrabold block"><?php echo esc_html( $parsed['title'] ); ?></strong>
                                                                    <?php endif; ?>
                                                                    <span class="text-slate-600 dark:text-slate-300"><?php echo esc_html( $parsed['desc'] ); ?></span>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ( ! empty( $col2 ) ) : ?>
                                                <div class="rounded-2xl bg-slate-50/90 dark:bg-dark-surface/70 border border-slate-200/90 dark:border-dark-border p-5 space-y-3.5">
                                                    <?php if ( ! empty( $cs['col2_title'] ) ) : ?>
                                                        <h4 class="text-base font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                                                            <span class="w-2 h-5 rounded-full bg-teal-500"></span>
                                                            <?php echo esc_html( $cs['col2_title'] ); ?>
                                                        </h4>
                                                    <?php endif; ?>
                                                    <div class="space-y-2.5">
                                                        <?php foreach ( $col2 as $c2_raw ) :
                                                            $parsed = wakalumi_parse_bm_list_item( $c2_raw );
                                                        ?>
                                                            <div class="p-3 rounded-xl bg-white dark:bg-dark-card border border-slate-200/70 dark:border-dark-border flex items-start gap-2.5">
                                                                <span class="text-teal-600 dark:text-teal-400 shrink-0 mt-0.5">
                                                                    <?php echo wakalumi_render_bm_icon( 'sparkles', 'w-4 h-4' ); ?>
                                                                </span>
                                                                <div class="text-xs leading-relaxed">
                                                                    <?php if ( ! empty( $parsed['title'] ) ) : ?>
                                                                        <strong class="text-slate-900 dark:text-white font-extrabold block"><?php echo esc_html( $parsed['title'] ); ?></strong>
                                                                    <?php endif; ?>
                                                                    <span class="text-slate-600 dark:text-slate-300"><?php echo esc_html( $parsed['desc'] ); ?></span>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <!-- ====================================================
                                 MODUL 6: GALERI FOTO / INFOGRAFIS (OPSIONAL)
                                 ==================================================== -->
                            <?php if ( ! empty( $item['show_gallery'] ) && ! empty( $gallery ) ) : ?>
                            <div class="rounded-3xl bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border shadow-md p-6 sm:p-8 space-y-4">
                                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">
                                    <?php echo esc_html( $item['gallery_title'] ?? 'Dokumentasi & Infografis' ); ?>
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <?php foreach ( $gallery as $g_img ) : ?>
                                        <div class="group rounded-2xl overflow-hidden border border-slate-200/80 dark:border-dark-border bg-slate-50 dark:bg-dark-surface cursor-pointer"
                                             onclick="wklOpenBmLightbox('<?php echo esc_js( $g_img['url'] ); ?>', '<?php echo esc_js( $g_img['caption'] ?? '' ); ?>')">
                                            <div class="aspect-video overflow-hidden">
                                                <img src="<?php echo esc_url( $g_img['url'] ); ?>" alt="<?php echo esc_attr( $g_img['caption'] ?? '' ); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            </div>
                                            <?php if ( ! empty( $g_img['caption'] ) ) : ?>
                                                <div class="p-3 text-xs font-semibold text-slate-700 dark:text-slate-300">
                                                    <?php echo esc_html( $g_img['caption'] ); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- ====================================================
                                 MODUL 7: TANYA JAWAB / FAQ (OPSIONAL)
                                 ==================================================== -->
                            <?php if ( ! empty( $item['show_faqs'] ) && ! empty( $faqs ) ) :
                                $faq_sec_title = ! empty( $item['faq_section_title'] ) ? $item['faq_section_title'] : ( 'Tanya Jawab Seputar ' . ( $item['short_title'] ?? 'Baitul Maal' ) );
                            ?>
                            <div class="rounded-3xl bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border shadow-md p-6 sm:p-8 space-y-4">
                                <div class="flex items-center gap-2.5 mb-2">
                                    <div class="w-9 h-9 rounded-xl border flex items-center justify-center <?php echo esc_attr( $main_pal['icon_box'] ); ?>">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/></svg>
                                    </div>
                                    <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">
                                        <?php echo esc_html( $faq_sec_title ); ?>
                                    </h3>
                                </div>

                                <div class="space-y-2.5">
                                    <?php foreach ( $faqs as $f_idx => $fq ) : ?>
                                        <div class="rounded-2xl border border-slate-200/80 dark:border-dark-border overflow-hidden bg-slate-50/60 dark:bg-dark-surface/40">
                                            <button type="button"
                                                    onclick="wklToggleBmFaq(this)"
                                                    class="w-full px-4 py-3.5 text-left flex items-center justify-between gap-3 font-bold text-xs sm:text-sm text-slate-800 dark:text-slate-100 hover:text-teal-600 dark:hover:text-teal-300 transition-colors">
                                                <span><?php echo esc_html( $fq['q'] ?? '' ); ?></span>
                                                <svg class="w-4 h-4 text-slate-400 shrink-0 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                                            </button>
                                            <div class="hidden px-4 pb-4 pt-1 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-dark-border/60">
                                                <?php echo nl2br( esc_html( $fq['a'] ?? '' ) ); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>

                        </article>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="wkl-bm-lightbox-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-slate-950/85 backdrop-blur-md p-4" onclick="wklCloseBmLightbox()">
        <div class="relative max-w-4xl w-full bg-white dark:bg-dark-card rounded-3xl overflow-hidden shadow-2xl border border-white/10" onclick="event.stopPropagation()">
            <button type="button" onclick="wklCloseBmLightbox()" class="absolute top-3 right-3 z-10 w-9 h-9 rounded-full bg-slate-900/70 text-white flex items-center justify-center hover:bg-slate-900">✕</button>
            <img id="wkl-bm-lightbox-img" src="" alt="" class="w-full max-h-[80vh] object-contain bg-slate-950">
            <div id="wkl-bm-lightbox-caption" class="p-4 text-center text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-200"></div>
        </div>
    </div>

</main>

<!-- ========================================================================
     MOBILE BOTTOM SHEET DRAWER (TELEPORTED TO BODY FOR ACCURATE VIEWPORT ATTACHMENT)
     ======================================================================== -->
<div id="wkl-bm-drawer-backdrop" 
     onclick="wklCloseBmDrawer()" 
     class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-[9999] opacity-0 pointer-events-none invisible transition-opacity duration-300 lg:hidden"
     aria-hidden="true"></div>

<div id="wkl-bm-drawer" 
     class="fixed inset-x-0 bottom-0 z-[10000] w-full max-w-lg mx-auto bg-white dark:bg-dark-card rounded-t-3xl shadow-2xl border-t border-slate-200/80 dark:border-dark-border transform translate-y-full pointer-events-none invisible transition-all duration-300 ease-out flex flex-col max-h-[82vh] lg:hidden"
     role="dialog"
     aria-modal="true"
     aria-labelledby="wkl-bm-drawer-title">
    
    <!-- Drag Handle / Grab Bar -->
    <div class="pt-3 pb-1 flex justify-center cursor-pointer shrink-0" onclick="wklCloseBmDrawer()">
        <div class="w-12 h-1.5 bg-slate-300 dark:bg-slate-600 rounded-full"></div>
    </div>

    <!-- Drawer Header -->
    <div class="px-5 py-3 border-b border-slate-100 dark:border-dark-border flex items-center justify-between shrink-0">
        <div>
            <div class="flex items-center gap-2 mb-0.5">
                <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                <span class="text-[10px] font-black uppercase tracking-wider text-teal-600 dark:text-teal-400">Pilihan Menu Mobile</span>
            </div>
            <h3 id="wkl-bm-drawer-title" class="text-base font-extrabold text-slate-900 dark:text-white">
                Program Baitul Maal BSW
            </h3>
        </div>
        <button type="button" 
                onclick="wklCloseBmDrawer()" 
                class="w-8 h-8 rounded-full bg-slate-100 dark:bg-dark-surface hover:bg-slate-200 dark:hover:bg-dark-border text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white flex items-center justify-center transition-colors"
                aria-label="Tutup Menu">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Drawer Items List (Scrollable) -->
    <div class="overflow-y-auto p-4 space-y-2.5 flex-1 overscroll-contain">
        <?php 
        foreach ( $items as $idx => $s_item ) : 
            $is_active   = ( 0 === $idx );
            $icon_type   = $s_item['icon'] ?? 'heart';
            $s_color     = ! empty( $s_item['color'] ) ? $s_item['color'] : $sidebar_accents[ $idx % count( $sidebar_accents ) ];
            $s_pal       = wakalumi_get_bm_color_palette( $s_color );
            $item_badge  = $s_item['badge'] ?? '';
        ?>
            <button type="button" 
                    onclick="wklSelectBmFromDrawer('<?php echo esc_js( $s_item['id'] ); ?>')"
                    data-drawer-target="<?php echo esc_attr( $s_item['id'] ); ?>"
                    data-item-index="<?php echo $idx + 1; ?>"
                    data-item-title="<?php echo esc_attr( $s_item['short_title'] ?? $s_item['title'] ); ?>"
                    data-item-badge="<?php echo esc_attr( $item_badge ); ?>"
                    data-item-active-color="<?php echo esc_attr( $s_pal['tab_active_mobile'] ); ?>"
                    data-item-idle-icon="border shadow-2xs <?php echo esc_attr( $s_pal['icon_box'] ); ?>"
                    data-item-badge-class="<?php echo esc_attr( $s_pal['sub_badge'] ); ?>"
                    class="wkl-bm-drawer-item w-full text-left p-3.5 rounded-2xl transition-all duration-200 flex items-center gap-3.5 border <?php echo $is_active ? 'active bg-teal-50/70 dark:bg-teal-950/40 border-teal-500 shadow-sm' : 'bg-slate-50/70 dark:bg-dark-surface/50 border-slate-200/70 dark:border-dark-border/80 hover:bg-slate-100 dark:hover:bg-dark-surface'; ?>">
                
                <div class="wkl-bm-drawer-icon-box w-10 h-10 rounded-xl flex items-center justify-center shrink-0 <?php echo $is_active ? esc_attr( $s_pal['tab_active_mobile'] ) . ' text-white shadow-xs' : 'border shadow-2xs ' . esc_attr( $s_pal['icon_box'] ); ?>">
                    <span class="wkl-bm-drawer-icon-svg">
                        <?php echo wakalumi_render_bm_icon( $icon_type, 'w-5 h-5 ' . ( $is_active ? 'text-white' : '' ) ); ?>
                    </span>
                </div>

                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-2">
                        <h4 class="text-xs sm:text-sm font-bold truncate <?php echo $is_active ? 'text-teal-900 dark:text-teal-100 font-extrabold' : 'text-slate-900 dark:text-white'; ?>">
                            <?php echo esc_html( $s_item['short_title'] ?? $s_item['title'] ); ?>
                        </h4>
                        <?php if ( ! empty( $item_badge ) ) : ?>
                            <span class="text-[9px] px-1.5 py-0.2 rounded-full font-bold border <?php echo esc_attr( $s_pal['sub_badge'] ); ?> shrink-0">
                                <?php echo esc_html( $item_badge ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <?php if ( ! empty( $s_item['summary'] ) ) : ?>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 line-clamp-1 mt-0.5">
                            <?php echo esc_html( $s_item['summary'] ); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="wkl-bm-drawer-check shrink-0 <?php echo $is_active ? 'block' : 'hidden'; ?>">
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
                onclick="wklCloseBmDrawer()" 
                class="w-full py-2.5 rounded-xl bg-slate-200/80 dark:bg-dark-surface hover:bg-slate-300 dark:hover:bg-dark-border text-slate-700 dark:text-slate-300 font-bold text-xs transition-colors">
            Tutup
        </button>
    </div>
</div>

    <!-- ========================================================================
         CLIENT-SIDE INTERACTIVE JS LOGIC (Tabs, Drawer, FAQ, Lightbox)
         ======================================================================== -->
    <script>
    // Teleport drawer and backdrop to document.body on load so they are never trapped in containing blocks
    function wklInitBmDrawer() {
        var drawer = document.getElementById('wkl-bm-drawer');
        var backdrop = document.getElementById('wkl-bm-drawer-backdrop');
        if (!drawer) return;

        // Clean up any stale orphaned drawer/backdrop from previous Swup navigation
        var allDrawers = document.querySelectorAll('#wkl-bm-drawer');
        if (allDrawers.length > 1) {
            allDrawers.forEach(function(el) {
                if (el !== drawer && el.parentElement === document.body) {
                    el.remove();
                }
            });
        }
        var allBackdrops = document.querySelectorAll('#wkl-bm-drawer-backdrop');
        if (allBackdrops.length > 1) {
            allBackdrops.forEach(function(el) {
                if (el !== backdrop && el.parentElement === document.body) {
                    el.remove();
                }
            });
        }

        if (drawer.parentElement !== document.body) {
            document.body.appendChild(drawer);
        }
        if (backdrop && backdrop.parentElement !== document.body) {
            document.body.appendChild(backdrop);
        }

        // Register Swup cleanup hook when leaving this page
        if (window.swup && window.swup.hooks && !window._wklBmSwupCleanBound) {
            window._wklBmSwupCleanBound = true;
            window.swup.hooks.once('visit:start', function() {
                window._wklBmSwupCleanBound = false;
                var d = document.getElementById('wkl-bm-drawer');
                var b = document.getElementById('wkl-bm-drawer-backdrop');
                if (d && d.parentElement === document.body) d.remove();
                if (b && b.parentElement === document.body) b.remove();
                document.body.style.overflow = '';
            });
        }
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', wklInitBmDrawer);
    } else {
        wklInitBmDrawer();
    }

    function wklOpenBmDrawer() {
        wklInitBmDrawer();
        var drawer = document.getElementById('wkl-bm-drawer');
        var backdrop = document.getElementById('wkl-bm-drawer-backdrop');
        if (!drawer || !backdrop) return;

        backdrop.classList.remove('opacity-0', 'pointer-events-none', 'invisible');
        backdrop.classList.add('opacity-100', 'pointer-events-auto');

        drawer.classList.remove('translate-y-full', 'pointer-events-none', 'invisible');
        drawer.classList.add('translate-y-0');

        document.body.style.overflow = 'hidden';
    }

    function wklCloseBmDrawer() {
        var drawer = document.getElementById('wkl-bm-drawer');
        var backdrop = document.getElementById('wkl-bm-drawer-backdrop');
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

    function wklSelectBmFromDrawer(tabId) {
        wklSwitchBmTab(tabId);
        wklCloseBmDrawer();

        // Smooth scroll ke awal pane dengan offset tepat di bawah sticky bar
        var targetPane = document.getElementById('bm-pane-' + tabId);
        if (targetPane) {
            var stickyBar = document.getElementById('wkl-bm-sticky-wrapper');
            var offset = (stickyBar ? stickyBar.offsetHeight : 55) + 80;
            var elementPosition = targetPane.getBoundingClientRect().top;
            var offsetPosition = elementPosition + window.pageYOffset - offset;
            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    }

    function wklSwitchBmTab(tabId) {
        // 1. Sembunyikan semua pane, tampilkan target
        document.querySelectorAll('.wkl-bm-pane').forEach(function(pane) {
            if (pane.id === 'bm-pane-' + tabId) {
                pane.classList.remove('hidden');
                pane.classList.add('block');
            } else {
                pane.classList.remove('block');
                pane.classList.add('hidden');
            }
        });

        // 2. Update status tombol sidebar desktop
        document.querySelectorAll('.wkl-bm-tab-btn').forEach(function(btn) {
            const isTarget = btn.getAttribute('data-bm-tab-target') === tabId;
            const iconBox = btn.querySelector('.wkl-bm-tab-icon');
            const titleEl = btn.querySelector('h4');
            const summaryEl = btn.querySelector('p');
            const arrowEl = btn.querySelector('div:last-child svg');
            const activeBtnClass = btn.getAttribute('data-bm-active-class') || 'bg-gradient-to-br from-teal-600 via-teal-600 to-emerald-700 text-white border-teal-500 shadow-lg shadow-teal-600/25';
            const idleBtnClass = btn.getAttribute('data-bm-idle-class') || 'bg-slate-50/80 dark:bg-dark-surface/60 text-slate-700 dark:text-slate-200 border-slate-200/70 dark:border-dark-border/80 hover:bg-slate-100/90 dark:hover:bg-dark-surface hover:border-teal-300 dark:hover:border-teal-700/60';
            const idleIconClass = btn.getAttribute('data-bm-icon-idle-class') || 'w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-105 bg-white dark:bg-dark-card text-teal-600 dark:text-teal-400 border border-slate-200/80 dark:border-dark-border shadow-2xs';

            if (isTarget) {
                btn.className = 'wkl-bm-tab-btn w-full text-left p-3.5 rounded-2xl transition-all duration-300 flex items-start gap-3.5 border group relative active ' + activeBtnClass;
                if (iconBox) iconBox.className = 'wkl-bm-tab-icon w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover:scale-105 bg-white/20 text-white shadow-xs';
                if (titleEl) titleEl.className = 'text-xs sm:text-sm font-bold tracking-tight truncate text-white';
                if (summaryEl) summaryEl.className = 'text-[11px] leading-snug line-clamp-2 text-white/90 font-medium';
                if (arrowEl) arrowEl.className = 'w-4 h-4 transition-transform duration-300 group-hover:translate-x-1 text-white';
            } else {
                btn.className = 'wkl-bm-tab-btn w-full text-left p-3.5 rounded-2xl transition-all duration-300 flex items-start gap-3.5 border group relative ' + idleBtnClass;
                if (iconBox) iconBox.className = 'wkl-bm-tab-icon ' + idleIconClass;
                if (titleEl) titleEl.className = 'text-xs sm:text-sm font-bold tracking-tight truncate text-slate-900 dark:text-white';
                if (summaryEl) summaryEl.className = 'text-[11px] leading-snug line-clamp-2 text-slate-500 dark:text-slate-400';
                if (arrowEl) arrowEl.className = 'w-4 h-4 transition-transform duration-300 group-hover:translate-x-1 text-slate-400 dark:text-slate-500';
            }
        });

        // 3. Update drawer items & sinkronisasi ke Mobile Sticky Bar
        var drawerItems = document.querySelectorAll('.wkl-bm-drawer-item');
        drawerItems.forEach(function(item) {
            var isThis = (item.getAttribute('data-drawer-target') === tabId);
            var checkEl = item.querySelector('.wkl-bm-drawer-check');
            var iconBox = item.querySelector('.wkl-bm-drawer-icon-box');
            var iconSvg = item.querySelector('.wkl-bm-drawer-icon-svg');
            var titleEl = item.querySelector('h4');
            var activeColorClass = item.getAttribute('data-item-active-color') || '';
            var idleIconClass = item.getAttribute('data-item-idle-icon') || '';

            if (isThis) {
                item.className = 'wkl-bm-drawer-item active w-full text-left p-3.5 rounded-2xl transition-all duration-200 flex items-center gap-3.5 border bg-teal-50/70 dark:bg-teal-950/40 border-teal-500 shadow-sm';
                if (iconBox) iconBox.className = 'wkl-bm-drawer-icon-box w-10 h-10 rounded-xl flex items-center justify-center shrink-0 text-white shadow-xs ' + activeColorClass;
                if (titleEl) titleEl.className = 'text-xs sm:text-sm font-bold truncate text-teal-900 dark:text-teal-100 font-extrabold';
                if (checkEl) checkEl.className = 'wkl-bm-drawer-check shrink-0 block';

                // Sinkronisasi data ke Mobile Sticky Bar
                var stickyTitle = document.getElementById('wkl-bm-active-title');
                var stickyCounter = document.getElementById('wkl-bm-active-counter');
                var stickyBadge = document.getElementById('wkl-bm-active-badge');
                var stickyIcon = document.getElementById('wkl-bm-active-icon');
                var stickyIconBox = document.getElementById('wkl-bm-active-icon-box');

                if (stickyTitle) stickyTitle.textContent = item.getAttribute('data-item-title') || '';
                if (stickyCounter) {
                    var idx = item.getAttribute('data-item-index') || '1';
                    var total = drawerItems.length;
                    stickyCounter.textContent = idx + ' / ' + total;
                }
                if (stickyBadge) {
                    var badgeText = item.getAttribute('data-item-badge') || '';
                    if (badgeText) {
                        stickyBadge.textContent = badgeText;
                        stickyBadge.classList.remove('hidden');
                    } else {
                        stickyBadge.classList.add('hidden');
                    }
                }
                if (stickyIconBox && activeColorClass) {
                    stickyIconBox.className = 'w-10 h-10 rounded-xl flex items-center justify-center shrink-0 shadow-xs ' + activeColorClass;
                }
                if (stickyIcon && iconSvg) {
                    stickyIcon.innerHTML = iconSvg.innerHTML;
                }
            } else {
                item.className = 'wkl-bm-drawer-item w-full text-left p-3.5 rounded-2xl transition-all duration-200 flex items-center gap-3.5 border bg-slate-50/70 dark:bg-dark-surface/50 border-slate-200/70 dark:border-dark-border/80 hover:bg-slate-100 dark:hover:bg-dark-surface';
                if (iconBox) iconBox.className = 'wkl-bm-drawer-icon-box w-10 h-10 rounded-xl flex items-center justify-center shrink-0 ' + idleIconClass;
                if (titleEl) titleEl.className = 'text-xs sm:text-sm font-bold truncate text-slate-900 dark:text-white';
                if (checkEl) checkEl.className = 'wkl-bm-drawer-check shrink-0 hidden';
            }
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            wklCloseBmDrawer();
            wklCloseBmLightbox();
        }
    });

    function wklToggleBmFaq(btn) {
        const content = btn.nextElementSibling;
        const icon = btn.querySelector('svg');
        if (!content) return;
        const isHidden = content.classList.contains('hidden');
        if (isHidden) {
            content.classList.remove('hidden');
            if (icon) icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            if (icon) icon.style.transform = 'rotate(0deg)';
        }
    }

    function wklOpenBmLightbox(url, caption) {
        const modal = document.getElementById('wkl-bm-lightbox-modal');
        const img = document.getElementById('wkl-bm-lightbox-img');
        const cap = document.getElementById('wkl-bm-lightbox-caption');
        if (!modal || !img) return;
        img.src = url;
        if (cap) cap.textContent = caption || '';
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function wklCloseBmLightbox() {
        const modal = document.getElementById('wkl-bm-lightbox-modal');
        if (!modal) return;
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    // Attach all functions to window for global access across Swup page views
    window.wklInitBmDrawer = wklInitBmDrawer;
    window.wklOpenBmDrawer = wklOpenBmDrawer;
    window.wklCloseBmDrawer = wklCloseBmDrawer;
    window.wklSelectBmFromDrawer = wklSelectBmFromDrawer;
    window.wklSwitchBmTab = wklSwitchBmTab;
    window.wklToggleBmFaq = wklToggleBmFaq;
    window.wklOpenBmLightbox = wklOpenBmLightbox;
    window.wklCloseBmLightbox = wklCloseBmLightbox;
    </script>

<?php get_footer(); ?>
