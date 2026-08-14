<?php
function astra_child_keystone_enqueue_styles() {
    // Enqueue parent Astra style
    wp_enqueue_style( 'astra-parent-theme-css', get_template_directory_uri() . '/style.css' );
    
    // Enqueue Child customized style (Cache busted)
    wp_enqueue_style( 'astra-child-keystone-css', get_stylesheet_directory_uri() . '/style.css', array( 'astra-parent-theme-css' ), '2.5.0' );
    
    // Load typography fonts (Montserrat, Inter, Outfit)
    wp_enqueue_style( 'keystone-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@700&family=Outfit:wght@400;600;700;800&display=swap', array(), null );

    // Enqueue Lead Consultation Form Handler JS
    wp_enqueue_script( 'keystone-lead-form-handler', get_stylesheet_directory_uri() . '/js/lead-form-handler.js', array(), '1.0.0', true );

    // Enqueue Interactive Calculators Engine
    wp_enqueue_script( 'keystone-calculators-js', get_stylesheet_directory_uri() . '/js/calculators.js', array(), '2.0.0', true );

    // Enqueue WebP Video Facade Engine
    wp_enqueue_script( 'keystone-lazy-player', get_stylesheet_directory_uri() . '/js/lazy-player.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'astra_child_keystone_enqueue_styles' );

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
 * 5. Filter the single post title wrapper to ensure it's strictly an H1.
 */
add_filter( 'astra_the_title_before', 'keystone_recomposition_child_title_before', 10, 1 );

/**
 * 6. High-Priority Header Overrides (Single-Row Social Icons & Logo Polish)
 */
function astra_child_keystone_header_overrides() {
    ?>
    <style id="keystone-header-social-lock">
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
    .ast-desktop-header .header-social-inner-wrap svg {
      width: 18px !important;
      height: 18px !important;
      fill: #C4A265 !important;
      transition: fill 0.2s ease, filter 0.2s ease !important;
    }
    .ast-desktop-header .header-social-inner-wrap a:hover svg {
      fill: #FFFFFF !important;
      filter: drop-shadow(0 0 6px rgba(196, 162, 101, 0.6)) !important;
    }
    .ast-desktop-header .site-branding img,
    .ast-desktop-header .custom-logo-link img {
      max-height: 48px !important;
      width: auto !important;
      filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.4)) !important;
    }
    </style>
    <?php
}
add_action( 'wp_head', 'astra_child_keystone_header_overrides', 9999 );

