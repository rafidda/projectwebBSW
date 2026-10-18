<?php
/**
 * Admin Page: Pengelolaan Info Lelang Agunan (AYDA)
 * Submenu of wakalumi-settings
 * 
 * Mengelola sistem katalog dan lelang agunan/AYDA perbankan syariah:
 * 1. Halaman Induk Info Lelang (page-lelang.php)
 * 2. Kepatuhan Regulasi POJK & Fatwa DSN-MUI (Transparan & Hak Nasabah)
 * 3. Arsip multi-aset (Rumah, Ruko, Tanah, Kendaraan), spesifikasi, harga limit, galeri foto, dan kontak PIC
 * 
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// ── 1. HELPER CONFIG & DATA RETRIEVAL ────────────────────────────────

if ( ! function_exists( 'wakalumi_get_lelang_categories' ) ) {
    /**
     * Daftar kategori aset lelang/AYDA resmi beserta metadata warna dan badge.
     *
     * @return array
     */
    function wakalumi_get_lelang_categories() {
        return [
            'rumah' => [
                'name'         => 'rumah',
                'label'        => 'Rumah Tinggal & Hunian',
                'pill_label'   => 'Rumah Tinggal',
                'color'        => 'teal',
                'badge_class'  => 'bg-teal-500/10 dark:bg-teal-950/60 text-teal-700 dark:text-teal-300 border-teal-300/60 dark:border-teal-700/60',
                'tag_dot'      => 'bg-teal-500',
                'icon'         => 'home',
            ],
            'ruko' => [
                'name'         => 'ruko',
                'label'        => 'Ruko & Komersial',
                'pill_label'   => 'Ruko / Usaha',
                'color'        => 'blue',
                'badge_class'  => 'bg-blue-500/10 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 border-blue-300/60 dark:border-blue-700/60',
                'tag_dot'      => 'bg-blue-500',
                'icon'         => 'building',
            ],
            'tanah' => [
                'name'         => 'tanah',
                'label'        => 'Tanah & Kavling',
                'pill_label'   => 'Tanah / Kavling',
                'color'        => 'emerald',
                'badge_class'  => 'bg-emerald-500/10 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border-emerald-300/60 dark:border-emerald-700/60',
                'tag_dot'      => 'bg-emerald-500',
                'icon'         => 'map',
            ],
            'kendaraan' => [
                'name'         => 'kendaraan',
                'label'        => 'Kendaraan & Otomotif',
                'pill_label'   => 'Kendaraan',
                'color'        => 'amber',
                'badge_class'  => 'bg-amber-500/10 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border-amber-300/60 dark:border-amber-700/60',
                'tag_dot'      => 'bg-amber-500',
                'icon'         => 'truck',
            ],
            'lainnya' => [
                'name'         => 'lainnya',
                'label'        => 'Lainnya / Aset Produktif',
                'pill_label'   => 'Lainnya',
                'color'        => 'purple',
                'badge_class'  => 'bg-purple-500/10 dark:bg-purple-950/60 text-purple-700 dark:text-purple-300 border-purple-300/60 dark:border-purple-700/60',
                'tag_dot'      => 'bg-purple-500',
                'icon'         => 'sparkles',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_lelang_statuses' ) ) {
    /**
     * Status ketersediaan lelang agunan.
     *
     * @return array
     */
    function wakalumi_get_lelang_statuses() {
        $statuses = [
            'tersedia' => [
                'name'            => 'tersedia',
                'label'           => 'Tersedia (Penjualan Sukarela / Siap Beli)',
                'badge_label'     => 'Tersedia',
                'badge_class'     => 'bg-emerald-500/10 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border-emerald-300/60 dark:border-emerald-700/60',
                'dot'             => 'bg-emerald-500',
                'desc'            => 'Dapat dibeli langsung secara tunai atau melalui fasilitas Pembiayaan Syariah BPRS Wakalumi.',
                'prosedur_title'  => 'Prosedur Pembelian Sukarela & Survei Fisik',
                'prosedur_desc'   => "Aset ini berstatus Penjualan Sukarela (AYDA) atas persetujuan debitur. Peminat dapat langsung menjadwalkan survei fisik bersama tim remedial BPRS Wakalumi dan dapat dibeli secara tunai maupun diajukan fasilitas Pembiayaan Kepemilikan Rumah (KPR) Syariah Wakalumi.",
                'kepatuhan_title' => 'Kepatuhan Syariah & Hukum (Penjualan Damai Sukarela):',
                'kepatuhan_desc'  => "Penjualan diselenggarakan secara damai berdasarkan persetujuan tertulis pihak debitur dengan prinsip tolong-menolong (ta'awun) dan bebas riba. Sesuai Fatwa DSN-MUI No. 47, seluruh kelebihan hasil penjualan setelah pelunasan sisa kewajiban piutang wajib diserahkan kembali kepada nasabah pemilik agunan.",
            ],
            'akan_dilelang' => [
                'name'            => 'akan_dilelang',
                'label'           => 'Akan Dilelang (Terjadwal di KPKNL)',
                'badge_label'     => 'Akan Dilelang',
                'badge_class'     => 'bg-amber-500/10 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border-amber-300/60 dark:border-amber-700/60',
                'dot'             => 'bg-amber-500',
                'desc'            => 'Lelang eksekusi Hak Tanggungan melalui portal lelang resmi negara (lelang.go.id).',
                'prosedur_title'  => 'Prosedur Keikutsertaan Lelang & Survei Fisik',
                'prosedur_desc'   => "Lelang eksekusi Hak Tanggungan dilaksanakan resmi secara closed/open bidding melalui portal negara lelang.go.id yang dikelola KPKNL. Penyetoran uang jaminan lelang dilakukan melalui Virtual Account (VA) yang diterbitkan lelang.go.id paling lambat 1 hari kalender sebelum pelaksanaan lelang. Peminat wajib melakukan survei fisik (*as is where is*) dan verifikasi berkas sebelum menyetor uang jaminan.",
                'kepatuhan_title' => 'Kepatuhan Hukum & Fatwa DSN-MUI (Eksekusi Hak Tanggungan):',
                'kepatuhan_desc'  => "Lelang dieksekusi berdasarkan Pasal 6 UU Hak Tanggungan No. 4/1996 dan diawasi Pejabat Lelang Negara KPKNL. Berdasarkan Fatwa DSN-MUI No. 47/DSN-MUI/II/2005, bank hanya berhak mengambil pelunasan pokok piutang dan biaya eksekusi riil, sedangkan seluruh kelebihan dana hasil lelang wajib dikembalikan utuh kepada debitur.",
            ],
            'terjual' => [
                'name'            => 'terjual',
                'label'           => 'Terjual / Selesai Likuidasi',
                'badge_label'     => 'Terjual',
                'badge_class'     => 'bg-slate-500/10 dark:bg-slate-800 text-slate-600 dark:text-slate-400 border-slate-300/60 dark:border-slate-700/60',
                'dot'             => 'bg-slate-400',
                'desc'            => 'Aset telah laku terlelang dan risalah lelang telah diselesaikan.',
                'prosedur_title'  => 'Informasi Status Likuidasi Aset',
                'prosedur_desc'   => "Aset ini telah berstatus Terjual / Selesai Likuidasi. Risalah lelang resmi atau akta jual beli telah diserahkan secara sah kepada pemenang lelang/pembeli. Halaman publikasi ini tidak lagi menerima pendaftaran penawaran baru untuk aset ini.",
                'kepatuhan_title' => 'Akuntabilitas & Penyelesaian Transaksi Syariah:',
                'kepatuhan_desc'  => "Proses likuidasi agunan telah berkekuatan hukum tetap (inkracht). Seluruh hak debitur atas kelebihan dana hasil likuidasi telah disalurkan kembali kepada pihak debitur secara amanah dan akuntabel sesuai ketentuan syariah.",
            ],
        ];

        // Override with custom values from DB if saved by admin
        foreach ( $statuses as $k => &$cfg ) {
            $opt_pt = get_option( "options_lelang_status_{$k}_prosedur_title", '' );
            if ( ! empty( $opt_pt ) ) {
                $cfg['prosedur_title'] = $opt_pt;
            }
            $opt_pd = get_option( "options_lelang_status_{$k}_prosedur_desc", '' );
            if ( ! empty( $opt_pd ) ) {
                $cfg['prosedur_desc'] = $opt_pd;
            }
            $opt_kt = get_option( "options_lelang_status_{$k}_kepatuhan_title", '' );
            if ( ! empty( $opt_kt ) ) {
                $cfg['kepatuhan_title'] = $opt_kt;
            }
            $opt_kd = get_option( "options_lelang_status_{$k}_kepatuhan_desc", '' );
            if ( ! empty( $opt_kd ) ) {
                $cfg['kepatuhan_desc'] = $opt_kd;
            }
        }

        return $statuses;
    }
}

if ( ! function_exists( 'wakalumi_get_lelang_header' ) ) {
    /**
     * Mengambil teks pengantar & badge hero halaman lelang agunan.
     *
     * @return array
     */
    function wakalumi_get_lelang_header() {
        $badge = get_option( 'options_lelang_badge', '' );
        if ( empty( $badge ) ) {
            $badge = 'Transparansi Likuidasi Agunan & AYDA';
        }

        $title = get_option( 'options_lelang_title', '' );
        if ( empty( $title ) ) {
            $title = 'Info Lelang Agunan & Penjualan Aset';
        }

        $desc = get_option( 'options_lelang_desc', '' );
        if ( empty( $desc ) ) {
            $desc = 'Portal resmi publikasi lelang eksekusi Hak Tanggungan dan penjualan Agunan Yang Diambil Alih (AYDA) PT BPRS Wakalumi. Seluruh proses diselenggarakan secara amanah, transparan, serta mematuhi regulasi POJK dan prinsip syariah DSN-MUI.';
        }

        // Kartu Transparansi Kanan Hero
        $card_show = get_option( 'options_lelang_card_show', '1' );

        $card_badge = get_option( 'options_lelang_card_badge', '' );
        if ( empty( $card_badge ) ) {
            $card_badge = 'Kepatuhan Syariah & Regulasi';
        }

        $card_title = get_option( 'options_lelang_card_title', '' );
        if ( empty( $card_title ) ) {
            $card_title = 'Mekanisme Adil & Bebas Riba';
        }

        $card_desc = get_option( 'options_lelang_card_desc', '' );
        if ( empty( $card_desc ) ) {
            $card_desc = 'Penjualan melalui portal negara KPKNL (lelang.go.id) atau penjualan damai atas persetujuan debitur. Kelebihan hasil lelang wajib dikembalikan kepada nasabah pemilik agunan sesuai Fatwa DSN-MUI.';
        }

        $card_tag1 = get_option( 'options_lelang_card_tag1', '' );
        if ( empty( $card_tag1 ) ) {
            $card_tag1 = 'Fatwa DSN-MUI No. 47';
        }

        $card_tag2 = get_option( 'options_lelang_card_tag2', '' );
        if ( empty( $card_tag2 ) ) {
            $card_tag2 = 'POJK Terdaftar & Diawasi';
        }

        // 3 Key Trust Highlight Pills
        $pill1 = get_option( 'options_lelang_pill_1', '' );
        if ( empty( $pill1 ) ) {
            $pill1 = 'Lelang Resmi KPKNL / Sukarela';
        }
        $pill2 = get_option( 'options_lelang_pill_2', '' );
        if ( empty( $pill2 ) ) {
            $pill2 = 'Kelebihan Dana Hak Debitur (DSN-MUI)';
        }
        $pill3 = get_option( 'options_lelang_pill_3', '' );
        if ( empty( $pill3 ) ) {
            $pill3 = 'Legalitas Terverifikasi (SHM/BPKB)';
        }

        $pic_name = get_option( 'options_lelang_pic_name', 'Tim Remedial & Lelang BPRS Wakalumi' );
        if ( empty( $pic_name ) ) {
            $pic_name = 'Tim Remedial & Lelang BPRS Wakalumi';
        }

        $pic_wa = get_option( 'options_lelang_pic_wa', get_option( 'options_contact_wa', '6281517380388' ) );
        if ( empty( $pic_wa ) ) {
            $pic_wa = get_option( 'options_contact_wa', '6281517380388' );
        }

        return [
            'badge'      => $badge,
            'title'      => $title,
            'desc'       => $desc,
            'card_show'  => $card_show,
            'card_badge' => $card_badge,
            'card_title' => $card_title,
            'card_desc'  => $card_desc,
            'card_tag1'  => $card_tag1,
            'card_tag2'  => $card_tag2,
            'pill_1'     => $pill1,
            'pill_2'     => $pill2,
            'pill_3'     => $pill3,
            'pic_name'   => $pic_name,
            'pic_wa'     => $pic_wa,
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_lelang_pilar' ) ) {
    /**
     * Mengambil konfigurasi Pilar Kepatuhan Syariah & Regulasi untuk ditampilkan di Frontend.
     *
     * @return array
     */
    function wakalumi_get_lelang_pilar() {
        $saved_items = get_option( 'options_lelang_pilar_items', null );

        if ( ! is_array( $saved_items ) ) {
            // Fallback data awal jika belum pernah disimpan sebagai repeater
            $p1_title = get_option( 'options_lelang_pilar_1_title', '1. Kelebihan Hasil Lelang Hak Nasabah' );
            $p1_desc  = get_option( 'options_lelang_pilar_1_desc', 'Seluruh kelebihan nilai penjualan di atas sisa kewajiban piutang nasabah wajib dikembalikan ke nasabah pemilik agunan.' );
            $p2_title = get_option( 'options_lelang_pilar_2_title', '2. Transparan & Bebas Gharar' );
            $p2_desc  = get_option( 'options_lelang_pilar_2_desc', 'Nilai limit lelang, kondisi fisik, dan status legalitas sertifikat/BPKB diumumkan secara jujur dan terbuka.' );
            $p3_title = get_option( 'options_lelang_pilar_3_title', '3. Saluran Sah (KPKNL / Sukarela)' );
            $p3_desc  = get_option( 'options_lelang_pilar_3_desc', 'Dilaksanakan lewat KPKNL (lelang.go.id) atau penjualan damai atas persetujuan debitur demi kemaslahatan bersama.' );

            $saved_items = [
                [ 'title' => $p1_title, 'desc' => $p1_desc ],
                [ 'title' => $p2_title, 'desc' => $p2_desc ],
                [ 'title' => $p3_title, 'desc' => $p3_desc ],
            ];
        }

        return [
            'show'     => get_option( 'options_lelang_pilar_show', '1' ),
            'title'    => get_option( 'options_lelang_pilar_title', 'Pilar Kepatuhan Syariah & Regulasi Likuidasi Agunan' ),
            'subtitle' => get_option( 'options_lelang_pilar_subtitle', 'Sesuai Fatwa DSN-MUI No. 47/DSN-MUI/II/2005 dan regulasi Otoritas Jasa Keuangan (POJK):' ),
            'items'    => $saved_items,
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_lelang_panduan' ) ) {
    /**
     * Mengambil konfigurasi Panduan Ringkas (Accordion Dropdown) di Frontend.
     *
     * @return array
     */
    function wakalumi_get_lelang_panduan() {
        return [
            'show'          => get_option( 'options_lelang_panduan_show', '1' ),
            'title'         => get_option( 'options_lelang_panduan_title', 'Panduan Ringkas: Memahami Mekanisme Lelang Agunan & AYDA Syariah BPRS Wakalumi' ),
            'point_1_title' => get_option( 'options_lelang_panduan_1_title', '1. Penjualan Sukarela vs. Lelang KPKNL' ),
            'point_1_desc'  => get_option( 'options_lelang_panduan_1_desc', 'Aset berstatus Tersedia dapat langsung dinegosiasikan secara damai. Sedangkan aset Akan Dilelang dilaksanakan melalui sistem penawaran lelang resmi negara via portal lelang.go.id.' ),
            'point_2_title' => get_option( 'options_lelang_panduan_2_title', '2. Hak Pengembalian Lebih Debitur' ),
            'point_2_desc'  => get_option( 'options_lelang_panduan_2_desc', 'Sesuai Fatwa DSN-MUI, bank dilarang mengambil untung zalim atas penderitaan nasabah. Apabila hasil penjualan melebihi total sisa piutang pokok + biaya sah, selisih wajib diserahkan kepada nasabah.' ),
            'point_3_title' => get_option( 'options_lelang_panduan_3_title', '3. Didukung Pembiayaan KPR Syariah' ),
            'point_3_desc'  => get_option( 'options_lelang_panduan_3_desc', 'Khusus properti rumah dan ruko siap huni, peminat dapat mengajukan fasilitas pembiayaan cicilan syariah (Murabahah/Musyarakah Mutanaqisah) kepada BPRS Wakalumi dengan DP terjangkau.' ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_lelang_cta' ) ) {
    /**
     * Mengambil konfigurasi CTA Section di bagian bawah halaman lelang.
     *
     * @return array
     */
    function wakalumi_get_lelang_cta() {
        return [
            'badge'     => get_option( 'options_lelang_cta_badge', 'Layanan Remedial & Likuidasi Aset' ),
            'title'     => get_option( 'options_lelang_cta_title', 'Ingin Mengetahui Jadwal Open House atau Mengajukan Penawaran?' ),
            'desc'      => get_option( 'options_lelang_cta_desc', 'Tim Remedial BPRS Wakalumi siap mendampingi Anda untuk survei lokasi fisik, pengecekan berkas sertifikat di kantor bank, dan konsultasi skema KPR Syariah.' ),
            'btn1_text' => get_option( 'options_lelang_cta_btn1_text', 'Konsultasi Lelang via WhatsApp' ),
            'btn2_text' => get_option( 'options_lelang_cta_btn2_text', 'Kunjungi Kantor Kami' ),
            'btn2_url'  => get_option( 'options_lelang_cta_btn2_url', home_url( '/profil/jaringan-kantor/' ) ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_lelang_list' ) ) {
    /**
     * Mengambil seluruh data aset lelang dari database wp_options.
     * Jika opsi belum terisi, sediakan 5 data awal realistis berstandar perbankan syariah.
     *
     * @return array
     */
    function wakalumi_get_lelang_list() {
        $saved = get_option( 'options_lelang_list', null );

        if ( is_array( $saved ) && ! empty( $saved ) ) {
            return $saved;
        }

        // Default initial items
        $default_items = [
            [
                'id'             => 'lelang_1',
                'kode'           => 'AYDA-2026-001',
                'judul'          => 'Rumah Tinggal 2 Lantai Minimalis Modern & Asri',
                'kategori'       => 'rumah',
                'status'         => 'tersedia',
                'harga_limit'    => 'Rp 680.000.000',
                'nilai_pasar'    => 'Rp 920.000.000',
                'uang_jaminan'   => 'Rp 136.000.000',
                'legalitas'      => 'SHM (Sertifikat Hak Milik) No. 04821',
                'luas_tanah'     => '135 m²',
                'luas_bangunan'  => '160 m²',
                'lokasi'         => 'Cluster Pondok Indah Pamulang, Jl. Surya Kencana No. B-12, Pamulang Barat',
                'kota'           => 'Tangerang Selatan',
                'tanggal_lelang' => 'Terbuka (Penjualan Sukarela / Siap Huni)',
                'tempat_lelang'  => 'Kantor Pusat PT BPRS Wakalumi & On-Site Property',
                'foto_utama'     => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80',
                'galeri_foto'    => "https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1200&q=80\nhttps://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?auto=format&fit=crop&w=1200&q=80\nhttps://images.unsplash.com/photo-1600573472592-401b489a3cdc?auto=format&fit=crop&w=1200&q=80",
                'deskripsi'      => "Hunian 2 lantai siap huni dengan struktur kokoh di lingkungan tenang dan bebas banjir.\n\nDilengkapi 3 Kamar Tidur, 2 Kamar Mandi, Ruang Tamu luas, Dapur bersih, Carport untuk 2 mobil, Daya Listrik 2200 VA, dan Air Sumur Bor Jetpump jernih. Akses jalan aspal lebar 2 mobil, hanya 10 menit ke Gerbang Tol Pamulang (Tol Serpong-Cinere) dan Universitas Pamulang.",
                'tata_cara'      => 'Aset ini berstatus Penjualan Sukarela (AYDA) atas persetujuan debitur. Peminat dapat langsung menjadwalkan survei fisik bersama tim remedial BPRS Wakalumi dan dapat dibeli secara tunai maupun diajukan fasilitas Pembiayaan Kepemilikan Rumah (KPR) Syariah Wakalumi.',
                'wa_contact'     => '',
                'urutan'         => 1,
            ],
            [
                'id'             => 'lelang_2',
                'kode'           => 'AYDA-2026-002',
                'judul'          => 'Ruko Komersial 3 Lantai Strategis Pusat Bisnis Ciputat',
                'kategori'       => 'ruko',
                'status'         => 'akan_dilelang',
                'harga_limit'    => 'Rp 1.450.000.000',
                'nilai_pasar'    => 'Rp 1.950.000.000',
                'uang_jaminan'   => 'Rp 290.000.000',
                'legalitas'      => 'SHGB (Sertifikat Hak Guna Bangunan) No. 01275',
                'luas_tanah'     => '96 m² (4.5 x 21.3 m)',
                'luas_bangunan'  => '240 m²',
                'lokasi'         => 'Kompleks Ruko Ciputat Bisnis Center, Jl. Dewi Sartika No. 18, Ciputat',
                'kota'           => 'Tangerang Selatan',
                'tanggal_lelang' => '26 November 2026 (Pukul 10.30 WIB)',
                'tempat_lelang'  => 'KPKNL Tangerang I / Portal Resmi lelang.go.id',
                'foto_utama'     => 'https://images.unsplash.com/photo-1541888946425-d0fbb1861593?auto=format&fit=crop&w=1200&q=80',
                'galeri_foto'    => "https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80\nhttps://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1200&q=80",
                'deskripsi'      => "Ruko komersial 3 lantai berada di tepi jalan raya utama Ciputat dengan lalu lintas ramai 24 jam.\n\nSangat cocok untuk kantor cabang perbankan/fintech, klinik kesehatan, kantor notaris/hukum, restoran, maupun minimarket. Dilengkapi fasilitas area parkir paving luas, rolling door elektrik, kamar mandi di setiap lantai, dan listrik 5500 VA.",
                'tata_cara'      => 'Lelang eksekusi Hak Tanggungan dilaksanakan resmi secara closed bidding melalui portal negara lelang.go.id yang dikelola KPKNL Tangerang I. Penyetoran uang jaminan lelang dilakukan melalui Virtual Account (VA) yang diterbitkan lelang.go.id paling lambat 1 hari sebelum pelaksanaan lelang.',
                'wa_contact'     => '',
                'urutan'         => 2,
            ],
            [
                'id'             => 'lelang_3',
                'kode'           => 'AYDA-2026-003',
                'judul'          => 'Tanah Kavling Siap Bangun Kawasan Eksklusif Bintaro Sektor 9',
                'kategori'       => 'tanah',
                'status'         => 'tersedia',
                'harga_limit'    => 'Rp 950.000.000',
                'nilai_pasar'    => 'Rp 1.300.000.000',
                'uang_jaminan'   => 'Rp 190.000.000',
                'legalitas'      => 'SHM (Sertifikat Hak Milik) No. 08194',
                'luas_tanah'     => '260 m² (13 x 20 m)',
                'luas_bangunan'  => '-',
                'lokasi'         => 'Jl. Kasuari Raya, Kel. Pondok Pucung, Kec. Pondok Aren (Bintaro Jaya Sektor 9)',
                'kota'           => 'Tangerang Selatan',
                'tanggal_lelang' => 'Tersedia (Penjualan Langsung Bank)',
                'tempat_lelang'  => 'Kantor Pusat PT BPRS Wakalumi',
                'foto_utama'     => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=1200&q=80',
                'galeri_foto'    => "https://images.unsplash.com/photo-1524813686514-a57563d77d66?auto=format&fit=crop&w=1200&q=80\nhttps://images.unsplash.com/photo-1464226184884-fa280b87c399?auto=format&fit=crop&w=1200&q=80",
                'deskripsi'      => "Tanah kavling matang siap bangun dengan bentuk persegi panjang ideal di area Bintaro Sektor 9 yang sangat berkembang pesat.\n\nPosisi hook, tanah padat bukan urukan rawa, dikelilingi perumahan elit menengah ke atas. Jaringan listrik bawah tanah, air bersih PDAM, dan keamanan security 24 jam. Lokasi hanya 5 menit dari Bintaro Xchange Mall, Stasiun Jurangmangu, dan RS Premier Bintaro.",
                'tata_cara'      => 'Peminat dapat langsung mengajukan surat penawaran harga (SPH) resmi ke Bagian Remedial & AYDA BPRS Wakalumi. Tersedia skema pembayaran cicilan berjangka (Akad Murabahah) dengan persetujuan Komite Pembiayaan Bank.',
                'wa_contact'     => '',
                'urutan'         => 3,
            ],
            [
                'id'             => 'lelang_4',
                'kode'           => 'AYDA-2026-004',
                'judul'          => 'Toyota All New Kijang Innova Venturer 2.4 AT Diesel (2021)',
                'kategori'       => 'kendaraan',
                'status'         => 'akan_dilelang',
                'harga_limit'    => 'Rp 325.000.000',
                'nilai_pasar'    => 'Rp 395.000.000',
                'uang_jaminan'   => 'Rp 65.000.000',
                'legalitas'      => 'BPKB Asli + STNK Aktif + Faktur Pembelian (Plat B Tangsel)',
                'luas_tanah'     => '-',
                'luas_bangunan'  => '-',
                'lokasi'         => 'Pool Kendaraan Operasional BPRS Wakalumi, Jl. RE Martadinata No. 15, Cipayung, Ciputat',
                'kota'           => 'Tangerang Selatan',
                'tanggal_lelang' => '3 Desember 2026 (Pukul 09.00 WIB)',
                'tempat_lelang'  => 'KPKNL Tangerang II / Portal Resmi lelang.go.id',
                'foto_utama'     => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=1200&q=80',
                'galeri_foto'    => "https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=1200&q=80\nhttps://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1200&q=80",
                'deskripsi'      => "Kendaraan roda empat tipe premium MPV keluarga Toyota Kijang Innova Venturer 2.4 Diesel Automatic transmisi tahun perakitan 2021.\n\nWarna Hitam Metalik, odometer rendah (48.000 km), servis rutin bengkel resmi Auto2000. Interior kulit captain seat terawat mulus, AC digital double blower dingin, ban tebal 85%, mesin diesel bertenaga & kering tanpa rembesan oli. Dokumen kepemilikan BPKB, STNK asli, kunci cadangan, dan buku manual lengkap.",
                'tata_cara'      => 'Pengecekan fisik unit (Open House / Test Drive) dibuka setiap hari kerja pukul 09.00 - 15.00 WIB di Kantor Pusat BPRS Wakalumi dengan konfirmasi terlebih dahulu ke PIC Lelang. Penawaran dilakukan secara online via lelang.go.id.',
                'wa_contact'     => '',
                'urutan'         => 4,
            ],
            [
                'id'             => 'lelang_5',
                'kode'           => 'AYDA-2026-005',
                'judul'          => 'Rumah Tinggal 1 Lantai Tipe Hook Asri Sawangan Depok',
                'kategori'       => 'rumah',
                'status'         => 'terjual',
                'harga_limit'    => 'Rp 395.000.000',
                'nilai_pasar'    => 'Rp 510.000.000',
                'uang_jaminan'   => 'Rp 79.000.000',
                'legalitas'      => 'SHM (Sertifikat Hak Milik) No. 02931',
                'luas_tanah'     => '112 m²',
                'luas_bangunan'  => '65 m²',
                'lokasi'         => 'Perumahan Grand Sawangan Asri Blok D-5, Sawangan',
                'kota'           => 'Depok',
                'tanggal_lelang' => 'Selesai Terlelang (14 Oktober 2026)',
                'tempat_lelang'  => 'KPKNL Bogor',
                'foto_utama'     => 'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=1200&q=80',
                'galeri_foto'    => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80',
                'deskripsi'      => 'Hunian 1 lantai asri dengan kelebihan tanah hook di Sawangan. 2 Kamar Tidur, 1 Kamar Mandi, Ruang Tamu, dan Taman samping asri. Selesai terlelang secara sukses dan akta risalah lelang telah diserahkan kepada pemenang lelang.',
                'tata_cara'      => 'Aset ini telah berstatus Terjual / Selesai Likuidasi. Kelebihan dana hasil lelang telah diserahkan kepada pihak debitur sesuai ketentuan syariah.',
                'wa_contact'     => '',
                'urutan'         => 5,
            ],
        ];

        return $default_items;
    }
}


// ── 2. MENU REGISTRATION & ASSETS ───────────────────────────────────

add_action( 'admin_menu', 'wakalumi_register_lelang_page', 28 );
function wakalumi_register_lelang_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Info Lelang Agunan (AYDA)',
        'Info Lelang Agunan',
        'manage_options',
        'wakalumi-lelang',
        'wakalumi_render_lelang_page'
    );
}

add_action( 'admin_enqueue_scripts', 'wakalumi_lelang_admin_assets' );
function wakalumi_lelang_admin_assets( $hook ) {
    if ( strpos( $hook, 'wakalumi-lelang' ) !== false ) {
        wp_enqueue_media();
    }
}


// ── 3. RENDER ADMIN INTERFACE & SAVE CONTROLLER ─────────────────────

function wakalumi_render_lelang_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Akses ditolak.' );
    }

    // Handle Form Submission
    if ( isset( $_POST['wakalumi_save_lelang'] ) && check_admin_referer( 'wakalumi_lelang_action', 'wakalumi_lelang_nonce' ) ) {
        // 1. Header & Governance Card Options
        update_option( 'options_lelang_badge', sanitize_text_field( $_POST['options_lelang_badge'] ?? '' ) );
        update_option( 'options_lelang_title', sanitize_text_field( $_POST['options_lelang_title'] ?? '' ) );
        update_option( 'options_lelang_desc', sanitize_textarea_field( $_POST['options_lelang_desc'] ?? '' ) );

        $card_show = isset( $_POST['options_lelang_card_show'] ) ? '1' : '0';
        update_option( 'options_lelang_card_show', $card_show );
        update_option( 'options_lelang_card_badge', sanitize_text_field( $_POST['options_lelang_card_badge'] ?? '' ) );
        update_option( 'options_lelang_card_title', sanitize_text_field( $_POST['options_lelang_card_title'] ?? '' ) );
        update_option( 'options_lelang_card_desc', sanitize_textarea_field( $_POST['options_lelang_card_desc'] ?? '' ) );
        update_option( 'options_lelang_card_tag1', sanitize_text_field( $_POST['options_lelang_card_tag1'] ?? '' ) );
        update_option( 'options_lelang_card_tag2', sanitize_text_field( $_POST['options_lelang_card_tag2'] ?? '' ) );

        update_option( 'options_lelang_pill_1', sanitize_text_field( $_POST['options_lelang_pill_1'] ?? '' ) );
        update_option( 'options_lelang_pill_2', sanitize_text_field( $_POST['options_lelang_pill_2'] ?? '' ) );
        update_option( 'options_lelang_pill_3', sanitize_text_field( $_POST['options_lelang_pill_3'] ?? '' ) );

        // 2. Pilar Kepatuhan Syariah & Regulasi (Tampil di Frontend)
        $pilar_show = isset( $_POST['options_lelang_pilar_show'] ) ? '1' : '0';
        update_option( 'options_lelang_pilar_show', $pilar_show );
        update_option( 'options_lelang_pilar_title', sanitize_text_field( $_POST['options_lelang_pilar_title'] ?? '' ) );
        update_option( 'options_lelang_pilar_subtitle', sanitize_textarea_field( $_POST['options_lelang_pilar_subtitle'] ?? '' ) );

        $pilar_titles = $_POST['options_lelang_pilar_item_title'] ?? [];
        $pilar_descs  = $_POST['options_lelang_pilar_item_desc'] ?? [];
        $pilar_items  = [];
        for ( $i = 0; $i < count( $pilar_titles ); $i++ ) {
            $t = sanitize_text_field( $pilar_titles[$i] ?? '' );
            $d = sanitize_textarea_field( $pilar_descs[$i] ?? '' );
            if ( ! empty( $t ) || ! empty( $d ) ) {
                $pilar_items[] = [
                    'title' => $t,
                    'desc'  => $d,
                ];
            }
        }
        update_option( 'options_lelang_pilar_items', $pilar_items );

        // 3. Panduan Ringkas (Dropdown Collapsible Frontend)
        $panduan_show = isset( $_POST['options_lelang_panduan_show'] ) ? '1' : '0';
        update_option( 'options_lelang_panduan_show', $panduan_show );
        update_option( 'options_lelang_panduan_title', sanitize_text_field( $_POST['options_lelang_panduan_title'] ?? '' ) );
        update_option( 'options_lelang_panduan_1_title', sanitize_text_field( $_POST['options_lelang_panduan_1_title'] ?? '' ) );
        update_option( 'options_lelang_panduan_1_desc', sanitize_textarea_field( $_POST['options_lelang_panduan_1_desc'] ?? '' ) );
        update_option( 'options_lelang_panduan_2_title', sanitize_text_field( $_POST['options_lelang_panduan_2_title'] ?? '' ) );
        update_option( 'options_lelang_panduan_2_desc', sanitize_textarea_field( $_POST['options_lelang_panduan_2_desc'] ?? '' ) );
        update_option( 'options_lelang_panduan_3_title', sanitize_text_field( $_POST['options_lelang_panduan_3_title'] ?? '' ) );
        update_option( 'options_lelang_panduan_3_desc', sanitize_textarea_field( $_POST['options_lelang_panduan_3_desc'] ?? '' ) );

        // 4. Pengaturan Ajakan Bertindak (CTA Banner)
        update_option( 'options_lelang_cta_badge', sanitize_text_field( $_POST['options_lelang_cta_badge'] ?? '' ) );
        update_option( 'options_lelang_cta_title', sanitize_text_field( $_POST['options_lelang_cta_title'] ?? '' ) );
        update_option( 'options_lelang_cta_desc', sanitize_textarea_field( $_POST['options_lelang_cta_desc'] ?? '' ) );
        update_option( 'options_lelang_cta_btn1_text', sanitize_text_field( $_POST['options_lelang_cta_btn1_text'] ?? '' ) );
        update_option( 'options_lelang_cta_btn2_text', sanitize_text_field( $_POST['options_lelang_cta_btn2_text'] ?? '' ) );
        update_option( 'options_lelang_cta_btn2_url', esc_url_raw( $_POST['options_lelang_cta_btn2_url'] ?? '' ) );

        // 5. PIC Remedial Contact Options
        update_option( 'options_lelang_pic_name', sanitize_text_field( $_POST['options_lelang_pic_name'] ?? '' ) );
        update_option( 'options_lelang_pic_wa', sanitize_text_field( $_POST['options_lelang_pic_wa'] ?? '' ) );

        // 6. Pengaturan Prosedur & Kepatuhan Berdasarkan Status Aset
        $statuses_keys = [ 'tersedia', 'akan_dilelang', 'terjual' ];
        foreach ( $statuses_keys as $st_key ) {
            update_option( "options_lelang_status_{$st_key}_prosedur_title", sanitize_text_field( $_POST["options_lelang_status_{$st_key}_prosedur_title"] ?? '' ) );
            update_option( "options_lelang_status_{$st_key}_prosedur_desc", sanitize_textarea_field( $_POST["options_lelang_status_{$st_key}_prosedur_desc"] ?? '' ) );
            update_option( "options_lelang_status_{$st_key}_kepatuhan_title", sanitize_text_field( $_POST["options_lelang_status_{$st_key}_kepatuhan_title"] ?? '' ) );
            update_option( "options_lelang_status_{$st_key}_kepatuhan_desc", sanitize_textarea_field( $_POST["options_lelang_status_{$st_key}_kepatuhan_desc"] ?? '' ) );
        }

        // 7. Process Asset Items Repeater
        $juduls             = $_POST['lelang_judul'] ?? [];
        $ids                = $_POST['lelang_id'] ?? [];
        $kodes              = $_POST['lelang_kode'] ?? [];
        $kategoris          = $_POST['lelang_kategori'] ?? [];
        $statuses           = $_POST['lelang_status'] ?? [];
        $harga_limits       = $_POST['lelang_harga_limit'] ?? [];
        $nilai_pasars       = $_POST['lelang_nilai_pasar'] ?? [];
        $uang_jaminans      = $_POST['lelang_uang_jaminan'] ?? [];
        $legalitass         = $_POST['lelang_legalitas'] ?? [];
        $luas_tanahs        = $_POST['lelang_luas_tanah'] ?? [];
        $luas_bangunans     = $_POST['lelang_luas_bangunan'] ?? [];
        $lokasis            = $_POST['lelang_lokasi'] ?? [];
        $kotas              = $_POST['lelang_kota'] ?? [];
        $tanggal_lelangs    = $_POST['lelang_tanggal_lelang'] ?? [];
        $tempat_lelangs     = $_POST['lelang_tempat_lelang'] ?? [];
        $foto_utamas        = $_POST['lelang_foto_utama'] ?? [];
        $galeri_fotos       = $_POST['lelang_galeri_foto'] ?? [];
        $deskripsis         = $_POST['lelang_deskripsi'] ?? [];
        $tata_caras         = $_POST['lelang_tata_cara'] ?? [];
        $kepatuhan_customs  = $_POST['lelang_kepatuhan_custom'] ?? [];
        $wa_contacts        = $_POST['lelang_wa_contact'] ?? [];
        $urutans            = $_POST['lelang_urutan'] ?? [];

        $saved_list = [];
        $count = count( $juduls );

        for ( $i = 0; $i < $count; $i++ ) {
            $judul = sanitize_text_field( $juduls[$i] ?? '' );
            if ( empty( $judul ) ) {
                continue; // Skip empty row
            }

            $id_val = sanitize_key( $ids[$i] ?? '' );
            if ( empty( $id_val ) ) {
                $id_val = 'lelang_' . time() . '_' . $i;
            }

            $saved_list[] = [
                'id'               => $id_val,
                'kode'             => sanitize_text_field( $kodes[$i] ?? ( 'AYDA-' . ( $i + 1 ) ) ),
                'judul'            => $judul,
                'kategori'         => sanitize_key( $kategoris[$i] ?? 'rumah' ),
                'status'           => sanitize_key( $statuses[$i] ?? 'tersedia' ),
                'harga_limit'      => sanitize_text_field( $harga_limits[$i] ?? '' ),
                'nilai_pasar'      => sanitize_text_field( $nilai_pasars[$i] ?? '' ),
                'uang_jaminan'     => sanitize_text_field( $uang_jaminans[$i] ?? '' ),
                'legalitas'        => sanitize_text_field( $legalitass[$i] ?? '' ),
                'luas_tanah'       => sanitize_text_field( $luas_tanahs[$i] ?? '' ),
                'luas_bangunan'    => sanitize_text_field( $luas_bangunans[$i] ?? '' ),
                'lokasi'           => sanitize_textarea_field( $lokasis[$i] ?? '' ),
                'kota'             => sanitize_text_field( $kotas[$i] ?? 'Tangerang Selatan' ),
                'tanggal_lelang'   => sanitize_text_field( $tanggal_lelangs[$i] ?? '' ),
                'tempat_lelang'    => sanitize_text_field( $tempat_lelangs[$i] ?? '' ),
                'foto_utama'       => esc_url_raw( $foto_utamas[$i] ?? '' ),
                'galeri_foto'      => sanitize_textarea_field( $galeri_fotos[$i] ?? '' ),
                'deskripsi'        => sanitize_textarea_field( $deskripsis[$i] ?? '' ),
                'tata_cara'        => sanitize_textarea_field( $tata_caras[$i] ?? '' ),
                'kepatuhan_custom' => sanitize_textarea_field( $kepatuhan_customs[$i] ?? '' ),
                'wa_contact'       => sanitize_text_field( $wa_contacts[$i] ?? '' ),
                'urutan'           => (int)( $urutans[$i] ?? ( $i + 1 ) ),
            ];
        }

        // Sort by urutan ASC
        usort( $saved_list, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );

        update_option( 'options_lelang_list', $saved_list );

        echo '<div class="notice notice-success is-dismissible" style="border-left-color: #088395;"><p><strong>Berhasil!</strong> Pengaturan dan daftar aset lelang agunan (AYDA) telah berhasil disimpan.</p></div>';
    }

    $header_data  = wakalumi_get_lelang_header();
    $pilar_data   = wakalumi_get_lelang_pilar();
    $panduan_data = wakalumi_get_lelang_panduan();
    $cta_data     = wakalumi_get_lelang_cta();
    $categories   = wakalumi_get_lelang_categories();
    $statuses     = wakalumi_get_lelang_statuses();
    $lelang_list  = wakalumi_get_lelang_list();
    ?>

    <div class="wrap" style="max-width: 1100px; margin-top: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, sans-serif;">
        <!-- Header Page Title -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 38px; height: 38px; background: #e0f2fe; color: #0284c7; border-radius: 10px; font-size: 20px;">🔨</span>
                    Info Lelang Agunan (AYDA)
                </h1>
                <p style="margin: 5px 0 0; color: #64748b; font-size: 13px;">
                    Kelola transparansi publikasi lelang Hak Tanggungan dan likuidasi agunan (AYDA) sesuai regulasi OJK & Fatwa DSN-MUI.
                </p>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="<?php echo esc_url( home_url( '/informasi/lelang/' ) ); ?>" target="_blank" class="button" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; border-radius: 8px;">
                    <span class="dashicons dashicons-external" style="margin-top: 3px;"></span> Pratinjau Halaman Frontend
                </a>
            </div>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field( 'wakalumi_lelang_action', 'wakalumi_lelang_nonce' ); ?>

            <!-- ============================================================
                 KOTAK 1: PILAR KEPATUHAN SYARIAH & REGULASI (TAMPIL DI FRONTEND)
                 ============================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-top: 4px solid #059669; border-radius: 16px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; flex-wrap: wrap; gap: 10px;">
                    <h2 style="font-size: 16px; font-weight: 800; color: #059669; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <span>⚖️</span> Pilar Kepatuhan Syariah & Regulasi (Tampil di Frontend)
                    </h2>
                    <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: #1e293b; cursor: pointer; background: #ecfdf5; padding: 4px 12px; border-radius: 20px; border: 1px solid #a7f3d0;">
                        <input type="checkbox" name="options_lelang_pilar_show" value="1" <?php checked( $pilar_data['show'], '1' ); ?>>
                        Tampilkan Banner Pilar Regulasi di Halaman
                    </label>
                </div>
                <p style="margin: 10px 0 16px; color: #64748b; font-size: 12px; line-height: 1.5;">
                    Banner ini tampil elegan di halaman publik lelang untuk menegaskan kepatuhan Fatwa DSN-MUI dan POJK demi menjaga reputasi dan kepercayaan nasabah.
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Judul Banner Pilar</label>
                        <input type="text" name="options_lelang_pilar_title" value="<?php echo esc_attr( $pilar_data['title'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Sub-judul / Pernyataan Fatwa & Regulasi</label>
                        <input type="text" name="options_lelang_pilar_subtitle" value="<?php echo esc_attr( $pilar_data['subtitle'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;">
                    </div>
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 20px; padding-top: 16px; border-top: 1px dashed #e2e8f0; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <strong style="font-size: 13px; color: #1e293b;">Daftar Kartu Pilar Kepatuhan</strong>
                        <p style="margin: 2px 0 0; font-size: 11px; color: #64748b;">
                            Tambah atau kurangi pilar sesuai kebutuhan. Tampilan di frontend akan otomatis menyesuaikan jumlah kartu agar rapi dan proporsional.
                        </p>
                    </div>
                    <button type="button" id="btn-add-pilar" class="button button-secondary" style="border-radius: 8px; font-weight: 700; color: #166534; border-color: #86efac; background: #f0fdf4; display: inline-flex; align-items: center; gap: 5px;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px; margin-top: 2px;"></span> Tambah Pilar Baru
                    </button>
                </div>

                <div id="pilar-repeater-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px; margin-top: 14px;">
                    <?php 
                    $pilar_items = $pilar_data['items'] ?? [];
                    if ( empty( $pilar_items ) ) : ?>
                        <div id="no-pilar-notice" style="grid-column: 1 / -1; text-align: center; padding: 25px 15px; background: #f8fafc; border-radius: 10px; border: 1px dashed #cbd5e1; color: #64748b; font-size: 12px;">
                            Belum ada pilar kepatuhan. Klik tombol <strong>+ Tambah Pilar Baru</strong> di atas untuk menambahkan.
                        </div>
                    <?php endif; ?>

                    <?php 
                    $p_num = 0;
                    foreach ( $pilar_items as $p_item ) : 
                        $p_num++;
                        $p_title = esc_attr( $p_item['title'] ?? '' );
                        $p_desc  = esc_textarea( $p_item['desc'] ?? '' );
                    ?>
                        <div class="pilar-card-item" style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 14px; position: relative;">
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                                <span class="pilar-card-number" style="display: inline-block; font-size: 11px; font-weight: 800; color: #166534; text-transform: uppercase;">Pilar <?php echo $p_num; ?></span>
                                <button type="button" class="button-link btn-delete-pilar" style="color: #ef4444; font-size: 12px; text-decoration: none;" title="Hapus Pilar Ini">
                                    <span class="dashicons dashicons-trash" style="font-size: 15px; width: 15px; height: 15px; vertical-align: middle;"></span> Hapus
                                </button>
                            </div>
                            <input type="text" name="options_lelang_pilar_item_title[]" value="<?php echo $p_title; ?>" style="width: 100%; border-radius: 6px; border: 1px solid #86efac; padding: 6px 10px; font-size: 12px; font-weight: 700; margin-bottom: 8px;" placeholder="Judul Pilar (misal: 1. Kelebihan Hasil Lelang Hak Nasabah)">
                            <textarea name="options_lelang_pilar_item_desc[]" rows="3" style="width: 100%; border-radius: 6px; border: 1px solid #86efac; padding: 6px 10px; font-size: 12px; line-height: 1.4;" placeholder="Deskripsi penjelasan pilar..."><?php echo $p_desc; ?></textarea>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ============================================================
                 KOTAK 2: PENGATURAN HERO HEADER & KARTU TRANSPARANSI
                 ============================================================ -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 800; color: #088395; margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 8px;">
                    <span>🧭</span> Pengaturan Banner Header & Kartu Transparansi Hero
                </h2>

                <!-- Sub-section A: Kolom Kiri Hero -->
                <div style="margin-top: 15px;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                        <span style="font-size: 12px; font-weight: 800; background: #e0f2fe; color: #0369a1; padding: 3px 10px; border-radius: 6px; text-transform: uppercase;">Bagian 1: Narasi Utama (Sisi Kiri Hero)</span>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Kicker Badge Header</label>
                            <input type="text" name="options_lelang_badge" value="<?php echo esc_attr( $header_data['badge'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Judul Utama Halaman (H1)</label>
                            <input type="text" name="options_lelang_title" value="<?php echo esc_attr( $header_data['title'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;">
                        </div>
                    </div>

                    <div style="margin-top: 15px;">
                        <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Deskripsi / Pernyataan Regulasi Header</label>
                        <textarea name="options_lelang_desc" rows="3" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; line-height: 1.5;"><?php echo esc_textarea( $header_data['desc'] ); ?></textarea>
                    </div>

                    <!-- 3 Highlight Pills -->
                    <div style="margin-top: 15px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px;">
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 8px; text-transform: uppercase;">3 Pill Highlight Kepercayaan (Tampil di Bawah Paragraf Kiri)</label>
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px;">
                            <div>
                                <span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 4px;">Pill 1</span>
                                <input type="text" name="options_lelang_pill_1" value="<?php echo esc_attr( $header_data['pill_1'] ); ?>" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 6px 10px; font-size: 12px;" placeholder="Lelang Resmi KPKNL / Sukarela">
                            </div>
                            <div>
                                <span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 4px;">Pill 2</span>
                                <input type="text" name="options_lelang_pill_2" value="<?php echo esc_attr( $header_data['pill_2'] ); ?>" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 6px 10px; font-size: 12px;" placeholder="Kelebihan Dana Hak Debitur (DSN-MUI)">
                            </div>
                            <div>
                                <span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 4px;">Pill 3</span>
                                <input type="text" name="options_lelang_pill_3" value="<?php echo esc_attr( $header_data['pill_3'] ); ?>" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 6px 10px; font-size: 12px;" placeholder="Legalitas Terverifikasi (SHM/BPKB)">
                            </div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Nama Tim / PIC Remedial & Lelang</label>
                            <input type="text" name="options_lelang_pic_name" value="<?php echo esc_attr( $header_data['pic_name'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Contoh: Tim Remedial BPRS Wakalumi">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Nomor WhatsApp PIC Lelang (Inquiry Cepat)</label>
                            <input type="text" name="options_lelang_pic_wa" value="<?php echo esc_attr( $header_data['pic_wa'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Contoh: 6281517380388">
                            <span style="font-size: 11px; color: #64748b;">Format diawali 62 tanpa spasi atau tanda +.</span>
                        </div>
                    </div>
                </div>

                <!-- Sub-section B: Kartu Transparansi Kanan Hero -->
                <div style="margin-top: 25px; padding-top: 20px; border-top: 2px dashed #e2e8f0;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; flex-wrap: wrap; gap: 10px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-size: 12px; font-weight: 800; background: #fef3c7; color: #92400e; padding: 3px 10px; border-radius: 6px; text-transform: uppercase;">Bagian 2: Kartu Transparansi & Kepatuhan (Sisi Kanan Hero)</span>
                        </div>
                        <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: #1e293b; cursor: pointer; background: #fffbeb; padding: 4px 12px; border-radius: 20px; border: 1px solid #fde68a;">
                            <input type="checkbox" name="options_lelang_card_show" value="1" <?php checked( $header_data['card_show'], '1' ); ?>>
                            Tampilkan Kartu Hero Ini
                        </label>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 18px;">
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Badge Kecil Kartu</label>
                            <input type="text" name="options_lelang_card_badge" value="<?php echo esc_attr( $header_data['card_badge'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Contoh: Kepatuhan Syariah & Regulasi">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Judul Kartu</label>
                            <input type="text" name="options_lelang_card_title" value="<?php echo esc_attr( $header_data['card_title'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Contoh: Mekanisme Adil & Bebas Riba">
                        </div>
                    </div>

                    <div style="margin-top: 15px;">
                        <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Keterangan / Isi Paragraf Kartu Hero</label>
                        <textarea name="options_lelang_card_desc" rows="3" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; line-height: 1.5;" placeholder="Tuliskan keterangan kepatuhan lelang syariah..."><?php echo esc_textarea( $header_data['card_desc'] ); ?></textarea>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-top: 15px;">
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 12px; color: #334155; margin-bottom: 6px;">Tag Bawah Kiri (Legalitas/Regulasi)</label>
                            <input type="text" name="options_lelang_card_tag1" value="<?php echo esc_attr( $header_data['card_tag1'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 12px;" placeholder="Contoh: Fatwa DSN-MUI No. 47">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 700; font-size: 12px; color: #334155; margin-bottom: 6px;">Tag Bawah Kanan (Otoritas Pengawas)</label>
                            <input type="text" name="options_lelang_card_tag2" value="<?php echo esc_attr( $header_data['card_tag2'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 12px;" placeholder="Contoh: POJK Terdaftar & Diawasi">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================
                 KOTAK 3: PANDUAN RINGKAS MEKANISME LELANG (ACCORDION COLLAPSIBLE)
                 ============================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-top: 4px solid #088395; border-radius: 16px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; flex-wrap: wrap; gap: 10px;">
                    <h2 style="font-size: 16px; font-weight: 800; color: #088395; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <span>📖</span> Panduan Ringkas Mekanisme Lelang (Accordion Collapsible Frontend)
                    </h2>
                    <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: #1e293b; cursor: pointer; background: #e0f2fe; padding: 4px 12px; border-radius: 20px; border: 1px solid #bae6fd;">
                        <input type="checkbox" name="options_lelang_panduan_show" value="1" <?php checked( $panduan_data['show'], '1' ); ?>>
                        Tampilkan Bagian Panduan Ringkas
                    </label>
                </div>
                <p style="margin: 10px 0 16px; color: #64748b; font-size: 12px; line-height: 1.5;">
                    Bagian ini berupa dropdown accordion lipat yang membantu pengunjung memahami tahapan lelang, hak debitur, dan opsi KPR. Anda dapat mengubah isi atau menghapusnya/menonaktifkannya kapan saja.
                </p>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Judul Dropdown Panduan</label>
                    <input type="text" name="options_lelang_panduan_title" value="<?php echo esc_attr( $panduan_data['title'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;">
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px; margin-top: 18px; padding-top: 18px; border-top: 1px dashed #e2e8f0;">
                    <!-- Point 1 -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px;">
                        <span style="display: inline-block; font-size: 11px; font-weight: 800; color: #088395; text-transform: uppercase; margin-bottom: 4px;">Poin Panduan 1</span>
                        <input type="text" name="options_lelang_panduan_1_title" value="<?php echo esc_attr( $panduan_data['point_1_title'] ); ?>" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 6px 10px; font-size: 12px; font-weight: 700; margin-bottom: 8px;" placeholder="Judul Poin 1">
                        <textarea name="options_lelang_panduan_1_desc" rows="3" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 6px 10px; font-size: 12px; line-height: 1.4;" placeholder="Penjelasan poin 1..."><?php echo esc_textarea( $panduan_data['point_1_desc'] ); ?></textarea>
                    </div>

                    <!-- Point 2 -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px;">
                        <span style="display: inline-block; font-size: 11px; font-weight: 800; color: #088395; text-transform: uppercase; margin-bottom: 4px;">Poin Panduan 2</span>
                        <input type="text" name="options_lelang_panduan_2_title" value="<?php echo esc_attr( $panduan_data['point_2_title'] ); ?>" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 6px 10px; font-size: 12px; font-weight: 700; margin-bottom: 8px;" placeholder="Judul Poin 2">
                        <textarea name="options_lelang_panduan_2_desc" rows="3" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 6px 10px; font-size: 12px; line-height: 1.4;" placeholder="Penjelasan poin 2..."><?php echo esc_textarea( $panduan_data['point_2_desc'] ); ?></textarea>
                    </div>

                    <!-- Point 3 -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px;">
                        <span style="display: inline-block; font-size: 11px; font-weight: 800; color: #088395; text-transform: uppercase; margin-bottom: 4px;">Poin Panduan 3</span>
                        <input type="text" name="options_lelang_panduan_3_title" value="<?php echo esc_attr( $panduan_data['point_3_title'] ); ?>" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 6px 10px; font-size: 12px; font-weight: 700; margin-bottom: 8px;" placeholder="Judul Poin 3">
                        <textarea name="options_lelang_panduan_3_desc" rows="3" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 6px 10px; font-size: 12px; line-height: 1.4;" placeholder="Penjelasan poin 3..."><?php echo esc_textarea( $panduan_data['point_3_desc'] ); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- ============================================================
                 KOTAK 4: PENGATURAN AJAKAN BERTINDAK (CTA SECTION BAWAH)
                 ============================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-top: 4px solid #0f172a; border-radius: 16px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 800; color: #0f172a; margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 8px;">
                    <span>📣</span> Pengaturan Banner Ajakan Bertindak (CTA Banner Bawah)
                </h2>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Kicker Badge CTA</label>
                        <input type="text" name="options_lelang_cta_badge" value="<?php echo esc_attr( $cta_data['badge'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Judul Utama CTA</label>
                        <input type="text" name="options_lelang_cta_title" value="<?php echo esc_attr( $cta_data['title'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;">
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <label style="display: block; font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 6px;">Deskripsi / Teks Penjelas CTA</label>
                    <textarea name="options_lelang_cta_desc" rows="3" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; line-height: 1.5;"><?php echo esc_textarea( $cta_data['desc'] ); ?></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-top: 18px; padding-top: 18px; border-top: 1px dashed #e2e8f0;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #334155; margin-bottom: 4px;">Label Tombol 1 (WhatsApp)</label>
                        <input type="text" name="options_lelang_cta_btn1_text" value="<?php echo esc_attr( $cta_data['btn1_text'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #334155; margin-bottom: 4px;">Label Tombol 2</label>
                        <input type="text" name="options_lelang_cta_btn2_text" value="<?php echo esc_attr( $cta_data['btn2_text'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #334155; margin-bottom: 4px;">Tautan / URL Tombol 2</label>
                        <input type="text" name="options_lelang_cta_btn2_url" value="<?php echo esc_attr( $cta_data['btn2_url'] ); ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 13px;">
                    </div>
                </div>
            </div>

            <!-- ============================================================
                 KOTAK 5: PROSEDUR & KEPATUHAN SESUAI STATUS ASET (MODAL DETAIL)
                 ============================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-top: 4px solid #0d9488; border-radius: 16px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="padding-bottom: 14px; border-bottom: 1px solid #f1f5f9;">
                    <h2 style="font-size: 16px; font-weight: 800; color: #0d9488; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <span>⚖️</span> Pengaturan Prosedur & Kepatuhan Hukum Sesuai Status Aset (Modal Detail)
                    </h2>
                    <p style="margin: 8px 0 0; color: #64748b; font-size: 12px; line-height: 1.5;">
                        Ketika pengunjung mengklik tombol <strong>"Lihat Detail"</strong> pada kartu aset lelang, teks <em>"Prosedur Keikutsertaan Lelang & Survei Fisik"</em> dan kotak <em>"Kepatuhan Hukum & Fatwa DSN-MUI"</em> akan otomatis berganti menyesuaikan status aset tersebut. Anda dapat menyesuaikan judul dan naskah hukum/prosedur untuk masing-masing status di bawah ini:
                    </p>
                </div>

                <div style="display: flex; flex-direction: column; gap: 20px; margin-top: 20px;">
                    
                    <!-- 1. Status: Tersedia (Penjualan Sukarela / Siap Beli) -->
                    <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 18px;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; flex-wrap: wrap; gap: 8px;">
                            <span style="background: #dcfce7; color: #15803d; font-weight: 800; font-size: 12px; padding: 4px 10px; border-radius: 6px; border: 1px solid #86efac; display: inline-flex; align-items: center; gap: 6px;">
                                <span style="width: 8px; height: 8px; border-radius: 50%; background: #22c55e;"></span>
                                STATUS 1: TERSEDIA (PENJUALAN SUKARELA / SIAP BELI)
                            </span>
                            <span style="font-size: 12px; color: #166534; font-weight: 600;">Untuk aset siap beli langsung secara tunai atau KPR Syariah BPRS Wakalumi</span>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div>
                                <label style="display: block; font-weight: 700; font-size: 12px; color: #166534; margin-bottom: 4px;">Judul Kotak Prosedur</label>
                                <input type="text" name="options_lelang_status_tersedia_prosedur_title" value="<?php echo esc_attr( $statuses['tersedia']['prosedur_title'] ); ?>" style="width: 100%; border-radius: 6px; border: 1px solid #86efac; padding: 7px 10px; font-size: 12px; font-weight: 700;" placeholder="Contoh: Prosedur Pembelian Sukarela & Survei Fisik">
                                
                                <label style="display: block; font-weight: 700; font-size: 12px; color: #166534; margin-top: 10px; margin-bottom: 4px;">Teks Prosedur Pembelian & Survei Fisik Default</label>
                                <textarea name="options_lelang_status_tersedia_prosedur_desc" rows="4" style="width: 100%; border-radius: 6px; border: 1px solid #86efac; padding: 7px 10px; font-size: 12px; line-height: 1.4;" placeholder="Jelaskan mekanisme survei fisik langsung bersama bank dan pengajuan KPR Syariah..."><?php echo esc_textarea( $statuses['tersedia']['prosedur_desc'] ); ?></textarea>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 700; font-size: 12px; color: #166534; margin-bottom: 4px;">Judul Kotak Kepatuhan Hukum & Fatwa DSN-MUI</label>
                                <input type="text" name="options_lelang_status_tersedia_kepatuhan_title" value="<?php echo esc_attr( $statuses['tersedia']['kepatuhan_title'] ); ?>" style="width: 100%; border-radius: 6px; border: 1px solid #86efac; padding: 7px 10px; font-size: 12px; font-weight: 700;" placeholder="Contoh: Kepatuhan Syariah & Hukum (Penjualan Damai Sukarela):">
                                
                                <label style="display: block; font-weight: 700; font-size: 12px; color: #166534; margin-top: 10px; margin-bottom: 4px;">Teks Kepatuhan Hukum & Fatwa DSN-MUI</label>
                                <textarea name="options_lelang_status_tersedia_kepatuhan_desc" rows="4" style="width: 100%; border-radius: 6px; border: 1px solid #86efac; padding: 7px 10px; font-size: 12px; line-height: 1.4;" placeholder="Pernyataan kesepakatan damai atas izin tertulis debitur dan pengembalian kelebihan dana..."><?php echo esc_textarea( $statuses['tersedia']['kepatuhan_desc'] ); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Status: Akan Dilelang (Terjadwal di KPKNL) -->
                    <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 12px; padding: 18px;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; flex-wrap: wrap; gap: 8px;">
                            <span style="background: #fef3c7; color: #b45309; font-weight: 800; font-size: 12px; padding: 4px 10px; border-radius: 6px; border: 1px solid #fcd34d; display: inline-flex; align-items: center; gap: 6px;">
                                <span style="width: 8px; height: 8px; border-radius: 50%; background: #f59e0b;"></span>
                                STATUS 2: AKAN DILELANG (TERJADWAL DI KPKNL)
                            </span>
                            <span style="font-size: 12px; color: #92400e; font-weight: 600;">Untuk lelang eksekusi Hak Tanggungan via lelang.go.id KPKNL</span>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div>
                                <label style="display: block; font-weight: 700; font-size: 12px; color: #92400e; margin-bottom: 4px;">Judul Kotak Prosedur</label>
                                <input type="text" name="options_lelang_status_akan_dilelang_prosedur_title" value="<?php echo esc_attr( $statuses['akan_dilelang']['prosedur_title'] ); ?>" style="width: 100%; border-radius: 6px; border: 1px solid #fcd34d; padding: 7px 10px; font-size: 12px; font-weight: 700;" placeholder="Contoh: Prosedur Keikutsertaan Lelang & Survei Fisik">
                                
                                <label style="display: block; font-weight: 700; font-size: 12px; color: #92400e; margin-top: 10px; margin-bottom: 4px;">Teks Prosedur Keikutsertaan Lelang & Survei Default</label>
                                <textarea name="options_lelang_status_akan_dilelang_prosedur_desc" rows="4" style="width: 100%; border-radius: 6px; border: 1px solid #fcd34d; padding: 7px 10px; font-size: 12px; line-height: 1.4;" placeholder="Jelaskan tata cara registrasi lelang.go.id, setoran uang jaminan VA KPKNL, dan survei as is where is..."><?php echo esc_textarea( $statuses['akan_dilelang']['prosedur_desc'] ); ?></textarea>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 700; font-size: 12px; color: #92400e; margin-bottom: 4px;">Judul Kotak Kepatuhan Hukum & Fatwa DSN-MUI</label>
                                <input type="text" name="options_lelang_status_akan_dilelang_kepatuhan_title" value="<?php echo esc_attr( $statuses['akan_dilelang']['kepatuhan_title'] ); ?>" style="width: 100%; border-radius: 6px; border: 1px solid #fcd34d; padding: 7px 10px; font-size: 12px; font-weight: 700;" placeholder="Contoh: Kepatuhan Hukum & Fatwa DSN-MUI (Eksekusi Hak Tanggungan):">
                                
                                <label style="display: block; font-weight: 700; font-size: 12px; color: #92400e; margin-top: 10px; margin-bottom: 4px;">Teks Kepatuhan Hukum & Fatwa DSN-MUI</label>
                                <textarea name="options_lelang_status_akan_dilelang_kepatuhan_desc" rows="4" style="width: 100%; border-radius: 6px; border: 1px solid #fcd34d; padding: 7px 10px; font-size: 12px; line-height: 1.4;" placeholder="Pernyataan Pasal 6 UU Hak Tanggungan dan Fatwa DSN-MUI No. 47 mengenai hak debitur atas kelebihan dana..."><?php echo esc_textarea( $statuses['akan_dilelang']['kepatuhan_desc'] ); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Status: Terjual (Selesai Likuidasi) -->
                    <div style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 12px; padding: 18px;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; flex-wrap: wrap; gap: 8px;">
                            <span style="background: #e2e8f0; color: #475569; font-weight: 800; font-size: 12px; padding: 4px 10px; border-radius: 6px; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; gap: 6px;">
                                <span style="width: 8px; height: 8px; border-radius: 50%; background: #64748b;"></span>
                                STATUS 3: TERJUAL (SELESAI LIKUIDASI)
                            </span>
                            <span style="font-size: 12px; color: #475569; font-weight: 600;">Untuk aset yang telah laku terlelang dan proses administrasi/risalah selesai</span>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div>
                                <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Judul Kotak Informasi</label>
                                <input type="text" name="options_lelang_status_terjual_prosedur_title" value="<?php echo esc_attr( $statuses['terjual']['prosedur_title'] ); ?>" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 12px; font-weight: 700;" placeholder="Contoh: Informasi Status Likuidasi Aset">
                                
                                <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-top: 10px; margin-bottom: 4px;">Teks Informasi Status Penjualan Default</label>
                                <textarea name="options_lelang_status_terjual_prosedur_desc" rows="4" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 12px; line-height: 1.4;" placeholder="Pemberitahuan bahwa lelang telah selesai dan risalah lelang telah terbit..."><?php echo esc_textarea( $statuses['terjual']['prosedur_desc'] ); ?></textarea>
                            </div>
                            <div>
                                <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Judul Kotak Kepatuhan & Akuntabilitas</label>
                                <input type="text" name="options_lelang_status_terjual_kepatuhan_title" value="<?php echo esc_attr( $statuses['terjual']['kepatuhan_title'] ); ?>" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 12px; font-weight: 700;" placeholder="Contoh: Akuntabilitas & Penyelesaian Transaksi Syariah:">
                                
                                <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-top: 10px; margin-bottom: 4px;">Teks Akuntabilitas & Pengembalian Hak Debitur</label>
                                <textarea name="options_lelang_status_terjual_kepatuhan_desc" rows="4" style="width: 100%; border-radius: 6px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 12px; line-height: 1.4;" placeholder="Pernyataan penyelesaian berkekuatan hukum tetap dan pengembalian sisa dana ke debitur..."><?php echo esc_textarea( $statuses['terjual']['kepatuhan_desc'] ); ?></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ============================================================
                 KOTAK 6: DAFTAR ASET LELANG & AYDA (REPEATER)
                 ============================================================ -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 15px; border-bottom: 1px solid #f1f5f9; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <h2 style="font-size: 16px; font-weight: 800; color: #088395; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <span>🏢</span> Daftar Aset Agunan & AYDA
                        </h2>
                        <p style="margin: 4px 0 0; color: #64748b; font-size: 12px;">
                            Tambahkan aset yang dilelang atau dijual. Klik judul kartu untuk membuka/menutup formulir detail.
                        </p>
                    </div>
                    <button type="button" id="btn-add-lelang" class="button button-primary" style="background: #088395; border-color: #066e7d; font-weight: 700; border-radius: 8px; padding: 4px 16px; display: inline-flex; align-items: center; gap: 6px;">
                        <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px; margin-top: 2px;"></span> Tambah Aset Lelang Baru
                    </button>
                </div>

                <!-- Repeater Container -->
                <div id="lelang-repeater-container" style="margin-top: 20px; display: flex; flex-direction: column; gap: 16px;">
                    <?php if ( empty( $lelang_list ) ) : ?>
                        <div id="no-lelang-notice" style="text-align: center; padding: 40px 20px; background: #f8fafc; border-radius: 12px; border: 2px dashed #cbd5e1;">
                            <span style="font-size: 36px; display: block; margin-bottom: 10px;">🏷️</span>
                            <strong style="color: #334155; font-size: 14px;">Belum Ada Aset Lelang Terdaftar</strong>
                            <p style="color: #64748b; font-size: 12px; margin: 6px 0 15px;">Klik tombol di bawah untuk menambahkan data lelang pertama Anda.</p>
                        </div>
                    <?php endif; ?>

                    <?php 
                    $index = 0;
                    foreach ( $lelang_list as $item ) : 
                        $index++;
                        $row_id        = esc_attr( $item['id'] ?? ( 'lelang_' . $index ) );
                        $kode          = esc_attr( $item['kode'] ?? ( 'AYDA-' . $index ) );
                        $judul         = esc_attr( $item['judul'] ?? '' );
                        $kategori      = esc_attr( $item['kategori'] ?? 'rumah' );
                        $status        = esc_attr( $item['status'] ?? 'tersedia' );
                        $harga_limit   = esc_attr( $item['harga_limit'] ?? '' );
                        $nilai_pasar   = esc_attr( $item['nilai_pasar'] ?? '' );
                        $uang_jaminan  = esc_attr( $item['uang_jaminan'] ?? '' );
                        $legalitas     = esc_attr( $item['legalitas'] ?? '' );
                        $luas_tanah    = esc_attr( $item['luas_tanah'] ?? '' );
                        $luas_bangunan = esc_attr( $item['luas_bangunan'] ?? '' );
                        $lokasi        = esc_textarea( $item['lokasi'] ?? '' );
                        $kota          = esc_attr( $item['kota'] ?? 'Tangerang Selatan' );
                        $tgl_lelang    = esc_attr( $item['tanggal_lelang'] ?? '' );
                        $tempat_lelang = esc_attr( $item['tempat_lelang'] ?? '' );
                        $foto_utama    = esc_url( $item['foto_utama'] ?? '' );
                        $galeri_foto   = esc_textarea( $item['galeri_foto'] ?? '' );
                        $deskripsi     = esc_textarea( $item['deskripsi'] ?? '' );
                        $tata_cara        = esc_textarea( $item['tata_cara'] ?? '' );
                        $kepatuhan_custom = esc_textarea( $item['kepatuhan_custom'] ?? '' );
                        $wa_contact       = esc_attr( $item['wa_contact'] ?? '' );
                        $urutan           = (int)( $item['urutan'] ?? $index );
                    ?>
                        <div class="lelang-card" data-row-id="<?php echo $row_id; ?>" style="background: #ffffff; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05); transition: border-color 0.2s;">
                            <!-- Card Header (Click to Accordion Toggle) -->
                            <div class="lelang-card-header" style="background: #f8fafc; padding: 14px 18px; display: flex; align-items: center; justify-content: space-between; cursor: pointer; border-bottom: 1px solid #e2e8f0; user-select: none;">
                                <div style="display: flex; align-items: center; gap: 12px; flex: 1; min-width: 0;">
                                    <span class="lelang-card-number" style="font-weight: 800; font-size: 13px; color: #088395; background: #e0f2fe; padding: 2px 8px; border-radius: 6px;">#<?php echo $index; ?></span>
                                    <span class="lelang-card-kode" style="font-family: monospace; font-size: 11px; font-weight: 700; background: #f1f5f9; padding: 2px 6px; border-radius: 4px; color: #475569; border: 1px solid #e2e8f0;"><?php echo $kode ?: 'KODE'; ?></span>
                                    <strong class="lelang-preview-title" style="font-size: 14px; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 480px;">
                                        <?php echo $judul ?: '(Aset Baru — Belum ada judul)'; ?>
                                    </strong>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span class="lelang-preview-price" style="font-size: 12px; font-weight: 700; color: #059669;"><?php echo $harga_limit ? esc_html( $harga_limit ) : ''; ?></span>
                                    <button type="button" class="button-link btn-delete-card" style="color: #ef4444; font-size: 12px; padding: 4px 8px;" title="Hapus Aset Ini">
                                        <span class="dashicons dashicons-trash" style="font-size: 16px; width: 16px; height: 16px; vertical-align: middle;"></span>
                                    </button>
                                    <span class="btn-toggle-card dashicons dashicons-arrow-down-alt2" style="color: #94a3b8; font-size: 16px;"></span>
                                </div>
                            </div>

                            <!-- Card Body (Form Input Fields) -->
                            <div class="lelang-card-body" style="padding: 20px 22px; display: none;">
                                <input type="hidden" name="lelang_id[]" value="<?php echo $row_id; ?>">
                                <input type="hidden" name="lelang_urutan[]" class="card-urutan-input" value="<?php echo $urutan; ?>">

                                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Nama / Judul Aset Lelang <span style="color:#ef4444;">*</span></label>
                                        <input type="text" name="lelang_judul[]" value="<?php echo $judul; ?>" class="lelang-judul-input" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Contoh: Rumah Tinggal 2 Lantai Strategis Pamulang">
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Kode Aset / AYDA</label>
                                        <input type="text" name="lelang_kode[]" value="<?php echo $kode; ?>" class="lelang-kode-input" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; font-family: monospace;" placeholder="AYDA-2026-001">
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Kategori Aset</label>
                                        <select name="lelang_kategori[]" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 13px;">
                                            <?php foreach ( $categories as $ckey => $cval ) : ?>
                                                <option value="<?php echo esc_attr( $ckey ); ?>" <?php selected( $kategori, $ckey ); ?>>
                                                    <?php echo esc_html( $cval['label'] ); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Status Lelang</label>
                                        <select name="lelang_status[]" class="lelang-status-select" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 13px;">
                                            <?php foreach ( $statuses as $skey => $sval ) : ?>
                                                <option value="<?php echo esc_attr( $skey ); ?>" <?php selected( $status, $skey ); ?>>
                                                    <?php echo esc_html( $sval['label'] ); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Harga Limit Lelang (Rp) <span style="color:#ef4444;">*</span></label>
                                        <input type="text" name="lelang_harga_limit[]" value="<?php echo $harga_limit; ?>" class="lelang-price-input" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; font-weight: 700; color: #059669;" placeholder="Rp 650.000.000">
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Nilai Taksiran Pasar (Rp)</label>
                                        <input type="text" name="lelang_nilai_pasar[]" value="<?php echo $nilai_pasar; ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Rp 850.000.000">
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Uang Jaminan Penawaran</label>
                                        <input type="text" name="lelang_uang_jaminan[]" value="<?php echo $uang_jaminan; ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Rp 130.000.000">
                                    </div>
                                </div>

                                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Bukti Legalitas / Sertifikat</label>
                                        <input type="text" name="lelang_legalitas[]" value="<?php echo $legalitas; ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Contoh: SHM No. 04821 / BPKB Asli">
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Luas Tanah (LT)</label>
                                        <input type="text" name="lelang_luas_tanah[]" value="<?php echo $luas_tanah; ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Contoh: 120 m²">
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Luas Bangunan (LB)</label>
                                        <input type="text" name="lelang_luas_bangunan[]" value="<?php echo $luas_bangunan; ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Contoh: 150 m²">
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Kota / Wilayah</label>
                                        <input type="text" name="lelang_kota[]" value="<?php echo $kota; ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Tangerang Selatan">
                                    </div>
                                </div>

                                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Alamat Lengkap Aset</label>
                                        <textarea name="lelang_lokasi[]" rows="2" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Jl. Raya Surya Kencana No. 12, Kel. Pamulang Barat..."><?php echo $lokasi; ?></textarea>
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Tanggal / Jadwal Lelang</label>
                                        <input type="text" name="lelang_tanggal_lelang[]" value="<?php echo $tgl_lelang; ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="26 November 2026">
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Tempat / Penyelenggara Lelang</label>
                                        <input type="text" name="lelang_tempat_lelang[]" value="<?php echo $tempat_lelang; ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="KPKNL Tangerang / lelang.go.id">
                                    </div>
                                </div>

                                <!-- Foto Utama Aset -->
                                <div style="margin-bottom: 15px; padding: 14px; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                                    <label style="display: block; font-weight: 700; font-size: 12px; color: #334155; margin-bottom: 8px;">
                                        📷 Foto Utama Aset (Tampil pada Kartu & Cover Modal)
                                    </label>
                                    <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
                                        <img id="lelang_preview_img_<?php echo $index; ?>" src="<?php echo $foto_utama; ?>" style="max-width: 130px; max-height: 85px; border-radius: 8px; object-fit: cover; border: 1px solid #cbd5e1; <?php echo empty( $foto_utama ) ? 'display:none;' : ''; ?>">
                                        <div style="display: flex; flex-direction: column; gap: 6px;">
                                            <button type="button" class="button wkl-upload-img-btn" data-target="lelang_input_img_<?php echo $index; ?>" data-preview="lelang_preview_img_<?php echo $index; ?>" style="display: inline-flex; align-items: center; gap: 5px;">
                                                <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah / Pilih Foto
                                            </button>
                                            <button type="button" class="button-link wkl-remove-img-btn" data-target="lelang_input_img_<?php echo $index; ?>" data-preview="lelang_preview_img_<?php echo $index; ?>" style="color: #ef4444; font-size: 12px; <?php echo empty( $foto_utama ) ? 'display:none;' : ''; ?>">
                                                ✕ Hapus Foto
                                            </button>
                                        </div>
                                        <input type="text" id="lelang_input_img_<?php echo $index; ?>" name="lelang_foto_utama[]" value="<?php echo $foto_utama; ?>" style="flex: 1; min-width: 250px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 13px;" placeholder="...atau tempel URL foto langsung">
                                    </div>
                                </div>

                                <!-- Galeri Foto Tambahan (Multi-Photo for Swipe Carousel) -->
                                <div style="margin-bottom: 15px; padding: 14px; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                                        <label style="font-weight: 700; font-size: 12px; color: #334155;">
                                            🖼️ Galeri Foto Tambahan (Untuk Swipe / Slider di Modal Detail)
                                        </label>
                                        <button type="button" class="button button-small wkl-upload-multi-btn" data-target="lelang_galeri_<?php echo $index; ?>" style="font-size: 11px;">
                                            + Tambah dari Media Library
                                        </button>
                                    </div>
                                    <textarea id="lelang_galeri_<?php echo $index; ?>" name="lelang_galeri_foto[]" rows="3" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 12px; font-family: monospace; line-height: 1.5;" placeholder="Tempel URL foto tambahan (1 URL per baris)"><?php echo $galeri_foto; ?></textarea>
                                    <span style="font-size: 11px; color: #64748b;">Masukkan 1 URL gambar per baris. Foto-foto ini akan otomatis menjadi slider/swipe di modal detail.</span>
                                </div>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Deskripsi & Spesifikasi Lengkap</label>
                                        <textarea name="lelang_deskripsi[]" rows="4" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; line-height: 1.5;" placeholder="Jelaskan kondisi bangunan, jumlah kamar, daya listrik, keunggulan akses jalan, dll."><?php echo $deskripsi; ?></textarea>
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Tata Cara / Prosedur Pembelian Khusus (Opsional)</label>
                                        <textarea name="lelang_tata_cara[]" rows="4" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; line-height: 1.5;" placeholder="Kosongkan jika ingin memakai prosedur standar sesuai status di atas..."><?php echo $tata_cara; ?></textarea>
                                        <span style="font-size: 11px; color: #64748b;">Kosongkan jika ingin otomatis menggunakan prosedur bawaan status (Tersedia/Akan Dilelang/Terjual).</span>
                                    </div>
                                </div>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Catatan Kepatuhan Khusus Aset Ini (Opsional)</label>
                                        <textarea name="lelang_kepatuhan_custom[]" rows="3" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; line-height: 1.5;" placeholder="Kosongkan jika ingin memakai kepatuhan standar sesuai status di atas..."><?php echo $kepatuhan_custom; ?></textarea>
                                        <span style="font-size: 11px; color: #64748b;">Kosongkan jika ingin otomatis menggunakan catatan kepatuhan hukum/syariah bawaan status.</span>
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Nomor WA Khusus PIC Aset Ini (Opsional)</label>
                                        <input type="text" name="lelang_wa_contact[]" value="<?php echo $wa_contact; ?>" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 13px;" placeholder="Kosongkan jika memakai nomor WA default bank">
                                        <span style="font-size: 11px; color: #64748b;">Nomor WhatsApp khusus untuk pertanyaan terkait aset lelang ini.</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top: 20px; text-align: right;">
                    <button type="button" id="btn-add-lelang-bottom" class="button" style="border-radius: 8px; font-weight: 600;">
                        + Tambah Aset Lelang Lainnya
                    </button>
                </div>
            </div>

            <!-- Submit Button Bar -->
            <div style="position: sticky; bottom: 20px; z-index: 50; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 15px 25px; border-radius: 14px; border: 1px solid #cbd5e1; box-shadow: 0 4px 20px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between;">
                <span style="font-size: 13px; color: #64748b; font-weight: 600;">
                    Simpan seluruh perubahan informasi dan daftar aset lelang agunan (AYDA).
                </span>
                <button type="submit" name="wakalumi_save_lelang" class="button button-primary" style="background: #088395; border-color: #066e7d; font-size: 14px; font-weight: 800; padding: 8px 30px; border-radius: 8px; height: auto;">
                    💾 Simpan Pengaturan Lelang
                </button>
            </div>
        </form>
    </div>

    <!-- PILAR REPEATER TEMPLATE -->
    <template id="tmpl-pilar-card">
        <div class="pilar-card-item" style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 14px; position: relative;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                <span class="pilar-card-number" style="display: inline-block; font-size: 11px; font-weight: 800; color: #166534; text-transform: uppercase;">Pilar {{num}}</span>
                <button type="button" class="button-link btn-delete-pilar" style="color: #ef4444; font-size: 12px; text-decoration: none;" title="Hapus Pilar Ini">
                    <span class="dashicons dashicons-trash" style="font-size: 15px; width: 15px; height: 15px; vertical-align: middle;"></span> Hapus
                </button>
            </div>
            <input type="text" name="options_lelang_pilar_item_title[]" value="" style="width: 100%; border-radius: 6px; border: 1px solid #86efac; padding: 6px 10px; font-size: 12px; font-weight: 700; margin-bottom: 8px;" placeholder="Judul Pilar (misal: Kelebihan Hasil Lelang Hak Nasabah)">
            <textarea name="options_lelang_pilar_item_desc[]" rows="3" style="width: 100%; border-radius: 6px; border: 1px solid #86efac; padding: 6px 10px; font-size: 12px; line-height: 1.4;" placeholder="Deskripsi penjelasan pilar..."></textarea>
        </div>
    </template>

    <!-- REPEATER JS TEMPLATE -->
    <template id="tmpl-lelang-card">
        <div class="lelang-card" data-row-id="{{row_id}}" style="background: #ffffff; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05); transition: border-color 0.2s;">
            <div class="lelang-card-header" style="background: #f8fafc; padding: 14px 18px; display: flex; align-items: center; justify-content: space-between; cursor: pointer; border-bottom: 1px solid #e2e8f0; user-select: none;">
                <div style="display: flex; align-items: center; gap: 12px; flex: 1; min-width: 0;">
                    <span class="lelang-card-number" style="font-weight: 800; font-size: 13px; color: #088395; background: #e0f2fe; padding: 2px 8px; border-radius: 6px;">#{{num}}</span>
                    <span class="lelang-card-kode" style="font-family: monospace; font-size: 11px; font-weight: 700; background: #f1f5f9; padding: 2px 6px; border-radius: 4px; color: #475569; border: 1px solid #e2e8f0;">AYDA-NEW</span>
                    <strong class="lelang-preview-title" style="font-size: 14px; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 480px;">
                        (Aset Baru — Belum ada judul)
                    </strong>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span class="lelang-preview-price" style="font-size: 12px; font-weight: 700; color: #059669;"></span>
                    <button type="button" class="button-link btn-delete-card" style="color: #ef4444; font-size: 12px; padding: 4px 8px;" title="Hapus Aset Ini">
                        <span class="dashicons dashicons-trash" style="font-size: 16px; width: 16px; height: 16px; vertical-align: middle;"></span>
                    </button>
                    <span class="btn-toggle-card dashicons dashicons-arrow-up-alt2" style="color: #94a3b8; font-size: 16px;"></span>
                </div>
            </div>

            <div class="lelang-card-body" style="padding: 20px 22px; display: block;">
                <input type="hidden" name="lelang_id[]" value="{{row_id}}">
                <input type="hidden" name="lelang_urutan[]" class="card-urutan-input" value="{{num}}">

                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Nama / Judul Aset Lelang <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="lelang_judul[]" class="lelang-judul-input" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Contoh: Rumah Tinggal 2 Lantai Minimalis Pamulang">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Kode Aset / AYDA</label>
                        <input type="text" name="lelang_kode[]" class="lelang-kode-input" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; font-family: monospace;" placeholder="AYDA-2026-006">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Kategori Aset</label>
                        <select name="lelang_kategori[]" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 13px;">
                            <?php foreach ( $categories as $ckey => $cval ) : ?>
                                <option value="<?php echo esc_attr( $ckey ); ?>">
                                    <?php echo esc_html( $cval['label'] ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Status Lelang</label>
                        <select name="lelang_status[]" class="lelang-status-select" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 13px;">
                            <?php foreach ( $statuses as $skey => $sval ) : ?>
                                <option value="<?php echo esc_attr( $skey ); ?>">
                                    <?php echo esc_html( $sval['label'] ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Harga Limit Lelang (Rp) <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="lelang_harga_limit[]" class="lelang-price-input" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; font-weight: 700; color: #059669;" placeholder="Rp 500.000.000">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Nilai Taksiran Pasar (Rp)</label>
                        <input type="text" name="lelang_nilai_pasar[]" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Rp 700.000.000">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Uang Jaminan Penawaran</label>
                        <input type="text" name="lelang_uang_jaminan[]" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Rp 100.000.000">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Bukti Legalitas / Sertifikat</label>
                        <input type="text" name="lelang_legalitas[]" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Contoh: SHM No. 04821 / BPKB Asli">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Luas Tanah (LT)</label>
                        <input type="text" name="lelang_luas_tanah[]" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Contoh: 120 m²">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Luas Bangunan (LB)</label>
                        <input type="text" name="lelang_luas_bangunan[]" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Contoh: 150 m²">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Kota / Wilayah</label>
                        <input type="text" name="lelang_kota[]" value="Tangerang Selatan" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Tangerang Selatan">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Alamat Lengkap Aset</label>
                        <textarea name="lelang_lokasi[]" rows="2" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Alamat lengkap lokasi aset..."></textarea>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Tanggal / Jadwal Lelang</label>
                        <input type="text" name="lelang_tanggal_lelang[]" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="Batas lelang atau siap huni">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Tempat / Penyelenggara Lelang</label>
                        <input type="text" name="lelang_tempat_lelang[]" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;" placeholder="KPKNL Tangerang / Kantor Bank">
                    </div>
                </div>

                <div style="margin-bottom: 15px; padding: 14px; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                    <label style="display: block; font-weight: 700; font-size: 12px; color: #334155; margin-bottom: 8px;">
                        📷 Foto Utama Aset (Tampil pada Kartu & Cover Modal)
                    </label>
                    <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
                        <img id="lelang_preview_img_{{index}}" src="" style="max-width: 130px; max-height: 85px; border-radius: 8px; object-fit: cover; border: 1px solid #cbd5e1; display: none;">
                        <div style="display: flex; flex-direction: column; gap: 6px;">
                            <button type="button" class="button wkl-upload-img-btn" data-target="lelang_input_img_{{index}}" data-preview="lelang_preview_img_{{index}}" style="display: inline-flex; align-items: center; gap: 5px;">
                                <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah / Pilih Foto
                            </button>
                            <button type="button" class="button-link wkl-remove-img-btn" data-target="lelang_input_img_{{index}}" data-preview="lelang_preview_img_{{index}}" style="color: #ef4444; font-size: 12px; display: none;">
                                ✕ Hapus Foto
                            </button>
                        </div>
                        <input type="text" id="lelang_input_img_{{index}}" name="lelang_foto_utama[]" value="" style="flex: 1; min-width: 250px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 13px;" placeholder="...atau tempel URL foto langsung">
                    </div>
                </div>

                <div style="margin-bottom: 15px; padding: 14px; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                        <label style="font-weight: 700; font-size: 12px; color: #334155;">
                            🖼️ Galeri Foto Tambahan (Untuk Swipe / Slider di Modal Detail)
                        </label>
                        <button type="button" class="button button-small wkl-upload-multi-btn" data-target="lelang_galeri_{{index}}" style="font-size: 11px;">
                            + Tambah dari Media Library
                        </button>
                    </div>
                    <textarea id="lelang_galeri_{{index}}" name="lelang_galeri_foto[]" rows="3" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 12px; font-family: monospace; line-height: 1.5;" placeholder="Tempel URL foto tambahan (1 URL per baris)"></textarea>
                    <span style="font-size: 11px; color: #64748b;">Masukkan 1 URL gambar per baris. Foto-foto ini akan otomatis menjadi slider/swipe di modal detail.</span>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Deskripsi & Spesifikasi Lengkap</label>
                        <textarea name="lelang_deskripsi[]" rows="4" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; line-height: 1.5;" placeholder="Jelaskan kondisi bangunan, jumlah kamar, daya listrik, keunggulan akses jalan, dll."></textarea>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Tata Cara / Prosedur Pembelian Khusus (Opsional)</label>
                        <textarea name="lelang_tata_cara[]" rows="4" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; line-height: 1.5;" placeholder="Kosongkan jika ingin memakai prosedur standar sesuai status di atas..."></textarea>
                        <span style="font-size: 11px; color: #64748b;">Kosongkan jika ingin otomatis menggunakan prosedur bawaan status (Tersedia/Akan Dilelang/Terjual).</span>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Catatan Kepatuhan Khusus Aset Ini (Opsional)</label>
                        <textarea name="lelang_kepatuhan_custom[]" rows="3" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; line-height: 1.5;" placeholder="Kosongkan jika ingin memakai kepatuhan standar sesuai status di atas..."></textarea>
                        <span style="font-size: 11px; color: #64748b;">Kosongkan jika ingin otomatis menggunakan catatan kepatuhan hukum/syariah bawaan status.</span>
                    </div>
                    <div>
                        <label style="display: block; font-weight: 700; font-size: 12px; color: #475569; margin-bottom: 4px;">Nomor WA Khusus PIC Aset Ini (Opsional)</label>
                        <input type="text" name="lelang_wa_contact[]" value="" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 7px 10px; font-size: 13px;" placeholder="Kosongkan jika memakai nomor WA default bank">
                        <span style="font-size: 11px; color: #64748b;">Nomor WhatsApp khusus untuk pertanyaan terkait aset lelang ini.</span>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- ADMIN JS JQUERY SCRIPT -->
    <script>
    jQuery(document).ready(function($) {
        // --- PILAR REPEATER LOGIC ---
        function updatePilarNumbers() {
            var items = $('#pilar-repeater-container .pilar-card-item');
            if (items.length === 0) {
                if ($('#no-pilar-notice').length === 0) {
                    $('#pilar-repeater-container').append('<div id="no-pilar-notice" style="grid-column: 1 / -1; text-align: center; padding: 25px 15px; background: #f8fafc; border-radius: 10px; border: 1px dashed #cbd5e1; color: #64748b; font-size: 12px;">Belum ada pilar kepatuhan. Klik tombol <strong>+ Tambah Pilar Baru</strong> di atas untuk menambahkan.</div>');
                }
            } else {
                $('#no-pilar-notice').remove();
            }
            items.each(function(i) {
                $(this).find('.pilar-card-number').text('Pilar ' + (i + 1));
            });
        }

        $('#btn-add-pilar').on('click', function(e) {
            e.preventDefault();
            $('#no-pilar-notice').remove();
            var container = $('#pilar-repeater-container');
            var num = container.find('.pilar-card-item').length + 1;
            var templateHtml = $('#tmpl-pilar-card').html().replace(/\{\{num\}\}/g, num);
            var newCard = $(templateHtml);
            container.append(newCard);
            newCard.hide().fadeIn(200);
            updatePilarNumbers();
        });

        $(document).on('click', '.btn-delete-pilar', function(e) {
            e.preventDefault();
            if (confirm('Hapus pilar kepatuhan ini?')) {
                var card = $(this).closest('.pilar-card-item');
                card.fadeOut(200, function() {
                    card.remove();
                    updatePilarNumbers();
                });
            }
        });

        // Toggle Collapse Card
        $(document).on('click', '.lelang-card-header', function(e) {
            if ($(e.target).closest('.btn-delete-card').length) return;
            var body = $(this).closest('.lelang-card').find('.lelang-card-body');
            var icon = $(this).find('.btn-toggle-card');
            body.slideToggle(200);
            if (icon.hasClass('dashicons-arrow-down-alt2')) {
                icon.removeClass('dashicons-arrow-down-alt2').addClass('dashicons-arrow-up-alt2');
            } else {
                icon.removeClass('dashicons-arrow-up-alt2').addClass('dashicons-arrow-down-alt2');
            }
        });

        // Live Preview Title Update
        $(document).on('input', '.lelang-judul-input', function() {
            var val = $(this).val().trim();
            var preview = $(this).closest('.lelang-card').find('.lelang-preview-title');
            preview.text(val || '(Aset Baru — Belum ada judul)');
        });

        // Live Preview Kode Update
        $(document).on('input', '.lelang-kode-input', function() {
            var val = $(this).val().trim();
            var preview = $(this).closest('.lelang-card').find('.lelang-card-kode');
            preview.text(val || 'KODE');
        });

        // Live Preview Price Update
        $(document).on('input', '.lelang-price-input', function() {
            var val = $(this).val().trim();
            var preview = $(this).closest('.lelang-card').find('.lelang-preview-price');
            preview.text(val);
        });

        // Status border color update
        $(document).on('change', '.lelang-status-select', function() {
            var card = $(this).closest('.lelang-card');
            var st = $(this).val();
            if (st === 'terjual') {
                card.css('border-left-color', '#94a3b8');
            } else if (st === 'akan_dilelang') {
                card.css('border-left-color', '#f59e0b');
            } else {
                card.css('border-left-color', '#088395');
            }
        });

        // Add Card Logic
        $('#btn-add-lelang, #btn-add-lelang-bottom').on('click', function(e) {
            e.preventDefault();
            $('#no-lelang-notice').hide();
            var container = $('#lelang-repeater-container');
            var count = container.find('.lelang-card').length;
            var num = count + 1;
            var rowId = 'lelang_' + Date.now();
            var templateHtml = $('#tmpl-lelang-card').html();

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
            if (confirm('Yakin ingin menghapus aset lelang ini?')) {
                var card = $(this).closest('.lelang-card');
                card.slideUp(200, function() {
                    card.remove();
                    reindexCards();
                });
            }
        });

        function reindexCards() {
            var cards = $('#lelang-repeater-container .lelang-card');
            if (cards.length === 0) {
                $('#no-lelang-notice').show();
            }
            cards.each(function(i) {
                $(this).find('.lelang-card-number').text('#' + (i + 1));
                $(this).find('.card-urutan-input').val(i + 1);
            });
        }

        // Single Image Uploader
        $(document).on('click', '.wkl-upload-img-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $('#' + btn.data('target'));
            var previewImg  = $('#' + btn.data('preview'));
            var removeBtn   = btn.siblings('.wkl-remove-img-btn');

            var customUploader = wp.media({
                title: 'Pilih atau Unggah Foto Utama Aset Lelang',
                button: { text: 'Gunakan Foto Ini' },
                multiple: false,
                library: { type: 'image' }
            });

            customUploader.on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                previewImg.attr('src', attachment.url).show();
                removeBtn.show();
            });

            customUploader.open();
        });

        $(document).on('click', '.wkl-remove-img-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $('#' + btn.data('target'));
            var previewImg  = $('#' + btn.data('preview'));
            targetInput.val('');
            previewImg.attr('src', '').hide();
            btn.hide();
        });

        // Multi Image Uploader for Gallery Textarea
        $(document).on('click', '.wkl-upload-multi-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetTextarea = $('#' + btn.data('target'));

            var multiUploader = wp.media({
                title: 'Pilih Multi-Foto Galeri Aset Lelang',
                button: { text: 'Tambahkan ke Galeri' },
                multiple: true,
                library: { type: 'image' }
            });

            multiUploader.on('select', function() {
                var selection = multiUploader.state().get('selection');
                var currentVal = targetTextarea.val().trim();
                var newUrls = [];

                selection.each(function(attachment) {
                    var att = attachment.toJSON();
                    if (att.url) {
                        newUrls.push(att.url);
                    }
                });

                if (newUrls.length > 0) {
                    if (currentVal.length > 0) {
                        currentVal += "\n" + newUrls.join("\n");
                    } else {
                        currentVal = newUrls.join("\n");
                    }
                    targetTextarea.val(currentVal);
                }
            });

            multiUploader.open();
        });
    });
    </script>
    <?php
}

