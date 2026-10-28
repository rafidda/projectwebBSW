<?php
/**
 * Default Single Post Template
 *
 * @package Wakalumi
 */

get_header();
?>

<article class="wkl-page-hero section-sm relative z-10 overflow-hidden">
    <div class="container-narrow relative z-10">
        <?php while ( have_posts() ) : the_post(); ?>
            <!-- Post Header -->
            <header class="text-center mb-12" data-aos="fade-up">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-4">
                    <?php the_title(); ?>
                </h1>
                <div class="flex items-center justify-center gap-4 text-sm text-slate-500 dark:text-slate-400">
                    <time datetime="<?php echo get_the_date( 'c' ); ?>">
                        <?php echo get_the_date( 'j F Y' ); ?>
                    </time>
                </div>
            </header>

            <!-- Solid Editorial Reading Container -->
            <div class="rounded-3xl bg-white dark:bg-dark-card border border-slate-200/90 dark:border-dark-border shadow-xl p-6 sm:p-10 lg:p-12 mb-10 relative overflow-hidden" data-aos="fade-up">
                <!-- Top Subtle Accent Bar -->
                <div class="h-1.5 w-full bg-gradient-to-r from-teal-500 via-emerald-500 to-cyan-500 absolute top-0 left-0 right-0"></div>

                <!-- Featured Image (Besar di Awal) -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mb-10 rounded-2xl overflow-hidden border border-slate-200/80 dark:border-dark-border shadow-md">
                        <?php the_post_thumbnail( 'hero-large', [
                            'class' => 'w-full aspect-[16/8] object-cover',
                        ] ); ?>
                        <?php if ( get_the_post_thumbnail_caption() ) : ?>
                            <div class="p-3 text-center text-xs text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-dark-surface border-t border-slate-200/50 dark:border-dark-border font-medium flex items-center justify-center gap-1.5">
                                <span>📷</span>
                                <span><?php echo esc_html( get_the_post_thumbnail_caption() ); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Content (Standar & Normal) -->
                <div class="prose prose-lg prose-slate dark:prose-invert mx-auto max-w-none leading-relaxed">
                    <?php the_content(); ?>
                </div>
            </div>

            <!-- Post Navigation -->
            <div class="mt-16 pt-8 border-t border-slate-100 dark:border-dark-border">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php
                    $prev = get_previous_post();
                    $next = get_next_post();
                    ?>
                    <?php if ( $prev ) : ?>
                        <a href="<?php echo get_permalink( $prev ); ?>"
                           class="card-hover p-6 group flex items-center gap-4">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-500 transition-colors flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                            <div>
                                <span class="text-xs text-slate-400 dark:text-slate-500">Sebelumnya</span>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white line-clamp-1"><?php echo get_the_title( $prev ); ?></p>
                            </div>
                        </a>
                    <?php else : ?>
                        <div></div>
                    <?php endif; ?>

                    <?php if ( $next ) : ?>
                        <a href="<?php echo get_permalink( $next ); ?>"
                           class="card-hover p-6 group flex items-center gap-4 text-right justify-end">
                            <div>
                                <span class="text-xs text-slate-400 dark:text-slate-500">Selanjutnya</span>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white line-clamp-1"><?php echo get_the_title( $next ); ?></p>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-primary-500 transition-colors flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</article>

<?php get_footer(); ?>

