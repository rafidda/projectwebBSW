<?php
/**
 * Footer Template
 *
 * @package Wakalumi
 */

// Get ACF options data
$footer_about   = function_exists( 'get_field' ) ? get_field( 'footer_about', 'option' ) : '';
$phone          = function_exists( 'get_field' ) ? get_field( 'phone', 'option' ) : '';
$email          = function_exists( 'get_field' ) ? get_field( 'email', 'option' ) : '';
$address        = function_exists( 'get_field' ) ? get_field( 'address', 'option' ) : '';
$social_ig      = function_exists( 'get_field' ) ? get_field( 'social_instagram', 'option' ) : '';
$social_fb      = function_exists( 'get_field' ) ? get_field( 'social_facebook', 'option' ) : '';
$social_yt      = function_exists( 'get_field' ) ? get_field( 'social_youtube', 'option' ) : '';
$social_tiktok  = function_exists( 'get_field' ) ? get_field( 'social_tiktok', 'option' ) : '';
$wa_url         = function_exists( 'wakalumi_get_whatsapp_url' ) ? wakalumi_get_whatsapp_url() : '#';
?>

    </main>
</div><!-- /#swup -->

<!-- ========================================
     FOOTER
     ======================================== -->
<footer class="bg-slate-900 dark:bg-dark-surface border-t border-slate-800 dark:border-dark-border relative overflow-hidden">
    <!-- Decorative pattern -->
    <div class="absolute inset-0 opacity-[0.02]">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;40&quot; height=&quot;40&quot; viewBox=&quot;0 0 40 40&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;%232DD4BF&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M20 20.5V18H0v-2h20v-2l2 3-2 3zM0 20.5V18h20v-2H0V14l-2 3 2 3z&quot;/%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="container-wide relative z-10">
        <!-- Main Footer Content -->
        <div class="py-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">

            <!-- Column 1: About -->
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-5">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="w-10 h-10 flex-shrink-0">
                            <?php
                            $logo_id = get_theme_mod( 'custom_logo' );
                            echo wp_get_attachment_image( $logo_id, 'thumbnail', false, [
                                'class' => 'w-full h-full object-contain brightness-0 invert',
                            ] );
                            ?>
                        </div>
                    <?php else : ?>
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                            </svg>
                        </div>
                    <?php endif; ?>
                    <div>
                        <span class="block text-sm font-bold text-white">BPRS Wakalumi</span>
                        <span class="block text-[10px] text-slate-500 uppercase tracking-widest">Bank Syariah</span>
                    </div>
                </div>
                <?php if ( $footer_about ) : ?>
                    <p class="text-sm text-slate-400 leading-relaxed mb-5">
                        <?php echo esc_html( $footer_about ); ?>
                    </p>
                <?php else : ?>
                    <p class="text-sm text-slate-400 leading-relaxed mb-5">
                        BPRS Wakalumi adalah bank syariah yang berkomitmen melayani masyarakat dengan prinsip keuangan Islam yang amanah.
                    </p>
                <?php endif; ?>

                <!-- Social Media -->
                <div class="flex items-center gap-3">
                    <?php if ( $social_ig ) : ?>
                        <a href="<?php echo esc_url( $social_ig ); ?>" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-primary-600 flex items-center justify-center text-slate-400 hover:text-white transition-all duration-200 dark:bg-dark-surface-alt dark:hover:bg-primary-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    <?php endif; ?>
                    <?php if ( $social_fb ) : ?>
                        <a href="<?php echo esc_url( $social_fb ); ?>" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-primary-600 flex items-center justify-center text-slate-400 hover:text-white transition-all duration-200 dark:bg-dark-surface-alt dark:hover:bg-primary-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    <?php endif; ?>
                    <?php if ( $social_yt ) : ?>
                        <a href="<?php echo esc_url( $social_yt ); ?>" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-primary-600 flex items-center justify-center text-slate-400 hover:text-white transition-all duration-200 dark:bg-dark-surface-alt dark:hover:bg-primary-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    <?php endif; ?>
                    <?php if ( $social_tiktok ) : ?>
                        <a href="<?php echo esc_url( $social_tiktok ); ?>" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-primary-600 flex items-center justify-center text-slate-400 hover:text-white transition-all duration-200 dark:bg-dark-surface-alt dark:hover:bg-primary-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Column 2: Navigasi -->
            <div>
                <h4 class="text-sm font-bold text-white mb-5 uppercase tracking-wider">Navigasi</h4>
                <ul class="space-y-3">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors">Beranda</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/profil/tentang-kami' ) ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors">Tentang Kami</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/produk' ) ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors">Produk</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/berita' ) ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors">Berita</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/informasi/nisbah' ) ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors">Informasi Nisbah</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/informasi/laporan-keuangan' ) ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors">Laporan Keuangan</a></li>
                </ul>
            </div>

            <!-- Column 3: Informasi -->
            <div>
                <h4 class="text-sm font-bold text-white mb-5 uppercase tracking-wider">Informasi</h4>
                <ul class="space-y-3">
                    <li><a href="<?php echo esc_url( home_url( '/informasi/karir' ) ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors">Karir</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/informasi/galeri' ) ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors">Galeri</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/informasi/literasi' ) ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors">Literasi & Inklusi</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/tim-kami' ) ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors">Tim Kami</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/kontak' ) ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors">Kontak</a></li>
                </ul>
            </div>

            <!-- Column 4: Kontak -->
            <div>
                <h4 class="text-sm font-bold text-white mb-5 uppercase tracking-wider">Kontak</h4>
                <ul class="space-y-4">
                    <?php if ( $address ) : ?>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-primary-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <span class="text-sm text-slate-400"><?php echo nl2br( esc_html( $address ) ); ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if ( $phone ) : ?>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors"><?php echo esc_html( $phone ); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ( $email ) : ?>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-primary-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="text-sm text-slate-400 hover:text-primary-400 transition-colors"><?php echo esc_html( $email ); ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-primary-400 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener" class="text-sm text-slate-400 hover:text-primary-400 transition-colors">WhatsApp Kami</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="py-6 border-t border-slate-800 dark:border-dark-border flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-xs text-slate-500">
                &copy; <?php echo date( 'Y' ); ?> BPRS Wakalumi. Seluruh hak cipta dilindungi.
            </p>
            <p class="text-xs text-slate-600">
                Diawasi oleh <span class="text-slate-400">Otoritas Jasa Keuangan (OJK)</span> &amp; dijamin <span class="text-slate-400">LPS</span>
            </p>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp Button -->
<a href="<?php echo esc_url( $wa_url ); ?>"
   target="_blank" rel="noopener noreferrer"
   class="fixed bottom-6 right-6 z-40 w-14 h-14 rounded-full
          bg-emerald-500 hover:bg-emerald-600 text-white
          flex items-center justify-center
          shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/40
          hover:scale-110
          transition-all duration-300
          dark:shadow-emerald-400/20 dark:hover:shadow-emerald-400/30"
   aria-label="Chat WhatsApp">
    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
</a>

<?php wp_footer(); ?>
</body>
</html>

