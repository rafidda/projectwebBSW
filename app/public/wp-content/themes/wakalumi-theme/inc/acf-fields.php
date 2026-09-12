<?php
/**
 * ACF Field Groups — registered via PHP for portability
 *
 * All front-page content fields + Nisbah options page.
 * Requires ACF (Advanced Custom Fields) plugin to be active.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ========================================================================
// ACF OPTIONS PAGE — Informasi Nisbah & Pengaturan Umum
// ========================================================================
if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_page( [
        'page_title' => 'Pengaturan Umum Website',
        'menu_title' => 'Pengaturan Website',
        'menu_slug'  => 'wakalumi-settings',
        'capability' => 'edit_posts',
        'redirect'   => true,
        'icon_url'   => 'dashicons-admin-settings',
        'position'   => 2,
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'Informasi Nisbah',
        'menu_title'  => 'Informasi Nisbah',
        'parent_slug' => 'wakalumi-settings',
        'menu_slug'   => 'wakalumi-nisbah',
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'Kontak & WhatsApp',
        'menu_title'  => 'Kontak & WhatsApp',
        'parent_slug' => 'wakalumi-settings',
        'menu_slug'   => 'wakalumi-contact',
    ] );

    acf_add_options_sub_page( [
        'page_title'  => 'Footer & Sosial Media',
        'menu_title'  => 'Footer & Sosmed',
        'parent_slug' => 'wakalumi-settings',
        'menu_slug'   => 'wakalumi-footer',
    ] );
}

// ========================================================================
// REGISTER FIELD GROUPS
// ========================================================================
function wakalumi_register_acf_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // ──────────────────────────────────────
    // FRONT PAGE — Hero Section
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_hero',
        'title'    => '🏠 Hero Section',
        'fields'   => [
            [
                'key'          => 'field_hero_headline',
                'label'        => 'Headline Utama',
                'name'         => 'hero_headline',
                'type'         => 'text',
                'default_value'=> 'Bank Syariah Terpercaya untuk Masa Depan Anda',
                'instructions' => 'Judul besar yang muncul di hero section.',
            ],
            [
                'key'          => 'field_hero_subheadline',
                'label'        => 'Sub-Headline',
                'name'         => 'hero_subheadline',
                'type'         => 'textarea',
                'rows'         => 3,
                'default_value'=> 'Melayani dengan prinsip syariah, memberikan solusi keuangan yang amanah dan berkah bagi seluruh masyarakat.',
                'instructions' => 'Teks pendukung di bawah judul utama.',
            ],
            [
                'key'          => 'field_hero_cta_text_1',
                'label'        => 'Tombol CTA 1 — Teks',
                'name'         => 'hero_cta_text_1',
                'type'         => 'text',
                'default_value'=> 'Hubungi Kami',
            ],
            [
                'key'          => 'field_hero_cta_url_1',
                'label'        => 'Tombol CTA 1 — Link',
                'name'         => 'hero_cta_url_1',
                'type'         => 'url',
                'default_value'=> '#kontak',
                'instructions' => 'Bisa diisi link WhatsApp (wa.me/62xxx) atau URL halaman.',
            ],
            [
                'key'          => 'field_hero_cta_text_2',
                'label'        => 'Tombol CTA 2 — Teks',
                'name'         => 'hero_cta_text_2',
                'type'         => 'text',
                'default_value'=> 'Lihat Produk',
            ],
            [
                'key'          => 'field_hero_cta_url_2',
                'label'        => 'Tombol CTA 2 — Link',
                'name'         => 'hero_cta_url_2',
                'type'         => 'url',
                'default_value'=> '/produk',
            ],
            [
                'key'          => 'field_hero_background',
                'label'        => 'Gambar Background Hero',
                'name'         => 'hero_background',
                'type'         => 'image',
                'return_format'=> 'array',
                'preview_size' => 'medium',
                'instructions' => 'Ukuran ideal: 1920×1080px. Opsional — jika kosong, akan memakai gradient default.',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ],
            ],
        ],
        'position'      => 'normal',
        'style'         => 'default',
        'menu_order'    => 0,
    ] );

    // ──────────────────────────────────────
    // FRONT PAGE — Stats Counter
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_stats',
        'title'    => '📊 Angka/Statistik',
        'fields'   => [
            [
                'key'          => 'field_stats',
                'label'        => 'Data Statistik',
                'name'         => 'stats',
                'type'         => 'repeater',
                'layout'       => 'table',
                'min'          => 1,
                'max'          => 6,
                'button_label' => 'Tambah Statistik',
                'sub_fields'   => [
                    [
                        'key'   => 'field_stat_number',
                        'label' => 'Angka',
                        'name'  => 'stat_number',
                        'type'  => 'text',
                        'instructions' => 'Angka saja, misal: 50',
                        'wrapper' => [ 'width' => '20' ],
                    ],
                    [
                        'key'   => 'field_stat_suffix',
                        'label' => 'Suffix',
                        'name'  => 'stat_suffix',
                        'type'  => 'text',
                        'instructions' => 'Misal: +, Miliar, Juta, Tahun',
                        'wrapper' => [ 'width' => '15' ],
                    ],
                    [
                        'key'   => 'field_stat_label',
                        'label' => 'Label',
                        'name'  => 'stat_label',
                        'type'  => 'text',
                        'instructions' => 'Misal: Kantor Cabang',
                        'wrapper' => [ 'width' => '30' ],
                    ],
                    [
                        'key'     => 'field_stat_icon',
                        'label'   => 'Icon',
                        'name'    => 'stat_icon',
                        'type'    => 'select',
                        'choices' => [
                            'building'  => '🏢 Kantor',
                            'users'     => '👥 Nasabah',
                            'chart'     => '📈 Aset',
                            'calendar'  => '📅 Tahun',
                            'shield'    => '🛡️ Keamanan',
                            'handshake' => '🤝 Kerjasama',
                        ],
                        'wrapper' => [ 'width' => '20' ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ],
            ],
        ],
        'menu_order' => 1,
    ] );

    // ──────────────────────────────────────
    // FRONT PAGE — About Preview
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_about_preview',
        'title'    => '📝 Tentang Kami (Preview)',
        'fields'   => [
            [
                'key'          => 'field_about_label',
                'label'        => 'Label Section',
                'name'         => 'about_label',
                'type'         => 'text',
                'default_value'=> 'Tentang Kami',
            ],
            [
                'key'          => 'field_about_title',
                'label'        => 'Judul',
                'name'         => 'about_title',
                'type'         => 'text',
                'default_value'=> 'Melayani dengan Prinsip Syariah Sejak Hari Pertama',
            ],
            [
                'key'          => 'field_about_content',
                'label'        => 'Isi Singkat',
                'name'         => 'about_content',
                'type'         => 'wysiwyg',
                'media_upload' => false,
                'toolbar'      => 'basic',
                'default_value'=> '<p>BPRS Wakalumi hadir sebagai bank syariah yang berkomitmen memberikan layanan keuangan terbaik berdasarkan prinsip-prinsip syariah Islam. Dengan pengalaman bertahun-tahun, kami terus bertumbuh melayani masyarakat.</p>',
            ],
            [
                'key'          => 'field_about_image',
                'label'        => 'Foto',
                'name'         => 'about_image',
                'type'         => 'image',
                'return_format'=> 'array',
                'preview_size' => 'medium',
                'instructions' => 'Foto kantor, tim, atau kegiatan. Ukuran ideal: 800×600px.',
            ],
            [
                'key'          => 'field_about_cta_text',
                'label'        => 'Teks Tombol',
                'name'         => 'about_cta_text',
                'type'         => 'text',
                'default_value'=> 'Selengkapnya',
            ],
            [
                'key'          => 'field_about_cta_url',
                'label'        => 'Link Tombol',
                'name'         => 'about_cta_url',
                'type'         => 'url',
                'default_value'=> '/profil/tentang-kami',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ],
            ],
        ],
        'menu_order' => 2,
    ] );

    // ──────────────────────────────────────
    // FRONT PAGE — CTA Section
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_cta',
        'title'    => '📣 CTA Section (Ajakan)',
        'fields'   => [
            [
                'key'          => 'field_cta_headline',
                'label'        => 'Judul CTA',
                'name'         => 'cta_headline',
                'type'         => 'text',
                'default_value'=> 'Siap Memulai Perjalanan Keuangan Syariah Anda?',
            ],
            [
                'key'          => 'field_cta_subtext',
                'label'        => 'Sub-Teks',
                'name'         => 'cta_subtext',
                'type'         => 'textarea',
                'rows'         => 2,
                'default_value'=> 'Hubungi kami untuk konsultasi gratis atau kunjungi kantor cabang terdekat.',
            ],
            [
                'key'          => 'field_cta_button_text',
                'label'        => 'Teks Tombol',
                'name'         => 'cta_button_text',
                'type'         => 'text',
                'default_value'=> 'Chat via WhatsApp',
            ],
            [
                'key'          => 'field_cta_button_secondary_text',
                'label'        => 'Teks Tombol Kedua (opsional)',
                'name'         => 'cta_button_secondary_text',
                'type'         => 'text',
                'default_value'=> 'Lihat Jaringan Kantor',
            ],
            [
                'key'          => 'field_cta_button_secondary_url',
                'label'        => 'Link Tombol Kedua',
                'name'         => 'cta_button_secondary_url',
                'type'         => 'url',
                'default_value'=> '/profil/jaringan-kantor',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                ],
            ],
        ],
        'menu_order' => 3,
    ] );

    // ──────────────────────────────────────
    // OPTIONS — Informasi Nisbah
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_nisbah',
        'title'    => '📊 Data Nisbah Bulanan',
        'fields'   => [
            [
                'key'          => 'field_nisbah_bulan',
                'label'        => 'Periode (Bulan & Tahun)',
                'name'         => 'nisbah_bulan',
                'type'         => 'text',
                'instructions' => 'Contoh: September 2026',
                'default_value'=> 'September 2026',
            ],
            [
                'key'          => 'field_nisbah_data',
                'label'        => 'Data Nisbah',
                'name'         => 'nisbah_data',
                'type'         => 'repeater',
                'layout'       => 'table',
                'min'          => 1,
                'max'          => 20,
                'button_label' => 'Tambah Produk',
                'sub_fields'   => [
                    [
                        'key'   => 'field_nisbah_produk',
                        'label' => 'Nama Produk',
                        'name'  => 'nisbah_produk',
                        'type'  => 'text',
                        'instructions' => 'Misal: Tabungan iB Wakalumi',
                        'wrapper' => [ 'width' => '30' ],
                    ],
                    [
                        'key'   => 'field_nisbah_nasabah',
                        'label' => 'Nisbah Nasabah (%)',
                        'name'  => 'nisbah_nasabah',
                        'type'  => 'text',
                        'instructions' => 'Misal: 30',
                        'wrapper' => [ 'width' => '15' ],
                    ],
                    [
                        'key'   => 'field_nisbah_bank',
                        'label' => 'Nisbah Bank (%)',
                        'name'  => 'nisbah_bank',
                        'type'  => 'text',
                        'instructions' => 'Misal: 70',
                        'wrapper' => [ 'width' => '15' ],
                    ],
                    [
                        'key'   => 'field_nisbah_equiv',
                        'label' => 'Equivalen Rate',
                        'name'  => 'nisbah_equiv',
                        'type'  => 'text',
                        'instructions' => 'Misal: 3.50%',
                        'wrapper' => [ 'width' => '15' ],
                    ],
                    [
                        'key'     => 'field_nisbah_jenis',
                        'label'   => 'Jenis',
                        'name'    => 'nisbah_jenis',
                        'type'    => 'select',
                        'choices' => [
                            'tabungan' => 'Tabungan',
                            'deposito' => 'Deposito',
                        ],
                        'wrapper' => [ 'width' => '15' ],
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'wakalumi-nisbah',
                ],
            ],
        ],
    ] );

    // ──────────────────────────────────────
    // OPTIONS — Kontak & WhatsApp
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_contact',
        'title'    => '📱 Kontak & WhatsApp',
        'fields'   => [
            [
                'key'          => 'field_whatsapp_number',
                'label'        => 'Nomor WhatsApp',
                'name'         => 'whatsapp_number',
                'type'         => 'text',
                'instructions' => 'Format internasional tanpa +, contoh: 6281234567890',
                'default_value'=> '6281234567890',
            ],
            [
                'key'          => 'field_whatsapp_message',
                'label'        => 'Pesan Default WhatsApp',
                'name'         => 'whatsapp_message',
                'type'         => 'text',
                'default_value'=> 'Halo, saya ingin bertanya tentang produk BPRS Wakalumi.',
                'instructions' => 'Pesan otomatis yang terisi saat pengunjung klik tombol WhatsApp.',
            ],
            [
                'key'          => 'field_phone',
                'label'        => 'Nomor Telepon Kantor',
                'name'         => 'phone',
                'type'         => 'text',
                'default_value'=> '(021) 1234567',
            ],
            [
                'key'          => 'field_email',
                'label'        => 'Email',
                'name'         => 'email',
                'type'         => 'email',
                'default_value'=> 'info@bprswakalumi.co.id',
            ],
            [
                'key'          => 'field_address',
                'label'        => 'Alamat Kantor Pusat',
                'name'         => 'address',
                'type'         => 'textarea',
                'rows'         => 3,
                'default_value'=> 'Jl. Contoh No. 123, Jakarta',
            ],
            [
                'key'          => 'field_maps_embed',
                'label'        => 'Google Maps Embed URL',
                'name'         => 'maps_embed',
                'type'         => 'url',
                'instructions' => 'URL embed dari Google Maps.',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'wakalumi-contact',
                ],
            ],
        ],
    ] );

    // ──────────────────────────────────────
    // OPTIONS — Footer & Social Media
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_footer',
        'title'    => '🦶 Footer & Sosial Media',
        'fields'   => [
            [
                'key'          => 'field_footer_about',
                'label'        => 'Deskripsi Singkat (Footer)',
                'name'         => 'footer_about',
                'type'         => 'textarea',
                'rows'         => 3,
                'default_value'=> 'BPRS Wakalumi adalah bank syariah yang berkomitmen melayani masyarakat dengan prinsip keuangan Islam yang amanah.',
            ],
            [
                'key'          => 'field_social_instagram',
                'label'        => 'URL Instagram',
                'name'         => 'social_instagram',
                'type'         => 'url',
            ],
            [
                'key'          => 'field_social_facebook',
                'label'        => 'URL Facebook',
                'name'         => 'social_facebook',
                'type'         => 'url',
            ],
            [
                'key'          => 'field_social_youtube',
                'label'        => 'URL YouTube',
                'name'         => 'social_youtube',
                'type'         => 'url',
            ],
            [
                'key'          => 'field_social_tiktok',
                'label'        => 'URL TikTok',
                'name'         => 'social_tiktok',
                'type'         => 'url',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'wakalumi-footer',
                ],
            ],
        ],
    ] );

    // ──────────────────────────────────────
    // CPT: Produk — Additional Fields
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_produk_fields',
        'title'    => '📦 Detail Produk',
        'fields'   => [
            [
                'key'          => 'field_produk_icon',
                'label'        => 'Icon Produk',
                'name'         => 'produk_icon',
                'type'         => 'select',
                'choices'      => [
                    'savings'    => '💰 Tabungan',
                    'deposit'    => '🏦 Deposito',
                    'financing'  => '📋 Pembiayaan',
                    'transfer'   => '💸 Transfer',
                    'insurance'  => '🛡️ Perlindungan',
                    'investment' => '📈 Investasi',
                ],
            ],
            [
                'key'          => 'field_produk_ringkasan',
                'label'        => 'Ringkasan Singkat',
                'name'         => 'produk_ringkasan',
                'type'         => 'textarea',
                'rows'         => 2,
                'instructions' => 'Ditampilkan di card produk (maks 2 kalimat).',
            ],
            [
                'key'          => 'field_produk_akad',
                'label'        => 'Akad',
                'name'         => 'produk_akad',
                'type'         => 'text',
                'instructions' => 'Jenis akad syariah (misal: Mudharabah, Wadiah, Murabahah).',
            ],
            [
                'key'          => 'field_produk_featured',
                'label'        => 'Tampilkan di Beranda?',
                'name'         => 'produk_featured',
                'type'         => 'true_false',
                'default_value'=> 0,
                'ui'           => 1,
                'instructions' => 'Aktifkan untuk menampilkan produk ini di halaman depan.',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'produk',
                ],
            ],
        ],
    ] );

    // ──────────────────────────────────────
    // CPT: Anggota Tim — Additional Fields
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_tim_fields',
        'title'    => '👤 Detail Anggota',
        'fields'   => [
            [
                'key'   => 'field_tim_jabatan',
                'label' => 'Jabatan',
                'name'  => 'tim_jabatan',
                'type'  => 'text',
            ],
            [
                'key'     => 'field_tim_urutan',
                'label'   => 'Urutan Tampil',
                'name'    => 'tim_urutan',
                'type'    => 'number',
                'default_value' => 0,
                'instructions'  => 'Angka kecil tampil duluan.',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'anggota_tim',
                ],
            ],
        ],
    ] );

    // ──────────────────────────────────────
    // CPT: Berita — Additional Fields
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_berita_fields',
        'title'    => '📰 Detail Berita',
        'fields'   => [
            [
                'key'          => 'field_berita_ringkasan',
                'label'        => 'Ringkasan',
                'name'         => 'berita_ringkasan',
                'type'         => 'textarea',
                'rows'         => 2,
                'instructions' => 'Ringkasan singkat untuk ditampilkan di card dan daftar berita.',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'berita',
                ],
            ],
        ],
    ] );
}
add_action( 'acf/init', 'wakalumi_register_acf_fields' );

// ========================================================================
// HELPER: Get WhatsApp URL
// ========================================================================
function wakalumi_get_whatsapp_url() {
    $number  = get_field( 'whatsapp_number', 'option' ) ?: '6281234567890';
    $message = get_field( 'whatsapp_message', 'option' ) ?: 'Halo, saya ingin bertanya tentang produk BPRS Wakalumi.';
    return 'https://wa.me/' . $number . '?text=' . rawurlencode( $message );
}

// ========================================================================
// HELPER: Get stat icon SVG
// ========================================================================
function wakalumi_get_stat_icon( $icon_key ) {
    $icons = [
        'building'  => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg>',
        'users'     => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>',
        'chart'     => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" /></svg>',
        'calendar'  => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>',
        'shield'    => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>',
        'handshake' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3.15M10.05 4.575a1.575 1.575 0 013.15 0v3.15M10.05 4.575V2.7c0-.332.15-.65.414-.893A8.97 8.97 0 0112 1.35c.563 0 1.11.06 1.636.172M13.2 7.725V4.575m0 0V2.7c0-.332-.15-.65-.414-.893M13.2 7.725l3.15-3.15m-3.15 3.15H10.05m3.15 0l-3.15-3.15" /></svg>',
    ];
    return $icons[ $icon_key ] ?? $icons['building'];
}

// ========================================================================
// HELPER: Get produk icon SVG
// ========================================================================
function wakalumi_get_produk_icon( $icon_key ) {
    $icons = [
        'savings'    => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
        'deposit'    => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 0h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" /></svg>',
        'financing'  => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>',
        'transfer'   => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" /></svg>',
        'insurance'  => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>',
        'investment' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" /></svg>',
    ];
    return $icons[ $icon_key ] ?? $icons['savings'];
}

