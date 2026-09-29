<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function astra_child_keystone_enqueue_styles() {
    // Enqueue parent Astra style
    wp_enqueue_style( 'astra-parent-theme-css', get_template_directory_uri() . '/style.css' );
    
    // Enqueue Child customized style (Cache busted)
    wp_enqueue_style( 'astra-child-keystone-css', get_stylesheet_directory_uri() . '/style.css', array( 'astra-parent-theme-css' ), '3.0.0' );
    
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
 * 6. High-Priority Header Overrides (Single-Row Social Icons, Logo Polish & Footer Suppression)
 */
function astra_child_keystone_header_overrides() {
    ?>
    <style id="keystone-header-social-lock">
    /* 1. Header Social Icons: High-Specificity Luminous Cyan (#38bdf8) & Hover (#00f0ff) */
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
      fill: #00f0ff !important;
      color: #00f0ff !important;
      filter: drop-shadow(0 0 10px rgba(0, 240, 255, 0.9)) !important;
    }

    /* 2. Header Navigation Links: White Base + Luminous Cyan Active/Hover */
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
      color: #00f0ff !important;
      text-shadow: 0 0 10px rgba(0, 240, 255, 0.6) !important;
    }
    .main-header-menu .current-menu-item > a,
    .main-header-menu .current_page_item > a,
    .main-header-menu a[aria-current="page"],
    .main-header-menu a.keystone-active-nav,
    .ast-nav-menu a.keystone-active-nav {
      color: #38bdf8 !important;
      text-shadow: 0 0 12px rgba(56, 189, 248, 0.8), 0 0 24px rgba(0, 240, 255, 0.4) !important;
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
      box-shadow: 0 0 8px #00f0ff !important;
      border-radius: 2px !important;
    }

    .ast-desktop-header .site-branding img,
    .ast-desktop-header .custom-logo-link img {
      max-height: 48px !important;
      width: auto !important;
      filter: drop-shadow(0 0 10px rgba(56, 189, 248, 0.35)) drop-shadow(0 2px 8px rgba(0, 0, 0, 0.6)) !important;
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



