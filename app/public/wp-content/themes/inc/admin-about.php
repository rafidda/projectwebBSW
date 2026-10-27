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
    wp_enqueue_media();

    // ── PROSES SIMPAN DATA ──────────────────────────────────────────
    if ( isset( $_POST['wakalumi_save_about'] ) && check_admin_referer( 'wakalumi_about_nonce' ) ) {
        // 1. Header Banner & Hero Card
        update_option( 'options_about_page_badge', sanitize_text_field( $_POST['options_about_page_badge'] ?? '' ) );
        update_option( 'options_about_page_title', sanitize_text_field( $_POST['options_about_page_title'] ?? '' ) );
        update_option( 'options_about_page_subtitle', sanitize_textarea_field( $_POST['options_about_page_subtitle'] ?? '' ) );

        update_option( 'options_about_page_hero_pill_1', sanitize_text_field( $_POST['options_about_page_hero_pill_1'] ?? '' ) );
        update_option( 'options_about_page_hero_pill_2', sanitize_text_field( $_POST['options_about_page_hero_pill_2'] ?? '' ) );
        update_option( 'options_about_page_hero_pill_3', sanitize_text_field( $_POST['options_about_page_hero_pill_3'] ?? '' ) );

        update_option( 'options_about_page_hero_card_show', isset( $_POST['options_about_page_hero_card_show'] ) ? '1' : '0' );
        update_option( 'options_about_page_hero_card_logo', esc_url_raw( $_POST['options_about_page_hero_card_logo'] ?? '' ) );
        update_option( 'options_about_page_hero_card_badge', sanitize_text_field( $_POST['options_about_page_hero_card_badge'] ?? '' ) );
        update_option( 'options_about_page_hero_card_title', sanitize_text_field( $_POST['options_about_page_hero_card_title'] ?? '' ) );
        update_option( 'options_about_page_hero_card_desc', sanitize_textarea_field( $_POST['options_about_page_hero_card_desc'] ?? '' ) );
        update_option( 'options_about_page_hero_card_tag1', sanitize_text_field( $_POST['options_about_page_hero_card_tag1'] ?? '' ) );
        update_option( 'options_about_page_hero_card_tag2', sanitize_text_field( $_POST['options_about_page_hero_card_tag2'] ?? '' ) );

        // 2. Sekilas Perusahaan & Sejarah
        update_option( 'options_about_page_sec_badge', sanitize_text_field( $_POST['options_about_page_sec_badge'] ?? '' ) );
        update_option( 'options_about_page_sec_title', sanitize_text_field( $_POST['options_about_page_sec_title'] ?? '' ) );
        update_option( 'options_about_page_narrative_1', wp_kses_post( $_POST['options_about_page_narrative_1'] ?? '' ) );
        update_option( 'options_about_page_narrative_2', wp_kses_post( $_POST['options_about_page_narrative_2'] ?? '' ) );
        update_option( 'options_about_page_image', esc_url_raw( $_POST['options_about_page_image'] ?? '' ) );
        update_option( 'options_about_page_photo_label', sanitize_text_field( $_POST['options_about_page_photo_label'] ?? '' ) );
        update_option( 'options_about_page_photo_title', sanitize_text_field( $_POST['options_about_page_photo_title'] ?? '' ) );
        update_option( 'options_about_page_floating_title', sanitize_text_field( $_POST['options_about_page_floating_title'] ?? '' ) );
        update_option( 'options_about_page_floating_desc', sanitize_text_field( $_POST['options_about_page_floating_desc'] ?? '' ) );
        update_option( 'options_about_page_sec_btn1_text', sanitize_text_field( $_POST['options_about_page_sec_btn1_text'] ?? '' ) );
        update_option( 'options_about_page_sec_btn1_url', esc_url_raw( $_POST['options_about_page_sec_btn1_url'] ?? '' ) );
        update_option( 'options_about_page_sec_btn2_text', sanitize_text_field( $_POST['options_about_page_sec_btn2_text'] ?? '' ) );
        update_option( 'options_about_page_sec_btn2_url', esc_url_raw( $_POST['options_about_page_sec_btn2_url'] ?? '' ) );

        // 4 Statistik
        for ( $s = 1; $s <= 4; $s++ ) {
            update_option( "options_about_page_stat_{$s}_val", sanitize_text_field( $_POST["options_about_page_stat_{$s}_val"] ?? '' ) );
            update_option( "options_about_page_stat_{$s}_lbl", sanitize_text_field( $_POST["options_about_page_stat_{$s}_lbl"] ?? '' ) );
        }

        // 3. Visi & Misi Strategis
        update_option( 'options_about_page_vm_badge', sanitize_text_field( $_POST['options_about_page_vm_badge'] ?? '' ) );
        update_option( 'options_about_page_vm_title', sanitize_text_field( $_POST['options_about_page_vm_title'] ?? '' ) );
        update_option( 'options_about_page_vm_subtitle', sanitize_textarea_field( $_POST['options_about_page_vm_subtitle'] ?? '' ) );
        update_option( 'options_about_page_missions_heading', sanitize_text_field( $_POST['options_about_page_missions_heading'] ?? '' ) );

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
        update_option( 'options_about_page_identity_badge', sanitize_text_field( $_POST['options_about_page_identity_badge'] ?? '' ) );
        update_option( 'options_about_page_identity_tag', sanitize_text_field( $_POST['options_about_page_identity_tag'] ?? '' ) );
        update_option( 'options_about_page_identity_title', sanitize_text_field( $_POST['options_about_page_identity_title'] ?? '' ) );
        update_option( 'options_about_page_identity', sanitize_textarea_field( $_POST['options_about_page_identity'] ?? '' ) );

        update_option( 'options_about_page_belief_badge', sanitize_text_field( $_POST['options_about_page_belief_badge'] ?? '' ) );
        update_option( 'options_about_page_belief_tag', sanitize_text_field( $_POST['options_about_page_belief_tag'] ?? '' ) );
        update_option( 'options_about_page_belief_title', sanitize_text_field( $_POST['options_about_page_belief_title'] ?? '' ) );
        update_option( 'options_about_page_belief', sanitize_textarea_field( $_POST['options_about_page_belief'] ?? '' ) );

        // 4. Nilai Budaya (Core Values)
        update_option( 'options_about_page_values_badge', sanitize_text_field( $_POST['options_about_page_values_badge'] ?? '' ) );
        update_option( 'options_about_page_values_title', sanitize_text_field( $_POST['options_about_page_values_title'] ?? '' ) );
        update_option( 'options_about_page_values_desc', wp_kses_post( $_POST['options_about_page_values_desc'] ?? '' ) );
        update_option( 'options_about_page_values_tag', sanitize_text_field( $_POST['options_about_page_values_tag'] ?? '' ) );

        // Corporate Culture Visual Logo (Light & Dark Mode)
        update_option( 'options_about_page_culture_img_show', isset( $_POST['options_about_page_culture_img_show'] ) ? '1' : '0' );
        update_option( 'options_about_page_culture_img_light', esc_url_raw( $_POST['options_about_page_culture_img_light'] ?? '' ) );
        update_option( 'options_about_page_culture_img_dark', esc_url_raw( $_POST['options_about_page_culture_img_dark'] ?? '' ) );
        update_option( 'options_about_page_culture_caption', sanitize_text_field( $_POST['options_about_page_culture_caption'] ?? '' ) );
        update_option( 'options_about_page_culture_subcaption', sanitize_textarea_field( $_POST['options_about_page_culture_subcaption'] ?? '' ) );

        // Nilai Budaya Repeater
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
        update_option( 'options_about_page_logo_sec_badge', sanitize_text_field( $_POST['options_about_page_logo_sec_badge'] ?? '' ) );
        update_option( 'options_about_page_logo_sec_title', sanitize_text_field( $_POST['options_about_page_logo_sec_title'] ?? '' ) );
        update_option( 'options_about_page_logo_preview_badge', sanitize_text_field( $_POST['options_about_page_logo_preview_badge'] ?? '' ) );
        update_option( 'options_about_page_logo_preview_title', sanitize_text_field( $_POST['options_about_page_logo_preview_title'] ?? '' ) );
        update_option( 'options_about_page_logo_img', esc_url_raw( $_POST['options_about_page_logo_img'] ?? '' ) );
        update_option( 'options_about_page_logo_desc', sanitize_textarea_field( $_POST['options_about_page_logo_desc'] ?? '' ) );
        for ( $lp = 1; $lp <= 3; $lp++ ) {
            $default_lp_color = ( $lp === 2 ) ? 'blue' : ( ( $lp === 3 ) ? 'sky' : 'teal' );
            update_option( "options_about_page_logo_p{$lp}_title", sanitize_text_field( $_POST["options_about_page_logo_p{$lp}_title"] ?? '' ) );
            update_option( "options_about_page_logo_p{$lp}_desc", sanitize_textarea_field( $_POST["options_about_page_logo_p{$lp}_desc"] ?? '' ) );
            update_option( "options_about_page_logo_p{$lp}_color", sanitize_key( $_POST["options_about_page_logo_p{$lp}_color"] ?? $default_lp_color ) );
        }

        // 6. Dokumen Company Profile Resmi (Unduh PDF)
        update_option( 'options_about_page_compro_show', isset( $_POST['options_about_page_compro_show'] ) ? '1' : '0' );
        update_option( 'options_about_page_compro_badge', sanitize_text_field( $_POST['options_about_page_compro_badge'] ?? '' ) );
        update_option( 'options_about_page_compro_title', sanitize_text_field( $_POST['options_about_page_compro_title'] ?? '' ) );
        update_option( 'options_about_page_compro_desc', sanitize_textarea_field( $_POST['options_about_page_compro_desc'] ?? '' ) );
        update_option( 'options_about_page_compro_year', sanitize_text_field( $_POST['options_about_page_compro_year'] ?? '' ) );
        update_option( 'options_about_page_compro_file', esc_url_raw( $_POST['options_about_page_compro_file'] ?? '' ) );
        update_option( 'options_about_page_compro_cover', esc_url_raw( $_POST['options_about_page_compro_cover'] ?? '' ) );
        update_option( 'options_about_page_compro_filesize', sanitize_text_field( $_POST['options_about_page_compro_filesize'] ?? '' ) );
        update_option( 'options_about_page_compro_updated', sanitize_text_field( $_POST['options_about_page_compro_updated'] ?? '' ) );
        update_option( 'options_about_page_compro_btn_dl_text', sanitize_text_field( $_POST['options_about_page_compro_btn_dl_text'] ?? '' ) );
        update_option( 'options_about_page_compro_btn_view_text', sanitize_text_field( $_POST['options_about_page_compro_btn_view_text'] ?? '' ) );

        $compro_highlights = [];
        for ( $h = 1; $h <= 4; $h++ ) {
            $h_val = sanitize_text_field( $_POST["options_about_page_compro_hl_{$h}"] ?? '' );
            if ( ! empty( $h_val ) ) {
                $compro_highlights[] = $h_val;
            }
        }
        update_option( 'options_about_page_compro_highlights', $compro_highlights );

        // 7. Banner Ajakan Bertindak (Call to Action)
        update_option( 'options_about_page_cta_badge', sanitize_text_field( $_POST['options_about_page_cta_badge'] ?? '' ) );
        update_option( 'options_about_page_cta_title', sanitize_text_field( $_POST['options_about_page_cta_title'] ?? '' ) );
        update_option( 'options_about_page_cta_desc', sanitize_textarea_field( $_POST['options_about_page_cta_desc'] ?? '' ) );
        update_option( 'options_about_page_cta_btn1_text', sanitize_text_field( $_POST['options_about_page_cta_btn1_text'] ?? '' ) );
        update_option( 'options_about_page_cta_btn1_url', esc_url_raw( $_POST['options_about_page_cta_btn1_url'] ?? '' ) );
        update_option( 'options_about_page_cta_btn2_text', sanitize_text_field( $_POST['options_about_page_cta_btn2_text'] ?? '' ) );
        update_option( 'options_about_page_cta_btn2_url', esc_url_raw( $_POST['options_about_page_cta_btn2_url'] ?? '' ) );

        // 8. Saklar Tampilan
        update_option( 'options_about_page_show_stats', isset( $_POST['options_about_page_show_stats'] ) ? '1' : '0' );
        update_option( 'options_about_page_show_vision', isset( $_POST['options_about_page_show_vision'] ) ? '1' : '0' );
        update_option( 'options_about_page_show_values', isset( $_POST['options_about_page_show_values'] ) ? '1' : '0' );
        update_option( 'options_about_page_show_logo', isset( $_POST['options_about_page_show_logo'] ) ? '1' : '0' );
        update_option( 'options_about_page_compro_show', isset( $_POST['options_about_page_compro_show'] ) ? '1' : '0' );
        update_option( 'options_about_page_show_cta', isset( $_POST['options_about_page_show_cta'] ) ? '1' : '0' );

        echo '<div class="notice notice-success is-dismissible"><p><strong>Pengaturan Halaman Profil: Tentang Kami berhasil disimpan!</strong></p></div>';
    }

    // ── AMBIL DATA DENGAN DEFAULT VALUE FORMAL ──────────────────────
    $page_badge     = get_option( 'options_about_page_badge', 'Profil Perusahaan' );
    $page_title     = get_option( 'options_about_page_title', 'Mengenal Lebih Dekat BPRS Wakalumi' );
    $page_subtitle  = get_option( 'options_about_page_subtitle', 'Membangun kualitas hidup berkah sesuai Syariah — Lembaga keuangan syariah yang fokus pada jasa keuangan dan pemberdayaan ekonomi umat serta UMKM.' );

    $hero_pill_1     = get_option( 'options_about_page_hero_pill_1', 'Melayani Sejak 1990' );
    $hero_pill_2     = get_option( 'options_about_page_hero_pill_2', 'Budaya Kerja SAPA & Prinsip Syariah' );
    $hero_pill_3     = get_option( 'options_about_page_hero_pill_3', 'Berizin OJK & Dijamin LPS' );

    $hero_card_show  = get_option( 'options_about_page_hero_card_show', '1' );
    $hero_card_logo  = get_option( 'options_about_page_hero_card_logo', get_template_directory_uri() . '/assets/img/untitled3.png' );
    if ( empty( $hero_card_logo ) ) {
        $hero_card_logo = get_template_directory_uri() . '/assets/img/untitled3.png';
    }
    $hero_card_badge = get_option( 'options_about_page_hero_card_badge', 'Identitas Korporasi Resmi' );
    $hero_card_title = get_option( 'options_about_page_hero_card_title', 'Bank Syariah Wakalumi' );
    $hero_card_desc  = get_option( 'options_about_page_hero_card_desc', 'Berkhidmat sejak tahun 1990 menghadirkan layanan perbankan syariah yang amanah, profesional, dan memberdayakan ekonomi umat.' );
    $hero_card_tag1  = get_option( 'options_about_page_hero_card_tag1', 'Diawasi OJK' );
    $hero_card_tag2  = get_option( 'options_about_page_hero_card_tag2', 'Dijamin LPS' );

    $sec_badge      = get_option( 'options_about_page_sec_badge', 'Sekilas Perusahaan' );
    $sec_title      = get_option( 'options_about_page_sec_title', 'Tumbuh Bersama Umat, Melayani Sepenuh Hati' );
    $narrative_1    = get_option( 'options_about_page_narrative_1', 'PT Bank Perekonomian Rakyat Syariah (BPRS) Wakalumi didirikan oleh Yayasan Wakalumi (Wakaf Karyawan dan Alumni Muslim Citibank) berdasarkan Akta Notaris Ny. Siti Pertiwi Henny Shidki, SH Nomor 59 tanggal 7 Oktober 1989 dan mendapatkan pengesahan Menteri Kehakiman RI tanggal 13 Januari 1990. BPRS Wakalumi memulai aktivitas operasi perbankan pada tanggal 1 Mei 1992, dan resmi dikonversi menjadi Bank Pembiayaan Rakyat Syariah pada tahun 1995 berlandaskan UU Nomor 7 Tahun 1992.' );
    $narrative_2    = get_option( 'options_about_page_narrative_2', 'BPRS Wakalumi senantiasa berpegang teguh pada komitmen ISHLAH—terus melakukan perbaikan berkelanjutan demi kemaslahatan bersama. Kami menghimpun dana dari masyarakat dalam bentuk deposito berjangka dan tabungan syariah, memberikan pembiayaan bagi pengusaha kecil, mikro, maupun masyarakat umum, serta aktif memfasilitasi literasi ekonomi syariah dan pembinaan Bank Mini di sekolah-sekolah.' );
    $about_img      = get_option( 'options_about_page_image', get_template_directory_uri() . '/assets/img/about-photo.jpg' );
    $photo_label    = get_option( 'options_about_page_photo_label', 'Kantor Pusat' );
    $photo_title    = get_option( 'options_about_page_photo_title', 'Bank Syariah Wakalumi Ciputat, Tangerang Selatan' );
    $floating_title = get_option( 'options_about_page_floating_title', 'Amanah' );
    $floating_desc  = get_option( 'options_about_page_floating_desc', 'Berpengalaman & Terpercaya' );
    $sec_btn1_text  = get_option( 'options_about_page_sec_btn1_text', 'Lihat Legalitas Perusahaan' );
    $sec_btn1_url   = get_option( 'options_about_page_sec_btn1_url', home_url( '/profil/legalitas' ) );
    $sec_btn2_text  = get_option( 'options_about_page_sec_btn2_text', 'Susunan Pengurus' );
    $sec_btn2_url   = get_option( 'options_about_page_sec_btn2_url', home_url( '/profil/susunan-pengurus' ) );

    $stat_1_val     = get_option( 'options_about_page_stat_1_val', '35+' );
    $stat_1_lbl     = get_option( 'options_about_page_stat_1_lbl', 'Tahun Pengalaman (1989)' );
    $stat_2_val     = get_option( 'options_about_page_stat_2_val', '10.000+' );
    $stat_2_lbl     = get_option( 'options_about_page_stat_2_lbl', 'Nasabah Setia' );
    $stat_3_val     = get_option( 'options_about_page_stat_3_val', '100%' );
    $stat_3_lbl     = get_option( 'options_about_page_stat_3_lbl', 'Prinsip Murni Syariah' );
    $stat_4_val     = get_option( 'options_about_page_stat_4_val', 'Rp2 Miliar' );
    $stat_4_lbl     = get_option( 'options_about_page_stat_4_lbl', 'Dijamin LPS per Nasabah' );

    $vm_badge           = get_option( 'options_about_page_vm_badge', 'Arah & Tujuan Strategis' );
    $vm_title           = get_option( 'options_about_page_vm_title', 'Visi & Misi BSW' );
    $vm_subtitle        = get_option( 'options_about_page_vm_subtitle', 'Landasan cita-cita luhur dan aksi nyata kami dalam melayani serta menggerakkan roda perekonomian masyarakat secara syariah.' );
    $missions_heading   = get_option( 'options_about_page_missions_heading', 'Butir-Butir Misi Strategis:' );

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

    $identity_badge = get_option( 'options_about_page_identity_badge', 'Jati Diri Lembaga' );
    $identity_tag   = get_option( 'options_about_page_identity_tag', 'Fokus Syariah' );
    $identity_title = get_option( 'options_about_page_identity_title', 'Lembaga Keuangan Syariah Umat' );
    $identity_text  = get_option( 'options_about_page_identity', 'BPRS Wakalumi adalah Lembaga Keuangan Syariah yang memiliki fokus pada jasa keuangan dan pemberdayaan ekonomi umat dan masyarakat sesuai syariah.' );

    $belief_badge   = get_option( 'options_about_page_belief_badge', 'Keyakinan Inti (Core Beliefs)' );
    $belief_tag     = get_option( 'options_about_page_belief_tag', 'Nilai Abadi' );
    $belief_title   = get_option( 'options_about_page_belief_title', 'Komitmen ISHLAH Berkelanjutan' );
    $belief_text    = get_option( 'options_about_page_belief', 'BPRS Wakalumi berkomitmen untuk selalu melakukan ISHLAH, yakni kami terus melakukan perbaikan berkelanjutan.' );

    $values_badge = get_option( 'options_about_page_values_badge', 'Budaya Kerja #WAQF' );
    $values_title = get_option( 'options_about_page_values_title', 'Budaya Kerja Perusahaan: #WAQF (Wisdom, Accountability, Quality, Foresight)' );
    $values_desc  = get_option( 'options_about_page_values_desc', 'Nilai-nilai budaya #WAQF yang menjadi komitmen moral, landasan tata kelola, dan etos kerja seluruh insan Bank Syariah Wakalumi dalam melayani umat secara profesional dan amanah.' );
    $values_tag   = get_option( 'options_about_page_values_tag', 'Pilar Nilai #WAQF' );

    $culture_img_show   = get_option( 'options_about_page_culture_img_show', '1' );
    $culture_img_light  = get_option( 'options_about_page_culture_img_light', '' );
    $culture_img_dark   = get_option( 'options_about_page_culture_img_dark', '' );
    $culture_caption    = get_option( 'options_about_page_culture_caption', 'Visualisasi Lambang Budaya #WAQF' );
    $culture_subcaption = get_option( 'options_about_page_culture_subcaption', 'Identitas visual resmi #WAQF (Wisdom, Accountability, Quality, Foresight) Bank Syariah Wakalumi' );

    $values = get_option( 'options_about_page_values', [] );
    if ( empty( $values ) || ( isset( $values[0]['acronym'] ) && strtoupper( $values[0]['acronym'] ) === 'S' && isset( $values[0]['title'] ) && strtolower( $values[0]['title'] ) === 'skill' ) ) {
        $values = [
            [ 'acronym' => 'W', 'title' => 'Wisdom', 'desc' => 'Kebijaksanaan dan kematangan dalam setiap pertimbangan keputusan serta solusi finansial syariah yang maslahat.' ],
            [ 'acronym' => 'A', 'title' => 'Accountability', 'desc' => 'Menjunjung tinggi transparansi, amanah, dan integritas tata kelola perusahaan yang profesional (GCG).' ],
            [ 'acronym' => 'Q', 'title' => 'Quality', 'desc' => 'Menghadirkan keunggulan mutu layanan perbankan prima, presisi operasional, dan kepuasan nasabah.' ],
            [ 'acronym' => 'F', 'title' => 'Foresight', 'desc' => 'Pandangan visioner, inovatif, dan adaptif membaca masa depan demi pertumbuhan ekonomi umat yang berkelanjutan.' ],
        ];
    }

    if ( stripos( $values_badge, 'SAPA' ) !== false ) {
        $values_badge = 'Budaya Kerja #WAQF';
    }
    if ( stripos( $values_title, 'SAPA' ) !== false ) {
        $values_title = 'Budaya Kerja Perusahaan: #WAQF (Wisdom, Accountability, Quality, Foresight)';
    }
    if ( stripos( $values_desc, 'SAPA' ) !== false ) {
        $values_desc = 'Nilai-nilai budaya #WAQF yang menjadi komitmen moral, landasan tata kelola, dan etos kerja seluruh insan Bank Syariah Wakalumi dalam melayani umat secara profesional dan amanah.';
    }
    if ( stripos( $values_tag, 'SAPA' ) !== false ) {
        $values_tag = 'Pilar Nilai #WAQF';
    }
    if ( stripos( $culture_caption, 'SAPA' ) !== false ) {
        $culture_caption = 'Visualisasi Lambang Budaya #WAQF';
    }
    if ( stripos( $culture_subcaption, 'SAPA' ) !== false ) {
        $culture_subcaption = 'Identitas visual resmi #WAQF (Wisdom, Accountability, Quality, Foresight) Bank Syariah Wakalumi';
    }

    if ( stripos( $culture_subcaption, 'perwujudan nilai' ) !== false ) {
        $culture_subcaption = str_ireplace( 'perwujudan nilai ', '', $culture_subcaption );
        $culture_subcaption = str_ireplace( 'perwujudan nilai', '', $culture_subcaption );
        $culture_subcaption = preg_replace( '/\s+/', ' ', trim( $culture_subcaption ) );
    }

    $logo_sec_badge     = get_option( 'options_about_page_logo_sec_badge', 'Identitas & Filosofi Brand' );
    $logo_sec_title     = get_option( 'options_about_page_logo_sec_title', 'Makna di Balik Lambang BSW' );
    $logo_preview_badge = get_option( 'options_about_page_logo_preview_badge', 'Identitas Visual Resmi' );
    $logo_preview_title = get_option( 'options_about_page_logo_preview_title', 'Bank Syariah Wakalumi (BSW)' );
    $logo_img           = get_option( 'options_about_page_logo_img', get_template_directory_uri() . '/assets/img/logo-new-1.png' );
    $logo_desc          = get_option( 'options_about_page_logo_desc', 'Logo BPRS Wakalumi merefleksikan identitas perbankan syariah yang dinamis, bersih, dan berakar pada nilai-nilai keislaman universal.' );

    $logo_p1_title  = get_option( 'options_about_page_logo_p1_title', 'Bentuk Gelombang & Aliran Berkah' );
    $logo_p1_desc   = get_option( 'options_about_page_logo_p1_desc', 'Melambangkan kelancaran aliran rezeki, fleksibilitas dalam melayani, serta kesegaran solusi finansial yang menyejukkan perekonomian umat.' );
    $logo_p1_color  = get_option( 'options_about_page_logo_p1_color', 'teal' );

    $logo_p2_title  = get_option( 'options_about_page_logo_p2_title', 'Warna Ocean Teal & Bright Teal' );
    $logo_p2_desc   = get_option( 'options_about_page_logo_p2_desc', 'Merefleksikan ketenangan, stabilitas finansial yang kokoh, profesionalisme modern, serta komitmen menjaga amanah nasabah.' );
    $logo_p2_color  = get_option( 'options_about_page_logo_p2_color', 'blue' );

    $logo_p3_title  = get_option( 'options_about_page_logo_p3_title', 'Aksen Mint Glow' );
    $logo_p3_desc   = get_option( 'options_about_page_logo_p3_desc', 'Melambangkan pertumbuhan ekonomi yang berkah, harapan baru bagi UMKM, dan masa depan perbankan syariah yang gemilang.' );
    $logo_p3_color  = get_option( 'options_about_page_logo_p3_color', 'sky' );

    $cta_badge      = get_option( 'options_about_page_cta_badge', 'Langkah Nyata Bersama Kami' );
    $cta_title      = get_option( 'options_about_page_cta_title', 'Siap Mengembangkan Usaha & Mengelola Dana Secara Berkah?' );
    $cta_desc       = get_option( 'options_about_page_cta_desc', 'Konsultasikan kebutuhan perbankan syariah Anda bersama tim profesional BPRS Wakalumi, atau temukan solusi simpanan dan pembiayaan yang tepat untuk masa depan finansial Anda.' );
    $cta_btn1_text  = get_option( 'options_about_page_cta_btn1_text', 'Hubungi via WhatsApp' );
    $cta_btn1_url   = get_option( 'options_about_page_cta_btn1_url', '' );
    $cta_btn2_text  = get_option( 'options_about_page_cta_btn2_text', 'Jelajahi Produk Kami' );
    $cta_btn2_url   = get_option( 'options_about_page_cta_btn2_url', home_url( '/produk' ) );

    // 6. Dokumen Company Profile
    $compro_show         = get_option( 'options_about_page_compro_show', '1' );
    $compro_badge        = get_option( 'options_about_page_compro_badge', 'Dokumen Resmi Perusahaan' );
    $compro_title        = get_option( 'options_about_page_compro_title', 'Unduh Company Profile PT BPRS Wakalumi' );
    $compro_desc         = get_option( 'options_about_page_compro_desc', 'Dapatkan ikhtisar resmi dan komprehensif mengenai profil kelembagaan, landasan syariah, susunan kepemimpinan, kepatuhan tata kelola (GCG), serta pertumbuhan kinerja keuangan BPRS Wakalumi.' );
    $compro_year         = get_option( 'options_about_page_compro_year', 'Edisi 2026' );
    $compro_file         = get_option( 'options_about_page_compro_file', '' );
    $compro_cover        = get_option( 'options_about_page_compro_cover', '' );
    $compro_filesize     = get_option( 'options_about_page_compro_filesize', 'PDF • Dokumen Resmi Terverifikasi' );
    $compro_updated      = get_option( 'options_about_page_compro_updated', 'Pembaruan Tahunan' );
    $compro_btn_dl_text  = get_option( 'options_about_page_compro_btn_dl_text', 'Unduh Company Profile (PDF)' );
    $compro_btn_view_text= get_option( 'options_about_page_compro_btn_view_text', 'Pratinjau Dokumen' );
    $compro_highlights   = get_option( 'options_about_page_compro_highlights', [
        'Ikhtisar Profil Lembaga & Legalitas OJK',
        'Struktur Pengurus & Dewan Pengawas Syariah',
        'Laporan Kinerja Keuangan & Rasio Kesehatan Bank',
        'Katalog Portofolio Produk Simpanan & Pembiayaan'
    ] );

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

                <!-- 1B. 3 Pills Sorotan Hero -->
                <h3 style="font-size: 14px; margin: 25px 0 12px 0; padding-top: 15px; border-top: 1px dashed #e2e8f0; color: #1e293b; font-weight: 700; display: flex; align-items: center; gap: 6px;">
                    <span class="dashicons dashicons-tag"></span> 1B. 3 Pills Sorotan Hero (Kolom Kiri)
                </h3>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 12px;">3 badge/pill ringkas yang tampil di bawah teks pengantar hero (kosongkan jika tidak ingin ditampilkan).</p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 12px; margin-bottom: 20px;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                        <label style="display: block; font-size: 11px; font-weight: 700; color: #088395; text-transform: uppercase; margin-bottom: 6px;">Pill Sorotan #1</label>
                        <input type="text" name="options_about_page_hero_pill_1" value="<?php echo esc_attr( $hero_pill_1 ); ?>" placeholder="Contoh: Melayani Sejak 1990" style="width: 100%;">
                    </div>
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                        <label style="display: block; font-size: 11px; font-weight: 700; color: #088395; text-transform: uppercase; margin-bottom: 6px;">Pill Sorotan #2</label>
                        <input type="text" name="options_about_page_hero_pill_2" value="<?php echo esc_attr( $hero_pill_2 ); ?>" placeholder="Contoh: Budaya Kerja SAPA & Prinsip Syariah" style="width: 100%;">
                    </div>
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px;">
                        <label style="display: block; font-size: 11px; font-weight: 700; color: #088395; text-transform: uppercase; margin-bottom: 6px;">Pill Sorotan #3</label>
                        <input type="text" name="options_about_page_hero_pill_3" value="<?php echo esc_attr( $hero_pill_3 ); ?>" placeholder="Contoh: Berizin OJK & Dijamin LPS" style="width: 100%;">
                    </div>
                </div>

                <!-- 1C. Kartu Identitas Korporasi Hero (Kolom Kanan) -->
                <div style="margin-top: 25px; padding-top: 18px; border-top: 1px dashed #e2e8f0;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; flex-wrap: wrap; gap: 10px;">
                        <h3 style="font-size: 14px; margin: 0; color: #1e293b; font-weight: 700; display: flex; align-items: center; gap: 6px;">
                            <span class="dashicons dashicons-id-alt"></span> 1C. Kartu Identitas Korporasi Hero (Kolom Kanan)
                        </h3>
                        <label style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; font-size: 13px; color: #1e293b; background: #f0fdf4; border: 1px solid #86efac; padding: 4px 10px; border-radius: 6px;">
                            <input type="checkbox" name="options_about_page_hero_card_show" value="1" <?php checked( $hero_card_show, '1' ); ?>> Aktifkan Kartu di Hero
                        </label>
                    </div>
                    <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 15px;">Kelola logo, judul, uraian singkat korporat, dan badge regulasi yang tampil pada kartu sorotan (spotlight card) di sebelah kanan hero section.</p>

                    <table class="form-table" role="presentation" style="margin-top: 0;">
                        <tr>
                            <th scope="row"><label>Logo / Lambang Kartu</label></th>
                            <td>
                                <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                    <div style="width: 70px; height: 70px; border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff; display: flex; align-items: center; justify-content: center; padding: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                                        <img id="hero_card_logo_preview" src="<?php echo esc_url( $hero_card_logo ); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain; <?php echo empty( $hero_card_logo ) ? 'display:none;' : ''; ?>" />
                                    </div>
                                    <div style="display: flex; flex-direction: column; gap: 6px;">
                                        <button type="button" class="button wkl-upload-btn" data-target="options_about_page_hero_card_logo" data-preview="hero_card_logo_preview" style="display: inline-flex; align-items: center; gap: 5px;">
                                            <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah / Pilih Logo
                                        </button>
                                        <button type="button" class="button-link wkl-remove-btn" data-target="options_about_page_hero_card_logo" data-preview="hero_card_logo_preview" style="color: #ef4444; font-size: 12px; <?php echo empty( $hero_card_logo ) ? 'display:none;' : ''; ?>">
                                            ✕ Reset Logo
                                        </button>
                                    </div>
                                    <input type="text" id="options_about_page_hero_card_logo" name="options_about_page_hero_card_logo" value="<?php echo esc_attr( $hero_card_logo ); ?>" class="regular-text" placeholder="...atau tempel URL logo" style="flex: 1; min-width: 220px;">
                                </div>
                                <p class="description" style="margin-top: 6px;">Rekomendasi: Logo format PNG transparan atau WebP (persegi/square), resolusi sekitar 200×200 px.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_about_page_hero_card_badge">Badge Header Kartu</label></th>
                            <td>
                                <input type="text" id="options_about_page_hero_card_badge" name="options_about_page_hero_card_badge" value="<?php echo esc_attr( $hero_card_badge ); ?>" class="regular-text" placeholder="Contoh: Identitas Korporasi Resmi">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_about_page_hero_card_title">Nama Perusahaan / Judul Kartu</label></th>
                            <td>
                                <input type="text" id="options_about_page_hero_card_title" name="options_about_page_hero_card_title" value="<?php echo esc_attr( $hero_card_title ); ?>" class="large-text" style="font-weight: 600;" placeholder="Contoh: Bank Syariah Wakalumi">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="options_about_page_hero_card_desc">Deskripsi Singkat Kartu</label></th>
                            <td>
                                <textarea id="options_about_page_hero_card_desc" name="options_about_page_hero_card_desc" rows="3" class="large-text" placeholder="Tuliskan komitmen atau profil singkat bank di sini..."><?php echo esc_textarea( $hero_card_desc ); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tag Regulasi Bawah Kartu</th>
                            <td>
                                <div style="display: flex; gap: 10px; max-width: 600px;">
                                    <div style="flex: 1;">
                                        <input type="text" name="options_about_page_hero_card_tag1" value="<?php echo esc_attr( $hero_card_tag1 ); ?>" class="regular-text" style="width: 100%;" placeholder="Tag 1 (contoh: Diawasi OJK)">
                                    </div>
                                    <div style="flex: 1;">
                                        <input type="text" name="options_about_page_hero_card_tag2" value="<?php echo esc_attr( $hero_card_tag2 ); ?>" class="regular-text" style="width: 100%;" placeholder="Tag 2 (contoh: Dijamin LPS)">
                                    </div>
                                </div>
                                <p class="description" style="margin-top: 6px;">Tag verifikasi legalitas resmi yang tampil di baris paling bawah kartu hero.</p>
                            </td>
                        </tr>
                    </table>
                </div>
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
                    <tr>
                        <th scope="row">Label &amp; Keterangan Foto</th>
                        <td>
                            <div style="display: flex; gap: 10px; max-width: 650px; margin-bottom: 6px;">
                                <div style="flex: 1;">
                                    <input type="text" name="options_about_page_photo_label" value="<?php echo esc_attr( $photo_label ); ?>" class="regular-text" style="width: 100%;" placeholder="Label Foto (misal: Kantor Pusat)">
                                </div>
                                <div style="flex: 2;">
                                    <input type="text" name="options_about_page_photo_title" value="<?php echo esc_attr( $photo_title ); ?>" class="regular-text" style="width: 100%;" placeholder="Keterangan (misal: Bank Syariah Wakalumi Ciputat, Tangerang Selatan)">
                                </div>
                            </div>
                            <p class="description">Teks keterangan lokasi yang melayang di pojok bawah foto kantor.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Floating Badge (Pojok Kanan Atas Foto)</th>
                        <td>
                            <div style="display: flex; gap: 10px; max-width: 650px; margin-bottom: 6px;">
                                <div style="flex: 1;">
                                    <input type="text" name="options_about_page_floating_title" value="<?php echo esc_attr( $floating_title ); ?>" class="regular-text" style="width: 100%;" placeholder="Judul Badge (misal: Amanah)">
                                </div>
                                <div style="flex: 2;">
                                    <input type="text" name="options_about_page_floating_desc" value="<?php echo esc_attr( $floating_desc ); ?>" class="regular-text" style="width: 100%;" placeholder="Sub-teks (misal: Berpengalaman &amp; Terpercaya)">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tombol Aksi Bawah Narasi</th>
                        <td>
                            <div style="display: flex; flex-direction: column; gap: 8px; max-width: 650px;">
                                <div style="display: flex; gap: 10px;">
                                    <input type="text" name="options_about_page_sec_btn1_text" value="<?php echo esc_attr( $sec_btn1_text ); ?>" class="regular-text" style="flex: 1;" placeholder="Teks Tombol 1 (misal: Lihat Legalitas Perusahaan)">
                                    <input type="text" name="options_about_page_sec_btn1_url" value="<?php echo esc_attr( $sec_btn1_url ); ?>" class="regular-text" style="flex: 1;" placeholder="URL Tombol 1">
                                </div>
                                <div style="display: flex; gap: 10px;">
                                    <input type="text" name="options_about_page_sec_btn2_text" value="<?php echo esc_attr( $sec_btn2_text ); ?>" class="regular-text" style="flex: 1;" placeholder="Teks Tombol 2 (misal: Susunan Pengurus)">
                                    <input type="text" name="options_about_page_sec_btn2_url" value="<?php echo esc_attr( $sec_btn2_url ); ?>" class="regular-text" style="flex: 1;" placeholder="URL Tombol 2">
                                </div>
                            </div>
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
                
                <h3 style="font-size: 14px; margin: 0 0 10px 0; color: #0f172a;">✨ Header Seksi Visi &amp; Misi</h3>
                <table class="form-table" role="presentation" style="margin-top: 0; margin-bottom: 20px;">
                    <tr>
                        <th scope="row" style="width: 180px;"><label for="options_about_page_vm_badge">Badge Header Seksi</label></th>
                        <td>
                            <input type="text" id="options_about_page_vm_badge" name="options_about_page_vm_badge" value="<?php echo esc_attr( $vm_badge ); ?>" class="regular-text" placeholder="Arah &amp; Tujuan Strategis">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_vm_title">Judul Header Seksi</label></th>
                        <td>
                            <input type="text" id="options_about_page_vm_title" name="options_about_page_vm_title" value="<?php echo esc_attr( $vm_title ); ?>" class="large-text" placeholder="Visi &amp; Misi BSW">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_vm_subtitle">Sub-Judul / Pengantar</label></th>
                        <td>
                            <textarea id="options_about_page_vm_subtitle" name="options_about_page_vm_subtitle" rows="2" class="large-text" placeholder="Landasan cita-cita luhur dan aksi nyata kami..."><?php echo esc_textarea( $vm_subtitle ); ?></textarea>
                        </td>
                    </tr>
                </table>

                <h3 style="font-size: 14px; margin: 20px 0 10px 0; padding-top: 15px; border-top: 1px dashed #e2e8f0; color: #0f172a;">✨ Visi Utama</h3>
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
                <table class="form-table" role="presentation" style="margin-top: 0; margin-bottom: 10px;">
                    <tr>
                        <th scope="row" style="width: 180px;"><label for="options_about_page_missions_heading">Judul Daftar Misi</label></th>
                        <td>
                            <input type="text" id="options_about_page_missions_heading" name="options_about_page_missions_heading" value="<?php echo esc_attr( $missions_heading ); ?>" class="large-text" placeholder="Butir-Butir Misi Strategis:">
                        </td>
                    </tr>
                </table>
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

                <h3 style="font-size: 14px; margin: 25px 0 10px 0; color: #0f172a; font-weight: 700; border-top: 1px dashed #e2e8f0; padding-top: 15px;">
                    Jati Diri &amp; Keyakinan Inti (Core Beliefs)
                </h3>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 15px;">Kelola label, tag, judul utama, dan narasi untuk 2 kartu fondasi korporasi di bagian bawah seksi visi-misi.</p>

                <!-- Jati Diri Card -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; margin-bottom: 15px;">
                    <h4 style="margin: 0 0 10px 0; font-size: 13px; color: #088395; font-weight: 700;">Kartu 1: Jati Diri Lembaga</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; margin-bottom: 4px; color: #475569;">Label Kicker</label>
                            <input type="text" name="options_about_page_identity_badge" value="<?php echo esc_attr( $identity_badge ); ?>" class="regular-text" style="width: 100%;" placeholder="Jati Diri Lembaga">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; margin-bottom: 4px; color: #475569;">Pill Tag Kanan</label>
                            <input type="text" name="options_about_page_identity_tag" value="<?php echo esc_attr( $identity_tag ); ?>" class="regular-text" style="width: 100%;" placeholder="Fokus Syariah">
                        </div>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <label style="display: block; font-size: 11px; font-weight: 700; margin-bottom: 4px; color: #475569;">Judul Kartu</label>
                        <input type="text" name="options_about_page_identity_title" value="<?php echo esc_attr( $identity_title ); ?>" class="large-text" style="width: 100%; font-weight: 600;" placeholder="Lembaga Keuangan Syariah Umat">
                    </div>
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 700; margin-bottom: 4px; color: #475569;">Uraian Narasi Jati Diri</label>
                        <textarea id="options_about_page_identity" name="options_about_page_identity" rows="2" class="large-text" style="width: 100%;"><?php echo esc_textarea( $identity_text ); ?></textarea>
                    </div>
                </div>

                <!-- Keyakinan Inti Card (ISHLAH) -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px;">
                    <h4 style="margin: 0 0 10px 0; font-size: 13px; color: #088395; font-weight: 700;">Kartu 2: Keyakinan Inti (ISHLAH)</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; margin-bottom: 4px; color: #475569;">Label Kicker</label>
                            <input type="text" name="options_about_page_belief_badge" value="<?php echo esc_attr( $belief_badge ); ?>" class="regular-text" style="width: 100%;" placeholder="Keyakinan Inti (Core Beliefs)">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: 700; margin-bottom: 4px; color: #475569;">Pill Tag Kanan</label>
                            <input type="text" name="options_about_page_belief_tag" value="<?php echo esc_attr( $belief_tag ); ?>" class="regular-text" style="width: 100%;" placeholder="Nilai Abadi">
                        </div>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <label style="display: block; font-size: 11px; font-weight: 700; margin-bottom: 4px; color: #475569;">Judul Kartu</label>
                        <input type="text" name="options_about_page_belief_title" value="<?php echo esc_attr( $belief_title ); ?>" class="large-text" style="width: 100%; font-weight: 600;" placeholder="Komitmen ISHLAH Berkelanjutan">
                    </div>
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 700; margin-bottom: 4px; color: #475569;">Uraian Narasi Komitmen ISHLAH</label>
                        <textarea id="options_about_page_belief" name="options_about_page_belief" rows="2" class="large-text" style="width: 100%;"><?php echo esc_textarea( $belief_text ); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- ── SECTION 4: NILAI BUDAYA PERUSAHAAN (#WAQF) ── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-heart"></span> 4. Budaya Kerja Perusahaan: <?php echo esc_html( ! empty( $values_title ) ? $values_title : '#WAQF (Wisdom, Accountability, Quality, Foresight)' ); ?>
                </h2>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 15px;">
                    Kelola badge, judul, narasi filosofi budaya kerja, dan butir-butir nilai karakter perusahaan yang tampil di halaman profil Tentang Kami.
                </p>

                <table class="form-table" role="presentation" style="margin-bottom: 20px;">
                    <tr>
                        <th scope="row"><label for="options_about_page_values_badge">Badge Seksi</label></th>
                        <td>
                            <input type="text" id="options_about_page_values_badge" name="options_about_page_values_badge" value="<?php echo esc_attr( $values_badge ); ?>" class="regular-text" placeholder="Contoh: Budaya Kerja #WAQF">
                            <p class="description">Badge kecil di atas judul utama seksi budaya kerja.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_values_title">Judul Budaya Kerja</label></th>
                        <td>
                            <input type="text" id="options_about_page_values_title" name="options_about_page_values_title" value="<?php echo esc_attr( $values_title ); ?>" class="large-text" placeholder="Contoh: Budaya Kerja Perusahaan: #WAQF (Wisdom, Accountability, Quality, Foresight)">
                            <p class="description">Judul utama seksi budaya kerja perusahaan.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_values_desc">Uraian / Narasi Budaya Kerja</label></th>
                        <td>
                            <textarea id="options_about_page_values_desc" name="options_about_page_values_desc" rows="3" class="large-text" placeholder="Nilai-nilai budaya #WAQF yang menjadi komitmen moral..."><?php echo esc_textarea( $values_desc ); ?></textarea>
                            <p class="description">Uraian narasi budaya kerja perusahaan. Mendukung pemformatan teks atau tag HTML seperti &lt;strong&gt;.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_values_tag">Label Tag Bawah Kartu</label></th>
                        <td>
                            <input type="text" id="options_about_page_values_tag" name="options_about_page_values_tag" value="<?php echo esc_attr( $values_tag ); ?>" class="regular-text" placeholder="Contoh: Pilar Nilai #WAQF">
                            <p class="description">Label teks di bagian bawah setiap kartu nilai budaya (di samping tanda centang).</p>
                        </td>
                    </tr>
                </table>

                <h3 style="font-size: 14px; margin: 20px 0 10px 0; color: #1e293b; font-weight: 700; border-top: 1px dashed #cbd5e1; padding-top: 15px;">
                    Daftar Butir Nilai &amp; Karakter Budaya Kerja
                </h3>

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

                <!-- 4B. Visual Lambang / Logo Budaya Kerja (Light & Dark Mode) -->
                <div style="margin-top: 25px; padding-top: 18px; border-top: 1px dashed #cbd5e1;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; flex-wrap: wrap; gap: 10px;">
                        <h3 style="font-size: 14px; margin: 0; color: #1e293b; font-weight: 700; display: flex; align-items: center; gap: 6px;">
                            <span class="dashicons dashicons-format-image"></span> 4B. Visual Lambang / Logo Budaya Kerja (Light &amp; Dark Mode)
                        </h3>
                        <label style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; font-size: 13px; color: #1e293b; background: #f0fdf4; border: 1px solid #86efac; padding: 4px 10px; border-radius: 6px;">
                            <input type="checkbox" name="options_about_page_culture_img_show" value="1" <?php checked( $culture_img_show, '1' ); ?>> Aktifkan Visual Logo di Halaman
                        </label>
                    </div>
                    <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 15px;">
                        Unggah gambar lambang / visual logo Corporate Culture yang akan tampil <strong>polos rata tengah dengan efek 3D timbul di bawah kartu #WAQF</strong> (tanpa bingkai kotak, bersih dan berkarakter). Tersedia opsi unggah terpisah untuk tampilan <strong>Mode Terang (Light Mode)</strong> dan <strong>Mode Gelap (Dark Mode)</strong>.
                    </p>

                    <table class="form-table" role="presentation" style="margin-top: 0;">
                        <!-- Light Mode Upload -->
                        <tr>
                            <th scope="row"><label>Visual Versi Light Mode</label></th>
                            <td>
                                <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                    <div style="width: 120px; height: 80px; border-radius: 8px; border: 1px solid #e2e8f0; background: #ffffff; display: flex; align-items: center; justify-content: center; padding: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                                        <img id="culture_img_light_preview" src="<?php echo esc_url( $culture_img_light ); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain; <?php echo empty( $culture_img_light ) ? 'display:none;' : ''; ?>" />
                                    </div>
                                    <div style="display: flex; flex-direction: column; gap: 6px;">
                                        <button type="button" class="button wkl-upload-btn" data-target="options_about_page_culture_img_light" data-preview="culture_img_light_preview" style="display: inline-flex; align-items: center; gap: 5px;">
                                            <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Gambar (Light Mode)
                                        </button>
                                        <button type="button" class="button-link wkl-remove-btn" data-target="options_about_page_culture_img_light" data-preview="culture_img_light_preview" style="color: #ef4444; font-size: 12px; <?php echo empty( $culture_img_light ) ? 'display:none;' : ''; ?>">
                                            ✕ Hapus Gambar
                                        </button>
                                    </div>
                                    <input type="text" id="options_about_page_culture_img_light" name="options_about_page_culture_img_light" value="<?php echo esc_attr( $culture_img_light ); ?>" class="regular-text" placeholder="...atau tempel URL gambar (Light Mode)" style="flex: 1; min-width: 220px;">
                                </div>
                                <p class="description" style="margin-top: 6px;">Rekomendasi: Format PNG transparan atau WebP, resolusi proporsional untuk background terang.</p>
                            </td>
                        </tr>

                        <!-- Dark Mode Upload -->
                        <tr>
                            <th scope="row"><label>Visual Versi Dark Mode</label></th>
                            <td>
                                <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                    <div style="width: 120px; height: 80px; border-radius: 8px; border: 1px solid #334155; background: #0f172a; display: flex; align-items: center; justify-content: center; padding: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.3);">
                                        <img id="culture_img_dark_preview" src="<?php echo esc_url( $culture_img_dark ); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain; <?php echo empty( $culture_img_dark ) ? 'display:none;' : ''; ?>" />
                                    </div>
                                    <div style="display: flex; flex-direction: column; gap: 6px;">
                                        <button type="button" class="button wkl-upload-btn" data-target="options_about_page_culture_img_dark" data-preview="culture_img_dark_preview" style="display: inline-flex; align-items: center; gap: 5px;">
                                            <span class="dashicons dashicons-upload" style="font-size:16px; width:16px; height:16px;"></span> Unggah Gambar (Dark Mode)
                                        </button>
                                        <button type="button" class="button-link wkl-remove-btn" data-target="options_about_page_culture_img_dark" data-preview="culture_img_dark_preview" style="color: #ef4444; font-size: 12px; <?php echo empty( $culture_img_dark ) ? 'display:none;' : ''; ?>">
                                            ✕ Hapus Gambar
                                        </button>
                                    </div>
                                    <input type="text" id="options_about_page_culture_img_dark" name="options_about_page_culture_img_dark" value="<?php echo esc_attr( $culture_img_dark ); ?>" class="regular-text" placeholder="...atau tempel URL gambar (Dark Mode)" style="flex: 1; min-width: 220px;">
                                </div>
                                <p class="description" style="margin-top: 6px;">Rekomendasi: Format PNG transparan (dengan aksen terang/putih) untuk kontras optimal di background gelap.</p>
                            </td>
                        </tr>

                        <!-- Alt Text / Label -->
                        <tr>
                            <th scope="row"><label for="options_about_page_culture_caption">Label Alt Gambar (Aksesibilitas &amp; SEO)</label></th>
                            <td>
                                <input type="text" id="options_about_page_culture_caption" name="options_about_page_culture_caption" value="<?php echo esc_attr( $culture_caption ); ?>" class="large-text" placeholder="Visualisasi Lambang &amp; Budaya Perusahaan SAPA">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- ── SECTION 5: MAKNA & FILOSOFI LOGO ──────────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-art"></span> 5. Makna & Filosofi Logo Bank
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_about_page_logo_sec_badge">Badge Header Seksi</label></th>
                        <td>
                            <input type="text" id="options_about_page_logo_sec_badge" name="options_about_page_logo_sec_badge" value="<?php echo esc_attr( $logo_sec_badge ); ?>" class="regular-text" placeholder="Identitas &amp; Filosofi Brand">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_logo_sec_title">Judul Header Seksi</label></th>
                        <td>
                            <input type="text" id="options_about_page_logo_sec_title" name="options_about_page_logo_sec_title" value="<?php echo esc_attr( $logo_sec_title ); ?>" class="large-text" placeholder="Makna di Balik Lambang BSW">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Pratinjau Visual Logo (Kolom Kiri)</th>
                        <td>
                            <div style="display: flex; gap: 10px; max-width: 650px; margin-bottom: 6px;">
                                <input type="text" name="options_about_page_logo_preview_badge" value="<?php echo esc_attr( $logo_preview_badge ); ?>" class="regular-text" style="flex: 1;" placeholder="Label (misal: Identitas Visual Resmi)">
                                <input type="text" name="options_about_page_logo_preview_title" value="<?php echo esc_attr( $logo_preview_title ); ?>" class="regular-text" style="flex: 1;" placeholder="Judul (misal: Bank Syariah Wakalumi (BSW))">
                            </div>
                        </td>
                    </tr>
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
                            <p class="description" style="margin-top: 4px; color: #088395; font-weight: 500;">
                                💡 <strong>Tip Dual-Tone:</strong> Gunakan tanda bintang <code>*kata*</code> pada judul pilar untuk memberi warna aksen berbeda (Contoh: <code>Bentuk Gelombang &amp; *Aliran Berkah*</code>). Jika tanpa tanda bintang, kata terakhir otomatis diberi aksen warna.
                            </p>
                        </td>
                    </tr>
                    <?php
                    $pilar_color_options = [
                        'teal'    => 'Teal (Hijau Toska)',
                        'blue'    => 'Biru Samudera (Ocean Blue)',
                        'sky'     => 'Sky Blue (Biru Langit / Cyan)',
                        'indigo'  => 'Indigo (Biru Gelap / Royal Navy)',
                        'emerald' => 'Emerald (Hijau Zamrud / Mint)',
                        'amber'   => 'Amber (Kuning Keemasan)',
                        'purple'  => 'Purple (Ungu Elegan)',
                        'rose'    => 'Rose (Merah Muda Elegan)',
                    ];
                    ?>
                    <tr>
                        <th scope="row">Pilar Filosofi 1</th>
                        <td>
                            <div style="display: flex; gap: 10px; margin-bottom: 6px; align-items: center; flex-wrap: wrap;">
                                <input type="text" name="options_about_page_logo_p1_title" value="<?php echo esc_attr( $logo_p1_title ); ?>" class="regular-text" style="font-weight: 600; flex: 1; min-width: 220px;" placeholder="Judul Pilar 1">
                                <label style="font-size: 13px; font-weight: 600; color: #475569; display: flex; align-items: center; gap: 6px;">
                                    <span>Tema Warna:</span>
                                    <select name="options_about_page_logo_p1_color" style="min-width: 180px;">
                                        <?php foreach ( $pilar_color_options as $c_val => $c_label ) : ?>
                                            <option value="<?php echo esc_attr( $c_val ); ?>" <?php selected( $logo_p1_color, $c_val ); ?>><?php echo esc_html( $c_label ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </label>
                            </div>
                            <textarea name="options_about_page_logo_p1_desc" rows="2" class="large-text" placeholder="Uraian makna pilar 1"><?php echo esc_textarea( $logo_p1_desc ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Pilar Filosofi 2</th>
                        <td>
                            <div style="display: flex; gap: 10px; margin-bottom: 6px; align-items: center; flex-wrap: wrap;">
                                <input type="text" name="options_about_page_logo_p2_title" value="<?php echo esc_attr( $logo_p2_title ); ?>" class="regular-text" style="font-weight: 600; flex: 1; min-width: 220px;" placeholder="Judul Pilar 2">
                                <label style="font-size: 13px; font-weight: 600; color: #475569; display: flex; align-items: center; gap: 6px;">
                                    <span>Tema Warna:</span>
                                    <select name="options_about_page_logo_p2_color" style="min-width: 180px;">
                                        <?php foreach ( $pilar_color_options as $c_val => $c_label ) : ?>
                                            <option value="<?php echo esc_attr( $c_val ); ?>" <?php selected( $logo_p2_color, $c_val ); ?>><?php echo esc_html( $c_label ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </label>
                            </div>
                            <textarea name="options_about_page_logo_p2_desc" rows="2" class="large-text" placeholder="Uraian makna pilar 2"><?php echo esc_textarea( $logo_p2_desc ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Pilar Filosofi 3</th>
                        <td>
                            <div style="display: flex; gap: 10px; margin-bottom: 6px; align-items: center; flex-wrap: wrap;">
                                <input type="text" name="options_about_page_logo_p3_title" value="<?php echo esc_attr( $logo_p3_title ); ?>" class="regular-text" style="font-weight: 600; flex: 1; min-width: 220px;" placeholder="Judul Pilar 3">
                                <label style="font-size: 13px; font-weight: 600; color: #475569; display: flex; align-items: center; gap: 6px;">
                                    <span>Tema Warna:</span>
                                    <select name="options_about_page_logo_p3_color" style="min-width: 180px;">
                                        <?php foreach ( $pilar_color_options as $c_val => $c_label ) : ?>
                                            <option value="<?php echo esc_attr( $c_val ); ?>" <?php selected( $logo_p3_color, $c_val ); ?>><?php echo esc_html( $c_label ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </label>
                            </div>
                            <textarea name="options_about_page_logo_p3_desc" rows="2" class="large-text" placeholder="Uraian makna pilar 3"><?php echo esc_textarea( $logo_p3_desc ); ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── SECTION 6: DOKUMEN COMPANY PROFILE RESMI (UNDUH PDF) ───── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                    <h2 style="font-size: 16px; margin: 0; color: #088395; display: flex; align-items: center; gap: 8px;">
                        <span class="dashicons dashicons-pdf" style="font-size: 20px; width: 20px; height: 20px;"></span> 6. Dokumen Company Profile Resmi (Unduh PDF Dinamis)
                    </h2>
                    <label style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; font-size: 13px; color: #1e293b; background: #f0fdf4; border: 1px solid #86efac; padding: 4px 10px; border-radius: 6px;">
                        <input type="checkbox" name="options_about_page_compro_show" value="1" <?php checked( $compro_show, '1' ); ?>> Aktifkan Seksi di Halaman
                    </label>
                </div>
                
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px 16px; margin-bottom: 20px; font-size: 13px; color: #475569; display: flex; align-items: flex-start; gap: 10px;">
                    <span class="dashicons dashicons-info" style="color: #088395; margin-top: 2px;"></span>
                    <div>
                        <strong>Pemberitahuan:</strong> Bagian ini menampilkan <strong>1 dokumen resmi Company Profile utama</strong> (non-multi) agar nasabah dan stakeholder tidak ambigu saat mengunduh profil perusahaan terbaru. Anda dapat memperbarui file PDF ini setiap periode tahunan secara dinamis.
                    </div>
                </div>

                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_about_page_compro_file">Berkas PDF Company Profile</label></th>
                        <td>
                            <div class="wkl-upload-wrap" style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                <input type="text" id="options_about_page_compro_file" name="options_about_page_compro_file" value="<?php echo esc_attr( $compro_file ); ?>" class="large-text" placeholder="https://.../wakalumi-company-profile-2026.pdf" style="flex: 1; min-width: 260px;">
                                <button type="button" class="button wkl-upload-pdf-btn" data-target="options_about_page_compro_file" style="display: inline-flex; align-items: center; gap: 4px; font-weight: 600; white-space: nowrap;">
                                    <span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px;"></span> Unggah / Pilih PDF
                                </button>
                                <?php if ( ! empty( $compro_file ) ) : ?>
                                    <a href="<?php echo esc_url( $compro_file ); ?>" target="_blank" class="button button-secondary" style="display: inline-flex; align-items: center; gap: 4px;" title="Lihat berkas saat ini">
                                        <span class="dashicons dashicons-external"></span> Cek PDF
                                    </a>
                                <?php endif; ?>
                            </div>
                            <p class="description" style="margin-top: 6px;">Unggah dokumen PDF Company Profile resmi via Media Library WordPress. Format berkas: <strong>.pdf</strong>.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_compro_cover">Gambar Sampul / Mockup Booklet (Opsional)</label></th>
                        <td>
                            <div class="wkl-upload-wrap" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                <img id="compro_cover_preview" src="<?php echo esc_url( $compro_cover ); ?>" style="max-width: 100px; max-height: 140px; border-radius: 8px; border: 1px solid #e2e8f0; object-fit: cover; <?php echo empty( $compro_cover ) ? 'display:none;' : ''; ?>" />
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <button type="button" class="button wkl-upload-btn" data-target="options_about_page_compro_cover" data-preview="compro_cover_preview" style="display: inline-flex; align-items: center; gap: 5px;">
                                        <span class="dashicons dashicons-format-image" style="font-size:16px; width:16px; height:16px;"></span> Unggah Cover Sampul
                                    </button>
                                    <button type="button" class="button-link wkl-remove-btn" data-target="options_about_page_compro_cover" data-preview="compro_cover_preview" style="color: #ef4444; font-size: 12px; <?php echo empty( $compro_cover ) ? 'display:none;' : ''; ?>">
                                        ✕ Hapus Gambar
                                    </button>
                                </div>
                                <input type="text" id="options_about_page_compro_cover" name="options_about_page_compro_cover" value="<?php echo esc_attr( $compro_cover ); ?>" class="regular-text" placeholder="...atau tempel URL gambar sampul" style="flex: 1; min-width: 220px;">
                            </div>
                            <p class="description" style="margin-top: 6px;">Jika dikosongkan, sistem secara otomatis merender mockup 3D buku Company Profile BPRS Wakalumi premium secara prosedural.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_compro_badge">Badge Kicker</label></th>
                        <td>
                            <input type="text" id="options_about_page_compro_badge" name="options_about_page_compro_badge" value="<?php echo esc_attr( $compro_badge ); ?>" class="regular-text" placeholder="Dokumen Resmi Perusahaan">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_compro_title">Judul Seksi</label></th>
                        <td>
                            <input type="text" id="options_about_page_compro_title" name="options_about_page_compro_title" value="<?php echo esc_attr( $compro_title ); ?>" class="large-text" style="font-weight: 600;" placeholder="Unduh Company Profile PT BPRS Wakalumi">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_compro_year">Edisi / Periode Tahun</label></th>
                        <td>
                            <input type="text" id="options_about_page_compro_year" name="options_about_page_compro_year" value="<?php echo esc_attr( $compro_year ); ?>" class="regular-text" placeholder="Contoh: Edisi 2026 atau Tahun Buku 2025/2026">
                            <p class="description">Label edisi yang tampil mencolok pada cover dan kartu dokumen.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_compro_desc">Uraian / Deskripsi Ringkas</label></th>
                        <td>
                            <textarea id="options_about_page_compro_desc" name="options_about_page_compro_desc" rows="3" class="large-text"><?php echo esc_textarea( $compro_desc ); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_compro_filesize">Format & Keterangan Berkas</label></th>
                        <td>
                            <input type="text" id="options_about_page_compro_filesize" name="options_about_page_compro_filesize" value="<?php echo esc_attr( $compro_filesize ); ?>" class="regular-text" placeholder="Contoh: PDF • 4.8 MB (Resmi)">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_compro_updated">Keterangan Pembaruan</label></th>
                        <td>
                            <input type="text" id="options_about_page_compro_updated" name="options_about_page_compro_updated" value="<?php echo esc_attr( $compro_updated ); ?>" class="regular-text" placeholder="Contoh: Diperbarui: Januari 2026">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4 Poin Sorotan Isi Dokumen</th>
                        <td>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; max-width: 800px;">
                                <?php for ( $h = 1; $h <= 4; $h++ ) : 
                                    $hl_text = $compro_highlights[$h - 1] ?? '';
                                ?>
                                    <div>
                                        <label style="font-size: 11px; font-weight: bold; color: #64748b; display: block; margin-bottom: 2px;">Sorotan <?php echo $h; ?>:</label>
                                        <input type="text" name="options_about_page_compro_hl_<?php echo $h; ?>" value="<?php echo esc_attr( $hl_text ); ?>" class="regular-text" style="width: 100%;" placeholder="Poin sorotan dokumen...">
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <p class="description" style="margin-top: 6px;">4 poin penting yang akan ditampilkan sebagai fitur ringkas isi dokumen.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_about_page_compro_btn_dl_text">Label Tombol Unduh (Download)</label></th>
                        <td>
                            <input type="text" id="options_about_page_compro_btn_dl_text" name="options_about_page_compro_btn_dl_text" value="<?php echo esc_attr( $compro_btn_dl_text ); ?>" class="regular-text" placeholder="Unduh Company Profile (PDF)">
                            <p class="description">Teks yang ditampilkan pada tombol unduh berkas PDF resmi.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- ── SECTION 7: AJAKAN BERTINDAK (CTA BANNER) ───────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-megaphone"></span> 7. Ajakan Bertindak (CTA Banner WhatsApp & Produk)
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

            <!-- ── SECTION 8: SAKLAR VISIBILITAS BAGIAN ───────────── -->
            <div style="background: #fff; border: 1px solid #ccd0d4; border-radius: 8px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px;">
                <h2 style="font-size: 16px; margin: 0 0 15px 0; padding-bottom: 8px; border-bottom: 1px solid #eee; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-visibility"></span> 8. Pengaturan Tampilan Bagian (Visibility)
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row">Tampilkan Bagian</th>
                        <td>
                            <fieldset style="display: flex; flex-direction: column; gap: 10px;">
                                <label><input type="checkbox" name="options_about_page_hero_card_show" value="1" <?php checked( $hero_card_show, '1' ); ?>> Kartu Identitas Korporasi di Hero Section (Kolom Kanan)</label>
                                <label><input type="checkbox" name="options_about_page_show_stats" value="1" <?php checked( $show_stats, '1' ); ?>> 4 Kotak Indikator Statistik Pengalaman</label>
                                <label><input type="checkbox" name="options_about_page_show_vision" value="1" <?php checked( $show_vision, '1' ); ?>> Seksi Visi & Misi Perusahaan</label>
                                <label><input type="checkbox" name="options_about_page_show_values" value="1" <?php checked( $show_values, '1' ); ?>> Seksi Nilai-Nilai Budaya Perusahaan (Core Values)</label>
                                <label><input type="checkbox" name="options_about_page_culture_img_show" value="1" <?php checked( $culture_img_show, '1' ); ?>> Visual Logo Budaya Kerja Perusahaan (Light &amp; Dark Mode)</label>
                                <label><input type="checkbox" name="options_about_page_show_logo" value="1" <?php checked( $show_logo, '1' ); ?>> Seksi Makna & Filosofi Logo</label>
                                <label><input type="checkbox" name="options_about_page_compro_show" value="1" <?php checked( $compro_show, '1' ); ?>> Seksi Company Profile Resmi (Unduh Dokumen PDF)</label>
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
        // Universal Upload Gambar (WordPress Media Library)
        $(document).on('click', '.wkl-upload-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            var targetId = button.data('target');
            var previewId = button.data('preview');
            var wrap = button.closest('.wkl-upload-wrap');

            var imageFrame = wp.media({
                title: 'Pilih atau Unggah Gambar',
                button: { text: 'Gunakan Gambar Ini' },
                multiple: false,
                library: { type: 'image' }
            });

            imageFrame.on('select', function() {
                var attachment = imageFrame.state().get('selection').first().toJSON();
                $('#' + targetId).val(attachment.url).trigger('change');
                if (previewId && $('#' + previewId).length) {
                    $('#' + previewId).attr('src', attachment.url).show();
                }
                if (wrap.length) {
                    wrap.find('.wkl-remove-btn').show();
                }
            });

            imageFrame.open();
        });

        // Universal Hapus Gambar
        $(document).on('click', '.wkl-remove-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            var targetId = button.data('target');
            var previewId = button.data('preview');

            $('#' + targetId).val('').trigger('change');
            if (previewId && $('#' + previewId).length) {
                $('#' + previewId).attr('src', '').hide();
            }
            button.hide();
        });

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

        // Upload PDF Company Profile (WordPress Media Library)
        $(document).on('click', '.wkl-upload-pdf-btn', function(e) {
            e.preventDefault();
            var targetId = $(this).data('target');
            var $input   = $('#' + targetId);

            var pdfFrame = wp.media({
                title:    'Pilih atau Unggah Dokumen PDF Company Profile',
                button:   { text: 'Gunakan Dokumen Ini' },
                multiple: false,
                library:  { type: 'application/pdf' }
            });

            pdfFrame.on('select', function() {
                var attachment = pdfFrame.state().get('selection').first().toJSON();
                $input.val(attachment.url).trigger('change');

                // Otomatis isi ukuran file jika ada info filesize
                var $sizeInput = $('#options_about_page_compro_filesize');
                if ($sizeInput.length && attachment.filesizeHumanReadable) {
                    $sizeInput.val('PDF • ' + attachment.filesizeHumanReadable);
                }
            });

            pdfFrame.open();
        });
    });
    </script>
    <?php
}

