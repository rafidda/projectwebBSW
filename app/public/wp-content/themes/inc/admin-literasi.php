<?php
/**
 * Admin: Literasi & Inklusi Keuangan Syariah Insan Bank Syariah Wakalumi (BSW)
 * 
 * Pengelolaan terpadu materi edukasi syariah, pilar aksi nyata inklusi keuangan,
 * formulir pengajuan sosialisasi komunitas, serta keterbukaan informasi regulasi POJK.
 * 
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ── 1. DATA HELPERS ─────────────────────────────────────────────────

if ( ! function_exists( 'wakalumi_get_literasi_header' ) ) {
    /**
     * Mengambil teks pengantar dan judul header halaman literasi & inklusi.
     *
     * @return array
     */
    function wakalumi_get_literasi_header() {
        $badge = get_option( 'options_literasi_badge', 'Program Edukasi & Inklusi Keuangan Syariah' );
        $title = get_option( 'options_literasi_title', 'Membangun Kesejahteraan Finansial Umat Berbasis Syariat' );
        $title = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $title );
        $desc  = get_option( 'options_literasi_desc', 'Komitmen berkelanjutan PT BPRS Wakalumi (Bank Syariah Wakalumi) dalam memperluas literasi keuangan syariah yang amanah serta membuka akses perbankan inklusif bagi seluruh lapisan masyarakat, guru, dan pelaku UMKM.' );

        return [
            'badge' => $badge,
            'title' => $title,
            'desc'  => $desc,
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_literasi_pillars_section' ) ) {
    /**
     * Mengambil pengaturan judul dan pengantar seksi Pilar Inklusi Keuangan.
     *
     * @return array
     */
    function wakalumi_get_literasi_pillars_section() {
        return [
            'badge' => get_option( 'options_literasi_pillars_badge', 'Inklusi Keuangan' ),
            'title' => get_option( 'options_literasi_pillars_title', 'Pilar Aksi Nyata Inklusi Keuangan Syariah BSW' ),
            'desc'  => get_option( 'options_literasi_pillars_desc', 'Membuka pintu akses perbankan seluas-luasnya bagi masyarakat dan pelaku usaha mikro melalui pendekatan proaktif serta kemitraan yang memberdayakan.' ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_default_literasi_pillars' ) ) {
    /**
     * Mengambil 3 pilar utama program Inklusi Keuangan Bank Syariah Wakalumi baku (Default).
     *
     * @return array
     */
    function wakalumi_get_default_literasi_pillars() {
        return [
            [
                'id'       => 'pilar_1',
                'title'    => 'Layanan Jemput Bola Pasar',
                'sub'      => 'Akses Transaksi Bebas Hambatan',
                'desc'     => 'Petugas operasional dan Account Officer kami mendatangi langsung pedagang pasar tradisional, warung, dan tempat usaha nasabah untuk transaksi setor/tarik tabungan serta verifikasi pembiayaan mikro syariah tanpa mengganggu waktu berdagang.',
                'tag'      => 'Pasar & Mikro',
                'icon'     => 'truck',
            ],
            [
                'id'       => 'pilar_2',
                'title'    => 'Kemitraan Guru & Sekolah',
                'sub'      => 'Solusi Finansial Tenaga Pendidik',
                'desc'     => 'Menyediakan akses layanan simpanan dan pembiayaan syariah bagi para guru dan tenaga kependidikan di sekolah-sekolah, didukung sosialisasi perencanaan keuangan keluarga berakad syariah yang amanah.',
                'tag'      => 'Guru & Sekolah',
                'icon'     => 'academic-cap',
            ],
            [
                'id'       => 'pilar_3',
                'title'    => 'Dukungan Permodalan UMKM',
                'sub'      => 'Kemudahan Modal Usaha Syariah',
                'desc'     => 'Mendukung pertumbuhan usaha mikro, kecil, dan menengah melalui skema pembiayaan modal kerja dan investasi syariah yang mudah, transparan, serta mengedepankan prinsip tolong-menolong (ta\'awun) dan bagi hasil yang adil.',
                'tag'      => 'Permodalan UMKM',
                'icon'     => 'sparkles',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_literasi_pillars' ) ) {
    /**
     * Mengambil daftar 3 pilar inklusi dari database atau default.
     *
     * @return array
     */
    function wakalumi_get_literasi_pillars() {
        $saved = get_option( 'options_literasi_pillars_list', null );
        if ( is_array( $saved ) && ! empty( $saved ) ) {
            return $saved;
        }

        return wakalumi_get_default_literasi_pillars();
    }
}

if ( ! function_exists( 'wakalumi_get_default_literasi_modules' ) ) {
    /**
     * Daftar modul dan topik edukasi literasi keuangan syariah baku (Default Seeder).
     *
     * @return array
     */
    function wakalumi_get_default_literasi_modules() {
        return [
            [
                'id'          => 'modul_1',
                'kategori'    => 'dasar',
                'kat_label'   => 'Prinsip Dasar Syariah',
                'sasaran'     => 'Masyarakat Umum',
                'judul'       => 'Prinsip Fikih Muamalah Bebas Riba',
                'ringkasan'   => 'Memahami filosofi keadilan ekonomi Islam yang melarang bunga (riba), spekulasi berlebih (maisir), dan ketidakjelasan transaksi (gharar) demi melindungi hak sesama manusia.',
                'isi_lengkap' => "Perbankan syariah berlandaskan pada prinsip keadilan, keterbukaan, dan kemaslahatan bersama sesuai syariat Islam.\n\nPrinsip Utama yang Ditegakkan:\n1. Bebas Riba (Bunga): Keuntungan diperoleh dari transaksi riil jual-beli (margin) atau bagi hasil usaha nyata (nisbah), bukan dari tambahan bunga atas pinjaman uang.\n2. Bebas Gharar (Ketidakjelasan): Seluruh akad, biaya, hak, dan kewajiban disepakati transparan di awal tanpa ada klausul tersembunyi.\n3. Bebas Maisir (Perjudian/Spekulasi): Dana nasabah tidak dialokasikan untuk aktivitas spekulatif yang merugikan pihak lain.\n4. Investasi Halal & Etis: Bank Syariah Wakalumi hanya menyalurkan dana pembiayaan pada sektor usaha halal yang bermanfaat bagi masyarakat dan lingkungan hidup.",
                'urutan'      => 1,
            ],
            [
                'id'          => 'modul_2',
                'kategori'    => 'simpanan',
                'kat_label'   => 'Simpanan & Tabungan',
                'sasaran'     => 'Nasabah & Guru',
                'judul'       => 'Akad Simpanan: Wadiah vs Mudharabah',
                'ringkasan'   => 'Panduan memilih produk simpanan syariah yang tepat: Akad Wadiah yang aman murni titipan atau Mudharabah dengan nisbah imbal hasil bagi hasil bulanan.',
                'isi_lengkap' => "Dalam perbankan syariah, tabungan dan deposito dikelola dengan akad yang jelas sesuai tujuan nasabah:\n\n1. Akad Wadiah Yad Dhamanah (Titipan Bergaransi):\n- Dana nasabah berstatus titipan yang dijamin keamanannya oleh bank dan dapat diambil sewaktu-waktu.\n- Bank dapat memberikan bonus (athaya) sukarela tanpa diperjanjikan di awal.\n- Sangat cocok untuk kebutuhan transaksi harian, tabungan pendidikan, atau tabungan kurban.\n\n2. Akad Mudharabah Mutlaqah (Investasi Bagi Hasil):\n- Nasabah bertindak sebagai pemilik dana (Shahibul Mal) dan bank sebagai pengelola dana (Mudharib).\n- Keuntungan usaha dibagikan setiap bulan berdasarkan porsi bagi hasil (nisbah) yang disepakati di awal (misal 55% nasabah : 45% bank).\n- Sangat cocok untuk Deposito Mudharabah dan tabungan berjangka.",
                'urutan'      => 2,
            ],
            [
                'id'          => 'modul_3',
                'kategori'    => 'pembiayaan',
                'kat_label'   => 'Pembiayaan Syariah',
                'sasaran'     => 'Pelaku Wirausaha',
                'judul'       => 'Skema Pembiayaan: Murabahah & Modal Kerja',
                'ringkasan'   => 'Bagaimana bank syariah menyalurkan modal usaha tanpa bunga: penetapan harga beli dan margin keuntungan tetap, atau kemitraan usaha murni bagi hasil.',
                'isi_lengkap' => "Penyaluran modal usaha di Bank Syariah Wakalumi tidak menggunakan sistem pinjaman berbunga komersial, melainkan akad-akad kemitraan produktif:\n\n1. Akad Murabahah (Jual Beli dengan Keuntungan Disepakati):\n- Bank membelikan barang kebutuhan usaha/aset yang dibutuhkan nasabah (misal: kendaraan niaga, mesin produksi, renovasi tempat usaha).\n- Bank menjual kepada nasabah sebesar harga beli ditambah margin keuntungan yang disepakati bersama. Angsuran bersifat tetap (fixed) hingga lunas tanpa risiko bunga mengambang.\n\n2. Akad Mudharabah & Musyarakah (Kemitraan Modal & Bagi Hasil):\n- Bank menyediakan permodalan untuk proyek usaha produktif nasabah, dan hasil keuntungan dibagi berdasarkan nisbah riil yang disepakati.\n\n3. Akad Ijarah Multijasa (Sewa Manfaat Jasa):\n- Digunakan untuk pembiayaan kebutuhan biaya pendidikan, porsi haji/umroh, atau kebutuhan konsumtif produktif dengan ujrah (biaya jasa) tetap.",
                'urutan'      => 3,
            ],
            [
                'id'          => 'modul_4',
                'kategori'    => 'keuangan',
                'kat_label'   => 'Manajemen Finansial',
                'sasaran'     => 'Pengusaha Kecil',
                'judul'       => 'Manajemen Finansial & Arus Kas UMKM',
                'ringkasan'   => 'Langkah praktis menyusun anggaran darurat, memisahkan kas pribadi dan modal dagang, serta memanfaatkan pembiayaan syariah yang aman dan terencana.',
                'isi_lengkap' => "Pengelolaan keuangan yang sehat merupakan kunci keberhasilan dan keberlanjutan usaha mikro dan kecil.\n\nPanduan Mengelola Arus Kas Berkah:\n1. Pisahkan Rekening Usaha dan Pribadi: Selalu gunakan rekening terpisah agar perputaran laba kotor tidak terpakai untuk belanja konsumtif rumah tangga.\n2. Siapkan Pos Dana Cadangan (Dana Darurat): Sisihkan 5-10% dari keuntungan usaha secara berkala ke dalam tabungan syariah berbiaya admin ringan.\n3. Rencanakan Kebutuhan Permodalan dengan Tepat: Pilih skema pembiayaan syariah yang sesuai dengan siklus perputaran usaha, seperti akad Murabahah untuk pengadaan barang atau Mudharabah untuk penambahan modal kerja yang berkeadilan.",
                'urutan'      => 4,
            ],
            [
                'id'          => 'modul_5',
                'kategori'    => 'keamanan',
                'kat_label'   => 'Keamanan Finansial',
                'sasaran'     => 'Masyarakat Luas',
                'judul'       => 'Waspada Investasi Bodong & Pinjol Ilegal',
                'ringkasan'   => 'Panduan resmi mengenali modus penipuan berkedok syariah, bahaya pinjol tanpa izin OJK, serta menjaga keamanan data pribadi perbankan Anda.',
                'isi_lengkap' => "Otoritas Jasa Keuangan (OJK) bersama Bank Syariah Wakalumi menghimbau masyarakat untuk selalu menerapkan prinsip 2L sebelum menaruh dana atau mengajukan pembiayaan:\n\n1. Legal: Periksa apakah lembaga yang menawarkan investasi atau pinjaman telah memiliki izin usaha resmi dan diawasi oleh OJK/Kemenkop.\n2. Logis: Waspada terhadap janji keuntungan pasti tanpa risiko dalam waktu singkat. Dalam ekonomi syariah, keuntungan selalu berjalan seiring dengan usaha riil (al-ghunmu bil ghurmi).\n\nTips Keamanan Data Perbankan:\n- Jangan pernah membagikan nomor PIN, password, atau kode OTP kepada siapapun, termasuk oknum yang mengaku petugas bank.\n- Selalu verifikasi pesan panggilan atau tawaran pinjaman melalui nomor WhatsApp resmi bank.",
                'urutan'      => 5,
            ],
            [
                'id'          => 'modul_6',
                'kategori'    => 'keamanan',
                'kat_label'   => 'Keamanan Finansial',
                'sasaran'     => 'Nasabah Simpanan',
                'judul'       => 'Jaminan Simpanan LPS hingga Rp2 Miliar',
                'ringkasan'   => 'Simpanan Anda di Bank Syariah Wakalumi aman terlindungi oleh Lembaga Penjamin Simpanan (LPS) dengan memenuhi syarat 3T penjaminan.',
                'isi_lengkap' => "PT BPRS Wakalumi (Bank Syariah Wakalumi) adalah bank peserta penjaminan Lembaga Penjamin Simpanan (LPS).\n\nKetentuan Penjaminan Simpanan Syariah:\n1. Nilai Maksimal Penjaminan: Simpanan nasabah dijamin hingga Rp2.000.000.000 (Dua Miliar Rupiah) per nasabah per bank.\n2. Kriteria 3T yang Harus Dipenuhi:\n- Tercatat dalam pembukuan bank.\n- Tingkat imbal hasil/bagi hasil wajar sesuai ketentuan batas penjaminan yang ditetapkan LPS.\n- Tidak melakukan tindakan yang merugikan bank (misal: tidak memiliki kredit macet).\n\nDengan perlindungan LPS, nasabah dapat menabung dan berdeposito dengan tenang serta berkah.",
                'urutan'      => 6,
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_literasi_modules' ) ) {
    /**
     * Mengambil daftar modul literasi dari database wp_options.
     *
     * @return array
     */
    function wakalumi_get_literasi_modules() {
        $saved = get_option( 'options_literasi_modules_list', null );
        if ( is_array( $saved ) && ! empty( $saved ) ) {
            usort( $saved, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );
            return $saved;
        }

        return wakalumi_get_default_literasi_modules();
    }
}

if ( ! function_exists( 'wakalumi_get_literasi_form_settings' ) ) {
    /**
     * Mengambil konfigurasi pengajuan kemitraan edukasi komunitas via WhatsApp.
     *
     * @return array
     */
    function wakalumi_get_literasi_form_settings() {
        $default_wa = get_option( 'options_contact_wa', '6281517380388' );
        $wa_clean   = preg_replace( '/[^0-9]/', '', (string) $default_wa );
        $wa_url     = 'https://wa.me/' . ( $wa_clean ?: '6281517380388' );

        return [
            'wa_number' => $wa_clean ?: '6281517380388',
            'wa_url'    => $wa_url,
            'badge'     => get_option( 'options_literasi_form_badge', 'Kolaborasi Kemitraan Komunitas' ),
            'title'     => get_option( 'options_literasi_form_title', 'Ajukan Sosialisasi & Edukasi Syariah Bersama BSW' ),
            'desc'      => get_option( 'options_literasi_form_desc', 'Apakah sekolah, komunitas guru, majelis taklim, koperasi, atau asosiasi UMKM Anda ingin mengadakan workshop/edukasi literasi keuangan syariah? Tim edukasi BSW siap hadir memberikan sosialisasi dan koordinasi materi bersama lembaga Anda.' ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_literasi_cta' ) ) {
    /**
     * Mengambil konfigurasi banner CTA bawah halaman literasi.
     *
     * @return array
     */
    function wakalumi_get_literasi_cta() {
        $default_wa = get_option( 'options_contact_wa', '6281517380388' );
        $wa_clean   = preg_replace( '/[^0-9]/', '', (string) $default_wa );
        $wa_url     = 'https://wa.me/' . ( $wa_clean ?: '6281517380388' );

        return [
            'show'      => get_option( 'options_literasi_cta_show', '1' ) === '1',
            'badge'     => get_option( 'options_literasi_cta_badge', 'Konsultasi Perbankan Syariah' ),
            'title'     => get_option( 'options_literasi_cta_title', 'Siap Melangkah Menuju Keberkahan Finansial Syariah?' ),
            'desc'      => get_option( 'options_literasi_cta_desc', 'Buka rekening tabungan berkah, ikuti program pembiayaan mikro usaha, atau konsultasikan kebutuhan edukasi komunitas Anda bersama Bank Syariah Wakalumi.' ),
            'btn1_text' => get_option( 'options_literasi_cta_btn1_text', 'Konsultasi via WhatsApp' ),
            'btn1_url'  => get_option( 'options_literasi_cta_btn1_url', $wa_url ),
            'btn2_text' => get_option( 'options_literasi_cta_btn2_text', 'Katalog Produk & Brosur Resmi' ),
            'btn2_url'  => get_option( 'options_literasi_cta_btn2_url', home_url( '/brosur/' ) ),
        ];
    }
}


// ── 2. MENU REGISTRATION ────────────────────────────────────────────

add_action( 'admin_menu', 'wakalumi_register_literasi_page', 34 );
function wakalumi_register_literasi_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Literasi & Inklusi',
        'Literasi & Inklusi',
        'manage_options',
        'wakalumi-literasi',
        'wakalumi_render_literasi_admin_page'
    );
}


// ── 3. RENDER ADMIN INTERFACE ───────────────────────────────────────

function wakalumi_render_literasi_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Akses ditolak.' );
    }

    $notice = '';

    // Handle Save Form
    if ( isset( $_POST['wkl_literasi_save_nonce'] ) ) {
        if ( ! wp_verify_nonce( $_POST['wkl_literasi_save_nonce'], 'wkl_literasi_save_action' ) ) {
            $notice = '<div class="notice notice-error is-dismissible"><p>Validasi keamanan gagal. Silakan coba kembali.</p></div>';
        } else {
            // 1. Simpan Header Halaman
            update_option( 'options_literasi_badge', sanitize_text_field( $_POST['options_literasi_badge'] ?? '' ) );
            update_option( 'options_literasi_title', sanitize_text_field( $_POST['options_literasi_title'] ?? '' ) );
            update_option( 'options_literasi_desc', sanitize_textarea_field( $_POST['options_literasi_desc'] ?? '' ) );

            // 2. Simpan Pengaturan Seksi & 3 Pilar Inklusi
            update_option( 'options_literasi_pillars_badge', sanitize_text_field( $_POST['options_literasi_pillars_badge'] ?? '' ) );
            update_option( 'options_literasi_pillars_title', sanitize_text_field( $_POST['options_literasi_pillars_title'] ?? '' ) );
            update_option( 'options_literasi_pillars_desc', sanitize_textarea_field( $_POST['options_literasi_pillars_desc'] ?? '' ) );

            $pillar_ids    = $_POST['pillar_id'] ?? [];
            $pillar_titles = $_POST['pillar_title'] ?? [];
            $pillar_subs   = $_POST['pillar_sub'] ?? [];
            $pillar_descs  = $_POST['pillar_desc'] ?? [];
            $pillar_tags   = $_POST['pillar_tag'] ?? [];
            $pillar_icons  = $_POST['pillar_icon'] ?? [];

            $new_pillars = [];
            for ( $p = 0; $p < count( $pillar_ids ); $p++ ) {
                $p_title = sanitize_text_field( $pillar_titles[$p] ?? '' );
                if ( empty( $p_title ) ) continue;
                $new_pillars[] = [
                    'id'    => sanitize_text_field( $pillar_ids[$p] ?? ( 'pilar_' . ( $p + 1 ) ) ),
                    'title' => $p_title,
                    'sub'   => sanitize_text_field( $pillar_subs[$p] ?? '' ),
                    'desc'  => sanitize_textarea_field( $pillar_descs[$p] ?? '' ),
                    'tag'   => sanitize_text_field( $pillar_tags[$p] ?? '' ),
                    'icon'  => sanitize_text_field( $pillar_icons[$p] ?? 'truck' ),
                ];
            }
            if ( ! empty( $new_pillars ) ) {
                update_option( 'options_literasi_pillars_list', $new_pillars );
            }

            // 3. Simpan Repeater Modul Edukasi
            $modul_ids       = $_POST['modul_id'] ?? [];
            $modul_juduls    = $_POST['modul_judul'] ?? [];
            $modul_kats      = $_POST['modul_kategori'] ?? [];
            $modul_kat_lbls  = $_POST['modul_kat_label'] ?? [];
            $modul_sasarans  = $_POST['modul_sasaran'] ?? [];
            $modul_ringks    = $_POST['modul_ringkasan'] ?? [];
            $modul_isis      = $_POST['modul_isi_lengkap'] ?? [];
            $modul_urutans   = $_POST['modul_urutan'] ?? [];

            $new_modules = [];
            for ( $i = 0; $i < count( $modul_ids ); $i++ ) {
                $judul = sanitize_text_field( $modul_juduls[$i] ?? '' );
                if ( empty( $judul ) ) continue;

                $new_modules[] = [
                    'id'          => sanitize_text_field( $modul_ids[$i] ?? ( 'modul_' . ( $i + 1 ) ) ),
                    'judul'       => $judul,
                    'kategori'    => sanitize_text_field( $modul_kats[$i] ?? 'dasar' ),
                    'kat_label'   => sanitize_text_field( $modul_kat_lbls[$i] ?? '' ),
                    'sasaran'     => sanitize_text_field( $modul_sasarans[$i] ?? 'Masyarakat Umum' ),
                    'ringkasan'   => sanitize_textarea_field( $modul_ringks[$i] ?? '' ),
                    'isi_lengkap' => sanitize_textarea_field( $modul_isis[$i] ?? '' ),
                    'urutan'      => intval( $modul_urutans[$i] ?? ( $i + 1 ) ),
                ];
            }

            usort( $new_modules, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );
            update_option( 'options_literasi_modules_list', $new_modules );

            // 4. Simpan Pengaturan Form Kemitraan
            update_option( 'options_literasi_form_badge', sanitize_text_field( $_POST['options_literasi_form_badge'] ?? '' ) );
            update_option( 'options_literasi_form_title', sanitize_text_field( $_POST['options_literasi_form_title'] ?? '' ) );
            update_option( 'options_literasi_form_desc', sanitize_textarea_field( $_POST['options_literasi_form_desc'] ?? '' ) );

            // 5. Simpan CTA Bawah
            update_option( 'options_literasi_cta_show', isset( $_POST['options_literasi_cta_show'] ) ? '1' : '0' );
            update_option( 'options_literasi_cta_badge', sanitize_text_field( $_POST['options_literasi_cta_badge'] ?? '' ) );
            update_option( 'options_literasi_cta_title', sanitize_text_field( $_POST['options_literasi_cta_title'] ?? '' ) );
            update_option( 'options_literasi_cta_desc', sanitize_textarea_field( $_POST['options_literasi_cta_desc'] ?? '' ) );
            update_option( 'options_literasi_cta_btn1_text', sanitize_text_field( $_POST['options_literasi_cta_btn1_text'] ?? '' ) );
            update_option( 'options_literasi_cta_btn1_url', esc_url_raw( $_POST['options_literasi_cta_btn1_url'] ?? '' ) );
            update_option( 'options_literasi_cta_btn2_text', sanitize_text_field( $_POST['options_literasi_cta_btn2_text'] ?? '' ) );
            update_option( 'options_literasi_cta_btn2_url', esc_url_raw( $_POST['options_literasi_cta_btn2_url'] ?? '' ) );

            $notice = '<div class="notice notice-success is-dismissible"><p><strong>Berhasil!</strong> Seluruh pengaturan Literasi &amp; Inklusi Keuangan Syariah telah disimpan.</p></div>';
        }
    }

    // Reset Action Handler
    if ( isset( $_GET['wkl_action'] ) && $_GET['wkl_action'] === 'reset_literasi_defaults' && check_admin_referer( 'wkl_reset_lit_nonce' ) ) {
        update_option( 'options_literasi_pillars_badge', 'Inklusi Keuangan' );
        update_option( 'options_literasi_pillars_title', 'Pilar Aksi Nyata Inklusi Keuangan Syariah BSW' );
        update_option( 'options_literasi_pillars_desc', 'Membuka pintu akses perbankan seluas-luasnya bagi masyarakat dan pelaku usaha mikro melalui pendekatan proaktif serta kemitraan yang memberdayakan.' );
        update_option( 'options_literasi_pillars_list', wakalumi_get_default_literasi_pillars() );
        update_option( 'options_literasi_modules_list', wakalumi_get_default_literasi_modules() );
        $notice = '<div class="notice notice-success is-dismissible"><p>Daftar pilar inklusi dan modul edukasi literasi syariah berhasil dimuat ulang ke data standar resmi.</p></div>';
    }

    // Load Data
    $header       = wakalumi_get_literasi_header();
    $pillars_sec  = wakalumi_get_literasi_pillars_section();
    $pillars      = wakalumi_get_literasi_pillars();
    $modules      = wakalumi_get_literasi_modules();
    $form_set     = wakalumi_get_literasi_form_settings();
    $cta          = wakalumi_get_literasi_cta();

    $total_modules = count( $modules );
    $reset_url     = wp_nonce_url( admin_url( 'admin.php?page=wakalumi-literasi&wkl_action=reset_literasi_defaults' ), 'wkl_reset_lit_nonce' );
    ?>

    <div class="wrap" style="max-width: 1140px; margin-top: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;">

        <!-- TOP BAR HEADER -->
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #e2e8f0;">
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span class="dashicons dashicons-welcome-learn-more" style="font-size: 28px; width: 28px; height: 28px; color: #0f766e;"></span>
                    Pengaturan Literasi &amp; Inklusi Keuangan Syariah
                </h1>
                <p style="margin: 4px 0 0 0; color: #64748b; font-size: 13px;">
                    Kelola materi edukasi fikih muamalah perbankan syariah, 3 pilar aksi inklusi, formulir kemitraan guru &amp; UMKM, serta informasi POJK.
                </p>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="<?php echo esc_url( home_url( '/informasi/literasi-keuangan/' ) ); ?>" target="_blank" class="button button-secondary" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; padding: 4px 14px; border-radius: 6px;">
                    <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px;"></span> Lihat Halaman Publik
                </a>
                <a href="<?php echo esc_url( $reset_url ); ?>" onclick="return confirm('Muat ulang 3 pilar inklusi dan 6 modul edukasi baku perbankan syariah? Perubahan Anda akan direset.');" class="button" style="color: #0f766e; border-color: #0f766e; font-weight: 600; padding: 4px 12px; border-radius: 6px;">
                    Muat Ulang Standar Baku
                </a>
            </div>
        </div>

        <?php if ( ! empty( $notice ) ) echo $notice; ?>

        <!-- METRIC STATUS BAR -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 25px;">
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 14px 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Pilar Inklusi Utama</div>
                <div style="font-size: 24px; font-weight: 800; color: #0f766e; margin-top: 4px;"><?php echo count( $pillars ); ?> Program</div>
            </div>
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 14px 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Total Modul Edukasi</div>
                <div style="font-size: 24px; font-weight: 800; color: #0f172a; margin-top: 4px;"><?php echo $total_modules; ?> Topik</div>
            </div>
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 14px 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Program Kemitraan Komunitas</div>
                <div style="font-size: 24px; font-weight: 800; color: #0f766e; margin-top: 4px;">Siap Kolaborasi</div>
            </div>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field( 'wkl_literasi_save_action', 'wkl_literasi_save_nonce' ); ?>

            <!-- ================================================================
                 SECTION 1: PENGATURAN PILAR AKSI NYATA INKLUSI KEUANGAN (DINAMIS)
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 18px;">
                    <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <span class="dashicons dashicons-networking" style="font-size: 18px; width: 18px; height: 18px;"></span>
                        Pengaturan Seksi &amp; 3 Pilar Aksi Nyata Inklusi Keuangan
                    </h2>
                    <p style="margin: 4px 0 0 0; color: #64748b; font-size: 12px;">
                        Kelola judul seksi, deskripsi pengantar, dan ketiga pilar program inklusi perbankan syariah yang tampil di halaman web.
                    </p>
                </div>

                <!-- Section Header Inputs -->
                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Badge Seksi Pilar</label>
                        <input type="text" name="options_literasi_pillars_badge" value="<?php echo esc_attr( $pillars_sec['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Judul Utama Seksi Pilar</label>
                        <input type="text" name="options_literasi_pillars_title" value="<?php echo esc_attr( $pillars_sec['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px;">
                    </div>
                </div>

                <div style="margin-bottom: 22px;">
                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Deskripsi Pengantar Seksi Pilar</label>
                    <textarea name="options_literasi_pillars_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 13px;"><?php echo esc_textarea( $pillars_sec['desc'] ); ?></textarea>
                </div>

                <!-- 3 Pillars Cards Editor -->
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <?php 
                    foreach ( $pillars as $p_idx => $pil ) : 
                        $p_id    = esc_attr( $pil['id'] ?? ( 'pilar_' . ( $p_idx + 1 ) ) );
                        $p_title = esc_attr( $pil['title'] ?? '' );
                        $p_sub   = esc_attr( $pil['sub'] ?? '' );
                        $p_desc  = esc_textarea( $pil['desc'] ?? '' );
                        $p_tag   = esc_attr( $pil['tag'] ?? '' );
                        $p_icon  = esc_attr( $pil['icon'] ?? 'truck' );
                    ?>
                        <div style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 5px solid #0f766e; border-radius: 10px; padding: 18px;">
                            <input type="hidden" name="pillar_id[]" value="<?php echo $p_id; ?>">

                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                                <span style="font-weight: 800; font-size: 14px; color: #0f172a;">
                                    Pilar Inklusi #<?php echo ( $p_idx + 1 ); ?>
                                </span>
                                <span style="font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 999px; background: #ccfbf1; color: #0f766e;">
                                    Aktif di Halaman
                                </span>
                            </div>

                            <div style="display: grid; grid-template-columns: 2fr 1.5fr 1fr; gap: 12px; margin-bottom: 12px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Nama Program Pilar</label>
                                    <input type="text" name="pillar_title[]" value="<?php echo $p_title; ?>" placeholder="Contoh: Kemitraan Guru Sekolah" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; font-weight: 600; background: #fff;" required>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Sub-Judul Pilar</label>
                                    <input type="text" name="pillar_sub[]" value="<?php echo $p_sub; ?>" placeholder="Contoh: Solusi Finansial Pendidik" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Label Tag / Kategori</label>
                                    <input type="text" name="pillar_tag[]" value="<?php echo $p_tag; ?>" placeholder="Contoh: Inklusi Guru" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 3fr 1fr; gap: 12px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Deskripsi Aksi Inklusi</label>
                                    <textarea name="pillar_desc[]" rows="3" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 12px; background: #fff;"><?php echo $p_desc; ?></textarea>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Ikon Vektor</label>
                                    <select name="pillar_icon[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                        <option value="truck" <?php selected( $p_icon, 'truck' ); ?>>Truk / Jemput Bola</option>
                                        <option value="academic-cap" <?php selected( $p_icon, 'academic-cap' ); ?>>Topi Toga / Pendidikan &amp; Guru</option>
                                        <option value="sparkles" <?php selected( $p_icon, 'sparkles' ); ?>>Kilau / UMKM Berkah</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 2: REPEATER MODUL & TOPIK EDUKASI LITERASI
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px; margin-bottom: 20px;">
                    <div>
                        <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <span class="dashicons dashicons-book" style="font-size: 18px; width: 18px; height: 18px;"></span>
                            Daftar Modul &amp; Artikel Edukasi Literasi Keuangan Syariah
                        </h2>
                        <p style="margin: 4px 0 0 0; color: #64748b; font-size: 12px;">
                            Materi edukasi ini dapat dibaca oleh nasabah dan masyarakat luas melalui modal popup interaktif di halaman depan.
                        </p>
                    </div>
                    <button type="button" id="btn-add-module" class="button button-primary" style="background: #0f766e; border-color: #0d9488; font-weight: 700;">
                        + Tambah Modul Baru
                    </button>
                </div>

                <!-- Module Repeater Container -->
                <div id="module-list-container" style="display: flex; flex-direction: column; gap: 18px;">
                    <?php 
                    foreach ( $modules as $idx => $mod ) : 
                        $mod_id    = esc_attr( $mod['id'] ?? ( 'modul_' . ( $idx + 1 ) ) );
                        $judul     = esc_attr( $mod['judul'] ?? '' );
                        $kategori  = esc_attr( $mod['kategori'] ?? 'dasar' );
                        $kat_lbl   = esc_attr( $mod['kat_label'] ?? '' );
                        $sasaran   = esc_attr( $mod['sasaran'] ?? 'Masyarakat Umum' );
                        $ringkasan = esc_textarea( $mod['ringkasan'] ?? '' );
                        $isi       = esc_textarea( $mod['isi_lengkap'] ?? '' );
                        $urutan    = intval( $mod['urutan'] ?? ( $idx + 1 ) );
                    ?>
                        <div class="module-card-item" data-id="<?php echo $mod_id; ?>" style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 5px solid #0f766e; border-radius: 10px; padding: 20px; transition: all 0.2s;">
                            <input type="hidden" name="modul_id[]" value="<?php echo $mod_id; ?>">

                            <!-- Card Header Bar -->
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span style="font-weight: 800; font-size: 15px; color: #0f172a;" class="module-title-display">
                                        #<?php echo $urutan; ?> — <?php echo ! empty( $judul ) ? $judul : 'Modul Edukasi Baru'; ?>
                                    </span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 999px; background: #e0f2fe; color: #0369a1;">
                                        ● <?php echo esc_html( $sasaran ); ?>
                                    </span>
                                    <button type="button" class="button button-link-delete btn-delete-module" style="color: #ef4444; font-size: 12px; padding: 2px 6px;">
                                        Hapus
                                    </button>
                                </div>
                            </div>

                            <!-- Row 1: Judul, Kategori, Sasaran, Urutan -->
                            <div style="display: grid; grid-template-columns: 2fr 1.2fr 1.2fr 0.6fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Judul Topik Edukasi</label>
                                    <input type="text" name="modul_judul[]" value="<?php echo $judul; ?>" class="module-title-input" placeholder="Contoh: Prinsip Bebas Riba dalam Perbankan Syariah" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; font-weight: 600; background: #fff;" required>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Kategori Modul</label>
                                    <select name="modul_kategori[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                        <option value="dasar" <?php selected( $kategori, 'dasar' ); ?>>Prinsip Dasar Syariah</option>
                                        <option value="simpanan" <?php selected( $kategori, 'simpanan' ); ?>>Simpanan &amp; Tabungan</option>
                                        <option value="pembiayaan" <?php selected( $kategori, 'pembiayaan' ); ?>>Pembiayaan Syariah</option>
                                        <option value="keuangan" <?php selected( $kategori, 'keuangan' ); ?>>Manajemen Finansial</option>
                                        <option value="keamanan" <?php selected( $kategori, 'keamanan' ); ?>>Keamanan Finansial (Anti-Fraud)</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Sasaran Pembaca</label>
                                    <input type="text" name="modul_sasaran[]" value="<?php echo $sasaran; ?>" placeholder="Contoh: Pelaku UMKM / Guru" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Urutan</label>
                                    <input type="number" name="modul_urutan[]" value="<?php echo $urutan; ?>" min="1" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 4px; font-size: 13px; text-align: center; background: #fff;">
                                </div>
                            </div>

                            <!-- Row 2: Ringkasan & Isi Lengkap -->
                            <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 14px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                        Ringkasan Singkat (Tampil pada Kartu Depan)
                                    </label>
                                    <textarea name="modul_ringkasan[]" rows="5" placeholder="Tuliskan 1-2 kalimat ringkasan inti topik ini..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"><?php echo $ringkasan; ?></textarea>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                        Uraian &amp; Poin Lengkap (Tampil di Popup Baca Edukasi)
                                    </label>
                                    <textarea name="modul_isi_lengkap[]" rows="5" placeholder="Uraikan penjelasan lengkap, poin-poin fikih, atau tips praktis..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"><?php echo $isi; ?></textarea>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top: 20px; text-align: center;">
                    <button type="button" id="btn-add-module-bottom" class="button" style="padding: 8px 24px; font-weight: 700; border-radius: 6px; border: 2px dashed #94a3b8; width: 100%; max-width: 320px; background: #f8fafc;">
                        + Tambah Modul Baru
                    </button>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 3: PENGATURAN HEADER & AJAKAN KEMITRAAN KOMUNITAS
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-welcome-widgets-menus" style="font-size: 18px; width: 18px; height: 18px;"></span>
                    Pengaturan Header Halaman &amp; Formulir Pengajuan Kemitraan
                </h2>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 15px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Badge Header Atas</label>
                        <input type="text" name="options_literasi_badge" value="<?php echo esc_attr( $header['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Judul Utama Halaman</label>
                        <input type="text" name="options_literasi_title" value="<?php echo esc_attr( $header['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Deskripsi Narasi Pengantar</label>
                    <textarea name="options_literasi_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 13px;"><?php echo esc_textarea( $header['desc'] ); ?></textarea>
                </div>

                <!-- Pengaturan Form Kemitraan Komunitas -->
                <div style="margin-top: 20px; padding: 18px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px;">
                    <div style="font-weight: 700; color: #166534; font-size: 13px; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                        <span class="dashicons dashicons-groups" style="font-size: 16px; width: 16px; height: 16px;"></span>
                        Formulir Pengajuan Sosialisasi &amp; Edukasi Komunitas (Kemitraan WhatsApp)
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 15px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Badge Form</label>
                            <input type="text" name="options_literasi_form_badge" value="<?php echo esc_attr( $form_set['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Judul Formulir</label>
                            <input type="text" name="options_literasi_form_title" value="<?php echo esc_attr( $form_set['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                    </div>
                    <div style="margin-top: 10px;">
                        <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Teks Penjelasan Ajakan Kemitraan</label>
                        <textarea name="options_literasi_form_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"><?php echo esc_textarea( $form_set['desc'] ); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 4: PENGATURAN CALL TO ACTION (CTA) BAWAH HALAMAN
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 15px;">
                    <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <span class="dashicons dashicons-megaphone" style="font-size: 18px; width: 18px; height: 18px;"></span>
                        Pengaturan Banner Call to Action (CTA) Bawah Halaman
                    </h2>
                    <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: #1e293b; cursor: pointer;">
                        <input type="checkbox" name="options_literasi_cta_show" value="1" <?php checked( $cta['show'] ); ?>>
                        Tampilkan Banner CTA
                    </label>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 15px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Badge Atas CTA</label>
                        <input type="text" name="options_literasi_cta_badge" value="<?php echo esc_attr( $cta['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Judul Utama Banner CTA</label>
                        <input type="text" name="options_literasi_cta_title" value="<?php echo esc_attr( $cta['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Deskripsi / Paragraf Ajakan</label>
                    <textarea name="options_literasi_cta_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 13px;"><?php echo esc_textarea( $cta['desc'] ); ?></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px; padding: 18px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;">
                    <div>
                        <div style="font-weight: 700; color: #0f766e; font-size: 13px; margin-bottom: 10px;">Tombol Utama (WhatsApp)</div>
                        <div style="margin-bottom: 10px;">
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Teks Tombol</label>
                            <input type="text" name="options_literasi_cta_btn1_text" value="<?php echo esc_attr( $cta['btn1_text'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">URL / Link WhatsApp</label>
                            <input type="text" name="options_literasi_cta_btn1_url" value="<?php echo esc_attr( $cta['btn1_url'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                    </div>

                    <div>
                        <div style="font-weight: 700; color: #166534; font-size: 13px; margin-bottom: 10px;">Tombol Sekunder (Katalog Brosur)</div>
                        <div style="margin-bottom: 10px;">
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Teks Tombol</label>
                            <input type="text" name="options_literasi_cta_btn2_text" value="<?php echo esc_attr( $cta['btn2_text'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">URL / Link Halaman</label>
                            <input type="text" name="options_literasi_cta_btn2_url" value="<?php echo esc_attr( $cta['btn2_url'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SAVE BUTTON STICKY FOOTER -->
            <div style="position: sticky; bottom: 15px; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 15px 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between; z-index: 50;">
                <div style="color: #64748b; font-size: 13px;">
                    Perubahan pada 3 pilar inklusi, modul edukasi, dan formulir kemitraan akan langsung aktif di halaman web.
                </div>
                <button type="submit" class="button button-primary" style="background: #0f766e; border-color: #0d9488; font-weight: 800; font-size: 14px; padding: 6px 30px; border-radius: 6px;">
                    Simpan Seluruh Pengaturan Literasi
                </button>
            </div>

        </form>

    </div>

    <!-- INLINE JAVASCRIPT FOR DYNAMIC MODULE CARDS -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('module-list-container');
        const btnAddTop = document.getElementById('btn-add-module');
        const btnAddBottom = document.getElementById('btn-add-module-bottom');

        function bindModuleCard(card) {
            const inputJudul = card.querySelector('.module-title-input');
            const titleDisp  = card.querySelector('.module-title-display');
            const btnDelete  = card.querySelector('.btn-delete-module');

            if (inputJudul && titleDisp) {
                inputJudul.addEventListener('input', function() {
                    const val = this.value.trim() || 'Modul Edukasi Baru';
                    titleDisp.textContent = val;
                });
            }

            if (btnDelete) {
                btnDelete.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin menghapus topik edukasi ini?')) {
                        card.remove();
                    }
                });
            }
        }

        // Bind existing
        container.querySelectorAll('.module-card-item').forEach(bindModuleCard);

        function addNewModuleCard() {
            const count = container.querySelectorAll('.module-card-item').length;
            const newIndex = count + 1;
            const newId = 'modul_' + Date.now();

            const cardHtml = `
                <div class="module-card-item" data-id="${newId}" style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 5px solid #0f766e; border-radius: 10px; padding: 20px; transition: all 0.2s;">
                    <input type="hidden" name="modul_id[]" value="${newId}">

                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-weight: 800; font-size: 15px; color: #0f172a;" class="module-title-display">
                                #${newIndex} — Topik Edukasi Baru
                            </span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 999px; background: #e0f2fe; color: #0369a1;">
                                ● Masyarakat Umum
                            </span>
                            <button type="button" class="button button-link-delete btn-delete-module" style="color: #ef4444; font-size: 12px; padding: 2px 6px;">
                                Hapus
                            </button>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 2fr 1.2fr 1.2fr 0.6fr; gap: 14px; margin-bottom: 12px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Judul Topik Edukasi</label>
                            <input type="text" name="modul_judul[]" value="" class="module-title-input" placeholder="Contoh: Mengapa Menabung Syariah Lebih Berkah" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; font-weight: 600; background: #fff;" required>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Kategori Modul</label>
                            <select name="modul_kategori[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                <option value="dasar">Prinsip Dasar Syariah</option>
                                <option value="simpanan">Simpanan &amp; Tabungan</option>
                                <option value="pembiayaan">Pembiayaan Syariah</option>
                                <option value="keuangan">Manajemen Finansial</option>
                                <option value="keamanan">Keamanan Finansial (Anti-Fraud)</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Sasaran Pembaca</label>
                            <input type="text" name="modul_sasaran[]" value="Masyarakat Umum" placeholder="Contoh: Pelaku UMKM" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Urutan</label>
                            <input type="number" name="modul_urutan[]" value="${newIndex}" min="1" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 4px; font-size: 13px; text-align: center; background: #fff;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 14px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                Ringkasan Singkat (Tampil pada Kartu Depan)
                            </label>
                            <textarea name="modul_ringkasan[]" rows="5" placeholder="Tuliskan 1-2 kalimat ringkasan inti topik ini..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"></textarea>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                Uraian &amp; Poin Lengkap (Tampil di Popup Baca Edukasi)
                            </label>
                            <textarea name="modul_isi_lengkap[]" rows="5" placeholder="Uraikan penjelasan lengkap, poin-poin fikih, atau tips praktis..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"></textarea>
                        </div>
                    </div>
                </div>
            `;

            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = cardHtml.trim();
            const newEl = tempDiv.firstElementChild;
            container.appendChild(newEl);
            bindModuleCard(newEl);
            newEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        if (btnAddTop) btnAddTop.addEventListener('click', addNewModuleCard);
        if (btnAddBottom) btnAddBottom.addEventListener('click', addNewModuleCard);
    });
    </script>
    <?php
}
