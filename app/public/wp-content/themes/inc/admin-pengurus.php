<?php
/**
 * Admin Page: Susunan Pengurus
 * Submenu of wakalumi-settings
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// 1. Register Menu
add_action( 'admin_menu', 'wakalumi_register_pengurus_page', 22 );
function wakalumi_register_pengurus_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Profil: Susunan Pengurus',
        'Profil: Pengurus',
        'manage_options',
        'wakalumi-pengurus',
        'wakalumi_render_pengurus_page',
        22
    );
}

// 2. Render Page & Handle Save
function wakalumi_render_pengurus_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $is_saved = false;

    // Save Logic
    if ( isset( $_POST['wakalumi_pengurus_submit'] ) && check_admin_referer( 'wakalumi_pengurus_save', 'wakalumi_pengurus_nonce' ) ) {
        
        // 1. Page Header Settings
        update_option( 'options_pengurus_page_badge', sanitize_text_field( wp_unslash( $_POST['options_pengurus_page_badge'] ?? '' ) ) );
        update_option( 'options_pengurus_page_title', sanitize_text_field( wp_unslash( $_POST['options_pengurus_page_title'] ?? '' ) ) );
        update_option( 'options_pengurus_page_subtitle', sanitize_textarea_field( wp_unslash( $_POST['options_pengurus_page_subtitle'] ?? '' ) ) );
        update_option( 'options_pengurus_page_intro', sanitize_textarea_field( wp_unslash( $_POST['options_pengurus_page_intro'] ?? '' ) ) );

        // 2. Board Members Repeater
        $names         = wp_unslash( $_POST['pengurus_list_nama'] ?? [] );
        $kategoris     = wp_unslash( $_POST['pengurus_list_kategori'] ?? [] );
        $jabatans      = wp_unslash( $_POST['pengurus_list_jabatan'] ?? [] );
        $fotos         = wp_unslash( $_POST['pengurus_list_foto'] ?? [] );
        $karirs        = wp_unslash( $_POST['pengurus_list_riwayat_karir'] ?? [] );
        $pendidikans   = wp_unslash( $_POST['pengurus_list_pendidikan'] ?? [] );
        $sertifikasis  = wp_unslash( $_POST['pengurus_list_sertifikasi'] ?? [] );
        $kutipans      = wp_unslash( $_POST['pengurus_list_kutipan'] ?? [] );
        $statuses      = wp_unslash( $_POST['pengurus_list_status'] ?? [] );
        $urutans       = wp_unslash( $_POST['pengurus_list_urutan'] ?? [] );

        $pengurus = [];
        for ( $i = 0; $i < count( $names ); $i++ ) {
            $nama = sanitize_text_field( $names[$i] ?? '' );
            if ( empty( $nama ) ) {
                continue;
            }
            $pengurus[] = [
                'nama'          => $nama,
                'kategori'      => sanitize_text_field( $kategoris[$i] ?? '' ),
                'jabatan'       => sanitize_text_field( $jabatans[$i] ?? '' ),
                'foto'          => esc_url_raw( $fotos[$i] ?? '' ),
                'riwayat_karir' => sanitize_textarea_field( $karirs[$i] ?? '' ),
                'pendidikan'    => sanitize_textarea_field( $pendidikans[$i] ?? '' ),
                'sertifikasi'   => sanitize_textarea_field( $sertifikasis[$i] ?? '' ),
                'kutipan'       => sanitize_text_field( $kutipans[$i] ?? '' ),
                'status'        => sanitize_text_field( $statuses[$i] ?? '' ),
                'urutan'        => intval( $urutans[$i] ?? 0 ),
            ];
        }
        
        // Sort by urutan before saving
        usort( $pengurus, function($a, $b) {
            return $a['urutan'] <=> $b['urutan'];
        });

        update_option( 'options_pengurus_list', $pengurus );

        // 3. Organization Chart
        $show_org = isset( $_POST['options_pengurus_orgchart_show'] ) ? '1' : '0';
        update_option( 'options_pengurus_orgchart_show', $show_org );
        update_option( 'options_pengurus_orgchart_image', esc_url_raw( wp_unslash( $_POST['options_pengurus_orgchart_image'] ?? '' ) ) );
        update_option( 'options_pengurus_orgchart_desc', sanitize_textarea_field( wp_unslash( $_POST['options_pengurus_orgchart_desc'] ?? '' ) ) );

        // 4. CTA Section
        $show_cta = isset( $_POST['options_pengurus_cta_show'] ) ? '1' : '0';
        update_option( 'options_pengurus_cta_show', $show_cta );
        update_option( 'options_pengurus_cta_badge', sanitize_text_field( wp_unslash( $_POST['options_pengurus_cta_badge'] ?? '' ) ) );
        update_option( 'options_pengurus_cta_title', sanitize_text_field( wp_unslash( $_POST['options_pengurus_cta_title'] ?? '' ) ) );
        update_option( 'options_pengurus_cta_desc', sanitize_textarea_field( wp_unslash( $_POST['options_pengurus_cta_desc'] ?? '' ) ) );
        update_option( 'options_pengurus_cta_btn1_text', sanitize_text_field( wp_unslash( $_POST['options_pengurus_cta_btn1_text'] ?? '' ) ) );
        update_option( 'options_pengurus_cta_btn1_url', esc_url_raw( wp_unslash( $_POST['options_pengurus_cta_btn1_url'] ?? '' ) ) );
        update_option( 'options_pengurus_cta_btn2_text', sanitize_text_field( wp_unslash( $_POST['options_pengurus_cta_btn2_text'] ?? '' ) ) );
        update_option( 'options_pengurus_cta_btn2_url', esc_url_raw( wp_unslash( $_POST['options_pengurus_cta_btn2_url'] ?? '' ) ) );

        $is_saved = true;
    }

    // Default pre-populated data for repeater
    $default_pengurus = array(
        array(
            'nama'          => 'H. Abdul Rokhim',
            'kategori'      => 'Dewan Pengawas Syariah',
            'jabatan'       => 'Ketua Dewan Pengawas Syariah',
            'foto'          => defined('WAKALUMI_URI') ? WAKALUMI_URI . '/assets/img/pengurus/dps-ketua.png' : '/assets/img/pengurus/dps-ketua.png',
            'riwayat_karir' => 'Berpengalaman lebih dari 20 tahun di bidang ekonomi syariah dan fatwa keuangan Islam. Aktif sebagai narasumber di berbagai forum perbankan syariah nasional dan pelatihan sertifikasi DPS yang diselenggarakan oleh DSN-MUI.',
            'pendidikan'    => 'S1 Syariah, Universitas Islam Negeri (UIN)',
            'sertifikasi'   => 'Sertifikasi Dewan Pengawas Syariah (DSN-MUI)',
            'kutipan'       => 'Menjaga kemurnian prinsip syariah adalah fondasi kepercayaan nasabah.',
            'status'        => 'Aktif',
            'urutan'        => 1
        ),
        array(
            'nama'          => 'Fathan Budiman',
            'kategori'      => 'Dewan Pengawas Syariah',
            'jabatan'       => 'Anggota Dewan Pengawas Syariah',
            'foto'          => defined('WAKALUMI_URI') ? WAKALUMI_URI . '/assets/img/pengurus/dps-anggota.png' : '/assets/img/pengurus/dps-anggota.png',
            'riwayat_karir' => 'Memiliki keahlian mendalam dalam fikih muamalah dan hukum ekonomi syariah. Berkontribusi aktif dalam pengembangan produk-produk keuangan syariah yang inovatif dan sesuai fatwa DSN-MUI.',
            'pendidikan'    => 'S1 Hukum Ekonomi Syariah',
            'sertifikasi'   => 'Sertifikasi Dewan Pengawas Syariah (DSN-MUI)',
            'kutipan'       => 'Inovasi keuangan harus tetap berpijak pada kaidah syariah yang kokoh.',
            'status'        => 'Aktif',
            'urutan'        => 2
        ),
        array(
            'nama'          => 'H. Rudi Dogar Harahap',
            'kategori'      => 'Dewan Komisaris',
            'jabatan'       => 'Komisaris Utama',
            'foto'          => defined('WAKALUMI_URI') ? WAKALUMI_URI . '/assets/img/pengurus/komisaris-utama.png' : '/assets/img/pengurus/komisaris-utama.png',
            'riwayat_karir' => 'Profesional perbankan dengan pengalaman luas di industri keuangan dan perbankan. Memiliki rekam jejak kepemimpinan strategis dalam pengawasan tata kelola perusahaan perbankan syariah yang sehat dan berkelanjutan.',
            'pendidikan'    => 'S1 Ekonomi & Manajemen',
            'sertifikasi'   => 'Sertifikasi Komisaris BPR/BPRS (OJK), Manajemen Risiko Perbankan',
            'kutipan'       => 'Tata kelola yang baik adalah kunci pertumbuhan berkelanjutan.',
            'status'        => 'Aktif',
            'urutan'        => 3
        ),
        array(
            'nama'          => 'Arief Rachmat Dian Boediono',
            'kategori'      => 'Dewan Komisaris',
            'jabatan'       => 'Komisaris',
            'foto'          => defined('WAKALUMI_URI') ? WAKALUMI_URI . '/assets/img/pengurus/komisaris.png' : '/assets/img/pengurus/komisaris.png',
            'riwayat_karir' => 'Berpengalaman di bidang keuangan korporasi dan pengawasan kepatuhan. Berperan aktif dalam memastikan implementasi prinsip kehati-hatian dan kepatuhan regulasi OJK di lingkungan BPRS Wakalumi.',
            'pendidikan'    => 'S1 Manajemen Keuangan',
            'sertifikasi'   => 'Sertifikasi Komisaris BPR/BPRS (OJK)',
            'kutipan'       => 'Kepatuhan dan kehati-hatian adalah pilar kepercayaan.',
            'status'        => 'Aktif',
            'urutan'        => 4
        )
    );

    // Fetch existing values
    $page_badge     = get_option( 'options_pengurus_page_badge', 'Susunan Pengurus' );
    $page_title     = get_option( 'options_pengurus_page_title', 'Jajaran Kepemimpinan BPRS Wakalumi' );
    $page_subtitle  = get_option( 'options_pengurus_page_subtitle', 'Dipimpin oleh para profesional berpengalaman yang berkomitmen pada prinsip perbankan syariah, tata kelola yang baik (GCG), dan pelayanan terbaik bagi nasabah.' );
    $page_intro     = get_option( 'options_pengurus_page_intro', 'BPRS Wakalumi berkomitmen menerapkan Tata Kelola Perusahaan yang Baik (Good Corporate Governance) dalam setiap aspek bisnis. Susunan pengurus kami mencerminkan integritas, profesionalisme, dan keahlian di bidang keuangan syariah.' );

    $pengurus_list  = get_option( 'options_pengurus_list', false );
    if ( $pengurus_list === false || ! is_array( $pengurus_list ) || empty( $pengurus_list ) ) {
        $pengurus_list = $default_pengurus;
        update_option( 'options_pengurus_list', $pengurus_list );
    }

    $org_show       = get_option( 'options_pengurus_orgchart_show', '1' );
    $org_img        = get_option( 'options_pengurus_orgchart_image', '' );
    $org_desc       = get_option( 'options_pengurus_orgchart_desc', '' );

    $cta_show       = get_option( 'options_pengurus_cta_show', '1' );
    $cta_badge      = get_option( 'options_pengurus_cta_badge', 'Bergabung Bersama Kami' );
    $cta_title      = get_option( 'options_pengurus_cta_title', 'Siap Mempercayakan Dana Anda pada Kepemimpinan Profesional Syariah?' );
    $cta_desc       = get_option( 'options_pengurus_cta_desc', '' );
    $cta_btn1_text  = get_option( 'options_pengurus_cta_btn1_text', 'Hubungi via WhatsApp' );
    $cta_btn1_url   = get_option( 'options_pengurus_cta_btn1_url', '' );
    $cta_btn2_text  = get_option( 'options_pengurus_cta_btn2_text', 'Jelajahi Produk Kami' );
    $cta_btn2_url   = get_option( 'options_pengurus_cta_btn2_url', '' );

    // Enqueue WP Media
    wp_enqueue_media();
    ?>
    <div class="wrap" style="max-width: 900px; margin-top: 20px;">
        <h1 style="color: #088395; margin-bottom: 20px; font-weight: bold;">Profil: Susunan Pengurus</h1>

        <?php if ( $is_saved ) : ?>
            <div class="notice notice-success is-dismissible">
                <p>✅ Data pengurus berhasil disimpan!</p>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <?php wp_nonce_field( 'wakalumi_pengurus_save', 'wakalumi_pengurus_nonce' ); ?>

            <!-- SECTION 1: Page Header -->
            <div class="postbox" style="background: #fff; border-radius: 8px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px;">
                <h2 style="border-bottom: 1px solid #eee; padding: 15px; margin: 0; color: #088395; font-size: 16px;">📰 Pengaturan Header Halaman</h2>
                <div class="inside" style="padding: 20px;">
                    <table class="form-table" role="presentation">
                        <tr>
                            <th scope="row"><label for="options_pengurus_page_badge">Badge Halaman</label></th>
                            <td>
                                <input type="text" id="options_pengurus_page_badge" name="options_pengurus_page_badge" value="<?php echo esc_attr( $page_badge ); ?>" class="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_pengurus_page_title">Judul Halaman</label></th>
                            <td>
                                <input type="text" id="options_pengurus_page_title" name="options_pengurus_page_title" value="<?php echo esc_attr( $page_title ); ?>" class="large-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_pengurus_page_subtitle">Subjudul</label></th>
                            <td>
                                <textarea id="options_pengurus_page_subtitle" name="options_pengurus_page_subtitle" rows="3" class="large-text"><?php echo esc_textarea( $page_subtitle ); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_pengurus_page_intro">Teks Intro (Komitmen GCG)</label></th>
                            <td>
                                <textarea id="options_pengurus_page_intro" name="options_pengurus_page_intro" rows="4" class="large-text"><?php echo esc_textarea( $page_intro ); ?></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- SECTION 2: Board Members Repeater -->
            <div class="postbox" style="background: #fff; border-radius: 8px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px;">
                <h2 style="border-bottom: 1px solid #eee; padding: 15px; margin: 0; color: #088395; font-size: 16px;">👥 Daftar Pengurus</h2>
                <div class="inside" style="padding: 20px;">
                    
                    <div id="wakalumi_pengurus_repeater">
                        <?php 
                        $counter = 0;
                        foreach ( $pengurus_list as $member ) : 
                            $m_nama        = $member['nama'] ?? '';
                            $m_kategori    = $member['kategori'] ?? 'Dewan Pengawas Syariah';
                            $m_jabatan     = $member['jabatan'] ?? '';
                            $m_foto        = $member['foto'] ?? '';
                            $m_karir       = $member['riwayat_karir'] ?? '';
                            $m_pendidikan  = $member['pendidikan'] ?? '';
                            $m_sertifikasi = $member['sertifikasi'] ?? '';
                            $m_kutipan     = $member['kutipan'] ?? '';
                            $m_status      = $member['status'] ?? 'Aktif';
                            $m_urutan      = $member['urutan'] ?? $counter + 1;
                        ?>
                        <div class="pengurus-card" style="border-left: 4px solid #088395; background: #fff; border-radius: 8px; border-top: 1px solid #ccd0d4; border-right: 1px solid #ccd0d4; border-bottom: 1px solid #ccd0d4; padding: 20px; margin-bottom: 20px; display: flex; gap: 20px; position: relative;">
                            
                            <button type="button" class="wkl-delete-member" style="position: absolute; top: 15px; right: 15px; background: none; border: none; color: #ef4444; font-size: 20px; cursor: pointer; font-weight: bold;" title="Hapus Pengurus">✕</button>

                            <!-- Left: Photo -->
                            <div style="flex: 0 0 200px; display: flex; flex-direction: column; gap: 10px;">
                                <label style="font-weight: bold;">Foto Profil</label>
                                <div class="wkl-upload-wrap" style="display: flex; flex-direction: column; align-items: flex-start; gap: 12px;">
                                    <img id="pengurus_foto_preview_<?php echo $counter; ?>" src="<?php echo esc_url($m_foto); ?>" style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #088395; object-fit: cover; <?php echo empty($m_foto) ? 'display:none;' : ''; ?>" />
                                    <div style="display: flex; flex-direction: column; gap: 6px;">
                                        <button type="button" class="button wkl-upload-btn" data-target="pengurus_foto_input_<?php echo $counter; ?>" data-preview="pengurus_foto_preview_<?php echo $counter; ?>">
                                            <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Foto
                                        </button>
                                        <button type="button" class="button-link wkl-remove-btn" data-target="pengurus_foto_input_<?php echo $counter; ?>" data-preview="pengurus_foto_preview_<?php echo $counter; ?>" style="color: #ef4444; font-size: 12px; <?php echo empty($m_foto) ? 'display:none;' : ''; ?>">
                                            ✕ Hapus Foto
                                        </button>
                                    </div>
                                    <input type="hidden" id="pengurus_foto_input_<?php echo $counter; ?>" name="pengurus_list_foto[]" value="<?php echo esc_attr($m_foto); ?>" class="regular-text">
                                </div>
                            </div>

                            <!-- Right: Fields -->
                            <div style="flex: 1; display: flex; flex-direction: column; gap: 15px;">
                                <div style="display: flex; gap: 15px;">
                                    <div style="flex: 1;">
                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Lengkap (dengan Gelar)</label>
                                        <input type="text" name="pengurus_list_nama[]" value="<?php echo esc_attr( $m_nama ); ?>" class="large-text" required>
                                    </div>
                                    <div style="flex: 1;">
                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Kategori</label>
                                        <select name="pengurus_list_kategori[]" class="large-text">
                                            <option value="Dewan Pengawas Syariah" <?php selected($m_kategori, 'Dewan Pengawas Syariah'); ?>>Dewan Pengawas Syariah</option>
                                            <option value="Dewan Komisaris" <?php selected($m_kategori, 'Dewan Komisaris'); ?>>Dewan Komisaris</option>
                                            <option value="Direksi" <?php selected($m_kategori, 'Direksi'); ?>>Direksi</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Jabatan Spesifik</label>
                                    <input type="text" name="pengurus_list_jabatan[]" value="<?php echo esc_attr( $m_jabatan ); ?>" class="large-text">
                                </div>

                                <div>
                                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Riwayat Karir</label>
                                    <textarea name="pengurus_list_riwayat_karir[]" rows="4" class="large-text"><?php echo esc_textarea( $m_karir ); ?></textarea>
                                </div>

                                <div style="display: flex; gap: 15px;">
                                    <div style="flex: 1;">
                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Latar Belakang Pendidikan</label>
                                        <textarea name="pengurus_list_pendidikan[]" rows="3" class="large-text"><?php echo esc_textarea( $m_pendidikan ); ?></textarea>
                                    </div>
                                    <div style="flex: 1;">
                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Sertifikasi Profesional</label>
                                        <textarea name="pengurus_list_sertifikasi[]" rows="3" class="large-text"><?php echo esc_textarea( $m_sertifikasi ); ?></textarea>
                                    </div>
                                </div>

                                <div>
                                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Kutipan Kepemimpinan (Quote)</label>
                                    <input type="text" name="pengurus_list_kutipan[]" value="<?php echo esc_attr( $m_kutipan ); ?>" class="large-text">
                                </div>

                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <div>
                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Status</label>
                                        <select name="pengurus_list_status[]" class="regular-text">
                                            <option value="Aktif" <?php selected($m_status, 'Aktif'); ?>>Aktif</option>
                                            <option value="Proses Perizinan OJK" <?php selected($m_status, 'Proses Perizinan OJK'); ?>>Proses Perizinan OJK</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Urutan Tampil</label>
                                        <input type="number" name="pengurus_list_urutan[]" value="<?php echo esc_attr( $m_urutan ); ?>" class="small-text" style="width: 80px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            $counter++;
                        endforeach; 
                        ?>
                    </div>
                    
                    <button type="button" id="wkl-add-pengurus" class="button button-secondary" style="margin-top: 10px; font-weight: bold;">+ Tambah Pengurus Baru</button>
                    
                </div>
            </div>

            <!-- SECTION 3: Org Chart -->
            <div class="postbox" style="background: #fff; border-radius: 8px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px;">
                <h2 style="border-bottom: 1px solid #eee; padding: 15px; margin: 0; color: #088395; font-size: 16px;">📊 Bagan Struktur Organisasi</h2>
                <div class="inside" style="padding: 20px;">
                    <table class="form-table" role="presentation">
                        <tr>
                            <th scope="row">Tampilkan Struktur Organisasi?</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="options_pengurus_orgchart_show" value="1" <?php checked( $org_show, '1' ); ?>>
                                    Ya, tampilkan di halaman profil.
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label>Gambar Bagan Organisasi</label></th>
                            <td>
                                <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                    <img id="orgchart_image_preview" src="<?php echo esc_url($org_img); ?>" style="max-width: 300px; max-height: 200px; border: 1px solid #ccd0d4; padding: 4px; background: #fafafa; object-fit: contain; <?php echo empty($org_img) ? 'display:none;' : ''; ?>" />
                                    <div style="display: flex; flex-direction: column; gap: 6px;">
                                        <button type="button" class="button wkl-upload-btn" data-target="options_pengurus_orgchart_image" data-preview="orgchart_image_preview">
                                            <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Gambar
                                        </button>
                                        <button type="button" class="button-link wkl-remove-btn" data-target="options_pengurus_orgchart_image" data-preview="orgchart_image_preview" style="color: #ef4444; font-size: 12px; <?php echo empty($org_img) ? 'display:none;' : ''; ?>">
                                            ✕ Hapus Gambar
                                        </button>
                                    </div>
                                    <input type="hidden" id="options_pengurus_orgchart_image" name="options_pengurus_orgchart_image" value="<?php echo esc_attr($org_img); ?>" class="regular-text" placeholder="URL foto" style="flex: 1; min-width: 200px;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_pengurus_orgchart_desc">Deskripsi Struktur (Opsional)</label></th>
                            <td>
                                <textarea id="options_pengurus_orgchart_desc" name="options_pengurus_orgchart_desc" rows="3" class="large-text"><?php echo esc_textarea( $org_desc ); ?></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- SECTION 4: CTA Banner Settings -->
            <div class="postbox" style="background: #fff; border-radius: 8px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px;">
                <h2 style="border-bottom: 1px solid #eee; padding: 15px; margin: 0; color: #088395; font-size: 16px;">🎯 Pengaturan Call to Action (CTA)</h2>
                <div class="inside" style="padding: 20px;">
                    <table class="form-table" role="presentation">
                        <tr>
                            <th scope="row">Tampilkan CTA?</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="options_pengurus_cta_show" value="1" <?php checked( $cta_show, '1' ); ?>>
                                    Ya, tampilkan banner CTA di bagian bawah halaman.
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_pengurus_cta_badge">Badge CTA</label></th>
                            <td>
                                <input type="text" id="options_pengurus_cta_badge" name="options_pengurus_cta_badge" value="<?php echo esc_attr( $cta_badge ); ?>" class="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_pengurus_cta_title">Judul CTA</label></th>
                            <td>
                                <input type="text" id="options_pengurus_cta_title" name="options_pengurus_cta_title" value="<?php echo esc_attr( $cta_title ); ?>" class="large-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_pengurus_cta_desc">Deskripsi Singkat</label></th>
                            <td>
                                <textarea id="options_pengurus_cta_desc" name="options_pengurus_cta_desc" rows="3" class="large-text"><?php echo esc_textarea( $cta_desc ); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_pengurus_cta_btn1_text">Teks Tombol 1</label></th>
                            <td>
                                <input type="text" id="options_pengurus_cta_btn1_text" name="options_pengurus_cta_btn1_text" value="<?php echo esc_attr( $cta_btn1_text ); ?>" class="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_pengurus_cta_btn1_url">URL Tombol 1</label></th>
                            <td>
                                <input type="url" id="options_pengurus_cta_btn1_url" name="options_pengurus_cta_btn1_url" value="<?php echo esc_attr( $cta_btn1_url ); ?>" class="large-text" placeholder="https://" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_pengurus_cta_btn2_text">Teks Tombol 2</label></th>
                            <td>
                                <input type="text" id="options_pengurus_cta_btn2_text" name="options_pengurus_cta_btn2_text" value="<?php echo esc_attr( $cta_btn2_text ); ?>" class="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_pengurus_cta_btn2_url">URL Tombol 2</label></th>
                            <td>
                                <input type="url" id="options_pengurus_cta_btn2_url" name="options_pengurus_cta_btn2_url" value="<?php echo esc_attr( $cta_btn2_url ); ?>" class="large-text" placeholder="https://" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p class="submit">
                <button type="submit" name="wakalumi_pengurus_submit" class="button button-primary" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 5px 30px; font-size: 16px; line-height: 1.5; border-radius: 4px;">Simpan Perubahan</button>
            </p>
        </form>
    </div>

    <!-- Hidden Template for New Repeater Item -->
    <script type="text/template" id="tmpl-pengurus-card">
        <div class="pengurus-card" style="border-left: 4px solid #088395; background: #fff; border-radius: 8px; border-top: 1px solid #ccd0d4; border-right: 1px solid #ccd0d4; border-bottom: 1px solid #ccd0d4; padding: 20px; margin-bottom: 20px; display: flex; gap: 20px; position: relative;">
            <button type="button" class="wkl-delete-member" style="position: absolute; top: 15px; right: 15px; background: none; border: none; color: #ef4444; font-size: 20px; cursor: pointer; font-weight: bold;" title="Hapus Pengurus">✕</button>

            <!-- Left: Photo -->
            <div style="flex: 0 0 200px; display: flex; flex-direction: column; gap: 10px;">
                <label style="font-weight: bold;">Foto Profil</label>
                <div class="wkl-upload-wrap" style="display: flex; flex-direction: column; align-items: flex-start; gap: 12px;">
                    <img id="pengurus_foto_preview_{{id}}" src="" style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid #088395; object-fit: cover; display: none;" />
                    <div style="display: flex; flex-direction: column; gap: 6px;">
                        <button type="button" class="button wkl-upload-btn" data-target="pengurus_foto_input_{{id}}" data-preview="pengurus_foto_preview_{{id}}">
                            <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Foto
                        </button>
                        <button type="button" class="button-link wkl-remove-btn" data-target="pengurus_foto_input_{{id}}" data-preview="pengurus_foto_preview_{{id}}" style="color: #ef4444; font-size: 12px; display: none;">
                            ✕ Hapus Foto
                        </button>
                    </div>
                    <input type="hidden" id="pengurus_foto_input_{{id}}" name="pengurus_list_foto[]" value="" class="regular-text">
                </div>
            </div>

            <!-- Right: Fields -->
            <div style="flex: 1; display: flex; flex-direction: column; gap: 15px;">
                <div style="display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nama Lengkap (dengan Gelar)</label>
                        <input type="text" name="pengurus_list_nama[]" value="" class="large-text" required>
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Kategori</label>
                        <select name="pengurus_list_kategori[]" class="large-text">
                            <option value="Dewan Pengawas Syariah">Dewan Pengawas Syariah</option>
                            <option value="Dewan Komisaris">Dewan Komisaris</option>
                            <option value="Direksi">Direksi</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Jabatan Spesifik</label>
                    <input type="text" name="pengurus_list_jabatan[]" value="" class="large-text">
                </div>

                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Riwayat Karir</label>
                    <textarea name="pengurus_list_riwayat_karir[]" rows="4" class="large-text"></textarea>
                </div>

                <div style="display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Latar Belakang Pendidikan</label>
                        <textarea name="pengurus_list_pendidikan[]" rows="3" class="large-text"></textarea>
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Sertifikasi Profesional</label>
                        <textarea name="pengurus_list_sertifikasi[]" rows="3" class="large-text"></textarea>
                    </div>
                </div>

                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Kutipan Kepemimpinan (Quote)</label>
                    <input type="text" name="pengurus_list_kutipan[]" value="" class="large-text">
                </div>

                <div style="display: flex; gap: 15px; align-items: center;">
                    <div>
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Status</label>
                        <select name="pengurus_list_status[]" class="regular-text">
                            <option value="Aktif">Aktif</option>
                            <option value="Proses Perizinan OJK">Proses Perizinan OJK</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Urutan Tampil</label>
                        <input type="number" name="pengurus_list_urutan[]" value="99" class="small-text" style="width: 80px;">
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script type="text/javascript">
    jQuery(document).ready(function($){
        
        // --- Media Uploader Logic ---
        $(document).on('click', '.wkl-upload-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            var targetId = button.data('target');
            var previewId = button.data('preview');
            var removeBtn = button.siblings('.wkl-remove-btn');

            var mediaUploader = wp.media({
                title: 'Pilih atau Unggah Gambar',
                button: { text: 'Gunakan Gambar Ini' },
                multiple: false
            });
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#' + targetId).val(attachment.url);
                $('#' + previewId).attr('src', attachment.url).show();
                removeBtn.show();
            });
            mediaUploader.open();
        });

        $(document).on('click', '.wkl-remove-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            var targetId = button.data('target');
            var previewId = button.data('preview');
            $('#' + targetId).val('');
            $('#' + previewId).attr('src', '').hide();
            button.hide();
        });

        // --- Repeater Logic ---
        var counter = <?php echo isset($counter) ? $counter : 999; ?>;
        
        $('#wkl-add-pengurus').on('click', function(e){\
            e.preventDefault();
            counter++;
            var template = $('#tmpl-pengurus-card').html();
            template = template.replace(/{{id}}/g, counter);
            $('#wakalumi_pengurus_repeater').append(template);
        });

        $(document).on('click', '.wkl-delete-member', function(e){\
            e.preventDefault();
            if(confirm('Apakah Anda yakin ingin menghapus pengurus ini?')) {
                $(this).closest('.pengurus-card').slideUp(300, function(){\
                    $(this).remove();
                });
            }
        });

    });
    </script>
    <?php
}
