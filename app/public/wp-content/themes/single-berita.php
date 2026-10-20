<?php
/**
 * Single Berita (News Detail & Reading View) Template
 * High-End Banking Editorial Article Experience
 *
 * @package Wakalumi
 */

$is_external     = get_post_meta( get_the_ID(), 'berita_is_external', true ) === '1' || ! empty( get_post_meta( get_the_ID(), 'berita_external_url', true ) );
$external_source = get_post_meta( get_the_ID(), 'berita_external_source', true );
$external_url    = get_post_meta( get_the_ID(), 'berita_external_url', true );
$external_mode   = get_post_meta( get_the_ID(), 'berita_external_mode', true ) ?: 'direct';

// Jika artikel bertipe direct link dan pengunjung bukan admin/editor yang sedang mempratinjau, alihkan ke tautan sumber asli
if ( $is_external && $external_mode === 'direct' && ! empty( $external_url ) && ! current_user_can( 'edit_posts' ) ) {
    wp_redirect( $external_url, 302 );
    exit;
}

get_header();

$ringkasan    = get_field( 'berita_ringkasan' ) ?: get_the_excerpt();
$penulis      = get_field( 'berita_penulis' ) ?: 'Redaksi Bank Syariah Wakalumi';
$penulis      = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $penulis );
$categories   = get_the_terms( get_the_ID(), 'kategori_berita' );
$primary_cat  = ( $categories && ! is_wp_error( $categories ) ) ? $categories[0] : null;

$reading_time = function_exists( 'wakalumi_calculate_reading_time' )
    ? wakalumi_calculate_reading_time( get_the_content() )
    : '3 mnt baca';

$post_url     = get_permalink();
$post_title   = get_the_title();
$wa_share_url = 'https://api.whatsapp.com/send?text=' . rawurlencode( $post_title . "\n" . $post_url );
$fb_share_url = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( $post_url );
$tw_share_url = 'https://twitter.com/intent/tweet?text=' . rawurlencode( $post_title ) . '&url=' . rawurlencode( $post_url );

$cta          = function_exists( 'wakalumi_get_berita_cta' ) ? wakalumi_get_berita_cta() : [];
$display_author = ( $is_external && ! empty( $external_source ) ) ? $external_source : $penulis;
?>

<div class="min-h-screen bg-transparent text-slate-800 dark:text-slate-200 pb-24">

    <!-- ========================================================================
         ARTICLE HEADER & BREADCRUMBS
         ======================================================================== -->
    <header class="wkl-page-hero pb-10">
        <!-- Ambient Glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-6xl h-64 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

        <div class="container-narrow relative z-10">

            <!-- Admin Notice if in Direct Link Mode -->
            <?php if ( $is_external && $external_mode === 'direct' && current_user_can( 'edit_posts' ) ) : ?>
                <div class="mb-6 p-4 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-900 dark:text-amber-200 text-xs sm:text-sm font-semibold flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-xs">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">ℹ️</span>
                        <span><strong>Pratinjau Admin:</strong> Berita ini diatur ke mode <em>Alihkan Langsung (Direct Link ↗)</em> ke <strong><?php echo esc_html( $external_source ?: 'Media Luar' ); ?></strong>. Pengunjung umum langsung dialihkan ke URL tujuan.</span>
                    </div>
                    <?php if ( ! empty( $external_url ) ) : ?>
                        <a href="<?php echo esc_url( $external_url ); ?>" target="_blank" rel="noopener noreferrer" class="px-3.5 py-1.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs shrink-0 transition-colors shadow-xs">
                            Buka Tautan Eksternal ↗
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6 flex-wrap" data-aos="fade-down">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-300 transition-colors flex items-center gap-1.5 font-medium">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Beranda
                </a>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'berita' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-300 transition-colors font-medium">
                    Berita &amp; Artikel
                </a>
                <?php if ( $primary_cat ) : ?>
                    <span class="text-slate-300 dark:text-slate-600">/</span>
                    <a href="<?php echo esc_url( get_term_link( $primary_cat ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-300 transition-colors font-medium">
                        <?php echo esc_html( $primary_cat->name ); ?>
                    </a>
                <?php endif; ?>
                <span class="text-slate-300 dark:text-slate-600">/</span>
                <span class="text-teal-600 dark:text-teal-400 font-semibold truncate max-w-[240px]">
                    <?php echo esc_html( wp_strip_all_tags( $post_title ) ); ?>
                </span>
            </nav>

            <!-- Categories, Badges & Reading Time Pill Bar -->
            <div class="flex flex-wrap items-center gap-2.5 mb-4" data-aos="fade-up">
                <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
                    <?php foreach ( $categories as $cat ) : ?>
                        <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>"
                           class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-teal-100/90 dark:bg-teal-950/70 text-teal-800 dark:text-teal-300 border border-teal-300/60 dark:border-teal-700/60 shadow-xs hover:bg-teal-200 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                            <?php echo esc_html( $cat->name ); ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if ( $is_external ) : ?>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-black bg-cyan-600 text-white shadow-xs">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.25"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                        Liputan: <?php echo esc_html( ! empty( $external_source ) ? $external_source : 'Media Luar' ); ?>
                    </span>
                <?php endif; ?>

                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-white dark:bg-dark-card text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-dark-border shadow-xs">
                    <svg class="w-3.5 h-3.5 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <?php echo esc_html( $reading_time ); ?>
                </span>
            </div>

            <!-- Headline Title -->
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-6" data-aos="fade-up" data-aos-delay="50">
                <?php the_title(); ?>
            </h1>

            <!-- Lead Summary Callout (if available) -->
            <?php if ( ! empty( $ringkasan ) ) : ?>
                <div class="p-4 sm:p-5 rounded-2xl bg-teal-50/70 dark:bg-teal-950/30 border-l-4 border-teal-500 text-base sm:text-lg text-slate-700 dark:text-slate-300 leading-relaxed font-medium mb-6" data-aos="fade-up" data-aos-delay="100">
                    <?php echo esc_html( wp_strip_all_tags( $ringkasan ) ); ?>
                </div>
            <?php endif; ?>

            <!-- Author, Date & Share Action Bar -->
            <div class="pt-6 border-t border-slate-200/80 dark:border-dark-border flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4" data-aos="fade-up" data-aos-delay="150">
                <!-- Author & Date -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full <?php echo $is_external ? 'bg-cyan-600' : 'bg-teal-600'; ?> text-white flex items-center justify-center font-bold text-sm shadow-sm ring-2 ring-teal-500/20">
                        <?php echo $is_external ? '🌐' : 'BW'; ?>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5 font-bold text-sm text-slate-900 dark:text-white">
                            <span><?php echo esc_html( $display_author ); ?></span>
                            <?php if ( $is_external ) : ?>
                                <span class="text-[10.5px] font-extrabold px-2 py-0.5 rounded-md bg-cyan-100 dark:bg-cyan-950/80 text-cyan-800 dark:text-cyan-300">
                                    Penerbit Media
                                </span>
                            <?php else : ?>
                                <svg class="w-4 h-4 text-teal-500" fill="currentColor" viewBox="0 0 20 20" title="Terverifikasi">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            <?php endif; ?>
                        </div>
                        <time datetime="<?php echo get_the_date( 'c' ); ?>" class="text-xs text-slate-500 dark:text-slate-400">
                            Diterbitkan pada <?php echo get_the_date( 'l, j F Y' ); ?>
                        </time>
                    </div>
                </div>

                <!-- Social Share Buttons -->
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-slate-400 dark:text-slate-500 mr-1 hidden sm:inline">Bagikan:</span>
                    
                    <!-- WhatsApp Share -->
                    <a href="<?php echo esc_url( $wa_share_url ); ?>" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white shadow-xs transition-colors"
                       title="Bagikan ke WhatsApp">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>

                    <!-- Facebook Share -->
                    <a href="<?php echo esc_url( $fb_share_url ); ?>" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-blue-600 hover:bg-blue-700 text-white shadow-xs transition-colors"
                       title="Bagikan ke Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>

                    <!-- Twitter / X Share -->
                    <a href="<?php echo esc_url( $tw_share_url ); ?>" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-slate-900 hover:bg-slate-800 text-white shadow-xs transition-colors"
                       title="Bagikan ke X">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>

                    <!-- Copy URL Button with Toast -->
                    <button type="button" 
                            onclick="wakalumiCopyLink(this, '<?php echo esc_js( $post_url ); ?>')" 
                            class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border text-slate-700 dark:text-slate-300 hover:bg-slate-100 transition-colors shadow-xs"
                            title="Salin Tautan Artikel">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </header>


    <!-- ========================================================================
         ARTICLE MAIN CONTENT & SHOWCASE
         ======================================================================== -->
    <article class="py-12 bg-transparent relative z-10">
        <div class="container-narrow">
            
            <?php while ( have_posts() ) : the_post(); ?>

                <!-- Featured Image Showcase -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mb-12 rounded-3xl overflow-hidden border border-slate-200/80 dark:border-dark-border shadow-2xl" data-aos="fade-up">
                        <?php the_post_thumbnail( 'hero-large', [
                            'class' => 'w-full aspect-[16/9] object-cover',
                        ] ); ?>
                        <?php if ( get_the_post_thumbnail_caption() ) : ?>
                            <div class="p-3 text-center text-xs text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-dark-card border-t border-slate-200/50 dark:border-dark-border">
                                📷 <?php echo esc_html( get_the_post_thumbnail_caption() ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Rich Prose Body -->
                <div class="prose prose-lg lg:prose-xl prose-slate dark:prose-invert max-w-none leading-relaxed
                            prose-headings:font-extrabold prose-headings:tracking-tight prose-headings:text-slate-900 dark:prose-headings:text-white
                            prose-a:text-teal-600 dark:prose-a:text-teal-400 prose-a:font-bold prose-a:no-underline hover:prose-a:underline
                            prose-img:rounded-3xl prose-img:shadow-lg prose-img:border prose-img:border-slate-200 dark:prose-img:border-dark-border
                            prose-blockquote:border-l-teal-500 prose-blockquote:bg-teal-50/50 dark:prose-blockquote:bg-teal-950/20 prose-blockquote:py-2 prose-blockquote:px-5 prose-blockquote:rounded-r-2xl" data-aos="fade-up">
                    <?php the_content(); ?>
                </div>

                <!-- Bottom Referral Card for External Media -->
                <?php if ( $is_external && ! empty( $external_url ) ) : ?>
                    <div class="my-10 p-7 sm:p-9 rounded-3xl bg-gradient-to-br from-slate-900 via-slate-900 to-teal-950 text-white border border-cyan-500/30 shadow-2xl relative overflow-hidden group" data-aos="fade-up">
                        <div class="absolute -right-10 -bottom-10 w-44 h-44 rounded-full bg-cyan-500/10 blur-2xl pointer-events-none"></div>
                        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                            <div class="space-y-2">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-cyan-500/20 text-cyan-300 border border-cyan-400/30">
                                    🌐 Kanal Penerbit Resmi
                                </span>
                                <h3 class="text-xl sm:text-2xl font-black text-white leading-snug">
                                    Ingin Membaca Liputan Lengkap di <?php echo esc_html( ! empty( $external_source ) ? $external_source : 'Situs Sumber' ); ?>?
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-xl">
                                    Akses naskah utuh, infografis, dan dokumentasi lengkap langsung dari portal media penerbit aslinya.
                                </p>
                            </div>
                            <a href="<?php echo esc_url( $external_url ); ?>" target="_blank" rel="noopener noreferrer"
                               class="btn-primary text-xs sm:text-sm font-black px-6 py-3.5 rounded-xl shadow-lg hover:scale-105 transition-all flex items-center gap-2 shrink-0">
                                <span>Kunjungi <?php echo esc_html( ! empty( $external_source ) ? $external_source : 'Situs Asli' ); ?></span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Bottom Share Bar -->
                <div class="mt-10 pt-8 border-t border-slate-200 dark:border-dark-border flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-sm font-extrabold text-slate-900 dark:text-white">
                        Bagikan warta ini kepada rekan &amp; keluarga:
                    </span>
                    <div class="flex items-center gap-2.5">
                        <a href="<?php echo esc_url( $wa_share_url ); ?>" target="_blank" rel="noopener noreferrer"
                           class="btn-whatsapp text-xs font-bold px-4 py-2 rounded-xl shadow-xs">
                            WhatsApp
                        </a>
                        <a href="<?php echo esc_url( $fb_share_url ); ?>" target="_blank" rel="noopener noreferrer"
                           class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shadow-xs transition-colors">
                            Facebook
                        </a>
                        <button type="button" 
                                onclick="wakalumiCopyLink(this, '<?php echo esc_js( $post_url ); ?>')" 
                                class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-dark-card dark:hover:bg-dark-border text-slate-700 dark:text-slate-200 text-xs font-bold transition-colors">
                            📋 Salin Tautan
                        </button>
                    </div>
                </div>

                <!-- Navigasi Antar Berita (Prev / Next Post) -->
                <div class="mt-14 pt-8 border-t border-slate-200 dark:border-dark-border">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php
                        $prev = get_previous_post();
                        $next = get_next_post();
                        ?>
                        <?php if ( $prev ) : ?>
                            <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="card-hover p-6 rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border group flex items-center gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0 group-hover:-translate-x-1 transition-transform">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block">Warta Sebelumnya</span>
                                    <p class="text-sm font-extrabold text-slate-900 dark:text-white line-clamp-1 group-hover:text-teal-600 transition-colors">
                                        <?php echo esc_html( get_the_title( $prev ) ); ?>
                                    </p>
                                </div>
                            </a>
                        <?php else : ?>
                            <div></div>
                        <?php endif; ?>

                        <?php if ( $next ) : ?>
                            <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="card-hover p-6 rounded-3xl bg-white dark:bg-dark-card border border-slate-200/80 dark:border-dark-border group flex items-center gap-4 text-right justify-end">
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 block">Warta Selanjutnya</span>
                                    <p class="text-sm font-extrabold text-slate-900 dark:text-white line-clamp-1 group-hover:text-teal-600 transition-colors">
                                        <?php echo esc_html( get_the_title( $next ) ); ?>
                                    </p>
                                </div>
                                <div class="w-10 h-10 rounded-2xl bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0 group-hover:translate-x-1 transition-transform">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endwhile; ?>

        </div>
    </article>


    <!-- ========================================================================
         RELATED NEWS / BERITA TERKAIT
         ======================================================================== -->
    <?php
    $related_args = [
        'post_type'      => 'berita',
        'posts_per_page' => 3,
        'post__not_in'   => [ get_the_ID() ],
        'post_status'    => 'publish',
    ];

    if ( $primary_cat ) {
        $related_args['tax_query'] = [
            [
                'taxonomy' => 'kategori_berita',
                'field'    => 'term_id',
                'terms'    => $primary_cat->term_id,
            ],
        ];
    }

    $related_query = new WP_Query( $related_args );

    // Fallback to recent posts if no posts in same category
    if ( ! $related_query->have_posts() ) {
        unset( $related_args['tax_query'] );
        $related_query = new WP_Query( $related_args );
    }

    if ( $related_query->have_posts() ) :
    ?>
        <section class="py-14 bg-slate-50 dark:bg-dark-surface border-t border-slate-200/80 dark:border-dark-border/80">
            <div class="container-wide">
                <div class="flex items-center justify-between mb-10" data-aos="fade-up">
                    <div>
                        <span class="text-xs font-black uppercase tracking-wider text-teal-600 dark:text-teal-400 block mb-1">Edukasi &amp; Informasi</span>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">
                            Berita &amp; Artikel Terkait
                        </h3>
                    </div>
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'berita' ) ); ?>" class="btn-ghost text-xs font-bold whitespace-nowrap">
                        Semua Berita &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    <?php
                    $delay = 100;
                    while ( $related_query->have_posts() ) : $related_query->the_post();
                        get_template_part( 'template-parts/card-berita', null, [ 'delay' => $delay ] );
                        $delay += 100;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <!-- ========================================================================
         BACK TO TOP & ARCHIVE CTA
         ======================================================================== -->
    <div class="container-narrow text-center pt-10 pb-4">
        <a href="<?php echo esc_url( get_post_type_archive_link( 'berita' ) ); ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-white dark:bg-dark-card border border-slate-200 dark:border-dark-border text-sm font-bold text-slate-700 dark:text-slate-300 hover:text-teal-600 dark:hover:text-teal-400 hover:border-teal-300 dark:hover:border-teal-700 transition-all shadow-xs">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            Kembali ke Seluruh Berita &amp; Warta
        </a>
    </div>

    <!-- ========================================================================
         BOTTOM CTA (CENTERED STYLING SESUAI STANDAR WAKALUMI)
         ======================================================================== -->
    <section class="relative z-10 py-12 md:py-20 overflow-hidden bg-transparent">
        <div class="container-narrow relative z-10">
            <div class="spotlight-card group relative overflow-hidden rounded-3xl p-8 sm:p-12 md:p-16 bg-gradient-to-b from-slate-900 via-slate-900 to-teal-950 text-white text-center shadow-2xl border border-teal-500/30" data-aos="fade-up">
                
                <!-- Ambient Glow Orbs -->
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-96 h-96 bg-teal-500/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <!-- Watermark Emblem (Centered Ambient Background) -->
                <div class="absolute right-1/2 translate-x-1/2 top-1/2 -translate-y-1/2 w-80 sm:w-96 h-80 sm:h-96 opacity-[0.04] dark:opacity-[0.05] pointer-events-none select-none overflow-hidden transition-transform duration-700 ease-out group-hover:scale-110 grayscale mix-blend-screen z-0">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 invert">
                </div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-5">
                    <!-- Kicker Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-500/20 text-teal-300 border border-teal-500/40 text-xs font-bold uppercase tracking-wider shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                        <span><?php echo esc_html( $cta['badge'] ?? 'Solusi Finansial Berkah' ); ?></span>
                    </div>

                    <!-- Title -->
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight">
                        <?php echo esc_html( $cta['title'] ?? 'Wujudkan Rencana Keuangan Syariah Bersama Bank Syariah Wakalumi' ); ?>
                    </h2>

                    <!-- Subtitle -->
                    <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                        <?php echo esc_html( $cta['desc'] ?? 'Konsultasikan kebutuhan simpanan berkah bebas riba atau ajukan pembiayaan usaha syariah Anda dengan proses amanah, transparan, dan berizin resmi OJK.' ); ?>
                    </p>

                    <!-- Action Buttons Centered: WhatsApp di kiri, Link di kanan, gradient shimmer seragam Wakalumi -->
                    <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                        <?php if ( ! empty( $cta['btn1_text'] ) ) : ?>
                            <a href="<?php echo esc_url( $cta['btn1_url'] ?? home_url( '/kontak/' ) ); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="relative overflow-hidden group/btn py-3.5 px-7 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-400 hover:from-teal-400 hover:to-cyan-300 text-slate-950 font-black text-sm inline-flex items-center gap-2.5 shadow-lg shadow-teal-500/25 hover:shadow-teal-500/40 transition-all hover:scale-105 active:scale-95">
                                <!-- Shimmer Sweep -->
                                <span class="absolute inset-0 w-1/2 h-full bg-white/30 transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-[300%] transition-transform duration-1000 ease-out pointer-events-none"></span>
                                <svg class="w-5 h-5 flex-shrink-0 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                <span><?php echo esc_html( $cta['btn1_text'] ); ?></span>
                            </a>
                        <?php endif; ?>

                        <?php if ( ! empty( $cta['btn2_text'] ) ) : ?>
                            <a href="<?php echo esc_url( $cta['btn2_url'] ?? home_url( '/produk/tabungan-syariah/' ) ); ?>" 
                               class="py-3.5 px-7 rounded-xl bg-white/10 hover:bg-white/15 text-white font-bold text-sm border border-white/20 hover:border-white/40 shadow-md inline-flex items-center gap-2 transition-all hover:-translate-y-0.5">
                                <span><?php echo esc_html( $cta['btn2_text'] ); ?></span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Trust Footer Text -->
                    <div class="pt-4 flex items-center justify-center gap-3 text-xs text-slate-400">
                        <span>PT BPRS Wakalumi terdaftar &amp; diawasi oleh OJK</span>
                        <span>•</span>
                        <span>Peserta Penjaminan LPS</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- Interactive Copy Link Script with Toast -->
<script>
function wakalumiCopyLink(btn, url) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(url).then(function() {
            showToast('✅ Tautan artikel berhasil disalin!');
        }).catch(function() {
            promptFallback(url);
        });
    } else {
        promptFallback(url);
    }

    function promptFallback(text) {
        window.prompt('Salin tautan berikut:', text);
    }

    function showToast(msg) {
        var toast = document.createElement('div');
        toast.className = 'fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl bg-slate-900 text-white text-xs font-bold shadow-2xl border border-slate-700 flex items-center gap-2 transform transition-all duration-300 translate-y-10 opacity-0';
        toast.innerHTML = msg;
        document.body.appendChild(toast);
        setTimeout(function() {
            toast.classList.remove('translate-y-10', 'opacity-0');
        }, 10);
        setTimeout(function() {
            toast.classList.add('translate-y-10', 'opacity-0');
            setTimeout(function() {
                if (toast.parentNode) toast.parentNode.removeChild(toast);
            }, 300);
        }, 2500);
    }
}
</script>

<?php get_footer(); ?>
