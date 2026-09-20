<?php
/**
 * Header Template — Navbar, dark mode toggle, mobile menu
 *
 * @package Wakalumi
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0D9488">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
    <!-- Dark mode flash prevention -->
    <script>
        (function(){
            const saved = localStorage.getItem('wakalumi-dark-mode');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (saved === 'true' || (saved === null && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>

<body <?php body_class( 'min-h-screen flex flex-col' ); ?>>
<?php wp_body_open(); ?>

<!-- Global Background Watermark Parallax -->
<div class="fixed inset-0 z-[-1] pointer-events-none flex items-center justify-center overflow-hidden">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-[80vw] max-w-[600px] opacity-[0.03] dark:opacity-[0.02] grayscale mix-blend-multiply dark:mix-blend-screen transform scale-110">
</div>

<!-- Top Loading Line Indicator -->
<div id="swup-progress-bar" class="fixed top-0 left-0 right-0 h-[3px] z-[10001] pointer-events-none opacity-0 transition-all duration-300 bg-gradient-to-r from-teal-400 via-primary-500 to-teal-300 shadow-[0_0_12px_rgba(45,212,191,0.9)] w-0"></div>

<!-- ========================================
     PRELOADER & PAGE TRANSITION (LIQUID FILL)
     ======================================== -->
<div id="wakalumi-preloader" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white/95 dark:bg-dark/95 backdrop-blur-xl flex-col transition-opacity duration-500">
    <div class="relative w-32 h-32 overflow-hidden mb-4 rounded-3xl shadow-2xl shadow-primary-500/20 bg-slate-50 dark:bg-dark-surface border border-slate-100 dark:border-dark-border">
        <!-- Mask for Liquid Fill -->
        <div class="absolute inset-0 mask-logo" style="-webkit-mask-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/logo-new-1.png'); -webkit-mask-size: 80%; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center; mask-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/logo-new-1.png'); mask-size: 80%; mask-repeat: no-repeat; mask-position: center; background-color: #e2e8f0;">
            <!-- The Water -->
            <div id="preloader-liquid" class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary-600 via-primary-500 to-teal-400 h-[120%] transform translate-y-full transition-transform duration-[1500ms] ease-out"></div>
        </div>
    </div>
    <div class="h-1 w-32 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
        <div id="preloader-bar" class="h-full bg-primary-500 w-0 transition-all duration-[1500ms] ease-out"></div>
    </div>
</div>

<?php
$wa_number = get_option( 'options_contact_wa', '6281517380388' );
$wa_url    = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );
?>

<!-- ========================================
     NAVBAR
     ======================================== -->
<header id="main-navbar" class="fixed top-0 left-0 right-0 z-[100] transition-all duration-300 glass-strong border-b border-white/10 shadow-sm">
    <div class="container-wide">
        <nav class="flex items-center justify-between h-16 md:h-20">

            <!-- Logo & Name -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 group relative z-10">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="w-10 h-10 flex-shrink-0 group-hover:scale-105 transition-transform duration-300">
                        <?php
                        $logo_id = get_theme_mod( 'custom_logo' );
                        echo wp_get_attachment_image( $logo_id, 'thumbnail', false, [
                            'class' => 'w-full h-full object-contain',
                        ] );
                        ?>
                    </div>
                <?php else : ?>
                    <!-- Placeholder Logo (geometric Islamic pattern) -->
                    <div class="w-10 h-10 flex-shrink-0 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-lg shadow-primary-500/20 dark:shadow-primary-400/20 group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                        </svg>
                    </div>
                <?php endif; ?>
                <div>
                    <h1 class="text-[17px] font-extrabold text-slate-900 dark:text-white tracking-tight leading-none mb-0.5">Bank Syariah Wakalumi</h1>
                    <p class="text-[9px] font-bold text-primary-600 dark:text-primary-400 uppercase tracking-[0.2em] opacity-80">BPRS</p>
                </div>
            </a>

            <?php
            $req_uri = untrailingslashit( wp_parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH ) );
            if ( empty( $req_uri ) ) {
                $req_uri = '/';
            }
            $is_page_home      = ( is_front_page() || is_home() || $req_uri === '/' );
            $is_page_profil    = ( ! $is_page_home && ( strpos( $req_uri, '/profil' ) === 0 || is_page( [ 'tentang-kami', 'legalitas', 'susunan-pengurus', 'jaringan-kantor' ] ) ) );
            $is_page_produk    = ( ! $is_page_home && ( strpos( $req_uri, '/produk' ) === 0 || strpos( $req_uri, '/brosur' ) === 0 || is_page( 'brosur' ) || is_post_type_archive( 'produk' ) || is_singular( 'produk' ) ) );
            $is_page_informasi = ( ! $is_page_home && ( strpos( $req_uri, '/informasi' ) === 0 || strpos( $req_uri, '/berita' ) === 0 || is_singular( 'berita' ) || is_post_type_archive( 'berita' ) || is_category() ) );
            $is_page_kontak    = ( ! $is_page_home && ( strpos( $req_uri, '/kontak' ) === 0 || is_page( 'kontak' ) ) );

            // Brosur Dokumen Dinamis dari Database
            $brosur_file_url  = get_option( 'options_brosur_file_url', '' );
            $brosur_file_name = get_option( 'options_brosur_file_name', 'Brosur Resmi BPRS Wakalumi (Edisi 2026).pdf' );
            $brosur_file_size = get_option( 'options_brosur_file_size', 'PDF Resmi • Edisi Terkini' );
            ?>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-1 xl:gap-2">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link <?php echo $is_page_home ? 'active' : ''; ?> px-4 py-2 rounded-full">Beranda</a>
                
                <div class="dropdown relative">
                    <button class="dropdown-trigger nav-link <?php echo $is_page_profil ? 'active' : ''; ?> px-4 py-2 rounded-full inline-flex items-center gap-1.5 group">
                        Profil
                        <svg class="w-3.5 h-3.5 opacity-50 group-hover:opacity-100 transition-all duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div class="dropdown-menu w-[360px] sm:w-[380px] p-4 lg:p-5 rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl border border-slate-200/90 dark:border-slate-700/80 shadow-2xl">
                        <!-- Header Kicker -->
                        <div class="flex items-center gap-2 px-3 py-1 rounded-lg bg-teal-50 dark:bg-teal-950 text-teal-800 dark:text-teal-300 w-fit mb-3 border border-teal-200/50 dark:border-teal-800/50">
                            <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="text-xs font-black uppercase tracking-wider">Profil Bank Wakalumi</span>
                        </div>

                        <!-- Menu Items List -->
                        <div class="space-y-1.5">
                            <!-- 1. Tentang Kami -->
                            <a href="<?php echo esc_url( home_url( '/profil/tentang-kami' ) ); ?>" class="mega-link group/item <?php echo ( $req_uri === '/profil/tentang-kami' || is_page( 'tentang-kami' ) ) ? 'active' : ''; ?>">
                                <div class="w-8 h-8 rounded-xl bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0 group-hover/item:scale-105 transition-transform">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-sm font-extrabold text-slate-900 dark:text-white group-hover/item:text-primary-600 dark:group-hover/item:text-teal-300 block leading-snug">Tentang Kami</span>
                                    <span class="text-xs text-slate-600 dark:text-slate-300 font-medium block leading-snug">Visi, misi, sejarah & komitmen syariah</span>
                                </div>
                            </a>

                            <!-- 2. Legalitas Perusahaan -->
                            <a href="<?php echo esc_url( home_url( '/profil/legalitas' ) ); ?>" class="mega-link group/item <?php echo ( $req_uri === '/profil/legalitas' || is_page( 'legalitas' ) ) ? 'active' : ''; ?>">
                                <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0 group-hover/item:scale-105 transition-transform">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-sm font-extrabold text-slate-900 dark:text-white group-hover/item:text-primary-600 dark:group-hover/item:text-teal-300 block leading-snug">Legalitas Perusahaan</span>
                                    <span class="text-xs text-slate-600 dark:text-slate-300 font-medium block leading-snug">Izin OJK, penjaminan LPS & akta resmi</span>
                                </div>
                            </a>

                            <!-- 3. Susunan Pengurus -->
                            <a href="<?php echo esc_url( home_url( '/profil/susunan-pengurus' ) ); ?>" class="mega-link group/item <?php echo ( $req_uri === '/profil/susunan-pengurus' || is_page( 'susunan-pengurus' ) ) ? 'active' : ''; ?>">
                                <div class="w-8 h-8 rounded-xl bg-amber-50 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400 flex items-center justify-center flex-shrink-0 group-hover/item:scale-105 transition-transform">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-sm font-extrabold text-slate-900 dark:text-white group-hover/item:text-primary-600 dark:group-hover/item:text-teal-300 block leading-snug">Susunan Pengurus</span>
                                    <span class="text-xs text-slate-600 dark:text-slate-300 font-medium block leading-snug">DPS, Dewan Komisaris & Direksi</span>
                                </div>
                            </a>

                            <!-- 4. Jaringan Kantor -->
                            <a href="<?php echo esc_url( home_url( '/profil/jaringan-kantor' ) ); ?>" class="mega-link group/item <?php echo ( $req_uri === '/profil/jaringan-kantor' || is_page( 'jaringan-kantor' ) ) ? 'active' : ''; ?>">
                                <div class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 flex items-center justify-center flex-shrink-0 group-hover/item:scale-105 transition-transform">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-sm font-extrabold text-slate-900 dark:text-white group-hover/item:text-primary-600 dark:group-hover/item:text-teal-300 block leading-snug">Jaringan Kantor</span>
                                    <span class="text-xs text-slate-600 dark:text-slate-300 font-medium block leading-snug">Kantor pusat, kas & panduan GPS</span>
                                </div>
                            </a>
                        </div>

                        <!-- Footer Info Strip -->
                        <div class="mt-3 pt-2.5 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between px-2 text-xs text-slate-500 dark:text-slate-400">
                            <span class="inline-flex items-center gap-1.5 font-semibold text-teal-700 dark:text-teal-300">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Tata Kelola GCG
                            </span>
                            <span class="font-bold uppercase tracking-wider text-[11px] text-slate-400 dark:text-slate-500">BPRS Wakalumi</span>
                        </div>
                    </div>
                </div>

                <!-- PRODUK: INTERACTIVE 3-COLUMN BANKING MEGA-MENU -->
                <div class="dropdown relative">
                    <button class="dropdown-trigger nav-link <?php echo $is_page_produk ? 'active' : ''; ?> px-4 py-2 rounded-full inline-flex items-center gap-1.5 group">
                        Produk
                        <svg class="w-3.5 h-3.5 opacity-50 group-hover:opacity-100 transition-all duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    
                    <div class="dropdown-menu dropdown-mega-menu w-[780px] xl:w-[820px] max-w-[94vw] p-5 lg:p-6 rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl border border-slate-200/90 dark:border-slate-700/80 shadow-2xl">
                        <div class="grid grid-cols-12 gap-5 lg:gap-6">
                            
                            <!-- Kolom 1: Penghimpunan Dana (Funding) (4 Cols) -->
                            <div class="col-span-12 lg:col-span-4 flex flex-col justify-between pr-0 lg:pr-3 lg:border-r border-slate-200/80 dark:border-slate-800">
                                <div>
                                    <div class="flex items-center gap-2 px-3 py-1 rounded-lg bg-teal-50 dark:bg-teal-950 text-teal-800 dark:text-teal-300 w-fit mb-3 border border-teal-200/50 dark:border-teal-800/50">
                                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 5.625c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" /></svg>
                                        <span class="text-xs font-black uppercase tracking-wider">Penghimpunan Dana</span>
                                    </div>

                                    <div class="space-y-1.5">
                                        <?php 
                                        $header_tabungan_list = function_exists( 'wakalumi_get_tabungan_list' ) ? wakalumi_get_tabungan_list() : [];
                                        foreach ( $header_tabungan_list as $h_tab ) : 
                                            $h_slug    = esc_attr( $h_tab['slug'] ?? 'tabungan' );
                                            $h_color   = $h_tab['color'] ?? 'teal';
                                            $h_image   = ! empty( $h_tab['image'] ) ? esc_url( $h_tab['image'] ) : '';
                                            $h_badge   = ! empty( $h_tab['badge'] ) ? $h_tab['badge'] : 'Tabungan Syariah';
                                            $h_tagline = ! empty( $h_tab['tagline'] ) ? $h_tab['tagline'] : '';

                                            $h_bg_class = 'bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400';
                                            if ( $h_color === 'blue' ) {
                                                $h_bg_class = 'bg-blue-50 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400';
                                            } elseif ( $h_color === 'amber' ) {
                                                $h_bg_class = 'bg-amber-50 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400';
                                            } elseif ( $h_color === 'purple' ) {
                                                $h_bg_class = 'bg-purple-50 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400';
                                            } elseif ( $h_color === 'emerald' ) {
                                                $h_bg_class = 'bg-emerald-50 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400';
                                            } elseif ( $h_color === 'rose' ) {
                                                $h_bg_class = 'bg-rose-50 dark:bg-rose-900/50 text-rose-600 dark:text-rose-400';
                                            }

                                            $h_icon_svg = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>';
                                            if ( $h_slug === 'pendidikan' ) {
                                                $h_icon_svg = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>';
                                            } elseif ( $h_slug === 'haji-umroh' ) {
                                                $h_icon_svg = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>';
                                            } elseif ( $h_slug === 'ukhuwah' ) {
                                                $h_icon_svg = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v3a2 2 0 01-2 2M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg>';
                                            }
                                        ?>
                                            <a href="<?php echo esc_url( home_url( '/produk/tabungan-syariah/#' . $h_slug ) ); ?>" 
                                               class="mega-link group/item product-hover-item"
                                               data-name="<?php echo esc_attr( $h_tab['nama'] ); ?>"
                                               data-badge="<?php echo esc_attr( $h_badge ); ?>"
                                               data-tagline="<?php echo esc_attr( $h_tagline ); ?>"
                                               data-image="<?php echo esc_url( $h_image ); ?>">
                                                <div class="w-8 h-8 rounded-xl <?php echo esc_attr( $h_bg_class ); ?> flex items-center justify-center flex-shrink-0 group-hover/item:scale-105 transition-transform">
                                                    <?php echo $h_icon_svg; ?>
                                                </div>
                                                <div>
                                                    <span class="text-sm font-extrabold text-slate-900 dark:text-white group-hover/item:text-primary-600 dark:group-hover/item:text-teal-300 block leading-snug"><?php echo esc_html( $h_tab['nama'] ); ?></span>
                                                    <span class="text-xs text-slate-600 dark:text-slate-300 font-medium block leading-snug"><?php echo esc_html( $h_tagline ); ?></span>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>

                                        <!-- Deposito Mudharabah -->
                                        <?php
                                        $dep_cards_sample = function_exists( 'wakalumi_get_deposito_tenor_cards' ) ? wakalumi_get_deposito_tenor_cards() : [];
                                        $dep_sample_img   = '';
                                        foreach ( $dep_cards_sample as $dc ) {
                                            if ( ! empty( $dc['image'] ) ) {
                                                $dep_sample_img = $dc['image'];
                                                break;
                                            }
                                        }
                                        ?>
                                        <a href="<?php echo esc_url( home_url( '/produk/deposito-syariah/#tenor' ) ); ?>" 
                                           class="mega-link group/item product-hover-item"
                                           data-name="Deposito Mudharabah"
                                           data-badge="Investasi Syariah"
                                           data-tagline="Tenor 1, 3, 6, 12 Bulan • Nisbah Kompetitif"
                                           data-image="<?php echo esc_url( $dep_sample_img ); ?>">
                                            <div class="w-8 h-8 rounded-xl bg-emerald-50 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0 group-hover/item:scale-105 transition-transform">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                                            </div>
                                            <div>
                                                <span class="text-sm font-extrabold text-slate-900 dark:text-white group-hover/item:text-primary-600 dark:group-hover/item:text-teal-300 block leading-snug">Deposito Mudharabah</span>
                                                <span class="text-xs text-slate-600 dark:text-slate-300 font-medium block leading-snug">Tenor 1, 3, 6, 12 Bulan • Nisbah kompetitif</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="pt-3 px-2">
                                    <a href="<?php echo esc_url( home_url( '/produk/tabungan-syariah/' ) ); ?>" class="text-xs font-bold text-teal-700 hover:text-teal-800 dark:text-teal-400 inline-flex items-center gap-1">
                                        Lihat Halaman Simpanan &rarr;
                                    </a>
                                </div>
                            </div>

                            <!-- Kolom 2: Penyaluran Dana (Lending) (4 Cols) - 100% Dinamis dari Database -->
                            <div class="col-span-12 lg:col-span-4 flex flex-col justify-between pr-0 lg:pr-3 lg:border-r border-slate-200/80 dark:border-slate-800">
                                <div>
                                    <div class="flex items-center gap-2 px-3 py-1 rounded-lg bg-primary-50 dark:bg-primary-950 text-primary-800 dark:text-teal-300 w-fit mb-3 border border-primary-200/50 dark:border-primary-800/50">
                                        <svg class="w-4 h-4 text-primary-600 dark:text-teal-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                        <span class="text-xs font-black uppercase tracking-wider">Penyaluran Dana</span>
                                    </div>

                                    <div class="space-y-1.5">
                                        <?php 
                                        $header_pembiayaan_list = function_exists( 'wakalumi_get_pembiayaan_list' ) ? wakalumi_get_pembiayaan_list() : [];
                                        // Tampilkan 4 produk pembiayaan utama di mega-menu
                                        $header_pem_preview = array_slice( $header_pembiayaan_list, 0, 4 );
                                        foreach ( $header_pem_preview as $h_pem ) :
                                            $p_slug    = ! empty( $h_pem['slug'] ) ? sanitize_title( $h_pem['slug'] ) : sanitize_title( $h_pem['nama'] );
                                            $p_color   = $h_pem['color'] ?? 'orange';
                                            $p_badge   = ! empty( $h_pem['badge'] ) ? $h_pem['badge'] : 'Pembiayaan Syariah';
                                            $p_tagline = ! empty( $h_pem['tagline'] ) ? $h_pem['tagline'] : '';
                                            $p_image   = ! empty( $h_pem['image'] ) ? esc_url( $h_pem['image'] ) : '';

                                            $p_bg_class = 'bg-orange-50 dark:bg-orange-900/50 text-orange-600 dark:text-orange-400';
                                            if ( $p_color === 'indigo' || $p_color === 'blue' ) {
                                                $p_bg_class = 'bg-indigo-50 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400';
                                            } elseif ( $p_color === 'purple' ) {
                                                $p_bg_class = 'bg-purple-50 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400';
                                            } elseif ( $p_color === 'teal' || $p_color === 'emerald' ) {
                                                $p_bg_class = 'bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400';
                                            } elseif ( $p_color === 'amber' ) {
                                                $p_bg_class = 'bg-amber-50 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400';
                                            }
                                        ?>
                                            <a href="<?php echo esc_url( home_url( '/produk/pembiayaan/#' . $p_slug ) ); ?>" 
                                               class="mega-link group/item product-hover-item"
                                               data-name="<?php echo esc_attr( $h_pem['nama'] ); ?>"
                                               data-badge="<?php echo esc_attr( $p_badge ); ?>"
                                               data-tagline="<?php echo esc_attr( $p_tagline ); ?>"
                                               data-image="<?php echo esc_url( $p_image ); ?>">
                                                <div class="w-8 h-8 rounded-xl <?php echo esc_attr( $p_bg_class ); ?> flex items-center justify-center flex-shrink-0 group-hover/item:scale-105 transition-transform">
                                                    <?php 
                                                    if ( function_exists( 'wakalumi_render_pembiayaan_icon' ) ) {
                                                        echo str_replace( 'w-6 h-6', 'w-4 h-4', wakalumi_render_pembiayaan_icon( $h_pem['icon'] ?? 'coins' ) );
                                                    } else {
                                                        echo '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>';
                                                    }
                                                    ?>
                                                </div>
                                                <div>
                                                    <span class="text-sm font-extrabold text-slate-900 dark:text-white group-hover/item:text-primary-600 dark:group-hover/item:text-teal-300 block leading-snug"><?php echo esc_html( $h_pem['nama'] ); ?></span>
                                                    <span class="text-xs text-slate-600 dark:text-slate-300 font-medium block leading-snug"><?php echo esc_html( $p_tagline ); ?></span>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="pt-3 px-2">
                                    <a href="<?php echo esc_url( home_url( '/produk/pembiayaan/' ) ); ?>" class="text-xs font-bold text-primary-700 hover:text-primary-800 dark:text-teal-400 inline-flex items-center gap-1">
                                        Lihat Halaman Pembiayaan &rarr;
                                    </a>
                                </div>
                            </div>

                            <!-- Kolom 3: Brosur & Live Hover Preview (4 Cols) -->
                            <div class="col-span-12 lg:col-span-4 flex flex-col justify-between gap-3">
                                <div>
                                    <!-- Live Product Hover Preview Card (Tampil di atas brosur saat produk berfoto di-hover) -->
                                    <div id="mega-preview-container" class="hidden opacity-0 scale-95 transition-all duration-300 ease-out mb-3">
                                        <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden bg-slate-100 dark:bg-slate-800 shadow-md border border-slate-200/90 dark:border-slate-700/80 group/mprev">
                                            <img id="mega-preview-img" src="" alt="" class="w-full h-full object-cover transition-transform duration-500 group-hover/mprev:scale-105" loading="lazy">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/25 to-transparent"></div>
                                            <div class="absolute top-2.5 right-2.5 z-10">
                                                <span id="mega-preview-badge" class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider backdrop-blur-md bg-white/90 dark:bg-slate-900/90 text-teal-700 dark:text-teal-300 border border-teal-200/60 dark:border-teal-700/60 shadow-sm"></span>
                                            </div>
                                            <div class="absolute bottom-2.5 left-3 right-3 z-10">
                                                <h6 id="mega-preview-title" class="text-xs sm:text-sm font-black text-white leading-tight drop-shadow-md truncate"></h6>
                                                <p id="mega-preview-tagline" class="text-[10px] text-teal-200 font-medium truncate mt-0.5"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Featured Card: Katalog Brosur Digital (Minimalis, Modern, Tanpa Teks Menumpuk) -->
                                    <a 
                                        href="<?php echo esc_url( home_url( '/brosur/' ) ); ?>" 
                                        class="block p-4 rounded-2xl <?php echo ( strpos( $req_uri, '/brosur' ) !== false ) ? 'bg-teal-50/90 dark:bg-slate-800/90 ring-2 ring-teal-500/80 border-teal-500 shadow-sm' : 'bg-slate-50/90 dark:bg-slate-800/60 hover:bg-teal-50/80 dark:hover:bg-slate-800/90 border-slate-200/80 dark:border-slate-700/80 hover:border-teal-300 dark:hover:border-teal-700 shadow-xs hover:shadow-md'; ?> border transition-all duration-300 group/bcard mega-link"
                                    >
                                        <div class="flex items-center justify-between gap-2 mb-2.5">
                                            <div class="w-9 h-9 rounded-xl bg-teal-600 group-hover/bcard:bg-teal-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm transition-transform duration-300 group-hover/bcard:scale-105">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                            </div>
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full <?php echo ( strpos( $req_uri, '/brosur' ) !== false ) ? 'bg-teal-600 text-white shadow-xs' : 'bg-teal-100 dark:bg-teal-950/80 text-teal-700 dark:text-teal-300'; ?>">
                                                <?php echo ( strpos( $req_uri, '/brosur' ) !== false ) ? 'Halaman Aktif' : 'Katalog PDF'; ?>
                                            </span>
                                        </div>
                                        <h5 class="text-sm font-bold text-slate-900 dark:text-white leading-tight group-hover/bcard:text-teal-600 dark:group-hover/bcard:text-teal-400 transition-colors">
                                            Katalog Brosur Digital
                                        </h5>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed line-clamp-2">
                                            Unduh seluruh panduan resmi, ringkasan akad syariah, dan nisbah produk.
                                        </p>
                                        <div class="mt-3 pt-2.5 border-t border-slate-200/70 dark:border-slate-700/70 flex items-center justify-between text-xs font-bold text-teal-600 dark:text-teal-400">
                                            <span>Buka Katalog Brosur</span>
                                            <svg class="w-3.5 h-3.5 group-hover/bcard:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                        </div>
                                    </a>
                                </div>

                                <!-- WhatsApp Hotline Quick Inquiry (Minimalist) -->
                                <div class="pt-2 border-t border-slate-200/70 dark:border-slate-800 text-center">
                                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="text-xs font-bold text-slate-500 hover:text-teal-600 dark:text-slate-400 dark:hover:text-teal-300 inline-flex items-center justify-center gap-1.5 transition-colors">
                                        <span>💬 Tanya Syarat & Simulasi via CS</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="dropdown relative">
                    <button class="dropdown-trigger nav-link <?php echo $is_page_informasi ? 'active' : ''; ?> px-4 py-2 rounded-full inline-flex items-center gap-1.5 group">
                        Informasi
                        <svg class="w-3.5 h-3.5 opacity-50 group-hover:opacity-100 transition-all duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div class="dropdown-menu">
                        <a href="<?php echo esc_url( home_url( '/informasi/laporan' ) ); ?>" class="dropdown-item <?php echo ( $req_uri === '/informasi/laporan' ) ? 'active' : ''; ?>">Laporan & Publikasi</a>
                        <a href="<?php echo esc_url( home_url( '/informasi/nisbah' ) ); ?>" class="dropdown-item <?php echo ( $req_uri === '/informasi/nisbah' ) ? 'active' : ''; ?>">Informasi Nisbah</a>
                        <a href="<?php echo esc_url( home_url( '/berita' ) ); ?>" class="dropdown-item <?php echo ( $req_uri === '/berita' || strpos( $req_uri, '/berita' ) === 0 ) ? 'active' : ''; ?>">Berita & Edukasi</a>
                    </div>
                </div>

                <a href="<?php echo esc_url( home_url( '/kontak' ) ); ?>" class="nav-link <?php echo $is_page_kontak ? 'active' : ''; ?> px-4 py-2 rounded-full">Kontak</a>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center gap-2 sm:gap-4 z-10">
                <!-- Sleek Dark Mode Toggle -->
                <button id="dark-mode-toggle"
                        class="relative flex items-center justify-between w-14 h-7 p-1 rounded-full bg-slate-200 dark:bg-slate-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-primary-500/50"
                        aria-label="Toggle dark mode">
                    
                    <span class="z-10 flex items-center justify-center w-5 h-5 text-amber-500 transition-transform duration-300">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 4.22a1 1 0 011.415 0l.708.708a1 1 0 01-1.414 1.414l-.708-.708a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM14.929 15.636a1 1 0 010 1.414l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22-1.414a1 1 0 01-1.415 0l-.708-.708a1 1 0 011.414-1.414l.708.708a1 1 0 010 1.414zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm1.414-4.95l.707.707a1 1 0 11-1.414 1.414L2.05 4.95a1 1 0 111.414-1.414zM10 5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"/></svg>
                    </span>
                    
                    <span class="z-10 flex items-center justify-center w-5 h-5 text-slate-300 transition-transform duration-300">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
                    </span>

                    <span class="absolute left-1 top-1 w-5 h-5 bg-white rounded-full shadow-sm transform transition-transform duration-300 dark:translate-x-7"></span>
                </button>

                <!-- WhatsApp CTA (desktop) -->
                <a href="<?php echo esc_url( $wa_url ); ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="hidden md:inline-flex btn-primary text-xs px-4 py-2.5 rounded-lg">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    WhatsApp
                </a>

                <!-- Mobile Menu Toggle -->
                <button id="mobile-menu-toggle"
                        class="lg:hidden w-10 h-10 rounded-xl flex items-center justify-center
                               text-slate-600 hover:bg-slate-100
                               dark:text-slate-300 dark:hover:bg-dark-surface-alt
                               transition-colors duration-200"
                        aria-label="Open menu">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </nav>
    </div>

    <!-- Progressive Enhancement: Mega Menu Hover Preview Fallback -->
    <script>
    (function() {
        function initMegaHoverPreview() {
            var c = document.getElementById('mega-preview-container');
            var img = document.getElementById('mega-preview-img');
            if (!c || !img || c.dataset.hoverInitialized === 'true') return;
            c.dataset.hoverInitialized = 'true';

            var badge = document.getElementById('mega-preview-badge');
            var title = document.getElementById('mega-preview-title');
            var tagline = document.getElementById('mega-preview-tagline');
            var items = document.querySelectorAll('.product-hover-item');
            var timer = null;

            function show(el) {
                if (timer) clearTimeout(timer);
                var src = el.getAttribute('data-image');
                if (!src || src.trim() === '') {
                    hide(false);
                    return;
                }
                img.src = src;
                img.alt = el.getAttribute('data-name') || '';
                if (badge) badge.textContent = el.getAttribute('data-badge') || '';
                if (title) title.textContent = el.getAttribute('data-name') || '';
                if (tagline) tagline.textContent = el.getAttribute('data-tagline') || '';

                c.classList.remove('hidden');
                void c.offsetWidth;
                c.classList.remove('opacity-0', 'scale-95');
                c.classList.add('opacity-100', 'scale-100');
            }

            function hide(fast) {
                if (timer) clearTimeout(timer);
                var delay = fast ? 0 : 150;
                timer = setTimeout(function() {
                    c.classList.remove('opacity-100', 'scale-100');
                    c.classList.add('opacity-0', 'scale-95');
                    setTimeout(function() {
                        if (c.classList.contains('opacity-0')) {
                            c.classList.add('hidden');
                        }
                    }, 300);
                }, delay);
            }

            items.forEach(function(item) {
                item.addEventListener('mouseenter', function() { show(item); });
                item.addEventListener('focus', function() { show(item); });
                item.addEventListener('mouseleave', function() { hide(false); });
                item.addEventListener('blur', function() { hide(false); });
            });

            var mm = c.closest('.dropdown-mega-menu');
            if (mm) {
                mm.addEventListener('mouseleave', function() { hide(true); });
            }
        }

        // Progressive Enhancement: Immediate Same-Page Anchor Click Delegation with Highlight Pulse
        document.addEventListener('click', function(e) {
            var a = e.target.closest ? e.target.closest('a') : null;
            if (!a) return;
            var href = a.getAttribute('href');
            if (!href || href === '#' || href.indexOf('#') === -1 || href.indexOf('javascript:') === 0) return;
            try {
                var u = new URL(a.href, window.location.origin);
                var p1 = u.pathname.replace(/\/$/, '') || '/';
                var p2 = window.location.pathname.replace(/\/$/, '') || '/';
                if (u.hash && u.hash.length > 1 && (p1 === p2 || href.charAt(0) === '#')) {
                    var t = document.querySelector(u.hash);
                    if (t) {
                        e.preventDefault();
                        // Close dropdowns
                        document.querySelectorAll('.dropdown.open, .dropdown.is-open, .dropdown.hovered').forEach(function(d) {
                            d.classList.remove('open', 'is-open', 'hovered');
                        });
                        var nav = document.getElementById('main-navbar');
                        var navH = nav ? nav.offsetHeight : 70;
                        var top = t.getBoundingClientRect().top + window.pageYOffset - navH - 20;
                        window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' });
                        t.classList.add('ring-4', 'ring-teal-500/80', 'ring-offset-4', 'ring-offset-white', 'dark:ring-offset-slate-900', 'transition-all', 'duration-500');
                        setTimeout(function() {
                            t.classList.remove('ring-4', 'ring-teal-500/80', 'ring-offset-4', 'ring-offset-white', 'dark:ring-offset-slate-900');
                        }, 2500);
                        if (history.pushState) history.pushState(null, null, u.hash);
                    }
                }
            } catch(err) {}
        }, true);
    })();
    </script>
</header>

<!-- ========================================
     MOBILE MENU (Slide-in Drawer)
     ======================================== -->
<div id="mobile-menu-overlay" class="mobile-menu-overlay"></div>

<div id="mobile-menu-panel" class="mobile-menu-panel">
    <div class="flex flex-col h-full">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b border-slate-100 dark:border-dark-border">
            <span class="font-bold text-slate-900 dark:text-white">Menu</span>
            <button id="mobile-menu-close"
                    class="w-8 h-8 rounded-lg flex items-center justify-center
                           text-slate-400 hover:text-slate-600 hover:bg-slate-100
                           dark:hover:text-slate-200 dark:hover:bg-dark-surface-alt
                           transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Nav Links -->
        <div class="flex-1 overflow-y-auto py-4 px-4 space-y-1" id="mobile-menu-items">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
               class="mobile-nav-link block px-4 py-3 rounded-xl text-sm font-medium transition-colors <?php echo $is_page_home ? 'bg-primary-50 text-primary-700 font-semibold dark:bg-primary-400/20 dark:text-primary-300' : 'text-slate-700 hover:bg-primary-50 hover:text-primary-700 dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-400'; ?>">
                Beranda
            </a>

            <!-- Profil -->
            <div class="mobile-nav-group">
                <button class="mobile-dropdown-trigger w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-colors <?php echo $is_page_profil ? 'bg-primary-50/70 text-primary-700 font-semibold dark:bg-primary-400/15 dark:text-primary-300' : 'text-slate-700 hover:bg-primary-50 hover:text-primary-700 dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-400'; ?>">
                    Profil
                    <svg class="dropdown-icon w-4 h-4 transition-transform duration-200 <?php echo $is_page_profil ? 'rotate-180' : ''; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div class="<?php echo $is_page_profil ? '' : 'hidden'; ?> pl-2 mt-1 space-y-1 mobile-dropdown-content">
                    <a href="<?php echo esc_url( home_url( '/profil/tentang-kami' ) ); ?>" class="mobile-nav-sublink flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition-colors <?php echo ( $req_uri === '/profil/tentang-kami' || is_page( 'tentang-kami' ) ) ? 'bg-primary-50 text-primary-700 font-bold dark:bg-primary-950/50 dark:text-teal-300' : 'text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400'; ?>">
                        <span class="w-6 h-6 rounded-md bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" /></svg>
                        </span>
                        <span class="text-xs font-semibold">Tentang Kami</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/profil/legalitas' ) ); ?>" class="mobile-nav-sublink flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition-colors <?php echo ( $req_uri === '/profil/legalitas' || is_page( 'legalitas' ) ) ? 'bg-primary-50 text-primary-700 font-bold dark:bg-primary-950/50 dark:text-teal-300' : 'text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400'; ?>">
                        <span class="w-6 h-6 rounded-md bg-emerald-50 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                        </span>
                        <span class="text-xs font-semibold">Legalitas Perusahaan</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/profil/susunan-pengurus' ) ); ?>" class="mobile-nav-sublink flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition-colors <?php echo ( $req_uri === '/profil/susunan-pengurus' || is_page( 'susunan-pengurus' ) ) ? 'bg-primary-50 text-primary-700 font-bold dark:bg-primary-950/50 dark:text-teal-300' : 'text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400'; ?>">
                        <span class="w-6 h-6 rounded-md bg-amber-50 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg>
                        </span>
                        <span class="text-xs font-semibold">Susunan Pengurus</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/profil/jaringan-kantor' ) ); ?>" class="mobile-nav-sublink flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm transition-colors <?php echo ( $req_uri === '/profil/jaringan-kantor' || is_page( 'jaringan-kantor' ) ) ? 'bg-primary-50 text-primary-700 font-bold dark:bg-primary-950/50 dark:text-teal-300' : 'text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400'; ?>">
                        <span class="w-6 h-6 rounded-md bg-blue-50 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                        </span>
                        <span class="text-xs font-semibold">Jaringan Kantor</span>
                    </a>
                </div>
            </div>

            <!-- Produk -->
            <div class="mobile-nav-group">
                <button class="mobile-dropdown-trigger w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-colors <?php echo $is_page_produk ? 'bg-primary-50/70 text-primary-700 font-semibold dark:bg-primary-400/15 dark:text-primary-300' : 'text-slate-700 hover:bg-primary-50 hover:text-primary-700 dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-400'; ?>">
                    Produk
                    <svg class="dropdown-icon w-4 h-4 transition-transform duration-200 <?php echo $is_page_produk ? 'rotate-180' : ''; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div class="<?php echo $is_page_produk ? '' : 'hidden'; ?> pl-4 mt-1 space-y-1 mobile-dropdown-content">
                    <!-- Penghimpunan Dana -->
                    <div class="px-3 pt-2 pb-1 text-[10px] font-extrabold text-teal-700 dark:text-teal-300 uppercase tracking-widest flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span> Penghimpunan Dana
                    </div>
                    <a href="<?php echo esc_url( home_url( '/produk/tabungan-syariah/' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors <?php echo ( $req_uri === '/produk/tabungan-syariah' ) ? 'text-primary-600 font-bold dark:text-primary-400' : 'text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400'; ?>">
                        Tabungan Syariah (Tawakal, Pendidikan, Haji, Ukhuwah)
                    </a>
                    <a href="<?php echo esc_url( home_url( '/produk/deposito-syariah/#tenor' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors <?php echo ( $req_uri === '/produk/deposito-syariah' ) ? 'text-primary-600 font-bold dark:text-primary-400' : 'text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400'; ?>">
                        Deposito Mudharabah (1-12 Bulan)
                    </a>

                    <!-- Penyaluran Dana -->
                    <div class="px-3 pt-3 pb-1 text-[10px] font-extrabold text-primary-700 dark:text-teal-300 uppercase tracking-widest flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-primary-500"></span> Penyaluran Dana (Lending)
                    </div>
                    <a href="<?php echo esc_url( home_url( '/produk/pembiayaan/#pedagang' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400">
                        ⭐ 1000 Pedagang & 1000 Guru
                    </a>
                    <a href="<?php echo esc_url( home_url( '/produk/pembiayaan/#akad-syariah' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors text-slate-600 hover:text-primary-600 dark:text-slate-300 dark:hover:text-primary-400">
                        ⚖️ Akad Murabahah, Bagi Hasil, Ijarah
                    </a>

                    <!-- Katalog Brosur Mobile -->
                    <div class="pt-2 pb-1 pr-2">
                        <a href="<?php echo esc_url( home_url( '/brosur/' ) ); ?>" class="mobile-nav-sublink flex items-center justify-between px-3.5 py-2.5 rounded-xl <?php echo ( strpos( $req_uri, '/brosur' ) !== false ) ? 'bg-teal-100 dark:bg-teal-900/60 text-teal-800 dark:text-teal-200 ring-2 ring-teal-500/50 font-black' : 'bg-teal-50/80 dark:bg-teal-950/40 text-teal-800 dark:text-teal-300 font-bold hover:bg-teal-100'; ?> text-xs border border-teal-200/60 dark:border-teal-800/40 transition-colors">
                            <span class="inline-flex items-center gap-2">
                                <svg class="w-4 h-4 text-teal-600 dark:text-teal-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                Katalog Brosur Dokumen
                            </span>
                            <?php if ( strpos( $req_uri, '/brosur' ) !== false ) : ?>
                                <span class="text-[9px] font-black uppercase px-2 py-0.5 rounded-full bg-teal-600 text-white flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-white animate-ping"></span>
                                    Aktif
                                </span>
                            <?php else : ?>
                                <span class="text-[10px] font-extrabold uppercase tracking-wider text-teal-700 dark:text-teal-300">Buka &rarr;</span>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Informasi -->
            <div class="mobile-nav-group">
                <button class="mobile-dropdown-trigger w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-colors <?php echo $is_page_informasi ? 'bg-primary-50/70 text-primary-700 font-semibold dark:bg-primary-400/15 dark:text-primary-300' : 'text-slate-700 hover:bg-primary-50 hover:text-primary-700 dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-400'; ?>">
                    Informasi
                    <svg class="dropdown-icon w-4 h-4 transition-transform duration-200 <?php echo $is_page_informasi ? 'rotate-180' : ''; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div class="<?php echo $is_page_informasi ? '' : 'hidden'; ?> pl-4 mt-1 space-y-1 mobile-dropdown-content">
                    <a href="<?php echo esc_url( home_url( '/informasi/laporan' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors <?php echo ( $req_uri === '/informasi/laporan' ) ? 'text-primary-600 font-bold dark:text-primary-400' : 'text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400'; ?>">Laporan & Publikasi</a>
                    <a href="<?php echo esc_url( home_url( '/informasi/nisbah' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors <?php echo ( $req_uri === '/informasi/nisbah' ) ? 'text-primary-600 font-bold dark:text-primary-400' : 'text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400'; ?>">Informasi Nisbah</a>
                    <a href="<?php echo esc_url( home_url( '/berita' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors <?php echo ( $req_uri === '/berita' || strpos( $req_uri, '/berita' ) === 0 ) ? 'text-primary-600 font-bold dark:text-primary-400' : 'text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400'; ?>">Berita & Edukasi</a>
                </div>
            </div>

            <a href="<?php echo esc_url( home_url( '/kontak' ) ); ?>" class="mobile-nav-link block px-4 py-3 rounded-xl text-sm font-medium transition-colors <?php echo $is_page_kontak ? 'bg-primary-50 text-primary-700 font-semibold dark:bg-primary-400/20 dark:text-primary-300' : 'text-slate-700 hover:bg-primary-50 hover:text-primary-700 dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-400'; ?>">Kontak</a>
        </div>

        <!-- Footer CTA -->
        <div class="p-4 border-t border-slate-100 dark:border-dark-border">
            <a href="<?php echo esc_url( $wa_url ); ?>"
               target="_blank" rel="noopener noreferrer"
               class="btn-whatsapp w-full text-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Chat WhatsApp
            </a>
        </div>
    </div>
</div>

<!-- ========================================
     SWUP CONTENT CONTAINER
     ======================================== -->
<div id="swup" class="transition-fade flex-1 overflow-x-clip max-w-full">
    <!-- Spacer for fixed navbar -->
    <div class="h-16 md:h-20"></div>

    <!-- Container Grid: Memadukan 1 Sticky Background Emblem Watermark dengan alur scroll <main> -->
    <div class="grid grid-cols-1 grid-rows-1 relative">
        <!-- ========================================
             GLOBAL STICKY BACKGROUND EMBLEM WATERMARK (Single Unified Layer z-[1])
             Menempel stasioner di tengah layar selama membaca konten halaman,
             tertutup secara alami oleh section solid (z-10 bg-white/slate-900),
             terlihat pada section transparan (z-10 bg-transparent),
             dan ikut tergulung naik menghilang saat scroll memasuki area footer.
             ======================================== -->
        <div id="sticky-watermark-track" 
             class="col-start-1 row-start-1 pointer-events-none z-[1] flex justify-center overflow-visible"
             aria-hidden="true">
            <div id="sticky-watermark-emblem" 
                 class="sticky top-1/2 -translate-y-1/2 w-24 h-24 md:w-28 md:h-28 rounded-2xl md:rounded-3xl bg-slate-100/90 dark:bg-slate-800/60 backdrop-blur-md border border-slate-200/90 dark:border-slate-700/60 shadow-[0_15px_35px_-8px_rgba(0,0,0,0.14),0_6px_16px_-4px_rgba(0,0,0,0.06),inset_0_2px_4px_rgba(255,255,255,0.9),inset_0_-2px_4px_rgba(0,0,0,0.06)] dark:shadow-[0_15px_35px_-8px_rgba(0,0,0,0.7),0_6px_16px_-4px_rgba(0,0,0,0.4),inset_0_1px_2px_rgba(255,255,255,0.08),inset_0_-2px_4px_rgba(0,0,0,0.4)] flex items-center justify-center p-3 md:p-3.5 select-none h-fit">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-slate-500 dark:bg-slate-300 opacity-35 dark:opacity-30"
                     style="-webkit-mask-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png'); -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center; mask-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png'); mask-size: contain; mask-repeat: no-repeat; mask-position: center;">
                </div>
            </div>
        </div>

        <main class="col-start-1 row-start-1 relative z-10 overflow-x-clip max-w-full">

