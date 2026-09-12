<?php
/**
 * 404 Page Template
 *
 * @package Wakalumi
 */

get_header();
?>

<section class="section relative overflow-hidden">
    <!-- Decorative background -->
    <div class="absolute inset-0 mesh-gradient"></div>
    <div class="pattern-overlay"></div>

    <div class="container-narrow relative z-10 text-center">
        <!-- Big 404 -->
        <div data-aos="fade-up">
            <span class="text-8xl md:text-9xl font-extrabold text-primary-200 dark:text-primary-800/50 select-none">
                404
            </span>
        </div>

        <!-- Content -->
        <div data-aos="fade-up" data-aos-delay="100" class="-mt-6">
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-4">
                Halaman Tidak Ditemukan
            </h1>
            <p class="text-lg text-slate-500 dark:text-slate-400 max-w-md mx-auto mb-8">
                Maaf, halaman yang Anda cari tidak tersedia. Mungkin telah dipindahkan atau dihapus.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary text-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Kembali ke Beranda
                </a>
                <a href="<?php echo esc_url( home_url( '/kontak' ) ); ?>" class="btn-ghost text-sm">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

