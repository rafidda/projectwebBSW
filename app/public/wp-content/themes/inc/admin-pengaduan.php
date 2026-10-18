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
    function wakalumi_get_pengaduan_color_theme( $color = 'red' ) {
        $themes = [
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

        return $themes[ $color ] ?? $themes['red'];
    }
}

if ( ! function_exists( 'wakalumi_render_pengaduan_color_options' ) ) {
    function wakalumi_render_pengaduan_color_options( $current = 'red' ) {
        $colors = [
            'red'     => '🔴 Merah Resmi OJK (Regulator)',
            'blue'    => '🔷 Biru Finansial & Regulator',
            'emerald' => '🟢 Hijau Zamrud (Karakter Syariah)',
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

// ── 3. HELPER GET DATA PENGADUAN ───────────────────────────────────

if ( ! function_exists( 'wakalumi_get_pengaduan_settings' ) ) {
    function wakalumi_get_pengaduan_settings() {
        $default_wa = get_option( 'options_contact_wa', '6281517380388' );
        $default_phone = get_option( 'options_contact_phone', '(021) 7471 4555' );
        $default_email = get_option( 'options_contact_email', 'sekretariat@wakalumibprs.co.id' );

        return [
            // Header
            'badge'         => get_option( 'options_pengaduan_badge', 'Perlindungan Konsumen & Regulasi OJK' ),
            'title'         => get_option( 'options_pengaduan_title', 'Layanan Pengaduan Konsumen' ),
            'subtitle'      => get_option( 'options_pengaduan_subtitle', 'Komitmen BPRS Wakalumi dalam mendengarkan, melayani, dan menindaklanjuti setiap aspirasi serta pengaduan nasabah secara adil, transparan, dan profesional sesuai POJK No. 22 Tahun 2023.' ),
            'disclaimer'    => get_option( 'options_pengaduan_disclaimer', 'BPRS Wakalumi Berizin dan Diawasi oleh Otoritas Jasa Keuangan (OJK) serta merupakan peserta penjaminan Lembaga Penjamin Simpanan (LPS).' ),
            
            // Pengaturan Visibilitas Seksi Halaman
            'alur_show'     => (bool) get_option( 'options_pengaduan_alur_show', 1 ),
            'sla_show'      => (bool) get_option( 'options_pengaduan_sla_show', 1 ),
            'panduan_show'  => (bool) get_option( 'options_pengaduan_panduan_show', 1 ),
            'show_form_pdf' => (bool) get_option( 'options_pengaduan_show_form_pdf', 0 ),

            // Saluran Pengaduan Internal Bank
            'wa'            => get_option( 'options_pengaduan_wa', $default_wa ),
            'phone'         => get_option( 'options_pengaduan_phone', $default_phone ),
            'email'         => get_option( 'options_pengaduan_email', 'pengaduan@wakalumibprs.co.id' ),
            'hours'         => get_option( 'options_pengaduan_hours', 'Senin – Jumat: 08.00 – 15.00 WIB (Kecuali Hari Libur Nasional)' ),
            'location_desc' => get_option( 'options_pengaduan_location_desc', 'Kantor Pusat & Seluruh Jaringan Kantor Kas BPRS Wakalumi' ),
            
            // Saluran Eksternal Regulator (OJK & LAPS SJK)
            'ojk_appk_url'  => get_option( 'options_pengaduan_ojk_appk_url', 'https://kontak157.ojk.go.id' ),
            'ojk_phone'     => get_option( 'options_pengaduan_ojk_phone', '157' ),
            'ojk_wa'        => get_option( 'options_pengaduan_ojk_wa', '081 157 157 157' ),
            'ojk_email'     => get_option( 'options_pengaduan_ojk_email', 'konsumen@ojk.go.id' ),
            'laps_url'      => get_option( 'options_pengaduan_laps_url', 'https://lapssjk.id' ),

            // Standar Waktu Resmi (SLA)
            'sla_lisan'     => get_option( 'options_pengaduan_sla_lisan', '5 Hari Kerja' ),
            'sla_tertulis'  => get_option( 'options_pengaduan_sla_tertulis', '10 Hari Kerja' ),
            'sla_note'      => get_option( 'options_pengaduan_sla_note', 'Dapat diperpanjang paling lama 10 (sepuluh) hari kerja dalam kondisi tertentu sesuai ketentuan POJK No. 22 Tahun 2023 Pasal 57.' ),

            // Berkas Formulir PDF Fisik
            'form_pdf_url'  => get_option( 'options_pengaduan_form_pdf_url', '' ),

            // Kustomisasi Card A (Saluran Internal Bank)
            'card_a_color'       => get_option( 'options_pengaduan_card_a_color', 'emerald' ),
            'card_a_badge'       => get_option( 'options_pengaduan_card_a_badge', 'Saluran Resmi BPRS Wakalumi' ),
            'card_a_tag'         => get_option( 'options_pengaduan_card_a_tag', 'Bebas Biaya (Gratis)' ),
            'card_a_title'       => get_option( 'options_pengaduan_card_a_title', 'Hubungi Tim Layanan Nasabah' ),
            'card_a_desc'        => get_option( 'options_pengaduan_card_a_desc', 'Sampaikan keluhan transaksi, rekening, pembiayaan, atau pelayanan secara langsung. Tim Kepatuhan dan Customer Care kami siap menindaklanjuti secara seksama.' ),
            'card_a_status_wa'   => get_option( 'options_pengaduan_card_a_status_wa', 'Chat Aktif' ),
            'card_a_btn_wa'      => get_option( 'options_pengaduan_card_a_btn_wa', 'Kirim Pengaduan via WA' ),
            'card_a_btn_email'   => get_option( 'options_pengaduan_card_a_btn_email', 'Kirim Email Resmi' ),

            // Kustomisasi Card B (Saluran Eksternal Regulator OJK / APPK)
            'card_b_color'       => get_option( 'options_pengaduan_card_b_color', 'red' ), // Default RED (Merah OJK)
            'card_b_badge'       => get_option( 'options_pengaduan_card_b_badge', 'Portal Resmi Regulator OJK' ),
            'card_b_tag'         => get_option( 'options_pengaduan_card_b_tag', 'Eskalasi Eksternal' ),
            'card_b_title'       => get_option( 'options_pengaduan_card_b_title', 'Portal APPK OJK (Kontak 157)' ),
            'card_b_desc'        => get_option( 'options_pengaduan_card_b_desc', 'Sesuai regulasi POJK, jika proses penanganan belum mencapai kesepakatan atau Anda membutuhkan perlindungan otoritas, Anda dapat mengakses portal terpadu APPK OJK.' ),
            'card_b_status_appk' => get_option( 'options_pengaduan_card_b_status_appk', '' ), // Default KOSONG (menghilangkan '24 Jam Online')
            'card_b_btn_text'    => get_option( 'options_pengaduan_card_b_btn_text', 'Buka Portal APPK OJK' ),

            // Pratinjau Halaman Utama (Beranda)
            'home_badge'    => get_option( 'options_pengaduan_home_badge', 'Kepatuhan Regulasi POJK No. 22/2023' ),
            'home_title'    => get_option( 'options_pengaduan_home_title', 'Layanan Pengaduan & Pelindungan Nasabah' ),
            'home_desc'     => get_option( 'options_pengaduan_home_desc', 'BPRS Wakalumi berkomitmen memberikan kepastian dan keadilan bagi setiap nasabah. Sesuai regulasi OJK, mekanisme penanganan pengaduan kami transparan, bebas biaya (gratis), serta menjamin kerahasiaan informasi dengan batas waktu penyelesaian yang terukur.' ),
            'home_btn_text' => get_option( 'options_pengaduan_home_btn_text', 'Pelajari Prosedur & Ajukan Pengaduan' ),
        ];
    }
}

// ── 3. RENDER HALAMAN ADMIN ────────────────────────────────────────

function wakalumi_render_pengaduan_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( esc_html__( 'Anda tidak memiliki izin untuk mengakses halaman ini.', 'wakalumi' ) );
    }

    wp_enqueue_media();
    $message = '';

    // Proses Simpan Data
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer( 'wakalumi_pengaduan_action', 'wakalumi_pengaduan_nonce' ) ) {
        update_option( 'options_pengaduan_badge', sanitize_text_field( $_POST['options_pengaduan_badge'] ?? '' ) );
        update_option( 'options_pengaduan_title', sanitize_text_field( $_POST['options_pengaduan_title'] ?? '' ) );
        update_option( 'options_pengaduan_subtitle', sanitize_textarea_field( $_POST['options_pengaduan_subtitle'] ?? '' ) );
        update_option( 'options_pengaduan_disclaimer', sanitize_textarea_field( $_POST['options_pengaduan_disclaimer'] ?? '' ) );

        update_option( 'options_pengaduan_wa', sanitize_text_field( $_POST['options_pengaduan_wa'] ?? '' ) );
        update_option( 'options_pengaduan_phone', sanitize_text_field( $_POST['options_pengaduan_phone'] ?? '' ) );
        update_option( 'options_pengaduan_email', sanitize_email( $_POST['options_pengaduan_email'] ?? '' ) );
        update_option( 'options_pengaduan_hours', sanitize_text_field( $_POST['options_pengaduan_hours'] ?? '' ) );
        update_option( 'options_pengaduan_location_desc', sanitize_text_field( $_POST['options_pengaduan_location_desc'] ?? '' ) );

        // Card A Customization
        update_option( 'options_pengaduan_card_a_color', sanitize_key( $_POST['options_pengaduan_card_a_color'] ?? 'emerald' ) );
        update_option( 'options_pengaduan_card_a_badge', sanitize_text_field( $_POST['options_pengaduan_card_a_badge'] ?? '' ) );
        update_option( 'options_pengaduan_card_a_tag', sanitize_text_field( $_POST['options_pengaduan_card_a_tag'] ?? '' ) );
        update_option( 'options_pengaduan_card_a_title', sanitize_text_field( $_POST['options_pengaduan_card_a_title'] ?? '' ) );
        update_option( 'options_pengaduan_card_a_desc', sanitize_textarea_field( $_POST['options_pengaduan_card_a_desc'] ?? '' ) );
        update_option( 'options_pengaduan_card_a_status_wa', sanitize_text_field( $_POST['options_pengaduan_card_a_status_wa'] ?? '' ) );
        update_option( 'options_pengaduan_card_a_btn_wa', sanitize_text_field( $_POST['options_pengaduan_card_a_btn_wa'] ?? '' ) );
        update_option( 'options_pengaduan_card_a_btn_email', sanitize_text_field( $_POST['options_pengaduan_card_a_btn_email'] ?? '' ) );

        // Card B Customization
        update_option( 'options_pengaduan_card_b_color', sanitize_key( $_POST['options_pengaduan_card_b_color'] ?? 'red' ) );
        update_option( 'options_pengaduan_card_b_badge', sanitize_text_field( $_POST['options_pengaduan_card_b_badge'] ?? '' ) );
        update_option( 'options_pengaduan_card_b_tag', sanitize_text_field( $_POST['options_pengaduan_card_b_tag'] ?? '' ) );
        update_option( 'options_pengaduan_card_b_title', sanitize_text_field( $_POST['options_pengaduan_card_b_title'] ?? '' ) );
        update_option( 'options_pengaduan_card_b_desc', sanitize_textarea_field( $_POST['options_pengaduan_card_b_desc'] ?? '' ) );
        update_option( 'options_pengaduan_card_b_status_appk', sanitize_text_field( $_POST['options_pengaduan_card_b_status_appk'] ?? '' ) );
        update_option( 'options_pengaduan_card_b_btn_text', sanitize_text_field( $_POST['options_pengaduan_card_b_btn_text'] ?? '' ) );

        update_option( 'options_pengaduan_ojk_appk_url', esc_url_raw( $_POST['options_pengaduan_ojk_appk_url'] ?? '' ) );
        update_option( 'options_pengaduan_ojk_phone', sanitize_text_field( $_POST['options_pengaduan_ojk_phone'] ?? '' ) );
        update_option( 'options_pengaduan_ojk_wa', sanitize_text_field( $_POST['options_pengaduan_ojk_wa'] ?? '' ) );
        update_option( 'options_pengaduan_ojk_email', sanitize_email( $_POST['options_pengaduan_ojk_email'] ?? '' ) );
        update_option( 'options_pengaduan_laps_url', esc_url_raw( $_POST['options_pengaduan_laps_url'] ?? '' ) );

        update_option( 'options_pengaduan_alur_show', isset( $_POST['options_pengaduan_alur_show'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_sla_show', isset( $_POST['options_pengaduan_sla_show'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_panduan_show', isset( $_POST['options_pengaduan_panduan_show'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_sla_lisan', sanitize_text_field( $_POST['options_pengaduan_sla_lisan'] ?? '' ) );
        update_option( 'options_pengaduan_sla_tertulis', sanitize_text_field( $_POST['options_pengaduan_sla_tertulis'] ?? '' ) );
        update_option( 'options_pengaduan_sla_note', sanitize_textarea_field( $_POST['options_pengaduan_sla_note'] ?? '' ) );

        update_option( 'options_pengaduan_show_form_pdf', isset( $_POST['options_pengaduan_show_form_pdf'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_form_pdf_url', esc_url_raw( $_POST['options_pengaduan_form_pdf_url'] ?? '' ) );

        // Pengaturan Pratinjau Beranda
        update_option( 'options_pengaduan_home_badge', sanitize_text_field( $_POST['options_pengaduan_home_badge'] ?? '' ) );
        update_option( 'options_pengaduan_home_title', sanitize_text_field( $_POST['options_pengaduan_home_title'] ?? '' ) );
        update_option( 'options_pengaduan_home_desc', sanitize_textarea_field( $_POST['options_pengaduan_home_desc'] ?? '' ) );
        update_option( 'options_pengaduan_home_btn_text', sanitize_text_field( $_POST['options_pengaduan_home_btn_text'] ?? '' ) );

        $message = '✅ Pengaturan Layanan Pengaduan Konsumen berhasil disimpan!';
    }

    $cfg = wakalumi_get_pengaduan_settings();
    ?>
    <div class="wrap" style="max-width: 980px; margin-top: 20px;">
        <div style="background: linear-gradient(135deg, #088395 0%, #0a4d68 100%); color: #fff; padding: 24px 30px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 14px rgba(8, 131, 149, 0.2);">
            <div style="display: flex; align-items: center; gap: 14px;">
                <span style="font-size: 32px; line-height: 1;">🛡️</span>
                <div>
                    <h1 style="color: #fff; margin: 0; font-size: 22px; font-weight: 800;">Pengelolaan Layanan Pengaduan Konsumen</h1>
                    <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 13px;">
                        Atur visibilitas seksi halaman, saluran aduan nasabah ke BPRS Wakalumi, portal resmi APPK OJK 157, SLA waktu penyelesaian, dan berkas formulir.
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
                    <span>⚙️</span> Visibilitas Seksi Halaman (Aktif / Nonaktif)
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 18px;">
                    Centang atau hapus centang untuk menampilkan atau menyembunyikan bagian halaman sesuai kebutuhan bank:
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <!-- Toggle Seksi Alur Prosedur -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_alur_show" value="1" <?php checked( $cfg['alur_show'] ); ?> style="width: 18px; height: 18px; margin-top: 2px; accent-color: #088395;">
                            <div>
                                <span style="font-size: 13px; font-weight: 700; color: #0f172a; display: block;">Seksi Alur Prosedur (4 Langkah)</span>
                                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">
                                    Tahapan penerimaan, verifikasi, investigasi, dan tanggapan resmi (POJK 22/2023).
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
                                    Batas waktu resmi pengaduan lisan (5 hari) & tertulis (10 hari kerja).
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

            <!-- KARTU 1: SALURAN PENGADUAN INTERNAL BPRS WAKALUMI (CARD A) -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #088395; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #088395; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>🏢</span> 1. Kartu A: Saluran Pengaduan Langsung ke BPRS Wakalumi
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: -10px; margin-bottom: 18px;">
                    Atur konten judul, deskripsi, badge, tombol aksi, dan saluran kontak resmi pengaduan internal bank.
                </p>

                <!-- Sub-grup: Kustomisasi Header & Teks Card A -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 16px; margin-bottom: 18px;">
                    <div style="font-weight: 700; font-size: 12px; color: #088395; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">
                        📌 Teks &amp; Label Tampilan Kartu A
                    </div>
                    <div style="margin-bottom: 14px; background: #ffffff; padding: 10px 12px; border-radius: 6px; border: 1px solid #cbd5e1;">
                        <label style="font-size: 12px; font-weight: 700; color: #088395; display: block; margin-bottom: 5px;">🎨 Tema Warna Aksen Kartu A</label>
                        <select name="options_pengaduan_card_a_color" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                            <?php echo wakalumi_render_pengaduan_color_options( $cfg['card_a_color'] ?? 'emerald' ); ?>
                        </select>
                        <small style="color: #64748b; font-size: 11px; display: block; margin-top: 3px;">Pilih warna aksen batas tepi, gradien atas, badge, tombol utama, dan sorotan hover.</small>
                    </div>
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px; margin-bottom: 12px;">
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Judul Kartu A</label>
                            <input type="text" name="options_pengaduan_card_a_title" value="<?php echo esc_attr( $cfg['card_a_title'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                        </div>
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Badge Kiri</label>
                            <input type="text" name="options_pengaduan_card_a_badge" value="<?php echo esc_attr( $cfg['card_a_badge'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Tag Kanan Header</label>
                            <input type="text" name="options_pengaduan_card_a_tag" value="<?php echo esc_attr( $cfg['card_a_tag'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        </div>
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Status Tag WhatsApp</label>
                            <input type="text" name="options_pengaduan_card_a_status_wa" value="<?php echo esc_attr( $cfg['card_a_status_wa'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;" placeholder="Chat Aktif (kosongkan jika tidak ingin ditampilkan)">
                        </div>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Deskripsi / Paragraf Pengantar Kartu A</label>
                        <textarea name="options_pengaduan_card_a_desc" rows="2" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"><?php echo esc_textarea( $cfg['card_a_desc'] ); ?></textarea>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Teks Tombol WA</label>
                            <input type="text" name="options_pengaduan_card_a_btn_wa" value="<?php echo esc_attr( $cfg['card_a_btn_wa'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                        </div>
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Teks Tombol Email</label>
                            <input type="text" name="options_pengaduan_card_a_btn_email" value="<?php echo esc_attr( $cfg['card_a_btn_email'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                        </div>
                    </div>
                </div>

                <!-- Sub-grup: Saluran Kontak Fisik & Digital -->
                <div style="font-weight: 700; font-size: 12px; color: #334155; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">
                    📞 Detail Saluran Kontak &amp; Operasional
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Nomor WhatsApp Pengaduan (Format: 628xxx)</label>
                        <input type="text" name="options_pengaduan_wa" value="<?php echo esc_attr( $cfg['wa'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                        <small style="color: #64748b; font-size: 11px;">Akan membuka percakapan WhatsApp resmi dengan template pesan aduan otomatis.</small>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Hotline Telepon Pengaduan</label>
                        <input type="text" name="options_pengaduan_phone" value="<?php echo esc_attr( $cfg['phone'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                        <small style="color: #64748b; font-size: 11px;">Contoh: (021) 7471 4555</small>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Alamat Email Pengaduan Nasabah</label>
                        <input type="email" name="options_pengaduan_email" value="<?php echo esc_attr( $cfg['email'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Jam Operasional Penanganan Pengaduan</label>
                        <input type="text" name="options_pengaduan_hours" value="<?php echo esc_attr( $cfg['hours'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                    </div>
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Keterangan Lokasi Tatap Muka (Kantor)</label>
                    <input type="text" name="options_pengaduan_location_desc" value="<?php echo esc_attr( $cfg['location_desc'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>

            <!-- KARTU 2: SALURAN REGULATOR (PORTAL APPK OJK & LAPS SJK) (CARD B) -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #2563eb; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #2563eb; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>⚖️</span> 2. Kartu B: Saluran Resmi Regulator (Portal APPK OJK &amp; LAPS SJK)
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: -10px; margin-bottom: 18px;">
                    Atur konten judul, deskripsi, badge, status operasional APPK, tautan, dan tombol aksi eskalasi regulator.
                </p>

                <!-- Sub-grup: Kustomisasi Header & Teks Card B -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 16px; margin-bottom: 18px;">
                    <div style="font-weight: 700; font-size: 12px; color: #2563eb; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">
                        📌 Teks &amp; Label Tampilan Kartu B
                    </div>
                    <div style="margin-bottom: 14px; background: #ffffff; padding: 10px 12px; border-radius: 6px; border: 1px solid #cbd5e1;">
                        <label style="font-size: 12px; font-weight: 700; color: #dc2626; display: block; margin-bottom: 5px;">🎨 Tema Warna Aksen Kartu B (Regulator)</label>
                        <select name="options_pengaduan_card_b_color" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                            <?php echo wakalumi_render_pengaduan_color_options( $cfg['card_b_color'] ?? 'red' ); ?>
                        </select>
                        <small style="color: #64748b; font-size: 11px; display: block; margin-top: 3px;">Pilih tema warna kartu regulator. Disarankan: <strong>Merah Resmi OJK</strong>.</small>
                    </div>
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px; margin-bottom: 12px;">
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Judul Kartu B</label>
                            <input type="text" name="options_pengaduan_card_b_title" value="<?php echo esc_attr( $cfg['card_b_title'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                        </div>
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Badge Kiri</label>
                            <input type="text" name="options_pengaduan_card_b_badge" value="<?php echo esc_attr( $cfg['card_b_badge'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 12px;">
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Tag Kanan Header</label>
                            <input type="text" name="options_pengaduan_card_b_tag" value="<?php echo esc_attr( $cfg['card_b_tag'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        </div>
                        <div>
                            <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">
                                Status Tag APPK <span style="font-weight: normal; color: #94a3b8;">(Kosongkan untuk menghilangkan "24 Jam Online")</span>
                            </label>
                            <input type="text" name="options_pengaduan_card_b_status_appk" value="<?php echo esc_attr( $cfg['card_b_status_appk'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;" placeholder="Kosongkan jika tidak ingin menampilkan status">
                        </div>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Deskripsi / Paragraf Pengantar Kartu B</label>
                        <textarea name="options_pengaduan_card_b_desc" rows="2" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"><?php echo esc_textarea( $cfg['card_b_desc'] ); ?></textarea>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Teks Tombol Aksi Utama</label>
                        <input type="text" name="options_pengaduan_card_b_btn_text" value="<?php echo esc_attr( $cfg['card_b_btn_text'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                    </div>
                </div>

                <!-- Sub-grup: Detail Saluran Regulator -->
                <div style="font-weight: 700; font-size: 12px; color: #334155; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px;">
                    🌐 Tautan &amp; Kontak Resmi Regulator
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">URL Portal APPK OJK</label>
                        <input type="url" name="options_pengaduan_ojk_appk_url" value="<?php echo esc_attr( $cfg['ojk_appk_url'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <small style="color: #64748b; font-size: 11px;">Default: https://kontak157.ojk.go.id</small>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Hotline Kontak OJK</label>
                        <input type="text" name="options_pengaduan_ojk_phone" value="<?php echo esc_attr( $cfg['ojk_phone'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <small style="color: #64748b; font-size: 11px;">Default: 157</small>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Nomor WhatsApp Kontak OJK</label>
                        <input type="text" name="options_pengaduan_ojk_wa" value="<?php echo esc_attr( $cfg['ojk_wa'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <small style="color: #64748b; font-size: 11px;">Default: 081 157 157 157</small>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">URL Resmi LAPS SJK</label>
                        <input type="url" name="options_pengaduan_laps_url" value="<?php echo esc_attr( $cfg['laps_url'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <small style="color: #64748b; font-size: 11px;">Default: https://lapssjk.id</small>
                    </div>
                </div>
            </div>

            <!-- KARTU 3: STANDAR WAKTU (SLA) & FORMULIR PDF -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #f59e0b; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #b45309; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>⏱️</span> 3. Standar Waktu Penyelesaian (SLA POJK) &amp; Berkas PDF
                </h2>

                <!-- Toggle Tampilkan SLA -->
                <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 12px 16px; margin-bottom: 18px;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" name="options_pengaduan_sla_show" value="1" <?php checked( $cfg['sla_show'] ); ?> style="width: 18px; height: 18px; accent-color: #d97706;">
                        <span style="font-size: 13px; font-weight: 700; color: #92400e;">Tampilkan Seksi Standar Waktu Layanan (SLA) di Halaman Depan</span>
                    </label>
                    <small style="color: #78350f; font-size: 11px; margin-left: 28px; display: block; margin-top: 2px;">
                        Centang untuk menampilkan kotak komitmen kepastian batas waktu penanganan pengaduan nasabah (POJK No. 22 Tahun 2023). Hapus centang jika ingin menyembunyikannya.
                    </small>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Batas Waktu Pengaduan Lisan</label>
                        <input type="text" name="options_pengaduan_sla_lisan" value="<?php echo esc_attr( $cfg['sla_lisan'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;" placeholder="5 Hari Kerja">
                        <small style="color: #64748b; font-size: 11px;">Cukup tuliskan durasi angka/hari, contoh: <strong>5 Hari Kerja</strong></small>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Batas Waktu Pengaduan Tertulis</label>
                        <input type="text" name="options_pengaduan_sla_tertulis" value="<?php echo esc_attr( $cfg['sla_tertulis'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;" placeholder="10 Hari Kerja">
                        <small style="color: #64748b; font-size: 11px;">Cukup tuliskan durasi angka/hari, contoh: <strong>10 Hari Kerja</strong></small>
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Catatan Ketentuan Perpanjangan Waktu (POJK)</label>
                    <textarea name="options_pengaduan_sla_note" rows="2" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-size: 12px;"><?php echo esc_textarea( $cfg['sla_note'] ); ?></textarea>
                    <small style="color: #64748b; font-size: 11px;">Akan ditampilkan sebagai pita informasi hukum resmi di bawah kartu SLA.</small>
                </div>

                <!-- Toggle Tampilkan Berkas Cetak Fisik PDF -->
                <div style="border-top: 1px solid #e2e8f0; padding-top: 16px;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; margin-bottom: 14px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_show_form_pdf" value="1" <?php checked( $cfg['show_form_pdf'] ); ?> style="width: 18px; height: 18px; accent-color: #088395;">
                            <span style="font-size: 13px; font-weight: 700; color: #0f172a;">Tampilkan Kartu Unduh Formulir Pengaduan Cetak Fisik (PDF)</span>
                        </label>
                        <small style="color: #64748b; font-size: 11px; margin-left: 28px; display: block; margin-top: 2px;">
                            Saat ini dinonaktifkan secara default. Jika dimatikan, halaman depan akan menampilkan panduan berkas persyaratan secara penuh tanpa slot unduh formulir yang belum tersedia.
                        </small>
                    </div>

                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Unggah Berkas PDF Formulir Pengaduan Fisik (Aktif jika opsi di atas dicentang)</label>
                    <div style="display: flex; gap: 8px; align-items: center;">
                        <input type="text" id="wkl_form_pdf_url" name="options_pengaduan_form_pdf_url" value="<?php echo esc_attr( $cfg['form_pdf_url'] ); ?>" placeholder="https://.../formulir-pengaduan-nasabah.pdf" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <button type="button" class="button wkl-upload-pengaduan-pdf" data-target="#wkl_form_pdf_url" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                            <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah Berkas PDF
                        </button>
                    </div>
                </div>
            </div>

            <!-- KARTU 4: HEADER & KETERANGAN UMUM -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #64748b; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #334155; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>📝</span> 4. Teks Header Banner &amp; Disclaimer
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

                <div>
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Pernyataan Regulasi OJK (Footer Card)</label>
                    <input type="text" name="options_pengaduan_disclaimer" value="<?php echo esc_attr( $cfg['disclaimer'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
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
                        <small style="color: #64748b; font-size: 11px;">Default: Kepatuhan Regulasi POJK No. 22/2023</small>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Teks Tombol Aksi Beranda</label>
                        <input type="text" name="options_pengaduan_home_btn_text" value="<?php echo esc_attr( $cfg['home_btn_text'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                        <small style="color: #64748b; font-size: 11px;">Default: Pelajari Prosedur &amp; Ajukan Pengaduan</small>
                    </div>
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Judul Seksi di Beranda</label>
                    <input type="text" name="options_pengaduan_home_title" value="<?php echo esc_attr( $cfg['home_title'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Deskripsi Ringkas di Beranda</label>
                    <textarea name="options_pengaduan_home_desc" rows="3" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"><?php echo esc_textarea( $cfg['home_desc'] ); ?></textarea>
                    <small style="color: #64748b; font-size: 11px;">Nilai SLA (5 Hari &amp; 10 Hari) serta saluran kontak akan otomatis tersinkronisasi dari Pengaturan Kartu 1 &amp; 3 di atas.</small>
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <div style="display: flex; justify-content: flex-end; padding-top: 10px;">
                <button type="submit" class="button button-primary" style="background: #088395; border-color: #088395; font-weight: bold; padding: 8px 30px; border-radius: 8px; font-size: 14px;">
                    💾 Simpan Semua Pengaturan
                </button>
            </div>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($) {
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
    });
    </script>
    <?php
}

