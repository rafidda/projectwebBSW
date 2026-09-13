<?php
/**
 * ACF Field Groups — registered via PHP for portability
 *
 * Front-page content fields + CPT fields.
 * Fully compatible with ACF (Free) — zero paid plugins required.
 * Options Pages are handled natively by inc/admin-options.php.
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ========================================================================
// REGISTER FIELD GROUPS
// ========================================================================
function wakalumi_register_acf_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    // ──────────────────────────────────────
    // FRONT PAGE — Tentang Kami (About Preview)
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_about_preview',
        'title'    => '🏢 Tentang Kami (Preview Beranda)',
        'fields'   => [
            [
                'key'          => 'field_about_label',
                'label'        => 'Label Badge',
                'name'         => 'about_label',
                'type'         => 'text',
                'default_value'=> 'Tentang Kami',
                'instructions' => 'Teks kecil di atas judul, misal: Tentang Kami',
            ],
            [
                'key'          => 'field_about_title',
                'label'        => 'Judul Utama',
                'name'         => 'about_title',
                'type'         => 'text',
                'default_value'=> 'Melayani dengan Prinsip Syariah Sejak Hari Pertama',
            ],
            [
                'key'          => 'field_about_content',
                'label'        => 'Isi Paragraf Profil',
                'name'         => 'about_content',
                'type'         => 'wysiwyg',
                'media_upload' => false,
                'toolbar'      => 'basic',
                'default_value'=> '<p>BPRS Wakalumi hadir sebagai bank syariah yang berkomitmen memberikan layanan keuangan terbaik berdasarkan prinsip-prinsip syariah Islam. Dengan pengalaman bertahun-tahun, kami terus bertumbuh melayani masyarakat.</p>',
            ],
            [
                'key'          => 'field_about_image',
                'label'        => 'Foto Kantor / Tim',
                'name'         => 'about_image',
                'type'         => 'image',
                'return_format'=> 'array',
                'preview_size' => 'medium',
                'instructions' => 'Foto kantor atau tim. Ukuran ideal: 800×600px. Jika kosong, foto default akan ditampilkan.',
            ],
            [
                'key'          => 'field_about_cta_text',
                'label'        => 'Teks Tombol Aksi',
                'name'         => 'about_cta_text',
                'type'         => 'text',
                'default_value'=> 'Selengkapnya',
            ],
            [
                'key'          => 'field_about_cta_url',
                'label'        => 'Link Tombol Aksi',
                'name'         => 'about_cta_url',
                'type'         => 'text',
                'default_value'=> '/profil/tentang-kami',
                'instructions' => 'Tautan ke halaman profil lengkap, contoh: /profil/tentang-kami',
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
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'front-page.php',
                ],
            ],
        ],
        'position'   => 'normal',
        'menu_order' => 1,
    ] );

    // ──────────────────────────────────────
    // FRONT PAGE — CTA Section (Ajakan Bawah)
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_cta',
        'title'    => '📣 CTA Section (Ajakan Bawah)',
        'fields'   => [
            [
                'key'          => 'field_cta_headline',
                'label'        => 'Judul Utama Ajakan',
                'name'         => 'cta_headline',
                'type'         => 'text',
                'default_value'=> 'Siap Memulai Perjalanan Keuangan Syariah Anda?',
            ],
            [
                'key'          => 'field_cta_subtext',
                'label'        => 'Sub-Teks / Penjelasan',
                'name'         => 'cta_subtext',
                'type'         => 'textarea',
                'rows'         => 2,
                'default_value'=> 'Hubungi kami untuk konsultasi gratis atau kunjungi kantor cabang terdekat.',
            ],
            [
                'key'          => 'field_cta_button_text',
                'label'        => 'Teks Tombol Utama (WhatsApp)',
                'name'         => 'cta_button_text',
                'type'         => 'text',
                'default_value'=> 'Chat via WhatsApp',
            ],
            [
                'key'          => 'field_cta_button_secondary_text',
                'label'        => 'Teks Tombol Kedua (Opsional)',
                'name'         => 'cta_button_secondary_text',
                'type'         => 'text',
                'default_value'=> 'Lihat Jaringan Kantor',
            ],
            [
                'key'          => 'field_cta_button_secondary_url',
                'label'        => 'Link Tombol Kedua',
                'name'         => 'cta_button_secondary_url',
                'type'         => 'text',
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
            [
                [
                    'param'    => 'page_template',
                    'operator' => '==',
                    'value'    => 'front-page.php',
                ],
            ],
        ],
        'position'   => 'normal',
        'menu_order' => 2,
    ] );

    // ──────────────────────────────────────
    // CPT: Produk — Additional Fields
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_produk_fields',
        'title'    => '📦 Detail & Kategori Produk',
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
                'instructions' => 'Ditampilkan di kartu produk beranda (maks 2 kalimat).',
            ],
            [
                'key'          => 'field_produk_akad',
                'label'        => 'Akad Syariah',
                'name'         => 'produk_akad',
                'type'         => 'text',
                'instructions' => 'Jenis akad syariah (misal: Mudharabah Muthlaqah, Wadiah Yad Dhamanah, Murabahah).',
            ],
            [
                'key'          => 'field_produk_featured',
                'label'        => 'Tampilkan di Beranda (Homepage)?',
                'name'         => 'produk_featured',
                'type'         => 'true_false',
                'default_value'=> 0,
                'ui'           => 1,
                'instructions' => 'Aktifkan jika produk ini ingin disorot pada 4 kartu produk pilihan di beranda.',
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
        'title'    => '👤 Detail Anggota Pengurus/Tim',
        'fields'   => [
            [
                'key'   => 'field_tim_jabatan',
                'label' => 'Jabatan',
                'name'  => 'tim_jabatan',
                'type'  => 'text',
                'instructions' => 'Contoh: Direktur Utama, Dewan Pengawas Syariah, Komisaris',
            ],
            [
                'key'     => 'field_tim_urutan',
                'label'   => 'Urutan Tampil',
                'name'    => 'tim_urutan',
                'type'    => 'number',
                'default_value' => 0,
                'instructions'  => 'Angka lebih kecil akan tampil lebih awal.',
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
                'label'        => 'Ringkasan Berita',
                'name'         => 'berita_ringkasan',
                'type'         => 'textarea',
                'rows'         => 2,
                'instructions' => 'Ringkasan singkat untuk kartu berita di beranda dan arsip.',
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

    // ──────────────────────────────────────
    // CPT: Slider Hero
    // ──────────────────────────────────────
    acf_add_local_field_group( [
        'key'      => 'group_wakalumi_hero_slide',
        'title'    => 'Pengaturan Slide Hero',
        'fields'   => [
            [
                'key'           => 'field_wakalumi_slide_image_desktop',
                'label'         => 'Gambar Latar Desktop (Komputer / Laptop)',
                'name'          => 'slide_image_desktop',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'instructions'  => 'Rekomendasi Resolusi: 1920 × 800 piksel (atau 1920 × 1080 piksel, Landscape 16:9 / 16:7). Format: WebP atau JPG. Ukuran file disarankan: < 300 KB agar memuat kilat.',
            ],
            [
                'key'           => 'field_wakalumi_slide_image_mobile',
                'label'         => 'Gambar Latar Mobile (Ponsel / Smartphone)',
                'name'          => 'slide_image_mobile',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'instructions'  => 'Rekomendasi Resolusi: 750 × 1000 piksel (Potret 3:4) atau 800 × 800 piksel (Persegi 1:1). Format: WebP atau JPG. Ukuran file disarankan: < 150 KB. Fokus visual di tengah agar pas di layar smartphone. Jika dikosongkan, otomatis menggunakan gambar versi Desktop.',
            ],
            [
                'key'          => 'field_wakalumi_slide_subheadline',
                'label'        => 'Sub-headline / Deskripsi Slide',
                'name'         => 'slide_subheadline',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => 'Kalimat penjelasan di bawah judul slide.',
            ],
            [
                'key'           => 'field_wakalumi_slide_cta_text',
                'label'         => 'Teks Tombol 1',
                'name'          => 'slide_cta_text',
                'type'          => 'text',
                'default_value' => 'Hubungi Kami',
            ],
            [
                'key'          => 'field_wakalumi_slide_cta_url',
                'label'        => 'Link Tombol 1',
                'name'         => 'slide_cta_url',
                'type'         => 'text',
                'instructions' => 'Bisa diisi link WhatsApp atau tautan halaman lain.',
            ],
            [
                'key'           => 'field_wakalumi_slide_cta_text_2',
                'label'         => 'Teks Tombol 2',
                'name'          => 'slide_cta_text_2',
                'type'          => 'text',
                'default_value' => 'Lihat Produk',
            ],
            [
                'key'          => 'field_wakalumi_slide_cta_url_2',
                'label'        => 'Link Tombol 2',
                'name'         => 'slide_cta_url_2',
                'type'         => 'text',
                'instructions' => 'Contoh: /produk',
            ],
            [
                'key'           => 'field_wakalumi_slide_overlay_opacity',
                'label'         => 'Tingkat Kegelapan Gambar Latar (Overlay Opacity)',
                'name'          => 'slide_overlay_opacity',
                'type'          => 'number',
                'min'           => 0,
                'max'           => 100,
                'default_value' => 60,
                'instructions'  => 'Persentase kegelapan (0 - 100) agar teks tetap terbaca tajam di atas gambar.',
            ],
        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'hero_slide',
                ],
            ],
        ],
    ] );
}
add_action( 'acf/init', 'wakalumi_register_acf_fields' );

// ========================================================================
// HELPER: Get WhatsApp URL with Pre-filled Message
// ========================================================================
function wakalumi_get_whatsapp_url() {
    $number  = get_option( 'options_contact_wa', '6281517380388' );
    $message = get_option( 'options_contact_wa_message', 'Halo CS Bank Syariah Wakalumi, saya ingin bertanya tentang produk perbankan.' );
    $clean_number = preg_replace( '/[^0-9]/', '', $number );
    return 'https://wa.me/' . $clean_number . '?text=' . rawurlencode( $message );
}

/**
 * Helper: Get produk icon SVG
 *
 * @param string $icon_key
 * @return string
 */
function wakalumi_get_produk_icon( string $icon_key = 'savings' ): string {
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
