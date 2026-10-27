<?php
/**
 * Template Name: Halaman Kontak & Layanan
 * Description: Portal Resmi Informasi Kontak, Saluran Customer Service WhatsApp, Email, Telepon Kantor, Media Sosial Resmi (Instagram, Facebook, LinkedIn, YouTube), serta Lokasi Peta Google Maps Bank Syariah Wakalumi.
 * 
 * @package Wakalumi
 */

get_header();

// ── DATA RETRIEVAL DARI WP_OPTIONS (100% DINAMIS) ─────────────────────

// Seksi 1: Banner Header & Pills
$page_badge  = get_option( 'options_contact_page_badge', 'Hubungi Kami' );
$page_title  = get_option( 'options_contact_page_title', 'Kanal Komunikasi & Layanan Resmi' );
$page_desc   = get_option( 'options_contact_page_desc', 'Kami siap mendengarkan, melayani, dan memberikan solusi perbankan syariah terbaik untuk Anda. Silakan hubungi kami melalui berbagai saluran resmi yang aman, terpercaya, dan profesional.' );
$jam_week    = get_option( 'options_jam_operasional_weekday', '08:00 - 15:00 WIB' );
$jam_end     = get_option( 'options_jam_operasional_weekend', 'Tutup' );
$pill_1      = get_option( 'options_contact_pill_1', 'Jam Layanan: ' . $jam_week );
$pill_2      = get_option( 'options_contact_pill_2', '100% Layanan Resmi & Bebas Pungutan' );
$pill_3      = get_option( 'options_contact_pill_3', 'Berizin & Diawasi OJK' );

// Seksi 2: Hero Section Trust Card (Dual-Tone Executive Trust Card)
$h_badge     = get_option( 'options_contact_hero_card_badge', 'Layanan Pelanggan Aktif' );
$h_company   = get_option( 'options_contact_hero_card_company', 'PT BPRS Wakalumi' );
$h_title     = get_option( 'options_contact_hero_card_title', 'Siap Melayani Kebutuhan Finansial Syariah Anda' );
$h_desc      = get_option( 'options_contact_hero_card_desc', 'Tim Customer Service dan staf operasional kami siap mendampingi pembukaan tabungan, simulasi bagi hasil deposito, hingga pengajuan pembiayaan usaha dengan amanah dan transparan.' );
$h_m1_lbl    = get_option( 'options_contact_hero_metric_1_lbl', 'Hari Kerja' );
$h_m1_val    = get_option( 'options_contact_hero_metric_1_val', 'Senin - Jumat' );
$h_m2_lbl    = get_option( 'options_contact_hero_metric_2_lbl', 'WhatsApp CS' );
$h_m2_val    = get_option( 'options_contact_hero_metric_2_val', 'Respon Cepat' );
$h_foot_text = get_option( 'options_contact_hero_footer_text', 'Butuh panduan lokasi cabang?' );
$h_foot_btn  = get_option( 'options_contact_hero_footer_btn_lbl', 'Jaringan Kantor' );
$h_foot_url  = get_option( 'options_contact_hero_footer_btn_url', '/profil/jaringan-kantor' );

// Seksi 3: 3 Saluran Komunikasi Langsung
$ch_kicker   = get_option( 'options_contact_channels_kicker', 'Saluran Komunikasi' );
$ch_title    = get_option( 'options_contact_channels_title', 'Hubungi Layanan Perbankan Syariah BSW' );
$ch_desc     = get_option( 'options_contact_channels_desc', 'Pilih kanal komunikasi resmi yang paling nyaman bagi Anda untuk berkonsultasi, mengajukan pertanyaan, atau menyampaikan aspirasi.' );

// Card 1: WhatsApp
$wa          = get_option( 'options_contact_wa', '6281517380388' );
$wa_clean    = preg_replace( '/[^0-9]/', '', (string) $wa ) ?: '6281517380388';
$wa_msg      = get_option( 'options_contact_wa_message', 'Halo CS Bank Syariah Wakalumi, saya ingin berkonsultasi mengenai produk dan layanan perbankan syariah.' );
$wa_url      = 'https://wa.me/' . $wa_clean . '?text=' . rawurlencode( $wa_msg );
$wa_title    = get_option( 'options_contact_wa_title', 'WhatsApp Customer Service' );
$wa_badge    = get_option( 'options_contact_wa_badge', 'Respon Tercepat' );
$wa_subinfo  = get_option( 'options_contact_wa_subinfo', 'Senin - Jumat: ' . $jam_week );
$wa_card_desc= get_option( 'options_contact_wa_desc', 'Layanan interaktif langsung bersama staf CS kami untuk konsultasi produk tabungan, deposito, simulasi pembiayaan, atau informasi persyaratan akad syariah.' );
$wa_btn      = get_option( 'options_contact_wa_btn_text', 'Chat WhatsApp Sekarang' );

$wa_display  = $wa_clean;
if ( strpos( $wa_display, '62' ) === 0 ) {
    $wa_display = '+62 ' . substr( $wa_display, 2, 3 ) . '-' . substr( $wa_display, 5, 4 ) . '-' . substr( $wa_display, 9 );
} elseif ( strpos( $wa_display, '0' ) === 0 ) {
    $wa_display = '+62 ' . substr( $wa_display, 1, 3 ) . '-' . substr( $wa_display, 4, 4 ) . '-' . substr( $wa_display, 8 );
}

// Card 2: Telepon (Kantor Kas Cikupa sebagai sambungan utama)
$phone       = get_option( 'options_contact_phone', '(021) 5966 2196' );
$phone_clean = preg_replace( '/[^0-9]/', '', (string) $phone );
$phone_title = get_option( 'options_contact_phone_title', 'Telepon Layanan / Kantor Operasional' );
$phone_badge = get_option( 'options_contact_phone_badge', 'Panggilan Suara' );
$phone_sub   = get_option( 'options_contact_phone_subinfo', 'Kantor Kas Cikupa (Senin - Jumat: ' . $jam_week . ')' );
$phone_desc  = get_option( 'options_contact_phone_desc', 'Sambungan telepon resmi layanan perbankan syariah (Kantor Kas Cikupa) untuk informasi rekening, konfirmasi transaksi, serta koordinasi layanan nasabah.' );
$phone_btn   = get_option( 'options_contact_phone_btn_text', 'Hubungi Telepon Kantor' );

// Card 3: Email
$email       = get_option( 'options_contact_email', 'info@bprswakalumi.co.id' );
$email_title = get_option( 'options_contact_email_title', 'Email Resmi Perseroan' );
$email_badge = get_option( 'options_contact_email_badge', 'Korespondensi Formal' );
$email_sub   = get_option( 'options_contact_email_subinfo', 'Respon Maksimal 1 x 24 Jam Kerja' );
$email_desc  = get_option( 'options_contact_email_desc', 'Saluran pengiriman surat dinas, berkas kemitraan kelembagaan, penawaran kerjasama, maupun penyampaian dokumen resmi kepada pihak manajemen bank.' );
$email_btn   = get_option( 'options_contact_email_btn_text', 'Kirim Pesan Email' );

// Seksi 4: Media Sosial (Full CRUD Dinamis)
$soc_kicker  = get_option( 'options_contact_social_kicker', 'Jejaring Komunitas' );
$soc_title   = get_option( 'options_contact_social_title', 'Media Sosial Resmi Bank Syariah Wakalumi' );
$soc_desc    = get_option( 'options_contact_social_desc', 'Ikuti akun resmi kami untuk memperoleh update warta perbankan, edukasi fikih muamalah, informasi produk, dan kegiatan CSR perseroan.' );
$social_list = function_exists( 'wakalumi_get_social_media_list' ) ? wakalumi_get_social_media_list() : [];
$active_socials = array_values( array_filter( $social_list, function( $item ) {
    return ( ( $item['status'] ?? 'aktif' ) === 'aktif' ) && ! empty( $item['url'] );
}) );

// Seksi 5: Kantor Pusat & Maps
$off_kicker  = get_option( 'options_contact_office_kicker', 'Lokasi Kantor' );
$off_title   = get_option( 'options_contact_office_title', 'Kantor Pusat Operasional & Peta Navigasi' );
$off_desc    = get_option( 'options_contact_office_desc', 'Kunjungi kantor kami untuk layanan tatap muka langsung, verifikasi berkas, atau konsultasi pembiayaan usaha bersama tim perbankan syariah.' );
$off_badge   = get_option( 'options_contact_office_badge', 'Head Office' );
$off_status  = get_option( 'options_contact_office_status', 'Beroperasi Normal' );
$off_name    = get_option( 'options_contact_office_name', 'PT BPRS Wakalumi' );
$address     = get_option( 'options_contact_address', "Ruko Ciputat Center Blok B-3\nJl. Ir. H. Juanda No. 21, Rempoa\nCiputat Timur, Tangerang Selatan 15412" );
$svc_1       = get_option( 'options_contact_office_svc_1', 'Pembukaan Rekening Tabungan & Deposito Mudharabah' );
$svc_2       = get_option( 'options_contact_office_svc_2', 'Konsultasi & Pengajuan Pembiayaan Usaha / UMKM' );
$svc_3       = get_option( 'options_contact_office_svc_3', 'Transaksi Setoran & Penarikan Tunai Kas' );
$svc_4       = get_option( 'options_contact_office_svc_4', 'Layanan Pengaduan Konsumen & Customer Care' );
$maps_embed  = get_option( 'options_maps_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.778980156602!2d106.76267921184164!3d-6.292752361567173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3aa7230643f%3A0xe76da8f0b25c55b0!2sBPR%20Syariah%20Wakalumi.%20PT!5e0!3m2!1sen!2sid!4v1792290594792!5m2!1sen!2sid' );
$maps_title  = get_option( 'options_footer_maps_title', 'Lokasi Kantor Pusat Operasional' );
$gmaps_app_url = get_option( 'options_contact_gmaps_app_url', 'https://maps.google.com/?q=BPR+Syariah+Wakalumi+Ciputat' );

// Seksi 6: Himbauan Keamanan Bertransaksi (Anti-Fraud)
$fraud_show  = get_option( 'options_contact_fraud_show', '1' );
$fraud_badge = get_option( 'options_contact_fraud_badge', 'Keamanan & Kepatuhan' );
$fraud_sub   = get_option( 'options_contact_fraud_subtitle', 'Waspada Modus Penipuan' );
$fraud_title = get_option( 'options_contact_fraud_title', 'Himbauan Keamanan Bertransaksi Bagi Nasabah' );
$fraud_desc  = get_option( 'options_contact_fraud_desc', 'Untuk kenyamanan dan keselamatan finansial Anda, mohon perhatikan pedoman keamanan resmi Bank Syariah Wakalumi:' );
$fraud_p1_t  = get_option( 'options_contact_fraud_p1_title', '1. Jaga Kerahasiaan Data' );
$fraud_p1_d  = get_option( 'options_contact_fraud_p1_desc', 'Petugas bank TIDAK PERNAH meminta nomor PIN, password, maupun kode OTP transaksi Anda.' );
$fraud_p2_t  = get_option( 'options_contact_fraud_p2_title', '2. Rekening Resmi Perseroan' );
$fraud_p2_d  = get_option( 'options_contact_fraud_p2_desc', 'Pembayaran pembiayaan HANYA melalui rekening resmi atas nama PT BPRS Wakalumi, bukan rekening pribadi.' );
$fraud_p3_t  = get_option( 'options_contact_fraud_p3_title', '3. Saluran Komunikasi Sah' );
$fraud_p3_d  = get_option( 'options_contact_fraud_p3_desc', 'Pastikan nomor dan akun resmi yang menghubungi Anda sama persis dengan yang tercantum pada halaman ini.' );

// Seksi 7: CTA Banner Bawah Halaman
$cta_badge   = get_option( 'options_contact_cta_badge', 'Konsultasi Perbankan Syariah' );
$cta_title   = get_option( 'options_contact_cta_title', 'Siap Memulai Perjalanan Finansial Berkah Bersama BSW?' );
$cta_desc    = get_option( 'options_contact_cta_desc', 'Hubungi tim customer service kami sekarang atau jelajahi berbagai produk tabungan, deposito, dan pembiayaan syariah yang dirancang untuk kemaslahatan Anda.' );
$cta_btn1_t  = get_option( 'options_contact_cta_btn1_text', 'Hubungi via WhatsApp' );
$cta_btn1_u  = get_option( 'options_contact_cta_btn1_url', '' );
$cta_btn1_target = ! empty( $cta_btn1_u ) ? esc_url( $cta_btn1_u ) : $wa_url;
$cta_btn2_t  = get_option( 'options_contact_cta_btn2_text', 'Jelajahi Produk Syariah' );
$cta_btn2_u  = get_option( 'options_contact_cta_btn2_url', '/produk/tabungan-syariah' );
?>

<div class="min-h-screen bg-transparent text-slate-800 dark:text-slate-200 pb-20 md:pb-24">

    <!-- ========================================================================
         SECTION 1: HERO HEADER BANNER & DUAL-TONE EXECUTIVE TRUST CARD
         ======================================================================== -->
    <section class="wkl-page-hero relative z-10 overflow-hidden shadow-xs border-b border-slate-200/60 dark:border-slate-800/60 pb-12 sm:pb-16 pt-6 sm:pt-8">
        <!-- Ambient Background Glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-80 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

        <div class="container-wide relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-300 transition-colors flex items-center gap-1.5 font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <span class="text-teal-600 dark:text-teal-400 font-semibold">Kontak Kami</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <!-- Left Column: Title & Narrative -->
                <div class="lg:col-span-7 xl:col-span-7" data-aos="fade-up">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-50 dark:bg-teal-950/70 border border-teal-200/80 dark:border-teal-700/60 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                        <?php echo esc_html( $page_badge ); ?>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                        <?php echo esc_html( $page_title ); ?>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl font-normal">
                        <?php echo esc_html( $page_desc ); ?>
                    </p>

                    <!-- Trust Highlights Pills (100% Dinamis) -->
                    <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                        <?php if ( ! empty( $pill_1 ) ) : ?>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white dark:bg-slate-900/90 border border-slate-200/90 dark:border-slate-800 shadow-2xs font-medium">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span><?php echo esc_html( $pill_1 ); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $pill_2 ) ) : ?>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white dark:bg-slate-900/90 border border-slate-200/90 dark:border-slate-800 shadow-2xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                            <span><?php echo esc_html( $pill_2 ); ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $pill_3 ) ) : ?>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white dark:bg-slate-900/90 border border-slate-200/90 dark:border-slate-800 shadow-2xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span><?php echo esc_html( $pill_3 ); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Right Column: Dual-Tone Executive Trust Card (Solid & Tenang, Bebas Efek Goyang) -->
                <div class="lg:col-span-5 xl:col-span-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="spotlight-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-md hover:border-teal-500/40 dark:hover:border-teal-500/40 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between cursor-default">
                        <!-- Top Accent Line -->
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 to-emerald-500 opacity-80"></div>

                        <!-- Tone 1: Zona Atas (Header & Identitas) -->
                        <div class="p-6 sm:p-7 bg-slate-50/90 dark:bg-slate-800/60 border-b border-slate-100 dark:border-slate-800/80 relative overflow-hidden">
                            <!-- Watermark Tenang di Sudut Kanan Bawah -->
                            <div class="absolute -right-4 -bottom-4 w-32 h-32 opacity-[0.035] dark:opacity-[0.025] pointer-events-none transition-all duration-500 ease-out group-hover:scale-105 group-hover:opacity-[0.06] select-none overflow-hidden">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                            </div>

                            <div class="relative z-10 space-y-3.5">
                                <div class="flex items-center gap-3">
                                    <!-- Dual-Tone Ring Icon Box (Hover Membesar Halus) -->
                                    <div class="w-11 h-11 rounded-xl bg-teal-50 dark:bg-teal-950/70 border border-teal-200/90 dark:border-teal-800/80 text-teal-700 dark:text-teal-300 flex items-center justify-center shadow-2xs group-hover:scale-105 group-hover:bg-teal-600 group-hover:text-white group-hover:border-teal-600 transition-all duration-300 shrink-0">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-teal-100/80 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border border-teal-200/90 dark:border-teal-800/80 shadow-2xs mb-0.5">
                                            <?php echo esc_html( $h_badge ); ?>
                                        </span>
                                        <span class="block text-xs font-bold text-slate-700 dark:text-slate-300 tracking-wide truncate">
                                            <?php echo esc_html( $h_company ); ?>
                                        </span>
                                    </div>
                                </div>

                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white leading-snug">
                                    <?php echo esc_html( $h_title ); ?>
                                </h3>
                            </div>
                        </div>

                        <!-- Tone 2: Zona Bawah (Deskripsi & Mini Metrics) -->
                        <div class="p-6 sm:p-7 space-y-4 bg-white dark:bg-slate-900/95 flex-1 flex flex-col justify-between">
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                                <?php echo esc_html( $h_desc ); ?>
                            </p>

                            <!-- Mini Metrics Inside Card -->
                            <div class="grid grid-cols-2 gap-3 pt-1">
                                <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800">
                                    <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400"><?php echo esc_html( $h_m1_lbl ); ?></span>
                                    <span class="block text-xs sm:text-sm font-extrabold text-teal-700 dark:text-teal-300 mt-0.5">
                                        <?php echo esc_html( $h_m1_val ); ?>
                                    </span>
                                </div>
                                <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-800">
                                    <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400"><?php echo esc_html( $h_m2_lbl ); ?></span>
                                    <span class="block text-xs sm:text-sm font-extrabold text-emerald-600 dark:text-emerald-400 mt-0.5">
                                        <?php echo esc_html( $h_m2_val ); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-3 text-xs">
                                <span class="text-slate-500 dark:text-slate-400 font-medium">
                                    <?php echo esc_html( $h_foot_text ); ?>
                                </span>
                                <a href="<?php echo esc_url( home_url( $h_foot_url ) ); ?>" class="inline-flex items-center gap-1.5 text-teal-700 dark:text-teal-300 font-extrabold hover:underline">
                                    <span><?php echo esc_html( $h_foot_btn ); ?></span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 2: 3 KARTU SALURAN KOMUNIKASI (DUAL-TONE & JUDUL DI SAMPING IKON)
         ======================================================================== -->
    <section class="section py-16 sm:py-20 relative z-10 bg-slate-50/50 dark:bg-dark-surface/30 border-b border-slate-200/60 dark:border-slate-800/60">
        <div class="container-wide">
            <!-- Header Seksi -->
            <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-200 dark:border-teal-800 mb-3 shadow-2xs">
                    <?php echo esc_html( $ch_kicker ); ?>
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    <?php echo esc_html( $ch_title ); ?>
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                    <?php echo esc_html( $ch_desc ); ?>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                
                <!-- CARD 1: WHATSAPP CS (KARAKTERISTIK EMERALD / HIJAU SYARIAH) -->
                <div class="spotlight-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-md hover:border-emerald-500/50 dark:hover:border-emerald-500/50 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between cursor-default"
                     data-aos="fade-up" data-aos-delay="0">
                    <!-- Top Accent Line Senada WhatsApp -->
                    <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-emerald-500 via-teal-500 to-emerald-400 opacity-90"></div>

                    <!-- Tone 1: Header Bar dengan Ikon di Kiri & Judul Berdampingan -->
                    <div class="p-5 sm:p-6 bg-slate-50/90 dark:bg-slate-800/60 border-b border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-start gap-3.5">
                            <!-- Icon Box (Hover Membesar Halus) -->
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/70 border border-emerald-200/90 dark:border-emerald-800/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-600 transition-all duration-300">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </div>
                            <!-- Judul & Status di Samping Ikon -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2 mb-1">
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                        Kanal Resmi
                                    </span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-emerald-50 dark:bg-emerald-950/70 text-emerald-700 dark:text-emerald-300 border border-emerald-200/80 dark:border-emerald-800 shrink-0">
                                        <?php echo esc_html( $wa_badge ); ?>
                                    </span>
                                </div>
                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white leading-snug group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                    <?php echo esc_html( $wa_title ); ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!-- Tone 2: Body Card -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-white dark:bg-slate-900/95">
                        <div class="space-y-3.5">
                            <div class="p-3.5 rounded-xl bg-emerald-50/60 dark:bg-emerald-950/30 border border-emerald-100 dark:border-emerald-900/40">
                                <span class="text-base sm:text-lg font-mono font-bold text-emerald-800 dark:text-emerald-200 block tracking-tight">
                                    <?php echo esc_html( $wa_display ); ?>
                                </span>
                                <span class="text-xs text-slate-500 dark:text-slate-400 block mt-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span><?php echo esc_html( $wa_subinfo ); ?></span>
                                </span>
                            </div>

                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                                <?php echo esc_html( $wa_card_desc ); ?>
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                            <a href="<?php echo esc_url( $wa_url ); ?>" 
                               target="_blank" rel="noopener noreferrer"
                               class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs sm:text-sm shadow-sm hover:shadow-md hover:shadow-emerald-600/20 transition-all duration-300">
                                <span><?php echo esc_html( $wa_btn ); ?></span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: TELEPON KANTOR OPERASIONAL (KARAKTERISTIK CORPORATE BLUE) -->
                <div class="spotlight-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-md hover:border-blue-500/50 dark:hover:border-blue-500/50 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between cursor-default"
                     data-aos="fade-up" data-aos-delay="100">
                    <!-- Top Accent Line Senada Telepon -->
                    <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-blue-500 via-sky-500 to-cyan-400 opacity-90"></div>

                    <!-- Tone 1: Header Bar dengan Ikon di Kiri & Judul Berdampingan -->
                    <div class="p-5 sm:p-6 bg-slate-50/90 dark:bg-slate-800/60 border-b border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-start gap-3.5">
                            <!-- Icon Box (Hover Membesar Halus) -->
                            <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-950/70 border border-blue-200/90 dark:border-blue-800/80 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition-all duration-300">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                                </svg>
                            </div>
                            <!-- Judul & Status di Samping Ikon -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2 mb-1">
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                        Kanal Resmi
                                    </span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-blue-50 dark:bg-blue-950/70 text-blue-700 dark:text-blue-300 border border-blue-200/80 dark:border-blue-800 shrink-0">
                                        <?php echo esc_html( $phone_badge ); ?>
                                    </span>
                                </div>
                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    <?php echo esc_html( $phone_title ); ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!-- Tone 2: Body Card -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-white dark:bg-slate-900/95">
                        <div class="space-y-3.5">
                            <div class="p-3.5 rounded-xl bg-blue-50/60 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900/40">
                                <span class="text-base sm:text-lg font-mono font-bold text-blue-900 dark:text-blue-200 block tracking-tight">
                                    <?php echo esc_html( $phone ); ?>
                                </span>
                                <span class="text-xs text-slate-500 dark:text-slate-400 block mt-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span><?php echo esc_html( $phone_sub ); ?></span>
                                </span>
                            </div>

                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                                <?php echo esc_html( $phone_desc ); ?>
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                            <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" 
                               class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs sm:text-sm shadow-sm hover:shadow-md hover:shadow-blue-600/20 transition-all duration-300">
                                <span><?php echo esc_html( $phone_btn ); ?></span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: EMAIL RESMI (KARAKTERISTIK FORMAL INDIGO) -->
                <div class="spotlight-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-md hover:border-indigo-500/50 dark:hover:border-indigo-500/50 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between cursor-default"
                     data-aos="fade-up" data-aos-delay="200">
                    <!-- Top Accent Line Senada Email -->
                    <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-400 opacity-90"></div>

                    <!-- Tone 1: Header Bar dengan Ikon di Kiri & Judul Berdampingan -->
                    <div class="p-5 sm:p-6 bg-slate-50/90 dark:bg-slate-800/60 border-b border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-start gap-3.5">
                            <!-- Icon Box (Hover Membesar Halus) -->
                            <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/70 border border-indigo-200/90 dark:border-indigo-800/80 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-indigo-600 group-hover:text-white group-hover:border-indigo-600 transition-all duration-300">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </div>
                            <!-- Judul & Status di Samping Ikon -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-2 mb-1">
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                        Kanal Resmi
                                    </span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-indigo-50 dark:bg-indigo-950/70 text-indigo-700 dark:text-indigo-300 border border-indigo-200/80 dark:border-indigo-800 shrink-0">
                                        <?php echo esc_html( $email_badge ); ?>
                                    </span>
                                </div>
                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white leading-snug group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                    <?php echo esc_html( $email_title ); ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!-- Tone 2: Body Card -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-white dark:bg-slate-900/95">
                        <div class="space-y-3.5">
                            <div class="p-3.5 rounded-xl bg-indigo-50/60 dark:bg-indigo-950/30 border border-indigo-100 dark:border-indigo-900/40">
                                <span class="text-base sm:text-lg font-mono font-bold text-indigo-900 dark:text-indigo-200 block truncate tracking-tight">
                                    <?php echo esc_html( $email ); ?>
                                </span>
                                <span class="text-xs text-slate-500 dark:text-slate-400 block mt-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-indigo-600 dark:text-indigo-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span><?php echo esc_html( $email_sub ); ?></span>
                                </span>
                            </div>

                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                                <?php echo esc_html( $email_desc ); ?>
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" 
                                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs sm:text-sm shadow-sm hover:shadow-md hover:shadow-indigo-600/20 transition-all duration-300">
                                <span><?php echo esc_html( $email_btn ); ?></span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 3: MEDIA SOSIAL RESMI PERSEROAN (SOCIAL MEDIA HUB - FULL CRUD)
         ======================================================================== -->
    <?php if ( ! empty( $active_socials ) ) : 
        $soc_count  = count( $active_socials );
        $grid_class = ( $soc_count <= 2 ) 
            ? 'grid grid-cols-1 sm:grid-cols-2 max-w-3xl mx-auto gap-6 sm:gap-8' 
            : ( ( $soc_count === 3 ) 
                ? 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 max-w-5xl mx-auto gap-6 sm:gap-8' 
                : 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-6' );
    ?>
    <section class="section py-16 sm:py-20 relative z-10 bg-white dark:bg-dark border-b border-slate-200/60 dark:border-slate-800/60">
        <div class="container-wide">
            
            <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-200 dark:border-teal-800 mb-3 shadow-2xs">
                    <?php echo esc_html( $soc_kicker ); ?>
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    <?php echo esc_html( $soc_title ); ?>
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                    <?php echo esc_html( $soc_desc ); ?>
                </p>
            </div>

            <div class="<?php echo esc_attr( $grid_class ); ?>">
                <?php 
                foreach ( $active_socials as $s_idx => $soc ) : 
                    $p_key        = esc_attr( $soc['platform'] ?? 'custom' );
                    $color_theme  = esc_attr( $soc['color_theme'] ?? 'auto' );
                    $p_config     = function_exists( 'wakalumi_get_social_platform_config' ) ? wakalumi_get_social_platform_config( $p_key, $color_theme ) : [];
                    $title        = ! empty( $soc['title'] ) ? $soc['title'] : ( $p_config['name'] ?? 'Media Sosial' );
                    $nama         = ! empty( $soc['nama_akun'] ) ? $soc['nama_akun'] : $title;
                    $subtitle     = ! empty( $soc['subtitle'] ) ? $soc['subtitle'] : 'Kanal Resmi Perseroan';
                    $desc         = ! empty( $soc['desc'] ) ? $soc['desc'] : 'Kunjungi kanal resmi kami untuk informasi terkini seputar Bank Syariah Wakalumi.';
                    $url          = esc_url( $soc['url'] );
                    $btn_text     = ! empty( $soc['btn_text'] ) ? $soc['btn_text'] : ( 'Kunjungi ' . $title );
                    $icon_svg     = $p_config['svg'] ?? '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>';
                    $accent_bar   = $p_config['accent_bar'] ?? 'bg-gradient-to-r from-teal-500 to-emerald-400';
                    $icon_box     = $p_config['icon_box'] ?? 'bg-teal-600 text-white shadow-md shadow-teal-500/25 border-0';
                    $badge_class  = $p_config['badge_class'] ?? 'bg-teal-50 dark:bg-teal-950/70 text-teal-700 dark:text-teal-300 border-teal-200/80';
                    $hover_border = $p_config['hover_border'] ?? 'hover:border-teal-500/50';
                    $title_hover  = $p_config['title_hover'] ?? 'group-hover:text-teal-600 dark:group-hover:text-teal-400';
                    $dot_color    = $p_config['dot_color'] ?? 'bg-teal-500';
                    $btn_class    = $p_config['btn_class'] ?? 'text-teal-700 dark:text-teal-300 hover:text-teal-800 dark:hover:text-teal-200 hover:bg-teal-50/70';
                ?>
                    <div class="spotlight-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-md <?php echo esc_attr( $hover_border ); ?> hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between cursor-default"
                         data-aos="fade-up" data-aos-delay="<?php echo min( $s_idx * 80, 240 ); ?>">
                        <!-- Top Accent Line Senada Platform -->
                        <div class="absolute top-0 inset-x-0 h-1.5 <?php echo esc_attr( $accent_bar ); ?> opacity-90"></div>

                        <!-- Header Bar -->
                        <div class="p-5 bg-slate-50/90 dark:bg-slate-800/60 border-b border-slate-100 dark:border-slate-800/80 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-xl <?php echo esc_attr( $icon_box ); ?> flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform duration-300">
                                    <?php echo $icon_svg; ?>
                                </div>
                                <div>
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400 block">
                                        Platform
                                    </span>
                                    <h4 class="text-sm font-extrabold text-slate-900 dark:text-white <?php echo esc_attr( $title_hover ); ?> transition-colors">
                                        <?php echo esc_html( $title ); ?>
                                    </h4>
                                </div>
                            </div>
                            <span class="w-2.5 h-2.5 rounded-full <?php echo esc_attr( $dot_color ); ?> shadow-xs group-hover:scale-125 transition-transform duration-300"></span>
                        </div>

                        <!-- Body Card -->
                        <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between space-y-4 bg-white dark:bg-slate-900/95">
                            <div>
                                <h5 class="text-base font-extrabold text-slate-900 dark:text-white mb-0.5 truncate" title="<?php echo esc_attr( $nama ); ?>">
                                    <?php echo esc_html( $nama ); ?>
                                </h5>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 truncate">
                                    <?php echo esc_html( $subtitle ); ?>
                                </p>
                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                                    <?php echo esc_html( $desc ); ?>
                                </p>
                            </div>

                            <a href="<?php echo $url; ?>" 
                               target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center justify-between w-full px-3.5 py-2.5 rounded-xl text-xs font-extrabold <?php echo esc_attr( $btn_class ); ?> pt-2.5 border-t border-slate-100 dark:border-slate-800/80 transition-all duration-200 group/btn">
                                <span class="truncate pr-2"><?php echo esc_html( $btn_text ); ?></span>
                                <svg class="w-4 h-4 flex-shrink-0 transform group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ========================================================================
         SECTION 4: KANTOR PUSAT & PETA LOKASI GOOGLE MAPS
         ======================================================================== -->
    <section class="section py-16 sm:py-20 relative z-10 bg-slate-50/50 dark:bg-dark-surface/30 border-b border-slate-200/60 dark:border-slate-800/60">
        <div class="container-wide">
            
            <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-200 dark:border-teal-800 mb-3 shadow-2xs">
                    <?php echo esc_html( $off_kicker ); ?>
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    <?php echo esc_html( $off_title ); ?>
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                    <?php echo esc_html( $off_desc ); ?>
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                
                <!-- Left Column: Kantor Detail Box (5 cols) -->
                <div class="lg:col-span-5 flex flex-col justify-between" data-aos="fade-up">
                    <div class="group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-md transition-all duration-300 h-full flex flex-col justify-between">
                        <!-- Top Accent Line -->
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 to-emerald-500 opacity-80"></div>

                        <!-- Header Bar -->
                        <div class="p-6 bg-slate-50/90 dark:bg-slate-800/60 border-b border-slate-100 dark:border-slate-800/80 flex items-center justify-between gap-3">
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-teal-100/80 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border border-teal-200/80 dark:border-teal-800">
                                <?php echo esc_html( $off_badge ); ?>
                            </span>
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <?php echo esc_html( $off_status ); ?>
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 sm:p-7 flex-1 flex flex-col justify-between space-y-6">
                            <div class="space-y-5">
                                <div>
                                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white leading-tight mb-2">
                                        <?php echo esc_html( $off_name ); ?>
                                    </h3>
                                    <div class="flex items-start gap-2.5 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span class="whitespace-pre-line font-normal"><?php echo esc_html( $address ); ?></span>
                                    </div>
                                </div>

                                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 space-y-2">
                                    <div class="flex items-center justify-between text-xs sm:text-sm">
                                        <span class="text-slate-500 dark:text-slate-400">Hari Operasional:</span>
                                        <span class="font-bold text-slate-900 dark:text-white">Senin - Jumat</span>
                                    </div>
                                    <div class="flex items-center justify-between text-xs sm:text-sm">
                                        <span class="text-slate-500 dark:text-slate-400">Jam Layanan Kas &amp; CS:</span>
                                        <span class="font-bold text-teal-700 dark:text-teal-300"><?php echo esc_html( $jam_week ); ?></span>
                                    </div>
                                    <div class="flex items-center justify-between text-xs sm:text-sm">
                                        <span class="text-slate-500 dark:text-slate-400">Sabtu &amp; Minggu:</span>
                                        <span class="font-semibold text-rose-500"><?php echo esc_html( $jam_end ); ?> (Libur)</span>
                                    </div>
                                </div>

                                <div class="space-y-2 text-xs sm:text-sm">
                                    <h5 class="font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider text-[11px]">
                                        Layanan yang Tersedia:
                                    </h5>
                                    <ul class="space-y-1.5 text-slate-600 dark:text-slate-300">
                                        <?php if ( ! empty( $svc_1 ) ) : ?>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500 shrink-0"></span>
                                            <span><?php echo esc_html( $svc_1 ); ?></span>
                                        </li>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $svc_2 ) ) : ?>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500 shrink-0"></span>
                                            <span><?php echo esc_html( $svc_2 ); ?></span>
                                        </li>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $svc_3 ) ) : ?>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500 shrink-0"></span>
                                            <span><?php echo esc_html( $svc_3 ); ?></span>
                                        </li>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $svc_4 ) ) : ?>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500 shrink-0"></span>
                                            <span><?php echo esc_html( $svc_4 ); ?></span>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                                <a href="<?php echo esc_url( home_url( '/profil/jaringan-kantor' ) ); ?>" 
                                   class="inline-flex items-center gap-2 text-xs sm:text-sm font-extrabold text-teal-700 dark:text-teal-300 hover:text-teal-800 dark:hover:text-teal-200">
                                    <span>Lihat Jaringan Kantor Kas &amp; Cabang Lainnya</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Right Column: Interactive Google Maps Iframe (7 cols) -->
                <div class="lg:col-span-7" data-aos="fade-up" data-aos-delay="100">
                    <div class="group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-md transition-all duration-300 h-full min-h-[420px] flex flex-col justify-between">
                        <!-- Top Accent Line -->
                        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 to-emerald-500 opacity-80 z-10"></div>

                        <!-- Iframe Container -->
                        <div class="w-full flex-1 min-h-[350px]">
                            <iframe src="<?php echo esc_url( $maps_embed ); ?>" 
                                    width="100%" 
                                    height="100%" 
                                    style="border:0; min-height: 350px;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="<?php echo esc_attr( $maps_title ); ?>"
                                    class="w-full h-full">
                            </iframe>
                        </div>

                        <!-- Map Floating Action Bar -->
                        <div class="p-4 sm:p-5 bg-slate-50/90 dark:bg-slate-800/80 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-700 dark:text-slate-300">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span>Peta Google Maps Terverifikasi</span>
                            </div>
                            <a href="<?php echo esc_url( $gmaps_app_url ); ?>" 
                               target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs shadow-sm transition-all duration-300">
                                <span>Buka Navigasi di Google Maps</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 5: HIMBAUAN KEAMANAN & PENCEGAHAN PENIPUAN (ANTI-FRAUD - SANITASI EMOJI)
         ======================================================================== -->
    <?php if ( $fraud_show === '1' ) : ?>
    <section class="section py-14 md:py-16 relative z-10 bg-white dark:bg-dark border-b border-slate-200/60 dark:border-slate-800/60">
        <div class="container-narrow mx-auto" data-aos="fade-up">
            <div class="group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/90 dark:border-slate-800 p-6 sm:p-8 shadow-sm space-y-4">
                <!-- Top Accent Line -->
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 to-emerald-500 opacity-80"></div>

                <div class="flex items-center gap-2.5">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider bg-teal-50 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-200 dark:border-teal-800">
                        <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                        <span><?php echo esc_html( $fraud_badge ); ?></span>
                    </span>
                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400">
                        <?php echo esc_html( $fraud_sub ); ?>
                    </span>
                </div>

                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white leading-snug">
                    <?php echo esc_html( $fraud_title ); ?>
                </h3>

                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                    <?php echo esc_html( $fraud_desc ); ?>
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2">
                    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <h5 class="text-xs font-bold text-slate-900 dark:text-white mb-1"><?php echo esc_html( $fraud_p1_t ); ?></h5>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed">
                            <?php echo esc_html( $fraud_p1_d ); ?>
                        </p>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <h5 class="text-xs font-bold text-slate-900 dark:text-white mb-1"><?php echo esc_html( $fraud_p2_t ); ?></h5>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed">
                            <?php echo esc_html( $fraud_p2_d ); ?>
                        </p>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800">
                        <h5 class="text-xs font-bold text-slate-900 dark:text-white mb-1"><?php echo esc_html( $fraud_p3_t ); ?></h5>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed">
                            <?php echo esc_html( $fraud_p3_d ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ========================================================================
         SECTION 6: CENTERED CTA BANNER (100% DINAMIS WP-ADMIN)
         ======================================================================== -->
    <section class="section py-16 sm:py-20 relative z-10">
        <div class="container-narrow mx-auto text-center" data-aos="fade-up">
            <div class="relative rounded-2xl md:rounded-3xl p-8 sm:p-12 md:p-14 bg-gradient-to-br from-slate-900 via-slate-900 to-teal-950 text-center space-y-6 overflow-hidden border border-slate-800/80 shadow-xl">
                <!-- Glass Shine -->
                <div class="wkl-glass-shine"></div>

                <!-- Ambient Glow & Watermark Emblem Center -->
                <div class="absolute -top-24 -left-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 opacity-[0.035] pointer-events-none select-none">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 invert">
                </div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-500/15 border border-teal-400/25 text-teal-300 text-xs font-bold uppercase tracking-wider shadow-2xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-400 animate-ping"></span>
                        <?php echo esc_html( $cta_badge ); ?>
                    </div>

                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight">
                        <?php echo esc_html( $cta_title ); ?>
                    </h2>

                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed font-normal">
                        <?php echo esc_html( $cta_desc ); ?>
                    </p>

                    <!-- Dual Centered Buttons -->
                    <div class="pt-4 flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                        <a href="<?php echo $cta_btn1_target; ?>" 
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold text-sm shadow-md hover:scale-105 transition-all duration-300">
                            <svg class="w-4 h-4 text-slate-950" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <span><?php echo esc_html( $cta_btn1_t ); ?></span>
                        </a>

                        <a href="<?php echo esc_url( home_url( $cta_btn2_u ) ); ?>" 
                           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-white font-bold text-sm border border-white/20 backdrop-blur-md hover:scale-105 transition-all duration-300">
                            <span><?php echo esc_html( $cta_btn2_t ); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>