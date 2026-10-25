<?php
/**
 * Template Name: Halaman Pengumuman Resmi
 * Description: Portal Publikasi Pengumuman Resmi & Surat Edaran BPRS Wakalumi
 * 
 * @package Wakalumi
 */

get_header();

// ── DATA RETRIEVAL ──────────────────────────────────────────────────
$header          = wakalumi_get_pengumuman_header();
$categories      = wakalumi_get_pengumuman_categories();
$all_list        = wakalumi_get_pengumuman_list();

// Filter active only for public display
$pengumuman_list = array_values( array_filter( $all_list, function( $item ) {
    return ( $item['status'] ?? 'aktif' ) === 'aktif';
}) );

// Extract unique years for filter
$years = [];
foreach ( $pengumuman_list as $item ) {
    $y = date( 'Y', strtotime( $item['tanggal'] ?? date( 'Y-m-d' ) ) );
    if ( $y && ! in_array( $y, $years, true ) ) {
        $years[] = $y;
    }
}
rsort( $years );

$wa_number = get_option( 'options_contact_wa', '6281517380388' );
$wa_url    = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );
?>

<div class="min-h-screen bg-transparent text-slate-800 dark:text-slate-200 pb-20">

    <!-- ========================================================================
         SECTION 1: HERO HEADER BANNER & GOVERNANCE BADGE WATERMARK CARD
         ======================================================================== -->
    <section class="wkl-page-hero">
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
                <span class="text-teal-600 dark:text-teal-400 font-semibold">Pengumuman Resmi</span>
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
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Publikasi Sah & Terverifikasi</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <span>Peringatan Keamanan & Operasional</span>
                        </div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-sm font-medium">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            <span>Dokumen Lampiran PDF Resmi</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Dual-Tone Executive Trust Card with Slide Watermark -->
                <div class="lg:col-span-4" data-aos="fade-left" data-aos-delay="100">
                    <div class="spotlight-card relative overflow-hidden rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] text-center group cursor-default">
                        <div class="wkl-glass-shine"></div>

                        <!-- Top Dual-Tone Zone: Header, Icon & Title -->
                        <div class="relative px-6 pt-7 pb-5 bg-gradient-to-b from-teal-50/85 via-sky-50/40 to-white dark:from-teal-950/45 dark:via-slate-900/80 dark:to-slate-900 border-b border-slate-100 dark:border-slate-800/80 overflow-hidden">
                            <!-- Subtle Top Accent Line -->
                            <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-teal-500 via-cyan-400 to-emerald-500 opacity-90"></div>

                            <!-- Interactive Slide Watermark Emblem -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-32 h-32 opacity-[0.04] dark:opacity-[0.03] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-110 group-hover:opacity-[0.07] dark:group-hover:opacity-[0.05] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                            </div>

                            <!-- Soft Dual-Tone Ring Notice Icon -->
                            <div class="relative w-14 h-14 rounded-2xl bg-white dark:bg-slate-800 border border-teal-200/80 dark:border-teal-800/70 text-teal-600 dark:text-teal-300 flex items-center justify-center mx-auto mb-3.5 shadow-sm group-hover:bg-teal-600 group-hover:text-white group-hover:border-teal-600 group-hover:scale-105 transition-all duration-500 z-10">
                                <svg class="w-7 h-7 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                            </div>

                            <div class="relative z-10">
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/90 dark:bg-slate-800 text-teal-700 dark:text-teal-300 border border-teal-200/70 dark:border-teal-800/60 text-[10px] font-bold uppercase tracking-wider mb-1.5 shadow-2xs">
                                    <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                                    <?php echo esc_html( $header['card_badge'] ); ?>
                                </div>
                                <h4 class="text-lg font-extrabold text-slate-900 dark:text-white"><?php echo esc_html( $header['card_title'] ); ?></h4>
                            </div>
                        </div>

                        <!-- Bottom Dual-Tone Zone: Description, Reg Tags & Button -->
                        <div class="p-5 sm:px-6 bg-white dark:bg-slate-900/95 space-y-4 relative z-10">
                            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed text-center sm:text-left">
                                <?php echo esc_html( $header['card_desc'] ); ?>
                            </p>

                            <div class="pt-1 flex items-center justify-center gap-2">
                                <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    Diawasi OJK
                                </span>
                                <span class="text-slate-300 dark:text-slate-600">•</span>
                                <span class="text-[11px] font-bold text-slate-600 dark:text-slate-400 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    Dijamin LPS
                                </span>
                            </div>

                            <div class="pt-1">
                                <a href="#ann-cards-grid" class="w-full py-2.5 px-4 rounded-xl bg-slate-50 hover:bg-teal-50/80 dark:bg-slate-800/80 dark:hover:bg-teal-950/50 border border-slate-200/80 hover:border-teal-300 dark:border-slate-700/80 dark:hover:border-teal-700 inline-flex items-center justify-center gap-2 text-xs font-bold text-teal-700 dark:text-teal-300 transition-all duration-300 group/annbtn">
                                    <span>Lihat Pengumuman Terkini</span>
                                    <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/annbtn:translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========================================================================
         SECTION 2: FILTER PILLS, SEARCH & YEAR CONTROLS
         ======================================================================== -->
    <section class="py-8 bg-transparent relative z-10 border-b border-slate-200/50 dark:border-dark-border/50">
        <div class="container-wide">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
                
                <!-- Category Tabs (Horizontal Scroll on Mobile) -->
                <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-2 lg:pb-0" id="ann-category-filters" role="tablist">
                    <button type="button" data-filter="all" class="ann-filter-btn active-tab px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-300 whitespace-nowrap bg-gradient-to-r from-teal-600 to-cyan-600 text-white shadow-md shadow-teal-600/20 border border-teal-500">
                        Semua Pengumuman (<?php echo count( $pengumuman_list ); ?>)
                    </button>
                    <?php foreach ( $categories as $ckey => $cval ) : 
                        $count_cat = count( array_filter( $pengumuman_list, fn($x) => ( $x['kategori'] ?? '' ) === $ckey ) );
                        if ( $count_cat === 0 ) continue;
                    ?>
                        <button type="button" data-filter="<?php echo esc_attr( $ckey ); ?>" class="ann-filter-btn px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-300 whitespace-nowrap bg-white/90 dark:bg-dark-card/90 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-dark-border hover:bg-slate-100 dark:hover:bg-dark-surface-alt">
                            <?php echo esc_html( $cval['pill_label'] ?? $cval['label'] ); ?>
                            <span class="ml-1 text-[11px] font-extrabold opacity-75">(<?php echo $count_cat; ?>)</span>
                        </button>
                    <?php endforeach; ?>
                </div>

                <!-- Right Side: Live Search & Year Select -->
                <div class="flex items-center gap-3 w-full lg:w-auto flex-shrink-0">
                    <!-- Search Input -->
                    <div class="relative flex-1 sm:w-72">
                        <input type="text" id="ann-search-input" placeholder="Cari pengumuman..." class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/90 dark:bg-dark-card/90 border border-slate-200 dark:border-dark-border text-xs sm:text-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500/50 shadow-sm transition-all">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>

                    <!-- Year Dropdown -->
                    <?php if ( ! empty( $years ) ) : ?>
                        <div class="relative flex-shrink-0">
                            <select id="ann-year-filter" class="appearance-none pl-3.5 pr-8 py-2.5 rounded-xl bg-white/90 dark:bg-dark-card/90 border border-slate-200 dark:border-dark-border text-xs sm:text-sm font-bold text-slate-700 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-teal-500/50 shadow-sm cursor-pointer">
                                <option value="all">Semua Tahun</option>
                                <?php foreach ( $years as $yr ) : ?>
                                    <option value="<?php echo esc_attr( $yr ); ?>">Tahun <?php echo esc_html( $yr ); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <svg class="w-3.5 h-3.5 text-slate-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>


    <!-- ========================================================================
         SECTION 3: ANNOUNCEMENT CARDS GRID & RESULTS
         ======================================================================== -->
    <section class="py-10 md:py-14 bg-transparent relative z-10">
        <div class="container-wide">

            <!-- Active Filter Status Indicator (Hidden by default, shown when filtering) -->
            <div id="ann-filter-indicator" class="hidden mb-6 flex items-center justify-between text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                <span>Menampilkan hasil pencarian & filter: <strong id="ann-result-count" class="text-teal-600 dark:text-teal-400 font-extrabold">0</strong> pengumuman ditemukan</span>
                <button type="button" id="ann-reset-filter" class="text-teal-600 dark:text-teal-400 hover:underline font-bold">Reset Filter</button>
            </div>

            <!-- Empty State -->
            <div id="ann-empty-state" class="<?php echo empty( $pengumuman_list ) ? '' : 'hidden'; ?> text-center py-16 px-4 bg-white/80 dark:bg-dark-card/80 backdrop-blur-md rounded-3xl border border-dashed border-slate-300 dark:border-dark-border">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center mx-auto mb-4 shadow-sm">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 100-6 3 3 0 000 6z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Tidak Ada Pengumuman Ditemukan</h3>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 max-w-md mx-auto">
                    Tidak ada pengumuman yang sesuai dengan kriteria pencarian atau filter yang Anda pilih. Silakan gunakan kata kunci lain.
                </p>
            </div>

            <!-- Cards Grid (2-column layout on desktop) -->
            <div id="ann-cards-grid" class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <?php foreach ( $pengumuman_list as $index => $item ) : 
                    $row_id      = esc_attr( $item['id'] ?? ( 'ann_' . $index ) );
                    $judul       = $item['judul'] ?? '';
                    $kategori    = $item['kategori'] ?? 'umum';
                    $cat_info    = $categories[$kategori] ?? $categories['umum'];
                    $urgensi     = $item['urgensi'] ?? 'normal';
                    $is_urgent   = ( $urgensi === 'penting' );
                    $raw_date    = $item['tanggal'] ?? date( 'Y-m-d' );
                    $date_year   = date( 'Y', strtotime( $raw_date ) );
                    $date_id     = date_i18n( 'd F Y', strtotime( $raw_date ) );
                    $nomor_surat = $item['nomor_surat'] ?? '';
                    $ringkasan   = $item['ringkasan'] ?? '';
                    $isi_lengkap = $item['isi_lengkap'] ?? '';
                    $gambar      = $item['gambar'] ?? '';
                    $file_pdf    = $item['file_pdf'] ?? '';
                    $file_size   = $item['file_size'] ?? 'PDF Resmi';
                    $link_active = ! empty( $item['link_active'] );
                    $link_text   = ! empty( $item['link_text'] ) ? $item['link_text'] : 'Kunjungi Tautan';
                    $link_url    = $item['link_url'] ?? '';
                    $link_target = ! empty( $item['link_target'] ) ? $item['link_target'] : '_self';
                ?>
                    <article id="<?php echo $row_id; ?>"
                             class="ann-card card group relative flex flex-col h-full bg-white dark:bg-dark-surface border <?php echo $is_urgent ? 'border-amber-200/90 dark:border-amber-800/60 shadow-amber-500/5 hover:border-amber-400 dark:hover:border-amber-500' : 'border-slate-200/80 dark:border-dark-border hover:border-teal-400 dark:hover:border-teal-600 shadow-teal-500/5'; ?> rounded-2xl md:rounded-3xl overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 before:absolute before:inset-x-0 before:top-0 before:h-1 before:bg-gradient-to-r before:from-transparent <?php echo $is_urgent ? 'before:via-amber-400' : 'before:via-teal-500'; ?> before:to-transparent before:opacity-0 group-hover:before:opacity-100 before:transition-opacity before:duration-500 z-10"
                             data-id="<?php echo $row_id; ?>"
                             data-category="<?php echo esc_attr( $kategori ); ?>"
                             data-year="<?php echo esc_attr( $date_year ); ?>"
                             data-urgent="<?php echo $is_urgent ? '1' : '0'; ?>"
                             data-title="<?php echo esc_attr( strtolower( $judul ) ); ?>"
                             data-content="<?php echo esc_attr( strtolower( $ringkasan . ' ' . $nomor_surat ) ); ?>"
                             data-aos="fade-up"
                             data-aos-delay="<?php echo min( 300, ( $index % 4 ) * 80 ); ?>">

                        <!-- Decorative Watermark Logo (Interactive Hover Effect) -->
                        <div class="absolute -right-6 -bottom-6 w-36 h-36 opacity-[0.055] dark:opacity-[0.04] pointer-events-none select-none overflow-hidden transition-all duration-700 ease-out group-hover:scale-125 group-hover:-translate-x-2 group-hover:-translate-y-2 group-hover:opacity-[0.11] dark:group-hover:opacity-[0.08] mix-blend-multiply dark:mix-blend-screen z-0">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" 
                                 alt="" 
                                 class="w-full h-full object-contain brightness-0 dark:brightness-100" 
                                 loading="lazy"
                                 aria-hidden="true">
                        </div>

                        <!-- Top Graphic Slot: Flush Edge-to-Edge ("Ngepas" tanpa margin/padding khusus) -->
                        <?php if ( ! empty( $gambar ) ) : ?>
                            <div class="relative w-full aspect-[16/10] overflow-hidden bg-slate-100 dark:bg-slate-800 shrink-0 group/img">
                                <img src="<?php echo esc_url( $gambar ); ?>"
                                     alt="<?php echo esc_attr( $judul ); ?>"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                     loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/15 to-transparent opacity-40 group-hover:opacity-60 transition-opacity duration-300"></div>
                                
                                <!-- Glass Glare Sweep Effect -->
                                <div class="wkl-glass-shine"></div>

                                <!-- Floating Category Badge -->
                                <span class="absolute top-3.5 right-3.5 inline-flex items-center gap-1.5 text-[10px] sm:text-[11px] font-extrabold px-3 py-1 rounded-full border backdrop-blur-md bg-white/95 dark:bg-slate-900/95 shadow-md z-10 <?php echo esc_attr( $cat_info['badge_class'] ?? 'bg-teal-50 text-teal-700 border-teal-200' ); ?>">
                                    <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $cat_info['tag_dot'] ?? 'bg-teal-500' ); ?>"></span>
                                    <?php echo esc_html( $cat_info['label'] ?? 'Pengumuman Resmi' ); ?>
                                </span>

                                <!-- Urgent Pulsing Tag on Image -->
                                <?php if ( $is_urgent ) : ?>
                                    <span class="absolute top-3.5 left-3.5 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-900/85 dark:bg-slate-950/85 text-amber-300 backdrop-blur-md text-[10px] font-black uppercase tracking-wider shadow-md z-10 border border-amber-400/40">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                        PENTING
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Card Body with Internal Padding -->
                        <div class="p-6 sm:p-7 flex flex-col flex-1 relative z-10 justify-between">
                            <div>
                                <?php if ( empty( $gambar ) ) : ?>
                                    <!-- Fallback Top Row when No Image (Category Pill, Urgent & Category Icon) -->
                                    <div class="flex items-center justify-between gap-3 mb-4">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border <?php echo esc_attr( $cat_info['badge_class'] ?? 'bg-teal-50 text-teal-700 border-teal-200' ); ?>">
                                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $cat_info['tag_dot'] ?? 'bg-teal-500' ); ?>"></span>
                                                <?php echo esc_html( $cat_info['label'] ?? 'Pengumuman Resmi' ); ?>
                                            </span>
                                            <?php if ( $is_urgent ) : ?>
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-amber-50 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300 border border-amber-300 dark:border-amber-800 text-[10px] font-black uppercase tracking-wider shadow-xs">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                    PENTING
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="w-10 h-10 rounded-2xl bg-teal-50 dark:bg-dark-border text-teal-600 dark:text-teal-400 flex items-center justify-center shrink-0 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-sm border border-slate-200/60 dark:border-dark-border">
                                            <?php echo wakalumi_get_announcement_icon( $cat_info['icon'] ?? 'megaphone' ); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Meta Row: Date & Nomor Surat Edaran -->
                                <div class="flex items-center gap-2.5 text-xs font-semibold text-slate-500 dark:text-slate-400 mb-2.5 flex-wrap">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <?php echo esc_html( $date_id ); ?>
                                    </span>
                                    <?php if ( ! empty( $nomor_surat ) ) : ?>
                                        <span>•</span>
                                        <span class="inline-flex items-center gap-1 font-mono text-[11px] px-2 py-0.5 rounded bg-slate-100 dark:bg-dark-surface border border-slate-200 dark:border-dark-border">
                                            <?php echo esc_html( $nomor_surat ); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Judul Pengumuman -->
                                <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white tracking-tight leading-snug group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors mb-2.5 cursor-pointer btn-open-ann-modal" data-id="<?php echo $row_id; ?>">
                                    <?php echo esc_html( $judul ); ?>
                                </h3>

                                <!-- Ringkasan Teks -->
                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed mb-4 line-clamp-3">
                                    <?php echo esc_html( $ringkasan ); ?>
                                </p>
                            </div>

                            <!-- Footer Action Bar -->
                            <div class="pt-5 mt-4 border-t border-slate-100 dark:border-dark-border/80 flex items-center justify-between gap-2.5 flex-wrap">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <!-- PDF Attachment Button (If Available) -->
                                    <?php if ( ! empty( $file_pdf ) ) : ?>
                                        <a href="<?php echo esc_url( $file_pdf ); ?>"
                                           target="_blank"
                                           download
                                           class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold bg-slate-100 dark:bg-dark-surface text-slate-700 dark:text-slate-300 hover:bg-teal-50 dark:hover:bg-teal-950/60 hover:text-teal-700 dark:hover:text-teal-300 border border-slate-200 dark:border-dark-border transition-all">
                                            <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                            <span>PDF</span>
                                            <span class="text-[10px] text-slate-400 font-normal hidden sm:inline">(<?php echo esc_html( $file_size ); ?>)</span>
                                        </a>
                                    <?php endif; ?>

                                    <!-- Optional Action Link Button -->
                                    <?php if ( $link_active && ! empty( $link_url ) ) : ?>
                                        <a href="<?php echo esc_url( $link_url ); ?>"
                                           target="<?php echo esc_attr( $link_target ); ?>"
                                           <?php echo ( $link_target === '_blank' ) ? 'rel="noopener noreferrer"' : ''; ?>
                                           class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold bg-amber-50 dark:bg-amber-950/40 text-amber-800 dark:text-amber-300 hover:bg-amber-100 dark:hover:bg-amber-900/60 border border-amber-200/80 dark:border-amber-700/60 transition-all">
                                            <svg class="w-3.5 h-3.5 text-amber-600 dark:text-amber-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            <span class="truncate max-w-[130px] sm:max-w-[170px]"><?php echo esc_html( $link_text ); ?></span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if ( empty( $file_pdf ) && ( ! $link_active || empty( $link_url ) ) ) : ?>
                                        <span class="text-[11px] text-slate-400 italic">Pemberitahuan Resmi</span>
                                    <?php endif; ?>
                                </div>

                                <!-- Open Modal Button -->
                                <button type="button"
                                        class="btn-open-ann-modal inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-extrabold bg-teal-600 hover:bg-teal-700 text-white shadow-md shadow-teal-600/20 hover:shadow-teal-600/30 transition-all hover:scale-[1.02] active:scale-[0.98] shrink-0"
                                        data-id="<?php echo $row_id; ?>">
                                    <span>Baca Lengkap</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>

                        </div>

                        <!-- Hidden Data Store for Quick Reader Modal -->
                        <div class="ann-modal-data hidden">
                            <span class="data-title"><?php echo esc_html( $judul ); ?></span>
                            <span class="data-category"><?php echo esc_html( $cat_info['label'] ?? 'Pengumuman' ); ?></span>
                            <span class="data-category-badge"><?php echo esc_attr( $cat_info['badge_class'] ?? '' ); ?></span>
                            <span class="data-category-dot"><?php echo esc_attr( $cat_info['tag_dot'] ?? 'bg-teal-500' ); ?></span>
                            <span class="data-date"><?php echo esc_html( $date_id ); ?></span>
                            <span class="data-nomor"><?php echo esc_html( $nomor_surat ); ?></span>
                            <span class="data-urgent"><?php echo $is_urgent ? '1' : '0'; ?></span>
                            <span class="data-image"><?php echo esc_url( $gambar ); ?></span>
                            <span class="data-pdf"><?php echo esc_url( $file_pdf ); ?></span>
                            <span class="data-pdf-size"><?php echo esc_html( $file_size ); ?></span>
                            <span class="data-link-active"><?php echo $link_active ? '1' : '0'; ?></span>
                            <span class="data-link-text"><?php echo esc_html( $link_text ); ?></span>
                            <span class="data-link-url"><?php echo esc_url( $link_url ); ?></span>
                            <span class="data-link-target"><?php echo esc_attr( $link_target ); ?></span>
                            <div class="data-content"><?php echo nl2br( esc_html( $isi_lengkap ? $isi_lengkap : $ringkasan ) ); ?></div>
                        </div>

                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Pagination Container (Max 10 Items per Page) -->
            <div id="ann-pagination-wrap" class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-slate-200/80 dark:border-dark-border hidden">
                <div id="ann-pagination-info" class="text-xs sm:text-sm font-medium text-slate-500 dark:text-slate-400 text-center sm:text-left">
                    <!-- Populated by JS -->
                </div>
                <nav id="ann-pagination-nav" class="flex items-center gap-1.5 flex-wrap justify-center" aria-label="Navigasi Halaman Pengumuman">
                    <!-- Populated by JS -->
                </nav>
            </div>

        </div>
    </section>


    <!-- ========================================================================
         SECTION 4: QUICK READER MODAL (LIGHTBOX DETAIL PENGUMUMAN)
         ======================================================================== -->
    <div id="ann-detail-modal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center p-4 sm:p-6 overflow-y-auto" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div id="ann-modal-backdrop" class="fixed inset-0 bg-slate-950/70 backdrop-blur-md transition-opacity duration-300 opacity-0"></div>

        <!-- Modal Card Container -->
        <div id="ann-modal-card" class="relative z-10 w-full max-w-3xl my-auto bg-white dark:bg-dark-card rounded-3xl shadow-2xl border border-slate-200 dark:border-dark-border overflow-hidden transition-all duration-300 transform scale-95 opacity-0 flex flex-col max-h-[88vh]">
            
            <!-- Top Gradient Bar -->
            <div id="modal-top-accent" class="h-2 w-full bg-gradient-to-r from-teal-500 via-cyan-400 to-teal-600 flex-shrink-0"></div>

            <!-- Modal Header -->
            <div class="p-6 sm:p-8 border-b border-slate-100 dark:border-dark-border/80 flex-shrink-0">
                <div class="flex items-center justify-between gap-4 mb-3">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span id="modal-category" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border"></span>
                        <span id="modal-urgent-badge" class="hidden inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-amber-50 dark:bg-amber-950 text-amber-800 dark:text-amber-300 border border-amber-300 dark:border-amber-800 text-[10px] font-black uppercase">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            PENTING
                        </span>
                        <span id="modal-date" class="text-xs font-semibold text-slate-500 dark:text-slate-400"></span>
                    </div>

                    <!-- Close Button -->
                    <button type="button" id="btn-close-modal" class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-dark-surface text-slate-400 hover:text-slate-700 dark:hover:text-white flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <h2 id="modal-title" class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight leading-snug"></h2>

                <div id="modal-nomor-wrap" class="mt-3 hidden">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-dark-surface text-slate-600 dark:text-slate-400 font-mono text-xs font-semibold border border-slate-200 dark:border-dark-border">
                        <svg class="w-3.5 h-3.5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        <span id="modal-nomor"></span>
                    </span>
                </div>
            </div>

            <!-- Modal Content (Scrollable) -->
            <div id="modal-scroll-area" class="p-6 sm:p-8 overflow-y-auto flex-1 space-y-6">
                <!-- Poster Banner Image (Full Genuine Aspect Ratio & Orientation) -->
                <div id="modal-image-wrap" class="hidden rounded-2xl overflow-hidden bg-slate-100 dark:bg-dark-surface border border-slate-200/80 dark:border-dark-border shadow-md flex flex-col items-center justify-center p-2.5 sm:p-3">
                    <img id="modal-image" src="" alt="" class="max-w-full h-auto max-h-[65vh] sm:max-h-[550px] object-contain rounded-xl mx-auto shadow-xs">
                    <div class="mt-2.5 flex items-center justify-between w-full px-2 text-[11px] text-slate-400">
                        <span class="inline-flex items-center gap-1 font-medium">
                            <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                            Format Asli Dokumen
                        </span>
                        <a id="modal-image-full-link" href="#" target="_blank" class="text-teal-600 dark:text-teal-400 font-bold hover:underline inline-flex items-center gap-1">
                            <span>Buka Gambar Penuh</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Main Body Content -->
                <div id="modal-body" class="text-slate-700 dark:text-slate-300 text-sm sm:text-base leading-relaxed space-y-4"></div>

                <!-- PDF Attachment Box -->
                <div id="modal-pdf-box" class="hidden rounded-2xl p-4 sm:p-5 bg-teal-50/80 dark:bg-teal-950/40 border border-teal-200/80 dark:border-teal-800/60 flex items-center justify-between gap-4 flex-wrap">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-teal-100 dark:bg-teal-900/60 text-teal-600 dark:text-teal-300 flex items-center justify-center flex-shrink-0 shadow-sm border border-teal-200/60 dark:border-teal-800/60">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                        </div>
                        <div>
                            <div class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white">Dokumen Surat Edaran / Pengumuman Resmi (PDF)</div>
                            <div id="modal-pdf-size" class="text-xs text-slate-500 dark:text-slate-400">PDF Terverifikasi</div>
                        </div>
                    </div>
                    <a id="modal-pdf-download" href="" target="_blank" download class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold bg-teal-600 hover:bg-teal-700 text-white shadow-md shadow-teal-600/20 transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>Unduh Dokumen</span>
                    </a>
                </div>

                <!-- Custom Action Link Box (If Activated in Admin) -->
                <div id="modal-action-box" class="hidden rounded-2xl p-4 sm:p-5 bg-gradient-to-r from-amber-50 to-amber-100/60 dark:from-amber-950/40 dark:to-dark-surface border border-amber-200/80 dark:border-amber-800/60 flex items-center justify-between gap-4 flex-wrap">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        </div>
                        <div>
                            <div class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white">Tautan Halaman / Portal Resmi</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">Klik tautan di samping untuk menuju halaman rujukan terkait.</div>
                        </div>
                    </div>
                    <a id="modal-action-link" href="#" target="_self" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-extrabold bg-amber-600 hover:bg-amber-700 text-white shadow-md shadow-amber-600/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                        <span id="modal-action-text">Kunjungi Halaman</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 sm:p-6 bg-slate-50 dark:bg-dark-surface border-t border-slate-100 dark:border-dark-border flex items-center justify-between gap-3 flex-wrap flex-shrink-0">
                <div class="flex items-center gap-2">
                    <button type="button" id="btn-copy-link" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border text-slate-600 dark:text-slate-300 hover:bg-slate-100 transition-colors">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                        <span id="copy-link-text">Salin Tautan</span>
                    </button>
                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 hover:bg-emerald-100 transition-colors">
                        💬 Hubungi CS
                    </a>
                </div>

                <button type="button" id="btn-modal-close-footer" class="px-5 py-2 rounded-xl text-xs sm:text-sm font-bold bg-slate-200 dark:bg-dark-card text-slate-700 dark:text-slate-200 hover:bg-slate-300 dark:hover:bg-dark-surface-alt transition-colors">
                    Tutup Pengumuman
                </button>
            </div>

        </div>
    </div>


    <!-- ========================================================================
         SECTION 5: BOTTOM CTA (CENTERED STYLING SESUAI STANDAR WAKALUMI)
         ======================================================================== -->
    <section class="relative z-10 py-16 md:py-24 overflow-hidden bg-transparent border-t border-slate-200/80 dark:border-dark-border">
        <div class="container-narrow relative z-10">
            <div class="spotlight-card group relative overflow-hidden rounded-3xl p-8 sm:p-12 md:p-16 bg-gradient-to-b from-slate-900 via-slate-900 to-teal-950 text-white text-center shadow-2xl border border-teal-500/30">
                
                <!-- Ambient Glow Orbs -->
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-96 h-96 bg-teal-500/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <!-- Watermark Emblem (Centered Ambient Background) -->
                <div class="absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2 w-80 sm:w-96 h-80 sm:h-96 opacity-[0.04] dark:opacity-[0.05] pointer-events-none select-none overflow-hidden transition-transform duration-700 ease-out group-hover:scale-110 grayscale mix-blend-screen z-0">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 invert">
                </div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-5">
                    <!-- Kicker Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-500/20 text-teal-300 border border-teal-500/40 text-xs font-bold uppercase tracking-wider shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                        <span>Pusat Layanan &amp; Verifikasi Nasabah</span>
                    </div>

                    <!-- Title -->
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight">
                        Ada Pertanyaan Mengenai Pengumuman Resmi BPRS Wakalumi?
                    </h2>

                    <!-- Subtitle -->
                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                        Tim Layanan Nasabah dan Petugas Kepatuhan kami siap melayani klarifikasi terkait keaslian surat edaran, jadwal operasional, lelang agunan, dan kepatuhan syariah.
                    </p>

                    <!-- Action Buttons Centered -->
                    <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                        <a href="<?php echo esc_url( $wa_url ); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center gap-2.5 px-8 py-4 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-400 hover:to-cyan-400 text-slate-950 font-black text-sm shadow-xl shadow-teal-500/25 hover:shadow-teal-500/40 hover:-translate-y-0.5 transition-all">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.966-.941 1.164-.173.199-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span>Hubungi Layanan WhatsApp</span>
                        </a>

                        <a href="<?php echo esc_url( home_url( '/pengaduan-konsumen/' ) ); ?>"
                           class="inline-flex items-center gap-2 px-7 py-4 rounded-xl bg-white/10 hover:bg-white/15 text-white font-bold text-sm border border-white/20 hover:border-white/40 transition-all hover:-translate-y-0.5">
                            <span>Portal Pengaduan Konsumen</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>

                    <!-- Trust Footer Text -->
                    <div class="pt-4 flex items-center justify-center gap-3 text-xs text-slate-400">
                        <span>PT BPRS Wakalumi terdaftar &amp; diawasi oleh OJK</span>
                        <span>•</span>
                        <span>Peserta Penjaminan LPS</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>


<!-- ========================================================================
     CLIENT-SIDE INTERACTIVE FILTER & MODAL JAVASCRIPT
     ======================================================================== -->
<script>
(function() {
    function initAnnouncementPage() {
        var categoryBtns    = document.querySelectorAll('.ann-filter-btn');
        var searchInput     = document.getElementById('ann-search-input');
        var yearFilter      = document.getElementById('ann-year-filter');
        var cards           = Array.from(document.querySelectorAll('.ann-card'));
        var emptyState      = document.getElementById('ann-empty-state');
        var filterIndicator = document.getElementById('ann-filter-indicator');
        var resultCountEl   = document.getElementById('ann-result-count');
        var resetFilterBtn  = document.getElementById('ann-reset-filter');
        var paginationWrap  = document.getElementById('ann-pagination-wrap');
        var paginationInfo  = document.getElementById('ann-pagination-info');
        var paginationNav   = document.getElementById('ann-pagination-nav');

        if (!cards.length) return;

        var ITEMS_PER_PAGE = 10;
        var currentPage   = 1;
        var currentCat    = 'all';
        var currentYear   = 'all';
        var currentSearch = '';
        var filteredCards = [];

        function renderPagination(totalPages, startItem, endItem, totalItems) {
            if (!paginationInfo || !paginationNav) return;

            paginationInfo.innerHTML = 'Menampilkan <span class="font-bold text-slate-800 dark:text-white">' + startItem + ' – ' + endItem + '</span> dari <span class="font-bold text-teal-600 dark:text-teal-400">' + totalItems + '</span> pengumuman';

            var navHtml = '';

            // Previous Button
            var prevDisabled = (currentPage === 1);
            navHtml += '<button type="button" class="ann-page-btn px-3 py-2 rounded-xl text-xs sm:text-sm font-bold border transition-all flex items-center gap-1 ' + 
                (prevDisabled ? 'opacity-40 cursor-not-allowed bg-slate-100 dark:bg-dark-surface text-slate-400 border-slate-200 dark:border-dark-border' : 'bg-white dark:bg-dark-card text-slate-700 dark:text-slate-300 border-slate-200 dark:border-dark-border hover:bg-teal-50 dark:hover:bg-dark-surface-alt hover:text-teal-600 dark:hover:text-teal-400 shadow-xs active:scale-95') + 
                '" data-page="' + (currentPage - 1) + '" ' + (prevDisabled ? 'disabled' : '') + '><span>←</span><span class="hidden sm:inline">Sebelumnya</span></button>';

            // Page Numbers
            for (var p = 1; p <= totalPages; p++) {
                if (totalPages > 7) {
                    if (p !== 1 && p !== totalPages && Math.abs(p - currentPage) > 2) {
                        if (p === 2 || p === totalPages - 1) {
                            navHtml += '<span class="px-2 py-1 text-slate-400 text-xs">...</span>';
                        }
                        continue;
                    }
                }

                var isCurrent = (p === currentPage);
                navHtml += '<button type="button" class="ann-page-btn w-9 h-9 sm:w-10 sm:h-10 rounded-xl text-xs sm:text-sm font-bold border transition-all flex items-center justify-center ' + 
                    (isCurrent ? 'bg-gradient-to-r from-teal-600 to-cyan-600 text-white border-teal-500 shadow-md shadow-teal-600/30 cursor-default' : 'bg-white dark:bg-dark-card text-slate-700 dark:text-slate-300 border-slate-200 dark:border-dark-border hover:bg-teal-50 dark:hover:bg-dark-surface-alt hover:text-teal-600 dark:hover:text-teal-400 shadow-xs active:scale-95') + 
                    '" data-page="' + p + '">' + p + '</button>';
            }

            // Next Button
            var nextDisabled = (currentPage === totalPages);
            navHtml += '<button type="button" class="ann-page-btn px-3 py-2 rounded-xl text-xs sm:text-sm font-bold border transition-all flex items-center gap-1 ' + 
                (nextDisabled ? 'opacity-40 cursor-not-allowed bg-slate-100 dark:bg-dark-surface text-slate-400 border-slate-200 dark:border-dark-border' : 'bg-white dark:bg-dark-card text-slate-700 dark:text-slate-300 border-slate-200 dark:border-dark-border hover:bg-teal-50 dark:hover:bg-dark-surface-alt hover:text-teal-600 dark:hover:text-teal-400 shadow-xs active:scale-95') + 
                '" data-page="' + (currentPage + 1) + '" ' + (nextDisabled ? 'disabled' : '') + '><span class="hidden sm:inline">Berikutnya</span><span>→</span></button>';

            paginationNav.innerHTML = navHtml;

            // Click Events on Pagination Buttons
            paginationNav.querySelectorAll('.ann-page-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    if (this.disabled) return;
                    var targetPage = parseInt(this.getAttribute('data-page'), 10);
                    if (targetPage && targetPage !== currentPage && targetPage >= 1 && targetPage <= totalPages) {
                        currentPage = targetPage;
                        renderCurrentPage(true);
                    }
                });
            });
        }

        function renderCurrentPage(shouldScroll) {
            var totalItems = filteredCards.length;
            var totalPages = Math.ceil(totalItems / ITEMS_PER_PAGE);

            if (currentPage > totalPages && totalPages > 0) {
                currentPage = totalPages;
            }
            if (currentPage < 1) {
                currentPage = 1;
            }

            var startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
            var endIndex = Math.min(startIndex + ITEMS_PER_PAGE, totalItems);

            // Show matching cards for current page slice, hide other matching cards
            filteredCards.forEach(function(card, idx) {
                if (idx >= startIndex && idx < endIndex) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });

            // Empty State & Pagination visibility
            if (totalItems === 0) {
                if (emptyState) emptyState.classList.remove('hidden');
                if (paginationWrap) paginationWrap.classList.add('hidden');
            } else {
                if (emptyState) emptyState.classList.add('hidden');
                if (paginationWrap) {
                    if (totalPages > 1) {
                        paginationWrap.classList.remove('hidden');
                        renderPagination(totalPages, startIndex + 1, endIndex, totalItems);
                    } else {
                        paginationWrap.classList.add('hidden');
                    }
                }
            }

            // Filter status indicator
            if (currentCat !== 'all' || currentYear !== 'all' || currentSearch !== '') {
                if (filterIndicator) filterIndicator.classList.remove('hidden');
                if (resultCountEl) resultCountEl.textContent = totalItems;
            } else {
                if (filterIndicator) filterIndicator.classList.add('hidden');
            }

            // Smooth scroll to top of card grid
            if (shouldScroll) {
                var grid = document.getElementById('ann-cards-grid');
                if (grid) {
                    var topOffset = grid.getBoundingClientRect().top + window.pageYOffset - 120;
                    window.scrollTo({ top: topOffset, behavior: 'smooth' });
                }
            }
        }

        function applyFilters(resetPage) {
            if (resetPage !== false) {
                currentPage = 1;
            }

            filteredCards = [];
            cards.forEach(function(card) {
                var cat     = card.getAttribute('data-category');
                var yr      = card.getAttribute('data-year');
                var title   = card.getAttribute('data-title') || '';
                var content = card.getAttribute('data-content') || '';

                var matchCat    = (currentCat === 'all' || cat === currentCat);
                var matchYear   = (currentYear === 'all' || yr === currentYear);
                var matchSearch = (!currentSearch || title.indexOf(currentSearch) !== -1 || content.indexOf(currentSearch) !== -1);

                if (matchCat && matchYear && matchSearch) {
                    filteredCards.push(card);
                } else {
                    card.style.display = 'none';
                }
            });

            renderCurrentPage(false);
        }

        // Category Tab Events
        categoryBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                categoryBtns.forEach(function(b) {
                    b.classList.remove('active-tab', 'bg-gradient-to-r', 'from-teal-600', 'to-cyan-600', 'text-white', 'shadow-md', 'border-teal-500');
                    b.classList.add('bg-white/90', 'dark:bg-dark-card/90', 'text-slate-700', 'dark:text-slate-300', 'border-slate-200', 'dark:border-dark-border');
                });
                btn.classList.add('active-tab', 'bg-gradient-to-r', 'from-teal-600', 'to-cyan-600', 'text-white', 'shadow-md', 'border-teal-500');
                btn.classList.remove('bg-white/90', 'dark:bg-dark-card/90', 'text-slate-700', 'dark:text-slate-300', 'border-slate-200', 'dark:border-dark-border');

                currentCat = btn.getAttribute('data-filter');
                applyFilters(true);
            });
        });

        // Search Input Event
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                currentSearch = this.value.trim().toLowerCase();
                applyFilters(true);
            });
        }

        // Year Filter Event
        if (yearFilter) {
            yearFilter.addEventListener('change', function() {
                currentYear = this.value;
                applyFilters(true);
            });
        }

        // Reset Filter Event
        if (resetFilterBtn) {
            resetFilterBtn.addEventListener('click', function() {
                currentCat = 'all';
                currentYear = 'all';
                currentSearch = '';
                if (searchInput) searchInput.value = '';
                if (yearFilter) yearFilter.value = 'all';
                if (categoryBtns[0]) categoryBtns[0].click();
            });
        }

        // ── MODAL QUICK READER LOGIC ────────────────────────────────────
        // Clean up any stale modal from previous SPA transitions in document.body
        var existingModals = document.querySelectorAll('#ann-detail-modal');
        if (existingModals.length > 1) {
            for (var m = 0; m < existingModals.length - 1; m++) {
                existingModals[m].remove();
            }
        }

        var modal         = document.getElementById('ann-detail-modal');
        var modalBackdrop = document.getElementById('ann-modal-backdrop');
        var modalCard     = document.getElementById('ann-modal-card');
        var btnCloseModal = document.getElementById('btn-close-modal');
        var btnCloseFooter= document.getElementById('btn-modal-close-footer');
        var copyLinkBtn   = document.getElementById('btn-copy-link');
        var copyLinkText  = document.getElementById('copy-link-text');

        // CRITICAL: Teleport modal directly to document.body so that Swup's #swup
        // (.transition-fade with CSS transform: translateY(0)) does not trap position: fixed.
        // This ensures the modal is ALWAYS centered in the user's visible viewport wherever clicked.
        if (modal && modal.parentNode !== document.body) {
            document.body.appendChild(modal);
        }

        // Swup cleanup: remove teleported modal when navigating away from this page
        if (window.swup && window.swup.hooks) {
            window.swup.hooks.once('visit:start', function() {
                var staleModal = document.getElementById('ann-detail-modal');
                if (staleModal) staleModal.remove();
                document.body.style.overflow = '';
            });
        }

        var currentActiveId = '';

        function openAnnouncementModal(cardId) {
            var card = document.getElementById(cardId);
            if (!card) return;

            var dataEl = card.querySelector('.ann-modal-data');
            if (!dataEl) return;

            currentActiveId = cardId;

            // Populate Modal Fields
            document.getElementById('modal-title').textContent = dataEl.querySelector('.data-title').textContent;
            document.getElementById('modal-date').textContent  = dataEl.querySelector('.data-date').textContent;
            document.getElementById('modal-body').innerHTML    = dataEl.querySelector('.data-content').innerHTML;

            var catBadge = document.getElementById('modal-category');
            catBadge.textContent = dataEl.querySelector('.data-category').textContent;
            catBadge.className   = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border ' + (dataEl.querySelector('.data-category-badge').textContent || 'bg-teal-50 text-teal-700 border-teal-200');

            var isUrgent = dataEl.querySelector('.data-urgent').textContent === '1';
            var urgentBadge = document.getElementById('modal-urgent-badge');
            var topAccent   = document.getElementById('modal-top-accent');
            if (isUrgent) {
                urgentBadge.classList.remove('hidden');
                topAccent.className = 'h-2 w-full bg-gradient-to-r from-amber-500 via-amber-400 to-amber-600 flex-shrink-0';
            } else {
                urgentBadge.classList.add('hidden');
                topAccent.className = 'h-2 w-full bg-gradient-to-r from-teal-500 via-cyan-400 to-teal-600 flex-shrink-0';
            }

            var nomor = dataEl.querySelector('.data-nomor').textContent.trim();
            var nomorWrap = document.getElementById('modal-nomor-wrap');
            if (nomor) {
                document.getElementById('modal-nomor').textContent = nomor;
                nomorWrap.classList.remove('hidden');
            } else {
                nomorWrap.classList.add('hidden');
            }

            var pdfUrl = dataEl.querySelector('.data-pdf').textContent.trim();
            var pdfBox = document.getElementById('modal-pdf-box');
            if (pdfUrl) {
                pdfBox.classList.remove('hidden');
                document.getElementById('modal-pdf-download').setAttribute('href', pdfUrl);
                document.getElementById('modal-pdf-size').textContent = dataEl.querySelector('.data-pdf-size').textContent || 'PDF Terverifikasi';
            } else {
                pdfBox.classList.add('hidden');
            }

            var imgUrl = dataEl.querySelector('.data-image') ? dataEl.querySelector('.data-image').textContent.trim() : '';
            var imgWrap = document.getElementById('modal-image-wrap');
            var modalImg = document.getElementById('modal-image');
            var imgFullLink = document.getElementById('modal-image-full-link');
            if (imgUrl && imgWrap && modalImg) {
                modalImg.setAttribute('src', imgUrl);
                if (imgFullLink) imgFullLink.setAttribute('href', imgUrl);
                imgWrap.classList.remove('hidden');
            } else if (imgWrap && modalImg) {
                modalImg.setAttribute('src', '');
                if (imgFullLink) imgFullLink.setAttribute('href', '#');
                imgWrap.classList.add('hidden');
            }

            // Custom Action Link Box Handler
            var linkActive = dataEl.querySelector('.data-link-active') ? dataEl.querySelector('.data-link-active').textContent.trim() === '1' : false;
            var linkUrl    = dataEl.querySelector('.data-link-url') ? dataEl.querySelector('.data-link-url').textContent.trim() : '';
            var linkText   = dataEl.querySelector('.data-link-text') ? dataEl.querySelector('.data-link-text').textContent.trim() : 'Kunjungi Halaman';
            var linkTarget = dataEl.querySelector('.data-link-target') ? dataEl.querySelector('.data-link-target').textContent.trim() : '_self';
            var actionBox  = document.getElementById('modal-action-box');
            var actionLink = document.getElementById('modal-action-link');
            var actionText = document.getElementById('modal-action-text');

            if (linkActive && linkUrl && actionBox && actionLink) {
                actionLink.setAttribute('href', linkUrl);
                actionLink.setAttribute('target', linkTarget);
                if (linkTarget === '_blank') {
                    actionLink.setAttribute('rel', 'noopener noreferrer');
                } else {
                    actionLink.removeAttribute('rel');
                }
                if (actionText) actionText.textContent = linkText;
                actionBox.classList.remove('hidden');
            } else if (actionBox) {
                actionBox.classList.add('hidden');
            }

            // Reset modal internal scroll to top so user always reads from the start
            if (modal) modal.scrollTop = 0;
            var scrollArea = document.getElementById('modal-scroll-area');
            if (scrollArea) scrollArea.scrollTop = 0;

            // Show Modal right in front of user's active screen
            modal.classList.remove('hidden');
            requestAnimationFrame(function() {
                modalBackdrop.classList.remove('opacity-0');
                modalCard.classList.remove('scale-95', 'opacity-0');
                modalCard.classList.add('scale-100', 'opacity-100');
            });

            document.body.style.overflow = 'hidden';

            // Update URL hash smoothly without causing browser scroll jump
            if (window.history && window.history.replaceState) {
                window.history.replaceState(null, '', '#' + cardId);
            }
        }

        function closeAnnouncementModal() {
            modalBackdrop.classList.add('opacity-0');
            modalCard.classList.remove('scale-100', 'opacity-100');
            modalCard.classList.add('scale-95', 'opacity-0');

            setTimeout(function() {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }, 250);

            if (window.history && window.history.replaceState) {
                window.history.replaceState(null, '', window.location.pathname + window.location.search);
            }
        }

        // Modal Trigger Buttons (Buttons & Card Titles)
        document.querySelectorAll('.btn-open-ann-modal').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var id = this.getAttribute('data-id');
                openAnnouncementModal(id);
            });
        });

        if (btnCloseModal) btnCloseModal.addEventListener('click', closeAnnouncementModal);
        if (btnCloseFooter) btnCloseFooter.addEventListener('click', closeAnnouncementModal);
        if (modalBackdrop) modalBackdrop.addEventListener('click', closeAnnouncementModal);

        // Click on outer padding area to close
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeAnnouncementModal();
                }
            });
        }

        // Escape Key to Close
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                closeAnnouncementModal();
            }
        });

        // Copy Link Feature
        if (copyLinkBtn) {
            copyLinkBtn.addEventListener('click', function() {
                var url = window.location.origin + window.location.pathname + '#' + currentActiveId;
                navigator.clipboard.writeText(url).then(function() {
                    copyLinkText.textContent = 'Tautan Disalin! ✓';
                    setTimeout(function() {
                        copyLinkText.textContent = 'Salin Tautan';
                    }, 2000);
                });
            });
        }

        // Initial apply filters & pagination
        applyFilters(true);

        // Auto-Open on Page Load if URL has hash (e.g. from Toast / Pop-Up click)
        var hash = window.location.hash.replace('#', '');
        if (hash && document.getElementById(hash)) {
            var targetIndex = -1;
            for (var i = 0; i < filteredCards.length; i++) {
                if (filteredCards[i].id === hash) {
                    targetIndex = i;
                    break;
                }
            }
            if (targetIndex !== -1) {
                currentPage = Math.floor(targetIndex / ITEMS_PER_PAGE) + 1;
                renderCurrentPage(false);
            }
            setTimeout(function() {
                var targetEl = document.getElementById(hash);
                if (targetEl) {
                    targetEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    openAnnouncementModal(hash);
                }
            }, 400);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAnnouncementPage);
    } else {
        initAnnouncementPage();
    }

    // Support Swup SPA navigation
    if (window.swup && window.swup.hooks) {
        window.swup.hooks.on('page:view', initAnnouncementPage);
    }
})();
</script>

<?php get_footer(); ?>

