<?php
/**
 * Template Name: Brosur & Dokumen Resmi
 * Description: Halaman Pusat Unduhan Brosur, Formulir, dan Dokumen Produk Syariah BPRS Wakalumi.
 *              Dilengkapi Preview PDF Modal Interaktif, Filter Real-time, dan Terintegrasi CMS.
 *
 * @package Wakalumi
 */

get_header();

// ── 1. AMBIL PENGATURAN HEADER BANNER DARI ADMIN ───────────────────
$page_badge = get_option( 'options_brosur_page_badge', 'Dokumen Resmi & Literasi Syariah' );
$page_title = get_option( 'options_brosur_page_title', 'Pusat Unduhan Brosur & Panduan Produk' );
$page_sub   = get_option( 'options_brosur_page_sub', 'Akses materi resmi, ringkasan akad syariah, tarif nisbah, dan panduan persyaratan pembukaan rekening serta pengajuan pembiayaan BPRS Wakalumi dalam format digital.' );

// ── 2. AMBIL DATA BROSUR UTAMA RESMI (FEATURED BROCHURE) ───────────
$primary_brosur = function_exists( 'wakalumi_get_brosur_primary' ) ? wakalumi_get_brosur_primary() : [];
$p_file         = $primary_brosur['file_url'] ?? '';
$p_name         = ! empty( $primary_brosur['file_name'] ) ? $primary_brosur['file_name'] : 'Brosur Resmi Produk BPRS Wakalumi (Edisi 2026).pdf';
$p_size         = ! empty( $primary_brosur['file_size'] ) ? $primary_brosur['file_size'] : 'PDF Resmi • 2.4 MB';
$p_cover        = $primary_brosur['cover'] ?? '';
$p_desc         = ! empty( $primary_brosur['desc'] ) ? $primary_brosur['desc'] : 'Katalog panduan komprehensif seluruh produk simpanan syariah, deposito mudharabah, dan pembiayaan syariah BPRS Wakalumi.';
$p_version      = ! empty( $primary_brosur['version'] ) ? $primary_brosur['version'] : 'Edisi 2026';
$p_badge        = ! empty( $primary_brosur['featured_badge'] ) ? $primary_brosur['featured_badge'] : 'Katalog Resmi Komprehensif';

// ── 3. AMBIL DAFTAR BROSUR SPESIFIK PRODUK ─────────────────────────
$brosur_list = function_exists( 'wakalumi_get_brosur_list' ) ? wakalumi_get_brosur_list() : [];

// ── 4. AMBIL DATA TATA KELOLA & REGULASI DINAMIS ────────────────────
$brosur_gov = function_exists( 'wakalumi_get_brosur_governance' ) ? wakalumi_get_brosur_governance() : [
    'show'   => true,
    'kicker' => 'Tata Kelola & Transparansi',
    'title'  => 'Keamanan, Legalitas & Kepatuhan Terjamin',
    'desc'   => 'Seluruh produk perbankan syariah dan penerbitan materi informasi BPRS Wakalumi dijalankan berlandaskan regulasi resmi otoritas keuangan nasional.',
    'cards'  => [],
];

// ── 5. WHATSAPP & KONTAK ───────────────────────────────────────────
$default_wa = get_option( 'options_contact_wa', '6281517380388' );
$wa_number  = get_option( 'options_produk_wa_number', $default_wa );
$clean_wa   = preg_replace( '/[^0-9]/', '', $wa_number );
$default_wa_link = 'https://wa.me/' . $clean_wa . '?text=' . rawurlencode( 'Halo BPRS Wakalumi, saya ingin menanyakan informasi mengenai brosur dan dokumen produk.' );

// Filter list agar HANYA dokumen brosur produk syariah yang diproses (GCG/Laporan dipisahkan ke halaman khusus)
$clean_brosur_list = [];
foreach ( $brosur_list as $b_item ) {
    $title_chk = strtolower( trim( $b_item['title'] ?? '' ) );
    $kat_chk   = strtolower( trim( $b_item['kategori'] ?? '' ) );
    if ( strpos( $kat_chk, 'lapor' ) !== false || strpos( $kat_chk, 'publikasi' ) !== false || strpos( $kat_chk, 'gcg' ) !== false || strpos( $title_chk, 'laporan publikasi' ) !== false || strpos( $title_chk, 'gcg' ) !== false ) {
        continue;
    }
    $clean_brosur_list[] = $b_item;
}
$brosur_list = $clean_brosur_list;

// ── 6. HITUNG JUMLAH DOKUMEN PER KATEGORI UNTUK FILTER ─────────────
$category_counts = [
    'all'                 => count( $brosur_list ),
    'penghimpunan-dana'   => 0,
    'penyaluran-dana'     => 0,
    'program-khusus'      => 0,
];

foreach ( $brosur_list as $item ) {
    $raw_kat = strtolower( trim( $item['kategori'] ?? '' ) );
    if ( strpos( $raw_kat, 'himpun' ) !== false || strpos( $raw_kat, 'tabung' ) !== false || strpos( $raw_kat, 'deposito' ) !== false ) {
        $category_counts['penghimpunan-dana']++;
    } elseif ( strpos( $raw_kat, 'salur' ) !== false || strpos( $raw_kat, 'biaya' ) !== false || strpos( $raw_kat, 'usaha' ) !== false ) {
        $category_counts['penyaluran-dana']++;
    } elseif ( strpos( $raw_kat, 'program' ) !== false || strpos( $raw_kat, 'khusus' ) !== false || strpos( $raw_kat, 'akad' ) !== false ) {
        $category_counts['program-khusus']++;
    }
}

/**
 * Helper menentukan slug kategori
 */
function wakalumi_get_kategori_slug( $kategori ) {
    $raw = strtolower( trim( $kategori ) );
    if ( strpos( $raw, 'himpun' ) !== false || strpos( $raw, 'tabung' ) !== false || strpos( $raw, 'deposito' ) !== false ) {
        return 'penghimpunan-dana';
    } elseif ( strpos( $raw, 'salur' ) !== false || strpos( $raw, 'biaya' ) !== false || strpos( $raw, 'usaha' ) !== false ) {
        return 'penyaluran-dana';
    } elseif ( strpos( $raw, 'program' ) !== false || strpos( $raw, 'khusus' ) !== false || strpos( $raw, 'akad' ) !== false ) {
        return 'program-khusus';
    }
    return 'lainnya';
}

/**
 * Helper badge styling per kategori
 */
function wakalumi_get_kategori_badge_style( $slug ) {
    switch ( $slug ) {
        case 'penghimpunan-dana':
            return 'bg-teal-50 dark:bg-teal-950/70 text-teal-700 dark:text-teal-300 border-teal-200 dark:border-teal-800';
        case 'penyaluran-dana':
            return 'bg-blue-50 dark:bg-blue-950/70 text-blue-700 dark:text-blue-300 border-blue-200 dark:border-blue-800';
        case 'program-khusus':
            return 'bg-amber-50 dark:bg-amber-950/70 text-amber-800 dark:text-amber-300 border-amber-200 dark:border-amber-800';
        default:
            return 'bg-slate-100 dark:bg-dark-surface-alt text-slate-700 dark:text-slate-300 border-slate-200 dark:border-dark-border';
    }
}

/**
 * Helper tema styling dinamis kartu brosur produk (Warna & Efek Hidup)
 */
function wakalumi_get_brosur_card_theme( $color = 'teal' ) {
    $themes = [
        'teal' => [
            'name'             => 'teal',
            'top_border'       => 'from-teal-500 via-cyan-400 to-teal-600',
            'hover_border'     => 'hover:border-teal-400/90 dark:hover:border-teal-500/80',
            'hover_shadow'     => 'hover:shadow-teal-500/20',
            'aura_gradient'    => 'from-teal-500/25 via-cyan-500/20 to-teal-600/25',
            'title_hover'      => 'group-hover:text-teal-600 dark:group-hover:text-teal-400',
            'badge_style'      => 'bg-teal-50 dark:bg-teal-950/80 text-teal-700 dark:text-teal-300 border-teal-200/80 dark:border-teal-800/80',
            'meta_icon'        => 'text-teal-500',
            'btn_preview'      => 'hover:bg-teal-50 dark:hover:bg-teal-950/40 hover:text-teal-700 dark:hover:text-teal-300 hover:border-teal-300/60 dark:hover:border-teal-700/60',
            'btn_download'     => 'bg-teal-600 hover:bg-teal-700 text-white shadow-teal-600/20 hover:shadow-teal-600/35',
            'placeholder_bg'   => 'from-teal-500/15 via-teal-500/5 to-slate-100 dark:from-teal-950/60 dark:via-teal-900/20 dark:to-dark-surface',
            'placeholder_icon' => 'text-teal-600 dark:text-teal-400',
        ],
        'emerald' => [
            'name'             => 'emerald',
            'top_border'       => 'from-emerald-500 via-teal-400 to-emerald-600',
            'hover_border'     => 'hover:border-emerald-400/90 dark:hover:border-emerald-500/80',
            'hover_shadow'     => 'hover:shadow-emerald-500/20',
            'aura_gradient'    => 'from-emerald-500/25 via-teal-500/20 to-emerald-600/25',
            'title_hover'      => 'group-hover:text-emerald-600 dark:group-hover:text-emerald-400',
            'badge_style'      => 'bg-emerald-50 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 border-emerald-200/80 dark:border-emerald-800/80',
            'meta_icon'        => 'text-emerald-500',
            'btn_preview'      => 'hover:bg-emerald-50 dark:hover:bg-emerald-950/40 hover:text-emerald-700 dark:hover:text-emerald-300 hover:border-emerald-300/60 dark:hover:border-emerald-700/60',
            'btn_download'     => 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/20 hover:shadow-emerald-600/35',
            'placeholder_bg'   => 'from-emerald-500/15 via-emerald-500/5 to-slate-100 dark:from-emerald-950/60 dark:via-emerald-900/20 dark:to-dark-surface',
            'placeholder_icon' => 'text-emerald-600 dark:text-emerald-400',
        ],
        'blue' => [
            'name'             => 'blue',
            'top_border'       => 'from-blue-500 via-sky-400 to-indigo-600',
            'hover_border'     => 'hover:border-blue-400/90 dark:hover:border-blue-500/80',
            'hover_shadow'     => 'hover:shadow-blue-500/20',
            'aura_gradient'    => 'from-blue-500/25 via-sky-500/20 to-indigo-600/25',
            'title_hover'      => 'group-hover:text-blue-600 dark:group-hover:text-blue-400',
            'badge_style'      => 'bg-blue-50 dark:bg-blue-950/80 text-blue-700 dark:text-blue-300 border-blue-200/80 dark:border-blue-800/80',
            'meta_icon'        => 'text-blue-500',
            'btn_preview'      => 'hover:bg-blue-50 dark:hover:bg-blue-950/40 hover:text-blue-700 dark:hover:text-blue-300 hover:border-blue-300/60 dark:hover:border-blue-700/60',
            'btn_download'     => 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-600/20 hover:shadow-blue-600/35',
            'placeholder_bg'   => 'from-blue-500/15 via-sky-500/5 to-slate-100 dark:from-blue-950/60 dark:via-blue-900/20 dark:to-dark-surface',
            'placeholder_icon' => 'text-blue-600 dark:text-blue-400',
        ],
        'amber' => [
            'name'             => 'amber',
            'top_border'       => 'from-amber-500 via-yellow-400 to-orange-500',
            'hover_border'     => 'hover:border-amber-400/90 dark:hover:border-amber-500/80',
            'hover_shadow'     => 'hover:shadow-amber-500/20',
            'aura_gradient'    => 'from-amber-500/25 via-yellow-500/20 to-orange-500/25',
            'title_hover'      => 'group-hover:text-amber-600 dark:group-hover:text-amber-400',
            'badge_style'      => 'bg-amber-50 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300 border-amber-200/80 dark:border-amber-800/80',
            'meta_icon'        => 'text-amber-500',
            'btn_preview'      => 'hover:bg-amber-50 dark:hover:bg-amber-950/40 hover:text-amber-800 dark:hover:text-amber-300 hover:border-amber-300/60 dark:hover:border-amber-700/60',
            'btn_download'     => 'bg-amber-600 hover:bg-amber-700 text-white shadow-amber-600/20 hover:shadow-amber-600/35',
            'placeholder_bg'   => 'from-amber-500/15 via-yellow-500/5 to-slate-100 dark:from-amber-950/60 dark:via-amber-900/20 dark:to-dark-surface',
            'placeholder_icon' => 'text-amber-600 dark:text-amber-400',
        ],
        'purple' => [
            'name'             => 'purple',
            'top_border'       => 'from-purple-500 via-fuchsia-400 to-indigo-600',
            'hover_border'     => 'hover:border-purple-400/90 dark:hover:border-purple-500/80',
            'hover_shadow'     => 'hover:shadow-purple-500/20',
            'aura_gradient'    => 'from-purple-500/25 via-fuchsia-500/20 to-indigo-600/25',
            'title_hover'      => 'group-hover:text-purple-600 dark:group-hover:text-purple-400',
            'badge_style'      => 'bg-purple-50 dark:bg-purple-950/80 text-purple-700 dark:text-purple-300 border-purple-200/80 dark:border-purple-800/80',
            'meta_icon'        => 'text-purple-500',
            'btn_preview'      => 'hover:bg-purple-50 dark:hover:bg-purple-950/40 hover:text-purple-700 dark:hover:text-purple-300 hover:border-purple-300/60 dark:hover:border-purple-700/60',
            'btn_download'     => 'bg-purple-600 hover:bg-purple-700 text-white shadow-purple-600/20 hover:shadow-purple-600/35',
            'placeholder_bg'   => 'from-purple-500/15 via-purple-500/5 to-slate-100 dark:from-purple-950/60 dark:via-purple-900/20 dark:to-dark-surface',
            'placeholder_icon' => 'text-purple-600 dark:text-purple-400',
        ],
        'rose' => [
            'name'             => 'rose',
            'top_border'       => 'from-rose-500 via-pink-400 to-red-600',
            'hover_border'     => 'hover:border-rose-400/90 dark:hover:border-rose-500/80',
            'hover_shadow'     => 'hover:shadow-rose-500/20',
            'aura_gradient'    => 'from-rose-500/25 via-pink-500/20 to-red-600/25',
            'title_hover'      => 'group-hover:text-rose-600 dark:group-hover:text-rose-400',
            'badge_style'      => 'bg-rose-50 dark:bg-rose-950/80 text-rose-700 dark:text-rose-300 border-rose-200/80 dark:border-rose-800/80',
            'meta_icon'        => 'text-rose-500',
            'btn_preview'      => 'hover:bg-rose-50 dark:hover:bg-rose-950/40 hover:text-rose-700 dark:hover:text-rose-300 hover:border-rose-300/60 dark:hover:border-rose-700/60',
            'btn_download'     => 'bg-rose-600 hover:bg-rose-700 text-white shadow-rose-600/20 hover:shadow-rose-600/35',
            'placeholder_bg'   => 'from-rose-500/15 via-rose-500/5 to-slate-100 dark:from-rose-950/60 dark:via-rose-900/20 dark:to-dark-surface',
            'placeholder_icon' => 'text-rose-600 dark:text-rose-400',
        ],
    ];

    return $themes[$color] ?? $themes['teal'];
}

/**
 * Helper tema styling dual-tone untuk kartu tata kelola & transparansi
 */
function wakalumi_get_gov_dual_tone_theme( $color = 'rose', $index = 0 ) {
    if ( empty( $color ) ) {
        $fallbacks = ['rose', 'blue', 'emerald'];
        $color = $fallbacks[$index % 3];
    }

    $themes = [
        'rose' => [
            'upper_zone'       => 'bg-rose-50/95 dark:bg-rose-950/50 border-b border-rose-200/90 dark:border-rose-900/70',
            'top_border'       => 'from-rose-500 via-red-500 to-rose-600',
            'hover_shadow'     => 'hover:shadow-rose-500/20',
            'aura_gradient'    => 'from-rose-500/25 via-red-500/15 to-transparent',
            'icon_box'         => 'from-rose-500 via-rose-600 to-red-700',
            'icon_shadow'      => 'shadow-rose-500/30',
            'badge_style'      => 'bg-rose-200/80 dark:bg-rose-900/80 text-rose-900 dark:text-rose-200 border border-rose-300/80 dark:border-rose-700/80',
            'authority_kicker' => 'text-rose-700 dark:text-rose-400',
            'title_hover'      => 'group-hover:text-rose-600 dark:group-hover:text-rose-400',
            'lower_zone'       => 'bg-white dark:bg-dark-card',
            'legal_strip'      => 'bg-rose-50/70 dark:bg-dark-surface/90 border border-rose-200/70 dark:border-dark-border',
            'check_box'        => 'bg-rose-100 dark:bg-rose-950/70 text-rose-700 dark:text-rose-300',
            'check_icon'       => 'text-rose-600 dark:text-rose-400',
            'hover_border'     => 'hover:border-rose-400/80 dark:hover:border-rose-700/80',
        ],
        'blue' => [
            'upper_zone'       => 'bg-sky-50/95 dark:bg-sky-950/50 border-b border-sky-200/90 dark:border-sky-900/70',
            'top_border'       => 'from-cyan-500 via-blue-500 to-indigo-600',
            'hover_shadow'     => 'hover:shadow-blue-500/20',
            'aura_gradient'    => 'from-cyan-500/25 via-blue-500/15 to-transparent',
            'icon_box'         => 'from-cyan-500 via-blue-600 to-indigo-700',
            'icon_shadow'      => 'shadow-blue-500/30',
            'badge_style'      => 'bg-sky-200/80 dark:bg-sky-900/80 text-sky-900 dark:text-sky-200 border border-sky-300/80 dark:border-sky-700/80',
            'authority_kicker' => 'text-sky-700 dark:text-sky-400',
            'title_hover'      => 'group-hover:text-blue-600 dark:group-hover:text-blue-400',
            'lower_zone'       => 'bg-white dark:bg-dark-card',
            'legal_strip'      => 'bg-sky-50/70 dark:bg-dark-surface/90 border border-sky-200/70 dark:border-dark-border',
            'check_box'        => 'bg-sky-100 dark:bg-sky-950/70 text-sky-700 dark:text-sky-300',
            'check_icon'       => 'text-blue-600 dark:text-blue-400',
            'hover_border'     => 'hover:border-sky-400/80 dark:hover:border-sky-700/80',
        ],
        'emerald' => [
            'upper_zone'       => 'bg-emerald-50/95 dark:bg-emerald-950/50 border-b border-emerald-200/90 dark:border-emerald-900/70',
            'top_border'       => 'from-emerald-500 via-teal-400 to-emerald-600',
            'hover_shadow'     => 'hover:shadow-emerald-500/20',
            'aura_gradient'    => 'from-emerald-500/25 via-teal-500/15 to-transparent',
            'icon_box'         => 'from-emerald-500 via-teal-600 to-emerald-700',
            'icon_shadow'      => 'shadow-emerald-500/30',
            'badge_style'      => 'bg-emerald-200/80 dark:bg-emerald-900/80 text-emerald-900 dark:text-emerald-200 border border-emerald-300/80 dark:border-emerald-700/80',
            'authority_kicker' => 'text-emerald-700 dark:text-emerald-400',
            'title_hover'      => 'group-hover:text-emerald-600 dark:group-hover:text-emerald-400',
            'lower_zone'       => 'bg-white dark:bg-dark-card',
            'legal_strip'      => 'bg-emerald-50/70 dark:bg-dark-surface/90 border border-emerald-200/70 dark:border-dark-border',
            'check_box'        => 'bg-emerald-100 dark:bg-emerald-950/70 text-emerald-700 dark:text-emerald-300',
            'check_icon'       => 'text-emerald-600 dark:text-emerald-400',
            'hover_border'     => 'hover:border-emerald-400/80 dark:hover:border-emerald-700/80',
        ],
        'teal' => [
            'upper_zone'       => 'bg-teal-50/95 dark:bg-teal-950/50 border-b border-teal-200/90 dark:border-teal-900/70',
            'top_border'       => 'from-teal-500 via-cyan-400 to-teal-600',
            'hover_shadow'     => 'hover:shadow-teal-500/20',
            'aura_gradient'    => 'from-teal-500/25 via-cyan-500/15 to-transparent',
            'icon_box'         => 'from-teal-500 via-cyan-600 to-teal-700',
            'icon_shadow'      => 'shadow-teal-500/30',
            'badge_style'      => 'bg-teal-200/80 dark:bg-teal-900/80 text-teal-900 dark:text-teal-200 border border-teal-300/80 dark:border-teal-700/80',
            'authority_kicker' => 'text-teal-700 dark:text-teal-400',
            'title_hover'      => 'group-hover:text-teal-600 dark:group-hover:text-teal-400',
            'lower_zone'       => 'bg-white dark:bg-dark-card',
            'legal_strip'      => 'bg-teal-50/70 dark:bg-dark-surface/90 border border-teal-200/70 dark:border-dark-border',
            'check_box'        => 'bg-teal-100 dark:bg-teal-950/70 text-teal-700 dark:text-teal-300',
            'check_icon'       => 'text-teal-600 dark:text-teal-400',
            'hover_border'     => 'hover:border-teal-400/80 dark:hover:border-teal-700/80',
        ],
        'amber' => [
            'upper_zone'       => 'bg-amber-50/95 dark:bg-amber-950/50 border-b border-amber-200/90 dark:border-amber-900/70',
            'top_border'       => 'from-amber-500 via-yellow-400 to-orange-500',
            'hover_shadow'     => 'hover:shadow-amber-500/20',
            'aura_gradient'    => 'from-amber-500/25 via-yellow-500/15 to-transparent',
            'icon_box'         => 'from-amber-500 via-yellow-500 to-orange-600',
            'icon_shadow'      => 'shadow-amber-500/30',
            'badge_style'      => 'bg-amber-200/80 dark:bg-amber-900/80 text-amber-900 dark:text-amber-200 border border-amber-300/80 dark:border-amber-700/80',
            'authority_kicker' => 'text-amber-800 dark:text-amber-400',
            'title_hover'      => 'group-hover:text-amber-600 dark:group-hover:text-amber-400',
            'lower_zone'       => 'bg-white dark:bg-dark-card',
            'legal_strip'      => 'bg-amber-50/70 dark:bg-dark-surface/90 border border-amber-200/70 dark:border-dark-border',
            'check_box'        => 'bg-amber-100 dark:bg-amber-950/70 text-amber-800 dark:text-amber-300',
            'check_icon'       => 'text-amber-600 dark:text-amber-400',
            'hover_border'     => 'hover:border-amber-400/80 dark:hover:border-amber-700/80',
        ],
        'purple' => [
            'upper_zone'       => 'bg-purple-50/95 dark:bg-purple-950/50 border-b border-purple-200/90 dark:border-purple-900/70',
            'top_border'       => 'from-purple-500 via-fuchsia-400 to-indigo-600',
            'hover_shadow'     => 'hover:shadow-purple-500/20',
            'aura_gradient'    => 'from-purple-500/25 via-fuchsia-500/15 to-transparent',
            'icon_box'         => 'from-purple-500 via-fuchsia-600 to-indigo-700',
            'icon_shadow'      => 'shadow-purple-500/30',
            'badge_style'      => 'bg-purple-200/80 dark:bg-purple-900/80 text-purple-900 dark:text-purple-200 border border-purple-300/80 dark:border-purple-700/80',
            'authority_kicker' => 'text-purple-700 dark:text-purple-400',
            'title_hover'      => 'group-hover:text-purple-600 dark:group-hover:text-purple-400',
            'lower_zone'       => 'bg-white dark:bg-dark-card',
            'legal_strip'      => 'bg-purple-50/70 dark:bg-dark-surface/90 border border-purple-200/70 dark:border-dark-border',
            'check_box'        => 'bg-purple-100 dark:bg-purple-950/70 text-purple-700 dark:text-purple-300',
            'check_icon'       => 'text-purple-600 dark:text-purple-400',
            'hover_border'     => 'hover:border-purple-400/80 dark:hover:border-purple-700/80',
        ],
    ];

    return $themes[$color] ?? $themes['rose'];
}
?>

<!-- ========================================================================
     HEADER BANNER & BREADCRUMBS (WITH SECURITY BADGE & WATERMARK PASS-THROUGH)
     ======================================================================== -->
<section class="relative z-10 pt-8 pb-12 md:pb-16 overflow-hidden bg-transparent border-b border-slate-200/60 dark:border-dark-border/60">
    <!-- Ambient Blur Glow -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-72 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

    <div class="container-wide relative z-10">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-300 transition-colors flex items-center gap-1.5 font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-slate-500 dark:text-slate-400 font-medium">Produk</span>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-teal-600 dark:text-teal-400 font-semibold">Katalog Brosur</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <!-- Left Column: Title & Intro -->
            <div class="lg:col-span-8" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                    <?php echo esc_html( $page_badge ); ?>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                    <?php echo esc_html( $page_title ); ?>
                </h1>
                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                    <?php echo esc_html( $page_sub ); ?>
                </p>

                <!-- Key Highlights Pills -->
                <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Format PDF High-Res</span>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <span>Pratinjau Langsung (PDF Lightbox)</span>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        <span>Terverifikasi OJK & DPS</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Governance Badge Card with Watermark -->
            <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="100">
                <div class="spotlight-card relative overflow-hidden rounded-3xl p-6 sm:p-7 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-teal-200/80 dark:border-dark-border shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 text-center space-y-4 group cursor-default before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-teal-500 via-cyan-400 to-teal-600">
                    <!-- Interactive Slide Watermark Emblem -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.045] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.08] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                    </div>

                    <!-- Holographic Shield Icon -->
                    <div class="relative w-16 h-16 rounded-2xl bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-300 flex items-center justify-center mx-auto shadow-lg shadow-teal-500/10 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 z-10">
                        <div class="absolute inset-0 rounded-2xl bg-teal-400/20 blur-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <svg class="w-8 h-8 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-teal-50 dark:bg-teal-950 text-teal-700 dark:text-teal-300 text-[10px] font-extrabold uppercase tracking-wider mb-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                            Publikasi Resmi BPRS
                        </div>
                        <h4 class="text-lg font-black text-slate-900 dark:text-white">Akurat, Transparan & Sesuai Syariah</h4>
                    </div>

                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed relative z-10">
                        Seluruh brosur dan panduan produk disusun sesuai standar keterbukaan informasi perbankan, regulasi OJK, serta prinsip syariah DSN-MUI.
                    </p>

                    <div class="pt-1 relative z-10 flex items-center justify-center gap-2">
                        <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Diawasi OJK
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
     SECTION 2: SPOTLIGHT FEATURED BROCHURE (BROSUR UTAMA RESMI)
     ======================================================================== -->
<section class="py-12 md:py-16 bg-transparent relative overflow-hidden">
    <div class="container-wide relative z-10">
        <div class="spotlight-card group relative rounded-3xl bg-gradient-to-br from-slate-900 via-slate-800 to-teal-950 p-6 sm:p-10 lg:p-12 text-white shadow-2xl overflow-hidden border border-teal-500/30 transition-all duration-500 hover:border-teal-400/50 hover:shadow-teal-900/20" data-aos="fade-up">
            <!-- Ambient Glow & Texture -->
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl pointer-events-none group-hover:bg-teal-400/30 transition-all duration-700"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-cyan-500/15 rounded-full blur-3xl pointer-events-none group-hover:bg-cyan-400/25 transition-all duration-700"></div>

            <!-- Background Watermark Emblem (scales subtly without rotation on hover, maintaining straight professional orientation) -->
            <div class="absolute right-0 bottom-0 translate-x-1/4 translate-y-1/4 w-96 h-96 opacity-5 group-hover:opacity-15 group-hover:scale-105 pointer-events-none select-none transition-all duration-700 ease-out">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-200">
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center relative z-10">
                <!-- Left Column: 3D Cover Mockup with Lively Shimmer & Emblem -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative group/mockup cursor-pointer max-w-[280px] sm:max-w-[320px] w-full perspective-1000">
                        <!-- Glow behind mockup -->
                        <div class="absolute inset-0 bg-teal-500/30 rounded-2xl blur-xl group-hover:blur-2xl group-hover:bg-teal-400/40 transition-all duration-500"></div>

                        <!-- 3D Book / Folder Card -->
                        <div class="relative rounded-2xl overflow-hidden border-2 border-white/20 bg-slate-800 shadow-2xl transform transition-transform duration-500 group-hover:scale-[1.04] group-hover:-rotate-1 aspect-[3/4] flex flex-col justify-between p-6">
                            <!-- Shimmer Light Sweep on Hover -->
                            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/15 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out pointer-events-none z-20"></div>

                            <?php if ( ! empty( $p_cover ) ) : ?>
                                <img src="<?php echo esc_url( $p_cover ); ?>" alt="<?php echo esc_attr( $p_name ); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/95 via-slate-950/40 to-transparent"></div>
                            <?php else : ?>
                                <!-- Vector Artwork Cover Fallback -->
                                <div class="absolute inset-0 bg-gradient-to-br from-teal-800 via-slate-900 to-teal-950"></div>
                                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                                <!-- Emblem watermark on cover (steady orientation) -->
                                <div class="absolute right-4 bottom-4 w-28 h-28 opacity-20 pointer-events-none group-hover:scale-105 transition-transform duration-700">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-200">
                                </div>
                            <?php endif; ?>

                            <!-- Cover Top Bar -->
                            <div class="relative z-10 flex items-center justify-between">
                                <span class="px-2.5 py-1 rounded-md bg-teal-500/90 text-white text-[10px] font-black uppercase tracking-wider shadow">
                                    <?php echo esc_html( $p_version ); ?>
                                </span>
                                <span class="px-2 py-0.5 rounded bg-white/20 backdrop-blur-md text-white/90 text-[10px] font-bold flex items-center gap-1">
                                    <svg class="w-3 h-3 text-teal-300" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                    PDF Resmi
                                </span>
                            </div>

                            <!-- Cover Bottom Content with Steady Emblem -->
                            <div class="relative z-10 text-left">
                                <div class="w-12 h-12 rounded-2xl bg-white/15 backdrop-blur-md border border-teal-300/40 p-2 flex items-center justify-center mb-3 shadow-lg shadow-teal-500/20">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="Logo Wakalumi" class="w-full h-full object-contain filter drop-shadow">
                                </div>
                                <p class="text-[11px] font-extrabold text-teal-300 uppercase tracking-wider mb-1">BPRS Wakalumi</p>
                                <h3 class="text-lg font-black text-white leading-snug drop-shadow-md">
                                    <?php echo esc_html( $p_name ); ?>
                                </h3>
                                <p class="text-xs text-slate-300 mt-1 line-clamp-2">
                                    <?php echo esc_html( $p_size ); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Detail, Official Brand Emblem & Direct Action -->
                <div class="lg:col-span-7 space-y-6">
                    <!-- Brand Badge with Steady Official Logo -->
                    <div class="flex items-center gap-3.5">
                        <div class="relative w-14 h-14 rounded-2xl bg-gradient-to-br from-white/20 to-white/5 backdrop-blur-md border border-teal-400/40 p-2.5 shadow-xl shadow-teal-500/20 flex-shrink-0">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="BPRS Wakalumi Emblem" class="w-full h-full object-contain relative z-10 filter drop-shadow">
                        </div>
                        <div>
                            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-500/20 border border-teal-400/30 text-teal-300 text-xs font-black uppercase tracking-wider shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-teal-400 animate-ping"></span>
                                <?php echo esc_html( $p_badge ); ?>
                            </div>
                            <p class="text-xs text-slate-300 font-medium mt-1 flex items-center gap-2">
                                <span class="inline-block w-1.5 h-1.5 rounded-full bg-teal-400"></span>
                                Edisi Resmi Terverifikasi BPRS Wakalumi
                            </p>
                        </div>
                    </div>

                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight leading-tight group-hover:text-teal-100 transition-colors">
                        <?php echo esc_html( $p_name ); ?>
                    </h2>

                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                        <?php echo esc_html( $p_desc ); ?>
                    </p>

                    <!-- Feature Checklist -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-start gap-2 text-xs sm:text-sm text-slate-200">
                            <svg class="w-5 h-5 text-teal-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span>Seluruh produk Tabungan & Deposito</span>
                        </div>
                        <div class="flex items-start gap-2 text-xs sm:text-sm text-slate-200">
                            <svg class="w-5 h-5 text-teal-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span>Skema Pembiayaan & Angsuran Ringan</span>
                        </div>
                        <div class="flex items-start gap-2 text-xs sm:text-sm text-slate-200">
                            <svg class="w-5 h-5 text-teal-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span>Tabel Nisbah & Estimasi Bagi Hasil</span>
                        </div>
                        <div class="flex items-start gap-2 text-xs sm:text-sm text-slate-200">
                            <svg class="w-5 h-5 text-teal-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span>Persyaratan & Prosedur Pembukaan</span>
                        </div>
                    </div>

                    <!-- Meta specs bar -->
                    <div class="flex items-center gap-4 pt-2 text-xs text-slate-400 border-t border-slate-700/60">
                        <span class="inline-flex items-center gap-1.5 font-medium text-slate-300">
                            <svg class="w-4 h-4 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            Format: PDF High Resolution
                        </span>
                        <span>•</span>
                        <span class="text-slate-300"><?php echo esc_html( $p_size ); ?></span>
                        <span>•</span>
                        <span class="text-teal-300 font-bold"><?php echo esc_html( $p_version ); ?></span>
                    </div>

                    <!-- Action Buttons: Pratinjau & Unduh Langsung -->
                    <div class="flex flex-wrap items-center gap-3.5 pt-2">
                        <!-- Preview Button (Opens Lightbox Modal) -->
                        <button 
                            type="button" 
                            class="brosur-preview-btn relative overflow-hidden group/pbtn inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-gradient-to-r from-teal-500 to-cyan-400 hover:from-teal-400 hover:to-cyan-300 text-slate-950 font-black text-sm shadow-lg shadow-teal-500/25 transition-all duration-300 hover:scale-[1.02] cursor-pointer"
                            data-pdf="<?php echo esc_url( $p_file ); ?>"
                            data-title="<?php echo esc_attr( $p_name ); ?>"
                            data-size="<?php echo esc_attr( $p_size ); ?>"
                        >
                            <!-- Shimmer Sweep -->
                            <span class="absolute inset-0 w-1/2 h-full bg-white/30 transform -skew-x-12 -translate-x-full group-hover/pbtn:translate-x-[300%] transition-transform duration-1000 ease-out pointer-events-none"></span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span>Pratinjau Brosur</span>
                        </button>

                        <!-- Direct Download Button -->
                        <?php if ( ! empty( $p_file ) ) : ?>
                            <a 
                                href="<?php echo esc_url( $p_file ); ?>" 
                                download 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-bold text-sm border border-white/20 backdrop-blur-md transition-all duration-300 hover:scale-[1.02]"
                            >
                                <svg class="w-4 h-4 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                <span>Unduh PDF</span>
                            </a>
                        <?php else : ?>
                            <button 
                                type="button" 
                                class="brosur-preview-btn inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-bold text-sm border border-white/20 backdrop-blur-md transition-all duration-300 hover:scale-[1.02] cursor-pointer"
                                data-pdf=""
                                data-title="<?php echo esc_attr( $p_name ); ?>"
                                data-size="<?php echo esc_attr( $p_size ); ?>"
                            >
                                <svg class="w-4 h-4 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                <span>Unduh PDF</span>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================================
     SECTION 3: INTERACTIVE FILTER & LIVE SEARCH TOOLBAR (BACKDROP BLUR)
     ======================================================================== -->
<section class="py-5 sticky top-16 md:top-20 z-30 bg-white/85 dark:bg-dark-surface/85 backdrop-blur-xl border-y border-slate-200/80 dark:border-dark-border/80 shadow-sm transition-colors duration-300">
    <div class="container-wide">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <!-- Left: Search Box -->
            <div class="relative w-full lg:w-96">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input 
                    type="text" 
                    id="brosur-search-input" 
                    placeholder="Cari brosur produk, akad, atau program simpanan & pembiayaan..." 
                    class="w-full pl-10 pr-10 py-2.5 rounded-2xl bg-slate-50 dark:bg-dark-surface-alt border border-slate-200 dark:border-dark-border text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm transition-all"
                >
                <!-- Clear Button -->
                <button 
                    type="button" 
                    id="brosur-search-clear" 
                    class="hidden absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors"
                    aria-label="Bersihkan pencarian"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Right: Category Filter Pills -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1 lg:pb-0 scrollbar-none" id="brosur-filter-group">
                <button 
                    type="button" 
                    data-filter="all" 
                    class="brosur-filter-btn active-filter px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-all duration-300 border bg-teal-600 text-white border-teal-600 shadow-sm shadow-teal-600/20"
                >
                    Semua Dokumen
                    <span class="ml-1.5 px-1.5 py-0.5 rounded-full bg-white/20 text-[10px]"><?php echo count( $brosur_list ); ?></span>
                </button>
                <button 
                    type="button" 
                    data-filter="penghimpunan-dana" 
                    class="brosur-filter-btn px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-all duration-300 border bg-white/90 dark:bg-dark-card/90 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-dark-border hover:border-teal-500 hover:text-teal-600 dark:hover:text-teal-400 shadow-sm"
                >
                    Penghimpunan Dana
                    <?php if ( $category_counts['penghimpunan-dana'] > 0 ) : ?>
                        <span class="ml-1.5 px-1.5 py-0.5 rounded-full bg-slate-100 dark:bg-dark-surface-alt text-[10px]"><?php echo $category_counts['penghimpunan-dana']; ?></span>
                    <?php endif; ?>
                </button>
                <button 
                    type="button" 
                    data-filter="penyaluran-dana" 
                    class="brosur-filter-btn px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-all duration-300 border bg-white/90 dark:bg-dark-card/90 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-dark-border hover:border-teal-500 hover:text-teal-600 dark:hover:text-teal-400 shadow-sm"
                >
                    Penyaluran Dana
                    <?php if ( $category_counts['penyaluran-dana'] > 0 ) : ?>
                        <span class="ml-1.5 px-1.5 py-0.5 rounded-full bg-slate-100 dark:bg-dark-surface-alt text-[10px]"><?php echo $category_counts['penyaluran-dana']; ?></span>
                    <?php endif; ?>
                </button>
                <button 
                    type="button" 
                    data-filter="program-khusus" 
                    class="brosur-filter-btn px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition-all duration-300 border bg-white/90 dark:bg-dark-card/90 text-slate-600 dark:text-slate-300 border-slate-200 dark:border-dark-border hover:border-teal-500 hover:text-teal-600 dark:hover:text-teal-400 shadow-sm"
                >
                    Program Khusus & Akad
                    <?php if ( $category_counts['program-khusus'] > 0 ) : ?>
                        <span class="ml-1.5 px-1.5 py-0.5 rounded-full bg-slate-100 dark:bg-dark-surface-alt text-[10px]"><?php echo $category_counts['program-khusus']; ?></span>
                    <?php endif; ?>
                </button>
            </div>
        </div>

        <!-- Real-time Count status -->
        <div class="pt-3 flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
            <div>
                Menampilkan <span id="brosur-count" class="font-extrabold text-teal-600 dark:text-teal-400"><?php echo count( $brosur_list ); ?></span> dokumen brosur resmi
            </div>
            <div class="hidden sm:block text-[11px] text-slate-400 dark:text-slate-500">
                Klik tombol Pratinjau untuk membaca langsung atau Unduh untuk mengunduh PDF
            </div>
        </div>
    </div>
</section>

<!-- ========================================================================
     SECTION 4: BROCHURE GRID CARDS COLLECTION (TRANSPARENT BODY)
     ======================================================================== -->
<section class="py-12 md:py-16 bg-transparent min-h-[500px] relative">
    <div class="container-wide relative z-10">
        <!-- Grid Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8" id="brosur-grid-container">
            <?php foreach ( $brosur_list as $index => $item ) : 
                $title    = $item['title'] ?? 'Dokumen Brosur Produk';
                $kategori = $item['kategori'] ?? 'Produk Syariah';
                $kat_slug = wakalumi_get_kategori_slug( $kategori );
                $badge    = ! empty( $item['badge'] ) ? $item['badge'] : $kategori;
                $file_url = $item['file_url'] ?? '';
                $file_size= ! empty( $item['file_size'] ) ? $item['file_size'] : 'PDF • 1.5 MB';
                $cover    = $item['cover'] ?? '';
                $desc     = ! empty( $item['desc'] ) ? $item['desc'] : 'Informasi dan panduan resmi produk perbankan syariah BPRS Wakalumi.';
                $version  = ! empty( $item['version'] ) ? $item['version'] : '2026';
                $color    = $item['color'] ?? '';
                if ( empty( $color ) ) {
                    $fallbacks = ['teal', 'amber', 'emerald', 'blue', 'purple', 'rose'];
                    $color = $fallbacks[$index % count( $fallbacks )];
                }
                $c_theme  = wakalumi_get_brosur_card_theme( $color );
                $badge_style = ! empty( $c_theme['badge_style'] ) ? $c_theme['badge_style'] : wakalumi_get_kategori_badge_style( $kat_slug );
                $search_meta = strtolower( $title . ' ' . $kategori . ' ' . $badge . ' ' . $desc );
            ?>
                <!-- Individual Brochure Card with Lively Theme Hover & Custom Admin Color -->
                <div 
                    class="brosur-card group flex flex-col justify-between rounded-3xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200/90 dark:border-dark-border <?php echo esc_attr( $c_theme['hover_border'] ); ?> shadow-md hover:shadow-2xl <?php echo esc_attr( $c_theme['hover_shadow'] ); ?> hover:-translate-y-2 hover:scale-[1.015] transition-all duration-300 overflow-hidden relative"
                    data-category="<?php echo esc_attr( $kat_slug ); ?>"
                    data-title="<?php echo esc_attr( strtolower( $title ) ); ?>"
                    data-keywords="<?php echo esc_attr( $search_meta ); ?>"
                >
                    <!-- Dynamic Ambient Aura Glow on Hover -->
                    <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r <?php echo esc_attr( $c_theme['aura_gradient'] ); ?> opacity-0 group-hover:opacity-100 transition-all duration-500 blur-xl pointer-events-none -z-10"></div>

                    <!-- Top Accent Border (Permanently Solid Themed Gradient on Every Card) -->
                    <div class="h-2 w-full bg-gradient-to-r <?php echo esc_attr( $c_theme['top_border'] ); ?> transition-all duration-300 group-hover:h-2.5 relative z-20 flex-shrink-0 shadow-xs"></div>

                    <div>
                        <!-- Cover Slot (16:10 Aspect) -->
                        <div class="relative w-full aspect-[16/10] bg-slate-100 dark:bg-dark-surface overflow-hidden border-b border-slate-100 dark:border-dark-border/80">
                            <?php if ( ! empty( $cover ) ) : ?>
                                <img 
                                    src="<?php echo esc_url( $cover ); ?>" 
                                    alt="<?php echo esc_attr( $title ); ?>" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <?php else : ?>
                                <!-- Stylized Vector Document Placeholder with Dynamic Theme -->
                                <div class="w-full h-full bg-gradient-to-br <?php echo esc_attr( $c_theme['placeholder_bg'] ); ?> flex items-center justify-center p-6 relative overflow-hidden">
                                    <!-- Subtle Straight Watermark (No Rotation, Gentle Scale) -->
                                    <div class="absolute -right-6 -bottom-6 w-32 h-32 opacity-10 dark:opacity-15 pointer-events-none transition-transform duration-500 group-hover:scale-105 select-none">
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-200">
                                    </div>

                                    <!-- Graphic Icon Sheet with Theme Accent -->
                                    <div class="w-14 h-16 rounded-xl bg-white dark:bg-dark-surface-alt border border-slate-200 dark:border-dark-border shadow-sm flex flex-col items-center justify-center p-2 group-hover:scale-110 group-hover:-translate-y-1 transition-all duration-300">
                                        <svg class="w-7 h-7 <?php echo esc_attr( $c_theme['placeholder_icon'] ); ?> mb-1 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                        </svg>
                                        <span class="text-[9px] font-black text-slate-600 dark:text-slate-300 uppercase">PDF</span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Format Badge Overlay -->
                            <div class="absolute top-3 left-3 z-10">
                                <span class="px-2.5 py-1 rounded-lg bg-slate-900/80 backdrop-blur-md text-white text-[10px] font-extrabold uppercase tracking-wider flex items-center gap-1 shadow">
                                    <svg class="w-3 h-3 text-teal-400" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                    PDF
                                </span>
                            </div>

                            <!-- Year/Version Badge Overlay -->
                            <div class="absolute top-3 right-3 z-10">
                                <span class="px-2.5 py-1 rounded-lg bg-white/90 dark:bg-dark-card/90 backdrop-blur-md text-slate-700 dark:text-slate-300 text-[10px] font-bold border border-slate-200/80 dark:border-dark-border shadow">
                                    <?php echo esc_html( $version ); ?>
                                </span>
                            </div>
                        </div>

                        <!-- Card Body Content -->
                        <div class="p-6 space-y-3">
                            <!-- Category & Badge -->
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider border <?php echo esc_attr( $badge_style ); ?> shadow-xs">
                                    <?php echo esc_html( $badge ); ?>
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white <?php echo esc_attr( $c_theme['title_hover'] ); ?> transition-colors leading-snug">
                                <?php echo esc_html( $title ); ?>
                            </h3>

                            <!-- Description -->
                            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-3">
                                <?php echo esc_html( $desc ); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Card Footer: Meta & Action Buttons (Preview & Unduh Langsung) -->
                    <div class="p-6 pt-0 border-t border-slate-100 dark:border-dark-border/80 mt-2">
                        <div class="flex items-center justify-between py-3 text-xs text-slate-400 dark:text-slate-500">
                            <span class="flex items-center gap-1.5 font-medium text-slate-600 dark:text-slate-400">
                                <svg class="w-3.5 h-3.5 <?php echo esc_attr( $c_theme['meta_icon'] ); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                <?php echo esc_html( $file_size ); ?>
                            </span>
                            <span class="text-slate-300 dark:text-slate-600">•</span>
                            <span class="text-emerald-600 dark:text-emerald-400 font-semibold text-[11px]">Resmi Terbit</span>
                        </div>

                        <!-- Dual Action Button Pair: Pratinjau & Unduh -->
                        <div class="grid grid-cols-2 gap-2.5 pt-1">
                            <!-- Preview Button (Opens Lightbox Modal) -->
                            <button 
                                type="button" 
                                class="brosur-preview-btn inline-flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl bg-slate-100 dark:bg-dark-surface-alt <?php echo esc_attr( $c_theme['btn_preview'] ); ?> text-slate-800 dark:text-slate-200 text-xs font-bold transition-all duration-200 border border-slate-200 dark:border-dark-border cursor-pointer group/btn"
                                data-pdf="<?php echo esc_url( $file_url ); ?>"
                                data-title="<?php echo esc_attr( $title ); ?>"
                                data-size="<?php echo esc_attr( $file_size ); ?>"
                            >
                                <svg class="w-4 h-4 <?php echo esc_attr( $c_theme['meta_icon'] ); ?> group-hover/btn:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <span>Pratinjau</span>
                            </button>

                            <!-- Download Button -->
                            <?php if ( ! empty( $file_url ) ) : ?>
                                <a 
                                    href="<?php echo esc_url( $file_url ); ?>" 
                                    download 
                                    target="_blank" 
                                    rel="noopener noreferrer" 
                                    class="inline-flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl <?php echo esc_attr( $c_theme['btn_download'] ); ?> text-xs font-bold transition-all duration-200 group/down"
                                >
                                    <svg class="w-4 h-4 group-hover/down:translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                    <span>Unduh PDF</span>
                                </a>
                            <?php else : ?>
                                <button 
                                    type="button" 
                                    class="brosur-preview-btn inline-flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl <?php echo esc_attr( $c_theme['btn_download'] ); ?> text-xs font-bold transition-all duration-200 cursor-pointer group/down"
                                    data-pdf=""
                                    data-title="<?php echo esc_attr( $title ); ?>"
                                    data-size="<?php echo esc_attr( $file_size ); ?>"
                                >
                                    <svg class="w-4 h-4 group-hover/down:translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                    <span>Unduh PDF</span>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Empty Search State (Hidden by Default) -->
        <div id="brosur-empty-state" class="hidden py-16 text-center max-w-md mx-auto">
            <div class="w-16 h-16 rounded-3xl bg-slate-100 dark:bg-dark-surface-alt text-slate-400 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Dokumen Tidak Ditemukan</h3>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mb-6">
                Tidak ada brosur yang sesuai dengan kata kunci atau filter kategori yang Anda pilih. Silakan gunakan kata kunci lain.
            </p>
            <button 
                type="button" 
                id="brosur-reset-btn" 
                class="px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs shadow transition-colors"
            >
                Reset Pencarian & Filter
            </button>
        </div>
    </div>
</section>

<!-- ========================================================================
     SECTION 5: REGULATORY COMPLIANCE & TATA KELOLA (100% CRUD DINAMIS DARI ADMIN)
     ======================================================================== -->
<?php if ( ! empty( $brosur_gov['show'] ) ) : ?>
<section class="py-14 md:py-20 bg-slate-50/75 dark:bg-dark-surface/50 backdrop-blur-md border-t border-slate-200/60 dark:border-dark-border/60 relative">
    <div class="container-wide relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-wider text-teal-600 dark:text-teal-400">
                <?php echo esc_html( $brosur_gov['kicker'] ); ?>
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white mt-1">
                <?php echo esc_html( $brosur_gov['title'] ); ?>
            </h2>
            <?php if ( ! empty( $brosur_gov['desc'] ) ) : ?>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2.5 max-w-xl mx-auto leading-relaxed">
                    <?php echo esc_html( $brosur_gov['desc'] ); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
            <?php foreach ( $brosur_gov['cards'] as $g_index => $gov ) : 
                $g_title = $gov['title'] ?? 'Lembaga Regulasi';
                $g_badge = $gov['badge'] ?? 'Kepatuhan';
                $g_desc  = $gov['desc'] ?? '';
                $g_ref   = $gov['legal_ref'] ?? '';
                $g_col   = $gov['color'] ?? '';
                $g_theme = wakalumi_get_gov_dual_tone_theme( $g_col, $g_index );
            ?>
                <!-- Governance Card: Dual-Tone Architecture with Lively Hover Aura -->
                <div 
                    class="spotlight-card group relative rounded-3xl <?php echo esc_attr( $g_theme['lower_zone'] ); ?> backdrop-blur-xl border border-slate-200/90 dark:border-dark-border <?php echo esc_attr( $g_theme['hover_border'] ); ?> shadow-md hover:shadow-2xl <?php echo esc_attr( $g_theme['hover_shadow'] ); ?> hover:-translate-y-2.5 hover:scale-[1.015] transition-all duration-300 flex flex-col justify-between overflow-hidden" 
                    data-aos="fade-up" 
                    data-aos-delay="<?php echo esc_attr( ( $g_index + 1 ) * 100 ); ?>"
                >
                    <!-- Dynamic Ambient Aura on Hover (Behind Card) -->
                    <div class="absolute -inset-1 rounded-3xl bg-gradient-to-br <?php echo esc_attr( $g_theme['aura_gradient'] ); ?> opacity-0 group-hover:opacity-100 transition-all duration-500 blur-xl pointer-events-none -z-10"></div>

                    <!-- Top Dual-Tone Accent Border Strip -->
                    <div class="h-2 w-full bg-gradient-to-r <?php echo esc_attr( $g_theme['top_border'] ); ?> transition-all duration-300 group-hover:h-2.5"></div>

                    <!-- UPPER ZONE (Tone 1: Authoritative Solid Tinted Header Band with Watermark) -->
                    <div class="p-6 sm:p-7 relative overflow-hidden <?php echo esc_attr( $g_theme['upper_zone'] ); ?>">
                        <!-- Subtle Non-Rotating Straight Watermark Emblem -->
                        <div class="absolute -right-4 -bottom-4 w-28 h-28 opacity-[0.04] dark:opacity-[0.08] pointer-events-none transition-transform duration-500 group-hover:scale-105 select-none">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/wm-wkl.png' ); ?>" alt="" class="w-full h-full object-contain">
                        </div>

                        <!-- Crest Icon & Regulatory Badge Pill -->
                        <div class="flex items-center justify-between gap-3 relative z-10">
                            <!-- 3D Authority Shield Crest -->
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br <?php echo esc_attr( $g_theme['icon_box'] ); ?> text-white flex items-center justify-center shadow-lg <?php echo esc_attr( $g_theme['icon_shadow'] ); ?> group-hover:scale-110 group-hover:rotate-1 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                            </div>

                            <!-- Authority Badge Pill -->
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider <?php echo esc_attr( $g_theme['badge_style'] ); ?> shadow-xs">
                                <?php echo esc_html( $g_badge ); ?>
                            </span>
                        </div>

                        <!-- Upper Tone Sub-Label & Title -->
                        <div class="mt-4 pt-1 relative z-10">
                            <span class="text-[10px] font-extrabold uppercase tracking-wider <?php echo esc_attr( $g_theme['authority_kicker'] ); ?> flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                Lembaga Resmi Terverifikasi
                            </span>
                            <h3 class="font-black text-slate-900 dark:text-white text-lg sm:text-xl <?php echo esc_attr( $g_theme['title_hover'] ); ?> transition-colors mt-1 leading-snug">
                                <?php echo esc_html( $g_title ); ?>
                            </h3>
                        </div>
                    </div>

                    <!-- LOWER ZONE (Tone 2: Crisp Body with Clean Contrast & Legal Citation Banner) -->
                    <div class="p-6 sm:p-7 flex-1 flex flex-col justify-between <?php echo esc_attr( $g_theme['lower_zone'] ); ?>">
                        <!-- Body Description -->
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            <?php echo esc_html( $g_desc ); ?>
                        </p>

                        <!-- Legal Reference Banner (Dual-Tone Footer Strip) -->
                        <?php if ( ! empty( $g_ref ) ) : ?>
                            <div class="mt-5 p-3 rounded-xl <?php echo esc_attr( $g_theme['legal_strip'] ); ?> flex items-center justify-between gap-2 shadow-xs">
                                <div class="flex items-center gap-2 min-w-0">
                                    <span class="w-6 h-6 rounded-lg <?php echo esc_attr( $g_theme['check_box'] ); ?> flex items-center justify-center flex-shrink-0 shadow-xs">
                                        <svg class="w-3.5 h-3.5 <?php echo esc_attr( $g_theme['check_icon'] ); ?>" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                    <span class="text-[11px] font-bold text-slate-700 dark:text-slate-300 truncate" title="<?php echo esc_attr( $g_ref ); ?>">
                                        <?php echo esc_html( $g_ref ); ?>
                                    </span>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-wider bg-white dark:bg-dark-surface-alt text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-dark-border flex-shrink-0">
                                    Resmi
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ========================================================================
     SECTION 6: GLOBAL CTA WHATSAPP BANNER (UNIFIED WITH PRODUCT PAGES)
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
                    <svg class="w-3.5 h-3.5 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
                    Layanan Konsultasi Resmi
                </span>
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight text-white">
                    Butuh Informasi Lebih Detail atau Pengiriman Fisik?
                </h3>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed mb-8">
                    Petugas Customer Care kami siap membantu mengirimkan brosur cetak, formulir pembukaan rekening, atau memberikan simulasi pembiayaan secara langsung.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a 
                        href="<?php echo esc_url( $default_wa_link ); ?>" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="relative overflow-hidden group/btn py-3.5 px-6 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-400 hover:from-teal-400 hover:to-cyan-300 text-slate-950 font-black text-sm inline-flex items-center gap-2 shadow-lg transition-transform hover:scale-105"
                    >
                        <!-- Shimmer Sweep -->
                        <span class="absolute inset-0 w-1/2 h-full bg-white/30 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-[300%] transition-transform duration-1000 ease-out pointer-events-none"></span>

                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>Hubungi via WhatsApp</span>
                    </a>
                    <a 
                        href="<?php echo esc_url( home_url( '/kantor/' ) ); ?>" 
                        class="py-3.5 px-6 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-sm border border-slate-700 inline-flex items-center gap-2 transition-colors"
                    >
                        <svg class="w-4 h-4 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>Temukan Kantor Terdekat</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================================
     SECTION 7: INTERACTIVE PDF LIGHTBOX MODAL
     ======================================================================== -->
<div 
    id="brosur-preview-modal" 
    class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-4 md:p-6" 
    role="dialog" 
    aria-modal="true" 
    aria-labelledby="brosur-modal-title"
>
    <!-- Modal Backdrop Blur -->
    <div 
        id="brosur-modal-backdrop" 
        class="absolute inset-0 bg-slate-950/80 backdrop-blur-md opacity-0 transition-opacity duration-300"
    ></div>

    <!-- Modal Container -->
    <div 
        id="brosur-modal-container" 
        class="relative w-full max-w-5xl h-[92vh] md:h-[88vh] bg-white dark:bg-dark-card rounded-3xl shadow-2xl border border-slate-200 dark:border-dark-border flex flex-col overflow-hidden scale-95 opacity-0 transition-all duration-300 z-10"
    >
        <!-- Modal Top Header Bar -->
        <div class="px-5 py-3.5 sm:px-6 sm:py-4 bg-slate-50 dark:bg-dark-surface-alt border-b border-slate-200 dark:border-dark-border flex items-center justify-between gap-4 flex-shrink-0">
            <!-- Left: Document Title & Meta -->
            <div class="flex items-center gap-3 overflow-hidden">
                <div class="w-9 h-9 rounded-xl bg-teal-500/10 dark:bg-teal-400/10 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <div class="overflow-hidden">
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded bg-teal-100 dark:bg-teal-950 text-teal-800 dark:text-teal-300">
                            Pratinjau PDF
                        </span>
                        <span id="brosur-modal-size" class="text-[11px] text-slate-400 font-medium"></span>
                    </div>
                    <h3 id="brosur-modal-title" class="text-sm sm:text-base font-bold text-slate-900 dark:text-white truncate">
                        Brosur Dokumen
                    </h3>
                </div>
            </div>

            <!-- Center: Reader Toolbar (Page Jump & Zoom) -->
            <div id="brosur-pdf-toolbar" class="hidden sm:flex items-center gap-2 px-3 py-1 rounded-xl bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border shadow-xs">
                <!-- Page Navigator -->
                <div class="flex items-center gap-1.5 text-xs text-slate-600 dark:text-slate-300">
                    <span class="font-medium">Hal:</span>
                    <select id="brosur-pdf-page-select" class="px-2 py-0.5 rounded-lg bg-slate-100 dark:bg-dark-surface border border-slate-300 dark:border-dark-border text-xs font-bold text-slate-800 dark:text-slate-100 cursor-pointer focus:outline-none focus:ring-1 focus:ring-teal-500">
                        <option value="1">1</option>
                    </select>
                    <span>/ <strong id="brosur-pdf-total-pages" class="text-teal-600 dark:text-teal-400">1</strong></span>
                </div>

                <span class="w-px h-4 bg-slate-200 dark:bg-dark-border mx-1"></span>

                <!-- Zoom Controls -->
                <button type="button" id="brosur-pdf-zoom-out" class="p-1 rounded-lg text-slate-600 hover:text-teal-600 dark:text-slate-300 dark:hover:text-teal-400 hover:bg-slate-100 dark:hover:bg-dark-surface-alt transition-colors cursor-pointer" title="Perkecil (-)">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15"/></svg>
                </button>
                <span id="brosur-pdf-zoom-level" class="text-[11px] font-bold text-slate-700 dark:text-slate-200 min-w-[38px] text-center select-none">100%</span>
                <button type="button" id="brosur-pdf-zoom-in" class="p-1 rounded-lg text-slate-600 hover:text-teal-600 dark:text-slate-300 dark:hover:text-teal-400 hover:bg-slate-100 dark:hover:bg-dark-surface-alt transition-colors cursor-pointer" title="Perbesar (+)">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                </button>
                <button type="button" id="brosur-pdf-fit" class="px-2 py-0.5 rounded-lg text-[11px] font-bold text-slate-600 hover:text-teal-600 dark:text-slate-300 dark:hover:text-teal-400 hover:bg-slate-100 dark:hover:bg-dark-surface-alt transition-colors cursor-pointer" title="Sesuaikan Lebar Layar">
                    Fit
                </button>
            </div>

            <!-- Right: Actions (Download, Close) -->
            <div class="flex items-center gap-2 flex-shrink-0">
                <!-- Download Directly -->
                <a 
                    id="brosur-modal-download" 
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
                    id="brosur-modal-close" 
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
            <div id="brosur-modal-loading" class="absolute inset-0 flex flex-col items-center justify-center bg-white/95 dark:bg-dark-card/95 z-20 transition-opacity duration-300">
                <div class="w-10 h-10 border-3 border-teal-500 border-t-transparent rounded-full animate-spin mb-3"></div>
                <p class="text-xs text-slate-600 dark:text-slate-300 font-medium">Memuat pratinjau dokumen brosur...</p>
                <span id="brosur-pdf-loading-detail" class="text-[11px] text-slate-400 mt-1">Mengambil berkas dari peladen</span>
            </div>

            <!-- In-Theme Empty State Notice (When PDF is not yet uploaded - Replaces JS Alert) -->
            <div id="brosur-modal-empty" class="hidden absolute inset-0 z-30 flex flex-col items-center justify-center p-6 text-center bg-white/95 dark:bg-dark-card/95 backdrop-blur-md">
                <div class="relative w-20 h-20 rounded-3xl bg-teal-50 dark:bg-teal-950/60 border border-teal-200 dark:border-teal-800/80 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-5 shadow-lg shadow-teal-500/10">
                    <div class="absolute inset-0 rounded-3xl bg-teal-400/20 blur-md animate-pulse"></div>
                    <svg class="w-10 h-10 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-amber-50 dark:bg-amber-950/60 border border-amber-200 dark:border-amber-800 text-amber-700 dark:text-amber-300 text-xs font-bold uppercase tracking-wider mb-3">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                    Dokumen Sedang Dalam Pembaruan
                </div>
                <h4 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white max-w-lg mb-2 leading-snug">
                    Berkas PDF Sedang Dipersiapkan
                </h4>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 max-w-md mb-6 leading-relaxed">
                    Dokumen resmi <span id="brosur-empty-doc-title" class="font-bold text-slate-800 dark:text-slate-200"></span> saat ini sedang dalam proses finalisasi versi terbaru oleh tim manajemen BPRS Wakalumi.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a 
                        id="brosur-modal-wa-fallback" 
                        href="<?php echo esc_url( $default_wa_link ); ?>" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-400 hover:from-teal-400 hover:to-cyan-300 text-slate-950 font-extrabold text-xs shadow-md transition-all duration-200 hover:scale-105"
                    >
                        <svg class="w-4 h-4 text-slate-950" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span>Minta Dokumen via WhatsApp</span>
                    </a>
                    <button 
                        type="button" 
                        onclick="document.getElementById('brosur-modal-close').click()" 
                        class="px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-dark-surface hover:bg-slate-200 dark:hover:bg-dark-surface-alt text-slate-700 dark:text-slate-300 font-bold text-xs border border-slate-200 dark:border-dark-border transition-colors cursor-pointer"
                    >
                        Tutup Pratinjau
                    </button>
                </div>
            </div>

            <!-- Native HTML5 Canvas Multi-Page Viewer Container (Rendered via PDF.js Canvas, 100% immune to IDM auto-download & Edge OOPIF block) -->
            <div 
                id="brosur-pdf-canvas-container" 
                class="flex-1 w-full h-full overflow-y-auto overflow-x-auto p-4 sm:p-8 flex flex-col items-center gap-6 scroll-smooth bg-slate-900"
            >
                <!-- Pages will be rendered progressively here -->
            </div>
        </div>
        </div>
    </div>
</div>

<!-- Inline Fallback Runner -->
<script>
(function() {
    function runBrosur() {
        if (typeof BrosurModule !== 'undefined' && BrosurModule.init) {
            BrosurModule.init();
        }
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', runBrosur);
    } else {
        runBrosur();
    }
})();
</script>

<?php
get_footer();
