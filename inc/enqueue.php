<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function astra_child_keystone_enqueue_styles() {
    // Enqueue parent Astra style
    wp_enqueue_style( 'astra-parent-theme-css', get_template_directory_uri() . '/style.css' );
    
    // Enqueue Child customized style (Cache busted via filemtime)
    $style_ver = file_exists( get_stylesheet_directory() . '/style.css' ) ? (string) filemtime( get_stylesheet_directory() . '/style.css' ) : '10.5.0';
    wp_enqueue_style( 'astra-child-keystone-css', get_stylesheet_directory_uri() . '/style.css', array( 'astra-parent-theme-css' ), $style_ver );
    
    // Load typography fonts (Inter, Outfit, Montserrat, JetBrains Mono)
    wp_enqueue_style( 'keystone-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;700&family=Montserrat:wght@700&family=Outfit:wght@400;600;700;800&display=swap', array(), null );

    // Enqueue Lead Consultation Form Handler JS
    wp_enqueue_script( 'keystone-lead-form-handler', get_stylesheet_directory_uri() . '/js/lead-form-handler.js', array(), '1.0.0', true );

    // Enqueue WebP Video Facade Engine
    wp_enqueue_script( 'keystone-lazy-player', get_stylesheet_directory_uri() . '/js/lazy-player.js', array(), '1.1.0', true );
}
add_action( 'wp_enqueue_scripts', 'astra_child_keystone_enqueue_styles', 20 );

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
 * 6. High-Priority Header & Sovereign v10.5 Overrides (Zero Collision, Single-Post Full Width, Vault & Token Lock)
 */
add_filter( 'jetpack_photon_skip_image', '__return_true', 9999 );
add_filter( 'jetpack_photon_override_image_downsize', '__return_true', 9999 );

function astra_child_keystone_header_overrides() {
    ?>
    <style id="keystone-header-social-lock">
    /* 0. Suppress Admin/RankMath overlay bars on frontend viewports & prevent horizontal overflow */
    #rank-math-analytics-stats-wrapper,
    #rank-math-analytic-bar,
    .rank-math-analytics-stats-wrapper,
    #wpadminbar,
    #zip-ai-sidebar-admin-trigger,
    #zip-ai-sidebar {
      display: none !important;
      height: 0 !important;
      overflow: hidden !important;
      visibility: hidden !important;
    }
    html,
    html.wp-toolbar {
      margin-top: 0 !important;
      padding-top: 0 !important;
      overflow-x: hidden !important;
    }
    body,
    body.admin-bar {
      background-color: #04070d !important;
      color: #f8fafc !important;
      margin-top: 0 !important;
      padding-top: 0 !important;
      overflow-x: hidden !important;
      padding-bottom: 76px !important;
    }

    /* Hero section vertical cadence so all 3 CTA pills sit cleanly above the bottom streaming vault at y=0 */
    .cyber-hero-section {
      padding-top: 38px !important;
      padding-bottom: 72px !important;
      min-height: auto !important;
    }
    .cyber-hero-wrap .cyber-telemetry-pill {
      margin-bottom: 14px !important;
    }
    .cyber-hero-wrap .cyber-founder-chip {
      margin-bottom: 18px !important;
    }
    .cyber-hero-wrap .founder-chip-avatar {
      width: 48px !important;
      height: 48px !important;
      min-width: 48px !important;
      min-height: 48px !important;
      border-radius: 50% !important;
      object-fit: cover !important;
      border: 2px solid #d4af37 !important;
      display: block !important;
    }
    .cyber-hero-wrap .cyber-hero-title {
      margin-bottom: 16px !important;
      font-size: clamp(2.05rem, 3.1vw, 2.85rem) !important;
      line-height: 1.16 !important;
    }
    .cyber-hero-wrap .cyber-hero-subtitle {
      margin-bottom: 22px !important;
    }

    /* 1. Header Navigation Non-Collision Flex Layout */
    .site-nav-header .nav-container {
      max-width: 1440px !important;
      padding: 0 24px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 16px !important;
    }
    @media (min-width: 1101px) {
      .site-nav-header nav {
        position: static !important;
        left: auto !important;
        transform: none !important;
        flex: 1 1 auto !important;
        display: flex !important;
        justify-content: center !important;
      }
    }
    @media (max-width: 1100px) {
      .site-nav-header nav,
      .site-nav-header .nav-links-menu {
        display: none !important;
      }
      .site-nav-header .mobile-hamburger,
      #kpMobileNavToggle {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
      }
    }
    .site-nav-header .nav-menu,
    .site-nav-header .nav-links-menu {
      gap: 18px !important;
      flex-wrap: nowrap !important;
    }
    .site-nav-header .nav-link-intel-highlight {
      color: #38bdf8 !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
      background: rgba(56, 189, 248, 0.08) !important;
      border: 1px solid rgba(56, 189, 248, 0.32) !important;
      border-radius: 9999px !important;
      padding: 4px 11px !important;
      font-weight: 800 !important;
      box-shadow: 0 0 12px rgba(56, 189, 248, 0.18) !important;
    }
    .site-nav-header .nav-link-intel-highlight:hover,
    .site-nav-header .nav-link-intel-highlight.active {
      background: rgba(56, 189, 248, 0.18) !important;
      border-color: #38bdf8 !important;
      color: #ffffff !important;
      box-shadow: 0 0 16px rgba(56, 189, 248, 0.45) !important;
    }
    .site-nav-header .nav-live-dot {
      width: 6px !important;
      height: 6px !important;
      border-radius: 50% !important;
      background: #38bdf8 !important;
      box-shadow: 0 0 8px #38bdf8 !important;
      display: inline-block !important;
      flex-shrink: 0 !important;
    }
    .site-nav-header .nav-right-actions {
      gap: 9px !important;
    }
    .site-nav-header .brand-text {
      font-size: 15.5px !important;
      letter-spacing: 0.07em !important;
      white-space: nowrap !important;
    }
    .site-nav-header .brand-sub {
      white-space: nowrap !important;
    }

    /* 2. Header Social Icons: High-Specificity Luminous Baby Blue (#38bdf8) & Sovereign Gold (#d4af37) */
    .ast-desktop-header .site-header-primary-section-right,
    .ast-desktop-header .site-header-primary-section-right .ast-builder-layout-element,
    .ast-desktop-header .ast-header-social-1-wrap,
    .ast-desktop-header .header-social-inner-wrap,
    .ast-desktop-header .header-social-inner-wrap.element-social-inner-wrap,
    .ast-desktop-header .header-social-inner-wrap.ast-social-color-type-custom,
    .ast-desktop-header .ast-social-color-type-custom {
      display: inline-flex !important;
      flex-direction: row !important;
      flex-wrap: nowrap !important;
      align-items: center !important;
      justify-content: flex-end !important;
      gap: 12px !important;
      width: auto !important;
      min-width: 120px !important;
    }
    .ast-desktop-header .header-social-inner-wrap a.header-social-item,
    .ast-desktop-header .ast-builder-social-element {
      display: inline-flex !important;
      margin: 0 !important;
      padding: 4px !important;
      vertical-align: middle !important;
    }
    .ast-desktop-header .header-social-inner-wrap svg,
    .ast-desktop-header .header-social-inner-wrap svg path,
    .ast-desktop-header .ast-header-social-1-wrap svg,
    .ast-desktop-header .ast-header-social-1-wrap svg path,
    .ast-desktop-header .ast-social-color-type-custom svg,
    .ast-desktop-header .ast-social-color-type-custom svg path,
    .ast-header-social-1 svg,
    .ast-header-social-1 svg path,
    .header-social-inner-wrap svg,
    .header-social-inner-wrap svg path {
      width: 18px !important;
      height: 18px !important;
      fill: #38bdf8 !important;
      color: #38bdf8 !important;
      transition: fill 0.2s ease, filter 0.2s ease !important;
      filter: drop-shadow(0 0 5px rgba(56, 189, 248, 0.6)) !important;
    }
    .ast-desktop-header .header-social-inner-wrap a:hover svg,
    .ast-desktop-header .header-social-inner-wrap a:hover svg path,
    .ast-desktop-header .ast-social-color-type-custom a:hover svg,
    .ast-desktop-header .ast-social-color-type-custom a:hover svg path,
    .ast-header-social-1 a:hover svg,
    .ast-header-social-1 a:hover svg path {
      fill: #d4af37 !important;
      color: #d4af37 !important;
      filter: drop-shadow(0 0 10px rgba(212, 175, 55, 0.9)) !important;
    }

    /* 3. Header Navigation Links: White Base + Luminous Baby Blue Active/Hover */
    .main-header-menu .menu-item a,
    .main-header-menu .menu-link,
    .ast-nav-menu a {
      color: #f8fafc !important;
      font-weight: 600 !important;
      letter-spacing: 0.03em !important;
      position: relative !important;
      transition: all 0.2s ease !important;
    }
    .main-header-menu .menu-item:hover > a,
    .main-header-menu .menu-item:hover > .menu-link,
    .ast-nav-menu a:hover {
      color: #38bdf8 !important;
      text-shadow: 0 0 10px rgba(56, 189, 248, 0.6) !important;
    }
    .main-header-menu .current-menu-item > a,
    .main-header-menu .current_page_item > a,
    .main-header-menu a[aria-current="page"],
    .main-header-menu a.keystone-active-nav,
    .ast-nav-menu a.keystone-active-nav {
      color: #38bdf8 !important;
      text-shadow: 0 0 12px rgba(56, 189, 248, 0.8), 0 0 24px rgba(56, 189, 248, 0.4) !important;
      font-weight: 700 !important;
    }
    .main-header-menu .current-menu-item > a::after,
    .main-header-menu .current_page_item > a::after,
    .main-header-menu a[aria-current="page"]::after,
    .main-header-menu a.keystone-active-nav::after,
    .ast-nav-menu a.keystone-active-nav::after {
      content: '' !important;
      position: absolute !important;
      bottom: -4px !important;
      left: 8px !important;
      right: 8px !important;
      height: 2px !important;
      background: #38bdf8 !important;
      box-shadow: 0 0 8px #38bdf8 !important;
      border-radius: 2px !important;
    }

    /* 4. Bio-Acoustic Synthesizer Visualizer HUD Non-Overlap */
    .visualizer-wrapper.compact-visualizer {
      height: auto !important;
      min-height: 215px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      overflow: hidden !important;
      border-radius: 16px !important;
      border: 1px solid rgba(56, 189, 248, 0.32) !important;
      background: #04070d !important;
    }
    #cyberVisualizer {
      width: 100% !important;
      height: 155px !important;
      display: block !important;
    }
    .visualizer-hud-overlay {
      position: relative !important;
      bottom: auto !important;
      left: auto !important;
      right: auto !important;
      padding: 12px 16px !important;
      background: rgba(4, 7, 13, 0.96) !important;
      border-top: 1px solid rgba(56, 189, 248, 0.25) !important;
      display: flex !important;
      justify-content: space-between !important;
      align-items: center !important;
      gap: 12px !important;
      flex-wrap: wrap !important;
    }

    /* 5. Sonic Universe Hero Centering & Token Alignment */
    .sonic-header,
    .sonic-header.text-center {
      text-align: center !important;
      display: flex !important;
      flex-direction: column !important;
      align-items: center !important;
      justify-content: center !important;
      margin: 0 auto 36px auto !important;
    }
    .sonic-hero-title {
      text-align: center !important;
      margin-left: auto !important;
      margin-right: auto !important;
    }
    .sonic-header .page-subtitle {
      text-align: center !important;
      margin-left: auto !important;
      margin-right: auto !important;
      max-width: 780px !important;
    }
    .header-dsp-links {
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
      flex-wrap: wrap !important;
      gap: 14px !important;
      margin-top: 22px !important;
    }
    .dsp-pill.youtube-subscribe {
      background: linear-gradient(135deg, rgba(212, 175, 55, 0.22), rgba(4, 7, 13, 0.95)) !important;
      border: 1.5px solid #d4af37 !important;
      color: #f8fafc !important;
      border-radius: 9999px !important;
      box-shadow: 0 4px 18px rgba(212, 175, 55, 0.25) !important;
    }
    .music-badge-pill,
    .lab-live-badge,
    .chip-verified-badge,
    .engine-active {
      background: rgba(56, 189, 248, 0.14) !important;
      border: 1px solid rgba(56, 189, 248, 0.45) !important;
      color: #38bdf8 !important;
      border-radius: 9999px !important;
    }

    /* 6. Single Blog Post Full-Width 1140px Obsidian Container & Gutenberg Luxury AST */
    body.single-post,
    body.single-post #page,
    body.single-post #content,
    body.single-post .site-content,
    body.single-post #primary,
    body.single-post #main {
      background: #04070d !important;
      color: #f8fafc !important;
    }
    body.single-post .ast-container {
      max-width: 1180px !important;
      width: 100% !important;
      margin: 0 auto !important;
      padding: 32px 24px 60px 24px !important;
      display: block !important;
    }
    body.single-post #primary {
      width: 100% !important;
      max-width: 1140px !important;
      margin: 0 auto !important;
      float: none !important;
    }
    body.single-post #secondary,
    body.single-post .widget-area {
      display: none !important;
    }
    body.single-post article.luxury-article-entry,
    body.single-post .ast-article-single {
      background: rgba(8, 12, 22, 0.94) !important;
      border: 1px solid rgba(212, 175, 55, 0.24) !important;
      border-radius: 22px !important;
      padding: 38px 34px !important;
      box-shadow: 0 24px 60px rgba(0, 0, 0, 0.85), 0 0 30px rgba(56, 189, 248, 0.08) !important;
      max-width: 1140px !important;
      margin: 0 auto !important;
    }

    /* 7. Sovereign v10.5 Persistent Bottom Streaming Vault */
    #kr-bottom-streaming-vault {
      position: fixed !important;
      bottom: 14px !important;
      left: 50% !important;
      transform: translateX(-50%) !important;
      z-index: 9990 !important;
      max-width: 980px !important;
      width: calc(100% - 32px) !important;
      background: rgba(4, 7, 13, 0.94) !important;
      border: 1px solid rgba(212, 175, 55, 0.42) !important;
      box-shadow: 0 14px 40px rgba(0, 0, 0, 0.9), 0 0 22px rgba(56, 189, 248, 0.18) !important;
      border-radius: 9999px !important;
      padding: 8px 20px !important;
      backdrop-filter: blur(16px) !important;
      -webkit-backdrop-filter: blur(16px) !important;
    }
    #kr-bottom-streaming-vault .kr-vault-inner {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 14px !important;
      flex-wrap: nowrap !important;
    }
    #kr-bottom-streaming-vault .kr-vault-brand {
      display: inline-flex !important;
      align-items: center !important;
      gap: 8px !important;
      white-space: nowrap !important;
    }
    #kr-bottom-streaming-vault .kr-vault-pulse {
      width: 8px !important;
      height: 8px !important;
      border-radius: 50% !important;
      background: #38bdf8 !important;
      box-shadow: 0 0 10px #38bdf8 !important;
      display: inline-block !important;
    }
    #kr-bottom-streaming-vault .kr-vault-tag {
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.68rem !important;
      font-weight: 800 !important;
      color: #d4af37 !important;
      letter-spacing: 0.08em !important;
    }
    #kr-bottom-streaming-vault .kr-vault-controls {
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
    }
    #kr-bottom-streaming-vault .kr-vault-icon-btn {
      background: rgba(15, 23, 42, 0.9) !important;
      border: 1px solid rgba(56, 189, 248, 0.35) !important;
      color: #38bdf8 !important;
      width: 30px !important;
      height: 30px !important;
      border-radius: 50% !important;
      font-size: 0.65rem !important;
      cursor: pointer !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      padding: 0 !important;
    }
    #kr-bottom-streaming-vault .kr-vault-play-pill {
      background: linear-gradient(135deg, #d4af37 0%, #f3e5ab 50%, #aa8010 100%) !important;
      color: #04070d !important;
      border: none !important;
      border-radius: 9999px !important;
      padding: 6px 14px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.72rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.06em !important;
      cursor: pointer !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
      white-space: nowrap !important;
      box-shadow: 0 0 14px rgba(212, 175, 55, 0.35) !important;
    }
    #kr-bottom-streaming-vault .kr-vault-track-readout {
      display: flex !important;
      flex-direction: column !important;
      min-width: 0 !important;
      flex: 1 1 auto !important;
      overflow: hidden !important;
    }
    #kr-bottom-streaming-vault .kr-vault-track-title {
      color: #f8fafc !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.80rem !important;
      font-weight: 800 !important;
      white-space: nowrap !important;
      overflow: hidden !important;
      text-overflow: ellipsis !important;
    }
    #kr-bottom-streaming-vault .kr-vault-track-sub {
      color: #38bdf8 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.66rem !important;
      white-space: nowrap !important;
      overflow: hidden !important;
      text-overflow: ellipsis !important;
    }
    #kr-bottom-streaming-vault .kr-vault-actions {
      display: inline-flex !important;
      align-items: center !important;
      gap: 8px !important;
      white-space: nowrap !important;
    }
    #kr-bottom-streaming-vault .kr-vault-link-pill,
    #kr-bottom-streaming-vault .kr-vault-spotify-pill {
      background: rgba(56, 189, 248, 0.12) !important;
      border: 1px solid rgba(56, 189, 248, 0.4) !important;
      color: #38bdf8 !important;
      border-radius: 9999px !important;
      padding: 5px 12px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.72rem !important;
      font-weight: 700 !important;
      text-decoration: none !important;
    }
    #kr-bottom-streaming-vault .kr-vault-spotify-pill {
      border-color: rgba(212, 175, 55, 0.45) !important;
      color: #d4af37 !important;
      background: rgba(212, 175, 55, 0.1) !important;
    }
    #kr-bottom-streaming-vault .kr-vault-min-btn {
      width: 32px !important;
      height: 32px !important;
      border-radius: 50% !important;
      background: rgba(15, 23, 42, 0.9) !important;
      border: 1px solid rgba(56, 189, 248, 0.35) !important;
      color: #38bdf8 !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      cursor: pointer !important;
      flex-shrink: 0 !important;
    }
    #kr-bottom-streaming-vault.is-minimized {
      padding: 6px 14px !important;
    }
    #kr-bottom-streaming-vault.is-minimized .kr-vault-brand,
    #kr-bottom-streaming-vault.is-minimized .kr-vault-track-sub,
    #kr-bottom-streaming-vault.is-minimized .kr-vault-actions {
      display: none !important;
    }
    @media (max-width: 768px) {
      #kr-bottom-streaming-vault {
        padding: 8px 10px !important;
      }
      #kr-bottom-streaming-vault .kr-vault-inner {
        gap: 8px !important;
        justify-content: space-between !important;
      }
      #kr-bottom-streaming-vault .kr-vault-brand,
      #kr-bottom-streaming-vault .kr-vault-actions,
      #kr-bottom-streaming-vault .kr-vault-track-sub {
        display: none !important;
      }
      #kr-bottom-streaming-vault .kr-vault-play-pill {
        padding: 6px 12px !important;
        font-size: 0.72rem !important;
      }
      #kr-bottom-streaming-vault .kr-vault-track-title {
        font-size: 0.78rem !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        max-width: 120px !important;
      }
    }

    /* Multi-Device 60fps Music Graph & Sonic Universe Telemetry */
    .music-graph-toolbar {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 10px !important;
      flex-wrap: wrap !important;
      padding: 10px 14px !important;
      background: rgba(8, 12, 22, 0.96) !important;
      border-bottom: 1px solid rgba(56, 189, 248, 0.22) !important;
    }
    .graph-mode-pills,
    .graph-preset-pills {
      display: flex !important;
      align-items: center !important;
      gap: 6px !important;
      flex-wrap: wrap !important;
    }
    .graph-mode-btn,
    .su-preset-chip {
      background: rgba(15, 23, 42, 0.85) !important;
      border: 1px solid rgba(56, 189, 248, 0.28) !important;
      color: #94a3b8 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.68rem !important;
      font-weight: 700 !important;
      letter-spacing: 0.05em !important;
      padding: 5px 10px !important;
      border-radius: 9999px !important;
      cursor: pointer !important;
      transition: all 0.2s ease !important;
    }
    .graph-mode-btn:hover,
    .su-preset-chip:hover {
      border-color: #38bdf8 !important;
      color: #ffffff !important;
    }
    .graph-mode-btn.active {
      background: linear-gradient(135deg, rgba(56, 189, 248, 0.24) 0%, rgba(212, 175, 55, 0.22) 100%) !important;
      border-color: #38bdf8 !important;
      color: #f8fafc !important;
      box-shadow: 0 0 12px rgba(56, 189, 248, 0.3) !important;
    }
    .su-preset-chip.active {
      background: rgba(212, 175, 55, 0.18) !important;
      border-color: #d4af37 !important;
      color: #f6d365 !important;
      box-shadow: 0 0 12px rgba(212, 175, 55, 0.28) !important;
    }
    .graph-telemetry-readout {
      display: inline-flex !important;
      align-items: center !important;
      gap: 8px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.68rem !important;
    }
    .telemetry-hz {
      color: #f6d365 !important;
      font-weight: 700 !important;
    }
    .telemetry-fps {
      color: #38bdf8 !important;
      background: rgba(56, 189, 248, 0.12) !important;
      border: 1px solid rgba(56, 189, 248, 0.3) !important;
      padding: 2px 7px !important;
      border-radius: 9999px !important;
      font-weight: 700 !important;
    }
    #cyberVisualizer {
      width: 100% !important;
      height: 195px !important;
      display: block !important;
    }
    .sonic-universe-graph-card {
      background: rgba(6, 10, 18, 0.94) !important;
      border: 1px solid rgba(56, 189, 248, 0.32) !important;
      border-radius: 18px !important;
      overflow: hidden !important;
      margin: 0 auto 36px auto !important;
      box-shadow: 0 18px 45px rgba(0, 0, 0, 0.75), 0 0 28px rgba(56, 189, 248, 0.12) !important;
    }
    .sonic-graph-canvas-wrap {
      position: relative !important;
      display: flex !important;
      flex-direction: column !important;
      background: #04070d !important;
    }
    #sonicUniverseVisualizer {
      width: 100% !important;
      height: 210px !important;
      display: block !important;
    }
    .su-graph-play-pill {
      background: linear-gradient(135deg, #d4af37 0%, #f6d365 50%, #b48a1e 100%) !important;
      color: #04070d !important;
      border: none !important;
      border-radius: 9999px !important;
      padding: 6px 14px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.74rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      cursor: pointer !important;
      pointer-events: auto !important;
      box-shadow: 0 4px 14px rgba(212, 175, 55, 0.35) !important;
    }
    @media (max-width: 768px) {
      #cyberVisualizer,
      #sonicUniverseVisualizer {
        height: 175px !important;
      }
      .music-graph-toolbar {
        padding: 8px 10px !important;
      }
      .graph-mode-btn,
      .su-preset-chip {
        font-size: 0.62rem !important;
        padding: 4px 8px !important;
      }
    }

    /* Album Artwork Shimmer & Investments / Lifestyle Visual Alignment */
    .album-media-box,
    .album-card-art {
      background: radial-gradient(circle at 50% 45%, rgba(56, 189, 248, 0.18) 0%, rgba(212, 175, 55, 0.12) 45%, #060a12 100%) !important;
    }
    .investments-hero-header,
    .spotlight-header {
      text-align: center !important;
      max-width: 920px !important;
      margin-left: auto !important;
      margin-right: auto !important;
    }
    .investments-hero-subtitle,
    .spotlight-subtitle {
      text-align: center !important;
      margin-left: auto !important;
      margin-right: auto !important;
      max-width: 820px !important;
    }
    .spotlight-badge-cluster {
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
      gap: 10px !important;
      flex-wrap: wrap !important;
      margin-bottom: 14px !important;
    }
    .badge-pill-cyan {
      display: inline-block !important;
      background: rgba(56, 189, 248, 0.12) !important;
      border: 1px solid rgba(56, 189, 248, 0.4) !important;
      color: #38bdf8 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.72rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.08em !important;
      padding: 5px 14px !important;
      border-radius: 9999px !important;
    }
    .badge-pill-gold {
      display: inline-block !important;
      background: rgba(212, 175, 55, 0.14) !important;
      border: 1px solid rgba(212, 175, 55, 0.45) !important;
      color: #f6d365 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.72rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.08em !important;
      padding: 5px 14px !important;
      border-radius: 9999px !important;
    }
    .lifestyle-pillars-section {
      margin-top: 64px !important;
      padding-top: 24px !important;
    }
    .pillars-section-intro {
      text-align: center !important;
      max-width: 820px !important;
      margin: 0 auto 36px auto !important;
    }

    article.album-card-18[style*="display: none"] {
      display: none !important;
    }
    .album-card-art,
    .album-media-box {
      background: radial-gradient(circle at 50% 35%, rgba(56, 189, 248, 0.28) 0%, rgba(212, 175, 55, 0.22) 48%, #09101d 100%) !important;
    }
    .album-cover-img {
      opacity: 1 !important;
      visibility: visible !important;
      display: block !important;
      filter: brightness(1.14) contrast(1.06) saturate(1.08) !important;
    }
    .album-media-overlay {
      background: linear-gradient(180deg, rgba(4, 7, 13, 0.02) 0%, rgba(4, 7, 13, 0.35) 100%) !important;
    }
    .founder-chip-avatar {
      opacity: 1 !important;
      visibility: visible !important;
      display: block !important;
      background: radial-gradient(circle, rgba(212, 175, 55, 0.35) 0%, #0f172a 100%) !important;
    }

    @media (max-width: 1024px) {
      .intro-split-grid,
      .protocols-hero-split,
      .albums-grid,
      .discography-grid-18,
      .sonic-catalog-grid {
        grid-template-columns: minmax(0, 1fr) !important;
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
      }
      .intro-split-grid > *,
      .company-ai-column,
      .music-lab-column,
      .company-ai-card,
      .sound-lab-card,
      .compact-lab-card,
      .visualizer-wrapper,
      .sonic-graph-card,
      .sonic-universe-graph-card {
        width: 100% !important;
        max-width: 100% !important;
        min-width: 0 !important;
        box-sizing: border-box !important;
        overflow: hidden !important;
      }
    }

    @media (max-width: 640px) {
      html, body, #page, .site-content, #primary, #main, .ast-container {
        max-width: 100vw !important;
        overflow-x: clip !important;
      }
      .keystone-intro-split-section .ast-container,
      .intro-split-section,
      .container,
      .hero-container {
        padding-left: 14px !important;
        padding-right: 14px !important;
        box-sizing: border-box !important;
      }
      .compact-lab-card,
      .sound-lab-card,
      .company-ai-card,
      .sonic-graph-card,
      .sonic-universe-graph-card {
        padding: 16px 14px !important;
        width: 100% !important;
        max-width: 100% !important;
        min-width: 0 !important;
        box-sizing: border-box !important;
      }
      .company-ai-cta-row,
      .cyber-cta-group {
        display: flex !important;
        flex-direction: column !important;
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
      }
      .btn-cyan-primary,
      .btn-glass-secondary,
      .btn-gold-subtle,
      .cyber-play-button {
        width: 100% !important;
        max-width: 100% !important;
        min-width: 0 !important;
        white-space: normal !important;
        box-sizing: border-box !important;
        padding-left: 14px !important;
        padding-right: 14px !important;
        text-align: center !important;
        justify-content: center !important;
      }
      .music-graph-toolbar,
      .graph-mode-pills,
      .graph-preset-pills,
      .kr-viz-mode-bar,
      .kr-synth-toolbar {
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 6px !important;
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
      }
      .graph-mode-btn,
      .su-preset-chip,
      .kr-viz-mode-btn {
        flex: 1 1 auto !important;
        min-width: 0 !important;
        font-size: 0.62rem !important;
        padding: 5px 8px !important;
        text-align: center !important;
        white-space: nowrap !important;
      }
      .kr-track-selector-pills,
      .track-pill-row {
        display: grid !important;
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
        gap: 6px !important;
        width: 100% !important;
      }
      .kr-track-pill,
      .track-select-btn,
      .playlist-track-row {
        width: 100% !important;
        max-width: 100% !important;
        min-width: 0 !important;
        box-sizing: border-box !important;
        overflow: hidden !important;
        padding: 8px 10px !important;
      }
      .site-nav-header .nav-container {
        padding: 0 12px !important;
        gap: 8px !important;
      }
      h1, .hero-main-title, .contact-main-title, .sonic-hero-title, .inv-main-title {
        font-size: clamp(1.75rem, 7vw, 2.35rem) !important;
        overflow-wrap: break-word !important;
        word-break: break-word !important;
      }
    }

    /* Unified Obsidian #04070d Background & Transparent .ast-container (Eliminates #04070d vs #000000 Split) */
    html,
    body,
    #page,
    #content,
    .site-content,
    #primary,
    .content-area,
    .keystone-cyber-home,
    .keystone-cyber-protocols,
    .cyber-hero-section,
    .keystone-intel-archive,
    .keystone-sonic-universe-page,
    .keystone-investments-page,
    .keystone-lifestyle-page,
    .keystone-contact-page,
    .keystone-founder-page,
    .keystone-home-orchestrator {
      background-color: #04070d !important;
      background: #04070d !important;
    }
    .ast-container {
      background-color: transparent !important;
      background: transparent !important;
    }

    /* Eliminate 140px Black Void Under Header on /founder/ and All Sovereign Pages */
    .keystone-founder-page,
    .keystone-sonic-universe-page,
    .keystone-investments-page,
    .keystone-lifestyle-page,
    .keystone-contact-page,
    .keystone-cyber-protocols,
    .keystone-intel-archive {
      margin-top: 0 !important;
      padding-top: 24px !important;
    }
    .founder-hero-header {
      padding-top: 8px !important;
      margin-top: 0 !important;
      margin-bottom: 32px !important;
    }

    /* Header Right-Side AI PROTOCOLS CTA Pill */
    .header-protocols-cta-pill {
      background: linear-gradient(135deg, rgba(56, 189, 248, 0.2) 0%, rgba(212, 175, 55, 0.22) 100%) !important;
      border: 1px solid #38bdf8 !important;
      color: #f8fafc !important;
      border-radius: 9999px !important;
      padding: 6px 14px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.72rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.06em !important;
      text-decoration: none !important;
      white-space: nowrap !important;
      box-shadow: 0 0 12px rgba(56, 189, 248, 0.3) !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      transition: all 0.2s ease !important;
    }
    .header-protocols-cta-pill:hover {
      border-color: #d4af37 !important;
      color: #ffffff !important;
      box-shadow: 0 0 18px rgba(212, 175, 55, 0.5) !important;
    }

    /* Compact Phone / Tablet Header (<= 1024px) & Scrollable Mobile Dropdown Bar */
    @media (max-width: 1024px) {
      .site-nav-header .nav-container {
        height: 52px !important;
        min-height: 52px !important;
        padding: 0 12px !important;
        gap: 8px !important;
      }
      .site-nav-header .kp-badge-mark {
        width: 30px !important;
        height: 30px !important;
        min-width: 30px !important;
        min-height: 30px !important;
      }
      .site-nav-header .kp-badge-img {
        width: 22px !important;
        height: 22px !important;
      }
      .site-nav-header .brand-title-wrap .title-main {
        font-size: 0.76rem !important;
        letter-spacing: 0.04em !important;
        line-height: 1.1 !important;
        white-space: nowrap !important;
      }
      .site-nav-header .nav-right-actions {
        gap: 6px !important;
      }
      .site-nav-header .nav-right-actions .social-icon-btn {
        display: none !important;
      }
      .header-protocols-cta-pill {
        padding: 5px 10px !important;
        font-size: 0.66rem !important;
        letter-spacing: 0.04em !important;
      }
      #kpMobileNavToggle,
      .site-nav-header .mobile-hamburger {
        border: 1px solid #38bdf8 !important;
        background: rgba(15, 23, 42, 0.92) !important;
        color: #38bdf8 !important;
        border-radius: 9999px !important;
        padding: 5px 11px !important;
        font-family: 'Outfit', sans-serif !important;
        font-size: 0.68rem !important;
        font-weight: 800 !important;
        letter-spacing: 0.05em !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 5px !important;
        width: auto !important;
        height: auto !important;
        cursor: pointer !important;
        box-shadow: 0 0 10px rgba(56, 189, 248, 0.25) !important;
      }
    }
    @media (max-width: 768px) {
      .site-nav-header .nav-container {
        padding: 0 12px !important;
        gap: 8px !important;
      }
      .site-nav-header .brand-edge-logo {
        gap: 8px !important;
      }
      .site-nav-header .kp-badge-mark {
        width: 28px !important;
        height: 28px !important;
        min-width: 28px !important;
        min-height: 28px !important;
      }
      .site-nav-header .kp-badge-img {
        width: 20px !important;
        height: 20px !important;
      }
      .site-nav-header .brand-title-wrap .title-main {
        font-size: 0.72rem !important;
        letter-spacing: 0.03em !important;
      }
      .site-nav-header .brand-title-wrap .title-sub {
        display: none !important;
      }
      .header-protocols-cta-pill {
        display: none !important;
      }
      #kpMobileNavToggle,
      .site-nav-header .mobile-hamburger {
        padding: 6px 12px !important;
        font-size: 0.68rem !important;
        gap: 5px !important;
      }
    }

    /* Upgraded Scrollable #mobileDrawer with #1 Featured AI PROTOCOLS Card */
    #mobileDrawer.mobile-menu-drawer {
      position: fixed !important;
      top: 52px !important;
      left: 0 !important;
      right: 0 !important;
      max-height: calc(100vh - 64px) !important;
      overflow-y: auto !important;
      -webkit-overflow-scrolling: touch !important;
      background: rgba(4, 7, 13, 0.98) !important;
      border-bottom: 2px solid #38bdf8 !important;
      padding: 14px 16px 24px 16px !important;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.9) !important;
      z-index: 9999 !important;
      flex-direction: column !important;
      gap: 8px !important;
    }
    #mobileDrawer.mobile-menu-drawer.active {
      display: flex !important;
    }
    #mobileDrawer .mobile-drawer-protocols-featured {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 12px !important;
      background: linear-gradient(135deg, rgba(56, 189, 248, 0.18) 0%, rgba(212, 175, 55, 0.20) 100%) !important;
      border: 1.5px solid #d4af37 !important;
      box-shadow: 0 0 18px rgba(56, 189, 248, 0.28) !important;
      border-radius: 14px !important;
      padding: 12px 14px !important;
      text-decoration: none !important;
      margin-bottom: 4px !important;
    }
    #mobileDrawer .drawer-proto-left {
      display: flex !important;
      flex-direction: column !important;
      gap: 3px !important;
      min-width: 0 !important;
    }
    #mobileDrawer .drawer-proto-kicker {
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.62rem !important;
      font-weight: 800 !important;
      color: #38bdf8 !important;
      letter-spacing: 0.06em !important;
    }
    #mobileDrawer .drawer-proto-title {
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.84rem !important;
      font-weight: 800 !important;
      color: #ffffff !important;
      line-height: 1.25 !important;
    }
    #mobileDrawer .drawer-proto-badge {
      background: linear-gradient(135deg, #d4af37 0%, #f3e5ab 50%, #aa8010 100%) !important;
      color: #04070d !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.68rem !important;
      font-weight: 900 !important;
      padding: 5px 10px !important;
      border-radius: 9999px !important;
      white-space: nowrap !important;
      flex-shrink: 0 !important;
    }
    #mobileDrawer .mobile-drawer-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      padding: 11px 14px !important;
      border-radius: 10px !important;
      background: rgba(15, 23, 42, 0.75) !important;
      border: 1px solid rgba(56, 189, 248, 0.22) !important;
      color: #f8fafc !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.82rem !important;
      font-weight: 700 !important;
      letter-spacing: 0.04em !important;
      text-decoration: none !important;
    }
    #mobileDrawer .mobile-drawer-row.active,
    #mobileDrawer .mobile-drawer-row:hover {
      border-color: #38bdf8 !important;
      color: #38bdf8 !important;
      background: rgba(56, 189, 248, 0.14) !important;
    }
    #mobileDrawer .drawer-row-arrow {
      color: #38bdf8 !important;
      font-weight: 800 !important;
    }

    /* Suppress Astra default footer on homepage in favor of Wayne's 4-column Regional Divisions footer */
    body.home .site-footer,
    body.home #colophon,
    .ast-footer-html-1 {
      display: none !important;
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
 * 8. Page 1 Clean Crisp Top Hero Architecture, Equal Box Alignment, 60Hz/432Hz Sound Lab & Hover-Only Button Color Wave
 */
function keystone_page1_hero_and_button_wave_engine(): void {
    ?>
    <style id="keystone-hero-and-button-wave-lock">
    /* 1. Clean Crisp Top Hero Cadence */
    .cyber-hero-section {
      padding-top: 26px !important;
      padding-bottom: 32px !important;
      min-height: auto !important;
      border-bottom: 1px solid rgba(56, 189, 248, 0.22) !important;
      background: radial-gradient(ellipse at 50% 0%, rgba(56, 189, 248, 0.11) 0%, rgba(212, 175, 55, 0.05) 38%, #04070d 76%) !important;
    }
    .cyber-hero-wrap .cyber-telemetry-pill {
      margin-bottom: 16px !important;
      border: 1px solid rgba(56, 189, 248, 0.5) !important;
      background: rgba(6, 11, 20, 0.94) !important;
      box-shadow: 0 6px 22px rgba(0, 0, 0, 0.7), 0 0 18px rgba(56, 189, 248, 0.24) !important;
    }
    .cyber-hero-wrap .cyber-hero-title {
      margin-bottom: 20px !important;
      font-size: clamp(1.95rem, 2.9vw, 2.75rem) !important;
      line-height: 1.16 !important;
      letter-spacing: -0.02em !important;
      text-shadow: 0 8px 30px rgba(0, 0, 0, 0.85) !important;
    }

    /* 2. High-End Founder & 3-Domain Identity Showcase Underneath Machine Intelligence */
    .cyber-founder-showcase-card {
      width: 100% !important;
      max-width: 960px !important;
      margin: 0 auto 20px auto !important;
      padding: 18px 22px !important;
      background: linear-gradient(135deg, rgba(10, 16, 28, 0.96) 0%, rgba(4, 7, 13, 0.99) 100%) !important;
      border: 1px solid rgba(212, 175, 55, 0.52) !important;
      border-radius: 18px !important;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.85), 0 0 28px rgba(56, 189, 248, 0.16), inset 0 1px 0 rgba(255, 255, 255, 0.08) !important;
      display: flex !important;
      flex-direction: column !important;
      gap: 15px !important;
      backdrop-filter: blur(16px) !important;
      -webkit-backdrop-filter: blur(16px) !important;
    }
    .founder-showcase-top {
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 16px !important;
      padding-bottom: 14px !important;
      border-bottom: 1px solid rgba(212, 175, 55, 0.24) !important;
      flex-wrap: wrap !important;
    }
    .founder-avatar-halo {
      position: relative !important;
      display: inline-flex !important;
      padding: 3px !important;
      border-radius: 50% !important;
      background: linear-gradient(135deg, #d4af37 0%, #38bdf8 50%, #f6d365 100%) !important;
      box-shadow: 0 0 18px rgba(212, 175, 55, 0.45), 0 0 12px rgba(56, 189, 248, 0.35) !important;
    }
    .cyber-hero-wrap .founder-chip-avatar {
      width: 54px !important;
      height: 54px !important;
      min-width: 54px !important;
      min-height: 54px !important;
      border-radius: 50% !important;
      object-fit: cover !important;
      border: 2px solid #04070d !important;
      display: block !important;
    }
    .avatar-online-dot {
      position: absolute !important;
      bottom: 2px !important;
      right: 2px !important;
      width: 11px !important;
      height: 11px !important;
      border-radius: 50% !important;
      background: #38bdf8 !important;
      border: 2px solid #04070d !important;
      box-shadow: 0 0 8px #38bdf8 !important;
    }
    .founder-name-row {
      display: flex !important;
      align-items: center !important;
      gap: 10px !important;
      flex-wrap: wrap !important;
    }
    .cyber-founder-showcase-card .chip-name {
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.22rem !important;
      font-weight: 800 !important;
      color: #ffffff !important;
      letter-spacing: -0.01em !important;
    }
    .cyber-founder-showcase-card .chip-role {
      font-family: 'Inter', sans-serif !important;
      font-size: 0.85rem !important;
      font-weight: 600 !important;
      color: #f6d365 !important;
      letter-spacing: 0.02em !important;
      margin-top: 2px !important;
    }
    .founder-triad-pills {
      display: grid !important;
      grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
      gap: 12px !important;
      width: 100% !important;
    }
    .triad-pill {
      display: flex !important;
      align-items: center !important;
      gap: 11px !important;
      padding: 11px 14px !important;
      border-radius: 14px !important;
      background: rgba(8, 13, 24, 0.94) !important;
      border: 1px solid rgba(56, 189, 248, 0.36) !important;
      text-align: left !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
    }
    .triad-pill.triad-ai {
      border-color: rgba(212, 175, 55, 0.48) !important;
    }
    .triad-pill:hover {
      transform: translateY(-2px) !important;
      border-color: #d4af37 !important;
      box-shadow: 0 8px 22px rgba(0, 0, 0, 0.7), 0 0 16px rgba(212, 175, 55, 0.24) !important;
    }
    .triad-copy {
      display: flex !important;
      flex-direction: column !important;
      min-width: 0 !important;
    }
    /* Crisp solid white at rest on Triad pills; gradient wave only on hover */
    .triad-title {
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.74rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.06em !important;
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      background-image: none !important;
      background-color: transparent !important;
      animation: none !important;
    }
    .triad-pill:hover .triad-title {
      background-image: linear-gradient(90deg, #ffffff 0%, #ffffff 16%, #f6d365 30%, #ffd700 40%, #ffffff 52%, #d4af37 68%, #ffd700 78%, #ffffff 92%, #ffffff 100%) !important;
      background-size: 220% auto !important;
      background-repeat: repeat !important;
      -webkit-background-clip: text !important;
      background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      color: transparent !important;
      animation: ksButtonWordWave 1.15s linear infinite !important;
    }
    .triad-sub {
      font-family: 'Inter', sans-serif !important;
      font-size: 0.72rem !important;
      color: #cbd5e1 !important;
      line-height: 1.35 !important;
      margin-top: 2px !important;
    }
    .triad-node-icon {
      width: 34px !important;
      height: 34px !important;
      min-width: 34px !important;
      border-radius: 10px !important;
      background: rgba(56, 189, 248, 0.12) !important;
      border: 1px solid rgba(212, 175, 55, 0.44) !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      font-size: 0.95rem !important;
      flex-shrink: 0 !important;
    }
    .triad-eq-bars {
      width: 34px !important;
      height: 34px !important;
      min-width: 34px !important;
      border-radius: 10px !important;
      background: rgba(56, 189, 248, 0.12) !important;
      border: 1px solid rgba(56, 189, 248, 0.45) !important;
      display: inline-flex !important;
      align-items: flex-end !important;
      justify-content: center !important;
      gap: 3px !important;
      padding: 8px 6px !important;
      box-sizing: border-box !important;
      flex-shrink: 0 !important;
    }
    .triad-eq-bars i {
      display: block !important;
      width: 3px !important;
      border-radius: 2px !important;
      background: linear-gradient(180deg, #38bdf8 0%, #d4af37 100%) !important;
      animation: ksEqPulse 1.2s ease-in-out infinite !important;
    }
    .triad-eq-bars i:nth-child(1) { height: 8px !important; animation-delay: 0s !important; }
    .triad-eq-bars i:nth-child(2) { height: 15px !important; animation-delay: 0.2s !important; }
    .triad-eq-bars i:nth-child(3) { height: 11px !important; animation-delay: 0.4s !important; }
    .triad-eq-bars i:nth-child(4) { height: 16px !important; animation-delay: 0.15s !important; }
    @keyframes ksEqPulse {
      0%, 100% { transform: scaleY(0.55); opacity: 0.75; }
      50% { transform: scaleY(1.1); opacity: 1; }
    }
    .cyber-hero-wrap .cyber-hero-subtitle {
      margin-bottom: 2px !important;
      max-width: 820px !important;
      color: #cbd5e1 !important;
      font-size: clamp(0.98rem, 1.4vw, 1.12rem) !important;
      line-height: 1.65 !important;
    }

    /* 3. Section 2 Two-Column Split Alignment & Interior Pure Black Buttons */
    .intro-split-grid {
      display: grid !important;
      grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
      gap: 32px !important;
      align-items: stretch !important;
    }
    .company-ai-column,
    .music-lab-column {
      display: flex !important;
      flex-direction: column !important;
      height: 100% !important;
      min-width: 0 !important;
    }
    .company-ai-card,
    .sound-lab-card.compact-lab-card {
      height: 100% !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      padding: 32px !important;
      border-radius: 18px !important;
      box-sizing: border-box !important;
      background: #04070d !important;
      background-image: none !important;
      border: 1px solid rgba(56, 189, 248, 0.38) !important;
      box-shadow: 0 24px 60px rgba(0, 0, 0, 0.85), 0 0 28px rgba(56, 189, 248, 0.1) !important;
    }
    .sound-lab-card.compact-lab-card {
      border-color: rgba(212, 175, 55, 0.45) !important;
    }

    /* Left Column Header Badges Side-by-Side Alignment */
    .builder-badge-row {
      display: flex !important;
      flex-direction: row !important;
      align-items: center !important;
      gap: 8px !important;
      flex-wrap: nowrap !important;
      margin: 14px 0 18px 0 !important;
    }
    .badge-gold-builder,
    .badge-cyan-swarms,
    .lab-live-badge,
    .lab-freq-badge {
      padding: 5px 12px !important;
      min-height: 0 !important;
      height: auto !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.66rem !important;
      font-weight: 700 !important;
      line-height: 1.2 !important;
      letter-spacing: 0.04em !important;
      white-space: nowrap !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 5px !important;
    }
    .sound-lab-meta {
      display: flex !important;
      flex-direction: row !important;
      align-items: center !important;
      gap: 10px !important;
      flex-wrap: nowrap !important;
      margin-bottom: 12px !important;
    }

    /* Hide Removed Switcher, Frequency, Top-Corner & Lossless Clutter Pills */
    .ai-pillar-switcher-bar,
    .freq-tuning-bar,
    .founder-credentials-stack,
    .album-format-pill,
    .lossless-tag,
    .video-runtime-pill {
      display: none !important;
    }

    /* Operational Pillars Alignment (Color-Matched Blue & Gold Borders + Hover Wave) */
    .operational-pillars-list {
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      flex: 1 1 auto !important;
      gap: 14px !important;
      margin-top: 8px !important;
      margin-bottom: 20px !important;
      width: 100% !important;
    }
    .operational-pillars-list .pillar-item,
    .operational-pillars-list .pillar-item.active-pillar,
    .operational-pillars-list .pillar-item.pillar-blue {
      padding: 18px 20px !important;
      border-radius: 14px !important;
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      border: 1.5px solid rgba(56, 189, 248, 0.65) !important;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.82) !important;
      display: flex !important;
      align-items: flex-start !important;
      gap: 14px !important;
      cursor: pointer !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
      flex: 1 1 auto !important;
    }
    .operational-pillars-list .pillar-item.pillar-gold {
      border: 1.5px solid rgba(212, 175, 55, 0.72) !important;
    }
    .operational-pillars-list .pillar-item.pillar-blue:hover {
      background: #04070d !important;
      background-image: none !important;
      border-color: #38bdf8 !important;
      box-shadow: 0 10px 26px rgba(0, 0, 0, 0.92), 0 0 22px rgba(56, 189, 248, 0.55) !important;
      transform: translateY(-2px) !important;
    }
    .operational-pillars-list .pillar-item.pillar-gold:hover {
      background: #04070d !important;
      background-image: none !important;
      border-color: #f6d365 !important;
      box-shadow: 0 10px 26px rgba(0, 0, 0, 0.92), 0 0 22px rgba(212, 175, 55, 0.55) !important;
      transform: translateY(-2px) !important;
    }
    .pillar-title-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 10px !important;
      margin-bottom: 6px !important;
    }
    .pillar-title-row h4 {
      margin: 0 !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.0rem !important;
      font-weight: 700 !important;
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
    }
    .pillar-tag-pill {
      padding: 4px 10px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.65rem !important;
      font-weight: 700 !important;
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      background: #04070d !important;
      background-image: none !important;
      border: 1.5px solid rgba(56, 189, 248, 0.78) !important;
      white-space: nowrap !important;
      flex-shrink: 0 !important;
    }
    .pillar-tag-pill.pillar-tag-gold {
      border-color: rgba(212, 175, 55, 0.82) !important;
    }
    .operational-pillars-list .pillar-content p {
      margin: 0 !important;
      font-size: 0.86rem !important;
      line-height: 1.55 !important;
      color: #ffffff !important;
    }

    /* Fix NOW STREAMING Bar Wrapping & Playlist Header */
    .visualizer-hud-overlay {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      flex-wrap: nowrap !important;
      gap: 10px !important;
      padding: 10px 14px !important;
      background: #04070d !important;
      border-top: 1px solid rgba(56, 189, 248, 0.28) !important;
    }
    .visualizer-hud-overlay .track-info {
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
      min-width: 0 !important;
      flex: 1 1 auto !important;
      overflow: hidden !important;
      background: #04070d !important;
      background-image: none !important;
      border: 1.5px solid rgba(56, 189, 248, 0.68) !important;
      border-radius: 9999px !important;
      padding: 5px 12px !important;
      cursor: pointer !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
    }
    .visualizer-hud-overlay .track-label {
      white-space: nowrap !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.68rem !important;
      font-weight: 800 !important;
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      letter-spacing: 0.04em !important;
      flex-shrink: 0 !important;
    }
    .visualizer-hud-overlay .track-name {
      white-space: nowrap !important;
      overflow: hidden !important;
      text-overflow: ellipsis !important;
      font-size: 0.76rem !important;
      font-weight: 700 !important;
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
    }
    .visualizer-hud-overlay .engine-state {
      flex-shrink: 0 !important;
      white-space: nowrap !important;
    }
    .playlist-header {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      flex-wrap: nowrap !important;
      gap: 8px !important;
      margin-bottom: 12px !important;
    }
    .playlist-header .playlist-title {
      white-space: nowrap !important;
      font-size: 0.70rem !important;
      color: #ffffff !important;
      font-weight: 800 !important;
    }
    .playlist-header-actions {
      display: flex !important;
      align-items: center !important;
      flex-wrap: nowrap !important;
      gap: 8px !important;
      flex-shrink: 0 !important;
    }

    /* Uniform Button Sizing & Centering in Section 2 Left & Right Columns */
    .company-ai-cta-row,
    .music-lab-cta-row {
      margin-top: auto !important;
      padding-top: 16px !important;
      display: flex !important;
      flex-direction: column !important;
      gap: 14px !important;
      width: 100% !important;
    }
    .sound-lab-controls {
      display: flex !important;
      flex-direction: column !important;
      gap: 14px !important;
      width: 100% !important;
      flex: 1 1 auto !important;
      margin-top: 16px !important;
    }
    .sound-lab-playlist-deck {
      display: flex !important;
      flex-direction: column !important;
      flex: 1 1 auto !important;
      width: 100% !important;
      margin-top: 0 !important;
      margin-bottom: 20px !important;
      background: #04070d !important;
      border: 1px solid rgba(56, 189, 248, 0.32) !important;
      border-radius: 16px !important;
      padding: 16px !important;
      box-sizing: border-box !important;
    }
    .sound-lab-card .playlist-scroll-container {
      max-height: 295px !important;
      flex: 1 1 auto !important;
    }
    .company-ai-cta-row a,
    .music-lab-cta-row #cyberPlayBtn,
    .music-lab-cta-row a,
    .sound-lab-controls #cyberPlayBtn,
    .music-lab-footer-link a {
      width: 100% !important;
      min-height: 52px !important;
      height: 52px !important;
      padding: 0 20px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      text-align: center !important;
      box-sizing: border-box !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.81rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.04em !important;
      text-transform: uppercase !important;
      white-space: nowrap !important;
      margin: 0 !important;
      gap: 8px !important;
    }

    /* 4. Section 3 Master Studio Albums — Equal Card Heights, Left-Aligned Genre & Stacked Vertical Action Buttons */
    .albums-grid {
      display: grid !important;
      grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
      gap: 28px !important;
      align-items: stretch !important;
    }
    .cyber-album-card {
      height: 100% !important;
      display: flex !important;
      flex-direction: column !important;
      border-radius: 18px !important;
      box-sizing: border-box !important;
      background: #04070d !important;
      border: 1px solid rgba(56, 189, 248, 0.34) !important;
    }
    .cyber-album-card .album-card-body {
      flex: 1 1 auto !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      background: #04070d !important;
      padding: 24px !important;
      text-align: left !important;
    }
    .cyber-album-card .album-genre-meta {
      display: flex !important;
      justify-content: flex-start !important;
      align-items: center !important;
      text-align: left !important;
      margin-bottom: 10px !important;
      width: 100% !important;
    }
    .cyber-album-card .genre-tag {
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.70rem !important;
      font-weight: 700 !important;
      color: #38bdf8 !important;
      letter-spacing: 0.05em !important;
      text-align: left !important;
      white-space: nowrap !important;
      overflow: hidden !important;
      text-overflow: ellipsis !important;
    }
    .cyber-album-card .album-card-title {
      text-align: left !important;
      margin: 0 0 10px 0 !important;
      color: #ffffff !important;
    }
    .cyber-album-card .album-card-desc {
      text-align: left !important;
      margin: 0 0 18px 0 !important;
      color: #cbd5e1 !important;
      flex: 1 1 auto !important;
    }
    .cyber-album-card .album-action-row {
      margin-top: auto !important;
      padding-top: 16px !important;
      border-top: 1px solid rgba(56, 189, 248, 0.2) !important;
      display: flex !important;
      flex-direction: column !important;
      align-items: stretch !important;
      justify-content: flex-end !important;
      gap: 10px !important;
      width: 100% !important;
    }
    .cyber-albums-section .albums-footer-cta {
      margin-top: 56px !important;
      margin-bottom: 12px !important;
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
    }
    .cyber-albums-section .albums-footer-cta a,
    .cyber-intel-carousel-section .albums-footer-cta a {
      min-height: 54px !important;
      height: 54px !important;
      padding: 0 38px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      text-align: center !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.88rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.06em !important;
      text-transform: uppercase !important;
    }

    /* 5. Section 4 Technical Intel Carousel — Equal Slide Card Heights & Full-Width Aligned Footers */
    .intel-carousel-track {
      display: flex !important;
      align-items: stretch !important;
    }
    .intel-carousel-slide {
      display: flex !important;
      height: auto !important;
    }
    .cyber-intel-card.intel-slide-card {
      height: 100% !important;
      width: 100% !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      border-radius: 18px !important;
      box-sizing: border-box !important;
      background: #04070d !important;
      border: 1px solid rgba(56, 189, 248, 0.34) !important;
    }
    .cyber-intel-card .intel-card-content {
      flex: 1 1 auto !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      background: #04070d !important;
      padding: 24px !important;
    }
    .cyber-intel-card .intel-card-footer {
      margin-top: auto !important;
      padding-top: 16px !important;
      border-top: 1px solid rgba(56, 189, 248, 0.2) !important;
      display: flex !important;
      width: 100% !important;
    }
    .cyber-intel-carousel-section .albums-footer-cta {
      margin-top: 46px !important;
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
    }

    /* 6. Section 5 Founder Dossier — 9:16 Vertical Portrait & Paired Buttons (Zero Clutter Under Photo) */
    .founder-card-inner {
      display: grid !important;
      grid-template-columns: 240px 1fr !important;
      gap: 42px !important;
      align-items: center !important;
    }
    .founder-photo-col {
      display: flex !important;
      flex-direction: column !important;
      align-items: center !important;
      justify-content: center !important;
      margin: 0 !important;
    }
    .founder-photo-frame {
      margin: 0 auto !important;
      width: 230px !important;
      aspect-ratio: 9 / 16 !important;
      height: 409px !important;
      border-radius: 18px !important;
      overflow: hidden !important;
      border: 1.5px solid rgba(212, 175, 55, 0.82) !important;
      background: #04070d !important;
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.9), 0 0 22px rgba(56, 189, 248, 0.18) !important;
      position: relative !important;
    }
    .founder-portrait-img {
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
      object-position: center 22% !important;
      display: block !important;
    }
    .founder-name-heading {
      margin-top: 0 !important;
    }
    .founder-actions-row {
      display: flex !important;
      align-items: center !important;
      justify-content: flex-start !important;
      gap: 16px !important;
      flex-wrap: wrap !important;
      margin-top: 24px !important;
    }
    .founder-actions-row a,
    .founder-actions-row .btn-cyan-primary,
    .founder-actions-row .btn-gold-subtle {
      margin: 0 !important;
      min-height: 54px !important;
      height: 54px !important;
      max-height: 54px !important;
      min-width: 280px !important;
      flex: 1 1 280px !important;
      padding: 0 28px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      text-align: center !important;
      vertical-align: middle !important;
      box-sizing: border-box !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.86rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      text-transform: uppercase !important;
      line-height: 1 !important;
    }

    /* 7. Prominent Footer Subscribe Buttons & Universal Pure-Black + Hover-Only Wave Standard */
    .footer-subscribe-btn {
      min-height: 56px !important;
      height: 56px !important;
      min-width: 340px !important;
      padding: 0 32px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 12px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.90rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.07em !important;
      text-transform: uppercase !important;
      box-sizing: border-box !important;
    }

    @keyframes ksButtonWordWave {
      0% { background-position: 220% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* ALL INTERIOR & BOTTOM BLUE BUTTONS / PILLS AT REST: Pure Black Background + White Text + Blue Border */
    .btn-cyan-primary,
    .btn-cyan-outline,
    .header-protocols-cta-pill,
    .cyber-play-button,
    .footer-subscribe-btn-cyan,
    #kr-bottom-streaming-vault .kr-vault-link-pill,
    .cyber-telemetry-pill,
    .chip-verified-badge,
    .badge-cyan-swarms,
    .pillar-tag-pill.pillar-tag-blue,
    .lab-live-badge,
    .graph-mode-btn,
    .graph-mode-btn.active,
    .telemetry-fps,
    #engineStateBadge,
    .engine-active,
    .engine-idle,
    .playlist-rotate-btn,
    .playlist-count,
    .album-details-link,
    .intel-read-more,
    .intel-carousel-nav-btn {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      border: 1.5px solid rgba(56, 189, 248, 0.78) !important;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.82) !important;
      border-radius: 9999px !important;
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
    }

    /* ALL INTERIOR & BOTTOM GOLD BUTTONS / PILLS AT REST: Pure Black Background + White Text + Gold Border */
    .btn-gold-subtle,
    .btn-glass-secondary,
    .footer-subscribe-btn-gold,
    #kr-bottom-streaming-vault .kr-vault-play-pill,
    #kr-bottom-streaming-vault .kr-vault-spotify-pill,
    .badge-gold-builder,
    .lab-freq-badge,
    .pillar-tag-pill.pillar-tag-gold,
    .track-hz-pill,
    .album-stream-prompt,
    .telemetry-hz {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      border: 1.5px solid rgba(212, 175, 55, 0.82) !important;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.82) !important;
      border-radius: 9999px !important;
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
    }

    .telemetry-hz,
    .telemetry-fps,
    .graph-mode-btn,
    #engineStateBadge,
    .playlist-rotate-btn,
    .playlist-count,
    .track-hz-pill {
      padding: 4px 10px !important;
      min-height: 0 !important;
      height: auto !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.62rem !important;
      font-weight: 700 !important;
      line-height: 1.2 !important;
      letter-spacing: 0.04em !important;
      white-space: nowrap !important;
      flex-shrink: 0 !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      cursor: pointer !important;
    }
    .music-graph-toolbar {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      flex-wrap: wrap !important;
      gap: 6px !important;
      padding: 10px 12px !important;
      background: #04070d !important;
    }
    .album-stream-prompt,
    .album-details-link,
    .intel-read-more {
      width: 100% !important;
      min-height: 46px !important;
      height: 46px !important;
      padding: 0 18px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      text-align: center !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.78rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.04em !important;
      text-transform: uppercase !important;
      white-space: nowrap !important;
      text-decoration: none !important;
      box-sizing: border-box !important;
      cursor: pointer !important;
      margin: 0 !important;
    }

    /* Triad Pills & Song Rows: Pure Black Background (Zero Shading Behind Them) + White Writing */
    .triad-pill,
    .triad-pill.triad-ai,
    .triad-pill.triad-music,
    .triad-pill.triad-builder,
    .triad-node-icon,
    .triad-eq-bars {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      cursor: pointer !important;
    }
    .triad-pill.triad-music,
    .triad-pill.triad-builder {
      border: 1.5px solid rgba(56, 189, 248, 0.72) !important;
    }
    .triad-pill.triad-ai {
      border: 1.5px solid rgba(212, 175, 55, 0.78) !important;
    }
    .triad-pill.triad-music:hover,
    .triad-pill.triad-builder:hover {
      border-color: #38bdf8 !important;
      box-shadow: 0 10px 26px rgba(0, 0, 0, 0.92), 0 0 22px rgba(56, 189, 248, 0.55) !important;
      transform: translateY(-2px) !important;
    }
    .triad-pill.triad-ai:hover {
      border-color: #f6d365 !important;
      box-shadow: 0 10px 26px rgba(0, 0, 0, 0.92), 0 0 22px rgba(212, 175, 55, 0.55) !important;
      transform: translateY(-2px) !important;
    }
    .triad-pill .triad-title,
    .triad-pill .triad-sub {
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
    }

    .playlist-track-row,
    .playlist-track-row.active,
    .playlist-track-row:hover {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      border: 1.5px solid rgba(56, 189, 248, 0.45) !important;
      box-shadow: none !important;
      border-radius: 12px !important;
      color: #ffffff !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
    }
    .playlist-track-row.active {
      border-color: rgba(56, 189, 248, 0.85) !important;
    }
    .playlist-track-row:hover {
      border-color: #38bdf8 !important;
      box-shadow: 0 8px 22px rgba(0, 0, 0, 0.85), 0 0 18px rgba(56, 189, 248, 0.35) !important;
      transform: translateY(-1px) !important;
    }
    .playlist-track-row .track-num,
    .playlist-track-row.active .track-num,
    .playlist-track-row .track-name-main,
    .playlist-track-row.active .track-name-main,
    .playlist-track-row .track-meta-sub,
    .playlist-track-row .track-play-indicator,
    .playlist-track-row.active .track-play-indicator {
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      background-image: none !important;
      background-color: transparent !important;
      animation: none !important;
    }

    /* Button & Interior Pill Wording At Rest: Crisp Solid White (NEVER use background shorthand with !important so @keyframes can animate background-position!) */
    .ks-wave-text,
    .cyber-play-button #playLabel,
    .cyber-play-button #playIcon,
    #kr-bottom-streaming-vault .kr-vault-play-pill span,
    .cyber-telemetry-pill .telemetry-text {
      display: inline-block !important;
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      background-image: none !important;
      background-color: transparent !important;
      animation: none !important;
    }

    /* Blue Button / Interior Pill Hover: Stays Black Background + White-to-Blue Wave Pulsating Through Letters */
    .btn-cyan-primary:hover,
    .btn-cyan-outline:hover,
    .header-protocols-cta-pill:hover,
    .cyber-play-button:hover,
    .footer-subscribe-btn-cyan:hover,
    #kr-bottom-streaming-vault .kr-vault-link-pill:hover,
    .cyber-telemetry-pill:hover,
    .chip-verified-badge:hover,
    .badge-cyan-swarms:hover,
    .pillar-tag-pill.pillar-tag-blue:hover,
    .lab-live-badge:hover,
    .graph-mode-btn:hover,
    .telemetry-fps:hover,
    #engineStateBadge:hover,
    .playlist-rotate-btn:hover,
    .playlist-count:hover,
    .visualizer-hud-overlay .track-info:hover,
    .album-details-link:hover,
    .intel-read-more:hover,
    .intel-carousel-nav-btn:hover {
      background: #04070d !important;
      background-image: none !important;
      border-color: #38bdf8 !important;
      box-shadow: 0 10px 26px rgba(0, 0, 0, 0.92), 0 0 22px rgba(56, 189, 248, 0.55) !important;
      transform: translateY(-1px) !important;
    }
    .btn-cyan-primary:hover .ks-wave-text,
    .btn-cyan-outline:hover .ks-wave-text,
    .header-protocols-cta-pill:hover .ks-wave-text,
    .cyber-play-button:hover #playLabel,
    .cyber-play-button:hover #playIcon,
    .footer-subscribe-btn-cyan:hover .ks-wave-text,
    #kr-bottom-streaming-vault .kr-vault-link-pill:hover .ks-wave-text,
    .cyber-telemetry-pill:hover .telemetry-text,
    .cyber-telemetry-pill:hover .ks-wave-text,
    .chip-verified-badge:hover .ks-wave-text,
    .triad-pill.triad-music:hover .triad-title,
    .triad-pill.triad-builder:hover .triad-title,
    .badge-cyan-swarms:hover .ks-wave-text,
    .operational-pillars-list .pillar-item.pillar-blue:hover .pillar-title-row h4 .ks-wave-text,
    .operational-pillars-list .pillar-item.pillar-blue:hover .pillar-title-row h4,
    .operational-pillars-list .pillar-item.pillar-blue:hover .pillar-tag-blue .ks-wave-text,
    .pillar-tag-pill.pillar-tag-blue:hover .ks-wave-text,
    .lab-live-badge:hover .ks-wave-text,
    .graph-mode-btn:hover .ks-wave-text,
    .telemetry-fps:hover .ks-wave-text,
    #engineStateBadge:hover .ks-wave-text,
    #engineStateBadge:hover,
    .playlist-rotate-btn:hover .ks-wave-text,
    .playlist-count:hover .ks-wave-text,
    .visualizer-hud-overlay .track-info:hover .track-label,
    .visualizer-hud-overlay .track-info:hover .track-name,
    .playlist-track-row:hover .track-num,
    .playlist-track-row:hover .track-name-main,
    .playlist-track-row:hover .track-play-indicator,
    .album-details-link:hover .ks-wave-text,
    .intel-read-more:hover .ks-wave-text,
    .intel-carousel-nav-btn:hover .ks-wave-text {
      background-image: linear-gradient(
        90deg,
        #ffffff 0%,
        #ffffff 16%,
        #38bdf8 30%,
        #00f2fe 40%,
        #ffffff 52%,
        #38bdf8 68%,
        #00f2fe 78%,
        #ffffff 92%,
        #ffffff 100%
      ) !important;
      background-size: 220% auto !important;
      background-repeat: repeat !important;
      -webkit-background-clip: text !important;
      background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      color: transparent !important;
      animation: ksButtonWordWave 1.15s linear infinite !important;
    }

    /* Gold Button / Interior Pill Hover: Stays Black Background + White-to-Gold Wave Pulsating Through Letters */
    .btn-gold-subtle:hover,
    .btn-glass-secondary:hover,
    .footer-subscribe-btn-gold:hover,
    #kr-bottom-streaming-vault .kr-vault-play-pill:hover,
    #kr-bottom-streaming-vault .kr-vault-spotify-pill:hover,
    .badge-gold-builder:hover,
    .lab-freq-badge:hover,
    .pillar-tag-pill.pillar-tag-gold:hover,
    .track-hz-pill:hover,
    .album-stream-prompt:hover,
    .telemetry-hz:hover {
      background: #04070d !important;
      background-image: none !important;
      border-color: #f6d365 !important;
      box-shadow: 0 10px 26px rgba(0, 0, 0, 0.92), 0 0 22px rgba(212, 175, 55, 0.55) !important;
      transform: translateY(-1px) !important;
    }
    .btn-gold-subtle:hover .ks-wave-text,
    .btn-glass-secondary:hover .ks-wave-text,
    .footer-subscribe-btn-gold:hover .ks-wave-text,
    #kr-bottom-streaming-vault .kr-vault-play-pill:hover .ks-wave-text,
    #kr-bottom-streaming-vault .kr-vault-play-pill:hover span,
    #kr-bottom-streaming-vault .kr-vault-spotify-pill:hover .ks-wave-text,
    .triad-pill.triad-ai:hover .triad-title,
    .badge-gold-builder:hover .ks-wave-text,
    .lab-freq-badge:hover .ks-wave-text,
    .operational-pillars-list .pillar-item.pillar-gold:hover .pillar-title-row h4 .ks-wave-text,
    .operational-pillars-list .pillar-item.pillar-gold:hover .pillar-title-row h4,
    .operational-pillars-list .pillar-item.pillar-gold:hover .pillar-tag-gold .ks-wave-text,
    .pillar-tag-pill.pillar-tag-gold:hover .ks-wave-text,
    .track-hz-pill:hover .ks-wave-text,
    .playlist-track-row:hover .track-hz-pill .ks-wave-text,
    .playlist-track-row:hover .track-hz-pill,
    .album-stream-prompt:hover .ks-wave-text,
    .telemetry-hz:hover .ks-wave-text {
      background-image: linear-gradient(
        90deg,
        #ffffff 0%,
        #ffffff 16%,
        #f6d365 30%,
        #ffd700 40%,
        #ffffff 52%,
        #d4af37 68%,
        #ffd700 78%,
        #ffffff 92%,
        #ffffff 100%
      ) !important;
      background-size: 220% auto !important;
      background-repeat: repeat !important;
      -webkit-background-clip: text !important;
      background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      color: transparent !important;
      animation: ksButtonWordWave 1.15s linear infinite !important;
    }

    /* 8. Bottom Streaming Vault Minimize Button Circular Fix */
    #kr-bottom-streaming-vault .kr-vault-min-btn {
      width: 34px !important;
      height: 34px !important;
      min-width: 34px !important;
      max-width: 34px !important;
      flex: 0 0 34px !important;
      padding: 0 !important;
      border-radius: 50% !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      border: 1px solid rgba(56, 189, 248, 0.45) !important;
      background: #04070d !important;
      color: #ffffff !important;
    }
    #kr-bottom-streaming-vault .kr-vault-min-btn:hover {
      border-color: #d4af37 !important;
      color: #f6d365 !important;
    }

    @media (max-width: 980px) {
      .intro-split-grid,
      .albums-grid,
      .founder-triad-pills,
      .founder-card-inner {
        grid-template-columns: 1fr !important;
      }
      .company-ai-cta-row a,
      .sound-lab-controls #cyberPlayBtn,
      .music-lab-footer-link a,
      .footer-subscribe-btn {
        white-space: normal !important;
        height: auto !important;
        min-width: 0 !important;
        padding: 12px 18px !important;
      }
    }

    /* ==========================================================================
       9. PAGE 2 (/ai-protocols/) LAYOUT LEVELING, 2-COL PORTAL CARDS & BUTTON WAVE
       ========================================================================== */
    .protocols-hero {
      padding: 26px 0 34px 0 !important;
    }
    .protocols-hero-split {
      display: grid !important;
      grid-template-columns: 1.08fr 0.92fr !important;
      gap: 28px !important;
      align-items: stretch !important;
    }
    .protocols-hero-left {
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      height: 100% !important;
      background: linear-gradient(145deg, rgba(10, 16, 29, 0.92) 0%, rgba(4, 7, 13, 0.96) 100%) !important;
      border: 1.5px solid rgba(56, 189, 248, 0.35) !important;
      border-radius: 22px !important;
      padding: 22px 24px !important;
      box-sizing: border-box !important;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.78) !important;
    }
    .protocols-hero-right {
      display: flex !important;
      flex-direction: column !important;
      height: 100% !important;
    }
    .express-checkout-card {
      flex: 1 1 auto !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      height: 100% !important;
      padding: 22px 24px !important;
      border-radius: 22px !important;
      box-sizing: border-box !important;
      margin: 0 !important;
    }
    .protocols-hero-left .cyber-hero-title {
      font-size: clamp(1.62rem, 2.28vw, 2.12rem) !important;
      line-height: 1.16 !important;
      margin: 10px 0 10px 0 !important;
    }
    .protocols-hero-left .cyber-hero-subtitle {
      font-size: 0.90rem !important;
      line-height: 1.55 !important;
      color: #cbd5e1 !important;
      margin: 0 0 14px 0 !important;
    }
    .hero-tier-summary-box {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      padding: 12px 12px !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
      cursor: pointer !important;
    }
    .hero-tier-summary-box.hero-tier-blue:hover {
      border-color: #38bdf8 !important;
      box-shadow: 0 10px 26px rgba(0, 0, 0, 0.92), 0 0 20px rgba(56, 189, 248, 0.45) !important;
      transform: translateY(-2px) !important;
    }
    .hero-tier-summary-box.hero-tier-gold:hover {
      border-color: #f6d365 !important;
      box-shadow: 0 10px 26px rgba(0, 0, 0, 0.92), 0 0 20px rgba(212, 175, 55, 0.45) !important;
      transform: translateY(-2px) !important;
    }

    /* Section 2: Tier 01 Full-Width Level Split + Tiers 02 & 03 Side-by-Side Portal Grid */
    .protocols-showcase-section {
      padding: 36px 0 44px 0 !important;
    }
    .protocols-portal-grid-container {
      display: flex !important;
      flex-direction: column !important;
      gap: 28px !important;
    }
    .protocols-portal-grid-container::before,
    .protocols-portal-grid-container::after {
      display: none !important;
      content: none !important;
    }
    .portal-two-col-grid {
      display: grid !important;
      grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
      gap: 28px !important;
      align-items: stretch !important;
      width: 100% !important;
    }
    #tier-blueprint {
      width: 100% !important;
      margin-bottom: 0 !important;
      padding: 30px !important;
      border-radius: 22px !important;
      box-sizing: border-box !important;
    }
    #tier-blueprint .product-grid {
      display: grid !important;
      grid-template-columns: 1fr 1.1fr !important;
      gap: 30px !important;
      align-items: stretch !important;
    }
    #tier-blueprint .product-media-col,
    #tier-blueprint .product-info-col {
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      height: 100% !important;
      gap: 16px !important;
    }
    #tier-blueprint .video-preview-card {
      flex: 0 0 auto !important;
      display: flex !important;
      flex-direction: column !important;
      margin: 0 !important;
    }
    #tier-blueprint .video-card-meta {
      padding: 16px 18px !important;
    }
    .t1-media-highlights-grid {
      flex: 1 1 auto !important;
      display: grid !important;
      grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
      gap: 12px !important;
      align-items: stretch !important;
    }
    .t1-highlight-pill {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      border: 1.5px solid rgba(56, 189, 248, 0.58) !important;
      border-radius: 14px !important;
      padding: 13px 14px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      gap: 4px !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
      cursor: pointer !important;
    }
    .t1-highlight-pill.t1-pill-gold {
      border-color: rgba(212, 175, 55, 0.65) !important;
    }
    .t1-highlight-pill .t1-hl-tag {
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.62rem !important;
      font-weight: 800 !important;
      color: #ffffff !important;
      letter-spacing: 0.04em !important;
    }
    .t1-highlight-pill strong {
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.86rem !important;
      font-weight: 800 !important;
      color: #ffffff !important;
    }
    .t1-highlight-pill span:last-child {
      font-size: 0.74rem !important;
      line-height: 1.4 !important;
      color: #cbd5e1 !important;
    }
    .t1-highlight-pill.t1-pill-blue:hover {
      border-color: #38bdf8 !important;
      box-shadow: 0 8px 22px rgba(0, 0, 0, 0.9), 0 0 18px rgba(56, 189, 248, 0.45) !important;
      transform: translateY(-2px) !important;
    }
    .t1-highlight-pill.t1-pill-gold:hover {
      border-color: #f6d365 !important;
      box-shadow: 0 8px 22px rgba(0, 0, 0, 0.9), 0 0 18px rgba(212, 175, 55, 0.45) !important;
      transform: translateY(-2px) !important;
    }
    .t1-highlight-pill.t1-pill-blue:hover .t1-hl-tag,
    .t1-highlight-pill.t1-pill-blue:hover strong {
      background-image: linear-gradient(90deg, #ffffff 0%, #ffffff 16%, #38bdf8 30%, #00f2fe 40%, #ffffff 52%, #38bdf8 68%, #00f2fe 78%, #ffffff 92%, #ffffff 100%) !important;
      background-size: 220% auto !important;
      -webkit-background-clip: text !important;
      background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      color: transparent !important;
      animation: ksButtonWordWave 1.15s linear infinite !important;
    }
    .t1-highlight-pill.t1-pill-gold:hover .t1-hl-tag,
    .t1-highlight-pill.t1-pill-gold:hover strong {
      background-image: linear-gradient(90deg, #ffffff 0%, #ffffff 16%, #f6d365 30%, #ffd700 40%, #ffffff 52%, #d4af37 68%, #ffd700 78%, #ffffff 92%, #ffffff 100%) !important;
      background-size: 220% auto !important;
      -webkit-background-clip: text !important;
      background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      color: transparent !important;
      animation: ksButtonWordWave 1.15s linear infinite !important;
    }
    #tier-blueprint .product-deliverables-box {
      flex: 1 1 auto !important;
      margin-bottom: 16px !important;
    }
    #tier-blueprint .product-checkout-box {
      margin-top: auto !important;
      padding-top: 4px !important;
    }

    /* Tiers 02 ($199) & 03 ($800) Side-by-Side Portal Half Cards */
    #tier-swarm.portal-half-card,
    #tier-workstation.portal-half-card {
      margin-bottom: 0 !important;
      padding: 28px !important;
      border-radius: 22px !important;
      height: 100% !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      box-sizing: border-box !important;
    }
    #tier-swarm.portal-half-card .product-grid,
    #tier-workstation.portal-half-card .product-grid {
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      gap: 22px !important;
      flex: 1 1 auto !important;
      height: 100% !important;
    }
    #tier-swarm.portal-half-card .product-media-col,
    #tier-workstation.portal-half-card .product-media-col {
      width: 100% !important;
    }
    #tier-swarm.portal-half-card .video-preview-card,
    #tier-workstation.portal-half-card .video-preview-card {
      margin: 0 !important;
    }
    #tier-swarm.portal-half-card .video-card-meta,
    #tier-workstation.portal-half-card .video-card-meta {
      min-height: 108px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: center !important;
      padding: 16px 18px !important;
      box-sizing: border-box !important;
    }
    #tier-swarm.portal-half-card .product-info-col,
    #tier-workstation.portal-half-card .product-info-col {
      flex: 1 1 auto !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
    }
    #tier-swarm.portal-half-card .product-title,
    #tier-workstation.portal-half-card .product-title {
      font-size: 1.48rem !important;
      line-height: 1.24 !important;
      min-height: 3.7rem !important;
      margin: 10px 0 10px 0 !important;
    }
    #tier-swarm.portal-half-card .product-lead-copy,
    #tier-workstation.portal-half-card .product-lead-copy {
      font-size: 0.92rem !important;
      line-height: 1.58 !important;
      min-height: 5.8rem !important;
      margin-bottom: 16px !important;
    }
    #tier-swarm.portal-half-card .product-deliverables-box,
    #tier-workstation.portal-half-card .product-deliverables-box {
      flex: 1 1 auto !important;
      margin-bottom: 18px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: flex-start !important;
    }
    #tier-swarm.portal-half-card .product-checkout-box,
    #tier-workstation.portal-half-card .product-checkout-box {
      margin-top: auto !important;
      padding-top: 6px !important;
    }

    /* Section 3: Competitive Benchmark Matrix Leveling & Bottom Clearance (Moved Up Away From Bottom Line!) */
    .protocols-benchmark-section {
      padding: 28px 0 108px 0 !important;
      margin-bottom: 0 !important;
    }
    .competitive-matrix-card {
      padding: 36px 32px !important;
      margin: 0 0 24px 0 !important;
      border-radius: 22px !important;
      border: 1.5px solid rgba(212, 175, 55, 0.65) !important;
      background: linear-gradient(145deg, rgba(10, 16, 29, 0.95) 0%, rgba(4, 7, 13, 0.98) 100%) !important;
      box-shadow: 0 22px 55px rgba(0, 0, 0, 0.85) !important;
    }
    .competitive-matrix-card .matrix-grid {
      display: grid !important;
      grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
      gap: 20px !important;
      align-items: stretch !important;
      margin-top: 24px !important;
    }
    .competitive-matrix-card .matrix-col {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      border: 1.5px solid rgba(56, 189, 248, 0.58) !important;
      border-radius: 16px !important;
      padding: 22px 20px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: flex-start !important;
      height: 100% !important;
      box-sizing: border-box !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
      cursor: pointer !important;
    }
    .competitive-matrix-card .matrix-col.matrix-col-gold {
      border-color: rgba(212, 175, 55, 0.68) !important;
    }
    .competitive-matrix-card .matrix-col.matrix-col-blue:hover {
      border-color: #38bdf8 !important;
      box-shadow: 0 10px 26px rgba(0, 0, 0, 0.92), 0 0 22px rgba(56, 189, 248, 0.48) !important;
      transform: translateY(-2px) !important;
    }
    .competitive-matrix-card .matrix-col.matrix-col-gold:hover {
      border-color: #f6d365 !important;
      box-shadow: 0 10px 26px rgba(0, 0, 0, 0.92), 0 0 22px rgba(212, 175, 55, 0.48) !important;
      transform: translateY(-2px) !important;
    }
    .competitive-matrix-card .matrix-col h4 {
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.02rem !important;
      font-weight: 800 !important;
      margin: 0 0 10px 0 !important;
      line-height: 1.3 !important;
    }
    .competitive-matrix-card .matrix-col p {
      color: #cbd5e1 !important;
      font-size: 0.85rem !important;
      line-height: 1.56 !important;
      margin: 0 !important;
    }

    /* ALL PAGE 2 (/ai-protocols/) BUTTONS & PILLS: Pure Black Background + White Text + Pulsating Blue/Gold Wave */
    .btn-cyan-express-buy,
    .btn-cyan-buy,
    .btn-gold-buy,
    .btn-promo-apply,
    #applyPromoBtn,
    #verifyVaultUidBtn,
    .btn-vault-unlock-pill,
    #vaultUidStatusBadge,
    .checkout-badge-live,
    .badge-tier-cyan,
    .badge-discount-gold,
    .badge-capacity-alert,
    .matrix-tag,
    #submitAutomatedOrderBtn {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      border-radius: 9999px !important;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.82) !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
    }
    .btn-cyan-express-buy:not(.btn-gold-portal),
    .btn-cyan-buy,
    #verifyVaultUidBtn,
    .btn-vault-unlock-pill,
    #vaultUidStatusBadge,
    .badge-tier-cyan,
    #submitAutomatedOrderBtn {
      border: 1.5px solid rgba(56, 189, 248, 0.82) !important;
    }
    .btn-gold-buy,
    .btn-cyan-express-buy.btn-gold-portal,
    .btn-promo-apply,
    #applyPromoBtn,
    .checkout-badge-live,
    .badge-discount-gold,
    .badge-capacity-alert,
    .matrix-tag {
      border: 1.5px solid rgba(212, 175, 55, 0.85) !important;
    }
    .btn-cyan-express-buy,
    .btn-cyan-buy,
    .btn-gold-buy {
      min-height: 52px !important;
      padding: 12px 22px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.86rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.04em !important;
      text-transform: uppercase !important;
      box-sizing: border-box !important;
    }

    /* Tier Selector 3-Button Grid inside Express Checkout Card */
    .tier-select-btn {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      border: 1.5px solid rgba(56, 189, 248, 0.48) !important;
      border-radius: 14px !important;
      color: #ffffff !important;
      padding: 12px 10px !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
    }
    .tier-select-btn[data-tier="3"] {
      border-color: rgba(212, 175, 55, 0.55) !important;
    }
    .tier-select-btn.active {
      border-color: #38bdf8 !important;
      box-shadow: 0 0 18px rgba(56, 189, 248, 0.35) !important;
    }
    .tier-select-btn[data-tier="3"].active {
      border-color: #f6d365 !important;
      box-shadow: 0 0 18px rgba(212, 175, 55, 0.4) !important;
    }
    .tier-select-btn .btn-tier-num,
    .tier-select-btn .btn-tier-name,
    .tier-select-btn .btn-tier-price {
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      background-image: none !important;
      background-color: transparent !important;
    }

    /* Page 2 Blue Hover Wave */
    .btn-cyan-express-buy:not(.btn-gold-portal):hover,
    .btn-cyan-buy:hover,
    #verifyVaultUidBtn:hover,
    .btn-vault-unlock-pill:hover,
    #vaultUidStatusBadge:hover,
    .badge-tier-cyan:hover,
    #submitAutomatedOrderBtn:hover,
    .tier-select-btn[data-tier="1"]:hover,
    .tier-select-btn[data-tier="2"]:hover {
      background: #04070d !important;
      background-image: none !important;
      border-color: #38bdf8 !important;
      box-shadow: 0 10px 26px rgba(0, 0, 0, 0.92), 0 0 22px rgba(56, 189, 248, 0.55) !important;
      transform: translateY(-1px) !important;
    }
    .btn-cyan-express-buy:not(.btn-gold-portal):hover .ks-wave-text,
    .btn-cyan-buy:hover .ks-wave-text,
    #verifyVaultUidBtn:hover .ks-wave-text,
    .btn-vault-unlock-pill:hover .ks-wave-text,
    #vaultUidStatusBadge:hover .ks-wave-text,
    .badge-tier-cyan:hover .ks-wave-text,
    #submitAutomatedOrderBtn:hover .ks-wave-text,
    .tier-select-btn[data-tier="1"]:hover .btn-tier-num,
    .tier-select-btn[data-tier="1"]:hover .btn-tier-name,
    .tier-select-btn[data-tier="1"]:hover .btn-tier-price,
    .tier-select-btn[data-tier="2"]:hover .btn-tier-num,
    .tier-select-btn[data-tier="2"]:hover .btn-tier-name,
    .tier-select-btn[data-tier="2"]:hover .btn-tier-price,
    .hero-tier-summary-box.hero-tier-blue:hover .summary-tier-tag,
    .hero-tier-summary-box.hero-tier-blue:hover .summary-tier-heading,
    .competitive-matrix-card .matrix-col.matrix-col-blue:hover h4 .ks-wave-text,
    .competitive-matrix-card .matrix-col.matrix-col-blue:hover h4 {
      background-image: linear-gradient(
        90deg,
        #ffffff 0%,
        #ffffff 16%,
        #38bdf8 30%,
        #00f2fe 40%,
        #ffffff 52%,
        #38bdf8 68%,
        #00f2fe 78%,
        #ffffff 92%,
        #ffffff 100%
      ) !important;
      background-size: 220% auto !important;
      background-repeat: repeat !important;
      -webkit-background-clip: text !important;
      background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      color: transparent !important;
      animation: ksButtonWordWave 1.15s linear infinite !important;
    }

    /* Page 2 Gold Hover Wave */
    .btn-gold-buy:hover,
    .btn-cyan-express-buy.btn-gold-portal:hover,
    .btn-promo-apply:hover,
    #applyPromoBtn:hover,
    .checkout-badge-live:hover,
    .badge-discount-gold:hover,
    .badge-capacity-alert:hover,
    .matrix-tag:hover,
    .tier-select-btn[data-tier="3"]:hover {
      background: #04070d !important;
      background-image: none !important;
      border-color: #f6d365 !important;
      box-shadow: 0 10px 26px rgba(0, 0, 0, 0.92), 0 0 22px rgba(212, 175, 55, 0.55) !important;
      transform: translateY(-1px) !important;
    }
    .btn-gold-buy:hover .ks-wave-text,
    .btn-cyan-express-buy.btn-gold-portal:hover .ks-wave-text,
    .btn-promo-apply:hover .ks-wave-text,
    #applyPromoBtn:hover .ks-wave-text,
    .checkout-badge-live:hover .ks-wave-text,
    .badge-discount-gold:hover .ks-wave-text,
    .badge-capacity-alert:hover .ks-wave-text,
    .matrix-tag:hover .ks-wave-text,
    .tier-select-btn[data-tier="3"]:hover .btn-tier-num,
    .tier-select-btn[data-tier="3"]:hover .btn-tier-name,
    .tier-select-btn[data-tier="3"]:hover .btn-tier-price,
    .hero-tier-summary-box.hero-tier-gold:hover .summary-tier-tag,
    .hero-tier-summary-box.hero-tier-gold:hover .summary-tier-heading,
    .competitive-matrix-card .matrix-col.matrix-col-gold:hover h4 .ks-wave-text,
    .competitive-matrix-card .matrix-col.matrix-col-gold:hover h4 {
      background-image: linear-gradient(
        90deg,
        #ffffff 0%,
        #ffffff 16%,
        #f6d365 30%,
        #ffd700 40%,
        #ffffff 52%,
        #d4af37 68%,
        #ffd700 78%,
        #ffffff 92%,
        #ffffff 100%
      ) !important;
      background-size: 220% auto !important;
      background-repeat: repeat !important;
      -webkit-background-clip: text !important;
      background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      color: transparent !important;
      animation: ksButtonWordWave 1.15s linear infinite !important;
    }

    @media (max-width: 980px) {
      .protocols-hero-split,
      .portal-two-col-grid,
      #tier-blueprint .product-grid,
      .t1-media-highlights-grid,
      .competitive-matrix-card .matrix-grid,
      .hero-tier-summary-grid {
        grid-template-columns: 1fr !important;
      }
      #tier-swarm.portal-half-card .product-title,
      #tier-workstation.portal-half-card .product-title,
      #tier-swarm.portal-half-card .product-lead-copy,
      #tier-workstation.portal-half-card .product-lead-copy {
        min-height: 0 !important;
      }
    }
    /* ==========================================================================
     * 10. PAGE 3 (/intel-videos/ • home.php) & SINGLE POSTS (single.php):
     *     CLEAN THUMBNAILS, PARALLEL CARDS, SEGMENTED COMMAND DOCK PAGINATION,
     *     LONG-FORM (TOP 16:9) + SHORT-FORM (BOTTOM 9:16) & PURE-BLACK WAVE BUTTONS
     * ========================================================================== */
    .keystone-intel-archive .intel-archive-header {
      margin-bottom: 2.6rem !important;
      text-align: center !important;
      max-width: 920px !important;
      margin-left: auto !important;
      margin-right: auto !important;
    }
    .keystone-intel-archive .intel-telemetry-pill {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      gap: 8px !important;
      padding: 6px 16px !important;
      margin-bottom: 14px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.72rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.08em !important;
      cursor: pointer !important;
    }
    .keystone-intel-archive .archive-subtitle {
      max-width: 820px !important;
      margin: 12px auto 0 auto !important;
      color: #cbd5e1 !important;
      font-size: clamp(0.96rem, 1.25vw, 1.08rem) !important;
      line-height: 1.65 !important;
    }

    /* Featured Hero Containers (Top AI Blue & Bottom Sound Gold) */
    #recomp-featured-intel-container.recomp-featured-hero-wrap,
    #recomp-featured-sound-container.recomp-featured-hero-wrap {
      background: linear-gradient(145deg, rgba(8, 13, 24, 0.96) 0%, #04070d 100%) !important;
      border-radius: 24px !important;
      padding: 32px !important;
      margin-bottom: 3.25rem !important;
      box-shadow: 0 22px 55px rgba(0, 0, 0, 0.85) !important;
      position: relative !important;
      z-index: 2 !important;
      isolation: isolate !important;
    }
    #recomp-featured-intel-container.recomp-hero-blue {
      border: 1.5px solid rgba(56, 189, 248, 0.55) !important;
    }
    #recomp-featured-sound-container.recomp-hero-gold {
      border: 1.5px solid rgba(212, 175, 55, 0.62) !important;
    }
    .recomp-featured-layout {
      display: grid !important;
      grid-template-columns: 1.18fr 1fr !important;
      gap: 34px !important;
      align-items: stretch !important;
      width: 100% !important;
    }
    .recomp-featured-layout > p,
    #recomp-intel-grid > p,
    .recomp-blog-grid-section-wrap > p {
      display: none !important;
      margin: 0 !important;
      padding: 0 !important;
      height: 0 !important;
      width: 0 !important;
    }
    .recomp-featured-left-col {
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      gap: 16px !important;
      min-width: 0 !important;
      height: 100% !important;
    }
    .recomp-featured-video-frame {
      position: relative !important;
      width: 100% !important;
      aspect-ratio: 16 / 9 !important;
      border-radius: 16px !important;
      overflow: hidden !important;
      background: #000000 !important;
    }
    .recomp-featured-video-frame.recomp-frame-blue {
      border: 1.5px solid rgba(56, 189, 248, 0.45) !important;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8), 0 0 20px rgba(56, 189, 248, 0.14) !important;
    }
    .recomp-featured-video-frame.recomp-frame-gold {
      border: 1.5px solid rgba(212, 175, 55, 0.5) !important;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8), 0 0 20px rgba(212, 175, 55, 0.14) !important;
    }

    /* 9:16 Companion Short Deck */
    .recomp-featured-short-deck {
      background: #04070d !important;
      border-radius: 16px !important;
      padding: 16px 18px !important;
      display: flex !important;
      align-items: center !important;
      gap: 18px !important;
      margin-top: 0 !important;
      box-sizing: border-box !important;
    }
    .recomp-featured-short-deck.recomp-short-deck-blue {
      border: 1.5px solid rgba(56, 189, 248, 0.38) !important;
    }
    .recomp-featured-short-deck.recomp-short-deck-gold {
      border: 1.5px solid rgba(212, 175, 55, 0.44) !important;
    }
    .recomp-featured-short-player-box {
      position: relative !important;
      width: 118px !important;
      height: 210px !important;
      min-width: 118px !important;
      border-radius: 12px !important;
      overflow: hidden !important;
      background: #000000 !important;
      flex-shrink: 0 !important;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.75) !important;
    }
    .recomp-featured-short-player-box.recomp-short-box-blue {
      border: 1.5px solid rgba(56, 189, 248, 0.55) !important;
    }
    .recomp-featured-short-player-box.recomp-short-box-gold {
      border: 1.5px solid rgba(212, 175, 55, 0.6) !important;
    }
    .recomp-featured-short-details {
      flex: 1 1 auto !important;
      min-width: 0 !important;
      display: flex !important;
      flex-direction: column !important;
      align-items: flex-start !important;
    }
    .recomp-short-kicker-pill {
      padding: 3px 10px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.66rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.06em !important;
      margin-bottom: 8px !important;
    }
    .recomp-featured-short-title {
      margin: 0 0 6px 0 !important;
      color: #ffffff !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.0rem !important;
      font-weight: 800 !important;
      line-height: 1.3 !important;
    }
    .recomp-featured-short-desc {
      margin: 0 0 12px 0 !important;
      color: #cbd5e1 !important;
      font-size: 0.80rem !important;
      line-height: 1.48 !important;
    }
    .recomp-featured-short-actions {
      display: flex !important;
      gap: 8px !important;
      align-items: center !important;
      flex-wrap: wrap !important;
    }
    .recomp-short-action-btn {
      padding: 7px 14px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.76rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.03em !important;
      text-decoration: none !important;
    }

    /* Featured Hero Right Column (Parallel Leveling with Left Column) */
    .recomp-featured-content-wrap {
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      min-width: 0 !important;
      height: 100% !important;
      box-sizing: border-box !important;
    }
    .recomp-featured-top-body {
      display: flex !important;
      flex-direction: column !important;
    }
    .recomp-featured-meta-row {
      display: flex !important;
      align-items: center !important;
      gap: 10px !important;
      margin-bottom: 14px !important;
      flex-wrap: wrap !important;
    }
    .recomp-cat-badge {
      padding: 4px 12px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.70rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      text-transform: uppercase !important;
    }
    .recomp-meta-date {
      color: #94a3b8 !important;
      font-size: 0.82rem !important;
      font-weight: 700 !important;
    }
    .recomp-meta-read-pill {
      padding: 3px 10px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.70rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
    }
    .recomp-featured-h2 {
      font-family: 'Outfit', sans-serif !important;
      font-size: clamp(1.45rem, 2.1vw, 1.9rem) !important;
      font-weight: 900 !important;
      line-height: 1.24 !important;
      color: #ffffff !important;
      margin: 0 0 14px 0 !important;
      letter-spacing: -0.01em !important;
    }
    .recomp-featured-excerpt {
      font-size: 0.95rem !important;
      color: #cbd5e1 !important;
      line-height: 1.68 !important;
      margin: 0 0 18px 0 !important;
    }
    .recomp-featured-bottom-footer {
      margin-top: auto !important;
      display: flex !important;
      flex-direction: column !important;
      gap: 16px !important;
      width: 100% !important;
    }
    .recomp-author-row {
      display: flex !important;
      align-items: center !important;
      gap: 12px !important;
      padding: 14px 0 !important;
      border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    .recomp-author-avatar {
      width: 48px !important;
      height: 48px !important;
      border-radius: 50% !important;
      object-fit: cover !important;
      flex-shrink: 0 !important;
    }
    .recomp-avatar-blue {
      border: 2px solid #38bdf8 !important;
      box-shadow: 0 0 12px rgba(56, 189, 248, 0.35) !important;
    }
    .recomp-avatar-gold {
      border: 2px solid #d4af37 !important;
      box-shadow: 0 0 12px rgba(212, 175, 55, 0.38) !important;
    }
    .recomp-author-name {
      color: #ffffff !important;
      font-weight: 800 !important;
      font-size: 0.94rem !important;
      line-height: 1.2 !important;
    }
    .recomp-author-role {
      font-size: 0.78rem !important;
      font-weight: 600 !important;
      margin-top: 2px !important;
    }
    .recomp-role-blue {
      color: #38bdf8 !important;
    }
    .recomp-role-gold {
      color: #f6d365 !important;
    }
    .recomp-featured-buttons-box {
      display: flex !important;
      flex-direction: column !important;
      gap: 10px !important;
      width: 100% !important;
      max-width: 100% !important;
    }
    .recomp-hero-cta-btn {
      width: 100% !important;
      min-height: 46px !important;
      height: 46px !important;
      padding: 0 22px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.84rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      text-transform: uppercase !important;
      text-decoration: none !important;
      box-sizing: border-box !important;
    }

    /* Section 3: Archive Grid Header & Segmented Command Dock Pagination (Top & Bottom) */
    .recomp-blog-grid-section-wrap {
      margin-top: 2.25rem !important;
      padding-bottom: 24px !important;
    }
    .recomp-grid-header-row {
      display: flex !important;
      justify-content: space-between !important;
      align-items: center !important;
      flex-wrap: wrap !important;
      gap: 18px !important;
      margin-bottom: 2rem !important;
      padding-bottom: 1.25rem !important;
      border-bottom: 1px solid rgba(56, 189, 248, 0.28) !important;
    }
    .recomp-grid-kicker {
      color: #38bdf8 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.74rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.12em !important;
      text-transform: uppercase !important;
      margin-bottom: 4px !important;
    }
    .recomp-grid-heading {
      font-family: 'Outfit', sans-serif !important;
      font-size: clamp(1.3rem, 2.2vw, 1.7rem) !important;
      font-weight: 800 !important;
      color: #ffffff !important;
      margin: 0 !important;
      line-height: 1.22 !important;
    }
    .recomp-grid-controls-top {
      display: flex !important;
      align-items: center !important;
      gap: 12px !important;
      flex-wrap: wrap !important;
    }
    .recomp-page-telemetry-pill {
      padding: 7px 14px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.72rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.06em !important;
    }

    /* High-End Obsidian & Gold/Cyan Segmented Command Dock */
    .recomp-command-dock {
      display: inline-flex !important;
      align-items: center !important;
      gap: 8px !important;
      padding: 6px !important;
      border-radius: 9999px !important;
      background: rgba(6, 10, 19, 0.96) !important;
      border: 1.5px solid rgba(56, 189, 248, 0.45) !important;
      box-shadow: 0 14px 34px rgba(0, 0, 0, 0.88), 0 0 22px rgba(56, 189, 248, 0.14) !important;
      box-sizing: border-box !important;
    }
    .recomp-dock-top .recomp-dock-btn {
      height: 38px !important;
      min-height: 38px !important;
      min-width: 102px !important;
      padding: 0 15px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.76rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      cursor: pointer !important;
      box-sizing: border-box !important;
    }
    .recomp-pagination-bottom {
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
      margin: 2.25rem 0 5.5rem 0 !important;
      width: 100% !important;
    }
    .recomp-dock-bottom {
      padding: 8px !important;
      gap: 10px !important;
      border-color: rgba(212, 175, 55, 0.55) !important;
    }
    .recomp-dock-bottom .recomp-dock-bottom-btn {
      width: 172px !important;
      min-width: 172px !important;
      max-width: 172px !important;
      height: 44px !important;
      min-height: 44px !important;
      padding: 0 16px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.80rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      cursor: pointer !important;
      box-sizing: border-box !important;
    }

    /* 2x3 Chronological Technical Intel Cards (Clean Thumbnails & Equal Parallel Leveling) */
    #recomp-intel-grid {
      display: grid !important;
      grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
      gap: 26px !important;
      align-items: stretch !important;
      margin-bottom: 1.5rem !important;
    }
    .recomp-grid-card {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      border: 1.5px solid rgba(56, 189, 248, 0.42) !important;
      border-radius: 18px !important;
      padding: 20px !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      height: 100% !important;
      box-sizing: border-box !important;
      box-shadow: 0 14px 32px rgba(0, 0, 0, 0.78) !important;
      cursor: pointer !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
    }
    .recomp-grid-card:hover {
      transform: translateY(-4px) !important;
      border-color: #38bdf8 !important;
      box-shadow: 0 18px 40px rgba(0, 0, 0, 0.92), 0 0 24px rgba(56, 189, 248, 0.35) !important;
    }
    .recomp-card-top-body {
      display: flex !important;
      flex-direction: column !important;
      flex: 1 1 auto !important;
    }
    .recomp-card-thumb-frame {
      position: relative !important;
      width: 100% !important;
      aspect-ratio: 16 / 9 !important;
      border-radius: 12px !important;
      overflow: hidden !important;
      margin-bottom: 16px !important;
      background: #000000 !important;
      border: 1px solid rgba(56, 189, 248, 0.3) !important;
    }
    .recomp-card-thumb-img {
      position: absolute !important;
      top: 0 !important;
      left: 0 !important;
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
      display: block !important;
      transition: transform 0.35s ease !important;
    }
    .recomp-grid-card:hover .recomp-card-thumb-img {
      transform: scale(1.03) !important;
    }
    .recomp-card-meta-row {
      display: flex !important;
      justify-content: space-between !important;
      align-items: center !important;
      gap: 8px !important;
      margin-bottom: 10px !important;
    }
    .recomp-category-badge {
      padding: 3px 10px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.68rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.04em !important;
    }
    .recomp-card-date-label {
      color: #94a3b8 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.70rem !important;
      font-weight: 700 !important;
      letter-spacing: 0.05em !important;
    }
    .recomp-card-title {
      margin: 0 0 10px 0 !important;
      color: #ffffff !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.12rem !important;
      font-weight: 800 !important;
      line-height: 1.34 !important;
      min-height: 3.0rem !important;
      display: -webkit-box !important;
      -webkit-line-clamp: 2 !important;
      -webkit-box-orient: vertical !important;
      overflow: hidden !important;
    }
    .recomp-card-excerpt {
      margin: 0 0 16px 0 !important;
      color: #cbd5e1 !important;
      font-size: 0.86rem !important;
      line-height: 1.56 !important;
      min-height: 4.05rem !important;
      display: -webkit-box !important;
      -webkit-line-clamp: 3 !important;
      -webkit-box-orient: vertical !important;
      overflow: hidden !important;
    }
    .recomp-card-footer {
      display: flex !important;
      justify-content: space-between !important;
      align-items: center !important;
      gap: 10px !important;
      border-top: 1px solid rgba(56, 189, 248, 0.2) !important;
      padding-top: 14px !important;
      margin-top: auto !important;
    }
    .recomp-card-read-btn {
      height: 36px !important;
      min-height: 36px !important;
      padding: 0 14px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.78rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.03em !important;
    }
    .recomp-card-readtime-pill {
      height: 36px !important;
      min-height: 36px !important;
      padding: 0 12px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.68rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
    }

    /* Single Post (single.php) 16:9 Top Long-Form Frame & 9:16 Bottom Vertical Short Frame */
    .ks-single-long-video-frame,
    body.single-post .watch-theater-embed {
      position: relative !important;
      width: 100% !important;
      max-width: 940px !important;
      aspect-ratio: 16 / 9 !important;
      margin: 0 auto 26px auto !important;
      border-radius: 18px !important;
      overflow: hidden !important;
      border: 1.5px solid rgba(56, 189, 248, 0.55) !important;
      box-shadow: 0 18px 45px rgba(0, 0, 0, 0.85), 0 0 24px rgba(56, 189, 248, 0.16) !important;
      background: #000000 !important;
    }
    .ks-single-long-video-frame iframe,
    body.single-post .watch-theater-embed iframe {
      position: absolute !important;
      top: 0 !important;
      left: 0 !important;
      width: 100% !important;
      height: 100% !important;
      border: 0 !important;
    }
    .ks-single-short-9x16-frame {
      position: relative !important;
      width: 315px !important;
      height: 560px !important;
      max-width: 100% !important;
      margin: 0 auto !important;
      border-radius: 18px !important;
      overflow: hidden !important;
      border: 2px solid #d4af37 !important;
      box-shadow: 0 14px 36px rgba(0, 0, 0, 0.88), 0 0 22px rgba(56, 189, 248, 0.25) !important;
      background: #04070d !important;
    }

    /* Page 3 & Single Post Unified Pure-Black (#04070d) Button & Pill Base + Hover Pulsating Wave */
    .ks-p3-btn-blue,
    .ks-p3-btn-gold,
    .ks-p3-pill-blue,
    .ks-p3-pill-gold {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      border-radius: 9999px !important;
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.82) !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
    }
    .ks-p3-btn-blue,
    .ks-p3-pill-blue {
      border: 1.5px solid rgba(56, 189, 248, 0.78) !important;
    }
    .ks-p3-btn-gold,
    .ks-p3-pill-gold {
      border: 1.5px solid rgba(212, 175, 55, 0.85) !important;
    }
    .recomp-dock-btn.is-active {
      border: 1.5px solid #f6d365 !important;
      box-shadow: 0 0 18px rgba(212, 175, 55, 0.45) !important;
    }
    .ks-p3-btn-blue .ks-wave-text,
    .ks-p3-btn-gold .ks-wave-text,
    .ks-p3-pill-blue .ks-wave-text,
    .ks-p3-pill-gold .ks-wave-text {
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
      background-image: none !important;
      background-color: transparent !important;
      animation: none !important;
      display: inline-block !important;
    }
    .ks-p3-btn-blue:hover,
    .ks-p3-pill-blue:hover,
    .recomp-grid-card:hover .recomp-card-read-btn {
      background: #04070d !important;
      background-image: none !important;
      border-color: #38bdf8 !important;
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.92), 0 0 22px rgba(56, 189, 248, 0.55) !important;
      transform: translateY(-1px) !important;
    }
    .ks-p3-btn-gold:hover,
    .ks-p3-pill-gold:hover,
    .recomp-grid-card:hover .recomp-card-readtime-pill {
      background: #04070d !important;
      background-image: none !important;
      border-color: #f6d365 !important;
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.92), 0 0 22px rgba(212, 175, 55, 0.55) !important;
      transform: translateY(-1px) !important;
    }
    .ks-p3-btn-blue:hover .ks-wave-text,
    .ks-p3-pill-blue:hover .ks-wave-text,
    .recomp-grid-card:hover .recomp-card-read-btn .ks-wave-text,
    .recomp-grid-card:hover .recomp-category-badge .ks-wave-text {
      background-image: linear-gradient(
        90deg,
        #ffffff 0%,
        #ffffff 16%,
        #38bdf8 30%,
        #00f2fe 40%,
        #ffffff 52%,
        #38bdf8 68%,
        #00f2fe 78%,
        #ffffff 92%,
        #ffffff 100%
      ) !important;
      background-size: 220% auto !important;
      background-repeat: repeat !important;
      -webkit-background-clip: text !important;
      background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      color: transparent !important;
      animation: ksButtonWordWave 1.15s linear infinite !important;
    }
    .ks-p3-btn-gold:hover .ks-wave-text,
    .ks-p3-pill-gold:hover .ks-wave-text,
    .recomp-grid-card:hover .recomp-card-readtime-pill .ks-wave-text {
      background-image: linear-gradient(
        90deg,
        #ffffff 0%,
        #ffffff 16%,
        #f6d365 30%,
        #ffd700 40%,
        #ffffff 52%,
        #d4af37 68%,
        #ffd700 78%,
        #ffffff 92%,
        #ffffff 100%
      ) !important;
      background-size: 220% auto !important;
      background-repeat: repeat !important;
      -webkit-background-clip: text !important;
      background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      color: transparent !important;
      animation: ksButtonWordWave 1.15s linear infinite !important;
    }

    @media (max-width: 1080px) {
      #recomp-intel-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
      }
      .recomp-featured-layout {
        grid-template-columns: 1fr !important;
      }
    }
    @media (max-width: 720px) {
      #recomp-intel-grid {
        grid-template-columns: 1fr !important;
      }
      .recomp-command-dock {
        flex-wrap: wrap !important;
        border-radius: 20px !important;
        justify-content: center !important;
      }
      .recomp-dock-bottom .recomp-dock-bottom-btn {
        width: calc(50% - 6px) !important;
        min-width: 135px !important;
      }
    }
    
    /* ==========================================================================
     * 11. PAGE 4 (/sonic-universe/ • template-sonic-universe.php):
     *     AUTO-LOADED 16:9 + 9:16 MUSIC HERO, 432HZ GRAPH WAVE TOOLBAR,
     *     100% CLEAN 1:1 ALBUM COVERS, PROTECTED UPC/ISRC METADATA,
     *     EQUAL-HEIGHT ALBUM CARDS & SEGMENTED COMMAND DOCK PAGINATION
     * ========================================================================== */
    .recomp-dock-btn,
    .recomp-dock-btn.sonic-page-num-btn,
    .recomp-dock-btn .ks-wave-text {
      width: auto !important;
      height: auto !important;
      white-space: nowrap !important;
    }
    .recomp-dock-top .recomp-dock-btn.sonic-page-num-btn {
      min-width: 114px !important;
      padding: 8px 18px !important;
    }
    .recomp-dock-bottom .recomp-dock-btn.sonic-page-num-btn {
      min-width: 148px !important;
      padding: 11px 22px !important;
    }
    .keystone-sonic-universe-page .sonic-hero-section {
      padding: 36px 0 18px 0 !important;
      text-align: center !important;
    }
    .keystone-sonic-universe-page .su-dsp-action-grid {
      display: grid !important;
      grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
      gap: 14px !important;
      max-width: 1020px !important;
      margin: 24px auto 0 auto !important;
      align-items: stretch !important;
    }
    .keystone-sonic-universe-page .su-dsp-action-grid > p {
      display: none !important;
    }
    .keystone-sonic-universe-page .su-dsp-btn {
      width: 100% !important;
      min-height: 48px !important;
      height: 48px !important;
      padding: 0 18px !important;
      border-radius: 9999px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.76rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      text-transform: uppercase !important;
      text-decoration: none !important;
      white-space: nowrap !important;
      box-sizing: border-box !important;
    }

    /* Section 1B: Featured Music Video Card on /sonic-universe/ (#su-featured-sound-container) */
    #su-featured-sound-container.recomp-featured-hero-wrap {
      background: linear-gradient(145deg, rgba(8, 13, 24, 0.96) 0%, #04070d 100%) !important;
      border: 1.5px solid rgba(212, 175, 55, 0.62) !important;
      border-radius: 24px !important;
      padding: 32px !important;
      margin-bottom: 1.5rem !important;
      box-shadow: 0 22px 55px rgba(0, 0, 0, 0.85) !important;
      position: relative !important;
      z-index: 2 !important;
      isolation: isolate !important;
    }

    /* Section 2: 432Hz Music Graph Card & Toolbar Buttons */
    .keystone-sonic-universe-page #sonicUniverseGraphCard {
      background: linear-gradient(145deg, rgba(8, 13, 24, 0.96) 0%, #04070d 100%) !important;
      border: 1.5px solid rgba(56, 189, 248, 0.45) !important;
      border-radius: 22px !important;
      padding: 24px !important;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.85) !important;
    }
    .keystone-sonic-universe-page .music-graph-toolbar {
      display: flex !important;
      flex-direction: column !important;
      align-items: flex-start !important;
      gap: 10px !important;
      margin-bottom: 16px !important;
    }
    .keystone-sonic-universe-page .graph-mode-pills,
    .keystone-sonic-universe-page .graph-preset-pills {
      display: flex !important;
      align-items: center !important;
      gap: 8px !important;
      flex-wrap: wrap !important;
    }
    .keystone-sonic-universe-page .su-mode-btn,
    .keystone-sonic-universe-page .su-preset-chip,
    .keystone-sonic-universe-page .su-graph-play-pill {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      color: #ffffff !important;
      padding: 8px 16px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.72rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      white-space: nowrap !important;
      cursor: pointer !important;
    }
    .keystone-sonic-universe-page .graph-mode-btn.su-mode-btn.active,
    .keystone-sonic-universe-page .su-preset-chip.active {
      background: #04070d !important;
      background-color: #04070d !important;
      background-image: none !important;
      color: #ffffff !important;
      border: 1.5px solid #f6d365 !important;
      box-shadow: 0 0 16px rgba(212, 175, 55, 0.38) !important;
    }
    .keystone-sonic-universe-page .visualizer-hud-overlay {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 16px !important;
      margin-top: 14px !important;
      padding-top: 14px !important;
      border-top: 1px solid rgba(56, 189, 248, 0.22) !important;
      flex-wrap: wrap !important;
    }
    .keystone-sonic-universe-page .visualizer-hud-overlay .track-info {
      background: #04070d !important;
      border: 1.5px solid rgba(56, 189, 248, 0.45) !important;
      border-radius: 9999px !important;
      padding: 8px 18px !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 8px !important;
      flex: 1 1 auto !important;
    }

    /* Section 3: 22-Album Catalog Grid — 100% Clean 1:1 Cover Art, Protected Metadata, Equal-Height Cards */
    .keystone-sonic-universe-page #sonicAlbumGrid.discography-grid-18 {
      display: grid !important;
      grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
      gap: 26px !important;
      align-items: stretch !important;
      width: 100% !important;
    }
    .keystone-sonic-universe-page #sonicAlbumGrid > p {
      display: none !important;
    }
    .keystone-sonic-universe-page .album-card-18.su-clean-album-card {
      background: #04070d !important;
      background-color: #04070d !important;
      border: 1.5px solid rgba(56, 189, 248, 0.42) !important;
      border-radius: 18px !important;
      padding: 18px !important;
      display: flex;
      flex-direction: column !important;
      justify-content: space-between !important;
      height: 100% !important;
      box-sizing: border-box !important;
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.82) !important;
      transition: transform 0.24s ease, border-color 0.24s ease, box-shadow 0.24s ease !important;
      cursor: pointer !important;
      overflow: hidden !important;
    }
    .keystone-sonic-universe-page .album-card-18.su-clean-album-card[style*="display: none"],
    .keystone-sonic-universe-page .album-card-18.su-clean-album-card[style*="display:none"] {
      display: none !important;
    }
    .keystone-sonic-universe-page .album-card-18.su-clean-album-card:hover {
      transform: translateY(-4px) !important;
      border-color: #38bdf8 !important;
      box-shadow: 0 22px 48px rgba(0, 0, 0, 0.92), 0 0 24px rgba(56, 189, 248, 0.28) !important;
    }
    .keystone-sonic-universe-page .album-card-art.su-clean-art-frame {
      position: relative !important;
      width: 100% !important;
      aspect-ratio: 1 / 1 !important;
      border-radius: 14px !important;
      overflow: hidden !important;
      background: #020408 !important;
      border: 1px solid rgba(255, 255, 255, 0.10) !important;
      margin-bottom: 16px !important;
      flex-shrink: 0 !important;
    }
    .keystone-sonic-universe-page .album-card-art.su-clean-art-frame img {
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
      display: block !important;
      transition: transform 0.35s ease !important;
    }
    .keystone-sonic-universe-page .album-card-18.su-clean-album-card:hover .su-clean-art-frame img {
      transform: scale(1.03) !important;
    }
    /* Ensure zero top badges or center overlays ever appear on the 1:1 album cover art */
    .keystone-sonic-universe-page .album-card-art .art-badge-year,
    .keystone-sonic-universe-page .album-card-art .art-badge-tracks,
    .keystone-sonic-universe-page .album-card-art .art-play-overlay {
      display: none !important;
    }
    .keystone-sonic-universe-page .album-card-details.su-clean-card-body {
      flex: 1 1 auto !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      padding: 0 !important;
      background: transparent !important;
      text-align: left !important;
    }
    .keystone-sonic-universe-page .su-card-top-info {
      margin-bottom: 14px !important;
    }
    .keystone-sonic-universe-page .su-genre-year-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 8px !important;
      margin-bottom: 10px !important;
    }
    .keystone-sonic-universe-page .su-genre-pill {
      padding: 4px 11px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.65rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      text-transform: uppercase !important;
      white-space: nowrap !important;
      max-width: calc(100% - 48px) !important;
      overflow: hidden !important;
      text-overflow: ellipsis !important;
    }
    .keystone-sonic-universe-page .su-release-year-label {
      color: #94a3b8 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.72rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.04em !important;
      flex-shrink: 0 !important;
    }
    .keystone-sonic-universe-page .album-title.su-clean-album-title {
      margin: 0 !important;
      color: #ffffff !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.18rem !important;
      font-weight: 800 !important;
      line-height: 1.3 !important;
      min-height: 1.5em !important;
      display: -webkit-box !important;
      -webkit-line-clamp: 1 !important;
      -webkit-box-orient: vertical !important;
      overflow: hidden !important;
    }
    .keystone-sonic-universe-page .su-card-bottom-footer {
      margin-top: auto !important;
      display: flex !important;
      flex-direction: column !important;
      gap: 12px !important;
    }
    .keystone-sonic-universe-page .album-metadata-row.su-clean-meta-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 8px !important;
      margin: 0 !important;
      padding-top: 12px !important;
      border-top: 1px solid rgba(56, 189, 248, 0.18) !important;
    }
    .keystone-sonic-universe-page .su-meta-chip {
      padding: 5px 12px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.67rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      white-space: nowrap !important;
    }
    .keystone-sonic-universe-page .album-actions-bar {
      width: 100% !important;
      margin: 0 !important;
    }
    .keystone-sonic-universe-page .btn-open-album-modal.su-stream-card-btn {
      width: 100% !important;
      min-height: 44px !important;
      height: 44px !important;
      margin: 0 !important;
      padding: 0 18px !important;
      border-radius: 9999px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.78rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.04em !important;
      text-transform: uppercase !important;
      cursor: pointer !important;
    }
    .keystone-sonic-universe-page .album-card-18.su-clean-album-card:hover .su-stream-card-btn {
      border-color: #38bdf8 !important;
      box-shadow: 0 8px 22px rgba(0, 0, 0, 0.9), 0 0 18px rgba(56, 189, 248, 0.48) !important;
    }
    .keystone-sonic-universe-page .album-card-18.su-clean-album-card:hover .su-stream-card-btn .ks-wave-text,
    .keystone-sonic-universe-page .album-card-18.su-clean-album-card:hover .su-genre-pill .ks-wave-text {
      background-image: linear-gradient(
        90deg,
        #ffffff 0%,
        #ffffff 16%,
        #38bdf8 30%,
        #00f2fe 40%,
        #ffffff 52%,
        #38bdf8 68%,
        #00f2fe 78%,
        #ffffff 92%,
        #ffffff 100%
      ) !important;
      background-size: 220% auto !important;
      background-repeat: repeat !important;
      -webkit-background-clip: text !important;
      background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      color: transparent !important;
      animation: ksButtonWordWave 1.15s linear infinite !important;
    }

    @media (max-width: 1080px) {
      .keystone-sonic-universe-page #sonicAlbumGrid.discography-grid-18 {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
      }
      .keystone-sonic-universe-page .su-dsp-action-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
      }
    }
    @media (max-width: 720px) {
      .keystone-sonic-universe-page #sonicAlbumGrid.discography-grid-18,
      .keystone-sonic-universe-page .su-dsp-action-grid {
        grid-template-columns: 1fr !important;
      }
    }
    

    /* ==========================================================================
     * 12. PAGE 5 (/investments/ • template-investments.php):
     *     EQUAL-HEIGHT 3 PILLAR CARDS, 4 QUANT & 4 FIDUCIARY PRINCIPLE CARDS,
     *     2 AESTHETIC BUSINESS CARDS & REVAMPED EXECUTIVE GATEWAY PORTAL
     * ========================================================================== */
    .keystone-investments-page .investments-hero-header {
      padding: 28px 0 24px 0 !important;
      text-align: center !important;
      max-width: 980px !important;
      margin: 0 auto 24px auto !important;
    }
    .keystone-investments-page .text-center,
    .keystone-investments-page .spotlight-header,
    .keystone-investments-page .pillars-section-intro,
    .keystone-investments-page .business-header,
    .keystone-investments-page .risk-card-header {
      text-align: center !important;
    }
    .keystone-investments-page .inv-hero-top-pill,
    .keystone-investments-page .inv-section-kicker,
    .keystone-investments-page .inv-cluster-pill,
    .keystone-investments-page .inv-notice-pill {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      height: 34px !important;
      min-height: 34px !important;
      padding: 0 18px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.71rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.07em !important;
      line-height: 1 !important;
      text-transform: uppercase !important;
      box-sizing: border-box !important;
    }
    .keystone-investments-page .hero-badge-row .ks-wave-text,
    .keystone-investments-page .inv-hero-top-pill .ks-wave-text,
    .keystone-investments-page .inv-section-kicker .ks-wave-text,
    .keystone-investments-page .inv-cluster-pill .ks-wave-text,
    .keystone-investments-page .inv-notice-pill .ks-wave-text {
      height: auto !important;
      min-height: 0 !important;
      padding: 0 !important;
      margin: 0 !important;
      line-height: 1.15 !important;
      display: inline-block !important;
    }
    .keystone-investments-page .investments-main-title {
      margin: 14px 0 12px 0 !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: clamp(2.1rem, 3.6vw, 3.05rem) !important;
      font-weight: 900 !important;
      line-height: 1.15 !important;
      color: #ffffff !important;
    }
    .keystone-investments-page .investments-hero-subtitle {
      max-width: 840px !important;
      margin: 0 auto 24px auto !important;
      color: #cbd5e1 !important;
      font-size: 0.98rem !important;
      line-height: 1.65 !important;
    }
    .keystone-investments-page .inv-hero-quicknav-grid {
      display: grid !important;
      grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
      gap: 14px !important;
      max-width: 980px !important;
      margin: 0 auto !important;
      align-items: stretch !important;
    }
    .keystone-investments-page .inv-hero-quicknav-grid > p {
      display: none !important;
    }
    .keystone-investments-page .inv-quicknav-btn {
      width: 100% !important;
      min-height: 46px !important;
      height: 46px !important;
      padding: 0 16px !important;
      border-radius: 9999px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.76rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.04em !important;
      text-transform: uppercase !important;
      text-decoration: none !important;
      white-space: nowrap !important;
      box-sizing: border-box !important;
    }

    /* Section 2: Top Quantitative Spotlight Card & 4 Equal Principle Cards */
    .keystone-investments-page .investments-spotlight-card {
      background: linear-gradient(145deg, rgba(8, 13, 24, 0.96) 0%, #04070d 100%) !important;
      border: 1.5px solid rgba(56, 189, 248, 0.48) !important;
      border-radius: 24px !important;
      padding: 36px 32px !important;
      margin: 18px 0 52px 0 !important;
      box-shadow: 0 22px 55px rgba(0, 0, 0, 0.85) !important;
    }
    .keystone-investments-page .spotlight-title,
    .keystone-investments-page .pillars-section-title,
    .keystone-investments-page .business-title,
    .keystone-investments-page .risk-section-title {
      font-family: 'Outfit', sans-serif !important;
      font-size: clamp(1.75rem, 2.7vw, 2.35rem) !important;
      font-weight: 900 !important;
      line-height: 1.2 !important;
      color: #ffffff !important;
      margin: 12px 0 12px 0 !important;
      text-align: center !important;
    }
    .keystone-investments-page .spotlight-subtitle,
    .keystone-investments-page .pillars-section-desc,
    .keystone-investments-page .business-subtitle,
    .keystone-investments-page .risk-section-desc {
      max-width: 820px !important;
      margin: 0 auto 24px auto !important;
      color: #cbd5e1 !important;
      font-size: 0.94rem !important;
      line-height: 1.62 !important;
      text-align: center !important;
    }
    .keystone-investments-page .inv-clean-spotlight-frame {
      border-radius: 18px !important;
      overflow: hidden !important;
      border: 1.5px solid rgba(56, 189, 248, 0.38) !important;
      margin: 24px 0 28px 0 !important;
      background: #020408 !important;
    }
    .keystone-investments-page .inv-quant-4grid,
    .keystone-investments-page .inv-risk-4grid {
      display: grid !important;
      grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
      gap: 18px !important;
      align-items: stretch !important;
      margin: 24px 0 0 0 !important;
    }
    .keystone-investments-page .inv-quant-4grid > p,
    .keystone-investments-page .inv-risk-4grid > p {
      display: none !important;
    }
    .keystone-investments-page .inv-equal-principle-card {
      background: #04070d !important;
      background-color: #04070d !important;
      border: 1.5px solid rgba(56, 189, 248, 0.38) !important;
      border-radius: 18px !important;
      padding: 22px 18px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: flex-start !important;
      text-align: left !important;
      height: 100% !important;
      box-sizing: border-box !important;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.78) !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
    }
    .keystone-investments-page .inv-equal-principle-card:hover {
      transform: none !important;
      border-color: #38bdf8 !important;
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.9), 0 0 20px rgba(56, 189, 248, 0.28) !important;
    }
    .keystone-investments-page .inv-principle-top-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 8px !important;
      margin-bottom: 14px !important;
      width: 100% !important;
    }
    .keystone-investments-page .inv-mini-tag {
      padding: 4px 11px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.64rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.06em !important;
    }
    .keystone-investments-page .inv-principle-icon {
      font-size: 1.35rem !important;
      line-height: 1 !important;
    }
    .keystone-investments-page .inv-equal-principle-card h4 {
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.02rem !important;
      font-weight: 800 !important;
      color: #ffffff !important;
      line-height: 1.32 !important;
      min-height: 2.65em !important;
      margin: 0 0 10px 0 !important;
      text-align: left !important;
    }
    .keystone-investments-page .inv-equal-principle-card p {
      font-size: 0.81rem !important;
      color: #cbd5e1 !important;
      line-height: 1.56 !important;
      margin: 0 !important;
      text-align: left !important;
      flex: 1 1 auto !important;
    }
    .keystone-investments-page .inv-clean-notice-box {
      background: #04070d !important;
      border: 1.5px solid rgba(212, 175, 55, 0.48) !important;
      border-radius: 18px !important;
      padding: 22px 24px !important;
      margin-top: 26px !important;
    }
    .keystone-investments-page .inv-notice-header-row {
      margin-bottom: 14px !important;
    }
    .keystone-investments-page .inv-notice-two-col {
      display: grid !important;
      grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
      gap: 20px !important;
      align-items: start !important;
    }
    .keystone-investments-page .inv-notice-two-col p {
      margin: 0 !important;
      color: #cbd5e1 !important;
      font-size: 0.82rem !important;
      line-height: 1.58 !important;
      text-align: left !important;
    }

    /* Section 3: The 3 Sovereign Asset Pillars — 100% Leveled & Parallel Sub-Elements */
    .keystone-investments-page .inv-three-pillars-grid {
      display: grid !important;
      grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
      gap: 26px !important;
      align-items: stretch !important;
      margin: 32px 0 56px 0 !important;
    }
    .keystone-investments-page .inv-three-pillars-grid > p {
      display: none !important;
    }
    .keystone-investments-page .investment-pillar-card.inv-level-pillar-card {
      background: #04070d !important;
      background-color: #04070d !important;
      border: 1.5px solid rgba(56, 189, 248, 0.42) !important;
      border-radius: 20px !important;
      padding: 22px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      height: 100% !important;
      box-sizing: border-box !important;
      box-shadow: 0 18px 44px rgba(0, 0, 0, 0.85) !important;
    }
    .keystone-investments-page .inv-clean-pillar-thumb {
      width: 100% !important;
      height: 215px !important;
      min-height: 215px !important;
      max-height: 215px !important;
      border-radius: 14px !important;
      overflow: hidden !important;
      margin: 0 0 18px 0 !important;
      border: 1px solid rgba(255, 255, 255, 0.12) !important;
      background: #020408 !important;
      flex-shrink: 0 !important;
    }
    .keystone-investments-page .inv-clean-pillar-thumb img {
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
      display: block !important;
    }
    .keystone-investments-page .inv-level-pillar-body {
      flex: 1 1 auto !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      text-align: left !important;
    }
    .keystone-investments-page .inv-pillar-header-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 8px !important;
      margin: 0 0 14px 0 !important;
      min-height: 30px !important;
    }
    .keystone-investments-page .inv-pillar-badge {
      padding: 4px 11px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.64rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      white-space: nowrap !important;
    }
    .keystone-investments-page .inv-pillar-subtag {
      color: #94a3b8 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.66rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      white-space: nowrap !important;
    }
    .keystone-investments-page .inv-level-pillar-title {
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.22rem !important;
      font-weight: 800 !important;
      color: #ffffff !important;
      line-height: 1.3 !important;
      min-height: 2.65em !important;
      margin: 0 0 12px 0 !important;
      text-align: left !important;
    }
    .keystone-investments-page .inv-level-pillar-summary {
      font-size: 0.84rem !important;
      color: #cbd5e1 !important;
      line-height: 1.56 !important;
      min-height: 7.8em !important;
      margin: 0 0 18px 0 !important;
      text-align: left !important;
    }
    .keystone-investments-page .inv-level-detail-list {
      display: grid !important;
      grid-template-rows: repeat(3, 1fr) !important;
      gap: 12px !important;
      margin: 0 0 20px 0 !important;
      flex: 1 1 auto !important;
    }
    .keystone-investments-page .inv-level-detail-box {
      background: #070c16 !important;
      border: 1px solid rgba(56, 189, 248, 0.22) !important;
      border-radius: 12px !important;
      padding: 13px 14px !important;
      display: flex !important;
      align-items: flex-start !important;
      gap: 11px !important;
      height: 100% !important;
      box-sizing: border-box !important;
    }
    .keystone-investments-page .inv-level-detail-box strong {
      color: #ffffff !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.84rem !important;
      font-weight: 800 !important;
      line-height: 1.32 !important;
      display: block !important;
      margin-bottom: 4px !important;
    }
    .keystone-investments-page .inv-level-detail-box span {
      color: #cbd5e1 !important;
      font-size: 0.78rem !important;
      line-height: 1.48 !important;
      display: block !important;
    }
    .keystone-investments-page .inv-level-pillar-footer {
      margin-top: auto !important;
      padding-top: 18px !important;
      border-top: 1px solid rgba(56, 189, 248, 0.24) !important;
    }
    .keystone-investments-page .inv-pillar-cta-btn {
      width: 100% !important;
      min-height: 48px !important;
      height: 48px !important;
      padding: 0 14px !important;
      border-radius: 9999px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.72rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.04em !important;
      text-transform: uppercase !important;
      text-decoration: none !important;
      white-space: nowrap !important;
      box-sizing: border-box !important;
    }

    /* Section 4: Aesthetic & Strategic Business Investments (2 Equal Parallel Cards) */
    .keystone-investments-page .inv-business-master-card,
    .keystone-investments-page .inv-risk-master-card {
      background: linear-gradient(145deg, rgba(8, 13, 24, 0.96) 0%, #04070d 100%) !important;
      border: 1.5px solid rgba(56, 189, 248, 0.42) !important;
      border-radius: 24px !important;
      padding: 36px 32px !important;
      margin: 0 0 52px 0 !important;
      box-shadow: 0 22px 55px rgba(0, 0, 0, 0.85) !important;
    }
    .keystone-investments-page .inv-risk-master-card {
      border-color: rgba(212, 175, 55, 0.48) !important;
    }
    .keystone-investments-page .inv-business-two-grid {
      display: grid !important;
      grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
      gap: 26px !important;
      align-items: stretch !important;
      margin-top: 24px !important;
    }
    .keystone-investments-page .inv-business-two-grid > p {
      display: none !important;
    }
    .keystone-investments-page .inv-equal-subcard {
      background: #04070d !important;
      background-color: #04070d !important;
      border: 1.5px solid rgba(56, 189, 248, 0.36) !important;
      border-radius: 18px !important;
      padding: 26px 24px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      height: 100% !important;
      box-sizing: border-box !important;
      text-align: left !important;
      box-shadow: 0 14px 36px rgba(0, 0, 0, 0.8) !important;
    }
    .keystone-investments-page .inv-subcard-pill {
      padding: 5px 13px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.66rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
    }
    .keystone-investments-page .inv-equal-subcard .subcard-title {
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.24rem !important;
      font-weight: 800 !important;
      color: #ffffff !important;
      margin: 6px 0 10px 0 !important;
    }
    .keystone-investments-page .inv-equal-subcard .subcard-desc {
      font-size: 0.85rem !important;
      color: #cbd5e1 !important;
      line-height: 1.58 !important;
      min-height: 3.2em !important;
      margin: 0 0 18px 0 !important;
    }
    .keystone-investments-page .inv-subcard-list {
      display: grid !important;
      grid-template-rows: repeat(3, 1fr) !important;
      gap: 12px !important;
      list-style: none !important;
      padding: 0 !important;
      margin: 0 !important;
      flex: 1 1 auto !important;
    }
    .keystone-investments-page .inv-subcard-list li {
      background: #070c16 !important;
      border: 1px solid rgba(56, 189, 248, 0.22) !important;
      border-radius: 12px !important;
      padding: 12px 14px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: center !important;
      gap: 3px !important;
    }
    .keystone-investments-page .inv-subcard-list li strong {
      color: #ffffff !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.84rem !important;
      font-weight: 800 !important;
    }
    .keystone-investments-page .inv-subcard-list li span {
      color: #cbd5e1 !important;
      font-size: 0.78rem !important;
      line-height: 1.45 !important;
    }

    /* Section 6: Revamped Private Executive Engagement Gateway (#executive-gateway) */
    .keystone-investments-page .inv-private-portal-card {
      background: linear-gradient(145deg, rgba(8, 13, 24, 0.98) 0%, #04070d 100%) !important;
      border: 1.5px solid rgba(212, 175, 55, 0.58) !important;
      border-radius: 24px !important;
      padding: 40px 36px !important;
      margin: 0 0 56px 0 !important;
      box-shadow: 0 24px 60px rgba(0, 0, 0, 0.9), 0 0 32px rgba(212, 175, 55, 0.14) !important;
    }
    .keystone-investments-page .inv-portal-header {
      text-align: center !important;
      max-width: 860px !important;
      margin: 0 auto 28px auto !important;
    }
    .keystone-investments-page .inv-portal-title {
      font-family: 'Outfit', sans-serif !important;
      font-size: clamp(1.85rem, 2.8vw, 2.45rem) !important;
      font-weight: 900 !important;
      color: #ffffff !important;
      line-height: 1.2 !important;
      margin: 12px 0 12px 0 !important;
      text-align: center !important;
    }
    .keystone-investments-page .inv-portal-subtitle {
      max-width: 820px !important;
      margin: 0 auto !important;
      color: #cbd5e1 !important;
      font-size: 0.94rem !important;
      line-height: 1.62 !important;
      text-align: center !important;
    }
    .keystone-investments-page .inv-portal-scope-grid {
      display: grid !important;
      grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
      gap: 18px !important;
      align-items: stretch !important;
      margin: 0 0 26px 0 !important;
    }
    .keystone-investments-page .inv-portal-scope-grid > p {
      display: none !important;
    }
    .keystone-investments-page .inv-scope-item {
      background: #04070d !important;
      border: 1.5px solid rgba(56, 189, 248, 0.36) !important;
      border-radius: 16px !important;
      padding: 18px 18px !important;
      display: flex !important;
      flex-direction: column !important;
      align-items: flex-start !important;
      text-align: left !important;
      height: 100% !important;
      box-sizing: border-box !important;
    }
    .keystone-investments-page .inv-scope-pill {
      padding: 4px 11px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.64rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      margin-bottom: 10px !important;
    }
    .keystone-investments-page .inv-scope-item h4 {
      margin: 0 0 6px 0 !important;
      color: #ffffff !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.02rem !important;
      font-weight: 800 !important;
    }
    .keystone-investments-page .inv-scope-item p {
      margin: 0 !important;
      color: #cbd5e1 !important;
      font-size: 0.80rem !important;
      line-height: 1.5 !important;
    }
    .keystone-investments-page .inv-portal-bottom-split {
      display: grid !important;
      grid-template-columns: 1.08fr 0.92fr !important;
      gap: 24px !important;
      align-items: stretch !important;
      margin: 0 0 22px 0 !important;
    }
    .keystone-investments-page .inv-portal-bottom-split > p {
      display: none !important;
    }
    .keystone-investments-page .direct-email-gateway-box.inv-email-vault-box {
      background: #04070d !important;
      border: 1.5px solid rgba(56, 189, 248, 0.45) !important;
      border-radius: 18px !important;
      padding: 24px 24px !important;
      margin: 0 !important;
      max-width: none !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      text-align: left !important;
      height: 100% !important;
      box-sizing: border-box !important;
    }
    .keystone-investments-page .inv-vault-badge-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 8px !important;
      margin-bottom: 12px !important;
    }
    .keystone-investments-page .inv-vault-tag {
      padding: 4px 12px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.65rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
    }
    .keystone-investments-page .inv-vault-nda-badge {
      color: #f6d365 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.66rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.06em !important;
    }
    .keystone-investments-page .inv-email-link {
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.42rem !important;
      font-weight: 800 !important;
      color: #38bdf8 !important;
      margin: 0 0 10px 0 !important;
      text-align: left !important;
    }
    .keystone-investments-page .inv-email-copy {
      margin: 0 !important;
      color: #cbd5e1 !important;
      font-size: 0.81rem !important;
      line-height: 1.55 !important;
      text-align: left !important;
    }
    .keystone-investments-page .inv-portal-actions-col {
      background: #04070d !important;
      border: 1.5px solid rgba(212, 175, 55, 0.45) !important;
      border-radius: 18px !important;
      padding: 24px 24px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      text-align: left !important;
      height: 100% !important;
      box-sizing: border-box !important;
    }
    .keystone-investments-page .inv-actions-kicker {
      display: block !important;
      color: #f6d365 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.66rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.07em !important;
      margin-bottom: 4px !important;
    }
    .keystone-investments-page .inv-actions-card-head h4 {
      margin: 0 0 4px 0 !important;
      color: #ffffff !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.12rem !important;
      font-weight: 800 !important;
    }
    .keystone-investments-page .inv-actions-card-head p {
      margin: 0 0 14px 0 !important;
      color: #94a3b8 !important;
      font-size: 0.80rem !important;
    }
    .keystone-investments-page .inv-portal-btn-stack {
      display: flex !important;
      flex-direction: column !important;
      gap: 12px !important;
      width: 100% !important;
    }
    .keystone-investments-page .inv-gateway-action-btn {
      width: 100% !important;
      min-height: 48px !important;
      height: 48px !important;
      padding: 0 20px !important;
      border-radius: 9999px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.80rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.04em !important;
      text-transform: uppercase !important;
      text-decoration: none !important;
      white-space: nowrap !important;
      box-sizing: border-box !important;
    }
    .keystone-investments-page .inv-portal-fiduciary-footer {
      text-align: center !important;
      color: #94a3b8 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.72rem !important;
      font-weight: 700 !important;
      letter-spacing: 0.04em !important;
      padding-top: 16px !important;
      border-top: 1px solid rgba(212, 175, 55, 0.22) !important;
    }

    @media (max-width: 1080px) {
      .keystone-investments-page .inv-quant-4grid,
      .keystone-investments-page .inv-risk-4grid,
      .keystone-investments-page .inv-hero-quicknav-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
      }
      .keystone-investments-page .inv-three-pillars-grid,
      .keystone-investments-page .inv-portal-scope-grid,
      .keystone-investments-page .inv-portal-bottom-split,
      .keystone-investments-page .inv-business-two-grid,
      .keystone-investments-page .inv-notice-two-col {
        grid-template-columns: 1fr !important;
      }
    }
    @media (max-width: 720px) {
      .keystone-investments-page .inv-quant-4grid,
      .keystone-investments-page .inv-risk-4grid,
      .keystone-investments-page .inv-hero-quicknav-grid {
        grid-template-columns: 1fr !important;
      }
    }

    /* ==========================================================================
     * 13. PAGE 6 (/lifestyle/ • template-lifestyle.php):
     *     CENTERED CLEAN HERO, 6 EQUAL-HEIGHT PILLAR CARDS WITH 3 SUB-BOXES EACH,
     *     4 EQUAL DAILY CADENCE CARDS & REVAMPED EXECUTIVE GATEWAY PORTAL
     * ========================================================================== */
    .keystone-lifestyle-page .lifestyle-hero-header {
      padding: 28px 0 32px 0 !important;
      text-align: center !important;
      max-width: 980px !important;
      margin: 0 auto 28px auto !important;
    }
    .keystone-lifestyle-page .text-center,
    .keystone-lifestyle-page .pillars-section-intro,
    .keystone-lifestyle-page .cadence-card-header,
    .keystone-lifestyle-page .life-portal-header {
      text-align: center !important;
    }
    .keystone-lifestyle-page .life-section-kicker {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      height: 34px !important;
      min-height: 34px !important;
      padding: 0 18px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.71rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.07em !important;
      line-height: 1 !important;
      text-transform: uppercase !important;
      box-sizing: border-box !important;
    }
    .keystone-lifestyle-page .life-section-kicker .ks-wave-text {
      height: auto !important;
      min-height: 0 !important;
      padding: 0 !important;
      margin: 0 !important;
      line-height: 1.15 !important;
      display: inline-block !important;
    }
    .keystone-lifestyle-page .lifestyle-main-title {
      margin: 6px 0 14px 0 !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: clamp(2.15rem, 3.6vw, 3.1rem) !important;
      font-weight: 900 !important;
      line-height: 1.15 !important;
      color: #ffffff !important;
      text-align: center !important;
    }
    .keystone-lifestyle-page .lifestyle-hero-subtitle {
      max-width: 860px !important;
      margin: 0 auto !important;
      color: #cbd5e1 !important;
      font-size: 0.98rem !important;
      line-height: 1.65 !important;
      text-align: center !important;
    }
    .keystone-lifestyle-page .pillars-section-title {
      font-family: 'Outfit', sans-serif !important;
      font-size: clamp(1.75rem, 2.7vw, 2.35rem) !important;
      font-weight: 900 !important;
      line-height: 1.2 !important;
      color: #ffffff !important;
      margin: 12px 0 12px 0 !important;
      text-align: center !important;
    }
    .keystone-lifestyle-page .pillars-section-desc {
      max-width: 820px !important;
      margin: 0 auto 24px auto !important;
      color: #cbd5e1 !important;
      font-size: 0.94rem !important;
      line-height: 1.62 !important;
      text-align: center !important;
    }

    /* Section 2: 6 Sovereign Pillars Grid (2 Rows of 3 Equal Parallel Cards) */
    .keystone-lifestyle-page .life-six-pillars-grid {
      display: grid !important;
      grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
      gap: 26px !important;
      align-items: stretch !important;
      margin: 32px 0 56px 0 !important;
    }
    .keystone-lifestyle-page .life-six-pillars-grid > p {
      display: none !important;
    }
    .keystone-lifestyle-page .lifestyle-pillar-card.life-level-pillar-card {
      background: #04070d !important;
      background-color: #04070d !important;
      border: 1.5px solid rgba(56, 189, 248, 0.42) !important;
      border-radius: 20px !important;
      padding: 24px 22px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      height: 100% !important;
      box-sizing: border-box !important;
      box-shadow: 0 18px 44px rgba(0, 0, 0, 0.85) !important;
    }
    .keystone-investments-page .investment-pillar-card.inv-level-pillar-card:hover,
    .keystone-lifestyle-page .lifestyle-pillar-card.life-level-pillar-card:hover {
      transform: none !important;
      border-color: #38bdf8 !important;
      box-shadow: 0 20px 48px rgba(0, 0, 0, 0.92), 0 0 24px rgba(56, 189, 248, 0.25) !important;
    }
    .keystone-lifestyle-page .lifestyle-pillar-card.life-level-pillar-card:nth-child(even) {
      border-color: rgba(212, 175, 55, 0.48) !important;
    }
    .keystone-lifestyle-page .lifestyle-pillar-card.life-level-pillar-card:nth-child(even):hover {
      transform: none !important;
      border-color: #f6d365 !important;
      box-shadow: 0 20px 48px rgba(0, 0, 0, 0.92), 0 0 24px rgba(212, 175, 55, 0.28) !important;
    }
    .keystone-lifestyle-page .life-level-pillar-body {
      flex: 1 1 auto !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      text-align: left !important;
    }
    .keystone-lifestyle-page .life-pillar-header-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 8px !important;
      margin: 0 0 14px 0 !important;
      min-height: 30px !important;
    }
    .keystone-lifestyle-page .life-pillar-badge {
      padding: 4px 11px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.64rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      white-space: nowrap !important;
    }
    .keystone-lifestyle-page .life-pillar-subtag {
      color: #94a3b8 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.66rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      white-space: nowrap !important;
    }
    .keystone-lifestyle-page .life-level-pillar-title {
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.13rem !important;
      font-weight: 800 !important;
      color: #ffffff !important;
      line-height: 1.3 !important;
      min-height: 2.65em !important;
      margin: 0 0 12px 0 !important;
      text-align: left !important;
    }
    .keystone-lifestyle-page .life-level-pillar-summary {
      font-size: 0.84rem !important;
      color: #cbd5e1 !important;
      line-height: 1.56 !important;
      min-height: 7.6em !important;
      margin: 0 0 18px 0 !important;
      text-align: left !important;
    }
    .keystone-lifestyle-page .life-level-detail-list {
      display: grid !important;
      grid-template-rows: repeat(3, 1fr) !important;
      gap: 12px !important;
      margin: 0 0 20px 0 !important;
      flex: 1 1 auto !important;
    }
    .keystone-lifestyle-page .life-level-detail-box {
      background: #070c16 !important;
      border: 1px solid rgba(56, 189, 248, 0.22) !important;
      border-radius: 12px !important;
      padding: 13px 14px !important;
      display: flex !important;
      align-items: flex-start !important;
      gap: 11px !important;
      height: 100% !important;
      box-sizing: border-box !important;
    }
    .keystone-lifestyle-page .life-level-detail-box strong {
      color: #ffffff !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.84rem !important;
      font-weight: 800 !important;
      line-height: 1.32 !important;
      display: block !important;
      margin-bottom: 4px !important;
    }
    .keystone-lifestyle-page .life-level-detail-box span {
      color: #cbd5e1 !important;
      font-size: 0.78rem !important;
      line-height: 1.48 !important;
      display: block !important;
    }
    .keystone-lifestyle-page .life-level-pillar-footer {
      margin-top: auto !important;
      padding-top: 18px !important;
      border-top: 1px solid rgba(56, 189, 248, 0.24) !important;
    }
    .keystone-lifestyle-page .life-pillar-cta-btn {
      width: 100% !important;
      min-height: 48px !important;
      height: 48px !important;
      padding: 0 14px !important;
      border-radius: 9999px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.72rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.04em !important;
      text-transform: uppercase !important;
      text-decoration: none !important;
      white-space: nowrap !important;
      box-sizing: border-box !important;
    }

    /* Section 3: Daily Operational Cadence (4 Equal Parallel Cards) */
    .keystone-lifestyle-page .life-cadence-master-card {
      background: linear-gradient(145deg, rgba(8, 13, 24, 0.96) 0%, #04070d 100%) !important;
      border: 1.5px solid rgba(56, 189, 248, 0.44) !important;
      border-radius: 24px !important;
      padding: 36px 32px !important;
      margin: 0 0 52px 0 !important;
      box-shadow: 0 22px 55px rgba(0, 0, 0, 0.85) !important;
    }
    .keystone-lifestyle-page .life-cadence-4grid {
      display: grid !important;
      grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
      gap: 18px !important;
      align-items: stretch !important;
      margin: 24px 0 0 0 !important;
    }
    .keystone-lifestyle-page .life-cadence-4grid > p {
      display: none !important;
    }
    .keystone-lifestyle-page .life-equal-cadence-card {
      background: #04070d !important;
      background-color: #04070d !important;
      border: 1.5px solid rgba(56, 189, 248, 0.38) !important;
      border-radius: 18px !important;
      padding: 22px 18px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: flex-start !important;
      text-align: left !important;
      height: 100% !important;
      box-sizing: border-box !important;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.78) !important;
      transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease !important;
    }
    .keystone-lifestyle-page .life-equal-cadence-card:nth-child(odd) {
      border-color: rgba(212, 175, 55, 0.45) !important;
    }
    .keystone-lifestyle-page .life-equal-cadence-card:hover {
      transform: none !important;
      border-color: #38bdf8 !important;
      box-shadow: 0 16px 36px rgba(0, 0, 0, 0.9), 0 0 20px rgba(56, 189, 248, 0.28) !important;
    }
    .keystone-lifestyle-page .life-cadence-top-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 8px !important;
      margin-bottom: 14px !important;
      width: 100% !important;
    }
    .keystone-lifestyle-page .life-mini-tag {
      padding: 4px 11px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.64rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
    }
    .keystone-lifestyle-page .life-cadence-icon {
      font-size: 1.35rem !important;
      line-height: 1 !important;
    }
    .keystone-lifestyle-page .life-equal-cadence-card h4 {
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.02rem !important;
      font-weight: 800 !important;
      color: #ffffff !important;
      line-height: 1.32 !important;
      min-height: 2.65em !important;
      margin: 0 0 10px 0 !important;
      text-align: left !important;
    }
    .keystone-lifestyle-page .life-equal-cadence-card p {
      font-size: 0.81rem !important;
      color: #cbd5e1 !important;
      line-height: 1.56 !important;
      margin: 0 !important;
      text-align: left !important;
      flex: 1 1 auto !important;
    }

    /* Section 4: Revamped Private Executive Engagement Gateway (#executive-contact) */
    .keystone-lifestyle-page .life-private-portal-card {
      background: linear-gradient(145deg, rgba(8, 13, 24, 0.98) 0%, #04070d 100%) !important;
      border: 1.5px solid rgba(212, 175, 55, 0.58) !important;
      border-radius: 24px !important;
      padding: 40px 36px !important;
      margin: 0 0 56px 0 !important;
      box-shadow: 0 24px 60px rgba(0, 0, 0, 0.9), 0 0 32px rgba(212, 175, 55, 0.14) !important;
    }
    .keystone-lifestyle-page .life-portal-header {
      text-align: center !important;
      max-width: 860px !important;
      margin: 0 auto 28px auto !important;
    }
    .keystone-lifestyle-page .life-portal-title {
      font-family: 'Outfit', sans-serif !important;
      font-size: clamp(1.85rem, 2.8vw, 2.45rem) !important;
      font-weight: 900 !important;
      color: #ffffff !important;
      line-height: 1.2 !important;
      margin: 12px 0 12px 0 !important;
      text-align: center !important;
    }
    .keystone-lifestyle-page .life-portal-subtitle {
      max-width: 820px !important;
      margin: 0 auto !important;
      color: #cbd5e1 !important;
      font-size: 0.94rem !important;
      line-height: 1.62 !important;
      text-align: center !important;
    }
    .keystone-lifestyle-page .life-portal-scope-grid {
      display: grid !important;
      grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
      gap: 18px !important;
      align-items: stretch !important;
      margin: 0 0 26px 0 !important;
    }
    .keystone-lifestyle-page .life-portal-scope-grid > p {
      display: none !important;
    }
    .keystone-lifestyle-page .life-scope-item {
      background: #04070d !important;
      border: 1.5px solid rgba(56, 189, 248, 0.36) !important;
      border-radius: 16px !important;
      padding: 18px 18px !important;
      display: flex !important;
      flex-direction: column !important;
      align-items: flex-start !important;
      text-align: left !important;
      height: 100% !important;
      box-sizing: border-box !important;
    }
    .keystone-lifestyle-page .life-scope-pill {
      padding: 4px 11px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.64rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
      margin-bottom: 10px !important;
    }
    .keystone-lifestyle-page .life-scope-item h4 {
      margin: 0 0 6px 0 !important;
      color: #ffffff !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.02rem !important;
      font-weight: 800 !important;
    }
    .keystone-lifestyle-page .life-scope-item p {
      margin: 0 !important;
      color: #cbd5e1 !important;
      font-size: 0.80rem !important;
      line-height: 1.5 !important;
    }
    .keystone-lifestyle-page .life-portal-bottom-split {
      display: grid !important;
      grid-template-columns: 1.08fr 0.92fr !important;
      gap: 24px !important;
      align-items: stretch !important;
      margin: 0 0 22px 0 !important;
    }
    .keystone-lifestyle-page .life-portal-bottom-split > p {
      display: none !important;
    }
    .keystone-lifestyle-page .direct-email-gateway-box.life-email-vault-box {
      background: #04070d !important;
      border: 1.5px solid rgba(56, 189, 248, 0.45) !important;
      border-radius: 18px !important;
      padding: 24px 24px !important;
      margin: 0 !important;
      max-width: none !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      text-align: left !important;
      height: 100% !important;
      box-sizing: border-box !important;
    }
    .keystone-lifestyle-page .life-vault-badge-row {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 8px !important;
      margin-bottom: 12px !important;
    }
    .keystone-lifestyle-page .life-vault-tag {
      padding: 4px 12px !important;
      border-radius: 9999px !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.65rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.05em !important;
    }
    .keystone-lifestyle-page .life-vault-nda-badge {
      color: #f6d365 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.66rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.06em !important;
    }
    .keystone-lifestyle-page .life-email-link {
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.42rem !important;
      font-weight: 800 !important;
      color: #38bdf8 !important;
      margin: 0 0 10px 0 !important;
      text-align: left !important;
    }
    .keystone-lifestyle-page .life-email-copy {
      margin: 0 !important;
      color: #cbd5e1 !important;
      font-size: 0.81rem !important;
      line-height: 1.55 !important;
      text-align: left !important;
    }
    .keystone-lifestyle-page .life-portal-actions-col {
      background: #04070d !important;
      border: 1.5px solid rgba(212, 175, 55, 0.45) !important;
      border-radius: 18px !important;
      padding: 24px 24px !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: space-between !important;
      text-align: left !important;
      height: 100% !important;
      box-sizing: border-box !important;
    }
    .keystone-lifestyle-page .life-actions-kicker {
      display: block !important;
      color: #f6d365 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.66rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.07em !important;
      margin-bottom: 4px !important;
    }
    .keystone-lifestyle-page .life-actions-card-head h4 {
      margin: 0 0 4px 0 !important;
      color: #ffffff !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 1.12rem !important;
      font-weight: 800 !important;
    }
    .keystone-lifestyle-page .life-actions-card-head p {
      margin: 0 0 14px 0 !important;
      color: #94a3b8 !important;
      font-size: 0.80rem !important;
    }
    .keystone-lifestyle-page .life-portal-btn-stack {
      display: flex !important;
      flex-direction: column !important;
      gap: 12px !important;
      width: 100% !important;
    }
    .keystone-lifestyle-page .life-gateway-action-btn {
      width: 100% !important;
      min-height: 48px !important;
      height: 48px !important;
      padding: 0 20px !important;
      border-radius: 9999px !important;
      font-family: 'Outfit', sans-serif !important;
      font-size: 0.80rem !important;
      font-weight: 800 !important;
      letter-spacing: 0.04em !important;
      text-transform: uppercase !important;
      text-decoration: none !important;
      white-space: nowrap !important;
      box-sizing: border-box !important;
    }
    .keystone-lifestyle-page .life-portal-fiduciary-footer {
      text-align: center !important;
      color: #94a3b8 !important;
      font-family: 'JetBrains Mono', monospace !important;
      font-size: 0.72rem !important;
      font-weight: 700 !important;
      letter-spacing: 0.04em !important;
      padding-top: 16px !important;
      border-top: 1px solid rgba(212, 175, 55, 0.22) !important;
    }

    @media (max-width: 1080px) {
      .keystone-lifestyle-page .life-cadence-4grid {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
      }
      .keystone-lifestyle-page .life-six-pillars-grid,
      .keystone-lifestyle-page .life-portal-scope-grid,
      .keystone-lifestyle-page .life-portal-bottom-split {
        grid-template-columns: 1fr !important;
      }
    }
    @media (max-width: 720px) {
      .keystone-lifestyle-page .life-cadence-4grid {
        grid-template-columns: 1fr !important;
      }
    }
    </style>
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
