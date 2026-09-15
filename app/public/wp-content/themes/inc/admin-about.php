<?php
/**
 * Admin Panel: Profil & Tentang Kami
 *
 * Mengelola konten halaman Profil: Tentang Kami (Visi, Misi, Sejarah, Budaya Kerja, Makna Logo)
 * 100% Free tanpa ketergantungan plugin berbayar.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Registrasi Submenu di bawah "Pengaturan Website"
 */
function wakalumi_register_about_admin_menu() {
    add_submenu_page(
        'wakalumi-settings',
        'Profil: Tentang Kami & Visi Misi',
        'Profil: Tentang Kami',
        'manage_options',
        'wakalumi-about',
        'wakalumi_render_about_admin_page'
    );
}
add_action( 'admin_menu', 'wakalumi_register_about_admin_menu', 20 );

/**
 * Render Halaman Admin Profil: Tentang Kami
 */
function wakalumi_render_about_admin_page() {
    // ── PROSES SIMPAN DATA ──────────────────────────────────────────
    if ( isset( $_POST['wakalumi_save_about'] ) && check_admin_referer( 'wakalumi_about_nonce' ) ) {
        // 1. Header Banner
        update_option( 'options_about_page_badge', sanitize_text_field( $_POST['options_about_page_badge'] ?? '' ) );
        update_option( 'options_about_page_title', sanitize_text_field( $_POST['options_about_page_title'] ?? '' ) );
        update_option( 'options_about_page_subtitle', sanitize_textarea_field( $_POST['options_about_page_subtitle'] ?? '' ) );

        // 2. Sekilas Perusahaan & Sejarah
        update_option( 'options_about_page_sec_badge', sanitize_text_field( $_POST['options_about_page_sec_badge'] ?? '' ) );
        update_option( 'options_about_page_sec_title', sanitize_text_field( $_POST['options_about_page_sec_title'] ?? '' ) );
        update_option( 'options_about_page_narrative_1', wp_kses_post( $_POST['options_about_page_narrative_1'] ?? '' ) );
        update_option( 'options_about_page_narrative_2', wp_kses_post( $_POST['options_about_page_narrative_2'] ?? '' ) );
        update_option( 'options_about_page_image', esc_url_raw( $_POST['options_about_page_image'] ?? '' ) );

        // 4 Statistik
        for ( $s = 1; $s <= 4; $s++ ) {
            update_option( "options_about_page_stat_{$s}_val", sanitize_text_field( $_POST["options_about_page_stat_{$s}_val"] ?? '' ) );
            update_option( "options_about_page_stat_{$s}_lbl", sanitize_text_field( $_POST["options_about_page_stat_{$s}_lbl"] ?? '' ) );
        }

        // 3. Visi
        update_option( 'options_about_page_vision_badge', sanitize_text_field( $_POST['options_about_page_vision_badge'] ?? '' ) );
        update_option( 'options_about_page_vision_title', sanitize_textarea_field( $_POST['options_about_page_vision_title'] ?? '' ) );
        update_option( 'options_about_page_vision_desc', sanitize_textarea_field( $_POST['options_about_page_vision_desc'] ?? '' ) );

        // Misi Repeater
        $raw_missions = $_POST['about_missions'] ?? [];
        $clean_missions = [];
        if ( is_array( $raw_missions ) ) {
            foreach ( $raw_missions as $m_text ) {
                $trimmed = sanitize_textarea_field( $m_text );
                if ( ! empty( $trimmed ) ) {
                    $clean_missions[] = $trimmed;
                }
            }
        }
        update_option( 'options_about_page_missions', $clean_missions );

        // Jati Diri & ISHLAH
        update_option( 'options_about_page_identity', sanitize_textarea_field( $_POST['options_about_page_identity'] ?? '' ) );
        update_option( 'options_about_page_belief', sanitize_textarea_field( $_POST['options_about_page_belief'] ?? '' ) );

        // 4. Nilai Budaya (Core Values) Repeater
        $raw_v_acronym = $_POST['about_val_acronym'] ?? [];
        $raw_v_title   = $_POST['about_val_title'] ?? [];
        $raw_v_desc    = $_POST['about_val_desc'] ?? [];
        $clean_values  = [];
        for ( $v = 0; $v < count( $raw_v_title ); $v++ ) {
            $t = sanitize_text_field( $raw_v_title[$v] ?? '' );
            $a = sanitize_text_field( $raw_v_acronym[$v] ?? '' );
            $d = sanitize_textarea_field( $raw_v_desc[$v] ?? '' );
            if ( ! empty( $t ) || ! empty( $a ) ) {
                $clean_values[] = [ 'acronym' => $a, 'title' => $t, 'desc' => $d ];
            }
        }
        update_option( 'options_about_page_values', $clean_values );

        // 5. Makna Logo
        update_option( 'options_about_page_logo_img', esc_url_raw( $_POST['options_about_page_logo_img'] ?? '' ) );
        update_option( 'options_about_page_logo_desc', sanitize_textarea_field( $_POST['options_about_page_logo_desc'] ?? '' ) );
        for ( $lp = 1; $lp <= 3; $lp++ ) {
            update_option( "options_about_page_logo_p{$lp}_title", sanitize_text_field( $_POST["options_about_page_logo_p{$lp}_title"] ?? '' ) );
            update_option( "options_about_page_logo_p{$lp}_desc", sanitize_textarea_field( $_POST["options_about_page_logo_p{$lp}_desc"] ?? '' ) );
        }

        // 6. Banner Ajakan Bertindak (Call to Action)
        update_option( 'options_about_page_cta_badge', sanitize_text_field( $_POST['options_about_page_cta_badge'] ?? '' ) );
        update_option( 'options_about_page_cta_title', sanitize_text_field( $_POST['options_about_page_cta_title'] ?? '' ) );
        update_option( 'options_about_page_cta_desc', sanitize_textarea_field( $_POST['options_about_page_cta_desc'] ?? '' ) );
        update_option( 'options_about_page_cta_btn1_text', sanitize_text_field( $_POST['options_about_page_cta_btn1_text'] ?? '' ) );
        update_option( 'options_about_page_cta_btn1_url', esc_url_raw( $_POST['options_about_page_cta_btn1_url'] ?? '' ) );
        update_option( 'options_about_page_cta_btn2_text', sanitize_text_field( $_POST['options_about_page_cta_btn2_text'] ?? '' ) );
        update_option( 'options_about_page_cta_btn2_url', esc_url_raw( $_POST['options_about_page_cta_btn2_url'] ?? '' ) );

        // 7. Saklar Tampilan
        update_option( 'options_about_page_show_stats', isset( $_POST['options_about_page_show_stats'] ) ? '1' : '0' );
        update_option( 'options_about_page_show_vision', isset( $_POST['options_about_page_show_vision'] ) ? '1' : '0' );
        update_option( 'options_about_page_show_values', isset( $_POST['options_about_page_show_values'] ) ? '1' : '0' );
        update_option( 'options_about_page_show_logo', isset( $_POST['options_about_page_show_logo'] ) ? '1' : '0' );
        update_option( 'options_about_page_show_cta', isset( $_POST['options_about_page_show_cta'] ) ? '1' : '0' );

        echo '<div class="notice notice-success is-dismissible"><p><strong>Pengaturan Halaman Profil: Tentang Kami berhasil disimpan!</strong></p></div>';
    }

    // ── AMBIL DATA DENGAN DEFAULT VALUE FORMAL ──────────────────────
    $page_badge     = get_option( 'options_about_page_badge', 'Profil Perusahaan' );
    $page_title     = get_option( 'options_about_page_title', 'Mengenal Lebih Dekat BPRS Wakalumi' );
    $page_subtitle  = get_option( 'options_about_page_subtitle', 'Membangun kualitas hidup berkah sesuai Syariah — Lembaga keuangan syariah yang fokus pada jasa keuangan dan pemberdayaan ekonomi umat serta UMKM.' );

    $sec_badge      = get_option( 'options_about_page_sec_badge', 'Sekilas Perusahaan' );
    $sec_title      = get_option( 'options_about_page_sec_title', 'Tumbuh Bersama Umat, Melayani Sepenuh Hati' );
    $narrative_1    = get_option( 'options_about_page_narrative_1', 'PT Bank Perekonomian Rakyat Syariah (BPRS) Wakalumi didirikan oleh Yayasan Wakalumi (Wakaf Karyawan dan Alumni Muslim Citibank) berdasarkan Akta Notaris Ny. Siti Pertiwi Henny Shidki, SH Nomor 59 tanggal 7 Oktober 1989 dan mendapatkan pengesahan Menteri Kehakiman RI tanggal 13 Januari 1990. BPRS Wakalumi memulai aktivitas operasi perbankan pada tanggal 1 Mei 1992, dan resmi dikonversi menjadi Bank Pembiayaan Rakyat Syariah pada tahun 1995 berlandaskan UU Nomor 7 Tahun 1992.' );
    $narrative_2    = get_option( 'options_about_page_narrative_2', 'BPRS Wakalumi senantiasa berpegang teguh pada komitmen ISHLAH—terus melakukan perbaikan berkelanjutan demi kemaslahatan bersama. Kami menghimpun dana dari masyarakat dalam bentuk deposito berjangka dan tabungan syariah, memberikan pembiayaan bagi pengusaha kecil, mikro, maupun masyarakat umum, serta aktif memfasilitasi literasi ekonomi syariah dan pembinaan Bank Mini di sekolah-sekolah.' );
    $about_img      = get_option( 'options_about_page_image', get_template_directory_uri() . '/assets/img/about-photo.jpg' );

    $stat_1_val     = get_option( 'options_about_page_stat_1_val', '35+' );
    $stat_1_lbl     = get_option( 'options_about_page_stat_1_lbl', 'Tahun Pengalaman (1989)' );
    $stat_2_val     = get_option( 'options_about_page_stat_2_val', '10.000+' );
    $stat_2_lbl     = get_option( 'options_about_page_stat_2_lbl', 'Nasabah Setia' );
    $stat_3_val     = get_option( 'options_about_page_stat_3_val', '100%' );
    $stat_3_lbl     = get_option( 'options_about_page_stat_3_lbl', 'Prinsip Murni Syariah' );
    $stat_4_val     = get_option( 'options_about_page_stat_4_val', 'Rp2 Miliar' );
    $stat_4_lbl     = get_option( 'options_about_page_stat_4_lbl', 'Dijamin LPS per Nasabah' );

    $vision_badge   = get_option( 'options_about_page_vision_badge', 'Visi Perusahaan' );
    $vision_title   = get_option( 'options_about_page_vision_title', 'Menjadi BPR Syariah yang sehat, besar dan bermanfaat bagi umat' );
    $vision_desc    = get_option( 'options_about_page_vision_desc', '“Menjadikan BPRS Wakalumi ibarat sebuah pohon yang memiliki akar dan batang yang kuat, daun yang lebat dan buah yang manis”' );

    $missions       = get_option( 'options_about_page_missions', [] );
    if ( empty( $missions ) ) {
        $missions = [
            'Memberdayakan ekonomi umat dengan fokus usaha mikro, kecil dan menengah.',
            'Memberikan layanan prima dan amanah bagi nasabah.',
            'Menjalankan fungsi inklusi dan literasi ekonomi syariah bagi masyarakat.',
            'Memberikan manfaat optimal bagi para stakeholder.',
            'Membangun sistem dan tata kerja yang unggul dengan sumber daya insani yang professional, kompeten, handal dan menjunjung tinggi ukhuwah islamiyah.',
        ];
    }

    $identity_text  = get_option( 'options_about_page_identity', 'BPRS Wakalumi adalah Lembaga Keuangan Syariah yang memiliki fokus pada jasa keuangan dan pemberdayaan ekonomi umat dan masyarakat sesuai syariah.' );
    $belief_text    = get_option( 'options_about_page_belief', 'BPRS Wakalumi berkomitmen untuk selalu melakukan ISHLAH, yakni kami terus melakukan perbaikan berkelanjutan.' );

    $values = get_option( 'options_about_page_values', [] );
    if ( empty( $values ) ) {
        $values = [
            [ 'acronym' => 'S', 'title' => 'Skill', 'desc' => 'Selalu mengasah kompetensi agar dapat menciptakan peluang' ],
            [ 'acronym' => 'A', 'title' => 'Action', 'desc' => 'Melakukan tindakan profesional yang penuh tanggungjawab' ],
            [ 'acronym' => 'P', 'title' => 'Pray', 'desc' => 'Menghadirkan Allah dalam setiap aktifitas kerja, ibadah dan doa yang penuh nilai kebaikan' ],
            [ 'acronym' => 'A', 'title' => 'Attitude', 'desc' => 'Memiliki sikap dan prilaku positif yang memberi warna kebaikan' ],
        ];
    }

    $logo_img       = get_option( 'options_about_page_logo_img', get_template_directory_uri() . '/assets/img/logo-new-1.png' );
    $logo_desc      = get_option( 'options_about_page_logo_desc', 'Logo BPRS Wakalumi merefleksikan identitas perbankan syariah yang dinamis, bersih, dan berakar pada nilai-nilai keislaman universal.' );

    $logo_p1_title  = get_option( 'options_about_page_logo_p1_title', 'Bentuk Gelombang & Aliran Berkah' );
    $logo_p1_desc   = get_option( 'options_about_page_logo_p1_desc', 'Melambangkan kelancaran aliran rezeki, fleksibilitas dalam melayani, serta kesegaran solusi finansial yang menyejukkan perekonomian umat.' );
    $logo_p2_title  = get_option( 'options_about_page_logo_p2_title', 'Warna Ocean Teal & Bright Teal' );
    $logo_p2_desc   = get_option( 'options_about_page_logo_p2_desc', 'Merefleksikan ketenangan, stabilitas finansial yang kokoh, profesionalisme modern, serta komitmen menjaga amanah nasabah.' );
    $logo_p3_title  = get_option( 'options_about_page_logo_p3_title', 'Aksen Mint Glow' );
    $logo_p3_desc   = get_option( 'options_about_page_logo_p3_desc', 'Melambangkan pertumbuhan ekonomi yang berkah, harapan baru bagi UMKM, dan masa depan perbankan syariah yang gemilang.' );

    $cta_badge      = get_option( 'options_about_page_cta_badge', 'Langkah Nyata Bersama Kami' );
    $cta_title      = get_option( 'options_about_page_cta_title', 'Siap Mengembangkan Usaha & Mengelola Dana Secara Berkah?' );
    $cta_desc       = get_option( 'options_about_page_cta_desc', 'Konsultasikan kebutuhan perbankan syariah Anda bersama tim profesional BPRS Wakalumi, atau temukan solusi simpanan dan pembiayaan yang tepat untuk masa depan finansial Anda.' );
    $cta_btn1_text  = get_option( 'options_about_page_cta_btn1_text', 'Hubungi via WhatsApp' );
    $cta_btn1_url   = get_option( 'options_about_page_cta_btn1_url', '' );
    $cta_btn2_text  = get_option( 'options_about_page_cta_btn2_text', 'Jelajahi Produk Kami' );
    $cta_btn2_url   = get_option( 'options_about_page_cta_btn2_url', home_url( '/produk' ) );

    $show_stats     = get_option( 'options_about_page_show_stats', '1' );
    $show_vision    = get_option( 'options_about_page_show_vision', '1' );
    $show_values    = get_option( 'options_about_page_show_values', '1' );
    $show_logo      = get_option( 'options_about_page_show_logo', '1' );
    $show_cta       = get_option( 'options_about_page_show_cta', '1' );

    $public_url     = home_url( '/profil/tentang-kami' );
    ?>
    <div class="wrap" style="max-width: 950px; margin-top: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
            <div>
                <h1 style="font-size: 24px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;">🏛️ Profil Perusahaan: Tentang Kami</h1>
                <p style="color: #64748b; margin: 0; font-size: 13px;">Kelola narasi sejarah, visi, misi, nilai budaya kerja, dan filosofi logo di halaman <a href="<?php echo esc_url( $public_url ); ?>" target="_blank" style="color: #088395; font-weight: 600; text-decoration: none;">/profil/tentang-kami ↗</a></p>
            </div>
            <a href="<?php echo esc_url( $public_url ); ?>" target="_blank" class="button" style="display: inline-flex; align-items: center; gap: 6px; border-color: #088395; color: #088395; font-weight: 600;">
                <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px;"></span> Pratinjau Halaman Publik
            </a>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field( 'wakalumi_about_nonce' ); ?>

            <!-- ── SECTION 1: HEADER BANNER ──────────────────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-welcome-widgets-menus"></span> 1. Header Banner Halaman
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_about_page_badge">Label Kicker (Badge)</label></th>
                        <td>
                            <input type="text" id="options_about_page_badge" name="options_about_page_badge" value="<?php echo esc_attr( $page_badge ); ?>" class="regular-text" style="width: 100%;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_title">Judul Utama Halaman</label></th>
                        <td>
                            <input type="text" id="options_about_page_title" name="options_about_page_title" value="<?php echo esc_attr( $page_title ); ?>" class="large-text" style="font-weight: 600;">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_subtitle">Sub-Judul / Tagline</label></th>
                        <td>
                            <textarea id="options_about_page_subtitle" name="options_about_page_subtitle" rows="2" class="large-text"><?php echo esc_textarea( $page_subtitle ); ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── SECTION 2: SEKILAS PERUSAHAAN & SEJARAH ────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-building"></span> 2. Sekilas Perusahaan, Sejarah & Foto Representatif
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_about_page_sec_badge">Sub-Label</label></th>
                        <td>
                            <input type="text" id="options_about_page_sec_badge" name="options_about_page_sec_badge" value="<?php echo esc_attr( $sec_badge ); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_sec_title">Headline Seksi</label></th>
                        <td>
                            <input type="text" id="options_about_page_sec_title" name="options_about_page_sec_title" value="<?php echo esc_attr( $sec_title ); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_narrative_1">Narasi Paragraf 1</label></th>
                        <td>
                            <textarea id="options_about_page_narrative_1" name="options_about_page_narrative_1" rows="4" class="large-text"><?php echo esc_textarea( $narrative_1 ); ?></textarea>
                            <p class="description">Uraikan latar belakang pendirian bank, nilai syariah, dan komitmen pelayanan.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_narrative_2">Narasi Paragraf 2</label></th>
                        <td>
                            <textarea id="options_about_page_narrative_2" name="options_about_page_narrative_2" rows="4" class="large-text"><?php echo esc_textarea( $narrative_2 ); ?></textarea>
                            <p class="description">Uraikan transformasi, pencapaian, dan jangkauan wilayah operasional saat ini.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label>Foto Gedung / Kantor</label></th>
                        <td>
                            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                <img id="about_page_img_preview" src="<?php echo esc_url( $about_img ); ?>" style="max-width: 140px; max-height: 95px; border-radius: 8px; border: 1px solid #e2e8f0; object-fit: cover; <?php echo empty( $about_img ) ? 'display:none;' : ''; ?>" />
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <button type="button" class="button wkl-upload-btn" data-target="options_about_page_image" data-preview="about_page_img_preview" style="display: inline-flex; align-items: center; gap: 5px;">
                                        <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Foto Kantor
                                    </button>
                                    <button type="button" class="button-link wkl-remove-btn" data-target="options_about_page_image" data-preview="about_page_img_preview" style="color: #ef4444; font-size: 12px; <?php echo empty( $about_img ) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus Foto
                                    </button>
                                </div>
                                <input type="text" id="options_about_page_image" name="options_about_page_image" value="<?php echo esc_attr( $about_img ); ?>" class="regular-text" placeholder="...atau tempel URL gambar" style="flex: 1; min-width: 220px;">
                            </div>
                            <p class="description" style="margin-top: 6px;">Rekomendasi: Format JPG/WebP landscape, resolusi minimal 1200×800 px.</p>
                        </td>
                    </tr>
                </table>

                <h3 style="font-size: 14px; margin: 25px 0 12px 0; padding-bottom: 6px; border-bottom: 1px dashed #e2e8f0; color: #334155;">
                    📊 4 Indikator Statistik Kunci
                </h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                    <?php for ( $s = 1; $s <= 4; $s++ ) : 
                        $val = ${"stat_{$s}_val"};
                        $lbl = ${"stat_{$s}_lbl"};
                    ?>
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                            <label style="display: block; font-size: 11px; font-weight: 700; color: #088395; text-transform: uppercase; margin-bottom: 6px;">Statistik #<?php echo $s; ?></label>
                            <input type="text" name="options_about_page_stat_<?php echo $s; ?>_val" value="<?php echo esc_attr( $val ); ?>" placeholder="Angka (misal: 30+)" style="width: 100%; margin-bottom: 6px; font-weight: 700;">
                            <input type="text" name="options_about_page_stat_<?php echo $s; ?>_lbl" value="<?php echo esc_attr( $lbl ); ?>" placeholder="Label (misal: Tahun Pengalaman)" style="width: 100%; font-size: 12px;">
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- ── SECTION 3: VISI & MISI PERUSAHAAN ──────────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-star-filled"></span> 3. Visi & Misi Strategis Perusahaan
                </h2>
                
                <h3 style="font-size: 14px; margin: 0 0 10px 0; color: #0f172a;">✨ Visi Utama</h3>
                <table class="form-table" role="presentation" style="margin-top: 0; margin-bottom: 20px;">
                    <tr>
                        <th scope="row" style="width: 180px;"><label for="options_about_page_vision_badge">Label Visi</label></th>
                        <td>
                            <input type="text" id="options_about_page_vision_badge" name="options_about_page_vision_badge" value="<?php echo esc_attr( $vision_badge ); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_vision_title">Pernyataan Visi</label></th>
                        <td>
                            <textarea id="options_about_page_vision_title" name="options_about_page_vision_title" rows="2" class="large-text" style="font-weight: 600;"><?php echo esc_textarea( $vision_title ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_vision_desc">Keterangan Tambahan Visi</label></th>
                        <td>
                            <textarea id="options_about_page_vision_desc" name="options_about_page_vision_desc" rows="2" class="large-text"><?php echo esc_textarea( $vision_desc ); ?></textarea>
                        </td>
                    </tr>
                </table>

                <h3 style="font-size: 14px; margin: 20px 0 10px 0; padding-top: 15px; border-top: 1px dashed #e2e8f0; color: #0f172a;">
                    🎯 Butir-Butir Misi (Tabel Dinamis)
                </h3>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 12px;">Anda dapat menambah atau mengurangi butir misi sesuai arah strategis bank.</p>
                
                <table class="widefat fixed striped" style="border-radius: 6px; overflow: hidden; margin-bottom: 12px;">
                    <thead>
                        <tr>
                            <th style="width: 60px; text-align: center;">No.</th>
                            <th>Uraian Misi Strategis</th>
                            <th style="width: 80px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="missions-tbody">
                        <?php foreach ( $missions as $m_idx => $m_item ) : ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle; font-weight: bold; color: #088395;">
                                    <?php echo sprintf( '%02d', $m_idx + 1 ); ?>
                                </td>
                                <td>
                                    <textarea name="about_missions[]" rows="2" class="large-text" style="width: 100%;"><?php echo esc_textarea( $m_item ); ?></textarea>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <button type="button" class="button button-link-delete wkl-del-row" style="color: #ef4444;" title="Hapus baris misi ini">✕ Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" id="btn-add-mission" class="button" style="display: inline-flex; align-items: center; gap: 5px;">
                    <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> + Tambah Butir Misi
                </button>

                <h3 style="font-size: 14px; margin: 25px 0 10px 0; color: #0f172a; font-weight: 700;">Jati Diri & Keyakinan Inti (Core Beliefs)</h3>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_about_page_identity">Jati Diri Perusahaan</label></th>
                        <td>
                            <textarea id="options_about_page_identity" name="options_about_page_identity" rows="2" class="large-text"><?php echo esc_textarea( $identity_text ); ?></textarea>
                            <p class="description">Contoh: BPRS Wakalumi adalah Lembaga Keuangan Syariah yang memiliki fokus pada jasa keuangan dan pemberdayaan ekonomi umat...</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_belief">Keyakinan Inti (ISHLAH)</label></th>
                        <td>
                            <textarea id="options_about_page_belief" name="options_about_page_belief" rows="2" class="large-text"><?php echo esc_textarea( $belief_text ); ?></textarea>
                            <p class="description">Komitmen perbaikan terus-menerus (ISHLAH) insan BPRS Wakalumi.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── SECTION 4: NILAI BUDAYA PERUSAHAAN (SAPA) ── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-heart"></span> 4. Budaya Kerja Perusahaan: SAPA (Skill, Action, Pray, Attitude)
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 15px;">Nilai-nilai budaya <strong>SAPA</strong> yang menghadirkan kebersamaan, kehangatan, dan keakraban untuk hasil optimal dalam aktivitas kerja.</p>

                <table class="widefat fixed striped" style="border-radius: 6px; overflow: hidden; margin-bottom: 12px;">
                    <thead>
                        <tr>
                            <th style="width: 70px; text-align: center;">Huruf</th>
                            <th style="width: 180px;">Nama Nilai</th>
                            <th>Uraian Makna Perilaku</th>
                            <th style="width: 80px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="values-tbody">
                        <?php foreach ( $values as $v_idx => $v_item ) : ?>
                            <tr>
                                <td style="text-align: center; vertical-align: top; padding-top: 10px;">
                                    <input type="text" name="about_val_acronym[]" value="<?php echo esc_attr( $v_item['acronym'] ?? '' ); ?>" maxlength="3" style="width: 50px; text-align: center; font-weight: bold; font-size: 16px; color: #088395;">
                                </td>
                                <td style="vertical-align: top; padding-top: 10px;">
                                    <input type="text" name="about_val_title[]" value="<?php echo esc_attr( $v_item['title'] ?? '' ); ?>" class="regular-text" style="width: 100%; font-weight: 600;">
                                </td>
                                <td>
                                    <textarea name="about_val_desc[]" rows="2" class="large-text" style="width: 100%;"><?php echo esc_textarea( $v_item['desc'] ?? '' ); ?></textarea>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <button type="button" class="button button-link-delete wkl-del-row" style="color: #ef4444;" title="Hapus nilai ini">✕ Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="button" id="btn-add-value" class="button" style="display: inline-flex; align-items: center; gap: 5px;">
                    <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> + Tambah Nilai Budaya
                </button>
            </div>

            <!-- ── SECTION 5: MAKNA & FILOSOFI LOGO ──────────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-art"></span> 5. Makna & Filosofi Logo Bank
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label>Gambar Logo</label></th>
                        <td>
                            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                <img id="about_page_logo_preview" src="<?php echo esc_url( $logo_img ); ?>" style="max-width: 140px; max-height: 70px; border-radius: 8px; border: 1px solid #e2e8f0; background: #0f172a; padding: 6px; object-fit: contain; <?php echo empty( $logo_img ) ? 'display:none;' : ''; ?>" />
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <button type="button" class="button wkl-upload-btn" data-target="options_about_page_logo_img" data-preview="about_page_logo_preview" style="display: inline-flex; align-items: center; gap: 5px;">
                                        <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Logo
                                    </button>
                                    <button type="button" class="button-link wkl-remove-btn" data-target="options_about_page_logo_img" data-preview="about_page_logo_preview" style="color: #ef4444; font-size: 12px; <?php echo empty( $logo_img ) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus
                                    </button>
                                </div>
                                <input type="text" id="options_about_page_logo_img" name="options_about_page_logo_img" value="<?php echo esc_attr( $logo_img ); ?>" class="regular-text" placeholder="...atau tempel URL logo" style="flex: 1; min-width: 220px;">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_logo_desc">Pengantar Makna Logo</label></th>
                        <td>
                            <textarea id="options_about_page_logo_desc" name="options_about_page_logo_desc" rows="2" class="large-text"><?php echo esc_textarea( $logo_desc ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Pilar Filosofi 1</th>
                        <td>
                            <input type="text" name="options_about_page_logo_p1_title" value="<?php echo esc_attr( $logo_p1_title ); ?>" class="large-text" style="font-weight: 600; margin-bottom: 5px;" placeholder="Judul Pilar 1">
                            <textarea name="options_about_page_logo_p1_desc" rows="2" class="large-text" placeholder="Uraian makna pilar 1"><?php echo esc_textarea( $logo_p1_desc ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Pilar Filosofi 2</th>
                        <td>
                            <input type="text" name="options_about_page_logo_p2_title" value="<?php echo esc_attr( $logo_p2_title ); ?>" class="large-text" style="font-weight: 600; margin-bottom: 5px;" placeholder="Judul Pilar 2">
                            <textarea name="options_about_page_logo_p2_desc" rows="2" class="large-text" placeholder="Uraian makna pilar 2"><?php echo esc_textarea( $logo_p2_desc ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Pilar Filosofi 3</th>
                        <td>
                            <input type="text" name="options_about_page_logo_p3_title" value="<?php echo esc_attr( $logo_p3_title ); ?>" class="large-text" style="font-weight: 600; margin-bottom: 5px;" placeholder="Judul Pilar 3">
                            <textarea name="options_about_page_logo_p3_desc" rows="2" class="large-text" placeholder="Uraian makna pilar 3"><?php echo esc_textarea( $logo_p3_desc ); ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── SECTION 6: AJAKAN BERTINDAK (CTA BANNER) ───────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-megaphone"></span> 6. Ajakan Bertindak (CTA Banner di Bawah Makna Logo)
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_about_page_cta_badge">Badge Kicker CTA</label></th>
                        <td>
                            <input type="text" id="options_about_page_cta_badge" name="options_about_page_cta_badge" value="<?php echo esc_attr( $cta_badge ); ?>" class="regular-text" placeholder="Langkah Nyata Bersama Kami">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_cta_title">Judul Banner CTA</label></th>
                        <td>
                            <input type="text" id="options_about_page_cta_title" name="options_about_page_cta_title" value="<?php echo esc_attr( $cta_title ); ?>" class="large-text" style="font-weight: 600;" placeholder="Siap Mengembangkan Usaha & Mengelola Dana Secara Berkah?">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_cta_desc">Uraian / Teks Ajakan</label></th>
                        <td>
                            <textarea id="options_about_page_cta_desc" name="options_about_page_cta_desc" rows="3" class="large-text"><?php echo esc_textarea( $cta_desc ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tombol Utama 1 (WhatsApp)</th>
                        <td>
                            <input type="text" name="options_about_page_cta_btn1_text" value="<?php echo esc_attr( $cta_btn1_text ); ?>" class="regular-text" placeholder="Hubungi via WhatsApp" style="margin-bottom: 5px;"><br>
                            <input type="text" name="options_about_page_cta_btn1_url" value="<?php echo esc_attr( $cta_btn1_url ); ?>" class="large-text" placeholder="https://wa.me/... (kosongkan untuk nomor WA default)">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tombol Sekunder 2 (Produk)</th>
                        <td>
                            <input type="text" name="options_about_page_cta_btn2_text" value="<?php echo esc_attr( $cta_btn2_text ); ?>" class="regular-text" placeholder="Jelajahi Produk Kami" style="margin-bottom: 5px;"><br>
                            <input type="text" name="options_about_page_cta_btn2_url" value="<?php echo esc_attr( $cta_btn2_url ); ?>" class="large-text" placeholder="<?php echo esc_url( home_url( '/produk' ) ); ?>">
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── SECTION 7: SAKLAR VISIBILITAS BAGIAN ───────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-visibility"></span> 7. Pengaturan Tampilan Bagian (Visibility)
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row">Tampilkan Bagian</th>
                        <td>
                            <fieldset style="display: flex; flex-direction: column; gap: 10px;">
                                <label><input type="checkbox" name="options_about_page_show_stats" value="1" <?php checked( $show_stats, '1' ); ?>> 4 Kotak Indikator Statistik Pengalaman</label>
                                <label><input type="checkbox" name="options_about_page_show_vision" value="1" <?php checked( $show_vision, '1' ); ?>> Seksi Visi & Misi Perusahaan</label>
                                <label><input type="checkbox" name="options_about_page_show_values" value="1" <?php checked( $show_values, '1' ); ?>> Seksi Nilai-Nilai Budaya Perusahaan (Core Values)</label>
                                <label><input type="checkbox" name="options_about_page_show_logo" value="1" <?php checked( $show_logo, '1' ); ?>> Seksi Makna & Filosofi Logo</label>
                                <label><input type="checkbox" name="options_about_page_show_cta" value="1" <?php checked( $show_cta, '1' ); ?>> Seksi Ajakan Bertindak (CTA Banner WhatsApp & Produk)</label>
                            </fieldset>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- SUBMIT BUTTON -->
            <div style="position: sticky; bottom: 20px; background: #ffffffeb; backdrop-filter: blur(8px); padding: 15px 25px; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between; z-index: 10;">
                <span style="font-size: 13px; color: #64748b;">Perubahan akan langsung tampil di halaman publik <code>/profil/tentang-kami</code></span>
                <input type="submit" name="wakalumi_save_about" class="button button-primary" value="💾 Simpan Perubahan Profil" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 6px 28px; font-size: 14px; height: auto;">
            </div>
        </form>
    </div>

    <!-- SCRIPT REPEATER MISI & NILAI BUDAYA -->
    <script>
    jQuery(document).ready(function($) {
        // Hapus Baris Repeater
        $(document).on('click', '.wkl-del-row', function(e) {
            e.preventDefault();
            var $tbody = $(this).closest('tbody');
            if ($tbody.children('tr').length > 1) {
                $(this).closest('tr').fadeOut(200, function() {
                    $(this).remove();
                    renumberMissions();
                });
            } else {
                alert('Minimal harus ada satu baris data.');
            }
        });

        // Tambah Baris Misi
        $('#btn-add-mission').on('click', function(e) {
            e.preventDefault();
            var count = $('#missions-tbody tr').length + 1;
            var numStr = ('0' + count).slice(-2);
            var rowHtml = '<tr>' +
                '<td style="text-align: center; vertical-align: middle; font-weight: bold; color: #088395;" class="m-num">' + numStr + '</td>' +
                '<td><textarea name="about_missions[]" rows="2" class="large-text" style="width: 100%;" placeholder="Tulis uraian butir misi di sini..."></textarea></td>' +
                '<td style="text-align: center; vertical-align: middle;"><button type="button" class="button button-link-delete wkl-del-row" style="color: #ef4444;">✕ Hapus</button></td>' +
                '</tr>';
            $('#missions-tbody').append(rowHtml);
        });

        function renumberMissions() {
            $('#missions-tbody tr').each(function(idx) {
                var numStr = ('0' + (idx + 1)).slice(-2);
                $(this).find('.m-num').text(numStr);
            });
        }

        // Tambah Baris Nilai Budaya
        $('#btn-add-value').on('click', function(e) {
            e.preventDefault();
            var rowHtml = '<tr>' +
                '<td style="text-align: center; vertical-align: top; padding-top: 10px;"><input type="text" name="about_val_acronym[]" value="" maxlength="3" style="width: 50px; text-align: center; font-weight: bold; font-size: 16px; color: #088395;" placeholder="A"></td>' +
                '<td style="vertical-align: top; padding-top: 10px;"><input type="text" name="about_val_title[]" value="" class="regular-text" style="width: 100%; font-weight: 600;" placeholder="Nama Nilai"></td>' +
                '<td><textarea name="about_val_desc[]" rows="2" class="large-text" style="width: 100%;" placeholder="Uraian makna perilaku..."></textarea></td>' +
                '<td style="text-align: center; vertical-align: middle;"><button type="button" class="button button-link-delete wkl-del-row" style="color: #ef4444;">✕ Hapus</button></td>' +
                '</tr>';
            $('#values-tbody').append(rowHtml);
        });
    });
    </script>
    <?php
}

