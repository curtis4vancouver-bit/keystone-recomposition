<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function astra_child_keystone_enqueue_styles() {
    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();

    // Enqueue parent Astra style
    wp_enqueue_style( 'astra-parent-theme-css', get_template_directory_uri() . '/style.css' );

    // Enqueue Child customized style (Cache busted via filemtime)
    $style_ver = file_exists( $theme_dir . '/style.css' ) ? (string) filemtime( $theme_dir . '/style.css' ) : '10.6.0';
    wp_enqueue_style( 'astra-child-keystone-css', $theme_uri . '/style.css', array( 'astra-parent-theme-css' ), $style_ver );

    // Load typography fonts (Inter, Outfit, Montserrat, JetBrains Mono)
    wp_enqueue_style( 'keystone-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;700&family=Montserrat:wght@700&family=Outfit:wght@400;600;700;800&display=swap', array(), null );

    // Enqueue Lead Consultation Form Handler JS (Cache busted via filemtime)
    $lead_js_file = $theme_dir . '/js/lead-form-handler.js';
    $lead_js_ver  = file_exists( $lead_js_file ) ? (string) filemtime( $lead_js_file ) : '1.1.0';
    wp_enqueue_script( 'keystone-lead-form-handler', $theme_uri . '/js/lead-form-handler.js', array(), $lead_js_ver, true );

    // Enqueue WebP Video Facade Engine (Cache busted via filemtime)
    $lazy_js_file = $theme_dir . '/js/lazy-player.js';
    $lazy_js_ver  = file_exists( $lazy_js_file ) ? (string) filemtime( $lazy_js_file ) : '1.1.0';
    wp_enqueue_script( 'keystone-lazy-player', $theme_uri . '/js/lazy-player.js', array(), $lazy_js_ver, true );
}
add_action( 'wp_enqueue_scripts', 'astra_child_keystone_enqueue_styles', 20 );

/**
 * 2. Early Preload Hint for Cascade-Identical Quiet Luxury Engine Stylesheet
 */
function keystone_get_luxury_engine_css_url(): string {
    $css_rel  = '/assets/css/keystone-luxury-engine.css';
    $css_file = get_stylesheet_directory() . $css_rel;
    $css_ver  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : '10.6.0';
    return add_query_arg( 'ver', $css_ver, get_stylesheet_directory_uri() . $css_rel );
}

function keystone_preload_luxury_engine_stylesheet(): void {
    $css_url = keystone_get_luxury_engine_css_url();
    echo '<link rel="preload" as="style" href="' . esc_url( $css_url ) . '" />' . "\n";
}
add_action( 'wp_head', 'keystone_preload_luxury_engine_stylesheet', 1 );

/**
 * 3. Preconnecting Web Fonts (Performance GSC optimization)
 */
function astra_child_keystone_resource_hints( $urls, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type || 'preconnect' === $relation_type ) {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = 'https://fonts.gstatic.com';
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'astra_child_keystone_resource_hints', 10, 2 );

/**
 * 3. Decharge Redundant Header Scripts (Optimizing PageSpeed score to 95+)
 */
function astra_child_keystone_clean_header() {
    // Remove emoji scripts
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    // Remove shortlink tag
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

    // Remove XML-RPC RSD link
    remove_action( 'wp_head', 'rsd_link' );

    // Remove Windows Live Writer manifest
    remove_action( 'wp_head', 'wlwmanifest_link' );
}
add_action( 'init', 'astra_child_keystone_clean_header' );

/**
 * 4. Filter script loading tags to apply modern defer attribute flags to custom scripts
 */
function astra_child_keystone_add_defer_attribute( $tag, $handle ) {
    if ( 'keystone-lazy-player' !== $handle ) {
        return $tag;
    }
    return str_replace( ' src', ' defer="defer" src', $tag );
}
add_filter( 'script_loader_tag', 'astra_child_keystone_add_defer_attribute', 10, 2 );

/**
 * 6. Minimal Critical FOUC Guard & Active Route Sync (Full CSS extracted to assets/css/keystone-luxury-engine.css)
 */
add_filter( 'jetpack_photon_skip_image', '__return_true', 9999 );
add_filter( 'jetpack_photon_override_image_downsize', '__return_true', 9999 );

function astra_child_keystone_header_overrides() {
    ?>
    <style id="keystone-header-fouc-guard">
    html, body, body.keystone-recomposition-dark-luxury {
      background-color: #04070d !important;
      color: #f8fafc !important;
      overflow-x: hidden !important;
    }
    .site-nav-header { background: #000000 !important; }
    #rank-math-analytics-stats-wrapper, #rank-math-analytic-bar, .rank-math-analytics-stats-wrapper, #wpadminbar, #zip-ai-sidebar-admin-trigger, #zip-ai-sidebar {
      display: none !important; height: 0 !important; overflow: hidden !important; visibility: hidden !important;
    }
    </style>
    <script id="keystone-header-route-sync">
    document.addEventListener('DOMContentLoaded', function() {
      var path = window.location.pathname.replace(/\/$/, '') || '/';
      var links = document.querySelectorAll('.main-header-menu a, .ast-nav-menu a');
      links.forEach(function(a) {
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
 * 7. Master Footer Content Sanitizer (Zero Overlap & Quiet Luxury Formatting)
 */
function astra_child_keystone_sanitize_footer_output( $content ) {
    // Completely suppress Astra default footer widgets in favor of Wayne's sovereign 4-column matrix
    return '';
}
add_filter( 'astra_footer_html_1_item', 'astra_child_keystone_sanitize_footer_output', 9999 );
add_filter( 'astra_footer_html_2_item', 'astra_child_keystone_sanitize_footer_output', 9999 );
add_filter( 'astra_footer_copyright_item', 'astra_child_keystone_sanitize_footer_output', 9999 );
add_filter( 'astra_get_option_footer-html-1', 'astra_child_keystone_sanitize_footer_output', 9999 );
add_filter( 'astra_get_option_footer-html-2', 'astra_child_keystone_sanitize_footer_output', 9999 );
add_filter( 'astra_get_option_footer-copyright-editor', 'astra_child_keystone_sanitize_footer_output', 9999 );
add_filter( 'astra_get_option_footer-sml-layout', 'astra_child_keystone_sanitize_footer_output', 9999 );

// Completely unhook Astra default header & footer across all pages
add_action( 'template_redirect', function() {
    remove_all_actions( 'astra_header' );
    remove_all_actions( 'astra_header_before' );
    remove_all_actions( 'astra_header_after' );
    remove_all_actions( 'astra_footer' );
    remove_all_actions( 'astra_footer_before' );
    remove_all_actions( 'astra_footer_after' );
}, 5 );

// Automatically optimize oversized 9MB+ 4096x4096 album cover images & avatar on the server so cards render instantaneously
add_action( 'init', function() {
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
 * 8. Cascade-Identical Quiet Luxury Engine Stylesheet (wp_head:10001) & Hover-Only Button Color Wave
 */
function keystone_page1_hero_and_button_wave_engine(): void {
    $css_url = keystone_get_luxury_engine_css_url();
    ?>
    <link rel="stylesheet" id="keystone-luxury-engine-css" href="<?php echo esc_url( $css_url ); ?>" media="all" />
    <script id="keystone-button-word-wave-init">
    document.addEventListener('DOMContentLoaded', function() {
      var waveSelectors = [
        '.btn-cyan-primary',
        '.btn-glass-secondary',
        '.btn-gold-subtle',
        '.btn-cyan-outline',
        '.header-protocols-cta-pill',
        '.footer-subscribe-btn',
        '#kr-bottom-streaming-vault .kr-vault-play-pill',
        '#kr-bottom-streaming-vault .kr-vault-link-pill',
        '#kr-bottom-streaming-vault .kr-vault-spotify-pill',
        '.chip-verified-badge',
        '.badge-gold-builder',
        '.badge-cyan-swarms',
        '.pillar-title-row h4',
        '.pillar-tag-pill',
        '.lab-live-badge',
        '.lab-freq-badge',
        '.graph-mode-btn',
        '.telemetry-hz',
        '.telemetry-fps',
        '#engineStateBadge',
        '.playlist-rotate-btn',
        '.playlist-count',
        '.track-hz-pill',
        '.album-stream-prompt',
        '.album-details-link',
        '.intel-read-more',
        '.intel-carousel-nav-btn',
        '.btn-cyan-express-buy',
        '.btn-cyan-buy',
        '.btn-gold-buy',
        '.btn-promo-apply',
        '#applyPromoBtn',
        '#verifyVaultUidBtn',
        '.btn-vault-unlock-pill',
        '#vaultUidStatusBadge',
        '.checkout-badge-live',
        '.badge-tier-cyan',
        '.badge-discount-gold',
        '.badge-capacity-alert',
        '.matrix-tag',
        '.competitive-matrix-card .matrix-col h4',
        '#submitAutomatedOrderBtn',
        '.ks-p3-btn-blue',
        '.ks-p3-btn-gold',
        '.ks-p3-pill-blue',
        '.ks-p3-pill-gold'
      ].join(',');
      document.querySelectorAll(waveSelectors).forEach(function(btn) {
        if (btn.querySelector('.ks-wave-text')) {
          return;
        }
        var existingSpans = btn.querySelectorAll('span');
        if (btn.querySelector('svg') && existingSpans.length > 0) {
          existingSpans.forEach(function(s) { s.classList.add('ks-wave-text'); });
          return;
        }
        var span = document.createElement('span');
        span.className = 'ks-wave-text';
        while (btn.firstChild) {
          span.appendChild(btn.firstChild);
        }
        btn.appendChild(span);
      });
    });
    </script>
    <?php
}
add_action( 'wp_head', 'keystone_page1_hero_and_button_wave_engine', 10001 );
