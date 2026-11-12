<?php
/**
 * Keystone Recomposition Sovereign v4.0 — Asset Enqueue, Cache-Busting & Critical FOUC Guard
 *
 * @package KeystoneRecompositionChild
 * @version 11.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. Enqueue Stylesheets & Scripts via Standard WordPress Dependency Graph + filemtime Cache-Busting
 */
function astra_child_keystone_enqueue_styles(): void {
    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();

    // Parent Astra base stylesheet
    wp_enqueue_style( 'astra-parent-theme-css', get_template_directory_uri() . '/style.css' );

    // Child customized style.css
    $style_rel  = '/style.css';
    $style_file = $theme_dir . $style_rel;
    $style_ver  = file_exists( $style_file ) ? (string) filemtime( $style_file ) : '11.0.0';
    wp_enqueue_style( 'astra-child-keystone-css', $theme_uri . $style_rel, array( 'astra-parent-theme-css' ), $style_ver );

    // Unified Google Fonts (Cinzel, Inter, JetBrains Mono, Montserrat, Outfit)
    wp_enqueue_style(
        'keystone-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&family=Montserrat:wght@700&family=Outfit:wght@400;500;600;700;800;900&display=swap',
        array(),
        null
    );

    // Cascade-Identical Quiet Luxury Engine Stylesheet
    $engine_rel  = '/assets/css/keystone-luxury-engine.css';
    $engine_file = $theme_dir . $engine_rel;
    $engine_ver  = file_exists( $engine_file ) ? (string) filemtime( $engine_file ) : '11.0.0';
    wp_enqueue_style( 'keystone-luxury-engine', $theme_uri . $engine_rel, array( 'astra-child-keystone-css' ), $engine_ver );

    // Sovereign v4.0 Executive Shell Stylesheet (Utility Strip, Sticky Header, Slide-Over Drawer, Footer & Lightbox)
    $shell_rel  = '/assets/css/sovereign-v4-shell.css';
    $shell_file = $theme_dir . $shell_rel;
    $last_dep   = 'keystone-luxury-engine';
    if ( file_exists( $shell_file ) ) {
        $shell_ver = (string) filemtime( $shell_file );
        wp_enqueue_style( 'keystone-sovereign-v4-shell', $theme_uri . $shell_rel, array( 'keystone-luxury-engine' ), $shell_ver );
        $last_dep = 'keystone-sovereign-v4-shell';
    }

    // Conditional Sovereign v4.0 Homepage Stylesheet
    if ( function_exists( 'is_front_page' ) && is_front_page() ) {
        $fp_rel  = '/assets/css/sovereign-v4-frontpage.css';
        $fp_file = $theme_dir . $fp_rel;
        if ( file_exists( $fp_file ) ) {
            $fp_ver = (string) filemtime( $fp_file );
            wp_enqueue_style( 'keystone-sovereign-v4-frontpage', $theme_uri . $fp_rel, array( $last_dep ), $fp_ver );
        }
    }

    // Lead Consultation Form Handler JS
    $lead_js_file = $theme_dir . '/js/lead-form-handler.js';
    $lead_js_ver  = file_exists( $lead_js_file ) ? (string) filemtime( $lead_js_file ) : '1.1.0';
    wp_enqueue_script( 'keystone-lead-form-handler', $theme_uri . '/js/lead-form-handler.js', array(), $lead_js_ver, true );

    // WebP Video Facade Engine JS
    $lazy_js_file = $theme_dir . '/js/lazy-player.js';
    $lazy_js_ver  = file_exists( $lazy_js_file ) ? (string) filemtime( $lazy_js_file ) : '1.1.0';
    wp_enqueue_script( 'keystone-lazy-player', $theme_uri . '/js/lazy-player.js', array(), $lazy_js_ver, true );
}
add_action( 'wp_enqueue_scripts', 'astra_child_keystone_enqueue_styles', 99 );

/**
 * 2. Early Preload Hints for External Luxury Engine & Sovereign v4.0 Shell Stylesheets
 */
function keystone_get_luxury_engine_css_url(): string {
    $css_rel  = '/assets/css/keystone-luxury-engine.css';
    $css_file = get_stylesheet_directory() . $css_rel;
    $css_ver  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : '11.0.0';
    return add_query_arg( 'ver', $css_ver, get_stylesheet_directory_uri() . $css_rel );
}

function keystone_preload_luxury_engine_stylesheet(): void {
    $engine_url = keystone_get_luxury_engine_css_url();
    echo '<link rel="preload" as="style" href="' . esc_url( $engine_url ) . '" />' . "\n";

    $shell_rel  = '/assets/css/sovereign-v4-shell.css';
    $shell_file = get_stylesheet_directory() . $shell_rel;
    if ( file_exists( $shell_file ) ) {
        $shell_url = add_query_arg( 'ver', (string) filemtime( $shell_file ), get_stylesheet_directory_uri() . $shell_rel );
        echo '<link rel="preload" as="style" href="' . esc_url( $shell_url ) . '" />' . "\n";
    }
}
add_action( 'wp_head', 'keystone_preload_luxury_engine_stylesheet', 1 );

/**
 * 3. Preconnect Web Fonts & Clean Redundant WP Head Bloat
 */
function astra_child_keystone_resource_hints( $urls, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type || 'preconnect' === $relation_type ) {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = 'https://fonts.gstatic.com';
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'astra_child_keystone_resource_hints', 10, 2 );

function astra_child_keystone_clean_header(): void {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
}
add_action( 'init', 'astra_child_keystone_clean_header' );

function astra_child_keystone_add_defer_attribute( $tag, $handle ) {
    if ( 'keystone-lazy-player' !== $handle ) {
        return $tag;
    }
    return str_replace( ' src', ' defer="defer" src', $tag );
}
add_filter( 'script_loader_tag', 'astra_child_keystone_add_defer_attribute', 10, 2 );

add_filter( 'jetpack_photon_skip_image', '__return_true', 9999 );
add_filter( 'jetpack_photon_override_image_downsize', '__return_true', 9999 );

/**
 * 4. Tight Critical Inline FOUC Guard (<2KB) — Guarantees Zero Unstyled Logo/List/Drawer/RankMath Flash
 */
function astra_child_keystone_header_overrides(): void {
    ?>
    <style id="keystone-header-fouc-guard">
    html,body,body.keystone-recomposition-dark-luxury{background-color:#04070d!important;color:#f8fafc!important;margin:0;padding:0;overflow-x:clip!important}
    .kr-skip-link{position:absolute;left:-9999px;top:10px;z-index:100050}.kr-skip-link:focus{left:16px}
    .kr-utility-bar{background:#000000;border-bottom:1px solid rgba(56,189,248,0.22);font-size:0.72rem}
    .kr-utility-inner{max-width:1420px;margin:0 auto;padding:4px 20px;display:flex;align-items:center;justify-content:space-between;gap:12px}
    .kr-utility-left,.kr-utility-right{display:flex;align-items:center;gap:8px}.kr-utility-pill .kr-util-label-short{display:none}
    .site-nav-header{position:sticky;top:0;z-index:10000;background:#000000!important;border-bottom:1px solid rgba(212,175,55,0.26)}
    .site-nav-header .nav-container{max-width:1420px;margin:0 auto;padding:0 20px;min-height:68px;display:flex;align-items:center;justify-content:space-between;gap:14px}
    .brand-edge-logo{display:inline-flex;align-items:center;gap:11px;text-decoration:none;flex-shrink:0}
    .kp-badge-mark{width:44px;height:44px;border-radius:10px;overflow:hidden;flex-shrink:0;display:flex;align-items:center;justify-content:center}
    .kp-badge-img{width:44px;height:44px;max-width:44px;max-height:44px;object-fit:contain;display:block}
    .nav-links-menu{display:flex;align-items:center;gap:6px;list-style:none;margin:0;padding:0}
    .nav-right-actions{display:flex;align-items:center;gap:8px;flex-shrink:0}.mobile-hamburger{display:none}
    #mobileDrawer:not(.active),.kr-drawer-backdrop:not(.active),#krLightboxModal:not(.is-open){display:none!important}
    #kr-master-luxury-footer{background-color:#000000!important;background:#000000!important}
    #rank-math-analytics-stats-wrapper,#rank-math-analytics-stats-bar,.rank-math-analytics-stats-wrapper,.rank-math-analytics-stats-bar,.rank-math-skeleton,#rank-math-analytic-bar,#wpadminbar,#zip-ai-sidebar-admin-trigger,#zip-ai-sidebar{display:none!important;height:0!important;max-height:0!important;overflow:hidden!important;visibility:hidden!important;opacity:0!important;pointer-events:none!important}
    @media(max-width:1180px){.site-nav-header nav,.nav-links-menu{display:none!important}.mobile-hamburger,#kpMobileNavToggle{display:inline-flex!important}}
    </style>
    <script id="keystone-header-route-sync">
    document.addEventListener('DOMContentLoaded', function() {
      var path = window.location.pathname.replace(/\/$/, '') || '/';
      document.querySelectorAll('.main-header-menu a, .ast-nav-menu a').forEach(function(a) {
        try {
          var aPath = new URL(a.href, window.location.origin).pathname.replace(/\/$/, '') || '/';
          if (aPath === path) {
            a.classList.add('keystone-active-nav');
            if (a.parentElement) a.parentElement.classList.add('current-menu-item');
          } else if (path !== '/' && aPath === '/') {
            a.classList.remove('keystone-active-nav');
            if (a.parentElement) a.parentElement.classList.remove('current-menu-item', 'current_page_item');
          }
        } catch (e) {}
      });
    });
    </script>
    <?php
}
add_action( 'wp_head', 'astra_child_keystone_header_overrides', 9999 );

/**
 * 5. Suppress Default Astra Header & Footer Chrome Across All Sovereign Views
 */
function astra_child_keystone_sanitize_footer_output( $content ): string {
    return '';
}
add_filter( 'astra_footer_html_1_item', 'astra_child_keystone_sanitize_footer_output', 9999 );
add_filter( 'astra_footer_html_2_item', 'astra_child_keystone_sanitize_footer_output', 9999 );
add_filter( 'astra_footer_copyright_item', 'astra_child_keystone_sanitize_footer_output', 9999 );
add_filter( 'astra_get_option_footer-html-1', 'astra_child_keystone_sanitize_footer_output', 9999 );
add_filter( 'astra_get_option_footer-html-2', 'astra_child_keystone_sanitize_footer_output', 9999 );
add_filter( 'astra_get_option_footer-copyright-editor', 'astra_child_keystone_sanitize_footer_output', 9999 );
add_filter( 'astra_get_option_footer-sml-layout', 'astra_child_keystone_sanitize_footer_output', 9999 );

add_action( 'template_redirect', function(): void {
    remove_all_actions( 'astra_header' );
    remove_all_actions( 'astra_header_before' );
    remove_all_actions( 'astra_header_after' );
    remove_all_actions( 'astra_footer' );
    remove_all_actions( 'astra_footer_before' );
    remove_all_actions( 'astra_footer_after' );
}, 5 );

/**
 * 6. Server-Side Oversized Cover Image Compression Guard
 */
add_action( 'init', function(): void {
    $theme_dir = get_stylesheet_directory();
    $probe     = $theme_dir . '/assets/images/albums/sovereign_reverb.jpg';
    if ( file_exists( $probe ) && filesize( $probe ) < 500000 ) {
        return;
    }
    $avatar = $theme_dir . '/assets/images/wayne_avatar.jpg';
    if ( file_exists( $avatar ) && filesize( $avatar ) > 150000 ) {
        $ed = wp_get_image_editor( $avatar );
        if ( ! is_wp_error( $ed ) ) {
            $ed->resize( 640, 360, false );
            $ed->set_quality( 90 );
            $ed->save( $avatar );
        }
    }
    $banner = $theme_dir . '/assets/images/sonic_universe_banner.png';
    if ( file_exists( $banner ) && filesize( $banner ) > 900000 ) {
        $ed = wp_get_image_editor( $banner );
        if ( ! is_wp_error( $ed ) ) {
            $ed->resize( 1280, 720, false );
            $ed->set_quality( 88 );
            $ed->save( $banner );
        }
    }
    $album_files = glob( $theme_dir . '/assets/images/albums/*.{jpg,png}', GLOB_BRACE );
    if ( is_array( $album_files ) ) {
        foreach ( $album_files as $file ) {
            if ( filesize( $file ) > 450000 ) {
                $ed = wp_get_image_editor( $file );
                if ( ! is_wp_error( $ed ) ) {
                    $ed->resize( 760, 760, true );
                    $ed->set_quality( 86 );
                    $ed->save( $file );
                }
            }
        }
    }
}, 20 );

/**
 * 7. Hover-Only Button Color Wave Initializer
 */
function keystone_page1_hero_and_button_wave_engine(): void {
    ?>
    <script id="keystone-button-word-wave-init">
    document.addEventListener('DOMContentLoaded', function() {
      var waveSelectors = [
        '.btn-cyan-primary', '.btn-glass-secondary', '.btn-gold-subtle', '.btn-cyan-outline',
        '.header-protocols-cta-pill', '.footer-subscribe-btn',
        '#kr-bottom-streaming-vault .kr-vault-play-pill', '#kr-bottom-streaming-vault .kr-vault-link-pill',
        '#kr-bottom-streaming-vault .kr-vault-spotify-pill', '.chip-verified-badge',
        '.badge-gold-builder', '.badge-cyan-swarms', '.pillar-title-row h4', '.pillar-tag-pill',
        '.lab-live-badge', '.lab-freq-badge', '.graph-mode-btn', '.telemetry-hz', '.telemetry-fps',
        '#engineStateBadge', '.playlist-rotate-btn', '.playlist-count', '.track-hz-pill',
        '.album-stream-prompt', '.album-details-link', '.intel-read-more', '.intel-carousel-nav-btn',
        '.btn-cyan-express-buy', '.btn-cyan-buy', '.btn-gold-buy', '.btn-promo-apply',
        '#applyPromoBtn', '#verifyVaultUidBtn', '.btn-vault-unlock-pill', '#vaultUidStatusBadge',
        '.checkout-badge-live', '.badge-tier-cyan', '.badge-discount-gold', '.badge-capacity-alert',
        '.matrix-tag', '.competitive-matrix-card .matrix-col h4', '#submitAutomatedOrderBtn',
        '.ks-p3-btn-blue', '.ks-p3-btn-gold', '.ks-p3-pill-blue', '.ks-p3-pill-gold'
      ].join(',');
      document.querySelectorAll(waveSelectors).forEach(function(btn) {
        if (btn.querySelector('.ks-wave-text')) return;
        var existingSpans = btn.querySelectorAll('span');
        if (btn.querySelector('svg') && existingSpans.length > 0) {
          existingSpans.forEach(function(s) { s.classList.add('ks-wave-text'); });
          return;
        }
        var span = document.createElement('span');
        span.className = 'ks-wave-text';
        while (btn.firstChild) { span.appendChild(btn.firstChild); }
        btn.appendChild(span);
      });
    });
    </script>
    <?php
}
add_action( 'wp_head', 'keystone_page1_hero_and_button_wave_engine', 10001 );
