<?php
/**
 * Admin: Tim Kami & Direktori Karyawan Aktif
 * 
 * Pengelolaan terpadu direktori seluruh karyawan dan divisi Bank Syariah Wakalumi (BSW),
 * dilengkapi uploader file PNG ID Card (rasio 1 : 1.56), penanda Kepala Divisi,
 * manajemen divisi dinamis, dan verifikasi keabsahan karyawan aktif.
 * 
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ── 1. DATA HELPERS ─────────────────────────────────────────────────

if ( ! function_exists( 'wakalumi_get_division_color_options' ) ) {
    /**
     * Opsi aksen warna divisi perbankan resmi yang kaya, variatif, dan berkarakter.
     *
     * @return array
     */
    function wakalumi_get_division_color_options() {
        return [
            'emerald' => [
                'name'  => 'Emerald (Hijau Syariah)',
                'class' => 'bg-emerald-50 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800/70',
                'dot'   => '#059669',
            ],
            'indigo' => [
                'name'  => 'Indigo (Ungu Wibawa)',
                'class' => 'bg-indigo-50 dark:bg-indigo-950/70 text-indigo-600 dark:text-indigo-400 border-indigo-200 dark:border-indigo-800/70',
                'dot'   => '#4f46e5',
            ],
            'amber' => [
                'name'  => 'Amber (Emas Eksekutif)',
                'class' => 'bg-amber-50 dark:bg-amber-950/70 text-amber-600 dark:text-amber-400 border-amber-200 dark:border-amber-800/70',
                'dot'   => '#d97706',
            ],
            'purple' => [
                'name'  => 'Purple (Ungu Spesialis)',
                'class' => 'bg-purple-50 dark:bg-purple-950/70 text-purple-600 dark:text-purple-400 border-purple-200 dark:border-purple-800/70',
                'dot'   => '#9333ea',
            ],
            'rose' => [
                'name'  => 'Rose (Merah Muda Elegan)',
                'class' => 'bg-rose-50 dark:bg-rose-950/70 text-rose-600 dark:text-rose-400 border-rose-200 dark:border-rose-800/70',
                'dot'   => '#e11d48',
            ],
            'teal' => [
                'name'  => 'Teal (Toska Wakalumi)',
                'class' => 'bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 border-teal-200 dark:border-teal-800/70',
                'dot'   => '#0d9488',
            ],
            'blue' => [
                'name'  => 'Blue (Biru Korporat)',
                'class' => 'bg-blue-50 dark:bg-blue-900/60 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-800/70',
                'dot'   => '#2563eb',
            ],
            'orange' => [
                'name'  => 'Orange (Jingga Dinamis)',
                'class' => 'bg-orange-50 dark:bg-orange-950/70 text-orange-600 dark:text-orange-400 border-orange-200 dark:border-orange-800/70',
                'dot'   => '#ea580c',
            ],
            'cyan' => [
                'name'  => 'Cyan (Biru Digital)',
                'class' => 'bg-cyan-50 dark:bg-cyan-950/70 text-cyan-600 dark:text-cyan-400 border-cyan-200 dark:border-cyan-800/70',
                'dot'   => '#0891b2',
            ],
            'fuchsia' => [
                'name'  => 'Fuchsia (Pink Human Capital)',
                'class' => 'bg-fuchsia-50 dark:bg-fuchsia-950/70 text-fuchsia-600 dark:text-fuchsia-400 border-fuchsia-200 dark:border-fuchsia-800/70',
                'dot'   => '#c026d3',
            ],
            'slate' => [
                'name'  => 'Slate (Abu Metalik)',
                'class' => 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border-slate-300 dark:border-slate-700/70',
                'dot'   => '#475569',
            ],
            'lime' => [
                'name'  => 'Lime (Hijau Daun Segar)',
                'class' => 'bg-lime-50 dark:bg-lime-950/70 text-lime-700 dark:text-lime-300 border-lime-200 dark:border-lime-800/70',
                'dot'   => '#65a30d',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_division_badge_class' ) ) {
    /**
     * Mengambil class CSS styling badge ikon divisi berdasarkan slug atau konfigurasi admin.
     *
     * @param string $slug
     * @param array $div_info
     * @return string
     */
    function wakalumi_get_division_badge_class( $slug = '', $div_info = [] ) {
        $colors = wakalumi_get_division_color_options();
        $color_key = $div_info['color'] ?? '';
        if ( ! empty( $color_key ) && isset( $colors[ $color_key ] ) ) {
            return $colors[ $color_key ]['class'];
        }

        // Jika badge_class tersimpan dan bukan fallback teal seragam lama
        $saved_badge = $div_info['badge_class'] ?? '';
        if ( ! empty( $saved_badge ) && strpos( $saved_badge, 'bg-teal-100' ) === false ) {
            return $saved_badge;
        }

        // Pemetaan palet warna baku per-divisi (14 warna variatif dan berkarakter)
        $default_map = [
            'dps'          => 'emerald',
            'komisaris'    => 'indigo',
            'manajemen'    => 'amber',
            'senior_staff' => 'purple',
            'sekretaris'   => 'rose',
            'skai'         => 'teal',
            'legal'        => 'blue',
            'bisnis'       => 'orange',
            'it'           => 'cyan',
            'operasional'  => 'teal',
            'personalia'   => 'fuchsia',
            'umum'         => 'slate',
            'keamanan'     => 'amber',
            'pramubakti'   => 'lime',
        ];

        $assigned = $default_map[ $slug ] ?? 'teal';
        return $colors[ $assigned ]['class'] ?? 'bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 border-teal-200 dark:border-teal-800/70';
    }
}

if ( ! function_exists( 'wakalumi_get_default_tim_divisions' ) ) {
    /**
     * Daftar divisi perbankan syariah resmi BSW (Default) - Terurut Hierarki Tertinggi ke Operasional.
     *
     * @return array
     */
    function wakalumi_get_default_tim_divisions() {
        return [
            'dps' => [
                'slug'        => 'dps',
                'name'        => 'Dewan Pengawas Syariah (DPS)',
                'color'       => 'emerald',
                'badge_class' => 'bg-emerald-50 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800/70',
                'icon'        => 'academic-cap',
                'urutan'      => 1,
            ],
            'komisaris' => [
                'slug'        => 'komisaris',
                'name'        => 'Dewan Komisaris',
                'color'       => 'indigo',
                'badge_class' => 'bg-indigo-50 dark:bg-indigo-950/70 text-indigo-600 dark:text-indigo-400 border-indigo-200 dark:border-indigo-800/70',
                'icon'        => 'building',
                'urutan'      => 2,
            ],
            'manajemen' => [
                'slug'        => 'manajemen',
                'name'        => 'Direksi & Manajemen Eksekutif',
                'color'       => 'amber',
                'badge_class' => 'bg-amber-50 dark:bg-amber-950/70 text-amber-600 dark:text-amber-400 border-amber-200 dark:border-amber-800/70',
                'icon'        => 'briefcase',
                'urutan'      => 3,
            ],
            'senior_staff' => [
                'slug'        => 'senior_staff',
                'name'        => 'Senior Staff & Spesialis Teknis',
                'color'       => 'purple',
                'badge_class' => 'bg-purple-50 dark:bg-purple-950/70 text-purple-600 dark:text-purple-400 border-purple-200 dark:border-purple-800/70',
                'icon'        => 'star',
                'urutan'      => 4,
            ],
            'sekretaris' => [
                'slug'        => 'sekretaris',
                'name'        => 'Sekretariat Perusahaan & Direksi',
                'color'       => 'rose',
                'badge_class' => 'bg-rose-50 dark:bg-rose-950/70 text-rose-600 dark:text-rose-400 border-rose-200 dark:border-rose-800/70',
                'icon'        => 'document-text',
                'urutan'      => 5,
            ],
            'skai' => [
                'slug'        => 'skai',
                'name'        => 'SKAI (Satuan Kerja Audit Internal)',
                'color'       => 'teal',
                'badge_class' => 'bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 border-teal-200 dark:border-teal-800/70',
                'icon'        => 'shield-check',
                'urutan'      => 6,
            ],
            'legal' => [
                'slug'        => 'legal',
                'name'        => 'Legal & Kepatuhan Hukum',
                'color'       => 'blue',
                'badge_class' => 'bg-blue-50 dark:bg-blue-900/60 text-blue-600 dark:text-blue-400 border-blue-200 dark:border-blue-800/70',
                'icon'        => 'scale',
                'urutan'      => 7,
            ],
            'bisnis' => [
                'slug'        => 'bisnis',
                'name'        => 'Bisnis & Pemasaran (Marketing / AO)',
                'color'       => 'orange',
                'badge_class' => 'bg-orange-50 dark:bg-orange-950/70 text-orange-600 dark:text-orange-400 border-orange-200 dark:border-orange-800/70',
                'icon'        => 'chart-bar',
                'urutan'      => 8,
            ],
            'it' => [
                'slug'        => 'it',
                'name'        => 'Teknologi Informasi (IT & Digital Banking)',
                'color'       => 'cyan',
                'badge_class' => 'bg-cyan-50 dark:bg-cyan-950/70 text-cyan-600 dark:text-cyan-400 border-cyan-200 dark:border-cyan-800/70',
                'icon'        => 'cpu-chip',
                'urutan'      => 9,
            ],
            'operasional' => [
                'slug'        => 'operasional',
                'name'        => 'Operasional (CS, Teller & Pelaporan)',
                'color'       => 'teal',
                'badge_class' => 'bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 border-teal-200 dark:border-teal-800/70',
                'icon'        => 'user-group',
                'urutan'      => 10,
            ],
            'personalia' => [
                'slug'        => 'personalia',
                'name'        => 'Personalia & Human Capital (HRD)',
                'color'       => 'fuchsia',
                'badge_class' => 'bg-fuchsia-50 dark:bg-fuchsia-950/70 text-fuchsia-600 dark:text-fuchsia-400 border-fuchsia-200 dark:border-fuchsia-800/70',
                'icon'        => 'identification',
                'urutan'      => 11,
            ],
            'umum' => [
                'slug'        => 'umum',
                'name'        => 'Umum & Pengadaan (General Affairs)',
                'color'       => 'slate',
                'badge_class' => 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border-slate-300 dark:border-slate-700/70',
                'icon'        => 'cog',
                'urutan'      => 12,
            ],
            'keamanan' => [
                'slug'        => 'keamanan',
                'name'        => 'Keamanan & Satpam (Security)',
                'color'       => 'amber',
                'badge_class' => 'bg-amber-100 dark:bg-amber-950/70 text-amber-800 dark:text-amber-300 border-amber-300 dark:border-amber-800/70',
                'icon'        => 'shield-exclamation',
                'urutan'      => 13,
            ],
            'pramubakti' => [
                'slug'        => 'pramubakti',
                'name'        => 'Pramubakti & Cleaning Service (OB)',
                'color'       => 'lime',
                'badge_class' => 'bg-lime-50 dark:bg-lime-950/70 text-lime-700 dark:text-lime-300 border-lime-200 dark:border-lime-800/70',
                'icon'        => 'sparkles',
                'urutan'      => 14,
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_tim_divisions' ) ) {
    /**
     * Mengambil daftar divisi dari wp_options (dapat dimodifikasi dinamis di admin).
     *
     * @return array
     */
    function wakalumi_get_tim_divisions() {
        $saved = get_option( 'options_tim_divisions', null );
        if ( is_array( $saved ) && ! empty( $saved ) ) {
            uasort( $saved, fn( $a, $b ) => ( (int)( $a['urutan'] ?? 0 ) ) <=> ( (int)( $b['urutan'] ?? 0 ) ) );
            return $saved;
        }
        $default = wakalumi_get_default_tim_divisions();
        update_option( 'options_tim_divisions', $default );
        return $default;
    }
}

if ( ! function_exists( 'wakalumi_get_division_icon_svg' ) ) {
    /**
     * Mengembalikan markup SVG ikon divisi yang tajam dan serasi.
     *
     * @param string $slug
     * @param string $icon_hint
     * @return string
     */
    function wakalumi_get_division_icon_svg( $slug = '', $icon_hint = '' ) {
        switch ( $slug ) {
            case 'dps':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-5.25 6.557q.154.542.348 1.07"/></svg>';
            case 'komisaris':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.333A12.022 12.022 0 0012 9c-2.485 0-4.793.754-6.75 2.033V21h13.5z"/></svg>';
            case 'manajemen':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>';
            case 'sekretaris':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>';
            case 'skai':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>';
            case 'legal':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z"/></svg>';
            case 'senior_staff':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>';
            case 'personalia':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>';
            case 'umum':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>';
            case 'bisnis':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>';
            case 'it':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v10.5a2.25 2.25 0 002.25 2.25zm.75-12h9a.75.75 0 01.75.75v9a.75.75 0 01-.75.75h-9a.75.75 0 01-.75-.75v-9a.75.75 0 01.75-.75z"/></svg>';
            case 'operasional':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>';
            case 'keamanan':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z"/></svg>';
            case 'pramubakti':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"/></svg>';
            default:
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>';
        }
    }
}

if ( ! function_exists( 'wakalumi_get_tim_header' ) ) {
    /**
     * Mengambil teks pengantar, judul hero, serta disclaimer anti-fraud direktori tim.
     *
     * @return array
     */
    function wakalumi_get_tim_header() {
        $badge = get_option( 'options_tim_badge', 'Direktori Resmi Insan Bank' );
        $title = get_option( 'options_tim_title', 'Tim & Karyawan Bank Syariah Wakalumi' );
        $title = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $title );
        $desc  = get_option( 'options_tim_desc', 'Mengenal seluruh insan perbankan syariah yang amanah, berdedikasi tinggi, dan profesional dalam menghadirkan solusi keuangan berkah bagi nasabah dan masyarakat.' );

        $notice_badge = get_option( 'options_tim_notice_badge', 'Verifikasi Resmi Personel' );
        $notice_badge = str_replace( 'Karyawan Aktif', 'Personel Aktif', $notice_badge );
        $notice_title = get_option( 'options_tim_notice_title', 'Cek Keabsahan & Identitas Resmi Personel BSW' );
        $notice_desc  = get_option( 'options_tim_notice_desc', 'Seluruh jajaran pengurus, personel manajemen, dan karyawan yang tercantum pada direktori resmi ini merupakan insan perbankan aktif PT Bank Syariah Wakalumi (BSW). Apabila ada oknum yang mengatasnamakan bank namun identitasnya TIDAK tercantum pada direktori ini, mohon waspada terhadap potensi penipuan dan segera laporkan ke WhatsApp Hotline resmi kami.' );
        if ( str_contains( $notice_desc, 'merupakan Karyawan Aktif' ) ) {
            $notice_desc = str_replace( 'merupakan Karyawan Aktif PT BPRS Wakalumi (Bank Syariah Wakalumi)', 'merupakan insan perbankan aktif PT Bank Syariah Wakalumi (BSW)', $notice_desc );
            $notice_desc = str_replace( 'merupakan Karyawan Aktif PT Bank Syariah Wakalumi (BSW)', 'merupakan insan perbankan aktif PT Bank Syariah Wakalumi (BSW)', $notice_desc );
            $notice_desc = str_replace( 'merupakan Karyawan Aktif', 'merupakan insan perbankan aktif', $notice_desc );
        }
        $notice_wa    = get_option( 'options_tim_notice_wa', get_option( 'options_contact_wa', '6281517380388' ) );

        return [
            'badge'        => $badge,
            'title'        => $title,
            'desc'         => $desc,
            'notice_badge' => $notice_badge,
            'notice_title' => $notice_title,
            'notice_desc'  => $notice_desc,
            'notice_wa'    => $notice_wa,
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_tim_cta' ) ) {
    /**
     * Mengambil konfigurasi Banner Call to Action (CTA) dinamis untuk Halaman Tim Kami.
     *
     * @return array
     */
    function wakalumi_get_tim_cta() {
        $default_wa = get_option( 'options_contact_wa', '6281517380388' );
        $wa_clean   = preg_replace( '/[^0-9]/', '', (string) $default_wa );
        $wa_url     = 'https://wa.me/' . ( $wa_clean ?: '6281517380388' );

        $title = get_option( 'options_tim_cta_title', 'Ingin Tumbuh & Berkarya Bersama Bank Syariah Wakalumi?' );
        $title = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $title );

        return [
            'show'      => get_option( 'options_tim_cta_show', '1' ) === '1',
            'badge'     => get_option( 'options_tim_cta_badge', 'Peluang Karir Perbankan Syariah' ),
            'title'     => $title,
            'desc'      => get_option( 'options_tim_cta_desc', 'Kami senantiasa membuka pintu bagi para talenta profesional muda yang memiliki integritas tinggi, berjiwa amanah, dan ingin berkontribusi nyata dalam memajukan perekonomian syariah umat.' ),
            'btn1_text' => get_option( 'options_tim_cta_btn1_text', 'Lihat Informasi Karir & Lowongan' ),
            'btn1_url'  => get_option( 'options_tim_cta_btn1_url', home_url( '/informasi/karir/' ) ),
            'btn2_text' => get_option( 'options_tim_cta_btn2_text', 'Hubungi Sekretariat Bank' ),
            'btn2_url'  => get_option( 'options_tim_cta_btn2_url', $wa_url ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_generate_idcard_placeholder' ) ) {
    /**
     * Menghasilkan placeholder SVG ID Card elegan berasio 1 : 1.56 (500x780)
     * jika file PNG ID Card belum diunggah oleh admin.
     *
     * @param string $nama
     * @param string $jabatan
     * @param string $divisi_label
     * @param string $nip
     * @param bool   $is_kadiv
     * @return string Data URI
     */
    function wakalumi_generate_idcard_placeholder( $nama = 'Nama Karyawan', $jabatan = 'Staf Perbankan', $divisi_label = 'Operasional', $nip = '-', $tingkat = 'staff', $short_tag = '' ) {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 780" width="500" height="780">
            <defs>
                <linearGradient id="cardGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#f0fdfa" />
                    <stop offset="50%" stop-color="#f8fafc" />
                    <stop offset="100%" stop-color="#ccfbf1" />
                </linearGradient>
                <radialGradient id="centerGlow" cx="50%" cy="50%" r="45%">
                    <stop offset="0%" stop-color="#14b8a6" stop-opacity="0.12" />
                    <stop offset="100%" stop-color="#14b8a6" stop-opacity="0" />
                </radialGradient>
                <pattern id="subtleGrid" width="28" height="28" patternUnits="userSpaceOnUse">
                    <path d="M14 0 L28 14 L14 28 L0 14 Z" fill="none" stroke="#0d9488" stroke-width="0.6" opacity="0.08"/>
                    <circle cx="14" cy="14" r="1.2" fill="#0d9488" opacity="0.10"/>
                </pattern>
            </defs>

            <!-- Minimalist Gradient & Pattern Background -->
            <rect width="500" height="780" rx="28" fill="url(#cardGrad)" />
            <rect width="500" height="780" rx="28" fill="url(#subtleGrid)" />
            <circle cx="250" cy="390" r="180" fill="url(#centerGlow)" />
        </svg>';

        return 'data:image/svg+xml;base64,' . base64_encode( $svg );
    }
}

if ( ! function_exists( 'wakalumi_get_default_tim_list' ) ) {
    /**
     * Seluruh data seeder 32 Karyawan Resmi Bank Syariah Wakalumi (BSW)
     * Terurut presisi: DPS (1-2) -> Komisaris (3-4) -> Direksi (5-6) -> Divisi & Staf.
     *
     * @return array
     */
    function wakalumi_get_default_tim_list() {
        return [
            // ── 1. DEWAN PENGAWAS SYARIAH (DPS) ───────────────────────────
            [
                'id'           => 'emp_dps_1',
                'nama'         => 'H. Zarkasih Nur',
                'divisi'       => 'dps',
                'divisi_label' => 'Dewan Pengawas Syariah (DPS)',
                'jabatan'      => 'Ketua Dewan Pengawas Syariah',
                'nip'          => '-',
                'idcard_image' => '',
                'tingkat'      => 'eksekutif',
                'short_tag'    => 'DPS',
                'quote'        => 'Menjaga kemurnian prinsip syariah adalah fondasi utama keberkahan dan kepercayaan nasabah.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 1,
            ],
            [
                'id'           => 'emp_dps_2',
                'nama'         => 'Haryanto',
                'divisi'       => 'dps',
                'divisi_label' => 'Dewan Pengawas Syariah (DPS)',
                'jabatan'      => 'Anggota Dewan Pengawas Syariah',
                'nip'          => '-',
                'idcard_image' => '',
                'tingkat'      => 'eksekutif',
                'short_tag'    => 'DPS',
                'quote'        => 'Integritas dan kepatuhan syariah menghadirkan ketenangan dalam setiap langkah transaksi.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 2,
            ],

            // ── 2. DEWAN KOMISARIS ─────────────────────────────────────────
            [
                'id'           => 'emp_kom_1',
                'nama'         => 'Budi Satoto',
                'divisi'       => 'komisaris',
                'divisi_label' => 'Dewan Komisaris',
                'jabatan'      => 'Komisaris Utama',
                'nip'          => '-',
                'idcard_image' => '',
                'tingkat'      => 'eksekutif',
                'short_tag'    => 'KOM',
                'quote'        => 'Tata kelola yang sehat, transparan, dan akuntabel adalah pilar utama ketahanan bank syariah.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 3,
            ],
            [
                'id'           => 'emp_kom_2',
                'nama'         => 'Rena Bagun Luhur',
                'divisi'       => 'komisaris',
                'divisi_label' => 'Dewan Komisaris',
                'jabatan'      => 'Komisaris',
                'nip'          => '-',
                'idcard_image' => '',
                'tingkat'      => 'eksekutif',
                'short_tag'    => 'KOM',
                'quote'        => 'Pengawasan yang cermat dan berorientasi kehati-hatian menjamin perlindungan menyeluruh bagi nasabah.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 4,
            ],

            // ── 3. DIREKSI / MANAJEMEN EKSEKUTIF ────────────────────────────
            [
                'id'           => 'emp_dir_1',
                'nama'         => 'Kiftiah Hindun',
                'divisi'       => 'manajemen',
                'divisi_label' => 'Direksi & Manajemen Eksekutif',
                'jabatan'      => 'Direktur Utama',
                'nip'          => '-',
                'idcard_image' => '',
                'tingkat'      => 'eksekutif',
                'short_tag'    => 'DIR',
                'quote'        => 'Melayani dengan hati, memimpin dengan amanah untuk kemaslahatan dan kemandirian ekonomi umat.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 5,
            ],
            [
                'id'           => 'emp_dir_2',
                'nama'         => 'Lukman Nugroho',
                'divisi'       => 'manajemen',
                'divisi_label' => 'Direksi & Manajemen Eksekutif',
                'jabatan'      => 'Direktur Bisnis',
                'nip'          => '-',
                'idcard_image' => '',
                'tingkat'      => 'eksekutif',
                'short_tag'    => 'DIR',
                'quote'        => 'Inovasi produk pembiayaan syariah yang solutif untuk mendorong pertumbuhan mitra usaha dan UMKM.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 6,
            ],

            // ── 4. SEKRETARIAT PERUSAHAAN & DIREKSI ─────────────────────────
            [
                'id'           => 'emp_sek_1',
                'nama'         => 'Putri Saadatul Alawiyah Rahmat',
                'divisi'       => 'sekretaris',
                'divisi_label' => 'Sekretariat Perusahaan & Direksi',
                'jabatan'      => 'Sekretaris Perusahaan & Direksi',
                'nip'          => '22302',
                'idcard_image' => '',
                'tingkat'      => 'pe',
                'short_tag'    => 'PE',
                'quote'        => 'Ketertiban tata kelola administrasi dan komunikasi korporasi mencerminkan profesionalisme bank.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 7,
            ],

            // ── 5. SKAI (SATUAN KERJA AUDIT INTERNAL) ──────────────────────
            [
                'id'           => 'emp_skai_1',
                'nama'         => 'Muhammad Taqiyudin',
                'divisi'       => 'skai',
                'divisi_label' => 'SKAI (Satuan Kerja Audit Internal)',
                'jabatan'      => 'Kepala Satuan Kerja Audit Internal (SKAI)',
                'nip'          => '22603',
                'idcard_image' => '',
                'tingkat'      => 'pe',
                'short_tag'    => 'PE',
                'quote'        => 'Pengawasan internal yang objektif dan independen demi memastikan mitigasi risiko berjalan optimal.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 8,
            ],

            // ── 6. LEGAL & KEPATUHAN ───────────────────────────────────────
            [
                'id'           => 'emp_leg_1',
                'nama'         => 'Budiyono',
                'divisi'       => 'legal',
                'divisi_label' => 'Divisi Legal & Kepatuhan',
                'jabatan'      => 'Kepala Divisi Legal',
                'nip'          => '94010',
                'idcard_image' => '',
                'tingkat'      => 'pe',
                'short_tag'    => 'PE',
                'quote'        => 'Kepastian hukum dan kepatuhan regulasi OJK adalah perisai kokoh bagi integritas perbankan syariah.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 9,
            ],
            [
                'id'           => 'emp_leg_2',
                'nama'         => 'Eko Mulyono',
                'divisi'       => 'legal',
                'divisi_label' => 'Divisi Legal & Kepatuhan',
                'jabatan'      => 'Staff Legal',
                'nip'          => '25010',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Ketelitian analisis yuridis dalam setiap akad muamalah demi keamanan transaksi nasabah.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 10,
            ],

            // ── 7. SENIOR STAFF ────────────────────────────────────────────
            [
                'id'           => 'emp_sen_1',
                'nama'         => 'Silvi Sy',
                'divisi'       => 'senior',
                'divisi_label' => 'Senior Staff',
                'jabatan'      => 'Senior Staff',
                'nip'          => '-',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Pengalaman panjang dan komitmen tinggi untuk kualitas layanan perbankan yang senantiasa prima.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 11,
            ],

            // ── 8. PERSONALIA (HRD) & UMUM ─────────────────────────────────
            [
                'id'           => 'emp_hrd_1',
                'nama'         => 'Syifa Kharisma Dewi',
                'divisi'       => 'personalia',
                'divisi_label' => 'Personalia (HRD) & Umum',
                'jabatan'      => 'Kepala Divisi Personalia & Umum',
                'nip'          => '22301',
                'idcard_image' => '',
                'tingkat'      => 'pe',
                'short_tag'    => 'PE',
                'quote'        => 'Membangun insan perbankan syariah yang berakhlak mulia, berkinerja unggul, dan berjiwa melayani.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 12,
            ],
            [
                'id'           => 'emp_ga_1',
                'nama'         => 'Muhammad Zuhri',
                'divisi'       => 'umum',
                'divisi_label' => 'Divisi Umum & Operasional Kantor',
                'jabatan'      => 'Staff Divisi Umum',
                'nip'          => '22606',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Pelayanan logistik dan sarana kerja yang tanggap dan efisien untuk kenyamanan bersama.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 13,
            ],
            [
                'id'           => 'emp_ob_1',
                'nama'         => 'Muhammad Rian Irpanni',
                'divisi'       => 'pramubakti',
                'divisi_label' => 'Pramubakti & Office Boy',
                'jabatan'      => 'Pramubakti / Office Boy',
                'nip'          => '21901',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Bekerja dengan ikhlas dan penuh semangat demi kelancaran aktivitas harian di kantor tercinta.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 14,
            ],
            [
                'id'           => 'emp_sec_1',
                'nama'         => 'Slamet Widodo',
                'divisi'       => 'keamanan',
                'divisi_label' => 'Keamanan & Ketertiban (Security)',
                'jabatan'      => 'Staff Keamanan / Satpam',
                'nip'          => '-',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Kewaspadaan prima dan keramahan sikap menjamin rasa aman dan nyaman bagi seluruh nasabah.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 15,
            ],
            [
                'id'           => 'emp_cs_clean_1',
                'nama'         => 'Staff Kebersihan BSW',
                'divisi'       => 'umum',
                'divisi_label' => 'Divisi Umum & Operasional Kantor',
                'jabatan'      => 'Petugas Kebersihan (Cleaning Service)',
                'nip'          => '-',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Kebersihan adalah sebagian dari iman, menghadirkan lingkungan perbankan yang asri dan higienis.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 16,
            ],

            // ── 9. BISNIS & PEMASARAN (MARKETING) ──────────────────────────
            [
                'id'           => 'emp_bis_1',
                'nama'         => 'Gunawan',
                'divisi'       => 'bisnis',
                'divisi_label' => 'Bisnis & Pemasaran (Marketing)',
                'jabatan'      => 'Kepala Divisi Bisnis & Pemasaran',
                'nip'          => '20010',
                'idcard_image' => '',
                'tingkat'      => 'pe',
                'short_tag'    => 'PE',
                'quote'        => 'Membangun kemitraan pembiayaan yang produktif, berkah, dan saling menguntungkan secara berkelanjutan.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 17,
            ],
            [
                'id'           => 'emp_bis_2',
                'nama'         => 'Ari Firdaus',
                'divisi'       => 'bisnis',
                'divisi_label' => 'Bisnis & Pemasaran (Marketing)',
                'jabatan'      => 'Account Officer (AO) Pembiayaan',
                'nip'          => '24008',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Mendampingi pelaku usaha bertumbuh pesat melalui pembiayaan syariah yang tepat guna.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 18,
            ],
            [
                'id'           => 'emp_bis_3',
                'nama'         => 'Iwan Setiawan',
                'divisi'       => 'bisnis',
                'divisi_label' => 'Bisnis & Pemasaran (Marketing)',
                'jabatan'      => 'Account Officer (AO) Pembiayaan',
                'nip'          => '24007',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Solusi permodalan usaha halal dan berkah tanpa riba untuk kemakmuran mitra usaha.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 19,
            ],
            [
                'id'           => 'emp_bis_4',
                'nama'         => 'Ana Rohana',
                'divisi'       => 'bisnis',
                'divisi_label' => 'Bisnis & Pemasaran (Marketing)',
                'jabatan'      => 'Funding Officer',
                'nip'          => '22203',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Mengajak masyarakat cerdas mengelola masa depan melalui simpanan syariah yang aman dan menguntungkan.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 20,
            ],
            [
                'id'           => 'emp_bis_5',
                'nama'         => 'Suat',
                'divisi'       => 'bisnis',
                'divisi_label' => 'Bisnis & Pemasaran (Marketing)',
                'jabatan'      => 'Account Officer (AO) Pembiayaan',
                'nip'          => '21501',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Menjunjung tinggi amanah nasabah dalam setiap proses penyaluran pembiayaan produktif.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 21,
            ],
            [
                'id'           => 'emp_bis_6',
                'nama'         => 'Deden Hidayat',
                'divisi'       => 'bisnis',
                'divisi_label' => 'Bisnis & Pemasaran (Marketing)',
                'jabatan'      => 'Account Officer (AO) Pembiayaan',
                'nip'          => '22202',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Layanan responsif dan pendampingan finansial berkelanjutan demi kelancaran usaha mitra.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 22,
            ],
            [
                'id'           => 'emp_bis_7',
                'nama'         => 'Muhammad Aminnudin',
                'divisi'       => 'bisnis',
                'divisi_label' => 'Bisnis & Pemasaran (Marketing)',
                'jabatan'      => 'Account Officer (AO) Pembiayaan',
                'nip'          => '22506',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Kemitraan tulus yang mengedepankan nilai syariah demi kesuksesan bersama.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 23,
            ],
            [
                'id'           => 'emp_bis_8',
                'nama'         => 'Akbar Fitra Bagaskara',
                'divisi'       => 'bisnis',
                'divisi_label' => 'Bisnis & Pemasaran (Marketing)',
                'jabatan'      => 'Account Officer (AO) Pembiayaan',
                'nip'          => '22507',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Energi muda berintegritas menghadirkan akses pembiayaan yang cepat, mudah, dan transparan.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 24,
            ],
            [
                'id'           => 'emp_bis_9',
                'nama'         => 'Abdullah Al-Faruq',
                'divisi'       => 'bisnis',
                'divisi_label' => 'Bisnis & Pemasaran (Marketing)',
                'jabatan'      => 'Account Officer (AO) Pembiayaan',
                'nip'          => '22604',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Menjangkau dan memberdayakan sektor riil masyarakat melalui skema syariah yang adil.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 25,
            ],

            // ── 10. TEKNOLOGI INFORMASI (IT) ───────────────────────────────
            [
                'id'           => 'emp_it_1',
                'nama'         => 'Arif Rafida Rahman',
                'divisi'       => 'it',
                'divisi_label' => 'Teknologi Informasi (IT & Digital Banking)',
                'jabatan'      => 'Kepala Divisi IT & Digital Banking',
                'nip'          => '21902',
                'idcard_image' => '',
                'tingkat'      => 'pe',
                'short_tag'    => 'PE',
                'quote'        => 'Transformasi teknologi perbankan syariah yang modern, aman, handal, dan berpusat pada nasabah.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 26,
            ],

            // ── 11. OPERASIONAL (CS, TELLER & PELAPORAN) ───────────────────
            [
                'id'           => 'emp_ops_1',
                'nama'         => 'Lena',
                'divisi'       => 'operasional',
                'divisi_label' => 'Operasional (CS, Teller & Pelaporan)',
                'jabatan'      => 'Kepala Divisi Operasional',
                'nip'          => '-',
                'idcard_image' => '',
                'tingkat'      => 'pe',
                'short_tag'    => 'PE',
                'quote'        => 'Operasional yang tertib, cepat, dan akurat adalah standar keunggulan layanan perbankan kami.',
                'is_kadiv'     => 1,
                'status'       => 'aktif',
                'urutan'       => 27,
            ],
            [
                'id'           => 'emp_ops_2',
                'nama'         => 'Zsa Zsa Maharani Syah',
                'divisi'       => 'operasional',
                'divisi_label' => 'Operasional (CS, Teller & Pelaporan)',
                'jabatan'      => 'Customer Service Officer',
                'nip'          => '22502',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Senyum ramah dan solusi tulus menyambut setiap nasabah sebagai keluarga besar Bank Syariah Wakalumi.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 28,
            ],
            [
                'id'           => 'emp_ops_3',
                'nama'         => 'Diana Ayu Lestari',
                'divisi'       => 'operasional',
                'divisi_label' => 'Operasional (CS, Teller & Pelaporan)',
                'jabatan'      => 'Teller Operasional',
                'nip'          => '21801',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Ketelitian transaksi kas dan ketulusan pelayanan demi kenyamanan finansial nasabah.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 29,
            ],
            [
                'id'           => 'emp_ops_4',
                'nama'         => 'Nur\'aeni',
                'divisi'       => 'operasional',
                'divisi_label' => 'Operasional (CS, Teller & Pelaporan)',
                'jabatan'      => 'Teller Operasional',
                'nip'          => '26001',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Akurasi hitungan dan kehangatan salam di setiap layanan meja kas perbankan.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 30,
            ],
            [
                'id'           => 'emp_ops_5',
                'nama'         => 'Annisa Hafizhah',
                'divisi'       => 'operasional',
                'divisi_label' => 'Operasional (CS, Teller & Pelaporan)',
                'jabatan'      => 'Staff Pelaporan & Akuntansi',
                'nip'          => '22601',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Penyusunan laporan keuangan yang akuntabel, tepat waktu, dan taat pada standar regulator OJK.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 31,
            ],
            [
                'id'           => 'emp_ops_6',
                'nama'         => 'Mutiara Dwi R.',
                'divisi'       => 'operasional',
                'divisi_label' => 'Operasional (CS, Teller & Pelaporan)',
                'jabatan'      => 'Staff Pelayanan Operasional',
                'nip'          => '22605',
                'idcard_image' => '',
                'tingkat'      => 'staff',
                'short_tag'    => '',
                'quote'        => 'Dedikasi penuh dalam mendukung kelancaran operasional perbankan yang rapi dan terpercaya.',
                'is_kadiv'     => 0,
                'status'       => 'aktif',
                'urutan'       => 32,
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_tim_list' ) ) {
    /**
     * Mengambil daftar seluruh karyawan Bank Syariah Wakalumi dari database.
     * Jika opsi belum tersimpan atau belum mencakup field 'quote' & 'tingkat',
     * otomatis memutakhirkan ke data 32 karyawan resmi.
     *
     * @return array
     */
    function wakalumi_get_tim_list() {
        $saved = get_option( 'options_tim_list', null );
        if ( is_array( $saved ) && count( $saved ) >= 32 && isset( $saved[0]['quote'] ) && isset( $saved[0]['tingkat'] ) ) {
            usort( $saved, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );
            return $saved;
        }

        // Auto-save & return 32 official seeders
        $default = wakalumi_get_default_tim_list();
        update_option( 'options_tim_list', $default );
        return $default;
    }
}


// ── 2. MENU REGISTRATION & ASSETS ───────────────────────────────────

add_action( 'admin_menu', 'wakalumi_register_tim_page', 32 );
function wakalumi_register_tim_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Tim Kami & Karyawan',
        'Tim Kami & Karyawan',
        'manage_options',
        'wakalumi-tim-kami',
        'wakalumi_render_tim_page'
    );
}

add_action( 'admin_enqueue_scripts', 'wakalumi_tim_admin_assets' );
function wakalumi_tim_admin_assets( $hook ) {
    if ( strpos( $hook, 'wakalumi-tim-kami' ) !== false ) {
        wp_enqueue_media();
    }
}


// ── 3. RENDER ADMIN INTERFACE & SAVE CONTROLLER ─────────────────────

function wakalumi_render_tim_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Anda tidak memiliki hak akses untuk mengelola direktori tim karyawan.' );
    }

    $notice = '';

    // Handle Reset to 32 Official Seeders Action
    if ( isset( $_GET['wkl_action'] ) && $_GET['wkl_action'] === 'reset_32_employees' && check_admin_referer( 'wkl_reset_tim_nonce' ) ) {
        update_option( 'options_tim_list', wakalumi_get_default_tim_list() );
        update_option( 'options_tim_divisions', wakalumi_get_default_tim_divisions() );
        $notice = '<div class="notice notice-success is-dismissible"><p><strong>Berhasil!</strong> Seluruh 32 data karyawan resmi Bank Syariah Wakalumi (BSW) dan struktur divisi hierarki teratas telah dimuat ulang secara lengkap.</p></div>';
    }

    // Handle Form Save
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['wakalumi_tim_nonce'] ) ) {
        if ( ! wp_verify_nonce( $_POST['wakalumi_tim_nonce'], 'wakalumi_tim_action' ) ) {
            $notice = '<div class="notice notice-error is-dismissible"><p>Validasi keamanan gagal. Silakan coba kembali.</p></div>';
        } else {
            // 1. Header Banner & Anti-Fraud Settings
            update_option( 'options_tim_badge', sanitize_text_field( $_POST['options_tim_badge'] ?? '' ) );
            update_option( 'options_tim_title', sanitize_text_field( $_POST['options_tim_title'] ?? '' ) );
            update_option( 'options_tim_desc', sanitize_textarea_field( $_POST['options_tim_desc'] ?? '' ) );

            update_option( 'options_tim_notice_badge', sanitize_text_field( $_POST['options_tim_notice_badge'] ?? '' ) );
            update_option( 'options_tim_notice_title', sanitize_text_field( $_POST['options_tim_notice_title'] ?? '' ) );
            update_option( 'options_tim_notice_desc', sanitize_textarea_field( $_POST['options_tim_notice_desc'] ?? '' ) );
            update_option( 'options_tim_notice_wa', sanitize_text_field( $_POST['options_tim_notice_wa'] ?? '' ) );

            // CTA Section Settings
            update_option( 'options_tim_cta_show', isset( $_POST['options_tim_cta_show'] ) ? '1' : '0' );
            update_option( 'options_tim_cta_badge', sanitize_text_field( $_POST['options_tim_cta_badge'] ?? '' ) );
            update_option( 'options_tim_cta_title', sanitize_text_field( $_POST['options_tim_cta_title'] ?? '' ) );
            update_option( 'options_tim_cta_desc', sanitize_textarea_field( $_POST['options_tim_cta_desc'] ?? '' ) );
            update_option( 'options_tim_cta_btn1_text', sanitize_text_field( $_POST['options_tim_cta_btn1_text'] ?? '' ) );
            update_option( 'options_tim_cta_btn1_url', esc_url_raw( $_POST['options_tim_cta_btn1_url'] ?? '' ) );
            update_option( 'options_tim_cta_btn2_text', sanitize_text_field( $_POST['options_tim_cta_btn2_text'] ?? '' ) );
            update_option( 'options_tim_cta_btn2_url', esc_url_raw( $_POST['options_tim_cta_btn2_url'] ?? '' ) );

            // 2. Simpan Manajemen Divisi
            $div_slugs   = $_POST['div_slug'] ?? [];
            $div_names   = $_POST['div_name'] ?? [];
            $div_colors  = $_POST['div_color'] ?? [];
            $div_icons   = $_POST['div_icon'] ?? [];
            $div_urutans = $_POST['div_urutan'] ?? [];

            $color_options = function_exists( 'wakalumi_get_division_color_options' ) ? wakalumi_get_division_color_options() : [];
            $default_color_map = [
                'dps'          => 'emerald',
                'komisaris'    => 'indigo',
                'manajemen'    => 'amber',
                'senior_staff' => 'purple',
                'sekretaris'   => 'rose',
                'skai'         => 'teal',
                'legal'        => 'blue',
                'bisnis'       => 'orange',
                'it'           => 'cyan',
                'operasional'  => 'teal',
                'personalia'   => 'fuchsia',
                'umum'         => 'slate',
                'keamanan'     => 'amber',
                'pramubakti'   => 'lime',
            ];

            $new_divisions = [];
            for ( $d = 0; $d < count( $div_slugs ); $d++ ) {
                $slug = sanitize_title( $div_slugs[$d] ?? '' );
                $name = sanitize_text_field( $div_names[$d] ?? '' );
                if ( empty( $slug ) || empty( $name ) ) continue;

                $chosen_color = sanitize_key( $div_colors[$d] ?? ( $default_color_map[$slug] ?? 'teal' ) );
                $badge_class  = $color_options[$chosen_color]['class'] ?? 'bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 border-teal-200 dark:border-teal-800/70';
                $chosen_icon  = sanitize_key( $div_icons[$d] ?? 'briefcase' );

                $new_divisions[ $slug ] = [
                    'slug'        => $slug,
                    'name'        => $name,
                    'color'       => $chosen_color,
                    'badge_class' => $badge_class,
                    'icon'        => $chosen_icon,
                    'urutan'      => intval( $div_urutans[$d] ?? ( $d + 1 ) ),
                ];
            }

            if ( ! empty( $new_divisions ) ) {
                uasort( $new_divisions, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );
                update_option( 'options_tim_divisions', $new_divisions );
            }

            // 3. Simpan Repeater Karyawan
            $ids          = $_POST['emp_id'] ?? [];
            $namas        = $_POST['emp_nama'] ?? [];
            $divisis      = $_POST['emp_divisi'] ?? [];
            $divisi_lbls  = $_POST['emp_divisi_label'] ?? [];
            $jabatans     = $_POST['emp_jabatan'] ?? [];
            $nips         = $_POST['emp_nip'] ?? [];
            $idcard_imgs  = $_POST['emp_idcard_image'] ?? [];
            $tingkats     = $_POST['emp_tingkat'] ?? [];
            $short_tags   = $_POST['emp_short_tag'] ?? [];
            $quotes       = $_POST['emp_quote'] ?? [];
            $kadivs       = $_POST['emp_is_kadiv'] ?? [];
            $statuses     = $_POST['emp_status'] ?? [];
            $urutans      = $_POST['emp_urutan'] ?? [];

            $new_employees = [];
            $active_divisions = ! empty( $new_divisions ) ? $new_divisions : wakalumi_get_tim_divisions();

            for ( $i = 0; $i < count( $ids ); $i++ ) {
                $nama = sanitize_text_field( $namas[$i] ?? '' );
                if ( empty( $nama ) ) {
                    continue;
                }

                $card_id      = sanitize_text_field( $ids[$i] ?? ( 'emp_' . $i ) );
                $div_slug     = sanitize_text_field( $divisis[$i] ?? 'operasional' );
                $div_lbl      = sanitize_text_field( $divisi_lbls[$i] ?? '' );
                if ( empty( $div_lbl ) && isset( $active_divisions[ $div_slug ] ) ) {
                    $div_lbl = $active_divisions[ $div_slug ]['name'];
                }

                $tingkat_val  = sanitize_text_field( $tingkats[$i] ?? 'staff' );
                $tag_val      = strtoupper( sanitize_text_field( $short_tags[$i] ?? '' ) );
                if ( empty( $tag_val ) ) {
                    if ( $tingkat_val === 'eksekutif' ) {
                        if ( $div_slug === 'dps' ) $tag_val = 'DPS';
                        elseif ( $div_slug === 'komisaris' ) $tag_val = 'KOM';
                        elseif ( $div_slug === 'manajemen' ) $tag_val = 'DIR';
                        else $tag_val = 'EKS';
                    } elseif ( $tingkat_val === 'pe' ) {
                        $tag_val = 'PE';
                    }
                }

                $quote_val    = sanitize_textarea_field( $quotes[$i] ?? '' );
                $is_kadiv_val = ( $tingkat_val === 'eksekutif' || $tingkat_val === 'pe' || isset( $kadivs[ $card_id ] ) ) ? 1 : 0;

                $new_employees[] = [
                    'id'           => $card_id,
                    'nama'         => $nama,
                    'divisi'       => $div_slug,
                    'divisi_label' => $div_lbl,
                    'jabatan'      => sanitize_text_field( $jabatans[$i] ?? '' ),
                    'nip'          => sanitize_text_field( $nips[$i] ?? '-' ),
                    'idcard_image' => esc_url_raw( $idcard_imgs[$i] ?? '' ),
                    'tingkat'      => $tingkat_val,
                    'short_tag'    => $tag_val,
                    'quote'        => $quote_val,
                    'is_kadiv'     => $is_kadiv_val,
                    'status'       => sanitize_text_field( $statuses[$i] ?? 'aktif' ),
                    'urutan'       => intval( $urutans[$i] ?? ( $i + 1 ) ),
                ];
            }

            // Urutkan berdasarkan nomor urut
            usort( $new_employees, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );

            update_option( 'options_tim_list', $new_employees );

            $notice = '<div class="notice notice-success is-dismissible"><p><strong>Berhasil!</strong> Data Tim Kami &amp; ID Card Karyawan Bank Syariah Wakalumi telah disimpan dengan aman.</p></div>';
        }
    }

    // Load Data Terkini
    $header        = wakalumi_get_tim_header();
    $divisions     = wakalumi_get_tim_divisions();
    $employees     = wakalumi_get_tim_list();
    $cta           = wakalumi_get_tim_cta();

    $total_emp       = count( $employees );
    $active_emp      = count( array_filter( $employees, fn($x) => ( $x['status'] ?? 'aktif' ) === 'aktif' ) );
    $eksekutif_count = count( array_filter( $employees, fn($x) => ( $x['tingkat'] ?? '' ) === 'eksekutif' ) );
    $pe_count        = count( array_filter( $employees, fn($x) => ( $x['tingkat'] ?? '' ) === 'pe' ) );
    $staff_count     = count( array_filter( $employees, fn($x) => ( $x['tingkat'] ?? 'staff' ) === 'staff' ) );
    $has_image_emp   = count( array_filter( $employees, fn($x) => ! empty( $x['idcard_image'] ) ) );

    $reset_url     = wp_nonce_url( admin_url( 'admin.php?page=wakalumi-tim-kami&wkl_action=reset_32_employees' ), 'wkl_reset_tim_nonce' );
    ?>

    <div class="wrap" style="max-width: 1140px; margin-top: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;">

        <!-- TOP BAR HEADER -->
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #e2e8f0;">
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span class="dashicons dashicons-id-alt" style="font-size: 28px; width: 28px; height: 28px; color: #0f766e;"></span> Tim Kami &amp; Direktori ID Card Karyawan
                </h1>
                <p style="margin: 4px 0 0 0; color: #64748b; font-size: 13px;">
                    Hierarki teratas: <strong>Dewan Pengawas Syariah (DPS) &rarr; Dewan Komisaris &rarr; Direksi</strong> dilanjutkan Kepala Divisi &amp; Staf operasional Bank Syariah Wakalumi.
                </p>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="<?php echo esc_url( home_url( '/informasi/tim-kami/' ) ); ?>" target="_blank" class="button button-secondary" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; padding: 4px 14px; border-radius: 6px;">
                    <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px;"></span> Lihat Halaman Tim Kami
                </a>
                <a href="<?php echo esc_url( $reset_url ); ?>" onclick="return confirm('Apakah Anda yakin ingin memuat ulang 32 data karyawan asli BSW beserta struktur divisinya? Perubahan kustom Anda saat ini akan diselaraskan dengan data baku resmi.');" class="button" style="color: #0f766e; border-color: #0f766e; font-weight: 600; padding: 4px 12px; border-radius: 6px; display: inline-flex; align-items: center; gap: 4px;">
                    <span class="dashicons dashicons-image-rotate" style="font-size: 14px; width: 14px; height: 14px; vertical-align: middle;"></span> Reset 32 Karyawan Resmi
                </a>
            </div>
        </div>

        <?php if ( ! empty( $notice ) ) echo $notice; ?>

        <!-- QUICK STATS BAR -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px; margin-bottom: 25px;">
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 12px 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); border-left: 4px solid #0f766e;">
                <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Total Personel</div>
                <div style="font-size: 22px; font-weight: 800; color: #0f172a; margin-top: 2px;"><?php echo $total_emp; ?> <span style="font-size: 12px; font-weight: 600; color: #64748b;">Orang</span></div>
            </div>
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 12px 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); border-left: 4px solid #06b6d4;">
                <div style="font-size: 11px; font-weight: 700; color: #0891b2; text-transform: uppercase;">Pengurus (DPS/Kom/Dir)</div>
                <div style="font-size: 22px; font-weight: 800; color: #0891b2; margin-top: 2px;"><?php echo $eksekutif_count; ?> <span style="font-size: 12px; font-weight: 600; color: #64748b;">Eksekutif</span></div>
            </div>
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 12px 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); border-left: 4px solid #0f766e;">
                <div style="font-size: 11px; font-weight: 700; color: #0f766e; text-transform: uppercase;">Pejabat Eksekutif (PE)</div>
                <div style="font-size: 22px; font-weight: 800; color: #0f766e; margin-top: 2px;"><?php echo $pe_count; ?> <span style="font-size: 12px; font-weight: 600; color: #64748b;">Kadiv</span></div>
            </div>
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 12px 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); border-left: 4px solid #64748b;">
                <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase;">Staf Pelaksana</div>
                <div style="font-size: 22px; font-weight: 800; color: #475569; margin-top: 2px;"><?php echo $staff_count; ?> <span style="font-size: 12px; font-weight: 600; color: #64748b;">Personel</span></div>
            </div>
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 12px 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); border-left: 4px solid #10b981;">
                <div style="font-size: 11px; font-weight: 700; color: #166534; text-transform: uppercase;">Karyawan Aktif</div>
                <div style="font-size: 22px; font-weight: 800; color: #10b981; margin-top: 2px;"><?php echo $active_emp; ?> <span style="font-size: 12px; font-weight: 600; color: #64748b;">Bertugas</span></div>
            </div>
        </div>

        <form method="post" action="" id="wakalumi-tim-form">
            <?php wp_nonce_field( 'wakalumi_tim_action', 'wakalumi_tim_nonce' ); ?>

            <!-- ================================================================
                 SECTION 1: MANAJEMEN DIVISI BANK (DYNAMIC DIVISION MANAGER)
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; padding-bottom: 12px; border-bottom: 1px solid #e2e8f0;">
                    <div>
                        <h2 style="font-size: 15px; font-weight: 700; color: #0f766e; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <span>Struktur Divisi</span> Manajemen Divisi Bank (Urutan Tampil &amp; Aksen Warna)
                        </h2>
                        <p style="margin: 3px 0 0 0; color: #64748b; font-size: 12px;">
                            Daftar divisi di bawah ini secara otomatis menjadi opsi dropdown pada setiap kartu karyawan, tombol filter tab desktop, dan drawer mobile. Anda dapat menyesuaikan nama, slug, urutan, serta aksen warnanya.
                        </p>
                    </div>
                    <button type="button" id="btn-add-division" class="button" style="font-weight: 700; font-size: 12px; color: #0f766e; border-color: #0f766e; border-radius: 6px;">
                        + Tambah Divisi Baru
                    </button>
                </div>

                <div id="divisions-list-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(360px, 1fr)); gap: 12px; margin-top: 15px;">
                    <?php 
                    $color_options = function_exists( 'wakalumi_get_division_color_options' ) ? wakalumi_get_division_color_options() : [];
                    $default_color_map = [
                        'dps'          => 'emerald',
                        'komisaris'    => 'indigo',
                        'manajemen'    => 'amber',
                        'senior_staff' => 'purple',
                        'sekretaris'   => 'rose',
                        'skai'         => 'teal',
                        'legal'        => 'blue',
                        'bisnis'       => 'orange',
                        'it'           => 'cyan',
                        'operasional'  => 'teal',
                        'personalia'   => 'fuchsia',
                        'umum'         => 'slate',
                        'keamanan'     => 'amber',
                        'pramubakti'   => 'lime',
                    ];

                    $d_idx = 0;
                    foreach ( $divisions as $slug => $d_item ) : 
                        $d_idx++;
                        $d_name  = esc_attr( $d_item['name'] ?? '' );
                        $d_urut  = intval( $d_item['urutan'] ?? $d_idx );
                        $d_color = esc_attr( $d_item['color'] ?? ( $default_color_map[$slug] ?? 'teal' ) );
                    ?>
                        <div class="division-item-box" style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px 12px; display: flex; align-items: center; gap: 8px;">
                            <input type="text" name="div_slug[]" value="<?php echo esc_attr( $slug ); ?>" placeholder="slug" style="width: 80px; font-size: 11px; font-family: monospace; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px 6px; background: #fff;" title="Kode unik divisi (slug)">
                            <input type="text" name="div_name[]" value="<?php echo $d_name; ?>" placeholder="Nama Divisi" style="flex: 1; min-width: 110px; font-size: 12px; font-weight: 600; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px 8px; background: #fff;">
                            <select name="div_color[]" style="font-size: 11px; font-weight: 600; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px 6px; background: #fff;" title="Aksen Warna Divisi">
                                <?php foreach ( $color_options as $c_key => $c_val ) : ?>
                                    <option value="<?php echo esc_attr( $c_key ); ?>" <?php selected( $d_color, $c_key ); ?>>
                                        <?php echo esc_html( $c_val['name'] ); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="number" name="div_urutan[]" value="<?php echo $d_urut; ?>" style="width: 45px; font-size: 11px; text-align: center; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px 2px; background: #fff;" title="Urutan tampil">
                            <button type="button" class="button-link btn-del-div" style="color: #ef4444; font-size: 13px; text-decoration: none; padding: 2px;" title="Hapus Divisi">✕</button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 2: REPEATER DAFTAR KARYAWAN & UPLOAD PNG ID CARD
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; padding-bottom: 15px; border-bottom: 1px solid #e2e8f0;">
                    <div>
                        <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <span>Direktori</span> Daftar Anggota Karyawan &amp; File PNG ID Card (1 : 1.56)
                        </h2>
                        <p style="margin: 4px 0 0 0; color: #64748b; font-size: 12px;">
                            Daftar <strong>32 Karyawan Resmi</strong> telah terisi lengkap dengan NIP baku. Anda dapat menandai <strong>Kepala Divisi</strong> dan mengunggah file PNG ID Card asli masing-masing personel.
                        </p>
                    </div>
                    <button type="button" id="btn-add-employee" class="button button-primary" style="background: #0f766e; border-color: #0d9488; font-weight: 700; padding: 4px 16px; border-radius: 6px;">
                        + Tambah Karyawan Baru
                    </button>
                </div>

                <!-- EMPLOYEE CARDS CONTAINER -->
                <div id="employee-list-container" style="display: flex; flex-direction: column; gap: 18px; margin-top: 20px;">
                    <?php 
                    foreach ( $employees as $idx => $emp ) : 
                        $emp_id       = esc_attr( $emp['id'] ?? ( 'emp_' . $idx ) );
                        $emp_nama     = esc_attr( $emp['nama'] ?? '' );
                        $emp_divisi   = esc_attr( $emp['divisi'] ?? 'operasional' );
                        $emp_div_lbl  = esc_attr( $emp['divisi_label'] ?? '' );
                        $emp_jabatan  = esc_attr( $emp['jabatan'] ?? '' );
                        $emp_nip      = esc_attr( $emp['nip'] ?? '-' );
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
                        $is_kadiv     = ( $emp_tingkat === 'eksekutif' || $emp_tingkat === 'pe' );
                        $emp_status   = esc_attr( $emp['status'] ?? 'aktif' );
                        $emp_urutan   = intval( $emp['urutan'] ?? ( $idx + 1 ) );
                        $placeholder  = wakalumi_generate_idcard_placeholder( $emp_nama, $emp_jabatan, $emp_div_lbl, $emp_nip, $emp_tingkat, $emp_short_tag );
                        $preview_src  = ! empty( $emp_img ) ? $emp_img : $placeholder;

                        // Border styling by tier
                        $card_bg = '#f8fafc';
                        $card_border = '#cbd5e1';
                        $card_border_left = '#0f766e';
                        if ( $emp_tingkat === 'eksekutif' ) {
                            $card_bg = '#f0fdfa';
                            $card_border = '#5eead4';
                            $card_border_left = '#0d9488';
                        } elseif ( $emp_tingkat === 'pe' ) {
                            $card_bg = '#f0fdf4';
                            $card_border = '#86efac';
                            $card_border_left = '#15803d';
                        }
                    ?>
                        <div class="employee-card-item emp-tier-<?php echo $emp_tingkat; ?>" data-index="<?php echo $idx; ?>" data-id="<?php echo $emp_id; ?>" style="background: <?php echo $card_bg; ?>; border: 1px solid <?php echo $card_border; ?>; border-left: 5px solid <?php echo $card_border_left; ?>; border-radius: 10px; padding: 18px; transition: all 0.2s;">
                            <input type="hidden" name="emp_id[]" value="<?php echo $emp_id; ?>">

                            <div style="display: grid; grid-template-columns: 140px 1fr; gap: 20px; align-items: start;">
                                <!-- Left: ID Card Image Preview & Upload Button -->
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                    <div style="width: 140px; aspect-ratio: 1 / 1.56; background: #042f2e; border: 2px dashed #94a3b8; border-radius: 10px; overflow: hidden; position: relative; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                        <img class="emp-preview-img" src="<?php echo $preview_src; ?>" alt="ID Card Preview" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                                        <div style="position: absolute; bottom: 4px; left: 4px; right: 4px; background: rgba(0,0,0,0.7); backdrop-filter: blur(4px); color: #fff; font-size: 9px; text-align: center; border-radius: 4px; padding: 2px 4px; font-weight: 700;">
                                            1 : 1.56 RATIO
                                        </div>
                                    </div>
                                    <button type="button" class="button button-small btn-upload-idcard" style="width: 100%; font-weight: 600; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 4px;">
                                        <span class="dashicons dashicons-upload" style="font-size: 14px; width: 14px; height: 14px; line-height: 1;"></span> Unggah ID Card (WebP / PNG)
                                    </button>
                                    <button type="button" class="button-link btn-remove-idcard" style="color: #ef4444; font-size: 11px; text-decoration: none; <?php echo empty( $emp_img ) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus Foto
                                    </button>
                                    <input type="hidden" name="emp_idcard_image[]" class="emp-idcard-input" value="<?php echo $emp_img; ?>">
                                </div>

                                <!-- Right: Information Form Fields -->
                                <div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                                        <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                            <span style="font-weight: 800; font-size: 14px; color: #0f172a;">
                                                #<span class="emp-order-display"><?php echo $emp_urutan; ?></span> — <span class="emp-name-display"><?php echo ! empty( $emp_nama ) ? $emp_nama : 'Karyawan Baru'; ?></span>
                                            </span>
                                            <?php if ( $emp_tingkat === 'eksekutif' ) : ?>
                                                <span style="font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 999px; background: #ccfbf1; color: #0f766e; border: 1px solid #99f6e4;">
                                                    Pengurus / Eksekutif (<?php echo esc_html( $emp_short_tag ?: 'EKS' ); ?>)
                                                </span>
                                            <?php elseif ( $emp_tingkat === 'pe' ) : ?>
                                                <span style="font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 999px; background: #dcfce7; color: #166534; border: 1px solid #bbf7d0;">
                                                    Pejabat Eksekutif (PE)
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span style="font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 999px; <?php echo $emp_status === 'aktif' ? 'background: #dcfce7; color: #166534;' : 'background: #fee2e2; color: #991b1b;'; ?>" class="emp-status-badge">
                                                ● <?php echo $emp_status === 'aktif' ? 'Karyawan Aktif' : 'Non-Aktif'; ?>
                                            </span>
                                            <button type="button" class="button button-link-delete btn-delete-emp" style="color: #ef4444; font-size: 12px; padding: 2px 6px;">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>

                                    <div style="display: grid; grid-template-columns: 2fr 1.5fr; gap: 14px; margin-bottom: 12px;">
                                        <div>
                                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Nama Lengkap Karyawan</label>
                                            <input type="text" name="emp_nama[]" value="<?php echo $emp_nama; ?>" class="emp-nama-input" placeholder="Contoh: Muhammad Farhan" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; font-weight: 600; background: #fff;" required>
                                        </div>
                                        <div>
                                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Nomor Induk Pegawai (NIP / NIK)</label>
                                            <input type="text" name="emp_nip[]" value="<?php echo $emp_nip; ?>" placeholder="Contoh: 22301 atau -" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; font-family: monospace; background: #fff;">
                                        </div>
                                    </div>

                                    <div style="display: grid; grid-template-columns: 1.5fr 1.5fr; gap: 14px; margin-bottom: 12px;">
                                        <div>
                                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Divisi Bank</label>
                                            <select name="emp_divisi[]" class="emp-divisi-select" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                                                <?php foreach ( $divisions as $div_key => $div_info ) : ?>
                                                    <option value="<?php echo esc_attr( $div_key ); ?>" <?php selected( $emp_divisi, $div_key ); ?>>
                                                        <?php echo esc_html( $div_info['name'] ); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Jabatan / Posisi Spesifik</label>
                                            <input type="text" name="emp_jabatan[]" value="<?php echo $emp_jabatan; ?>" placeholder="Contoh: Account Officer Pembiayaan" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                                        </div>
                                    </div>

                                    <div style="display: grid; grid-template-columns: 1.2fr 1.3fr 0.8fr 1.2fr; gap: 12px; align-items: end;">
                                        <div>
                                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Label Divisi Tampil (Opsional)</label>
                                            <input type="text" name="emp_divisi_label[]" value="<?php echo $emp_div_lbl; ?>" placeholder="Ikuti nama divisi default" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 12px; background: #fff;">
                                        </div>
                                        <div>
                                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #0f766e;">Tingkat Jabatan</label>
                                            <select name="emp_tingkat[]" class="emp-tingkat-select" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 12px; font-weight: 700; background: #fff;">
                                                <option value="eksekutif" <?php selected( $emp_tingkat, 'eksekutif' ); ?>>Pengurus (DPS/Kom/Dir)</option>
                                                <option value="pe" <?php selected( $emp_tingkat, 'pe' ); ?>>Pejabat Eksekutif (PE)</option>
                                                <option value="staff" <?php selected( $emp_tingkat, 'staff' ); ?>>Staf Pelaksana</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Tag Singkat</label>
                                            <input type="text" name="emp_short_tag[]" value="<?php echo esc_attr( $emp_short_tag ); ?>" placeholder="DPS / KOM / DIR / PE" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 6px; font-size: 12px; font-weight: 800; background: #fff; text-transform: uppercase;">
                                        </div>
                                        <div>
                                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Status &amp; Urutan</label>
                                            <div style="display: flex; gap: 6px;">
                                                <select name="emp_status[]" class="emp-status-select" style="width: 60%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 4px; font-size: 12px; background: #fff;">
                                                    <option value="aktif" <?php selected( $emp_status, 'aktif' ); ?>>Aktif</option>
                                                    <option value="nonaktif" <?php selected( $emp_status, 'nonaktif' ); ?>>Non-Aktif</option>
                                                </select>
                                                <input type="number" name="emp_urutan[]" value="<?php echo $emp_urutan; ?>" min="1" class="emp-urutan-input" style="width: 40%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 4px; font-size: 12px; background: #fff;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quote Motivasi / Komitmen Pelayanan -->
                                    <div style="margin-top: 10px;">
                                        <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                            Kutipan Motivasi / Komitmen Pelayanan <span style="font-weight: 400; color: #64748b;">(Tampil eksklusif saat nasabah klik detail kartu ID Card)</span>
                                        </label>
                                        <textarea name="emp_quote[]" rows="2" placeholder="Contoh: Menjaga kemurnian syariah adalah fondasi utama keberkahan dan kepercayaan nasabah..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 12px; font-style: italic; background: #fff;"><?php echo esc_textarea( $emp_quote ); ?></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top: 20px; text-align: center;">
                    <button type="button" id="btn-add-employee-bottom" class="button" style="padding: 8px 24px; font-weight: 700; border-radius: 6px; border: 2px dashed #94a3b8; width: 100%; max-width: 320px; background: #f8fafc;">
                        + Tambah Karyawan Baru
                    </button>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 3: HEADER & ANTI-FRAUD BANNER SETTINGS
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-shield" style="font-size: 18px; width: 18px; height: 18px;"></span> Pengaturan Header Halaman &amp; Pemberitahuan Verifikasi Anti-Fraud
                </h2>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Badge Header Atas</label>
                        <input type="text" name="options_tim_badge" value="<?php echo esc_attr( $header['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Judul Utama Halaman</label>
                        <input type="text" name="options_tim_title" value="<?php echo esc_attr( $header['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Deskripsi / Narasi Pengantar Tim</label>
                    <textarea name="options_tim_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 13px;"><?php echo esc_textarea( $header['desc'] ); ?></textarea>
                </div>

                <div style="margin-top: 20px; padding: 18px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px;">
                    <div style="font-weight: 700; color: #166534; font-size: 13px; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                        <span class="dashicons dashicons-lock" style="font-size: 16px; width: 16px; height: 16px;"></span> Kotak Informasi Keabsahan Personel (Anti-Fraud Notice)
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Badge Kotak Peringatan</label>
                            <input type="text" name="options_tim_notice_badge" value="<?php echo esc_attr( $header['notice_badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Nomor WhatsApp Hotline Verifikasi</label>
                            <input type="text" name="options_tim_notice_wa" value="<?php echo esc_attr( $header['notice_wa'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;" placeholder="Contoh: 6281517380388">
                        </div>
                    </div>
                    <div style="margin-top: 10px;">
                        <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Judul Kotak Peringatan</label>
                        <input type="text" name="options_tim_notice_title" value="<?php echo esc_attr( $header['notice_title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                    </div>
                    <div style="margin-top: 10px;">
                        <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Teks Penjelasan Keabsahan Karyawan</label>
                        <textarea name="options_tim_notice_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"><?php echo esc_textarea( $header['notice_desc'] ); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 4: PENGATURAN CALL TO ACTION (CTA) BAWAH HALAMAN
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 15px;">
                    <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <span class="dashicons dashicons-megaphone" style="font-size: 18px; width: 18px; height: 18px;"></span> Pengaturan Banner Call to Action (CTA) Bawah Halaman
                    </h2>
                    <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: #1e293b; cursor: pointer;">
                        <input type="checkbox" name="options_tim_cta_show" value="1" <?php checked( $cta['show'] ); ?>>
                        Tampilkan Banner CTA
                    </label>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 15px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Badge Atas CTA</label>
                        <input type="text" name="options_tim_cta_badge" value="<?php echo esc_attr( $cta['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;" placeholder="Peluang Karir Perbankan Syariah">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Judul Utama Banner CTA</label>
                        <input type="text" name="options_tim_cta_title" value="<?php echo esc_attr( $cta['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;" placeholder="Ingin Tumbuh & Berkarya Bersama Bank Syariah Wakalumi?">
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Deskripsi / Paragraf Ajakan</label>
                    <textarea name="options_tim_cta_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 13px;"><?php echo esc_textarea( $cta['desc'] ); ?></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px; padding: 18px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;">
                    <!-- Tombol Utama (Button 1) -->
                    <div>
                        <div style="font-weight: 700; color: #0f766e; font-size: 13px; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                            <span class="dashicons dashicons-button" style="font-size: 16px; width: 16px; height: 16px;"></span> Tombol Utama (Button 1 - Karir / Informasi)
                        </div>
                        <div style="margin-bottom: 10px;">
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Teks Tombol</label>
                            <input type="text" name="options_tim_cta_btn1_text" value="<?php echo esc_attr( $cta['btn1_text'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;" placeholder="Lihat Informasi Karir & Lowongan">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">URL / Link Tujuan</label>
                            <input type="text" name="options_tim_cta_btn1_url" value="<?php echo esc_attr( $cta['btn1_url'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;" placeholder="<?php echo esc_url( home_url( '/informasi/karir/' ) ); ?>">
                        </div>
                    </div>

                    <!-- Tombol Sekunder (Button 2) -->
                    <div>
                        <div style="font-weight: 700; color: #166534; font-size: 13px; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                            <span class="dashicons dashicons-format-chat" style="font-size: 16px; width: 16px; height: 16px;"></span> Tombol Sekunder (Button 2 - WhatsApp / Kontak)
                        </div>
                        <div style="margin-bottom: 10px;">
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Teks Tombol</label>
                            <input type="text" name="options_tim_cta_btn2_text" value="<?php echo esc_attr( $cta['btn2_text'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;" placeholder="Hubungi Sekretariat Bank">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">URL / Link WhatsApp Tujuan</label>
                            <input type="text" name="options_tim_cta_btn2_url" value="<?php echo esc_attr( $cta['btn2_url'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;" placeholder="https://wa.me/...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SAVE BUTTON STICKY FOOTER -->
            <div style="position: sticky; bottom: 15px; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 15px 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between; z-index: 50;">
                <div style="color: #64748b; font-size: 13px;">
                    Pastikan seluruh perubahan data dan ID Card telah terisi dengan benar sebelum menyimpan.
                </div>
                <button type="submit" class="button button-primary" style="background: #0f766e; border-color: #0d9488; font-weight: 800; font-size: 14px; padding: 6px 30px; border-radius: 6px;">
                    Simpan Seluruh Data Tim &amp; Karyawan
                </button>
            </div>

        </form>

    </div>

    <!-- INLINE JAVASCRIPT FOR MEDIA UPLOADER & REPEATER -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container   = document.getElementById('employee-list-container');
        const btnAddTop   = document.getElementById('btn-add-employee');
        const btnAddBottom= document.getElementById('btn-add-employee-bottom');
        const divContainer= document.getElementById('divisions-list-container');
        const btnAddDiv   = document.getElementById('btn-add-division');

        // Division Manager: Delete button
        if (divContainer) {
            divContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-del-div')) {
                    if (confirm('Hapus divisi ini?')) {
                        e.target.closest('.division-item-box').remove();
                    }
                }
            });
        }

        // Division Manager: Add Division
        if (btnAddDiv && divContainer) {
            btnAddDiv.addEventListener('click', function() {
                const count = divContainer.querySelectorAll('.division-item-box').length + 1;
                const newDivHtml = `
                    <div class="division-item-box" style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px 12px; display: flex; align-items: center; gap: 8px;">
                        <input type="text" name="div_slug[]" value="divisi_${count}" placeholder="slug" style="width: 80px; font-size: 11px; font-family: monospace; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px 6px; background: #fff;">
                        <input type="text" name="div_name[]" value="" placeholder="Nama Divisi Baru" style="flex: 1; min-width: 110px; font-size: 12px; font-weight: 600; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px 8px; background: #fff;" required>
                        <select name="div_color[]" style="font-size: 11px; font-weight: 600; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px 6px; background: #fff;" title="Aksen Warna Divisi">
                            <option value="emerald">Emerald (Hijau Syariah)</option>
                            <option value="indigo">Indigo (Ungu Wibawa)</option>
                            <option value="amber">Amber (Emas Eksekutif)</option>
                            <option value="purple">Purple (Ungu Spesialis)</option>
                            <option value="rose">Rose (Merah Muda Elegan)</option>
                            <option value="teal" selected>Teal (Toska Wakalumi)</option>
                            <option value="blue">Blue (Biru Korporat)</option>
                            <option value="orange">Orange (Jingga Dinamis)</option>
                            <option value="cyan">Cyan (Biru Digital)</option>
                            <option value="fuchsia">Fuchsia (Pink Human Capital)</option>
                            <option value="slate">Slate (Abu Metalik)</option>
                            <option value="lime">Lime (Hijau Daun Segar)</option>
                        </select>
                        <input type="number" name="div_urutan[]" value="${count}" style="width: 45px; font-size: 11px; text-align: center; border: 1px solid #cbd5e1; border-radius: 4px; padding: 4px 2px; background: #fff;">
                        <button type="button" class="button-link btn-del-div" style="color: #ef4444; font-size: 13px; text-decoration: none; padding: 2px;">✕</button>
                    </div>
                `;
                divContainer.insertAdjacentHTML('beforeend', newDivHtml);
            });
        }

        function bindEmployeeCard(card) {
            const btnUpload  = card.querySelector('.btn-upload-idcard');
            const btnRemove  = card.querySelector('.btn-remove-idcard');
            const inputImg   = card.querySelector('.emp-idcard-input');
            const imgPrev    = card.querySelector('.emp-preview-img');
            const btnDelete  = card.querySelector('.btn-delete-emp');
            const inputNama  = card.querySelector('.emp-nama-input');
            const nameDisp   = card.querySelector('.emp-name-display');
            const inputUrut  = card.querySelector('.emp-urutan-input');
            const orderDisp  = card.querySelector('.emp-order-display');
            const selectStat = card.querySelector('.emp-status-select');
            const statBadge  = card.querySelector('.emp-status-badge');
            const checkKadiv = card.querySelector('.emp-kadiv-check');
            const kadivBadge = card.querySelector('.emp-kadiv-badge');

            // Live Name Display
            if (inputNama && nameDisp) {
                inputNama.addEventListener('input', function() {
                    nameDisp.textContent = this.value.trim() || 'Karyawan Baru';
                });
            }

            // Live Order Display
            if (inputUrut && orderDisp) {
                inputUrut.addEventListener('input', function() {
                    orderDisp.textContent = this.value || '1';
                });
            }

            // Live Kadiv Toggle
            if (checkKadiv && kadivBadge) {
                checkKadiv.addEventListener('change', function() {
                    if (this.checked) {
                        kadivBadge.style.display = 'inline-block';
                        card.style.background = '#fffdf5';
                        card.style.borderColor = '#fcd34d';
                        card.style.borderLeftColor = '#f59e0b';
                    } else {
                        kadivBadge.style.display = 'none';
                        card.style.background = '#f8fafc';
                        card.style.borderColor = '#cbd5e1';
                        card.style.borderLeftColor = '#0f766e';
                    }
                });
            }

            // Live Status Badge
            if (selectStat && statBadge) {
                selectStat.addEventListener('change', function() {
                    if (this.value === 'aktif') {
                        statBadge.textContent = '● Karyawan Aktif';
                        statBadge.style.background = '#dcfce7';
                        statBadge.style.color = '#166534';
                    } else {
                        statBadge.textContent = '● Non-Aktif';
                        statBadge.style.background = '#fee2e2';
                        statBadge.style.color = '#991b1b';
                    }
                });
            }

            // Upload ID Card via WP Media
            if (btnUpload) {
                btnUpload.addEventListener('click', function(e) {
                    e.preventDefault();
                    let customUploader = wp.media({
                        title: 'Pilih / Unggah ID Card Karyawan (WebP / PNG / JPG — Rasio 1 : 1.56)',
                        button: { text: 'Gunakan ID Card Ini' },
                        multiple: false,
                        library: { type: 'image' }
                    });

                    customUploader.on('select', function() {
                        const attachment = customUploader.state().get('selection').first().toJSON();
                        inputImg.value = attachment.url;
                        imgPrev.src = attachment.url;
                        if (btnRemove) btnRemove.style.display = 'inline-block';
                    });

                    customUploader.open();
                });
            }

            // Remove ID Card Image
            if (btnRemove) {
                btnRemove.addEventListener('click', function(e) {
                    e.preventDefault();
                    inputImg.value = '';
                    imgPrev.src = '<?php echo wakalumi_generate_idcard_placeholder(); ?>';
                    this.style.display = 'none';
                });
            }

            // Delete Card
            if (btnDelete) {
                btnDelete.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin menghapus kartu karyawan ini?')) {
                        card.remove();
                    }
                });
            }
        }

        // Bind existing cards
        container.querySelectorAll('.employee-card-item').forEach(bindEmployeeCard);

        // Add New Card Function
        function addNewCard() {
            const count = container.querySelectorAll('.employee-card-item').length;
            const newIndex = count + 1;
            const newId = 'emp_' + Date.now();

            let divOptionsHtml = '';
            document.querySelectorAll('#divisions-list-container .division-item-box').forEach(function(box) {
                const s = box.querySelector('input[name="div_slug[]"]').value;
                const n = box.querySelector('input[name="div_name[]"]').value;
                if (s && n) {
                    divOptionsHtml += `<option value="${s}">${n}</option>`;
                }
            });
            if (!divOptionsHtml) {
                divOptionsHtml = `<option value="operasional">Operasional</option>`;
            }

            const cardHtml = `
                <div class="employee-card-item" data-index="${newIndex}" data-id="${newId}" style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 5px solid #0f766e; border-radius: 10px; padding: 18px; transition: all 0.2s;">
                    <input type="hidden" name="emp_id[]" value="${newId}">

                    <div style="display: grid; grid-template-columns: 140px 1fr; gap: 20px; align-items: start;">
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div style="width: 140px; aspect-ratio: 1 / 1.56; background: #042f2e; border: 2px dashed #94a3b8; border-radius: 10px; overflow: hidden; position: relative; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                <img class="emp-preview-img" src="<?php echo wakalumi_generate_idcard_placeholder(); ?>" alt="ID Card Preview" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                                <div style="position: absolute; bottom: 4px; left: 4px; right: 4px; background: rgba(0,0,0,0.7); backdrop-filter: blur(4px); color: #fff; font-size: 9px; text-align: center; border-radius: 4px; padding: 2px 4px; font-weight: 700;">
                                    1 : 1.56 RATIO
                                </div>
                            </div>
                            <button type="button" class="button button-small btn-upload-idcard" style="width: 100%; font-weight: 600; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 4px;">
                                <span class="dashicons dashicons-upload" style="font-size: 14px; width: 14px; height: 14px; line-height: 1;"></span> Unggah ID Card (WebP / PNG)
                            </button>
                            <button type="button" class="button-link btn-remove-idcard" style="color: #ef4444; font-size: 11px; text-decoration: none; display: none;">
                                ✕ Hapus Foto
                            </button>
                            <input type="hidden" name="emp_idcard_image[]" class="emp-idcard-input" value="">
                        </div>

                        <div>
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-weight: 800; font-size: 14px; color: #0f172a;">
                                        #<span class="emp-order-display">${newIndex}</span> — <span class="emp-name-display">Karyawan Baru</span>
                                    </span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span style="font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 999px; background: #dcfce7; color: #166534;" class="emp-status-badge">
                                        ● Karyawan Aktif
                                    </span>
                                    <button type="button" class="button button-link-delete btn-delete-emp" style="color: #ef4444; font-size: 12px; padding: 2px 6px;">
                                        Hapus
                                    </button>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 2fr 1.5fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Nama Lengkap Karyawan</label>
                                    <input type="text" name="emp_nama[]" value="" class="emp-nama-input" placeholder="Contoh: Nama Karyawan Baru" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; font-weight: 600; background: #fff;" required>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Nomor Induk Pegawai (NIP / NIK)</label>
                                    <input type="text" name="emp_nip[]" value="" placeholder="Contoh: 22601 atau -" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; font-family: monospace; background: #fff;">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1.5fr 1.5fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Divisi Bank</label>
                                    <select name="emp_divisi[]" class="emp-divisi-select" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                                        ${divOptionsHtml}
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Jabatan / Posisi Spesifik</label>
                                    <input type="text" name="emp_jabatan[]" value="" placeholder="Contoh: Account Officer" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1.2fr 1.3fr 0.8fr 1.2fr; gap: 12px; align-items: end;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Label Divisi Tampil (Opsional)</label>
                                    <input type="text" name="emp_divisi_label[]" value="" placeholder="Ikuti nama divisi default" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 12px; background: #fff;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #0f766e;">Tingkat Jabatan</label>
                                    <select name="emp_tingkat[]" class="emp-tingkat-select" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 12px; font-weight: 700; background: #fff;">
                                        <option value="staff">Staf Pelaksana</option>
                                        <option value="pe">Pejabat Eksekutif (PE)</option>
                                        <option value="eksekutif">Pengurus (DPS/Kom/Dir)</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Tag Singkat</label>
                                    <input type="text" name="emp_short_tag[]" value="" placeholder="DPS/KOM/DIR/PE" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 6px; font-size: 12px; font-weight: 800; background: #fff; text-transform: uppercase;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Status &amp; Urutan</label>
                                    <div style="display: flex; gap: 6px;">
                                        <select name="emp_status[]" class="emp-status-select" style="width: 60%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 4px; font-size: 12px; background: #fff;">
                                            <option value="aktif">Aktif</option>
                                            <option value="nonaktif">Non-Aktif</option>
                                        </select>
                                        <input type="number" name="emp_urutan[]" value="${newIndex}" min="1" class="emp-urutan-input" style="width: 40%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 4px; font-size: 12px; background: #fff;">
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 10px;">
                                <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                    Kutipan Motivasi / Komitmen Pelayanan <span style="font-weight: 400; color: #64748b;">(Tampil eksklusif di modal detail ID Card)</span>
                                </label>
                                <textarea name="emp_quote[]" rows="2" placeholder="Kutipan motivasi profesional atau komitmen amanah syariah karyawan..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 12px; font-style: italic; background: #fff;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = cardHtml.trim();
            const newCardEl = tempDiv.firstElementChild;
            container.appendChild(newCardEl);
            bindEmployeeCard(newCardEl);
            newCardEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        if (btnAddTop) btnAddTop.addEventListener('click', addNewCard);
        if (btnAddBottom) btnAddBottom.addEventListener('click', addNewCard);
    });
    </script>
    <?php
}
