<?php
/**
 * Admin Panel: Produk Simpanan & Deposito Syariah
 *
 * Mengelola konten halaman Tabungan Syariah (Daftar Dinamis Repeater)
 * dan Deposito Mudharabah BPRS Wakalumi.
 * 100% Native WordPress Options tanpa plugin berbayar.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Registrasi Submenu di bawah "Pengaturan Wakalumi"
 */
function wakalumi_register_produk_admin_menu() {
    add_submenu_page(
        'wakalumi-settings',
        'Produk: Simpanan Syariah',
        'Produk Syariah',
        'manage_options',
        'wakalumi-produk-dana',
        'wakalumi_render_produk_admin_page'
    );
}
add_action( 'admin_menu', 'wakalumi_register_produk_admin_menu', 23 );

/**
 * Handle old wakalumi-deposito link redirect
 */
add_action( 'admin_init', function() {
    if ( isset( $_GET['page'] ) && $_GET['page'] === 'wakalumi-deposito' ) {
        wp_safe_redirect( admin_url( 'admin.php?page=wakalumi-produk-dana&tab=deposito' ) );
        exit;
    }
} );

/**
 * Helper: Ambil Daftar Produk Tabungan dengan Default Bawaan Resmi
 */
function wakalumi_get_tabungan_list() {
    $saved = get_option( 'options_tabungan_list', null );
    if ( is_array( $saved ) && ! empty( $saved ) ) {
        return $saved;
    }

    // Default 4 Produk Resmi BPRS Wakalumi (termasuk Tabungan Ukhuwah Berhadiah)
    return [
        [
            'nama'        => 'Tabungan Tawakal',
            'slug'        => 'tawakal',
            'tagline'     => 'Tabungan Umum Wakalumi',
            'badge'       => 'Umum & Keluarga',
            'color'       => 'teal',
            'akad'        => 'Mudharabah Muthlaqah',
            'min_setor'   => 'Rp 50.000',
            'biaya_admin' => 'Gratis / Bebas Biaya Bulanan',
            'desc'        => 'Simpanan investasi dengan pola bagi hasil, dikelola dengan prinsip syariah. Solusi amanah untuk kemaslahatan simpanan perorangan dan keluarga.',
            'keunggulan'  => "Bebas biaya administrasi bulanan\nBagi hasil syariah kompetitif dibagikan setiap bulan\nSetoran awal sangat ringan dan terjangkau\nDapat disetor dan ditarik sewaktu-waktu pada jam operasional\nSimpanan aman dijamin Lembaga Penjamin Simpanan (LPS)",
            'syarat'      => "Mengisi dan menandatangani formulir pembukaan rekening\nMelampirkan fotokopi e-KTP / Paspor yang masih berlaku\nMelampirkan fotokopi NPWP (bila ada)\nSetoran awal minimal Rp 50.000",
            'wa_text'     => 'Halo BPRS Wakalumi, saya tertarik untuk membuka rekening Tabungan Tawakal. Mohon informasi prosedur dan persyaratannya.',
            'urutan'      => 1,
        ],
        [
            'nama'        => 'Tabungan Pendidikan',
            'slug'        => 'pendidikan',
            'tagline'     => 'Simpanan Masa Depan Pelajar',
            'badge'       => 'Pelajar & Mahasiswa',
            'color'       => 'blue',
            'akad'        => 'Mudharabah / Wadi\'ah',
            'min_setor'   => 'Rp 20.000',
            'biaya_admin' => 'Gratis / Bebas Biaya Bulanan',
            'desc'        => 'Simpanan untuk para pelajar dengan pola bagi hasil, dikelola sesuai dengan prinsip syariah. Melatih kemandirian dan kebiasaan gemar menabung sejak usia dini.',
            'keunggulan'  => "Bebas biaya administrasi bulanan agar tabungan anak tidak terpotong\nBuku tabungan diterbitkan atas nama anak (pelajar)\nBagi hasil syariah yang berkah dan transparan\nPerencanaan biaya jenjang sekolah dan perguruan tinggi yang aman\nDijamin Lembaga Penjamin Simpanan (LPS)",
            'syarat'      => "Mengisi formulir pembukaan rekening oleh anak / orang tua wali\nFotokopi Kartu Identitas Anak (KIA) atau Akta Kelahiran\nFotokopi Kartu Pelajar (jika sudah ada)\nFotokopi e-KTP Orang Tua / Wali yang mendampingi\nSetoran awal minimal Rp 20.000",
            'wa_text'     => 'Halo BPRS Wakalumi, saya ingin membuka Tabungan Pendidikan untuk putra/putri saya. Mohon informasi syarat dan formulasinya.',
            'urutan'      => 2,
        ],
        [
            'nama'        => 'Tabungan Haji dan Umroh',
            'slug'        => 'haji-umroh',
            'tagline'     => 'Langkah Niat Suci ke Baitullah',
            'badge'       => 'Persiapan Ibadah',
            'color'       => 'amber',
            'akad'        => 'Mudharabah Muthlaqah',
            'min_setor'   => 'Rp 100.000',
            'biaya_admin' => 'Gratis / Bebas Biaya Bulanan',
            'desc'        => 'Simpanan khusus bagi umat Islam yang akan menunaikan ibadah haji dan umroh dengan pola bagi hasil, dikelola dengan prinsip syariah.',
            'keunggulan'  => "Membantu percepatan pencapaian setoran awal porsi haji Kemenag (Rp 25 Juta) atau paket Umroh\nDana tersimpan aman dan terhindar dari pemakaian konsumtif sehari-hari\nBebas biaya administrasi bulanan\nBagi hasil bulanan diinvestasikan kembali untuk mempercepat keberangkatan\nPendampingan dan konsultasi berkala persiapan pendaftaran haji/umroh",
            'syarat'      => "Mengisi formulir pembukaan Tabungan Haji & Umroh\nMelampirkan fotokopi e-KTP yang masih berlaku\nMelampirkan fotokopi Kartu Keluarga (KK)\nPas foto 3x4 dan 4x6 latar putih (untuk persiapan porsi)\nSetoran awal minimal Rp 100.000",
            'wa_text'     => 'Halo BPRS Wakalumi, saya berencana membuka Tabungan Haji & Umroh. Mohon pendampingan informasi setoran dan porsi haji.',
            'urutan'      => 3,
        ],
        [
            'nama'        => 'Tabungan Ukhuwah (Tabungan Berhadiah)',
            'slug'        => 'ukhuwah',
            'tagline'     => 'Tabungan Berhadiah Berkah Tanpa Riba',
            'badge'       => 'Program Berhadiah',
            'color'       => 'purple',
            'akad'        => 'Mudharabah Muthlaqah',
            'min_setor'   => 'Rp 100.000',
            'biaya_admin' => 'Gratis / Bebas Biaya Bulanan',
            'desc'        => 'Simpanan investasi berjangka syariah yang memberikan kesempatan hadiah menarik (hadiah langsung atau poin undian berkah) bagi nasabah setia, dikelola murni dengan prinsip syariah yang adil dan menenteramkan.',
            'keunggulan'  => "Program apresiasi hadiah menarik tanpa melanggar prinsip syariah\nBagi hasil bulanan tetap menguntungkan dan bersaing\nBebas biaya administrasi bulanan\nNominal penempatan fleksibel dengan berbagai pilihan program hadiah\nSimpanan aman dijamin Lembaga Penjamin Simpanan (LPS) hingga Rp 2 Miliar",
            'syarat'      => "Mengisi formulir pembukaan Tabungan Ukhuwah Berhadiah\nMelampirkan fotokopi e-KTP yang masih berlaku\nMelampirkan fotokopi NPWP (bila ada)\nMenyetujui ketentuan periode penempatan dana program berhadiah\nSetoran awal minimal sesuai paket program hadiah pilihan",
            'wa_text'     => 'Halo BPRS Wakalumi, saya tertarik dengan program Tabungan Ukhuwah (Tabungan Berhadiah). Mohon info katalog hadiah dan persyaratannya.',
            'urutan'      => 4,
        ],
    ];
}

/**
 * Helper: Ambil Daftar Tanya Jawab (FAQ / QnA) Tabungan
 */
function wakalumi_get_tabungan_faq_list() {
    $saved = get_option( 'options_tabungan_faq_list', null );
    if ( is_array( $saved ) && ! empty( $saved ) ) {
        return $saved;
    }

    return [
        [
            'q' => 'Bagaimana cara membuka rekening tabungan di BPRS Wakalumi?',
            'a' => 'Anda dapat langsung mengunjungi salah satu jaringan kantor operasional kami (Kantor Pusat Ciputat, Kantor Kas Cikupa, atau Kantor Layanan Ciledug) dengan membawa kartu identitas (e-KTP). Anda juga dapat menghubungi Customer Service via WhatsApp untuk mendapatkan layanan jemput setoran atau pendampingan awal.',
        ],
        [
            'q' => 'Apakah ada potongan biaya administrasi bulanan pada rekening tabungan?',
            'a' => 'Tidak ada. Seluruh produk tabungan BPRS Wakalumi bebas biaya administrasi bulanan, sehingga saldo tabungan Anda tetap utuh terjaga dan tidak berkurang.',
        ],
        [
            'q' => 'Apakah dana simpanan tabungan saya aman dan dijamin LPS?',
            'a' => 'Sangat aman. BPRS Wakalumi adalah bank peserta penjaminan Lembaga Penjamin Simpanan (LPS) dengan batas penjaminan hingga Rp 2 Miliar per nasabah per bank, serta beroperasi dengan izin resmi dan diawasi oleh Otoritas Jasa Keuangan (OJK).',
        ],
        [
            'q' => 'Apa perbedaan antara akad Mudharabah dan Wadiah pada tabungan syariah?',
            'a' => 'Akad Wadiah adalah titipan murni di mana nasabah menitipkan dana tanpa janji bagi hasil tetap (dapat berupa bonus sukarela). Sedangkan akad Mudharabah adalah kerja sama investasi syariah di mana dana nasabah dikelola secara produktif oleh bank dan keuntungan dibagikan setiap bulan sesuai nisbah bagi hasil yang disepakati.',
        ],
        [
            'q' => 'Apakah BPRS Wakalumi menyediakan layanan jemput setoran tabungan?',
            'a' => 'Ya, BPRS Wakalumi menyediakan fasilitas layanan jemput setoran (pick-up service) bagi nasabah perorangan maupun pedagang/pelaku usaha UMKM untuk memudahkan menabung tanpa perlu repot meninggalkan tempat usaha atau aktivitas harian.',
        ],
    ];
}

/**
 * Helper: Ambil Daftar Shortcut / Preset Simulasi Kalkulator Tabungan
 */
function wakalumi_get_tabungan_calc_presets() {
    $saved = get_option( 'options_tabungan_calc_presets', null );
    if ( is_array( $saved ) && ! empty( $saved ) ) {
        return $saved;
    }

    return [
        [
            'label'   => 'Rp 10 Juta',
            'nominal' => '10000000',
            'tenor'   => '12',
            'prod'    => '',
        ],
        [
            'label'   => 'Rp 25 Jt (Porsi Haji)',
            'nominal' => '25000000',
            'tenor'   => '36',
            'prod'    => 'Tabungan Haji dan Umroh',
        ],
        [
            'label'   => 'Rp 35 Jt (Umroh)',
            'nominal' => '35000000',
            'tenor'   => '24',
            'prod'    => 'Tabungan Haji dan Umroh',
        ],
        [
            'label'   => 'Rp 50 Juta',
            'nominal' => '50000000',
            'tenor'   => '36',
            'prod'    => '',
        ],
    ];
}

/**
 * Helper: Ambil Data Realisasi Nisbah Terkini dari Database
 */
function wakalumi_get_nisbah_data() {
    $data = get_option( 'options_nisbah_data', [] );
    if ( empty( $data ) || ! is_array( $data ) ) {
        $data = [
            ['nisbah_produk' => 'Tabungan Reguler', 'nisbah_jenis' => 'tabungan', 'nisbah_nasabah' => '15', 'nisbah_bank' => '85', 'nisbah_equiv' => '1.49%'],
            ['nisbah_produk' => 'Tabungan Ukhuwah', 'nisbah_jenis' => 'tabungan', 'nisbah_nasabah' => '10', 'nisbah_bank' => '90', 'nisbah_equiv' => '1.00%'],
            ['nisbah_produk' => 'Deposito 1 Bulan', 'nisbah_jenis' => 'deposito', 'nisbah_nasabah' => '30', 'nisbah_bank' => '70', 'nisbah_equiv' => '2.99%'],
            ['nisbah_produk' => 'Deposito 3 Bulan', 'nisbah_jenis' => 'deposito', 'nisbah_nasabah' => '35', 'nisbah_bank' => '65', 'nisbah_equiv' => '3.48%'],
            ['nisbah_produk' => 'Deposito 6 Bulan', 'nisbah_jenis' => 'deposito', 'nisbah_nasabah' => '40', 'nisbah_bank' => '60', 'nisbah_equiv' => '3.98%'],
            ['nisbah_produk' => 'Deposito 12 Bulan', 'nisbah_jenis' => 'deposito', 'nisbah_nasabah' => '42.5', 'nisbah_bank' => '57.5', 'nisbah_equiv' => '4.23%'],
        ];
    }
    return $data;
}

/**
 * Helper: Ambil Periode Bulan Nisbah Terkini
 */
function wakalumi_get_nisbah_bulan() {
    return get_option( 'options_nisbah_bulan', 'Agustus 2026' );
}

/**
 * Helper: Ambil Peta Nilai Rate Deposito (Tenor 1, 3, 6, 12 Bulan)
 */
function wakalumi_get_deposito_rates() {
    $nisbah_data = wakalumi_get_nisbah_data();
    $rates = [
        1  => [ 'nama' => 'Deposito 1 Bulan',  'nasabah' => '30', 'bank' => '70', 'equiv' => '2.99%', 'rate_val' => 2.99 ],
        3  => [ 'nama' => 'Deposito 3 Bulan',  'nasabah' => '35', 'bank' => '65', 'equiv' => '3.48%', 'rate_val' => 3.48 ],
        6  => [ 'nama' => 'Deposito 6 Bulan',  'nasabah' => '40', 'bank' => '60', 'equiv' => '3.98%', 'rate_val' => 3.98 ],
        12 => [ 'nama' => 'Deposito 12 Bulan', 'nasabah' => '42.5', 'bank' => '57.5', 'equiv' => '4.23%', 'rate_val' => 4.23 ],
    ];

    foreach ( $nisbah_data as $row ) {
        if ( ( $row['nisbah_jenis'] ?? '' ) === 'deposito' ) {
            $name = strtolower( $row['nisbah_produk'] ?? '' );
            $raw_equiv = $row['nisbah_equiv'] ?? '';
            $equiv_clean = floatval( str_replace( [ '%', ',', ' ' ], [ '', '.', '' ], $raw_equiv ) );
            $tenor_key = null;
            if ( preg_match( '/(\d+)\s*(?:bln|bulan|thn|tahun)/i', $name, $matches ) ) {
                $tenor_key = intval( $matches[1] );
                if ( strpos( $name, 'thn' ) !== false || strpos( $name, 'tahun' ) !== false ) {
                    $tenor_key = $tenor_key * 12;
                }
            } elseif ( strpos( $name, '12' ) !== false ) {
                $tenor_key = 12;
            } elseif ( strpos( $name, '6' ) !== false ) {
                $tenor_key = 6;
            } elseif ( strpos( $name, '3' ) !== false ) {
                $tenor_key = 3;
            } elseif ( strpos( $name, '1' ) !== false ) {
                $tenor_key = 1;
            }

            if ( $tenor_key ) {
                $rates[ $tenor_key ] = [
                    'nama'     => $row['nisbah_produk'] ?? ( 'Deposito ' . $tenor_key . ' Bulan' ),
                    'nasabah'  => $row['nisbah_nasabah'] ?? ( $rates[ $tenor_key ]['nasabah'] ?? '40' ),
                    'bank'     => $row['nisbah_bank'] ?? ( $rates[ $tenor_key ]['bank'] ?? '60' ),
                    'equiv'    => ! empty( $raw_equiv ) ? $raw_equiv : ( $rates[ $tenor_key ]['equiv'] ?? '4.00%' ),
                    'rate_val' => $equiv_clean > 0 ? $equiv_clean : ( $rates[ $tenor_key ]['rate_val'] ?? 4.00 ),
                ];
            }
        }
    }
    return $rates;
}

/**
 * Render Halaman Admin Pengelolaan Produk Dana (Tabungan & Deposito)
 */
function wakalumi_render_produk_admin_page( $default_tab = 'tabungan' ) {
    // Pastikan media WordPress siap untuk upload PDF brosur
    wp_enqueue_media();

    // ── PENENTUAN TAB AKTIF (Server-Side & URL Fallback) ────────────
    $active_tab = $default_tab;
    if ( isset( $_GET['page'] ) && $_GET['page'] === 'wakalumi-deposito' ) {
        $active_tab = 'deposito';
    }
    if ( isset( $_GET['tab'] ) && in_array( $_GET['tab'], [ 'tabungan', 'deposito', 'kontak' ], true ) ) {
        $active_tab = sanitize_key( $_GET['tab'] );
    } elseif ( isset( $_POST['active_tab'] ) && in_array( $_POST['active_tab'], [ 'tabungan', 'deposito', 'kontak' ], true ) ) {
        $active_tab = sanitize_key( $_POST['active_tab'] );
    }

    // ── PROSES SIMPAN DATA ──────────────────────────────────────────
    if ( isset( $_POST['wakalumi_save_produk_dana'] ) && check_admin_referer( 'wakalumi_produk_dana_nonce' ) ) {
        
        // 1. Tabungan: Header Banner & LPS Card
        update_option( 'options_tabungan_page_badge', sanitize_text_field( $_POST['options_tabungan_page_badge'] ?? '' ) );
        update_option( 'options_tabungan_page_title', sanitize_text_field( $_POST['options_tabungan_page_title'] ?? '' ) );
        update_option( 'options_tabungan_page_subtitle', sanitize_textarea_field( $_POST['options_tabungan_page_subtitle'] ?? '' ) );
        update_option( 'options_tabungan_quote', sanitize_textarea_field( $_POST['options_tabungan_quote'] ?? '' ) );

        update_option( 'options_tabungan_lps_tag', sanitize_text_field( $_POST['options_tabungan_lps_tag'] ?? '' ) );
        update_option( 'options_tabungan_lps_title', sanitize_text_field( $_POST['options_tabungan_lps_title'] ?? '' ) );
        update_option( 'options_tabungan_lps_desc', sanitize_textarea_field( $_POST['options_tabungan_lps_desc'] ?? '' ) );
        update_option( 'options_tabungan_lps_btn_text', sanitize_text_field( $_POST['options_tabungan_lps_btn_text'] ?? '' ) );

        // 2. Tabungan: Dynamic Repeater
        $tab_names        = $_POST['tab_nama'] ?? [];
        $tab_slugs        = $_POST['tab_slug'] ?? [];
        $tab_taglines     = $_POST['tab_tagline'] ?? [];
        $tab_badges       = $_POST['tab_badge'] ?? [];
        $tab_colors       = $_POST['tab_color'] ?? [];
        $tab_icons        = $_POST['tab_icon'] ?? [];
        $tab_penarikans   = $_POST['tab_penarikan'] ?? [];
        $tab_akads        = $_POST['tab_akad'] ?? [];
        $tab_min_setors   = $_POST['tab_min_setor'] ?? [];
        $tab_biaya_admins = $_POST['tab_biaya_admin'] ?? [];
        $tab_descs        = $_POST['tab_desc'] ?? [];
        $tab_keunggulans  = $_POST['tab_keunggulan'] ?? [];
        $tab_syarats      = $_POST['tab_syarat'] ?? [];
        $tab_wa_texts     = $_POST['tab_wa_text'] ?? [];
        $tab_images       = $_POST['tab_image'] ?? [];
        $tab_urutans      = $_POST['tab_urutan'] ?? [];

        $clean_tabungan_list = [];
        for ( $i = 0; $i < count( $tab_names ); $i++ ) {
            $nama = sanitize_text_field( $tab_names[$i] ?? '' );
            if ( empty( $nama ) ) {
                continue;
            }
            $raw_slug = sanitize_title( $tab_slugs[$i] ?? '' );
            if ( empty( $raw_slug ) ) {
                $raw_slug = sanitize_title( $nama );
            }

            $clean_tabungan_list[] = [
                'nama'        => $nama,
                'slug'        => $raw_slug,
                'tagline'     => sanitize_text_field( $tab_taglines[$i] ?? '' ),
                'badge'       => sanitize_text_field( $tab_badges[$i] ?? '' ),
                'color'       => sanitize_text_field( $tab_colors[$i] ?? 'teal' ),
                'icon'        => sanitize_text_field( $tab_icons[$i] ?? 'wallet' ),
                'penarikan'   => sanitize_text_field( $tab_penarikans[$i] ?? '' ),
                'akad'        => sanitize_text_field( $tab_akads[$i] ?? 'Mudharabah Muthlaqah' ),
                'min_setor'   => sanitize_text_field( $tab_min_setors[$i] ?? 'Rp 50.000' ),
                'biaya_admin' => sanitize_text_field( $tab_biaya_admins[$i] ?? 'Gratis / Bebas Biaya Bulanan' ),
                'desc'        => sanitize_textarea_field( $tab_descs[$i] ?? '' ),
                'keunggulan'  => sanitize_textarea_field( $tab_keunggulans[$i] ?? '' ),
                'syarat'      => sanitize_textarea_field( $tab_syarats[$i] ?? '' ),
                'wa_text'     => sanitize_text_field( $tab_wa_texts[$i] ?? '' ),
                'image'       => esc_url_raw( $tab_images[$i] ?? '' ),
                'urutan'      => intval( $tab_urutans[$i] ?? ( $i + 1 ) ),
            ];
        }

        // Urutkan berdasarkan kolom 'urutan'
        usort( $clean_tabungan_list, function( $a, $b ) {
            return ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 );
        } );

        update_option( 'options_tabungan_list', $clean_tabungan_list );

        // 2b. Tabungan: Tabel Komparasi
        update_option( 'options_tabungan_komparasi_kicker', sanitize_text_field( $_POST['options_tabungan_komparasi_kicker'] ?? '' ) );
        update_option( 'options_tabungan_komparasi_title', sanitize_text_field( $_POST['options_tabungan_komparasi_title'] ?? '' ) );
        update_option( 'options_tabungan_komparasi_desc', sanitize_textarea_field( $_POST['options_tabungan_komparasi_desc'] ?? '' ) );
        update_option( 'options_tabungan_komparasi_lps_note', sanitize_textarea_field( $_POST['options_tabungan_komparasi_lps_note'] ?? '' ) );

        // 2c. Tabungan: 4 Keunggulan Menabung Syariah
        update_option( 'options_tabungan_keung_kicker', sanitize_text_field( $_POST['options_tabungan_keung_kicker'] ?? '' ) );
        update_option( 'options_tabungan_keung_title', sanitize_text_field( $_POST['options_tabungan_keung_title'] ?? '' ) );
        update_option( 'options_tabungan_keung_desc', sanitize_textarea_field( $_POST['options_tabungan_keung_desc'] ?? '' ) );
        update_option( 'options_tabungan_keung_1_title', sanitize_text_field( $_POST['options_tabungan_keung_1_title'] ?? '' ) );
        update_option( 'options_tabungan_keung_1_desc', sanitize_textarea_field( $_POST['options_tabungan_keung_1_desc'] ?? '' ) );
        update_option( 'options_tabungan_keung_2_title', sanitize_text_field( $_POST['options_tabungan_keung_2_title'] ?? '' ) );
        update_option( 'options_tabungan_keung_2_desc', sanitize_textarea_field( $_POST['options_tabungan_keung_2_desc'] ?? '' ) );
        update_option( 'options_tabungan_keung_3_title', sanitize_text_field( $_POST['options_tabungan_keung_3_title'] ?? '' ) );
        update_option( 'options_tabungan_keung_3_desc', sanitize_textarea_field( $_POST['options_tabungan_keung_3_desc'] ?? '' ) );
        update_option( 'options_tabungan_keung_4_title', sanitize_text_field( $_POST['options_tabungan_keung_4_title'] ?? '' ) );
        update_option( 'options_tabungan_keung_4_desc', sanitize_textarea_field( $_POST['options_tabungan_keung_4_desc'] ?? '' ) );

        // 3. Tabungan: Pengaturan Kalkulator
        update_option( 'options_tabungan_calc_badge', sanitize_text_field( $_POST['options_tabungan_calc_badge'] ?? '' ) );
        update_option( 'options_tabungan_calc_title', sanitize_text_field( $_POST['options_tabungan_calc_title'] ?? '' ) );
        update_option( 'options_tabungan_calc_subtitle', sanitize_textarea_field( $_POST['options_tabungan_calc_subtitle'] ?? '' ) );
        update_option( 'options_tabungan_calc_target_min', sanitize_text_field( $_POST['options_tabungan_calc_target_min'] ?? '' ) );
        update_option( 'options_tabungan_calc_target_max', sanitize_text_field( $_POST['options_tabungan_calc_target_max'] ?? '' ) );
        update_option( 'options_tabungan_calc_target_default', sanitize_text_field( $_POST['options_tabungan_calc_target_default'] ?? '' ) );
        update_option( 'options_tabungan_calc_note', sanitize_textarea_field( $_POST['options_tabungan_calc_note'] ?? '' ) );
        update_option( 'options_tabungan_calc_btn_text', sanitize_text_field( $_POST['options_tabungan_calc_btn_text'] ?? '' ) );

        // 3b. Tabungan: Repeater Shortcut / Preset Target Simulasi
        $preset_labels   = $_POST['calc_preset_label'] ?? [];
        $preset_nominals = $_POST['calc_preset_nominal'] ?? [];
        $preset_tenors   = $_POST['calc_preset_tenor'] ?? [];
        $preset_prods    = $_POST['calc_preset_prod'] ?? [];

        $clean_calc_presets = [];
        for ( $p = 0; $p < count( $preset_labels ); $p++ ) {
            $p_label   = sanitize_text_field( $preset_labels[$p] ?? '' );
            $p_nominal = sanitize_text_field( $preset_nominals[$p] ?? '' );
            $p_tenor   = sanitize_text_field( $preset_tenors[$p] ?? '' );
            $p_prod    = sanitize_text_field( $preset_prods[$p] ?? '' );
            if ( ! empty( $p_label ) || ! empty( $p_nominal ) ) {
                $clean_calc_presets[] = [
                    'label'   => $p_label,
                    'nominal' => preg_replace( '/[^0-9]/', '', $p_nominal ),
                    'tenor'   => preg_replace( '/[^0-9]/', '', $p_tenor ),
                    'prod'    => $p_prod,
                ];
            }
        }
        update_option( 'options_tabungan_calc_presets', $clean_calc_presets );

        // 4. Tabungan: Pengaturan Tanya Jawab (FAQ / QnA)
        update_option( 'options_tabungan_faq_badge', sanitize_text_field( $_POST['options_tabungan_faq_badge'] ?? '' ) );
        update_option( 'options_tabungan_faq_title', sanitize_text_field( $_POST['options_tabungan_faq_title'] ?? '' ) );
        update_option( 'options_tabungan_faq_subtitle', sanitize_textarea_field( $_POST['options_tabungan_faq_subtitle'] ?? '' ) );

        $faq_qs = $_POST['tab_faq_q'] ?? [];
        $faq_as = $_POST['tab_faq_a'] ?? [];
        $clean_faqs = [];
        for ( $f = 0; $f < count( $faq_qs ); $f++ ) {
            $q = sanitize_text_field( $faq_qs[$f] ?? '' );
            $a = sanitize_textarea_field( $faq_as[$f] ?? '' );
            if ( ! empty( $q ) || ! empty( $a ) ) {
                $clean_faqs[] = [ 'q' => $q, 'a' => $a ];
            }
        }
        update_option( 'options_tabungan_faq_list', $clean_faqs );

        // 4b. Tabungan: Box Brosur & Box Promo Deposito
        update_option( 'options_tabungan_brosur_kicker', sanitize_text_field( $_POST['options_tabungan_brosur_kicker'] ?? '' ) );
        update_option( 'options_tabungan_brosur_title', sanitize_text_field( $_POST['options_tabungan_brosur_title'] ?? '' ) );
        update_option( 'options_tabungan_brosur_desc', sanitize_textarea_field( $_POST['options_tabungan_brosur_desc'] ?? '' ) );
        update_option( 'options_tabungan_brosur_btn', sanitize_text_field( $_POST['options_tabungan_brosur_btn'] ?? '' ) );

        update_option( 'options_tabungan_dep_kicker', sanitize_text_field( $_POST['options_tabungan_dep_kicker'] ?? '' ) );
        update_option( 'options_tabungan_dep_title', sanitize_text_field( $_POST['options_tabungan_dep_title'] ?? '' ) );
        update_option( 'options_tabungan_dep_desc', sanitize_textarea_field( $_POST['options_tabungan_dep_desc'] ?? '' ) );
        update_option( 'options_tabungan_dep_btn', sanitize_text_field( $_POST['options_tabungan_dep_btn'] ?? '' ) );

        // 4c. Tabungan: Banner CTA Konsultasi Tabungan
        update_option( 'options_tabungan_cta_kicker', sanitize_text_field( $_POST['options_tabungan_cta_kicker'] ?? '' ) );
        update_option( 'options_tabungan_cta_title', sanitize_text_field( $_POST['options_tabungan_cta_title'] ?? '' ) );
        update_option( 'options_tabungan_cta_desc', sanitize_textarea_field( $_POST['options_tabungan_cta_desc'] ?? '' ) );
        update_option( 'options_tabungan_cta_btn_text', sanitize_text_field( $_POST['options_tabungan_cta_btn_text'] ?? '' ) );
        update_option( 'options_tabungan_cta_wa_msg', sanitize_textarea_field( $_POST['options_tabungan_cta_wa_msg'] ?? '' ) );

        // 4d. Tabungan: Realisasi Nisbah Bagi Hasil Tabungan
        if ( isset( $_POST['options_nisbah_bulan'] ) && ! empty( trim( $_POST['options_nisbah_bulan'] ) ) ) {
            update_option( 'options_nisbah_bulan', sanitize_text_field( $_POST['options_nisbah_bulan'] ) );
        }

        if ( isset( $_POST['tab_nisbah_produk'] ) && is_array( $_POST['tab_nisbah_produk'] ) ) {
            $existing_nisbah = wakalumi_get_nisbah_data();
            $new_nisbah = [];

            // 1. Masukkan produk tabungan dari form
            $tab_nis_prods   = $_POST['tab_nisbah_produk'];
            $tab_nis_nasabah = $_POST['tab_nisbah_nasabah'] ?? [];
            $tab_nis_bank    = $_POST['tab_nisbah_bank'] ?? [];
            $tab_nis_equiv   = $_POST['tab_nisbah_equiv'] ?? [];

            for ( $tn = 0; $tn < count( $tab_nis_prods ); $tn++ ) {
                $p_name = sanitize_text_field( $tab_nis_prods[$tn] ?? '' );
                if ( ! empty( $p_name ) ) {
                    $new_nisbah[] = [
                        'nisbah_produk'  => $p_name,
                        'nisbah_jenis'   => 'tabungan',
                        'nisbah_nasabah' => sanitize_text_field( $tab_nis_nasabah[$tn] ?? '' ),
                        'nisbah_bank'    => sanitize_text_field( $tab_nis_bank[$tn] ?? '' ),
                        'nisbah_equiv'   => sanitize_text_field( $tab_nis_equiv[$tn] ?? '' ),
                    ];
                }
            }

            // 2. Pertahankan produk deposito yang sudah ada
            foreach ( $existing_nisbah as $row ) {
                if ( ( $row['nisbah_jenis'] ?? '' ) === 'deposito' ) {
                    $new_nisbah[] = $row;
                }
            }

            update_option( 'options_nisbah_data', $new_nisbah );
        }

        // 5. Deposito: Header Banner
        update_option( 'options_deposito_page_badge', sanitize_text_field( $_POST['options_deposito_page_badge'] ?? '' ) );
        update_option( 'options_deposito_page_title', sanitize_text_field( $_POST['options_deposito_page_title'] ?? '' ) );
        update_option( 'options_deposito_page_subtitle', sanitize_textarea_field( $_POST['options_deposito_page_subtitle'] ?? '' ) );
        update_option( 'options_deposito_quote', sanitize_textarea_field( $_POST['options_deposito_quote'] ?? '' ) );

        // 5b. Deposito: LPS Card
        update_option( 'options_deposito_lps_tag', sanitize_text_field( $_POST['options_deposito_lps_tag'] ?? '' ) );
        update_option( 'options_deposito_lps_title', sanitize_text_field( $_POST['options_deposito_lps_title'] ?? '' ) );
        update_option( 'options_deposito_lps_desc', sanitize_textarea_field( $_POST['options_deposito_lps_desc'] ?? '' ) );
        update_option( 'options_deposito_lps_btn_text', sanitize_text_field( $_POST['options_deposito_lps_btn_text'] ?? '' ) );

        // 5c. Deposito: Section Tenor & 4 Kartu Tenor
        update_option( 'options_deposito_tenor_kicker', sanitize_text_field( $_POST['options_deposito_tenor_kicker'] ?? '' ) );
        update_option( 'options_deposito_tenor_title', sanitize_text_field( $_POST['options_deposito_tenor_title'] ?? '' ) );
        update_option( 'options_deposito_tenor_desc', sanitize_textarea_field( $_POST['options_deposito_tenor_desc'] ?? '' ) );

        update_option( 'options_deposito_t1_badge', sanitize_text_field( $_POST['options_deposito_t1_badge'] ?? '' ) );
        update_option( 'options_deposito_t1_desc', sanitize_textarea_field( $_POST['options_deposito_t1_desc'] ?? '' ) );
        update_option( 'options_deposito_t1_aro', sanitize_text_field( $_POST['options_deposito_t1_aro'] ?? '' ) );

        update_option( 'options_deposito_t3_badge', sanitize_text_field( $_POST['options_deposito_t3_badge'] ?? '' ) );
        update_option( 'options_deposito_t3_desc', sanitize_textarea_field( $_POST['options_deposito_t3_desc'] ?? '' ) );
        update_option( 'options_deposito_t3_aro', sanitize_text_field( $_POST['options_deposito_t3_aro'] ?? '' ) );

        update_option( 'options_deposito_t6_badge', sanitize_text_field( $_POST['options_deposito_t6_badge'] ?? '' ) );
        update_option( 'options_deposito_t6_desc', sanitize_textarea_field( $_POST['options_deposito_t6_desc'] ?? '' ) );
        update_option( 'options_deposito_t6_aro', sanitize_text_field( $_POST['options_deposito_t6_aro'] ?? '' ) );

        update_option( 'options_deposito_t12_badge', sanitize_text_field( $_POST['options_deposito_t12_badge'] ?? '' ) );
        update_option( 'options_deposito_t12_highlight', sanitize_text_field( $_POST['options_deposito_t12_highlight'] ?? '' ) );
        update_option( 'options_deposito_t12_desc', sanitize_textarea_field( $_POST['options_deposito_t12_desc'] ?? '' ) );
        update_option( 'options_deposito_t12_aro', sanitize_text_field( $_POST['options_deposito_t12_aro'] ?? '' ) );

        // 5d. Deposito: Keunggulan Card
        update_option( 'options_deposito_keunggulan_kicker', sanitize_text_field( $_POST['options_deposito_keunggulan_kicker'] ?? '' ) );
        update_option( 'options_deposito_keunggulan_title', sanitize_text_field( $_POST['options_deposito_keunggulan_title'] ?? '' ) );
        update_option( 'options_deposito_keunggulan_badge', sanitize_text_field( $_POST['options_deposito_keunggulan_badge'] ?? '' ) );
        update_option( 'options_deposito_keunggulan', sanitize_textarea_field( $_POST['options_deposito_keunggulan'] ?? '' ) );

        // 5e. Deposito: Section Tabel Nisbah & Sharia Note
        update_option( 'options_deposito_nisbah_kicker', sanitize_text_field( $_POST['options_deposito_nisbah_kicker'] ?? '' ) );
        update_option( 'options_deposito_nisbah_title', sanitize_text_field( $_POST['options_deposito_nisbah_title'] ?? '' ) );
        update_option( 'options_deposito_nisbah_desc', sanitize_textarea_field( $_POST['options_deposito_nisbah_desc'] ?? '' ) );
        update_option( 'options_deposito_nisbah_row_desc', sanitize_text_field( $_POST['options_deposito_nisbah_row_desc'] ?? '' ) );
        update_option( 'options_deposito_sharia_note_title', sanitize_text_field( $_POST['options_deposito_sharia_note_title'] ?? '' ) );
        update_option( 'options_deposito_sharia_note_desc', sanitize_textarea_field( $_POST['options_deposito_sharia_note_desc'] ?? '' ) );

        // 5f. Deposito: Kalkulator Simulasi
        update_option( 'options_deposito_calc_badge', sanitize_text_field( $_POST['options_deposito_calc_badge'] ?? '' ) );
        update_option( 'options_deposito_calc_title', sanitize_text_field( $_POST['options_deposito_calc_title'] ?? '' ) );
        update_option( 'options_deposito_calc_desc', sanitize_textarea_field( $_POST['options_deposito_calc_desc'] ?? '' ) );
        update_option( 'options_deposito_calc_input_label', sanitize_text_field( $_POST['options_deposito_calc_input_label'] ?? '' ) );
        update_option( 'options_deposito_calc_min', sanitize_text_field( $_POST['options_deposito_calc_min'] ?? '' ) );
        update_option( 'options_deposito_calc_max', sanitize_text_field( $_POST['options_deposito_calc_max'] ?? '' ) );
        update_option( 'options_deposito_calc_max_note', sanitize_text_field( $_POST['options_deposito_calc_max_note'] ?? '' ) );
        update_option( 'options_deposito_calc_default', sanitize_text_field( $_POST['options_deposito_calc_default'] ?? '' ) );
        update_option( 'options_deposito_calc_note', sanitize_textarea_field( $_POST['options_deposito_calc_note'] ?? '' ) );

        // 5g. Deposito: Persyaratan & Dokumen
        update_option( 'options_deposito_syarat_kicker', sanitize_text_field( $_POST['options_deposito_syarat_kicker'] ?? '' ) );
        update_option( 'options_deposito_syarat_title', sanitize_text_field( $_POST['options_deposito_syarat_title'] ?? '' ) );
        update_option( 'options_deposito_syarat_desc', sanitize_textarea_field( $_POST['options_deposito_syarat_desc'] ?? '' ) );
        update_option( 'options_deposito_tab1_label', sanitize_text_field( $_POST['options_deposito_tab1_label'] ?? '' ) );
        update_option( 'options_deposito_tab1_badge', sanitize_text_field( $_POST['options_deposito_tab1_badge'] ?? '' ) );
        update_option( 'options_deposito_syarat_individu', sanitize_textarea_field( $_POST['options_deposito_syarat_individu'] ?? '' ) );
        update_option( 'options_deposito_syarat_ind_note', sanitize_textarea_field( $_POST['options_deposito_syarat_ind_note'] ?? '' ) );
        update_option( 'options_deposito_tab2_label', sanitize_text_field( $_POST['options_deposito_tab2_label'] ?? '' ) );
        update_option( 'options_deposito_tab2_badge', sanitize_text_field( $_POST['options_deposito_tab2_badge'] ?? '' ) );
        update_option( 'options_deposito_syarat_lembaga', sanitize_textarea_field( $_POST['options_deposito_syarat_lembaga'] ?? '' ) );
        update_option( 'options_deposito_syarat_lem_note', sanitize_textarea_field( $_POST['options_deposito_syarat_lem_note'] ?? '' ) );

        // 5h. Deposito: CTA Banner & Brosur
        update_option( 'options_deposito_cta_kicker', sanitize_text_field( $_POST['options_deposito_cta_kicker'] ?? '' ) );
        update_option( 'options_deposito_cta_title', sanitize_text_field( $_POST['options_deposito_cta_title'] ?? '' ) );
        update_option( 'options_deposito_cta_desc', sanitize_textarea_field( $_POST['options_deposito_cta_desc'] ?? '' ) );
        update_option( 'options_deposito_cta_btn_text', sanitize_text_field( $_POST['options_deposito_cta_btn_text'] ?? '' ) );
        update_option( 'options_deposito_cta_wa_msg', sanitize_textarea_field( $_POST['options_deposito_cta_wa_msg'] ?? '' ) );
        update_option( 'options_brosur_file_url', esc_url_raw( $_POST['options_brosur_file_url'] ?? '' ) );

        // 6. Deposito: Parameter Dasar
        update_option( 'options_deposito_akad', sanitize_text_field( $_POST['options_deposito_akad'] ?? '' ) );
        update_option( 'options_deposito_min_penempatan', sanitize_text_field( $_POST['options_deposito_min_penempatan'] ?? '' ) );
        update_option( 'options_deposito_tenor_list', sanitize_text_field( $_POST['options_deposito_tenor_list'] ?? '' ) );

        // 6b. Deposito: Nisbah Bagi Hasil & Equivalent Rate (Tersinkronisasi)
        if ( isset( $_POST['options_nisbah_bulan'] ) && ! empty( trim( $_POST['options_nisbah_bulan'] ) ) ) {
            update_option( 'options_nisbah_bulan', sanitize_text_field( $_POST['options_nisbah_bulan'] ) );
        }

        if ( isset( $_POST['dep_nisbah_produk'] ) && is_array( $_POST['dep_nisbah_produk'] ) ) {
            $existing_nisbah = wakalumi_get_nisbah_data();
            $new_nisbah = [];
            
            // Pertahankan produk tabungan yang sudah ada
            foreach ( $existing_nisbah as $row ) {
                if ( ( $row['nisbah_jenis'] ?? '' ) !== 'deposito' ) {
                    $new_nisbah[] = $row;
                }
            }

            // Perbarui produk deposito dari form
            $dep_prods   = $_POST['dep_nisbah_produk'];
            $dep_nasabah = $_POST['dep_nisbah_nasabah'] ?? [];
            $dep_bank    = $_POST['dep_nisbah_bank'] ?? [];
            $dep_equiv   = $_POST['dep_nisbah_equiv'] ?? [];

            for ( $i = 0; $i < count( $dep_prods ); $i++ ) {
                $p_name = sanitize_text_field( $dep_prods[$i] ?? '' );
                if ( ! empty( $p_name ) ) {
                    $new_nisbah[] = [
                        'nisbah_produk'  => $p_name,
                        'nisbah_jenis'   => 'deposito',
                        'nisbah_nasabah' => sanitize_text_field( $dep_nasabah[$i] ?? '' ),
                        'nisbah_bank'    => sanitize_text_field( $dep_bank[$i] ?? '' ),
                        'nisbah_equiv'   => sanitize_text_field( $dep_equiv[$i] ?? '' ),
                    ];
                }
            }

            update_option( 'options_nisbah_data', $new_nisbah );
        }

        // 7. Hotline & CTA
        update_option( 'options_produk_wa_number', sanitize_text_field( $_POST['options_produk_wa_number'] ?? '' ) );
        update_option( 'options_produk_cta_title', sanitize_text_field( $_POST['options_produk_cta_title'] ?? '' ) );
        update_option( 'options_produk_cta_desc', sanitize_textarea_field( $_POST['options_produk_cta_desc'] ?? '' ) );

        $tab_label = ( $active_tab === 'deposito' ) ? 'Deposito Mudharabah & Nisbah' : ( ( $active_tab === 'kontak' ) ? 'Hotline & CTA' : 'Tabungan Syariah' );
        echo '<div class="notice notice-success is-dismissible" style="margin-top: 15px;"><p><strong>Berhasil!</strong> Pengaturan ' . esc_html( $tab_label ) . ' dan data produk berhasil diperbarui.</p></div>';
    }

    // ── AMBIL NILAI DARI DATABASE ───────────────────────────────────
    // Tabungan: Header Banner & LPS
    $tab_page_badge    = get_option( 'options_tabungan_page_badge', 'Penghimpunan Dana Syariah' );
    $tab_page_title    = get_option( 'options_tabungan_page_title', 'Simpanan Berkah Sesuai Syariah' );
    $tab_page_sub      = get_option( 'options_tabungan_page_subtitle', 'Solusi simpanan syariah amanah, bebas biaya administrasi bulanan, bagi hasil bersaing, dan dijamin LPS hingga Rp 2 Miliar.' );
    $tab_quote         = get_option( 'options_tabungan_quote', 'Menabung dengan akad syariah yang murni (Wadiah & Mudharabah), menjaga harta tetap berkah, amanah, dan terhindar dari riba sesuai fatwa DSN-MUI.' );
    $tab_lps_tag       = get_option( 'options_tabungan_lps_tag', 'Penjaminan Resmi LPS & OJK' );
    $tab_lps_title     = get_option( 'options_tabungan_lps_title', 'Simpanan Dijamin LPS s.d. Rp 2 Miliar' );
    $tab_lps_desc      = get_option( 'options_tabungan_lps_desc', 'Seluruh dana simpanan tabungan nasabah dijamin keamanannya oleh Lembaga Penjamin Simpanan (LPS) sesuai ketentuan batas maksimal penjaminan per nasabah per bank.' );
    $tab_lps_btn       = get_option( 'options_tabungan_lps_btn_text', 'Hitung Simulasi Rencana Menabung' );

    $tabungan_list     = wakalumi_get_tabungan_list();

    // Tabungan: Tabel Komparasi
    $tab_komp_kicker   = get_option( 'options_tabungan_komparasi_kicker', 'Perbandingan Produk' );
    $tab_komp_title    = get_option( 'options_tabungan_komparasi_title', 'Pilih Tabungan yang Tepat untuk Kebutuhan Anda' );
    $tab_komp_desc     = get_option( 'options_tabungan_komparasi_desc', 'Bandingkan fitur utama produk simpanan syariah BPRS Wakalumi secara transparan dan amanah.' );
    $tab_komp_lps      = get_option( 'options_tabungan_komparasi_lps_note', 'Dijamin Lembaga Penjamin Simpanan (LPS) s.d. Rp 2 Miliar per nasabah & Diawasi Otoritas Jasa Keuangan (OJK)' );

    // Tabungan: 4 Keunggulan
    $tab_keung_kicker  = get_option( 'options_tabungan_keung_kicker', 'Keunggulan Simpanan Syariah' );
    $tab_keung_title   = get_option( 'options_tabungan_keung_title', 'Mengapa Memilih Menabung di BPRS Wakalumi?' );
    $tab_keung_desc    = get_option( 'options_tabungan_keung_desc', 'Kami memastikan setiap rupiah yang Anda simpan dikelola secara profesional, amanah, dan mendatangkan kemaslahatan bagi umat.' );
    $tab_keung_1_title = get_option( 'options_tabungan_keung_1_title', 'Murni Bebas Riba' );
    $tab_keung_1_desc  = get_option( 'options_tabungan_keung_1_desc', 'Pengelolaan berlandaskan akad syariah yang diawasi langsung oleh Dewan Pengawas Syariah (DPS) dan DSN-MUI.' );
    $tab_keung_2_title = get_option( 'options_tabungan_keung_2_title', 'Bebas Biaya Bulanan' );
    $tab_keung_2_desc  = get_option( 'options_tabungan_keung_2_desc', 'Saldo tabungan Anda tidak akan tergerus oleh biaya administrasi bulanan, sehingga dana Anda aman dan optimal.' );
    $tab_keung_3_title = get_option( 'options_tabungan_keung_3_title', 'Bagi Hasil Kompetitif' );
    $tab_keung_3_desc  = get_option( 'options_tabungan_keung_3_desc', 'Keuntungan hasil pembiayaan produktif sektor riil dibagikan secara adil dan transparan kepada para penabung setiap bulan.' );
    $tab_keung_4_title = get_option( 'options_tabungan_keung_4_title', 'Dijamin LPS Rp 2 Miliar' );
    $tab_keung_4_desc  = get_option( 'options_tabungan_keung_4_desc', 'Dana simpanan masyarakat dijamin secara sah oleh Lembaga Penjamin Simpanan (LPS) sesuai ketentuan regulasi yang berlaku.' );

    // Tabungan: Kalkulator
    $tab_calc_badge    = get_option( 'options_tabungan_calc_badge', 'Simulasi Finansial Syariah' );
    $tab_calc_title    = get_option( 'options_tabungan_calc_title', 'Kalkulator Rencana Menabung Berkah' );
    $tab_calc_sub      = get_option( 'options_tabungan_calc_subtitle', 'Tentukan target impian Anda—mulai dari porsi haji, dana sekolah anak, program tabungan ukhuwah, hingga simpanan masa depan keluarga. Kami hitungkan estimasi sisihan per bulan.' );
    $tab_calc_min      = get_option( 'options_tabungan_calc_target_min', '2000000' );
    $tab_calc_max      = get_option( 'options_tabungan_calc_target_max', '100000000' );
    $tab_calc_default  = get_option( 'options_tabungan_calc_target_default', '25000000' );
    $tab_calc_note     = get_option( 'options_tabungan_calc_note', '*Simulasi indikatif pembulatan matematis tanpa potongan admin bulanan.' );
    $tab_calc_btn      = get_option( 'options_tabungan_calc_btn_text', 'Mulai Menabung via WhatsApp' );
    $tab_calc_presets  = wakalumi_get_tabungan_calc_presets();

    // FAQ Tabungan
    $tab_faq_badge     = get_option( 'options_tabungan_faq_badge', 'Tanya Jawab (FAQ)' );
    $tab_faq_title     = get_option( 'options_tabungan_faq_title', 'Pertanyaan Seputar Tabungan' );
    $tab_faq_sub       = get_option( 'options_tabungan_faq_subtitle', 'Pertanyaan umum nasabah seputar produk simpanan syariah, keamanan simpanan di LPS, dan prosedur pembukaan rekening.' );
    $tab_faq_list      = wakalumi_get_tabungan_faq_list();

    // Box Brosur & Promo Deposito
    $tab_brosur_kicker = get_option( 'options_tabungan_brosur_kicker', 'Katalog Brosur Resmi' );
    $tab_brosur_title  = get_option( 'options_tabungan_brosur_title', 'Unduh Brosur Produk Lengkap' );
    $tab_brosur_desc   = get_option( 'options_tabungan_brosur_desc', 'Dapatkan informasi lengkap seluruh produk simpanan, deposito, dan pembiayaan BPRS Wakalumi dalam format dokumen PDF resmi.' );
    $tab_brosur_btn    = get_option( 'options_tabungan_brosur_btn', 'Unduh File Brosur (PDF)' );

    $tab_dep_kicker    = get_option( 'options_tabungan_dep_kicker', 'Investasi Berjangka' );
    $tab_dep_title     = get_option( 'options_tabungan_dep_title', 'Ingin Imbal Hasil Lebih Optimal?' );
    $tab_dep_desc      = get_option( 'options_tabungan_dep_desc', 'Jelajahi produk Deposito Mudharabah BPRS Wakalumi dengan tenor 1, 3, 6, dan 12 bulan serta porsi nisbah bagi hasil yang kompetitif.' );
    $tab_dep_btn       = get_option( 'options_tabungan_dep_btn', 'Lihat Halaman Deposito Mudharabah' );

    // Tabungan: CTA Banner & Hotline
    $tab_cta_kicker    = get_option( 'options_tabungan_cta_kicker', 'Konsultasi Tabungan Syariah' );
    $tab_cta_title     = get_option( 'options_tabungan_cta_title', 'Mulai Rencanakan Masa Depan Finansial Syariah Anda' );
    $tab_cta_desc      = get_option( 'options_tabungan_cta_desc', 'Buka rekening tabungan syariah tanpa biaya administrasi bulanan dengan proses mudah, cepat, aman, dan dijamin LPS hingga Rp 2 Miliar.' );
    $tab_cta_btn       = get_option( 'options_tabungan_cta_btn_text', 'Buka Tabungan via WhatsApp' );
    $tab_cta_wa_msg    = get_option( 'options_tabungan_cta_wa_msg', 'Halo BPRS Wakalumi, saya ingin membuka rekening tabungan syariah / berkonsultasi mengenai produk tabungan.' );

    // Deposito: Header & LPS
    $dep_page_badge    = get_option( 'options_deposito_page_badge', 'Investasi Syariah Berkah' );
    $dep_page_title    = get_option( 'options_deposito_page_title', 'Deposito Mudharabah BPRS Wakalumi' );
    $dep_page_sub      = get_option( 'options_deposito_page_subtitle', 'Pilihan tepat bagi Anda berinvestasi sekaligus beribadah. Investasi aman, menguntungkan, dan berkah dengan prinsip Mudharabah Muthlaqah.' );
    $dep_quote         = get_option( 'options_deposito_quote', 'Merupakan investasi anda baik secara individu maupun perusahaan dalam bentuk deposito yang sesuai dengan prinsip syariah yakni Mudharabah Muthlaqah, pilihan tepat bagi anda berinvestasi sekaligus juga ibadah.' );
    $dep_lps_tag       = get_option( 'options_deposito_lps_tag', 'Penjaminan Resmi LPS & OJK' );
    $dep_lps_title     = get_option( 'options_deposito_lps_title', 'Dijamin LPS s.d. Rp 2 Miliar' );
    $dep_lps_desc      = get_option( 'options_deposito_lps_desc', 'Dana simpanan deposito Anda aman dan dijamin oleh Lembaga Penjamin Simpanan (LPS) sesuai ketentuan batas maksimal penjaminan.' );
    $dep_lps_btn       = get_option( 'options_deposito_lps_btn_text', 'Hitung Simulasi Bagi Hasil' );

    // Deposito: Tenor Section & 4 Cards
    $dep_tenor_kicker  = get_option( 'options_deposito_tenor_kicker', 'Fleksibilitas Investasi' );
    $dep_tenor_title   = get_option( 'options_deposito_tenor_title', 'Pilihan Tenor Fleksibel Sesuai Kebutuhan' );
    $dep_tenor_desc    = get_option( 'options_deposito_tenor_desc', 'Pilih jangka waktu penempatan yang paling cocok untuk rencana likuiditas pribadi maupun perusahaan.' );
    $dep_t1_badge      = get_option( 'options_deposito_t1_badge', 'Tenor Singkat' );
    $dep_t1_desc       = get_option( 'options_deposito_t1_desc', 'Likuiditas cepat dan fleksibel untuk perputaran dana jangka sangat pendek.' );
    $dep_t1_aro        = get_option( 'options_deposito_t1_aro', 'ARO Tersedia' );
    $dep_t3_badge      = get_option( 'options_deposito_t3_badge', 'Tenor Menengah' );
    $dep_t3_desc       = get_option( 'options_deposito_t3_desc', 'Kombinasi seimbang antara imbal hasil menarik dan durasi penempatan dana.' );
    $dep_t3_aro        = get_option( 'options_deposito_t3_aro', 'ARO Tersedia' );
    $dep_t6_badge      = get_option( 'options_deposito_t6_badge', 'Tenor Optimal' );
    $dep_t6_desc       = get_option( 'options_deposito_t6_desc', 'Pilihan populer untuk alokasi dana semesteran dengan nisbah lebih menguntungkan.' );
    $dep_t6_aro        = get_option( 'options_deposito_t6_aro', 'ARO Tersedia' );
    $dep_t12_badge     = get_option( 'options_deposito_t12_badge', 'Tenor Panjang' );
    $dep_t12_high      = get_option( 'options_deposito_t12_highlight', 'Hasil Tertinggi' );
    $dep_t12_desc      = get_option( 'options_deposito_t12_desc', 'Pertumbuhan investasi maksimal dengan porsi nisbah bagi hasil paling optimal.' );
    $dep_t12_aro       = get_option( 'options_deposito_t12_aro', 'ARO Tersedia' );

    // Deposito: Keunggulan
    $dep_keung_kicker  = get_option( 'options_deposito_keunggulan_kicker', 'Nilai Tambah Investasi' );
    $dep_keung_title   = get_option( 'options_deposito_keunggulan_title', 'Keunggulan Deposito Mudharabah BPRS Wakalumi' );
    $dep_keung_badge   = get_option( 'options_deposito_keunggulan_badge', '6 Keistimewaan Produk' );
    $dep_keunggulan    = get_option( 'options_deposito_keunggulan', "Prinsip murni Mudharabah Muthlaqah (bebas riba & gharar)\nNisbah bagi hasil kompetitif dan adil\nPilihan jangka waktu fleksibel (1, 3, 6, dan 12 bulan)\nFasilitas ARO (Automatic Roll Over) pokok atau pokok + bagi hasil\nDapat dijadikan agunan/jaminan pembiayaan syariah\nDijamin Lembaga Penjamin Simpanan (LPS) hingga Rp 2 Miliar" );

    // Deposito: Nisbah Section & Sharia Note
    $dep_nisbah_kicker = get_option( 'options_deposito_nisbah_kicker', 'Transparansi Realisasi Bagi Hasil' );
    $dep_nisbah_title  = get_option( 'options_deposito_nisbah_title', 'Tabel Nisbah & Indikasi Equivalent Rate' );
    $dep_nisbah_desc   = get_option( 'options_deposito_nisbah_desc', 'Porsi pembagian keuntungan periode {bulan}, terkelola profesional dan diawasi Dewan Pengawas Syariah.' );
    $dep_nisbah_row_desc = get_option( 'options_deposito_nisbah_row_desc', 'Bagi hasil dibagikan bulanan • ARO' );
    $dep_sharia_title  = get_option( 'options_deposito_sharia_note_title', '*Catatan Penting Syariah (Karakteristik Estimasi Bagi Hasil):' );
    $dep_sharia_desc   = get_option( 'options_deposito_sharia_note_desc', 'Porsi nisbah dan indikasi Equivalent Rate (Eqv. Rate) adalah estimasi indikatif berdasarkan realisasi kinerja penyaluran pembiayaan riil bisnis bank periode berjalan. Sesuai prinsip fatwa DSN-MUI (Mudharabah Muthlaqah), imbal hasil tidak dijanjikan secara pasti/tetap di muka (bebas riba), melainkan fluktuatif mengikuti pendapatan riil bank.' );

    // Deposito: Kalkulator
    $dep_calc_badge       = get_option( 'options_deposito_calc_badge', 'Simulasi Finansial Syariah' );
    $dep_calc_title       = get_option( 'options_deposito_calc_title', 'Kalkulator Simulasi Imbal Hasil Deposito' );
    $dep_calc_desc        = get_option( 'options_deposito_calc_desc', 'Hitung estimasi bagi hasil bulanan dan total imbal hasil penempatan dana deposito syariah Anda secara instan, transparan, dan sesuai porsi nisbah terkini.' );
    $dep_calc_input_label = get_option( 'options_deposito_calc_input_label', 'Nominal Penempatan Deposito' );
    $dep_calc_min         = get_option( 'options_deposito_calc_min', '500000' );
    $dep_calc_max         = get_option( 'options_deposito_calc_max', '2000000000' );
    if ( $dep_calc_max === '500000000' ) {
        $dep_calc_max = '2000000000';
    }
    $dep_calc_max_note    = get_option( 'options_deposito_calc_max_note', 'Ketik untuk nominal penempatan lebih dari 2 Miliar' );
    $dep_calc_default     = get_option( 'options_deposito_calc_default', '50000000' );
    $dep_calc_note        = get_option( 'options_deposito_calc_note', '*Simulasi indikatif sebelum pajak. Bagi hasil riil fluktuatif mengikuti pendapatan bulanan bank.' );

    // Deposito: Persyaratan & Dokumen
    $dep_syarat_kicker = get_option( 'options_deposito_syarat_kicker', 'Persyaratan Pembukaan' );
    $dep_syarat_title  = get_option( 'options_deposito_syarat_title', 'Dokumen & Ketentuan Pembukaan Deposito' );
    $dep_syarat_desc   = get_option( 'options_deposito_syarat_desc', 'Pilih kategori kepemilikan rekening untuk melihat daftar persyaratan dokumen resmi.' );
    $dep_tab1_label    = get_option( 'options_deposito_tab1_label', 'Nasabah Perorangan (Individu)' );
    $dep_tab1_badge    = get_option( 'options_deposito_tab1_badge', 'WNI & WNA' );
    $dep_syarat_ind    = get_option( 'options_deposito_syarat_individu', "Mengisi formulir permohonan pembukaan bilyet Deposito Mudharabah\nFotokopi e-KTP / Paspor pemohon yang masih berlaku\nFotokopi NPWP pemohon\nMemiliki rekening tabungan di BPRS Wakalumi sebagai rekening penampung bagi hasil\nNominal penempatan minimal Rp 5.000.000" );
    $dep_syarat_ind_note = get_option( 'options_deposito_syarat_ind_note', 'Formulir resmi pembukaan bilyet deposito dapat dibantu pengisiannya langsung oleh Customer Service kami.' );
    $dep_tab2_label    = get_option( 'options_deposito_tab2_label', 'Perusahaan / Badan Usaha / Yayasan' );
    $dep_tab2_badge    = get_option( 'options_deposito_tab2_badge', 'PT / CV / Yayasan / Koperasi' );
    $dep_syarat_lem    = get_option( 'options_deposito_syarat_lembaga', "Mengisi formulir pembukaan rekening Deposito Lembaga / Perusahaan\nFotokopi Akta Pendirian Perusahaan & Perubahan Anggaran Dasar Terakhir\nFotokopi NIB (Nomor Induk Berusaha) / SIUP & TDP\nFotokopi NPWP Perusahaan / Yayasan\nFotokopi e-KTP Pengurus / Direksi yang berwenang menandatangani bilyet\nSurat Kuasa Direksi (jika dikuasakan)\nNominal penempatan minimal Rp 10.000.000" );
    $dep_syarat_lem_note = get_option( 'options_deposito_syarat_lem_note', 'Persyaratan khusus institusi syariah & penempatan nominal besar dapat dikonsultasikan langsung via tim Treasury.' );

    // Deposito: CTA & Brosur
    $dep_cta_kicker    = get_option( 'options_deposito_cta_kicker', 'Konsultasi Penempatan Deposito' );
    $dep_cta_title     = get_option( 'options_deposito_cta_title', 'Siap Mengoptimalkan Pertumbuhan Investasi Berkah Anda?' );
    $dep_cta_desc      = get_option( 'options_deposito_cta_desc', 'Hubungi staf treasury dan customer service kami untuk mendapatkan penawaran porsi nisbah terbaik bagi dana simpanan perorangan maupun korporasi.' );
    $dep_cta_btn       = get_option( 'options_deposito_cta_btn_text', 'Hubungi via WhatsApp' );
    $dep_cta_wa_msg    = get_option( 'options_deposito_cta_wa_msg', 'Halo BPRS Wakalumi, saya ingin berkonsultasi mengenai penempatan dana Deposito Mudharabah.' );
    $dep_brosur_url    = get_option( 'options_brosur_file_url', '' );

    // Deposito: Parameter Dasar
    $dep_akad          = get_option( 'options_deposito_akad', 'Mudharabah Muthlaqah' );
    $dep_min           = get_option( 'options_deposito_min_penempatan', 'Rp 5.000.000' );
    $dep_tenor         = get_option( 'options_deposito_tenor_list', '1 Bulan, 3 Bulan, 6 Bulan, 12 Bulan' );

    // Nisbah Data Terpadu (Tabungan & Deposito)
    $dep_nisbah_bulan  = wakalumi_get_nisbah_bulan();
    $dep_rates         = wakalumi_get_deposito_rates();
    $all_nisbah_data   = wakalumi_get_nisbah_data();

    $tab_nisbah_list   = [];
    $dep_nisbah_list   = [];
    foreach ( $all_nisbah_data as $nrow ) {
        if ( ( $nrow['nisbah_jenis'] ?? '' ) === 'tabungan' ) {
            $tab_nisbah_list[] = $nrow;
        } else {
            $dep_nisbah_list[] = $nrow;
        }
    }

    if ( empty( $tab_nisbah_list ) ) {
        $tab_nisbah_list = [
            [ 'nisbah_produk' => 'Tabungan Reguler', 'nisbah_nasabah' => '15', 'nisbah_bank' => '85', 'nisbah_equiv' => '1.49%' ],
            [ 'nisbah_produk' => 'Tabungan Ukhuwah', 'nisbah_nasabah' => '10', 'nisbah_bank' => '90', 'nisbah_equiv' => '1.00%' ],
        ];
    }
    if ( empty( $dep_nisbah_list ) ) {
        $dep_nisbah_list = [
            [ 'nisbah_produk' => 'Deposito 1 Bulan',  'nisbah_nasabah' => '30',   'nisbah_bank' => '70',   'nisbah_equiv' => '2.99%' ],
            [ 'nisbah_produk' => 'Deposito 3 Bulan',  'nisbah_nasabah' => '35',   'nisbah_bank' => '65',   'nisbah_equiv' => '3.48%' ],
            [ 'nisbah_produk' => 'Deposito 6 Bulan',  'nisbah_nasabah' => '40',   'nisbah_bank' => '60',   'nisbah_equiv' => '3.98%' ],
            [ 'nisbah_produk' => 'Deposito 12 Bulan', 'nisbah_nasabah' => '42.5', 'nisbah_bank' => '57.5', 'nisbah_equiv' => '4.23%' ],
        ];
    }

    // Hotline
    $default_wa        = get_option( 'options_contact_wa', '6281517380388' );
    $produk_wa         = get_option( 'options_produk_wa_number', $default_wa );
    $cta_title         = get_option( 'options_produk_cta_title', 'Mulai Langkah Finansial Berkah Bersama BPRS Wakalumi' );
    $cta_desc          = get_option( 'options_produk_cta_desc', 'Konsultasikan rencana simpanan dan investasi deposito Anda bersama staf profesional kami via WhatsApp.' );
    ?>

    <div class="wrap" style="max-width: 1120px; margin-top: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 4px;">
                    Pengelolaan Produk: Simpanan & Deposito
                </h1>
                <p style="color: #64748b; font-size: 13px; margin: 0;">
                    Kelola daftar produk <strong>Tabungan Syariah (Dinamis Repeater)</strong> serta <strong>Deposito Mudharabah</strong> secara terpadu.
                </p>
            </div>
            <div style="display: flex; gap: 8px;">
                <a href="<?php echo esc_url( home_url( '/produk/tabungan-syariah' ) ); ?>" target="_blank" class="button" style="display: inline-flex; align-items: center; gap: 6px;">
                    <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px;"></span> Buka Halaman Tabungan
                </a>
                <a href="<?php echo esc_url( home_url( '/produk/deposito-syariah' ) ); ?>" target="_blank" class="button" style="display: inline-flex; align-items: center; gap: 6px;">
                    <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px;"></span> Buka Halaman Deposito
                </a>
            </div>
        </div>

        <?php
        $is_tab_tabungan = ( $active_tab === 'tabungan' );
        $is_tab_deposito = ( $active_tab === 'deposito' );
        $is_tab_kontak   = ( $active_tab === 'kontak' );
        ?>

        <form method="post" action="" id="wkl-produk-form">
            <?php wp_nonce_field( 'wakalumi_produk_dana_nonce' ); ?>
            <input type="hidden" name="active_tab" id="wkl_active_tab" value="<?php echo esc_attr( $active_tab ); ?>">

            <!-- EARLY TAB SWITCHER FUNCTION (Guaranteed ready before click) -->
            <script>
            window.wklSwitchTab = function(tabId, el) {
                var tabBtns = document.querySelectorAll('.wkl-tab-btn');
                var tabContents = document.querySelectorAll('.wkl-tab-content');
                tabBtns.forEach(function(b) {
                    b.style.borderBottomColor = 'transparent';
                    b.style.color = '#64748b';
                    b.style.fontWeight = '600';
                    b.classList.remove('active');
                });
                if (el) {
                    el.style.borderBottomColor = '#088395';
                    el.style.color = '#088395';
                    el.style.fontWeight = '700';
                    el.classList.add('active');
                }
                tabContents.forEach(function(c) {
                    c.style.display = 'none';
                });
                var target = document.getElementById(tabId);
                if (target) {
                    target.style.display = 'block';
                }
                var activeInput = document.getElementById('wkl_active_tab');
                if (activeInput) {
                    activeInput.value = tabId.replace('tab-', '');
                }
                if (window.history && window.history.replaceState) {
                    var cleanTab = tabId.replace('tab-', '');
                    var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=wakalumi-produk-dana&tab=' + cleanTab;
                    window.history.replaceState(null, null, newUrl);
                }
                return false;
            };
            </script>

            <!-- NAVIGATION TABS -->
            <div style="display: flex; gap: 8px; border-bottom: 2px solid #e2e8f0; margin-bottom: 25px; flex-wrap: wrap;">
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-produk-dana&tab=tabungan' ) ); ?>" 
                   class="wkl-tab-btn <?php echo $is_tab_tabungan ? 'active' : ''; ?>" 
                   data-tab="tab-tabungan" 
                   onclick="return wklSwitchTab('tab-tabungan', this);"
                   style="display: inline-flex; align-items: center; gap: 6px; padding: 11px 22px; font-size: 14px; font-weight: <?php echo $is_tab_tabungan ? '700' : '600'; ?>; text-decoration: none; border: none; background: none; cursor: pointer; border-bottom: 3px solid <?php echo $is_tab_tabungan ? '#088395' : 'transparent'; ?>; color: <?php echo $is_tab_tabungan ? '#088395' : '#64748b'; ?>;">
                    💳 1. Kelola Produk Tabungan (Dinamis)
                </a>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-produk-dana&tab=deposito' ) ); ?>" 
                   class="wkl-tab-btn <?php echo $is_tab_deposito ? 'active' : ''; ?>" 
                   data-tab="tab-deposito" 
                   onclick="return wklSwitchTab('tab-deposito', this);"
                   style="display: inline-flex; align-items: center; gap: 6px; padding: 11px 22px; font-size: 14px; font-weight: <?php echo $is_tab_deposito ? '700' : '600'; ?>; text-decoration: none; border: none; background: none; cursor: pointer; border-bottom: 3px solid <?php echo $is_tab_deposito ? '#088395' : 'transparent'; ?>; color: <?php echo $is_tab_deposito ? '#088395' : '#64748b'; ?>;">
                    📈 2. Deposito Mudharabah, Nisbah &amp; CTA
                </a>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=wakalumi-produk-dana&tab=kontak' ) ); ?>" 
                   class="wkl-tab-btn <?php echo $is_tab_kontak ? 'active' : ''; ?>" 
                   data-tab="tab-kontak" 
                   onclick="return wklSwitchTab('tab-kontak', this);"
                   style="display: inline-flex; align-items: center; gap: 6px; padding: 11px 22px; font-size: 14px; font-weight: <?php echo $is_tab_kontak ? '700' : '600'; ?>; text-decoration: none; border: none; background: none; cursor: pointer; border-bottom: 3px solid <?php echo $is_tab_kontak ? '#088395' : 'transparent'; ?>; color: <?php echo $is_tab_kontak ? '#088395' : '#64748b'; ?>;">
                    📞 3. Hotline WhatsApp
                </a>
            </div>

            <!-- ========================================================
                 TAB 1: TABUNGAN SYARIAH (REPEATER DINAMIS)
                 ======================================================== -->
            <div id="tab-tabungan" class="wkl-tab-content" style="display: <?php echo $is_tab_tabungan ? 'block' : 'none'; ?>;">
                <!-- 1. Header Banner & Kartu Penjaminan LPS Tabungan -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        1. Header Banner &amp; Kartu Penjaminan LPS (Tabungan Syariah)
                    </h2>
                    <table class="form-table" style="margin: 0 0 20px 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_tabungan_page_badge">Kicker / Badge Atas</label></th>
                            <td><input type="text" id="options_tabungan_page_badge" name="options_tabungan_page_badge" value="<?php echo esc_attr( $tab_page_badge ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_page_title">Judul Utama Halaman</label></th>
                            <td><input type="text" id="options_tabungan_page_title" name="options_tabungan_page_title" value="<?php echo esc_attr( $tab_page_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_page_subtitle">Subtitle / Deskripsi</label></th>
                            <td><textarea id="options_tabungan_page_subtitle" name="options_tabungan_page_subtitle" rows="3" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $tab_page_sub ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_quote">Teks Kutipan Syariah (Quote Box)</label></th>
                            <td><textarea id="options_tabungan_quote" name="options_tabungan_quote" rows="2" class="large-text" style="width: 100%; max-width: 650px; font-style: italic;"><?php echo esc_textarea( $tab_quote ); ?></textarea></td>
                        </tr>
                    </table>

                    <!-- Sub-Card: Kartu LPS Kanan Header Tabungan -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #088395; border-radius: 10px; padding: 16px 20px;">
                        <h4 style="margin: 0 0 12px 0; font-size: 14px; font-weight: 700; color: #0f172a;">
                            Sub-Elemen: Kartu Penjaminan LPS (Kolom Kanan Header)
                        </h4>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Badge Penjaminan</label>
                                <input type="text" name="options_tabungan_lps_tag" value="<?php echo esc_attr( $tab_lps_tag ); ?>" class="regular-text" style="width: 100%;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Judul Kartu LPS</label>
                                <input type="text" name="options_tabungan_lps_title" value="<?php echo esc_attr( $tab_lps_title ); ?>" class="regular-text" style="width: 100%; font-weight: bold;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Deskripsi Jaminan LPS</label>
                                <textarea name="options_tabungan_lps_desc" rows="2" style="width: 100%;"><?php echo esc_textarea( $tab_lps_desc ); ?></textarea>
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Teks Tombol Aksi Tautan</label>
                                <input type="text" name="options_tabungan_lps_btn_text" value="<?php echo esc_attr( $tab_lps_btn ); ?>" class="regular-text" style="width: 100%;">
                                <span style="font-size: 11px; color: #64748b;">Mengarahkan langsung ke kalkulator rencana menabung.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Box Dinamis -->
                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <span style="font-size: 13px; font-weight: 700; color: #166534;">
                            ✨ Daftar Produk Tabungan (Dinamis):
                        </span>
                        <p style="margin: 4px 0 0 0; color: #15803d; font-size: 12px;">
                            Anda dapat menambah produk baru (seperti <em>Tabungan Ukhuwah Berhadiah</em>), mengubah nama, memindahkan urutan, atau menghapus produk sesuai kebutuhan.
                        </p>
                    </div>
                    <button type="button" id="btn-add-tabungan" class="button button-primary" style="background: #088395; border-color: #066e7d; font-weight: bold; display: inline-flex; align-items: center; gap: 5px;">
                        <span style="font-size: 16px; line-height: 1;">+</span> Tambah Produk Tabungan Baru
                    </button>
                </div>

                <!-- REPEATER CONTAINER -->
                <div id="tabungan-repeater-list" style="display: flex; flex-direction: column; gap: 20px; margin-bottom: 25px;">
                    <?php 
                    $color_options = [
                        'teal'   => '🟢 Teal / Toska (Wakalumi Utama)',
                        'blue'   => '🔵 Blue / Biru (Pendidikan & Pelajar)',
                        'amber'  => '🟡 Amber / Emas (Haji & Ibadah)',
                        'purple' => '🟣 Purple / Ungu (Ukhuwah & Hadiah)',
                        'emerald'=> '🌱 Emerald / Hijau Zamrud (Investasi Syariah)',
                        'indigo' => '🔷 Indigo / Biru Gelap (Institusi & Bisnis)',
                        'cyan'   => '🌊 Cyan / Biru Bahari (Muda & Segar)',
                        'rose'   => '🔴 Rose / Merah Muda (Keluarga & Usaha)',
                        'orange' => '🟠 Orange / Jingga (Pedagang & UMKM)',
                        'slate'  => '⚪ Slate / Abu Monokrom (Netral Elegan)',
                    ];

                    foreach ( $tabungan_list as $index => $prod ) : 
                        $prod_color = $prod['color'] ?? 'teal';
                    ?>
                        <div class="tabungan-card-item" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); position: relative;">
                            <!-- Header Card Item -->
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span class="wkl-item-num" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 50%; background: #088395; color: #fff; font-weight: bold; font-size: 12px;">
                                        <?php echo ( $index + 1 ); ?>
                                    </span>
                                    <strong style="font-size: 15px; color: #0f172a;" class="wkl-card-title-preview">
                                        <?php echo esc_html( $prod['nama'] ?? 'Produk Baru' ); ?>
                                    </strong>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="font-size: 12px; color: #64748b;">Urutan:</span>
                                    <input type="number" name="tab_urutan[]" value="<?php echo esc_attr( $prod['urutan'] ?? ($index + 1) ); ?>" style="width: 60px; height: 30px;" min="1">
                                    <button type="button" class="button wkl-btn-remove-tabungan" style="color: #ef4444; border-color: #fca5a5;">
                                        🗑️ Hapus
                                    </button>
                                </div>
                            </div>

                            <!-- Fields Grid -->
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px; margin-bottom: 15px;">
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Nama Produk Tabungan *</label>
                                    <input type="text" name="tab_nama[]" value="<?php echo esc_attr( $prod['nama'] ?? '' ); ?>" class="regular-text wkl-tab-name-input" style="width: 100%;" required>
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Slug / ID Anchor (#hash untuk tautan) *</label>
                                    <input type="text" name="tab_slug[]" value="<?php echo esc_attr( $prod['slug'] ?? '' ); ?>" class="regular-text" style="width: 100%;" placeholder="misal: ukhuwah, tawakal">
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Tagline Produk</label>
                                    <input type="text" name="tab_tagline[]" value="<?php echo esc_attr( $prod['tagline'] ?? '' ); ?>" class="regular-text" style="width: 100%;">
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Badge / Kategori Sasaran</label>
                                    <input type="text" name="tab_badge[]" value="<?php echo esc_attr( $prod['badge'] ?? 'Umum' ); ?>" class="regular-text" style="width: 100%;" placeholder="misal: Program Berhadiah, Pelajar">
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Tema Warna Kartu</label>
                                    <select name="tab_color[]" style="width: 100%;">
                                        <?php foreach ( $color_options as $c_val => $c_label ) : ?>
                                            <option value="<?php echo esc_attr( $c_val ); ?>" <?php selected( $prod_color, $c_val ); ?>>
                                                <?php echo esc_html( $c_label ); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Ikon Kartu Produk</label>
                                    <select name="tab_icon[]" style="width: 100%;">
                                        <?php $p_icon = $prod['icon'] ?? ($prod['slug'] ?? 'tawakal'); ?>
                                        <option value="tawakal" <?php selected( $p_icon, 'tawakal' ); ?>>👛 Dompet / Simpanan Umum</option>
                                        <option value="pendidikan" <?php selected( $p_icon, 'pendidikan' ); ?>>🎓 Pendidikan / Topi Wisuda</option>
                                        <option value="haji-umroh" <?php selected( $p_icon, 'haji-umroh' ); ?>>🕌 Haji &amp; Umroh / Ka'bah</option>
                                        <option value="ukhuwah" <?php selected( $p_icon, 'ukhuwah' ); ?>>🎁 Kado / Berhadiah</option>
                                        <option value="business" <?php selected( $p_icon, 'business' ); ?>>🏢 Bisnis &amp; Institusi</option>
                                        <option value="coins" <?php selected( $p_icon, 'coins' ); ?>>🪙 Koin / Investasi</option>
                                        <option value="shield" <?php selected( $p_icon, 'shield' ); ?>>🛡️ Perisai / Amanah LPS</option>
                                    </select>
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Akad Syariah</label>
                                    <input type="text" name="tab_akad[]" value="<?php echo esc_attr( $prod['akad'] ?? 'Mudharabah Muthlaqah' ); ?>" class="regular-text" style="width: 100%;">
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Setoran Awal Minimum</label>
                                    <input type="text" name="tab_min_setor[]" value="<?php echo esc_attr( $prod['min_setor'] ?? 'Rp 50.000' ); ?>" class="regular-text" style="width: 100%;">
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Biaya Administrasi Bulanan</label>
                                    <input type="text" name="tab_biaya_admin[]" value="<?php echo esc_attr( $prod['biaya_admin'] ?? 'Gratis / Bebas Biaya Bulanan' ); ?>" class="regular-text" style="width: 100%;" placeholder="misal: Gratis / Bebas Biaya Bulanan atau Rp 0">
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Ketentuan Penarikan (Tabel Komparasi)</label>
                                    <input type="text" name="tab_penarikan[]" value="<?php echo esc_attr( $prod['penarikan'] ?? '' ); ?>" class="regular-text" style="width: 100%;" placeholder="misal: Fleksibel: Kapan pun pada jam operasional kantor">
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Pesan WhatsApp Kustom (Opsional)</label>
                                    <input type="text" name="tab_wa_text[]" value="<?php echo esc_attr( $prod['wa_text'] ?? '' ); ?>" class="regular-text" style="width: 100%;" placeholder="Pesan otomatis saat klik Buka Rekening">
                                </div>

                                <div style="grid-column: 1 / -1;" class="wkl-img-field-wrap">
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">
                                        Gambar Banner / Kartu Produk (Opsional - Rekomendasi Rasio Standar 16:10 / 800x500px)
                                    </label>
                                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                                        <input type="text" name="tab_image[]" value="<?php echo esc_attr( $prod['image'] ?? '' ); ?>" class="regular-text" style="flex: 1; min-width: 250px;" placeholder="https://... atau klik Unggah Gambar">
                                        <button type="button" class="button wkl-upload-tab-img-btn" style="display: inline-flex; align-items: center; gap: 5px;">
                                            <span class="dashicons dashicons-format-image" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah Gambar
                                        </button>
                                        <button type="button" class="button button-link-delete wkl-remove-tab-img-btn" style="color: #ef4444; <?php echo empty( $prod['image'] ) ? 'display:none;' : ''; ?>">
                                            ✕ Hapus
                                        </button>
                                    </div>
                                    <div class="wkl-img-preview-box" style="margin-top: 8px;">
                                        <img class="wkl-img-preview" src="<?php echo esc_url( $prod['image'] ?? '' ); ?>" style="height: 65px; border-radius: 6px; border: 1px solid #cbd5e1; object-fit: cover; <?php echo empty( $prod['image'] ) ? 'display:none;' : ''; ?>" alt="Preview Produk">
                                    </div>
                                    <p class="description" style="font-size: 11px; margin-top: 4px; color: #64748b;">Jika gambar diisi, kartu di beranda dan halaman tabungan akan menampilkan grafis produk dengan rasio standar 16:10 (800x500px) menggantikan ikon default.</p>
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div style="margin-bottom: 15px;">
                                <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Deskripsi Produk</label>
                                <textarea name="tab_desc[]" rows="2" style="width: 100%;"><?php echo esc_textarea( $prod['desc'] ?? '' ); ?></textarea>
                            </div>

                            <!-- Keunggulan & Syarat -->
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 15px;">
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">
                                        Poin Keunggulan <small style="font-weight: normal; color: #64748b;">(1 baris per poin)</small>
                                    </label>
                                    <textarea name="tab_keunggulan[]" rows="4" style="width: 100%; font-family: monospace; font-size: 12px;"><?php echo esc_textarea( $prod['keunggulan'] ?? '' ); ?></textarea>
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">
                                        Dokumen Persyaratan <small style="font-weight: normal; color: #64748b;">(1 baris per syarat)</small>
                                    </label>
                                    <textarea name="tab_syarat[]" rows="4" style="width: 100%; font-family: monospace; font-size: 12px;"><?php echo esc_textarea( $prod['syarat'] ?? '' ); ?></textarea>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- 3. Tabel Komparasi Fitur Tabungan -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        3. Tabel Komparasi Fitur Tabungan
                    </h2>
                    <table class="form-table" style="margin: 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_tabungan_komparasi_kicker">Kicker / Badge Tabel</label></th>
                            <td><input type="text" id="options_tabungan_komparasi_kicker" name="options_tabungan_komparasi_kicker" value="<?php echo esc_attr( $tab_komp_kicker ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_komparasi_title">Judul Utama Tabel</label></th>
                            <td><input type="text" id="options_tabungan_komparasi_title" name="options_tabungan_komparasi_title" value="<?php echo esc_attr( $tab_komp_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_komparasi_desc">Deskripsi Tabel</label></th>
                            <td><textarea id="options_tabungan_komparasi_desc" name="options_tabungan_komparasi_desc" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $tab_komp_desc ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_komparasi_lps_note">Catatan Penjaminan LPS di Tabel</label></th>
                            <td><input type="text" id="options_tabungan_komparasi_lps_note" name="options_tabungan_komparasi_lps_note" value="<?php echo esc_attr( $tab_komp_lps ); ?>" class="regular-text" style="width: 100%; max-width: 650px;"></td>
                        </tr>
                    </table>
                </div>

                <!-- 4. 4 Keunggulan Menabung di BPRS Wakalumi -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        4. Keunggulan Simpanan Syariah (4 Kartu Eksekutif)
                    </h2>
                    <table class="form-table" style="margin: 0 0 20px 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_tabungan_keung_kicker">Kicker Section</label></th>
                            <td><input type="text" id="options_tabungan_keung_kicker" name="options_tabungan_keung_kicker" value="<?php echo esc_attr( $tab_keung_kicker ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_keung_title">Judul Section Keunggulan</label></th>
                            <td><input type="text" id="options_tabungan_keung_title" name="options_tabungan_keung_title" value="<?php echo esc_attr( $tab_keung_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_keung_desc">Deskripsi Singkat</label></th>
                            <td><textarea id="options_tabungan_keung_desc" name="options_tabungan_keung_desc" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $tab_keung_desc ); ?></textarea></td>
                        </tr>
                    </table>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
                        <!-- Keunggulan 1 -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-top: 3px solid #088395; border-radius: 10px; padding: 16px;">
                            <span style="font-size: 11px; font-weight: 800; color: #088395; text-transform: uppercase; display: block; margin-bottom: 8px;">Kartu 01</span>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Judul Poin 1</label>
                                <input type="text" name="options_tabungan_keung_1_title" value="<?php echo esc_attr( $tab_keung_1_title ); ?>" class="regular-text" style="width: 100%; font-weight: bold;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Ulasan Poin 1</label>
                                <textarea name="options_tabungan_keung_1_desc" rows="3" style="width: 100%; font-size: 12px;"><?php echo esc_textarea( $tab_keung_1_desc ); ?></textarea>
                            </div>
                        </div>

                        <!-- Keunggulan 2 -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-top: 3px solid #2563eb; border-radius: 10px; padding: 16px;">
                            <span style="font-size: 11px; font-weight: 800; color: #2563eb; text-transform: uppercase; display: block; margin-bottom: 8px;">Kartu 02</span>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Judul Poin 2</label>
                                <input type="text" name="options_tabungan_keung_2_title" value="<?php echo esc_attr( $tab_keung_2_title ); ?>" class="regular-text" style="width: 100%; font-weight: bold;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Ulasan Poin 2</label>
                                <textarea name="options_tabungan_keung_2_desc" rows="3" style="width: 100%; font-size: 12px;"><?php echo esc_textarea( $tab_keung_2_desc ); ?></textarea>
                            </div>
                        </div>

                        <!-- Keunggulan 3 -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-top: 3px solid #d97706; border-radius: 10px; padding: 16px;">
                            <span style="font-size: 11px; font-weight: 800; color: #d97706; text-transform: uppercase; display: block; margin-bottom: 8px;">Kartu 03</span>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Judul Poin 3</label>
                                <input type="text" name="options_tabungan_keung_3_title" value="<?php echo esc_attr( $tab_keung_3_title ); ?>" class="regular-text" style="width: 100%; font-weight: bold;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Ulasan Poin 3</label>
                                <textarea name="options_tabungan_keung_3_desc" rows="3" style="width: 100%; font-size: 12px;"><?php echo esc_textarea( $tab_keung_3_desc ); ?></textarea>
                            </div>
                        </div>

                        <!-- Keunggulan 4 -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-top: 3px solid #059669; border-radius: 10px; padding: 16px;">
                            <span style="font-size: 11px; font-weight: 800; color: #059669; text-transform: uppercase; display: block; margin-bottom: 8px;">Kartu 04</span>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Judul Poin 4</label>
                                <input type="text" name="options_tabungan_keung_4_title" value="<?php echo esc_attr( $tab_keung_4_title ); ?>" class="regular-text" style="width: 100%; font-weight: bold;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Ulasan Poin 4</label>
                                <textarea name="options_tabungan_keung_4_desc" rows="3" style="width: 100%; font-size: 12px;"><?php echo esc_textarea( $tab_keung_4_desc ); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. Kalkulator Simulasi Tabungan -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        5. Kalkulator Simulasi Rencana Menabung
                    </h2>
                    <table class="form-table" style="margin: 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_tabungan_calc_badge">Badge / Kicker Atas</label></th>
                            <td><input type="text" id="options_tabungan_calc_badge" name="options_tabungan_calc_badge" value="<?php echo esc_attr( $tab_calc_badge ); ?>" class="regular-text" style="width: 100%; max-width: 450px;" placeholder="misal: Simulasi Finansial Syariah"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_calc_title">Judul Utama Kalkulator</label></th>
                            <td><input type="text" id="options_tabungan_calc_title" name="options_tabungan_calc_title" value="<?php echo esc_attr( $tab_calc_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_calc_subtitle">Deskripsi / Subtitle</label></th>
                            <td><textarea id="options_tabungan_calc_subtitle" name="options_tabungan_calc_subtitle" rows="3" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $tab_calc_sub ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_calc_target_min">Target Minimum Simulasi (Rp)</label></th>
                            <td>
                                <input type="number" id="options_tabungan_calc_target_min" name="options_tabungan_calc_target_min" value="<?php echo esc_attr( $tab_calc_min ); ?>" class="regular-text" style="width: 200px;" step="100000">
                                <span class="description" style="margin-left: 8px;">Default: <code>2000000</code> (Rp 2 Juta).</span>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_calc_target_max">Target Maksimum Simulasi (Rp)</label></th>
                            <td>
                                <input type="number" id="options_tabungan_calc_target_max" name="options_tabungan_calc_target_max" value="<?php echo esc_attr( $tab_calc_max ); ?>" class="regular-text" style="width: 200px;" step="1000000">
                                <span class="description" style="margin-left: 8px;">Default: <code>100000000</code> (Rp 100 Juta).</span>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_calc_target_default">Target Default Awal (Rp)</label></th>
                            <td>
                                <input type="number" id="options_tabungan_calc_target_default" name="options_tabungan_calc_target_default" value="<?php echo esc_attr( $tab_calc_default ); ?>" class="regular-text" style="width: 200px;" step="1000000">
                                <span class="description" style="margin-left: 8px;">Default: <code>25000000</code> (Rp 25 Juta - Porsi Haji).</span>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_calc_note">Catatan Kaki Simulasi</label></th>
                            <td><textarea id="options_tabungan_calc_note" name="options_tabungan_calc_note" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $tab_calc_note ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_calc_btn_text">Teks Tombol Aksi WhatsApp</label></th>
                            <td><input type="text" id="options_tabungan_calc_btn_text" name="options_tabungan_calc_btn_text" value="<?php echo esc_attr( $tab_calc_btn ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                    </table>

                    <!-- Sub-Section: Shortcut / Preset Target Simulasi -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px 20px; margin-top: 20px;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; flex-wrap: wrap; gap: 10px;">
                            <div>
                                <h4 style="margin: 0; font-size: 14px; font-weight: 700; color: #0f172a;">
                                    Tombol Shortcut / Preset Target Dana (Pills)
                                </h4>
                                <p style="margin: 2px 0 0 0; font-size: 12px; color: #64748b;">
                                    Tombol cepat di bawah slider target dana (contoh: Haji, Umroh, Pendidikan). Anda dapat menambah, mengubah nominal, tenor, dan produk rekomendasi.
                                </p>
                            </div>
                            <button type="button" id="btn-add-calc-preset" class="button" style="background: #088395; color: #fff; border-color: #066e7d; font-weight: 600;">
                                + Tambah Shortcut Baru
                            </button>
                        </div>

                        <div id="tabungan-calc-presets-list" style="display: flex; flex-direction: column; gap: 12px;">
                            <?php foreach ( $tab_calc_presets as $p_idx => $preset ) : ?>
                                <div class="tabungan-preset-item" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 14px; display: grid; grid-template-columns: 2fr 1.5fr 1fr 2fr auto; gap: 12px; align-items: center;">
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Label Tombol *</label>
                                        <input type="text" name="calc_preset_label[]" value="<?php echo esc_attr( $preset['label'] ?? '' ); ?>" class="regular-text" style="width: 100%; font-weight: 600;" placeholder="misal: Rp 25 Jt (Porsi Haji)" required>
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Target Nominal (Rp) *</label>
                                        <input type="number" name="calc_preset_nominal[]" value="<?php echo esc_attr( $preset['nominal'] ?? '' ); ?>" class="regular-text" style="width: 100%;" placeholder="25000000" step="100000" required>
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Tenor (Bulan)</label>
                                        <input type="number" name="calc_preset_tenor[]" value="<?php echo esc_attr( $preset['tenor'] ?? '' ); ?>" class="regular-text" style="width: 100%;" placeholder="36" min="6" max="60" step="6">
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Pilih Produk Rekomendasi</label>
                                        <select name="calc_preset_prod[]" style="width: 100%;">
                                            <option value="">-- Tetap Sesuai Pilihan Nasabah --</option>
                                            <?php foreach ( $tabungan_list as $prod_opt ) : ?>
                                                <option value="<?php echo esc_attr( $prod_opt['nama'] ); ?>" <?php selected( $preset['prod'] ?? '', $prod_opt['nama'] ); ?>>
                                                    <?php echo esc_html( $prod_opt['nama'] ); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div style="padding-top: 18px;">
                                        <button type="button" class="button wkl-btn-remove-preset" style="color: #ef4444; border-color: #fca5a5;" title="Hapus shortcut">
                                            ✕
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- 6. Tanya Jawab (FAQ / QnA) Tabungan -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; flex-wrap: wrap; gap: 10px;">
                        <div>
                            <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin: 0 0 4px 0;">
                                6. Tanya Jawab (FAQ / QnA) Tabungan Syariah
                            </h2>
                            <p style="margin: 0; font-size: 12px; color: #64748b;">
                                Kelola daftar pertanyaan &amp; jawaban umum yang ditampilkan pada halaman Tabungan Syariah.
                            </p>
                        </div>
                        <button type="button" id="btn-add-faq" class="button" style="background: #0f766e; color: #fff; border-color: #0d9488; font-weight: bold;">
                            + Tambah Tanya Jawab Baru
                        </button>
                    </div>

                    <table class="form-table" style="margin-bottom: 20px;">
                        <tr>
                            <th style="width: 230px;"><label for="options_tabungan_faq_badge">Badge / Label FAQ</label></th>
                            <td><input type="text" id="options_tabungan_faq_badge" name="options_tabungan_faq_badge" value="<?php echo esc_attr( $tab_faq_badge ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_faq_title">Judul Bagian FAQ</label></th>
                            <td><input type="text" id="options_tabungan_faq_title" name="options_tabungan_faq_title" value="<?php echo esc_attr( $tab_faq_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_faq_subtitle">Deskripsi Singkat FAQ</label></th>
                            <td><textarea id="options_tabungan_faq_subtitle" name="options_tabungan_faq_subtitle" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $tab_faq_sub ); ?></textarea></td>
                        </tr>
                    </table>

                    <!-- FAQ Repeater List -->
                    <div id="tabungan-faq-list" style="display: flex; flex-direction: column; gap: 15px;">
                        <?php foreach ( $tab_faq_list as $f_idx => $faq ) : ?>
                            <div class="tabungan-faq-item" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px;">
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                                    <strong style="color: #0f172a; font-size: 13px;">
                                        Q#<span class="wkl-faq-num"><?php echo ( $f_idx + 1 ); ?></span>
                                    </strong>
                                    <button type="button" class="button-link wkl-btn-remove-faq" style="color: #ef4444; font-size: 12px; text-decoration: none;">
                                        Hapus Pertanyaan
                                    </button>
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 3px;">Pertanyaan</label>
                                    <input type="text" name="tab_faq_q[]" value="<?php echo esc_attr( $faq['q'] ?? '' ); ?>" class="regular-text" style="width: 100%; font-weight: 600;" placeholder="Tuliskan pertanyaan...">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 3px;">Jawaban</label>
                                    <textarea name="tab_faq_a[]" rows="3" style="width: 100%;" placeholder="Tuliskan jawaban yang informatif..."><?php echo esc_textarea( $faq['a'] ?? '' ); ?></textarea>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- 7. Box Brosur PDF & Box Promo Deposito -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        7. Box Brosur PDF &amp; Box Promo Deposito Mudharabah
                    </h2>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <!-- Kolom Kiri: Box Brosur -->
                        <div style="background: #f0fdfa; border: 1px solid #ccfbf1; border-radius: 10px; padding: 16px;">
                            <h4 style="margin: 0 0 12px 0; font-size: 13px; font-weight: 700; color: #0f766e;">
                                Box Unduh Brosur Resmi (Terintegrasi Pusat)
                            </h4>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Kicker / Tag</label>
                                <input type="text" name="options_tabungan_brosur_kicker" value="<?php echo esc_attr( $tab_brosur_kicker ); ?>" class="regular-text" style="width: 100%;">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Judul Box</label>
                                <input type="text" name="options_tabungan_brosur_title" value="<?php echo esc_attr( $tab_brosur_title ); ?>" class="regular-text" style="width: 100%; font-weight: bold;">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Deskripsi</label>
                                <textarea name="options_tabungan_brosur_desc" rows="2" style="width: 100%;"><?php echo esc_textarea( $tab_brosur_desc ); ?></textarea>
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Teks Tombol Unduh</label>
                                <input type="text" name="options_tabungan_brosur_btn" value="<?php echo esc_attr( $tab_brosur_btn ); ?>" class="regular-text" style="width: 100%;">
                                <span style="font-size: 11px; color: #64748b;">Menggunakan tautan berkas brosur PDF resmi yang tersimpan di sistem.</span>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Box Promo Deposito -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px;">
                            <h4 style="margin: 0 0 12px 0; font-size: 13px; font-weight: 700; color: #0f172a;">
                                Box Pintasan Deposito Mudharabah
                            </h4>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Kicker / Tag</label>
                                <input type="text" name="options_tabungan_dep_kicker" value="<?php echo esc_attr( $tab_dep_kicker ); ?>" class="regular-text" style="width: 100%;">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Judul Box</label>
                                <input type="text" name="options_tabungan_dep_title" value="<?php echo esc_attr( $tab_dep_title ); ?>" class="regular-text" style="width: 100%; font-weight: bold;">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Deskripsi</label>
                                <textarea name="options_tabungan_dep_desc" rows="2" style="width: 100%;"><?php echo esc_textarea( $tab_dep_desc ); ?></textarea>
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Teks Tautan</label>
                                <input type="text" name="options_tabungan_dep_btn" value="<?php echo esc_attr( $tab_dep_btn ); ?>" class="regular-text" style="width: 100%;">
                                <span style="font-size: 11px; color: #64748b;">Mengarahkan pengunjung langsung ke halaman Deposito Syariah.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 8. Realisasi Nisbah Bagi Hasil Tabungan (Tersinkronisasi ke Beranda) -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; flex-wrap: gap; gap: 10px;">
                        <div>
                            <h3 style="font-size: 16px; font-weight: 800; color: #0f172a; margin: 0 0 4px 0;">
                                8. Realisasi Nisbah Bagi Hasil Tabungan
                            </h3>
                            <p style="margin: 0; font-size: 12px; color: #64748b;">
                                Daftar produk tabungan dengan porsi bagi hasil dan indikasi equivalent rate ini otomatis tampil pada <strong>Kartu Realisasi Nisbah di Halaman Beranda</strong>.
                            </p>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <label for="options_nisbah_bulan_tab" style="font-size: 12px; font-weight: bold; color: #334155;">Periode Bulan:</label>
                            <input type="text" id="options_nisbah_bulan_tab" name="options_nisbah_bulan" value="<?php echo esc_attr( $dep_nisbah_bulan ); ?>" class="regular-text" style="width: 150px; font-weight: bold; padding: 4px 8px;" placeholder="Agustus 2026">
                        </div>
                    </div>

                    <table id="tab-nisbah-table" class="widefat striped" style="border-radius: 8px; overflow: hidden; margin-bottom: 16px;">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="font-weight: 700; padding: 10px 14px;">Nama Produk Tabungan</th>
                                <th style="font-weight: 700; width: 140px; padding: 10px 14px;">Porsi Nasabah (%)</th>
                                <th style="font-weight: 700; width: 140px; padding: 10px 14px;">Porsi Bank (%)</th>
                                <th style="font-weight: 700; width: 180px; padding: 10px 14px;">Indikasi Eqv. Rate (% p.a.)</th>
                                <th style="font-weight: 700; width: 80px; text-align: center; padding: 10px 14px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tab-nisbah-tbody">
                            <?php foreach ( $tab_nisbah_list as $tni => $tnrow ) : ?>
                                <tr class="tab-nisbah-row">
                                    <td style="padding: 10px 14px;">
                                        <input type="text" name="tab_nisbah_produk[]" value="<?php echo esc_attr( $tnrow['nisbah_produk'] ?? '' ); ?>" class="regular-text" style="width: 100%; font-weight: 600;" placeholder="contoh: Tabungan Reguler" required>
                                    </td>
                                    <td style="padding: 10px 14px;">
                                        <input type="text" name="tab_nisbah_nasabah[]" value="<?php echo esc_attr( $tnrow['nisbah_nasabah'] ?? '' ); ?>" style="width: 90px; text-align: center; font-weight: bold;" required> %
                                    </td>
                                    <td style="padding: 10px 14px;">
                                        <input type="text" name="tab_nisbah_bank[]" value="<?php echo esc_attr( $tnrow['nisbah_bank'] ?? '' ); ?>" style="width: 90px; text-align: center; font-weight: bold;" required> %
                                    </td>
                                    <td style="padding: 10px 14px;">
                                        <input type="text" name="tab_nisbah_equiv[]" value="<?php echo esc_attr( $tnrow['nisbah_equiv'] ?? '' ); ?>" style="width: 120px; font-weight: bold; color: #059669;" placeholder="contoh: 1.49%" required>
                                    </td>
                                    <td style="padding: 10px 14px; text-align: center;">
                                        <button type="button" class="button button-link-delete wkl-remove-tab-nisbah" style="color: #ef4444;" title="Hapus Baris">✕ Hapus</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <button type="button" id="btn-add-tab-nisbah" class="button" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> + Tambah Produk Nisbah Tabungan
                    </button>
                </div>

                <!-- 9. Banner CTA Konsultasi Tabungan & Hotline WhatsApp -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        9. Banner CTA Konsultasi Tabungan &amp; Hotline WhatsApp
                    </h2>
                    <table class="form-table" style="margin: 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_tabungan_cta_kicker">Kicker Banner</label></th>
                            <td><input type="text" id="options_tabungan_cta_kicker" name="options_tabungan_cta_kicker" value="<?php echo esc_attr( $tab_cta_kicker ); ?>" class="regular-text" style="width: 100%; max-width: 450px;" placeholder="Konsultasi Tabungan Syariah"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_cta_title">Judul Banner CTA</label></th>
                            <td><input type="text" id="options_tabungan_cta_title" name="options_tabungan_cta_title" value="<?php echo esc_attr( $tab_cta_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;" placeholder="Mulai Rencanakan Masa Depan Finansial Syariah Anda"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_cta_desc">Deskripsi Banner CTA</label></th>
                            <td><textarea id="options_tabungan_cta_desc" name="options_tabungan_cta_desc" rows="3" class="large-text" style="width: 100%; max-width: 650px;" placeholder="Buka rekening tabungan syariah tanpa biaya administrasi bulanan..."><?php echo esc_textarea( $tab_cta_desc ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_cta_btn_text">Teks Tombol WhatsApp</label></th>
                            <td><input type="text" id="options_tabungan_cta_btn_text" name="options_tabungan_cta_btn_text" value="<?php echo esc_attr( $tab_cta_btn ); ?>" class="regular-text" style="width: 100%; max-width: 350px;" placeholder="Buka Tabungan via WhatsApp"></td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_cta_wa_msg">Template Pesan WhatsApp</label></th>
                            <td><textarea id="options_tabungan_cta_wa_msg" name="options_tabungan_cta_wa_msg" rows="2" class="large-text" style="width: 100%; max-width: 650px;" placeholder="Halo BPRS Wakalumi, saya ingin membuka rekening tabungan syariah..."><?php echo esc_textarea( $tab_cta_wa_msg ); ?></textarea></td>
                        </tr>
                    </table>
                </div>

                <!-- Tombol Simpan Cepat Tabungan -->
                <div style="margin: 20px 0 10px 0; padding: 15px 0; border-top: 1px solid #e2e8f0; display: flex; align-items: center; gap: 15px;">
                    <button type="submit" name="wakalumi_save_produk_dana" class="button button-primary button-hero" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 30px;">
                        Simpan Pengaturan Tabungan &amp; CTA
                    </button>
                    <span style="color: #64748b; font-size: 13px;">Perubahan pada Tabungan Syariah dan Banner CTA akan langsung disimpan.</span>
                </div>
            </div>

            <!-- ========================================================
                 TAB 2: DEPOSITO MUDHARABAH & NISBAH
                 ======================================================== -->
            <div id="tab-deposito" class="wkl-tab-content" style="display: <?php echo $is_tab_deposito ? 'block' : 'none'; ?>;">
                
                <!-- 1. Header Banner & Kartu Penjaminan LPS -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        1. Header Banner &amp; Kartu Penjaminan LPS
                    </h2>
                    <table class="form-table" style="margin: 0 0 20px 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_deposito_page_badge">Kicker / Badge Atas</label></th>
                            <td><input type="text" id="options_deposito_page_badge" name="options_deposito_page_badge" value="<?php echo esc_attr( $dep_page_badge ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_page_title">Judul Utama Halaman</label></th>
                            <td><input type="text" id="options_deposito_page_title" name="options_deposito_page_title" value="<?php echo esc_attr( $dep_page_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_page_subtitle">Subtitle / Deskripsi</label></th>
                            <td><textarea id="options_deposito_page_subtitle" name="options_deposito_page_subtitle" rows="3" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $dep_page_sub ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_quote">Teks Kutipan Resmi Deposito</label></th>
                            <td><textarea id="options_deposito_quote" name="options_deposito_quote" rows="3" class="large-text" style="width: 100%; max-width: 650px; font-style: italic;"><?php echo esc_textarea( $dep_quote ); ?></textarea></td>
                        </tr>
                    </table>

                    <!-- Sub-Card: Kartu LPS Kanan Header -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #088395; border-radius: 10px; padding: 16px 20px;">
                        <h4 style="margin: 0 0 12px 0; font-size: 14px; font-weight: 700; color: #0f172a;">
                            Sub-Elemen: Kartu Penjaminan LPS (Kolom Kanan Header)
                        </h4>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Badge Penjaminan</label>
                                <input type="text" name="options_deposito_lps_tag" value="<?php echo esc_attr( $dep_lps_tag ); ?>" class="regular-text" style="width: 100%;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Judul Kartu LPS</label>
                                <input type="text" name="options_deposito_lps_title" value="<?php echo esc_attr( $dep_lps_title ); ?>" class="regular-text" style="width: 100%; font-weight: bold;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Deskripsi Jaminan LPS</label>
                                <textarea name="options_deposito_lps_desc" rows="2" style="width: 100%;"><?php echo esc_textarea( $dep_lps_desc ); ?></textarea>
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 4px;">Teks Tombol Aksi Tautan</label>
                                <input type="text" name="options_deposito_lps_btn_text" value="<?php echo esc_attr( $dep_lps_btn ); ?>" class="regular-text" style="width: 100%;">
                                <span style="font-size: 11px; color: #64748b;">Mengarahkan langsung ke section kalkulator simulasi.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Pilihan Tenor & 4 Kartu Tenor -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        2. Section Pilihan Tenor &amp; 4 Kartu Jangka Waktu
                    </h2>
                    <table class="form-table" style="margin: 0 0 20px 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_deposito_tenor_kicker">Kicker Section</label></th>
                            <td><input type="text" id="options_deposito_tenor_kicker" name="options_deposito_tenor_kicker" value="<?php echo esc_attr( $dep_tenor_kicker ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_tenor_title">Judul Section</label></th>
                            <td><input type="text" id="options_deposito_tenor_title" name="options_deposito_tenor_title" value="<?php echo esc_attr( $dep_tenor_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_tenor_desc">Deskripsi Pengantar</label></th>
                            <td><textarea id="options_deposito_tenor_desc" name="options_deposito_tenor_desc" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $dep_tenor_desc ); ?></textarea></td>
                        </tr>
                    </table>

                    <h4 style="margin: 15px 0 10px 0; font-size: 13px; font-weight: 700; color: #334155;">Konfigurasi Teks Masing-Masing Kartu Tenor:</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 14px;">
                        
                        <!-- Tenor 1 Bulan -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px;">
                            <div style="font-weight: 800; font-size: 14px; color: #088395; margin-bottom: 8px;">Tenor 1 Bulan</div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Badge Kategori</label>
                            <input type="text" name="options_deposito_t1_badge" value="<?php echo esc_attr( $dep_t1_badge ); ?>" style="width: 100%; margin-bottom: 8px;">
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Deskripsi Singkat</label>
                            <textarea name="options_deposito_t1_desc" rows="2" style="width: 100%; margin-bottom: 8px;"><?php echo esc_textarea( $dep_t1_desc ); ?></textarea>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Label ARO</label>
                            <input type="text" name="options_deposito_t1_aro" value="<?php echo esc_attr( $dep_t1_aro ); ?>" style="width: 100%;">
                        </div>

                        <!-- Tenor 3 Bulan -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px;">
                            <div style="font-weight: 800; font-size: 14px; color: #088395; margin-bottom: 8px;">Tenor 3 Bulan</div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Badge Kategori</label>
                            <input type="text" name="options_deposito_t3_badge" value="<?php echo esc_attr( $dep_t3_badge ); ?>" style="width: 100%; margin-bottom: 8px;">
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Deskripsi Singkat</label>
                            <textarea name="options_deposito_t3_desc" rows="2" style="width: 100%; margin-bottom: 8px;"><?php echo esc_textarea( $dep_t3_desc ); ?></textarea>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Label ARO</label>
                            <input type="text" name="options_deposito_t3_aro" value="<?php echo esc_attr( $dep_t3_aro ); ?>" style="width: 100%;">
                        </div>

                        <!-- Tenor 6 Bulan -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px;">
                            <div style="font-weight: 800; font-size: 14px; color: #088395; margin-bottom: 8px;">Tenor 6 Bulan</div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Badge Kategori</label>
                            <input type="text" name="options_deposito_t6_badge" value="<?php echo esc_attr( $dep_t6_badge ); ?>" style="width: 100%; margin-bottom: 8px;">
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Deskripsi Singkat</label>
                            <textarea name="options_deposito_t6_desc" rows="2" style="width: 100%; margin-bottom: 8px;"><?php echo esc_textarea( $dep_t6_desc ); ?></textarea>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Label ARO</label>
                            <input type="text" name="options_deposito_t6_aro" value="<?php echo esc_attr( $dep_t6_aro ); ?>" style="width: 100%;">
                        </div>

                        <!-- Tenor 12 Bulan -->
                        <div style="background: #f0fdfa; border: 1px solid #99f6e4; border-radius: 10px; padding: 14px;">
                            <div style="font-weight: 800; font-size: 14px; color: #0f766e; margin-bottom: 8px;">Tenor 12 Bulan (Pilihan Populer)</div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Badge Kategori</label>
                            <input type="text" name="options_deposito_t12_badge" value="<?php echo esc_attr( $dep_t12_badge ); ?>" style="width: 100%; margin-bottom: 8px;">
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Highlight Badge Kanan</label>
                            <input type="text" name="options_deposito_t12_highlight" value="<?php echo esc_attr( $dep_t12_high ); ?>" style="width: 100%; margin-bottom: 8px; font-weight: bold; color: #0d9488;">
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Deskripsi Singkat</label>
                            <textarea name="options_deposito_t12_desc" rows="2" style="width: 100%; margin-bottom: 8px;"><?php echo esc_textarea( $dep_t12_desc ); ?></textarea>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 2px;">Label ARO</label>
                            <input type="text" name="options_deposito_t12_aro" value="<?php echo esc_attr( $dep_t12_aro ); ?>" style="width: 100%;">
                        </div>
                    </div>
                </div>

                <!-- 3. Poin Keunggulan Deposito Mudharabah -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        3. Kotak Keunggulan Deposito Mudharabah
                    </h2>
                    <table class="form-table" style="margin: 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_deposito_keunggulan_kicker">Kicker Atas Kotak</label></th>
                            <td><input type="text" id="options_deposito_keunggulan_kicker" name="options_deposito_keunggulan_kicker" value="<?php echo esc_attr( $dep_keung_kicker ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_keunggulan_title">Judul Utama Kotak</label></th>
                            <td><input type="text" id="options_deposito_keunggulan_title" name="options_deposito_keunggulan_title" value="<?php echo esc_attr( $dep_keung_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_keunggulan_badge">Badge Kanan Kotak</label></th>
                            <td><input type="text" id="options_deposito_keunggulan_badge" name="options_deposito_keunggulan_badge" value="<?php echo esc_attr( $dep_keung_badge ); ?>" class="regular-text" style="width: 100%; max-width: 350px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_keunggulan">Daftar Poin Keunggulan<br><small style="color: #64748b; font-weight: normal;">(Tulis 1 poin per baris)</small></label></th>
                            <td><textarea id="options_deposito_keunggulan" name="options_deposito_keunggulan" rows="6" class="large-text" style="width: 100%; max-width: 650px; font-family: monospace;"><?php echo esc_textarea( $dep_keunggulan ); ?></textarea></td>
                        </tr>
                    </table>
                </div>

                <!-- 4. Realisasi Nisbah Bagi Hasil Deposito (Tersinkronisasi 2-Arah) & Catatan Syariah -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; flex-wrap: wrap; gap: 10px;">
                        <div>
                            <h3 style="font-size: 16px; font-weight: 800; color: #0f172a; margin: 0 0 4px 0;">
                                4. Realisasi Nisbah, Indikasi Equivalent Rate &amp; Catatan Syariah
                            </h3>
                            <p style="margin: 0; font-size: 12px; color: #64748b;">
                                Nilai ini langsung terhubung secara live ke <strong>Halaman Utama (Beranda)</strong>, <strong>Halaman Deposito</strong>, dan <strong>Kalkulator Simulasi</strong>.
                            </p>
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <label for="options_nisbah_bulan" style="font-size: 12px; font-weight: bold; color: #334155;">Periode Bulan:</label>
                            <input type="text" id="options_nisbah_bulan" name="options_nisbah_bulan" value="<?php echo esc_attr( $dep_nisbah_bulan ); ?>" class="regular-text" style="width: 150px; font-weight: bold; padding: 4px 8px;" placeholder="Agustus 2026">
                        </div>
                    </div>

                    <table class="form-table" style="margin: 0 0 16px 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_deposito_nisbah_kicker">Kicker Section</label></th>
                            <td><input type="text" id="options_deposito_nisbah_kicker" name="options_deposito_nisbah_kicker" value="<?php echo esc_attr( $dep_nisbah_kicker ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_nisbah_title">Judul Section Nisbah</label></th>
                            <td><input type="text" id="options_deposito_nisbah_title" name="options_deposito_nisbah_title" value="<?php echo esc_attr( $dep_nisbah_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_nisbah_desc">Deskripsi Tabel<br><small style="color: #64748b; font-weight: normal;">Gunakan <code>{bulan}</code> untuk memanggil periode</small></label></th>
                            <td><input type="text" id="options_deposito_nisbah_desc" name="options_deposito_nisbah_desc" value="<?php echo esc_attr( $dep_nisbah_desc ); ?>" class="large-text" style="width: 100%; max-width: 650px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_nisbah_row_desc">Keterangan Baris Akad</label></th>
                            <td><input type="text" id="options_deposito_nisbah_row_desc" name="options_deposito_nisbah_row_desc" value="<?php echo esc_attr( $dep_nisbah_row_desc ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                    </table>

                    <table id="dep-nisbah-table" class="widefat striped" style="border-radius: 8px; overflow: hidden; margin-bottom: 16px;">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="font-weight: 700; padding: 10px 14px;">Nama Tenor / Produk Deposito</th>
                                <th style="font-weight: 700; width: 140px; padding: 10px 14px;">Porsi Nasabah (%)</th>
                                <th style="font-weight: 700; width: 140px; padding: 10px 14px;">Porsi Bank (%)</th>
                                <th style="font-weight: 700; width: 180px; padding: 10px 14px;">Indikasi Eqv. Rate (% p.a.)</th>
                                <th style="font-weight: 700; width: 80px; text-align: center; padding: 10px 14px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dep-nisbah-tbody">
                            <?php foreach ( $dep_nisbah_list as $dni => $dnrow ) : ?>
                                <tr class="dep-nisbah-row">
                                    <td style="padding: 10px 14px;">
                                        <input type="text" name="dep_nisbah_produk[]" value="<?php echo esc_attr( $dnrow['nisbah_produk'] ?? '' ); ?>" class="regular-text" style="width: 100%; font-weight: 600;" placeholder="contoh: Deposito 1 Bulan" required>
                                    </td>
                                    <td style="padding: 10px 14px;">
                                        <input type="text" name="dep_nisbah_nasabah[]" value="<?php echo esc_attr( $dnrow['nisbah_nasabah'] ?? '' ); ?>" style="width: 90px; text-align: center; font-weight: bold;" required> %
                                    </td>
                                    <td style="padding: 10px 14px;">
                                        <input type="text" name="dep_nisbah_bank[]" value="<?php echo esc_attr( $dnrow['nisbah_bank'] ?? '' ); ?>" style="width: 90px; text-align: center; font-weight: bold;" required> %
                                    </td>
                                    <td style="padding: 10px 14px;">
                                        <input type="text" name="dep_nisbah_equiv[]" value="<?php echo esc_attr( $dnrow['nisbah_equiv'] ?? '' ); ?>" style="width: 120px; font-weight: bold; color: #059669;" placeholder="contoh: 4.23%" required>
                                    </td>
                                    <td style="padding: 10px 14px; text-align: center;">
                                        <button type="button" class="button button-link-delete wkl-remove-dep-nisbah" style="color: #ef4444;" title="Hapus Baris">✕ Hapus</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <button type="button" id="btn-add-dep-nisbah" class="button" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> + Tambah Tenor / Produk Deposito
                    </button>

                    <!-- Catatan Syariah / Karakteristik Estimasi -->
                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 14px 18px; margin-top: 15px;">
                        <label style="display: block; font-size: 12px; font-weight: 800; color: #166534; margin-bottom: 4px;">Judul Kotak Catatan Syariah (*Estimasi):</label>
                        <input type="text" name="options_deposito_sharia_note_title" value="<?php echo esc_attr( $dep_sharia_title ); ?>" class="regular-text" style="width: 100%; margin-bottom: 8px; font-weight: 700;">
                        <label style="display: block; font-size: 12px; font-weight: 800; color: #166534; margin-bottom: 4px;">Isi Catatan Syariah / Ketentuan DSN-MUI:</label>
                        <textarea name="options_deposito_sharia_note_desc" rows="3" class="large-text" style="width: 100%;"><?php echo esc_textarea( $dep_sharia_desc ); ?></textarea>
                    </div>
                </div>

                <!-- 5. Kalkulator Simulasi Imbal Hasil Deposito -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        5. Kalkulator Simulasi Imbal Hasil Deposito
                    </h2>
                    <table class="form-table" style="margin: 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_deposito_calc_badge">Badge Kalkulator</label></th>
                            <td>
                                <input type="text" id="options_deposito_calc_badge" name="options_deposito_calc_badge" value="<?php echo esc_attr( $dep_calc_badge ); ?>" class="regular-text" style="width: 100%; max-width: 450px;">
                                <p class="description" style="font-size: 11px; color: #64748b; margin-top: 4px;">Badge kecil di atas judul kalkulator (default: <em>Simulasi Finansial Syariah</em>)</p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_calc_title">Judul Kalkulator</label></th>
                            <td><input type="text" id="options_deposito_calc_title" name="options_deposito_calc_title" value="<?php echo esc_attr( $dep_calc_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_calc_desc">Deskripsi Kalkulator</label></th>
                            <td><textarea id="options_deposito_calc_desc" name="options_deposito_calc_desc" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $dep_calc_desc ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_calc_input_label">Label Input Nominal</label></th>
                            <td>
                                <input type="text" id="options_deposito_calc_input_label" name="options_deposito_calc_input_label" value="<?php echo esc_attr( $dep_calc_input_label ); ?>" class="regular-text" style="width: 100%; max-width: 450px;">
                                <p class="description" style="font-size: 11px; color: #64748b; margin-top: 4px;">Label langkah 1 di kalkulator (default: <em>Nominal Penempatan Deposito</em>)</p>
                            </td>
                        </tr>
                        <tr>
                            <th><label>Batas Nominal Simulasi</label></th>
                            <td>
                                <div style="display: flex; gap: 14px; flex-wrap: wrap;">
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: bold; color: #475569;">Minimal (Rp)</label>
                                        <input type="number" id="options_deposito_calc_min" name="options_deposito_calc_min" value="<?php echo esc_attr( $dep_calc_min ); ?>" style="width: 140px;">
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: bold; color: #475569;">Maksimal Slider (Rp)</label>
                                        <input type="number" id="options_deposito_calc_max" name="options_deposito_calc_max" value="<?php echo esc_attr( $dep_calc_max ); ?>" style="width: 170px;">
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: bold; color: #475569;">Default Awal (Rp)</label>
                                        <input type="number" id="options_deposito_calc_default" name="options_deposito_calc_default" value="<?php echo esc_attr( $dep_calc_default ); ?>" style="width: 160px;">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_calc_max_note">Keterangan Batas Maksimal</label></th>
                            <td>
                                <input type="text" id="options_deposito_calc_max_note" name="options_deposito_calc_max_note" value="<?php echo esc_attr( $dep_calc_max_note ); ?>" class="regular-text" style="width: 100%; max-width: 550px;">
                                <p class="description" style="font-size: 11px; color: #64748b; margin-top: 4px;">Teks keterangan di samping slider (default: <em>Ketik untuk nominal penempatan lebih dari 2 Miliar</em>)</p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_calc_note">Catatan Kaki Simulasi</label></th>
                            <td><textarea id="options_deposito_calc_note" name="options_deposito_calc_note" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $dep_calc_note ); ?></textarea></td>
                        </tr>
                    </table>
                </div>

                <!-- 6. Dokumen & Persyaratan Pembukaan Deposito -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        6. Dokumen &amp; Persyaratan Pembukaan Deposito
                    </h2>
                    <table class="form-table" style="margin: 0 0 20px 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_deposito_syarat_kicker">Kicker Section</label></th>
                            <td><input type="text" id="options_deposito_syarat_kicker" name="options_deposito_syarat_kicker" value="<?php echo esc_attr( $dep_syarat_kicker ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_syarat_title">Judul Section</label></th>
                            <td><input type="text" id="options_deposito_syarat_title" name="options_deposito_syarat_title" value="<?php echo esc_attr( $dep_syarat_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_syarat_desc">Deskripsi Section</label></th>
                            <td><textarea id="options_deposito_syarat_desc" name="options_deposito_syarat_desc" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $dep_syarat_desc ); ?></textarea></td>
                        </tr>
                    </table>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <!-- Tab 1: Nasabah Perorangan -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-top: 3px solid #088395; border-radius: 10px; padding: 18px;">
                            <h4 style="margin: 0 0 12px 0; font-size: 14px; font-weight: 700; color: #0f172a;">Kategori 1: Perorangan (Individu)</h4>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 3px;">Label Tab</label>
                                <input type="text" name="options_deposito_tab1_label" value="<?php echo esc_attr( $dep_tab1_label ); ?>" style="width: 100%; font-weight: bold;">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 3px;">Badge Kanan Tab</label>
                                <input type="text" name="options_deposito_tab1_badge" value="<?php echo esc_attr( $dep_tab1_badge ); ?>" style="width: 100%;">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 3px;">Daftar Dokumen / Syarat (1 per baris)</label>
                                <textarea name="options_deposito_syarat_individu" rows="5" style="width: 100%; font-family: monospace;"><?php echo esc_textarea( $dep_syarat_ind ); ?></textarea>
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 3px;">Catatan Bawah Card (Bantuan CS)</label>
                                <textarea name="options_deposito_syarat_ind_note" rows="2" style="width: 100%;"><?php echo esc_textarea( $dep_syarat_ind_note ); ?></textarea>
                            </div>
                        </div>

                        <!-- Tab 2: Lembaga / Badan Usaha -->
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-top: 3px solid #059669; border-radius: 10px; padding: 18px;">
                            <h4 style="margin: 0 0 12px 0; font-size: 14px; font-weight: 700; color: #0f172a;">Kategori 2: Badan Usaha / Lembaga</h4>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 3px;">Label Tab</label>
                                <input type="text" name="options_deposito_tab2_label" value="<?php echo esc_attr( $dep_tab2_label ); ?>" style="width: 100%; font-weight: bold;">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 3px;">Badge Kanan Tab</label>
                                <input type="text" name="options_deposito_tab2_badge" value="<?php echo esc_attr( $dep_tab2_badge ); ?>" style="width: 100%;">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 3px;">Daftar Dokumen / Syarat (1 per baris)</label>
                                <textarea name="options_deposito_syarat_lembaga" rows="5" style="width: 100%; font-family: monospace;"><?php echo esc_textarea( $dep_syarat_lem ); ?></textarea>
                            </div>
                            <div>
                                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 3px;">Catatan Bawah Card (Bantuan Treasury)</label>
                                <textarea name="options_deposito_syarat_lem_note" rows="2" style="width: 100%;"><?php echo esc_textarea( $dep_syarat_lem_note ); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 7. Banner Konsultasi & Unduh Brosur PDF -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        7. Banner Konsultasi &amp; Unduh Brosur PDF
                    </h2>
                    <table class="form-table" style="margin: 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_deposito_cta_kicker">Kicker Banner</label></th>
                            <td><input type="text" id="options_deposito_cta_kicker" name="options_deposito_cta_kicker" value="<?php echo esc_attr( $dep_cta_kicker ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_cta_title">Judul Banner CTA</label></th>
                            <td><input type="text" id="options_deposito_cta_title" name="options_deposito_cta_title" value="<?php echo esc_attr( $dep_cta_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_cta_desc">Deskripsi Banner CTA</label></th>
                            <td><textarea id="options_deposito_cta_desc" name="options_deposito_cta_desc" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $dep_cta_desc ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_cta_btn_text">Teks Tombol WhatsApp</label></th>
                            <td><input type="text" id="options_deposito_cta_btn_text" name="options_deposito_cta_btn_text" value="<?php echo esc_attr( $dep_cta_btn ); ?>" class="regular-text" style="width: 100%; max-width: 350px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_cta_wa_msg">Template Pesan WhatsApp</label></th>
                            <td><textarea id="options_deposito_cta_wa_msg" name="options_deposito_cta_wa_msg" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $dep_cta_wa_msg ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="options_brosur_file_url">File Dokumen Brosur (PDF)</label></th>
                            <td>
                                <div style="display: flex; gap: 8px; align-items: center; max-width: 650px;">
                                    <input type="text" id="options_brosur_file_url" name="options_brosur_file_url" value="<?php echo esc_url( $dep_brosur_url ); ?>" class="regular-text" style="flex: 1;" placeholder="https://.../brosur-deposito.pdf">
                                    <button type="button" class="button wkl-upload-file-btn" data-target="options_brosur_file_url">
                                        <span class="dashicons dashicons-media-document" style="font-size: 16px; width: 16px; height: 16px; vertical-align: middle;"></span> Unggah / Pilih PDF
                                    </button>
                                </div>
                                <p class="description">Jika URL brosur terisi, tombol "Unduh Brosur Produk (PDF)" akan otomatis muncul di banner CTA.</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- 8. Parameter Dasar Deposito -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-left: 5px solid #059669; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h3 style="font-size: 16px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 16px;">
                        8. Parameter Dasar Deposito
                    </h3>
                    <table class="form-table" style="margin: 0;">
                        <tr>
                            <th style="width: 230px;"><label for="options_deposito_akad">Akad Syariah</label></th>
                            <td><input type="text" id="options_deposito_akad" name="options_deposito_akad" value="<?php echo esc_attr( $dep_akad ); ?>" class="regular-text" style="width: 100%; max-width: 350px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_min_penempatan">Minimal Penempatan Pokok</label></th>
                            <td><input type="text" id="options_deposito_min_penempatan" name="options_deposito_min_penempatan" value="<?php echo esc_attr( $dep_min ); ?>" class="regular-text" style="width: 100%; max-width: 250px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_tenor_list">Pilihan Jangka Waktu (Tenor)</label></th>
                            <td><input type="text" id="options_deposito_tenor_list" name="options_deposito_tenor_list" value="<?php echo esc_attr( $dep_tenor ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                        </tr>
                    </table>
                </div>

                <!-- Tombol Simpan Cepat Khusus Deposito & CTA -->
                <div style="margin: 20px 0 10px 0; padding: 15px 0; border-top: 1px solid #e2e8f0; display: flex; align-items: center; gap: 15px;">
                    <button type="submit" name="wakalumi_save_produk_dana" class="button button-primary button-hero" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 30px;">
                        Simpan Pengaturan Deposito &amp; CTA
                    </button>
                    <span style="color: #64748b; font-size: 13px;">Data Deposito Mudharabah dan Banner CTA akan langsung tersimpan.</span>
                </div>

            </div>

            <!-- ========================================================
                 TAB 3: HOTLINE & CTA BANNER
                 ======================================================== -->
            <div id="tab-kontak" class="wkl-tab-content" style="display: <?php echo $is_tab_kontak ? 'block' : 'none'; ?>;">
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        Hotline WhatsApp & Call to Action Produk
                    </h2>
                    <table class="form-table" style="margin: 0;">
                        <tr>
                            <th style="width: 220px;"><label for="options_produk_wa_number">Nomor WhatsApp Layanan Produk</label></th>
                            <td>
                                <input type="text" id="options_produk_wa_number" name="options_produk_wa_number" value="<?php echo esc_attr( $produk_wa ); ?>" class="regular-text" style="width: 100%; max-width: 350px;">
                                <p class="description">Format angka internasional: 6281517380388 (tanpa spasi atau simbol).</p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="options_produk_cta_title">Judul Banner CTA</label></th>
                            <td><input type="text" id="options_produk_cta_title" name="options_produk_cta_title" value="<?php echo esc_attr( $cta_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px;"></td>
                        </tr>
                        <tr>
                            <th><label for="options_produk_cta_desc">Deskripsi Banner CTA</label></th>
                            <td><textarea id="options_produk_cta_desc" name="options_produk_cta_desc" rows="3" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $cta_desc ); ?></textarea></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <div style="margin-top: 20px; padding: 15px 0; border-top: 1px solid #e2e8f0; display: flex; align-items: center; gap: 15px;">
                <button type="submit" name="wakalumi_save_produk_dana" class="button button-primary button-hero" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 30px;">
                    Simpan Semua Pengaturan Produk
                </button>
                <span style="color: #64748b; font-size: 13px;">Perubahan akan langsung terlihat pada halaman web dan dropdown navigasi secara instan.</span>
            </div>
        </form>
    </div>

    <!-- REPEATER TEMPLATE (HIDDEN) -->
    <template id="tabungan-card-template">
        <div class="tabungan-card-item" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); position: relative;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span class="wkl-item-num" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 50%; background: #088395; color: #fff; font-weight: bold; font-size: 12px;">
                        #
                    </span>
                    <strong style="font-size: 15px; color: #0f172a;" class="wkl-card-title-preview">
                        Produk Tabungan Baru
                    </strong>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 12px; color: #64748b;">Urutan:</span>
                    <input type="number" name="tab_urutan[]" value="99" style="width: 60px; height: 30px;" min="1">
                    <button type="button" class="button wkl-btn-remove-tabungan" style="color: #ef4444; border-color: #fca5a5;">
                        🗑️ Hapus
                    </button>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Nama Produk Tabungan *</label>
                    <input type="text" name="tab_nama[]" value="" class="regular-text wkl-tab-name-input" style="width: 100%;" placeholder="misal: Tabungan Ukhuwah" required>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Slug / ID Anchor (#hash untuk tautan) *</label>
                    <input type="text" name="tab_slug[]" value="" class="regular-text" style="width: 100%;" placeholder="misal: ukhuwah">
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Tagline Produk</label>
                    <input type="text" name="tab_tagline[]" value="" class="regular-text" style="width: 100%;" placeholder="misal: Tabungan Berhadiah Berkah">
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Badge / Kategori Sasaran</label>
                    <input type="text" name="tab_badge[]" value="Program Khusus" class="regular-text" style="width: 100%;">
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Tema Warna Kartu</label>
                    <select name="tab_color[]" style="width: 100%;">
                        <option value="teal">🟢 Teal / Toska (Wakalumi Utama)</option>
                        <option value="blue">🔵 Blue / Biru (Pendidikan & Pelajar)</option>
                        <option value="amber">🟡 Amber / Emas (Haji & Ibadah)</option>
                        <option value="purple" selected>🟣 Purple / Ungu (Ukhuwah & Hadiah)</option>
                        <option value="emerald">🌱 Emerald / Hijau Zamrud (Investasi Syariah)</option>
                        <option value="indigo">🔷 Indigo / Biru Gelap (Institusi & Bisnis)</option>
                        <option value="cyan">🌊 Cyan / Biru Bahari (Muda & Segar)</option>
                        <option value="rose">🔴 Rose / Merah Muda (Keluarga & Usaha)</option>
                        <option value="orange">🟠 Orange / Jingga (Pedagang & UMKM)</option>
                        <option value="slate">⚪ Slate / Abu Monokrom (Netral Elegan)</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Ikon Kartu Produk</label>
                    <select name="tab_icon[]" style="width: 100%;">
                        <option value="tawakal">👛 Dompet / Simpanan Umum</option>
                        <option value="pendidikan">🎓 Pendidikan / Topi Wisuda</option>
                        <option value="haji-umroh">🕌 Haji &amp; Umroh / Ka'bah</option>
                        <option value="ukhuwah" selected>🎁 Kado / Berhadiah</option>
                        <option value="business">🏢 Bisnis &amp; Institusi</option>
                        <option value="coins">🪙 Koin / Investasi</option>
                        <option value="shield">🛡️ Perisai / Amanah LPS</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Akad Syariah</label>
                    <input type="text" name="tab_akad[]" value="Mudharabah Muthlaqah" class="regular-text" style="width: 100%;">
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Setoran Awal Minimum</label>
                    <input type="text" name="tab_min_setor[]" value="Rp 100.000" class="regular-text" style="width: 100%;">
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Biaya Administrasi Bulanan</label>
                    <input type="text" name="tab_biaya_admin[]" value="Gratis / Bebas Biaya Bulanan" class="regular-text" style="width: 100%;" placeholder="misal: Gratis / Bebas Biaya Bulanan">
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Ketentuan Penarikan (Tabel Komparasi)</label>
                    <input type="text" name="tab_penarikan[]" value="" class="regular-text" style="width: 100%;" placeholder="misal: Fleksibel: Kapan pun pada jam operasional kantor">
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Pesan WhatsApp Kustom (Opsional)</label>
                    <input type="text" name="tab_wa_text[]" value="" class="regular-text" style="width: 100%;" placeholder="Pesan otomatis pembukaan">
                </div>

                <div style="grid-column: 1 / -1;" class="wkl-img-field-wrap">
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">
                        Gambar Banner / Kartu Produk (Opsional - Rekomendasi Rasio Standar 16:10 / 800x500px)
                    </label>
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <input type="text" name="tab_image[]" value="" class="regular-text" style="flex: 1; min-width: 250px;" placeholder="https://... atau klik Unggah Gambar">
                        <button type="button" class="button wkl-upload-tab-img-btn" style="display: inline-flex; align-items: center; gap: 5px;">
                            <span class="dashicons dashicons-format-image" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah Gambar
                        </button>
                        <button type="button" class="button button-link-delete wkl-remove-tab-img-btn" style="color: #ef4444; display: none;">
                            ✕ Hapus
                        </button>
                    </div>
                    <div class="wkl-img-preview-box" style="margin-top: 8px;">
                        <img class="wkl-img-preview" src="" style="height: 65px; border-radius: 6px; border: 1px solid #cbd5e1; object-fit: cover; display: none;" alt="Preview Produk">
                    </div>
                    <p class="description" style="font-size: 11px; margin-top: 4px; color: #64748b;">Jika gambar diisi, kartu di beranda dan halaman tabungan akan menampilkan grafis produk dengan rasio standar 16:10 (800x500px) menggantikan ikon default.</p>
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Deskripsi Produk</label>
                <textarea name="tab_desc[]" rows="2" style="width: 100%;" placeholder="Deskripsi lengkap..."></textarea>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 15px;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">
                        Poin Keunggulan <small style="font-weight: normal; color: #64748b;">(1 baris per poin)</small>
                    </label>
                    <textarea name="tab_keunggulan[]" rows="4" style="width: 100%; font-family: monospace; font-size: 12px;" placeholder="Keunggulan 1&#10;Keunggulan 2"></textarea>
                </div>

                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">
                        Dokumen Persyaratan <small style="font-weight: normal; color: #64748b;">(1 baris per syarat)</small>
                    </label>
                    <textarea name="tab_syarat[]" rows="4" style="width: 100%; font-family: monospace; font-size: 12px;" placeholder="Syarat 1&#10;Syarat 2"></textarea>
                </div>
            </div>
        </div>
    </template>

    <!-- TEMPLATE: PRESET ITEM CLONE -->
    <template id="tabungan-preset-template">
        <div class="tabungan-preset-item" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 14px; display: grid; grid-template-columns: 2fr 1.5fr 1fr 2fr auto; gap: 12px; align-items: center;">
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Label Tombol *</label>
                <input type="text" name="calc_preset_label[]" value="" class="regular-text" style="width: 100%; font-weight: 600;" placeholder="misal: Rp 15 Jt (Pendidikan)" required>
            </div>
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Target Nominal (Rp) *</label>
                <input type="number" name="calc_preset_nominal[]" value="15000000" class="regular-text" style="width: 100%;" placeholder="15000000" step="100000" required>
            </div>
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Tenor (Bulan)</label>
                <input type="number" name="calc_preset_tenor[]" value="24" class="regular-text" style="width: 100%;" placeholder="24" min="6" max="60" step="6">
            </div>
            <div>
                <label style="display: block; font-size: 11px; font-weight: 700; color: #475569; margin-bottom: 3px;">Pilih Produk Rekomendasi</label>
                <select name="calc_preset_prod[]" style="width: 100%;">
                    <option value="">-- Tetap Sesuai Pilihan Nasabah --</option>
                    <?php foreach ( $tabungan_list as $prod_opt ) : ?>
                        <option value="<?php echo esc_attr( $prod_opt['nama'] ); ?>">
                            <?php echo esc_html( $prod_opt['nama'] ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div style="padding-top: 18px;">
                <button type="button" class="button wkl-btn-remove-preset" style="color: #ef4444; border-color: #fca5a5;" title="Hapus shortcut">
                    ✕
                </button>
            </div>
        </div>
    </template>

    <!-- TEMPLATE: FAQ ITEM CLONE -->
    <template id="tabungan-faq-template">
        <div class="tabungan-faq-item" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                <strong style="color: #0f172a; font-size: 13px;">
                    Q#<span class="wkl-faq-num">1</span>
                </strong>
                <button type="button" class="button-link wkl-btn-remove-faq" style="color: #ef4444; font-size: 12px; text-decoration: none;">
                    ✕ Hapus Pertanyaan
                </button>
            </div>
            <div style="margin-bottom: 10px;">
                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 3px;">Pertanyaan</label>
                <input type="text" name="tab_faq_q[]" value="" class="regular-text" style="width: 100%; font-weight: 600;" placeholder="Tuliskan pertanyaan baru...">
            </div>
            <div>
                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 3px;">Jawaban</label>
                <textarea name="tab_faq_a[]" rows="3" style="width: 100%;" placeholder="Tuliskan jawaban yang informatif..."></textarea>
            </div>
        </div>
    </template>

    <!-- TEMPLATE: NISBAH TABUNGAN ROW CLONE -->
    <template id="tab-nisbah-template">
        <tr class="tab-nisbah-row">
            <td style="padding: 10px 14px;">
                <input type="text" name="tab_nisbah_produk[]" value="" class="regular-text" style="width: 100%; font-weight: 600;" placeholder="contoh: Tabungan Reguler" required>
            </td>
            <td style="padding: 10px 14px;">
                <input type="text" name="tab_nisbah_nasabah[]" value="15" style="width: 90px; text-align: center; font-weight: bold;" required> %
            </td>
            <td style="padding: 10px 14px;">
                <input type="text" name="tab_nisbah_bank[]" value="85" style="width: 90px; text-align: center; font-weight: bold;" required> %
            </td>
            <td style="padding: 10px 14px;">
                <input type="text" name="tab_nisbah_equiv[]" value="1.50%" style="width: 120px; font-weight: bold; color: #059669;" placeholder="contoh: 1.49%" required>
            </td>
            <td style="padding: 10px 14px; text-align: center;">
                <button type="button" class="button button-link-delete wkl-remove-tab-nisbah" style="color: #ef4444;" title="Hapus Baris">✕ Hapus</button>
            </td>
        </tr>
    </template>

    <!-- TEMPLATE: NISBAH DEPOSITO ROW CLONE -->
    <template id="dep-nisbah-template">
        <tr class="dep-nisbah-row">
            <td style="padding: 10px 14px;">
                <input type="text" name="dep_nisbah_produk[]" value="" class="regular-text" style="width: 100%; font-weight: 600;" placeholder="contoh: Deposito 24 Bulan" required>
            </td>
            <td style="padding: 10px 14px;">
                <input type="text" name="dep_nisbah_nasabah[]" value="45" style="width: 90px; text-align: center; font-weight: bold;" required> %
            </td>
            <td style="padding: 10px 14px;">
                <input type="text" name="dep_nisbah_bank[]" value="55" style="width: 90px; text-align: center; font-weight: bold;" required> %
            </td>
            <td style="padding: 10px 14px;">
                <input type="text" name="dep_nisbah_equiv[]" value="4.50%" style="width: 120px; font-weight: bold; color: #059669;" placeholder="contoh: 4.23%" required>
            </td>
            <td style="padding: 10px 14px; text-align: center;">
                <button type="button" class="button button-link-delete wkl-remove-dep-nisbah" style="color: #ef4444;" title="Hapus Baris">✕ Hapus</button>
            </td>
        </tr>
    </template>

    <!-- REPEATER, TAB SWITCHER & UPLOAD JAVASCRIPT -->
    <script>
    // Note: window.wklSwitchTab is defined early before navigation tabs

    (function() {
        function initProdukAdmin() {
            // Repeater Tabungan functions
            var listContainer = document.getElementById('tabungan-repeater-list');
        var addBtn = document.getElementById('btn-add-tabungan');
        var tmpl = document.getElementById('tabungan-card-template');

        function updateNumbers() {
            if (!listContainer) return;
            var cards = listContainer.querySelectorAll('.tabungan-card-item');
            cards.forEach(function(card, idx) {
                var numSpan = card.querySelector('.wkl-item-num');
                if (numSpan) numSpan.textContent = (idx + 1);
                var orderInput = card.querySelector('input[name="tab_urutan[]"]');
                if (orderInput && (!orderInput.value || orderInput.value == idx)) {
                    orderInput.value = (idx + 1);
                }
            });
        }

        function bindCardEvents(card) {
            var removeBtn = card.querySelector('.wkl-btn-remove-tabungan');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (confirm('Hapus produk tabungan ini?')) {
                        card.remove();
                        updateNumbers();
                    }
                });
            }

            var nameInput = card.querySelector('.wkl-tab-name-input');
            var titlePreview = card.querySelector('.wkl-card-title-preview');
            if (nameInput && titlePreview) {
                nameInput.addEventListener('input', function() {
                    titlePreview.textContent = this.value.trim() || 'Produk Tabungan Baru';
                });
            }
        }

        if (listContainer) {
            listContainer.querySelectorAll('.tabungan-card-item').forEach(function(card) {
                bindCardEvents(card);
            });
        }

        if (addBtn && tmpl && listContainer) {
            addBtn.addEventListener('click', function() {
                var clone = tmpl.content.cloneNode(true);
                var newCard = clone.querySelector('.tabungan-card-item');
                bindCardEvents(newCard);
                listContainer.appendChild(newCard);
                updateNumbers();
                newCard.scrollIntoView({ behavior: 'smooth' });
            });
        }

        // Repeater Presets Kalkulator
        var presetListContainer = document.getElementById('tabungan-calc-presets-list');
        var addPresetBtn = document.getElementById('btn-add-calc-preset');
        var presetTmpl = document.getElementById('tabungan-preset-template');

        function bindPresetEvents(item) {
            var removeBtn = item.querySelector('.wkl-btn-remove-preset');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (confirm('Hapus shortcut simulasi ini?')) {
                        item.remove();
                    }
                });
            }
        }

        if (presetListContainer) {
            presetListContainer.querySelectorAll('.tabungan-preset-item').forEach(function(item) {
                bindPresetEvents(item);
            });
        }

        if (addPresetBtn && presetTmpl && presetListContainer) {
            addPresetBtn.addEventListener('click', function() {
                var clone = presetTmpl.content.cloneNode(true);
                var newItem = clone.querySelector('.tabungan-preset-item');
                bindPresetEvents(newItem);
                presetListContainer.appendChild(newItem);
                newItem.scrollIntoView({ behavior: 'smooth' });
            });
        }

        // Repeater FAQ functions
        var faqListContainer = document.getElementById('tabungan-faq-list');
        var addFaqBtn = document.getElementById('btn-add-faq');
        var faqTmpl = document.getElementById('tabungan-faq-template');

        function updateFaqNumbers() {
            if (!faqListContainer) return;
            var faqItems = faqListContainer.querySelectorAll('.tabungan-faq-item');
            faqItems.forEach(function(item, idx) {
                var numSpan = item.querySelector('.wkl-faq-num');
                if (numSpan) numSpan.textContent = (idx + 1);
            });
        }

        function bindFaqEvents(item) {
            var removeBtn = item.querySelector('.wkl-btn-remove-faq');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (confirm('Hapus pertanyaan FAQ ini?')) {
                        item.remove();
                        updateFaqNumbers();
                    }
                });
            }
        }

        if (faqListContainer) {
            faqListContainer.querySelectorAll('.tabungan-faq-item').forEach(function(item) {
                bindFaqEvents(item);
            });
        }

        if (addFaqBtn && faqTmpl && faqListContainer) {
            addFaqBtn.addEventListener('click', function() {
                var clone = faqTmpl.content.cloneNode(true);
                var newItem = clone.querySelector('.tabungan-faq-item');
                bindFaqEvents(newItem);
                faqListContainer.appendChild(newItem);
                updateFaqNumbers();
            });
        }

        // Repeater Nisbah Tabungan
        var tabNisbahTbody = document.getElementById('tab-nisbah-tbody');
        var addTabNisbahBtn = document.getElementById('btn-add-tab-nisbah');
        var tabNisbahTmpl = document.getElementById('tab-nisbah-template');

        function bindTabNisbahRow(row) {
            var removeBtn = row.querySelector('.wkl-remove-tab-nisbah');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (confirm('Hapus baris nisbah tabungan ini?')) {
                        row.remove();
                    }
                });
            }
        }

        if (tabNisbahTbody) {
            tabNisbahTbody.querySelectorAll('.tab-nisbah-row').forEach(function(row) {
                bindTabNisbahRow(row);
            });
        }

        if (addTabNisbahBtn && tabNisbahTmpl && tabNisbahTbody) {
            addTabNisbahBtn.addEventListener('click', function() {
                var clone = tabNisbahTmpl.content.cloneNode(true);
                var newRow = clone.querySelector('.tab-nisbah-row');
                bindTabNisbahRow(newRow);
                tabNisbahTbody.appendChild(newRow);
                newRow.scrollIntoView({ behavior: 'smooth' });
            });
        }

        // Repeater Nisbah Deposito
        var depNisbahTbody = document.getElementById('dep-nisbah-tbody');
        var addDepNisbahBtn = document.getElementById('btn-add-dep-nisbah');
        var depNisbahTmpl = document.getElementById('dep-nisbah-template');

        function bindDepNisbahRow(row) {
            var removeBtn = row.querySelector('.wkl-remove-dep-nisbah');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (confirm('Hapus baris nisbah deposito ini?')) {
                        row.remove();
                    }
                });
            }
        }

        if (depNisbahTbody) {
            depNisbahTbody.querySelectorAll('.dep-nisbah-row').forEach(function(row) {
                bindDepNisbahRow(row);
            });
        }

        if (addDepNisbahBtn && depNisbahTmpl && depNisbahTbody) {
            addDepNisbahBtn.addEventListener('click', function() {
                var clone = depNisbahTmpl.content.cloneNode(true);
                var newRow = clone.querySelector('.dep-nisbah-row');
                bindDepNisbahRow(newRow);
                depNisbahTbody.appendChild(newRow);
                newRow.scrollIntoView({ behavior: 'smooth' });
            });
        }

        // Universal File / PDF Uploader
        if (window.jQuery) {
            jQuery(document).on('click', '.wkl-upload-file-btn', function(e) {
                e.preventDefault();
                var btn = jQuery(this);
                var targetId = btn.data('target');
                var targetInput = jQuery('#' + targetId);
                var fileFrame = wp.media({
                    title: 'Pilih atau Unggah Dokumen Brosur (PDF)',
                    button: { text: 'Gunakan Dokumen Ini' },
                    multiple: false
                });
                fileFrame.on('select', function() {
                    var attachment = fileFrame.state().get('selection').first().toJSON();
                    targetInput.val(attachment.url).trigger('change');
                });
                fileFrame.open();
            });

            // Media Uploader Kartu Tabungan
            jQuery(document).on('click', '.wkl-upload-tab-img-btn', function(e) {
                e.preventDefault();
                var btn = jQuery(this);
                var wrap = btn.closest('.wkl-img-field-wrap');
                var input = wrap.find('input[name="tab_image[]"]');
                var preview = wrap.find('img.wkl-img-preview');
                var removeBtn = wrap.find('.wkl-remove-tab-img-btn');

                var frame = wp.media({
                    title: 'Pilih atau Unggah Gambar Produk Tabungan (Rekomendasi Rasio 16:10)',
                    button: { text: 'Gunakan Gambar Ini' },
                    multiple: false,
                    library: { type: 'image' }
                });

                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    var url = (attachment.sizes && attachment.sizes.medium_large)
                            ? attachment.sizes.medium_large.url
                            : ((attachment.sizes && attachment.sizes.medium) ? attachment.sizes.medium.url : attachment.url);
                    input.val(attachment.url).trigger('change');
                    if (preview.length) {
                        preview.attr('src', url).show();
                    }
                    if (removeBtn.length) {
                        removeBtn.show();
                    }
                });

                frame.open();
            });

            jQuery(document).on('click', '.wkl-remove-tab-img-btn', function(e) {
                e.preventDefault();
                var btn = jQuery(this);
                var wrap = btn.closest('.wkl-img-field-wrap');
                var input = wrap.find('input[name="tab_image[]"]');
                var preview = wrap.find('img.wkl-img-preview');
                input.val('').trigger('change');
                if (preview.length) {
                    preview.attr('src', '').hide();
                }
                btn.hide();
            });
        }

        // Synchronize Active Tab on page load (URL query or Hash)
        var urlParams = new URLSearchParams(window.location.search);
        var tabParam = urlParams.get('tab');
        var hash = window.location.hash.replace('#', '');
        var initialTab = tabParam ? ('tab-' + tabParam) : (hash ? hash : null);

        if (initialTab && (initialTab === 'tab-deposito' || initialTab === 'tab-tabungan' || initialTab === 'tab-kontak')) {
            var targetBtn = document.querySelector('.wkl-tab-btn[data-tab="' + initialTab + '"]');
            if (targetBtn) {
                window.wklSwitchTab(initialTab, targetBtn);
            }
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initProdukAdmin);
    } else {
        initProdukAdmin();
    }
    })();
    </script>
    <?php
}
