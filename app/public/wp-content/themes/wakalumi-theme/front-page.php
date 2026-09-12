<?php
/**
 * Front Page Template — Landing Page
 *
 * Sections:
 * 1. Hero
 * 2. Stats Counter
 * 3. Produk Preview
 * 4. Tentang Kami (About)
 * 5. Informasi Nisbah
 * 6. Berita Terbaru
 * 7. CTA (WhatsApp)
 *
 * @package Wakalumi
 */

get_header();

// Get ACF fields
$hero_headline    = get_field( 'hero_headline' ) ?: 'Bank Syariah Terpercaya untuk Masa Depan Anda';
$hero_subheadline = get_field( 'hero_subheadline' ) ?: 'Melayani dengan prinsip syariah, memberikan solusi keuangan yang amanah dan berkah bagi seluruh masyarakat.';
$hero_cta_text_1  = get_field( 'hero_cta_text_1' ) ?: 'Hubungi Kami';
$hero_cta_url_1   = get_field( 'hero_cta_url_1' ) ?: wakalumi_get_whatsapp_url();
$hero_cta_text_2  = get_field( 'hero_cta_text_2' ) ?: 'Lihat Produk';
$hero_cta_url_2   = get_field( 'hero_cta_url_2' ) ?: '/produk';
$hero_bg          = get_field( 'hero_background' );

$wa_url = wakalumi_get_whatsapp_url();
?>

<!-- ========================================
     SECTION 1: HERO
     ======================================== -->
<section class="relative min-h-[90vh] md:min-h-screen flex items-center overflow-hidden">
    <!-- Background Layer -->
    <div class="absolute inset-0">
        <?php if ( $hero_bg ) : ?>
            <img src="<?php echo esc_url( $hero_bg['sizes']['hero-large'] ?? $hero_bg['url'] ); ?>"
                 alt="" class="absolute inset-0 w-full h-full object-cover" loading="eager">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/70 to-slate-900/40
                         dark:from-dark/95 dark:via-dark/80 dark:to-dark/50"></div>
        <?php else : ?>
            <!-- Gradient Background (default when no image) -->
            <div class="absolute inset-0 gradient-hero dark:gradient-hero-dark"></div>
        <?php endif; ?>

        <!-- Decorative Orbs -->
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>

        <!-- Geometric Pattern -->
        <div class="pattern-overlay absolute inset-0"></div>
    </div>

    <!-- Content -->
    <div class="container-wide relative z-10 py-20">
        <div class="max-w-3xl">
            <!-- Badge -->
            <div data-aos="fade-up" data-aos-delay="100"
                 class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-8
                        bg-white/10 backdrop-blur-sm border border-white/10
                        dark:bg-primary-400/10 dark:border-primary-400/20">
                <span class="w-2 h-2 rounded-full bg-primary-400 animate-pulse"></span>
                <span class="text-xs font-semibold text-white/80 dark:text-primary-300 uppercase tracking-wider">
                    Bank Pembiayaan Rakyat Syariah
                </span>
            </div>

            <!-- Headline -->
            <h1 data-aos="fade-up" data-aos-delay="200"
                class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold leading-[1.1] tracking-tight mb-6
                       <?php echo $hero_bg ? 'text-white' : 'text-white'; ?>
                       dark:text-white dark:text-glow">
                <?php echo esc_html( $hero_headline ); ?>
            </h1>

            <!-- Sub-headline -->
            <p data-aos="fade-up" data-aos-delay="300"
               class="text-lg md:text-xl leading-relaxed mb-10 max-w-2xl
                      <?php echo $hero_bg ? 'text-white/70' : 'text-primary-100/80'; ?>
                      dark:text-slate-300">
                <?php echo esc_html( $hero_subheadline ); ?>
            </p>

            <!-- CTAs -->
            <div data-aos="fade-up" data-aos-delay="400"
                 class="flex flex-wrap items-center gap-4">
                <a href="<?php echo esc_url( $hero_cta_url_1 ); ?>"
                   <?php echo strpos( $hero_cta_url_1, 'wa.me' ) !== false ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
                   class="btn bg-white text-primary-700 hover:bg-primary-50 hover:shadow-xl hover:shadow-white/20 hover:-translate-y-0.5 text-sm px-8 py-4 rounded-xl font-bold
                          dark:bg-primary-400 dark:text-dark dark:hover:bg-primary-300 dark:btn-glow">
                    <?php if ( strpos( $hero_cta_url_1, 'wa.me' ) !== false ) : ?>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <?php endif; ?>
                    <?php echo esc_html( $hero_cta_text_1 ); ?>
                </a>
                <a href="<?php echo esc_url( $hero_cta_url_2 ); ?>"
                   class="btn border-2 border-white/30 text-white hover:bg-white/10 hover:-translate-y-0.5 text-sm px-8 py-4 rounded-xl font-bold
                          dark:border-primary-400/30 dark:text-primary-300 dark:hover:bg-primary-400/10">
                    <?php echo esc_html( $hero_cta_text_2 ); ?>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 animate-bounce hidden md:block">
        <div class="w-6 h-10 rounded-full border-2 border-white/30 dark:border-primary-400/30 flex items-start justify-center pt-2">
            <div class="w-1.5 h-3 rounded-full bg-white/50 dark:bg-primary-400/50 animate-pulse"></div>
        </div>
    </div>
</section>


<!-- ========================================
     SECTION 2: STATS COUNTER
     ======================================== -->
<?php
$stats = get_field( 'stats' );
if ( $stats ) :
?>
<section class="relative -mt-16 z-20 pb-8">
    <div class="container-wide">
        <div class="grid grid-cols-2 lg:grid-cols-<?php echo min( count( $stats ), 4 ); ?> gap-4 md:gap-6"
             data-aos="fade-up" data-aos-delay="100">
            <?php foreach ( $stats as $i => $stat ) : ?>
                <div class="card-glow rounded-2xl p-6 md:p-8 text-center
                            bg-white/90 backdrop-blur-xl border border-slate-100 shadow-xl shadow-slate-900/5
                            dark:bg-dark-surface/90 dark:border-dark-border dark:shadow-black/20"
                     data-aos="fade-up" data-aos-delay="<?php echo ( $i + 1 ) * 100; ?>">
                    <!-- Icon -->
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl mb-4
                                bg-primary-50 text-primary-600
                                dark:bg-primary-400/10 dark:text-primary-400">
                        <?php echo wakalumi_get_stat_icon( $stat['stat_icon'] ?? 'building' ); ?>
                    </div>
                    <!-- Number -->
                    <div class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-1">
                        <span data-counter="<?php echo esc_attr( $stat['stat_number'] ); ?>"
                              data-counter-suffix="<?php echo esc_attr( $stat['stat_suffix'] ?? '' ); ?>"
                              class="counter-number">0</span><?php echo esc_html( $stat['stat_suffix'] ?? '' ); ?>
                    </div>
                    <!-- Label -->
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">
                        <?php echo esc_html( $stat['stat_label'] ); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     SECTION 3: PRODUK PREVIEW
     ======================================== -->
<?php
$produk_query = new WP_Query( [
    'post_type'      => 'produk',
    'posts_per_page' => 4,
    'meta_query'     => [
        [
            'key'   => 'produk_featured',
            'value' => '1',
        ],
    ],
] );

// Fallback: if no featured products, get any 4
if ( ! $produk_query->have_posts() ) {
    $produk_query = new WP_Query( [
        'post_type'      => 'produk',
        'posts_per_page' => 4,
    ] );
}

if ( $produk_query->have_posts() ) :
?>
<section class="section bg-slate-50/50 dark:bg-dark-surface/50 relative">
    <div class="pattern-overlay"></div>
    <div class="container-wide relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="section-label mb-4 inline-block">Produk Kami</span>
            <h2 class="section-title mb-4">Solusi Keuangan <span class="text-primary-600 dark:text-primary-400">Syariah</span></h2>
            <p class="section-subtitle mx-auto">Pilihan produk perbankan syariah yang dirancang untuk memenuhi kebutuhan Anda dengan prinsip amanah.</p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $delay = 100;
            while ( $produk_query->have_posts() ) : $produk_query->the_post();
                get_template_part( 'template-parts/card-produk', null, [ 'delay' => $delay ] );
                $delay += 100;
            endwhile;
            wp_reset_postdata();
            ?>
        </div>

        <!-- View All Link -->
        <div class="text-center mt-10" data-aos="fade-up">
            <a href="<?php echo esc_url( home_url( '/produk' ) ); ?>" class="btn-outline text-sm">
                Lihat Semua Produk
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     SECTION 4: TENTANG KAMI (ABOUT PREVIEW)
     ======================================== -->
<?php
$about_label    = get_field( 'about_label' ) ?: 'Tentang Kami';
$about_title    = get_field( 'about_title' ) ?: 'Melayani dengan Prinsip Syariah Sejak Hari Pertama';
$about_content  = get_field( 'about_content' ) ?: '<p>BPRS Wakalumi hadir sebagai bank syariah yang berkomitmen memberikan layanan keuangan terbaik berdasarkan prinsip-prinsip syariah Islam.</p>';
$about_image    = get_field( 'about_image' );
$about_cta_text = get_field( 'about_cta_text' ) ?: 'Selengkapnya';
$about_cta_url  = get_field( 'about_cta_url' ) ?: '/profil/tentang-kami';
?>
<section class="section bg-white dark:bg-dark overflow-hidden">
    <div class="container-wide">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <!-- Image -->
            <div class="relative" data-aos="fade-right">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-primary-600/10 dark:shadow-primary-400/5">
                    <?php if ( $about_image ) : ?>
                        <img src="<?php echo esc_url( $about_image['sizes']['large'] ?? $about_image['url'] ); ?>"
                             alt="<?php echo esc_attr( $about_image['alt'] ?? 'Tentang BPRS Wakalumi' ); ?>"
                             class="w-full aspect-[4/3] object-cover"
                             loading="lazy">
                    <?php else : ?>
                        <div class="w-full aspect-[4/3] bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/30 dark:to-primary-800/30 flex items-center justify-center">
                            <svg class="w-24 h-24 text-primary-300 dark:text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Decorative element -->
                <div class="absolute -bottom-6 -right-6 w-32 h-32 rounded-3xl bg-primary-100 dark:bg-primary-900/30 -z-10"></div>
                <div class="absolute -top-6 -left-6 w-24 h-24 rounded-3xl border-2 border-primary-200 dark:border-primary-700/30 -z-10"></div>
            </div>

            <!-- Content -->
            <div data-aos="fade-left">
                <span class="section-label mb-4 inline-block"><?php echo esc_html( $about_label ); ?></span>
                <h2 class="section-title mb-6"><?php echo esc_html( $about_title ); ?></h2>
                <div class="prose prose-lg prose-slate dark:prose-invert max-w-none mb-8">
                    <?php echo wp_kses_post( $about_content ); ?>
                </div>
                <a href="<?php echo esc_url( $about_cta_url ); ?>" class="btn-primary text-sm">
                    <?php echo esc_html( $about_cta_text ); ?>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- ========================================
     SECTION 5: INFORMASI NISBAH
     ======================================== -->
<?php
$nisbah_bulan = get_field( 'nisbah_bulan', 'option' ) ?: 'September 2026';
$nisbah_data  = get_field( 'nisbah_data', 'option' );

if ( $nisbah_data ) :
?>
<section class="section bg-slate-50 dark:bg-dark-surface relative">
    <div class="pattern-overlay"></div>
    <div class="container-narrow relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="section-label mb-4 inline-block">Informasi Nisbah</span>
            <h2 class="section-title mb-4">Nisbah Bagi Hasil</h2>
            <p class="section-subtitle mx-auto">
                Informasi nisbah terkini untuk produk simpanan BPRS Wakalumi.
            </p>
            <div class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-full
                        bg-primary-100 text-primary-700 dark:bg-primary-400/10 dark:text-primary-400
                        text-sm font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                Periode: <?php echo esc_html( $nisbah_bulan ); ?>
            </div>
        </div>

        <!-- Nisbah Table -->
        <div class="card rounded-2xl overflow-hidden" data-aos="fade-up" data-aos-delay="100">
            <div class="overflow-x-auto">
                <table class="nisbah-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jenis</th>
                            <th class="text-center">Nasabah</th>
                            <th class="text-center">Bank</th>
                            <th class="text-center">Equiv. Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $nisbah_data as $i => $row ) : ?>
                            <tr data-aos="fade-up" data-aos-delay="<?php echo ( $i + 1 ) * 50; ?>">
                                <td class="font-medium text-slate-900 dark:text-white">
                                    <?php echo esc_html( $row['nisbah_produk'] ); ?>
                                </td>
                                <td>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                        <?php echo $row['nisbah_jenis'] === 'tabungan'
                                            ? 'bg-blue-50 text-blue-700 dark:bg-blue-400/10 dark:text-blue-400'
                                            : 'bg-purple-50 text-purple-700 dark:bg-purple-400/10 dark:text-purple-400'; ?>">
                                        <?php echo esc_html( ucfirst( $row['nisbah_jenis'] ) ); ?>
                                    </span>
                                </td>
                                <td class="text-center font-semibold text-primary-600 dark:text-primary-400">
                                    <?php echo esc_html( $row['nisbah_nasabah'] ); ?>%
                                </td>
                                <td class="text-center text-slate-600 dark:text-slate-400">
                                    <?php echo esc_html( $row['nisbah_bank'] ); ?>%
                                </td>
                                <td class="text-center">
                                    <span class="font-semibold text-slate-900 dark:text-white">
                                        <?php echo esc_html( $row['nisbah_equiv'] ); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Table Footer Note -->
            <div class="px-6 py-4 bg-slate-50 dark:bg-dark-surface-alt border-t border-slate-100 dark:border-dark-border">
                <p class="text-xs text-slate-500 dark:text-slate-500">
                    * Nisbah bagi hasil dapat berubah sewaktu-waktu sesuai kebijakan bank. Equivalent rate merupakan indikasi, bukan jaminan return.
                </p>
            </div>
        </div>

        <!-- Link to full Nisbah page -->
        <div class="text-center mt-8" data-aos="fade-up">
            <a href="<?php echo esc_url( home_url( '/informasi/nisbah' ) ); ?>" class="btn-ghost text-sm">
                Lihat Riwayat Nisbah
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     SECTION 6: BERITA TERBARU
     ======================================== -->
<?php
$berita_query = new WP_Query( [
    'post_type'      => 'berita',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
] );

if ( $berita_query->have_posts() ) :
?>
<section class="section bg-white dark:bg-dark">
    <div class="container-wide">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-14" data-aos="fade-up">
            <div>
                <span class="section-label mb-4 inline-block">Berita Terbaru</span>
                <h2 class="section-title">Kabar dari <span class="text-primary-600 dark:text-primary-400">Wakalumi</span></h2>
            </div>
            <a href="<?php echo esc_url( home_url( '/berita' ) ); ?>"
               class="btn-ghost text-sm whitespace-nowrap">
                Semua Berita
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $delay = 100;
            while ( $berita_query->have_posts() ) : $berita_query->the_post();
                get_template_part( 'template-parts/card-berita', null, [ 'delay' => $delay ] );
                $delay += 150;
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     SECTION 7: CTA (WhatsApp)
     ======================================== -->
<?php
$cta_headline              = get_field( 'cta_headline' ) ?: 'Siap Memulai Perjalanan Keuangan Syariah Anda?';
$cta_subtext               = get_field( 'cta_subtext' ) ?: 'Hubungi kami untuk konsultasi gratis atau kunjungi kantor cabang terdekat.';
$cta_button_text           = get_field( 'cta_button_text' ) ?: 'Chat via WhatsApp';
$cta_button_secondary_text = get_field( 'cta_button_secondary_text' ) ?: 'Lihat Jaringan Kantor';
$cta_button_secondary_url  = get_field( 'cta_button_secondary_url' ) ?: '/profil/jaringan-kantor';
?>
<section class="relative py-24 md:py-32 overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 gradient-hero dark:gradient-hero-dark"></div>
    <div class="hero-orb hero-orb-1 opacity-10"></div>
    <div class="hero-orb hero-orb-2 opacity-10"></div>
    <div class="pattern-overlay absolute inset-0"></div>

    <div class="container-narrow relative z-10 text-center">
        <h2 data-aos="fade-up"
            class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6
                   dark:text-glow">
            <?php echo esc_html( $cta_headline ); ?>
        </h2>
        <p data-aos="fade-up" data-aos-delay="100"
           class="text-lg text-primary-100/80 dark:text-slate-300 max-w-2xl mx-auto mb-10">
            <?php echo esc_html( $cta_subtext ); ?>
        </p>
        <div data-aos="fade-up" data-aos-delay="200"
             class="flex flex-wrap items-center justify-center gap-4">
            <a href="<?php echo esc_url( $wa_url ); ?>"
               target="_blank" rel="noopener noreferrer"
               class="btn bg-white text-primary-700 hover:bg-primary-50 hover:shadow-xl hover:shadow-white/20 hover:-translate-y-0.5 text-sm px-8 py-4 rounded-xl font-bold
                      dark:bg-primary-400 dark:text-dark dark:hover:bg-primary-300 dark:btn-glow">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                <?php echo esc_html( $cta_button_text ); ?>
            </a>
            <?php if ( $cta_button_secondary_text ) : ?>
                <a href="<?php echo esc_url( $cta_button_secondary_url ); ?>"
                   class="btn border-2 border-white/30 text-white hover:bg-white/10 hover:-translate-y-0.5 text-sm px-8 py-4 rounded-xl font-bold
                          dark:border-primary-400/30 dark:text-primary-300 dark:hover:bg-primary-400/10">
                    <?php echo esc_html( $cta_button_secondary_text ); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>

