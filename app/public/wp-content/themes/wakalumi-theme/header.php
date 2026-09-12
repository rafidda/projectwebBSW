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

<?php
// Get WhatsApp URL for CTA
$wa_url = function_exists( 'wakalumi_get_whatsapp_url' ) ? wakalumi_get_whatsapp_url() : '#';
?>

<!-- ========================================
     NAVBAR
     ======================================== -->
<header id="main-navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 glass-strong">
    <div class="container-wide">
        <nav class="flex items-center justify-between h-16 md:h-20">

            <!-- Logo & Name -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 group">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="w-10 h-10 flex-shrink-0">
                        <?php
                        $logo_id = get_theme_mod( 'custom_logo' );
                        echo wp_get_attachment_image( $logo_id, 'thumbnail', false, [
                            'class' => 'w-full h-full object-contain',
                        ] );
                        ?>
                    </div>
                <?php else : ?>
                    <!-- Placeholder Logo (geometric Islamic pattern) -->
                    <div class="w-10 h-10 flex-shrink-0 rounded-xl bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center shadow-lg shadow-primary-500/20 dark:shadow-primary-400/20">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                        </svg>
                    </div>
                <?php endif; ?>
                <div class="hidden sm:block">
                    <span class="block text-sm font-extrabold text-slate-900 dark:text-white leading-tight tracking-tight">
                        BPRS Wakalumi
                    </span>
                    <span class="block text-[10px] font-medium text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                        Bank Syariah
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-1">

                <!-- Beranda -->
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link px-3 py-2 <?php echo is_front_page() ? 'active' : ''; ?>">
                    Beranda
                </a>

                <!-- Profil (Dropdown) -->
                <div class="dropdown relative">
                    <button class="dropdown-trigger nav-link px-3 py-2 inline-flex items-center gap-1">
                        Profil
                        <svg class="w-3.5 h-3.5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div class="dropdown-menu">
                        <a href="<?php echo esc_url( home_url( '/profil/tentang-kami' ) ); ?>" class="dropdown-item">Tentang Kami</a>
                        <a href="<?php echo esc_url( home_url( '/profil/legalitas' ) ); ?>" class="dropdown-item">Legalitas Perusahaan</a>
                        <a href="<?php echo esc_url( home_url( '/profil/susunan-pengurus' ) ); ?>" class="dropdown-item">Susunan Pengurus</a>
                        <a href="<?php echo esc_url( home_url( '/profil/jaringan-kantor' ) ); ?>" class="dropdown-item">Jaringan Kantor</a>
                    </div>
                </div>

                <!-- Produk (Dropdown) -->
                <div class="dropdown relative">
                    <button class="dropdown-trigger nav-link px-3 py-2 inline-flex items-center gap-1">
                        Produk
                        <svg class="w-3.5 h-3.5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div class="dropdown-menu">
                        <a href="<?php echo esc_url( home_url( '/produk/?kategori=penghimpunan-dana' ) ); ?>" class="dropdown-item">Penghimpunan Dana</a>
                        <a href="<?php echo esc_url( home_url( '/produk/?kategori=penyaluran-dana' ) ); ?>" class="dropdown-item">Penyaluran Dana</a>
                        <a href="<?php echo esc_url( home_url( '/produk' ) ); ?>" class="dropdown-item">Semua Produk</a>
                    </div>
                </div>

                <!-- Informasi (Dropdown) -->
                <div class="dropdown relative">
                    <button class="dropdown-trigger nav-link px-3 py-2 inline-flex items-center gap-1">
                        Informasi
                        <svg class="w-3.5 h-3.5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div class="dropdown-menu min-w-[240px]">
                        <a href="<?php echo esc_url( home_url( '/informasi/kegiatan' ) ); ?>" class="dropdown-item">Kegiatan Wakalumi</a>
                        <a href="<?php echo esc_url( home_url( '/informasi/nisbah' ) ); ?>" class="dropdown-item">Informasi Nisbah</a>
                        <a href="<?php echo esc_url( home_url( '/informasi/laporan-keuangan' ) ); ?>" class="dropdown-item">Laporan Keuangan</a>
                        <a href="<?php echo esc_url( home_url( '/informasi/literasi' ) ); ?>" class="dropdown-item">Literasi & Inklusi</a>
                        <a href="<?php echo esc_url( home_url( '/informasi/galeri' ) ); ?>" class="dropdown-item">Galeri Wakalumi</a>
                        <a href="<?php echo esc_url( home_url( '/informasi/karir' ) ); ?>" class="dropdown-item">Karir</a>
                    </div>
                </div>

                <!-- Berita -->
                <a href="<?php echo esc_url( home_url( '/berita' ) ); ?>" class="nav-link px-3 py-2 <?php echo is_post_type_archive( 'berita' ) || is_singular( 'berita' ) ? 'active' : ''; ?>">
                    Berita
                </a>

                <!-- Tim Kami -->
                <a href="<?php echo esc_url( home_url( '/tim-kami' ) ); ?>" class="nav-link px-3 py-2">
                    Tim Kami
                </a>

                <!-- Kontak -->
                <a href="<?php echo esc_url( home_url( '/kontak' ) ); ?>" class="nav-link px-3 py-2">
                    Kontak
                </a>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center gap-2">
                <!-- Dark Mode Toggle -->
                <button data-dark-toggle
                        class="relative w-10 h-10 rounded-xl flex items-center justify-center
                               text-slate-500 hover:text-primary-600 hover:bg-primary-50
                               dark:text-slate-400 dark:hover:text-primary-400 dark:hover:bg-primary-400/10
                               transition-all duration-200"
                        aria-label="Toggle dark mode">
                    <!-- Sun icon (shown in dark mode) -->
                    <svg class="icon-sun w-5 h-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    </svg>
                    <!-- Moon icon (shown in light mode) -->
                    <svg class="icon-moon w-5 h-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                    </svg>
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
        <div class="flex-1 overflow-y-auto py-4 px-4 space-y-1">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
               class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-primary-50 hover:text-primary-700 dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-400 transition-colors">
                Beranda
            </a>

            <!-- Profil -->
            <div>
                <button class="mobile-dropdown-trigger w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-primary-50 hover:text-primary-700 dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-400 transition-colors">
                    Profil
                    <svg class="dropdown-icon w-4 h-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div class="hidden pl-4 mt-1 space-y-1">
                    <a href="<?php echo esc_url( home_url( '/profil/tentang-kami' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Tentang Kami</a>
                    <a href="<?php echo esc_url( home_url( '/profil/legalitas' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Legalitas</a>
                    <a href="<?php echo esc_url( home_url( '/profil/susunan-pengurus' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Susunan Pengurus</a>
                    <a href="<?php echo esc_url( home_url( '/profil/jaringan-kantor' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Jaringan Kantor</a>
                </div>
            </div>

            <!-- Produk -->
            <div>
                <button class="mobile-dropdown-trigger w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-primary-50 hover:text-primary-700 dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-400 transition-colors">
                    Produk
                    <svg class="dropdown-icon w-4 h-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div class="hidden pl-4 mt-1 space-y-1">
                    <a href="<?php echo esc_url( home_url( '/produk/?kategori=penghimpunan-dana' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Penghimpunan Dana</a>
                    <a href="<?php echo esc_url( home_url( '/produk/?kategori=penyaluran-dana' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Penyaluran Dana</a>
                    <a href="<?php echo esc_url( home_url( '/produk' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Semua Produk</a>
                </div>
            </div>

            <!-- Informasi -->
            <div>
                <button class="mobile-dropdown-trigger w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-primary-50 hover:text-primary-700 dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-400 transition-colors">
                    Informasi
                    <svg class="dropdown-icon w-4 h-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div class="hidden pl-4 mt-1 space-y-1">
                    <a href="<?php echo esc_url( home_url( '/informasi/kegiatan' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Kegiatan</a>
                    <a href="<?php echo esc_url( home_url( '/informasi/nisbah' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Informasi Nisbah</a>
                    <a href="<?php echo esc_url( home_url( '/informasi/laporan-keuangan' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Laporan Keuangan</a>
                    <a href="<?php echo esc_url( home_url( '/informasi/literasi' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Literasi & Inklusi</a>
                    <a href="<?php echo esc_url( home_url( '/informasi/galeri' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Galeri</a>
                    <a href="<?php echo esc_url( home_url( '/informasi/karir' ) ); ?>" class="block px-4 py-2 rounded-lg text-sm text-slate-500 hover:text-primary-600 dark:text-slate-400 dark:hover:text-primary-400 transition-colors">Karir</a>
                </div>
            </div>

            <a href="<?php echo esc_url( home_url( '/berita' ) ); ?>" class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-primary-50 hover:text-primary-700 dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-400 transition-colors">Berita</a>
            <a href="<?php echo esc_url( home_url( '/tim-kami' ) ); ?>" class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-primary-50 hover:text-primary-700 dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-400 transition-colors">Tim Kami</a>
            <a href="<?php echo esc_url( home_url( '/kontak' ) ); ?>" class="block px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-primary-50 hover:text-primary-700 dark:text-slate-300 dark:hover:bg-primary-400/10 dark:hover:text-primary-400 transition-colors">Kontak</a>
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

    <main>

