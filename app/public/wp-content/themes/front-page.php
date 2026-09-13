<?php
/**
 * Template Name: Beranda (Front Page)
 * Front Page Template — Landing Page
 *
 * Sections:
 * 1. Announcement Bar (toggleable)
 * 2. Hero Slider / Carousel
 * 3. Stats Counter
 * 4. Produk Preview
 * 5. Tentang Kami (About)
 * 6. Informasi Nisbah
 * 7. Berita Terbaru
 * 8. CTA (WhatsApp)
 *
 * @package Wakalumi
 */

get_header();

$wa_number = get_option( 'options_contact_wa', '6281517380388' );
$wa_url    = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );
?>

<!-- ========================================
     SECTION 0: ANNOUNCEMENT BAR (toggleable via ACF options)
     ======================================== -->
<?php
$ann_active    = get_option( 'options_announcement_active', '0' );
$ann_text      = get_option( 'options_announcement_text', '' );
$ann_link_text = get_option( 'options_announcement_link_text', '' );
$ann_link_url  = get_option( 'options_announcement_link_url', '' );
$ann_type      = get_option( 'options_announcement_type', 'info' );
$ann_hash      = md5( $ann_text ); // reset dismissal when text changes

if ( $ann_active && $ann_text ) :
?>
<div id="announcement-bar"
     data-hash="<?php echo esc_attr( $ann_hash ); ?>"
     class="announcement-bar <?php echo 'announcement-' . esc_attr( $ann_type ); ?>">
    <div class="container-wide py-3 flex items-center justify-center gap-3 text-sm">
        <!-- Icon -->
        <svg class="w-4 h-4 text-white/80 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" />
        </svg>
        <span class="text-white font-medium"><?php echo esc_html( $ann_text ); ?></span>
        <?php if ( $ann_link_text && $ann_link_url ) : ?>
            <a href="<?php echo esc_url( $ann_link_url ); ?>"
               class="text-white font-bold underline underline-offset-2 hover:text-white/80 transition-colors">
                <?php echo esc_html( $ann_link_text ); ?>
            </a>
        <?php endif; ?>
        <!-- Dismiss button -->
        <button id="announcement-dismiss" class="ml-2 text-white/60 hover:text-white transition-colors flex-shrink-0" aria-label="Tutup pengumuman">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
<?php endif; ?>


<!-- ========================================
     SECTION 1: HERO SLIDER
     ======================================== -->
<?php
// Query hero slides from CPT (free — no ACF PRO needed!)
$slides_query = new WP_Query( [
    'post_type'      => 'hero_slide',
    'posts_per_page' => 5,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
] );

// Fallback slides when no CPT posts exist
$fallback_slides = [
    [
        'headline'    => 'Bank Syariah Terpercaya untuk Masa Depan Anda',
        'subheadline' => 'Melayani dengan prinsip syariah, memberikan solusi keuangan yang amanah dan berkah bagi seluruh masyarakat.',
        'gradient'    => 'gradient-hero-1',
    ],
    [
        'headline'    => 'Pembiayaan Mudah, Berkah Selalu',
        'subheadline' => 'Solusi pembiayaan syariah dengan akad yang transparan dan proses yang cepat untuk kebutuhan Anda.',
        'gradient'    => 'gradient-hero-2',
    ],
    [
        'headline'    => 'Tabungan & Deposito Syariah',
        'subheadline' => 'Simpan dana Anda dengan aman dan dapatkan bagi hasil yang kompetitif sesuai prinsip syariah Islam.',
        'gradient'    => 'gradient-hero-3',
    ],
];

$has_cpt_slides = $slides_query->have_posts();
$slide_count    = $has_cpt_slides ? $slides_query->post_count : count( $fallback_slides );
?>

<!-- ========================================
     GLOBAL FIXED BACKGROUND EMBLEM WATERMARK (Pure CSS Layer z-[1])
     ======================================== -->
<div id="fixed-watermark-emblem" 
     class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[1] pointer-events-none flex items-center justify-center select-none"
     aria-hidden="true">
    <!-- Compact Box: smooth abu muda with 3D shadow (soft & proper watermark in both light & dark mode) -->
    <div class="w-24 h-24 md:w-28 md:h-28 rounded-2xl md:rounded-3xl bg-slate-100/90 dark:bg-slate-800/60 backdrop-blur-md border border-slate-200/90 dark:border-slate-700/60 shadow-[0_15px_35px_-8px_rgba(0,0,0,0.14),0_6px_16px_-4px_rgba(0,0,0,0.06),inset_0_2px_4px_rgba(255,255,255,0.9),inset_0_-2px_4px_rgba(0,0,0,0.06)] dark:shadow-[0_15px_35px_-8px_rgba(0,0,0,0.7),0_6px_16px_-4px_rgba(0,0,0,0.4),inset_0_1px_2px_rgba(255,255,255,0.08),inset_0_-2px_4px_rgba(0,0,0,0.4)] flex items-center justify-center p-3 md:p-3.5">
        <!-- Emblem Logo: Neutral Abu-Abu (Slate) Faded Watermark via CSS Mask -->
        <div class="w-16 h-16 md:w-20 md:h-20 bg-slate-500 dark:bg-slate-300 opacity-35 dark:opacity-30"
             style="-webkit-mask-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center; mask-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png'); mask-size: contain; mask-repeat: no-repeat; mask-position: center;">
        </div>
    </div>
</div>

<section id="hero-slider" class="hero-slider sticky top-0 h-screen flex items-center overflow-hidden z-[2] bg-slate-900">
    <!-- Faint Logo Watermarks (Opacity 7%) -->
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" class="absolute -top-20 -left-20 w-[40rem] opacity-[0.07] rotate-12 pointer-events-none z-[2]" style="opacity: 0.07;" alt="">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-white-mask.png" class="absolute -bottom-40 -right-20 w-[50rem] opacity-[0.07] rotate-[-15deg] pointer-events-none z-[2]" style="opacity: 0.07;" alt="">

    <!-- Decorative Orbs -->
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>

    <!-- Pattern Overlay -->
    <div class="pattern-overlay absolute inset-0 z-[1]"></div>

    <!-- Slides -->
    <?php if ( $has_cpt_slides ) : ?>
        <?php
        $slide_index = 0;
        while ( $slides_query->have_posts() ) : $slides_query->the_post();
            $slide_headline    = get_the_title();
            $slide_subheadline = get_field( 'slide_subheadline' ) ?: '';
            $slide_cta_text    = get_field( 'slide_cta_text' ) ?: 'Hubungi Kami';
            $slide_cta_url     = get_field( 'slide_cta_url' ) ?: $wa_url;
            $slide_cta_text_2  = get_field( 'slide_cta_text_2' ) ?: 'Lihat Produk';
            $slide_cta_url_2   = get_field( 'slide_cta_url_2' ) ?: home_url( '/produk' );
            $slide_opacity     = get_field( 'slide_overlay_opacity' ) ?: 60;

            // Gambar Desktop: Cek ACF -> Cek Post Meta -> Cek Featured Image
            $img_desk = '';
            if ( function_exists( 'get_field' ) ) {
                $acf_desk = get_field( 'slide_image_desktop' );
                $img_desk = is_array( $acf_desk ) ? ( $acf_desk['url'] ?? '' ) : $acf_desk;
            }
            if ( empty( $img_desk ) ) {
                $img_desk = get_post_meta( get_the_ID(), '_slide_image_desktop', true );
            }
            if ( empty( $img_desk ) && has_post_thumbnail() ) {
                $img_desk = get_the_post_thumbnail_url( get_the_ID(), 'hero-large' );
            }

            // Gambar Mobile: Cek ACF -> Cek Post Meta -> Fallback ke Desktop
            $img_mob = '';
            if ( function_exists( 'get_field' ) ) {
                $acf_mob = get_field( 'slide_image_mobile' );
                $img_mob = is_array( $acf_mob ) ? ( $acf_mob['url'] ?? '' ) : $acf_mob;
            }
            if ( empty( $img_mob ) ) {
                $img_mob = get_post_meta( get_the_ID(), '_slide_image_mobile', true );
            }
            if ( empty( $img_mob ) ) {
                $img_mob = $img_desk;
            }

            $has_any_image = ( ! empty( $img_desk ) || ! empty( $img_mob ) );
        ?>
        <div class="hero-slide <?php echo $slide_index === 0 ? 'active' : ''; ?>" data-slide="<?php echo $slide_index; ?>">
            <!-- Background (Responsive Desktop & Mobile) -->
            <div class="hero-slide-bg">
                <?php if ( $has_any_image ) : ?>
                    <picture class="w-full h-full block">
                        <?php if ( ! empty( $img_mob ) && $img_mob !== $img_desk ) : ?>
                            <source media="(max-width: 768px)" srcset="<?php echo esc_url( $img_mob ); ?>">
                        <?php endif; ?>
                        <?php if ( ! empty( $img_desk ) ) : ?>
                            <source media="(min-width: 769px)" srcset="<?php echo esc_url( $img_desk ); ?>">
                        <?php endif; ?>
                        <img src="<?php echo esc_url( $img_desk ?: $img_mob ); ?>" 
                             alt="<?php echo esc_attr( $slide_headline ); ?>" 
                             class="w-full h-full object-cover" 
                             loading="<?php echo $slide_index === 0 ? 'eager' : 'lazy'; ?>">
                    </picture>
                <?php else : ?>
                    <div class="absolute inset-0 gradient-hero-<?php echo ( $slide_index % 3 ) + 1; ?>"></div>
                <?php endif; ?>
            </div>

            <!-- Overlay -->
            <div class="hero-slide-overlay" style="opacity: <?php echo esc_attr( $slide_opacity / 100 ); ?>"></div>

            <!-- Content -->
            <div class="hero-slide-content container-wide relative z-10 flex items-center min-h-[90vh] md:min-h-screen py-20">
                <div class="max-w-3xl">
                    <!-- Badge -->
                    <div class="slide-badge inline-flex items-center gap-2 px-4 py-2 rounded-full mb-8
                                bg-white/10 backdrop-blur-md border border-white/20 shadow-[0_0_15px_rgba(255,255,255,0.1)]
                                dark:bg-primary-400/10 dark:border-primary-400/20">
                        <span class="w-2 h-2 rounded-full bg-primary-300 animate-pulse"></span>
                        <span class="text-xs font-bold text-white uppercase tracking-wider">
                            Bank Syariah Wakalumi
                        </span>
                    </div>

                    <!-- Headline -->
                    <h1 class="slide-headline text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold leading-[1.1] tracking-tight mb-6
                               text-white dark:text-white dark:text-glow">
                        <?php echo esc_html( $slide_headline ); ?>
                    </h1>

                    <!-- Subheadline -->
                    <?php if ( $slide_subheadline ) : ?>
                        <p class="slide-subheadline text-lg md:text-xl leading-relaxed mb-10 max-w-2xl
                                  text-white/80 dark:text-slate-300">
                            <?php echo esc_html( $slide_subheadline ); ?>
                        </p>
                    <?php endif; ?>

                    <!-- CTA -->
                    <div class="slide-cta flex flex-wrap items-center gap-4">
                        <a href="<?php echo esc_url( $slide_cta_url ); ?>"
                           class="btn bg-white text-primary-700 hover:bg-primary-50 hover:shadow-xl hover:shadow-white/20 hover:-translate-y-0.5 text-sm px-8 py-4 rounded-xl font-bold
                                  dark:bg-primary-300 dark:text-dark dark:hover:bg-primary-200 dark:btn-glow">
                            <?php echo esc_html( $slide_cta_text ); ?>
                        </a>
                        <?php if ( $slide_cta_url_2 ) : ?>
                            <a href="<?php echo esc_url( $slide_cta_url_2 ); ?>"
                               class="btn border-2 border-white/30 text-white hover:bg-white/10 hover:-translate-y-0.5 text-sm px-8 py-4 rounded-xl font-bold
                                      dark:border-primary-400/30 dark:text-primary-300 dark:hover:bg-primary-400/10">
                                <?php echo esc_html( $slide_cta_text_2 ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $slide_index++;
        endwhile;
        wp_reset_postdata();
        ?>

    <?php else : ?>
        <!-- Fallback slides (placeholder gradients) -->
        <?php foreach ( $fallback_slides as $idx => $slide ) : ?>
        <div class="hero-slide <?php echo $idx === 0 ? 'active' : ''; ?>" data-slide="<?php echo $idx; ?>">
            <!-- Gradient Background -->
            <div class="hero-slide-bg">
                <div class="absolute inset-0 <?php echo esc_attr( $slide['gradient'] ); ?>"></div>
            </div>

            <!-- Overlay -->
            <div class="hero-slide-overlay" style="opacity: 0.4"></div>

            <!-- Content -->
            <div class="hero-slide-content container-wide relative z-10 flex items-center min-h-[90vh] md:min-h-screen py-20">
                <div class="max-w-3xl">
                    <div class="slide-badge inline-flex items-center gap-2 px-4 py-2 rounded-full mb-8
                                bg-white/10 backdrop-blur-md border border-white/20 shadow-[0_0_15px_rgba(255,255,255,0.1)]
                                dark:bg-primary-400/10 dark:border-primary-400/20">
                        <span class="w-2 h-2 rounded-full bg-primary-300 animate-pulse"></span>
                        <span class="text-xs font-bold text-white uppercase tracking-wider">
                            Bank Syariah Wakalumi
                        </span>
                    </div>

                    <h1 class="slide-headline text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold leading-[1.1] tracking-tight mb-6
                               text-white dark:text-white dark:text-glow">
                        <?php echo esc_html( $slide['headline'] ); ?>
                    </h1>

                    <p class="slide-subheadline text-lg md:text-xl leading-relaxed mb-10 max-w-2xl
                              text-white/70 dark:text-slate-300">
                        <?php echo esc_html( $slide['subheadline'] ); ?>
                    </p>

                    <div class="slide-cta flex flex-wrap items-center gap-4">
                        <a href="<?php echo esc_url( $wa_url ); ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="btn bg-white text-primary-700 hover:bg-primary-50 hover:shadow-xl hover:shadow-white/20 hover:-translate-y-0.5 text-sm px-8 py-4 rounded-xl font-bold
                                  dark:bg-primary-300 dark:text-dark dark:hover:bg-primary-200 dark:btn-glow">
                            Hubungi Kami
                        </a>
                        <a href="<?php echo esc_url( home_url( '/produk' ) ); ?>"
                           class="btn border-2 border-white/30 text-white hover:bg-white/10 hover:-translate-y-0.5 text-sm px-8 py-4 rounded-xl font-bold
                                  dark:border-primary-400/30 dark:text-primary-300 dark:hover:bg-primary-400/10">
                            Lihat Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Dot Indicators -->
    <?php if ( $slide_count > 1 ) : ?>
    <div class="slider-dots">
        <?php for ( $i = 0; $i < $slide_count; $i++ ) : ?>
            <button class="slider-dot <?php echo $i === 0 ? 'active' : ''; ?>"
                    data-slide="<?php echo $i; ?>"
                    aria-label="Slide <?php echo $i + 1; ?>"></button>
        <?php endfor; ?>
    </div>
    <!-- Progress Bar -->
    <div class="slider-progress"></div>

    <!-- Hidden Arrows for Slider -->
    <button class="slider-arrow prev absolute left-0 top-0 bottom-0 w-24 md:w-40 z-20 cursor-pointer opacity-0 hover:opacity-100 transition-opacity bg-gradient-to-r from-black/20 to-transparent flex items-center justify-start pl-4 md:pl-8 text-white/50 hover:text-white" aria-label="Previous Slide">
        <svg class="w-10 h-10 md:w-16 md:h-16 drop-shadow-lg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
    </button>
    <button class="slider-arrow next absolute right-0 top-0 bottom-0 w-24 md:w-40 z-20 cursor-pointer opacity-0 hover:opacity-100 transition-opacity bg-gradient-to-l from-black/20 to-transparent flex items-center justify-end pr-4 md:pl-8 text-white/50 hover:text-white" aria-label="Next Slide">
        <svg class="w-10 h-10 md:w-16 md:h-16 drop-shadow-lg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
    </button>
    <?php endif; ?>

    <!-- Overlapping Regulatory & LPS Badges -->
    <?php
    $hero_reg_desktop = get_option( 'options_hero_reg_desktop', '1' );
    $hero_reg_mobile  = get_option( 'options_hero_reg_mobile', '1' );
    
    $hero_logos = get_option( 'options_hero_reg_logos', [] );
    if ( empty( $hero_logos ) ) {
        $old_ojk = get_option( 'options_logo_ojk_url', get_template_directory_uri() . '/assets/img/ojk-logo.png' );
        $old_lps = get_option( 'options_logo_lps_url', get_template_directory_uri() . '/assets/img/lps-logo.png' );
        $hero_logos = [
            [ 'label' => 'OJK', 'url' => $old_ojk ],
            [ 'label' => 'LPS', 'url' => $old_lps ],
        ];
    }

    $hero_reg_class = '';
    if ( $hero_reg_desktop && $hero_reg_mobile ) {
        $hero_reg_class = 'flex';
    } elseif ( $hero_reg_desktop && ! $hero_reg_mobile ) {
        $hero_reg_class = 'hidden md:flex';
    } elseif ( ! $hero_reg_desktop && $hero_reg_mobile ) {
        $hero_reg_class = 'flex md:hidden';
    } else {
        $hero_reg_class = 'hidden';
    }

    // Badge Penjaminan LPS Khusus
    $lps_active = get_option( 'options_lps_badge_active', '1' );
    $lps_logo   = get_option( 'options_lps_badge_logo', get_template_directory_uri() . '/assets/img/lps-logo.png' );
    $lps_text   = get_option( 'options_lps_badge_text', 'Simpanan Dijamin LPS sampai dengan Rp2 Miliar per Nasabah per Bank' );
    $lps_desk   = get_option( 'options_lps_badge_desktop', '1' );
    $lps_mob    = get_option( 'options_lps_badge_mobile', '1' );

    $lps_badge_class = '';
    if ( $lps_active ) {
        if ( $lps_desk && $lps_mob ) {
            $lps_badge_class = 'flex';
        } elseif ( $lps_desk && ! $lps_mob ) {
            $lps_badge_class = 'hidden md:flex';
        } elseif ( ! $lps_desk && $lps_mob ) {
            $lps_badge_class = 'flex md:hidden';
        } else {
            $lps_badge_class = 'hidden';
        }
    } else {
        $lps_badge_class = 'hidden';
    }
    ?>

    <!-- 1. Left/Center: LPS Dedicated Guarantee Badge -->
    <?php if ( $lps_badge_class !== 'hidden' ) : ?>
    <div id="hero-lps-badge" class="absolute bottom-24 sm:bottom-32 md:bottom-36 left-3 sm:left-6 md:left-10 z-20 <?php echo esc_attr( $lps_badge_class ); ?> items-center gap-2.5 sm:gap-3 bg-white/15 dark:bg-black/30 backdrop-blur-md border border-white/25 dark:border-white/15 p-2 sm:p-2.5 rounded-xl sm:rounded-2xl shadow-xl max-w-xs sm:max-w-sm transition-all duration-300">
        <div class="h-7 sm:h-9 bg-white/95 rounded-lg p-1 sm:p-1.5 shadow-inner flex items-center justify-center shrink-0">
            <img src="<?php echo esc_url( $lps_logo ); ?>" alt="LPS" class="h-full w-auto object-contain" onerror="this.outerHTML='<span class=\'text-[10px] font-bold text-slate-800 px-1.5\'>LPS</span>'">
        </div>
        <p class="text-[9px] sm:text-[11px] font-semibold text-white leading-tight drop-shadow-md pr-1">
            <?php echo esc_html( $lps_text ); ?>
        </p>
    </div>
    <?php endif; ?>

    <!-- 2. Right: Regulatory Logos Repeater (OJK, LPS, BI, etc.) -->
    <?php if ( $hero_reg_class !== 'hidden' && ! empty( $hero_logos ) ) : ?>
    <div id="hero-regulatory-badge" class="absolute bottom-24 sm:bottom-32 md:bottom-36 right-3 sm:right-6 md:right-10 z-20 <?php echo esc_attr( $hero_reg_class ); ?> flex-wrap items-center justify-end gap-2 sm:gap-2.5 bg-white/15 dark:bg-black/30 backdrop-blur-md border border-white/25 dark:border-white/15 p-2 sm:p-2.5 rounded-xl sm:rounded-2xl shadow-xl transition-all duration-300 max-w-sm sm:max-w-none">
        <span class="text-[9px] sm:text-[10px] font-extrabold text-white uppercase tracking-wider sm:tracking-widest mr-0.5 sm:mr-1 opacity-90 drop-shadow-md">Terdaftar & Diawasi:</span>
        <?php foreach ( $hero_logos as $h_logo ) :
            $h_lbl = $h_logo['label'] ?? '';
            $h_url = $h_logo['url'] ?? '';
            if ( empty( $h_url ) && empty( $h_lbl ) ) continue;
        ?>
            <div class="h-7 sm:h-9 flex items-center bg-white/90 backdrop-blur-sm rounded-lg p-1 sm:p-1.5 shadow-inner">
                <?php if ( ! empty( $h_url ) ) : ?>
                    <img src="<?php echo esc_url( $h_url ); ?>" alt="<?php echo esc_attr( $h_lbl ); ?>" class="h-full w-auto object-contain" onerror="this.outerHTML='<span class=\'text-[10px] sm:text-[11px] font-bold text-slate-800 px-1.5 sm:px-2\'><?php echo esc_html( $h_lbl ); ?></span>'">
                <?php else : ?>
                    <span class="text-[10px] sm:text-[11px] font-bold text-slate-800 px-1.5 sm:px-2"><?php echo esc_html( $h_lbl ); ?></span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Gradient Blending to Next Section -->
    <div class="absolute bottom-0 left-0 right-0 h-48 bg-gradient-to-t from-slate-50 dark:from-dark-surface to-transparent z-10 pointer-events-none"></div>

</section>

<!-- Content wrapper to slide OVER the sticky hero -->
<div class="relative z-10">

<!-- ========================================
     SECTION 2: LAYANAN CEPAT (Glassmorphism Cards)
     ======================================== -->
<?php
// Card configurations
$quick_cards_config = [
    1 => [
        'color'       => 'primary',
        'default_t'   => 'Pembiayaan',
        'default_d'   => 'Solusi modal usaha & konsumtif syariah.',
        'default_u'   => home_url( '/produk/pembiayaan' ),
        'default_i'   => 'financing',
        'grad_blob'   => 'bg-primary-400/20 group-hover:bg-primary-400/40',
        'grad_box'    => 'from-primary-400 to-primary-600 shadow-primary-500/30',
        'text_color'  => 'text-primary-600 dark:text-primary-400',
        'hover_text'  => 'group-hover:text-primary-600 dark:group-hover:text-primary-400',
        'hover_shad'  => 'hover:shadow-primary-500/20',
    ],
    2 => [
        'color'       => 'teal',
        'default_t'   => 'Produk Dana',
        'default_d'   => 'Tabungan & deposito aman penuh berkah.',
        'default_u'   => home_url( '/produk/pendanaan' ),
        'default_i'   => 'savings',
        'grad_blob'   => 'bg-teal-400/20 group-hover:bg-teal-400/40',
        'grad_box'    => 'from-teal-400 to-teal-600 shadow-teal-500/30',
        'text_color'  => 'text-teal-600 dark:text-teal-400',
        'hover_text'  => 'group-hover:text-teal-600 dark:group-hover:text-teal-400',
        'hover_shad'  => 'hover:shadow-teal-500/20',
    ],
    3 => [
        'color'       => 'amber',
        'default_t'   => 'Simulasi',
        'default_d'   => 'Hitung estimasi margin & angsuran mudah.',
        'default_u'   => home_url( '/simulasi' ),
        'default_i'   => 'calculator',
        'grad_blob'   => 'bg-amber-400/20 group-hover:bg-amber-400/40',
        'grad_box'    => 'from-amber-400 to-amber-600 shadow-amber-500/30',
        'text_color'  => 'text-amber-600 dark:text-amber-400',
        'hover_text'  => 'group-hover:text-amber-600 dark:group-hover:text-amber-400',
        'hover_shad'  => 'hover:shadow-amber-500/20',
    ],
    4 => [
        'color'       => 'blue',
        'default_t'   => 'Laporan',
        'default_d'   => 'Akses laporan kinerja transparansi Bank.',
        'default_u'   => home_url( '/informasi/laporan' ),
        'default_i'   => 'report',
        'grad_blob'   => 'bg-blue-400/20 group-hover:bg-blue-400/40',
        'grad_box'    => 'from-blue-400 to-blue-600 shadow-blue-500/30',
        'text_color'  => 'text-blue-600 dark:text-blue-400',
        'hover_text'  => 'group-hover:text-blue-600 dark:group-hover:text-blue-400',
        'hover_shad'  => 'hover:shadow-blue-500/20',
    ],
];

/**
 * Helper icon renderer for Quick Cards
 *
 * @param string $icon_key
 * @return string
 */
if ( ! function_exists( 'wakalumi_render_card_icon' ) ) {
    function wakalumi_render_card_icon( string $icon_key = 'financing' ): string {
        switch ( $icon_key ) {
            case 'card':
                return '<svg class="w-8 h-8 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>';
            case 'calculator':
                return '<svg class="w-8 h-8 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>';
            case 'report':
                return '<svg class="w-8 h-8 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>';
            case 'savings':
                return '<svg class="w-8 h-8 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
            case 'deposit':
                return '<svg class="w-8 h-8 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" /></svg>';
            case 'transfer':
                return '<svg class="w-8 h-8 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" /></svg>';
            case 'shield':
                return '<svg class="w-8 h-8 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>';
            case 'financing':
            case 'chart':
            case 'investment':
            default:
                return '<svg class="w-8 h-8 drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" /></svg>';
        }
    }
}
?>
<section class="relative z-10 -mt-24 bg-slate-50 dark:bg-dark-surface rounded-t-[2rem] md:rounded-t-[4rem] shadow-[0_-20px_40px_rgba(0,0,0,0.15)] dark:shadow-[0_-20px_40px_rgba(0,0,0,0.5)] pb-16 pt-10 md:pt-16">
    <div class="container-wide">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6" data-aos="fade-up" data-aos-delay="100">
            <?php for ( $i = 1; $i <= 4; $i++ ) :
                $cfg        = $quick_cards_config[$i];
                $c_title    = get_option( "options_quick_card_{$i}_title", $cfg['default_t'] );
                $c_desc     = get_option( "options_quick_card_{$i}_desc", $cfg['default_d'] );
                $c_url      = get_option( "options_quick_card_{$i}_url", $cfg['default_u'] );
                $c_icon     = get_option( "options_quick_card_{$i}_icon", $cfg['default_i'] );
                $c_image    = get_option( "options_quick_card_{$i}_image", '' );
            ?>
                <!-- Card <?php echo $i; ?>: <?php echo esc_html( $c_title ); ?> -->
                <a href="<?php echo esc_url( $c_url ); ?>" class="group block relative rounded-3xl p-1 overflow-hidden transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl <?php echo esc_attr( $cfg['hover_shad'] ); ?>">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/60 to-white/10 dark:from-white/10 dark:to-white/5 backdrop-blur-xl border border-white/50 dark:border-white/10 rounded-3xl transition-colors group-hover:bg-white/80 dark:group-hover:bg-white/20"></div>
                    <div class="relative h-full bg-white/40 dark:bg-dark-surface/40 backdrop-blur-md rounded-[22px] p-6 flex flex-col items-center text-center overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-32 h-32 <?php echo esc_attr( $cfg['grad_blob'] ); ?> rounded-full blur-2xl transition-colors"></div>
                        <div class="w-16 h-16 mb-5 relative transform group-hover:scale-110 transition-transform duration-500 flex items-center justify-center">
                            <div class="absolute inset-0 bg-gradient-to-br <?php echo esc_attr( $cfg['grad_box'] ); ?> rounded-2xl rotate-6 opacity-70 group-hover:rotate-12 transition-transform shadow-lg"></div>
                            <div class="absolute inset-0 bg-gradient-to-tl from-white to-slate-50 dark:from-slate-800 dark:to-dark rounded-2xl -rotate-3 group-hover:rotate-0 transition-transform shadow-inner flex items-center justify-center <?php echo esc_attr( $cfg['text_color'] ); ?>">
                                <?php if ( ! empty( $c_image ) ) : ?>
                                    <img src="<?php echo esc_url( $c_image ); ?>" alt="<?php echo esc_attr( $c_title ); ?>" class="w-8 h-8 object-contain drop-shadow-md">
                                <?php else : ?>
                                    <?php echo wakalumi_render_card_icon( $c_icon ); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <h3 class="text-base md:text-lg font-extrabold text-slate-800 dark:text-white mb-2 <?php echo esc_attr( $cfg['hover_text'] ); ?> transition-colors leading-tight"><?php echo esc_html( $c_title ); ?></h3>
                        <p class="text-[11px] md:text-xs text-slate-500 dark:text-slate-400 font-medium"><?php echo esc_html( $c_desc ); ?></p>
                    </div>
                </a>
            <?php endfor; ?>
        </div>
    </div>
</section>

        </div>
    </div>
</section>


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
<section class="section bg-slate-50 dark:bg-dark-surface relative z-10">
    <div class="pattern-overlay"></div>
    <div class="container-wide relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="section-label mb-4 inline-block">Produk Kami</span>
            <h2 class="section-title mb-4">Solusi Keuangan <span class="text-primary-600 dark:text-primary-300">Syariah</span></h2>
            <p class="section-subtitle mx-auto">Pilihan produk perbankan syariah yang dirancang untuk memenuhi kebutuhan Anda dengan prinsip amanah.</p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            if ( $produk_query->have_posts() ) :
                $delay = 100;
                while ( $produk_query->have_posts() ) : $produk_query->the_post();
                    get_template_part( 'template-parts/card-produk', null, [ 'delay' => $delay ] );
                    $delay += 100;
                endwhile;
                wp_reset_postdata();
            else :
                // Dummy Data HTML fallback
                $dummy_products = [
                    ['title' => 'Tabungan Wadiah', 'desc' => 'Simpanan murni dengan titipan yang bisa diambil kapan saja tanpa potongan bulanan.'],
                    ['title' => 'Deposito Mudharabah', 'desc' => 'Investasi syariah dengan nisbah bagi hasil yang menguntungkan dan aman.'],
                    ['title' => 'Pembiayaan Murabahah', 'desc' => 'Solusi kepemilikan rumah atau kendaraan dengan cicilan tetap hingga lunas.'],
                    ['title' => 'Pembiayaan Porsi Haji', 'desc' => 'Wujudkan niat suci Anda dengan fasilitas talangan dana porsi haji yang mudah.']
                ];
                $delay = 100;
                foreach ( $dummy_products as $prod ) :
            ?>
                <div class="card card-glow group relative flex flex-col h-full bg-white dark:bg-dark-surface border border-slate-100 dark:border-dark-border rounded-2xl overflow-hidden p-6" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">
                    <div class="w-12 h-12 rounded-xl bg-primary-50 dark:bg-primary-400/10 text-primary-600 dark:text-primary-400 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2"><?php echo esc_html($prod['title']); ?></h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 flex-grow mb-6"><?php echo esc_html($prod['desc']); ?></p>
                    <div class="mt-auto pt-4 border-t border-slate-50 dark:border-dark-border/50">
                        <span class="inline-flex items-center text-sm font-semibold text-primary-600 dark:text-primary-400 group-hover:text-primary-700 dark:group-hover:text-primary-300">
                            Pelajari Selengkapnya
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </span>
                    </div>
                </div>
            <?php 
                $delay += 100;
                endforeach;
            endif; 
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
$about_label    = get_option( 'options_about_label', function_exists( 'get_field' ) ? ( get_field( 'about_label' ) ?: 'Tentang Kami' ) : 'Tentang Kami' );
$about_title    = get_option( 'options_about_title', function_exists( 'get_field' ) ? ( get_field( 'about_title' ) ?: 'Melayani dengan Prinsip Syariah Sejak Hari Pertama' ) : 'Melayani dengan Prinsip Syariah Sejak Hari Pertama' );
$about_content  = get_option( 'options_about_content', function_exists( 'get_field' ) ? ( get_field( 'about_content' ) ?: '<p>BPRS Wakalumi hadir sebagai bank syariah yang berkomitmen memberikan layanan keuangan terbaik berdasarkan prinsip-prinsip syariah Islam.</p>' ) : '<p>BPRS Wakalumi hadir sebagai bank syariah yang berkomitmen memberikan layanan keuangan terbaik berdasarkan prinsip-prinsip syariah Islam.</p>' );

$about_img_url  = get_option( 'options_about_image_url', '' );
if ( empty( $about_img_url ) ) {
    $acf_img = function_exists( 'get_field' ) ? get_field( 'about_image' ) : null;
    $about_img_url = $acf_img ? ( $acf_img['sizes']['large'] ?? $acf_img['url'] ) : get_template_directory_uri() . '/assets/img/about-photo.jpg';
}

$about_cta_text = get_option( 'options_about_cta_text', function_exists( 'get_field' ) ? ( get_field( 'about_cta_text' ) ?: 'Selengkapnya' ) : 'Selengkapnya' );
$about_cta_url  = get_option( 'options_about_cta_url', function_exists( 'get_field' ) ? ( get_field( 'about_cta_url' ) ?: home_url( '/profil/tentang-kami' ) ) : home_url( '/profil/tentang-kami' ) );
$about_img_mob  = get_option( 'options_about_img_mobile_mode', 'show_top' );

// Mobile layout order classes
$img_col_class  = '';
$text_col_class = '';
if ( $about_img_mob === 'hide' ) {
    $img_col_class  = 'hidden lg:block';
    $text_col_class = 'col-span-1 lg:col-span-1';
} elseif ( $about_img_mob === 'show_bottom' ) {
    $img_col_class  = 'order-2 lg:order-1';
    $text_col_class = 'order-1 lg:order-2';
} else { // show_top
    $img_col_class  = 'order-1 lg:order-1';
    $text_col_class = 'order-2 lg:order-2';
}
?>
<section class="section bg-white dark:bg-dark overflow-hidden relative z-10">
    <div class="container-wide">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <!-- Image Column with Mobile/Desktop Controls -->
            <div class="relative <?php echo esc_attr( $img_col_class ); ?>" data-aos="fade-right">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-primary-600/10 dark:shadow-primary-400/5">
                    <img src="<?php echo esc_url( $about_img_url ); ?>"
                         alt="<?php echo esc_attr( $about_title ); ?>"
                         class="w-full aspect-[4/3] object-cover"
                         loading="lazy">
                </div>
                <!-- Decorative element -->
                <div class="absolute -bottom-6 -right-6 w-32 h-32 rounded-3xl bg-primary-100 dark:bg-primary-900/30 -z-10"></div>
                <div class="absolute -top-6 -left-6 w-24 h-24 rounded-3xl border-2 border-primary-200 dark:border-primary-700/30 -z-10"></div>
            </div>

            <!-- Content Column -->
            <div class="<?php echo esc_attr( $text_col_class ); ?>" data-aos="fade-left">
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
     SECTION 5: REALISASI NISBAH
     ======================================== -->
<?php
$nisbah_bulan = ( function_exists( 'get_field' ) ? get_field( 'nisbah_bulan', 'option' ) : null ) ?: get_option( 'options_nisbah_bulan', 'Agustus 2026' );
$nisbah_data  = ( function_exists( 'get_field' ) ? get_field( 'nisbah_data', 'option' ) : null ) ?: get_option( 'options_nisbah_data' );

// Tampilkan data dummy jika ACF kosong
if ( empty( $nisbah_data ) ) {
    $nisbah_data = [
        ['nisbah_produk' => 'Tabungan Reguler', 'nisbah_jenis' => 'tabungan', 'nisbah_nasabah' => '15', 'nisbah_bank' => '85', 'nisbah_equiv' => '1.49%'],
        ['nisbah_produk' => 'Tabungan Ukhuwah', 'nisbah_jenis' => 'tabungan', 'nisbah_nasabah' => '10', 'nisbah_bank' => '90', 'nisbah_equiv' => '1.00%'],
        ['nisbah_produk' => 'Deposito 1 Bulan', 'nisbah_jenis' => 'deposito', 'nisbah_nasabah' => '30', 'nisbah_bank' => '70', 'nisbah_equiv' => '2.99%'],
        ['nisbah_produk' => 'Deposito 3 Bulan', 'nisbah_jenis' => 'deposito', 'nisbah_nasabah' => '35', 'nisbah_bank' => '65', 'nisbah_equiv' => '3.48%'],
        ['nisbah_produk' => 'Deposito 6 Bulan', 'nisbah_jenis' => 'deposito', 'nisbah_nasabah' => '40', 'nisbah_bank' => '60', 'nisbah_equiv' => '3.98%'],
        ['nisbah_produk' => 'Deposito 12 Bulan', 'nisbah_jenis' => 'deposito', 'nisbah_nasabah' => '42.5', 'nisbah_bank' => '57.5', 'nisbah_equiv' => '4.23%'],
    ];
}

if ( $nisbah_data ) :
?>
<section id="section-nisbah" class="section relative overflow-hidden bg-transparent py-24 z-10">
    <!-- Ornaments -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-50/50 dark:bg-primary-900/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-teal-50/50 dark:bg-teal-900/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>

    <div class="container-wide relative z-10">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16" data-aos="fade-up">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-50 dark:bg-primary-400/10 text-primary-600 dark:text-primary-400 text-xs font-bold uppercase tracking-widest mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-500 animate-pulse"></span>
                    Kinerja Bank
                </div>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-4 leading-tight">
                    Realisasi Nisbah <br class="hidden md:block"/><span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-teal-500">Bagi Hasil</span>
                </h2>
                <p class="text-slate-500 dark:text-slate-400 text-lg">
                    Equivalent Rate bank bulan <strong class="text-slate-700 dark:text-slate-300"><?php echo esc_html( $nisbah_bulan ); ?></strong>. 
                </p>
            </div>
            
            <a href="<?php echo esc_url( home_url( '/informasi/nisbah' ) ); ?>" class="btn-ghost text-sm shrink-0 inline-flex items-center gap-2">
                Lihat Riwayat Lengkap
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
            </a>
        </div>

        <!-- Cards Grid — Redesigned -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 md:gap-6">
            <?php foreach ( $nisbah_data as $i => $row ) :
                $is_tabungan = ( $row['nisbah_jenis'] === 'tabungan' );
                // Parse numeric value for progress bar width
                $nasabah_val = floatval( $row['nisbah_nasabah'] );
                $bank_val    = floatval( $row['nisbah_bank'] );
                // Extract just the number from equiv for display (e.g., "4.23%" -> "4.23" and "%")
                $equiv_raw   = $row['nisbah_equiv'];
                $equiv_num   = rtrim( $equiv_raw, '% ' );
            ?>
                <div class="group relative rounded-2xl md:rounded-3xl overflow-hidden 
                            bg-gradient-to-br from-white via-white to-slate-50/80 
                            dark:from-dark-surface dark:via-dark-surface dark:to-slate-800/30
                            border border-slate-200/70 dark:border-slate-700/50
                            shadow-md shadow-slate-200/50 dark:shadow-black/20
                            hover:shadow-xl hover:shadow-primary-500/15 dark:hover:shadow-primary-500/10
                            hover:-translate-y-1.5 
                            transition-all duration-300 ease-out" 
                     data-aos="fade-up" data-aos-delay="<?php echo ( $i % 3 ) * 80; ?>">
                    
                    <!-- Gradient accent bar (left edge) -->
                    <div class="absolute left-0 top-0 bottom-0 w-1 
                                <?php echo $is_tabungan 
                                    ? 'bg-gradient-to-b from-emerald-400 via-primary-500 to-teal-400' 
                                    : 'bg-gradient-to-b from-teal-500 via-cyan-600 to-teal-400'; ?>
                                opacity-60 group-hover:opacity-100 group-hover:w-1.5 
                                transition-all duration-300 ease-out"></div>

                    <!-- Hover glow overlay -->
                    <div class="absolute inset-0 
                                bg-gradient-to-br from-primary-50/0 to-teal-50/0 
                                group-hover:from-primary-50/30 group-hover:to-teal-50/10 
                                dark:group-hover:from-primary-950/20 dark:group-hover:to-teal-950/10
                                transition-all duration-300 pointer-events-none"></div>

                    <!-- Subtle watermark logo -->
                    <div class="absolute -right-12 -bottom-12 w-36 h-36 opacity-[0.02] dark:opacity-[0.03] pointer-events-none transition-transform duration-500 ease-out group-hover:scale-110 group-hover:-translate-x-2 group-hover:-translate-y-2">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-new-1.png" alt="" class="w-full h-full object-contain">
                    </div>

                    <div class="relative z-10 p-5 md:p-6 pl-6 md:pl-7">
                        <!-- Header: Badge + Product Name -->
                        <div class="flex items-center gap-2.5 mb-1.5">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                        <?php echo $is_tabungan 
                                            ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-400/10 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800/30' 
                                            : 'bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300 border border-teal-100 dark:border-teal-800/30'; ?>">
                                <?php if ( $is_tabungan ) : ?>
                                    <svg class="w-3 h-3 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <?php else : ?>
                                    <svg class="w-3 h-3 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                                <?php endif; ?>
                                <?php echo esc_html( $row['nisbah_jenis'] ); ?>
                            </span>
                        </div>

                        <h3 class="font-bold text-lg md:text-xl text-slate-800 dark:text-white leading-snug mb-5 
                                   group-hover:text-primary-700 dark:group-hover:text-teal-300 transition-colors duration-300">
                            <?php echo esc_html( $row['nisbah_produk'] ); ?>
                        </h3>

                        <!-- Equivalent Rate — Hero Number -->
                        <div class="mb-5">
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 font-semibold uppercase tracking-[0.15em] mb-1.5">Equivalent Rate</p>
                            <div class="flex items-baseline gap-0.5">
                                <span class="text-4xl md:text-[2.75rem] font-black tracking-tight
                                             bg-gradient-to-r <?php echo $is_tabungan 
                                                ? 'from-emerald-600 via-primary-600 to-teal-500 dark:from-emerald-400 dark:via-primary-300 dark:to-teal-300' 
                                                : 'from-teal-700 via-cyan-600 to-teal-500 dark:from-teal-300 dark:via-cyan-300 dark:to-teal-400'; ?>
                                             bg-clip-text text-transparent
                                             transition-all duration-300">
                                    <?php echo esc_html( $equiv_num ); ?>
                                </span>
                                <span class="text-lg font-bold text-slate-400 dark:text-slate-500">%</span>
                            </div>
                        </div>

                        <!-- Porsi Nisbah: 1 Garis Bersambung (Single Segmented Ratio Bar) -->
                        <div class="pt-4 border-t border-slate-100 dark:border-slate-700/50">
                            <!-- Label & Persentase: Kiri Nasabah, Kanan Bank -->
                            <div class="flex justify-between items-center text-xs mb-2">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full <?php echo $is_tabungan ? 'bg-emerald-500' : 'bg-teal-500'; ?>"></span>
                                    <span class="text-slate-500 dark:text-slate-400 font-medium">Nasabah</span>
                                    <span class="font-bold text-slate-800 dark:text-white"><?php echo esc_html( $row['nisbah_nasabah'] ); ?>%</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="font-bold text-slate-700 dark:text-slate-300"><?php echo esc_html( $row['nisbah_bank'] ); ?>%</span>
                                    <span class="text-slate-500 dark:text-slate-400 font-medium">Bank</span>
                                    <span class="w-2 h-2 rounded-full bg-slate-300 dark:bg-slate-600"></span>
                                </div>
                            </div>

                            <!-- Single Segmented Bar (100% Split) -->
                            <div class="h-2.5 w-full rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden flex items-center p-0.5 border border-slate-200/50 dark:border-slate-700/50">
                                <!-- Segmen Kiri: Nasabah -->
                                <div class="h-full rounded-l-full <?php echo $is_tabungan ? 'bg-gradient-to-r from-emerald-500 to-teal-400' : 'bg-gradient-to-r from-teal-500 to-cyan-400'; ?> transition-all duration-700 ease-out nisbah-bar-animated"
                                     style="width: <?php echo esc_attr( $nasabah_val ); ?>%"
                                     title="Nasabah: <?php echo esc_attr( $nasabah_val ); ?>%"></div>
                                <!-- Segmen Kanan: Bank -->
                                <div class="h-full rounded-r-full bg-slate-300 dark:bg-slate-600 transition-all duration-700 ease-out"
                                     style="width: <?php echo esc_attr( $bank_val ); ?>%"
                                     title="Bank: <?php echo esc_attr( $bank_val ); ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Footer Disclaimer -->
        <div class="mt-8 flex items-start gap-3 p-4 rounded-xl bg-slate-50 dark:bg-dark-surface-alt border border-slate-100 dark:border-dark-border max-w-3xl mx-auto" data-aos="fade-up">
            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                * Equivalent rate di atas berdasarkan realisasi pendapatan Bank pada bulan <strong class="text-slate-700 dark:text-slate-300"><?php echo esc_html( $nisbah_bulan ); ?></strong> dan bersifat <strong>fluktuatif</strong> setiap bulannya sesuai dengan kinerja Bank. 
            </p>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ========================================
     SECTION: VIDEO PROFIL (Company Profile)
     ======================================== -->
<?php
$v_badge = get_option( 'options_video_badge', 'Company Profile' );
$v_title = get_option( 'options_video_title', 'Mengenal Lebih Dekat Bank Syariah Wakalumi' );
$v_desc  = get_option( 'options_video_desc', 'Berkomitmen menjadi lembaga keuangan syariah terdepan yang berkontribusi nyata dalam memberdayakan ekonomi umat.' );
$v_url   = get_option( 'options_video_url', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ' );
$v_thumb = get_option( 'options_video_thumb', '' );
if ( empty( $v_thumb ) ) {
    $v_thumb = get_template_directory_uri() . '/assets/img/video-thumb.jpg';
}

// Extract YouTube embed URL if valid
$yt_embed_url = '';
if ( preg_match( '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $v_url, $yt_matches ) ) {
    $yt_embed_url = 'https://www.youtube.com/embed/' . $yt_matches[1] . '?autoplay=1&rel=0';
} elseif ( ! empty( $v_url ) ) {
    $yt_embed_url = $v_url;
}
?>
<section class="section relative z-10 overflow-hidden bg-slate-900 py-32 mt-12">
    <!-- Overlay image -->
    <div class="absolute inset-0 z-0">
        <img src="<?php echo esc_url( $v_thumb ); ?>" alt="Video Background" class="w-full h-full object-cover opacity-60" loading="lazy">
        <div class="absolute inset-0 bg-slate-900/40"></div>
    </div>
    
    <div class="container-narrow relative z-10 text-center" data-aos="zoom-in">
        <button id="open-video-modal"
                class="group relative w-24 h-24 mx-auto mb-8 flex items-center justify-center rounded-full bg-white/10 backdrop-blur-md border border-white/20 hover:bg-white/20 transition-colors focus:outline-none focus:ring-4 focus:ring-primary-500/50 cursor-pointer"
                aria-label="Putar Video Profil">
            <!-- Ripple effect -->
            <div class="absolute inset-0 rounded-full border border-white/50 animate-ping opacity-50"></div>
            <!-- Play icon -->
            <div class="w-16 h-16 rounded-full bg-white text-primary-600 flex items-center justify-center pl-1 group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </div>
        </button>
        <span class="inline-block px-3 py-1 rounded-full bg-primary-500/20 text-primary-300 text-xs font-bold uppercase tracking-widest mb-4 border border-primary-500/30">
            <?php echo esc_html( $v_badge ); ?>
        </span>
        <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6"><?php echo nl2br( esc_html( $v_title ) ); ?></h2>
        <p class="text-slate-300 text-lg max-w-2xl mx-auto">
            <?php echo esc_html( $v_desc ); ?>
        </p>
    </div>
</section>

<!-- Video Popup Modal -->
<div id="video-modal" class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/85 p-4 backdrop-blur-md transition-opacity duration-300">
    <div class="relative w-full max-w-4xl aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl border border-white/20">
        <button id="close-video-modal" class="absolute top-3 right-3 z-20 w-10 h-10 rounded-full bg-black/60 text-white hover:bg-rose-600 flex items-center justify-center transition-colors text-xl font-bold cursor-pointer" aria-label="Tutup Video">
            &times;
        </button>
        <iframe id="video-modal-iframe" data-src="<?php echo esc_url( $yt_embed_url ); ?>" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const openBtn = document.getElementById('open-video-modal');
    const closeBtn = document.getElementById('close-video-modal');
    const modal = document.getElementById('video-modal');
    const iframe = document.getElementById('video-modal-iframe');

    if (openBtn && modal && iframe) {
        openBtn.addEventListener('click', function() {
            iframe.src = iframe.getAttribute('data-src');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        const closeModal = function() {
            iframe.src = '';
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        };

        if (closeBtn) closeBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    }
});
</script>

<!-- ========================================
     SECTION: INSTAGRAM FEED
     ======================================== -->
<?php
$ig_title    = get_option( 'options_ig_title', 'Aktivitas & Edukasi Terbaru' );
$ig_subtitle = get_option( 'options_ig_subtitle', 'Ikuti perjalanan dan literasi keuangan syariah kami di Instagram.' );
$ig_posts    = get_option( 'options_ig_posts', [] );
if ( empty( $ig_posts ) ) {
    $ig_posts = array_filter( [
        get_option( 'options_ig_post_1', 'https://www.instagram.com/p/DSW6wx4gWl5/' ),
        get_option( 'options_ig_post_2', 'https://www.instagram.com/p/DcLJupqTRoo/' ),
        get_option( 'options_ig_post_3', 'https://www.instagram.com/p/DSW6_3WgUo-/' ),
    ] );
}
$ig_profile  = get_option( 'options_social_instagram', 'https://www.instagram.com/bprswakalumi' );
?>
<section id="section-sosial-media" class="section bg-transparent relative z-10 py-20 overflow-hidden">

    <div class="container-wide relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-12" data-aos="fade-up">
            <span class="section-label mb-4 inline-block">Sosial Media</span>
            <h2 class="section-title mb-4"><?php echo esc_html( $ig_title ); ?></h2>
            <p class="section-subtitle mx-auto"><?php echo esc_html( $ig_subtitle ); ?></p>
        </div>

        <!-- Scrollable Wrapper for Instagram -->
        <div class="relative" data-aos="fade-up" data-aos-delay="100">
            <!-- Navigation Arrows -->
            <button id="ig-scroll-prev"
                    class="absolute -left-2 md:-left-6 top-1/2 -translate-y-1/2 z-30 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white dark:bg-dark-surface shadow-xl border border-slate-200 dark:border-dark-border text-slate-700 dark:text-slate-200 hover:bg-primary-600 hover:text-white dark:hover:bg-primary-500 flex items-center justify-center transition-all duration-300 hover:scale-110 focus:outline-none cursor-pointer"
                    aria-label="Scroll sebelumnya">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <button id="ig-scroll-next"
                    class="absolute -right-2 md:-right-6 top-1/2 -translate-y-1/2 z-30 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white dark:bg-dark-surface shadow-xl border border-slate-200 dark:border-dark-border text-slate-700 dark:text-slate-200 hover:bg-primary-600 hover:text-white dark:hover:bg-primary-500 flex items-center justify-center transition-all duration-300 hover:scale-110 focus:outline-none cursor-pointer"
                    aria-label="Scroll berikutnya">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>

            <div id="ig-scroll-track" class="grid grid-flow-col auto-cols-[85vw] md:auto-cols-[350px] gap-6 overflow-x-auto snap-x snap-mandatory pb-8 pt-4 px-4 -mx-4 hide-scrollbar items-start" style="scroll-behavior: smooth;">
                <?php if ( ! empty( $ig_posts ) ) : ?>
                    <?php foreach ( $ig_posts as $post_url ) : ?>
                        <div class="snap-center">
                            <blockquote class="instagram-media" data-instgrm-permalink="<?php echo esc_url( $post_url ); ?>?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style="background:#FFF; border:0; margin: 0; padding:0; width:100%; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);"></blockquote>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col-span-full py-10 text-center text-slate-400">
                        <p>Belum ada postingan Instagram yang disematkan.</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Fade Edges for Scroll Indication -->
            <div class="absolute top-0 left-0 bottom-8 w-8 bg-gradient-to-r from-slate-50 dark:from-dark-surface to-transparent pointer-events-none"></div>
            <div class="absolute top-0 right-0 bottom-8 w-12 bg-gradient-to-l from-slate-50 dark:from-dark-surface to-transparent pointer-events-none"></div>
        </div>
        
        <?php if ( $ig_profile ) : ?>
        <div class="text-center mt-12" data-aos="fade-up">
            <a href="<?php echo esc_url( $ig_profile ); ?>" target="_blank" rel="noopener noreferrer" class="btn-primary inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                Follow @bprswakalumi
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>
<!-- Instagram Embed Script (loaded once) -->
<script async src="//www.instagram.com/embed.js"></script>


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
<section class="section bg-white dark:bg-dark relative z-10">
    <div class="container-wide">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-14" data-aos="fade-up">
            <div>
                <span class="section-label mb-4 inline-block">Berita Terbaru</span>
                <h2 class="section-title">Kabar dari <span class="text-primary-600 dark:text-primary-300">Wakalumi</span></h2>
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
            if ( $berita_query->have_posts() ) :
                $delay = 100;
                while ( $berita_query->have_posts() ) : $berita_query->the_post();
                    get_template_part( 'template-parts/card-berita', null, [ 'delay' => $delay ] );
                    $delay += 150;
                endwhile;
                wp_reset_postdata();
            else :
                // Dummy Data HTML fallback
                $dummy_news = [
                    ['title' => 'BPRS Wakalumi Raih Penghargaan Bank Syariah Terbaik 2026', 'date' => date('d M Y'), 'cat' => 'Penghargaan', 'excerpt' => 'Penghargaan ini merupakan wujud nyata dari komitmen kami dalam memberikan layanan syariah terbaik...'],
                    ['title' => 'Peresmian Kantor Cabang Baru di Jakarta Selatan', 'date' => date('d M Y', strtotime('-2 days')), 'cat' => 'Info Perusahaan', 'excerpt' => 'Untuk mendekatkan layanan kepada nasabah, kami meresmikan kantor cabang baru dengan fasilitas modern...'],
                    ['title' => 'Literasi Keuangan Syariah untuk UMKM Kota Tangerang', 'date' => date('d M Y', strtotime('-5 days')), 'cat' => 'Edukasi', 'excerpt' => 'Program CSR kami bulan ini berfokus pada edukasi pengelolaan keuangan berbasis syariah untuk para pelaku usaha mikro...']
                ];
                $delay = 100;
                foreach ( $dummy_news as $news ) :
            ?>
                <article class="card card-hover group flex flex-col h-full bg-white dark:bg-dark-surface border border-slate-100 dark:border-dark-border rounded-2xl overflow-hidden" data-aos="fade-up" data-aos-delay="<?php echo esc_attr($delay); ?>">
                    <div class="relative w-full aspect-[16/10] bg-slate-200 dark:bg-slate-800 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-primary-600/80 to-primary-400/80 group-hover:scale-105 transition-transform duration-500 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-white/90 backdrop-blur-sm text-primary-700 shadow-sm dark:bg-dark-surface/90 dark:text-primary-400">
                                <?php echo esc_html($news['cat']); ?>
                            </span>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 mb-3">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            <time><?php echo esc_html($news['date']); ?></time>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">
                            <?php echo esc_html($news['title']); ?>
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-5 line-clamp-3 flex-grow">
                            <?php echo esc_html($news['excerpt']); ?>
                        </p>
                        <div class="mt-auto flex items-center text-sm font-semibold text-primary-600 dark:text-primary-400 group-hover:text-primary-700 dark:group-hover:text-primary-300">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </div>
                    </div>
                </article>
            <?php 
                $delay += 150;
                endforeach;
            endif; 
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
<section class="relative z-10 py-24 md:py-32 overflow-hidden">
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
                      dark:bg-primary-300 dark:text-dark dark:hover:bg-primary-200 dark:btn-glow">
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

</div> <!-- End sticky wrapper -->

<?php get_footer(); ?>
