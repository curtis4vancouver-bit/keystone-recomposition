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
