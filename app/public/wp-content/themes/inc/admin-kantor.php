<?php
/**
 * Admin Page: Jaringan Kantor
 * Submenu of wakalumi-settings
 * 
 * Mengelola seluruh kantor operasional, kantor kas, kantor layanan, 
 * kartu hero, dan standar kenyamanan nasabah BPRS Wakalumi.
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

        // 2. Hero Right Card
        update_option( 'options_kantor_hero_card_badge', sanitize_text_field( wp_unslash( $_POST['options_kantor_hero_card_badge'] ?? '' ) ) );
        update_option( 'options_kantor_hero_card_title', sanitize_text_field( wp_unslash( $_POST['options_kantor_hero_card_title'] ?? '' ) ) );
        update_option( 'options_kantor_hero_card_desc', sanitize_textarea_field( wp_unslash( $_POST['options_kantor_hero_card_desc'] ?? '' ) ) );
        update_option( 'options_kantor_hero_card_tag1', sanitize_text_field( wp_unslash( $_POST['options_kantor_hero_card_tag1'] ?? '' ) ) );
        update_option( 'options_kantor_hero_card_tag2', sanitize_text_field( wp_unslash( $_POST['options_kantor_hero_card_tag2'] ?? '' ) ) );

        // 3. Office Repeater
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

        // 4. Standar Kenyamanan Nasabah (Amenities)
        update_option( 'options_kantor_amenities_badge', sanitize_text_field( wp_unslash( $_POST['options_kantor_amenities_badge'] ?? '' ) ) );
        update_option( 'options_kantor_amenities_title', sanitize_text_field( wp_unslash( $_POST['options_kantor_amenities_title'] ?? '' ) ) );
        update_option( 'options_kantor_amenities_desc', sanitize_textarea_field( wp_unslash( $_POST['options_kantor_amenities_desc'] ?? '' ) ) );

        $amenity_titles = wp_unslash( $_POST['amenity_title'] ?? [] );
        $amenity_descs  = wp_unslash( $_POST['amenity_desc'] ?? [] );
        $amenity_tags   = wp_unslash( $_POST['amenity_tag'] ?? [] );
        $amenity_icons  = wp_unslash( $_POST['amenity_icon'] ?? [] );
        $amenity_colors = wp_unslash( $_POST['amenity_color'] ?? [] );
        $clean_amenities = [];

        for ( $j = 0; $j < count( $amenity_titles ); $j++ ) {
            $at = sanitize_text_field( $amenity_titles[$j] ?? '' );
            if ( ! empty( $at ) ) {
                $clean_amenities[] = [
                    'title' => $at,
                    'desc'  => sanitize_textarea_field( $amenity_descs[$j] ?? '' ),
                    'tag'   => sanitize_text_field( $amenity_tags[$j] ?? '' ),
                    'icon'  => sanitize_text_field( $amenity_icons[$j] ?? 'pin' ),
                    'color' => sanitize_text_field( $amenity_colors[$j] ?? 'auto' ),
                ];
            }
        }
        update_option( 'options_kantor_amenities_list', $clean_amenities );

        // 5. CTA Section
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
    $default_kantor_list = [
        [
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
        ],
        [
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
        ],
        [
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
        ],
    ];

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

    $hero_card_badge = get_option( 'options_kantor_hero_card_badge', 'Jaringan Pelayanan Nasabah' );
    $hero_card_title = get_option( 'options_kantor_hero_card_title', 'Hadir Lebih Dekat & Bersahabat' );
    $hero_card_desc  = get_option( 'options_kantor_hero_card_desc', 'Melayani transaksi kas, pembukaan rekening simpanan, serta konsultasi pembiayaan syariah di wilayah Tangerang Selatan & Tangerang.' );
    $hero_card_tag1  = get_option( 'options_kantor_hero_card_tag1', 'Lokasi Kantor' );
    $hero_card_tag2  = get_option( 'options_kantor_hero_card_tag2', 'Layanan Prima SAPA' );

    $kantor_list    = get_option( 'options_kantor_list', false );
    if ( $kantor_list === false || ! is_array( $kantor_list ) || empty( $kantor_list ) ) {
        $kantor_list = $default_kantor_list;
        update_option( 'options_kantor_list', $kantor_list );
    }

    $amenities_badge = get_option( 'options_kantor_amenities_badge', 'Standar Kenyamanan Nasabah' );
    $amenities_title = get_option( 'options_kantor_amenities_title', 'Komitmen Pelayanan di Seluruh Jaringan Kantor' );
    $amenities_desc  = get_option( 'options_kantor_amenities_desc', 'Setiap kantor kami dirancang memberikan lingkungan yang ramah, nyaman, dan mengedepankan keamanan serta keberkahan syariah.' );

    $amenities_list  = get_option( 'options_kantor_amenities_list', [] );
    if ( empty( $amenities_list ) ) {
        $amenities_list = [
            [
                'title' => 'Lokasi Strategis',
                'desc'  => 'Terletak di kawasan niaga utama yang mudah diakses dengan kendaraan pribadi maupun sarana transportasi umum.',
                'tag'   => 'Akses Mudah & Parkir Luas',
                'icon'  => 'pin',
                'color' => 'teal',
            ],
            [
                'title' => 'Layanan Ramah & Beretika',
                'desc'  => 'Customer Service dan teller berpengalaman menyambut Anda dengan prinsip keramahan syariah dan profesionalisme tinggi.',
                'tag'   => 'Budaya SAPA Syariah',
                'icon'  => 'users',
                'color' => 'sky',
            ],
            [
                'title' => 'Diawasi OJK & DPS',
                'desc'  => 'Seluruh operasional kantor berada dalam pengawasan Otoritas Jasa Keuangan (OJK) serta kepatuhan fatwa DSN-MUI.',
                'tag'   => 'Kepatuhan Regulasi Penuh',
                'icon'  => 'shield',
                'color' => 'amber',
            ],
            [
                'title' => 'Simpanan Dijamin LPS',
                'desc'  => 'Setiap simpanan nasabah dijamin Lembaga Penjamin Simpanan (LPS) hingga Rp 2 Miliar per nasabah per bank.',
                'tag'   => 'Dana Terjamin Amanah',
                'icon'  => 'lock',
                'color' => 'indigo',
            ],
        ];
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
    <div class="wrap" style="max-width: 1040px; margin-top: 20px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0;">
                    🏢 Pengaturan Halaman: Jaringan Kantor
                </h1>
                <p style="color: #64748b; margin: 6px 0 0 0; font-size: 13px;">
                    Kelola data kantor operasional, kartu hero kanan, komitmen standar kenyamanan, dan CTA secara dinamis.
                </p>
            </div>
            <a href="<?php echo esc_url( home_url( '/profil/jaringan-kantor' ) ); ?>" target="_blank" class="button button-secondary" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; padding: 5px 14px;">
                <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px;"></span> Lihat Halaman Live
            </a>
        </div>

        <?php if ( $is_saved ) : ?>
            <div class="notice notice-success is-dismissible">
                <p><strong>✅ Data jaringan kantor berhasil disimpan!</strong></p>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <?php wp_nonce_field( 'wakalumi_kantor_save', 'wakalumi_kantor_nonce' ); ?>

            <!-- SECTION 1: Header Halaman & Statistik Cepat -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px;">
                <h2 style="font-size: 17px; margin: 0 0 18px 0; padding-bottom: 12px; border-bottom: 2px solid #f1f5f9; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-cover-image"></span> Seksi 1: Banner Judul & Statistik Cepat (Hero Kiri)
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_kantor_page_badge">Badge Kicker Halaman</label></th>
                        <td>
                            <input type="text" id="options_kantor_page_badge" name="options_kantor_page_badge" value="<?php echo esc_attr( $page_badge ); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_kantor_page_title">Judul Utama Halaman</label></th>
                        <td>
                            <input type="text" id="options_kantor_page_title" name="options_kantor_page_title" value="<?php echo esc_attr( $page_title ); ?>" class="large-text" style="font-weight: bold;" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_kantor_page_subtitle">Sub-Judul / Deskripsi</label></th>
                        <td>
                            <textarea id="options_kantor_page_subtitle" name="options_kantor_page_subtitle" rows="2" class="large-text"><?php echo esc_textarea( $page_subtitle ); ?></textarea>
                        </td>
                    </tr>
                </table>

                <h3 style="font-size: 14px; margin: 20px 0 12px 0; padding-top: 15px; border-top: 1px dashed #e2e8f0; color: #334155;">Statistik Cepat (3 Counter Bar):</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px;">
                    <div style="background: #f8fafc; padding: 14px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #475569;">Angka / Teks Stat 1</label>
                        <input type="text" name="options_kantor_stat1_num" value="<?php echo esc_attr( $stat1_num ); ?>" style="width: 100%; margin-bottom: 8px; font-weight: bold; color: #088395;" placeholder="3 Kantor">
                        <label style="display: block; font-size: 11px; color: #64748b; margin-bottom: 2px;">Label Stat 1</label>
                        <input type="text" name="options_kantor_stat1_label" value="<?php echo esc_attr( $stat1_label ); ?>" style="width: 100%; font-size: 12px;">
                    </div>

                    <div style="background: #f8fafc; padding: 14px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #475569;">Angka / Teks Stat 2</label>
                        <input type="text" name="options_kantor_stat2_num" value="<?php echo esc_attr( $stat2_num ); ?>" style="width: 100%; margin-bottom: 8px; font-weight: bold; color: #088395;" placeholder="3 Wilayah">
                        <label style="display: block; font-size: 11px; color: #64748b; margin-bottom: 2px;">Label Stat 2</label>
                        <input type="text" name="options_kantor_stat2_label" value="<?php echo esc_attr( $stat2_label ); ?>" style="width: 100%; font-size: 12px;">
                    </div>

                    <div style="background: #f8fafc; padding: 14px; border-radius: 8px; border: 1px solid #e2e8f0;">
                        <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #475569;">Angka / Teks Stat 3</label>
                        <input type="text" name="options_kantor_stat3_num" value="<?php echo esc_attr( $stat3_num ); ?>" style="width: 100%; margin-bottom: 8px; font-weight: bold; color: #088395;" placeholder="Senin - Jumat">
                        <label style="display: block; font-size: 11px; color: #64748b; margin-bottom: 2px;">Label Stat 3</label>
                        <input type="text" name="options_kantor_stat3_label" value="<?php echo esc_attr( $stat3_label ); ?>" style="width: 100%; font-size: 12px;">
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Kartu Hero Kanan (Jaringan Pelayanan Nasabah) -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px;">
                <h2 style="font-size: 17px; margin: 0 0 18px 0; padding-bottom: 12px; border-bottom: 2px solid #f1f5f9; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-id"></span> Seksi 2: Kartu Hero Kanan (Pusat Layanan Nasabah)
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="options_kantor_hero_card_badge">Badge Kartu</label></th>
                        <td><input type="text" id="options_kantor_hero_card_badge" name="options_kantor_hero_card_badge" value="<?php echo esc_attr( $hero_card_badge ); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_kantor_hero_card_title">Judul Kartu</label></th>
                        <td><input type="text" id="options_kantor_hero_card_title" name="options_kantor_hero_card_title" value="<?php echo esc_attr( $hero_card_title ); ?>" class="large-text" style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_kantor_hero_card_desc">Uraian Keterangan</label></th>
                        <td><textarea id="options_kantor_hero_card_desc" name="options_kantor_hero_card_desc" rows="2" class="large-text"><?php echo esc_textarea( $hero_card_desc ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row">Label Tag Bawah</th>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" name="options_kantor_hero_card_tag1" value="<?php echo esc_attr( $hero_card_tag1 ); ?>" placeholder="Tag Kiri (mis: Lokasi Kantor)" class="regular-text">
                                <input type="text" name="options_kantor_hero_card_tag2" value="<?php echo esc_attr( $hero_card_tag2 ); ?>" placeholder="Tag Kanan (mis: Layanan Prima SAPA)" class="regular-text">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- SECTION 3: Daftar Jaringan Kantor (Repeater dengan Naik/Turun) -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 2px solid #f1f5f9; padding-bottom: 12px;">
                    <h2 style="font-size: 17px; margin: 0; color: #088395; display: flex; align-items: center; gap: 8px;">
                        <span class="dashicons dashicons-building"></span> Seksi 3: Daftar Kantor & Titik Layanan
                    </h2>
                    <span style="font-size: 12px; color: #64748b; font-weight: bold;">Total: <?php echo count( $kantor_list ); ?> Kantor</span>
                </div>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 15px;">
                    Gunakan tombol <strong>🔼 Naik</strong> atau <strong>🔽 Turun</strong> untuk mengatur posisi kantor. Jika website hanya memiliki 2 kantor, sistem secara otomatis akan melebarkan tampilan menjadi 2 kolom penuh (*full-width*) yang seimbang dan megah tanpa ada celah kosong.
                </p>

                <div id="wkl-kantor-container" style="display: flex; flex-direction: column; gap: 20px;">
                    <?php foreach ( $kantor_list as $index => $kantor ) : 
                        $foto_url = $kantor['foto'] ?? '';
                    ?>
                        <div class="kantor-card wkl-sortable-kantor" style="border-left: 4px solid #088395; background: #f8fafc; border-radius: 10px; border-top: 1px solid #cbd5e1; border-right: 1px solid #cbd5e1; border-bottom: 1px solid #cbd5e1; padding: 20px; position: relative;">
                            <!-- Header Bar Card -->
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span class="wkl-kantor-index-badge" style="background: #088395; color: #fff; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 6px;">#<?php echo $index + 1; ?></span>
                                    <strong style="font-size: 15px; color: #0f172a;" class="wkl-kantor-title-preview"><?php echo esc_html( $kantor['nama'] ?? 'Kantor BPRS Wakalumi' ); ?></strong>
                                    <span style="font-size: 11px; color: #64748b; background: #e2e8f0; padding: 2px 8px; border-radius: 10px; font-weight: 600;"><?php echo esc_html( $kantor['tipe'] ?? '' ); ?></span>
                                </div>
                                <div style="display: flex; gap: 5px;">
                                    <button type="button" class="button button-small wkl-btn-up-kantor" title="Geser ke Atas">🔼 Naik</button>
                                    <button type="button" class="button button-small wkl-btn-down-kantor" title="Geser ke Bawah">🔽 Turun</button>
                                    <button type="button" class="button button-small button-link-delete wkl-delete-kantor" style="color: #ef4444;" title="Hapus Kantor">✕ Hapus</button>
                                </div>
                            </div>

                            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                                <!-- Left: Foto Gedung/Ruko -->
                                <div style="flex: 0 0 210px; display: flex; flex-direction: column; gap: 10px;">
                                    <label style="font-weight: bold; font-size: 12px; color: #334155;">Foto Gedung / Kantor</label>
                                    <div class="wkl-upload-wrap" style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px;">
                                        <img id="kantor_foto_preview_<?php echo $index; ?>" src="<?php echo esc_url($foto_url); ?>" style="width: 100%; height: 130px; border-radius: 8px; border: 1px solid #cbd5e1; object-fit: cover; background: #fff; <?php echo empty($foto_url) ? 'display:none;' : ''; ?>" />
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

                                    <div style="margin-top: 5px;">
                                        <label style="font-weight: bold; font-size: 11px; display: block; margin-bottom: 4px; color: #334155;">Status Operasional</label>
                                        <select name="kantor_list_status[]" style="width: 100%;">
                                            <option value="Beroperasi Normal" <?php selected( $kantor['status'] ?? '', 'Beroperasi Normal' ); ?>>🟢 Beroperasi Normal</option>
                                            <option value="Dalam Renovasi" <?php selected( $kantor['status'] ?? '', 'Dalam Renovasi' ); ?>>🟡 Dalam Renovasi</option>
                                            <option value="Segera Hadir" <?php selected( $kantor['status'] ?? '', 'Segera Hadir' ); ?>>🔵 Segera Hadir</option>
                                        </select>
                                    </div>

                                    <div style="margin-top: 5px;">
                                        <label style="font-weight: bold; font-size: 11px; display: block; margin-bottom: 4px; color: #334155;">Urutan Tampil</label>
                                        <input type="number" name="kantor_list_urutan[]" value="<?php echo esc_attr( $kantor['urutan'] ?? ($index+1) ); ?>" style="width: 80px;" class="wkl-urutan-input">
                                    </div>
                                </div>

                                <!-- Right: Data Form Fields -->
                                <div style="flex: 1; min-width: 280px; display: flex; flex-direction: column; gap: 12px;">
                                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                                        <div style="flex: 2; min-width: 220px;">
                                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Nama Kantor</label>
                                            <input type="text" name="kantor_list_nama[]" value="<?php echo esc_attr( $kantor['nama'] ?? '' ); ?>" class="large-text wkl-kantor-input-name" placeholder="misal: Kantor Kas Cikupa" style="font-weight: bold;" required>
                                        </div>
                                        <div style="flex: 1; min-width: 180px;">
                                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Tipe Kantor</label>
                                            <select name="kantor_list_tipe[]" class="large-text">
                                                <option value="Kantor Pusat Operasional" <?php selected( $kantor['tipe'] ?? '', 'Kantor Pusat Operasional' ); ?>>Kantor Pusat Operasional</option>
                                                <option value="Kantor Cabang" <?php selected( $kantor['tipe'] ?? '', 'Kantor Cabang' ); ?>>Kantor Cabang</option>
                                                <option value="Kantor Kas" <?php selected( $kantor['tipe'] ?? '', 'Kantor Kas' ); ?>>Kantor Kas</option>
                                                <option value="Kantor Layanan" <?php selected( $kantor['tipe'] ?? '', 'Kantor Layanan' ); ?>>Kantor Layanan</option>
                                                <option value="Kas Keliling / ATM" <?php selected( $kantor['tipe'] ?? '', 'Kas Keliling / ATM' ); ?>>Kas Keliling / ATM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                                        <div style="flex: 2; min-width: 220px;">
                                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Alamat Lengkap</label>
                                            <textarea name="kantor_list_alamat[]" rows="3" class="large-text" placeholder="Jl. Raya Serang Km 15..."><?php echo esc_textarea( $kantor['alamat'] ?? '' ); ?></textarea>
                                        </div>
                                        <div style="flex: 1; min-width: 180px;">
                                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Kota / Kabupaten</label>
                                            <input type="text" name="kantor_list_kota_kab[]" value="<?php echo esc_attr( $kantor['kota_kab'] ?? '' ); ?>" class="large-text" placeholder="misal: Kab. Tangerang">
                                            
                                            <label style="display: block; font-weight: bold; font-size: 12px; margin-top: 8px; margin-bottom: 4px; color: #334155;">Jam Operasional</label>
                                            <input type="text" name="kantor_list_jam[]" value="<?php echo esc_attr( $kantor['jam_operasional'] ?? 'Senin - Jumat: 08.00 - 15.00 WIB' ); ?>" class="large-text">
                                        </div>
                                    </div>

                                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                                        <div style="flex: 1; min-width: 180px;">
                                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Nomor Telepon</label>
                                            <input type="text" name="kantor_list_telepon[]" value="<?php echo esc_attr( $kantor['telepon'] ?? '' ); ?>" class="large-text" placeholder="(021) 7401667">
                                        </div>
                                        <div style="flex: 1; min-width: 180px;">
                                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">WhatsApp Hotline Kantor</label>
                                            <input type="text" name="kantor_list_whatsapp[]" value="<?php echo esc_attr( $kantor['whatsapp'] ?? '' ); ?>" class="large-text" placeholder="081517380388">
                                        </div>
                                    </div>

                                    <div>
                                        <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Tautan Google Maps Langsung (Petunjuk Arah)</label>
                                        <input type="url" name="kantor_list_gmaps_url[]" value="<?php echo esc_attr( $kantor['gmaps_url'] ?? '' ); ?>" class="large-text" placeholder="https://maps.google.com/?q=...">
                                        <p class="description" style="font-size: 11px;">Tempel link share dari Google Maps. Saat nasabah mengklik, rute GPS langsung terbuka di aplikasi HP mereka.</p>
                                    </div>

                                    <div>
                                        <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Fasilitas & Layanan di Kantor Ini (Pisahkan dengan koma)</label>
                                        <textarea name="kantor_list_layanan[]" rows="2" class="large-text" placeholder="misal: Setoran & Penarikan Tunai, Pembukaan Tabungan Syariah, Pengajuan Pembiayaan..."><?php echo esc_textarea( $kantor['layanan'] ?? '' ); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button type="button" id="wkl-add-kantor" class="button button-secondary" style="margin-top: 15px; font-weight: bold; border-color: #088395; color: #088395; display: inline-flex; align-items: center; gap: 5px;">
                    <span class="dashicons dashicons-plus-alt" style="vertical-align: middle;"></span> + Tambah Kantor Baru
                </button>
            </div>

            <!-- SECTION 4: Standar Kenyamanan Nasabah (Amenities / Komitmen) -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px;">
                <h2 style="font-size: 17px; margin: 0 0 18px 0; padding-bottom: 12px; border-bottom: 2px solid #f1f5f9; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-heart"></span> Seksi 4: Standar Kenyamanan Nasabah (Kartu Komitmen Layanan)
                </h2>

                <h3 style="font-size: 14px; font-weight: 700; color: #334155; margin: 15px 0 10px 0;">A. Judul & Header Seksi</h3>
                <table class="form-table" role="presentation" style="margin-bottom: 20px;">
                    <tr>
                        <th scope="row"><label for="options_kantor_amenities_badge">Badge Seksi</label></th>
                        <td><input type="text" id="options_kantor_amenities_badge" name="options_kantor_amenities_badge" value="<?php echo esc_attr( $amenities_badge ); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_kantor_amenities_title">Judul Seksi</label></th>
                        <td><input type="text" id="options_kantor_amenities_title" name="options_kantor_amenities_title" value="<?php echo esc_attr( $amenities_title ); ?>" class="large-text" style="font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_kantor_amenities_desc">Deskripsi Seksi</label></th>
                        <td><textarea id="options_kantor_amenities_desc" name="options_kantor_amenities_desc" rows="2" class="large-text"><?php echo esc_textarea( $amenities_desc ); ?></textarea></td>
                    </tr>
                </table>

                <h3 style="font-size: 14px; font-weight: 700; color: #334155; margin: 20px 0 10px 0; padding-top: 15px; border-top: 1px dashed #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                    <span>B. Daftar Kartu Komitmen Pelayanan (3-Tone, Pilihan Warna Dinamis & Hover Watermark)</span>
                </h3>
                <p style="font-size: 12px; color: #64748b; margin-top: 0; margin-bottom: 15px;">
                    Gunakan tombol <strong>🔼 Naik</strong> atau <strong>🔽 Turun</strong> untuk mengatur posisi kartu pada frontend. Anda juga dapat memilih <strong>Tema Warna Card</strong> secara bebas untuk setiap kartu.
                </p>

                <div id="amenities-container" style="display: flex; flex-direction: column; gap: 15px;">
                    <?php foreach ( $amenities_list as $am_idx => $amenity ) : ?>
                        <div class="wkl-sortable-amenity" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px; position: relative;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span class="wkl-amenity-badge-order" style="background: #088395; color: #fff; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 6px;">#<?php echo $am_idx + 1; ?></span>
                                    <strong style="font-size: 14px; color: #0f172a;" class="wkl-amenity-title-preview"><?php echo esc_html( $amenity['title'] ?? 'Komitmen Pelayanan' ); ?></strong>
                                </div>
                                <div style="display: flex; gap: 5px;">
                                    <button type="button" class="button button-small wkl-btn-up-amenity" title="Geser ke Atas">🔼 Naik</button>
                                    <button type="button" class="button button-small wkl-btn-down-amenity" title="Geser ke Bawah">🔽 Turun</button>
                                    <button type="button" class="button button-small button-link-delete wkl-btn-delete-amenity" style="color: #ef4444;" title="Hapus">✕ Hapus</button>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 140px 180px; gap: 12px; margin-bottom: 10px;">
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Judul Komitmen</label>
                                    <input type="text" name="amenity_title[]" value="<?php echo esc_attr( $amenity['title'] ?? '' ); ?>" class="large-text wkl-amenity-input-title" placeholder="misal: Lokasi Strategis" style="font-weight: 600;">
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Tipe Icon</label>
                                    <select name="amenity_icon[]" style="width: 100%;">
                                        <option value="pin" <?php selected( $amenity['icon'] ?? '', 'pin' ); ?>>📍 Pin / Lokasi</option>
                                        <option value="users" <?php selected( $amenity['icon'] ?? '', 'users' ); ?>>👥 Ramah / SAPA</option>
                                        <option value="shield" <?php selected( $amenity['icon'] ?? '', 'shield' ); ?>>🛡️ OJK & Syariah</option>
                                        <option value="lock" <?php selected( $amenity['icon'] ?? '', 'lock' ); ?>>🔒 Aman / LPS</option>
                                        <option value="star" <?php selected( $amenity['icon'] ?? '', 'star' ); ?>>⭐ Bintang / Prima</option>
                                        <option value="award" <?php selected( $amenity['icon'] ?? '', 'award' ); ?>>🏆 Penghargaan</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Tema Warna Card</label>
                                    <select name="amenity_color[]" style="width: 100%;">
                                        <option value="auto" <?php selected( $amenity['color'] ?? 'auto', 'auto' ); ?>>🔄 Otomatis (Sesuai Urutan)</option>
                                        <option value="teal" <?php selected( $amenity['color'] ?? '', 'teal' ); ?>>🟢 Teal (Hijau Syariah)</option>
                                        <option value="sky" <?php selected( $amenity['color'] ?? '', 'sky' ); ?>>🔵 Sky (Biru Perbankan)</option>
                                        <option value="amber" <?php selected( $amenity['color'] ?? '', 'amber' ); ?>>🟡 Amber (Emas Elegan)</option>
                                        <option value="indigo" <?php selected( $amenity['color'] ?? '', 'indigo' ); ?>>🟣 Indigo (Ungu Modern)</option>
                                        <option value="rose" <?php selected( $amenity['color'] ?? '', 'rose' ); ?>>🔴 Rose (Merah Aksen)</option>
                                        <option value="emerald" <?php selected( $amenity['color'] ?? '', 'emerald' ); ?>>🌿 Emerald (Hijau Berkah)</option>
                                    </select>
                                </div>
                            </div>

                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Uraian Keterangan</label>
                                <textarea name="amenity_desc[]" rows="2" class="large-text" placeholder="Uraian komitmen layanan kantor..."><?php echo esc_textarea( $amenity['desc'] ?? '' ); ?></textarea>
                            </div>

                            <div>
                                <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Tag Status Bawah (Pill Footer)</label>
                                <input type="text" name="amenity_tag[]" value="<?php echo esc_attr( $amenity['tag'] ?? '' ); ?>" class="large-text" placeholder="misal: Akses Mudah & Parkir Luas">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button type="button" id="btn-add-amenity" class="button button-secondary" style="margin-top: 15px; display: inline-flex; align-items: center; gap: 5px;">
                    <span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px;"></span> + Tambah Komitmen Pelayanan
                </button>
            </div>

            <!-- SECTION 5: Pengaturan CTA Banner -->
            <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px;">
                <h2 style="font-size: 17px; margin: 0 0 18px 0; padding-bottom: 12px; border-bottom: 2px solid #f1f5f9; color: #088395; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-megaphone"></span> Seksi 5: Pengaturan Call to Action (CTA Bawah)
                </h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row">Tampilkan Banner CTA?</th>
                        <td>
                            <label>
                                <input type="checkbox" name="options_kantor_cta_show" value="1" <?php checked( $cta_show, '1' ); ?>>
                                Ya, tampilkan banner CTA di bagian bawah halaman jaringan kantor.
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_kantor_cta_badge">Badge CTA</label></th>
                        <td><input type="text" id="options_kantor_cta_badge" name="options_kantor_cta_badge" value="<?php echo esc_attr( $cta_badge ); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_kantor_cta_title">Judul CTA</label></th>
                        <td><input type="text" id="options_kantor_cta_title" name="options_kantor_cta_title" value="<?php echo esc_attr( $cta_title ); ?>" class="large-text" style="font-weight: bold;" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_kantor_cta_desc">Deskripsi Singkat</label></th>
                        <td><textarea id="options_kantor_cta_desc" name="options_kantor_cta_desc" rows="3" class="large-text"><?php echo esc_textarea( $cta_desc ); ?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_kantor_cta_btn1_text">Tombol Utama (WhatsApp)</label></th>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" name="options_kantor_cta_btn1_text" value="<?php echo esc_attr( $cta_btn1_text ); ?>" class="regular-text" placeholder="Teks Tombol" />
                                <input type="text" name="options_kantor_cta_btn1_url" value="<?php echo esc_attr( $cta_btn1_url ); ?>" class="large-text" placeholder="https://wa.me/..." />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="options_kantor_cta_btn2_text">Tombol Sekunder</label></th>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" name="options_kantor_cta_btn2_text" value="<?php echo esc_attr( $cta_btn2_text ); ?>" class="regular-text" placeholder="Teks Tombol" />
                                <input type="text" name="options_kantor_cta_btn2_url" value="<?php echo esc_attr( $cta_btn2_url ); ?>" class="large-text" placeholder="https://" />
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Sticky Save Bar -->
            <div style="position: sticky; bottom: 20px; background: #0f172a; padding: 16px 25px; border-radius: 12px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: space-between; z-index: 50;">
                <span style="color: #94a3b8; font-size: 13px;">Pastikan data kantor dan kontak telah diverifikasi sebelum menyimpan.</span>
                <button type="submit" name="wakalumi_kantor_submit" class="button button-primary button-large" style="background: #088395; border-color: #066e7d; font-weight: bold; padding: 0 25px;">
                    💾 Simpan Semua Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Hidden Template for New Office Item -->
    <script type="text/template" id="tmpl-kantor-card">
        <div class="kantor-card wkl-sortable-kantor" style="border-left: 4px solid #088395; background: #f8fafc; border-radius: 10px; border-top: 1px solid #cbd5e1; border-right: 1px solid #cbd5e1; border-bottom: 1px solid #cbd5e1; padding: 20px; position: relative;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span class="wkl-kantor-index-badge" style="background: #088395; color: #fff; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 6px;">#{{order}}</span>
                    <strong style="font-size: 15px; color: #0f172a;" class="wkl-kantor-title-preview">Kantor Baru</strong>
                    <span style="font-size: 11px; color: #64748b; background: #e2e8f0; padding: 2px 8px; border-radius: 10px; font-weight: 600;">Kantor Kas</span>
                </div>
                <div style="display: flex; gap: 5px;">
                    <button type="button" class="button button-small wkl-btn-up-kantor" title="Geser ke Atas">🔼 Naik</button>
                    <button type="button" class="button button-small wkl-btn-down-kantor" title="Geser ke Bawah">🔽 Turun</button>
                    <button type="button" class="button button-small button-link-delete wkl-delete-kantor" style="color: #ef4444;" title="Hapus Kantor">✕ Hapus</button>
                </div>
            </div>

            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div style="flex: 0 0 210px; display: flex; flex-direction: column; gap: 10px;">
                    <label style="font-weight: bold; font-size: 12px; color: #334155;">Foto Gedung / Kantor</label>
                    <div class="wkl-upload-wrap" style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px;">
                        <img id="kantor_foto_preview_{{id}}" src="" style="width: 100%; height: 130px; border-radius: 8px; border: 1px solid #cbd5e1; object-fit: cover; background: #fff; display: none;" />
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

                    <div style="margin-top: 5px;">
                        <label style="font-weight: bold; font-size: 11px; display: block; margin-bottom: 4px; color: #334155;">Status Operasional</label>
                        <select name="kantor_list_status[]" style="width: 100%;">
                            <option value="Beroperasi Normal">🟢 Beroperasi Normal</option>
                            <option value="Dalam Renovasi">🟡 Dalam Renovasi</option>
                            <option value="Segera Hadir">🔵 Segera Hadir</option>
                        </select>
                    </div>

                    <div style="margin-top: 5px;">
                        <label style="font-weight: bold; font-size: 11px; display: block; margin-bottom: 4px; color: #334155;">Urutan Tampil</label>
                        <input type="number" name="kantor_list_urutan[]" value="{{order}}" style="width: 80px;" class="wkl-urutan-input">
                    </div>
                </div>

                <div style="flex: 1; min-width: 280px; display: flex; flex-direction: column; gap: 12px;">
                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                        <div style="flex: 2; min-width: 220px;">
                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Nama Kantor</label>
                            <input type="text" name="kantor_list_nama[]" value="" class="large-text wkl-kantor-input-name" placeholder="misal: Kantor Kas..." style="font-weight: bold;" required>
                        </div>
                        <div style="flex: 1; min-width: 180px;">
                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Tipe Kantor</label>
                            <select name="kantor_list_tipe[]" class="large-text">
                                <option value="Kantor Pusat Operasional">Kantor Pusat Operasional</option>
                                <option value="Kantor Cabang">Kantor Cabang</option>
                                <option value="Kantor Kas" selected>Kantor Kas</option>
                                <option value="Kantor Layanan">Kantor Layanan</option>
                                <option value="Kas Keliling / ATM">Kas Keliling / ATM</option>
                            </select>
                        </div>
                    </div>

                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                        <div style="flex: 2; min-width: 220px;">
                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Alamat Lengkap</label>
                            <textarea name="kantor_list_alamat[]" rows="3" class="large-text" placeholder="Jl. ..."></textarea>
                        </div>
                        <div style="flex: 1; min-width: 180px;">
                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Kota / Kabupaten</label>
                            <input type="text" name="kantor_list_kota_kab[]" value="" class="large-text" placeholder="misal: Tangerang">
                            
                            <label style="display: block; font-weight: bold; font-size: 12px; margin-top: 8px; margin-bottom: 4px; color: #334155;">Jam Operasional</label>
                            <input type="text" name="kantor_list_jam[]" value="Senin - Jumat: 08.00 - 15.00 WIB" class="large-text">
                        </div>
                    </div>

                    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 180px;">
                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Nomor Telepon</label>
                            <input type="text" name="kantor_list_telepon[]" value="" class="large-text" placeholder="(021) ...">
                        </div>
                        <div style="flex: 1; min-width: 180px;">
                            <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">WhatsApp Hotline Kantor</label>
                            <input type="text" name="kantor_list_whatsapp[]" value="" class="large-text" placeholder="08...">
                        </div>
                    </div>

                    <div>
                        <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Tautan Google Maps Langsung (Petunjuk Arah)</label>
                        <input type="url" name="kantor_list_gmaps_url[]" value="" class="large-text" placeholder="https://maps.google.com/?q=...">
                        <p class="description" style="font-size: 11px;">Tempel link share dari Google Maps.</p>
                    </div>

                    <div>
                        <label style="display: block; font-weight: bold; font-size: 12px; margin-bottom: 4px; color: #334155;">Fasilitas & Layanan di Kantor Ini</label>
                        <textarea name="kantor_list_layanan[]" rows="2" class="large-text" placeholder="Setoran, Penarikan, Pembukaan Tabungan..."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <!-- Admin JS for Repeaters (Offices & Amenities) & Media Upload -->
    <script>
    jQuery(document).ready(function($) {
        // ── Helper to update indices & order values ──
        function updateOfficeIndices() {
            $('#wkl-kantor-container .wkl-sortable-kantor').each(function(i) {
                $(this).find('.wkl-kantor-index-badge').text('#' + (i + 1));
                $(this).find('.wkl-urutan-input').val(i + 1);
            });
        }

        function updateAmenityIndices() {
            $('#amenities-container .wkl-sortable-amenity').each(function(i) {
                $(this).find('.wkl-amenity-badge-order').text('#' + (i + 1));
            });
        }

        // Live preview title update
        $(document).on('input', '.wkl-kantor-input-name', function() {
            var val = $(this).val().trim();
            $(this).closest('.wkl-sortable-kantor').find('.wkl-kantor-title-preview').text(val || 'Kantor Baru');
        });

        $(document).on('input', '.wkl-amenity-input-title', function() {
            var val = $(this).val().trim();
            $(this).closest('.wkl-sortable-amenity').find('.wkl-amenity-title-preview').text(val || 'Komitmen Pelayanan');
        });

        // ── 1. Reorder Up / Down for Office Cards ──
        $(document).on('click', '.wkl-btn-up-kantor', function(e) {
            e.preventDefault();
            var card = $(this).closest('.wkl-sortable-kantor');
            var prev = card.prev('.wkl-sortable-kantor');
            if (prev.length) {
                card.insertBefore(prev);
                updateOfficeIndices();
            }
        });

        $(document).on('click', '.wkl-btn-down-kantor', function(e) {
            e.preventDefault();
            var card = $(this).closest('.wkl-sortable-kantor');
            var next = card.next('.wkl-sortable-kantor');
            if (next.length) {
                card.insertAfter(next);
                updateOfficeIndices();
            }
        });

        // ── 2. Add New Office Card ──
        $('#wkl-add-kantor').on('click', function(e) {
            e.preventDefault();
            var uniqueId = 'new_' + new Date().getTime();
            var count = $('#wkl-kantor-container .wkl-sortable-kantor').length + 1;
            var template = $('#tmpl-kantor-card').html();
            var html = template.replace(/{{id}}/g, uniqueId).replace(/{{order}}/g, count);
            $('#wkl-kantor-container').append(html);

            $('html, body').animate({
                scrollTop: $('#wkl-kantor-container .wkl-sortable-kantor:last').offset().top - 80
            }, 300);
        });

        // ── 3. Delete Office Card ──
        $('#wkl-kantor-container').on('click', '.wkl-delete-kantor', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus kantor ini?')) {
                var card = $(this).closest('.wkl-sortable-kantor');
                card.fadeOut(250, function() {
                    card.remove();
                    updateOfficeIndices();
                });
            }
        });

        // ── 4. Reorder Up / Down for Amenities ──
        $(document).on('click', '.wkl-btn-up-amenity', function(e) {
            e.preventDefault();
            var card = $(this).closest('.wkl-sortable-amenity');
            var prev = card.prev('.wkl-sortable-amenity');
            if (prev.length) {
                card.insertBefore(prev);
                updateAmenityIndices();
            }
        });

        $(document).on('click', '.wkl-btn-down-amenity', function(e) {
            e.preventDefault();
            var card = $(this).closest('.wkl-sortable-amenity');
            var next = card.next('.wkl-sortable-amenity');
            if (next.length) {
                card.insertAfter(next);
                updateAmenityIndices();
            }
        });

        // ── 5. Add New Amenity ──
        $('#btn-add-amenity').on('click', function(e) {
            e.preventDefault();
            var count = $('#amenities-container .wkl-sortable-amenity').length + 1;
            var html = `
                <div class="wkl-sortable-amenity" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px; position: relative;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span class="wkl-amenity-badge-order" style="background: #088395; color: #fff; font-size: 11px; font-weight: 800; padding: 2px 8px; border-radius: 6px;">#${count}</span>
                            <strong style="font-size: 14px; color: #0f172a;" class="wkl-amenity-title-preview">Komitmen Baru</strong>
                        </div>
                        <div style="display: flex; gap: 5px;">
                            <button type="button" class="button button-small wkl-btn-up-amenity">🔼 Naik</button>
                            <button type="button" class="button button-small wkl-btn-down-amenity">🔽 Turun</button>
                            <button type="button" class="button button-small button-link-delete wkl-btn-delete-amenity" style="color: #ef4444;">✕ Hapus</button>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 140px 180px; gap: 12px; margin-bottom: 10px;">
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Judul Komitmen</label>
                            <input type="text" name="amenity_title[]" value="" class="large-text wkl-amenity-input-title" placeholder="misal: Standar Pelayanan Prima" style="font-weight: 600;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Tipe Icon</label>
                            <select name="amenity_icon[]" style="width: 100%;">
                                <option value="pin">📍 Pin / Lokasi</option>
                                <option value="users">👥 Ramah / SAPA</option>
                                <option value="shield">🛡️ OJK & Syariah</option>
                                <option value="lock">🔒 Aman / LPS</option>
                                <option value="star" selected>⭐ Bintang / Prima</option>
                                <option value="award">🏆 Penghargaan</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Tema Warna Card</label>
                            <select name="amenity_color[]" style="width: 100%;">
                                <option value="auto" selected>🔄 Otomatis (Sesuai Urutan)</option>
                                <option value="teal">🟢 Teal (Hijau Syariah)</option>
                                <option value="sky">🔵 Sky (Biru Perbankan)</option>
                                <option value="amber">🟡 Amber (Emas Elegan)</option>
                                <option value="indigo">🟣 Indigo (Ungu Modern)</option>
                                <option value="rose">🔴 Rose (Merah Aksen)</option>
                                <option value="emerald">🌿 Emerald (Hijau Berkah)</option>
                            </select>
                        </div>
                    </div>
                    <div style="margin-bottom: 10px;">
                        <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Uraian Keterangan</label>
                        <textarea name="amenity_desc[]" rows="2" class="large-text" placeholder="Uraian komitmen layanan kantor..."></textarea>
                    </div>
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: bold; color: #475569; margin-bottom: 4px;">Tag Status Bawah (Pill Footer)</label>
                        <input type="text" name="amenity_tag[]" value="Komitmen Wakalumi" class="large-text">
                    </div>
                </div>
            `;
            $('#amenities-container').append(html);
        });

        // ── 6. Delete Amenity ──
        $('#amenities-container').on('click', '.wkl-btn-delete-amenity', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus komitmen ini?')) {
                var card = $(this).closest('.wkl-sortable-amenity');
                card.fadeOut(250, function() {
                    card.remove();
                    updateAmenityIndices();
                });
            }
        });

        // ── 7. WP Media Uploader ──
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

        // ── 8. Remove Image ──
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
