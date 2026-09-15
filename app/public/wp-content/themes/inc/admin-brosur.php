<?php
/**
 * Admin Page: Pengelolaan Brosur & Dokumen Produk
 * Submenu of wakalumi-settings
 * 
 * Mengelola file brosur PDF resmi dan materi promosi produk BPRS Wakalumi.
 * 
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// 1. Register Submenu
add_action( 'admin_menu', 'wakalumi_register_brosur_page', 24 );
function wakalumi_register_brosur_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Katalog Brosur & Dokumen',
        'Katalog Brosur',
        'manage_options',
        'wakalumi-brosur',
        'wakalumi_render_brosur_page',
        24
    );
}

// 2. Render Admin Page & Handle Save
function wakalumi_render_brosur_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $is_saved = false;

    // Handle Save
    if ( isset( $_POST['wakalumi_brosur_submit'] ) && check_admin_referer( 'wakalumi_brosur_save', 'wakalumi_brosur_nonce' ) ) {

        // 1. Primary Official Brochure Settings
        update_option( 'options_brosur_file_url', esc_url_raw( wp_unslash( $_POST['options_brosur_file_url'] ?? '' ) ) );
        update_option( 'options_brosur_file_name', sanitize_text_field( wp_unslash( $_POST['options_brosur_file_name'] ?? '' ) ) );
        update_option( 'options_brosur_file_size', sanitize_text_field( wp_unslash( $_POST['options_brosur_file_size'] ?? '' ) ) );
        update_option( 'options_brosur_cover', esc_url_raw( wp_unslash( $_POST['options_brosur_cover'] ?? '' ) ) );
        update_option( 'options_brosur_desc', sanitize_textarea_field( wp_unslash( $_POST['options_brosur_desc'] ?? '' ) ) );

        // 2. Additional Specific Brochures Repeater
        $titles    = wp_unslash( $_POST['brosur_list_title'] ?? [] );
        $kategoris = wp_unslash( $_POST['brosur_list_kategori'] ?? [] );
        $file_urls = wp_unslash( $_POST['brosur_list_file_url'] ?? [] );
        $covers    = wp_unslash( $_POST['brosur_list_cover'] ?? [] );
        $descs     = wp_unslash( $_POST['brosur_list_desc'] ?? [] );
        $urutans   = wp_unslash( $_POST['brosur_list_urutan'] ?? [] );

        $brosur_list = [];
        for ( $i = 0; $i < count( $titles ); $i++ ) {
            $title = sanitize_text_field( $titles[$i] ?? '' );
            if ( empty( $title ) ) {
                continue;
            }
            $brosur_list[] = [
                'title'     => $title,
                'kategori'  => sanitize_text_field( $kategoris[$i] ?? 'Umum' ),
                'file_url'  => esc_url_raw( $file_urls[$i] ?? '' ),
                'cover'     => esc_url_raw( $covers[$i] ?? '' ),
                'desc'      => sanitize_textarea_field( $descs[$i] ?? '' ),
                'urutan'    => intval( $urutans[$i] ?? ( $i + 1 ) ),
            ];
        }

        // Sort by urutan
        usort( $brosur_list, function( $a, $b ) {
            return $a['urutan'] <=> $b['urutan'];
        });

        update_option( 'options_brosur_list', $brosur_list );

        $is_saved = true;
    }

    // Fetch existing options
    $brosur_file_url  = get_option( 'options_brosur_file_url', '' );
    $brosur_file_name = get_option( 'options_brosur_file_name', 'Brosur Resmi Produk BPRS Wakalumi (Edisi 2026).pdf' );
    $brosur_file_size = get_option( 'options_brosur_file_size', 'PDF Resmi • Edisi Terkini' );
    $brosur_cover     = get_option( 'options_brosur_cover', '' );
    $brosur_desc      = get_option( 'options_brosur_desc', 'Katalog panduan komprehensif produk simpanan, deposito syariah, dan pembiayaan syariah BPRS Wakalumi.' );

    $brosur_list = get_option( 'options_brosur_list', [] );
    if ( empty( $brosur_list ) || ! is_array( $brosur_list ) ) {
        $brosur_list = [
            [
                'title'    => 'Brosur Simpanan & Deposito Syariah',
                'kategori' => 'Penghimpunan Dana',
                'file_url' => '',
                'cover'    => '',
                'desc'     => 'Informasi detail Tabungan Tawakal, Tabungan Pendidikan, Tabungan Haji & Umroh, dan Deposito Mudharabah.',
                'urutan'   => 1,
            ],
            [
                'title'    => 'Brosur Pembiayaan UMKM & Pendidikan',
                'kategori' => 'Penyaluran Dana',
                'file_url' => '',
                'cover'    => '',
                'desc'     => 'Informasi program Pembiayaan 1000 Pedagang, Pembiayaan 1000 Guru, dan simulasi angsuran syariah.',
                'urutan'   => 2,
            ],
        ];
    }
    ?>
    <div class="wrap" style="max-width: 960px; margin-top: 20px;">
        <h1 style="display: flex; align-items: center; gap: 10px; font-weight: 800; color: #0f172a;">
            <span class="dashicons dashicons-pdf" style="font-size: 32px; width: 32px; height: 32px; color: #088395;"></span>
            Katalog Brosur & Dokumen Produk Resmi
        </h1>
        <p style="color: #64748b; font-size: 14px; margin-top: 4px;">
            Kelola file PDF brosur resmi BPRS Wakalumi yang dapat diunduh nasabah langsung dari menu navigasi dan halaman produk.
        </p>

        <?php if ( $is_saved ) : ?>
            <div class="notice notice-success is-dismissible" style="border-left-color: #088395;">
                <p><strong>✅ Pengaturan Brosur Berhasil Disimpan!</strong> Tautan unduh brosur di navigasi web telah diperbarui.</p>
            </div>
        <?php endif; ?>

        <form method="post" action="" style="margin-top: 20px;">
            <?php wp_nonce_field( 'wakalumi_brosur_save', 'wakalumi_brosur_nonce' ); ?>

            <!-- KARTU 1: BROSUR UTAMA (NAVBAR DOWNLOAD) -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px; margin-bottom: 20px;">
                    <div>
                        <h2 style="font-size: 17px; font-weight: 700; margin: 0; color: #088395; display: flex; align-items: center; gap: 8px;">
                            <span>📥 Brosur Utama (Tautan Navbar & Menu Produk)</span>
                        </h2>
                        <p style="color: #64748b; font-size: 13px; margin: 4px 0 0 0;">
                            File PDF utama yang langsung diunduh ketika nasabah mengklik tombol <strong>"Download Brosur"</strong> di navbar atas.
                        </p>
                    </div>
                    <span style="background: #e0f2fe; color: #0369a1; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 9999px;">
                        Tautan Aktif Navbar
                    </span>
                </div>

                <div style="display: grid; grid-template-columns: 1fr; gap: 16px;">
                    <!-- URL File PDF Brosur -->
                    <div>
                        <label style="display: block; font-weight: bold; margin-bottom: 6px;">File Brosur Resmi (PDF atau Dokumen) *</label>
                        <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                            <input type="text" id="options_brosur_file_url" name="options_brosur_file_url" value="<?php echo esc_attr( $brosur_file_url ); ?>" class="large-text" placeholder="https://.../brosur-wakalumi.pdf" style="flex: 1; min-width: 260px;">
                            <button type="button" class="button wkl-upload-doc-btn" data-target="options_brosur_file_url" style="display: inline-flex; align-items: center; gap: 6px; background: #088395; color: #fff; border-color: #066e7d;">
                                <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah / Pilih PDF
                            </button>
                            <?php if ( ! empty( $brosur_file_url ) ) : ?>
                                <a href="<?php echo esc_url( $brosur_file_url ); ?>" target="_blank" class="button button-secondary" style="display: inline-flex; align-items: center; gap: 4px;">
                                    <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px;"></span> Pratinjau File
                                </a>
                            <?php endif; ?>
                        </div>
                        <p class="description" style="font-size: 12px; margin-top: 4px;">
                            Klik "Unggah / Pilih PDF" untuk memilih file dari Media Library WordPress, atau tempel URL link file PDF langsung.
                        </p>
                    </div>

                    <!-- Grid Baris: Nama File & Label Ukuran -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Judul / Nama File Brosur</label>
                            <input type="text" name="options_brosur_file_name" value="<?php echo esc_attr( $brosur_file_name ); ?>" class="large-text" placeholder="Brosur Resmi BPRS Wakalumi (Edisi 2026)">
                        </div>
                        <div>
                            <label style="display: block; font-weight: bold; margin-bottom: 6px;">Label Tag Ukuran / Status</label>
                            <input type="text" name="options_brosur_file_size" value="<?php echo esc_attr( $brosur_file_size ); ?>" class="large-text" placeholder="PDF Resmi • Edisi Terkini">
                        </div>
                    </div>

                    <!-- Gambar Cover / Thumbnail Brosur (Opsional) -->
                    <div>
                        <label style="display: block; font-weight: bold; margin-bottom: 6px;">Gambar Sampul / Thumbnail Brosur (Opsional)</label>
                        <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                            <img id="brosur_cover_prev" src="<?php echo esc_url( $brosur_cover ); ?>" style="max-width: 90px; max-height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid #cbd5e1; <?php echo empty( $brosur_cover ) ? 'display:none;' : ''; ?>" />
                            <div style="flex: 1; min-width: 240px;">
                                <input type="text" id="options_brosur_cover" name="options_brosur_cover" value="<?php echo esc_attr( $brosur_cover ); ?>" class="large-text" placeholder="https://.../cover-brosur.jpg" style="margin-bottom: 6px;">
                                <div style="display: flex; gap: 8px;">
                                    <button type="button" class="button wkl-upload-img-btn" data-target="options_brosur_cover" data-preview="brosur_cover_prev">
                                        <span class="dashicons dashicons-format-image"></span> Unggah Cover
                                    </button>
                                    <button type="button" class="button-link wkl-remove-btn" data-target="options_brosur_cover" data-preview="brosur_cover_prev" style="color: #ef4444; text-decoration: none; <?php echo empty( $brosur_cover ) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus Cover
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Brosur -->
                    <div>
                        <label style="display: block; font-weight: bold; margin-bottom: 6px;">Deskripsi Singkat Brosur</label>
                        <textarea name="options_brosur_desc" rows="2" class="large-text" placeholder="Panduan lengkap seluruh produk simpanan, deposito syariah, dan pembiayaan..."><?php echo esc_textarea( $brosur_desc ); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- KARTU 2: BROSUR SPESIFIK LAINNYA (REPEATER) -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px; margin-bottom: 20px;">
                    <div>
                        <h2 style="font-size: 17px; font-weight: 700; margin: 0; color: #088395;">
                            📚 Koleksi Brosur Kategori Produk Spesifik
                        </h2>
                        <p style="color: #64748b; font-size: 13px; margin: 4px 0 0 0;">
                            Brosur per kategori produk (contoh: Brosur Khusus Tabungan, Brosur Pembiayaan 1000 Pedagang/Guru) yang dapat ditampilkan di halaman produk masing-masing.
                        </p>
                    </div>
                    <button type="button" id="wkl-add-brosur" class="button" style="background: #f1f5f9; color: #0f172a; font-weight: 600; border-color: #cbd5e1; display: inline-flex; align-items: center; gap: 4px;">
                        <span class="dashicons dashicons-plus-alt2" style="color: #088395;"></span> Tambah Brosur
                    </button>
                </div>

                <div id="wkl-brosur-container" style="display: flex; flex-direction: column; gap: 16px;">
                    <?php foreach ( $brosur_list as $index => $item ) : 
                        $title     = $item['title'] ?? '';
                        $kategori  = $item['kategori'] ?? 'Penghimpunan Dana';
                        $file_url  = $item['file_url'] ?? '';
                        $cover     = $item['cover'] ?? '';
                        $desc      = $item['desc'] ?? '';
                        $urutan    = $item['urutan'] ?? ( $index + 1 );
                        $unique_id = 'brosur_' . $index;
                    ?>
                        <div class="brosur-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #088395; border-radius: 8px; padding: 18px; position: relative;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                <span style="font-weight: 700; color: #334155; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                                    <span class="dashicons dashicons-media-document" style="color: #088395;"></span>
                                    Brosur #<?php echo ( $index + 1 ); ?>
                                </span>
                                <button type="button" class="wkl-delete-brosur button-link" style="color: #ef4444; font-size: 12px; text-decoration: none;">
                                    ✕ Hapus Brosur
                                </button>
                            </div>

                            <div style="display: grid; grid-template-columns: 2fr 1fr 100px; gap: 12px; margin-bottom: 12px;">
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px;">Judul Brosur</label>
                                    <input type="text" name="brosur_list_title[]" value="<?php echo esc_attr( $title ); ?>" class="large-text" placeholder="Contoh: Brosur Tabungan & Deposito">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px;">Kategori</label>
                                    <select name="brosur_list_kategori[]" class="large-text">
                                        <option value="Penghimpunan Dana" <?php selected( $kategori, 'Penghimpunan Dana' ); ?>>Penghimpunan Dana (Tabungan/Deposito)</option>
                                        <option value="Penyaluran Dana" <?php selected( $kategori, 'Penyaluran Dana' ); ?>>Penyaluran Dana (Pembiayaan)</option>
                                        <option value="Program Khusus" <?php selected( $kategori, 'Program Khusus' ); ?>>Program Khusus (1000 Pedagang/Guru)</option>
                                        <option value="Laporan & Publikasi" <?php selected( $kategori, 'Laporan & Publikasi' ); ?>>Laporan & Publikasi</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px;">Urutan</label>
                                    <input type="number" name="brosur_list_urutan[]" value="<?php echo esc_attr( $urutan ); ?>" class="large-text" style="text-align: center;">
                                </div>
                            </div>

                            <div>
                                <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px;">File PDF Dokumen</label>
                                <div class="wkl-upload-wrap" style="display: flex; gap: 8px;">
                                    <input type="text" id="file_<?php echo esc_attr( $unique_id ); ?>" name="brosur_list_file_url[]" value="<?php echo esc_attr( $file_url ); ?>" class="large-text" placeholder="https://.../file.pdf">
                                    <button type="button" class="button wkl-upload-doc-btn" data-target="file_<?php echo esc_attr( $unique_id ); ?>">
                                        <span class="dashicons dashicons-upload"></span> Pilih File
                                    </button>
                                </div>
                            </div>

                            <div style="margin-top: 10px;">
                                <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px;">Keterangan Ringkas</label>
                                <textarea name="brosur_list_desc[]" rows="2" class="large-text" placeholder="Penjelasan singkat isi brosur..."><?php echo esc_textarea( $desc ); ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- SUBMIT BUTTON -->
            <div style="margin-top: 24px;">
                <input type="submit" name="wakalumi_brosur_submit" value="Simpan Pengaturan Brosur" class="button button-primary button-hero" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 30px;">
            </div>
        </form>
    </div>

    <!-- Template JS untuk Tambah Brosur Baru -->
    <script type="text/template" id="tmpl-brosur-card">
        <div class="brosur-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #088395; border-radius: 8px; padding: 18px; position: relative;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <span style="font-weight: 700; color: #334155; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                    <span class="dashicons dashicons-media-document" style="color: #088395;"></span>
                    Brosur Baru
                </span>
                <button type="button" class="wkl-delete-brosur button-link" style="color: #ef4444; font-size: 12px; text-decoration: none;">
                    ✕ Hapus Brosur
                </button>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr 100px; gap: 12px; margin-bottom: 12px;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px;">Judul Brosur</label>
                    <input type="text" name="brosur_list_title[]" value="" class="large-text" placeholder="Contoh: Brosur Tabungan...">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px;">Kategori</label>
                    <select name="brosur_list_kategori[]" class="large-text">
                        <option value="Penghimpunan Dana">Penghimpunan Dana (Tabungan/Deposito)</option>
                        <option value="Penyaluran Dana">Penyaluran Dana (Pembiayaan)</option>
                        <option value="Program Khusus">Program Khusus (1000 Pedagang/Guru)</option>
                        <option value="Laporan & Publikasi">Laporan & Publikasi</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px;">Urutan</label>
                    <input type="number" name="brosur_list_urutan[]" value="{{order}}" class="large-text" style="text-align: center;">
                </div>
            </div>

            <div>
                <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px;">File PDF Dokumen</label>
                <div class="wkl-upload-wrap" style="display: flex; gap: 8px;">
                    <input type="text" id="file_{{id}}" name="brosur_list_file_url[]" value="" class="large-text" placeholder="https://.../file.pdf">
                    <button type="button" class="button wkl-upload-doc-btn" data-target="file_{{id}}">
                        <span class="dashicons dashicons-upload"></span> Pilih File
                    </button>
                </div>
            </div>

            <div style="margin-top: 10px;">
                <label style="display: block; font-size: 12px; font-weight: bold; margin-bottom: 4px;">Keterangan Ringkas</label>
                <textarea name="brosur_list_desc[]" rows="2" class="large-text" placeholder="Penjelasan singkat isi brosur..."></textarea>
            </div>
        </div>
    </script>

    <!-- Admin JS for Brosur WP Media Uploader -->
    <script>
    jQuery(document).ready(function($) {
        var container = $('#wkl-brosur-container');
        var template  = $('#tmpl-brosur-card').html();

        // 1. Tambah Brosur Baru
        $('#wkl-add-brosur').on('click', function(e) {
            e.preventDefault();
            var uniqueId = 'new_' + new Date().getTime();
            var count = container.find('.brosur-card').length + 1;
            var html = template.replace(/{{id}}/g, uniqueId).replace(/{{order}}/g, count);
            container.append(html);
        });

        // 2. Hapus Brosur
        container.on('click', '.wkl-delete-brosur', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus brosur ini?')) {
                $(this).closest('.brosur-card').fadeOut(250, function() {
                    $(this).remove();
                });
            }
        });

        // 3. WP Media Upload untuk Dokumen PDF
        $(document).on('click', '.wkl-upload-doc-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $('#' + btn.data('target'));

            var docFrame = wp.media({
                title: 'Pilih atau Unggah Dokumen Brosur Resmi (PDF)',
                button: { text: 'Gunakan Dokumen Ini' },
                multiple: false
            });

            docFrame.on('select', function() {
                var attachment = docFrame.state().get('selection').first().toJSON();
                targetInput.val(attachment.url).trigger('change');
            });

            docFrame.open();
        });

        // 4. WP Media Upload untuk Gambar Cover
        $(document).on('click', '.wkl-upload-img-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $('#' + btn.data('target'));
            var previewImg  = $('#' + btn.data('preview'));

            var imgFrame = wp.media({
                title: 'Pilih Gambar Cover Brosur',
                button: { text: 'Gunakan Cover Ini' },
                multiple: false,
                library: { type: 'image' }
            });

            imgFrame.on('select', function() {
                var attachment = imgFrame.state().get('selection').first().toJSON();
                targetInput.val(attachment.url).trigger('change');
                if (previewImg.length) {
                    previewImg.attr('src', attachment.url).show();
                }
                btn.siblings('.wkl-remove-btn').show();
            });

            imgFrame.open();
        });

        // 5. Hapus Gambar Cover
        $(document).on('click', '.wkl-remove-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetInput = $('#' + btn.data('target'));
            var previewImg  = $('#' + btn.data('preview'));

            targetInput.val('').trigger('change');
            if (previewImg.length) {
                previewImg.attr('src', '').hide();
            }
            btn.hide();
        });
    });
    </script>
    <?php
}

