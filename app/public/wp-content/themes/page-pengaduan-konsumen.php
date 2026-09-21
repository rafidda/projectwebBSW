<?php
/**
 * Template Name: Layanan Pengaduan Konsumen
 * Description: Halaman Resmi Layanan Pengaduan Konsumen & Kepatuhan Regulasi POJK No. 22 Tahun 2023.
 *              Menampilkan Dual Action Hub, Prosedur Dual-Tone Beranimasi, SLA Dinamis, dan Panduan Dokumen.
 *
 * @package Wakalumi
 */

// Filter dynamic document title tag agar otomatis mengikuti pengaturan CMS
add_filter( 'document_title_parts', function( $title_parts ) {
    if ( function_exists( 'wakalumi_get_pengaduan_settings' ) ) {
        $cfg = wakalumi_get_pengaduan_settings();
        if ( ! empty( $cfg['title'] ) ) {
            $title_parts['title'] = $cfg['title'];
        }
    }
    return $title_parts;
}, 99 );

get_header();

$cfg = function_exists( 'wakalumi_get_pengaduan_settings' ) ? wakalumi_get_pengaduan_settings() : [
    'badge'         => 'Perlindungan Konsumen & Regulasi OJK',
    'title'         => 'Layanan Pengaduan Konsumen',
    'subtitle'      => 'Komitmen BPRS Wakalumi dalam mendengarkan, melayani, dan menindaklanjuti setiap aspirasi serta pengaduan nasabah secara adil, transparan, dan profesional sesuai POJK No. 22 Tahun 2023.',
    'disclaimer'    => 'BPRS Wakalumi Berizin dan Diawasi oleh Otoritas Jasa Keuangan (OJK) serta merupakan peserta penjaminan Lembaga Penjamin Simpanan (LPS).',
    'wa'            => '6281517380388',
    'phone'         => '(021) 7471 4555',
    'email'         => 'pengaduan@wakalumibprs.co.id',
    'hours'         => 'Senin – Jumat: 08.00 – 15.00 WIB (Kecuali Hari Libur Nasional)',
    'location_desc' => 'Kantor Pusat & Seluruh Jaringan Kantor Kas BPRS Wakalumi',
    'ojk_appk_url'  => 'https://kontak157.ojk.go.id',
    'ojk_phone'     => '157',
    'ojk_wa'        => '081 157 157 157',
    'ojk_email'     => 'konsumen@ojk.go.id',
    'laps_url'      => 'https://lapssjk.id',
    'alur_show'     => true,
    'sla_show'      => true,
    'panduan_show'  => true,
    'sla_lisan'     => '5 Hari Kerja',
    'sla_tertulis'  => '10 Hari Kerja',
    'sla_note'      => 'Dapat diperpanjang paling lama 10 (sepuluh) hari kerja dalam kondisi tertentu sesuai ketentuan POJK No. 22 Tahun 2023 Pasal 57.',
    'show_form_pdf' => false,
    'form_pdf_url'  => '',
];

$clean_wa      = preg_replace( '/[^0-9]/', '', $cfg['wa'] );
$wa_url        = 'https://wa.me/' . $clean_wa . '?text=' . rawurlencode( 'Halo Tim Layanan Nasabah BPRS Wakalumi, saya ingin menyampaikan pengaduan terkait layanan perbankan.' );

$clean_ojk_wa  = preg_replace( '/[^0-9]/', '', $cfg['ojk_wa'] );
$ojk_wa_url    = 'https://wa.me/' . $clean_ojk_wa;

$has_pdf_file  = ! empty( $cfg['form_pdf_url'] );
$pdf_link      = $has_pdf_file ? $cfg['form_pdf_url'] : $wa_url . '&text=' . rawurlencode( 'Halo Tim BPRS Wakalumi, mohon kirimkan Berkas PDF Formulir Pengaduan Nasabah resmi.' );

// Pembersihan nilai metrik SLA agar tampilan angka rapi tanpa teks panjang
$raw_sla_lisan        = ! empty( $cfg['sla_lisan'] ) ? $cfg['sla_lisan'] : '5 Hari Kerja';
$raw_sla_tertulis     = ! empty( $cfg['sla_tertulis'] ) ? $cfg['sla_tertulis'] : '10 Hari Kerja';
$display_sla_lisan    = trim( preg_replace( '/\s*\(.*?\)/', '', $raw_sla_lisan ) );
$display_sla_tertulis = trim( preg_replace( '/\s*\(.*?\)/', '', $raw_sla_tertulis ) );

$default_sla_note     = 'Dapat diperpanjang paling lama 10 (sepuluh) hari kerja dalam kondisi tertentu sesuai ketentuan POJK No. 22 Tahun 2023 Pasal 57.';
if ( ! empty( $cfg['sla_note'] ) ) {
    $sla_note = $cfg['sla_note'];
} else {
    preg_match( '/\((.*?)\)/', $raw_sla_tertulis, $note_match );
    $sla_note = ! empty( $note_match[1] ) ? $note_match[1] : $default_sla_note;
}
?>

<main class="min-h-screen bg-transparent text-slate-800 dark:text-slate-100 transition-colors duration-300">

    <!-- ========================================================================
         SECTION 1: HERO HEADER BANNER (STANDAR SERAGAM DENGAN HALAMAN LAIN)
         ======================================================================== -->
    <section class="relative z-10 pt-8 pb-12 md:pb-16 overflow-hidden bg-gradient-to-b from-teal-50/60 via-slate-50/40 to-transparent dark:from-dark-surface dark:via-dark-surface/50 dark:to-transparent border-b border-slate-200/80 dark:border-dark-border/80">
        <!-- Ambient Blur Glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-72 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

        <!-- Background Watermark Emblem (Hero Header) -->
        <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/4 w-80 sm:w-96 h-80 sm:h-96 opacity-[0.045] dark:opacity-[0.07] pointer-events-none select-none z-0 mix-blend-multiply dark:mix-blend-screen">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain grayscale">
        </div>

        <div class="container-wide relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-300 transition-colors flex items-center gap-1.5 font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <span class="text-slate-500 dark:text-slate-400 font-medium">Informasi</span>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <span class="text-teal-600 dark:text-teal-400 font-semibold">Pengaduan Konsumen</span>
            </nav>

            <div class="max-w-4xl" data-aos="fade-up">
                <!-- Kicker Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100/80 dark:bg-emerald-950/60 border border-emerald-300/60 dark:border-emerald-700/50 text-emerald-800 dark:text-emerald-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <?php echo esc_html( $cfg['badge'] ); ?>
                </div>

                <!-- Title -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                    <?php echo esc_html( $cfg['title'] ); ?>
                </h1>

                <!-- Subtitle -->
                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                    <?php echo esc_html( $cfg['subtitle'] ); ?>
                </p>

                <!-- Quick Highlights -->
                <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                        <span>POJK No. 22 Tahun 2023</span>
                    </div>
                    <?php if ( ! empty( $cfg['sla_show'] ) ) : ?>
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>SLA Terukur: 5 – 10 Hari Kerja</span>
                    </div>
                    <?php endif; ?>
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                        <span>Kerahasiaan Data Terjamin</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 2: DUAL-ACTION HUB CTA (INTI UTAMA LAYANAN PENGADUAN)
         DENGAN GAYA DUAL-TONE, ANIMASI KACA (GLASS SHINE) & WATERMARK
         ======================================================================== -->
    <section class="py-12 md:py-16 bg-transparent relative z-20 -mt-4">
        <div class="container-wide">
            
            <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
                <span class="text-xs font-extrabold text-teal-600 dark:text-teal-400 uppercase tracking-widest block mb-2">
                    Pilihan Saluran Layanan
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">
                    Sampaikan Pengaduan dengan Mudah &amp; Cepat
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2">
                    Pilih saluran pengaduan langsung ke Tim BPRS Wakalumi atau akses portal resmi regulator Otoritas Jasa Keuangan.
                </p>
            </div>

            <!-- 2 Core Action Cards (Dual-Tone Design) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- CARD A: PENGADUAN INTERNAL BPRS WAKALUMI (DUAL-TONE) -->
                <div class="spotlight-card group relative rounded-3xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-emerald-200/90 dark:border-dark-border hover:border-emerald-400 dark:hover:border-emerald-500 shadow-md hover:shadow-2xl hover:shadow-emerald-500/15 hover:-translate-y-1.5 transition-all duration-500 overflow-hidden flex flex-col justify-between" data-aos="fade-up" data-aos-delay="50">
                    
                    <!-- Decorative Watermark Logo (Interactive Hover: Left 3/4 -> Right 1/2 Full Card) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] 
                                w-64 h-64 sm:w-72 sm:h-72 md:w-80 md:h-80
                                opacity-[0.035] dark:opacity-[0.055] 
                                pointer-events-none select-none 
                                transition-all duration-700 ease-out 
                                group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 
                                group-hover:opacity-[0.08] dark:group-hover:opacity-[0.14] 
                                grayscale mix-blend-multiply dark:mix-blend-screen overflow-hidden z-0">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain">
                    </div>

                    <!-- Top Accent Line -->
                    <div class="h-1.5 w-full bg-gradient-to-r from-emerald-500 via-teal-400 to-cyan-500 relative z-10"></div>

                    <!-- TONE 1: TINTED HEADER BAR -->
                    <div class="p-6 sm:p-7 bg-gradient-to-br from-emerald-50/90 via-teal-50/50 to-white/10 dark:from-emerald-950/40 dark:via-dark-card dark:to-dark-card border-b border-emerald-100/90 dark:border-dark-border relative overflow-hidden z-10">

                        <!-- Badge Row -->
                        <div class="flex items-center justify-between gap-2 mb-3 relative z-10">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-emerald-100 dark:bg-emerald-900/60 text-emerald-800 dark:text-emerald-300 border border-emerald-300/60 dark:border-emerald-700/60 shadow-xs">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                                Saluran Resmi BPRS Wakalumi
                            </span>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-white/80 dark:bg-dark-surface text-emerald-700 dark:text-emerald-300 text-[11px] font-bold border border-emerald-200/80 dark:border-emerald-800/80 shadow-xs">
                                <svg class="w-3 h-3 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                Bebas Biaya (Gratis)
                            </span>
                        </div>

                        <!-- Title & Description -->
                        <div class="relative z-10">
                            <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white mb-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                Hubungi Tim Layanan Nasabah
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                                Sampaikan keluhan transaksi, rekening, pembiayaan, atau pelayanan secara langsung. Tim Kepatuhan dan Customer Care kami siap menindaklanjuti secara seksama.
                            </p>
                        </div>

                        <!-- Informative Pill Badges (Professional SVG Icons) -->
                        <div class="flex flex-wrap items-center gap-2 mt-4 relative z-10">
                            <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200/80 dark:border-dark-border flex items-center gap-1.5 shadow-2xs">
                                <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                                <span>Kerahasiaan Terjamin</span>
                            </span>
                            <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200/80 dark:border-dark-border flex items-center gap-1.5 shadow-2xs">
                                <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                                <span>Respon Cepat</span>
                            </span>
                            <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200/80 dark:border-dark-border flex items-center gap-1.5 shadow-2xs">
                                <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Berkeadilan Syariah</span>
                            </span>
                        </div>
                    </div>

                    <!-- TONE 2: CARD BODY & CHANNELS -->
                    <div class="p-6 sm:p-7 flex-1 flex flex-col justify-between bg-white dark:bg-dark-card space-y-6">
                        
                        <!-- Channel List -->
                        <div class="space-y-3">
                            <!-- WhatsApp -->
                            <div class="group/item flex items-start gap-3.5 p-3.5 rounded-2xl bg-emerald-50/70 dark:bg-emerald-950/30 border border-emerald-200/70 dark:border-emerald-900/40 hover:border-emerald-400 dark:hover:border-emerald-700 transition-all hover:translate-x-1">
                                <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 shadow-md shadow-emerald-500/30 group-hover/item:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.966-.941 1.164-.173.199-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400">WhatsApp Layanan Nasabah</span>
                                        <span class="inline-flex items-center gap-1 text-[10px] font-extrabold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Chat Aktif
                                        </span>
                                    </div>
                                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="text-sm font-extrabold text-emerald-700 dark:text-emerald-300 hover:underline block mt-0.5">
                                        +<?php echo esc_html( $cfg['wa'] ); ?>
                                    </a>
                                </div>
                            </div>

                            <!-- Hotline Telepon -->
                            <div class="group/item flex items-start gap-3.5 p-3.5 rounded-2xl bg-slate-50 dark:bg-dark-surface-alt border border-slate-200/80 dark:border-dark-border hover:border-teal-400 dark:hover:border-teal-700 transition-all hover:translate-x-1">
                                <div class="w-10 h-10 rounded-xl bg-teal-600 text-white flex items-center justify-center flex-shrink-0 shadow-md shadow-teal-600/30 group-hover/item:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 block">Hotline Kantor Pusat</span>
                                    <span class="text-sm font-extrabold text-slate-900 dark:text-white block mt-0.5">
                                        <?php echo esc_html( $cfg['phone'] ); ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Email Pengaduan -->
                            <div class="group/item flex items-start gap-3.5 p-3.5 rounded-2xl bg-slate-50 dark:bg-dark-surface-alt border border-slate-200/80 dark:border-dark-border hover:border-slate-400 dark:hover:border-slate-600 transition-all hover:translate-x-1">
                                <div class="w-10 h-10 rounded-xl bg-slate-700 text-white flex items-center justify-center flex-shrink-0 shadow-md group-hover/item:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 block">Email Pengaduan Nasabah</span>
                                    <a href="mailto:<?php echo esc_attr( $cfg['email'] ); ?>" class="text-sm font-extrabold text-slate-900 dark:text-white hover:text-teal-600 dark:hover:text-teal-400 truncate block mt-0.5">
                                        <?php echo esc_html( $cfg['email'] ); ?>
                                    </a>
                                </div>
                            </div>

                            <!-- Loket Tatap Muka & Jam Kerja -->
                            <div class="p-3.5 rounded-2xl bg-slate-50/90 dark:bg-dark-surface-alt border border-slate-200/80 dark:border-dark-border text-xs text-slate-600 dark:text-slate-300">
                                <div class="flex items-center gap-2 font-bold text-slate-900 dark:text-white mb-1">
                                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.75a1.5 1.5 0 011.5-1.5h1.5a1.5 1.5 0 011.5 1.5V21"/></svg>
                                    <span><?php echo esc_html( $cfg['location_desc'] ); ?></span>
                                </div>
                                <div class="text-[11px] text-slate-500 dark:text-slate-400 pl-6 leading-relaxed">
                                    Layanan Tatap Muka: <?php echo esc_html( $cfg['hours'] ); ?>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
                            <a 
                                href="<?php echo esc_url( $wa_url ); ?>" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="w-full sm:flex-1 py-3.5 px-6 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-extrabold shadow-lg shadow-emerald-600/30 hover:shadow-emerald-600/40 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2.5 text-center"
                            >
                                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.966-.941 1.164-.173.199-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                <span>Kirim Pengaduan via WA</span>
                            </a>
                            <a 
                                href="mailto:<?php echo esc_attr( $cfg['email'] ); ?>?subject=<?php echo rawurlencode( 'Pengaduan Nasabah - BPRS Wakalumi' ); ?>" 
                                class="w-full sm:w-auto py-3.5 px-5 rounded-2xl border border-slate-200 dark:border-dark-border bg-white dark:bg-dark-card hover:border-emerald-400 text-slate-700 dark:text-slate-200 text-sm font-bold shadow-xs hover:-translate-y-0.5 transition-all text-center flex items-center justify-center gap-2"
                            >
                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                                <span>Kirim Email Resmi</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD B: PORTAL APPK OJK & LAPS SJK (DUAL-TONE ESKALASI REGULATOR) -->
                <div class="spotlight-card group relative rounded-3xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-blue-200/90 dark:border-dark-border hover:border-blue-400 dark:hover:border-blue-500 shadow-md hover:shadow-2xl hover:shadow-blue-500/15 hover:-translate-y-1.5 transition-all duration-500 overflow-hidden flex flex-col justify-between" data-aos="fade-up" data-aos-delay="150">
                    
                    <!-- Decorative Watermark Logo (Interactive Hover: Left 3/4 -> Right 1/2 Full Card) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] 
                                w-64 h-64 sm:w-72 sm:h-72 md:w-80 md:h-80
                                opacity-[0.035] dark:opacity-[0.055] 
                                pointer-events-none select-none 
                                transition-all duration-700 ease-out 
                                group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 
                                group-hover:opacity-[0.08] dark:group-hover:opacity-[0.14] 
                                grayscale mix-blend-multiply dark:mix-blend-screen overflow-hidden z-0">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain">
                    </div>

                    <!-- Top Accent Line -->
                    <div class="h-1.5 w-full bg-gradient-to-r from-blue-600 via-indigo-500 to-cyan-500 relative z-10"></div>

                    <!-- TONE 1: TINTED HEADER BAR -->
                    <div class="p-6 sm:p-7 bg-gradient-to-br from-blue-50/90 via-indigo-50/50 to-white/10 dark:from-blue-950/40 dark:via-dark-card dark:to-dark-card border-b border-blue-100/90 dark:border-dark-border relative overflow-hidden z-10">

                        <!-- Badge Row -->
                        <div class="flex items-center justify-between gap-2 mb-3 relative z-10">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-blue-100 dark:bg-blue-900/60 text-blue-800 dark:text-blue-300 border border-blue-300/60 dark:border-blue-700/60 shadow-xs">
                                <span class="w-2 h-2 rounded-full bg-blue-500 animate-ping"></span>
                                Portal Resmi Regulator OJK
                            </span>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-white/80 dark:bg-dark-surface text-blue-700 dark:text-blue-300 text-[11px] font-bold border border-blue-200/80 dark:border-blue-800/80 shadow-xs">
                                Eskalasi Eksternal
                            </span>
                        </div>

                        <!-- Title & Description -->
                        <div class="relative z-10">
                            <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                Portal APPK OJK (Kontak 157)
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                                Sesuai regulasi POJK, jika proses penanganan belum mencapai kesepakatan atau Anda membutuhkan perlindungan otoritas, Anda dapat mengakses portal terpadu APPK OJK.
                            </p>
                        </div>

                        <!-- Informative Pill Badges (Professional SVG Icons) -->
                        <div class="flex flex-wrap items-center gap-2 mt-4 relative z-10">
                            <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200/80 dark:border-dark-border flex items-center gap-1.5 shadow-2xs">
                                <svg class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5m-15 10.5V10.5"/></svg>
                                <span>Otoritas Jasa Keuangan</span>
                            </span>
                            <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200/80 dark:border-dark-border flex items-center gap-1.5 shadow-2xs">
                                <svg class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span>Lacak Status Online</span>
                            </span>
                            <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200/80 dark:border-dark-border flex items-center gap-1.5 shadow-2xs">
                                <svg class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.97zM6.75 4.97L4.13 15.696c-.121.499.107 1.028.59 1.202a5.988 5.988 0 002.031.352 5.988 5.988 0 002.031-.352c.483-.174.711-.703.589-1.202L6.75 4.97z"/></svg>
                                <span>Alternatif Sengketa LAPS</span>
                            </span>
                        </div>
                    </div>

                    <!-- TONE 2: CARD BODY & CHANNELS -->
                    <div class="p-6 sm:p-7 flex-1 flex flex-col justify-between bg-white dark:bg-dark-card space-y-6">
                        
                        <!-- Channel List -->
                        <div class="space-y-3">
                            <!-- Portal Daring APPK -->
                            <div class="group/item flex items-start gap-3.5 p-3.5 rounded-2xl bg-blue-50/70 dark:bg-blue-950/30 border border-blue-200/70 dark:border-blue-900/40 hover:border-blue-400 dark:hover:border-blue-700 transition-all hover:translate-x-1">
                                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center flex-shrink-0 shadow-md shadow-blue-600/30 group-hover/item:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-.778.099-1.533.284-2.253"/></svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400">Portal APPK Kontak 157</span>
                                        <span class="inline-flex items-center gap-1 text-[10px] font-extrabold text-blue-600 dark:text-blue-400 uppercase tracking-wider">
                                            24 Jam Online
                                        </span>
                                    </div>
                                    <a href="<?php echo esc_url( $cfg['ojk_appk_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="text-sm font-extrabold text-blue-700 dark:text-blue-300 hover:underline block mt-0.5">
                                        <?php echo esc_html( preg_replace( '#^https?://#', '', $cfg['ojk_appk_url'] ) ); ?> ↗
                                    </a>
                                </div>
                            </div>

                            <!-- Kontak OJK 157 -->
                            <div class="group/item flex items-start gap-3.5 p-3.5 rounded-2xl bg-slate-50 dark:bg-dark-surface-alt border border-slate-200/80 dark:border-dark-border hover:border-indigo-400 dark:hover:border-indigo-700 transition-all hover:translate-x-1">
                                <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center flex-shrink-0 shadow-md shadow-indigo-600/30 group-hover/item:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 block">Call Center Kontak OJK</span>
                                    <span class="text-sm font-extrabold text-slate-900 dark:text-white block mt-0.5">
                                        Hotline <?php echo esc_html( $cfg['ojk_phone'] ); ?>
                                    </span>
                                </div>
                            </div>



                            <!-- LAPS SJK -->
                            <div class="p-3.5 rounded-2xl bg-slate-50/90 dark:bg-dark-surface-alt border border-slate-200/80 dark:border-dark-border text-xs text-slate-600 dark:text-slate-300">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.97zM6.75 4.97L4.13 15.696c-.121.499.107 1.028.59 1.202a5.988 5.988 0 002.031.352 5.988 5.988 0 002.031-.352c.483-.174.711-.703.589-1.202L6.75 4.97z"/></svg>
                                        <span>LAPS Sektor Jasa Keuangan</span>
                                    </span>
                                    <a href="<?php echo esc_url( $cfg['laps_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="text-blue-600 dark:text-blue-400 font-bold hover:underline">
                                        lapssjk.id ↗
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <div class="pt-2">
                            <a 
                                href="<?php echo esc_url( $cfg['ojk_appk_url'] ); ?>" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                class="w-full py-3.5 px-6 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-extrabold shadow-lg shadow-blue-600/30 hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 text-center"
                            >
                                <span>Buka Portal APPK OJK</span>
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 3: ALUR PROSEDUR & STANDAR WAKTU RESMI (SLA POJK)
         DENGAN GAYA DUAL-TONE LENGKAP (KONTROL AKTIF/NONAKTIF DARI ADMIN)
         ======================================================================== -->
    <?php if ( ! empty( $cfg['alur_show'] ) ) : ?>
    <section class="py-14 md:py-20 bg-white/80 dark:bg-dark-surface/60 border-y border-slate-200/80 dark:border-dark-border/80 relative">
        <div class="container-wide">
            
            <div class="text-center max-w-3xl mx-auto mb-14" data-aos="fade-up">
                <span class="text-xs font-extrabold text-emerald-600 dark:text-teal-400 uppercase tracking-widest block mb-2">
                    Prosedur &amp; Regulasi OJK
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white">
                    Alur Penanganan Pengaduan Nasabah
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2">
                    BPRS Wakalumi menerapkan standar operasional penanganan pengaduan yang transparan, terukur, dan akuntabel berpedoman pada POJK No. 22 Tahun 2023.
                </p>
            </div>

            <!-- 4-Step Process Grid (Dual-Tone Design with Hover Lift) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-14">
                
                <!-- Step 1: Teal / Cyan Accent -->
                <div class="spotlight-card group relative rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border hover:border-teal-400/90 dark:hover:border-teal-500/80 shadow-sm hover:shadow-xl hover:shadow-teal-500/10 hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between overflow-hidden" data-aos="fade-up" data-aos-delay="50">
                    
                    <!-- Top Accent Border -->
                    <div class="h-1.5 w-full bg-gradient-to-r from-teal-500 to-cyan-400"></div>

                    <div>
                        <!-- TONE 1: TINTED HEADER BAR -->
                        <div class="p-5 bg-gradient-to-br from-teal-50/90 via-cyan-50/40 to-white/10 dark:from-teal-950/50 dark:via-dark-card dark:to-dark-card border-b border-teal-100/80 dark:border-teal-900/40 flex items-center justify-between relative overflow-hidden">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-teal-600 text-white flex items-center justify-center font-black text-base shadow-md shadow-teal-600/30 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 flex-shrink-0">
                                    01
                                </div>
                                <div>
                                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-700 dark:text-teal-300 block">Langkah Awal</span>
                                    <span class="text-xs font-black text-slate-800 dark:text-slate-200">Penerimaan</span>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-teal-100/70 dark:bg-teal-900/60 text-teal-700 dark:text-teal-300 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </div>
                        </div>

                        <!-- TONE 2: BODY DESCRIPTION -->
                        <div class="p-5 sm:p-6 space-y-3">
                            <h4 class="text-base font-extrabold text-slate-900 dark:text-white group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                                Penyampaian &amp; Registrasi
                            </h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                Nasabah menyampaikan aduan melalui saluran WhatsApp, telepon, loket, atau surat resmi disertai bukti pendukung transaksi.
                            </p>
                        </div>
                    </div>

                    <!-- Card Output Footer -->
                    <div class="px-5 pb-5 pt-0">
                        <div class="p-2.5 rounded-xl bg-teal-50/70 dark:bg-teal-950/40 border border-teal-100 dark:border-teal-900/40 text-[11px] font-bold text-teal-800 dark:text-teal-300 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                            <span>Output: Nomor Registrasi Aduan</span>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Blue / Indigo Accent -->
                <div class="spotlight-card group relative rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border hover:border-blue-400/90 dark:hover:border-blue-500/80 shadow-sm hover:shadow-xl hover:shadow-blue-500/10 hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    
                    <!-- Top Accent Border -->
                    <div class="h-1.5 w-full bg-gradient-to-r from-blue-600 to-indigo-500"></div>

                    <div>
                        <!-- TONE 1: TINTED HEADER BAR -->
                        <div class="p-5 bg-gradient-to-br from-blue-50/90 via-indigo-50/40 to-white/10 dark:from-blue-950/50 dark:via-dark-card dark:to-dark-card border-b border-blue-100/80 dark:border-blue-900/40 flex items-center justify-between relative overflow-hidden">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-black text-base shadow-md shadow-blue-600/30 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 flex-shrink-0">
                                    02
                                </div>
                                <div>
                                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-blue-700 dark:text-blue-300 block">Langkah Kedua</span>
                                    <span class="text-xs font-black text-slate-800 dark:text-slate-200">Verifikasi</span>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-blue-100/70 dark:bg-blue-900/60 text-blue-700 dark:text-blue-300 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                            </div>
                        </div>

                        <!-- TONE 2: BODY DESCRIPTION -->
                        <div class="p-5 sm:p-6 space-y-3">
                            <h4 class="text-base font-extrabold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                Validasi &amp; Berkas
                            </h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                Petugas memverifikasi keabsahan identitas nasabah, mencocokkan kronologis, serta memastikan kelengkapan dokumen pendukung.
                            </p>
                        </div>
                    </div>

                    <!-- Card Output Footer -->
                    <div class="px-5 pb-5 pt-0">
                        <div class="p-2.5 rounded-xl bg-blue-50/70 dark:bg-blue-950/40 border border-blue-100 dark:border-blue-900/40 text-[11px] font-bold text-blue-800 dark:text-blue-300 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                            <span>Output: Berita Acara &amp; Checklist Dokumen</span>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Amber / Orange Accent -->
                <div class="spotlight-card group relative rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border hover:border-amber-400/90 dark:hover:border-amber-500/80 shadow-sm hover:shadow-xl hover:shadow-amber-500/10 hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between overflow-hidden" data-aos="fade-up" data-aos-delay="150">
                    
                    <!-- Top Accent Border -->
                    <div class="h-1.5 w-full bg-gradient-to-r from-amber-500 to-orange-400"></div>

                    <div>
                        <!-- TONE 1: TINTED HEADER BAR -->
                        <div class="p-5 bg-gradient-to-br from-amber-50/90 via-orange-50/40 to-white/10 dark:from-amber-950/50 dark:via-dark-card dark:to-dark-card border-b border-amber-100/80 dark:border-amber-900/40 flex items-center justify-between relative overflow-hidden">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-amber-600 text-white flex items-center justify-center font-black text-base shadow-md shadow-amber-600/30 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 flex-shrink-0">
                                    03
                                </div>
                                <div>
                                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-amber-700 dark:text-amber-300 block">Langkah Ketiga</span>
                                    <span class="text-xs font-black text-slate-800 dark:text-slate-200">Investigasi</span>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-amber-100/70 dark:bg-amber-900/60 text-amber-700 dark:text-amber-300 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.97zM6.75 4.97L4.13 15.696c-.121.499.107 1.028.59 1.202a5.988 5.988 0 002.031.352 5.988 5.988 0 002.031-.352c.483-.174.711-.703.589-1.202L6.75 4.97z"/></svg>
                            </div>
                        </div>

                        <!-- TONE 2: BODY DESCRIPTION -->
                        <div class="p-5 sm:p-6 space-y-3">
                            <h4 class="text-base font-extrabold text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                                Pemeriksaan &amp; Analisis
                            </h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                Pemeriksaan catatan sistem perbankan syariah secara komprehensif, konfirmasi organ terkait, dan perumusan solusi berkeadilan.
                            </p>
                        </div>
                    </div>

                    <!-- Card Output Footer -->
                    <div class="px-5 pb-5 pt-0">
                        <div class="p-2.5 rounded-xl bg-amber-50/70 dark:bg-amber-950/40 border border-amber-100 dark:border-amber-900/40 text-[11px] font-bold text-amber-800 dark:text-amber-300 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            <span>Output: Kajian Solusi Sesuai Syariah</span>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Emerald Accent -->
                <div class="spotlight-card group relative rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border hover:border-emerald-400/90 dark:hover:border-emerald-500/80 shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    
                    <!-- Top Accent Border -->
                    <div class="h-1.5 w-full bg-gradient-to-r from-emerald-600 to-teal-500"></div>

                    <div>
                        <!-- TONE 1: TINTED HEADER BAR -->
                        <div class="p-5 bg-gradient-to-br from-emerald-50/90 via-teal-50/40 to-white/10 dark:from-emerald-950/50 dark:via-dark-card dark:to-dark-card border-b border-emerald-100/80 dark:border-emerald-900/40 flex items-center justify-between relative overflow-hidden">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-black text-base shadow-md shadow-emerald-600/30 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 flex-shrink-0">
                                    04
                                </div>
                                <div>
                                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-700 dark:text-emerald-300 block">Langkah Akhir</span>
                                    <span class="text-xs font-black text-slate-800 dark:text-slate-200">Penyelesaian</span>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-emerald-100/70 dark:bg-emerald-900/60 text-emerald-700 dark:text-emerald-300 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </div>

                        <!-- TONE 2: BODY DESCRIPTION -->
                        <div class="p-5 sm:p-6 space-y-3">
                            <h4 class="text-base font-extrabold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                Tanggapan &amp; Solusi Resmi
                            </h4>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                Penyampaian hasil penyelesaian kepada nasabah secara tertulis atau lisan sesuai ketentuan batas waktu (SLA) yang berlaku.
                            </p>
                        </div>
                    </div>

                    <!-- Card Output Footer -->
                    <div class="px-5 pb-5 pt-0">
                        <div class="p-2.5 rounded-xl bg-emerald-50/70 dark:bg-emerald-950/40 border border-emerald-100 dark:border-emerald-900/40 text-[11px] font-bold text-emerald-800 dark:text-emerald-300 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Output: Surat Tanggapan Resmi Bank</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ========================================================================
         SECTION: STANDAR WAKTU LAYANAN PENGADUAN (SLA RESMI POJK)
         DIBUAT SIMETRIS, RAPI, BERSIH, DAN DAPAT DIATUR AKTIF/NONAKTIF DARI CMS
         ======================================================================== -->
    <?php if ( ! empty( $cfg['sla_show'] ) ) : ?>
    <section class="py-12 md:py-16 bg-slate-100/70 dark:bg-dark-surface/40 border-b border-slate-200/80 dark:border-dark-border/80 relative">
        <div class="container-wide">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-black uppercase tracking-wider mb-3 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                    <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Komitmen Kepastian Waktu</span>
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    Standar Waktu Layanan Pengaduan (SLA)
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-2 leading-relaxed">
                    BPRS Wakalumi menjamin setiap pengaduan nasabah diselesaikan secara tepat waktu, profesional, dan transparan berpedoman pada POJK No. 22 Tahun 2023.
                </p>
            </div>

            <!-- 2 Symmetrical Sized Cards Grid (Exact Equal Height & Proportions) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto mb-6">
                
                <!-- CARD 1: PENGADUAN LISAN -->
                <div class="spotlight-card group relative rounded-3xl bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border hover:border-emerald-400 dark:hover:border-emerald-500/80 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between" data-aos="fade-up" data-aos-delay="50">
                    
                    <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] 
                                w-48 h-48 sm:w-56 sm:h-56
                                opacity-[0.035] dark:opacity-[0.055] 
                                pointer-events-none select-none 
                                transition-all duration-700 ease-out 
                                group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 
                                group-hover:opacity-[0.08] dark:group-hover:opacity-[0.14] 
                                grayscale mix-blend-multiply dark:mix-blend-screen overflow-hidden z-0">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain">
                    </div>

                    <div class="h-1.5 w-full bg-emerald-500 relative z-10"></div>

                    <!-- Top Bar (Tone 1) -->
                    <div class="p-5 bg-emerald-50/80 dark:bg-emerald-950/40 border-b border-emerald-100 dark:border-emerald-900/40 flex items-center justify-between relative z-10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center shadow-md shadow-emerald-500/25 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                            </div>
                            <div>
                                <span class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-wider block">Pengaduan Lisan</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400">Telepon, WhatsApp, atau Tatap Muka</span>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/60 text-emerald-800 dark:text-emerald-300 text-[11px] font-extrabold flex-shrink-0">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                            Proses Cepat
                        </span>
                    </div>

                    <!-- Body (Tone 2) -->
                    <div class="p-6 space-y-4 relative z-10">
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl sm:text-4xl font-black text-emerald-600 dark:text-emerald-400 tracking-tight">
                                <?php echo esc_html( $display_sla_lisan ); ?>
                            </span>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Maksimal</span>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            Penyelesaian langsung melalui tim customer care atau loket kantor kas. Bila membutuhkan dokumen pendukung tambahan, aduan akan dialihkan menjadi tertulis.
                        </p>
                        
                        <div class="pt-3 border-t border-slate-100 dark:border-dark-border space-y-2 text-xs text-slate-600 dark:text-slate-400">
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Pencatatan langsung & konfirmasi nomor tanda terima</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Pemberitahuan hasil via telepon atau WhatsApp resmi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: PENGADUAN TERTULIS -->
                <div class="spotlight-card group relative rounded-3xl bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border hover:border-teal-400 dark:hover:border-teal-500/80 shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                    
                    <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] 
                                w-48 h-48 sm:w-56 sm:h-56
                                opacity-[0.035] dark:opacity-[0.055] 
                                pointer-events-none select-none 
                                transition-all duration-700 ease-out 
                                group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 
                                group-hover:opacity-[0.08] dark:group-hover:opacity-[0.14] 
                                grayscale mix-blend-multiply dark:mix-blend-screen overflow-hidden z-0">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/logo-new-1.png' ); ?>" alt="" class="w-full h-full object-contain">
                    </div>

                    <div class="h-1.5 w-full bg-teal-600 relative z-10"></div>

                    <!-- Top Bar (Tone 1) -->
                    <div class="p-5 bg-teal-50/80 dark:bg-teal-950/40 border-b border-teal-100 dark:border-teal-900/40 flex items-center justify-between relative z-10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-teal-600 text-white flex items-center justify-center shadow-md shadow-teal-600/25 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                            </div>
                            <div>
                                <span class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-wider block">Pengaduan Tertulis</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400">Surat Resmi, Berkas, atau Email</span>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-teal-100 dark:bg-teal-900/60 text-teal-800 dark:text-teal-300 text-[11px] font-extrabold flex-shrink-0">
                            Investigasi Penuh
                        </span>
                    </div>

                    <!-- Body (Tone 2) -->
                    <div class="p-6 space-y-4">
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl sm:text-4xl font-black text-teal-600 dark:text-teal-400 tracking-tight">
                                <?php echo esc_html( $display_sla_tertulis ); ?>
                            </span>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Maksimal</span>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            Penanganan komprehensif yang melibatkan verifikasi data sistem transaksi, audit kronologis, dan penerbitan tanggapan tertulis resmi.
                        </p>
                        
                        <div class="pt-3 border-t border-slate-100 dark:border-dark-border space-y-2 text-xs text-slate-600 dark:text-slate-400">
                            <div class="flex items-center gap-2">
                                <span class="text-teal-500 font-bold">✓</span>
                                <span>Penerbitan surat tanda terima & nomor registrasi</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-teal-500 font-bold">✓</span>
                                <span>Surat tanggapan tertulis resmi bersegel bank</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sleek Legal Notice Strip (POJK No. 22 Tahun 2023) -->
            <div class="max-w-4xl mx-auto p-4 rounded-2xl bg-white/95 dark:bg-dark-card/95 border border-slate-200/80 dark:border-dark-border flex items-start gap-3 shadow-xs">
                <div class="w-6 h-6 rounded-lg bg-teal-100 dark:bg-teal-950 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0 text-xs mt-0.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.97zM6.75 4.97L4.13 15.696c-.121.499.107 1.028.59 1.202a5.988 5.988 0 002.031.352 5.988 5.988 0 002.031-.352c.483-.174.711-.703.589-1.202L6.75 4.97z"/></svg>
                </div>
                <div class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                    <strong class="text-slate-900 dark:text-white">Ketentuan Perpanjangan Waktu (POJK No. 22/2023 Pasal 57):</strong>
                    <?php echo esc_html( $sla_note ); ?>
                </div>
            </div>

        </div>
    </section>
    <?php endif; ?>

    <!-- ========================================================================
         SECTION 4: PANDUAN KONSUMEN & PERSYARATAN DOKUMEN PENGADUAN
         (KONTROL AKTIF/NONAKTIF DARI ADMIN)
         ======================================================================== -->
    <?php if ( ! empty( $cfg['panduan_show'] ) ) : ?>
    <section class="py-14 md:py-20 bg-transparent relative">
        <div class="container-wide">
            
            <?php if ( ! empty( $cfg['show_form_pdf'] ) ) : ?>
                <!-- TAMPILAN JIKA FORMULIR CETAK FISIK DIAKTIFKAN OLEH ADMIN -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Left: Checklist Persyaratan Berkas -->
                    <div class="lg:col-span-7" data-aos="fade-up">
                        <span class="text-xs font-extrabold text-teal-600 dark:text-teal-400 uppercase tracking-widest block mb-2">
                            Panduan Konsumen
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mb-4">
                            Persyaratan Dokumen Pengaduan
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                            Agar pengaduan dapat segera diverifikasi dan diproses tanpa hambatan, mohon menyiapkan dokumen pendukung berikut saat menyampaikan aduan:
                        </p>

                        <div class="space-y-3.5">
                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-white/90 dark:bg-dark-card/90 border border-slate-200/80 dark:border-dark-border shadow-xs">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold text-xs">✓</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-900 dark:text-white block">Identitas Diri yang Sah</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Fotokopi/Scan KTP untuk WNI, atau Paspor/KITAS bagi Warga Negara Asing.</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-white/90 dark:bg-dark-card/90 border border-slate-200/80 dark:border-dark-border shadow-xs">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold text-xs">✓</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-900 dark:text-white block">Bukti Kepemilikan Rekening / Akad</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Buku tabungan, bilyet deposito, atau salinan akad perjanjian pembiayaan syariah.</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-white/90 dark:bg-dark-card/90 border border-slate-200/80 dark:border-dark-border shadow-xs">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold text-xs">✓</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-900 dark:text-white block">Bukti Transaksi Keuangan Terkait</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Struk transfer, mutasi rekening, bukti setoran, atau nota konfirmasi transaksi.</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-white/90 dark:bg-dark-card/90 border border-slate-200/80 dark:border-dark-border shadow-xs">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold text-xs">✓</div>
                                <div>
                                    <span class="text-sm font-bold text-slate-900 dark:text-white block">Surat Kuasa Khusus (Jika Diwakilkan)</span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400">Bermaterai cukup dan dilampiri identitas pemberi kuasa dan penerima kuasa.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Unduh Formulir PDF Card -->
                    <div class="lg:col-span-5" data-aos="fade-up" data-aos-delay="100">
                        <div class="spotlight-card group relative p-7 sm:p-8 rounded-3xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-teal-200/80 dark:border-teal-800/80 shadow-xl overflow-hidden text-center">
                            
                            <div class="absolute -right-12 -top-12 w-36 h-36 bg-teal-400/10 rounded-full blur-2xl pointer-events-none"></div>

                            <!-- PDF Icon -->
                            <div class="w-16 h-16 rounded-2xl bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 flex items-center justify-center mx-auto mb-4 border border-teal-200/60 dark:border-teal-800/60 shadow-sm group-hover:scale-105 transition-transform">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                            </div>

                            <span class="text-xs font-extrabold text-teal-700 dark:text-teal-300 uppercase tracking-wider block mb-1">
                                Formulir Cetak Fisik
                            </span>
                            <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white mb-2">
                                Formulir Pengaduan Nasabah
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed mb-6">
                                Unduh formulir resmi format PDF untuk dicetak dan diisi secara manual, lalu diserahkan ke kantor cabang terdekat atau dikirim via email.
                            </p>

                            <a 
                                href="<?php echo esc_url( $pdf_link ); ?>" 
                                <?php echo $has_pdf_file ? 'download target="_blank" rel="noopener noreferrer"' : 'target="_blank" rel="noopener noreferrer"'; ?>
                                class="inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-2xl bg-teal-600 hover:bg-teal-700 text-white text-xs sm:text-sm font-extrabold shadow-md shadow-teal-600/30 hover:-translate-y-0.5 transition-all w-full"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                <span><?php echo $has_pdf_file ? 'Unduh Berkas Formulir (PDF)' : 'Minta Formulir via WhatsApp'; ?></span>
                            </a>

                            <div class="mt-4 pt-4 border-t border-slate-100 dark:border-dark-border text-[11px] text-slate-400">
                                Format Berkas: PDF Resmi • Standar Perlindungan Konsumen
                            </div>
                        </div>
                    </div>

                </div>
            <?php else : ?>
                <!-- TAMPILAN PENUH LEBAR & INFORMATIF (KETIKA FORMULIR PDF DINONAKTIFKAN / BELUM TERSEDIA) -->
                <div data-aos="fade-up">
                    <div class="text-center max-w-3xl mx-auto mb-12">
                        <span class="text-xs font-extrabold text-teal-600 dark:text-teal-400 uppercase tracking-widest block mb-2">
                            Panduan Konsumen
                        </span>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 dark:text-white">
                            Persyaratan Dokumen &amp; Tips Pengaduan
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2">
                            Agar proses penanganan berjalan cepat, tepat, dan akurat, mohon melengkapi berkas pendukung berikut saat mengajukan pengaduan:
                        </p>
                    </div>

                    <!-- 4-Card Document Checklist Grid (Dual-Tone) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                        
                        <!-- Doc 1: Identitas -->
                        <div class="spotlight-card group rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border hover:border-emerald-400/90 dark:hover:border-emerald-500/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                            <div class="h-1.5 w-full bg-emerald-500"></div>
                            
                            <!-- Tone 1 Header -->
                            <div class="p-4 bg-emerald-50/70 dark:bg-emerald-950/40 border-b border-emerald-100/80 dark:border-emerald-900/40 flex items-center justify-between">
                                <span class="text-xs font-extrabold text-emerald-800 dark:text-emerald-300 uppercase tracking-wider">Dokumen 1</span>
                                <span class="text-[10px] font-black px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-900/70 dark:text-emerald-300">Wajib</span>
                            </div>

                            <!-- Tone 2 Body -->
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-2.5">
                                <div>
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100/80 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold mb-3">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.364a4.125 4.125 0 00-6.338 0"/></svg>
                                    </div>
                                    <h4 class="text-sm font-black text-slate-900 dark:text-white">Identitas Diri yang Sah</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed mt-1">
                                        Fotokopi / Scan KTP asli bagi WNI yang masih berlaku, atau Paspor &amp; KITAS sah bagi Warga Negara Asing (WNA).
                                    </p>
                                </div>
                                <div class="text-[11px] text-slate-400 pt-2 border-t border-slate-100 dark:border-dark-border">
                                    Verifikasi Kependudukan
                                </div>
                            </div>
                        </div>

                        <!-- Doc 2: Rekening / Bilyet -->
                        <div class="spotlight-card group rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border hover:border-teal-400/90 dark:hover:border-teal-500/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                            <div class="h-1.5 w-full bg-teal-500"></div>
                            
                            <!-- Tone 1 Header -->
                            <div class="p-4 bg-teal-50/70 dark:bg-teal-950/40 border-b border-teal-100/80 dark:border-teal-900/40 flex items-center justify-between">
                                <span class="text-xs font-extrabold text-teal-800 dark:text-teal-300 uppercase tracking-wider">Dokumen 2</span>
                                <span class="text-[10px] font-black px-2 py-0.5 rounded-full bg-teal-100 text-teal-800 dark:bg-teal-900/70 dark:text-teal-300">Wajib</span>
                            </div>

                            <!-- Tone 2 Body -->
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-2.5">
                                <div>
                                    <div class="w-10 h-10 rounded-xl bg-teal-100/80 dark:bg-teal-950 text-teal-600 dark:text-teal-400 flex items-center justify-center font-bold mb-3">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                                    </div>
                                    <h4 class="text-sm font-black text-slate-900 dark:text-white">Buku Rekening / Akad</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed mt-1">
                                        Buku tabungan, sertifikat bilyet deposito syariah, atau salinan akad perjanjian pembiayaan yang bersangkutan.
                                    </p>
                                </div>
                                <div class="text-[11px] text-slate-400 pt-2 border-t border-slate-100 dark:border-dark-border">
                                    Bukti Legalitas Kepemilikan
                                </div>
                            </div>
                        </div>

                        <!-- Doc 3: Bukti Transaksi -->
                        <div class="spotlight-card group rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border hover:border-blue-400/90 dark:hover:border-blue-500/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                            <div class="h-1.5 w-full bg-blue-500"></div>
                            
                            <!-- Tone 1 Header -->
                            <div class="p-4 bg-blue-50/70 dark:bg-blue-950/40 border-b border-blue-100/80 dark:border-blue-900/40 flex items-center justify-between">
                                <span class="text-xs font-extrabold text-blue-800 dark:text-blue-300 uppercase tracking-wider">Dokumen 3</span>
                                <span class="text-[10px] font-black px-2 py-0.5 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/70 dark:text-blue-300">Wajib</span>
                            </div>

                            <!-- Tone 2 Body -->
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-2.5">
                                <div>
                                    <div class="w-10 h-10 rounded-xl bg-blue-100/80 dark:bg-blue-950 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold mb-3">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5l-.9-1.2a1.5 1.5 0 00-2.4 0L12 21l-1.7-2.2a1.5 1.5 0 00-2.4 0L6 21l-.9-1.2A1.5 1.5 0 003.5 19H3V5a2 2 0 012-2h14a2 2 0 012 2v14h-.5a1.5 1.5 0 00-1.6.8L19 21z"/></svg>
                                    </div>
                                    <h4 class="text-sm font-black text-slate-900 dark:text-white">Bukti Transaksi Terkait</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed mt-1">
                                        Struk transfer ATM/kantor, bukti mutasi rekening, slip setoran, atau nota konfirmasi mutasi dana yang dipermasalahkan.
                                    </p>
                                </div>
                                <div class="text-[11px] text-slate-400 pt-2 border-t border-slate-100 dark:border-dark-border">
                                    Pemeriksaan Finansial
                                </div>
                            </div>
                        </div>

                        <!-- Doc 4: Surat Kuasa -->
                        <div class="spotlight-card group rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border hover:border-amber-400/90 dark:hover:border-amber-500/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                            <div class="h-1.5 w-full bg-amber-500"></div>
                            
                            <!-- Tone 1 Header -->
                            <div class="p-4 bg-amber-50/70 dark:bg-amber-950/40 border-b border-amber-100/80 dark:border-amber-900/40 flex items-center justify-between">
                                <span class="text-xs font-extrabold text-amber-800 dark:text-amber-300 uppercase tracking-wider">Dokumen 4</span>
                                <span class="text-[10px] font-black px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 dark:bg-amber-900/70 dark:text-amber-300">Kondisional</span>
                            </div>

                            <!-- Tone 2 Body -->
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-2.5">
                                <div>
                                    <div class="w-10 h-10 rounded-xl bg-amber-100/80 dark:bg-amber-950 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold mb-3">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/></svg>
                                    </div>
                                    <h4 class="text-sm font-black text-slate-900 dark:text-white">Surat Kuasa Khusus</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed mt-1">
                                        Surat kuasa bermaterai cukup dan identitas pihak penerima kuasa, wajib disertakan jika pengaduan diwakilkan.
                                    </p>
                                </div>
                                <div class="text-[11px] text-slate-400 pt-2 border-t border-slate-100 dark:border-dark-border">
                                    Bila Diwakilkan Pihak Lain
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Informative Guidelines Strip: Tips Kelancaran Pengaduan -->
                    <div class="p-6 sm:p-7 rounded-3xl bg-slate-100/80 dark:bg-dark-surface-alt border border-slate-200/80 dark:border-dark-border">
                        <div class="flex items-center gap-2.5 mb-4">
                            <div class="w-8 h-8 rounded-xl bg-teal-100 dark:bg-teal-950 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.385a16.5 16.5 0 01-3 0M9.75 2.25a6.75 6.75 0 0111.25 5.25c0 2.5-1.5 4.5-3 5.5v1.5h-4.5v-1.5c-1.5-1-3-3-3-5.5a6.75 6.75 0 01-0.75-2.25z"/></svg>
                            </div>
                            <h4 class="text-sm sm:text-base font-black text-slate-900 dark:text-white">
                                Tips Menyampaikan Pengaduan Agar Cepat Tertangani
                            </h4>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs text-slate-600 dark:text-slate-300">
                            <div class="flex items-start gap-2.5">
                                <span class="text-teal-600 dark:text-teal-400 font-bold">1.</span>
                                <span><strong>Rincikan Kronologis:</strong> Sertakan tanggal transaksi, jam perkiraan, nominal angka, dan pihak yang terlibat secara jelas.</span>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <span class="text-teal-600 dark:text-teal-400 font-bold">2.</span>
                                <span><strong>Simpan Bukti Asli:</strong> Simpan struk cetak ATM, tangkapan layar (screenshot), atau nota resmi sampai proses pengaduan tuntas.</span>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <span class="text-teal-600 dark:text-teal-400 font-bold">3.</span>
                                <span><strong>Gunakan Saluran Resmi:</strong> Pastikan hanya berkomunikasi melalui nomor WhatsApp dan saluran terdaftar di website resmi BPRS Wakalumi.</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
