<?php
/**
 * Template Name: Susunan Pengurus
 * Description: Halaman Susunan Pengurus / Jajaran Kepemimpinan BPRS Wakalumi
 *              "Sticky Scroll-Driven Executive Spotlight" (Stage & Floating Dock Parallax)
 *
 * @package Wakalumi
 */

get_header();

// ── AMBIL DATA PENGATURAN HALAMAN DARI WP_OPTIONS ─────────────────
$page_badge    = get_option( 'options_pengurus_page_badge', 'Susunan Pengurus' );
$page_title    = get_option( 'options_pengurus_page_title', 'Jajaran Kepemimpinan BPRS Wakalumi' );
$page_subtitle = get_option( 'options_pengurus_page_subtitle', 'Dipimpin oleh para profesional berpengalaman yang berkomitmen pada prinsip perbankan syariah, tata kelola yang baik (GCG), dan pelayanan terbaik bagi nasabah.' );
$page_intro    = get_option( 'options_pengurus_page_intro', 'Sesuai dengan prinsip Good Corporate Governance (GCG), BPRS Wakalumi menghadirkan transparansi penuh atas jajaran kepemimpinan yang menjaga amanah nasabah dan integritas operasional perbankan syariah.' );

// ── DAFTAR PENGURUS DEFAULT (6 TOKOH LENGKAP & TERVERIFIKASI: DPS -> Dewan Komisaris -> Direksi) ─────────
$default_pengurus = [
    [
        'nama'          => 'Haryanto, S.E., M.M.',
        'kategori'      => 'Dewan Pengawas Syariah',
        'jabatan'       => 'Ketua Dewan Pengawas Syariah',
        'foto'          => 'http://wakalumibprscoid.local/wp-content/themes/assets/../assets/img/pengurus/dps-anggota.png',
        'riwayat_karir' => "• Ketua Dewan Pengawas Syariah PT. BPRS Wakalumi (2024 – saat ini)\n• Dewan Pengawas Syariah PT. BPRS Al-Hijrah Amanah\n• Dewan Pengawas Syariah Asuransi Ramayana Syariah\n• Praktisi dan konsultan akuntansi, audit keuangan, dan kepatuhan perbankan syariah nasional.",
        'pendidikan'    => "• Magister Manajemen (S2) Manajemen Keuangan, Universitas Krisnadwipayana (UNKRIS) Jakarta, Lulus Tahun 2004.\n• Sarjana Ekonomi (S1) Akuntansi, Universitas Islam As-Syafi'iyah (UNIAT) Jakarta, Lulus Tahun 1998.",
        'sertifikasi'   => 'Sertifikasi Dewan Pengawas Syariah (DSN-MUI / LSP-KS), Sertifikasi Akuntansi Keuangan Syariah.',
        'kutipan'       => 'Mengawal kemurnian prinsip syariah pada setiap produk dan akad keuangan adalah amanah ukhrawi yang harus dijaga teguh.',
        'status'        => 'Aktif',
        'urutan'        => 1,
    ],
    [
        'nama'          => 'Drs. H. Zarkasih Nur',
        'kategori'      => 'Dewan Pengawas Syariah',
        'jabatan'       => 'Anggota Dewan Pengawas Syariah',
        'foto'          => 'http://wakalumibprscoid.local/wp-content/uploads/2026/10/KPN_Zarkasih_Nur.png',
        'riwayat_karir' => "• Anggota Dewan Pengawas Syariah PT. BPRS Wakalumi (sebelumnya menjabat Ketua DPS PT. BPRS Wakalumi)\n• Menteri Negara Koperasi dan UKM Republik Indonesia pada Kabinet Persatuan Nasional (1999 – 2001)\n• Pimpinan Fraksi & Ketua DPP Partai Persatuan Pembangunan (1998 – 2003)\n• Anggota DPR / MPR RI (1987 – 1999)\n• Anggota DPRD Kabupaten Tangerang (1971 – 1977)",
        'pendidikan'    => 'Sarjana (Drs.) Ilmu Keagamaan Islam, IAIN Syarif Hidayatullah Jakarta (kini UIN Syarif Hidayatullah), Lulus Tahun 1973.',
        'sertifikasi'   => 'Sertifikasi Dewan Pengawas Syariah (DSN-MUI), Tokoh Nasional Penggerak Koperasi & Keuangan Syariah.',
        'kutipan'       => 'Pemberdayaan ekonomi umat dan UMKM harus berlandaskan pada keadilan, keberkahan, dan prinsip syariah yang murni.',
        'status'        => 'Aktif',
        'urutan'        => 2,
    ],
    [
        'nama'          => 'Budi Satoto, S.Si.',
        'kategori'      => 'Dewan Komisaris',
        'jabatan'       => 'Komisaris Utama',
        'foto'          => 'http://wakalumibprscoid.local/wp-content/uploads/2026/10/IMG_4830-scaled-e1792897033291.jpg',
        'riwayat_karir' => "• Komisaris Utama PT. BPRS Wakalumi (BSW) (2008 – sekarang)\n• Direktur PT Eka Lestary Realty (2024 – 2008)\n• Ketua Dewan Pengawas Komudera (Koperasi Konsumen Muslim Depok Jaya) (2017 – sekarang)\n• Ketua Dewan Pengawas KSPPS Koperasi Asy Syirkah Muamalah Indonesia (2017 – sekarang)\n• Komisaris Utama PT. BPRS Al-Hijrah Amanah (2017 – sekarang)\n• Dosen Tamu IPB & Universitas YARSI (1995 – 2003, 2011 – 2018)\n• Komisaris PT FPS Indonesia (member of FPS group, Singapore) (2013 – 2018)\n• Komisaris BPRS Rif'atul Ummah (2006)\n• Corporate Business & Secretary PT Iska Niaga Darma (2004 – 2014)\n• Direktur Keuangan PT Asuransi Syariah Mubarakah (2002 – 2003)\n• Auditor BPPN Badan Penyehatan Perbankan Nasional, KAP Heliantono & Basyiruddin - BPPN (2000)\n• Dept. Head (Kredit program) Bank Nusa (1994 – 2000)\n• Account Officer Bank Duta (1989 – 1994)",
        'pendidikan'    => 'Sarjana (S1) Program Studi Agrometeorologi, FMIPA - Institut Pertanian Bogor (IPB), Lulus Tahun 1998.',
        'sertifikasi'   => 'Sertifikasi Kompetensi Komisaris BPR/BPRS (OJK / Certif), Manajemen Risiko Perbankan Syariah.',
        'kutipan'       => 'Penerapan tata kelola yang baik (GCG) dan pengawasan yang prudent adalah kunci pertumbuhan berkelanjutan perbankan syariah.',
        'status'        => 'Aktif',
        'urutan'        => 3,
    ],
    [
        'nama'          => 'Rena Bangun Luhur, S.Pd.',
        'kategori'      => 'Dewan Komisaris',
        'jabatan'       => 'Komisaris',
        'foto'          => 'http://wakalumibprscoid.local/wp-content/uploads/2026/10/WhatsApp-Image-2026-09-23-at-11.44.45-AM.jpeg',
        'riwayat_karir' => "• Dewan Komisaris PT. BPRS Wakalumi (2024 – saat ini)\n• Manajer Operasional & IT KSPPS Tamzis Bina Utama (2022 – saat ini)\n• Manajer Kantor Pelayanan Operasional (KPO) KSPPS Tamzis Bina Utama (2018 – 2022)\n• Manajer Marketing Wilayah KSPPS Tamzis Bina Utama (2012 – 2018)\n• Manajer Marketing Area KSPPS Tamzis Bina Utama (2009 – 2012)\n• Manajer Marketing Cabang KSPPS Tamzis Bina Utama (2009)",
        'pendidikan'    => 'Sarjana (S1) Fakultas Ilmu Sosial / Pendidikan Ekonomi Koperasi, Universitas Negeri Yogyakarta (UNY), Lulus Tahun 2004.',
        'sertifikasi'   => 'Sertifikasi Kompetensi Komisaris BPR/BPRS (OJK), Manajemen Operasional & IT Lembaga Keuangan Syariah.',
        'kutipan'       => 'Kepatuhan regulasi, tata kelola teknologi, dan mitigasi risiko operasional adalah fondasi utama kepercayaan nasabah.',
        'status'        => 'Aktif',
        'urutan'        => 4,
    ],
    [
        'nama'          => 'Kiftiah Hindun, S.P., M.M.',
        'kategori'      => 'Direksi',
        'jabatan'       => 'Direktur Utama',
        'foto'          => 'http://wakalumibprscoid.local/wp-content/uploads/2026/10/WhatsApp-Image-2026-09-23-at-11.45.08-AM-e1792482502383.jpeg',
        'riwayat_karir' => "• Direktur Utama PT. BPRS Wakalumi (2026 – saat ini)\n• Manajer IT & Pelaporan PT. BPRS Baiturridha Pusaka (2025 – 2026)\n• Direktur Operasional yang Membawahi Fungsi Kepatuhan PT. BPRS AlSalaam Amal Salman (2021 – 2025)\n• Direktur Operasional PT. BPRS AlSalaam Amal Salman (2017 – 2021)\n• Kepala Divisi Operasional & Funding PT. BPRS AlSalaam Amal Salman (2014 – 2017)\n• Kepala Cabang PT. BPRS AlSalaam Amal Salman (2012 – 2014)\n• Supervisor Layanan & Operasional PT. BPRS AlSalaam Amal Salman (2006 – 2012)",
        'pendidikan'    => "• Magister Manajemen (S2), UPN Veteran Jawa Timur, Lulus Tahun 2026.\n• Sarjana Pertanian (S1), Universitas Brawijaya (UB) Malang, Lulus Tahun 2002.",
        'sertifikasi'   => 'Sertifikasi Direktur BPR/BPRS Tingkat II (OJK / Certif), Sertifikasi Manajemen Risiko Perbankan Syariah, Sertifikasi Fungsi Kepatuhan Perbankan.',
        'kutipan'       => 'Transformasi layanan digital dan operational excellence adalah komitmen kami dalam menghadirkan perbankan syariah yang modern dan maslahat.',
        'status'        => 'Aktif',
        'urutan'        => 5,
    ],
    [
        'nama'          => 'Lukman Nugroho, S.E.',
        'kategori'      => 'Direksi',
        'jabatan'       => 'Direktur Bisnis',
        'foto'          => 'http://wakalumibprscoid.local/wp-content/uploads/2026/10/WhatsApp-Image-2026-09-22-at-2-removebackgrounds-ai-1.png',
        'riwayat_karir' => "• Anggota Direksi / Direktur Bisnis PT. BPRS Wakalumi (Oktober 2026 – saat ini)\n• Manajer Marketing Area KSPPS Tamzis Bina Utama (2013 – 2026)\n• Manajer Marketing Cabang KSPPS Tamzis Bina Utama (2007 – 2013)\n• Marketing Officer KSPPS Tamzis Bina Utama (2005 – 2007)",
        'pendidikan'    => 'Sarjana Ekonomi (S1) Program Studi Manajemen, STIE Widya Wiwaha Yogyakarta, Lulus Tahun 2016.',
        'sertifikasi'   => 'Sertifikasi Direksi BPR/BPRS (OJK), Sertifikasi Manajemen Risiko Perbankan Syariah, Analisis Pembiayaan Produktif UMKM.',
        'kutipan'       => 'Mendampingi pengusaha mikro dan UMKM untuk tumbuh bersama melalui pembiayaan syariah yang solutif, amanah, dan berkah.',
        'status'        => 'Aktif',
        'urutan'        => 6,
    ],
];

$pengurus_list = get_option( 'options_pengurus_list', false );
if ( empty( $pengurus_list ) || ! is_array( $pengurus_list ) ) {
    $pengurus_list = $default_pengurus;
}

// Sort by urutan
usort( $pengurus_list, function( $a, $b ) {
    return ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 );
});

/**
 * Helper: Parse string pendidikan menjadi array butir yang rapi & terstruktur
 */
if ( ! function_exists( 'wakalumi_parse_education' ) ) {
    function wakalumi_parse_education( $text ) {
        $text = trim( (string) $text );
        if ( empty( $text ) ) return [];

        $raw = preg_split( '/[\r\n│]+/', $text );
        $clean = [];
        foreach ( $raw as $r ) {
            $r = trim( $r );
            if ( ! empty( $r ) ) {
                if ( strpos( $r, '•' ) !== false ) {
                    $parts = explode( '•', $r );
                    foreach ( $parts as $p ) {
                        $p = trim( $p, " \t\n\r\0\x0B-•" );
                        if ( ! empty( $p ) ) $clean[] = $p;
                    }
                } else {
                    $p = trim( $r, " \t\n\r\0\x0B-•" );
                    if ( ! empty( $p ) ) $clean[] = $p;
                }
            }
        }
        return $clean;
    }
}

/**
 * Helper: Parse string sertifikasi menjadi array butir yang rapi & terstruktur
 */
if ( ! function_exists( 'wakalumi_parse_certifications' ) ) {
    function wakalumi_parse_certifications( $text ) {
        $text = trim( (string) $text );
        if ( empty( $text ) ) return [];

        // Jika memiliki baris baru atau lebih dari 1 bullet symbol
        if ( preg_match( '/[\r\n│]/', $text ) || substr_count( $text, '•' ) > 1 ) {
            $raw = preg_split( '/[\r\n│]+/', $text );
            $clean = [];
            foreach ( $raw as $r ) {
                $r = trim( $r );
                if ( ! empty( $r ) ) {
                    if ( strpos( $r, '•' ) !== false ) {
                        $parts = explode( '•', $r );
                        foreach ( $parts as $p ) {
                            $p = trim( $p, " \t\n\r\0\x0B-•" );
                            if ( ! empty( $p ) ) $clean[] = $p;
                        }
                    } else {
                        $clean[] = trim( $r, " \t\n\r\0\x0B-•" );
                    }
                }
            }
            return $clean;
        }

        // Jika satu baris: pisahkan berdasarkan koma di luar tanda kurung
        $parts = preg_split( '/,(?![^\(\)]*\))/', $text );
        $clean = [];
        foreach ( $parts as $p ) {
            $p = trim( $p, " \t\n\r\0\x0B-•." );
            if ( ! empty( $p ) ) $clean[] = $p;
        }
        return $clean;
    }
}

// Group counts for stats
$count_dps = 0;
$count_kom = 0;
$count_dir = 0;
foreach ( $pengurus_list as $p ) {
    $kat = $p['kategori'] ?? '';
    if ( $kat === 'Dewan Pengawas Syariah' ) $count_dps++;
    elseif ( $kat === 'Dewan Komisaris' ) $count_kom++;
    elseif ( $kat === 'Direksi' ) $count_dir++;
}

// Category styling config (Seragam & Konsisten: Brand Wakalumi Teal & Emerald)
$cat_config = [
    'Dewan Pengawas Syariah' => [
        'color'      => 'teal',
        'badge_bg'   => 'bg-teal-100/90 dark:bg-teal-950/80 text-teal-800 dark:text-teal-300 border-teal-300/80 dark:border-teal-700/60',
        'glow'       => 'shadow-teal-500/20',
        'ring'       => 'ring-teal-400',
        'accent_bar' => 'from-teal-400 via-primary-500 to-teal-600',
        'abbr'       => 'DPS',
        'dot'        => 'bg-teal-400',
    ],
    'Dewan Komisaris' => [
        'color'      => 'emerald',
        'badge_bg'   => 'bg-emerald-100/90 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300 border-emerald-300/80 dark:border-emerald-700/60',
        'glow'       => 'shadow-emerald-500/20',
        'ring'       => 'ring-emerald-400',
        'accent_bar' => 'from-emerald-400 via-primary-500 to-teal-600',
        'abbr'       => 'KOM',
        'dot'        => 'bg-emerald-400',
    ],
    'Direksi' => [
        'color'      => 'cyan',
        'badge_bg'   => 'bg-cyan-100/90 dark:bg-cyan-950/80 text-cyan-800 dark:text-cyan-300 border-cyan-300/80 dark:border-cyan-700/60',
        'glow'       => 'shadow-cyan-500/20',
        'ring'       => 'ring-cyan-400',
        'accent_bar' => 'from-cyan-400 via-primary-500 to-teal-600',
        'abbr'       => 'DIR',
        'dot'        => 'bg-cyan-400',
    ],
];

// Org Chart
$show_orgchart  = get_option( 'options_pengurus_orgchart_show', '1' );
$orgchart_image = get_option( 'options_pengurus_orgchart_image', '' );
$orgchart_desc  = get_option( 'options_pengurus_orgchart_desc', 'Struktur hierarki dan tata kelola BPRS Wakalumi yang menghubungkan Rapat Umum Pemegang Saham (RUPS), Dewan Komisaris, Dewan Pengawas Syariah, dan Direksi.' );

// OJK Fit & Proper Test Notice (Admin Manageable)
$show_ojk_notice  = get_option( 'options_pengurus_ojk_notice_show', '1' );
$ojk_notice_badge = get_option( 'options_pengurus_ojk_notice_badge', 'Keterbukaan Informasi Regulasi' );
$ojk_notice_title = get_option( 'options_pengurus_ojk_notice_title', 'Posisi Direktur dalam Proses Penilaian Kemampuan & Kepatutan (Fit & Proper Test) OJK' );
$ojk_notice_desc  = get_option( 'options_pengurus_ojk_notice_desc', 'Sesuai dengan POJK tentang Penilaian Kemampuan dan Kepatutan bagi Pihak Utama Lembaga Jasa Keuangan, posisi Direktur BPRS Wakalumi saat ini tengah menjalani tahapan proses perizinan resmi di Otoritas Jasa Keuangan (OJK). Seluruh aktivitas operasional dan pelayanan perbankan kepada nasabah tetap berjalan dengan pengawasan penuh dari Dewan Komisaris dan Dewan Pengawas Syariah (DPS).' );

// CTA
$show_cta      = get_option( 'options_pengurus_cta_show', '1' );
$cta_badge     = get_option( 'options_pengurus_cta_badge', 'Bergabung Bersama Kami' );
$cta_title     = get_option( 'options_pengurus_cta_title', 'Siap Mempercayakan Dana Anda pada Kepemimpinan Profesional Syariah?' );
$cta_desc      = get_option( 'options_pengurus_cta_desc', 'Konsultasikan kebutuhan perbankan syariah Anda bersama tim profesional Bank Syariah Wakalumi, atau temukan solusi simpanan dan pembiayaan yang tepat untuk masa depan finansial Anda.' );
$cta_desc      = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $cta_desc );
$cta_btn1_text = get_option( 'options_pengurus_cta_btn1_text', 'Hubungi via WhatsApp' );
$cta_btn1_url  = get_option( 'options_pengurus_cta_btn1_url', '' );
$cta_btn2_text = get_option( 'options_pengurus_cta_btn2_text', 'Jelajahi Produk Kami' );
$cta_btn2_url  = get_option( 'options_pengurus_cta_btn2_url', home_url( '/produk' ) );

$wa_number = get_option( 'options_contact_wa', '6281517380388' );
$wa_url    = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );
if ( empty( $cta_btn1_url ) ) {
    $cta_btn1_url = $wa_url;
}

$total_members = count( $pengurus_list );
?>

<!-- ========================================
     HEADER BANNER & BREADCRUMBS (UNIFIED HERO + GCG GOVERNANCE CARD)
     ======================================== -->
<section class="wkl-page-hero pb-16 sm:pb-20 md:pb-24">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-80 bg-gradient-to-b from-teal-500/10 via-primary-500/5 to-transparent blur-3xl pointer-events-none"></div>

    <div class="container-wide relative z-10">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs md:text-sm text-slate-500 dark:text-slate-400 mb-6" data-aos="fade-down">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary-600 dark:hover:text-teal-400 transition-colors flex items-center gap-1.5 font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-slate-600 dark:text-slate-300 font-medium">Profil</span>
            <span class="text-slate-300 dark:text-slate-600">/</span>
            <span class="text-teal-600 dark:text-teal-400 font-bold">Susunan Pengurus</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            <!-- Left Column: Title, Subtitle & Highlights -->
            <div class="lg:col-span-7 xl:col-span-8" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full mb-4 bg-teal-100/80 dark:bg-teal-950/60 border border-teal-300/60 dark:border-teal-700/50 text-teal-800 dark:text-teal-300 text-xs font-bold uppercase tracking-wider shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                    <span><?php echo esc_html( $page_badge ); ?></span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-[1.15] mb-4">
                    <?php echo esc_html( $page_title ); ?>
                </h1>

                <?php if ( ! empty( $page_subtitle ) ) : ?>
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                        <?php echo esc_html( $page_subtitle ); ?>
                    </p>
                <?php endif; ?>

                <!-- Key Highlights Pills -->
                <div class="flex flex-wrap items-center gap-3 pt-6 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        <span>Prinsip Good Corporate Governance (GCG)</span>
                    </div>
                    <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white/90 dark:bg-dark-card/90 backdrop-blur-md border border-slate-200 dark:border-dark-border shadow-xs font-medium">
                        <svg class="w-4 h-4 text-teal-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                        <span>Sertifikasi OJK &amp; DSN-MUI</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Executive Governance & Emblem Badge Card -->
            <div class="lg:col-span-5 xl:col-span-4" data-aos="fade-up" data-aos-delay="100">
                <div class="spotlight-card relative overflow-hidden rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-teal-200/80 dark:border-teal-800/60 shadow-xl hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 group cursor-default">
                    <div class="h-1.5 w-full bg-gradient-to-r from-teal-500 via-cyan-400 to-emerald-500"></div>

                    <div class="p-6 bg-gradient-to-br from-teal-50/90 via-cyan-50/40 to-white dark:from-teal-950/70 dark:via-slate-900/60 dark:to-slate-900 border-b border-teal-100/80 dark:border-slate-800 relative overflow-hidden text-center">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-[30%] w-36 h-36 opacity-[0.055] dark:opacity-[0.04] pointer-events-none transition-all duration-700 ease-out group-hover:left-full group-hover:-translate-x-1/2 group-hover:scale-125 group-hover:opacity-[0.09] select-none">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain brightness-0 dark:brightness-100">
                        </div>

                        <div class="relative w-16 h-16 rounded-2xl bg-white dark:bg-slate-800 flex items-center justify-center p-2.5 mx-auto shadow-md shadow-teal-500/10 border border-teal-200/80 dark:border-teal-700/60 group-hover:scale-105 transition-transform duration-300 z-10 mb-3">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled3.png' ); ?>" alt="Logo Bank Syariah Wakalumi" class="w-full h-full object-contain">
                        </div>

                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-teal-100/90 dark:bg-teal-950 text-teal-800 dark:text-teal-300 text-[10px] font-extrabold uppercase tracking-wider mb-1 relative z-10">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                            Kepemimpinan &amp; Pengawasan
                        </div>
                        <h3 class="text-lg font-black text-slate-900 dark:text-white relative z-10">Tata Kelola Amanah &amp; Profesional</h3>
                    </div>

                    <div class="p-6 space-y-4 bg-white dark:bg-slate-900/95 relative z-10 text-center">
                        <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                            Sinergi pengawasan Dewan Komisaris, Dewan Pengawas Syariah (DPS), dan manajemen eksekutif dalam menjaga kepercayaan nasabah.
                        </p>
                        <div class="pt-2 border-t border-slate-100 dark:border-slate-800 flex items-center justify-center gap-3 text-[11px] font-bold text-slate-600 dark:text-slate-300">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                <?php echo esc_html( $total_members ); ?> Jajaran Pengurus
                            </span>
                            <span class="text-slate-300 dark:text-slate-600">•</span>
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-teal-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Kepatuhan GCG
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ========================================
     GCG STATS BAR (FLOATING OVERLAY CARDS)
     ======================================== -->
<section class="relative z-20 -mt-8 sm:-mt-10 mb-8 md:mb-12">
    <div class="container-wide">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3.5 sm:gap-4 md:gap-5" data-aos="fade-up" data-aos-delay="100">
            <!-- Total Pengurus -->
            <div class="relative rounded-2xl sm:rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-slate-200/90 dark:border-slate-700/80 p-4 md:p-5 text-center shadow-lg shadow-slate-900/5 dark:shadow-black/20 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-primary-500/10 dark:bg-primary-400/10 text-primary-600 dark:text-teal-400 mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                </div>
                <div class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    <?php echo esc_html( $total_members ); ?>
                </div>
                <div class="text-xs md:text-sm text-slate-600 dark:text-slate-200 font-medium mt-1">Total Pengurus Aktif</div>
            </div>

            <!-- DPS -->
            <div class="relative rounded-2xl sm:rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-slate-200/90 dark:border-slate-700/80 p-4 md:p-5 text-center shadow-lg shadow-slate-900/5 dark:shadow-black/20 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                </div>
                <div class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    <?php echo esc_html( $count_dps ); ?>
                </div>
                <div class="text-xs md:text-sm text-slate-600 dark:text-slate-200 font-medium mt-1">Dewan Pengawas Syariah</div>
            </div>

            <!-- Komisaris -->
            <div class="relative rounded-2xl sm:rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-slate-200/90 dark:border-slate-700/80 p-4 md:p-5 text-center shadow-lg shadow-slate-900/5 dark:shadow-black/20 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-teal-500/10 text-primary-600 dark:text-teal-400 mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/></svg>
                </div>
                <div class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    <?php echo esc_html( $count_kom ); ?>
                </div>
                <div class="text-xs md:text-sm text-slate-600 dark:text-slate-200 font-medium mt-1">Dewan Komisaris</div>
            </div>

            <!-- Direksi (Dynamic & Seragam) -->
            <div class="relative rounded-2xl sm:rounded-3xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-slate-200/90 dark:border-slate-700/80 p-4 md:p-5 text-center shadow-lg shadow-slate-900/5 dark:shadow-black/20 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-teal-500/10 text-primary-600 dark:text-teal-400 mb-2 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                </div>
                <div class="text-2xl md:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    <?php echo esc_html( $count_dir ); ?>
                </div>
                <div class="text-xs md:text-sm text-slate-600 dark:text-slate-200 font-medium mt-1">Direksi</div>
            </div>
        </div>
    </div>
</section>


<!-- ========================================
     GCG INTRO NARRATIVE
     ======================================== -->
<?php if ( ! empty( $page_intro ) ) : ?>
<section class="mb-10 md:mb-14">
    <div class="container-wide">
        <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
            <p class="text-sm md:text-base text-slate-600 dark:text-slate-400 leading-relaxed font-normal">
                <?php echo esc_html( $page_intro ); ?>
            </p>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================================================
     DESKTOP: STICKY SCROLL-DRIVEN EXECUTIVE SPOTLIGHT (Stage & Floating Dock)
     Visible on lg+ screens (>= 1024px)
     ======================================================================== -->
<?php if ( $total_members > 0 ) : 
    // Calculate total scroll height based on number of members (60vh base for Overview + 45vh per member for smooth responsive card switching)
    $scroll_height_vh = 60 + ( $total_members * 45 );
?>
<section id="executive-spotlight-section" 
         class="hidden lg:block relative" 
         style="height: <?php echo $scroll_height_vh; ?>vh;"
         data-total-members="<?php echo $total_members; ?>">

    <!-- STICKY VIEWPORT CONTAINER (PowerPoint Morph Parallax) -->
    <div id="executive-sticky-stage" 
         class="is-overview sticky top-20 h-[calc(100vh-5rem)] flex flex-col justify-center overflow-hidden py-4 z-10">

        <div class="w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 flex flex-col justify-between min-h-[660px] h-[680px] relative z-10">

            <!-- ══════════════════════════════════════════════════════════════════════════
                 TOP STAGE HEADER: OVERVIEW TITLE vs SPOTLIGHT CONTROLS
                 ══════════════════════════════════════════════════════════════════════════ -->
            <div class="relative h-14 shrink-0 flex items-center justify-between">
                <!-- Overview Header (Rest State) -->
                <div class="morph-header-overview absolute inset-0 flex items-center justify-between transition-all duration-300">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-500/10 dark:bg-primary-400/10 border border-primary-500/20 text-xs font-bold uppercase tracking-wider text-primary-700 dark:text-teal-300">
                            <span class="w-2 h-2 rounded-full bg-primary-500 dark:bg-teal-400 animate-pulse"></span>
                            <?php 
                            $org_titles = [];
                            if ( $count_dps > 0 ) $org_titles[] = 'DPS';
                            if ( $count_kom > 0 ) $org_titles[] = 'Dewan Komisaris';
                            if ( $count_dir > 0 ) $org_titles[] = 'Direksi';
                            echo ! empty( $org_titles ) ? esc_html( implode( ' • ', $org_titles ) ) : 'Susunan Pengurus';
                            ?>
                        </span>
                        <span class="text-xs text-slate-300 dark:text-slate-700 hidden xl:inline">|</span>
                        <span class="text-xs font-bold text-slate-600 dark:text-slate-300 hidden xl:inline">Jajaran Pimpinan Berintegritas</span>
                    </div>
                    <div class="text-xs font-semibold text-slate-400 dark:text-slate-500 flex items-center gap-1.5">
                        <span>Pilih tokoh atau gulir ke bawah</span>
                        <svg class="w-3.5 h-3.5 animate-bounce text-primary-500 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    </div>
                </div>

                <!-- Spotlight Controls (Morphed State) -->
                <div class="morph-header-spotlight absolute inset-0 flex items-center justify-between transition-all duration-300">
                    <div class="flex items-center gap-3">
                        <button type="button" id="exec-btn-back-overview" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-primary-50 dark:hover:bg-primary-900/30 text-slate-700 dark:text-slate-200 shadow-sm transition-all hover:scale-105 active:scale-95" title="Kembali ke tampilan semua tokoh">
                            <svg class="w-3.5 h-3.5 text-primary-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                            <span>Semua Tokoh</span>
                        </button>
                        <span class="text-slate-300 dark:text-slate-700">|</span>
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Kategori:</span>
                        <div id="exec-category-pills" class="flex items-center gap-2">
                            <button type="button" class="exec-filter-btn active px-3 py-1 rounded-full text-xs font-semibold transition-all bg-primary-600 text-white shadow-sm" data-filter="all">Semua (<?php echo $total_members; ?>)</button>
                            <?php if ( $count_dps > 0 ) : ?>
                                <button type="button" class="exec-filter-btn px-3 py-1 rounded-full text-xs font-semibold transition-all bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700" data-filter="Dewan Pengawas Syariah">DPS (<?php echo $count_dps; ?>)</button>
                            <?php endif; ?>
                            <?php if ( $count_kom > 0 ) : ?>
                                <button type="button" class="exec-filter-btn px-3 py-1 rounded-full text-xs font-semibold transition-all bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700" data-filter="Dewan Komisaris">Komisaris (<?php echo $count_kom; ?>)</button>
                            <?php endif; ?>
                            <?php if ( $count_dir > 0 ) : ?>
                                <button type="button" class="exec-filter-btn px-3 py-1 rounded-full text-xs font-semibold transition-all bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700" data-filter="Direksi">Direksi (<?php echo $count_dir; ?>)</button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Progress Counter & Steppers -->
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
                            <span id="exec-current-counter" class="text-sm font-extrabold text-primary-600 dark:text-teal-400">01</span>
                            <span class="text-xs text-slate-400">/</span>
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400"><?php echo sprintf( '%02d', $total_members ); ?></span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <button type="button" id="exec-btn-prev" class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-primary-50 dark:hover:bg-primary-900/30 text-slate-700 dark:text-slate-200 flex items-center justify-center transition-all disabled:opacity-30 disabled:pointer-events-none shadow-sm" aria-label="Sebelumnya">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button type="button" id="exec-btn-next" class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-primary-50 dark:hover:bg-primary-900/30 text-slate-700 dark:text-slate-200 flex items-center justify-center transition-all disabled:opacity-30 disabled:pointer-events-none shadow-sm" aria-label="Selanjutnya">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ══════════════════════════════════════════════════════════════════════════
                 THE POWERPOINT MORPH STAGE CONTAINER (520px)
                 Holds all persistent .exec-morph-card elements
                 ══════════════════════════════════════════════════════════════════════════ -->
            <div id="exec-morph-stage" class="exec-morph-stage">
                <?php 
                $gap_pct    = ( $total_members > 4 ) ? 1.4 : 2.0;
                $card_w_pct = ( 100.0 - ( $gap_pct * ( $total_members - 1 ) ) ) / $total_members;
                
                foreach ( $pengurus_list as $index => $item ) : 
                    $kategori  = $item['kategori'] ?? 'Dewan Komisaris';
                    $cfg       = $cat_config[ $kategori ] ?? $cat_config['Dewan Komisaris'];
                    $init_left = $index * ( $card_w_pct + $gap_pct );
                ?>
                <div class="exec-morph-card group rounded-3xl bg-white dark:bg-slate-900/95 border border-slate-200/80 dark:border-slate-700/80 shadow-lg hover:shadow-2xl transition-all duration-300"
                     id="exec-card-<?php echo $index; ?>"
                     data-index="<?php echo $index; ?>"
                     data-kategori="<?php echo esc_attr( $kategori ); ?>"
                     data-card-mode="overview"
                     style="left: <?php echo esc_attr( $init_left ); ?>%; top: 0%; width: <?php echo esc_attr( $card_w_pct ); ?>%; height: 100%;">

                    <!-- Top Gradient Accent Bar for this card -->
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r <?php echo $cfg['accent_bar']; ?> z-20"></div>

                    <!-- SUB-VIEW 1: OVERVIEW CARD (Rest / All-members lineup - Padat, Rapi & Elegan) -->
                    <div class="morph-view-overview flex flex-col justify-between h-full">
                        <!-- Portrait Photo (Proporsional & Mengisi Kartu) -->
                        <div class="relative w-full h-[270px] xl:h-[290px] overflow-hidden bg-slate-100 dark:bg-slate-800 border-b border-slate-100 dark:border-slate-800 shrink-0">
                            <?php if ( ! empty( $item['foto'] ) ) : ?>
                                <img src="<?php echo esc_url( $item['foto'] ); ?>" 
                                     alt="<?php echo esc_attr( $item['nama'] ); ?>" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <?php else : ?>
                                <div class="relative w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-teal-50 via-cyan-50/70 to-emerald-100/60 dark:from-teal-950/80 dark:via-slate-900 dark:to-emerald-950/60 overflow-hidden">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="absolute w-40 h-40 object-contain opacity-[0.08] dark:opacity-[0.06] group-hover:scale-125 group-hover:rotate-6 transition-all duration-700 pointer-events-none">
                                    <div class="relative z-10 w-16 h-16 rounded-2xl bg-white/90 dark:bg-slate-800/90 border border-teal-200/80 dark:border-teal-700/60 p-3 shadow-md group-hover:scale-110 transition-transform duration-500">
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled3.png' ); ?>" alt="" class="w-full h-full object-contain">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Subtle glass shine gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent pointer-events-none"></div>

                            <!-- Category Pill Overlay (Top Left on Photo - Solid High Contrast) -->
                            <div class="absolute top-3 left-3 z-10">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider backdrop-blur-md shadow-md bg-slate-900/90 text-white border border-white/20">
                                    <span class="w-1.5 h-1.5 rounded-full <?php echo $cfg['dot']; ?>"></span>
                                    <span><?php echo esc_html( $cfg['abbr'] ); ?></span>
                                </span>
                            </div>

                            <!-- Status Pill (Bottom Left on Photo) -->
                            <div class="absolute bottom-2.5 left-3 z-10">
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider backdrop-blur-md bg-slate-900/70 text-white border border-white/20 shadow-xs">
                                    <span class="w-1.5 h-1.5 rounded-full <?php echo ( ( $item['status'] ?? '' ) === 'Proses Perizinan OJK' ) ? 'bg-amber-400' : 'bg-emerald-400'; ?> animate-pulse"></span>
                                    <span><?php echo esc_html( $item['status'] ?? 'Aktif' ); ?></span>
                                </span>
                            </div>
                        </div>

                        <!-- Text Info, Cuplikan Rekam Jejak Terkini & Prompt Interaktif -->
                        <div class="flex-1 flex flex-col justify-between p-3.5 xl:p-4 text-center">
                            <!-- Identitas Singkat -->
                            <div>
                                <div class="text-[11px] xl:text-xs font-bold text-primary-600 dark:text-teal-400 uppercase tracking-wide truncate">
                                    <?php echo esc_html( $item['jabatan'] ); ?>
                                </div>
                                <h3 class="text-xs sm:text-sm xl:text-base font-extrabold text-slate-900 dark:text-white line-clamp-2 leading-snug mt-1">
                                    <?php echo esc_html( $item['nama'] ); ?>
                                </h3>
                            </div>

                            <!-- Cuplikan Rekam Jejak Terkini (Penyeimbang Ruang Vertikal) -->
                            <?php 
                            $raw_karir = preg_split( '/\r\n|\r|\n|│/', trim( $item['riwayat_karir'] ?? '' ) );
                            $karir_terkini = [];
                            foreach ( $raw_karir as $rk ) {
                                $rk = trim( $rk );
                                if ( ! empty( $rk ) ) {
                                    $karir_terkini[] = ltrim( $rk, "•- \t\n\r\0\x0B" );
                                }
                            }
                            $top_karir = array_slice( $karir_terkini, 0, 2 );
                            ?>
                            <div class="my-auto py-1.5">
                                <div class="p-2.5 rounded-xl bg-slate-50/90 dark:bg-slate-800/80 border border-slate-100 dark:border-slate-700/60 text-left">
                                    <div class="flex items-center gap-1.5 text-[9px] uppercase font-bold text-slate-400 dark:text-teal-400/90 mb-1.5 tracking-wider">
                                        <svg class="w-3 h-3 text-primary-500 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                        <span>Rekam Jejak Terkini</span>
                                    </div>
                                    <div class="space-y-1">
                                        <?php if ( ! empty( $top_karir ) ) : ?>
                                            <?php foreach ( $top_karir as $tk ) : ?>
                                                <div class="flex items-start gap-1.5 text-[10.5px] xl:text-[11px] font-semibold text-slate-700 dark:text-slate-200 leading-tight">
                                                    <span class="w-1 h-1 rounded-full bg-teal-500 mt-1.5 shrink-0"></span>
                                                    <span class="line-clamp-1" title="<?php echo esc_attr( $tk ); ?>"><?php echo esc_html( $tk ); ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <p class="text-[11px] text-slate-500 dark:text-slate-400 italic">Profil kepemimpinan syariah</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Prompt (Buka Profil) -->
                            <div class="pt-2 border-t border-slate-100 dark:border-slate-800/80">
                                <div class="w-full py-1.5 px-2.5 rounded-xl bg-primary-50/80 dark:bg-primary-950/40 group-hover:bg-primary-600 text-primary-700 dark:text-teal-300 group-hover:text-white transition-all duration-300 text-xs font-bold flex items-center justify-center gap-1 shadow-2xs">
                                    <span>Lihat Profil</span>
                                    <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SUB-VIEW 2: DOCK CARD (Compact mini-card on the right) -->
                    <div class="morph-view-dock flex items-center gap-3.5">
                        <!-- Mini Photo -->
                        <div class="relative shrink-0 w-14 h-14 rounded-2xl overflow-hidden bg-slate-100 dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 shadow-sm">
                            <?php if ( ! empty( $item['foto'] ) ) : ?>
                                <img src="<?php echo esc_url( $item['foto'] ); ?>" 
                                     alt="<?php echo esc_attr( $item['nama'] ); ?>" 
                                     class="w-full h-full object-cover">
                            <?php else : ?>
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-teal-50 to-emerald-50 dark:from-teal-950 dark:to-slate-900 p-2.5">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled3.png' ); ?>" alt="" class="w-full h-full object-contain">
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Details -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full <?php echo $cfg['badge_bg']; ?>">
                                    <?php echo esc_html( $cfg['abbr'] ); ?>
                                </span>
                                <span class="text-xs font-bold text-primary-600 dark:text-teal-300 truncate">
                                    <?php echo esc_html( $item['jabatan'] ); ?>
                                </span>
                            </div>
                            <h4 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white truncate">
                                <?php echo esc_html( $item['nama'] ); ?>
                            </h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo ( ( $item['status'] ?? '' ) === 'Proses Perizinan OJK' ) ? 'bg-amber-500' : 'bg-emerald-500'; ?>"></span>
                                <span><?php echo esc_html( $item['status'] ?? 'Aktif' ); ?></span>
                            </p>
                        </div>

                        <!-- Right Chevron -->
                        <div class="shrink-0 text-slate-300 dark:text-slate-600">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                        </div>
                    </div>

                    <!-- SUB-VIEW 3: SPOTLIGHT CARD (Expanded full dossier on the left - 2 Kolom Asli, Foto Proporsional & Bebas Tabrakan) -->
                    <div class="morph-view-spotlight flex flex-col justify-between h-full box-border">
                        <!-- TOP & MIDDLE BODY (Grid 12 Kolom: Kiri Foto & Status, Kanan Dossier Lengkap) -->
                        <div class="grid grid-cols-12 gap-6 xl:gap-8 items-start flex-1 min-h-0 overflow-hidden">
                            
                            <!-- KOLOM KIRI (col-span-4): Foto Showcase Lebih Besar, Status, Kategori & Kutipan Integritas -->
                            <div class="col-span-4 flex flex-col items-center text-center h-full justify-start shrink-0">
                                <!-- Foto Portrait Showcase Eksekutif (Lebih Besar & Berwibawa) -->
                                <div class="relative w-44 h-52 xl:w-48 xl:h-56 shrink-0 rounded-2xl p-1 bg-gradient-to-br from-teal-400/40 via-primary-500/20 to-transparent shadow-xl">
                                    <div class="w-full h-full rounded-[14px] overflow-hidden bg-slate-100 dark:bg-slate-800 border-2 border-white/80 dark:border-slate-700">
                                        <?php if ( ! empty( $item['foto'] ) ) : ?>
                                            <img src="<?php echo esc_url( $item['foto'] ); ?>" 
                                                 alt="<?php echo esc_attr( $item['nama'] ); ?>" 
                                                 class="w-full h-full object-cover">
                                        <?php else : ?>
                                            <div class="relative w-full h-full flex items-center justify-center bg-gradient-to-br from-teal-50 via-cyan-50 to-emerald-100/60 dark:from-teal-950 dark:via-slate-900 dark:to-emerald-950/60 overflow-hidden">
                                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="absolute w-32 h-32 object-contain opacity-10">
                                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled3.png' ); ?>" alt="" class="relative z-10 w-16 h-16 object-contain">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- Status Badge Pill -->
                                    <div class="absolute -bottom-2.5 inset-x-2 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider <?php echo ( ( $item['status'] ?? '' ) === 'Proses Perizinan OJK' ) ? 'bg-amber-500' : 'bg-emerald-500'; ?> text-white shadow-md flex items-center justify-center gap-1.5 border-2 border-white dark:border-slate-900 truncate">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse shrink-0"></span>
                                        <span class="truncate"><?php echo esc_html( $item['status'] ?? 'Aktif' ); ?></span>
                                    </div>
                                </div>

                                <!-- Category Badge -->
                                <div class="mt-4 shrink-0">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider <?php echo $cfg['badge_bg']; ?> border border-primary-500/20 shadow-xs">
                                        <?php echo esc_html( $item['kategori'] ); ?>
                                    </span>
                                </div>

                                <!-- Kutipan Integritas di Bawah Foto (Lengkap, Elegan & Adaptif) -->
                                <?php if ( ! empty( $item['kutipan'] ) ) : ?>
                                <div class="mt-3 px-0.5 w-full shrink-0">
                                    <div class="p-2.5 xl:p-3 rounded-2xl bg-slate-50/90 dark:bg-slate-800/80 border border-slate-100 dark:border-slate-700/60 shadow-2xs text-left">
                                        <div class="flex items-start gap-1.5">
                                            <svg class="w-3.5 h-3.5 text-primary-500 dark:text-teal-400 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                            </svg>
                                            <div class="flex-1 max-h-[125px] xl:max-h-[140px] overflow-y-auto no-scrollbar">
                                                <p class="text-[11px] xl:text-[11.5px] italic text-slate-700 dark:text-slate-200 leading-relaxed font-medium">
                                                    "<?php echo esc_html( $item['kutipan'] ); ?>"
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- KOLOM KANAN (col-span-8): Jabatan, Nama, Riwayat Rekam Jejak, Pendidikan & Sertifikasi -->
                            <div class="col-span-8 flex flex-col h-full min-h-0 justify-between">
                                <!-- Header Identitas (Shrink-0) -->
                                <div class="shrink-0 pb-1.5 border-b border-slate-100 dark:border-slate-800/80">
                                    <div class="text-xs sm:text-sm font-extrabold text-primary-600 dark:text-teal-400 tracking-wider uppercase">
                                        <?php echo esc_html( $item['jabatan'] ); ?>
                                    </div>
                                    <h2 class="text-2xl xl:text-3xl font-black text-slate-900 dark:text-white tracking-tight leading-snug mt-0.5 truncate">
                                        <?php echo esc_html( $item['nama'] ); ?>
                                    </h2>
                                </div>

                                <!-- Dossier Scrollable Body (Guaranteed Safe from Collision with Custom Smooth Scrollbar) -->
                                <div class="flex-1 min-h-0 overflow-y-auto custom-scroll space-y-3.5 pt-2.5 pr-1.5">
                                    <!-- Bagian Riwayat & Rekam Jejak -->
                                    <div>
                                        <div class="flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-teal-400 mb-1.5">
                                            <svg class="w-4 h-4 text-primary-500 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                            <span>Riwayat & Rekam Jejak</span>
                                        </div>

                                        <?php 
                                        $raw_lines = preg_split( '/\r\n|\r|\n|│/', trim( $item['riwayat_karir'] ?? '' ) );
                                        $clean_lines = [];
                                        foreach ( $raw_lines as $l ) {
                                            $l = trim( $l );
                                            if ( ! empty( $l ) ) {
                                                $clean_lines[] = ltrim( $l, "•- \t\n\r\0\x0B" );
                                            }
                                        }
                                        $total_lines = count( $clean_lines );
                                        $is_dense = ( $total_lines > 6 );
                                        ?>

                                        <?php if ( $is_dense ) : ?>
                                            <!-- 2 Kolom Kompak: 13 Poin Terpampang Rapi & Jelas Tanpa Tabrakan -->
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-1 text-xs xl:text-[12.5px] text-slate-700 dark:text-slate-200 font-medium leading-snug">
                                                <?php foreach ( $clean_lines as $line ) : ?>
                                                    <div class="flex items-start gap-1.5">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500 mt-1.5 shrink-0"></span>
                                                        <span class="flex-1"><?php echo esc_html( $line ); ?></span>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else : ?>
                                            <!-- 1 Kolom Rapi untuk 3-6 Poin -->
                                            <div class="space-y-1.5 text-xs sm:text-sm text-slate-700 dark:text-slate-200 font-medium">
                                                <?php foreach ( $clean_lines as $line ) : ?>
                                                    <div class="flex items-start gap-2 leading-relaxed">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500 mt-2 shrink-0"></span>
                                                        <span class="flex-1"><?php echo esc_html( $line ); ?></span>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Bagian Pendidikan & Sertifikasi (2 Kolom Berdampingan Tanpa Truncate) -->
                                    <?php 
                                    $edu_items  = wakalumi_parse_education( $item['pendidikan'] ?? '' );
                                    $cert_items = wakalumi_parse_certifications( $item['sertifikasi'] ?? '' );
                                    ?>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1 shrink-0">
                                        <!-- Card Pendidikan Lengkap -->
                                        <div class="rounded-2xl bg-slate-50/90 dark:bg-slate-800/80 p-3 border border-slate-100 dark:border-slate-700/60 shadow-xs flex flex-col justify-start">
                                            <div class="flex items-center justify-between pb-1.5 border-b border-slate-200/60 dark:border-slate-700/40 mb-2">
                                                <div class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-teal-300">
                                                    <svg class="w-3.5 h-3.5 text-primary-500 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342"/></svg>
                                                    <span>Pendidikan</span>
                                                </div>
                                                <?php if ( count( $edu_items ) > 1 ) : ?>
                                                    <span class="text-[9px] font-extrabold px-1.5 py-0.5 rounded-full bg-teal-50 dark:bg-teal-950/60 text-teal-600 dark:text-teal-300 border border-teal-200/50 dark:border-teal-800/40">
                                                        <?php echo count( $edu_items ); ?> Jenjang
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <?php if ( ! empty( $edu_items ) ) : ?>
                                                <div class="space-y-1.5">
                                                    <?php foreach ( $edu_items as $edu_line ) : ?>
                                                        <div class="flex items-start gap-2 text-xs font-semibold text-slate-800 dark:text-slate-100 leading-snug">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-primary-500 dark:bg-teal-400 mt-1.5 shrink-0"></span>
                                                            <span class="flex-1"><?php echo esc_html( $edu_line ); ?></span>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php else : ?>
                                                <p class="text-xs text-slate-400 dark:text-slate-500 italic">—</p>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Card Sertifikasi Lengkap -->
                                        <div class="rounded-2xl bg-slate-50/90 dark:bg-slate-800/80 p-3 border border-slate-100 dark:border-slate-700/60 shadow-xs flex flex-col justify-start">
                                            <div class="flex items-center justify-between pb-1.5 border-b border-slate-200/60 dark:border-slate-700/40 mb-2">
                                                <div class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-teal-300">
                                                    <svg class="w-3.5 h-3.5 text-primary-500 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                                                    <span>Sertifikasi & Lisensi</span>
                                                </div>
                                                <?php if ( count( $cert_items ) > 1 ) : ?>
                                                    <span class="text-[9px] font-extrabold px-1.5 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-300 border border-emerald-200/50 dark:border-emerald-800/40">
                                                        <?php echo count( $cert_items ); ?> Lisensi
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <?php if ( ! empty( $cert_items ) ) : ?>
                                                <div class="space-y-1.5">
                                                    <?php foreach ( $cert_items as $cert_line ) : ?>
                                                        <div class="flex items-start gap-2 text-xs font-semibold text-slate-800 dark:text-slate-100 leading-snug">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                                                            <span class="flex-1"><?php echo esc_html( $cert_line ); ?></span>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php else : ?>
                                                <p class="text-xs text-slate-400 dark:text-slate-500 italic">—</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BOTTOM NAVIGATION BAR (Permanen di Bawah & Bebas Tabrakan) -->
                        <div class="pt-2.5 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs text-slate-400 shrink-0">
                            <div class="flex items-center gap-3">
                                <span class="font-extrabold text-primary-600 dark:text-teal-400 text-xs sm:text-sm">Tokoh <?php echo sprintf('%02d', $index + 1); ?> dari <?php echo sprintf('%02d', $total_members); ?></span>
                                <div class="w-32 sm:w-40 bg-slate-100 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-gradient-to-r from-teal-400 to-primary-600 h-full rounded-full transition-all duration-300" style="width: <?php echo ( ( $index + 1 ) / $total_members ) * 100; ?>%;"></div>
                                </div>
                            </div>
                            <div class="flex items-center gap-1.5 text-xs font-semibold text-slate-500 dark:text-slate-400">
                                <span>Gulir atau klik untuk berpindah tokoh</span>
                                <svg class="w-3.5 h-3.5 text-primary-500 dark:text-teal-400 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                            </div>
                        </div>
                    </div>

                </div>
                <?php endforeach; ?>
            </div>

            <!-- ══════════════════════════════════════════════════════════════════════════
                 BOTTOM FOOTER STATUS HINT
                 ══════════════════════════════════════════════════════════════════════════ -->
            <div class="h-8 shrink-0 flex items-center justify-between text-xs text-slate-400 dark:text-slate-500 border-t border-slate-200/40 dark:border-slate-800/40 pt-2">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-primary-500 dark:bg-teal-400 animate-pulse"></span>
                    <span>Tata Kelola Perusahaan yang Baik (Good Corporate Governance)</span>
                </div>
                <div class="flex items-center gap-1 text-[11px]">
                    <kbd class="px-1.5 py-0.5 rounded bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 font-mono">Scroll</kbd>
                    <span>atau</span>
                    <kbd class="px-1.5 py-0.5 rounded bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 font-mono">Klik</kbd>
                    <span>untuk menjelajah</span>
                </div>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================================================
     MOBILE & TABLET VIEW: EXECUTIVE DIRECTORY & BOTTOM SHEET DRAWER (< 1024px)
     Skema 1: Direktori Seluruh Pengurus + Laci Detail Lengkap Interaktif
     ======================================================================== -->
<section id="exec-mobile-showcase" class="block lg:hidden py-10 px-4 sm:px-6 bg-slate-50/60 dark:bg-dark border-b border-slate-100 dark:border-slate-800">
    <div class="max-w-xl mx-auto">
        
        <!-- Mobile Section Header & Category Filter Pills -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-primary-500/10 dark:bg-primary-400/10 text-primary-700 dark:text-teal-300 border border-primary-500/20">
                    <span class="w-2 h-2 rounded-full bg-primary-500 dark:bg-teal-400 animate-pulse"></span>
                    Jajaran Kepemimpinan
                </span>
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">
                    Total <?php echo $total_members; ?> Tokoh
                </span>
            </div>
            
            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white tracking-tight">
                Susunan Pengurus BPRS Wakalumi
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-1 leading-relaxed">
                Ketuk kartu tokoh untuk membaca rekam jejak, riwayat pendidikan, sertifikasi, dan komitmen integritas.
            </p>

            <!-- Filter Pills (Semua, DPS, Komisaris, Direksi) -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1 mt-4 scrollbar-none" id="mob-filter-pills">
                <button type="button" 
                        class="mob-filter-btn px-3.5 py-1.5 rounded-full text-xs font-bold transition-all bg-primary-600 text-white shadow-sm shrink-0" 
                        data-filter="all">
                    Semua (<?php echo $total_members; ?>)
                </button>
                <?php if ( $count_dps > 0 ) : ?>
                <button type="button" 
                        class="mob-filter-btn px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 shrink-0" 
                        data-filter="Dewan Pengawas Syariah">
                    DPS (<?php echo $count_dps; ?>)
                </button>
                <?php endif; ?>
                <?php if ( $count_kom > 0 ) : ?>
                <button type="button" 
                        class="mob-filter-btn px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 shrink-0" 
                        data-filter="Dewan Komisaris">
                    Komisaris (<?php echo $count_kom; ?>)
                </button>
                <?php endif; ?>
                <?php if ( $count_dir > 0 ) : ?>
                <button type="button" 
                        class="mob-filter-btn px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 shrink-0" 
                        data-filter="Direksi">
                    Direksi (<?php echo $count_dir; ?>)
                </button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Mobile Executive Cards Directory List -->
        <div class="space-y-4" id="mob-exec-list">
            <?php foreach ( $pengurus_list as $mi => $item ) : 
                $kat = $item['kategori'] ?? 'Dewan Komisaris';
                $cfg = $cat_config[ $kat ] ?? $cat_config['Dewan Komisaris'];
                
                // Ambil 1-2 rekam jejak terkini
                $raw_lines = preg_split( '/\r\n|\r|\n|│/', trim( $item['riwayat_karir'] ?? '' ) );
                $clean_karir = [];
                foreach ( $raw_lines as $rk ) {
                    $rk = trim( $rk );
                    if ( ! empty( $rk ) ) $clean_karir[] = ltrim( $rk, "•- \t\n\r\0\x0B" );
                }
                $top_karir = array_slice( $clean_karir, 0, 2 );
            ?>
            <div class="mob-exec-item rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/90 dark:border-slate-800 shadow-sm hover:shadow-md transition-all active:scale-[0.99] cursor-pointer overflow-hidden group"
                 data-mob-card-index="<?php echo $mi; ?>"
                 data-mob-kategori="<?php echo esc_attr( $kat ); ?>">
                
                <!-- Top Accent Bar -->
                <div class="h-1.5 bg-gradient-to-r <?php echo $cfg['accent_bar']; ?>"></div>

                <div class="p-4 sm:p-5">
                    <!-- Top Row: Photo + Identity -->
                    <div class="flex items-center gap-3.5 sm:gap-4">
                        <!-- Portrait Photo Thumbnail (Clean & Unobstructed, Wajah Tokoh Terlihat Jelas) -->
                        <div class="w-20 h-24 sm:w-24 sm:h-28 rounded-2xl overflow-hidden shrink-0 border-2 border-slate-100 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 shadow-sm">
                            <?php if ( ! empty( $item['foto'] ) ) : ?>
                                <img src="<?php echo esc_url( $item['foto'] ); ?>" 
                                     alt="<?php echo esc_attr( $item['nama'] ); ?>" 
                                     class="w-full h-full object-cover">
                            <?php else : ?>
                                <div class="w-full h-full flex items-center justify-center bg-teal-50 dark:bg-slate-800 p-2">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled3.png' ); ?>" alt="" class="w-full h-full object-contain">
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Identity Info -->
                        <div class="flex-1 min-w-0">
                            <!-- Category Badge + Jabatan Row -->
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[9px] font-extrabold uppercase tracking-wider <?php echo $cfg['badge_bg']; ?>">
                                    <span class="w-1 h-1 rounded-full <?php echo $cfg['dot']; ?>"></span>
                                    <span><?php echo esc_html( $cfg['abbr'] ); ?></span>
                                </span>
                                <span class="text-[11px] sm:text-xs font-bold text-primary-600 dark:text-teal-400 uppercase tracking-wide truncate">
                                    <?php echo esc_html( $item['jabatan'] ); ?>
                                </span>
                            </div>
                            <h3 class="text-base sm:text-lg font-black text-slate-900 dark:text-white leading-snug line-clamp-2">
                                <?php echo esc_html( $item['nama'] ); ?>
                            </h3>
                            <div class="mt-1 flex items-center gap-1.5 text-[11px] font-semibold text-slate-500 dark:text-slate-400">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo ( ( $item['status'] ?? '' ) === 'Proses Perizinan OJK' ) ? 'bg-amber-400' : 'bg-emerald-400'; ?> animate-pulse"></span>
                                <span><?php echo esc_html( $item['status'] ?? 'Aktif' ); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Rekam Jejak Terkini Box -->
                    <?php if ( ! empty( $top_karir ) ) : ?>
                    <div class="mt-3.5 p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800/80 border border-slate-100 dark:border-slate-700/60">
                        <div class="flex items-center gap-1 text-[9px] uppercase font-bold text-slate-400 dark:text-teal-400/90 mb-1 tracking-wider">
                            <svg class="w-3 h-3 text-primary-500 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                            <span>Rekam Jejak Terkini</span>
                        </div>
                        <div class="space-y-1">
                            <?php foreach ( $top_karir as $tk ) : ?>
                            <div class="flex items-start gap-1.5 text-[11px] font-semibold text-slate-700 dark:text-slate-200 leading-tight">
                                <span class="w-1 h-1 rounded-full bg-teal-500 mt-1.5 shrink-0"></span>
                                <span class="line-clamp-1"><?php echo esc_html( $tk ); ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Action Button Prompt -->
                    <div class="mt-3 pt-2.5 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs font-bold text-primary-600 dark:text-teal-400 group-hover:text-primary-700 dark:group-hover:text-teal-300">
                        <span>Lihat Profil & Riwayat Lengkap</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- ══════════════════════════════════════════════════════════════════════════
         EXECUTIVE BOTTOM SHEET DRAWER (MODAL LACI DETAIL LENGKAP)
         ══════════════════════════════════════════════════════════════════════════ -->
    <!-- Drawer Backdrop Overlay -->
    <div id="mob-drawer-backdrop" 
         class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-[9998] transition-opacity duration-300 opacity-0 pointer-events-none"
         aria-hidden="true"></div>

    <!-- Drawer Container -->
    <div id="mob-drawer" 
         class="fixed inset-x-0 bottom-0 max-h-[92vh] bg-white dark:bg-slate-900 rounded-t-[28px] border-t border-slate-200/80 dark:border-slate-700/80 z-[9999] flex flex-col shadow-2xl transition-transform duration-300 ease-out translate-y-full pointer-events-none"
         role="dialog" aria-modal="true" aria-labelledby="mob-drawer-name">

        <!-- Top Drag Handle & Close Bar -->
        <div class="pt-3 pb-2 px-5 shrink-0 flex items-center justify-between border-b border-slate-100 dark:border-slate-800">
            <div class="w-8"></div><!-- Spacer for centering handle -->
            <div class="w-12 h-1.5 rounded-full bg-slate-300 dark:bg-slate-700 cursor-pointer" id="mob-drawer-handle" title="Tutup laci"></div>
            <button type="button" id="mob-drawer-close" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 flex items-center justify-center transition-colors text-sm font-bold shadow-2xs" aria-label="Tutup">
                ✕
            </button>
        </div>

        <!-- Drawer Member Header (Shrink-0) -->
        <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-slate-800 flex items-center gap-4 shrink-0 bg-slate-50/70 dark:bg-slate-800/40">
            <!-- Big Photo Showcase (Clean & Unobstructed) -->
            <div class="w-20 h-24 sm:w-24 sm:h-28 rounded-2xl overflow-hidden shrink-0 border-2 border-primary-500/30 dark:border-teal-500/40 shadow-sm bg-slate-100 dark:bg-slate-800">
                <img id="mob-drawer-img" src="" alt="" class="w-full h-full object-cover">
            </div>

            <!-- Identity -->
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-1.5 mb-1 flex-wrap">
                    <span id="mob-drawer-kategori" class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-teal-500/10 text-teal-700 dark:text-teal-300 border border-teal-500/20">
                        DPS
                    </span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700">
                        <span id="mob-drawer-status-dot" class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span id="mob-drawer-status">Aktif</span>
                    </span>
                </div>
                <div id="mob-drawer-role" class="text-xs font-bold text-primary-600 dark:text-teal-400 uppercase tracking-wider truncate">
                    Ketua Dewan Pengawas Syariah
                </div>
                <h3 id="mob-drawer-name" class="text-lg sm:text-xl font-black text-slate-900 dark:text-white leading-snug mt-0.5 truncate">
                    Haryanto, S.E., M.M.
                </h3>
            </div>
        </div>

        <!-- Drawer Scrollable Body -->
        <div class="flex-1 min-h-0 overflow-y-auto p-4 sm:p-5 space-y-4" id="mob-drawer-body">
            <!-- Riwayat & Rekam Jejak (Lengkap) -->
            <div>
                <div class="flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-teal-400 mb-2">
                    <svg class="w-4 h-4 text-primary-500 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                    <span>Riwayat & Rekam Jejak</span>
                </div>
                <div id="mob-drawer-karir" class="space-y-1.5 text-xs sm:text-sm text-slate-800 dark:text-slate-100 font-medium">
                    <!-- Populated via JS -->
                </div>
            </div>

            <!-- Pendidikan & Sertifikasi (2 Cards) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 pt-1">
                <div class="rounded-xl bg-slate-50 dark:bg-slate-800/80 p-3 border border-slate-100 dark:border-slate-700/60 shadow-2xs">
                    <div class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-teal-300">
                        <svg class="w-3.5 h-3.5 text-primary-500 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342"/></svg>
                        <span>Pendidikan</span>
                    </div>
                    <div id="mob-drawer-pendidikan" class="text-xs font-semibold text-slate-900 dark:text-white mt-1.5 leading-snug">
                        <!-- Populated via JS -->
                    </div>
                </div>

                <div class="rounded-xl bg-slate-50 dark:bg-slate-800/80 p-3 border border-slate-100 dark:border-slate-700/60 shadow-2xs">
                    <div class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-teal-300">
                        <svg class="w-3.5 h-3.5 text-primary-500 dark:text-teal-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                        <span>Sertifikasi & Lisensi</span>
                    </div>
                    <div id="mob-drawer-sertifikasi" class="text-xs font-semibold text-slate-900 dark:text-white mt-1.5 leading-snug">
                        <!-- Populated via JS -->
                    </div>
                </div>
            </div>

            <!-- Kutipan Integritas (Adaptive) -->
            <div id="mob-drawer-quote-wrap" class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/80 border border-slate-100 dark:border-slate-700/60 shadow-2xs flex items-start gap-2">
                <svg class="w-4 h-4 text-primary-500 dark:text-teal-400 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                <p id="mob-drawer-quote" class="text-xs italic text-slate-700 dark:text-slate-200 leading-relaxed font-medium">
                    <!-- Populated via JS -->
                </p>
            </div>
        </div>

        <!-- Drawer Sticky Bottom Navigation Controls (Shrink-0) -->
        <div class="shrink-0 p-3.5 sm:p-4 bg-slate-50/90 dark:bg-slate-800/90 border-t border-slate-200/80 dark:border-slate-700/80 flex items-center justify-between gap-3">
            <button type="button" id="mob-drawer-prev" class="px-3.5 py-2 rounded-xl bg-white dark:bg-slate-700 hover:bg-slate-100 dark:hover:bg-slate-600 text-xs font-bold text-slate-700 dark:text-slate-200 shadow-sm border border-slate-200 dark:border-slate-600 flex items-center gap-1.5 transition-all disabled:opacity-30 disabled:pointer-events-none active:scale-95">
                <svg class="w-3.5 h-3.5 text-primary-600 dark:text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                <span>Sebelumnya</span>
            </button>

            <div class="flex items-center gap-2">
                <span id="mob-drawer-counter" class="text-xs font-extrabold text-primary-600 dark:text-teal-400 whitespace-nowrap">Tokoh 01 dari 06</span>
            </div>

            <button type="button" id="mob-drawer-next" class="px-3.5 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-xs font-bold text-white shadow-sm flex items-center gap-1.5 transition-all disabled:opacity-30 disabled:pointer-events-none active:scale-95">
                <span>Selanjutnya</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>
</section>


<!-- ========================================
     DIREKSI TRANSPARENCY CARD (OJK STATUS)
     Mandatory governance note on director vacancy (Admin manageable & toggleable)
     ======================================== -->
<?php if ( '1' === (string) $show_ojk_notice ) : ?>
<section class="py-12 md:py-16 bg-slate-50 dark:bg-dark-surface border-y border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="max-w-4xl mx-auto rounded-3xl overflow-hidden border border-amber-200/80 dark:border-amber-800/40 bg-gradient-to-br from-amber-50/90 via-white to-amber-50/40 dark:from-amber-950/20 dark:via-dark-surface dark:to-amber-950/10 shadow-sm p-6 sm:p-8 md:p-10" data-aos="fade-up">
            
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 mb-5">
                <div class="w-14 h-14 rounded-2xl bg-amber-100 dark:bg-amber-400/10 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                </div>
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-100 dark:bg-amber-400/10 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-700/40 mb-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                        <?php echo esc_html( $ojk_notice_badge ); ?>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white">
                        <?php echo esc_html( $ojk_notice_title ); ?>
                    </h3>
                </div>
            </div>

            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed mb-6 font-normal">
                <?php echo nl2br( esc_html( $ojk_notice_desc ) ); ?>
            </p>

            <div class="flex flex-wrap items-center gap-3">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-white dark:bg-slate-800 border border-amber-200 dark:border-amber-700/40 text-xs font-semibold text-amber-800 dark:text-amber-300 shadow-sm">
                    <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                    Kepatuhan Tata Kelola OJK
                </span>
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-300 shadow-sm">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    Operasional Bank Berjalan Normal & Aman
                </span>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     BAGAN STRUKTUR ORGANISASI (OPTIONAL)
     ======================================== -->
<?php if ( $show_orgchart && ! empty( $orgchart_image ) ) : ?>
<section class="py-14 md:py-20 bg-white dark:bg-dark border-b border-slate-100 dark:border-slate-800">
    <div class="container-wide">
        <div class="text-center mb-8" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-primary-500/10 text-primary-700 dark:bg-primary-400/10 dark:text-teal-300 border border-primary-500/20 dark:border-primary-400/20 mb-3">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                Bagan Struktur Organisasi
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                Struktur Organisasi Perusahaan
            </h2>
            <?php if ( ! empty( $orgchart_desc ) ) : ?>
                <p class="text-sm md:text-base text-slate-600 dark:text-slate-300 mt-3 max-w-2xl mx-auto font-normal">
                    <?php echo esc_html( $orgchart_desc ); ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="max-w-4xl mx-auto" data-aos="zoom-in" data-aos-delay="100">
            <div class="rounded-3xl overflow-hidden border border-slate-200/80 dark:border-slate-700/80 shadow-xl bg-slate-50 dark:bg-slate-900/95 cursor-pointer group relative" id="orgchart-container">
                <img src="<?php echo esc_url( $orgchart_image ); ?>" 
                     alt="Bagan Struktur Organisasi Bank Syariah Wakalumi" 
                     class="w-full h-auto group-hover:scale-[1.02] transition-transform duration-500"
                     loading="lazy">
                <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/10 transition-colors flex items-center justify-center pointer-events-none">
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity px-4 py-2 rounded-full bg-white/90 dark:bg-slate-800/95 text-xs font-bold text-slate-900 dark:text-white shadow-lg backdrop-blur-sm">
                        🔍 Klik untuk memperbesar
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<!-- ========================================
     CTA SECTION
     ======================================== -->
<?php if ( $show_cta ) : ?>
<section class="py-16 md:py-24 bg-white dark:bg-dark border-t border-slate-200/60 dark:border-slate-800/60">
    <div class="container-wide">
        <div class="relative rounded-3xl p-8 sm:p-12 md:p-16 overflow-hidden bg-gradient-to-br from-primary-900 via-primary-950 to-slate-950 text-white shadow-2xl shadow-primary-900/20 border border-primary-500/30 text-center" data-aos="zoom-in">
            <div class="absolute right-0 bottom-0 translate-x-1/4 translate-y-1/4 w-80 h-80 opacity-[0.06] pointer-events-none">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/wm-wkl.png" alt="" class="w-full h-full object-contain">
            </div>
            
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

<!-- Pass data to JS via JSON script -->
<script type="application/json" id="wkl-pengurus-data">
<?php echo json_encode( array_values( $pengurus_list ), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?>
</script>

<?php get_footer(); ?>
