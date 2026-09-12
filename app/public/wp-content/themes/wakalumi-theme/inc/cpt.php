<?php
/**
 * Custom Post Types Registration
 *
 * Phase 1: berita, produk, anggota_tim
 * Phase 2 (nanti): laporan_publikasi, brosur, galeri, karir, kuis_soal
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register all Custom Post Types.
 */
function wakalumi_register_cpts() {

    // ──────────────────────────────────────
    // CPT: Berita (News)
    // ──────────────────────────────────────
    register_post_type( 'berita', [
        'labels' => [
            'name'               => 'Berita',
            'singular_name'      => 'Berita',
            'menu_name'          => 'Berita',
            'add_new'            => 'Tambah Berita',
            'add_new_item'       => 'Tambah Berita Baru',
            'edit_item'          => 'Edit Berita',
            'view_item'          => 'Lihat Berita',
            'all_items'          => 'Semua Berita',
            'search_items'       => 'Cari Berita',
            'not_found'          => 'Tidak ada berita ditemukan',
            'not_found_in_trash' => 'Tidak ada berita di sampah',
        ],
        'public'            => true,
        'has_archive'       => true,
        'rewrite'           => [ 'slug' => 'berita', 'with_front' => false ],
        'menu_icon'         => 'dashicons-megaphone',
        'menu_position'     => 5,
        'supports'          => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ],
        'show_in_rest'      => true, // Gutenberg support
        'taxonomies'        => [ 'kategori_berita' ],
    ] );

    // Taxonomy: Kategori Berita
    register_taxonomy( 'kategori_berita', 'berita', [
        'labels' => [
            'name'          => 'Kategori Berita',
            'singular_name' => 'Kategori',
            'add_new_item'  => 'Tambah Kategori Baru',
            'search_items'  => 'Cari Kategori',
        ],
        'public'            => true,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'rewrite'           => [ 'slug' => 'kategori-berita' ],
    ] );

    // ──────────────────────────────────────
    // CPT: Produk (Products)
    // ──────────────────────────────────────
    register_post_type( 'produk', [
        'labels' => [
            'name'               => 'Produk',
            'singular_name'      => 'Produk',
            'menu_name'          => 'Produk',
            'add_new'            => 'Tambah Produk',
            'add_new_item'       => 'Tambah Produk Baru',
            'edit_item'          => 'Edit Produk',
            'view_item'          => 'Lihat Produk',
            'all_items'          => 'Semua Produk',
            'search_items'       => 'Cari Produk',
            'not_found'          => 'Tidak ada produk ditemukan',
        ],
        'public'            => true,
        'has_archive'       => true,
        'rewrite'           => [ 'slug' => 'produk', 'with_front' => false ],
        'menu_icon'         => 'dashicons-bank',
        'menu_position'     => 6,
        'supports'          => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ],
        'show_in_rest'      => true,
        'taxonomies'        => [ 'kategori_produk' ],
    ] );

    // Taxonomy: Kategori Produk
    register_taxonomy( 'kategori_produk', 'produk', [
        'labels' => [
            'name'          => 'Kategori Produk',
            'singular_name' => 'Kategori',
            'add_new_item'  => 'Tambah Kategori Baru',
        ],
        'public'            => true,
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'rewrite'           => [ 'slug' => 'kategori-produk' ],
    ] );

    // ──────────────────────────────────────
    // CPT: Anggota Tim (Team Members)
    // ──────────────────────────────────────
    register_post_type( 'anggota_tim', [
        'labels' => [
            'name'               => 'Tim Kami',
            'singular_name'      => 'Anggota Tim',
            'menu_name'          => 'Tim Kami',
            'add_new'            => 'Tambah Anggota',
            'add_new_item'       => 'Tambah Anggota Baru',
            'edit_item'          => 'Edit Anggota',
            'view_item'          => 'Lihat Anggota',
            'all_items'          => 'Semua Anggota',
        ],
        'public'            => true,
        'has_archive'       => false,
        'rewrite'           => [ 'slug' => 'tim', 'with_front' => false ],
        'menu_icon'         => 'dashicons-groups',
        'menu_position'     => 7,
        'supports'          => [ 'title', 'thumbnail' ],
        'show_in_rest'      => true,
    ] );
}
add_action( 'init', 'wakalumi_register_cpts' );

/**
 * Flush rewrite rules on theme activation (so CPT URLs work immediately).
 */
function wakalumi_rewrite_flush() {
    wakalumi_register_cpts();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'wakalumi_rewrite_flush' );

