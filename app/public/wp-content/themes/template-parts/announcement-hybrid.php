<?php
/**
 * Template Part: Hybrid Announcement System (Beranda)
 * 1. High-Contrast Multi-Announcement Floating Toast Notification
 * 2. Emergency Modal Pop-up (Tengah Layar)
 * 
 * Optimized for Desktop and Smartphone Mobile Viewports.
 * 
 * @package Wakalumi
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$toast_settings = wakalumi_get_pengumuman_toast_settings();
$toast_items    = wakalumi_get_active_toast_pengumuman();
$popup_items    = ( ! empty( $toast_settings['popup_active'] ) ) ? wakalumi_get_active_popup_pengumuman_list() : [];
$categories     = wakalumi_get_pengumuman_categories();

$has_toast = ( ! empty( $toast_settings['toast_active'] ) && ! empty( $toast_items ) );
$has_popup = ( ! empty( $popup_items ) );

if ( ! $has_toast && ! $has_popup ) {
    return; // Tidak ada pengumuman yang aktif untuk beranda
}

$ann_page_url = home_url( '/pengumuman/' );
$slide_duration = max( 4, (int)( $toast_settings['toast_duration'] ?? 7 ) ) * 1000;
?>

<!-- ========================================================================
     1. EMERGENCY POP-UP MODAL (TENGAH LAYAR - KHUSUS PENGUMUMAN DARURAT)
     With Multi-Popup Slider & Edge-to-Edge 1:1 Aspect Ratio Photo
     ======================================================================== -->
<?php if ( $has_popup ) : 
    $total_popups = count( $popup_items );
    $popup_badge_text = ! empty( $toast_settings['popup_badge_text'] ) ? $toast_settings['popup_badge_text'] : 'Pengumuman Penting';
?>
<div id="wakalumi-emergency-popup"
     class="fixed inset-0 z-[250] hidden flex items-center justify-center p-3 sm:p-5 md:p-6 overflow-y-auto"
     role="alertdialog"
     aria-modal="true"
     aria-labelledby="emergency-popup-title"
     data-total-popups="<?php echo $total_popups; ?>">

    <!-- Dark Backdrop with Deep Blur -->
    <div id="emergency-popup-backdrop" class="fixed inset-0 bg-slate-950/85 backdrop-blur-md transition-opacity duration-300 opacity-0 cursor-pointer"></div>

    <!-- Modal Content Card (Warm Amber & Gold Prestige Styling) -->
    <div id="emergency-popup-card" 
         class="relative z-10 w-full max-w-lg md:max-w-3xl my-auto bg-gradient-to-b from-slate-900 to-slate-950 text-white rounded-3xl shadow-2xl border-2 border-amber-400/60 shadow-amber-950/50 overflow-hidden transition-all duration-300 transform scale-95 opacity-0">
        
        <!-- Ambient Corner Glow (Warm Amber) -->
        <div class="absolute -right-16 -top-16 w-52 h-52 rounded-full bg-amber-500/15 blur-3xl pointer-events-none"></div>

        <!-- POPUP SLIDER WRAPPER (CSS Grid Stack) -->
        <div id="popup-slides-wrapper" class="relative grid grid-cols-1 grid-rows-1 w-full overflow-hidden">
            <?php foreach ( $popup_items as $p_idx => $p_item ) : 
                $p_id       = esc_attr( $p_item['id'] ?? ( 'pop_' . $p_idx ) );
                $p_title    = $p_item['judul'] ?? '';
                $p_kat      = $p_item['kategori'] ?? 'umum';
                $p_cat_info = $categories[$p_kat] ?? $categories['umum'];
                $p_date     = date_i18n( 'd F Y', strtotime( $p_item['tanggal'] ?? date( 'Y-m-d' ) ) );
                $p_nomor    = $p_item['nomor_surat'] ?? '';
                $p_summary  = $p_item['ringkasan'] ?? '';
                $p_gambar   = $p_item['gambar'] ?? '';
                $p_link_act = ! empty( $p_item['link_active'] );
                $p_link_url = $p_item['link_url'] ?? '';
                $p_link_txt = ! empty( $p_item['link_text'] ) ? $p_item['link_text'] : 'Kunjungi Tautan';
                $p_link_tgt = ! empty( $p_item['link_target'] ) ? $p_item['link_target'] : '_self';
                $has_img    = ! empty( $p_gambar );
            ?>
                <div class="popup-slide-item col-start-1 row-start-1 w-full transition-all duration-300 ease-out <?php echo $p_idx === 0 ? 'is-active opacity-100 translate-x-0 visible pointer-events-auto z-10' : 'opacity-0 translate-x-6 invisible pointer-events-none z-0'; ?>"
                     style="grid-area: 1 / 1 / 2 / 2;"
                     data-popup-index="<?php echo $p_idx; ?>"
                     data-popup-id="<?php echo $p_id; ?>">

                    <div class="<?php echo $has_img ? 'grid grid-cols-1 md:grid-cols-2 items-stretch' : 'p-6 sm:p-8'; ?>">
                        
                        <?php if ( $has_img ) : ?>
                            <!-- Left / Top Column: 1:1 Aspect Ratio Photo (Zero Padding, Zero Margin, Edge-to-Edge) -->
                            <div class="relative w-full aspect-square overflow-hidden bg-slate-950 flex items-center justify-center border-b md:border-b-0 md:border-r border-white/10 group">
                                <img src="<?php echo esc_url( $p_gambar ); ?>" 
                                     alt="<?php echo esc_attr( $p_title ); ?>" 
                                     class="w-full h-full object-cover">
                                
                                <!-- Subtle Vignette Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent pointer-events-none"></div>

                                <!-- Floating Badge over image on mobile -->
                                <div class="absolute top-3 left-3 md:hidden z-10">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-900/80 backdrop-blur-md text-amber-300 border border-amber-400/40 text-[10px] font-black uppercase tracking-wider shadow-md">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span>
                                        <?php echo esc_html( $popup_badge_text ); ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Right / Main Content Column (with clean padding) -->
                        <div class="flex flex-col justify-between p-6 sm:p-7 <?php echo $has_img ? '' : 'pt-2'; ?>">
                            
                            <!-- Header Bar: Badge, Stepper & Close Button -->
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <!-- Badge (desktop or when no image) -->
                                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/40 text-xs font-black uppercase tracking-wider shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                                    <svg class="w-3.5 h-3.5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                    <span><?php echo esc_html( $popup_badge_text ); ?></span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <?php if ( $total_popups > 1 ) : ?>
                                        <!-- Multi-Popup Counter -->
                                        <span class="text-xs font-mono font-bold text-amber-300 px-2 py-0.5 rounded-md bg-white/10 border border-amber-400/30">
                                            <span class="popup-curr-num"><?php echo $p_idx + 1; ?></span>/<span><?php echo $total_popups; ?></span>
                                        </span>

                                        <!-- Prev & Next Arrows -->
                                        <button type="button" class="btn-popup-prev w-7 h-7 rounded-lg bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white flex items-center justify-center transition-colors text-sm font-bold" aria-label="Pop-up Sebelumnya" title="Sebelumnya">
                                            ‹
                                        </button>
                                        <button type="button" class="btn-popup-next w-7 h-7 rounded-lg bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white flex items-center justify-center transition-colors text-sm font-bold" aria-label="Pop-up Berikutnya" title="Berikutnya">
                                            ›
                                        </button>
                                    <?php endif; ?>

                                    <!-- Top Close ✕ (Dismiss All) -->
                                    <button type="button" class="btn-close-popup-x w-7 h-7 rounded-lg bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white flex items-center justify-center transition-colors ml-1" aria-label="Tutup Pop-up" title="Tutup">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Meta row: Date, Category, Nomor -->
                            <div class="flex items-center gap-2 text-xs text-slate-400 mb-2 font-semibold flex-wrap">
                                <span>📅 <?php echo esc_html( $p_date ); ?></span>
                                <span>•</span>
                                <span class="text-amber-400 font-bold">🏷️ <?php echo esc_html( $p_cat_info['label'] ?? 'Penting' ); ?></span>
                                <?php if ( ! empty( $p_nomor ) ) : ?>
                                    <span>•</span>
                                    <span class="font-mono text-slate-300"><?php echo esc_html( $p_nomor ); ?></span>
                                <?php endif; ?>
                            </div>

                            <!-- Title -->
                            <h3 class="text-lg sm:text-xl font-black text-white tracking-tight leading-snug mb-2.5 line-clamp-2">
                                <?php echo esc_html( $p_title ); ?>
                            </h3>

                            <!-- Summary -->
                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-4 line-clamp-4">
                                <?php echo esc_html( $p_summary ); ?>
                            </p>

                            <!-- Bottom Action Buttons (Minimalist, Single-Line & Non-Wrapping) -->
                            <div class="flex flex-col gap-2 pt-3.5 border-t border-white/10 mt-auto">
                                <div class="flex items-center gap-2">
                                    <a href="<?php echo esc_url( $ann_page_url . '#' . $p_id ); ?>"
                                       class="flex-1 py-2 px-3.5 rounded-xl bg-gradient-to-r from-amber-500 via-amber-400 to-amber-500 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-bold text-xs sm:text-sm text-center shadow-md shadow-amber-500/20 transition-all hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-1.5 whitespace-nowrap">
                                        <span>Baca Lengkap</span>
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>

                                    <?php if ( $p_link_act && ! empty( $p_link_url ) ) : ?>
                                        <a href="<?php echo esc_url( $p_link_url ); ?>"
                                           target="<?php echo esc_attr( $p_link_tgt ); ?>"
                                           <?php echo ( $p_link_tgt === '_blank' ) ? 'rel="noopener noreferrer"' : ''; ?>
                                           class="py-2 px-3 rounded-xl bg-teal-600 hover:bg-teal-500 text-white font-bold text-xs sm:text-sm text-center shadow-md shadow-teal-600/20 transition-all hover:scale-[1.01] active:scale-[0.99] flex items-center justify-center gap-1 whitespace-nowrap shrink-0">
                                            <span class="truncate max-w-[120px] sm:max-w-[140px]"><?php echo esc_html( $p_link_txt ); ?></span>
                                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    <?php endif; ?>

                                    <?php if ( ! $p_link_act || empty( $p_link_url ) ) : ?>
                                        <!-- Bottom Close Button when no extra link: compact sibling pill -->
                                        <button type="button" 
                                                class="btn-dismiss-popup-step py-2 px-3.5 rounded-xl bg-white/10 hover:bg-white/15 text-slate-300 hover:text-white font-semibold text-xs sm:text-sm text-center border border-white/10 transition-colors whitespace-nowrap shrink-0"
                                                data-step-index="<?php echo $p_idx; ?>">
                                            <?php echo ( $total_popups > 1 && $p_idx < $total_popups - 1 ) ? 'Lanjut ›' : 'Tutup'; ?>
                                        </button>
                                    <?php endif; ?>
                                </div>

                                <?php if ( $p_link_act && ! empty( $p_link_url ) ) : ?>
                                    <!-- Full-width minimalist dismiss row when extra link exists -->
                                    <button type="button" 
                                            class="btn-dismiss-popup-step w-full py-1.5 px-3 rounded-lg bg-white/5 hover:bg-white/10 text-slate-400 hover:text-slate-200 font-medium text-[11px] text-center border border-white/10 transition-colors whitespace-nowrap"
                                            data-step-index="<?php echo $p_idx; ?>">
                                        <?php echo ( $total_popups > 1 && $p_idx < $total_popups - 1 ) ? 'Lanjut ke Pengumuman Berikutnya ›' : 'Tutup Pengumuman'; ?>
                                    </button>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
<?php endif; ?>


<!-- ========================================================================
     2. FLOATING TOAST NOTIFICATION & RE-OPEN LAUNCHER (KANAN BAWAH LAYAR)
     Positioned at Bottom-Right (above Floating WhatsApp Button)
     Mobile Responsive: bottom-24 right-3 left-3 sm:left-auto sm:right-6 sm:w-[440px]
     ======================================================================== -->
<?php if ( $has_toast ) : 
    $total_slides = count( $toast_items );
?>
<!-- Floating Minimized Launcher Pill (Berada di bawah WhatsApp) -->
<button type="button"
        id="wakalumi-toast-launcher"
        class="fixed bottom-3.5 right-4 sm:bottom-4 sm:right-6 z-[190] hidden items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900/95 dark:bg-slate-900/95 text-white border border-teal-400/80 shadow-xl shadow-slate-950/40 backdrop-blur-md cursor-pointer hover:scale-105 active:scale-95 transition-all duration-300 group"
        aria-label="Buka Notifikasi Pengumuman"
        title="Buka Pengumuman Resmi">
    <span class="relative flex h-2 w-2 shrink-0">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-2 w-2 bg-teal-400"></span>
    </span>
    <svg class="w-3.5 h-3.5 text-teal-400 group-hover:text-teal-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
    </svg>
    <span class="text-[11px] font-extrabold uppercase tracking-wider text-slate-200 group-hover:text-white transition-colors">
        Pengumuman
    </span>
    <span class="text-[10px] font-mono font-bold bg-teal-500/20 text-teal-300 px-1.5 py-0.5 rounded-full border border-teal-500/40">
        <?php echo $total_slides; ?>
    </span>
</button>

<div id="wakalumi-ann-toast"
     data-duration="<?php echo esc_attr( $slide_duration ); ?>"
     class="fixed bottom-24 right-3 left-3 sm:left-auto sm:right-6 z-[200] sm:w-[440px] max-w-[calc(100vw-1.5rem)] sm:max-w-md hidden transition-all duration-500 transform translate-y-10 opacity-0"
     role="region"
     aria-label="Notifikasi Pengumuman Resmi">

    <!-- High-Contrast Spotlight Card Container -->
    <div class="relative overflow-hidden rounded-2xl sm:rounded-3xl p-5 sm:p-6 bg-gradient-to-br from-slate-900 via-slate-900 to-teal-950 text-white shadow-2xl shadow-slate-950/50 border-2 border-teal-400/50 backdrop-blur-2xl">
        
        <!-- Ambient Top Accent Gradient Strip -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-teal-400 via-cyan-400 to-teal-500"></div>

        <!-- Watermark Bank Silhouette (Very faint) -->
        <div class="absolute -right-8 -bottom-8 w-32 h-32 opacity-[0.04] pointer-events-none select-none">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/untitled4.png' ); ?>" alt="" class="w-full h-full object-contain">
        </div>

        <!-- TOAST HEADER BAR: Title, Multi Counter & Close -->
        <div class="flex items-center justify-between gap-3 pb-3 mb-3 border-b border-white/10 relative z-10">
            <!-- Left: Bell Icon & Label -->
            <div class="flex items-center gap-2">
                <div class="relative w-7 h-7 rounded-lg bg-teal-500/20 text-teal-400 flex items-center justify-center flex-shrink-0 border border-teal-500/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-teal-400 animate-ping absolute -top-0.5 -right-0.5"></span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <span class="text-xs font-black uppercase tracking-wider text-teal-300">
                    <?php echo esc_html( $toast_settings['toast_title'] ?? 'Pemberitahuan Resmi' ); ?>
                </span>
            </div>

            <!-- Right: Counter + Slider Controls + Close Button -->
            <div class="flex items-center gap-1.5">
                <?php if ( $total_slides > 1 ) : ?>
                    <!-- Slide Counter -->
                    <span class="text-[11px] font-mono font-bold text-slate-300 px-2 py-0.5 rounded-md bg-white/10">
                        <span id="toast-curr-idx">1</span>/<span id="toast-total-idx"><?php echo $total_slides; ?></span>
                    </span>

                    <!-- Nav Arrows -->
                    <button type="button" id="btn-toast-prev" class="w-6 h-6 rounded-md bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white flex items-center justify-center transition-colors text-xs font-bold" aria-label="Pengumuman Sebelumnya">
                        ‹
                    </button>
                    <button type="button" id="btn-toast-next" class="w-6 h-6 rounded-md bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white flex items-center justify-center transition-colors text-xs font-bold" aria-label="Pengumuman Berikutnya">
                        ›
                    </button>
                <?php endif; ?>

                <!-- Close / Dismiss Button -->
                <button type="button" id="btn-close-toast" class="w-6 h-6 rounded-md bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white flex items-center justify-center transition-colors ml-1" aria-label="Tutup Notifikasi">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- SLIDER ITEMS CONTAINER (CSS Grid Stack: overlap in same space, zero height jumping) -->
        <div id="toast-slides-wrapper" class="relative z-10 grid grid-cols-1 grid-rows-1 overflow-hidden transition-[height] duration-300 ease-out" style="min-height: 100px;">
            <?php foreach ( $toast_items as $s_idx => $s_item ) : 
                $s_id       = esc_attr( $s_item['id'] ?? ( 'ann_' . $s_idx ) );
                $s_judul    = $s_item['judul'] ?? '';
                $s_kategori = $s_item['kategori'] ?? 'umum';
                $s_cat_info = $categories[$s_kategori] ?? $categories['umum'];
                $s_urgent   = ( ( $s_item['urgensi'] ?? 'normal' ) === 'penting' );
                $s_summary  = $s_item['ringkasan'] ?? '';
                $s_date     = date_i18n( 'd M Y', strtotime( $s_item['tanggal'] ?? date( 'Y-m-d' ) ) );
                $s_gambar   = $s_item['gambar'] ?? '';
                $s_pdf      = $s_item['file_pdf'] ?? '';
                $s_link_act = ! empty( $s_item['link_active'] );
                $s_link_url = $s_item['link_url'] ?? '';
                $s_link_txt = ! empty( $s_item['link_text'] ) ? $s_item['link_text'] : 'Tautan';
                $s_link_tgt = ! empty( $s_item['link_target'] ) ? $s_item['link_target'] : '_self';
            ?>
                <div class="toast-slide-item col-start-1 row-start-1 w-full transition-all duration-300 ease-out <?php echo $s_idx === 0 ? 'is-active opacity-100 translate-x-0 visible pointer-events-auto z-10' : 'opacity-0 translate-x-4 invisible pointer-events-none z-0'; ?>"
                     style="grid-area: 1 / 1 / 2 / 2;"
                     data-index="<?php echo $s_idx; ?>"
                     data-id="<?php echo $s_id; ?>">

                    <div class="flex items-start gap-3.5">
                        <?php if ( ! empty( $s_gambar ) ) : ?>
                            <div class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-xl overflow-hidden shrink-0 border border-white/20 bg-slate-800 shadow-md">
                                <img src="<?php echo esc_url( $s_gambar ); ?>" alt="<?php echo esc_attr( $s_judul ); ?>" class="w-full h-full object-cover">
                            </div>
                        <?php endif; ?>

                        <div class="min-w-0 flex-1">
                            <!-- Tag Row -->
                            <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-teal-500/20 text-teal-300 border border-teal-500/30">
                                    🏷️ <?php echo esc_html( $s_cat_info['pill_label'] ?? $s_cat_info['label'] ); ?>
                                </span>
                                <?php if ( $s_urgent ) : ?>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/40 text-[10px] font-extrabold uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                        PENTING
                                    </span>
                                <?php endif; ?>
                                <span class="text-[11px] text-slate-400 font-medium">📅 <?php echo esc_html( $s_date ); ?></span>
                            </div>

                            <!-- Judul -->
                            <h4 class="text-sm sm:text-base font-bold text-white line-clamp-2 leading-snug mb-1">
                                <?php echo esc_html( $s_judul ); ?>
                            </h4>

                            <!-- Ringkasan Teks -->
                            <p class="text-xs text-slate-300 line-clamp-2 leading-relaxed">
                                <?php echo esc_html( $s_summary ); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Direct Action Link Anchor -->
                    <div class="pt-3 mt-3 border-t border-white/10 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2 flex-wrap min-w-0">
                            <a href="<?php echo esc_url( $ann_page_url . '#' . $s_id ); ?>"
                               class="inline-flex items-center gap-1.5 text-xs font-extrabold text-teal-300 hover:text-teal-200 transition-colors">
                                <span>Baca Rincian</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>

                            <?php if ( $s_link_act && ! empty( $s_link_url ) ) : ?>
                                <a href="<?php echo esc_url( $s_link_url ); ?>"
                                   target="<?php echo esc_attr( $s_link_tgt ); ?>"
                                   <?php echo ( $s_link_tgt === '_blank' ) ? 'rel="noopener noreferrer"' : ''; ?>
                                   class="inline-flex items-center gap-1 text-[11px] font-extrabold text-amber-300 hover:text-amber-200 bg-amber-500/20 hover:bg-amber-500/30 px-2 py-0.5 rounded border border-amber-500/30 transition-colors truncate max-w-[130px]">
                                    <span class="truncate"><?php echo esc_html( $s_link_txt ); ?></span>
                                    <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <?php if ( ! empty( $s_pdf ) ) : ?>
                                <span class="inline-flex items-center gap-1 text-[10px] text-teal-300 bg-teal-500/20 px-2 py-0.5 rounded border border-teal-500/30 font-semibold" title="Ada Dokumen PDF">
                                    <svg class="w-3 h-3 text-teal-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                                    PDF
                                </span>
                            <?php endif; ?>
                            <a href="<?php echo esc_url( $ann_page_url ); ?>"
                               class="text-[11px] font-bold text-slate-400 hover:text-white transition-colors">
                                Semua (<?php echo count( $toast_items ); ?>) ↗
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
<?php endif; ?>

