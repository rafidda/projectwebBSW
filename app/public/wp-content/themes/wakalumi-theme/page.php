<?php
/**
 * Default Page Template
 *
 * @package Wakalumi
 */

get_header();
?>

<section class="section">
    <div class="container-narrow">
        <?php while ( have_posts() ) : the_post(); ?>
            <!-- Page Header -->
            <div class="text-center mb-14" data-aos="fade-up">
                <h1 class="section-title mb-4"><?php the_title(); ?></h1>
            </div>

            <!-- Content -->
            <div class="prose prose-lg prose-slate dark:prose-invert mx-auto max-w-none" data-aos="fade-up" data-aos-delay="100">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>

