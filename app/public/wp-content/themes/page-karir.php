<?php
/**
 * Template Name: Halaman Karir & Rekrutmen
 * Description: Direktori Peluang Karir, Lowongan Kerja Aktif, Alur Rekrutmen 4 Tahap, dan Integrasi Tautan Pendaftaran Google Form Insan Bank Syariah Wakalumi (BSW).
 * 
 * @package Wakalumi
 */

get_header();

// ── DATA RETRIEVAL ──────────────────────────────────────────────────
$header    = wakalumi_get_karir_header();
$values    = wakalumi_get_karir_values();
$stages    = wakalumi_get_karir_stages();
$antifraud = wakalumi_get_karir_antifraud();
$all_jobs  = wakalumi_get_karir_jobs();
$cta       = wakalumi_get_karir_cta();

$total_jobs = count( $all_jobs );
$open_jobs  = count( array_filter( $all_jobs, fn( $x ) => ( $x['status'] ?? 'dibuka' ) === 'dibuka' ) );

// Extract unique divisions from active jobs for filter tabs
$job_divisions = [
    'all' => 'Semua Posisi',
];
foreach ( $all_jobs as $j ) {
    $slug = $j['divisi'] ?? 'umum';
    $name = ! empty( $j['divisi_lbl'] ) ? $j['divisi_lbl'] : ucfirst( $slug );
    if ( ! isset( $job_divisions[ $slug ] ) ) {
        $job_divisions[ $slug ] = $name;
    }
}
?>

<div class="min-h-screen bg-transparent text-slate-800 dark:text-dark-text pb-24">

    <!-- ========================================================================
         SECTION 1: HERO HEADER BANNER & RECRUITMENT STATUS
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
                <span class="text-slate-500 dark:text-slate-400 font-medium">Informasi</span>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <span class="text-teal-600 dark:text-teal-400 font-semibold">Karir &amp; Rekrutmen</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                <!-- Left Column: Title & Narrative -->
                <div class="lg:col-span-7 xl:col-span-7" data-aos="fade-up">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/90 dark:bg-teal-950/70 border border-teal-300/80 dark:border-teal-700/60 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        <?php echo esc_html( $header['badge'] ); ?>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                        <?php echo esc_html( $header['title'] ); ?>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl">
                        <?php echo esc_html( $header['desc'] ); ?>
                    </p>

                    <!-- Trust Highlights Pills -->
                    <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-semibold">
                            <span class="w-2.5 h-2.5 rounded-full <?php echo $open_jobs > 0 ? 'bg-emerald-500 animate-pulse' : 'bg-amber-500'; ?>"></span>
                            <span><?php echo $open_jobs > 0 ? $open_jobs . ' Posisi Sedang Dibuka' : 'Formasi Saat Ini Terisi Penuh'; ?></span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                            <span>100% Bebas Biaya Rekrutmen</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span>Prinsip Muamalah Syariah</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Elevated Status & Portal Verification Card -->
                <div class="lg:col-span-5 xl:col-span-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-[1.5px] rounded-3xl bg-gradient-to-br from-teal-400 via-emerald-400 to-cyan-500 shadow-xl shadow-teal-500/10 group">
                        <div class="relative rounded-[22px] p-6 sm:p-7 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl overflow-hidden">
                            <!-- Glass Shine Glint -->
                            <div class="wkl-glass-shine"></div>

                            <div class="relative z-10 space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-teal-100/90 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border border-teal-300/70 dark:border-teal-700/60 shadow-2xs">
                                        Portal Rekrutmen Resmi
                                    </span>
                                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 tracking-wide">
                                        PT BSW
                                    </span>
                                </div>

                                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white leading-snug">
                                    Proses Seleksi Transparan &amp; Berorientasi Integritas
                                </h3>

                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                                    Seluruh penerimaan karyawan dilaksanakan secara objektif melalui formulir daring resmi. Kami menyambut insan profesional yang berintegritas tinggi untuk memajukan ekonomi syariah.
                                </p>

                                <!-- Mini Metrics Inside Card -->
                                <div class="grid grid-cols-2 gap-3 pt-2">
                                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-dark-surface/70 border border-slate-200/80 dark:border-dark-border">
                                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Status Formasi</span>
                                        <span class="block text-xs sm:text-sm font-extrabold <?php echo $open_jobs > 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-amber-600 dark:text-amber-400'; ?> mt-0.5">
                                            <?php echo $open_jobs > 0 ? $open_jobs . ' Posisi Terbuka' : 'Terisi Penuh'; ?>
                                        </span>
                                    </div>
                                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-dark-surface/70 border border-slate-200/80 dark:border-dark-border">
                                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Biaya Seleksi</span>
                                        <span class="block text-xs sm:text-sm font-extrabold text-teal-700 dark:text-teal-300 mt-0.5">
                                            100% Gratis (Rp 0)
                                        </span>
                                    </div>
                                </div>

                                <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between gap-3 text-xs">
                                    <span class="text-slate-500 dark:text-slate-400 font-medium">
                                        Ketersediaan posisi formasi
                                    </span>
                                    <a href="#daftar-lowongan" class="inline-flex items-center gap-1.5 text-teal-700 dark:text-teal-300 font-extrabold hover:underline">
                                        <span>Cek Status Formasi</span>
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
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
         SECTION 2: NILAI & BUDAYA KERJA INSAN BSW (WHY JOIN US)
         ======================================================================== -->
    <section class="section py-16 sm:py-20 relative z-10 bg-white dark:bg-dark-card border-b border-slate-200/80 dark:border-dark-border/80">
        <div class="container-wide">
            <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-200 dark:border-teal-800 mb-3 shadow-2xs">
                    Budaya Perusahaan
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    Mengapa Membangun Karir Bersama Bank Syariah Wakalumi?
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                    Kami meyakini bahwa keberkahan dan keberlanjutan bank bermula dari lingkungan kerja yang sehat, saling menghargai, dan menjunjung tinggi amanah syariat Islam.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ( $values as $idx => $val ) : ?>
                    <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-b from-teal-500/25 via-slate-200/60 to-emerald-400/20 dark:from-teal-500/30 dark:via-dark-border dark:to-teal-950/30 hover:from-teal-500 hover:to-emerald-400 hover:shadow-xl hover:shadow-teal-500/15 transition-all duration-500 group"
                         data-aos="fade-up" 
                         data-aos-delay="<?php echo $idx * 80; ?>">
                        
                        <div class="relative rounded-[22px] p-6 sm:p-7 bg-white/95 dark:bg-dark-surface/90 backdrop-blur-xl h-full flex flex-col justify-between overflow-hidden">
                            <!-- Glass Shine Glint -->
                            <div class="wkl-glass-shine"></div>

                            <div>
                                <!-- Top Row: Glowing Dual-Tone Icon Badge + Pilar Index -->
                                <div class="flex items-center justify-between gap-3 mb-5">
                                    <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl bg-gradient-to-br from-teal-50 to-teal-100/90 dark:from-teal-950/80 dark:to-teal-900/40 text-teal-700 dark:text-teal-300 flex items-center justify-center border border-teal-200/80 dark:border-teal-700/60 shadow-xs group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300">
                                        <?php if ( ( $val['icon'] ?? '' ) === 'shield' ) : ?>
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                                        <?php elseif ( ( $val['icon'] ?? '' ) === 'trending-up' ) : ?>
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
                                        <?php elseif ( ( $val['icon'] ?? '' ) === 'users' ) : ?>
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                                        <?php else : ?>
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                                        <?php endif; ?>
                                    </div>
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider font-mono bg-teal-50 dark:bg-teal-950/70 text-teal-700 dark:text-teal-300 border border-teal-200/80 dark:border-teal-800/80">
                                        Pilar 0<?php echo ( $idx + 1 ); ?>
                                    </span>
                                </div>

                                <!-- Title -->
                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white mb-2 leading-snug group-hover:text-teal-700 dark:group-hover:text-teal-300 transition-colors">
                                    <?php echo esc_html( $val['title'] ); ?>
                                </h3>

                                <!-- Description -->
                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                                    <?php echo esc_html( $val['desc'] ); ?>
                                </p>
                            </div>

                            <div class="pt-4 mt-5 border-t border-slate-100 dark:border-slate-800/80 flex items-center gap-1.5 text-[11px] font-bold text-teal-700 dark:text-teal-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                <span>Standar Insan BSW</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 3: ALUR & TAHAPAN REKRUTMEN (4 TAHAPAN RESMI BANK)
         ======================================================================== -->
    <section class="section py-16 sm:py-20 relative z-10 bg-slate-50/70 dark:bg-dark-surface/50 border-b border-slate-200/80 dark:border-dark-border/80">
        <div class="container-wide">
            <div class="max-w-3xl mx-auto text-center mb-12 sm:mb-16" data-aos="fade-up">
                <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-100/90 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border border-teal-300 dark:border-teal-700 mb-3 shadow-2xs">
                    Tahapan Seleksi Resmi
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    Alur Perekrutan Insan Bank Syariah Wakalumi
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                    Proses seleksi penerimaan karyawan di Bank Syariah Wakalumi dilaksanakan secara terstruktur, objektif, dan transparan melalui 4 tahapan utama:
                </p>
            </div>

            <!-- 4 Stages Timeline Cards with Progress Badges & Watermark Numbers -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative">
                <?php foreach ( $stages as $idx => $stg ) : 
                    $progress_pct = ( ( $idx + 1 ) * 25 );
                ?>
                    <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-b from-teal-400/25 via-slate-200/60 to-emerald-400/20 dark:from-teal-500/25 dark:via-dark-border dark:to-teal-950/30 hover:from-teal-500 hover:to-emerald-400 hover:shadow-xl hover:shadow-teal-500/15 transition-all duration-500 group"
                         data-aos="fade-up" 
                         data-aos-delay="<?php echo $idx * 100; ?>">
                        
                        <div class="relative rounded-[22px] p-6 sm:p-7 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl h-full flex flex-col justify-between overflow-hidden">
                            <!-- Glass Shine Glint -->
                            <div class="wkl-glass-shine"></div>

                            <!-- Big Stylized Watermark Number in Background -->
                            <div class="text-7xl font-black text-slate-900/[0.04] dark:text-white/[0.04] absolute -bottom-3 -right-2 select-none pointer-events-none group-hover:text-teal-500/[0.08] group-hover:scale-110 transition-all duration-300 font-mono">
                                <?php echo esc_html( $stg['step'] ); ?>
                            </div>

                            <div class="relative z-10">
                                <!-- Step Header: Step Label & Sequential Icon -->
                                <div class="flex items-center justify-between gap-3 mb-5">
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black tracking-wider bg-teal-100/90 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border border-teal-300/70">
                                        <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                                        <span>Tahap <?php echo esc_html( $stg['step'] ); ?></span>
                                    </div>
                                    <span class="w-9 h-9 rounded-full bg-slate-100 dark:bg-dark-surface text-teal-700 dark:text-teal-300 flex items-center justify-center font-black text-xs border border-slate-200 dark:border-dark-border shadow-xs group-hover:bg-teal-600 group-hover:text-white group-hover:border-teal-600 transition-colors">
                                        <?php echo ( $idx + 1 ); ?>
                                    </span>
                                </div>

                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 dark:text-white mb-2 leading-snug group-hover:text-teal-700 dark:group-hover:text-teal-300 transition-colors">
                                    <?php echo esc_html( $stg['title'] ); ?>
                                </h3>

                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-4">
                                    <?php echo esc_html( $stg['desc'] ); ?>
                                </p>
                            </div>

                            <!-- Step Progress Indicator -->
                            <div class="relative z-10 pt-4 mt-2 border-t border-slate-100 dark:border-slate-800/80 space-y-2">
                                <div class="flex items-center justify-between text-[11px] font-bold text-slate-500 dark:text-slate-400">
                                    <span>Langkah <?php echo ( $idx + 1 ); ?> dari 4</span>
                                    <span class="text-teal-600 dark:text-teal-400 font-mono"><?php echo $progress_pct; ?>%</span>
                                </div>
                                <div class="w-full h-1.5 rounded-full bg-slate-100 dark:bg-dark-surface overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-teal-500 to-emerald-400 rounded-full" style="width: <?php echo $progress_pct; ?>%;"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 4: DIREKTORI LOWONGAN PEKERJAAN & STATUS KETERSEDIAAN FORMASI
         ======================================================================== -->
    <section id="daftar-lowongan" class="section py-16 sm:py-20 relative z-10 bg-white dark:bg-dark-card border-b border-slate-200/80 dark:border-dark-border/80">
        <div class="container-wide">
            
            <?php if ( $total_jobs === 0 ) : ?>
                <!-- ================================================================
                     CENTERPIECE SHOWCASE: STATUS FORMASI KARIR SAAT INI BELUM DIBUKA
                     (Dignified corporate vacancy status, reassuring, no broken placeholders)
                     ================================================================ -->
                <div class="max-w-4xl mx-auto" data-aos="fade-up">
                    <div class="relative p-[2px] rounded-3xl bg-gradient-to-br from-teal-400/40 via-emerald-400/30 to-teal-600/40 shadow-xl shadow-teal-500/10 group overflow-hidden">
                        <div class="relative rounded-[22px] p-8 sm:p-12 md:p-14 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl overflow-hidden">
                            <!-- Glass Shine Reflection -->
                            <div class="wkl-glass-shine"></div>

                            <!-- Ambient Watermark Emblem in Background -->
                            <div class="absolute -right-12 -bottom-12 w-80 h-80 opacity-[0.035] pointer-events-none select-none">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain">
                            </div>

                            <div class="relative z-10 max-w-3xl mx-auto text-center space-y-6">
                                <!-- Status Badge -->
                                <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-amber-50 dark:bg-amber-950/70 border border-amber-300/80 dark:border-amber-700/80 text-amber-900 dark:text-amber-300 text-xs font-black uppercase tracking-wider shadow-2xs">
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    <span>Status Formasi: Belum Ada Pembukaan Rekrutmen Aktif</span>
                                </div>

                                <!-- Main Headline -->
                                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-snug">
                                    Terima Kasih Atas Ketertarikan Anda Berkarya Bersama Bank Syariah Wakalumi
                                </h2>

                                <!-- Narrative Explanation -->
                                <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl mx-auto">
                                    Saat ini seluruh formasi penempatan kerja insan perbankan syariah di lingkungan PT Bank Syariah Wakalumi (BSW) telah terisi penuh. Pembukaan gelombang rekrutmen formasi baru berikutnya akan selalu diumumkan secara transparan melalui portal resmi ini dan saluran media sosial resmi bank.
                                </p>

                                <!-- 3 Key Principles / Reassurance Cards Inside Centerpiece -->
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-left pt-6 pb-2">
                                    <div class="p-5 rounded-2xl bg-slate-50/90 dark:bg-dark-surface/80 border border-slate-200/80 dark:border-dark-border shadow-2xs">
                                        <div class="w-10 h-10 rounded-xl bg-teal-100 dark:bg-teal-950/80 text-teal-700 dark:text-teal-300 flex items-center justify-center mb-3 border border-teal-200 dark:border-teal-800">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                                        </div>
                                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white mb-1">100% Bebas Biaya</h4>
                                        <p class="text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Seluruh proses seleksi dan pendaftaran tidak pernah dipungut biaya apapun.</p>
                                    </div>

                                    <div class="p-5 rounded-2xl bg-slate-50/90 dark:bg-dark-surface/80 border border-slate-200/80 dark:border-dark-border shadow-2xs">
                                        <div class="w-10 h-10 rounded-xl bg-teal-100 dark:bg-teal-950/80 text-teal-700 dark:text-teal-300 flex items-center justify-center mb-3 border border-teal-200 dark:border-teal-800">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                                        </div>
                                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white mb-1">Kanal Resmi Daring</h4>
                                        <p class="text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Formulir pendaftaran resmi selalu menggunakan tautan Google Form BSW.</p>
                                    </div>

                                    <div class="p-5 rounded-2xl bg-slate-50/90 dark:bg-dark-surface/80 border border-slate-200/80 dark:border-dark-border shadow-2xs">
                                        <div class="w-10 h-10 rounded-xl bg-teal-100 dark:bg-teal-950/80 text-teal-700 dark:text-teal-300 flex items-center justify-center mb-3 border border-teal-200 dark:border-teal-800">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                                        </div>
                                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white mb-1">Kenali Budaya BSW</h4>
                                        <p class="text-[11px] sm:text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Kenali profil kepengurusan dan jajaran karyawan bank syariah kami.</p>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="pt-4 flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                                    <?php 
                                    $default_wa = get_option( 'options_contact_wa', '6281517380388' );
                                    $wa_clean   = preg_replace( '/[^0-9]/', '', (string) $default_wa );
                                    $wa_url     = 'https://wa.me/' . ( $wa_clean ?: '6281517380388' );
                                    ?>
                                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-teal-600 hover:bg-teal-700 text-white font-extrabold text-xs sm:text-sm shadow-lg shadow-teal-600/25 hover:scale-105 transition-all">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                        <span>Tanya Informasi SDM via WhatsApp</span>
                                    </a>
                                    <a href="<?php echo esc_url( home_url( '/informasi/tim-kami/' ) ); ?>" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 font-bold text-xs sm:text-sm border border-slate-200 dark:border-slate-700 transition-all hover:scale-105">
                                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                                        <span>Lihat Tim &amp; Profil Karyawan BSW</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else : ?>
                <!-- ================================================================
                     ACTIVE JOB DIRECTORY: SEARCH, FILTER TABS & JOB CARDS GRID
                     (Visible when open positions are configured by the admin)
                     ================================================================ -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10" data-aos="fade-up">
                    <div>
                        <span class="inline-block px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-100/90 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-300 dark:border-teal-700 mb-3 shadow-2xs">
                            Peluang Karir Aktif
                        </span>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                            Posisi Lowongan yang Tersedia
                        </h2>
                        <p class="mt-2 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed">
                            Pilih posisi yang sesuai dengan kompetensi dan pengalaman Anda, lalu lengkapi pendaftaran pada formulir daring resmi.
                        </p>
                    </div>

                    <!-- Search Input Bar -->
                    <div class="relative w-full md:w-80 flex-shrink-0">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        </span>
                        <input type="text" 
                               id="karir-search-input" 
                               placeholder="Cari posisi, divisi, lokasi..." 
                               class="w-full pl-10 pr-9 py-2.5 rounded-xl text-xs sm:text-sm bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all">
                        <button type="button" 
                                id="karir-search-clear" 
                                class="hidden absolute inset-y-0 right-0 items-center pr-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                            ✕
                        </button>
                    </div>
                </div>

                <!-- Division Filter Tabs -->
                <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 scrollbar-none" id="karir-division-tabs">
                    <?php foreach ( $job_divisions as $div_key => $div_name ) : ?>
                        <button type="button" 
                                data-filter="<?php echo esc_attr( $div_key ); ?>" 
                                class="karir-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-bold whitespace-nowrap transition-all duration-300 <?php echo $div_key === 'all' ? 'active bg-teal-600 text-white shadow-sm ring-2 ring-teal-500/50' : 'bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-teal-50 hover:text-teal-700 dark:hover:bg-slate-700'; ?>">
                            <?php echo esc_html( $div_name ); ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <!-- JOB CARDS GRID -->
                <div id="karir-job-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 sm:gap-8">
                    <?php 
                    foreach ( $all_jobs as $idx => $job ) : 
                        $posisi       = esc_attr( $job['posisi'] ?? '' );
                        $divisi       = esc_attr( $job['divisi'] ?? 'bisnis' );
                        $divisi_lbl   = esc_attr( $job['divisi_lbl'] ?? ucfirst( $divisi ) );
                        $tipe         = esc_attr( $job['tipe'] ?? 'Penuh Waktu' );
                        $lokasi       = esc_attr( $job['lokasi'] ?? 'Kantor Pusat' );
                        $deadline     = esc_attr( $job['deadline'] ?? '' );
                        $form_url     = esc_url( $job['form_url'] ?? '' );
                        $status       = esc_attr( $job['status'] ?? 'dibuka' );
                        $ringkasan    = esc_html( $job['ringkasan'] ?? '' );
                        $kualifikasi  = esc_attr( $job['kualifikasi'] ?? '' );

                        $search_keywords = strtolower( $posisi . ' ' . $divisi . ' ' . $divisi_lbl . ' ' . $tipe . ' ' . $lokasi );

                        $status_badge_text = 'Dibuka';
                        $status_badge_cls  = 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/80 dark:text-emerald-300 border-emerald-300/60';
                        if ( $status === 'segera' ) {
                            $status_badge_text = 'Segera Hadir';
                            $status_badge_cls  = 'bg-amber-100 text-amber-800 dark:bg-amber-950/80 dark:text-amber-300 border-amber-300/60';
                        } elseif ( $status === 'ditutup' ) {
                            $status_badge_text = 'Ditutup';
                            $status_badge_cls  = 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400 border-slate-300/60';
                        }
                    ?>
                        <div class="karir-job-card relative p-[1.5px] rounded-3xl bg-gradient-to-br from-teal-400/30 via-slate-200/70 to-emerald-400/25 dark:from-teal-500/30 dark:via-dark-border dark:to-teal-900/30 hover:from-teal-500 hover:to-emerald-400 hover:shadow-xl hover:shadow-teal-500/15 transition-all duration-300 group flex flex-col justify-between"
                             data-division="<?php echo $divisi; ?>"
                             data-keywords="<?php echo esc_attr( $search_keywords ); ?>"
                             data-aos="fade-up" 
                             data-aos-delay="<?php echo min( ( $idx % 2 ) * 100, 200 ); ?>">
                            
                            <div class="relative rounded-[22px] p-6 sm:p-8 bg-white/95 dark:bg-dark-surface/95 backdrop-blur-xl h-full flex flex-col justify-between overflow-hidden">
                                <!-- Glass Shine Glint -->
                                <div class="wkl-glass-shine"></div>

                                <div>
                                    <!-- Header of Job Card: Category + Status Badge -->
                                    <div class="flex items-center justify-between gap-3 mb-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-100/90 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border border-teal-300/70 dark:border-teal-700/60 shadow-2xs">
                                            <?php echo esc_html( $divisi_lbl ); ?>
                                        </span>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold border <?php echo $status_badge_cls; ?>">
                                            <span class="w-1.5 h-1.5 rounded-full <?php echo $status === 'dibuka' ? 'bg-emerald-500 animate-pulse' : ( $status === 'segera' ? 'bg-amber-500' : 'bg-slate-400' ); ?>"></span>
                                            <?php echo esc_html( $status_badge_text ); ?>
                                        </span>
                                    </div>

                                    <!-- Position Title -->
                                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white leading-snug mb-3 group-hover:text-teal-700 dark:group-hover:text-teal-300 transition-colors">
                                        <?php echo esc_html( $posisi ); ?>
                                    </h3>

                                    <!-- Meta Info Pills (Tipe Pekerjaan, Lokasi, Deadline) -->
                                    <div class="flex flex-wrap items-center gap-y-2 gap-x-4 text-xs sm:text-sm text-slate-600 dark:text-slate-300 mb-5">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/></svg>
                                            <span><?php echo esc_html( $tipe ); ?></span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                            <span><?php echo esc_html( $lokasi ); ?></span>
                                        </div>
                                        <?php if ( ! empty( $deadline ) ) : ?>
                                            <div class="flex items-center gap-1.5 text-amber-700 dark:text-amber-400 font-semibold">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <span>Batas: <?php echo esc_html( $deadline ); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Narrative Summary -->
                                    <?php if ( ! empty( $ringkasan ) ) : ?>
                                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-6 line-clamp-3">
                                            <?php echo $ringkasan; ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <!-- Card Action Buttons -->
                                <div class="pt-5 border-t border-slate-200/80 dark:border-dark-border flex flex-wrap items-center justify-between gap-3">
                                    <button type="button" 
                                            class="btn-open-job-modal inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-teal-700 dark:text-teal-300 hover:text-teal-800 dark:hover:text-teal-200 transition-colors"
                                            data-posisi="<?php echo $posisi; ?>"
                                            data-divisi="<?php echo $divisi_lbl; ?>"
                                            data-tipe="<?php echo $tipe; ?>"
                                            data-lokasi="<?php echo $lokasi; ?>"
                                            data-deadline="<?php echo $deadline; ?>"
                                            data-status="<?php echo $status; ?>"
                                            data-status-text="<?php echo $status_badge_text; ?>"
                                            data-status-cls="<?php echo $status_badge_cls; ?>"
                                            data-ringkasan="<?php echo esc_attr( $ringkasan ); ?>"
                                            data-kualifikasi="<?php echo $kualifikasi; ?>"
                                            data-url="<?php echo $form_url; ?>">
                                        <span>Lihat Kualifikasi Lengkap</span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                    </button>

                                    <?php if ( $status === 'dibuka' && ! empty( $form_url ) ) : ?>
                                        <a href="<?php echo esc_url( $form_url ); ?>" 
                                           target="_blank" rel="noopener noreferrer" 
                                           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs sm:text-sm shadow-sm hover:scale-105 transition-all">
                                            <span>Lamar Posisi Ini</span>
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                        </a>
                                    <?php elseif ( $status === 'segera' ) : ?>
                                        <span class="inline-flex items-center px-4 py-2 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-amber-800 dark:text-amber-300 font-bold text-xs border border-amber-200 dark:border-amber-800">
                                            Pendaftaran Segera Dibuka
                                        </span>
                                    <?php else : ?>
                                        <span class="inline-flex items-center px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 font-semibold text-xs border border-slate-200 dark:border-slate-700">
                                            Pendaftaran Ditutup
                                        </span>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- EMPTY STATE IF SEARCH YIELDS 0 (For active search queries) -->
                <div id="karir-empty-state" class="hidden text-center py-16 px-4">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-dark-surface text-slate-400 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Belum Ada Lowongan yang Cocok</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 max-w-md mx-auto mb-6">
                        Kriteria kata kunci atau divisi yang Anda pilih belum memiliki lowongan aktif yang sesuai. Silakan gunakan kata kunci lain atau reset filter.
                    </p>
                    <button type="button" id="karir-reset-btn" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold transition-all shadow-sm">
                        Reset Pencarian &amp; Filter
                    </button>
                </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ========================================================================
         SECTION 5: HIMBAUAN KEAMANAN & BEBAS BIAYA (ANTI-FRAUD NOTICE)
         ======================================================================== -->
    <section class="section py-12 sm:py-16 relative z-10 bg-slate-50/70 dark:bg-dark-surface/50 border-b border-slate-200/80 dark:border-dark-border/80">
        <div class="container-narrow mx-auto" data-aos="fade-up">
            <div class="relative p-[1.5px] rounded-3xl bg-gradient-to-br from-amber-400 via-amber-300 to-yellow-500 shadow-md group">
                <div class="relative rounded-[22px] p-6 sm:p-8 bg-amber-50/95 dark:bg-amber-950/50 backdrop-blur-xl flex flex-col md:flex-row items-start md:items-center gap-6 overflow-hidden">
                    <!-- Glass Shine Glint -->
                    <div class="wkl-glass-shine"></div>

                    <div class="w-14 h-14 rounded-2xl bg-amber-100 dark:bg-amber-900/60 text-amber-700 dark:text-amber-300 flex items-center justify-center flex-shrink-0 border border-amber-300/80 dark:border-amber-700 shadow-xs">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286zm0 13.036h.008v.008H12v-.008z"/></svg>
                    </div>

                    <div class="space-y-2 flex-1 relative z-10">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-200/90 dark:bg-amber-900 text-amber-950 dark:text-amber-200 border border-amber-300/70">
                            <?php echo esc_html( $antifraud['badge'] ); ?>
                        </div>
                        <h3 class="text-base sm:text-lg font-bold text-amber-950 dark:text-amber-100">
                            <?php echo esc_html( $antifraud['title'] ); ?>
                        </h3>
                        <p class="text-xs sm:text-sm text-amber-900/90 dark:text-amber-200/90 leading-relaxed">
                            <?php echo esc_html( $antifraud['desc'] ); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================
         SECTION 6: CENTERED CTA — DINAMIS DARI PENGATURAN WP-ADMIN
         ======================================================================== -->
    <?php if ( ! empty( $cta['show'] ) ) : ?>
    <section class="section py-16 sm:py-20 relative z-10">
        <div class="container-narrow mx-auto text-center" data-aos="fade-up">
            <div class="relative p-[2px] rounded-3xl bg-gradient-to-br from-teal-500/40 via-emerald-500/20 to-teal-700/40 shadow-2xl group overflow-hidden">
                <div class="relative rounded-[22px] p-8 sm:p-12 md:p-14 bg-gradient-to-br from-slate-900 via-slate-900 to-teal-950 text-center space-y-6 overflow-hidden">
                    <!-- Glass Shine Glint -->
                    <div class="wkl-glass-shine"></div>

                    <!-- Ambient Glow & Watermark Emblem Center -->
                    <div class="absolute -top-24 -left-24 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
                    
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 opacity-[0.035] pointer-events-none select-none">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 invert">
                    </div>

                    <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                        <?php if ( ! empty( $cta['badge'] ) ) : ?>
                            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-500/15 border border-teal-400/25 text-teal-300 text-xs font-bold uppercase tracking-wider shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-teal-400 animate-ping"></span>
                                <?php echo esc_html( $cta['badge'] ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $cta['title'] ) ) : ?>
                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight">
                                <?php echo esc_html( $cta['title'] ); ?>
                            </h2>
                        <?php endif; ?>

                        <?php if ( ! empty( $cta['desc'] ) ) : ?>
                            <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                                <?php echo esc_html( $cta['desc'] ); ?>
                            </p>
                        <?php endif; ?>

                        <!-- Dual Centered Buttons -->
                        <div class="pt-4 flex flex-wrap items-center justify-center gap-3 sm:gap-4">
                            <?php if ( ! empty( $cta['btn1_text'] ) && ! empty( $cta['btn1_url'] ) ) : 
                                $is_wa = ( strpos( $cta['btn1_url'], 'wa.me' ) !== false || strpos( $cta['btn1_url'], 'whatsapp' ) !== false );
                            ?>
                                <a href="<?php echo esc_url( $cta['btn1_url'] ); ?>" 
                                   <?php echo $is_wa ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
                                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-teal-500 hover:bg-teal-400 text-slate-950 font-extrabold text-sm shadow-xl shadow-teal-500/20 hover:scale-105 transition-all duration-300">
                                    <?php if ( $is_wa ) : ?>
                                        <svg class="w-4 h-4 text-slate-950" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    <?php else : ?>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                                    <?php endif; ?>
                                    <span><?php echo esc_html( $cta['btn1_text'] ); ?></span>
                                </a>
                            <?php endif; ?>

                            <?php if ( ! empty( $cta['btn2_text'] ) && ! empty( $cta['btn2_url'] ) ) : ?>
                                <a href="<?php echo esc_url( $cta['btn2_url'] ); ?>" 
                                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/15 text-white font-bold text-sm border border-white/20 backdrop-blur-md hover:scale-105 transition-all duration-300">
                                    <span><?php echo esc_html( $cta['btn2_text'] ); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

</div>

<!-- ========================================================================
     MODAL LIGHTBOX: DETAIL KUALIFIKASI LOWONGAN & LINK GOOGLE FORM
     (Teleported to document.body for Swup SPA safety)
     ======================================================================== -->
<div id="job-detail-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4 sm:p-6 bg-slate-950/80 backdrop-blur-md transition-all duration-300">
    <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-3xl bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border shadow-2xl p-6 sm:p-8 space-y-6">
        
        <!-- Close Button -->
        <button type="button" id="btn-close-job-modal" class="absolute top-5 right-5 w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white flex items-center justify-center transition-colors">
            ✕
        </button>

        <!-- Modal Header -->
        <div class="space-y-3 pr-8">
            <div class="flex items-center gap-2">
                <span id="modal-job-divisi" class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-100 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border border-teal-300"></span>
                <span id="modal-job-status" class="px-3 py-1 rounded-full text-xs font-extrabold border"></span>
            </div>

            <h2 id="modal-job-posisi" class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white leading-tight"></h2>

            <!-- Meta Row -->
            <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/></svg>
                    <span id="modal-job-tipe"></span>
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                    <span id="modal-job-lokasi"></span>
                </div>
                <div class="flex items-center gap-1.5 text-amber-700 dark:text-amber-400 font-semibold" id="modal-job-deadline-wrap">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Batas Akhir: <strong id="modal-job-deadline"></strong></span>
                </div>
            </div>
        </div>

        <!-- Description Box -->
        <div id="modal-job-ringkasan-wrap" class="space-y-2">
            <h4 class="text-xs font-black uppercase tracking-wider text-teal-700 dark:text-teal-400">Deskripsi &amp; Tanggung Jawab</h4>
            <p id="modal-job-ringkasan" class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed"></p>
        </div>

        <!-- Qualifications Box -->
        <div id="modal-job-kualifikasi-wrap" class="space-y-2">
            <h4 class="text-xs font-black uppercase tracking-wider text-teal-700 dark:text-teal-400">Kualifikasi &amp; Persyaratan</h4>
            <ul id="modal-job-kualifikasi-list" class="space-y-2 text-xs sm:text-sm text-slate-700 dark:text-slate-300"></ul>
        </div>

        <!-- Modal Actions Footer -->
        <div class="pt-5 border-t border-slate-100 dark:border-slate-800 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
            <span class="text-xs text-slate-500 dark:text-slate-400">
                Pendaftaran melalui formulir daring resmi.
            </span>
            <a id="modal-job-apply-btn" 
               href="#" 
               target="_blank" rel="noopener noreferrer" 
               class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-teal-600 hover:bg-teal-700 text-white font-extrabold text-sm shadow-lg shadow-teal-600/25 transition-all hover:scale-105">
                <span>Lamar via Google Form Resmi</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
            </a>
        </div>

    </div>
</div>

<!-- ========================================================================
     CLIENT-SIDE SCRIPT: FILTERING, SEARCH & MODAL HANDLER
     ======================================================================== -->
<script>
(function() {
    function initKarirPage() {
        const grid        = document.getElementById('karir-job-grid');
        const tabBtns     = document.querySelectorAll('.karir-tab-btn');
        const searchInput = document.getElementById('karir-search-input');
        const searchClear = document.getElementById('karir-search-clear');
        const emptyState  = document.getElementById('karir-empty-state');
        const resetBtn    = document.getElementById('karir-reset-btn');

        if (grid) {
            const cards       = Array.from(grid.querySelectorAll('.karir-job-card'));
            let currentDiv    = 'all';
            let searchQuery   = '';

            function filterJobs() {
                let visible = 0;
                const q = searchQuery.toLowerCase().trim();

                cards.forEach(card => {
                    const cardDiv = card.getAttribute('data-division') || '';
                    const cardKw  = card.getAttribute('data-keywords') || '';

                    const matchesDiv = (currentDiv === 'all') || (cardDiv === currentDiv);
                    const matchesKw  = !q || cardKw.includes(q);

                    if (matchesDiv && matchesKw) {
                        card.style.display = '';
                        visible++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (emptyState) {
                    if (visible === 0) {
                        emptyState.classList.remove('hidden');
                        grid.classList.add('hidden');
                    } else {
                        emptyState.classList.add('hidden');
                        grid.classList.remove('hidden');
                    }
                }
            }

            // Tab click
            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    tabBtns.forEach(b => {
                        b.classList.remove('active', 'bg-teal-600', 'text-white', 'ring-2', 'ring-teal-500/50');
                        b.classList.add('bg-slate-100', 'dark:bg-slate-800', 'text-slate-700', 'dark:text-slate-300');
                    });

                    this.classList.add('active', 'bg-teal-600', 'text-white', 'ring-2', 'ring-teal-500/50');
                    this.classList.remove('bg-slate-100', 'dark:bg-slate-800', 'text-slate-700', 'dark:text-slate-300');

                    currentDiv = this.getAttribute('data-filter') || 'all';
                    filterJobs();
                });
            });

            // Search Input
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    searchQuery = this.value;
                    if (searchClear) {
                        if (this.value.length > 0) {
                            searchClear.classList.remove('hidden');
                            searchClear.classList.add('flex');
                        } else {
                            searchClear.classList.add('hidden');
                            searchClear.classList.remove('flex');
                        }
                    }
                    filterJobs();
                });
            }

            // Search Clear
            if (searchClear) {
                searchClear.addEventListener('click', function() {
                    if (searchInput) {
                        searchInput.value = '';
                        searchQuery = '';
                        this.classList.add('hidden');
                        this.classList.remove('flex');
                        filterJobs();
                        searchInput.focus();
                    }
                });
            }

            // Reset Button
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    if (searchInput) searchInput.value = '';
                    searchQuery = '';
                    if (searchClear) searchClear.classList.add('hidden');

                    const firstTab = document.querySelector('.karir-tab-btn[data-filter="all"]');
                    if (firstTab) firstTab.click();
                });
            }
        }

        // ── MODAL LIGHTBOX TELEPORT & EVENT HANDLERS ────────────────
        const modal = document.getElementById('job-detail-modal');
        if (modal && modal.parentNode !== document.body) {
            document.body.appendChild(modal);
        }

        const modalDivisi     = document.getElementById('modal-job-divisi');
        const modalStatus     = document.getElementById('modal-job-status');
        const modalPosisi     = document.getElementById('modal-job-posisi');
        const modalTipe       = document.getElementById('modal-job-tipe');
        const modalLokasi     = document.getElementById('modal-job-lokasi');
        const modalDeadline   = document.getElementById('modal-job-deadline');
        const modalDlWrap     = document.getElementById('modal-job-deadline-wrap');
        const modalRingkasan  = document.getElementById('modal-job-ringkasan');
        const modalRgkWrap    = document.getElementById('modal-job-ringkasan-wrap');
        const modalKualifList = document.getElementById('modal-job-kualifikasi-list');
        const modalApplyBtn   = document.getElementById('modal-job-apply-btn');
        const btnClose        = document.getElementById('btn-close-job-modal');

        function openJobModal(btn) {
            if (!modal) return;
            const posisi     = btn.getAttribute('data-posisi') || '';
            const divisi     = btn.getAttribute('data-divisi') || '';
            const tipe       = btn.getAttribute('data-tipe') || '';
            const lokasi     = btn.getAttribute('data-lokasi') || '';
            const deadline   = btn.getAttribute('data-deadline') || '';
            const status     = btn.getAttribute('data-status') || 'dibuka';
            const statText   = btn.getAttribute('data-status-text') || 'Dibuka';
            const statCls    = btn.getAttribute('data-status-cls') || '';
            const ringkasan  = btn.getAttribute('data-ringkasan') || '';
            const kualifikasi= btn.getAttribute('data-kualifikasi') || '';
            const url        = btn.getAttribute('data-url') || '';

            if (modalPosisi) modalPosisi.textContent = posisi;
            if (modalDivisi) modalDivisi.textContent = divisi;
            if (modalTipe) modalTipe.textContent = tipe;
            if (modalLokasi) modalLokasi.textContent = lokasi;

            if (modalStatus) {
                modalStatus.textContent = statText;
                modalStatus.className = 'px-3 py-1 rounded-full text-xs font-extrabold border ' + statCls;
            }

            if (modalDeadline && modalDlWrap) {
                if (deadline && deadline.trim().length > 0) {
                    modalDeadline.textContent = deadline;
                    modalDlWrap.classList.remove('hidden');
                } else {
                    modalDlWrap.classList.add('hidden');
                }
            }

            if (modalRingkasan && modalRgkWrap) {
                if (ringkasan && ringkasan.trim().length > 0) {
                    modalRingkasan.textContent = ringkasan;
                    modalRgkWrap.classList.remove('hidden');
                } else {
                    modalRgkWrap.classList.add('hidden');
                }
            }

            // Kualifikasi Bullet Points
            if (modalKualifList) {
                modalKualifList.innerHTML = '';
                const lines = kualifikasi.split('\n').map(l => l.trim()).filter(l => l.length > 0);
                if (lines.length > 0) {
                    lines.forEach(line => {
                        const li = document.createElement('li');
                        li.className = 'flex items-start gap-2';
                        li.innerHTML = `
                            <svg class="w-4 h-4 text-teal-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            <span>${line}</span>
                        `;
                        modalKualifList.appendChild(li);
                    });
                } else {
                    modalKualifList.innerHTML = '<li class="text-slate-400 italic">Kualifikasi umum berlaku.</li>';
                }
            }

            // Apply Button Link
            if (modalApplyBtn) {
                if (status === 'dibuka' && url && url.trim().length > 0) {
                    modalApplyBtn.href = url;
                    modalApplyBtn.classList.remove('hidden');
                    modalApplyBtn.textContent = 'Lamar via Google Form Resmi ↗';
                } else if (status === 'segera') {
                    modalApplyBtn.href = '#';
                    modalApplyBtn.classList.add('hidden');
                } else {
                    modalApplyBtn.href = '#';
                    modalApplyBtn.classList.add('hidden');
                }
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeJobModal() {
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        document.querySelectorAll('.btn-open-job-modal').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                openJobModal(this);
            });
        });

        if (btnClose) btnClose.addEventListener('click', closeJobModal);
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeJobModal();
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                closeJobModal();
            }
        });

        if (window.swup && window.swup.hooks) {
            window.swup.hooks.once('visit:start', function() {
                closeJobModal();
                if (modal && modal.parentNode === document.body) {
                    modal.remove();
                }
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initKarirPage);
    } else {
        initKarirPage();
    }

    if (window.swup && window.swup.hooks) {
        window.swup.hooks.on('page:view', initKarirPage);
    }
})();
</script>

<?php get_footer(); ?>
