<?php
/**
 * Template Name: Halaman Kontak & Layanan
 * Description: Portal Resmi Informasi Kontak, Saluran Customer Service WhatsApp, Email, Telepon Kantor, Media Sosial Resmi (Instagram, Facebook, LinkedIn, YouTube), serta Lokasi Peta Google Maps Bank Syariah Wakalumi.
 * 
 * @package Wakalumi
 */

get_header();

// ── DATA RETRIEVAL DARI WP_OPTIONS ──────────────────────────────────
$page_badge = get_option( 'options_contact_page_badge', 'Hubungi Kami' );
$page_title = get_option( 'options_contact_page_title', 'Kanal Komunikasi & Layanan Resmi' );
$page_desc  = get_option( 'options_contact_page_desc', 'Kami siap mendengarkan, melayani, dan memberikan solusi perbankan syariah terbaik untuk Anda. Silakan hubungi kami melalui berbagai saluran resmi yang aman, terpercaya, dan profesional.' );

// Kontak Utama
$phone      = get_option( 'options_contact_phone', '(021) 7401667 - 7490874' );
$phone_clean= preg_replace( '/[^0-9]/', '', (string) $phone );
$email      = get_option( 'options_contact_email', 'info@bprswakalumi.co.id' );
$address    = get_option( 'options_contact_address', "Ruko Ciputat Center Blok B-3\nJl. Ir. H. Juanda No. 21, Rempoa\nCiputat Timur, Tangerang Selatan 15412" );
$wa         = get_option( 'options_contact_wa', '6281517380388' );
$wa_clean   = preg_replace( '/[^0-9]/', '', (string) $wa ) ?: '6281517380388';
$wa_msg     = get_option( 'options_contact_wa_message', 'Halo CS Bank Syariah Wakalumi, saya ingin berkonsultasi mengenai produk dan layanan perbankan syariah.' );
$wa_url     = 'https://wa.me/' . $wa_clean . '?text=' . rawurlencode( $wa_msg );

// Format nomor WhatsApp untuk tampilan estetis
$wa_display = $wa_clean;
if ( strpos( $wa_display, '62' ) === 0 ) {
    $wa_display = '+62 ' . substr( $wa_display, 2, 3 ) . '-' . substr( $wa_display, 5, 4 ) . '-' . substr( $wa_display, 9 );
} elseif ( strpos( $wa_display, '0' ) === 0 ) {
    $wa_display = '+62 ' . substr( $wa_display, 1, 3 ) . '-' . substr( $wa_display, 4, 4 ) . '-' . substr( $wa_display, 8 );
}

// Jam Operasional
$jam_week   = get_option( 'options_jam_operasional_weekday', '08:00 - 15:00 WIB' );
$jam_end    = get_option( 'options_jam_operasional_weekend', 'Tutup' );

// Media Sosial
$social_ig  = get_option( 'options_social_instagram', 'https://www.instagram.com/bprswakalumi' );
$social_fb  = get_option( 'options_social_facebook', 'https://facebook.com/bprswakalumi' );
$social_li  = get_option( 'options_social_linkedin', 'https://linkedin.com/company/bprswakalumi' );
$social_yt  = get_option( 'options_social_youtube', 'https://www.youtube.com/@bprswakalumi' );

// Maps Embed
$maps_embed = get_option( 'options_maps_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.778980156602!2d106.76267921184164!3d-6.292752361567173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3aa7230643f%3A0xe76da8f0b25c55b0!2sBPR%20Syariah%20Wakalumi.%20PT!5e0!3m2!1sen!2sid!4v1792290594792!5m2!1sen!2sid' );
$maps_title = get_option( 'options_footer_maps_title', 'Lokasi Kantor Pusat Operasional' );
$gmaps_app_url = 'https://maps.google.com/?q=BPR+Syariah+Wakalumi+Ciputat';
?>

<div class="min-h-screen bg-transparent text-slate-800 dark:text-dark-text pb-24">

    <!-- ========================================================================
         SECTION 1: HERO HEADER BANNER & IDENTITAS KONTAK
         ======================================================================== -->
    <section class="relative z-10 pt-8 sm:pt-10 pb-12 sm:pb-16 overflow-hidden bg-slate-50/70 dark:bg-dark-surface/50 border-b border-slate-200/80 dark:border-dark-border/80 shadow-xs">
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
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/90 dark:bg-teal-950/70 border border-teal-300/80 dark:border-teal-700/60 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        <?php echo esc_html( $page_badge ); ?>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                        <?php echo esc_html( $page_title ); ?>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl">
                        <?php echo esc_html( $page_desc ); ?>
                    </p>

                    <!-- Trust Highlights Pills -->
                    <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Jam Layanan: <?php echo esc_html( $jam_week ); ?></span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                            <span>100% Layanan Resmi &amp; Bebas Pungutan</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span>Berizin &amp; Diawasi OJK</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Quick Status Card -->
                <div class="lg:col-span-5 xl:col-span-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-[1.5px] rounded-3xl bg-gradient-to-br from-teal-400 via-emerald-400 to-cyan-500 shadow-xl shadow-teal-500/10 group">
                        <div class="relative rounded-[22px] p-6 sm:p-7 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl overflow-hidden">
                            <!-- Glass Shine Glint -->
                            <div class="wkl-glass-shine"></div>

                            <div class="relative z-10 space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-emerald-100/90 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300 border border-emerald-300/70 dark:border-emerald-700/60 shadow-2xs">
                                        Layanan Pelanggan Aktif
                                    </span>
                                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 tracking-wide">
                                        Bank Syariah Wakalumi
                                    </span>
                                </div>

                                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white leading-snug">
                                    Siap Melayani Kebutuhan Finansial Syariah Anda
                                </h3>

                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed sm:leading-loose">
                                    Tim Customer Service dan staf operasional kami siap mendampingi pembukaan tabungan, simulasi bagi hasil deposito, hingga pengajuan pembiayaan usaha dengan amanah dan transparan.
                                </p>

                                <!-- Mini Metrics Inside Card -->
                                <div class="grid grid-cols-2 gap-3 pt-2">
                                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-dark-surface/70 border border-slate-200/80 dark:border-dark-border">
                                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Hari Kerja</span>
                                        <span class="block text-xs sm:text-sm font-extrabold text-teal-700 dark:text-teal-300 mt-0.5">
                                            Senin - Jumat
                                        </span>
                                    </div>
                                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-dark-surface/70 border border-slate-200/80 dark:border-dark-border">
                                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">WhatsApp CS</span>
                                        <span class="block text-xs sm:text-sm font-extrabold text-emerald-600 dark:text-emerald-400 mt-0.5">
                                            Respon Cepat
                                        </span>
                                    </div>
                                </div>

                                <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-3 text-xs">
                                    <span class="text-slate-500 dark:text-slate-400 font-medium">
                                        Butuh panduan lokasi cabang?
                                    </span>
                                    <a href="<?php echo esc_url( home_url( '/profil/jaringan-kantor' ) ); ?>" class="inline-flex items-center gap-1.5 text-teal-700 dark:text-teal-300 font-extrabold hover:underline">
                                        <span>Jaringan Kantor</span>
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 2: 3 KARTU SALURAN KOMUNIKASI LANGSUNG (DIRECT FAST-ACTION)
         ======================================================================== -->
    <section class="section py-16 sm:py-20 relative z-10 bg-white dark:bg-dark-card border-b border-slate-200/80 dark:border-dark-border/80">
        <div class="container-wide">
            <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-200 dark:border-teal-800 mb-3 shadow-2xs">
                    Saluran Komunikasi
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    Hubungi Layanan Perbankan Syariah BSW
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed sm:leading-loose">
                    Pilih kanal komunikasi resmi yang paling nyaman bagi Anda untuk berkonsultasi, mengajukan pertanyaan, atau menyampaikan aspirasi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                
                <!-- CARD 1: WHATSAPP CS -->
                <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-br from-emerald-400/40 via-teal-400/30 to-emerald-500/40 hover:from-emerald-500 hover:to-teal-400 hover:shadow-xl hover:shadow-emerald-500/15 transition-all duration-500 group"
                     data-aos="fade-up" data-aos-delay="0">
                    <div class="relative rounded-[22px] p-6 sm:p-8 bg-white/95 dark:bg-dark-surface/90 backdrop-blur-xl h-full flex flex-col justify-between overflow-hidden">
                        <!-- Glass Shine -->
                        <div class="wkl-glass-shine"></div>

                        <div>
                            <!-- Header Icon & Badge -->
                            <div class="flex items-center justify-between gap-3 mb-6">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-950/80 dark:to-emerald-900/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center border border-emerald-200/80 dark:border-emerald-700/60 shadow-xs group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                </div>
                                <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-emerald-50 dark:bg-emerald-950/70 text-emerald-700 dark:text-emerald-300 border border-emerald-200/80 dark:border-emerald-800">
                                    Respon Tercepat
                                </span>
                            </div>

                            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                WhatsApp Customer Service
                            </h3>

                            <div class="mb-4">
                                <span class="text-lg font-mono font-bold text-emerald-700 dark:text-emerald-300 block">
                                    <?php echo esc_html( $wa_display ); ?>
                                </span>
                                <span class="text-xs text-slate-500 dark:text-slate-400 block mt-0.5">
                                    Senin - Jumat: <?php echo esc_html( $jam_week ); ?>
                                </span>
                            </div>

                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed sm:leading-loose mb-6">
                                Layanan interaktif langsung bersama staf CS kami untuk konsultasi produk tabungan, deposito, simulasi pembiayaan, atau informasi persyaratan akad syariah.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                            <a href="<?php echo esc_url( $wa_url ); ?>" 
                               target="_blank" rel="noopener noreferrer"
                               class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs sm:text-sm shadow-md shadow-emerald-600/20 hover:scale-[1.02] transition-all">
                                <span>Chat WhatsApp Sekarang</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: TELEPON KANTOR -->
                <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-br from-teal-400/40 via-cyan-400/30 to-teal-500/40 hover:from-teal-500 hover:to-cyan-400 hover:shadow-xl hover:shadow-teal-500/15 transition-all duration-500 group"
                     data-aos="fade-up" data-aos-delay="100">
                    <div class="relative rounded-[22px] p-6 sm:p-8 bg-white/95 dark:bg-dark-surface/90 backdrop-blur-xl h-full flex flex-col justify-between overflow-hidden">
                        <!-- Glass Shine -->
                        <div class="wkl-glass-shine"></div>

                        <div>
                            <!-- Header Icon & Badge -->
                            <div class="flex items-center justify-between gap-3 mb-6">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-50 to-teal-100 dark:from-teal-950/80 dark:to-teal-900/40 text-teal-700 dark:text-teal-300 flex items-center justify-center border border-teal-200/80 dark:border-teal-700/60 shadow-xs group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                                    </svg>
                                </div>
                                <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-teal-50 dark:bg-teal-950/70 text-teal-700 dark:text-teal-300 border border-teal-200/80 dark:border-teal-800">
                                    Panggilan Suara
                                </span>
                            </div>

                            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2 group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                                Telepon Kantor Operasional
                            </h3>

                            <div class="mb-4">
                                <span class="text-lg font-mono font-bold text-teal-800 dark:text-teal-200 block">
                                    <?php echo esc_html( $phone ); ?>
                                </span>
                                <span class="text-xs text-slate-500 dark:text-slate-400 block mt-0.5">
                                    Senin - Jumat: <?php echo esc_html( $jam_week ); ?>
                                </span>
                            </div>

                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed sm:leading-loose mb-6">
                                Sambungan telepon langsung ke kantor pusat operasional untuk konfirmasi rekening, urusan administrasi, serta koordinasi layanan perbankan resmi.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                            <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" 
                               class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-teal-600 hover:bg-teal-700 text-white font-extrabold text-xs sm:text-sm shadow-md shadow-teal-600/20 hover:scale-[1.02] transition-all">
                                <span>Hubungi Telepon Kantor</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: EMAIL RESMI -->
                <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-br from-cyan-400/40 via-blue-400/30 to-teal-500/40 hover:from-cyan-500 hover:to-blue-400 hover:shadow-xl hover:shadow-cyan-500/15 transition-all duration-500 group"
                     data-aos="fade-up" data-aos-delay="200">
                    <div class="relative rounded-[22px] p-6 sm:p-8 bg-white/95 dark:bg-dark-surface/90 backdrop-blur-xl h-full flex flex-col justify-between overflow-hidden">
                        <!-- Glass Shine -->
                        <div class="wkl-glass-shine"></div>

                        <div>
                            <!-- Header Icon & Badge -->
                            <div class="flex items-center justify-between gap-3 mb-6">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-50 to-cyan-100 dark:from-cyan-950/80 dark:to-cyan-900/40 text-cyan-700 dark:text-cyan-300 flex items-center justify-center border border-cyan-200/80 dark:border-cyan-700/60 shadow-xs group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                    </svg>
                                </div>
                                <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-cyan-50 dark:bg-cyan-950/70 text-cyan-700 dark:text-cyan-300 border border-cyan-200/80 dark:border-cyan-800">
                                    Korespondensi Formal
                                </span>
                            </div>

                            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2 group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">
                                Email Resmi Perseroan
                            </h3>

                            <div class="mb-4">
                                <span class="text-lg font-mono font-bold text-cyan-800 dark:text-cyan-200 block truncate">
                                    <?php echo esc_html( $email ); ?>
                                </span>
                                <span class="text-xs text-slate-500 dark:text-slate-400 block mt-0.5">
                                    Respon Maksimal 1 x 24 Jam Kerja
                                </span>
                            </div>

                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed sm:leading-loose mb-6">
                                Saluran pengiriman surat dinas, berkas kemitraan kelembagaan, penawaran kerjasama, maupun penyampaian dokumen resmi kepada pihak manajemen bank.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" 
                               class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-2xl bg-cyan-600 hover:bg-cyan-700 text-white font-extrabold text-xs sm:text-sm shadow-md shadow-cyan-600/20 hover:scale-[1.02] transition-all">
                                <span>Kirim Pesan Email</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 3: MEDIA SOSIAL RESMI PERSEROAN (SOCIAL MEDIA HUB)
         ======================================================================== -->
    <section class="section py-16 sm:py-20 relative z-10 bg-slate-50/70 dark:bg-dark-surface/50 border-b border-slate-200/80 dark:border-dark-border/80">
        <div class="container-wide">
            
            <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-100/90 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-300 dark:border-teal-700 mb-3 shadow-2xs">
                    Jejaring Komunitas
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    Media Sosial Resmi Bank Syariah Wakalumi
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed sm:leading-loose">
                    Ikuti akun resmi kami untuk memperoleh update warta perbankan, edukasi fikih muamalah, informasi produk, dan kegiatan CSR perseroan.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-6">

                <!-- INSTAGRAM CARD -->
                <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-br from-pink-500/30 via-rose-500/20 to-amber-500/30 hover:from-pink-500 hover:to-amber-500 hover:shadow-xl hover:shadow-pink-500/15 transition-all duration-300 group flex flex-col justify-between"
                     data-aos="fade-up" data-aos-delay="0">
                    <div class="relative rounded-[22px] p-6 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl h-full flex flex-col justify-between overflow-hidden">
                        <div class="wkl-glass-shine"></div>

                        <div>
                            <div class="flex items-center justify-between gap-3 mb-5">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-[#f09433] via-[#dc2743] to-[#bc1888] text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-pink-50 dark:bg-pink-950/70 text-pink-700 dark:text-pink-300 border border-pink-200/80">
                                    Instagram
                                </span>
                            </div>

                            <h4 class="text-base font-extrabold text-slate-900 dark:text-white mb-1">
                                @bprswakalumi
                            </h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">
                                Warta Visual &amp; Edukasi
                            </p>
                            <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                                Rangkuman infografis produk, tips perencanaan finansial berkah, dan sorotan kegiatan insan BSW.
                            </p>
                        </div>

                        <a href="<?php echo esc_url( $social_ig ); ?>" 
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-between w-full text-xs font-bold text-pink-700 dark:text-pink-400 hover:text-pink-800 dark:hover:text-pink-300 pt-3 border-t border-slate-100 dark:border-slate-800">
                            <span>Ikuti @bprswakalumi</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        </a>
                    </div>
                </div>

                <!-- FACEBOOK CARD -->
                <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-br from-blue-500/30 via-blue-600/20 to-sky-500/30 hover:from-blue-600 hover:to-sky-500 hover:shadow-xl hover:shadow-blue-500/15 transition-all duration-300 group flex flex-col justify-between"
                     data-aos="fade-up" data-aos-delay="100">
                    <div class="relative rounded-[22px] p-6 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl h-full flex flex-col justify-between overflow-hidden">
                        <div class="wkl-glass-shine"></div>

                        <div>
                            <div class="flex items-center justify-between gap-3 mb-5">
                                <div class="w-12 h-12 rounded-2xl bg-[#1877F2] text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-blue-50 dark:bg-blue-950/70 text-blue-700 dark:text-blue-300 border border-blue-200/80">
                                    Facebook
                                </span>
                            </div>

                            <h4 class="text-base font-extrabold text-slate-900 dark:text-white mb-1">
                                BPR Syariah Wakalumi
                            </h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">
                                Komunitas &amp; CSR
                            </p>
                            <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                                Informasi kegiatan sosial kemasyarakatan, publikasi penyaluran dana CSR, dan artikel keluarga syariah.
                            </p>
                        </div>

                        <a href="<?php echo esc_url( $social_fb ); ?>" 
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-between w-full text-xs font-bold text-blue-700 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 pt-3 border-t border-slate-100 dark:border-slate-800">
                            <span>Kunjungi Facebook</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        </a>
                    </div>
                </div>

                <!-- LINKEDIN CARD -->
                <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-br from-sky-600/30 via-blue-700/20 to-teal-500/30 hover:from-sky-600 hover:to-teal-500 hover:shadow-xl hover:shadow-sky-600/15 transition-all duration-300 group flex flex-col justify-between"
                     data-aos="fade-up" data-aos-delay="200">
                    <div class="relative rounded-[22px] p-6 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl h-full flex flex-col justify-between overflow-hidden">
                        <div class="wkl-glass-shine"></div>

                        <div>
                            <div class="flex items-center justify-between gap-3 mb-5">
                                <div class="w-12 h-12 rounded-2xl bg-[#0A66C2] text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-sky-50 dark:bg-sky-950/70 text-sky-700 dark:text-sky-300 border border-sky-200/80">
                                    LinkedIn
                                </span>
                            </div>

                            <h4 class="text-base font-extrabold text-slate-900 dark:text-white mb-1">
                                PT BPRS Wakalumi
                            </h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">
                                Korporasi &amp; Karir
                            </p>
                            <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                                Jejaring profesional perbankan syariah, publikasi tata kelola GCG, dan profil kepemimpinan bank.
                            </p>
                        </div>

                        <a href="<?php echo esc_url( $social_li ); ?>" 
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-between w-full text-xs font-bold text-sky-700 dark:text-sky-400 hover:text-sky-800 dark:hover:text-sky-300 pt-3 border-t border-slate-100 dark:border-slate-800">
                            <span>Ikuti di LinkedIn</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        </a>
                    </div>
                </div>

                <!-- YOUTUBE CARD -->
                <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-br from-red-500/30 via-rose-600/20 to-amber-500/30 hover:from-red-600 hover:to-amber-500 hover:shadow-xl hover:shadow-red-500/15 transition-all duration-300 group flex flex-col justify-between"
                     data-aos="fade-up" data-aos-delay="300">
                    <div class="relative rounded-[22px] p-6 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl h-full flex flex-col justify-between overflow-hidden">
                        <div class="wkl-glass-shine"></div>

                        <div>
                            <div class="flex items-center justify-between gap-3 mb-5">
                                <div class="w-12 h-12 rounded-2xl bg-[#FF0000] text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-50 dark:bg-red-950/70 text-red-700 dark:text-red-300 border border-red-200/80">
                                    YouTube
                                </span>
                            </div>

                            <h4 class="text-base font-extrabold text-slate-900 dark:text-white mb-1">
                                Bank Syariah Wakalumi
                            </h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">
                                Video Profil &amp; Dokumentasi
                            </p>
                            <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                                Video profil resmi bank, penjelasan produk simpanan, serta liputan seminar dan workshop muamalah.
                            </p>
                        </div>

                        <a href="<?php echo esc_url( $social_yt ?: 'https://www.youtube.com' ); ?>" 
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-between w-full text-xs font-bold text-red-700 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 pt-3 border-t border-slate-100 dark:border-slate-800">
                            <span>Tonton di YouTube</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 4: KANTOR PUSAT & PETA LOKASI GOOGLE MAPS
         ======================================================================== -->
    <section class="section py-16 sm:py-20 relative z-10 bg-white dark:bg-dark-card border-b border-slate-200/80 dark:border-dark-border/80">
        <div class="container-wide">
            
            <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-200 dark:border-teal-800 mb-3 shadow-2xs">
                    Lokasi Kantor
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    Kantor Pusat Operasional &amp; Peta Navigasi
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed sm:leading-loose">
                    Kunjungi kantor kami untuk layanan tatap muka langsung, verifikasi berkas, atau konsultasi pembiayaan usaha bersama tim perbankan syariah.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                
                <!-- Left Column: Kantor Detail Box (5 cols) -->
                <div class="lg:col-span-5 flex flex-col justify-between" data-aos="fade-up">
                    <div class="p-[1.5px] rounded-3xl bg-gradient-to-br from-teal-400/30 via-slate-200/70 to-emerald-400/20 dark:from-teal-500/25 dark:via-dark-border dark:to-teal-950/20 h-full">
                        <div class="p-6 sm:p-8 rounded-[22px] bg-slate-50/90 dark:bg-dark-surface/90 backdrop-blur-xl h-full flex flex-col justify-between">
                            
                            <div class="space-y-6">
                                <div class="flex items-center justify-between gap-3">
                                    <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-teal-100/90 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border border-teal-300/70">
                                        Head Office
                                    </span>
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Beroperasi Normal
                                    </span>
                                </div>

                                <div>
                                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white leading-tight mb-3">
                                        PT BPRS Wakalumi
                                    </h3>
                                    <div class="flex items-start gap-3 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed sm:leading-loose">
                                        <svg class="w-5 h-5 text-teal-600 dark:text-teal-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span class="whitespace-pre-line font-medium"><?php echo esc_html( $address ); ?></span>
                                    </div>
                                </div>

                                <div class="p-4 rounded-2xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border space-y-2.5">
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
                                    <h5 class="font-bold text-slate-900 dark:text-white uppercase tracking-wider text-[11px] text-teal-800 dark:text-teal-300">
                                        Layanan yang Tersedia:
                                    </h5>
                                    <ul class="space-y-1.5 text-slate-600 dark:text-slate-300">
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                            <span>Pembukaan Rekening Tabungan &amp; Deposito Mudharabah</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                            <span>Konsultasi &amp; Pengajuan Pembiayaan Usaha / UMKM</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                            <span>Transaksi Setoran &amp; Penarikan Tunai Kas</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                            <span>Layanan Pengaduan Konsumen &amp; Customer Care</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="pt-6 mt-6 border-t border-slate-200/80 dark:border-slate-800">
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
                    <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-br from-teal-400 via-emerald-400 to-cyan-500 shadow-xl overflow-hidden h-full min-h-[380px] sm:min-h-[440px] flex flex-col justify-between group">
                        <div class="relative rounded-[22px] bg-slate-100 dark:bg-dark-surface overflow-hidden flex-1 flex flex-col justify-between">
                            <!-- Glass Shine -->
                            <div class="wkl-glass-shine"></div>

                            <!-- Iframe Container -->
                            <div class="w-full flex-1 min-h-[320px] sm:min-h-[380px]">
                                <iframe src="<?php echo esc_url( $maps_embed ); ?>" 
                                        width="100%" 
                                        height="100%" 
                                        style="border:0; min-height: 380px;" 
                                        allowfullscreen="" 
                                        loading="lazy" 
                                        referrerpolicy="no-referrer-when-downgrade"
                                        title="<?php echo esc_attr( $maps_title ); ?>"
                                        class="w-full h-full">
                                </iframe>
                            </div>

                            <!-- Map Floating Action Bar -->
                            <div class="p-4 sm:p-5 bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border-t border-slate-200 dark:border-dark-border flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                                <div class="flex items-center gap-2 text-xs font-semibold text-slate-700 dark:text-slate-300">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                    <span>Peta Google Maps Terverifikasi</span>
                                </div>
                                <a href="<?php echo esc_url( $gmaps_app_url ); ?>" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs shadow-sm transition-all hover:scale-105">
                                    <span>Buka Navigasi di Google Maps</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 5: HIMBAUAN KEAMANAN & PENCEGAHAN PENIPUAN (ANTI-FRAUD)
         ======================================================================== -->
    <section class="section py-12 relative z-10">
        <div class="container-narrow mx-auto" data-aos="fade-up">
            <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-r from-amber-400/40 via-teal-400/30 to-amber-500/40 dark:from-amber-500/20 dark:via-dark-border dark:to-teal-900/20 overflow-hidden shadow-lg">
                <div class="p-6 sm:p-8 rounded-[22px] bg-white/95 dark:bg-dark-card/90 backdrop-blur-xl space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-amber-100 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300 border border-amber-300/70">
                            🛡️ Keamanan &amp; Kepatuhan
                        </span>
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400">
                            Waspada Modus Penipuan
                        </span>
                    </div>

                    <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white leading-snug">
                        Himbauan Keamanan Bertransaksi Bagi Nasabah
                    </h3>

                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed sm:leading-loose">
                        Untuk kenyamanan dan keselamatan finansial Anda, mohon perhatikan pedoman keamanan resmi Bank Syariah Wakalumi:
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2">
                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-dark-surface/70 border border-slate-200/80 dark:border-dark-border">
                            <h5 class="text-xs font-bold text-slate-900 dark:text-white mb-1">1. Jaga Kerahasiaan Data</h5>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed">
                                Petugas bank TIDAK PERNAH meminta nomor PIN, password, maupun kode OTP transaksi Anda.
                            </p>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-dark-surface/70 border border-slate-200/80 dark:border-dark-border">
                            <h5 class="text-xs font-bold text-slate-900 dark:text-white mb-1">2. Rekening Resmi Perseroan</h5>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed">
                                Pembayaran pembiayaan HANYA melalui rekening resmi atas nama PT BPRS Wakalumi, bukan rekening pribadi.
                            </p>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-50 dark:bg-dark-surface/70 border border-slate-200/80 dark:border-dark-border">
                            <h5 class="text-xs font-bold text-slate-900 dark:text-white mb-1">3. Saluran Komunikasi Sah</h5>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed">
                                Pastikan nomor dan akun resmi yang menghubungi Anda sama persis dengan yang tercantum pada halaman ini.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 6: CENTERED CTA BANNER
         ======================================================================== -->
    <section class="section py-16 sm:py-20 relative z-10">
        <div class="container-narrow mx-auto text-center" data-aos="fade-up">
            <div class="relative p-[2px] rounded-3xl bg-gradient-to-br from-teal-500/40 via-emerald-500/20 to-teal-700/40 shadow-2xl group overflow-hidden">
                <div class="relative rounded-[22px] p-8 sm:p-12 md:p-14 bg-gradient-to-br from-slate-900 via-slate-900 to-teal-950 text-center space-y-6 overflow-hidden">
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
                            Konsultasi Perbankan Syariah
                        </div>

                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight">
                            Siap Memulai Perjalanan Finansial Berkah Bersama BSW?
                        </h2>

                        <p class="text-sm sm:text-base text-slate-300 leading-relaxed sm:leading-loose">
                            Hubungi tim customer service kami sekarang atau jelajahi berbagai produk tabungan, deposito, dan pembiayaan syariah yang dirancang untuk kemaslahatan Anda.
                        </p>

                        <!-- Dual Centered Buttons -->
                        <div class="pt-4 flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                            <a href="<?php echo esc_url( $wa_url ); ?>" 
                               target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold text-sm shadow-xl shadow-teal-500/20 hover:scale-105 transition-all duration-300">
                                <svg class="w-4 h-4 text-slate-950" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                <span>Hubungi via WhatsApp</span>
                            </a>

                            <a href="<?php echo esc_url( home_url( '/produk/tabungan-syariah' ) ); ?>" 
                               class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/15 text-white font-bold text-sm border border-white/20 backdrop-blur-md hover:scale-105 transition-all duration-300">
                                <span>Jelajahi Produk Syariah</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>

