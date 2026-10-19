<?php
/**
 * Modul Admin: Pengaturan Layanan Pengaduan Konsumen
 * Berpedoman pada POJK No. 22 Tahun 2023 & POJK No. 6/POJK.07/2022
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ── 1. REGISTRASI MENU ADMIN ────────────────────────────────────────

add_action( 'admin_menu', 'wakalumi_register_pengaduan_page', 26 );
function wakalumi_register_pengaduan_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Layanan Pengaduan Konsumen',
        'Layanan Pengaduan',
        'manage_options',
        'wakalumi-pengaduan',
        'wakalumi_render_pengaduan_page'
    );
}

// ── 2. HELPER TEMA WARNA KARTU PENGADUAN ───────────────────────────

if ( ! function_exists( 'wakalumi_get_pengaduan_color_theme' ) ) {
    /**
     * Helper konfigurasi palet warna untuk Card Pengaduan Konsumen
     */
    function wakalumi_get_pengaduan_color_theme( $color = 'emerald' ) {
        $themes = [
            'emerald' => [
                'name'         => 'emerald',
                'label'        => '🟢 Hijau Zamrud (Karakter Syariah)',
                'border'       => 'border-emerald-200/90 dark:border-dark-border hover:border-emerald-400 dark:hover:border-emerald-500',
                'hover_shadow' => 'hover:shadow-emerald-500/15',
                'top_line'     => 'from-emerald-500 via-teal-400 to-cyan-500',
                'header_bg'    => 'from-emerald-50/90 via-teal-50/50 to-white/10 dark:from-emerald-950/40 dark:via-dark-card dark:to-dark-card border-b border-emerald-100/90 dark:border-dark-border',
                'badge'        => 'bg-emerald-100 dark:bg-emerald-900/60 text-emerald-800 dark:text-emerald-300 border border-emerald-300/60 dark:border-emerald-700/60',
                'ping_dot'     => 'bg-emerald-500',
                'tag'          => 'text-emerald-700 dark:text-emerald-300 border-emerald-200/80 dark:border-emerald-800/80',
                'title_hover'  => 'group-hover:text-emerald-600 dark:group-hover:text-emerald-400',
                'pill_icon'    => 'text-emerald-600 dark:text-emerald-400',
                'channel_bg'   => 'bg-emerald-50/70 dark:bg-emerald-950/30 border-emerald-200/70 dark:border-emerald-900/40 hover:border-emerald-400 dark:hover:border-emerald-700',
                'channel_icon' => 'bg-emerald-500 text-white shadow-emerald-500/30',
                'channel_link' => 'text-emerald-700 dark:text-emerald-300 hover:text-emerald-800 dark:hover:text-emerald-200',
                'status_tag'   => 'text-emerald-600 dark:text-emerald-400',
                'sub_icon'     => 'text-emerald-600 dark:text-emerald-400',
                'sub_link'     => 'text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300',
                'btn_action'   => 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/30 hover:shadow-emerald-600/40',
            ],
            'red' => [
                'name'         => 'red',
                'label'        => '🔴 Merah Resmi OJK (Regulator)',
                'border'       => 'border-red-200/90 dark:border-dark-border hover:border-red-400 dark:hover:border-red-500',
                'hover_shadow' => 'hover:shadow-red-500/15',
                'top_line'     => 'from-red-600 via-rose-500 to-amber-500',
                'header_bg'    => 'from-red-50/90 via-rose-50/50 to-white/10 dark:from-red-950/40 dark:via-dark-card dark:to-dark-card border-b border-red-100/90 dark:border-dark-border',
                'badge'        => 'bg-red-100 dark:bg-red-900/60 text-red-800 dark:text-red-300 border border-red-300/60 dark:border-red-700/60',
                'ping_dot'     => 'bg-red-500',
                'tag'          => 'text-red-700 dark:text-red-300 border-red-200/80 dark:border-red-800/80',
                'title_hover'  => 'group-hover:text-red-600 dark:group-hover:text-red-400',
                'pill_icon'    => 'text-red-600 dark:text-red-400',
                'channel_bg'   => 'bg-red-50/70 dark:bg-red-950/30 border-red-200/70 dark:border-red-900/40 hover:border-red-400 dark:hover:border-red-700',
                'channel_icon' => 'bg-red-600 text-white shadow-red-600/30',
                'channel_link' => 'text-red-700 dark:text-red-300 hover:text-red-800 dark:hover:text-red-200',
                'status_tag'   => 'text-red-600 dark:text-red-400',
                'sub_icon'     => 'text-red-600 dark:text-red-400',
                'sub_link'     => 'text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300',
                'btn_action'   => 'bg-red-600 hover:bg-red-700 text-white shadow-red-600/30 hover:shadow-red-600/40',
            ],
            'blue' => [
                'name'         => 'blue',
                'label'        => '🔷 Biru Finansial & Regulator',
                'border'       => 'border-blue-200/90 dark:border-dark-border hover:border-blue-400 dark:hover:border-blue-500',
                'hover_shadow' => 'hover:shadow-blue-500/15',
                'top_line'     => 'from-blue-600 via-indigo-500 to-cyan-500',
                'header_bg'    => 'from-blue-50/90 via-indigo-50/50 to-white/10 dark:from-blue-950/40 dark:via-dark-card dark:to-dark-card border-b border-blue-100/90 dark:border-dark-border',
                'badge'        => 'bg-blue-100 dark:bg-blue-900/60 text-blue-800 dark:text-blue-300 border border-blue-300/60 dark:border-blue-700/60',
                'ping_dot'     => 'bg-blue-500',
                'tag'          => 'text-blue-700 dark:text-blue-300 border-blue-200/80 dark:border-blue-800/80',
                'title_hover'  => 'group-hover:text-blue-600 dark:group-hover:text-blue-400',
                'pill_icon'    => 'text-blue-600 dark:text-blue-400',
                'channel_bg'   => 'bg-blue-50/70 dark:bg-blue-950/30 border-blue-200/70 dark:border-blue-900/40 hover:border-blue-400 dark:hover:border-blue-700',
                'channel_icon' => 'bg-blue-600 text-white shadow-blue-600/30',
                'channel_link' => 'text-blue-700 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-200',
                'status_tag'   => 'text-blue-600 dark:text-blue-400',
                'sub_icon'     => 'text-blue-600 dark:text-blue-400',
                'sub_link'     => 'text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300',
                'btn_action'   => 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-600/30 hover:shadow-blue-600/40',
            ],
            'teal' => [
                'name'         => 'teal',
                'label'        => '🌊 Toska Wakalumi (Identitas Brand)',
                'border'       => 'border-teal-200/90 dark:border-dark-border hover:border-teal-400 dark:hover:border-teal-500',
                'hover_shadow' => 'hover:shadow-teal-500/15',
                'top_line'     => 'from-teal-600 via-cyan-500 to-emerald-500',
                'header_bg'    => 'from-teal-50/90 via-cyan-50/50 to-white/10 dark:from-teal-950/40 dark:via-dark-card dark:to-dark-card border-b border-teal-100/90 dark:border-dark-border',
                'badge'        => 'bg-teal-100 dark:bg-teal-900/60 text-teal-800 dark:text-teal-300 border border-teal-300/60 dark:border-teal-700/60',
                'ping_dot'     => 'bg-teal-500',
                'tag'          => 'text-teal-700 dark:text-teal-300 border-teal-200/80 dark:border-teal-800/80',
                'title_hover'  => 'group-hover:text-teal-600 dark:group-hover:text-teal-400',
                'pill_icon'    => 'text-teal-600 dark:text-teal-400',
                'channel_bg'   => 'bg-teal-50/70 dark:bg-teal-950/30 border-teal-200/70 dark:border-teal-900/40 hover:border-teal-400 dark:hover:border-teal-700',
                'channel_icon' => 'bg-teal-600 text-white shadow-teal-600/30',
                'channel_link' => 'text-teal-700 dark:text-teal-300 hover:text-teal-800 dark:hover:text-teal-200',
                'status_tag'   => 'text-teal-600 dark:text-teal-400',
                'sub_icon'     => 'text-teal-600 dark:text-teal-400',
                'sub_link'     => 'text-teal-600 dark:text-teal-400 hover:text-teal-700 dark:hover:text-teal-300',
                'btn_action'   => 'bg-teal-600 hover:bg-teal-700 text-white shadow-teal-600/30 hover:shadow-teal-600/40',
            ],
            'amber' => [
                'name'         => 'amber',
                'label'        => '👑 Emas / Oranye (Prestisius)',
                'border'       => 'border-amber-200/90 dark:border-dark-border hover:border-amber-400 dark:hover:border-amber-500',
                'hover_shadow' => 'hover:shadow-amber-500/15',
                'top_line'     => 'from-amber-500 via-orange-500 to-yellow-400',
                'header_bg'    => 'from-amber-50/90 via-orange-50/50 to-white/10 dark:from-amber-950/40 dark:via-dark-card dark:to-dark-card border-b border-amber-100/90 dark:border-dark-border',
                'badge'        => 'bg-amber-100 dark:bg-amber-900/60 text-amber-800 dark:text-amber-300 border border-amber-300/60 dark:border-amber-700/60',
                'ping_dot'     => 'bg-amber-500',
                'tag'          => 'text-amber-700 dark:text-amber-300 border-amber-200/80 dark:border-amber-800/80',
                'title_hover'  => 'group-hover:text-amber-600 dark:group-hover:text-amber-400',
                'pill_icon'    => 'text-amber-600 dark:text-amber-400',
                'channel_bg'   => 'bg-amber-50/70 dark:bg-amber-950/30 border-amber-200/70 dark:border-amber-900/40 hover:border-amber-400 dark:hover:border-amber-700',
                'channel_icon' => 'bg-amber-600 text-white shadow-amber-600/30',
                'channel_link' => 'text-amber-700 dark:text-amber-300 hover:text-amber-800 dark:hover:text-amber-200',
                'status_tag'   => 'text-amber-600 dark:text-amber-400',
                'sub_icon'     => 'text-amber-600 dark:text-amber-400',
                'sub_link'     => 'text-amber-600 dark:text-amber-400 hover:text-amber-700 dark:hover:text-amber-300',
                'btn_action'   => 'bg-amber-600 hover:bg-amber-700 text-white shadow-amber-600/30 hover:shadow-amber-600/40',
            ],
            'purple' => [
                'name'         => 'purple',
                'label'        => '🟣 Ungu (Modern Eksklusif)',
                'border'       => 'border-purple-200/90 dark:border-dark-border hover:border-purple-400 dark:hover:border-purple-500',
                'hover_shadow' => 'hover:shadow-purple-500/15',
                'top_line'     => 'from-purple-600 via-indigo-500 to-pink-500',
                'header_bg'    => 'from-purple-50/90 via-indigo-50/50 to-white/10 dark:from-purple-950/40 dark:via-dark-card dark:to-dark-card border-b border-purple-100/90 dark:border-dark-border',
                'badge'        => 'bg-purple-100 dark:bg-purple-900/60 text-purple-800 dark:text-purple-300 border border-purple-300/60 dark:border-purple-700/60',
                'ping_dot'     => 'bg-purple-500',
                'tag'          => 'text-purple-700 dark:text-purple-300 border-purple-200/80 dark:border-purple-800/80',
                'title_hover'  => 'group-hover:text-purple-600 dark:group-hover:text-purple-400',
                'pill_icon'    => 'text-purple-600 dark:text-purple-400',
                'channel_bg'   => 'bg-purple-50/70 dark:bg-purple-950/30 border-purple-200/70 dark:border-purple-900/40 hover:border-purple-400 dark:hover:border-purple-700',
                'channel_icon' => 'bg-purple-600 text-white shadow-purple-600/30',
                'channel_link' => 'text-purple-700 dark:text-purple-300 hover:text-purple-800 dark:hover:text-purple-200',
                'status_tag'   => 'text-purple-600 dark:text-purple-400',
                'sub_icon'     => 'text-purple-600 dark:text-purple-400',
                'sub_link'     => 'text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300',
                'btn_action'   => 'bg-purple-600 hover:bg-purple-700 text-white shadow-purple-600/30 hover:shadow-purple-600/40',
            ],
        ];

        return $themes[ $color ] ?? $themes['emerald'];
    }
}

if ( ! function_exists( 'wakalumi_render_pengaduan_color_options' ) ) {
    function wakalumi_render_pengaduan_color_options( $current = 'emerald' ) {
        $colors = [
            'emerald' => '🟢 Hijau Zamrud (Karakter Syariah)',
            'red'     => '🔴 Merah Resmi OJK (Regulator)',
            'blue'    => '🔷 Biru Finansial & Regulator',
            'teal'    => '🌊 Toska Wakalumi (Identitas Brand)',
            'amber'   => '👑 Emas / Oranye (Prestisius)',
            'purple'  => '🟣 Ungu (Modern Eksklusif)',
        ];
        $html = '';
        foreach ( $colors as $key => $label ) {
            $sel = selected( $current, $key, false );
            $html .= "<option value='{$key}' {$sel}>{$label}</option>";
        }
        return $html;
    }
}

// ── 3. HELPER DEFAULT DATA SALURAN & TAHAPAN ────────────────────────

if ( ! function_exists( 'wakalumi_get_default_pengaduan_channels' ) ) {
    function wakalumi_get_default_pengaduan_channels() {
        $default_wa    = get_option( 'options_contact_wa', '6281517380388' );
        $default_phone = get_option( 'options_contact_phone', '(021) 7471 4555' );
        $default_email = get_option( 'options_contact_email', 'sekretariat@wakalumibprs.co.id' );

        return [
            [
                'title'            => 'Pengaduan Langsung ke Bank',
                'badge'            => 'Tahap 1: Saluran Resmi Bank',
                'tag'              => 'Bebas Biaya (100% Gratis)',
                'color'            => 'emerald',
                'desc'             => 'Sampaikan keluhan transaksi, rekening, pembiayaan, atau pelayanan secara langsung. Tim Penanganan Pengaduan dan Customer Care Bank Syariah Wakalumi siap menyelesaikan secara seksama dan profesional berpedoman pada POJK No. 22 Tahun 2023.',
                'status_tag'       => 'Chat & Loket Aktif',
                'contact_wa'       => get_option( 'options_pengaduan_wa', $default_wa ),
                'contact_phone'    => get_option( 'options_pengaduan_phone', $default_phone ),
                'contact_email'    => get_option( 'options_pengaduan_email', 'pengaduan@wakalumibprs.co.id' ),
                'contact_desc'     => get_option( 'options_pengaduan_location_desc', 'Kantor Pusat & Seluruh Jaringan Kantor Kas • Senin – Jumat: 08.00 – 15.00 WIB' ),
                'btn_primary_text' => 'Kirim Pengaduan via WA',
                'btn_primary_url'  => '',
                'btn_secondary_text' => 'Kirim Email Resmi',
                'btn_secondary_url'  => '',
                'urutan'           => 1,
            ],
            [
                'title'            => 'Eskalasi Pengaduan ke OJK',
                'badge'            => 'Tahap 2: Eskalasi Regulator',
                'tag'              => 'Jika Belum Ada Kesepakatan',
                'color'            => 'red',
                'desc'             => 'Sesuai regulasi POJK, jika proses penanganan di bank belum mencapai kesepakatan atau tidak ditindaklanjuti dalam batas waktu SLA (20 hari kerja), nasabah berhak mengeskalasikan pengaduan ke portal resmi APPK OJK atau LAPS SJK.',
                'status_tag'       => 'Portal Regulator Resmi',
                'contact_wa'       => get_option( 'options_pengaduan_ojk_wa', '081 157 157 157' ),
                'contact_phone'    => get_option( 'options_pengaduan_ojk_phone', '157' ),
                'contact_email'    => get_option( 'options_pengaduan_ojk_email', 'konsumen@ojk.go.id' ),
                'contact_desc'     => 'Portal APPK: kontak157.ojk.go.id • Sengketa: lapssjk.id',
                'btn_primary_text' => 'Buka Portal APPK OJK',
                'btn_primary_url'  => get_option( 'options_pengaduan_ojk_appk_url', 'https://kontak157.ojk.go.id' ),
                'btn_secondary_text' => 'Kunjungi LAPS SJK',
                'btn_secondary_url'  => get_option( 'options_pengaduan_laps_url', 'https://lapssjk.id' ),
                'urutan'           => 2,
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_default_pengaduan_steps' ) ) {
    function wakalumi_get_default_pengaduan_steps() {
        return [
            [
                'number'  => '01',
                'badge'   => 'Langkah Awal',
                'title'   => 'Penyampaian & Registrasi Aduan',
                'desc'    => 'Nasabah menyampaikan pengaduan kepada bank melalui WhatsApp resmi, telepon hotline, kantor kas, atau email disertai bukti pendukung transaksi.',
                'output'  => 'Output: Nomor Registrasi Tanda Terima Aduan',
                'image'   => '',
                'caption' => '',
                'urutan'  => 1,
            ],
            [
                'number'  => '02',
                'badge'   => 'Langkah Kedua',
                'title'   => 'Verifikasi & Validasi Berkas',
                'desc'    => 'Petugas bank memverifikasi identitas nasabah, mencocokkan kronologis, serta memastikan kelengkapan dokumen persyaratan aduan.',
                'output'  => 'Output: Berita Acara & Checklist Dokumen',
                'image'   => '',
                'caption' => '',
                'urutan'  => 2,
            ],
            [
                'number'  => '03',
                'badge'   => 'Langkah Ketiga',
                'title'   => 'Investigasi & Analisis Bank',
                'desc'    => 'Pemeriksaan catatan sistem perbankan syariah secara komprehensif, konfirmasi organ terkait, dan perumusan solusi berkeadilan dalam jangka waktu SLA.',
                'output'  => 'Output: Kajian Solusi Sesuai Prinsip Syariah',
                'image'   => '',
                'caption' => '',
                'urutan'  => 3,
            ],
            [
                'number'  => '04',
                'badge'   => 'Langkah Akhir',
                'title'   => 'Tanggapan Resmi & Opsi Eskalasi',
                'desc'    => 'Penyampaian tanggapan resmi bank maksimal 20 hari kerja. Jika belum tercapai mufakat, nasabah dapat mengeskalasikan ke OJK (Kontak 157) atau LAPS SJK.',
                'output'  => 'Output: Surat Tanggapan Resmi / Eskalasi OJK',
                'image'   => '',
                'caption' => '',
                'urutan'  => 4,
            ],
        ];
    }
}

// ── 4. HELPER GET DATA PENGADUAN ───────────────────────────────────

if ( ! function_exists( 'wakalumi_get_pengaduan_settings' ) ) {
    function wakalumi_get_pengaduan_settings() {
        $default_wa    = get_option( 'options_contact_wa', '6281517380388' );
        $default_phone = get_option( 'options_contact_phone', '(021) 7471 4555' );
        $default_email = get_option( 'options_contact_email', 'sekretariat@wakalumibprs.co.id' );

        // Dynamic Channels List
        $saved_channels = get_option( 'options_pengaduan_channels', null );
        if ( empty( $saved_channels ) || ! is_array( $saved_channels ) ) {
            $channels = wakalumi_get_default_pengaduan_channels();
        } else {
            $channels = $saved_channels;
        }

        // Dynamic Steps List
        $saved_steps = get_option( 'options_pengaduan_steps', null );
        if ( empty( $saved_steps ) || ! is_array( $saved_steps ) ) {
            $steps = wakalumi_get_default_pengaduan_steps();
        } else {
            $steps = $saved_steps;
        }

        return [
            // Header
            'badge'         => get_option( 'options_pengaduan_badge', 'Perlindungan Konsumen & Regulasi OJK' ),
            'title'         => get_option( 'options_pengaduan_title', 'Layanan Pengaduan Konsumen' ),
            'subtitle'      => get_option( 'options_pengaduan_subtitle', 'Komitmen Bank Syariah Wakalumi dalam mendengarkan, melayani, dan menindaklanjuti setiap aspirasi serta pengaduan nasabah secara adil, transparan, dan profesional berpedoman pada POJK No. 22 Tahun 2023.' ),
            'disclaimer'    => get_option( 'options_pengaduan_disclaimer', 'Bank Syariah Wakalumi Berizin dan Diawasi oleh Otoritas Jasa Keuangan (OJK) serta merupakan peserta penjaminan Lembaga Penjamin Simpanan (LPS).' ),
            
            // Pengaturan Visibilitas Seksi Halaman
            'channels_show' => (bool) get_option( 'options_pengaduan_channels_show', 1 ),
            'alur_show'     => (bool) get_option( 'options_pengaduan_alur_show', 1 ),
            'sla_show'      => (bool) get_option( 'options_pengaduan_sla_show', 1 ),
            'panduan_show'  => (bool) get_option( 'options_pengaduan_panduan_show', 1 ),
            'show_form_pdf' => (bool) get_option( 'options_pengaduan_show_form_pdf', 0 ),

            // Dynamic Channels (Repeater)
            'channels'      => $channels,

            // Visual Infografis Alur Pengaduan
            'infografis_show'  => (bool) get_option( 'options_pengaduan_infografis_show', 0 ),
            'infografis_image' => get_option( 'options_pengaduan_infografis_image', '' ),
            'infografis_title' => get_option( 'options_pengaduan_infografis_title', 'Bagan & Infografis Alur Pengaduan Nasabah' ),
            'infografis_desc'  => get_option( 'options_pengaduan_infografis_desc', 'Panduan visual alur penanganan pengaduan nasabah Bank Syariah Wakalumi sesuai regulasi perlindungan konsumen Otoritas Jasa Keuangan (OJK).' ),

            // Dynamic Steps (Repeater)
            'steps'         => $steps,

            // Standar Waktu Resmi (SLA POJK No. 22/2023)
            'sla_title'          => get_option( 'options_pengaduan_sla_title', 'Standar Waktu Layanan Pengaduan (SLA)' ),
            'sla_subtitle'       => get_option( 'options_pengaduan_sla_subtitle', 'Bank Syariah Wakalumi menjamin setiap pengaduan nasabah diselesaikan secara tepat waktu, profesional, dan transparan berpedoman pada POJK No. 22 Tahun 2023.' ),
            'sla_card1_title'    => get_option( 'options_pengaduan_sla_card1_title', 'Penyelesaian Standar oleh Bank' ),
            'sla_card1_badge'    => get_option( 'options_pengaduan_sla_card1_badge', 'Standar Batas Waktu POJK' ),
            'sla_card1_time'     => get_option( 'options_pengaduan_sla_card1_time', '20 Hari Kerja' ),
            'sla_card1_label'    => get_option( 'options_pengaduan_sla_card1_label', 'Maksimal Standar' ),
            'sla_card1_desc'     => get_option( 'options_pengaduan_sla_card1_desc', 'Bank Syariah Wakalumi wajib menyelesaikan penanganan pengaduan nasabah paling lambat 20 hari kerja sejak dokumen pendukung lengkap diterima.' ),
            'sla_card1_points'   => get_option( 'options_pengaduan_sla_card1_points', "Pencatatan langsung & konfirmasi nomor tanda terima aduan\nPenyampaian surat tanggapan tertulis resmi bersegel bank" ),

            'sla_card2_title'    => get_option( 'options_pengaduan_sla_card2_title', 'Perpanjangan Waktu Resmi Bank' ),
            'sla_card2_badge'    => get_option( 'options_pengaduan_sla_card2_badge', 'Perpanjangan Waktu Resmi' ),
            'sla_card2_time'     => get_option( 'options_pengaduan_sla_card2_time', '+20 Hari Kerja' ),
            'sla_card2_label'    => get_option( 'options_pengaduan_sla_card2_label', 'Kondisi Tertentu' ),
            'sla_card2_desc'     => get_option( 'options_pengaduan_sla_card2_desc', 'Dapat diperpanjang paling lama 20 hari kerja jika memerlukan penelitian pihak ketiga/kantor cabang lain dengan pemberitahuan tertulis resmi kepada nasabah.' ),
            'sla_card2_points'   => get_option( 'options_pengaduan_sla_card2_points', "Pemberitahuan tertulis alasan perpanjangan sebelum hari ke-20\nJaminan penuntasan pengaduan berkeadilan syariah" ),

            'sla_note'           => get_option( 'options_pengaduan_sla_note', 'Sesuai POJK No. 22 Tahun 2023 Pasal 55 & 57, jangka waktu penyelesaian pengaduan oleh Bank adalah maksimal 20 (dua puluh) hari kerja sejak dokumen lengkap, dan dapat diperpanjang maksimal 20 (dua puluh) hari kerja dalam kondisi tertentu. Jika pengaduan tidak ditindaklanjuti atau belum mencapai kesepakatan, konsumen berhak mengajukan penyelesaian sengketa ke LAPS SJK atau pengaduan ke OJK.' ),

            // Hero Trust & Security Badge Card
            'hero_trust_show'    => (bool) get_option( 'options_pengaduan_hero_trust_show', 1 ),
            'hero_trust_badge'   => get_option( 'options_pengaduan_hero_trust_badge', 'Jaminan Perlindungan Nasabah' ),
            'hero_trust_title'   => get_option( 'options_pengaduan_hero_trust_title', 'Aman, Rahasia & Terbuka' ),
            'hero_trust_desc'    => get_option( 'options_pengaduan_hero_trust_desc', 'Setiap aspirasi dan laporan keluhan nasabah ditangani dengan prinsip keterbukaan, perlakuan adil, serta jaminan kerahasiaan identitas penuh tanpa dipungut biaya apapun.' ),
            'hero_trust_p1'      => get_option( 'options_pengaduan_hero_trust_p1', 'Kerahasiaan Identitas 100% Terlindungi UU & POJK' ),
            'hero_trust_p2'      => get_option( 'options_pengaduan_hero_trust_p2', 'Transparan dengan Nomor Tanda Terima Aduan Resmi' ),
            'hero_trust_p3'      => get_option( 'options_pengaduan_hero_trust_p3', '100% Bebas Biaya Layanan & Penanganan (Gratis)' ),
            'hero_trust_p4'      => get_option( 'options_pengaduan_hero_trust_p4', 'Didukung Eskalasi Resmi ke Regulator OJK & LAPS SJK' ),
            'hero_trust_seal'    => get_option( 'options_pengaduan_hero_trust_seal', 'Bank Berizin & Diawasi Regulator OJK • Penjaminan LPS' ),

            // Berkas Formulir PDF Fisik
            'form_pdf_url'       => get_option( 'options_pengaduan_form_pdf_url', '' ),

            // Saluran Kontak Fallback (Sinkronisasi dengan front-page)
            'wa'                 => get_option( 'options_pengaduan_wa', $default_wa ),
            'phone'              => get_option( 'options_pengaduan_phone', $default_phone ),
            'email'              => get_option( 'options_pengaduan_email', 'pengaduan@wakalumibprs.co.id' ),
            'hours'              => get_option( 'options_pengaduan_hours', 'Senin – Jumat: 08.00 – 15.00 WIB (Kecuali Hari Libur Nasional)' ),
            'location_desc'      => get_option( 'options_pengaduan_location_desc', 'Kantor Pusat & Seluruh Jaringan Kantor Kas Bank Syariah Wakalumi' ),
            'ojk_appk_url'       => get_option( 'options_pengaduan_ojk_appk_url', 'https://kontak157.ojk.go.id' ),
            'ojk_phone'          => get_option( 'options_pengaduan_ojk_phone', '157' ),
            'ojk_wa'             => get_option( 'options_pengaduan_ojk_wa', '081 157 157 157' ),
            'ojk_email'          => get_option( 'options_pengaduan_ojk_email', 'konsumen@ojk.go.id' ),
            'laps_url'           => get_option( 'options_pengaduan_laps_url', 'https://lapssjk.id' ),

            // Legacy SLA strings for fallback
            'sla_lisan'          => get_option( 'options_pengaduan_sla_lisan', '20 Hari Kerja' ),
            'sla_tertulis'       => get_option( 'options_pengaduan_sla_tertulis', '20 Hari Kerja' ),

            // Pratinjau Halaman Utama (Beranda)
            'home_badge'         => get_option( 'options_pengaduan_home_badge', 'Kepatuhan Regulasi POJK No. 22/2023' ),
            'home_title'         => get_option( 'options_pengaduan_home_title', 'Layanan Pengaduan & Pelindungan Nasabah' ),
            'home_desc'          => get_option( 'options_pengaduan_home_desc', 'Bank Syariah Wakalumi berkomitmen memberikan kepastian dan keadilan bagi setiap nasabah. Sesuai regulasi OJK, mekanisme penanganan pengaduan kami transparan, bebas biaya (gratis), serta menjamin kerahasiaan informasi dengan batas waktu penyelesaian yang terukur (maksimal 20 hari kerja).' ),
            'home_btn_text'      => get_option( 'options_pengaduan_home_btn_text', 'Pelajari Prosedur & Ajukan Pengaduan' ),
        ];
    }
}

// ── 5. RENDER HALAMAN ADMIN ────────────────────────────────────────

function wakalumi_render_pengaduan_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( esc_html__( 'Anda tidak memiliki izin untuk mengakses halaman ini.', 'wakalumi' ) );
    }

    wp_enqueue_media();
    $message = '';

    // Proses Simpan Data
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer( 'wakalumi_pengaduan_action', 'wakalumi_pengaduan_nonce' ) ) {
        
        // 1. Header & General
        update_option( 'options_pengaduan_badge', sanitize_text_field( $_POST['options_pengaduan_badge'] ?? '' ) );
        update_option( 'options_pengaduan_title', sanitize_text_field( $_POST['options_pengaduan_title'] ?? '' ) );
        update_option( 'options_pengaduan_subtitle', sanitize_textarea_field( $_POST['options_pengaduan_subtitle'] ?? '' ) );
        update_option( 'options_pengaduan_disclaimer', sanitize_textarea_field( $_POST['options_pengaduan_disclaimer'] ?? '' ) );

        // 2. Visibilitas Seksi
        update_option( 'options_pengaduan_channels_show', isset( $_POST['options_pengaduan_channels_show'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_alur_show', isset( $_POST['options_pengaduan_alur_show'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_infografis_show', isset( $_POST['options_pengaduan_infografis_show'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_sla_show', isset( $_POST['options_pengaduan_sla_show'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_panduan_show', isset( $_POST['options_pengaduan_panduan_show'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_show_form_pdf', isset( $_POST['options_pengaduan_show_form_pdf'] ) ? 1 : 0 );

        // 3. Simpan Repeater Saluran Pengaduan (Channels)
        $ch_titles     = wp_unslash( $_POST['channel_title'] ?? [] );
        $ch_badges     = wp_unslash( $_POST['channel_badge'] ?? [] );
        $ch_tags       = wp_unslash( $_POST['channel_tag'] ?? [] );
        $ch_colors     = wp_unslash( $_POST['channel_color'] ?? [] );
        $ch_descs      = wp_unslash( $_POST['channel_desc'] ?? [] );
        $ch_statuses   = wp_unslash( $_POST['channel_status_tag'] ?? [] );
        $ch_was        = wp_unslash( $_POST['channel_contact_wa'] ?? [] );
        $ch_phones     = wp_unslash( $_POST['channel_contact_phone'] ?? [] );
        $ch_emails     = wp_unslash( $_POST['channel_contact_email'] ?? [] );
        $ch_cdescs     = wp_unslash( $_POST['channel_contact_desc'] ?? [] );
        $ch_btn1_texts = wp_unslash( $_POST['channel_btn_primary_text'] ?? [] );
        $ch_btn1_urls  = wp_unslash( $_POST['channel_btn_primary_url'] ?? [] );
        $ch_btn2_texts = wp_unslash( $_POST['channel_btn_secondary_text'] ?? [] );
        $ch_btn2_urls  = wp_unslash( $_POST['channel_btn_secondary_url'] ?? [] );
        $ch_urutans    = wp_unslash( $_POST['channel_urutan'] ?? [] );

        $channels = [];
        for ( $i = 0; $i < count( $ch_titles ); $i++ ) {
            $t = sanitize_text_field( $ch_titles[$i] ?? '' );
            if ( empty( $t ) ) {
                continue;
            }
            $channels[] = [
                'title'              => $t,
                'badge'              => sanitize_text_field( $ch_badges[$i] ?? '' ),
                'tag'                => sanitize_text_field( $ch_tags[$i] ?? '' ),
                'color'              => sanitize_key( $ch_colors[$i] ?? 'emerald' ),
                'desc'               => sanitize_textarea_field( $ch_descs[$i] ?? '' ),
                'status_tag'         => sanitize_text_field( $ch_statuses[$i] ?? '' ),
                'contact_wa'         => sanitize_text_field( $ch_was[$i] ?? '' ),
                'contact_phone'      => sanitize_text_field( $ch_phones[$i] ?? '' ),
                'contact_email'      => sanitize_email( $ch_emails[$i] ?? '' ),
                'contact_desc'       => sanitize_text_field( $ch_cdescs[$i] ?? '' ),
                'btn_primary_text'   => sanitize_text_field( $ch_btn1_texts[$i] ?? '' ),
                'btn_primary_url'    => esc_url_raw( $ch_btn1_urls[$i] ?? '' ),
                'btn_secondary_text' => sanitize_text_field( $ch_btn2_texts[$i] ?? '' ),
                'btn_secondary_url'  => esc_url_raw( $ch_btn2_urls[$i] ?? '' ),
                'urutan'             => intval( $ch_urutans[$i] ?? ($i + 1) ),
            ];
        }

        // Sort by urutan
        usort( $channels, function( $a, $b ) {
            return $a['urutan'] <=> $b['urutan'];
        });
        update_option( 'options_pengaduan_channels', $channels );

        // Sinkronisasi kontak utama untuk keperluan kompatibilitas
        if ( ! empty( $channels[0] ) ) {
            if ( ! empty( $channels[0]['contact_wa'] ) ) {
                update_option( 'options_pengaduan_wa', $channels[0]['contact_wa'] );
            }
            if ( ! empty( $channels[0]['contact_phone'] ) ) {
                update_option( 'options_pengaduan_phone', $channels[0]['contact_phone'] );
            }
            if ( ! empty( $channels[0]['contact_email'] ) ) {
                update_option( 'options_pengaduan_email', $channels[0]['contact_email'] );
            }
        }
        if ( ! empty( $channels[1] ) && ! empty( $channels[1]['btn_primary_url'] ) ) {
            update_option( 'options_pengaduan_ojk_appk_url', $channels[1]['btn_primary_url'] );
        }

        // 4. Infografis Bagan Alur Lengkap
        update_option( 'options_pengaduan_infografis_image', esc_url_raw( $_POST['options_pengaduan_infografis_image'] ?? '' ) );
        update_option( 'options_pengaduan_infografis_title', sanitize_text_field( $_POST['options_pengaduan_infografis_title'] ?? '' ) );
        update_option( 'options_pengaduan_infografis_desc', sanitize_textarea_field( $_POST['options_pengaduan_infografis_desc'] ?? '' ) );

        // 5. Simpan Repeater Tahapan Alur Bergambar (Steps)
        $st_numbers = wp_unslash( $_POST['step_number'] ?? [] );
        $st_badges  = wp_unslash( $_POST['step_badge'] ?? [] );
        $st_titles  = wp_unslash( $_POST['step_title'] ?? [] );
        $st_descs   = wp_unslash( $_POST['step_desc'] ?? [] );
        $st_outputs = wp_unslash( $_POST['step_output'] ?? [] );
        $st_images  = wp_unslash( $_POST['step_image'] ?? [] );
        $st_captions= wp_unslash( $_POST['step_caption'] ?? [] );
        $st_urutans = wp_unslash( $_POST['step_urutan'] ?? [] );

        $steps = [];
        for ( $j = 0; $j < count( $st_titles ); $j++ ) {
            $st_title = sanitize_text_field( $st_titles[$j] ?? '' );
            if ( empty( $st_title ) ) {
                continue;
            }
            $steps[] = [
                'number'  => sanitize_text_field( $st_numbers[$j] ?? sprintf('%02d', $j + 1) ),
                'badge'   => sanitize_text_field( $st_badges[$j] ?? '' ),
                'title'   => $st_title,
                'desc'    => sanitize_textarea_field( $st_descs[$j] ?? '' ),
                'output'  => sanitize_text_field( $st_outputs[$j] ?? '' ),
                'image'   => esc_url_raw( $st_images[$j] ?? '' ),
                'caption' => sanitize_text_field( $st_captions[$j] ?? '' ),
                'urutan'  => intval( $st_urutans[$j] ?? ($j + 1) ),
            ];
        }

        // Sort by urutan
        usort( $steps, function( $a, $b ) {
            return $a['urutan'] <=> $b['urutan'];
        });
        update_option( 'options_pengaduan_steps', $steps );

        // 6. Standar Waktu Resmi (SLA POJK No. 22/2023)
        update_option( 'options_pengaduan_sla_title', sanitize_text_field( $_POST['options_pengaduan_sla_title'] ?? '' ) );
        update_option( 'options_pengaduan_sla_subtitle', sanitize_textarea_field( $_POST['options_pengaduan_sla_subtitle'] ?? '' ) );
        
        update_option( 'options_pengaduan_sla_card1_title', sanitize_text_field( $_POST['options_pengaduan_sla_card1_title'] ?? '' ) );
        update_option( 'options_pengaduan_sla_card1_badge', sanitize_text_field( $_POST['options_pengaduan_sla_card1_badge'] ?? '' ) );
        update_option( 'options_pengaduan_sla_card1_time', sanitize_text_field( $_POST['options_pengaduan_sla_card1_time'] ?? '' ) );
        update_option( 'options_pengaduan_sla_card1_label', sanitize_text_field( $_POST['options_pengaduan_sla_card1_label'] ?? '' ) );
        update_option( 'options_pengaduan_sla_card1_desc', sanitize_textarea_field( $_POST['options_pengaduan_sla_card1_desc'] ?? '' ) );
        update_option( 'options_pengaduan_sla_card1_points', sanitize_textarea_field( $_POST['options_pengaduan_sla_card1_points'] ?? '' ) );

        update_option( 'options_pengaduan_sla_card2_title', sanitize_text_field( $_POST['options_pengaduan_sla_card2_title'] ?? '' ) );
        update_option( 'options_pengaduan_sla_card2_badge', sanitize_text_field( $_POST['options_pengaduan_sla_card2_badge'] ?? '' ) );
        update_option( 'options_pengaduan_sla_card2_time', sanitize_text_field( $_POST['options_pengaduan_sla_card2_time'] ?? '' ) );
        update_option( 'options_pengaduan_sla_card2_label', sanitize_text_field( $_POST['options_pengaduan_sla_card2_label'] ?? '' ) );
        update_option( 'options_pengaduan_sla_card2_desc', sanitize_textarea_field( $_POST['options_pengaduan_sla_card2_desc'] ?? '' ) );
        update_option( 'options_pengaduan_sla_card2_points', sanitize_textarea_field( $_POST['options_pengaduan_sla_card2_points'] ?? '' ) );

        update_option( 'options_pengaduan_sla_note', sanitize_textarea_field( $_POST['options_pengaduan_sla_note'] ?? '' ) );
        
        // Sync legacy SLA values
        $sla1_time = sanitize_text_field( $_POST['options_pengaduan_sla_card1_time'] ?? '20 Hari Kerja' );
        update_option( 'options_pengaduan_sla_tertulis', $sla1_time );
        update_option( 'options_pengaduan_sla_lisan', $sla1_time );

        // 7. Berkas Formulir Fisik (PDF)
        update_option( 'options_pengaduan_form_pdf_url', esc_url_raw( $_POST['options_pengaduan_form_pdf_url'] ?? '' ) );

        // 8. Card Badge Keamanan & Transparansi Hero
        update_option( 'options_pengaduan_hero_trust_show', isset( $_POST['options_pengaduan_hero_trust_show'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_hero_trust_badge', sanitize_text_field( $_POST['options_pengaduan_hero_trust_badge'] ?? '' ) );
        update_option( 'options_pengaduan_hero_trust_title', sanitize_text_field( $_POST['options_pengaduan_hero_trust_title'] ?? '' ) );
        update_option( 'options_pengaduan_hero_trust_desc', sanitize_textarea_field( $_POST['options_pengaduan_hero_trust_desc'] ?? '' ) );
        update_option( 'options_pengaduan_hero_trust_p1', sanitize_text_field( $_POST['options_pengaduan_hero_trust_p1'] ?? '' ) );
        update_option( 'options_pengaduan_hero_trust_p2', sanitize_text_field( $_POST['options_pengaduan_hero_trust_p2'] ?? '' ) );
        update_option( 'options_pengaduan_hero_trust_p3', sanitize_text_field( $_POST['options_pengaduan_hero_trust_p3'] ?? '' ) );
        update_option( 'options_pengaduan_hero_trust_p4', sanitize_text_field( $_POST['options_pengaduan_hero_trust_p4'] ?? '' ) );
        update_option( 'options_pengaduan_hero_trust_seal', sanitize_text_field( $_POST['options_pengaduan_hero_trust_seal'] ?? '' ) );

        // 9. Pengaturan Pratinjau Beranda
        update_option( 'options_pengaduan_home_badge', sanitize_text_field( $_POST['options_pengaduan_home_badge'] ?? '' ) );
        update_option( 'options_pengaduan_home_title', sanitize_text_field( $_POST['options_pengaduan_home_title'] ?? '' ) );
        update_option( 'options_pengaduan_home_desc', sanitize_textarea_field( $_POST['options_pengaduan_home_desc'] ?? '' ) );
        update_option( 'options_pengaduan_home_btn_text', sanitize_text_field( $_POST['options_pengaduan_home_btn_text'] ?? '' ) );

        $message = '✅ Pengaturan Layanan Pengaduan Konsumen berhasil disimpan!';
    }

    $cfg = wakalumi_get_pengaduan_settings();
    ?>
    <div class="wrap" style="max-width: 1040px; margin-top: 20px;">
        
        <!-- HEADER ADMIN BANNER -->
        <div style="background: linear-gradient(135deg, #088395 0%, #0a4d68 100%); color: #fff; padding: 24px 30px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 14px rgba(8, 131, 149, 0.2);">
            <div style="display: flex; align-items: center; gap: 14px;">
                <span style="font-size: 34px; line-height: 1;">🛡️</span>
                <div>
                    <h1 style="color: #fff; margin: 0; font-size: 22px; font-weight: 800;">Pengelolaan Layanan Pengaduan Konsumen</h1>
                    <p style="margin: 5px 0 0 0; opacity: 0.95; font-size: 13px;">
                        Kustomisasi dinamis kartu saluran pengaduan (Bank &amp; Eskalasi OJK), ruang panduan visual &amp; infografis alur tim media, standar waktu SLA dinamis (POJK No. 22/2023), serta berkas formulir pengaduan.
                    </p>
                </div>
            </div>
        </div>

        <?php if ( ! empty( $message ) ) : ?>
            <div class="notice notice-success is-dismissible" style="border-radius: 8px; font-weight: 600;">
                <p><?php echo esc_html( $message ); ?></p>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <?php wp_nonce_field( 'wakalumi_pengaduan_action', 'wakalumi_pengaduan_nonce' ); ?>

            <!-- KARTU 0: PENGATURAN VISIBILITAS SEKSI HALAMAN -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #475569; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #1e293b; margin: 0 0 8px 0; display: flex; align-items: center; gap: 8px;">
                    <span>⚙️</span> Visibilitas Seksi Halaman
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 18px;">
                    Centang atau hapus centang untuk menampilkan atau menyembunyikan bagian halaman di frontend:
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <!-- Toggle Saluran Pengaduan -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_channels_show" value="1" <?php checked( $cfg['channels_show'] ); ?> style="width: 18px; height: 18px; margin-top: 2px; accent-color: #088395;">
                            <div>
                                <span style="font-size: 13px; font-weight: 700; color: #0f172a; display: block;">Seksi Kartu Saluran Pengaduan</span>
                                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">
                                    Kartu saluran aduan Bank Syariah Wakalumi dan eskalasi regulator OJK / LAPS SJK.
                                </small>
                            </div>
                        </label>
                    </div>

                    <!-- Toggle Seksi Alur Prosedur -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_alur_show" value="1" <?php checked( $cfg['alur_show'] ); ?> style="width: 18px; height: 18px; margin-top: 2px; accent-color: #088395;">
                            <div>
                                <span style="font-size: 13px; font-weight: 700; color: #0f172a; display: block;">Seksi Tahapan Alur Prosedur</span>
                                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">
                                    Langkah-langkah penanganan aduan (bisa disertai gambar &amp; caption oleh tim media).
                                </small>
                            </div>
                        </label>
                    </div>

                    <!-- Toggle Infografis Banner Alur Lengkap -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_infografis_show" value="1" <?php checked( $cfg['infografis_show'] ); ?> style="width: 18px; height: 18px; margin-top: 2px; accent-color: #0284c7;">
                            <div>
                                <span style="font-size: 13px; font-weight: 700; color: #0f172a; display: block;">Banner Infografis Alur Lengkap (Tim Media)</span>
                                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">
                                    Tampilkan poster/infografis bagan alur resolusi tinggi dengan fitur modal perbesar.
                                </small>
                            </div>
                        </label>
                    </div>

                    <!-- Toggle Seksi SLA -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_sla_show" value="1" <?php checked( $cfg['sla_show'] ); ?> style="width: 18px; height: 18px; margin-top: 2px; accent-color: #d97706;">
                            <div>
                                <span style="font-size: 13px; font-weight: 700; color: #0f172a; display: block;">Seksi Standar Waktu Layanan (SLA)</span>
                                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">
                                    Batas waktu penyelesaian oleh bank (default: 20 hari kerja) &amp; ketentuan perpanjangan.
                                </small>
                            </div>
                        </label>
                    </div>

                    <!-- Toggle Seksi Panduan Dokumen -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_panduan_show" value="1" <?php checked( $cfg['panduan_show'] ); ?> style="width: 18px; height: 18px; margin-top: 2px; accent-color: #088395;">
                            <div>
                                <span style="font-size: 13px; font-weight: 700; color: #0f172a; display: block;">Seksi Panduan &amp; Checklist Dokumen</span>
                                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">
                                    Daftar berkas wajib (KTP, Rekening/Akad, Bukti Transaksi, Surat Kuasa).
                                </small>
                            </div>
                        </label>
                    </div>

                    <!-- Toggle Formulir PDF -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_show_form_pdf" value="1" <?php checked( $cfg['show_form_pdf'] ); ?> style="width: 18px; height: 18px; margin-top: 2px; accent-color: #2563eb;">
                            <div>
                                <span style="font-size: 13px; font-weight: 700; color: #0f172a; display: block;">Slot Unduh Formulir Fisik (PDF)</span>
                                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">
                                    Aktifkan jika berkas PDF formulir cetak sudah siap diunggah.
                                </small>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- KARTU 1: MANAJEMEN KARTU SALURAN PENGADUAN (REPEATER DINAMIS) -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #088395; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                    <div>
                        <h2 style="font-size: 16px; font-weight: 800; color: #088395; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <span>🏢</span> 1. Kartu Saluran Pengaduan Konsumen (Bisa Diedit &amp; Ditambah)
                        </h2>
                        <p style="font-size: 12px; color: #64748b; margin: 4px 0 0 0;">
                            Pengaduan ke bank (Internal Bank Syariah Wakalumi), eskalasi ke OJK (Kontak 157) jika tidak ditindaklanjuti/tidak sepakat, atau saluran lainnya. Anda dapat mengubah teks, tema warna, detail kontak, tombol aksi, serta menambah kartu baru.
                        </p>
                    </div>
                    <button type="button" id="wkl-add-channel-btn" class="button button-secondary" style="border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 5px; flex-shrink: 0; border-color: #088395; color: #088395;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> Tambah Kartu Saluran
                    </button>
                </div>

                <!-- Container Repeater Cards -->
                <div id="wkl-channels-container" style="display: flex; flex-direction: column; gap: 18px; margin-top: 16px;">
                    <?php 
                    $channels_list = ! empty( $cfg['channels'] ) ? $cfg['channels'] : wakalumi_get_default_pengaduan_channels();
                    foreach ( $channels_list as $idx => $ch ) : 
                    ?>
                        <div class="wkl-channel-item" style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 8px; padding: 18px; position: relative;">
                            
                            <!-- Header Item -->
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="background: #088395; color: #fff; font-size: 11px; font-weight: 800; padding: 3px 8px; border-radius: 4px;">
                                        KARTU #<span class="wkl-card-num"><?php echo esc_html( $idx + 1 ); ?></span>
                                    </span>
                                    <strong style="color: #0f172a; font-size: 14px;" class="wkl-channel-item-title">
                                        <?php echo esc_html( $ch['title'] ); ?>
                                    </strong>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <label style="font-size: 11px; color: #64748b; font-weight: 600;">Urutan:</label>
                                    <input type="number" name="channel_urutan[]" value="<?php echo esc_attr( $ch['urutan'] ?? ($idx + 1) ); ?>" style="width: 55px; height: 28px; border-radius: 4px; padding: 2px 6px; font-size: 12px; border: 1px solid #cbd5e1;">
                                    <button type="button" class="button-link wkl-remove-channel-btn" style="color: #ef4444; font-size: 12px; font-weight: 700; text-decoration: none; padding: 4px 8px;" title="Hapus Kartu">
                                        ✕ Hapus
                                    </button>
                                </div>
                            </div>

                            <!-- Baris 1: Judul, Tema Warna, Badge, Tag -->
                            <div style="display: grid; grid-template-columns: 2fr 1.5fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Judul Kartu Pengaduan</label>
                                    <input type="text" name="channel_title[]" value="<?php echo esc_attr( $ch['title'] ); ?>" class="wkl-title-input" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 700;" placeholder="Contoh: Pengaduan Langsung ke Bank Syariah Wakalumi">
                                </div>
                                <div>
                                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">🎨 Tema Warna Aksen</label>
                                    <select name="channel_color[]" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                                        <?php echo wakalumi_render_pengaduan_color_options( $ch['color'] ?? 'emerald' ); ?>
                                    </select>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Badge Kiri Atas</label>
                                    <input type="text" name="channel_badge[]" value="<?php echo esc_attr( $ch['badge'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;" placeholder="Tahap 1: Saluran Resmi Bank">
                                </div>
                                <div>
                                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Tag Kanan Header</label>
                                    <input type="text" name="channel_tag[]" value="<?php echo esc_attr( $ch['tag'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;" placeholder="Bebas Biaya / Jika Belum Sepakat">
                                </div>
                                <div>
                                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Status Tag Operasional</label>
                                    <input type="text" name="channel_status_tag[]" value="<?php echo esc_attr( $ch['status_tag'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;" placeholder="Chat Aktif / Portal Regulator">
                                </div>
                            </div>

                            <!-- Baris 2: Deskripsi -->
                            <div style="margin-bottom: 12px;">
                                <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Keterangan / Paragraf Pengantar Kartu</label>
                                <textarea name="channel_desc[]" rows="2" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-size: 12px;"><?php echo esc_textarea( $ch['desc'] ); ?></textarea>
                            </div>

                            <!-- Baris 3: Detail Saluran Kontak / Informasi Tambahan -->
                            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px; margin-bottom: 12px;">
                                <div style="font-weight: 700; font-size: 11px; color: #088395; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                                    📞 Saluran Kontak &amp; Operasional
                                </div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 8px;">
                                    <div>
                                        <label style="font-size: 11px; font-weight: 600; color: #475569; display: block; margin-bottom: 3px;">Nomor WhatsApp</label>
                                        <input type="text" name="channel_contact_wa[]" value="<?php echo esc_attr( $ch['contact_wa'] ?? '' ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;" placeholder="6281517380388 atau 081 157 157 157">
                                    </div>
                                    <div>
                                        <label style="font-size: 11px; font-weight: 600; color: #475569; display: block; margin-bottom: 3px;">Nomor Telepon / Hotline</label>
                                        <input type="text" name="channel_contact_phone[]" value="<?php echo esc_attr( $ch['contact_phone'] ?? '' ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;" placeholder="(021) 7471 4555 atau 157">
                                    </div>
                                </div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                                    <div>
                                        <label style="font-size: 11px; font-weight: 600; color: #475569; display: block; margin-bottom: 3px;">Email / Tautan Tambahan</label>
                                        <input type="text" name="channel_contact_email[]" value="<?php echo esc_attr( $ch['contact_email'] ?? '' ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;" placeholder="pengaduan@wakalumibprs.co.id">
                                    </div>
                                    <div>
                                        <label style="font-size: 11px; font-weight: 600; color: #475569; display: block; margin-bottom: 3px;">Keterangan Lokasi / Jam Kerja / Portal</label>
                                        <input type="text" name="channel_contact_desc[]" value="<?php echo esc_attr( $ch['contact_desc'] ?? '' ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;" placeholder="Kantor Pusat &amp; Jaringan Kantor Kas...">
                                    </div>
                                </div>
                            </div>

                            <!-- Baris 4: Tombol Aksi -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                                <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px;">
                                    <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Tombol Aksi Utama</label>
                                    <input type="text" name="channel_btn_primary_text[]" value="<?php echo esc_attr( $ch['btn_primary_text'] ?? '' ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px; margin-bottom: 5px;" placeholder="Teks Tombol, misal: Kirim via WA / Buka Portal OJK">
                                    <input type="text" name="channel_btn_primary_url[]" value="<?php echo esc_attr( $ch['btn_primary_url'] ?? '' ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 11px;" placeholder="URL Tujuan (Kosongkan untuk otomatis WA/Hotline)">
                                </div>
                                <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px;">
                                    <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Tombol Aksi Sekunder (Opsional)</label>
                                    <input type="text" name="channel_btn_secondary_text[]" value="<?php echo esc_attr( $ch['btn_secondary_text'] ?? '' ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px; margin-bottom: 5px;" placeholder="Teks Tombol, misal: Kirim Email / Portal LAPS SJK">
                                    <input type="text" name="channel_btn_secondary_url[]" value="<?php echo esc_attr( $ch['btn_secondary_url'] ?? '' ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 11px;" placeholder="URL Tujuan (Kosongkan untuk otomatis Mailto)">
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- KARTU 2: VISUAL GUIDE ALUR PENGADUAN (INFOGRAFIS & TAHAPAN GAMBAR TIM MEDIA) -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #0284c7; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #0284c7; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>🖼️</span> 2. Panduan Visual Alur Pengaduan (Infografis &amp; Tahapan Media)
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: -10px; margin-bottom: 18px;">
                    Sediakan ruang representasi visual jika tim media bank memiliki gambaran infografis alur pengaduan atau tahapan bergambar (bukan hanya tulisan). Setiap gambar dapat diunggah dengan mudah melalui WordPress Media Library dan dilengkapi caption.
                </p>

                <!-- Sub-Seksi A: Banner Infografis Alur Lengkap -->
                <div style="background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 8px; padding: 16px; margin-bottom: 22px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <label style="font-size: 13px; font-weight: 800; color: #0369a1; display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_infografis_show" value="1" <?php checked( $cfg['infografis_show'] ); ?> style="accent-color: #0284c7;">
                            Tampilkan Banner Infografis Bagan Alur Pengaduan (Poster Lengkap)
                        </label>
                        <span style="font-size: 11px; background: #e0f2fe; color: #0369a1; padding: 2px 8px; border-radius: 4px; font-weight: 700;">Tim Media Slot</span>
                    </div>
                    <small style="color: #075985; font-size: 11px; display: block; margin-bottom: 14px;">
                        Jika tim media membuat 1 gambar poster/bagan alur utuh pengaduan nasabah, unggah di sini. Frontend akan menyediakan tombol perbesar modal lightbox resolusi penuh.
                    </small>

                    <div style="margin-bottom: 12px;">
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Unggah Gambar Infografis Alur (JPG/PNG/WebP Resolusi Tinggi)</label>
                        <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                            <img id="wkl_infografis_preview" src="<?php echo esc_url( $cfg['infografis_image'] ); ?>" style="max-width: 140px; max-height: 90px; border-radius: 6px; border: 1px solid #cbd5e1; object-fit: cover; <?php echo empty( $cfg['infografis_image'] ) ? 'display:none;' : ''; ?>" />
                            <div style="display: flex; flex-direction: column; gap: 5px;">
                                <button type="button" class="button wkl-upload-btn" data-target="wkl_infografis_input" data-preview="wkl_infografis_preview" style="font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                                    <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah Gambar Infografis
                                </button>
                                <button type="button" class="button-link wkl-remove-btn" data-target="wkl_infografis_input" data-preview="wkl_infografis_preview" style="color: #ef4444; font-size: 11px; <?php echo empty( $cfg['infografis_image'] ) ? 'display:none;' : ''; ?>">
                                    ✕ Hapus Gambar
                                </button>
                            </div>
                            <input type="text" id="wkl_infografis_input" name="options_pengaduan_infografis_image" value="<?php echo esc_attr( $cfg['infografis_image'] ); ?>" class="regular-text wkl-foto-input" placeholder="URL gambar atau unggah via tombol..." style="flex: 1; min-width: 220px; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 12px;">
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Judul Infografis</label>
                            <input type="text" name="options_pengaduan_infografis_title" value="<?php echo esc_attr( $cfg['infografis_title'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        </div>
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Caption / Deskripsi Singkat Infografis</label>
                            <input type="text" name="options_pengaduan_infografis_desc" value="<?php echo esc_attr( $cfg['infografis_desc'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        </div>
                    </div>
                </div>

                <!-- Sub-Seksi B: Repeater Tahapan Alur Langkah (Step-by-Step dengan Gambar & Caption) -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                    <div>
                        <strong style="color: #0f172a; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">
                            📋 Urutan Langkah &amp; Gambar Tahapan Alur Pengaduan
                        </strong>
                        <p style="font-size: 11px; color: #64748b; margin: 2px 0 0 0;">
                            Setiap tahapan dapat dilengkapi gambar ilustrasi / diagram alur manual oleh admin beserta caption penjelasan. Jika gambar belum diisi, frontend akan menampilkan ikon vektor elegan secara otomatis.
                        </p>
                    </div>
                    <button type="button" id="wkl-add-step-btn" class="button button-secondary" style="border-radius: 6px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px; font-size: 12px;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 15px; width: 15px; height: 15px;"></span> Tambah Langkah Alur
                    </button>
                </div>

                <div id="wkl-steps-container" style="display: flex; flex-direction: column; gap: 14px;">
                    <?php 
                    $steps_list = ! empty( $cfg['steps'] ) ? $cfg['steps'] : wakalumi_get_default_pengaduan_steps();
                    foreach ( $steps_list as $s_idx => $step ) :
                        $preview_id = 'wkl_step_prev_' . $s_idx;
                        $input_id   = 'wkl_step_in_' . $s_idx;
                    ?>
                        <div class="wkl-step-item" style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 14px 16px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span style="background: #0284c7; color: #fff; font-size: 11px; font-weight: 800; padding: 2px 7px; border-radius: 4px;">
                                        STEP <span class="wkl-step-num"><?php echo esc_html( $step['number'] ?? sprintf('%02d', $s_idx + 1) ); ?></span>
                                    </span>
                                    <strong style="color: #0f172a; font-size: 13px;" class="wkl-step-item-title">
                                        <?php echo esc_html( $step['title'] ); ?>
                                    </strong>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <label style="font-size: 11px; color: #64748b;">Urutan:</label>
                                    <input type="number" name="step_urutan[]" value="<?php echo esc_attr( $step['urutan'] ?? ($s_idx + 1) ); ?>" style="width: 50px; height: 26px; border-radius: 4px; padding: 2px 4px; font-size: 11px; border: 1px solid #cbd5e1;">
                                    <button type="button" class="button-link wkl-remove-step-btn" style="color: #ef4444; font-size: 11px; font-weight: 700; text-decoration: none;" title="Hapus Tahap">
                                        ✕ Hapus
                                    </button>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 80px 1.5fr 2fr; gap: 10px; margin-bottom: 10px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 3px;">Nomor</label>
                                    <input type="text" name="step_number[]" value="<?php echo esc_attr( $step['number'] ?? sprintf('%02d', $s_idx + 1) ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-weight: 800; text-align: center;">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 3px;">Badge Sub-judul</label>
                                    <input type="text" name="step_badge[]" value="<?php echo esc_attr( $step['badge'] ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1;" placeholder="Langkah Awal / Langkah Kedua...">
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 3px;">Judul Tahapan</label>
                                    <input type="text" name="step_title[]" value="<?php echo esc_attr( $step['title'] ); ?>" class="wkl-step-title-input" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-weight: 700;">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 10px; margin-bottom: 10px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 3px;">Keterangan / Penjelasan Prosedur</label>
                                    <textarea name="step_desc[]" rows="2" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;"><?php echo esc_textarea( $step['desc'] ); ?></textarea>
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 3px;">Output Hasil Tahap</label>
                                    <input type="text" name="step_output[]" value="<?php echo esc_attr( $step['output'] ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 11px;" placeholder="Output: Nomor Registrasi Aduan">
                                </div>
                            </div>

                            <!-- Gambar Tahapan & Caption -->
                            <div style="background: #ffffff; border: 1px dashed #cbd5e1; border-radius: 6px; padding: 10px;">
                                <label style="font-size: 11px; font-weight: 700; color: #0284c7; display: block; margin-bottom: 4px;">
                                    📷 Gambar Panduan Visual Tahap Ini (Opsional untuk Tim Media)
                                </label>
                                <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap; margin-bottom: 6px;">
                                    <img id="<?php echo esc_attr( $preview_id ); ?>" src="<?php echo esc_url( $step['image'] ?? '' ); ?>" style="max-width: 100px; max-height: 60px; border-radius: 4px; border: 1px solid #cbd5e1; object-fit: cover; <?php echo empty( $step['image'] ) ? 'display:none;' : ''; ?>" />
                                    <div style="display: flex; gap: 4px;">
                                        <button type="button" class="button wkl-upload-btn" data-target="<?php echo esc_attr( $input_id ); ?>" data-preview="<?php echo esc_attr( $preview_id ); ?>" style="font-size: 11px; padding: 2px 8px; height: 28px;">
                                            Unggah Gambar Step
                                        </button>
                                        <button type="button" class="button-link wkl-remove-btn" data-target="<?php echo esc_attr( $input_id ); ?>" data-preview="<?php echo esc_attr( $preview_id ); ?>" style="color: #ef4444; font-size: 11px; <?php echo empty( $step['image'] ) ? 'display:none;' : ''; ?>">
                                            ✕ Hapus
                                        </button>
                                    </div>
                                    <input type="text" id="<?php echo esc_attr( $input_id ); ?>" name="step_image[]" value="<?php echo esc_attr( $step['image'] ?? '' ); ?>" class="regular-text wkl-foto-input" placeholder="URL gambar atau unggah via tombol..." style="flex: 1; min-width: 180px; border-radius: 4px; padding: 4px 8px; font-size: 11px; border: 1px solid #cbd5e1;">
                                </div>
                                <input type="text" name="step_caption[]" value="<?php echo esc_attr( $step['caption'] ?? '' ); ?>" placeholder="Caption keterangan gambar tahapan ini (jika ada)..." style="width: 100%; border-radius: 4px; padding: 4px 8px; font-size: 11px; border: 1px solid #e2e8f0;">
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- KARTU 3: STANDAR WAKTU PENYELESAIAN (SLA POJK NO. 22/2023 DINAMIS) -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #f59e0b; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #b45309; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>⏱️</span> 3. Standar Waktu Layanan Pengaduan (SLA POJK No. 22/2023 Dinamis)
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: -10px; margin-bottom: 18px;">
                    Batas waktu penyelesaian pengaduan dapat diatur secara leluasa. Sesuai POJK No. 22 Tahun 2023, standar waktu penyelesaian pengaduan oleh bank adalah maksimal <strong>20 Hari Kerja</strong> (dapat diperpanjang 20 hari kerja lagi).
                </p>

                <!-- Judul & Subjudul Seksi SLA -->
                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 14px; margin-bottom: 16px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Judul Seksi SLA</label>
                        <input type="text" name="options_pengaduan_sla_title" value="<?php echo esc_attr( $cfg['sla_title'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 700;">
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Sub-judul / Penjelasan Komitmen</label>
                        <input type="text" name="options_pengaduan_sla_subtitle" value="<?php echo esc_attr( $cfg['sla_subtitle'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                    </div>
                </div>

                <!-- 2 Kartu SLA: Kartu 1 (Penyelesaian oleh Bank) & Kartu 2 (Perpanjangan / Kondisi Tertentu) -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 18px;">
                    
                    <!-- KARTU SLA 1 -->
                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 14px 16px;">
                        <strong style="color: #166534; font-size: 13px; display: block; margin-bottom: 8px;">
                            📌 Kartu SLA 1: Penyelesaian Pengaduan oleh Bank
                        </strong>
                        <div style="margin-bottom: 8px;">
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Judul Kartu SLA 1</label>
                            <input type="text" name="options_pengaduan_sla_card1_title" value="<?php echo esc_attr( $cfg['sla_card1_title'] ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;">
                        </div>
                        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 8px; margin-bottom: 8px;">
                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Batas Waktu / Durasi (Angka/Hari)</label>
                                <input type="text" name="options_pengaduan_sla_card1_time" value="<?php echo esc_attr( $cfg['sla_card1_time'] ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-weight: 800; color: #16a34a; font-size: 13px;" placeholder="20 Hari Kerja">
                            </div>
                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Label Keterangan</label>
                                <input type="text" name="options_pengaduan_sla_card1_label" value="<?php echo esc_attr( $cfg['sla_card1_label'] ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;" placeholder="Maksimal">
                            </div>
                        </div>
                        <div style="margin-bottom: 8px;">
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Badge Kanan Atas</label>
                            <input type="text" name="options_pengaduan_sla_card1_badge" value="<?php echo esc_attr( $cfg['sla_card1_badge'] ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;">
                        </div>
                        <div style="margin-bottom: 8px;">
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Deskripsi Penjelasan</label>
                            <textarea name="options_pengaduan_sla_card1_desc" rows="2" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 11px;"><?php echo esc_textarea( $cfg['sla_card1_desc'] ); ?></textarea>
                        </div>
                        <div>
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Poin Checklist (Satu per baris)</label>
                            <textarea name="options_pengaduan_sla_card1_points" rows="2" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 11px;"><?php echo esc_textarea( $cfg['sla_card1_points'] ); ?></textarea>
                        </div>
                    </div>

                    <!-- KARTU SLA 2 -->
                    <div style="background: #f0fdfa; border: 1px solid #99f6e4; border-radius: 8px; padding: 14px 16px;">
                        <strong style="color: #0f766e; font-size: 13px; display: block; margin-bottom: 8px;">
                            📌 Kartu SLA 2: Kondisi Tertentu &amp; Perpanjangan
                        </strong>
                        <div style="margin-bottom: 8px;">
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Judul Kartu SLA 2</label>
                            <input type="text" name="options_pengaduan_sla_card2_title" value="<?php echo esc_attr( $cfg['sla_card2_title'] ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;">
                        </div>
                        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 8px; margin-bottom: 8px;">
                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Batas Waktu / Durasi</label>
                                <input type="text" name="options_pengaduan_sla_card2_time" value="<?php echo esc_attr( $cfg['sla_card2_time'] ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-weight: 800; color: #0d9488; font-size: 13px;" placeholder="+20 Hari Kerja">
                            </div>
                            <div>
                                <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Label Keterangan</label>
                                <input type="text" name="options_pengaduan_sla_card2_label" value="<?php echo esc_attr( $cfg['sla_card2_label'] ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;" placeholder="Kondisi Tertentu">
                            </div>
                        </div>
                        <div style="margin-bottom: 8px;">
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Badge Kanan Atas</label>
                            <input type="text" name="options_pengaduan_sla_card2_badge" value="<?php echo esc_attr( $cfg['sla_card2_badge'] ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;">
                        </div>
                        <div style="margin-bottom: 8px;">
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Deskripsi Penjelasan</label>
                            <textarea name="options_pengaduan_sla_card2_desc" rows="2" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 11px;"><?php echo esc_textarea( $cfg['sla_card2_desc'] ); ?></textarea>
                        </div>
                        <div>
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Poin Checklist (Satu per baris)</label>
                            <textarea name="options_pengaduan_sla_card2_points" rows="2" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 11px;"><?php echo esc_textarea( $cfg['sla_card2_points'] ); ?></textarea>
                        </div>
                    </div>

                </div>

                <div style="margin-bottom: 18px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Pita Ketentuan Hukum Perpanjangan Waktu (POJK No. 22/2023)</label>
                    <textarea name="options_pengaduan_sla_note" rows="2" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-size: 12px;"><?php echo esc_textarea( $cfg['sla_note'] ); ?></textarea>
                    <small style="color: #64748b; font-size: 11px;">Akan ditampilkan sebagai pita informasi hukum resmi di bawah kartu SLA.</small>
                </div>

                <!-- Formulir PDF Fisik -->
                <div style="border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Berkas PDF Formulir Pengaduan Fisik (Aktif jika opsi di seksi visibilitas dicentang)</label>
                    <div style="display: flex; gap: 8px; align-items: center;">
                        <input type="text" id="wkl_form_pdf_url" name="options_pengaduan_form_pdf_url" value="<?php echo esc_attr( $cfg['form_pdf_url'] ); ?>" placeholder="https://.../formulir-pengaduan-nasabah.pdf" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <button type="button" class="button wkl-upload-pengaduan-pdf" data-target="#wkl_form_pdf_url" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                            <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah Berkas PDF
                        </button>
                    </div>
                </div>

            </div>

            <!-- KARTU 4: HEADER BANNER & DISCLAIMER REGULASI -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #64748b; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #334155; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>📝</span> 4. Teks Header Banner &amp; Disclaimer Halaman
                </h2>

                <div style="margin-bottom: 14px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Kicker Badge Header</label>
                    <input type="text" name="options_pengaduan_badge" value="<?php echo esc_attr( $cfg['badge'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Judul Utama Halaman</label>
                    <input type="text" name="options_pengaduan_title" value="<?php echo esc_attr( $cfg['title'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Sub-judul / Penjelasan Singkat</label>
                    <textarea name="options_pengaduan_subtitle" rows="3" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"><?php echo esc_textarea( $cfg['subtitle'] ); ?></textarea>
                </div>

                <div style="margin-bottom: 18px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Pernyataan Regulasi OJK &amp; LPS (Footer Disclaimer)</label>
                    <input type="text" name="options_pengaduan_disclaimer" value="<?php echo esc_attr( $cfg['disclaimer'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>

                <!-- SUB-KARTU HERO TRUST & SECURITY BADGE -->
                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 16px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; border-bottom: 1px solid #dcfce7; padding-bottom: 8px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-size: 18px;">🛡️</span>
                            <strong style="color: #166534; font-size: 13px;">
                                Card Badge Keamanan &amp; Transparansi Hero Header
                            </strong>
                        </div>
                        <label style="display: inline-flex; align-items: center; gap: 6px; cursor: pointer; font-size: 12px; font-weight: 700; color: #166534;">
                            <input type="checkbox" name="options_pengaduan_hero_trust_show" value="1" <?php checked( $cfg['hero_trust_show'] ); ?>>
                            Tampilkan di Hero Halaman
                        </label>
                    </div>
                    
                    <p style="font-size: 11px; color: #15803d; margin: 0 0 12px 0;">
                        Card ini tampil elegan di sisi kanan Hero Header Pengaduan Konsumen untuk memberikan rasa aman, jaminan kerahasiaan 100%, transparansi status aduan, dan kepastian perlindungan regulasi OJK &amp; LPS.
                    </p>

                    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 12px; margin-bottom: 12px;">
                        <div>
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Kicker Badge Card</label>
                            <input type="text" name="options_pengaduan_hero_trust_badge" value="<?php echo esc_attr( $cfg['hero_trust_badge'] ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;">
                        </div>
                        <div>
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Judul Card Keamanan</label>
                            <input type="text" name="options_pengaduan_hero_trust_title" value="<?php echo esc_attr( $cfg['hero_trust_title'] ); ?>" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-weight: 700; font-size: 12px;">
                        </div>
                    </div>

                    <div style="margin-bottom: 12px;">
                        <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Deskripsi / Pesan Jaminan Nasabah</label>
                        <textarea name="options_pengaduan_hero_trust_desc" rows="2" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 11px;"><?php echo esc_textarea( $cfg['hero_trust_desc'] ); ?></textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px;">
                        <div>
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Poin 1: Jaminan Kerahasiaan</label>
                            <input type="text" name="options_pengaduan_hero_trust_p1" value="<?php echo esc_attr( $cfg['hero_trust_p1'] ); ?>" style="width: 100%; border-radius: 4px; padding: 5px 8px; border: 1px solid #cbd5e1; font-size: 11px;">
                        </div>
                        <div>
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Poin 2: Transparansi Nomor Registrasi</label>
                            <input type="text" name="options_pengaduan_hero_trust_p2" value="<?php echo esc_attr( $cfg['hero_trust_p2'] ); ?>" style="width: 100%; border-radius: 4px; padding: 5px 8px; border: 1px solid #cbd5e1; font-size: 11px;">
                        </div>
                        <div>
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Poin 3: 100% Bebas Biaya</label>
                            <input type="text" name="options_pengaduan_hero_trust_p3" value="<?php echo esc_attr( $cfg['hero_trust_p3'] ); ?>" style="width: 100%; border-radius: 4px; padding: 5px 8px; border: 1px solid #cbd5e1; font-size: 11px;">
                        </div>
                        <div>
                            <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Poin 4: Eskalasi Resmi Regulator</label>
                            <input type="text" name="options_pengaduan_hero_trust_p4" value="<?php echo esc_attr( $cfg['hero_trust_p4'] ); ?>" style="width: 100%; border-radius: 4px; padding: 5px 8px; border: 1px solid #cbd5e1; font-size: 11px;">
                        </div>
                    </div>

                    <div>
                        <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 3px;">Teks Segel Kepatuhan / Footer Card</label>
                        <input type="text" name="options_pengaduan_hero_trust_seal" value="<?php echo esc_attr( $cfg['hero_trust_seal'] ); ?>" style="width: 100%; border-radius: 4px; padding: 5px 8px; border: 1px solid #cbd5e1; font-size: 11px;">
                    </div>
                </div>

            <!-- KARTU 5: PENGATURAN PRATINJAU DI HALAMAN UTAMA (BERANDA) -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #0d9488; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #0d9488; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>🏠</span> 5. Kustomisasi Pratinjau di Halaman Utama (Beranda)
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: -10px; margin-bottom: 18px;">
                    Ubah teks judul, badge, deskripsi, dan tombol pada seksi pratinjau Layanan Pengaduan Konsumen yang tampil di Beranda (di atas CTA WhatsApp).
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 14px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Badge Regulasi Beranda</label>
                        <input type="text" name="options_pengaduan_home_badge" value="<?php echo esc_attr( $cfg['home_badge'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Teks Tombol Aksi Beranda</label>
                        <input type="text" name="options_pengaduan_home_btn_text" value="<?php echo esc_attr( $cfg['home_btn_text'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                    </div>
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Judul Seksi di Beranda</label>
                    <input type="text" name="options_pengaduan_home_title" value="<?php echo esc_attr( $cfg['home_title'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Deskripsi Ringkas di Beranda</label>
                    <textarea name="options_pengaduan_home_desc" rows="3" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"><?php echo esc_textarea( $cfg['home_desc'] ); ?></textarea>
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <div style="display: flex; justify-content: flex-end; padding-top: 10px; margin-bottom: 40px;">
                <button type="submit" class="button button-primary" style="background: #088395; border-color: #088395; font-weight: bold; padding: 9px 34px; border-radius: 8px; font-size: 14px;">
                    💾 Simpan Semua Pengaturan Pengaduan
                </button>
            </div>
        </form>
    </div>

    <!-- TEMPLATE UNDO/ADD JS UNTUK REPEATER SALURAN PENGADUAN -->
    <script type="text/template" id="tmpl-channel-card">
        <div class="wkl-channel-item" style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 8px; padding: 18px; position: relative;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="background: #088395; color: #fff; font-size: 11px; font-weight: 800; padding: 3px 8px; border-radius: 4px;">
                        KARTU #<span class="wkl-card-num">{{num}}</span>
                    </span>
                    <strong style="color: #0f172a; font-size: 14px;" class="wkl-channel-item-title">
                        Saluran Pengaduan Baru
                    </strong>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <label style="font-size: 11px; color: #64748b; font-weight: 600;">Urutan:</label>
                    <input type="number" name="channel_urutan[]" value="{{urutan}}" style="width: 55px; height: 28px; border-radius: 4px; padding: 2px 6px; font-size: 12px; border: 1px solid #cbd5e1;">
                    <button type="button" class="button-link wkl-remove-channel-btn" style="color: #ef4444; font-size: 12px; font-weight: 700; text-decoration: none; padding: 4px 8px;" title="Hapus Kartu">
                        ✕ Hapus
                    </button>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1.5fr; gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Judul Kartu Pengaduan</label>
                    <input type="text" name="channel_title[]" value="Saluran Pengaduan Baru" class="wkl-title-input" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 700;">
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">🎨 Tema Warna Aksen</label>
                    <select name="channel_color[]" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                        <?php echo wakalumi_render_pengaduan_color_options('blue'); ?>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                <div>
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Badge Kiri Atas</label>
                    <input type="text" name="channel_badge[]" value="Saluran Pendukung" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Tag Kanan Header</label>
                    <input type="text" name="channel_tag[]" value="Layanan Nasabah" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Status Tag Operasional</label>
                    <input type="text" name="channel_status_tag[]" value="Online" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>

            <div style="margin-bottom: 12px;">
                <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Keterangan / Paragraf Pengantar Kartu</label>
                <textarea name="channel_desc[]" rows="2" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-size: 12px;">Sampaikan pengaduan melalui saluran resmi ini untuk mendapatkan penanganan profesional.</textarea>
            </div>

            <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px; margin-bottom: 12px;">
                <div style="font-weight: 700; font-size: 11px; color: #088395; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                    📞 Saluran Kontak &amp; Operasional
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 8px;">
                    <div>
                        <label style="font-size: 11px; font-weight: 600; color: #475569; display: block; margin-bottom: 3px;">Nomor WhatsApp</label>
                        <input type="text" name="channel_contact_wa[]" value="" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;" placeholder="6281517380388">
                    </div>
                    <div>
                        <label style="font-size: 11px; font-weight: 600; color: #475569; display: block; margin-bottom: 3px;">Nomor Telepon / Hotline</label>
                        <input type="text" name="channel_contact_phone[]" value="" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;" placeholder="(021) ...">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div>
                        <label style="font-size: 11px; font-weight: 600; color: #475569; display: block; margin-bottom: 3px;">Email / Tautan Tambahan</label>
                        <input type="text" name="channel_contact_email[]" value="" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;" placeholder="pengaduan@...">
                    </div>
                    <div>
                        <label style="font-size: 11px; font-weight: 600; color: #475569; display: block; margin-bottom: 3px;">Keterangan Lokasi / Jam Kerja / Portal</label>
                        <input type="text" name="channel_contact_desc[]" value="" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;" placeholder="Senin – Jumat: 08.00 – 15.00 WIB">
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px;">
                    <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Tombol Aksi Utama</label>
                    <input type="text" name="channel_btn_primary_text[]" value="Hubungi Layanan" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px; margin-bottom: 5px;">
                    <input type="text" name="channel_btn_primary_url[]" value="" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 11px;" placeholder="URL Tujuan">
                </div>
                <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px;">
                    <label style="font-size: 11px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Tombol Aksi Sekunder (Opsional)</label>
                    <input type="text" name="channel_btn_secondary_text[]" value="" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px; margin-bottom: 5px;">
                    <input type="text" name="channel_btn_secondary_url[]" value="" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 11px;" placeholder="URL Tujuan">
                </div>
            </div>
        </div>
    </script>

    <!-- TEMPLATE UNDO/ADD JS UNTUK REPEATER TAHAPAN ALUR -->
    <script type="text/template" id="tmpl-step-card">
        <div class="wkl-step-item" style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 14px 16px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="background: #0284c7; color: #fff; font-size: 11px; font-weight: 800; padding: 2px 7px; border-radius: 4px;">
                        STEP <span class="wkl-step-num">{{stepnum}}</span>
                    </span>
                    <strong style="color: #0f172a; font-size: 13px;" class="wkl-step-item-title">
                        Tahapan Baru
                    </strong>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <label style="font-size: 11px; color: #64748b;">Urutan:</label>
                    <input type="number" name="step_urutan[]" value="{{urutan}}" style="width: 50px; height: 26px; border-radius: 4px; padding: 2px 4px; font-size: 11px; border: 1px solid #cbd5e1;">
                    <button type="button" class="button-link wkl-remove-step-btn" style="color: #ef4444; font-size: 11px; font-weight: 700; text-decoration: none;" title="Hapus Tahap">
                        ✕ Hapus
                    </button>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 80px 1.5fr 2fr; gap: 10px; margin-bottom: 10px;">
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 3px;">Nomor</label>
                    <input type="text" name="step_number[]" value="{{stepnum}}" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-weight: 800; text-align: center;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 3px;">Badge Sub-judul</label>
                    <input type="text" name="step_badge[]" value="Langkah Lanjutan" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1;">
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 3px;">Judul Tahapan</label>
                    <input type="text" name="step_title[]" value="Tahapan Baru" class="wkl-step-title-input" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-weight: 700;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 10px; margin-bottom: 10px;">
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 3px;">Keterangan / Penjelasan Prosedur</label>
                    <textarea name="step_desc[]" rows="2" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 12px;">Uraian tahapan prosedur pengaduan nasabah.</textarea>
                </div>
                <div>
                    <label style="font-size: 11px; font-weight: 700; color: #475569; display: block; margin-bottom: 3px;">Output Hasil Tahap</label>
                    <input type="text" name="step_output[]" value="Output: Dokumen Terkait" style="width: 100%; border-radius: 4px; padding: 6px 8px; border: 1px solid #cbd5e1; font-size: 11px;">
                </div>
            </div>

            <div style="background: #ffffff; border: 1px dashed #cbd5e1; border-radius: 6px; padding: 10px;">
                <label style="font-size: 11px; font-weight: 700; color: #0284c7; display: block; margin-bottom: 4px;">
                    📷 Gambar Panduan Visual Tahap Ini (Opsional untuk Tim Media)
                </label>
                <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap; margin-bottom: 6px;">
                    <img id="wkl_step_prev_{{idx}}" src="" style="max-width: 100px; max-height: 60px; border-radius: 4px; border: 1px solid #cbd5e1; object-fit: cover; display: none;" />
                    <div style="display: flex; gap: 4px;">
                        <button type="button" class="button wkl-upload-btn" data-target="wkl_step_in_{{idx}}" data-preview="wkl_step_prev_{{idx}}" style="font-size: 11px; padding: 2px 8px; height: 28px;">
                            Unggah Gambar Step
                        </button>
                        <button type="button" class="button-link wkl-remove-btn" data-target="wkl_step_in_{{idx}}" data-preview="wkl_step_prev_{{idx}}" style="color: #ef4444; font-size: 11px; display: none;">
                            ✕ Hapus
                        </button>
                    </div>
                    <input type="text" id="wkl_step_in_{{idx}}" name="step_image[]" value="" class="regular-text wkl-foto-input" placeholder="URL gambar atau unggah via tombol..." style="flex: 1; min-width: 180px; border-radius: 4px; padding: 4px 8px; font-size: 11px; border: 1px solid #cbd5e1;">
                </div>
                <input type="text" name="step_caption[]" value="" placeholder="Caption keterangan gambar tahapan ini (jika ada)..." style="width: 100%; border-radius: 4px; padding: 4px 8px; font-size: 11px; border: 1px solid #e2e8f0;">
            </div>
        </div>
    </script>

    <script type="text/javascript">
    jQuery(document).ready(function($) {
        
        // 1. WP Media Upload Logic Universal
        $(document).on('click', '.wkl-upload-btn', function(e) {
            e.preventDefault();
            var button    = $(this);
            var targetId  = button.data('target');
            var previewId = button.data('preview');
            var wrap      = button.closest('.wkl-upload-wrap');
            var removeBtn = wrap.find('.wkl-remove-btn');

            var frame = wp.media({
                title: 'Pilih atau Unggah Gambar Panduan Pengaduan',
                button: { text: 'Gunakan Gambar Ini' },
                library: { type: 'image' },
                multiple: false
            });

            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#' + targetId).val(attachment.url);
                $('#' + previewId).attr('src', attachment.url).show();
                removeBtn.show();
            });
            frame.open();
        });

        // 2. Remove Image Button
        $(document).on('click', '.wkl-remove-btn', function(e) {
            e.preventDefault();
            var button    = $(this);
            var targetId  = button.data('target');
            var previewId = button.data('preview');
            $('#' + targetId).val('');
            $('#' + previewId).attr('src', '').hide();
            button.hide();
        });

        // 3. Sync manual URL input with preview
        $(document).on('input', '.wkl-foto-input', function() {
            var val       = $(this).val().trim();
            var wrap      = $(this).closest('.wkl-upload-wrap');
            var preview   = wrap.find('img');
            var removeBtn = wrap.find('.wkl-remove-btn');
            if (val) {
                preview.attr('src', val).show();
                removeBtn.show();
            } else {
                preview.attr('src', '').hide();
                removeBtn.hide();
            }
        });

        // 4. Upload PDF File
        $('.wkl-upload-pengaduan-pdf').on('click', function(e) {
            e.preventDefault();
            var targetInput = $(this).data('target');
            var frame = wp.media({
                title: 'Pilih Berkas Formulir Pengaduan (PDF)',
                button: { text: 'Gunakan Berkas Ini' },
                library: { type: 'application/pdf' },
                multiple: false
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $(targetInput).val(attachment.url);
            });
            frame.open();
        });

        // 5. Repeater Channels: Live title update
        $(document).on('input', '.wkl-title-input', function() {
            var val = $(this).val().trim() || 'Saluran Pengaduan Baru';
            $(this).closest('.wkl-channel-item').find('.wkl-channel-item-title').text(val);
        });

        // 6. Repeater Channels: Add Card
        var channelCounter = <?php echo count($channels_list) + 10; ?>;
        $('#wkl-add-channel-btn').on('click', function(e) {
            e.preventDefault();
            channelCounter++;
            var nextNum = $('#wkl-channels-container .wkl-channel-item').length + 1;
            var template = $('#tmpl-channel-card').html();
            template = template.replace(/{{num}}/g, nextNum);
            template = template.replace(/{{urutan}}/g, nextNum);
            var $newCard = $(template).hide();
            $('#wkl-channels-container').append($newCard);
            $newCard.slideDown(250);
        });

        // 7. Repeater Channels: Remove Card
        $(document).on('click', '.wkl-remove-channel-btn', function(e) {
            e.preventDefault();
            if (confirm('Yakin ingin menghapus kartu saluran pengaduan ini?')) {
                var card = $(this).closest('.wkl-channel-item');
                card.slideUp(200, function() {
                    card.remove();
                    // Re-index card numbers
                    $('#wkl-channels-container .wkl-channel-item').each(function(idx) {
                        $(this).find('.wkl-card-num').text(idx + 1);
                    });
                });
            }
        });

        // 8. Repeater Steps: Live title update
        $(document).on('input', '.wkl-step-title-input', function() {
            var val = $(this).val().trim() || 'Tahapan Baru';
            $(this).closest('.wkl-step-item').find('.wkl-step-item-title').text(val);
        });

        // 9. Repeater Steps: Add Step
        var stepCounter = <?php echo count($steps_list) + 10; ?>;
        $('#wkl-add-step-btn').on('click', function(e) {
            e.preventDefault();
            stepCounter++;
            var nextStepNum = $('#wkl-steps-container .wkl-step-item').length + 1;
            var formattedNum = (nextStepNum < 10 ? '0' : '') + nextStepNum;
            var template = $('#tmpl-step-card').html();
            template = template.replace(/{{idx}}/g, stepCounter);
            template = template.replace(/{{stepnum}}/g, formattedNum);
            template = template.replace(/{{urutan}}/g, nextStepNum);
            var $newStep = $(template).hide();
            $('#wkl-steps-container').append($newStep);
            $newStep.slideDown(250);
        });

        // 10. Repeater Steps: Remove Step
        $(document).on('click', '.wkl-remove-step-btn', function(e) {
            e.preventDefault();
            if (confirm('Yakin ingin menghapus langkah tahapan alur ini?')) {
                var item = $(this).closest('.wkl-step-item');
                item.slideUp(200, function() {
                    item.remove();
                });
            }
        });

    });
    </script>
    <?php
}
