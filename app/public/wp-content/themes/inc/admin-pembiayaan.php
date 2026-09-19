<?php
/**
 * Admin Panel: Produk Pembiayaan Syariah (Penyaluran Dana)
 *
 * Mengelola konten halaman Pembiayaan Syariah BPRS Wakalumi:
 * 8 Produk Resmi (Pedagang, Guru, Murabahah, Mudharabah, Musyarakah, Ijarah, Multijasa, Qardh),
 * Kalkulator Angsuran, Alur Pengajuan, FAQ, dan Banner CTA.
 * 100% Native WordPress Options API.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Registrasi Submenu di bawah "Pengaturan Wakalumi"
 */
function wakalumi_register_pembiayaan_admin_menu() {
    add_submenu_page(
        'wakalumi-settings',
        'Produk: Pembiayaan Syariah',
        'Produk: Pembiayaan',
        'manage_options',
        'wakalumi-pembiayaan',
        'wakalumi_render_pembiayaan_admin_page'
    );
}
add_action( 'admin_menu', 'wakalumi_register_pembiayaan_admin_menu', 24 );

/**
 * Helper: Ambil Daftar Produk Pembiayaan dengan Default Resmi BPRS Wakalumi
 */
function wakalumi_get_pembiayaan_list() {
    $saved = get_option( 'options_pembiayaan_list', null );
    if ( is_array( $saved ) && ! empty( $saved ) ) {
        return $saved;
    }

    return [
        [
            'nama'            => 'Pembiayaan 1000 Pedagang',
            'slug'            => 'pedagang',
            'tagline'         => 'Solusi Cepat Permodalan Usaha & Pedagang Pasar',
            'badge'           => 'Pedagang & UMKM',
            'color'           => 'orange',
            'akad'            => 'Murabahah / Mudharabah / Musyarakah',
            'limit_primary'   => 'Plafon Rp 5 Jt s.d. Rp 100 Juta',
            'limit_secondary' => 'Tenor 6 s.d. 36 Bulan',
            'desc'            => 'Fokus pembiayaan kepada Pedagang demi membantu pertumbuhan Usaha dan UMKM secara keseluruhan. Skema angsuran harian/mingguan/bulanan yang ringan disesuaikan dengan perputaran arus kas usaha pasar dan ritel Anda.',
            'keunggulan'      => "Proses cepat dan persyaratan mudah bersahabat\nFasilitas layanan jemput angsuran langsung ke lokasi usaha / pasar\nTanpa potongan biaya siluman dan bebas riba\nAkad syariah transparan dan menenangkan hati",
            'syarat'          => "Fotokopi e-KTP Pemohon dan Suami/Istri (jika sudah menikah)\nFotokopi Kartu Keluarga (KK) & Surat Nikah\nSurat Keterangan Usaha (SKU) dari Kelurahan / Pengelola Pasar\nBukti transaksi atau catatan pembukuan usaha sederhana",
            'wa_text'         => 'Halo BPRS Wakalumi, saya tertarik mengajukan Pembiayaan 1000 Pedagang untuk penambahan modal usaha saya. Mohon informasi syarat dan prosedurnya.',
            'icon'            => 'store',
            'urutan'          => 1,
        ],
        [
            'nama'            => 'Pembiayaan 1000 Guru',
            'slug'            => 'guru',
            'tagline'         => 'Dukungan Kesejahteraan & Sarana Tenaga Pendidik',
            'badge'           => 'Guru & Tenaga Kependidikan',
            'color'           => 'indigo',
            'akad'            => 'Murabahah / Ijarah Multijasa',
            'limit_primary'   => 'Plafon Rp 5 Jt s.d. Rp 50 Juta',
            'limit_secondary' => 'Tenor 12 s.d. 60 Bulan',
            'desc'            => 'Fokus pembiayaan sebagai sarana memenuhi kebutuhan Guru dan Pengajar dalam menjalankan tugas dan tanggung jawab. Dapat dimanfaatkan untuk kepemilikan laptop/perangkat ajar, renovasi tempat tinggal, pendidikan lanjutan, hingga kebutuhan keluarga.',
            'keunggulan'      => "Margin syariah istimewa bagi para pahlawan tanpa tanda jasa\nPembayaran angsuran terkoordinasi dengan bendahara sekolah/yayasan\nJangka waktu fleksibel hingga 5 tahun (60 bulan)\nBebas penalti dan biaya pelunasan dipercepat",
            'syarat'          => "Fotokopi e-KTP & Kartu Keluarga\nSK Pengangkatan Guru / Surat Rekomendasi Kepala Sekolah/Yayasan\nSlip gaji atau mutasi rekening koran 3 bulan terakhir\nKartu Tanda Anggota (KTA) Guru / NUPTK (jika ada)",
            'wa_text'         => 'Halo BPRS Wakalumi, saya guru/tenaga pendidik yang berminat dengan program Pembiayaan 1000 Guru. Mohon informasi syarat dan simulasi angsurannya.',
            'icon'            => 'education',
            'urutan'          => 2,
        ],
        [
            'nama'            => 'Pembiayaan Al-Murabahah (Jual Beli)',
            'slug'            => 'murabahah',
            'tagline'         => 'Kepemilikan Barang & Pengadaan Aset Usaha',
            'badge'           => 'Perorangan & Badan Usaha',
            'color'           => 'teal',
            'akad'            => 'Al-Murabahah',
            'limit_primary'   => 'Plafon Rp 10 Jt s.d. Rp 1 Miliar',
            'limit_secondary' => 'Tenor 12 s.d. 60 Bulan',
            'desc'            => 'Pembiayaan dengan prinsip jual beli barang pada harga asal dengan tambahan keuntungan (margin) yang disepakati, dengan pihak bank selaku penjual dan nasabah selaku pembeli. Besaran angsuran bersifat tetap (flat) selama masa pembiayaan.',
            'keunggulan'      => "Kepastian jumlah angsuran tetap setiap bulan dari awal hingga lunas\nObjek barang langsung menjadi milik nasabah secara sah sejak akad\nDapat digunakan untuk mesin produksi, material bahan baku, kendaraan operasional, dll\nBebas dari fluktuasi suku bunga konvensional (anti-riba)",
            'syarat'          => "Fotokopi e-KTP, KK, & NPWP Pribadi/Badan Usaha\nSurat penawaran harga / invoice barang yang akan dibeli\nDokumen legalitas usaha (NIB/SIUP, TDP)\nDokumen jaminan/agunan (SHM/SHGB/BPKB)",
            'wa_text'         => 'Halo BPRS Wakalumi, saya ingin berkonsultasi mengenai Pembiayaan Murabahah untuk pengadaan aset/barang. Mohon rincian persyaratan dan prosesnya.',
            'icon'            => 'cart',
            'urutan'          => 3,
        ],
        [
            'nama'            => 'Pembiayaan Al-Mudharabah (Bagi Hasil Usaha)',
            'slug'            => 'mudharabah',
            'tagline'         => 'Kemitraan Modal Kerja 100% dari Bank',
            'badge'           => 'Pengusaha & Sektor Riil',
            'color'           => 'emerald',
            'akad'            => 'Al-Mudharabah',
            'limit_primary'   => 'Plafon Rp 25 Jt s.d. Rp 1.5 Miliar',
            'limit_secondary' => 'Tenor 12 s.d. 36 Bulan',
            'desc'            => 'Pembiayaan dengan prinsip bagi hasil yang sesuai dengan kesepakatan rasio nisbah. Bank menyediakan 100% kebutuhan modal kerja dan nasabah mengelola keahlian operasional usaha. Disalurkan untuk perdagangan, industri manufaktur, pertanian, dan jasa komersial.',
            'keunggulan'      => "Sistem bagi hasil adil mengikuti realitas perolehan pendapatan usaha berjalan\nBank bertindak sebagai mitra strategis kemajuan bisnis Anda\nLaporan keuangan dikawal secara transparan dan profesional\nSangat cocok untuk proyek atau kontrak kerja yang sudah pasti (SPK/PO)",
            'syarat'          => "Company Profile / Rencana Kerja Bisnis (Feasibility Study)\nLaporan Keuangan / Rekening Koran Usaha 6 bulan terakhir\nLegalitas Usaha Lengkap (Akta, NIB, NPWP)\nSurat Perintah Kerja (SPK) / Purchase Order (PO) bila berbasis proyek",
            'wa_text'         => 'Halo BPRS Wakalumi, saya memerlukan pembiayaan modal kerja Mudharabah berbasis bagi hasil untuk proyek/usaha saya. Mohon informasi konsultasi.',
            'icon'            => 'chart',
            'urutan'          => 4,
        ],
        [
            'nama'            => 'Pembiayaan Al-Musyarakah (Penyertaan Modal)',
            'slug'            => 'musyarakah',
            'tagline'         => 'Ekspansi Bisnis dengan Penggabungan Modal Bersama',
            'badge'           => 'Kemitraan Usaha & Korporasi',
            'color'           => 'blue',
            'akad'            => 'Al-Musyarakah',
            'limit_primary'   => 'Plafon Rp 50 Jt s.d. Rp 2 Miliar',
            'limit_secondary' => 'Tenor 12 s.d. 60 Bulan',
            'desc'            => 'Pembiayaan dengan prinsip bagi hasil di mana bank dan nasabah sama-sama menyertakan porsi modal usaha. Porsi keuntungan disesuaikan dengan kesepakatan rasio bersama. Solusi tepat bagi Anda yang telah memiliki usaha aktif dan bermaksud mengembangkan kapasitas skala usahanya.',
            'keunggulan'      => "Rasio keuntungan disepakati adil di awal sesuai porsi dan kontribusi kemitraan\nMendorong akselerasi pertumbuhan skala bisnis menengah dan korporasi lokal\nFleksibilitas pembayaran dividen/bagi hasil sesuai siklus penerimaan omzet\nPengawasan terpadu berstandar tata kelola syariah yang sehat",
            'syarat'          => "Laporan neraca laba rugi usaha minimal 1 tahun terakhir\nDokumen legalitas usaha berbadan hukum (PT/CV/Koperasi)\nBukti penyertaan modal sendiri (equity sharing)\nDokumen jaminan kebendaan sebagai mitigasi risiko kepatuhan",
            'wa_text'         => 'Halo BPRS Wakalumi, saya ingin mendiskusikan pembiayaan modal kerja Musyarakah untuk pengembangan skala bisnis perusahaan kami.',
            'icon'            => 'handshake',
            'urutan'          => 5,
        ],
        [
            'nama'            => 'Pembiayaan Ijarah & IMBT (Sewa & Sewa Beli Aset)',
            'slug'            => 'ijarah',
            'tagline'         => 'Sewa Tempat Usaha & Pemindahan Hak Milik Aset',
            'badge'           => 'Usaha Komersial & Jasa',
            'color'           => 'cyan',
            'akad'            => 'Ijarah & Ijarah Muntahiya Bittamlik',
            'limit_primary'   => 'Plafon Rp 20 Jt s.d. Rp 750 Juta',
            'limit_secondary' => 'Tenor 12 s.d. 48 Bulan',
            'desc'            => 'Pembiayaan dengan prinsip sewa murni atau sewa beli (IMBT). Sangat sesuai untuk Anda yang menginginkan sewa tempat usaha, ruko, kios, atau penambahan aset modal yang pada akhirnya dialihkan kepemilikannya kepada Anda di akhir masa periode sewa.',
            'keunggulan'      => "Kemudahan mendapatkan manfaat penggunaan aset produktif tanpa harus bayar tunai di muka\nPilihan opsi pemindahan kepemilikan aset (hibah atau jual) di akhir masa sewa\nUjrah (biaya sewa) jelas dan disepakati di muka tanpa kejutan bunga\nMenjaga arus kas likuiditas usaha tetap sehat dan leluasa",
            'syarat'          => "Draft Surat Perjanjian Sewa / Brosur Ruko / Spesifikasi Aset yang disewa\nFotokopi identitas pemohon dan legalitas usaha\nRekening koran operasional 3 bulan terakhir\nJaminan pelengkap sesuai ketentuan bank",
            'wa_text'         => 'Halo BPRS Wakalumi, saya ingin mengajukan pembiayaan sewa tempat usaha / Ijarah IMBT. Mohon informasi persyaratan dan ketentuannya.',
            'icon'            => 'building',
            'urutan'          => 6,
        ],
        [
            'nama'            => 'Pembiayaan Multijasa (Ujrah Jasa / Umroh / Pendidikan)',
            'slug'            => 'multijasa',
            'tagline'         => 'Paket Ibadah Umroh, Pendidikan Lanjutan & Biaya Jasa',
            'badge'           => 'Keluarga & Perorangan',
            'color'           => 'purple',
            'akad'            => 'Ijarah Multijasa / Kafalah',
            'limit_primary'   => 'Plafon Rp 10 Jt s.d. Rp 150 Juta',
            'limit_secondary' => 'Tenor 6 s.d. 36 Bulan',
            'desc'            => 'Pembiayaan dengan menggunakan akad Ijarah atau Kafalah di mana bank memperoleh imbalan jasa (ujrah) atas penyediaan fasilitas jasa bagi nasabah. Besarnya ujrah disepakati di awal dalam bentuk nominal pasti untuk paket ibadah umroh, biaya pendidikan tinggi, renovasi, atau layanan kesehatan.',
            'keunggulan'      => "Nominal imbalan jasa (ujrah) pasti dan tetap tanpa perubahan di tengah jalan\nMembantu mewujudkan niat ibadah suci ke tanah suci tanpa kendala tunai\nProses persetujuan cepat dengan syarat bersahabat\nPilihan tenor fleksibel sesuai kemampuan angsuran bulanan keluarga",
            'syarat'          => "Fotokopi e-KTP suami & istri, Kartu Keluarga, dan Surat Nikah\nSlip penghasilan / bukti pendapatan bulanan\nKwitansi / Invoice resmi dari biro travel umroh atau institusi penyedia jasa\nDokumen jaminan yang memadai",
            'wa_text'         => 'Halo BPRS Wakalumi, saya ingin berkonsultasi mengenai Pembiayaan Multijasa (Umroh/Pendidikan). Mohon rincian paket simulasi dan persyaratannya.',
            'icon'            => 'plane',
            'urutan'          => 7,
        ],
        [
            'nama'            => 'Pembiayaan Qardhul Hasan (Kebijakan Sosial Dhuafa)',
            'slug'            => 'qardh',
            'tagline'         => 'Pinjaman Kebajikan Murni Tanpa Tambahan Bagi Dhuafa',
            'badge'           => 'Sosial & Kaum Dhuafa',
            'color'           => 'emerald',
            'akad'            => 'Al-Qardhul Hasan',
            'limit_primary'   => 'Plafon Ringan s.d. Rp 10 Juta',
            'limit_secondary' => 'Tenor Fleksibel Musyawarah',
            'desc'            => 'Pembiayaan kebijakan dengan prinsip pinjam meminjam murni tanpa ada tambahan (bunga/margin nol persen). Diperuntukkan bagi kaum dhuafa atau pengusaha ultra mikro yang berikhtiar mengembangkan usaha kecilnya demi kemandirian ekonomi keluarga.',
            'keunggulan'      => "Bebas dari tambahan margin maupun bunga (0% murni tanpa riba)\nPengembalian pokok pinjaman sesuai kesepakatan kemampuan nasabah\nWujud kepedulian sosial perbankan syariah terhadap pengentasan kemiskinan\nPendampingan berkala agar usaha terus tumbuh dan naik kelas",
            'syarat'          => "Surat Keterangan Tidak Mampu (SKTM) atau rekomendasi dari tokoh masyarakat / lembaga zakat\ne-KTP dan Kartu Keluarga\nRencana usaha sederhana yang sedang/akan dijalankan\nKomitmen amanah untuk mengangsur pengembalian pinjaman pokok",
            'wa_text'         => 'Halo BPRS Wakalumi, saya ingin menanyakan informasi mengenai program sosial Pembiayaan Qardhul Hasan. Mohon petunjuk prosedurnya.',
            'icon'            => 'heart',
            'urutan'          => 8,
        ],
    ];
}

/**
 * Helper: Ambil Daftar Shortcut Preset Simulasi Kalkulator Pembiayaan
 */
function wakalumi_get_pembiayaan_calc_presets() {
    $saved = get_option( 'options_pembiayaan_calc_presets', null );
    if ( is_array( $saved ) && ! empty( $saved ) ) {
        return $saved;
    }

    return [
        [
            'label'   => 'Rp 10 Juta (Modal Mikro)',
            'nominal' => '10000000',
            'tenor'   => '12',
            'prod'    => 'Pembiayaan 1000 Pedagang',
        ],
        [
            'label'   => 'Rp 25 Jt (UMKM Pedagang)',
            'nominal' => '25000000',
            'tenor'   => '24',
            'prod'    => 'Pembiayaan 1000 Pedagang',
        ],
        [
            'label'   => 'Rp 35 Jt (Paket Umroh)',
            'nominal' => '35000000',
            'tenor'   => '24',
            'prod'    => 'Pembiayaan Multijasa (Ujrah Jasa / Umroh / Pendidikan)',
        ],
        [
            'label'   => 'Rp 50 Jt (Guru & Pengajar)',
            'nominal' => '50000000',
            'tenor'   => '36',
            'prod'    => 'Pembiayaan 1000 Guru',
        ],
        [
            'label'   => 'Rp 100 Jt (Investasi Usaha)',
            'nominal' => '100000000',
            'tenor'   => '48',
            'prod'    => 'Pembiayaan Al-Murabahah (Jual Beli)',
        ],
    ];
}

/**
 * Helper: Ambil Daftar FAQ / QnA Pembiayaan
 */
function wakalumi_get_pembiayaan_faq_list() {
    $saved = get_option( 'options_pembiayaan_faq_list', null );
    if ( is_array( $saved ) && ! empty( $saved ) ) {
        return $saved;
    }

    return [
        [
            'q' => 'Apa perbedaan mendasar pembiayaan syariah di BPRS Wakalumi dengan pinjaman bank konvensional?',
            'a' => 'Pembiayaan di BPRS Wakalumi berlandaskan akad-akad syariah yang sah dan diawasi oleh Dewan Pengawas Syariah (DPS & DSN-MUI). Kami tidak menerapkan sistem bunga pinjaman berbunga (riba). Keuntungan bank diperoleh dari margin jual beli yang pasti disepakati di awal (Murabahah), bagi hasil usaha riil (Mudharabah & Musyarakah), atau imbalan jasa sewa (Ijarah).',
        ],
        [
            'q' => 'Berapa lama proses persetujuan dan pencairan dana pembiayaan?',
            'a' => 'Untuk program pembiayaan mikro seperti Pembiayaan 1000 Pedagang dan Pembiayaan 1000 Guru, proses persetujuan berkisar antara 1 hingga 3 hari kerja setelah berkas dan survei lapangan dinyatakan lengkap. Untuk pembiayaan komersial dan korporasi, proses menyesuaikan dengan analisis kelayakan usaha (feasibility study).',
        ],
        [
            'q' => 'Apakah pembiayaan di BPRS Wakalumi wajib menyertakan agunan / jaminan?',
            'a' => 'Secara umum, sebagai lembaga perbankan yang diawasi OJK, agunan diperlukan sebagai mitigasi risiko kepatuhan perbankan (seperti SHM, BPKB kendaraan, atau penjaminan payroll bagi guru). Namun untuk plafon usaha mikro tertentu atau program sosial Qardhul Hasan, skema jaminan dapat disesuaikan berdasarkan hasil musyawarah dan rekomendasi pengelola kelompok/pasar.',
        ],
        [
            'q' => 'Apakah ada denda keterlambatan jika nasabah terlambat mengangsur?',
            'a' => 'BPRS Wakalumi tidak memberlakukan denda keterlambatan yang dijadikan sebagai pendapatan bank (karena tergolong riba). Apabila ada biaya ta\'zir atas keterlambatan, dana tersebut wajib dialokasikan 100% untuk kas kebajikan sosial (dana kebajikan/infaq sosial dhuafa) dan bukan menjadi keuntungan bank.',
        ],
        [
            'q' => 'Apakah nasabah dapat melunasi pembiayaan sebelum masa tenor berakhir (pelunasan dipercepat)?',
            'a' => 'Bisa. Nasabah berhak melakukan pelunasan dipercepat kapan saja tanpa dikenakan biaya penalti riba. Bahkan, sesuai fatwa DSN-MUI dan kebijakan bank, nasabah dapat diberikan potongan margin (muqassah) sebagai bentuk apresiasi atas kelancaran pembayaran.',
        ],
    ];
}

/**
 * Helper Ikon Kartu Pembiayaan SVG (Global Helper)
 */
if ( ! function_exists( 'wakalumi_render_pembiayaan_icon' ) ) {
    function wakalumi_render_pembiayaan_icon( string $icon_key = '' ): string {
        switch ( $icon_key ) {
            case 'store':
            case 'pedagang':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009 9.35c.66 0 1.28-.213 1.785-.578a3.001 3.001 0 004.43 0c.506.365 1.125.578 1.785.578a2.993 2.993 0 002.465-1.281 3.001 3.001 0 003.75.615M2.25 9.35l1.64-5.33A1.5 1.5 0 015.32 3h13.36a1.5 1.5 0 011.43 1.02l1.64 5.33"/></svg>';
            case 'education':
            case 'guru':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>';
            case 'cart':
            case 'murabahah':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/></svg>';
            case 'chart':
            case 'mudharabah':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>';
            case 'handshake':
            case 'musyarakah':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>';
            case 'building':
            case 'ijarah':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>';
            case 'plane':
            case 'multijasa':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>';
            case 'heart':
            case 'qardh':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>';
            case 'shield':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>';
            case 'briefcase':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/></svg>';
            case 'truck':
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25V3.75A1.125 1.125 0 0013.125 2.625H3.375A1.125 1.125 0 002.25 3.75v10.5M14.25 7.5H18M9.75 14.25h4.5"/></svg>';
            case 'coins':
            default:
                return '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
        }
    }
}

/**
 * Helper Skema Tema Warna Pembiayaan (Global Helper)
 */
if ( ! function_exists( 'wakalumi_get_pembiayaan_color_theme' ) ) {
    function wakalumi_get_pembiayaan_color_theme( string $color = 'emerald' ): array {
        $themes = [
            'orange'  => [
                'border'      => 'border-slate-200/90 dark:border-slate-800/80',
                'hover'       => 'hover:border-orange-500 dark:hover:border-orange-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-orange-500/25',
                'badge_bg'    => 'bg-orange-100 dark:bg-orange-950 text-orange-800 dark:text-orange-300 border-orange-200 dark:border-orange-800',
                'icon_bg'     => 'bg-orange-50 dark:bg-orange-900/50 text-orange-600 dark:text-orange-300',
                'accent_dot'  => 'bg-orange-500',
                'pill_hover'  => 'hover:border-orange-500 hover:text-orange-600 dark:hover:text-orange-400',
                'title_hover' => 'group-hover:text-orange-600 dark:group-hover:text-orange-400',
            ],
            'indigo'  => [
                'border'      => 'border-slate-200/90 dark:border-slate-800/80',
                'hover'       => 'hover:border-indigo-500 dark:hover:border-indigo-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-indigo-500/25',
                'badge_bg'    => 'bg-indigo-100 dark:bg-indigo-950 text-indigo-800 dark:text-indigo-300 border-indigo-200 dark:border-indigo-800',
                'icon_bg'     => 'bg-indigo-50 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-300',
                'accent_dot'  => 'bg-indigo-500',
                'pill_hover'  => 'hover:border-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400',
                'title_hover' => 'group-hover:text-indigo-600 dark:group-hover:text-indigo-400',
            ],
            'teal'    => [
                'border'      => 'border-slate-200/90 dark:border-slate-800/80',
                'hover'       => 'hover:border-teal-500 dark:hover:border-teal-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-teal-500/25',
                'badge_bg'    => 'bg-teal-100 dark:bg-teal-950 text-teal-800 dark:text-teal-300 border-teal-200 dark:border-teal-800',
                'icon_bg'     => 'bg-teal-50 dark:bg-teal-900/50 text-teal-600 dark:text-teal-300',
                'accent_dot'  => 'bg-teal-500',
                'pill_hover'  => 'hover:border-teal-500 hover:text-teal-600 dark:hover:text-teal-400',
                'title_hover' => 'group-hover:text-teal-600 dark:group-hover:text-teal-400',
            ],
            'emerald' => [
                'border'      => 'border-slate-200/90 dark:border-slate-800/80',
                'hover'       => 'hover:border-emerald-500 dark:hover:border-emerald-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-emerald-500/25',
                'badge_bg'    => 'bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800',
                'icon_bg'     => 'bg-emerald-50 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-300',
                'accent_dot'  => 'bg-emerald-500',
                'pill_hover'  => 'hover:border-emerald-500 hover:text-emerald-600 dark:hover:text-emerald-400',
                'title_hover' => 'group-hover:text-emerald-600 dark:group-hover:text-emerald-400',
            ],
            'blue'    => [
                'border'      => 'border-slate-200/90 dark:border-slate-800/80',
                'hover'       => 'hover:border-blue-500 dark:hover:border-blue-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-blue-500/25',
                'badge_bg'    => 'bg-blue-100 dark:bg-blue-950 text-blue-800 dark:text-blue-300 border-blue-200 dark:border-blue-800',
                'icon_bg'     => 'bg-blue-50 dark:bg-blue-900/50 text-blue-600 dark:text-blue-300',
                'accent_dot'  => 'bg-blue-500',
                'pill_hover'  => 'hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400',
                'title_hover' => 'group-hover:text-blue-600 dark:group-hover:text-blue-400',
            ],
            'purple'  => [
                'border'      => 'border-slate-200/90 dark:border-slate-800/80',
                'hover'       => 'hover:border-purple-500 dark:hover:border-purple-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-purple-500/25',
                'badge_bg'    => 'bg-purple-100 dark:bg-purple-950 text-purple-800 dark:text-purple-300 border-purple-200 dark:border-purple-800',
                'icon_bg'     => 'bg-purple-50 dark:bg-purple-900/50 text-purple-600 dark:text-purple-300',
                'accent_dot'  => 'bg-purple-500',
                'pill_hover'  => 'hover:border-purple-500 hover:text-purple-600 dark:hover:text-purple-400',
                'title_hover' => 'group-hover:text-purple-600 dark:group-hover:text-purple-400',
            ],
            'sky'     => [
                'border'      => 'border-slate-200/90 dark:border-slate-800/80',
                'hover'       => 'hover:border-sky-500 dark:hover:border-sky-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-sky-500/25',
                'badge_bg'    => 'bg-sky-100 dark:bg-sky-950 text-sky-800 dark:text-sky-300 border-sky-200 dark:border-sky-800',
                'icon_bg'     => 'bg-sky-50 dark:bg-sky-900/50 text-sky-600 dark:text-sky-300',
                'accent_dot'  => 'bg-sky-500',
                'pill_hover'  => 'hover:border-sky-500 hover:text-sky-600 dark:hover:text-sky-400',
                'title_hover' => 'group-hover:text-sky-600 dark:group-hover:text-sky-400',
            ],
            'amber'   => [
                'border'      => 'border-slate-200/90 dark:border-slate-800/80',
                'hover'       => 'hover:border-amber-500 dark:hover:border-amber-400/80 hover:shadow-xl dark:hover:shadow-2xl dark:hover:shadow-amber-500/25',
                'badge_bg'    => 'bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 border-amber-200 dark:border-amber-800',
                'icon_bg'     => 'bg-amber-50 dark:bg-amber-900/50 text-amber-600 dark:text-amber-300',
                'accent_dot'  => 'bg-amber-500',
                'pill_hover'  => 'hover:border-amber-500 hover:text-amber-600 dark:hover:text-amber-400',
                'title_hover' => 'group-hover:text-amber-600 dark:group-hover:text-amber-400',
            ],
        ];

        return $themes[ $color ] ?? $themes['emerald'];
    }
}

/**
 * Render Halaman Admin Pengelolaan Pembiayaan Syariah
 */
function wakalumi_render_pembiayaan_admin_page() {
    // Siapkan WP Media Uploader untuk grafis produk
    wp_enqueue_media();

    // ── PROSES SIMPAN DATA ──────────────────────────────────────────
    if ( isset( $_POST['wakalumi_save_pembiayaan'] ) && check_admin_referer( 'wakalumi_pembiayaan_nonce' ) ) {
        
        // 1. Header Banner & Trust Box
        update_option( 'options_pembiayaan_page_badge', sanitize_text_field( $_POST['options_pembiayaan_page_badge'] ?? '' ) );
        update_option( 'options_pembiayaan_page_title', sanitize_text_field( $_POST['options_pembiayaan_page_title'] ?? '' ) );
        update_option( 'options_pembiayaan_page_subtitle', sanitize_textarea_field( $_POST['options_pembiayaan_page_subtitle'] ?? '' ) );
        update_option( 'options_pembiayaan_quote', sanitize_textarea_field( $_POST['options_pembiayaan_quote'] ?? '' ) );

        update_option( 'options_pembiayaan_trust_tag', sanitize_text_field( $_POST['options_pembiayaan_trust_tag'] ?? '' ) );
        update_option( 'options_pembiayaan_trust_title', sanitize_text_field( $_POST['options_pembiayaan_trust_title'] ?? '' ) );
        update_option( 'options_pembiayaan_trust_desc', sanitize_textarea_field( $_POST['options_pembiayaan_trust_desc'] ?? '' ) );
        update_option( 'options_pembiayaan_trust_btn', sanitize_text_field( $_POST['options_pembiayaan_trust_btn'] ?? '' ) );

        // 2. Repeater Produk Pembiayaan
        $pem_names     = $_POST['pem_nama'] ?? [];
        $pem_slugs     = $_POST['pem_slug'] ?? [];
        $pem_taglines  = $_POST['pem_tagline'] ?? [];
        $pem_badges    = $_POST['pem_badge'] ?? [];
        $pem_colors    = $_POST['pem_color'] ?? [];
        $pem_akads     = $_POST['pem_akad'] ?? [];
        $pem_limits_p  = $_POST['pem_limit_primary'] ?? [];
        $pem_limits_s  = $_POST['pem_limit_secondary'] ?? [];
        $pem_descs     = $_POST['pem_desc'] ?? [];
        $pem_keungs    = $_POST['pem_keunggulan'] ?? [];
        $pem_syarats   = $_POST['pem_syarat'] ?? [];
        $pem_was       = $_POST['pem_wa_text'] ?? [];
        $pem_icons     = $_POST['pem_icon'] ?? [];
        $pem_svgs      = $_POST['pem_custom_svg'] ?? [];
        $pem_images    = $_POST['pem_image'] ?? [];
        $pem_urutans   = $_POST['pem_urutan'] ?? [];

        $clean_pem_list = [];
        for ( $i = 0; $i < count( $pem_names ); $i++ ) {
            $nama = sanitize_text_field( $pem_names[$i] ?? '' );
            if ( empty( $nama ) ) continue;

            $custom_svg_raw = isset( $pem_svgs[$i] ) ? trim( $pem_svgs[$i] ) : '';

            $clean_pem_list[] = [
                'nama'            => $nama,
                'slug'            => sanitize_title( $pem_slugs[$i] ?? $nama ),
                'tagline'         => sanitize_text_field( $pem_taglines[$i] ?? '' ),
                'badge'           => sanitize_text_field( $pem_badges[$i] ?? '' ),
                'color'           => sanitize_text_field( $pem_colors[$i] ?? 'teal' ),
                'akad'            => sanitize_text_field( $pem_akads[$i] ?? '' ),
                'limit_primary'   => sanitize_text_field( $pem_limits_p[$i] ?? '' ),
                'limit_secondary' => sanitize_text_field( $pem_limits_s[$i] ?? '' ),
                'desc'            => sanitize_textarea_field( $pem_descs[$i] ?? '' ),
                'keunggulan'      => sanitize_textarea_field( $pem_keungs[$i] ?? '' ),
                'syarat'          => sanitize_textarea_field( $pem_syarats[$i] ?? '' ),
                'wa_text'         => sanitize_textarea_field( $pem_was[$i] ?? '' ),
                'icon'            => sanitize_text_field( $pem_icons[$i] ?? 'store' ),
                'image'           => esc_url_raw( $pem_images[$i] ?? '' ),
                'custom_svg'      => ! empty( $custom_svg_raw ) ? wp_kses( $custom_svg_raw, [
                    'svg'  => [ 'class' => true, 'fill' => true, 'viewbox' => true, 'stroke' => true, 'stroke-width' => true, 'xmlns' => true ],
                    'path' => [ 'stroke-linecap' => true, 'stroke-linejoin' => true, 'd' => true, 'fill' => true ],
                ] ) : '',
                'urutan'          => intval( $pem_urutans[$i] ?? ($i + 1) ),
            ];
        }

        // Sort by urutan ascending
        usort( $clean_pem_list, function( $a, $b ) {
            return ( $a['urutan'] ?? 0 ) - ( $b['urutan'] ?? 0 );
        } );

        update_option( 'options_pembiayaan_list', $clean_pem_list );

        // 3. Kalkulator Simulasi Pembiayaan
        update_option( 'options_pembiayaan_calc_badge', sanitize_text_field( $_POST['options_pembiayaan_calc_badge'] ?? '' ) );
        update_option( 'options_pembiayaan_calc_title', sanitize_text_field( $_POST['options_pembiayaan_calc_title'] ?? '' ) );
        update_option( 'options_pembiayaan_calc_sub', sanitize_textarea_field( $_POST['options_pembiayaan_calc_sub'] ?? '' ) );
        update_option( 'options_pembiayaan_calc_min', sanitize_text_field( $_POST['options_pembiayaan_calc_min'] ?? '5000000' ) );
        update_option( 'options_pembiayaan_calc_max', sanitize_text_field( $_POST['options_pembiayaan_calc_max'] ?? '500000000' ) );
        update_option( 'options_pembiayaan_calc_default', sanitize_text_field( $_POST['options_pembiayaan_calc_default'] ?? '25000000' ) );
        update_option( 'options_pembiayaan_calc_rate', sanitize_text_field( $_POST['options_pembiayaan_calc_rate'] ?? '11.5' ) );
        update_option( 'options_pembiayaan_calc_note', sanitize_textarea_field( $_POST['options_pembiayaan_calc_note'] ?? '' ) );
        update_option( 'options_pembiayaan_calc_btn_text', sanitize_text_field( $_POST['options_pembiayaan_calc_btn_text'] ?? '' ) );

        // 3b. Repeater Preset Shortcut Kalkulator
        $preset_labels   = $_POST['calc_preset_label'] ?? [];
        $preset_nominals = $_POST['calc_preset_nominal'] ?? [];
        $preset_tenors   = $_POST['calc_preset_tenor'] ?? [];
        $preset_prods    = $_POST['calc_preset_prod'] ?? [];

        $clean_presets = [];
        for ( $p = 0; $p < count( $preset_labels ); $p++ ) {
            $p_label = sanitize_text_field( $preset_labels[$p] ?? '' );
            if ( ! empty( $p_label ) ) {
                $clean_presets[] = [
                    'label'   => $p_label,
                    'nominal' => preg_replace( '/[^0-9]/', '', $preset_nominals[$p] ?? '' ),
                    'tenor'   => preg_replace( '/[^0-9]/', '', $preset_tenors[$p] ?? '' ),
                    'prod'    => sanitize_text_field( $preset_prods[$p] ?? '' ),
                ];
            }
        }
        update_option( 'options_pembiayaan_calc_presets', $clean_presets );

        // 4. FAQ Pembiayaan
        update_option( 'options_pembiayaan_faq_badge', sanitize_text_field( $_POST['options_pembiayaan_faq_badge'] ?? '' ) );
        update_option( 'options_pembiayaan_faq_title', sanitize_text_field( $_POST['options_pembiayaan_faq_title'] ?? '' ) );
        update_option( 'options_pembiayaan_faq_sub', sanitize_textarea_field( $_POST['options_pembiayaan_faq_sub'] ?? '' ) );

        $faq_qs = $_POST['pem_faq_q'] ?? [];
        $faq_as = $_POST['pem_faq_a'] ?? [];
        $clean_faqs = [];
        for ( $f = 0; $f < count( $faq_qs ); $f++ ) {
            $q = sanitize_text_field( $faq_qs[$f] ?? '' );
            $a = sanitize_textarea_field( $faq_as[$f] ?? '' );
            if ( ! empty( $q ) || ! empty( $a ) ) {
                $clean_faqs[] = [ 'q' => $q, 'a' => $a ];
            }
        }
        update_option( 'options_pembiayaan_faq_list', $clean_faqs );

        // 5. Alur & Prosedur 4 Langkah
        update_option( 'options_pembiayaan_alur_kicker', sanitize_text_field( $_POST['options_pembiayaan_alur_kicker'] ?? '' ) );
        update_option( 'options_pembiayaan_alur_title', sanitize_text_field( $_POST['options_pembiayaan_alur_title'] ?? '' ) );
        update_option( 'options_pembiayaan_alur_sub', sanitize_textarea_field( $_POST['options_pembiayaan_alur_sub'] ?? '' ) );
        for ( $s = 1; $s <= 4; $s++ ) {
            update_option( "options_pembiayaan_step_{$s}_title", sanitize_text_field( $_POST["options_pembiayaan_step_{$s}_title"] ?? '' ) );
            update_option( "options_pembiayaan_step_{$s}_desc", sanitize_textarea_field( $_POST["options_pembiayaan_step_{$s}_desc"] ?? '' ) );
        }

        // 6. Box Konsultasi Relationship Manager (Sidebar FAQ)
        update_option( 'options_pembiayaan_rm_show', isset( $_POST['options_pembiayaan_rm_show'] ) ? '1' : '0' );
        update_option( 'options_pembiayaan_rm_title', sanitize_text_field( $_POST['options_pembiayaan_rm_title'] ?? '' ) );
        update_option( 'options_pembiayaan_rm_desc', sanitize_textarea_field( $_POST['options_pembiayaan_rm_desc'] ?? '' ) );
        update_option( 'options_pembiayaan_rm_btn_text', sanitize_text_field( $_POST['options_pembiayaan_rm_btn_text'] ?? '' ) );
        update_option( 'options_pembiayaan_rm_wa_msg', sanitize_textarea_field( $_POST['options_pembiayaan_rm_wa_msg'] ?? '' ) );
        update_option( 'options_pembiayaan_rm_wa_num', sanitize_text_field( $_POST['options_pembiayaan_rm_wa_num'] ?? '' ) );

        // 7. Banner CTA Konsultasi Pembiayaan
        update_option( 'options_pembiayaan_cta_kicker', sanitize_text_field( $_POST['options_pembiayaan_cta_kicker'] ?? '' ) );
        update_option( 'options_pembiayaan_cta_title', sanitize_text_field( $_POST['options_pembiayaan_cta_title'] ?? '' ) );
        update_option( 'options_pembiayaan_cta_desc', sanitize_textarea_field( $_POST['options_pembiayaan_cta_desc'] ?? '' ) );
        update_option( 'options_pembiayaan_cta_btn_text', sanitize_text_field( $_POST['options_pembiayaan_cta_btn_text'] ?? '' ) );
        update_option( 'options_pembiayaan_cta_wa_msg', sanitize_textarea_field( $_POST['options_pembiayaan_cta_wa_msg'] ?? '' ) );

        echo '<div class="notice notice-success is-dismissible" style="margin-top: 15px;"><p><strong>Berhasil!</strong> Pengaturan Halaman Pembiayaan Syariah telah berhasil disimpan.</p></div>';
    }

    $page_badge     = get_option( 'options_pembiayaan_page_badge', 'Penyaluran Dana Wakalumi' );
    if ( empty( $page_badge ) || $page_badge === 'Penyaluran Dana Berkah' ) {
        $page_badge = 'Penyaluran Dana Wakalumi';
    }
    $page_title     = get_option( 'options_pembiayaan_page_title', 'Solusi Pembiayaan Syariah BPRS Wakalumi' );
    $page_sub       = get_option( 'options_pembiayaan_page_subtitle', 'Mendukung pertumbuhan usaha mikro, UMKM, profesi tenaga pendidik, hingga pemenuhan kebutuhan keluarga dengan prinsip syariah yang adil, amanah, dan tanpa riba.' );
    $page_quote     = get_option( 'options_pembiayaan_quote', 'Allah telah menghalalkan jual beli dan mengharamkan riba. (QS. Al-Baqarah: 275) — Berbisnis dan bermuamalah dengan penuh ketenangan, keadilan, dan keberkahan bagi seluruh pihak.' );

    $trust_tag      = get_option( 'options_pembiayaan_trust_tag', 'Kepatuhan Regulasi & Syariah' );
    $trust_title    = get_option( 'options_pembiayaan_trust_title', 'Izin Resmi OJK & Dewan Pengawas Syariah' );
    $trust_desc     = get_option( 'options_pembiayaan_trust_desc', 'Seluruh produk penyaluran dana BPRS Wakalumi beroperasi di bawah pengawasan Otoritas Jasa Keuangan (OJK) serta dipandu oleh Dewan Pengawas Syariah (DPS) yang tersertifikasi DSN-MUI.' );
    $trust_btn      = get_option( 'options_pembiayaan_trust_btn', 'Simulasi Angsuran Syariah' );

    $pembiayaan_list = wakalumi_get_pembiayaan_list();

    // Kalkulator
    $calc_badge     = get_option( 'options_pembiayaan_calc_badge', 'Simulasi Finansial Syariah' );
    $calc_title     = get_option( 'options_pembiayaan_calc_title', 'Kalkulator Simulasi Angsuran Pembiayaan' );
    $calc_sub       = get_option( 'options_pembiayaan_calc_sub', 'Hitung estimasi angsuran bulanan yang adil dan transparan tanpa ada biaya tersembunyi. Tentukan plafon dan tenor sesuai kenyamanan arus kas Anda.' );
    $calc_min       = get_option( 'options_pembiayaan_calc_min', '5000000' );
    $calc_max       = get_option( 'options_pembiayaan_calc_max', '500000000' );
    $calc_default   = get_option( 'options_pembiayaan_calc_default', '25000000' );
    $calc_rate      = get_option( 'options_pembiayaan_calc_rate', '11.5' );
    $calc_note      = get_option( 'options_pembiayaan_calc_note', '*Estimasi indikatif dengan formula perhitungan margin setara flat per tahun. Perhitungan riil disepakati saat akad resmi.' );
    $calc_btn_text  = get_option( 'options_pembiayaan_calc_btn_text', 'Ajukan Pembiayaan via WhatsApp' );
    $calc_presets   = wakalumi_get_pembiayaan_calc_presets();

    // FAQ
    $faq_badge      = get_option( 'options_pembiayaan_faq_badge', 'Tanya Jawab (FAQ)' );
    $faq_title      = get_option( 'options_pembiayaan_faq_title', 'Pertanyaan Seputar Pembiayaan Syariah' );
    $faq_sub        = get_option( 'options_pembiayaan_faq_sub', 'Pertanyaan umum nasabah seputar jaminan, waktu pencairan, sistem pelunasan, dan bebas denda riba.' );
    $faq_list       = wakalumi_get_pembiayaan_faq_list();

    // RM Box
    $rm_show        = get_option( 'options_pembiayaan_rm_show', '1' );
    $rm_title       = get_option( 'options_pembiayaan_rm_title', 'Konsultasi Relationship Manager' );
    $rm_desc        = get_option( 'options_pembiayaan_rm_desc', 'Butuh penjelasan tatap muka atau survei ke tempat usaha Anda? Relationship manager kami siap mendampingi konsultasi pembiayaan secara langsung.' );
    $rm_btn_text    = get_option( 'options_pembiayaan_rm_btn_text', 'Hubungi Relationship Manager' );
    $rm_wa_msg      = get_option( 'options_pembiayaan_rm_wa_msg', 'Halo Relationship Manager BPRS Wakalumi, saya membutuhkan konsultasi mengenai pengajuan pembiayaan usaha.' );
    $rm_wa_num      = get_option( 'options_pembiayaan_rm_wa_num', '' );

    // Alur 4 Langkah
    $alur_kicker    = get_option( 'options_pembiayaan_alur_kicker', 'Proses Mudah & Cepat' );
    $alur_title     = get_option( 'options_pembiayaan_alur_title', '4 Tahapan Mudah Pengajuan Pembiayaan' );
    $alur_sub       = get_option( 'options_pembiayaan_alur_sub', 'Panduan tahapan transparan mulai dari konsultasi awal hingga dana pembiayaan cair ke rekening Anda.' );
    $step_1_title   = get_option( 'options_pembiayaan_step_1_title', '1. Konsultasi & Pengisian Formulir' );
    $step_1_desc    = get_option( 'options_pembiayaan_step_1_desc', 'Hubungi tim relationship manager kami via WhatsApp atau kunjungi kantor BPRS Wakalumi untuk konsultasi kebutuhan dana dan pengisian formulir pengajuan.' );
    $step_2_title   = get_option( 'options_pembiayaan_step_2_title', '2. Kelengkapan Berkas & Verifikasi' );
    $step_2_desc    = get_option( 'options_pembiayaan_step_2_desc', 'Serahkan dokumen persyaratan (identitas, legalitas usaha/surat guru, dan jaminan). Tim kami akan melakukan verifikasi dan survei usaha secara bersahabat.' );
    $step_3_title   = get_option( 'options_pembiayaan_step_3_title', '3. Persetujuan & Ijab Qabul Akad' );
    $step_3_desc    = get_option( 'options_pembiayaan_step_3_desc', 'Setelah pengajuan disetujui, penandatanganan akad syariah (ijab-qabul) dilakukan secara transparan tanpa ada pasal jebakan atau biaya tersembunyi.' );
    $step_4_title   = get_option( 'options_pembiayaan_step_4_title', '4. Pencairan Dana Cepat & Pendampingan' );
    $step_4_desc    = get_option( 'options_pembiayaan_step_4_desc', 'Dana pembiayaan langsung dicairkan ke rekening Anda untuk mendukung kemajuan usaha atau pemenuhan kebutuhan dengan pendampingan berkala.' );

    // CTA
    $cta_kicker     = get_option( 'options_pembiayaan_cta_kicker', 'Konsultasi Pembiayaan Bebas Riba' );
    $cta_title      = get_option( 'options_pembiayaan_cta_title', 'Siap Mengembangkan Usaha & Memenuhi Kebutuhan dengan Berkah?' );
    $cta_desc       = get_option( 'options_pembiayaan_cta_desc', 'Diskusikan rencana usaha atau kebutuhan pembiayaan Anda bersama staf pembiayaan profesional BPRS Wakalumi. Kami siap melayani dengan akad syariah yang adil dan amanah.' );
    $cta_btn_text   = get_option( 'options_pembiayaan_cta_btn_text', 'Konsultasi via WhatsApp Sekarang' );
    $cta_wa_msg     = get_option( 'options_pembiayaan_cta_wa_msg', 'Halo BPRS Wakalumi, saya ingin berkonsultasi mengenai pengajuan pembiayaan syariah. Mohon informasi syarat dan simulasi angsurannya.' );

    $color_options = [
        'orange'  => 'Orange (Pedagang / Dinamis)',
        'indigo'  => 'Indigo (Guru / Edukatif)',
        'teal'    => 'Teal (Brand Utama Wakalumi)',
        'emerald' => 'Emerald (Syariah & Hijau Alami)',
        'blue'    => 'Blue (Korporasi & Kemitraan)',
        'cyan'    => 'Cyan (Modern & Segar)',
        'purple'  => 'Purple (Multijasa & Umroh)',
        'amber'   => 'Amber (Emas & Investasi)',
        'rose'    => 'Rose (Hangat & Ramah)',
        'sky'     => 'Sky (Cerah & Terbuka)',
        'lime'    => 'Lime (Pertumbuhan & Agro)',
        'violet'  => 'Violet (Eksklusif & Mulia)',
        'fuchsia' => 'Fuchsia (Kreatif & Inovatif)',
        'slate'   => 'Slate (Elegan & Netral)',
    ];

    $icon_options = [
        'store'       => '🏪 Toko / Pedagang Pasar / UMKM',
        'education'   => '🎓 Guru / Pendidikan / Wisuda',
        'cart'        => '🛒 Keranjang Belanja / Murabahah Jual Beli',
        'chart'       => '📈 Grafik Naik / Mudharabah Bagi Hasil',
        'handshake'   => '🤝 Jabat Tangan / Musyarakah Kemitraan',
        'building'    => '🏢 Gedung / Ijarah Sewa Tempat Usaha',
        'plane'       => '✈️ Pesawat / Paket Umroh & Wisata Halal',
        'heart'       => '❤️ Hati / Qardhul Hasan Kebajikan Sosial',
        'shield'      => '🛡️ Perisai / Pengawasan Syariah',
        'coins'       => '🪙 Koin Modal & Investasi',
        'briefcase'   => '💼 Koper Bisnis / Modal Kerja Eksekutif',
        'truck'       => '🚚 Truk / Logistik & Armada Usaha',
        'hospital'    => '🏥 Rumah Sakit / Kesehatan & Layanan Medis',
        'laptop'      => '💻 Laptop / Teknologi & Digital',
        'document'    => '📄 Dokumen / Surat Kontrak & Legalitas',
        'agriculture' => '🌾 Tanaman / Pertanian & Perkebunan',
    ];
    ?>

    <div class="wrap" style="max-width: 1200px; margin-top: 20px;">
        <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 6px; display: flex; align-items: center; gap: 10px;">
            <span style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 10px; background: #088395; color: #fff;">
                <span class="dashicons dashicons-money-alt" style="font-size: 22px; width: 22px; height: 22px;"></span>
            </span>
            Pengaturan Produk: Penyaluran Dana (Pembiayaan Syariah)
        </h1>
        <p style="font-size: 13px; color: #64748b; margin-top: 0; margin-bottom: 25px;">
            Kelola katalog lengkap produk pembiayaan syariah BPRS Wakalumi (Pembiayaan 1000 Pedagang, 1000 Guru, Murabahah, Mudharabah, Musyarakah, Ijarah, Multijasa, Qardhul Hasan), kalkulator simulasi angsuran, alur pengajuan, dan FAQ.
        </p>

        <form method="post" action="">
            <?php wp_nonce_field( 'wakalumi_pembiayaan_nonce' ); ?>

            <!-- ========================================================
                 BAGIAN 1: HEADER BANNER & KOTAK QUOTE SYARIAH
                 ======================================================== -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                    1. Header Banner &amp; Pengawasan Syariah
                </h2>
                <table class="form-table" style="margin: 0;">
                    <tr>
                        <th style="width: 230px;"><label for="options_pembiayaan_page_badge">Kicker Badge (Halaman &amp; Beranda)</label></th>
                        <td>
                            <input type="text" id="options_pembiayaan_page_badge" name="options_pembiayaan_page_badge" value="<?php echo esc_attr( $page_badge ); ?>" class="regular-text" style="width: 100%; max-width: 400px;">
                            <p class="description" style="font-size: 11px; margin-top: 4px; color: #64748b;">Badge yang tampil di atas judul halaman Pembiayaan serta pada seksi Penyaluran Dana di Beranda (misal: <em>Penyaluran Dana Wakalumi</em>).</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_page_title">Judul Halaman</label></th>
                        <td><input type="text" id="options_pembiayaan_page_title" name="options_pembiayaan_page_title" value="<?php echo esc_attr( $page_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_page_subtitle">Subjudul / Deskripsi Header</label></th>
                        <td><textarea id="options_pembiayaan_page_subtitle" name="options_pembiayaan_page_subtitle" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $page_sub ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_quote">Quote / Landasan Syariah</label></th>
                        <td><textarea id="options_pembiayaan_quote" name="options_pembiayaan_quote" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $page_quote ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_trust_title">Judul Kartu Pengawasan OJK &amp; DPS</label></th>
                        <td><input type="text" id="options_pembiayaan_trust_title" name="options_pembiayaan_trust_title" value="<?php echo esc_attr( $trust_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_trust_desc">Deskripsi Kartu Pengawasan</label></th>
                        <td><textarea id="options_pembiayaan_trust_desc" name="options_pembiayaan_trust_desc" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $trust_desc ); ?></textarea></td>
                    </tr>
                </table>
            </div>

            <!-- ========================================================
                 BAGIAN 2: KATALOG PRODUK PEMBIAYAAN DINAMIS (REPEATER)
                 ======================================================== -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-left: 5px solid #ea580c; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <h2 style="font-size: 16px; font-weight: 700; color: #ea580c; margin: 0 0 4px 0;">
                            2. Katalog Produk Pembiayaan Dinamis (Repeater)
                        </h2>
                        <p style="margin: 0; font-size: 12px; color: #64748b;">
                            Setiap produk otomatis tampil sebagai kartu interaktif, memiliki ID anchor untuk mega menu navbar (misal: <code>#pedagang</code>, <code>#guru</code>, <code>#murabahah</code>), dan terhubung ke tabel komparasi serta kalkulator.
                        </p>
                    </div>
                </div>

                <div id="pembiayaan-cards-container" style="display: flex; flex-direction: column; gap: 20px; margin-bottom: 20px;">
                    <?php foreach ( $pembiayaan_list as $index => $prod ) : 
                        $prod_color = $prod['color'] ?? 'teal';
                        $prod_icon  = $prod['icon'] ?? 'store';
                    ?>
                        <div class="pembiayaan-card-item" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); position: relative;">
                            <!-- Header Item -->
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span class="wkl-pem-num" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 50%; background: #ea580c; color: #fff; font-weight: bold; font-size: 12px;">
                                        <?php echo ( $index + 1 ); ?>
                                    </span>
                                    <strong style="font-size: 15px; color: #0f172a;" class="wkl-pem-title-preview">
                                        <?php echo esc_html( $prod['nama'] ?? 'Produk Baru' ); ?>
                                    </strong>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="font-size: 12px; color: #64748b;">Urutan:</span>
                                    <input type="number" name="pem_urutan[]" value="<?php echo esc_attr( $prod['urutan'] ?? ($index + 1) ); ?>" style="width: 60px; height: 30px;" min="1">
                                    <button type="button" class="button wkl-btn-remove-pembiayaan" style="color: #ef4444; border-color: #fca5a5;">
                                        🗑️ Hapus
                                    </button>
                                </div>
                            </div>

                            <!-- Form Grid -->
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px; margin-bottom: 15px;">
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Nama Produk Pembiayaan *</label>
                                    <input type="text" name="pem_nama[]" value="<?php echo esc_attr( $prod['nama'] ?? '' ); ?>" class="regular-text wkl-pem-name-input" style="width: 100%;" required>
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Slug / ID Anchor (#hash untuk tautan mega-menu) *</label>
                                    <input type="text" name="pem_slug[]" value="<?php echo esc_attr( $prod['slug'] ?? '' ); ?>" class="regular-text" style="width: 100%;" placeholder="misal: pedagang, guru, murabahah">
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Tagline Produk</label>
                                    <input type="text" name="pem_tagline[]" value="<?php echo esc_attr( $prod['tagline'] ?? '' ); ?>" class="regular-text" style="width: 100%;">
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Badge / Kategori Sasaran</label>
                                    <input type="text" name="pem_badge[]" value="<?php echo esc_attr( $prod['badge'] ?? 'UMKM' ); ?>" class="regular-text" style="width: 100%;" placeholder="misal: Pedagang & UMKM, Guru">
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Tema Warna Kartu</label>
                                    <select name="pem_color[]" style="width: 100%;">
                                        <?php foreach ( $color_options as $c_val => $c_label ) : ?>
                                            <option value="<?php echo esc_attr( $c_val ); ?>" <?php selected( $prod_color, $c_val ); ?>>
                                                <?php echo esc_html( $c_label ); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Ikon Kartu Produk</label>
                                    <select name="pem_icon[]" style="width: 100%;">
                                        <?php foreach ( $icon_options as $i_val => $i_label ) : ?>
                                            <option value="<?php echo esc_attr( $i_val ); ?>" <?php selected( $prod_icon, $i_val ); ?>>
                                                <?php echo esc_html( $i_label ); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Akad Syariah</label>
                                    <input type="text" name="pem_akad[]" value="<?php echo esc_attr( $prod['akad'] ?? 'Murabahah' ); ?>" class="regular-text" style="width: 100%;" placeholder="misal: Al-Murabahah (Jual Beli)">
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Kisaran Plafon Pinjaman</label>
                                    <input type="text" name="pem_limit_primary[]" value="<?php echo esc_attr( $prod['limit_primary'] ?? 'Plafon Rp 5 Jt s.d. Rp 100 Juta' ); ?>" class="regular-text" style="width: 100%;" placeholder="Plafon Rp 5 Jt s.d. Rp 100 Juta">
                                </div>

                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Jangka Waktu / Tenor</label>
                                    <input type="text" name="pem_limit_secondary[]" value="<?php echo esc_attr( $prod['limit_secondary'] ?? 'Tenor 6 s.d. 36 Bulan' ); ?>" class="regular-text" style="width: 100%;" placeholder="Tenor 6 s.d. 36 Bulan">
                                </div>

                                <div style="grid-column: 1 / -1;">
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Custom SVG Ikon (Opsional - Jika diisi, mengesampingkan pilihan ikon preset di atas)</label>
                                    <textarea name="pem_custom_svg[]" rows="2" class="large-text" style="width: 100%; font-family: monospace; font-size: 11px;" placeholder="<svg class=&quot;w-6 h-6&quot; fill=&quot;none&quot; viewBox=&quot;0 0 24 24&quot; stroke=&quot;currentColor&quot;>...</svg>"><?php echo esc_textarea( $prod['custom_svg'] ?? '' ); ?></textarea>
                                </div>

                                <div style="grid-column: 1 / -1;" class="wkl-img-field-wrap">
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">
                                        Gambar Banner / Kartu Produk (Opsional - Rekomendasi Rasio Standar 16:10 / 800x500px)
                                    </label>
                                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                                        <input type="text" name="pem_image[]" value="<?php echo esc_attr( $prod['image'] ?? '' ); ?>" class="regular-text" style="flex: 1; min-width: 250px;" placeholder="https://... atau klik Unggah Gambar">
                                        <button type="button" class="button wkl-upload-pem-img-btn" style="display: inline-flex; align-items: center; gap: 5px;">
                                            <span class="dashicons dashicons-format-image" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah Gambar
                                        </button>
                                        <button type="button" class="button button-link-delete wkl-remove-pem-img-btn" style="color: #ef4444; <?php echo empty( $prod['image'] ) ? 'display:none;' : ''; ?>">
                                            ✕ Hapus
                                        </button>
                                    </div>
                                    <div class="wkl-img-preview-box" style="margin-top: 8px;">
                                        <img class="wkl-img-preview" src="<?php echo esc_url( $prod['image'] ?? '' ); ?>" style="height: 65px; border-radius: 6px; border: 1px solid #cbd5e1; object-fit: cover; <?php echo empty( $prod['image'] ) ? 'display:none;' : ''; ?>" alt="Preview Produk">
                                    </div>
                                    <p class="description" style="font-size: 11px; margin-top: 4px; color: #64748b;">Jika gambar diisi, kartu di beranda dan halaman pembiayaan akan menampilkan grafis produk dengan rasio standar 16:10 (800x500px) menggantikan ikon default.</p>
                                </div>
                            </div>

                            <div style="margin-bottom: 15px;">
                                <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Deskripsi Produk</label>
                                <textarea name="pem_desc[]" rows="2" class="large-text" style="width: 100%;"><?php echo esc_textarea( $prod['desc'] ?? '' ); ?></textarea>
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px; margin-bottom: 15px;">
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Keunggulan (1 baris per poin)</label>
                                    <textarea name="pem_keunggulan[]" rows="4" class="large-text" style="width: 100%; font-size: 12px;"><?php echo esc_textarea( $prod['keunggulan'] ?? '' ); ?></textarea>
                                </div>
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Persyaratan Dokumen (1 baris per poin)</label>
                                    <textarea name="pem_syarat[]" rows="4" class="large-text" style="width: 100%; font-size: 12px;"><?php echo esc_textarea( $prod['syarat'] ?? '' ); ?></textarea>
                                </div>
                            </div>

                            <div>
                                <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Template Pesan WhatsApp Khusus Produk Ini</label>
                                <textarea name="pem_wa_text[]" rows="2" class="large-text" style="width: 100%; font-size: 12px;"><?php echo esc_textarea( $prod['wa_text'] ?? '' ); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button type="button" id="btn-add-pembiayaan-card" class="button button-primary" style="background: #ea580c; border-color: #c2410c; display: inline-flex; align-items: center; gap: 6px; font-weight: bold; padding: 6px 14px; height: auto;">
                    <span class="dashicons dashicons-plus-alt2" style="font-size: 18px; width: 18px; height: 18px;"></span> + Tambah Produk Pembiayaan Baru
                </button>
            </div>

            <!-- ========================================================
                 BAGIAN 3: KALKULATOR SIMULASI ANGSURAN PEMBIAYAAN
                 ======================================================== -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                    3. Kalkulator Simulasi Angsuran Pembiayaan
                </h2>
                <table class="form-table" style="margin: 0 0 20px 0;">
                    <tr>
                        <th style="width: 230px;"><label for="options_pembiayaan_calc_badge">Badge Kicker</label></th>
                        <td><input type="text" id="options_pembiayaan_calc_badge" name="options_pembiayaan_calc_badge" value="<?php echo esc_attr( $calc_badge ); ?>" class="regular-text" style="width: 100%; max-width: 400px;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_calc_title">Judul Kalkulator</label></th>
                        <td><input type="text" id="options_pembiayaan_calc_title" name="options_pembiayaan_calc_title" value="<?php echo esc_attr( $calc_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_calc_sub">Deskripsi Kalkulator</label></th>
                        <td><textarea id="options_pembiayaan_calc_sub" name="options_pembiayaan_calc_sub" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $calc_sub ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_calc_rate">Indikasi Margin Setara (% p.a. flat)</label></th>
                        <td>
                            <input type="number" step="0.1" id="options_pembiayaan_calc_rate" name="options_pembiayaan_calc_rate" value="<?php echo esc_attr( $calc_rate ); ?>" style="width: 100px; font-weight: bold; text-align: center;"> % per tahun
                            <p class="description">Digunakan sebagai dasar formula estimasi angsuran pokok + margin per bulan.</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label>Rentang Plafon Slider</label></th>
                        <td>
                            Min: <input type="number" name="options_pembiayaan_calc_min" value="<?php echo esc_attr( $calc_min ); ?>" style="width: 130px;">
                            s.d. Max: <input type="number" name="options_pembiayaan_calc_max" value="<?php echo esc_attr( $calc_max ); ?>" style="width: 140px;">
                            (Default awal: <input type="number" name="options_pembiayaan_calc_default" value="<?php echo esc_attr( $calc_default ); ?>" style="width: 130px;">)
                        </td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_calc_note">Catatan Estimasi Syariah</label></th>
                        <td><textarea id="options_pembiayaan_calc_note" name="options_pembiayaan_calc_note" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $calc_note ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_calc_btn_text">Teks Tombol Aksi</label></th>
                        <td><input type="text" id="options_pembiayaan_calc_btn_text" name="options_pembiayaan_calc_btn_text" value="<?php echo esc_attr( $calc_btn_text ); ?>" class="regular-text" style="width: 100%; max-width: 350px;"></td>
                    </tr>
                </table>

                <h3 style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 10px;">
                    Tombol Shortcut Preset Nominal Simulasi
                </h3>
                <table class="widefat striped" style="margin-bottom: 12px;">
                    <thead>
                        <tr>
                            <th>Label Tombol</th>
                            <th>Nominal Plafon (Rp)</th>
                            <th>Tenor (Bulan)</th>
                            <th>Target Produk</th>
                            <th style="width: 60px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pem-preset-tbody">
                        <?php foreach ( $calc_presets as $pi => $pres ) : ?>
                            <tr class="pem-preset-row">
                                <td><input type="text" name="calc_preset_label[]" value="<?php echo esc_attr( $pres['label'] ?? '' ); ?>" style="width: 100%;" required></td>
                                <td><input type="number" name="calc_preset_nominal[]" value="<?php echo esc_attr( $pres['nominal'] ?? '' ); ?>" style="width: 100%;" required></td>
                                <td><input type="number" name="calc_preset_tenor[]" value="<?php echo esc_attr( $pres['tenor'] ?? '12' ); ?>" style="width: 100%;" required></td>
                                <td><input type="text" name="calc_preset_prod[]" value="<?php echo esc_attr( $pres['prod'] ?? '' ); ?>" style="width: 100%;" placeholder="Pilih produk atau kosongkan"></td>
                                <td style="text-align: center;"><button type="button" class="button button-link-delete wkl-remove-pem-preset" style="color: #ef4444;">✕</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" id="btn-add-pem-preset" class="button" style="font-weight: 600;">
                    + Tambah Shortcut Preset
                </button>
            </div>

            <!-- ========================================================
                 BAGIAN 4: ALUR & PROSEDUR 4 LANGKAH PENGAJUAN
                 ======================================================== -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-left: 5px solid #059669; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #059669; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                    4. Alur &amp; Prosedur 4 Langkah Pengajuan Pembiayaan
                </h2>
                <table class="form-table" style="margin: 0 0 15px 0;">
                    <tr>
                        <th style="width: 230px;"><label for="options_pembiayaan_alur_kicker">Kicker Bagian</label></th>
                        <td><input type="text" id="options_pembiayaan_alur_kicker" name="options_pembiayaan_alur_kicker" value="<?php echo esc_attr( $alur_kicker ); ?>" class="regular-text" style="width: 100%; max-width: 400px;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_alur_title">Judul Bagian</label></th>
                        <td><input type="text" id="options_pembiayaan_alur_title" name="options_pembiayaan_alur_title" value="<?php echo esc_attr( $alur_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_alur_sub">Subjudul Bagian</label></th>
                        <td><textarea id="options_pembiayaan_alur_sub" name="options_pembiayaan_alur_sub" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $alur_sub ); ?></textarea></td>
                    </tr>
                </table>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 15px;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px;">
                        <strong>Langkah 1</strong>
                        <input type="text" name="options_pembiayaan_step_1_title" value="<?php echo esc_attr( $step_1_title ); ?>" style="width: 100%; margin: 6px 0; font-weight: 600;">
                        <textarea name="options_pembiayaan_step_1_desc" rows="3" style="width: 100%; font-size: 12px;"><?php echo esc_textarea( $step_1_desc ); ?></textarea>
                    </div>
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px;">
                        <strong>Langkah 2</strong>
                        <input type="text" name="options_pembiayaan_step_2_title" value="<?php echo esc_attr( $step_2_title ); ?>" style="width: 100%; margin: 6px 0; font-weight: 600;">
                        <textarea name="options_pembiayaan_step_2_desc" rows="3" style="width: 100%; font-size: 12px;"><?php echo esc_textarea( $step_2_desc ); ?></textarea>
                    </div>
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px;">
                        <strong>Langkah 3</strong>
                        <input type="text" name="options_pembiayaan_step_3_title" value="<?php echo esc_attr( $step_3_title ); ?>" style="width: 100%; margin: 6px 0; font-weight: 600;">
                        <textarea name="options_pembiayaan_step_3_desc" rows="3" style="width: 100%; font-size: 12px;"><?php echo esc_textarea( $step_3_desc ); ?></textarea>
                    </div>
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px;">
                        <strong>Langkah 4</strong>
                        <input type="text" name="options_pembiayaan_step_4_title" value="<?php echo esc_attr( $step_4_title ); ?>" style="width: 100%; margin: 6px 0; font-weight: 600;">
                        <textarea name="options_pembiayaan_step_4_desc" rows="3" style="width: 100%; font-size: 12px;"><?php echo esc_textarea( $step_4_desc ); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- ========================================================
                 BAGIAN 5: TANYA JAWAB (FAQ / QNA)
                 ======================================================== -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-left: 5px solid #6366f1; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #6366f1; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                    5. Tanya Jawab (FAQ / QnA Pembiayaan)
                </h2>
                <table class="form-table" style="margin: 0 0 15px 0;">
                    <tr>
                        <th style="width: 230px;"><label for="options_pembiayaan_faq_badge">Badge FAQ</label></th>
                        <td><input type="text" id="options_pembiayaan_faq_badge" name="options_pembiayaan_faq_badge" value="<?php echo esc_attr( $faq_badge ); ?>" class="regular-text" style="width: 100%; max-width: 400px;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_faq_title">Judul Bagian FAQ</label></th>
                        <td><input type="text" id="options_pembiayaan_faq_title" name="options_pembiayaan_faq_title" value="<?php echo esc_attr( $faq_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_faq_sub">Subjudul Bagian FAQ</label></th>
                        <td><textarea id="options_pembiayaan_faq_sub" name="options_pembiayaan_faq_sub" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $faq_sub ); ?></textarea></td>
                    </tr>
                </table>

                <div id="pem-faq-container" style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 15px;">
                    <?php foreach ( $faq_list as $fi => $faq ) : ?>
                        <div class="pem-faq-item" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; position: relative;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <strong style="font-size: 13px; color: #334155;">Pertanyaan #<span class="faq-idx"><?php echo ( $fi + 1 ); ?></span></strong>
                                <button type="button" class="button button-link-delete wkl-remove-pem-faq" style="color: #ef4444;">✕ Hapus</button>
                            </div>
                            <input type="text" name="pem_faq_q[]" value="<?php echo esc_attr( $faq['q'] ?? '' ); ?>" class="large-text" style="width: 100%; font-weight: 600; margin-bottom: 8px;" placeholder="Tuliskan pertanyaan nasabah..." required>
                            <textarea name="pem_faq_a[]" rows="3" class="large-text" style="width: 100%;" placeholder="Tuliskan jawaban lengkap dari pihak bank..." required><?php echo esc_textarea( $faq['a'] ?? '' ); ?></textarea>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" id="btn-add-pem-faq" class="button" style="font-weight: 600;">
                    + Tambah Pertanyaan FAQ Baru
                </button>
            </div>

            <!-- ========================================================
                 BAGIAN 6: BOX KONSULTASI RELATIONSHIP MANAGER (SIDEBAR FAQ)
                 ======================================================== -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-left: 5px solid #4f46e5; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #4f46e5; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                    6. Box Konsultasi Relationship Manager (Sidebar FAQ)
                </h2>
                <table class="form-table" style="margin: 0;">
                    <tr>
                        <th style="width: 230px;"><label for="options_pembiayaan_rm_show">Tampilkan Box Ini</label></th>
                        <td>
                            <label>
                                <input type="checkbox" id="options_pembiayaan_rm_show" name="options_pembiayaan_rm_show" value="1" <?php checked( $rm_show, '1' ); ?>>
                                Aktifkan kartu konsultasi Relationship Manager di samping FAQ
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_rm_title">Judul Kartu</label></th>
                        <td><input type="text" id="options_pembiayaan_rm_title" name="options_pembiayaan_rm_title" value="<?php echo esc_attr( $rm_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_rm_desc">Deskripsi</label></th>
                        <td><textarea id="options_pembiayaan_rm_desc" name="options_pembiayaan_rm_desc" rows="3" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $rm_desc ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_rm_btn_text">Teks Tombol WhatsApp</label></th>
                        <td><input type="text" id="options_pembiayaan_rm_btn_text" name="options_pembiayaan_rm_btn_text" value="<?php echo esc_attr( $rm_btn_text ); ?>" class="regular-text" style="width: 100%; max-width: 350px;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_rm_wa_msg">Template Pesan WhatsApp</label></th>
                        <td><textarea id="options_pembiayaan_rm_wa_msg" name="options_pembiayaan_rm_wa_msg" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $rm_wa_msg ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_rm_wa_num">Nomor WhatsApp Khusus RM (Opsional)</label></th>
                        <td>
                            <input type="text" id="options_pembiayaan_rm_wa_num" name="options_pembiayaan_rm_wa_num" value="<?php echo esc_attr( $rm_wa_num ); ?>" class="regular-text" style="width: 100%; max-width: 350px;" placeholder="Contoh: 08123456789">
                            <p class="description" style="font-size: 11px; color: #64748b; margin-top: 4px;">Kosongkan jika ingin menggunakan nomor WhatsApp kontak utama website secara otomatis.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ========================================================
                 BAGIAN 7: BANNER CTA KONSULTASI PEMBIAYAAN
                 ======================================================== -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-left: 5px solid #088395; border-radius: 12px; padding: 22px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #088395; margin-top: 0; margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
                    7. Banner CTA Konsultasi Pembiayaan
                </h2>
                <table class="form-table" style="margin: 0;">
                    <tr>
                        <th style="width: 230px;"><label for="options_pembiayaan_cta_kicker">Kicker Banner</label></th>
                        <td><input type="text" id="options_pembiayaan_cta_kicker" name="options_pembiayaan_cta_kicker" value="<?php echo esc_attr( $cta_kicker ); ?>" class="regular-text" style="width: 100%; max-width: 450px;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_cta_title">Judul Banner CTA</label></th>
                        <td><input type="text" id="options_pembiayaan_cta_title" name="options_pembiayaan_cta_title" value="<?php echo esc_attr( $cta_title ); ?>" class="regular-text" style="width: 100%; max-width: 550px; font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_cta_desc">Deskripsi Banner CTA</label></th>
                        <td><textarea id="options_pembiayaan_cta_desc" name="options_pembiayaan_cta_desc" rows="3" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $cta_desc ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_cta_btn_text">Teks Tombol WhatsApp</label></th>
                        <td><input type="text" id="options_pembiayaan_cta_btn_text" name="options_pembiayaan_cta_btn_text" value="<?php echo esc_attr( $cta_btn_text ); ?>" class="regular-text" style="width: 100%; max-width: 350px;"></td>
                    </tr>
                    <tr>
                        <th><label for="options_pembiayaan_cta_wa_msg">Template Pesan WhatsApp</label></th>
                        <td><textarea id="options_pembiayaan_cta_wa_msg" name="options_pembiayaan_cta_wa_msg" rows="2" class="large-text" style="width: 100%; max-width: 650px;"><?php echo esc_textarea( $cta_wa_msg ); ?></textarea></td>
                    </tr>
                </table>
            </div>

            <div style="position: sticky; bottom: 20px; z-index: 99; background: #fff; padding: 15px 20px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
                <span style="font-size: 13px; color: #64748b;">Pastikan memeriksa kembali kelengkapan seluruh data sebelum menyimpan.</span>
                <button type="submit" name="wakalumi_save_pembiayaan" class="button button-primary button-hero" style="background: #088395; border-color: #066e7d; font-weight: bold;">
                    💾 Simpan Seluruh Pengaturan Pembiayaan
                </button>
            </div>
        </form>
    </div>

    <!-- Template JS Repeater Kartu Produk Pembiayaan -->
    <template id="pembiayaan-card-template">
        <div class="pembiayaan-card-item" style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); position: relative;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span class="wkl-pem-num" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 50%; background: #ea580c; color: #fff; font-weight: bold; font-size: 12px;">#</span>
                    <strong style="font-size: 15px; color: #0f172a;" class="wkl-pem-title-preview">Produk Pembiayaan Baru</strong>
                </div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 12px; color: #64748b;">Urutan:</span>
                    <input type="number" name="pem_urutan[]" value="99" style="width: 60px; height: 30px;" min="1">
                    <button type="button" class="button wkl-btn-remove-pembiayaan" style="color: #ef4444; border-color: #fca5a5;">🗑️ Hapus</button>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Nama Produk Pembiayaan *</label>
                    <input type="text" name="pem_nama[]" value="" class="regular-text wkl-pem-name-input" style="width: 100%;" required>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Slug / ID Anchor (#hash untuk tautan) *</label>
                    <input type="text" name="pem_slug[]" value="" class="regular-text" style="width: 100%;" placeholder="misal: pedagang, modal-kerja">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Tagline Produk</label>
                    <input type="text" name="pem_tagline[]" value="" class="regular-text" style="width: 100%;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Badge / Kategori Sasaran</label>
                    <input type="text" name="pem_badge[]" value="UMKM" class="regular-text" style="width: 100%;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Tema Warna Kartu</label>
                    <select name="pem_color[]" style="width: 100%;">
                        <?php foreach ( $color_options as $c_val => $c_label ) : ?>
                            <option value="<?php echo esc_attr( $c_val ); ?>"><?php echo esc_html( $c_label ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Ikon Kartu Produk</label>
                    <select name="pem_icon[]" style="width: 100%;">
                        <?php foreach ( $icon_options as $i_val => $i_label ) : ?>
                            <option value="<?php echo esc_attr( $i_val ); ?>"><?php echo esc_html( $i_label ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Akad Syariah</label>
                    <input type="text" name="pem_akad[]" value="Murabahah" class="regular-text" style="width: 100%;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Kisaran Plafon Pinjaman</label>
                    <input type="text" name="pem_limit_primary[]" value="Plafon Rp 5 Jt s.d. Rp 100 Juta" class="regular-text" style="width: 100%;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Jangka Waktu / Tenor</label>
                    <input type="text" name="pem_limit_secondary[]" value="Tenor 12 s.d. 36 Bulan" class="regular-text" style="width: 100%;">
                </div>
                <div style="grid-column: 1 / -1;">
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Custom SVG Ikon (Opsional - Jika diisi, mengesampingkan pilihan ikon preset di atas)</label>
                    <textarea name="pem_custom_svg[]" rows="2" class="large-text" style="width: 100%; font-family: monospace; font-size: 11px;" placeholder="<svg class=&quot;w-6 h-6&quot; fill=&quot;none&quot; viewBox=&quot;0 0 24 24&quot; stroke=&quot;currentColor&quot;>...</svg>"></textarea>
                </div>

                <div style="grid-column: 1 / -1;" class="wkl-img-field-wrap">
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">
                        Gambar Banner / Kartu Produk (Opsional - Rekomendasi Rasio Standar 16:10 / 800x500px)
                    </label>
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <input type="text" name="pem_image[]" value="" class="regular-text" style="flex: 1; min-width: 250px;" placeholder="https://... atau klik Unggah Gambar">
                        <button type="button" class="button wkl-upload-pem-img-btn" style="display: inline-flex; align-items: center; gap: 5px;">
                            <span class="dashicons dashicons-format-image" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah Gambar
                        </button>
                        <button type="button" class="button button-link-delete wkl-remove-pem-img-btn" style="color: #ef4444; display: none;">
                            ✕ Hapus
                        </button>
                    </div>
                    <div class="wkl-img-preview-box" style="margin-top: 8px;">
                        <img class="wkl-img-preview" src="" style="height: 65px; border-radius: 6px; border: 1px solid #cbd5e1; object-fit: cover; display: none;" alt="Preview Produk">
                    </div>
                    <p class="description" style="font-size: 11px; margin-top: 4px; color: #64748b;">Jika gambar diisi, kartu di beranda dan halaman pembiayaan akan menampilkan grafis produk dengan rasio standar 16:10 (800x500px) menggantikan ikon default.</p>
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Deskripsi Produk</label>
                <textarea name="pem_desc[]" rows="2" class="large-text" style="width: 100%;"></textarea>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Keunggulan (1 baris per poin)</label>
                    <textarea name="pem_keunggulan[]" rows="4" class="large-text" style="width: 100%; font-size: 12px;"></textarea>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Persyaratan Dokumen (1 baris per poin)</label>
                    <textarea name="pem_syarat[]" rows="4" class="large-text" style="width: 100%; font-size: 12px;"></textarea>
                </div>
            </div>

            <div>
                <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px; color: #334155;">Template Pesan WhatsApp Khusus Produk Ini</label>
                <textarea name="pem_wa_text[]" rows="2" class="large-text" style="width: 100%; font-size: 12px;"></textarea>
            </div>
        </div>
    </template>

    <!-- Template JS Repeater Preset -->
    <template id="pem-preset-template">
        <tr class="pem-preset-row">
            <td><input type="text" name="calc_preset_label[]" value="" style="width: 100%;" placeholder="Contoh: Rp 25 Jt (Usaha)" required></td>
            <td><input type="number" name="calc_preset_nominal[]" value="25000000" style="width: 100%;" required></td>
            <td><input type="number" name="calc_preset_tenor[]" value="24" style="width: 100%;" required></td>
            <td><input type="text" name="calc_preset_prod[]" value="" style="width: 100%;" placeholder="Nama target produk"></td>
            <td style="text-align: center;"><button type="button" class="button button-link-delete wkl-remove-pem-preset" style="color: #ef4444;">✕</button></td>
        </tr>
    </template>

    <!-- Template JS Repeater FAQ -->
    <template id="pem-faq-template">
        <div class="pem-faq-item" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; position: relative;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <strong style="font-size: 13px; color: #334155;">Pertanyaan Baru</strong>
                <button type="button" class="button button-link-delete wkl-remove-pem-faq" style="color: #ef4444;">✕ Hapus</button>
            </div>
            <input type="text" name="pem_faq_q[]" value="" class="large-text" style="width: 100%; font-weight: 600; margin-bottom: 8px;" placeholder="Tuliskan pertanyaan nasabah..." required>
            <textarea name="pem_faq_a[]" rows="3" class="large-text" style="width: 100%;" placeholder="Tuliskan jawaban lengkap dari pihak bank..." required></textarea>
        </div>
    </template>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Repeater Kartu Pembiayaan
        var container = document.getElementById('pembiayaan-cards-container');
        var addBtn = document.getElementById('btn-add-pembiayaan-card');
        var tmpl = document.getElementById('pembiayaan-card-template');

        function updateCardNumbers() {
            if (!container) return;
            var cards = container.querySelectorAll('.pembiayaan-card-item');
            cards.forEach(function(card, idx) {
                var numBadge = card.querySelector('.wkl-pem-num');
                if (numBadge) numBadge.textContent = idx + 1;
            });
        }

        function bindCardEvents(card) {
            var removeBtn = card.querySelector('.wkl-btn-remove-pembiayaan');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    if (confirm('Hapus kartu produk pembiayaan ini?')) {
                        card.remove();
                        updateCardNumbers();
                    }
                });
            }
            var nameInput = card.querySelector('.wkl-pem-name-input');
            var previewTitle = card.querySelector('.wkl-pem-title-preview');
            if (nameInput && previewTitle) {
                nameInput.addEventListener('input', function() {
                    previewTitle.textContent = this.value || 'Produk Baru';
                });
            }
        }

        if (container) {
            container.querySelectorAll('.pembiayaan-card-item').forEach(function(card) {
                bindCardEvents(card);
            });
        }

        if (addBtn && tmpl && container) {
            addBtn.addEventListener('click', function() {
                var clone = tmpl.content.cloneNode(true);
                var newCard = clone.querySelector('.pembiayaan-card-item');
                bindCardEvents(newCard);
                container.appendChild(newCard);
                updateCardNumbers();
                newCard.scrollIntoView({ behavior: 'smooth' });
            });
        }

        // 2. Repeater Shortcut Preset
        var presetTbody = document.getElementById('pem-preset-tbody');
        var addPresetBtn = document.getElementById('btn-add-pem-preset');
        var presetTmpl = document.getElementById('pem-preset-template');

        function bindPresetRow(row) {
            var removeBtn = row.querySelector('.wkl-remove-pem-preset');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    row.remove();
                });
            }
        }

        if (presetTbody) {
            presetTbody.querySelectorAll('.pem-preset-row').forEach(function(row) {
                bindPresetRow(row);
            });
        }

        if (addPresetBtn && presetTmpl && presetTbody) {
            addPresetBtn.addEventListener('click', function() {
                var clone = presetTmpl.content.cloneNode(true);
                var newRow = clone.querySelector('.pem-preset-row');
                bindPresetRow(newRow);
                presetTbody.appendChild(newRow);
            });
        }

        // 3. Repeater FAQ
        var faqContainer = document.getElementById('pem-faq-container');
        var addFaqBtn = document.getElementById('btn-add-pem-faq');
        var faqTmpl = document.getElementById('pem-faq-template');

        function bindFaqItem(item) {
            var removeBtn = item.querySelector('.wkl-remove-pem-faq');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    item.remove();
                });
            }
        }

        if (faqContainer) {
            faqContainer.querySelectorAll('.pem-faq-item').forEach(function(item) {
                bindFaqItem(item);
            });
        }

        if (addFaqBtn && faqTmpl && faqContainer) {
            addFaqBtn.addEventListener('click', function() {
                var clone = faqTmpl.content.cloneNode(true);
                var newItem = clone.querySelector('.pem-faq-item');
                bindFaqItem(newItem);
                faqContainer.appendChild(newItem);
            });
        }

        // 4. Media Uploader Kartu Pembiayaan
        if (window.jQuery) {
            var $ = window.jQuery;
            $(document).on('click', '.wkl-upload-pem-img-btn', function(e) {
                e.preventDefault();
                var btn = $(this);
                var wrap = btn.closest('.wkl-img-field-wrap');
                var input = wrap.find('input[name="pem_image[]"]');
                var preview = wrap.find('img.wkl-img-preview');
                var removeBtn = wrap.find('.wkl-remove-pem-img-btn');

                var frame = wp.media({
                    title: 'Pilih atau Unggah Gambar Produk Pembiayaan (Rekomendasi Rasio 16:10)',
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

            $(document).on('click', '.wkl-remove-pem-img-btn', function(e) {
                e.preventDefault();
                var btn = $(this);
                var wrap = btn.closest('.wkl-img-field-wrap');
                var input = wrap.find('input[name="pem_image[]"]');
                var preview = wrap.find('img.wkl-img-preview');
                input.val('').trigger('change');
                if (preview.length) {
                    preview.attr('src', '').hide();
                }
                btn.hide();
            });
        }
    });
    </script>
    <?php
}

