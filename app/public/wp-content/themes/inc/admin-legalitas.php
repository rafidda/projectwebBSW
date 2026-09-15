<?php
/**
 * Admin Panel: Profil & Legalitas Perusahaan
 *
 * Mengelola konten halaman Profil: Legalitas Perusahaan (NIB, NPWP, NPWZ, Izin SK, Akta Notaris, Regulasi)
 * 100% Free tanpa ketergantungan plugin berbayar.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Registrasi Submenu di bawah "Pengaturan Website"
 */
function wakalumi_register_legalitas_admin_menu() {
    add_submenu_page(
        'wakalumi-settings',
        'Profil: Legalitas Perusahaan',
        'Profil: Legalitas',
        'manage_options',
        'wakalumi-legalitas',
        'wakalumi_render_legalitas_admin_page'
    );
}
add_action( 'admin_menu', 'wakalumi_register_legalitas_admin_menu', 21 );

/**
 * Render Halaman Admin Profil: Legalitas Perusahaan
 */
function wakalumi_render_legalitas_admin_page() {
    // ── PROSES SIMPAN DATA ──────────────────────────────────────────
    if ( isset( $_POST['wakalumi_save_legalitas'] ) && check_admin_referer( 'wakalumi_legalitas_nonce' ) ) {
        // 1. Header Banner
        update_option( 'options_legal_page_badge', sanitize_text_field( $_POST['options_legal_page_badge'] ?? '' ) );
        update_option( 'options_legal_page_title', sanitize_text_field( $_POST['options_legal_page_title'] ?? '' ) );
        update_option( 'options_legal_page_subtitle', sanitize_textarea_field( $_POST['options_legal_page_subtitle'] ?? '' ) );

        // 2. Registrasi Fiskal & Izin
        update_option( 'options_legal_company_name', sanitize_text_field( $_POST['options_legal_company_name'] ?? '' ) );
        update_option( 'options_legal_founder', sanitize_text_field( $_POST['options_legal_founder'] ?? '' ) );
        update_option( 'options_legal_nib', sanitize_text_field( $_POST['options_legal_nib'] ?? '' ) );
        update_option( 'options_legal_npwp', sanitize_text_field( $_POST['options_legal_npwp'] ?? '' ) );
        update_option( 'options_legal_npwz', sanitize_text_field( $_POST['options_legal_npwz'] ?? '' ) );

        // 3. Izin Operasi
        update_option( 'options_legal_sk_menkeu', sanitize_text_field( $_POST['options_legal_sk_menkeu'] ?? '' ) );
        update_option( 'options_legal_sk_bi', sanitize_text_field( $_POST['options_legal_sk_bi'] ?? '' ) );
        update_option( 'options_legal_head_office', sanitize_textarea_field( $_POST['options_legal_head_office'] ?? '' ) );
        update_option( 'options_legal_phone', sanitize_text_field( $_POST['options_legal_phone'] ?? '' ) );

        // 4. Repeater Akta Notaris & Perubahan Anggaran Dasar
        $raw_years    = $_POST['legal_akta_year'] ?? [];
        $raw_numbers  = $_POST['legal_akta_number'] ?? [];
        $raw_notaris  = $_POST['legal_akta_notaris'] ?? [];
        $raw_sks      = $_POST['legal_akta_sk'] ?? [];
        $raw_descs    = $_POST['legal_akta_desc'] ?? [];
        $clean_aktas  = [];

        for ( $i = 0; $i < count( $raw_numbers ); $i++ ) {
            $num = sanitize_text_field( $raw_numbers[$i] ?? '' );
            if ( ! empty( $num ) ) {
                $clean_aktas[] = [
                    'year'    => sanitize_text_field( $raw_years[$i] ?? '' ),
                    'number'  => $num,
                    'notaris' => sanitize_text_field( $raw_notaris[$i] ?? '' ),
                    'sk'      => sanitize_text_field( $raw_sks[$i] ?? '' ),
                    'desc'    => sanitize_textarea_field( $raw_descs[$i] ?? '' ),
                ];
            }
        }
        update_option( 'options_legal_akta_list', $clean_aktas );

        // 5. CTA
        update_option( 'options_legal_cta_title', sanitize_text_field( $_POST['options_legal_cta_title'] ?? '' ) );
        update_option( 'options_legal_cta_desc', sanitize_textarea_field( $_POST['options_legal_cta_desc'] ?? '' ) );
        update_option( 'options_legal_cta_btn1_text', sanitize_text_field( $_POST['options_legal_cta_btn1_text'] ?? '' ) );
        update_option( 'options_legal_cta_btn1_url', esc_url_raw( $_POST['options_legal_cta_btn1_url'] ?? '' ) );
        update_option( 'options_legal_cta_btn2_text', sanitize_text_field( $_POST['options_legal_cta_btn2_text'] ?? '' ) );
        update_option( 'options_legal_cta_btn2_url', esc_url_raw( $_POST['options_legal_cta_btn2_url'] ?? '' ) );

        echo '<div class="notice notice-success is-dismissible"><p><strong>Pengaturan Halaman Legalitas Perusahaan berhasil disimpan!</strong></p></div>';
    }

    // ── AMBIL DATA DENGAN DEFAULT VALUE DARI PROFIL PERUSAHAAN.MD ───────
    $page_badge    = get_option( 'options_legal_page_badge', 'Transparansi & Kepatuhan Regulasi' );
    $page_title    = get_option( 'options_legal_page_title', 'Legalitas & Landasan Hukum Resmi' );
    $page_subtitle = get_option( 'options_legal_page_subtitle', 'Bukti legalitas pendirian, perizinan operasional perbankan syariah, registrasi perpajakan, dan kepatuhan regulasi PT Bank Perekonomian Rakyat Syariah Wakalumi.' );

    $company_name  = get_option( 'options_legal_company_name', 'PT. Bank Perekonomian Rakyat Syariah Wakalumi' );
    $founder       = get_option( 'options_legal_founder', 'Yayasan Wakalumi (Wakaf Karyawan dan Alumni Muslim Citibank)' );
    $nib           = get_option( 'options_legal_nib', '129.200.032.0036' );
    $npwp          = get_option( 'options_legal_npwp', '1.484.259.5-411.000' );
    $npwz          = get_option( 'options_legal_npwz', 'B1 000 005 8 411 000' );

    $sk_menkeu     = get_option( 'options_legal_sk_menkeu', 'Nomor Kep-016/KM.17/1995 Tanggal 16 Januari 1995' );
    $sk_bi         = get_option( 'options_legal_sk_bi', 'Nomor 13/5/KEP.Dir/Pbs/2011 Tanggal 13 Juli 2011' );
    $head_office   = get_option( 'options_legal_head_office', 'Komp. Ciputat Mutiara Center Blok B1, Jl. Dewi Sartika Ciputat - Tangerang Selatan' );
    $phone         = get_option( 'options_legal_phone', '021-7401667 / 021-749084, 021-7442788' );

    $aktas = get_option( 'options_legal_akta_list', [] );
    if ( empty( $aktas ) ) {
        $aktas = [
            [
                'year'    => '1989',
                'number'  => 'Akta Notaris No. 59 Tanggal 7 Oktober 1989',
                'notaris' => 'Ny. Siti Pertiwi Henny Shidki, SH',
                'sk'      => 'SK Menteri Kehakiman RI No. C2-155.HT.01.01.TH.90 (13 Januari 1990)',
                'desc'    => 'Akta Pendirian PT BPRS Wakalumi oleh Yayasan Wakalumi.',
            ],
            [
                'year'    => '1994',
                'number'  => 'Akta Notaris No. 78 Tanggal 9 Juni 1994',
                'notaris' => 'B.R.A.Y Mahyastoeti Notonagoro, SH',
                'sk'      => 'SK Terkait Penataan Manajemen & Kepemilikan Saham',
                'desc'    => 'Perubahan Anggaran Dasar dan bantuan teknis manajemen Bank Muamalat Indonesia.',
            ],
            [
                'year'    => '2011',
                'number'  => 'Akta Notaris No. 13 Tanggal 16 Maret 2011',
                'notaris' => 'Notaris Rekanan Resmi',
                'sk'      => 'SK Menkumham No. AHU-25293.A.H.01.02 Tahun 2011 (20 Mei 2011)',
                'desc'    => 'Persetujuan Perubahan Anggaran Dasar BPRS Wakalumi Terbatas jo SK BI No. 13/5/KEP.Dir/Pbs/2011.',
            ],
            [
                'year'    => '2024',
                'number'  => 'Akta Notaris PKR No. 03 Tanggal 21 Juni 2024',
                'notaris' => 'Notaris Pembuat Akta Resmi',
                'sk'      => 'SK Kementerian Hukum No. AHU-0041765.AH.01.02.Tahun 2024',
                'desc'    => 'Pernyataan Keputusan Rapat (PKR) tentang Anggaran Dasar BPRS Wakalumi.',
            ],
            [
                'year'    => '2024',
                'number'  => 'Akta Notaris PKR No. 02 Tanggal 20 November 2024',
                'notaris' => 'Notaris Pembuat Akta Resmi',
                'sk'      => 'SK Kementerian Hukum No. AHU-01.03-0214138 & AHU.AHA.01.09-0279901',
                'desc'    => 'Penyesuaian Anggaran Dasar BPRS Wakalumi.',
            ],
            [
                'year'    => '2025',
                'number'  => 'Akta Notaris PKR No. 02 Tanggal 05 Mei 2025',
                'notaris' => 'Notaris Pembuat Akta Resmi',
                'sk'      => 'Penerimaan Pemberitahuan Perubahan Anggaran Dasar Kemenkumham RI',
                'desc'    => 'Pembaruan terkini Anggaran Dasar PT BPRS Wakalumi.',
            ],
        ];
    }

    $cta_title     = get_option( 'options_legal_cta_title', 'Perlu Verifikasi Legalitas atau Salinan Dokumen Resmi?' );
    $cta_desc      = get_option( 'options_legal_cta_desc', 'Tim kepatuhan dan sekretariat korporasi BPRS Wakalumi siap melayani kebutuhan verifikasi hukum, kemitraan institusi, dan kepatuhan syariah Anda.' );
    $cta_btn1_text = get_option( 'options_legal_cta_btn1_text', 'Hubungi Sekretariat via WhatsApp' );
    $cta_btn1_url  = get_option( 'options_legal_cta_btn1_url', '' );
    $cta_btn2_text = get_option( 'options_legal_cta_btn2_text', 'Lihat Susunan Pengurus' );
    $cta_btn2_url  = get_option( 'options_legal_cta_btn2_url', home_url( '/profil/susunan-pengurus' ) );

    $wa_number     = get_option( 'options_contact_wa', '6281517380388' );
    if ( empty( $cta_btn1_url ) ) {
        $cta_btn1_url = 'https://wa.me/' . preg_replace( '/[^0-9]/', '', $wa_number );
    }
    ?>
    <div class="wrap" style="max-width: 980px; margin-top: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0;">
                    📜 Pengaturan Halaman: Legalitas Perusahaan
                </h1>
                <p style="color: #64748b; margin: 5px 0 0 0; font-size: 13px;">
                    Kelola nomor NIB, NPWP, NPWZ, izin SK Menteri Keuangan, SK Bank Indonesia, serta riwayat akta notaris resmi.
                </p>
            </div>
            <a href="<?php echo esc_url( home_url( '/profil/legalitas' ) ); ?>" target="_blank" class="button button-secondary" style="display: inline-flex; align-items: center; gap: 5px;">
                <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px;"></span> Lihat Halaman Live
            </a>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field( 'wakalumi_legalitas_nonce' ); ?>

            <!-- ── SECTION 1: HEADER BANNER ────────────────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-welcome-widgets-menus"></span> 1. Banner Judul & Header Halaman
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_legal_page_badge">Kicker / Badge Kecil</label></th>
                        <td>
                            <input type="text" id="options_legal_page_badge" name="options_legal_page_badge" value="<?php echo esc_attr( $page_badge ); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_page_title">Judul Utama Halaman</label></th>
                        <td>
                            <input type="text" id="options_legal_page_title" name="options_legal_page_title" value="<?php echo esc_attr( $page_title ); ?>" class="large-text" style="font-size: 16px; font-weight: bold;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_page_subtitle">Deskripsi Sub-Judul</label></th>
                        <td>
                            <textarea id="options_legal_page_subtitle" name="options_legal_page_subtitle" rows="2" class="large-text"><?php echo esc_textarea( $page_subtitle ); ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── SECTION 2: IDENTITAS & REGISTRASI FISKAL ────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-id"></span> 2. Entitas Badan Usaha & Registrasi Fiskal
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_legal_company_name">Nama Resmi Perusahaan</label></th>
                        <td>
                            <input type="text" id="options_legal_company_name" name="options_legal_company_name" value="<?php echo esc_attr( $company_name ); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_founder">Yayasan Pendiri</label></th>
                        <td>
                            <input type="text" id="options_legal_founder" name="options_legal_founder" value="<?php echo esc_attr( $founder ); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_nib">Nomor Induk Berusaha (NIB)</label></th>
                        <td>
                            <input type="text" id="options_legal_nib" name="options_legal_nib" value="<?php echo esc_attr( $nib ); ?>" class="regular-text" style="font-family: monospace; font-size: 15px; font-weight: bold;">
                            <p class="description">Perizinan berusaha berbasis risiko dari Kementerian Investasi / BKPM RI.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_npwp">Nomor Pokok Wajib Pajak (NPWP)</label></th>
                        <td>
                            <input type="text" id="options_legal_npwp" name="options_legal_npwp" value="<?php echo esc_attr( $npwp ); ?>" class="regular-text" style="font-family: monospace; font-size: 15px; font-weight: bold;">
                            <p class="description">Nomor registrasi wajib pajak badan pada Ditjen Pajak RI.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_npwz">Nomor Pokok Wajib Zakat (NPWZ)</label></th>
                        <td>
                            <input type="text" id="options_legal_npwz" name="options_legal_npwz" value="<?php echo esc_attr( $npwz ); ?>" class="regular-text" style="font-family: monospace; font-size: 15px; font-weight: bold;">
                            <p class="description">Nomor registrasi kepatuhan zakat perusahaan syariah.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── SECTION 3: IZIN USAHA PERBANKAN ────────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-shield"></span> 3. Izin Operasional Perbankan & Kantor Pusat
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_legal_sk_menkeu">SK Menteri Keuangan RI</label></th>
                        <td>
                            <input type="text" id="options_legal_sk_menkeu" name="options_legal_sk_menkeu" value="<?php echo esc_attr( $sk_menkeu ); ?>" class="large-text">
                            <p class="description">Surat Keputusan Menteri Keuangan RI izin operasional BPR Syariah.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_sk_bi">SK Bank Indonesia</label></th>
                        <td>
                            <input type="text" id="options_legal_sk_bi" name="options_legal_sk_bi" value="<?php echo esc_attr( $sk_bi ); ?>" class="large-text">
                            <p class="description">Surat Keputusan Bank Indonesia terkait kelembagaan perbankan syariah.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_head_office">Alamat Kantor Pusat</label></th>
                        <td>
                            <textarea id="options_legal_head_office" name="options_legal_head_office" rows="2" class="large-text"><?php echo esc_textarea( $head_office ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_phone">Telepon & Fax Resmi</label></th>
                        <td>
                            <input type="text" id="options_legal_phone" name="options_legal_phone" value="<?php echo esc_attr( $phone ); ?>" class="large-text">
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── SECTION 4: REPEATER AKTA NOTARIS ───────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-book"></span> 4. Rekam Jejak Akta Notaris & Perubahan Anggaran Dasar
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 15px;">
                    Daftar akta pendirian dan akta perubahan anggaran dasar PT BPRS Wakalumi yang telah disahkan oleh Kementerian Hukum & HAM RI.
                </p>

                <table class="widefat fixed striped" style="border-radius: 6px; overflow: hidden; margin-bottom: 15px;">
                    <thead>
                        <tr>
                            <th style="width: 70px; text-align: center;">Tahun</th>
                            <th style="width: 250px;">Nomor & Tanggal Akta</th>
                            <th style="width: 200px;">Notaris</th>
                            <th>Pengesahan SK Kemenkumham / Keterangan</th>
                            <th style="width: 70px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="legal-aktas-tbody">
                        <?php foreach ( $aktas as $a_idx => $akta ) : ?>
                            <tr>
                                <td style="vertical-align: top; padding-top: 10px; text-align: center;">
                                    <input type="text" name="legal_akta_year[]" value="<?php echo esc_attr( $akta['year'] ?? '' ); ?>" style="width: 60px; text-align: center; font-weight: bold; color: #088395;">
                                </td>
                                <td style="vertical-align: top; padding-top: 10px;">
                                    <input type="text" name="legal_akta_number[]" value="<?php echo esc_attr( $akta['number'] ?? '' ); ?>" class="large-text" style="font-weight: 600;" placeholder="Nama & No. Akta">
                                    <input type="text" name="legal_akta_desc[]" value="<?php echo esc_attr( $akta['desc'] ?? '' ); ?>" class="large-text" style="margin-top: 4px; font-size: 12px;" placeholder="Uraian ringkas">
                                </td>
                                <td style="vertical-align: top; padding-top: 10px;">
                                    <input type="text" name="legal_akta_notaris[]" value="<?php echo esc_attr( $akta['notaris'] ?? '' ); ?>" class="large-text" placeholder="Nama Notaris">
                                </td>
                                <td style="vertical-align: top; padding-top: 10px;">
                                    <textarea name="legal_akta_sk[]" rows="2" class="large-text" placeholder="Nomor SK Pengesahan"><?php echo esc_textarea( $akta['sk'] ?? '' ); ?></textarea>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <button type="button" class="button button-link-delete wkl-del-row" style="color: #ef4444;" title="Hapus baris ini">✕ Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" id="btn-add-akta" class="button" style="display: inline-flex; align-items: center; gap: 5px;">
                    <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> + Tambah Akta Notaris
                </button>
            </div>

            <!-- ── SECTION 5: CTA BANNER ──────────────────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-megaphone"></span> 5. Banner Hubungi & Verifikasi (CTA Bawah)
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_legal_cta_title">Judul Ajakan</label></th>
                        <td>
                            <input type="text" id="options_legal_cta_title" name="options_legal_cta_title" value="<?php echo esc_attr( $cta_title ); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_legal_cta_desc">Uraian Keterangan</label></th>
                        <td>
                            <textarea id="options_legal_cta_desc" name="options_legal_cta_desc" rows="2" class="large-text"><?php echo esc_textarea( $cta_desc ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tombol WhatsApp</th>
                        <td>
                            <input type="text" name="options_legal_cta_btn1_text" value="<?php echo esc_attr( $cta_btn1_text ); ?>" class="regular-text" placeholder="Teks Tombol">
                            <input type="text" name="options_legal_cta_btn1_url" value="<?php echo esc_attr( $cta_btn1_url ); ?>" class="regular-text" placeholder="URL WhatsApp (kosongkan untuk default)">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tombol Sekunder</th>
                        <td>
                            <input type="text" name="options_legal_cta_btn2_text" value="<?php echo esc_attr( $cta_btn2_text ); ?>" class="regular-text" placeholder="Teks Tombol">
                            <input type="text" name="options_legal_cta_btn2_url" value="<?php echo esc_attr( $cta_btn2_url ); ?>" class="regular-text" placeholder="URL Tombol (contoh: /profil/susunan-pengurus)">
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Submit Button Fixed Bottom -->
            <div style="position: sticky; bottom: 20px; background: #0f172a; padding: 15px 25px; border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: space-between; z-index: 50;">
                <span style="color: #94a3b8; font-size: 13px;">Pastikan seluruh nomor registrasi dan akta telah diverifikasi sesuai salinan resmi.</span>
                <button type="submit" name="wakalumi_save_legalitas" class="button button-primary button-large" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 25px;">
                    💾 Simpan Perubahan Legalitas
                </button>
            </div>
        </form>
    </div>

    <!-- Script Dynamic Add/Delete Row -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnAddAkta = document.getElementById('btn-add-akta');
        var tbodyAkta  = document.getElementById('legal-aktas-tbody');

        if (btnAddAkta && tbodyAkta) {
            btnAddAkta.addEventListener('click', function() {
                var tr = document.createElement('tr');
                tr.innerHTML = `
                    <td style="vertical-align: top; padding-top: 10px; text-align: center;">
                        <input type="text" name="legal_akta_year[]" value="<?php echo date('Y'); ?>" style="width: 60px; text-align: center; font-weight: bold; color: #088395;">
                    </td>
                    <td style="vertical-align: top; padding-top: 10px;">
                        <input type="text" name="legal_akta_number[]" value="" class="large-text" style="font-weight: 600;" placeholder="Nama & No. Akta">
                        <input type="text" name="legal_akta_desc[]" value="" class="large-text" style="margin-top: 4px; font-size: 12px;" placeholder="Uraian ringkas">
                    </td>
                    <td style="vertical-align: top; padding-top: 10px;">
                        <input type="text" name="legal_akta_notaris[]" value="" class="large-text" placeholder="Nama Notaris">
                    </td>
                    <td style="vertical-align: top; padding-top: 10px;">
                        <textarea name="legal_akta_sk[]" rows="2" class="large-text" placeholder="Nomor SK Pengesahan"></textarea>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button type="button" class="button button-link-delete wkl-del-row" style="color: #ef4444;" title="Hapus baris ini">✕ Hapus</button>
                    </td>
                `;
                tbodyAkta.appendChild(tr);
            });
        }

        // Global row delete
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('wkl-del-row')) {
                var row = e.target.closest('tr');
                if (row) {
                    row.remove();
                }
            }
        });
    });
    </script>
    <?php
}

