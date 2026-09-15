<?php
/**
 * Index Template — Fallback / Blog
 *
 * @package Wakalumi
 */

// Jika WordPress mengarahkan halaman depan utama ke index.php, wajib panggil front-page.php
if ( is_front_page() ) {
    $front_file = WAKALUMI_DIR . '/front-page.php';
    if ( file_exists( $front_file ) ) {
        include $front_file;
        return;
    }
}

get_header();
?>

<section class="section">
    <div class="container-wide">
        <div class="text-center mb-14" data-aos="fade-up">
            <h1 class="section-title mb-4"><?php single_post_title(); ?></h1>
        </div>

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
                <div class="flex items-center gap-2">
                    <?php
                    the_posts_pagination( [
                        'mid_size'  => 2,
                        'prev_text' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>',
                        'next_text' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>',
                    ] );
                    ?>
                </div>
            </div>
        <?php else : ?>
            <div class="text-center py-20">
                <p class="text-lg text-slate-500 dark:text-slate-400">Belum ada konten.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>

