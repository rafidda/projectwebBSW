<?php
/**
 * Template Name: Tentang Kami
 * Description: Halaman Profil Perusahaan BPRS Wakalumi (Visi, Misi, Sejarah, Budaya Kerja, Makna Logo)
 *
 * @package Wakalumi
 */

get_header();

// ── AMBIL DATA PENGATURAN HALAMAN DARI WP_OPTIONS ─────────────────
$page_badge     = get_option( 'options_about_page_badge', 'Profil Perusahaan' );
$page_title     = get_option( 'options_about_page_title', 'Mengenal Lebih Dekat BPRS Wakalumi' );
$page_subtitle  = get_option( 'options_about_page_subtitle', 'Membangun kualitas hidup berkah sesuai Syariah — Lembaga keuangan syariah yang fokus pada jasa keuangan dan pemberdayaan ekonomi umat serta UMKM.' );

// Hero Pills & Hero Card Kanan
$hero_pill_1    = get_option( 'options_about_page_hero_pill_1', 'Melayani Sejak 1990' );
$hero_pill_2    = get_option( 'options_about_page_hero_pill_2', 'Budaya Kerja SAPA & Prinsip Syariah' );
$hero_pill_3    = get_option( 'options_about_page_hero_pill_3', 'Berizin OJK & Dijamin LPS' );

$hero_card_show = get_option( 'options_about_page_hero_card_show', '1' );
$hero_card_logo = get_option( 'options_about_page_hero_card_logo', get_template_directory_uri() . '/assets/img/untitled3.png' );
if ( empty( $hero_card_logo ) ) {
    $hero_card_logo = get_template_directory_uri() . '/assets/img/untitled3.png';
}
$hero_card_badge = get_option( 'options_about_page_hero_card_badge', 'Identitas Korporasi Resmi' );
$hero_card_title = get_option( 'options_about_page_hero_card_title', 'Bank Syariah Wakalumi' );
$hero_card_desc  = get_option( 'options_about_page_hero_card_desc', 'Berkhidmat sejak tahun 1990 menghadirkan layanan perbankan syariah yang amanah, profesional, dan memberdayakan ekonomi umat.' );
$hero_card_tag1  = get_option( 'options_about_page_hero_card_tag1', 'Diawasi OJK' );
$hero_card_tag2  = get_option( 'options_about_page_hero_card_tag2', 'Dijamin LPS' );

$sec_badge      = get_option( 'options_about_page_sec_badge', 'Sekilas Perusahaan' );
$sec_title      = get_option( 'options_about_page_sec_title', 'Tumbuh Bersama Umat, Melayani Sepenuh Hati' );
$narrative_1    = get_option( 'options_about_page_narrative_1', 'PT. Bank Perekonomian Rakyat Syariah (BPRS) Wakalumi didirikan oleh Yayasan Wakalumi (Wakaf Karyawan dan Alumni Muslim Citibank) berdasarkan Akta Notaris Ny. Siti Pertiwi Henny Shidki, SH Nomor 59 tanggal 7 Oktober 1989 dan mendapatkan pengesahan Menteri Kehakiman RI tanggal 13 Januari 1990. BPRS Wakalumi memulai aktivitas operasi perbankan pada tanggal 1 Mei 1992, dan resmi dikonversi menjadi Bank Pembiayaan Rakyat Syariah pada tahun 1995 berlandaskan UU Nomor 7 Tahun 1992.' );
$narrative_2    = get_option( 'options_about_page_narrative_2', 'BPRS Wakalumi senantiasa berpegang teguh pada komitmen ISHLAH—terus melakukan perbaikan berkelanjutan demi kemaslahatan bersama. Kami menghimpun dana dari masyarakat dalam bentuk deposito berjangka dan tabungan syariah, memberikan pembiayaan bagi pengusaha kecil, mikro, maupun masyarakat umum, serta aktif memfasilitasi literasi ekonomi syariah dan pembinaan Bank Mini di sekolah-sekolah.' );
$about_img      = get_option( 'options_about_page_image', get_template_directory_uri() . '/assets/img/about-photo.jpg' );
$photo_label    = get_option( 'options_about_page_photo_label', 'Kantor Pusat' );
$photo_title    = get_option( 'options_about_page_photo_title', 'Bank Syariah Wakalumi Ciputat, Tangerang Selatan' );
$floating_title = get_option( 'options_about_page_floating_title', 'Amanah' );
$floating_desc  = get_option( 'options_about_page_floating_desc', 'Berpengalaman & Terpercaya' );
$sec_btn1_text  = get_option( 'options_about_page_sec_btn1_text', 'Lihat Legalitas Perusahaan' );
$sec_btn1_url   = get_option( 'options_about_page_sec_btn1_url', home_url( '/profil/legalitas' ) );
$sec_btn2_text  = get_option( 'options_about_page_sec_btn2_text', 'Susunan Pengurus' );
$sec_btn2_url   = get_option( 'options_about_page_sec_btn2_url', home_url( '/profil/susunan-pengurus' ) );

$stat_1_val     = get_option( 'options_about_page_stat_1_val', '35+' );
$stat_1_lbl     = get_option( 'options_about_page_stat_1_lbl', 'Tahun Pengalaman (1989)' );
$stat_2_val     = get_option( 'options_about_page_stat_2_val', '10.000+' );
$stat_2_lbl     = get_option( 'options_about_page_stat_2_lbl', 'Nasabah Setia' );
$stat_3_val     = get_option( 'options_about_page_stat_3_val', '100%' );
$stat_3_lbl     = get_option( 'options_about_page_stat_3_lbl', 'Prinsip Murni Syariah' );
$stat_4_val     = get_option( 'options_about_page_stat_4_val', 'Rp2 Miliar' );
$stat_4_lbl     = get_option( 'options_about_page_stat_4_lbl', 'Dijamin LPS per Nasabah' );

$vm_badge           = get_option( 'options_about_page_vm_badge', 'Arah & Tujuan Strategis' );
$vm_title           = get_option( 'options_about_page_vm_title', 'Visi & Misi BSW' );
$vm_subtitle        = get_option( 'options_about_page_vm_subtitle', 'Landasan cita-cita luhur dan aksi nyata kami dalam melayani serta menggerakkan roda perekonomian masyarakat secara syariah.' );
$missions_heading   = get_option( 'options_about_page_missions_heading', 'Butir-Butir Misi Strategis:' );

$vision_badge   = get_option( 'options_about_page_vision_badge', 'Visi Perusahaan' );
$vision_title   = get_option( 'options_about_page_vision_title', 'Menjadi BPR Syariah yang sehat, besar dan bermanfaat bagi umat' );
$vision_desc    = get_option( 'options_about_page_vision_desc', '“Menjadikan BPRS Wakalumi ibarat sebuah pohon yang memiliki akar dan batang yang kuat, daun yang lebat dan buah yang manis”' );

$missions       = get_option( 'options_about_page_missions', [] );
if ( empty( $missions ) ) {
    $missions = [
        'Memberdayakan ekonomi umat dengan fokus usaha mikro, kecil dan menengah.',
        'Memberikan layanan prima dan amanah bagi nasabah.',
        'Menjalankan fungsi inklusi dan literasi ekonomi syariah bagi masyarakat.',
        'Memberikan manfaat optimal bagi para stakeholder.',
        'Membangun sistem dan tata kerja yang unggul dengan sumber daya insani yang professional, kompeten, handal dan menjunjung tinggi ukhuwah islamiyah.',
    ];
}

$identity_badge = get_option( 'options_about_page_identity_badge', 'Jati Diri Lembaga' );
$identity_tag   = get_option( 'options_about_page_identity_tag', 'Fokus Syariah' );
$identity_title = get_option( 'options_about_page_identity_title', 'Lembaga Keuangan Syariah Umat' );
$identity_text  = get_option( 'options_about_page_identity', 'BPRS Wakalumi adalah Lembaga Keuangan Syariah yang memiliki fokus pada jasa keuangan dan pemberdayaan ekonomi umat dan masyarakat sesuai syariah.' );

$belief_badge   = get_option( 'options_about_page_belief_badge', 'Keyakinan Inti (Core Beliefs)' );
$belief_tag     = get_option( 'options_about_page_belief_tag', 'Nilai Abadi' );
$belief_title   = get_option( 'options_about_page_belief_title', 'Komitmen ISHLAH Berkelanjutan' );
$belief_text    = get_option( 'options_about_page_belief', 'BPRS Wakalumi berkomitmen untuk selalu melakukan ISHLAH, yakni kami terus melakukan perbaikan berkelanjutan.' );

$values_badge   = get_option( 'options_about_page_values_badge', 'Budaya Kerja #WAQF' );
$values_title   = get_option( 'options_about_page_values_title', 'Budaya Kerja Perusahaan: #WAQF (Wisdom, Accountability, Quality, Foresight)' );
$values_desc    = get_option( 'options_about_page_values_desc', 'Nilai-nilai budaya #WAQF yang menjadi komitmen moral, landasan tata kelola, dan etos kerja seluruh insan Bank Syariah Wakalumi dalam melayani umat secara profesional dan amanah.' );
$values_tag     = get_option( 'options_about_page_values_tag', 'Pilar Nilai #WAQF' );

$culture_img_show   = get_option( 'options_about_page_culture_img_show', '1' );
$culture_img_light  = get_option( 'options_about_page_culture_img_light', '' );
$culture_img_dark   = get_option( 'options_about_page_culture_img_dark', '' );
$culture_caption    = get_option( 'options_about_page_culture_caption', 'Visualisasi Lambang Budaya #WAQF' );
$culture_subcaption = get_option( 'options_about_page_culture_subcaption', 'Identitas visual resmi #WAQF (Wisdom, Accountability, Quality, Foresight) Bank Syariah Wakalumi' );

$values = get_option( 'options_about_page_values', [] );
// Otomatis sinkronkan bila data kosong atau masih mengacu pada budaya lama SAPA:
if ( empty( $values ) || ( isset( $values[0]['acronym'] ) && strtoupper( $values[0]['acronym'] ) === 'S' && isset( $values[0]['title'] ) && strtolower( $values[0]['title'] ) === 'skill' ) ) {
    $values = [
        [ 'acronym' => 'W', 'title' => 'Wisdom', 'desc' => 'Kebijaksanaan dan kematangan dalam setiap pertimbangan keputusan serta solusi finansial syariah yang maslahat.' ],
        [ 'acronym' => 'A', 'title' => 'Accountability', 'desc' => 'Menjunjung tinggi transparansi, amanah, dan integritas tata kelola perusahaan yang profesional (GCG).' ],
        [ 'acronym' => 'Q', 'title' => 'Quality', 'desc' => 'Menghadirkan keunggulan mutu layanan perbankan prima, presisi operasional, dan kepuasan nasabah.' ],
        [ 'acronym' => 'F', 'title' => 'Foresight', 'desc' => 'Pandangan visioner, inovatif, dan adaptif membaca masa depan demi pertumbuhan ekonomi umat yang berkelanjutan.' ],
    ];
}

// Normalisasi teks jika masih bernuansa SAPA dari penyimpanan opsi lama:
if ( stripos( $values_badge, 'SAPA' ) !== false ) {
    $values_badge = 'Budaya Kerja #WAQF';
}
if ( stripos( $values_title, 'SAPA' ) !== false ) {
    $values_title = 'Budaya Kerja Perusahaan: #WAQF (Wisdom, Accountability, Quality, Foresight)';
}
if ( stripos( $values_desc, 'SAPA' ) !== false ) {
    $values_desc = 'Nilai-nilai budaya #WAQF yang menjadi komitmen moral, landasan tata kelola, dan etos kerja seluruh insan Bank Syariah Wakalumi dalam melayani umat secara profesional dan amanah.';
}
if ( stripos( $values_tag, 'SAPA' ) !== false ) {
    $values_tag = 'Pilar Nilai #WAQF';
}
if ( stripos( $culture_caption, 'SAPA' ) !== false ) {
    $culture_caption = 'Visualisasi Lambang Budaya #WAQF';
}
if ( stripos( $culture_subcaption, 'SAPA' ) !== false ) {
    $culture_subcaption = 'Identitas visual resmi #WAQF (Wisdom, Accountability, Quality, Foresight) Bank Syariah Wakalumi';
}

// Hilangkan frasa "perwujudan nilai" jika masih tersimpan di database:
if ( stripos( $culture_subcaption, 'perwujudan nilai' ) !== false ) {
    $culture_subcaption = str_ireplace( 'perwujudan nilai ', '', $culture_subcaption );
    $culture_subcaption = str_ireplace( 'perwujudan nilai', '', $culture_subcaption );
    $culture_subcaption = preg_replace( '/\s+/', ' ', trim( $culture_subcaption ) );
}

if ( empty( $culture_img_light ) && empty( $culture_img_dark ) ) {
    $culture_img_light = get_template_directory_uri() . '/assets/img/logo-waqf-light.png';
}

$logo_sec_badge     = get_option( 'options_about_page_logo_sec_badge', 'Identitas & Filosofi Brand' );
$logo_sec_title     = get_option( 'options_about_page_logo_sec_title', 'Makna di Balik Lambang BSW' );
$logo_preview_badge = get_option( 'options_about_page_logo_preview_badge', 'Identitas Visual Resmi' );
$logo_preview_title = get_option( 'options_about_page_logo_preview_title', 'Bank Syariah Wakalumi (BSW)' );
$logo_img           = get_option( 'options_about_page_logo_img', get_template_directory_uri() . '/assets/img/logo-new-1.png' );
$logo_desc          = get_option( 'options_about_page_logo_desc', 'Logo BPRS Wakalumi merefleksikan identitas perbankan syariah yang dinamis, bersih, dan berakar pada nilai-nilai keislaman universal.' );

$logo_p1_title  = get_option( 'options_about_page_logo_p1_title', 'Bentuk Gelombang & Aliran Berkah' );
$logo_p1_desc   = get_option( 'options_about_page_logo_p1_desc', 'Melambangkan kelancaran aliran rezeki, fleksibilitas dalam melayani, serta kesegaran solusi finansial yang menyejukkan perekonomian umat.' );
$logo_p1_color  = get_option( 'options_about_page_logo_p1_color', 'teal' );
$p1_theme       = function_exists( 'wakalumi_get_pilar_color_theme' ) ? wakalumi_get_pilar_color_theme( $logo_p1_color ) : [];

$logo_p2_title  = get_option( 'options_about_page_logo_p2_title', 'Warna Ocean Teal & Bright Teal' );
$logo_p2_desc   = get_option( 'options_about_page_logo_p2_desc', 'Merefleksikan ketenangan, stabilitas finansial yang kokoh, profesionalisme modern, serta komitmen menjaga amanah nasabah.' );
$logo_p2_color  = get_option( 'options_about_page_logo_p2_color', 'blue' );
$p2_theme       = function_exists( 'wakalumi_get_pilar_color_theme' ) ? wakalumi_get_pilar_color_theme( $logo_p2_color ) : [];

$logo_p3_title  = get_option( 'options_about_page_logo_p3_title', 'Aksen Mint Glow' );
$logo_p3_desc   = get_option( 'options_about_page_logo_p3_desc', 'Melambangkan pertumbuhan ekonomi yang berkah, harapan baru bagi UMKM, dan masa depan perbankan syariah yang gemilang.' );
$logo_p3_color  = get_option( 'options_about_page_logo_p3_color', 'sky' );
$p3_theme       = function_exists( 'wakalumi_get_pilar_color_theme' ) ? wakalumi_get_pilar_color_theme( $logo_p3_color ) : [];

$show_stats     = get_option( 'options_about_page_show_stats', '1' );
$show_vision    = get_option( 'options_about_page_show_vision', '1' );
$show_values    = get_option( 'options_about_page_show_values', '1' );
$show_logo      = get_option( 'options_about_page_show_logo', '1' );
$show_compro    = get_option( 'options_about_page_compro_show', '1' );
$show_cta       = get_option( 'options_about_page_show_cta', '1' );

$compro_badge        = get_option( 'options_about_page_compro_badge', 'Dokumen Resmi Perusahaan' );
$compro_title        = get_option( 'options_about_page_compro_title', 'Unduh Company Profile PT BPRS Wakalumi' );
$compro_desc         = get_option( 'options_about_page_compro_desc', 'Dapatkan ikhtisar resmi dan komprehensif mengenai profil kelembagaan, landasan syariah, susunan kepemimpinan, kepatuhan tata kelola (GCG), serta pertumbuhan kinerja keuangan BPRS Wakalumi.' );
$compro_year         = get_option( 'options_about_page_compro_year', 'Edisi 2026' );
$compro_file         = get_option( 'options_about_page_compro_file', '' );
$compro_cover        = get_option( 'options_about_page_compro_cover', '' );
$compro_filesize     = get_option( 'options_about_page_compro_filesize', 'PDF • Dokumen Resmi Terverifikasi' );
$compro_updated      = get_option( 'options_about_page_compro_updated', 'Pembaruan Tahunan' );
$compro_btn_dl_text  = get_option( 'options_about_page_compro_btn_dl_text', 'Unduh Company Profile (PDF)' );
$compro_highlights   = get_option( 'options_about_page_compro_highlights', [
    'Ikhtisar Profil Lembaga & Legalitas OJK',
    'Struktur Pengurus & Dewan Pengawas Syariah',
    'Laporan Kinerja Keuangan & Rasio Kesehatan Bank',
    'Katalog Portofolio Produk Simpanan & Pembiayaan'
] );
$cta_badge      = get_option( 'options_about_page_cta_badge', 'Langkah Nyata Bersama Kami' );
$cta_title      = get_option( 'options_about_page_cta_title', 'Siap Mengembangkan Usaha & Mengelola Dana Secara Berkah?' );
$cta_desc       = get_option( 'options_about_page_cta_desc', 'Konsultasikan kebutuhan perbankan syariah Anda bersama tim profesional BPRS Wakalumi, atau temukan solusi simpanan dan pembiayaan yang tepat untuk masa depan finansial Anda.' );
$cta_btn1_text  = get_option( 'options_about_page_cta_btn1_text', 'Hubungi via WhatsApp' );
$cta_btn1_url   = get_option( 'options_about_page_cta_btn1_url', '' );
$cta_btn2_text  = get_option( 'options_about_page_cta_btn2_text', 'Jelajahi Produk Kami' );
$cta_btn2_url   = get_option( 'options_about_page_cta_btn2_url', home_url( '/produk' ) );

$wa_number      = get_option( 'options_contact_wa', '6281517380388' );
$wa_url         = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );

if ( empty( $cta_btn1_url ) ) {
    $cta_btn1_url = $wa_url;
}
?>

<!-- ========================================
     HEADER BANNER & BREADCRUMBS (UNIFIED HERO + BRAND EMBLEM CARD)
     ======================================== -->
<section class="wkl-page-hero">
    <!-- Subtle Ambient Glow -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-80 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

    <div class="container-wide relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-300 transition-colors flex items-center gap-1.5 font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-slate-600 dark:text-slate-300 font-medium">Profil</span>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-teal-600 dark:text-teal-400 font-bold">Tentang Kami</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            <!-- Left Column: Title, Subtitle & Highlights -->
            <div class="<?php echo ( $hero_card_show === '1' ) ? 'lg:col-span-7 xl:col-span-8' : 'lg:col-span-12 max-w-4xl'; ?>" data-aos="fade-up">
                <!-- Kicker Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full mb-4 bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                    <span><?php echo esc_html( $page_badge ); ?></span>
                </div>

                <!-- Main Page Title -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-[1.15] mb-4">
                    <?php echo esc_html( $page_title ); ?>
                </h1>

                <!-- Subtitle -->
                <?php if ( ! empty( $page_subtitle ) ) : ?>
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                        <?php echo esc_html( $page_subtitle ); ?>
                    </p>
                <?php endif; ?>

                <!-- Key Highlights Pills -->
                <?php if ( ! empty( $hero_pill_1 ) || ! empty( $hero_pill_2 ) || ! empty( $hero_pill_3 ) ) : ?>
                <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-700 dark:text-slate-200">
                    <?php if ( ! empty( $hero_pill_1 ) ) : ?>
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200/90 dark:border-dark-border shadow-xs hover:shadow-md hover:-translate-y-0.5 hover:border-teal-400 dark:hover:border-teal-600 transition-all duration-300 font-semibold cursor-default">
                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span><?php echo esc_html( $hero_pill_1 ); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $hero_pill_2 ) ) : ?>
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200/90 dark:border-dark-border shadow-xs hover:shadow-md hover:-translate-y-0.5 hover:border-teal-400 dark:hover:border-teal-600 transition-all duration-300 font-semibold cursor-default">
                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        <span><?php echo esc_html( $hero_pill_2 ); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $hero_pill_3 ) ) : ?>
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200/90 dark:border-dark-border shadow-xs hover:shadow-md hover:-translate-y-0.5 hover:border-teal-400 dark:hover:border-teal-600 transition-all duration-300 font-semibold cursor-default">
                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span><?php echo esc_html( $hero_pill_3 ); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right Column: Corporate Identity & Emblem Badge Card -->
            <?php if ( $hero_card_show === '1' ) : ?>
            <div class="lg:col-span-5 xl:col-span-4" data-aos="fade-up" data-aos-delay="100">
                <div class="spotlight-card relative overflow-hidden rounded-3xl bg-white dark:bg-slate-900 border border-teal-200/90 dark:border-teal-800/80 shadow-lg hover:shadow-2xl hover:shadow-teal-900/10 dark:hover:shadow-black/60 hover:-translate-y-2 hover:border-teal-400 dark:hover:border-teal-500 transition-all duration-300 group cursor-default">
                    <!-- Top Gradient Accent Bar -->
                    <div class="h-1.5 w-full bg-gradient-to-r from-teal-500 via-cyan-400 to-emerald-500"></div>

                    <!-- Dual-Tone Upper Header -->
                    <div class="p-6 bg-gradient-to-br from-teal-50/90 via-cyan-50/40 to-white dark:from-teal-950/70 dark:via-slate-900/60 dark:to-slate-900 border-b border-teal-100/80 dark:border-slate-800 relative overflow-hidden text-center">
                        <!-- Interactive Slide Watermark Emblem -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.055] dark:opacity-[0.04] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] select-none">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>

                        <!-- Official Company Emblem Icon -->
                        <div class="relative w-16 h-16 rounded-2xl bg-white dark:bg-slate-800 flex items-center justify-center p-2.5 mx-auto shadow-md shadow-teal-500/10 border border-teal-200/80 dark:border-teal-700/60 group-hover:scale-105 transition-transform duration-300 z-10 mb-3">
                            <img src="<?php echo esc_url( $hero_card_logo ); ?>" alt="<?php echo esc_attr( $hero_card_title ); ?>" class="w-full h-full object-contain">
                        </div>

                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-teal-100/90 dark:bg-teal-950 text-teal-800 dark:text-teal-300 text-[10px] font-extrabold uppercase tracking-wider mb-1 relative z-10">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                            <?php echo esc_html( $hero_card_badge ); ?>
                        </div>
                        <h3 class="text-lg font-black text-slate-900 dark:text-white relative z-10"><?php echo esc_html( $hero_card_title ); ?></h3>
                    </div>

                    <!-- Lower Card Body -->
                    <div class="p-6 space-y-4 bg-white dark:bg-slate-900/95 relative z-10 text-center">
                        <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                            <?php echo esc_html( $hero_card_desc ); ?>
                        </p>
                        <div class="pt-2 border-t border-slate-100 dark:border-slate-800 flex items-center justify-center gap-3 text-[11px] font-bold text-slate-600 dark:text-slate-300">
                            <?php if ( ! empty( $hero_card_tag1 ) ) : ?>
                            <span class="inline-flex items-center gap-1 text-teal-700 dark:text-teal-300 font-bold">
                                <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                <?php echo esc_html( $hero_card_tag1 ); ?>
                            </span>
                            <?php endif; ?>
                            <?php if ( ! empty( $hero_card_tag1 ) && ! empty( $hero_card_tag2 ) ) : ?>
                            <span class="text-slate-300 dark:text-slate-600">•</span>
                            <?php endif; ?>
                            <?php if ( ! empty( $hero_card_tag2 ) ) : ?>
                            <span class="inline-flex items-center gap-1 text-teal-700 dark:text-teal-300 font-bold">
                                <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                <?php echo esc_html( $hero_card_tag2 ); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- ========================================
     SECTION 1: SEKILAS PERUSAHAAN & STATISTIK
     ======================================== -->
<section class="relative z-10 py-14 md:py-20 bg-white dark:bg-dark border-b border-slate-100 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- Left Narrative -->
            <div class="lg:col-span-7" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300 border border-teal-100 dark:border-teal-800/30 mb-4">
                    <?php echo esc_html( $sec_badge ); ?>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-snug mb-6">
                    <?php echo esc_html( $sec_title ); ?>
                </h2>
                <div class="space-y-4 text-slate-600 dark:text-slate-300 leading-relaxed text-base md:text-lg">
                    <p class="border-l-4 border-primary-500 pl-4 italic text-slate-700 dark:text-slate-200">
                        <?php echo nl2br( esc_html( $narrative_1 ) ); ?>
                    </p>
                    <p>
                        <?php echo nl2br( esc_html( $narrative_2 ) ); ?>
                    </p>
                </div>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <?php if ( ! empty( $sec_btn1_text ) ) : ?>
                    <a href="<?php echo esc_url( $sec_btn1_url ); ?>" class="btn-primary text-xs sm:text-sm px-6 py-3 rounded-xl inline-flex items-center gap-2">
                        <span><?php echo esc_html( $sec_btn1_text ); ?></span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ( ! empty( $sec_btn2_text ) ) : ?>
                    <a href="<?php echo esc_url( $sec_btn2_url ); ?>" class="btn-secondary text-xs sm:text-sm px-6 py-3 rounded-xl inline-flex items-center gap-2">
                        <span><?php echo esc_html( $sec_btn2_text ); ?></span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Photo with Floating Frame -->
            <div class="lg:col-span-5 relative" data-aos="fade-left">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-slate-300/50 dark:shadow-black/50 border border-slate-200/80 dark:border-slate-700/60 group">
                    <img src="<?php echo esc_url( $about_img ); ?>" 
                         alt="<?php echo esc_attr( ! empty( $photo_title ) ? $photo_title : 'Gedung Kantor Bank Syariah Wakalumi' ); ?>" 
                         class="w-full h-80 sm:h-96 md:h-[420px] object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                    <div class="absolute bottom-5 left-5 right-5 text-white">
                        <?php if ( ! empty( $photo_label ) ) : ?>
                            <span class="text-xs font-semibold uppercase tracking-widest text-teal-300 drop-shadow"><?php echo esc_html( $photo_label ); ?></span>
                        <?php endif; ?>
                        <?php if ( ! empty( $photo_title ) ) : ?>
                            <h4 class="text-lg font-bold drop-shadow"><?php echo esc_html( $photo_title ); ?></h4>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Floating Amanah Badge — top-right, outside image frame -->
                <?php if ( ! empty( $floating_title ) || ! empty( $floating_desc ) ) : ?>
                <div class="absolute -top-5 -right-5 sm:-top-6 sm:-right-6 bg-white/95 dark:bg-dark-surface/95 backdrop-blur-md px-4 py-3 rounded-2xl shadow-xl border border-slate-200/80 dark:border-slate-700/60 flex items-center gap-3 max-w-[210px]" data-aos="zoom-in" data-aos-delay="200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-teal-400 flex items-center justify-center text-white shrink-0 shadow-md">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <?php if ( ! empty( $floating_title ) ) : ?>
                            <span class="block text-base font-black text-slate-900 dark:text-white leading-none mb-0.5"><?php echo esc_html( $floating_title ); ?></span>
                        <?php endif; ?>
                        <?php if ( ! empty( $floating_desc ) ) : ?>
                            <span class="text-[10px] font-semibold text-slate-500 dark:text-slate-400 leading-tight block"><?php echo esc_html( $floating_desc ); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- 4 Key Stats (Dual Tone Islamic Banking Cards) -->
        <?php if ( $show_stats ) : 
            $stat_meta = [
                1 => [
                    'tag'        => '01 / Dedikasi',
                    'bar_bg'     => 'bg-gradient-to-r from-slate-100 via-teal-50/70 to-slate-100 dark:from-slate-800 dark:via-teal-950/40 dark:to-slate-850',
                    'bar_border' => 'border-teal-100/90 dark:border-slate-800',
                    'icon_wrap'  => 'bg-teal-500/10 text-teal-700 dark:bg-teal-400/15 dark:text-teal-300 border-teal-200/80 dark:border-teal-700/60 group-hover:bg-teal-600 group-hover:text-white group-hover:border-teal-600',
                    'tag_cls'    => 'text-teal-800 dark:text-teal-300 bg-teal-100/70 dark:bg-teal-950/80 border-teal-200/60 dark:border-teal-800/60',
                    'icon'       => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', // Jam/Tahun Pengalaman
                ],
                2 => [
                    'tag'        => '02 / Amanah',
                    'bar_bg'     => 'bg-gradient-to-r from-slate-100 via-emerald-50/70 to-slate-100 dark:from-slate-800 dark:via-emerald-950/40 dark:to-slate-850',
                    'bar_border' => 'border-emerald-100/90 dark:border-slate-800',
                    'icon_wrap'  => 'bg-emerald-500/10 text-emerald-700 dark:bg-emerald-400/15 dark:text-emerald-300 border-emerald-200/80 dark:border-emerald-700/60 group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-600',
                    'tag_cls'    => 'text-emerald-800 dark:text-emerald-300 bg-emerald-100/70 dark:bg-emerald-950/80 border-emerald-200/60 dark:border-emerald-800/60',
                    'icon'       => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>', // Nasabah Setia
                ],
                3 => [
                    'tag'        => '03 / Syariah',
                    'bar_bg'     => 'bg-gradient-to-r from-slate-100 via-cyan-50/70 to-slate-100 dark:from-slate-800 dark:via-cyan-950/40 dark:to-slate-850',
                    'bar_border' => 'border-cyan-100/90 dark:border-slate-800',
                    'icon_wrap'  => 'bg-cyan-500/10 text-cyan-700 dark:bg-cyan-400/15 dark:text-cyan-300 border-cyan-200/80 dark:border-cyan-700/60 group-hover:bg-cyan-600 group-hover:text-white group-hover:border-cyan-600',
                    'tag_cls'    => 'text-cyan-800 dark:text-cyan-300 bg-cyan-100/70 dark:bg-cyan-950/80 border-cyan-200/60 dark:border-cyan-800/60',
                    'icon'       => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>', // Prinsip Murni Syariah
                ],
                4 => [
                    'tag'        => '04 / Regulasi',
                    'bar_bg'     => 'bg-gradient-to-r from-slate-100 via-amber-50/70 to-slate-100 dark:from-slate-800 dark:via-amber-950/40 dark:to-slate-850',
                    'bar_border' => 'border-amber-100/90 dark:border-slate-800',
                    'icon_wrap'  => 'bg-amber-500/10 text-amber-700 dark:bg-amber-400/15 dark:text-amber-300 border-amber-200/80 dark:border-amber-700/60 group-hover:bg-amber-600 group-hover:text-white group-hover:border-amber-600',
                    'tag_cls'    => 'text-amber-800 dark:text-amber-300 bg-amber-100/70 dark:bg-amber-950/80 border-amber-200/60 dark:border-amber-800/60',
                    'icon'       => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>', // Dijamin LPS
                ],
            ];
        ?>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-16 sm:mt-20">
            <?php for ( $s = 1; $s <= 4; $s++ ) : 
                $val = ${"stat_{$s}_val"};
                $lbl = ${"stat_{$s}_lbl"};
                if ( empty( $val ) ) continue;

                $meta = $stat_meta[ $s ] ?? $stat_meta[ 1 ];

                // Parse counter values for interactive animation:
                $prefix = '';
                $num    = 0;
                $suffix = '';
                $is_num = false;
                if ( preg_match( '/^(.*?)(\d+[\d\.]*)(.*?)$/u', $val, $m ) ) {
                    $is_num    = true;
                    $prefix    = $m[1];
                    $clean_num = str_replace( '.', '', $m[2] );
                    $num       = intval( $clean_num );
                    $suffix    = $m[3];
                }

                $val_clean = trim( $val );
                $val_len   = mb_strlen( $val_clean );
                // Skala ukuran proporsional jika teks panjang (mis. "Rp 2 Miliar") agar seragam dan rapi
                $font_size = ( $val_len > 7 ) ? 'text-2xl sm:text-3xl xl:text-4xl' : 'text-3xl sm:text-4xl md:text-5xl';
            ?>
                <div class="spotlight-card group relative overflow-hidden rounded-2xl md:rounded-3xl border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-[0_16px_32px_-6px_rgba(15,23,42,0.14),0_6px_12px_-3px_rgba(8,131,149,0.12)] dark:hover:shadow-[0_16px_32px_-6px_rgba(0,0,0,0.8),0_0_24px_rgba(20,184,166,0.18)] hover:-translate-y-2 hover:border-teal-500/60 dark:hover:border-teal-400/60 transition-all duration-300 ease-out cursor-default flex flex-col justify-between" data-aos="fade-up" data-aos-delay="<?php echo $s * 80; ?>">
                    <!-- Top Accent Line -->
                    <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 via-primary-500 to-emerald-400"></div>

                    <!-- Upper Zone (Header Bar): Dual Tone Distinct Contrast & Mature Character -->
                    <div class="px-5 py-4 <?php echo esc_attr( $meta['bar_bg'] ); ?> border-b <?php echo esc_attr( $meta['bar_border'] ); ?> flex items-center justify-between transition-colors">
                        <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl <?php echo esc_attr( $meta['icon_wrap'] ); ?> border shadow-xs flex items-center justify-center transition-all duration-300 shrink-0">
                            <?php echo $meta['icon']; ?>
                        </div>
                        <span class="text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full border shadow-2xs <?php echo esc_attr( $meta['tag_cls'] ); ?>">
                            <?php echo esc_html( $meta['tag'] ); ?>
                        </span>
                    </div>

                    <!-- Lower Zone (Body / Stat Metric Area): Crisp Solid High-Contrast Foundation -->
                    <div class="p-5 sm:p-6 bg-white dark:bg-slate-900 flex-1 flex flex-col justify-center items-center text-center relative overflow-hidden">
                        <!-- Decorative Watermark Logo (Tenang di pojok kanan bawah) -->
                        <div class="absolute -right-3 -bottom-3 w-24 h-24 opacity-[0.035] dark:opacity-[0.025] pointer-events-none transition-all duration-500 ease-out group-hover:scale-105 group-hover:opacity-[0.06] select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>

                        <!-- Number Counter -->
                        <span class="block <?php echo $font_size; ?> font-rubik font-black text-slate-900 dark:text-white group-hover:text-teal-600 dark:group-hover:text-teal-300 transition-colors tracking-tight mb-1.5 counter-number relative z-10"
                              <?php if ( $is_num ) : ?>
                                  data-counter="<?php echo esc_attr( $num ); ?>"
                                  data-counter-prefix="<?php echo esc_attr( $prefix ); ?>"
                                  data-counter-suffix="<?php echo esc_attr( $suffix ); ?>"
                              <?php endif; ?>>
                            <?php echo esc_html( $val ); ?>
                        </span>

                        <!-- Label -->
                        <span class="text-xs sm:text-[13px] font-extrabold text-slate-600 dark:text-slate-300 uppercase tracking-wider block group-hover:text-slate-900 dark:group-hover:text-white transition-colors relative z-10 leading-snug">
                            <?php echo esc_html( $lbl ); ?>
                        </span>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</section>


<!-- ========================================
     SECTION 2: VISI & MISI STRATEGIS
     ======================================== -->
<?php if ( $show_vision ) : ?>
<section class="relative z-10 py-16 md:py-24 bg-transparent border-y border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16" data-aos="fade-up">
            <?php if ( ! empty( $vm_badge ) ) : ?>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-primary-50 text-primary-700 dark:bg-primary-400/10 dark:text-accent border border-primary-100 dark:border-primary-800/30 mb-3">
                <?php echo esc_html( $vm_badge ); ?>
            </div>
            <?php endif; ?>
            <?php if ( ! empty( $vm_title ) ) : ?>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                <?php echo esc_html( $vm_title ); ?>
            </h2>
            <?php endif; ?>
            <?php if ( ! empty( $vm_subtitle ) ) : ?>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3">
                <?php echo nl2br( esc_html( $vm_subtitle ) ); ?>
            </p>
            <?php endif; ?>
        </div>

        <!-- Visi Card (Megah Showcase) -->
        <div class="spotlight-card relative rounded-3xl p-8 sm:p-10 md:p-14 overflow-hidden bg-gradient-to-br from-primary-900 via-primary-950 to-slate-950 text-white shadow-2xl shadow-primary-900/30 border border-primary-500/30 mb-10 md:mb-14 hover:-translate-y-1.5 transition-all duration-500 cursor-default" data-aos="zoom-in">
            <!-- Background Decorative Watermark Emblem -->
            <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/4 w-72 h-72 md:w-96 md:h-96 opacity-[0.06] pointer-events-none">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain">
            </div>

            <!-- Glowing Orb -->
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-primary-500/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-widest bg-white/10 backdrop-blur-md border border-white/20 text-teal-300 mb-6 shadow-2xs">
                    <svg class="w-3.5 h-3.5 text-teal-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <?php echo esc_html( $vision_badge ); ?>
                </div>
                <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold leading-snug tracking-tight mb-5 text-white">
                    "<?php echo esc_html( $vision_title ); ?>"
                </h3>
                <?php if ( ! empty( $vision_desc ) ) : ?>
                    <p class="text-sm sm:text-base md:text-lg text-slate-200 leading-relaxed font-normal">
                        <?php echo esc_html( $vision_desc ); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Misi Grid Cards -->
        <?php if ( ! empty( $missions ) ) : ?>
        <div>
            <h4 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-teal-500"></span>
                <?php echo esc_html( $missions_heading ); ?>
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">
                <?php foreach ( $missions as $idx => $mission_text ) : ?>
                    <div class="spotlight-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-gradient-to-b from-white via-white to-slate-50/70 dark:from-slate-900 dark:via-slate-900 dark:to-slate-900/90 border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-[0_12px_24px_-4px_rgba(15,23,42,0.12),0_4px_10px_-2px_rgba(8,131,149,0.12)] dark:hover:shadow-[0_12px_24px_-4px_rgba(0,0,0,0.75),0_0_18px_rgba(20,184,166,0.15)] hover:border-teal-500/60 dark:hover:border-teal-400/50 hover:-translate-y-1.5 transition-all duration-300 ease-out flex flex-col justify-between cursor-default" data-aos="fade-up" data-aos-delay="<?php echo ( $idx % 3 ) * 100; ?>">
                        <!-- Subtle Top Accent Line -->
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 via-primary-500 to-emerald-400"></div>

                        <!-- Solid Elegant Header Bar -->
                        <div class="px-6 py-4 bg-gradient-to-r from-slate-50/95 via-teal-50/30 to-slate-50/90 dark:from-slate-800/90 dark:via-slate-800/60 dark:to-slate-800/90 border-b border-slate-100 dark:border-slate-800/80 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-xl bg-white dark:bg-slate-900 border border-teal-200/90 dark:border-teal-700/80 text-teal-700 dark:text-teal-300 font-black text-xs flex items-center justify-center shadow-xs group-hover:scale-105 group-hover:bg-teal-600 group-hover:text-white group-hover:border-teal-600 transition-all duration-300">
                                    <?php echo sprintf( '%02d', $idx + 1 ); ?>
                                </div>
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300">Misi Perusahaan</span>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-slate-300 dark:bg-slate-700 group-hover:bg-teal-500 transition-colors"></span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 relative flex-grow flex flex-col justify-between overflow-hidden">
                            <!-- Decorative Quiet Watermark Logo -->
                            <div class="absolute -right-4 -bottom-4 w-32 h-32 opacity-[0.035] dark:opacity-[0.025] pointer-events-none transition-all duration-500 ease-out group-hover:scale-105 group-hover:opacity-[0.06] select-none overflow-hidden">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                            </div>

                            <p class="text-slate-800 dark:text-slate-100 text-sm sm:text-[15px] leading-relaxed relative z-10 font-medium">
                                <?php echo esc_html( $mission_text ); ?>
                            </p>

                            <div class="mt-6 pt-3.5 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-xs font-bold text-slate-500 dark:text-slate-400 relative z-10">
                                <span class="group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                    Pilar Pelayanan
                                </span>
                                <div class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-800 group-hover:bg-teal-50 dark:group-hover:bg-teal-950/60 text-slate-400 group-hover:text-teal-600 dark:group-hover:text-teal-400 flex items-center justify-center transition-colors shadow-2xs">
                                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Jati Diri & Keyakinan Inti (Core Beliefs) -->
        <div class="mt-12 md:mt-16 grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up">
            <!-- Jati Diri -->
            <div class="spotlight-card group relative overflow-hidden rounded-2xl md:rounded-3xl bg-gradient-to-b from-white via-white to-slate-50/70 dark:from-slate-900 dark:via-slate-900 dark:to-slate-900/90 border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-[0_18px_36px_-6px_rgba(15,23,42,0.14),0_8px_16px_-4px_rgba(8,131,149,0.14)] dark:hover:shadow-[0_18px_36px_-6px_rgba(0,0,0,0.8),0_0_24px_rgba(20,184,166,0.18)] hover:border-teal-500/70 dark:hover:border-teal-400/60 hover:-translate-y-2 transition-all duration-300 ease-out cursor-default">
                <!-- Subtle Top Accent Line -->
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 via-primary-500 to-emerald-400"></div>

                <!-- Solid Elegant Header Bar -->
                <div class="px-7 py-4 bg-gradient-to-r from-slate-50/95 via-teal-50/30 to-slate-50/90 dark:from-slate-800/90 dark:via-slate-800/60 dark:to-slate-800/90 border-b border-slate-100 dark:border-slate-800/80 flex items-center justify-between">
                    <span class="text-xs uppercase tracking-widest font-black text-teal-800 dark:text-teal-300"><?php echo esc_html( $identity_badge ); ?></span>
                    <?php if ( ! empty( $identity_tag ) ) : ?>
                    <span class="text-[10px] font-extrabold px-3 py-1 rounded-full bg-teal-100/80 text-teal-900 dark:bg-teal-950 dark:text-teal-300 border border-teal-200/80 dark:border-teal-800 shadow-xs"><?php echo esc_html( $identity_tag ); ?></span>
                    <?php endif; ?>
                </div>
                <div class="p-7 relative overflow-hidden">
                    <!-- Decorative Quiet Watermark Logo -->
                    <div class="absolute -right-4 -bottom-4 w-36 h-36 opacity-[0.035] dark:opacity-[0.025] pointer-events-none transition-all duration-500 ease-out group-hover:scale-105 group-hover:opacity-[0.06] select-none overflow-hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                    </div>
                    <div class="flex items-start gap-5 relative z-10">
                        <div class="w-14 h-14 rounded-2xl bg-teal-50 dark:bg-teal-950/70 border border-teal-200/90 dark:border-teal-800/80 flex items-center justify-center text-teal-700 dark:text-teal-300 shrink-0 shadow-xs group-hover:scale-105 group-hover:bg-teal-600 group-hover:text-white group-hover:border-teal-600 group-hover:shadow-md group-hover:shadow-teal-600/25 transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-black text-slate-900 dark:text-white mb-2 leading-snug"><?php echo esc_html( $identity_title ); ?></h3>
                            <p class="text-sm sm:text-base text-slate-700 dark:text-slate-200 leading-relaxed font-medium">
                                <?php echo esc_html( $identity_text ); ?>
                            </p>
                            <div class="mt-4 pt-3.5 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-xs font-bold text-slate-500 dark:text-slate-400">
                                <span class="flex items-center gap-1.5 text-teal-700 dark:text-teal-300">
                                    <svg class="w-4 h-4 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    Fokus Pemberdayaan Umat
                                </span>
                                <span class="text-[11px] text-slate-400 dark:text-slate-500">Prinsip BSW</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keyakinan Inti (ISHLAH) -->
            <div class="spotlight-card group relative overflow-hidden rounded-2xl md:rounded-3xl bg-gradient-to-b from-white via-white to-slate-50/70 dark:from-slate-900 dark:via-slate-900 dark:to-slate-900/90 border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-[0_18px_36px_-6px_rgba(15,23,42,0.14),0_8px_16px_-4px_rgba(8,131,149,0.14)] dark:hover:shadow-[0_18px_36px_-6px_rgba(0,0,0,0.8),0_0_24px_rgba(20,184,166,0.18)] hover:border-teal-500/70 dark:hover:border-teal-400/60 hover:-translate-y-2 transition-all duration-300 ease-out cursor-default">
                <!-- Subtle Top Accent Line -->
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 via-primary-500 to-emerald-400"></div>

                <!-- Solid Elegant Header Bar -->
                <div class="px-7 py-4 bg-gradient-to-r from-slate-50/95 via-teal-50/30 to-slate-50/90 dark:from-slate-800/90 dark:via-slate-800/60 dark:to-slate-800/90 border-b border-slate-100 dark:border-slate-800/80 flex items-center justify-between">
                    <span class="text-xs uppercase tracking-widest font-black text-teal-800 dark:text-teal-300"><?php echo esc_html( $belief_badge ); ?></span>
                    <?php if ( ! empty( $belief_tag ) ) : ?>
                    <span class="text-[10px] font-extrabold px-3 py-1 rounded-full bg-teal-100/80 text-teal-900 dark:bg-teal-950 dark:text-teal-300 border border-teal-200/80 dark:border-teal-800 shadow-xs"><?php echo esc_html( $belief_tag ); ?></span>
                    <?php endif; ?>
                </div>
                <div class="p-7 relative overflow-hidden">
                    <!-- Decorative Quiet Watermark Logo -->
                    <div class="absolute -right-4 -bottom-4 w-36 h-36 opacity-[0.035] dark:opacity-[0.025] pointer-events-none transition-all duration-500 ease-out group-hover:scale-105 group-hover:opacity-[0.06] select-none overflow-hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                    </div>
                    <div class="flex items-start gap-5 relative z-10">
                        <div class="w-14 h-14 rounded-2xl bg-teal-50 dark:bg-teal-950/70 border border-teal-200/90 dark:border-teal-800/80 flex items-center justify-center text-teal-700 dark:text-teal-300 shrink-0 shadow-xs group-hover:scale-105 group-hover:bg-teal-600 group-hover:text-white group-hover:border-teal-600 group-hover:shadow-md group-hover:shadow-teal-600/25 transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-black text-slate-900 dark:text-white mb-2 leading-snug"><?php echo esc_html( $belief_title ); ?></h3>
                            <p class="text-sm sm:text-base text-slate-700 dark:text-slate-200 leading-relaxed font-medium">
                                <?php echo esc_html( $belief_text ); ?>
                            </p>
                            <div class="mt-4 pt-3.5 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-xs font-bold text-slate-500 dark:text-slate-400">
                                <span class="flex items-center gap-1.5 text-teal-700 dark:text-teal-300">
                                    <svg class="w-4 h-4 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    Perbaikan Berkelanjutan
                                </span>
                                <span class="text-[11px] text-slate-400 dark:text-slate-500">Nilai Abadi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?php endif; ?>


<!-- ========================================
     SECTION 3: NILAI BUDAYA PERUSAHAAN (SAPA)
     ======================================== -->
<?php if ( $show_values && ! empty( $values ) ) : 
    $has_culture_img = ( $culture_img_show === '1' && ( ! empty( $culture_img_light ) || ! empty( $culture_img_dark ) ) );
?>
<section class="relative z-10 pt-14 md:pt-20 <?php echo $has_culture_img ? 'pb-8 sm:pb-10 md:pb-12' : 'pb-16 md:pb-24'; ?> bg-white dark:bg-dark border-b border-slate-100 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16" data-aos="fade-up">
            <?php if ( ! empty( $values_badge ) ) : ?>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300 border border-teal-100 dark:border-teal-800/30 mb-3">
                    <?php echo esc_html( $values_badge ); ?>
                </div>
            <?php endif; ?>
            <?php if ( ! empty( $values_title ) ) : ?>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    <?php echo esc_html( $values_title ); ?>
                </h2>
            <?php endif; ?>
            <?php if ( ! empty( $values_desc ) ) : ?>
                <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                    <?php echo wp_kses_post( $values_desc ); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ( $values as $v_idx => $val_item ) : 
                $acronym = $val_item['acronym'] ?? '';
                $v_title = $val_item['title'] ?? '';
                $v_desc  = $val_item['desc'] ?? '';
            ?>
                <div class="spotlight-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-gradient-to-b from-white via-white to-slate-50/70 dark:from-slate-900 dark:via-slate-900 dark:to-slate-900/90 border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-[0_18px_36px_-6px_rgba(8,131,149,0.22),0_8px_16px_-4px_rgba(15,23,42,0.1)] dark:hover:shadow-[0_18px_36px_-6px_rgba(0,0,0,0.85),0_0_24px_rgba(20,184,166,0.22)] hover:border-teal-500 dark:hover:border-teal-400 hover:-translate-y-2.5 transition-all duration-300 ease-out flex flex-col justify-between cursor-default" data-aos="fade-up" data-aos-delay="<?php echo ( $v_idx % 4 ) * 80; ?>">
                    <!-- Subtle Top Accent Line -->
                    <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 via-primary-500 to-emerald-400"></div>

                    <!-- Solid Elegant Header Bar -->
                    <div class="px-6 py-4 bg-gradient-to-r from-slate-50/95 via-teal-50/30 to-slate-50/90 dark:from-slate-800/90 dark:via-slate-800/60 dark:to-slate-800/90 border-b border-slate-100 dark:border-slate-800/80 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-11 h-11 rounded-2xl bg-white dark:bg-slate-900 border border-teal-200/90 dark:border-teal-700/80 text-teal-700 dark:text-teal-300 font-rubik font-black text-xl flex items-center justify-center shadow-xs group-hover:scale-110 group-hover:bg-gradient-to-br group-hover:from-teal-600 group-hover:to-teal-700 group-hover:text-white group-hover:border-teal-600 group-hover:shadow-lg group-hover:shadow-teal-600/30 transition-all duration-300">
                                <?php echo esc_html( $acronym ); ?>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase tracking-widest font-extrabold text-teal-800 dark:text-teal-300 block">Karakter</span>
                                <h3 class="text-base font-extrabold text-slate-900 dark:text-white group-hover:text-teal-700 dark:group-hover:text-teal-300 transition-colors">
                                    <?php echo esc_html( $v_title ); ?>
                                </h3>
                            </div>
                        </div>
                        <span class="w-2.5 h-2.5 rounded-full bg-slate-300 dark:bg-slate-700 group-hover:bg-teal-500 group-hover:scale-125 transition-all"></span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 relative flex-grow flex flex-col justify-between overflow-hidden">
                        <!-- Decorative Quiet Watermark Logo -->
                        <div class="absolute -right-4 -bottom-4 w-32 h-32 opacity-[0.035] dark:opacity-[0.025] pointer-events-none transition-all duration-500 ease-out group-hover:scale-105 group-hover:opacity-[0.06] select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>

                        <!-- Solid Statement Box (Eliminates the 'kopong' empty feel) -->
                        <div class="p-4 rounded-2xl bg-slate-50/90 dark:bg-slate-800/70 border border-slate-100 dark:border-slate-700/60 relative z-10 shadow-2xs group-hover:bg-teal-50/60 dark:group-hover:bg-teal-950/40 group-hover:border-teal-200 dark:group-hover:border-teal-800 transition-all duration-300">
                            <div class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-teal-500 dark:text-teal-400 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                </svg>
                                <p class="text-xs sm:text-sm text-slate-800 dark:text-slate-100 font-semibold leading-relaxed italic flex-1">
                                    "<?php echo esc_html( $v_desc ); ?>"
                                </p>
                            </div>
                        </div>

                        <?php if ( ! empty( $values_tag ) ) : ?>
                        <div class="mt-5 pt-3.5 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-xs font-bold text-slate-500 dark:text-slate-400 relative z-10">
                            <span class="group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                <?php echo esc_html( $values_tag ); ?>
                            </span>
                            <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-md bg-teal-50 dark:bg-teal-950/80 text-teal-700 dark:text-teal-300 border border-teal-200/60 dark:border-teal-800/60 shadow-2xs">
                                Pilar #WAQF
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ( $culture_img_show === '1' && ( ! empty( $culture_img_light ) || ! empty( $culture_img_dark ) ) ) : 
            $img_light_src = ! empty( $culture_img_light ) ? $culture_img_light : $culture_img_dark;
            $img_dark_src  = ! empty( $culture_img_dark ) ? $culture_img_dark : $culture_img_light;
        ?>
        <!-- Corporate Culture Visual Emblem (Polos Rata Tengah, Efek 3D Mengambang Langsung pada Gambar, Tenang Tanpa Hover) -->
        <div class="relative mt-12 sm:mt-16 flex flex-col justify-center items-center text-center select-none" data-aos="fade-up" data-aos-delay="150">
            <!-- Subtle Ambient Backdrop Aura (Halus di Belakang Gambar) -->
            <div class="absolute w-3/4 max-w-2xl h-36 sm:h-44 bg-gradient-radial from-teal-400/15 via-primary-500/5 to-transparent blur-3xl pointer-events-none opacity-70 dark:opacity-40 -z-0"></div>

            <!-- 3D Logo Element (Polos Tanpa Kotak / Frame, Tenang Tanpa Hover) -->
            <div class="relative z-10">
                <!-- Light Mode Image with Realistic 3D Multi-Layer Drop-Shadow (Menghadirkan Efek Timbul Fisik) -->
                <img src="<?php echo esc_url( $img_light_src ); ?>" 
                     alt="<?php echo esc_attr( $culture_caption ); ?>" 
                     class="w-auto max-h-56 sm:max-h-72 md:max-h-80 lg:max-h-96 max-w-full md:max-w-2xl lg:max-w-3xl object-contain drop-shadow-[0_4px_6px_rgba(15,23,42,0.08)] drop-shadow-[0_14px_22px_rgba(15,23,42,0.12)] drop-shadow-[0_24px_36px_rgba(8,131,149,0.16)] dark:hidden">
                
                <!-- Dark Mode Image with 3D Depth & Luminescent Aura -->
                <img src="<?php echo esc_url( $img_dark_src ); ?>" 
                     alt="<?php echo esc_attr( $culture_caption ); ?>" 
                     class="w-auto max-h-56 sm:max-h-72 md:max-h-80 lg:max-h-96 max-w-full md:max-w-2xl lg:max-w-3xl object-contain drop-shadow-[0_6px_12px_rgba(0,0,0,0.7)] drop-shadow-[0_18px_32px_rgba(0,0,0,0.85)] drop-shadow-[0_0_28px_rgba(45,212,191,0.28)] hidden dark:block">
            </div>

            <!-- Soft 3D Floor Shadow (Memberi Kesan Kedalaman Mengambang Nyata di Atas Background) -->
            <div class="w-44 sm:w-60 md:w-72 h-3.5 rounded-[100%] bg-slate-900/10 dark:bg-black/35 blur-md mt-1 pointer-events-none"></div>

            <?php if ( ! empty( $culture_caption ) || ! empty( $culture_subcaption ) ) : ?>
            <!-- Subtle Caption Text (Opsional & Minimalis) -->
            <div class="mt-4 text-center">
                <?php if ( ! empty( $culture_caption ) ) : ?>
                    <h4 class="text-xs sm:text-sm font-extrabold uppercase tracking-widest text-slate-700 dark:text-slate-300"><?php echo esc_html( $culture_caption ); ?></h4>
                <?php endif; ?>
                <?php if ( ! empty( $culture_subcaption ) ) : ?>
                    <p class="text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 mt-0.5 max-w-md mx-auto"><?php echo esc_html( $culture_subcaption ); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     SECTION 4: MAKNA & FILOSOFI LOGO
     ======================================== -->
<?php if ( $show_logo ) : ?>
<section class="relative z-10 py-16 md:py-24 bg-gradient-to-b from-slate-50/80 via-white to-slate-50/80 dark:from-dark-surface/60 dark:via-dark dark:to-dark-surface/60 border-t border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- Logo Preview on Elegant Surface -->
            <div class="lg:col-span-5" data-aos="fade-right">
                <div class="spotlight-card tilt-card rounded-3xl p-8 sm:p-10 bg-slate-900 text-white shadow-2xl border border-slate-800 relative overflow-hidden flex flex-col items-center justify-center text-center group cursor-default hover:-translate-y-1.5 hover:shadow-primary-950/40 transition-all duration-300 ease-out">
                    <!-- Subtle Glow -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary-500/20 via-teal-500/10 to-transparent pointer-events-none"></div>
                    
                    <div class="relative z-10 w-full max-w-xs h-32 sm:h-40 flex items-center justify-center p-4">
                        <img src="<?php echo esc_url( $logo_img ); ?>" 
                             alt="<?php echo esc_attr( ! empty( $logo_preview_title ) ? $logo_preview_title : 'Logo Resmi Bank Syariah Wakalumi' ); ?>" 
                             class="max-w-full max-h-full object-contain filter drop-shadow-[0_10px_20px_rgba(0,0,0,0.5)] group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="relative z-10 mt-6 pt-6 border-t border-white/10 w-full">
                        <span class="text-xs uppercase tracking-widest font-bold text-teal-300"><?php echo esc_html( $logo_preview_badge ); ?></span>
                        <h4 class="text-base font-bold text-white mt-1"><?php echo esc_html( $logo_preview_title ); ?></h4>
                    </div>
                </div>
            </div>

            <!-- Pillars of Philosophy -->
            <div class="lg:col-span-7" data-aos="fade-left">
                <?php if ( ! empty( $logo_sec_badge ) ) : ?>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-primary-50 text-primary-700 dark:bg-primary-400/10 dark:text-teal-300 border border-primary-100 dark:border-primary-800/30 mb-3">
                    <?php echo esc_html( $logo_sec_badge ); ?>
                </div>
                <?php endif; ?>
                <?php if ( ! empty( $logo_sec_title ) ) : ?>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-snug mb-4">
                    <?php echo esc_html( $logo_sec_title ); ?>
                </h2>
                <?php endif; ?>
                <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed mb-8">
                    <?php echo nl2br( esc_html( $logo_desc ) ); ?>
                </p>

                <div class="space-y-5">
                    <!-- Pillar 1 -->
                    <div class="spotlight-card tilt-card group relative overflow-hidden rounded-2xl p-5 sm:p-6 bg-gradient-to-r <?php echo esc_attr( $p1_theme['bg_gradient'] ); ?> border-l-4 <?php echo esc_attr( $p1_theme['border_l'] ); ?> border border-slate-200/90 dark:border-slate-700/80 shadow-sm hover:shadow-xl hover:shadow-teal-900/5 dark:hover:shadow-black/50 <?php echo esc_attr( $p1_theme['border_hover'] ); ?> hover:-translate-y-1.5 transition-all duration-300 ease-out cursor-default">
                        <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-32 h-32 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>
                        <div class="relative z-10 space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider <?php echo esc_attr( $p1_theme['badge_bg'] ); ?> shadow-2xs">
                                    <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $p1_theme['badge_dot'] ); ?> animate-pulse"></span>
                                    Filosofi 01
                                </span>
                            </div>
                            <h4 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white leading-snug">
                                <?php echo wakalumi_dualtone_title( $logo_p1_title, $p1_theme['title_accent'] ); ?>
                            </h4>
                            <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                                <?php echo esc_html( $logo_p1_desc ); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Pillar 2 -->
                    <div class="spotlight-card tilt-card group relative overflow-hidden rounded-2xl p-5 sm:p-6 bg-gradient-to-r <?php echo esc_attr( $p2_theme['bg_gradient'] ); ?> border-l-4 <?php echo esc_attr( $p2_theme['border_l'] ); ?> border border-slate-200/90 dark:border-slate-700/80 shadow-sm hover:shadow-xl hover:shadow-teal-900/5 dark:hover:shadow-black/50 <?php echo esc_attr( $p2_theme['border_hover'] ); ?> hover:-translate-y-1.5 transition-all duration-300 ease-out cursor-default">
                        <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-32 h-32 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>
                        <div class="relative z-10 space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider <?php echo esc_attr( $p2_theme['badge_bg'] ); ?> shadow-2xs">
                                    <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $p2_theme['badge_dot'] ); ?> animate-pulse"></span>
                                    Filosofi 02
                                </span>
                            </div>
                            <h4 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white leading-snug">
                                <?php echo wakalumi_dualtone_title( $logo_p2_title, $p2_theme['title_accent'] ); ?>
                            </h4>
                            <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                                <?php echo esc_html( $logo_p2_desc ); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Pillar 3 -->
                    <div class="spotlight-card tilt-card group relative overflow-hidden rounded-2xl p-5 sm:p-6 bg-gradient-to-r <?php echo esc_attr( $p3_theme['bg_gradient'] ); ?> border-l-4 <?php echo esc_attr( $p3_theme['border_l'] ); ?> border border-slate-200/90 dark:border-slate-700/80 shadow-sm hover:shadow-xl hover:shadow-teal-900/5 dark:hover:shadow-black/50 <?php echo esc_attr( $p3_theme['border_hover'] ); ?> hover:-translate-y-1.5 transition-all duration-300 ease-out cursor-default">
                        <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-32 h-32 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>
                        <div class="relative z-10 space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider <?php echo esc_attr( $p3_theme['badge_bg'] ); ?> shadow-2xs">
                                    <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $p3_theme['badge_dot'] ); ?> animate-pulse"></span>
                                    Filosofi 03
                                </span>
                            </div>
                            <h4 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white leading-snug">
                                <?php echo wakalumi_dualtone_title( $logo_p3_title, $p3_theme['title_accent'] ); ?>
                            </h4>
                            <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                                <?php echo esc_html( $logo_p3_desc ); ?>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     SECTION 5: DOKUMEN COMPANY PROFILE RESMI (UNDUH PDF)
     ======================================== -->
<?php if ( $show_compro ) : 
    $compro_has_file      = ! empty( $compro_file );
    $compro_download_url  = $compro_has_file ? esc_url( $compro_file ) : $cta_btn1_url;
    $compro_download_attr = $compro_has_file ? 'download="' . esc_attr( basename( parse_url( $compro_file, PHP_URL_PATH ) ) ) . '"' : 'target="_blank" rel="noopener noreferrer"';
?>
<section id="company-profile-section" class="relative z-10 py-16 md:py-24 bg-gradient-to-b from-slate-50/80 via-teal-50/20 to-white dark:from-dark-surface/50 dark:via-dark dark:to-dark-surface/50 border-t border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <!-- Main Card Container -->
        <div class="spotlight-card relative rounded-3xl p-6 sm:p-10 md:p-14 overflow-hidden bg-white dark:bg-slate-900 border border-teal-200/80 dark:border-slate-800 shadow-xl shadow-teal-500/5 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)]" data-aos="fade-up">
            
            <!-- Ambient Glowing Orbs -->
            <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-teal-500/10 dark:bg-teal-500/15 blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-primary-500/10 dark:bg-primary-500/15 blur-3xl pointer-events-none"></div>
            
            <!-- Background Watermark Emblem -->
            <div class="absolute right-0 bottom-0 translate-x-1/4 translate-y-1/4 w-80 h-80 opacity-[0.035] dark:opacity-[0.025] pointer-events-none">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-full h-full object-contain">
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center relative z-10">
                
                <!-- Left Column: 3D Booklet Showcase (Clickable Download Cover) -->
                <div class="lg:col-span-5 flex flex-col items-center justify-center" data-aos="zoom-in" data-aos-delay="100">
                    <a href="<?php echo $compro_download_url; ?>" <?php echo $compro_download_attr; ?> class="relative group cursor-pointer block" title="Unduh <?php echo esc_attr( $compro_title ); ?>" aria-label="Unduh Dokumen Company Profile">
                        <!-- Ambient Glow behind booklet -->
                        <div class="absolute -inset-2 bg-gradient-to-tr from-teal-500/20 to-primary-500/20 rounded-3xl blur-xl opacity-75 group-hover:opacity-100 transition duration-700"></div>

                        <!-- 3D Booklet Presentation Container -->
                        <div class="relative w-56 sm:w-64 md:w-72 aspect-[3/4.2] rounded-2xl overflow-hidden shadow-2xl shadow-primary-950/30 dark:shadow-black/70 border-y border-r border-slate-200/60 dark:border-slate-700/60 bg-gradient-to-br from-slate-900 via-primary-950 to-slate-950 flex flex-col justify-between text-white transform transition-transform duration-500 group-hover:-translate-y-2 group-hover:rotate-1">
                            
                            <!-- Book Spine Accent (Left Edge) -->
                            <div class="absolute left-0 top-0 bottom-0 w-3 bg-gradient-to-r from-teal-700 via-teal-500 to-teal-400 shadow-inner z-20"></div>

                            <!-- Interactive Click-to-Download Floating Badge on Hover -->
                            <div class="absolute inset-0 z-30 bg-primary-950/45 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl flex flex-col items-center justify-center p-4 text-center">
                                <div class="w-12 h-12 rounded-full bg-teal-500 text-white flex items-center justify-center shadow-lg shadow-teal-500/50 mb-2 transform group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                </div>
                                <span class="text-xs font-black uppercase tracking-wider text-white drop-shadow">Klik untuk Unduh PDF</span>
                            </div>

                            <?php if ( ! empty( $compro_cover ) ) : ?>
                                <!-- Custom Uploaded Cover Image -->
                                <img src="<?php echo esc_url( $compro_cover ); ?>" 
                                     alt="Cover Company Profile <?php echo esc_attr( $compro_year ); ?>" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                
                                <!-- Subtle Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent pointer-events-none"></div>
                                
                                <!-- Floating Edition Badge on Cover -->
                                <div class="absolute top-4 right-4 z-20">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-900/85 backdrop-blur-md text-amber-300 border border-amber-400/50 text-[10px] font-black uppercase tracking-wider shadow-lg">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span>
                                        <?php echo esc_html( $compro_year ); ?>
                                    </span>
                                </div>

                                <div class="absolute bottom-4 left-6 right-4 z-20 text-left">
                                    <span class="text-[10px] uppercase font-bold tracking-widest text-teal-300 block">Profil Resmi</span>
                                    <h4 class="text-sm sm:text-base font-extrabold text-white leading-tight">Bank Syariah Wakalumi</h4>
                                </div>
                            <?php else : ?>
                                <!-- High-End Procedural Booklet Cover -->
                                <div class="relative z-10 p-6 pl-8 h-full flex flex-col justify-between">
                                    <!-- Top: Logo & Watermark -->
                                    <div>
                                        <div class="flex items-center justify-between mb-4">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-new-1.png" alt="Wakalumi Logo" class="h-6 sm:h-7 object-contain brightness-0 invert">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-400/20 text-amber-300 border border-amber-400/40 text-[9px] font-black uppercase tracking-wider">
                                                <?php echo esc_html( $compro_year ); ?>
                                            </span>
                                        </div>
                                        <div class="w-8 h-0.5 bg-gradient-to-r from-teal-400 to-amber-400 rounded-full mb-3"></div>
                                    </div>

                                    <!-- Center: Big Typography & Emblem -->
                                    <div class="my-auto py-2">
                                        <span class="text-[10px] font-extrabold uppercase tracking-[0.25em] text-teal-300 block mb-1">DOKUMEN RESMI</span>
                                        <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight uppercase leading-snug">
                                            COMPANY<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 to-emerald-400">PROFILE</span>
                                        </h3>
                                        <p class="text-[10px] text-slate-400 tracking-wider uppercase mt-1">Bank Perekonomian Rakyat Syariah</p>
                                    </div>

                                    <!-- Bottom: Certification & Seal -->
                                    <div class="pt-3 border-t border-white/10 flex items-center justify-center text-[9px] text-slate-400">
                                        <span>Terdaftar & Diawasi Otoritas Jasa Keuangan (OJK)</span>
                                    </div>
                                </div>

                                <!-- Subtle Golden Sheen on Hover -->
                                <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/5 to-transparent pointer-events-none group-hover:via-white/10 transition-all duration-700"></div>
                            <?php endif; ?>
                        </div>
                    </a>

                    <!-- Booklet Metadata Strip -->
                    <div class="mt-5 flex flex-wrap items-center justify-center gap-2 sm:gap-3 text-xs font-semibold text-slate-500 dark:text-slate-400">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border border-slate-200/60 dark:border-slate-700/60">
                            <svg class="w-3.5 h-3.5 text-rose-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg>
                            <span><?php echo esc_html( $compro_filesize ); ?></span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-teal-50 dark:bg-teal-950/60 text-teal-700 dark:text-teal-300 border border-teal-200/60 dark:border-teal-800/60">
                            <svg class="w-3.5 h-3.5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span><?php echo esc_html( $compro_updated ); ?></span>
                        </span>
                    </div>
                </div>

                <!-- Right Column: Editorial & Actions -->
                <div class="lg:col-span-7 flex flex-col justify-between" data-aos="fade-left" data-aos-delay="200">
                    <div>
                        <!-- Kicker Badge -->
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300 border border-teal-100 dark:border-teal-800/30 mb-3">
                            <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                            <span><?php echo esc_html( $compro_badge ); ?></span>
                        </div>

                        <!-- Main Heading -->
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-snug mb-4">
                            <?php echo esc_html( $compro_title ); ?>
                        </h2>

                        <!-- Description -->
                        <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed mb-6">
                            <?php echo nl2br( esc_html( $compro_desc ) ); ?>
                        </p>

                        <!-- 4 Highlights Grid -->
                        <?php if ( ! empty( $compro_highlights ) ) : ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">
                                <?php foreach ( $compro_highlights as $hl ) : ?>
                                    <div class="flex items-start gap-2.5 p-3.5 rounded-xl bg-slate-50/90 dark:bg-slate-800/60 border border-slate-200/80 dark:border-slate-700/70 shadow-2xs hover:shadow-md hover:-translate-y-0.5 hover:border-teal-400 dark:hover:border-teal-600 transition-all duration-200 cursor-default">
                                        <div class="w-5 h-5 rounded-md bg-teal-500/15 text-teal-600 dark:text-teal-400 flex items-center justify-center shrink-0 mt-0.5">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                        <span class="text-xs sm:text-sm font-bold text-slate-800 dark:text-slate-100 leading-tight">
                                            <?php echo esc_html( $hl ); ?>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Action Buttons -->
                    <div>
                        <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                            <!-- Primary: Download Button -->
                            <a href="<?php echo $compro_download_url; ?>" 
                               <?php echo $compro_download_attr; ?>
                               class="btn-primary text-xs sm:text-sm px-7 py-3.5 rounded-xl shadow-lg shadow-teal-500/20 inline-flex items-center justify-center gap-2.5 font-bold hover:scale-[1.02] transition-transform">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                <span><?php echo esc_html( $compro_btn_dl_text ); ?></span>
                            </a>
                        </div>

                        <!-- Micro Info Guarantee -->
                        <p class="text-[11px] sm:text-xs text-slate-400 dark:text-slate-500 mt-4 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-teal-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Dokumen resmi terverifikasi format PDF. Selalu diperbarui setiap siklus tahun buku baru.</span>
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     SECTION 6: AJAKAN BERTINDAK (CALL TO ACTION)
     ======================================== -->
<?php if ( $show_cta ) : ?>
<section class="relative z-10 py-16 md:py-24 bg-white dark:bg-dark border-t border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="relative rounded-3xl p-8 sm:p-12 md:p-16 overflow-hidden bg-gradient-to-br from-primary-900 via-primary-950 to-slate-950 text-white shadow-2xl shadow-primary-900/20 border border-primary-500/30 text-center" data-aos="zoom-in">
            <!-- Background Decorative Watermark Emblem -->
            <div class="absolute right-0 bottom-0 translate-x-1/4 translate-y-1/4 w-80 h-80 opacity-[0.06] pointer-events-none">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-full h-full object-contain">
            </div>
            
            <!-- Glowing Orbs -->
            <div class="absolute -top-24 -left-24 w-72 h-72 bg-primary-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-teal-400/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-widest bg-white/10 backdrop-blur-md border border-white/20 text-teal-300 mb-6">
                    <span class="w-2 h-2 rounded-full bg-teal-400 animate-ping"></span>
                    <?php echo esc_html( $cta_badge ); ?>
                </div>

                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight mb-5">
                    <?php echo esc_html( $cta_title ); ?>
                </h2>

                <p class="text-slate-300 text-sm sm:text-base md:text-lg leading-relaxed mb-8 max-w-2xl mx-auto font-normal">
                    <?php echo esc_html( $cta_desc ); ?>
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="<?php echo esc_url( $cta_btn1_url ); ?>" 
                       target="_blank" rel="noopener noreferrer"
                       class="btn-primary text-sm sm:text-base px-8 py-4 rounded-xl shadow-lg shadow-primary-500/25 inline-flex items-center gap-2.5 font-bold hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <span><?php echo esc_html( $cta_btn1_text ); ?></span>
                    </a>
                    <a href="<?php echo esc_url( $cta_btn2_url ); ?>" 
                       class="btn-secondary text-sm sm:text-base px-8 py-4 rounded-xl border border-white/20 bg-white/10 hover:bg-white/20 text-white inline-flex items-center gap-2 font-bold backdrop-blur-sm transition-all hover:scale-105">
                        <span><?php echo esc_html( $cta_btn2_text ); ?></span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<?php
get_footer();

