<?php
/**
 * Wakalumi Theme — Admin Baitul Maal BSW (Sosial Syariah & Literasi ZISWAF)
 * Submenu of wakalumi-settings (Pengaturan Website)
 *
 * Mengelola konten halaman "Baitul Maal BSW" (/baitul-maal)
 * Mendukung manajemen menu sidebar dinamis (Tambah/Edit/Hapus/Urutkan),
 * 8 variasi tema warna profesional, 16 variasi ikon SVG, serta kontrol saklar (toggle)
 * modul konten yang 100% fleksibel (baik untuk informasi sosial umum, kegiatan santunan,
 * pemberdayaan umat, maupun edukasi ZISWAF) + fitur Tambah Blok Seksi Kustom Bebas.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ─────────────────────────────────────────────────────────────────────────────
// 0. HELPER IKON SVG & SKEMA WARNA BAITUL MAAL (16 IKON & 8 WARNA PROFESIONAL)
// ─────────────────────────────────────────────────────────────────────────────
if ( ! function_exists( 'wakalumi_get_bm_icon_options' ) ) {
    function wakalumi_get_bm_icon_options(): array {
        return [
            'heart'        => 'Heart (Kepedulian & Kasih Sayang)',
            'hand-heart'   => 'Hand Heart (Santunan & Bantuan Sosial)',
            'sparkles'     => 'Sparkles (Manfaat & Keberkahan)',
            'target'       => 'Target (Tujuan & Fokus Program)',
            'users'        => 'Users (Masyarakat & Penerima Manfaat)',
            'shield-check' => 'Shield Check (Amanah & Kepatuhan Syariah)',
            'academic-cap' => 'Academic Cap (Pendidikan & Literasi)',
            'briefcase'    => 'Briefcase (Pemberdayaan Ekonomi & UMKM)',
            'building'     => 'Building (Masjid, Lembaga & Sarana Umum)',
            'scale'        => 'Scale (Keadilan & Keseimbangan Sosial)',
            'book-open'    => 'Book Open (Edukasi, Panduan & Al-Quran)',
            'globe'        => 'Globe (Kemaslahatan & Lingkungan)',
            'banknotes'    => 'Banknotes (Pengelolaan Dana Kebajikan)',
            'light-bulb'   => 'Light Bulb (Inisiatif & Solusi Kebaikan)',
            'chart-bar'    => 'Chart Bar (Pertumbuhan & Dampak Nyata)',
            'check-badge'  => 'Check Badge (Terverifikasi & Transparan)',
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_bm_color_options' ) ) {
    function wakalumi_get_bm_color_options(): array {
        return [
            'teal'    => 'Teal (Hijau Toska Khas BSW)',
            'emerald' => 'Emerald (Hijau Zamrud Syariah)',
            'blue'    => 'Blue (Biru Samudera Profesional)',
            'indigo'  => 'Indigo (Biru Royal Elegan)',
            'amber'   => 'Amber (Emas Hangat & Berkah)',
            'purple'  => 'Purple (Ungu Violet Modern)',
            'sky'     => 'Sky (Biru Langit Cerah)',
            'cyan'    => 'Cyan (Biru Kehijauan Segar)',
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_bm_svg_icon' ) ) {
    function wakalumi_get_bm_svg_icon( string $icon = 'heart', string $class = 'w-5 h-5' ): string {
        $cls = esc_attr( $class );
        switch ( $icon ) {
            case 'hand-heart':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25c-1.554-1.425-4.13-1.356-5.586.197-1.457 1.553-1.38 4.065.174 5.588L12 19.25l5.412-5.215c1.554-1.523 1.631-4.035.174-5.588-1.456-1.553-4.032-1.622-5.586-.197z"/><path stroke-linecap="round" stroke-linejoin="round" d="M3 15.75h2.25l3 2.25h7.5l3-2.25H21"/></svg>';
            case 'sparkles':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/></svg>';
            case 'target':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 100-6 3 3 0 000 6z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2m0 14v2m9-9h-2M5 12H3"/></svg>';
            case 'users':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>';
            case 'shield-check':
            case 'shield':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>';
            case 'academic-cap':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/></svg>';
            case 'briefcase':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/></svg>';
            case 'building':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg>';
            case 'scale':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971z"/></svg>';
            case 'book-open':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>';
            case 'globe':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582"/></svg>';
            case 'banknotes':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/></svg>';
            case 'light-bulb':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.516 0c.85.493 1.508 1.333 1.508 2.316V18"/></svg>';
            case 'chart-bar':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>';
            case 'check-badge':
            case 'check-circle':
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>';
            case 'heart':
            default:
                return '<svg class="' . $cls . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>';
        }
    }
}

// ─────────────────────────────────────────────────────────────────────────────
// 1. DATA DEFAULT & HELPER PENGAMBILAN OPSI (3 MENU SIDEBAR VARIATIF & PROFESIONAL)
// ─────────────────────────────────────────────────────────────────────────────
function wakalumi_get_default_baitul_maal_items() {
    return [
        // MENU SIDEBAR 1: TENTANG BAITUL MAAL (Contoh Tampilan Simpel & Berwarna: Tujuan, Sasaran, Manfaat)
        [
            'id'                    => 'tentang-baitul-maal',
            'title'                 => 'Mengenal Baitul Maal Bank Syariah Wakalumi',
            'short_title'           => 'Tentang Baitul Maal',
            'badge'                 => 'Fungsi Sosial Syariah',
            'icon'                  => 'heart',
            'color'                 => 'teal',
            'summary'               => 'Peran kepedulian sosial, tujuan, sasaran, dan manfaat Baitul Maal.',
            'intro'                 => 'Dalam sistem perbankan syariah, di samping menjalankan fungsi intermediasi keuangan (Baitul Tamwil), terdapat nilai kepedulian sosial (Baitul Maal) sebagai wujud komitmen terhadap kemaslahatan dan pemberdayaan umat secara berkelanjutan.',
            'main_image'            => '',
            'main_image_caption'    => '',
            'main_quote'            => '"Perumpamaan orang-orang yang menafkahkan hartanya di jalan Allah adalah serupa dengan sebutir benih yang menumbuhkan tujuh bulir, pada tiap-tiap bulir seratus biji. Allah melipatgandakan (ganjaran) bagi siapa yang Dia kehendaki." (QS. Al-Baqarah: 261)',
            'main_content'          => "Baitul Maal merupakan fungsi pengelolaan dan penyaluran dana sosial keagamaan yang berlandaskan prinsip amanah, transparansi, serta kepatuhan terhadap ketentuan syariah.\n\nMelalui fungsi sosial ini, lembaga keuangan syariah berperan sebagai jembatan kebaikan yang menghubungkan kepedulian para dermawan dengan masyarakat yang membutuhkan, guna mendorong terciptanya keseimbangan sosial dan penguatan ekonomi umat di lingkungan sekitar.",
            // Modul 1: Deretan Kartu Informasi Berikon (Tanpa Kata 'Pilar', Warna Variatif)
            'show_pillars'          => true,
            'pillars_section_title' => 'Tujuan, Sasaran & Manfaat Utama',
            'pillars_section_badge' => '3 Pokok Bahasan',
            'pillar_cards'          => [
                [
                    'title' => 'Tujuan',
                    'badge' => 'Arah & Orientasi',
                    'icon'  => 'target',
                    'color' => 'teal',
                    'desc'  => "Menghimpun dan mengelola dana sosial syariah secara amanah, transparan, dan terarah.\nMenyalurkan manfaat dana kebajikan secara tepat guna sesuai ketentuan syariah.\nMenumbuhkan semangat kepedulian dan literasi keuangan sosial Islam di tengah masyarakat.",
                ],
                [
                    'title' => 'Sasaran',
                    'badge' => 'Penerima Manfaat',
                    'icon'  => 'users',
                    'color' => 'blue',
                    'desc'  => "Masyarakat prasejahtera dan golongan penerima manfaat (mustahik) di wilayah sekitar.\nPelaku usaha mikro dan kecil yang membutuhkan penguatan kapasitas kemandirian.\nKegiatan sosial, pendidikan, dakwah, serta sarana kemaslahatan umum.",
                ],
                [
                    'title' => 'Manfaat',
                    'badge' => 'Dampak Kebaikan',
                    'icon'  => 'sparkles',
                    'color' => 'amber',
                    'desc'  => "Menyucikan harta dan menghadirkan keberkahan bagi para penunai dana kebajikan.\nMeringankan beban kebutuhan dasar sekaligus mendorong kemandirian ekonomi penerima manfaat.\nMemperkuat ukhuwah dan solidaritas sosial antara lembaga, nasabah, dan masyarakat.",
                ],
            ],
            // Modul 2, 3, 4 Nonaktif pada Menu 1 agar tampil ringkas & fokus
            'show_zakat'            => false,
            'zakat_color'           => 'teal',
            'zakat_icon'            => 'scale',
            'zakat_badge'           => 'Prinsip & Ketentuan',
            'zakat_title'           => '',
            'zakat_desc'            => '',
            'zakat_quote'           => '',
            'zakat_asnaf_title'     => '',
            'zakat_asnaf_subtitle'  => '',
            'zakat_asnaf_list'      => [],
            'zakat_syarat_title'    => '',
            'zakat_syarat_subtitle' => '',
            'zakat_syarat_list'     => [],
            'show_sedekah'          => false,
            'sedekah_color'         => 'amber',
            'sedekah_icon'          => 'hand-heart',
            'sedekah_badge'         => '',
            'sedekah_title'         => '',
            'sedekah_image'         => '',
            'sedekah_desc'          => '',
            'sedekah_quote'         => '',
            'sedekah_points_title'  => '',
            'sedekah_points'        => [],
            'show_wakaf'            => false,
            'wakaf_color'           => 'indigo',
            'wakaf_icon'            => 'building',
            'wakaf_badge'           => '',
            'wakaf_title'           => '',
            'wakaf_desc'            => '',
            'wakaf_quote'           => '',
            'wakaf_keunggulan_title'=> '',
            'wakaf_keunggulan_list' => [],
            'wakaf_program_title'   => '',
            'wakaf_program_list'    => [],
            'custom_sections'       => [],
            'show_gallery'          => false,
            'gallery_title'         => 'Dokumentasi & Infografis Sosial',
            'media_gallery'         => [],
            'show_faqs'             => true,
            'faq_section_title'     => 'Tanya Jawab Seputar Baitul Maal',
            'faqs'                  => [
                [
                    'q' => 'Apa perbedaan antara fungsi Baitul Maal dan Baitul Tamwil?',
                    'a' => 'Baitul Tamwil berfokus pada kegiatan layanan intermediasi keuangan dan perbankan syariah yang bersifat komersial/produktif (seperti tabungan, deposito, dan pembiayaan sesuai akad syariah). Sedangkan Baitul Maal berfokus pada pengelolaan serta penyaluran dana sosial dan kebajikan umat yang bersifat nirlaba untuk kemaslahatan masyarakat.'
                ],
                [
                    'q' => 'Bagaimana prinsip pengelolaan dana sosial pada Baitul Maal?',
                    'a' => 'Pengelolaan dana sosial berpedoman pada prinsip kepatuhan syariah, amanah, pencatatan yang terpisah dari dana operasional komersial, serta penyaluran yang tepat sasaran kepada golongan yang berhak menerima.'
                ],
            ],
        ],

        // MENU SIDEBAR 2: PROGRAM SOSIAL & KEMASLAHATAN (Bukan hanya Zakat: Menampilkan Fokus Kegiatan Sosial, Pendidikan, Ekonomi & Kemaslahatan)
        [
            'id'                    => 'program-sosial-kemaslahatan',
            'title'                 => 'Ruang Lingkup Kegiatan Sosial & Kemaslahatan Umat',
            'short_title'           => 'Program & Kemaslahatan',
            'badge'                 => 'Aksi & Kepedulian Sosial',
            'icon'                  => 'hand-heart',
            'color'                 => 'blue',
            'summary'               => 'Fokus kepedulian sosial, santunan, pendidikan, dan pemberdayaan masyarakat.',
            'intro'                 => 'Kegiatan Baitul Maal tidak hanya terbatas pada edukasi zakat semata, melainkan mencakup berbagai bentuk kepedulian sosial, santunan kemanusiaan, dukungan literasi pendidikan, serta penguatan kapasitas usaha mikro di lingkungan masyarakat.',
            'main_image'            => '',
            'main_image_caption'    => '',
            'main_quote'            => '"Sebaik-baik manusia adalah yang paling bermanfaat bagi manusia lainnya." (HR. Ahmad & Thabrani)',
            'main_content'          => "Sebagai bagian dari ekosistem keuangan syariah yang dekat dengan masyarakat, Baitul Maal BSW berupaya menghadirkan manfaat nyata melalui program-program sosial yang adaptif, kolaboratif, dan berkelanjutan.\n\nSetiap inisiatif dirancang agar memberikan dampak positif baik secara langsung (karitatif/santunan) maupun jangka panjang (pemberdayaan dan literasi).",
            // Modul 1: 4 Kartu Fokus Bidang dengan 4 Warna & 4 Ikon Berbeda
            'show_pillars'          => true,
            'pillars_section_title' => 'Bidang Fokus Kepedulian & Kemaslahatan',
            'pillars_section_badge' => '4 Fokus Utama',
            'pillar_cards'          => [
                [
                    'title' => 'Sosial & Kemanusiaan',
                    'badge' => 'Santunan & Kepedulian',
                    'icon'  => 'hand-heart',
                    'color' => 'emerald',
                    'desc'  => "Santunan anak yatim dan masyarakat dhuafa di sekitar wilayah operasional.\nKegiatan berbagi berkah Ramadan seperti buka puasa bersama dan pembagian takjil.\nBantuan tanggap kepedulian bagi warga yang terdampak musibah.",
                ],
                [
                    'title' => 'Pendidikan & Literasi',
                    'badge' => 'Edukasi Syariah',
                    'icon'  => 'academic-cap',
                    'color' => 'blue',
                    'desc'  => "Sosialisasi dan edukasi literasi keuangan syariah bagi pelajar, guru, dan masyarakat.\nDukungan sarana penunjang pendidikan dan kegiatan keislaman.\nPeningkatan kesadaran pengelolaan keuangan keluarga yang sehat dan berkah.",
                ],
                [
                    'title' => 'Pemberdayaan Ekonomi',
                    'badge' => 'Kemandirian Umat',
                    'icon'  => 'briefcase',
                    'color' => 'amber',
                    'desc'  => "Pendampingan dan penguatan kapasitas pelaku usaha mikro dan pedagang kecil.\nMendorong budaya menabung dan pengelolaan usaha sesuai prinsip syariah.\nSinergi pemberdayaan komunitas ekonomi lokal agar lebih mandiri.",
                ],
                [
                    'title' => 'Kemaslahatan Umum',
                    'badge' => 'Sarana Ibadah & Komunitas',
                    'icon'  => 'building',
                    'color' => 'purple',
                    'desc'  => "Dukungan pemeliharaan sarana ibadah (masjid/mushalla) dan kegiatan dakwah.\nPartisipasi aktif dalam kegiatan sosial kemasyarakatan di lingkungan sekitar kantor.\nMempererat silaturahmi antara insan perbankan syariah dan tokoh masyarakat.",
                ],
            ],
            'show_zakat'            => false,
            'zakat_color'           => 'teal',
            'zakat_icon'            => 'scale',
            'zakat_badge'           => '',
            'zakat_title'           => '',
            'zakat_desc'            => '',
            'zakat_quote'           => '',
            'zakat_asnaf_title'     => '',
            'zakat_asnaf_subtitle'  => '',
            'zakat_asnaf_list'      => [],
            'zakat_syarat_title'    => '',
            'zakat_syarat_subtitle' => '',
            'zakat_syarat_list'     => [],
            'show_sedekah'          => false,
            'sedekah_color'         => 'amber',
            'sedekah_icon'          => 'hand-heart',
            'sedekah_badge'         => '',
            'sedekah_title'         => '',
            'sedekah_image'         => '',
            'sedekah_desc'          => '',
            'sedekah_quote'         => '',
            'sedekah_points_title'  => '',
            'sedekah_points'        => [],
            // Modul 4 digunakan secara fleksibel untuk Prinsip Tata Kelola & Sinergi Program
            'show_wakaf'            => true,
            'wakaf_color'           => 'indigo',
            'wakaf_icon'            => 'shield-check',
            'wakaf_badge'           => 'Tata Kelola Sosial Syariah',
            'wakaf_title'           => 'Prinsip Pengelolaan & Sinergi Kemaslahatan',
            'wakaf_desc'            => 'Setiap kegiatan sosial dan penyaluran dana kebajikan dilaksanakan dengan mengedepankan prinsip kehati-hatian, tepat sasaran, serta selaras dengan nilai-nilai syariah.',
            'wakaf_quote'           => '',
            'wakaf_keunggulan_title'=> 'Prinsip Tata Kelola Sosial',
            'wakaf_keunggulan_list' => [
                'Kepatuhan Syariah | Seluruh penyaluran dana sosial dipastikan sesuai dengan ketentuan dan fatwa syariah.',
                'Amanah & Akuntabel | Pencatatan dana sosial dikelola secara tertib, transparan, dan dapat dipertanggungjawabkan.',
                'Tepat Sasaran | Mengutamakan penerima manfaat di lingkungan sekitar yang benar-benar membutuhkan.',
                'Keberlanjutan Manfaat | Mendorong program yang memberi nilai tambah jangka panjang bagi masyarakat.',
            ],
            'wakaf_program_title'   => 'Bentuk Kegiatan & Kolaborasi',
            'wakaf_program_list'    => [
                'Kegiatan Sosial Berkala | Penyelenggaraan agenda kepedulian pada momen hari besar Islam dan bulan suci Ramadan.',
                'Sinergi Lembaga & Komunitas | Kolaborasi bersama pengurus masjid, sekolah, dan komunitas masyarakat setempat.',
                'Edukasi & Literasi Terpadu | Penyuluhan keuangan syariah dan pengenalan instrumen dana kebajikan Islam.',
                'Pelayanan Ramah & Terbuka | Membuka ruang komunikasi bagi masyarakat yang ingin bersinergi dalam kebaikan.',
            ],
            'custom_sections'       => [],
            'show_gallery'          => false,
            'gallery_title'         => 'Dokumentasi Kegiatan Sosial',
            'media_gallery'         => [],
            'show_faqs'             => false,
            'faq_section_title'     => 'Tanya Jawab Seputar Program Sosial',
            'faqs'                  => [],
        ],

        // MENU SIDEBAR 3: INFORMASI ZISWAF (Contoh Tampilan Kompleks & Berwarna: Zakat, Infak, Sedekah & Wakaf)
        [
            'id'                    => 'informasi-ziswaf',
            'title'                 => 'Mengenal ZISWAF (Zakat, Infak, Sedekah & Wakaf)',
            'short_title'           => 'Edukasi ZISWAF',
            'badge'                 => 'Literasi Filantropi Islam',
            'icon'                  => 'sparkles',
            'color'                 => 'amber',
            'summary'               => 'Panduan lengkap mengenai zakat, penerima & syarat wajib, infak, sedekah, serta wakaf.',
            'intro'                 => 'ZISWAF (Zakat, Infak, Sedekah, dan Wakaf) merupakan instrumen keuangan sosial Islam yang memiliki peran strategis dalam menyucikan harta, mempererat solidaritas sosial, serta membangun kemandirian ekonomi umat secara berkesinambungan.',
            'main_image'            => '',
            'main_image_caption'    => '',
            'main_quote'            => '"Ambillah zakat dari sebagian harta mereka, dengan zakat itu kamu membersihkan dan mensucikan mereka dan mendoalah untuk mereka. Sesungguhnya doa kamu itu (menjadi) ketenteraman jiwa bagi mereka." (QS. At-Taubah: 103)',
            'main_content'          => "Dalam syariat Islam, setiap harta yang dimiliki seorang Muslim mengandung hak bagi saudara-saudara lainnya yang membutuhkan. Penunaian Zakat sebagai kewajiban rukun Islam, serta pengamalan Infak, Sedekah, dan Wakaf sebagai amal kebajikan utama, menjadi wujud syukur atas nikmat rezeki sekaligus sarana meraih keberkahan harta yang bersih dan produktif.",
            // Modul 1
            'show_pillars'          => false,
            'pillars_section_title' => 'Tujuan, Sasaran & Manfaat',
            'pillars_section_badge' => '3 Pokok Bahasan',
            'pillar_cards'          => [],
            // Modul 2: Seksi Zakat (Warna Teal/Emerald, Ikon Scale)
            'show_zakat'            => true,
            'zakat_color'           => 'teal',
            'zakat_icon'            => 'scale',
            'zakat_badge'           => 'Rukun Islam & Penyucian Harta',
            'zakat_title'           => 'Ketentuan Umum Zakat',
            'zakat_desc'            => 'Zakat adalah bagian tertentu dari harta yang wajib dikeluarkan oleh setiap Muslim apabila telah mencapai syarat yang ditetapkan (nisab dan haul) untuk diserahkan kepada golongan yang berhak menerimanya (mustahik) sesuai ketentuan syariat Islam.',
            'zakat_quote'           => '"Dan dirikanlah shalat, tunaikanlah zakat dan ruku\'lah beserta orang-orang yang ruku\'." (QS. Al-Baqarah: 43)',
            'zakat_asnaf_title'     => 'Golongan Penerima Zakat (8 Asnaf)',
            'zakat_asnaf_subtitle'  => 'Delapan golongan yang berhak menerima penyaluran zakat sesuai QS. At-Taubah ayat 60:',
            'zakat_asnaf_list'      => [
                'Fakir | Orang yang hampir tidak memiliki sesuatu sehingga tidak mampu memenuhi kebutuhan pokok hidupnya.',
                'Miskin | Orang yang memiliki harta atau penghasilan, namun belum mencukupi kebutuhan dasar untuk dirinya dan tanggungannya.',
                'Amil | Pihak yang bertugas menghimpun, mengelola, menjaga, dan menyalurkan dana zakat secara amanah.',
                'Muallaf | Orang yang baru memeluk agama Islam dan membutuhkan penguatan keimanan serta dukungan sosial.',
                'Riqab | Hamba sahaya atau upaya membebaskan umat dari belenggu perbudakan dan penindasan.',
                'Gharimin | Orang yang terlilit utang untuk memenuhi kebutuhan hidup yang halal dan tidak sanggup melunasinya.',
                'Fi Sabilillah | Orang atau kegiatan yang berjuang di jalan Allah demi kemaslahatan, dakwah, dan pendidikan umat.',
                'Ibnu Sabil | Musafir yang sedang dalam perjalanan bukan untuk maksiat dan kehabisan bekal di perjalanan.',
            ],
            'zakat_syarat_title'    => 'Syarat Wajib Zakat',
            'zakat_syarat_subtitle' => 'Ketentuan pokok yang menjadikan harta seorang Muslim wajib dizakati:',
            'zakat_syarat_list'     => [
                'Beragama Islam | Kewajiban zakat berlaku khusus bagi setiap individu Muslim.',
                'Merdeka | Memiliki kebebasan penuh sebagai individu yang merdeka dalam mengelola hartanya.',
                'Kepemilikan Penuh & Halal | Harta diperoleh dengan cara yang halal dan berada dalam penguasaan penuh pemiliknya.',
                'Melampaui Kebutuhan Pokok | Harta tersebut merupakan kelebihan dari kebutuhan dasar hidup diri dan keluarga yang ditanggung.',
                'Mencapai Nisab | Jumlah harta telah mencapai batas minimal wajib zakat sesuai jenis hartanya (misal setara 85 gram emas untuk zakat maal).',
                'Mencapai Haul | Harta telah dimiliki selama genap 1 tahun hijriah (12 bulan qamariyah) untuk jenis harta yang mensyaratkan haul.',
            ],
            // Modul 3: Seksi Infak & Sedekah (Warna Amber, Ikon Hand-Heart)
            'show_sedekah'          => true,
            'sedekah_color'         => 'amber',
            'sedekah_icon'          => 'hand-heart',
            'sedekah_badge'         => 'Amal Kebajikan Setiap Waktu',
            'sedekah_title'         => 'Keutamaan Infak & Sedekah',
            'sedekah_image'         => '',
            'sedekah_desc'          => 'Berbeda dengan zakat yang memiliki batasan nisab dan haul, Infak dan Sedekah bersifat fleksibel serta dapat ditunaikan kapan saja dan dalam jumlah berapa saja. Infak berkaitan dengan pengeluaran harta untuk kebaikan, sedangkan sedekah mencakup segala bentuk kebaikan baik materi maupun non-materi.',
            'sedekah_quote'         => '"Sedekah itu tidaklah mengurangi harta, dan tidaklah Allah menambah bagi seorang hamba yang pemaaf kecuali kemuliaan." (HR. Muslim)',
            'sedekah_points_title'  => 'Hikmah & Keutamaan Infak serta Sedekah',
            'sedekah_points'        => [
                'Menyucikan Jiwa & Harta | Menumbuhkan sifat dermawan, rasa syukur, dan menjauhkan hati dari sifat kikir.',
                'Melipatgandakan Keberkahan Rezeki | Membuka pintu keberkahan dalam usaha, pekerjaan, dan kehidupan keluarga.',
                'Meringankan Beban Sesama | Membantu pemenuhan kebutuhan masyarakat prasejahtera, yatim, dan dhuafa secara langsung.',
                'Naungan di Hari Akhir | Menjadi amal kebajikan yang menaungi dan menyelamatkan seorang mukmin di hari perhitungan.',
            ],
            // Modul 4: Seksi Wakaf (Warna Indigo/Blue, Ikon Building)
            'show_wakaf'            => true,
            'wakaf_color'           => 'indigo',
            'wakaf_icon'            => 'building',
            'wakaf_badge'           => 'Amal Jariyah Abadi',
            'wakaf_title'           => 'Mengenal Wakaf & Wakaf Uang',
            'wakaf_desc'            => 'Wakaf adalah perbuatan hukum wakif (pihak yang mewakafkan) untuk memisahkan dan/atau menyerahkan sebagian harta benda miliknya guna dimanfaatkan selamanya atau untuk jangka waktu tertentu sesuai dengan kepentingannya bagi keperluan ibadah dan/atau kesejahteraan umum menurut syariah.',
            'wakaf_quote'           => '"Apabila manusia meninggal dunia, maka terputuslah amalnya kecuali dari tiga perkara: sedekah jariyah (wakaf), ilmu yang bermanfaat, atau anak shalih yang mendoakannya." (HR. Muslim)',
            'wakaf_keunggulan_title'=> 'Keunggulan Wakaf',
            'wakaf_keunggulan_list' => [
                'Pokok Harta Terjaga Utuh | Nilai pokok aset atau dana wakaf dijaga kelestariannya dan tidak boleh berkurang.',
                'Pahala Jariyah Berkelanjutan | Manfaat hasil pengelolaan wakaf terus mengalirkan pahala meskipun wakif telah wafat.',
                'Inklusif & Terjangkau | Melalui instrumen wakaf uang, masyarakat dapat berwakaf dengan nominal yang terjangkau.',
                'Berdampak Jangka Panjang | Mendukung pembangunan infrastruktur sosial dan pemberdayaan ekonomi lintas generasi.',
            ],
            'wakaf_program_title'   => 'Ruang Lingkup Pemanfaatan Wakaf',
            'wakaf_program_list'    => [
                'Sarana Ibadah & Keagamaan | Dukungan pembangunan dan pemeliharaan masjid, mushalla, serta fasilitas dakwah.',
                'Pendidikan & Literasi Umat | Penyediaan sarana pendidikan, pesantren, beasiswa, dan peningkatan kualitas SDM.',
                'Kesehatan & Sosial Masyarakat | Dukungan layanan kesehatan, santunan sosial, dan fasilitas kemaslahatan umum.',
                'Pemberdayaan Ekonomi Produktif | Pengelolaan aset produktif berbasis syariah yang hasilnya disalurkan bagi kesejahteraan penerima manfaat.',
            ],
            'custom_sections'       => [],
            // Modul 5: Galeri Foto
            'show_gallery'          => false,
            'gallery_title'         => 'Infografis Edukasi ZISWAF',
            'media_gallery'         => [],
            // Modul 6: FAQ
            'show_faqs'             => true,
            'faq_section_title'     => 'Tanya Jawab Seputar Edukasi ZISWAF',
            'faqs'                  => [
                [
                    'q' => 'Apa perbedaan utama antara Zakat, Infak, Sedekah, dan Wakaf?',
                    'a' => 'Zakat hukumnya wajib bagi Muslim yang hartanya telah mencapai batas nisab dan haul, serta disalurkan khusus kepada 8 golongan asnaf. Infak dan Sedekah hukumnya sunnah (anjuran mulia) tanpa batas minimal nominal maupun waktu. Sedangkan Wakaf adalah penyerahan harta yang nilai pokoknya dijaga tetap utuh (tidak habis dikonsumsi), sementara hasil manfaatnya disalurkan secara berkelanjutan untuk kemaslahatan umat.'
                ],
                [
                    'q' => 'Mengapa zakat perlu memperhatikan syarat nisab dan haul?',
                    'a' => 'Nisab adalah batas minimal jumlah harta yang dimiliki, sedangkan haul adalah batas waktu kepemilikan harta selama 1 tahun hijriah. Kedua syarat ini menunjukkan keadilan syariat Islam, di mana kewajiban zakat hanya dibebankan kepada mereka yang telah berkecukupan melebihi kebutuhan pokoknya.'
                ],
            ],
        ],
    ];
}

function wakalumi_get_baitul_maal_settings() {
    $defaults = [
        'breadcrumb_label'    => 'Baitul Maal BSW',
        'kicker'              => 'Kepedulian Sosial & Literasi Syariah',
        'title'               => 'Baitul Maal BSW',
        'subtitle'            => 'Wujud komitmen sosial Bank Syariah Wakalumi dalam mendukung kegiatan kepedulian masyarakat, pemberdayaan umat, serta literasi dana kebajikan syariah secara amanah dan transparan.',
        // Hero Highlight Pills
        'hero_pill_1'         => 'Amanah & Sesuai Prinsip Syariah',
        'hero_pill_2'         => 'Kepedulian Sosial & Kemaslahatan Umat',
        'hero_pill_3'         => 'Literasi Zakat, Infak, Sedekah & Wakaf',
        // Hero Badge Card (Kanan)
        'hero_card_show'      => 1,
        'hero_card_badge'     => 'Fungsi Sosial BSW',
        'hero_card_title'     => 'Kepedulian & Kemaslahatan Umat',
        'hero_card_desc'      => 'Informasi peran sosial Baitul Maal, program kemaslahatan masyarakat, serta literasi Zakat, Infak, Sedekah, dan Wakaf.',
        'hero_card_p1'        => 'Pengelolaan Berlandaskan Prinsip Syariah',
        'hero_card_p2'        => 'Kepedulian Sosial & Santunan Masyarakat',
        'hero_card_p3'        => 'Literasi Zakat, Infak, Sedekah & Wakaf',
        'hero_card_p4'        => 'Transparan, Akuntabel & Tepat Sasaran',
        'hero_card_seal_left' => 'Amanah & Berkah',
        'hero_card_seal_right'=> 'Prinsip Syariah',
        // Label Navigasi Sidebar Kiri
        'sidebar_nav_title'   => 'Navigasi Baitul Maal',
        'sidebar_count_suffix'=> 'Menu',
        // Informasi Bantuan & Rekening di Sidebar Kiri
        'cs_phone'            => '(021) 7471 4555',
        'cs_wa'               => '6281517380388',
        'cs_wa_text'          => 'Halo Tim Layanan Informasi Bank Syariah Wakalumi, saya ingin menanyakan informasi seputar Baitul Maal BSW.',
        'cs_hours'            => 'Senin – Jumat: 08.00 – 15.00 WIB',
        'help_card_title'     => 'Informasi Lebih Lanjut',
        'help_card_desc'      => 'Hubungi layanan informasi Bank Syariah Wakalumi untuk pertanyaan seputar kegiatan sosial dan Baitul Maal.',
        'help_btn_text'       => 'Hubungi via WhatsApp',
        // Opsional Card Rekening Dana Sosial di Sidebar
        'rekening_show'       => 0,
        'rekening_title'      => 'Rekening Dana Sosial & Kebajikan',
        'rekening_list'       => [],
        'show_baitul_maal'    => 0,
        'items'               => wakalumi_get_default_baitul_maal_items(),
    ];

    $settings = $defaults;

    $options_map = [
        'breadcrumb_label'    => 'options_bm_breadcrumb_label',
        'kicker'              => 'options_bm_kicker',
        'title'               => 'options_bm_title',
        'subtitle'            => 'options_bm_subtitle',
        'hero_pill_1'         => 'options_bm_hero_pill_1',
        'hero_pill_2'         => 'options_bm_hero_pill_2',
        'hero_pill_3'         => 'options_bm_hero_pill_3',
        'hero_card_show'      => 'options_bm_hero_card_show',
        'hero_card_badge'     => 'options_bm_hero_card_badge',
        'hero_card_title'     => 'options_bm_hero_card_title',
        'hero_card_desc'      => 'options_bm_hero_card_desc',
        'hero_card_p1'        => 'options_bm_hero_card_p1',
        'hero_card_p2'        => 'options_bm_hero_card_p2',
        'hero_card_p3'        => 'options_bm_hero_card_p3',
        'hero_card_p4'        => 'options_bm_hero_card_p4',
        'hero_card_seal_left' => 'options_bm_hero_card_seal_left',
        'hero_card_seal_right'=> 'options_bm_hero_card_seal_right',
        'sidebar_nav_title'   => 'options_bm_sidebar_nav_title',
        'sidebar_count_suffix'=> 'options_bm_sidebar_count_suffix',
        'cs_phone'            => 'options_bm_cs_phone',
        'cs_wa'               => 'options_bm_cs_wa',
        'cs_wa_text'          => 'options_bm_cs_wa_text',
        'cs_hours'            => 'options_bm_cs_hours',
        'help_card_title'     => 'options_bm_help_card_title',
        'help_card_desc'      => 'options_bm_help_card_desc',
        'help_btn_text'       => 'options_bm_help_btn_text',
        'rekening_show'       => 'options_bm_rekening_show',
        'rekening_title'      => 'options_bm_rekening_title',
        'show_baitul_maal'    => 'options_show_baitul_maal',
    ];

    foreach ( $options_map as $key => $opt_name ) {
        $val = get_option( $opt_name );
        if ( false !== $val ) {
            if ( in_array( $key, [ 'hero_card_badge', 'hero_card_title', 'hero_card_desc', 'hero_card_p1', 'hero_card_p2', 'hero_card_p3', 'hero_card_p4', 'hero_card_seal_left', 'hero_card_seal_right' ], true ) && empty( $val ) ) {
                continue;
            }
            if ( in_array( $key, [ 'hero_card_show', 'rekening_show', 'show_baitul_maal' ], true ) ) {
                $settings[ $key ] = (bool) $val;
            } else {
                $settings[ $key ] = $val;
            }
        }
    }

    $saved_rek = get_option( 'options_bm_rekening_list_json' );
    if ( ! empty( $saved_rek ) ) {
        $dec_rek = json_decode( $saved_rek, true );
        if ( is_array( $dec_rek ) ) {
            $settings['rekening_list'] = $dec_rek;
        }
    }

    $saved_items_raw = get_option( 'options_bm_items_json' );
    if ( ! empty( $saved_items_raw ) ) {
        $decoded = json_decode( $saved_items_raw, true );
        if ( is_array( $decoded ) && ! empty( $decoded ) ) {
            // Bersihkan kata "Pilar" pada badge lama jika pernah tersimpan
            foreach ( $decoded as &$d_it ) {
                if ( ! empty( $d_it['pillar_cards'] ) && is_array( $d_it['pillar_cards'] ) ) {
                    foreach ( $d_it['pillar_cards'] as &$pc ) {
                        if ( isset( $pc['badge'] ) && stripos( $pc['badge'], 'Pilar' ) !== false ) {
                            if ( stripos( $pc['title'] ?? '', 'Tujuan' ) !== false ) {
                                $pc['badge'] = 'Arah & Orientasi';
                            } elseif ( stripos( $pc['title'] ?? '', 'Sasaran' ) !== false ) {
                                $pc['badge'] = 'Penerima Manfaat';
                            } elseif ( stripos( $pc['title'] ?? '', 'Manfaat' ) !== false ) {
                                $pc['badge'] = 'Dampak Kebaikan';
                            } else {
                                $pc['badge'] = 'Fokus Utama';
                            }
                        }
                    }
                    unset( $pc );
                }
                if ( empty( $d_it['custom_sections'] ) || ! is_array( $d_it['custom_sections'] ) ) {
                    $d_it['custom_sections'] = [];
                }
            }
            unset( $d_it );
            $settings['items'] = $decoded;
        }
    }

    return $settings;
}

// ─────────────────────────────────────────────────────────────────────────────
// 2. REGISTRASI MENU ADMIN SEBAGAI SUBMENU DI BAWAH PENGATURAN WEBSITE
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'admin_menu', 'wakalumi_register_baitul_maal_admin_menu', 29 );
function wakalumi_register_baitul_maal_admin_menu() {
    add_submenu_page(
        'wakalumi-settings',
        'Kelola Baitul Maal BSW',
        'Baitul Maal BSW',
        'manage_options',
        'wakalumi-baitul-maal',
        'wakalumi_render_baitul_maal_admin_page'
    );
}

// ─────────────────────────────────────────────────────────────────────────────
// 3. HANDLER SIMPAN SETTINGS (POST)
// ─────────────────────────────────────────────────────────────────────────────
function wakalumi_handle_baitul_maal_save() {
    if ( ! isset( $_POST['wakalumi_bm_nonce'] ) || ! check_admin_referer( 'wakalumi_save_bm_action', 'wakalumi_bm_nonce' ) ) {
        return false;
    }
    if ( ! current_user_can( 'manage_options' ) ) {
        return false;
    }

    // Reset ke preset default jika ditekan tombol reset
    if ( isset( $_POST['reset_bm_defaults'] ) ) {
        $keys_to_delete = [
            'options_bm_breadcrumb_label',
            'options_bm_kicker',
            'options_bm_title',
            'options_bm_subtitle',
            'options_bm_hero_pill_1',
            'options_bm_hero_pill_2',
            'options_bm_hero_pill_3',
            'options_bm_hero_card_show',
            'options_bm_hero_card_badge',
            'options_bm_hero_card_title',
            'options_bm_hero_card_desc',
            'options_bm_hero_card_p1',
            'options_bm_hero_card_p2',
            'options_bm_hero_card_p3',
            'options_bm_hero_card_p4',
            'options_bm_hero_card_seal_left',
            'options_bm_hero_card_seal_right',
            'options_bm_sidebar_nav_title',
            'options_bm_sidebar_count_suffix',
            'options_bm_cs_phone',
            'options_bm_cs_wa',
            'options_bm_cs_wa_text',
            'options_bm_cs_hours',
            'options_bm_help_card_title',
            'options_bm_help_card_desc',
            'options_bm_help_btn_text',
            'options_bm_rekening_show',
            'options_bm_rekening_title',
            'options_bm_rekening_list_json',
            'options_bm_items_json',
            'options_show_baitul_maal',
        ];
        foreach ( $keys_to_delete as $k ) {
            delete_option( $k );
        }
        return 'reset';
    }

    // Simpan Visibilitas Regulasi Baitul Maal di Navbar
    update_option( 'options_show_baitul_maal', isset( $_POST['options_show_baitul_maal'] ) ? '1' : '0' );

    // Simpan Hero & Header
    update_option( 'options_bm_breadcrumb_label', sanitize_text_field( wp_unslash( $_POST['breadcrumb_label'] ?? 'Baitul Maal BSW' ) ) );
    update_option( 'options_bm_kicker', sanitize_text_field( wp_unslash( $_POST['kicker'] ?? '' ) ) );
    update_option( 'options_bm_title', sanitize_text_field( wp_unslash( $_POST['title'] ?? '' ) ) );
    update_option( 'options_bm_subtitle', sanitize_textarea_field( wp_unslash( $_POST['subtitle'] ?? '' ) ) );
    update_option( 'options_bm_hero_pill_1', sanitize_text_field( wp_unslash( $_POST['hero_pill_1'] ?? '' ) ) );
    update_option( 'options_bm_hero_pill_2', sanitize_text_field( wp_unslash( $_POST['hero_pill_2'] ?? '' ) ) );
    update_option( 'options_bm_hero_pill_3', sanitize_text_field( wp_unslash( $_POST['hero_pill_3'] ?? '' ) ) );

    // Simpan Hero Badge Card
    update_option( 'options_bm_hero_card_show', isset( $_POST['hero_card_show'] ) ? 1 : 0 );
    update_option( 'options_bm_hero_card_badge', sanitize_text_field( wp_unslash( $_POST['hero_card_badge'] ?? '' ) ) );
    update_option( 'options_bm_hero_card_title', sanitize_text_field( wp_unslash( $_POST['hero_card_title'] ?? '' ) ) );
    update_option( 'options_bm_hero_card_desc', sanitize_textarea_field( wp_unslash( $_POST['hero_card_desc'] ?? '' ) ) );
    update_option( 'options_bm_hero_card_p1', sanitize_text_field( wp_unslash( $_POST['hero_card_p1'] ?? '' ) ) );
    update_option( 'options_bm_hero_card_p2', sanitize_text_field( wp_unslash( $_POST['hero_card_p2'] ?? '' ) ) );
    update_option( 'options_bm_hero_card_p3', sanitize_text_field( wp_unslash( $_POST['hero_card_p3'] ?? '' ) ) );
    update_option( 'options_bm_hero_card_p4', sanitize_text_field( wp_unslash( $_POST['hero_card_p4'] ?? '' ) ) );
    update_option( 'options_bm_hero_card_seal_left', sanitize_text_field( wp_unslash( $_POST['hero_card_seal_left'] ?? '' ) ) );
    update_option( 'options_bm_hero_card_seal_right', sanitize_text_field( wp_unslash( $_POST['hero_card_seal_right'] ?? '' ) ) );

    // Simpan Kontak CS & Sidebar
    update_option( 'options_bm_sidebar_nav_title', sanitize_text_field( wp_unslash( $_POST['sidebar_nav_title'] ?? 'Navigasi Baitul Maal' ) ) );
    update_option( 'options_bm_sidebar_count_suffix', sanitize_text_field( wp_unslash( $_POST['sidebar_count_suffix'] ?? 'Menu' ) ) );
    update_option( 'options_bm_cs_phone', sanitize_text_field( wp_unslash( $_POST['cs_phone'] ?? '' ) ) );
    update_option( 'options_bm_cs_wa', sanitize_text_field( wp_unslash( $_POST['cs_wa'] ?? '' ) ) );
    update_option( 'options_bm_cs_wa_text', sanitize_textarea_field( wp_unslash( $_POST['cs_wa_text'] ?? '' ) ) );
    update_option( 'options_bm_cs_hours', sanitize_text_field( wp_unslash( $_POST['cs_hours'] ?? '' ) ) );
    update_option( 'options_bm_help_card_title', sanitize_text_field( wp_unslash( $_POST['help_card_title'] ?? '' ) ) );
    update_option( 'options_bm_help_card_desc', sanitize_textarea_field( wp_unslash( $_POST['help_card_desc'] ?? '' ) ) );
    update_option( 'options_bm_help_btn_text', sanitize_text_field( wp_unslash( $_POST['help_btn_text'] ?? 'Hubungi via WhatsApp' ) ) );

    // Simpan Rekening Sidebar Opsional
    update_option( 'options_bm_rekening_show', isset( $_POST['rekening_show'] ) ? 1 : 0 );
    update_option( 'options_bm_rekening_title', sanitize_text_field( wp_unslash( $_POST['rekening_title'] ?? 'Rekening Dana Sosial & Kebajikan' ) ) );
    if ( isset( $_POST['bm_rekening_json'] ) ) {
        $raw_rek = wp_unslash( $_POST['bm_rekening_json'] );
        $dec_rek = json_decode( $raw_rek, true );
        $clean_rek = [];
        if ( is_array( $dec_rek ) ) {
            foreach ( $dec_rek as $rk ) {
                $bank = sanitize_text_field( $rk['bank'] ?? '' );
                $norek = sanitize_text_field( $rk['norek'] ?? '' );
                if ( ! empty( $bank ) || ! empty( $norek ) ) {
                    $clean_rek[] = [
                        'bank'  => $bank,
                        'norek' => $norek,
                        'an'    => sanitize_text_field( $rk['an'] ?? '' ),
                    ];
                }
            }
        }
        update_option( 'options_bm_rekening_list_json', wp_json_encode( $clean_rek ) );
    }

    $sanitize_lines = function( $arr ) {
        $out = [];
        if ( is_array( $arr ) ) {
            foreach ( $arr as $line ) {
                $clean = sanitize_text_field( $line );
                if ( '' !== $clean ) {
                    $out[] = $clean;
                }
            }
        }
        return $out;
    };

    $valid_colors = array_keys( wakalumi_get_bm_color_options() );
    $sanitize_color = function( $c, $fallback = 'teal' ) use ( $valid_colors ) {
        $c = sanitize_text_field( $c ?? $fallback );
        return in_array( $c, $valid_colors, true ) ? $c : $fallback;
    };

    // Proses Data Tab Menu Sidebar Baitul Maal (Dynamic JSON Array)
    if ( isset( $_POST['bm_items_json'] ) ) {
        $raw_json = wp_unslash( $_POST['bm_items_json'] );
        $decoded  = json_decode( $raw_json, true );
        if ( is_array( $decoded ) ) {
            $clean_items = [];
            foreach ( $decoded as $it ) {
                $id = sanitize_title( $it['id'] ?? ( $it['short_title'] ?? ( $it['title'] ?? 'baitul-maal-' . time() ) ) );
                if ( empty( $id ) ) $id = 'baitul-maal-' . wp_rand( 100, 999 );

                // 1. Kartu Informasi Berikon (Tujuan, Sasaran, Manfaat, dll)
                $pillar_cards = [];
                if ( ! empty( $it['pillar_cards'] ) && is_array( $it['pillar_cards'] ) ) {
                    foreach ( $it['pillar_cards'] as $pc ) {
                        $p_title = sanitize_text_field( $pc['title'] ?? '' );
                        if ( ! empty( $p_title ) ) {
                            $pillar_cards[] = [
                                'title' => $p_title,
                                'badge' => sanitize_text_field( $pc['badge'] ?? '' ),
                                'icon'  => sanitize_text_field( $pc['icon'] ?? 'target' ),
                                'color' => $sanitize_color( $pc['color'] ?? 'teal', 'teal' ),
                                'desc'  => sanitize_textarea_field( $pc['desc'] ?? '' ),
                            ];
                        }
                    }
                }

                // 2. Blok Seksi Kustom Bebas (Custom Sections Repeater)
                $custom_sections = [];
                if ( ! empty( $it['custom_sections'] ) && is_array( $it['custom_sections'] ) ) {
                    foreach ( $it['custom_sections'] as $cs ) {
                        $cs_title = sanitize_text_field( $cs['title'] ?? '' );
                        if ( ! empty( $cs_title ) ) {
                            $custom_sections[] = [
                                'badge'       => sanitize_text_field( $cs['badge'] ?? '' ),
                                'title'       => $cs_title,
                                'icon'        => sanitize_text_field( $cs['icon'] ?? 'sparkles' ),
                                'color'       => $sanitize_color( $cs['color'] ?? 'teal', 'teal' ),
                                'desc'        => sanitize_textarea_field( $cs['desc'] ?? '' ),
                                'quote'       => sanitize_textarea_field( $cs['quote'] ?? '' ),
                                'image'       => esc_url_raw( $cs['image'] ?? '' ),
                                'col1_title'  => sanitize_text_field( $cs['col1_title'] ?? '' ),
                                'col1_list'   => $sanitize_lines( $cs['col1_list'] ?? [] ),
                                'col2_title'  => sanitize_text_field( $cs['col2_title'] ?? '' ),
                                'col2_list'   => $sanitize_lines( $cs['col2_list'] ?? [] ),
                            ];
                        }
                    }
                }

                // 3. Media Gallery
                $gallery = [];
                if ( ! empty( $it['media_gallery'] ) && is_array( $it['media_gallery'] ) ) {
                    foreach ( $it['media_gallery'] as $img ) {
                        $url = esc_url_raw( $img['url'] ?? '' );
                        if ( ! empty( $url ) ) {
                            $gallery[] = [
                                'url'     => $url,
                                'caption' => sanitize_text_field( $img['caption'] ?? '' ),
                            ];
                        }
                    }
                }

                // 4. FAQs
                $faqs = [];
                if ( ! empty( $it['faqs'] ) && is_array( $it['faqs'] ) ) {
                    foreach ( $it['faqs'] as $f ) {
                        $q = sanitize_text_field( $f['q'] ?? '' );
                        $a = sanitize_textarea_field( $f['a'] ?? '' );
                        if ( ! empty( $q ) ) {
                            $faqs[] = [ 'q' => $q, 'a' => $a ];
                        }
                    }
                }

                $clean_items[] = [
                    'id'                    => $id,
                    'title'                 => sanitize_text_field( $it['title'] ?? 'Menu Baitul Maal' ),
                    'short_title'           => sanitize_text_field( $it['short_title'] ?? ( $it['title'] ?? 'Menu Baitul Maal' ) ),
                    'badge'                 => sanitize_text_field( $it['badge'] ?? '' ),
                    'icon'                  => sanitize_text_field( $it['icon'] ?? 'heart' ),
                    'color'                 => $sanitize_color( $it['color'] ?? 'teal', 'teal' ),
                    'summary'               => sanitize_textarea_field( $it['summary'] ?? '' ),
                    'intro'                 => sanitize_textarea_field( $it['intro'] ?? '' ),
                    'main_image'            => esc_url_raw( $it['main_image'] ?? '' ),
                    'main_image_caption'    => sanitize_text_field( $it['main_image_caption'] ?? '' ),
                    'main_quote'            => sanitize_textarea_field( $it['main_quote'] ?? '' ),
                    'main_content'          => sanitize_textarea_field( $it['main_content'] ?? '' ),
                    // Modul 1: Kartu Informasi Berikon
                    'show_pillars'          => ! empty( $it['show_pillars'] ),
                    'pillars_section_title' => sanitize_text_field( $it['pillars_section_title'] ?? 'Tujuan, Sasaran & Manfaat' ),
                    'pillars_section_badge' => sanitize_text_field( $it['pillars_section_badge'] ?? '' ),
                    'pillar_cards'          => $pillar_cards,
                    // Modul 2: Blok Seksi Utama + 2 Kartu Daftar Bersampingan (Misal: Zakat & 8 Asnaf / Syarat, atau Program lainnya)
                    'show_zakat'            => ! empty( $it['show_zakat'] ),
                    'zakat_color'           => $sanitize_color( $it['zakat_color'] ?? 'teal', 'teal' ),
                    'zakat_icon'            => sanitize_text_field( $it['zakat_icon'] ?? 'scale' ),
                    'zakat_badge'           => sanitize_text_field( $it['zakat_badge'] ?? 'Rukun Islam & Penyucian Harta' ),
                    'zakat_title'           => sanitize_text_field( $it['zakat_title'] ?? 'Ketentuan Umum Zakat' ),
                    'zakat_desc'            => sanitize_textarea_field( $it['zakat_desc'] ?? '' ),
                    'zakat_quote'           => sanitize_textarea_field( $it['zakat_quote'] ?? '' ),
                    'zakat_asnaf_title'     => sanitize_text_field( $it['zakat_asnaf_title'] ?? 'Golongan Penerima Zakat (8 Asnaf)' ),
                    'zakat_asnaf_subtitle'  => sanitize_text_field( $it['zakat_asnaf_subtitle'] ?? '' ),
                    'zakat_asnaf_list'      => $sanitize_lines( $it['zakat_asnaf_list'] ?? [] ),
                    'zakat_syarat_title'    => sanitize_text_field( $it['zakat_syarat_title'] ?? 'Syarat Wajib Zakat' ),
                    'zakat_syarat_subtitle' => sanitize_text_field( $it['zakat_syarat_subtitle'] ?? '' ),
                    'zakat_syarat_list'     => $sanitize_lines( $it['zakat_syarat_list'] ?? [] ),
                    // Modul 3: Blok Seksi Penjelasan + Grid Poin (Misal: Infak & Sedekah, atau Kegiatan Sosial)
                    'show_sedekah'          => ! empty( $it['show_sedekah'] ),
                    'sedekah_color'         => $sanitize_color( $it['sedekah_color'] ?? 'amber', 'amber' ),
                    'sedekah_icon'          => sanitize_text_field( $it['sedekah_icon'] ?? 'hand-heart' ),
                    'sedekah_badge'         => sanitize_text_field( $it['sedekah_badge'] ?? 'Amal Kebajikan Setiap Waktu' ),
                    'sedekah_title'         => sanitize_text_field( $it['sedekah_title'] ?? 'Keutamaan Infak & Sedekah' ),
                    'sedekah_image'         => esc_url_raw( $it['sedekah_image'] ?? '' ),
                    'sedekah_desc'          => sanitize_textarea_field( $it['sedekah_desc'] ?? '' ),
                    'sedekah_quote'         => sanitize_textarea_field( $it['sedekah_quote'] ?? '' ),
                    'sedekah_points_title'  => sanitize_text_field( $it['sedekah_points_title'] ?? 'Hikmah & Keutamaan' ),
                    'sedekah_points'        => $sanitize_lines( $it['sedekah_points'] ?? [] ),
                    // Modul 4: Blok Seksi Penjelasan + 2 Kolom Keunggulan & Program (Misal: Wakaf, atau Tata Kelola Program)
                    'show_wakaf'            => ! empty( $it['show_wakaf'] ),
                    'wakaf_color'           => $sanitize_color( $it['wakaf_color'] ?? 'indigo', 'indigo' ),
                    'wakaf_icon'            => sanitize_text_field( $it['wakaf_icon'] ?? 'building' ),
                    'wakaf_badge'           => sanitize_text_field( $it['wakaf_badge'] ?? 'Amal Jariyah Abadi' ),
                    'wakaf_title'           => sanitize_text_field( $it['wakaf_title'] ?? 'Mengenal Wakaf & Wakaf Uang' ),
                    'wakaf_desc'            => sanitize_textarea_field( $it['wakaf_desc'] ?? '' ),
                    'wakaf_quote'           => sanitize_textarea_field( $it['wakaf_quote'] ?? '' ),
                    'wakaf_keunggulan_title'=> sanitize_text_field( $it['wakaf_keunggulan_title'] ?? 'Keunggulan Utama' ),
                    'wakaf_keunggulan_list' => $sanitize_lines( $it['wakaf_keunggulan_list'] ?? [] ),
                    'wakaf_program_title'   => sanitize_text_field( $it['wakaf_program_title'] ?? 'Ruang Lingkup Pemanfaatan' ),
                    'wakaf_program_list'    => $sanitize_lines( $it['wakaf_program_list'] ?? [] ),
                    // Modul Tambahan Bebas: Custom Sections
                    'custom_sections'       => $custom_sections,
                    // Modul 5: Galeri
                    'show_gallery'          => ! empty( $it['show_gallery'] ),
                    'gallery_title'         => sanitize_text_field( $it['gallery_title'] ?? 'Dokumentasi & Infografis' ),
                    'media_gallery'         => $gallery,
                    // Modul 6: FAQ
                    'show_faqs'             => ! empty( $it['show_faqs'] ),
                    'faq_section_title'     => sanitize_text_field( $it['faq_section_title'] ?? 'Tanya Jawab (FAQ)' ),
                    'faqs'                  => $faqs,
                ];
            }
            update_option( 'options_bm_items_json', wp_json_encode( $clean_items ) );
        }
    }

    return true;
}

// ─────────────────────────────────────────────────────────────────────────────
// 4. RENDER UI ADMIN
// ─────────────────────────────────────────────────────────────────────────────
function wakalumi_render_baitul_maal_admin_page() {
    $status = null;
    if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
        $status = wakalumi_handle_baitul_maal_save();
    }

    $cfg = wakalumi_get_baitul_maal_settings();
    $icon_opts  = wakalumi_get_bm_icon_options();
    $color_opts = wakalumi_get_bm_color_options();
    wp_enqueue_media();
    ?>
    <div class="wrap" style="max-width: 1260px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">

        <!-- Header Banner -->
        <div style="background: linear-gradient(135deg, #065f46 0%, #0f766e 50%, #1e40af 100%); color: #fff; padding: 24px 28px; border-radius: 16px; margin-bottom: 24px; box-shadow: 0 10px 25px -5px rgba(6, 95, 70, 0.25);">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
                <div>
                    <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.18); padding: 4px 12px; border-radius: 999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">
                        <span>🕌 Pengaturan Website &bull; Sosial Syariah, Kemaslahatan &amp; ZISWAF</span>
                    </div>
                    <h1 style="color: #fff; margin: 0; font-size: 26px; font-weight: 800; letter-spacing: -0.02em;">Kelola Halaman Baitul Maal BSW</h1>
                    <p style="color: #e0f2fe; margin: 6px 0 0 0; font-size: 13px;">Kelola menu sidebar kiri, variasi 8 warna &amp; 16 ikon profesional, saklar modul konten (Simpel/Kompleks), serta blok seksi kustom bebas untuk kegiatan sosial apa pun.</p>
                </div>
                <div>
                    <a href="<?php echo esc_url( home_url( '/baitul-maal/' ) ); ?>" target="_blank" class="button" style="background: #fff; color: #065f46; border: none; font-weight: 700; padding: 8px 18px; border-radius: 999px; height: auto; text-decoration: none; box-shadow: 0 4px 12px rgba(0,0,0,0.12);">
                        Lihat Halaman Live ↗
                    </a>
                </div>
            </div>
        </div>

        <?php if ( $status === true ) : ?>
            <div class="notice notice-success is-dismissible" style="border-radius: 8px; border-left-color: #10b981; padding: 12px 16px;">
                <p style="font-weight: 700; color: #065f46; margin: 0;">✓ Pengaturan Halaman Baitul Maal BSW berhasil disimpan!</p>
            </div>
        <?php elseif ( $status === 'reset' ) : ?>
            <div class="notice notice-warning is-dismissible" style="border-radius: 8px; border-left-color: #f59e0b; padding: 12px 16px;">
                <p style="font-weight: 700; color: #b45309; margin: 0;">↺ Seluruh data Baitul Maal BSW telah dikembalikan ke 3 menu starter profesional (Tentang Baitul Maal, Program &amp; Kemaslahatan, serta Edukasi ZISWAF).</p>
            </div>
        <?php endif; ?>

        <form method="post" action="" id="wakalumi-bm-form" onsubmit="syncBmHiddenInputs()">
            <?php wp_nonce_field( 'wakalumi_save_bm_action', 'wakalumi_bm_nonce' ); ?>
            <input type="hidden" name="bm_items_json" id="bm_items_json" value="<?php echo esc_attr( wp_json_encode( $cfg['items'] ) ); ?>" />
            <input type="hidden" name="bm_rekening_json" id="bm_rekening_json" value="<?php echo esc_attr( wp_json_encode( $cfg['rekening_list'] ) ); ?>" />

            <!-- KARTU STATUS REGULASI & SAKLAR VISIBILITAS NAVBAR PUBLIK -->
            <?php
            $is_bm_active = ! empty( $cfg['show_baitul_maal'] );
            ?>
            <div style="background: <?php echo $is_bm_active ? '#f0fdf4' : '#fffbeb'; ?>; border: 1.5px solid <?php echo $is_bm_active ? '#86efac' : '#fde68a'; ?>; border-radius: 14px; padding: 20px 24px; margin-bottom: 24px; box-shadow: 0 4px 15px -3px <?php echo $is_bm_active ? 'rgba(16, 185, 129, 0.1)' : 'rgba(245, 158, 11, 0.1)'; ?>;">
                <div style="display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
                    <div style="flex: 1; min-width: 280px;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                            <span style="font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; padding: 4px 12px; border-radius: 999px; background: <?php echo $is_bm_active ? '#dcfce7' : '#fef3c7'; ?>; color: <?php echo $is_bm_active ? '#166534' : '#92400e'; ?>; border: 1px solid <?php echo $is_bm_active ? '#bbf7d0' : '#fde68a'; ?>;">
                                <?php echo $is_bm_active ? '● STATUS: AKTIF DI NAVBAR PUBLIK' : '🔒 STATUS: TERSEMBUNYI DARI PUBLIK'; ?>
                            </span>
                            <span style="font-size: 12px; color: #64748b; font-weight: 600;">Regulasi &amp; Perizinan Otoritas</span>
                        </div>
                        <h2 style="margin: 0 0 6px 0; font-size: 16px; font-weight: 800; color: <?php echo $is_bm_active ? '#065f46' : '#92400e'; ?>;">
                            Saklar Visibilitas Menu Baitul Maal di Navbar
                        </h2>
                        <p style="margin: 0; font-size: 13px; color: #475569; line-height: 1.6;">
                            Sesuai arahan direksi terkait regulasi perbankan syariah, menu dan halaman publik Baitul Maal disembunyikan sementara waktu jika izin operasional belum diaktifkan:
                        </p>
                        <ul style="margin: 8px 0 0 16px; padding: 0; font-size: 12.5px; color: #475569; line-height: 1.6; list-style-type: disc;">
                            <li><strong>Jika Dicentang (Aktif):</strong> Menu di navbar otomatis berubah menjadi <strong>"Layanan dan Baitul Maal"</strong> lengkap dengan pilihan dropdown (Layanan Kami &amp; Baitul Maal BSW).</li>
                            <li><strong>Jika Tidak Dicentang (Nonaktif / Tersembunyi - Default):</strong> Menu di navbar otomatis hanya menampilkan <strong>"Layanan"</strong> (link langsung ke <code>/layanan-kami/</code>). Pengunjung umum yang mengakses tautan <code>/baitul-maal/</code> otomatis dialihkan ke Layanan Kami, sedangkan Administrator tetap dapat mempratinjau halaman.</li>
                        </ul>
                    </div>

                    <div style="background: #ffffff; border: 1px solid <?php echo $is_bm_active ? '#bbf7d0' : '#e2e8f0'; ?>; border-radius: 12px; padding: 16px 20px; min-width: 310px; display: flex; flex-direction: column; gap: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 13.5px; font-weight: 700; color: #0f172a;">
                            <input type="checkbox" name="options_show_baitul_maal" value="1" <?php checked( $is_bm_active ); ?> style="width: 18px; height: 18px; accent-color: #0d9488; cursor: pointer;" />
                            <span>Tampilkan Menu Baitul Maal di Navbar</span>
                        </label>
                        <div style="font-size: 11.5px; color: #64748b; line-height: 1.4; border-top: 1px solid #f1f5f9; padding-top: 8px;">
                            <?php if ( $is_bm_active ) : ?>
                                <span style="color: #059669; font-weight: 600;">✓ Tampil di Navbar sebagai "Layanan dan Baitul Maal"</span>
                            <?php else : ?>
                                <span style="color: #d97706; font-weight: 600;">🔒 Navbar hanya menampilkan single link "Layanan"</span>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="button button-primary" style="background: #0f766e; border-color: #0f766e; font-weight: 700; padding: 7px 16px; border-radius: 8px; width: 100%;">
                            Simpan Pengaturan Saklar
                        </button>
                    </div>
                </div>
            </div>

            <!-- TAB NAVIGASI ADMIN -->
            <div style="display: flex; gap: 8px; margin-bottom: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 2px;">
                <button type="button" class="wkl-bm-tab-btn" onclick="switchBmAdminTab('tab-items')" id="btn-bm-tab-items" style="background: #0f766e; color: #fff; border: none; padding: 11px 22px; border-radius: 8px 8px 0 0; font-weight: 700; font-size: 13px; cursor: pointer;">
                    1. Menu Sidebar &amp; Modul Konten Card (Simpel / Kompleks / Kustom Bebas)
                </button>
                <button type="button" class="wkl-bm-tab-btn" onclick="switchBmAdminTriggers('tab-header')" id="btn-bm-tab-header" style="background: #e2e8f0; color: #475569; border: none; padding: 11px 22px; border-radius: 8px 8px 0 0; font-weight: 700; font-size: 13px; cursor: pointer;">
                    2. Hero Section, Card Hero &amp; Info Sidebar
                </button>
            </div>

            <!-- TAB 1: MENU SIDEBAR & MODUL KONTEN CARD -->
            <div id="section-bm-tab-items" class="wkl-bm-admin-section" style="margin-bottom: 24px;">
                <div style="background: linear-gradient(90deg, #f0fdf4 0%, #eff6ff 100%); border: 1px solid #bbf7d0; border-radius: 12px; padding: 16px 20px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
                    <div style="max-width: 820px;">
                        <h3 style="margin: 0; font-size: 15px; font-weight: 800; color: #065f46;">Fleksibilitas Penuh: Tidak Terbatas pada Zakat Saja</h3>
                        <p style="margin: 4px 0 0 0; font-size: 12.5px; color: #1e3a8a; line-height: 1.5;">
                            Setiap menu sidebar memiliki <strong>Judul, Warna Tema (8 Variasi), dan Ikon (16 Variasi) yang 100% bebas Anda ubah</strong>. Anda juga dapat menekan tombol <strong>"+ Tambah Blok Seksi Konten Kustom"</strong> di dalam setiap menu untuk membuat seksi informasi baru dengan judul apa pun sesuai program masa depan BSW.
                        </p>
                    </div>
                    <button type="button" class="button button-primary" onclick="addBmSidebarItem()" style="background: #059669; border-color: #059669; font-weight: 700; padding: 6px 16px; border-radius: 8px;">
                        + Tambah Menu Sidebar Baru
                    </button>
                </div>

                <!-- Container Repeater Menu Sidebar -->
                <div id="bm-items-container"></div>
            </div>

            <!-- TAB 2: HERO SECTION & SIDEBAR BANTUAN -->
            <div id="section-bm-tab-header" class="wkl-bm-admin-section" style="display: none; background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h3 style="margin-top: 0; font-size: 15px; font-weight: 800; color: #0f766e; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px;">
                    A. Pengaturan Hero Section Atas
                </h3>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row" style="width: 240px;"><label for="breadcrumb_label">Label Breadcrumb</label></th>
                        <td>
                            <input name="breadcrumb_label" type="text" id="breadcrumb_label" value="<?php echo esc_attr( $cfg['breadcrumb_label'] ); ?>" class="regular-text" style="width: 100%; max-width: 350px;" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="kicker">Kicker Label (Badge Atas)</label></th>
                        <td>
                            <input name="kicker" type="text" id="kicker" value="<?php echo esc_attr( $cfg['kicker'] ); ?>" class="regular-text" style="width: 100%; max-width: 500px;" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="title">Judul Utama Hero (H1)</label></th>
                        <td>
                            <input name="title" type="text" id="title" value="<?php echo esc_attr( $cfg['title'] ); ?>" class="regular-text" style="width: 100%; max-width: 500px; font-weight: 700;" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="subtitle">Deskripsi Sub-Judul Hero</label></th>
                        <td>
                            <textarea name="subtitle" id="subtitle" rows="3" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $cfg['subtitle'] ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Highlight Pills (3 Poin Kunci)</label></th>
                        <td>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 10px; max-width: 750px;">
                                <input name="hero_pill_1" type="text" value="<?php echo esc_attr( $cfg['hero_pill_1'] ); ?>" placeholder="Pill 1" class="regular-text" style="width: 100%;" />
                                <input name="hero_pill_2" type="text" value="<?php echo esc_attr( $cfg['hero_pill_2'] ); ?>" placeholder="Pill 2" class="regular-text" style="width: 100%;" />
                                <input name="hero_pill_3" type="text" value="<?php echo esc_attr( $cfg['hero_pill_3'] ); ?>" placeholder="Pill 3" class="regular-text" style="width: 100%;" />
                            </div>
                        </td>
                    </tr>
                </table>

                <h3 style="margin-top: 28px; font-size: 15px; font-weight: 800; color: #0f766e; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px;">
                    B. Pengaturan Hero Badge Card (Kartu Ringkasan Kanan di Hero)
                </h3>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row" style="width: 240px;">Tampilkan Card Kanan Hero</th>
                        <td>
                            <label style="font-weight: 600; color: #0f172a;">
                                <input type="checkbox" name="hero_card_show" value="1" <?php checked( ! empty( $cfg['hero_card_show'] ) ); ?> />
                                Tampilkan kartu ringkasan di sebelah kanan Hero Section
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="hero_card_badge">Badge Atas Card</label></th>
                        <td><input name="hero_card_badge" type="text" id="hero_card_badge" value="<?php echo esc_attr( $cfg['hero_card_badge'] ); ?>" class="regular-text" style="width: 100%; max-width: 400px;" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="hero_card_title">Judul Card Hero</label></th>
                        <td><input name="hero_card_title" type="text" id="hero_card_title" value="<?php echo esc_attr( $cfg['hero_card_title'] ); ?>" class="regular-text" style="width: 100%; max-width: 400px; font-weight: 700;" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="hero_card_desc">Deskripsi Card Hero</label></th>
                        <td><textarea name="hero_card_desc" id="hero_card_desc" rows="2" style="width: 100%; max-width: 550px;"><?php echo esc_textarea( $cfg['hero_card_desc'] ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>4 Poin Checklist Card</label></th>
                        <td>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 10px; max-width: 650px;">
                                <input name="hero_card_p1" type="text" value="<?php echo esc_attr( $cfg['hero_card_p1'] ); ?>" placeholder="Poin 1" />
                                <input name="hero_card_p2" type="text" value="<?php echo esc_attr( $cfg['hero_card_p2'] ); ?>" placeholder="Poin 2" />
                                <input name="hero_card_p3" type="text" value="<?php echo esc_attr( $cfg['hero_card_p3'] ); ?>" placeholder="Poin 3" />
                                <input name="hero_card_p4" type="text" value="<?php echo esc_attr( $cfg['hero_card_p4'] ); ?>" placeholder="Poin 4" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Teks Footer Card (Kiri &amp; Kanan)</label></th>
                        <td>
                            <div style="display: flex; gap: 10px; max-width: 550px;">
                                <input name="hero_card_seal_left" type="text" value="<?php echo esc_attr( $cfg['hero_card_seal_left'] ); ?>" style="flex:1;" />
                                <input name="hero_card_seal_right" type="text" value="<?php echo esc_attr( $cfg['hero_card_seal_right'] ); ?>" style="flex:1;" />
                            </div>
                        </td>
                    </tr>
                </table>

                <h3 style="margin-top: 28px; font-size: 15px; font-weight: 800; color: #0f766e; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px;">
                    C. Pengaturan Label Navigasi Sidebar, Card Kontak &amp; Rekening Dana Sosial
                </h3>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row" style="width: 240px;"><label>Judul &amp; Label Jumlah Menu Sidebar</label></th>
                        <td>
                            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 10px; max-width: 550px;">
                                <div>
                                    <span style="font-size:11px;font-weight:700;color:#64748b;display:block;margin-bottom:3px;">Judul Kotak Navigasi Sidebar Kiri</span>
                                    <input name="sidebar_nav_title" type="text" value="<?php echo esc_attr( $cfg['sidebar_nav_title'] ); ?>" style="width:100%;" />
                                </div>
                                <div>
                                    <span style="font-size:11px;font-weight:700;color:#64748b;display:block;margin-bottom:3px;">Akhiran Badge Jumlah (Misal: Menu)</span>
                                    <input name="sidebar_count_suffix" type="text" value="<?php echo esc_attr( $cfg['sidebar_count_suffix'] ); ?>" style="width:100%;" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" style="width: 240px;"><label for="help_card_title">Judul Card Bantuan Sidebar</label></th>
                        <td><input name="help_card_title" type="text" id="help_card_title" value="<?php echo esc_attr( $cfg['help_card_title'] ); ?>" class="regular-text" style="width: 100%; max-width: 400px;" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="help_card_desc">Deskripsi Bantuan Sidebar</label></th>
                        <td><textarea name="help_card_desc" id="help_card_desc" rows="2" style="width: 100%; max-width: 550px;"><?php echo esc_textarea( $cfg['help_card_desc'] ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Kontak CS (Jam, WA, Telepon)</label></th>
                        <td>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; max-width: 650px; margin-bottom: 10px;">
                                <div>
                                    <span style="font-size:11px;font-weight:700;color:#64748b;display:block;margin-bottom:3px;">Jam Layanan</span>
                                    <input name="cs_hours" type="text" value="<?php echo esc_attr( $cfg['cs_hours'] ); ?>" style="width:100%;" />
                                </div>
                                <div>
                                    <span style="font-size:11px;font-weight:700;color:#64748b;display:block;margin-bottom:3px;">Nomor WhatsApp (628...)</span>
                                    <input name="cs_wa" type="text" value="<?php echo esc_attr( $cfg['cs_wa'] ); ?>" style="width:100%;" />
                                </div>
                                <div>
                                    <span style="font-size:11px;font-weight:700;color:#64748b;display:block;margin-bottom:3px;">Nomor Telepon Kantor</span>
                                    <input name="cs_phone" type="text" value="<?php echo esc_attr( $cfg['cs_phone'] ); ?>" style="width:100%;" />
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 10px; max-width: 650px;">
                                <div>
                                    <span style="font-size:11px;font-weight:700;color:#64748b;display:block;margin-bottom:3px;">Teks Tombol WhatsApp</span>
                                    <input name="help_btn_text" type="text" value="<?php echo esc_attr( $cfg['help_btn_text'] ); ?>" style="width:100%;" />
                                </div>
                                <div>
                                    <span style="font-size:11px;font-weight:700;color:#64748b;display:block;margin-bottom:3px;">Pesan Otomatis Saat Klik WA</span>
                                    <input name="cs_wa_text" type="text" value="<?php echo esc_attr( $cfg['cs_wa_text'] ); ?>" style="width:100%;" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Card Rekening Dana Sosial (Opsional)</th>
                        <td>
                            <label style="font-weight: 600; color: #0f172a; display: block; margin-bottom: 10px;">
                                <input type="checkbox" name="rekening_show" value="1" <?php checked( ! empty( $cfg['rekening_show'] ) ); ?> />
                                Tampilkan kotak daftar Rekening Dana Sosial di bawah Sidebar Kiri
                            </label>
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; max-width: 680px;">
                                <div style="margin-bottom: 10px;">
                                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 4px;">Judul Kotak Rekening</label>
                                    <input name="rekening_title" type="text" value="<?php echo esc_attr( $cfg['rekening_title'] ); ?>" style="width: 100%; max-width: 400px;" />
                                </div>
                                <div id="bm-rekening-container"></div>
                                <button type="button" class="button" onclick="addBmRekening()" style="margin-top: 8px; font-weight: 600;">+ Tambah Rekening Sosial</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Action Bar Simpan & Reset -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 18px 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; position: sticky; bottom: 16px; z-index: 50; box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.12);">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <button type="submit" name="save_bm_settings" class="button button-primary button-large" style="background: #0f766e; border-color: #0f766e; font-weight: 700; padding: 6px 24px; border-radius: 8px;">
                        💾 Simpan Seluruh Pengaturan Baitul Maal
                    </button>
                    <span style="font-size: 12px; color: #64748b;">Perubahan langsung tampil di halaman <code>/baitul-maal/</code></span>
                </div>
                <button type="submit" name="reset_bm_defaults" class="button" onclick="return confirm('Kembalikan seluruh konten Baitul Maal BSW ke 3 menu starter (Tentang Baitul Maal, Program & Kemaslahatan, serta Edukasi ZISWAF)?');" style="color: #b45309; border-color: #fcd34d; background: #fffbeb; font-weight: 600; border-radius: 8px;">
                    ↺ Reset ke 3 Menu Starter Umum
                </button>
            </div>
        </form>
    </div>

    <script>
    let bmItems = <?php echo wp_json_encode( array_values( $cfg['items'] ) ); ?>;
    let bmRekening = <?php echo wp_json_encode( array_values( $cfg['rekening_list'] ) ); ?>;
    const bmIconOptions = <?php echo wp_json_encode( $icon_opts ); ?>;
    const bmColorOptions = <?php echo wp_json_encode( $color_opts ); ?>;

    function buildSelectOptions(mapObj, selectedVal) {
        return Object.entries(mapObj).map(([k, label]) =>
            `<option value="${k}" ${selectedVal === k ? 'selected' : ''}>${label}</option>`
        ).join('');
    }

    function switchBmAdminTab(tabId) {
        document.getElementById('section-bm-tab-items').style.display = (tabId === 'tab-items') ? 'block' : 'none';
        document.getElementById('section-bm-tab-header').style.display = (tabId === 'tab-header') ? 'block' : 'none';
        document.getElementById('btn-bm-tab-items').style.background = (tabId === 'tab-items') ? '#0f766e' : '#e2e8f0';
        document.getElementById('btn-bm-tab-items').style.color = (tabId === 'tab-items') ? '#fff' : '#475569';
        document.getElementById('btn-bm-tab-header').style.background = (tabId === 'tab-header') ? '#0f766e' : '#e2e8f0';
        document.getElementById('btn-bm-tab-header').style.color = (tabId === 'tab-header') ? '#fff' : '#475569';
    }
    function switchBmAdminTriggers(tabId) {
        switchBmAdminTab(tabId);
    }

    function escHtml(str) {
        if (str === null || str === undefined) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    function linesToText(arr) {
        if (!Array.isArray(arr)) return '';
        return arr.join('\n');
    }

    function textToLines(str) {
        if (!str) return [];
        return String(str).split(/\r?\n/).map(s => s.trim()).filter(Boolean);
    }

    function renderBmRekening() {
        const container = document.getElementById('bm-rekening-container');
        if (!container) return;
        if (!bmRekening.length) {
            container.innerHTML = '<p style="font-size:12px;color:#64748b;margin:4px 0;">Belum ada rekening yang ditambahkan.</p>';
            return;
        }
        let html = '';
        bmRekening.forEach((rk, rIdx) => {
            html += `
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr auto;gap:8px;margin-bottom:8px;align-items:center;">
                <input type="text" placeholder="Nama Bank (misal: Bank Syariah Wakalumi)" value="${escHtml(rk.bank)}" oninput="bmRekening[${rIdx}].bank = this.value" />
                <input type="text" placeholder="Nomor Rekening" value="${escHtml(rk.norek)}" oninput="bmRekening[${rIdx}].norek = this.value" />
                <input type="text" placeholder="Atas Nama" value="${escHtml(rk.an)}" oninput="bmRekening[${rIdx}].an = this.value" />
                <button type="button" class="button" style="color:#dc2626;border-color:#fca5a5;" onclick="bmRekening.splice(${rIdx},1);renderBmRekening();">✕</button>
            </div>`;
        });
        container.innerHTML = html;
    }

    function addBmRekening() {
        bmRekening.push({ bank: 'Bank Syariah Wakalumi', norek: '', an: 'Baitul Maal BSW' });
        renderBmRekening();
    }

    function renderBmItems() {
        const container = document.getElementById('bm-items-container');
        if (!container) return;
        let html = '';

        bmItems.forEach((item, idx) => {
            if (!Array.isArray(item.pillar_cards)) item.pillar_cards = [];
            if (!Array.isArray(item.custom_sections)) item.custom_sections = [];
            if (!Array.isArray(item.media_gallery)) item.media_gallery = [];
            if (!Array.isArray(item.faqs)) item.faqs = [];

            // Render Kartu Informasi Berikon (Tujuan, Sasaran, Manfaat, Fokus Bidang, dll)
            let cardsHtml = '';
            item.pillar_cards.forEach((pc, pIdx) => {
                cardsHtml += `
                <div style="background:#fff;border:1px solid #cbd5e1;border-radius:10px;padding:12px;margin-bottom:10px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                        <strong style="font-size:12.5px;color:#0f766e;">Kartu Informasi #${pIdx + 1}: ${escHtml(pc.title || 'Kartu')}</strong>
                        <button type="button" class="button button-small" style="color:#dc2626;border-color:#fca5a5;" onclick="removeBmPillar(${idx}, ${pIdx})">Hapus Kartu</button>
                    </div>
                    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:8px;margin-bottom:8px;">
                        <div>
                            <label style="font-size:11px;font-weight:700;color:#475569;display:block;">Judul Kartu (misal: Tujuan / Pendidikan)</label>
                            <input type="text" value="${escHtml(pc.title)}" oninput="bmItems[${idx}].pillar_cards[${pIdx}].title = this.value" style="width:100%;" />
                        </div>
                        <div>
                            <label style="font-size:11px;font-weight:700;color:#475569;display:block;">Label Kecil Atas (misal: Fokus Utama)</label>
                            <input type="text" value="${escHtml(pc.badge)}" oninput="bmItems[${idx}].pillar_cards[${pIdx}].badge = this.value" style="width:100%;" />
                        </div>
                        <div>
                            <label style="font-size:11px;font-weight:700;color:#475569;display:block;">Ikon Kartu (16 Pilihan)</label>
                            <select onchange="bmItems[${idx}].pillar_cards[${pIdx}].icon = this.value" style="width:100%;">
                                ${buildSelectOptions(bmIconOptions, pc.icon || 'target')}
                            </select>
                        </div>
                        <div>
                            <label style="font-size:11px;font-weight:700;color:#475569;display:block;">Tema Warna (8 Pilihan)</label>
                            <select onchange="bmItems[${idx}].pillar_cards[${pIdx}].color = this.value" style="width:100%;">
                                ${buildSelectOptions(bmColorOptions, pc.color || 'teal')}
                            </select>
                        </div>
                    </div>
                    <div>
                        <label style="font-size:11px;font-weight:700;color:#475569;display:block;">Isi Keterangan / Poin (Gunakan baris baru untuk daftar poin)</label>
                        <textarea rows="3" style="width:100%;" oninput="bmItems[${idx}].pillar_cards[${pIdx}].desc = this.value">${escHtml(pc.desc)}</textarea>
                    </div>
                </div>`;
            });

            // Render Custom Sections (Blok Seksi Kustom Bebas)
            let customSecHtml = '';
            item.custom_sections.forEach((cs, cIdx) => {
                customSecHtml += `
                <div style="background:#fff;border:1px solid #93c5fd;border-radius:10px;padding:14px;margin-bottom:12px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                        <strong style="font-size:13px;color:#1d4ed8;">Blok Seksi Kustom #${cIdx + 1}: ${escHtml(cs.title || 'Seksi Baru')}</strong>
                        <button type="button" class="button button-small" style="color:#dc2626;border-color:#fca5a5;" onclick="bmItems[${idx}].custom_sections.splice(${cIdx},1);renderBmItems();">Hapus Seksi Ini</button>
                    </div>
                    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:8px;margin-bottom:10px;">
                        <div>
                            <label style="font-size:11px;font-weight:700;color:#334155;display:block;">Judul Seksi</label>
                            <input type="text" value="${escHtml(cs.title)}" oninput="bmItems[${idx}].custom_sections[${cIdx}].title = this.value" style="width:100%;font-weight:700;" />
                        </div>
                        <div>
                            <label style="font-size:11px;font-weight:700;color:#334155;display:block;">Badge Atas</label>
                            <input type="text" value="${escHtml(cs.badge)}" oninput="bmItems[${idx}].custom_sections[${cIdx}].badge = this.value" style="width:100%;" />
                        </div>
                        <div>
                            <label style="font-size:11px;font-weight:700;color:#334155;display:block;">Ikon Seksi</label>
                            <select onchange="bmItems[${idx}].custom_sections[${cIdx}].icon = this.value" style="width:100%;">
                                ${buildSelectOptions(bmIconOptions, cs.icon || 'sparkles')}
                            </select>
                        </div>
                        <div>
                            <label style="font-size:11px;font-weight:700;color:#334155;display:block;">Tema Warna Seksi</label>
                            <select onchange="bmItems[${idx}].custom_sections[${cIdx}].color = this.value" style="width:100%;">
                                ${buildSelectOptions(bmColorOptions, cs.color || 'blue')}
                            </select>
                        </div>
                    </div>
                    <div style="margin-bottom:8px;">
                        <label style="font-size:11px;font-weight:700;color:#334155;display:block;">Deskripsi / Penjelasan Seksi</label>
                        <textarea rows="2" oninput="bmItems[${idx}].custom_sections[${cIdx}].desc = this.value" style="width:100%;">${escHtml(cs.desc)}</textarea>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:10px;">
                        <div>
                            <label style="font-size:11px;font-weight:700;color:#334155;display:block;">Kutipan / Quote Opsional</label>
                            <input type="text" value="${escHtml(cs.quote)}" oninput="bmItems[${idx}].custom_sections[${cIdx}].quote = this.value" style="width:100%;" />
                        </div>
                        <div>
                            <label style="font-size:11px;font-weight:700;color:#334155;display:block;">Foto / Banner Seksi Kustom (Opsional)</label>
                            <div style="display:flex;gap:6px;">
                                <input type="text" value="${escHtml(cs.image || '')}" oninput="bmItems[${idx}].custom_sections[${cIdx}].image = this.value" placeholder="URL Gambar Opsional" style="flex:1;" />
                                <button type="button" class="button" onclick="pickBmCustomSecImage(${idx}, ${cIdx})">Pilih Foto</button>
                            </div>
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:10px;">
                        <div style="background:#f8fafc;border:1px solid #e2e8f0;padding:10px;border-radius:8px;">
                            <input type="text" value="${escHtml(cs.col1_title)}" oninput="bmItems[${idx}].custom_sections[${cIdx}].col1_title = this.value" placeholder="Judul Daftar Kiri (Opsional)" style="width:100%;margin-bottom:6px;font-weight:700;" />
                            <textarea rows="4" oninput="bmItems[${idx}].custom_sections[${cIdx}].col1_list = textToLines(this.value)" placeholder="1 baris per poin (Format: Judul | Penjelasan)" style="width:100%;font-size:12px;">${escHtml(linesToText(cs.col1_list))}</textarea>
                        </div>
                        <div style="background:#f8fafc;border:1px solid #e2e8f0;padding:10px;border-radius:8px;">
                            <input type="text" value="${escHtml(cs.col2_title)}" oninput="bmItems[${idx}].custom_sections[${cIdx}].col2_title = this.value" placeholder="Judul Daftar Kanan (Opsional)" style="width:100%;margin-bottom:6px;font-weight:700;" />
                            <textarea rows="4" oninput="bmItems[${idx}].custom_sections[${cIdx}].col2_list = textToLines(this.value)" placeholder="1 baris per poin (Format: Judul | Penjelasan)" style="width:100%;font-size:12px;">${escHtml(linesToText(cs.col2_list))}</textarea>
                        </div>
                    </div>
                </div>`;
            });

            // Render Gallery
            let galleryHtml = '';
            item.media_gallery.forEach((img, gIdx) => {
                galleryHtml += `
                <div style="display:flex;gap:10px;align-items:center;background:#fff;border:1px solid #cbd5e1;padding:8px 10px;border-radius:8px;margin-bottom:8px;">
                    <img src="${escHtml(img.url)}" style="width:56px;height:56px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;" />
                    <div style="flex:1;">
                        <input type="text" value="${escHtml(img.url)}" oninput="bmItems[${idx}].media_gallery[${gIdx}].url = this.value" placeholder="URL Gambar" style="width:100%;margin-bottom:4px;font-size:12px;" />
                        <input type="text" value="${escHtml(img.caption)}" oninput="bmItems[${idx}].media_gallery[${gIdx}].caption = this.value" placeholder="Caption / Keterangan Foto" style="width:100%;font-size:12px;" />
                    </div>
                    <button type="button" class="button" style="color:#dc2626;border-color:#fca5a5;" onclick="bmItems[${idx}].media_gallery.splice(${gIdx},1);renderBmItems();">✕</button>
                </div>`;
            });

            // Render FAQs
            let faqsHtml = '';
            item.faqs.forEach((fq, fIdx) => {
                faqsHtml += `
                <div style="background:#fff;border:1px solid #cbd5e1;border-radius:8px;padding:10px;margin-bottom:8px;">
                    <div style="display:flex;justify-content:space-between;margin-bottom:6px;">
                        <strong style="font-size:12px;color:#334155;">Pertanyaan #${fIdx + 1}</strong>
                        <button type="button" class="button button-small" style="color:#dc2626;border-color:#fca5a5;" onclick="bmItems[${idx}].faqs.splice(${fIdx},1);renderBmItems();">Hapus</button>
                    </div>
                    <input type="text" value="${escHtml(fq.q)}" oninput="bmItems[${idx}].faqs[${fIdx}].q = this.value" placeholder="Pertanyaan..." style="width:100%;margin-bottom:6px;font-weight:600;" />
                    <textarea rows="2" oninput="bmItems[${idx}].faqs[${fIdx}].a = this.value" placeholder="Jawaban..." style="width:100%;">${escHtml(fq.a)}</textarea>
                </div>`;
            });

            html += `
            <div style="background:#fff;border:2px solid #cbd5e1;border-radius:14px;margin-bottom:24px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.04);">
                <!-- Header Bar Item Sidebar -->
                <div style="background:linear-gradient(90deg,#0f172a 0%,#1e293b 100%);color:#fff;padding:14px 20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <span style="background:#10b981;color:#fff;font-weight:800;font-size:12px;padding:3px 10px;border-radius:999px;">Menu Sidebar #${idx + 1}</span>
                        <strong style="font-size:16px;letter-spacing:-0.01em;">${escHtml(item.short_title || item.title)}</strong>
                        <span style="font-size:12px;color:#94a3b8;">(ID: <code>${escHtml(item.id)}</code>)</span>
                    </div>
                    <div style="display:flex;gap:6px;">
                        ${idx > 0 ? `<button type="button" class="button button-small" onclick="moveBmItem(${idx}, -1)">↑ Naik</button>` : ''}
                        ${idx < bmItems.length - 1 ? `<button type="button" class="button button-small" onclick="moveBmItem(${idx}, 1)">↓ Turun</button>` : ''}
                        <button type="button" class="button button-small" style="color:#fecaca;background:#7f1d1d;border-color:#991b1b;" onclick="removeBmItem(${idx})">🗑️ Hapus Menu Ini</button>
                    </div>
                </div>

                <div style="padding:20px;">
                    <!-- BAGIAN A: IDENTITAS MENU SIDEBAR & CARD UTAMA -->
                    <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px;margin-bottom:18px;">
                        <h4 style="margin:0 0 12px 0;font-size:14px;font-weight:800;color:#0f766e;border-bottom:1px solid #e2e8f0;padding-bottom:8px;">
                            A. Identitas Menu Sidebar &amp; Card Pengantar Utama
                        </h4>
                        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:12px;margin-bottom:12px;">
                            <div>
                                <label style="font-size:11.5px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Nama Menu di Sidebar Kiri</label>
                                <input type="text" value="${escHtml(item.short_title)}" oninput="bmItems[${idx}].short_title = this.value" style="width:100%;font-weight:700;" />
                            </div>
                            <div>
                                <label style="font-size:11.5px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Judul Lengkap di Konten Kanan</label>
                                <input type="text" value="${escHtml(item.title)}" oninput="bmItems[${idx}].title = this.value" style="width:100%;font-weight:700;" />
                            </div>
                            <div>
                                <label style="font-size:11.5px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Badge Atas Card</label>
                                <input type="text" value="${escHtml(item.badge)}" oninput="bmItems[${idx}].badge = this.value" style="width:100%;" />
                            </div>
                            <div>
                                <label style="font-size:11.5px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Ikon Menu Sidebar (16 Pilihan)</label>
                                <select onchange="bmItems[${idx}].icon = this.value" style="width:100%;">
                                    ${buildSelectOptions(bmIconOptions, item.icon || 'heart')}
                                </select>
                            </div>
                            <div>
                                <label style="font-size:11.5px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Warna Tema Menu (Saat Diklik) &amp; Card Utama</label>
                                <select onchange="bmItems[${idx}].color = this.value" style="width:100%;">
                                    ${buildSelectOptions(bmColorOptions, item.color || 'teal')}
                                </select>
                            </div>
                        </div>

                        <div style="margin-bottom:12px;">
                            <label style="font-size:11.5px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Ringkasan Pendek di Bawah Nama Menu Sidebar</label>
                            <input type="text" value="${escHtml(item.summary)}" oninput="bmItems[${idx}].summary = this.value" style="width:100%;" />
                        </div>

                        <div style="margin-bottom:12px;">
                            <label style="font-size:11.5px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Paragraf Pengantar Atas (Intro Highlight)</label>
                            <textarea rows="2" oninput="bmItems[${idx}].intro = this.value" style="width:100%;">${escHtml(item.intro)}</textarea>
                        </div>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
                            <div>
                                <label style="font-size:11.5px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Foto / Banner Utama Card (Opsional)</label>
                                <div style="display:flex;gap:8px;">
                                    <input type="text" value="${escHtml(item.main_image)}" oninput="bmItems[${idx}].main_image = this.value" placeholder="Kosongkan jika tidak pakai foto banner" style="flex:1;" />
                                    <button type="button" class="button" onclick="pickBmSingleImage(${idx}, 'main_image')">Pilih Foto</button>
                                </div>
                            </div>
                            <div>
                                <label style="font-size:11.5px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Keterangan / Caption Foto Utama (Opsional)</label>
                                <input type="text" value="${escHtml(item.main_image_caption)}" oninput="bmItems[${idx}].main_image_caption = this.value" style="width:100%;" />
                            </div>
                        </div>

                        <div style="margin-bottom:12px;">
                            <label style="font-size:11.5px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Kutipan Ayat / Hadits / Quote Utama (Opsional)</label>
                            <textarea rows="2" oninput="bmItems[${idx}].main_quote = this.value" placeholder="Contoh: QS. Al-Baqarah: 261..." style="width:100%;">${escHtml(item.main_quote)}</textarea>
                        </div>

                        <div>
                            <label style="font-size:11.5px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Isi Keterangan Lengkap Card Utama</label>
                            <textarea rows="4" oninput="bmItems[${idx}].main_content = this.value" style="width:100%;">${escHtml(item.main_content)}</textarea>
                        </div>
                    </div>

                    <!-- BAGIAN B: SAKLAR MODUL KONTEN (TOGGLE SIMPEL / KOMPLEKS / BEBAS) -->
                    <div style="margin-bottom:10px;">
                        <h4 style="margin:0 0 6px 0;font-size:14px;font-weight:800;color:#0f172a;">
                            B. Saklar Modul Card &amp; Seksi Konten (Centang Sesuai Kebutuhan — Judul &amp; Warna 100% Bebas Diubah)
                        </h4>
                        <p style="margin:0 0 12px 0;font-size:12px;color:#64748b;">
                            Semua judul blok di bawah ini fleksibel (bisa digunakan untuk Tujuan/Sasaran/Manfaat, Program Sosial, Santunan, maupun Zakat/Infak/Wakaf).
                        </p>
                    </div>

                    <!-- MODUL 1: DERETAN KARTU INFORMASI BERIKON -->
                    <div style="border:1px solid ${item.show_pillars ? '#10b981' : '#cbd5e1'};background:${item.show_pillars ? '#f0fdf4' : '#f8fafc'};border-radius:10px;padding:14px;margin-bottom:14px;">
                        <label style="display:flex;align-items:center;gap:10px;font-weight:800;font-size:13.5px;color:#065f46;cursor:pointer;">
                            <input type="checkbox" ${item.show_pillars ? 'checked' : ''} onchange="bmItems[${idx}].show_pillars = this.checked; renderBmItems();" />
                            <span>1. Tampilkan Deretan Kartu Informasi Berikon (Contoh: Tujuan, Sasaran &amp; Manfaat / Bidang Fokus Kegiatan)</span>
                        </label>
                        ${item.show_pillars ? `
                        <div style="margin-top:14px;padding-top:12px;border-top:1px dashed #86efac;">
                            <div style="display:grid;grid-template-columns:2fr 1fr;gap:10px;margin-bottom:10px;">
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#065f46;display:block;margin-bottom:4px;">Judul Seksi Kartu Informasi</label>
                                    <input type="text" value="${escHtml(item.pillars_section_title)}" oninput="bmItems[${idx}].pillars_section_title = this.value" style="width:100%;" />
                                </div>
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#065f46;display:block;margin-bottom:4px;">Label Kanan Header (Opsional, misal: 3 Pokok Bahasan)</label>
                                    <input type="text" value="${escHtml(item.pillars_section_badge || '')}" oninput="bmItems[${idx}].pillars_section_badge = this.value" placeholder="Kosongkan jika tidak perlu" style="width:100%;" />
                                </div>
                            </div>
                            ${cardsHtml}
                            <button type="button" class="button" onclick="addBmPillar(${idx})" style="font-weight:700;color:#065f46;border-color:#10b981;">+ Tambah Kartu Informasi Baru</button>
                        </div>` : ''}
                    </div>

                    <!-- MODUL 2: BLOK SEKSI + 2 KARTU DAFTAR BERSAMPINGAN (ZAKAT / PROGRAM SOSIAL LAINNYA) -->
                    <div style="border:1px solid ${item.show_zakat ? '#0d9488' : '#cbd5e1'};background:${item.show_zakat ? '#f0fdfa' : '#f8fafc'};border-radius:10px;padding:14px;margin-bottom:14px;">
                        <label style="display:flex;align-items:center;gap:10px;font-weight:800;font-size:13.5px;color:#0f766e;cursor:pointer;">
                            <input type="checkbox" ${item.show_zakat ? 'checked' : ''} onchange="bmItems[${idx}].show_zakat = this.checked; renderBmItems();" />
                            <span>2. Tampilkan Blok Seksi + 2 Kartu Daftar Bersampingan (Misal: Zakat &amp; Penerima/Syarat, atau Program Sosial Lainnya)</span>
                        </label>
                        ${item.show_zakat ? `
                        <div style="margin-top:14px;padding-top:12px;border-top:1px dashed #5eead4;">
                            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:10px;margin-bottom:10px;">
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#0f766e;display:block;">Badge Seksi</label>
                                    <input type="text" value="${escHtml(item.zakat_badge)}" oninput="bmItems[${idx}].zakat_badge = this.value" style="width:100%;" />
                                </div>
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#0f766e;display:block;">Judul Seksi (Bebas Diubah)</label>
                                    <input type="text" value="${escHtml(item.zakat_title)}" oninput="bmItems[${idx}].zakat_title = this.value" style="width:100%;font-weight:700;" />
                                </div>
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#0f766e;display:block;">Ikon Seksi</label>
                                    <select onchange="bmItems[${idx}].zakat_icon = this.value" style="width:100%;">
                                        ${buildSelectOptions(bmIconOptions, item.zakat_icon || 'scale')}
                                    </select>
                                </div>
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#0f766e;display:block;">Tema Warna Seksi</label>
                                    <select onchange="bmItems[${idx}].zakat_color = this.value" style="width:100%;">
                                        ${buildSelectOptions(bmColorOptions, item.zakat_color || 'teal')}
                                    </select>
                                </div>
                            </div>
                            <div style="margin-bottom:10px;">
                                <label style="font-size:11.5px;font-weight:700;color:#0f766e;display:block;">Keterangan Penjelasan</label>
                                <textarea rows="3" oninput="bmItems[${idx}].zakat_desc = this.value" style="width:100%;">${escHtml(item.zakat_desc)}</textarea>
                            </div>
                            <div style="margin-bottom:14px;">
                                <label style="font-size:11.5px;font-weight:700;color:#0f766e;display:block;">Kutipan Ayat / Dalil / Quote (Opsional)</label>
                                <textarea rows="2" oninput="bmItems[${idx}].zakat_quote = this.value" style="width:100%;">${escHtml(item.zakat_quote)}</textarea>
                            </div>
                            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:14px;">
                                <div style="background:#fff;border:1px solid #99f6e4;border-radius:8px;padding:12px;">
                                    <strong style="font-size:12.5px;color:#0f766e;display:block;margin-bottom:8px;">Kartu Daftar Kiri (Misal: Penerima Manfaat / 8 Asnaf)</strong>
                                    <input type="text" value="${escHtml(item.zakat_asnaf_title)}" oninput="bmItems[${idx}].zakat_asnaf_title = this.value" placeholder="Judul Kartu Kiri" style="width:100%;margin-bottom:6px;font-weight:700;" />
                                    <input type="text" value="${escHtml(item.zakat_asnaf_subtitle)}" oninput="bmItems[${idx}].zakat_asnaf_subtitle = this.value" placeholder="Sub-judul pengantar" style="width:100%;margin-bottom:6px;font-size:12px;" />
                                    <label style="font-size:11px;color:#64748b;display:block;margin-bottom:4px;">Daftar Item (1 baris per poin, format: <code>Judul | Penjelasan</code>)</label>
                                    <textarea rows="7" oninput="bmItems[${idx}].zakat_asnaf_list = textToLines(this.value)" style="width:100%;font-size:12px;">${escHtml(linesToText(item.zakat_asnaf_list))}</textarea>
                                </div>
                                <div style="background:#fff;border:1px solid #99f6e4;border-radius:8px;padding:12px;">
                                    <strong style="font-size:12.5px;color:#0f766e;display:block;margin-bottom:8px;">Kartu Daftar Kanan (Misal: Syarat Wajib / Ketentuan)</strong>
                                    <input type="text" value="${escHtml(item.zakat_syarat_title)}" oninput="bmItems[${idx}].zakat_syarat_title = this.value" placeholder="Judul Kartu Kanan" style="width:100%;margin-bottom:6px;font-weight:700;" />
                                    <input type="text" value="${escHtml(item.zakat_syarat_subtitle)}" oninput="bmItems[${idx}].zakat_syarat_subtitle = this.value" placeholder="Sub-judul pengantar" style="width:100%;margin-bottom:6px;font-size:12px;" />
                                    <label style="font-size:11px;color:#64748b;display:block;margin-bottom:4px;">Daftar Item (1 baris per poin, format: <code>Judul | Penjelasan</code>)</label>
                                    <textarea rows="7" oninput="bmItems[${idx}].zakat_syarat_list = textToLines(this.value)" style="width:100%;font-size:12px;">${escHtml(linesToText(item.zakat_syarat_list))}</textarea>
                                </div>
                            </div>
                        </div>` : ''}
                    </div>

                    <!-- MODUL 3: BLOK SEKSI PENJELASAN + GRID POIN (INFAK & SEDEKAH / PROGRAM SOSIAL) -->
                    <div style="border:1px solid ${item.show_sedekah ? '#d97706' : '#cbd5e1'};background:${item.show_sedekah ? '#fffbeb' : '#f8fafc'};border-radius:10px;padding:14px;margin-bottom:14px;">
                        <label style="display:flex;align-items:center;gap:10px;font-weight:800;font-size:13.5px;color:#b45309;cursor:pointer;">
                            <input type="checkbox" ${item.show_sedekah ? 'checked' : ''} onchange="bmItems[${idx}].show_sedekah = this.checked; renderBmItems();" />
                            <span>3. Tampilkan Blok Seksi Penjelasan + Grid Poin Manfaat (Misal: Infak &amp; Sedekah, atau Kegiatan Santunan)</span>
                        </label>
                        ${item.show_sedekah ? `
                        <div style="margin-top:14px;padding-top:12px;border-top:1px dashed #fcd34d;">
                            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:10px;margin-bottom:10px;">
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#b45309;display:block;">Badge Seksi</label>
                                    <input type="text" value="${escHtml(item.sedekah_badge)}" oninput="bmItems[${idx}].sedekah_badge = this.value" style="width:100%;" />
                                </div>
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#b45309;display:block;">Judul Seksi (Bebas Diubah)</label>
                                    <input type="text" value="${escHtml(item.sedekah_title)}" oninput="bmItems[${idx}].sedekah_title = this.value" style="width:100%;font-weight:700;" />
                                </div>
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#b45309;display:block;">Ikon Seksi</label>
                                    <select onchange="bmItems[${idx}].sedekah_icon = this.value" style="width:100%;">
                                        ${buildSelectOptions(bmIconOptions, item.sedekah_icon || 'hand-heart')}
                                    </select>
                                </div>
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#b45309;display:block;">Tema Warna Seksi</label>
                                    <select onchange="bmItems[${idx}].sedekah_color = this.value" style="width:100%;">
                                        ${buildSelectOptions(bmColorOptions, item.sedekah_color || 'amber')}
                                    </select>
                                </div>
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#b45309;display:block;">Foto Opsional</label>
                                    <div style="display:flex;gap:6px;">
                                        <input type="text" value="${escHtml(item.sedekah_image)}" oninput="bmItems[${idx}].sedekah_image = this.value" style="flex:1;" />
                                        <button type="button" class="button" onclick="pickBmSingleImage(${idx}, 'sedekah_image')">Pilih</button>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-bottom:10px;">
                                <label style="font-size:11.5px;font-weight:700;color:#b45309;display:block;">Keterangan Penjelasan</label>
                                <textarea rows="3" oninput="bmItems[${idx}].sedekah_desc = this.value" style="width:100%;">${escHtml(item.sedekah_desc)}</textarea>
                            </div>
                            <div style="margin-bottom:10px;">
                                <label style="font-size:11.5px;font-weight:700;color:#b45309;display:block;">Kutipan Ayat / Hadits / Quote (Opsional)</label>
                                <textarea rows="2" oninput="bmItems[${idx}].sedekah_quote = this.value" style="width:100%;">${escHtml(item.sedekah_quote)}</textarea>
                            </div>
                            <div style="background:#fff;border:1px solid #fde68a;border-radius:8px;padding:12px;">
                                <label style="font-size:11.5px;font-weight:700;color:#b45309;display:block;margin-bottom:4px;">Judul Daftar Keutamaan / Poin</label>
                                <input type="text" value="${escHtml(item.sedekah_points_title)}" oninput="bmItems[${idx}].sedekah_points_title = this.value" style="width:100%;max-width:450px;margin-bottom:8px;font-weight:700;" />
                                <label style="font-size:11px;color:#64748b;display:block;margin-bottom:4px;">Daftar Poin (1 baris per poin, format: <code>Judul Poin | Penjelasan</code>)</label>
                                <textarea rows="5" oninput="bmItems[${idx}].sedekah_points = textToLines(this.value)" style="width:100%;font-size:12px;">${escHtml(linesToText(item.sedekah_points))}</textarea>
                            </div>
                        </div>` : ''}
                    </div>

                    <!-- MODUL 4: BLOK SEKSI + 2 KOLOM KEUNGGULAN & RUANG LINGKUP (WAKAF / PRINSIP PROGRAM) -->
                    <div style="border:1px solid ${item.show_wakaf ? '#4f46e5' : '#cbd5e1'};background:${item.show_wakaf ? '#eef2ff' : '#f8fafc'};border-radius:10px;padding:14px;margin-bottom:14px;">
                        <label style="display:flex;align-items:center;gap:10px;font-weight:800;font-size:13.5px;color:#3730a3;cursor:pointer;">
                            <input type="checkbox" ${item.show_wakaf ? 'checked' : ''} onchange="bmItems[${idx}].show_wakaf = this.checked; renderBmItems();" />
                            <span>4. Tampilkan Blok Seksi + 2 Kolom Keunggulan &amp; Ruang Lingkup (Misal: Wakaf, atau Tata Kelola Program Sosial)</span>
                        </label>
                        ${item.show_wakaf ? `
                        <div style="margin-top:14px;padding-top:12px;border-top:1px dashed #a5b4fc;">
                            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:10px;margin-bottom:10px;">
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#3730a3;display:block;">Badge Seksi</label>
                                    <input type="text" value="${escHtml(item.wakaf_badge)}" oninput="bmItems[${idx}].wakaf_badge = this.value" style="width:100%;" />
                                </div>
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#3730a3;display:block;">Judul Seksi (Bebas Diubah)</label>
                                    <input type="text" value="${escHtml(item.wakaf_title)}" oninput="bmItems[${idx}].wakaf_title = this.value" style="width:100%;font-weight:700;" />
                                </div>
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#3730a3;display:block;">Ikon Seksi</label>
                                    <select onchange="bmItems[${idx}].wakaf_icon = this.value" style="width:100%;">
                                        ${buildSelectOptions(bmIconOptions, item.wakaf_icon || 'building')}
                                    </select>
                                </div>
                                <div>
                                    <label style="font-size:11.5px;font-weight:700;color:#3730a3;display:block;">Tema Warna Seksi</label>
                                    <select onchange="bmItems[${idx}].wakaf_color = this.value" style="width:100%;">
                                        ${buildSelectOptions(bmColorOptions, item.wakaf_color || 'indigo')}
                                    </select>
                                </div>
                            </div>
                            <div style="margin-bottom:10px;">
                                <label style="font-size:11.5px;font-weight:700;color:#3730a3;display:block;">Keterangan Penjelasan</label>
                                <textarea rows="3" oninput="bmItems[${idx}].wakaf_desc = this.value" style="width:100%;">${escHtml(item.wakaf_desc)}</textarea>
                            </div>
                            <div style="margin-bottom:14px;">
                                <label style="font-size:11.5px;font-weight:700;color:#3730a3;display:block;">Kutipan Ayat / Hadits / Quote (Opsional)</label>
                                <textarea rows="2" oninput="bmItems[${idx}].wakaf_quote = this.value" style="width:100%;">${escHtml(item.wakaf_quote)}</textarea>
                            </div>
                            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:14px;">
                                <div style="background:#fff;border:1px solid #c7d2fe;border-radius:8px;padding:12px;">
                                    <strong style="font-size:12.5px;color:#3730a3;display:block;margin-bottom:8px;">Kolom Kiri (Misal: Keunggulan / Prinsip)</strong>
                                    <input type="text" value="${escHtml(item.wakaf_keunggulan_title)}" oninput="bmItems[${idx}].wakaf_keunggulan_title = this.value" style="width:100%;margin-bottom:6px;font-weight:700;" />
                                    <label style="font-size:11px;color:#64748b;display:block;margin-bottom:4px;">Daftar Poin (1 baris per poin, format: <code>Judul | Penjelasan</code>)</label>
                                    <textarea rows="6" oninput="bmItems[${idx}].wakaf_keunggulan_list = textToLines(this.value)" style="width:100%;font-size:12px;">${escHtml(linesToText(item.wakaf_keunggulan_list))}</textarea>
                                </div>
                                <div style="background:#fff;border:1px solid #c7d2fe;border-radius:8px;padding:12px;">
                                    <strong style="font-size:12.5px;color:#3730a3;display:block;margin-bottom:8px;">Kolom Kanan (Misal: Ruang Lingkup / Bentuk Kegiatan)</strong>
                                    <input type="text" value="${escHtml(item.wakaf_program_title)}" oninput="bmItems[${idx}].wakaf_program_title = this.value" style="width:100%;margin-bottom:6px;font-weight:700;" />
                                    <label style="font-size:11px;color:#64748b;display:block;margin-bottom:4px;">Daftar Poin (1 baris per poin, format: <code>Judul | Penjelasan</code>)</label>
                                    <textarea rows="6" oninput="bmItems[${idx}].wakaf_program_list = textToLines(this.value)" style="width:100%;font-size:12px;">${escHtml(linesToText(item.wakaf_program_list))}</textarea>
                                </div>
                            </div>
                        </div>` : ''}
                    </div>

                    <!-- MODUL TAMBAHAN BEBAS: BLOK SEKSI KUSTOM DINAMIS (BISA TAMBAH BERAPA SAJA DENGAN JUDUL BEBAS) -->
                    <div style="border:1px solid #3b82f6;background:#eff6ff;border-radius:10px;padding:14px;margin-bottom:14px;">
                        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                            <div>
                                <strong style="font-size:13.5px;color:#1e40af;display:block;">➕ Blok Seksi Konten Kustom Bebas (${item.custom_sections.length} Seksi Aktif)</strong>
                                <span style="font-size:11.5px;color:#1d4ed8;">Ingin membuat seksi dengan judul sendiri di luar format di atas? Klik tombol di kanan untuk menambah seksi baru secara bebas.</span>
                            </div>
                            <button type="button" class="button" onclick="addBmCustomSection(${idx})" style="background:#2563eb;color:#fff;border-color:#1d4ed8;font-weight:700;">+ Tambah Blok Seksi Konten Kustom</button>
                        </div>
                        ${item.custom_sections.length ? `<div style="margin-top:12px;padding-top:12px;border-top:1px dashed #93c5fd;">${customSecHtml}</div>` : ''}
                    </div>

                    <!-- MODUL 5: GALERI FOTO / INFOGRAFIS -->
                    <div style="border:1px solid ${item.show_gallery ? '#0f766e' : '#cbd5e1'};background:${item.show_gallery ? '#f0fdf4' : '#f8fafc'};border-radius:10px;padding:14px;margin-bottom:14px;">
                        <label style="display:flex;align-items:center;gap:10px;font-weight:800;font-size:13.5px;color:#0f766e;cursor:pointer;">
                            <input type="checkbox" ${item.show_gallery ? 'checked' : ''} onchange="bmItems[${idx}].show_gallery = this.checked; renderBmItems();" />
                            <span>5. Tampilkan Galeri Foto Dokumentasi / Infografis</span>
                        </label>
                        ${item.show_gallery ? `
                        <div style="margin-top:14px;padding-top:12px;border-top:1px dashed #86efac;">
                            <div style="margin-bottom:10px;">
                                <label style="font-size:11.5px;font-weight:700;color:#0f766e;display:block;margin-bottom:4px;">Judul Seksi Galeri</label>
                                <input type="text" value="${escHtml(item.gallery_title)}" oninput="bmItems[${idx}].gallery_title = this.value" style="width:100%;max-width:450px;" />
                            </div>
                            ${galleryHtml}
                            <button type="button" class="button" onclick="pickBmGalleryImages(${idx})" style="font-weight:700;">🖼️ + Pilih Foto dari Media Library</button>
                        </div>` : ''}
                    </div>

                    <!-- MODUL 6: TANYA JAWAB (FAQ) -->
                    <div style="border:1px solid ${item.show_faqs ? '#0f766e' : '#cbd5e1'};background:#f8fafc;border-radius:10px;padding:14px;">
                        <label style="display:flex;align-items:center;gap:10px;font-weight:800;font-size:13.5px;color:#334155;cursor:pointer;">
                            <input type="checkbox" ${item.show_faqs ? 'checked' : ''} onchange="bmItems[${idx}].show_faqs = this.checked; renderBmItems();" />
                            <span>6. Tampilkan Tanya Jawab (FAQ) di Bawah Konten</span>
                        </label>
                        ${item.show_faqs ? `
                        <div style="margin-top:14px;padding-top:12px;border-top:1px dashed #cbd5e1;">
                            <div style="margin-bottom:10px;">
                                <label style="font-size:11.5px;font-weight:700;color:#334155;display:block;margin-bottom:4px;">Judul Seksi Tanya Jawab (FAQ)</label>
                                <input type="text" value="${escHtml(item.faq_section_title || 'Tanya Jawab (FAQ)')}" oninput="bmItems[${idx}].faq_section_title = this.value" style="width:100%;max-width:450px;font-weight:700;" />
                            </div>
                            ${faqsHtml}
                            <button type="button" class="button" onclick="addBmFaq(${idx})" style="font-weight:700;">+ Tambah Pertanyaan FAQ</button>
                        </div>` : ''}
                    </div>
                </div>
            </div>`;
        });

        container.innerHTML = html;
    }

    function addBmSidebarItem() {
        const newIndex = bmItems.length + 1;
        bmItems.push({
            id: 'menu-baitul-maal-' + newIndex,
            title: 'Menu Informasi Baitul Maal #' + newIndex,
            short_title: 'Menu Baru #' + newIndex,
            badge: 'Program Sosial Syariah',
            icon: 'heart',
            color: 'teal',
            summary: 'Ringkasan singkat mengenai menu informasi atau program sosial ini.',
            intro: 'Tuliskan paragraf pengantar singkat di sini.',
            main_image: '',
            main_image_caption: '',
            main_quote: '',
            main_content: 'Tuliskan penjelasan lengkap mengenai program atau informasi Baitul Maal di sini.',
            show_pillars: true,
            pillars_section_title: 'Tujuan, Sasaran & Manfaat',
            pillars_section_badge: '3 Pokok Bahasan',
            pillar_cards: [
                { title: 'Tujuan', badge: 'Arah & Orientasi', icon: 'target', color: 'teal', desc: 'Tuliskan tujuan program di sini.' },
                { title: 'Sasaran', badge: 'Penerima Manfaat', icon: 'users', color: 'blue', desc: 'Tuliskan sasaran penerima manfaat di sini.' },
                { title: 'Manfaat', badge: 'Dampak Kebaikan', icon: 'sparkles', color: 'amber', desc: 'Tuliskan manfaat program di sini.' }
            ],
            show_zakat: false,
            zakat_color: 'teal',
            zakat_icon: 'scale',
            zakat_badge: 'Ketentuan Program',
            zakat_title: 'Judul Seksi Informasi',
            zakat_desc: '',
            zakat_quote: '',
            zakat_asnaf_title: 'Daftar Kiri',
            zakat_asnaf_subtitle: '',
            zakat_asnaf_list: [],
            zakat_syarat_title: 'Daftar Kanan',
            zakat_syarat_subtitle: '',
            zakat_syarat_list: [],
            show_sedekah: false,
            sedekah_color: 'amber',
            sedekah_icon: 'hand-heart',
            sedekah_badge: 'Keutamaan Program',
            sedekah_title: 'Judul Seksi Penjelasan',
            sedekah_image: '',
            sedekah_desc: '',
            sedekah_quote: '',
            sedekah_points_title: 'Poin Utama & Manfaat',
            sedekah_points: [],
            show_wakaf: false,
            wakaf_color: 'indigo',
            wakaf_icon: 'building',
            wakaf_badge: 'Keberlanjutan Manfaat',
            wakaf_title: 'Judul Seksi Ruang Lingkup',
            wakaf_desc: '',
            wakaf_quote: '',
            wakaf_keunggulan_title: 'Keunggulan Utama',
            wakaf_keunggulan_list: [],
            wakaf_program_title: 'Program & Kegiatan',
            wakaf_program_list: [],
            custom_sections: [],
            show_gallery: false,
            gallery_title: 'Dokumentasi & Infografis',
            media_gallery: [],
            show_faqs: false,
            faq_section_title: 'Tanya Jawab Seputar Menu Ini',
            faqs: []
        });
        renderBmItems();
    }

    function addBmCustomSection(idx) {
        if (!Array.isArray(bmItems[idx].custom_sections)) {
            bmItems[idx].custom_sections = [];
        }
        bmItems[idx].custom_sections.push({
            badge: 'Informasi Program',
            title: 'Judul Seksi Kustom Baru',
            icon: 'sparkles',
            color: 'blue',
            desc: 'Tuliskan penjelasan mengenai seksi program atau kegiatan ini.',
            quote: '',
            image: '',
            col1_title: 'Poin Utama Kiri',
            col1_list: ['Poin Pertama | Penjelasan singkat mengenai poin pertama.'],
            col2_title: 'Poin Utama Kanan',
            col2_list: ['Poin Kedua | Penjelasan singkat mengenai poin kedua.']
        });
        renderBmItems();
    }

    function removeBmItem(idx) {
        if (bmItems.length <= 1) {
            alert('Minimal harus terdapat 1 menu sidebar pada halaman Baitul Maal BSW.');
            return;
        }
        if (confirm('Hapus menu sidebar "' + (bmItems[idx].short_title || bmItems[idx].title) + '"?')) {
            bmItems.splice(idx, 1);
            renderBmItems();
        }
    }

    function moveBmItem(idx, dir) {
        const target = idx + dir;
        if (target < 0 || target >= bmItems.length) return;
        const temp = bmItems[idx];
        bmItems[idx] = bmItems[target];
        bmItems[target] = temp;
        renderBmItems();
    }

    function addBmPillar(idx) {
        const defaultColors = ['teal', 'blue', 'amber', 'purple', 'emerald', 'indigo'];
        const nextColor = defaultColors[bmItems[idx].pillar_cards.length % defaultColors.length];
        bmItems[idx].pillar_cards.push({
            title: 'Judul Kartu Baru',
            badge: 'Fokus Program',
            icon: 'sparkles',
            color: nextColor,
            desc: 'Tuliskan poin atau penjelasan di sini.'
        });
        renderBmItems();
    }

    function removeBmPillar(idx, pIdx) {
        bmItems[idx].pillar_cards.splice(pIdx, 1);
        renderBmItems();
    }

    function addBmFaq(idx) {
        bmItems[idx].faqs.push({ q: '', a: '' });
        renderBmItems();
    }

    function pickBmSingleImage(idx, fieldName) {
        const frame = wp.media({
            title: 'Pilih Gambar / Foto',
            button: { text: 'Gunakan Foto Ini' },
            multiple: false
        });
        frame.on('select', function() {
            const attachment = frame.state().get('selection').first().toJSON();
            if (attachment && attachment.url) {
                bmItems[idx][fieldName] = attachment.url;
                renderBmItems();
            }
        });
        frame.open();
    }

    function pickBmCustomSecImage(idx, cIdx) {
        const frame = wp.media({
            title: 'Pilih Foto Seksi Kustom',
            button: { text: 'Gunakan Foto Ini' },
            multiple: false
        });
        frame.on('select', function() {
            const attachment = frame.state().get('selection').first().toJSON();
            if (attachment && attachment.url) {
                bmItems[idx].custom_sections[cIdx].image = attachment.url;
                renderBmItems();
            }
        });
        frame.open();
    }

    function pickBmGalleryImages(idx) {
        const frame = wp.media({
            title: 'Pilih Foto Dokumentasi / Infografis',
            button: { text: 'Tambahkan ke Galeri' },
            multiple: true
        });
        frame.on('select', function() {
            const selection = frame.state().get('selection');
            selection.each(function(attachment) {
                const json = attachment.toJSON();
                if (json && json.url) {
                    bmItems[idx].media_gallery.push({
                        url: json.url,
                        caption: json.caption || json.title || ''
                    });
                }
            });
            renderBmItems();
        });
        frame.open();
    }

    function syncBmHiddenInputs() {
        document.getElementById('bm_items_json').value = JSON.stringify(bmItems);
        document.getElementById('bm_rekening_json').value = JSON.stringify(bmRekening);
    }

    document.addEventListener('DOMContentLoaded', function() {
        renderBmItems();
        renderBmRekening();
    });
    </script>
    <?php
}
