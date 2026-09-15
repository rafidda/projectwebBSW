<?php
/**
 * Admin Page: Jaringan Kantor
 * Submenu of wakalumi-settings
 * 
 * Mengelola seluruh kantor operasional, kantor kas, dan kantor layanan BPRS Wakalumi.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// 1. Register Menu
add_action( 'admin_menu', 'wakalumi_register_kantor_page', 23 );
function wakalumi_register_kantor_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Profil: Jaringan Kantor',
        'Profil: Jaringan Kantor',
        'manage_options',
        'wakalumi-kantor',
        'wakalumi_render_kantor_page',
        23
    );
}

// 2. Render Page & Handle Save
function wakalumi_render_kantor_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $is_saved = false;

    // Save Logic
    if ( isset( $_POST['wakalumi_kantor_submit'] ) && check_admin_referer( 'wakalumi_kantor_save', 'wakalumi_kantor_nonce' ) ) {
        
        // 1. Page Header Settings & Stats
        update_option( 'options_kantor_page_badge', sanitize_text_field( wp_unslash( $_POST['options_kantor_page_badge'] ?? '' ) ) );
        update_option( 'options_kantor_page_title', sanitize_text_field( wp_unslash( $_POST['options_kantor_page_title'] ?? '' ) ) );
        update_option( 'options_kantor_page_subtitle', sanitize_textarea_field( wp_unslash( $_POST['options_kantor_page_subtitle'] ?? '' ) ) );
        
        update_option( 'options_kantor_stat1_num', sanitize_text_field( wp_unslash( $_POST['options_kantor_stat1_num'] ?? '' ) ) );
        update_option( 'options_kantor_stat1_label', sanitize_text_field( wp_unslash( $_POST['options_kantor_stat1_label'] ?? '' ) ) );
        update_option( 'options_kantor_stat2_num', sanitize_text_field( wp_unslash( $_POST['options_kantor_stat2_num'] ?? '' ) ) );
        update_option( 'options_kantor_stat2_label', sanitize_text_field( wp_unslash( $_POST['options_kantor_stat2_label'] ?? '' ) ) );
        update_option( 'options_kantor_stat3_num', sanitize_text_field( wp_unslash( $_POST['options_kantor_stat3_num'] ?? '' ) ) );
        update_option( 'options_kantor_stat3_label', sanitize_text_field( wp_unslash( $_POST['options_kantor_stat3_label'] ?? '' ) ) );

        // 2. Office Repeater
        $names     = wp_unslash( $_POST['kantor_list_nama'] ?? [] );
        $tipes     = wp_unslash( $_POST['kantor_list_tipe'] ?? [] );
        $fotos     = wp_unslash( $_POST['kantor_list_foto'] ?? [] );
        $alamats   = wp_unslash( $_POST['kantor_list_alamat'] ?? [] );
        $kotas     = wp_unslash( $_POST['kantor_list_kota_kab'] ?? [] );
        $telepons  = wp_unslash( $_POST['kantor_list_telepon'] ?? [] );
        $whatsapps = wp_unslash( $_POST['kantor_list_whatsapp'] ?? [] );
        $jams      = wp_unslash( $_POST['kantor_list_jam'] ?? [] );
        $layanans  = wp_unslash( $_POST['kantor_list_layanan'] ?? [] );
        $gmaps     = wp_unslash( $_POST['kantor_list_gmaps_url'] ?? [] );
        $statuses  = wp_unslash( $_POST['kantor_list_status'] ?? [] );
        $urutans   = wp_unslash( $_POST['kantor_list_urutan'] ?? [] );

        $kantor_list = [];
        for ( $i = 0; $i < count( $names ); $i++ ) {
            $nama = sanitize_text_field( $names[$i] ?? '' );
            if ( empty( $nama ) ) {
                continue;
            }
            $kantor_list[] = [
                'nama'            => $nama,
                'tipe'            => sanitize_text_field( $tipes[$i] ?? 'Kantor Kas' ),
                'foto'            => esc_url_raw( $fotos[$i] ?? '' ),
                'alamat'          => sanitize_textarea_field( $alamats[$i] ?? '' ),
                'kota_kab'        => sanitize_text_field( $kotas[$i] ?? '' ),
                'telepon'         => sanitize_text_field( $telepons[$i] ?? '' ),
                'whatsapp'        => sanitize_text_field( $whatsapps[$i] ?? '' ),
                'jam_operasional' => sanitize_text_field( $jams[$i] ?? 'Senin - Jumat: 08.00 - 15.00 WIB' ),
                'layanan'         => sanitize_textarea_field( $layanans[$i] ?? '' ),
                'gmaps_url'       => esc_url_raw( $gmaps[$i] ?? '' ),
                'status'          => sanitize_text_field( $statuses[$i] ?? 'Beroperasi Normal' ),
                'urutan'          => intval( $urutans[$i] ?? ( $i + 1 ) ),
            ];
        }

        // Sort by urutan before saving
        usort( $kantor_list, function( $a, $b ) {
            return $a['urutan'] <=> $b['urutan'];
        });

        update_option( 'options_kantor_list', $kantor_list );

        // 3. CTA Section
        $show_cta = isset( $_POST['options_kantor_cta_show'] ) ? '1' : '0';
        update_option( 'options_kantor_cta_show', $show_cta );
        update_option( 'options_kantor_cta_badge', sanitize_text_field( wp_unslash( $_POST['options_kantor_cta_badge'] ?? '' ) ) );
        update_option( 'options_kantor_cta_title', sanitize_text_field( wp_unslash( $_POST['options_kantor_cta_title'] ?? '' ) ) );
        update_option( 'options_kantor_cta_desc', sanitize_textarea_field( wp_unslash( $_POST['options_kantor_cta_desc'] ?? '' ) ) );
        update_option( 'options_kantor_cta_btn1_text', sanitize_text_field( wp_unslash( $_POST['options_kantor_cta_btn1_text'] ?? '' ) ) );
        update_option( 'options_kantor_cta_btn1_url', esc_url_raw( wp_unslash( $_POST['options_kantor_cta_btn1_url'] ?? '' ) ) );
        update_option( 'options_kantor_cta_btn2_text', sanitize_text_field( wp_unslash( $_POST['options_kantor_cta_btn2_text'] ?? '' ) ) );
        update_option( 'options_kantor_cta_btn2_url', esc_url_raw( wp_unslash( $_POST['options_kantor_cta_btn2_url'] ?? '' ) ) );

        $is_saved = true;
    }

    // Default pre-populated offices data (fallback when not yet set in database)
    $default_kantor_list = array(
        array(
            'nama'            => 'Kantor Pusat Operasional',
            'tipe'            => 'Kantor Pusat Operasional',
            'foto'            => defined('WAKALUMI_URI') ? WAKALUMI_URI . '/assets/img/kantor/kantor-pusat.jpg' : '',
            'alamat'          => "Jl. Dewi Sartika, Komp. Ciputat Mutiara Center Blok B1 - Ciputat 15411",
            'kota_kab'        => 'Tangerang Selatan',
            'telepon'         => '(021) 7401667 - 7490874',
            'whatsapp'        => '081517380388',
            'jam_operasional' => 'Senin - Jumat: 08.00 - 15.00 WIB',
            'layanan'         => 'Semua Layanan Perbankan Syariah, Pembiayaan Modal Kerja & Konsumtif, Pembukaan Tabungan, Deposito Syariah, Customer Service',
            'gmaps_url'       => 'https://maps.google.com/?q=BPRS+Wakalumi+Ciputat',
            'status'          => 'Beroperasi Normal',
            'urutan'          => 1
        ),
        array(
            'nama'            => 'Kantor Kas Cikupa',
            'tipe'            => 'Kantor Kas',
            'foto'            => defined('WAKALUMI_URI') ? WAKALUMI_URI . '/assets/img/kantor/kantor-cikupa.jpg' : '',
            'alamat'          => "Jl. Raya Serang Km 15, Ruko Cikupa Niaga Mas Blok C No. 22 Talagasari, Kec. Cikupa, Kabupaten Tangerang, Banten 15710",
            'kota_kab'        => 'Kabupaten Tangerang',
            'telepon'         => '(021) 7401667',
            'whatsapp'        => '081517380388',
            'jam_operasional' => 'Senin - Jumat: 08.00 - 15.00 WIB',
            'layanan'         => 'Setoran & Penarikan Tunai, Pembukaan Tabungan Syariah, Pengajuan Pembiayaan UMKM, Informasi Produk',
            'gmaps_url'       => 'https://maps.google.com/?q=Ruko+Cikupa+Niaga+Mas+Blok+C+No+22',
            'status'          => 'Beroperasi Normal',
            'urutan'          => 2
        ),
        array(
            'nama'            => 'Kantor Layanan Ciledug',
            'tipe'            => 'Kantor Layanan',
            'foto'            => defined('WAKALUMI_URI') ? WAKALUMI_URI . '/assets/img/kantor/kantor-ciledug.jpg' : '',
            'alamat'          => "Plaza Ciledug, Lt. Basement Blok B.4, Kota Tangerang",
            'kota_kab'        => 'Kota Tangerang',
            'telepon'         => '(021) 7401667',
            'whatsapp'        => '081517380388',
            'jam_operasional' => 'Senin - Jumat: 08.00 - 15.00 WIB',
            'layanan'         => 'Pembukaan Tabungan, Informasi Produk Simpanan & Pembiayaan, Pelayanan Nasabah',
            'gmaps_url'       => 'https://maps.google.com/?q=Plaza+Ciledug',
            'status'          => 'Beroperasi Normal',
            'urutan'          => 3
        ),
    );

    // Fetch existing values from database
    $page_badge     = get_option( 'options_kantor_page_badge', 'Jaringan Kantor' );
    $page_title     = get_option( 'options_kantor_page_title', 'Jaringan Kantor & Layanan BPRS Wakalumi' );
    $page_subtitle  = get_option( 'options_kantor_page_subtitle', 'Kami hadir lebih dekat di lokasi-lokasi strategis untuk memberikan kemudahan, keamanan, dan kenyamanan prima bagi seluruh nasabah perbankan syariah.' );
    
    $stat1_num      = get_option( 'options_kantor_stat1_num', '3 Kantor' );
    $stat1_label    = get_option( 'options_kantor_stat1_label', 'Kantor Operasional & Kas' );
    $stat2_num      = get_option( 'options_kantor_stat2_num', '3 Wilayah' );
    $stat2_label    = get_option( 'options_kantor_stat2_label', 'Tangsel, Kab. Tangerang, & Kota Tangerang' );
    $stat3_num      = get_option( 'options_kantor_stat3_num', 'Senin - Jumat' );
    $stat3_label    = get_option( 'options_kantor_stat3_label', 'Pukul 08.00 - 15.00 WIB' );

    $kantor_list    = get_option( 'options_kantor_list', false );
    if ( $kantor_list === false || ! is_array( $kantor_list ) || empty( $kantor_list ) ) {
        $kantor_list = $default_kantor_list;
        update_option( 'options_kantor_list', $kantor_list );
    }

    $cta_show       = get_option( 'options_kantor_cta_show', '1' );
    $cta_badge      = get_option( 'options_kantor_cta_badge', 'Layanan Nasabah' );
    $cta_title      = get_option( 'options_kantor_cta_title', 'Perlu Bantuan atau Ingin Berkonsultasi Langsung?' );
    $cta_desc       = get_option( 'options_kantor_cta_desc', 'Kunjungi kantor kami terdekat atau hubungi layanan nasabah kami via WhatsApp untuk kemudahan informasi produk simpanan dan pengajuan pembiayaan syariah.' );
    $cta_btn1_text  = get_option( 'options_kantor_cta_btn1_text', 'Chat WhatsApp CS' );
    $cta_btn1_url   = get_option( 'options_kantor_cta_btn1_url', 'https://wa.me/6281517380388' );
    $cta_btn2_text  = get_option( 'options_kantor_cta_btn2_text', 'Jelajahi Produk Kami' );
    $cta_btn2_url   = get_option( 'options_kantor_cta_btn2_url', home_url( '/produk' ) );

    // Enqueue WP Media
    wp_enqueue_media();
    ?>
    <div class="wrap" style="max-width: 950px; margin-top: 20px;">
        <h1 style="color: #088395; margin-bottom: 8px; font-weight: bold;">Profil: Jaringan Kantor</h1>
        <p class="description" style="margin-bottom: 25px; font-size: 14px;">
            Kelola data kantor pusat operasional, kantor kas, dan kantor layanan BPRS Wakalumi. Anda dapat menambah kantor baru, memindahkan alamat, mengubah kontak, dan foto gedung sewaktu-waktu.
        </p>

        <?php if ( $is_saved ) : ?>
            <div class="notice notice-success is-dismissible">
                <p>✅ Data jaringan kantor berhasil disimpan!</p>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <?php wp_nonce_field( 'wakalumi_kantor_save', 'wakalumi_kantor_nonce' ); ?>

            <!-- SECTION 1: Header Halaman & Statistik Cepat -->
            <div class="postbox" style="background: #fff; border-radius: 8px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px;">
                <h2 style="border-bottom: 1px solid #eee; padding: 15px; margin: 0; color: #088395; font-size: 16px;">📰 Header Halaman & Statistik</h2>
                <div class="inside" style="padding: 20px;">
                    <table class="form-table" role="presentation">
                        <tr>
                            <th scope="row"><label for="options_kantor_page_badge">Badge Halaman</label></th>
                            <td>
                                <input type="text" id="options_kantor_page_badge" name="options_kantor_page_badge" value="<?php echo esc_attr( $page_badge ); ?>" class="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_kantor_page_title">Judul Utama Halaman</label></th>
                            <td>
                                <input type="text" id="options_kantor_page_title" name="options_kantor_page_title" value="<?php echo esc_attr( $page_title ); ?>" class="large-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_kantor_page_subtitle">Sub-Judul / Deskripsi</label></th>
                            <td>
                                <textarea id="options_kantor_page_subtitle" name="options_kantor_page_subtitle" rows="2" class="large-text"><?php echo esc_textarea( $page_subtitle ); ?></textarea>
                            </td>
                        </tr>
                    </table>

                    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
                    <h3 style="font-size: 14px; margin-bottom: 15px; color: #333;">Statistik Cepat (Tampil di Bawah Header):</h3>

                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                        <div style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px;">Angka / Teks Stat 1</label>
                            <input type="text" name="options_kantor_stat1_num" value="<?php echo esc_attr( $stat1_num ); ?>" style="width: 100%; margin-bottom: 6px;" placeholder="3 Kantor">
                            <label style="display: block; font-size: 11px; color: #64748b; margin-bottom: 2px;">Label Stat 1</label>
                            <input type="text" name="options_kantor_stat1_label" value="<?php echo esc_attr( $stat1_label ); ?>" style="width: 100%; font-size: 12px;">
                        </div>

                        <div style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px;">Angka / Teks Stat 2</label>
                            <input type="text" name="options_kantor_stat2_num" value="<?php echo esc_attr( $stat2_num ); ?>" style="width: 100%; margin-bottom: 6px;" placeholder="3 Wilayah">
                            <label style="display: block; font-size: 11px; color: #64748b; margin-bottom: 2px;">Label Stat 2</label>
                            <input type="text" name="options_kantor_stat2_label" value="<?php echo esc_attr( $stat2_label ); ?>" style="width: 100%; font-size: 12px;">
                        </div>

                        <div style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0;">
                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px;">Angka / Teks Stat 3</label>
                            <input type="text" name="options_kantor_stat3_num" value="<?php echo esc_attr( $stat3_num ); ?>" style="width: 100%; margin-bottom: 6px;" placeholder="Senin - Jumat">
                            <label style="display: block; font-size: 11px; color: #64748b; margin-bottom: 2px;">Label Stat 3</label>
                            <input type="text" name="options_kantor_stat3_label" value="<?php echo esc_attr( $stat3_label ); ?>" style="width: 100%; font-size: 12px;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Daftar Jaringan Kantor (Repeater) -->
            <div class="postbox" style="background: #fff; border-radius: 8px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px;">
                <h2 style="border-bottom: 1px solid #eee; padding: 15px; margin: 0; color: #088395; font-size: 16px;">🏢 Daftar Jaringan Kantor (Kantor Pusat, Kas, & Layanan)</h2>
                <div class="inside" style="padding: 20px;">
                    <p class="description" style="margin-bottom: 15px;">
                        Setiap kantor akan tampil dalam kartu informatif di website. Lengkapi alamat, foto gedung, dan nomor kontak agar nasabah mudah menjangkau lokasi.
                    </p>

                    <div id="wkl-kantor-container">
                        <?php foreach ( $kantor_list as $index => $kantor ) : 
                            $foto_url = $kantor['foto'] ?? '';
                        ?>
                            <div class="kantor-card" style="border-left: 4px solid #088395; background: #fff; border-radius: 8px; border-top: 1px solid #ccd0d4; border-right: 1px solid #ccd0d4; border-bottom: 1px solid #ccd0d4; padding: 20px; margin-bottom: 20px; display: flex; gap: 20px; position: relative;">
                                <button type="button" class="wkl-delete-kantor" style="position: absolute; top: 15px; right: 15px; background: none; border: none; color: #ef4444; font-size: 20px; cursor: pointer; font-weight: bold;" title="Hapus Kantor">✕</button>

                                <!-- Left: Foto Gedung/Ruko -->
                                <div style="flex: 0 0 200px; display: flex; flex-direction: column; gap: 10px;">
                                    <label style="font-weight: bold; font-size: 13px;">Foto Gedung / Kantor</label>
                                    <div class="wkl-upload-wrap" style="display: flex; flex-direction: column; align-items: flex-start; gap: 10px;">
                                        <img id="kantor_foto_preview_<?php echo $index; ?>" src="<?php echo esc_url($foto_url); ?>" style="width: 100%; height: 130px; border-radius: 8px; border: 1px solid #ccd0d4; object-fit: cover; background: #f8fafc; <?php echo empty($foto_url) ? 'display:none;' : ''; ?>" />
                                        <div style="display: flex; flex-direction: column; gap: 6px; width: 100%;">
                                            <button type="button" class="button wkl-upload-btn" data-target="kantor_foto_input_<?php echo $index; ?>" data-preview="kantor_foto_preview_<?php echo $index; ?>" style="width: 100%; text-align: center;">
                                                <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px; vertical-align: middle;"></span> Unggah Foto
                                            </button>
                                            <button type="button" class="button-link wkl-remove-btn" data-target="kantor_foto_input_<?php echo $index; ?>" data-preview="kantor_foto_preview_<?php echo $index; ?>" style="color: #ef4444; font-size: 12px; <?php echo empty($foto_url) ? 'display:none;' : ''; ?>">
                                                ✕ Hapus Foto
                                            </button>
                                        </div>
                                        <input type="hidden" id="kantor_foto_input_<?php echo $index; ?>" name="kantor_list_foto[]" value="<?php echo esc_attr($foto_url); ?>">
                                    </div>

                                    <div style="margin-top: 10px;">
                                        <label style="font-weight: bold; font-size: 12px; display: block; margin-bottom: 4px;">Status Operasional</label>
                                        <select name="kantor_list_status[]" style="width: 100%;">
                                            <option value="Beroperasi Normal" <?php selected( $kantor['status'] ?? '', 'Beroperasi Normal' ); ?>>🟢 Beroperasi Normal</option>
                                            <option value="Dalam Renovasi" <?php selected( $kantor['status'] ?? '', 'Dalam Renovasi' ); ?>>🟡 Dalam Renovasi</option>
                                            <option value="Segera Hadir" <?php selected( $kantor['status'] ?? '', 'Segera Hadir' ); ?>>🔵 Segera Hadir</option>
                                        </select>
                                    </div>

                                    <div style="margin-top: 5px;">
                                        <label style="font-weight: bold; font-size: 12px; display: block; margin-bottom: 4px;">Urutan Tampil</label>
                                        <input type="number" name="kantor_list_urutan[]" value="<?php echo esc_attr( $kantor['urutan'] ?? ($index+1) ); ?>" style="width: 80px;">
                                    </div>
                                </div>

                                <!-- Right: Data Form Fields -->
                                <div style="flex: 1; display: flex; flex-direction: column; gap: 12px;">
                                    <div style="display: flex; gap: 15px;">
                                        <div style="flex: 2;">
                                            <label style="display: block; font-weight: bold; margin-bottom: 4px;">Nama Kantor</label>
                                            <input type="text" name="kantor_list_nama[]" value="<?php echo esc_attr( $kantor['nama'] ?? '' ); ?>" class="large-text" placeholder="misal: Kantor Kas Cikupa" required>
                                        </div>
                                        <div style="flex: 1;">
                                            <label style="display: block; font-weight: bold; margin-bottom: 4px;">Tipe Kantor</label>
                                            <select name="kantor_list_tipe[]" class="large-text">
                                                <option value="Kantor Pusat Operasional" <?php selected( $kantor['tipe'] ?? '', 'Kantor Pusat Operasional' ); ?>>Kantor Pusat Operasional</option>
                                                <option value="Kantor Cabang" <?php selected( $kantor['tipe'] ?? '', 'Kantor Cabang' ); ?>>Kantor Cabang</option>
                                                <option value="Kantor Kas" <?php selected( $kantor['tipe'] ?? '', 'Kantor Kas' ); ?>>Kantor Kas</option>
                                                <option value="Kantor Layanan" <?php selected( $kantor['tipe'] ?? '', 'Kantor Layanan' ); ?>>Kantor Layanan</option>
                                                <option value="Kas Keliling / ATM" <?php selected( $kantor['tipe'] ?? '', 'Kas Keliling / ATM' ); ?>>Kas Keliling / ATM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div style="display: flex; gap: 15px;">
                                        <div style="flex: 2;">
                                            <label style="display: block; font-weight: bold; margin-bottom: 4px;">Alamat Lengkap</label>
                                            <textarea name="kantor_list_alamat[]" rows="3" class="large-text" placeholder="Jl. Raya Serang Km 15, Ruko Cikupa Niaga Mas..."><?php echo esc_textarea( $kantor['alamat'] ?? '' ); ?></textarea>
                                        </div>
                                        <div style="flex: 1;">
                                            <label style="display: block; font-weight: bold; margin-bottom: 4px;">Kota / Kabupaten</label>
                                            <input type="text" name="kantor_list_kota_kab[]" value="<?php echo esc_attr( $kantor['kota_kab'] ?? '' ); ?>" class="large-text" placeholder="misal: Kab. Tangerang">
                                            
                                            <label style="display: block; font-weight: bold; margin-top: 8px; margin-bottom: 4px;">Jam Operasional</label>
                                            <input type="text" name="kantor_list_jam[]" value="<?php echo esc_attr( $kantor['jam_operasional'] ?? 'Senin - Jumat: 08.00 - 15.00 WIB' ); ?>" class="large-text">
                                        </div>
                                    </div>

                                    <div style="display: flex; gap: 15px;">
                                        <div style="flex: 1;">
                                            <label style="display: block; font-weight: bold; margin-bottom: 4px;">Nomor Telepon</label>
                                            <input type="text" name="kantor_list_telepon[]" value="<?php echo esc_attr( $kantor['telepon'] ?? '' ); ?>" class="large-text" placeholder="(021) 7401667">
                                        </div>
                                        <div style="flex: 1;">
                                            <label style="display: block; font-weight: bold; margin-bottom: 4px;">WhatsApp Hotline Kantor</label>
                                            <input type="text" name="kantor_list_whatsapp[]" value="<?php echo esc_attr( $kantor['whatsapp'] ?? '' ); ?>" class="large-text" placeholder="081517380388">
                                        </div>
                                    </div>

                                    <div>
                                        <label style="display: block; font-weight: bold; margin-bottom: 4px;">Tautan Google Maps Langsung (Tombol Petunjuk Arah)</label>
                                        <input type="url" name="kantor_list_gmaps_url[]" value="<?php echo esc_attr( $kantor['gmaps_url'] ?? '' ); ?>" class="large-text" placeholder="https://maps.google.com/?q=...">
                                        <p class="description" style="font-size: 11px;">Tempel link share dari Google Maps. Saat nasabah mengklik, rute GPS langsung terbuka di aplikasi HP mereka.</p>
                                    </div>

                                    <div>
                                        <label style="display: block; font-weight: bold; margin-bottom: 4px;">Layanan yang Tersedia di Kantor Ini</label>
                                        <textarea name="kantor_list_layanan[]" rows="2" class="large-text" placeholder="misal: Setoran & Penarikan Tunai, Pembukaan Tabungan Syariah, Pengajuan Pembiayaan..."><?php echo esc_textarea( $kantor['layanan'] ?? '' ); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" id="wkl-add-kantor" class="button button-secondary" style="margin-top: 10px; font-weight: bold; border-color: #088395; color: #088395;">
                        <span class="dashicons dashicons-plus-alt" style="vertical-align: middle;"></span> Tambah Kantor Baru
                    </button>
                </div>
            </div>

            <!-- SECTION 3: Pengaturan CTA Banner -->
            <div class="postbox" style="background: #fff; border-radius: 8px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 20px;">
                <h2 style="border-bottom: 1px solid #eee; padding: 15px; margin: 0; color: #088395; font-size: 16px;">🎯 Pengaturan Call to Action (CTA)</h2>
                <div class="inside" style="padding: 20px;">
                    <table class="form-table" role="presentation">
                        <tr>
                            <th scope="row">Tampilkan Banner CTA?</th>
                            <td>
                                <label>
                                    <input type="checkbox" name="options_kantor_cta_show" value="1" <?php checked( $cta_show, '1' ); ?>>
                                    Ya, tampilkan banner CTA di bagian bawah halaman.
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_kantor_cta_badge">Badge CTA</label></th>
                            <td>
                                <input type="text" id="options_kantor_cta_badge" name="options_kantor_cta_badge" value="<?php echo esc_attr( $cta_badge ); ?>" class="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_kantor_cta_title">Judul CTA</label></th>
                            <td>
                                <input type="text" id="options_kantor_cta_title" name="options_kantor_cta_title" value="<?php echo esc_attr( $cta_title ); ?>" class="large-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_kantor_cta_desc">Deskripsi Singkat</label></th>
                            <td>
                                <textarea id="options_kantor_cta_desc" name="options_kantor_cta_desc" rows="3" class="large-text"><?php echo esc_textarea( $cta_desc ); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_kantor_cta_btn1_text">Teks Tombol 1</label></th>
                            <td>
                                <input type="text" id="options_kantor_cta_btn1_text" name="options_kantor_cta_btn1_text" value="<?php echo esc_attr( $cta_btn1_text ); ?>" class="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_kantor_cta_btn1_url">URL Tombol 1</label></th>
                            <td>
                                <input type="text" id="options_kantor_cta_btn1_url" name="options_kantor_cta_btn1_url" value="<?php echo esc_attr( $cta_btn1_url ); ?>" class="large-text" placeholder="https://wa.me/..." />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_kantor_cta_btn2_text">Teks Tombol 2</label></th>
                            <td>
                                <input type="text" id="options_kantor_cta_btn2_text" name="options_kantor_cta_btn2_text" value="<?php echo esc_attr( $cta_btn2_text ); ?>" class="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_kantor_cta_btn2_url">URL Tombol 2</label></th>
                            <td>
                                <input type="text" id="options_kantor_cta_btn2_url" name="options_kantor_cta_btn2_url" value="<?php echo esc_attr( $cta_btn2_url ); ?>" class="large-text" placeholder="https://" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p class="submit">
                <button type="submit" name="wakalumi_kantor_submit" class="button button-primary" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 5px 30px; font-size: 16px; line-height: 1.5; border-radius: 4px;">Simpan Perubahan</button>
            </p>
        </form>
    </div>

    <!-- Hidden Template for New Repeater Item -->
    <script type="text/template" id="tmpl-kantor-card">
        <div class="kantor-card" style="border-left: 4px solid #088395; background: #fff; border-radius: 8px; border-top: 1px solid #ccd0d4; border-right: 1px solid #ccd0d4; border-bottom: 1px solid #ccd0d4; padding: 20px; margin-bottom: 20px; display: flex; gap: 20px; position: relative;">
            <button type="button" class="wkl-delete-kantor" style="position: absolute; top: 15px; right: 15px; background: none; border: none; color: #ef4444; font-size: 20px; cursor: pointer; font-weight: bold;" title="Hapus Kantor">✕</button>

            <!-- Left: Foto Gedung/Ruko -->
            <div style="flex: 0 0 200px; display: flex; flex-direction: column; gap: 10px;">
                <label style="font-weight: bold; font-size: 13px;">Foto Gedung / Kantor</label>
                <div class="wkl-upload-wrap" style="display: flex; flex-direction: column; align-items: flex-start; gap: 10px;">
                    <img id="kantor_foto_preview_{{id}}" src="" style="width: 100%; height: 130px; border-radius: 8px; border: 1px solid #ccd0d4; object-fit: cover; background: #f8fafc; display: none;" />
                    <div style="display: flex; flex-direction: column; gap: 6px; width: 100%;">
                        <button type="button" class="button wkl-upload-btn" data-target="kantor_foto_input_{{id}}" data-preview="kantor_foto_preview_{{id}}" style="width: 100%; text-align: center;">
                            <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px; vertical-align: middle;"></span> Unggah Foto
                        </button>
                        <button type="button" class="button-link wkl-remove-btn" data-target="kantor_foto_input_{{id}}" data-preview="kantor_foto_preview_{{id}}" style="color: #ef4444; font-size: 12px; display: none;">
                            ✕ Hapus Foto
                        </button>
                    </div>
                    <input type="hidden" id="kantor_foto_input_{{id}}" name="kantor_list_foto[]" value="">
                </div>

                <div style="margin-top: 10px;">
                    <label style="font-weight: bold; font-size: 12px; display: block; margin-bottom: 4px;">Status Operasional</label>
                    <select name="kantor_list_status[]" style="width: 100%;">
                        <option value="Beroperasi Normal">🟢 Beroperasi Normal</option>
                        <option value="Dalam Renovasi">🟡 Dalam Renovasi</option>
                        <option value="Segera Hadir">🔵 Segera Hadir</option>
                    </select>
                </div>

                <div style="margin-top: 5px;">
                    <label style="font-weight: bold; font-size: 12px; display: block; margin-bottom: 4px;">Urutan Tampil</label>
                    <input type="number" name="kantor_list_urutan[]" value="{{order}}" style="width: 80px;">
                </div>
            </div>

            <!-- Right: Data Form Fields -->
            <div style="flex: 1; display: flex; flex-direction: column; gap: 12px;">
                <div style="display: flex; gap: 15px;">
                    <div style="flex: 2;">
                        <label style="display: block; font-weight: bold; margin-bottom: 4px;">Nama Kantor</label>
                        <input type="text" name="kantor_list_nama[]" value="" class="large-text" placeholder="misal: Kantor Kas..." required>
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 4px;">Tipe Kantor</label>
                        <select name="kantor_list_tipe[]" class="large-text">
                            <option value="Kantor Pusat Operasional">Kantor Pusat Operasional</option>
                            <option value="Kantor Cabang">Kantor Cabang</option>
                            <option value="Kantor Kas" selected>Kantor Kas</option>
                            <option value="Kantor Layanan">Kantor Layanan</option>
                            <option value="Kas Keliling / ATM">Kas Keliling / ATM</option>
                        </select>
                    </div>
                </div>

                <div style="display: flex; gap: 15px;">
                    <div style="flex: 2;">
                        <label style="display: block; font-weight: bold; margin-bottom: 4px;">Alamat Lengkap</label>
                        <textarea name="kantor_list_alamat[]" rows="3" class="large-text" placeholder="Jl. ..."></textarea>
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 4px;">Kota / Kabupaten</label>
                        <input type="text" name="kantor_list_kota_kab[]" value="" class="large-text" placeholder="misal: Tangerang">
                        
                        <label style="display: block; font-weight: bold; margin-top: 8px; margin-bottom: 4px;">Jam Operasional</label>
                        <input type="text" name="kantor_list_jam[]" value="Senin - Jumat: 08.00 - 15.00 WIB" class="large-text">
                    </div>
                </div>

                <div style="display: flex; gap: 15px;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 4px;">Nomor Telepon</label>
                        <input type="text" name="kantor_list_telepon[]" value="" class="large-text" placeholder="(021) ...">
                    </div>
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 4px;">WhatsApp Hotline Kantor</label>
                        <input type="text" name="kantor_list_whatsapp[]" value="" class="large-text" placeholder="08...">
                    </div>
                </div>

                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 4px;">Tautan Google Maps Langsung (Tombol Petunjuk Arah)</label>
                    <input type="url" name="kantor_list_gmaps_url[]" value="" class="large-text" placeholder="https://maps.google.com/?q=...">
                    <p class="description" style="font-size: 11px;">Tempel link share dari Google Maps.</p>
                </div>

                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 4px;">Layanan yang Tersedia di Kantor Ini</label>
                    <textarea name="kantor_list_layanan[]" rows="2" class="large-text" placeholder="Setoran, Penarikan, Pembukaan Tabungan..."></textarea>
                </div>
            </div>
        </div>
    </script>

    <!-- Admin JS for Repeater & WP Media Upload -->
    <script>
    jQuery(document).ready(function($) {
        var container = $('#wkl-kantor-container');
        var template = $('#tmpl-kantor-card').html();

        // 1. Add New Office Card
        $('#wkl-add-kantor').on('click', function(e) {
            e.preventDefault();
            var uniqueId = 'new_' + new Date().getTime();
            var count = container.find('.kantor-card').length + 1;
            var html = template.replace(/{{id}}/g, uniqueId).replace(/{{order}}/g, count);
            container.append(html);

            // Smooth scroll to the new card
            $('html, body').animate({
                scrollTop: container.find('.kantor-card:last').offset().top - 80
            }, 300);
        });

        // 2. Delete Office Card
        container.on('click', '.wkl-delete-kantor', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus kantor ini?')) {
                $(this).closest('.kantor-card').fadeOut(300, function() {
                    $(this).remove();
                });
            }
        });

        // 3. WP Media Uploader
        var mediaFrame;
        var currentBtn = null;

        $(document).on('click', '.wkl-upload-btn', function(e) {
            e.preventDefault();
            currentBtn = $(this);

            if (mediaFrame) {
                mediaFrame.open();
                return;
            }

            mediaFrame = wp.media({
                title: 'Pilih Foto Gedung / Kantor',
                button: { text: 'Gunakan Foto Ini' },
                multiple: false
            });

            mediaFrame.on('select', function() {
                var attachment = mediaFrame.state().get('selection').first().toJSON();
                var targetId = currentBtn.data('target');
                var previewId = currentBtn.data('preview');

                $('#' + targetId).val(attachment.url);
                $('#' + previewId).attr('src', attachment.url).show();
                currentBtn.siblings('.wkl-remove-btn').show();
            });

            mediaFrame.open();
        });

        // 4. Remove Image
        $(document).on('click', '.wkl-remove-btn', function(e) {
            e.preventDefault();
            var targetId = $(this).data('target');
            var previewId = $(this).data('preview');

            $('#' + targetId).val('');
            $('#' + previewId).attr('src', '').hide();
            $(this).hide();
        });
    });
    </script>
    <?php
}

