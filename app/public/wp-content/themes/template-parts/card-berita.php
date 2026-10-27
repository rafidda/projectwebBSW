<?php
/**
 * Template Part: Card Berita (News Card)
 * High-End Banking Editorial Card Component
 *
 * @package Wakalumi
 */;

$delay      = $args['delay'] ?? 100;
$ringkasan  = get_field( 'berita_ringkasan' ) ?: get_the_excerpt();
$categories = get_the_terms( get_the_ID(), 'kategori_berita' );
$first_cat  = ( $categories && ! is_wp_error( $categories ) ) ? $categories[0]->name : 'Warta Bank';
$cat_link   = ( $categories && ! is_wp_error( $categories ) ) ? get_term_link( $categories[0] ) : home_url( '/berita/' );

$reading_time = function_exists( 'wakalumi_calculate_reading_time' ) 
    ? wakalumi_calculate_reading_time( get_the_content() ) 
    : '3 mnt baca';

$penulis = get_field( 'berita_penulis' ) ?: 'Redaksi Wakalumi';

// Data Berita Eksternal / Liputan Luar
$is_external     = get_post_meta( get_the_ID(), 'berita_is_external', true ) === '1' || ! empty( get_post_meta( get_the_ID(), 'berita_external_url', true ) );
$external_source = get_post_meta( get_the_ID(), 'berita_external_source', true );
$external_url    = get_post_meta( get_the_ID(), 'berita_external_url', true );
$external_mode   = get_post_meta( get_the_ID(), 'berita_external_mode', true ) ?: 'direct';

$is_direct_external = ( $is_external && $external_mode === 'direct' && ! empty( $external_url ) );
$card_url           = $is_direct_external ? $external_url : get_permalink();
$card_target        = $is_direct_external ? '_blank' : '_self';
$card_rel           = $is_direct_external ? 'noopener noreferrer' : '';
$display_author     = ( $is_external && ! empty( $external_source ) ) ? $external_source : $penulis;
?>

<article class="card-hover group flex flex-col h-full bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border rounded-3xl overflow-hidden shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 relative" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
    
    <!-- Thumbnail Image Container -->
    <a href="<?php echo esc_url( $card_url ); ?>" 
       <?php if ( $is_direct_external ) : ?>target="_blank" rel="noopener noreferrer"<?php endif; ?>
       class="block relative w-full aspect-[16/10] bg-slate-100 dark:bg-slate-800 overflow-hidden">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'card-thumbnail', [
                'class'   => 'w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105',
                'loading' => 'lazy',
            ] ); ?>
        <?php else : ?>
            <!-- Fallback Islamic Geometric Gradient Poster -->
            <div class="w-full h-full bg-gradient-to-br from-teal-600 via-primary-700 to-slate-900 flex flex-col items-center justify-center p-6 text-center relative overflow-hidden group-hover:scale-105 transition-transform duration-700">
                <div class="absolute -right-8 -bottom-8 w-32 h-32 rounded-full bg-white/10 blur-xl"></div>
                <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-teal-200 mb-2 shadow-inner">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-white tracking-wide">Bank Syariah Wakalumi</span>
            </div>
        <?php endif; ?>

        <!-- Category & External Badges (Top Left) -->
        <div class="absolute top-3.5 left-3.5 z-10 flex flex-wrap items-center gap-1.5 max-w-[80%]">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-extrabold bg-white/95 dark:bg-dark-card/95 text-teal-800 dark:text-teal-300 backdrop-blur-md border border-teal-200/60 dark:border-teal-700/60 shadow-xs">
                <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                <?php echo esc_html( $first_cat ); ?>
            </span>
            <?php if ( $is_external ) : ?>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10.5px] font-black bg-cyan-600 text-white shadow-xs backdrop-blur-md" title="Liputan / Berita dari Luar">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" /></svg>
                    <?php echo esc_html( ! empty( $external_source ) ? $external_source : 'Media Luar' ); ?>
                    <?php if ( $is_direct_external ) : ?>↗<?php endif; ?>
                </span>
            <?php endif; ?>
        </div>

        <!-- Reading Time / External Link Tag (Top Right) -->
        <div class="absolute top-3.5 right-3.5 z-10">
            <?php if ( $is_direct_external ) : ?>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-900/85 text-cyan-300 backdrop-blur-md shadow-xs">
                    <svg class="w-3 h-3 text-cyan-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    Tautan Luar
                </span>
            <?php else : ?>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-900/80 text-white backdrop-blur-md shadow-xs">
                    <svg class="w-3 h-3 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <?php echo esc_html( $reading_time ); ?>
                </span>
            <?php endif; ?>
        </div>
    </a>

    <!-- Card Body -->
    <div class="p-6 flex flex-col flex-grow justify-between">
        <div>
            <!-- Meta Date & Author / Source -->
            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 mb-3">
                <span class="inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    <time datetime="<?php echo get_the_date( 'c' ); ?>">
                        <?php echo get_the_date( 'j F Y' ); ?>
                    </time>
                </span>
                <span class="text-slate-300 dark:text-slate-600">•</span>
                <span class="truncate font-medium text-slate-600 dark:text-slate-300 flex items-center gap-1">
                    <?php if ( $is_external ) : ?>
                        <svg class="w-3.5 h-3.5 text-cyan-600 dark:text-cyan-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                    <?php endif; ?>
                    <?php echo esc_html( $display_author ); ?>
                </span>
            </div>

            <!-- Title -->
            <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white leading-snug line-clamp-2 mb-3 group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                <a href="<?php echo esc_url( $card_url ); ?>" 
                   <?php if ( $is_direct_external ) : ?>target="_blank" rel="noopener noreferrer"<?php endif; ?>
                   class="focus:outline-none focus:underline">
                    <?php the_title(); ?>
                </a>
            </h3>

            <!-- Excerpt -->
            <p class="text-sm text-slate-600 dark:text-slate-300 line-clamp-3 leading-relaxed mb-4">
                <?php echo esc_html( wp_strip_all_tags( $ringkasan ) ); ?>
            </p>
        </div>

        <!-- Card Footer -->
        <div class="pt-4 mt-auto border-t border-slate-100 dark:border-dark-border/80 flex items-center justify-between">
            <a href="<?php echo esc_url( $card_url ); ?>"
               <?php if ( $is_direct_external ) : ?>target="_blank" rel="noopener noreferrer"<?php endif; ?>
               class="inline-flex items-center gap-1.5 text-xs font-bold text-teal-600 dark:text-teal-400 group-hover:text-teal-700 dark:group-hover:text-teal-300 group-hover:gap-2.5 transition-all">
                <?php if ( $is_direct_external ) : ?>
                    <span>Buka di <?php echo esc_html( ! empty( $external_source ) ? $external_source : 'Situs Sumber' ); ?></span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                <?php elseif ( $is_external ) : ?>
                    <span>Baca Cuplikan</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                <?php else : ?>
                    <span>Baca Selengkapnya</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                <?php endif; ?>
            </a>

            <!-- Subtle Verified Bank / External Badge -->
            <?php if ( $is_external ) : ?>
                <span class="text-[10px] font-bold text-cyan-600 dark:text-cyan-400 inline-flex items-center gap-1" title="Liputan Media Eksternal">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-500 animate-pulse"></span>
                    Liputan Media
                </span>
            <?php else : ?>
                <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 inline-flex items-center gap-1" title="Publikasi Resmi Bank Syariah Wakalumi">
                    <svg class="w-3 h-3 text-teal-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    Resmi
                </span>
            <?php endif; ?>
        </div>
    </div>
</article>
