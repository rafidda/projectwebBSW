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
        'Produk: Simpanan & Deposito',
        'Produk: Simpanan & Deposito',
        'manage_options',
        'wakalumi-produk-dana',
        'wakalumi_render_produk_admin_page'
    );
}
add_action( 'admin_menu', 'wakalumi_register_produk_admin_menu', 23 );

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
 * Render Halaman Admin Pengelolaan Produk Dana (Tabungan & Deposito)
 */
function wakalumi_render_produk_admin_page() {
    // ── PROSES SIMPAN DATA ──────────────────────────────────────────
    if ( isset( $_POST['wakalumi_save_produk_dana'] ) && check_admin_referer( 'wakalumi_produk_dana_nonce' ) ) {
        
        // 1. Tabungan: Header Banner
        update_option( 'options_tabungan_page_badge', sanitize_text_field( $_POST['options_tabungan_page_badge'] ?? '' ) );
        update_option( 'options_tabungan_page_title', sanitize_text_field( $_POST['options_tabungan_page_title'] ?? '' ) );
        update_option( 'options_tabungan_page_subtitle', sanitize_textarea_field( $_POST['options_tabungan_page_subtitle'] ?? '' ) );

        // 2. Tabungan: Dynamic Repeater
        $tab_names        = $_POST['tab_nama'] ?? [];
        $tab_slugs        = $_POST['tab_slug'] ?? [];
        $tab_taglines     = $_POST['tab_tagline'] ?? [];
        $tab_badges       = $_POST['tab_badge'] ?? [];
        $tab_colors       = $_POST['tab_color'] ?? [];
        $tab_akads        = $_POST['tab_akad'] ?? [];
        $tab_min_setors   = $_POST['tab_min_setor'] ?? [];
        $tab_biaya_admins = $_POST['tab_biaya_admin'] ?? [];
        $tab_descs        = $_POST['tab_desc'] ?? [];
        $tab_keunggulans  = $_POST['tab_keunggulan'] ?? [];
        $tab_syarats      = $_POST['tab_syarat'] ?? [];
        $tab_wa_texts     = $_POST['tab_wa_text'] ?? [];
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
                'akad'        => sanitize_text_field( $tab_akads[$i] ?? 'Mudharabah Muthlaqah' ),
                'min_setor'   => sanitize_text_field( $tab_min_setors[$i] ?? 'Rp 50.000' ),
                'biaya_admin' => sanitize_text_field( $tab_biaya_admins[$i] ?? 'Gratis / Bebas Biaya Bulanan' ),
                'desc'        => sanitize_textarea_field( $tab_descs[$i] ?? '' ),
                'keunggulan'  => sanitize_textarea_field( $tab_keunggulans[$i] ?? '' ),
                'syarat'      => sanitize_textarea_field( $tab_syarats[$i] ?? '' ),
                'wa_text'     => sanitize_text_field( $tab_wa_texts[$i] ?? '' ),
                'urutan'      => intval( $tab_urutans[$i] ?? ( $i + 1 ) ),
            ];
        }

        // Urutkan berdasarkan kolom 'urutan'
        usort( $clean_tabungan_list, function( $a, $b ) {
            return ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 );
        } );

        update_option( 'options_tabungan_list', $clean_tabungan_list );

        // 3. Tabungan: Pengaturan Kalkulator
        update_option( 'options_tabungan_calc_badge', sanitize_text_field( $_POST['options_tabungan_calc_badge'] ?? '' ) );
        update_option( 'options_tabungan_calc_title', sanitize_text_field( $_POST['options_tabungan_calc_title'] ?? '' ) );
        update_option( 'options_tabungan_calc_subtitle', sanitize_textarea_field( $_POST['options_tabungan_calc_subtitle'] ?? '' ) );

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

        // 5. Deposito: Header
        update_option( 'options_deposito_page_badge', sanitize_text_field( $_POST['options_deposito_page_badge'] ?? '' ) );
        update_option( 'options_deposito_page_title', sanitize_text_field( $_POST['options_deposito_page_title'] ?? '' ) );
        update_option( 'options_deposito_page_subtitle', sanitize_textarea_field( $_POST['options_deposito_page_subtitle'] ?? '' ) );
        update_option( 'options_deposito_quote', sanitize_textarea_field( $_POST['options_deposito_quote'] ?? '' ) );

        // 6. Deposito: Rincian & Ketentuan
        update_option( 'options_deposito_akad', sanitize_text_field( $_POST['options_deposito_akad'] ?? '' ) );
        update_option( 'options_deposito_min_penempatan', sanitize_text_field( $_POST['options_deposito_min_penempatan'] ?? '' ) );
        update_option( 'options_deposito_tenor_list', sanitize_text_field( $_POST['options_deposito_tenor_list'] ?? '' ) );
        update_option( 'options_deposito_keunggulan', sanitize_textarea_field( $_POST['options_deposito_keunggulan'] ?? '' ) );
        update_option( 'options_deposito_syarat_individu', sanitize_textarea_field( $_POST['options_deposito_syarat_individu'] ?? '' ) );
        update_option( 'options_deposito_syarat_lembaga', sanitize_textarea_field( $_POST['options_deposito_syarat_lembaga'] ?? '' ) );

        // 7. Hotline & CTA
        update_option( 'options_produk_wa_number', sanitize_text_field( $_POST['options_produk_wa_number'] ?? '' ) );
        update_option( 'options_produk_cta_title', sanitize_text_field( $_POST['options_produk_cta_title'] ?? '' ) );
        update_option( 'options_produk_cta_desc', sanitize_textarea_field( $_POST['options_produk_cta_desc'] ?? '' ) );

        echo '<div class="notice notice-success is-dismissible" style="margin-top: 15px;"><p><strong>Berhasil!</strong> Pengaturan dan daftar produk Tabungan & Deposito berhasil diperbarui.</p></div>';
    }

    // ── AMBIL NILAI DARI DATABASE ───────────────────────────────────
    $tab_page_badge    = get_option( 'options_tabungan_page_badge', 'Penghimpunan Dana Syariah' );
    $tab_page_title    = get_option( 'options_tabungan_page_title', 'Simpanan Berkah Sesuai Syariah' );
    $tab_page_sub      = get_option( 'options_tabungan_page_subtitle', 'Solusi simpanan syariah amanah, bebas biaya administrasi bulanan, bagi hasil bersaing, dan dijamin LPS hingga Rp 2 Miliar.' );

    $tabungan_list     = wakalumi_get_tabungan_list();

    // Kalkulator Tabungan
    $tab_calc_badge    = get_option( 'options_tabungan_calc_badge', 'Simulasi Finansial Syariah' );
    $tab_calc_title    = get_option( 'options_tabungan_calc_title', 'Kalkulator Rencana Menabung Berkah' );
    $tab_calc_sub      = get_option( 'options_tabungan_calc_subtitle', 'Tentukan target impian Anda—mulai dari porsi haji, dana sekolah anak, program tabungan ukhuwah, hingga simpanan masa depan keluarga. Kami hitungkan estimasi sisihan per bulan.' );

    // FAQ Tabungan
    $tab_faq_badge     = get_option( 'options_tabungan_faq_badge', 'Tanya Jawab (FAQ)' );
    $tab_faq_title     = get_option( 'options_tabungan_faq_title', 'Pertanyaan Seputar Tabungan' );
    $tab_faq_sub       = get_option( 'options_tabungan_faq_subtitle', 'Pertanyaan umum nasabah seputar produk simpanan syariah, keamanan simpanan di LPS, dan prosedur pembukaan rekening.' );
    $tab_faq_list      = wakalumi_get_tabungan_faq_list();

    // Deposito
    $dep_page_badge    = get_option( 'options_deposito_page_badge', 'Investasi Syariah Berkah' );
    $dep_page_title    = get_option( 'options_deposito_page_title', 'Deposito Mudharabah BPRS Wakalumi' );
    $dep_page_sub      = get_option( 'options_deposito_page_subtitle', 'Pilihan tepat bagi Anda berinvestasi sekaligus beribadah. Investasi aman, menguntungkan, dan berkah dengan prinsip Mudharabah Muthlaqah.' );
    $dep_quote         = get_option( 'options_deposito_quote', 'Merupakan investasi anda baik secara individu maupun perusahaan dalam bentuk deposito yang sesuai dengan prinsip syariah yakni Mudharabah Muthlaqah, pilihan tepat bagi anda berinvestasi sekaligus juga ibadah.' );
    $dep_akad          = get_option( 'options_deposito_akad', 'Mudharabah Muthlaqah' );
    $dep_min           = get_option( 'options_deposito_min_penempatan', 'Rp 5.000.000' );
    $dep_tenor         = get_option( 'options_deposito_tenor_list', '1 Bulan, 3 Bulan, 6 Bulan, 12 Bulan' );
    $dep_keunggulan    = get_option( 'options_deposito_keunggulan', "Prinsip murni Mudharabah Muthlaqah (bebas riba & gharar)\nNisbah bagi hasil kompetitif dan adil\nPilihan jangka waktu fleksibel (1, 3, 6, dan 12 bulan)\nFasilitas ARO (Automatic Roll Over) pokok atau pokok + bagi hasil\nDapat dijadikan agunan/jaminan pembiayaan syariah\nDijamin Lembaga Penjamin Simpanan (LPS) hingga Rp 2 Miliar" );
    $dep_syarat_ind    = get_option( 'options_deposito_syarat_individu', "Mengisi formulir permohonan pembukaan bilyet Deposito Mudharabah\nFotokopi e-KTP / Paspor pemohon yang masih berlaku\nFotokopi NPWP pemohon\nMemiliki rekening tabungan di BPRS Wakalumi sebagai rekening penampung bagi hasil\nNominal penempatan minimal Rp 5.000.000" );
    $dep_syarat_lem    = get_option( 'options_deposito_syarat_lembaga', "Mengisi formulir pembukaan rekening Deposito Lembaga / Perusahaan\nFotokopi Akta Pendirian Perusahaan & Perubahan Anggaran Dasar Terakhir\nFotokopi NIB (Nomor Induk Berusaha) / SIUP & TDP\nFotokopi NPWP Perusahaan / Yayasan\nFotokopi e-KTP Pengurus / Direksi yang berwenang menandatangani bilyet\nSurat Kuasa Direksi (jika dikuasakan)\nNominal penempatan minimal Rp 10.000.000" );

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
                    💰 Pengelolaan Produk: Simpanan & Deposito
                </h1>
                <p style="color: #64748b; font-size: 13px; margin: 0;">
                    Kelola daftar produk <strong>Tabungan Syariah (Dinamis Repeater)</strong> serta <strong>Deposito Mudharabah</strong> secara terpadu.
                </p>
            </div>
            <div style="display: flex; gap: 8px;">
                <a href="<?php echo esc_url( home_url( '/produk/tabungan-syariah' ) ); ?>" target="_blank" class="button" style="display: inline-flex; align-items: center; gap: 4px;">
                    👁️ Buka Halaman Tabungan
                </a>
                <a href="<?php echo esc_url( home_url( '/produk/deposito-syariah' ) ); ?>" target="_blank" class="button" style="display: inline-flex; align-items: center; gap: 4px;">
                    👁️ Buka Halaman Deposito
                </a>
            </div>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field( 'wakalumi_produk_dana_nonce' ); ?>

            <!-- NAVIGATION TABS -->
            <div style="display: flex; gap: 8px; border-bottom: 2px solid #e2e8f0; margin-bottom: 25px;">
                <button type="button" class="wkl-tab-btn active" data-tab="tab-tabungan" style="padding: 10px 20px; font-size: 14px; font-weight: 700; border: none; background: none; cursor: pointer; border-bottom: 3px solid #088395; color: #088395;">
                    📖 1. Kelola Produk Tabungan (Dinamis)
                </button>
                <button type="button" class="wkl-tab-btn" data-tab="tab-deposito" style="padding: 10px 20px; font-size: 14px; font-weight: 600; border: none; background: none; cursor: pointer; border-bottom: 3px solid transparent; color: #64748b;">
                    🏛️ 2. Deposito Mudharabah
                </button>
                <button type="button" class="wkl-tab-btn" data-tab="tab-kontak" style="padding: 10px 20px; font-size: 14px; font-weight: 600; border: none; background: none; cursor: pointer; border-bottom: 3px solid transparent; color: #64748b;">
                    💬 3. Hotline & Banner CTA
                </button>
            </div>

            <!-- ========================================================
                 TAB 1: TABUNGAN SYARIAH (REPEATER DINAMIS)
                 ======================================================== -->
            <div id="tab-tabungan" class="wkl-tab-content" style="display: block;">
                <!-- Header Banner Tabungan -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        📌 Header Banner: Halaman Tabungan Syariah
                    </h2>
                    <table class="form-table" style="margin: 0;">
                        <tr>
                            <th style="width: 220px;"><label for="options_tabungan_page_badge">Kicker / Badge Atas</label></th>
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
                    </table>
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
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Pesan WhatsApp Kustom (Opsional)</label>
                                    <input type="text" name="tab_wa_text[]" value="<?php echo esc_attr( $prod['wa_text'] ?? '' ); ?>" class="regular-text" style="width: 100%;" placeholder="Pesan otomatis saat klik Buka Rekening">
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

                <!-- 🧮 PENGATURAN KALKULATOR SIMULASI TABUNGAN -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        🧮 Pengaturan Teks Kalkulator Rencana Menabung
                    </h2>
                    <table class="form-table" style="margin: 0;">
                        <tr>
                            <th style="width: 220px;"><label for="options_tabungan_calc_badge">Badge / Kicker Atas</label></th>
                            <td>
                                <input type="text" id="options_tabungan_calc_badge" name="options_tabungan_calc_badge" value="<?php echo esc_attr( $tab_calc_badge ); ?>" class="regular-text" style="width: 100%; max-width: 450px;" placeholder="misal: Simulasi Finansial Syariah">
                                <p class="description">Label kecil di atas judul kalkulator (menggantikan tulisan kaku "Tool Interaktif").</p>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_calc_title">Judul Utama Kalkulator</label></th>
                            <td>
                                <input type="text" id="options_tabungan_calc_title" name="options_tabungan_calc_title" value="<?php echo esc_attr( $tab_calc_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;">
                            </td>
                        </tr>
                        <tr>
                            <th><label for="options_tabungan_calc_subtitle">Deskripsi / Subtitle</label></th>
                            <td>
                                <textarea id="options_tabungan_calc_subtitle" name="options_tabungan_calc_subtitle" rows="3" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $tab_calc_sub ); ?></textarea>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- ❓ PENGATURAN TANYA JAWAB (FAQ / QnA) TABUNGAN -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; flex-wrap: wrap; gap: 10px;">
                        <div>
                            <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin: 0 0 4px 0;">
                                ❓ Tanya Jawab (FAQ / QnA) Tabungan Syariah
                            </h2>
                            <p style="margin: 0; font-size: 12px; color: #64748b;">
                                Kelola daftar pertanyaan & jawaban umum yang ditampilkan pada halaman Tabungan Syariah.
                            </p>
                        </div>
                        <button type="button" id="btn-add-faq" class="button" style="background: #0f766e; color: #fff; border-color: #0d9488; font-weight: bold;">
                            ➕ Tambah Tanya Jawab Baru
                        </button>
                    </div>

                    <table class="form-table" style="margin-bottom: 20px;">
                        <tr>
                            <th style="width: 220px;"><label for="options_tabungan_faq_badge">Badge / Label FAQ</label></th>
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
                                        🗑️ Hapus Pertanyaan
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
            </div>

            <!-- ========================================================
                 TAB 2: DEPOSITO MUDHARABAH
                 ======================================================== -->
            <div id="tab-deposito" class="wkl-tab-content" style="display: none;">
                <!-- Header Banner Deposito -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        📌 Header Banner: Halaman Deposito Mudharabah
                    </h2>
                    <table class="form-table" style="margin: 0;">
                        <tr>
                            <th style="width: 220px;"><label for="options_deposito_page_badge">Kicker / Badge Atas</label></th>
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
                </div>

                <!-- Rincian & Ketentuan Deposito -->
                <div style="background: #fff; border: 1px solid #cbd5e1; border-left: 5px solid #059669; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h3 style="font-size: 16px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 16px;">
                        💎 Ketentuan & Persyaratan Deposito
                    </h3>
                    <table class="form-table" style="margin: 0;">
                        <tr>
                            <th style="width: 220px;"><label for="options_deposito_akad">Akad Syariah</label></th>
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
                        <tr>
                            <th><label for="options_deposito_keunggulan">Poin Keunggulan Deposito<br><small style="color: #64748b; font-weight: normal;">(1 poin per baris)</small></label></th>
                            <td><textarea id="options_deposito_keunggulan" name="options_deposito_keunggulan" rows="5" class="large-text" style="width: 100%; max-width: 650px; font-family: monospace;"><?php echo esc_textarea( $dep_keunggulan ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_syarat_individu">Syarat Nasabah Individu<br><small style="color: #64748b; font-weight: normal;">(1 syarat per baris)</small></label></th>
                            <td><textarea id="options_deposito_syarat_individu" name="options_deposito_syarat_individu" rows="4" class="large-text" style="width: 100%; max-width: 650px; font-family: monospace;"><?php echo esc_textarea( $dep_syarat_ind ); ?></textarea></td>
                        </tr>
                        <tr>
                            <th><label for="options_deposito_syarat_lembaga">Syarat Badan Usaha / Lembaga<br><small style="color: #64748b; font-weight: normal;">(1 syarat per baris)</small></label></th>
                            <td><textarea id="options_deposito_syarat_lembaga" name="options_deposito_syarat_lembaga" rows="5" class="large-text" style="width: 100%; max-width: 650px; font-family: monospace;"><?php echo esc_textarea( $dep_syarat_lem ); ?></textarea></td>
                        </tr>
                    </table>
                </div>

                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 16px; margin-bottom: 25px;">
                    <p style="margin: 0; color: #166534; font-size: 13px; line-height: 1.5;">
                        💡 <strong>Catatan Pengelolaan Nisbah Bagi Hasil Deposito:</strong> Porsi nisbah nasabah, nisbah bank, dan <em>equivalent rate</em> bulanan secara otomatis tersinkronisasi dari menu <strong><a href="<?php echo admin_url( 'admin.php?page=wakalumi-settings&tab=nisbah' ); ?>" target="_blank" style="color: #15803d; font-weight: bold; text-decoration: underline;">Pengaturan Wakalumi &rarr; Informasi Nisbah</a></strong>. Setiap perubahan data di tabel nisbah akan langsung terupdate di halaman Deposito dan kalkulator simulasi.
                    </p>
                </div>
            </div>

            <!-- ========================================================
                 TAB 3: HOTLINE & CTA BANNER
                 ======================================================== -->
            <div id="tab-kontak" class="wkl-tab-content" style="display: none;">
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                        💬 Hotline WhatsApp & Call to Action Produk
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
                    💾 Simpan Semua Pengaturan Produk
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
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Pesan WhatsApp Kustom (Opsional)</label>
                    <input type="text" name="tab_wa_text[]" value="" class="regular-text" style="width: 100%;" placeholder="Pesan otomatis pembukaan">
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

    <!-- TEMPLATE: FAQ ITEM CLONE -->
    <template id="tabungan-faq-template">
        <div class="tabungan-faq-item" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                <strong style="color: #0f172a; font-size: 13px;">
                    Q#<span class="wkl-faq-num">1</span>
                </strong>
                <button type="button" class="button-link wkl-btn-remove-faq" style="color: #ef4444; font-size: 12px; text-decoration: none;">
                    🗑️ Hapus Pertanyaan
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

    <!-- TAB & REPEATER JAVASCRIPT -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching
        var tabBtns = document.querySelectorAll('.wkl-tab-btn');
        var tabContents = document.querySelectorAll('.wkl-tab-content');

        tabBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var target = this.getAttribute('data-tab');

                tabBtns.forEach(function(b) {
                    b.style.borderBottomColor = 'transparent';
                    b.style.color = '#64748b';
                    b.style.fontWeight = '600';
                });
                this.style.borderBottomColor = '#088395';
                this.style.color = '#088395';
                this.style.fontWeight = '700';

                tabContents.forEach(function(content) {
                    if (content.id === target) {
                        content.style.display = 'block';
                    } else {
                        content.style.display = 'none';
                    }
                });
            });
        });

        // Repeater Tabungan functions
        var listContainer = document.getElementById('tabungan-repeater-list');
        var addBtn = document.getElementById('btn-add-tabungan');
        var tmpl = document.getElementById('tabungan-card-template');

        function updateNumbers() {
            var items = listContainer.querySelectorAll('.tabungan-card-item');
            items.forEach(function(item, idx) {
                var numSpan = item.querySelector('.wkl-item-num');
                if (numSpan) numSpan.textContent = (idx + 1);
            });
        }

        function bindCardEvents(card) {
            var removeBtn = card.querySelector('.wkl-btn-remove-tabungan');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin menghapus produk tabungan ini?')) {
                        card.remove();
                        updateNumbers();
                    }
                });
            }

            var nameInput = card.querySelector('.wkl-tab-name-input');
            var titlePreview = card.querySelector('.wkl-card-title-preview');
            if (nameInput && titlePreview) {
                nameInput.addEventListener('input', function() {
                    titlePreview.textContent = this.value || 'Produk Baru';
                });
            }
        }

        // Bind existing items
        var existingCards = listContainer.querySelectorAll('.tabungan-card-item');
        existingCards.forEach(function(c) {
            bindCardEvents(c);
        });

        // Add new card
        if (addBtn && tmpl && listContainer) {
            addBtn.addEventListener('click', function() {
                var clone = tmpl.content.cloneNode(true);
                var newCard = clone.querySelector('.tabungan-card-item');
                var count = listContainer.querySelectorAll('.tabungan-card-item').length + 1;
                
                var urutanInput = newCard.querySelector('input[name="tab_urutan[]"]');
                if (urutanInput) urutanInput.value = count;

                bindCardEvents(newCard);
                listContainer.appendChild(newCard);
                updateNumbers();
                newCard.scrollIntoView({ behavior: 'smooth' });
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
                newItem.scrollIntoView({ behavior: 'smooth' });
            });
        }
    });
    </script>
    <?php
}
