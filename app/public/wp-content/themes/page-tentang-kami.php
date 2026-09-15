<?php
/**
 * Template Name: Tentang Kami
 * Description: Halaman Profil Perusahaan BPRS Wakalumi (Visi, Misi, Sejarah, Budaya Kerja, Makna Logo)
 *
 * @package Wakalumi
 */

get_header();

// ── AMBIL DATA PENGATURAN HALAMAN DARI WP_OPTIONS ─────────────────
$page_badge     = get_option( 'options_about_page_badge', 'Profil Perusahaan' );
$page_title     = get_option( 'options_about_page_title', 'Mengenal Lebih Dekat BPRS Wakalumi' );
$page_subtitle  = get_option( 'options_about_page_subtitle', 'Membangun kualitas hidup berkah sesuai Syariah — Lembaga keuangan syariah yang fokus pada jasa keuangan dan pemberdayaan ekonomi umat serta UMKM.' );

$sec_badge      = get_option( 'options_about_page_sec_badge', 'Sekilas Perusahaan' );
$sec_title      = get_option( 'options_about_page_sec_title', 'Tumbuh Bersama Umat, Melayani Sepenuh Hati' );
$narrative_1    = get_option( 'options_about_page_narrative_1', 'PT. Bank Perekonomian Rakyat Syariah (BPRS) Wakalumi didirikan oleh Yayasan Wakalumi (Wakaf Karyawan dan Alumni Muslim Citibank) berdasarkan Akta Notaris Ny. Siti Pertiwi Henny Shidki, SH Nomor 59 tanggal 7 Oktober 1989 dan mendapatkan pengesahan Menteri Kehakiman RI tanggal 13 Januari 1990. BPRS Wakalumi memulai aktivitas operasi perbankan pada tanggal 1 Mei 1992, dan resmi dikonversi menjadi Bank Pembiayaan Rakyat Syariah pada tahun 1995 berlandaskan UU Nomor 7 Tahun 1992.' );
$narrative_2    = get_option( 'options_about_page_narrative_2', 'BPRS Wakalumi senantiasa berpegang teguh pada komitmen ISHLAH—terus melakukan perbaikan berkelanjutan demi kemaslahatan bersama. Kami menghimpun dana dari masyarakat dalam bentuk deposito berjangka dan tabungan syariah, memberikan pembiayaan bagi pengusaha kecil, mikro, maupun masyarakat umum, serta aktif memfasilitasi literasi ekonomi syariah dan pembinaan Bank Mini di sekolah-sekolah.' );
$about_img      = get_option( 'options_about_page_image', get_template_directory_uri() . '/assets/img/about-photo.jpg' );

$stat_1_val     = get_option( 'options_about_page_stat_1_val', '35+' );
$stat_1_lbl     = get_option( 'options_about_page_stat_1_lbl', 'Tahun Pengalaman (1989)' );
$stat_2_val     = get_option( 'options_about_page_stat_2_val', '10.000+' );
$stat_2_lbl     = get_option( 'options_about_page_stat_2_lbl', 'Nasabah Setia' );
$stat_3_val     = get_option( 'options_about_page_stat_3_val', '100%' );
$stat_3_lbl     = get_option( 'options_about_page_stat_3_lbl', 'Prinsip Murni Syariah' );
$stat_4_val     = get_option( 'options_about_page_stat_4_val', 'Rp2 Miliar' );
$stat_4_lbl     = get_option( 'options_about_page_stat_4_lbl', 'Dijamin LPS per Nasabah' );

$vision_badge   = get_option( 'options_about_page_vision_badge', 'Visi Perusahaan' );
$vision_title   = get_option( 'options_about_page_vision_title', 'Menjadi BPR Syariah yang sehat, besar dan bermanfaat bagi umat' );
$vision_desc    = get_option( 'options_about_page_vision_desc', '“Menjadikan BPRS Wakalumi ibarat sebuah pohon yang memiliki akar dan batang yang kuat, daun yang lebat dan buah yang manis”' );

$missions       = get_option( 'options_about_page_missions', [] );
if ( empty( $missions ) ) {
    $missions = [
        'Memberdayakan ekonomi umat dengan fokus usaha mikro, kecil dan menengah.',
        'Memberikan layanan prima dan amanah bagi nasabah.',
        'Menjalankan fungsi inklusi dan literasi ekonomi syariah bagi masyarakat.',
        'Memberikan manfaat optimal bagi para stakeholder.',
        'Membangun sistem dan tata kerja yang unggul dengan sumber daya insani yang professional, kompeten, handal dan menjunjung tinggi ukhuwah islamiyah.',
    ];
}

$identity_text  = get_option( 'options_about_page_identity', 'BPRS Wakalumi adalah Lembaga Keuangan Syariah yang memiliki fokus pada jasa keuangan dan pemberdayaan ekonomi umat dan masyarakat sesuai syariah.' );
$belief_text    = get_option( 'options_about_page_belief', 'BPRS Wakalumi berkomitmen untuk selalu melakukan ISHLAH, yakni kami terus melakukan perbaikan berkelanjutan.' );

$values = get_option( 'options_about_page_values', [] );
if ( empty( $values ) ) {
    $values = [
        [ 'acronym' => 'S', 'title' => 'Skill', 'desc' => 'Selalu mengasah kompetensi agar dapat menciptakan peluang' ],
        [ 'acronym' => 'A', 'title' => 'Action', 'desc' => 'Melakukan tindakan profesional yang penuh tanggungjawab' ],
        [ 'acronym' => 'P', 'title' => 'Pray', 'desc' => 'Menghadirkan Allah dalam setiap aktifitas kerja, ibadah dan doa yang penuh nilai kebaikan' ],
        [ 'acronym' => 'A', 'title' => 'Attitude', 'desc' => 'Memiliki sikap dan prilaku positif yang memberi warna kebaikan' ],
    ];
}

$logo_img       = get_option( 'options_about_page_logo_img', get_template_directory_uri() . '/assets/img/logo-new-1.png' );
$logo_desc      = get_option( 'options_about_page_logo_desc', 'Logo BPRS Wakalumi merefleksikan identitas perbankan syariah yang dinamis, bersih, dan berakar pada nilai-nilai keislaman universal.' );

$logo_p1_title  = get_option( 'options_about_page_logo_p1_title', 'Bentuk Gelombang & Aliran Berkah' );
$logo_p1_desc   = get_option( 'options_about_page_logo_p1_desc', 'Melambangkan kelancaran aliran rezeki, fleksibilitas dalam melayani, serta kesegaran solusi finansial yang menyejukkan perekonomian umat.' );
$logo_p2_title  = get_option( 'options_about_page_logo_p2_title', 'Warna Ocean Teal & Bright Teal' );
$logo_p2_desc   = get_option( 'options_about_page_logo_p2_desc', 'Merefleksikan ketenangan, stabilitas finansial yang kokoh, profesionalisme modern, serta komitmen menjaga amanah nasabah.' );
$logo_p3_title  = get_option( 'options_about_page_logo_p3_title', 'Aksen Mint Glow' );
$logo_p3_desc   = get_option( 'options_about_page_logo_p3_desc', 'Melambangkan pertumbuhan ekonomi yang berkah, harapan baru bagi UMKM, dan masa depan perbankan syariah yang gemilang.' );

$show_stats     = get_option( 'options_about_page_show_stats', '1' );
$show_vision    = get_option( 'options_about_page_show_vision', '1' );
$show_values    = get_option( 'options_about_page_show_values', '1' );
$show_logo      = get_option( 'options_about_page_show_logo', '1' );
$show_cta       = get_option( 'options_about_page_show_cta', '1' );
$cta_badge      = get_option( 'options_about_page_cta_badge', 'Langkah Nyata Bersama Kami' );
$cta_title      = get_option( 'options_about_page_cta_title', 'Siap Mengembangkan Usaha & Mengelola Dana Secara Berkah?' );
$cta_desc       = get_option( 'options_about_page_cta_desc', 'Konsultasikan kebutuhan perbankan syariah Anda bersama tim profesional BPRS Wakalumi, atau temukan solusi simpanan dan pembiayaan yang tepat untuk masa depan finansial Anda.' );
$cta_btn1_text  = get_option( 'options_about_page_cta_btn1_text', 'Hubungi via WhatsApp' );
$cta_btn1_url   = get_option( 'options_about_page_cta_btn1_url', '' );
$cta_btn2_text  = get_option( 'options_about_page_cta_btn2_text', 'Jelajahi Produk Kami' );
$cta_btn2_url   = get_option( 'options_about_page_cta_btn2_url', home_url( '/produk' ) );

$wa_number      = get_option( 'options_contact_wa', '6281517380388' );
$wa_url         = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );

if ( empty( $cta_btn1_url ) ) {
    $cta_btn1_url = $wa_url;
}
?>

<!-- ========================================
     HEADER BANNER & BREADCRUMBS
     ======================================== -->
<section class="relative z-10 pt-8 pb-14 md:pb-20 overflow-hidden bg-slate-50 dark:bg-dark-surface border-b border-slate-200/60 dark:border-slate-800/60">
    <!-- Subtle Ambient Glow -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-72 bg-gradient-to-b from-primary-500/10 via-teal-500/5 to-transparent blur-3xl pointer-events-none"></div>

    <div class="container-wide relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-accent transition-colors flex items-center gap-1.5 font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-slate-600 dark:text-slate-300 font-medium">Profil</span>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-primary-600 dark:text-teal-400 font-bold">Tentang Kami</span>
        </nav>

        <div class="max-w-4xl" data-aos="fade-up">
            <!-- Kicker Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full mb-5 bg-primary-500/10 dark:bg-primary-400/10 border border-primary-500/20 dark:border-primary-400/20">
                <span class="w-2 h-2 rounded-full bg-primary-500 dark:bg-teal-400 animate-pulse"></span>
                <span class="text-xs font-bold uppercase tracking-wider text-primary-700 dark:text-teal-300">
                    <?php echo esc_html( $page_badge ); ?>
                </span>
            </div>

            <!-- Main Page Title -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-[1.15] mb-5">
                <?php echo esc_html( $page_title ); ?>
            </h1>

            <!-- Subtitle -->
            <?php if ( ! empty( $page_subtitle ) ) : ?>
                <p class="text-base sm:text-lg md:text-xl text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                    <?php echo esc_html( $page_subtitle ); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- ========================================
     SECTION 1: SEKILAS PERUSAHAAN & STATISTIK
     ======================================== -->
<section class="relative z-10 py-14 md:py-20 bg-white dark:bg-dark border-b border-slate-100 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- Left Narrative -->
            <div class="lg:col-span-7" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300 border border-teal-100 dark:border-teal-800/30 mb-4">
                    <?php echo esc_html( $sec_badge ); ?>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-snug mb-6">
                    <?php echo esc_html( $sec_title ); ?>
                </h2>
                <div class="space-y-4 text-slate-600 dark:text-slate-300 leading-relaxed text-base md:text-lg">
                    <p class="border-l-4 border-primary-500 pl-4 italic text-slate-700 dark:text-slate-200">
                        <?php echo nl2br( esc_html( $narrative_1 ) ); ?>
                    </p>
                    <p>
                        <?php echo nl2br( esc_html( $narrative_2 ) ); ?>
                    </p>
                </div>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="<?php echo esc_url( home_url( '/profil/legalitas' ) ); ?>" class="btn-primary text-xs sm:text-sm px-6 py-3 rounded-xl inline-flex items-center gap-2">
                        <span>Lihat Legalitas Perusahaan</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/profil/susunan-pengurus' ) ); ?>" class="btn-secondary text-xs sm:text-sm px-6 py-3 rounded-xl inline-flex items-center gap-2">
                        <span>Susunan Pengurus</span>
                    </a>
                </div>
            </div>

            <!-- Right Photo with Floating Frame -->
            <div class="lg:col-span-5 relative" data-aos="fade-left">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-slate-300/50 dark:shadow-black/50 border border-slate-200/80 dark:border-slate-700/60 group">
                    <img src="<?php echo esc_url( $about_img ); ?>" 
                         alt="Gedung Kantor BPRS Wakalumi" 
                         class="w-full h-80 sm:h-96 md:h-[420px] object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                    <div class="absolute bottom-5 left-5 right-5 text-white">
                        <span class="text-xs font-semibold uppercase tracking-widest text-teal-300 drop-shadow">Kantor Pusat</span>
                        <h4 class="text-lg font-bold drop-shadow">BPRS Wakalumi Ciputat, Tangerang Selatan</h4>
                    </div>
                </div>

                <!-- Floating Experience Badge -->
                <div class="absolute -bottom-6 -left-6 sm:-bottom-8 sm:-left-8 bg-white/90 dark:bg-dark-surface/90 backdrop-blur-md p-4 sm:p-5 rounded-2xl shadow-xl border border-slate-200/80 dark:border-slate-700/60 flex items-center gap-3.5 max-w-[240px]" data-aos="zoom-in" data-aos-delay="200">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-teal-400 flex items-center justify-center text-white shrink-0 shadow-md">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <span class="block text-xl font-black text-slate-900 dark:text-white leading-none mb-1">Amanah</span>
                        <span class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 leading-tight block">Berpengalaman & Terpercaya</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- 4 Key Stats -->
        <?php if ( $show_stats ) : ?>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-16 sm:mt-20">
            <?php for ( $s = 1; $s <= 4; $s++ ) : 
                $val = ${"stat_{$s}_val"};
                $lbl = ${"stat_{$s}_lbl"};
                if ( empty( $val ) ) continue;

                // Parse counter values for interactive animation:
                $prefix = '';
                $num    = 0;
                $suffix = '';
                $is_num = false;
                if ( preg_match( '/^(.*?)(\d+[\d\.]*)(.*?)$/u', $val, $m ) ) {
                    $is_num    = true;
                    $prefix    = $m[1];
                    $clean_num = str_replace( '.', '', $m[2] );
                    $num       = intval( $clean_num );
                    $suffix    = $m[3];
                }
            ?>
                <div class="spotlight-card tilt-card relative overflow-hidden rounded-2xl md:rounded-3xl p-6 text-center bg-white dark:bg-dark-surface border border-slate-200/80 dark:border-dark-border hover:-translate-y-1.5 transition-all duration-300 shadow-md shadow-slate-100 dark:shadow-none group cursor-default before:absolute before:top-0 before:left-0 before:right-0 before:h-1 before:bg-gradient-to-r before:from-primary-500 before:to-teal-400" data-aos="fade-up" data-aos-delay="<?php echo $s * 80; ?>">
                    <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-28 h-28 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                    </div>

                    <span class="block text-3xl sm:text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-primary-600 via-teal-500 to-primary-600 dark:from-teal-300 dark:via-primary-300 dark:to-teal-300 mb-2 counter-number relative z-10"
                          <?php if ( $is_num ) : ?>
                              data-counter="<?php echo esc_attr( $num ); ?>"
                              data-counter-prefix="<?php echo esc_attr( $prefix ); ?>"
                              data-counter-suffix="<?php echo esc_attr( $suffix ); ?>"
                          <?php endif; ?>>
                        <?php echo esc_html( $val ); ?>
                    </span>
                    <span class="text-xs sm:text-sm font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider block group-hover:text-primary-600 dark:group-hover:text-teal-300 transition-colors relative z-10">
                        <?php echo esc_html( $lbl ); ?>
                    </span>
                </div>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</section>


<!-- ========================================
     SECTION 2: VISI & MISI STRATEGIS
     ======================================== -->
<?php if ( $show_vision ) : ?>
<section class="relative z-10 py-16 md:py-24 bg-transparent border-y border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-primary-50 text-primary-700 dark:bg-primary-400/10 dark:text-accent border border-primary-100 dark:border-primary-800/30 mb-3">
                Arah & Tujuan Strategis
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Visi & Misi BPRS Wakalumi
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3">
                Landasan cita-cita luhur dan aksi nyata kami dalam melayani serta menggerakkan roda perekonomian masyarakat secara syariah.
            </p>
        </div>

        <!-- Visi Card (Megah Showcase) -->
        <div class="spotlight-card relative rounded-3xl p-8 sm:p-10 md:p-14 overflow-hidden bg-gradient-to-br from-primary-900 via-primary-950 to-slate-950 text-white shadow-2xl shadow-primary-900/20 border border-primary-500/30 mb-10 md:mb-14" data-aos="zoom-in">
            <!-- Background Decorative Watermark Emblem -->
            <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/4 w-72 h-72 md:w-96 md:h-96 opacity-[0.06] pointer-events-none">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-full h-full object-contain">
            </div>

            <!-- Glowing Orb -->
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-primary-500/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-widest bg-white/10 backdrop-blur-md border border-white/20 text-teal-300 mb-6">
                    <svg class="w-3.5 h-3.5 text-teal-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <?php echo esc_html( $vision_badge ); ?>
                </div>
                <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold leading-snug tracking-tight mb-5 text-white">
                    "<?php echo esc_html( $vision_title ); ?>"
                </h3>
                <?php if ( ! empty( $vision_desc ) ) : ?>
                    <p class="text-sm sm:text-base md:text-lg text-slate-300 leading-relaxed font-normal">
                        <?php echo esc_html( $vision_desc ); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Misi Grid Cards -->
        <?php if ( ! empty( $missions ) ) : ?>
        <div>
            <h4 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-teal-500"></span>
                Butir-Butir Misi Strategis:
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">
                <?php foreach ( $missions as $idx => $mission_text ) : ?>
                    <div class="spotlight-card tilt-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-md shadow-slate-100 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] hover:shadow-xl hover:shadow-teal-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between cursor-default" data-aos="fade-up" data-aos-delay="<?php echo ( $idx % 3 ) * 100; ?>">
                        <!-- Dual-Tone Header Bar -->
                        <div class="px-6 py-3.5 bg-slate-50 dark:bg-slate-800/90 border-b border-slate-100 dark:border-slate-700/80 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-teal-400 text-white font-black text-xs flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <?php echo sprintf( '%02d', $idx + 1 ); ?>
                                </div>
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-teal-300">Misi Perusahaan</span>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-teal-400 group-hover:scale-125 transition-transform"></span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 relative flex-grow flex flex-col justify-between overflow-hidden">
                            <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide like Nisbah Card) -->
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-36 h-36 md:w-44 md:h-44 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                            </div>

                            <p class="text-slate-700 dark:text-slate-100 text-sm sm:text-base leading-relaxed relative z-10">
                                <?php echo esc_html( $mission_text ); ?>
                            </p>

                            <div class="mt-5 pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center gap-1.5 text-xs font-semibold text-primary-600 dark:text-teal-300 relative z-10">
                                <span>Komitmen Syariah</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Jati Diri & Keyakinan Inti (Core Beliefs) -->
        <div class="mt-12 md:mt-16 grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up">
            <!-- Jati Diri -->
            <div class="spotlight-card tilt-card group relative overflow-hidden rounded-3xl bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-lg shadow-slate-100 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] hover:-translate-y-1.5 transition-all duration-300 cursor-default">
                <!-- Dual-Tone Header Bar -->
                <div class="px-7 py-3.5 bg-slate-50 dark:bg-slate-800/90 border-b border-slate-100 dark:border-slate-700/80 flex items-center justify-between">
                    <span class="text-xs uppercase tracking-widest font-extrabold text-teal-600 dark:text-teal-400">Jati Diri Lembaga</span>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-teal-500/10 text-teal-700 dark:text-teal-300 border border-teal-500/20">Fokus Syariah</span>
                </div>
                <div class="p-7 relative overflow-hidden">
                    <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-44 h-44 md:w-52 md:h-52 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                    </div>
                    <div class="flex items-start gap-4 relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-teal-50 dark:bg-teal-950/40 border border-teal-200 dark:border-teal-800/40 flex items-center justify-center text-teal-600 dark:text-teal-300 shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2">Lembaga Keuangan Syariah Umat</h3>
                            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-100 leading-relaxed">
                                <?php echo esc_html( $identity_text ); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keyakinan Inti (ISHLAH) -->
            <div class="spotlight-card tilt-card group relative overflow-hidden rounded-3xl bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-lg shadow-slate-100 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] hover:-translate-y-1.5 transition-all duration-300 cursor-default">
                <!-- Dual-Tone Header Bar -->
                <div class="px-7 py-3.5 bg-slate-50 dark:bg-slate-800/90 border-b border-slate-100 dark:border-slate-700/80 flex items-center justify-between">
                    <span class="text-xs uppercase tracking-widest font-extrabold text-primary-600 dark:text-teal-300">Keyakinan Inti (Core Beliefs)</span>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-primary-500/10 text-primary-700 dark:text-teal-300 border border-primary-500/20">Nilai Abadi</span>
                </div>
                <div class="p-7 relative overflow-hidden">
                    <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-44 h-44 md:w-52 md:h-52 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                    </div>
                    <div class="flex items-start gap-4 relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-primary-50 dark:bg-primary-950/40 border border-primary-200 dark:border-primary-800/40 flex items-center justify-center text-primary-600 dark:text-teal-300 shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold text-slate-900 dark:text-white mb-2">Komitmen ISHLAH Berkelanjutan</h3>
                            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-100 leading-relaxed">
                                <?php echo esc_html( $belief_text ); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?php endif; ?>


<!-- ========================================
     SECTION 3: NILAI BUDAYA PERUSAHAAN (SAPA)
     ======================================== -->
<?php if ( $show_values && ! empty( $values ) ) : ?>
<section class="relative z-10 py-16 md:py-24 bg-white dark:bg-dark border-b border-slate-100 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-teal-50 text-teal-700 dark:bg-teal-400/10 dark:text-teal-300 border border-teal-100 dark:border-teal-800/30 mb-3">
                Budaya Kerja 'SAPA'
            </div>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Budaya Kerja WAKALUMI
            </h2>
            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                Budaya WAKALUMI dirangkum dalam kata <strong>‘SAPA’ (Skill, Action, Pray, Attitude)</strong> yang menghadirkan kebersamaan, kehangatan, dan keakraban untuk memberikan hasil optimal dalam setiap aktivitas kerja.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ( $values as $v_idx => $val_item ) : 
                $acronym = $val_item['acronym'] ?? '';
                $v_title = $val_item['title'] ?? '';
                $v_desc  = $val_item['desc'] ?? '';
            ?>
                <div class="spotlight-card tilt-card group relative rounded-2xl md:rounded-3xl overflow-hidden bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-md shadow-slate-100 dark:shadow-[0_10px_30px_-5px_rgba(0,0,0,0.5)] hover:shadow-xl hover:shadow-teal-500/15 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between cursor-default" data-aos="fade-up" data-aos-delay="<?php echo ( $v_idx % 4 ) * 80; ?>">
                    <!-- Dual-Tone Header Bar -->
                    <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/90 border-b border-slate-100 dark:border-slate-700/80 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-teal-400 text-white font-black text-lg flex items-center justify-center shadow-sm group-hover:scale-110 group-hover:-rotate-3 transition-transform">
                                <?php echo esc_html( $acronym ); ?>
                            </div>
                            <div>
                                <span class="text-[10px] uppercase tracking-widest font-extrabold text-slate-400 dark:text-teal-300 block">Karakter</span>
                                <h3 class="text-base font-extrabold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-teal-300 transition-colors">
                                    <?php echo esc_html( $v_title ); ?>
                                </h3>
                            </div>
                        </div>
                        <span class="w-2 h-2 rounded-full bg-teal-400 group-hover:scale-125 transition-transform"></span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 relative flex-grow flex flex-col justify-between overflow-hidden">
                        <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-32 h-32 md:w-36 md:h-36 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>

                        <p class="text-sm sm:text-base text-slate-700 dark:text-slate-100 leading-relaxed relative z-10">
                            <?php echo esc_html( $v_desc ); ?>
                        </p>

                        <div class="mt-5 pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center gap-1.5 text-xs font-semibold text-teal-600 dark:text-teal-400 relative z-10">
                            <span>Pilar Budaya SAPA</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     SECTION 4: MAKNA & FILOSOFI LOGO
     ======================================== -->
<?php if ( $show_logo ) : ?>
<section class="relative z-10 py-16 md:py-24 bg-gradient-to-b from-slate-50/80 via-white to-slate-50/80 dark:from-dark-surface/60 dark:via-dark dark:to-dark-surface/60 border-t border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- Logo Preview on Elegant Surface -->
            <div class="lg:col-span-5" data-aos="fade-right">
                <div class="spotlight-card tilt-card rounded-3xl p-8 sm:p-10 bg-slate-900 text-white shadow-2xl border border-slate-800 relative overflow-hidden flex flex-col items-center justify-center text-center group cursor-default">
                    <!-- Subtle Glow -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary-500/20 via-teal-500/10 to-transparent pointer-events-none"></div>
                    
                    <div class="relative z-10 w-full max-w-xs h-32 sm:h-40 flex items-center justify-center p-4">
                        <img src="<?php echo esc_url( $logo_img ); ?>" 
                             alt="Logo Resmi BPRS Wakalumi" 
                             class="max-w-full max-h-full object-contain filter drop-shadow-[0_10px_20px_rgba(0,0,0,0.5)] group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="relative z-10 mt-6 pt-6 border-t border-white/10 w-full">
                        <span class="text-xs uppercase tracking-widest font-bold text-teal-300">Identitas Visual Resmi</span>
                        <h4 class="text-base font-bold text-white mt-1">PT BPRS Wakalumi</h4>
                    </div>
                </div>
            </div>

            <!-- Pillars of Philosophy -->
            <div class="lg:col-span-7" data-aos="fade-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-primary-50 text-primary-700 dark:bg-primary-400/10 dark:text-teal-300 border border-primary-100 dark:border-primary-800/30 mb-3">
                    Identitas & Filosofi Brand
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-snug mb-4">
                    Makna di Balik Lambang Wakalumi
                </h2>
                <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed mb-8">
                    <?php echo nl2br( esc_html( $logo_desc ) ); ?>
                </p>

                <div class="space-y-6">
                    <!-- Pillar 1 -->
                    <div class="spotlight-card tilt-card group relative overflow-hidden rounded-2xl p-5 bg-white dark:bg-dark-surface border border-slate-200/80 dark:border-dark-border shadow-sm hover:shadow-md hover:border-teal-500/40 transition-all flex items-start gap-4 cursor-default">
                        <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-32 h-32 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-teal-50 dark:bg-teal-950/40 border border-teal-200 dark:border-teal-800/40 flex items-center justify-center text-teal-600 dark:text-teal-300 shrink-0 mt-1 shadow-sm relative z-10 group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white mb-1 group-hover:text-teal-600 dark:group-hover:text-teal-300 transition-colors">
                                <?php echo esc_html( $logo_p1_title ); ?>
                            </h4>
                            <p class="text-sm text-slate-700 dark:text-slate-100 leading-relaxed">
                                <?php echo esc_html( $logo_p1_desc ); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Pillar 2 -->
                    <div class="spotlight-card tilt-card group relative overflow-hidden rounded-2xl p-5 bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-sm hover:shadow-md hover:border-primary-500/40 transition-all flex items-start gap-4 cursor-default">
                        <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-32 h-32 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-primary-50 dark:bg-primary-950/40 border border-primary-200 dark:border-primary-800/40 flex items-center justify-center text-primary-600 dark:text-teal-300 shrink-0 mt-1 shadow-sm relative z-10 group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white mb-1 group-hover:text-primary-600 dark:group-hover:text-teal-300 transition-colors">
                                <?php echo esc_html( $logo_p2_title ); ?>
                            </h4>
                            <p class="text-sm text-slate-700 dark:text-slate-100 leading-relaxed">
                                <?php echo esc_html( $logo_p2_desc ); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Pillar 3 -->
                    <div class="spotlight-card tilt-card group relative overflow-hidden rounded-2xl p-5 bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-sm hover:shadow-md hover:border-teal-500/40 transition-all flex items-start gap-4 cursor-default">
                        <!-- Decorative Watermark Logo (Interactive Hover: Left to Right Slide) -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[25%] w-32 h-32 opacity-[0.05] dark:opacity-[0.035] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] dark:group-hover:opacity-[0.06] mix-blend-multiply dark:mix-blend-screen select-none overflow-hidden">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/untitled4.png" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-teal-50 dark:bg-teal-950/40 border border-teal-200 dark:border-teal-800/40 flex items-center justify-center text-teal-600 dark:text-teal-300 shrink-0 mt-1 shadow-sm relative z-10 group-hover:scale-105 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white mb-1 group-hover:text-teal-600 dark:group-hover:text-teal-300 transition-colors">
                                <?php echo esc_html( $logo_p3_title ); ?>
                            </h4>
                            <p class="text-sm text-slate-700 dark:text-slate-100 leading-relaxed">
                                <?php echo esc_html( $logo_p3_desc ); ?>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     SECTION 5: AJAKAN BERTINDAK (CALL TO ACTION)
     ======================================== -->
<?php if ( $show_cta ) : ?>
<section class="relative z-10 py-16 md:py-24 bg-white dark:bg-dark border-t border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="relative rounded-3xl p-8 sm:p-12 md:p-16 overflow-hidden bg-gradient-to-br from-primary-900 via-primary-950 to-slate-950 text-white shadow-2xl shadow-primary-900/20 border border-primary-500/30 text-center" data-aos="zoom-in">
            <!-- Background Decorative Watermark Emblem -->
            <div class="absolute right-0 bottom-0 translate-x-1/4 translate-y-1/4 w-80 h-80 opacity-[0.06] pointer-events-none">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-full h-full object-contain">
            </div>
            
            <!-- Glowing Orbs -->
            <div class="absolute -top-24 -left-24 w-72 h-72 bg-primary-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-teal-400/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-widest bg-white/10 backdrop-blur-md border border-white/20 text-teal-300 mb-6">
                    <span class="w-2 h-2 rounded-full bg-teal-400 animate-ping"></span>
                    <?php echo esc_html( $cta_badge ); ?>
                </div>

                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight mb-5">
                    <?php echo esc_html( $cta_title ); ?>
                </h2>

                <p class="text-slate-300 text-sm sm:text-base md:text-lg leading-relaxed mb-8 max-w-2xl mx-auto font-normal">
                    <?php echo esc_html( $cta_desc ); ?>
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="<?php echo esc_url( $cta_btn1_url ); ?>" 
                       target="_blank" rel="noopener noreferrer"
                       class="btn-primary text-sm sm:text-base px-8 py-4 rounded-xl shadow-lg shadow-primary-500/25 inline-flex items-center gap-2.5 font-bold hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        <span><?php echo esc_html( $cta_btn1_text ); ?></span>
                    </a>
                    <a href="<?php echo esc_url( $cta_btn2_url ); ?>" 
                       class="btn-secondary text-sm sm:text-base px-8 py-4 rounded-xl border border-white/20 bg-white/10 hover:bg-white/20 text-white inline-flex items-center gap-2 font-bold backdrop-blur-sm transition-all hover:scale-105">
                        <span><?php echo esc_html( $cta_btn2_text ); ?></span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<?php
get_footer();

