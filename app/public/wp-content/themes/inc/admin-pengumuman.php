<?php
/**
 * Admin Page: Pengelolaan Pengumuman Resmi & Surat Edaran
 * Submenu of wakalumi-settings
 * 
 * Mengelola sistem pengumuman resmi terpadu:
 * 1. Halaman Induk Pengumuman Resmi (page-pengumuman.php)
 * 2. Hybrid Notification System: Floating Toast Kontras di Beranda & Pop-Up Darurat
 * 3. Arsip multi-pengumuman, kategori, lampiran PDF, dan kontrol urgensi
 * 
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// ── 1. HELPER CONFIG & DATA RETRIEVAL ────────────────────────────────

if ( ! function_exists( 'wakalumi_get_pengumuman_categories' ) ) {
    /**
     * Daftar kategori resmi pengumuman beserta metadata warna dan badge.
     *
     * @return array
     */
    function wakalumi_get_pengumuman_categories() {
        return [
            'operasional' => [
                'name'         => 'operasional',
                'label'        => 'Operasional & Libur Layanan',
                'pill_label'   => 'Operasional & Layanan',
                'color'        => 'sky',
                'badge_class'  => 'bg-sky-500/10 dark:bg-sky-950/60 text-sky-700 dark:text-sky-300 border-sky-300/60 dark:border-sky-700/60',
                'tag_dot'      => 'bg-sky-500',
                'icon'         => 'clock',
            ],
            'keamanan' => [
                'name'         => 'keamanan',
                'label'        => 'Keamanan & Anti-Fraud (Peringatan)',
                'pill_label'   => 'Keamanan & Waspada Penipuan',
                'color'        => 'amber',
                'badge_class'  => 'bg-amber-500/10 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border-amber-300/60 dark:border-amber-700/60',
                'tag_dot'      => 'bg-amber-500',
                'icon'         => 'shield',
            ],
            'lelang' => [
                'name'         => 'lelang',
                'label'        => 'Lelang Agunan / Hak Tanggungan',
                'pill_label'   => 'Lelang Agunan',
                'color'        => 'blue',
                'badge_class'  => 'bg-blue-500/10 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 border-blue-300/60 dark:border-blue-700/60',
                'tag_dot'      => 'bg-blue-500',
                'icon'         => 'gavel',
            ],
            'regulasi' => [
                'name'         => 'regulasi',
                'label'        => 'Regulasi, RUPS & Keterbukaan',
                'pill_label'   => 'Regulasi & Corporate',
                'color'        => 'purple',
                'badge_class'  => 'bg-purple-500/10 dark:bg-purple-950/60 text-purple-700 dark:text-purple-300 border-purple-300/60 dark:border-purple-700/60',
                'tag_dot'      => 'bg-purple-500',
                'icon'         => 'document',
            ],
            'produk' => [
                'name'         => 'produk',
                'label'        => 'Produk, Nisbah & Promo Syariah',
                'pill_label'   => 'Produk & Nisbah',
                'color'        => 'emerald',
                'badge_class'  => 'bg-emerald-500/10 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border-emerald-300/60 dark:border-emerald-700/60',
                'tag_dot'      => 'bg-emerald-500',
                'icon'         => 'sparkles',
            ],
            'umum' => [
                'name'         => 'umum',
                'label'        => 'Pengumuman Umum & Lainnya',
                'pill_label'   => 'Umum',
                'color'        => 'teal',
                'badge_class'  => 'bg-teal-500/10 dark:bg-teal-950/60 text-teal-700 dark:text-teal-300 border-teal-300/60 dark:border-teal-700/60',
                'tag_dot'      => 'bg-teal-500',
                'icon'         => 'megaphone',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_announcement_icon' ) ) {
    /**
     * Mengembalikan SVG icon untuk kategori pengumuman.
     *
     * @param string $icon_name
     * @return string
     */
    function wakalumi_get_announcement_icon( $icon_name = 'megaphone' ) {
        switch ( $icon_name ) {
            case 'clock':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>';
            case 'shield':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>';
            case 'gavel':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>';
            case 'document':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" /></svg>';
            case 'sparkles':
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" /></svg>';
            case 'megaphone':
            default:
                return '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>';
        }
    }
}

if ( ! function_exists( 'wakalumi_get_pengumuman_header' ) ) {
    /**
     * Konfigurasi Header Banner & Watermark Card untuk Halaman Pengumuman.
     *
     * @return array
     */
    function wakalumi_get_pengumuman_header() {
        return [
            'badge'      => get_option( 'options_pengumuman_badge', 'Pemberitahuan Resmi' ),
            'title'      => get_option( 'options_pengumuman_title', 'Pengumuman Resmi & Surat Edaran BPRS Wakalumi' ),
            'desc'       => get_option( 'options_pengumuman_desc', 'Pusat publikasi informasi resmi, penyesuaian jam operasional layanan, pengumuman lelang agunan, peringatan keamanan transaksi nasabah, serta keterbukaan informasi perbankan syariah yang amanah.' ),
            'card_badge' => get_option( 'options_pengumuman_card_badge', 'Pemberitahuan Resmi BPRS' ),
            'card_title' => get_option( 'options_pengumuman_card_title', 'Akurat, Terpercaya & Transparan' ),
            'card_desc'  => get_option( 'options_pengumuman_card_desc', 'Seluruh pengumuman diterbitkan secara sah oleh Manajemen PT BPRS Wakalumi serta tunduk pada kepatuhan OJK dan prinsip syariah DSN-MUI.' ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_pengumuman_toast_settings' ) ) {
    /**
     * Konfigurasi Tampilan Toast & Pop-Up Beranda.
     *
     * @return array
     */
    function wakalumi_get_pengumuman_toast_settings() {
        return [
            'toast_active'   => get_option( 'options_pengumuman_toast_active', '1' ),
            'toast_title'    => get_option( 'options_pengumuman_toast_title', 'Pemberitahuan Resmi' ),
            'toast_duration'    => (int) get_option( 'options_pengumuman_toast_duration', 7 ),
            'popup_active'      => get_option( 'options_pengumuman_popup_active', '1' ),
            'popup_badge_text'  => get_option( 'options_pengumuman_popup_badge_text', 'Pengumuman Penting' ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_pengumuman_list' ) ) {
    /**
     * Mengambil daftar lengkap seluruh pengumuman (Aktif & Arsip).
     *
     * @return array
     */
    function wakalumi_get_pengumuman_list() {
        $list = get_option( 'options_pengumuman_list', [] );
        if ( ! empty( $list ) && is_array( $list ) ) {
            // Sort by urutan ASC
            usort( $list, function( $a, $b ) {
                return (int)( $a['urutan'] ?? 0 ) <=> (int)( $b['urutan'] ?? 0 );
            });
            return $list;
        }

        // Default Starter Announcements (Pre-populated)
        return [
            [
                'id'          => 'ann_1',
                'judul'       => 'Penyesuaian Jadwal Layanan Kantor Operasional Hari Raya Idul Fitri 1447 H',
                'kategori'    => 'operasional',
                'urgensi'     => 'penting',
                'tanggal'     => date( 'Y-m-d' ),
                'nomor_surat' => 'No. 028/DIR-WKL/SE/IV/2026',
                'ringkasan'   => 'Sehubungan dengan Hari Raya Idul Fitri dan cuti bersama yang ditetapkan Pemerintah, kantor operasional BPRS Wakalumi tutup sementara dan layanan tatap muka kembali normal sesuai jadwal yang terlampir.',
                'isi_lengkap' => "Yth. Seluruh Nasabah dan Mitra BPRS Wakalumi,\n\nMenindaklanjuti Keputusan Bersama Pemerintah Republik Indonesia mengenai Hari Libur Nasional dan Cuti Bersama Hari Raya Idul Fitri 1447 H, dengan ini kami sampaikan penyesuaian jadwal operasional kantor:\n\n1. Layanan Tatap Muka Kantor Operasional TUTUP sementara mulai tanggal cuti bersama.\n2. Seluruh jaringan kantor kas dan kantor cabang akan BUKA KEMBALI melayani nasabah secara normal pada hari kerja berikutnya pukul 08.00 WIB.\n3. Layanan transaksi perbankan tetap dapat diakses melalui saluran mitra dan komunikasi WhatsApp resmi bank kami.\n\nDemikian pengumuman ini kami sampaikan. Segenap Direksi, Dewan Pengawas Syariah, dan Karyawan BPRS Wakalumi mengucapkan Selamat Hari Raya Idul Fitri, Mohon Maaf Lahir dan Batin.",
                'file_pdf'    => '',
                'file_size'   => 'PDF Resmi • 1.2 MB',
                'gambar'      => '',
                'is_toast'    => '1',
                'is_popup'    => '1',
                'status'      => 'aktif',
                'urutan'      => 1,
            ],
            [
                'id'          => 'ann_2',
                'judul'       => 'Himbauan Keamanan: Waspada Modus Penipuan Mengatasnamakan BPRS Wakalumi',
                'kategori'    => 'keamanan',
                'urgensi'     => 'penting',
                'tanggal'     => date( 'Y-m-d', strtotime( '-5 days' ) ),
                'nomor_surat' => 'No. 015/DIR-WKL/HMB/II/2026',
                'ringkasan'   => 'Waspada terhadap modus penipuan berkedok hadiah, undian, atau permintaan data pribadi (OTP, PIN, Password). BPRS Wakalumi tidak pernah meminta biaya transfer ke rekening pribadi perorangan.',
                'isi_lengkap' => "Yth. Nasabah Setia Bank Syariah Wakalumi,\n\nKami menghimbau kepada seluruh nasabah dan masyarakat agar selalu meningkatkan kewaspadaan terhadap maraknya penipuan daring yang mengatasnamakan PT BPRS Wakalumi.\n\nMohon perhatikan hal-hal krusial berikut:\n1. BPRS Wakalumi TIDAK PERNAH meminta kode OTP, PIN, Password, maupun data rahasia lainnya kepada nasabah melalui media apapun.\n2. Seluruh transaksi pembiayaan dan pembukaan rekening hanya diproses melalui rekening resmi perseroan (PT BPRS Wakalumi), BUKAN atas nama perorangan atau staf pribadi.\n3. Kanal informasi dan layanan resmi kami hanya dapat diakses melalui nomor WhatsApp resmi Customer Service yang tertera di website ini.\n\nBila Anda menerima pesan mencurigakan, segera konfirmasi dan laporkan ke layanan pengaduan konsumen kami.",
                'file_pdf'    => '',
                'file_size'   => 'PDF Resmi • 850 KB',
                'gambar'      => '',
                'is_toast'    => '1',
                'is_popup'    => '0',
                'status'      => 'aktif',
                'urutan'      => 2,
            ],
            [
                'id'          => 'ann_3',
                'judul'       => 'Pengumuman Pelaksanaan Lelang Eksekusi Hak Tanggungan Agunan Pembiayaan',
                'kategori'    => 'lelang',
                'urgensi'     => 'normal',
                'tanggal'     => date( 'Y-m-d', strtotime( '-14 days' ) ),
                'nomor_surat' => 'No. 008/LELANG-WKL/I/2026',
                'ringkasan'   => 'Pengumuman pelaksanaan lelang eksekusi hak tanggungan atas agunan pembiayaan bekerjasama dengan Kantor Pelayanan Kekayaan Negara dan Lelang (KPKNL) secara terbuka melalui portal resmi lelang.',
                'isi_lengkap' => "Berdasarkan Pasal 6 Undang-Undang Hak Tanggungan No. 4 Tahun 1996, PT BPRS Wakalumi dengan perantaraan Kantor Pelayanan Kekayaan Negara dan Lelang (KPKNL) akan melaksanakan Lelang Eksekusi Hak Tanggungan atas objek jaminan yang telah memenuhi syarat lelang perbankan.\n\nSyarat dan Ketentuan Lelang:\n1. Penawaran lelang dilakukan secara tertulis tanpa kehadiran peserta lelang melalui aplikasi resmi Lelang Indonesia (portal KPKNL).\n2. Peserta lelang wajib menyetorkan uang jaminan lelang sesuai nominal pengumuman sebelum batas waktu penutupan.\n3. Objek lelang dijual dalam kondisi apa adanya (as is) dengan segala kekurangan dan konsekuensi hukumnya.\n\nInformasi lengkap mengenai rincian batas tanah, sertifikat hak milik, dan nilai limit lelang dapat dilihat pada lampiran surat edaran resmi.",
                'file_pdf'    => '',
                'file_size'   => 'PDF Resmi • 2.1 MB',
                'gambar'      => '',
                'is_toast'    => '1',
                'is_popup'    => '0',
                'status'      => 'aktif',
                'urutan'      => 3,
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_active_toast_pengumuman' ) ) {
    /**
     * Mengambil daftar pengumuman aktif yang diatur tampil di Toast Beranda.
     *
     * @return array
     */
    function wakalumi_get_active_toast_pengumuman() {
        $all = wakalumi_get_pengumuman_list();
        $filtered = array_filter( $all, function( $item ) {
            return ( ( $item['status'] ?? 'aktif' ) === 'aktif' ) && ( ! empty( $item['is_toast'] ) );
        });
        return array_values( $filtered );
    }
}

if ( ! function_exists( 'wakalumi_get_active_popup_pengumuman_list' ) ) {
    /**
     * Mengambil seluruh pengumuman darurat aktif yang diatur sebagai Pop-Up Beranda.
     *
     * @return array Daftar pengumuman pop-up aktif.
     */
    function wakalumi_get_active_popup_pengumuman_list() {
        $all = wakalumi_get_pengumuman_list();
        $filtered = array_filter( $all, function( $item ) {
            return ( ( $item['status'] ?? 'aktif' ) === 'aktif' ) && ( ! empty( $item['is_popup'] ) );
        });
        return array_values( $filtered );
    }
}

if ( ! function_exists( 'wakalumi_get_active_popup_pengumuman' ) ) {
    /**
     * Mengambil pengumuman darurat aktif pertama yang diatur sebagai Pop-Up Beranda.
     *
     * @return array|null Mengembalikan 1 pengumuman paling mendesak/pertama, atau null.
     */
    function wakalumi_get_active_popup_pengumuman() {
        $list = wakalumi_get_active_popup_pengumuman_list();
        return $list[0] ?? null;
    }
}


// ── 2. MENU REGISTRATION & ASSETS ───────────────────────────────────

add_action( 'admin_menu', 'wakalumi_register_pengumuman_page', 27 );
function wakalumi_register_pengumuman_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Pengumuman Resmi Nasabah',
        'Pengumuman Resmi',
        'manage_options',
        'wakalumi-pengumuman',
        'wakalumi_render_pengumuman_page'
    );
}

add_action( 'admin_enqueue_scripts', 'wakalumi_pengumuman_admin_assets' );
function wakalumi_pengumuman_admin_assets( $hook ) {
    if ( strpos( $hook, 'wakalumi-pengumuman' ) !== false ) {
        wp_enqueue_media();
    }
}


// ── 3. RENDER ADMIN INTERFACE & SAVE CONTROLLER ─────────────────────

function wakalumi_render_pengumuman_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Akses ditolak.' );
    }

    // Handle Form Submission
    if ( isset( $_POST['wakalumi_save_pengumuman'] ) && check_admin_referer( 'wakalumi_pengumuman_action', 'wakalumi_pengumuman_nonce' ) ) {
        // 1. Header & Watermark Card Options
        update_option( 'options_pengumuman_badge', sanitize_text_field( $_POST['options_pengumuman_badge'] ?? '' ) );
        update_option( 'options_pengumuman_title', sanitize_text_field( $_POST['options_pengumuman_title'] ?? '' ) );
        update_option( 'options_pengumuman_desc', sanitize_textarea_field( $_POST['options_pengumuman_desc'] ?? '' ) );
        update_option( 'options_pengumuman_card_badge', sanitize_text_field( $_POST['options_pengumuman_card_badge'] ?? '' ) );
        update_option( 'options_pengumuman_card_title', sanitize_text_field( $_POST['options_pengumuman_card_title'] ?? '' ) );
        update_option( 'options_pengumuman_card_desc', sanitize_textarea_field( $_POST['options_pengumuman_card_desc'] ?? '' ) );

        // 2. Global Toast & Popup Options
        update_option( 'options_pengumuman_toast_active', isset( $_POST['options_pengumuman_toast_active'] ) ? '1' : '0' );
        update_option( 'options_pengumuman_toast_title', sanitize_text_field( $_POST['options_pengumuman_toast_title'] ?? 'Pemberitahuan Resmi' ) );
        update_option( 'options_pengumuman_toast_duration', max( 3, (int)( $_POST['options_pengumuman_toast_duration'] ?? 7 ) ) );
        update_option( 'options_pengumuman_popup_active', isset( $_POST['options_pengumuman_popup_active'] ) ? '1' : '0' );
        update_option( 'options_pengumuman_popup_badge_text', sanitize_text_field( $_POST['options_pengumuman_popup_badge_text'] ?? 'Pengumuman Penting' ) );

        // 3. Process Announcement Items Repeater
        $juduls       = $_POST['pengumuman_judul'] ?? [];
        $ids          = $_POST['pengumuman_id'] ?? [];
        $kategoris    = $_POST['pengumuman_kategori'] ?? [];
        $urgensis     = $_POST['pengumuman_urgensi'] ?? [];
        $tanggals     = $_POST['pengumuman_tanggal'] ?? [];
        $nomor_surats = $_POST['pengumuman_nomor_surat'] ?? [];
        $ringkasans   = $_POST['pengumuman_ringkasan'] ?? [];
        $isi_lengkaps = $_POST['pengumuman_isi_lengkap'] ?? [];
        $gambars      = $_POST['pengumuman_gambar'] ?? [];
        $file_pdfs    = $_POST['pengumuman_file_pdf'] ?? [];
        $file_sizes   = $_POST['pengumuman_file_size'] ?? [];
        $is_toasts    = $_POST['pengumuman_is_toast'] ?? [];
        $is_popups    = $_POST['pengumuman_is_popup'] ?? [];
        $link_actives = $_POST['pengumuman_link_active'] ?? [];
        $link_texts   = $_POST['pengumuman_link_text'] ?? [];
        $link_urls    = $_POST['pengumuman_link_url'] ?? [];
        $link_targets = $_POST['pengumuman_link_target'] ?? [];
        $statuses     = $_POST['pengumuman_status'] ?? [];
        $urutans      = $_POST['pengumuman_urutan'] ?? [];

        $saved_list = [];
        $count = count( $juduls );

        for ( $i = 0; $i < $count; $i++ ) {
            $judul = sanitize_text_field( $juduls[$i] ?? '' );
            if ( empty( $judul ) ) {
                continue; // Skip empty row
            }

            $id_val = sanitize_key( $ids[$i] ?? '' );
            if ( empty( $id_val ) ) {
                $id_val = 'ann_' . time() . '_' . $i;
            }

            $saved_list[] = [
                'id'          => $id_val,
                'judul'       => $judul,
                'kategori'    => sanitize_key( $kategoris[$i] ?? 'umum' ),
                'urgensi'     => sanitize_key( $urgensis[$i] ?? 'normal' ),
                'tanggal'     => sanitize_text_field( $tanggals[$i] ?? date( 'Y-m-d' ) ),
                'nomor_surat' => sanitize_text_field( $nomor_surats[$i] ?? '' ),
                'ringkasan'   => sanitize_textarea_field( $ringkasans[$i] ?? '' ),
                'isi_lengkap' => sanitize_textarea_field( $isi_lengkaps[$i] ?? '' ),
                'gambar'      => esc_url_raw( $gambars[$i] ?? '' ),
                'file_pdf'    => esc_url_raw( $file_pdfs[$i] ?? '' ),
                'file_size'   => sanitize_text_field( $file_sizes[$i] ?? 'PDF Resmi' ),
                'link_active' => ( in_array( $id_val, (array) $link_actives, true ) || ( isset( $link_actives[$i] ) && $link_actives[$i] === '1' ) ) ? '1' : '0',
                'link_text'   => sanitize_text_field( $link_texts[$i] ?? '' ),
                'link_url'    => esc_url_raw( $link_urls[$i] ?? '' ),
                'link_target' => ( ( $link_targets[$i] ?? '_blank' ) === '_self' ) ? '_self' : '_blank',
                'is_toast'    => ( in_array( $id_val, (array) $is_toasts, true ) || ( isset( $is_toasts[$i] ) && $is_toasts[$i] === '1' ) ) ? '1' : '0',
                'is_popup'    => ( in_array( $id_val, (array) $is_popups, true ) || ( isset( $is_popups[$i] ) && $is_popups[$i] === '1' ) ) ? '1' : '0',
                'status'      => sanitize_key( $statuses[$i] ?? 'aktif' ),
                'urutan'      => (int)( $urutans[$i] ?? ( $i + 1 ) ),
            ];
        }

        update_option( 'options_pengumuman_list', $saved_list );

        echo '<div class="notice notice-success is-dismissible" style="margin-top: 15px; border-left-color: #088395;"><p><strong>✅ Pengaturan Pengumuman Resmi & Notifikasi Berhasil Disimpan!</strong></p></div>';
    }

    // Retrieve Current Data
    $header         = wakalumi_get_pengumuman_header();
    $toast_settings = wakalumi_get_pengumuman_toast_settings();
    $categories     = wakalumi_get_pengumuman_categories();
    $pengumuman_list= wakalumi_get_pengumuman_list();

    $active_count = count( array_filter( $pengumuman_list, fn($x) => ( $x['status'] ?? '' ) === 'aktif' ) );
    $popup_count  = count( array_filter( $pengumuman_list, fn($x) => ! empty( $x['is_popup'] ) && ( $x['status'] ?? '' ) === 'aktif' ) );
    ?>
    <div class="wrap" style="max-width: 1060px; margin-top: 20px;">

        <!-- Header Title Bar -->
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #e2e8f0;">
            <div>
                <h1 style="display: flex; align-items: center; gap: 10px; font-size: 24px; font-weight: 800; color: #0f172a; margin: 0;">
                    <span class="dashicons dashicons-megaphone" style="font-size: 32px; width: 32px; height: 32px; color: #088395;"></span>
                    Pengumuman Resmi & Notifikasi Terpadu
                </h1>
                <p style="margin: 6px 0 0 42px; color: #64748b; font-size: 13px;">
                    Kelola arsip pengumuman resmi, surat edaran PDF, toast notification kontras di beranda, serta pop-up darurat nasabah.
                </p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="<?php echo esc_url( home_url( '/pengumuman/' ) ); ?>" target="_blank" class="button" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600;">
                    <span class="dashicons dashicons-external"></span> Lihat Halaman Pengumuman
                </a>
            </div>
        </div>

        <form method="post" action="" id="wakalumi-pengumuman-form">
            <?php wp_nonce_field( 'wakalumi_pengumuman_action', 'wakalumi_pengumuman_nonce' ); ?>

            <!-- STATS QUICK COUNTER -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 25px;">
                <div style="background: #ffffff; padding: 18px; border-radius: 12px; border: 1px solid #cbd5e1; border-left: 5px solid #088395; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">Total Pengumuman</div>
                    <div style="font-size: 26px; font-weight: 800; color: #0f172a; margin-top: 4px;"><?php echo count( $pengumuman_list ); ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">dokumen</span></div>
                </div>
                <div style="background: #ffffff; padding: 18px; border-radius: 12px; border: 1px solid #cbd5e1; border-left: 5px solid #10b981; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">Status Aktif Publikasi</div>
                    <div style="font-size: 26px; font-weight: 800; color: #047857; margin-top: 4px;"><?php echo $active_count; ?> <span style="font-size: 13px; font-weight: 500; color: #64748b;">terbit</span></div>
                </div>
                <div style="background: #ffffff; padding: 18px; border-radius: 12px; border: 1px solid #cbd5e1; border-left: 5px solid #f59e0b; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">Pop-Up Modal Beranda</div>
                    <div style="font-size: 26px; font-weight: 800; color: #b45309; margin-top: 4px;"><?php echo $popup_count > 0 ? 'AKTIF (' . $popup_count . ')' : 'NON-AKTIF'; ?></div>
                </div>
            </div>

            <!-- SECTION 1: HYBRID BERANDA NOTIFICATION CONTROLS -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; margin-bottom: 18px;">
                    <div>
                        <h2 style="font-size: 17px; font-weight: 700; color: #088395; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <span class="dashicons dashicons-bell" style="color: #088395;"></span>
                            Pengaturan Integrasi Beranda (Hybrid: Toast Kontras & Pop-Up Penting)
                        </h2>
                        <p style="color: #64748b; font-size: 13px; margin: 4px 0 0 0;">
                            Pengumuman di beranda tampil berupa notifikasi floating card di sisi kanan bawah, serta pop-up tengah layar khusus pengumuman yang diutamakan.
                        </p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <!-- Toast Setting Card -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px;">
                        <h3 style="font-size: 14px; font-weight: 700; color: #1e293b; margin-top: 0; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                            <span class="dashicons dashicons-slides" style="color: #088395;"></span>
                            Floating Toast Notification (Kanan Bawah Layar)
                        </h3>
                        <label style="display: flex; align-items: center; gap: 8px; font-weight: 600; cursor: pointer; margin-bottom: 12px;">
                            <input type="checkbox" name="options_pengumuman_toast_active" value="1" <?php checked( $toast_settings['toast_active'], '1' ); ?>>
                            Aktifkan Floating Toast di Halaman Beranda
                        </label>

                        <div style="margin-bottom: 10px;">
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 4px;">Label Header Toast:</label>
                            <input type="text" name="options_pengumuman_toast_title" value="<?php echo esc_attr( $toast_settings['toast_title'] ); ?>" class="large-text" style="border-radius: 6px;">
                        </div>

                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 4px;">Durasi Rotasi Slider Multi-Pengumuman (Detik):</label>
                            <input type="number" min="3" max="30" name="options_pengumuman_toast_duration" value="<?php echo esc_attr( $toast_settings['toast_duration'] ); ?>" style="width: 100px; border-radius: 6px;">
                            <span style="font-size: 12px; color: #64748b; margin-left: 6px;">detik per slide (otomatis pause saat kursor di atasnya)</span>
                        </div>
                    </div>

                    <!-- Pop-Up Setting Card -->
                    <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 10px; padding: 18px;">
                        <h3 style="font-size: 14px; font-weight: 700; color: #b45309; margin-top: 0; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                            <span class="dashicons dashicons-megaphone" style="color: #d97706;"></span>
                            Pop-Up Modal di Beranda (Tengah Layar)
                        </h3>
                        <label style="display: flex; align-items: center; gap: 8px; font-weight: 600; cursor: pointer; color: #92400e; margin-bottom: 12px;">
                            <input type="checkbox" name="options_pengumuman_popup_active" value="1" <?php checked( $toast_settings['popup_active'], '1' ); ?>>
                            Aktifkan Fitur Pop-Up di Beranda
                        </label>
                        <div style="margin-bottom: 10px;">
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #78350f; margin-bottom: 4px;">Label Badge Pop-up (Dinamis):</label>
                            <input type="text" name="options_pengumuman_popup_badge_text" value="<?php echo esc_attr( $toast_settings['popup_badge_text'] ); ?>" class="large-text" placeholder="Contoh: Pengumuman Penting" style="border-radius: 6px; border-color: #fcd34d;">
                            <span style="font-size: 11px; color: #92400e;">Redaksional badge bagian atas pop-up (contoh: <em>Pengumuman Penting</em> atau <em>Informasi Resmi</em>).</span>
                        </div>
                        <p style="font-size: 12px; color: #92400e; line-height: 1.5; margin: 0; padding-top: 6px; border-top: 1px dashed #fcd34d;">
                            💡 <strong>Catatan:</strong> Pop-up hanya muncul jika opsi di atas aktif <em>DAN</em> ada pengumuman di bawah yang dicentang <strong>"Tampilkan sebagai Pop-Up Modal di Beranda"</strong>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: HEADER BANNER & BADGE WATERMARK CARD -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
                <h2 style="font-size: 17px; font-weight: 700; color: #088395; margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-art" style="color: #088395;"></span>
                    Header Banner & Governance Watermark Card (Halaman Pengumuman)
                </h2>

                <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 24px; margin-top: 15px;">
                    <!-- Left: Hero Text -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px;">
                        <h3 style="font-size: 13px; font-weight: 700; text-transform: uppercase; color: #475569; margin-top: 0; margin-bottom: 12px; letter-spacing: 0.05em;">
                            Sisi Kiri: Hero Text Banner
                        </h3>
                        <div style="margin-bottom: 12px;">
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">Pill Badge Hero:</label>
                            <input type="text" name="options_pengumuman_badge" value="<?php echo esc_attr( $header['badge'] ); ?>" class="large-text" style="border-radius: 6px;">
                        </div>
                        <div style="margin-bottom: 12px;">
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">Judul Utama Halaman:</label>
                            <input type="text" name="options_pengumuman_title" value="<?php echo esc_attr( $header['title'] ); ?>" class="large-text" style="border-radius: 6px; font-weight: 600;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 4px;">Deskripsi Pengantar:</label>
                            <textarea name="options_pengumuman_desc" rows="4" class="large-text" style="border-radius: 6px;"><?php echo esc_textarea( $header['desc'] ); ?></textarea>
                        </div>
                    </div>

                    <!-- Right: Governance Badge Card (Watermark) -->
                    <div style="background: #f0fdfa; border: 1px solid #ccfbf1; border-radius: 10px; padding: 18px;">
                        <h3 style="font-size: 13px; font-weight: 700; text-transform: uppercase; color: #0f766e; margin-top: 0; margin-bottom: 12px; letter-spacing: 0.05em;">
                            Sisi Kanan: Governance Card (Watermark)
                        </h3>
                        <div style="margin-bottom: 12px;">
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #0f766e; margin-bottom: 4px;">Pill Badge Kartu:</label>
                            <input type="text" name="options_pengumuman_card_badge" value="<?php echo esc_attr( $header['card_badge'] ); ?>" class="large-text" style="border-radius: 6px;">
                        </div>
                        <div style="margin-bottom: 12px;">
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #0f766e; margin-bottom: 4px;">Judul Komitmen Kartu:</label>
                            <input type="text" name="options_pengumuman_card_title" value="<?php echo esc_attr( $header['card_title'] ); ?>" class="large-text" style="border-radius: 6px; font-weight: 600;">
                        </div>
                        <div style="margin-bottom: 12px;">
                            <label style="display: block; font-size: 12px; font-weight: 600; color: #0f766e; margin-bottom: 4px;">Deskripsi Kepatuhan Kartu:</label>
                            <textarea name="options_pengumuman_card_desc" rows="3" class="large-text" style="border-radius: 6px;"><?php echo esc_textarea( $header['card_desc'] ); ?></textarea>
                        </div>
                        <p style="font-size: 11px; color: #0d9488; margin: 0;">
                            ✨ Kartu ini otomatis dilengkapi logo watermark meluncur (slide animation), lambang resmi syariah, serta tanda <strong>"Diawasi OJK • Dijamin LPS"</strong>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: REPEATER DAFTAR PENGUMUMAN RESMI -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 4px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px; margin-bottom: 20px;">
                    <div>
                        <h2 style="font-size: 17px; font-weight: 700; color: #088395; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <span class="dashicons dashicons-list-view" style="color: #088395;"></span>
                            Daftar Multi-Pengumuman Resmi & Surat Edaran
                        </h2>
                        <p style="color: #64748b; font-size: 13px; margin: 4px 0 0 0;">
                            Tambahkan, ubah, atau hapus pengumuman resmi. Tentukan pengumuman mana yang tampil di Toast dan mana yang menjadi Pop-Up Darurat.
                        </p>
                    </div>
                    <button type="button" id="btn-add-pengumuman" class="button button-primary" style="background: #088395; border-color: #066e7d; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; padding: 4px 16px;">
                        <span class="dashicons dashicons-plus-alt2" style="margin-top: 2px;"></span> + Tambah Pengumuman Baru
                    </button>
                </div>

                <!-- Announcement Repeater Container -->
                <div id="pengumuman-repeater-container" style="display: flex; flex-direction: column; gap: 18px;">
                    <?php if ( empty( $pengumuman_list ) ) : ?>
                        <div id="no-pengumuman-notice" style="text-align: center; padding: 40px; background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 10px; color: #64748b;">
                            <span class="dashicons dashicons-megaphone" style="font-size: 40px; width: 40px; height: 40px; color: #94a3b8; margin-bottom: 10px;"></span>
                            <p style="font-size: 14px; margin: 0;">Belum ada pengumuman yang ditambahkan. Klik tombol <strong>+ Tambah Pengumuman Baru</strong> di atas untuk memulai.</p>
                        </div>
                    <?php else : ?>
                        <?php foreach ( $pengumuman_list as $index => $item ) : 
                            $row_id      = esc_attr( $item['id'] ?? ( 'ann_' . $index ) );
                            $judul       = $item['judul'] ?? '';
                            $kategori    = $item['kategori'] ?? 'umum';
                            $urgensi     = $item['urgensi'] ?? 'normal';
                            $tanggal     = $item['tanggal'] ?? date( 'Y-m-d' );
                            $nomor_surat = $item['nomor_surat'] ?? '';
                            $ringkasan   = $item['ringkasan'] ?? '';
                            $isi_lengkap = $item['isi_lengkap'] ?? '';
                            $gambar      = $item['gambar'] ?? '';
                            $file_pdf    = $item['file_pdf'] ?? '';
                            $file_size   = $item['file_size'] ?? 'PDF Resmi';
                            $link_active = ! empty( $item['link_active'] );
                            $link_text   = $item['link_text'] ?? '';
                            $link_url    = $item['link_url'] ?? '';
                            $link_target = $item['link_target'] ?? '_blank';
                            $is_toast    = ! empty( $item['is_toast'] );
                            $is_popup    = ! empty( $item['is_popup'] );
                            $status      = $item['status'] ?? 'aktif';
                            $urutan      = $item['urutan'] ?? ( $index + 1 );
                        ?>
                            <div class="pengumuman-card" data-index="<?php echo $index; ?>" style="background: #ffffff; border: 1px solid #cbd5e1; border-left: 5px solid <?php echo $urgensi === 'penting' ? '#f59e0b' : '#088395'; ?>; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.04); overflow: hidden; transition: all 0.2s ease;">
                                <!-- Card Header (Clickable to collapse/expand) -->
                                <div class="pengumuman-card-header" style="padding: 14px 18px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none;">
                                    <div style="display: flex; align-items: center; gap: 12px; flex: 1; min-width: 0;">
                                        <span class="dashicons dashicons-move" style="color: #94a3b8; cursor: grab;" title="Geser untuk urutan"></span>
                                        <span class="pengumuman-card-number" style="font-weight: 800; font-size: 13px; color: #475569; background: #e2e8f0; padding: 2px 8px; border-radius: 4px;">#<?php echo ( $index + 1 ); ?></span>
                                        <div style="min-width: 0; flex: 1;">
                                            <div class="pengumuman-preview-title" style="font-weight: 700; font-size: 14px; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                <?php echo esc_html( $judul ? $judul : '(Belum ada judul pengumuman)' ); ?>
                                            </div>
                                            <div style="display: flex; align-items: center; gap: 8px; font-size: 11px; color: #64748b; margin-top: 3px; flex-wrap: wrap;">
                                                <span>📅 <?php echo esc_html( $tanggal ); ?></span>
                                                <span>•</span>
                                                <span style="text-transform: capitalize;">🏷️ <?php echo esc_html( $categories[$kategori]['label'] ?? $kategori ); ?></span>
                                                <?php if ( ! empty( $gambar ) ) : ?>
                                                    <span style="background: #e0f2fe; color: #0369a1; font-weight: 700; padding: 1px 6px; border-radius: 4px; font-size: 10px;">🖼️ GAMBAR</span>
                                                <?php endif; ?>
                                                <?php if ( $link_active && ! empty( $link_url ) ) : ?>
                                                    <span style="background: #f0fdf4; color: #166534; font-weight: 700; padding: 1px 6px; border-radius: 4px; font-size: 10px;">🔗 LINK TOMBOL</span>
                                                <?php endif; ?>
                                                <?php if ( $urgensi === 'penting' ) : ?>
                                                    <span style="background: #fef3c7; color: #b45309; font-weight: 700; padding: 1px 6px; border-radius: 4px; font-size: 10px;">⚡ PENTING</span>
                                                <?php endif; ?>
                                                <?php if ( $is_popup ) : ?>
                                                    <span style="background: #fef3c7; color: #92400e; font-weight: 700; padding: 1px 6px; border-radius: 4px; font-size: 10px;">⚡ POP-UP</span>
                                                <?php endif; ?>
                                                <?php if ( $is_toast ) : ?>
                                                    <span style="background: #ccfbf1; color: #0f766e; font-weight: 700; padding: 1px 6px; border-radius: 4px; font-size: 10px;">🔔 TOAST</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <button type="button" class="btn-toggle-card button-link" style="color: #64748b; text-decoration: none;" title="Buka / Tutup Form">
                                            <span class="dashicons dashicons-arrow-down-alt2"></span>
                                        </button>
                                        <button type="button" class="btn-delete-card button-link" style="color: #ef4444; text-decoration: none; padding: 4px 6px;" title="Hapus Pengumuman Ini">
                                            <span class="dashicons dashicons-trash"></span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Card Body (Form Fields) -->
                                <div class="pengumuman-card-body" style="padding: 20px;">
                                    <input type="hidden" name="pengumuman_id[]" value="<?php echo esc_attr( $row_id ); ?>">
                                    <input type="hidden" name="pengumuman_urutan[]" value="<?php echo esc_attr( $urutan ); ?>" class="card-urutan-input">

                                    <!-- Row 1: Judul & Kategori -->
                                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 14px;">
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Judul Pengumuman *</label>
                                            <input type="text" name="pengumuman_judul[]" value="<?php echo esc_attr( $judul ); ?>" class="large-text pengumuman-judul-input" placeholder="Contoh: Penyesuaian Jadwal Layanan Kantor Operasional" required style="border-radius: 6px; font-weight: 600;">
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Kategori Informasi</label>
                                            <select name="pengumuman_kategori[]" class="large-text" style="border-radius: 6px;">
                                                <?php foreach ( $categories as $ckey => $cval ) : ?>
                                                    <option value="<?php echo esc_attr( $ckey ); ?>" <?php selected( $kategori, $ckey ); ?>>
                                                        <?php echo esc_html( $cval['label'] ); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Row: Gambar Poster / Banner Visual Pengumuman (Opsional) -->
                                    <div style="margin-bottom: 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                                            🖼️ Gambar Poster / Banner Visual Pengumuman (Opsional)
                                        </label>
                                        <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                                            <img id="img_prev_<?php echo $row_id; ?>" src="<?php echo esc_url( $gambar ); ?>" style="width: 70px; height: 46px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; <?php echo empty( $gambar ) ? 'display:none;' : ''; ?>" />
                                            <input type="text" id="img_<?php echo $row_id; ?>" name="pengumuman_gambar[]" value="<?php echo esc_attr( $gambar ); ?>" class="large-text" placeholder="https://.../poster-pengumuman.jpg" style="flex: 1; min-width: 200px; border-radius: 6px;">
                                            <button type="button" class="button wkl-upload-img-btn" data-target="img_<?php echo $row_id; ?>" data-preview="img_prev_<?php echo $row_id; ?>" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600; white-space: nowrap;">
                                                <span class="dashicons dashicons-format-image"></span> Pilih Gambar
                                            </button>
                                            <button type="button" class="button-link wkl-remove-img-btn" data-target="img_<?php echo $row_id; ?>" data-preview="img_prev_<?php echo $row_id; ?>" style="color: #ef4444; font-size: 12px; <?php echo empty( $gambar ) ? 'display:none;' : ''; ?>">
                                                ✕ Hapus
                                            </button>
                                        </div>
                                        <p style="font-size: 11px; color: #64748b; margin: 4px 0 0 0;">
                                            Format: JPG, PNG, atau WebP. Gambar ini akan tampil sebagai poster visual di kartu pengumuman, modal rincian, dan pop-up beranda.
                                        </p>
                                    </div>

                                    <!-- Row 2: Nomor Surat, Tanggal, Urgensi, Status -->
                                    <div style="display: grid; grid-template-columns: 1.2fr 1fr 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Nomor Surat Edaran (Opsional)</label>
                                            <input type="text" name="pengumuman_nomor_surat[]" value="<?php echo esc_attr( $nomor_surat ); ?>" class="large-text" placeholder="Contoh: No. 028/DIR-WKL/SE/IV/2026" style="border-radius: 6px;">
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tanggal Terbit</label>
                                            <input type="date" name="pengumuman_tanggal[]" value="<?php echo esc_attr( $tanggal ); ?>" class="large-text" style="border-radius: 6px;">
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tingkat Urgensi</label>
                                            <select name="pengumuman_urgensi[]" class="large-text pengumuman-urgensi-select" style="border-radius: 6px;">
                                                <option value="normal" <?php selected( $urgensi, 'normal' ); ?>>Normal (Informasi Reguler)</option>
                                                <option value="penting" <?php selected( $urgensi, 'penting' ); ?>>⚡ Penting / Diutamakan</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Status Publikasi</label>
                                            <select name="pengumuman_status[]" class="large-text" style="border-radius: 6px;">
                                                <option value="aktif" <?php selected( $status, 'aktif' ); ?>>Aktif (Tampil Publik)</option>
                                                <option value="arsip" <?php selected( $status, 'arsip' ); ?>>Arsip (Disembunyikan)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Row 3: Ringkasan Singkat (Ditampilkan di Kartu / Toast) -->
                                    <div style="margin-bottom: 14px;">
                                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                                            Ringkasan Singkat (1–2 Kalimat, Ditampilkan di Toast Beranda & Pratinjau Kartu) *
                                        </label>
                                        <textarea name="pengumuman_ringkasan[]" rows="2" class="large-text" placeholder="Tuliskan ringkasan pokok pengumuman yang jelas dan mudah dipahami dalam 1-2 kalimat..." required style="border-radius: 6px;"><?php echo esc_textarea( $ringkasan ); ?></textarea>
                                    </div>

                                    <!-- Row 4: Konten Detail / Isi Lengkap -->
                                    <div style="margin-bottom: 14px;">
                                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                                            Isi Lengkap Pengumuman (Ditampilkan saat Modal Dibuka) *
                                        </label>
                                        <textarea name="pengumuman_isi_lengkap[]" rows="5" class="large-text" placeholder="Tuliskan penjelasan lengkap, poin-poin keputusan, instruksi nasabah, dll..." required style="border-radius: 6px; font-family: monospace; font-size: 13px;"><?php echo esc_textarea( $isi_lengkap ); ?></textarea>
                                    </div>

                                    <!-- Row 5: Lampiran Dokumen PDF Resmi -->
                                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px; margin-bottom: 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                                                Lampiran Surat Edaran / Dokumen PDF (Opsional)
                                            </label>
                                            <div style="display: flex; gap: 8px;">
                                                <input type="text" id="pdf_<?php echo $row_id; ?>" name="pengumuman_file_pdf[]" value="<?php echo esc_attr( $file_pdf ); ?>" class="large-text pdf-url-input" placeholder="https://.../surat-edaran.pdf" style="border-radius: 6px;">
                                                <button type="button" class="button wkl-upload-pdf-btn" data-target="pdf_<?php echo $row_id; ?>" data-size-target="size_<?php echo $row_id; ?>" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600; white-space: nowrap;">
                                                    <span class="dashicons dashicons-upload"></span> Pilih PDF
                                                </button>
                                            </div>
                                        </div>
                                        <div>
                                            <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Label Ukuran Dokumen</label>
                                            <input type="text" id="size_<?php echo $row_id; ?>" name="pengumuman_file_size[]" value="<?php echo esc_attr( $file_size ); ?>" class="large-text" placeholder="Contoh: PDF Resmi • 1.4 MB" style="border-radius: 6px;">
                                        </div>
                                    </div>

                                    <!-- Row: Tombol Tautan / Link Aksi Khusus (Opsional) -->
                                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 12px 14px; margin-bottom: 14px;">
                                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                                            <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 700; color: #166534; cursor: pointer;">
                                                <input type="checkbox" name="pengumuman_link_active[]" value="<?php echo esc_attr( $row_id ); ?>" <?php checked( $link_active ); ?>>
                                                🔗 Aktifkan Tombol Tautan / Link Aksi Khusus
                                            </label>
                                            <span style="font-size: 11px; color: #15803d; background: #dcfce7; padding: 1px 7px; border-radius: 4px; font-weight: 600;">
                                                Halaman / URL Luar
                                            </span>
                                        </div>
                                        <div style="display: grid; grid-template-columns: 1.5fr 2fr 1fr; gap: 10px;">
                                            <div>
                                                <label style="display: block; font-size: 11px; font-weight: 700; color: #334155; margin-bottom: 3px;">Teks Label Tombol</label>
                                                <input type="text" name="pengumuman_link_text[]" value="<?php echo esc_attr( $link_text ); ?>" class="large-text" placeholder="Contoh: Daftar Sekarang, Kunjungi Portal..." style="border-radius: 6px; font-size: 12px;">
                                            </div>
                                            <div>
                                                <label style="display: block; font-size: 11px; font-weight: 700; color: #334155; margin-bottom: 3px;">URL / Link Tujuan</label>
                                                <input type="text" name="pengumuman_link_url[]" value="<?php echo esc_attr( $link_url ); ?>" class="large-text" placeholder="https://... atau /produk/pembiayaan/" style="border-radius: 6px; font-size: 12px;">
                                            </div>
                                            <div>
                                                <label style="display: block; font-size: 11px; font-weight: 700; color: #334155; margin-bottom: 3px;">Buka di</label>
                                                <select name="pengumuman_link_target[]" class="large-text" style="border-radius: 6px; font-size: 12px;">
                                                    <option value="_blank" <?php selected( $link_target, '_blank' ); ?>>Tab Baru (_blank)</option>
                                                    <option value="_self" <?php selected( $link_target, '_self' ); ?>>Tab Ini (_self)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row 6: Tampilan di Beranda (Checkboxes) -->
                                    <div style="display: flex; gap: 24px; padding-top: 6px; border-top: 1px dashed #e2e8f0;">
                                        <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #0f766e; cursor: pointer;">
                                            <input type="checkbox" name="pengumuman_is_toast[]" value="<?php echo esc_attr( $row_id ); ?>" <?php checked( $is_toast ); ?>>
                                            🔔 Tampilkan di Floating Toast Beranda
                                        </label>
                                        <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #b45309; cursor: pointer;">
                                            <input type="checkbox" name="pengumuman_is_popup[]" value="<?php echo esc_attr( $row_id ); ?>" <?php checked( $is_popup ); ?>>
                                            ⭐ Tampilkan sebagai Pop-Up Modal di Beranda
                                        </label>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div style="margin-top: 20px; text-align: center;">
                    <button type="button" id="btn-add-pengumuman-bottom" class="button" style="border: 2px dashed #088395; color: #088395; font-weight: 700; padding: 6px 20px; border-radius: 8px; width: 100%;">
                        + Tambah Pengumuman Baru Lainnya
                    </button>
                </div>
            </div>

            <!-- SUBMIT BUTTON BAR (STICKY) -->
            <div style="position: sticky; bottom: 20px; z-index: 100; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border: 1px solid #cbd5e1; border-radius: 12px; padding: 14px 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); display: flex; align-items: center; justify-content: space-between;">
                <span style="font-size: 13px; color: #64748b; font-weight: 600;">
                    💡 Pastikan seluruh perubahan telah diperiksa sebelum menekan tombol simpan.
                </span>
                <input type="submit" name="wakalumi_save_pengumuman" value="💾 Simpan Semua Pengaturan & Pengumuman" class="button button-primary" style="background: #088395; border-color: #066e7d; font-size: 14px; font-weight: 700; padding: 4px 24px; border-radius: 6px;">
            </div>

        </form>
    </div>

    <!-- TEMPLATE UNTUK ADD PENGUMUMAN BARU VIA JS -->
    <template id="tmpl-pengumuman-card">
        <div class="pengumuman-card" data-index="{{index}}" style="background: #ffffff; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.04); overflow: hidden; transition: all 0.2s ease;">
            <div class="pengumuman-card-header" style="padding: 14px 18px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none;">
                <div style="display: flex; align-items: center; gap: 12px; flex: 1; min-width: 0;">
                    <span class="dashicons dashicons-move" style="color: #94a3b8; cursor: grab;" title="Geser untuk urutan"></span>
                    <span class="pengumuman-card-number" style="font-weight: 800; font-size: 13px; color: #475569; background: #e2e8f0; padding: 2px 8px; border-radius: 4px;">#{{num}}</span>
                    <div style="min-width: 0; flex: 1;">
                        <div class="pengumuman-preview-title" style="font-weight: 700; font-size: 14px; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            (Pengumuman Baru — Belum Disimpan)
                        </div>
                        <div style="display: flex; align-items: center; gap: 8px; font-size: 11px; color: #64748b; margin-top: 3px;">
                            <span>📅 <?php echo date( 'Y-m-d' ); ?></span>
                            <span>•</span>
                            <span>🏷️ Umum & Pengumuman</span>
                            <span style="background: #dbeafe; color: #1e40af; font-weight: 700; padding: 1px 6px; border-radius: 4px; font-size: 10px;">BARU</span>
                        </div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <button type="button" class="btn-toggle-card button-link" style="color: #64748b; text-decoration: none;" title="Buka / Tutup Form">
                        <span class="dashicons dashicons-arrow-down-alt2"></span>
                    </button>
                    <button type="button" class="btn-delete-card button-link" style="color: #ef4444; text-decoration: none; padding: 4px 6px;" title="Hapus Pengumuman Ini">
                        <span class="dashicons dashicons-trash"></span>
                    </button>
                </div>
            </div>

            <div class="pengumuman-card-body" style="padding: 20px;">
                <input type="hidden" name="pengumuman_id[]" value="{{row_id}}">
                <input type="hidden" name="pengumuman_urutan[]" value="{{num}}" class="card-urutan-input">

                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Judul Pengumuman *</label>
                        <input type="text" name="pengumuman_judul[]" value="" class="large-text pengumuman-judul-input" placeholder="Tuliskan judul pengumuman resmi..." required style="border-radius: 6px; font-weight: 600;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Kategori Informasi</label>
                        <select name="pengumuman_kategori[]" class="large-text" style="border-radius: 6px;">
                            <?php foreach ( $categories as $ckey => $cval ) : ?>
                                <option value="<?php echo esc_attr( $ckey ); ?>">
                                    <?php echo esc_html( $cval['label'] ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Row: Gambar Poster / Banner Visual Pengumuman (Opsional) -->
                <div style="margin-bottom: 14px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                        🖼️ Gambar Poster / Banner Visual Pengumuman (Opsional)
                    </label>
                    <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <img id="img_prev_{{row_id}}" src="" style="width: 70px; height: 46px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; display:none;" />
                        <input type="text" id="img_{{row_id}}" name="pengumuman_gambar[]" value="" class="large-text" placeholder="https://.../poster-pengumuman.jpg" style="flex: 1; min-width: 200px; border-radius: 6px;">
                        <button type="button" class="button wkl-upload-img-btn" data-target="img_{{row_id}}" data-preview="img_prev_{{row_id}}" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600; white-space: nowrap;">
                            <span class="dashicons dashicons-format-image"></span> Pilih Gambar
                        </button>
                        <button type="button" class="button-link wkl-remove-img-btn" data-target="img_{{row_id}}" data-preview="img_prev_{{row_id}}" style="color: #ef4444; font-size: 12px; display:none;">
                            ✕ Hapus
                        </button>
                    </div>
                    <p style="font-size: 11px; color: #64748b; margin: 4px 0 0 0;">
                        Format: JPG, PNG, atau WebP. Gambar ini akan tampil sebagai poster visual di kartu pengumuman, modal rincian, dan pop-up beranda.
                    </p>
                </div>

                <div style="display: grid; grid-template-columns: 1.2fr 1fr 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Nomor Surat Edaran (Opsional)</label>
                        <input type="text" name="pengumuman_nomor_surat[]" value="" class="large-text" placeholder="Contoh: No. 028/DIR-WKL/SE/IV/2026" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tanggal Terbit</label>
                        <input type="date" name="pengumuman_tanggal[]" value="<?php echo date( 'Y-m-d' ); ?>" class="large-text" style="border-radius: 6px;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Tingkat Urgensi</label>
                        <select name="pengumuman_urgensi[]" class="large-text pengumuman-urgensi-select" style="border-radius: 6px;">
                            <option value="normal">Normal (Informasi Reguler)</option>
                            <option value="penting">⚡ Penting / Diutamakan</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Status Publikasi</label>
                        <select name="pengumuman_status[]" class="large-text" style="border-radius: 6px;">
                            <option value="aktif">Aktif (Tampil Publik)</option>
                            <option value="arsip">Arsip (Disembunyikan)</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                        Ringkasan Singkat (1–2 Kalimat, Ditampilkan di Toast Beranda & Pratinjau Kartu) *
                    </label>
                    <textarea name="pengumuman_ringkasan[]" rows="2" class="large-text" placeholder="Tuliskan ringkasan pokok pengumuman yang jelas dan mudah dipahami dalam 1-2 kalimat..." required style="border-radius: 6px;"></textarea>
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                        Isi Lengkap Pengumuman (Ditampilkan saat Modal Dibuka) *
                    </label>
                    <textarea name="pengumuman_isi_lengkap[]" rows="5" class="large-text" placeholder="Tuliskan penjelasan lengkap, poin-poin keputusan, instruksi nasabah, dll..." required style="border-radius: 6px; font-family: monospace; font-size: 13px;"></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 14px; margin-bottom: 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px;">
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">
                            Lampiran Surat Edaran / Dokumen PDF (Opsional)
                        </label>
                        <div style="display: flex; gap: 8px;">
                            <input type="text" id="pdf_{{row_id}}" name="pengumuman_file_pdf[]" value="" class="large-text pdf-url-input" placeholder="https://.../surat-edaran.pdf" style="border-radius: 6px;">
                            <button type="button" class="button wkl-upload-pdf-btn" data-target="pdf_{{row_id}}" data-size-target="size_{{row_id}}" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600; white-space: nowrap;">
                                <span class="dashicons dashicons-upload"></span> Pilih PDF
                            </button>
                        </div>
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Label Ukuran Dokumen</label>
                        <input type="text" id="size_{{row_id}}" name="pengumuman_file_size[]" value="PDF Resmi" class="large-text" placeholder="Contoh: PDF Resmi • 1.4 MB" style="border-radius: 6px;">
                    </div>
                </div>

                <!-- Row: Tombol Tautan / Link Aksi Khusus (Opsional) -->
                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 12px 14px; margin-bottom: 14px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                        <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 700; color: #166534; cursor: pointer;">
                            <input type="checkbox" name="pengumuman_link_active[]" value="{{row_id}}">
                            🔗 Aktifkan Tombol Tautan / Link Aksi Khusus
                        </label>
                        <span style="font-size: 11px; color: #15803d; background: #dcfce7; padding: 1px 7px; border-radius: 4px; font-weight: 600;">
                            Halaman / URL Luar
                        </span>
                    </div>
                    <div style="display: grid; grid-template-columns: 1.5fr 2fr 1fr; gap: 10px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #334155; margin-bottom: 3px;">Teks Label Tombol</label>
                            <input type="text" name="pengumuman_link_text[]" value="" class="large-text" placeholder="Contoh: Daftar Sekarang, Kunjungi Portal..." style="border-radius: 6px; font-size: 12px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #334155; margin-bottom: 3px;">URL / Link Tujuan</label>
                            <input type="text" name="pengumuman_link_url[]" value="" class="large-text" placeholder="https://... atau /produk/pembiayaan/" style="border-radius: 6px; font-size: 12px;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #334155; margin-bottom: 3px;">Buka di</label>
                            <select name="pengumuman_link_target[]" class="large-text" style="border-radius: 6px; font-size: 12px;">
                                <option value="_blank">Tab Baru (_blank)</option>
                                <option value="_self">Tab Ini (_self)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 24px; padding-top: 6px; border-top: 1px dashed #e2e8f0;">
                    <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #0f766e; cursor: pointer;">
                        <input type="checkbox" name="pengumuman_is_toast[]" value="{{row_id}}" checked>
                        🔔 Tampilkan di Floating Toast Beranda
                    </label>
                    <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: #b45309; cursor: pointer;">
                        <input type="checkbox" name="pengumuman_is_popup[]" value="{{row_id}}">
                        ⭐ Tampilkan sebagai Pop-Up Modal di Beranda
                    </label>
                </div>
            </div>
        </div>
    </template>

    <!-- ADMIN JS JQUERY SCRIPT -->
    <script>
    jQuery(document).ready(function($) {
        // Toggle Collapse Card
        $(document).on('click', '.pengumuman-card-header', function(e) {
            if ($(e.target).closest('.btn-delete-card').length) return;
            var body = $(this).closest('.pengumuman-card').find('.pengumuman-card-body');
            var icon = $(this).find('.btn-toggle-card .dashicons');
            body.slideToggle(200);
            if (icon.hasClass('dashicons-arrow-down-alt2')) {
                icon.removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
            } else {
                icon.removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');
            }
        });

        // Live preview title update
        $(document).on('input', '.pengumuman-judul-input', function() {
            var val = $(this).val().trim();
            var preview = $(this).closest('.pengumuman-card').find('.pengumuman-preview-title');
            preview.text(val || '(Belum ada judul pengumuman)');
        });

        // Urgensi border color update
        $(document).on('change', '.pengumuman-urgensi-select', function() {
            var card = $(this).closest('.pengumuman-card');
            if ($(this).val() === 'penting') {
                card.css('border-left-color', '#f59e0b');
            } else {
                card.css('border-left-color', '#088395');
            }
        });

        // Add Card Logic
        $('#btn-add-pengumuman, #btn-add-pengumuman-bottom').on('click', function(e) {
            e.preventDefault();
            $('#no-pengumuman-notice').hide();
            var container = $('#pengumuman-repeater-container');
            var count = container.find('.pengumuman-card').length;
            var num = count + 1;
            var rowId = 'ann_' + Date.now();
            var templateHtml = $('#tmpl-pengumuman-card').html();

            templateHtml = templateHtml.replace(/\{\{index\}\}/g, count);
            templateHtml = templateHtml.replace(/\{\{num\}\}/g, num);
            templateHtml = templateHtml.replace(/\{\{row_id\}\}/g, rowId);

            var newCard = $(templateHtml);
            container.append(newCard);
            newCard.hide().slideDown(250);
            $('html, body').animate({
                scrollTop: newCard.offset().top - 80
            }, 300);
        });

        // Delete Card Logic
        $(document).on('click', '.btn-delete-card', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (confirm('Yakin ingin menghapus pengumuman ini?')) {
                var card = $(this).closest('.pengumuman-card');
                card.slideUp(200, function() {
                    card.remove();
                    reindexCards();
                });
            }
        });

        function reindexCards() {
            var cards = $('#pengumuman-repeater-container .pengumuman-card');
            if (cards.length === 0) {
                $('#no-pengumuman-notice').show();
            }
            cards.each(function(i) {
                $(this).find('.pengumuman-card-number').text('#' + (i + 1));
                $(this).find('.card-urutan-input').val(i + 1);
            });
        }

        // Media Uploader for Gambar Poster Visual
        $(document).on('click', '.wkl-upload-img-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $('#' + btn.data('target'));
            var previewImg  = $('#' + btn.data('preview'));
            var removeBtn   = btn.siblings('.wkl-remove-img-btn');

            var customUploader = wp.media({
                title: 'Pilih atau Unggah Poster Visual Pengumuman',
                button: { text: 'Gunakan Gambar Ini' },
                multiple: false,
                library: { type: 'image' }
            });

            customUploader.on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                if (previewImg.length) {
                    previewImg.attr('src', attachment.url).show();
                }
                if (removeBtn.length) {
                    removeBtn.show();
                }
            });

            customUploader.open();
        });

        $(document).on('click', '.wkl-remove-img-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $('#' + btn.data('target'));
            var previewImg  = $('#' + btn.data('preview'));
            targetInput.val('');
            if (previewImg.length) {
                previewImg.hide().attr('src', '');
            }
            btn.hide();
        });

        // Media Uploader for PDF
        $(document).on('click', '.wkl-upload-pdf-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $('#' + btn.data('target'));
            var targetSize = $('#' + btn.data('size-target'));

            var customUploader = wp.media({
                title: 'Pilih Dokumen Surat Edaran / Pengumuman PDF',
                button: { text: 'Gunakan Dokumen Ini' },
                multiple: false,
                library: { type: 'application/pdf' }
            });

            customUploader.on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                if (attachment.filesizeHumanReadable && targetSize.length && (!targetSize.val() || targetSize.val() === 'PDF Resmi')) {
                    targetSize.val('PDF Resmi • ' + attachment.filesizeHumanReadable);
                } else if (targetSize.length && !targetSize.val()) {
                    targetSize.val('PDF Resmi');
                }
            });

            customUploader.open();
        });
    });
    </script>
    <?php
}

