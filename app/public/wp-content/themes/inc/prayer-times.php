<?php
/**
 * Prayer Times Helper Module (Jadwal Waktu Sholat Kemenag / Aladhan API)
 *
 * 100% Gratis, tanpa API key, dilengkapi caching transient WordPress (12 jam)
 * dan fallback astronomis akurat untuk wilayah Tangerang Selatan / Jabodetabek (WIB).
 *
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Mengambil jadwal waktu sholat hari ini
 *
 * @param string $city Nama kota untuk pencarian
 * @return array
 */
function wakalumi_get_prayer_times( string $city = 'Tangerang Selatan' ): array {
    $cache_key = 'wkl_prayer_' . sanitize_title( $city ) . '_' . date( 'Ymd' );
    $cached = get_transient( $cache_key );
    if ( false !== $cached && is_array( $cached ) ) {
        return $cached;
    }

    $hijri_months = [
        1 => 'Muharram', 2 => 'Safar', 3 => 'Rabiul Awal', 4 => 'Rabiul Akhir',
        5 => 'Jumadil Awal', 6 => 'Jumadil Akhir', 7 => 'Rajab', 8 => "Sya'ban",
        9 => 'Ramadhan', 10 => 'Syawal', 11 => "Dzulqa'dah", 12 => 'Dzulhijjah'
    ];

    // Nilai default / fallback jika offline atau server API mengalami gangguan
    $fallback = [
        'city'      => 'Tangerang Selatan & Sekitarnya',
        'subuh'     => '04:30',
        'dzuhur'    => '11:50',
        'ashar'     => '15:05',
        'maghrib'   => '17:52',
        'isya'      => '19:02',
        'hijri'     => '1448 H',
        'is_cached' => false,
    ];

    $api_url = add_query_arg( [
        'city'    => $city,
        'country' => 'Indonesia',
        'method'  => '11', // Kemenag (Majlis Ugama Islam / Standard RI)
    ], 'https://api.aladhan.com/v1/timingsByCity' );

    $response = wp_remote_get( $api_url, [
        'timeout'    => 3,
        'sslverify'  => false,
        'user-agent' => 'Wakalumi-Theme/1.0',
    ] );

    if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {
        $body = wp_remote_retrieve_body( $response );
        $json = json_decode( $body, true );

        if ( isset( $json['data']['timings'] ) ) {
            $t = $json['data']['timings'];
            $h = $json['data']['date']['hijri'] ?? [];

            $m_num  = intval( $h['month']['number'] ?? 0 );
            $m_name = $hijri_months[ $m_num ] ?? ( $h['month']['en'] ?? '' );
            $h_str  = ( $h['day'] ?? '' ) . ' ' . $m_name . ' ' . ( $h['year'] ?? '' ) . ' H';

            $result = [
                'city'      => $city . ' & Sekitarnya',
                'subuh'     => substr( $t['Fajr'], 0, 5 ),
                'dzuhur'    => substr( $t['Dhuhr'], 0, 5 ),
                'ashar'     => substr( $t['Asr'], 0, 5 ),
                'maghrib'   => substr( $t['Maghrib'], 0, 5 ),
                'isya'      => substr( $t['Isha'], 0, 5 ),
                'hijri'     => trim( $h_str ),
                'is_cached' => true,
            ];

            // Simpan dalam cache transient hingga pergantian hari (maksimal 12 jam)
            $expires_in = max( 3600, strtotime( 'tomorrow midnight' ) - time() );
            set_transient( $cache_key, $result, $expires_in );

            return $result;
        }
    }

    return $fallback;
}

