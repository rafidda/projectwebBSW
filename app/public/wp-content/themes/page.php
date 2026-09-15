<?php
/**
 * Default Page Template
 *
 * @package Wakalumi
 */

// ── PROTEKSI ROUTING TEMA: PASTIKAN HALAMAN SESUAI PERUNTUKANNYA ──
global $post;
$slug = isset( $post->post_name ) ? strtolower( $post->post_name ) : '';

// 1. Jika ini halaman depan atau beranda
if ( is_front_page() || in_array( $slug, [ 'home', 'beranda' ], true ) ) {
    include WAKALUMI_DIR . '/front-page.php';
    return;
}

// 2. Jika ini halaman Tentang Kami
if ( in_array( $slug, [ 'tentang-kami', 'tentang' ], true ) ) {
    include WAKALUMI_DIR . '/page-tentang-kami.php';
    return;
}

// 3. Jika ini halaman Legalitas Perusahaan
if ( in_array( $slug, [ 'legalitas', 'legalitas-perusahaan' ], true ) ) {
    include WAKALUMI_DIR . '/page-legalitas.php';
    return;
}

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

