<?php
/**
 * Template Name: Pembiayaan Syariah
 *
 * Halaman Produk Penyaluran Dana (Lending / Pembiayaan Syariah) BPRS Wakalumi:
 * 8 Produk Resmi (1000 Pedagang, 1000 Guru, Murabahah, Mudharabah, Musyarakah, Ijarah, Multijasa, Qardhul Hasan),
 * Tabel Komparasi Matriks, Kalkulator Simulasi Angsuran Syariah, Alur Pengajuan, FAQ, dan Banner CTA.
 *
 * @package Wakalumi
 */

get_header();

// ── PENGATURAN HEADER & SYARIAH DARI ADMIN ────────────────────────
$page_badge  = get_option( 'options_pembiayaan_page_badge', 'Penyaluran Dana Berkah' );
$page_title  = get_option( 'options_pembiayaan_page_title', 'Solusi Pembiayaan Syariah BPRS Wakalumi' );
$page_sub    = get_option( 'options_pembiayaan_page_subtitle', 'Mendukung pertumbuhan usaha mikro, UMKM, profesi tenaga pendidik, hingga pemenuhan kebutuhan keluarga dengan prinsip syariah yang adil, amanah, dan tanpa riba.' );
$page_quote  = get_option( 'options_pembiayaan_quote', 'Allah telah menghalalkan jual beli dan mengharamkan riba. (QS. Al-Baqarah: 275) — Berbisnis dan bermuamalah dengan penuh ketenangan, keadilan, dan keberkahan bagi seluruh pihak.' );

$trust_tag   = get_option( 'options_pembiayaan_trust_tag', 'Kepatuhan Regulasi & Syariah' );
$trust_title = get_option( 'options_pembiayaan_trust_title', 'Izin Resmi OJK & Dewan Pengawas Syariah' );
$trust_desc  = get_option( 'options_pembiayaan_trust_desc', 'Seluruh produk penyaluran dana BPRS Wakalumi beroperasi di bawah pengawasan Otoritas Jasa Keuangan (OJK) serta dipandu oleh Dewan Pengawas Syariah (DPS) yang tersertifikasi DSN-MUI.' );
$trust_btn   = get_option( 'options_pembiayaan_trust_btn', 'Simulasi Angsuran Syariah' );

// ── DAFTAR PRODUK PEMBIAYAAN DINAMIS ──────────────────────────────
$pembiayaan_list = function_exists( 'wakalumi_get_pembiayaan_list' ) ? wakalumi_get_pembiayaan_list() : [];

// ── PENGATURAN KALKULATOR ANGSURAN ────────────────────────────────
$calc_badge     = get_option( 'options_pembiayaan_calc_badge', 'Simulasi Finansial Syariah' );
$calc_title     = get_option( 'options_pembiayaan_calc_title', 'Kalkulator Simulasi Angsuran Pembiayaan' );
$calc_sub       = get_option( 'options_pembiayaan_calc_sub', 'Hitung estimasi angsuran bulanan yang adil dan transparan tanpa ada biaya tersembunyi. Tentukan plafon dan tenor sesuai kenyamanan arus kas Anda.' );
$calc_min       = get_option( 'options_pembiayaan_calc_min', '5000000' );
$calc_max       = get_option( 'options_pembiayaan_calc_max', '500000000' );
$calc_default   = get_option( 'options_pembiayaan_calc_default', '25000000' );
$calc_rate      = get_option( 'options_pembiayaan_calc_rate', '11.5' );
$calc_note      = get_option( 'options_pembiayaan_calc_note', '*Estimasi indikatif dengan formula perhitungan margin setara flat per tahun. Perhitungan riil disepakati saat akad resmi.' );
$calc_btn_text  = get_option( 'options_pembiayaan_calc_btn_text', 'Ajukan Pembiayaan via WhatsApp' );
$calc_presets   = function_exists( 'wakalumi_get_pembiayaan_calc_presets' ) ? wakalumi_get_pembiayaan_calc_presets() : [];

// ── ALUR 4 LANGKAH PENGAJUAN ──────────────────────────────────────
$alur_kicker    = get_option( 'options_pembiayaan_alur_kicker', 'Proses Mudah & Cepat' );
$alur_title     = get_option( 'options_pembiayaan_alur_title', '4 Tahapan Mudah Pengajuan Pembiayaan' );
$alur_sub       = get_option( 'options_pembiayaan_alur_sub', 'Panduan tahapan transparan mulai dari konsultasi awal hingga dana pembiayaan cair ke rekening Anda.' );
$step_1_title   = get_option( 'options_pembiayaan_step_1_title', '1. Konsultasi & Formulir' );
$step_1_desc    = get_option( 'options_pembiayaan_step_1_desc', 'Hubungi tim relationship manager via WhatsApp atau kunjungi kantor BPRS Wakalumi untuk konsultasi kebutuhan dana.' );
$step_2_title   = get_option( 'options_pembiayaan_step_2_title', '2. Verifikasi Dokumen' );
$step_2_desc    = get_option( 'options_pembiayaan_step_2_desc', 'Serahkan berkas identitas, bukti usaha/penghasilan, dan dokumen jaminan untuk verifikasi bersahabat.' );
$step_3_title   = get_option( 'options_pembiayaan_step_3_title', '3. Akad Syariah Transparan' );
$step_3_desc    = get_option( 'options_pembiayaan_step_3_desc', 'Penandatanganan akad (Murabahah/Mudharabah/Ijarah) dilakukan secara transparan tanpa klausul jebakan.' );
$step_4_title   = get_option( 'options_pembiayaan_step_4_title', '4. Pencairan Cepat' );
$step_4_desc    = get_option( 'options_pembiayaan_step_4_desc', 'Dana dicairkan ke rekening Anda untuk mendukung kemajuan usaha atau kebutuhan dengan pendampingan berkala.' );

// ── FAQ PEMBIAYAAN ────────────────────────────────────────────────
$faq_badge      = get_option( 'options_pembiayaan_faq_badge', 'Tanya Jawab (FAQ)' );
$faq_title      = get_option( 'options_pembiayaan_faq_title', 'Pertanyaan Seputar Pembiayaan Syariah' );
$faq_sub        = get_option( 'options_pembiayaan_faq_sub', 'Pertanyaan umum nasabah seputar jaminan, waktu pencairan, sistem pelunasan, dan bebas denda riba.' );
$faq_list       = function_exists( 'wakalumi_get_pembiayaan_faq_list' ) ? wakalumi_get_pembiayaan_faq_list() : [];

// ── BOX KONSULTASI RELATIONSHIP MANAGER ─────────────────────────────
$rm_show        = get_option( 'options_pembiayaan_rm_show', '1' );
$rm_title       = get_option( 'options_pembiayaan_rm_title', 'Konsultasi Relationship Manager' );
$rm_desc        = get_option( 'options_pembiayaan_rm_desc', 'Butuh penjelasan tatap muka atau survei ke tempat usaha Anda? Hubungi relationship manager kami untuk konsultasi pembiayaan secara langsung.' );
$rm_btn_text    = get_option( 'options_pembiayaan_rm_btn_text', 'Hubungi Relationship Manager' );
$rm_wa_msg      = get_option( 'options_pembiayaan_rm_wa_msg', 'Halo Relationship Manager BPRS Wakalumi, saya membutuhkan konsultasi mengenai pengajuan pembiayaan usaha.' );
$rm_wa_num      = get_option( 'options_pembiayaan_rm_wa_num', '' );
$rm_wa_clean    = ! empty( $rm_wa_num ) ? preg_replace( '/[^0-9]/', '', $rm_wa_num ) : '';
if ( ! empty( $rm_wa_clean ) && substr( $rm_wa_clean, 0, 1 ) === '0' ) {
    $rm_wa_clean = '62' . substr( $rm_wa_clean, 1 );
}

// ── BANNER CTA KONSULTASI DARI ADMIN ───────────────────────────────
$cta_kicker     = get_option( 'options_pembiayaan_cta_kicker', 'Konsultasi Pembiayaan Bebas Riba' );
$cta_title      = get_option( 'options_pembiayaan_cta_title', 'Siap Mengembangkan Usaha & Memenuhi Kebutuhan dengan Berkah?' );
$cta_desc       = get_option( 'options_pembiayaan_cta_desc', 'Diskusikan rencana usaha atau kebutuhan pembiayaan Anda bersama staf pembiayaan profesional BPRS Wakalumi. Kami siap melayani dengan akad syariah yang adil dan amanah.' );
$cta_btn_text   = get_option( 'options_pembiayaan_cta_btn_text', 'Konsultasi via WhatsApp Sekarang' );
$cta_wa_msg     = get_option( 'options_pembiayaan_cta_wa_msg', 'Halo BPRS Wakalumi, saya ingin berkonsultasi mengenai pengajuan pembiayaan syariah. Mohon informasi syarat dan simulasi angsurannya.' );

// WhatsApp Kontak Utama
$default_wa     = get_option( 'options_contact_wa', '6281517380388' );
$wa_number      = get_option( 'options_produk_wa_number', $default_wa );
$clean_wa       = preg_replace( '/[^0-9]/', '', $wa_number );

// Brosur File
$brosur_url     = get_option( 'options_brosur_file_url', '' );

/**
 * Helper Konversi Garis Teks Menjadi Array
 */
if ( ! function_exists( 'wakalumi_lines_to_list' ) ) {
    function wakalumi_lines_to_list( $text ) {
        $lines = explode( "\n", str_replace( "\r", "", (string) $text ) );
        return array_filter( array_map( 'trim', $lines ) );
    }
}

/**
 * Helper Ikon Kartu Pembiayaan SVG
 */
if ( ! function_exists( 'wakalumi_render_pembiayaan_icon' ) ) {
    function wakalumi_render_pembiayaan_icon( string $icon_key = '' ): string {
        switch ( $icon_key ) {
            case 'store':
            case 'pedagang':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009 9.35c.66 0 1.28-.213 1.785-.578a3.001 3.001 0 004.43 0c.506.365 1.125.578 1.785.578a2.993 2.993 0 002.465-1.281 3.001 3.001 0 003.75.615M2.25 9.35l1.64-5.33A1.5 1.5 0 015.32 3h13.36a1.5 1.5 0 011.43 1.02l1.64 5.33"/></svg>';
            case 'education':
            case 'guru':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>';
            case 'cart':
            case 'murabahah':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/></svg>';
            case 'chart':
            case 'mudharabah':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>';
            case 'handshake':
            case 'musyarakah':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>';
            case 'building':
            case 'ijarah':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>';
            case 'plane':
            case 'multijasa':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>';
            case 'heart':
            case 'qardh':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>';
            case 'shield':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>';
            case 'briefcase':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/></svg>';
            case 'truck':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25V3.75A1.125 1.125 0 0013.125 2.625H3.375A1.125 1.125 0 002.25 3.75v10.5M14.25 7.5H18M9.75 14.25h4.5"/></svg>';
            case 'hospital':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
            case 'laptop':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0H3"/></svg>';
            case 'document':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>';
            case 'agriculture':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21V3m0 0a9 9 0 019 9m-9-9a9 9 0 00-9 9m9-9l3 3m-3-3l-3 3"/></svg>';
            case 'coins':
            default:
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
        }
    }
}

$color_themes = [
    'orange'  => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-orange-500 dark:hover:border-orange-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-orange-500/25',
        'badge_bg'    => 'bg-orange-100 dark:bg-orange-950 text-orange-800 dark:text-orange-300 border-orange-200 dark:border-orange-800',
        'icon_bg'     => 'bg-orange-50 dark:bg-orange-900/50 text-orange-600 dark:text-orange-300',
        'accent_dot'  => 'bg-orange-500',
        'pill_hover'  => 'hover:border-orange-500 hover:text-orange-600 dark:hover:text-orange-400',
        'title_hover' => 'group-hover:text-orange-600 dark:group-hover:text-orange-400',
    ],
    'indigo'  => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-indigo-500 dark:hover:border-indigo-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-indigo-500/25',
        'badge_bg'    => 'bg-indigo-100 dark:bg-indigo-950 text-indigo-800 dark:text-indigo-300 border-indigo-200 dark:border-indigo-800',
        'icon_bg'     => 'bg-indigo-50 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-300',
        'accent_dot'  => 'bg-indigo-500',
        'pill_hover'  => 'hover:border-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400',
        'title_hover' => 'group-hover:text-indigo-600 dark:group-hover:text-indigo-400',
    ],
    'teal'    => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-teal-500 dark:hover:border-teal-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-teal-500/25',
        'badge_bg'    => 'bg-teal-100 dark:bg-teal-950 text-teal-800 dark:text-teal-300 border-teal-200 dark:border-teal-800',
        'icon_bg'     => 'bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-300',
        'accent_dot'  => 'bg-teal-500',
        'pill_hover'  => 'hover:border-teal-500 hover:text-teal-600 dark:hover:text-teal-400',
        'title_hover' => 'group-hover:text-teal-600 dark:group-hover:text-teal-400',
    ],
    'emerald' => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-emerald-500 dark:hover:border-emerald-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-emerald-500/25',
        'badge_bg'    => 'bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800',
        'icon_bg'     => 'bg-emerald-50 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-300',
        'accent_dot'  => 'bg-emerald-500',
        'pill_hover'  => 'hover:border-emerald-500 hover:text-emerald-600 dark:hover:text-emerald-400',
        'title_hover' => 'group-hover:text-emerald-600 dark:group-hover:text-emerald-400',
    ],
    'blue'    => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-blue-500 dark:hover:border-blue-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-blue-500/25',
        'badge_bg'    => 'bg-blue-100 dark:bg-blue-950 text-blue-800 dark:text-blue-300 border-blue-200 dark:border-blue-800',
        'icon_bg'     => 'bg-blue-50 dark:bg-blue-900/50 text-blue-600 dark:text-blue-300',
        'accent_dot'  => 'bg-blue-500',
        'pill_hover'  => 'hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400',
        'title_hover' => 'group-hover:text-blue-600 dark:group-hover:text-blue-400',
    ],
    'cyan'    => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-cyan-500 dark:hover:border-cyan-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-cyan-500/25',
        'badge_bg'    => 'bg-cyan-100 dark:bg-cyan-950 text-cyan-800 dark:text-cyan-300 border-cyan-200 dark:border-cyan-800',
        'icon_bg'     => 'bg-cyan-50 dark:bg-cyan-900/50 text-cyan-600 dark:text-cyan-300',
        'accent_dot'  => 'bg-cyan-500',
        'pill_hover'  => 'hover:border-cyan-500 hover:text-cyan-600 dark:hover:text-cyan-400',
        'title_hover' => 'group-hover:text-cyan-600 dark:group-hover:text-cyan-400',
    ],
    'purple'  => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-purple-500 dark:hover:border-purple-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-purple-500/25',
        'badge_bg'    => 'bg-purple-100 dark:bg-purple-950 text-purple-800 dark:text-purple-300 border-purple-200 dark:border-purple-800',
        'icon_bg'     => 'bg-purple-50 dark:bg-purple-900/50 text-purple-600 dark:text-purple-300',
        'accent_dot'  => 'bg-purple-500',
        'pill_hover'  => 'hover:border-purple-500 hover:text-purple-600 dark:hover:text-purple-400',
        'title_hover' => 'group-hover:text-purple-600 dark:group-hover:text-purple-400',
    ],
    'amber'   => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-amber-500 dark:hover:border-amber-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-amber-500/25',
        'badge_bg'    => 'bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 border-amber-200 dark:border-amber-800',
        'icon_bg'     => 'bg-amber-50 dark:bg-amber-900/50 text-amber-600 dark:text-amber-300',
        'accent_dot'  => 'bg-amber-500',
        'pill_hover'  => 'hover:border-amber-500 hover:text-amber-600 dark:hover:text-amber-400',
        'title_hover' => 'group-hover:text-amber-600 dark:group-hover:text-amber-400',
    ],
    'rose'    => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-rose-500 dark:hover:border-rose-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-rose-500/25',
        'badge_bg'    => 'bg-rose-100 dark:bg-rose-950 text-rose-800 dark:text-rose-300 border-rose-200 dark:border-rose-800',
        'icon_bg'     => 'bg-rose-50 dark:bg-rose-900/50 text-rose-600 dark:text-rose-300',
        'accent_dot'  => 'bg-rose-500',
        'pill_hover'  => 'hover:border-rose-500 hover:text-rose-600 dark:hover:text-rose-400',
        'title_hover' => 'group-hover:text-rose-600 dark:group-hover:text-rose-400',
    ],
    'sky'     => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-sky-500 dark:hover:border-sky-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-sky-500/25',
        'badge_bg'    => 'bg-sky-100 dark:bg-sky-950 text-sky-800 dark:text-sky-300 border-sky-200 dark:border-sky-800',
        'icon_bg'     => 'bg-sky-50 dark:bg-sky-900/50 text-sky-600 dark:text-sky-300',
        'accent_dot'  => 'bg-sky-500',
        'pill_hover'  => 'hover:border-sky-500 hover:text-sky-600 dark:hover:text-sky-400',
        'title_hover' => 'group-hover:text-sky-600 dark:group-hover:text-sky-400',
    ],
    'lime'    => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-lime-500 dark:hover:border-lime-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-lime-500/25',
        'badge_bg'    => 'bg-lime-100 dark:bg-lime-950 text-lime-800 dark:text-lime-300 border-lime-200 dark:border-lime-800',
        'icon_bg'     => 'bg-lime-50 dark:bg-lime-900/50 text-lime-600 dark:text-lime-300',
        'accent_dot'  => 'bg-lime-500',
        'pill_hover'  => 'hover:border-lime-500 hover:text-lime-600 dark:hover:text-lime-400',
        'title_hover' => 'group-hover:text-lime-600 dark:group-hover:text-lime-400',
    ],
    'violet'  => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-violet-500 dark:hover:border-violet-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-violet-500/25',
        'badge_bg'    => 'bg-violet-100 dark:bg-violet-950 text-violet-800 dark:text-violet-300 border-violet-200 dark:border-violet-800',
        'icon_bg'     => 'bg-violet-50 dark:bg-violet-900/50 text-violet-600 dark:text-violet-300',
        'accent_dot'  => 'bg-violet-500',
        'pill_hover'  => 'hover:border-violet-500 hover:text-violet-600 dark:hover:text-violet-400',
        'title_hover' => 'group-hover:text-violet-600 dark:group-hover:text-violet-400',
    ],
    'fuchsia' => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-fuchsia-500 dark:hover:border-fuchsia-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-fuchsia-500/25',
        'badge_bg'    => 'bg-fuchsia-100 dark:bg-fuchsia-950 text-fuchsia-800 dark:text-fuchsia-300 border-fuchsia-200 dark:border-fuchsia-800',
        'icon_bg'     => 'bg-fuchsia-50 dark:bg-fuchsia-900/50 text-fuchsia-600 dark:text-fuchsia-300',
        'accent_dot'  => 'bg-fuchsia-500',
        'pill_hover'  => 'hover:border-fuchsia-500 hover:text-fuchsia-600 dark:hover:text-fuchsia-400',
        'title_hover' => 'group-hover:text-fuchsia-600 dark:group-hover:text-fuchsia-400',
    ],
    'slate'   => [
        'border'      => 'border-slate-200/90 dark:border-slate-800/80',
        'hover'       => 'hover:border-slate-500 dark:hover:border-slate-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-slate-500/25',
        'badge_bg'    => 'bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-slate-200 border-slate-300 dark:border-slate-700',
        'icon_bg'     => 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300',
        'accent_dot'  => 'bg-slate-500',
        'pill_hover'  => 'hover:border-slate-500 hover:text-slate-700 dark:hover:text-slate-300',
        'title_hover' => 'group-hover:text-slate-800 dark:group-hover:text-slate-200',
    ],
];
?>

<!-- ========================================
     HEADER BANNER & BREADCRUMBS
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
            <span class="text-teal-600 dark:text-teal-400 font-semibold">Pembiayaan Syariah</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-8">
            <div class="lg:col-span-8" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                    <?php echo esc_html( $page_badge ); ?>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                    <?php echo esc_html( $page_title ); ?>
                </h1>
                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                    <?php echo esc_html( $page_sub ); ?>
                </p>

                <!-- Quote Box Resmi -->
                <?php if ( ! empty( $page_quote ) ) : ?>
                <div class="p-4 sm:p-5 rounded-2xl bg-white/80 dark:bg-slate-800/80 border-l-4 border-teal-600 border border-slate-200/80 dark:border-slate-700 shadow-sm text-xs sm:text-sm text-slate-700 dark:text-slate-300 italic leading-relaxed">
                    <?php echo esc_html( $page_quote ); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Kartu Pengawasan OJK & DPS (Side Trust Card) -->
            <div class="lg:col-span-4" data-aos="fade-left">
                <div class="spotlight-card relative overflow-hidden rounded-3xl p-6 sm:p-7 bg-white/95 dark:bg-slate-900/90 border border-teal-200/80 dark:border-teal-900/60 shadow-xl hover:shadow-2xl hover:-translate-y-1.5 hover:border-teal-500 dark:hover:border-teal-400 transition-all duration-500 text-center space-y-4 group cursor-default before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-teal-500 via-cyan-400 to-teal-600">
                    <!-- Interactive Slide Watermark Emblem -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.045] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.08] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
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
                            <?php echo esc_html( $trust_tag ); ?>
                        </div>
                        <h4 class="text-lg font-black text-slate-900 dark:text-white"><?php echo esc_html( $trust_title ); ?></h4>
                    </div>

                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed relative z-10">
                        <?php echo esc_html( $trust_desc ); ?>
                    </p>

                    <div class="pt-2 relative z-10">
                        <a href="#kalkulator" class="inline-flex items-center gap-1.5 text-xs font-extrabold text-teal-600 hover:text-teal-700 dark:text-teal-300 dark:hover:text-teal-200 transition-colors">
                            <span><?php echo esc_html( $trust_btn ); ?></span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Anchor Navigation Bar -->
        <div class="pt-4 border-t border-slate-200/80 dark:border-slate-800/80">
            <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none text-xs font-semibold">
                <span class="text-slate-600 dark:text-slate-300 font-bold uppercase tracking-wider flex items-center gap-1 mr-2 flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Pilihan Produk:
                </span>
                <?php foreach ( $pembiayaan_list as $nav_prod ) : ?>
                    <a href="#<?php echo esc_attr( $nav_prod['slug'] ); ?>" class="px-3 py-1.5 rounded-lg bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700 hover:border-teal-500 hover:text-teal-600 dark:hover:text-teal-400 transition-colors flex-shrink-0 shadow-2xs">
                        <?php echo esc_html( $nav_prod['nama'] ); ?>
                    </a>
                <?php endforeach; ?>
                <a href="#komparasi" class="px-3 py-1.5 rounded-lg bg-teal-50 dark:bg-teal-950/50 text-teal-800 dark:text-teal-300 border border-teal-200 dark:border-teal-800 font-bold flex-shrink-0 hover:bg-teal-100 transition-colors">
                    📊 Matriks Komparasi
                </a>
                <a href="#kalkulator" class="px-3 py-1.5 rounded-lg bg-teal-600 text-white font-bold flex-shrink-0 hover:bg-teal-700 transition-colors">
                    🧮 Simulasi Angsuran
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 1: SHOWCASE PRODUK PEMBIAYAAN
     (Harmonized Executive Tiles dengan Anchor Support untuk Mega-Menu)
     ======================================== -->
<section id="akad-syariah" class="py-14 lg:py-20 bg-slate-50/50 dark:bg-dark-surface/50 relative">
    <!-- Anchor tambahan untuk mega-menu '#akad-lainnya' -->
    <div id="akad-lainnya" class="absolute -top-24 pointer-events-none"></div>

    <div class="container-wide">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="text-xs font-black uppercase tracking-wider text-teal-600 dark:text-teal-400 block mb-2">
                Katalog Pembiayaan Syariah
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Pilihan Akad Sesuai Karakteristik Kebutuhan Anda
            </h2>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-2">
                Setiap pembiayaan didesain berlandaskan prinsip fikih muamalah yang adil, menenangkan, dan memberikan kepastian usaha.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
            <?php 
            foreach ( $pembiayaan_list as $p_idx => $prod ) : 
                $slug       = $prod['slug'] ?? 'pembiayaan-' . ( $p_idx + 1 );
                $color      = $prod['color'] ?? 'teal';
                $icon_key   = $prod['icon'] ?? 'store';
                $c_theme    = $color_themes[ $color ] ?? $color_themes['teal'];
                $keung_arr  = wakalumi_lines_to_list( $prod['keunggulan'] ?? '' );
                $syarat_arr = wakalumi_lines_to_list( $prod['syarat'] ?? '' );
                $wa_msg     = ! empty( $prod['wa_text'] ) ? $prod['wa_text'] : ( 'Halo BPRS Wakalumi, saya tertarik mengajukan ' . $prod['nama'] . '. Mohon informasi syarat dan ketentuannya.' );
            ?>
                <!-- Card Item Anchor Target -->
                <div 
                    id="<?php echo esc_attr( $slug ); ?>" 
                    class="spotlight-card rounded-3xl bg-white/95 dark:bg-slate-900 border <?php echo esc_attr( $c_theme['border'] ); ?> <?php echo esc_attr( $c_theme['hover'] ); ?> shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 relative overflow-hidden flex flex-col justify-between group scroll-mt-28" 
                    data-aos="fade-up" 
                    data-aos-delay="<?php echo ( $p_idx % 2 === 0 ? '0' : '100' ); ?>"
                >
                    <!-- Bottom-Right Watermark wm-wkl.png (wm wkl 1.png) -->
                    <div class="absolute -right-6 -bottom-6 w-48 h-48 sm:w-56 sm:h-56 opacity-[0.035] dark:opacity-[0.05] pointer-events-none transition-all duration-700 ease-out group-hover:scale-115 group-hover:opacity-[0.07] dark:group-hover:opacity-[0.09] select-none overflow-hidden z-0">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/wm-wkl.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100" loading="lazy">
                    </div>

                    <!-- Top Graphic Slot: Flush Edge-to-Edge ("Ngepas" tanpa bezel) -->
                    <?php $p_img = ! empty( $prod['image'] ) ? $prod['image'] : ''; ?>
                    <?php if ( ! empty( $p_img ) ) : ?>
                        <div class="relative w-full aspect-[16/10] overflow-hidden bg-slate-100 dark:bg-slate-800 shrink-0 group/img">
                            <img src="<?php echo esc_url( $p_img ); ?>" alt="<?php echo esc_attr( $prod['nama'] ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-40 group-hover:opacity-60 transition-opacity duration-300"></div>
                            <div class="absolute top-3.5 right-3.5 flex flex-col items-end gap-1.5 z-10">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border backdrop-blur-md bg-white/90 dark:bg-slate-900/90 shadow-sm <?php echo esc_attr( $c_theme['badge_bg'] ); ?>">
                                    <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $c_theme['accent_dot'] ); ?>"></span>
                                    <?php echo esc_html( $prod['badge'] ?? 'Pembiayaan' ); ?>
                                </span>
                                <?php if ( ! empty( $prod['akad'] ) ) : ?>
                                    <span class="text-2xs font-bold uppercase tracking-wider text-white drop-shadow-md">
                                        Akad: <?php echo esc_html( $prod['akad'] ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Card Body Container with internal padding -->
                    <div class="p-7 sm:p-9 flex flex-col justify-between flex-1 relative z-10 <?php echo ! empty( $p_img ) ? 'pt-6 sm:pt-7' : ''; ?>">
                        <div>
                            <?php if ( empty( $p_img ) ) : ?>
                                <div class="flex items-start justify-between gap-4 mb-5">
                                    <div class="w-14 h-14 rounded-2xl <?php echo esc_attr( $c_theme['icon_bg'] ); ?> flex items-center justify-center flex-shrink-0 shadow-2xs group-hover:scale-110 transition-transform duration-300">
                                        <?php 
                                        if ( ! empty( $prod['custom_svg'] ) ) {
                                            echo $prod['custom_svg'];
                                        } else {
                                            echo wakalumi_render_pembiayaan_icon( $icon_key );
                                        }
                                        ?>
                                    </div>
                                    <div class="flex flex-col items-end gap-1.5 text-right">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border <?php echo esc_attr( $c_theme['badge_bg'] ); ?>">
                                            <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $c_theme['accent_dot'] ); ?>"></span>
                                            <?php echo esc_html( $prod['badge'] ?? 'Pembiayaan' ); ?>
                                        </span>
                                        <?php if ( ! empty( $prod['akad'] ) ) : ?>
                                            <span class="text-2xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                                Akad: <?php echo esc_html( $prod['akad'] ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <!-- Title & Tagline -->
                        <div class="mb-4">
                            <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white tracking-tight mb-1 <?php echo esc_attr( $c_theme['title_hover'] ); ?> transition-colors duration-300">
                                <?php echo esc_html( $prod['nama'] ); ?>
                            </h3>
                            <?php if ( ! empty( $prod['tagline'] ) ) : ?>
                                <p class="text-xs font-bold text-teal-600 dark:text-teal-400 uppercase tracking-wider">
                                    <?php echo esc_html( $prod['tagline'] ); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <!-- Description -->
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                            <?php echo esc_html( $prod['desc'] ?? '' ); ?>
                        </p>

                        <!-- Key Highlights / Limit Pill -->
                        <div class="grid grid-cols-2 gap-2 p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-200/80 dark:border-slate-700/80 mb-6 text-xs">
                            <div>
                                <span class="text-2xs font-semibold text-slate-600 dark:text-slate-300 block">Plafon Pembiayaan</span>
                                <strong class="text-slate-900 dark:text-white font-extrabold block truncate"><?php echo esc_html( $prod['limit_primary'] ?? 'Fleksibel' ); ?></strong>
                            </div>
                            <div>
                                <span class="text-2xs font-semibold text-slate-600 dark:text-slate-300 block">Jangka Waktu Tenor</span>
                                <strong class="text-teal-600 dark:text-teal-400 font-extrabold block truncate"><?php echo esc_html( $prod['limit_secondary'] ?? 's.d. 60 Bulan' ); ?></strong>
                            </div>
                        </div>

                        <!-- Keunggulan List -->
                        <?php if ( ! empty( $keung_arr ) ) : ?>
                            <div class="mb-5">
                                <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 dark:text-white mb-2.5 flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                    Keunggulan Produk:
                                </h4>
                                <ul class="space-y-1.5 text-xs text-slate-600 dark:text-slate-300">
                                    <?php foreach ( $keung_arr as $k_item ) : ?>
                                        <li class="flex items-start gap-2">
                                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            <span><?php echo esc_html( $k_item ); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Persyaratan List -->
                        <?php if ( ! empty( $syarat_arr ) ) : ?>
                            <div class="mb-6 pt-4 border-t border-slate-100 dark:border-slate-800">
                                <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 dark:text-white mb-2 flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Persyaratan Dokumen:
                                </h4>
                                <ul class="space-y-1 text-2xs sm:text-xs text-slate-500 dark:text-slate-400">
                                    <?php foreach ( $syarat_arr as $s_item ) : ?>
                                        <li class="flex items-start gap-1.5">
                                            <span class="text-slate-400">•</span>
                                            <span><?php echo esc_html( $s_item ); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Card Actions -->
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-3 flex-wrap mt-5">
                        <a 
                            href="https://wa.me/<?php echo esc_attr( $clean_wa ); ?>?text=<?php echo urlencode( $wa_msg ); ?>" 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="flex-1 min-w-[150px] py-3 px-4 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs inline-flex items-center justify-center gap-2 shadow-sm transition-all hover:shadow-teal-500/20"
                        >
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span>Ajukan via WhatsApp</span>
                        </a>
                        <a 
                            href="#kalkulator" 
                            class="wkl-jump-calc-btn py-3 px-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold text-xs inline-flex items-center gap-1 transition-colors"
                            data-prod="<?php echo esc_attr( $prod['nama'] ); ?>"
                        >
                            <span>Hitung Angsuran</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 2: TABEL KOMPARASI FITUR & AKAD
     ======================================== -->
<section id="komparasi" class="py-14 lg:py-20 bg-transparent relative scroll-mt-24">
    <div class="container-wide">
        <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
            <span class="text-xs font-black uppercase tracking-wider text-teal-600 dark:text-teal-400 block mb-2">
                Matriks Perbandingan
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Tabel Komparasi Fitur Pembiayaan
            </h2>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-2">
                Bandingkan skema akad, batas plafon, dan jangka waktu tenor untuk menemukan solusi pembiayaan yang paling tepat.
            </p>
        </div>

        <!-- Mobile Swipe Indicator -->
        <div class="flex items-center justify-end gap-1.5 text-2xs text-slate-500 dark:text-slate-400 mb-2 md:hidden">
            <svg class="w-3.5 h-3.5 text-teal-500 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            <span>Geser ke samping untuk detail lengkap</span>
        </div>

        <div class="relative overflow-hidden rounded-3xl border-2 border-slate-200/90 dark:border-slate-800 shadow-xl bg-white/95 dark:bg-slate-900 group/table" data-aos="fade-up">
            <!-- Table Subtle Watermark wm-wkl.png -->
            <div class="absolute -right-8 -bottom-8 w-60 h-60 opacity-[0.03] dark:opacity-[0.045] pointer-events-none select-none transition-transform duration-700 ease-out group-hover/table:scale-110">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/wm-wkl.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100" loading="lazy">
            </div>

            <div class="overflow-x-auto relative z-10">
                <table class="w-full text-left border-collapse text-xs sm:text-sm">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-900 via-slate-900 to-teal-950 text-white border-b-2 border-teal-500 text-xs sm:text-sm">
                            <th class="p-4 sm:p-5 font-black uppercase tracking-wider text-white">Produk Pembiayaan</th>
                            <th class="p-4 sm:p-5 font-black uppercase tracking-wider text-teal-300 text-center">Akad Syariah</th>
                            <th class="p-4 sm:p-5 font-black uppercase tracking-wider text-white">Kisaran Plafon</th>
                            <th class="p-4 sm:p-5 font-black uppercase tracking-wider text-white">Maksimal Tenor</th>
                            <th class="p-4 sm:p-5 font-black uppercase tracking-wider text-white">Sasaran Nasabah</th>
                            <th class="p-4 sm:p-5 font-black uppercase tracking-wider text-teal-300 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <?php foreach ( $pembiayaan_list as $comp_prod ) : 
                            $comp_color = $comp_prod['color'] ?? 'teal';
                            $comp_theme = $color_themes[ $comp_color ] ?? $color_themes['teal'];
                        ?>
                            <tr class="border-l-4 border-transparent hover:border-l-teal-500 hover:bg-teal-50/50 dark:hover:bg-teal-950/30 transition-all group/row">
                                <td class="p-4 sm:p-5 font-extrabold text-slate-900 dark:text-white">
                                    <a href="#<?php echo esc_attr( $comp_prod['slug'] ); ?>" class="hover:text-teal-600 dark:hover:text-teal-400 transition-colors inline-flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full <?php echo esc_attr( $comp_theme['accent_dot'] ); ?>"></span>
                                        <span><?php echo esc_html( $comp_prod['nama'] ); ?></span>
                                    </a>
                                </td>
                                <td class="p-4 sm:p-5 text-center whitespace-nowrap">
                                    <span class="inline-flex items-center justify-center px-3.5 py-1.5 rounded-full text-xs font-bold border <?php echo esc_attr( $comp_theme['badge_bg'] ); ?> shadow-2xs">
                                        <?php echo esc_html( $comp_prod['akad'] ?? 'Syariah' ); ?>
                                    </span>
                                </td>
                                <td class="p-4 sm:p-5 font-black text-teal-600 dark:text-teal-400">
                                    <?php echo esc_html( $comp_prod['limit_primary'] ?? '-' ); ?>
                                </td>
                                <td class="p-4 sm:p-5 text-slate-700 dark:text-slate-300 font-semibold">
                                    <?php echo esc_html( $comp_prod['limit_secondary'] ?? '-' ); ?>
                                </td>
                                <td class="p-4 sm:p-5 text-slate-700 dark:text-slate-200 text-xs font-semibold leading-relaxed">
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500/80 dark:bg-teal-400/80 flex-shrink-0"></span>
                                        <span><?php echo esc_html( $comp_prod['badge'] ?? 'Umum' ); ?></span>
                                    </div>
                                </td>
                                <td class="p-4 sm:p-5 text-center">
                                    <a href="#<?php echo esc_attr( $comp_prod['slug'] ); ?>" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-teal-50 hover:bg-teal-100 dark:bg-teal-950/60 dark:hover:bg-teal-900/60 text-teal-700 dark:text-teal-300 text-xs font-bold transition-all shadow-2xs">
                                        <span>Detail</span>
                                        <span>&rarr;</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 3: KALKULATOR SIMULASI ANGSURAN PEMBIAYAAN
     ======================================== -->
<section id="kalkulator" class="scroll-mt-24 py-14 lg:py-20 bg-slate-50/80 dark:bg-dark-surface-alt relative overflow-hidden">
    <div class="container-wide">
        <div class="max-w-4xl mx-auto p-6 sm:p-10 lg:p-12 rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-teal-950 text-white shadow-2xl relative overflow-hidden group" data-aos="fade-up">
            <!-- Dynamic Top Accent Gradient Line -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-teal-400 via-cyan-400 to-emerald-400"></div>

            <!-- Ambient Glow Effect -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-teal-500/15 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Subtle Sliding Watermark untitled4.png -->
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

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Form Controls (7 Cols) -->
                    <div class="lg:col-span-7 space-y-6">
                        
                        <!-- Pilihan Produk Pembiayaan -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                1. Pilihan Produk Pembiayaan
                            </label>
                            <select id="pem-calc-prod" class="w-full py-3 px-4 rounded-xl bg-slate-800/90 border border-slate-700 text-white font-semibold text-sm focus:outline-none focus:border-teal-400 transition-colors">
                                <?php foreach ( $pembiayaan_list as $prod_opt ) : ?>
                                    <option value="<?php echo esc_attr( $prod_opt['nama'] ); ?>">
                                        <?php echo esc_html( $prod_opt['nama'] ); ?> (<?php echo esc_html( $prod_opt['akad'] ?? 'Syariah' ); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Slider Plafon Pembiayaan -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-300">
                                    2. Nominal Plafon Pembiayaan
                                </label>
                                <div class="flex items-center gap-1 text-sm font-bold text-teal-300">
                                    <span>Rp</span>
                                    <input 
                                        type="text" 
                                        id="pem-calc-plafon-text" 
                                        value="<?php echo number_format( (float) $calc_default, 0, ',', '.' ); ?>" 
                                        class="w-32 text-right bg-transparent border-b border-dashed border-teal-400/80 focus:outline-none focus:border-teal-300 text-sm font-bold p-0 text-teal-300 tracking-wide"
                                    >
                                </div>
                            </div>
                            <input 
                                type="range" 
                                id="pem-calc-plafon-slider" 
                                min="<?php echo esc_attr( $calc_min ); ?>" 
                                max="<?php echo esc_attr( $calc_max ); ?>" 
                                step="1000000" 
                                value="<?php echo esc_attr( $calc_default ); ?>" 
                                class="w-full h-2.5 bg-slate-700/90 rounded-lg appearance-none cursor-pointer accent-teal-400"
                            >
                            <div class="flex items-center justify-between text-[11px] text-slate-400 mt-1.5">
                                <span>Min: Rp <?php echo number_format( (float) $calc_min / 1000000, 0 ); ?> Jt</span>
                                <span class="text-slate-400/80 italic">*Ketik manual s.d. Rp 2 Miliar</span>
                                <span>Maks: Rp <?php echo number_format( (float) $calc_max / 1000000, 0 ); ?> Jt</span>
                            </div>

                            <!-- Shortcut Presets -->
                            <?php if ( ! empty( $calc_presets ) ) : ?>
                                <div class="flex flex-wrap gap-2 mt-3">
                                    <?php foreach ( $calc_presets as $preset ) : ?>
                                        <button 
                                            type="button" 
                                            class="wkl-pem-preset-btn px-2.5 py-1.5 rounded-lg bg-slate-800 border border-slate-700 hover:border-teal-400 text-xs font-semibold text-slate-200 hover:text-white transition-all hover:shadow-sm"
                                            data-val="<?php echo esc_attr( $preset['nominal'] ); ?>"
                                            data-tenor="<?php echo esc_attr( $preset['tenor'] ); ?>"
                                            data-prod="<?php echo esc_attr( $preset['prod'] ?? '' ); ?>"
                                        >
                                            <?php echo esc_html( $preset['label'] ); ?>
                                        </button>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Slider Tenor Jangka Waktu -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-xs font-bold uppercase tracking-wider text-slate-300">
                                    3. Jangka Waktu (Tenor)
                                </label>
                                <span class="text-sm font-bold text-teal-300">
                                    <span id="pem-calc-tenor-val">24</span> Bulan (<span id="pem-calc-tenor-year">2.0</span> Tahun)
                                </span>
                            </div>
                            <input 
                                type="range" 
                                id="pem-calc-tenor-slider" 
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

                    <!-- Calculation Results Card (5 Cols) -->
                    <div class="lg:col-span-5">
                        <div class="bg-slate-800/80 p-6 sm:p-7 rounded-2xl border border-teal-500/30 text-center relative shadow-inner overflow-hidden group/box">
                            <!-- Background Emblem -->
                            <div class="absolute -right-6 -bottom-6 w-40 h-40 opacity-[0.035] pointer-events-none select-none mix-blend-screen transition-transform duration-700 ease-out group-hover/box:scale-110">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 invert" loading="lazy">
                            </div>

                            <div class="relative z-10">
                                <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold block mb-1">
                                    Estimasi Angsuran Bulanan
                                </span>
                                <div class="text-3xl sm:text-4xl font-extrabold text-teal-400 tracking-tight mb-2">
                                    Rp <span id="pem-calc-total-angsuran">0</span>
                                </div>
                                <span class="text-[11px] text-slate-400 block mb-4 leading-relaxed">
                                    Estimasi per bulan dengan skema margin flat indikatif tanpa biaya siluman.
                                </span>

                                <div class="space-y-2 py-3.5 border-y border-slate-700/70 text-xs text-left">
                                    <div class="flex justify-between items-center text-slate-300">
                                        <span class="font-normal text-slate-400">Pokok Angsuran:</span>
                                        <strong class="text-white font-semibold">Rp <span id="pem-calc-pokok">0</span> / bln</strong>
                                    </div>
                                    <div class="flex justify-between items-center text-slate-300">
                                        <span class="font-normal text-slate-400">Estimasi Margin (<span id="pem-calc-rate-display"><?php echo esc_html( $calc_rate ); ?></span>% p.a.):</span>
                                        <strong class="text-teal-300 font-semibold">Rp <span id="pem-calc-margin">0</span> / bln</strong>
                                    </div>
                                    <div class="flex justify-between items-center text-slate-300">
                                        <span class="font-normal text-slate-400">Total Pengembalian:</span>
                                        <strong class="text-white font-semibold">Rp <span id="pem-calc-grand-total">0</span></strong>
                                    </div>
                                </div>

                                <p class="text-[11px] text-slate-400/80 italic my-4 leading-relaxed text-center">
                                    <?php echo esc_html( $calc_note ); ?>
                                </p>

                                <a 
                                    id="pem-calc-wa-btn" 
                                    href="https://wa.me/<?php echo esc_attr( $clean_wa ); ?>" 
                                    target="_blank" 
                                    rel="noopener noreferrer" 
                                    class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-400 hover:from-teal-400 hover:to-cyan-300 text-slate-950 font-black text-xs inline-flex items-center justify-center gap-2 shadow-lg transition-transform hover:scale-[1.02]"
                                >
                                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    <span><?php echo esc_html( $calc_btn_text ); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 4: ALUR & PROSEDUR 4 LANGKAH
     ======================================== -->
<section id="alur" class="py-14 lg:py-20 bg-transparent relative scroll-mt-24">
    <div class="container-wide">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="text-xs font-black uppercase tracking-wider text-teal-600 dark:text-teal-400 block mb-2">
                <?php echo esc_html( $alur_kicker ); ?>
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                <?php echo esc_html( $alur_title ); ?>
            </h2>
            <p class="text-sm text-slate-600 dark:text-slate-300 mt-2">
                <?php echo esc_html( $alur_sub ); ?>
            </p>
        </div>

        <?php 
        $clean_step_1 = preg_replace( '/^\d+\.\s*/', '', $step_1_title );
        $clean_step_2 = preg_replace( '/^\d+\.\s*/', '', $step_2_title );
        $clean_step_3 = preg_replace( '/^\d+\.\s*/', '', $step_3_title );
        $clean_step_4 = preg_replace( '/^\d+\.\s*/', '', $step_4_title );
        ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Step 1 (Dual-Tone Teal) -->
            <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-md relative group hover:-translate-y-2 hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-teal-500 before:to-cyan-400 before:scale-x-0 group-hover:before:scale-x-100 before:transition-transform before:duration-500 z-10" data-aos="fade-up" data-aos-delay="0">
                <!-- Top Zone (Header Tone) -->
                <div class="p-5 sm:p-6 bg-teal-50/60 dark:bg-teal-950/30 border-b border-teal-100/80 dark:border-teal-900/40 transition-colors duration-300">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-10 h-10 rounded-xl bg-teal-600 text-white font-black text-sm flex items-center justify-center shadow-md shadow-teal-500/25 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                            01
                        </span>
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-teal-700 dark:text-teal-300 px-2.5 py-0.5 rounded-full bg-teal-100/80 dark:bg-teal-900/60 border border-teal-200 dark:border-teal-800">
                            Tahap 1
                        </span>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                        <?php echo esc_html( $clean_step_1 ); ?>
                    </h3>
                </div>
                <!-- Bottom Zone (Body Tone) -->
                <div class="p-5 sm:p-6 bg-white dark:bg-slate-900/95 flex-1 flex flex-col justify-between">
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        <?php echo esc_html( $step_1_desc ); ?>
                    </p>
                </div>
            </div>

            <!-- Step 2 (Dual-Tone Indigo) -->
            <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-md relative group hover:-translate-y-2 hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-indigo-500 before:to-purple-400 before:scale-x-0 group-hover:before:scale-x-100 before:transition-transform before:duration-500 z-10" data-aos="fade-up" data-aos-delay="100">
                <!-- Top Zone (Header Tone) -->
                <div class="p-5 sm:p-6 bg-indigo-50/60 dark:bg-indigo-950/30 border-b border-indigo-100/80 dark:border-indigo-900/40 transition-colors duration-300">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-10 h-10 rounded-xl bg-indigo-600 text-white font-black text-sm flex items-center justify-center shadow-md shadow-indigo-500/25 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                            02
                        </span>
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-indigo-700 dark:text-indigo-300 px-2.5 py-0.5 rounded-full bg-indigo-100/80 dark:bg-indigo-900/60 border border-indigo-200 dark:border-indigo-800">
                            Tahap 2
                        </span>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                        <?php echo esc_html( $clean_step_2 ); ?>
                    </h3>
                </div>
                <!-- Bottom Zone (Body Tone) -->
                <div class="p-5 sm:p-6 bg-white dark:bg-slate-900/95 flex-1 flex flex-col justify-between">
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        <?php echo esc_html( $step_2_desc ); ?>
                    </p>
                </div>
            </div>

            <!-- Step 3 (Dual-Tone Emerald) -->
            <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-md relative group hover:-translate-y-2 hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-emerald-500 before:to-teal-400 before:scale-x-0 group-hover:before:scale-x-100 before:transition-transform before:duration-500 z-10" data-aos="fade-up" data-aos-delay="200">
                <!-- Top Zone (Header Tone) -->
                <div class="p-5 sm:p-6 bg-emerald-50/60 dark:bg-emerald-950/30 border-b border-emerald-100/80 dark:border-emerald-900/40 transition-colors duration-300">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-10 h-10 rounded-xl bg-emerald-600 text-white font-black text-sm flex items-center justify-center shadow-md shadow-emerald-500/25 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                            03
                        </span>
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-emerald-700 dark:text-emerald-300 px-2.5 py-0.5 rounded-full bg-emerald-100/80 dark:bg-emerald-900/60 border border-emerald-200 dark:border-emerald-800">
                            Tahap 3
                        </span>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                        <?php echo esc_html( $clean_step_3 ); ?>
                    </h3>
                </div>
                <!-- Bottom Zone (Body Tone) -->
                <div class="p-5 sm:p-6 bg-white dark:bg-slate-900/95 flex-1 flex flex-col justify-between">
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        <?php echo esc_html( $step_3_desc ); ?>
                    </p>
                </div>
            </div>

            <!-- Step 4 (Dual-Tone Amber) -->
            <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-md relative group hover:-translate-y-2 hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-amber-500 before:to-orange-400 before:scale-x-0 group-hover:before:scale-x-100 before:transition-transform before:duration-500 z-10" data-aos="fade-up" data-aos-delay="300">
                <!-- Top Zone (Header Tone) -->
                <div class="p-5 sm:p-6 bg-amber-50/60 dark:bg-amber-950/30 border-b border-amber-100/80 dark:border-amber-900/40 transition-colors duration-300">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-10 h-10 rounded-xl bg-amber-600 text-white font-black text-sm flex items-center justify-center shadow-md shadow-amber-500/25 group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                            04
                        </span>
                        <span class="text-[11px] font-extrabold uppercase tracking-wider text-amber-700 dark:text-amber-300 px-2.5 py-0.5 rounded-full bg-amber-100/80 dark:bg-amber-900/60 border border-amber-200 dark:border-amber-800">
                            Tahap 4
                        </span>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                        <?php echo esc_html( $clean_step_4 ); ?>
                    </h3>
                </div>
                <!-- Bottom Zone (Body Tone) -->
                <div class="p-5 sm:p-6 bg-white dark:bg-slate-900/95 flex-1 flex flex-col justify-between">
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        <?php echo esc_html( $step_4_desc ); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 5: FAQ & INFORMASI KONSULTASI PEMBIAYAAN
     ======================================== -->
<section id="faq" class="py-14 lg:py-20 bg-white dark:bg-dark-surface-alt border-t border-slate-200/60 dark:border-slate-800/60 relative overflow-hidden scroll-mt-24">
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

            <!-- Card Unduh Brosur & Hotline (5 Kolom) -->
            <div class="lg:col-span-5 space-y-6" data-aos="fade-left">
                <!-- Box Brosur -->
                <div class="p-6 sm:p-7 rounded-3xl bg-teal-50/80 dark:bg-slate-900 border border-teal-200/80 dark:border-teal-800/80 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 ease-out text-slate-900 dark:text-white relative overflow-hidden group before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-teal-500 before:to-cyan-400 before:scale-x-75 group-hover:before:scale-x-100 before:transition-transform before:duration-700 before:ease-out">
                    <!-- Sliding Watermark untitled4.png -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.045] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.08] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100" loading="lazy">
                    </div>

                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-teal-100 dark:bg-teal-900/60 text-teal-700 dark:text-teal-300 flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        </div>
                        <h4 class="text-lg font-black text-slate-900 dark:text-white mb-2">
                            Brosur Lengkap Pembiayaan
                        </h4>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                            Unduh panduan resmi, simulasi plafon terperinci, dan daftar dokumen persyaratan seluruh produk pembiayaan syariah kami dalam format PDF praktis.
                        </p>
                        <?php if ( ! empty( $brosur_url ) ) : ?>
                            <a href="<?php echo esc_url( $brosur_url ); ?>" download target="_blank" rel="noopener noreferrer" class="w-full py-3 px-4 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs inline-flex items-center justify-center gap-2 shadow-md transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                <span>Unduh Brosur Pembiayaan (PDF)</span>
                            </a>
                        <?php else : ?>
                            <a href="https://wa.me/<?php echo esc_attr( $clean_wa ); ?>?text=<?php echo urlencode( 'Halo BPRS Wakalumi, saya ingin meminta brosur lengkap produk pembiayaan syariah.' ); ?>" target="_blank" rel="noopener noreferrer" class="w-full py-3 px-4 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs inline-flex items-center justify-center gap-2 shadow-md transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                <span>Minta Brosur via WhatsApp</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Box Konsultasi Relationship Manager (Dinamis dari Admin) -->
                <?php if ( $rm_show === '1' || $rm_show === 1 ) : 
                    $target_rm_wa = ! empty( $rm_wa_clean ) ? $rm_wa_clean : $clean_wa;
                ?>
                <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 ease-out text-slate-900 dark:text-white relative overflow-hidden group before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-indigo-500 before:to-teal-500 before:scale-x-75 group-hover:before:scale-x-100 before:transition-transform before:duration-700 before:ease-out">
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/70 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        </div>
                        <h4 class="text-lg font-black text-slate-900 dark:text-white mb-2">
                            <?php echo esc_html( $rm_title ); ?>
                        </h4>
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                            <?php echo esc_html( $rm_desc ); ?>
                        </p>
                        <a href="https://wa.me/<?php echo esc_attr( $target_rm_wa ); ?>?text=<?php echo urlencode( $rm_wa_msg ); ?>" target="_blank" rel="noopener noreferrer" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-teal-500 dark:hover:bg-teal-400 text-white dark:text-slate-950 font-black text-xs inline-flex items-center justify-center gap-2 shadow-md transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span><?php echo esc_html( $rm_btn_text ); ?></span>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 6: BANNER CTA KONSULTASI PEMBIAYAAN
     ======================================== -->
<section class="py-14 lg:py-20 bg-transparent relative">
    <div class="container-wide">
        <div class="max-w-4xl mx-auto p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-slate-900 via-slate-900 to-teal-950 text-white text-center relative overflow-hidden shadow-2xl group" data-aos="fade-up">
            <!-- Background Watermark Emblem (wm-wkl.png / wm wkl 1.png) -->
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:scale-110 group-hover:opacity-[0.06] select-none">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/wm-wkl.png' ); ?>" alt="" class="w-full h-full object-contain" loading="lazy">
            </div>

            <div class="relative z-10 max-w-2xl mx-auto">
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold uppercase tracking-wider text-teal-300 bg-teal-950/80 px-3.5 py-1.5 rounded-full border border-teal-800 mb-3">
                    <svg class="w-3.5 h-3.5 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
                    <?php echo esc_html( $cta_kicker ); ?>
                </span>
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black mb-4 tracking-tight text-white">
                    <?php echo esc_html( $cta_title ); ?>
                </h3>
                <p class="text-sm sm:text-base text-slate-300 leading-relaxed mb-8">
                    <?php echo esc_html( $cta_desc ); ?>
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a 
                        href="https://wa.me/<?php echo esc_attr( $clean_wa ); ?>?text=<?php echo urlencode( $cta_wa_msg ); ?>" 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        class="relative overflow-hidden group/btn py-3.5 px-6 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-400 hover:from-teal-400 hover:to-cyan-300 text-slate-950 font-black text-sm inline-flex items-center gap-2 shadow-lg transition-transform hover:scale-105"
                    >
                        <span class="absolute inset-0 w-1/2 h-full bg-white/30 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-[300%] transition-transform duration-1000 ease-out pointer-events-none"></span>
                        <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span><?php echo esc_html( $cta_btn_text ); ?></span>
                    </a>
                    <?php if ( ! empty( $brosur_url ) ) : ?>
                        <a 
                            href="<?php echo esc_url( $brosur_url ); ?>" 
                            download 
                            target="_blank" 
                            rel="noopener noreferrer" 
                            class="py-3.5 px-6 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-sm border border-slate-700 inline-flex items-center gap-2 transition-colors"
                        >
                            <svg class="w-4 h-4 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                            <span>Unduh Brosur Pembiayaan (PDF)</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     INTERACTIVE JAVASCRIPT LOGIC
     ======================================== -->
<script>
(function() {
    function initFinancing() {
        // 1. Kalkulator Pembiayaan
        var plafonSlider = document.getElementById('pem-calc-plafon-slider');
        var plafonInput  = document.getElementById('pem-calc-plafon-text');
        var tenorSlider  = document.getElementById('pem-calc-tenor-slider');
        var tenorVal     = document.getElementById('pem-calc-tenor-val');
        var tenorYear    = document.getElementById('pem-calc-tenor-year');
        var prodSelect   = document.getElementById('pem-calc-prod');
        var totalEl      = document.getElementById('pem-calc-total-angsuran');
        var pokokEl      = document.getElementById('pem-calc-pokok');
        var marginEl     = document.getElementById('pem-calc-margin');
        var grandEl      = document.getElementById('pem-calc-grand-total');
        var waBtn        = document.getElementById('pem-calc-wa-btn');
        var rateDisplay  = document.getElementById('pem-calc-rate-display');

        var annualRate   = parseFloat("<?php echo esc_js( $calc_rate ); ?>") || 11.5;
        var cleanWa      = "<?php echo esc_js( $clean_wa ); ?>";

        function formatRupiah(num) {
            return Math.round(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function cleanNumber(str) {
            return parseInt(str.replace(/[^0-9]/g, ''), 10) || 0;
        }

        function calculate() {
            if (!plafonSlider || !tenorSlider) return;

            var plafon = cleanNumber(plafonInput.value) || parseInt(plafonSlider.value, 10);
            var tenor  = parseInt(tenorSlider.value, 10);
            if (tenor <= 0) tenor = 12;

            if (tenorVal) tenorVal.textContent = tenor;
            if (tenorYear) tenorYear.textContent = (tenor / 12).toFixed(1);

            // Pokok per bulan
            var pokokBulan = plafon / tenor;

            // Margin flat setara per tahun = (plafon * (rate / 100) * (tenor / 12)) / tenor = (plafon * (rate / 100)) / 12
            var marginBulan = (plafon * (annualRate / 100)) / 12;

            var totalAngsuran = pokokBulan + marginBulan;
            var grandTotal = totalAngsuran * tenor;

            if (pokokEl) pokokEl.textContent = formatRupiah(pokokBulan);
            if (marginEl) marginEl.textContent = formatRupiah(marginBulan);
            if (totalEl) totalEl.textContent = formatRupiah(totalAngsuran);
            if (grandEl) grandEl.textContent = formatRupiah(grandTotal);

            // Update WA Link
            if (waBtn) {
                var selectedProd = prodSelect ? prodSelect.value : 'Pembiayaan Syariah';
                var text = 'Halo BPRS Wakalumi, saya tertarik mengajukan ' + selectedProd +
                           ' dengan estimasi plafon Rp ' + formatRupiah(plafon) +
                           ' tenor ' + tenor + ' bulan (estimasi angsuran Rp ' + formatRupiah(totalAngsuran) + '/bulan).' +
                           ' Mohon informasi syarat dan proses pengajuannya.';
                waBtn.href = 'https://wa.me/' + cleanWa + '?text=' + encodeURIComponent(text);
            }
        }

        if (plafonSlider && plafonInput) {
            plafonSlider.addEventListener('input', function() {
                plafonInput.value = formatRupiah(parseInt(this.value, 10));
                calculate();
            });

            plafonInput.addEventListener('input', function() {
                var raw = cleanNumber(this.value);
                this.value = formatRupiah(raw);
                if (raw >= parseInt(plafonSlider.min, 10) && raw <= parseInt(plafonSlider.max, 10)) {
                    plafonSlider.value = raw;
                }
                calculate();
            });
        }

        if (tenorSlider) {
            tenorSlider.addEventListener('input', calculate);
        }

        if (prodSelect) {
            prodSelect.addEventListener('change', calculate);
        }

        // Preset Shortcut Buttons
        document.querySelectorAll('.wkl-pem-preset-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var pVal = parseInt(this.getAttribute('data-val'), 10);
                var pTen = parseInt(this.getAttribute('data-tenor'), 10);
                var pPrd = this.getAttribute('data-prod');

                if (pVal && plafonSlider && plafonInput) {
                    plafonInput.value = formatRupiah(pVal);
                    if (pVal >= parseInt(plafonSlider.min, 10) && pVal <= parseInt(plafonSlider.max, 10)) {
                        plafonSlider.value = pVal;
                    }
                }
                if (pTen && tenorSlider) {
                    tenorSlider.value = pTen;
                }
                if (pPrd && prodSelect) {
                    for (var i = 0; i < prodSelect.options.length; i++) {
                        if (prodSelect.options[i].value.indexOf(pPrd) !== -1 || pPrd.indexOf(prodSelect.options[i].value) !== -1) {
                            prodSelect.selectedIndex = i;
                            break;
                        }
                    }
                }
                calculate();
            });
        });

        // Jump Calc Button from Cards
        document.querySelectorAll('.wkl-jump-calc-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var pPrd = this.getAttribute('data-prod');
                if (pPrd && prodSelect) {
                    for (var i = 0; i < prodSelect.options.length; i++) {
                        if (prodSelect.options[i].value.indexOf(pPrd) !== -1 || pPrd.indexOf(prodSelect.options[i].value) !== -1) {
                            prodSelect.selectedIndex = i;
                            break;
                        }
                    }
                    calculate();
                }
            });
        });

        calculate();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFinancing);
    } else {
        initFinancing();
    }

    // Expose for Swup page transitions
    window.FinancingPage = { init: initFinancing };
})();
</script>

<?php
get_footer();

