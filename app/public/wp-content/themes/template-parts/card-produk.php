<?php
/**
 * Template Part: Card Produk (Product Card)
 *
 * @package Wakalumi
 */

$delay      = $args['delay'] ?? 100;
$icon       = get_field( 'produk_icon' ) ?: 'savings';
$ringkasan  = get_field( 'produk_ringkasan' ) ?: get_the_excerpt();
$akad       = get_field( 'produk_akad' ) ?: '';
$categories = get_the_terms( get_the_ID(), 'kategori_produk' );
?>

<article class="card-hover group p-6 md:p-8 text-center" data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $delay ); ?>">
    <!-- Icon -->
    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-5
                bg-primary-50 text-primary-600
                group-hover:bg-primary-600 group-hover:text-white
                dark:bg-primary-400/10 dark:text-primary-400
                dark:group-hover:bg-primary-500 dark:group-hover:text-white
                transition-all duration-300">
        <?php echo wakalumi_get_produk_icon( $icon ); ?>
    </div>

    <!-- Category -->
    <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
        <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider mb-3
                     text-primary-600 bg-primary-50
                     dark:text-primary-400 dark:bg-primary-400/10">
            <?php echo esc_html( $categories[0]->name ); ?>
        </span>
    <?php endif; ?>

    <!-- Title -->
    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">
        <a href="<?php the_permalink(); ?>"
           class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
            <?php the_title(); ?>
        </a>
    </h3>

    <!-- Akad Badge -->
    <?php if ( $akad ) : ?>
        <span class="inline-block text-xs font-medium text-slate-400 dark:text-slate-500 mb-3">
            Akad: <?php echo esc_html( $akad ); ?>
        </span>
    <?php endif; ?>

    <!-- Description -->
    <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed mb-5 line-clamp-3">
        <?php echo esc_html( $ringkasan ); ?>
    </p>

    <!-- CTA -->
    <a href="<?php the_permalink(); ?>"
       class="inline-flex items-center gap-1 text-sm font-semibold text-primary-600 dark:text-primary-400
              hover:gap-2 transition-all duration-200">
        Detail Produk
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
        </svg>
    </a>
</article>

