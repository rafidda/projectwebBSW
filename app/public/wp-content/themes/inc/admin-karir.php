<?php
/**
 * Admin: Karir & Rekrutmen Insan Bank Syariah Wakalumi (BSW)
 * 
 * Pengelolaan terpadu informasi karir, lowongan pekerjaan aktif,
 * alur seleksi rekrutmen profesional, tautan pendaftaran (Google Form),
 * serta himbauan resmi anti-fraud bebas biaya perbankan syariah.
 * 
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ── 1. COLOR PALETTES & ICON ENGINE ─────────────────────────────────

if ( ! function_exists( 'wakalumi_get_karir_color_options' ) ) {
    /**
     * Opsi aksen warna kartu rekrutmen perbankan syariah yang kaya, variatif, dan berkarakter.
     *
     * @return array
     */
    function wakalumi_get_karir_color_options() {
        return [
            'emerald' => [
                'name'        => 'Emerald (Hijau Syariah)',
                'dot'         => '#059669',
                'border'      => 'border-emerald-300/80 dark:border-emerald-700/60 hover:border-emerald-400 dark:hover:border-emerald-500',
                'top_stripe'  => 'from-emerald-400 via-teal-400 to-cyan-500',
                'header_grad' => 'from-emerald-500/12 via-teal-50/50 to-transparent dark:from-emerald-950/40 dark:via-dark-card dark:to-transparent',
                'icon_box'    => 'bg-gradient-to-br from-emerald-400 via-emerald-500 to-teal-600 text-white shadow-[0_8px_16px_-4px_rgba(16,185,129,0.4),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill'        => 'bg-emerald-100/90 dark:bg-emerald-950/80 text-emerald-900 dark:text-emerald-200 border-emerald-300/80 dark:border-emerald-700/80',
                'hover_text'  => 'group-hover:text-emerald-600 dark:group-hover:text-emerald-400',
                'dot_color'   => 'bg-emerald-500',
                'step_circle' => 'bg-gradient-to-br from-emerald-400 via-emerald-500 to-teal-600 text-white shadow-[0_6px_14px_-3px_rgba(16,185,129,0.45),inset_0_2px_3px_rgba(255,255,255,0.7),inset_0_-2px_3px_rgba(0,0,0,0.15)]',
                'bar'         => 'from-emerald-500 to-teal-500',
                'pct_text'    => 'text-emerald-600 dark:text-emerald-400',
                'btn_primary' => 'bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 hover:from-emerald-500 hover:to-teal-500 text-white shadow-[0_8px_18px_-4px_rgba(16,185,129,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'subcard_bg'  => 'bg-gradient-to-b from-emerald-50/70 via-teal-50/40 to-white dark:from-emerald-950/40 dark:via-dark-card dark:to-dark-card border border-emerald-200/80 dark:border-emerald-800/60',
            ],
            'cyan' => [
                'name'        => 'Cyan (Biru Langit & TI)',
                'dot'         => '#0891b2',
                'border'      => 'border-cyan-300/80 dark:border-cyan-700/60 hover:border-cyan-400 dark:hover:border-cyan-500',
                'top_stripe'  => 'from-cyan-400 via-sky-400 to-blue-500',
                'header_grad' => 'from-cyan-500/12 via-sky-50/50 to-transparent dark:from-cyan-950/40 dark:via-dark-card dark:to-transparent',
                'icon_box'    => 'bg-gradient-to-br from-cyan-400 via-sky-500 to-blue-600 text-white shadow-[0_8px_16px_-4px_rgba(6,182,212,0.4),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill'        => 'bg-cyan-100/90 dark:bg-cyan-950/80 text-cyan-900 dark:text-cyan-200 border-cyan-300/80 dark:border-cyan-700/80',
                'hover_text'  => 'group-hover:text-cyan-600 dark:group-hover:text-cyan-400',
                'dot_color'   => 'bg-cyan-500',
                'step_circle' => 'bg-gradient-to-br from-cyan-400 via-sky-500 to-blue-600 text-white shadow-[0_6px_14px_-3px_rgba(6,182,212,0.45),inset_0_2px_3px_rgba(255,255,255,0.7),inset_0_-2px_3px_rgba(0,0,0,0.15)]',
                'bar'         => 'from-cyan-500 to-blue-500',
                'pct_text'    => 'text-cyan-600 dark:text-cyan-400',
                'btn_primary' => 'bg-gradient-to-r from-cyan-600 via-sky-600 to-blue-600 hover:from-cyan-500 hover:to-sky-500 text-white shadow-[0_8px_18px_-4px_rgba(6,182,212,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'subcard_bg'  => 'bg-gradient-to-b from-cyan-50/70 via-sky-50/40 to-white dark:from-cyan-950/40 dark:via-dark-card dark:to-dark-card border border-cyan-200/80 dark:border-cyan-800/60',
            ],
            'purple' => [
                'name'        => 'Purple (Ungu Modern & Magang)',
                'dot'         => '#9333ea',
                'border'      => 'border-purple-300/80 dark:border-purple-700/60 hover:border-purple-400 dark:hover:border-purple-500',
                'top_stripe'  => 'from-purple-400 via-fuchsia-400 to-pink-500',
                'header_grad' => 'from-purple-500/12 via-fuchsia-50/50 to-transparent dark:from-purple-950/40 dark:via-dark-card dark:to-transparent',
                'icon_box'    => 'bg-gradient-to-br from-purple-400 via-fuchsia-500 to-pink-600 text-white shadow-[0_8px_16px_-4px_rgba(168,85,247,0.4),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill'        => 'bg-purple-100/90 dark:bg-purple-950/80 text-purple-900 dark:text-purple-200 border-purple-300/80 dark:border-purple-700/80',
                'hover_text'  => 'group-hover:text-purple-600 dark:group-hover:text-purple-400',
                'dot_color'   => 'bg-purple-500',
                'step_circle' => 'bg-gradient-to-br from-purple-400 via-fuchsia-500 to-pink-600 text-white shadow-[0_6px_14px_-3px_rgba(168,85,247,0.45),inset_0_2px_3px_rgba(255,255,255,0.7),inset_0_-2px_3px_rgba(0,0,0,0.15)]',
                'bar'         => 'from-purple-500 to-fuchsia-500',
                'pct_text'    => 'text-purple-600 dark:text-purple-400',
                'btn_primary' => 'bg-gradient-to-r from-purple-600 via-fuchsia-600 to-pink-600 hover:from-purple-500 hover:to-fuchsia-500 text-white shadow-[0_8px_18px_-4px_rgba(168,85,247,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'subcard_bg'  => 'bg-gradient-to-b from-purple-50/70 via-fuchsia-50/40 to-white dark:from-purple-950/40 dark:via-dark-card dark:to-dark-card border border-purple-200/80 dark:border-purple-800/60',
            ],
            'amber' => [
                'name'        => 'Amber (Kuning Emas & Bisnis)',
                'dot'         => '#d97706',
                'border'      => 'border-amber-300/80 dark:border-amber-700/60 hover:border-amber-400 dark:hover:border-amber-500',
                'top_stripe'  => 'from-amber-400 via-orange-400 to-yellow-500',
                'header_grad' => 'from-amber-500/12 via-orange-50/50 to-transparent dark:from-amber-950/40 dark:via-dark-card dark:to-transparent',
                'icon_box'    => 'bg-gradient-to-br from-amber-400 via-orange-500 to-amber-600 text-white shadow-[0_8px_16px_-4px_rgba(245,158,11,0.4),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill'        => 'bg-amber-100/90 dark:bg-amber-950/80 text-amber-900 dark:text-amber-200 border-amber-300/80 dark:border-amber-700/80',
                'hover_text'  => 'group-hover:text-amber-600 dark:group-hover:text-amber-400',
                'dot_color'   => 'bg-amber-500',
                'step_circle' => 'bg-gradient-to-br from-amber-400 via-amber-500 to-orange-500 text-slate-950 shadow-[0_6px_14px_-3px_rgba(245,158,11,0.45),inset_0_2px_3px_rgba(255,255,255,0.7),inset_0_-2px_3px_rgba(0,0,0,0.15)]',
                'bar'         => 'from-amber-500 to-orange-500',
                'pct_text'    => 'text-amber-600 dark:text-amber-400',
                'btn_primary' => 'bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 hover:from-amber-400 hover:to-orange-500 text-slate-950 shadow-[0_8px_18px_-4px_rgba(245,158,11,0.4),inset_0_2px_3px_rgba(255,255,255,0.5),inset_0_-2px_3px_rgba(0,0,0,0.15)]',
                'subcard_bg'  => 'bg-gradient-to-b from-amber-50/70 via-orange-50/40 to-white dark:from-amber-950/40 dark:via-dark-card dark:to-dark-card border border-amber-200/80 dark:border-amber-800/60',
            ],
            'teal' => [
                'name'        => 'Teal (Toska Wakalumi / Umum)',
                'dot'         => '#0d9488',
                'border'      => 'border-teal-300/80 dark:border-teal-700/60 hover:border-teal-400 dark:hover:border-teal-500',
                'top_stripe'  => 'from-teal-400 via-emerald-400 to-cyan-500',
                'header_grad' => 'from-teal-500/12 via-emerald-50/50 to-transparent dark:from-teal-950/40 dark:via-dark-card dark:to-transparent',
                'icon_box'    => 'bg-gradient-to-br from-teal-400 via-teal-500 to-emerald-600 text-white shadow-[0_8px_16px_-4px_rgba(20,184,166,0.4),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill'        => 'bg-teal-100/90 dark:bg-teal-950/80 text-teal-900 dark:text-teal-200 border-teal-300/80 dark:border-teal-700/80',
                'hover_text'  => 'group-hover:text-teal-600 dark:group-hover:text-teal-400',
                'dot_color'   => 'bg-teal-500',
                'step_circle' => 'bg-gradient-to-br from-teal-400 via-teal-500 to-emerald-600 text-white shadow-[0_6px_14px_-3px_rgba(20,184,166,0.45),inset_0_2px_3px_rgba(255,255,255,0.7),inset_0_-2px_3px_rgba(0,0,0,0.15)]',
                'bar'         => 'from-teal-500 to-emerald-500',
                'pct_text'    => 'text-teal-600 dark:text-teal-400',
                'btn_primary' => 'bg-gradient-to-r from-teal-600 via-emerald-600 to-teal-700 hover:from-teal-500 hover:to-emerald-500 text-white shadow-[0_8px_18px_-4px_rgba(20,184,166,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'subcard_bg'  => 'bg-gradient-to-b from-teal-50/70 via-emerald-50/40 to-white dark:from-teal-950/40 dark:via-dark-card dark:to-dark-card border border-teal-200/80 dark:border-teal-800/60',
            ],
            'blue' => [
                'name'        => 'Blue (Biru Korporat / Legal)',
                'dot'         => '#2563eb',
                'border'      => 'border-blue-300/80 dark:border-blue-700/60 hover:border-blue-400 dark:hover:border-blue-500',
                'top_stripe'  => 'from-blue-400 via-indigo-400 to-sky-500',
                'header_grad' => 'from-blue-500/12 via-indigo-50/50 to-transparent dark:from-blue-950/40 dark:via-dark-card dark:to-transparent',
                'icon_box'    => 'bg-gradient-to-br from-blue-500 via-indigo-500 to-blue-600 text-white shadow-[0_8px_16px_-4px_rgba(37,99,235,0.4),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill'        => 'bg-blue-100/90 dark:bg-blue-950/80 text-blue-900 dark:text-blue-200 border-blue-300/80 dark:border-blue-700/80',
                'hover_text'  => 'group-hover:text-blue-600 dark:group-hover:text-blue-400',
                'dot_color'   => 'bg-blue-500',
                'step_circle' => 'bg-gradient-to-br from-blue-500 via-indigo-500 to-blue-600 text-white shadow-[0_6px_14px_-3px_rgba(37,99,235,0.45),inset_0_2px_3px_rgba(255,255,255,0.7),inset_0_-2px_3px_rgba(0,0,0,0.15)]',
                'bar'         => 'from-blue-500 to-indigo-500',
                'pct_text'    => 'text-blue-600 dark:text-blue-400',
                'btn_primary' => 'bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 hover:from-blue-500 hover:to-indigo-500 text-white shadow-[0_8px_18px_-4px_rgba(37,99,235,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'subcard_bg'  => 'bg-gradient-to-b from-blue-50/70 via-indigo-50/40 to-white dark:from-blue-950/40 dark:via-dark-card dark:to-dark-card border border-blue-200/80 dark:border-blue-800/60',
            ],
            'rose' => [
                'name'        => 'Rose (Merah Muda & Relasi)',
                'dot'         => '#e11d48',
                'border'      => 'border-rose-300/80 dark:border-rose-700/60 hover:border-rose-400 dark:hover:border-rose-500',
                'top_stripe'  => 'from-rose-400 via-pink-400 to-red-500',
                'header_grad' => 'from-rose-500/12 via-pink-50/50 to-transparent dark:from-rose-950/40 dark:via-dark-card dark:to-transparent',
                'icon_box'    => 'bg-gradient-to-br from-rose-400 via-rose-500 to-red-600 text-white shadow-[0_8px_16px_-4px_rgba(225,29,72,0.4),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill'        => 'bg-rose-100/90 dark:bg-rose-950/80 text-rose-900 dark:text-rose-200 border-rose-300/80 dark:border-rose-700/80',
                'hover_text'  => 'group-hover:text-rose-600 dark:group-hover:text-rose-400',
                'dot_color'   => 'bg-rose-500',
                'step_circle' => 'bg-gradient-to-br from-rose-400 via-rose-500 to-red-600 text-white shadow-[0_6px_14px_-3px_rgba(225,29,72,0.45),inset_0_2px_3px_rgba(255,255,255,0.7),inset_0_-2px_3px_rgba(0,0,0,0.15)]',
                'bar'         => 'from-rose-500 to-red-500',
                'pct_text'    => 'text-rose-600 dark:text-rose-400',
                'btn_primary' => 'bg-gradient-to-r from-rose-600 via-pink-600 to-rose-700 hover:from-rose-500 hover:to-pink-500 text-white shadow-[0_8px_18px_-4px_rgba(225,29,72,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'subcard_bg'  => 'bg-gradient-to-b from-rose-50/70 via-pink-50/40 to-white dark:from-rose-950/40 dark:via-dark-card dark:to-dark-card border border-rose-200/80 dark:border-rose-800/60',
            ],
            'indigo' => [
                'name'        => 'Indigo (Ungu Wibawa & Eksekutif)',
                'dot'         => '#4f46e5',
                'border'      => 'border-indigo-300/80 dark:border-indigo-700/60 hover:border-indigo-400 dark:hover:border-indigo-500',
                'top_stripe'  => 'from-indigo-400 via-purple-400 to-blue-500',
                'header_grad' => 'from-indigo-500/12 via-purple-50/50 to-transparent dark:from-indigo-950/40 dark:via-dark-card dark:to-transparent',
                'icon_box'    => 'bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-600 text-white shadow-[0_8px_16px_-4px_rgba(79,70,229,0.4),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill'        => 'bg-indigo-100/90 dark:bg-indigo-950/80 text-indigo-900 dark:text-indigo-200 border-indigo-300/80 dark:border-indigo-700/80',
                'hover_text'  => 'group-hover:text-indigo-600 dark:group-hover:text-indigo-400',
                'dot_color'   => 'bg-indigo-500',
                'step_circle' => 'bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-600 text-white shadow-[0_6px_14px_-3px_rgba(79,70,229,0.45),inset_0_2px_3px_rgba(255,255,255,0.7),inset_0_-2px_3px_rgba(0,0,0,0.15)]',
                'bar'         => 'from-indigo-500 to-purple-500',
                'pct_text'    => 'text-indigo-600 dark:text-indigo-400',
                'btn_primary' => 'bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 hover:from-indigo-500 hover:to-purple-500 text-white shadow-[0_8px_18px_-4px_rgba(79,70,229,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'subcard_bg'  => 'bg-gradient-to-b from-indigo-50/70 via-purple-50/40 to-white dark:from-indigo-950/40 dark:via-dark-card dark:to-dark-card border border-indigo-200/80 dark:border-indigo-800/60',
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_palette' ) ) {
    function wakalumi_get_karir_palette( $color_key = 'teal' ) {
        $palettes = wakalumi_get_karir_color_options();
        $color_key = strtolower( trim( (string) $color_key ) );
        return $palettes[ $color_key ] ?? $palettes['teal'];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_icon_options' ) ) {
    function wakalumi_get_karir_icon_options() {
        return [
            'shield'      => 'Perisai Syariah (Shield)',
            'trending-up' => 'Grafik Pertumbuhan (Trending Up)',
            'users'       => 'Tim & Kolaborasi (Users)',
            'heart'       => 'Kesejahteraan & Peduli (Heart)',
            'star'        => 'Bintang Keunggulan (Star)',
            'building'    => 'Gedung / Ekosistem (Building)',
            'globe'       => 'Jaringan / Daring (Globe)',
            'award'       => 'Piala / Pengakuan (Award)',
        ];
    }
}

if ( ! function_exists( 'wakalumi_render_karir_icon' ) ) {
    function wakalumi_render_karir_icon( $icon_key = 'shield', $class = 'w-6 h-6' ) {
        switch ( $icon_key ) {
            case 'trending-up':
                return '<svg class="' . esc_attr( $class ) . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>';
            case 'users':
                return '<svg class="' . esc_attr( $class ) . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>';
            case 'heart':
                return '<svg class="' . esc_attr( $class ) . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>';
            case 'star':
                return '<svg class="' . esc_attr( $class ) . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>';
            case 'building':
                return '<svg class="' . esc_attr( $class ) . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg>';
            case 'globe':
                return '<svg class="' . esc_attr( $class ) . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>';
            case 'award':
                return '<svg class="' . esc_attr( $class ) . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.504-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.003 0H9.497m5.003 0a3.375 3.375 0 003.375-3.375V6.75a3 3 0 00-3-3h-5.75a3 3 0 00-3 3v5.25a3.375 3.375 0 003.375 3.375z"/></svg>';
            case 'shield':
            default:
                return '<svg class="' . esc_attr( $class ) . '" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>';
        }
    }
}

// ── 2. DATA RETRIEVAL HELPERS ───────────────────────────────────────

if ( ! function_exists( 'wakalumi_get_karir_header' ) ) {
    /**
     * Mengambil teks pengantar dan judul header halaman karir.
     *
     * @return array
     */
    function wakalumi_get_karir_header() {
        $badge = get_option( 'options_karir_badge', 'Peluang Karir & Rekrutmen Resmi' );
        $title = get_option( 'options_karir_title', 'Tumbuh & Berkarya Bersama Bank Syariah Wakalumi' );
        $title = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $title );
        $desc  = get_option( 'options_karir_desc', 'Bergabunglah bersama insan perbankan syariah yang amanah, berintegritas tinggi, dan berorientasi pada kemajuan ekonomi umat. Temukan peluang karir terbaik yang selaras dengan potensi dan nilai-nilai kebaikan Anda.' );

        return [
            'badge' => $badge,
            'title' => $title,
            'desc'  => $desc,
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_values_header' ) ) {
    /**
     * Mengambil judul dan pengantar section Budaya Perusahaan (Nilai Kerja Insan BSW).
     *
     * @return array
     */
    function wakalumi_get_karir_values_header() {
        return [
            'badge' => get_option( 'options_karir_values_badge', 'Budaya Perusahaan' ),
            'title' => get_option( 'options_karir_values_title', 'Mengapa Membangun Karir Bersama Bank Syariah Wakalumi?' ),
            'desc'  => get_option( 'options_karir_values_desc', 'Kami meyakini bahwa keberkahan dan keberlanjutan bank bermula dari lingkungan kerja yang sehat, saling menghargai, dan menjunjung tinggi amanah syariat Islam.' ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_values' ) ) {
    /**
     * Mengambil 4 pilar budaya dan nilai kerja profesional Insan BSW.
     *
     * @return array
     */
    function wakalumi_get_karir_values() {
        $default_values = [
            [
                'title' => 'Prinsip Muamalah Syariah',
                'desc'  => 'Bekerja dalam ekosistem perbankan yang berlandaskan syariat Islam, bebas riba, serta mengedepankan kehalalan dan keadilan transaksi muamalah.',
                'icon'  => 'shield',
                'color' => 'emerald',
            ],
            [
                'title' => 'Pengembangan Potensi Insan BSW',
                'desc'  => 'Dukungan berkelanjutan untuk mengasah keahlian dan wawasan perbankan syariah melalui bimbingan kerja profesional dan penugasan terarah.',
                'icon'  => 'trending-up',
                'color' => 'cyan',
            ],
            [
                'title' => 'Budaya Kolaboratif & ISHLAH',
                'desc'  => 'Lingkungan kerja yang rukun, saling menghormati, transparan, dan menjunjung tinggi amanah serta etika perbankan yang sehat.',
                'icon'  => 'users',
                'color' => 'purple',
            ],
            [
                'title' => 'Kesejahteraan & Keseimbangan',
                'desc'  => 'Paket remunerasi yang kompetitif, perlindungan kesejahteraan, serta perhatian penuh pada keseimbangan antara produktivitas kerja dan ibadah.',
                'icon'  => 'heart',
                'color' => 'amber',
            ],
        ];

        $saved = get_option( 'options_karir_values_list', null );
        if ( is_array( $saved ) && ! empty( $saved ) ) {
            return $saved;
        }

        return $default_values;
    }
}

if ( ! function_exists( 'wakalumi_get_karir_stages_header' ) ) {
    /**
     * Mengambil judul dan pengantar section Alur & Tahapan Rekrutmen.
     *
     * @return array
     */
    function wakalumi_get_karir_stages_header() {
        return [
            'badge' => get_option( 'options_karir_stages_badge', 'Tahapan Seleksi Resmi' ),
            'title' => get_option( 'options_karir_stages_title', 'Alur Perekrutan Insan Bank Syariah Wakalumi' ),
            'desc'  => get_option( 'options_karir_stages_desc', 'Proses seleksi penerimaan karyawan di Bank Syariah Wakalumi dilaksanakan secara terstruktur, objektif, dan transparan melalui 4 tahapan utama:' ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_stages' ) ) {
    /**
     * Mengambil 4 tahapan alur rekrutmen resmi BSW.
     *
     * @return array
     */
    function wakalumi_get_karir_stages() {
        $default_stages = [
            [
                'step'  => '01',
                'title' => 'Pengiriman Berkas & Data Pelamar',
                'desc'  => 'Pelamar mengisi formulir pendaftaran daring resmi dan melampirkan berkas Curriculum Vitae (CV) terbaru sesuai kualifikasi posisi yang diminati.',
                'color' => 'cyan',
            ],
            [
                'step'  => '02',
                'title' => 'Seleksi Berkas & Panggilan Interview',
                'desc'  => 'Tim Personalia BSW melakukan verifikasi dan seleksi administratif. Pelamar yang memenuhi syarat akan dihubungi untuk jadwal wawancara resmi.',
                'color' => 'teal',
            ],
            [
                'step'  => '03',
                'title' => 'Sesi Wawancara (Interview)',
                'desc'  => 'Wawancara mendalam mencakup kompetensi teknis, kecocokan profil kerja, dan keselarasan integritas syariah bersama tim Personalia dan Pimpinan Unit kerja terkait.',
                'color' => 'amber',
            ],
            [
                'step'  => '04',
                'title' => 'Penawaran Kerja & Onboarding',
                'desc'  => 'Kandidat terpilih menerima surat penawaran kerja resmi (Offering Letter) dan arahan persiapan sebelum memulai orientasi kerja resmi sebagai insan BSW.',
                'color' => 'purple',
            ],
        ];

        $saved = get_option( 'options_karir_stages_list', null );
        if ( is_array( $saved ) && ! empty( $saved ) ) {
            return $saved;
        }

        return $default_stages;
    }
}

if ( ! function_exists( 'wakalumi_get_karir_empty_state' ) ) {
    /**
     * Mengambil konfigurasi status formasi kosong (Centerpiece Showcase).
     *
     * @return array
     */
    function wakalumi_get_karir_empty_state() {
        $default_subcards = [
            [
                'title' => '100% Bebas Biaya',
                'desc'  => 'Seluruh proses seleksi dan pendaftaran tidak pernah dipungut biaya apapun.',
                'color' => 'emerald',
                'icon'  => 'shield',
            ],
            [
                'title' => 'Kanal Resmi Daring',
                'desc'  => 'Formulir pendaftaran resmi selalu menggunakan tautan Google Form BSW.',
                'color' => 'cyan',
                'icon'  => 'globe',
            ],
            [
                'title' => 'Kenali Budaya BSW',
                'desc'  => 'Kenali profil kepengurusan dan jajaran karyawan bank syariah kami.',
                'color' => 'amber',
                'icon'  => 'users',
            ],
        ];

        $saved_subcards = get_option( 'options_karir_empty_subcards', null );

        return [
            'badge'    => get_option( 'options_karir_empty_badge', 'Status Formasi: Belum Ada Pembukaan Rekrutmen Aktif' ),
            'title'    => get_option( 'options_karir_empty_title', 'Terima Kasih Atas Ketertarikan Anda Berkarya Bersama Bank Syariah Wakalumi' ),
            'desc'     => get_option( 'options_karir_empty_desc', 'Saat ini seluruh formasi penempatan kerja insan perbankan syariah di lingkungan PT BPRS Wakalumi (Bank Syariah Wakalumi) telah terisi penuh. Pembukaan gelombang rekrutmen formasi baru berikutnya akan selalu diumumkan secara transparan melalui portal resmi ini dan saluran media sosial resmi bank.' ),
            'subcards' => ( is_array( $saved_subcards ) && ! empty( $saved_subcards ) ) ? $saved_subcards : $default_subcards,
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_antifraud' ) ) {
    /**
     * Mengambil teks peringatan anti-fraud resmi perbankan syariah.
     *
     * @return array
     */
    function wakalumi_get_karir_antifraud() {
        return [
            'badge' => get_option( 'options_karir_fraud_badge', 'Himbauan Resmi Bebas Biaya' ),
            'title' => get_option( 'options_karir_fraud_title', 'Waspada Penipuan Mengatasnamakan Rekrutmen BSW' ),
            'desc'  => get_option( 'options_karir_fraud_desc', 'PT BPRS Wakalumi (Bank Syariah Wakalumi) TIDAK PERNAH memungut biaya apapun (termasuk biaya transportasi, akomodasi, maupun biaya administrasi berkas) dalam seluruh tahapan seleksi penerimaan karyawan. Undangan resmi selalu disampaikan melalui saluran email resmi bank atau nomor kontak resmi Divisi Personalia. Waspadai segala bentuk penipuan yang mengatasnamakan Bank Syariah Wakalumi.' ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_default_karir_jobs' ) ) {
    /**
     * Daftar contoh lowongan kerja resmi BSW (Default Seeder).
     *
     * @return array
     */
    function wakalumi_get_default_karir_jobs() {
        return [
            [
                'id'          => 'job_1',
                'posisi'      => 'Account Officer (AO) Pembiayaan Syariah',
                'divisi'      => 'bisnis',
                'divisi_lbl'  => 'Bisnis & Pemasaran',
                'tipe'        => 'Penuh Waktu (Full Time)',
                'lokasi'      => 'Kantor Pusat & Wilayah Operasional BSW',
                'deadline'    => '30 November 2026',
                'form_url'    => 'https://forms.gle/wakalumi_ao_sample',
                'status'      => 'dibuka',
                'ringkasan'   => 'Bertanggung jawab dalam pemasaran produk pembiayaan syariah (Murabahah, Mudharabah, Musyarakah), analisa kelayakan usaha nasabah, dan pembinaan portofolio pembiayaan UMKM yang sehat.',
                'kualifikasi' => "Pria/Wanita, Usia maksimal 32 tahun\nPendidikan minimal D3/S1 semua jurusan (diutamakan Ekonomi/Perbankan/Manajemen)\nMemiliki integritas tinggi, komunikatif, dan berorientasi pada target\nDiutamakan memiliki pengalaman minimal 1 tahun di bidang marketing perbankan atau lembaga keuangan\nMemiliki kendaraan pribadi dan SIM C aktif",
                'urutan'      => 1,
            ],
            [
                'id'          => 'job_2',
                'posisi'      => 'Customer Service Officer',
                'divisi'      => 'operasional',
                'divisi_lbl'  => 'Operasional & Layanan',
                'tipe'        => 'Penuh Waktu (Full Time)',
                'lokasi'      => 'Kantor Pusat - Jakarta',
                'deadline'    => '30 November 2026',
                'form_url'    => 'https://forms.gle/wakalumi_cs_sample',
                'status'      => 'dibuka',
                'ringkasan'   => 'Memberikan pelayanan informasi produk simpanan syariah, pembukaan rekening tabungan/deposito, penanganan administrasi berkas nasabah, serta mengedepankan Service Excellence beretika syariah.',
                'kualifikasi' => "Pria/Wanita, Usia maksimal 27 tahun\nPendidikan minimal D3/S1 semua jurusan dengan IPK minimal 3.00\nBerpenampilan rapi, ramah, dan memiliki kemampuan komunikasi yang baik\nMampu mengoperasikan komputer dan aplikasi perkantoran (MS Office)\nMemiliki ketelitian tinggi dan orientasi melayani nasabah dengan tulus",
                'urutan'      => 2,
            ],
            [
                'id'          => 'job_3',
                'posisi'      => 'Staff Teknologi Informasi (IT Support & Sistem)',
                'divisi'      => 'it',
                'divisi_lbl'  => 'Teknologi Informasi',
                'tipe'        => 'Penuh Waktu (Full Time)',
                'lokasi'      => 'Kantor Pusat - Jakarta',
                'deadline'    => '15 Desember 2026',
                'form_url'    => 'https://forms.gle/wakalumi_it_sample',
                'status'      => 'dibuka',
                'ringkasan'   => 'Mendukung pemeliharaan infrastruktur jaringan, kelancaran core banking system, keamanan data digital, troubleshooting perangkat keras/lunak kantor, dan operasional TI perbankan.',
                'kualifikasi' => "Pria/Wanita, Usia maksimal 28 tahun\nPendidikan minimal S1 Teknik Informatika, Sistem Informasi, atau bidang terkait\nMemahami konsep jaringan komputer (LAN/WAN, Router, Firewall) dan database SQL\nMemiliki pemahaman dasar mengenai infrastruktur sistem perbankan syariah\nDisiplin, cepat beradaptasi, dan mampu bekerja mandiri maupun dalam tim",
                'urutan'      => 3,
            ],
            [
                'id'          => 'job_4',
                'posisi'      => 'Program Magang Mahasiswa (Internship Syariah)',
                'divisi'      => 'magang',
                'divisi_lbl'  => 'Program Magang Kampus',
                'tipe'        => 'Magang (Internship)',
                'lokasi'      => 'Kantor Pusat - Jakarta',
                'deadline'    => '31 Desember 2026',
                'form_url'    => 'https://forms.gle/wakalumi_intern_sample',
                'status'      => 'dibuka',
                'ringkasan'   => 'Kesempatan belajar langsung di lingkungan industri perbankan syariah pada divisi Operasional, Pemasaran, maupun Administrasi Umum bagi mahasiswa tingkat akhir.',
                'kualifikasi' => "Mahasiswa aktif semester 5 ke atas dari Perguruan Tinggi terakreditasi\nJurusan Perbankan Syariah, Ekonomi Syariah, Akuntansi, Manajemen, atau Ilmu Komputer\nMemiliki surat pengantar magang resmi dari universitas / fakultas\nBersedia mengikuti program magang minimal selama 2-3 bulan penuh\nMemiliki motivasi belajar tinggi, disiplin, dan amanah",
                'urutan'      => 4,
            ],
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_jobs' ) ) {
    /**
     * Mengambil daftar lowongan kerja dari database wp_options.
     * Secara default kosong sesuai ketersediaan rekrutmen saat ini.
     *
     * @return array
     */
    function wakalumi_get_karir_jobs() {
        // Otomatis sinkronisasi kosong jika baru pertama kali dimuat
        $initialized = get_option( 'options_karir_empty_seeded', false );
        if ( ! $initialized ) {
            update_option( 'options_karir_jobs_list', [] );
            update_option( 'options_karir_empty_seeded', '1' );
            return [];
        }

        $saved = get_option( 'options_karir_jobs_list', [] );
        if ( is_array( $saved ) ) {
            usort( $saved, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );
            return $saved;
        }

        return [];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_cta' ) ) {
    /**
     * Mengambil konfigurasi Banner CTA Bawah Halaman Karir.
     *
     * @return array
     */
    function wakalumi_get_karir_cta() {
        $default_wa = get_option( 'options_contact_wa', '6281517380388' );
        $wa_clean   = preg_replace( '/[^0-9]/', '', (string) $default_wa );
        $wa_url     = 'https://wa.me/' . ( $wa_clean ?: '6281517380388' );

        $title = get_option( 'options_karir_cta_title', 'Memiliki Pertanyaan Seputar Rekrutmen Bank Syariah Wakalumi?' );
        $title = str_replace( 'BPRS Wakalumi', 'Bank Syariah Wakalumi', $title );

        return [
            'show'      => get_option( 'options_karir_cta_show', '1' ) === '1',
            'badge'     => get_option( 'options_karir_cta_badge', 'Informasi & Layanan SDM' ),
            'title'     => $title,
            'desc'      => get_option( 'options_karir_cta_desc', 'Tim Personalia / Human Capital kami siap membantu memberikan informasi terkait jadwal seleksi, kualifikasi posisi, serta peluang kemitraan magang mahasiswa.' ),
            'btn1_text' => get_option( 'options_karir_cta_btn1_text', 'Hubungi Personalia via WhatsApp' ),
            'btn1_url'  => get_option( 'options_karir_cta_btn1_url', $wa_url ),
            'btn2_text' => get_option( 'options_karir_cta_btn2_text', 'Lihat Tim & Manajemen BSW' ),
            'btn2_url'  => get_option( 'options_karir_cta_btn2_url', home_url( '/informasi/tim-kami/' ) ),
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_division_presets' ) ) {
    /**
     * Daftar preset standar kategori divisi lowongan kerja Bank Syariah Wakalumi.
     *
     * @return array
     */
    function wakalumi_get_karir_division_presets() {
        return [
            'bisnis'      => 'Bisnis & Pemasaran',
            'operasional' => 'Operasional & Layanan',
            'it'          => 'Teknologi Informasi (IT)',
            'legal'       => 'Legal & Kepatuhan',
            'skai'        => 'Audit Internal (SKAI)',
            'umum'        => 'Umum & Personalia',
            'magang'      => 'Program Magang Mahasiswa',
        ];
    }
}

if ( ! function_exists( 'wakalumi_get_karir_division_theme' ) ) {
    /**
     * Mengembalikan konfigurasi visual, palet warna dual-tone, border, ikon SVG, dan tombol
     * berbasis karakteristik divisi atau kata kunci posisi lowongan kerja, atau pilihan kustom admin.
     *
     * @param string $slug Slug divisi.
     * @param string $title Judul posisi.
     * @param string $custom_color Pilihan warna kustom dari admin (opsional).
     * @return array
     */
    function wakalumi_get_karir_division_theme( $slug = '', $title = '', $custom_color = '' ) {
        $slug        = strtolower( trim( (string) $slug ) );
        $title_lower = strtolower( trim( (string) $title ) );
        $custom      = strtolower( trim( (string) $custom_color ) );

        // Jika admin memilih opsi warna spesifik yang valid (bukan 'auto' dan bukan kosong)
        if ( ! empty( $custom ) && $custom !== 'auto' ) {
            $palettes = wakalumi_get_karir_color_options();
            if ( isset( $palettes[ $custom ] ) ) {
                $p = $palettes[ $custom ];

                // Tentukan SVG icon default sesuai slug divisi
                $icon_svg = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" /></svg>';
                if ( in_array( $slug, [ 'bisnis', 'marketing', 'pemasaran', 'sales', 'ao' ], true ) ) {
                    $icon_svg = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" /></svg>';
                } elseif ( in_array( $slug, [ 'operasional', 'layanan', 'cs', 'teller', 'bo' ], true ) ) {
                    $icon_svg = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>';
                } elseif ( in_array( $slug, [ 'it', 'ti', 'teknologi', 'digital', 'developer', 'sistem' ], true ) ) {
                    $icon_svg = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" /></svg>';
                } elseif ( in_array( $slug, [ 'magang', 'internship', 'kampus', 'mahasiswa' ], true ) ) {
                    $icon_svg = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342" /></svg>';
                } elseif ( in_array( $slug, [ 'legal', 'hukum', 'kepatuhan', 'compliance' ], true ) ) {
                    $icon_svg = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg>';
                } elseif ( in_array( $slug, [ 'skai', 'audit', 'pengawas', 'risk', 'risiko' ], true ) ) {
                    $icon_svg = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>';
                } elseif ( in_array( $slug, [ 'sdm', 'hrd', 'personalia', 'umum', 'human capital' ], true ) ) {
                    $icon_svg = '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>';
                }

                return [
                    'name'           => $custom,
                    'header_grad'    => $p['header_grad'],
                    'card_border'    => $p['border'],
                    'card_shadow'    => 'hover:shadow-' . $custom . '-500/15',
                    'top_stripe'     => $p['top_stripe'],
                    'icon_box'       => $p['icon_box'],
                    'pill_badge'     => $p['pill'],
                    'accent_text'    => $p['hover_text'],
                    'border_accent'  => 'border-' . $custom . '-400/80 dark:border-' . $custom . '-500',
                    'btn_primary'    => $p['btn_primary'],
                    'icon_svg'       => $icon_svg,
                ];
            }
        }

        // 1. Bisnis, Pemasaran, Marketing, AO, Sales, Finance -> Warm Amber & Gold / Orange
        if ( in_array( $slug, [ 'bisnis', 'marketing', 'pemasaran', 'sales', 'ao', 'keuangan', 'finance', 'akuntansi', 'accounting', 'treasury' ], true ) || 
             strpos( $title_lower, 'account officer' ) !== false || 
             strpos( $title_lower, 'marketing' ) !== false || 
             strpos( $title_lower, 'pembiayaan' ) !== false ||
             strpos( $title_lower, 'treasury' ) !== false ||
             strpos( $title_lower, 'finance' ) !== false ) {
            return [
                'name'           => 'amber',
                'header_grad'    => 'from-amber-500/12 via-orange-50/60 to-transparent dark:from-amber-950/40 dark:via-orange-950/20 dark:to-transparent',
                'card_border'    => 'border-amber-200/90 dark:border-amber-700/60 hover:border-amber-400 dark:hover:border-amber-500',
                'card_shadow'    => 'hover:shadow-amber-500/15',
                'top_stripe'     => 'from-amber-400 via-orange-400 to-yellow-500',
                'icon_box'       => 'bg-gradient-to-br from-amber-400 via-amber-500 to-orange-500 text-white shadow-[0_8px_18px_-4px_rgba(245,158,11,0.45),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill_badge'     => 'bg-amber-100/90 dark:bg-amber-950/80 text-amber-900 dark:text-amber-200 border border-amber-300/80 dark:border-amber-700/80',
                'accent_text'    => 'text-amber-600 dark:text-amber-400',
                'border_accent'  => 'border-amber-400/80 dark:border-amber-500',
                'btn_primary'    => 'bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 hover:from-amber-400 hover:to-orange-500 text-slate-950 shadow-[0_8px_18px_-4px_rgba(245,158,11,0.4),inset_0_2px_3px_rgba(255,255,255,0.5),inset_0_-2px_3px_rgba(0,0,0,0.15)]',
                'icon_svg'       => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" /></svg>',
            ];
        }

        // 2. Operasional, Layanan, CS, Teller, Back Office -> Emerald Syariah & Mint
        if ( in_array( $slug, [ 'operasional', 'layanan', 'cs', 'teller', 'bo' ], true ) || 
             strpos( $title_lower, 'customer service' ) !== false || 
             strpos( $title_lower, 'teller' ) !== false || 
             strpos( $title_lower, 'operasional' ) !== false ) {
            return [
                'name'           => 'emerald',
                'header_grad'    => 'from-emerald-500/12 via-teal-50/60 to-transparent dark:from-emerald-950/40 dark:via-teal-950/20 dark:to-transparent',
                'card_border'    => 'border-emerald-200/90 dark:border-emerald-700/60 hover:border-emerald-400 dark:hover:border-emerald-500',
                'card_shadow'    => 'hover:shadow-emerald-500/15',
                'top_stripe'     => 'from-emerald-400 via-teal-400 to-cyan-500',
                'icon_box'       => 'bg-gradient-to-br from-emerald-500 via-teal-500 to-teal-600 text-white shadow-[0_8px_18px_-4px_rgba(16,185,129,0.45),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill_badge'     => 'bg-emerald-100/90 dark:bg-emerald-950/80 text-emerald-900 dark:text-emerald-200 border border-emerald-300/80 dark:border-emerald-700/80',
                'accent_text'    => 'text-emerald-600 dark:text-emerald-400',
                'border_accent'  => 'border-emerald-400/80 dark:border-emerald-500',
                'btn_primary'    => 'bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 hover:from-emerald-500 hover:to-teal-500 text-white shadow-[0_8px_18px_-4px_rgba(16,185,129,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'icon_svg'       => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>',
            ];
        }

        // 3. Teknologi Informasi, IT, Sistem, Developer -> Cyber Cyan & Electric Blue
        if ( in_array( $slug, [ 'it', 'ti', 'teknologi', 'digital', 'developer', 'sistem' ], true ) || 
             preg_match( '/\b(it|ti)\b/i', $title ) || 
             strpos( $title_lower, 'teknologi' ) !== false || 
             strpos( $title_lower, 'developer' ) !== false || 
             strpos( $title_lower, 'programmer' ) !== false || 
             strpos( $title_lower, 'sistem' ) !== false ) {
            return [
                'name'           => 'cyan',
                'header_grad'    => 'from-cyan-500/12 via-sky-50/60 to-transparent dark:from-cyan-950/40 dark:via-blue-950/20 dark:to-transparent',
                'card_border'    => 'border-cyan-200/90 dark:border-cyan-700/60 hover:border-cyan-400 dark:hover:border-cyan-500',
                'card_shadow'    => 'hover:shadow-cyan-500/15',
                'top_stripe'     => 'from-cyan-400 via-sky-400 to-blue-500',
                'icon_box'       => 'bg-gradient-to-br from-cyan-500 via-sky-500 to-blue-600 text-white shadow-[0_8px_18px_-4px_rgba(6,182,212,0.45),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill_badge'     => 'bg-cyan-100/90 dark:bg-cyan-950/80 text-cyan-900 dark:text-cyan-200 border border-cyan-300/80 dark:border-cyan-700/80',
                'accent_text'    => 'text-cyan-600 dark:text-cyan-400',
                'border_accent'  => 'border-cyan-400/80 dark:border-cyan-500',
                'btn_primary'    => 'bg-gradient-to-r from-cyan-600 via-sky-600 to-blue-600 hover:from-cyan-500 hover:to-sky-500 text-white shadow-[0_8px_18px_-4px_rgba(6,182,212,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'icon_svg'       => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" /></svg>',
            ];
        }

        // 4. Program Magang Kampus / Internship -> Royal Violet & Radiant Fuchsia
        if ( in_array( $slug, [ 'magang', 'internship', 'kampus', 'mahasiswa' ], true ) || 
             strpos( $title_lower, 'magang' ) !== false || 
             strpos( $title_lower, 'internship' ) !== false ) {
            return [
                'name'           => 'purple',
                'header_grad'    => 'from-purple-500/12 via-fuchsia-50/60 to-transparent dark:from-purple-950/40 dark:via-fuchsia-950/20 dark:to-transparent',
                'card_border'    => 'border-purple-200/90 dark:border-purple-700/60 hover:border-purple-400 dark:hover:border-purple-500',
                'card_shadow'    => 'hover:shadow-purple-500/15',
                'top_stripe'     => 'from-purple-400 via-fuchsia-400 to-pink-500',
                'icon_box'       => 'bg-gradient-to-br from-purple-500 via-fuchsia-500 to-pink-600 text-white shadow-[0_8px_18px_-4px_rgba(168,85,247,0.45),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill_badge'     => 'bg-purple-100/90 dark:bg-purple-950/80 text-purple-900 dark:text-purple-200 border border-purple-300/80 dark:border-purple-700/80',
                'accent_text'    => 'text-purple-600 dark:text-purple-400',
                'border_accent'  => 'border-purple-400/80 dark:border-purple-500',
                'btn_primary'    => 'bg-gradient-to-r from-purple-600 via-fuchsia-600 to-pink-600 hover:from-purple-500 hover:to-fuchsia-500 text-white shadow-[0_8px_18px_-4px_rgba(168,85,247,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'icon_svg'       => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342" /></svg>',
            ];
        }

        // 5. Legal, Kepatuhan, Hukum, APU-PPT -> Sapphire Corporate Blue
        if ( in_array( $slug, [ 'legal', 'hukum', 'kepatuhan', 'compliance' ], true ) || 
             strpos( $title_lower, 'legal' ) !== false || 
             strpos( $title_lower, 'kepatuhan' ) !== false || 
             strpos( $title_lower, 'hukum' ) !== false ) {
            return [
                'name'           => 'blue',
                'header_grad'    => 'from-blue-500/12 via-indigo-50/60 to-transparent dark:from-blue-950/40 dark:via-indigo-950/20 dark:to-transparent',
                'card_border'    => 'border-blue-200/90 dark:border-blue-700/60 hover:border-blue-400 dark:hover:border-blue-500',
                'card_shadow'    => 'hover:shadow-blue-500/15',
                'top_stripe'     => 'from-blue-400 via-indigo-400 to-sky-500',
                'icon_box'       => 'bg-gradient-to-br from-blue-500 via-indigo-500 to-blue-600 text-white shadow-[0_8px_18px_-4px_rgba(37,99,235,0.45),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill_badge'     => 'bg-blue-100/90 dark:bg-blue-950/80 text-blue-900 dark:text-blue-200 border border-blue-300/80 dark:border-blue-700/80',
                'accent_text'    => 'text-blue-600 dark:text-blue-400',
                'border_accent'  => 'border-blue-400/80 dark:border-blue-500',
                'btn_primary'    => 'bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 hover:from-blue-500 hover:to-indigo-500 text-white shadow-[0_8px_18px_-4px_rgba(37,99,235,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'icon_svg'       => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z"/></svg>',
            ];
        }

        // 6. SKAI, Audit Internal, Manajemen Risiko, Pengawas -> Indigo Royal
        if ( in_array( $slug, [ 'skai', 'audit', 'pengawas', 'risk', 'risiko' ], true ) || 
             strpos( $title_lower, 'audit' ) !== false || 
             strpos( $title_lower, 'skai' ) !== false || 
             strpos( $title_lower, 'risiko' ) !== false ) {
            return [
                'name'           => 'indigo',
                'header_grad'    => 'from-indigo-500/12 via-purple-50/60 to-transparent dark:from-indigo-950/40 dark:via-purple-950/20 dark:to-transparent',
                'card_border'    => 'border-indigo-200/90 dark:border-indigo-700/60 hover:border-indigo-400 dark:hover:border-indigo-500',
                'card_shadow'    => 'hover:shadow-indigo-500/15',
                'top_stripe'     => 'from-indigo-400 via-purple-400 to-blue-500',
                'icon_box'       => 'bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-600 text-white shadow-[0_8px_18px_-4px_rgba(79,70,229,0.45),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill_badge'     => 'bg-indigo-100/90 dark:bg-indigo-950/80 text-indigo-900 dark:text-indigo-200 border border-indigo-300/80 dark:border-indigo-700/80',
                'accent_text'    => 'text-indigo-600 dark:text-indigo-400',
                'border_accent'  => 'border-indigo-400/80 dark:border-indigo-500',
                'btn_primary'    => 'bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 hover:from-indigo-500 hover:to-purple-500 text-white shadow-[0_8px_18px_-4px_rgba(79,70,229,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'icon_svg'       => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>',
            ];
        }

        // 7. SDM, HRD, Human Capital, Personalia -> Rose Crimson
        if ( in_array( $slug, [ 'sdm', 'hrd', 'personalia', 'human capital' ], true ) || 
             strpos( $title_lower, 'sdm' ) !== false || 
             strpos( $title_lower, 'hrd' ) !== false || 
             strpos( $title_lower, 'human capital' ) !== false || 
             strpos( $title_lower, 'personalia' ) !== false ) {
            return [
                'name'           => 'rose',
                'header_grad'    => 'from-rose-500/12 via-pink-50/60 to-transparent dark:from-rose-950/40 dark:via-pink-950/20 dark:to-transparent',
                'card_border'    => 'border-rose-200/90 dark:border-rose-700/60 hover:border-rose-400 dark:hover:border-rose-500',
                'card_shadow'    => 'hover:shadow-rose-500/15',
                'top_stripe'     => 'from-rose-400 via-pink-400 to-red-500',
                'icon_box'       => 'bg-gradient-to-br from-rose-400 via-rose-500 to-red-600 text-white shadow-[0_8px_18px_-4px_rgba(225,29,72,0.45),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
                'pill_badge'     => 'bg-rose-100/90 dark:bg-rose-950/80 text-rose-900 dark:text-rose-200 border border-rose-300/80 dark:border-rose-700/80',
                'accent_text'    => 'text-rose-600 dark:text-rose-400',
                'border_accent'  => 'border-rose-400/80 dark:border-rose-500',
                'btn_primary'    => 'bg-gradient-to-r from-rose-600 via-pink-600 to-rose-700 hover:from-rose-500 hover:to-pink-500 text-white shadow-[0_8px_18px_-4px_rgba(225,29,72,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
                'icon_svg'       => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>',
            ];
        }

        // 8. Default / Umum / Lainnya -> Teal Syariah BSW
        return [
            'name'           => 'teal',
            'header_grad'    => 'from-teal-500/12 via-emerald-50/60 to-transparent dark:from-teal-950/40 dark:via-emerald-950/20 dark:to-transparent',
            'card_border'    => 'border-teal-200/90 dark:border-teal-700/60 hover:border-teal-400 dark:hover:border-teal-500',
            'card_shadow'    => 'hover:shadow-teal-500/15',
            'top_stripe'     => 'from-teal-400 via-cyan-400 to-emerald-500',
            'icon_box'       => 'bg-gradient-to-br from-teal-500 via-teal-600 to-emerald-600 text-white shadow-[0_8px_18px_-4px_rgba(20,184,166,0.45),inset_0_2px_4px_rgba(255,255,255,0.7),inset_0_-2px_4px_rgba(0,0,0,0.15)]',
            'pill_badge'     => 'bg-teal-100/90 dark:bg-teal-950/80 text-teal-900 dark:text-teal-200 border border-teal-300/80 dark:border-teal-700/80',
            'accent_text'    => 'text-teal-600 dark:text-teal-400',
            'border_accent'  => 'border-teal-400/80 dark:border-teal-500',
            'btn_primary'    => 'bg-gradient-to-r from-teal-600 via-emerald-600 to-teal-700 hover:from-teal-500 hover:to-emerald-500 text-white shadow-[0_8px_18px_-4px_rgba(20,184,166,0.4),inset_0_2px_3px_rgba(255,255,255,0.4),inset_0_-2px_3px_rgba(0,0,0,0.2)]',
            'icon_svg'       => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" /></svg>',
        ];
    }
}


// ── 2. MENU REGISTRATION & ASSETS ───────────────────────────────────

add_action( 'admin_menu', 'wakalumi_register_karir_page', 33 );
function wakalumi_register_karir_page() {
    add_submenu_page(
        'wakalumi-settings',
        'Karir & Rekrutmen',
        'Karir & Rekrutmen',
        'manage_options',
        'wakalumi-karir',
        'wakalumi_render_karir_admin_page'
    );
}


// ── 3. RENDER ADMIN INTERFACE ───────────────────────────────────────

function wakalumi_render_karir_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Akses ditolak.' );
    }

    $notice = '';

    // Handle Form Save
    if ( isset( $_POST['wkl_karir_save_nonce'] ) ) {
        if ( ! wp_verify_nonce( $_POST['wkl_karir_save_nonce'], 'wkl_karir_save_action' ) ) {
            $notice = '<div class="notice notice-error is-dismissible"><p>Validasi keamanan gagal. Silakan coba kembali.</p></div>';
        } else {
            // 1. Simpan Header
            update_option( 'options_karir_badge', sanitize_text_field( $_POST['options_karir_badge'] ?? '' ) );
            update_option( 'options_karir_title', sanitize_text_field( $_POST['options_karir_title'] ?? '' ) );
            update_option( 'options_karir_desc', sanitize_textarea_field( $_POST['options_karir_desc'] ?? '' ) );

            // 2. Simpan Anti-Fraud
            update_option( 'options_karir_fraud_badge', sanitize_text_field( $_POST['options_karir_fraud_badge'] ?? '' ) );
            update_option( 'options_karir_fraud_title', sanitize_text_field( $_POST['options_karir_fraud_title'] ?? '' ) );
            update_option( 'options_karir_fraud_desc', sanitize_textarea_field( $_POST['options_karir_fraud_desc'] ?? '' ) );

            // 3. Simpan Repeater Lowongan Kerja
            $job_ids         = $_POST['job_id'] ?? [];
            $job_posisis     = $_POST['job_posisi'] ?? [];
            $job_divisis     = $_POST['job_divisi'] ?? [];
            $job_div_customs = $_POST['job_divisi_custom'] ?? [];
            $job_tipes       = $_POST['job_tipe'] ?? [];
            $job_lokasis     = $_POST['job_lokasi'] ?? [];
            $job_deadlines   = $_POST['job_deadline'] ?? [];
            $job_form_urls   = $_POST['job_form_url'] ?? [];
            $job_statuses    = $_POST['job_status'] ?? [];
            $job_colors      = $_POST['job_color'] ?? [];
            $job_ringkasan   = $_POST['job_ringkasan'] ?? [];
            $job_kualifs     = $_POST['job_kualifikasi'] ?? [];
            $job_urutans     = $_POST['job_urutan'] ?? [];

            $division_presets = wakalumi_get_karir_division_presets();
            $new_jobs         = [];

            for ( $i = 0; $i < count( $job_ids ); $i++ ) {
                $posisi = sanitize_text_field( $job_posisis[$i] ?? '' );
                if ( empty( $posisi ) ) continue;

                $sel_div  = sanitize_text_field( $job_divisis[$i] ?? 'bisnis' );
                $cust_div = sanitize_text_field( $job_div_customs[$i] ?? '' );

                // Cek apakah memilih kategori kustom atau preset
                if ( $sel_div === 'custom' || ( ! isset( $division_presets[ $sel_div ] ) && ! empty( $cust_div ) ) ) {
                    if ( ! empty( $cust_div ) ) {
                        $divisi_lbl    = $cust_div;
                        $divisi_slug   = sanitize_title( $cust_div );
                        if ( empty( $divisi_slug ) ) {
                            $divisi_slug = 'divisi-' . ( $i + 1 );
                        }
                        $divisi_custom = $cust_div;
                        $is_custom     = 1;
                    } else {
                        // Fallback jika admin memilih opsi kustom tapi mengosongkan input
                        $divisi_slug   = 'umum';
                        $divisi_lbl    = 'Umum & Personalia';
                        $divisi_custom = '';
                        $is_custom     = 0;
                    }
                } else {
                    $divisi_slug   = $sel_div;
                    $divisi_lbl    = $division_presets[ $sel_div ] ?? ucfirst( $sel_div );
                    $divisi_custom = '';
                    $is_custom     = 0;
                }

                $new_jobs[] = [
                    'id'               => sanitize_text_field( $job_ids[$i] ?? ( 'job_' . ( $i + 1 ) ) ),
                    'posisi'           => $posisi,
                    'divisi'           => $divisi_slug,
                    'divisi_lbl'       => $divisi_lbl,
                    'divisi_custom'    => $divisi_custom,
                    'divisi_is_custom' => $is_custom,
                    'tipe'             => sanitize_text_field( $job_tipes[$i] ?? 'Penuh Waktu' ),
                    'lokasi'           => sanitize_text_field( $job_lokasis[$i] ?? 'Kantor Pusat' ),
                    'deadline'         => sanitize_text_field( $job_deadlines[$i] ?? '' ),
                    'form_url'         => esc_url_raw( $job_form_urls[$i] ?? '' ),
                    'status'           => sanitize_text_field( $job_statuses[$i] ?? 'dibuka' ),
                    'color'            => sanitize_text_field( $job_colors[$i] ?? 'auto' ),
                    'ringkasan'        => sanitize_textarea_field( $job_ringkasan[$i] ?? '' ),
                    'kualifikasi'      => sanitize_textarea_field( $job_kualifs[$i] ?? '' ),
                    'urutan'           => intval( $job_urutans[$i] ?? ( $i + 1 ) ),
                ];
            }

            usort( $new_jobs, fn( $a, $b ) => ( $a['urutan'] ?? 0 ) <=> ( $b['urutan'] ?? 0 ) );
            update_option( 'options_karir_jobs_list', $new_jobs );

            // 4. Simpan Section Nilai & Budaya Perusahaan (4 Pilar)
            update_option( 'options_karir_values_badge', sanitize_text_field( $_POST['options_karir_values_badge'] ?? '' ) );
            update_option( 'options_karir_values_title', sanitize_text_field( $_POST['options_karir_values_title'] ?? '' ) );
            update_option( 'options_karir_values_desc', sanitize_textarea_field( $_POST['options_karir_values_desc'] ?? '' ) );

            $val_titles = $_POST['val_title'] ?? [];
            $val_descs  = $_POST['val_desc'] ?? [];
            $val_colors = $_POST['val_color'] ?? [];
            $val_icons  = $_POST['val_icon'] ?? [];
            $new_values = [];
            for ( $v = 0; $v < count( $val_titles ); $v++ ) {
                $vt = sanitize_text_field( $val_titles[$v] ?? '' );
                if ( empty( $vt ) ) continue;
                $new_values[] = [
                    'title' => $vt,
                    'desc'  => sanitize_textarea_field( $val_descs[$v] ?? '' ),
                    'color' => sanitize_text_field( $val_colors[$v] ?? 'emerald' ),
                    'icon'  => sanitize_text_field( $val_icons[$v] ?? 'shield' ),
                ];
            }
            if ( ! empty( $new_values ) ) {
                update_option( 'options_karir_values_list', $new_values );
            }

            // 5. Simpan Section Alur & Tahapan Rekrutmen (4 Tahap)
            update_option( 'options_karir_stages_badge', sanitize_text_field( $_POST['options_karir_stages_badge'] ?? '' ) );
            update_option( 'options_karir_stages_title', sanitize_text_field( $_POST['options_karir_stages_title'] ?? '' ) );
            update_option( 'options_karir_stages_desc', sanitize_textarea_field( $_POST['options_karir_stages_desc'] ?? '' ) );

            $stage_steps  = $_POST['stage_step'] ?? [];
            $stage_titles = $_POST['stage_title'] ?? [];
            $stage_descs  = $_POST['stage_desc'] ?? [];
            $stage_colors = $_POST['stage_color'] ?? [];
            $new_stages   = [];
            for ( $s = 0; $s < count( $stage_titles ); $s++ ) {
                $st = sanitize_text_field( $stage_titles[$s] ?? '' );
                if ( empty( $st ) ) continue;
                $new_stages[] = [
                    'step'  => sanitize_text_field( $stage_steps[$s] ?? sprintf( '%02d', $s + 1 ) ),
                    'title' => $st,
                    'desc'  => sanitize_textarea_field( $stage_descs[$s] ?? '' ),
                    'color' => sanitize_text_field( $stage_colors[$s] ?? 'cyan' ),
                ];
            }
            if ( ! empty( $new_stages ) ) {
                update_option( 'options_karir_stages_list', $new_stages );
            }

            // 6. Simpan Status Formasi Kosong (Centerpiece Showcase saat 0 Lowongan)
            update_option( 'options_karir_empty_badge', sanitize_text_field( $_POST['options_karir_empty_badge'] ?? '' ) );
            update_option( 'options_karir_empty_title', sanitize_text_field( $_POST['options_karir_empty_title'] ?? '' ) );
            update_option( 'options_karir_empty_desc', sanitize_textarea_field( $_POST['options_karir_empty_desc'] ?? '' ) );

            $empty_titles = $_POST['empty_sc_title'] ?? [];
            $empty_descs  = $_POST['empty_sc_desc'] ?? [];
            $empty_colors = $_POST['empty_sc_color'] ?? [];
            $empty_icons  = $_POST['empty_sc_icon'] ?? [];
            $new_subcards = [];
            for ( $e = 0; $e < count( $empty_titles ); $e++ ) {
                $et = sanitize_text_field( $empty_titles[$e] ?? '' );
                if ( empty( $et ) ) continue;
                $new_subcards[] = [
                    'title' => $et,
                    'desc'  => sanitize_textarea_field( $empty_descs[$e] ?? '' ),
                    'color' => sanitize_text_field( $empty_colors[$e] ?? 'emerald' ),
                    'icon'  => sanitize_text_field( $empty_icons[$e] ?? 'shield' ),
                ];
            }
            if ( ! empty( $new_subcards ) ) {
                update_option( 'options_karir_empty_subcards', $new_subcards );
            }

            // 7. Simpan CTA Bawah
            update_option( 'options_karir_cta_show', isset( $_POST['options_karir_cta_show'] ) ? '1' : '0' );
            update_option( 'options_karir_cta_badge', sanitize_text_field( $_POST['options_karir_cta_badge'] ?? '' ) );
            update_option( 'options_karir_cta_title', sanitize_text_field( $_POST['options_karir_cta_title'] ?? '' ) );
            update_option( 'options_karir_cta_desc', sanitize_textarea_field( $_POST['options_karir_cta_desc'] ?? '' ) );
            update_option( 'options_karir_cta_btn1_text', sanitize_text_field( $_POST['options_karir_cta_btn1_text'] ?? '' ) );
            update_option( 'options_karir_cta_btn1_url', esc_url_raw( $_POST['options_karir_cta_btn1_url'] ?? '' ) );
            update_option( 'options_karir_cta_btn2_text', sanitize_text_field( $_POST['options_karir_cta_btn2_text'] ?? '' ) );
            update_option( 'options_karir_cta_btn2_url', esc_url_raw( $_POST['options_karir_cta_btn2_url'] ?? '' ) );

            $notice = '<div class="notice notice-success is-dismissible"><p><strong>Berhasil!</strong> Pengaturan Karir, Lowongan Kerja, dan Tampilan Warna Kartu telah disimpan.</p></div>';
        }
    }

    // Reset Action Handler
    if ( isset( $_GET['wkl_action'] ) && $_GET['wkl_action'] === 'reset_karir_jobs' && check_admin_referer( 'wkl_reset_karir_nonce' ) ) {
        update_option( 'options_karir_jobs_list', wakalumi_get_default_karir_jobs() );
        delete_option( 'options_karir_values_list' );
        delete_option( 'options_karir_stages_list' );
        delete_option( 'options_karir_empty_subcards' );
        $notice = '<div class="notice notice-success is-dismissible"><p>Daftar lowongan kerja, nilai budaya, dan tahapan seleksi berhasil dimuat ulang ke data standar.</p></div>';
    }

    // Load Data
    $header      = wakalumi_get_karir_header();
    $antifraud   = wakalumi_get_karir_antifraud();
    $jobs        = wakalumi_get_karir_jobs();
    $cta         = wakalumi_get_karir_cta();
    $values_hdr  = wakalumi_get_karir_values_header();
    $values_list = wakalumi_get_karir_values();
    $stages_hdr  = wakalumi_get_karir_stages_header();
    $stages_list = wakalumi_get_karir_stages();
    $empty_state = wakalumi_get_karir_empty_state();
    $color_opts  = wakalumi_get_karir_color_options();
    $icon_opts   = wakalumi_get_karir_icon_options();

    $total_jobs  = count( $jobs );
    $open_jobs   = count( array_filter( $jobs, fn($x) => ( $x['status'] ?? 'dibuka' ) === 'dibuka' ) );
    $soon_jobs   = count( array_filter( $jobs, fn($x) => ( $x['status'] ?? '' ) === 'segera' ) );
    $closed_jobs = count( array_filter( $jobs, fn($x) => ( $x['status'] ?? '' ) === 'ditutup' ) );

    $reset_url = wp_nonce_url( admin_url( 'admin.php?page=wakalumi-karir&wkl_action=reset_karir_jobs' ), 'wkl_reset_karir_nonce' );
    ?>

    <div class="wrap" style="max-width: 1140px; margin-top: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;">

        <!-- TOP BAR HEADER -->
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #e2e8f0;">
            <div>
                <h1 style="font-size: 24px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <span class="dashicons dashicons-businessman" style="font-size: 28px; width: 28px; height: 28px; color: #0f766e;"></span>
                    Pengaturan Karir &amp; Rekrutmen Insan BSW
                </h1>
                <p style="margin: 4px 0 0 0; color: #64748b; font-size: 13px;">
                    Kelola posisi lowongan pekerjaan aktif, tautan pendaftaran Google Form resmi, kualifikasi persyaratan, serta informasi tahapan seleksi.
                </p>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="<?php echo esc_url( home_url( '/informasi/karir/' ) ); ?>" target="_blank" class="button button-secondary" style="display: inline-flex; align-items: center; gap: 6px; font-weight: 600; padding: 4px 14px; border-radius: 6px;">
                    <span class="dashicons dashicons-external" style="font-size: 16px; width: 16px; height: 16px;"></span> Lihat Halaman Karir
                </a>
                <a href="<?php echo esc_url( $reset_url ); ?>" onclick="return confirm('Muat ulang data contoh lowongan baku? Lowongan yang Anda edit saat ini akan direset.');" class="button" style="color: #0f766e; border-color: #0f766e; font-weight: 600; padding: 4px 12px; border-radius: 6px;">
                    Muat Ulang Contoh Lowongan
                </a>
            </div>
        </div>

        <?php if ( ! empty( $notice ) ) echo $notice; ?>

        <!-- METRIC STATUS BAR -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; margin-bottom: 25px;">
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 14px 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Total Posisi</div>
                <div style="font-size: 24px; font-weight: 800; color: #0f172a; margin-top: 4px;"><?php echo $total_jobs; ?></div>
            </div>
            <div style="background: #ffffff; border: 1px solid #bbf7d0; border-radius: 10px; padding: 14px 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <div style="font-size: 11px; font-weight: 700; color: #166534; text-transform: uppercase; letter-spacing: 0.5px;">Sedang Dibuka</div>
                <div style="font-size: 24px; font-weight: 800; color: #15803d; margin-top: 4px;"><?php echo $open_jobs; ?></div>
            </div>
            <div style="background: #ffffff; border: 1px solid #fde68a; border-radius: 10px; padding: 14px 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <div style="font-size: 11px; font-weight: 700; color: #854d0e; text-transform: uppercase; letter-spacing: 0.5px;">Segera Hadir</div>
                <div style="font-size: 24px; font-weight: 800; color: #b45309; margin-top: 4px;"><?php echo $soon_jobs; ?></div>
            </div>
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                <div style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Ditutup</div>
                <div style="font-size: 24px; font-weight: 800; color: #64748b; margin-top: 4px;"><?php echo $closed_jobs; ?></div>
            </div>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field( 'wkl_karir_save_action', 'wkl_karir_save_nonce' ); ?>

            <!-- ================================================================
                 SECTION 1: MANAJEMEN LOWONGAN KERJA (REPEATER)
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px; margin-bottom: 20px;">
                    <div>
                        <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin: 0; display: flex; align-items: center; gap: 8px;">
                            <span class="dashicons dashicons-id-alt" style="font-size: 18px; width: 18px; height: 18px;"></span>
                            Daftar Lowongan Pekerjaan &amp; Tautan Pendaftaran Google Form
                        </h2>
                        <p style="margin: 4px 0 0 0; color: #64748b; font-size: 12px;">
                            Pelamar yang mengklik tombol <strong>Lamar Posisi Ini</strong> di halaman web akan langsung diarahkan ke tautan Google Form yang Anda tempel di bawah.
                        </p>
                    </div>
                    <button type="button" id="btn-add-job" class="button button-primary" style="background: #0f766e; border-color: #0d9488; font-weight: 700;">
                        + Tambah Lowongan Baru
                    </button>
                </div>

                <!-- Job Openings Container -->
                <div id="job-list-container" style="display: flex; flex-direction: column; gap: 18px;">
                    <?php 
                    foreach ( $jobs as $idx => $job ) : 
                        $job_id       = esc_attr( $job['id'] ?? ( 'job_' . ( $idx + 1 ) ) );
                        $posisi       = esc_attr( $job['posisi'] ?? '' );
                        $divisi       = esc_attr( $job['divisi'] ?? 'bisnis' );
                        $divisi_lbl   = esc_attr( $job['divisi_lbl'] ?? '' );
                        $tipe         = esc_attr( $job['tipe'] ?? 'Penuh Waktu (Full Time)' );
                        $lokasi       = esc_attr( $job['lokasi'] ?? 'Kantor Pusat' );
                        $deadline     = esc_attr( $job['deadline'] ?? '' );
                        $form_url     = esc_url( $job['form_url'] ?? '' );
                        $status       = esc_attr( $job['status'] ?? 'dibuka' );
                        $color        = esc_attr( $job['color'] ?? 'auto' );
                        $ringkasan    = esc_textarea( $job['ringkasan'] ?? '' );
                        $kualifikasi  = esc_textarea( $job['kualifikasi'] ?? '' );
                        $urutan       = intval( $job['urutan'] ?? ( $idx + 1 ) );

                        $division_presets = wakalumi_get_karir_division_presets();
                        $is_custom_div    = ! empty( $job['divisi_is_custom'] ) || $divisi === 'custom' || ( ! isset( $division_presets[ $divisi ] ) && ! empty( $divisi_lbl ) );
                        $custom_div_val   = ! empty( $job['divisi_custom'] ) ? $job['divisi_custom'] : ( $is_custom_div ? $divisi_lbl : '' );
                        $selected_div_key = $is_custom_div ? 'custom' : $divisi;

                        $status_bg = '#dcfce7';
                        $status_color = '#166534';
                        if ( $status === 'segera' ) {
                            $status_bg = '#fef3c7';
                            $status_color = '#92400e';
                        } elseif ( $status === 'ditutup' ) {
                            $status_bg = '#fee2e2';
                            $status_color = '#991b1b';
                        }
                    ?>
                        <div class="job-card-item" data-id="<?php echo $job_id; ?>" style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 5px solid #0f766e; border-radius: 10px; padding: 20px; transition: all 0.2s;">
                            <input type="hidden" name="job_id[]" value="<?php echo $job_id; ?>">

                            <!-- Header Bar of Card -->
                            <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span style="font-weight: 800; font-size: 15px; color: #0f172a;" class="job-title-display">
                                        #<?php echo $urutan; ?> — <?php echo ! empty( $posisi ) ? $posisi : 'Lowongan Baru'; ?>
                                    </span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 999px; background: <?php echo $status_bg; ?>; color: <?php echo $status_color; ?>;" class="job-status-badge">
                                        ● <?php echo ucfirst( $status ); ?>
                                    </span>
                                    <button type="button" class="button button-link-delete btn-delete-job" style="color: #ef4444; font-size: 12px; padding: 2px 6px;">
                                        Hapus
                                    </button>
                                </div>
                            </div>

                            <!-- Row 1: Posisi & Divisi & Tipe -->
                            <div style="display: grid; grid-template-columns: 2fr 1.2fr 1.2fr; gap: 14px; margin-bottom: 12px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Nama Posisi Jabatan</label>
                                    <input type="text" name="job_posisi[]" value="<?php echo $posisi; ?>" class="job-posisi-input" placeholder="Contoh: Account Officer Pembiayaan Syariah" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; font-weight: 600; background: #fff;" required>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Kategori Divisi</label>
                                    <select name="job_divisi[]" class="job-divisi-select" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                        <?php foreach ( $division_presets as $d_key => $d_name ) : ?>
                                            <option value="<?php echo esc_attr( $d_key ); ?>" <?php selected( $selected_div_key, $d_key ); ?>>
                                                <?php echo esc_html( $d_name ); ?>
                                            </option>
                                        <?php endforeach; ?>
                                        <option value="custom" <?php selected( $selected_div_key, 'custom' ); ?>>
                                            ✏️ Kategori Kustom / Input Sendiri...
                                        </option>
                                    </select>
                                    <div class="job-custom-divisi-wrap" style="<?php echo $is_custom_div ? 'margin-top: 6px;' : 'display: none; margin-top: 6px;'; ?>">
                                        <input type="text" 
                                               name="job_divisi_custom[]" 
                                               value="<?php echo esc_attr( $custom_div_val ); ?>" 
                                               class="job-custom-divisi-input" 
                                               placeholder="Ketik nama divisi baru (misal: Treasury &amp; ALMA, CS, dll)..." 
                                               style="width: 100%; border: 1.5px solid #0d9488; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #f0fdfa; color: #0f766e; font-weight: 600;">
                                        <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">Ketik nama kategori divisi baru sesuai kebutuhan organisasi.</small>
                                    </div>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Tipe Pekerjaan</label>
                                    <select name="job_tipe[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                        <option value="Penuh Waktu (Full Time)" <?php selected( $tipe, 'Penuh Waktu (Full Time)' ); ?>>Penuh Waktu (Full Time)</option>
                                        <option value="Kontrak (Contract)" <?php selected( $tipe, 'Kontrak (Contract)' ); ?>>Kontrak (Contract)</option>
                                        <option value="Magang (Internship)" <?php selected( $tipe, 'Magang (Internship)' ); ?>>Magang (Internship)</option>
                                        <option value="Paruh Waktu (Part Time)" <?php selected( $tipe, 'Paruh Waktu (Part Time)' ); ?>>Paruh Waktu (Part Time)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Row 2: Lokasi, Deadline, Warna, Status, Urutan -->
                            <div style="display: grid; grid-template-columns: 1.3fr 1.1fr 1.2fr 1fr 0.5fr; gap: 12px; margin-bottom: 12px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Lokasi Penempatan</label>
                                    <input type="text" name="job_lokasi[]" value="<?php echo $lokasi; ?>" placeholder="Contoh: Kantor Pusat - Jakarta" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Batas Waktu Lamaran</label>
                                    <input type="text" name="job_deadline[]" value="<?php echo $deadline; ?>" placeholder="Contoh: 30 November 2026" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Aksen Warna Card</label>
                                    <select name="job_color[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                        <option value="auto" <?php selected( $color, 'auto' ); ?>>● Otomatis (Divisi)</option>
                                        <?php foreach ( $color_opts as $ckey => $cdata ) : ?>
                                            <option value="<?php echo esc_attr( $ckey ); ?>" <?php selected( $color, $ckey ); ?>>
                                                <?php echo esc_html( $cdata['name'] ); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Status Perekrutan</label>
                                    <select name="job_status[]" class="job-status-select" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff; font-weight: 700;">
                                        <option value="dibuka" <?php selected( $status, 'dibuka' ); ?>>Dibuka</option>
                                        <option value="segera" <?php selected( $status, 'segera' ); ?>>Segera Hadir</option>
                                        <option value="ditutup" <?php selected( $status, 'ditutup' ); ?>>Ditutup</option>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Urutan</label>
                                    <input type="number" name="job_urutan[]" value="<?php echo $urutan; ?>" min="1" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 4px; font-size: 13px; text-align: center; background: #fff;">
                                </div>
                            </div>

                            <!-- Row 3: Tautan Formulir Rekrutmen (Google Form) -->
                            <div style="margin-bottom: 12px; padding: 12px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px;">
                                <label style="display: block; font-weight: 700; font-size: 12px; margin-bottom: 4px; color: #166534;">
                                    Tautan Pendaftaran Online (Link Google Form / Form Rekrutmen)
                                </label>
                                <input type="url" name="job_form_url[]" value="<?php echo $form_url; ?>" placeholder="Tempelkan URL Google Form di sini, contoh: https://forms.gle/..." style="width: 100%; border: 1px solid #86efac; border-radius: 6px; padding: 7px 10px; font-size: 13px; font-family: monospace; background: #fff;">
                                <span style="display: block; margin-top: 4px; font-size: 11px; color: #15803d;">
                                    Tautan ini akan terbuka di tab baru saat calon pelamar menekan tombol "Lamar Posisi Ini".
                                </span>
                            </div>

                            <!-- Row 4: Ringkasan Tanggung Jawab & Kualifikasi Persyaratan -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                        Deskripsi Singkat &amp; Tanggung Jawab
                                    </label>
                                    <textarea name="job_ringkasan[]" rows="4" placeholder="Uraikan ringkasan tugas dan tanggung jawab posisi ini..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"><?php echo $ringkasan; ?></textarea>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                        Kualifikasi &amp; Persyaratan (Pisahkan per baris)
                                    </label>
                                    <textarea name="job_kualifikasi[]" rows="4" placeholder="Pria/Wanita, Usia maks 28 tahun&#10;Pendidikan min. D3/S1&#10;Komunikatif dan berintegritas tinggi" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"><?php echo $kualifikasi; ?></textarea>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top: 20px; text-align: center;">
                    <button type="button" id="btn-add-job-bottom" class="button" style="padding: 8px 24px; font-weight: 700; border-radius: 6px; border: 2px dashed #94a3b8; width: 100%; max-width: 320px; background: #f8fafc;">
                        + Tambah Lowongan Baru
                    </button>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 2: KUSTOMISASI CARD BUDAYA PERUSAHAAN (4 NILAI KERJA BSW)
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-heart" style="font-size: 18px; width: 18px; height: 18px;"></span>
                    Pengaturan Card Budaya Perusahaan (4 Nilai Kerja Insan BSW)
                </h2>
                <p style="margin: 4px 0 15px 0; color: #64748b; font-size: 12px;">
                    Kelola narasi, judul, pilihan warna tema dual-tone, dan ikon SVG pada masing-masing kartu nilai budaya di halaman Karir.
                </p>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Badge Section</label>
                        <input type="text" name="options_karir_values_badge" value="<?php echo esc_attr( $values_hdr['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Judul Utama Section</label>
                        <input type="text" name="options_karir_values_title" value="<?php echo esc_attr( $values_hdr['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Deskripsi Pengantar Section</label>
                    <textarea name="options_karir_values_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 13px;"><?php echo esc_textarea( $values_hdr['desc'] ); ?></textarea>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
                    <?php 
                    for ( $vi = 0; $vi < 4; $vi++ ) : 
                        $val_item  = $values_list[$vi] ?? [];
                        $val_t     = esc_attr( $val_item['title'] ?? '' );
                        $val_d     = esc_textarea( $val_item['desc'] ?? '' );
                        $val_c     = esc_attr( $val_item['color'] ?? 'emerald' );
                        $val_i     = esc_attr( $val_item['icon'] ?? 'shield' );
                    ?>
                        <div style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 10px; padding: 16px; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                                    <span style="font-size: 12px; font-weight: 800; color: #0f766e; text-transform: uppercase;">Nilai 0<?php echo ( $vi + 1 ); ?></span>
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Judul Nilai / Karakter</label>
                                    <input type="text" name="val_title[]" value="<?php echo $val_t; ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 12px; font-weight: 700; background: #fff;" required>
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Narasi / Penjelasan</label>
                                    <textarea name="val_desc[]" rows="4" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 12px; background: #fff;"><?php echo $val_d; ?></textarea>
                                </div>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-top: 6px;">
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 11px; margin-bottom: 4px; color: #334155;">Warna Kartu</label>
                                    <select name="val_color[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 5px 6px; font-size: 11px; background: #fff;">
                                        <?php foreach ( $color_opts as $ckey => $cdata ) : ?>
                                            <option value="<?php echo esc_attr( $ckey ); ?>" <?php selected( $val_c, $ckey ); ?>>
                                                <?php echo esc_html( $cdata['name'] ); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label style="display: block; font-weight: 600; font-size: 11px; margin-bottom: 4px; color: #334155;">Ikon SVG</label>
                                    <select name="val_icon[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 5px 6px; font-size: 11px; background: #fff;">
                                        <?php foreach ( $icon_opts as $ikey => $ilbl ) : ?>
                                            <option value="<?php echo esc_attr( $ikey ); ?>" <?php selected( $val_i, $ikey ); ?>>
                                                <?php echo esc_html( $ilbl ); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 3: KUSTOMISASI CARD ALUR & TAHAPAN REKRUTMEN (4 TAHAPAN)
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-randomize" style="font-size: 18px; width: 18px; height: 18px;"></span>
                    Pengaturan Card Alur &amp; Tahapan Rekrutmen (4 Tahapan Seleksi Resmi)
                </h2>
                <p style="margin: 4px 0 15px 0; color: #64748b; font-size: 12px;">
                    Kelola tahapan alur proses perekrutan karyawan dari pengiriman berkas hingga penawaran kerja (offering).
                </p>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Badge Section</label>
                        <input type="text" name="options_karir_stages_badge" value="<?php echo esc_attr( $stages_hdr['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Judul Utama Section</label>
                        <input type="text" name="options_karir_stages_title" value="<?php echo esc_attr( $stages_hdr['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Deskripsi Pengantar Section</label>
                    <textarea name="options_karir_stages_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 13px;"><?php echo esc_textarea( $stages_hdr['desc'] ); ?></textarea>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
                    <?php 
                    for ( $si = 0; $si < 4; $si++ ) : 
                        $stg_item  = $stages_list[$si] ?? [];
                        $stg_step  = esc_attr( $stg_item['step'] ?? sprintf( '%02d', $si + 1 ) );
                        $stg_t     = esc_attr( $stg_item['title'] ?? '' );
                        $stg_d     = esc_textarea( $stg_item['desc'] ?? '' );
                        $stg_c     = esc_attr( $stg_item['color'] ?? 'cyan' );
                    ?>
                        <div style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 10px; padding: 16px; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                                    <span style="font-size: 12px; font-weight: 800; color: #0f766e; text-transform: uppercase;">Langkah Ke-<?php echo ( $si + 1 ); ?></span>
                                </div>
                                <div style="display: grid; grid-template-columns: 60px 1fr; gap: 8px; margin-bottom: 10px;">
                                    <div>
                                        <label style="display: block; font-weight: 600; font-size: 11px; margin-bottom: 4px; color: #334155;">Nomor</label>
                                        <input type="text" name="stage_step[]" value="<?php echo $stg_step; ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 4px; font-size: 12px; font-weight: 800; text-align: center; background: #fff;" required>
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 600; font-size: 11px; margin-bottom: 4px; color: #334155;">Judul Tahap</label>
                                        <input type="text" name="stage_title[]" value="<?php echo $stg_t; ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 12px; font-weight: 700; background: #fff;" required>
                                    </div>
                                </div>
                                <div style="margin-bottom: 10px;">
                                    <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Penjelasan Tahap</label>
                                    <textarea name="stage_desc[]" rows="4" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 12px; background: #fff;"><?php echo $stg_d; ?></textarea>
                                </div>
                            </div>
                            <div style="margin-top: 6px;">
                                <label style="display: block; font-weight: 600; font-size: 11px; margin-bottom: 4px; color: #334155;">Warna Kartu &amp; Progress Bar</label>
                                <select name="stage_color[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 5px 6px; font-size: 11px; background: #fff;">
                                    <?php foreach ( $color_opts as $ckey => $cdata ) : ?>
                                        <option value="<?php echo esc_attr( $ckey ); ?>" <?php selected( $stg_c, $ckey ); ?>>
                                            <?php echo esc_html( $cdata['name'] ); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 4: KUSTOMISASI STATUS FORMASI KOSONG (0 LOWONGAN AKTIF)
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-info" style="font-size: 18px; width: 18px; height: 18px;"></span>
                    Pengaturan Centerpiece Showcase (Tampilan Saat 0 Lowongan Kerja Aktif)
                </h2>
                <p style="margin: 4px 0 15px 0; color: #64748b; font-size: 12px;">
                    Ketika bank tidak sedang membuka lowongan (daftar lowongan kosong), section ini yang akan tampil sebagai centerpiece yang berwibawa, profesional, dan menenangkan para pelamar.
                </p>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Badge Status Formasi</label>
                        <input type="text" name="options_karir_empty_badge" value="<?php echo esc_attr( $empty_state['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Judul Utama Headline</label>
                        <input type="text" name="options_karir_empty_title" value="<?php echo esc_attr( $empty_state['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Deskripsi Narasi Status Formasi</label>
                    <textarea name="options_karir_empty_desc" rows="3" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 13px;"><?php echo esc_textarea( $empty_state['desc'] ); ?></textarea>
                </div>

                <!-- 3 Subcards Inside Centerpiece -->
                <div style="margin-top: 15px; border-top: 1px dashed #cbd5e1; padding-top: 15px;">
                    <h3 style="font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 12px;">3 Kartu Penjelasan / Jaminan (Sub-Cards)</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
                        <?php 
                        for ( $ei = 0; $ei < 3; $ei++ ) : 
                            $sc_item  = $empty_state['subcards'][$ei] ?? [];
                            $sc_t     = esc_attr( $sc_item['title'] ?? '' );
                            $sc_d     = esc_textarea( $sc_item['desc'] ?? '' );
                            $sc_c     = esc_attr( $sc_item['color'] ?? 'emerald' );
                            $sc_i     = esc_attr( $sc_item['icon'] ?? 'shield' );
                        ?>
                            <div style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 10px; padding: 16px; display: flex; flex-direction: column; justify-content: space-between;">
                                <div>
                                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                                        <span style="font-size: 12px; font-weight: 800; color: #0f766e; text-transform: uppercase;">Sub-Card #<?php echo ( $ei + 1 ); ?></span>
                                    </div>
                                    <div style="margin-bottom: 10px;">
                                        <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Judul Kartu</label>
                                        <input type="text" name="empty_sc_title[]" value="<?php echo $sc_t; ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 12px; font-weight: 700; background: #fff;" required>
                                    </div>
                                    <div style="margin-bottom: 10px;">
                                        <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Deskripsi Singkat</label>
                                        <textarea name="empty_sc_desc[]" rows="3" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 12px; background: #fff;"><?php echo $sc_d; ?></textarea>
                                    </div>
                                </div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-top: 6px;">
                                    <div>
                                        <label style="display: block; font-weight: 600; font-size: 11px; margin-bottom: 4px; color: #334155;">Warna Kartu</label>
                                        <select name="empty_sc_color[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 5px 6px; font-size: 11px; background: #fff;">
                                            <?php foreach ( $color_opts as $ckey => $cdata ) : ?>
                                                <option value="<?php echo esc_attr( $ckey ); ?>" <?php selected( $sc_c, $ckey ); ?>>
                                                    <?php echo esc_html( $cdata['name'] ); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label style="display: block; font-weight: 600; font-size: 11px; margin-bottom: 4px; color: #334155;">Ikon SVG</label>
                                        <select name="empty_sc_icon[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 5px 6px; font-size: 11px; background: #fff;">
                                            <?php foreach ( $icon_opts as $ikey => $ilbl ) : ?>
                                                <option value="<?php echo esc_attr( $ikey ); ?>" <?php selected( $sc_i, $ikey ); ?>>
                                                    <?php echo esc_html( $ilbl ); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 5: PENGATURAN HEADER & PERINGATAN BEBAS BIAYA
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 8px;">
                    <span class="dashicons dashicons-welcome-widgets-menus" style="font-size: 18px; width: 18px; height: 18px;"></span>
                    Pengaturan Header Halaman &amp; Himbauan Waspada Penipuan
                </h2>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 15px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Badge Header Atas</label>
                        <input type="text" name="options_karir_badge" value="<?php echo esc_attr( $header['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Judul Utama Halaman</label>
                        <input type="text" name="options_karir_title" value="<?php echo esc_attr( $header['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Deskripsi Narasi Pengantar Karir</label>
                    <textarea name="options_karir_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 13px;"><?php echo esc_textarea( $header['desc'] ); ?></textarea>
                </div>

                <!-- Himbauan Bebas Biaya (Anti-Fraud) -->
                <div style="margin-top: 20px; padding: 18px; background: #fffbeb; border: 1px solid #fde68a; border-radius: 10px;">
                    <div style="font-weight: 700; color: #92400e; font-size: 13px; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                        <span class="dashicons dashicons-shield" style="font-size: 16px; width: 16px; height: 16px;"></span>
                        Peringatan Resmi: Seleksi Rekrutmen 100% Bebas Biaya (Anti-Fraud)
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 15px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Badge Peringatan</label>
                            <input type="text" name="options_karir_fraud_badge" value="<?php echo esc_attr( $antifraud['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Judul Kotak Peringatan</label>
                            <input type="text" name="options_karir_fraud_title" value="<?php echo esc_attr( $antifraud['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                    </div>
                    <div style="margin-top: 10px;">
                        <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #1e293b;">Teks Penjelasan Waspada Penipuan</label>
                        <textarea name="options_karir_fraud_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"><?php echo esc_textarea( $antifraud['desc'] ); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- ================================================================
                 SECTION 3: PENGATURAN CALL TO ACTION (CTA) BAWAH HALAMAN
                 ================================================================ -->
            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; margin-bottom: 15px;">
                    <h2 style="font-size: 16px; font-weight: 700; color: #0f766e; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <span class="dashicons dashicons-megaphone" style="font-size: 18px; width: 18px; height: 18px;"></span>
                        Pengaturan Banner Call to Action (CTA) Bawah Halaman
                    </h2>
                    <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 700; color: #1e293b; cursor: pointer;">
                        <input type="checkbox" name="options_karir_cta_show" value="1" <?php checked( $cta['show'] ); ?>>
                        Tampilkan Banner CTA
                    </label>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 15px;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Badge Atas CTA</label>
                        <input type="text" name="options_karir_cta_badge" value="<?php echo esc_attr( $cta['badge'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Judul Utama Banner CTA</label>
                        <input type="text" name="options_karir_cta_title" value="<?php echo esc_attr( $cta['title'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 7px 10px; font-size: 13px;">
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 5px; color: #1e293b;">Deskripsi / Paragraf Ajakan</label>
                    <textarea name="options_karir_cta_desc" rows="2" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 13px;"><?php echo esc_textarea( $cta['desc'] ); ?></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px; padding: 18px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;">
                    <!-- Tombol Utama (Button 1) -->
                    <div>
                        <div style="font-weight: 700; color: #0f766e; font-size: 13px; margin-bottom: 10px;">
                            Tombol Utama (WhatsApp Personalia / Kontak)
                        </div>
                        <div style="margin-bottom: 10px;">
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Teks Tombol</label>
                            <input type="text" name="options_karir_cta_btn1_text" value="<?php echo esc_attr( $cta['btn1_text'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">URL / Link WhatsApp</label>
                            <input type="text" name="options_karir_cta_btn1_url" value="<?php echo esc_attr( $cta['btn1_url'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                    </div>

                    <!-- Tombol Sekunder (Button 2) -->
                    <div>
                        <div style="font-weight: 700; color: #166534; font-size: 13px; margin-bottom: 10px;">
                            Tombol Sekunder (Informasi Tim &amp; Manajemen)
                        </div>
                        <div style="margin-bottom: 10px;">
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Teks Tombol</label>
                            <input type="text" name="options_karir_cta_btn2_text" value="<?php echo esc_attr( $cta['btn2_text'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">URL / Link Halaman</label>
                            <input type="text" name="options_karir_cta_btn2_url" value="<?php echo esc_attr( $cta['btn2_url'] ); ?>" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SAVE BUTTON STICKY FOOTER -->
            <div style="position: sticky; bottom: 15px; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 10px; padding: 15px 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between; z-index: 50;">
                <div style="color: #64748b; font-size: 13px;">
                    Pastikan tautan Google Form dan batas waktu lowongan telah terisi dengan benar.
                </div>
                <button type="submit" class="button button-primary" style="background: #0f766e; border-color: #0d9488; font-weight: 800; font-size: 14px; padding: 6px 30px; border-radius: 6px;">
                    Simpan Seluruh Data Karir
                </button>
            </div>

        </form>

    </div>

    <!-- INLINE JAVASCRIPT FOR DYNAMIC JOB CARDS -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('job-list-container');
        const btnAddTop = document.getElementById('btn-add-job');
        const btnAddBottom = document.getElementById('btn-add-job-bottom');

        function bindJobCard(card) {
            const inputPosisi    = card.querySelector('.job-posisi-input');
            const titleDisp      = card.querySelector('.job-title-display');
            const selectStat     = card.querySelector('.job-status-select');
            const statBadge      = card.querySelector('.job-status-badge');
            const selectDivisi   = card.querySelector('.job-divisi-select');
            const wrapCustomDiv  = card.querySelector('.job-custom-divisi-wrap');
            const inputCustomDiv = card.querySelector('.job-custom-divisi-input');
            const btnDelete      = card.querySelector('.btn-delete-job');

            if (inputPosisi && titleDisp) {
                inputPosisi.addEventListener('input', function() {
                    const val = this.value.trim() || 'Lowongan Baru';
                    titleDisp.textContent = val;
                });
            }

            if (selectStat && statBadge) {
                selectStat.addEventListener('change', function() {
                    const v = this.value;
                    if (v === 'dibuka') {
                        statBadge.textContent = '● Dibuka';
                        statBadge.style.background = '#dcfce7';
                        statBadge.style.color = '#166534';
                    } else if (v === 'segera') {
                        statBadge.textContent = '● Segera Hadir';
                        statBadge.style.background = '#fef3c7';
                        statBadge.style.color = '#92400e';
                    } else {
                        statBadge.textContent = '● Ditutup';
                        statBadge.style.background = '#fee2e2';
                        statBadge.style.color = '#991b1b';
                    }
                });
            }

            if (selectDivisi && wrapCustomDiv) {
                selectDivisi.addEventListener('change', function() {
                    if (this.value === 'custom') {
                        wrapCustomDiv.style.display = 'block';
                        if (inputCustomDiv) inputCustomDiv.focus();
                    } else {
                        wrapCustomDiv.style.display = 'none';
                    }
                });
            }

            if (btnDelete) {
                btnDelete.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin menghapus lowongan pekerjaan ini?')) {
                        card.remove();
                    }
                });
            }
        }

        // Global Event Delegation for division dropdowns
        document.addEventListener('change', function(e) {
            if (e.target && e.target.classList.contains('job-divisi-select')) {
                const card = e.target.closest('.job-card-item');
                if (card) {
                    const wrap = card.querySelector('.job-custom-divisi-wrap');
                    const inp  = card.querySelector('.job-custom-divisi-input');
                    if (wrap) {
                        if (e.target.value === 'custom') {
                            wrap.style.display = 'block';
                            if (inp) inp.focus();
                        } else {
                            wrap.style.display = 'none';
                        }
                    }
                }
            }
        });

        // Bind existing cards
        container.querySelectorAll('.job-card-item').forEach(bindJobCard);

        function addNewJobCard() {
            const count = container.querySelectorAll('.job-card-item').length;
            const newIndex = count + 1;
            const newId = 'job_' + Date.now();

            const cardHtml = `
                <div class="job-card-item" data-id="${newId}" style="background: #f8fafc; border: 1px solid #cbd5e1; border-left: 5px solid #0f766e; border-radius: 10px; padding: 20px; transition: all 0.2s;">
                    <input type="hidden" name="job_id[]" value="${newId}">

                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-weight: 800; font-size: 15px; color: #0f172a;" class="job-title-display">
                                #${newIndex} — Posisi Baru
                            </span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 11px; font-weight: 700; padding: 2px 10px; border-radius: 999px; background: #dcfce7; color: #166534;" class="job-status-badge">
                                ● Dibuka
                            </span>
                            <button type="button" class="button button-link-delete btn-delete-job" style="color: #ef4444; font-size: 12px; padding: 2px 6px;">
                                Hapus
                            </button>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 2fr 1.2fr 1.2fr; gap: 14px; margin-bottom: 12px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Nama Posisi Jabatan</label>
                            <input type="text" name="job_posisi[]" value="" class="job-posisi-input" placeholder="Contoh: Staff Operasional" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; font-weight: 600; background: #fff;" required>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Kategori Divisi</label>
                            <select name="job_divisi[]" class="job-divisi-select" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                <option value="bisnis">Bisnis &amp; Pemasaran</option>
                                <option value="operasional">Operasional &amp; Layanan</option>
                                <option value="it">Teknologi Informasi (IT)</option>
                                <option value="legal">Legal &amp; Kepatuhan</option>
                                <option value="skai">Audit Internal (SKAI)</option>
                                <option value="umum">Umum &amp; Personalia</option>
                                <option value="magang">Program Magang Mahasiswa</option>
                                <option value="custom">✏️ Kategori Kustom / Input Sendiri...</option>
                            </select>
                            <div class="job-custom-divisi-wrap" style="display: none; margin-top: 6px;">
                                <input type="text" 
                                       name="job_divisi_custom[]" 
                                       value="" 
                                       class="job-custom-divisi-input" 
                                       placeholder="Ketik nama divisi baru (misal: Treasury &amp; ALMA, CS, dll)..." 
                                       style="width: 100%; border: 1.5px solid #0d9488; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #f0fdfa; color: #0f766e; font-weight: 600;">
                                <small style="color: #64748b; font-size: 11px; display: block; margin-top: 2px;">Ketik nama kategori divisi baru sesuai kebutuhan organisasi.</small>
                            </div>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Tipe Pekerjaan</label>
                            <select name="job_tipe[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                <option value="Penuh Waktu (Full Time)">Penuh Waktu (Full Time)</option>
                                <option value="Kontrak (Contract)">Kontrak (Contract)</option>
                                <option value="Magang (Internship)">Magang (Internship)</option>
                                <option value="Paruh Waktu (Part Time)">Paruh Waktu (Part Time)</option>
                            </select>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1.3fr 1.1fr 1.2fr 1fr 0.5fr; gap: 12px; margin-bottom: 12px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Lokasi Penempatan</label>
                            <input type="text" name="job_lokasi[]" value="Kantor Pusat - Jakarta" placeholder="Contoh: Kantor Pusat - Jakarta" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Batas Waktu Lamaran</label>
                            <input type="text" name="job_deadline[]" value="" placeholder="Contoh: 31 Desember 2026" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 10px; font-size: 13px; background: #fff;">
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Aksen Warna Card</label>
                            <select name="job_color[]" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff;">
                                <option value="auto">● Otomatis (Divisi)</option>
                                <option value="emerald">Emerald Syariah &amp; Mint</option>
                                <option value="cyan">Cyber Cyan &amp; Electric Blue</option>
                                <option value="purple">Royal Violet &amp; Fuchsia</option>
                                <option value="amber">Warm Amber &amp; Gold</option>
                                <option value="teal">Teal Syariah BSW</option>
                                <option value="blue">Sapphire Ocean &amp; Sky</option>
                                <option value="rose">Rose Crimson &amp; Coral</option>
                                <option value="indigo">Indigo Night &amp; Royal</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Status Perekrutan</label>
                            <select name="job_status[]" class="job-status-select" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 8px; font-size: 13px; background: #fff; font-weight: 700;">
                                <option value="dibuka">Dibuka</option>
                                <option value="segera">Segera Hadir</option>
                                <option value="ditutup">Ditutup</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Urutan</label>
                            <input type="number" name="job_urutan[]" value="${newIndex}" min="1" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px 4px; font-size: 13px; text-align: center; background: #fff;">
                        </div>
                    </div>

                    <div style="margin-bottom: 12px; padding: 12px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px;">
                        <label style="display: block; font-weight: 700; font-size: 12px; margin-bottom: 4px; color: #166534;">
                            Tautan Pendaftaran Online (Link Google Form / Form Rekrutmen)
                        </label>
                        <input type="url" name="job_form_url[]" value="" placeholder="Tempelkan URL Google Form di sini, contoh: https://forms.gle/..." style="width: 100%; border: 1px solid #86efac; border-radius: 6px; padding: 7px 10px; font-size: 13px; font-family: monospace; background: #fff;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                Deskripsi Singkat &amp; Tanggung Jawab
                            </label>
                            <textarea name="job_ringkasan[]" rows="4" placeholder="Uraikan ringkasan tugas dan tanggung jawab..." style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"></textarea>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">
                                Kualifikasi &amp; Persyaratan (Pisahkan per baris)
                            </label>
                            <textarea name="job_kualifikasi[]" rows="4" placeholder="Pria/Wanita&#10;Pendidikan min. S1" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 8px 10px; font-size: 12px; background: #fff;"></textarea>
                        </div>
                    </div>
                </div>
            `;

            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = cardHtml.trim();
            const newEl = tempDiv.firstElementChild;
            container.appendChild(newEl);
            bindJobCard(newEl);
            newEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        if (btnAddTop) btnAddTop.addEventListener('click', addNewJobCard);
        if (btnAddBottom) btnAddBottom.addEventListener('click', addNewJobCard);
    });
    </script>
    <?php
}

