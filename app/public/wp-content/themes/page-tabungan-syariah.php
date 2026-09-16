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
$tab_quote      = get_option( 'options_tabungan_quote', 'Menabung dengan akad syariah yang murni (Wadiah & Mudharabah), menjaga harta tetap berkah, amanah, dan terhindar dari riba sesuai fatwa DSN-MUI.' );

// LPS Card di Header
$tab_lps_tag    = get_option( 'options_tabungan_lps_tag', 'Penjaminan Resmi LPS & OJK' );
$tab_lps_title  = get_option( 'options_tabungan_lps_title', 'Simpanan Dijamin LPS s.d. Rp 2 Miliar' );
$tab_lps_desc   = get_option( 'options_tabungan_lps_desc', 'Seluruh dana simpanan tabungan nasabah dijamin keamanannya oleh Lembaga Penjamin Simpanan (LPS) sesuai ketentuan batas maksimal penjaminan per nasabah per bank.' );
$tab_lps_btn    = get_option( 'options_tabungan_lps_btn_text', 'Hitung Simulasi Rencana Menabung' );

// ── AMBIL DAFTAR PRODUK DINAMIS DARI HELPER ADMIN PRODUK ──────────
$tabungan_list = function_exists( 'wakalumi_get_tabungan_list' ) ? wakalumi_get_tabungan_list() : [];

// ── PENGATURAN TABEL KOMPARASI DARI ADMIN ─────────────────────────
$tab_komp_kicker = get_option( 'options_tabungan_komparasi_kicker', 'Perbandingan Produk' );
$tab_komp_title  = get_option( 'options_tabungan_komparasi_title', 'Pilih Tabungan yang Tepat untuk Kebutuhan Anda' );
$tab_komp_desc   = get_option( 'options_tabungan_komparasi_desc', 'Bandingkan fitur utama produk simpanan syariah BPRS Wakalumi secara transparan dan amanah.' );
$tab_komp_lps    = get_option( 'options_tabungan_komparasi_lps_note', 'Dijamin Lembaga Penjamin Simpanan (LPS) s.d. Rp 2 Miliar per nasabah & Diawasi Otoritas Jasa Keuangan (OJK)' );

// ── PENGATURAN 4 KEUNGGULAN DARI ADMIN ────────────────────────────
$tab_keung_kicker  = get_option( 'options_tabungan_keung_kicker', 'Keunggulan Simpanan Syariah' );
$tab_keung_title   = get_option( 'options_tabungan_keung_title', 'Mengapa Memilih Menabung di BPRS Wakalumi?' );
$tab_keung_desc    = get_option( 'options_tabungan_keung_desc', 'Kami memastikan setiap rupiah yang Anda simpan dikelola secara profesional, amanah, dan mendatangkan kemaslahatan bagi umat.' );
$tab_keung_1_title = get_option( 'options_tabungan_keung_1_title', 'Murni Bebas Riba' );
$tab_keung_1_desc  = get_option( 'options_tabungan_keung_1_desc', 'Pengelolaan berlandaskan akad syariah yang diawasi langsung oleh Dewan Pengawas Syariah (DPS) dan DSN-MUI.' );
$tab_keung_2_title = get_option( 'options_tabungan_keung_2_title', 'Bebas Biaya Bulanan' );
$tab_keung_2_desc  = get_option( 'options_tabungan_keung_2_desc', 'Saldo tabungan Anda tidak akan tergerus oleh biaya administrasi bulanan, sehingga dana Anda aman dan optimal.' );
$tab_keung_3_title = get_option( 'options_tabungan_keung_3_title', 'Bagi Hasil Kompetitif' );
$tab_keung_3_desc  = get_option( 'options_tabungan_keung_3_desc', 'Keuntungan hasil pembiayaan produktif sektor riil dibagikan secara adil dan transparan kepada para penabung setiap bulan.' );
$tab_keung_4_title = get_option( 'options_tabungan_keung_4_title', 'Dijamin LPS Rp 2 Miliar' );
$tab_keung_4_desc  = get_option( 'options_tabungan_keung_4_desc', 'Dana simpanan masyarakat dijamin secara sah oleh Lembaga Penjamin Simpanan (LPS) sesuai ketentuan regulasi yang berlaku.' );

// ── PENGATURAN KALKULATOR DARI ADMIN ─────────────────────────────
$calc_badge   = get_option( 'options_tabungan_calc_badge', 'Simulasi Finansial Syariah' );
$calc_title   = get_option( 'options_tabungan_calc_title', 'Kalkulator Rencana Menabung Berkah' );
$calc_sub     = get_option( 'options_tabungan_calc_subtitle', 'Tentukan target impian Anda—mulai dari porsi haji, dana sekolah anak, program tabungan ukhuwah, hingga simpanan masa depan keluarga. Kami hitungkan estimasi sisihan per bulan.' );
$calc_min     = get_option( 'options_tabungan_calc_target_min', '2000000' );
$calc_max     = get_option( 'options_tabungan_calc_target_max', '100000000' );
$calc_default = get_option( 'options_tabungan_calc_target_default', '25000000' );
$calc_note    = get_option( 'options_tabungan_calc_note', '*Simulasi indikatif pembulatan matematis tanpa potongan admin bulanan.' );
$calc_btn     = get_option( 'options_tabungan_calc_btn_text', 'Mulai Menabung via WhatsApp' );

// ── PENGATURAN TANYA JAWAB (FAQ) DARI ADMIN ───────────────────────
$faq_badge  = get_option( 'options_tabungan_faq_badge', 'Tanya Jawab (FAQ)' );
$faq_title  = get_option( 'options_tabungan_faq_title', 'Pertanyaan Seputar Tabungan' );
$faq_sub    = get_option( 'options_tabungan_faq_subtitle', 'Pertanyaan umum nasabah seputar produk simpanan syariah, keamanan simpanan di LPS, dan prosedur pembukaan rekening.' );
$faq_list   = function_exists( 'wakalumi_get_tabungan_faq_list' ) ? wakalumi_get_tabungan_faq_list() : [];

// ── PENGATURAN BOX BROSUR & PROMO DEPOSITO ────────────────────────
$tab_brosur_kicker = get_option( 'options_tabungan_brosur_kicker', 'Katalog Brosur Resmi' );
$tab_brosur_title  = get_option( 'options_tabungan_brosur_title', 'Unduh Brosur Produk Lengkap' );
$tab_brosur_desc   = get_option( 'options_tabungan_brosur_desc', 'Dapatkan informasi lengkap seluruh produk simpanan, deposito, dan pembiayaan BPRS Wakalumi dalam format dokumen PDF resmi.' );
$tab_brosur_btn    = get_option( 'options_tabungan_brosur_btn', 'Unduh File Brosur (PDF)' );

$tab_dep_kicker    = get_option( 'options_tabungan_dep_kicker', 'Investasi Berjangka' );
$tab_dep_title     = get_option( 'options_tabungan_dep_title', 'Ingin Imbal Hasil Lebih Optimal?' );
$tab_dep_desc      = get_option( 'options_tabungan_dep_desc', 'Jelajahi produk Deposito Mudharabah BPRS Wakalumi dengan tenor 1, 3, 6, dan 12 bulan serta porsi nisbah bagi hasil yang kompetitif.' );
$tab_dep_btn       = get_option( 'options_tabungan_dep_btn', 'Lihat Halaman Deposito Mudharabah' );

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
// 10 Color Themes Palette (Full Support for Admin Repeater)
$color_themes = [
    'teal' => [
        'pill_dot'        => 'bg-teal-500',
        'pill_hover'      => 'hover:border-teal-500 hover:text-teal-600 dark:hover:text-teal-400',
        'card_border'     => 'border-teal-200/80 dark:border-teal-900/60',
        'card_hover'      => 'hover:border-teal-400/80 dark:hover:border-teal-500/60 hover:shadow-teal-500/10',
        'subcard_hover'   => 'group-hover/card:border-teal-300/80 dark:group-hover/card:border-teal-700/60',
        'accent_gradient' => 'before:via-teal-500',
        'title_hover'     => 'group-hover/card:text-teal-600 dark:group-hover/card:text-teal-400',
        'glow_bg'         => 'bg-teal-500/10',
        'glow_ambient'    => 'from-teal-500/0 via-teal-500/[0.03] to-teal-500/[0.08]',
        'badge_bg'        => 'bg-teal-100 dark:bg-teal-950 text-teal-800 dark:text-teal-300 border-teal-200 dark:border-teal-800',
        'tagline_text'    => 'text-teal-700 dark:text-teal-400',
        'icon_color'      => 'text-teal-600 dark:text-teal-400',
        'icon_bg'         => 'bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-300',
        'min_text'        => 'text-teal-700 dark:text-teal-400',
        'dot_color'       => 'text-teal-600',
        'btn_bg'          => 'bg-teal-600 hover:bg-teal-700 text-white shadow-teal-600/20',
        'th_text'         => 'text-teal-700 dark:text-teal-300',
        'table_min'       => 'text-teal-600 dark:text-teal-400',
    ],
    'blue' => [
        'pill_dot'        => 'bg-blue-500',
        'pill_hover'      => 'hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400',
        'card_border'     => 'border-blue-200/80 dark:border-blue-900/60',
        'card_hover'      => 'hover:border-blue-400/80 dark:hover:border-blue-500/60 hover:shadow-blue-500/10',
        'subcard_hover'   => 'group-hover/card:border-blue-300/80 dark:group-hover/card:border-blue-700/60',
        'accent_gradient' => 'before:via-blue-500',
        'title_hover'     => 'group-hover/card:text-blue-600 dark:group-hover/card:text-blue-400',
        'glow_bg'         => 'bg-blue-500/10',
        'glow_ambient'    => 'from-blue-500/0 via-blue-500/[0.03] to-blue-500/[0.08]',
        'badge_bg'        => 'bg-blue-100 dark:bg-blue-950 text-blue-800 dark:text-blue-300 border-blue-200 dark:border-blue-800',
        'tagline_text'    => 'text-blue-700 dark:text-blue-400',
        'icon_color'      => 'text-blue-600 dark:text-blue-400',
        'icon_bg'         => 'bg-blue-50 dark:bg-blue-900/50 text-blue-600 dark:text-blue-300',
        'min_text'        => 'text-blue-700 dark:text-blue-400',
        'dot_color'       => 'text-blue-600',
        'btn_bg'          => 'bg-blue-600 hover:bg-blue-700 text-white shadow-blue-600/20',
        'th_text'         => 'text-blue-700 dark:text-blue-300',
        'table_min'       => 'text-blue-600 dark:text-blue-400',
    ],
    'amber' => [
        'pill_dot'        => 'bg-amber-500',
        'pill_hover'      => 'hover:border-amber-500 hover:text-amber-600 dark:hover:text-amber-400',
        'card_border'     => 'border-amber-200/80 dark:border-amber-900/60',
        'card_hover'      => 'hover:border-amber-400/80 dark:hover:border-amber-500/60 hover:shadow-amber-500/10',
        'subcard_hover'   => 'group-hover/card:border-amber-300/80 dark:group-hover/card:border-amber-700/60',
        'accent_gradient' => 'before:via-amber-500',
        'title_hover'     => 'group-hover/card:text-amber-600 dark:group-hover/card:text-amber-400',
        'glow_bg'         => 'bg-amber-500/10',
        'glow_ambient'    => 'from-amber-500/0 via-amber-500/[0.03] to-amber-500/[0.08]',
        'badge_bg'        => 'bg-amber-100 dark:bg-amber-950 text-amber-900 dark:text-amber-300 border-amber-200 dark:border-amber-800',
        'tagline_text'    => 'text-amber-700 dark:text-amber-400',
        'icon_color'      => 'text-amber-600 dark:text-amber-400',
        'icon_bg'         => 'bg-amber-50 dark:bg-amber-900/50 text-amber-600 dark:text-amber-300',
        'min_text'        => 'text-amber-700 dark:text-amber-400',
        'dot_color'       => 'text-amber-600',
        'btn_bg'          => 'bg-amber-600 hover:bg-amber-700 text-white shadow-amber-600/20',
        'th_text'         => 'text-amber-700 dark:text-amber-300',
        'table_min'       => 'text-amber-600 dark:text-amber-400',
    ],
    'purple' => [
        'pill_dot'        => 'bg-purple-500',
        'pill_hover'      => 'hover:border-purple-500 hover:text-purple-600 dark:hover:text-purple-400',
        'card_border'     => 'border-purple-200/80 dark:border-purple-900/60',
        'card_hover'      => 'hover:border-purple-400/80 dark:hover:border-purple-500/60 hover:shadow-purple-500/10',
        'subcard_hover'   => 'group-hover/card:border-purple-300/80 dark:group-hover/card:border-purple-700/60',
        'accent_gradient' => 'before:via-purple-500',
        'title_hover'     => 'group-hover/card:text-purple-600 dark:group-hover/card:text-purple-400',
        'glow_bg'         => 'bg-purple-500/10',
        'glow_ambient'    => 'from-purple-500/0 via-purple-500/[0.03] to-purple-500/[0.08]',
        'badge_bg'        => 'bg-purple-100 dark:bg-purple-950 text-purple-900 dark:text-purple-300 border-purple-200 dark:border-purple-800',
        'tagline_text'    => 'text-purple-700 dark:text-purple-400',
        'icon_color'      => 'text-purple-600 dark:text-purple-400',
        'icon_bg'         => 'bg-purple-50 dark:bg-purple-900/50 text-purple-600 dark:text-purple-300',
        'min_text'        => 'text-purple-700 dark:text-purple-400',
        'dot_color'       => 'text-purple-600',
        'btn_bg'          => 'bg-purple-600 hover:bg-purple-700 text-white shadow-purple-600/20',
        'th_text'         => 'text-purple-700 dark:text-purple-300',
        'table_min'       => 'text-purple-600 dark:text-purple-400',
    ],
    'emerald' => [
        'pill_dot'        => 'bg-emerald-500',
        'pill_hover'      => 'hover:border-emerald-500 hover:text-emerald-600 dark:hover:text-emerald-400',
        'card_border'     => 'border-emerald-200/80 dark:border-emerald-900/60',
        'card_hover'      => 'hover:border-emerald-400/80 dark:hover:border-emerald-500/60 hover:shadow-emerald-500/10',
        'subcard_hover'   => 'group-hover/card:border-emerald-300/80 dark:group-hover/card:border-emerald-700/60',
        'accent_gradient' => 'before:via-emerald-500',
        'title_hover'     => 'group-hover/card:text-emerald-600 dark:group-hover/card:text-emerald-400',
        'glow_bg'         => 'bg-emerald-500/10',
        'glow_ambient'    => 'from-emerald-500/0 via-emerald-500/[0.03] to-emerald-500/[0.08]',
        'badge_bg'        => 'bg-emerald-100 dark:bg-emerald-950 text-emerald-900 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800',
        'tagline_text'    => 'text-emerald-700 dark:text-emerald-400',
        'icon_color'      => 'text-emerald-600 dark:text-emerald-400',
        'icon_bg'         => 'bg-emerald-50 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-300',
        'min_text'        => 'text-emerald-700 dark:text-emerald-400',
        'dot_color'       => 'text-emerald-600',
        'btn_bg'          => 'bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-600/20',
        'th_text'         => 'text-emerald-700 dark:text-emerald-300',
        'table_min'       => 'text-emerald-600 dark:text-emerald-400',
    ],
    'indigo' => [
        'pill_dot'        => 'bg-indigo-500',
        'pill_hover'      => 'hover:border-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400',
        'card_border'     => 'border-indigo-200/80 dark:border-indigo-900/60',
        'card_hover'      => 'hover:border-indigo-400/80 dark:hover:border-indigo-500/60 hover:shadow-indigo-500/10',
        'subcard_hover'   => 'group-hover/card:border-indigo-300/80 dark:group-hover/card:border-indigo-700/60',
        'accent_gradient' => 'before:via-indigo-500',
        'title_hover'     => 'group-hover/card:text-indigo-600 dark:group-hover/card:text-indigo-400',
        'glow_bg'         => 'bg-indigo-500/10',
        'glow_ambient'    => 'from-indigo-500/0 via-indigo-500/[0.03] to-indigo-500/[0.08]',
        'badge_bg'        => 'bg-indigo-100 dark:bg-indigo-950 text-indigo-900 dark:text-indigo-300 border-indigo-200 dark:border-indigo-800',
        'tagline_text'    => 'text-indigo-700 dark:text-indigo-400',
        'icon_color'      => 'text-indigo-600 dark:text-indigo-400',
        'icon_bg'         => 'bg-indigo-50 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-300',
        'min_text'        => 'text-indigo-700 dark:text-indigo-400',
        'dot_color'       => 'text-indigo-600',
        'btn_bg'          => 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-indigo-600/20',
        'th_text'         => 'text-indigo-700 dark:text-indigo-300',
        'table_min'       => 'text-indigo-600 dark:text-indigo-400',
    ],
    'cyan' => [
        'pill_dot'        => 'bg-cyan-500',
        'pill_hover'      => 'hover:border-cyan-500 hover:text-cyan-600 dark:hover:text-cyan-400',
        'card_border'     => 'border-cyan-200/80 dark:border-cyan-900/60',
        'card_hover'      => 'hover:border-cyan-400/80 dark:hover:border-cyan-500/60 hover:shadow-cyan-500/10',
        'subcard_hover'   => 'group-hover/card:border-cyan-300/80 dark:group-hover/card:border-cyan-700/60',
        'accent_gradient' => 'before:via-cyan-500',
        'title_hover'     => 'group-hover/card:text-cyan-600 dark:group-hover/card:text-cyan-400',
        'glow_bg'         => 'bg-cyan-500/10',
        'glow_ambient'    => 'from-cyan-500/0 via-cyan-500/[0.03] to-cyan-500/[0.08]',
        'badge_bg'        => 'bg-cyan-100 dark:bg-cyan-950 text-cyan-900 dark:text-cyan-300 border-cyan-200 dark:border-cyan-800',
        'tagline_text'    => 'text-cyan-700 dark:text-cyan-400',
        'icon_color'      => 'text-cyan-600 dark:text-cyan-400',
        'icon_bg'         => 'bg-cyan-50 dark:bg-cyan-900/50 text-cyan-600 dark:text-cyan-300',
        'min_text'        => 'text-cyan-700 dark:text-cyan-400',
        'dot_color'       => 'text-cyan-600',
        'btn_bg'          => 'bg-cyan-600 hover:bg-cyan-700 text-white shadow-cyan-600/20',
        'th_text'         => 'text-cyan-700 dark:text-cyan-300',
        'table_min'       => 'text-cyan-600 dark:text-cyan-400',
    ],
    'rose' => [
        'pill_dot'        => 'bg-rose-500',
        'pill_hover'      => 'hover:border-rose-500 hover:text-rose-600 dark:hover:text-rose-400',
        'card_border'     => 'border-rose-200/80 dark:border-rose-900/60',
        'card_hover'      => 'hover:border-rose-400/80 dark:hover:border-rose-500/60 hover:shadow-rose-500/10',
        'subcard_hover'   => 'group-hover/card:border-rose-300/80 dark:group-hover/card:border-rose-700/60',
        'accent_gradient' => 'before:via-rose-500',
        'title_hover'     => 'group-hover/card:text-rose-600 dark:group-hover/card:text-rose-400',
        'glow_bg'         => 'bg-rose-500/10',
        'glow_ambient'    => 'from-rose-500/0 via-rose-500/[0.03] to-rose-500/[0.08]',
        'badge_bg'        => 'bg-rose-100 dark:bg-rose-950 text-rose-900 dark:text-rose-300 border-rose-200 dark:border-rose-800',
        'tagline_text'    => 'text-rose-700 dark:text-rose-400',
        'icon_color'      => 'text-rose-600 dark:text-rose-400',
        'icon_bg'         => 'bg-rose-50 dark:bg-rose-900/50 text-rose-600 dark:text-rose-300',
        'min_text'        => 'text-rose-700 dark:text-rose-400',
        'dot_color'       => 'text-rose-600',
        'btn_bg'          => 'bg-rose-600 hover:bg-rose-700 text-white shadow-rose-600/20',
        'th_text'         => 'text-rose-700 dark:text-rose-300',
        'table_min'       => 'text-rose-600 dark:text-rose-400',
    ],
    'orange' => [
        'pill_dot'        => 'bg-orange-500',
        'pill_hover'      => 'hover:border-orange-500 hover:text-orange-600 dark:hover:text-orange-400',
        'card_border'     => 'border-orange-200/80 dark:border-orange-900/60',
        'card_hover'      => 'hover:border-orange-400/80 dark:hover:border-orange-500/60 hover:shadow-orange-500/10',
        'subcard_hover'   => 'group-hover/card:border-orange-300/80 dark:group-hover/card:border-orange-700/60',
        'accent_gradient' => 'before:via-orange-500',
        'title_hover'     => 'group-hover/card:text-orange-600 dark:group-hover/card:text-orange-400',
        'glow_bg'         => 'bg-orange-500/10',
        'glow_ambient'    => 'from-orange-500/0 via-orange-500/[0.03] to-orange-500/[0.08]',
        'badge_bg'        => 'bg-orange-100 dark:bg-orange-950 text-orange-900 dark:text-orange-300 border-orange-200 dark:border-orange-800',
        'tagline_text'    => 'text-orange-700 dark:text-orange-400',
        'icon_color'      => 'text-orange-600 dark:text-orange-400',
        'icon_bg'         => 'bg-orange-50 dark:bg-orange-900/50 text-orange-600 dark:text-orange-300',
        'min_text'        => 'text-orange-700 dark:text-orange-400',
        'dot_color'       => 'text-orange-600',
        'btn_bg'          => 'bg-orange-600 hover:bg-orange-700 text-white shadow-orange-600/20',
        'th_text'         => 'text-orange-700 dark:text-orange-300',
        'table_min'       => 'text-orange-600 dark:text-orange-400',
    ],
    'slate' => [
        'pill_dot'        => 'bg-slate-500',
        'pill_hover'      => 'hover:border-slate-500 hover:text-slate-700 dark:hover:text-slate-300',
        'card_border'     => 'border-slate-300 dark:border-slate-700',
        'card_hover'      => 'hover:border-slate-400 dark:hover:border-slate-600 hover:shadow-slate-500/10',
        'subcard_hover'   => 'group-hover/card:border-slate-400 dark:group-hover/card:border-slate-600',
        'accent_gradient' => 'before:via-slate-500',
        'title_hover'     => 'group-hover/card:text-slate-800 dark:group-hover/card:text-white',
        'glow_bg'         => 'bg-slate-500/10',
        'glow_ambient'    => 'from-slate-500/0 via-slate-500/[0.03] to-slate-500/[0.08]',
        'badge_bg'        => 'bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-slate-200 border-slate-300 dark:border-slate-700',
        'tagline_text'    => 'text-slate-700 dark:text-slate-300',
        'icon_color'      => 'text-slate-700 dark:text-slate-300',
        'icon_bg'         => 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300',
        'min_text'        => 'text-slate-800 dark:text-slate-200',
        'dot_color'       => 'text-slate-600',
        'btn_bg'          => 'bg-slate-800 hover:bg-slate-900 dark:bg-slate-700 dark:hover:bg-slate-600 text-white',
        'th_text'         => 'text-slate-800 dark:text-slate-200',
        'table_min'       => 'text-slate-700 dark:text-slate-300',
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
     HEADER BANNER & BREADCRUMBS (WITH LPS GUARANTEE & WATERMARK)
     ======================================== -->
<section class="relative z-10 pt-8 pb-12 md:pb-16 overflow-hidden bg-slate-50 dark:bg-dark-surface border-b border-slate-200/60 dark:border-slate-800/60">
    <!-- Ambient Blur Background -->
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
            <span class="text-teal-600 dark:text-teal-400 font-semibold">Tabungan Syariah</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-8">
            <div class="lg:col-span-8" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                    <?php echo esc_html( $tab_page_badge ); ?>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                    <?php echo esc_html( $tab_page_title ); ?>
                </h1>
                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                    <?php echo esc_html( $tab_page_sub ); ?>
                </p>

                <!-- Quote Box Resmi -->
                <?php if ( ! empty( $tab_quote ) ) : ?>
                <div class="p-4 sm:p-5 rounded-2xl bg-white/80 dark:bg-slate-800/80 border-l-4 border-teal-600 border border-slate-200/80 dark:border-slate-700 shadow-sm text-xs sm:text-sm text-slate-700 dark:text-slate-300 italic leading-relaxed">
                    <?php echo esc_html( $tab_quote ); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- LPS & Security Badge (4 Kolom) - Enhanced Animation & Holographic Badge -->
            <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="100">
                <div class="spotlight-card relative overflow-hidden rounded-3xl p-6 sm:p-7 bg-white/95 dark:bg-slate-900/90 border border-teal-200/80 dark:border-teal-900/60 shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 text-center space-y-4 group cursor-default before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-teal-500 via-cyan-400 to-teal-600">
                    <!-- Interactive Slide Watermark Emblem -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.045] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.08] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                    </div>

                    <!-- Holographic Shield Icon with Glow -->
                    <div class="relative w-16 h-16 rounded-2xl bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-300 flex items-center justify-center mx-auto shadow-lg shadow-teal-500/10 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 z-10">
                        <div class="absolute inset-0 rounded-2xl bg-teal-400/20 blur-md opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <svg class="w-8 h-8 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-teal-50 dark:bg-teal-950 text-teal-700 dark:text-teal-300 text-[10px] font-extrabold uppercase tracking-wider mb-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                            <?php echo esc_html( $tab_lps_tag ); ?>
                        </div>
                        <h4 class="text-lg font-black text-slate-900 dark:text-white"><?php echo esc_html( $tab_lps_title ); ?></h4>
                    </div>

                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed relative z-10">
                        <?php echo esc_html( $tab_lps_desc ); ?>
                    </p>

                    <div class="pt-2 relative z-10">
                        <a href="#kalkulator" class="inline-flex items-center gap-1.5 text-xs font-extrabold text-teal-600 hover:text-teal-700 dark:text-teal-300 dark:hover:text-teal-200 transition-colors">
                            <span><?php echo esc_html( $tab_lps_btn ); ?></span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </a>
                    </div>
                </div>
            </div>
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
            <a href="#komparasi" class="px-4 py-2 rounded-xl bg-teal-50 dark:bg-teal-950/50 border border-teal-200 dark:border-teal-800 text-teal-700 dark:text-teal-300 hover:bg-teal-100 dark:hover:bg-teal-900/50 shadow-sm transition-all inline-flex items-center gap-2">
                <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 12h18M3 18h18" /></svg>
                <span>Tabel Perbandingan</span>
            </a>
            <a href="#kalkulator" class="px-4 py-2 rounded-xl bg-primary-50 dark:bg-primary-950/50 border border-primary-200 dark:border-primary-800 text-primary-700 dark:text-teal-300 hover:bg-primary-100 dark:hover:bg-primary-900/50 shadow-sm transition-all inline-flex items-center gap-2">
                <svg class="w-3.5 h-3.5 text-primary-600 dark:text-teal-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                <span>Kalkulator Simulasi</span>
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
        <div id="<?php echo esc_attr( $prod['slug'] ); ?>" 
             class="hub-product-card scroll-mt-28 p-6 sm:p-8 lg:p-10 rounded-3xl bg-gradient-to-br from-white via-white to-slate-50/70 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800/70 backdrop-blur-xl border <?php echo esc_attr( $c_theme['card_border'] ); ?> <?php echo esc_attr( $c_theme['card_hover'] ); ?> shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 relative overflow-hidden group/card before:absolute before:inset-x-0 before:top-0 before:h-1 sm:before:h-1.5 before:bg-gradient-to-r before:from-transparent <?php echo esc_attr( $c_theme['accent_gradient'] ); ?> before:to-transparent before:opacity-0 group-hover/card:before:opacity-100 before:scale-x-75 group-hover/card:scale-x-100 before:transition-all before:duration-700 before:ease-out" 
             data-aos="fade-up">
            
            <!-- 1. Ambient Glow Blob (Soft Breathing Aura) -->
            <div class="absolute -right-24 -top-24 w-80 h-80 sm:w-96 sm:h-96 <?php echo esc_attr( $c_theme['glow_bg'] ); ?> rounded-full blur-3xl pointer-events-none opacity-40 group-hover/card:opacity-90 group-hover/card:scale-125 transition-all duration-700 ease-out"></div>

            <!-- 2. Subtle Card Surface Gradient Glow on Hover -->
            <div class="absolute inset-0 bg-gradient-to-br <?php echo esc_attr( $c_theme['glow_ambient'] ); ?> opacity-0 group-hover/card:opacity-100 pointer-events-none transition-opacity duration-700 ease-out"></div>

            <!-- 3. Sliding GPU-accelerated Watermark Emblem (untitled4.png) -->
            <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-64 sm:w-80 h-64 sm:h-80 opacity-[0.04] dark:opacity-[0.03] pointer-events-none transition-all duration-700 ease-out group-hover/card:left-full group-hover/card:-translate-x-1/2 group-hover/card:scale-125 group-hover/card:opacity-[0.075] dark:group-hover/card:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden z-0">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start relative z-10">
                <!-- Kolom Kiri: Detail & Keunggulan (7 Kolom) -->
                <div class="lg:col-span-7">
                    <!-- Header Badges & Themed Icon -->
                    <div class="flex items-center justify-between gap-3 mb-4">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <div class="w-10 h-10 rounded-2xl <?php echo esc_attr( $c_theme['icon_bg'] ); ?> flex items-center justify-center flex-shrink-0 shadow-sm group-hover/card:scale-110 group-hover/card:rotate-3 transition-all duration-500 ease-out">
                                <?php echo wakalumi_render_tabungan_card_icon( $prod['slug'] ?? 'tawakal' ); ?>
                            </div>
                            <span class="px-3 py-1.5 rounded-xl <?php echo esc_attr( $c_theme['badge_bg'] ); ?> text-xs font-extrabold uppercase tracking-wider border shadow-sm">
                                Akad: <?php echo esc_html( $prod['akad'] ); ?>
                            </span>
                            <?php if ( ! empty( $prod['badge'] ) ) : ?>
                                <span class="px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-semibold border border-slate-200/80 dark:border-slate-700/80">
                                    <?php echo esc_html( $prod['badge'] ); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mb-2 <?php echo esc_attr( $c_theme['title_hover'] ); ?> transition-colors duration-300">
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
                                    <svg class="w-4 h-4 <?php echo esc_attr( $c_theme['icon_color'] ); ?> flex-shrink-0 mt-0.5 group-hover/card:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    <span><?php echo esc_html( $item ); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Kolom Kanan: Info Setoran, Syarat & Aksi (5 Kolom) -->
                <div class="lg:col-span-5 bg-gradient-to-br from-white/95 to-slate-50/90 dark:from-slate-800/95 dark:to-slate-850/90 backdrop-blur-md p-6 sm:p-7 rounded-2xl border border-slate-200/90 dark:border-slate-700 shadow-md relative overflow-hidden transition-all duration-500 ease-out group-hover/card:shadow-xl <?php echo esc_attr( $c_theme['subcard_hover'] ); ?>">
                    
                    <!-- Sub-card subtle watermark emblem -->
                    <div class="absolute -right-6 -bottom-6 w-36 h-36 opacity-[0.045] dark:opacity-[0.035] pointer-events-none select-none overflow-hidden transition-all duration-700 ease-out group-hover/card:scale-125 group-hover/card:opacity-[0.08] mix-blend-multiply dark:mix-blend-screen z-0">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                    </div>

                    <div class="relative z-10">
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
        </div>
        <?php endforeach; ?>

    </div>
</section>

<!-- ========================================
     SECTION 2: TABEL KOMPARASI FITUR TABUNGAN (DINAMIS DARI ADMIN)
     ======================================== -->
<section id="komparasi" class="scroll-mt-24 py-16 lg:py-24 bg-slate-100/70 dark:bg-dark-surface border-y border-slate-200/90 dark:border-slate-800 relative">
    <div class="container-wide">
        <div class="text-center max-w-3xl mx-auto mb-12" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-50 dark:bg-teal-950/70 border border-teal-200/80 dark:border-teal-800/80 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-3 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                <?php echo esc_html( $tab_komp_kicker ); ?>
            </div>
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight mt-1 mb-3">
                <?php echo esc_html( $tab_komp_title ); ?>
            </h3>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
                <?php echo esc_html( $tab_komp_desc ); ?>
            </p>
            <div class="mt-3 inline-flex items-center gap-1.5 text-xs text-slate-500 dark:text-slate-400 font-medium sm:hidden">
                <svg class="w-4 h-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                <span>Geser ke samping untuk membandingkan semua produk</span>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-3xl border border-slate-200 dark:border-slate-700 shadow-xl bg-white dark:bg-slate-900 before:absolute before:inset-x-0 before:top-0 before:h-1.5 before:bg-gradient-to-r before:from-teal-500 via-cyan-400 to-emerald-500 z-10" data-aos="fade-up">
            <!-- Subtle Corner Watermark -->
            <div class="absolute -right-10 -bottom-10 w-52 h-52 opacity-[0.035] dark:opacity-[0.025] pointer-events-none select-none overflow-hidden">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100" loading="lazy">
            </div>

            <div class="overflow-x-auto relative z-10">
                <table class="w-full text-left text-sm whitespace-normal border-collapse">
                    <thead>
                        <tr class="bg-slate-50/90 dark:bg-slate-800/90 text-slate-800 dark:text-slate-100 border-b border-slate-200 dark:border-slate-700 divide-x divide-slate-200/70 dark:divide-slate-700/70">
                            <th class="p-5 sm:p-6 font-black text-xs uppercase tracking-wider text-slate-700 dark:text-slate-300 min-w-[200px] sm:min-w-[220px] bg-slate-100/70 dark:bg-slate-800/80">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-teal-500 shadow-sm"></span>
                                    <span>Fitur & Ketentuan</span>
                                </div>
                            </th>
                            <?php foreach ( $tabungan_list as $prod ) : 
                                $c_theme = $color_themes[ $prod['color'] ?? 'teal' ] ?? $color_themes['teal'];
                            ?>
                                <th class="p-5 sm:p-6 min-w-[200px] sm:min-w-[230px]">
                                    <div class="space-y-1.5">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2.5 h-2.5 rounded-full <?php echo esc_attr( $c_theme['pill_dot'] ); ?> flex-shrink-0 shadow-sm"></span>
                                            <span class="font-black text-base text-slate-900 dark:text-white tracking-tight">
                                                <?php echo esc_html( $prod['nama'] ); ?>
                                            </span>
                                        </div>
                                        <div class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 leading-tight line-clamp-1">
                                            <?php echo esc_html( $prod['tagline'] ); ?>
                                        </div>
                                    </div>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200/80 dark:divide-slate-800">
                        <!-- Akad Syariah -->
                        <tr class="odd:bg-white even:bg-slate-50/60 dark:odd:bg-slate-900 dark:even:bg-slate-800/40 hover:bg-teal-50/40 dark:hover:bg-teal-950/20 transition-colors divide-x divide-slate-200/70 dark:divide-slate-800/70">
                            <td class="p-4 sm:p-5 font-bold text-slate-900 dark:text-slate-100 text-xs sm:text-sm bg-slate-50/50 dark:bg-slate-800/40">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                    </div>
                                    <span>Akad Syariah</span>
                                </div>
                            </td>
                            <?php foreach ( $tabungan_list as $prod ) : ?>
                                <td class="p-4 sm:p-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-slate-100 font-bold text-xs border border-slate-200 dark:border-slate-700 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                        <span><?php echo esc_html( $prod['akad'] ); ?></span>
                                    </span>
                                </td>
                            <?php endforeach; ?>
                        </tr>

                        <!-- Setoran Awal Minimal -->
                        <tr class="odd:bg-white even:bg-slate-50/60 dark:odd:bg-slate-900 dark:even:bg-slate-800/40 hover:bg-teal-50/40 dark:hover:bg-teal-950/20 transition-colors divide-x divide-slate-200/70 dark:divide-slate-800/70">
                            <td class="p-4 sm:p-5 font-bold text-slate-900 dark:text-slate-100 text-xs sm:text-sm bg-slate-50/50 dark:bg-slate-800/40">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <span>Setoran Awal Minimal</span>
                                </div>
                            </td>
                            <?php foreach ( $tabungan_list as $prod ) : 
                                $c_theme = $color_themes[ $prod['color'] ?? 'teal' ] ?? $color_themes['teal'];
                            ?>
                                <td class="p-4 sm:p-5">
                                    <div class="space-y-0.5">
                                        <span class="text-sm font-black text-slate-900 dark:text-white block">
                                            <?php echo esc_html( $prod['min_setor'] ); ?>
                                        </span>
                                        <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium block">
                                            Ringan dan terjangkau
                                        </span>
                                    </div>
                                </td>
                            <?php endforeach; ?>
                        </tr>

                        <!-- Biaya Administrasi Bulanan -->
                        <tr class="odd:bg-white even:bg-slate-50/60 dark:odd:bg-slate-900 dark:even:bg-slate-800/40 hover:bg-teal-50/40 dark:hover:bg-teal-950/20 transition-colors divide-x divide-slate-200/70 dark:divide-slate-800/70">
                            <td class="p-4 sm:p-5 font-bold text-slate-900 dark:text-slate-100 text-xs sm:text-sm bg-slate-50/50 dark:bg-slate-800/40">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" /></svg>
                                    </div>
                                    <span>Biaya Admin Bulanan</span>
                                </div>
                            </td>
                            <?php foreach ( $tabungan_list as $prod ) : ?>
                                <td class="p-4 sm:p-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300 font-extrabold text-xs border border-emerald-200/90 dark:border-emerald-800/80 shadow-sm">
                                        <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                                        <span><?php echo esc_html( ! empty( $prod['biaya_admin'] ) ? $prod['biaya_admin'] : 'Gratis (Rp 0)' ); ?></span>
                                    </span>
                                </td>
                            <?php endforeach; ?>
                        </tr>

                        <!-- Sasaran Nasabah -->
                        <tr class="odd:bg-white even:bg-slate-50/60 dark:odd:bg-slate-900 dark:even:bg-slate-800/40 hover:bg-teal-50/40 dark:hover:bg-teal-950/20 transition-colors divide-x divide-slate-200/70 dark:divide-slate-800/70">
                            <td class="p-4 sm:p-5 font-bold text-slate-900 dark:text-slate-100 text-xs sm:text-sm bg-slate-50/50 dark:bg-slate-800/40">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                                    </div>
                                    <span>Sasaran Nasabah</span>
                                </div>
                            </td>
                            <?php foreach ( $tabungan_list as $prod ) : ?>
                                <td class="p-4 sm:p-5 text-slate-800 dark:text-slate-200 text-xs font-semibold leading-relaxed">
                                    <?php echo esc_html( ! empty( $prod['badge'] ) ? $prod['badge'] : $prod['tagline'] ); ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>

                        <!-- Buku Tabungan Fisik -->
                        <tr class="odd:bg-white even:bg-slate-50/60 dark:odd:bg-slate-900 dark:even:bg-slate-800/40 hover:bg-teal-50/40 dark:hover:bg-teal-950/20 transition-colors divide-x divide-slate-200/70 dark:divide-slate-800/70">
                            <td class="p-4 sm:p-5 font-bold text-slate-900 dark:text-slate-100 text-xs sm:text-sm bg-slate-50/50 dark:bg-slate-800/40">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                                    </div>
                                    <span>Buku Tabungan Fisik</span>
                                </div>
                            </td>
                            <?php foreach ( $tabungan_list as $prod ) : ?>
                                <td class="p-4 sm:p-5">
                                    <div class="inline-flex items-center gap-2 text-xs text-slate-800 dark:text-slate-200 font-bold">
                                        <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                                        <span>Disediakan Resmi</span>
                                    </div>
                                </td>
                            <?php endforeach; ?>
                        </tr>

                        <!-- Penarikan Dana -->
                        <tr class="odd:bg-white even:bg-slate-50/60 dark:odd:bg-slate-900 dark:even:bg-slate-800/40 hover:bg-teal-50/40 dark:hover:bg-teal-950/20 transition-colors divide-x divide-slate-200/70 dark:divide-slate-800/70">
                            <td class="p-4 sm:p-5 font-bold text-slate-900 dark:text-slate-100 text-xs sm:text-sm bg-slate-50/50 dark:bg-slate-800/40">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" /></svg>
                                    </div>
                                    <span>Fleksibilitas Penarikan</span>
                                </div>
                            </td>
                            <?php foreach ( $tabungan_list as $prod ) : ?>
                                <td class="p-4 sm:p-5 text-xs text-slate-800 dark:text-slate-200 leading-relaxed font-medium">
                                    <?php 
                                    if ( $prod['slug'] === 'haji-umroh' ) {
                                        echo '<span class="font-bold text-amber-700 dark:text-amber-300">Terencana:</span> Saat pelunasan / keberangkatan ibadah';
                                    } elseif ( $prod['slug'] === 'ukhuwah' ) {
                                        echo '<span class="font-bold text-purple-700 dark:text-purple-300">Komitmen:</span> Periode program berhadiah';
                                    } else {
                                        echo '<span class="font-bold text-teal-700 dark:text-teal-300">Fleksibel:</span> Kapan pun pada jam operasional kantor';
                                    }
                                    ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>

                        <!-- Aksi / Konsultasi Cepat (Action Row) -->
                        <tr class="bg-slate-50/90 dark:bg-slate-800/90 divide-x divide-slate-200/70 dark:divide-slate-800/70">
                            <td class="p-4 sm:p-5 font-bold text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 bg-slate-100/70 dark:bg-slate-800">
                                Aksi Cepat
                            </td>
                            <?php foreach ( $tabungan_list as $prod ) : 
                                $c_theme = $color_themes[ $prod['color'] ?? 'teal' ] ?? $color_themes['teal'];
                                $prod_wa_msg = ! empty( $prod['wa_text'] ) ? $prod['wa_text'] : 'Halo BPRS Wakalumi, saya tertarik membuka simpanan ' . $prod['nama'] . '. Mohon informasinya.';
                            ?>
                                <td class="p-4 sm:p-5 text-center">
                                    <a 
                                        href="https://wa.me/<?php echo esc_attr( $clean_wa ); ?>?text=<?php echo urlencode( $prod_wa_msg ); ?>" 
                                        target="_blank" 
                                        rel="noopener noreferrer" 
                                        class="w-full py-2.5 px-3.5 rounded-xl <?php echo esc_attr( $c_theme['btn_bg'] ); ?> font-bold text-xs inline-flex items-center justify-center gap-1.5 shadow-sm hover:shadow transition-all"
                                    >
                                        <span>Buka <?php echo esc_html( $prod['nama'] ); ?></span>
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                    </a>
                                </td>
                            <?php endforeach; ?>
                        </tr>

                        <!-- Perlindungan Simpanan LPS & OJK -->
                        <tr>
                            <td class="p-4 sm:p-5 bg-teal-50/80 dark:bg-teal-950/40 border-t border-teal-200/80 dark:border-teal-800/80" colspan="<?php echo esc_attr( count( $tabungan_list ) + 1 ); ?>">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                                    <div class="inline-flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-lg bg-teal-600 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                                        </div>
                                        <span class="font-extrabold text-teal-900 dark:text-teal-200">
                                            <?php echo esc_html( $tab_komp_lps ); ?>
                                        </span>
                                    </div>
                                    <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">
                                        *Simpanan dijamin hingga Rp 2 Miliar per nasabah per bank
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 3: KALKULATOR SIMULASI TABUNGAN (REAL-TIME INTERAKTIF)
     ======================================== -->
<section id="kalkulator" class="scroll-mt-24 py-14 lg:py-20 bg-white dark:bg-dark-surface-alt relative overflow-hidden">
    <div class="container-wide">
        <div class="max-w-4xl mx-auto p-6 sm:p-10 lg:p-12 rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-teal-950 text-white shadow-2xl relative overflow-hidden group" data-aos="fade-up">
            <!-- Dynamic Top Accent Gradient Line -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-teal-400 via-cyan-400 to-emerald-400"></div>

            <!-- Ambient Glow Effect -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Subtle GPU-sliding Watermark untitled4.png -->
            <div class="absolute -right-6 top-1/2 -translate-y-1/2 w-64 h-64 opacity-[0.035] dark:opacity-[0.05] pointer-events-none transition-all duration-700 ease-out group-hover:scale-125 group-hover:opacity-[0.07] mix-blend-screen select-none overflow-hidden">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 invert" loading="lazy">
            </div>

            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-500/20 text-teal-300 text-xs font-bold uppercase tracking-wider mb-3 border border-teal-500/30 shadow-sm">
                    <svg class="w-3.5 h-3.5 text-teal-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <span><?php echo esc_html( $calc_badge ); ?></span>
                </div>
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight mb-2 text-white">
                    <?php echo esc_html( $calc_title ); ?>
                </h3>
                <p class="text-sm sm:text-base text-slate-300 mb-8 max-w-2xl leading-relaxed">
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
                            <select id="wkl-calc-product" class="w-full py-3 px-4 rounded-xl bg-slate-800/90 border border-slate-700 text-white font-semibold text-sm focus:outline-none focus:border-teal-400 transition-colors">
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
                                    Rp <?php echo esc_html( number_format( (float) $calc_default, 0, ',', '.' ) ); ?>
                                </span>
                            </div>
                            <input 
                                type="range" 
                                id="wkl-calc-target-range" 
                                min="<?php echo esc_attr( $calc_min ); ?>" 
                                max="<?php echo esc_attr( $calc_max ); ?>" 
                                step="500000" 
                                value="<?php echo esc_attr( $calc_default ); ?>" 
                                class="w-full h-2.5 bg-slate-700/90 rounded-lg appearance-none cursor-pointer accent-teal-400"
                            >
                            <div class="flex items-center justify-between text-[11px] text-slate-400 mt-1.5">
                                <span>Min: Rp <?php echo number_format( (float) $calc_min, 0, ',', '.' ); ?></span>
                                <span>Maks: Rp <?php echo number_format( (float) $calc_max, 0, ',', '.' ); ?></span>
                            </div>
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
                                class="w-full h-2.5 bg-slate-700/90 rounded-lg appearance-none cursor-pointer accent-teal-400"
                            >
                            <div class="flex justify-between text-[11px] text-slate-400 mt-1.5">
                                <span>6 Bulan</span>
                                <span>12 Bulan (1 Thn)</span>
                                <span>24 Bulan (2 Thn)</span>
                                <span>36 Bulan (3 Thn)</span>
                                <span>60 Bulan (5 Thn)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Output Box (5 Kolom) -->
                    <div class="lg:col-span-5 bg-slate-800/80 p-6 sm:p-7 rounded-2xl border border-teal-500/30 text-center relative shadow-inner overflow-hidden group/box">
                        <!-- Corner Watermark inside output card -->
                        <div class="absolute -right-6 -bottom-6 w-36 h-36 opacity-[0.035] pointer-events-none select-none mix-blend-screen transition-transform duration-700 ease-out group-hover/box:scale-110">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 invert" loading="lazy">
                        </div>

                        <div class="relative z-10">
                            <span class="text-xs text-slate-400 uppercase tracking-wider font-bold block mb-1">
                                Estimasi Sisihan per Bulan (*Estimasi)
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
                                    class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-400 hover:from-teal-400 hover:to-cyan-300 text-slate-950 font-black text-sm inline-flex items-center justify-center gap-2 shadow-lg transition-transform hover:scale-[1.02]"
                                >
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                    <span><?php echo esc_html( $calc_btn ); ?></span>
                                </a>
                                <span class="text-[11px] text-slate-400 block">
                                    <?php echo esc_html( $calc_note ); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 4: 4 KEUNGGULAN PRINSIP SYARIAH (HARMONIZED EXECUTIVE TILES)
     ======================================== -->
<section class="py-14 lg:py-20 bg-slate-50/80 dark:bg-dark-surface relative overflow-hidden border-y border-slate-200/80 dark:border-slate-800/80">
    <div class="container-wide relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-50 dark:bg-teal-950/70 border border-teal-200/80 dark:border-teal-800/80 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-3 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                <?php echo esc_html( $tab_keung_kicker ); ?>
            </div>
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-3">
                <?php echo esc_html( $tab_keung_title ); ?>
            </h3>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 leading-relaxed">
                <?php echo esc_html( $tab_keung_desc ); ?>
            </p>
        </div>

        <?php
        $tab_keunggulan_items = [
            [
                'title' => $tab_keung_1_title,
                'desc'  => $tab_keung_1_desc,
                'icon'  => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                'theme' => 'teal',
            ],
            [
                'title' => $tab_keung_2_title,
                'desc'  => $tab_keung_2_desc,
                'icon'  => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>',
                'theme' => 'cyan',
            ],
            [
                'title' => $tab_keung_3_title,
                'desc'  => $tab_keung_3_desc,
                'icon'  => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>',
                'theme' => 'emerald',
            ],
            [
                'title' => $tab_keung_4_title,
                'desc'  => $tab_keung_4_desc,
                'icon'  => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                'theme' => 'indigo',
            ],
        ];
        ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" data-aos="fade-up">
            <?php foreach ( $tab_keunggulan_items as $k_idx => $k_item ) : 
                $num_badge = sprintf( '%02d', $k_idx + 1 );
            ?>
                <div class="hub-product-card relative overflow-hidden p-6 sm:p-7 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 ease-out group cursor-default flex flex-col justify-between before:absolute before:top-0 before:left-0 before:right-0 before:h-1 before:bg-gradient-to-r before:from-teal-500 before:to-cyan-400 before:scale-x-75 group-hover:before:scale-x-100 before:transition-transform before:duration-700 before:ease-out">
                    <!-- Sliding Watermark untitled4.png -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-32 h-32 opacity-[0.04] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.08] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100" loading="lazy">
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-300 flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 ease-out shadow-sm">
                                <?php echo $k_item['icon']; ?>
                            </div>
                            <span class="text-xs font-black text-slate-400 dark:text-slate-500 px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 group-hover:text-teal-600 dark:group-hover:text-teal-400 group-hover:bg-teal-50 dark:group-hover:bg-teal-950/60 transition-colors">
                                <?php echo esc_html( $num_badge ); ?>
                            </span>
                        </div>
                        <h4 class="text-base font-extrabold text-slate-900 dark:text-white mb-2 group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                            <?php echo esc_html( $k_item['title'] ); ?>
                        </h4>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                            <?php echo esc_html( $k_item['desc'] ); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 5: FAQ & UNDUH BROSUR (FULL DYNAMIC & HARMONIZED)
     ======================================== -->
<section class="py-14 lg:py-20 bg-white dark:bg-dark-surface-alt border-t border-slate-200/60 dark:border-slate-800/60 relative overflow-hidden">
    <div class="container-wide">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            <!-- FAQ (7 Kolom) -->
            <div class="lg:col-span-7" data-aos="fade-right">
                <span class="text-xs font-extrabold uppercase tracking-wider text-teal-600 dark:text-teal-400 bg-teal-50 dark:bg-teal-950/60 px-3.5 py-1.5 rounded-full border border-teal-200 dark:border-teal-800 shadow-sm">
                    <?php echo esc_html( $faq_badge ); ?>
                </span>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-3 mb-2 tracking-tight">
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
                            <div class="p-5 rounded-2xl bg-slate-50/80 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700 hover:border-teal-400/80 dark:hover:border-teal-600/80 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 ease-out">
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

            <!-- Card Unduh Brosur & Promo Deposito (5 Kolom) -->
            <div class="lg:col-span-5 space-y-6" data-aos="fade-left">
                <!-- Box Brosur -->
                <div class="hub-product-card p-6 sm:p-7 rounded-3xl bg-teal-50/80 dark:bg-slate-900 border border-teal-200/80 dark:border-teal-800/80 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 ease-out text-slate-900 dark:text-white relative overflow-hidden group before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-teal-500 before:to-cyan-400 before:scale-x-75 group-hover:before:scale-x-100 before:transition-transform before:duration-700 before:ease-out">
                    <!-- Sliding Watermark untitled4.png -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.045] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.08] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100" loading="lazy">
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center gap-3.5 mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-teal-600 text-white flex items-center justify-center flex-shrink-0 shadow-md group-hover:scale-110 group-hover:rotate-3 transition-all duration-500 ease-out">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <span class="text-[11px] font-extrabold uppercase tracking-wider text-teal-700 dark:text-teal-300 block">
                                    <?php echo esc_html( $tab_brosur_kicker ); ?>
                                </span>
                                <h4 class="text-base font-extrabold leading-tight text-slate-900 dark:text-white">
                                    <?php echo esc_html( $tab_brosur_title ); ?>
                                </h4>
                            </div>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-5">
                            <?php echo esc_html( $tab_brosur_desc ); ?>
                        </p>
                        <a 
                            href="<?php echo ! empty( $brosur_url ) ? esc_url( $brosur_url ) : 'https://wa.me/' . esc_attr( $clean_wa ) . '?text=' . urlencode( 'Halo BPRS Wakalumi, saya ingin meminta brosur lengkap produk tabungan syariah.' ); ?>" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            <?php echo ! empty( $brosur_url ) ? 'download' : ''; ?>
                            class="w-full py-3.5 px-4 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs inline-flex items-center justify-center gap-2 shadow-sm transition-all hover:shadow-teal-500/20"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            <span><?php echo esc_html( $tab_brosur_btn ); ?></span>
                        </a>
                    </div>
                </div>

                <!-- Box Buka Deposito Mudharabah -->
                <div class="hub-product-card p-6 sm:p-7 rounded-3xl bg-slate-100/90 dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 ease-out text-slate-900 dark:text-white relative overflow-hidden group before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-teal-600 via-primary-500 to-cyan-400 before:scale-x-75 group-hover:before:scale-x-100 before:transition-transform before:duration-700 before:ease-out">
                    <!-- Sliding Watermark untitled4.png -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.04] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.08] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100" loading="lazy">
                    </div>

                    <div class="relative z-10">
                        <span class="text-xs font-bold text-teal-600 dark:text-teal-400 block mb-1">
                            <?php echo esc_html( $tab_dep_kicker ); ?>
                        </span>
                        <h4 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white mb-2">
                            <?php echo esc_html( $tab_dep_title ); ?>
                        </h4>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-4">
                            <?php echo esc_html( $tab_dep_desc ); ?>
                        </p>
                        <a href="<?php echo esc_url( home_url( '/produk/deposito-syariah' ) ); ?>" class="text-xs font-bold text-teal-700 dark:text-teal-300 hover:text-teal-600 inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                            <span><?php echo esc_html( $tab_dep_btn ); ?></span>
                            <span>&rarr;</span>
                        </a>
                    </div>
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
