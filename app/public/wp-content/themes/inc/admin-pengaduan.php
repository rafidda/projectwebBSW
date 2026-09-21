<?php
/**
 * Modul Admin: Pengaturan Layanan Pengaduan Konsumen
 * Berpedoman pada POJK No. 22 Tahun 2023 & POJK No. 6/POJK.07/2022
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ── 1. REGISTRASI MENU ADMIN ────────────────────────────────────────

add_action( 'admin_menu', 'wakalumi_register_pengaduan_page', 26 );
function wakalumi_register_pengaduan_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Layanan Pengaduan Konsumen',
        'Layanan Pengaduan',
        'manage_options',
        'wakalumi-pengaduan',
        'wakalumi_render_pengaduan_page'
    );
}

// ── 2. HELPER GET DATA PENGADUAN ───────────────────────────────────

if ( ! function_exists( 'wakalumi_get_pengaduan_settings' ) ) {
    function wakalumi_get_pengaduan_settings() {
        $default_wa = get_option( 'options_contact_wa', '6281517380388' );
        $default_phone = get_option( 'options_contact_phone', '(021) 7471 4555' );
        $default_email = get_option( 'options_contact_email', 'sekretariat@wakalumibprs.co.id' );

        return [
            // Header
            'badge'         => get_option( 'options_pengaduan_badge', 'Perlindungan Konsumen & Regulasi OJK' ),
            'title'         => get_option( 'options_pengaduan_title', 'Layanan Pengaduan Konsumen' ),
            'subtitle'      => get_option( 'options_pengaduan_subtitle', 'Komitmen BPRS Wakalumi dalam mendengarkan, melayani, dan menindaklanjuti setiap aspirasi serta pengaduan nasabah secara adil, transparan, dan profesional sesuai POJK No. 22 Tahun 2023.' ),
            'disclaimer'    => get_option( 'options_pengaduan_disclaimer', 'BPRS Wakalumi Berizin dan Diawasi oleh Otoritas Jasa Keuangan (OJK) serta merupakan peserta penjaminan Lembaga Penjamin Simpanan (LPS).' ),
            
            // Pengaturan Visibilitas Seksi Halaman
            'alur_show'     => (bool) get_option( 'options_pengaduan_alur_show', 1 ),
            'sla_show'      => (bool) get_option( 'options_pengaduan_sla_show', 1 ),
            'panduan_show'  => (bool) get_option( 'options_pengaduan_panduan_show', 1 ),
            'show_form_pdf' => (bool) get_option( 'options_pengaduan_show_form_pdf', 0 ),

            // Saluran Pengaduan Internal Bank
            'wa'            => get_option( 'options_pengaduan_wa', $default_wa ),
            'phone'         => get_option( 'options_pengaduan_phone', $default_phone ),
            'email'         => get_option( 'options_pengaduan_email', 'pengaduan@wakalumibprs.co.id' ),
            'hours'         => get_option( 'options_pengaduan_hours', 'Senin – Jumat: 08.00 – 15.00 WIB (Kecuali Hari Libur Nasional)' ),
            'location_desc' => get_option( 'options_pengaduan_location_desc', 'Kantor Pusat & Seluruh Jaringan Kantor Kas BPRS Wakalumi' ),
            
            // Saluran Eksternal Regulator (OJK & LAPS SJK)
            'ojk_appk_url'  => get_option( 'options_pengaduan_ojk_appk_url', 'https://kontak157.ojk.go.id' ),
            'ojk_phone'     => get_option( 'options_pengaduan_ojk_phone', '157' ),
            'ojk_wa'        => get_option( 'options_pengaduan_ojk_wa', '081 157 157 157' ),
            'ojk_email'     => get_option( 'options_pengaduan_ojk_email', 'konsumen@ojk.go.id' ),
            'laps_url'      => get_option( 'options_pengaduan_laps_url', 'https://lapssjk.id' ),

            // Standar Waktu Resmi (SLA)
            'sla_lisan'     => get_option( 'options_pengaduan_sla_lisan', '5 Hari Kerja' ),
            'sla_tertulis'  => get_option( 'options_pengaduan_sla_tertulis', '10 Hari Kerja' ),
            'sla_note'      => get_option( 'options_pengaduan_sla_note', 'Dapat diperpanjang paling lama 10 (sepuluh) hari kerja dalam kondisi tertentu sesuai ketentuan POJK No. 22 Tahun 2023 Pasal 57.' ),

            // Berkas Formulir PDF Fisik
            'form_pdf_url'  => get_option( 'options_pengaduan_form_pdf_url', '' ),

            // Pratinjau Halaman Utama (Beranda)
            'home_badge'    => get_option( 'options_pengaduan_home_badge', 'Kepatuhan Regulasi POJK No. 22/2023' ),
            'home_title'    => get_option( 'options_pengaduan_home_title', 'Layanan Pengaduan & Pelindungan Nasabah' ),
            'home_desc'     => get_option( 'options_pengaduan_home_desc', 'BPRS Wakalumi berkomitmen memberikan kepastian dan keadilan bagi setiap nasabah. Sesuai regulasi OJK, mekanisme penanganan pengaduan kami transparan, bebas biaya (gratis), serta menjamin kerahasiaan informasi dengan batas waktu penyelesaian yang terukur.' ),
            'home_btn_text' => get_option( 'options_pengaduan_home_btn_text', 'Pelajari Prosedur & Ajukan Pengaduan' ),
        ];
    }
}

// ── 3. RENDER HALAMAN ADMIN ────────────────────────────────────────

function wakalumi_render_pengaduan_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( esc_html__( 'Anda tidak memiliki izin untuk mengakses halaman ini.', 'wakalumi' ) );
    }

    wp_enqueue_media();
    $message = '';

    // Proses Simpan Data
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer( 'wakalumi_pengaduan_action', 'wakalumi_pengaduan_nonce' ) ) {
        update_option( 'options_pengaduan_badge', sanitize_text_field( $_POST['options_pengaduan_badge'] ?? '' ) );
        update_option( 'options_pengaduan_title', sanitize_text_field( $_POST['options_pengaduan_title'] ?? '' ) );
        update_option( 'options_pengaduan_subtitle', sanitize_textarea_field( $_POST['options_pengaduan_subtitle'] ?? '' ) );
        update_option( 'options_pengaduan_disclaimer', sanitize_textarea_field( $_POST['options_pengaduan_disclaimer'] ?? '' ) );

        update_option( 'options_pengaduan_wa', sanitize_text_field( $_POST['options_pengaduan_wa'] ?? '' ) );
        update_option( 'options_pengaduan_phone', sanitize_text_field( $_POST['options_pengaduan_phone'] ?? '' ) );
        update_option( 'options_pengaduan_email', sanitize_email( $_POST['options_pengaduan_email'] ?? '' ) );
        update_option( 'options_pengaduan_hours', sanitize_text_field( $_POST['options_pengaduan_hours'] ?? '' ) );
        update_option( 'options_pengaduan_location_desc', sanitize_text_field( $_POST['options_pengaduan_location_desc'] ?? '' ) );

        update_option( 'options_pengaduan_ojk_appk_url', esc_url_raw( $_POST['options_pengaduan_ojk_appk_url'] ?? '' ) );
        update_option( 'options_pengaduan_ojk_phone', sanitize_text_field( $_POST['options_pengaduan_ojk_phone'] ?? '' ) );
        update_option( 'options_pengaduan_ojk_wa', sanitize_text_field( $_POST['options_pengaduan_ojk_wa'] ?? '' ) );
        update_option( 'options_pengaduan_ojk_email', sanitize_email( $_POST['options_pengaduan_ojk_email'] ?? '' ) );
        update_option( 'options_pengaduan_laps_url', esc_url_raw( $_POST['options_pengaduan_laps_url'] ?? '' ) );

        update_option( 'options_pengaduan_alur_show', isset( $_POST['options_pengaduan_alur_show'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_sla_show', isset( $_POST['options_pengaduan_sla_show'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_panduan_show', isset( $_POST['options_pengaduan_panduan_show'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_sla_lisan', sanitize_text_field( $_POST['options_pengaduan_sla_lisan'] ?? '' ) );
        update_option( 'options_pengaduan_sla_tertulis', sanitize_text_field( $_POST['options_pengaduan_sla_tertulis'] ?? '' ) );
        update_option( 'options_pengaduan_sla_note', sanitize_textarea_field( $_POST['options_pengaduan_sla_note'] ?? '' ) );

        update_option( 'options_pengaduan_show_form_pdf', isset( $_POST['options_pengaduan_show_form_pdf'] ) ? 1 : 0 );
        update_option( 'options_pengaduan_form_pdf_url', esc_url_raw( $_POST['options_pengaduan_form_pdf_url'] ?? '' ) );

        // Pengaturan Pratinjau Beranda
        update_option( 'options_pengaduan_home_badge', sanitize_text_field( $_POST['options_pengaduan_home_badge'] ?? '' ) );
        update_option( 'options_pengaduan_home_title', sanitize_text_field( $_POST['options_pengaduan_home_title'] ?? '' ) );
        update_option( 'options_pengaduan_home_desc', sanitize_textarea_field( $_POST['options_pengaduan_home_desc'] ?? '' ) );
        update_option( 'options_pengaduan_home_btn_text', sanitize_text_field( $_POST['options_pengaduan_home_btn_text'] ?? '' ) );

        $message = '✅ Pengaturan Layanan Pengaduan Konsumen berhasil disimpan!';
    }

    $cfg = wakalumi_get_pengaduan_settings();
    ?>
    <div class="wrap" style="max-width: 980px; margin-top: 20px;">
        <div style="background: linear-gradient(135deg, #088395 0%, #0a4d68 100%); color: #fff; padding: 24px 30px; border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 14px rgba(8, 131, 149, 0.2);">
            <div style="display: flex; align-items: center; gap: 14px;">
                <span style="font-size: 32px; line-height: 1;">🛡️</span>
                <div>
                    <h1 style="color: #fff; margin: 0; font-size: 22px; font-weight: 800;">Pengelolaan Layanan Pengaduan Konsumen</h1>
                    <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 13px;">
                        Atur visibilitas seksi halaman, saluran aduan nasabah ke BPRS Wakalumi, portal resmi APPK OJK 157, SLA waktu penyelesaian, dan berkas formulir.
                    </p>
                </div>
            </div>
        </div>

        <?php if ( ! empty( $message ) ) : ?>
            <div class="notice notice-success is-dismissible" style="border-radius: 8px; font-weight: 600;">
                <p><?php echo esc_html( $message ); ?></p>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <?php wp_nonce_field( 'wakalumi_pengaduan_action', 'wakalumi_pengaduan_nonce' ); ?>

            <!-- KARTU 0: PENGATURAN VISIBILITAS SEKSI HALAMAN -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #475569; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #1e293b; margin: 0 0 8px 0; display: flex; align-items: center; gap: 8px;">
                    <span>⚙️</span> Visibilitas Seksi Halaman (Aktif / Nonaktif)
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 18px;">
                    Centang atau hapus centang untuk menampilkan atau menyembunyikan bagian halaman sesuai kebutuhan bank:
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <!-- Toggle Seksi Alur Prosedur -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_alur_show" value="1" <?php checked( $cfg['alur_show'] ); ?> style="width: 18px; height: 18px; margin-top: 2px; accent-color: #088395;">
                            <div>
                                <span style="font-size: 13px; font-weight: 700; color: #0f172a; display: block;">Seksi Alur Prosedur (4 Langkah)</span>
                                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">
                                    Tahapan penerimaan, verifikasi, investigasi, dan tanggapan resmi (POJK 22/2023).
                                </small>
                            </div>
                        </label>
                    </div>

                    <!-- Toggle Seksi SLA -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_sla_show" value="1" <?php checked( $cfg['sla_show'] ); ?> style="width: 18px; height: 18px; margin-top: 2px; accent-color: #d97706;">
                            <div>
                                <span style="font-size: 13px; font-weight: 700; color: #0f172a; display: block;">Seksi Standar Waktu Layanan (SLA)</span>
                                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">
                                    Batas waktu resmi pengaduan lisan (5 hari) & tertulis (10 hari kerja).
                                </small>
                            </div>
                        </label>
                    </div>

                    <!-- Toggle Seksi Panduan Dokumen -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_panduan_show" value="1" <?php checked( $cfg['panduan_show'] ); ?> style="width: 18px; height: 18px; margin-top: 2px; accent-color: #088395;">
                            <div>
                                <span style="font-size: 13px; font-weight: 700; color: #0f172a; display: block;">Seksi Panduan &amp; Checklist Dokumen</span>
                                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">
                                    Daftar berkas wajib (KTP, Rekening/Akad, Bukti Transaksi, Surat Kuasa).
                                </small>
                            </div>
                        </label>
                    </div>

                    <!-- Toggle Formulir PDF -->
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_show_form_pdf" value="1" <?php checked( $cfg['show_form_pdf'] ); ?> style="width: 18px; height: 18px; margin-top: 2px; accent-color: #2563eb;">
                            <div>
                                <span style="font-size: 13px; font-weight: 700; color: #0f172a; display: block;">Slot Unduh Formulir Fisik (PDF)</span>
                                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">
                                    Aktifkan jika berkas PDF formulir cetak sudah siap diunggah.
                                </small>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- KARTU 1: SALURAN PENGADUAN INTERNAL BPRS WAKALUMI -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #088395; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #088395; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>🏢</span> 1. Saluran Pengaduan Langsung ke BPRS Wakalumi
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: -10px; margin-bottom: 18px;">
                    Kontak resmi yang akan dihubungi nasabah saat mengklik tombol Call to Action (CTA) di halaman depan.
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Nomor WhatsApp Pengaduan (Format: 628xxx)</label>
                        <input type="text" name="options_pengaduan_wa" value="<?php echo esc_attr( $cfg['wa'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                        <small style="color: #64748b; font-size: 11px;">Akan membuka percakapan WhatsApp resmi dengan template pesan aduan otomatis.</small>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Hotline Telepon Pengaduan</label>
                        <input type="text" name="options_pengaduan_phone" value="<?php echo esc_attr( $cfg['phone'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                        <small style="color: #64748b; font-size: 11px;">Contoh: (021) 7471 4555</small>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Alamat Email Pengaduan Nasabah</label>
                        <input type="email" name="options_pengaduan_email" value="<?php echo esc_attr( $cfg['email'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;">
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Jam Operasional Penanganan Pengaduan</label>
                        <input type="text" name="options_pengaduan_hours" value="<?php echo esc_attr( $cfg['hours'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                    </div>
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Keterangan Lokasi Tatap Muka (Kantor)</label>
                    <input type="text" name="options_pengaduan_location_desc" value="<?php echo esc_attr( $cfg['location_desc'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>

            <!-- KARTU 2: SALURAN REGULATOR (PORTAL APPK OJK & LAPS SJK) -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #2563eb; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #2563eb; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>⚖️</span> 2. Saluran Resmi Regulator (OJK &amp; LAPS SJK)
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: -10px; margin-bottom: 18px;">
                    Tautan dan nomor kontak regulator resmi jika konsumen memilih opsi eskalasi atau ingin melapor melalui portal APPK OJK.
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">URL Portal APPK OJK</label>
                        <input type="url" name="options_pengaduan_ojk_appk_url" value="<?php echo esc_attr( $cfg['ojk_appk_url'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <small style="color: #64748b; font-size: 11px;">Default: https://kontak157.ojk.go.id</small>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Hotline Kontak OJK</label>
                        <input type="text" name="options_pengaduan_ojk_phone" value="<?php echo esc_attr( $cfg['ojk_phone'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <small style="color: #64748b; font-size: 11px;">Default: 157</small>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Nomor WhatsApp Kontak OJK</label>
                        <input type="text" name="options_pengaduan_ojk_wa" value="<?php echo esc_attr( $cfg['ojk_wa'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <small style="color: #64748b; font-size: 11px;">Default: 081 157 157 157</small>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">URL Resmi LAPS SJK</label>
                        <input type="url" name="options_pengaduan_laps_url" value="<?php echo esc_attr( $cfg['laps_url'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <small style="color: #64748b; font-size: 11px;">Default: https://lapssjk.id</small>
                    </div>
                </div>
            </div>

            <!-- KARTU 3: STANDAR WAKTU (SLA) & FORMULIR PDF -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #f59e0b; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #b45309; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>⏱️</span> 3. Standar Waktu Penyelesaian (SLA POJK) &amp; Berkas PDF
                </h2>

                <!-- Toggle Tampilkan SLA -->
                <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 12px 16px; margin-bottom: 18px;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" name="options_pengaduan_sla_show" value="1" <?php checked( $cfg['sla_show'] ); ?> style="width: 18px; height: 18px; accent-color: #d97706;">
                        <span style="font-size: 13px; font-weight: 700; color: #92400e;">Tampilkan Seksi Standar Waktu Layanan (SLA) di Halaman Depan</span>
                    </label>
                    <small style="color: #78350f; font-size: 11px; margin-left: 28px; display: block; margin-top: 2px;">
                        Centang untuk menampilkan kotak komitmen kepastian batas waktu penanganan pengaduan nasabah (POJK No. 22 Tahun 2023). Hapus centang jika ingin menyembunyikannya.
                    </small>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Batas Waktu Pengaduan Lisan</label>
                        <input type="text" name="options_pengaduan_sla_lisan" value="<?php echo esc_attr( $cfg['sla_lisan'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;" placeholder="5 Hari Kerja">
                        <small style="color: #64748b; font-size: 11px;">Cukup tuliskan durasi angka/hari, contoh: <strong>5 Hari Kerja</strong></small>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Batas Waktu Pengaduan Tertulis</label>
                        <input type="text" name="options_pengaduan_sla_tertulis" value="<?php echo esc_attr( $cfg['sla_tertulis'] ); ?>" class="regular-text" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: 600;" placeholder="10 Hari Kerja">
                        <small style="color: #64748b; font-size: 11px;">Cukup tuliskan durasi angka/hari, contoh: <strong>10 Hari Kerja</strong></small>
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Catatan Ketentuan Perpanjangan Waktu (POJK)</label>
                    <textarea name="options_pengaduan_sla_note" rows="2" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-size: 12px;"><?php echo esc_textarea( $cfg['sla_note'] ); ?></textarea>
                    <small style="color: #64748b; font-size: 11px;">Akan ditampilkan sebagai pita informasi hukum resmi di bawah kartu SLA.</small>
                </div>

                <!-- Toggle Tampilkan Berkas Cetak Fisik PDF -->
                <div style="border-top: 1px solid #e2e8f0; padding-top: 16px;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; margin-bottom: 14px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="options_pengaduan_show_form_pdf" value="1" <?php checked( $cfg['show_form_pdf'] ); ?> style="width: 18px; height: 18px; accent-color: #088395;">
                            <span style="font-size: 13px; font-weight: 700; color: #0f172a;">Tampilkan Kartu Unduh Formulir Pengaduan Cetak Fisik (PDF)</span>
                        </label>
                        <small style="color: #64748b; font-size: 11px; margin-left: 28px; display: block; margin-top: 2px;">
                            Saat ini dinonaktifkan secara default. Jika dimatikan, halaman depan akan menampilkan panduan berkas persyaratan secara penuh tanpa slot unduh formulir yang belum tersedia.
                        </small>
                    </div>

                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Unggah Berkas PDF Formulir Pengaduan Fisik (Aktif jika opsi di atas dicentang)</label>
                    <div style="display: flex; gap: 8px; align-items: center;">
                        <input type="text" id="wkl_form_pdf_url" name="options_pengaduan_form_pdf_url" value="<?php echo esc_attr( $cfg['form_pdf_url'] ); ?>" placeholder="https://.../formulir-pengaduan-nasabah.pdf" style="flex: 1; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <button type="button" class="button wkl-upload-pengaduan-pdf" data-target="#wkl_form_pdf_url" style="border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                            <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah Berkas PDF
                        </button>
                    </div>
                </div>
            </div>

            <!-- KARTU 4: HEADER & KETERANGAN UMUM -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #64748b; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #334155; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>📝</span> 4. Teks Header Banner &amp; Disclaimer
                </h2>

                <div style="margin-bottom: 14px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Kicker Badge Header</label>
                    <input type="text" name="options_pengaduan_badge" value="<?php echo esc_attr( $cfg['badge'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Judul Utama Halaman</label>
                    <input type="text" name="options_pengaduan_title" value="<?php echo esc_attr( $cfg['title'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Sub-judul / Penjelasan Singkat</label>
                    <textarea name="options_pengaduan_subtitle" rows="3" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"><?php echo esc_textarea( $cfg['subtitle'] ); ?></textarea>
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Pernyataan Regulasi OJK (Footer Card)</label>
                    <input type="text" name="options_pengaduan_disclaimer" value="<?php echo esc_attr( $cfg['disclaimer'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                </div>
            </div>

            <!-- KARTU 5: PENGATURAN PRATINJAU DI HALAMAN UTAMA (BERANDA) -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-top: 4px solid #0d9488; border-radius: 10px; padding: 22px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h2 style="font-size: 16px; font-weight: 800; color: #0d9488; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <span>🏠</span> 5. Kustomisasi Pratinjau di Halaman Utama (Beranda)
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: -10px; margin-bottom: 18px;">
                    Ubah teks judul, badge, deskripsi, dan tombol pada seksi pratinjau Layanan Pengaduan Konsumen yang tampil di Beranda (di atas CTA WhatsApp).
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 14px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Badge Regulasi Beranda</label>
                        <input type="text" name="options_pengaduan_home_badge" value="<?php echo esc_attr( $cfg['home_badge'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;">
                        <small style="color: #64748b; font-size: 11px;">Default: Kepatuhan Regulasi POJK No. 22/2023</small>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Teks Tombol Aksi Beranda</label>
                        <input type="text" name="options_pengaduan_home_btn_text" value="<?php echo esc_attr( $cfg['home_btn_text'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                        <small style="color: #64748b; font-size: 11px;">Default: Pelajari Prosedur &amp; Ajukan Pengaduan</small>
                    </div>
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Judul Seksi di Beranda</label>
                    <input type="text" name="options_pengaduan_home_title" value="<?php echo esc_attr( $cfg['home_title'] ); ?>" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1; font-weight: bold;">
                </div>

                <div>
                    <label style="font-size: 12px; font-weight: 700; color: #334155; display: block; margin-bottom: 5px;">Deskripsi Ringkas di Beranda</label>
                    <textarea name="options_pengaduan_home_desc" rows="3" style="width: 100%; border-radius: 6px; padding: 7px 10px; border: 1px solid #cbd5e1;"><?php echo esc_textarea( $cfg['home_desc'] ); ?></textarea>
                    <small style="color: #64748b; font-size: 11px;">Nilai SLA (5 Hari &amp; 10 Hari) serta saluran kontak akan otomatis tersinkronisasi dari Pengaturan Kartu 1 &amp; 3 di atas.</small>
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <div style="display: flex; justify-content: flex-end; padding-top: 10px;">
                <button type="submit" class="button button-primary" style="background: #088395; border-color: #088395; font-weight: bold; padding: 8px 30px; border-radius: 8px; font-size: 14px;">
                    💾 Simpan Semua Pengaturan
                </button>
            </div>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('.wkl-upload-pengaduan-pdf').on('click', function(e) {
            e.preventDefault();
            var targetInput = $(this).data('target');
            var frame = wp.media({
                title: 'Pilih Berkas Formulir Pengaduan (PDF)',
                button: { text: 'Gunakan Berkas Ini' },
                library: { type: 'application/pdf' },
                multiple: false
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $(targetInput).val(attachment.url);
            });
            frame.open();
        });
    });
    </script>
    <?php
}

