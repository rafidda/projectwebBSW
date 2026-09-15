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
            $is_page_produk    = ( ! $is_page_home && ( strpos( $req_uri, '/produk' ) === 0 || is_post_type_archive( 'produk' ) || is_singular( 'produk' ) ) );
            $is_page_informasi = ( ! $is_page_home && ( strpos( $req_uri, '/informasi' ) === 0 || strpos( $req_uri, '/berita' ) === 0 || is_singular( 'berita' ) || is_post_type_archive( 'berita' ) || is_category() ) );
            $is_page_kontak    = ( ! $is_page_home && ( strpos( $req_uri, '/kontak' ) === 0 || is_page( 'kontak' ) ) );
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
                    <div class="dropdown-menu">
                        <a href="<?php echo esc_url( home_url( '/profil/tentang-kami' ) ); ?>" class="dropdown-item <?php echo ( $req_uri === '/profil/tentang-kami' || is_page( 'tentang-kami' ) ) ? 'active' : ''; ?>">Tentang Kami</a>
                        <a href="<?php echo esc_url( home_url( '/profil/legalitas' ) ); ?>" class="dropdown-item <?php echo ( $req_uri === '/profil/legalitas' || is_page( 'legalitas' ) ) ? 'active' : ''; ?>">Legalitas Perusahaan</a>
                        <a href="<?php echo esc_url( home_url( '/profil/susunan-pengurus' ) ); ?>" class="dropdown-item <?php echo ( $req_uri === '/profil/susunan-pengurus' || is_page( 'susunan-pengurus' ) ) ? 'active' : ''; ?>">Susunan Pengurus</a>
                        <a href="<?php echo esc_url( home_url( '/profil/jaringan-kantor' ) ); ?>" class="dropdown-item <?php echo ( $req_uri === '/profil/jaringan-kantor' || is_page( 'jaringan-kantor' ) ) ? 'active' : ''; ?>">Jaringan Kantor</a>
                    </div>
                </div>

                <div class="dropdown relative">
                    <button class="dropdown-trigger nav-link <?php echo $is_page_produk ? 'active' : ''; ?> px-4 py-2 rounded-full inline-flex items-center gap-1.5 group">
                        Produk
                        <svg class="w-3.5 h-3.5 opacity-50 group-hover:opacity-100 transition-all duration-300 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div class="dropdown-menu min-w-[260px]">
                        <div class="px-5 py-2 text-xs font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Produk Dana</div>
                        <a href="<?php echo esc_url( home_url( '/produk/tabungan-syariah' ) ); ?>" class="dropdown-item <?php echo ( $req_uri === '/produk/tabungan-syariah' ) ? 'active' : ''; ?> pl-8">Tabungan Syariah</a>
                        <a href="<?php echo esc_url( home_url( '/produk/deposito-syariah' ) ); ?>" class="dropdown-item <?php echo ( $req_uri === '/produk/deposito-syariah' ) ? 'active' : ''; ?> pl-8">Deposito Syariah</a>
                        
                        <div class="h-px bg-slate-100 dark:bg-dark-border my-2 mx-5"></div>
                        
                        <a href="<?php echo esc_url( home_url( '/produk/pembiayaan' ) ); ?>" class="dropdown-item <?php echo ( $req_uri === '/produk/pembiayaan' ) ? 'active' : ''; ?>">Pembiayaan (Lending)</a>
                        <a href="#" class="dropdown-item opacity-60 cursor-not-allowed" onclick="event.preventDefault();">Pengajuan Online <span class="ml-2 text-[9px] px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500">Segera</span></a>
                        
                        <div class="h-px bg-slate-100 dark:bg-dark-border my-2 mx-5"></div>
                        
                        <a href="#" class="dropdown-item flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                            Download Brosur
                        </a>
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
                <div class="<?php echo $is_page_profil ? '' : 'hidden'; ?> pl-4 mt-1 space-y-1 mobile-dropdown-content">
                    <a href="<?php echo esc_url( home_url( '/profil/tentang-kami' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors <?php echo ( $req_uri === '/profil/tentang-kami' || is_page( 'tentang-kami' ) ) ? 'text-primary-600 font-bold dark:text-primary-400' : 'text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400'; ?>">Tentang Kami</a>
                    <a href="<?php echo esc_url( home_url( '/profil/legalitas' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors <?php echo ( $req_uri === '/profil/legalitas' || is_page( 'legalitas' ) ) ? 'text-primary-600 font-bold dark:text-primary-400' : 'text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400'; ?>">Legalitas</a>
                    <a href="<?php echo esc_url( home_url( '/profil/susunan-pengurus' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors <?php echo ( $req_uri === '/profil/susunan-pengurus' || is_page( 'susunan-pengurus' ) ) ? 'text-primary-600 font-bold dark:text-primary-400' : 'text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400'; ?>">Susunan Pengurus</a>
                    <a href="<?php echo esc_url( home_url( '/profil/jaringan-kantor' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors <?php echo ( $req_uri === '/profil/jaringan-kantor' || is_page( 'jaringan-kantor' ) ) ? 'text-primary-600 font-bold dark:text-primary-400' : 'text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400'; ?>">Jaringan Kantor</a>
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
                    <a href="<?php echo esc_url( home_url( '/produk/tabungan-syariah' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors <?php echo ( $req_uri === '/produk/tabungan-syariah' ) ? 'text-primary-600 font-bold dark:text-primary-400' : 'text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400'; ?>">Tabungan Syariah</a>
                    <a href="<?php echo esc_url( home_url( '/produk/deposito-syariah' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors <?php echo ( $req_uri === '/produk/deposito-syariah' ) ? 'text-primary-600 font-bold dark:text-primary-400' : 'text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400'; ?>">Deposito Syariah</a>
                    <a href="<?php echo esc_url( home_url( '/produk/pembiayaan' ) ); ?>" class="mobile-nav-sublink block px-4 py-2 rounded-lg text-sm transition-colors <?php echo ( $req_uri === '/produk/pembiayaan' ) ? 'text-primary-600 font-bold dark:text-primary-400' : 'text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400'; ?>">Pembiayaan</a>
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
<div id="swup" class="transition-fade flex-1">
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

        <main class="col-start-1 row-start-1 relative z-10">

