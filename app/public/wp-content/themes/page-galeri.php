<?php
/**
 * Template Name: Halaman Galeri Dokumentasi Bank
 * Description: Portal Galeri Foto & Video Kegiatan Bank Syariah Wakalumi (BSW) dengan Fullscreen Story Lightbox
 * 
 * @package Wakalumi
 */

get_header();

// ── DATA RETRIEVAL ──────────────────────────────────────────────────
$header      = wakalumi_get_galeri_header();
$categories  = wakalumi_get_galeri_categories();
$all_albums  = wakalumi_get_galeri_albums();

// Filter active albums only
$galeri_list = array_values( array_filter( $all_albums, function( $item ) {
    return ( $item['status'] ?? 'aktif' ) === 'aktif';
}) );

// Count stats
$count_all_albums = count( $galeri_list );
$count_all_photos = 0;
foreach ( $galeri_list as $alb ) {
    $count_all_photos += count( $alb['foto_list'] ?? [] );
}

// Extract unique years
$years = [];
foreach ( $galeri_list as $item ) {
    $y = date( 'Y', strtotime( $item['tanggal'] ?? date( 'Y-m-d' ) ) );
    if ( $y && ! in_array( $y, $years, true ) ) {
        $years[] = $y;
    }
}
rsort( $years );

$wa_number = get_option( 'options_contact_wa', '6281517380388' );
$wa_url    = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );
?>

<div class="min-h-screen bg-transparent text-slate-800 dark:text-dark-text pb-24">

    <!-- ========================================================================
         SECTION 1: HERO HEADER BANNER & SPOTLIGHT GOVERNANCE CARD
         ======================================================================== -->
    <section class="relative z-10 pt-8 sm:pt-10 pb-14 md:pb-18 overflow-hidden bg-slate-50 dark:bg-dark-surface border-b border-slate-200/80 dark:border-dark-border/80 shadow-xs">
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
                <span class="text-teal-600 dark:text-teal-400 font-semibold">Galeri Dokumentasi</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Left Column: Title & Intro -->
                <div class="lg:col-span-8" data-aos="fade-up">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider mb-4 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        <?php echo esc_html( $header['badge'] ); ?>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-4">
                        <?php echo esc_html( $header['title'] ); ?>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                        <?php echo esc_html( $header['desc'] ); ?>
                    </p>

                    <!-- Key Trust Highlights Pills -->
                    <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"/></svg>
                            <span>Resolusi Tinggi &amp; Arsip Lengkap</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                            <span>Transparansi Kinerja Syariah</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                            <span>Liputan Foto &amp; Video Interaktif</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Governance Badge Card with Watermark Emblem -->
                <div class="lg:col-span-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="spotlight-card relative overflow-hidden rounded-3xl p-6 sm:p-7 bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-teal-200/80 dark:border-dark-border shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 text-center space-y-4 group cursor-default before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 before:bg-gradient-to-r before:from-teal-500 via-emerald-400 to-teal-600">
                        <!-- Interactive Slide Watermark Emblem -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.045] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.08] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>

                        <div class="w-14 h-14 mx-auto rounded-2xl bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                        </div>

                        <div>
                            <span class="text-xs font-bold tracking-widest text-teal-600 dark:text-teal-400 uppercase"><?php echo esc_html( $header['card_badge'] ); ?></span>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mt-1"><?php echo esc_html( $header['card_title'] ); ?></h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">
                                <?php echo esc_html( $header['card_desc'] ); ?>
                            </p>
                        </div>

                        <!-- Mini Stats Bar inside Card -->
                        <div class="pt-3 border-t border-slate-100 dark:border-dark-border grid grid-cols-2 gap-3 text-center">
                            <div class="p-2 rounded-xl bg-slate-50 dark:bg-dark-surface/60 border border-slate-200/60 dark:border-dark-border/60">
                                <span class="block text-xl font-extrabold text-teal-600 dark:text-teal-400"><?php echo esc_html( $count_all_albums ); ?></span>
                                <span class="block text-[11px] font-medium text-slate-500 dark:text-slate-400">Album Kegiatan</span>
                            </div>
                            <div class="p-2 rounded-xl bg-slate-50 dark:bg-dark-surface/60 border border-slate-200/60 dark:border-dark-border/60">
                                <span class="block text-xl font-extrabold text-purple-600 dark:text-purple-400"><?php echo esc_html( $count_all_photos ); ?></span>
                                <span class="block text-[11px] font-medium text-slate-500 dark:text-slate-400">Foto Dokumentasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========================================================================
         SECTION 2: INTERACTIVE FILTER CONTROLS & INSTANT SEARCH BAR
         ======================================================================== -->
    <section id="galeri-grid-top" class="relative z-20 -mt-6">
        <div class="container-wide">
            <div class="p-4 sm:p-5 rounded-2xl bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-slate-200/90 dark:border-dark-border shadow-lg space-y-4">
                
                <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
                    <!-- Search Input -->
                    <div class="relative flex-1 max-w-lg">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        </span>
                        <input type="text" id="galeri-search-input" placeholder="Cari album, topik, atau lokasi dokumentasi..." class="w-full pl-10 pr-9 py-2.5 rounded-xl text-xs sm:text-sm bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border text-slate-800 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all">
                        <button type="button" id="galeri-clear-search" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 hidden" title="Hapus pencarian">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <!-- Right Controls: Year Select & Reset -->
                    <div class="flex items-center gap-3">
                        <!-- Year Dropdown -->
                        <?php if ( ! empty( $years ) ) : ?>
                            <div class="relative">
                                <select id="galeri-year-select" class="appearance-none pl-3.5 pr-8 py-2.5 rounded-xl text-xs sm:text-sm font-semibold bg-slate-50 dark:bg-dark-surface border border-slate-200 dark:border-dark-border text-slate-700 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all cursor-pointer">
                                    <option value="all">Semua Tahun</option>
                                    <?php foreach ( $years as $y ) : ?>
                                        <option value="<?php echo esc_attr( $y ); ?>"><?php echo esc_html( $y ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2.5 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                                </span>
                            </div>
                        <?php endif; ?>

                        <!-- Reset Filter Button -->
                        <button type="button" id="galeri-reset-filter" class="hidden px-3.5 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-slate-100 hover:bg-slate-200 dark:bg-dark-surface-alt dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-dark-border transition-all flex items-center gap-1.5" title="Reset semua filter">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                            <span class="hidden sm:inline">Reset</span>
                        </button>
                    </div>
                </div>

                <!-- Category Filter Pills (Horizontal Scrollable) -->
                <div class="flex items-center gap-2 overflow-x-auto pb-1.5 scrollbar-thin border-t border-slate-100 dark:border-dark-border/60 pt-3">
                    <button type="button" data-cat-filter="all" class="galeri-cat-pill active-cat-pill px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all duration-200 whitespace-nowrap bg-teal-500/20 text-teal-700 dark:text-teal-300 border border-teal-500/40">
                        Semua Kategori (<?php echo esc_html( $count_all_albums ); ?>)
                    </button>
                    <?php foreach ( $categories as $ckey => $cdata ) : 
                        $c_count = count( array_filter( $galeri_list, fn($x) => ( $x['kategori'] ?? '' ) === $ckey ) );
                        ?>
                        <button type="button" data-cat-filter="<?php echo esc_attr( $ckey ); ?>" class="galeri-cat-pill px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200 whitespace-nowrap bg-white/80 dark:bg-dark-card/80 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface-alt">
                            <?php echo esc_html( $cdata['pill_label'] ); ?> (<?php echo $c_count; ?>)
                        </button>
                    <?php endforeach; ?>
                </div>

                <!-- Live Result Text -->
                <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 pt-1">
                    <div>
                        Menampilkan <span id="galeri-active-count" class="font-bold text-teal-600 dark:text-teal-400"><?php echo esc_html( $count_all_albums ); ?></span> dari <span class="font-bold"><?php echo esc_html( $count_all_albums ); ?></span> album dokumentasi
                    </div>
                    <div id="galeri-filter-tag" class="hidden text-teal-600 dark:text-teal-400 font-medium"></div>
                </div>

            </div>
        </div>
    </section>


    <!-- ========================================================================
         SECTION 3: ALBUM SPOTLIGHT GRID & EMPTY STATE
         ======================================================================== -->
    <section class="container-wide mt-10">

        <!-- Album Cards Grid Container -->
        <div id="galeri-albums-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <?php foreach ( $galeri_list as $idx => $album ) : 
                $alb_id     = esc_attr( $album['id'] ?? ( 'alb_' . $idx ) );
                $judul      = esc_html( $album['judul'] ?? '' );
                $cat_slug   = esc_attr( $album['kategori'] ?? 'csr' );
                $cat_info   = $categories[ $cat_slug ] ?? $categories['csr'];
                $tanggal    = esc_attr( $album['tanggal'] ?? date( 'Y-m-d' ) );
                $tgl_human  = date_i18n( 'd F Y', strtotime( $tanggal ) );
                $year       = date( 'Y', strtotime( $tanggal ) );
                $lokasi     = esc_html( $album['lokasi'] ?? '' );
                $ringkasan  = esc_html( $album['ringkasan'] ?? '' );
                $cover_img  = esc_url( $album['cover_image'] ?? '' );
                $foto_list  = $album['foto_list'] ?? [];
                $foto_count = count( $foto_list );
                $video_url  = esc_url( $album['video_url'] ?? '' );
                $has_video  = ! empty( $video_url );

                // If cover image is empty but foto_list exists, use first photo
                if ( empty( $cover_img ) && ! empty( $foto_list ) ) {
                    $cover_img = esc_url( $foto_list[0] );
                }
                ?>
                <article id="<?php echo $alb_id; ?>" 
                         class="galeri-card group spotlight-card relative flex flex-col rounded-3xl overflow-hidden bg-white/95 dark:bg-dark-card/95 backdrop-blur-xl border border-slate-200/90 dark:border-dark-border shadow-md hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 cursor-pointer"
                         data-category="<?php echo $cat_slug; ?>"
                         data-year="<?php echo $year; ?>"
                         data-aos="fade-up"
                         data-aos-delay="<?php echo min( 300, ( $idx % 3 ) * 100 ); ?>"
                         data-id="<?php echo $alb_id; ?>">

                    <!-- Card Media Cover (Aspect 16:10) -->
                    <div class="relative w-full aspect-[16/10] overflow-hidden bg-slate-900 select-none">
                        <?php if ( ! empty( $cover_img ) ) : ?>
                            <img src="<?php echo $cover_img; ?>" 
                                 alt="<?php echo $judul; ?>" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                                 loading="lazy">
                        <?php else : ?>
                            <!-- Fallback Elegant Pattern with Bank Watermark -->
                            <div class="w-full h-full bg-gradient-to-br from-teal-900 via-slate-900 to-teal-950 flex items-center justify-center relative overflow-hidden">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-32 h-32 object-contain opacity-10">
                                <div class="absolute inset-0 flex items-center justify-center text-teal-400 font-bold text-sm tracking-widest uppercase">
                                    Dokumentasi Bank
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Glass-Shine Sweep Accent -->
                        <div class="spotlight-shine"></div>

                        <!-- Top Floating Badges -->
                        <div class="absolute top-3 inset-x-3 flex items-center justify-between gap-2 pointer-events-none z-10">
                            <!-- Category Badge: Solid high-contrast background in light mode so it never clashes with the photo -->
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border border-slate-200/80 dark:border-white/10 shadow-md <?php echo esc_attr( $cat_info['badge_class'] ); ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $cat_info['tag_dot'] ); ?>"></span>
                                <?php echo esc_html( $cat_info['pill_label'] ); ?>
                            </span>

                            <!-- Photo & Video Counter Pill -->
                            <div class="flex items-center gap-1.5">
                                <?php if ( $has_video ) : ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-purple-950/80 text-purple-200 border border-purple-500/40 backdrop-blur-md shadow-sm">
                                        <svg class="w-3 h-3 text-purple-300" fill="currentColor" viewBox="0 0 24 24"><path d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"/></svg>
                                        Video
                                    </span>
                                <?php endif; ?>

                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-900/80 text-white border border-white/20 backdrop-blur-md shadow-sm">
                                    <svg class="w-3 h-3 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/></svg>
                                    <?php echo esc_html( $foto_count ); ?> Foto
                                </span>
                            </div>
                        </div>

                        <!-- Gradient Vignette at Bottom of Image -->
                        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-slate-950/70 to-transparent pointer-events-none"></div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div class="space-y-2.5">
                            <!-- Metadata (Date & Location) -->
                            <div class="flex items-center flex-wrap gap-y-1 gap-x-3 text-xs text-slate-500 dark:text-slate-400">
                                <span class="flex items-center gap-1 font-medium">
                                    <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/></svg>
                                    <?php echo esc_html( $tgl_human ); ?>
                                </span>
                                <?php if ( ! empty( $lokasi ) ) : ?>
                                    <span class="text-slate-300 dark:text-slate-600">•</span>
                                    <span class="flex items-center gap-1 font-medium truncate max-w-[180px]" title="<?php echo $lokasi; ?>">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                        <?php echo $lokasi; ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Title -->
                            <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white line-clamp-2 group-hover:text-teal-600 dark:group-hover:text-teal-300 transition-colors leading-snug">
                                <?php echo $judul; ?>
                            </h3>

                            <!-- Excerpt Description -->
                            <?php if ( ! empty( $ringkasan ) ) : ?>
                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                    <?php echo $ringkasan; ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <!-- Card Footer / Bottom Row -->
                        <div class="pt-4 border-t border-slate-100 dark:border-dark-border/80 flex items-center justify-between gap-3">
                            <!-- Mini Photo Thumbnails Peek (Up to 3 photos) -->
                            <div class="flex items-center -space-x-2 overflow-hidden">
                                <?php 
                                $peek_photos = array_slice( $foto_list, 0, 3 );
                                foreach ( $peek_photos as $p_pic ) : ?>
                                    <div class="w-7 h-7 rounded-full border-2 border-white dark:border-dark-card overflow-hidden shadow-xs flex-shrink-0">
                                        <img src="<?php echo esc_url( $p_pic ); ?>" alt="" class="w-full h-full object-cover">
                                    </div>
                                <?php endforeach; ?>
                                <?php if ( $foto_count > 3 ) : ?>
                                    <div class="w-7 h-7 rounded-full bg-slate-100 dark:bg-slate-800 text-[10px] font-bold text-slate-600 dark:text-slate-300 border-2 border-white dark:border-dark-card flex items-center justify-center shadow-xs flex-shrink-0">
                                        +<?php echo ( $foto_count - 3 ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Open Album Action Button -->
                            <button type="button" class="btn-open-album-lightbox inline-flex items-center gap-1.5 text-xs sm:text-sm font-bold text-teal-600 dark:text-teal-400 group-hover:text-teal-700 dark:group-hover:text-teal-300 transition-colors">
                                <span>Buka Galeri</span>
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Hidden DOM Data Store for Lightbox Carousel -->
                    <div class="galeri-album-data hidden">
                        <div class="data-id"><?php echo $alb_id; ?></div>
                        <div class="data-title"><?php echo $judul; ?></div>
                        <div class="data-category"><?php echo esc_html( $cat_info['pill_label'] ); ?></div>
                        <div class="data-category-badge"><?php echo esc_attr( $cat_info['badge_class'] ); ?></div>
                        <div class="data-date"><?php echo esc_html( $tgl_human ); ?></div>
                        <div class="data-location"><?php echo $lokasi; ?></div>
                        <div class="data-desc"><?php echo $ringkasan; ?></div>
                        <div class="data-video-url"><?php echo $video_url; ?></div>
                        <div class="data-photos">
                            <?php foreach ( $foto_list as $f_item ) : ?>
                                <span class="photo-item"><?php echo esc_url( $f_item ); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </article>
            <?php endforeach; ?>
        </div>

        <!-- Empty State (Shown when filter yields zero results) -->
        <div id="galeri-empty-state" class="hidden py-16 px-6 text-center max-w-xl mx-auto rounded-3xl bg-white/80 dark:bg-dark-card/80 backdrop-blur-xl border border-slate-200 dark:border-dark-border shadow-sm">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-teal-50 dark:bg-teal-950/70 text-teal-600 dark:text-teal-400 flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Tidak Ada Album yang Sesuai</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">
                Tidak ditemukan album dokumentasi untuk kriteria pencarian atau kategori yang Anda pilih. Silakan atur ulang kata kunci atau lihat seluruh album.
            </p>
            <button type="button" class="btn-trigger-reset px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold bg-teal-600 hover:bg-teal-700 text-white shadow-md transition-all">
                Tampilkan Semua Album
            </button>
        </div>

        <!-- Smart Client-Side Pagination -->
        <div id="galeri-pagination-container" class="mt-12 flex items-center justify-center gap-2"></div>

    </section>


    <!-- ========================================================================
         SECTION 4: MEDIA INQUIRY & CORPORATE PUBLIC RELATIONS CTA
         ======================================================================== -->
    <section class="container-wide mt-20">
        <div class="relative overflow-hidden rounded-3xl p-8 sm:p-12 md:p-16 bg-gradient-to-br from-slate-900 via-primary-950 to-slate-900 text-white text-center shadow-2xl border border-teal-500/30">
            <!-- Ambient Glow & Watermark -->
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-teal-500/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-primary-500/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 opacity-[0.035] pointer-events-none select-none">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 invert">
            </div>

            <div class="relative z-10 max-w-3xl mx-auto space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-widest bg-white/10 backdrop-blur-md border border-white/20 text-teal-300">
                    <span class="w-2 h-2 rounded-full bg-teal-400 animate-ping"></span>
                    Sekretariat Perusahaan &amp; Hubungan Media
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                    Butuh Materi Dokumentasi atau Siaran Pers Resmi Bank?
                </h2>
                <p class="text-slate-300 text-sm sm:text-base md:text-lg leading-relaxed max-w-2xl mx-auto font-normal">
                    Untuk kebutuhan publikasi jurnalistik, kemitraan acara, atau permohonan aset visual beresolusi penuh, rekan media dan mitra korporat dapat menghubungi Tim Komunikasi Perusahaan Bank Syariah Wakalumi.
                </p>

                <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                    <a href="<?php echo esc_url( $wa_url ); ?>" 
                       target="_blank" rel="noopener noreferrer" 
                       class="btn-primary text-sm sm:text-base px-8 py-4 rounded-xl shadow-lg shadow-primary-500/25 inline-flex items-center gap-2.5 font-bold hover:scale-105 transition-transform">
                        <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <span>Hubungi via WhatsApp</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/berita/' ) ); ?>" 
                       class="btn-secondary text-sm sm:text-base px-8 py-4 rounded-xl border border-white/20 bg-white/10 hover:bg-white/20 text-white inline-flex items-center gap-2 font-bold backdrop-blur-sm transition-all hover:scale-105">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                        <span>Berita &amp; Artikel Syariah</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>


<!-- ========================================================================
     SECTION 5: FULLSCREEN STORY LIGHTBOX CAROUSEL (TELEPORTED TO BODY)
     ======================================================================== -->
<div id="galeri-story-lightbox" class="fixed inset-0 z-[999999] bg-slate-950/95 backdrop-blur-2xl flex flex-col justify-between hidden select-none transition-opacity duration-300 opacity-0" role="dialog" aria-modal="true">

    <!-- Top Navigation Header -->
    <header class="relative z-30 px-4 sm:px-8 py-4 flex items-center justify-between gap-4 border-b border-white/10 bg-slate-950/60 backdrop-blur-md">
        <!-- Left: Album Info & Photo Counter -->
        <div class="flex items-center gap-3 overflow-hidden">
            <span id="lb-category-badge" class="px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider bg-teal-500/20 text-teal-300 border border-teal-500/30 whitespace-nowrap">
                CSR &amp; Sosial
            </span>
            <div class="overflow-hidden">
                <h3 id="lb-album-title" class="text-sm sm:text-base font-extrabold text-white truncate max-w-xs sm:max-w-md lg:max-w-xl leading-tight">
                    Judul Album Dokumentasi
                </h3>
                <div class="flex items-center gap-2 text-xs text-slate-400 mt-0.5">
                    <span id="lb-photo-counter" class="font-bold text-teal-400">Foto 1 dari 1</span>
                    <span class="text-slate-600">•</span>
                    <span id="lb-album-date">Tanggal</span>
                </div>
            </div>
        </div>

        <!-- Right: Video Mode Toggle, Share & Close Buttons -->
        <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
            <!-- Video Switch Button (Hidden if no video) -->
            <button type="button" id="lb-btn-toggle-video" class="hidden px-3 py-1.5 rounded-xl text-xs font-bold bg-purple-500/20 text-purple-300 border border-purple-500/40 hover:bg-purple-500/30 transition-all flex items-center gap-1.5" title="Tonton Video Liputan">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"/></svg>
                <span id="lb-video-btn-text">Putar Video</span>
            </button>

            <!-- Share Button -->
            <button type="button" id="lb-btn-share" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all" title="Salin Tautan Album">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z"/></svg>
            </button>

            <!-- Close Lightbox Button -->
            <button type="button" id="lb-btn-close" class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-500/80 text-white flex items-center justify-center transition-all" title="Tutup Lightbox (Esc)">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </header>

    <!-- Main Visual Stage (Center) -->
    <main class="relative z-20 flex-1 flex items-center justify-center p-2 sm:p-6 overflow-hidden">
        
        <!-- Navigation Prev Button -->
        <button type="button" id="lb-btn-prev" class="absolute left-2 sm:left-6 z-30 w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-slate-900/80 hover:bg-teal-600 text-white border border-white/20 backdrop-blur-md flex items-center justify-center shadow-2xl transition-all duration-200 hover:scale-110 active:scale-95" title="Foto Sebelumnya (Panah Kiri)">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
        </button>

        <!-- Visual Media Canvas Container -->
        <div class="relative w-full h-full flex items-center justify-center p-2">
            
            <!-- Photo Mode -->
            <div id="lb-photo-stage" class="relative max-w-full max-h-[65vh] sm:max-h-[72vh] flex items-center justify-center transition-all duration-300">
                <img id="lb-active-image" 
                     src="" 
                     alt="" 
                     class="max-w-full max-h-[65vh] sm:max-h-[72vh] w-auto h-auto rounded-2xl shadow-2xl object-contain border border-white/10 transition-opacity duration-200 opacity-100">
            </div>

            <!-- Video Mode (Embedded Iframe) -->
            <div id="lb-video-stage" class="hidden w-full max-w-4xl aspect-video rounded-2xl overflow-hidden shadow-2xl border border-white/10 bg-black">
                <iframe id="lb-video-iframe" class="w-full h-full" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

        </div>

        <!-- Navigation Next Button -->
        <button type="button" id="lb-btn-next" class="absolute right-2 sm:right-6 z-30 w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-slate-900/80 hover:bg-teal-600 text-white border border-white/20 backdrop-blur-md flex items-center justify-center shadow-2xl transition-all duration-200 hover:scale-110 active:scale-95" title="Foto Selanjutnya (Panah Kanan)">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
        </button>

    </main>

    <!-- Bottom Thumbnail Strip & Story Description -->
    <footer class="relative z-30 px-4 sm:px-8 py-3 border-t border-white/10 bg-slate-950/80 backdrop-blur-md flex flex-col gap-2.5">
        
        <!-- Story Description & Location -->
        <div class="flex items-center justify-between gap-4 text-xs text-slate-300">
            <div class="flex items-center gap-3 truncate">
                <span id="lb-album-location" class="flex items-center gap-1 text-teal-400 font-semibold truncate">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                    <span id="lb-album-location-text">Lokasi</span>
                </span>
                <span class="text-slate-600">•</span>
                <p id="lb-album-desc" class="truncate text-slate-400 max-w-xl">
                    Deskripsi kegiatan...
                </p>
            </div>
            
            <!-- Quick Keyboard Hints -->
            <div class="hidden md:flex items-center gap-2 text-[11px] text-slate-500 whitespace-nowrap">
                <span>Navigasi:</span>
                <kbd class="px-1.5 py-0.5 rounded bg-white/10 text-white font-mono text-[10px]">←</kbd>
                <kbd class="px-1.5 py-0.5 rounded bg-white/10 text-white font-mono text-[10px]">→</kbd>
                <span>Tutup:</span>
                <kbd class="px-1.5 py-0.5 rounded bg-white/10 text-white font-mono text-[10px]">ESC</kbd>
            </div>
        </div>

        <!-- Horizontal Scrollable Thumbnail Strip Bar -->
        <div id="lb-thumbnails-strip" class="flex items-center gap-2 overflow-x-auto py-1 scrollbar-thin">
            <!-- Dynamic Thumbnails inserted via JavaScript -->
        </div>

    </footer>

</div>


<!-- ========================================================================
     SECTION 6: CLIENT-SIDE JAVASCRIPT CONTROLLER (PAGINATION, FILTER, LIGHTBOX)
     ======================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {

    // ── 1. FILTER & SEARCH CONTROLLER ───────────────────────────────
    var allCards          = Array.from(document.querySelectorAll('.galeri-card'));
    var catFilterPills    = document.querySelectorAll('.galeri-cat-pill');
    var yearSelect        = document.getElementById('galeri-year-select');
    var searchInput       = document.getElementById('galeri-search-input');
    var clearSearchBtn    = document.getElementById('galeri-clear-search');
    var resetFilterBtn    = document.getElementById('galeri-reset-filter');
    var activeCountEl     = document.getElementById('galeri-active-count');
    var filterTagEl       = document.getElementById('galeri-filter-tag');
    var emptyState        = document.getElementById('galeri-empty-state');
    var paginationWrapper = document.getElementById('galeri-pagination-container');

    var currentCat  = 'all';
    var currentYear = 'all';
    var searchQuery = '';

    // Pagination State
    var currentPage   = 1;
    var itemsPerPage  = 6; // 3x2 grid per page
    var filteredCards = allCards.slice();

    function applyFilters() {
        filteredCards = allCards.filter(function(card) {
            var catMatch  = (currentCat === 'all' || card.getAttribute('data-category') === currentCat);
            var yearMatch = (currentYear === 'all' || card.getAttribute('data-year') === currentYear);
            var searchMatch = true;

            if (searchQuery.trim().length > 0) {
                var title = (card.querySelector('h3') ? card.querySelector('h3').textContent : '').toLowerCase();
                var desc  = (card.querySelector('p') ? card.querySelector('p').textContent : '').toLowerCase();
                var loc   = (card.querySelector('.data-location') ? card.querySelector('.data-location').textContent : '').toLowerCase();
                searchMatch = title.indexOf(searchQuery) !== -1 || desc.indexOf(searchQuery) !== -1 || loc.indexOf(searchQuery) !== -1;
            }

            return catMatch && yearMatch && searchMatch;
        });

        // Hide all cards first
        allCards.forEach(function(c) {
            c.style.display = 'none';
        });

        // Update counts
        if (activeCountEl) {
            activeCountEl.textContent = filteredCards.length;
        }

        // Show/hide empty state
        if (filteredCards.length === 0) {
            if (emptyState) emptyState.classList.remove('hidden');
            if (paginationWrapper) paginationWrapper.innerHTML = '';
        } else {
            if (emptyState) emptyState.classList.add('hidden');
            currentPage = 1;
            renderPagination();
        }

        // Toggle reset button
        var hasActiveFilter = (currentCat !== 'all' || currentYear !== 'all' || searchQuery.length > 0);
        if (resetFilterBtn) {
            if (hasActiveFilter) {
                resetFilterBtn.classList.remove('hidden');
            } else {
                resetFilterBtn.classList.add('hidden');
            }
        }
    }

    function renderPagination() {
        var totalPages = Math.ceil(filteredCards.length / itemsPerPage);
        if (totalPages <= 1) {
            if (paginationWrapper) paginationWrapper.innerHTML = '';
            filteredCards.forEach(function(card) {
                card.style.display = '';
            });
            return;
        }

        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex   = startIndex + itemsPerPage;

        filteredCards.forEach(function(card, index) {
            if (index >= startIndex && index < endIndex) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });

        // Build Pagination Buttons
        var html = '';
        
        // Prev button
        var prevDisabled = (currentPage === 1) ? 'opacity-40 pointer-events-none' : 'hover:bg-slate-100 dark:hover:bg-dark-surface-alt';
        html += '<button type="button" class="btn-page-nav p-2.5 rounded-xl border border-slate-200 dark:border-dark-border bg-white dark:bg-dark-card text-slate-700 dark:text-slate-300 ' + prevDisabled + '" data-page="' + (currentPage - 1) + '" title="Halaman Sebelumnya">' +
                '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>' +
                '</button>';

        // Numbered buttons
        for (var p = 1; p <= totalPages; p++) {
            if (p === currentPage) {
                html += '<button type="button" class="btn-page-nav px-4 py-2.5 rounded-xl text-xs sm:text-sm font-extrabold bg-teal-600 text-white shadow-md shadow-teal-600/30" data-page="' + p + '">' + p + '</button>';
            } else {
                html += '<button type="button" class="btn-page-nav px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold border border-slate-200 dark:border-dark-border bg-white dark:bg-dark-card text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-dark-surface-alt transition-colors" data-page="' + p + '">' + p + '</button>';
            }
        }

        // Next button
        var nextDisabled = (currentPage === totalPages) ? 'opacity-40 pointer-events-none' : 'hover:bg-slate-100 dark:hover:bg-dark-surface-alt';
        html += '<button type="button" class="btn-page-nav p-2.5 rounded-xl border border-slate-200 dark:border-dark-border bg-white dark:bg-dark-card text-slate-700 dark:text-slate-300 ' + nextDisabled + '" data-page="' + (currentPage + 1) + '" title="Halaman Selanjutnya">' +
                '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>' +
                '</button>';

        paginationWrapper.innerHTML = html;

        // Bind clicks
        paginationWrapper.querySelectorAll('.btn-page-nav').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var targetPage = parseInt(this.getAttribute('data-page'), 10);
                if (targetPage >= 1 && targetPage <= totalPages && targetPage !== currentPage) {
                    currentPage = targetPage;
                    renderPagination();
                    var gridTop = document.getElementById('galeri-grid-top');
                    if (gridTop) {
                        gridTop.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }
            });
        });
    }

    // Category Pill Events
    catFilterPills.forEach(function(pill) {
        pill.addEventListener('click', function() {
            catFilterPills.forEach(function(p) {
                p.className = 'galeri-cat-pill px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200 whitespace-nowrap bg-white/80 dark:bg-dark-card/80 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface-alt';
            });
            this.className = 'galeri-cat-pill active-cat-pill px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all duration-200 whitespace-nowrap bg-teal-500/20 text-teal-700 dark:text-teal-300 border border-teal-500/40';

            currentCat = this.getAttribute('data-cat-filter');
            applyFilters();
        });
    });

    // Year Dropdown Event
    if (yearSelect) {
        yearSelect.addEventListener('change', function() {
            currentYear = this.value;
            applyFilters();
        });
    }

    // Search Input Events
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            searchQuery = this.value.toLowerCase().trim();
            if (clearSearchBtn) {
                if (searchQuery.length > 0) {
                    clearSearchBtn.classList.remove('hidden');
                } else {
                    clearSearchBtn.classList.add('hidden');
                }
            }
            applyFilters();
        });
    }

    if (clearSearchBtn) {
        clearSearchBtn.addEventListener('click', function() {
            if (searchInput) searchInput.value = '';
            searchQuery = '';
            this.classList.add('hidden');
            applyFilters();
        });
    }

    function resetAllFilters() {
        currentCat  = 'all';
        currentYear = 'all';
        searchQuery = '';
        if (searchInput) searchInput.value = '';
        if (clearSearchBtn) clearSearchBtn.classList.add('hidden');
        if (yearSelect) yearSelect.value = 'all';

        catFilterPills.forEach(function(p, idx) {
            if (idx === 0) {
                p.className = 'galeri-cat-pill active-cat-pill px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all duration-200 whitespace-nowrap bg-teal-500/20 text-teal-700 dark:text-teal-300 border border-teal-500/40';
            } else {
                p.className = 'galeri-cat-pill px-3.5 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200 whitespace-nowrap bg-white/80 dark:bg-dark-card/80 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface-alt';
            }
        });

        applyFilters();
    }

    if (resetFilterBtn) resetFilterBtn.addEventListener('click', resetAllFilters);
    document.querySelectorAll('.btn-trigger-reset').forEach(function(b) {
        b.addEventListener('click', resetAllFilters);
    });

    // Initialize Pagination
    applyFilters();


    // ── 2. FULLSCREEN STORY LIGHTBOX CONTROLLER ─────────────────────
    var lightbox       = document.getElementById('galeri-story-lightbox');
    var lbCloseBtn     = document.getElementById('lb-btn-close');
    var lbPrevBtn      = document.getElementById('lb-btn-prev');
    var lbNextBtn      = document.getElementById('lb-btn-next');
    var lbActiveImg    = document.getElementById('lb-active-image');
    var lbThumbStrip   = document.getElementById('lb-thumbnails-strip');
    var lbCatBadge     = document.getElementById('lb-category-badge');
    var lbTitle        = document.getElementById('lb-album-title');
    var lbCounter      = document.getElementById('lb-photo-counter');
    var lbDate         = document.getElementById('lb-album-date');
    var lbLocWrap      = document.getElementById('lb-album-location');
    var lbLocText      = document.getElementById('lb-album-location-text');
    var lbDesc         = document.getElementById('lb-album-desc');
    var lbShareBtn     = document.getElementById('lb-btn-share');
    var lbToggleVideo  = document.getElementById('lb-btn-toggle-video');
    var lbPhotoStage   = document.getElementById('lb-photo-stage');
    var lbVideoStage   = document.getElementById('lb-video-stage');
    var lbVideoIframe  = document.getElementById('lb-video-iframe');

    // Teleport lightbox to document.body to avoid Swup CSS transform containing block
    if (lightbox && lightbox.parentElement !== document.body) {
        document.body.appendChild(lightbox);
    }

    // Cleanup on Swup navigation
    if (window.swup && window.swup.hooks) {
        window.swup.hooks.on('visit:start', function() {
            var lb = document.getElementById('galeri-story-lightbox');
            if (lb) lb.remove();
            document.body.style.overflow = '';
        });
    }

    // Lightbox Active State
    var currentAlbumCard = null;
    var currentPhotos    = [];
    var currentPhotoIdx  = 0;
    var currentVideoUrl  = '';
    var isVideoMode      = false;

    function openLightbox(card) {
        if (!card) return;
        currentAlbumCard = card;
        var dataEl = card.querySelector('.galeri-album-data');
        if (!dataEl) return;

        // Parse Data
        var title       = dataEl.querySelector('.data-title').textContent;
        var category    = dataEl.querySelector('.data-category').textContent;
        var catBadgeCls = dataEl.querySelector('.data-category-badge').textContent;
        var date        = dataEl.querySelector('.data-date').textContent;
        var loc         = dataEl.querySelector('.data-location').textContent;
        var desc        = dataEl.querySelector('.data-desc').textContent;
        currentVideoUrl = dataEl.querySelector('.data-video-url').textContent.trim();

        // Extract photos
        var photoNodes = dataEl.querySelectorAll('.data-photos .photo-item');
        currentPhotos  = [];
        photoNodes.forEach(function(node) {
            var u = node.textContent.trim();
            if (u) currentPhotos.push(u);
        });

        // Fallback if no photos but cover exists
        if (currentPhotos.length === 0) {
            var cover = card.querySelector('img') ? card.querySelector('img').getAttribute('src') : '';
            if (cover) currentPhotos.push(cover);
        }

        currentPhotoIdx = 0;
        isVideoMode     = false;

        // Set Headers & Captions
        lbTitle.textContent = title;
        lbCatBadge.textContent = category;
        lbCatBadge.className = 'px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider backdrop-blur-md border ' + (catBadgeCls || 'bg-teal-500/20 text-teal-300 border-teal-500/30');
        lbDate.textContent  = date;
        lbDesc.textContent  = desc || 'Dokumentasi resmi aktivitas Bank Syariah Wakalumi.';

        if (loc) {
            lbLocText.textContent = loc;
            lbLocWrap.classList.remove('hidden');
        } else {
            lbLocWrap.classList.add('hidden');
        }

        // Configure Video Button
        if (currentVideoUrl) {
            lbToggleVideo.classList.remove('hidden');
            document.getElementById('lb-video-btn-text').textContent = 'Putar Video';
        } else {
            lbToggleVideo.classList.add('hidden');
        }

        // Reset stages
        lbPhotoStage.classList.remove('hidden');
        lbVideoStage.classList.add('hidden');
        if (lbVideoIframe) lbVideoIframe.setAttribute('src', '');

        // Render Thumbnails
        renderThumbnails();

        // Display First Photo
        showPhoto(0);

        // Animate Open
        lightbox.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(function() {
            lightbox.classList.remove('opacity-0');
            lightbox.classList.add('opacity-100');
        });

        // Update URL hash without reload
        var cardId = card.getAttribute('id');
        if (cardId && history.replaceState) {
            history.replaceState(null, '', '#' + cardId);
        }
    }

    function closeLightbox() {
        lightbox.classList.remove('opacity-100');
        lightbox.classList.add('opacity-0');
        if (lbVideoIframe) lbVideoIframe.setAttribute('src', '');
        setTimeout(function() {
            lightbox.classList.add('hidden');
            document.body.style.overflow = '';
        }, 250);

        // Remove hash from URL
        if (history.replaceState) {
            history.replaceState(null, '', window.location.pathname + window.location.search);
        }
    }

    function showPhoto(idx) {
        if (currentPhotos.length === 0) return;
        if (idx < 0) idx = currentPhotos.length - 1;
        if (idx >= currentPhotos.length) idx = 0;
        currentPhotoIdx = idx;

        // Animate photo fade
        lbActiveImg.style.opacity = '0';
        setTimeout(function() {
            lbActiveImg.setAttribute('src', currentPhotos[currentPhotoIdx]);
            lbActiveImg.style.opacity = '1';
        }, 120);

        // Update counter
        lbCounter.textContent = 'Foto ' + (currentPhotoIdx + 1) + ' dari ' + currentPhotos.length;

        // Update active thumbnail
        var allThumbs = lbThumbStrip.querySelectorAll('.lb-thumb-btn');
        allThumbs.forEach(function(thumb, i) {
            if (i === currentPhotoIdx) {
                thumb.className = 'lb-thumb-btn flex-shrink-0 w-14 h-10 sm:w-16 sm:h-11 rounded-lg overflow-hidden border-2 border-teal-400 ring-2 ring-teal-400/50 shadow-md transform scale-105 transition-all';
                thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            } else {
                thumb.className = 'lb-thumb-btn flex-shrink-0 w-14 h-10 sm:w-16 sm:h-11 rounded-lg overflow-hidden border border-white/20 opacity-50 hover:opacity-100 transition-all cursor-pointer';
            }
        });
    }

    function renderThumbnails() {
        lbThumbStrip.innerHTML = '';
        currentPhotos.forEach(function(url, i) {
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = (i === 0)
                ? 'lb-thumb-btn flex-shrink-0 w-14 h-10 sm:w-16 sm:h-11 rounded-lg overflow-hidden border-2 border-teal-400 ring-2 ring-teal-400/50 shadow-md transform scale-105 transition-all'
                : 'lb-thumb-btn flex-shrink-0 w-14 h-10 sm:w-16 sm:h-11 rounded-lg overflow-hidden border border-white/20 opacity-50 hover:opacity-100 transition-all cursor-pointer';

            btn.innerHTML = '<img src="' + url + '" class="w-full h-full object-cover" loading="lazy">';
            btn.addEventListener('click', function() {
                if (isVideoMode) toggleVideoMode(false);
                showPhoto(i);
            });
            lbThumbStrip.appendChild(btn);
        });
    }

    function toggleVideoMode(force) {
        if (!currentVideoUrl) return;
        isVideoMode = (typeof force === 'boolean') ? force : !isVideoMode;

        if (isVideoMode) {
            lbPhotoStage.classList.add('hidden');
            lbVideoStage.classList.remove('hidden');

            // Format embed URL if YouTube
            var embedUrl = currentVideoUrl;
            if (embedUrl.indexOf('youtube.com/watch?v=') !== -1) {
                var vId = embedUrl.split('watch?v=')[1].split('&')[0];
                embedUrl = 'https://www.youtube.com/embed/' + vId + '?autoplay=1';
            } else if (embedUrl.indexOf('youtu.be/') !== -1) {
                var vId = embedUrl.split('youtu.be/')[1].split('?')[0];
                embedUrl = 'https://www.youtube.com/embed/' + vId + '?autoplay=1';
            }
            lbVideoIframe.setAttribute('src', embedUrl);
            document.getElementById('lb-video-btn-text').textContent = 'Kembali ke Foto';
        } else {
            lbVideoStage.classList.add('hidden');
            lbPhotoStage.classList.remove('hidden');
            lbVideoIframe.setAttribute('src', '');
            document.getElementById('lb-video-btn-text').textContent = 'Putar Video';
        }
    }

    // Bind Lightbox Triggers
    document.querySelectorAll('.galeri-card').forEach(function(card) {
        card.addEventListener('click', function(e) {
            e.preventDefault();
            openLightbox(this);
        });
    });

    if (lbCloseBtn) lbCloseBtn.addEventListener('click', closeLightbox);

    if (lbPrevBtn) {
        lbPrevBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (isVideoMode) toggleVideoMode(false);
            showPhoto(currentPhotoIdx - 1);
        });
    }

    if (lbNextBtn) {
        lbNextBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (isVideoMode) toggleVideoMode(false);
            showPhoto(currentPhotoIdx + 1);
        });
    }

    if (lbToggleVideo) {
        lbToggleVideo.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleVideoMode();
        });
    }

    // Share Button Event
    if (lbShareBtn) {
        lbShareBtn.addEventListener('click', function() {
            var url = window.location.href;
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(function() {
                    alert('Tautan album dokumentasi berhasil disalin ke clipboard!');
                });
            } else {
                prompt('Salin tautan ini:', url);
            }
        });
    }

    // Keyboard Navigation
    document.addEventListener('keydown', function(e) {
        if (!lightbox || lightbox.classList.contains('hidden')) return;
        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            if (isVideoMode) toggleVideoMode(false);
            showPhoto(currentPhotoIdx - 1);
        } else if (e.key === 'ArrowRight') {
            if (isVideoMode) toggleVideoMode(false);
            showPhoto(currentPhotoIdx + 1);
        }
    });

    // Touch Swipe Gesture Support for Mobile Devices
    var touchStartX = 0;
    var touchEndX   = 0;
    if (lightbox) {
        lightbox.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        lightbox.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
    }

    function handleSwipe() {
        var diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 45) { // Minimum swipe threshold
            if (diff > 0) {
                // Swipe Left -> Next photo
                if (isVideoMode) toggleVideoMode(false);
                showPhoto(currentPhotoIdx + 1);
            } else {
                // Swipe Right -> Prev photo
                if (isVideoMode) toggleVideoMode(false);
                showPhoto(currentPhotoIdx - 1);
            }
        }
    }

    // ── 3. HASH DEEP-LINKING (e.g. #alb_1) ───────────────────────────
    if (window.location.hash) {
        var targetId = window.location.hash.substring(1);
        var targetCard = document.getElementById(targetId);
        if (targetCard) {
            var targetIndex = filteredCards.indexOf(targetCard);
            if (targetIndex !== -1) {
                currentPage = Math.floor(targetIndex / itemsPerPage) + 1;
                renderPagination();
            }
            setTimeout(function() {
                openLightbox(targetCard);
            }, 350);
        }
    }

});
</script>

<?php get_footer(); ?>

