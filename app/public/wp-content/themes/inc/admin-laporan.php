<?php
/**
 * Admin Page: Pengelolaan Laporan Publikasi & Regulasi OJK
 * Submenu of wakalumi-settings
 * 
 * Tersegmentasi menjadi 4 pilar laporan perbankan resmi:
 * 1. Laporan Keuangan Publikasi Triwulanan (5 Tahun Terakhir)
 * 2. Laporan Penerapan Tata Kelola Perusahaan (GCG)
 * 3. Laporan Tahunan Terpadu (Annual Report)
 * 4. Laporan Keuangan Berkelanjutan (LKB / RAKB)
 * 5. Pengaturan Banner, Regulasi & Tema Warna Per Jenis Laporan
 * 
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// ── 1. HELPER THEME COLOR SCHEMES & DATA RETRIEVAL ───────────────────

if ( ! function_exists( 'wakalumi_get_laporan_color_scheme' ) ) {
    /**
     * Mengembalikan preset token styling Tailwind berdasarkan slug warna.
     *
     * @param string $color
     * @return array
     */
    function wakalumi_get_laporan_color_scheme( $color = 'emerald' ) {
        $schemes = [
            'emerald' => [
                'name'         => 'emerald',
                'label'        => 'Hijau Zamrud (Syariah)',
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
            ],
            'teal' => [
                'name'         => 'teal',
                'label'        => 'Toska Wakalumi',
                'top_border'   => 'from-teal-500 via-cyan-400 to-teal-600',
                'hover_border' => 'hover:border-teal-400/90 dark:hover:border-teal-500/80',
                'hover_shadow' => 'hover:shadow-teal-500/20',
                'badge_style'  => 'bg-teal-50 dark:bg-teal-950/80 text-teal-700 dark:text-teal-300 border-teal-200/80 dark:border-teal-800/80',
                'icon_box'     => 'bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 border-teal-200/70 dark:border-teal-800/70',
                'title_hover'  => 'group-hover:text-teal-600 dark:group-hover:text-teal-400',
                'btn_action'   => 'bg-teal-600 hover:bg-teal-700 text-white shadow-teal-600/25',
                'btn_preview'  => 'hover:border-teal-400 hover:text-teal-600 dark:hover:text-teal-300',
                'tab_active'   => 'bg-gradient-to-r from-teal-600 to-cyan-600 text-white border-teal-500 shadow-md shadow-teal-600/25',
                'tab_inactive' => 'bg-teal-50/70 dark:bg-teal-950/30 text-teal-900 dark:text-teal-200 border-teal-200/70 dark:border-teal-900/50 hover:bg-teal-100/80',
            ],
            'blue' => [
                'name'         => 'blue',
                'label'        => 'Biru Finansial',
                'top_border'   => 'from-blue-500 via-indigo-400 to-cyan-500',
                'hover_border' => 'hover:border-blue-400/90 dark:hover:border-blue-500/80',
                'hover_shadow' => 'hover:shadow-blue-500/20',
                'badge_style'  => 'bg-blue-50 dark:bg-blue-950/80 text-blue-700 dark:text-blue-300 border-blue-200/80 dark:border-blue-800/80',
                'icon_box'     => 'bg-blue-50 dark:bg-blue-950/70 text-blue-600 dark:text-blue-400 border-blue-200/70 dark:border-blue-800/70',
                'title_hover'  => 'group-hover:text-blue-600 dark:group-hover:text-blue-400',
                'btn_action'   => 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-600/25',
                'btn_preview'  => 'hover:border-blue-400 hover:text-blue-600 dark:hover:text-blue-300',
                'tab_active'   => 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white border-blue-500 shadow-md shadow-blue-600/25',
                'tab_inactive' => 'bg-blue-50/70 dark:bg-blue-950/30 text-blue-900 dark:text-blue-200 border-blue-200/70 dark:border-blue-900/50 hover:bg-blue-100/80',
            ],
            'amber' => [
                'name'         => 'amber',
                'label'        => 'Emas / Prioritas',
                'top_border'   => 'from-amber-500 via-orange-400 to-amber-600',
                'hover_border' => 'hover:border-amber-400/90 dark:hover:border-amber-500/80',
                'hover_shadow' => 'hover:shadow-amber-500/20',
                'badge_style'  => 'bg-amber-50 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300 border-amber-200/80 dark:border-amber-800/80',
                'icon_box'     => 'bg-amber-50 dark:bg-amber-950/70 text-amber-600 dark:text-amber-400 border-amber-200/70 dark:border-amber-800/70',
                'title_hover'  => 'group-hover:text-amber-600 dark:group-hover:text-amber-400',
                'btn_action'   => 'bg-amber-600 hover:bg-amber-700 text-white shadow-amber-600/25',
                'btn_preview'  => 'hover:border-amber-400 hover:text-amber-600 dark:hover:text-amber-300',
                'tab_active'   => 'bg-gradient-to-r from-amber-500 to-orange-600 text-white border-amber-400 shadow-md shadow-amber-500/25',
                'tab_inactive' => 'bg-amber-50/70 dark:bg-amber-950/30 text-amber-900 dark:text-amber-200 border-amber-200/70 dark:border-amber-900/50 hover:bg-amber-100/80',
            ],
            'purple' => [
                'name'         => 'purple',
                'label'        => 'Ungu Eksklusif',
                'top_border'   => 'from-purple-500 via-fuchsia-400 to-indigo-600',
                'hover_border' => 'hover:border-purple-400/90 dark:hover:border-purple-500/80',
                'hover_shadow' => 'hover:shadow-purple-500/20',
                'badge_style'  => 'bg-purple-50 dark:bg-purple-950/80 text-purple-700 dark:text-purple-300 border-purple-200/80 dark:border-purple-800/80',
                'icon_box'     => 'bg-purple-50 dark:bg-purple-950/70 text-purple-600 dark:text-purple-400 border-purple-200/70 dark:border-purple-800/70',
                'title_hover'  => 'group-hover:text-purple-600 dark:group-hover:text-purple-400',
                'btn_action'   => 'bg-purple-600 hover:bg-purple-700 text-white shadow-purple-600/25',
                'btn_preview'  => 'hover:border-purple-400 hover:text-purple-600 dark:hover:text-purple-300',
                'tab_active'   => 'bg-gradient-to-r from-purple-600 to-fuchsia-600 text-white border-purple-500 shadow-md shadow-purple-600/25',
                'tab_inactive' => 'bg-purple-50/70 dark:bg-purple-950/30 text-purple-900 dark:text-purple-200 border-purple-200/70 dark:border-purple-900/50 hover:bg-purple-100/80',
            ],
            'rose' => [
                'name'         => 'rose',
                'label'        => 'Merah Marun (Official)',
                'top_border'   => 'from-rose-500 via-pink-400 to-red-600',
                'hover_border' => 'hover:border-rose-400/90 dark:hover:border-rose-500/80',
                'hover_shadow' => 'hover:shadow-rose-500/20',
                'badge_style'  => 'bg-rose-50 dark:bg-rose-950/80 text-rose-700 dark:text-rose-300 border-rose-200/80 dark:border-rose-800/80',
                'icon_box'     => 'bg-rose-50 dark:bg-rose-950/70 text-rose-600 dark:text-rose-400 border-rose-200/70 dark:border-rose-800/70',
                'title_hover'  => 'group-hover:text-rose-600 dark:group-hover:text-rose-400',
                'btn_action'   => 'bg-rose-600 hover:bg-rose-700 text-white shadow-rose-600/25',
                'btn_preview'  => 'hover:border-rose-400 hover:text-rose-600 dark:hover:text-rose-300',
                'tab_active'   => 'bg-gradient-to-r from-rose-600 to-pink-600 text-white border-rose-500 shadow-md shadow-rose-600/25',
                'tab_inactive' => 'bg-rose-50/70 dark:bg-rose-950/30 text-rose-900 dark:text-rose-200 border-rose-200/70 dark:border-rose-900/50 hover:bg-rose-100/80',
            ],
            'cyan' => [
                'name'         => 'cyan',
                'label'        => 'Biru Sian (Segar)',
                'top_border'   => 'from-cyan-500 via-sky-400 to-blue-500',
                'hover_border' => 'hover:border-cyan-400/90 dark:hover:border-cyan-500/80',
                'hover_shadow' => 'hover:shadow-cyan-500/20',
                'badge_style'  => 'bg-cyan-50 dark:bg-cyan-950/80 text-cyan-700 dark:text-cyan-300 border-cyan-200/80 dark:border-cyan-800/80',
                'icon_box'     => 'bg-cyan-50 dark:bg-cyan-950/70 text-cyan-600 dark:text-cyan-400 border-cyan-200/70 dark:border-cyan-800/70',
                'title_hover'  => 'group-hover:text-cyan-600 dark:group-hover:text-cyan-400',
                'btn_action'   => 'bg-cyan-600 hover:bg-cyan-700 text-white shadow-cyan-600/25',
                'btn_preview'  => 'hover:border-cyan-400 hover:text-cyan-600 dark:hover:text-cyan-300',
                'tab_active'   => 'bg-gradient-to-r from-cyan-600 to-blue-600 text-white border-cyan-500 shadow-md shadow-cyan-600/25',
                'tab_inactive' => 'bg-cyan-50/70 dark:bg-cyan-950/30 text-cyan-900 dark:text-cyan-200 border-cyan-200/70 dark:border-cyan-900/50 hover:bg-cyan-100/80',
            ],
            'orange' => [
                'name'         => 'orange',
                'label'        => 'Jingga Korporasi',
                'top_border'   => 'from-orange-500 via-amber-400 to-orange-600',
                'hover_border' => 'hover:border-orange-400/90 dark:hover:border-orange-500/80',
                'hover_shadow' => 'hover:shadow-orange-500/20',
                'badge_style'  => 'bg-orange-50 dark:bg-orange-950/80 text-orange-700 dark:text-orange-300 border-orange-200/80 dark:border-orange-800/80',
                'icon_box'     => 'bg-orange-50 dark:bg-orange-950/70 text-orange-600 dark:text-orange-400 border-orange-200/70 dark:border-orange-800/70',
                'title_hover'  => 'group-hover:text-orange-600 dark:group-hover:text-orange-400',
                'btn_action'   => 'bg-orange-600 hover:bg-orange-700 text-white shadow-orange-600/25',
                'btn_preview'  => 'hover:border-orange-400 hover:text-orange-600 dark:hover:text-orange-300',
                'tab_active'   => 'bg-gradient-to-r from-orange-600 to-amber-600 text-white border-orange-500 shadow-md shadow-orange-600/25',
                'tab_inactive' => 'bg-orange-50/70 dark:bg-orange-950/30 text-orange-900 dark:text-orange-200 border-orange-200/70 dark:border-orange-900/50 hover:bg-orange-100/80',
            ],
        ];

        return $schemes[ $color ] ?? $schemes['emerald'];
    }
}

if ( ! function_exists( 'wakalumi_get_laporan_category_color' ) ) {
    /**
     * Mengambil konfigurasi warna admin per jenis laporan.
     *
     * @param string $category
     * @return string
     */
    function wakalumi_get_laporan_category_color( $category ) {
        $defaults = [
            'triwulan'      => 'emerald',
            'gcg'           => 'blue',
            'tahunan'       => 'amber',
            'berkelanjutan' => 'teal',
            'lkb'           => 'teal',
            'lainnya'       => 'cyan',
        ];
        $cat_clean = ( $category === 'lkb' ) ? 'berkelanjutan' : $category;
        $val       = get_option( "options_laporan_color_{$cat_clean}", '' );
        return ! empty( $val ) ? $val : ( $defaults[ $cat_clean ] ?? 'emerald' );
    }
}

if ( ! function_exists( 'wakalumi_get_laporan_theme' ) ) {
    /**
     * Mengambil tema styling lengkap berdasarkan jenis laporan atau nama warna.
     *
     * @param string $category_or_color
     * @return array
     */
    function wakalumi_get_laporan_theme( $category_or_color ) {
        if ( in_array( $category_or_color, [ 'triwulan', 'gcg', 'tahunan', 'berkelanjutan', 'lkb', 'lainnya' ], true ) ) {
            $color = wakalumi_get_laporan_category_color( $category_or_color );
            return wakalumi_get_laporan_color_scheme( $color );
        }
        return wakalumi_get_laporan_color_scheme( $category_or_color );
    }
}

if ( ! function_exists( 'wakalumi_render_laporan_color_options' ) ) {
    /**
     * Helper merender opsi dropdown tema warna di form admin.
     *
     * @param string $current
     * @return string
     */
    function wakalumi_render_laporan_color_options( $current = 'emerald' ) {
        $colors = [
            'emerald' => '🟢 Hijau Zamrud (Karakter Syariah)',
            'teal'    => '🌊 Toska Wakalumi (Identitas Brand)',
            'blue'    => '🔷 Biru Finansial (Tata Kelola Perusahaan)',
            'amber'   => '👑 Emas / Prioritas (Laporan Tahunan / Prestisius)',
            'purple'  => '🟣 Ungu Eksklusif (Modern Elegan)',
            'rose'    => '🔴 Merah Marun (Regulasi Resmi OJK)',
            'cyan'    => '💎 Biru Sian (Segar & Dinamis)',
            'orange'  => '🟠 Jingga Korporasi (Hangat & Progresif)',
        ];
        $html = '';
        foreach ( $colors as $key => $label ) {
            $sel = selected( $current, $key, false );
            $html .= "<option value='{$key}' {$sel}>{$label}</option>";
        }
        return $html;
    }
}

if ( ! function_exists( 'wakalumi_get_laporan_header' ) ) {
    /**
     * Mengambil konfigurasi header banner halaman laporan.
     *
     * @return array
     */
    function wakalumi_get_laporan_header() {
        return [
            'badge'      => get_option( 'options_laporan_badge', 'Transparansi & Kepatuhan Regulasi' ),
            'title'      => get_option( 'options_laporan_title', 'Laporan Publikasi Keuangan & Tata Kelola' ),
            'subtitle'   => get_option( 'options_laporan_subtitle', 'Akses seluruh publikasi resmi transparansi keuangan triwulanan, laporan tata kelola perusahaan, dan laporan tahunan BPRS Wakalumi sesuai ketentuan regulasi Otoritas Jasa Keuangan (OJK).' ),
            'disclaimer' => get_option( 'options_laporan_disclaimer', 'Seluruh laporan keuangan dan tata kelola dipublikasikan secara resmi sebagai wujud kepatuhan terhadap POJK No. 37/POJK.03/2019 tentang Transparansi dan Publikasi Laporan Bank serta regulasi tata kelola BPR Syariah.' ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_laporan_triwulan_list' ) ) {
    /**
     * Mengambil daftar Laporan Publikasi Triwulanan (5 Tahun: 2026 s/d 2022).
     *
     * @return array
     */
    function wakalumi_get_laporan_triwulan_list() {
        $saved = get_option( 'options_laporan_triwulan', null );
        if ( is_array( $saved ) ) {
            return $saved;
        }

        // Default Starter Data 5 Tahun (2026 s/d 2022)
        return [
            // ── 2026 (Tahun Berjalan) ──
            [
                'id'            => 'rep-tw-2026-q2',
                'tahun'         => '2026',
                'periode'       => 'Triwulan II (Juni)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan II 2026',
                'file_url'      => '',
                'file_size'     => 'PDF • 2.1 MB',
                'tgl_publikasi' => '31 Juli 2026',
                'status_audit'  => 'Unaudited (Resmi OJK)',
                'keterangan'    => 'Publikasi kinerja keuangan semester I tahun buku 2026 per 30 Juni 2026.',
            ],
            [
                'id'            => 'rep-tw-2026-q1',
                'tahun'         => '2026',
                'periode'       => 'Triwulan I (Maret)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan I 2026',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.9 MB',
                'tgl_publikasi' => '30 April 2026',
                'status_audit'  => 'Unaudited (Resmi OJK)',
                'keterangan'    => 'Publikasi kinerja keuangan triwulan pertama per 31 Maret 2026.',
            ],

            // ── 2025 ──
            [
                'id'            => 'rep-tw-2025-q4',
                'tahun'         => '2025',
                'periode'       => 'Triwulan IV (Desember)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan IV 2025',
                'file_url'      => '',
                'file_size'     => 'PDF • 2.3 MB',
                'tgl_publikasi' => '31 Januari 2026',
                'status_audit'  => 'Audited (KAP Terdaftar OJK)',
                'keterangan'    => 'Laporan posisi keuangan akhir tahun dan kinerja laba rugi tahun buku 2025.',
            ],
            [
                'id'            => 'rep-tw-2025-q3',
                'tahun'         => '2025',
                'periode'       => 'Triwulan III (September)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan III 2025',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.8 MB',
                'tgl_publikasi' => '31 Oktober 2025',
                'status_audit'  => 'Unaudited (Resmi OJK)',
                'keterangan'    => 'Publikasi kinerja keuangan triwulan ketiga per 30 September 2025.',
            ],
            [
                'id'            => 'rep-tw-2025-q2',
                'tahun'         => '2025',
                'periode'       => 'Triwulan II (Juni)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan II 2025',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.7 MB',
                'tgl_publikasi' => '31 Juli 2025',
                'status_audit'  => 'Unaudited (Resmi OJK)',
                'keterangan'    => 'Publikasi kinerja semester I per 30 Juni 2025.',
            ],
            [
                'id'            => 'rep-tw-2025-q1',
                'tahun'         => '2025',
                'periode'       => 'Triwulan I (Maret)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan I 2025',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.6 MB',
                'tgl_publikasi' => '30 April 2025',
                'status_audit'  => 'Unaudited (Resmi OJK)',
                'keterangan'    => 'Publikasi triwulan pertama per 31 Maret 2025.',
            ],

            // ── 2024 ──
            [
                'id'            => 'rep-tw-2024-q4',
                'tahun'         => '2024',
                'periode'       => 'Triwulan IV (Desember)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan IV 2024',
                'file_url'      => '',
                'file_size'     => 'PDF • 2.1 MB',
                'tgl_publikasi' => '31 Januari 2025',
                'status_audit'  => 'Audited (KAP Terdaftar OJK)',
                'keterangan'    => 'Laporan posisi keuangan akhir tahun dan kinerja laba rugi tahun buku 2024.',
            ],
            [
                'id'            => 'rep-tw-2024-q3',
                'tahun'         => '2024',
                'periode'       => 'Triwulan III (September)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan III 2024',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.8 MB',
                'tgl_publikasi' => '31 Oktober 2024',
                'status_audit'  => 'Unaudited (Resmi OJK)',
                'keterangan'    => 'Publikasi kinerja keuangan triwulan ketiga per 30 September 2024.',
            ],
            [
                'id'            => 'rep-tw-2024-q2',
                'tahun'         => '2024',
                'periode'       => 'Triwulan II (Juni)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan II 2024',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.7 MB',
                'tgl_publikasi' => '31 Juli 2024',
                'status_audit'  => 'Unaudited (Resmi OJK)',
                'keterangan'    => 'Publikasi kinerja semester I per 30 Juni 2024.',
            ],
            [
                'id'            => 'rep-tw-2024-q1',
                'tahun'         => '2024',
                'periode'       => 'Triwulan I (Maret)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan I 2024',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.6 MB',
                'tgl_publikasi' => '30 April 2024',
                'status_audit'  => 'Unaudited (Resmi OJK)',
                'keterangan'    => 'Publikasi triwulan pertama per 31 Maret 2024.',
            ],

            // ── 2023 ──
            [
                'id'            => 'rep-tw-2023-q4',
                'tahun'         => '2023',
                'periode'       => 'Triwulan IV (Desember)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan IV 2023',
                'file_url'      => '',
                'file_size'     => 'PDF • 2.0 MB',
                'tgl_publikasi' => '31 Januari 2024',
                'status_audit'  => 'Audited (KAP Terdaftar OJK)',
                'keterangan'    => 'Laporan keuangan audit tahun buku 2023.',
            ],
            [
                'id'            => 'rep-tw-2023-q3',
                'tahun'         => '2023',
                'periode'       => 'Triwulan III (September)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan III 2023',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.7 MB',
                'tgl_publikasi' => '31 Oktober 2023',
                'status_audit'  => 'Unaudited (Resmi OJK)',
                'keterangan'    => 'Publikasi per 30 September 2023.',
            ],
            [
                'id'            => 'rep-tw-2023-q2',
                'tahun'         => '2023',
                'periode'       => 'Triwulan II (Juni)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan II 2023',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.6 MB',
                'tgl_publikasi' => '31 Juli 2023',
                'status_audit'  => 'Unaudited (Resmi OJK)',
                'keterangan'    => 'Publikasi semester I 2023.',
            ],
            [
                'id'            => 'rep-tw-2023-q1',
                'tahun'         => '2023',
                'periode'       => 'Triwulan I (Maret)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan I 2023',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.5 MB',
                'tgl_publikasi' => '30 April 2023',
                'status_audit'  => 'Unaudited (Resmi OJK)',
                'keterangan'    => 'Publikasi triwulan I 2023.',
            ],

            // ── 2022 ──
            [
                'id'            => 'rep-tw-2022-q4',
                'tahun'         => '2022',
                'periode'       => 'Triwulan IV (Desember)',
                'judul'         => 'Laporan Keuangan Publikasi Triwulan IV 2022',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.9 MB',
                'tgl_publikasi' => '31 Januari 2023',
                'status_audit'  => 'Audited (KAP Terdaftar OJK)',
                'keterangan'    => 'Laporan keuangan audit tahun buku 2022.',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_laporan_gcg_list' ) ) {
    /**
     * Mengambil daftar Laporan Tata Kelola Perusahaan (GCG).
     *
     * @return array
     */
    function wakalumi_get_laporan_gcg_list() {
        $saved = get_option( 'options_laporan_gcg', null );
        if ( is_array( $saved ) ) {
            return $saved;
        }

        return [
            [
                'id'            => 'rep-gcg-2026',
                'tahun'         => '2026',
                'periode'       => 'Semester I 2026',
                'judul'         => 'Laporan Penerapan Tata Kelola Perusahaan Semester I 2026',
                'file_url'      => '',
                'file_size'     => 'PDF • 3.0 MB',
                'tgl_publikasi' => '31 Juli 2026',
                'status_audit'  => 'Self Assessment Terdaftar OJK',
                'keterangan'    => 'Publikasi berkala implementasi tata kelola dan evaluasi organ kepatuhan per semester I 2026.',
            ],
            [
                'id'            => 'rep-gcg-2025',
                'tahun'         => '2025',
                'periode'       => 'Tahunan 2025',
                'judul'         => 'Laporan Penerapan Tata Kelola Perusahaan 2025',
                'file_url'      => '',
                'file_size'     => 'PDF • 3.2 MB',
                'tgl_publikasi' => '15 Mei 2026',
                'status_audit'  => 'Komposit Sangat Baik (Self Assessment OJK)',
                'keterangan'    => 'Laporan lengkap implementasi prinsip TARIF (Transparency, Accountability, Responsibility, Independency, Fairness) tahun 2025.',
            ],
            [
                'id'            => 'rep-gcg-2024',
                'tahun'         => '2024',
                'periode'       => 'Tahunan 2024',
                'judul'         => 'Laporan Penerapan Tata Kelola Perusahaan 2024',
                'file_url'      => '',
                'file_size'     => 'PDF • 3.1 MB',
                'tgl_publikasi' => '15 Mei 2025',
                'status_audit'  => 'Komposit Sangat Baik (Self Assessment OJK)',
                'keterangan'    => 'Laporan evaluasi struktur tata kelola, fungsi kepatuhan, audit internal, dan manajemen risiko tahun 2024.',
            ],
            [
                'id'            => 'rep-gcg-2023',
                'tahun'         => '2023',
                'periode'       => 'Tahunan 2023',
                'judul'         => 'Laporan Penerapan Tata Kelola Perusahaan 2023',
                'file_url'      => '',
                'file_size'     => 'PDF • 2.8 MB',
                'tgl_publikasi' => '15 Mei 2024',
                'status_audit'  => 'Self Assessment Terdaftar OJK',
                'keterangan'    => 'Penerapan tata kelola BPRS Wakalumi tahun buku 2023.',
            ],
            [
                'id'            => 'rep-gcg-2022',
                'tahun'         => '2022',
                'periode'       => 'Tahunan 2022',
                'judul'         => 'Laporan Penerapan Tata Kelola Perusahaan 2022',
                'file_url'      => '',
                'file_size'     => 'PDF • 2.5 MB',
                'tgl_publikasi' => '15 Mei 2023',
                'status_audit'  => 'Self Assessment Terdaftar OJK',
                'keterangan'    => 'Tata kelola BPRS Wakalumi tahun buku 2022.',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_laporan_tahunan_list' ) ) {
    /**
     * Mengambil daftar Laporan Tahunan (Annual Report).
     *
     * @return array
     */
    function wakalumi_get_laporan_tahunan_list() {
        $saved = get_option( 'options_laporan_tahunan', null );
        if ( is_array( $saved ) ) {
            return $saved;
        }

        return [
            [
                'id'            => 'rep-ar-2026',
                'tahun'         => '2026',
                'periode'       => 'Interim 2026',
                'judul'         => 'Laporan Kinerja Tahunan Terpadu 2026 (Semester I)',
                'file_url'      => '',
                'file_size'     => 'PDF • 4.9 MB',
                'tgl_publikasi' => '15 Agustus 2026',
                'status_audit'  => 'Publikasi Resmi Manajemen',
                'keterangan'    => 'Laporan perkembangan kinerja tahunan berjalan semester I tahun buku 2026.',
            ],
            [
                'id'            => 'rep-ar-2025',
                'tahun'         => '2025',
                'periode'       => 'Tahunan 2025',
                'judul'         => 'Laporan Tahunan Terpadu (Annual Report) 2025',
                'file_url'      => '',
                'file_size'     => 'PDF • 5.8 MB',
                'tgl_publikasi' => '25 Juni 2026',
                'status_audit'  => 'Audited & Disahkan RUPS',
                'keterangan'    => 'Buku laporan tahunan lengkap: laporan manajemen, profil korporasi, analisis keuangan terpadu, dan opini auditor independen tahun 2025.',
            ],
            [
                'id'            => 'rep-ar-2024',
                'tahun'         => '2024',
                'periode'       => 'Tahunan 2024',
                'judul'         => 'Laporan Tahunan Terpadu (Annual Report) 2024',
                'file_url'      => '',
                'file_size'     => 'PDF • 5.4 MB',
                'tgl_publikasi' => '25 Juni 2025',
                'status_audit'  => 'Audited & Disahkan RUPS',
                'keterangan'    => 'Laporan manajemen, analisa keuangan, profil tata kelola, dan kinerja tahun buku 2024.',
            ],
            [
                'id'            => 'rep-ar-2023',
                'tahun'         => '2023',
                'periode'       => 'Tahunan 2023',
                'judul'         => 'Laporan Tahunan Terpadu (Annual Report) 2023',
                'file_url'      => '',
                'file_size'     => 'PDF • 4.8 MB',
                'tgl_publikasi' => '20 Juni 2024',
                'status_audit'  => 'Audited & Disahkan RUPS',
                'keterangan'    => 'Laporan kinerja tahunan 2023.',
            ],
            [
                'id'            => 'rep-ar-2022',
                'tahun'         => '2022',
                'periode'       => 'Tahunan 2022',
                'judul'         => 'Laporan Tahunan Terpadu (Annual Report) 2022',
                'file_url'      => '',
                'file_size'     => 'PDF • 4.5 MB',
                'tgl_publikasi' => '20 Juni 2023',
                'status_audit'  => 'Audited & Disahkan RUPS',
                'keterangan'    => 'Kilas balik kinerja 2022.',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_laporan_berkelanjutan_list' ) ) {
    /**
     * Mengambil daftar Laporan Keuangan Berkelanjutan (LKB / RAKB).
     *
     * @return array
     */
    function wakalumi_get_laporan_berkelanjutan_list() {
        $saved = get_option( 'options_laporan_berkelanjutan', null );
        if ( is_array( $saved ) ) {
            return $saved;
        }

        return [
            [
                'id'            => 'rep-lkb-2026',
                'tahun'         => '2026',
                'periode'       => 'Tahunan 2026',
                'judul'         => 'Rencana Aksi Keuangan Berkelanjutan (RAKB) 2026',
                'file_url'      => '',
                'file_size'     => 'PDF • 2.6 MB',
                'tgl_publikasi' => '15 Januari 2026',
                'status_audit'  => 'Disahkan Direksi & Disampaikan OJK',
                'keterangan'    => 'Rencana strategis keuangan berkelanjutan, pembiayaan ramah lingkungan, dan tanggung jawab sosial syariah 2026.',
            ],
            [
                'id'            => 'rep-lkb-2025',
                'tahun'         => '2025',
                'periode'       => 'Tahunan 2025',
                'judul'         => 'Laporan Keuangan Berkelanjutan (LKB & RAKB) 2025',
                'file_url'      => '',
                'file_size'     => 'PDF • 2.4 MB',
                'tgl_publikasi' => '30 April 2026',
                'status_audit'  => 'Kepatuhan POJK Keuangan Berkelanjutan',
                'keterangan'    => 'Penyaluran pembiayaan ramah lingkungan, tanggung jawab sosial syariah (ZISWAF & CSR), serta efisiensi energi tahun 2025.',
            ],
            [
                'id'            => 'rep-lkb-2024',
                'tahun'         => '2024',
                'periode'       => 'Tahunan 2024',
                'judul'         => 'Laporan Keuangan Berkelanjutan (LKB & RAKB) 2024',
                'file_url'      => '',
                'file_size'     => 'PDF • 2.0 MB',
                'tgl_publikasi' => '30 April 2025',
                'status_audit'  => 'Kepatuhan POJK Keuangan Berkelanjutan',
                'keterangan'    => 'Realisasi program pembiayaan ramah lingkungan, tanggung jawab sosial, dan tata kelola hijau tahun 2024.',
            ],
            [
                'id'            => 'rep-lkb-2023',
                'tahun'         => '2023',
                'periode'       => 'Tahunan 2023',
                'judul'         => 'Laporan Keuangan Berkelanjutan (LKB & RAKB) 2023',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.9 MB',
                'tgl_publikasi' => '30 April 2024',
                'status_audit'  => 'Kepatuhan POJK Keuangan Berkelanjutan',
                'keterangan'    => 'Implementasi prinsip keuangan berkelanjutan BPRS Wakalumi tahun 2023.',
            ],
            [
                'id'            => 'rep-lkb-2022',
                'tahun'         => '2022',
                'periode'       => 'Tahunan 2022',
                'judul'         => 'Laporan Keuangan Berkelanjutan (LKB & RAKB) 2022',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.8 MB',
                'tgl_publikasi' => '30 April 2023',
                'status_audit'  => 'Kepatuhan POJK Keuangan Berkelanjutan',
                'keterangan'    => 'Penerapan prinsip keberlanjutan dan penyaluran dana sosial syariah tahun 2022.',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_laporan_lainnya_list' ) ) {
    /**
     * Mengambil daftar Laporan Lainnya (Dokumen Publikasi Khusus / Tambahan).
     *
     * @return array
     */
    function wakalumi_get_laporan_lainnya_list() {
        $saved = get_option( 'options_laporan_lainnya', null );
        if ( is_array( $saved ) ) {
            return $saved;
        }

        return [
            [
                'id'            => 'rep-lainnya-1',
                'tahun'         => '2025',
                'periode'       => 'Laporan Khusus',
                'judul'         => 'Laporan Khusus Evaluasi Layanan & Penanganan Pengaduan Konsumen',
                'file_url'      => '',
                'file_size'     => 'PDF • 1.8 MB',
                'tgl_publikasi' => '31 Desember 2025',
                'status_audit'  => 'Resmi OJK & Lembaga Pengawas',
                'keterangan'    => 'Ringkasan keterbukaan informasi penanganan pengaduan nasabah dan perlindungan konsumen perbankan syariah.',
            ],
            [
                'id'            => 'rep-lainnya-2',
                'tahun'         => '2024',
                'periode'       => 'Publikasi Khusus',
                'judul'         => 'Laporan Keterbukaan Informasi dan Edukasi Keuangan Syariah 2024',
                'file_url'      => '',
                'file_size'     => 'PDF • 2.2 MB',
                'tgl_publikasi' => '20 Desember 2024',
                'status_audit'  => 'Publikasi Resmi Direksi',
                'keterangan'    => 'Dokumentasi kegiatan literasi, inklusi keuangan, dan pemenuhan ketentuan kepatuhan perbankan syariah tahun 2024.',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_laporan_list' ) ) {
    /**
     * Menggabungkan seluruh segmen laporan untuk keperluan rendering frontend (page-laporan.php).
     *
     * @return array
     */
    function wakalumi_get_laporan_list() {
        $merged = [];

        // 1. Triwulanan
        $triwulan = wakalumi_get_laporan_triwulan_list();
        foreach ( $triwulan as $item ) {
            $item['kategori'] = 'triwulan';
            $merged[] = $item;
        }

        // 2. GCG
        $gcg = wakalumi_get_laporan_gcg_list();
        foreach ( $gcg as $item ) {
            $item['kategori'] = 'gcg';
            $merged[] = $item;
        }

        // 3. Tahunan
        $tahunan = wakalumi_get_laporan_tahunan_list();
        foreach ( $tahunan as $item ) {
            $item['kategori'] = 'tahunan';
            $merged[] = $item;
        }

        // 4. Keuangan Berkelanjutan
        $lkb = wakalumi_get_laporan_berkelanjutan_list();
        foreach ( $lkb as $item ) {
            $item['kategori'] = 'berkelanjutan';
            $merged[] = $item;
        }

        // 5. Laporan Lainnya
        $lainnya = wakalumi_get_laporan_lainnya_list();
        foreach ( $lainnya as $item ) {
            $item['kategori'] = 'lainnya';
            $merged[] = $item;
        }

        // Urutkan: Tahun DESC (terbaru ke terlama)
        usort( $merged, function( $a, $b ) {
            $yr_a = (int) ( $a['tahun'] ?? 0 );
            $yr_b = (int) ( $b['tahun'] ?? 0 );
            if ( $yr_a !== $yr_b ) {
                return $yr_b <=> $yr_a;
            }
            return strcmp( $a['judul'] ?? '', $b['judul'] ?? '' );
        } );

        return $merged;
    }
}

// ── 2. REGISTRASI MENU ADMIN ────────────────────────────────────────

add_action( 'admin_menu', 'wakalumi_register_laporan_page', 25 );
function wakalumi_register_laporan_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Laporan Publikasi & Regulasi OJK',
        'Laporan Publikasi & Tata Kelola',
        'manage_options',
        'wakalumi-laporan',
        'wakalumi_render_laporan_page'
    );
}

// ── 3. RENDER HALAMAN ADMIN TERSEGMENTASI ────────────────────────────

function wakalumi_render_laporan_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( esc_html__( 'Anda tidak memiliki izin untuk mengakses halaman ini.', 'wakalumi' ) );
    }

    wp_enqueue_media();

    $current_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'triwulan';
    $message     = '';

    // ─────────────────────────────────────────────────────────────────
    // PROSES SIMPAN FORM SESUAI SEGMEN AKTIF
    // ─────────────────────────────────────────────────────────────────
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['wakalumi_laporan_nonce'] ) ) {
        if ( ! wp_verify_nonce( $_POST['wakalumi_laporan_nonce'], 'wakalumi_laporan_save_action' ) ) {
            wp_die( esc_html__( 'Sesi keamanan telah berakhir. Silakan muat ulang halaman.', 'wakalumi' ) );
        }

        $active_tab = isset( $_POST['current_tab'] ) ? sanitize_key( $_POST['current_tab'] ) : 'triwulan';

        // ── SIMPAN TAB 1: TRIWULANAN ──
        if ( $active_tab === 'triwulan' ) {
            $color_val     = sanitize_text_field( $_POST['options_laporan_color_triwulan'] ?? 'emerald' );
            update_option( 'options_laporan_color_triwulan', $color_val );

            $tahuns        = wp_unslash( $_POST['tw_tahun'] ?? [] );
            $periodes      = wp_unslash( $_POST['tw_periode'] ?? [] );
            $juduls        = wp_unslash( $_POST['tw_judul'] ?? [] );
            $file_urls     = wp_unslash( $_POST['tw_file_url'] ?? [] );
            $file_sizes    = wp_unslash( $_POST['tw_file_size'] ?? [] );
            $tgl_pubs      = wp_unslash( $_POST['tw_tgl_publikasi'] ?? [] );
            $status_audits = wp_unslash( $_POST['tw_status_audit'] ?? [] );
            $keterangans   = wp_unslash( $_POST['tw_keterangan'] ?? [] );

            $list = [];
            for ( $i = 0; $i < count( $juduls ); $i++ ) {
                $judul = sanitize_text_field( $juduls[$i] ?? '' );
                if ( empty( $judul ) ) continue;

                $list[] = [
                    'id'            => 'rep-tw-' . ( $i + 1 ) . '-' . sanitize_title( $judul ),
                    'tahun'         => sanitize_text_field( $tahuns[$i] ?? '2026' ),
                    'periode'       => sanitize_text_field( $periodes[$i] ?? '' ),
                    'judul'         => $judul,
                    'file_url'      => esc_url_raw( trim( $file_urls[$i] ?? '' ) ),
                    'file_size'     => sanitize_text_field( $file_sizes[$i] ?? 'PDF • 2.0 MB' ),
                    'tgl_publikasi' => sanitize_text_field( $tgl_pubs[$i] ?? '' ),
                    'status_audit'  => sanitize_text_field( $status_audits[$i] ?? 'Unaudited (Resmi OJK)' ),
                    'keterangan'    => sanitize_textarea_field( $keterangans[$i] ?? '' ),
                ];
            }
            update_option( 'options_laporan_triwulan', $list );
            $message = '✅ Data Laporan Publikasi Triwulanan & Tema Warna berhasil disimpan ke database!';
        }

        // ── SIMPAN TAB 2: GCG ──
        elseif ( $active_tab === 'gcg' ) {
            $color_val     = sanitize_text_field( $_POST['options_laporan_color_gcg'] ?? 'blue' );
            update_option( 'options_laporan_color_gcg', $color_val );

            $tahuns        = wp_unslash( $_POST['gcg_tahun'] ?? [] );
            $periodes      = wp_unslash( $_POST['gcg_periode'] ?? [] );
            $juduls        = wp_unslash( $_POST['gcg_judul'] ?? [] );
            $file_urls     = wp_unslash( $_POST['gcg_file_url'] ?? [] );
            $file_sizes    = wp_unslash( $_POST['gcg_file_size'] ?? [] );
            $tgl_pubs      = wp_unslash( $_POST['gcg_tgl_publikasi'] ?? [] );
            $status_audits = wp_unslash( $_POST['gcg_status_audit'] ?? [] );
            $keterangans   = wp_unslash( $_POST['gcg_keterangan'] ?? [] );

            $list = [];
            for ( $i = 0; $i < count( $juduls ); $i++ ) {
                $judul = sanitize_text_field( $juduls[$i] ?? '' );
                if ( empty( $judul ) ) continue;

                $list[] = [
                    'id'            => 'rep-gcg-' . ( $i + 1 ) . '-' . sanitize_title( $judul ),
                    'tahun'         => sanitize_text_field( $tahuns[$i] ?? '2025' ),
                    'periode'       => sanitize_text_field( $periodes[$i] ?? 'Tahunan' ),
                    'judul'         => $judul,
                    'file_url'      => esc_url_raw( trim( $file_urls[$i] ?? '' ) ),
                    'file_size'     => sanitize_text_field( $file_sizes[$i] ?? 'PDF • 3.0 MB' ),
                    'tgl_publikasi' => sanitize_text_field( $tgl_pubs[$i] ?? '' ),
                    'status_audit'  => sanitize_text_field( $status_audits[$i] ?? 'Self Assessment Terdaftar OJK' ),
                    'keterangan'    => sanitize_textarea_field( $keterangans[$i] ?? '' ),
                ];
            }
            update_option( 'options_laporan_gcg', $list );
            $message = '✅ Data Laporan Tata Kelola Perusahaan & Tema Warna berhasil disimpan ke database!';
        }

        // ── SIMPAN TAB 3: TAHUNAN ──
        elseif ( $active_tab === 'tahunan' ) {
            $color_val     = sanitize_text_field( $_POST['options_laporan_color_tahunan'] ?? 'amber' );
            update_option( 'options_laporan_color_tahunan', $color_val );

            $tahuns        = wp_unslash( $_POST['ar_tahun'] ?? [] );
            $periodes      = wp_unslash( $_POST['ar_periode'] ?? [] );
            $juduls        = wp_unslash( $_POST['ar_judul'] ?? [] );
            $file_urls     = wp_unslash( $_POST['ar_file_url'] ?? [] );
            $file_sizes    = wp_unslash( $_POST['ar_file_size'] ?? [] );
            $tgl_pubs      = wp_unslash( $_POST['ar_tgl_publikasi'] ?? [] );
            $status_audits = wp_unslash( $_POST['ar_status_audit'] ?? [] );
            $keterangans   = wp_unslash( $_POST['ar_keterangan'] ?? [] );

            $list = [];
            for ( $i = 0; $i < count( $juduls ); $i++ ) {
                $judul = sanitize_text_field( $juduls[$i] ?? '' );
                if ( empty( $judul ) ) continue;

                $list[] = [
                    'id'            => 'rep-ar-' . ( $i + 1 ) . '-' . sanitize_title( $judul ),
                    'tahun'         => sanitize_text_field( $tahuns[$i] ?? '2025' ),
                    'periode'       => sanitize_text_field( $periodes[$i] ?? 'Tahunan' ),
                    'judul'         => $judul,
                    'file_url'      => esc_url_raw( trim( $file_urls[$i] ?? '' ) ),
                    'file_size'     => sanitize_text_field( $file_sizes[$i] ?? 'PDF • 5.0 MB' ),
                    'tgl_publikasi' => sanitize_text_field( $tgl_pubs[$i] ?? '' ),
                    'status_audit'  => sanitize_text_field( $status_audits[$i] ?? 'Audited & Disahkan RUPS' ),
                    'keterangan'    => sanitize_textarea_field( $keterangans[$i] ?? '' ),
                ];
            }
            update_option( 'options_laporan_tahunan', $list );
            $message = '✅ Data Laporan Tahunan (Annual Report) & Tema Warna berhasil disimpan ke database!';
        }

        // ── SIMPAN TAB 4: BERKELANJUTAN (LKB) ──
        elseif ( $active_tab === 'berkelanjutan' ) {
            $color_val     = sanitize_text_field( $_POST['options_laporan_color_berkelanjutan'] ?? 'teal' );
            update_option( 'options_laporan_color_berkelanjutan', $color_val );

            $tahuns        = wp_unslash( $_POST['lkb_tahun'] ?? [] );
            $periodes      = wp_unslash( $_POST['lkb_periode'] ?? [] );
            $juduls        = wp_unslash( $_POST['lkb_judul'] ?? [] );
            $file_urls     = wp_unslash( $_POST['lkb_file_url'] ?? [] );
            $file_sizes    = wp_unslash( $_POST['lkb_file_size'] ?? [] );
            $tgl_pubs      = wp_unslash( $_POST['lkb_tgl_publikasi'] ?? [] );
            $status_audits = wp_unslash( $_POST['lkb_status_audit'] ?? [] );
            $keterangans   = wp_unslash( $_POST['lkb_keterangan'] ?? [] );

            $list = [];
            for ( $i = 0; $i < count( $juduls ); $i++ ) {
                $judul = sanitize_text_field( $juduls[$i] ?? '' );
                if ( empty( $judul ) ) continue;

                $list[] = [
                    'id'            => 'rep-lkb-' . ( $i + 1 ) . '-' . sanitize_title( $judul ),
                    'tahun'         => sanitize_text_field( $tahuns[$i] ?? '2025' ),
                    'periode'       => sanitize_text_field( $periodes[$i] ?? 'Tahunan' ),
                    'judul'         => $judul,
                    'file_url'      => esc_url_raw( trim( $file_urls[$i] ?? '' ) ),
                    'file_size'     => sanitize_text_field( $file_sizes[$i] ?? 'PDF • 2.0 MB' ),
                    'tgl_publikasi' => sanitize_text_field( $tgl_pubs[$i] ?? '' ),
                    'status_audit'  => sanitize_text_field( $status_audits[$i] ?? 'Kepatuhan POJK Keuangan Berkelanjutan' ),
                    'keterangan'    => sanitize_textarea_field( $keterangans[$i] ?? '' ),
                ];
            }
            update_option( 'options_laporan_berkelanjutan', $list );
            $message = '✅ Data Laporan Keuangan Berkelanjutan (LKB) & Tema Warna berhasil disimpan ke database!';
        }

        // ── SIMPAN TAB 5: LAPORAN LAINNYA ──
        elseif ( $active_tab === 'lainnya' ) {
            $color_val     = sanitize_text_field( $_POST['options_laporan_color_lainnya'] ?? 'cyan' );
            update_option( 'options_laporan_color_lainnya', $color_val );

            $tahuns        = wp_unslash( $_POST['lainnya_tahun'] ?? [] );
            $periodes      = wp_unslash( $_POST['lainnya_periode'] ?? [] );
            $juduls        = wp_unslash( $_POST['lainnya_judul'] ?? [] );
            $file_urls     = wp_unslash( $_POST['lainnya_file_url'] ?? [] );
            $file_sizes    = wp_unslash( $_POST['lainnya_file_size'] ?? [] );
            $tgl_pubs      = wp_unslash( $_POST['lainnya_tgl_publikasi'] ?? [] );
            $status_audits = wp_unslash( $_POST['lainnya_status_audit'] ?? [] );
            $keterangans   = wp_unslash( $_POST['lainnya_keterangan'] ?? [] );

            $list = [];
            for ( $i = 0; $i < count( $juduls ); $i++ ) {
                $judul = sanitize_text_field( $juduls[$i] ?? '' );
                if ( empty( $judul ) ) continue;

                $list[] = [
                    'id'            => 'rep-lainnya-' . ( $i + 1 ) . '-' . sanitize_title( $judul ),
                    'tahun'         => sanitize_text_field( $tahuns[$i] ?? '2025' ),
                    'periode'       => sanitize_text_field( $periodes[$i] ?? 'Laporan Khusus' ),
                    'judul'         => $judul,
                    'file_url'      => esc_url_raw( trim( $file_urls[$i] ?? '' ) ),
                    'file_size'     => sanitize_text_field( $file_sizes[$i] ?? 'PDF • 2.0 MB' ),
                    'tgl_publikasi' => sanitize_text_field( $tgl_pubs[$i] ?? '' ),
                    'status_audit'  => sanitize_text_field( $status_audits[$i] ?? 'Resmi OJK & Lembaga Pengawas' ),
                    'keterangan'    => sanitize_textarea_field( $keterangans[$i] ?? '' ),
                ];
            }
            update_option( 'options_laporan_lainnya', $list );
            $message = '✅ Data Laporan Lainnya (Publikasi Khusus) & Tema Warna berhasil disimpan ke database!';
        }

        // ── SIMPAN TAB 6: BANNER & REGULASI ──
        elseif ( $active_tab === 'banner' ) {
            update_option( 'options_laporan_badge', sanitize_text_field( wp_unslash( $_POST['options_laporan_badge'] ?? 'Transparansi & Kepatuhan Regulasi' ) ) );
            update_option( 'options_laporan_title', sanitize_text_field( wp_unslash( $_POST['options_laporan_title'] ?? 'Laporan Publikasi Keuangan & Tata Kelola' ) ) );
            update_option( 'options_laporan_subtitle', sanitize_textarea_field( wp_unslash( $_POST['options_laporan_subtitle'] ?? '' ) ) );
            update_option( 'options_laporan_disclaimer', sanitize_textarea_field( wp_unslash( $_POST['options_laporan_disclaimer'] ?? '' ) ) );

            // Simpan tema warna global juga dari tab banner jika disubmit
            if ( isset( $_POST['options_laporan_color_triwulan'] ) ) {
                update_option( 'options_laporan_color_triwulan', sanitize_text_field( $_POST['options_laporan_color_triwulan'] ) );
            }
            if ( isset( $_POST['options_laporan_color_gcg'] ) ) {
                update_option( 'options_laporan_color_gcg', sanitize_text_field( $_POST['options_laporan_color_gcg'] ) );
            }
            if ( isset( $_POST['options_laporan_color_tahunan'] ) ) {
                update_option( 'options_laporan_color_tahunan', sanitize_text_field( $_POST['options_laporan_color_tahunan'] ) );
            }
            if ( isset( $_POST['options_laporan_color_berkelanjutan'] ) ) {
                update_option( 'options_laporan_color_berkelanjutan', sanitize_text_field( $_POST['options_laporan_color_berkelanjutan'] ) );
            }
            if ( isset( $_POST['options_laporan_color_lainnya'] ) ) {
                update_option( 'options_laporan_color_lainnya', sanitize_text_field( $_POST['options_laporan_color_lainnya'] ) );
            }

            $message = '✅ Pengaturan Banner Header, Teks Regulasi & Tema Warna berhasil disimpan!';
        }

        $current_tab = $active_tab;
    }

    // Ambil Data Saat Ini
    $triwulan_list      = wakalumi_get_laporan_triwulan_list();
    $gcg_list           = wakalumi_get_laporan_gcg_list();
    $tahunan_list       = wakalumi_get_laporan_tahunan_list();
    $berkelanjutan_list = wakalumi_get_laporan_berkelanjutan_list();
    $lainnya_list       = wakalumi_get_laporan_lainnya_list();
    $header_cfg         = wakalumi_get_laporan_header();

    // Ambil Pengaturan Warna Saat Ini
    $color_tw      = wakalumi_get_laporan_category_color( 'triwulan' );
    $color_gcg     = wakalumi_get_laporan_category_color( 'gcg' );
    $color_ar      = wakalumi_get_laporan_category_color( 'tahunan' );
    $color_lkb     = wakalumi_get_laporan_category_color( 'berkelanjutan' );
    $color_lainnya = wakalumi_get_laporan_category_color( 'lainnya' );
    ?>

    <div class="wrap" style="max-width: 1080px; margin-top: 20px;">
        <!-- Header Panel -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span>📊</span> Pengelolaan Laporan Publikasi &amp; Tata Kelola Perusahaan
                </h1>
                <p style="color: #64748b; margin: 5px 0 0 0; font-size: 13px;">
                    Kelola arsip dokumen resmi perbankan syariah terbagi rapi per segmen laporan: Publikasi Triwulanan (5 tahun), Tata Kelola, Laporan Tahunan, Keuangan Berkelanjutan, dan Laporan Lainnya.
                </p>
            </div>
            <div>
                <a href="<?php echo esc_url( home_url( '/informasi/laporan-publikasi/' ) ); ?>" target="_blank" class="button" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600;">
                    <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px; margin-top: 2px;"></span> Lihat Halaman Live
                </a>
            </div>
        </div>

        <?php if ( $message ) : ?>
            <div class="notice notice-success is-dismissible" style="border-left-color: #088395; padding: 12px 16px; margin: 0 0 20px 0;">
                <p style="font-size: 13px; font-weight: 600; margin: 0;"><?php echo esc_html( $message ); ?></p>
            </div>
        <?php endif; ?>

        <!-- Segmented Navigation Tabs -->
        <nav class="nav-tab-wrapper" style="margin-bottom: 20px; border-bottom: 2px solid #088395;">
            <a href="?page=wakalumi-laporan&tab=triwulan" class="nav-tab <?php echo $current_tab === 'triwulan' ? 'nav-tab-active' : ''; ?>" style="<?php echo $current_tab === 'triwulan' ? 'background: #088395; color: #fff; border-color: #088395; font-weight: bold;' : ''; ?>">
                📊 1. Publikasi Triwulanan (<?php echo count( $triwulan_list ); ?>)
            </a>
            <a href="?page=wakalumi-laporan&tab=gcg" class="nav-tab <?php echo $current_tab === 'gcg' ? 'nav-tab-active' : ''; ?>" style="<?php echo $current_tab === 'gcg' ? 'background: #088395; color: #fff; border-color: #088395; font-weight: bold;' : ''; ?>">
                🏛️ 2. Tata Kelola Perusahaan (<?php echo count( $gcg_list ); ?>)
            </a>
            <a href="?page=wakalumi-laporan&tab=tahunan" class="nav-tab <?php echo $current_tab === 'tahunan' ? 'nav-tab-active' : ''; ?>" style="<?php echo $current_tab === 'tahunan' ? 'background: #088395; color: #fff; border-color: #088395; font-weight: bold;' : ''; ?>">
                📘 3. Laporan Tahunan (<?php echo count( $tahunan_list ); ?>)
            </a>
            <a href="?page=wakalumi-laporan&tab=berkelanjutan" class="nav-tab <?php echo $current_tab === 'berkelanjutan' ? 'nav-tab-active' : ''; ?>" style="<?php echo $current_tab === 'berkelanjutan' ? 'background: #088395; color: #fff; border-color: #088395; font-weight: bold;' : ''; ?>">
                🌿 4. Keuangan Berkelanjutan (<?php echo count( $berkelanjutan_list ); ?>)
            </a>
            <a href="?page=wakalumi-laporan&tab=lainnya" class="nav-tab <?php echo $current_tab === 'lainnya' ? 'nav-tab-active' : ''; ?>" style="<?php echo $current_tab === 'lainnya' ? 'background: #088395; color: #fff; border-color: #088395; font-weight: bold;' : ''; ?>">
                📂 5. Laporan Lainnya (<?php echo count( $lainnya_list ); ?>)
            </a>
            <a href="?page=wakalumi-laporan&tab=banner" class="nav-tab <?php echo $current_tab === 'banner' ? 'nav-tab-active' : ''; ?>" style="<?php echo $current_tab === 'banner' ? 'background: #088395; color: #fff; border-color: #088395; font-weight: bold;' : ''; ?>">
                ⚙️ 6. Banner &amp; Regulasi
            </a>
        </nav>

        <!-- ===============================================================
             TAB 1: PUBLIKASI TRIWULANAN (TW I s/d TW IV - 5 TAHUN)
             =============================================================== -->
        <?php if ( $current_tab === 'triwulan' ) : ?>
            <form method="post" action="?page=wakalumi-laporan&tab=triwulan">
                <?php wp_nonce_field( 'wakalumi_laporan_save_action', 'wakalumi_laporan_nonce' ); ?>
                <input type="hidden" name="current_tab" value="triwulan">

                <!-- Quick Help & Color Config Bar -->
                <div style="background: #f0fdfa; border: 1px solid #ccfbf1; border-radius: 10px; padding: 16px 20px; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
                        <div style="display: flex; align-items: flex-start; gap: 12px; max-width: 650px;">
                            <span style="font-size: 20px; line-height: 1;">💡</span>
                            <div style="font-size: 13px; color: #0f766e; line-height: 1.5;">
                                <strong>Segmen Publikasi Triwulanan (POJK No. 37/2019):</strong><br>
                                Kelola publikasi berkala kuartal (TW I, TW II, TW III, TW IV) selama 5 tahun terakhir (2026 s/d 2022).
                            </div>
                        </div>
                        <div style="background: #fff; border: 1px solid #99f6e4; border-radius: 8px; padding: 10px 14px; display: flex; align-items: center; gap: 10px;">
                            <label style="font-size: 12px; font-weight: 700; color: #0f766e;">🎨 Tema Warna Kartu:</label>
                            <select name="options_laporan_color_triwulan" style="border-radius: 6px; padding: 4px 8px; border: 1px solid #0d9488; font-weight: 600; font-size: 12px;">
                                <?php echo wakalumi_render_laporan_color_options( $color_tw ); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="wkl-tw-container" style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 24px;">
                    <?php foreach ( $triwulan_list as $idx => $item ) : 
                        $tahun        = $item['tahun'] ?? '2026';
                        $periode      = $item['periode'] ?? 'Triwulan I (Maret)';
                        $judul        = $item['judul'] ?? '';
                        $file_url     = $item['file_url'] ?? '';
                        $file_size    = $item['file_size'] ?? 'PDF • 2.0 MB';
                        $tgl_pub      = $item['tgl_publikasi'] ?? '';
                        $status_audit = $item['status_audit'] ?? 'Unaudited (Resmi OJK)';
                        $keterangan   = $item['keterangan'] ?? '';
                    ?>
                        <div class="wkl-laporan-card" style="background: #fff; border: 1px solid #cbd5e1; border-left: 4px solid #0d9488; border-radius: 10px; padding: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span style="background: #0d9488; color: white; border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: 800;">
                                        #<?php echo $idx + 1; ?>
                                    </span>
                                    <span style="font-size: 14px; font-weight: 700; color: #1e293b;">
                                        <?php echo esc_html( $judul ?: 'Laporan Triwulanan Baru' ); ?>
                                    </span>
                                </div>
                                <button type="button" class="button button-link-delete wkl-remove-card-btn" style="color: #ef4444; font-size: 12px; font-weight: 600;">
                                    ✕ Hapus Dokumen
                                </button>
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tahun Laporan</label>
                                    <input type="number" name="tw_tahun[]" value="<?php echo esc_attr( $tahun ); ?>" min="2000" max="2099" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Periode Triwulan</label>
                                    <select name="tw_periode[]" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                        <option value="Triwulan I (Maret)" <?php selected( $periode, 'Triwulan I (Maret)' ); ?>>Triwulan I (Maret)</option>
                                        <option value="Triwulan II (Juni)" <?php selected( $periode, 'Triwulan II (Juni)' ); ?>>Triwulan II (Juni)</option>
                                        <option value="Triwulan III (September)" <?php selected( $periode, 'Triwulan III (September)' ); ?>>Triwulan III (September)</option>
                                        <option value="Triwulan IV (Desember)" <?php selected( $periode, 'Triwulan IV (Desember)' ); ?>>Triwulan IV (Desember)</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tanggal Rilis Publikasi</label>
                                    <input type="text" name="tw_tgl_publikasi[]" value="<?php echo esc_attr( $tgl_pub ); ?>" placeholder="Contoh: 31 Juli 2026" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Status Audit</label>
                                    <select name="tw_status_audit[]" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                        <option value="Unaudited (Resmi OJK)" <?php selected( $status_audit, 'Unaudited (Resmi OJK)' ); ?>>Unaudited (Resmi OJK)</option>
                                        <option value="Audited (KAP Terdaftar OJK)" <?php selected( $status_audit, 'Audited (KAP Terdaftar OJK)' ); ?>>Audited (KAP Terdaftar OJK)</option>
                                    </select>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Judul Lengkap Dokumen</label>
                                    <input type="text" name="tw_judul[]" value="<?php echo esc_attr( $judul ); ?>" placeholder="Contoh: Laporan Keuangan Publikasi Triwulan II 2026" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Ukuran File PDF</label>
                                    <input type="text" name="tw_file_size[]" value="<?php echo esc_attr( $file_size ); ?>" placeholder="Contoh: PDF • 2.1 MB" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">File Dokumen PDF</label>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <input type="text" name="tw_file_url[]" value="<?php echo esc_attr( $file_url ); ?>" placeholder="https://.../laporan-triwulan.pdf" class="wkl-pdf-url" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                    <button type="button" class="button wkl-upload-pdf-btn" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                                        <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah PDF
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Keterangan / Ringkasan Kinerja</label>
                                <textarea name="tw_keterangan[]" rows="2" placeholder="Ringkasan posisi aset, laba/rugi, atau keterangan publikasi..." style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"><?php echo esc_textarea( $keterangan ); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; border-top: 1px solid #cbd5e1; padding-top: 18px;">
                    <button type="button" id="wkl-add-tw-btn" class="button" style="border-radius: 8px; padding: 6px 16px; font-weight: bold; border-color: #0d9488; color: #0d9488;">
                        + Tambah Laporan Triwulan Baru
                    </button>
                    <button type="submit" class="button button-primary" style="background: #088395; border-color: #088395; font-weight: bold; padding: 6px 24px; border-radius: 8px;">
                        💾 Simpan Publikasi Triwulanan
                    </button>
                </div>
            </form>
        <?php endif; ?>

        <!-- ===============================================================
             TAB 2: TATA KELOLA PERUSAHAAN (GCG)
             =============================================================== -->
        <?php if ( $current_tab === 'gcg' ) : ?>
            <form method="post" action="?page=wakalumi-laporan&tab=gcg">
                <?php wp_nonce_field( 'wakalumi_laporan_save_action', 'wakalumi_laporan_nonce' ); ?>
                <input type="hidden" name="current_tab" value="gcg">

                <!-- Quick Help & Color Config Bar -->
                <div style="background: #eff6ff; border: 1px solid #dbeafe; border-radius: 10px; padding: 16px 20px; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
                        <div style="display: flex; align-items: flex-start; gap: 12px; max-width: 650px;">
                            <span style="font-size: 20px; line-height: 1;">🏛️</span>
                            <div style="font-size: 13px; color: #1e40af; line-height: 1.5;">
                                <strong>Segmen Laporan Penerapan Tata Kelola Perusahaan:</strong><br>
                                Unggah laporan evaluasi pelaksanaan prinsip tata kelola tahunan, penilaian self-assessment, dan kepatuhan DPS / OJK.
                            </div>
                        </div>
                        <div style="background: #fff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 10px 14px; display: flex; align-items: center; gap: 10px;">
                            <label style="font-size: 12px; font-weight: 700; color: #1e40af;">🎨 Tema Warna Kartu:</label>
                            <select name="options_laporan_color_gcg" style="border-radius: 6px; padding: 4px 8px; border: 1px solid #2563eb; font-weight: 600; font-size: 12px;">
                                <?php echo wakalumi_render_laporan_color_options( $color_gcg ); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="wkl-gcg-container" style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 24px;">
                    <?php foreach ( $gcg_list as $idx => $item ) : 
                        $tahun        = $item['tahun'] ?? '2025';
                        $periode      = $item['periode'] ?? 'Tahunan 2025';
                        $judul        = $item['judul'] ?? '';
                        $file_url     = $item['file_url'] ?? '';
                        $file_size    = $item['file_size'] ?? 'PDF • 3.0 MB';
                        $tgl_pub      = $item['tgl_publikasi'] ?? '';
                        $status_audit = $item['status_audit'] ?? 'Komposit Sangat Baik (Self Assessment OJK)';
                        $keterangan   = $item['keterangan'] ?? '';
                    ?>
                        <div class="wkl-laporan-card" style="background: #fff; border: 1px solid #cbd5e1; border-left: 4px solid #2563eb; border-radius: 10px; padding: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span style="background: #2563eb; color: white; border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: 800;">
                                        #<?php echo $idx + 1; ?>
                                    </span>
                                    <span style="font-size: 14px; font-weight: 700; color: #1e293b;">
                                        <?php echo esc_html( $judul ?: 'Laporan Tata Kelola Baru' ); ?>
                                    </span>
                                </div>
                                <button type="button" class="button button-link-delete wkl-remove-card-btn" style="color: #ef4444; font-size: 12px; font-weight: 600;">
                                    ✕ Hapus Dokumen
                                </button>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tahun Buku</label>
                                    <input type="number" name="gcg_tahun[]" value="<?php echo esc_attr( $tahun ); ?>" min="2000" max="2099" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Label Periode</label>
                                    <input type="text" name="gcg_periode[]" value="<?php echo esc_attr( $periode ); ?>" placeholder="Contoh: Tahunan 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tanggal Rilis Publikasi</label>
                                    <input type="text" name="gcg_tgl_publikasi[]" value="<?php echo esc_attr( $tgl_pub ); ?>" placeholder="Contoh: 15 Mei 2026" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Judul Lengkap Dokumen Tata Kelola</label>
                                    <input type="text" name="gcg_judul[]" value="<?php echo esc_attr( $judul ); ?>" placeholder="Contoh: Laporan Penerapan Tata Kelola Perusahaan 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Hasil Self Assessment / Status</label>
                                    <input type="text" name="gcg_status_audit[]" value="<?php echo esc_attr( $status_audit ); ?>" placeholder="Contoh: Komposit Sangat Baik" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Ukuran File PDF</label>
                                    <input type="text" name="gcg_file_size[]" value="<?php echo esc_attr( $file_size ); ?>" placeholder="Contoh: PDF • 3.2 MB" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">File Dokumen PDF</label>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <input type="text" name="gcg_file_url[]" value="<?php echo esc_attr( $file_url ); ?>" placeholder="https://.../laporan-tata-kelola.pdf" class="wkl-pdf-url" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                    <button type="button" class="button wkl-upload-pdf-btn" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                                        <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah PDF
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Keterangan / Ringkasan Tata Kelola</label>
                                <textarea name="gcg_keterangan[]" rows="2" placeholder="Uraian komitmen transparansi, penilaian organ bank, dsb..." style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"><?php echo esc_textarea( $keterangan ); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; border-top: 1px solid #cbd5e1; padding-top: 18px;">
                    <button type="button" id="wkl-add-gcg-btn" class="button" style="border-radius: 8px; padding: 6px 16px; font-weight: bold; border-color: #2563eb; color: #2563eb;">
                        + Tambah Laporan Tata Kelola Baru
                    </button>
                    <button type="submit" class="button button-primary" style="background: #088395; border-color: #088395; font-weight: bold; padding: 6px 24px; border-radius: 8px;">
                        💾 Simpan Laporan Tata Kelola
                    </button>
                </div>
            </form>
        <?php endif; ?>

        <!-- ===============================================================
             TAB 3: LAPORAN TAHUNAN (ANNUAL REPORT)
             =============================================================== -->
        <?php if ( $current_tab === 'tahunan' ) : ?>
            <form method="post" action="?page=wakalumi-laporan&tab=tahunan">
                <?php wp_nonce_field( 'wakalumi_laporan_save_action', 'wakalumi_laporan_nonce' ); ?>
                <input type="hidden" name="current_tab" value="tahunan">

                <!-- Quick Help & Color Config Bar -->
                <div style="background: #fffbeb; border: 1px solid #fef3c7; border-radius: 10px; padding: 16px 20px; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
                        <div style="display: flex; align-items: flex-start; gap: 12px; max-width: 650px;">
                            <span style="font-size: 20px; line-height: 1;">📘</span>
                            <div style="font-size: 13px; color: #92400e; line-height: 1.5;">
                                <strong>Segmen Laporan Tahunan (Annual Report):</strong><br>
                                Unggah buku laporan tahunan lengkap BPRS Wakalumi yang telah disahkan oleh Rapat Umum Pemegang Saham (RUPS).
                            </div>
                        </div>
                        <div style="background: #fff; border: 1px solid #fde68a; border-radius: 8px; padding: 10px 14px; display: flex; align-items: center; gap: 10px;">
                            <label style="font-size: 12px; font-weight: 700; color: #92400e;">🎨 Tema Warna Kartu:</label>
                            <select name="options_laporan_color_tahunan" style="border-radius: 6px; padding: 4px 8px; border: 1px solid #d97706; font-weight: 600; font-size: 12px;">
                                <?php echo wakalumi_render_laporan_color_options( $color_ar ); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="wkl-ar-container" style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 24px;">
                    <?php foreach ( $tahunan_list as $idx => $item ) : 
                        $tahun        = $item['tahun'] ?? '2025';
                        $periode      = $item['periode'] ?? 'Tahunan 2025';
                        $judul        = $item['judul'] ?? '';
                        $file_url     = $item['file_url'] ?? '';
                        $file_size    = $item['file_size'] ?? 'PDF • 5.0 MB';
                        $tgl_pub      = $item['tgl_publikasi'] ?? '';
                        $status_audit = $item['status_audit'] ?? 'Audited & Disahkan RUPS';
                        $keterangan   = $item['keterangan'] ?? '';
                    ?>
                        <div class="wkl-laporan-card" style="background: #fff; border: 1px solid #cbd5e1; border-left: 4px solid #d97706; border-radius: 10px; padding: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span style="background: #d97706; color: white; border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: 800;">
                                        #<?php echo $idx + 1; ?>
                                    </span>
                                    <span style="font-size: 14px; font-weight: 700; color: #1e293b;">
                                        <?php echo esc_html( $judul ?: 'Annual Report Baru' ); ?>
                                    </span>
                                </div>
                                <button type="button" class="button button-link-delete wkl-remove-card-btn" style="color: #ef4444; font-size: 12px; font-weight: 600;">
                                    ✕ Hapus Dokumen
                                </button>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tahun Buku</label>
                                    <input type="number" name="ar_tahun[]" value="<?php echo esc_attr( $tahun ); ?>" min="2000" max="2099" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Label Periode</label>
                                    <input type="text" name="ar_periode[]" value="<?php echo esc_attr( $periode ); ?>" placeholder="Contoh: Tahunan 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tanggal Rilis Publikasi</label>
                                    <input type="text" name="ar_tgl_publikasi[]" value="<?php echo esc_attr( $tgl_pub ); ?>" placeholder="Contoh: 25 Juni 2026" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Judul Lengkap Annual Report</label>
                                    <input type="text" name="ar_judul[]" value="<?php echo esc_attr( $judul ); ?>" placeholder="Contoh: Laporan Tahunan Terpadu (Annual Report) 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Status RUPS / Audit</label>
                                    <input type="text" name="ar_status_audit[]" value="<?php echo esc_attr( $status_audit ); ?>" placeholder="Contoh: Audited & Disahkan RUPS" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Ukuran File PDF</label>
                                    <input type="text" name="ar_file_size[]" value="<?php echo esc_attr( $file_size ); ?>" placeholder="Contoh: PDF • 5.8 MB" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">File Dokumen PDF Annual Report</label>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <input type="text" name="ar_file_url[]" value="<?php echo esc_attr( $file_url ); ?>" placeholder="https://.../annual-report.pdf" class="wkl-pdf-url" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                    <button type="button" class="button wkl-upload-pdf-btn" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                                        <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah PDF
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Keterangan / Kilas Kinerja</label>
                                <textarea name="ar_keterangan[]" rows="2" placeholder="Sorotan kinerja pertumbuhan laba, pembiayaan, aset, dsb..." style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"><?php echo esc_textarea( $keterangan ); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; border-top: 1px solid #cbd5e1; padding-top: 18px;">
                    <button type="button" id="wkl-add-ar-btn" class="button" style="border-radius: 8px; padding: 6px 16px; font-weight: bold; border-color: #d97706; color: #d97706;">
                        + Tambah Laporan Tahunan Baru
                    </button>
                    <button type="submit" class="button button-primary" style="background: #088395; border-color: #088395; font-weight: bold; padding: 6px 24px; border-radius: 8px;">
                        💾 Simpan Laporan Tahunan
                    </button>
                </div>
            </form>
        <?php endif; ?>

        <!-- ===============================================================
             TAB 4: KEUANGAN BERKELANJUTAN (LKB / RAKB)
             =============================================================== -->
        <?php if ( $current_tab === 'berkelanjutan' ) : ?>
            <form method="post" action="?page=wakalumi-laporan&tab=berkelanjutan">
                <?php wp_nonce_field( 'wakalumi_laporan_save_action', 'wakalumi_laporan_nonce' ); ?>
                <input type="hidden" name="current_tab" value="berkelanjutan">

                <!-- Quick Help & Color Config Bar -->
                <div style="background: #f0fdf4; border: 1px solid #dcfce7; border-radius: 10px; padding: 16px 20px; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
                        <div style="display: flex; align-items: flex-start; gap: 12px; max-width: 650px;">
                            <span style="font-size: 20px; line-height: 1;">🌿</span>
                            <div style="font-size: 13px; color: #15803d; line-height: 1.5;">
                                <strong>Segmen Keuangan Berkelanjutan (LKB &amp; RAKB):</strong><br>
                                Unggah laporan berkala tahunan atas penerapan prinsip keuangan berkelanjutan, pembiayaan ramah lingkungan, dan program tanggung jawab sosial &amp; lingkungan.
                            </div>
                        </div>
                        <div style="background: #fff; border: 1px solid #bbf7d0; border-radius: 8px; padding: 10px 14px; display: flex; align-items: center; gap: 10px;">
                            <label style="font-size: 12px; font-weight: 700; color: #15803d;">🎨 Tema Warna Kartu:</label>
                            <select name="options_laporan_color_berkelanjutan" style="border-radius: 6px; padding: 4px 8px; border: 1px solid #16a34a; font-weight: 600; font-size: 12px;">
                                <?php echo wakalumi_render_laporan_color_options( $color_lkb ); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="wkl-lkb-container" style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 24px;">
                    <?php foreach ( $berkelanjutan_list as $idx => $item ) : 
                        $tahun        = $item['tahun'] ?? '2025';
                        $periode      = $item['periode'] ?? 'Tahunan 2025';
                        $judul        = $item['judul'] ?? '';
                        $file_url     = $item['file_url'] ?? '';
                        $file_size    = $item['file_size'] ?? 'PDF • 2.0 MB';
                        $tgl_pub      = $item['tgl_publikasi'] ?? '';
                        $status_audit = $item['status_audit'] ?? 'Kepatuhan POJK Keuangan Berkelanjutan';
                        $keterangan   = $item['keterangan'] ?? '';
                    ?>
                        <div class="wkl-laporan-card" style="background: #fff; border: 1px solid #cbd5e1; border-left: 4px solid #16a34a; border-radius: 10px; padding: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span style="background: #16a34a; color: white; border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: 800;">
                                        #<?php echo $idx + 1; ?>
                                    </span>
                                    <span style="font-size: 14px; font-weight: 700; color: #1e293b;">
                                        <?php echo esc_html( $judul ?: 'Laporan LKB Baru' ); ?>
                                    </span>
                                </div>
                                <button type="button" class="button button-link-delete wkl-remove-card-btn" style="color: #ef4444; font-size: 12px; font-weight: 600;">
                                    ✕ Hapus Dokumen
                                </button>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tahun Buku</label>
                                    <input type="number" name="lkb_tahun[]" value="<?php echo esc_attr( $tahun ); ?>" min="2000" max="2099" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Label Periode</label>
                                    <input type="text" name="lkb_periode[]" value="<?php echo esc_attr( $periode ); ?>" placeholder="Contoh: Tahunan 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tanggal Rilis Publikasi</label>
                                    <input type="text" name="lkb_tgl_publikasi[]" value="<?php echo esc_attr( $tgl_pub ); ?>" placeholder="Contoh: 30 April 2026" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Judul Lengkap Dokumen LKB</label>
                                    <input type="text" name="lkb_judul[]" value="<?php echo esc_attr( $judul ); ?>" placeholder="Contoh: Laporan Keuangan Berkelanjutan (LKB & RAKB) 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Status Kepatuhan Regulasi</label>
                                    <input type="text" name="lkb_status_audit[]" value="<?php echo esc_attr( $status_audit ); ?>" placeholder="Contoh: Kepatuhan POJK Keuangan Berkelanjutan" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Ukuran File PDF</label>
                                    <input type="text" name="lkb_file_size[]" value="<?php echo esc_attr( $file_size ); ?>" placeholder="Contoh: PDF • 2.4 MB" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">File Dokumen PDF LKB</label>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <input type="text" name="lkb_file_url[]" value="<?php echo esc_attr( $file_url ); ?>" placeholder="https://.../laporan-lkb.pdf" class="wkl-pdf-url" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                    <button type="button" class="button wkl-upload-pdf-btn" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                                        <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah PDF
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Keterangan / Realisasi Inisiatif Hijau &amp; Sosial</label>
                                <textarea name="lkb_keterangan[]" rows="2" placeholder="Realisasi pembiayaan hijau, zakat, CSR, dan aksi keberlanjutan..." style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"><?php echo esc_textarea( $keterangan ); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; border-top: 1px solid #cbd5e1; padding-top: 18px;">
                    <button type="button" id="wkl-add-lkb-btn" class="button" style="border-radius: 8px; padding: 6px 16px; font-weight: bold; border-color: #16a34a; color: #16a34a;">
                        + Tambah Laporan LKB Baru
                    </button>
                    <button type="submit" class="button button-primary" style="background: #088395; border-color: #088395; font-weight: bold; padding: 6px 24px; border-radius: 8px;">
                        💾 Simpan Keuangan Berkelanjutan
                    </button>
                </div>
            </form>
        <?php endif; ?>

        <!-- ===============================================================
             TAB 5: LAPORAN LAINNYA (DOKUMEN PUBLIKASI KHUSUS)
             =============================================================== -->
        <?php if ( $current_tab === 'lainnya' ) : ?>
            <form method="post" action="?page=wakalumi-laporan&tab=lainnya">
                <?php wp_nonce_field( 'wakalumi_laporan_save_action', 'wakalumi_laporan_nonce' ); ?>
                <input type="hidden" name="current_tab" value="lainnya">

                <!-- Quick Help & Color Config Bar -->
                <div style="background: #ecfeff; border: 1px solid #cffafe; border-radius: 10px; padding: 16px 20px; margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
                        <div style="display: flex; align-items: flex-start; gap: 12px; max-width: 650px;">
                            <span style="font-size: 20px; line-height: 1;">📂</span>
                            <div style="font-size: 13px; color: #0e7490; line-height: 1.5;">
                                <strong>Segmen Laporan Lainnya (Publikasi Khusus &amp; Tambahan):</strong><br>
                                Unggah dokumen laporan insidental, laporan khusus pengaduan konsumen, keterbukaan informasi literasi keuangan, atau laporan lain yang menyesuaikan kebutuhan otoritas pengawas.
                            </div>
                        </div>
                        <div style="background: #fff; border: 1px solid #a5f3fc; border-radius: 8px; padding: 10px 14px; display: flex; align-items: center; gap: 10px;">
                            <label style="font-size: 12px; font-weight: 700; color: #0e7490;">🎨 Tema Warna Kartu:</label>
                            <select name="options_laporan_color_lainnya" style="border-radius: 6px; padding: 4px 8px; border: 1px solid #0891b2; font-weight: 600; font-size: 12px;">
                                <?php echo wakalumi_render_laporan_color_options( $color_lainnya ); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="wkl-lainnya-container" style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 24px;">
                    <?php foreach ( $lainnya_list as $idx => $item ) : 
                        $tahun        = $item['tahun'] ?? '2025';
                        $periode      = $item['periode'] ?? 'Laporan Khusus';
                        $judul        = $item['judul'] ?? '';
                        $file_url     = $item['file_url'] ?? '';
                        $file_size    = $item['file_size'] ?? 'PDF • 2.0 MB';
                        $tgl_pub      = $item['tgl_publikasi'] ?? '';
                        $status_audit = $item['status_audit'] ?? 'Resmi OJK & Lembaga Pengawas';
                        $keterangan   = $item['keterangan'] ?? '';
                    ?>
                        <div class="wkl-laporan-card" style="background: #fff; border: 1px solid #cbd5e1; border-left: 4px solid #0891b2; border-radius: 10px; padding: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span class="wkl-card-num" style="background: #0891b2; color: white; border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: 800;">
                                        #<?php echo $idx + 1; ?>
                                    </span>
                                    <span class="wkl-card-title-display" style="font-size: 14px; font-weight: 700; color: #1e293b;">
                                        <?php echo esc_html( $judul ?: 'Laporan Khusus Baru' ); ?>
                                    </span>
                                </div>
                                <button type="button" class="button button-link-delete wkl-remove-card-btn" style="color: #ef4444; font-size: 12px; font-weight: 600;">
                                    ✕ Hapus Dokumen
                                </button>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tahun Dokumen</label>
                                    <input type="number" name="lainnya_tahun[]" value="<?php echo esc_attr( $tahun ); ?>" min="2000" max="2099" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Label Periode / Jenis</label>
                                    <input type="text" name="lainnya_periode[]" value="<?php echo esc_attr( $periode ); ?>" placeholder="Contoh: Laporan Khusus / Insidental" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tanggal Rilis Publikasi</label>
                                    <input type="text" name="lainnya_tgl_publikasi[]" value="<?php echo esc_attr( $tgl_pub ); ?>" placeholder="Contoh: 31 Desember 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Judul Dokumen Laporan</label>
                                    <input type="text" name="lainnya_judul[]" value="<?php echo esc_attr( $judul ); ?>" placeholder="Contoh: Laporan Khusus Pengaduan Nasabah 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Status Audit / Keterangan</label>
                                    <input type="text" name="lainnya_status_audit[]" value="<?php echo esc_attr( $status_audit ); ?>" placeholder="Contoh: Resmi OJK & Lembaga Pengawas" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Ukuran File PDF</label>
                                    <input type="text" name="lainnya_file_size[]" value="<?php echo esc_attr( $file_size ); ?>" placeholder="Contoh: PDF • 1.8 MB" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                </div>
                            </div>

                            <div style="margin-bottom: 12px;">
                                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">File Dokumen PDF</label>
                                <div style="display: flex; gap: 8px; align-items: center;">
                                    <input type="text" name="lainnya_file_url[]" value="<?php echo esc_attr( $file_url ); ?>" placeholder="https://.../laporan-khusus.pdf" class="wkl-pdf-url" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                                    <button type="button" class="button wkl-upload-pdf-btn" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                                        <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah PDF
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Keterangan / Ringkasan Dokumen</label>
                                <textarea name="lainnya_keterangan[]" rows="2" placeholder="Ringkasan atau poin utama isi laporan khusus ini..." style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"><?php echo esc_textarea( $keterangan ); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; border-top: 1px solid #cbd5e1; padding-top: 18px;">
                    <button type="button" id="wkl-add-lainnya-btn" class="button" style="border-radius: 8px; padding: 6px 16px; font-weight: bold; border-color: #0891b2; color: #0891b2;">
                        + Tambah Dokumen Laporan Baru
                    </button>
                    <button type="submit" class="button button-primary" style="background: #088395; border-color: #088395; font-weight: bold; padding: 6px 24px; border-radius: 8px;">
                        💾 Simpan Laporan Lainnya
                    </button>
                </div>
            </form>
        <?php endif; ?>

        <!-- ===============================================================
             TAB 6: PENGATURAN BANNER, REGULASI & TEMA WARNA
             =============================================================== -->
        <?php if ( $current_tab === 'banner' ) : ?>
            <form method="post" action="?page=wakalumi-laporan&tab=banner">
                <?php wp_nonce_field( 'wakalumi_laporan_save_action', 'wakalumi_laporan_nonce' ); ?>
                <input type="hidden" name="current_tab" value="banner">

                <!-- Color Schemes Card -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 24px;">
                    <h2 style="font-size: 16px; font-weight: 800; color: #0f172a; margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 8px;">
                        <span>🎨</span> Pewarnaan Tema Kartu Per Jenis Laporan
                    </h2>
                    <p style="font-size: 13px; color: #64748b; margin: 0 0 18px 0;">
                        Atur tema warna aksen, badge, dan tombol aksi untuk setiap jenis laporan. Pengaturan ini akan diaplikasikan secara konsisten ke seluruh kartu dokumen di segmen tersebut.
                    </p>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
                            <label style="font-size: 12px; font-weight: 700; color: #0f766e; display: block; margin-bottom: 6px;">📊 1. Publikasi Triwulanan</label>
                            <select name="options_laporan_color_triwulan" style="width: 100%; border-radius: 6px; padding: 6px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                                <?php echo wakalumi_render_laporan_color_options( $color_tw ); ?>
                            </select>
                        </div>

                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
                            <label style="font-size: 12px; font-weight: 700; color: #1e40af; display: block; margin-bottom: 6px;">🏛️ 2. Tata Kelola Perusahaan</label>
                            <select name="options_laporan_color_gcg" style="width: 100%; border-radius: 6px; padding: 6px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                                <?php echo wakalumi_render_laporan_color_options( $color_gcg ); ?>
                            </select>
                        </div>

                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
                            <label style="font-size: 12px; font-weight: 700; color: #92400e; display: block; margin-bottom: 6px;">📘 3. Laporan Tahunan</label>
                            <select name="options_laporan_color_tahunan" style="width: 100%; border-radius: 6px; padding: 6px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                                <?php echo wakalumi_render_laporan_color_options( $color_ar ); ?>
                            </select>
                        </div>

                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
                            <label style="font-size: 12px; font-weight: 700; color: #15803d; display: block; margin-bottom: 6px;">🌿 4. Keuangan Berkelanjutan</label>
                            <select name="options_laporan_color_berkelanjutan" style="width: 100%; border-radius: 6px; padding: 6px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                                <?php echo wakalumi_render_laporan_color_options( $color_lkb ); ?>
                            </select>
                        </div>

                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
                            <label style="font-size: 12px; font-weight: 700; color: #0891b2; display: block; margin-bottom: 6px;">📂 5. Laporan Lainnya</label>
                            <select name="options_laporan_color_lainnya" style="width: 100%; border-radius: 6px; padding: 6px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                                <?php echo wakalumi_render_laporan_color_options( $color_lainnya ); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Header Banner Card -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 24px;">
                    <h2 style="font-size: 16px; font-weight: 800; color: #0f172a; margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                        Header Banner Halaman Laporan
                    </h2>

                    <div style="display: flex; flex-direction: column; gap: 16px; margin-top: 16px;">
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Lencana Kicker Header</label>
                            <input type="text" name="options_laporan_badge" value="<?php echo esc_attr( $header_cfg['badge'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 8px 12px; border: 1px solid #cbd5e1; font-weight: 600;">
                        </div>

                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Judul Utama Halaman</label>
                            <input type="text" name="options_laporan_title" value="<?php echo esc_attr( $header_cfg['title'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 8px 12px; border: 1px solid #cbd5e1; font-size: 15px; font-weight: 800;">
                        </div>

                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Subheadline / Deskripsi Pengantar</label>
                            <textarea name="options_laporan_subtitle" rows="3" style="width: 100%; border-radius: 6px; padding: 8px 12px; border: 1px solid #cbd5e1; line-height: 1.5;"><?php echo esc_textarea( $header_cfg['subtitle'] ); ?></textarea>
                        </div>

                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Teks Komitmen Regulasi &amp; Dasar Hukum POJK</label>
                            <textarea name="options_laporan_disclaimer" rows="3" style="width: 100%; border-radius: 6px; padding: 8px 12px; border: 1px solid #cbd5e1; line-height: 1.5;"><?php echo esc_textarea( $header_cfg['disclaimer'] ); ?></textarea>
                            <p class="description" style="font-size: 11px; color: #64748b; margin-top: 4px;">
                                Teks ini ditampilkan pada kartu penutup kepatuhan regulasi di bagian bawah halaman laporan.
                            </p>
                        </div>
                    </div>
                </div>

                <div style="text-align: right;">
                    <button type="submit" class="button button-primary" style="background: #088395; border-color: #088395; font-weight: bold; padding: 8px 28px; border-radius: 8px; font-size: 14px;">
                        💾 Simpan Pengaturan Banner &amp; Warna
                    </button>
                </div>
            </form>
        <?php endif; ?>

    </div>

    <!-- JavaScript Handler untuk Upload Media & Clone Baris -->
    <script>
    jQuery(document).ready(function($) {
        // Upload PDF Media Modal
        $(document).on('click', '.wkl-upload-pdf-btn', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $input = $btn.siblings('.wkl-pdf-url');

            var mediaUploader = wp.media({
                title: 'Pilih Berkas PDF Laporan Resmi',
                button: { text: 'Gunakan Dokumen Ini' },
                multiple: false,
                library: { type: 'application/pdf' }
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $input.val(attachment.url);
            });

            mediaUploader.open();
        });

        // Hapus Baris Dokumen
        $(document).on('click', '.wkl-remove-card-btn', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus dokumen ini dari daftar?')) {
                $(this).closest('.wkl-laporan-card').slideUp(200, function() {
                    $(this).remove();
                });
            }
        });

        // Helper create card from template or clone (Resilient when 0 cards exist)
        function createNewCard(templateId, defaultTitle, defaultYear, containerSelector) {
            var $container = $(containerSelector);
            var count = $container.find('.wkl-laporan-card').length + 1;
            var tmplEl = document.getElementById(templateId);
            var $newCard;

            if (tmplEl && tmplEl.content && tmplEl.content.firstElementChild) {
                $newCard = $(tmplEl.content.firstElementChild.cloneNode(true));
            } else if (tmplEl && tmplEl.innerHTML) {
                $newCard = $($.parseHTML(tmplEl.innerHTML.trim()));
            } else {
                var $first = $container.find('.wkl-laporan-card').first();
                if ($first.length) {
                    $newCard = $first.clone();
                    $newCard.find('input[type="text"]').val('');
                    $newCard.find('textarea').val('');
                } else {
                    return;
                }
            }

            $newCard.find('input[type="number"]').val(defaultYear);
            $newCard.find('.wkl-card-num').text('#' + count);
            $newCard.find('.wkl-card-title-display').text(defaultTitle);
            $container.append($newCard);
            $newCard.hide().slideDown(250);
        }

        // Sinkronisasi realtime judul input ke label header kartu
        $(document).on('input', 'input[name$="_judul[]"]', function() {
            var val = $(this).val();
            $(this).closest('.wkl-laporan-card').find('.wkl-card-title-display').text(val || 'Dokumen Baru');
        });

        // Tambah Baris Tab 1: Triwulanan
        $('#wkl-add-tw-btn').on('click', function(e) {
            e.preventDefault();
            createNewCard('tmpl-card-tw', 'Laporan Triwulanan Baru', '2026', '#wkl-tw-container');
        });

        // Tambah Baris Tab 2: GCG
        $('#wkl-add-gcg-btn').on('click', function(e) {
            e.preventDefault();
            createNewCard('tmpl-card-gcg', 'Laporan Tata Kelola Baru', '2025', '#wkl-gcg-container');
        });

        // Tambah Baris Tab 3: Annual Report
        $('#wkl-add-ar-btn').on('click', function(e) {
            e.preventDefault();
            createNewCard('tmpl-card-ar', 'Annual Report Baru', '2025', '#wkl-ar-container');
        });

        // Tambah Baris Tab 4: LKB
        $('#wkl-add-lkb-btn').on('click', function(e) {
            e.preventDefault();
            createNewCard('tmpl-card-lkb', 'Laporan LKB Baru', '2025', '#wkl-lkb-container');
        });

        // Tambah Baris Tab 5: Laporan Lainnya
        $('#wkl-add-lainnya-btn').on('click', function(e) {
            e.preventDefault();
            createNewCard('tmpl-card-lainnya', 'Laporan Khusus Baru', '2025', '#wkl-lainnya-container');
        });
    });
    </script>

    <!-- Templates for Adding New Cards (Fallback when 0 cards exist) -->
    <template id="tmpl-card-tw">
        <div class="wkl-laporan-card" style="background: #fff; border: 1px solid #cbd5e1; border-left: 4px solid #0d9488; border-radius: 10px; padding: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span class="wkl-card-num" style="background: #0d9488; color: white; border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: 800;">#1</span>
                    <span class="wkl-card-title-display" style="font-size: 14px; font-weight: 700; color: #1e293b;">Laporan Triwulanan Baru</span>
                </div>
                <button type="button" class="button button-link-delete wkl-remove-card-btn" style="color: #ef4444; font-size: 12px; font-weight: 600;">✕ Hapus Dokumen</button>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tahun Laporan</label>
                    <input type="number" name="tw_tahun[]" value="2026" min="2000" max="2099" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Periode Triwulan</label>
                    <select name="tw_periode[]" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <option value="Triwulan I (Maret)">Triwulan I (Maret)</option>
                        <option value="Triwulan II (Juni)">Triwulan II (Juni)</option>
                        <option value="Triwulan III (September)">Triwulan III (September)</option>
                        <option value="Triwulan IV (Desember)">Triwulan IV (Desember)</option>
                    </select>
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tanggal Rilis Publikasi</label>
                    <input type="text" name="tw_tgl_publikasi[]" value="" placeholder="Contoh: 30 April 2026" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Judul Dokumen Publikasi</label>
                    <input type="text" name="tw_judul[]" value="" placeholder="Contoh: Laporan Keuangan Publikasi Triwulan I 2026" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Status Audit</label>
                    <input type="text" name="tw_status_audit[]" value="Unaudited (Resmi OJK)" placeholder="Contoh: Audited / Unaudited" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Ukuran File PDF</label>
                    <input type="text" name="tw_file_size[]" value="PDF • 2.0 MB" placeholder="Contoh: PDF • 2.1 MB" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>
            <div style="margin-bottom: 12px;">
                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">File Dokumen PDF Laporan</label>
                <div style="display: flex; gap: 8px; align-items: center;">
                    <input type="text" name="tw_file_url[]" value="" placeholder="https://.../laporan.pdf" class="wkl-pdf-url" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                    <button type="button" class="button wkl-upload-pdf-btn" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                        <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah PDF
                    </button>
                </div>
            </div>
            <div>
                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Keterangan Singkat</label>
                <textarea name="tw_keterangan[]" rows="2" placeholder="Keterangan singkat kinerja triwulan ini..." style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"></textarea>
            </div>
        </div>
    </template>

    <template id="tmpl-card-gcg">
        <div class="wkl-laporan-card" style="background: #fff; border: 1px solid #cbd5e1; border-left: 4px solid #2563eb; border-radius: 10px; padding: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span class="wkl-card-num" style="background: #2563eb; color: white; border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: 800;">#1</span>
                    <span class="wkl-card-title-display" style="font-size: 14px; font-weight: 700; color: #1e293b;">Laporan Tata Kelola Baru</span>
                </div>
                <button type="button" class="button button-link-delete wkl-remove-card-btn" style="color: #ef4444; font-size: 12px; font-weight: 600;">✕ Hapus Dokumen</button>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tahun Laporan</label>
                    <input type="number" name="gcg_tahun[]" value="2025" min="2000" max="2099" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Label Periode</label>
                    <input type="text" name="gcg_periode[]" value="Tahunan" placeholder="Contoh: Tahunan 2025 / Semester I" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tanggal Rilis Publikasi</label>
                    <input type="text" name="gcg_tgl_publikasi[]" value="" placeholder="Contoh: 15 Mei 2026" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Judul Dokumen GCG</label>
                    <input type="text" name="gcg_judul[]" value="" placeholder="Contoh: Laporan Penerapan Tata Kelola Perusahaan 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Status Penilaian OJK</label>
                    <input type="text" name="gcg_status_audit[]" value="Self Assessment Terdaftar OJK" placeholder="Contoh: Komposit Sangat Baik" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Ukuran File PDF</label>
                    <input type="text" name="gcg_file_size[]" value="PDF • 3.0 MB" placeholder="Contoh: PDF • 3.2 MB" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>
            <div style="margin-bottom: 12px;">
                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">File Dokumen PDF GCG</label>
                <div style="display: flex; gap: 8px; align-items: center;">
                    <input type="text" name="gcg_file_url[]" value="" placeholder="https://.../laporan-gcg.pdf" class="wkl-pdf-url" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                    <button type="button" class="button wkl-upload-pdf-btn" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                        <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah PDF
                    </button>
                </div>
            </div>
            <div>
                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Keterangan / Evaluasi Tata Kelola</label>
                <textarea name="gcg_keterangan[]" rows="2" placeholder="Ringkasan penilaian komposit TARIF dan kepatuhan..." style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"></textarea>
            </div>
        </div>
    </template>

    <template id="tmpl-card-ar">
        <div class="wkl-laporan-card" style="background: #fff; border: 1px solid #cbd5e1; border-left: 4px solid #d97706; border-radius: 10px; padding: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span class="wkl-card-num" style="background: #d97706; color: white; border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: 800;">#1</span>
                    <span class="wkl-card-title-display" style="font-size: 14px; font-weight: 700; color: #1e293b;">Annual Report Baru</span>
                </div>
                <button type="button" class="button button-link-delete wkl-remove-card-btn" style="color: #ef4444; font-size: 12px; font-weight: 600;">✕ Hapus Dokumen</button>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tahun Buku</label>
                    <input type="number" name="ar_tahun[]" value="2025" min="2000" max="2099" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Label Periode</label>
                    <input type="text" name="ar_periode[]" value="Tahunan" placeholder="Contoh: Tahunan 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tanggal Publikasi</label>
                    <input type="text" name="ar_tgl_publikasi[]" value="" placeholder="Contoh: 25 Juni 2026" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Judul Dokumen Annual Report</label>
                    <input type="text" name="ar_judul[]" value="" placeholder="Contoh: Laporan Tahunan Terpadu (Annual Report) 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Status RUPS / Audit</label>
                    <input type="text" name="ar_status_audit[]" value="Audited & Disahkan RUPS" placeholder="Contoh: Audited & Disahkan RUPS" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Ukuran File PDF</label>
                    <input type="text" name="ar_file_size[]" value="PDF • 5.0 MB" placeholder="Contoh: PDF • 5.8 MB" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>
            <div style="margin-bottom: 12px;">
                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">File Dokumen PDF Annual Report</label>
                <div style="display: flex; gap: 8px; align-items: center;">
                    <input type="text" name="ar_file_url[]" value="" placeholder="https://.../annual-report.pdf" class="wkl-pdf-url" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                    <button type="button" class="button wkl-upload-pdf-btn" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                        <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah PDF
                    </button>
                </div>
            </div>
            <div>
                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Keterangan / Kilas Kinerja</label>
                <textarea name="ar_keterangan[]" rows="2" placeholder="Sorotan kinerja pertumbuhan laba, pembiayaan, aset, dsb..." style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"></textarea>
            </div>
        </div>
    </template>

    <template id="tmpl-card-lkb">
        <div class="wkl-laporan-card" style="background: #fff; border: 1px solid #cbd5e1; border-left: 4px solid #16a34a; border-radius: 10px; padding: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span class="wkl-card-num" style="background: #16a34a; color: white; border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: 800;">#1</span>
                    <span class="wkl-card-title-display" style="font-size: 14px; font-weight: 700; color: #1e293b;">Laporan LKB Baru</span>
                </div>
                <button type="button" class="button button-link-delete wkl-remove-card-btn" style="color: #ef4444; font-size: 12px; font-weight: 600;">✕ Hapus Dokumen</button>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tahun Buku</label>
                    <input type="number" name="lkb_tahun[]" value="2025" min="2000" max="2099" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Label Periode</label>
                    <input type="text" name="lkb_periode[]" value="Tahunan" placeholder="Contoh: Tahunan 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tanggal Rilis Publikasi</label>
                    <input type="text" name="lkb_tgl_publikasi[]" value="" placeholder="Contoh: 30 April 2026" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Judul Dokumen LKB</label>
                    <input type="text" name="lkb_judul[]" value="" placeholder="Contoh: Laporan Keuangan Berkelanjutan (LKB & RAKB) 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Status Kepatuhan Regulasi</label>
                    <input type="text" name="lkb_status_audit[]" value="Kepatuhan POJK Keuangan Berkelanjutan" placeholder="Contoh: Kepatuhan POJK Keuangan Berkelanjutan" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Ukuran File PDF</label>
                    <input type="text" name="lkb_file_size[]" value="PDF • 2.0 MB" placeholder="Contoh: PDF • 2.4 MB" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>
            <div style="margin-bottom: 12px;">
                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">File Dokumen PDF LKB</label>
                <div style="display: flex; gap: 8px; align-items: center;">
                    <input type="text" name="lkb_file_url[]" value="" placeholder="https://.../laporan-lkb.pdf" class="wkl-pdf-url" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                    <button type="button" class="button wkl-upload-pdf-btn" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                        <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah PDF
                    </button>
                </div>
            </div>
            <div>
                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Keterangan / Realisasi Inisiatif Hijau &amp; Sosial</label>
                <textarea name="lkb_keterangan[]" rows="2" placeholder="Realisasi pembiayaan hijau, zakat, CSR, dan aksi keberlanjutan..." style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"></textarea>
            </div>
        </div>
    </template>

    <template id="tmpl-card-lainnya">
        <div class="wkl-laporan-card" style="background: #fff; border: 1px solid #cbd5e1; border-left: 4px solid #0891b2; border-radius: 10px; padding: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span class="wkl-card-num" style="background: #0891b2; color: white; border-radius: 6px; padding: 2px 8px; font-size: 11px; font-weight: 800;">#1</span>
                    <span class="wkl-card-title-display" style="font-size: 14px; font-weight: 700; color: #1e293b;">Laporan Khusus Baru</span>
                </div>
                <button type="button" class="button button-link-delete wkl-remove-card-btn" style="color: #ef4444; font-size: 12px; font-weight: 600;">✕ Hapus Dokumen</button>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tahun Dokumen</label>
                    <input type="number" name="lainnya_tahun[]" value="2025" min="2000" max="2099" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Label Periode / Jenis</label>
                    <input type="text" name="lainnya_periode[]" value="Laporan Khusus" placeholder="Contoh: Laporan Khusus / Insidental" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Tanggal Rilis Publikasi</label>
                    <input type="text" name="lainnya_tgl_publikasi[]" value="" placeholder="Contoh: 31 Desember 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Judul Dokumen Laporan</label>
                    <input type="text" name="lainnya_judul[]" value="" placeholder="Contoh: Laporan Khusus Pengaduan Nasabah 2025" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Status Audit / Keterangan</label>
                    <input type="text" name="lainnya_status_audit[]" value="Resmi OJK & Lembaga Pengawas" placeholder="Contoh: Resmi OJK & Lembaga Pengawas" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Ukuran File PDF</label>
                    <input type="text" name="lainnya_file_size[]" value="PDF • 2.0 MB" placeholder="Contoh: PDF • 1.8 MB" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>
            <div style="margin-bottom: 12px;">
                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">File Dokumen PDF</label>
                <div style="display: flex; gap: 8px; align-items: center;">
                    <input type="text" name="lainnya_file_url[]" value="" placeholder="https://.../laporan-khusus.pdf" class="wkl-pdf-url" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                    <button type="button" class="button wkl-upload-pdf-btn" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                        <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah PDF
                    </button>
                </div>
            </div>
            <div>
                <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 4px;">Keterangan / Ringkasan Dokumen</label>
                <textarea name="lainnya_keterangan[]" rows="2" placeholder="Ringkasan atau poin utama isi laporan khusus ini..." style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"></textarea>
            </div>
        </div>
    </template>
    <?php
}
