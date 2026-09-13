<?php
/**
 * Footer Template
 *
 * @package Wakalumi
 */

// Get options data with Fallbacks (Dummy data) if empty
$footer_about   = get_option( 'options_footer_about', 'Bank Syariah modern yang mengutamakan pelayanan prima dan prinsip keadilan untuk kesejahteraan bersama.' );
$phone          = get_option( 'options_contact_phone', '(021) 7401667' );
$email          = get_option( 'options_contact_email', 'info@bprswakalumi.co.id' );
$address        = get_option( 'options_contact_address', "Ruko Ciputat Center Blok B-3, Jl. Ir. H. Juanda No. 21, Rempoa\nCiputat Timur, Tangerang Selatan 15412" );

// Operational hours
$jam_weekday    = get_option( 'options_jam_operasional_weekday', '08:00 - 15:00 WIB' );
$jam_weekend    = get_option( 'options_jam_operasional_weekend', 'Tutup' );

// Google Maps Embed
$maps_embed     = get_option( 'options_maps_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.5!2d106.74!3d-6.34!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMjAnMjQuMCJTIDEwNsKwNDQnMjQuMCJF!5e0!3m2!1sen!2sid!4v1' );

// Social links
$social_ig      = get_option( 'options_social_instagram', 'https://www.instagram.com/bprswakalumi' );
$social_fb      = get_option( 'options_social_facebook', 'https://facebook.com/bprswakalumi' );
$social_li      = get_option( 'options_social_linkedin', 'https://linkedin.com/company/bprswakalumi' );
$social_yt      = get_option( 'options_social_youtube', '' );

// Legal & Copyright
$copyright_text = get_option( 'options_footer_copyright', 'Bank Syariah Wakalumi. All Rights Reserved.' );
$disclaimer_text= get_option( 'options_footer_disclaimer', 'BPRS Wakalumi Berizin dan Diawasi Oleh Otoritas Jasa Keuangan (OJK) serta merupakan peserta program penjaminan Lembaga Penjamin Simpanan (LPS).' );

$wa_number      = get_option( 'options_contact_wa', '6281517380388' );
$wa_url         = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );
?>

    </main>
</div><!-- /#swup -->

<!-- ========================================
     FOOTER
     ======================================== -->
<footer class="bg-slate-900 dark:bg-dark-surface border-t border-slate-800 dark:border-dark-border relative z-30 overflow-hidden">
    <!-- Decorative pattern -->
    <div class="absolute inset-0 opacity-[0.02]">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;40&quot; height=&quot;40&quot; viewBox=&quot;0 0 40 40&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;%232DD4BF&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M20 20.5V18H0v-2h20v-2l2 3-2 3zM0 20.5V18h20v-2H0V14l-2 3 2 3z&quot;/%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="container-wide relative z-10">
        <!-- Main Footer Content -->
        <div class="py-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-12">

            <!-- Column 1: About & Social -->
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-5">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="w-10 h-10 flex-shrink-0">
                            <?php
                            $logo_id = get_theme_mod( 'custom_logo' );
                            echo wp_get_attachment_image( $logo_id, 'thumbnail', false, [
                                'class' => 'w-full h-full object-contain'
                            ] );
                            ?>
                        </div>
                    <?php else: ?>
                        <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white font-bold">
                            W
                        </div>
                    <?php endif; ?>
                    <div>
                        <h3 class="text-xl font-extrabold text-white tracking-tight leading-none mb-1">Bank Syariah Wakalumi</h3>
                        <p class="text-[10px] font-semibold text-primary-400 uppercase tracking-widest">BPRS</p>
                    </div>
                </div>

                <p class="text-sm text-slate-400 leading-relaxed mb-8 pr-4">
                    <?php echo esc_html( $footer_about ); ?>
                </p>

                <h4 class="text-xs font-bold text-white mb-4 uppercase tracking-wider">Ikuti Kami</h4>
                <div class="flex items-center gap-3">
                    <?php if ( $social_ig ) : ?>
                    <a href="<?php echo esc_url( $social_ig ); ?>" target="_blank" rel="noopener" aria-label="Instagram"
                       class="w-10 h-10 rounded-full bg-slate-800 hover:bg-primary-600 flex items-center justify-center text-slate-400 hover:text-white transition-all duration-300 dark:bg-dark-surface-alt dark:hover:bg-primary-500 hover:-translate-y-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ( $social_fb ) : ?>
                    <a href="<?php echo esc_url( $social_fb ); ?>" target="_blank" rel="noopener" aria-label="Facebook"
                       class="w-10 h-10 rounded-full bg-slate-800 hover:bg-primary-600 flex items-center justify-center text-slate-400 hover:text-white transition-all duration-300 dark:bg-dark-surface-alt dark:hover:bg-primary-500 hover:-translate-y-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ( $social_li ) : ?>
                    <a href="<?php echo esc_url( $social_li ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"
                       class="w-10 h-10 rounded-full bg-slate-800 hover:bg-primary-600 flex items-center justify-center text-slate-400 hover:text-white transition-all duration-300 dark:bg-dark-surface-alt dark:hover:bg-primary-500 hover:-translate-y-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ( $social_yt ) : ?>
                    <a href="<?php echo esc_url( $social_yt ); ?>" target="_blank" rel="noopener" aria-label="YouTube"
                       class="w-10 h-10 rounded-full bg-slate-800 hover:bg-rose-600 flex items-center justify-center text-slate-400 hover:text-white transition-all duration-300 dark:bg-dark-surface-alt dark:hover:bg-rose-600 hover:-translate-y-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Column 2: Alamat & Kontak -->
            <div>
                <h4 class="text-sm font-bold text-white mb-6 uppercase tracking-wider">Hubungi Kami</h4>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-primary-400 flex-shrink-0 mt-1 dark:bg-dark-surface-alt">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <span class="text-sm text-slate-400 leading-relaxed"><?php echo nl2br( esc_html( $address ) ); ?></span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-primary-400 flex-shrink-0 dark:bg-dark-surface-alt">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                        </div>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="text-sm font-medium text-slate-300 hover:text-primary-400 transition-colors"><?php echo esc_html( $phone ); ?></a>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-primary-400 flex-shrink-0 dark:bg-dark-surface-alt">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <a href="mailto:<?php echo esc_attr( $email ); ?>" class="text-sm font-medium text-slate-300 hover:text-primary-400 transition-colors"><?php echo esc_html( $email ); ?></a>
                    </li>
                </ul>

                <h4 class="text-sm font-bold text-white mb-5 uppercase tracking-wider">Jam Operasional</h4>
                <ul class="space-y-3">
                    <li class="flex items-center justify-between text-sm border-b border-slate-800 pb-2">
                        <span class="text-slate-400">Senin - Jum'at</span>
                        <span class="text-primary-400 font-medium"><?php echo esc_html( $jam_weekday ); ?></span>
                    </li>
                    <li class="flex items-center justify-between text-sm border-b border-slate-800 pb-2">
                        <span class="text-slate-400">Sabtu, Minggu &amp; Libur</span>
                        <span class="<?php echo ( strtolower( $jam_weekend ) === 'tutup' ) ? 'text-rose-400' : 'text-primary-400'; ?> font-medium"><?php echo esc_html( $jam_weekend ); ?></span>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Lokasi Maps & Back to top -->
            <div class="flex flex-col h-full">
                <h4 class="text-sm font-bold text-white mb-6 uppercase tracking-wider">Lokasi Kantor</h4>
                <div class="maps-wrapper rounded-2xl overflow-hidden mb-6 border border-slate-700/50 dark:border-dark-border w-full flex-grow shadow-lg" style="min-height: 200px;">
                    <?php if ( $maps_embed ) : ?>
                        <iframe src="<?php echo esc_url( $maps_embed ); ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <?php endif; ?>
                </div>

                <!-- Back to Top Button -->
                <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="group flex items-center justify-center gap-2 w-full py-4 rounded-xl bg-slate-800 hover:bg-primary-600 text-slate-300 hover:text-white transition-all duration-300">
                    <span class="text-sm font-bold uppercase tracking-wider">Kembali ke Atas</span>
                    <svg class="w-4 h-4 group-hover:-translate-y-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Bottom Bar -->
        <?php
        $footer_show_logos    = get_option( 'options_footer_show_logos', '1' );
        $footer_logos_desktop = get_option( 'options_footer_logos_desktop', '1' );
        $footer_logos_mobile  = get_option( 'options_footer_logos_mobile', '1' );
        
        $footer_logos = get_option( 'options_footer_reg_logos', [] );
        if ( empty( $footer_logos ) ) {
            $old_ojk = get_option( 'options_logo_ojk_url', get_template_directory_uri() . '/assets/img/ojk-logo.png' );
            $old_lps = get_option( 'options_logo_lps_url', get_template_directory_uri() . '/assets/img/lps-logo.png' );
            $footer_logos = [
                [ 'label' => 'OJK', 'url' => $old_ojk ],
                [ 'label' => 'LPS', 'url' => $old_lps ],
            ];
        }

        $footer_logos_class = '';
        if ( $footer_show_logos ) {
            if ( $footer_logos_desktop && $footer_logos_mobile ) {
                $footer_logos_class = 'flex';
            } elseif ( $footer_logos_desktop && ! $footer_logos_mobile ) {
                $footer_logos_class = 'hidden md:flex';
            } elseif ( ! $footer_logos_desktop && $footer_logos_mobile ) {
                $footer_logos_class = 'flex md:hidden';
            } else {
                $footer_logos_class = 'hidden';
            }
        } else {
            $footer_logos_class = 'hidden';
        }
        ?>
        <div class="py-8 border-t border-slate-800 dark:border-dark-border flex flex-col items-center justify-center gap-4 text-center">
            <?php if ( $footer_logos_class !== 'hidden' && ! empty( $footer_logos ) ) : ?>
            <!-- Logo Regulasi Dinamis (OJK, LPS, BI, dll.) -->
            <div class="<?php echo esc_attr( $footer_logos_class ); ?> flex-wrap items-center justify-center gap-2.5 sm:gap-3 py-1">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mr-1">Terdaftar & Diawasi:</span>
                <?php foreach ( $footer_logos as $f_logo ) :
                    $f_lbl = $f_logo['label'] ?? '';
                    $f_url = $f_logo['url'] ?? '';
                    if ( empty( $f_url ) && empty( $f_lbl ) ) continue;
                ?>
                    <div class="h-8 md:h-9 bg-white/95 rounded-lg p-1 sm:p-1.5 shadow-sm flex items-center justify-center">
                        <?php if ( ! empty( $f_url ) ) : ?>
                            <img src="<?php echo esc_url( $f_url ); ?>" alt="<?php echo esc_attr( $f_lbl ); ?>" class="h-full w-auto max-h-7 md:max-h-8 object-contain" onerror="this.outerHTML='<span class=\'text-xs font-bold text-slate-800 px-2\'><?php echo esc_html( $f_lbl ); ?></span>'">
                        <?php else : ?>
                            <span class="text-xs font-bold text-slate-800 px-2"><?php echo esc_html( $f_lbl ); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Pernyataan Regulasi Resmi -->
            <p class="text-xs text-slate-400 max-w-2xl leading-relaxed">
                <?php echo esc_html( $disclaimer_text ); ?>
            </p>

            <!-- Teks Hak Cipta Paling Bawah -->
            <p class="text-[11px] font-medium text-slate-500 pt-3 border-t border-slate-800/70 dark:border-dark-border/70 w-full max-w-md">
                &copy; <?php echo date( 'Y' ); ?> <?php echo esc_html( $copyright_text ); ?>
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
          hover:scale-110 hover:-translate-y-1
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
