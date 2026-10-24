<?php
/**
 * Wakalumi Theme — Admin Layanan Bank & Fasilitas Transaksi
 * Submenu of wakalumi-settings (Pengaturan Website)
 *
 * Mengelola konten halaman "Layanan" (/layanan-kami)
 * Termasuk Panduan Pembayaran Virtual Account (VA), Layanan Jemput Setoran,
 * Kartu Parameter Dinamis (Bisa Tambah/Ubah/Hapus/Atur Warna), Kotak Simulasi Perhitungan,
 * Sub-tab kanal bank, step-by-step tutorial, multi-image galeri infografis, dan FAQ.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ─────────────────────────────────────────────────────────────────────────────
// 1. DATA DEFAULT & HELPER PENGAMBILAN OPSI
// ─────────────────────────────────────────────────────────────────────────────
function wakalumi_get_default_layanan_items() {
    return [
        [
            'id'             => 'pembayaran-va',
            'title'          => 'Pembayaran Angsuran via Virtual Account (VA)',
            'short_title'    => 'Pembayaran Virtual Account',
            'badge'          => 'Layanan Digital 24/7',
            'icon'           => 'credit-card',
            'summary'        => 'Panduan bayar angsuran via Bank Permata Syariah & seluruh bank lain.',
            'intro'          => 'Bank Syariah Wakalumi bekerjasama dengan Bank Permata Syariah menyediakan fasilitas Virtual Account (VA) untuk kemudahan pembayaran angsuran pembiayaan Anda dari mana saja, kapan saja, dan melalui kanal perbankan apa pun secara real-time.',
            'partner_bank'   => 'Bank Permata Syariah (Kode Bank: 013)',
            'va_code_prefix' => '728262',
            'va_format'      => '728262 + Nomor Rekening Tabungan/Debitur Wakalumi',
            'va_example'     => '7282621080199999',
            'fee_info'       => 'PENTING: Tagihan nominal angsuran TIDAK MUNCUL OTOMATIS di layar monitor ATM atau aplikasi M-Banking. Anda wajib memasukkan jumlah saldo transfer secara manual dan menambahkan biaya admin transfer sebesar Rp 3.500 agar angsuran pokok & bagi hasil masuk secara utuh ke rekening pembiayaan Anda (Contoh: jika angsuran Rp 1.000.000, maka saldo yang diketik adalah Rp 1.003.500). Layar konfirmasi perbankan hanya memverifikasi Nama Nasabah/Debitur terdaftar di Bank Syariah Wakalumi.',
            'media_gallery'  => [],
            // Kartu Parameter Kunci (Dynamic, Full Modifiable, No Red)
            'param_cards'    => [
                [
                    'title'     => 'Bank Mitra Tujuan',
                    'value'     => 'Bank Permata Syariah (013)',
                    'desc'      => 'Pilih Bank Permata / Permata UUS di menu transfer bank Anda',
                    'color'     => 'teal',
                    'badge'     => '013',
                    'can_copy'  => false,
                    'copy_text' => '',
                ],
                [
                    'title'     => 'Format Nomor VA',
                    'value'     => '728262 + No. Rekening',
                    'desc'      => 'Ketik prefix 728262 dilanjutkan nomor rekening debitur Anda',
                    'color'     => 'emerald',
                    'badge'     => 'Kode VA',
                    'can_copy'  => true,
                    'copy_text' => '728262',
                ],
                [
                    'title'     => 'Input Nominal Mandiri',
                    'value'     => 'Tagihan Tidak Otomatis Muncul',
                    'desc'      => 'Ketik jumlah transfer angsuran Anda secara manual di aplikasi bank',
                    'color'     => 'amber',
                    'badge'     => 'Open Payment',
                    'can_copy'  => false,
                    'copy_text' => '',
                ],
                [
                    'title'     => 'Biaya Admin Switching',
                    'value'     => 'Wajib Tambah Rp 3.500',
                    'desc'      => 'Tambahkan ke saldo transfer agar angsuran pokok masuk utuh',
                    'color'     => 'sky',
                    'badge'     => '+Rp 3.500',
                    'can_copy'  => false,
                    'copy_text' => '',
                ],
            ],
            // Kotak Simulasi Perhitungan
            'show_simulation' => true,
            'sim_installment' => 'Rp 1.000.000',
            'sim_fee'         => 'Rp 3.500',
            'sim_total'       => 'Rp 1.003.500',
            'sim_note'        => '*Keterangan: Biaya Rp 3.500 dipotong langsung oleh jaringan switching perbankan. Jika Anda hanya mengirimkan Rp 1.000.000, maka dana bersih yang masuk ke rekening pembiayaan Anda menjadi Rp 996.500 (tercatat kurang bayar).',
            'channels'       => [
                [
                    'name'     => 'PermataMobile X (Sesama Bank Permata)',
                    'badge'    => 'Sesama Bank',
                    'steps'    => [
                        'Buka aplikasi PermataMobile X di smartphone Anda dan lakukan login dengan akun Anda.',
                        'Pilih menu "Pembayaran Tagihan" lalu pilih kategori "Virtual Account".',
                        'Masukkan Nomor Virtual Account Anda: format kode 728262 dilanjutkan nomor rekening debitur Anda (Contoh: 7282621080199999).',
                        'Ketik Nominal Angsuran Manual: Nominal tagihan TIDAK akan muncul otomatis. Masukkan jumlah saldo transfer secara manual dan tambahkan Rp 3.500 untuk biaya administrasi (Contoh: Rp 1.003.500).',
                        'Konfirmasi Nama Nasabah: Pada layar konfirmasi, periksa nama yang muncul. Pastikan yang tertera adalah Nama Nasabah/Debitur Anda yang terdaftar di Bank Syariah Wakalumi.',
                        'Selesaikan Transaksi: Masukkan Mobile PIN Anda hingga transaksi berhasil. Simpan resi/bukti transfer digital sebagai tanda bukti pembayaran sah.'
                    ]
                ],
                [
                    'name'     => 'Mobile Banking Bank Lain (BCA, Mandiri, BRI, BNI, BSI, dll)',
                    'badge'    => 'Antar Bank',
                    'steps'    => [
                        'Buka aplikasi M-Banking bank Anda (BCA Mobile, Livin by Mandiri, BRImo, BNI Mobile, BSI Mobile, CIMB Octo, dll) dan lakukan login.',
                        'Pilih menu "Transfer" lalu pilih "Transfer Antar Bank" / "Transfer ke Bank Lain".',
                        'Pilih Bank Tujuan: cari dan tentukan "Bank Permata" / "Bank Permata Syariah" / "Permata UUS" (Kode Bank: 013).',
                        'Masukkan Nomor Rekening Tujuan dengan Nomor Virtual Account: 728262 dilanjutkan nomor rekening debitur Anda (Contoh: 7282621080199999).',
                        'Ketik Nominal Manual (+ Rp 3.500): Tagihan TIDAK muncul otomatis di M-Banking bank lain. Masukkan nominal angsuran yang ingin dibayarkan secara manual ditambah Rp 3.500 untuk biaya admin (Contoh: jika angsuran Rp 1.000.000, ketik Rp 1.003.500).',
                        'Konfirmasi Nama Nasabah: Layar konfirmasi transfer akan menampilkan Nama Nasabah/Debitur terdaftar di Bank Syariah Wakalumi. Pastikan nama sudah tepat sesuai nama Anda.',
                        'Selesaikan & Simpan Bukti: Masukkan PIN M-Banking hingga transaksi dinyatakan BERHASIL. Simpan resi/screenshot bukti bayar.'
                    ]
                ],
                [
                    'name'     => 'Mesin ATM (Permata, Bersama, Prima, Alto)',
                    'badge'    => 'Mesin ATM',
                    'steps'    => [
                        'Masukkan kartu ATM dan PIN Anda di mesin ATM Permata atau ATM jaringan ATM Bersama, Prima, atau Alto.',
                        'Pilih menu transaksi: Jika ATM Permata, pilih "Transaksi Lainnya" > "Pembayaran" > "Virtual Account". Jika ATM Bank Lain, pilih "Transaksi Lainnya" > "Transfer" > "Ke Rekening Bank Lain" lalu masukkan Kode 013 diikuti nomor VA (Contoh: 0137282621080199999).',
                        'Input Nominal Manual: Masukkan jumlah saldo yang ingin Anda bayarkan secara manual (PENTING: Tagihan nominal TIDAK muncul otomatis di layar monitor ATM. Wajib tambahkan Rp 3.500 untuk biaya admin transfer, misal ketik Rp 1.003.500).',
                        'Konfirmasi Nama Nasabah: Layar monitor ATM akan menampilkan Nama Nasabah/Debitur yang terdaftar di Bank Syariah Wakalumi. Periksa kembali kecocokan nama nasabah. Jika nama sudah tepat sesuai nama Anda, pilih "Ya / Benar".',
                        'Ambil & Simpan Struk ATM: Mesin ATM akan mengeluarkan struk fisik bukti transfer. Ambil dan simpan struk fisik tersebut dengan baik sebagai bukti pembayaran sah.'
                    ]
                ],
                [
                    'name'     => 'Internet Banking (Web Portal)',
                    'badge'    => 'Web Portal',
                    'steps'    => [
                        'Login ke portal Internet Banking bank Anda melalui peramban resmi.',
                        'Pilih menu "Transfer Dana" > "Transfer Antar Bank" dengan tujuan Bank Permata Syariah (Kode Bank: 013).',
                        'Masukkan Nomor Rekening Tujuan dengan Nomor Virtual Account: 728262 + Nomor Rekening Debitur Wakalumi.',
                        'Ketik nominal pembayaran angsuran secara manual dan tambahkan biaya admin Rp 3.500.',
                        'Verifikasi Nama Nasabah/Debitur pada layar tinjauan data, lalu selesaikan otentikasi token / SMS OTP sesuai prosedur bank Anda. Cetak bukti transfer PDF.'
                    ]
                ]
            ],
            'faqs'           => [
                [
                    'q' => 'Mengapa nominal angsuran tidak muncul otomatis di layar?',
                    'a' => 'Sistem Virtual Account Bank Syariah Wakalumi menggunakan mekanisme Open Payment agar nasabah memiliki fleksibilitas dalam melakukan pembayaran angsuran maupun pelunasan. Oleh karena itu, nasabah memasukkan jumlah nominal secara mandiri dan menambahkan biaya admin transfer sebesar Rp 3.500.'
                ],
                [
                    'q' => 'Bagaimana jika nama yang muncul di layar bukan nama saya?',
                    'a' => 'Mohon jangan lanjutkan transaksi. Periksa kembali digit nomor rekening yang Anda masukkan setelah kode prefix 728262. Jika nomor rekening sudah benar namun nama tetap tidak sesuai, segera hubungi Customer Service Bank Syariah Wakalumi melalui WhatsApp di nomor resmi kami.'
                ],
                [
                    'q' => 'Mengapa saya wajib menambahkan Rp 3.500 ke saldo transfer?',
                    'a' => 'Biaya administrasi kanal switching antar-bank mitra sebesar Rp 3.500 didebet langsung dari total nominal yang Anda kirimkan. Agar angsuran pembiayaan Anda masuk dengan nilai bersih yang tepat sesuai kontrak, saldo transfer wajib ditambahkan Rp 3.500 (Contoh: angsuran Rp 1.000.000 maka transfer Rp 1.003.500).'
                ],
                [
                    'q' => 'Berapa lama waktu verifikasi pembayaran angsuran melalui VA?',
                    'a' => 'Pembayaran melalui Virtual Account diproses secara otomatis dan real-time oleh sistem perbankan. Namun kami menyarankan melakukan pembayaran pada hari kerja sebelum pukul 15.00 WIB untuk pencatatan administratif di hari yang sama.'
                ],
                [
                    'q' => 'Apakah saya harus menyimpan bukti transfer?',
                    'a' => 'Ya, sangat wajib. Simpan struk fisik ATM atau tangkapan layar (screenshot) bukti transfer M-Banking Anda. Anda juga dapat mengirimkannya kepada Account Officer (AO) pendamping Anda untuk mempermudah pengecekan berkas.'
                ]
            ]
        ],
        [
            'id'             => 'jemput-setoran',
            'title'          => 'Layanan Jemput Setoran (Pick-Up Service)',
            'short_title'    => 'Layanan Jemput Setoran',
            'badge'          => 'Layanan Lapangan Resmi',
            'icon'           => 'truck',
            'summary'        => 'Petugas resmi bank menjemput setoran tabungan & angsuran langsung ke lokasi Anda.',
            'intro'          => 'Bagi nasabah perorangan, pelaku UMKM, maupun lembaga dengan mobilitas tinggi, Bank Syariah Wakalumi menyediakan fasilitas Layanan Jemput Setoran langsung ke toko, kantor, atau rumah Anda secara aman dan tertib administrasi.',
            'partner_bank'   => 'Staf Lapangan Resmi Bank Syariah Wakalumi',
            'va_code_prefix' => '',
            'va_format'      => '',
            'va_example'     => '',
            'fee_info'       => 'Layanan Jemput Setoran ini bebas biaya administrasi tambahan (100% Bebas Biaya) untuk seluruh wilayah operasional terjangkau kantor pusat dan kantor kas Bank Syariah Wakalumi. Demi kenyamanan dan keamanan transaksi Anda, pastikan petugas yang hadir mengenakan seragam kerja resmi dan tanda pengenal (ID Card) aktif, serta selalu meminta lembar Tanda Terima Setoran Resmi yang telah ditandatangani dan dicap stempel validasi sah.',
            'media_gallery'  => [],
            'param_cards'    => [
                [
                    'title'     => 'Biaya Layanan',
                    'value'     => '100% Bebas Biaya (Gratis)',
                    'desc'      => 'Tanpa biaya administrasi tambahan bagi nasabah terdaftar Bank Syariah Wakalumi',
                    'color'     => 'emerald',
                    'badge'     => 'Gratis',
                    'can_copy'  => false,
                    'copy_text' => '',
                ],
                [
                    'title'     => 'Wilayah Jangkauan',
                    'value'     => 'Area Kantor Pusat & Kas',
                    'desc'      => 'Meliputi rute operasional petugas Account Officer di sekitar kantor cabang BSW',
                    'color'     => 'teal',
                    'badge'     => 'Area BSW',
                    'can_copy'  => false,
                    'copy_text' => '',
                ],
                [
                    'title'     => 'Legalitas Petugas',
                    'value'     => 'Seragam & ID Card Aktif',
                    'desc'      => 'Wajib membawa buku tanda terima setoran berstempel validasi sah',
                    'color'     => 'amber',
                    'badge'     => 'Resmi',
                    'can_copy'  => false,
                    'copy_text' => '',
                ],
                [
                    'title'     => 'Waktu Pembukuan',
                    'value'     => 'Real-Time Same Day',
                    'desc'      => 'Dana disetorkan sebelum 14.00 WIB langsung masuk rekening di hari yang sama',
                    'color'     => 'sky',
                    'badge'     => 'Hari Ini',
                    'can_copy'  => false,
                    'copy_text' => '',
                ],
            ],
            'show_simulation' => false,
            'sim_installment' => '',
            'sim_fee'         => '',
            'sim_total'       => '',
            'sim_note'        => '',
            'channels'       => [
                [
                    'name'     => 'Alur & Mekanisme Penjemputan',
                    'badge'    => 'Prosedur',
                    'steps'    => [
                        'Hubungi Customer Service atau Account Officer (AO) pendamping Anda minimal 1 hari sebelumnya atau pada pagi hari kerja.',
                        'Tentukan nominal setoran tabungan atau angsuran, serta alamat lengkap titik penjemputan.',
                        'Petugas resmi Bank Syariah Wakalumi akan mendatangi lokasi Anda sesuai jadwal dengan mengenakan seragam resmi dan tanda pengenal (ID Card) aktif.',
                        'Serahkan uang setoran kepada petugas untuk dihitung bersama secara transparan.',
                        'Petugas akan menyerahkan Formulir Tanda Terima Setoran Resmi yang telah ditandatangani dan dicap validasi.',
                        'Dana akan langsung dibukukan ke rekening tabungan atau kartu angsuran Anda pada hari yang sama.'
                    ]
                ]
            ],
            'faqs'           => [
                [
                    'q' => 'Bagaimana cara memastikan petugas yang datang adalah staf resmi?',
                    'a' => 'Setiap petugas resmi Bank Syariah Wakalumi wajib mengenakan seragam kerja resmi, membawa kartu identitas karyawan (ID Card) aktif dengan foto yang jelas, serta membawa buku tanda terima berstempel resmi bank. Anda juga dapat memverifikasi nama petugas melalui nomor WhatsApp resmi bank.'
                ],
                [
                    'q' => 'Berapa batas minimal setoran untuk layanan jemput bola ini?',
                    'a' => 'Tidak ada ketentuan batas minimal yang memberatkan. Fasilitas ini disesuaikan dengan kesepakatan jadwal dan rute penjemputan Account Officer di wilayah Anda.'
                ],
                [
                    'q' => 'Kapan dana saya masuk ke rekening tabungan/angsuran?',
                    'a' => 'Dana yang disetorkan sebelum pukul 14.00 WIB akan dibukukan ke sistem core banking pada hari kerja yang sama. Anda dapat memverifikasi mutasi saldo di buku tabungan atau konfirmasi via CS.'
                ]
            ]
        ]
    ];
}

function wakalumi_get_layanan_settings() {
    $defaults = [
        'breadcrumb_label'    => 'Layanan',
        'kicker'              => 'Fasilitas & Layanan Perbankan Syariah',
        'title'               => 'Layanan Kami',
        'subtitle'            => 'Solusi fasilitas transaksi perbankan syariah yang aman, modern, dan memudahkan setiap kebutuhan transaksi maupun pembayaran angsuran nasabah Bank Syariah Wakalumi.',
        // Hero Highlight Pills
        'hero_pill_1'         => 'Virtual Account 24/7 Real-Time',
        'hero_pill_2'         => 'Input Nominal Manual Bebas & Fleksibel',
        'hero_pill_3'         => 'Mitra Bank Permata Syariah (013)',
        // Hero Badge Card (Kanan)
        'hero_card_show'      => 1,
        'hero_card_badge'     => 'Fasilitas Nasabah BSW',
        'hero_card_title'     => 'Kanal Transaksi Digital & Lapangan',
        'hero_card_desc'      => 'Pembayaran angsuran pembiayaan via Virtual Account 24/7 dan layanan jemput setoran langsung ke lokasi Anda.',
        'hero_card_p1'        => 'Pembayaran Real-Time 24/7 Seluruh Bank',
        'hero_card_p2'        => 'Input Nominal Mandiri Bebas & Fleksibel',
        'hero_card_p3'        => 'Layanan Jemput Setoran Resmi Lapangan',
        'hero_card_p4'        => 'Otomatis Verifikasi Nama Nasabah',
        'hero_card_seal_left' => 'Transaksi Aman & Terverifikasi',
        'hero_card_seal_right'=> 'Prinsip Syariah',
        // Customer Service & Sidebar
        'cs_phone'            => '(021) 7471 4555',
        'cs_wa'               => '6281517380388',
        'cs_hours'            => 'Senin – Jumat: 08.00 – 15.00 WIB',
        'help_card_title'     => 'Butuh Bantuan Transaksi?',
        'help_card_desc'      => 'Tim Customer Service kami siap mendampingi panduan pembayaran VA dan konfirmasi transaksi Anda.',
        'items'               => wakalumi_get_default_layanan_items(),
    ];

    $settings = $defaults;

    $options_map = [
        'breadcrumb_label'    => 'options_layanan_breadcrumb_label',
        'kicker'              => 'options_layanan_kicker',
        'title'               => 'options_layanan_title',
        'subtitle'            => 'options_layanan_subtitle',
        'hero_pill_1'         => 'options_layanan_hero_pill_1',
        'hero_pill_2'         => 'options_layanan_hero_pill_2',
        'hero_pill_3'         => 'options_layanan_hero_pill_3',
        'hero_card_show'      => 'options_layanan_hero_card_show',
        'hero_card_badge'     => 'options_layanan_hero_card_badge',
        'hero_card_title'     => 'options_layanan_hero_card_title',
        'hero_card_desc'      => 'options_layanan_hero_card_desc',
        'hero_card_p1'        => 'options_layanan_hero_card_p1',
        'hero_card_p2'        => 'options_layanan_hero_card_p2',
        'hero_card_p3'        => 'options_layanan_hero_card_p3',
        'hero_card_p4'        => 'options_layanan_hero_card_p4',
        'hero_card_seal_left' => 'options_layanan_hero_card_seal_left',
        'hero_card_seal_right'=> 'options_layanan_hero_card_seal_right',
        'cs_phone'            => 'options_layanan_cs_phone',
        'cs_wa'               => 'options_layanan_cs_wa',
        'cs_hours'            => 'options_layanan_cs_hours',
        'help_card_title'     => 'options_layanan_help_card_title',
        'help_card_desc'      => 'options_layanan_help_card_desc',
    ];

    foreach ( $options_map as $key => $opt_name ) {
        $val = get_option( $opt_name );
        if ( false !== $val ) {
            if ( in_array( $key, [ 'hero_card_badge', 'hero_card_title', 'hero_card_desc', 'hero_card_p1', 'hero_card_p2', 'hero_card_p3', 'hero_card_p4', 'hero_card_seal_left', 'hero_card_seal_right' ], true ) && empty( $val ) ) {
                continue; // Gunakan default jika nilai di DB tersimpan string kosong
            }
            $settings[ $key ] = ( 'hero_card_show' === $key ) ? (bool) $val : $val;
        }
    }

    $saved_items_raw = get_option( 'options_layanan_items_json' );
    if ( ! empty( $saved_items_raw ) ) {
        $decoded = json_decode( $saved_items_raw, true );
        if ( is_array( $decoded ) && ! empty( $decoded ) ) {
            $default_items = wakalumi_get_default_layanan_items();
            $default_cards_map = [];
            foreach ( $default_items as $di ) {
                $default_cards_map[ $di['id'] ] = $di['param_cards'] ?? [];
            }

            // Normalisasi & backward compatibility
            foreach ( $decoded as &$item ) {
                if ( empty( $item['media_gallery'] ) ) {
                    $item['media_gallery'] = [];
                    if ( ! empty( $item['media_image'] ) ) {
                        $item['media_gallery'][] = [
                            'url'     => $item['media_image'],
                            'caption' => $item['media_caption'] ?? '',
                        ];
                    }
                }
                // Pastikan param_cards ada dan terisi default jika belum ada
                if ( empty( $item['param_cards'] ) || ! is_array( $item['param_cards'] ) ) {
                    $item['param_cards'] = $default_cards_map[ $item['id'] ?? '' ] ?? [];
                }
                // Pastikan fee_info & va_code_prefix tidak hilang
                if ( 'pembayaran-va' === ( $item['id'] ?? '' ) ) {
                    if ( empty( $item['fee_info'] ) ) {
                        $item['fee_info'] = 'PENTING: Tagihan nominal angsuran TIDAK MUNCUL OTOMATIS di layar monitor ATM atau aplikasi M-Banking. Anda wajib memasukkan jumlah saldo transfer secara manual dan menambahkan biaya admin transfer sebesar Rp 3.500 agar angsuran pokok & bagi hasil masuk secara utuh ke rekening pembiayaan Anda (Contoh: jika angsuran Rp 1.000.000, maka saldo yang diketik adalah Rp 1.003.500). Layar konfirmasi perbankan hanya memverifikasi Nama Nasabah/Debitur terdaftar di Bank Syariah Wakalumi.';
                    }
                    if ( empty( $item['va_code_prefix'] ) ) {
                        $item['va_code_prefix'] = '728262';
                    }
                    if ( empty( $item['va_format'] ) ) {
                        $item['va_format'] = '728262 + Nomor Rekening Tabungan/Debitur Wakalumi';
                    }
                    if ( empty( $item['va_example'] ) ) {
                        $item['va_example'] = '7282621080199999';
                    }
                }
                if ( 'jemput-setoran' === ( $item['id'] ?? '' ) ) {
                    if ( empty( $item['fee_info'] ) ) {
                        $item['fee_info'] = 'Layanan Jemput Setoran ini bebas biaya administrasi tambahan (100% Bebas Biaya) untuk seluruh wilayah operasional terjangkau kantor pusat dan kantor kas Bank Syariah Wakalumi. Demi kenyamanan dan keamanan transaksi Anda, pastikan petugas yang hadir mengenakan seragam kerja resmi dan tanda pengenal (ID Card) aktif, serta selalu meminta lembar Tanda Terima Setoran Resmi yang telah ditandatangani dan dicap stempel validasi sah.';
                    }
                }
            }
            $settings['items'] = $decoded;
        }
    }

    return $settings;
}

// ─────────────────────────────────────────────────────────────────────────────
// 2. REGISTRASI MENU ADMIN SEBAGAI SUBMENU DI BAWAH PENGATURAN WEBSITE
// ─────────────────────────────────────────────────────────────────────────────
add_action( 'admin_menu', 'wakalumi_register_layanan_admin_menu', 28 );
function wakalumi_register_layanan_admin_menu() {
    add_submenu_page(
        'wakalumi-settings',
        'Kelola Layanan Perbankan',
        'Layanan Perbankan',
        'manage_options',
        'wakalumi-layanan',
        'wakalumi_render_layanan_admin_page'
    );
}

// ─────────────────────────────────────────────────────────────────────────────
// 3. HANDLER SIMPAN SETTINGS (POST)
// ─────────────────────────────────────────────────────────────────────────────
function wakalumi_handle_layanan_save() {
    if ( ! isset( $_POST['wakalumi_layanan_nonce'] ) || ! check_admin_referer( 'wakalumi_save_layanan_action', 'wakalumi_layanan_nonce' ) ) {
        return false;
    }
    if ( ! current_user_can( 'manage_options' ) ) {
        return false;
    }

    // Reset ke preset default jika ditekan tombol reset
    if ( isset( $_POST['reset_layanan_defaults'] ) ) {
        $keys_to_delete = [
            'options_layanan_breadcrumb_label',
            'options_layanan_kicker',
            'options_layanan_title',
            'options_layanan_subtitle',
            'options_layanan_hero_pill_1',
            'options_layanan_hero_pill_2',
            'options_layanan_hero_pill_3',
            'options_layanan_hero_card_show',
            'options_layanan_hero_card_badge',
            'options_layanan_hero_card_title',
            'options_layanan_hero_card_desc',
            'options_layanan_hero_card_p1',
            'options_layanan_hero_card_p2',
            'options_layanan_hero_card_p3',
            'options_layanan_hero_card_p4',
            'options_layanan_hero_card_seal_left',
            'options_layanan_hero_card_seal_right',
            'options_layanan_cs_phone',
            'options_layanan_cs_wa',
            'options_layanan_cs_hours',
            'options_layanan_help_card_title',
            'options_layanan_help_card_desc',
            'options_layanan_items_json',
        ];
        foreach ( $keys_to_delete as $k ) {
            delete_option( $k );
        }
        return 'reset';
    }

    // Simpan Hero & Header
    update_option( 'options_layanan_breadcrumb_label', sanitize_text_field( wp_unslash( $_POST['breadcrumb_label'] ?? 'Layanan' ) ) );
    update_option( 'options_layanan_kicker', sanitize_text_field( wp_unslash( $_POST['kicker'] ?? '' ) ) );
    update_option( 'options_layanan_title', sanitize_text_field( wp_unslash( $_POST['title'] ?? '' ) ) );
    update_option( 'options_layanan_subtitle', sanitize_textarea_field( wp_unslash( $_POST['subtitle'] ?? '' ) ) );
    update_option( 'options_layanan_hero_pill_1', sanitize_text_field( wp_unslash( $_POST['hero_pill_1'] ?? '' ) ) );
    update_option( 'options_layanan_hero_pill_2', sanitize_text_field( wp_unslash( $_POST['hero_pill_2'] ?? '' ) ) );
    update_option( 'options_layanan_hero_pill_3', sanitize_text_field( wp_unslash( $_POST['hero_pill_3'] ?? '' ) ) );

    // Simpan Hero Badge Card
    update_option( 'options_layanan_hero_card_show', isset( $_POST['hero_card_show'] ) ? 1 : 0 );
    update_option( 'options_layanan_hero_card_badge', sanitize_text_field( wp_unslash( $_POST['hero_card_badge'] ?? '' ) ) );
    update_option( 'options_layanan_hero_card_title', sanitize_text_field( wp_unslash( $_POST['hero_card_title'] ?? '' ) ) );
    update_option( 'options_layanan_hero_card_desc', sanitize_textarea_field( wp_unslash( $_POST['hero_card_desc'] ?? '' ) ) );
    update_option( 'options_layanan_hero_card_p1', sanitize_text_field( wp_unslash( $_POST['hero_card_p1'] ?? '' ) ) );
    update_option( 'options_layanan_hero_card_p2', sanitize_text_field( wp_unslash( $_POST['hero_card_p2'] ?? '' ) ) );
    update_option( 'options_layanan_hero_card_p3', sanitize_text_field( wp_unslash( $_POST['hero_card_p3'] ?? '' ) ) );
    update_option( 'options_layanan_hero_card_p4', sanitize_text_field( wp_unslash( $_POST['hero_card_p4'] ?? '' ) ) );
    update_option( 'options_layanan_hero_card_seal_left', sanitize_text_field( wp_unslash( $_POST['hero_card_seal_left'] ?? '' ) ) );
    update_option( 'options_layanan_hero_card_seal_right', sanitize_text_field( wp_unslash( $_POST['hero_card_seal_right'] ?? '' ) ) );

    // Simpan Kontak CS & Jam Kerja
    update_option( 'options_layanan_cs_phone', sanitize_text_field( wp_unslash( $_POST['cs_phone'] ?? '' ) ) );
    update_option( 'options_layanan_cs_wa', sanitize_text_field( wp_unslash( $_POST['cs_wa'] ?? '' ) ) );
    update_option( 'options_layanan_cs_hours', sanitize_text_field( wp_unslash( $_POST['cs_hours'] ?? '' ) ) );
    update_option( 'options_layanan_help_card_title', sanitize_text_field( wp_unslash( $_POST['help_card_title'] ?? '' ) ) );
    update_option( 'options_layanan_help_card_desc', sanitize_textarea_field( wp_unslash( $_POST['help_card_desc'] ?? '' ) ) );

    // Proses Data Tab Layanan (Dynamic JSON Array)
    if ( isset( $_POST['layanan_items_json'] ) ) {
        $raw_json = wp_unslash( $_POST['layanan_items_json'] );
        $decoded  = json_decode( $raw_json, true );
        if ( is_array( $decoded ) ) {
            $clean_items = [];
            foreach ( $decoded as $it ) {
                $id = sanitize_title( $it['id'] ?? ( $it['title'] ?? 'layanan-' . time() ) );
                if ( empty( $id ) ) $id = 'layanan-' . rand( 100, 999 );

                // 1. Param Cards (Dynamic Highlight Parameter Cards)
                $param_cards = [];
                if ( ! empty( $it['param_cards'] ) && is_array( $it['param_cards'] ) ) {
                    foreach ( $it['param_cards'] as $pc ) {
                        $p_title = sanitize_text_field( $pc['title'] ?? '' );
                        if ( ! empty( $p_title ) ) {
                            $color = sanitize_text_field( $pc['color'] ?? 'teal' );
                            // Pastikan warna bukan merah
                            if ( in_array( $color, [ 'red', 'rose' ], true ) ) {
                                $color = 'amber';
                            }
                            $param_cards[] = [
                                'title'     => $p_title,
                                'value'     => sanitize_text_field( $pc['value'] ?? '' ),
                                'desc'      => sanitize_textarea_field( $pc['desc'] ?? '' ),
                                'badge'     => sanitize_text_field( $pc['badge'] ?? '' ),
                                'color'     => $color,
                                'can_copy'  => ! empty( $pc['can_copy'] ),
                                'copy_text' => sanitize_text_field( $pc['copy_text'] ?? '' ),
                            ];
                        }
                    }
                }

                // 2. Channels (Kanal Pembayaran & Steps)
                $channels = [];
                if ( ! empty( $it['channels'] ) && is_array( $it['channels'] ) ) {
                    foreach ( $it['channels'] as $ch ) {
                        $steps = [];
                        if ( ! empty( $ch['steps'] ) && is_array( $ch['steps'] ) ) {
                            foreach ( $ch['steps'] as $st ) {
                                $st = sanitize_text_field( $st );
                                if ( ! empty( $st ) ) $steps[] = $st;
                            }
                        }
                        $channels[] = [
                            'name'  => sanitize_text_field( $ch['name'] ?? 'Kanal Pembayaran' ),
                            'badge' => sanitize_text_field( $ch['badge'] ?? '' ),
                            'steps' => $steps,
                        ];
                    }
                }

                // 3. FAQ
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

                // 4. Media Gallery
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

                $clean_items[] = [
                    'id'              => $id,
                    'title'           => sanitize_text_field( $it['title'] ?? 'Layanan' ),
                    'short_title'     => sanitize_text_field( $it['short_title'] ?? ( $it['title'] ?? 'Layanan' ) ),
                    'badge'           => sanitize_text_field( $it['badge'] ?? '' ),
                    'icon'            => sanitize_text_field( $it['icon'] ?? 'credit-card' ),
                    'summary'         => sanitize_textarea_field( $it['summary'] ?? '' ),
                    'intro'           => sanitize_textarea_field( $it['intro'] ?? '' ),
                    'partner_bank'    => sanitize_text_field( $it['partner_bank'] ?? '' ),
                    'va_code_prefix'  => sanitize_text_field( $it['va_code_prefix'] ?? '' ),
                    'va_format'       => sanitize_text_field( $it['va_format'] ?? '' ),
                    'va_example'      => sanitize_text_field( $it['va_example'] ?? '' ),
                    'fee_info'        => sanitize_textarea_field( $it['fee_info'] ?? '' ),
                    'param_cards'     => $param_cards,
                    'show_simulation' => ! empty( $it['show_simulation'] ),
                    'sim_installment' => sanitize_text_field( $it['sim_installment'] ?? 'Rp 1.000.000' ),
                    'sim_fee'         => sanitize_text_field( $it['sim_fee'] ?? 'Rp 3.500' ),
                    'sim_total'       => sanitize_text_field( $it['sim_total'] ?? 'Rp 1.003.500' ),
                    'sim_note'        => sanitize_textarea_field( $it['sim_note'] ?? '' ),
                    'media_gallery'   => $gallery,
                    'channels'        => $channels,
                    'faqs'            => $faqs,
                ];
            }
            update_option( 'options_layanan_items_json', wp_json_encode( $clean_items ) );
        }
    }

    return true;
}

// ─────────────────────────────────────────────────────────────────────────────
// 4. RENDER UI ADMIN
// ─────────────────────────────────────────────────────────────────────────────
function wakalumi_render_layanan_admin_page() {
    $status = null;
    if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
        $status = wakalumi_handle_layanan_save();
    }

    $cfg = wakalumi_get_layanan_settings();
    wp_enqueue_media();
    ?>
    <div class="wrap" style="max-width: 1240px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
        
        <!-- Header Banner -->
        <div style="background: linear-gradient(135deg, #065f46 0%, #0f766e 100%); color: #fff; padding: 24px 28px; border-radius: 16px; margin-bottom: 24px; box-shadow: 0 10px 25px -5px rgba(6, 95, 70, 0.2);">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
                <div>
                    <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.15); padding: 4px 12px; border-radius: 999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">
                        <span>🏛️ Pengaturan Website &bull; Fasilitas Layanan Bank</span>
                    </div>
                    <h1 style="color: #fff; margin: 0; font-size: 26px; font-weight: 800; letter-spacing: -0.02em;">Kelola Layanan Perbankan</h1>
                    <p style="color: #ccfbf1; margin: 6px 0 0 0; font-size: 13px;">Kelola banner hero seragam, Hero Badge Card, tab layanan interaktif, kartu parameter bebas modifikasi, simulasi nominal, dan galeri infografis.</p>
                </div>
                <div>
                    <a href="<?php echo esc_url( home_url( '/layanan-kami/' ) ); ?>" target="_blank" class="button" style="background: #fff; color: #065f46; border: none; font-weight: 700; padding: 8px 18px; border-radius: 999px; height: auto; text-decoration: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        Lihat Halaman Live ↗
                    </a>
                </div>
            </div>
        </div>

        <?php if ( $status === true ) : ?>
            <div class="notice notice-success is-dismissible" style="border-radius: 8px; border-left-color: #10b981; padding: 12px 16px;">
                <p style="font-weight: 700; color: #065f46; margin: 0;">✓ Pengaturan Halaman Layanan berhasil disimpan!</p>
            </div>
        <?php elseif ( $status === 'reset' ) : ?>
            <div class="notice notice-warning is-dismissible" style="border-radius: 8px; border-left-color: #f59e0b; padding: 12px 16px;">
                <p style="font-weight: 700; color: #b45309; margin: 0;">↺ Seluruh data layanan telah dikembalikan ke preset default resmi Bank Syariah Wakalumi.</p>
            </div>
        <?php endif; ?>

        <form method="post" action="" id="wakalumi-layanan-form" onsubmit="syncHiddenInput()">
            <?php wp_nonce_field( 'wakalumi_save_layanan_action', 'wakalumi_layanan_nonce' ); ?>
            <input type="hidden" name="layanan_items_json" id="layanan_items_json" value="<?php echo esc_attr( wp_json_encode( $cfg['items'] ) ); ?>" />

            <!-- TAB NAVIGASI ADMIN -->
            <div style="display: flex; gap: 8px; margin-bottom: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 2px;">
                <button type="button" class="wkl-tab-btn active" onclick="switchAdminTab('tab-header')" id="btn-tab-header" style="background: #0f766e; color: #fff; border: none; padding: 10px 20px; border-radius: 8px 8px 0 0; font-weight: 700; font-size: 13px; cursor: pointer;">
                    1. Hero Section, Card Hero &amp; Bantuan
                </button>
                <button type="button" class="wkl-tab-btn" onclick="switchAdminTab('tab-items')" id="btn-tab-items" style="background: #e2e8f0; color: #475569; border: none; padding: 10px 20px; border-radius: 8px 8px 0 0; font-weight: 700; font-size: 13px; cursor: pointer;">
                    2. Daftar Layanan, Kartu Parameter &amp; Tutorial VA
                </button>
            </div>

            <!-- TAB 1: HERO SECTION & CARD BANTUAN -->
            <div id="section-tab-header" class="wkl-admin-section" style="background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                
                <!-- Hero Section Settings (Simpel & Seragam dengan Laporan / Brosur) -->
                <h3 style="margin-top: 0; font-size: 15px; font-weight: 800; color: #0f766e; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px;">
                    A. Pengaturan Hero Section (Simpel, Bersih &amp; Terfokus)
                </h3>

                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row" style="width: 260px;"><label for="breadcrumb_label">Label Breadcrumb</label></th>
                        <td>
                            <input name="breadcrumb_label" type="text" id="breadcrumb_label" value="<?php echo esc_attr( $cfg['breadcrumb_label'] ?? 'Layanan' ); ?>" class="regular-text" style="width: 100%; max-width: 350px;" />
                            <p class="description">Teks link pada jejak navigasi atas (default: <code>Layanan</code>, format: Beranda / Layanan).</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="kicker">Kicker Label (Badge Atas)</label></th>
                        <td>
                            <input name="kicker" type="text" id="kicker" value="<?php echo esc_attr( $cfg['kicker'] ); ?>" class="regular-text" style="width: 100%; max-width: 500px;" />
                            <p class="description">Badge kecil di atas judul utama (default: <code>Fasilitas & Layanan Perbankan Syariah</code>). Ditampilkan dengan titik animasi halus tanpa icon petir.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="title">Judul Utama Hero (H1)</label></th>
                        <td>
                            <input name="title" type="text" id="title" value="<?php echo esc_attr( $cfg['title'] ); ?>" class="regular-text" style="width: 100%; max-width: 500px; font-weight: 700;" />
                            <p class="description">Judul besar halaman (default: <code>Layanan Kami</code>).</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="subtitle">Deskripsi Sub-Judul Hero</label></th>
                        <td>
                            <textarea name="subtitle" id="subtitle" rows="3" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $cfg['subtitle'] ); ?></textarea>
                            <p class="description">Paragraf pengantar resmi layanan perbankan di bawah judul hero.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Pills Keunggulan (Di Bawah Sub-Judul)</label></th>
                        <td>
                            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; max-width: 650px;">
                                <div>
                                    <label style="display:block; font-size:11px; font-weight:700; color:#475569; margin-bottom:3px;">Pill 1</label>
                                    <input name="hero_pill_1" type="text" value="<?php echo esc_attr( $cfg['hero_pill_1'] ); ?>" style="width:100%;" />
                                </div>
                                <div>
                                    <label style="display:block; font-size:11px; font-weight:700; color:#475569; margin-bottom:3px;">Pill 2</label>
                                    <input name="hero_pill_2" type="text" value="<?php echo esc_attr( $cfg['hero_pill_2'] ); ?>" style="width:100%;" />
                                </div>
                                <div>
                                    <label style="display:block; font-size:11px; font-weight:700; color:#475569; margin-bottom:3px;">Pill 3</label>
                                    <input name="hero_pill_3" type="text" value="<?php echo esc_attr( $cfg['hero_pill_3'] ); ?>" style="width:100%;" />
                                </div>
                            </div>
                            <p class="description" style="margin-top:6px;">Tiga sorotan pilar utama layanan (misal: Virtual Account 24/7 Real-Time, Input Nominal Manual, Bebas Biaya Pick-Up Service).</p>
                        </td>
                    </tr>
                </table>

                <!-- Hero Badge Card Kanan (Kartu Spotlight Seragam Pengaduan & Karir) -->
                <h3 style="margin-top: 28px; font-size: 15px; font-weight: 800; color: #0f766e; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px;">
                    B. Hero Badge Card Kanan (Fasilitas &amp; Keamanan Transaksi)
                </h3>

                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row" style="width: 260px;">Tampilkan Kartu Kanan</th>
                        <td>
                            <label style="font-weight: 600;">
                                <input name="hero_card_show" type="checkbox" value="1" <?php checked( $cfg['hero_card_show'] ); ?> />
                                Tampilkan 1 Spotlight Card di sebelah kanan hero section (seragam dengan Pengaduan Konsumen &amp; Karir)
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="hero_card_badge">Badge Header Card</label></th>
                        <td>
                            <input name="hero_card_badge" type="text" id="hero_card_badge" value="<?php echo esc_attr( $cfg['hero_card_badge'] ); ?>" class="regular-text" style="width: 100%; max-width: 400px;" />
                            <p class="description">Badge kecil di atas judul kartu (default: <code>Fasilitas Nasabah BSW</code>).</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="hero_card_title">Judul Card</label></th>
                        <td>
                            <input name="hero_card_title" type="text" id="hero_card_title" value="<?php echo esc_attr( $cfg['hero_card_title'] ); ?>" class="regular-text" style="width: 100%; max-width: 450px; font-weight: 700;" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="hero_card_desc">Deskripsi Singkat Card</label></th>
                        <td>
                            <textarea name="hero_card_desc" id="hero_card_desc" rows="2" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $cfg['hero_card_desc'] ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>4 Poin Mikro Fasilitas (Grid 2x2)</label></th>
                        <td>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; max-width: 650px;">
                                <div>
                                    <label style="display:block; font-size:11px; font-weight:700; color:#475569; margin-bottom:3px;">Poin 1</label>
                                    <input name="hero_card_p1" type="text" value="<?php echo esc_attr( $cfg['hero_card_p1'] ); ?>" style="width:100%;" />
                                </div>
                                <div>
                                    <label style="display:block; font-size:11px; font-weight:700; color:#475569; margin-bottom:3px;">Poin 2</label>
                                    <input name="hero_card_p2" type="text" value="<?php echo esc_attr( $cfg['hero_card_p2'] ); ?>" style="width:100%;" />
                                </div>
                                <div>
                                    <label style="display:block; font-size:11px; font-weight:700; color:#475569; margin-bottom:3px;">Poin 3</label>
                                    <input name="hero_card_p3" type="text" value="<?php echo esc_attr( $cfg['hero_card_p3'] ); ?>" style="width:100%;" />
                                </div>
                                <div>
                                    <label style="display:block; font-size:11px; font-weight:700; color:#475569; margin-bottom:3px;">Poin 4</label>
                                    <input name="hero_card_p4" type="text" value="<?php echo esc_attr( $cfg['hero_card_p4'] ); ?>" style="width:100%;" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Teks Seal / Validasi Bawah</label></th>
                        <td>
                            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 10px; max-width: 650px;">
                                <div>
                                    <label style="display:block; font-size:11px; font-weight:700; color:#475569; margin-bottom:3px;">Teks Kiri (Verifikasi)</label>
                                    <input name="hero_card_seal_left" type="text" value="<?php echo esc_attr( $cfg['hero_card_seal_left'] ); ?>" style="width:100%;" />
                                </div>
                                <div>
                                    <label style="display:block; font-size:11px; font-weight:700; color:#475569; margin-bottom:3px;">Badge Kanan</label>
                                    <input name="hero_card_seal_right" type="text" value="<?php echo esc_attr( $cfg['hero_card_seal_right'] ); ?>" style="width:100%;" />
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>

                <!-- Customer Service & Sidebar Help Card -->
                <h3 style="margin-top: 28px; font-size: 15px; font-weight: 800; color: #0f766e; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px;">
                    C. Kontak Bantuan &amp; Sidebar Help Card
                </h3>

                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row" style="width: 260px;"><label for="cs_wa">WhatsApp Layanan Nasabah</label></th>
                        <td>
                            <input name="cs_wa" type="text" id="cs_wa" value="<?php echo esc_attr( $cfg['cs_wa'] ); ?>" class="regular-text" style="width: 100%; max-width: 320px;" />
                            <p class="description">Format nomor WhatsApp internasional tanpa plus (contoh: <code>6281517380388</code>).</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="cs_phone">Telepon Layanan</label></th>
                        <td>
                            <input name="cs_phone" type="text" id="cs_phone" value="<?php echo esc_attr( $cfg['cs_phone'] ); ?>" class="regular-text" style="width: 100%; max-width: 320px;" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="cs_hours">Jam Operasional Layanan</label></th>
                        <td>
                            <input name="cs_hours" type="text" id="cs_hours" value="<?php echo esc_attr( $cfg['cs_hours'] ); ?>" class="regular-text" style="width: 100%; max-width: 400px;" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="help_card_title">Judul Card Bantuan Sidebar</label></th>
                        <td>
                            <input name="help_card_title" type="text" id="help_card_title" value="<?php echo esc_attr( $cfg['help_card_title'] ); ?>" class="regular-text" style="width: 100%; max-width: 500px;" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="help_card_desc">Keterangan Card Bantuan Sidebar</label></th>
                        <td>
                            <textarea name="help_card_desc" id="help_card_desc" rows="2" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $cfg['help_card_desc'] ); ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- TAB 2: DAFTAR LAYANAN, KARTU PARAMETER & PANDUAN INTERAKTIF -->
            <div id="section-tab-items" class="wkl-admin-section" style="display: none; background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; flex-wrap: wrap; gap: 12px;">
                    <div>
                        <h3 style="margin: 0; font-size: 16px; font-weight: 800; color: #1e293b;">
                            Daftar Tab Layanan (Modul Dinamis &amp; Bebas Modifikasi)
                        </h3>
                        <p style="margin: 4px 0 0 0; color: #64748b; font-size: 12px;">Kelola kartu parameter (ubah, tambah, hapus, atur warna tema non-merah), simulasi nominal, galeri foto, kanal pembayaran, dan FAQ per layanan.</p>
                    </div>
                    <button type="button" class="button button-primary" onclick="addNewServiceItem()" style="background: #0f766e; border-color: #0f766e; font-weight: 700; border-radius: 6px;">
                        + Tambah Layanan Baru
                    </button>
                </div>

                <!-- Container Item-Item Layanan -->
                <div id="layanan-items-builder" style="display: flex; flex-direction: column; gap: 20px;">
                    <!-- Di-render via JavaScript di bawah -->
                </div>
            </div>

            <!-- Action Buttons Footer -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 10px; border-top: 1px solid #e2e8f0; margin-top: 20px;">
                <button type="submit" class="button button-primary" style="background: #065f46; border-color: #065f46; font-size: 14px; font-weight: 700; padding: 8px 24px; border-radius: 8px; height: auto;">
                    💾 Simpan Pengaturan Layanan
                </button>

                <button type="submit" name="reset_layanan_defaults" value="1" class="button" onclick="return confirm('Apakah Anda yakin ingin mereset seluruh data layanan ke pengaturan awal Bank Syariah Wakalumi?');" style="color: #dc2626; border-color: #fecaca; background: #fef2f2; font-size: 12px; border-radius: 6px;">
                    ↺ Kembalikan ke Preset Default
                </button>
            </div>
        </form>
    </div>

    <!-- Script Pengelola Dinamis Item Layanan -->
    <script>
    var currentItems = <?php echo wp_json_encode( $cfg['items'] ); ?>;

    function switchAdminTab(tabId) {
        document.getElementById('section-tab-header').style.display = (tabId === 'tab-header') ? 'block' : 'none';
        document.getElementById('section-tab-items').style.display = (tabId === 'tab-items') ? 'block' : 'none';

        var btnH = document.getElementById('btn-tab-header');
        var btnI = document.getElementById('btn-tab-items');
        if (tabId === 'tab-header') {
            btnH.style.background = '#0f766e'; btnH.style.color = '#fff';
            btnI.style.background = '#e2e8f0'; btnI.style.color = '#475569';
        } else {
            btnI.style.background = '#0f766e'; btnI.style.color = '#fff';
            btnH.style.background = '#e2e8f0'; btnH.style.color = '#475569';
        }
    }

    function syncHiddenInput() {
        document.getElementById('layanan_items_json').value = JSON.stringify(currentItems);
    }

    function renderItemsBuilder() {
        syncHiddenInput();
        var container = document.getElementById('layanan-items-builder');
        if (!container) return;
        container.innerHTML = '';

        if (!currentItems || currentItems.length === 0) {
            container.innerHTML = '<div style="padding: 24px; text-align: center; background: #f8fafc; border-radius: 8px; color: #64748b;">Belum ada item layanan. Klik tombol "+ Tambah Layanan Baru" di atas.</div>';
            return;
        }

        currentItems.forEach(function(item, idx) {
            // Pastikan field terinisialisasi
            if (!item.param_cards) item.param_cards = [];
            if (!item.channels) item.channels = [];
            if (!item.faqs) item.faqs = [];
            if (!item.media_gallery) item.media_gallery = [];

            var card = document.createElement('div');
            card.style.cssText = 'background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 12px; padding: 20px; transition: all 0.2s;';

            var html = '';

            // 1. Header Card Item
            html += '<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; border-bottom:1px solid #e2e8f0; padding-bottom:12px; flex-wrap:wrap; gap:8px;">';
            html += '  <div style="display:flex; align-items:center; gap:8px;">';
            html += '    <span style="background:#0f766e; color:#fff; font-size:11px; font-weight:800; padding:3px 8px; border-radius:6px;">TAB #' + (idx + 1) + '</span>';
            html += '    <strong style="font-size:15px; color:#1e293b;">' + escapeHtml(item.title || 'Layanan Baru') + '</strong>';
            html += '  </div>';
            html += '  <div style="display:flex; gap:6px;">';
            if (idx > 0) {
                html += '    <button type="button" class="button button-small" onclick="moveItem(' + idx + ', -1)" title="Pindah Ke Atas">↑</button>';
            }
            if (idx < currentItems.length - 1) {
                html += '    <button type="button" class="button button-small" onclick="moveItem(' + idx + ', 1)" title="Pindah Ke Bawah">↓</button>';
            }
            html += '    <button type="button" class="button button-small" onclick="removeItem(' + idx + ')" style="color:#dc2626; border-color:#fca5a5;" title="Hapus Layanan Ini">🗑️ Hapus</button>';
            html += '  </div>';
            html += '</div>';

            // 2. Form Grid Field Dasar Layanan
            html += '<div style="display:grid; grid-template-columns: 2fr 1fr 1fr; gap:12px; margin-bottom:12px;">';
            html += '  <div>';
            html += '    <label style="display:block; font-weight:700; font-size:11px; margin-bottom:3px; color:#475569;">Judul Layanan Lengkap:</label>';
            html += '    <input type="text" value="' + escapeHtml(item.title || '') + '" onchange="updateItemField(' + idx + ', \'title\', this.value)" style="width:100%; border-radius:6px;" />';
            html += '  </div>';
            html += '  <div>';
            html += '    <label style="display:block; font-weight:700; font-size:11px; margin-bottom:3px; color:#475569;">Label Singkat Tab Sidebar:</label>';
            html += '    <input type="text" value="' + escapeHtml(item.short_title || '') + '" onchange="updateItemField(' + idx + ', \'short_title\', this.value)" style="width:100%; border-radius:6px;" />';
            html += '  </div>';
            html += '  <div>';
            html += '    <label style="display:block; font-weight:700; font-size:11px; margin-bottom:3px; color:#475569;">Badge Status Layanan:</label>';
            html += '    <input type="text" value="' + escapeHtml(item.badge || '') + '" onchange="updateItemField(' + idx + ', \'badge\', this.value)" placeholder="Layanan Digital 24/7" style="width:100%; border-radius:6px;" />';
            html += '  </div>';
            html += '</div>';

            html += '<div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px; margin-bottom:12px;">';
            html += '  <div>';
            html += '    <label style="display:block; font-weight:700; font-size:11px; margin-bottom:3px; color:#475569;">Ikon Tab Sidebar:</label>';
            html += '    <select onchange="updateItemField(' + idx + ', \'icon\', this.value)" style="width:100%; border-radius:6px;">';
            html += '      <option value="credit-card" ' + (item.icon === 'credit-card' ? 'selected' : '') + '>💳 Virtual Account / Kartu</option>';
            html += '      <option value="smartphone" ' + (item.icon === 'smartphone' ? 'selected' : '') + '>📱 M-Banking / Layanan Digital</option>';
            html += '      <option value="truck" ' + (item.icon === 'truck' ? 'selected' : '') + '>🚚 Jemput Setoran (Pick-Up Service)</option>';
            html += '      <option value="building" ' + (item.icon === 'building' ? 'selected' : '') + '>🏢 Kantor Cabang &amp; Mesin ATM</option>';
            html += '      <option value="shield-check" ' + (item.icon === 'shield-check' ? 'selected' : '') + '>🛡️ Keamanan &amp; Kepatuhan</option>';
            html += '      <option value="none" ' + (item.icon === 'none' ? 'selected' : '') + '>🔢 Tanpa Ikon (Otomatis Nomor Urut 01, 02)</option>';
            html += '    </select>';
            html += '  </div>';
            html += '  <div>';
            html += '    <label style="display:block; font-weight:700; font-size:11px; margin-bottom:3px; color:#475569;">Penyedia / Bank Mitra:</label>';
            html += '    <input type="text" value="' + escapeHtml(item.partner_bank || '') + '" onchange="updateItemField(' + idx + ', \'partner_bank\', this.value)" placeholder="Bank Permata Syariah (013)" style="width:100%; border-radius:6px;" />';
            html += '  </div>';
            html += '</div>';

            html += '<div style="margin-bottom:12px;">';
            html += '  <label style="display:block; font-weight:700; font-size:11px; margin-bottom:3px; color:#475569;">Ringkasan Singkat (Muncul di Bawah Judul Tab Sidebar):</label>';
            html += '  <input type="text" value="' + escapeHtml(item.summary || '') + '" onchange="updateItemField(' + idx + ', \'summary\', this.value)" style="width:100%; border-radius:6px;" />';
            html += '</div>';

            html += '<div style="margin-bottom:16px;">';
            html += '  <label style="display:block; font-weight:700; font-size:11px; margin-bottom:3px; color:#475569;">Paragraf Pengantar Lengkap:</label>';
            html += '  <textarea rows="2" onchange="updateItemField(' + idx + ', \'intro\', this.value)" style="width:100%; border-radius:6px;">' + escapeHtml(item.intro || '') + '</textarea>';
            html += '</div>';

            // ─────────────────────────────────────────────────────────────
            // SUB-SECTION: PARAMETER VIRTUAL ACCOUNT (OPSIONAL) & CATATAN PENTING (ALERT BOX)
            // ─────────────────────────────────────────────────────────────
            html += '<div style="background:#fffbeb; border:1px solid #fcd34d; border-radius:10px; padding:16px; margin-bottom:16px;">';
            html += '  <div style="display:flex; align-items:center; gap:8px; margin-bottom:10px;">';
            html += '    <span style="background:#f59e0b; color:#fff; font-weight:900; font-size:12px; width:22px; height:22px; border-radius:6px; display:inline-flex; align-items:center; justify-content:center;">!</span>';
            html += '    <div>';
            html += '      <strong style="font-size:13px; color:#92400e;">Format Kode VA (Khusus Layanan VA) &amp; Catatan Penting Layanan (Alert Box)</strong>';
            html += '      <p style="margin:2px 0 0 0; font-size:11px; color:#b45309;">Untuk layanan VA, isi kode prefix. Untuk layanan non-VA (seperti Jemput Setoran), kosongkan kode VA dan isi Catatan Penting untuk memandu nasabah.</p>';
            html += '    </div>';
            html += '  </div>';

            html += '  <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px; margin-bottom:10px;">';
            html += '    <div>';
            html += '      <label style="display:block; font-size:11px; font-weight:700; color:#78350f; margin-bottom:2px;">Kode Prefix Virtual Account (VA) — <em>Kosongkan jika bukan layanan VA</em>:</label>';
            html += '      <input type="text" value="' + escapeHtml(item.va_code_prefix || '') + '" onchange="updateItemField(' + idx + ', \'va_code_prefix\', this.value)" placeholder="Contoh: 728262 (opsional)" style="width:100%; border-radius:6px; font-weight:700; border-color:#fcd34d;" />';
            html += '    </div>';
            html += '    <div>';
            html += '      <label style="display:block; font-size:11px; font-weight:700; color:#78350f; margin-bottom:2px;">Contoh Lengkap Nomor VA:</label>';
            html += '      <input type="text" value="' + escapeHtml(item.va_example || '') + '" onchange="updateItemField(' + idx + ', \'va_example\', this.value)" placeholder="Contoh: 7282621080199999 (opsional)" style="width:100%; border-radius:6px; border-color:#fcd34d;" />';
            html += '    </div>';
            html += '  </div>';

            html += '  <div>';
            html += '    <label style="display:block; font-size:11px; font-weight:700; color:#78350f; margin-bottom:3px;">Catatan Penting Layanan (Tampil di Kotak Catatan Amber yang Ramah &amp; Mudah Dibaca):</label>';
            html += '    <textarea rows="3" onchange="updateItemField(' + idx + ', \'fee_info\', this.value)" style="width:100%; border-radius:6px; font-size:11px; border-color:#fcd34d; background:#fff;">' + escapeHtml(item.fee_info || '') + '</textarea>';
            html += '    <p style="font-size:11px; color:#b45309; margin:4px 0 0 0;">*Catatan ini akan tampil rapi dan elegan di frontend untuk memandu nasabah (misal: instruksi tambah biaya switching transfer pada VA, atau instruksi cek ID Card petugas pada Jemput Setoran).</p>';
            html += '  </div>';
            html += '</div>';

            // ─────────────────────────────────────────────────────────────
            // SUB-SECTION: KARTU PARAMETER KUNCI (DYNAMIC HIGHLIGHT CARDS)
            // ─────────────────────────────────────────────────────────────
            html += '<div style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:16px; margin-bottom:16px;">';
            html += '  <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px; border-bottom:1px solid #f1f5f9; padding-bottom:8px;">';
            html += '    <div>';
            html += '      <strong style="font-size:13px; color:#0f766e;">📊 Kartu Parameter Kunci (Highlight Informasi)</strong>';
            html += '      <p style="margin:2px 0 0 0; font-size:11px; color:#64748b;">Dapat ditambah, diubah judul, nominal/keterangan, warna tema (non-merah), tombol salin, atau dihapus jika tidak diperlukan.</p>';
            html += '    </div>';
            html += '    <button type="button" class="button button-small" onclick="addParamCard(' + idx + ')" style="background:#0f766e; color:#fff; border-color:#0f766e; font-weight:700;">+ Tambah Kartu Parameter</button>';
            html += '  </div>';

            if (!item.param_cards || item.param_cards.length === 0) {
                html += '  <div style="font-size:11px; color:#94a3b8; font-style:italic; padding:6px 0;">Tidak ada kartu parameter untuk layanan ini (bagian ini tidak akan tampil di frontend).</div>';
            } else {
                html += '  <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px;">';
                item.param_cards.forEach(function(pc, pIdx) {
                    var colorBg = '#f0fdfa';
                    if (pc.color === 'emerald') colorBg = '#ecfdf5';
                    if (pc.color === 'amber') colorBg = '#fffbeb';
                    if (pc.color === 'sky') colorBg = '#f0f9ff';
                    if (pc.color === 'purple') colorBg = '#faf5ff';
                    if (pc.color === 'slate') colorBg = '#f8fafc';

                    html += '    <div style="background:' + colorBg + '; border:1px solid #cbd5e1; border-radius:8px; padding:10px; position:relative;">';
                    html += '      <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">';
                    html += '        <span style="font-size:10px; font-weight:800; color:#475569; text-transform:uppercase;">Kartu #' + (pIdx + 1) + '</span>';
                    html += '        <button type="button" onclick="removeParamCard(' + idx + ', ' + pIdx + ')" style="background:none; border:none; color:#dc2626; font-size:11px; cursor:pointer; font-weight:700;">🗑️ Hapus</button>';
                    html += '      </div>';
                    
                    html += '      <div style="display:grid; grid-template-columns: 2fr 1fr; gap:6px; margin-bottom:6px;">';
                    html += '        <div>';
                    html += '          <label style="font-size:10px; font-weight:700; color:#334155; display:block;">Label / Judul:</label>';
                    html += '          <input type="text" value="' + escapeHtml(pc.title || '') + '" onchange="updateParamCard(' + idx + ', ' + pIdx + ', \'title\', this.value)" style="width:100%; font-size:11px; padding:3px 6px;" placeholder="Contoh: Input Nominal Mandiri" />';
                    html += '        </div>';
                    html += '        <div>';
                    html += '          <label style="font-size:10px; font-weight:700; color:#334155; display:block;">Badge Pill:</label>';
                    html += '          <input type="text" value="' + escapeHtml(pc.badge || '') + '" onchange="updateParamCard(' + idx + ', ' + pIdx + ', \'badge\', this.value)" style="width:100%; font-size:11px; padding:3px 6px;" placeholder="Open Payment" />';
                    html += '        </div>';
                    html += '      </div>';

                    html += '      <div style="margin-bottom:6px;">';
                    html += '        <label style="font-size:10px; font-weight:700; color:#334155; display:block;">Nilai / Teks Utama:</label>';
                    html += '        <input type="text" value="' + escapeHtml(pc.value || '') + '" onchange="updateParamCard(' + idx + ', ' + pIdx + ', \'value\', this.value)" style="width:100%; font-size:11px; font-weight:700; padding:3px 6px;" placeholder="Tagihan Tidak Otomatis Muncul" />';
                    html += '      </div>';

                    html += '      <div style="margin-bottom:6px;">';
                    html += '        <label style="font-size:10px; font-weight:700; color:#334155; display:block;">Keterangan / Catatan:</label>';
                    html += '        <input type="text" value="' + escapeHtml(pc.desc || '') + '" onchange="updateParamCard(' + idx + ', ' + pIdx + ', \'desc\', this.value)" style="width:100%; font-size:10px; padding:3px 6px;" placeholder="Ketik nominal transfer secara manual" />';
                    html += '      </div>';

                    html += '      <div style="display:grid; grid-template-columns: 1fr 1fr; gap:6px;">';
                    html += '        <div>';
                    html += '          <label style="font-size:10px; font-weight:700; color:#334155; display:block;">Tema Warna (Non-Merah):</label>';
                    html += '          <select onchange="updateParamCard(' + idx + ', ' + pIdx + ', \'color\', this.value)" style="width:100%; font-size:10px;">';
                    html += '            <option value="teal" ' + (pc.color === 'teal' ? 'selected' : '') + '>🌊 Toska Wakalumi</option>';
                    html += '            <option value="emerald" ' + (pc.color === 'emerald' ? 'selected' : '') + '>🟢 Hijau Zamrud</option>';
                    html += '            <option value="amber" ' + (pc.color === 'amber' ? 'selected' : '') + '>👑 Emas / Oranye</option>';
                    html += '            <option value="sky" ' + (pc.color === 'sky' ? 'selected' : '') + '>🔵 Biru Transaksi</option>';
                    html += '            <option value="purple" ' + (pc.color === 'purple' ? 'selected' : '') + '>🟣 Ungu Eksklusif</option>';
                    html += '            <option value="slate" ' + (pc.color === 'slate' ? 'selected' : '') + '>⚪ Abu-abu Netral</option>';
                    html += '          </select>';
                    html += '        </div>';
                    html += '        <div>';
                    html += '          <label style="font-size:10px; font-weight:700; color:#334155; display:block;">Tombol Salin Kode:</label>';
                    html += '          <label style="font-size:10px; display:inline-flex; align-items:center; gap:4px; margin-top:2px;">';
                    html += '            <input type="checkbox" ' + (pc.can_copy ? 'checked' : '') + ' onchange="updateParamCard(' + idx + ', ' + pIdx + ', \'can_copy\', this.checked)" />';
                    html += '            Aktifkan Salin';
                    html += '          </label>';
                    if (pc.can_copy) {
                        html += '          <input type="text" value="' + escapeHtml(pc.copy_text || '') + '" onchange="updateParamCard(' + idx + ', ' + pIdx + ', \'copy_text\', this.value)" placeholder="Teks yang disalin" style="width:100%; font-size:10px; margin-top:3px; padding:2px 4px;" />';
                    }
                    html += '        </div>';
                    html += '      </div>';

                    html += '    </div>';
                });
                html += '  </div>';
            }
            html += '</div>';

            // ─────────────────────────────────────────────────────────────
            // SUB-SECTION: SIMULASI PERHITUNGAN ANGSURAN
            // ─────────────────────────────────────────────────────────────
            html += '<div style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:16px; margin-bottom:16px;">';
            html += '  <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">';
            html += '    <strong style="font-size:13px; color:#0f766e;">🧮 Kotak Simulasi Perhitungan Angsuran</strong>';
            html += '    <label style="font-size:11px; font-weight:700; color:#065f46; display:inline-flex; align-items:center; gap:4px;">';
            html += '      <input type="checkbox" ' + (item.show_simulation ? 'checked' : '') + ' onchange="updateItemField(' + idx + ', \'show_simulation\', this.checked)" />';
            html += '      Tampilkan Kotak Simulasi di Halaman Ini';
            html += '    </label>';
            html += '  </div>';

            if (item.show_simulation) {
                html += '  <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:10px; margin-bottom:10px;">';
                html += '    <div>';
                html += '      <label style="display:block; font-size:11px; font-weight:700; color:#475569;">Angsuran Bulanan Pokok:</label>';
                html += '      <input type="text" value="' + escapeHtml(item.sim_installment || 'Rp 1.000.000') + '" onchange="updateItemField(' + idx + ', \'sim_installment\', this.value)" style="width:100%; border-radius:6px; font-size:12px;" />';
                html += '    </div>';
                html += '    <div>';
                html += '      <label style="display:block; font-size:11px; font-weight:700; color:#475569;">Biaya Admin Transfer:</label>';
                html += '      <input type="text" value="' + escapeHtml(item.sim_fee || 'Rp 3.500') + '" onchange="updateItemField(' + idx + ', \'sim_fee\', this.value)" style="width:100%; border-radius:6px; font-size:12px;" />';
                html += '    </div>';
                html += '    <div>';
                html += '      <label style="display:block; font-size:11px; font-weight:700; color:#065f46;">Total Diketik Nasabah:</label>';
                html += '      <input type="text" value="' + escapeHtml(item.sim_total || 'Rp 1.003.500') + '" onchange="updateItemField(' + idx + ', \'sim_total\', this.value)" style="width:100%; border-radius:6px; font-size:12px; font-weight:700;" />';
                html += '    </div>';
                html += '  </div>';
                html += '  <div>';
                html += '    <label style="display:block; font-size:11px; font-weight:700; color:#475569; margin-bottom:3px;">Keterangan / Edukasi Simulasi:</label>';
                html += '    <textarea rows="2" onchange="updateItemField(' + idx + ', \'sim_note\', this.value)" style="width:100%; border-radius:6px; font-size:11px;">' + escapeHtml(item.sim_note || '') + '</textarea>';
                html += '  </div>';
            }
            html += '</div>';

            // ─────────────────────────────────────────────────────────────
            // SUB-SECTION: MULTI-IMAGE MEDIA GALLERY
            // ─────────────────────────────────────────────────────────────
            html += '<div style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:16px; margin-bottom:16px;">';
            html += '  <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">';
            html += '    <div>';
            html += '      <strong style="font-size:13px; color:#0f766e;">🖼️ Infografis &amp; Panduan Visual (Bisa Banyak Gambar)</strong>';
            html += '      <p style="margin:2px 0 0 0; font-size:11px; color:#64748b;">Unggah flyer, brosur panduan M-Banking, atau infografis resmi. Nasabah dapat melihat perbesaran (Lightbox Zoom).</p>';
            html += '    </div>';
            html += '    <button type="button" class="button button-small" onclick="uploadServiceImage(' + idx + ')" style="background:#0f766e; color:#fff; border-color:#0f766e; font-weight:700;">+ Unggah Gambar</button>';
            html += '  </div>';

            if (!item.media_gallery || item.media_gallery.length === 0) {
                html += '  <div style="font-size:11px; color:#94a3b8; font-style:italic; padding:6px 0;">Belum ada gambar yang diunggah. Klik tombol "+ Unggah Gambar" jika sudah disiapkan tim media.</div>';
            } else {
                html += '  <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap:12px;">';
                item.media_gallery.forEach(function(img, gIdx) {
                    html += '    <div style="background:#f8fafc; border:1px solid #cbd5e1; border-radius:8px; overflow:hidden; position:relative;">';
                    html += '      <div style="height:120px; overflow:hidden; background:#000;">';
                    html += '        <img src="' + escapeHtml(img.url) + '" style="width:100%; height:100%; object-fit:cover;" />';
                    html += '      </div>';
                    html += '      <div style="padding:8px;">';
                    html += '        <input type="text" value="' + escapeHtml(img.caption || '') + '" onchange="updateGalleryCaption(' + idx + ', ' + gIdx + ', this.value)" placeholder="Keterangan gambar..." style="width:100%; font-size:10px; padding:3px 6px;" />';
                    html += '        <div style="display:flex; justify-content:flex-end; margin-top:6px;">';
                    html += '          <button type="button" onclick="removeGalleryImage(' + idx + ', ' + gIdx + ')" style="color:#dc2626; background:none; border:none; font-size:11px; cursor:pointer; font-weight:700;">Hapus</button>';
                    html += '        </div>';
                    html += '      </div>';
                    html += '    </div>';
                });
                html += '  </div>';
            }
            html += '</div>';

            // ─────────────────────────────────────────────────────────────
            // SUB-SECTION: KANAL PEMBAYARAN & STEP-BY-STEP
            // ─────────────────────────────────────────────────────────────
            html += '<div style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:16px; margin-bottom:16px;">';
            html += '  <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px; border-bottom:1px solid #f1f5f9; padding-bottom:8px;">';
            html += '    <div>';
            html += '      <strong style="font-size:13px; color:#0f766e;">📱 Kanal Pembayaran &amp; Panduan Langkah Transaksi</strong>';
            html += '      <p style="margin:2px 0 0 0; font-size:11px; color:#64748b;">Setiap kanal memiliki tombol pill tersendiri di halaman frontend.</p>';
            html += '    </div>';
            html += '    <button type="button" class="button button-small" onclick="addChannel(' + idx + ')" style="background:#0f766e; color:#fff; border-color:#0f766e; font-weight:700;">+ Tambah Kanal</button>';
            html += '  </div>';

            if (!item.channels || item.channels.length === 0) {
                html += '  <div style="font-size:11px; color:#94a3b8; font-style:italic;">Belum ada kanal pembayaran.</div>';
            } else {
                item.channels.forEach(function(ch, cIdx) {
                    html += '  <div style="background:#f8fafc; border:1px solid #cbd5e1; border-radius:8px; padding:12px; margin-bottom:10px;">';
                    html += '    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:8px;">';
                    html += '      <strong style="font-size:12px; color:#1e293b;">Kanal #' + (cIdx + 1) + ': ' + escapeHtml(ch.name || '') + '</strong>';
                    html += '      <button type="button" onclick="removeChannel(' + idx + ', ' + cIdx + ')" style="color:#dc2626; background:none; border:none; font-size:11px; cursor:pointer; font-weight:700;">🗑️ Hapus Kanal</button>';
                    html += '    </div>';
                    html += '    <div style="display:grid; grid-template-columns: 2fr 1fr; gap:10px; margin-bottom:8px;">';
                    html += '      <div>';
                    html += '        <label style="display:block; font-size:10px; font-weight:700; color:#475569;">Nama Kanal:</label>';
                    html += '        <input type="text" value="' + escapeHtml(ch.name || '') + '" onchange="updateChannelField(' + idx + ', ' + cIdx + ', \'name\', this.value)" style="width:100%; font-size:11px;" />';
                    html += '      </div>';
                    html += '      <div>';
                    html += '        <label style="display:block; font-size:10px; font-weight:700; color:#475569;">Badge Kanal:</label>';
                    html += '        <input type="text" value="' + escapeHtml(ch.badge || '') + '" onchange="updateChannelField(' + idx + ', ' + cIdx + ', \'badge\', this.value)" placeholder="Antar Bank / ATM" style="width:100%; font-size:11px;" />';
                    html += '      </div>';
                    html += '    </div>';
                    html += '    <div>';
                    html += '      <label style="display:block; font-size:10px; font-weight:700; color:#475569; margin-bottom:2px;">Petunjuk Langkah-Langkah (1 baris = 1 langkah):</label>';
                    html += '      <textarea rows="4" onchange="updateChannelSteps(' + idx + ', ' + cIdx + ', this.value)" style="width:100%; font-size:11px;">' + escapeHtml((ch.steps || []).join('\n')) + '</textarea>';
                    html += '    </div>';
                    html += '  </div>';
                });
            }
            html += '</div>';

            // ─────────────────────────────────────────────────────────────
            // SUB-SECTION: FAQ PER LAYANAN
            // ─────────────────────────────────────────────────────────────
            html += '<div style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; padding:16px;">';
            html += '  <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px; border-bottom:1px solid #f1f5f9; padding-bottom:8px;">';
            html += '    <div>';
            html += '      <strong style="font-size:13px; color:#0f766e;">❓ FAQ (Tanya Jawab Layanan)</strong>';
            html += '      <p style="margin:2px 0 0 0; font-size:11px; color:#64748b;">Pertanyaan umum spesifik untuk layanan ini.</p>';
            html += '    </div>';
            html += '    <button type="button" class="button button-small" onclick="addFaq(' + idx + ')" style="background:#0f766e; color:#fff; border-color:#0f766e; font-weight:700;">+ Tambah FAQ</button>';
            html += '  </div>';

            if (!item.faqs || item.faqs.length === 0) {
                html += '  <div style="font-size:11px; color:#94a3b8; font-style:italic;">Belum ada FAQ untuk layanan ini.</div>';
            } else {
                item.faqs.forEach(function(faq, fIdx) {
                    html += '  <div style="background:#f8fafc; border:1px solid #cbd5e1; border-radius:8px; padding:10px; margin-bottom:8px;">';
                    html += '    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px;">';
                    html += '      <strong style="font-size:11px; color:#1e293b;">Pertanyaan #' + (fIdx + 1) + '</strong>';
                    html += '      <button type="button" onclick="removeFaq(' + idx + ', ' + fIdx + ')" style="color:#dc2626; background:none; border:none; font-size:11px; cursor:pointer; font-weight:700;">Hapus</button>';
                    html += '    </div>';
                    html += '    <input type="text" value="' + escapeHtml(faq.q || '') + '" onchange="updateFaqField(' + idx + ', ' + fIdx + ', \'q\', this.value)" placeholder="Tuliskan pertanyaan..." style="width:100%; font-size:11px; margin-bottom:6px;" />';
                    html += '    <textarea rows="2" onchange="updateFaqField(' + idx + ', ' + fIdx + ', \'a\', this.value)" placeholder="Tuliskan jawaban..." style="width:100%; font-size:11px;">' + escapeHtml(faq.a || '') + '</textarea>';
                    html += '  </div>';
                });
            }
            html += '</div>';

            card.innerHTML = html;
            container.appendChild(card);
        });

        syncHiddenInput();
    }

    function escapeHtml(text) {
        if (!text) return '';
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // ─────────────────────────────────────────────────────────────
    // FUNGSI-FUNGSI MANIPULASI ITEM LAYANAN
    // ─────────────────────────────────────────────────────────────
    function addNewServiceItem() {
        var newId = 'layanan-' + Date.now();
        currentItems.push({
            id: newId,
            title: 'Layanan Baru',
            short_title: 'Layanan Baru',
            badge: 'Layanan Resmi',
            icon: 'credit-card',
            summary: 'Keterangan singkat layanan.',
            intro: 'Penjelasan lengkap fasilitas layanan perbankan.',
            partner_bank: 'Bank Syariah Wakalumi',
            param_cards: [
                {
                    title: 'Parameter 1',
                    value: 'Keterangan Nilai',
                    desc: 'Catatan penjelasan',
                    color: 'teal',
                    badge: 'Info',
                    can_copy: false,
                    copy_text: ''
                }
            ],
            show_simulation: false,
            sim_installment: '',
            sim_fee: '',
            sim_total: '',
            sim_note: '',
            media_gallery: [],
            channels: [
                {
                    name: 'Panduan Transaksi',
                    badge: 'Kanal',
                    steps: ['Langkah 1 petunjuk transaksi.', 'Langkah 2 selesaikan transaksi.']
                }
            ],
            faqs: []
        });
        renderItemsBuilder();
    }

    function removeItem(idx) {
        if (confirm('Hapus tab layanan ini?')) {
            currentItems.splice(idx, 1);
            renderItemsBuilder();
        }
    }

    function moveItem(idx, direction) {
        var target = idx + direction;
        if (target < 0 || target >= currentItems.length) return;
        var temp = currentItems[idx];
        currentItems[idx] = currentItems[target];
        currentItems[target] = temp;
        renderItemsBuilder();
    }

    function updateItemField(idx, field, value) {
        if (!currentItems[idx]) return;
        currentItems[idx][field] = value;
        syncHiddenInput();
    }

    // ─────────────────────────────────────────────────────────────
    // FUNGSI MANIPULASI KARTU PARAMETER (PARAM CARDS)
    // ─────────────────────────────────────────────────────────────
    function addParamCard(itemIdx) {
        if (!currentItems[itemIdx].param_cards) {
            currentItems[itemIdx].param_cards = [];
        }
        currentItems[itemIdx].param_cards.push({
            title: 'Parameter Baru',
            value: 'Nilai Kunci',
            desc: 'Catatan penjelasan parameter',
            color: 'teal',
            badge: 'Baru',
            can_copy: false,
            copy_text: ''
        });
        renderItemsBuilder();
    }

    function removeParamCard(itemIdx, pIdx) {
        if (confirm('Hapus kartu parameter ini?')) {
            currentItems[itemIdx].param_cards.splice(pIdx, 1);
            renderItemsBuilder();
        }
    }

    function updateParamCard(itemIdx, pIdx, field, value) {
        if (!currentItems[itemIdx] || !currentItems[itemIdx].param_cards[pIdx]) return;
        currentItems[itemIdx].param_cards[pIdx][field] = value;
        syncHiddenInput();
        if (field === 'can_copy' || field === 'color') {
            renderItemsBuilder();
        }
    }

    // ─────────────────────────────────────────────────────────────
    // FUNGSI MANIPULASI MEDIA GALLERY MULTI-IMAGE
    // ─────────────────────────────────────────────────────────────
    function uploadServiceImage(itemIdx) {
        var frame = wp.media({
            title: 'Pilih / Unggah Gambar Infografis Layanan',
            button: { text: 'Tambahkan ke Galeri Layanan' },
            multiple: true
        });

        frame.on('select', function() {
            var selection = frame.state().get('selection');
            selection.each(function(attachment) {
                var json = attachment.toJSON();
                if (!currentItems[itemIdx].media_gallery) {
                    currentItems[itemIdx].media_gallery = [];
                }
                currentItems[itemIdx].media_gallery.push({
                    url: json.url,
                    caption: json.title || ''
                });
            });
            renderItemsBuilder();
        });

        frame.open();
    }

    function removeGalleryImage(itemIdx, gIdx) {
        currentItems[itemIdx].media_gallery.splice(gIdx, 1);
        renderItemsBuilder();
    }

    function updateGalleryCaption(itemIdx, gIdx, value) {
        currentItems[itemIdx].media_gallery[gIdx].caption = value;
        syncHiddenInput();
    }

    // ─────────────────────────────────────────────────────────────
    // FUNGSI MANIPULASI KANAL & FAQ
    // ─────────────────────────────────────────────────────────────
    function addChannel(itemIdx) {
        if (!currentItems[itemIdx].channels) currentItems[itemIdx].channels = [];
        currentItems[itemIdx].channels.push({
            name: 'Kanal Baru',
            badge: 'Panduan',
            steps: ['Masukkan langkah 1.', 'Masukkan langkah 2.']
        });
        renderItemsBuilder();
    }

    function removeChannel(itemIdx, cIdx) {
        if (confirm('Hapus kanal pembayaran ini?')) {
            currentItems[itemIdx].channels.splice(cIdx, 1);
            renderItemsBuilder();
        }
    }

    function updateChannelField(itemIdx, cIdx, field, value) {
        currentItems[itemIdx].channels[cIdx][field] = value;
        syncHiddenInput();
    }

    function updateChannelSteps(itemIdx, cIdx, text) {
        var lines = text.split('\n');
        var cleaned = [];
        lines.forEach(function(l) {
            var trim = l.trim();
            if (trim.length > 0) cleaned.push(trim);
        });
        currentItems[itemIdx].channels[cIdx].steps = cleaned;
        syncHiddenInput();
    }

    function addFaq(itemIdx) {
        if (!currentItems[itemIdx].faqs) currentItems[itemIdx].faqs = [];
        currentItems[itemIdx].faqs.push({
            q: 'Pertanyaan baru seputar layanan ini?',
            a: 'Jawaban resmi dari Bank Syariah Wakalumi.'
        });
        renderItemsBuilder();
    }

    function removeFaq(itemIdx, fIdx) {
        currentItems[itemIdx].faqs.splice(fIdx, 1);
        renderItemsBuilder();
    }

    function updateFaqField(itemIdx, fIdx, field, value) {
        currentItems[itemIdx].faqs[fIdx][field] = value;
        syncHiddenInput();
    }

    // Initial render saat halaman dibuka
    document.addEventListener('DOMContentLoaded', function() {
        renderItemsBuilder();
    });
    </script>
    <?php
}
