<?php
/**
 * Template Part: Card Berita (News Card)
 *
 * @package Wakalumi
 */

$delay      = $args['delay'] ?? 100;
$ringkasan  = get_field( 'berita_ringkasan' ) ?: get_the_excerpt();
$categories = get_the_terms( get_the_ID(), 'kategori_berita' );
?>

<article class="card-hover group" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
    <!-- Featured Image -->
    <a href="<?php the_permalink(); ?>" class="block relative overflow-hidden aspect-card">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'card-thumbnail', [
                'class'   => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105',
                'loading' => 'lazy',
            ] ); ?>
        <?php else : ?>
            <div class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/30 dark:to-primary-800/30 flex items-center justify-center">
                <svg class="w-12 h-12 text-primary-300 dark:text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                </svg>
            </div>
        <?php endif; ?>

        <!-- Category Badge -->
        <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
            <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-semibold
                         bg-white/90 text-primary-700 backdrop-blur-sm
                         dark:bg-dark-surface/90 dark:text-primary-400">
                <?php echo esc_html( $categories[0]->name ); ?>
            </span>
        <?php endif; ?>
    </a>

    <!-- Content -->
    <div class="p-6">
        <!-- Date -->
        <div class="flex items-center gap-2 mb-3">
            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
            </svg>
            <time class="text-xs text-slate-400 dark:text-slate-500" datetime="<?php echo get_the_date( 'c' ); ?>">
                <?php echo get_the_date( 'j F Y' ); ?>
            </time>
        </div>

        <!-- Title -->
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 line-clamp-2
                   group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h3>

        <!-- Excerpt -->
        <p class="text-sm text-slate-500 dark:text-slate-400 line-clamp-2 mb-4">
            <?php echo esc_html( $ringkasan ); ?>
        </p>

        <!-- Read More -->
        <a href="<?php the_permalink(); ?>"
           class="inline-flex items-center gap-1 text-sm font-semibold text-primary-600 dark:text-primary-400
                  hover:gap-2 transition-all duration-200">
            Baca Selengkapnya
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
        </a>
    </div>
</article>

