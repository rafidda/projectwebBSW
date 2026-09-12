<?php
/**
 * Archive Berita (News List) Template
 *
 * @package Wakalumi
 */

get_header();
?>

<section class="section">
    <div class="container-wide">
        <!-- Page Header -->
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="section-label mb-4 inline-block">Berita & Informasi</span>
            <h1 class="section-title mb-4">Berita Wakalumi</h1>
            <p class="section-subtitle mx-auto">Kabar terbaru seputar kegiatan dan informasi dari BPRS Wakalumi.</p>
        </div>

        <!-- Category Filter -->
        <?php
        $terms = get_terms( [
            'taxonomy'   => 'kategori_berita',
            'hide_empty' => true,
        ] );
        if ( $terms && ! is_wp_error( $terms ) ) :
        ?>
        <div class="flex flex-wrap items-center justify-center gap-2 mb-12" data-aos="fade-up" data-aos-delay="100">
            <a href="<?php echo get_post_type_archive_link( 'berita' ); ?>"
               class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200
                      <?php echo ! is_tax( 'kategori_berita' ) ? 'bg-primary-600 text-white dark:bg-primary-500' : 'bg-slate-100 text-slate-600 hover:bg-primary-50 hover:text-primary-700 dark:bg-dark-surface-alt dark:text-slate-400 dark:hover:bg-primary-400/10 dark:hover:text-primary-400'; ?>">
                Semua
            </a>
            <?php foreach ( $terms as $term ) : ?>
                <a href="<?php echo get_term_link( $term ); ?>"
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200
                          <?php echo is_tax( 'kategori_berita', $term->term_id ) ? 'bg-primary-600 text-white dark:bg-primary-500' : 'bg-slate-100 text-slate-600 hover:bg-primary-50 hover:text-primary-700 dark:bg-dark-surface-alt dark:text-slate-400 dark:hover:bg-primary-400/10 dark:hover:text-primary-400'; ?>">
                    <?php echo esc_html( $term->name ); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $delay = 100;
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/card-berita', null, [ 'delay' => $delay ] );
                    $delay += 100;
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center" data-aos="fade-up">
                <?php
                the_posts_pagination( [
                    'mid_size'  => 2,
                    'prev_text' => '&larr; Sebelumnya',
                    'next_text' => 'Selanjutnya &rarr;',
                    'class'     => 'flex items-center gap-2',
                ] );
                ?>
            </div>
        <?php else : ?>
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-100 dark:bg-dark-surface-alt mb-6">
                    <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Belum Ada Berita</h3>
                <p class="text-slate-500 dark:text-slate-400">Berita akan segera hadir. Pantau terus halaman ini.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>

